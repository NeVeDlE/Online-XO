<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});
Broadcast::channel('lobby', function ($user) {
    return $user !== null; // Allow all authenticated users
});

Broadcast::channel('games.{id}', function ($user, $id) {
    return \App\Models\Game::where('id', $id)
        ->where(function ($query) use ($user) {
            $query->where('player_one_id', $user->id)
                ->orWhere('player_two_id', $user->id);
        })->exists(); // Only allow players in the game to join
});
