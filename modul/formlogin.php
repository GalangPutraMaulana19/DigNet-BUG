<!-- Login Form Module - Designed for index.php layout -->
<style>
  /* Login Form Premium Styling - Full Width for Desktop */
  .formlogin-container {
    min-height: calc(100vh - 200px);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 20px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 50%, #f64f59 100%);
    border-radius: 16px;
    position: relative;
    overflow: hidden;
  }
  
  .formlogin-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.05'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    pointer-events: none;
  }
  
  .formku {
    z-index: 10;
    background: rgba(255, 255, 255, 0.98);
    backdrop-filter: blur(20px);
    width: 100%;
    max-width: 420px;
    margin: 0 auto;
    padding: 50px 40px;
    border-radius: 24px;
    text-align: center;
    box-shadow: 
      0 25px 50px rgba(0, 0, 0, 0.25),
      0 0 0 1px rgba(255, 255, 255, 0.2);
    animation: form-appear 0.6s ease-out;
    position: relative;
  }
  
  @keyframes form-appear {
    from { opacity: 0; transform: translateY(30px) scale(0.95); }
    to { opacity: 1; transform: translateY(0) scale(1); }
  }
  
  .formku .info h4 {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    font-size: 28px;
    font-weight: 700;
    color: #1a1a2e;
    margin: 0 0 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 12px;
  }
  
  .formku .info h4 i {
    color: #667eea;
    font-size: 24px;
  }
  
  .formku .info p {
    color: #666;
    font-size: 15px;
    margin: 0 0 30px;
    font-weight: 500;
  }
  
  .formku input[type="text"],
  .formku input[type="password"] {
    width: 100%;
    padding: 16px 20px;
    border: 2px solid #e8e8e8;
    border-radius: 14px;
    font-size: 16px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    margin-bottom: 16px;
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
    padding: 16px 30px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border: none;
    border-radius: 14px;
    font-size: 17px;
    font-weight: 600;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
    margin-top: 8px;
  }
  
  .formku input[type="submit"]:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(102, 126, 234, 0.5);
  }
  
  .formku input[type="submit"]:active {
    transform: translateY(-1px);
  }
  
  .formku .message {
    margin-top: 24px;
    color: #888;
    font-size: 14px;
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
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
    width: 90px;
    height: 90px;
    margin: 0 auto 24px;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 24px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 15px 35px rgba(102, 126, 234, 0.35);
  }
  
  .brand-logo i {
    font-size: 42px;
    color: white;
  }
  
  /* Floating decorations */
  .login-decoration {
    position: absolute;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.1);
    animation: float-decoration 6s ease-in-out infinite;
  }
  
  .login-decoration-1 {
    width: 100px;
    height: 100px;
    top: 10%;
    left: 10%;
    animation-delay: 0s;
  }
  
  .login-decoration-2 {
    width: 60px;
    height: 60px;
    top: 70%;
    left: 5%;
    animation-delay: 2s;
  }
  
  .login-decoration-3 {
    width: 80px;
    height: 80px;
    top: 20%;
    right: 10%;
    animation-delay: 4s;
  }
  
  .login-decoration-4 {
    width: 50px;
    height: 50px;
    bottom: 15%;
    right: 15%;
    animation-delay: 1s;
  }
  
  @keyframes float-decoration {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(10deg); }
  }
  
  /* Mobile responsive */
  @media (max-width: 768px) {
    .formlogin-container {
      padding: 30px 15px;
      min-height: auto;
    }
    
    .formku {
      padding: 35px 25px;
      max-width: 100%;
    }
    
    .formku .info h4 {
      font-size: 22px;
    }
    
    .brand-logo {
      width: 70px;
      height: 70px;
    }
    
    .brand-logo i {
      font-size: 32px;
    }
  }
</style>

<div class="formlogin-container">
  <!-- Floating decorations -->
  <div class="login-decoration login-decoration-1"></div>
  <div class="login-decoration login-decoration-2"></div>
  <div class="login-decoration login-decoration-3"></div>
  <div class="login-decoration login-decoration-4"></div>
  
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
</div>

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
</script>