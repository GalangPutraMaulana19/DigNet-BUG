# 🚀 Quick Start Guide - DigNet 1.0 (Update 2025)

## Update Terbaru

Sistem sudah diupgrade dengan:
✅ Dokumentasi BAB 3 lengkap  
✅ Database IndiHome real  
✅ UI modern 2025  
✅ CSS profesional  

---

## 📦 Instalasi Cepat

### 1. Setup Database

```bash
# Buat database
mysql -u root -p
CREATE DATABASE dignet;
exit;

# Import data IndiHome
mysql -u root -p dignet < dignet_indihome.sql
```

### 2. Konfigurasi

Edit `config/koneksi.php`:
```php
$server = "localhost";
$username = "root";
$password = ""; // password MySQL Anda
$database = "dignet";
```

### 3. Akses Sistem

- **URL User**: http://localhost/dignet/
- **URL Admin**: http://localhost/dignet/formlogin
- **Username**: admin
- **Password**: admin

⚠️ **Ganti password default setelah login!**

---

## 📊 Menggunakan Dokumentasi BAB 3

### Lokasi File
Semua ada di folder `docs/`:
```
docs/
├── README.md (Panduan)
├── BAB3_ERD_DATABASE.md (ERD)
├── BAB3_UML_DIAGRAM.md (UML)
├── BAB3_FLOWCHART_FORWARD_CHAINING.md (Flowchart)
└── BAB3_TABEL_PERHITUNGAN_CF.md (Tabel CF)
```

### Cara Render Diagram

**Opsi 1: Online (Termudah)**
1. Buka https://mermaid.live
2. Copy kode diagram dari file `.md`
3. Paste di editor
4. Klik "Export PNG" atau "Export SVG"
5. Masukkan ke skripsi

**Opsi 2: VS Code**
1. Install extension: "Markdown Preview Mermaid Support"
2. Buka file `.md`
3. Tekan `Ctrl+Shift+V` (preview)
4. Screenshot diagram

**Opsi 3: Command Line**
```bash
# Install tool
npm install -g @mermaid-js/mermaid-cli

# Render diagram
mmdc -i docs/BAB3_ERD_DATABASE.md -o ERD_Database.png
mmdc -i docs/BAB3_UML_DIAGRAM.md -o UML_Diagram.png
mmdc -i docs/BAB3_FLOWCHART_FORWARD_CHAINING.md -o Flowchart_FC.png
```

---

## 🎨 UI Modern 2025

### Fitur Baru

✅ **Modern Buttons**
- Gradient colors
- Hover animations
- Shadow effects

✅ **Enhanced Cards**
- Smooth shadows
- Hover lift effect
- Modern borders

✅ **Better Tables**
- Striped rows
- Hover highlights
- Professional headers

✅ **Improved Forms**
- Better focus states
- Input animations
- Clear validation

### Theme Colors

Primary (Telkom Red): `#E21E2C`  
Gradients: Smooth transitions  
Shadows: Material Design inspired  

---

## 🔍 Test Sistem

### 1. Test Diagnosis

1. Akses halaman diagnosis
2. Pilih gejala:
   - ✓ Telepon tidak dapat digunakan (Pasti ya)
   - ✓ Internet tidak terhubung (Pasti ya)
3. Klik "Proses"
4. Hasil: "Create Ulang ONT" (~84%)

### 2. Validasi CF

Gunakan tabel di `docs/BAB3_TABEL_PERHITUNGAN_CF.md`:
- Hitung manual
- Bandingkan dengan hasil sistem
- Harus identik!

### 3. Test Admin Panel

1. Login sebagai admin
2. Test CRUD:
   - Data Gangguan
   - Data Gejala
   - Basis Pengetahuan
3. Cek apakah semua berfungsi

---

## 📸 Screenshot untuk Skripsi

Ambil screenshot dari:

1. **Homepage**
   - Dashboard dengan statistik
   - Menu navigasi

2. **Halaman Diagnosis**
   - Form pemilihan gejala
   - Hasil diagnosis
   - Tabel perhitungan CF

3. **Admin Panel**
   - List data gangguan
   - Form tambah/edit
   - List basis pengetahuan

4. **Riwayat**
   - Daftar riwayat diagnosis
   - Detail diagnosis

---

## 🛠️ Kustomisasi

### Ganti Informasi

Edit `modul/tentang.php`:
```php
// Ganti placeholder
[Nama Dosen] → Nama dosen pembimbing Anda
[Nama Universitas] → Nama universitas Anda
```

### Tambah Gejala/Gangguan

Via admin panel:
1. Login sebagai admin
2. Menu "Data Gejala" → Tambah
3. Menu "Data Gangguan" → Tambah
4. Menu "Basis Pengetahuan" → Tambah aturan

### Update Rules CF

1. Konsultasi dengan teknisi expert
2. Update nilai MB dan MD
3. Via admin panel atau langsung di database

---

## 📋 Checklist Skripsi

### BAB 1 ✅
- [x] Latar belakang
- [x] Rumusan masalah
- [x] Tujuan penelitian

### BAB 2 ✅
- [x] Tinjauan pustaka
- [x] Forward chaining
- [x] Certainty factor

### BAB 3 (Tools Sudah Ready!)
- [ ] ERD Database (✅ File siap)
- [ ] Use Case Diagram (✅ File siap)
- [ ] Activity Diagram (✅ File siap)
- [ ] Sequence Diagram (✅ File siap)
- [ ] Class Diagram (✅ File siap)
- [ ] Flowchart FC (✅ File siap)
- [ ] Tabel CF (✅ File siap)
- [ ] Screenshot sistem
- [ ] Penjelasan implementasi

### BAB 4
- [ ] Testing
- [ ] Validasi hasil
- [ ] Analisis

### BAB 5
- [ ] Kesimpulan
- [ ] Saran

---

## 🆘 Troubleshooting

### Database Error?
```bash
# Cek koneksi
mysql -u root -p
SHOW DATABASES;
USE dignet;
SHOW TABLES;
```

### CSS Tidak Muncul?
Clear browser cache: `Ctrl+Shift+R`

### Diagram Tidak Render?
- Cek syntax Mermaid
- Update browser
- Gunakan https://mermaid.live

### Login Gagal?
- Username: `admin`
- Password: `admin` (MD5: `21232f297a57a5a743894a0e4a801fc3`)

---

## 💡 Tips Skripsi

1. **Konsistensi**: Diagram harus match dengan kode
2. **Validasi**: Test perhitungan manual vs sistem
3. **Screenshot**: Ambil dari sistem yang sudah jalan
4. **Referensi**: Cite paper tentang FC dan CF
5. **Review**: Minta dosen review draft

---

## 📚 Referensi Cepat

### File Penting
- `dignet_indihome.sql` → Database IndiHome
- `docs/` → Semua dokumentasi BAB 3
- `css/dignet-modern.css` → Modern styling
- `CHANGELOG.md` → Riwayat perubahan
- `NEXT_STEPS.md` → Panduan lengkap

### Link Berguna
- Mermaid Live: https://mermaid.live
- AdminLTE Docs: https://adminlte.io
- PHP Manual: https://www.php.net/manual/en/
- MySQL Docs: https://dev.mysql.com/doc/

---

## ✅ Verification Checklist

Sebelum mulai menulis skripsi, pastikan:

- [ ] Database ter-import dengan benar
- [ ] Sistem bisa diakses di localhost
- [ ] Login admin berhasil
- [ ] Diagnosis menghasilkan output
- [ ] Semua diagram bisa di-render
- [ ] Screenshot sistem sudah diambil
- [ ] Perhitungan CF sudah divalidasi
- [ ] Placeholder sudah diganti

---

**Semua ready! Fokus ke penulisan skripsi! 🎓**

---

*DigNet 1.0 - Sistem Pakar Diagnosis Gangguan IndiHome*  
*Update 2025 - Modern, Professional, Complete*
