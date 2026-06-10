<x-ui.layouts.app>
    <x-slot name="header">
        <x-ui.heading level="h1" size="xl">Dashboard</x-ui.heading>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6 mb-8">
        <x-ui.stat-card
            title="Total Courses"
            value="12"
            icon="book"
            variant="primary"
            trend="+2 this month"
            trendType="up"
        />
        <x-ui.stat-card
            title="Completed"
            value="8"
            icon="check-badge"
            variant="success"
            trend="75% completion rate"
            trendType="up"
        />
        <x-ui.stat-card
            title="In Progress"
            value="3"
            icon="clock"
            variant="warning"
            trend="2 due this week"
            trendType="up"
        />
        <x-ui.stat-card
            title="Achievements"
            value="15"
            icon="star"
            variant="info"
            trend="+3 new badges"
            trendType="up"
        />
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-ui.card variant="elevated">
            <x-slot:header>
                <x-ui.heading level="h3" size="lg">Recent Activity</x-ui.heading>
            </x-slot:header>
            <div class="space-y-4">
                <div class="flex items-center gap-3">
                    <x-ui.avatar initials="JD" size="sm" />
                    <div class="flex-1 min-w-0">
                        <p class="text-ui-sm font-medium text-foreground dark:text-foreground-dark">Completed Laravel Basics</p>
                        <p class="text-ui-xs text-muted dark:text-muted-dark">2 hours ago</p>
                    </div>
                    <x-ui.badge variant="success" size="xs">Done</x-ui.badge>
                </div>
                <div class="flex items-center gap-3">
                    <x-ui.avatar initials="AK" size="sm" />
                    <div class="flex-1 min-w-0">
                        <p class="text-ui-sm font-medium text-foreground dark:text-foreground-dark">Started Vue.js Course</p>
                        <p class="text-ui-xs text-muted dark:text-muted-dark">Yesterday</p>
                    </div>
                    <x-ui.badge variant="warning" size="xs">In Progress</x-ui.badge>
                </div>
                <div class="flex items-center gap-3">
                    <x-ui.avatar initials="MS" size="sm" />
                    <div class="flex-1 min-w-0">
                        <p class="text-ui-sm font-medium text-foreground dark:text-foreground-dark">Scored 95% on Quiz</p>
                        <p class="text-ui-xs text-muted dark:text-muted-dark">3 days ago</p>
                    </div>
                    <x-ui.badge variant="primary" size="xs">Excellent</x-ui.badge>
                </div>
            </div>
        </x-ui.card>

        <x-ui.card variant="elevated">
            <x-slot:header>
                <x-ui.heading level="h3" size="lg">Quick Actions</x-ui.heading>
            </x-slot:header>
            <div class="grid grid-cols-2 gap-3">
                <x-ui.button variant="outline" icon="play" class="justify-center">Continue Learning</x-ui.button>
                <x-ui.button variant="outline" icon="book" class="justify-center">Browse Courses</x-ui.button>
                <x-ui.button variant="outline" icon="calendar" class="justify-center">My Schedule</x-ui.button>
                <x-ui.button variant="outline" icon="settings" class="justify-center">Settings</x-ui.button>
            </div>
        </x-ui.card>
    </div>
</x-ui.layouts.app>
