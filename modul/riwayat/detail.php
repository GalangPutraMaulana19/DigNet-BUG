<title>Detail Riwayat - DigNet 1.0</title>
<?php

if (isset($_GET['id'])) {
  $arcolor = ['#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700'];
  date_default_timezone_set("Asia/Jakarta");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = ['0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1'];
  $arincident = [];

  if (isset($_POST['kondisi']) && is_array($_POST['kondisi'])) {
    foreach ($_POST['kondisi'] as $kondisi) {
      $arkondisi = explode("_", $kondisi);
      if (strlen($kondisi) > 1) {
        $arincident[$arkondisi[0]] = $arkondisi[1];
      }
    }
  }

  $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi ORDER BY id+0");
  while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
    $arkondisitext[$rkondisi['id']] = $rkondisi['kondisi'];
  }

  $sqlpkt = mysqli_query($conn, "SELECT * FROM repair ORDER BY kode_repair+0");
  while ($rpkt = mysqli_fetch_array($sqlpkt)) {
    $arpkt[$rpkt['kode_repair']] = $rpkt['nama_repair'];
    $ardpkt[$rpkt['kode_repair']] = $rpkt['det_repair'];
    $arspkt[$rpkt['kode_repair']] = $rpkt['srn_repair'];
    $argpkt[$rpkt['kode_repair']] = $rpkt['gambar'];
  }

  $id = intval($_GET['id']);
  $stmt = mysqli_prepare($conn, "SELECT * FROM hasil WHERE id_hasil = ?");
  mysqli_stmt_bind_param($stmt, "i", $id);
  mysqli_stmt_execute($stmt);
  $sqlhasil = mysqli_stmt_get_result($stmt);
  while ($rhasil = mysqli_fetch_array($sqlhasil)) {
    $arrepair = unserialize($rhasil['repair']);
    $arincident = unserialize($rhasil['incident']);
    $tanggal_diagnosa = $rhasil['tanggal'] ?? date('Y-m-d H:i:s');
  }

  $np1 = 0;
  if (isset($arrepair) && is_array($arrepair)) {
    foreach ($arrepair as $key1 => $value1) {
      $np1++;
      $idpkt1[$np1] = $key1;
      $vlpkt1[$np1] = $value1;
    }
  }

  $np = 0;
  if (isset($arrepair) && is_array($arrepair)) {
    foreach ($arrepair as $key => $value) {
      $np++;
      $idpkt[$np] = $key;
      $nmpkt[$np] = $arpkt[$key] ?? 'Unknown';
      $vlpkt[$np] = $value;
    }
  }
  
  if (isset($idpkt[1]) && isset($argpkt[$idpkt[1]]) && $argpkt[$idpkt[1]]) {
    $gambar = 'gambar/repair/' . $argpkt[$idpkt[1]];
  } else {
    $gambar = 'gambar/noimage.png';
  }

// --------------------- MODERN SAAS PREMIUM STYLING -------------------------
?>
<style>
.detail-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
}

.detail-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px 16px 0 0;
    padding: 2rem;
    color: white;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.detail-header h2 {
    margin: 0;
    font-size: 1.75rem;
    font-weight: 700;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.detail-header .subtitle {
    opacity: 0.9;
    font-size: 0.95rem;
    margin-top: 0.5rem;
}

.btn-print {
    background: rgba(255,255,255,0.2);
    border: 2px solid rgba(255,255,255,0.5);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.btn-print:hover {
    background: rgba(255,255,255,0.3);
    border-color: white;
    transform: translateY(-2px);
    color: white;
}

.detail-body {
    background: white;
    border-radius: 0 0 16px 16px;
    box-shadow: 0 10px 40px rgba(0,0,0,0.1);
    padding: 2rem;
}

/* Main Result Card */
.result-main-card {
    background: linear-gradient(135deg, #f8f9ff 0%, #e8f4f8 100%);
    border-radius: 16px;
    padding: 2rem;
    margin-bottom: 2rem;
    display: flex;
    gap: 2rem;
    align-items: flex-start;
    flex-wrap: wrap;
}

.result-image {
    flex-shrink: 0;
    width: 220px;
    height: 180px;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0,0,0,0.15);
}

.result-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.result-info {
    flex: 1;
    min-width: 280px;
}

.result-label {
    font-size: 0.85rem;
    color: #6c757d;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 0.5rem;
}

.result-title {
    font-size: 1.75rem;
    font-weight: 700;
    color: #28a745;
    margin-bottom: 1rem;
    line-height: 1.3;
}

.result-percentage {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    box-shadow: 0 4px 15px rgba(40,167,69,0.3);
}

/* Info Cards */
.info-card {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    margin-bottom: 1.5rem;
    overflow: hidden;
    border: 1px solid #e9ecef;
}

.info-card-header {
    padding: 1.25rem 1.5rem;
    font-weight: 700;
    font-size: 1.1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
}

.info-card-header.detail-header-blue {
    background: linear-gradient(135deg, #0d6efd 0%, #6610f2 100%);
    color: white;
}

.info-card-header.saran-header-amber {
    background: linear-gradient(135deg, #fd7e14 0%, #ffc107 100%);
    color: white;
}

.info-card-header.kemungkinan-header-red {
    background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%);
    color: white;
}

.info-card-body {
    padding: 1.5rem;
    line-height: 1.7;
    color: #495057;
}

/* Gejala Table */
.gejala-section {
    margin-bottom: 2rem;
}

.gejala-section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #495057;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.gejala-table-container {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: 1px solid #e9ecef;
}

.gejala-table {
    width: 100%;
    border-collapse: collapse;
}

.gejala-table thead th {
    background: linear-gradient(135deg, #495057 0%, #343a40 100%);
    color: white;
    padding: 1rem;
    font-weight: 600;
    text-align: left;
    font-size: 0.9rem;
}

.gejala-table tbody tr {
    transition: background 0.2s ease;
}

.gejala-table tbody tr:hover {
    background: #f8f9fa;
}

.gejala-table tbody td {
    padding: 1rem;
    border-bottom: 1px solid #e9ecef;
    vertical-align: middle;
}

.gejala-table tbody tr:last-child td {
    border-bottom: none;
}

.kode-badge {
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 0.35rem 0.75rem;
    border-radius: 6px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
}

.kondisi-badge {
    padding: 0.4rem 0.85rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-block;
    background: #f8f9fa;
    border: 2px solid currentColor;
}

/* Kemungkinan Lain Items */
.kemungkinan-item {
    display: flex;
    align-items: center;
    gap: 1rem;
    padding: 1rem 0;
    border-bottom: 1px solid #e9ecef;
}

.kemungkinan-item:last-child {
    border-bottom: none;
}

.kemungkinan-icon {
    width: 40px;
    height: 40px;
    background: linear-gradient(135deg, #dc3545 0%, #e91e63 100%);
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    flex-shrink: 0;
}

.kemungkinan-name {
    flex: 1;
    font-weight: 600;
    color: #495057;
}

.kemungkinan-percentage {
    background: #f8f9fa;
    padding: 0.4rem 0.85rem;
    border-radius: 20px;
    font-weight: 600;
    font-size: 0.85rem;
    color: #dc3545;
}

/* Back Button */
.back-btn {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 12px;
    font-weight: 600;
    text-decoration: none;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.back-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    color: white;
}

/* Responsive */
@media (max-width: 768px) {
    .detail-container {
        padding: 1rem;
    }
    
    .detail-header {
        padding: 1.5rem;
        flex-direction: column;
        text-align: center;
    }
    
    .detail-header h2 {
        font-size: 1.4rem;
    }
    
    .result-main-card {
        flex-direction: column;
        padding: 1.5rem;
    }
    
    .result-image {
        width: 100%;
        height: 200px;
    }
    
    .result-title {
        font-size: 1.4rem;
    }
    
    .gejala-table thead th,
    .gejala-table tbody td {
        padding: 0.75rem;
        font-size: 0.85rem;
    }
    
    .info-card-body {
        padding: 1rem;
    }
}

@media print {
    .btn-print, .back-btn {
        display: none !important;
    }
    
    .detail-header {
        background: #667eea !important;
        -webkit-print-color-adjust: exact;
        print-color-adjust: exact;
    }
}
</style>

<div class="detail-container">
    <div class="detail-header">
        <div>
            <h2><i class="fa-solid fa-clipboard-check"></i> Detail Hasil Diagnosa</h2>
            <p class="subtitle">ID Riwayat: #<?php echo htmlspecialchars($id); ?> | <?php echo isset($tanggal_diagnosa) ? date('d M Y, H:i', strtotime($tanggal_diagnosa)) : '-'; ?></p>
        </div>
        <button id="print" onClick="window.print();" class="btn btn-print" data-bs-toggle="tooltip" data-bs-placement="left" title="Cetak hasil diagnosa">
            <i class="fa-solid fa-print"></i> Cetak
        </button>
    </div>
    
    <div class="detail-body">
        <!-- Main Result Card -->
        <div class="result-main-card">
            <div class="result-image">
                <img src="<?php echo htmlspecialchars($gambar); ?>" alt="Gambar Gangguan">
            </div>
            <div class="result-info">
                <p class="result-label">Hasil Diagnosa Utama</p>
                <h3 class="result-title"><?php echo htmlspecialchars($nmpkt[1] ?? 'Tidak ditemukan'); ?></h3>
                <span class="result-percentage">
                    <i class="fa-solid fa-chart-pie"></i>
                    <?php echo isset($vlpkt[1]) ? round($vlpkt[1], 2) : 0; ?>% Kepercayaan
                </span>
            </div>
        </div>
        
        <!-- Gejala Table -->
        <div class="gejala-section">
            <h4 class="gejala-section-title">
                <i class="fa-solid fa-list-check text-primary"></i>
                Gejala yang Dialami
            </h4>
            <div class="gejala-table-container">
                <table class="gejala-table">
                    <thead>
                        <tr>
                            <th style="width: 60px;">No</th>
                            <th style="width: 100px;">Kode</th>
                            <th>Gejala / Keluhan</th>
                            <th style="width: 150px;">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (isset($arincident) && is_array($arincident)) {
                            $ig = 0;
                            foreach ($arincident as $key => $value) {
                                $kondisi = $value;
                                $ig++;
                                $sql4 = mysqli_query($conn, "SELECT * FROM incident WHERE kode_incident = '" . mysqli_real_escape_string($conn, $key) . "'");
                                $r4 = mysqli_fetch_array($sql4);
                                if ($r4) {
                                    echo '<tr>';
                                    echo '<td><strong>' . $ig . '</strong></td>';
                                    echo '<td><span class="kode-badge">G' . str_pad($r4['kode_incident'], 3, '0', STR_PAD_LEFT) . '</span></td>';
                                    echo '<td>' . htmlspecialchars($r4['nama_incident']) . '</td>';
                                    echo '<td><span class="kondisi-badge" style="color:' . $arcolor[$kondisi] . '">' . htmlspecialchars($arkondisitext[$kondisi] ?? '') . '</span></td>';
                                    echo '</tr>';
                                }
                            }
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Detail Card -->
        <div class="info-card">
            <div class="info-card-header detail-header-blue">
                <i class="fa-solid fa-circle-info"></i>
                Detail Gangguan
            </div>
            <div class="info-card-body">
                <?php echo isset($idpkt[1]) && isset($ardpkt[$idpkt[1]]) ? nl2br(htmlspecialchars($ardpkt[$idpkt[1]])) : 'Tidak ada detail tersedia.'; ?>
            </div>
        </div>
        
        <!-- Saran Card -->
        <div class="info-card">
            <div class="info-card-header saran-header-amber">
                <i class="fa-solid fa-lightbulb"></i>
                Saran Penanganan
            </div>
            <div class="info-card-body">
                <?php echo isset($idpkt[1]) && isset($arspkt[$idpkt[1]]) ? nl2br(htmlspecialchars($arspkt[$idpkt[1]])) : 'Tidak ada saran tersedia.'; ?>
            </div>
        </div>
        
        <!-- Kemungkinan Lain Card -->
        <?php if (isset($idpkt) && count($idpkt) > 1): ?>
        <div class="info-card">
            <div class="info-card-header kemungkinan-header-red">
                <i class="fa-solid fa-triangle-exclamation"></i>
                Kemungkinan Lain
            </div>
            <div class="info-card-body">
                <?php for ($ipl = 2; $ipl <= count($idpkt); $ipl++): ?>
                    <?php if (isset($nmpkt[$ipl]) && isset($vlpkt[$ipl])): ?>
                    <div class="kemungkinan-item">
                        <div class="kemungkinan-icon">
                            <i class="fa-solid fa-caret-right"></i>
                        </div>
                        <span class="kemungkinan-name"><?php echo htmlspecialchars($nmpkt[$ipl]); ?></span>
                        <span class="kemungkinan-percentage"><?php echo round($vlpkt[$ipl], 2); ?>%</span>
                    </div>
                    <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
        <?php endif; ?>
        
        <a href="?module=riwayat" class="back-btn">
            <i class="fa-solid fa-arrow-left"></i>
            Kembali ke Riwayat
        </a>
    </div>
</div>
<?php
}
?>