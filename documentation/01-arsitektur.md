# 01 - Arsitektur Sistem

## Ringkasan Arsitektur Sistem Pakar Diagnosis Gangguan Layanan IndiHome

Aplikasi menggunakan arsitektur **modular berbasis PHP procedural** dengan **front controller sederhana** (`index.php`) yang melakukan routing berdasarkan query string `module` lalu memuat file modul terkait melalui `content.php`.

Tidak ditemukan implementasi framework MVC formal (misalnya Laravel/CodeIgniter), route file khusus, atau middleware class terpisah.

## Komponen Sistem

1. **Client/UI (Browser)**
   - Halaman publik dan admin dirender server-side oleh file PHP modul.
2. **Front Controller**
   - `index.php` memulai session, koneksi DB, memuat menu+konten.
3. **Module Router**
   - `content.php` memilih modul berdasarkan `?module=...`.
4. **Business Modules**
   - Diagnosa, riwayat, admin, gangguan, gejala, basis pengetahuan, post, password.
5. **Action Handlers (CRUD)**
   - File `aksi_*.php` memproses input tambah/ubah/hapus.
6. **Authentication**
   - `login.php`, `logout.php`, pengecekan `$_SESSION['username']` di modul admin.
7. **Database Layer**
   - MySQL via `mysqli` (`config/koneksi.php`).
8. **Contact Service**
   - Form modal di `index.php` mengirim ke `kirim_form.php` (email via `mail()`).

## Alur Komunikasi Antar Komponen

1. Browser request ke `index.php`.
2. `index.php` inisialisasi session + koneksi DB.
3. `content.php` memilih modul dari parameter `module`.
4. Modul menampilkan form/hasil (query `SELECT` ke DB).
5. Untuk aksi data, form submit ke `modul/*/aksi_*.php`.
6. `aksi_*.php` validasi session + CSRF (POST), eksekusi query, lalu redirect ke `index.php?module=...`.
7. Untuk login, form ke `login.php`; jika sukses set session dan redirect.
8. Untuk logout, `logout.php` menghancurkan session.

## Diagram Arsitektur (Mermaid)

```mermaid
flowchart LR
    U[User/Teknisi] --> B[Browser]
    A[Admin] --> B

    B --> I[index.php]
    I --> C[content.php Router module]
    I --> M[menu.php]
    I --> K[config/koneksi.php]

    C --> D1[modul/diagnosa/diagnosa.php]
    C --> D2[modul/riwayat/*.php]
    C --> D3[modul/admin/admin.php]
    C --> D4[modul/repair/repair.php]
    C --> D5[modul/incident/incident.php]
    C --> D6[modul/pengetahuan/pengetahuan.php]
    C --> D7[modul/post/post.php]
    C --> D8[modul/password/password.php]

    D3 --> A1[modul/admin/aksi_admin.php]
    D4 --> A2[modul/repair/aksi_repair.php]
    D5 --> A3[modul/incident/aksi_incident.php]
    D6 --> A4[modul/pengetahuan/aksi_pengetahuan.php]
    D7 --> A5[modul/post/aksi_post.php]

    I --> L[login.php / logout.php]
    I --> CF[kirim_form.php]

    K --> DB[(MySQL dignet)]
    D1 --> DB
    D2 --> DB
    D3 --> DB
    D4 --> DB
    D5 --> DB
    D6 --> DB
    D7 --> DB
    D8 --> DB
    A1 --> DB
    A2 --> DB
    A3 --> DB
    A4 --> DB
    A5 --> DB
    L --> DB
```

## Referensi Source Code

- `index.php`
- `content.php`
- `menu.php`
- `config/koneksi.php`
- `login.php`
- `logout.php`
- `kirim_form.php`
- `modul/diagnosa/diagnosa.php`
- `modul/riwayat/riwayat.php`
- `modul/riwayat/detail.php`
- `modul/admin/admin.php`
- `modul/admin/aksi_admin.php`
- `modul/repair/repair.php`
- `modul/repair/aksi_repair.php`
- `modul/incident/incident.php`
- `modul/incident/aksi_incident.php`
- `modul/pengetahuan/pengetahuan.php`
- `modul/pengetahuan/aksi_pengetahuan.php`
- `modul/post/post.php`
- `modul/post/aksi_post.php`
- `modul/password/password.php`
