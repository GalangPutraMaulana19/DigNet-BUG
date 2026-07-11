# 07 - Sequence Diagram

## 1) Beranda

```mermaid
sequenceDiagram
    actor User
    participant Browser
    participant Index as index.php
    participant Router as content.php
    participant DB as MySQL
    Browser->>Index: GET /
    Index->>Router: include content.php (module kosong)
    Router->>Index: pilih welcome/dashboard
    Index->>DB: query statistik (welcome/dashboard)
    DB-->>Index: data count
    Index-->>Browser: HTML beranda
```

## 2) Diagnosis Gangguan

```mermaid
sequenceDiagram
    actor Teknisi
    participant Browser
    participant Modul as modul/diagnosa/diagnosa.php
    participant DB as MySQL
    Teknisi->>Browser: Pilih gejala + kondisi
    Browser->>Modul: POST module=diagnosa
    Modul->>DB: SELECT kondisi, repair, basis_pengetahuan
    DB-->>Modul: data rule
    Modul->>Modul: hitung FC + CF + ranking
    Modul->>DB: INSERT hasil
    DB-->>Modul: ok
    Modul-->>Browser: Hasil diagnosis + kemungkinan lain
```

## 3) Kelola Artikel/Keterangan

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Post as modul/post/post.php
    participant Aksi as modul/post/aksi_post.php
    participant DB as MySQL
    Admin->>Browser: Submit tambah/ubah/hapus post
    Browser->>Aksi: request module=post&act=...
    Aksi->>Aksi: cek session + CSRF + upload file
    Aksi->>DB: INSERT/UPDATE/DELETE post
    DB-->>Aksi: status
    Aksi-->>Browser: redirect ?module=post
    Browser->>Post: GET list post
    Post->>DB: SELECT post
    DB-->>Post: data post
    Post-->>Browser: tabel post
```

## 4) Tentang

```mermaid
sequenceDiagram
    actor User
    participant Browser
    participant Index as index.php
    participant Router as content.php
    participant About as modul/tentang.php
    Browser->>Index: GET ?module=tentang
    Index->>Router: route module
    Router->>About: include
    About-->>Browser: halaman tentang
```

## 5) Login Admin

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Form as modul/formlogin.php
    participant Login as login.php
    participant DB as MySQL
    Admin->>Form: isi username/password
    Form->>Login: POST login
    Login->>DB: SELECT admin by username (prepared)
    DB-->>Login: data admin
    Login->>Login: verify password_hash/md5
    alt valid
        Login-->>Browser: set session + redirect index.php
    else tidak valid
        Login-->>Browser: tampil halaman gagal login
    end
```

## 6) Kelola Data Admin

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Page as modul/admin/admin.php
    participant Aksi as modul/admin/aksi_admin.php
    participant DB as MySQL
    Admin->>Page: buka list admin
    Page->>DB: SELECT admin
    DB-->>Page: data admin
    Admin->>Aksi: submit CRUD admin
    Aksi->>Aksi: cek session + CSRF
    Aksi->>DB: INSERT/UPDATE/DELETE admin
    DB-->>Aksi: status
    Aksi-->>Browser: redirect list admin
```

## 7) Kelola Data Gangguan

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Page as modul/repair/repair.php
    participant Aksi as modul/repair/aksi_repair.php
    participant DB as MySQL
    Admin->>Page: buka list gangguan
    Page->>DB: SELECT repair
    DB-->>Page: data repair
    Admin->>Aksi: submit CRUD repair + file gambar
    Aksi->>Aksi: validasi file + CSRF
    Aksi->>DB: INSERT/UPDATE/DELETE repair
    DB-->>Aksi: status
    Aksi-->>Browser: redirect list repair
```

## 8) Kelola Data Gejala

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Page as modul/incident/incident.php
    participant Aksi as modul/incident/aksi_incident.php
    participant DB as MySQL
    Admin->>Page: buka list gejala
    Page->>DB: SELECT incident
    DB-->>Page: data incident
    Admin->>Aksi: submit CRUD incident
    Aksi->>Aksi: cek session + CSRF
    Aksi->>DB: INSERT/UPDATE/DELETE incident
    DB-->>Aksi: status
    Aksi-->>Browser: redirect list incident
```

## 9) Kelola Basis Pengetahuan

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Page as modul/pengetahuan/pengetahuan.php
    participant Aksi as modul/pengetahuan/aksi_pengetahuan.php
    participant DB as MySQL
    Admin->>Page: buka list basis pengetahuan
    Page->>DB: SELECT basis_pengetahuan + lookup repair/incident
    DB-->>Page: data rule
    Admin->>Aksi: submit CRUD rule MB/MD
    Aksi->>Aksi: cek session + CSRF
    Aksi->>DB: INSERT/UPDATE/DELETE basis_pengetahuan
    DB-->>Aksi: status
    Aksi-->>Browser: redirect list pengetahuan
```

## 10) Ubah Password

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Password as modul/password/password.php
    participant DB as MySQL
    Admin->>Password: POST updatepassword
    Password->>Password: validasi CSRF + panjang + konfirmasi password
    Password->>DB: SELECT admin by username
    DB-->>Password: data password lama
    Password->>Password: verify password lama (hash/md5)
    alt valid
        Password->>DB: UPDATE admin.password (password_hash)
        DB-->>Password: success
        Password-->>Browser: pesan sukses + link logout
    else invalid
        Password-->>Browser: pesan gagal
    end
```

## 11) Logout

```mermaid
sequenceDiagram
    actor Admin
    participant Browser
    participant Logout as logout.php
    Admin->>Logout: GET logout.php
    Logout->>Logout: session_destroy()
    Logout-->>Browser: redirect index.php
```

## Referensi Source Code

- `index.php`
- `content.php`
- `modul/welcome.php`
- `modul/dashboard.php`
- `modul/diagnosa/diagnosa.php`
- `modul/post/post.php`
- `modul/post/aksi_post.php`
- `modul/tentang.php`
- `modul/formlogin.php`
- `login.php`
- `modul/admin/admin.php`
- `modul/admin/aksi_admin.php`
- `modul/repair/repair.php`
- `modul/repair/aksi_repair.php`
- `modul/incident/incident.php`
- `modul/incident/aksi_incident.php`
- `modul/pengetahuan/pengetahuan.php`
- `modul/pengetahuan/aksi_pengetahuan.php`
- `modul/password/password.php`
- `logout.php`
