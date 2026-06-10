<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta name="application-name" content="{{ config('app.name') }}">

        <link rel="icon" type="image/svg+xml" href="{{ asset('assets/logo/cakrawala-icon.svg') }}">

        <title>{{ config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>

        @filamentStyles
        @vite('resources/css/app.css')
    </head>
    <body class="font-sans antialiased bg-surface dark:bg-background-dark text-foreground dark:text-foreground-dark">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 px-4">
            <div class="mb-6 sm:mb-8">
                <a href="/" wire:navigate class="flex items-center justify-center">
                    <x-application-logo class="h-10 w-auto" />
                </a>
            </div>

            <div class="w-full sm:max-w-md">
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl px-6 py-8 sm:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
