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
    <body class="font-sans antialiased bg-gradient-to-br from-surface to-gray-50 dark:from-background-dark dark:to-gray-900 text-foreground dark:text-foreground-dark">
        <div class="min-h-screen flex flex-col items-center justify-center px-4 py-8">
            <div class="w-full max-w-md">
                <div class="flex justify-center mb-8">
                    <a href="/"
                       @click="if (window.innerWidth < 768) $event.preventDefault()">
                        <x-application-logo class="h-10 w-auto" />
                    </a>
                </div>

                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-2xl shadow-sm px-6 py-8 sm:px-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        @filamentScripts
        @vite('resources/js/app.js')
    </body>
</html>
