<?php

namespace App\Livewire;

use App\Events\GameUpdated;
use App\Models\Game;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use phpDocumentor\Reflection\Types\Boolean;

class GameShow extends Component
{
    public $game;
    public $state;
    public $message;
    protected $listeners = ['refreshGame'];

    public function refreshGame(): void
    {
        $this->game->refresh();
        $this->state = $this->game->state; // Refresh the game state
    }
    public function mount(Game $game)
    {
        $this->game = $game;
        $this->state = $game->state ?? array_fill(0, 9, 0); // Empty board
    }

    public function makeMove($index, $userId)
    {
        $this->game->refresh();
        $this->winner();
        if ($this->state[$index] !== 0) {
            return; // Prevent overwriting a move
        }

        if ($this->game->winner_id) {
            if($this->game->winner_id!=0)  $this->message = "Game Already Done And The Winner Is ".$this->game->winner?->name;
            else $this->message = "Game Already Done";
            return;
        }

        // Example: Player 1 uses 1, Player 2 uses -1
        if ($this->game->player_turn == 1 && $this->game->player_one_id == $userId || $this->game->player_two_id == $userId && $this->game->player_turn == -1) {
            $this->state[$index] = $this->game->player_one_id === auth()->id() ? 1 : -1;
            $this->game->player_turn = $this->game->player_turn == -1 ? 1 : -1;
            $this->game->update(['state' => $this->state,
                'player_turn' => $this->game->player_turn,]);
            broadcast(new GameUpdated($this->game))->toOthers(); // Broadcast game update
            $this->game->refresh();

        } else {
            $this->message = "It's not " . Auth::user()->name . "'s turn";
        }

    }

    protected function winner()
    {
        $arr = array_chunk($this->game->state, 3);
        $this->horizontalWin($arr);
        $this->verticalWin($arr);
        $this->diagonalWin($arr);
        $this->deadCase($arr);
        if(isset($this->game->winner_id)){
            broadcast(new GameUpdated($this->game))->toOthers(); // Broadcast game update
        }
    }


    protected function horizontalWin(array $arr): void
    {
        if ($this->game->winner_id) return;
        for ($row = 0; $row < 3; $row++) {
            if ($arr[$row][0] == $arr[$row][1] && $arr[$row][1] == $arr[$row][2] && $arr[$row][2] == '1') {
                $this->game->winner_id = $this->game->player_one_id;
            } else if ($arr[$row][0] == $arr[$row][1] && $arr[$row][1] == $arr[$row][2] && $arr[$row][2] == '-1') {
                $this->game->winner_id = $this->game->player_two_id;
            }
        }
        if (isset($this->game->winner_id)) {
            $this->game->save();
        }
    }

    protected function verticalWin(array $arr): void
    {
        if ($this->game->winner_id) return;
        for ($col = 0; $col < 3; $col++) {
            if ($arr[0][$col] == $arr[1][$col] && $arr[1][$col] == $arr[2][$col] && $arr[2][$col] == '1') {
                $this->game->winner_id = $this->game->player_one_id;
            } else if ($arr[0][$col] == $arr[1][$col] && $arr[1][$col] == $arr[2][$col] && $arr[2][$col] == '-1') {
                $this->game->winner_id = $this->game->player_two_id;
            }
        }
        if (isset($this->game->winner_id)) {
            $this->game->save();
        }
    }

    protected function diagonalWin(array $arr): void
    {
        if ($this->game->winner_id) return;
        if ($arr[0][0] == $arr[1][1] && $arr[1][1] == $arr[2][2] && $arr[2][2] == '1') {
            $this->game->winner_id = $this->game->player_one_id;
        } else if ($arr[0][2] == $arr[1][1] && $arr[1][1] == $arr[2][0] && $arr[2][0] == '-1') {
            $this->game->winner_id = $this->game->player_two_id;
        }
        if (isset($this->game->winner_id)) {
            $this->game->save();
        }
    }

    protected function deadCase(array $arr): bool
    {
        for($row = 0; $row < 3; $row++) {
            for ($col = 0; $col < 3; $col++) {
                if($arr[$row][$col]==0)return false;
            }
        }
        $this->message="Dead Case";
        $this->game->winner_id = 0;
        $this->game->save();
        return true;
    }

    public function render()
    {
        return view('livewire.game-show');
    }
}
