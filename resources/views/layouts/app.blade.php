<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <style>
            .board {
                display: grid;
                grid-template-columns: repeat(3, 1fr);
                grid-template-rows: repeat(3, 1fr);
                gap: 5px;
                width: 90vw;
                max-width: 300px;
                height: 90vw;
                max-height: 300px;
                aspect-ratio: 1;
            }

            .cell {
                width: 100%;
                height: 100%;
                display: flex;
                justify-content: center;
                align-items: center;
                position: relative;
                background-color: transparent;
            }

            .cell::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                border: 2px solid rgba(255, 255, 255, 0.3);
                box-shadow: 0 0 5px rgba(255, 255, 255, 0.3);
                border-radius: 10px;
            }

            .xo {
                font-size: 4vw;
                font-family: Arial, sans-serif;
                color: transparent;
                text-shadow: 0 0 5px #fff, 0 0 10px #fff, 0 0 20px, 0 0 30px, 0 0 40px;
            }

            .x {
                color: #ff00ff;
                text-shadow: 0 0 8px #ff00ff, 0 0 15px #ff00ff, 0 0 20px #ff00ff, 0 0 25px #ff00ff;
            }

            .o {
                color: #00ffff;
                text-shadow: 0 0 8px #00ffff, 0 0 15px #00ffff, 0 0 20px #00ffff, 0 0 25px #00ffff;
            }
        </style>

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
            <livewire:layout.navigation />

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-gray-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
<script>
    window.Echo.channel('test-channel') // Replace 'test-channel' with your actual channel
        .listen('.test-event', (e) => {
            console.log('Event received:', e.message);
        });
</script>
</html>
