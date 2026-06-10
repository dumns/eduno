<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component
{
    public string $password = '';

    public function deleteUser(Logout $logout): void
    {
        $this->validate(['password' => ['required', 'string', 'current_password']]);

        tap(Auth::user(), $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }
}; ?>

<section class="space-y-6">
    <x-ui.heading level="h3" size="lg" class="mb-1">Delete Account</x-ui.heading>
    <x-ui.text size="sm" color="muted" class="mb-2">
        Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.
    </x-ui.text>

    <x-ui.button
        variant="danger"
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
    >
        Delete Account
    </x-ui.button>

    <x-ui.modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" title="Confirm Account Deletion">
        <x-ui.text size="sm" color="muted" class="mb-4">
            Are you sure you want to delete your account? Please enter your password to confirm.
        </x-ui.text>

        <form wire:submit="deleteUser">
            <x-ui.form-group label="Password" name="password" :error="$errors->first('password')" required>
                <x-ui.input type="password" name="password" wire:model="password" placeholder="Enter your password" />
            </x-ui.form-group>

            <x-slot:footer>
                <x-ui.button type="button" variant="ghost" x-on:click="$dispatch('close')">
                    Cancel
                </x-ui.button>
                <x-ui.button type="submit" variant="danger">
                    Delete Account
                </x-ui.button>
            </x-slot:footer>
        </form>
    </x-ui.modal>
</section>
