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

// Allowed file extensions for uploads
$allowed_extensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
$max_file_size = 2 * 1024 * 1024; // 2MB

// Function to validate and sanitize file upload
function validateFileUpload($file, $allowed_extensions, $max_file_size) {
    if (empty($file['name'])) return ['valid' => false, 'filename' => ''];
    
    $file_extension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
        return ['valid' => false, 'error' => 'Invalid file type'];
    }
    
    if ($file['size'] > $max_file_size) {
        return ['valid' => false, 'error' => 'File too large'];
    }
    
    // Generate unique filename to prevent overwriting
    $new_filename = uniqid() . '_' . preg_replace('/[^a-zA-Z0-9._-]/', '', $file['name']);
    return ['valid' => true, 'filename' => $new_filename];
}

// Hapus post
if ($module == 'post' AND $act == 'hapus') {
    $id = intval($_GET['id'] ?? 0);
    $stmt = mysqli_prepare($conn, "DELETE FROM post WHERE kode_post = ?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}

// Input post
elseif ($module == 'post' AND $act == 'input') {
    $nama_post = mysqli_real_escape_string($conn, $_POST['nama_post'] ?? '');
    $det_post = mysqli_real_escape_string($conn, $_POST['det_post'] ?? '');
    $srn_post = mysqli_real_escape_string($conn, $_POST['srn_post'] ?? '');
    
    $fileName = '';
    if (!empty($_FILES['gambar']['name'])) {
        $upload_result = validateFileUpload($_FILES['gambar'], $allowed_extensions, $max_file_size);
        if ($upload_result['valid']) {
            $fileName = $upload_result['filename'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/" . $fileName);
        }
    }
    
    $stmt = mysqli_prepare($conn, "INSERT INTO post (nama_post, det_post, srn_post, gambar) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $nama_post, $det_post, $srn_post, $fileName);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("location:../../index.php?module=" . urlencode($module));
    exit();
}

// Update post
elseif ($module == 'post' AND $act == 'update') {
    $nama_post = mysqli_real_escape_string($conn, $_POST['nama_post'] ?? '');
    $det_post = mysqli_real_escape_string($conn, $_POST['det_post'] ?? '');
    $srn_post = mysqli_real_escape_string($conn, $_POST['srn_post'] ?? '');
    $id = intval($_POST['id'] ?? 0);
    
    if (!empty($_FILES['gambar']['name'])) {
        $upload_result = validateFileUpload($_FILES['gambar'], $allowed_extensions, $max_file_size);
        if ($upload_result['valid']) {
            $fileName = $upload_result['filename'];
            move_uploaded_file($_FILES['gambar']['tmp_name'], "../../gambar/" . $fileName);
            
            $stmt = mysqli_prepare($conn, "UPDATE post SET nama_post = ?, det_post = ?, srn_post = ?, gambar = ? WHERE kode_post = ?");
            mysqli_stmt_bind_param($stmt, "ssssi", $nama_post, $det_post, $srn_post, $fileName, $id);
        }
    } else {
        $stmt = mysqli_prepare($conn, "UPDATE post SET nama_post = ?, det_post = ?, srn_post = ? WHERE kode_post = ?");
        mysqli_stmt_bind_param($stmt, "sssi", $nama_post, $det_post, $srn_post, $id);
    }
    
    if (isset($stmt)) {
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
    }
    header('location:../../index.php?module=' . urlencode($module));
    exit();
}
?>