# Dokumentasi Teknis - Sistem Pakar Diagnosis Gangguan IndiHome

## Untuk BAB 3 Skripsi

Folder ini berisi dokumentasi teknis lengkap untuk **BAB 3: Perancangan Sistem** dalam skripsi Anda.

### 📊 Daftar Diagram dan Dokumentasi

#### 1. **BAB 3 Dokumentasi Lengkap (Baru)**
📄 File: `BAB3_DOKUMENTASI_LENGKAP.md`

Dokumen BAB 3 terpadu yang memuat:
- Arsitektur sistem pakar
- Algoritma diagnosis (Forward Chaining + Certainty Factor)
- Struktur program
- Use Case, Activity, Sequence, dan Class Diagram
- Rancangan relasi tabel, ERD, dan relasi antartabel

**Gunakan untuk:**
- Naskah utama BAB 3
- Ringkasan seluruh rancangan sistem dalam satu file

---

#### 2. **ERD Database** 
📄 File: `BAB3_ERD_DATABASE.md`

Entity Relationship Diagram lengkap dengan penjelasan:
- Struktur tabel dan atribut
- Relasi antar entitas
- Kardinalitas
- Normalisasi database
- Integritas referensial

**Gunakan untuk:**
- Sub-bab Perancangan Database
- Menjelaskan struktur data sistem
- Dokumentasi tabel dan relasi

---

#### 3. **UML Diagram**
📄 File: `BAB3_UML_DIAGRAM.md`

Diagram UML lengkap meliputi:
- **Use Case Diagram**: Interaksi aktor dengan sistem
- **Activity Diagram**: Alur proses diagnosis dan kelola data
- **Sequence Diagram**: Interaksi antar objek
- **Class Diagram**: Struktur kelas dan relasi
- **Component Diagram**: Arsitektur sistem (layer)

**Gunakan untuk:**
- Sub-bab Perancangan Sistem
- Menjelaskan fungsionalitas sistem
- Dokumentasi alur proses

---

#### 4. **Flowchart Forward Chaining**
📄 File: `BAB3_FLOWCHART_FORWARD_CHAINING.md`

Flowchart algoritma forward chaining dengan Certainty Factor:
- Alur inferensi dari gejala ke diagnosis
- Proses perhitungan CF
- Kombinasi CF untuk multiple gejala
- Contoh perhitungan lengkap

**Gunakan untuk:**
- Sub-bab Algoritma Sistem
- Menjelaskan metode inferensi
- Dokumentasi logika diagnosis

---

#### 5. **Tabel Perhitungan CF**
📄 File: `BAB3_TABEL_PERHITUNGAN_CF.md`

Tabel dan contoh perhitungan Certainty Factor:
- Skenario perhitungan lengkap
- Tabel formula kombinasi CF
- Tabel bobot kepastian
- Interpretasi nilai CF
- Contoh output sistem
- Validasi perhitungan

**Gunakan untuk:**
- Sub-bab Metode Certainty Factor
- Membuktikan akurasi perhitungan
- Contoh kasus nyata

---

## 📁 Struktur Folder

```
docs/
├── README.md                              (file ini)
├── BAB3_DOKUMENTASI_LENGKAP.md            (dokumen BAB 3 terpadu)
├── BAB3_ERD_DATABASE.md                   (ERD + penjelasan DB)
├── BAB3_UML_DIAGRAM.md                    (Use Case, Activity, Sequence, dll)
├── BAB3_FLOWCHART_FORWARD_CHAINING.md     (Flowchart algoritma)
└── BAB3_TABEL_PERHITUNGAN_CF.md           (Tabel perhitungan CF)
```

---

## 🎯 Cara Menggunakan

### 1. **Untuk Penulisan Skripsi**

Setiap file sudah disesuaikan dengan format skripsi:
- Gunakan diagram Mermaid untuk visualisasi
- Copy paste ke dokumen Word/LaTeX
- Mermaid dapat di-render menjadi gambar

### 2. **Render Diagram Mermaid**

**Opsi A: Online**
- Buka https://mermaid.live
- Copy paste kode mermaid dari file
- Export sebagai PNG/SVG

**Opsi B: VS Code**
- Install extension "Markdown Preview Mermaid Support"
- Buka file .md
- Klik preview (Ctrl+Shift+V)
- Screenshot diagram

**Opsi C: Command Line**
```bash
npm install -g @mermaid-js/mermaid-cli
mmdc -i BAB3_ERD_DATABASE.md -o ERD.png
```

### 3. **Customize untuk Kebutuhan Anda**

Semua file dapat diedit sesuai kebutuhan:
- Tambah/ubah entitas di ERD
- Sesuaikan use case dengan implementasi
- Update contoh perhitungan CF

---

## 📝 Checklist Penggunaan untuk BAB 3

- [ ] Baca semua dokumentasi
- [ ] Render diagram mermaid menjadi gambar
- [ ] Screenshot hasil sistem untuk dilampirkan
- [ ] Validasi perhitungan CF manual vs sistem
- [ ] Sesuaikan diagram dengan implementasi akhir
- [ ] Tambahkan penjelasan tambahan jika perlu
- [ ] Konsultasi dengan dosen pembimbing

---

## 🔄 Update Diagram

Jika ada perubahan sistem:

1. **Database berubah?** → Update `BAB3_ERD_DATABASE.md`
2. **Fitur baru?** → Update `BAB3_UML_DIAGRAM.md`
3. **Algoritma berubah?** → Update `BAB3_FLOWCHART_FORWARD_CHAINING.md`
4. **Aturan CF baru?** → Update `BAB3_TABEL_PERHITUNGAN_CF.md`

---

## 💡 Tips

1. **Konsistensi**: Pastikan diagram konsisten dengan implementasi kode
2. **Validasi**: Test perhitungan CF manual dengan hasil sistem
3. **Screenshot**: Ambil screenshot sistem untuk melengkapi penjelasan
4. **Referensi**: Cantumkan referensi metodologi yang digunakan
5. **Review**: Minta dosen pembimbing review diagram sebelum finalisasi

---

## 📚 Referensi Metodologi

Dokumen ini menggunakan standar:
- **UML 2.5**: Unified Modeling Language
- **ERD**: Entity Relationship Diagram (Chen Notation)
- **Forward Chaining**: Rule-based inference
- **Certainty Factor**: Metode penanganan ketidakpastian

---

## ❓ Pertanyaan?

Jika ada yang kurang jelas atau perlu penjelasan lebih lanjut:
1. Baca kembali dokumentasi dengan teliti
2. Cek implementasi kode di folder `modul/`
3. Konsultasi dengan dosen pembimbing
4. Review paper/jurnal tentang CF dan Forward Chaining

---

**Good luck dengan skripsi Anda! 🎓**

---

*Generated for: DigNet 1.0 - Sistem Pakar Diagnosis Gangguan IndiHome*  
*Date: 2025*  
*Repository: GalangPutraMaulana19/DigNet*
