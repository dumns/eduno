# Organisms

Komponen kompleks yang terdiri dari beberapa atoms dan molecules.

---

## Card

Container dengan header, body, dan footer slots.

### Usage

```blade
{{-- Basic --}}
<x-ui.card>
    Content disini
</x-ui.card>

{{-- Dengan header dan footer --}}
<x-ui.card variant="elevated">
    <x-slot:header>
        <x-ui.heading level="h3">Judul Card</x-ui.heading>
    </x-slot:header>

    Body content...

    <x-slot:footer>
        <x-ui.button>Simpan</x-ui.button>
    </x-slot:footer>
</x-ui.card>

{{-- Variant --}}
<x-ui.card variant="default">Default</x-ui.card>
<x-ui.card variant="elevated">Elevated with shadow</x-ui.card>
<x-ui.card variant="outlined">Outlined border</x-ui.card>
<x-ui.card variant="flat">Flat background</x-ui.card>
<x-ui.card variant="ghost">No border/shadow</x-ui.card>

{{-- Padding --}}
<x-ui.card padding="none">No padding</x-ui.card>
<x-ui.card padding="xs">Extra small</x-ui.card>
<x-ui.card padding="sm">Small</x-ui.card>
<x-ui.card padding="md">Medium (default)</x-ui.card>
<x-ui.card padding="lg">Large</x-ui.card>
<x-ui.card padding="xl">Extra large</x-ui.card>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `variant` | string | `default` | default, elevated, outlined, flat, ghost |
| `padding` | string | `md` | none, xs, sm, md, lg, xl |

### Slots

| Slot | Description |
|------|-------------|
| `header` | Header section (with bottom border) |
| *default* | Body content |
| `footer` | Footer section (with top border) |

---

## Alert

Pesan notifikasi dengan icon dan opsi dismissible.

### Usage

```blade
{{-- Types --}}
<x-ui.alert type="success">Berhasil disimpan!</x-ui.alert>
<x-ui.alert type="danger">Terjadi kesalahan!</x-ui.alert>
<x-ui.alert type="warning">Perhatikan ini!</x-ui.alert>
<x-ui.alert type="info">Informasi penting!</x-ui.alert>
<x-ui.alert type="primary">Fitur baru tersedia!</x-ui.alert>

{{-- Dengan title --}}
<x-ui.alert type="success" title="Berhasil!">
    Data berhasil disimpan ke database.
</x-ui.alert>

{{-- Dismissible --}}
<x-ui.alert type="warning" :dismissible="true">
    Periksa kembali data anda.
</x-ui.alert>

{{-- Tanpa icon --}}
<x-ui.alert type="info" :icon="false">
    Custom content tanpa icon.
</x-ui.alert>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `type` | string | `info` | success, danger, warning, info, primary |
| `dismissible` | bool | `false` | Tampilkan tombol close |
| `icon` | bool | `true` | Tampilkan icon |
| `title` | string | `null` | Title text |

---

## Modal

Dialog modal dengan AlpineJS, event-driven.

### Usage

```blade
{{-- Basic --}}
<x-ui.modal name="my-modal" title="Konfirmasi">
    Apakah anda yakin?
</x-ui.modal>

{{-- Dengan ukuran --}}
<x-ui.modal name="large-modal" size="lg">
    Konten besar...
</x-ui.modal>

{{-- Dengan footer --}}
<x-ui.modal name="confirm" title="Hapus Data?">
    Data akan dihapus permanen.
    <x-slot:footer>
        <x-ui.button x-on:click="$dispatch('close')">Batal</x-ui.button>
        <x-ui.button variant="danger">Hapus</x-ui.button>
    </x-slot:footer>
</x-ui.modal>

{{-- Livewire binding --}}
<x-ui.modal name="edit-user" wire:model="showEditModal">
    ...
</x-ui.modal>

{{-- Event-driven --}}
<x-ui.button x-data="" x-on:click="$dispatch('open-modal', 'my-modal')">
    Buka Modal
</x-ui.button>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `name` | string | `modal` | Unique identifier |
| `size` | string | `md` | sm, md, lg, xl, 2xl, full |
| `maxWidth` | string | `null` | Custom max-width override |
| `title` | string | `null` | Title di header |
| `closeable` | bool | `true` | Bisa ditutup |
| `show` | bool | `false` | Initial state |

### Events

| Event | Description |
|-------|-------------|
| `open-modal` | Buka modal: `$dispatch('open-modal', 'nama-modal')` |
| `close` | Tutup modal: `$dispatch('close')` |
| `keydown.escape.window` | Tutup dengan ESC |

---

## Table & Table Column

Tabel data dengan header sortable.

### Usage

```blade
<x-ui.table>
    <x-slot:header>
        <x-ui.table-column type="header" sortable field="name">Nama</x-ui.table-column>
        <x-ui.table-column type="header" sortable field="email">Email</x-ui.table-column>
        <x-ui.table-column type="header">Aksi</x-ui.table-column>
    </x-slot:header>

    <tr>
        <x-ui.table-column>John Doe</x-ui.table-column>
        <x-ui.table-column>john@example.com</x-ui.table-column>
        <x-ui.table-column>
            <x-ui.button size="sm" variant="ghost">Edit</x-ui.button>
        </x-ui.table-column>
    </tr>
</x-ui.table>
```

### Props (Table)

| Prop | Type | Default |
|------|------|---------|
| `striped` | bool | `false` |
| `hover` | bool | `true` |
| `compact` | bool | `false` |
| `responsive` | bool | `true` |

### Props (Table Column)

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `sortable` | bool | `false` | Enable sorting |
| `field` | string | `null` | Field name for sorting |
| `align` | string | `left` | left, center, right |
| `type` | string | `header` | header, cell |

### Notes

- Sorting menggunakan `wire:click="sortBy('{{ $field }}')"` untuk Livewire
- Sort direction indicator otomatis tampil dengan icon chevron

---

## Stat Card

Card untuk menampilkan statistik dengan icon dan trend.

### Usage

```blade
<x-ui.stat-card
    title="Total Users"
    value="1,234"
    icon="user"
    variant="primary"
    trend="+12%"
    trendType="up"
/>

<x-ui.stat-card
    title="Revenue"
    value="$45,678"
    icon="credit-card"
    variant="success"
    trend="+8.5%"
    trendType="up"
/>

<x-ui.stat-card
    title="Bounce Rate"
    value="3.2%"
    icon="chevron-down"
    variant="danger"
    trend="+1.2%"
    trendType="down"
/>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `title` | string | `null` | Label |
| `value` | string | `null` | Nilai utama |
| `icon` | string | `null` | Nama icon |
| `trend` | string | `null` | Text trend |
| `trendType` | string | `up` | up, down |
| `variant` | string | `primary` | primary, secondary, success, danger, warning, info |

---

## Navbar

Navigation bar dengan brand, nav links, actions, dan mobile menu.

### Usage

```blade
<x-ui.navbar brand="MyApp" brandRoute="/">
    <x-slot:nav>
        <x-ui.button variant="ghost" size="sm" href="/courses">Courses</x-ui.button>
    </x-slot:nav>
    <x-slot:actions>
        <x-ui.button size="sm">Login</x-ui.button>
    </x-slot:actions>
    <x-slot:mobileNav>
        <x-ui.button variant="ghost" href="/courses">Courses</x-ui.button>
    </x-slot:mobileNav>
</x-ui.navbar>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `brand` | string/slot | `null` | Brand logo/text |
| `brandRoute` | string | `/` | Brand link |
| `sticky` | bool | `true` | Sticky position |

### Slots

| Slot | Description |
|------|-------------|
| `nav` | Desktop navigation links |
| `actions` | Right side actions (buttons, profile) |
| `mobileNav` | Mobile menu content |

---

## Sidebar

Sidebar navigasi dengan toggle collapse.

### Usage

```blade
<x-ui.sidebar>
    <x-slot:header>
        <span class="font-bold">MyApp</span>
    </x-slot:header>

    <x-ui.sidebar-link href="/" icon="home" :active="request()->routeIs('home')">
        Home
    </x-ui.sidebar-link>
    <x-ui.sidebar-link href="/courses" icon="book" :active="request()->routeIs('courses')">
        Courses
    </x-ui.sidebar-link>

    <x-slot:footer>
        <x-ui.sidebar-link href="/logout" icon="close" variant="danger">
            Logout
        </x-ui.sidebar-link>
    </x-slot:footer>
</x-ui.sidebar>
```

### Props

| Prop | Type | Default |
|------|------|---------|
| `collapsible` | bool | `true` |

### Slots

| Slot | Description |
|------|-------------|
| `header` | Sidebar header |
| *default* | Navigation links |
| `footer` | Sidebar footer |
