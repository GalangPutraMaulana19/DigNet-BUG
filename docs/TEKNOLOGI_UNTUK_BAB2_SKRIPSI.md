# 📘 Dokumentasi Teknologi untuk BAB 2 Skripsi
## Sistem Pakar Diagnosis Gangguan IndiHome

> Dokumen ini khusus dibuat untuk mendukung penulisan **BAB 2 (Landasan Teori)** skripsi

---

## Daftar Isi
1. [Ringkasan Teknologi](#1-ringkasan-teknologi)
2. [Bahasa Pemrograman](#2-bahasa-pemrograman)
3. [Framework dan Library](#3-framework-dan-library)
4. [Database Management System](#4-database-management-system)
5. [Metode dan Algoritma](#5-metode-dan-algoritma)
6. [Arsitektur Sistem](#6-arsitektur-sistem)
7. [Tools Pengembangan](#7-tools-pengembangan)
8. [Referensi untuk Skripsi](#8-referensi-untuk-skripsi)

---

## 1. Ringkasan Teknologi

### 1.1 Teknologi Inti yang Digunakan

Sistem Pakar Diagnosis Gangguan IndiHome ini dibangun menggunakan kombinasi teknologi berikut:

| Kategori | Teknologi | Versi | Fungsi Utama |
|----------|-----------|-------|--------------|
| **Backend Language** | PHP | 7.4+ / 8.x | Logika bisnis, algoritma FC & CF |
| **Frontend Language** | HTML5, CSS3, JavaScript | Latest / ES6+ | Antarmuka pengguna |
| **CSS Framework** | Bootstrap | 5.3.3 | Responsive design framework |
| **Admin Template** | AdminLTE | 4.0.0-beta2 | Dashboard admin template |
| **JS Libraries** | Chart.js, jQuery, Font Awesome | 4.4.7, 3.x, 6.6.0 | Visualisasi, DOM, Icons |
| **CSS Preprocessor** | Sass/SCSS | 1.81.0 | CSS preprocessing |
| **Build Tool** | Vite.js | 5.4.11 | Dev server, HMR, bundling |
| **Package Manager** | npm | Latest | Manajemen dependensi |
| **Database** | MySQL / MariaDB | 5.7+ / 10.4.14+ | Penyimpanan data |
| **Web Server** | Apache | 2.4+ | HTTP Server |

### 1.2 Alasan Pemilihan Teknologi

**1.2.1 PHP**
- Open source dan gratis
- Dokumentasi lengkap dan komunitas besar
- Cocok untuk pengembangan sistem berbasis web
- Mudah diintegrasikan dengan MySQL/MariaDB
- Support untuk implementasi algoritma kompleks (Forward Chaining, Certainty Factor)

**1.2.2 MySQL/MariaDB**
- Relational database yang stabil dan matang
- Mendukung transaksi ACID
- Performa tinggi untuk query kompleks
- Kompatibel dengan PHP melalui MySQLi extension
- Free dan open source

**1.2.3 Bootstrap**
- Framework CSS yang mature dan teruji
- Responsive design built-in (mobile-first)
- Komponen UI yang lengkap dan konsisten
- Dokumentasi yang sangat baik
- Mempercepat development dengan pre-built components

**1.2.4 AdminLTE**
- Template admin yang professional
- Sudah terintegrasi dengan Bootstrap
- Menyediakan layout dashboard yang modern
- Mempercepat pengembangan interface admin

**1.2.5 Vite.js**
- Build tool modern dengan HMR instant
- Development server yang sangat cepat
- Optimized production build dengan Rollup
- Native ES modules support
- Meningkatkan development experience secara signifikan

### 1.3 Ringkasan Framework dan Library yang Digunakan

Sistem ini menggunakan kombinasi framework dan library berikut:

**Framework CSS:**
- **Bootstrap 5.3.3** - Framework CSS utama untuk responsive design
  - Grid system 12-column
  - Pre-built UI components (buttons, forms, cards, modals, tables)
  - Mobile-first approach
  - Utility classes
  - No jQuery dependency (Bootstrap 5+)

**Framework Admin:**
- **AdminLTE 4.0.0-beta.2** - Template dashboard admin
  - Built on top of Bootstrap 5
  - Ready-to-use admin layouts
  - Sidebar navigation
  - Dashboard components
  - Modern ES6+ JavaScript

**JavaScript Libraries:**
- **jQuery 1.11.3 / 3.x** - JavaScript library (legacy support)
  - DOM manipulation
  - AJAX requests
  - Plugin ecosystem (Owl Carousel, Magnific Popup)
  - Note: Sistem sedang migrasi ke Vanilla JS modern

- **Chart.js 4.4.7** - Data visualization library
  - Interactive charts dan graphs
  - Responsive charts
  - Multiple chart types (bar, line, pie, doughnut)
  - Canvas-based rendering

- **Font Awesome 6.6.0** - Icon library
  - 10,000+ icons
  - Solid, regular, dan brands icon sets
  - Vector icons (scalable)
  - CSS-based implementation

**CSS Preprocessor:**
- **Sass/SCSS 1.81.0** - CSS preprocessor
  - Nested rules
  - Variables dan mixins
  - Modular CSS architecture
  - Import management

**Build Tool:**
- **Vite.js 5.4.11** - Modern build tool
  - Development server dengan HMR
  - Asset bundling dan optimization
  - Sass/SCSS compilation
  - Production build dengan Rollup

**Package Manager:**
- **npm** - Node Package Manager
  - Dependency management
  - Script runner
  - Package installation

**Catatan Penting:**
Sistem ini **TIDAK menggunakan** framework JavaScript seperti React, Vue, atau Angular. Sistem menggunakan **Vanilla JavaScript (ES6+)** untuk client-side scripting dengan bantuan library seperti Bootstrap JS, Chart.js, dan jQuery (legacy).

---

## 2. Bahasa Pemrograman

### 2.1 PHP (Hypertext Preprocessor)

**2.1.1 Definisi**

PHP adalah bahasa pemrograman server-side scripting yang dirancang khusus untuk pengembangan web. PHP bersifat open-source dan dapat di-embed langsung ke dalam HTML (Nixon, 2021).

**2.1.2 Fungsi dalam Sistem**

Dalam sistem ini, PHP berperan sebagai:

1. **Server-Side Logic Engine**
   - Menangani request dari client
   - Memproses form input
   - Melakukan validasi data

2. **Database Interface**
   - Koneksi ke database MySQL/MariaDB menggunakan MySQLi
   - Eksekusi query SQL (SELECT, INSERT, UPDATE, DELETE)
   - Pengelolaan data transaksi

3. **Inference Engine Implementation**
   - Implementasi algoritma Forward Chaining
   - Implementasi perhitungan Certainty Factor
   - Proses matching antara gejala dan aturan

4. **Session Management**
   - Autentikasi admin
   - Pengelolaan state aplikasi
   - Security control

**2.1.3 Contoh Implementasi dalam Sistem**

```php
<?php
// Koneksi Database (config/koneksi.php)
$server = "localhost";
$username = "root";
$password = "";
$database = "dignet";

$conn = mysqli_connect($server, $username, $password, $database);

// Implementasi Perhitungan Certainty Factor
function hitungCF($cf1, $cf2) {
    if ($cf1 > 0 && $cf2 > 0) {
        // CF paralel untuk nilai positif
        return $cf1 + $cf2 * (1 - $cf1);
    } elseif ($cf1 < 0 && $cf2 < 0) {
        // CF paralel untuk nilai negatif
        return $cf1 + $cf2 * (1 + $cf1);
    } else {
        // CF paralel untuk nilai berlawanan tanda
        return ($cf1 + $cf2) / (1 - min(abs($cf1), abs($cf2)));
    }
}

// Query untuk mendapatkan rules dari knowledge base
$query = "SELECT * FROM basis_pengetahuan 
          WHERE id_gejala IN ($id_gejala_string)";
$result = mysqli_query($conn, $query);
?>
```

**Referensi**:
- Nixon, R. (2021). *Learning PHP, MySQL & JavaScript* (6th Edition). O'Reilly Media.
- The PHP Group. (2024). "PHP: Hypertext Preprocessor". https://www.php.net/

---

### 2.2 JavaScript

**2.2.1 Definisi**

JavaScript adalah bahasa pemrograman tingkat tinggi yang digunakan untuk membuat halaman web interaktif. JavaScript dijalankan di sisi client (browser) dan dapat memanipulasi Document Object Model (DOM) (Flanagan, 2020).

**2.2.2 Fungsi dalam Sistem**

1. **Client-Side Validation**
   - Validasi form sebelum submit ke server
   - Memberikan feedback langsung ke user

2. **Dynamic User Interface**
   - Menampilkan/menyembunyikan elemen
   - Update konten tanpa reload halaman
   - Interactive form elements

3. **AJAX Communication**
   - Request data dari server tanpa reload
   - Update partial page content

4. **Data Visualization**
   - Rendering chart menggunakan Chart.js
   - Visualisasi hasil diagnosis

**2.2.3 Contoh Implementasi**

```javascript
// Modern JavaScript (ES6+) - src/js/app.js
document.addEventListener('DOMContentLoaded', function() {
  // Initialize diagnosis form
  const diagnosisForm = document.querySelector('.diagnosa-form');
  
  if (diagnosisForm) {
    const checkboxes = diagnosisForm.querySelectorAll('input[type="checkbox"]');
    
    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        updateDiagnosisButton();
      });
    });
  }
});

function updateDiagnosisButton() {
  const checkedCount = document.querySelectorAll('input[type="checkbox"]:checked').length;
  const submitBtn = document.querySelector('button[type="submit"]');
  
  if (submitBtn) {
    submitBtn.disabled = checkedCount === 0;
    submitBtn.textContent = checkedCount > 0 
      ? `Proses Diagnosis (${checkedCount} gejala)` 
      : 'Pilih minimal 1 gejala';
  }
}
```

**Referensi**:
- Flanagan, D. (2020). *JavaScript: The Definitive Guide* (7th Edition). O'Reilly Media.
- Mozilla Developer Network. (2024). "JavaScript Guide". https://developer.mozilla.org/

---

### 2.3 SQL (Structured Query Language)

**2.3.1 Definisi**

SQL adalah bahasa standar untuk mengelola dan memanipulasi data dalam Relational Database Management System (RDBMS). SQL digunakan untuk melakukan operasi CREATE, READ, UPDATE, dan DELETE (CRUD) pada database (Elmasri & Navathe, 2015).

**2.3.2 Fungsi dalam Sistem**

1. **Data Definition Language (DDL)**
   - CREATE: Membuat struktur tabel
   - ALTER: Modifikasi struktur tabel
   - DROP: Menghapus tabel

2. **Data Manipulation Language (DML)**
   - SELECT: Query data dari database
   - INSERT: Menambah data baru
   - UPDATE: Mengubah data existing
   - DELETE: Menghapus data

3. **Data Query untuk Inference**
   - Query untuk matching gejala dengan aturan
   - Join table untuk mendapatkan relasi data
   - Aggregation untuk perhitungan CF

**2.3.3 Struktur Database Sistem**

```sql
-- Table: gangguan (Consequent / Conclusion)
CREATE TABLE `gangguan` (
  `id_gangguan` INT PRIMARY KEY AUTO_INCREMENT,
  `nama_gangguan` VARCHAR(255) NOT NULL,
  `solusi` TEXT,
  `keterangan` TEXT
);

-- Table: gejala (Antecedent / Premise)
CREATE TABLE `gejala` (
  `id_gejala` INT PRIMARY KEY AUTO_INCREMENT,
  `nama_gejala` VARCHAR(255) NOT NULL,
  `bobot` FLOAT
);

-- Table: basis_pengetahuan (Rules / Knowledge Base)
CREATE TABLE `basis_pengetahuan` (
  `id_pengetahuan` INT PRIMARY KEY AUTO_INCREMENT,
  `id_gangguan` INT,
  `id_gejala` INT,
  `mb` FLOAT,  -- Measure of Belief
  `md` FLOAT,  -- Measure of Disbelief
  FOREIGN KEY (`id_gangguan`) REFERENCES `gangguan`(`id_gangguan`),
  FOREIGN KEY (`id_gejala`) REFERENCES `gejala`(`id_gejala`)
);

-- Table: riwayat (History)
CREATE TABLE `riwayat` (
  `id_riwayat` INT PRIMARY KEY AUTO_INCREMENT,
  `tanggal` DATETIME,
  `gejala_terpilih` TEXT,
  `hasil_diagnosis` TEXT,
  `nilai_cf` FLOAT
);
```

**Referensi**:
- Elmasri, R., & Navathe, S. B. (2015). *Fundamentals of Database Systems* (7th Edition). Pearson.
- Dubois, P. (2020). *MySQL Cookbook* (4th Edition). O'Reilly Media.

---

## 3. Framework dan Library

### 3.1 Bootstrap

**3.1.1 Definisi**

Bootstrap adalah framework CSS open-source yang paling populer untuk mengembangkan responsive dan mobile-first website. Bootstrap menyediakan komponen UI pre-built dan sistem grid yang powerful (Otto & Thornton, 2021).

**3.1.2 Versi yang Digunakan**

Sistem ini menggunakan **Bootstrap 5.3.3**, yang merupakan versi terbaru dengan fitur-fitur modern seperti:
- CSS Grid support
- Improved responsive utilities
- Enhanced form controls
- Custom CSS properties (variables)
- No jQuery dependency

**3.1.3 Fungsi dalam Sistem**

1. **Grid System**
   - Layout responsive dengan 12-column grid
   - Breakpoints untuk berbagai ukuran device (xs, sm, md, lg, xl, xxl)

2. **UI Components**
   - Buttons: Tombol dengan berbagai style dan size
   - Cards: Container untuk menampilkan informasi
   - Forms: Input elements dengan styling konsisten
   - Tables: Tabel data yang responsive
   - Modals: Dialog box untuk konfirmasi
   - Alerts: Notifikasi untuk user feedback

3. **Utility Classes**
   - Spacing (margin, padding)
   - Typography (font size, weight, alignment)
   - Colors (background, text, border)
   - Display (flex, grid, none, block)

**3.1.4 Contoh Penggunaan**

```html
<!-- Responsive Grid Layout -->
<div class="container">
  <div class="row">
    <div class="col-12 col-md-6 col-lg-4">
      <div class="card shadow-sm">
        <div class="card-body">
          <h5 class="card-title">Diagnosis Result</h5>
          <p class="card-text">Gangguan: Create Ulang ONT</p>
          <div class="progress">
            <div class="progress-bar bg-success" style="width: 84%">
              CF: 84%
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Form Components -->
<form class="needs-validation" novalidate>
  <div class="mb-3">
    <label for="gejala" class="form-label">Pilih Gejala</label>
    <select class="form-select" id="gejala" required>
      <option value="">Pilih...</option>
      <option value="1">Telepon tidak berfungsi</option>
    </select>
    <div class="invalid-feedback">
      Pilih minimal satu gejala.
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

**Keuntungan Menggunakan Bootstrap**:
- Development lebih cepat dengan pre-built components
- Consistency dalam design
- Responsive by default (mobile-first)
- Cross-browser compatibility
- Dokumentasi yang sangat lengkap
- Komunitas besar dan aktif

**Referensi**:
- Bootstrap Team. (2024). "Bootstrap 5 Documentation". https://getbootstrap.com/
- Otto, M., & Thornton, J. (2021). *Bootstrap: Responsive Web Development*. O'Reilly Media.

---

### 3.2 AdminLTE

**3.2.1 Definisi**

AdminLTE adalah template dashboard admin open-source yang dibangun di atas Bootstrap. AdminLTE menyediakan berbagai komponen UI yang sudah jadi untuk membangun admin panel yang professional dan modern.

**3.2.2 Versi yang Digunakan**

Sistem menggunakan **AdminLTE 4.0.0-beta.2** yang merupakan versi terbaru dengan:
- Built on Bootstrap 5
- Modern ES6+ JavaScript (no jQuery required)
- Improved performance
- Better accessibility
- Dark mode support

**3.2.3 Fitur yang Digunakan**

1. **Layout Components**
   - Sidebar navigation
   - Top navbar
   - Footer
   - Content wrapper

2. **Dashboard Elements**
   - Info boxes
   - Small boxes (stats)
   - Cards with various styles
   - Data tables

3. **UI Elements**
   - Custom buttons
   - Enhanced forms
   - Modals
   - Alerts & callouts

**Referensi**:
- AdminLTE Team. (2024). "AdminLTE Documentation". https://adminlte.io/docs/

---

### 3.3 Chart.js

**3.3.1 Definisi**

Chart.js adalah library JavaScript open-source untuk membuat chart dan grafik yang interaktif dan responsive.

**3.3.2 Fungsi dalam Sistem**

- Visualisasi statistik diagnosis
- Grafik perbandingan gangguan
- Dashboard analytics

**Referensi**:
- Chart.js Team. (2024). "Chart.js Documentation". https://www.chartjs.org/

---

### 3.4 Font Awesome

**3.4.1 Definisi**

Font Awesome adalah library icon yang paling populer, menyediakan ribuan icon siap pakai untuk web development.

**3.4.2 Versi yang Digunakan**

**Font Awesome 6.6.0** dengan icon set lengkap:
- Solid icons
- Regular icons
- Brands icons

**3.4.3 Fungsi dalam Sistem**

- Icons untuk navigation menu
- Icons untuk buttons dan actions
- Status indicators
- Visual enhancement untuk UI

**Contoh Penggunaan**:
```html
<i class="fa-solid fa-stethoscope"></i> Diagnosis
<i class="fa-solid fa-history"></i> Riwayat
<i class="fa-solid fa-database"></i> Data Gangguan
```

**Referensi**:
- Fonticons, Inc. (2024). "Font Awesome Documentation". https://fontawesome.com/

---

## 4. Database Management System

### 4.1 MySQL / MariaDB

**4.1.1 Definisi**

MySQL adalah Relational Database Management System (RDBMS) open-source yang paling populer di dunia. MariaDB adalah fork dari MySQL yang memiliki kompatibilitas penuh dengan MySQL namun dengan beberapa enhancement (Dubois, 2020).

**4.1.2 Versi yang Digunakan**

- **MySQL**: 5.7 atau lebih tinggi
- **MariaDB**: 10.4.14 atau lebih tinggi

**4.1.3 Karakteristik RDBMS**

1. **ACID Properties**
   - **Atomicity**: Transaction adalah unit kerja yang atomic (all or nothing)
   - **Consistency**: Database selalu dalam state yang konsisten
   - **Isolation**: Transaksi concurrent tidak saling mengganggu
   - **Durability**: Committed data akan tetap tersimpan walaupun system failure

2. **Relational Model**
   - Data disimpan dalam bentuk tabel (relations)
   - Tabel memiliki primary key yang unik
   - Relasi antar tabel menggunakan foreign key
   - Mendukung normalisasi database

3. **SQL Support**
   - DDL (Data Definition Language)
   - DML (Data Manipulation Language)
   - DCL (Data Control Language)
   - Join operations
   - Subqueries
   - Stored procedures & functions

**4.1.4 Struktur Database Sistem**

**Entity Relationship Diagram (ERD)** sistem menunjukkan relasi:

```
admin (1) ─── mengelola ─── (*) basis_pengetahuan
gangguan (1) ─── memiliki ─── (*) basis_pengetahuan
gejala (1) ─── digunakan_dalam ─── (*) basis_pengetahuan
riwayat (*) ─── mencatat ─── (1) gangguan
```

**4.1.5 Tabel-tabel Utama**

**1. Table: admin**
```sql
CREATE TABLE `admin` (
  `username` VARCHAR(20) PRIMARY KEY,
  `password` VARCHAR(32) NOT NULL,  -- MD5 hash
  `nama_lengkap` VARCHAR(30) NOT NULL
);
```
Fungsi: Menyimpan data admin/pakar yang dapat mengakses sistem

**2. Table: gangguan**
```sql
CREATE TABLE `gangguan` (
  `id_gangguan` INT PRIMARY KEY AUTO_INCREMENT,
  `nama_gangguan` VARCHAR(255) NOT NULL,
  `solusi` TEXT,
  `keterangan` TEXT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Fungsi: Menyimpan jenis-jenis gangguan IndiHome (consequent dalam rules)

**3. Table: gejala**
```sql
CREATE TABLE `gejala` (
  `id_gejala` INT PRIMARY KEY AUTO_INCREMENT,
  `nama_gejala` VARCHAR(255) NOT NULL,
  `bobot` FLOAT,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
```
Fungsi: Menyimpan gejala-gejala yang dapat dialami (antecedent dalam rules)

**4. Table: basis_pengetahuan**
```sql
CREATE TABLE `basis_pengetahuan` (
  `id_pengetahuan` INT PRIMARY KEY AUTO_INCREMENT,
  `id_gangguan` INT NOT NULL,
  `id_gejala` INT NOT NULL,
  `mb` FLOAT NOT NULL DEFAULT 0,      -- Measure of Belief
  `md` FLOAT NOT NULL DEFAULT 0,      -- Measure of Disbelief
  FOREIGN KEY (`id_gangguan`) REFERENCES `gangguan`(`id_gangguan`) 
    ON DELETE CASCADE ON UPDATE CASCADE,
  FOREIGN KEY (`id_gejala`) REFERENCES `gejala`(`id_gejala`) 
    ON DELETE CASCADE ON UPDATE CASCADE
);
```
Fungsi: Menyimpan aturan (rules) IF-THEN dengan nilai CF

Contoh rule:
```
IF (gejala.id_gejala = 1: "Telepon tidak berfungsi")
THEN (gangguan.id_gangguan = 3: "Create Ulang ONT")
WITH CF = MB - MD = 0.8 - 0.1 = 0.7
```

**5. Table: riwayat**
```sql
CREATE TABLE `riwayat` (
  `id_riwayat` INT PRIMARY KEY AUTO_INCREMENT,
  `tanggal` DATETIME NOT NULL,
  `gejala_terpilih` TEXT,
  `hasil_diagnosis` TEXT,
  `nilai_cf` FLOAT,
  `id_gangguan_teratas` INT,
  FOREIGN KEY (`id_gangguan_teratas`) REFERENCES `gangguan`(`id_gangguan`)
);
```
Fungsi: Menyimpan histori diagnosis untuk tracking dan analytics

**6. Table: post**
```sql
CREATE TABLE `post` (
  `id_post` INT PRIMARY KEY AUTO_INCREMENT,
  `judul` VARCHAR(255),
  `konten` TEXT,
  `tanggal` DATETIME,
  `author` VARCHAR(50)
);
```
Fungsi: Menyimpan artikel/informasi tambahan tentang gangguan IndiHome

**4.1.6 Query Penting dalam Sistem**

**Query untuk Forward Chaining**:
```sql
-- Mendapatkan semua aturan yang cocok dengan gejala yang dipilih
SELECT 
  bp.id_gangguan,
  g.nama_gangguan,
  bp.mb,
  bp.md,
  (bp.mb - bp.md) as cf_rule
FROM basis_pengetahuan bp
INNER JOIN gangguan g ON bp.id_gangguan = g.id_gangguan
INNER JOIN gejala gj ON bp.id_gejala = gj.id_gejala
WHERE bp.id_gejala IN (1, 3, 5, 7)  -- ID gejala yang dipilih user
ORDER BY bp.id_gangguan;
```

**Query untuk mendapatkan detail gangguan**:
```sql
SELECT 
  g.id_gangguan,
  g.nama_gangguan,
  g.solusi,
  g.keterangan,
  COUNT(bp.id_pengetahuan) as jumlah_gejala
FROM gangguan g
LEFT JOIN basis_pengetahuan bp ON g.id_gangguan = bp.id_gangguan
GROUP BY g.id_gangguan;
```

**4.1.7 Keuntungan Menggunakan MySQL/MariaDB**

1. **Performance**: Query optimization dan indexing yang baik
2. **Reliability**: ACID compliance memastikan data integrity
3. **Scalability**: Dapat handle dataset yang besar
4. **Security**: User authentication dan access control
5. **Open Source**: Free dengan komunitas besar
6. **Integration**: Mudah diintegrasikan dengan PHP

**Referensi**:
- Dubois, P. (2020). *MySQL Cookbook* (4th Edition). O'Reilly Media.
- Oracle Corporation. (2024). "MySQL 8.0 Reference Manual". https://dev.mysql.com/doc/
- MariaDB Foundation. (2024). "MariaDB Server Documentation". https://mariadb.com/kb/

---

## 5. Metode dan Algoritma

### 5.1 Forward Chaining

**5.1.1 Definisi**

Forward Chaining adalah metode inferensi dalam sistem pakar yang bekerja dari data (fakta) menuju kesimpulan. Metode ini juga dikenal sebagai data-driven reasoning atau bottom-up reasoning (Russell & Norvig, 2020).

**5.1.2 Karakteristik Forward Chaining**

1. **Data-Driven**: Dimulai dari fakta yang diketahui (gejala yang dialami)
2. **Breadth-First Search**: Mengeksplorasi semua kemungkinan aturan yang dapat di-fire
3. **Monotonic**: Kesimpulan yang sudah ditarik tidak dapat dibatalkan
4. **Complete**: Akan menemukan semua kesimpulan yang mungkin

**5.1.3 Proses Forward Chaining dalam Sistem**

**Langkah-langkah**:

1. **Input Facts** (Working Memory)
   - User memilih gejala yang dialami
   - Gejala disimpan dalam working memory
   - Contoh: {G1: "Telepon tidak berfungsi", G3: "Internet tidak terhubung"}

2. **Pattern Matching**
   - Sistem mencari aturan (rules) dalam knowledge base
   - Cek apakah premise (IF part) cocok dengan facts
   - Contoh:
     ```
     Rule R1: IF G1 THEN Gangguan_A {CF: 0.8}
     Rule R2: IF G3 THEN Gangguan_A {CF: 0.6}
     Rule R3: IF G1 AND G3 THEN Gangguan_B {CF: 0.9}
     ```

3. **Rule Firing**
   - Aturan yang cocok di-"fire" (diaktifkan)
   - Conclusion (THEN part) ditambahkan ke working memory
   - CF dari rule dicatat untuk perhitungan

4. **CF Calculation**
   - Jika multiple rules mengarah ke conclusion yang sama:
     ```
     CF(Gangguan_A) = kombinasi CF dari R1 dan R2
     CF(Gangguan_A) = 0.8 + 0.6 × (1 - 0.8)
     CF(Gangguan_A) = 0.8 + 0.12 = 0.92
     ```

5. **Conflict Resolution**
   - Jika ada multiple conclusions, urutkan berdasarkan CF tertinggi
   - Pilih diagnosis dengan CF maksimum

6. **Output**
   - Tampilkan diagnosa beserta nilai CF
   - Sediakan solusi dan penjelasan

**5.1.4 Pseudocode Forward Chaining**

```
ALGORITHM ForwardChaining
INPUT: FactList (gejala yang dipilih user)
OUTPUT: DiagnosisList dengan CF values

1. INITIALIZE:
   WorkingMemory ← FactList
   RulesFired ← empty list
   DiagnosisList ← empty list

2. REPEAT:
   3. FOR each Rule R in KnowledgeBase:
      4. IF Premise(R) matches facts in WorkingMemory:
         5. Fire Rule R
         6. Add Conclusion(R) to WorkingMemory
         7. Add R to RulesFired
         8. Calculate CF for Conclusion(R)
   9. END FOR
10. UNTIL no more rules can be fired

11. FOR each unique Conclusion C in DiagnosisList:
   12. IF multiple rules lead to C:
      13. Combine CF values using CF combination formula
   14. END IF
15. END FOR

16. SORT DiagnosisList by CF value (descending)
17. RETURN DiagnosisList
```

**5.1.5 Contoh Implementasi PHP**

```php
<?php
function forwardChaining($gejala_terpilih) {
    global $conn;
    
    // 1. Convert gejala array to string for SQL query
    $gejala_string = implode(',', $gejala_terpilih);
    
    // 2. Query rules from knowledge base
    $query = "SELECT bp.id_gangguan, bp.mb, bp.md, 
                     g.nama_gangguan
              FROM basis_pengetahuan bp
              JOIN gangguan g ON bp.id_gangguan = g.id_gangguan
              WHERE bp.id_gejala IN ($gejala_string)";
    
    $result = mysqli_query($conn, $query);
    
    // 3. Group rules by gangguan
    $diagnosis = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $id_gangguan = $row['id_gangguan'];
        $cf_rule = $row['mb'] - $row['md'];  // CF = MB - MD
        
        if (!isset($diagnosis[$id_gangguan])) {
            $diagnosis[$id_gangguan] = array(
                'nama_gangguan' => $row['nama_gangguan'],
                'cf_values' => array()
            );
        }
        
        $diagnosis[$id_gangguan]['cf_values'][] = $cf_rule;
    }
    
    // 4. Calculate combined CF for each diagnosis
    foreach ($diagnosis as $id => &$diag) {
        $cf_combined = combineCF($diag['cf_values']);
        $diag['cf_final'] = $cf_combined;
    }
    
    // 5. Sort by CF (descending)
    uasort($diagnosis, function($a, $b) {
        return $b['cf_final'] <=> $a['cf_final'];
    });
    
    return $diagnosis;
}
?>
```

**5.1.6 Kelebihan Forward Chaining**

1. Efisien untuk problem solving dengan banyak starting points
2. Cocok untuk monitoring dan diagnostic tasks
3. Dapat menemukan semua kesimpulan yang mungkin
4. Natural untuk user (dari symptom ke diagnosis)

**5.1.7 Kekurangan Forward Chaining**

1. Dapat menghasilkan banyak intermediate facts yang tidak relevan
2. Membutuhkan waktu lebih lama jika knowledge base sangat besar
3. Kurang efisien untuk goal-directed reasoning

**Referensi**:
- Russell, S., & Norvig, P. (2020). *Artificial Intelligence: A Modern Approach* (4th Edition). Pearson Education.
- Luger, G. F. (2008). *Artificial Intelligence: Structures and Strategies for Complex Problem Solving* (6th Edition). Addison-Wesley.
- Jackson, P. (1998). *Introduction to Expert Systems* (3rd Edition). Addison-Wesley.

---

### 5.2 Certainty Factor (CF)

**5.2.1 Definisi**

Certainty Factor adalah metode untuk mengekspresikan tingkat kepercayaan (belief) terhadap suatu fakta atau aturan. CF diperkenalkan oleh Shortliffe dan Buchanan dalam pengembangan MYCIN, sebuah expert system untuk diagnosis penyakit infeksi (Shortliffe & Buchanan, 1975).

**5.2.2 Range Nilai CF**

```
CF ∈ [-1, +1]

Dimana:
  +1 : Definitely true (pasti benar)
   0 : Unknown (tidak diketahui)
  -1 : Definitely false (pasti salah)

  0.8 - 1.0  : Pasti ya (definitely)
  0.6 - 0.79 : Hampir pasti ya (almost certain)
  0.4 - 0.59 : Kemungkinan besar ya (probably)
  0.2 - 0.39 : Mungkin ya (maybe)
  0.0 - 0.19 : Tidak tahu (unknown)
 -0.2 - -0.01: Mungkin tidak (maybe not)
```

**5.2.3 Komponen Certainty Factor**

1. **MB (Measure of Belief)**
   - Ukuran kenaikan kepercayaan terhadap hipotesis H jika diberikan evidence E
   - MB(H, E) ∈ [0, 1]

2. **MD (Measure of Disbelief)**
   - Ukuran kenaikan ketidakpercayaan terhadap hipotesis H jika diberikan evidence E
   - MD(H, E) ∈ [0, 1]

3. **Certainty Factor**
   ```
   CF(H, E) = MB(H, E) - MD(H, E)
   ```

**5.2.4 Formula Perhitungan CF**

**A. CF untuk Single Evidence**

```
CF(H, E) = CF(E) × CF(Rule)

Dimana:
- CF(H, E) = CF hipotesis H given evidence E
- CF(E) = CF dari evidence (dari user input)
- CF(Rule) = CF dari rule (MB - MD dari knowledge base)
```

**Contoh**:
```
Rule: IF "Telepon tidak berfungsi" (E) 
      THEN "Create Ulang ONT" (H) 
      {MB: 0.8, MD: 0.1}

CF(Rule) = 0.8 - 0.1 = 0.7

Jika user memilih "Pasti ya" → CF(E) = 1.0
Maka: CF(H, E) = 1.0 × 0.7 = 0.7
```

**B. CF untuk Multiple Evidence (Parallel Combination)**

Ketika multiple evidence mengarah ke hipotesis yang sama:

**1. Jika CF1 dan CF2 keduanya positif**:
```
CFc(CF1, CF2) = CF1 + CF2 × (1 - CF1)
```

**2. Jika CF1 dan CF2 keduanya negatif**:
```
CFc(CF1, CF2) = CF1 + CF2 × (1 + CF1)
```

**3. Jika CF1 dan CF2 berlawanan tanda**:
```
CFc(CF1, CF2) = (CF1 + CF2) / (1 - min{|CF1|, |CF2|})
```

**5.2.5 Contoh Perhitungan Lengkap**

**Kasus**:
```
Gejala yang dipilih:
- G1: Telepon tidak berfungsi (CF_user = 1.0, "Pasti ya")
- G3: Internet tidak terhubung (CF_user = 0.8, "Hampir pasti")

Rules dalam knowledge base:
- R1: IF G1 THEN Gangguan_A {MB: 0.8, MD: 0.1} → CF_rule = 0.7
- R2: IF G3 THEN Gangguan_A {MB: 0.6, MD: 0.0} → CF_rule = 0.6
```

**Perhitungan**:

Step 1: Hitung CF untuk setiap evidence
```
CF1(Gangguan_A, G1) = CF(G1) × CF(R1)
                     = 1.0 × 0.7
                     = 0.7

CF2(Gangguan_A, G3) = CF(G3) × CF(R2)
                     = 0.8 × 0.6
                     = 0.48
```

Step 2: Kombinasikan CF (karena keduanya positif)
```
CFc = CF1 + CF2 × (1 - CF1)
    = 0.7 + 0.48 × (1 - 0.7)
    = 0.7 + 0.48 × 0.3
    = 0.7 + 0.144
    = 0.844
```

**Kesimpulan**: Gangguan_A memiliki CF = 0.844 atau **84.4%**

**5.2.6 Implementasi PHP**

```php
<?php
/**
 * Fungsi untuk mengkombinasikan dua nilai CF
 * @param float $cf1 - Certainty Factor pertama
 * @param float $cf2 - Certainty Factor kedua
 * @return float - CF hasil kombinasi
 */
function combineCF($cf1, $cf2) {
    // Case 1: Both positive
    if ($cf1 > 0 && $cf2 > 0) {
        return $cf1 + $cf2 * (1 - $cf1);
    }
    
    // Case 2: Both negative
    if ($cf1 < 0 && $cf2 < 0) {
        return $cf1 + $cf2 * (1 + $cf1);
    }
    
    // Case 3: Opposite signs
    $min_abs = min(abs($cf1), abs($cf2));
    if ($min_abs < 1) {
        return ($cf1 + $cf2) / (1 - $min_abs);
    }
    
    return 0;
}

/**
 * Fungsi untuk mengkombinasikan array CF values
 * @param array $cf_array - Array of CF values
 * @return float - CF final
 */
function combineCFArray($cf_array) {
    if (empty($cf_array)) {
        return 0;
    }
    
    $result = $cf_array[0];
    
    for ($i = 1; $i < count($cf_array); $i++) {
        $result = combineCF($result, $cf_array[$i]);
    }
    
    return $result;
}

/**
 * Contoh penggunaan dalam diagnosis
 */
function diagnose($gejala_terpilih, $cf_user) {
    global $conn;
    
    $diagnosis = array();
    
    // Get rules from knowledge base
    foreach ($gejala_terpilih as $index => $id_gejala) {
        $cf_evidence = $cf_user[$index];  // CF from user input
        
        $query = "SELECT bp.id_gangguan, bp.mb, bp.md, g.nama_gangguan
                  FROM basis_pengetahuan bp
                  JOIN gangguan g ON bp.id_gangguan = g.id_gangguan
                  WHERE bp.id_gejala = $id_gejala";
        
        $result = mysqli_query($conn, $query);
        
        while ($row = mysqli_fetch_assoc($result)) {
            $cf_rule = $row['mb'] - $row['md'];
            $cf_combined = $cf_evidence * $cf_rule;
            
            $id_gangguan = $row['id_gangguan'];
            
            if (!isset($diagnosis[$id_gangguan])) {
                $diagnosis[$id_gangguan] = array(
                    'nama' => $row['nama_gangguan'],
                    'cf_values' => array()
                );
            }
            
            $diagnosis[$id_gangguan]['cf_values'][] = $cf_combined;
        }
    }
    
    // Combine CF for each diagnosis
    foreach ($diagnosis as $id => &$diag) {
        $diag['cf_final'] = combineCFArray($diag['cf_values']);
        $diag['persentase'] = round($diag['cf_final'] * 100, 2);
    }
    
    // Sort by CF descending
    uasort($diagnosis, function($a, $b) {
        return $b['cf_final'] <=> $a['cf_final'];
    });
    
    return $diagnosis;
}
?>
```

**5.2.7 Tabel Interpretasi CF**

Untuk kemudahan user, sistem mengkonversi CF numerik ke interpretasi verbal:

| Nilai CF | Persentase | Interpretasi |
|----------|------------|-------------|
| 0.8 - 1.0 | 80% - 100% | Pasti / Definitely |
| 0.6 - 0.79 | 60% - 79% | Hampir Pasti / Almost Certain |
| 0.4 - 0.59 | 40% - 59% | Kemungkinan Besar / Probably |
| 0.2 - 0.39 | 20% - 39% | Mungkin / Maybe |
| 0.0 - 0.19 | 0% - 19% | Tidak Diketahui / Unknown |

**5.2.8 Kelebihan Certainty Factor**

1. **Intuitive**: Mudah dipahami oleh user dan expert
2. **Practical**: Tidak memerlukan probabilitas yang presisi
3. **Flexible**: Dapat menangani incomplete information
4. **Implementasi Sederhana**: Tidak kompleks secara komputasi
5. **Proven**: Sudah terbukti dalam MYCIN dan sistem pakar lainnya

**5.2.9 Keterbatasan Certainty Factor**

1. Tidak memiliki basis teoritis yang kuat seperti probability theory
2. Kombinasi CF bukan probabilitas sejati
3. Asumsi independence yang mungkin tidak selalu valid
4. Tidak suitable untuk reasoning yang sangat kompleks

**Referensi**:
- Shortliffe, E. H., & Buchanan, B. G. (1975). "A Model of Inexact Reasoning in Medicine". *Mathematical Biosciences*, 23(3-4), 351-379.
- Totoharyanto. (2011). "Certainty Factor (CF)". Institut Pertanian Bogor.
- Giarratano, J., & Riley, G. (2004). *Expert Systems: Principles and Programming* (4th Edition). Course Technology.
- Durkin, J. (1994). *Expert Systems: Design and Development*. Prentice Hall.

---

## 6. Arsitektur Sistem

### 6.1 Arsitektur Umum

Sistem menggunakan **Client-Server Architecture** dengan pola **3-Tier**:

```
┌─────────────────────────────────────────────┐
│         PRESENTATION LAYER (Tier 1)         │
│   - HTML/CSS (View)                         │
│   - JavaScript (Client Logic)               │
│   - Bootstrap (UI Framework)                │
└──────────────────┬──────────────────────────┘
                   │ HTTP Request/Response
┌──────────────────▼──────────────────────────┐
│        APPLICATION LAYER (Tier 2)           │
│   - PHP (Business Logic)                    │
│   - Forward Chaining Engine                 │
│   - Certainty Factor Calculator             │
│   - Session Management                      │
└──────────────────┬──────────────────────────┘
                   │ SQL Query/Result
┌──────────────────▼──────────────────────────┐
│          DATA LAYER (Tier 3)                │
│   - MySQL/MariaDB Database                  │
│   - Knowledge Base (Rules)                  │
│   - Master Data (Gangguan, Gejala)          │
└─────────────────────────────────────────────┘
```

**Penjelasan**:

**Tier 1 - Presentation Layer**:
- Menangani interaksi dengan user
- Menampilkan UI menggunakan HTML/CSS
- Client-side validation dengan JavaScript
- Responsive design dengan Bootstrap

**Tier 2 - Application Layer**:
- Business logic dalam PHP
- Inference engine (Forward Chaining)
- CF calculation
- Session management untuk authentication

**Tier 3 - Data Layer**:
- Database MySQL/MariaDB
- Menyimpan knowledge base (rules)
- Menyimpan master data
- Transaction management

**Referensi**:
- Pressman, R. S., & Maxim, B. R. (2020). *Software Engineering: A Practitioner's Approach* (9th Edition). McGraw-Hill.

---

### 6.2 Komponen Sistem Pakar

Sistem pakar ini memiliki komponen standar:

```
┌────────────────────────────────────────────────────┐
│                    USER INTERFACE                   │
│  - Form input gejala                               │
│  - Display hasil diagnosis                         │
│  - Admin panel                                     │
└───────────────────┬────────────────────────────────┘
                    │
┌───────────────────▼────────────────────────────────┐
│              INFERENCE ENGINE                      │
│  - Forward Chaining Algorithm                      │
│  - Pattern Matching                                │
│  - Rule Firing                                     │
│  - Certainty Factor Calculation                    │
└───────────────────┬────────────────────────────────┘
                    │
┌───────────────────▼────────────────────────────────┐
│              KNOWLEDGE BASE                        │
│  - Rules (IF-THEN)                                 │
│  - Facts (Gejala, Gangguan)                        │
│  - CF values (MB, MD)                              │
└───────────────────┬────────────────────────────────┘
                    │
┌───────────────────▼────────────────────────────────┐
│              WORKING MEMORY                        │
│  - Current session data                            │
│  - Selected symptoms                               │
│  - Intermediate results                            │
└────────────────────────────────────────────────────┘
```

**Referensi**:
- Jackson, P. (1998). *Introduction to Expert Systems* (3rd Edition). Addison-Wesley.
- Giarratano, J., & Riley, G. (2004). *Expert Systems: Principles and Programming*.

---

### 6.3 Alur Kerja Sistem (System Workflow)

**Flow Diagnosis**:

```
[Start]
   │
   ▼
[User memilih gejala] ──> Working Memory
   │
   ▼
[Submit form] ──> PHP Controller
   │
   ▼
[Forward Chaining Engine]
   │
   ├──> Pattern Matching
   │    (Cari rules yang cocok)
   │
   ├──> Rule Firing
   │    (Aktifkan rules)
   │
   ├──> CF Calculation
   │    (Hitung CF untuk setiap gangguan)
   │
   └──> Combine CF
        (Kombinasi CF jika multiple evidence)
   │
   ▼
[Sort by CF descending]
   │
   ▼
[Generate Results]
   ├──> Top diagnosis
   ├──> CF value/percentage
   ├──> Solutions
   └──> Explanations
   │
   ▼
[Display to User]
   │
   ▼
[Save to History]
   │
   ▼
[End]
```

---

## 7. Tools Pengembangan

### 7.1 XAMPP / LAMP / WAMP Stack

**Komponen**:
- **X/L/W**: Cross-platform / Linux / Windows
- **A**: Apache Web Server
- **M**: MySQL/MariaDB
- **P**: PHP
- **(P)**: Perl (optional)

**Fungsi**: Local development environment untuk testing

**Referensi**:
- Apache Friends. (2024). "XAMPP Documentation". https://www.apachefriends.org/

---

### 7.2 Git & GitHub

**Git**: Distributed version control system
**GitHub**: Platform hosting untuk Git repositories

**Fungsi**:
- Version control
- Collaboration
- Backup dan recovery
- Code review

**Referensi**:
- Chacon, S., & Straub, B. (2014). *Pro Git* (2nd Edition). Apress.

---

### 7.3 Visual Studio Code

**Jenis**: Code editor/IDE
**Extensions**:
- PHP Intelephense
- ESLint
- Prettier

---

### 7.4 Vite.js

**7.4.1 Definisi**

Vite.js adalah modern build tool dan development server yang dikembangkan oleh Evan You (creator Vue.js). Vite memberikan pengalaman development yang sangat cepat dengan memanfaatkan native ES modules dan Hot Module Replacement (HMR) yang instant.

**7.4.2 Versi yang Digunakan**

**Vite 5.4.11** - versi stabil terbaru dengan performa optimal

**7.4.3 Karakteristik Vite**

1. **Lightning Fast HMR (Hot Module Replacement)**
   - Update instan saat development tanpa perlu reload full page
   - Preserves application state selama development
   - Feedback loop yang sangat cepat untuk developer

2. **Native ES Modules**
   - Memanfaatkan native `import` dan `export` dari browser
   - No bundling during development
   - Startup yang sangat cepat bahkan untuk project besar

3. **Optimized Build**
   - Production build menggunakan Rollup
   - Code splitting otomatis
   - Asset optimization
   - Tree shaking untuk menghilangkan dead code

4. **Universal Plugin Interface**
   - Compatible dengan Rollup plugins
   - Extensible architecture
   - Support untuk berbagai framework

**7.4.4 Fungsi dalam Sistem**

Dalam sistem DigNet, Vite.js berperan sebagai:

1. **Development Server**
   - Menyediakan development server dengan port 3000
   - Auto-reload saat file berubah
   - Fast HMR untuk instant feedback
   - Proxy configuration untuk PHP backend

2. **Asset Bundling**
   - Bundle JavaScript modules (ES6+)
   - Compile SCSS/Sass ke CSS
   - Optimize images dan static assets
   - Generate hashed filenames untuk cache busting

3. **Build Tool untuk Production**
   - Minifikasi JavaScript dan CSS
   - Code splitting untuk optimal loading
   - Generate production-ready assets di folder `dist/`
   - Create manifest file untuk asset tracking

**7.4.5 Konfigurasi dalam Sistem**

File konfigurasi: `vite.config.js`

```javascript
import { defineConfig } from 'vite';
import { resolve } from 'path';

export default defineConfig({
  root: '.',
  base: '/dignet/',
  build: {
    outDir: 'dist',
    assetsDir: 'assets',
    manifest: true,
    rollupOptions: {
      input: {
        main: resolve(__dirname, 'src/js/app.js'),
        styles: resolve(__dirname, 'src/scss/app.scss')
      },
      output: {
        entryFileNames: 'assets/[name].[hash].js',
        chunkFileNames: 'assets/[name].[hash].js',
        assetFileNames: 'assets/[name].[hash].[ext]'
      }
    }
  },
  server: {
    port: 3000,
    proxy: {
      '/dignet': {
        target: 'http://localhost',
        changeOrigin: true
      }
    }
  }
});
```

**Penjelasan Konfigurasi**:

- **root**: Base directory untuk project
- **base**: Base public path untuk production
- **build.outDir**: Output directory untuk production build (`dist/`)
- **build.manifest**: Generate manifest.json untuk asset mapping
- **rollupOptions.input**: Entry points untuk bundling (app.js dan app.scss)
- **rollupOptions.output**: Pattern untuk generated filenames dengan hash
- **server.port**: Development server berjalan di port 3000
- **server.proxy**: Proxy requests `/dignet` ke Apache server di localhost

**7.4.6 Workflow Development dengan Vite**

**Development Mode**:
```bash
npm run dev
# Vite starts dev server di http://localhost:3000
# HMR aktif, perubahan langsung terlihat
```

**Production Build**:
```bash
npm run build
# Vite compile dan optimize semua assets
# Output: dist/assets/app.[hash].css dan app.[hash].js
```

**7.4.7 Keuntungan Menggunakan Vite**

1. **Development Experience**
   - Startup server instant (<1 detik)
   - HMR yang sangat cepat
   - No waiting untuk rebuild

2. **Modern JavaScript**
   - Native ES modules support
   - ES6+ features out of the box
   - No transpilation needed in development

3. **Optimized Production**
   - Tree shaking otomatis
   - Code splitting
   - Minifikasi aggressive
   - Optimal bundle size

4. **Developer Friendly**
   - Clear error messages
   - Built-in support untuk CSS preprocessors (Sass)
   - Simple configuration
   - Rich plugin ecosystem

**7.4.8 Integrasi dengan Teknologi Lain**

Vite.js terintegrasi dengan:
- **npm**: Package manager untuk dependencies
- **Sass**: CSS preprocessing
- **Bootstrap 5**: CSS framework (imported via npm)
- **AdminLTE 4**: Admin template (imported via npm)
- **Chart.js**: Visualization library (imported via npm)
- **Rollup**: Production bundler

**7.4.9 Alasan Pemilihan Vite**

1. **Performance**: Jauh lebih cepat dibanding Webpack atau Parcel
2. **Modern**: Memanfaatkan fitur browser modern (ES modules)
3. **Simple Configuration**: Config minimal tapi powerful
4. **Future-proof**: Arsitektur yang modern dan sustainable
5. **Developer Experience**: Instant feedback loop meningkatkan produktivitas

**Referensi**:
- Evan You & Vite Team. (2024). "Vite - Next Generation Frontend Tooling". https://vitejs.dev/
- Osmani, A. (2023). "Modern Web Development with Vite". Web.dev.

---

### 7.5 npm (Node Package Manager)

**Fungsi**:
- Dependency management
- Package installation
- Script automation

---

## 8. Referensi untuk Skripsi

### 8.1 Buku Wajib

**Sistem Pakar & Artificial Intelligence**:
1. Russell, S., & Norvig, P. (2020). *Artificial Intelligence: A Modern Approach* (4th Edition). Pearson.
2. Giarratano, J., & Riley, G. (2004). *Expert Systems: Principles and Programming* (4th Edition). Course Technology.
3. Jackson, P. (1998). *Introduction to Expert Systems* (3rd Edition). Addison-Wesley.
4. Luger, G. F. (2008). *Artificial Intelligence: Structures and Strategies for Complex Problem Solving* (6th Edition). Addison-Wesley.
5. Durkin, J. (1994). *Expert Systems: Design and Development*. Prentice Hall.

**Web Development**:
6. Nixon, R. (2021). *Learning PHP, MySQL & JavaScript* (6th Edition). O'Reilly Media.
7. Duckett, J. (2014). *HTML and CSS: Design and Build Websites*. Wiley.
8. Flanagan, D. (2020). *JavaScript: The Definitive Guide* (7th Edition). O'Reilly Media.

**Database**:
9. Elmasri, R., & Navathe, S. B. (2015). *Fundamentals of Database Systems* (7th Edition). Pearson.
10. Dubois, P. (2020). *MySQL Cookbook* (4th Edition). O'Reilly Media.

**Software Engineering**:
11. Pressman, R. S., & Maxim, B. R. (2020). *Software Engineering: A Practitioner's Approach* (9th Edition). McGraw-Hill.
12. Sommerville, I. (2015). *Software Engineering* (10th Edition). Pearson.

---

### 8.2 Jurnal & Paper

1. **Shortliffe, E. H., & Buchanan, B. G. (1975).** "A Model of Inexact Reasoning in Medicine". *Mathematical Biosciences*, 23(3-4), 351-379.
   - Paper original tentang Certainty Factor dari MYCIN

2. **Totoharyanto. (2011).** "Certainty Factor (CF)". Institut Pertanian Bogor.
   - Penjelasan CF dalam Bahasa Indonesia

3. **Marcotte, E. (2011).** "Responsive Web Design". *A List Apart*.
   - Artikel tentang responsive web design

---

### 8.3 Dokumentasi Online

1. **PHP**: https://www.php.net/manual/
2. **MySQL**: https://dev.mysql.com/doc/
3. **Bootstrap**: https://getbootstrap.com/docs/
4. **JavaScript MDN**: https://developer.mozilla.org/
5. **W3C Standards**: https://www.w3.org/standards/
6. **AdminLTE**: https://adminlte.io/docs/
7. **Chart.js**: https://www.chartjs.org/docs/

---

### 8.4 Referensi IndiHome & Telkom

1. PT Telkom Indonesia. "IndiHome FTTH Services"
2. PT Telkom Akses. "Service Level Agreement & Quality Standards"
3. PT Telkom Indonesia. "IndiHome Technical Specifications"

---

## 9. Template Penulisan BAB 2

### 9.1 Struktur yang Disarankan

```
BAB II LANDASAN TEORI

2.1 Sistem Pakar
    2.1.1 Definisi Sistem Pakar
    2.1.2 Komponen Sistem Pakar
          - Knowledge Base
          - Inference Engine
          - Working Memory
          - User Interface
    2.1.3 Karakteristik Sistem Pakar
    2.1.4 Keuntungan dan Keterbatasan

2.2 Metode Inferensi Forward Chaining
    2.2.1 Definisi Forward Chaining
    2.2.2 Cara Kerja Forward Chaining
    2.2.3 Algoritma Forward Chaining
    2.2.4 Kelebihan dan Kekurangan

2.3 Certainty Factor
    2.3.1 Definisi Certainty Factor
    2.3.2 Komponen CF (MB dan MD)
    2.3.3 Formula Perhitungan CF
    2.3.4 Kombinasi Multiple Evidence
    2.3.5 Contoh Perhitungan

2.4 IndiHome dan Gangguan Jaringan
    2.4.1 Teknologi FTTH (Fiber To The Home)
    2.4.2 Komponen IndiHome (ODP, ONT, STB)
    2.4.3 Jenis-jenis Gangguan
    2.4.4 Proses Troubleshooting

2.5 Teknologi Pengembangan Sistem
    2.5.1 Bahasa Pemrograman PHP
    2.5.2 Database MySQL/MariaDB
    2.5.3 Framework Bootstrap
    2.5.4 Arsitektur Client-Server

2.6 Penelitian Terkait
    2.6.1 Penelitian 1 (Sistem Pakar sejenis)
    2.6.2 Penelitian 2 (Forward Chaining)
    2.6.3 Penelitian 3 (Certainty Factor)
    2.6.4 Gap Analysis
```

---

### 9.2 Contoh Penulisan Sub-bab

**Contoh 2.1.1 Definisi Sistem Pakar**:

> Sistem pakar (expert system) adalah sistem berbasis komputer yang menggunakan pengetahuan, fakta, dan teknik penalaran untuk memecahkan masalah yang biasanya memerlukan keahlian seorang pakar (Giarratano & Riley, 2004). Menurut Jackson (1998), sistem pakar merupakan program komputer yang dirancang untuk memodelkan kemampuan penyelesaian masalah yang dilakukan oleh seorang pakar.
>
> Sistem pakar memiliki kemampuan untuk memberikan solusi terhadap suatu permasalahan spesifik dengan cara meniru kerja para ahli. Dalam konteks diagnosis gangguan IndiHome, sistem pakar berperan sebagai teknisi ahli yang dapat mengidentifikasi jenis gangguan berdasarkan gejala-gejala yang muncul.

**Contoh 2.2.1 Definisi Forward Chaining**:

> Forward chaining adalah metode inferensi yang bekerja dari fakta-fakta yang diketahui menuju kesimpulan. Metode ini sering disebut sebagai data-driven reasoning karena dimulai dari data yang ada untuk mencapai suatu tujuan (Russell & Norvig, 2020).
>
> Dalam sistem diagnosis gangguan IndiHome, forward chaining dimulai dari gejala-gejala yang dialami pengguna (sebagai fakta), kemudian sistem mencari aturan-aturan (rules) yang sesuai dalam basis pengetahuan, dan akhirnya menghasilkan diagnosis berupa jenis gangguan yang paling mungkin terjadi.

---

### 9.3 Tips Penulisan

1. **Setiap statement harus ada referensi**
   - Gunakan format: (Nama, Tahun)
   - Contoh: "...menurut Russell & Norvig (2020)..."

2. **Definisikan istilah teknis**
   - Berikan definisi untuk setiap istilah baru
   - Sertakan referensi dari sumber terpercaya

3. **Gunakan contoh**
   - Berikan contoh konkret dari sistem yang dibangun
   - Sertakan diagram, tabel, atau screenshot jika perlu

4. **Konsisten dalam format**
   - Gunakan format penulisan yang konsisten
   - Ikuti guidelines skripsi dari universitas

5. **Logical flow**
   - Susun sub-bab secara logis
   - Dari umum ke spesifik
   - Dari teori ke implementasi

---

## 10. Checklist untuk BAB 2

Sebelum finalisasi BAB 2, pastikan:

- [ ] Semua definisi sudah dijelaskan dengan jelas
- [ ] Setiap teknologi ada penjelasan dan alasan pemilihan
- [ ] Forward Chaining dijelaskan secara detail (definisi, algoritma, contoh)
- [ ] Certainty Factor dijelaskan lengkap (formula, perhitungan, contoh)
- [ ] Arsitektur sistem digambarkan dengan diagram
- [ ] Semua referensi tercantum dan valid
- [ ] Konsistensi penulisan (font, spacing, format)
- [ ] Tidak ada plagiarisme
- [ ] Gambar/diagram memiliki caption dan nomor
- [ ] Tabel memiliki caption dan nomor
- [ ] Bahasa Indonesia baku dan EYD

---

## 📞 Informasi Lebih Lanjut

Untuk pertanyaan atau diskusi lebih lanjut:
- **Repository**: https://github.com/GalangPutraMaulana19/DigNet-BUG
- **Dokumentasi Teknis**: Folder `docs/`

---

**Dokumen ini dibuat khusus untuk mendukung penulisan BAB 2 Skripsi**  
*Sistem Pakar Diagnosis Gangguan IndiHome*  
*Berbasis Forward Chaining dan Certainty Factor*

---

*Semoga sukses untuk skripsinya! 🎓*
