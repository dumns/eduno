# Navigation — Penyesuaian Menu

Dokumentasi struktur navigasi dan penyesuaian yang telah dilakukan pada sistem menu aplikasi Eduno.

## Struktur Navigasi

Navigasi terdiri dari dua bagian utama:

### 1. Desktop Top Navigation (`navigation.blade.php`)

Navigasi utama di bagian atas halaman (desktop):

```
┌─────────────────────────────────────────────────────┐
│  Logo      Beranda  Timeline & Berita  Obrolan  ...  │    Support  🔔  User ▼
└─────────────────────────────────────────────────────┘
```

- **Kiri**: Logo + nav links (inline-flex, horizontal)
- **Kanan**: Support button, Notification bell, User dropdown

### 2. Mobile Sidebar

Di layar `lg:`, nav links berubah menjadi sidebar yang muncul dengan tombol hamburger.

### Key Files

| File | Role |
|------|------|
| `resources/views/livewire/layout/navigation.blade.php` | Main navigation view (Livewire layout) |
| `resources/views/components/ui/navbar.blade.php` | Navbar organism component |
| `resources/views/components/ui/sidebar.blade.php` | Sidebar organism component |
| `resources/views/components/ui/sidebar-link.blade.php` | Sidebar link molecule component |
| `resources/views/components/ui/dropdown.blade.php` | User dropdown component |
| `resources/views/components/ui/dropdown-item.blade.php` | Dropdown item component |

## Nav Links

Daftar link navigasi yang tersedia:

| Link | Route | Icon Zappicon |
|------|-------|---------------|
| Beranda | `dashboard` | `za-house-duotone` |
| Timeline & Berita | `dashboard` | `za-file-text-duotone` |
| Obrolan | `dashboard` | `za-chat-dots-duotone` |
| Jelajah | `dashboard` | `za-compass-duotone` |

### Active State

Link aktif ditandai dengan class `bg-gray-100 dark:bg-gray-800 text-foreground`. Deteksi route menggunakan `request()->routeIs()`.

```blade
<a href="{{ route('dashboard') }}" wire:navigate
   class="... {{ request()->routeIs('dashboard')
       ? 'bg-gray-100 dark:bg-gray-800 text-foreground'
       : 'text-muted hover:text-foreground hover:bg-gray-50' }}">
```

### Ikon Duotone

Semua ikon navigasi menggunakan varian **duotone** untuk efek opacity khas Zappicon:

```blade
<i class="za-house-duotone w-5 h-5"></i>
<i class="za-file-text-duotone w-5 h-5"></i>
<i class="za-chat-dots-duotone w-5 h-5"></i>
<i class="za-compass-duotone w-5 h-5"></i>
```

### Whitespace on Long Text

Link "Timeline & Berita" memiliki &`whitespace-nowrap` agar teks tidak pindah baris:

```blade
<span class="whitespace-nowrap">Timeline &amp; Berita</span>
```

## Mobile Toggle

Tombol hamburger di mobile menggunakan Alpine.js:

```blade
<i class="za-menu-bars-duotone h-6 w-6"
   :class="{'hidden': mobileOpen, 'inline-flex': !mobileOpen}"
   @@click="mobileOpen = true"></i>
<i class="za-xmark-duotone h-6 w-6"
   :class="{'hidden': !mobileOpen, 'inline-flex': mobileOpen}"
   @@click="mobileOpen = false"></i>
```

- `mobileOpen` — state boolean di Alpine.js
- `@@click` — toggle visibility
- `x-bind:class` — binding class dinamis (pakai `x-bind:` bukan `:class` untuk hindari parse error Blade)

## Right Section

### Support Button

Icon `za-life-ring-duotone`, hidden di mobile (`hidden xl:inline-flex`).

### Notification Bell

Menggunakan komponen `x-ui:icon` dengan mapping `bell` → `za-bell-duotone`:

```blade
<x-ui.icon name="bell" size="sm" />
```

### User Dropdown

Dropdown user dengan avatar dan menu:

```blade
<x-ui.icon name="user" size="sm" />
<x-ui.icon name="chevron-down" size="xs" x-bind:class="{'rotate-180': open}" />
```

## Penyesuaian yang Dilakukan

| Perubahan | File | Keterangan |
|-----------|------|------------|
| Inline SVG → Zappicon duotone | `navigation.blade.php` | Semua ikon nav diganti |
| Fix `:class` → `x-bind:class` | `navigation.blade.php` | Hindari parse error Blade vs Alpine |
| Tambah `whitespace-nowrap` | `navigation.blade.php` | "Timeline &amp; Berita" tidak wrapping |
| Mobile toggle icons | `navigation.blade.php` | `za-menu-bars-duotone` / `za-xmark-duotone` |
| Icon mapping bell | `icon.blade.php` | `bell` → Zappicon |
| Default variant duotone | `icon.blade.php` | Semua ikon via komponen jadi duotone |
| Safelist classes | `tailwind.config.js` | 49 kelas Zappicon di-safelist untuk JIT |

## Build Note

Setelah perubahan, jalankan build ulang:

```bash
npm run build
```
