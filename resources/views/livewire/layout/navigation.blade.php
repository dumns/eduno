<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component {
    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center gap-8">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('courses') }}" wire:navigate>
                        <x-application-logo class="block h-9 w-auto fill-current text-primary dark:text-primary-light" />
                    </a>
                </div>

                <div class="hidden sm:flex items-center gap-1">
                    <x-nav-link :href="route('courses')" :active="request()->routeIs('courses')" wire:navigate>
                        {{ __('Courses') }}
                    </x-nav-link>
                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:gap-3">
                @auth
                    <x-ui.dropdown align="right" width="56">
                        <x-slot name="trigger">
                            <button type="button" class="inline-flex items-center gap-2 px-3 py-2 text-ui-sm font-medium text-foreground dark:text-foreground-dark bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-lg hover:bg-gray-50 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                                <div x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name" x-on:profile-updated.window="name = $event.detail.name"></div>
                                <x-ui.icon name="chevron-down" size="xs" />
                            </button>
                        </x-slot>

                        <x-ui.dropdown-item :href="route('profile')" icon="user" wire:navigate>
                            {{ __('Profile') }}
                        </x-ui.dropdown-item>

                        <div class="border-t border-border dark:border-border-dark my-1"></div>

                        <button wire:click="logout" class="w-full text-start">
                            <x-ui.dropdown-item icon="close" variant="danger">
                                {{ __('Log Out') }}
                            </x-ui.dropdown-item>
                        </button>
                    </x-ui.dropdown>
                @endauth

                @guest
                    <x-ui.button href="{{ route('login') }}" variant="ghost" size="sm">
                        Sign In
                    </x-ui.button>
                    <x-ui.button href="{{ route('register') }}" size="sm">
                        Get Started
                    </x-ui.button>
                @endguest
            </div>

            <div class="flex items-center sm:hidden">
                <button @click="open = !open" type="button" class="p-2 rounded-ui-lg text-muted dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary transition-all duration-150">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1 px-4">
            <x-responsive-nav-link :href="route('courses')" :active="request()->routeIs('courses')" wire:navigate>
                {{ __('Courses') }}
            </x-responsive-nav-link>
        </div>

        @auth
            <div class="pt-4 pb-1 border-t border-border dark:border-border-dark">
                <div class="px-4">
                    <div class="font-medium text-ui-base text-foreground dark:text-foreground-dark"
                        x-data="{{ json_encode(['name' => auth()->user()->name]) }}" x-text="name"
                        x-on:profile-updated.window="name = $event.detail.name"></div>
                    <div class="font-medium text-ui-sm text-muted dark:text-muted-dark">{{ auth()->user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('profile')" wire:navigate>
                        {{ __('Profile') }}
                    </x-responsive-nav-link>
                    <button wire:click="logout" class="w-full text-start">
                        <x-responsive-nav-link>
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </button>
                </div>
            </div>
        @endauth

        @guest
            <div class="pt-4 pb-1 border-t border-border dark:border-border-dark">
                <div class="mt-3 space-y-1 px-4">
                    <x-responsive-nav-link :href="route('login')" wire:navigate>
                        {{ __('Sign In') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('register')" wire:navigate>
                        {{ __('Register') }}
                    </x-responsive-nav-link>
                </div>
            </div>
        @endguest
    </div>
</nav>
