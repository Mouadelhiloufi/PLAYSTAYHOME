<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;

Broadcast::routes(['middleware' => ['auth:sanctum']]);

Broadcast::channel('chat.{userId}', function (User $user, $userId) {
    return $user->role === 'admin' || (int) $user->id === (int) $userId;
});
