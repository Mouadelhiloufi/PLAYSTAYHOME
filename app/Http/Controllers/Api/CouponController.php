<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
        return response()->json($coupons);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'code' => 'required|string|unique:coupons,code|max:50',
            'value' => 'required|numeric|min:0',
            'expiration_date' => 'required|date|after:today',
            'limit' => 'required|integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon = Coupon::create($validated);

        return response()->json([
            'message' => 'Coupon créé avec succès',
            'coupon' => $coupon,
        ], 201);
    }

    public function show(Coupon $coupon)
    {
        return response()->json($coupon);
    }

    public function update(Request $request, Coupon $coupon)
    {
        $validated = $request->validate([
            'code' => 'string|unique:coupons,code,' . $coupon->id . '|max:50',
            'value' => 'numeric|min:0',
            'expiration_date' => 'date|after:today',
            'limit' => 'integer|min:1',
            'is_active' => 'boolean',
        ]);

        $coupon->update($validated);

        return response()->json([
            'message' => 'Coupon mis à jour avec succès',
            'coupon' => $coupon,
        ]);
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();

        return response()->json([
            'message' => 'Coupon supprimé avec succès',
        ]);
    }

    public function validate(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
        ]);

        $coupon = Coupon::where('code', $request->code)->first();

        if (!$coupon) {
            return response()->json([
                'valid' => false,
                'message' => 'Coupon introuvable',
            ], 404);
        }

        $user = $request->user();
        $reasons = [];

        if ($coupon->expiration_date < now()->toDateString()) {
            $reasons[] = 'Le coupon a expiré';
        }
            // combien de fois ce coupon util in res
        if ($coupon->reservations()->count() >= $coupon->limit) {
            $reasons[] = 'Le coupon a atteint sa limite d\'utilisation';
        }

        if ($user->reservations()->where('coupon_id', $coupon->id)->exists()) {
            $reasons[] = 'Vous avez déjà utilisé ce coupon';
        }

        if (!empty($reasons)) {
            return response()->json([
                'valid' => false,
                'message' => 'Coupon invalide',
                'reasons' => $reasons,
            ], 422);
        }

        return response()->json([
            'valid' => true,
            'message' => 'Coupon valide',
            'coupon' => [
                'code' => $coupon->code,
                'value' => $coupon->value,
            ],
        ]);
    }
}
