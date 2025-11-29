<title>Login Gagal ! - Dignets 1.0</title>
<?php
session_start();
include "config/koneksi.php";

// Check if POST data exists before using
$user = isset($_POST['username']) ? trim($_POST['username']) : '';
$pass = isset($_POST['password']) ? $_POST['password'] : '';

// Use prepared statements to prevent SQL injection
$stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
mysqli_stmt_bind_param($stmt, "s", $user);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

$ketemu = mysqli_num_rows($result);
$r = mysqli_fetch_array($result);
mysqli_stmt_close($stmt);

// Verify password using password_verify if using password_hash, or md5 for legacy
if ($ketemu > 0 && (password_verify($pass, $r['password']) || md5($pass) === $r['password'])) {
	// Regenerate session ID to prevent session fixation
	session_regenerate_id(true);
	$_SESSION['username'] = $r['username'];
	$_SESSION['nama_lengkap'] = $r['nama_lengkap'];
	$_SESSION['login_time'] = time();
	header("location: index.php");
	exit();
}
else{
  echo " <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css' rel='stylesheet'>
		<link rel='stylesheet' href='animasi/login/ayam.css'>
		<link rel='stylesheet' href='aset/cinta.css'>
		<link href='css/main.css' rel='stylesheet' type='text/css' media='all'/>
		    <link rel='stylesheet' href='aset/bootstrap.css'>
		<div class='errorpage'> <center><div class='danger'><i class='fa-solid fa-triangle-exclamation'></i></div><br><h1>LOGIN GAGAL!</h1>
        Username dan Password anda salah.<br><br><input name='submit' id='submitku' type=submit style='padding: 6px 12px;' value='ULANGI LAGI' onclick=location.href='?module=formlogin'></a><br><p class='message'>Masih bingung, Kembali ke <a href='?module=bantuan'>Halaman Bantuan</a></p></center></div>
<div class='chick-wrapper-landing show'>
  <div class='wing-back'></div>
  <div class='body'>
    <div class='eye-left'></div>
    <div class='eye-right'></div>
  </div>
  <div class='wing-front'></div>
</div>
<div class='chick-wrapper-run run'><img class='egg-lay' src='animasi/login/lay_egg.png'/>
  <div class='legs'>
    <div class='leg-l'></div>
    <div class='leg-r'></div>
  </div>
  <div class='wing-back'> </div>
  <div class='sweat-1'></div>
  <div class='sweat-2'></div>
  <div class='sweat-3'></div>
  <div class='body'>
    <div class='eye-liner'>
      <div class='eye'></div>
    </div>
    <div class='eye-lid'></div>
    <div class='cheek'></div>
  </div>
  <div class='sweat-last'></div>
  <div class='wing-front'></div>
</div>
    <script  src='animasi/login/index.js'></script>";
}
?>