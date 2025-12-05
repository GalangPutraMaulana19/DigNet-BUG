<title>Basis Pengetahuan - DigNet 1.0</title>

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
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
    border-radius: 16px;
    padding: 2rem 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(250, 112, 154, 0.3);
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
    background: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
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
    background-color: #fffaf0;
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
    border-color: #fa709a;
    box-shadow: 0 0 0 3px rgba(250, 112, 154, 0.15);
}
</style>

<!-- Premium Page Header -->
<div class="admin-page-header">
    <h2>
        <i class="fa-solid fa-brain me-3"></i>
        Basis Pengetahuan
    </h2>
    <p>
        Kelola aturan IF-THEN dengan nilai MB dan MD untuk setiap kombinasi gejala-gangguan
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
if (document.text_form.kode_repair.value == "")
{
   alert("Pilih dulu gangguan !");
   document.text_form.kode_repair.focus();
   return (false);
}
if (document.text_form.kode_incident.value == "")
{
   alert("Pilih dulu gejala !");
   document.text_form.kode_incident.focus();
   return (false);
}
if (document.text_form.mb.value == "")
{
   alert("Isi dulu MB !");
   document.text_form.mb.focus();
   return (false);
}
if (document.text_form.md.value == "")
{
   alert("Isi dulu MD !");
   document.text_form.md.focus();
   return (false);
}
return (true);
}
function Blank_TextField_Validator_Cari()
{
if (document.text_form.keyword.value == "")
{
   alert("Isi dulu keyword pencarian !");
   document.text_form.keyword.focus();
   return (false);
}
return (true);
}
</script>
<?php
include "config/fungsi_alert.php";
$aksi="modul/pengetahuan/aksi_pengetahuan.php";
$act = $_GET['act'] ?? '';
switch($act){
	// Tampil pengetahuan
  default:
  $offset = $_GET['offset'] ?? 0;
	//jumlah data yang ditampilkan perpage
	$limit = 15;
  $tampil = mysqli_query($conn, "SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan");
	echo "<div class='admin-card'>
          <div class='card-body'>
            <form method=POST action='?module=pengetahuan' name=text_form onsubmit='return Blank_TextField_Validator_Cari()' class='row g-3'>
              <div class='col-auto'>
                <button class='btn btn-success' style='border-radius: 8px; padding: 0.6rem 1.2rem;' type=button name=tambah onclick=\"window.location.href='?module=pengetahuan&act=tambahpengetahuan';\">
                  <i class='fa-solid fa-plus'></i> Tambah Basis Pengetahuan
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
	if (isset($_POST['Go'])){
			$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM basis_pengetahuan b,repair p where b.kode_repair=p.kode_repair AND p.nama_repair like '%".$_POST['keyword']."%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='icon fa-solid fa-check'></i> Sukses!</h4>
                Pengetahuan yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Gangguan</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysqli_query($conn, "SELECT * FROM basis_pengetahuan b,repair p where b.kode_repair=p.kode_repair AND p.nama_repair like '%".$_POST['keyword']."%'");
	$no = 1;
	$counter = 1;
    while ($r = mysqli_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysqli_query($conn, "SELECT * FROM incident where kode_incident = '".$r['kode_incident']."'");
	$rincident = mysqli_fetch_array($sql);
       echo "<tr class='".$warna."'>
			 <td class='text-center'>$no</td>
			 <td>".$r['nama_repair']."</td>
			 <td>".$rincident['nama_incident']."</td>
			 <td class='text-center'>".$r['mb']."</td>
			 <td class='text-center'>".$r['md']."</td>
			 <td class='text-center'><a type='button' class='btn btn-success btn-sm' href='?module=pengetahuan&act=editpengetahuan&id='".$r['kode_pengetahuan']."'><i class='fa-solid fa-pen-to-square' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuan&act=hapus&id=".$r['kode_pengetahuan']."','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa-solid fa-trash' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table></div>";
			}
			else{
				echo "<div class='alert alert-danger alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='icon fa-solid fa-ban'></i> Gagal!</h4>
                Maaf, Pengetahuan yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{
	
	if($baris > 0){
	echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Gangguan</th>
              <th>Gejala</th>
              <th>MB</th>
              <th>MD</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysqli_query($conn, "SELECT * FROM basis_pengetahuan ORDER BY kode_pengetahuan limit $offset,$limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r = mysqli_fetch_array($hasil)){
	if ($counter % 2 == 0) $warna = "dark";
	else $warna = "light";
	$sql = mysqli_query($conn, "SELECT * FROM incident where kode_incident = '".$r['kode_incident']."'");
	$rincident = mysqli_fetch_array($sql);
	$sql2 = mysqli_query($conn, "SELECT * FROM repair where kode_repair = '".$r['kode_repair']."'");
	$rrepair = mysqli_fetch_array($sql2);
       echo "<tr class='".$warna."'>
			 <td class='text-center'>$no</td>
			 <td>".$rrepair['nama_repair']."</td>
			 <td>".$rincident['nama_incident']."</td>
			 <td class='text-center'>".$r['mb']."</td>
			 <td class='text-center'>".$r['md']."</td>
			 <td class='text-center'>
			 <a type='button' class='btn btn-success btn-sm' href='?module=pengetahuan&act=editpengetahuan&id='".$r['kode_pengetahuan']."'><i class='fa-solid fa-pen-to-square' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=pengetahuan&act=hapus&id=".$r['kode_pengetahuan']."','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\">
			  <i class='fa-solid fa-trash' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table></div>";
	echo "<div class=paging>";

	if ($offset != 0) {
		$prevoffset = $offset - 10;
		echo "<span class=prevnext> <a href=index.php?module=pengetahuan&offset=$prevoffset>Back</a></span>";
	}
	else {
		echo "<span class=disabled>Back</span>";//cetak halaman tanpa link
	}
	//hitung jumlah halaman
	$halaman = intval($baris / $limit);//Pembulatan

	if ($baris % $limit){
		$halaman++;
	}
	for($i = 1; $i <= $halaman; $i++){
		$newoffset = $limit * ($i - 1);
		if($offset != $newoffset){
			echo "<a href=index.php?module=pengetahuan&offset=$newoffset>$i</a>";
			//cetak halaman
		}
		else {
			echo "<span class=current>".$i."</span>";//cetak halaman tanpa link
		}
	}

	//cek halaman akhir
	if(!(($offset / $limit) + 1 == $halaman) && $halaman != 1){

		//jika bukan halaman terakhir maka berikan next
		$newoffset = $offset + $limit;
		echo "<span class=prevnext><a href=index.php?module=pengetahuan&offset=$newoffset>Next</a>";
	}
	else {
		echo "<span class=disabled>Next</span>";//cetak halaman tanpa link
	}
	
	echo "</div>";
	}else{
	echo "<br><b>Data Kosong !</b>";
	}
	}
    break;
  
  case "tambahpengetahuan":
	echo "	<div class='alert alert-success alert-dismissible fade show' style='border-radius: 12px;'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='icon fa-solid fa-triangle-exclamation'></i>Petunjuk Pengisian Pakar !</h4>
                Silahkan pilih incident yang sesuai dengan repair yang ada, dan berikan <b>nilai kepastian (MB & MB)</b> dengan cakupan sebagai berikut:<br><br>
				<b>1.0</b> (Pasti Ya)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.8</b> (Hampir Pasti)&nbsp;&nbsp;|<br>
				<b>0.6</b> (Kemungkinan Besar)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.4</b> (Mungkin)&nbsp;&nbsp;|<br>
				<b>0.2</b> (Hampir Mungkin)&nbsp;&nbsp;|&nbsp;&nbsp;<b>0.0</b> (Tidak Tahu atau Tidak Yakin)&nbsp;&nbsp;|<br><br>
				<b>CF(Pakar) = MB – MD</b><br>
				MB : Ukuran kenaikan kepercayaan (measure of increased belief) MD : Ukuran kenaikan ketidakpercayaan (measure of increased disbelief) <br> <br>
				<b>Contoh:</b><br>
				Jika kepercayaan <b>(MB)</b> anda terhadap incident Mencret keputih-putihan untuk repair Berak Kapur adalah <b>0.8 (Hampir Pasti)</b><br>
				Dan ketidakpercayaan <b>(MD)</b> anda terhadap incident Mencret keputih-putihan untuk repair Berak Kapur adalah <b>0.2 (Hampir Mungkin)</b><br><br>
				<b>Maka:</b> CF(Pakar) = MB – MD (0.8 - 0.2) = <b>0.6</b> <br>
				Dimana nilai kepastian anda terhadap incident Mencret keputih-putihan untuk repair Berak Kapur adalah <b>0.6 (Kemungkinan Besar)</b>
              </div>
          <div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=pengetahuan&act=input' onsubmit='return Blank_TextField_Validator()'>
          <input type='hidden' name='csrf_token' value='$csrf_token'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
		  <tr><td width=120>Repair</td><td><select class='form-control' name='kode_repair'  id='kode_repair' style='border-radius: 8px;'><option value=''>- Pilih Gangguan -</option>";
		$hasil4 = mysqli_query($conn, "SELECT * FROM repair order by nama_repair");
		while($r4 = mysqli_fetch_array($hasil4)){
			echo "<option value='".$r4['kode_repair']."'>".$r4['nama_repair']."</option>";
		}
		echo	"</select></td></tr>
		<tr><td>Gejala</td><td><select class='form-control' name='kode_incident' id='kode_incident' style='border-radius: 8px;'><option value=''>- Pilih Gejala -</option>";
		$hasil4 = mysqli_query($conn, "SELECT * FROM incident order by nama_incident");
		while($r4 = mysqli_fetch_array($hasil4)){
			echo "<option value='".$r4['kode_incident']."'>".$r4['nama_incident']."</option>";
		}
		echo	"</select></td></tr>
		<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 ></td></tr>
		<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 ></td></tr>
		  <tr><td></td><td><input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          </table></form></div>";
     break;
    
  case "editpengetahuan":
    $edit = mysqli_query($conn, "SELECT * FROM basis_pengetahuan WHERE kode_pengetahuan='".$_GET['id']."'");
    $r = mysqli_fetch_array($edit);
	
    echo "<br>
	<br>
	<div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=pengetahuan&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type='hidden' name='csrf_token' value='$csrf_token'>
          <input type=hidden name=id value='".$r['kode_pengetahuan']."'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
		  <tr><td width=120>Repair</td><td><select class='form-control' name='kode_repair' id='kode_repair' style='border-radius: 8px;'>";
		$hasil4 = mysqli_query($conn, "SELECT * FROM repair order by nama_repair");
		while($r4 = mysqli_fetch_array($hasil4)){
			echo "<option value='".$r4['kode_repair']."'"; if($r['kode_repair'] == $r4['kode_repair']) echo "selected";
			echo ">$r4[nama_repair]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>Gejala</td><td><select class='form-control' name='kode_incident' id='kode_incident' style='border-radius: 8px;'>";
		$hasil4 = mysqli_query($conn, "SELECT * FROM incident order by nama_incident");
		while($r4 = mysqli_fetch_array($hasil4)){
			echo "<option value='".$r4['kode_incident']."'"; if($r['kode_incident'] == $r4['kode_incident']) echo "selected";
			echo ">$r4[nama_incident]</option>";
		}
		echo	"</select></td></tr>
		<tr><td>MB</td><td><input autocomplete='off' placeholder='Masukkan MB' type=text class='form-control' name='mb' size=15 value='".$r['mb']."'></td></tr>
		<tr><td>MD</td><td><input autocomplete='off' placeholder='Masukkan MD' type=text class='form-control' name='md' size=15 value='".$r['md']."'></td></tr>
          <tr><td></td><td><input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=pengetahuan';\"></td></tr>
          </table></form></div>";
    break;  
}
?>
<?php } ?>
