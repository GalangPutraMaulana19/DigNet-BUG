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

// Hapus incident
if ($module == 'incident' && $act == 'hapus') {
    mysqli_query($conn, "DELETE FROM incident WHERE kode_incident='" . $_GET['id'] . "'");
    header('location:../../index.php?module=' . $module);
}

// Input incident
elseif ($module == 'incident' && $act == 'input') {
    $nama_incident = $_POST['nama_incident'];
    mysqli_query($conn, "INSERT INTO incident(nama_incident) VALUES('$nama_incident')");
    header('location:../../index.php?module=' . $module);
}

// Update incident
elseif ($module == 'incident' && $act == 'update') {
    $nama_incident = $_POST['nama_incident'];
    mysqli_query($conn, "UPDATE incident SET nama_incident = '$nama_incident' WHERE kode_incident = '" . $_POST['id'] . "'");
    header('location:../../index.php?module=' . $module);
}
?>
<?php } ?>
