<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Manette;
use Illuminate\Http\Request;

class ManetteController extends Controller
{
    /**
     * index()
     */
    public function index()
    {
        $manettes = Manette::orderBy('id', 'desc')->get();

        return response()->json([
            'count' => $manettes->count(),
            'manettes' => $manettes
        ]);
    }

    /**
     * +addManette()
     */
    public function addManette(Request $request)
    {
        $validated = $request->validate([
            'serial_number' => 'required|string|unique:manettes',
            'status'        => 'string',
        ]);

        $manette = Manette::create($validated);

        return response()->json([
            'message' => 'Manette ajoutée avec succès.',
            'manette' => $manette
        ], 201);
    }

    /**
     * +updateStatus()
     */
    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => 'required|string',
        ]);

        $manette = Manette::findOrFail($id);
        $manette->update(['status' => $validated['status']]);

        return response()->json([
            'message' => 'Statut mis à jour.',
            'manette' => $manette
        ]);
    }

    /**
     * +removeController()
     */
    public function removeController($id)
    {
        $manette = Manette::findOrFail($id);
        $manette->delete();

        return response()->json([
            'message' => 'Manette supprimée avec succès.'
        ]);
    }

    /**
     * listAvailableManettes()
     */
    public function listAvailableManettes()
    {
        $manettes = Manette::where('status', 'available')->get();

        return response()->json([
            'count' => $manettes->count(),
            'manettes' => $manettes
        ]);
    }
}
