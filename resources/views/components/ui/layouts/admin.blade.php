<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="application-name" content="{{ config('app.name') }}">

        <title>{{ config('app.name') }} @isset($title) - {{ $title }} @endisset</title>

        <style>[x-cloak] { display: none !important; }</style>

        @filamentStyles
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface dark:bg-background-dark">
        <div class="flex h-screen overflow-hidden">
            @isset($sidebar)
                {{ $sidebar }}
            @endisset

            <div class="flex-1 flex flex-col overflow-hidden">
                @isset($navbar)
                    {{ $navbar }}
                @endisset

                <main class="flex-1 overflow-y-auto px-4 sm:px-6 lg:px-8 py-6 sm:py-8">
                    {{ $slot }}
                </main>
            </div>
        </div>

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
