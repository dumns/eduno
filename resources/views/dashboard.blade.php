<x-ui.layouts.app>
    @php
        $today = now();
        $startOfWeek = $today->copy()->startOfWeek();
        $days = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $dates = [];
        for ($i = 0; $i < 7; $i++) {
            $dates[] = $startOfWeek->copy()->addDays($i);
        }
        $defaultDay = $today->dayOfWeekIso - 1;

        $weeklyAgenda = [
            0 => [],
            1 => [],
            2 => [
                ['title' => 'Workshop Pemanfaatan Claude Design (PD07)', 'session' => 'Sesi 1', 'time' => '17:37 - 19:37'],
            ],
            3 => [],
            4 => [],
            5 => [],
            6 => [],
        ];
    @endphp

    <div x-data="{ tab: 'courses' }" class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
        {{-- ============================================================ --}}
        {{-- LEFT COLUMN  (4/12 = ~33%)                                   --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-4 space-y-6">
            {{-- JADWAL MINGGU INI --}}
            <div x-data="{ selectedDay: {{ $defaultDay }} }" class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden">
                <div class="p-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <x-ui.heading level="h3" size="lg">Jadwal Minggu Ini</x-ui.heading>
                        <x-ui.text size="xs" weight="semibold" color="primary">Hari ini: {{ $today->format('j F Y') }}</x-ui.text>
                    </div>

                    <div class="flex justify-between items-start mb-4">
                        @foreach ($days as $i => $day)
                            @php
                                $isToday = $dates[$i]->isToday();
                            @endphp
                            <div class="flex-1 text-center">
                                <div class="text-ui-xs font-medium text-muted dark:text-muted-dark mb-1">{{ $day }}</div>
                                <button @click="selectedDay = {{ $i }}" type="button"
                                    class="relative w-8 h-8 mx-auto flex items-center justify-center text-ui-sm font-semibold transition-colors rounded-full"
                                    :class="selectedDay === {{ $i }}
                                        ? 'bg-primary text-white shadow-sm'
                                        : 'text-foreground dark:text-foreground-dark hover:bg-gray-100 dark:hover:bg-gray-800'">
                                    {{ $dates[$i]->format('j') }}
                                </button>
                                <template x-if="selectedDay === {{ $i }}">
                                    <div class="flex justify-center mt-1">
                                        <i class="za-angle-down-small-duotone text-primary"></i>
                                    </div>
                                </template>
                            </div>
                        @endforeach
                    </div>

                    {{-- Agenda for each day --}}
                    <div class="pt-4 border-t border-border dark:border-border-dark">
                        @foreach ($days as $i => $day)
                            <div x-show="selectedDay === {{ $i }}" x-transition:enter="transition-all duration-200 ease-out" x-transition:enter-start="opacity-0 translate-y-1" x-transition:enter-end="opacity-100 translate-y-0">
                                @if (count($weeklyAgenda[$i]) > 0)
                                    <div class="space-y-3">
                                        @foreach ($weeklyAgenda[$i] as $item)
                                            <div class="flex items-start gap-2.5 p-3 rounded-ui-xl bg-primary/5 border border-primary/10">
                                                <div class="mt-1.5 w-1.5 h-1.5 rounded-full bg-primary flex-shrink-0"></div>
                                                <div class="flex-1 min-w-0">
                                                    <p class="text-ui-sm font-semibold text-foreground dark:text-foreground-dark">{{ $item['title'] }}</p>
                                                    <div class="flex items-center gap-3 mt-1">
                                                        <span class="text-ui-xs text-muted dark:text-muted-dark flex items-center gap-1">
                                                            <x-ui.icon name="book" size="xs" />
                                                            {{ $item['session'] }}
                                                        </span>
                                                        <span class="text-ui-xs font-medium text-primary flex items-center gap-1">
                                                            <x-ui.icon name="clock" size="xs" />
                                                            {{ $item['time'] }}
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @else
                                    <div class="flex flex-col items-center justify-center py-6 text-center">
                                        <i class="za-file-text-duotone text-5xl opacity-40 block mx-auto mb-3"></i>
                                        <x-ui.text size="sm" color="muted">Tidak ada jadwal kelas di tanggal ini</x-ui.text>
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- PERLU DIKERJAKAN --}}
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden">
                <div class="p-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <x-ui.heading level="h3" size="lg">Perlu Dikerjakan</x-ui.heading>
                        <span class="inline-flex items-center justify-center min-w-[24px] h-6 px-1.5 rounded-full bg-secondary/15 text-secondary font-bold text-ui-xs">0</span>
                    </div>

                    <div class="flex flex-col items-center justify-center py-8 text-center">
                        <i class="za-check-list-duotone text-5xl opacity-60 block mx-auto mb-4"></i>
                        <x-ui.text size="sm" color="muted">Tidak ada yang perlu dikerjakan saat ini</x-ui.text>
                    </div>
                </div>
            </div>
        </div>

        {{-- ============================================================ --}}
        {{-- RIGHT COLUMN (8/12 = ~67%)                                   --}}
        {{-- ============================================================ --}}
        <div class="lg:col-span-8">
            <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-2xl overflow-hidden">
                {{-- Tabs --}}
                <div class="border-b border-border dark:border-border-dark">
                    <div class="flex items-stretch divide-x divide-border dark:divide-border-dark">
                        <button @click="tab = 'courses'" type="button"
                            class="flex-1 relative px-1 py-4 text-ui-sm font-medium transition-colors text-center"
                            :class="tab === 'courses' ? 'text-primary' : 'text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark'">
                            Courses
                            <template x-if="tab === 'courses'">
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                            </template>
                        </button>
                        <button @click="tab = 'personal'" type="button"
                            class="flex-1 relative px-1 py-4 text-ui-sm font-medium transition-colors text-center"
                            :class="tab === 'personal' ? 'text-primary' : 'text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark'">
                            Kelas Personal
                            <template x-if="tab === 'personal'">
                                <span class="absolute bottom-0 left-0 right-0 h-0.5 bg-primary rounded-full"></span>
                            </template>
                        </button>
                    </div>
                </div>

                {{-- ============================================================ --}}
                {{-- COURSES TAB CONTENT                                          --}}
                {{-- ============================================================ --}}
                <div x-show="tab === 'courses'" class="p-5 sm:p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <x-ui.heading level="h3" size="lg">Courses</x-ui.heading>
                            <x-ui.text size="sm" color="muted">Anda memiliki {{ $courses->count() }} kelas pada tahun ini</x-ui.text>
                        </div>
                    </div>

                    {{-- Search + Year Filter --}}
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-5">
                        <div class="sm:col-span-8">
                            <div class="relative" x-data>
                                <x-ui.icon name="search" size="sm" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted dark:text-muted-dark pointer-events-none" />
                                <input type="text" placeholder="Cari berdasarkan nama kelas, kode kelas, atau nama pengajar"
                                    class="block w-full pl-10 pr-3 py-2.5 text-ui-sm bg-gray-100 dark:bg-gray-800 border-none rounded-ui-xl placeholder-muted dark:placeholder-muted-dark text-foreground dark:text-foreground-dark focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all duration-150">
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div x-data="{ open: false, selected: '2026' }" class="relative">
                                <button @click="open = !open" type="button"
                                    class="flex items-center justify-between gap-2 w-full px-4 py-2.5 text-ui-sm bg-gray-100 dark:bg-gray-800 rounded-ui-xl text-foreground dark:text-foreground-dark focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all">
                                    <span x-text="selected"></span>
                                    <x-ui.icon name="chevron-down" size="xs" class="text-muted dark:text-muted-dark flex-shrink-0" />
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="absolute right-0 top-full mt-1 w-full bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl shadow-ui-lg z-20 py-1" style="display: none;">
                                    <template x-for="year in ['2026', '2025', '2024']" :key="year">
                                        <button @click="selected = year; open = false" type="button"
                                            class="block w-full text-left px-4 py-2 text-ui-sm text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                                            :class="selected === year ? 'font-semibold text-primary' : ''"
                                            x-text="year"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Course Cards (2-column grid) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @forelse ($courses as $course)
                            <a href="#" class="flex flex-col bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl transition-all duration-200 hover:border-primary/30 hover:shadow-sm h-full">
                                <div class="p-4 pb-0">
                                    <p class="text-ui-sm font-semibold text-foreground dark:text-foreground-dark hover:text-primary transition-colors leading-snug">{{ $course->title }} ({{ $course->code ?? '-' }})</p>
                                </div>
                                <div class="p-4 space-y-2.5 flex-1">
                                    <div class="flex items-center gap-2 text-ui-xs text-muted dark:text-muted-dark">
                                        <i class="za-user-duotone w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>{{ $course->instructor?->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-ui-xs text-muted dark:text-muted-dark">
                                        <i class="za-calendar-duotone w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>-</span>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 pt-3 border-t border-border dark:border-border-dark mt-auto">
                                    <span class="text-ui-xs text-muted dark:text-muted-dark">Kehadiran: 0 dari 0 sesi</span>
                                </div>
                            </a>
                        @empty
                            <div class="sm:col-span-2 flex flex-col items-center justify-center py-8 text-center">
                                <i class="za-book-duotone text-5xl opacity-40 block mx-auto mb-3"></i>
                                <x-ui.text size="sm" color="muted">Belum ada course yang tersedia</x-ui.text>
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- ============================================================ --}}
                {{-- KELAS PERSONAL TAB CONTENT                                  --}}
                {{-- ============================================================ --}}
                <div x-show="tab === 'personal'" class="p-5 sm:p-6" style="display: none;">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-4 gap-3">
                        <div>
                            <x-ui.heading level="h3" size="lg">Kelas Personal</x-ui.heading>
                            <x-ui.text size="sm" color="muted">Anda dapat membuat atau mengikuti kelas personal</x-ui.text>
                        </div>
                        <div class="flex items-center gap-2">
                            <a href="#" class="inline-flex items-center gap-1.5 px-3 py-2 text-ui-sm font-medium rounded-ui-lg border border-border dark:border-border-dark text-foreground dark:text-foreground-dark bg-white dark:bg-surface-dark hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors">
                                <x-ui.icon name="plus" size="sm" />
                                <span>Ikuti kelas</span>
                            </a>
                            <x-ui.button href="#" variant="primary" size="sm" icon="plus">
                                Buat kelas
                            </x-ui.button>
                        </div>
                    </div>

                    {{-- Search + Filter --}}
                    <div class="grid grid-cols-1 sm:grid-cols-12 gap-3 mb-5">
                        <div class="sm:col-span-8">
                            <div class="relative" x-data>
                                <x-ui.icon name="search" size="sm" class="absolute left-3 top-1/2 -translate-y-1/2 text-muted dark:text-muted-dark pointer-events-none" />
                                <input type="text" placeholder="Cari kelas personal..."
                                    class="block w-full pl-10 pr-3 py-2.5 text-ui-sm bg-gray-100 dark:bg-gray-800 border-none rounded-ui-xl placeholder-muted dark:placeholder-muted-dark text-foreground dark:text-foreground-dark focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all duration-150">
                            </div>
                        </div>
                        <div class="sm:col-span-4">
                            <div x-data="{ open: false, selected: 'Pilih berdasarkan' }" class="relative">
                                <button @click="open = !open" type="button"
                                    class="flex items-center justify-between gap-2 w-full px-4 py-2.5 text-ui-sm bg-gray-100 dark:bg-gray-800 rounded-ui-xl text-foreground dark:text-foreground-dark focus:outline-none focus:ring-2 focus:ring-primary/40 transition-all">
                                    <span x-text="selected" class="truncate"></span>
                                    <x-ui.icon name="chevron-down" size="xs" class="text-muted dark:text-muted-dark flex-shrink-0" />
                                </button>
                                <div x-show="open" @click.outside="open = false"
                                    class="absolute right-0 top-full mt-1 w-full bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl shadow-ui-lg z-20 py-1" style="display: none;">
                                    <template x-for="item in ['Semua', 'Kelas Umum', 'Kelas Privat']" :key="item">
                                        <button @click="selected = item; open = false" type="button"
                                            class="block w-full text-left px-4 py-2 text-ui-sm text-foreground dark:text-foreground-dark hover:bg-gray-50 dark:hover:bg-gray-800 transition-colors"
                                            :class="selected === item ? 'font-semibold text-primary' : ''"
                                            x-text="item"></button>
                                    </template>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Personal Course Cards (2-column grid) --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                        @forelse ($personalCourses as $course)
                            <a href="#" class="flex flex-col bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-ui-xl transition-all duration-200 hover:border-primary/30 hover:shadow-sm h-full">
                                <div class="flex flex-wrap items-center gap-x-2 gap-y-1 p-4 pb-0">
                                    <p class="text-ui-sm font-semibold text-foreground dark:text-foreground-dark hover:text-primary transition-colors leading-snug">{{ $course->title }} ({{ $course->code ?? '-' }})</p>
                                    <span class="inline-flex items-center px-2 py-0.5 text-ui-xs font-medium rounded-full bg-primary/10 text-primary">-</span>
                                </div>
                                <div class="p-4 space-y-2.5 flex-1">
                                    <div class="flex items-center gap-2 text-ui-xs text-muted dark:text-muted-dark">
                                        <i class="za-user-duotone w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>Dosen {{ $course->instructor?->name ?? '-' }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-ui-xs text-muted dark:text-muted-dark">
                                        <i class="za-calendar-duotone w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>-</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-ui-xs text-muted dark:text-muted-dark">
                                        <i class="za-users-duotone w-3.5 h-3.5 flex-shrink-0"></i>
                                        <span>Jumlah peserta: - orang</span>
                                    </div>
                                </div>
                                <div class="px-4 pb-4 pt-3 border-t border-border dark:border-border-dark mt-auto">
                                    <span class="text-ui-xs text-muted dark:text-muted-dark">Kehadiran: 0 dari 0 sesi</span>
                                </div>
                            </a>
                        @empty
                            <div class="sm:col-span-2 flex flex-col items-center justify-center py-8 text-center">
                                <i class="za-users-duotone text-5xl opacity-40 block mx-auto mb-3"></i>
                                <x-ui.text size="sm" color="muted">Belum ada kelas personal</x-ui.text>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-ui.layouts.app>
