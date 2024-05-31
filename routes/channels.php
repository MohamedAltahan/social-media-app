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
|callback function receives the authenticated user by default
| $id is the parameter of like_channel.X
*/




//condition for authentication to access the channel

Broadcast::channel('notify_channel.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
