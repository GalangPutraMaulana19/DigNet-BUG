# UML Diagram - Sistem Pakar Diagnosis Gangguan IndiHome

## 1. Use Case Diagram

```mermaid
graph TB
    subgraph "Sistem Pakar Diagnosis IndiHome"
        UC1[Login]
        UC2[Kelola Data Gangguan]
        UC3[Kelola Data Gejala]
        UC4[Kelola Basis Pengetahuan]
        UC5[Kelola Post/Artikel]
        UC6[Diagnosis Gangguan]
        UC7[Lihat Riwayat Diagnosis]
        UC8[Ubah Password]
        UC9[Logout]
    end
    
    Admin[Admin/Pakar]
    User[Teknisi Provisioning]
    
    Admin --> UC1
    Admin --> UC2
    Admin --> UC3
    Admin --> UC4
    Admin --> UC5
    Admin --> UC8
    Admin --> UC9
    
    User --> UC6
    User --> UC7
    
    UC6 -.->|include| DB[(Database)]
    UC2 -.->|include| DB
    UC3 -.->|include| DB
    UC4 -.->|include| DB
    
    style Admin fill:#FFE4B5
    style User fill:#98FB98
    style DB fill:#87CEEB
```

## 2. Activity Diagram - Proses Diagnosis

```mermaid
flowchart TD
    Start([User Mengakses Sistem]) --> MenuDiagnosis[Pilih Menu Diagnosis]
    MenuDiagnosis --> TampilGejala[Sistem menampilkan<br/>daftar gejala]
    
    TampilGejala --> PilihGejala[User memilih gejala<br/>dan tingkat kepastian]
    PilihGejala --> TambahGejala{Ada gejala<br/>lain?}
    
    TambahGejala -->|Ya| PilihGejala
    TambahGejala -->|Tidak| KlikProses[User klik tombol Proses]
    
    KlikProses --> Validate{Validasi:<br/>Min 1 gejala?}
    Validate -->|Tidak| Error[Tampilkan pesan error]
    Error --> PilihGejala
    
    Validate -->|Ya| AmbilAturan[Sistem mengambil aturan<br/>dari basis pengetahuan]
    AmbilAturan --> HitungCF[Hitung CF setiap gangguan<br/>Forward Chaining]
    
    HitungCF --> KombinaCF[Kombinasi CF<br/>untuk gejala majemuk]
    KombinaCF --> UrutCF[Urutkan hasil<br/>berdasarkan CF]
    
    UrutCF --> SimpanHasil[Simpan hasil ke<br/>tabel HASIL]
    SimpanHasil --> TampilHasil[Tampilkan hasil diagnosis:<br/>- Gangguan terdeteksi<br/>- Nilai CF<br/>- Gejala terpilih<br/>- Saran penanganan]
    
    TampilHasil --> Cetak{User ingin<br/>cetak?}
    Cetak -->|Ya| PrintHasil[Print hasil diagnosis]
    Cetak -->|Tidak| End([Selesai])
    PrintHasil --> End
    
    style Start fill:#90EE90
    style End fill:#FFB6C1
    style HitungCF fill:#FFE4B5
    style TampilHasil fill:#98FB98
```

## 3. Activity Diagram - Kelola Basis Pengetahuan

```mermaid
flowchart TD
    Start([Admin Login]) --> Dashboard[Akses Dashboard Admin]
    Dashboard --> MenuBP[Pilih Menu<br/>Basis Pengetahuan]
    
    MenuBP --> TampilList[Tampilkan daftar<br/>aturan pengetahuan]
    TampilList --> Aksi{Pilih Aksi}
    
    Aksi -->|Tambah| FormTambah[Tampilkan form tambah:<br/>- Pilih Gangguan<br/>- Pilih Gejala<br/>- Input MB<br/>- Input MD]
    Aksi -->|Edit| FormEdit[Tampilkan form edit<br/>dengan data existing]
    Aksi -->|Hapus| Konfirmasi{Konfirmasi<br/>hapus?}
    
    FormTambah --> ValidateAdd{Validasi Input}
    ValidateAdd -->|Tidak Valid| ErrorAdd[Tampilkan error]
    ErrorAdd --> FormTambah
    ValidateAdd -->|Valid| SaveAdd[Simpan aturan baru<br/>ke database]
    
    FormEdit --> ValidateEdit{Validasi Input}
    ValidateEdit -->|Tidak Valid| ErrorEdit[Tampilkan error]
    ErrorEdit --> FormEdit
    ValidateEdit -->|Valid| UpdateDB[Update data<br/>di database]
    
    Konfirmasi -->|Ya| DeleteDB[Hapus data<br/>dari database]
    Konfirmasi -->|Tidak| TampilList
    
    SaveAdd --> Success[Tampilkan pesan sukses]
    UpdateDB --> Success
    DeleteDB --> Success
    
    Success --> TampilList
    
    TampilList --> Done{Selesai?}
    Done -->|Tidak| Aksi
    Done -->|Ya| End([Logout])
    
    style Start fill:#90EE90
    style End fill:#FFB6C1
    style Success fill:#98FB98
```

## 4. Sequence Diagram - Proses Diagnosis

```mermaid
sequenceDiagram
    actor User as Teknisi
    participant UI as Interface Web
    participant Controller as diagnosa.php
    participant Model as Database
    participant Engine as CF Engine
    
    User->>UI: Akses halaman diagnosis
    UI->>Controller: Request daftar gejala
    Controller->>Model: SELECT * FROM incident
    Model-->>Controller: Return data gejala
    Controller-->>UI: Tampilkan form gejala
    UI-->>User: Tampilkan daftar gejala
    
    User->>UI: Pilih gejala + tingkat kepastian
    User->>UI: Klik tombol Proses
    
    UI->>Controller: POST data gejala
    Controller->>Controller: Validasi input
    
    loop Untuk setiap gangguan
        Controller->>Model: SELECT aturan WHERE kode_repair=X
        Model-->>Controller: Return aturan
        
        loop Untuk setiap aturan
            Controller->>Engine: Hitung CF(MB, MD, bobot)
            Engine-->>Controller: Return CF
            Controller->>Engine: Kombinasi CF
            Engine-->>Controller: Return CF_total
        end
    end
    
    Controller->>Controller: Urutkan hasil (DESC)
    Controller->>Model: INSERT INTO hasil
    Model-->>Controller: Success
    
    Controller-->>UI: Return hasil diagnosis
    UI-->>User: Tampilkan:<br/>- Gangguan (CF%)<br/>- Gejala terpilih<br/>- Saran
```

## 5. Class Diagram

```mermaid
classDiagram
    class Admin {
        +String username
        +String password
        +String nama_lengkap
        +login()
        +logout()
        +ubahPassword()
    }
    
    class Repair {
        +int kode_repair
        +String nama_repair
        +String det_repair
        +String srn_repair
        +String gambar
        +tambah()
        +edit()
        +hapus()
        +getAll()
    }
    
    class Incident {
        +int kode_incident
        +String nama_incident
        +tambah()
        +edit()
        +hapus()
        +getAll()
    }
    
    class BasisPengetahuan {
        +int kode_pengetahuan
        +int kode_repair
        +int kode_incident
        +double mb
        +double md
        +tambah()
        +edit()
        +hapus()
        +getByRepair()
    }
    
    class Kondisi {
        +int id
        +String kondisi
        +String ket
        +getAll()
        +getBobot()
    }
    
    class Hasil {
        +int id_hasil
        +String tanggal
        +String repair
        +String incident
        +int hasil_id
        +String hasil_nilai
        +simpan()
        +getRiwayat()
        +getDetail()
    }
    
    class DiagnosisEngine {
        +hitungCF(mb, md, bobot)
        +kombinasiCF(cf1, cf2)
        +forwardChaining(gejala[])
        +urutkanHasil(hasil[])
    }
    
    Admin "1" --> "*" Repair : kelola
    Admin "1" --> "*" Incident : kelola
    Admin "1" --> "*" BasisPengetahuan : kelola
    
    Repair "1" --> "*" BasisPengetahuan : memiliki
    Incident "1" --> "*" BasisPengetahuan : memiliki
    
    BasisPengetahuan "*" --> "1" DiagnosisEngine : diproses
    Kondisi "1" --> "*" DiagnosisEngine : memberikan bobot
    
    DiagnosisEngine "1" --> "*" Hasil : menghasilkan
    Repair "1" --> "*" Hasil : tercatat
```

## 6. Component Diagram

```mermaid
graph TB
    subgraph "Presentation Layer"
        UI[User Interface<br/>HTML/CSS/JS]
        Menu[Menu Navigation]
        Form[Forms]
    end
    
    subgraph "Business Logic Layer"
        Auth[Authentication Module]
        DiagModule[Diagnosis Module]
        AdminModule[Admin Module]
        CFEngine[CF Calculation Engine]
        FCEngine[Forward Chaining Engine]
    end
    
    subgraph "Data Access Layer"
        RepairDAO[Repair DAO]
        IncidentDAO[Incident DAO]
        BPDAO[Basis Pengetahuan DAO]
        HasilDAO[Hasil DAO]
    end
    
    subgraph "Database"
        MySQL[(MySQL/MariaDB<br/>Database)]
    end
    
    UI --> Menu
    UI --> Form
    Menu --> Auth
    Menu --> DiagModule
    Menu --> AdminModule
    
    DiagModule --> CFEngine
    DiagModule --> FCEngine
    DiagModule --> IncidentDAO
    DiagModule --> HasilDAO
    
    FCEngine --> BPDAO
    FCEngine --> RepairDAO
    
    AdminModule --> RepairDAO
    AdminModule --> IncidentDAO
    AdminModule --> BPDAO
    
    RepairDAO --> MySQL
    IncidentDAO --> MySQL
    BPDAO --> MySQL
    HasilDAO --> MySQL
    Auth --> MySQL
    
    style UI fill:#FFE4B5
    style CFEngine fill:#98FB98
    style FCEngine fill:#98FB98
    style MySQL fill:#87CEEB
```

## Penjelasan Diagram

### Use Case Diagram
Menggambarkan interaksi antara aktor (Admin dan Teknisi) dengan sistem.

**Admin:**
- Mengelola master data (gangguan, gejala, basis pengetahuan)
- Membuat dan mengubah aturan diagnosis
- Manajemen akun

**Teknisi Provisioning:**
- Melakukan diagnosis gangguan
- Melihat riwayat diagnosis
- Mendapatkan saran penanganan

### Activity Diagram
Menggambarkan alur aktivitas dalam sistem:
1. **Proses Diagnosis**: Alur dari pemilihan gejala hingga hasil diagnosis
2. **Kelola Basis Pengetahuan**: Alur CRUD aturan oleh admin

### Sequence Diagram
Menggambarkan interaksi antar objek dalam urutan waktu untuk proses diagnosis.

### Class Diagram
Menggambarkan struktur kelas dan relasi antar kelas dalam sistem.

### Component Diagram
Menggambarkan arsitektur sistem dengan pembagian layer:
- **Presentation**: Antarmuka pengguna
- **Business Logic**: Logika bisnis dan inferensi
- **Data Access**: Akses database
- **Database**: Penyimpanan data
