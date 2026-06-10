# Atoms

Komponen terkecil dan paling dasar dalam sistem desain.

---

## Button

Button universal dengan dukungan variant, size, icon, loading state, dan link mode.

### Usage

```blade
{{-- Basic --}}
<x-ui.button>Simpan</x-ui.button>

{{-- Dengan variant --}}
<x-ui.button variant="primary">Primary</x-ui.button>
<x-ui.button variant="secondary">Secondary</x-ui.button>
<x-ui.button variant="success">Success</x-ui.button>
<x-ui.button variant="danger">Danger</x-ui.button>
<x-ui.button variant="warning">Warning</x-ui.button>
<x-ui.button variant="outline">Outline</x-ui.button>
<x-ui.button variant="ghost">Ghost</x-ui.button>

{{-- Dengan size --}}
<x-ui.button size="xs">Extra Small</x-ui.button>
<x-ui.button size="sm">Small</x-ui.button>
<x-ui.button size="md">Medium</x-ui.button>
<x-ui.button size="lg">Large</x-ui.button>
<x-ui.button size="xl">Extra Large</x-ui.button>

{{-- Dengan icon --}}
<x-ui.button icon="trash">Hapus</x-ui.button>
<x-ui.button icon="plus" size="sm" />

{{-- Loading state --}}
<x-ui.button loading>Menyimpan...</x-ui.button>

{{-- Disabled --}}
<x-ui.button disabled>Tidak Aktif</x-ui.button>

{{-- Sebagai link --}}
<x-ui.button href="/dashboard">Dashboard</x-ui.button>

{{-- Dengan Livewire --}}
<x-ui.button wire:click="save">Simpan</x-ui.button>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `variant` | string | `primary` | primary, secondary, success, danger, warning, outline, ghost |
| `size` | string | `md` | xs, sm, md, lg, xl |
| `icon` | string | `null` | Nama icon (lihat Icon component) |
| `iconPosition` | string | `left` | left, right |
| `loading` | bool | `false` | - |
| `disabled` | bool | `false` | - |
| `type` | string | `button` | button, submit, reset |
| `href` | string | `null` | Ubah button jadi link |

### Notes

- Saat `loading` true, icon akan diganti spinner animasi
- Saat `disabled`, component otomatis mendapat class `opacity-50 cursor-not-allowed`
- Jika `href` diberikan, render sebagai `<a>` tag

---

## Input

Input field universal dengan dukungan label, error, hint, prefix/suffix, dan textarea.

### Usage

```blade
{{-- Basic --}}
<x-ui.input name="email" />

{{-- Dengan label --}}
<x-ui.input label="Email" name="email" />

{{-- Tipe berbeda --}}
<x-ui.input type="email" label="Email" name="email" />
<x-ui.input type="password" label="Password" name="password" />
<x-ui.input type="textarea" label="Bio" name="bio" />
<x-ui.input type="number" label="Umur" name="age" />

{{-- Error state --}}
<x-ui.input label="Email" name="email" error="Email wajib diisi" />

{{-- Hint text --}}
<x-ui.input label="Password" name="password" hint="Minimal 8 karakter" />

{{-- Prefix/Suffix --}}
<x-ui.input label="Harga" name="price" prefix="$" />
<x-ui.input label="Domain" name="domain" suffix=".com" />

{{-- Livewire model --}}
<x-ui.input label="Nama" name="name" model="name" />

{{-- Disabled/Readonly --}}
<x-ui.input label="Email" name="email" disabled />
<x-ui.input label="Role" name="role" readonly />
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `type` | string | `text` | text, email, password, number, textarea, dll |
| `label` | string | `null` | - |
| `name` | string | `null` | - |
| `error` | string | `null` | Pesan error |
| `hint` | string | `null` | Text bantuan |
| `disabled` | bool | `false` | - |
| `readonly` | bool | `false` | - |
| `required` | bool | `false` | - |
| `prefix` | string | `null` | Text/icon sebelum input |
| `suffix` | string | `null` | Text/icon setelah input |
| `model` | string | `null` | Livewire model binding |

### Notes

- Saat `type="textarea"`, render sebagai `<textarea>` dengan 3 rows
- Error dan hint tidak bisa tampil bersamaan
- Required otomatis menambah `*` merah di label

---

## Badge

Label kecil untuk menampilkan status atau kategori.

### Usage

```blade
{{-- Basic --}}
<x-ui.badge>Active</x-ui.badge>

{{-- Variant --}}
<x-ui.badge variant="primary">Baru</x-ui.badge>
<x-ui.badge variant="success">Selesai</x-ui.badge>
<x-ui.badge variant="danger">Error</x-ui.badge>
<x-ui.badge variant="warning">Pending</x-ui.badge>
<x-ui.badge variant="info">Info</x-ui.badge>
<x-ui.badge variant="neutral">Draft</x-ui.badge>

{{-- Size --}}
<x-ui.badge size="xs">Mini</x-ui.badge>
<x-ui.badge size="sm">Small</x-ui.badge>
<x-ui.badge size="md">Medium</x-ui.badge>
<x-ui.badge size="lg">Large</x-ui.badge>

{{-- Dengan dot --}}
<x-ui.badge variant="success" dot>Online</x-ui.badge>
<x-ui.badge variant="danger" dot>Offline</x-ui.badge>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `variant` | string | `primary` | primary, secondary, success, danger, warning, info, neutral |
| `size` | string | `sm` | xs, sm, md, lg |
| `dot` | bool | `false` | Tampilkan indikator dot |

---

## Avatar

Foto profil atau placeholder dengan inisial dan status.

### Usage

```blade
{{-- Dengan gambar --}}
<x-ui.avatar src="/storage/photo.jpg" alt="User" />

{{-- Dengan inisial --}}
<x-ui.avatar initials="JD" />

{{-- Size --}}
<x-ui.avatar initials="JD" size="xs" />
<x-ui.avatar initials="JD" size="sm" />
<x-ui.avatar initials="JD" size="md" />
<x-ui.avatar initials="JD" size="lg" />
<x-ui.avatar initials="JD" size="xl" />
<x-ui.avatar initials="JD" size="2xl" />

{{-- Dengan status --}}
<x-ui.avatar initials="JD" status="online" />
<x-ui.avatar initials="JD" status="offline" />
<x-ui.avatar initials="JD" status="away" />
<x-ui.avatar initials="JD" status="busy" />
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `src` | string | `null` | URL gambar |
| `alt` | string | `''` | Alt text |
| `size` | string | `md` | xs, sm, md, lg, xl, 2xl |
| `status` | string | `null` | online, offline, away, busy |
| `initials` | string | `null` | Inisial user |

---

## Heading

Judul halaman/section dengan semantic HTML.

### Usage

```blade
{{-- Level h1-h6 --}}
<x-ui.heading level="h1">Halaman Utama</x-ui.heading>
<x-ui.heading level="h2">Section Title</x-ui.heading>
<x-ui.heading level="h3">Sub Section</x-ui.heading>

{{-- Custom size --}}
<x-ui.heading size="4xl">Large Heading</x-ui.heading>
<x-ui.heading size="xs">Small Heading</x-ui.heading>

{{-- Weight --}}
<x-ui.heading weight="bold">Bold Title</x-ui.heading>
<x-ui.heading weight="extrabold">Extra Bold</x-ui.heading>

{{-- Color --}}
<x-ui.heading color="primary">Primary Color</x-ui.heading>
<x-ui.heading color="muted">Muted Color</x-ui.heading>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `level` | string | `h2` | h1-h6 |
| `size` | string | `null` | Otomatis dari level, bisa override |
| `weight` | string | `semibold` | light, normal, medium, semibold, bold, extrabold |
| `color` | string | `default` | default, primary, secondary, muted, white |

---

## Text

Paragraf dan text content dengan styling.

### Usage

```blade
{{-- Size --}}
<x-ui.text size="xs">Extra Small</x-ui.text>
<x-ui.text size="sm">Small</x-ui.text>
<x-ui.text size="base">Default</x-ui.text>
<x-ui.text size="lg">Large</x-ui.text>

{{-- Color --}}
<x-ui.text color="muted">Muted text</x-ui.text>
<x-ui.text color="success">Success text</x-ui.text>
<x-ui.text color="danger">Danger text</x-ui.text>

{{-- Alignment --}}
<x-ui.text align="center">Center aligned</x-ui.text>
<x-ui.text align="right">Right aligned</x-ui.text>

{{-- Leading --}}
<x-ui.text leading="relaxed">Relaxed line height</x-ui.text>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `size` | string | `base` | xs, sm, base, lg, xl, 2xl |
| `weight` | string | `normal` | light, normal, medium, semibold, bold |
| `color` | string | `default` | default, muted, primary, success, danger, warning, info, white |
| `align` | string | `null` | left, center, right |
| `leading` | string | `null` | none, tight, snug, normal, relaxed, loose |

---

## Icon

30+ Heroicons built-in tanpa dependensi eksternal.

### Usage

```blade
{{-- Basic --}}
<x-ui.icon name="search" />

{{-- Size --}}
<x-ui.icon name="search" size="xs" />
<x-ui.icon name="search" size="sm" />
<x-ui.icon name="search" size="md" />
<x-ui.icon name="search" size="lg" />
<x-ui.icon name="search" size="xl" />
<x-ui.icon name="search" size="2xl" />
```

### Available Icons

| Kategori | Icons |
|----------|-------|
| Navigation | home, menu, close, chevron-down, chevron-up, chevron-left, chevron-right, search |
| Actions | edit, trash, plus, check, close, copy, share, download, upload, filter, sort, settings |
| Auth | user, mail, lock, eye, eye-off |
| Notifications | bell, info, alert-triangle, alert-circle, check-circle, x-circle, check-badge |
| Media | play, image, camera, book, star, heart, calendar, clock |
| Commerce | credit-card, external-link |

---

## Label

Label form element dengan required indicator.

### Usage

```blade
<x-ui.label for="email">Email Address</x-ui.label>
<x-ui.label for="password" required>Password</x-ui.label>
```

### Props

| Prop | Type | Default | Options |
|------|------|---------|---------|
| `for` | string | `null` | ID target input |
| `required` | bool | `false` | Tampilkan * |

---

## Checkbox / Radio / Switch

Input pilihan dengan styling konsisten.

### Usage

```blade
{{-- Checkbox --}}
<x-ui.checkbox name="agree" label="Setuju dengan syarat" />
<x-ui.checkbox name="remember" label="Ingat saya" checked />
<x-ui.checkbox name="feature" label="Fitur" disabled />

{{-- Radio --}}
<x-ui.radio name="gender" value="male" label="Laki-laki" />
<x-ui.radio name="gender" value="female" label="Perempuan" />

{{-- Switch --}}
<x-ui.switch name="notif" label="Notifikasi" description="Terima notifikasi email" />
<x-ui.switch name="dark" label="Mode Gelap" checked />

{{-- Livewire model --}}
<x-ui.checkbox name="agree" model="agree" />
<x-ui.switch name="active" model="isActive" />
```

### Props (Checkbox/Radio)

| Prop | Type | Default |
|------|------|---------|
| `name` | string | `null` |
| `label` | string | `null` |
| `checked` | bool | `false` |
| `disabled` | bool | `false` |
| `model` | string | `null` |

### Props (Switch)

| Prop | Type | Default |
|------|------|---------|
| `name` | string | `null` |
| `label` | string | `null` |
| `description` | string | `null` |
| `checked` | bool | `false` |
| `disabled` | bool | `false` |
| `model` | string | `null` |
