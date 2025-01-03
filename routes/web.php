<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::middleware(['auth'])->group(function () {
    Route::get('/games', \App\Livewire\GamesDashboard::class)->name('games.index');
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::get('/games/{game}', function (\App\Models\Game $game) {
        return view('game', ['game' => $game]);
    })->name('games.show');
    Route::view('profile', 'profile')
        ->name('profile');
});


Route::get('/test-broadcast', function () {
    broadcast(new \App\Events\TestEvent('Hello from the backend!'));
    return 'Broadcast sent!';
});

require __DIR__ . '/auth.php';
