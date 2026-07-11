# 05 - Activity Diagram

## 1) Beranda

**Narasi:** User/admin membuka aplikasi, sistem memilih konten beranda sesuai status login.

**Langkah proses & keputusan:**
1. Akses `index.php`.
2. `content.php` cek `module`.
3. Jika `module` kosong: cek session admin.
4. Session ada -> `modul/dashboard.php`; tidak ada -> `modul/welcome.php`.

```mermaid
flowchart TD
    A[Mulai] --> B[Akses index.php]
    B --> C{module kosong?}
    C -->|Tidak| D[Load module lain]
    C -->|Ya| E{Session admin ada?}
    E -->|Ya| F[Tampilkan dashboard]
    E -->|Tidak| G[Tampilkan welcome]
    F --> H[Selesai]
    G --> H
    D --> H
```

## 2) Diagnosis Gangguan

**Narasi:** User memilih gejala+tingkat keyakinan, sistem hitung FC+CF, simpan hasil.

```mermaid
flowchart TD
    A[Mulai] --> B[Pilih gejala & kondisi]
    B --> C[Submit form diagnosa]
    C --> D[Parse input kondisi]
    D --> E[Loop repair]
    E --> F[Ambil rule basis_pengetahuan]
    F --> G[Hitung dan kombinasi CF]
    G --> H{CF > 0?}
    H -->|Ya| I[Simpan kandidat hasil]
    H -->|Tidak| E
    I --> E
    E --> J[Urutkan hasil desc]
    J --> K[Insert ke tabel hasil]
    K --> L[Tampilkan hasil utama + kemungkinan lain]
    L --> M[Selesai]
```

## 3) Kelola Artikel/Keterangan (Post)

**Narasi:** Admin mengelola konten artikel post untuk halaman keterangan.

```mermaid
flowchart TD
    A[Mulai] --> B[Admin buka module post]
    B --> C{Pilih aksi}
    C -->|Tambah| D[Isi form post]
    C -->|Ubah| E[Edit form post]
    C -->|Hapus| F[Konfirmasi hapus]
    D --> G[Submit ke aksi_post.php act=input]
    E --> H[Submit ke aksi_post.php act=update]
    F --> I[Panggil aksi_post.php act=hapus]
    G --> J[Redirect list post]
    H --> J
    I --> J
```

## 4) Tentang

**Narasi:** Sistem menampilkan profil aplikasi dan informasi tim.

```mermaid
flowchart TD
    A[Mulai] --> B[User pilih module=tentang]
    B --> C[content.php load modul/tentang.php]
    C --> D[Tampilkan informasi tentang]
    D --> E[Selesai]
```

## 5) Login Admin

**Narasi:** Admin login melalui `login.php`, diverifikasi ke tabel `admin`.

```mermaid
flowchart TD
    A[Mulai] --> B[Input username/password]
    B --> C[POST ke login.php]
    C --> D[Query admin by username]
    D --> E{Password valid?}
    E -->|Ya| F[Set session + redirect index.php]
    E -->|Tidak| G[Tampilkan halaman login gagal]
    F --> H[Selesai]
    G --> H
```

## 6) Kelola Data Admin

```mermaid
flowchart TD
    A[Mulai] --> B[Buka module admin]
    B --> C{Aksi}
    C -->|Tambah| D[Form tambah admin]
    C -->|Ubah| E[Form edit admin]
    C -->|Hapus| F[Konfirmasi hapus]
    D --> G[aksi_admin.php act=input]
    E --> H[aksi_admin.php act=update]
    F --> I[aksi_admin.php act=hapus]
    G --> J[Redirect ke list]
    H --> J
    I --> J
```

## 7) Kelola Data Gangguan

```mermaid
flowchart TD
    A[Mulai] --> B[Buka module repair]
    B --> C{Aksi}
    C -->|Tambah| D[Form gangguan + upload gambar]
    C -->|Ubah| E[Form edit + upload opsional]
    C -->|Hapus| F[Konfirmasi]
    D --> G[aksi_repair.php act=input]
    E --> H[aksi_repair.php act=update]
    F --> I[aksi_repair.php act=hapus]
    G --> J[Redirect list]
    H --> J
    I --> J
```

## 8) Kelola Data Gejala

```mermaid
flowchart TD
    A[Mulai] --> B[Buka module incident]
    B --> C{Aksi}
    C -->|Tambah| D[Form gejala]
    C -->|Ubah| E[Form edit gejala]
    C -->|Hapus| F[Konfirmasi]
    D --> G[aksi_incident.php act=input]
    E --> H[aksi_incident.php act=update]
    F --> I[aksi_incident.php act=hapus]
    G --> J[Redirect list]
    H --> J
    I --> J
```

## 9) Kelola Basis Pengetahuan

```mermaid
flowchart TD
    A[Mulai] --> B[Buka module pengetahuan]
    B --> C{Aksi}
    C -->|Tambah| D[Pilih repair+incident, isi MB/MD]
    C -->|Ubah| E[Edit rule MB/MD]
    C -->|Hapus| F[Konfirmasi]
    D --> G[aksi_pengetahuan.php act=input]
    E --> H[aksi_pengetahuan.php act=update]
    F --> I[aksi_pengetahuan.php act=hapus]
    G --> J[Redirect list]
    H --> J
    I --> J
```

## 10) Ubah Password

```mermaid
flowchart TD
    A[Mulai] --> B[Buka module password]
    B --> C[Input pass lama + baru]
    C --> D{CSRF valid?}
    D -->|Tidak| E[Tolak request]
    D -->|Ya| F[Verifikasi pass lama]
    F --> G{Valid?}
    G -->|Tidak| H[Pesan gagal]
    G -->|Ya| I{Pass baru sama + >=8?}
    I -->|Tidak| J[Pesan gagal]
    I -->|Ya| K[Hash pass baru + update DB]
    K --> L[Pesan sukses + logout]
```

## 11) Logout

```mermaid
flowchart TD
    A[Mulai] --> B[Akses logout.php]
    B --> C[session_destroy()]
    C --> D[Redirect index.php]
    D --> E[Selesai]
```

## Referensi Source Code

- `content.php`
- `index.php`
- `login.php`
- `logout.php`
- `modul/welcome.php`
- `modul/dashboard.php`
- `modul/tentang.php`
- `modul/diagnosa/diagnosa.php`
- `modul/post/post.php`
- `modul/post/aksi_post.php`
- `modul/admin/admin.php`
- `modul/admin/aksi_admin.php`
- `modul/repair/repair.php`
- `modul/repair/aksi_repair.php`
- `modul/incident/incident.php`
- `modul/incident/aksi_incident.php`
- `modul/pengetahuan/pengetahuan.php`
- `modul/pengetahuan/aksi_pengetahuan.php`
- `modul/password/password.php`
