<title>Riwayat - DigNet 1.0</title>
<h2 class='text text-primary'>Riwayat Konsultasi</h2>
<hr>
<?php
include "config/fungsi_alert.php";
$aksi = "modul/riwayat/aksi_hasil.php";
switch ($_GET['act'] ?? '') {
// Tampil hasil
    default:
        $offset = $_GET['offset'] ?? 0;
//jumlah data yang ditampilkan perpage
        $limit = 15;

        $sqlgjl = mysqli_query($conn,"SELECT * FROM incident order by kode_incident+0");
        while ($rgjl = mysqli_fetch_array($sqlgjl)) {
            $argjl[$rgjl['kode_incident']] = $rgjl['nama_incident'];
        }

        $sqlpkt = mysqli_query($conn,"SELECT * FROM repair order by kode_repair+0");
        while ($rpkt = mysqli_fetch_array($sqlpkt)) {
            $arpkt[$rpkt['kode_repair']] = $rpkt['nama_repair'];
            $ardpkt[$rpkt['kode_repair']] = $rpkt['det_repair'];
            $arspkt[$rpkt['kode_repair']] = $rpkt['srn_repair'];
        }

        $tampil = mysqli_query($conn,"SELECT * FROM hasil ORDER BY id_hasil");
        $baris = mysqli_num_rows($tampil);
        if ($baris > 0) {
            echo"<div class='row'><div class='col-md-8'><table class='table table-bordered table-striped riwayat' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Tanggal</th>
              <th>Repair</th>
              <th nowrap>Nilai CF</th>
              <th width='21%' class='text-center'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  ";
            $hasil = mysqli_query($conn,"SELECT * FROM hasil ORDER BY id_hasil limit $offset,$limit");
            $no = 1;
            $no = 1 + $offset;
            $counter = 1;
            while ($r = mysqli_fetch_array($hasil)) {
              if ($r['hasil_id'] > 0){
                if ($counter % 2 == 0)
                    $warna = "dark";
                else
                    $warna = "light";
                echo "<tr>
			 <td class='text-center'>$no</td>
			 <td>$r[tanggal]</td>
			 <td>" . $arpkt[$r['hasil_id']] . "</td>
			 <td><span class='badge bg-secondary'>" . $r['hasil_nilai'] . "</span></td>
			 <td class='text-center'>
			 <a type='button' class='btn btn-secondary btn-sm' target='_blank' href=riwayat-detail/$r[id_hasil]><i class='fa-solid fa-eye' aria-hidden='true'></i> Detail </a> &nbsp;
	         </td></tr>";
                $no++;
                $counter++;
            }
            }
            echo "</tbody></table></div>";
            ?>

            <div class="col-md-4">
              <div class="card card-success card-outline">
                <div class="card-header">
                  <i class="fa-solid fa-chart-pie"></i>

                  <h3 class="card-title">Grafik</h3>

                  <div class="card-tools float-end">
                    <button type="button" class="btn btn-tool" data-widget="collapse"><i class="fa-solid fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-widget="remove"><i class="fa-solid fa-xmark"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="donutChart" style="height:250px;"></canvas>
                </div>
                <!-- /.card-body-->
              </div>
            </div>


            <?php
            echo "</div><div class='col-md-12'><div class='row'><div class=paging>";

            if ($offset != 0) {
                $prevoffset = $offset - $limit;
                echo "<span class=prevnext> <a href=index.php?module=riwayat&offset=$prevoffset>Back</a></span>";
            } else {
                echo "<span class=disabled>Back</span>"; //cetak halaman tanpa link
            }
//hitung jumlah halaman
            $halaman = intval($baris / $limit); //Pembulatan

            if ($baris % $limit) {
                $halaman++;
            }
            for ($i = 1; $i <= $halaman; $i++) {
                $newoffset = $limit * ($i - 1);
                if ($offset != $newoffset) {
                    echo "<a href=index.php?module=riwayat&offset=$newoffset>$i</a>";
//cetak halaman
                } else {
                    echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
                }
            }

//cek halaman akhir
            if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

//jika bukan halaman terakhir maka berikan next
                $newoffset = $offset + $limit;
                echo "<span class=prevnext><a href=index.php?module=riwayat&offset=$newoffset>Next</a>";
            } else {
                echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
            }

            echo "</div></div></div>";
        } else {
            echo "<br><b>Data Kosong !</b>";
        }
}
?>

<script>
// Chart.js v4 - Modern Doughnut Chart
document.addEventListener('DOMContentLoaded', function() {
<?php
// Prepare data for Chart.js
$chartLabels = [];
$chartData = [];
$chartColors = [
    '#E21E2C', // IndiHome red
    '#00AED6', // Telkom blue
    '#00C853', // Success green
    '#FF6F00', // Orange
    '#9C27B0', // Purple
    '#F44336', // Red
    '#2196F3', // Blue
    '#4CAF50', // Green
    '#FFC107', // Amber
    '#795548'  // Brown
];

$hasilg = mysqli_query($conn,"SELECT hasil_id, count(hasil_id) jlh_id FROM hasil group by hasil_id ORDER BY jlh_id desc");
$index = 0;
while ($rg = mysqli_fetch_array($hasilg)) {
  if ($rg['hasil_id'] > 0) {
    $chartLabels[] = $arpkt[$rg['hasil_id']];
    $chartData[] = $rg['jlh_id'];
    $index++;
  }
}
?>

const chartData = {
    labels: <?php echo json_encode($chartLabels); ?>,
    datasets: [{
        data: <?php echo json_encode($chartData); ?>,
        backgroundColor: <?php echo json_encode(array_slice($chartColors, 0, count($chartLabels))); ?>,
        borderWidth: 2,
        borderColor: '#fff'
    }]
};

const config = {
    type: 'doughnut',
    data: chartData,
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                display: true,
                position: 'bottom',
                labels: {
                    padding: 15,
                    font: {
                        size: 12
                    },
                    usePointStyle: true,
                    pointStyle: 'circle'
                }
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        const label = context.label || '';
                        const value = context.parsed || 0;
                        const total = context.dataset.data.reduce((a, b) => a + b, 0);
                        const percentage = ((value / total) * 100).toFixed(1);
                        return label + ': ' + value + ' (' + percentage + '%)';
                    }
                }
            }
        },
        cutout: '60%', // Creates the donut hole
        animation: {
            animateRotate: true,
            animateScale: true
        }
    }
};

const ctx = document.getElementById('donutChart');
if (ctx) {
    new Chart(ctx, config);
}
});
</script>
