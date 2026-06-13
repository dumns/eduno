<x-ui.layouts.app>
    <style>
        body { overflow-x: hidden; }
    </style>

    {{-- Hero --}}
    <div class="relative -mt-6 sm:-mt-8" style="width: 100vw; left: 50%; transform: translateX(-50%);">
        <div class="bg-gradient-to-br from-primary via-primary-dark to-primary/80 dark:from-primary-dark dark:via-[#0A3A5C] dark:to-primary-dark/90 relative overflow-hidden">
            <div class="absolute inset-0 pointer-events-none">
                <div class="absolute -top-24 -right-24 w-96 h-96 rounded-full bg-white/5 blur-3xl"></div>
                <div class="absolute -bottom-32 -left-32 w-[30rem] h-[30rem] rounded-full bg-white/[0.03] blur-3xl"></div>
                <svg class="absolute bottom-0 left-0 w-full h-auto text-primary-dark/30 dark:text-black/20" viewBox="0 0 1440 120" preserveAspectRatio="none">
                    <path fill="currentColor" d="M0,32L60,42.7C120,53,240,75,360,80C480,85,600,75,720,64C840,53,960,43,1080,48C1200,53,1320,75,1380,85.3L1440,96L1440,120L1380,120C1320,120,1200,120,1080,120C960,120,840,120,720,120C600,120,480,120,360,120C240,120,120,120,60,120L0,120Z"></path>
                </svg>
            </div>
            <div class="relative py-8 sm:py-10 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-white/20 text-white backdrop-blur-sm border border-white/10">
                        Workshop Pemanfaatan Claude Design
                    </span>
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 text-xs font-semibold rounded-full bg-white/20 text-white backdrop-blur-sm border border-white/10">
                        PD07
                    </span>
                </div>
                <h1 class="text-2xl sm:text-3xl font-bold text-white leading-tight mb-2">Workshop Pemanfaatan Claude Design (PD07)</h1>
                <p class="text-sm sm:text-base text-white/80 max-w-2xl">Pelajari cara memanfaatkan Claude AI untuk desain produk digital secara praktis dan interaktif.</p>
                <div class="flex flex-wrap gap-x-6 gap-y-2 mt-6">
                    <div>
                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-wider">Kode Kelas</p>
                        <p class="text-sm font-semibold text-white">PD07</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-wider">Pengajar</p>
                        <p class="text-sm font-semibold text-white">Dosen SU</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-wider">Peserta</p>
                        <p class="text-sm font-semibold text-white">97 peserta</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-wider">Tahun</p>
                        <p class="text-sm font-semibold text-white">2026</p>
                    </div>
                    <div>
                        <p class="text-[10px] text-white/50 font-medium uppercase tracking-wider">Bagikan</p>
                        <a href="#" class="text-sm font-semibold text-white hover:text-white/80 transition-colors inline-flex items-center gap-1">
                            Salin Tautan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Progress --}}
        <div class="bg-white dark:bg-surface-dark border-b border-border dark:border-border-dark">
            <div class="py-3 px-4 sm:px-6 lg:px-8 max-w-7xl mx-auto">
                <div class="flex items-center gap-4">
                    <a href="#" class="inline-flex items-center gap-1.5 text-sm font-semibold text-muted dark:text-muted-dark hover:text-foreground dark:hover:text-foreground-dark flex-shrink-0">
                        Kembali
                    </a>
                    <div class="w-px h-6 bg-border dark:bg-border-dark flex-shrink-0"></div>
                    <div class="flex-1 min-w-0">
                        <div class="flex items-center justify-between mb-0.5">
                            <span class="text-sm font-semibold text-foreground dark:text-foreground-dark">Progress Kelas</span>
                            <span class="text-lg font-bold text-primary">0%</span>
                        </div>
                        <div class="h-2 bg-gray-100 dark:bg-gray-800 rounded-full overflow-hidden">
                            <div class="h-full bg-primary rounded-full transition-all duration-700" style="width: 0%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Main Content --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex flex-col lg:flex-row gap-6">

            {{-- LEFT SIDEBAR --}}
            <div class="w-full lg:w-[260px] flex-shrink-0 space-y-5">
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl overflow-hidden">
                    <div class="p-2">
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Informasi Kelas</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg bg-primary/10 text-primary font-semibold">Diskusi</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Sesi Pembelajaran</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Tugas</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Ujian CBT</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Kuis</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Video Interaktif</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Berkas</a>
                        <div class="border-t border-border dark:border-border-dark my-1"></div>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Pengajar &amp; Peserta</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">Kelompok</a>
                        <a href="#" class="block px-3 py-2 text-sm font-medium rounded-lg text-muted dark:text-muted-dark hover:bg-gray-50 dark:hover:bg-gray-800/50 transition-all">SES</a>
                    </div>
                </div>

                {{-- Session accordion --}}
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl overflow-hidden">
                    <div class="px-4 py-3 border-b border-border dark:border-border-dark">
                        <p class="text-sm font-semibold text-foreground dark:text-foreground-dark">Sesi Pembelajaran</p>
                    </div>
                    <div class="divide-y divide-border dark:divide-border-dark">
                        <div x-data="{ open: true }">
                            <button @click="open = !open" class="flex items-center gap-3 w-full px-4 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-all">
                                <i class="za-check-circle-duotone w-4 h-4 text-primary flex-shrink-0"></i>
                                <div class="flex-1 min-w-0 text-left">
                                    <p class="text-xs text-muted dark:text-muted-dark">Sesi 2</p>
                                    <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Tryout Periode April 2026</p>
                                </div>
                                <i class="za-angle-down-small-duotone w-4 h-4 text-muted dark:text-muted-dark flex-shrink-0 transition-transform duration-200" x-bind:class="{'rotate-180': open}"></i>
                            </button>
                            <div x-show="open" x-collapse>
                                <div class="px-4 py-2 space-y-0.5 bg-gray-50/50 dark:bg-gray-800/20">
                                    <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-white dark:hover:bg-gray-800/40 transition-all">Tryout Periode April 2026</a>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-3 w-full px-4 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-all">
                                <i class="za-check-circle-duotone w-4 h-4 text-primary flex-shrink-0"></i>
                                <div class="flex-1 min-w-0 text-left">
                                    <p class="text-xs text-muted dark:text-muted-dark">Sesi 3</p>
                                    <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Tryout Periode Mei 2026</p>
                                </div>
                                <i class="za-angle-down-small-duotone w-4 h-4 text-muted dark:text-muted-dark flex-shrink-0 transition-transform duration-200" x-bind:class="{'rotate-180': open}"></i>
                            </button>
                            <div x-show="open" x-collapse>
                                <div class="px-4 py-2 space-y-0.5 bg-gray-50/50 dark:bg-gray-800/20">
                                    <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-white dark:hover:bg-gray-800/40 transition-all">Tryout Periode Mei 2026</a>
                                </div>
                            </div>
                        </div>
                        <div x-data="{ open: false }">
                            <button @click="open = !open" class="flex items-center gap-3 w-full px-4 py-3 text-left hover:bg-gray-50 dark:hover:bg-gray-800/30 transition-all">
                                <i class="za-check-circle-duotone w-4 h-4 text-primary flex-shrink-0"></i>
                                <div class="flex-1 min-w-0 text-left">
                                    <p class="text-xs text-muted dark:text-muted-dark">Sesi 1</p>
                                    <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Kisi - Kisi Basic Modul Product SEVIMA</p>
                                </div>
                                <i class="za-angle-down-small-duotone w-4 h-4 text-muted dark:text-muted-dark flex-shrink-0 transition-transform duration-200" x-bind:class="{'rotate-180': open}"></i>
                            </button>
                            <div x-show="open" x-collapse>
                                <div class="px-4 py-2 space-y-0.5 bg-gray-50/50 dark:bg-gray-800/20">
                                    <a href="#" class="block px-3 py-2 text-sm rounded-lg hover:bg-white dark:hover:bg-gray-800/40 transition-all">Materi - Sesi #1 (1)</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- MAIN CONTENT --}}
            <div class="flex-1 min-w-0 max-w-[740px] space-y-4">

                {{-- Share box --}}
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl p-5">
                    <p class="text-sm font-semibold text-muted dark:text-muted-dark mb-4">Bagikan sesuatu di kelas Anda:</p>
                    <div class="flex items-center gap-5">
                        <a href="#" class="flex flex-col items-center gap-1 group">
                            <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center group-hover:bg-primary/10 transition-all">
                                <i class="za-check-list-duotone w-5 h-5 text-primary"></i>
                            </div>
                            <span class="text-xs text-muted dark:text-muted-dark">Survei</span>
                        </a>
                        <a href="#" class="flex flex-col items-center gap-1 group">
                            <div class="w-12 h-12 rounded-xl bg-primary/5 flex items-center justify-center group-hover:bg-primary/10 transition-all">
                                <i class="za-info-circle-duotone w-5 h-5 text-primary"></i>
                            </div>
                            <span class="text-xs text-muted dark:text-muted-dark">Info</span>
                        </a>
                        <a href="#" class="flex flex-col items-center gap-1 group">
                            <div class="w-12 h-12 rounded-xl bg-warning/5 flex items-center justify-center group-hover:bg-warning/10 transition-all">
                                <i class="za-calendar-duotone w-5 h-5 text-warning"></i>
                            </div>
                            <span class="text-xs text-muted dark:text-muted-dark">Acara</span>
                        </a>
                    </div>
                </div>

                {{-- Post: Quiz --}}
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl p-5">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-primary">U</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm">
                                <span class="font-semibold text-foreground dark:text-foreground-dark">University Sevima</span>
                                <span class="text-muted dark:text-muted-dark"> menambahkan quiz</span>
                            </p>
                            <p class="text-xs text-muted dark:text-muted-dark mt-0.5">Sesi ke 3 · 6 hari yang lalu</p>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 p-4 bg-orange-50/50 dark:bg-orange-900/10 rounded-xl border border-orange-100/50 dark:border-orange-900/20">
                        <div class="w-10 h-10 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center flex-shrink-0">
                            <i class="za-check-circle-duotone w-5 h-5 text-orange-500"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-foreground dark:text-foreground-dark">Tryout Periode Mei 2026</p>
                            <p class="text-xs text-muted dark:text-muted-dark mt-0.5">100 Pertanyaan · Batas: 04 Jun 2026</p>
                        </div>
                        <a href="#" class="px-4 py-2 text-sm font-semibold rounded-lg bg-primary text-white hover:bg-primary-hover transition-all flex-shrink-0">Kerjakan</a>
                    </div>

                    {{-- Papan Peringkat --}}
                    <p class="text-sm font-semibold text-foreground dark:text-foreground-dark mt-4 mb-3">Papan Peringkat Quiz</p>
                    <div class="space-y-1.5">
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-yellow-50 dark:bg-yellow-900/10 border-l-[3px] border-yellow-400 dark:border-yellow-500">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-yellow-400 text-white text-[11px] font-bold flex-shrink-0">1</span>
                            <span class="text-sm font-medium text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">Devi Merdiana Sari</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded bg-yellow-100 dark:bg-yellow-900/30 text-yellow-700 dark:text-yellow-300 flex-shrink-0">
                                <i class="za-star-duotone w-3 h-3"></i> 71
                            </span>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-gray-50/50 dark:bg-gray-800/20 border-l-[3px] border-gray-300 dark:border-gray-600">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-gray-300 dark:bg-gray-500 text-white text-[11px] font-bold flex-shrink-0">2</span>
                            <span class="text-sm font-medium text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">Stefany Amanda Kurniawan</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded bg-gray-100 dark:bg-gray-700 text-gray-500 dark:text-gray-300 flex-shrink-0">
                                <i class="za-star-duotone w-3 h-3"></i> 70
                            </span>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-2.5 rounded-lg bg-amber-50/50 dark:bg-amber-900/10 border-l-[3px] border-amber-500 dark:border-amber-600">
                            <span class="flex items-center justify-center w-6 h-6 rounded-full bg-amber-500 dark:bg-amber-600 text-white text-[11px] font-bold flex-shrink-0">3</span>
                            <span class="text-sm font-medium text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">Maria Angelina Handoko</span>
                            <span class="inline-flex items-center gap-1 px-2 py-0.5 text-xs font-semibold rounded bg-amber-100 dark:bg-amber-900/30 text-amber-700 dark:text-amber-300 flex-shrink-0">
                                <i class="za-star-duotone w-3 h-3"></i> 69
                            </span>
                        </div>
                    </div>
                    <a href="#" class="block text-center text-sm text-primary hover:text-primary-hover mt-2 py-1.5 rounded-lg hover:bg-primary/5 transition-all">Muat lebih</a>

                    <div class="flex items-center gap-4 pt-3 mt-3 border-t border-border dark:border-border-dark">
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-danger transition-all">
                            <i class="za-heart-simple-duotone w-4 h-4"></i>
                            Suka 1
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-primary transition-all">
                            <i class="za-chat-dots-duotone w-4 h-4"></i>
                            Komentar
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-primary transition-all">
                            <i class="za-share-duotone w-4 h-4"></i>
                            Bagikan
                        </a>
                    </div>

                    <div class="flex items-start gap-2.5 mt-3 pt-3 border-t border-border/50 dark:border-border-dark/50">
                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-primary/20 to-secondary/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-xs font-bold text-primary">A</span>
                        </div>
                        <div class="flex-1 flex items-center gap-2">
                            <input type="text" placeholder="Tambahkan komentar..." class="w-full text-sm bg-gray-50 dark:bg-gray-800/50 border border-border dark:border-border-dark rounded-lg px-3 py-2 text-foreground dark:text-foreground-dark placeholder-muted dark:placeholder-muted-dark focus:outline-none focus:ring-2 focus:ring-primary/30 transition-all">
                            <button type="button" class="w-9 h-9 rounded-lg bg-primary text-white hover:bg-primary-hover flex items-center justify-center transition-all flex-shrink-0">
                                <i class="za-arrow-right-small-duotone w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                {{-- Post: Material --}}
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl p-5">
                    <div class="flex items-start gap-3 mb-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-purple-500/20 to-pink-500/20 flex items-center justify-center flex-shrink-0">
                            <span class="text-sm font-bold text-purple-600 dark:text-purple-400">M</span>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm">
                                <span class="font-semibold text-foreground dark:text-foreground-dark">Melania Aldia</span>
                                <span class="text-muted dark:text-muted-dark"> menambahkan materi</span>
                            </p>
                            <p class="text-xs text-muted dark:text-muted-dark mt-0.5">Sesi ke 1 · 2 bulan yang lalu</p>
                        </div>
                    </div>

                    <p class="text-base font-semibold text-foreground dark:text-foreground-dark mb-3">
                        <a href="#" class="hover:text-primary transition-colors">Pemanfaatan Claude Design dalam Workflow Product Development</a>
                    </p>

                    <div class="space-y-2">
                        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50/50 dark:bg-red-900/5 border border-red-100/30 dark:border-red-900/10">
                            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="za-file-text-duotone w-4 h-4 text-red-500"></i>
                            </div>
                            <span class="text-sm text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">Kisi-Kisi_Ujian_SEVIMA_PNDK_2025_v4 (2).pdf</span>
                            <a href="#" class="text-sm font-semibold text-primary hover:text-primary-hover flex-shrink-0">Unduh</a>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50/50 dark:bg-red-900/5 border border-red-100/30 dark:border-red-900/10">
                            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="za-file-text-duotone w-4 h-4 text-red-500"></i>
                            </div>
                            <span class="text-sm text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">PMB - Digital_Campus_Blueprint.pdf</span>
                            <a href="#" class="text-sm font-semibold text-primary hover:text-primary-hover flex-shrink-0">Unduh</a>
                        </div>
                        <div class="flex items-center gap-3 px-4 py-3 rounded-lg bg-red-50/50 dark:bg-red-900/5 border border-red-100/30 dark:border-red-900/10">
                            <div class="w-9 h-9 rounded-lg bg-red-100 dark:bg-red-900/30 flex items-center justify-center flex-shrink-0">
                                <i class="za-file-text-duotone w-4 h-4 text-red-500"></i>
                            </div>
                            <span class="text-sm text-foreground dark:text-foreground-dark flex-1 min-w-0 truncate">KISI AKADEMIK.pdf</span>
                            <a href="#" class="text-sm font-semibold text-primary hover:text-primary-hover flex-shrink-0">Unduh</a>
                        </div>
                    </div>

                    <div class="flex items-center gap-4 pt-3 mt-3 border-t border-border dark:border-border-dark">
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-danger transition-all">
                            <i class="za-heart-simple-duotone w-4 h-4"></i>
                            Suka 2
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-primary transition-all">
                            <i class="za-chat-dots-duotone w-4 h-4"></i>
                            Komentar
                        </a>
                        <a href="#" class="inline-flex items-center gap-1.5 text-sm text-muted dark:text-muted-dark hover:text-primary transition-all">
                            <i class="za-share-duotone w-4 h-4"></i>
                            Bagikan
                        </a>
                    </div>
                </div>
            </div>

            {{-- RIGHT SIDEBAR --}}
            <div class="w-full lg:w-[300px] flex-shrink-0 space-y-5">
                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl p-5">
                    <div class="flex items-center justify-between mb-3">
                        <p class="text-sm font-semibold text-foreground dark:text-foreground-dark">Tugas belum dikumpulkan</p>
                        <span class="inline-flex items-center justify-center min-w-[20px] h-5 px-1.5 text-xs font-bold rounded-full bg-danger/10 text-danger">4</span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-cyan-50 dark:bg-cyan-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="za-pen-line-duotone w-4 h-4 text-cyan-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Roleplay kepada Atasan</p>
                                <p class="text-xs text-muted dark:text-muted-dark">Batas: -</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-cyan-50 dark:bg-cyan-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="za-pen-line-duotone w-4 h-4 text-cyan-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Tugas PMB 1</p>
                                <p class="text-xs text-muted dark:text-muted-dark">Batas: -</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-cyan-50 dark:bg-cyan-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="za-pen-line-duotone w-4 h-4 text-cyan-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Tugas PMB 2</p>
                                <p class="text-xs text-muted dark:text-muted-dark">Batas: -</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 rounded-lg bg-cyan-50 dark:bg-cyan-900/20 flex items-center justify-center flex-shrink-0">
                                <i class="za-pen-line-duotone w-4 h-4 text-cyan-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-foreground dark:text-foreground-dark truncate">Tugas PMB 3</p>
                                <p class="text-xs text-muted dark:text-muted-dark">Batas: -</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white dark:bg-surface-dark border border-border dark:border-border-dark rounded-xl p-5">
                    <p class="text-sm font-semibold text-foreground dark:text-foreground-dark mb-1">Presensi</p>
                    <p class="text-xs text-muted dark:text-muted-dark mb-4">0 dari 3 Total Sesi</p>
                    <div class="grid grid-cols-4 gap-2 text-center mb-3">
                        <div>
                            <p class="text-xs text-muted dark:text-muted-dark">Hadir</p>
                            <p class="text-lg font-bold text-success">0</p>
                        </div>
                        <div>
                            <p class="text-xs text-muted dark:text-muted-dark">Sakit</p>
                            <p class="text-lg font-bold text-warning">0</p>
                        </div>
                        <div>
                            <p class="text-xs text-muted dark:text-muted-dark">Izin</p>
                            <p class="text-lg font-bold text-info">0</p>
                        </div>
                        <div>
                            <p class="text-xs text-muted dark:text-muted-dark">Alpa</p>
                            <p class="text-lg font-bold text-danger">0</p>
                        </div>
                    </div>
                    <a href="#" class="text-sm font-semibold text-primary hover:text-primary-hover transition-colors">Lihat Detail Presensi</a>
                </div>
            </div>

        </div>
    </div>
</x-ui.layouts.app>
