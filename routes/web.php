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

Route::get('/broadcast-test', function () {
    event(new \App\Events\TestEvent('This is a test broadcast!'));
    return 'Broadcast event dispatched';
});

require __DIR__ . '/auth.php';
