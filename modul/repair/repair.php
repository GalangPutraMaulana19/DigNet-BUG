<title>Data Gangguan - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="mb-5">
    <h2 class="text text-primary">
        <i class="fa-solid fa-circle-exclamation me-3"></i>
        Data Gangguan IndiHome
    </h2>
    <p class="text-muted" style="font-size: 1.1rem; margin-top: 1rem;">
        Kelola daftar jenis gangguan beserta detail dan saran penanganannya
    </p>
</div>

<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
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
      echo "<div class='card'>
        <div class='card-body'>
          <form method=POST action='?module=repair' name=text_form onsubmit='return Blank_TextField_Validator_Cari()' class='row g-3'>
            <div class='col-auto'>
              <button class='btn btn-success' type=button name=tambah onclick=\"window.location.href='repair/tambahrepair';\">
                <i class='fa-solid fa-plus'></i> Tambah Gangguan
              </button>
            </div>
            <div class='col'>
              <input type=text name='keyword' placeholder='Ketik dan tekan cari...' class='form-control' value='$_POST[keyword]' />
            </div>
            <div class='col-auto'>
              <button class='btn btn-primary' type=submit name=Go>
                <i class='fa-solid fa-magnifying-glass'></i> Cari
              </button>
            </div>
          </form>
        </div>
      </div><br>";
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
          echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
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
               <a class='btn btn-sm btn-success' href=repair/editrepair/{$r['kode_repair']}>
                 <i class='fa-solid fa-pen-to-square'></i> Ubah
               </a>
               <a class='btn btn-sm btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=repair&act=hapus&id={$r['kode_repair']}','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
                 <i class='fa-solid fa-trash'></i> Hapus
               </a>
             </td></tr>";
            $no++;
            $counter++;
          }
          echo "</tbody></table>";
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
          echo" <table class='table table-bordered' style='overflow-x=auto' cellpadding='0' cellspacing='0'>
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
               <a class='btn btn-sm btn-success' href=repair/editrepair/{$r['kode_repair']}>
                 <i class='fa-solid fa-pen-to-square'></i> Ubah
               </a>
               <a class='btn btn-sm btn-danger' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=repair&act=hapus&id={$r['kode_repair']}','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
                 <i class='fa-solid fa-trash'></i> Hapus
               </a>
             </td></tr>";
            $no++;
            $counter++;
          }
          echo "</tbody></table>";
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
      echo "<form name=text_form method=POST action='$aksi?module=repair&act=input' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Nama Gangguan</td><td><input autocomplete='off' type=text placeholder='Masukkan repair baru...' class='form-control' name='nama_repair' size=30></td></tr>
		  <tr><td width=120>Detail Gangguan</td><td> <textarea rows='4' cols='50' class='form-control' name='det_repair'type=text placeholder='Masukkan detail repair baru...'></textarea></td></tr>
		  <tr><td width=120>Saran Penanganan</td><td><textarea rows='4' cols='50' class='form-control' name='srn_repair'type=text placeholder='Masukkan saran repair baru...'></textarea></td></tr>
          <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input type='file' class='form-control' name='gambar' required /></td></tr>		  
          <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=repair';\"></td></tr>
          </table></form>";
      break;

    case "editrepair":
      $edit = mysqli_query($conn,"SELECT * FROM repair WHERE kode_repair='" . $_GET['id'] . "'");
      $r = mysqli_fetch_array($edit);
      if ($r['gambar']) {
        $gambar = 'gambar/repair/' . $r['gambar'];
      } else {
        $gambar = 'gambar/noimage.png';
      }

      echo "<form name=text_form method=POST action='$aksi?module=repair&act=update' onsubmit='return Blank_TextField_Validator()' enctype='multipart/form-data'>
          <input type=hidden name=id value='{$r['kode_repair']}'>
          <br><br><table class='table table-bordered'>
		  <tr><td width=120>Nama Gangguan</td><td><input autocomplete='off' type=text class='form-control' name='nama_repair' size=30 value=\"{$r['nama_repair']}\"></td></tr>
		  <tr><td width=120>Detail Gangguan</td><td><textarea rows='4' cols='50' type=text class='form-control' name='det_repair'>{$r['det_repair']}</textarea></td></tr>
		  <tr><td width=120>Saran Penanganan</td><td><textarea rows='4' cols='50' type=text class='form-control' name='srn_repair'>{$r['srn_repair']}</textarea></td></tr>
          <tr><td width=120>Gambar Post</td><td>Upload Gambar (Ukuran Maks = 1 MB) : <input id='upload' type='file' class='form-control' name='gambar' required /></td></tr>
          <tr><td></td><td><img id='preview' src='$gambar' width=200></td></tr>          
          <tr><td></td><td><input class='btn btn-success' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' type=button name=batal value='Batal' onclick=\"window.location.href='?module=repair';\"></td></tr>
          </table></form>";
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
