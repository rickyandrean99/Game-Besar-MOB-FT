<?php

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

Broadcast::channel('App.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('privatequest.{receiver_id}', function ($user, $receiver_id) {
    return auth()->check();
});

Broadcast::channel('send-gift.{receiver_id}', function ($user, $receiver_id) {
    return auth()->check();
});

Broadcast::channel('update-hitpoint.{receiver_id}', function ($user, $receiver_id) {
    return auth()->check();
});

Broadcast::channel('buy-material.{receiver_id}', function ($user, $receiver_id) {
    return auth()->check();
});

