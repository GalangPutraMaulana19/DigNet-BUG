<title>Data Gangguan - DigNet 1.0</title>

<?php
// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
$csrf_token = $_SESSION['csrf_token'];
?>

<!-- Premium SaaS Admin Styles -->
<style>
.admin-page-header {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    border-radius: 16px;
    padding: 2rem 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(245, 87, 108, 0.3);
}
.admin-page-header h2 {
    color: #fff;
    font-weight: 700;
    margin: 0;
    font-size: 1.75rem;
}
.admin-page-header p {
    color: rgba(255,255,255,0.85);
    margin: 0.75rem 0 0 0;
    font-size: 1rem;
}
.admin-card {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    border: none;
    overflow: hidden;
}
.admin-card .card-body {
    padding: 1.5rem;
}
.admin-table-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    overflow: hidden;
    margin-top: 1rem;
}
.admin-table-container table {
    margin-bottom: 0;
    border-radius: 12px;
    overflow: hidden;
}
.admin-table-container table thead {
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
}
.admin-table-container table thead th {
    color: #fff;
    font-weight: 600;
    padding: 1rem;
    border: none;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}
.admin-table-container table tbody td {
    padding: 1rem;
    vertical-align: middle;
    border-color: #f0f0f0;
}
.admin-table-container table tbody tr:hover {
    background-color: #fff5f7;
}
.admin-form-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.08);
    padding: 2rem;
    margin-top: 1rem;
}
.admin-form-container table {
    border-radius: 12px;
    overflow: hidden;
}
.admin-form-container table td {
    padding: 1rem;
    border-color: #f0f0f0;
}
.admin-form-container .form-control {
    border-radius: 8px;
    border: 2px solid #e0e0e0;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
}
.admin-form-container .form-control:focus {
    border-color: #f5576c;
    box-shadow: 0 0 0 3px rgba(245, 87, 108, 0.15);
}
</style>

<!-- Premium Page Header -->
<div class="admin-page-header">
    <h2>
        <i class="fa-solid fa-circle-exclamation me-3"></i>
        Data Gangguan IndiHome
    </h2>
    <p>
        Kelola daftar jenis gangguan beserta detail dan saran penanganannya
    </p>
</div>

<?php

if (empty($_SESSION['username'])) {
  header('location:index.php');
  exit();
} else {
  ?>
  <script type="text/javascript">
    function Blank_TextField_Validator()
    {
      if (text_form.nama_repair.value == "")
      {
        alert("Nama Gangguan tidak boleh kosong !");
        text_form.nama_repair.focus();
        return (false);
      }
      return (true);
    }
    function Blank_TextField_Validator_Cari()
    {
      if (text_form.keyword.value == "")
      {
        alert("Isi dulu keyword pencarian !");
        text_form.keyword.focus();
        return (false);
      }
      return (true);
    }
    -- >
  </script>
  <?php

  include "config/fungsi_alert.php";
  $aksi = "modul/repair/aksi_repair.php";
  switch ($_GET['act'] ?? '') {
    // Tampil repair
    default:
      $offset = $_GET['offset'] ?? 0;
      //jumlah data yang ditampilkan perpage
      $limit = 15;
      $tampil = mysqli_query($conn,"SELECT * FROM repair ORDER BY kode_repair");
      echo "<div class='admin-card'>
        <div class='card-body'>
          <form method=POST action='?module=repair' name=text_form onsubmit='return Blank_TextField_Validator_Cari()' class='row g-3'>
            <div class='col-auto'>
              <button class='btn btn-success' style='border-radius: 8px; padding: 0.6rem 1.2rem;' type=button name=tambah onclick=\"window.location.href='?module=repair&act=tambahrepair';\">
                <i class='fa-solid fa-plus'></i> Tambah Gangguan
              </button>
            </div>
            <div class='col'>
              <input type=text name='keyword' placeholder='Ketik dan tekan cari...' class='form-control' style='border-radius: 8px;' value='$_POST[keyword]' />
            </div>
            <div class='col-auto'>
              <button class='btn btn-primary' style='border-radius: 8px; padding: 0.6rem 1.2rem;' type=submit name=Go>
                <i class='fa-solid fa-magnifying-glass'></i> Cari
              </button>
            </div>
          </form>
        </div>
      </div>";
      $baris = mysqli_num_rows($tampil);
      if ($_POST['Go'] ?? false) {
        $numrows = mysqli_num_rows(mysqli_query($conn,"SELECT * FROM repair where nama_repair like '%" . $_POST['keyword'] . "%'"));
        if ($numrows > 0) {
          echo "<div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='fa-solid fa-check'></i> Sukses!</h4>
                Gangguan yang anda cari ditemukan.
              </div>";
          $i = 1;
          echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Gangguan</th>
			  <th>Detail Gangguan</th>
			  <th>Saran Penanganan</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>";
          $hasil = mysqli_query($conn,"SELECT * FROM repair where nama_repair like '%" . $_POST['keyword'] . "%'");
          $no = 1;
          $counter = 1;
          while ($r = mysqli_fetch_array($hasil)) {
            $warna = ($counter % 2 == 0) ? "dark" : "light";
            echo "<tr>
			 <td class='text-center'>$no</td>
			 <td>{$r['nama_repair']}</td>
			 <td>{$r['det_repair']}</td>
			 <td>{$r['srn_repair']}</td>
			 <td class='text-center'>
               <a class='btn btn-sm btn-success' href='?module=repair&act=editrepair&id={$r["kode_repair"]}'>
                 <i class='fa-solid fa-pen-to-square'></i> Ubah
               </a>
               <a class='btn btn-sm btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=repair&act=hapus&id={$r['kode_repair']}','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
                 <i class='fa-solid fa-trash'></i> Hapus
               </a>
             </td></tr>";
            $no++;
            $counter++;
          }
          echo "</tbody></table></div>";
        }
        else {
          echo "<div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='fa-solid fa-ban'></i> Gagal!</h4>
                Maaf, Gangguan yang anda cari tidak ditemukan, silahkan inputkan dengan benar dan cari kembali.
              </div>";
        }
      } else {

        if ($baris > 0) {
          echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Gangguan</th>
			  <th>Detail Gangguan</th>
			  <th>Saran Penanganan</th>
              <th>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  ";
          $hasil = mysqli_query($conn,"SELECT * FROM repair ORDER BY kode_repair limit $offset,$limit");
          $no = 1;
          $no = 1 + $offset;
          $counter = 1;
          while ($r = mysqli_fetch_array($hasil)) {
            echo "<tr>
			 <td class='text-center'>$no</td>
			 <td>{$r['nama_repair']}</td>
			 <td>{$r['det_repair']}</td>
			 <td>{$r['srn_repair']}</td>
			 <td class='text-center'>
               <a class='btn btn-sm btn-success' href='?module=repair&act=editrepair&id={$r["kode_repair"]}'>
                 <i class='fa-solid fa-pen-to-square'></i> Ubah
               </a>
               <a class='btn btn-sm btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=repair&act=hapus&id={$r['kode_repair']}','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
                 <i class='fa-solid fa-trash'></i> Hapus
               </a>
             </td></tr>";
            $no++;
            $counter++;
          }
          echo "</tbody></table></div>";
          echo "<div class=paging>";

          if ($offset != 0) {
            $prevoffset = $offset - 10;
            echo "<span class=prevnext> <a href=index.php?module=repair&offset=$prevoffset>Back</a></span>";
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
              echo "<a href=index.php?module=repair&offset=$newoffset>$i</a>";
              //cetak halaman
            } else {
              echo "<span class=current>" . $i . "</span>"; //cetak halaman tanpa link
            }
          }

          //cek halaman akhir
          if (!(($offset / $limit) + 1 == $halaman) && $halaman != 1) {

            //jika bukan halaman terakhir maka berikan next
            $newoffset = $offset + $limit;
            echo "<span class=prevnext><a href=index.php?module=repair&offset=$newoffset>Next</a>";
          } else {
            echo "<span class=disabled>Next</span>"; //cetak halaman tanpa link
          }

          echo "</div>";
        } else {
          echo "<br><b>Data Kosong !</b>";
        }
      }
      break;

    case "tambahrepair":
      echo "<div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=repair&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
          <input type='hidden' name='csrf_token' value='$csrf_token'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
		  <tr><td width=120>Nama Gangguan</td><td><input autocomplete='off' type=text placeholder='Masukkan repair baru...' class='form-control' name='nama_repair' size=30></td></tr>
		  <tr><td width=120>Detail Gangguan</td><td> <textarea rows='4' cols='50' class='form-control' name='det_repair'type=text placeholder='Masukkan detail repair baru...'></textarea></td></tr>
		  <tr><td width=120>Saran Penanganan</td><td><textarea rows='4' cols='50' class='form-control' name='srn_repair'type=text placeholder='Masukkan saran repair baru...'></textarea></td></tr>
          <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input type='file' class='form-control' name='gambar' required /></td></tr>		  
          <tr><td></td><td><input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=repair';\"></td></tr>
          </table></form></div>";
      break;

    case "editrepair":
      $edit = mysqli_query($conn,"SELECT * FROM repair WHERE kode_repair='" . $_GET['id'] . "'");
      $r = mysqli_fetch_array($edit);
      if ($r['gambar']) {
        $gambar = 'gambar/repair/' . $r['gambar'];
      } else {
        $gambar = 'gambar/noimage.png';
      }

      echo "<div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=repair&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
          <input type='hidden' name='csrf_token' value='$csrf_token'>
          <input type=hidden name=id value='{$r['kode_repair']}'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
		  <tr><td width=120>Nama Gangguan</td><td><input autocomplete='off' type=text class='form-control' name='nama_repair' size=30 value=\"{$r['nama_repair']}\"></td></tr>
		  <tr><td width=120>Detail Gangguan</td><td><textarea rows='4' cols='50' type=text class='form-control' name='det_repair'>{$r['det_repair']}</textarea></td></tr>
		  <tr><td width=120>Saran Penanganan</td><td><textarea rows='4' cols='50' type=text class='form-control' name='srn_repair'>{$r['srn_repair']}</textarea></td></tr>
          <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control' name='gambar' required /></td></tr>
          <tr><td></td><td><img id='preview' src='$gambar' width=200 style='border-radius: 8px;'></td></tr>          
          <tr><td></td><td><input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=repair';\"></td></tr>
          </table></form></div>";
      break;
  }
  ?>
<?php } ?>

  <script>
    function readURL(input) {

      if (input.files &&
              input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
          $('#preview').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
      }
    }

    $("#upload").change(function () {
      readURL(this);
    });

    


  </script>
