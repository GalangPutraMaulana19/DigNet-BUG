# 03 - Struktur Program

## Struktur Folder Project

```text
DigNet-BUG/
├── index.php
├── content.php
├── menu.php
├── login.php
├── logout.php
├── kirim_form.php
├── config/
│   ├── koneksi.php
│   └── fungsi_alert.php
├── modul/
│   ├── dashboard.php
│   ├── welcome.php
│   ├── tentang.php
│   ├── bantuan.php
│   ├── harga.php
│   ├── keterangan.php
│   ├── formlogin.php
│   ├── admin/
│   ├── repair/
│   ├── incident/
│   ├── pengetahuan/
│   ├── post/
│   ├── diagnosa/
│   ├── riwayat/
│   └── password/
├── src/
│   ├── js/app.js
│   └── scss/app.scss
├── dist/
├── css/
├── js/
├── gambar/
├── animasi/
├── simple_html_dom.php
└── dignet_indihome.sql
```

## Fungsi Setiap Folder

| Folder | Fungsi |
|---|---|
| `config/` | Koneksi database dan helper JS konfirmasi |
| `modul/` | Seluruh halaman/fitur aplikasi |
| `modul/*/aksi_*.php` | Endpoint aksi CRUD |
| `src/` | Source modern (Vite: JS/SCSS) |
| `dist/` | Hasil build aset Vite |
| `css/`, `js/` | Aset statis lama/manual |
| `gambar/` | Penyimpanan gambar repair/post/admin |
| `animasi/` | Aset animasi (bantuan, login, harga) |

## Fungsi File Utama

| File | Fungsi |
|---|---|
| `index.php` | Entry point, session, inisialisasi, layout utama, JS global |
| `content.php` | Router sederhana berdasarkan `module` |
| `menu.php` | Navigasi berbeda untuk admin/user |
| `login.php` | Proses autentikasi admin |
| `logout.php` | Menghapus session login |
| `kirim_form.php` | Endpoint kirim form kontak (email) |
| `config/koneksi.php` | Inisialisasi koneksi `mysqli` |
| `dignet_indihome.sql` | Struktur dan data database |

## Penjelasan MVC

### Hasil Analisis

Struktur aplikasi **tidak menerapkan MVC framework formal**.

- **View + Controller bercampur** di file modul PHP (HTML + query + kontrol alur dalam satu file).
- **Model class tidak ditemukan** (tidak ada file model terpisah).
- Aksi CRUD dipisah di file `aksi_*.php`, tetapi tetap procedural.

## Dependency yang Digunakan

### Node/Frontend (package.json)

- `bootstrap`
- `admin-lte`
- `@fortawesome/fontawesome-free`
- `@popperjs/core`
- `chart.js`
- `vite` (build tool)
- `sass`
- `terser`

### PHP Library

- `simple_html_dom.php` (HTML parser/scraper, dipakai di `modul/harga.php`)

## Catatan Ketersediaan Informasi

- Tidak ditemukan file route khusus seperti `routes/web.php`.
- Tidak ditemukan namespace controller/model modern (mis. `app/Http/Controllers`, `app/Models`).

## Referensi Source Code

- `index.php`
- `content.php`
- `menu.php`
- `login.php`
- `logout.php`
- `kirim_form.php`
- `config/koneksi.php`
- `config/fungsi_alert.php`
- `modul/**`
- `package.json`
- `vite.config.js`
- `src/js/app.js`
- `simple_html_dom.php`
