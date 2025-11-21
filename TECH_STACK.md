# 🛠️ Technology Stack - DigNet 1.0
## Dokumentasi Teknologi untuk BAB 2 Skripsi

> **Sistem Pakar Diagnosis Gangguan IndiHome Berbasis Forward Chaining dan Certainty Factor**

---

## 📋 Table of Contents
1. [Bahasa Pemrograman](#bahasa-pemrograman)
2. [Framework dan Library](#framework-dan-library)
3. [Database Management System](#database-management-system)
4. [Web Server dan Environment](#web-server-dan-environment)
5. [Frontend Technologies](#frontend-technologies)
6. [Build Tools dan Package Managers](#build-tools-dan-package-managers)
7. [Algoritma dan Metode](#algoritma-dan-metode)
8. [Development Tools](#development-tools)

---

## 1. Bahasa Pemrograman

### 1.1 PHP (Hypertext Preprocessor)
- **Versi**: 7.4 atau lebih tinggi (kompatibel dengan PHP 8.x)
- **Fungsi dalam Sistem**:
  - Server-side scripting untuk logika bisnis
  - Koneksi dan manipulasi database
  - Implementasi algoritma Forward Chaining
  - Implementasi perhitungan Certainty Factor
  - Session management untuk autentikasi admin
  - Routing dan URL rewriting

- **Fitur PHP yang Digunakan**:
  - MySQLi untuk koneksi database
  - Session handling (`session_start()`, `$_SESSION`)
  - Output buffering (`ob_start()`)
  - Array manipulation untuk perhitungan CF
  - Error reporting control

- **Contoh Implementasi**:
  ```php
  // Koneksi Database (config/koneksi.php)
  $server = "localhost";
  $username = "root";
  $password = "";
  $database = "dignet";
  $conn = mysqli_connect($server, $username, $password, $database);
  
  // Perhitungan Certainty Factor
  $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1');
  ```

**Referensi untuk Skripsi**:
- The PHP Group. (2024). "PHP: Hypertext Preprocessor". https://www.php.net/
- Nixon, R. (2021). "Learning PHP, MySQL & JavaScript" (6th Edition). O'Reilly Media.

---

### 1.2 JavaScript
- **Versi**: ES6+ (ECMAScript 2015+)
- **Fungsi dalam Sistem**:
  - Client-side interactivity
  - Form validation
  - Dynamic UI updates
  - AJAX requests (untuk operasi tanpa reload)
  - Event handling

- **Fitur JavaScript yang Digunakan**:
  - Modern ES6+ syntax (import/export, arrow functions, const/let)
  - DOM manipulation
  - Event listeners
  - Bootstrap 5 JavaScript components
  - Chart.js untuk visualisasi data

- **Contoh Implementasi**:
  ```javascript
  // Vanilla JavaScript - No jQuery required
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize tooltips, forms, diagnosis interface
  });
  ```

**Referensi untuk Skripsi**:
- Mozilla Developer Network. (2024). "JavaScript Guide". https://developer.mozilla.org/
- Flanagan, D. (2020). "JavaScript: The Definitive Guide" (7th Edition). O'Reilly Media.

---

### 1.3 SQL (Structured Query Language)
- **Fungsi dalam Sistem**:
  - Database schema definition
  - Data manipulation (CRUD operations)
  - Query untuk inference engine
  - Relational data management

- **Contoh Struktur Database**:
  ```sql
  -- Table: basis_pengetahuan (Knowledge Base)
  CREATE TABLE `basis_pengetahuan` (
    `id_pengetahuan` INT PRIMARY KEY,
    `id_gangguan` INT,
    `id_gejala` INT,
    `mb` FLOAT, -- Measure of Belief
    `md` FLOAT  -- Measure of Disbelief
  );
  ```

---

### 1.4 CSS/SCSS (Cascading Style Sheets)
- **Versi**: CSS3 + SCSS (Sass)
- **Fungsi dalam Sistem**:
  - Styling dan layout
  - Responsive design
  - Theme customization
  - Animation dan transitions

- **Fitur yang Digunakan**:
  - Sass preprocessing untuk modular CSS
  - CSS Grid dan Flexbox untuk layout
  - Custom properties (CSS variables)
  - Media queries untuk responsiveness

**Referensi untuk Skripsi**:
- Meyer, E., & Weyl, E. (2023). "CSS: The Definitive Guide" (5th Edition). O'Reilly Media.

---

## 2. Framework dan Library

### Overview: Framework Stack Summary

The system uses a modern, layered framework architecture:

**CSS Framework Layer:**
- **Bootstrap 5.3.3** - Primary responsive CSS framework
  - Mobile-first grid system
  - Pre-built UI components
  - Utility classes
  - No jQuery dependency

**Admin Template Layer:**
- **AdminLTE 4.0.0-beta.2** - Admin dashboard template
  - Built on Bootstrap 5
  - Professional admin layouts
  - Dashboard components

**JavaScript Libraries:**
- **Vanilla JavaScript (ES6+)** - Primary scripting (no framework)
- **jQuery 1.11.3/3.x** - Legacy support for plugins
- **Chart.js 4.4.7** - Data visualization
- **Font Awesome 6.6.0** - Icon library

**CSS Preprocessing:**
- **Sass/SCSS 1.81.0** - CSS preprocessor

**Build Pipeline:**
- **Vite.js 5.4.11** - Modern build tool and dev server
- **npm** - Package management

**Important Note**: This system does **NOT** use JavaScript frameworks like React, Vue, or Angular. It uses **Vanilla JavaScript (ES6+)** with supporting libraries.

---

### 2.1 Bootstrap 5
- **Versi**: 5.3.3
- **Jenis**: Frontend CSS Framework
- **Fungsi dalam Sistem**:
  - Responsive grid system
  - Pre-built UI components (buttons, cards, modals, forms)
  - Utility classes untuk styling cepat
  - Mobile-first approach

- **Komponen yang Digunakan**:
  - Grid system untuk layout
  - Cards untuk menampilkan informasi
  - Forms untuk input user
  - Modals untuk konfirmasi
  - Alerts untuk notifikasi
  - Tables untuk menampilkan data
  - Tooltips dan Popovers

**Referensi untuk Skripsi**:
- Bootstrap Team. (2024). "Bootstrap 5 Documentation". https://getbootstrap.com/
- Otto, M., & Thornton, J. (2021). "Bootstrap: Responsive Web Development". O'Reilly Media.

---

### 2.2 AdminLTE
- **Versi**: 4.0.0-beta.2
- **Jenis**: Admin Dashboard Template
- **Fungsi dalam Sistem**:
  - Admin panel interface
  - Dashboard layout
  - Sidebar navigation
  - Modern, professional UI untuk admin

- **Fitur yang Digunakan**:
  - Pre-designed admin pages
  - Responsive sidebar
  - Card components
  - Professional color scheme

**Referensi untuk Skripsi**:
- Osmani, A. (2023). "AdminLTE - Bootstrap Admin Dashboard Template". https://adminlte.io/

---

### 2.3 jQuery
- **Versi**: 1.11.3 / 3.x (legacy dan modern)
- **Jenis**: JavaScript Library
- **Fungsi dalam Sistem**:
  - DOM manipulation (legacy code)
  - AJAX requests
  - Event handling
  - Plugin support

- **Plugin jQuery yang Digunakan**:
  - Owl Carousel untuk slider/carousel
  - Magnific Popup untuk lightbox
  - EasyTabs untuk tab navigation

**Catatan**: Sistem sedang dalam transisi dari jQuery ke Vanilla JavaScript modern.

**Referensi untuk Skripsi**:
- jQuery Foundation. (2024). "jQuery API Documentation". https://api.jquery.com/

---

### 2.4 Chart.js
- **Versi**: 4.4.7
- **Jenis**: JavaScript Charting Library
- **Fungsi dalam Sistem**:
  - Visualisasi data diagnosis
  - Dashboard statistics
  - Grafik hasil diagnosis

**Referensi untuk Skripsi**:
- Chart.js Team. (2024). "Chart.js Documentation". https://www.chartjs.org/

---

### 2.5 Font Awesome
- **Versi**: 6.6.0
- **Jenis**: Icon Library
- **Fungsi dalam Sistem**:
  - Icons untuk UI elements
  - Navigation icons
  - Status indicators
  - Visual enhancement

**Referensi untuk Skripsi**:
- Fonticons, Inc. (2024). "Font Awesome - The Internet's Icon Library". https://fontawesome.com/

---

## 3. Database Management System

### 3.1 MySQL / MariaDB
- **MySQL Versi**: 5.7 atau lebih tinggi
- **MariaDB Versi**: 10.4.14 atau lebih tinggi
- **Jenis**: Relational Database Management System (RDBMS)

**Fungsi dalam Sistem**:
- Penyimpanan data gangguan IndiHome
- Penyimpanan data gejala
- Penyimpanan basis pengetahuan (rules)
- Penyimpanan riwayat diagnosis
- Penyimpanan data admin
- Penyimpanan informasi harga komponen

**Struktur Database**:
1. **Table: `admin`**
   - Menyimpan data admin/pakar
   - Fields: username, password (MD5), nama_lengkap

2. **Table: `basis_pengetahuan`**
   - Menyimpan aturan IF-THEN
   - Fields: id_pengetahuan, id_gangguan, id_gejala, mb, md
   - Relasi: Foreign key ke tabel gangguan dan gejala

3. **Table: `gangguan`**
   - Menyimpan jenis gangguan IndiHome
   - Fields: id_gangguan, nama_gangguan, solusi, keterangan

4. **Table: `gejala`**
   - Menyimpan data gejala
   - Fields: id_gejala, nama_gejala, bobot

5. **Table: `riwayat`**
   - Menyimpan histori diagnosis
   - Fields: id_riwayat, tanggal, gejala, hasil, cf_value

6. **Table: `post`**
   - Menyimpan artikel/informasi
   - Fields: id_post, judul, konten, tanggal

**Referensi untuk Skripsi**:
- Oracle Corporation. (2024). "MySQL 8.0 Reference Manual". https://dev.mysql.com/doc/
- MariaDB Foundation. (2024). "MariaDB Server Documentation". https://mariadb.com/kb/
- Dubois, P. (2020). "MySQL Cookbook" (4th Edition). O'Reilly Media.

---

## 4. Web Server dan Environment

### 4.1 Apache HTTP Server
- **Fungsi**:
  - Web server untuk melayani aplikasi PHP
  - URL rewriting dengan mod_rewrite
  - Virtual host configuration

**Konfigurasi yang Digunakan**:
```apache
# .htaccess
RewriteEngine On
RewriteRule ^([a-zA-Z0-9]+)/?$ ?module=$1 [NC]
RewriteRule ^riwayat-detail/([0-9]+)/?$ index.php?module=riwayat-detail&id=$1 [NC]
```

**Referensi untuk Skripsi**:
- Apache Software Foundation. (2024). "Apache HTTP Server Documentation". https://httpd.apache.org/docs/

---

### 4.2 XAMPP / LAMP / WAMP Stack
- **Komponen**:
  - **X/L/W**: Cross-platform / Linux / Windows
  - **A**: Apache Web Server
  - **M**: MySQL/MariaDB Database
  - **P**: PHP Programming Language

**Referensi untuk Skripsi**:
- Apache Friends. (2024). "XAMPP - Apache + MariaDB + PHP + Perl". https://www.apachefriends.org/

---

## 5. Frontend Technologies

### 5.1 HTML5
- **Fungsi**:
  - Semantic markup
  - Form elements
  - Accessibility features
  - Modern web standards

**Fitur HTML5 yang Digunakan**:
- Semantic elements (`<header>`, `<nav>`, `<main>`, `<section>`, `<article>`, `<footer>`)
- Form input types (text, email, number, checkbox, radio, select)
- Meta tags untuk SEO dan responsive design
- Data attributes untuk JavaScript interactivity

**Referensi untuk Skripsi**:
- WHATWG. (2024). "HTML Living Standard". https://html.spec.whatwg.org/
- W3C. (2024). "HTML5 Specification". https://www.w3.org/TR/html52/

---

### 5.2 Responsive Web Design
- **Teknik yang Digunakan**:
  - Mobile-first approach
  - Flexible grid layouts
  - Media queries
  - Fluid images
  - Viewport meta tag

**Contoh Implementasi**:
```html
<meta name="viewport" content="width=device-width, initial-scale=1">
```

**Referensi untuk Skripsi**:
- Marcotte, E. (2011). "Responsive Web Design". A Book Apart.

---

## 6. Build Tools dan Package Managers

### 6.1 NPM (Node Package Manager)
- **Fungsi**:
  - Dependency management
  - Package installation
  - Script automation

**Dependencies yang Digunakan**:
```json
{
  "dependencies": {
    "admin-lte": "^4.0.0-beta.2",
    "bootstrap": "^5.3.3",
    "@popperjs/core": "^2.11.8",
    "@fortawesome/fontawesome-free": "^6.6.0",
    "chart.js": "^4.4.7"
  }
}
```

**Referensi untuk Skripsi**:
- npm, Inc. (2024). "npm Documentation". https://docs.npmjs.com/

---

### 6.2 Vite.js
- **Versi**: 5.4.11
- **Jenis**: Modern Build Tool & Development Server
- **Developer**: Evan You (creator of Vue.js)

**Fungsi dalam Sistem**:
1. **Lightning Fast Development Server**
   - Instant server startup (under 1 second)
   - Hot Module Replacement (HMR) with instant feedback
   - Native ES modules support - no bundling during dev
   - Preserves application state during updates

2. **Asset Bundling & Optimization**
   - Bundle JavaScript modules (ES6+)
   - Compile SCSS/Sass to CSS
   - Optimize images and static assets
   - Generate hashed filenames for cache busting

3. **Production Build**
   - Uses Rollup for optimized bundling
   - Automatic code splitting
   - Tree shaking to eliminate dead code
   - Aggressive minification
   - Optimal bundle size

**Key Features**:
- **Native ES Modules**: Leverages browser's native `import` capability
- **Plugin System**: Compatible with Rollup plugins
- **Framework Agnostic**: Works with any framework or vanilla JS
- **Simple Configuration**: Minimal config with powerful defaults
- **Rich Ecosystem**: Large community and plugin support

**Konfigurasi dalam Sistem**:
```javascript
// vite.config.js
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

**Development Workflow**:
```bash
# Start development server
npm run dev
# → Vite dev server starts at http://localhost:3000
# → HMR active, changes reflect instantly

# Build for production
npm run build
# → Compiles and optimizes all assets
# → Output: dist/assets/app.[hash].css, app.[hash].js

# Preview production build
npm run preview
# → Test production build locally
```

**Integration dengan Teknologi Lain**:
- **npm**: Package manager for dependencies
- **Sass**: CSS preprocessing
- **Bootstrap 5**: Imported as npm package
- **AdminLTE 4**: Imported as npm package
- **Chart.js**: Imported as npm package
- **Rollup**: Production bundler
- **ES6+ JavaScript**: Native support without transpilation

**Keuntungan Menggunakan Vite**:
1. **Performance**: 10-100x faster than Webpack
2. **Developer Experience**: Instant feedback loop
3. **Modern**: Embraces ES modules and modern browser features
4. **Simple**: Minimal configuration, works out of the box
5. **Optimized**: Best practices for production builds built-in
6. **Future-proof**: Architecture aligned with web standards

**Alasan Pemilihan**:
- Dramatically improves development experience
- No waiting for slow rebuilds
- Modern approach using native ES modules
- Excellent production optimization
- Simple yet powerful configuration
- Growing ecosystem and community
- Better than older tools (Webpack, Parcel, Gulp)

**Referensi untuk Skripsi**:
- Evan You & Vite Team. (2024). "Vite - Next Generation Frontend Tooling". https://vitejs.dev/
- Osmani, A. (2023). "Modern Web Development with Vite". Web.dev.

---

### 6.3 Sass/SCSS
- **Versi**: 1.81.0
- **Jenis**: CSS Preprocessor
- **Fungsi**:
  - Nested CSS rules
  - Variables dan mixins
  - Modular CSS architecture
  - Import management

**Struktur SCSS**:
```scss
// app.scss
@import 'bootstrap/scss/bootstrap';
@import 'admin-lte/dist/css/adminlte.css';
@import 'custom/variables';
@import 'custom/components';
```

**Referensi untuk Skripsi**:
- Sass Team. (2024). "Sass: Syntactically Awesome Style Sheets". https://sass-lang.com/

---

## 7. Algoritma dan Metode

### 7.1 Forward Chaining
- **Definisi**: Metode inferensi yang bekerja dari fakta (gejala) menuju kesimpulan (diagnosis)
- **Pendekatan**: Data-driven reasoning
- **Implementasi**: Dimulai dari pemilihan gejala oleh user, sistem mencari aturan yang cocok dalam basis pengetahuan

**Proses Forward Chaining dalam Sistem**:
1. User memilih gejala yang dialami
2. Sistem mencari aturan (rules) yang antecedent-nya cocok dengan gejala
3. Sistem mengaktifkan aturan dan menentukan consequent (gangguan)
4. Proses berlanjut hingga tidak ada aturan baru yang dapat diaktifkan
5. Sistem menampilkan diagnosis dengan tingkat keyakinan

**Pseudocode**:
```
INPUT: Kumpulan gejala G = {g1, g2, ..., gn}
OUTPUT: Diagnosis gangguan dengan nilai CF

1. Inisialisasi working memory dengan gejala yang dipilih
2. WHILE ada rule yang dapat di-fire DO:
   3. Cari rule R yang premise-nya match dengan working memory
   4. Evaluasi rule R
   5. Tambahkan conclusion ke working memory
   6. Hitung CF untuk conclusion
6. END WHILE
7. Urutkan diagnosis berdasarkan CF tertinggi
8. Tampilkan hasil diagnosis
```

**Referensi untuk Skripsi**:
- Russell, S., & Norvig, P. (2020). "Artificial Intelligence: A Modern Approach" (4th Edition). Pearson.
- Luger, G. F. (2008). "Artificial Intelligence: Structures and Strategies for Complex Problem Solving" (6th Edition). Addison-Wesley.
- Jackson, P. (1998). "Introduction to Expert Systems" (3rd Edition). Addison-Wesley.

---

### 7.2 Certainty Factor (CF)
- **Definisi**: Metode untuk menangani ketidakpastian dalam sistem pakar
- **Range Nilai**: -1 (pasti tidak) hingga +1 (pasti ya)
- **Komponen**:
  - **MB (Measure of Belief)**: Ukuran kepercayaan terhadap suatu hipotesis
  - **MD (Measure of Disbelief)**: Ukuran ketidakpercayaan terhadap suatu hipotesis
  - **CF = MB - MD**

**Formula Kombinasi CF**:

1. **Jika CF1 dan CF2 keduanya positif**:
   ```
   CFc(CF1,CF2) = CF1 + CF2 × (1 - CF1)
   ```

2. **Jika CF1 dan CF2 keduanya negatif**:
   ```
   CFc(CF1,CF2) = CF1 + CF2 × (1 + CF1)
   ```

3. **Jika salah satu negatif**:
   ```
   CFc(CF1,CF2) = (CF1 + CF2) / (1 - min{|CF1|, |CF2|})
   ```

**Contoh Implementasi dalam PHP**:
```php
// Menghitung CF untuk multiple evidence
function hitungCF($cf1, $cf2) {
    if ($cf1 > 0 && $cf2 > 0) {
        return $cf1 + $cf2 * (1 - $cf1);
    } elseif ($cf1 < 0 && $cf2 < 0) {
        return $cf1 + $cf2 * (1 + $cf1);
    } else {
        return ($cf1 + $cf2) / (1 - min(abs($cf1), abs($cf2)));
    }
}
```

**Perhitungan CF dalam Sistem**:
```
CF(H,E) = CF(E) × CF(Rule)
Dimana:
- CF(H,E) = Certainty Factor hipotesis H berdasarkan evidence E
- CF(E) = Certainty Factor evidence (dari user input)
- CF(Rule) = Certainty Factor rule (dari knowledge base)
```

**Referensi untuk Skripsi**:
- Shortliffe, E. H., & Buchanan, B. G. (1975). "A Model of Inexact Reasoning in Medicine". Mathematical Biosciences, 23(3-4), 351-379.
- Totoharyanto. (2011). "Certainty Factor (CF)". Institut Pertanian Bogor.
- Giarratano, J., & Riley, G. (2004). "Expert Systems: Principles and Programming" (4th Edition). Course Technology.

---

### 7.3 Knowledge Representation
- **Pendekatan**: Rule-based system dengan aturan IF-THEN
- **Struktur Aturan**:
  ```
  IF (kondisi/gejala)
  THEN (kesimpulan/gangguan) {CF: nilai}
  ```

**Contoh Aturan**:
```
[R1]: IF lampu PON berkedip merah 
      THEN gangguan_redaman_tinggi {MB: 0.80, MD: 0.10}

[R2]: IF tidak ada koneksi internet 
      THEN gangguan_redaman_tinggi {MB: 0.60, MD: 0.05}
```

**Referensi untuk Skripsi**:
- Sowa, J. F. (1999). "Knowledge Representation: Logical, Philosophical, and Computational Foundations". Brooks/Cole.

---

## 8. Development Tools

### 8.1 Git & GitHub
- **Git**: Distributed Version Control System
- **GitHub**: Platform hosting dan kolaborasi
- **Fungsi**:
  - Version control
  - Source code management
  - Collaboration
  - Backup

**Referensi untuk Skripsi**:
- Chacon, S., & Straub, B. (2014). "Pro Git" (2nd Edition). Apress.

---

### 8.2 Visual Studio Code
- **Jenis**: Code Editor / IDE
- **Extensions yang Relevan**:
  - PHP Intelephense
  - ESLint
  - Prettier
  - Markdown Preview Mermaid Support

---

### 8.3 PhpMyAdmin
- **Fungsi**:
  - Database administration
  - SQL query execution
  - Table management
  - Data import/export

**Referensi untuk Skripsi**:
- phpMyAdmin Team. (2024). "phpMyAdmin Documentation". https://www.phpmyadmin.net/docs/

---

### 8.4 Browser Developer Tools
- **Fungsi**:
  - Debugging JavaScript
  - Inspecting HTML/CSS
  - Network monitoring
  - Performance profiling

---

## 9. Architectural Pattern

### 9.1 MVC-like Structure
Meskipun tidak menggunakan framework MVC formal, sistem mengikuti pemisahan concerns:

- **Model**: Database tables dan query logic
- **View**: HTML templates dalam folder `modul/`
- **Controller**: File PHP utama yang menangani routing (`index.php`, `menu.php`)

**Struktur Folder**:
```
/
├── config/          # Database configuration
├── modul/           # Module views (pages)
├── css/             # Stylesheets
├── js/              # JavaScript files
├── src/             # Source files (modern)
│   ├── js/          # ES6+ JavaScript
│   └── scss/        # Sass stylesheets
├── gambar/          # Images
└── index.php        # Main entry point
```

---

## 10. Security Features

### 10.1 Authentication & Authorization
- **Session Management**: PHP sessions untuk user authentication
- **Password Hashing**: MD5 (catatan: disarankan upgrade ke bcrypt/argon2)
- **Access Control**: Pemisahan user dan admin

### 10.2 Input Validation
- **SQL Injection Prevention**: MySQLi prepared statements (recommended)
- **XSS Prevention**: HTML escaping untuk output
- **CSRF Protection**: Form tokens (recommended implementation)

**Referensi untuk Skripsi**:
- OWASP. (2024). "OWASP Top Ten Project". https://owasp.org/www-project-top-ten/

---

## 11. Testing & Quality Assurance

### 11.1 Manual Testing
- Functional testing untuk setiap modul
- User acceptance testing (UAT)
- Validation testing untuk perhitungan CF

### 11.2 Validation
- Validasi algoritma Forward Chaining
- Validasi perhitungan Certainty Factor
- Perbandingan hasil manual vs sistem

---

## 12. Documentation Tools

### 12.1 Mermaid
- **Fungsi**: Diagram generation
- **Jenis Diagram**:
  - ERD (Entity Relationship Diagram)
  - Use Case Diagram
  - Activity Diagram
  - Sequence Diagram
  - Class Diagram
  - Flowchart

**Referensi untuk Skripsi**:
- Mermaid Team. (2024). "Mermaid - Generate Diagrams from Text". https://mermaid.js.org/

---

### 12.2 Markdown
- **Fungsi**: Documentation writing
- **File yang Menggunakan Markdown**:
  - README.md
  - CHANGELOG.md
  - TECH_STACK.md
  - Documentation files dalam folder `docs/`

---

## 13. API & External Services

### 13.1 Google Fonts
- **Fonts yang Digunakan**:
  - Inter (300, 400, 500, 600, 700, 800)
  - Poppins (400, 500, 600, 700)
- **Fungsi**: Typography enhancement

### 13.2 CDN (Content Delivery Network)
- **Digunakan untuk**:
  - Font Awesome icons
  - Bootstrap CSS/JS (fallback)
  - AdminLTE (fallback)

---

## 14. Performance Optimization

### 14.1 Frontend Optimization
- Asset bundling dengan Vite
- CSS/JS minification
- Image optimization
- Lazy loading (untuk implementasi future)

### 14.2 Backend Optimization
- Database query optimization
- Session management
- Output buffering
- Caching strategies (untuk implementasi future)

---

## 15. Compatibility & Standards

### 15.1 Browser Compatibility
- **Supported Browsers**:
  - Google Chrome (latest)
  - Mozilla Firefox (latest)
  - Microsoft Edge (latest)
  - Safari (latest)

### 15.2 Web Standards
- HTML5 compliant
- CSS3 compliant
- ECMAScript 2015+ (ES6+)
- W3C Web Accessibility Guidelines (WCAG) awareness

---

## 16. License & Open Source

### 16.1 Open Source Components
Semua library dan framework yang digunakan adalah open source:
- PHP: PHP License
- Bootstrap: MIT License
- AdminLTE: MIT License
- jQuery: MIT License
- Chart.js: MIT License
- Font Awesome: CC BY 4.0 & SIL OFL 1.1 & MIT License

---

## 📊 Summary: Technology Stack Overview

| Category | Technology | Version | Purpose |
|----------|-----------|---------|---------|
| **Backend** | PHP | 7.4+ / 8.x | Server-side logic, FC & CF algorithms |
| **Frontend** | HTML5/CSS3/JS | Latest / ES6+ | Markup, styling & interactivity |
| **CSS Framework** | Bootstrap | 5.3.3 | Responsive UI framework |
| **Admin Template** | AdminLTE | 4.0.0-beta.2 | Admin dashboard template |
| **JavaScript** | Vanilla JS | ES6+ | Client-side scripting (primary) |
| **JS Library** | jQuery | 1.11.3 / 3.x | Legacy support, plugins |
| **Visualization** | Chart.js | 4.4.7 | Data visualization charts |
| **Icons** | Font Awesome | 6.6.0 | Icon library |
| **CSS Preprocessor** | Sass/SCSS | 1.81.0 | CSS preprocessing |
| **Build Tool** | Vite.js | 5.4.11 | Dev server, HMR, bundling |
| **Package Manager** | npm | Latest | Dependency management |
| **Database** | MySQL/MariaDB | 5.7+ / 10.4.14+ | Data persistence (RDBMS) |
| **Web Server** | Apache | 2.4+ | HTTP server |
| **Version Control** | Git & GitHub | Latest | Source control & collaboration |
| **Documentation** | Mermaid | Latest | Diagram generation |
| **Algorithm** | Forward Chaining | - | Inference engine |
| **Algorithm** | Certainty Factor | - | Uncertainty handling |

**Framework Classification:**
- **CSS Framework**: Bootstrap 5.3.3
- **Admin Framework**: AdminLTE 4.0.0-beta.2
- **JavaScript**: Vanilla JS (no framework like React/Vue/Angular)
- **Build Tool**: Vite.js 5.4.11

---

## 📚 Recommended References for Thesis (BAB 2)

### Buku Utama
1. **Sistem Pakar**:
   - Giarratano, J., & Riley, G. (2004). "Expert Systems: Principles and Programming" (4th Edition)
   - Jackson, P. (1998). "Introduction to Expert Systems" (3rd Edition)
   - Turban, E., Aronson, J. E., & Liang, T. P. (2005). "Decision Support Systems and Intelligent Systems" (7th Edition)

2. **Kecerdasan Buatan**:
   - Russell, S., & Norvig, P. (2020). "Artificial Intelligence: A Modern Approach" (4th Edition)
   - Luger, G. F. (2008). "Artificial Intelligence: Structures and Strategies for Complex Problem Solving" (6th Edition)

3. **Web Development**:
   - Nixon, R. (2021). "Learning PHP, MySQL & JavaScript" (6th Edition)
   - Duckett, J. (2014). "HTML and CSS: Design and Build Websites"
   - Flanagan, D. (2020). "JavaScript: The Definitive Guide" (7th Edition)

4. **Database**:
   - Dubois, P. (2020). "MySQL Cookbook" (4th Edition)
   - Elmasri, R., & Navathe, S. B. (2015). "Fundamentals of Database Systems" (7th Edition)

### Paper & Journal
1. Shortliffe, E. H., & Buchanan, B. G. (1975). "A Model of Inexact Reasoning in Medicine". Mathematical Biosciences.
2. Totoharyanto. (2011). "Certainty Factor (CF)". Institut Pertanian Bogor.
3. Marcotte, E. (2011). "Responsive Web Design". A Book Apart.

### Online Resources
1. PHP Official Documentation: https://www.php.net/manual/
2. MySQL Documentation: https://dev.mysql.com/doc/
3. Bootstrap Documentation: https://getbootstrap.com/docs/
4. MDN Web Docs: https://developer.mozilla.org/
5. W3C Web Standards: https://www.w3.org/standards/

---

## 💡 Tips untuk Penulisan BAB 2

### Struktur yang Disarankan:
1. **Tinjauan Pustaka**
   - Definisi Sistem Pakar
   - Komponen Sistem Pakar
   - Metode Inferensi (Forward Chaining)
   - Penanganan Ketidakpastian (Certainty Factor)

2. **Landasan Teori Teknologi**
   - Bahasa Pemrograman PHP
   - Database MySQL/MariaDB
   - Framework Bootstrap
   - Web Development (HTML, CSS, JavaScript)

3. **Metodologi Pengembangan**
   - MVC Architecture (atau pattern yang digunakan)
   - Development Tools
   - Testing Methodology

4. **Penelitian Terkait**
   - Review sistem pakar serupa
   - Perbandingan metode
   - Gap analysis

### Format Penulisan:
- Setiap teknologi dijelaskan: definisi, fungsi, dan alasan pemilihan
- Sertakan referensi yang valid (buku, jurnal, dokumentasi resmi)
- Gunakan diagram untuk menjelaskan arsitektur sistem
- Include contoh code snippet jika diperlukan (untuk menjelaskan implementasi)

---

## 📞 Contact & Further Information

Untuk pertanyaan lebih lanjut mengenai teknologi yang digunakan:
- **Repository**: https://github.com/GalangPutraMaulana19/DigNet-BUG
- **Documentation**: Lihat folder `docs/` untuk diagram dan dokumentasi teknis

---

**Dokumen ini dibuat untuk mendukung penulisan BAB 2 Skripsi**  
*DigNet 1.0 - Sistem Pakar Diagnosis Gangguan IndiHome*  
*© 2025 - Untuk Keperluan Akademik*
