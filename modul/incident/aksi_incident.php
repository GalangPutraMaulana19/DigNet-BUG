<?php

session_start();
if (!(isset($_SESSION['username']))) {
    header('location:index.php');
    exit();
}

include "../../config/koneksi.php";

// CSRF token validation for POST requests
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        die('Invalid CSRF token');
    }
}

$module = isset($_GET['module']) ? mysqli_real_escape_string($conn, $_GET['module']) : '';
$act = isset($_GET['act']) ? mysqli_real_escape_string($conn, $_GET['act']) : '';

// Hapus incident
if ($module == 'incident' && $act == 'hapus') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($conn, "DELETE FROM incident WHERE kode_incident = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Input incident
elseif ($module == 'incident' && $act == 'input') {
    $nama_incident = mysqli_real_escape_string($conn, $_POST['nama_incident'] ?? '');
    $stmt = mysqli_prepare($conn, "INSERT INTO incident (nama_incident) VALUES (?)");
    mysqli_stmt_bind_param($stmt, "s", $nama_incident);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Update incident
elseif ($module == 'incident' && $act == 'update') {
    $nama_incident = mysqli_real_escape_string($conn, $_POST['nama_incident'] ?? '');
    $id = intval($_POST['id'] ?? 0);
    $stmt = mysqli_prepare($conn, "UPDATE incident SET nama_incident = ? WHERE kode_incident = ?");
    mysqli_stmt_bind_param($stmt, "si", $nama_incident, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}
?>
