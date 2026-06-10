<div class="max-w-[85rem] px-4 py-10 sm:px-6 lg:px-8 lg:py-14 mx-auto">
    <div class="max-w-2xl mx-auto text-center mb-10 lg:mb-14">
        <x-ui.heading level="h2" size="3xl" class="mb-3">
            Subscription Plans
        </x-ui.heading>
        <x-ui.text size="lg" color="muted">
            Choose the plan that better fits your needs.
        </x-ui.text>
    </div>

    <div class="mt-12 grid sm:grid-cols-1 lg:grid-cols-3 gap-6 lg:items-center">
        <x-ui.card variant="outlined" padding="lg" class="text-center">
            <x-ui.heading level="h4" size="lg" class="mb-2">Monthly</x-ui.heading>
            <div class="mt-5">
                <span class="font-bold text-5xl text-foreground dark:text-foreground-dark">
                    <span class="text-2xl -me-2">$</span>4.99
                </span>
            </div>
            <x-ui.text size="sm" color="muted" class="mt-2">No commitments. Cancel anytime.</x-ui.text>
            <x-ui.button wire:click.prevent="checkout('monthly')" variant="outline" class="mt-6 w-full justify-center">
                Sign up
            </x-ui.button>
        </x-ui.card>

        <div class="relative flex flex-col text-center bg-white dark:bg-surface-dark border-2 border-primary shadow-ui-xl rounded-ui-2xl p-8 scale-105">
            <x-ui.badge variant="primary" size="sm" class="absolute -top-3 left-1/2 -translate-x-1/2">
                Most popular
            </x-ui.badge>
            <x-ui.heading level="h4" size="lg" class="mb-2">Yearly</x-ui.heading>
            <div class="mt-5">
                <span class="font-bold text-5xl text-foreground dark:text-foreground-dark">
                    <span class="text-2xl -me-2">$</span>34.99
                </span>
            </div>
            <x-ui.text size="sm" color="muted" class="mt-2">Save 30% with full access for 1 year.</x-ui.text>
            <x-ui.button wire:click.prevent="checkout('yearly')" class="mt-6 w-full justify-center">
                Sign up
            </x-ui.button>
        </div>

        <x-ui.card variant="outlined" padding="lg" class="text-center">
            <x-ui.heading level="h4" size="lg" class="mb-2">Lifetime</x-ui.heading>
            <div class="mt-5">
                <span class="font-bold text-5xl text-foreground dark:text-foreground-dark">
                    <span class="text-2xl -me-2">$</span>174.99
                </span>
            </div>
            <x-ui.text size="sm" color="muted" class="mt-2">Pay once. Lifetime access.</x-ui.text>
            <x-ui.button wire:click.prevent="checkout('lifetime')" variant="outline" class="mt-6 w-full justify-center">
                Sign up
            </x-ui.button>
        </x-ui.card>
    </div>
</div>
