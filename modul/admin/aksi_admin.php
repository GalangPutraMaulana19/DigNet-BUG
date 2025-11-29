<?php

session_start();
if (!(isset($_SESSION['username']))) {
    header('location:index.php');
    exit();
}

include "../../config/koneksi.php";

// CSRF token validation
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== ($_SESSION['csrf_token'] ?? '')) {
        die('Invalid CSRF token');
    }
}

$module = isset($_GET['module']) ? mysqli_real_escape_string($conn, $_GET['module']) : '';
$act = isset($_GET['act']) ? mysqli_real_escape_string($conn, $_GET['act']) : '';

// Hapus admin
if ($module == 'admin' AND $act == 'hapus') {
    $id = mysqli_real_escape_string($conn, $_GET['id'] ?? '');
    $stmt = mysqli_prepare($conn, "DELETE FROM admin WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Input admin
elseif ($module == 'admin' AND $act == 'input') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap'] ?? '');
    // Use password_hash instead of md5 for better security
    $pass = password_hash($_POST['password'] ?? '', PASSWORD_DEFAULT);
    
    $stmt = mysqli_prepare($conn, "INSERT INTO admin (username, password, nama_lengkap) VALUES (?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "sss", $username, $pass, $nama_lengkap);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Update admin
elseif ($module == 'admin' AND $act == 'update') {
    $username = mysqli_real_escape_string($conn, $_POST['username'] ?? '');
    $nama_lengkap = mysqli_real_escape_string($conn, $_POST['nama_lengkap'] ?? '');
    $id = mysqli_real_escape_string($conn, $_POST['id'] ?? '');
    
    $stmt = mysqli_prepare($conn, "UPDATE admin SET username = ?, nama_lengkap = ? WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "sss", $username, $nama_lengkap, $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}
?>