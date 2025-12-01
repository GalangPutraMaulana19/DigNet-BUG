<title>Admin - DigNet 1.0</title>

<!-- Premium SaaS Admin Styles -->
<style>
.admin-page-header {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 16px;
    padding: 2rem 2.5rem;
    margin-bottom: 2rem;
    box-shadow: 0 10px 40px rgba(102, 126, 234, 0.3);
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
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
    background-color: #f8f9ff;
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
    border-color: #667eea;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
}
</style>

<!-- Premium Page Header -->
<div class="admin-page-header">
    <h2>
        <i class="fa-solid fa-user-shield me-3"></i>
        Manajemen Admin Pakar
    </h2>
    <p>
        Kelola akun administrator sistem pakar DigNet
    </p>
</div>

<?php
if (empty($_SESSION['username'])) {
    header('location:index.php');
    exit();
} else {
    ?>
<script Language="JavaScript">
<!-- 
function Blank_TextField_Validator()
{
if (text_form.username.value == "")
{
   alert("Username tidak boleh kosong !");
   text_form.username.focus();
   return (false);
}
if (text_form.password.value == "")
{
   alert("Password tidak boleh kosong !");
   text_form.password.focus();
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
-->
</script>
<?php
include "config/fungsi_alert.php";
$aksi="modul/admin/aksi_admin.php";
$act = $_GET['act'] ?? 'default';
switch($act){
	// Tampil admin
  default:
  $offset = $_GET['offset'] ?? 0;
	//jumlah data yang ditampilkan perpage
	$limit = 10;
  $tampil = mysqli_query($conn, "SELECT * FROM admin ORDER BY username");
	echo "<div class='admin-card'>
          <div class='card-body'>
            <form method=POST action='?module=admin' name=text_form onsubmit='return Blank_TextField_Validator_Cari()' class='row g-3'>
              <div class='col-auto'>
                <button class='btn btn-success' style='border-radius: 8px; padding: 0.6rem 1.2rem;' type=button name=tambah onclick=\"window.location.href='?module=admin&act=tambahadmin';\">
                  <i class='fa-solid fa-user-plus'></i> Tambah Admin
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
			$numrows = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM admin where username like '%" . $_POST['keyword'] . "%'"));
			if ($numrows > 0){
				echo "<div class='alert alert-success alert-dismissible fade show'>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                <h4><i class='icon fa-solid fa-check'></i> Sukses!</h4>
                Admin yang anda cari di temukan.
              </div>";
				$i = 1;
	echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>"; 
	$hasil = mysqli_query($conn, "SELECT * FROM admin where username like '%" . $_POST['keyword'] . "%'");
	$no = 1;
	$counter = 1;
    while ($r = mysqli_fetch_array($hasil)){
       echo "<tr>
			 <td class='text-center'>$no</td>
	         <td>$r[username]</td>
	         <td>$r[nama_lengkap]</td>
			 <td class='text-center'><a type='button' class='btn btn-success btn-sm' href='?module=admin&act=editadmin&id=$r[username]'><i class='fa-solid fa-pen-to-square' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=admin&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa-solid fa-trash' aria-hidden='true'></i> Hapus</a>
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
                Maaf, Admin yang anda cari tidak ditemukan , silahkan inputkan dengan benar dan cari kembali.
              </div>";
			}
		}else{
	
	if($baris > 0){
	echo" <div class='admin-table-container'><table class='table table-bordered' cellpadding='0' cellspacing='0'>
          <thead>
            <tr>
              <th>No</th>
              <th>Username</th>
              <th>Nama Lengkap</th>
              <th width='21%'>Aksi</th>
            </tr>
          </thead>
		  <tbody>
		  "; 
	$hasil = mysqli_query($conn, "SELECT * FROM admin ORDER BY username limit $offset, $limit");
	$no = 1;
	$no = 1 + $offset;
	$counter = 1;
    while ($r = mysqli_fetch_array($hasil)){
       echo "<tr>
			 <td class='text-center'>$no</td>
	         <td>$r[username]</td>
	         <td>$r[nama_lengkap]</td>
			 <td class='text-center'>
			 <a type='button' class='btn btn-success btn-sm' href='?module=admin&act=editadmin&id=$r[username]'><i class='fa-solid fa-pen-to-square' aria-hidden='true'></i> Ubah </a> &nbsp;
	          <a type='button' class='btn btn-danger btn-sm' href=\"JavaScript: confirmIt('Anda yakin akan menghapusnya ?','$aksi?module=admin&act=hapus&id=$r[username]','','','','u','n','Self','Self')\" onMouseOver=\"self.status=''; return true\" onMouseOut=\"self.status=''; return true\"><i class='fa-solid fa-trash' aria-hidden='true'></i> Hapus</a>
             </td></tr>";
      $no++;
	  $counter++;
    }
    echo "</tbody></table></div>";
	echo "<div class=paging>";

	if ($offset != 0) {
		$prevoffset = $offset - 10;
		echo "<span class=prevnext> <a href=index.php?module=admin&offset=$prevoffset>Back</a></span>";
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
			echo "<a href=index.php?module=admin&offset=$newoffset>$i</a>";
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
		echo "<span class=prevnext><a href=index.php?module=admin&offset=$newoffset>Next</a>";
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
  
  case "tambahadmin":
	echo "<div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=admin&act=input' onsubmit='return Blank_TextField_Validator()'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
		  <tr><td>Nama Lengkap</td>   <td>  <input autocomplete='off' placeholder='Masukkan nama lengkap...' type=text class='form-control' name='nama_lengkap' size=30></td></tr>
          <tr><td>Username</td>   <td>  <input autocomplete='off' placeholder='Masukkan username...' type=text class='form-control' name='username' size=30></td></tr>
		  <tr><td>Password</td>   <td> <input autocomplete='off' placeholder='Masukkan password admin...' type=password class='form-control' name='password' size=30></td></tr>
		  <tr><td></td><td>
		  <input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=admin';\">
		  </td></tr>
          </table></form></div>";
     break;
    
  case "editadmin":
    $edit = mysqli_query($conn, "SELECT * FROM admin WHERE username='" . $_GET['id'] . "'");
    $r = mysqli_fetch_array($edit);
	
    echo "<div class='admin-form-container'><form name=text_form method=POST action='$aksi?module=admin&act=update' onsubmit='return Blank_TextField_Validator()'>
          <input type=hidden name=id value='$r[username]'>
          <table class='table table-bordered' style='border-radius: 12px; overflow: hidden;'>
	      <tr><td>Username</td> <td>  <input autocomplete='off' type=text class='form-control' name='username' value=\"$r[username]\" size=30></td></tr>
	      <tr><td>Nama Lengkap</td> <td>  <input autocomplete='off' type=text class='form-control' name='nama_lengkap' value=\"$r[nama_lengkap]\" size=30></td></tr>
          <tr><td></td><td>
		  <input class='btn btn-success' style='border-radius: 8px;' type=submit name=submit value='Simpan' >
		  <input class='btn btn-danger' style='border-radius: 8px;' type=button name=batal value='Batal' onclick=\"window.location.href='?module=admin';\"></td></tr>
          </table></form></div>";
    break;  
}
?>
<?php 
} ?>
