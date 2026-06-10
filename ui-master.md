# MASTER PROMPT

Bertindaklah sebagai Senior Laravel Architect, Senior Frontend Engineer, dan Design System Engineer.

Buatkan struktur UI Component Architecture untuk aplikasi Laravel menggunakan:

* Laravel 12+
* Livewire 3
* Tailwind CSS 4
* AlpineJS
* Blade Components
* PHP 8.3+

Tujuan utama:

Semua UI harus berbasis reusable component.

Jika terdapat perubahan desain, developer hanya perlu mengubah 1 component source dan seluruh halaman yang menggunakan component tersebut ikut berubah secara otomatis.

Gunakan prinsip:

* DRY (Don't Repeat Yourself)
* Atomic Design
* Design System
* Component Driven Development (CDD)
* Single Source of Truth
* SOLID Principle
* Clean Architecture

---

# ATURAN WAJIB

## 1. Tidak boleh hardcode UI

SALAH

```html
<button class="bg-blue-500 px-4 py-2">
    Save
</button>
```

BENAR

```blade
<x-ui.button>
    Save
</x-ui.button>
```

Semua elemen harus menjadi component.

---

## 2. Semua warna menggunakan Theme Token

Dilarang:

```html
bg-blue-500
text-red-500
border-gray-200
```

Gunakan:

```html
bg-primary
bg-secondary
text-primary
text-danger
border-default
```

Konfigurasi berada pada:

```php
config/theme.php
```

Contoh:

```php
return [
    'primary' => '#0595CF',
    'secondary' => '#0EA5E9',
    'success' => '#22C55E',
    'danger' => '#EF4444',
    'warning' => '#F59E0B',
];
```

---

## 3. Semua spacing menggunakan token

Jangan:

```html
p-3
p-4
p-5
```

Gunakan:

```html
ui-padding-sm
ui-padding-md
ui-padding-lg
```

Agar seluruh aplikasi dapat diubah hanya dari satu tempat.

---

## 4. Semua typography menggunakan component

Jangan:

```html
<h1 class="text-4xl font-bold">
```

Gunakan:

```blade
<x-ui.heading
    size="xl"
>
    Dashboard
</x-ui.heading>
```

---

# STRUKTUR FOLDER

Buat struktur seperti berikut:

```text
app/
 ├── Livewire
 │
resources/
 ├── views
 │   ├── components
 │   │
 │   ├── ui
 │   │   ├── atoms
 │   │   ├── molecules
 │   │   ├── organisms
 │   │   ├── layouts
 │   │   └── templates
```

---

# ATOMIC DESIGN

## Atoms

Komponen terkecil.

Contoh:

```text
Button
Input
Checkbox
Radio
Switch
Badge
Avatar
Label
Heading
Text
Icon
```

---

## Molecules

Gabungan beberapa atom.

Contoh:

```text
Search Box
Form Group
Card Header
User Info
Pagination
Dropdown
```

---

## Organisms

Komponen kompleks.

Contoh:

```text
DataTable
Sidebar
Navbar
Modal
Form Builder
Statistics Card
```

---

## Templates

Template halaman.

Contoh:

```text
Auth Layout
Dashboard Layout
Guest Layout
Admin Layout
```

---

# COMPONENT STANDARD

Semua component harus memiliki:

## Variant

```blade
<x-ui.button
    variant="primary"
/>
```

Pilihan:

```text
primary
secondary
success
danger
warning
outline
ghost
```

---

## Size

```blade
size="xs"
size="sm"
size="md"
size="lg"
size="xl"
```

---

## State

```blade
disabled
loading
readonly
```

---

## Slot

```blade
<x-ui.card>
    <x-slot:header>
        Header
    </x-slot>

    Content

    <x-slot:footer>
        Footer
    </x-slot>
</x-ui.card>
```

---

# BUTTON COMPONENT

Buat button universal.

Support:

```blade
<x-ui.button />

<x-ui.button
    variant="primary"
/>

<x-ui.button
    variant="danger"
/>

<x-ui.button
    icon="trash"
/>

<x-ui.button
    loading
/>
```

Semua style berada pada:

```php
app/View/Components/UI/Button.php
```

atau

```php
resources/views/components/ui/button.blade.php
```

---

# INPUT COMPONENT

Support:

```blade
<x-ui.input
    label="Nama"
/>

<x-ui.input
    type="email"
/>

<x-ui.input
    type="password"
/>

<x-ui.input
    error="Email wajib"
/>
```

---

# FORM SYSTEM

Dilarang membuat:

```html
<label>
<input>
<span>
```

berulang.

Gunakan:

```blade
<x-ui.form.group>

    <x-ui.form.label />

    <x-ui.input />

    <x-ui.form.error />

</x-ui.form.group>
```

---

# LIVEWIRE STANDARD

Semua CRUD wajib menggunakan:

```php
Livewire Component
```

Bukan controller tradisional.

Contoh:

```text
Users/
 ├── Index.php
 ├── Create.php
 ├── Edit.php
 ├── Show.php
```

---

# TABLE COMPONENT

Buat DataTable reusable.

Contoh:

```blade
<x-ui.table>

    <x-ui.table.column>
        Nama
    </x-ui.table.column>

</x-ui.table>
```

Support:

* sorting
* searching
* pagination
* bulk delete
* export
* filter

---

# MODAL COMPONENT

Semua modal menggunakan satu component.

```blade
<x-ui.modal
    name="create-user"
/>
```

Tidak boleh membuat modal baru setiap halaman.

---

# ALERT COMPONENT

```blade
<x-ui.alert
    type="success"
/>

<x-ui.alert
    type="danger"
/>
```

---

# CARD COMPONENT

```blade
<x-ui.card>

    <x-slot:header>
    </x-slot>

    Body

    <x-slot:footer>
    </x-slot>

</x-ui.card>
```

---

# DESIGN SYSTEM

Buat file:

```php
config/design-system.php
```

Berisi:

```php
colors
spacing
radius
font-size
font-weight
shadow
transition
```

Semua component wajib mengambil data dari sini.

---

# TAILWIND CONFIG

Gunakan semantic naming.

Contoh:

```js
colors: {

    primary: '#0595CF',
    secondary: '#0284C7',

    success: '#22C55E',
    warning: '#F59E0B',
    danger: '#EF4444',

    background: '#FFFFFF',
    surface: '#F8FAFC',

}
```

Jangan gunakan:

```js
blue
green
red
```

secara langsung di component.

---

# DARK MODE

Semua component wajib support:

```html
dark:
```

Contoh:

```html
bg-white dark:bg-slate-900
```

---

# RESPONSIVE

Wajib support:

```text
mobile
tablet
desktop
ultrawide
```

Gunakan:

```html
sm:
md:
lg:
xl:
2xl:
```

---

# KODE YANG DIHARAPKAN

AI harus menghasilkan:

1. Struktur folder lengkap
2. Design system lengkap
3. Tailwind config
4. Base Component
5. UI Component
6. Livewire CRUD
7. Dark Mode
8. Theme System
9. Reusable Form Builder
10. Reusable DataTable
11. Reusable Modal
12. Reusable Notification
13. Reusable Layout
14. Reusable Dashboard Widget

Pastikan seluruh UI mengikuti prinsip:

"Ubah satu file component, seluruh tampilan aplikasi ikut berubah tanpa perlu mengubah halaman lain."

Setiap component harus:

* reusable
* configurable
* extensible
* maintainable
* scalable untuk aplikasi enterprise dengan lebih dari 100 halaman dan 50+ developer.