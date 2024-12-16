<div class="justify-items-center">

    <h1 class="text-xl font-bold py-2 px-2">Game #{{ $game->id }}</h1>
    <p class="py-2 px-2">Player 1: {{ $game->player_one->name }}</p>
    <p class="py-2 px-2">Player 2: {{ $game->player_two?->name ?? 'Waiting for player...' }}</p>
    @isset($this->message)
        <p class="py-2 px-2">Message: {{ $this->message }}</p>
    @endisset
    @if(session('error'))
        <p class="text-red-500">{{ session('error') }}</p>
    @endif
    @if(!isset($this->game->winner_id))
        <div class="board">
            @foreach($state as $index => $value)
                <div class="cell" wire:click="makeMove({{ $index}},{{\Illuminate\Support\Facades\Auth::id() }})"><span
                        class="xo    @if($value==1)o
                    @elseif($value==-1)x
                    @else -
                    @endif ">
                @if($value==1)
                            O
                        @elseif($value==-1)
                            X
                        @else
                            -
                        @endif
            </span></div>
            @endforeach
        </div>

        <div class="mt-4 pt-2">
            <p>Current Turn: {{ $game->player_turn === 1 ? 'Player 1 (O)' : 'Player 2 (X)' }}</p>
        </div>
        @else
        <div class="mt-4 pt-2">
            @if($this->game->winner_id!=0)
            <p>Winner is: {{ $this->game?->winner->name}}</p>
            @else
                <p>Dead Case There's no Winner</p>
            @endif
        </div>
        @endif
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Echo.private(`game.${@json($game->id)}`)
            .listen('GameUpdated', (event) => {
                console.log('Game updated:', event.game);
                Livewire.dispatch('refreshGame'); // Trigger Livewire component refresh
            })
            .listen('GameJoined', (event) => {
                console.log('Game joined:',event.game);
                Livewire.dispatch('refreshGame'); // Refresh game list
            });

    });

</script>
</div>
