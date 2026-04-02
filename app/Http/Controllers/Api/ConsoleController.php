<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Console;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConsoleController extends Controller
{
    public function index()
    {
        $consoles = Console::with('games')->get();
        return response()->json($consoles);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'daily_price' => 'required|numeric|min:0',
            'ability' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('consoles', 'public');
        }

        $validated['ability'] = $validated['ability'] ?? true;

        $console = Console::create($validated);

        return response()->json([
            'message' => 'Console créée avec succès',
            'console' => $console,
        ], 201);
    }

    public function show(Console $console)
    {
        return response()->json($console->load('games'));
    }

    public function update(Request $request, Console $console)
    {
        $validated = $request->validate([
            'name' => 'string|max:255',
            'brand' => 'string|max:255',
            'daily_price' => 'numeric|min:0',
            'ability' => 'nullable|boolean',
            'image' => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($console->image) {
                Storage::disk('public')->delete($console->image);
            }
            $validated['image'] = $request->file('image')->store('consoles', 'public');
        }

        $console->update($validated);

        return response()->json([
            'message' => 'Console mise à jour avec succès',
            'console' => $console,
        ]);
    }

    public function destroy(Console $console)
    {
        if ($console->image) {
            Storage::disk('public')->delete($console->image);
        }

        $console->delete();

        return response()->json([
            'message' => 'Console supprimée avec succès',
        ]);
    }
}
