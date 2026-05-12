# PROJECT_RULES.md

## Project

**RSP-UHB (Research & Strategic Planning UHB)**
Laravel 12 + Jetstream Livewire + Flux UI

---

## UI & Design System (Flux UI)

Aplikasi menggunakan **Flux UI style** dengan prinsip:

* Clean & minimal interface
* Fokus pada readability dan spacing
* Komponen reusable
* Tidak berlebihan dalam dekorasi visual

### Color Palette (Simple & Clean)

* Primary: slate / blue-600
* Background: slate-50 / white
* Surface/Card: white
* Text: slate-800 / slate-600
* Border: slate-200
* Accent: blue-500

> Hindari penggunaan warna mencolok, gradient berlebihan, dan variasi warna yang tidak konsisten.

---

## Struktur Module

Aplikasi terdiri dari 2 module utama:

1. Modul Penelitian & Pengabdian Masyarakat
2. Modul Renop Fakultas & Prodi

Semua module berada dalam 1 Laravel project dan 1 repository GitHub.

---

## Pembagian Tugas Developer

### Developer 1

Fokus:

* Dashboard utama
* Modul Penelitian & Pengabdian
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
└── renop/
```

---

## Struktur Controller

```
app/Http/Controllers/
├── DashboardController.php
├── PenelitianController.php
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