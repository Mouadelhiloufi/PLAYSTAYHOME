<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Console;
use Illuminate\Http\Request;
use App\Models\Reservation;
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
        $rules = [
            'name' => 'required|string|max:255',
            'brand' => 'required|string|max:255',
            'daily_price' => 'required|numeric|min:0',
            'ability' => 'nullable|boolean',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048';
        } else {
            $rules['image'] = 'nullable|string|max:255';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('consoles', 'public');
        } elseif ($request->filled('image')) {
            $validated['image'] = $request->input('image');
        }

        $validated['ability'] = $validated['ability'] ?? true;

        $console = Console::create($validated);

        return response()->json([
            'message' => 'Console créée avec succès',
            'console' => $console,
        ], 201);
    }


    public function reservedDates($id){

    $blocketDates=[];
    $reservations = Reservation::where('console_id',$id)
    ->where('end_date','>=',now()->toDateString())
    ->get(['start_date','end_date']);

    foreach($reservations as $res){
        $blocketDates[]=[
            'from'=>$res->start_date,
            'to'=>$res->end_date
        ];
    }
    return response()->json($blocketDates);
    }

    public function show(Console $console)
    {
        return response()->json($console->load('games'));
    }

    public function update(Request $request, Console $console)
    {
        $rules = [
            'name' => 'string|max:255',
            'brand' => 'string|max:255',
            'daily_price' => 'numeric|min:0',
            'ability' => 'nullable|boolean',
        ];

        if ($request->hasFile('image')) {
            $rules['image'] = 'image|max:2048';
        } elseif ($request->filled('image')) {
            $rules['image'] = 'string|max:255';
        }

        $validated = $request->validate($rules);

        if ($request->hasFile('image')) {
            if ($console->image) {
                Storage::disk('public')->delete($console->image);
            }
            $validated['image'] = $request->file('image')->store('consoles', 'public');
        } elseif ($request->filled('image')) {
            $validated['image'] = $request->input('image');
        }

        $console->update($validated);

        return response()->json([
            'message' => 'Console mise à jour avec succès',
            'console' => $console,
        ]);
    }

    public function syncGames(Request $request, Console $console)
    {
        $validated = $request->validate([
            'game_ids' => 'array',
            // insiste que ces id dans table games
            'game_ids.*' => 'exists:games,id',
        ]);
        

        $gameIds = $validated['game_ids'] ?? [];
        $console->games()->sync($gameIds);

        return response()->json([
            'message' => 'Jeux associes avec succes',
            'console' => $console->load('games'),
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
