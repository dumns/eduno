# Layouts & Templates

Template halaman yang menggabungkan organisms menjadi layout lengkap.

---

## App Layout

Layout utama untuk halaman yang membutuhkan autentikasi.

### Usage

```blade
<x-ui.layouts.app>
    <x-slot name="title">Dashboard</x-slot>

    <x-slot name="header">
        <x-ui.heading level="h1">Dashboard</x-ui.heading>
    </x-slot>

    Content halaman disini...

    <x-slot name="footer">
        &copy; 2026 MyApp
    </x-slot>
</x-ui.layouts.app>
```

### Slots

| Slot | Description |
|------|-------------|
| `title` | Page title (browser tab) |
| `navbar` | Custom navbar (default: `livewire:layout.navigation`) |
| `header` | Page header section |
| *default* | Main content |
| `footer` | Page footer |

---

## Guest Layout

Layout untuk halaman publik/auth (login, register, dll).

### Usage

```blade
<x-ui.layouts.guest>
    <x-slot name="title">Login</x-slot>

    <x-slot name="logo">
        <img src="/logo.png" alt="Logo" class="h-12" />
    </x-slot>

    Form login disini...

    <x-slot name="footer">
        <a href="/register">Daftar</a>
    </x-slot>
</x-ui.layouts.guest>
```

### Slots

| Slot | Description |
|------|-------------|
| `title` | Page title |
| `logo` | Custom logo (default: app logo + name) |
| *default* | Form content |
| `footer` | Additional links below form |

---

## Admin Layout

Layout untuk admin panel dengan sidebar.

### Usage

```blade
<x-ui.layouts.admin>
    <x-slot name="title">Admin Panel</x-slot>

    <x-slot name="sidebar">
        <x-ui.sidebar>
            <x-ui.sidebar-link href="/admin" icon="home">Dashboard</x-ui.sidebar-link>
        </x-ui.sidebar>
    </x-slot>

    <x-slot name="navbar">
        <x-ui.navbar brand="Admin" />
    </x-slot>

    Content admin disini...
</x-ui.layouts.admin>
```

### Slots

| Slot | Description |
|------|-------------|
| `title` | Page title |
| `sidebar` | Sidebar component |
| `navbar` | Top navbar |
| *default* | Main content |

---

## Dashboard Template

Template halaman dashboard dengan title dan subtitle.

### Usage

```blade
<x-ui.templates.dashboard title="Dashboard" subtitle="Welcome back, John!">
    <div class="grid grid-cols-4 gap-6">
        <x-ui.stat-card title="Users" value="1,234" icon="user" />
        <x-ui.stat-card title="Revenue" value="$45K" icon="credit-card" />
    </div>
</x-ui.templates.dashboard>
```

### Props

| Prop | Type | Default |
|------|------|---------|
| `title` | string | `Dashboard` |
| `subtitle` | string | `null` |
