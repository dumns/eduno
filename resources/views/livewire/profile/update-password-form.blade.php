<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;
use Livewire\Volt\Component;

new class extends Component
{
    public string $current_password = '';
    public string $password = '';
    public string $password_confirmation = '';

    public function updatePassword(): void
    {
        try {
            $validated = $this->validate([
                'current_password' => ['required', 'string', 'current_password'],
                'password' => ['required', 'string', Password::defaults(), 'confirmed'],
            ]);
        } catch (ValidationException $e) {
            $this->reset('current_password', 'password', 'password_confirmation');
            throw $e;
        }

        Auth::user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        $this->reset('current_password', 'password', 'password_confirmation');
        $this->dispatch('password-updated');
    }
}; ?>

<section>
    <x-ui.heading level="h3" size="lg" class="mb-1">Update Password</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-6">
        Ensure your account is using a long, random password to stay secure.
    </x-ui.text>

    <form wire:submit="updatePassword" class="space-y-5">
        <x-ui.form-group label="Current Password" name="current_password" :error="$errors->first('current_password')" required>
            <x-ui.input type="password" name="current_password" wire:model="current_password" autocomplete="current-password" />
        </x-ui.form-group>

        <x-ui.form-group label="New Password" name="password" :error="$errors->first('password')" required>
            <x-ui.input type="password" name="password" wire:model="password" autocomplete="new-password" />
        </x-ui.form-group>

        <x-ui.form-group label="Confirm Password" name="password_confirmation" :error="$errors->first('password_confirmation')" required>
            <x-ui.input type="password" name="password_confirmation" wire:model="password_confirmation" autocomplete="new-password" />
        </x-ui.form-group>

        <div class="flex items-center gap-4">
            <x-ui.button type="submit" size="md">Save</x-ui.button>
            <div x-data="{ shown: false }"
                 x-init="$wire.on('password-updated', () => { shown = true; setTimeout(() => shown = false, 2000); })"
                 x-show="shown"
                 x-transition:leave.opacity.duration.1500ms
                 style="display: none;"
                 class="flex items-center gap-1.5 text-ui-sm text-success">
                <x-ui.icon name="check" size="xs" />
                {{ __('Saved.') }}
            </div>
        </div>
    </form>
</section>
