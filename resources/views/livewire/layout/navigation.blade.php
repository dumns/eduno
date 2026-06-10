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

<header class="sticky top-0 z-50 bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark">
    <div class="grid grid-cols-2 md:grid-cols-3 items-center h-16 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-start">
            <div class="flex items-center gap-2.5">
                <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center">
                    <x-application-logo class="h-9 w-auto fill-current text-primary dark:text-primary-light" />
                </a>
                <h1 class="m-0">
                    <span class="text-ui-base font-bold text-foreground dark:text-foreground-dark whitespace-nowrap">Eduno</span>
                </h1>
            </div>
        </div>

        <div class="hidden md:flex items-center justify-center">
            <nav>
                <ul class="flex items-center gap-1 list-none m-0 p-0">
                    <li class="{{ request()->routeIs('dashboard') ? '' : '' }}">
                        <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center gap-1.5 px-3 py-2 text-ui-sm font-medium rounded-ui-lg transition-all duration-150 {{ request()->routeIs('dashboard') ? 'bg-gray-100 dark:bg-gray-800 text-foreground dark:text-foreground-dark' : 'text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800' }}">
                            <span class="inline-flex items-center">
                                <i class="za-house-duotone w-5 h-5"></i>
                            </span>
                            <span>Beranda</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center gap-1.5 px-3 py-2 text-ui-sm font-medium rounded-ui-lg transition-all duration-150 text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800">
                            <span class="inline-flex items-center">
                                <i class="za-file-text-duotone w-5 h-5"></i>
                            </span>
                            <span class="whitespace-nowrap">Timeline &amp; Berita</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center gap-1.5 px-3 py-2 text-ui-sm font-medium rounded-ui-lg transition-all duration-150 text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800">
                            <span class="inline-flex items-center">
                                <i class="za-chat-dots-duotone w-5 h-5"></i>
                            </span>
                            <span>Obrolan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('dashboard') }}" wire:navigate class="inline-flex items-center gap-1.5 px-3 py-2 text-ui-sm font-medium rounded-ui-lg transition-all duration-150 text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800">
                            <span class="inline-flex items-center">
                                <i class="za-compass-duotone w-5 h-5"></i>
                            </span>
                            <span>Jelajah</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>

        <div class="flex items-center justify-end gap-2">
            @auth
                <x-ui.tooltip text="Support" position="bottom" class="hidden xl:inline-flex">
                    <a href="#" class="inline-flex items-center justify-center w-10 h-10 text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-ui-lg transition-all duration-150">
                        <i class="za-life-ring-duotone w-5 h-5"></i>
                    </a>
                </x-ui.tooltip>

                <x-ui.tooltip text="Notifikasi" position="bottom">
                    <x-ui.dropdown align="right" width="64">
                        <x-slot name="trigger">
                            <button type="button" class="relative inline-flex items-center justify-center w-10 h-10 text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800 rounded-ui-lg transition-all duration-150">
                                <x-ui.icon name="bell" size="sm" />
                                <span class="absolute top-2 right-2 w-2 h-2 bg-danger rounded-full"></span>
                            </button>
                        </x-slot>
                    <div class="px-4 py-3 text-ui-sm text-muted dark:text-muted-dark text-center">Tidak ada notifikasi</div>
                </x-ui.dropdown>
                </x-ui.tooltip>

                <div x-data="{ open: false }" class="relative" @click.outside="open = false">
                    <button @click="open = !open" type="button" class="flex items-center gap-2 p-1.5 rounded-ui-xl hover:bg-primary-light/50 dark:hover:bg-primary-dark/20 hover:ring-2 hover:ring-primary/30 transition-all duration-150">
                        <x-ui.avatar src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7c3aed&background=EDE9FE" size="sm" />
                        <span class="hidden lg:block text-start">
                            <span class="block text-ui-sm font-medium text-foreground dark:text-foreground-dark leading-tight">{{ auth()->user()->name }}</span>
                            <span class="block text-ui-xs text-muted dark:text-muted-dark leading-tight">Peserta</span>
                        </span>
                        <x-ui.icon name="chevron-down" size="xs" class="hidden lg:block text-muted dark:text-muted-dark transition-transform duration-200" x-bind:class="{'rotate-180': open}" />
                    </button>
                    <div x-show="open" x-cloak x-transition:enter="transition-all duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95 translate-y-1" x-transition:enter-end="opacity-100 scale-100 translate-y-0" x-transition:leave="transition-all duration-150 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="absolute right-0 top-full mt-2 w-64 z-50 rounded-ui-2xl bg-white dark:bg-surface-dark border border-border dark:border-border-dark shadow-ui-xl overflow-hidden" @click="open = false">
                        {{-- Profile card header --}}
                        <div class="bg-gradient-to-br from-primary/5 to-primary-light/10 dark:from-primary-dark/20 dark:to-primary/5 px-4 py-4">
                            <div class="flex items-center gap-3">
                                <x-ui.avatar src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&color=7c3aed&background=EDE9FE" size="md" />
                                <div class="min-w-0">
                                    <p class="text-ui-sm font-semibold text-foreground dark:text-foreground-dark truncate">{{ auth()->user()->name }}</p>
                                    <p class="text-ui-xs text-muted dark:text-muted-dark truncate">{{ auth()->user()->email }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="py-1">
                            <x-ui.dropdown-item href="{{ route('profile') }}" icon="gear" wire:navigate>Pengaturan Akun</x-ui.dropdown-item>
                            <x-ui.dropdown-item icon="arrow-right" variant="danger" wire:click="logout">Keluar</x-ui.dropdown-item>
                        </div>
                    </div>
                </div>
            @endauth

            @guest
                <x-ui.button href="{{ route('login') }}" variant="ghost" size="sm">Sign In</x-ui.button>
                <x-ui.button href="{{ route('register') }}" size="sm">Get Started</x-ui.button>
            @endguest

            <div x-data="{ mobileOpen: false }" class="md:hidden relative">
                <button @click="mobileOpen = !mobileOpen" type="button" class="p-2 rounded-ui-xl text-muted dark:text-muted-dark hover:bg-gray-100 dark:hover:bg-gray-800 focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all duration-150">
                    <i class="za-menu-bars-duotone h-6 w-6" :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}"></i>
                    <i class="za-xmark-duotone h-6 w-6" :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}"></i>
                </button>
                <div x-show="mobileOpen" x-cloak x-transition:enter="transition-all duration-200 ease-out" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition-all duration-150 ease-in" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="fixed left-4 right-4 top-16 mt-1 bg-white dark:bg-surface-dark rounded-ui-xl ring-1 ring-black/5 dark:ring-white/10 shadow-lg z-50" @click.outside="mobileOpen = false">
                    <div class="py-1">
                        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-ui-sm font-medium text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 rounded-ui-lg" @click="mobileOpen = false">
                            <span class="inline-flex items-center">
                                <i class="za-house-duotone w-[18px] h-[18px]"></i>
                            </span>
                            Beranda
                        </a>
                        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-ui-sm font-medium text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 rounded-ui-lg" @click="mobileOpen = false">
                            <span class="inline-flex items-center">
                                <i class="za-file-text-duotone w-[18px] h-[18px]"></i>
                            </span>
                            Timeline &amp; Berita
                        </a>
                        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-ui-sm font-medium text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 rounded-ui-lg" @click="mobileOpen = false">
                            <span class="inline-flex items-center">
                                <i class="za-chat-dots-duotone w-[18px] h-[18px]"></i>
                            </span>
                            Obrolan
                        </a>
                        <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-ui-sm font-medium text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 rounded-ui-lg" @click="mobileOpen = false">
                            <span class="inline-flex items-center">
                                <i class="za-compass-duotone w-[18px] h-[18px]"></i>
                            </span>
                            Jelajah
                        </a>
                        @auth
                            <div class="border-t border-border dark:border-border-dark my-1"></div>
                            <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-4 py-2.5 text-ui-sm font-medium text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 rounded-ui-lg" @click="mobileOpen = false">
                                <x-ui.icon name="user" size="sm" class="text-muted dark:text-muted-dark" />
                                Profile
                            </a>
                            <div class="border-t border-border dark:border-border-dark my-1"></div>
                            <button wire:click="logout" class="flex items-center gap-3 w-full px-4 py-2.5 text-ui-sm font-medium text-danger hover:bg-danger-light dark:hover:bg-danger/20 rounded-ui-lg">
                                <x-ui.icon name="arrow-right" size="sm" />
                                Keluar
                            </button>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
