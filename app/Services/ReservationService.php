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

    // pour jobs
    public function terminerReservation($reservationId)
    {
        $reservation = Reservation::find($reservationId);
        if (!$reservation) {
            return false;
        }
       
        $reservation->status = 'completed';
        $reservation->save();

        
        $manettes = $reservation->manettes;
            foreach ($manettes as $manette) {
            $manette->status = 'available';
            $manette->save();
        }
        return true;
    }

    private function countInclusiveDays(Carbon $startDate, Carbon $endDate): int
    {
        // On inclut le jour de début et le jour de fin.
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
    ->where('status','active')
    ->where('start_date', '<=', $endDate)
    ->where('end_date', '>=', $startDate)
    ->exists();



    if ($reservationExists) {
        throw ValidationException::withMessages([
            'console_id' => 'La console est déjà réservée pour les dates sélectionnées.',
        ]);

    }

        // Calcul du prix total
        $totalPrice = $this->calculatePrice($console, $startDate, $endDate);

        // --- Ajout du supplément manettes ---
        $nombreManettes = $data['nombre_manettes'] ?? 0;
        if($nombreManettes == 3) {
            $totalPrice += 25;
        } else if($nombreManettes == 4) {
            $totalPrice += 50;
        }
        // ------------------------------------

        // Gestion du coupon
        $couponId = null;

        if (isset($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();

            if (!$coupon) {
                throw ValidationException::withMessages([
                    'coupon_code' => 'Le coupon n\'existe pas.',
                ]);
            }

            $user = Auth::user();

            // Vérifications simples
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

            // Appliquer la réduction (montant fixe)
            $discount = min($coupon->value, $totalPrice);
            $totalPrice -= $discount;
            $couponId = $coupon->id;
        }

        // On vérifie s'il demande des manettes
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
            'user_id' => Auth::id(),
            'console_id' => $console->id,
            'coupon_id' => $couponId,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => round($totalPrice, 2),
            'status' => 'active',
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
        
        // si 24h est passé la notif envoyer, else schedule for the exact time
        if (now()->greaterThanOrEqualTo($reminderTime)) {
            Auth::user()->notify(new ReservationDay($reservation));
        } else {
            Auth::user()->notify((new ReservationDay($reservation))->delay($reminderTime));
        }

        // dispatch le job pour quand la reservation termin le status est dispo
        TerminerReservationJob::dispatch($reservation->id)->delay($endDate);

        return $reservation->load('manettes'); 
    }

    public function calculatePrice(Console $console, Carbon $startDate, Carbon $endDate): float
    {
        $totalPrice = 0;

        foreach (CarbonPeriod::create($startDate, $endDate) as $date) {
            $price = $console->daily_price;

            // Tarif majoré le weekend (samedi et dimanche)
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
        
        // --- Ajout du supplément manettes ---
        $manettesCount = isset($data['nombre_manettes']) ? (int) $data['nombre_manettes'] : 0;
        if($manettesCount == 3) {
            $totalPrice += 25;
        } else if($manettesCount == 4) {
            $totalPrice += 50;
        }
        // ------------------------------------

        $discount = 0;
        
        if (isset($data['coupon_code'])) {
            $coupon = Coupon::where('code', $data['coupon_code'])->first();
            
            if ($coupon && $coupon->expiration_date >= now()->toDateString() && $coupon->reservations()->count() < $coupon->limit) {
                // Pas besoin de lever d'exception pour un devis, on applique la réduction si c'est possible
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
