<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Services\ReservationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\PersonalAccessToken;

class ReservationController extends Controller
{
    protected $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    public function index()
    {
        if (! Auth::check()) {
            return response()->json([
                'message' => 'Non authentifié.',
            ], 401);
        }

        $user = Auth::user();

        $query = Reservation::with(['console', 'user'])->latest();

        if ($user->role !== 'admin') {
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
        if ($token = $request->bearerToken()) {
            $accessToken = PersonalAccessToken::findToken($token);
            if ($accessToken && $accessToken->tokenable instanceof \App\Models\User) {
                Auth::guard('sanctum')->setUser($accessToken->tokenable);
            }
        }

        $request->validate([
            'console_id' => 'required|exists:consoles,id',
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'coupon_code' => 'nullable|string',
            'nombre_manettes' => 'nullable|integer|min:0|max:4',
            'phone' => 'required|string|max:50',
            'address' => 'required|string|max:5000',
        ]);

        $reservation = $this->reservationService->createReservation(
            $request->only(['console_id', 'start_date', 'end_date', 'coupon_code', 'nombre_manettes', 'phone', 'address'])
        );

        return response()->json([
            'message' => 'Réservation créée avec succès.',
            'data' => $reservation->load('coupon')
        ], 201);
    }

    private function updateReservationStatus(Reservation $reservation, string $status): Reservation
    {
        $reservation->status = $status;
        $reservation->save();

        return $reservation->load(['console', 'user']);
    }

    public function accept($id)
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Accès non autorisé.'], 403);
        }

        $reservation = Reservation::with(['console', 'user'])->findOrFail($id);
        $currentStatus = strtolower((string) $reservation->status);

        if (! in_array($currentStatus, ['pending', 'active'], true)) {
            return response()->json([
                'message' => 'Cette réservation ne peut plus être acceptée.',
            ], 422);
        }

        return response()->json([
            'message' => 'Réservation acceptée avec succès.',
            'data' => $this->updateReservationStatus($reservation, 'accepted'),
        ], 200);
    }

    public function refuse($id)
    {
        if (! Auth::check() || Auth::user()->role !== 'admin') {
            return response()->json(['message' => 'Accès non autorisé.'], 403);
        }

        $reservation = Reservation::with(['console', 'user', 'manettes'])->findOrFail($id);
        $currentStatus = strtolower((string) $reservation->status);

        if (! in_array($currentStatus, ['pending', 'active'], true)) {
            return response()->json([
                'message' => 'Cette réservation ne peut plus être refusée.',
            ], 422);
        }

        $this->reservationService->releaseReservationResources($reservation, true);

        return response()->json([
            'message' => 'Réservation refusée avec succès.',
            'data' => $this->updateReservationStatus($reservation, 'refused'),
        ], 200);
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

        if (! Auth::check()) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        $authUser = Auth::user();
        if ($authUser->role !== 'admin') {
            if ($reservation->user_id === null || (int) $reservation->user_id !== (int) $authUser->id) {
                return response()->json([
                    'message' => 'Accès non autorisé.',
                ], 403);
            }
        }

        return response()->json([
            'message' => 'Détail de la réservation récupéré avec succès.',
            'data' => $reservation
        ], 200);
    }

    public function destroy($id)
    {
        $reservation = Reservation::findOrFail($id);

        if (! Auth::check()) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        $authUser = Auth::user();
        if ($authUser->role !== 'admin' && ($reservation->user_id === null || (int) $reservation->user_id !== (int) $authUser->id)) {
            return response()->json([
                'message' => 'Accès non autorisé.',
            ], 403);
        }

        $reservation->delete();

        return response()->json([
            'message' => 'Réservation supprimée avec succès.'
        ], 200);
    }

    public function cancel($id)
    {
        $reservation = Reservation::with('manettes')->findOrFail($id);

        if (! Auth::check()) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        $authUser = Auth::user();
        if ($authUser->role !== 'admin' && ($reservation->user_id === null || (int) $reservation->user_id !== (int) $authUser->id)) {
            return response()->json([
                'message' => 'Accès non autorisé.',
            ], 403);
        }

        $this->reservationService->releaseReservationResources($reservation, true);

        $reservation->status = 'refused';
        $reservation->save();

        return response()->json([
            'message' => 'Réservation annulée avec succès.',
            'data' => $reservation
        ], 200);
    }
}