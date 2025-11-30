<title>Diagnosa - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="mb-4">
    <h2 class="text text-primary">
        <i class="fa-solid fa-stethoscope me-3"></i>
        Diagnosis Gangguan IndiHome
    </h2>
    <p class="text-muted" style="font-size: 1.1rem; margin-top: 1rem;">
        Sistem pakar untuk mendiagnosis gangguan perangkat IndiHome dengan metode Forward Chaining dan Certainty Factor
    </p>
</div>

<style>
/* Premium SaaS Form Styling */
.diagnosa-form-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.diagnosa-form-header {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    padding: 1.5rem;
}

.diagnosa-form-body {
    padding: 1.5rem;
}

.gejala-card {
    background: #fafafa;
    border: 1px solid #e5e5e5;
    border-radius: 12px;
    padding: 1rem;
    margin-bottom: 0.75rem;
    transition: all 0.2s ease;
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 1rem;
}

.gejala-card:hover {
    border-color: #E21E2C;
    box-shadow: 0 2px 8px rgba(226, 30, 44, 0.1);
    transform: translateY(-1px);
}

.gejala-number {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 700;
    font-size: 0.875rem;
    flex-shrink: 0;
}

.gejala-code {
    background: #f0f0f0;
    color: #525252;
    padding: 0.25rem 0.75rem;
    border-radius: 20px;
    font-size: 0.75rem;
    font-weight: 600;
    flex-shrink: 0;
}

.gejala-text {
    flex: 1;
    min-width: 200px;
    font-weight: 500;
    color: #262626;
    line-height: 1.4;
}

.gejala-select-wrapper {
    flex: 0 0 auto;
    min-width: 180px;
}

.premium-select {
    width: 100%;
    padding: 0.625rem 1rem;
    border: 2px solid #e5e5e5;
    border-radius: 8px;
    font-size: 0.875rem;
    font-weight: 500;
    transition: all 0.2s ease;
    cursor: pointer;
    background-color: white;
    appearance: none;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 24 24' stroke='%23737373'%3E%3Cpath stroke-linecap='round' stroke-linejoin='round' stroke-width='2' d='M19 9l-7 7-7-7'%3E%3C/path%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 0.75rem center;
    background-size: 1rem;
    padding-right: 2.5rem;
}

.premium-select:focus {
    outline: none;
    border-color: #E21E2C;
    box-shadow: 0 0 0 3px rgba(226, 30, 44, 0.1);
}

.premium-select:hover {
    border-color: #a3a3a3;
}

.submit-section {
    padding: 1.5rem;
    background: #f5f5f5;
    border-top: 1px solid #e5e5e5;
    display: flex;
    justify-content: center;
}

.btn-diagnosa-submit {
    background: linear-gradient(135deg, #E21E2C 0%, #B71C1C 100%);
    color: white;
    border: none;
    padding: 1rem 3rem;
    font-size: 1.125rem;
    font-weight: 600;
    border-radius: 12px;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(226, 30, 44, 0.3);
    cursor: pointer;
}

.btn-diagnosa-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(226, 30, 44, 0.4);
}

.btn-diagnosa-submit:active {
    transform: translateY(0);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .gejala-card {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.75rem;
    }
    
    .gejala-header {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        width: 100%;
    }
    
    .gejala-text {
        min-width: auto;
        width: 100%;
    }
    
    .gejala-select-wrapper {
        width: 100%;
    }
    
    .premium-select {
        width: 100%;
    }
    
    .btn-diagnosa-submit {
        width: 100%;
        justify-content: center;
        padding: 1rem 1.5rem;
    }
    
    .diagnosa-form-body {
        padding: 1rem;
    }
}

/* Premium Results Styling */
.hasil-container {
    background: white;
    border-radius: 16px;
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -2px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 1.5rem;
    width: 100%;
    max-width: 100%;
}

.hasil-header {
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    padding: 1.5rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 1rem;
}

.hasil-header h2 {
    margin: 0;
    font-size: 1.5rem;
    font-weight: 700;
    word-break: break-word;
}

.hasil-body {
    padding: 1.5rem;
    overflow-x: hidden;
    word-wrap: break-word;
}

.hasil-main-card {
    background: linear-gradient(135deg, rgba(16, 185, 129, 0.1) 0%, rgba(5, 150, 105, 0.1) 100%);
    border: 2px solid #10B981;
    border-radius: 12px;
    padding: 1.5rem;
    margin-bottom: 1.5rem;
    overflow: hidden;
}

.hasil-gangguan {
    font-size: 1.75rem;
    font-weight: 800;
    color: #059669;
    margin-bottom: 0.5rem;
    word-break: break-word;
    line-height: 1.3;
}

.hasil-persentase {
    font-size: 1.25rem;
    color: #065F46;
    font-weight: 600;
    word-break: break-word;
}

.gejala-hasil-item {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding: 0.75rem 1rem;
    background: #fafafa;
    border-radius: 8px;
    margin-bottom: 0.5rem;
    border: 1px solid #e5e5e5;
    transition: all 0.2s ease;
}

.gejala-hasil-item:hover {
    background: #f0f0f0;
    border-color: #d4d4d4;
}

/* Premium card styling for results */
.hasil-body .card {
    border: none;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.hasil-body .card-body {
    padding: 1.25rem;
}

.hasil-body .card-body p {
    word-wrap: break-word;
    overflow-wrap: break-word;
    hyphens: auto;
    line-height: 1.7;
    color: #374151;
    font-size: 0.95rem;
}

.hasil-body .card-title {
    font-weight: 600;
    font-size: 1rem;
    margin-bottom: 0.75rem;
}

/* List group items in results */
.hasil-body .list-group-item {
    border: none;
    border-radius: 8px !important;
    margin-bottom: 0.5rem;
    background: #fafafa;
    transition: all 0.2s ease;
}

.hasil-body .list-group-item:hover {
    background: #f0f0f0;
}

/* Mobile responsive for results */
@media (max-width: 768px) {
    .hasil-container {
        border-radius: 12px;
        margin-left: -0.5rem;
        margin-right: -0.5rem;
        width: calc(100% + 1rem);
        max-width: calc(100% + 1rem);
    }
    
    .hasil-header {
        flex-direction: column;
        text-align: center;
        padding: 1.25rem 1rem;
    }
    
    .hasil-header h2 {
        font-size: 1.25rem;
    }
    
    .hasil-body {
        padding: 1rem;
    }
    
    .hasil-main-card {
        padding: 1rem;
        border-radius: 10px;
    }
    
    .hasil-gangguan {
        font-size: 1.15rem;
        text-align: center;
    }
    
    .hasil-persentase {
        font-size: 1rem;
        text-align: center;
    }
    
    .gejala-hasil-item {
        flex-direction: column;
        align-items: flex-start;
        gap: 0.5rem;
        padding: 0.875rem;
    }
    
    .gejala-hasil-item > span:first-child {
        align-self: flex-start;
    }
    
    .gejala-hasil-item > span:nth-child(2) {
        margin-top: -0.25rem;
    }
    
    .gejala-hasil-item > span:nth-child(3) {
        width: 100%;
        font-size: 0.9rem;
        line-height: 1.4;
    }
    
    .gejala-hasil-item > span:last-child {
        align-self: flex-start;
        margin-top: 0.25rem;
    }
    
    .hasil-body .card {
        border-radius: 10px !important;
        margin-bottom: 1rem !important;
    }
    
    .hasil-body .card-body {
        padding: 1rem;
    }
    
    .hasil-body .card-body p {
        font-size: 0.875rem;
        line-height: 1.6;
    }
    
    .hasil-body .card-title {
        font-size: 0.95rem;
    }
    
    .hasil-body .list-group-item {
        padding: 0.875rem;
        font-size: 0.875rem;
    }
    
    .hasil-body .list-group-item .badge {
        margin-top: 0.5rem;
    }
    
    /* Fix row/col layout on mobile */
    .hasil-main-card .row {
        flex-direction: column-reverse;
    }
    
    .hasil-main-card .col-md-4 {
        margin-bottom: 1rem;
    }
    
    .hasil-main-card .col-md-4 img {
        max-width: 120px !important;
    }
    
    .hasil-main-card .col-md-8 {
        text-align: center;
    }
    
    /* Action buttons on mobile */
    .hasil-body .text-center .btn {
        display: block;
        width: 100%;
        margin-bottom: 0.5rem;
    }
    
    .hasil-body .text-center .btn:last-child {
        margin-bottom: 0;
    }
}

/* Extra small devices */
@media (max-width: 480px) {
    .hasil-header h2 {
        font-size: 1.1rem;
    }
    
    .hasil-gangguan {
        font-size: 1rem;
    }
    
    .hasil-persentase {
        font-size: 0.9rem;
    }
    
    .gejala-hasil-item {
        padding: 0.75rem;
    }
    
    .hasil-body .card-body p {
        font-size: 0.8125rem;
    }
}

/* Kemungkinan Lain Section Styling */
.kemungkinan-list {
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.kemungkinan-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0.875rem 1rem;
    background: #fafafa;
    border-radius: 8px;
    border: 1px solid #e5e5e5;
    transition: all 0.2s ease;
    gap: 1rem;
}

.kemungkinan-item:hover {
    background: #f0f0f0;
    border-color: #EF4444;
}

.kemungkinan-content {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    flex: 1;
    min-width: 0;
}

.kemungkinan-content i {
    flex-shrink: 0;
}

.kemungkinan-text {
    font-weight: 500;
    color: #374151;
    word-break: break-word;
    line-height: 1.4;
}

.kemungkinan-badge {
    background: linear-gradient(135deg, #6B7280 0%, #4B5563 100%);
    color: white;
    padding: 0.375rem 0.75rem;
    border-radius: 20px;
    font-size: 0.8125rem;
    font-weight: 600;
    white-space: nowrap;
    flex-shrink: 0;
}

@media (max-width: 768px) {
    .kemungkinan-item {
        flex-direction: column;
        align-items: flex-start;
        padding: 0.875rem;
        gap: 0.5rem;
    }
    
    .kemungkinan-content {
        width: 100%;
    }
    
    .kemungkinan-text {
        font-size: 0.875rem;
    }
    
    .kemungkinan-badge {
        align-self: flex-start;
        font-size: 0.75rem;
        padding: 0.25rem 0.625rem;
    }
}

@media (max-width: 480px) {
    .kemungkinan-item {
        padding: 0.75rem;
    }
    
    .kemungkinan-text {
        font-size: 0.8125rem;
    }
}
</style>

<?php
switch ($_GET['act'] ?? '') {

  default:
    if ($_POST['submit'] ?? false) {
      $arcolor = array('#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700');
      date_default_timezone_set("Asia/Jakarta");
      $inptanggal = date('Y-m-d H:i:s');

      $arbobot = array('0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1');
      $arincident = array();

      // Sanitize and validate input
      $kondisi_input = isset($_POST['kondisi']) && is_array($_POST['kondisi']) ? $_POST['kondisi'] : [];
      for ($i = 0; $i < count($kondisi_input); $i++) {
        $arkondisi = explode("_", $kondisi_input[$i]);
        if (strlen($kondisi_input[$i]) > 1 && count($arkondisi) >= 2) {
          // Only accept numeric values
          $kode = intval($arkondisi[0]);
          $nilai = intval($arkondisi[1]);
          if ($kode > 0 && $nilai >= 0 && $nilai <= 9) {
            $arincident[$kode] = $nilai;
          }
        }
      }

      $sqlkondisi = mysqli_query($conn, "SELECT * FROM kondisi order by id+0");
      while ($rkondisi = mysqli_fetch_array($sqlkondisi)) {
        $arkondisitext[$rkondisi['id']] = htmlspecialchars($rkondisi['kondisi'], ENT_QUOTES, 'UTF-8');
      }

      $sqlpkt = mysqli_query($conn, "SELECT * FROM repair order by kode_repair+0");
      while ($rpkt = mysqli_fetch_array($sqlpkt)) {
        $arpkt[$rpkt['kode_repair']] = $rpkt['nama_repair'];
        $ardpkt[$rpkt['kode_repair']] = $rpkt['det_repair'];
        $arspkt[$rpkt['kode_repair']] = $rpkt['srn_repair'];
        $argpkt[$rpkt['kode_repair']] = $rpkt['gambar'];
      }

      //print_r($arkondisitext);
// -------- perhitungan certainty factor (CF) ---------
// --------------------- START ------------------------
      $sqlrepair = mysqli_query($conn, "SELECT * FROM repair order by kode_repair");
      $arrepair = array();
      while ($rrepair = mysqli_fetch_array($sqlrepair)) {
        $cftotal_temp = 0;
        $cf = 0;
        // Use prepared statement for inner query
        $kode_repair_int = intval($rrepair['kode_repair']);
        $stmt_incident = mysqli_prepare($conn, "SELECT * FROM basis_pengetahuan WHERE kode_repair = ?");
        mysqli_stmt_bind_param($stmt_incident, "i", $kode_repair_int);
        mysqli_stmt_execute($stmt_incident);
        $sqlincident = mysqli_stmt_get_result($stmt_incident);
        $cflama = 0;
        while ($rincident = mysqli_fetch_array($sqlincident)) {
          // Use validated arincident array
          foreach ($arincident as $incident_key => $incident_value) {
            if ($rincident['kode_incident'] == $incident_key) {
              $bobot_index = min(max(intval($incident_value), 0), 9);
              $cf = ($rincident['mb'] - $rincident['md']) * $arbobot[$bobot_index];
              if (($cf >= 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 - $cflama));
              }
              if ($cf * $cflama < 0) {
                $cflama = ($cflama + $cf) / (1 - min(abs($cflama), abs($cf)));
              }
              if (($cf < 0) && ($cf * $cflama >= 0)) {
                $cflama = $cflama + ($cf * (1 + $cflama));
              }
            }
          }
        }
        mysqli_stmt_close($stmt_incident);
        if ($cflama > 0) {
          $arrepair += array($rrepair['kode_repair'] => number_format($cflama, 4));
        }
      }

      arsort($arrepair);

      $inpincident = serialize($arincident);
      $inprepair = serialize($arrepair);

      $np1 = 0;
      $idpkt1 = [];
      $vlpkt1 = [];
      foreach ($arrepair as $key1 => $value1) {
        $np1++;
        $idpkt1[$np1] = intval($key1);
        $vlpkt1[$np1] = floatval($value1);
      }

      // Use prepared statement for insert
      $hasil_id = $idpkt1[1] ?? 0;
      $hasil_nilai = $vlpkt1[1] ?? 0;
      $stmt_insert = mysqli_prepare($conn, "INSERT INTO hasil (tanggal, incident, repair, hasil_id, hasil_nilai) VALUES (?, ?, ?, ?, ?)");
      mysqli_stmt_bind_param($stmt_insert, "sssid", $inptanggal, $inpincident, $inprepair, $hasil_id, $hasil_nilai);
      mysqli_stmt_execute($stmt_insert);
      mysqli_stmt_close($stmt_insert);
// --------------------- END -------------------------

      // Modern Results Display
      echo "<div class='hasil-container'>
        <div class='hasil-header'>
            <h2><i class='fa-solid fa-clipboard-check me-2'></i> Hasil Diagnosis</h2>
            <button id='print' onClick='window.print();' class='btn btn-light' data-bs-toggle='tooltip' title='Cetak hasil diagnosa'>
                <i class='fa-solid fa-print me-2'></i> Cetak
            </button>
        </div>
        <div class='hasil-body'>";
      
      // Gejala yang dipilih section
      echo "<div class='mb-4'>
                <h5 class='mb-3' style='color: #525252; font-weight: 600;'>
                    <i class='fa-solid fa-list-check me-2'></i> Gejala yang Dipilih
                </h5>";
      
      $ig = 0;
      foreach ($arincident as $key => $value) {
        $kondisi = intval($value);
        $ig++;
        $incident = intval($key);
        // Use prepared statement
        $stmt4 = mysqli_prepare($conn, "SELECT * FROM incident WHERE kode_incident = ?");
        mysqli_stmt_bind_param($stmt4, "i", $incident);
        mysqli_stmt_execute($stmt4);
        $result4 = mysqli_stmt_get_result($stmt4);
        $r4 = mysqli_fetch_array($result4);
        mysqli_stmt_close($stmt4);
        
        if ($r4) {
          echo "<div class='gejala-hasil-item'>
                    <span class='gejala-number' style='width: 28px; height: 28px; font-size: 0.75rem;'>$ig</span>
                    <span class='gejala-code'>G" . str_pad(htmlspecialchars($r4['kode_incident'], ENT_QUOTES, 'UTF-8'), 3, '0', STR_PAD_LEFT) . "</span>
                    <span style='flex: 1; font-weight: 500;'>" . htmlspecialchars($r4['nama_incident'], ENT_QUOTES, 'UTF-8') . "</span>
                    <span class='badge' style='background-color: " . ($arcolor[$kondisi] ?? '#e5e5e5') . "; color: #262626; padding: 0.5rem 0.75rem; border-radius: 20px;'>" . ($arkondisitext[$kondisi] ?? '-') . "</span>
                </div>";
        }
      }
      echo "</div>";
      
      $np = 0;
      $idpkt = [];
      $nmpkt = [];
      $vlpkt = [];
      foreach ($arrepair as $key => $value) {
        $np++;
        $idpkt[$np] = $key;
        $nmpkt[$np] = $arpkt[$key] ?? '';
        $vlpkt[$np] = $value;
      }
      if (isset($argpkt[$idpkt[1]]) && $argpkt[$idpkt[1]]) {
        $gambar = 'gambar/repair/' . $argpkt[$idpkt[1]];
      } else {
        $gambar = 'gambar/noimage.png';
      }
      
      // Main diagnosis result
      echo "<div class='hasil-main-card'>
                <div class='row align-items-center'>
                    <div class='col-md-8'>
                        <span class='badge mb-2' style='background: linear-gradient(135deg, #10B981 0%, #059669 100%); color: white; padding: 0.5rem 1rem; border-radius: 20px;'>
                            <i class='fa-solid fa-check-circle me-1'></i> Hasil Terdeteksi
                        </span>
                        <div class='hasil-gangguan'>" . htmlspecialchars($nmpkt[1] ?? 'Tidak terdeteksi', ENT_QUOTES, 'UTF-8') . "</div>
                        <div class='hasil-persentase'>
                            <i class='fa-solid fa-chart-pie me-1'></i> Tingkat Kepastian: <strong>" . round($vlpkt[1] ?? 0, 2) . "%</strong> (" . ($vlpkt[1] ?? 0) . ")
                        </div>
                    </div>
                    <div class='col-md-4 text-center mt-3 mt-md-0'>
                        <img class='img-fluid rounded' style='max-width: 180px; box-shadow: 0 4px 15px rgba(0,0,0,0.1); border-radius: 12px;' src='$gambar' alt='Gambar gangguan'>
                    </div>
                </div>
            </div>";
      
      // Detail section
      echo "<div class='card mb-3' style='border-left: 4px solid #3B82F6; border-radius: 12px;'>
                <div class='card-body'>
                    <h5 class='card-title mb-3' style='color: #3B82F6;'>
                        <i class='fa-solid fa-circle-info me-2'></i> Detail Gangguan
                    </h5>
                    <p class='mb-0' style='line-height: 1.7;'>" . htmlspecialchars($ardpkt[$idpkt[1]] ?? '', ENT_QUOTES, 'UTF-8') . "</p>
                </div>
            </div>";
      
      // Saran section
      echo "<div class='card mb-3' style='border-left: 4px solid #F59E0B; border-radius: 12px;'>
                <div class='card-body'>
                    <h5 class='card-title mb-3' style='color: #F59E0B;'>
                        <i class='fa-solid fa-lightbulb me-2'></i> Saran Penanganan
                    </h5>
                    <p class='mb-0' style='line-height: 1.7;'>" . htmlspecialchars($arspkt[$idpkt[1]] ?? '', ENT_QUOTES, 'UTF-8') . "</p>
                </div>
            </div>";
      
      // Other possibilities
      if (count($idpkt) > 1) {
        echo "<div class='card kemungkinan-lain-card' style='border-left: 4px solid #EF4444; border-radius: 12px;'>
                    <div class='card-body'>
                        <h5 class='card-title mb-3' style='color: #EF4444;'>
                            <i class='fa-solid fa-list me-2'></i> Kemungkinan Lain
                        </h5>
                        <div class='kemungkinan-list'>";
        
        for ($ipl = 2; $ipl <= count($idpkt); $ipl++) {
          if (isset($nmpkt[$ipl])) {
            echo "<div class='kemungkinan-item'>
                        <div class='kemungkinan-content'>
                            <i class='fa-solid fa-caret-right text-danger'></i>
                            <span class='kemungkinan-text'>" . htmlspecialchars($nmpkt[$ipl], ENT_QUOTES, 'UTF-8') . "</span>
                        </div>
                        <span class='kemungkinan-badge'>" . round($vlpkt[$ipl], 2) . "%</span>
                    </div>";
          }
        }
        
        echo "</div></div></div>";
      }
      
      // Action buttons
      echo "<div class='text-center mt-4'>
                <a href='?module=diagnosa' class='btn btn-primary me-2' style='border-radius: 10px; padding: 0.75rem 1.5rem;'>
                    <i class='fa-solid fa-rotate-left me-2'></i> Diagnosa Ulang
                </a>
                <a href='?module=riwayat' class='btn btn-outline-secondary' style='border-radius: 10px; padding: 0.75rem 1.5rem;'>
                    <i class='fa-solid fa-clock-rotate-left me-2'></i> Lihat Riwayat
                </a>
            </div>";
      
      echo "</div></div>";
    } else {
      echo "
<div class='diagnosa-form-container'>
    <div class='diagnosa-form-header'>
        <h3 class='mb-0'><i class='fa-solid fa-stethoscope me-2'></i> Formulir Diagnosa Gangguan</h3>
        <p class='mb-0 mt-2 opacity-75'>Pilih gejala sesuai kondisi perangkat IndiHome Anda</p>
    </div>
    <form name='text_form' method='POST' action='?module=diagnosa'>
        <div class='diagnosa-form-body'>";
      
      echo "<div class='alert alert-info mb-4' style='border-radius: 12px; border-left: 4px solid #3B82F6;'>
                <div class='d-flex align-items-start'>
                    <i class='fa-solid fa-circle-info me-3 mt-1' style='color: #3B82F6; font-size: 1.25rem;'></i>
                    <div>
                        <strong>Petunjuk Penggunaan:</strong><br>
                        Pilih tingkat kepastian gejala dari \"Pasti Tidak\" sampai \"Pasti Ya\" untuk setiap gejala yang sesuai dengan kondisi perangkat IndiHome (ODP, ONT, STB, Telepon). Setelah selesai, klik tombol <strong>Proses Diagnosa</strong>.
                    </div>
                </div>
            </div>";

      $sql3 = mysqli_query($conn, "SELECT * FROM incident order by kode_incident");
      $i = 0;
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        echo "<div class='gejala-card'>
                <div class='gejala-number'>$i</div>
                <span class='gejala-code'>G" . str_pad($r3['kode_incident'], 3, '0', STR_PAD_LEFT) . "</span>
                <div class='gejala-text'>" . htmlspecialchars($r3['nama_incident'], ENT_QUOTES, 'UTF-8') . "</div>
                <div class='gejala-select-wrapper'>
                    <select name='kondisi[]' id='sl$i' class='premium-select'>
                        <option data-id='0' value='0'>Pilih jika sesuai</option>";
        
        $s = "select * from kondisi order by id";
        $q = mysqli_query($conn, $s) or die($s);
        while ($rw = mysqli_fetch_array($q)) {
          echo "<option data-id='" . htmlspecialchars($rw['id'], ENT_QUOTES, 'UTF-8') . "' value='" . $r3['kode_incident'] . "_" . $rw['id'] . "'>" . htmlspecialchars($rw['kondisi'], ENT_QUOTES, 'UTF-8') . "</option>";
        }
        
        echo "</select>
                </div>
              </div>";
        ?>
        <script type="text/javascript">
          (function() {
            const arcolor = ['#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700'];
            const selectEl = document.getElementById('sl<?php echo $i; ?>');
            
            function setColor() {
              const selectedOption = selectEl.options[selectEl.selectedIndex];
              const colorId = selectedOption.getAttribute('data-id');
              const color = arcolor[colorId] || '#ffffff';
              selectEl.style.backgroundColor = color;
            }
            
            if (selectEl) {
              setColor();
              selectEl.addEventListener('change', setColor);
            }
          })();
        </script>
        <?php
      }
      echo "</div>
        <div class='submit-section'>
            <button type='submit' name='submit' value='1' class='btn-diagnosa-submit' data-bs-toggle='tooltip' data-bs-placement='top' title='Klik untuk melihat hasil diagnosa'>
                <i class='fa-solid fa-magnifying-glass-plus'></i>
                Proses Diagnosa
            </button>
        </div>
    </form>
</div>";
    }
    break;
}
?>
