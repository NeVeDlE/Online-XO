<?php

namespace App\Livewire;

use App\Events\GameCreated;
use App\Events\GameJoined;
use App\Events\GameUpdated;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class GamesDashboard extends Component
{
    use WithPagination;
    protected $listeners = ['refreshGames'];

    public function refreshGames()
    {
        $this->render(); // Refresh the games list
    }

    public function render()
    {
        $games = Game::with('player_one')
            ->whereNull('player_two_id')
            ->where('player_one_id', '!=', Auth::id())
            ->oldest()
            ->simplePaginate(100);

        return view('livewire.games-dashboard', compact('games'));
    }

    public function createGame()
    {
        // Create a new game with the current user as player one
        $game = Game::create([
            'player_one_id' => Auth::id(),
            'state' => array_fill(0, 9, 0), // Initialize empty game state
        ]);
        // Redirect to the game page after creation
      broadcast(new GameCreated($game))->toOthers();

        return redirect()->route('games.show', ['game' => $game->id]);
    }

    public function joinGame($gameId)
    {
        $game = Game::findOrFail($gameId);

        if ($game->player_two_id) {
            return;
        }

        $game->update(['player_two_id' => Auth::id()]);

        // Broadcast the GameJoined event
        broadcast(new GameUpdated($game))->toOthers();

        return redirect()->route('games.show', ['game' => $game->id]);
    }

}
