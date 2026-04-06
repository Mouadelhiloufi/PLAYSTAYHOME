<?php

namespace App\Services;

use App\Models\Console;
use App\Models\Coupon;
use App\Models\Reservation;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;


class ReservationService{
    
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

        $days = $startDate->diffInDays($endDate) + 1;



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

            if ($coupon->reservations()->count() >= $coupon->limit) {
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

        return Reservation::create([
            'user_id' => Auth::id(),
            'console_id' => $console->id,
            'coupon_id' => $couponId,
            'start_date' => $startDate->toDateString(),
            'end_date' => $endDate->toDateString(),
            'total_price' => round($totalPrice, 2),
            'status' => 'active',
        ]);


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

        $days = (int) $startDate->diffInDays($endDate) + 1;
        $totalPrice = $this->calculatePrice($console, $startDate, $endDate);
        
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