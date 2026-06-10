# Best Practices

## 1. Gunakan Component, Jangan Hardcode

### Salah
```blade
<button class="bg-blue-500 text-white px-4 py-2 rounded-lg">
    Simpan
</button>
```

### Benar
```blade
<x-ui.button variant="primary">
    Simpan
</x-ui.button>
```

## 2. Gunakan Semantic Colors

### Salah
```blade
<div class="bg-blue-100 text-blue-800">
    Info message
</div>
```

### Benar
```blade
<x-ui.alert type="info">
    Info message
</x-ui.alert>
```

Atau langsung:
```blade
<div class="bg-primary-light text-primary-dark">
    Info message
</div>
```

## 3. Gunakan Spacing Token

### Salah
```blade
<div class="p-4 gap-3">
```

### Benar
```blade
<div class="p-ui-md gap-ui-sm">
```

## 4. Gunakan Heading Component

### Salah
```blade
<h1 class="text-4xl font-bold text-gray-900 dark:text-white">
    Dashboard
</h1>
```

### Benar
```blade
<x-ui.heading level="h1" size="4xl">
    Dashboard
</x-ui.heading>
```

## 5. Form Menggunakan Form Group

### Salah
```blade
<div>
    <label for="email">Email</label>
    <input type="email" id="email" />
    <span class="text-red-500">Error</span>
</div>
```

### Benar
```blade
<x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
    <x-ui.input type="email" name="email" wire:model="email" />
</x-ui.form-group>
```

## 6. Dark Mode Support

Semua component sudah support dark mode secara otomatis. Pastikan:

- File `tailwind.config.js` punya `darkMode: 'class'`
- HTML tag punya class `dark` (via Livewire/Alpine)
- Jangan pakai warna hardcode seperti `bg-gray-100` langsung

## 7. Responsive Design

Gunakan breakpoint Tailwind:
- `sm:` - Mobile landscape (640px+)
- `md:` - Tablet (768px+)
- `lg:` - Desktop (1024px+)
- `xl:` - Large desktop (1280px+)
- `2xl:` - Ultrawide (1536px+)

### Example grid
```blade
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6">
    ...
</div>
```

## 8. Form dengan Livewire

```blade
<form wire:submit="save">
    <x-ui.form-group label="Nama" name="name" :error="$errors->first('name')" required>
        <x-ui.input name="name" wire:model="name" />
    </x-ui.form-group>

    <x-ui.form-group label="Email" name="email" :error="$errors->first('email')" required>
        <x-ui.input type="email" name="email" wire:model="email" />
    </x-ui.form-group>

    <div class="flex justify-end mt-6">
        <x-ui.button type="submit" loading>Simpan</x-ui.button>
    </div>
</form>
```

## 9. Modal dengan Livewire

```blade
{{-- Di Livewire component --}}
<x-ui.modal name="create-user" wire:model="showModal" title="Tambah User">
    <form wire:submit="save">
        <x-ui.form-group label="Nama" name="name">
            <x-ui.input name="name" wire:model="name" />
        </x-ui.form-group>

        <x-slot:footer>
            <x-ui.button type="button" variant="ghost" wire:click="$set('showModal', false)">
                Batal
            </x-ui.button>
            <x-ui.button type="submit">
                Simpan
            </x-ui.button>
        </x-slot:footer>
    </form>
</x-ui.modal>
```

## 10. Jangan Duplikasi

Jika ada pattern yang muncul lebih dari 2 kali, buat component baru.

### Salah
```blade
{{-- Di view 1 --}}
<div class="flex items-center gap-3 p-4 bg-white rounded-xl">
    <x-ui.avatar initials="JD" />
    <div>
        <p class="font-medium">John Doe</p>
        <p class="text-sm text-gray-500">Admin</p>
    </div>
</div>

{{-- Di view 2 (sama persis) --}}
<div class="flex items-center gap-3 p-4 bg-white rounded-xl">
    <x-ui.avatar initials="AK" />
    <div>
        <p class="font-medium">Ahmad K</p>
        <p class="text-sm text-gray-500">User</p>
    </div>
</div>
```

### Benar
```blade
{{-- Buat component: resources/views/ui/user-info.blade.php --}}
<div class="flex items-center gap-3 p-4 bg-white dark:bg-surface-dark rounded-ui-xl border border-border dark:border-border-dark">
    <x-ui.avatar :initials="$initials" />
    <div>
        <p class="font-medium text-foreground dark:text-foreground-dark">{{ $name }}</p>
        <x-ui.text size="sm" color="muted">{{ $role }}</x-ui.text>
    </div>
</div>
```

## 11. Design System Token Reference

Always check `config/design-system.php` before adding a new value.

```php
// colors: primary, secondary, success, danger, warning, info
// spacing: xs, sm, md, lg, xl, 2xl, 3xl, 4xl
// radius: none, sm, md, lg, xl, 2xl, full
// shadow: sm, md, lg, xl, 2xl
// transition: fast(150ms), normal(250ms), slow(350ms)
```

## 12. Aksesibilitas

Semua component sudah include:
- `role` attributes (role="alert", role="dialog", aria-modal)
- Keyboard navigation (ESC untuk modal)
- Focus ring (`focus:ring-2 focus:ring-primary`)
- Screen reader labels
- Semantic HTML (`<nav>`, `<main>`, `<header>`, `<footer>`)
