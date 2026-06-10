<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(RouteServiceProvider::HOME, navigate: true);
    }
}; ?>

<div>
    <x-ui.heading level="h2" size="xl" class="mb-6">Create Account</x-ui.heading>

    <form wire:submit="register" class="space-y-5">
        <x-ui.form-group label="Name" name="name" :error="$errors->first('name')" required>
            <x-ui.input type="text" name="name" wire:model="name" placeholder="John Doe" required autofocus autocomplete="name" />
        </x-ui.form-group>

        <x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
            <x-ui.input type="email" name="email" wire:model="email" placeholder="you@example.com" required autocomplete="username" />
        </x-ui.form-group>

        <x-ui.form-group label="Password" name="password" :error="$errors->first('password')" required>
            <x-ui.input type="password" name="password" wire:model="password" placeholder="Min. 8 characters" required autocomplete="new-password" />
        </x-ui.form-group>

        <x-ui.form-group label="Confirm Password" name="password_confirmation" :error="$errors->first('password_confirmation')" required>
            <x-ui.input type="password" name="password_confirmation" wire:model="password_confirmation" placeholder="Repeat your password" required autocomplete="new-password" />
        </x-ui.form-group>

        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('login') }}" wire:navigate class="text-ui-sm font-medium text-primary hover:text-primary-hover transition-colors duration-150">
                {{ __('Already registered?') }}
            </a>

            <x-ui.button type="submit" size="md">
                {{ __('Register') }}
            </x-ui.button>
        </div>
    </form>
</div>
