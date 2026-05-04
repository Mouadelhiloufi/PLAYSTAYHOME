<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        $user = Auth::user();

        $query = Reservation::with(['console', 'user'])->latest();

        if (!$user || $user->role !== 'admin') {
            $query->where('user_id', Auth::id());
        }

        $reservations = $query->get();

        return response()->json([
            'message' => 'Liste des réservations récupérée avec succès.',
            'data' => $reservations
        ], 200);
    }

    
    // admin
    public function monthlyRevenue()
    {
        $month = now()->month;
        $year = now()->year;

        $revenue = Reservation::query()
            ->whereYear('start_date', $year)
            ->whereMonth('start_date', $month)
            ->sum('total_price');

        
        if ((float) $revenue === 0.0) {
            $lastStartDate = Reservation::query()->max('start_date');

            if ($lastStartDate) {
                $last = \Carbon\Carbon::parse($lastStartDate);
                $month = $last->month;
                $year = $last->year;

                $revenue = Reservation::query()
                    ->whereYear('start_date', $year)
                    ->whereMonth('start_date', $month)
                    ->sum('total_price');
            }
        }

        return response()->json([
            'message' => 'Revenu du mois récupéré avec succès.',
            'data' => [
                'monthly_revenue' => (float) $revenue,
                'month' => $month,
                'year' => $year,
            ],
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'coupon_code' => 'nullable|string',
            'nombre_manettes' => 'nullable|integer|min:0|max:4', // Par exemple max 4 manettes
        ]);

        $reservation = $this->reservationService->createReservation(
            $request->only(['console_id', 'start_date', 'end_date', 'coupon_code', 'nombre_manettes'])
        );

        return response()->json([
            'message' => 'Réservation créée avec succès.',
            'data' => $reservation->load('coupon')
        ], 201);
    }

    public function calculate(Request $request)
    {
        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'coupon_code' => 'nullable|string',
        ]);

        $estimation = $this->reservationService->calculateEstimation(
            $request->only(['console_id', 'start_date', 'end_date', 'coupon_code'])
        );

        return response()->json([
            'message' => 'Devis calculé avec succès.',
            'data' => $estimation
        ], 200);
    }

    public function show($id)
    {
        $reservation = Reservation::with(['console', 'user'])->findOrFail($id);

        if ($reservation->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Accès non autorisé.'
            ], 403);
        }

        return response()->json([
            'message' => 'Détail de la réservation récupéré avec succès.',
            'data' => $reservation
        ], 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Accès non autorisé.'
            ], 403);
        }

        $reservation->delete();

        return response()->json([
            'message' => 'Réservation supprimée avec succès.'
        ], 200);
    }

    public function cancel($id)
    {
        $reservation = Reservation::findOrFail($id);

        if ($reservation->user_id != Auth::id()) {
            return response()->json([
                'message' => 'Accès non autorisé.'
            ], 403);
        }

        $reservation->status = 'cancelled';
        $reservation->save();

        return response()->json([
            'message' => 'Réservation annulée avec succès.',
            'data' => $reservation
        ], 200);
    }
}