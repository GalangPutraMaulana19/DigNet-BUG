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

## 📝 Yang Perlu Dilakukan Selanjutnya / What Needs To Be Done Next

### 1. Update Data di Database

Saat ini database masih berisi data contoh tentang penyakit ayam. Anda perlu menggantinya dengan data IndiHome:

**Tabel `incident` (sekarang untuk Gejala IndiHome):**
Contoh gejala yang perlu ditambahkan:
- Lampu PON berkedip merah
- Tidak ada koneksi internet
- STB tidak menyala
- Lampu power ONT mati
- Telepon tidak berfungsi
- Kecepatan internet lambat
- dll.

**Tabel `repair` (sekarang untuk Gangguan IndiHome):**
Contoh gangguan yang perlu ditambahkan:
- Gangguan redaman tinggi
- Kabel fiber putus
- ONT rusak
- STB error
- Masalah konfigurasi
- dll.

**Tabel `basis_pengetahuan`:**
Perlu disesuaikan dengan aturan IF-THEN baru berdasarkan pengetahuan teknisi assurance.

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

### 5. Dokumentasi Tambahan

Untuk melengkapi skripsi, pertimbangkan menambahkan:
- Screenshot hasil testing
- Diagram alur sistem
- ERD database
- Flowchart forward chaining
- Tabel perhitungan CF

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
