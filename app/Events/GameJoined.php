<?php

namespace App\Events;

use App\Models\Game;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class GameJoined implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
    public Game $game;

    public function __construct(Game $game)
    {
        $this->game = $game;
    }

    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('lobby'), // Lobby channel
        ];
    }

    public function broadcastWith(): array
    {
        return [
            'game' => $this->game, // Include game data
        ];
    }
}
