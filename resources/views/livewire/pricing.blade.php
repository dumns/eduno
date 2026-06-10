<div class="min-h-screen bg-surface dark:bg-background-dark">
    <div class="max-w-7xl mx-auto px-4 py-10 sm:px-6 lg:px-8 lg:py-14">
        <div class="text-center mb-10 lg:mb-14">
            <x-ui.heading level="h2" size="3xl" class="mb-3">
                Subscription Plans
            </x-ui.heading>
            <x-ui.text size="lg" color="muted">
                Choose the plan that better fits your needs.
            </x-ui.text>
        </div>

        <div class="grid sm:grid-cols-1 lg:grid-cols-3 gap-6 lg:items-center max-w-5xl mx-auto">
            <x-ui.card variant="elevated" padding="lg" class="text-center">
                <x-ui.heading level="h4" size="lg" class="mb-2">Monthly</x-ui.heading>
                <div class="mt-5">
                    <span class="font-bold text-ui-4xl text-foreground dark:text-foreground-dark">
                        <span class="text-ui-2xl -me-2">$</span>4.99
                    </span>
                </div>
                <x-ui.text size="sm" color="muted" class="mt-2">No commitments. Cancel anytime.</x-ui.text>
                <x-ui.button wire:click.prevent="checkout('monthly')" variant="outline" class="mt-6 w-full justify-center">
                    Sign up
                </x-ui.button>
            </x-ui.card>

            <x-ui.card variant="elevated" padding="lg" class="text-center relative scale-105 border-2 border-primary">
                <x-slot name="header">
                    <div class="w-full flex justify-center">
                        <x-ui.badge variant="primary" size="sm">
                            Most popular
                        </x-ui.badge>
                    </div>
                </x-slot>
                <x-ui.heading level="h4" size="lg" class="mb-2">Yearly</x-ui.heading>
                <div class="mt-5">
                    <span class="font-bold text-ui-4xl text-foreground dark:text-foreground-dark">
                        <span class="text-ui-2xl -me-2">$</span>34.99
                    </span>
                </div>
                <x-ui.text size="sm" color="muted" class="mt-2">Save 30% with full access for 1 year.</x-ui.text>
                <x-ui.button wire:click.prevent="checkout('yearly')" class="mt-6 w-full justify-center">
                    Sign up
                </x-ui.button>
            </x-ui.card>

            <x-ui.card variant="elevated" padding="lg" class="text-center">
                <x-ui.heading level="h4" size="lg" class="mb-2">Lifetime</x-ui.heading>
                <div class="mt-5">
                    <span class="font-bold text-ui-4xl text-foreground dark:text-foreground-dark">
                        <span class="text-ui-2xl -me-2">$</span>174.99
                    </span>
                </div>
                <x-ui.text size="sm" color="muted" class="mt-2">Pay once. Lifetime access.</x-ui.text>
                <x-ui.button wire:click.prevent="checkout('lifetime')" variant="outline" class="mt-6 w-full justify-center">
                    Sign up
                </x-ui.button>
            </x-ui.card>
        </div>
    </div>
</div>
