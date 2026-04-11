<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index(Request $request, $userId)
    {
        $user = $request->user();
        $authId = $user->id;

        // B2C LOGIC : Si c'est un client, on force la discussion vers l'admin
        // Peu importe ce qui est écrit dans le {userId} de l'URL
        if ($user->role === 'client') {
            $admin = User::where('role', 'admin')->first();
            $userId = $admin->id;
        }

        $messages = Message::where(function ($query) use ($authId, $userId) {
            $query->where('sender_id', $authId)->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($authId, $userId) {
            $query->where('sender_id', $userId)->where('receiver_id', $authId);
        })
        ->orderBy('created_at', 'asc')
        ->get();

        return response()->json($messages);
    }

    public function store(Request $request, $userId)
    {
        $validated = $request->validate([
            'message' => 'required|string',
        ]);

        $user = $request->user();

        // B2C LOGIC : Si c'est un client qui envoie, le message part à l'admin
        if ($user->role === 'client') {
            $admin = User::where('role', 'admin')->first();
            $userId = $admin->id;
        }

        $message = Message::create([
            'sender_id' => $user->id,
            'receiver_id' => $userId,
            'message' => $validated['message'],
        ]);

        return response()->json([
            'message' => 'Message envoyé avec succès',     
            'data' => $message,
        ], 201);
    }
}
