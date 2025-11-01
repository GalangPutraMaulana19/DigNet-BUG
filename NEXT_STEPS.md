# Langkah Selanjutnya / Next Steps

## ✅ Yang Sudah Dikerjakan / What's Been Done

Sistem telah berhasil diadaptasi dari sistem pakar diagnosis penyakit ayam menjadi sistem pakar diagnosis gangguan IndiHome. Semua perubahan telah dilakukan sesuai dengan konteks skripsi Bab 1.

### Perubahan Utama:
1. ✅ README.md diperbarui dengan konteks IndiHome dan Bab 1 skripsi
2. ✅ Semua terminologi diubah (Repair → Gangguan, Incident → Gejala)
3. ✅ Semua halaman UI diperbarui dengan branding DigNet 1.0
4. ✅ Panel admin diperbarui dengan label yang sesuai
5. ✅ File CHANGELOG.md dibuat untuk dokumentasi
6. ✅ File .gitignore ditambahkan
7. ✅ **BARU:** Dokumentasi BAB 3 lengkap (ERD, UML, Flowchart, Tabel CF)
8. ✅ **BARU:** SQL database IndiHome (dignet_indihome.sql)
9. ✅ **BARU:** Modern CSS 2025 (dignet-modern.css)

## 📝 Yang Perlu Dilakukan Selanjutnya / What Needs To Be Done Next

### 1. Update Data di Database

✅ **SUDAH TERSEDIA**: File `dignet_indihome.sql` sudah berisi data IndiHome yang Anda berikan!

Untuk menggunakan:

```bash
# 1. Backup database lama (jika ada)
mysqldump -u root -p dignet > backup_old.sql

# 2. Import database baru
mysql -u root -p dignet < dignet_indihome.sql

# Atau via phpMyAdmin:
# - Buka phpMyAdmin
# - Pilih database 'dignet'
# - Import file 'dignet_indihome.sql'
```

**Database sudah berisi:**
- ✅ 14 Gejala IndiHome (Telepon tidak dapat digunakan, Internet tidak terhubung, dll.)
- ✅ 17 Jenis Gangguan (Create Ulang ONT, Restart ONT, Ganti STB, dll.)
- ✅ 30 Aturan Basis Pengetahuan dengan nilai MB dan MD
- ✅ Contoh data hasil diagnosis

**Yang perlu Anda lakukan:**
- Validasi aturan dengan teknisi assurance
- Sesuaikan nilai MB/MD berdasarkan expert knowledge
- Tambah gejala/gangguan baru jika diperlukan

### 2. Sesuaikan Halaman "Tentang" (modul/tentang.php)

Isi placeholder berikut dengan informasi sebenarnya:
- `[Nama Dosen]` → Nama dosen pembimbing Anda
- `[Nama Universitas]` → Nama universitas Anda
- `[Your Email]` → Email Anda di README.md

### 3. Update Gambar/Banner

Ganti gambar-gambar yang masih terkait ayam:
- `aset/banner/dignet.jpg` 
- `aset/banner/dignet3.jpg`
- `aset/banner/logo_telkomsel.png` → bisa diganti dengan logo Telkom/IndiHome

### 4. Testing Sistem

1. Install XAMPP atau server lokal
2. Import database dari `spkayam.sql`
3. Ubah nama database di `config/koneksi.php` dari "spkayam" ke "dignet" (sudah dilakukan)
4. Test semua fitur:
   - Login admin
   - Input data gangguan
   - Input data gejala
   - Input basis pengetahuan (aturan CF)
   - Test diagnosis
   - Test riwayat

### 5. Dokumentasi BAB 3 (SUDAH TERSEDIA! ✅)

**Folder `docs/` sudah berisi semua dokumentasi untuk BAB 3 skripsi Anda:**

📁 **docs/README.md** - Panduan lengkap dokumentasi
📊 **docs/BAB3_ERD_DATABASE.md** - Entity Relationship Diagram
📐 **docs/BAB3_UML_DIAGRAM.md** - Use Case, Activity, Sequence, Class, Component Diagram
🔄 **docs/BAB3_FLOWCHART_FORWARD_CHAINING.md** - Flowchart algoritma forward chaining
📈 **docs/BAB3_TABEL_PERHITUNGAN_CF.md** - Contoh perhitungan CF lengkap

**Cara menggunakan:**
1. Buka folder `docs/`
2. Baca `README.md` untuk panduan
3. Render diagram Mermaid menjadi gambar:
   - Online: https://mermaid.live
   - VS Code: Install extension "Markdown Preview Mermaid Support"
   - CLI: `npm install -g @mermaid-js/mermaid-cli`
4. Copy diagram ke skripsi Anda
5. Sesuaikan jika perlu

**Semua diagram siap pakai untuk BAB 3!** 🎉

### 6. Pengisian Data Real

Bekerja sama dengan:
- **PT Mutiara Sentosa** untuk mendapatkan data gangguan riil
- **Teknisi Assurance** untuk knowledge base dan nilai CF
- **Data historis** 60 hari masa retensi jika tersedia

## 🔧 Konfigurasi

### Database
File: `config/koneksi.php`
```php
$server = "localhost";
$username = "root";
$password = "";
$database = "dignet"; // Sudah diubah dari "spkayam"
```

### Login Admin Default
- URL: `http://localhost/dignet/formlogin`
- Username: `admin`
- Password: `admin`

**⚠️ PENTING:** Ganti password default setelah setup!

## 📚 Referensi untuk Skripsi

### Komponen yang Didiagnosis:
1. **ODP** (Optical Distribution Point)
2. **ONT** (Optical Network Terminal)
3. **STB** (Set-Top Box)
4. **Telepon**

### Metode:
- **Forward Chaining**: Inferensi dari gejala ke diagnosis
- **Certainty Factor**: Menangani ketidakpastian (-1 hingga +1)

### Lokasi Penelitian:
- Witel Bekasi
- PT Mutiara Sentosa (mitra Telkom Akses)

### Periode:
- 60 hari masa retensi pascapemasangan

## ⚠️ Catatan Penting

1. Semua kode inti (algoritma CF dan forward chaining) **TIDAK DIUBAH**
2. Hanya terminologi dan UI yang disesuaikan
3. Struktur database tetap sama
4. Sistem tetap kompatibel dengan PHP 7.4 - 8.3

## 📞 Bantuan

Jika ada pertanyaan atau butuh klarifikasi mengenai perubahan yang telah dilakukan, silakan:
1. Baca file `CHANGELOG.md` untuk detail lengkap
2. Baca file `README.md` untuk dokumentasi sistem
3. Cek commit history di GitHub untuk melihat perubahan detail

## ✨ Good Luck dengan Skripsi Anda!

Sistem sudah siap digunakan. Tinggal disesuaikan dengan data real IndiHome dan kebutuhan penelitian Anda.

---

**Dibuat:** 2025-01-11  
**Versi:** DigNet 1.0  
**Status:** Siap untuk customisasi data
