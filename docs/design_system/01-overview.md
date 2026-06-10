# EDUNO UI Design System

Dokumentasi komponen UI untuk aplikasi Eduno LMS. Dibangun dengan **Laravel Blade Components**, **Tailwind CSS 3**, **AlpineJS**, dan **Livewire 3**.

## Architecture

Semua komponen berada di `resources/views/components/ui/` dan dapat dipanggil dengan `x-ui.*` tanpa registrasi tambahan.

```
resources/views/components/ui/
├── button.blade.php        # Atom
├── input.blade.php         # Atom
├── badge.blade.php         # Atom
├── heading.blade.php       # Atom
├── text.blade.php          # Atom
├── icon.blade.php          # Atom
├── label.blade.php         # Atom
├── avatar.blade.php        # Atom
├── checkbox.blade.php      # Atom
├── radio.blade.php         # Atom
├── switch.blade.php        # Atom
│
├── form-group.blade.php    # Molecule
├── form-error.blade.php    # Molecule
├── form-label.blade.php    # Molecule
├── search-box.blade.php    # Molecule
├── pagination.blade.php    # Molecule
├── dropdown.blade.php      # Molecule
├── dropdown-item.blade.php # Molecule
├── sidebar-link.blade.php  # Molecule
│
├── card.blade.php          # Organism
├── alert.blade.php         # Organism
├── modal.blade.php         # Organism
├── table.blade.php         # Organism
├── table-column.blade.php  # Organism
├── stat-card.blade.php     # Organism
├── navbar.blade.php        # Organism
├── sidebar.blade.php       # Organism
│
├── layouts/
│   ├── app.blade.php       # Template
│   ├── guest.blade.php     # Template
│   └── admin.blade.php     # Template
│
└── templates/
    └── dashboard.blade.php # Template
```

## Prinsip Dasar

1. **Tidak boleh hardcode UI** - Semua elemen harus component
2. **Semua warna pakai Theme Token** - `bg-primary`, `text-danger`, `border-border`
3. **Semua spacing pakai token** - `p-ui-md`, `gap-ui-sm`
4. **Semua typography pakai component** - `x-ui.heading`, `x-ui.text`
5. **Atomic Design** - Atoms → Molecules → Organisms → Templates
6. **Single Source of Truth** - Ubah 1 file, seluruh aplikasi berubah
7. **Dark Mode** - Semua component support `dark:`
8. **Responsive** - Semua breakpoint: `sm:`, `md:`, `lg:`, `xl:`, `2xl:`

## Quick Start

```blade
{{-- Gunakan component di view manapun --}}
<x-ui.button variant="primary" size="md">
    Simpan
</x-ui.button>

<x-ui.input label="Email" type="email" name="email" />

<x-ui.card>
    <x-slot:header>
        <x-ui.heading level="h3">Judul Card</x-ui.heading>
    </x-slot:header>
    Content card disini
</x-ui.card>
```

## Design Token

Semua token didefinisikan di `config/design-system.php` dan `tailwind.config.js`.

### Colors

| Token | Default | Dark Mode |
|-------|---------|-----------|
| `primary` | `#0595CF` | - |
| `primary-hover` | `#047AB5` | - |
| `primary-light` | `#E0F4FE` | - |
| `secondary` | `#0EA5E9` | - |
| `success` | `#22C55E` | - |
| `danger` | `#EF4444` | - |
| `warning` | `#F59E0B` | - |
| `info` | `#3B82F6` | - |
| `foreground` | `#0F172A` | `#F1F5F9` |
| `background` | `#FFFFFF` | `#0F172A` |
| `surface` | `#F8FAFC` | `#1E293B` |
| `muted` | `#64748B` | `#94A3B8` |
| `border` | `#E2E8F0` | `#334155` |

### Spacing

| Class | Value |
|-------|-------|
| `p-ui-xs` | 0.25rem |
| `p-ui-sm` | 0.5rem |
| `p-ui-md` | 1rem |
| `p-ui-lg` | 1.5rem |
| `p-ui-xl` | 2rem |
| `p-ui-2xl` | 3rem |
| `p-ui-3xl` | 4rem |
| `p-ui-4xl` | 6rem |

### Font

- **Family**: Plus Jakarta Sans (Google Fonts)
- **Weights**: 300, 400, 500, 600, 700, 800
- **Usage**: Cukup tambahkan `class="font-sans"` (default body)

### Aliases

Semua component dapat dipanggil dengan prefix `x-ui.`:

```blade
{{ -- Nama file: resources/views/ui/button.blade.php -- }}
<x-ui.button variant="primary" />
```
