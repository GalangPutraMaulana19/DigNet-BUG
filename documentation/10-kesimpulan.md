# 10 - Kesimpulan Analisis

## Kesimpulan Umum

Berdasarkan analisis source code, website ini merupakan **sistem pakar diagnosis gangguan IndiHome** berbasis:
- **Forward Chaining** untuk inferensi dari gejala ke kandidat gangguan,
- **Certainty Factor** untuk menghitung tingkat keyakinan diagnosis.

Implementasi berjalan dan lengkap pada level fitur, terutama:
- diagnosis,
- histori hasil,
- manajemen master data (admin, gejala, gangguan),
- manajemen basis pengetahuan,
- manajemen konten keterangan.

## Temuan Arsitektur

1. Arsitektur aplikasi masih **procedural PHP** dengan front controller sederhana.
2. Routing dilakukan manual via query parameter `module`/`act`.
3. Tidak menggunakan framework MVC formal.
4. Logic bisnis banyak ditulis langsung di file modul.

## Temuan Algoritma

1. Formula CF per rule dan kombinasi multi-rule benar-benar diimplementasikan di `modul/diagnosa/diagnosa.php`.
2. Hasil diagnosis disimpan ke tabel `hasil` termasuk serialisasi gejala/repair.
3. Riwayat diagnosis dapat ditampilkan kembali melalui `modul/riwayat/detail.php`.

## Temuan Database

1. Struktur database mencakup entitas inti yang diperlukan sistem pakar.
2. Relasi logis antar tabel ada dan dipakai pada query.
3. Foreign key constraint fisik tidak dideklarasikan pada dump SQL (relasi dikendalikan aplikasi).

## Temuan Keamanan

1. Sudah ada peningkatan keamanan:
   - prepared statement di banyak endpoint,
   - CSRF token pada banyak form admin,
   - password hashing modern untuk input/update admin,
   - fallback verifikasi md5 untuk data lama.
2. Namun masih ada query pencarian/list tertentu yang dibangun dengan string SQL langsung di beberapa modul.

## Ketersediaan Informasi pada Source Code

Informasi berikut **tidak tersedia** sebagai artefak formal di codebase:
- dokumen arsitektur resmi,
- diagram UML bawaan project,
- route declaration file modern (`routes/web.php`),
- controller/model class domain,
- dokumentasi API formal (OpenAPI/Swagger).

Semua dokumen BAB perancangan yang dibuat di folder `documentation/` disusun dari implementasi nyata yang ditemukan pada source code.

## Referensi Source Code Utama

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
- `dignet_indihome.sql`
- `simple_html_dom.php`
