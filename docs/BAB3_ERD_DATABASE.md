# ERD Database - Sistem Pakar Diagnosis Gangguan IndiHome

## Entity Relationship Diagram

```mermaid
erDiagram
    ADMIN ||--o{ HASIL : "mengelola"
    REPAIR ||--o{ BASIS_PENGETAHUAN : "memiliki"
    INCIDENT ||--o{ BASIS_PENGETAHUAN : "memiliki"
    BASIS_PENGETAHUAN ||--o{ HASIL : "menghasilkan"
    REPAIR ||--o{ POST : "dijelaskan"
    
    ADMIN {
        varchar username PK
        varchar password
        varchar nama_lengkap
    }
    
    REPAIR {
        int kode_repair PK
        varchar nama_repair
        varchar det_repair
        varchar srn_repair
        varchar gambar
    }
    
    INCIDENT {
        int kode_incident PK
        varchar nama_incident
    }
    
    BASIS_PENGETAHUAN {
        int kode_pengetahuan PK
        int kode_repair FK
        int kode_incident FK
        double mb "Measure of Belief"
        double md "Measure of Disbelief"
    }
    
    KONDISI {
        int id PK
        varchar kondisi
        varchar ket
    }
    
    HASIL {
        int id_hasil PK
        varchar tanggal
        text repair "serialized"
        text incident "serialized"
        int hasil_id
        varchar hasil_nilai
    }
    
    POST {
        int kode_post PK
        varchar nama_post
        varchar det_post
        varchar srn_post
        varchar gambar
    }
```

## Penjelasan Entitas

### 1. ADMIN
Menyimpan data administrator/pakar sistem.

**Atribut:**
- `username` (PK): Username login
- `password`: Password MD5
- `nama_lengkap`: Nama lengkap

### 2. REPAIR (Gangguan)
Jenis gangguan IndiHome.

**Contoh:** Create Ulang ONT, Restart ONT, Ganti STB

### 3. INCIDENT (Gejala)  
Gejala yang dialami pengguna.

**Contoh:** Telepon tidak dapat digunakan, Internet tidak terhubung, Lampu PON merah

### 4. BASIS_PENGETAHUAN
Aturan IF-THEN dengan Certainty Factor.

**Format:** IF gejala THEN gangguan {MB: x, MD: y}

### 5. KONDISI
Tingkat kepastian (Pasti ya s/d Pasti tidak)

### 6. HASIL
Riwayat diagnosis pengguna

### 7. POST
Artikel penjelasan gangguan
