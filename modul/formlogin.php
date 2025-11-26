<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Pakar - DigNet 1.0</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  <link rel="stylesheet" href="animasi/login/network.css">
  <style>
    /* Login Form Premium Styling */
    .formku {
      z-index: 10;
      background: rgba(255, 255, 255, 0.95);
      backdrop-filter: blur(20px);
      max-width: 360px;
      margin: 0 auto;
      padding: 40px;
      border-radius: 20px;
      text-align: center;
      box-shadow: 
        0 25px 50px rgba(0, 0, 0, 0.3),
        0 0 0 1px rgba(255, 255, 255, 0.1);
      animation: form-appear 0.6s ease-out;
    }
    
    @keyframes form-appear {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
    
    .formku .info h4 {
      font-family: 'Inter', sans-serif;
      font-size: 24px;
      font-weight: 700;
      color: #1a1a2e;
      margin: 0 0 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
    }
    
    .formku .info h4 i {
      color: #667eea;
    }
    
    .formku .info p {
      color: #666;
      font-size: 14px;
      margin: 0 0 25px;
    }
    
    .formku input[type="text"],
    .formku input[type="password"] {
      width: 100%;
      padding: 15px 20px;
      border: 2px solid #e0e0e0;
      border-radius: 12px;
      font-size: 15px;
      font-family: 'Inter', sans-serif;
      margin-bottom: 15px;
      transition: all 0.3s ease;
      box-sizing: border-box;
      background: #f8f9fa;
    }
    
    .formku input[type="text"]:focus,
    .formku input[type="password"]:focus {
      outline: none;
      border-color: #667eea;
      background: white;
      box-shadow: 0 0 0 4px rgba(102, 126, 234, 0.15);
    }
    
    .formku input[type="submit"] {
      width: 100%;
      padding: 15px 30px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      font-family: 'Inter', sans-serif;
      cursor: pointer;
      transition: all 0.3s ease;
      box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    }
    
    .formku input[type="submit"]:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
    }
    
    .formku input[type="submit"]:active {
      transform: translateY(0);
    }
    
    .formku .message {
      margin-top: 20px;
      color: #888;
      font-size: 13px;
      font-family: 'Inter', sans-serif;
    }
    
    .formku .message a {
      color: #667eea;
      text-decoration: none;
      font-weight: 600;
      transition: color 0.3s ease;
    }
    
    .formku .message a:hover {
      color: #764ba2;
    }
    
    /* Logo/Brand */
    .brand-logo {
      width: 80px;
      height: 80px;
      margin: 0 auto 20px;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      border-radius: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
    }
    
    .brand-logo i {
      font-size: 36px;
      color: white;
    }
    
    /* Network Animation Container */
    .network-animation {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      pointer-events: none;
      z-index: 1;
    }
  </style>
</head>
<body>
  <!-- Network Mascot Animation -->
  <div class="mascot">
    <!-- Antenna with signal -->
    <div class="mascot-antenna"></div>
    
    <!-- Signal waves -->
    <div class="mascot-signal mascot-signal-1"></div>
    <div class="mascot-signal mascot-signal-2"></div>
    <div class="mascot-signal mascot-signal-3"></div>
    
    <!-- Body with eyes and LEDs -->
    <div class="mascot-body">
      <!-- Eyes -->
      <div class="mascot-eye mascot-eye-left">
        <div class="mascot-pupil"></div>
      </div>
      <div class="mascot-eye mascot-eye-right">
        <div class="mascot-pupil"></div>
      </div>
      
      <!-- LEDs -->
      <div class="mascot-led mascot-led-1"></div>
      <div class="mascot-led mascot-led-2"></div>
      <div class="mascot-led mascot-led-3"></div>
      <div class="mascot-led mascot-led-4"></div>
      
      <!-- Arms -->
      <div class="mascot-arm mascot-arm-left"></div>
      <div class="mascot-arm mascot-arm-right"></div>
    </div>
  </div>

  <!-- Login Form -->
  <div class="formku">
    <div class="brand-logo">
      <i class="fa-solid fa-network-wired"></i>
    </div>
    <div class="info">
      <h4><i class="fa-solid fa-shield-halved"></i> Login Pakar</h4>
      <p>Sistem Pakar Diagnosa Jaringan</p>
    </div>
    <form class="login-form" action="login.php" method="post" name="text_form" onsubmit="return Blank_TextField_Validator()">
      <input type="text" name="username" id="username" placeholder="Username" />
      <input type="password" name="password" id="password" placeholder="Password" />
      <input type="submit" name="submit" id="submitku" value="Login" />
      <p class="message">Ingin mendaftar? <a href="https://goo.gl/forms/OlZywbPBrBcG2nSy1" target="_blank">Ajukan Permohonan</a></p>
    </form>
  </div>

  <!-- Floating Particles -->
  <div class="particle particle-1"></div>
  <div class="particle particle-2"></div>
  <div class="particle particle-3"></div>
  <div class="particle particle-4"></div>
  <div class="particle particle-5"></div>

  <script src="animasi/login/network.js"></script>
  <script>
    // Form validation
    function Blank_TextField_Validator() {
      const username = document.getElementById('username');
      const password = document.getElementById('password');
      
      if (username.value.trim() === '') {
        alert('Isi dulu username!');
        username.focus();
        return false;
      }
      
      if (password.value.trim() === '') {
        alert('Isi dulu password!');
        password.focus();
        return false;
      }
      
      return true;
    }
    
    // Password field animation - make mascot cover eyes
    const passwordInput = document.querySelector('input[type="password"]');
    if (passwordInput) {
      passwordInput.addEventListener('focus', function() {
        document.body.classList.add('password');
      });
      passwordInput.addEventListener('blur', function() {
        document.body.classList.remove('password');
      });
    }
  </script>
</body>
</html>