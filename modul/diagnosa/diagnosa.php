<title>Diagnosa - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="mb-5">
    <h2 class="text text-primary">
        <i class="fa-solid fa-stethoscope me-3"></i>
        Diagnosis Gangguan IndiHome
    </h2>
    <p class="text-muted" style="font-size: 1.1rem; margin-top: 1rem;">
        Sistem pakar untuk mendiagnosis gangguan perangkat IndiHome dengan metode Forward Chaining dan Certainty Factor
    </p>
</div>

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

      echo "<div class='content'>
	<h2 class='text-primary'>Hasil Diagnosis &nbsp;&nbsp;<button id='print' onClick='window.print();' data-bs-toggle='tooltip' data-bs-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa' class='btn btn-secondary'><i class='fa-solid fa-print'></i> Cetak</button> </h2>
	          <hr><table class='table table-bordered table-striped diagnosa'> 
          <th width=8%>No</th>
          <th width=10%>Kode</th>
          <th>Incident yang dialami (keluhan)</th>
          <th width=20%>Pilihan</th>
          </tr>";
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
          echo '<tr><td>' . $ig . '</td>';
          echo '<td>G' . str_pad(htmlspecialchars($r4['kode_incident'], ENT_QUOTES, 'UTF-8'), 3, '0', STR_PAD_LEFT) . '</td>';
          echo '<td><span class="hasil text text-primary">' . htmlspecialchars($r4['nama_incident'], ENT_QUOTES, 'UTF-8') . "</span></td>";
          echo '<td><span class="kondisipilih" style="color:' . ($arcolor[$kondisi] ?? '#ffffff') . '">' . ($arkondisitext[$kondisi] ?? '') . "</span></td></tr>";
        }
      }
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
      if ($argpkt[$idpkt[1]]) {
        $gambar = 'gambar/repair/' . $argpkt[$idpkt[1]];
      } else {
        $gambar = 'gambar/noimage.png';
      }
      echo "</table><div class='card'><div class='card-body'><img class='img-fluid rounded float-end' style='margin-left:15px; max-width: 200px;' src='" . $gambar . "'><h3>Hasil Diagnosa</h3>";
      echo "<div class='alert alert-success'>Jenis gangguan yang terdeteksi adalah <b><h3 class='text-success'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 2) . " % (" . $vlpkt[1] . ")<br></h3>";
      echo "</div></div></div><div class='card card-info card-outline mt-3'><div class='card-header'><h3 class='card-title'><i class='fa-solid fa-circle-info'></i> Detail</h3></div><div class='card-body'><h4>";
      echo $ardpkt[$idpkt[1]];
      echo "</h4></div></div>
          <div class='card card-warning card-outline mt-3'><div class='card-header'><h3 class='card-title'><i class='fa-solid fa-lightbulb'></i> Saran Penanganan</h3></div><div class='card-body'><h4>";
      echo $arspkt[$idpkt[1]];
      echo "</h4></div></div>
          <div class='card card-danger card-outline mt-3'><div class='card-header'><h3 class='card-title'><i class='fa-solid fa-list'></i> Kemungkinan lain:</h3></div><div class='card-body'><h4>";
      for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
        echo " <h4><i class='fa-solid fa-caret-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 2) . " % (" . $vlpkt[$ipl] . ")<br></h4>";
      }
      echo "</div></div>
		  </div>";
    } else {
      echo "
	 <h2 class='text-primary'>Diagnosa Gangguan IndiHome</h2>  <hr>
	 <div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='fa-solid fa-triangle-exclamation'></i> Perhatian !</h4>
                Silahkan memilih gejala sesuai dengan kondisi perangkat IndiHome (ODP, ONT, STB, Telepon). Anda dapat memilih tingkat kepastian gejala dari pasti tidak sampai pasti ya. Setelah selesai, tekan tombol proses (<i class='fa-solid fa-magnifying-glass-plus'></i>) di bawah untuk melihat hasil diagnosis.
              </div>
		<form name=text_form method=POST action='?module=diagnosa' >
           <table class='table table-bordered table-striped konsultasi'><tbody class='pilihkondisi'>
           <tr><th>No</th><th>Kode</th><th>Gejala</th><th width='20%'>Pilih Kondisi</th></tr>";

      $sql3 = mysqli_query($conn, "SELECT * FROM incident order by kode_incident");
      $i = 0;
      while ($r3 = mysqli_fetch_array($sql3)) {
        $i++;
        echo "<tr><td class=opsi>$i</td>";
        echo "<td class=opsi>G" . str_pad($r3['kode_incident'], 3, '0', STR_PAD_LEFT) . "</td>";
        echo "<td class=incident>$r3[nama_incident]</td>";
        echo '<td class="opsi"><select name="kondisi[]" id="sl' . $i . '" class="opsikondisi"/><option data-id="0" value="0">Pilih jika sesuai</option>';
        $s = "select * from kondisi order by id";
        $q = mysqli_query($conn, $s) or die($s);
        while ($rw = mysqli_fetch_array($q)) {
          ?>
          <option data-id="<?php echo $rw['id']; ?>" value="<?php echo $r3['kode_incident'] . '_' . $rw['id']; ?>"><?php echo $rw['kondisi']; ?></option>
          <?php
        }
        echo '</select></td>';
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
        echo "</tr>";
      }
      echo "
		  <input class='float' type=submit data-bs-toggle='tooltip' data-bs-placement='top' title='Klik disini untuk melihat hasil diagnosa' name=submit value='&#xf00e;' style='font-family:Arial, FontAwesome'>
          </tbody></table></form>";
    }
    break;
}
?>
