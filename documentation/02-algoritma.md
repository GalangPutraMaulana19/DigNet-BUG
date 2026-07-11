# 02 - Algoritma

## Algoritma Diagnosis Gangguan Layanan IndiHome

Implementasi diagnosis berada di `modul/diagnosa/diagnosa.php` pada alur submit form diagnosa (`$_POST['submit']`).

Sistem:
1. membaca input gejala+nilai kondisi dari form,
2. memetakan ke bobot keyakinan user,
3. mengambil aturan di `basis_pengetahuan`,
4. menghitung CF setiap kandidat gangguan (`repair`),
5. mengurutkan hasil, menyimpan ke tabel `hasil`, lalu menampilkan ranking.

## Forward Chaining

Implementasi bersifat data-driven:
- Fakta awal: gejala yang dipilih user (`$arincident`).
- Aturan: tabel `basis_pengetahuan` (relasi `kode_incident` -> `kode_repair` dengan `mb`, `md`).
- Mesin inferensi: loop semua `repair`, lalu evaluasi aturan yang gejalanya cocok.

## Certainty Factor

### Rumus CF per aturan

```text
CF = (MB - MD) * bobot_user
```

Diimplementasikan pada:
- `modul/diagnosa/diagnosa.php` (baris logika hitung CF pada loop rule).

### Tabel bobot kondisi user (array kode)

`$arbobot = ['0','1','0.8','0.6','0.4','-0.2','-0.4','-0.6','-0.8','-1'];`

Artinya:
- nilai kondisi 1 -> bobot 1
- 2 -> 0.8
- ...
- 9 -> -1

### Rumus kombinasi CF (multi gejala)

1. Jika CF baru dan CF lama sama-sama tidak konflik tanda (positif/non-konflik):

```text
CF_lama = CF_lama + (CF * (1 - CF_lama))
```

2. Jika konflik tanda:

```text
CF_lama = (CF_lama + CF) / (1 - min(abs(CF_lama), abs(CF)))
```

3. Jika CF negatif dan non-konflik:

```text
CF_lama = CF_lama + (CF * (1 + CF_lama))
```

Hanya hasil dengan `CF_lama > 0` yang dimasukkan ke daftar hasil.

## Flow Algoritma (Mermaid)

```mermaid
flowchart TD
    A[User submit form gejala] --> B[Parse input kondisi kode_incident_nilai]
    B --> C[Bangun array gejala terpilih]
    C --> D[Load kondisi dan master repair]
    D --> E[Loop semua repair]
    E --> F[Ambil basis_pengetahuan per repair]
    F --> G[Loop rule]
    G --> H{Gejala rule dipilih user?}
    H -->|Tidak| G
    H -->|Ya| I[Hitung CF = (MB-MD)*bobot_user]
    I --> J[Kombinasi CF ke cflama]
    J --> G
    G --> K{Rule habis?}
    K -->|Ya| L{cflama > 0?}
    L -->|Ya| M[Simpan repair:CF]
    L -->|Tidak| E
    M --> E
    E --> N[Urutkan CF desc arsort]
    N --> O[Serialize incident & repair]
    O --> P[Insert ke tabel hasil]
    P --> Q[Tampilkan diagnosis utama + kemungkinan lain]
```

## Contoh Proses Perhitungan Berdasarkan Source Code

Misal user memilih satu gejala dengan bobot kondisi `1`:
- rule memiliki `MB=0.8`, `MD=0.2`
- maka:

```text
CF = (0.8 - 0.2) * 1 = 0.6
```

Jika rule kedua untuk gangguan sama menghasilkan `CF=0.5`, maka kombinasi non-konflik:

```text
CF_baru = 0.6 + (0.5 * (1 - 0.6))
        = 0.6 + 0.2
        = 0.8
```

Perhitungan contoh di atas mengikuti formula kombinasi yang dipakai langsung pada loop diagnosis.

## Catatan Ketersediaan Informasi

- Tidak ada file terpisah bernama `DiagnosisEngine` atau service class; algoritma ditulis inline di `modul/diagnosa/diagnosa.php`.
- Tidak ada implementasi backward chaining pada source code.

## Referensi Source Code

- `modul/diagnosa/diagnosa.php`
- `dignet_indihome.sql` (tabel `basis_pengetahuan`, `kondisi`, `hasil`, `repair`, `incident`)
