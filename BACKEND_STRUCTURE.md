# DigNet Backend Structure Documentation
## Comprehensive Backend Summary for Frontend AI Development

---

## 📋 System Overview

**DigNet** adalah **Sistem Pakar Diagnosis Gangguan IndiHome** berbasis web yang menggunakan metode **Forward Chaining** dan **Certainty Factor (CF)** untuk mendiagnosis masalah perangkat IndiHome (ONU, ONT, STB, Telepon).

### Tech Stack
- **Backend**: PHP 8.x (Native, tanpa framework)
- **Database**: MySQL 8.x
- **Frontend Framework**: AdminLTE v4 + Bootstrap 5
- **Build Tool**: Vite (untuk SCSS & JS bundling)
- **Icons**: Font Awesome 6

---

## 🗄️ Database Structure

### Database Name: `dignet`

### Tables:

#### 1. `admin` - Tabel Admin/Pakar
```sql
CREATE TABLE admin (
  username VARCHAR(20) PRIMARY KEY,
  password VARCHAR(32) NOT NULL,      -- MD5 hash
  nama_lengkap VARCHAR(30) NOT NULL
);
```
**Contoh Data:**
- username: `admin`, password: `21232f297a57a5a743894a0e4a801fc3` (md5 dari "admin"), nama_lengkap: `Administrator`

#### 2. `incident` - Tabel Gejala (Symptoms)
```sql
CREATE TABLE incident (
  kode_incident INT PRIMARY KEY AUTO_INCREMENT,
  nama_incident VARCHAR(50) NOT NULL
);
```
**Contoh Data:**
| kode_incident | nama_incident |
|---------------|---------------|
| 1 | Telepon tidak dapat digunakan |
| 2 | Internet tidak terhubung |
| 3 | Lampu indikator PON pada ONU berwarna merah |
| 7 | Internet lambat |
| 13 | STB TV rusak |

#### 3. `repair` - Tabel Gangguan/Penyakit (Problems/Solutions)
```sql
CREATE TABLE repair (
  kode_repair INT PRIMARY KEY AUTO_INCREMENT,
  nama_repair VARCHAR(50) NOT NULL,
  det_repair TEXT NOT NULL,           -- Detail gangguan
  srn_repair TEXT NOT NULL,           -- Saran penanganan
  gambar VARCHAR(500)                 -- Path gambar (gambar/repair/xxx.jpg)
);
```
**Contoh Data:**
| kode_repair | nama_repair | det_repair | srn_repair |
|-------------|-------------|------------|------------|
| 1 | Create Ulang ONT | Create Ulang ONT | Create Ulang ONT |
| 2 | Create Voice | Create Voice | Create Voice |
| 9 | Reset Modem | Reset Modem | Reset Modem |
| 10 | Ganti STB | Ganti STB | Ganti STB |

#### 4. `basis_pengetahuan` - Tabel Aturan IF-THEN (Knowledge Base)
```sql
CREATE TABLE basis_pengetahuan (
  kode_pengetahuan INT PRIMARY KEY AUTO_INCREMENT,
  kode_repair INT NOT NULL,            -- FK ke repair
  kode_incident INT NOT NULL,          -- FK ke incident
  mb DOUBLE(11,1) NOT NULL,            -- Measure of Belief (0.0 - 1.0)
  md DOUBLE(11,1) NOT NULL             -- Measure of Disbelief (0.0 - 1.0)
);
```
**Relasi:** IF gejala (incident) THEN gangguan (repair) {MB, MD}

**Contoh Data:**
| kode_pengetahuan | kode_repair | kode_incident | mb | md |
|------------------|-------------|---------------|-----|-----|
| 105 | 2 | 1 | 0.8 | 0.2 |
| 106 | 1 | 1 | 0.7 | 0.1 |
| 133 | 10 | 13 | 0.9 | 0.1 |

**Rumus CF:** `CF(Pakar) = MB - MD`

#### 5. `kondisi` - Tingkat Kepastian User
```sql
CREATE TABLE kondisi (
  id INT PRIMARY KEY AUTO_INCREMENT,
  kondisi VARCHAR(64) NOT NULL,
  ket VARCHAR(256)
);
```
**Data Tetap (Fixed):**
| id | kondisi | Bobot |
|----|---------|-------|
| 1 | Pasti ya | 1.0 |
| 2 | Hampir pasti ya | 0.8 |
| 3 | Kemungkinan besar ya | 0.6 |
| 4 | Mungkin ya | 0.4 |
| 5 | Tidak tahu | -0.2 |
| 6 | Mungkin tidak | -0.4 |
| 7 | Kemungkinan besar tidak | -0.6 |
| 8 | Hampir pasti tidak | -0.8 |
| 9 | Pasti tidak | -1.0 |

#### 6. `hasil` - Riwayat Diagnosis
```sql
CREATE TABLE hasil (
  id_hasil INT PRIMARY KEY AUTO_INCREMENT,
  tanggal VARCHAR(50) NOT NULL,        -- Format: 'Y-m-d H:i:s'
  repair TEXT NOT NULL,                -- Serialized array hasil
  incident TEXT NOT NULL,              -- Serialized array gejala dipilih
  hasil_id INT NOT NULL,               -- kode_repair tertinggi
  hasil_nilai VARCHAR(16) NOT NULL     -- Nilai CF tertinggi
);
```

#### 7. `post` - Artikel/Keterangan
```sql
CREATE TABLE post (
  kode_post INT PRIMARY KEY AUTO_INCREMENT,
  nama_post VARCHAR(50) NOT NULL,
  det_post VARCHAR(15000) NOT NULL,    -- Detail/isi artikel
  srn_post VARCHAR(15000) NOT NULL,    -- Saran tambahan
  gambar VARCHAR(500)                  -- Path gambar
);
```

---

## 🔐 Authentication System

### Session Variables
```php
$_SESSION['username']     // Username admin yang login
$_SESSION['password']     // Password hash admin
$_SESSION['nama_lengkap'] // Nama lengkap admin
```

### Login Flow
1. User submit form ke `login.php`
2. Query: `SELECT * FROM admin WHERE username='$user' AND password=MD5('$pass')`
3. Jika cocok, set session dan redirect ke `index.php`
4. Jika gagal, tampilkan error

### Auth Check Pattern (untuk semua modul admin)
```php
session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
    header('location:index.php');
    exit();
}
```

### Logout
```php
// logout.php
session_start();
session_destroy();
header("location:index.php");
```

---

## 🛣️ Routing System

### Main Router: `index.php`
Entry point aplikasi. Struktur:
```php
session_start();
include "config/koneksi.php";
include "config/fungsi_alert.php";
// ... HTML head, navbar, sidebar ...
include "menu.php";      // Menu navigation
include "content.php";   // Content router
// ... footer ...
```

### Content Router: `content.php`
```php
$module = $_GET['module'] ?? '';

if ($module == "") {
    if (isset($_SESSION['username'])) {
        include "modul/dashboard.php";  // Admin homepage
    } else {
        include "modul/welcome.php";    // User homepage
    }
}
elseif ($module == "diagnosa") { include "modul/diagnosa/diagnosa.php"; }
elseif ($module == "repair")   { include "modul/repair/repair.php"; }
elseif ($module == "incident") { include "modul/incident/incident.php"; }
elseif ($module == "pengetahuan") { include "modul/pengetahuan/pengetahuan.php"; }
elseif ($module == "admin")    { include "modul/admin/admin.php"; }
elseif ($module == "post")     { include "modul/post/post.php"; }
elseif ($module == "password") { include "modul/password/password.php"; }
elseif ($module == "riwayat")  { include "modul/riwayat/riwayat.php"; }
elseif ($module == "riwayat-detail") { include "modul/riwayat/detail.php"; }
elseif ($module == "keterangan") { include "modul/keterangan.php"; }
elseif ($module == "harga")    { include "modul/harga.php"; }
elseif ($module == "tentang")  { include "modul/tentang.php"; }
elseif ($module == "bantuan")  { include "modul/bantuan.php"; }
elseif ($module == "formlogin") { include "modul/formlogin.php"; }
```

### URL Pattern
- Homepage: `index.php` atau `./`
- Modules: `?module=nama_modul`
- Actions: `?module=nama_modul&act=action&id=xxx`
- Pagination: `?module=nama_modul&offset=15`

---

## 📁 File Structure

```
dignet/
├── index.php                    # Main entry point
├── content.php                  # Content router
├── menu.php                     # Navigation menu
├── login.php                    # Login handler (POST)
├── logout.php                   # Logout handler
├── kirim_form.php              # Contact form handler
│
├── config/
│   ├── koneksi.php             # Database connection
│   └── fungsi_alert.php        # Alert/confirm functions
│
├── modul/
│   ├── welcome.php             # Homepage (guest)
│   ├── dashboard.php           # Homepage (admin)
│   ├── formlogin.php           # Login form
│   ├── tentang.php             # About page
│   ├── bantuan.php             # Help page
│   ├── harga.php               # Pricing info
│   ├── keterangan.php          # Info/articles
│   │
│   ├── diagnosa/
│   │   └── diagnosa.php        # Diagnosis module
│   │
│   ├── riwayat/
│   │   ├── riwayat.php         # Diagnosis history list
│   │   └── detail.php          # Diagnosis detail
│   │
│   ├── repair/                 # [ADMIN] Gangguan management
│   │   ├── repair.php          # CRUD interface
│   │   └── aksi_repair.php     # CRUD actions
│   │
│   ├── incident/               # [ADMIN] Gejala management
│   │   ├── incident.php        # CRUD interface
│   │   └── aksi_incident.php   # CRUD actions
│   │
│   ├── pengetahuan/            # [ADMIN] Knowledge base
│   │   ├── pengetahuan.php     # CRUD interface
│   │   └── aksi_pengetahuan.php # CRUD actions
│   │
│   ├── admin/                  # [ADMIN] Admin management
│   │   ├── admin.php           # CRUD interface
│   │   └── aksi_admin.php      # CRUD actions
│   │
│   ├── post/                   # [ADMIN] Articles
│   │   ├── post.php            # CRUD interface
│   │   └── aksi_post.php       # CRUD actions
│   │
│   └── password/               # [ADMIN] Change password
│       └── password.php
│
├── gambar/
│   ├── admin/                  # Admin assets (logo, favicon)
│   ├── repair/                 # Repair images
│   └── post/                   # Article images
│
├── css/                        # Stylesheets
├── js/                         # JavaScript
├── src/
│   ├── scss/                   # SCSS source files
│   └── js/                     # JS source files
├── dist/                       # Built assets (Vite output)
│
├── dignet_indihome.sql         # Database SQL dump
└── package.json                # NPM dependencies
```

---

## 🔧 CRUD Operations Pattern

### Module Structure (contoh: repair)
```
modul/repair/
├── repair.php           # UI: list, tambah, edit forms
└── aksi_repair.php      # Actions: input, update, hapus
```

### CRUD Actions
Setiap modul menggunakan `switch` berdasarkan `$_GET['act']`:

```php
// repair.php
switch ($_GET['act'] ?? '') {
    default:                    // LIST - tampilkan semua data
    case "tambahrepair":        // FORM tambah baru
    case "editrepair":          // FORM edit (id dari $_GET['id'])
}

// aksi_repair.php
switch ($_GET['act'] ?? '') {
    case "input":               // INSERT ke database
    case "update":              // UPDATE database
    case "hapus":               // DELETE dari database
}
```

### URL Examples
- List: `?module=repair`
- Add Form: `?module=repair&act=tambahrepair` atau `repair/tambahrepair`
- Edit Form: `?module=repair&act=editrepair&id=1` atau `repair/editrepair/1`
- Delete: `aksi_repair.php?module=repair&act=hapus&id=1`

---

## 🧠 Diagnosis Algorithm (Certainty Factor)

### Proses Diagnosis (`modul/diagnosa/diagnosa.php`)

1. **User memilih gejala** dengan tingkat kepastian (kondisi)
2. **Format input**: `kondisi[] = "kode_incident_id_kondisi"` (contoh: `"1_2"` = incident 1, kondisi 2)
3. **Bobot kondisi**:
   ```php
   $arbobot = ['0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1'];
   ```

4. **Algoritma CF Kombinasi**:
   ```php
   // Untuk setiap repair, hitung CF gabungan dari semua gejala yang dipilih
   foreach repair:
       $cflama = 0;
       foreach incident yang dipilih user:
           if incident ada di basis_pengetahuan untuk repair ini:
               $cf = (MB - MD) * bobot_kondisi_user
               
               // Kombinasi CF
               if ($cf >= 0 && $cf * $cflama >= 0):
                   $cflama = $cflama + ($cf * (1 - $cflama))
               if ($cf * $cflama < 0):
                   $cflama = ($cflama + $cf) / (1 - min(abs($cflama), abs($cf)))
               if ($cf < 0 && $cf * $cflama >= 0):
                   $cflama = $cflama + ($cf * (1 + $cflama))
       
       if $cflama > 0:
           simpan repair dengan nilai CF
   
   // Sort descending berdasarkan CF
   arsort($arrepair)
   // Hasil tertinggi = diagnosis utama
   ```

5. **Simpan hasil** ke tabel `hasil`:
   ```php
   INSERT INTO hasil (tanggal, incident, repair, hasil_id, hasil_nilai)
   VALUES ('$datetime', serialize($arincident), serialize($arrepair), $id_tertinggi, $nilai_tertinggi)
   ```

---

## 📊 API Endpoints (Internal)

### Database Queries

#### Get All Incidents (Gejala)
```php
SELECT * FROM incident ORDER BY kode_incident
```

#### Get All Repairs (Gangguan)
```php
SELECT * FROM repair ORDER BY kode_repair
```

#### Get Knowledge Base Rules
```php
SELECT * FROM basis_pengetahuan WHERE kode_repair = $kode_repair
SELECT b.*, r.nama_repair, i.nama_incident 
FROM basis_pengetahuan b
JOIN repair r ON b.kode_repair = r.kode_repair
JOIN incident i ON b.kode_incident = i.kode_incident
```

#### Get Statistics (untuk Dashboard)
```php
SELECT COUNT(*) FROM incident          -- Total gejala
SELECT COUNT(*) FROM repair            -- Total gangguan  
SELECT COUNT(*) FROM basis_pengetahuan -- Total aturan
SELECT COUNT(*) FROM admin             -- Total admin
SELECT COUNT(*) FROM hasil             -- Total riwayat
SELECT COUNT(*) FROM post              -- Total artikel
```

#### Get Diagnosis History
```php
SELECT * FROM hasil ORDER BY id_hasil DESC
SELECT * FROM hasil WHERE id_hasil = $id
```

---

## 🎨 Frontend Requirements

### Menu Structure

#### Guest Menu (Tidak Login)
- Beranda (`./`)
- Diagnosa (`?module=diagnosa`)
- Riwayat (`?module=riwayat`)
- Keterangan (`?module=keterangan`)
- Info Harga (`?module=harga`)

#### Admin Menu (Setelah Login)
- Beranda/Dashboard (`./`)
- Admin (`?module=admin`)
- Data Gangguan (`?module=repair`)
- Data Gejala (`?module=incident`)
- Basis Pengetahuan (`?module=pengetahuan`)
- Post (`?module=post`)
- Ubah Password (`?module=password`)

#### Common Menu
- Tentang (`?module=tentang`)
- Bantuan (`?module=bantuan`)
- Login/Logout

### UI Components Needed

1. **Landing Page** - Hero section, fitur, statistik
2. **Diagnosis Form** - Table dengan checkbox gejala + dropdown kondisi
3. **Result Page** - Hasil diagnosis dengan chart/progress
4. **Data Tables** - CRUD dengan pagination, search, sort
5. **Forms** - Input/Edit forms untuk semua modul
6. **Dashboard** - Statistics cards, charts, quick actions
7. **Authentication** - Login form, logout confirmation

### Form Fields per Module

#### Repair (Gangguan)
- nama_repair (text, required)
- det_repair (textarea, required) - Detail
- srn_repair (textarea, required) - Saran
- gambar (file upload, optional)

#### Incident (Gejala)
- nama_incident (text, required)

#### Basis Pengetahuan
- kode_repair (select dari repair, required)
- kode_incident (select dari incident, required)
- mb (number 0.0-1.0, required)
- md (number 0.0-1.0, required)

#### Admin
- username (text, required, unique)
- password (password, required)
- nama_lengkap (text, required)

#### Post
- nama_post (text, required)
- det_post (textarea/wysiwyg, required)
- srn_post (textarea/wysiwyg, required)
- gambar (file upload, optional)

---

## 🎯 Key Features to Implement

1. **Responsive Design** - Mobile-first approach
2. **Real-time Validation** - Client-side form validation
3. **Loading States** - Untuk async operations
4. **Toast Notifications** - Success/error feedback
5. **Confirmation Dialogs** - Delete confirmations
6. **Pagination** - 15 items per page
7. **Search** - By nama field
8. **Print Function** - Untuk hasil diagnosis
9. **File Upload** - Dengan preview gambar
10. **Color-coded Kondisi** - Setiap tingkat kepastian punya warna berbeda

### Kondisi Colors
```javascript
const kondisiColors = {
  1: '#cc66ff',  // Pasti ya
  2: '#019AFF',  // Hampir pasti ya
  3: '#00CBFD',  // Kemungkinan besar ya
  4: '#00FEFE',  // Mungkin ya
  5: '#A4F804',  // Tidak tahu
  6: '#FFFC00',  // Mungkin tidak
  7: '#FDCD01',  // Kemungkinan besar tidak
  8: '#FD9A01',  // Hampir pasti tidak
  9: '#FB6700'   // Pasti tidak
};
```

---

## 📝 Notes for Frontend AI

1. **Base URL**: `http://localhost/dignet/`
2. **Semua module files** ada di folder `modul/`
3. **Session** harus dicek di setiap modul admin
4. **Database connection** sudah ada di `$conn` (dari `config/koneksi.php`)
5. **Password** disimpan dalam MD5 hash
6. **Gambar** disimpan di folder `gambar/repair/` dan `gambar/post/`
7. **Serialized data** di tabel `hasil` perlu `unserialize()` untuk dibaca
8. **Pagination** menggunakan offset, bukan page number
9. **URL rewrite** menggunakan `.htaccess` untuk clean URLs

---

## 🔄 Data Flow Example

### Diagnosis Flow
```
1. User buka ?module=diagnosa
2. Load semua incident dari database
3. User pilih gejala + tingkat kepastian
4. Submit form (POST)
5. Proses CF algorithm
6. Insert ke tabel hasil
7. Tampilkan hasil dengan gangguan tertinggi
8. User bisa print hasil
```

### CRUD Flow
```
1. List: ?module=repair → tampilkan semua dengan pagination
2. Add: ?module=repair&act=tambahrepair → form → POST ke aksi_repair.php?act=input
3. Edit: repair/editrepair/1 → load data → form → POST ke aksi_repair.php?act=update
4. Delete: confirmIt() → aksi_repair.php?act=hapus&id=1
```

---

## 📐 UML & Flowcharts (Text-Based Diagrams)

### Entity Relationship Diagram (ERD)

```
┌─────────────────┐       ┌────────────────────────┐       ┌─────────────────┐
│     ADMIN       │       │   BASIS_PENGETAHUAN    │       │    INCIDENT     │
├─────────────────┤       ├────────────────────────┤       ├─────────────────┤
│ PK username     │       │ PK kode_pengetahuan    │       │ PK kode_incident│
│    password     │       │ FK kode_repair    ─────┼───┐   │    nama_incident│
│    nama_lengkap │       │ FK kode_incident  ─────┼───┼───┤                 │
└─────────────────┘       │    mb                  │   │   └─────────────────┘
                          │    md                  │   │
┌─────────────────┐       └────────────────────────┘   │   ┌─────────────────┐
│     HASIL       │                                    │   │    KONDISI      │
├─────────────────┤       ┌────────────────────────┐   │   ├─────────────────┤
│ PK id_hasil     │       │       REPAIR           │   │   │ PK id           │
│    tanggal      │       ├────────────────────────┤   │   │    kondisi      │
│    repair (ser) │       │ PK kode_repair    ─────┼───┘   │    ket          │
│    incident(ser)│       │    nama_repair         │       └─────────────────┘
│ FK hasil_id ────┼──────▶│    det_repair          │
│    hasil_nilai  │       │    srn_repair          │       ┌─────────────────┐
└─────────────────┘       │    gambar              │       │      POST       │
                          └────────────────────────┘       ├─────────────────┤
                                                           │ PK kode_post    │
                                                           │    nama_post    │
                                                           │    det_post     │
                                                           │    srn_post     │
                                                           │    gambar       │
                                                           └─────────────────┘

Relasi:
- BASIS_PENGETAHUAN.kode_repair → REPAIR.kode_repair (Many-to-One)
- BASIS_PENGETAHUAN.kode_incident → INCIDENT.kode_incident (Many-to-One)
- HASIL.hasil_id → REPAIR.kode_repair (Many-to-One)
```

---

### Use Case Diagram

```
                    ┌─────────────────────────────────────────────────────────┐
                    │                    SISTEM DIGNET                         │
                    │                                                          │
    ┌───────┐       │  ┌──────────────────┐    ┌──────────────────────┐       │
    │       │       │  │ Diagnosa Gangguan│    │ Lihat Riwayat       │        │
    │ GUEST │───────┼──│                  │    │ Diagnosis           │        │
    │ USER  │       │  └──────────────────┘    └──────────────────────┘       │
    │       │───────┼──│                  │    ┌──────────────────────┐       │
    └───────┘       │  │ Lihat Keterangan │    │ Lihat Info Harga    │        │
                    │  │ Gangguan         │    │                     │        │
                    │  └──────────────────┘    └──────────────────────┘       │
                    │                                                          │
                    │  ═══════════════════════════════════════════════════════│
                    │                                                          │
    ┌───────┐       │  ┌──────────────────┐    ┌──────────────────────┐       │
    │       │       │  │ Login            │───▶│ Logout               │       │
    │ ADMIN │───────┼──│                  │    │                      │       │
    │ PAKAR │       │  └──────────────────┘    └──────────────────────┘       │
    │       │       │                                                          │
    │       │───────┼──┌──────────────────┐    ┌──────────────────────┐       │
    │       │       │  │ CRUD Gangguan    │    │ CRUD Gejala          │       │
    │       │       │  │ (Repair)         │    │ (Incident)           │       │
    │       │       │  └──────────────────┘    └──────────────────────┘       │
    │       │       │                                                          │
    │       │───────┼──┌──────────────────┐    ┌──────────────────────┐       │
    │       │       │  │ CRUD Basis       │    │ CRUD Admin           │       │
    │       │       │  │ Pengetahuan      │    │                      │       │
    │       │       │  └──────────────────┘    └──────────────────────┘       │
    │       │       │                                                          │
    │       │───────┼──┌──────────────────┐    ┌──────────────────────┐       │
    └───────┘       │  │ CRUD Post        │    │ Ubah Password        │       │
                    │  │ Keterangan       │    │                      │       │
                    │  └──────────────────┘    └──────────────────────┘       │
                    │                                                          │
                    │  ┌──────────────────┐                                    │
                    │  │ Dashboard        │                                    │
                    │  │ Statistik        │                                    │
                    │  └──────────────────┘                                    │
                    └─────────────────────────────────────────────────────────┘
```

---

### Sequence Diagram - Proses Diagnosis

```
┌─────┐          ┌─────────┐          ┌────────────┐          ┌──────────┐          ┌─────────┐
│User │          │diagnosa │          │basis_penge-│          │  repair  │          │ hasil   │
│     │          │  .php   │          │  tahuan    │          │  table   │          │ table   │
└──┬──┘          └────┬────┘          └─────┬──────┘          └────┬─────┘          └────┬────┘
   │                  │                     │                      │                     │
   │ 1. GET ?module=  │                     │                      │                     │
   │    diagnosa      │                     │                      │                     │
   │─────────────────▶│                     │                      │                     │
   │                  │                     │                      │                     │
   │                  │ 2. SELECT * FROM    │                      │                     │
   │                  │    incident         │                      │                     │
   │                  │────────────────────▶│                      │                     │
   │                  │                     │                      │                     │
   │                  │◀───────────────────┤│ return all incidents │                     │
   │                  │                     │                      │                     │
   │◀─────────────────│ 3. Render form     │                      │                     │
   │  Form + gejala   │    with symptoms   │                      │                     │
   │                  │                     │                      │                     │
   │ 4. POST kondisi[]│                     │                      │                     │
   │   (gejala+bobot) │                     │                      │                     │
   │─────────────────▶│                     │                      │                     │
   │                  │                     │                      │                     │
   │                  │ 5. SELECT * FROM repair                    │                     │
   │                  │────────────────────────────────────────────▶                     │
   │                  │                     │                      │                     │
   │                  │◀───────────────────────────────────────────│ return all repairs  │
   │                  │                     │                      │                     │
   │                  │ 6. FOR EACH repair: │                      │                     │
   │                  │    SELECT FROM      │                      │                     │
   │                  │    basis_pengetahuan│                      │                     │
   │                  │    WHERE kode_repair│                      │                     │
   │                  │────────────────────▶│                      │                     │
   │                  │                     │                      │                     │
   │                  │◀────────────────────│ return MB, MD rules  │                     │
   │                  │                     │                      │                     │
   │                  │ 7. CALCULATE CF     │                      │                     │
   │                  │    (Certainty       │                      │                     │
   │                  │     Factor)         │                      │                     │
   │                  │                     │                      │                     │
   │                  │ 8. INSERT INTO hasil│                      │                     │
   │                  │────────────────────────────────────────────────────────────────▶│
   │                  │                     │                      │                     │
   │                  │◀───────────────────────────────────────────────────────────────│
   │                  │                     │                      │                     │
   │◀─────────────────│ 9. Return hasil    │                      │                     │
   │  Hasil Diagnosis │    diagnosis        │                      │                     │
   │  + Rekomendasi   │                     │                      │                     │
   │                  │                     │                      │                     │
```

---

### Sequence Diagram - Login Admin

```
┌─────┐          ┌─────────┐          ┌─────────┐          ┌─────────┐
│User │          │formlogin│          │login.php│          │ admin   │
│     │          │  .php   │          │ (POST)  │          │ table   │
└──┬──┘          └────┬────┘          └────┬────┘          └────┬────┘
   │                  │                    │                    │
   │ 1. GET ?module=  │                    │                    │
   │    formlogin     │                    │                    │
   │─────────────────▶│                    │                    │
   │                  │                    │                    │
   │◀─────────────────│ Render login form  │                    │
   │                  │                    │                    │
   │ 2. POST username │                    │                    │
   │    + password    │                    │                    │
   │─────────────────────────────────────▶│                    │
   │                  │                    │                    │
   │                  │                    │ 3. SELECT * FROM   │
   │                  │                    │    admin WHERE     │
   │                  │                    │    username AND    │
   │                  │                    │    MD5(password)   │
   │                  │                    │───────────────────▶│
   │                  │                    │                    │
   │                  │                    │◀───────────────────│
   │                  │                    │    result row      │
   │                  │                    │                    │
   │                  │    ┌───────────────┴───────────────┐    │
   │                  │    │ IF found:                     │    │
   │                  │    │   session_start()             │    │
   │                  │    │   $_SESSION['username'] = ... │    │
   │                  │    │   $_SESSION['password'] = ... │    │
   │                  │    │   redirect → index.php        │    │
   │                  │    │ ELSE:                         │    │
   │                  │    │   show error page             │    │
   │                  │    └───────────────────────────────┘    │
   │                  │                    │                    │
   │◀─────────────────────────────────────│                    │
   │  Redirect to     │                    │                    │
   │  index.php OR    │                    │                    │
   │  Error page      │                    │                    │
```

---

### Sequence Diagram - CRUD Operation (Create Repair)

```
┌─────┐          ┌─────────┐          ┌───────────┐          ┌─────────┐
│Admin│          │repair   │          │aksi_repair│          │ repair  │
│     │          │  .php   │          │   .php    │          │ table   │
└──┬──┘          └────┬────┘          └─────┬─────┘          └────┬────┘
   │                  │                     │                     │
   │ 1. GET ?module=  │                     │                     │
   │    repair        │                     │                     │
   │─────────────────▶│                     │                     │
   │                  │                     │                     │
   │◀─────────────────│ Render data list   │                     │
   │                  │ + buttons           │                     │
   │                  │                     │                     │
   │ 2. CLICK "Tambah │                     │                     │
   │    Gangguan"     │                     │                     │
   │─────────────────▶│                     │                     │
   │                  │                     │                     │
   │◀─────────────────│ Render add form    │                     │
   │  ?module=repair  │ (nama, detail,     │                     │
   │  &act=tambahrepair│  saran, gambar)   │                     │
   │                  │                     │                     │
   │ 3. POST form data│                     │                     │
   │   (nama_repair,  │                     │                     │
   │    det_repair,   │                     │                     │
   │    srn_repair,   │                     │                     │
   │    gambar)       │                     │                     │
   │──────────────────────────────────────▶│                     │
   │                  │                     │                     │
   │                  │                     │ 4. Upload gambar   │
   │                  │                     │    to gambar/repair/│
   │                  │                     │                     │
   │                  │                     │ 5. INSERT INTO     │
   │                  │                     │    repair          │
   │                  │                     │    (nama, det, srn,│
   │                  │                     │     gambar)        │
   │                  │                     │────────────────────▶
   │                  │                     │                     │
   │                  │                     │◀────────────────────│
   │                  │                     │    insert success  │
   │                  │                     │                     │
   │◀─────────────────────────────────────│                     │
   │  Redirect to     │ 6. redirect to     │                     │
   │  ?module=repair  │    list + alert    │                     │
   │  + success alert │    "Berhasil"      │                     │
```

---

### Activity Diagram - Diagnosis Flow

```
                              ┌─────────────────┐
                              │     START       │
                              └────────┬────────┘
                                       │
                                       ▼
                          ┌────────────────────────┐
                          │ User buka halaman      │
                          │ ?module=diagnosa       │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ Load semua gejala      │
                          │ dari tabel incident    │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ Tampilkan form dengan  │
                          │ list gejala + dropdown │
                          │ tingkat kepastian      │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ User memilih gejala    │
                          │ dan tingkat kepastian  │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ User klik tombol       │
                          │ "Proses"               │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ Parse input kondisi[]  │
                          │ Format: incident_id_   │
                          │         kondisi_id     │
                          └───────────┬────────────┘
                                      │
                                      ▼
                    ┌─────────────────────────────────────┐
                    │ FOR EACH repair di database         │
                    └────────────────┬────────────────────┘
                                     │
                    ┌────────────────┴────────────────┐
                    ▼                                 │
        ┌─────────────────────┐                      │
        │ Ambil rules dari    │                      │
        │ basis_pengetahuan   │                      │
        │ untuk repair ini    │                      │
        └──────────┬──────────┘                      │
                   │                                 │
                   ▼                                 │
        ┌─────────────────────┐                      │
        │ FOR EACH gejala     │◀─────────────────────┤
        │ yang dipilih user   │                      │
        └──────────┬──────────┘                      │
                   │                                 │
                   ▼                                 │
        ┌─────────────────────┐                      │
        │ Jika gejala ada di  │                      │
        │ rules repair ini:   │                      │
        │ CF = (MB-MD)*bobot  │                      │
        └──────────┬──────────┘                      │
                   │                                 │
                   ▼                                 │
        ┌─────────────────────┐                      │
        │ Kombinasi CF:       │                      │
        │ ├─ CF>=0 & CFold>=0 │                      │
        │ │  → CF + CF*(1-CF) │                      │
        │ ├─ CF*CFold < 0     │                      │
        │ │  → (CF+CFold)/    │                      │
        │ │    (1-min(|CF|))  │                      │
        │ └─ CF<0 & CFold>=0  │                      │
        │    → CF + CF*(1+CF) │                      │
        └──────────┬──────────┘                      │
                   │                                 │
                   └─────────────────────────────────┘
                                     │
                                     ▼
                    ┌─────────────────────────────────────┐
                    │ Sort hasil CF descending            │
                    └────────────────┬────────────────────┘
                                     │
                                     ▼
                    ┌─────────────────────────────────────┐
                    │ Simpan ke tabel hasil:              │
                    │ - tanggal (datetime)                │
                    │ - incident (serialized array)       │
                    │ - repair (serialized array)         │
                    │ - hasil_id (repair tertinggi)       │
                    │ - hasil_nilai (CF tertinggi)        │
                    └────────────────┬────────────────────┘
                                     │
                                     ▼
                    ┌─────────────────────────────────────┐
                    │ Tampilkan hasil:                    │
                    │ - Gejala yang dipilih               │
                    │ - Diagnosis utama + detail          │
                    │ - Saran penanganan                  │
                    │ - Kemungkinan lain                  │
                    │ - Tombol cetak                      │
                    └────────────────┬────────────────────┘
                                     │
                                     ▼
                              ┌─────────────────┐
                              │      END        │
                              └─────────────────┘
```

---

### State Diagram - Session State

```
                         ┌─────────────────┐
                         │  NO SESSION     │
                         │  (Guest Mode)   │
                         └────────┬────────┘
                                  │
          ┌───────────────────────┴───────────────────────┐
          │                                               │
          ▼                                               ▼
┌─────────────────────┐                      ┌─────────────────────┐
│ Can Access:         │                      │ Cannot Access:      │
│ - welcome.php       │                      │ - dashboard.php     │
│ - diagnosa          │    LOGIN SUCCESS     │ - repair CRUD       │
│ - riwayat           │─────────────────────▶│ - incident CRUD     │
│ - keterangan        │                      │ - pengetahuan CRUD  │
│ - harga             │                      │ - admin CRUD        │
│ - tentang           │                      │ - post CRUD         │
│ - bantuan           │                      │ - password change   │
│ - formlogin         │                      │                     │
└─────────────────────┘                      └─────────────────────┘
                                                        │
                                                        │
                                                        ▼
                                             ┌─────────────────────┐
                                             │   HAS SESSION       │
                                             │   (Admin Mode)      │
                                             └────────┬────────────┘
                                                      │
          ┌───────────────────────────────────────────┴─────────────────────┐
          │                                                                 │
          ▼                                                                 ▼
┌─────────────────────┐                                        ┌─────────────────────┐
│ Session Variables:  │                                        │ Can Access:         │
│ ─────────────────── │                                        │ - dashboard.php     │
│ username: "admin"   │              LOGOUT                    │ - repair CRUD       │
│ password: "hash..." │◀────────────────────────────────────── │ - incident CRUD     │
│ nama_lengkap: "..." │                                        │ - pengetahuan CRUD  │
└─────────────────────┘                                        │ - admin CRUD        │
          │                                                    │ - post CRUD         │
          │                                                    │ - password change   │
          │ session_destroy()                                  │ + ALL guest pages   │
          │                                                    └─────────────────────┘
          ▼
┌─────────────────────┐
│  NO SESSION         │
│  (Back to Guest)    │
└─────────────────────┘
```

---

### Component Diagram - System Architecture

```
┌─────────────────────────────────────────────────────────────────────────────────┐
│                              BROWSER (CLIENT)                                    │
│  ┌──────────────────┐  ┌──────────────────┐  ┌──────────────────┐               │
│  │   HTML/CSS/JS    │  │  Bootstrap 5     │  │   AdminLTE v4    │               │
│  │   (Rendered)     │  │  (UI Framework)  │  │   (Theme)        │               │
│  └──────────────────┘  └──────────────────┘  └──────────────────┘               │
│             │                    │                    │                          │
│             └────────────────────┴────────────────────┘                          │
│                                  │                                               │
│                          HTTP Request/Response                                   │
└──────────────────────────────────┼───────────────────────────────────────────────┘
                                   │
                                   ▼
┌──────────────────────────────────────────────────────────────────────────────────┐
│                              WEB SERVER (Apache/Nginx)                           │
│                                                                                  │
│  ┌─────────────────────────────────────────────────────────────────────────┐    │
│  │                         PHP APPLICATION LAYER                            │    │
│  │                                                                          │    │
│  │  ┌───────────────┐                                                      │    │
│  │  │   index.php   │◀─── Main Entry Point                                 │    │
│  │  │   (Router)    │                                                      │    │
│  │  └───────┬───────┘                                                      │    │
│  │          │                                                              │    │
│  │          ▼                                                              │    │
│  │  ┌───────────────┐     ┌───────────────┐     ┌───────────────┐         │    │
│  │  │  content.php  │────▶│   menu.php    │     │  login.php    │         │    │
│  │  │(Content Route)│     │ (Navigation)  │     │ (Auth Handler)│         │    │
│  │  └───────┬───────┘     └───────────────┘     └───────────────┘         │    │
│  │          │                                                              │    │
│  │          ▼                                                              │    │
│  │  ┌────────────────────────────────────────────────────────────────┐    │    │
│  │  │                      MODUL LAYER                                │    │    │
│  │  │  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐       │    │    │
│  │  │  │ welcome  │  │ diagnosa │  │ riwayat  │  │keterangan│       │    │    │
│  │  │  │   .php   │  │   .php   │  │   .php   │  │   .php   │       │    │    │
│  │  │  └──────────┘  └──────────┘  └──────────┘  └──────────┘       │    │    │
│  │  │  ┌──────────┐  ┌──────────┐  ┌──────────┐  ┌──────────┐       │    │    │
│  │  │  │dashboard │  │  repair  │  │ incident │  │pengetahu-│       │    │    │
│  │  │  │   .php   │  │   .php   │  │   .php   │  │  an.php  │       │    │    │
│  │  │  └──────────┘  └────┬─────┘  └────┬─────┘  └────┬─────┘       │    │    │
│  │  │                     │             │             │              │    │    │
│  │  │                     ▼             ▼             ▼              │    │    │
│  │  │              ┌────────────────────────────────────────┐       │    │    │
│  │  │              │           aksi_*.php                   │       │    │    │
│  │  │              │  (CRUD Action Handlers)                │       │    │    │
│  │  │              │  - input, update, hapus                │       │    │    │
│  │  │              └────────────────────────────────────────┘       │    │    │
│  │  └────────────────────────────────────────────────────────────────┘    │    │
│  │                                                                          │    │
│  │  ┌────────────────────────────────────────────────────────────────┐    │    │
│  │  │                      CONFIG LAYER                               │    │    │
│  │  │  ┌───────────────────┐     ┌───────────────────┐              │    │    │
│  │  │  │    koneksi.php    │     │  fungsi_alert.php │              │    │    │
│  │  │  │ (DB Connection)   │     │  (Alert/Confirm)  │              │    │    │
│  │  │  └─────────┬─────────┘     └───────────────────┘              │    │    │
│  │  │            │                                                    │    │    │
│  │  └────────────┼────────────────────────────────────────────────────┘    │    │
│  │               │                                                          │    │
│  └───────────────┼──────────────────────────────────────────────────────────┘    │
│                  │                                                               │
└──────────────────┼───────────────────────────────────────────────────────────────┘
                   │
                   ▼
┌──────────────────────────────────────────────────────────────────────────────────┐
│                              DATABASE SERVER (MySQL)                             │
│                                                                                  │
│  ┌─────────────────────────────────────────────────────────────────────────┐    │
│  │                         DATABASE: dignet                                 │    │
│  │                                                                          │    │
│  │  ┌─────────┐  ┌─────────┐  ┌─────────┐  ┌─────────────────┐            │    │
│  │  │  admin  │  │incident │  │ repair  │  │basis_pengetahuan│            │    │
│  │  └─────────┘  └─────────┘  └─────────┘  └─────────────────┘            │    │
│  │  ┌─────────┐  ┌─────────┐  ┌─────────┐                                 │    │
│  │  │ kondisi │  │  hasil  │  │  post   │                                 │    │
│  │  └─────────┘  └─────────┘  └─────────┘                                 │    │
│  │                                                                          │    │
│  └─────────────────────────────────────────────────────────────────────────┘    │
│                                                                                  │
└──────────────────────────────────────────────────────────────────────────────────┘

┌──────────────────────────────────────────────────────────────────────────────────┐
│                              FILE STORAGE                                        │
│                                                                                  │
│  ┌─────────────────┐  ┌─────────────────┐  ┌─────────────────┐                  │
│  │  gambar/admin/  │  │  gambar/repair/ │  │  gambar/post/   │                  │
│  │  (Logo, icons)  │  │  (Repair imgs)  │  │  (Article imgs) │                  │
│  └─────────────────┘  └─────────────────┘  └─────────────────┘                  │
│                                                                                  │
└──────────────────────────────────────────────────────────────────────────────────┘
```

---

### Class Diagram (Conceptual - PHP tidak OOP tapi ini struktur logisnya)

```
┌─────────────────────────────────────────────────────────────────────────────┐
│                            SISTEM PAKAR DIGNET                               │
└─────────────────────────────────────────────────────────────────────────────┘

┌─────────────────────┐         ┌─────────────────────┐
│      <<entity>>     │         │      <<entity>>     │
│       Admin         │         │      Incident       │
├─────────────────────┤         ├─────────────────────┤
│ - username: string  │         │ - kode: int (PK)    │
│ - password: string  │         │ - nama: string      │
│ - nama_lengkap: str │         ├─────────────────────┤
├─────────────────────┤         │ + getAll(): array   │
│ + login(): bool     │         │ + getById(): obj    │
│ + logout(): void    │         │ + create(): bool    │
│ + getAll(): array   │         │ + update(): bool    │
│ + create(): bool    │         │ + delete(): bool    │
│ + update(): bool    │         └─────────────────────┘
│ + delete(): bool    │                   △
└─────────────────────┘                   │
                                          │ has many
┌─────────────────────┐                   │
│      <<entity>>     │         ┌─────────────────────┐
│       Repair        │         │      <<entity>>     │
├─────────────────────┤         │  BasisPengetahuan   │
│ - kode: int (PK)    │◀────────┤─────────────────────┤
│ - nama: string      │ belongs │ - kode: int (PK)    │
│ - detail: text      │ to      │ - kode_repair: int  │
│ - saran: text       │         │ - kode_incident: int│
│ - gambar: string    │         │ - mb: float         │
├─────────────────────┤         │ - md: float         │
│ + getAll(): array   │         ├─────────────────────┤
│ + getById(): obj    │         │ + getAll(): array   │
│ + create(): bool    │         │ + getByRepair(): arr│
│ + update(): bool    │         │ + create(): bool    │
│ + delete(): bool    │         │ + update(): bool    │
└─────────────────────┘         │ + delete(): bool    │
         △                      │ + getCF(): float    │
         │                      └─────────────────────┘
         │ hasil_id FK
┌─────────────────────┐         ┌─────────────────────┐
│      <<entity>>     │         │      <<entity>>     │
│       Hasil         │         │       Kondisi       │
├─────────────────────┤         ├─────────────────────┤
│ - id: int (PK)      │         │ - id: int (PK)      │
│ - tanggal: datetime │         │ - kondisi: string   │
│ - repair: text      │         │ - ket: string       │
│ - incident: text    │         ├─────────────────────┤
│ - hasil_id: int     │         │ + getAll(): array   │
│ - hasil_nilai: str  │         │ + getBobot(): float │
├─────────────────────┤         └─────────────────────┘
│ + getAll(): array   │
│ + getById(): obj    │         ┌─────────────────────┐
│ + create(): bool    │         │      <<entity>>     │
│ + delete(): bool    │         │        Post         │
└─────────────────────┘         ├─────────────────────┤
                                │ - kode: int (PK)    │
┌─────────────────────┐         │ - nama: string      │
│     <<service>>     │         │ - detail: text      │
│   DiagnosisEngine   │         │ - saran: text       │
├─────────────────────┤         │ - gambar: string    │
│ - incidents: array  │         ├─────────────────────┤
│ - repairs: array    │         │ + getAll(): array   │
│ - rules: array      │         │ + getById(): obj    │
├─────────────────────┤         │ + create(): bool    │
│ + loadData(): void  │         │ + update(): bool    │
│ + processInput()    │         │ + delete(): bool    │
│ + calculateCF()     │         └─────────────────────┘
│ + combineCF()       │
│ + sortResults()     │
│ + saveResult()      │
│ + getResult(): obj  │
└─────────────────────┘
```

---

### Data Flow Diagram (DFD) Level 0

```
                    ┌────────────────────────────────────┐
                    │                                    │
        ┌───────────┤         SISTEM DIGNET              ├───────────┐
        │           │    (Expert System IndiHome)        │           │
        │           │                                    │           │
        │           └────────────────────────────────────┘           │
        │                           │                                │
        │                           │                                │
        ▼                           ▼                                ▼
┌───────────────┐         ┌───────────────┐              ┌───────────────┐
│               │         │               │              │               │
│  GUEST USER   │         │  ADMIN/PAKAR  │              │   DATABASE    │
│               │         │               │              │               │
└───────┬───────┘         └───────┬───────┘              └───────┬───────┘
        │                         │                              │
        │ Input:                  │ Input:                       │ Data:
        │ - Pilih gejala          │ - Login credentials          │ - admin
        │ - Tingkat kepastian     │ - CRUD data                  │ - incident
        │                         │ - Management ops             │ - repair
        │                         │                              │ - basis_pngt
        │                         │                              │ - kondisi
        │                         │                              │ - hasil
        │                         │                              │ - post
        │                         │                              │
        │ Output:                 │ Output:                      │
        │ - Hasil diagnosis       │ - Dashboard stats            │
        │ - Saran penanganan      │ - Data lists                 │
        │ - Riwayat               │ - CRUD feedback              │
        │                         │                              │
        └─────────────────────────┴──────────────────────────────┘
```

---

### Data Flow Diagram (DFD) Level 1

```
                                 ┌─────────────┐
                                 │ GUEST USER  │
                                 └──────┬──────┘
                                        │
            ┌───────────────────────────┼───────────────────────────┐
            │                           │                           │
            ▼                           ▼                           ▼
    ┌───────────────┐           ┌───────────────┐           ┌───────────────┐
    │               │           │               │           │               │
    │  1.0 PROSES   │           │  2.0 PROSES   │           │  3.0 PROSES   │
    │  DIAGNOSA     │           │  RIWAYAT      │           │  INFO         │
    │               │           │               │           │               │
    └───────┬───────┘           └───────┬───────┘           └───────────────┘
            │                           │                           │
            │ R/W                       │ Read                      │ Read
            ▼                           ▼                           ▼
    ┌───────────────┐           ┌───────────────┐           ┌───────────────┐
    │  D1 incident  │           │   D4 hasil    │           │   D5 post     │
    │  D2 repair    │           │               │           │               │
    │  D3 basis_pn  │           │               │           │               │
    │  D4 hasil     │           │               │           │               │
    │  D6 kondisi   │           │               │           │               │
    └───────────────┘           └───────────────┘           └───────────────┘


                                 ┌─────────────┐
                                 │ ADMIN USER  │
                                 └──────┬──────┘
                                        │
    ┌───────────────┬───────────────────┼───────────────────┬───────────────┐
    │               │                   │                   │               │
    ▼               ▼                   ▼                   ▼               ▼
┌────────┐    ┌────────┐          ┌────────┐          ┌────────┐    ┌────────┐
│  4.0   │    │  5.0   │          │  6.0   │          │  7.0   │    │  8.0   │
│ KELOLA │    │ KELOLA │          │ KELOLA │          │ KELOLA │    │ KELOLA │
│ REPAIR │    │INCIDENT│          │ BASIS  │          │ ADMIN  │    │ POST   │
│        │    │        │          │PENGETH.│          │        │    │        │
└───┬────┘    └───┬────┘          └───┬────┘          └───┬────┘    └───┬────┘
    │             │                   │                   │             │
    │ CRUD        │ CRUD              │ CRUD              │ CRUD        │ CRUD
    ▼             ▼                   ▼                   ▼             ▼
┌────────┐    ┌────────┐          ┌────────┐          ┌────────┐    ┌────────┐
│   D2   │    │   D1   │          │   D3   │          │   D0   │    │   D5   │
│ repair │    │incident│          │basis_pn│          │ admin  │    │  post  │
└────────┘    └────────┘          └────────┘          └────────┘    └────────┘
```

---

### Flowchart - Certainty Factor Calculation

```
                              ┌─────────────────┐
                              │     START       │
                              └────────┬────────┘
                                       │
                                       ▼
                          ┌────────────────────────┐
                          │ INPUT: Selected        │
                          │ incidents + kondisi    │
                          │ (user_cf values)       │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ Initialize:            │
                          │ results = {}           │
                          └───────────┬────────────┘
                                      │
                                      ▼
                    ┌─────────────────────────────────────┐
                    │   FOR each repair in database       │
                    └────────────────┬────────────────────┘
                                     │
                                     ▼
                          ┌────────────────────────┐
                          │ cf_combined = 0        │
                          └───────────┬────────────┘
                                      │
                                      ▼
                    ┌─────────────────────────────────────┐
                    │   FOR each selected incident        │
                    └────────────────┬────────────────────┘
                                     │
                                     ▼
                          ┌────────────────────────┐
                          │ Get rule from          │
                          │ basis_pengetahuan      │
                          │ WHERE repair & incident│
                          └───────────┬────────────┘
                                      │
                                      ▼
                            ┌─────────────────┐
                            │ Rule exists?    │
                            └────────┬────────┘
                                     │
                    ┌────────────────┴────────────────┐
                    │ NO                              │ YES
                    ▼                                 ▼
          ┌──────────────────┐            ┌──────────────────────┐
          │ Skip to next     │            │ cf_pakar = MB - MD   │
          │ incident         │            │ user_bobot = kondisi │
          └────────┬─────────┘            │ cf = cf_pakar *      │
                   │                      │     user_bobot       │
                   │                      └───────────┬──────────┘
                   │                                  │
                   │                                  ▼
                   │                      ┌──────────────────────┐
                   │                      │ cf >= 0 AND          │
                   │                      │ cf_combined >= 0?    │
                   │                      └───────────┬──────────┘
                   │                                  │
                   │              ┌───────────────────┴───────────────────┐
                   │              │ YES                                   │ NO
                   │              ▼                                       ▼
                   │  ┌────────────────────────┐           ┌──────────────────────┐
                   │  │ cf_combined =          │           │ cf * cf_combined     │
                   │  │   cf_combined +        │           │ < 0?                 │
                   │  │   (cf * (1-cf_combined))│           └───────────┬──────────┘
                   │  └───────────┬────────────┘                       │
                   │              │                    ┌────────────────┴────────────────┐
                   │              │                    │ YES                             │ NO
                   │              │                    ▼                                 ▼
                   │              │        ┌────────────────────────┐     ┌────────────────────────┐
                   │              │        │ cf_combined =          │     │ cf_combined =          │
                   │              │        │   (cf_combined + cf) / │     │   cf_combined +        │
                   │              │        │   (1 - min(|cf_comb|,  │     │   (cf * (1+cf_combined))│
                   │              │        │          |cf|))        │     │                        │
                   │              │        └───────────┬────────────┘     └───────────┬────────────┘
                   │              │                    │                              │
                   │              └────────────────────┴──────────────────────────────┘
                   │                                   │
                   └───────────────────────────────────┘
                                     │
                                     ▼
                          ┌────────────────────────┐
                          │ cf_combined > 0?       │
                          └───────────┬────────────┘
                                      │
                    ┌─────────────────┴─────────────────┐
                    │ YES                               │ NO
                    ▼                                   ▼
          ┌────────────────────────┐        ┌────────────────────────┐
          │ results[repair_id] =   │        │ Skip (not relevant     │
          │   cf_combined          │        │ repair)                │
          └───────────┬────────────┘        └───────────┬────────────┘
                      │                                 │
                      └─────────────────────────────────┘
                                     │
                                     ▼
                          ┌────────────────────────┐
                          │ Sort results DESC      │
                          │ by cf value            │
                          └───────────┬────────────┘
                                      │
                                      ▼
                          ┌────────────────────────┐
                          │ OUTPUT:                │
                          │ - Top result = diagnosis│
                          │ - Other results =      │
                          │   alternatives         │
                          └───────────┬────────────┘
                                      │
                                      ▼
                              ┌─────────────────┐
                              │      END        │
                              └─────────────────┘
```

---

### Navigation Flow (Sitemap)

```
                                    ┌─────────────────┐
                                    │   index.php     │
                                    │   (Homepage)    │
                                    └────────┬────────┘
                                             │
                    ┌────────────────────────┴────────────────────────┐
                    │                                                  │
                    ▼                                                  ▼
        ┌───────────────────────┐                          ┌───────────────────────┐
        │     GUEST USER        │                          │     ADMIN USER        │
        │     (No Session)      │                          │     (Has Session)     │
        └───────────┬───────────┘                          └───────────┬───────────┘
                    │                                                  │
    ┌───────────────┴───────────────┐              ┌───────────────────┴───────────────┐
    │                               │              │                                   │
    ▼                               ▼              ▼                                   ▼
┌─────────┐                   ┌─────────┐    ┌─────────┐                         ┌─────────┐
│welcome  │                   │formlogin│    │dashboard│                         │ logout  │
│  .php   │                   │  .php   │    │  .php   │                         │  .php   │
│(Landing)│                   │(Login)  │    │(Admin   │                         │         │
└────┬────┘                   └────┬────┘    │ Home)   │                         └─────────┘
     │                             │         └────┬────┘
     ▼                             ▼              │
┌──────────────────────┐    ┌──────────────┐      │
│ diagnosa.php         │    │  login.php   │      ├─────────────────────────────────────────┐
│ ├─ Form pilih gejala │    │  (POST Auth) │      │                                         │
│ └─ Hasil diagnosis   │    └──────────────┘      ▼                                         │
└──────────────────────┘                    ┌──────────────────────┐                        │
                                            │     CRUD MODULES     │                        │
┌──────────────────────┐                    ├──────────────────────┤                        │
│ riwayat.php          │                    │                      │                        │
│ ├─ List riwayat      │                    │  ┌───────────────┐   │                        │
│ └─ detail.php        │                    │  │ repair.php    │   │                        │
└──────────────────────┘                    │  │ ├─ List       │   │                        │
                                            │  │ ├─ Add form   │   │                        │
┌──────────────────────┐                    │  │ ├─ Edit form  │   │                        │
│ keterangan.php       │                    │  │ └─aksi_repair │   │                        │
│ (Articles/Post list) │                    │  └───────────────┘   │                        │
└──────────────────────┘                    │                      │                        │
                                            │  ┌───────────────┐   │                        │
┌──────────────────────┐                    │  │ incident.php  │   │                        │
│ harga.php            │                    │  │ (Same pattern)│   │                        │
│ (Pricing Info)       │                    │  └───────────────┘   │                        │
└──────────────────────┘                    │                      │                        │
                                            │  ┌───────────────┐   │                        │
┌──────────────────────┐                    │  │pengetahuan.php│   │                        │
│ tentang.php          │◀───────────────────│  │ (Same pattern)│   │◀───────────────────────┤
│ (About Page)         │    Shared          │  └───────────────┘   │    Admin Only         │
└──────────────────────┘    Pages           │                      │                        │
                                            │  ┌───────────────┐   │                        │
┌──────────────────────┐                    │  │ admin.php     │   │                        │
│ bantuan.php          │                    │  │ (Same pattern)│   │                        │
│ (Help Page)          │                    │  └───────────────┘   │                        │
└──────────────────────┘                    │                      │                        │
                                            │  ┌───────────────┐   │                        │
                                            │  │ post.php      │   │                        │
                                            │  │ (Same pattern)│   │                        │
                                            │  └───────────────┘   │                        │
                                            │                      │                        │
                                            │  ┌───────────────┐   │                        │
                                            │  │ password.php  │   │                        │
                                            │  │ (Change pwd)  │   │                        │
                                            │  └───────────────┘   │                        │
                                            │                      │                        │
                                            └──────────────────────┘                        │
                                                                                            │
```

---

*Document generated for DigNet v2.0 - Expert System for IndiHome Troubleshooting*
