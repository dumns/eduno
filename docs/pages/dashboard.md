# Dashboard

Halaman utama aplikasi setelah login. Menampilkan jadwal, tugas, dan daftar kursus dalam layout dua kolom.

## Struktur Layout

```
┌──────────────────────────────────────────────────────────────────┐
│  Dashboard                                          Sen, 10 Jun  │
├──────────────────────┬───────────────────────────────────────────┤
│  JADWAL MINGGU INI   │  Courses  │  Kelas Personal              │
│  ┌──────────────────┐│  ┌──────────────────────────────────────┐│
│  │ Sen Sel Rab ...  ││  │  🔍 Cari kelas...      [2026 ▼]     ││
│  │                  ││  │                                      ││
│  │  [agenda]        ││  │  ┌────────────┐ ┌────────────┐      ││
│  │                  ││  │  │ Course 1   │ │ Course 2   │      ││
│  └──────────────────┘│  │  └────────────┘ └────────────┘      ││
│                      │  │  ┌────────────┐ ┌────────────┐      ││
│  PERLU DIKERJAKAN    │  │  │ Course 3   │ │ Course 4   │      ││
│  ┌──────────────────┐│  │  └────────────┘ └────────────┘      ││
│  │ (empty state)    ││  │                                      ││
│  └──────────────────┘│  └──────────────────────────────────────┘│
└──────────────────────┴───────────────────────────────────────────┘
```

### Key Files

| File | Role |
|------|------|
| `resources/views/dashboard.blade.php` | Halaman dashboard |
| `resources/views/components/ui/layouts/app.blade.php` | Layout utama |

## Left Column (4/12)

### Jadwal Minggu Ini

- 7 hari dalam seminggu (Sen–Min) dengan pilihan tanggal
- Hari ini disorot otomatis
- Indikator segitiga di bawah tanggal terpilih: `za-angle-down-small-duotone`
- Agenda per hari, atau empty state: `za-file-text-duotone`

### Perlu Dikerjakan

- Badge counter (jumlah tugas pending)
- Empty state: `za-check-list-duotone`

## Right Column (8/12)

Dua tab dengan Alpine.js (`x-data: tab`):

- **Courses** — grid 2 kolom kartu kursus
- **Kelas Personal** — grid 2 kolom kartu kelas personal

### Icons di Course Cards

| Ikon | Class | Lokasi |
|------|-------|--------|
| Dosen | `za-user-duotone w-3.5 h-3.5` | Info baris pertama |
| Jadwal | `za-calendar-duotone w-3.5 h-3.5` | Info baris kedua |

### Icons di Personal Course Cards

| Ikon | Class | Lokasi |
|------|-------|--------|
| Dosen | `za-user-duotone w-3.5 h-3.5` | Info baris pertama |
| Jadwal | `za-calendar-duotone w-3.5 h-3.5` | Info baris kedua |
| Peserta | `za-users-duotone w-3.5 h-3.5` | Info baris ketiga |

### Non-standard Icon Size

Ikon di dalam kartu kursus menggunakan `w-3.5 h-3.5` (14px) — ukuran non-standar yang tidak tersedia di komponen `x-ui:icon`. Oleh karena itu menggunakan tag `<i>` langsung:

```blade
<i class="za-user-duotone w-3.5 h-3.5 flex-shrink-0"></i>
```

## Icons via Component

Beberapa ikon menggunakan `x-ui:icon` component:

| Lokasi | Component |
|--------|-----------|
| Search input | `<x-ui.icon name="search" size="sm" />` |
| Year dropdown | `<x-ui.icon name="chevron-down" size="xs" />` |
| Tombol Ikuti kelas | `<x-ui.icon name="plus" size="xs" />` |

## Penyesuaian Ikon

| Perubahan | Detail |
|-----------|--------|
| Inline SVG → `za-angle-down-small-duotone` | Indikator tanggal terpilih |
| Inline SVG → `za-file-text-duotone` | Empty state jadwal |
| Inline SVG → `za-check-list-duotone` | Empty state tugas |
| Inline SVG → `za-user-duotone` | Ikon dosen di kartu |
| Inline SVG → `za-calendar-duotone` | Ikon jadwal di kartu |
| Inline SVG → `za-users-duotone` | Ikon peserta |
| Semua varian → `duotone` | Konsistensi visual |
