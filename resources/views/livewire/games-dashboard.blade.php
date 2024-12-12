<div>
    <button wire:click="createGame" class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent
    rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white
    focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
        Create A Game
    </button>
    <h1 class="px-6 py-6">Available Games</h1>
    <ul>
        @foreach($games as $game)
            <li>

                Game #{{ $game->id }} by {{ $game->player_one->name }}
                <button class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent
    rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white
    focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500
    focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150"
                        wire:click="joinGame({{ $game->id }})">Join
                </button>
            </li>
        @endforeach
    </ul>

    {{ $games->links() }}

</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Echo.private('lobby')
            .listen('GameCreated', (event) => {
                console.log('Game created:', event.game);
                Livewire.emit('refreshGames'); // Refresh game list
            })
            .listen('GameJoined', (event) => {
                console.log('Game joined:', event.game);
                Livewire.emit('refreshGames'); // Refresh game list
            });
    });

</script>
