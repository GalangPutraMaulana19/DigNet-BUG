# Changelog - DigNet 1.0

## Version 1.0.0 (2025) - IndiHome Adaptation

### Major Changes

This release adapts the system from a chicken disease diagnosis expert system to an IndiHome network troubleshooting expert system for PT Telkom Indonesia's retention period management.

### Updated Components

#### 1. Documentation
- **README.md**: Complete rewrite to reflect IndiHome thesis context
  - Added background about IndiHome triple play services (FTTH, STB, Telephone)
  - Explained the 60-day retention period problem at Witel Bekasi
  - Updated Certainty Factor examples with IndiHome scenarios
  - Added system features and benefits for provisioning technicians
  - Updated installation and configuration instructions

#### 2. System Branding
- Changed all page titles from "Dignets 1.0" to "DigNet 1.0"
- Updated body ID from "pakarayam" to "dignet-indihome"
- Consistent branding across all modules

#### 3. Terminology Changes

**Domain-Specific Terms:**
- "Repair" → "Gangguan" (Fault/Issue)
- "Incident" → "Gejala" (Symptom)
- "Ayam" (Chicken) → "IndiHome"

**User Interface Labels:**
- Menu items:
  - "Repair" → "Data Gangguan"
  - "Incident" → "Data Gejala"
  - "Pengetahuan" → "Basis Pengetahuan"

- Dashboard statistics:
  - "Total Incident" → "Total Gejala"
  - "Total Repair" → "Total Gangguan"
  - "Total Pengetahuan" → "Total Aturan"

- Form labels and table headers:
  - "Nama Repair" → "Nama Gangguan"
  - "Detail Repair" → "Detail Gangguan"
  - "Saran Repair" → "Saran Penanganan"
  - "Nama Incident" → "Nama Gejala"

#### 4. Updated Pages

**Public Pages:**
- `index.php`: Updated page title and body ID
- `modul/welcome.php`: Updated dashboard statistics and feature descriptions
- `modul/tentang.php`: Complete rewrite with thesis information
- `modul/bantuan.php`: Updated help content for IndiHome diagnosis
- `modul/diagnosa/diagnosa.php`: Updated diagnosis instructions
- `modul/formlogin.php`: Updated title and references
- `modul/harga.php`: Repurposed for IndiHome equipment pricing reference
- `modul/keterangan.php`: Updated title

**Admin Panel:**
- `modul/admin/admin.php`: Updated title
- `modul/repair/repair.php`: Updated to "Data Gangguan" with all labels
- `modul/incident/incident.php`: Updated to "Data Gejala" with all labels
- `modul/pengetahuan/pengetahuan.php`: Updated labels and dropdowns
- `modul/post/post.php`: Updated title
- `modul/password/password.php`: Updated title
- `modul/riwayat/riwayat.php`: Updated title
- `modul/riwayat/detail.php`: Updated title

#### 5. New Files
- `.gitignore`: Added to exclude temporary files, cache, and sensitive data

### Technical Details

**Compatible with:**
- PHP 7.4 - 8.3+
- MariaDB 10.4.14+ / MySQL 5.7+
- Modern browsers (Chrome, Firefox, Edge, Safari)

**Core Logic Preserved:**
- Certainty Factor (CF) calculation algorithm unchanged
- Forward chaining inference engine unchanged
- Database schema structure unchanged (only terminology adapted)
- Admin panel functionality fully maintained

### IndiHome Specific Context

**Components Diagnosed:**
- ODP (Optical Distribution Point)
- ONT (Optical Network Terminal)
- STB (Set-Top Box)
- Telephone

**Target Users:**
- Provisioning technicians at PT Mutiara Sentosa (Telkom Akses partner)
- Technical support during 60-day retention period
- Admin/expert users for knowledge base management

**Research Context:**
- Location: Witel Bekasi, West Java
- Period: 60-day retention post-installation
- Goal: Standardize diagnosis, reduce MTTR, minimize repeat visits

### Migration Notes

For existing users of the chicken disease diagnosis system:
1. Database name changed from "spkayam" to "dignet" in `config/koneksi.php`
2. All table structures remain the same
3. Sample data should be replaced with IndiHome-specific symptoms and faults
4. The CF calculation method and forward chaining logic are fully compatible

### Credits

**Original System:**
- Base system: Chicken Disease Expert System by [@januriawan](https://github.com/januriawan)
- PHP 7 update: [@triannoviandi](https://github.com/triannoviandi)

**IndiHome Adaptation:**
- Researcher: Galang Putra Maulana
- Domain Expert: PT Mutiara Sentosa (Telkom Akses partner)
- Year: 2025

### References

1. PT Telkom Indonesia - IndiHome FTTH Services
2. Telkom Akses - Service Level Agreement & Quality Standards
3. Totoharyanto (2011) - "Certainty Factor (CF)", IPB University

---

**Note**: This system is developed for academic research purposes regarding "Perancangan Sistem Pakar Diagnosis Gangguan IndiHome Berbasis Forward Chaining dan Certainty Factor pada Masa Retensi".
