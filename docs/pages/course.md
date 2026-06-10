# Course Pages

Halaman terkait kursus: daftar kursus, detail kursus, dan komponen pendukung.

## Halaman

| Halaman | File | Route |
|---------|------|-------|
| Course List | `resources/views/livewire/course-list.blade.php` | `courses` |
| Course Detail | `resources/views/livewire/show-course.blade.php` | `courses.show` |
| Course Card Banner | `resources/views/components/course-card-banner.blade.php` | — (component) |

---

## Course List (`course-list.blade.php`)

Halaman daftar kursus dengan hero, search, filter tag, dan grid kartu.

### Struktur Halaman

```
┌──────────────────────────────────────────────────────────────┐
│  Start Your Web Development Journey                          │
│  Hero section with badge, heading, text, avatars             │
├──────────────────────────────────────────────────────────────┤
│  🔍 Search courses...                    [Filter: Laravel ▼] │
│                                                              │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐         │
│  │  📚 Banner   │ │  📚 Banner   │ │  📚 Banner   │         │
│  │  Course 1    │ │  Course 2    │ │  Course 3    │         │
│  │  [tags]      │ │  [tags]      │ │  [tags]      │         │
│  │  episodes 🔗 │ │  episodes 🔗 │ │  episodes 🔗 │         │
│  └──────────────┘ └──────────────┘ └──────────────┘         │
│                                                              │
│  « 1 2 3 ... »                                               │
└──────────────────────────────────────────────────────────────┘
```

### Hero Section

- Badge "New courses added weekly"
- Heading utama
- Deskripsi
- Avatar stack (instructor photos) + student count

### Icons

| Lokasi | Ikon | Cara |
|--------|------|------|
| Search input | `x-ui:icon name="search"` | Component |
| Book icon in banner | `<i class="za-book-simple-duotone w-10 h-10">` | Direct `<i>` |
| Episode count | `x-ui:icon name="book" size="xs"` | Component |
| Duration | `x-ui:icon name="clock" size="xs"` | Component |
| Button arrow | `x-ui:icon name="chevron-right"` | Component |
| Empty state book | `x-ui:icon name="book" size="xl"` | Component |

---

## Course Detail (`show-course.blade.php`)

Halaman detail kursus dengan hero, stats, dan daftar episode.

### Struktur Halaman

```
┌──────────────────────────────────────────────────────────────┐
│  ← Back to Courses                                           │
│                                                              │
│  ┌──────────────────────────────────────────────────────────┐│
│  │  [tags]                                                  ││
│  │  Course Title                                            ││
│  │  Course tagline/description                              ││
│  └──────────────────────────────────────────────────────────┘│
│                                                              │
│  ┌──────────────┐ ┌──────────────┐ ┌──────────────┐         │
│  │  📚 Episodes │ │  ⏰ Duration │ │  📅 Updated  │         │
│  └──────────────┘ └──────────────┘ └──────────────┘         │
│                                                              │
│  📖 Tentang Kursus Ini                                       │
│  (deskripsi)                                                 │
│                                                              │
│  📋 Daftar Episode                                           │
│  ┌──────────────────────────────────────────────────────────┐│
│  │ ▶ Episode 1 — Introduction                    10:30     ││
│  │ ℹ️ Info icon (if available)                              ││
│  │ 📄 List icon                                             ││
│  └──────────────────────────────────────────────────────────┘│
│  ┌──────────────────────────────────────────────────────────┐│
│  │ ▶ Episode 2 — Getting Started                  15:00     ││
│  └──────────────────────────────────────────────────────────┘│
└──────────────────────────────────────────────────────────────┘
```

### Icons

| Lokasi | Ikon | Cara |
|--------|------|------|
| Back button | `x-ui:icon name="chevron-left"` | Component |
| Stats - Episodes | `x-ui:icon name="book" size="lg"` | Component |
| Stats - Duration | `x-ui:icon name="clock" size="lg"` | Component |
| Stats - Updated | `x-ui:icon name="calendar" size="lg"` | Component |
| Info icon | `x-ui:icon name="info" size="sm"` | Component |
| Play icon | `x-ui:icon name="play" size="sm"` | Component |
| Episode time | `x-ui:icon name="clock" size="xs"` | Component |
| List bullet | `x-ui:icon name="list-bullet" size="xs"` | Component |
| Arrow right | `x-ui:icon name="chevron-right" size="sm"` | Component |
| Check progress | `x-ui:icon name="check-circle" size="sm"` | Component |

---

## Course Card Banner (component)

Komponen reusable untuk header banner kartu kursus.

### Usage

```blade
<x-course-card-banner gradient="from-primary/20 to-primary-light/30" title="Course" />
```

### Ikon

```blade
<i class="za-book-simple-duotone w-12 h-12 text-primary/40 dark:text-primary-light/30"></i>
```

### Props

| Prop | Type | Default |
|------|------|---------|
| `gradient` | string | Default gradient |
| `title` | string | `'Course'` |

---

## Penyesuaian Ikon

| File | Perubahan |
|------|-----------|
| `course-list.blade.php:63` | Direct `<i>` book icon: `za-book-simple-duotone` |
| `course-card-banner.blade.php:4` | Direct `<i>` book icon: `za-book-simple-duotone` |
| `show-course.blade.php` | Semua ikon via `x-ui:icon` → Zappicon duotone |
| Semua | Variant: `regular` → `duotone` |
