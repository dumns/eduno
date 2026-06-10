<?php

use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\Rule;
use Livewire\Volt\Component;

new class extends Component
{
    public string $name = '';
    public string $email = '';

    public function mount(): void
    {
        $this->name = Auth::user()->name;
        $this->email = Auth::user()->email;
    }

    public function updateProfileInformation(): void
    {
        $user = Auth::user();

        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(User::class)->ignore($user->id)],
        ]);

        $user->fill($validated);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        $this->dispatch('profile-updated', name: $user->name);
    }

    public function sendVerification(): void
    {
        $user = Auth::user();

        if ($user->hasVerifiedEmail()) {
            $path = session('url.intended', RouteServiceProvider::HOME);
            $this->redirect($path);
            return;
        }

        $user->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }
}; ?>

<section>
    <x-ui.heading level="h3" size="lg" class="mb-1">Profile Information</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-6">
        Update your account's profile information and email address.
    </x-ui.text>

    <form wire:submit="updateProfileInformation" class="space-y-5">
        <x-ui.form-group label="Name" name="name" :error="$errors->first('name')" required>
            <x-ui.input type="text" name="name" wire:model="name" required autofocus autocomplete="name" />
        </x-ui.form-group>

        <x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
            <x-ui.input type="email" name="email" wire:model="email" required autocomplete="username" />
            @if (auth()->user() instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! auth()->user()->hasVerifiedEmail())
                <div class="mt-2">
                    <x-ui.text size="xs" color="warning">
                        Your email address is unverified.
                        <button wire:click.prevent="sendVerification" class="underline hover:no-underline font-medium">Click here to re-send the verification email.</button>
                    </x-ui.text>
                    @if (session('status') === 'verification-link-sent')
                        <x-ui.text size="xs" color="success" class="mt-1">A new verification link has been sent to your email address.</x-ui.text>
                    @endif
                </div>
            @endif
        </x-ui.form-group>

        <div class="flex items-center gap-4">
            <x-ui.button type="submit" size="md">Save</x-ui.button>
            <x-action-message class="me-3" on="profile-updated">
                {{ __('Saved.') }}
            </x-action-message>
        </div>
    </form>
</section>
