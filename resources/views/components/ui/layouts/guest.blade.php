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
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-6 sm:mb-8">
                @isset($logo)
                    {{ $logo }}
                @else
                    <a href="/" wire:navigate class="flex items-center gap-2.5">
                        <x-application-logo class="w-10 h-10 fill-current text-primary" />
                        <span class="text-ui-xl font-bold text-foreground dark:text-foreground-dark hidden sm:inline">{{ config('app.name') }}</span>
                    </a>
                @endisset
            </div>

            <div class="w-full sm:max-w-md">
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark shadow-ui-lg rounded-ui-2xl px-6 py-8 sm:px-8">
                    {{ $slot }}
                </div>
            </div>

            @isset($footer)
                <div class="mt-6 text-center">
                    {{ $footer }}
                </div>
            @endisset
        </div>

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
