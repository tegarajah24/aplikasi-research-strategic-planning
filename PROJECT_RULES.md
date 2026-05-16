# PROJECT_RULES.md

## Project

**RSP-UHB (Research & Strategic Planning UHB)**  
Laravel 12 + Jetstream Livewire + Flux UI

---

## UI & Design System (Flux UI)

Aplikasi menggunakan **Flux UI style modern admin dashboard** dengan prinsip:

* Clean & structured interface (bukan sekadar minimal)
* UI harus memiliki visual hierarchy yang jelas
* Layout berbasis section + grid (bukan hanya stack vertikal)
* Komponen reusable dan konsisten
* Fokus pada readability + spatial design (ruang antar elemen)

---

## Visual Design Principles

UI harus:

* Memiliki depth (layering visual)
* Tidak flat / tidak monoton
* Menggunakan elevation (shadow + hover interaction)
* Memiliki grouping section yang jelas
* Memiliki visual rhythm (atas → tengah → bawah)

---

## Color Palette (Simple but Functional)

* Primary: blue / blue-600 (Penelitian)
* Secondary: violet (Pengabmas)
* Accent: amber (Renop)
* Support: teal (Dosen)
* Background: slate-50 / white
* Surface: white
* Text: slate-800 / slate-600
* Border: slate-100 / slate-200

> Warna hanya sebagai accent untuk identitas module, bukan dominasi UI.

---

## Component Design Rules

### Cards

* Gunakan card-based design dengan variasi ukuran (small / medium / large)
* Setiap card wajib memiliki:
  - visual hierarchy (title → value → description)
  - icon atau indicator
  - accent highlight (border/top bar/side strip)
  - hover interaction (translate + shadow elevation)

### Interaction

* Hover wajib memberikan feedback visual:
  - shadow meningkat (shadow-sm → shadow-md)
  - sedikit naik (translate-y-[-2px] atau [-3px])
* Transition smooth (200–300ms)

---

## Layout Principles

* Gunakan grid system untuk layout utama
* Hindari layout full vertical stack tanpa grouping
* Dashboard harus dibagi minimal:

1. Header section (title + context)
2. Stats grid section (cards)
3. Main content section (2 columns)
   - left: primary content
   - right: secondary actions/info

---

## Struktur Module

Aplikasi terdiri dari 2 module utama:

1. Modul Penelitian & pengabmas
2. Modul Renop Fakultas & Prodi

Semua module berada dalam 1 Laravel project dan 1 repository GitHub.

---

## Pembagian Tugas Developer

### Developer 1

Fokus:

* Dashboard utama
* Modul Penelitian & pengabmas
* UI module penelitian

Branch:

```
fitur/penelitian
```

---

### Developer 2

Fokus:

* Modul Renop
* Statistik dan laporan
* CRUD Renop + UI

Branch:

```
fitur/renop
```

---

## Aturan Git Workflow

Sebelum mulai kerja:

```bash
git pull origin main
```

Setelah selesai:

```bash
git add .
git commit -m "feat: deskripsi perubahan"
git push origin branch-name
```

### Rules:

* Jangan push langsung ke branch `main`
* Selalu pull terbaru sebelum mulai kerja
* Hindari konflik dengan komunikasi tim

---

## Struktur Views

```
resources/views/
├── layouts/
├── dashboard/
├── penelitian/
├── pengabmas/
└── renop/
```

---

## Struktur Controller

```
app/Http/Controllers/
├── DashboardController.php
├── PenelitianController.php
├── PengabmasController.php
└── RenopController.php
```

---

## Aturan UI Development (Flux Style)

* Gunakan Tailwind bawaan Jetstream / Flux UI
* Layout responsive (mobile-first)
* Gunakan card-based design
* Spacing konsisten (8px grid system)
* UI harus bersih dan tidak padat
* Fokus pada UX yang sederhana dan jelas

---

## Aturan Coding & AI Assistance

* Ikuti struktur Laravel yang sudah ada
* Jangan membuat file di luar struktur module
* Gunakan naming route yang jelas dan konsisten
* CRUD harus dipisah per controller module
* Jangan ubah core layout tanpa diskusi tim

---

## Catatan Penting

* Hindari konflik branch (komunikasi sebelum edit file besar)
* Prioritas: stabilitas > fitur baru > styling tambahan
* Konsistensi UI adalah prioritas utama