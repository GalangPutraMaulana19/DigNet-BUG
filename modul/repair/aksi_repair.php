<?php

session_start();
if (!(isset($_SESSION['username']) && isset($_SESSION['password']))) {
  header('location:index.php');
  exit();
} else {
?>
  <?php

  session_start();
  include "../../config/koneksi.php";

  $module = $_GET['module'];
  $act = $_GET['act'];

// Hapus repair
  if ($module == 'repair' AND $act == 'hapus') {
    mysqli_query($conn,"DELETE FROM repair WHERE kode_repair='" . $_GET['id'] . "'");
    header('location:../../index.php?module=' . $module);
  }

// Input repair
  elseif ($module == 'repair' AND $act == 'input') {
    $nama_repair = $_POST['nama_repair'];
    $det_repair = $_POST['det_repair'];
    $srn_repair = $_POST['srn_repair'];
    $fileName = $_FILES['gambar']['name'];
    move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/repair/" . $_FILES['gambar']['name']);
    mysqli_query($conn,"INSERT INTO repair(
			      nama_repair,det_repair,srn_repair,gambar) 
	                       VALUES(
				'$nama_repair','$det_repair','$srn_repair','$fileName')");

    header('location:../../index.php?module=' . $module);
  }

// Update repair
  elseif ($module == 'repair' AND $act == 'update') {
    $nama_repair = $_POST['nama_repair'];
    $det_repair = $_POST['det_repair'];
    $srn_repair = $_POST['srn_repair'];

    $fileName = $_FILES['gambar']['name'];
    if ($fileName) {
      move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/repair/" . $_FILES['gambar']['name']);

      mysqli_query($conn,"UPDATE repair SET
					nama_repair   = '$nama_repair',
					det_repair   = '$det_repair',
					srn_repair   = '$srn_repair',
                      gambar   = '$fileName'
               WHERE kode_repair       = '" . $_POST['id'] . "'");
    } else {
      mysqli_query($conn,"UPDATE repair SET
					nama_repair   = '$nama_repair',
					det_repair   = '$det_repair',
					srn_repair   = '$srn_repair'
               WHERE kode_repair       = '" . $_POST['id'] . "'");
    }
    header('location:../../index.php?module=' . $module);
  }
  ?>
<?php } ?>