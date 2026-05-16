<?php

namespace App\Services;

use App\Models\Console;
use App\Models\Coupon;
use App\Models\Reservation;
use App\Models\Manette;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use App\Notifications\ReservationDay;
use \App\Jobs\TerminerReservationJob;

class ReservationService{
    /**
     * Termine une réservation et remet les manettes à disposition
     */

    public function releaseReservationResources(Reservation $reservation, bool $restoreCouponLimit = false): void
    {
        $manetteIds = $reservation->manettes()->pluck('manettes.id');

        if ($manetteIds->isNotEmpty()) {
            Manette::whereIn('id', $manetteIds)->update(['status' => 'available']);
            $reservation->manettes()->detach();
        }

        if ($restoreCouponLimit && $reservation->coupon_id) {
            $coupon = Coupon::find($reservation->coupon_id);
            if ($coupon) {
                $coupon->increment('limit');
            }
        }
    }

    // pour jobs
    public function terminerReservation($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return false;
        }

        $currentStatus = strtolower((string) $reservation->status);
        if (in_array($currentStatus, ['refused', 'cancelled'], true)) {
            return true;
        }
       
        $this->releaseReservationResources($reservation, false);

        // Mark as completed only when the reservation naturally ends.
        $reservation->status = 'completed';
        $reservation->save();

        return true;
    }

    private function countInclusiveDays(Carbon $startDate, Carbon $endDate): int
    {
        // en return les jours entre D et F
        return $startDate->diffInDays($endDate) + 1;
    }
    
    public function createReservation(array $data): Reservation
    {
        $console = Console::findOrFail($data['console_id']);

        $startDate = Carbon::parse($data['start_date'])->startOfDay();
        $endDate = Carbon::parse($data['end_date'])->startOfDay();


       #lessthan
        if ($endDate->lt($startDate)) {
            throw ValidationException::withMessages([
                'end_date' => 'La date de fin doit être supérieure ou égale à la date de début.',
            ]);
        }

        // count les jours reserves
        $days = $this->countInclusiveDays($startDate, $endDate);



    if ($days < 1) {
            throw ValidationException::withMessages([
                'start_date' => 'La réservation doit durer au minimum 1 jour.',
            ]);
        }


        $reservationExists= Reservation::where('console_id',$console->id)
    ->whereIn('status', ['pending', 'accepted', 'active'])
    ->where('start_date', '<=', $endDate)
    ->where('end_date', '>=', $startDate)
    ->exists();



    if ($reservationExists) {
        throw ValidationException::withMessages([
            'console_id' => 'La console est déjà réservée pour les dates sélectionnées.',
        ]);

    }

        // calcul du prix total
        $totalPrice = $this->calculatePrice($console, $startDate, $endDate);

        // ajout du manettes ---
        $nombreManettes = $data['nombre_manettes'] ?? 0;
        if($nombreManettes == 3) {
            $totalPrice += 25;
        } else if($nombreManettes == 4) {
            $totalPrice += 50;
        }
        // ------------------------------------

        // gestion du coupon
        $couponId = null;

        if (isset($data['coupon_code']) && $data['coupon_code'] !== null && $data['coupon_code'] !== '') {
            if (! Auth::guard('sanctum')->check()) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Connectez-vous pour utiliser un coupon.',
                ]);
            }

            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            if (!$coupon) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Le coupon n\'existe pas.',
                ]);
            }

            $user = Auth::user();

            if ($coupon->expiration_date < now()->toDateString()) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Le coupon a expiré.',
                ]);
            }

            if ($coupon->limit <= 0) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Le coupon a atteint sa limite d\'utilisation.',
                ]);
            }

            if (Reservation::where('user_id', $user->id)->where('coupon_id', $coupon->id)->exists()) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Vous avez déjà utilisé ce coupon.',
                ]);
            }

            // faire la reduction
            $discount = min($coupon->value, $totalPrice);
            $totalPrice -= $discount;
            $couponId = $coupon->id;
        }

        // on verifie si il demande des manettes
        $manettesDisponibles = [];

        if ($nombreManettes > 0) {
            $manettesDisponibles = Manette::where('status', 'available')
                ->inRandomOrder()
                ->take($nombreManettes)
                ->pluck('id');

            if ($manettesDisponibles->count() < $nombreManettes) {
                throw ValidationException::withMessages([
                    'nombre_manettes' => 'Pas assez de manettes disponibles pour le moment.',
                ]);
            }
        }

        $reservation = Reservation::create([
            'user_id' => Auth::guard('sanctum')->user()?->id,
            'console_id' => $console->id,
            'coupon_id' => $couponId,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => round($totalPrice, 2),
            'status' => 'pending',
            'phone' => $data['phone'],
            'address' => $data['address'],
            'cin' => $data['cin'] ?? null,
        ]);

        if ($nombreManettes > 0) {
            $reservation->manettes()->attach($manettesDisponibles); // attache mannete dispo
            // changer le statut des manettes à louer
            Manette::whereIn('id', $manettesDisponibles)->update(['status' => 'louer']);
        }
        if ($couponId) {
            $coupon = Coupon::find($couponId);
            if ($coupon) {
                $coupon->decrement('limit');
            }
        }

        // - 1 jour depuis endDate
        $reminderTime = $endDate->copy()->subHours(24);

        $authUser = Auth::guard('sanctum')->user();
        if ($authUser instanceof \App\Models\User) {
            if (now()->greaterThanOrEqualTo($reminderTime)) {
                $authUser->notify(new ReservationDay($reservation));
            } else {
                $authUser->notify((new ReservationDay($reservation))->delay($reminderTime));
            }
        }

        // dispatch le job pour quand la reservation termin le status est dispo
        TerminerReservationJob::dispatch($reservation->id)->delay($endDate->copy()->endOfDay());

        return $reservation->load('manettes'); 
    }

    public function calculatePrice(Console $console, Carbon $startDate, Carbon $endDate): float
    {
        $totalPrice = 0;

        foreach (CarbonPeriod::create($startDate, $endDate) as $date) {
            $price = $console->daily_price;

            // tarif majore le weekend
            if ($date->isWeekend()) {
                $price *= 1.5;
            }

            $totalPrice += $price;
        }

        return $totalPrice;
    }

    public function calculateEstimation(array $data): array
    {
        $console = Console::findOrFail($data['console_id']);
        $startDate = Carbon::parse($data['start_date'])->startOfDay();
        $endDate = Carbon::parse($data['end_date'])->startOfDay();

        if ($endDate->lt($startDate)) {
            throw ValidationException::withMessages([
                'end_date' => 'La date de fin doit être supérieure ou égale à la date de début.',
            ]);
        }

        $days = $this->countInclusiveDays($startDate, $endDate);
        $totalPrice = $this->calculatePrice($console, $startDate, $endDate);
        
        // ajout du supplement manettes
        $manettesCount = isset($data['nombre_manettes']) ? (int) $data['nombre_manettes'] : 0;
        if($manettesCount == 3) {
            $totalPrice += 25;
        } else if($manettesCount == 4) {
            $totalPrice += 50;
        }
        

        $discount = 0;
        
        if (isset($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();
            
            if ($coupon && $coupon->expiration_date >= now()->toDateString() && $coupon->reservations()->count() < $coupon->limit) {
                $discount = min($coupon->value, $totalPrice);
            }
        }

        return [
            'days' => $days,
            'subtotal' => $totalPrice,
            'discount' => $discount,
            'total' => round(max(0, $totalPrice - $discount), 2),
        ];
    }
}
