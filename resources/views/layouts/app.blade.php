<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'Expensir') }}</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/png">
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @once <script src="//unpkg.com/alpinejs" defer></script> @endonce
    </head>
    <body class="antialiased">
        <div class="app-wrapper"> {{-- Flex container for sticky footer --}}
            @include('layouts.navigation')
            <div class="app-container"> {{-- Max-width container --}}
                <main class="app-main-content"> {{-- This part will grow --}}
                    @yield('content')
                </main>
            </div>
             {{-- Footer moved outside app-container, directly within app-wrapper --}}
            <footer class="app-footer">
                <p>© {{ date('Y') }} Expensir ∣ All rights reserved.</p>
            </footer>
        </div>
    </body>
</html>