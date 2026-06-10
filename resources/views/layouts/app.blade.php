<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="application-name" content="{{ config('app.name') }}">

        <title>{{ config('app.name') }} @isset($header) - {{ $header }} @endisset</title>

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface dark:bg-background-dark text-foreground dark:text-foreground-dark">
        <div class="min-h-screen flex flex-col">
            <livewire:layout.navigation />

            @if (isset($header))
                <header class="bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4 sm:py-6">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <main class="flex-1">
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                    {{ $slot }}
                </div>
            </main>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>
