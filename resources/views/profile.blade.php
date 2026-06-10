<x-ui.layouts.app>
    <x-slot name="header">
        <x-ui.heading level="h1" size="xl">Profile</x-ui.heading>
    </x-slot>

    <div class="max-w-3xl mx-auto space-y-6">
        <x-ui.card variant="elevated">
            <livewire:profile.update-profile-information-form />
        </x-ui.card>

        <x-ui.card variant="elevated">
            <livewire:profile.update-password-form />
        </x-ui.card>

        <x-ui.card variant="elevated">
            <livewire:profile.delete-user-form />
        </x-ui.card>
    </div>
</x-ui.layouts.app>
