<title>Detail Riwayat - Dignets 1.0</title>
<?php

if (isset($_GET['id'])) {
  $arcolor = ['#ffffff', '#cc66ff', '#019AFF', '#00CBFD', '#00FEFE', '#A4F804', '#FFFC00', '#FDCD01', '#FD9A01', '#FB6700'];
  date_default_timezone_set("Asia/Jakarta");
  $inptanggal = date('Y-m-d H:i:s');

  $arbobot = ['0', '1', '0.8', '0.6', '0.4', '-0.2', '-0.4', '-0.6', '-0.8', '-1'];
  $arincident = [];

  foreach ($_POST['kondisi'] as $kondisi) {
    $arkondisi = explode("_", $kondisi);
    if (strlen($kondisi) > 1) {
      $arincident[$arkondisi[0]] = $arkondisi[1];
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

  $sqlhasil = mysqli_query($conn, "SELECT * FROM hasil WHERE id_hasil=" . $_GET['id']);
  while ($rhasil = mysqli_fetch_array($sqlhasil)) {
    $arrepair = unserialize($rhasil['repair']);
    $arincident = unserialize($rhasil['incident']);
  }

  $np1 = 0;
  foreach ($arrepair as $key1 => $value1) {
    $np1++;
    $idpkt1[$np1] = $key1;
    $vlpkt1[$np1] = $value1;
  }


// --------------------- END -------------------------

  echo "<div class='content'>
	<h2 class='text text-primary'>Hasil Diagnosis &nbsp;&nbsp;<button id='print' onClick='window.print();' data-toggle='tooltip' data-placement='right' title='Klik tombol ini untuk mencetak hasil diagnosa'><i class='fa fa-print'></i> Cetak</button> </h2>
		  <hr><table class='table table-bordered table-striped diagnosa'> 
          <th width=8%>No</th>
          <th width=10%>Kode</th>
          <th>Incident yang dialami (keluhan)</th>
          <th width=20%>Pilihan</th>
          </tr>";
  $ig = 0;
  foreach ($arincident as $key => $value) {
    $kondisi = $value;
    $ig++;
    $incident = $key;
    $sql4 = mysqli_query($conn, "SELECT * FROM incident WHERE kode_incident = '$key'");
    $r4 = mysqli_fetch_array($sql4);
    echo '<tr><td>' . $ig . '</td>';
    echo '<td>G' . str_pad($r4['kode_incident'], 3, '0', STR_PAD_LEFT) . '</td>';
    echo '<td><span class="hasil text text-primary">' . $r4['nama_incident'] . "</span></td>";
    echo '<td><span class="kondisipilih" style="color:' . $arcolor[$kondisi] . '">' . $arkondisitext[$kondisi] . "</span></td></tr>";
  }
  $np = 0;
  foreach ($arrepair as $key => $value) {
    $np++;
    $idpkt[$np] = $key;
    $nmpkt[$np] = $arpkt[$key];
    $vlpkt[$np] = $value;
  }
  if ($argpkt[$idpkt[1]]) {
    $gambar = 'gambar/repair/' . $argpkt[$idpkt[1]];
  } else {
    $gambar = 'gambar/noimage.png';
  }
  echo "</table><div class='well well-small'><img class='card-img-top img-bordered-sm' style='float:right; margin-left:15px;' src='" . $gambar . "' height=200><h3>Hasil Diagnosa</h3>";
  echo "<div class='callout callout-default'>Jenis repair yang diderita adalah <b><h3 class='text text-success'>" . $nmpkt[1] . "</b> / " . round($vlpkt[1], 2) . " % (" . $vlpkt[1] . ")<br></h3>";
  echo "</div></div><div class='box box-info box-solid'><div class='box-header with-border'><h3 class='box-title'>Detail</h3></div><div class='box-body'><h4>";
  echo $ardpkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-warning box-solid'><div class='box-header with-border'><h3 class='box-title'>Saran</h3></div><div class='box-body'><h4>";
  echo $arspkt[$idpkt[1]];
  echo "</h4></div></div>
          <div class='box box-danger box-solid'><div class='box-header with-border'><h3 class='box-title'>Kemungkinan lain:</h3></div><div class='box-body'><h4>";
  for ($ipl = 2; $ipl < count($idpkt); $ipl++) {
    echo " <h4><i class='fa fa-caret-square-o-right'></i> " . $nmpkt[$ipl] . "</b> / " . round($vlpkt[$ipl], 2) . " % (" . $vlpkt[$ipl] . ")<br></h4>";
  }
  echo "</div></div>
		  </div>";
}
?>