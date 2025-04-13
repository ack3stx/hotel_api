<?php

use Illuminate\Support\Facades\Broadcast;
use App\Models\User;


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

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

Broadcast::channel('Huesped', function ($user) {
    if ($user->rol === '1' || $user->estado === 'ban' || $user->estado === 'inactivo') {
        Log::warning('Usuario restringido intentó conectarse al canal Huesped', [
            'user_id' => $user->id,
            'rol' => $user->rol,
            'estado' => $user->estado
        ]);
        return false;
    }
    
    return [
        'id' => $user->id,
    ];
});