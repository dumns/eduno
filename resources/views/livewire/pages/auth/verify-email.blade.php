<?php

use App\Livewire\Actions\Logout;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public function sendVerification(): void
    {
        if (Auth::user()->hasVerifiedEmail()) {
            $this->redirect(session('url.intended', RouteServiceProvider::HOME), navigate: true);
            return;
        }

        Auth::user()->sendEmailVerificationNotification();
        Session::flash('status', 'verification-link-sent');
    }

    public function logout(Logout $logout): void
    {
        $logout();
        $this->redirect('/', navigate: true);
    }
}; ?>

<div>
    <x-ui.heading level="h2" size="xl" class="mb-3">Verify Your Email</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-6">
        Thanks for signing up! Before getting started, please verify your email address by clicking the link we just sent you. Didn't receive the email? We'll gladly send another.
    </x-ui.text>

    @if (session('status') == 'verification-link-sent')
        <x-ui.alert type="success" class="mb-4">
            A new verification link has been sent to your email address.
        </x-ui.alert>
    @endif

    <div class="flex items-center justify-between">
        <x-ui.button wire:click="sendVerification" variant="primary">
            Resend Verification Email
        </x-ui.button>

        <button wire:click="logout" type="submit" class="text-ui-sm font-medium text-primary hover:text-primary-hover transition-colors duration-150">
            Log Out
        </button>
    </div>
</div>
