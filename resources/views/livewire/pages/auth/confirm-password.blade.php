<?php

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $password = '';

    public function confirmPassword(): void
    {
        $this->validate(['password' => ['required', 'string']]);

        if (!Auth::guard('web')->validate([
            'email' => Auth::user()->email,
            'password' => $this->password,
        ])) {
            throw ValidationException::withMessages([
                'password' => __('auth.password'),
            ]);
        }

        session(['auth.password_confirmed_at' => time()]);

        $this->redirect(
            session('url.intended', RouteServiceProvider::HOME),
            navigate: true
        );
    }
}; ?>

<div>
    <x-ui.heading level="h2" size="xl" class="mb-3">Confirm Password</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-6">
        This is a secure area. Please confirm your password before continuing.
    </x-ui.text>

    <form wire:submit="confirmPassword" class="space-y-5">
        <x-ui.form-group label="Password" name="password" :error="$errors->first('password')" required>
            <x-ui.input type="password" name="password" wire:model="password" required autocomplete="current-password" />
        </x-ui.form-group>

        <div class="flex justify-end">
            <x-ui.button type="submit" size="md">Confirm</x-ui.button>
        </div>
    </form>
</div>
