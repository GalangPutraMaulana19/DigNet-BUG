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

// Hapus pengetahuan
if ($module == 'pengetahuan' AND $act == 'hapus') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($conn, "DELETE FROM basis_pengetahuan WHERE kode_pengetahuan = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Input pengetahuan
elseif ($module == 'pengetahuan' AND $act == 'input') {
    $kode_repair = intval($_POST['kode_repair'] ?? 0);
    $kode_incident = intval($_POST['kode_incident'] ?? 0);
    $mb = floatval($_POST['mb'] ?? 0);
    $md = floatval($_POST['md'] ?? 0);
    
    $stmt = mysqli_prepare($conn, "INSERT INTO basis_pengetahuan (kode_repair, kode_incident, mb, md) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "iidd", $kode_repair, $kode_incident, $mb, $md);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Update pengetahuan
elseif ($module == 'pengetahuan' AND $act == 'update') {
    $kode_repair = intval($_POST['kode_repair'] ?? 0);
    $kode_incident = intval($_POST['kode_incident'] ?? 0);
    $mb = floatval($_POST['mb'] ?? 0);
    $md = floatval($_POST['md'] ?? 0);
    $id = intval($_POST['id'] ?? 0);
    
    $stmt = mysqli_prepare($conn, "UPDATE basis_pengetahuan SET kode_repair = ?, kode_incident = ?, mb = ?, md = ? WHERE kode_pengetahuan = ?");
    mysqli_stmt_bind_param($stmt, "iiddi", $kode_repair, $kode_incident, $mb, $md, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}
?>