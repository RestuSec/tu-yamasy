<p align="center"><img src="public/images/logo-yamasy.png" width="120" alt="Logo YAMASY"></p>

<h1 align="center">SPP Payment System — TU YAMASY</h1>

<p align="center">
  Aplikasi pembayaran SPP / tagihan sekolah berbasis web dengan panel admin dan portal orang tua.
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-13-red" alt="Laravel 13">
  <img src="https://img.shields.io/badge/PHP-8.3-blueviolet" alt="PHP 8.3">
  <img src="https://img.shields.io/badge/TailwindCSS-4-38bdf8" alt="TailwindCSS">
  <img src="https://img.shields.io/badge/DB-SQLite-blue" alt="SQLite">
</p>

---

## Tentang

Sistem pembayaran sekolah berbasis web untuk Tata Usaha YAMASY. Orang tua bisa melihat tagihan dan mengirim bukti pembayaran secara mandiri, sementara admin memverifikasi dan mengelola seluruh data keuangan sekolah.

## Fitur

### Panel Admin
- **Dashboard** — ringkasan total siswa, total pemasukan, total pengeluaran, dan pembayaran yang menunggu verifikasi.
- **Manajemen Siswa** — CRUD data siswa (NIS, nama, kelas, tahun ajaran, data orang tua).
- **Manajemen Tagihan** — CRUD tagihan per siswa (SPP, DSP, dll.) beserta status lunas/belum lunas.
- **Pencatatan Pembayaran** — catat pembayaran tunai (langsung lunas) atau non-tunai.
- **Verifikasi Pembayaran** — verifikasi atau tolak bukti pembayaran QRIS yang dikirim orang tua.
- **Manajemen Pengeluaran** — catat pengeluaran sekolah.
- **Pengaturan** — konfigurasi rekening bank, nomor kontak, dan gambar QRIS.

### Portal Ortu
- **Login mandiri** — menggunakan NIS + nama ibu (tanpa akun terpisah).
- **Dashboard Tagihan** — melihat daftar tagihan milik anak beserta statusnya.
- **Bayar Tagihan** — unggah bukti pembayaran QRIS, menunggu verifikasi admin.
- **Pembayaran Mandiri** — kirim pembayaran untuk jenis tagihan baru.

## Keamanan

- Route admin dilindungi middleware `admin.role` (hanya user role `admin`).
- Route ortu dilindungi middleware `ortu.auth` + rate limiting login (`throttle:10,1`).
- Registrasi publik dimatikan — admin dibuat lewat seeder.
- Upload bukti divalidasi tipe gambar & ukuran maksimal.
- Proteksi CSRF dan query database terparameterisasi (Eloquent).

## Teknologi

- **Laravel 13** + Breeze (autentikasi, Tailwind CSS)
- **PHP 8.3**
- **SQLite** (default; siap dipindah ke MySQL/PostgreSQL via konfigurasi `.env`)
- **Eloquent ORM** & migrations

## Struktur Database

| Tabel | Keterangan |
|---|---|
| `siswa` | Data siswa & orang tua |
| `tagihan` | Tagihan per siswa (SPP, DSP, dll.) |
| `pembayaran` | Riwayat pembayaran + bukti & status verifikasi |
| `pengeluaran` | Catatan pengeluaran sekolah |
| `pengaturan` | Konfigurasi bank & QRIS |
| `users` | Akun admin |

## Cara Install

```bash
git clone https://github.com/RestuSec/tu-yamasy.git
cd tu-yamasy

composer install
npm install

cp .env.example .env
php artisan key:generate

php artisan migrate --seed
php artisan storage:link
npm run build

php artisan serve
```

Buka `http://localhost:8000`.

### Akun demo admin

| Email | Password |
|---|---|
| `admin@yamasy.sch.id` | `admin123` |

Login portal ortu memakai **NIS** dan **nama ibu** siswa yang tersedia di data siswa.

## Fitur Keamanan Lainnya

- `.env`, database SQLite, dan file upload pengguna di-`gitignore` agar data tidak bocor ke repository publik.
- `APP_DEBUG` sebaiknya di-set `false` saat production.

## Lisensi

Proyek ini bersifat open-source untuk keperluan pembelajaran. Silakan gunakan dan kembangkan lebih lanjut.
