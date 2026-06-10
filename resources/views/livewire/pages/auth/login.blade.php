<?php

use App\Livewire\Forms\LoginForm;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;

    public function login(): void
    {
        $this->validate();
        $this->form->authenticate();
        Session::regenerate();
        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<div>
    <x-ui.alert type="info" :dismissible="true" class="mb-4" :icon="false">
        <x-slot:title>Welcome Back</x-slot:title>
        Sign in to continue your learning journey.
    </x-ui.alert>

    <x-ui.heading level="h2" size="xl" class="mb-6">Sign In</x-ui.heading>

    <form wire:submit="login" class="space-y-5">
        <x-ui.form-group label="Email" name="email" :error="$errors->first('form.email')" required>
            <x-ui.input type="email" name="email" wire:model="form.email" placeholder="you@example.com" required autofocus autocomplete="username" />
        </x-ui.form-group>

        <x-ui.form-group label="Password" name="password" :error="$errors->first('form.password')" required>
            <x-ui.input type="password" name="password" wire:model="form.password" placeholder="Enter your password" required autocomplete="current-password" />
        </x-ui.form-group>

        <div class="flex items-center justify-between">
            <x-ui.checkbox name="remember" wire:model="form.remember" label="Remember me" />
        </div>

        <div class="flex items-center justify-end gap-4">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-ui-sm font-medium text-primary hover:text-primary-hover transition-colors duration-150">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-ui.button type="submit" size="md">
                {{ __('Log in') }}
            </x-ui.button>
        </div>
    </form>
</div>
