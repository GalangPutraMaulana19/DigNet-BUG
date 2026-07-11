# 09 - Dokumentasi API (Jika Ada)

## Ringkasan

Source code tidak memiliki REST API formal (tidak ada endpoint JSON terstruktur untuk resource utama seperti `/api/...`).

Yang tersedia adalah **endpoint web/action** berbasis:
- query string `?module=...&act=...`,
- form POST,
- dan satu endpoint AJAX kontak (`kirim_form.php`).

## Daftar Route/Endpoint yang Teridentifikasi

## 1) Front Controller Route

| Route | Method | Parameter | Response |
|---|---|---|---|
| `index.php` | GET | `module`, `act`, `id`, `offset` | HTML halaman modul |

Routing modul ditentukan di `content.php`.

## 2) Authentication

| Route | Method | Parameter | Response |
|---|---|---|---|
| `login.php` | POST | `username`, `password` | Redirect ke `index.php` jika sukses; HTML error jika gagal |
| `logout.php` | GET | - | Destroy session lalu redirect `index.php` |

## 3) Action CRUD Admin

| Route | Method | Parameter | Response |
|---|---|---|---|
| `modul/admin/aksi_admin.php?module=admin&act=input` | POST | `csrf_token`, `username`, `nama_lengkap`, `password` | Redirect list admin |
| `...act=update` | POST | `csrf_token`, `id`, `username`, `nama_lengkap` | Redirect list admin |
| `...act=hapus&id=...` | GET | `id` | Redirect list admin |

## 4) Action CRUD Gejala

| Route | Method | Parameter | Response |
|---|---|---|---|
| `modul/incident/aksi_incident.php?module=incident&act=input` | POST | `csrf_token`, `nama_incident` | Redirect |
| `...act=update` | POST | `csrf_token`, `id`, `nama_incident` | Redirect |
| `...act=hapus&id=...` | GET | `id` | Redirect |

## 5) Action CRUD Gangguan

| Route | Method | Parameter | Response |
|---|---|---|---|
| `modul/repair/aksi_repair.php?module=repair&act=input` | POST | `csrf_token`, `nama_repair`, `det_repair`, `srn_repair`, `gambar` | Redirect |
| `...act=update` | POST | `csrf_token`, `id`, field di atas, `gambar` opsional | Redirect |
| `...act=hapus&id=...` | GET | `id` | Redirect |

## 6) Action CRUD Basis Pengetahuan

| Route | Method | Parameter | Response |
|---|---|---|---|
| `modul/pengetahuan/aksi_pengetahuan.php?module=pengetahuan&act=input` | POST | `csrf_token`, `kode_repair`, `kode_incident`, `mb`, `md` | Redirect |
| `...act=update` | POST | `csrf_token`, `id`, field di atas | Redirect |
| `...act=hapus&id=...` | GET | `id` | Redirect |

## 7) Action CRUD Post

| Route | Method | Parameter | Response |
|---|---|---|---|
| `modul/post/aksi_post.php?module=post&act=input` | POST | `csrf_token`, `nama_post`, `det_post`, `srn_post`, `gambar` | Redirect |
| `...act=update` | POST | `csrf_token`, `id`, field di atas | Redirect |
| `...act=hapus&id=...` | GET | `id` | Redirect |

## 8) Ubah Password

| Route | Method | Parameter | Response |
|---|---|---|---|
| `?module=password&act=updatepassword` | POST | `csrf_token`, `nama`, `oldPass`, `newPass1`, `newPass2` | HTML pesan sukses/gagal |

## 9) Endpoint AJAX Kontak

| Route | Method | Parameter | Response |
|---|---|---|---|
| `kirim_form.php` | POST | `contactFrmSubmit`, `nama`, `email`, `pesan` | Text: `ok` atau `err` |

## Middleware

### Kondisi aktual source code

- Tidak ada middleware class formal.
- Proteksi akses admin dilakukan manual:
  - pengecekan `$_SESSION['username']` pada modul admin/action.
- Validasi CSRF manual pada banyak endpoint POST (`aksi_*.php`, `password.php`).

## Authentication

1. Login:
   - ambil user admin dengan prepared statement,
   - verifikasi `password_verify(...)` atau fallback `md5` legacy,
   - set session.
2. Logout:
   - `session_destroy()`.

## Catatan Ketersediaan Informasi

- Tidak ditemukan dokumentasi OpenAPI/Swagger.
- Tidak ditemukan response JSON untuk modul bisnis utama (kecuali teks sederhana `ok/err` di kontak).

## Referensi Source Code

- `content.php`
- `login.php`
- `logout.php`
- `modul/admin/aksi_admin.php`
- `modul/incident/aksi_incident.php`
- `modul/repair/aksi_repair.php`
- `modul/pengetahuan/aksi_pengetahuan.php`
- `modul/post/aksi_post.php`
- `modul/password/password.php`
- `index.php` (fungsi JS `kirimContactForm`)
- `kirim_form.php`
