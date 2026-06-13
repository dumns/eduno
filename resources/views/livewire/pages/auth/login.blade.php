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

        if (auth()->user()->is_admin) {
            $this->redirect('/admin', navigate: true);
            return;
        }

        $intended = session('url.intended');
        $intendedPath = $intended ? parse_url($intended, PHP_URL_PATH) : null;
        if ($intendedPath && !str_starts_with($intendedPath, '/admin')) {
            $this->redirect($intended, navigate: true);
            return;
        }

        $this->redirect('/dashboard', navigate: true);
    }
}; ?>

<div>
    <div class="text-center mb-8">
        <h2 class="text-2xl font-bold text-foreground dark:text-foreground-dark">Welcome Back</h2>
        <p class="text-ui-sm text-muted dark:text-muted-dark mt-1">Sign in to continue your learning journey</p>
    </div>

    <form wire:submit="login" class="space-y-5">
        <x-ui.form-group label="Email" name="email" :error="$errors->first('form.email')" required>
            <x-ui.input type="email" name="email" wire:model="form.email" placeholder="you@example.com" required autofocus autocomplete="username" />
        </x-ui.form-group>

        <x-ui.form-group label="Password" name="password" :error="$errors->first('form.password')" required>
            <x-ui.input type="password" name="password" wire:model="form.password" placeholder="Enter your password" required autocomplete="current-password" />
        </x-ui.form-group>

        <div class="flex items-center justify-between">
            <x-ui.checkbox name="remember" wire:model="form.remember" label="Remember me" />
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" wire:navigate class="text-ui-sm font-medium text-primary hover:text-primary-hover transition-colors duration-150">
                    {{ __('Forgot your password?') }}
                </a>
            @endif
        </div>

        <x-ui.button type="submit" size="md" class="w-full justify-center">
            {{ __('Sign In') }}
        </x-ui.button>
    </form>

    <p class="mt-6 text-center text-ui-sm text-muted dark:text-muted-dark">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}" wire:navigate class="font-semibold text-primary hover:text-primary-hover transition-colors duration-150">
            {{ __('Create one now') }}
        </a>
    </p>
</div>
