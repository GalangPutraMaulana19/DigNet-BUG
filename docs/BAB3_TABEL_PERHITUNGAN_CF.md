# Tabel Perhitungan Certainty Factor (CF)

## Contoh Perhitungan CF untuk Diagnosis Gangguan IndiHome

### Skenario 1: Gangguan "Create Ulang ONT"

**Gejala yang dipilih user:**

| No | Kode Gejala | Nama Gejala | Tingkat Kepastian | Bobot |
|----|-------------|-------------|-------------------|-------|
| 1 | G01 | Telepon tidak dapat digunakan | Pasti ya | 1.0 |
| 2 | G02 | Internet tidak terhubung | Pasti ya | 1.0 |

**Aturan dari Basis Pengetahuan:**

| Kode Aturan | Gejala | Gangguan | MB | MD | CF = (MB - MD) |
|-------------|--------|----------|-----|-----|----------------|
| R101 | G01 | Create Ulang ONT | 0.7 | 0.1 | 0.6 |
| R102 | G02 | Create Ulang ONT | 0.8 | 0.2 | 0.6 |

**Perhitungan:**

#### Step 1: Hitung CF untuk R101
```
CF1 = (MB - MD) × Bobot_user
    = (0.7 - 0.1) × 1.0
    = 0.6 × 1.0
    = 0.6
```

#### Step 2: Hitung CF untuk R102
```
CF2 = (MB - MD) × Bobot_user
    = (0.8 - 0.2) × 1.0
    = 0.6 × 1.0
    = 0.6
```

#### Step 3: Kombinasi CF (kedua positif)
```
CF_kombinasi = CF1 + CF2 × (1 - CF1)
             = 0.6 + 0.6 × (1 - 0.6)
             = 0.6 + 0.6 × 0.4
             = 0.6 + 0.24
             = 0.84
```

**Hasil:** Gangguan "Create Ulang ONT" dengan keyakinan **84%**

---

### Skenario 2: Multiple Gangguan dengan Berbagai Gejala

**Input User:**

| No | Gejala | Kepastian | Bobot |
|----|--------|-----------|-------|
| 1 | Telepon tidak dapat digunakan | Pasti ya | 1.0 |
| 2 | Internet tidak terhubung | Hampir pasti ya | 0.8 |
| 3 | Lampu PON merah | Pasti ya | 1.0 |

**Basis Pengetahuan:**

| Gangguan | Gejala | MB | MD | CF_pakar |
|----------|--------|-----|-----|----------|
| Create Ulang ONT | Telepon tidak dapat digunakan | 0.7 | 0.1 | 0.6 |
| Create Ulang ONT | Internet tidak terhubung | 0.8 | 0.2 | 0.6 |
| Create Ulang ONT | Lampu PON merah | 0.9 | 0.1 | 0.8 |
| Revisi IKR | Internet tidak terhubung | 0.6 | 0.2 | 0.4 |
| Revisi IKR | Lampu PON merah | 0.7 | 0.2 | 0.5 |
| Ex Gamas FO Putus | Lampu PON merah | 0.8 | 0.2 | 0.6 |

**Perhitungan Detail:**

#### Gangguan 1: Create Ulang ONT

**Gejala 1 - Telepon tidak dapat digunakan:**
```
CF1 = (0.7 - 0.1) × 1.0 = 0.6
```

**Gejala 2 - Internet tidak terhubung:**
```
CF2 = (0.8 - 0.2) × 0.8 = 0.6 × 0.8 = 0.48
```

**Kombinasi CF1 dan CF2:**
```
CF_12 = CF1 + CF2 × (1 - CF1)
      = 0.6 + 0.48 × (1 - 0.6)
      = 0.6 + 0.48 × 0.4
      = 0.6 + 0.192
      = 0.792
```

**Gejala 3 - Lampu PON merah:**
```
CF3 = (0.9 - 0.1) × 1.0 = 0.8
```

**Kombinasi CF_12 dan CF3:**
```
CF_final = CF_12 + CF3 × (1 - CF_12)
         = 0.792 + 0.8 × (1 - 0.792)
         = 0.792 + 0.8 × 0.208
         = 0.792 + 0.1664
         = 0.9584
```

**Hasil Create Ulang ONT: 95.84%**

---

#### Gangguan 2: Revisi IKR

**Gejala 2 - Internet tidak terhubung:**
```
CF1 = (0.6 - 0.2) × 0.8 = 0.4 × 0.8 = 0.32
```

**Gejala 3 - Lampu PON merah:**
```
CF2 = (0.7 - 0.2) × 1.0 = 0.5
```

**Kombinasi:**
```
CF_final = CF1 + CF2 × (1 - CF1)
         = 0.32 + 0.5 × (1 - 0.32)
         = 0.32 + 0.5 × 0.68
         = 0.32 + 0.34
         = 0.66
```

**Hasil Revisi IKR: 66%**

---

#### Gangguan 3: Ex Gamas FO Putus

**Gejala 3 - Lampu PON merah:**
```
CF = (0.8 - 0.2) × 1.0 = 0.6
```

**Hasil Ex Gamas FO Putus: 60%**

---

### Rangkuman Hasil Diagnosis

| Ranking | Gangguan | CF | Persentase | Keterangan |
|---------|----------|-----|------------|------------|
| 1 | Create Ulang ONT | 0.9584 | 95.84% | **Diagnosis Utama** |
| 2 | Revisi IKR | 0.66 | 66% | Kemungkinan Kedua |
| 3 | Ex Gamas FO Putus | 0.60 | 60% | Kemungkinan Ketiga |

**Kesimpulan:**
Sistem merekomendasikan penanganan **"Create Ulang ONT"** dengan tingkat keyakinan **95.84%**

---

## Tabel Formula Kombinasi CF

### 1. Kedua CF Positif
| CF1 | CF2 | Formula | Hasil |
|-----|-----|---------|-------|
| 0.6 | 0.6 | CF1 + CF2×(1-CF1) | 0.84 |
| 0.7 | 0.5 | CF1 + CF2×(1-CF1) | 0.85 |
| 0.8 | 0.4 | CF1 + CF2×(1-CF1) | 0.88 |

### 2. Kedua CF Negatif
| CF1 | CF2 | Formula | Hasil |
|-----|-----|---------|-------|
| -0.4 | -0.5 | CF1 + CF2×(1+CF1) | -0.70 |
| -0.6 | -0.3 | CF1 + CF2×(1+CF1) | -0.72 |
| -0.5 | -0.5 | CF1 + CF2×(1+CF1) | -0.75 |

### 3. Salah Satu Negatif
| CF1 | CF2 | Formula | Hasil |
|-----|-----|---------|-------|
| 0.7 | -0.5 | (CF1+CF2)/(1-min(\|CF1\|,\|CF2\|)) | 0.40 |
| -0.4 | 0.8 | (CF1+CF2)/(1-min(\|CF1\|,\|CF2\|)) | 0.67 |
| 0.6 | -0.3 | (CF1+CF2)/(1-min(\|CF1\|,\|CF2\|)) | 0.43 |

---

## Tabel Bobot Kepastian User

| ID | Kondisi | Interpretasi | Bobot |
|----|---------|--------------|-------|
| 1 | Pasti ya | User sangat yakin gejala ada | 1.0 |
| 2 | Hampir pasti ya | User hampir yakin | 0.8 |
| 3 | Kemungkinan besar ya | User cukup yakin | 0.6 |
| 4 | Mungkin ya | User ragu tapi condong yakin | 0.4 |
| 5 | Tidak tahu | User tidak yakin | 0.0 |
| 6 | Mungkin tidak | User ragu tapi condong tidak | -0.2 |
| 7 | Kemungkinan besar tidak | User cukup yakin tidak ada | -0.4 |
| 8 | Hampir pasti tidak | User hampir yakin tidak ada | -0.6 |
| 9 | Pasti tidak | User sangat yakin tidak ada | -0.8 |

---

## Interpretasi Nilai CF

| Range CF | Interpretasi | Rekomendasi |
|----------|--------------|-------------|
| 0.8 - 1.0 | Keyakinan sangat tinggi | Diagnosis hampir pasti benar |
| 0.6 - 0.79 | Keyakinan tinggi | Diagnosis kemungkinan besar benar |
| 0.4 - 0.59 | Keyakinan sedang | Perlu verifikasi lebih lanjut |
| 0.2 - 0.39 | Keyakinan rendah | Pertimbangkan diagnosis alternatif |
| 0.0 - 0.19 | Keyakinan sangat rendah | Diagnosis kurang dapat dipercaya |
| < 0.0 | Keyakinan negatif | Gangguan kemungkinan bukan ini |

---

## Contoh Output Sistem

```
HASIL DIAGNOSIS
===============

Gejala yang dipilih:
1. Telepon tidak dapat digunakan (Pasti ya)
2. Internet tidak terhubung (Hampir pasti ya)
3. Lampu indikator PON pada ONU berwarna merah (Pasti ya)

Gangguan terdeteksi:
--------------------
1. Create Ulang ONT             : 95.84% ⭐⭐⭐⭐⭐
   Saran: Lakukan create ulang ONT melalui sistem provisioning

2. Revisi IKR                   : 66.00% ⭐⭐⭐⭐
   Saran: Periksa dan revisi IKR (Instalasi Kabel Rumah)

3. Ex Gamas FO Putus            : 60.00% ⭐⭐⭐
   Saran: Periksa fiber optik, kemungkinan kabel putus

Rekomendasi: Prioritaskan penanganan "Create Ulang ONT"
```

---

## Validasi Perhitungan Manual vs Sistem

Untuk memastikan akurasi, lakukan validasi dengan:

1. **Hitung manual** menggunakan tabel di atas
2. **Input ke sistem** dengan gejala dan kepastian yang sama
3. **Bandingkan hasil** - harus identik hingga 2 desimal
4. **Dokumentasi** untuk laporan skripsi

**Contoh Validasi:**
```
Input Test:
- Gejala: G01 (bobot 1.0), G02 (bobot 0.8), G03 (bobot 1.0)

Hasil Manual: 95.84%
Hasil Sistem: 0.9584 (95.84%)
Status: ✓ VALID
```
