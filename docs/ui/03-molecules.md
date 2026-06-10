# Molecules

Gabungan beberapa atom menjadi komponen yang lebih bermakna.

---

## Form Group

Wrapper form yang menggabungkan label, input, error, dan hint dalam satu komponen.

### Usage

```blade
{{-- Basic --}}
<x-ui.form-group label="Nama" name="name">
    <x-ui.input name="name" />
</x-ui.form-group>

{{-- Dengan error --}}
<x-ui.form-group
    label="Email"
    name="email"
    error="Email wajib diisi"
    required
>
    <x-ui.input type="email" name="email" />
</x-ui.form-group>

{{-- Dengan hint --}}
<x-ui.form-group
    label="Password"
    name="password"
    hint="Minimal 8 karakter"
    required
>
    <x-ui.input type="password" name="password" />
</x-ui.form-group>

{{-- Dengan Livewire --}}
<x-ui.form-group label="Nama" name="name" :error="$errors->first('name')" required>
    <x-ui.input name="name" wire:model="name" />
</x-ui.form-group>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `label` | string | `null` | Label text |
| `name` | string | `null` | Name attribute (untuk `for` di label) |
| `error` | string | `null` | Pesan error |
| `hint` | string | `null` | Text bantuan |
| `required` | bool | `false` | Tampilkan * |

---

## Form Error

Menampilkan pesan error dengan icon.

### Usage

```blade
<x-ui.form-error>Email wajib diisi</x-ui.form-error>
```

---

## Search Box

Input pencarian dengan icon.

### Usage

```blade
{{-- Basic --}}
<x-ui.search-box />

{{-- Custom placeholder --}}
<x-ui.search-box placeholder="Cari kursus..." />

{{-- Livewire --}}
<x-ui.search-box model="search" />
```

### Props

| Prop | Type | Default |
|------|------|---------|
| `name` | string | `search` |
| `placeholder` | string | `Search...` |
| `model` | string | `null` |

### Notes

- Otomatis menggunakan `wire:model.live.debounce.300ms` jika `model` diisi

---

## Pagination

Navigasi halaman dengan informasi jumlah data.

### Usage

```blade
<x-ui.pagination :paginator="$users" />
```

### Props

| Prop | Type | Default |
|------|------|---------|
| `paginator` | LengthAwarePaginator | `null` |

### Notes

- Otomatis menggunakan `wire:click` untuk navigasi Livewire
- Menampilkan info "Showing X to Y of Z results"

---

## Dropdown

Menu dropdown berbasis AlpineJS.

### Usage

```blade
{{-- Basic --}}
<x-ui.dropdown>
    <x-ui.dropdown-item href="/profile">Profile</x-ui.dropdown-item>
    <x-ui.dropdown-item href="/settings">Settings</x-ui.dropdown-item>
    <x-ui.dropdown-item variant="danger">Logout</x-ui.dropdown-item>
</x-ui.dropdown>

{{-- Dengan custom trigger --}}
<x-ui.dropdown align="right" width="56">
    <x-slot name="trigger">
        <button>Menu</button>
    </x-slot>
    <x-ui.dropdown-item icon="user" href="/profile">Profile</x-ui.dropdown-item>
    <x-ui.dropdown-item icon="settings" href="/settings">Settings</x-ui.dropdown-item>
</x-ui.dropdown>
```

### Props (Dropdown)

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `align` | string | `left` | left, right |
| `width` | string | `48` | 48, 56, 64, 72, auto |
| `trigger` | slot | default button | Custom trigger element |

### Props (Dropdown Item)

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `href` | string | `null` | Link target |
| `icon` | string | `null` | Nama icon |
| `variant` | string | `default` | default, danger |

---

## Sidebar Link

Link navigasi sidebar dengan icon, active state, dan badge.

### Usage

```blade
<x-ui.sidebar-link href="/dashboard" icon="home" :active="request()->routeIs('dashboard')">
    Dashboard
</x-ui.sidebar-link>

<x-ui.sidebar-link href="/courses" icon="book" badge="12">
    Courses
</x-ui.sidebar-link>

<x-ui.sidebar-link icon="settings" badge="New">
    Settings
</x-ui.sidebar-link>
```

### Props

| Prop | Type | Default | Description |
|------|------|---------|-------------|
| `href` | string | `null` | Link URL |
| `icon` | string | `null` | Nama icon |
| `active` | bool | `false` | Active state |
| `badge` | string | `null` | Badge counter/label |
