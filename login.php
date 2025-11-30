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
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Gagal - DigNet 1.0</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="animasi/login/network.css">
  <style>
    /* Mobile-First Layout Override */
    body {
      flex-direction: column !important;
      min-height: 100vh;
      height: auto !important;
      padding: 20px;
      box-sizing: border-box;
      overflow-y: auto !important;
      overflow-x: hidden;
    }
    
    /* Hide mascot on mobile - cleaner design */
    .mascot {
      display: none;
    }
    
    /* Login Failed Premium Styling */
    .error-container {
      z-index: 10;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      width: 100%;
      max-width: 400px;
      margin: auto;
      padding: 35px 25px;
      border-radius: 24px;
      text-align: center;
      box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.1);
      animation: shake 0.5s ease-out, form-appear 0.6s ease-out;
      box-sizing: border-box;
    }
    
    @keyframes form-appear {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes shake {
      0%, 100% { transform: translateX(0); }
      10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
      20%, 40%, 60%, 80% { transform: translateX(5px); }
    }
    
    /* Error Icon */
    .error-icon {
      width: 80px;
      height: 80px;
      margin: 0 auto 20px;
      background: linear-gradient(135deg, #ff6b6b 0%, #ee5a5a 100%);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 15px 40px rgba(238, 90, 90, 0.4);
      animation: pulse-error 2s infinite;
    }
    
    @keyframes pulse-error {
      0%, 100% { transform: scale(1); box-shadow: 0 15px 40px rgba(238, 90, 90, 0.4); }
      50% { transform: scale(1.05); box-shadow: 0 20px 50px rgba(238, 90, 90, 0.5); }
    }
    
    .error-icon i {
      font-size: 36px;
      color: white;
    }
    
    .error-title {
      font-family: 'Inter', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: #1a1a2e;
      margin: 0 0 10px;
      word-wrap: break-word;
    }
    
    .error-subtitle {
      font-family: 'Inter', sans-serif;
      font-size: 14px;
      color: #666;
      margin: 0 0 8px;
      line-height: 1.5;
      word-wrap: break-word;
    }
    
    .error-detail {
      font-family: 'Inter', sans-serif;
      font-size: 13px;
      color: #999;
      margin: 0 0 20px;
      word-wrap: break-word;
    }
    
    /* Warning Badge */
    .warning-badge {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      background: #fff5f5;
      color: #ee5a5a;
      padding: 8px 14px;
      border-radius: 20px;
      font-size: 11px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      margin-bottom: 20px;
      border: 1px solid rgba(238, 90, 90, 0.2);
      flex-wrap: wrap;
      text-align: center;
      max-width: 100%;
      word-wrap: break-word;
    }
    
    .warning-badge i {
      flex-shrink: 0;
    }
    
    /* Buttons */
    .btn-retry {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 8px;
      width: 100%;
      padding: 14px 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 15px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
      text-decoration: none;
      margin-bottom: 12px;
      box-sizing: border-box;
    }
    
    .btn-retry:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
      color: white;
    }
    
    .btn-help {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      width: 100%;
      padding: 12px 20px;
      background: transparent;
      color: #667eea;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      font-size: 13px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      text-decoration: none;
      box-sizing: border-box;
    }
    
    .btn-help:hover {
      border-color: #667eea;
      background: rgba(102, 126, 234, 0.05);
      color: #764ba2;
    }
    
    /* Divider */
    .divider {
      display: flex;
      align-items: center;
      margin: 15px 0;
      color: #ccc;
      font-size: 12px;
      font-family: 'Inter', sans-serif;
    }
    
    .divider::before,
    .divider::after {
      content: '';
      flex: 1;
      height: 1px;
      background: #e0e0e0;
    }
    
    .divider span {
      padding: 0 12px;
    }
    
    /* Tips Section */
    .tips-section {
      background: #f8f9fa;
      border-radius: 12px;
      padding: 14px;
      margin-top: 15px;
      text-align: left;
    }
    
    .tips-title {
      font-family: 'Inter', sans-serif;
      font-size: 12px;
      font-weight: 600;
      color: #1a1a2e;
      margin: 0 0 8px;
      display: flex;
      align-items: center;
      gap: 6px;
    }
    
    .tips-title i {
      color: #f59e0b;
    }
    
    .tips-list {
      margin: 0;
      padding: 0 0 0 18px;
      font-family: 'Inter', sans-serif;
      font-size: 11px;
      color: #666;
      line-height: 1.7;
    }
    
    .tips-list li {
      margin-bottom: 4px;
    }
    
    /* Floating Particles - hide on mobile for performance */
    .particle {
      display: none;
    }
    
    /* Desktop - show mascot and particles */
    @media (min-width: 769px) {
      body {
        flex-direction: row !important;
        padding: 0;
        overflow: hidden !important;
        height: 100vh !important;
      }
      
      .mascot {
        display: block;
      }
      
      .particle {
        display: block;
      }
      
      .error-container {
        padding: 40px;
        margin: 0 auto;
      }
      
      .error-icon {
        width: 100px;
        height: 100px;
        margin-bottom: 25px;
      }
      
      .error-icon i {
        font-size: 48px;
      }
      
      .error-title {
        font-size: 28px;
      }
      
      .error-subtitle {
        font-size: 15px;
      }
      
      .error-detail {
        font-size: 14px;
        margin-bottom: 30px;
      }
      
      .warning-badge {
        font-size: 13px;
        padding: 10px 18px;
        margin-bottom: 25px;
      }
      
      .btn-retry {
        padding: 16px 30px;
        font-size: 16px;
        border-radius: 14px;
        margin-bottom: 15px;
      }
      
      .btn-help {
        padding: 14px 24px;
        font-size: 14px;
        border-radius: 14px;
      }
      
      .tips-section {
        padding: 15px;
        margin-top: 20px;
      }
      
      .tips-title {
        font-size: 13px;
      }
      
      .tips-list {
        font-size: 12px;
      }
    }
    
    /* Extra small devices */
    @media (max-width: 380px) {
      .error-container {
        padding: 25px 20px;
        border-radius: 20px;
      }
      
      .error-icon {
        width: 70px;
        height: 70px;
      }
      
      .error-icon i {
        font-size: 32px;
      }
      
      .error-title {
        font-size: 20px;
      }
      
      .error-subtitle {
        font-size: 13px;
      }
      
      .warning-badge {
        font-size: 10px;
        padding: 6px 10px;
      }
      
      .btn-retry {
        padding: 12px 16px;
        font-size: 14px;
      }
      
      .btn-help {
        padding: 10px 16px;
        font-size: 12px;
      }
      
      .tips-title {
        font-size: 11px;
      }
      
      .tips-list {
        font-size: 10px;
      }
    }
  </style>
</head>
<body>
  <!-- Network Mascot Animation (sad mode) -->
  <div class="mascot sad">
    <div class="mascot-antenna"></div>
    <div class="mascot-signal mascot-signal-1"></div>
    <div class="mascot-signal mascot-signal-2"></div>
    <div class="mascot-signal mascot-signal-3"></div>
    <div class="mascot-body">
      <div class="mascot-eye mascot-eye-left">
        <div class="mascot-pupil"></div>
      </div>
      <div class="mascot-eye mascot-eye-right">
        <div class="mascot-pupil"></div>
      </div>
      <div class="mascot-led mascot-led-1"></div>
      <div class="mascot-led mascot-led-2"></div>
      <div class="mascot-led mascot-led-3"></div>
      <div class="mascot-led mascot-led-4"></div>
      <div class="mascot-arm mascot-arm-left"></div>
      <div class="mascot-arm mascot-arm-right"></div>
    </div>
  </div>

  <!-- Error Container -->
  <div class="error-container">
    <div class="error-icon">
      <i class="fa-solid fa-xmark"></i>
    </div>
    
    <h1 class="error-title">Login Gagal!</h1>
    <p class="error-subtitle">Username atau Password yang Anda masukkan salah.</p>
    <p class="error-detail">Silakan periksa kembali kredensial Anda</p>
    
    <div class="warning-badge">
      <i class="fa-solid fa-shield-exclamation"></i>
      Akses ditolak - Autentikasi gagal
    </div>
    
    <a href="?module=formlogin" class="btn-retry">
      <i class="fa-solid fa-rotate-right"></i>
      Coba Lagi
    </a>
    
    <div class="divider"><span>atau</span></div>
    
    <a href="?module=bantuan" class="btn-help">
      <i class="fa-solid fa-circle-question"></i>
      Butuh Bantuan?
    </a>
    
    <div class="tips-section">
      <div class="tips-title">
        <i class="fa-solid fa-lightbulb"></i>
        Tips Login
      </div>
      <ul class="tips-list">
        <li>Pastikan Caps Lock tidak aktif</li>
        <li>Periksa ejaan username Anda</li>
        <li>Password bersifat case-sensitive</li>
      </ul>
    </div>
  </div>

  <!-- Floating Particles -->
  <div class="particle particle-1"></div>
  <div class="particle particle-2"></div>
  <div class="particle particle-3"></div>
  <div class="particle particle-4"></div>
  <div class="particle particle-5"></div>

  <script src="animasi/login/network.js"></script>
</body>
</html>
<?php
}
?>