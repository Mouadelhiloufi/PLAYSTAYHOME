<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index(Request $request){
        $notifications = $request->user()->notifications()->latest()->get()->map(function ($notification) {
            $notification->diff_human = $notification->created_at->diffForHumans();
            return $notification;
        });

        return response()->json([
            'message' => 'Notifications récupérées avec succès.',
            'data' => $notifications
        ], 200);
    }

    // public function markAsRead(Request $request, $id)
    // {
    //     $notification = $request->user()->notifications()->findOrFail($id);

    //     $notification->markAsRead();

    //     return response()->json([
    //         'message' => 'Notification marquée comme lue.',
    //         'data' => $notification,
    //     ], 200);
    // }
}
