<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::with('consoles')->get();
        return response()->json($games);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'genre' => 'required|string|max:255',
            'image' => 'nullable|string|max:255',
            'console_ids' => 'array',
        ]);

        $game = Game::create([
            'title' => $validated['title'],
            'genre' => $validated['genre'],
            'image' => $validated['image'] ?? null,
        ]);

        // if (isset($validated['console_ids'])) {
        //     $game->consoles()->attach($validated['console_ids']);
        // }

        return response()->json([
            'message' => 'Jeu créé avec succès',
            'game' => $game->load('consoles'),
        ], 201);
    }

    public function show(Game $game)
    {
        return response()->json($game->load('consoles'));
    }

    public function update(Request $request, Game $game)
    {
        $validated = $request->validate([
            'title' => 'string|max:255',
            'genre' => 'string|max:255',
            'image' => 'nullable|string|max:255',
            'console_ids' => 'array',
            // insiste que ces id dans table consoles
            'console_ids.*' => 'exists:consoles,id',
        ]);

        $game->update([
            'title' => $validated['title'] ?? $game->title,
            'genre' => $validated['genre'] ?? $game->genre,
            'image' => $validated['image'] ?? $game->image,
        ]);

        // if (isset($validated['console_ids'])) {
        //     $game->consoles()->sync($validated['console_ids']);
        // }

        return response()->json([
            'message' => 'Jeu mis à jour avec succès',
            'game' => $game->load('consoles'),
        ]);
    }

    public function destroy(Game $game)
    {
        $game->delete();

        return response()->json([
            'message' => 'Jeu supprimé avec succès',
        ]);
    }
}
