<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(){
        $notifications = Notification::where('user_id', Auth::id())
            ->latest()
            ->get();

        return response()->json([
            'message' => 'Notifications récupérées avec succès.',
            'data' => $notifications
        ], 200);
    }

    public function store(Request $request){
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'title' => 'required|string|max:255',
            'message' => 'required|string',
            'type' => 'nullable|string|max:100',
        ]);

        $notification = Notification::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'message' => $request->message,
            'type' => $request->type,
            'is_read' => false,
        ]);

        return response()->json([
            'message' => 'Notification créée avec succès.',
            'data' => $notification,
        ], 201);
    }


    public function markAsRead($id)
    {
        $notification = Notification::where('user_id', Auth::id())->findOrFail($id);

        $notification->update([
            'is_read' => true,
        ]);

        return response()->json([
            'message' => 'Notification marquée comme lue.',
            'data' => $notification,
        ], 200);
    }
}
