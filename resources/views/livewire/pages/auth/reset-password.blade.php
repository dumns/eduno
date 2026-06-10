<?php

use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    #[Locked]
    public string $token = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function mount(string $token): void
    {
        $this->token = $token;
        $this->email = request()->string('email');
    }

    public function resetPassword(): void
    {
        $this->validate([
            'token' => ['required'],
            'email' => ['required', 'string', 'email'],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $status = Password::reset(
            $this->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) {
                $user->forceFill([
                    'password' => Hash::make($this->password),
                    'remember_token' => Str::random(60),
                ])->save();
                event(new PasswordReset($user));
            }
        );

        if ($status != Password::PASSWORD_RESET) {
            $this->addError('email', __($status));
            return;
        }

        Session::flash('status', __($status));
        $this->redirectRoute('login', navigate: true);
    }
}; ?>

<div>
    <x-ui.heading level="h2" size="xl" class="mb-6">Reset Password</x-ui.heading>

    <form wire:submit="resetPassword" class="space-y-5">
        <x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
            <x-ui.input type="email" name="email" wire:model="email" required autofocus autocomplete="username" />
        </x-ui.form-group>

        <x-ui.form-group label="New Password" name="password" :error="$errors->first('password')" required>
            <x-ui.input type="password" name="password" wire:model="password" required autocomplete="new-password" />
        </x-ui.form-group>

        <x-ui.form-group label="Confirm Password" name="password_confirmation" :error="$errors->first('password_confirmation')" required>
            <x-ui.input type="password" name="password_confirmation" wire:model="password_confirmation" required autocomplete="new-password" />
        </x-ui.form-group>

        <div class="flex items-center justify-end">
            <x-ui.button type="submit" size="md">
                Reset Password
            </x-ui.button>
        </div>
    </form>
</div>
