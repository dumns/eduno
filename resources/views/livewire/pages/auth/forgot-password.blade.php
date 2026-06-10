<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    public function sendPasswordResetLink(): void
    {
        $this->validate(['email' => ['required', 'string', 'email']]);

        $status = Password::sendResetLink($this->only('email'));

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));
            return;
        }

        $this->reset('email');
        session()->flash('status', __($status));
    }
}; ?>

<div>
    <x-ui.heading level="h2" size="xl" class="mb-3">Forgot Password?</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-6">
        No problem. Just enter your email and we'll send you a password reset link.
    </x-ui.text>

    @if (session('status'))
        <x-ui.alert type="success" class="mb-4">
            {{ session('status') }}
        </x-ui.alert>
    @endif

    <form wire:submit="sendPasswordResetLink" class="space-y-5">
        <x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
            <x-ui.input type="email" name="email" wire:model="email" placeholder="you@example.com" required autofocus />
        </x-ui.form-group>

        <div class="flex items-center justify-end">
            <x-ui.button type="submit" size="md">
                Send Reset Link
            </x-ui.button>
        </div>
    </form>
</div>
