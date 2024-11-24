<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('orders.{userId}', function ($user, $id) {
    return (int) $user->user_id === (int) $id;
});

Broadcast::channel('user.{userId}', function ($user, $userId){
    return (int) $user->user_id === (int) $userId;
});

Broadcast::channel('order-status.{userId}', function ($user, $userId){
    return (int) $user->user_id === (int) $userId;
});

Broadcast::channel('admin-cancel-order', function ($user){
    return $user->role && in_array($user->role->role_name, ['admin', 'user']);
});

Broadcast::channel('chat.{receiverId}', function ($user, $receiverId){
    return (int) $user->user_id === (int) $receiverId || $user->isManager();
});


Broadcast::channel('wishlist.{userId}', function ($user) {
    return $user !== null;
});



