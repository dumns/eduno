<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name') }}</title>

        <style>[x-cloak] { display: none !important; }</style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased bg-surface dark:bg-background-dark">
        @if (Route::has('login'))
            <livewire:welcome.navigation />
        @endif

        <div class="relative min-h-screen flex flex-col items-center justify-center px-4 py-16">
            <div class="max-w-4xl mx-auto text-center">
                <div class="flex justify-center mb-8">
                    <x-application-logo class="h-20 w-auto fill-current text-primary" />
                </div>

                <x-ui.heading level="h1" size="4xl" weight="bold" class="mb-4">
                    Welcome to {{ config('app.name') }}
                </x-ui.heading>

                <x-ui.text size="lg" color="muted" class="max-w-2xl mx-auto mb-10">
                    Your comprehensive learning management system. Start your journey today.
                </x-ui.text>

                <div class="flex items-center justify-center gap-4">
                    @if (Route::has('login'))
                        @auth
                            <x-ui.button href="{{ url('/dashboard') }}" size="lg">
                                Dasbor
                            </x-ui.button>
                        @else
                            <x-ui.button href="{{ route('login') }}" size="lg">
                                Masuk
                            </x-ui.button>
                            @if (Route::has('register'))
                                <x-ui.button href="{{ route('register') }}" variant="outline" size="lg">
                                    Daftar
                                </x-ui.button>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <div class="mt-20 grid grid-cols-1 md:grid-cols-3 gap-6 max-w-5xl mx-auto w-full">
                <x-ui.card variant="elevated" padding="lg" class="text-center">
                    <x-slot:header>
                        <div class="mx-auto p-3 rounded-ui-xl bg-primary-light dark:bg-primary-dark/30">
                            <x-ui.icon name="book" size="lg" class="text-primary dark:text-primary-light" />
                        </div>
                    </x-slot:header>
                    <x-ui.heading level="h3" size="lg" class="mb-2">Structured Courses</x-ui.heading>
                    <x-ui.text size="sm" color="muted">Well-organized courses with progressive learning paths designed for effective skill building.</x-ui.text>
                </x-ui.card>

                <x-ui.card variant="elevated" padding="lg" class="text-center">
                    <x-slot:header>
                        <div class="mx-auto p-3 rounded-ui-xl bg-success-light dark:bg-success/20">
                            <x-ui.icon name="check-badge" size="lg" class="text-success" />
                        </div>
                    </x-slot:header>
                    <x-ui.heading level="h3" size="lg" class="mb-2">Interactive Quizzes</x-ui.heading>
                    <x-ui.text size="sm" color="muted">Test your knowledge with interactive quizzes and track your progress over time.</x-ui.text>
                </x-ui.card>

                <x-ui.card variant="elevated" padding="lg" class="text-center">
                    <x-slot:header>
                        <div class="mx-auto p-3 rounded-ui-xl bg-warning-light dark:bg-warning/20">
                            <x-ui.icon name="star" size="lg" class="text-warning" />
                        </div>
                    </x-slot:header>
                    <x-ui.heading level="h3" size="lg" class="mb-2">Expert Instructors</x-ui.heading>
                    <x-ui.text size="sm" color="muted">Learn from industry experts who bring real-world experience to every lesson.</x-ui.text>
                </x-ui.card>
            </div>

            <div class="mt-16 text-center text-ui-sm text-muted dark:text-muted-dark">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </div>
        </div>

        @vite('resources/js/app.js')
    </body>
</html>
