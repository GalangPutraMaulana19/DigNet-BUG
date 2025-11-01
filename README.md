# DigNet 1.0
> Sistem Pakar Diagnosis Gangguan IndiHome Berbasis Forward Chaining dan Certainty Factor pada Masa Retensi
>
> Expert System for IndiHome Network Troubleshooting using Forward Chaining and Certainty Factor during Retention Period


## Latar Belakang

IndiHome merupakan layanan triple play dari PT Telkom Indonesia yang memadukan akses internet berbasis fiber to the home (FTTH), layanan digital melalui perangkat set-top box (STB), dan telepon. Sistem pakar ini dirancang untuk membantu teknisi provisioning dalam mendiagnosis gangguan IndiHome selama masa retensi 60 hari.

### Permasalahan

Dalam praktik lapangan di wilayah Witel Bekasi (mitra PT Mutiara Sentosa), masih ditemukan:
- Variasi kualitas instalasi meskipun foto bukti dan hasil uji memenuhi kriteria
- Proses diagnosis yang bergantung pada pengalaman individu teknisi
- Mean time to repair (MTTR) yang memanjang
- Frekuensi kunjungan ulang yang tinggi selama masa retensi 60 hari

### Solusi

Sistem pakar berbasis aturan IF-THEN dengan metode:
- **Forward Chaining**: Proses inferensi dari gejala menuju diagnosis gangguan
- **Certainty Factor (CF)**: Menangani ketidakpastian dengan tingkat keyakinan terukur (-1 hingga +1)

### Komponen yang Didiagnosis
- ODP (Optical Distribution Point)
- ONT (Optical Network Terminal)
- STB (Set-Top Box)
- Telepon

## Tampilan Sistem

### Home
![Home 1](Home%201.png)
![Home 2](Home%202.png)
![Home 3](Home%203.png)
![Home 5](Home%205.png)

### Admin Panel
![Admin 1](Admin%201.png)
![Admin 2](Admin%202.png)

## Konfigurasi

### Persyaratan Sistem
- PHP 7.4 atau lebih tinggi (kompatibel dengan PHP 8.x)
- MariaDB 10.4.14 atau lebih tinggi / MySQL 5.7+
- Web server (Apache/Nginx)
- Browser modern (Chrome, Firefox, Edge, Safari)

### Instalasi

1. Konfigurasi database di file `config/koneksi.php`:
```php
<?php
$server = "localhost";
$username = "root";
$password = "";
$database = "dignet";

$conn = mysqli_connect($server, $username, $password, $database);
?>
```

2. Import database dari file `spkayam.sql` atau `spkayam(new).sql`

3. Akses sistem melalui browser:
   - URL: `http://localhost/dignet/`
   - Login Admin: `http://localhost/dignet/formlogin`
   - Username: **admin**
   - Password: **admin**
## Metode Certainty Factor (CF)

Certainty Factor merupakan teknik untuk mengatasi ketidakpastian dalam pengambilan keputusan dengan nilai berkisar antara -1 hingga +1.

### Formula Kombinasi CF:

Ketika terdapat beberapa gejala (antecedent) yang mengarah pada gangguan yang sama (consequent), nilai CF dikombinasikan dengan formula:

**1. Jika CF1 dan CF2 keduanya positif:**
```
CFc(CF1,CF2) = CF1 + CF2 × (1 - CF1)
```

**2. Jika CF1 dan CF2 keduanya negatif:**
```
CFc(CF1,CF2) = CF1 + CF2 × (1 + CF1)
```

**3. Jika salah satu negatif:**
```
CFc(CF1,CF2) = (CF1 + CF2) / (1 - min{|CF1|, |CF2|})
```

### Contoh Kasus IndiHome:

Misalkan teknisi mengidentifikasi gejala berikut:

- [R1] : IF lampu PON berkedip merah THEN gangguan_redaman_tinggi {cf: 0.80}
- [R2] : IF tidak ada koneksi internet THEN gangguan_redaman_tinggi {cf: 0.60}
- [R3] : IF STB tidak menyala THEN gangguan_power {cf: 0.75}
- [R4] : IF lampu power ONT mati THEN gangguan_power {cf: 0.90}

**Perhitungan:**

1. R1 dan R2 → CFc = 0.80 + 0.60 × (1 - 0.80) = 0.80 + 0.12 = **0.92**

2. R3 dan R4 → CFc = 0.75 + 0.90 × (1 - 0.75) = 0.75 + 0.225 = **0.975**

**Kesimpulan:** Sistem mengidentifikasi gangguan dengan tingkat keyakinan tertinggi untuk prioritas penanganan.

### Referensi:
- Totoharyanto (2011), "Certainty Factor (CF)", IPB University

## Fitur Utama

### Untuk Teknisi (User)
- **Diagnosis Gangguan**: Sistem interaktif untuk memilih gejala dan mendapatkan diagnosis
- **Riwayat Diagnosis**: Melihat histori diagnosis sebelumnya
- **Informasi Keterangan**: Penjelasan detail tentang gangguan dan solusi
- **Info Harga**: Referensi harga komponen IndiHome

### Untuk Admin Pakar
- **Manajemen Data Gangguan**: CRUD data jenis gangguan IndiHome
- **Manajemen Data Gejala**: CRUD data gejala/symptom
- **Basis Pengetahuan**: Mengatur aturan IF-THEN dengan nilai MB (Measure of Belief) dan MD (Measure of Disbelief)
- **Manajemen Post**: Mengelola artikel/keterangan
- **Multi Admin**: Mendukung multiple expert accounts

### Teknologi
- **Responsive Design**: Dapat diakses dari desktop dan mobile
- **AdminLTE**: Interface admin yang modern dan user-friendly
- **Forward Chaining**: Inferensi dari gejala ke diagnosis
- **Certainty Factor**: Perhitungan tingkat keyakinan diagnosis

## Manfaat Penelitian

1. **Standardisasi Diagnosis**: Proses diagnosis menjadi lebih seragam dan terdokumentasi
2. **Efisiensi Waktu**: Mengurangi Mean Time To Repair (MTTR)
3. **Transfer Knowledge**: Pengetahuan tacit teknisi senior menjadi eksplisit
4. **Reduce Repeat Visit**: Menurunkan frekuensi kunjungan ulang
5. **Customer Satisfaction**: Meningkatkan kepuasan pelanggan melalui penanganan cepat dan tepat

## Ruang Lingkup

- **Lokasi**: Witel Bekasi, PT Mutiara Sentosa (Mitra Telkom Akses)
- **Periode**: Masa retensi 60 hari pascapemasangan
- **Komponen**: ODP, ONT, STB, Telepon
- **Pengguna**: Teknisi Provisioning

## Release History

* **1.0.0** (2025)
    * Adaptasi untuk IndiHome troubleshooting system
    * Update ke PHP 8.x compatibility
    * Perubahan terminologi dari chicken disease ke IndiHome network
    
* **0.0.3**
    * Bug Fix Update
    
* **0.0.2**
    * Updated to PHP 7 by [@triannoviandi](https://github.com/triannoviandi)
    
* **0.0.1**
    * Initial version - Chicken disease diagnosis system

## Credits & References

### Original System
- **Base System**: Chicken Disease Expert System
- **Original Author**: [@januriawan](https://github.com/januriawan)
- **PHP 7 Update**: [@triannoviandi](https://github.com/triannoviandi)

### IndiHome Adaptation
- **Developer**: Galang Putra Maulana
- **Institution**: [Your University Name]
- **Supervisor**: [Your Supervisor Name]
- **Year**: 2025

### References
1. PT Telkom Indonesia - IndiHome FTTH Services
2. Telkom Akses - Service Level Agreement & Quality Standards
3. Totoharyanto (2011) - Certainty Factor Method

## License & Disclaimer

- **Tujuan**: Penelitian skripsi dan pembelajaran
- **Penggunaan**: Dilarang untuk diperjualbelikan
- **Source Code**: Open source untuk kepentingan akademis
- **Data**: Contoh data bersifat ilustratif untuk penelitian

## Contact

Untuk pertanyaan mengenai sistem ini, silakan hubungi:
- **Repository**: [GalangPutraMaulana19/DigNet](https://github.com/GalangPutraMaulana19/DigNet)
- **Email**: [Your Email]

---

**Note**: Sistem ini dikembangkan untuk keperluan penelitian skripsi mengenai "Perancangan Sistem Pakar Diagnosis Gangguan IndiHome Berbasis Forward Chaining dan Certainty Factor pada Masa Retensi" di wilayah Witel Bekasi.


