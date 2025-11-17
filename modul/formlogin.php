<script type="text/javascript">
// Modern form validation - vanilla JavaScript
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
<!DOCTYPE html>
<html lang="en" >
<head>
  <meta charset="UTF-8">
  <title>Login Pakar - DigNet 1.0</title>
      <link rel="stylesheet" href="aset/login/css/style.css">
</head>
  <body>
<div class="ayaem">
  <div class="hand"></div>
  <div class="hand hand-r"></div>
  <div class="arms">
    <div class="arm"></div>
    <div class="arm arm-r"></div>
  </div>
</div>
<div class="formku">
   <div class="info">
    <h4><i class="fa-solid fa-paper-plane"></i> Login Pakar</h4><br>
  </div>
  <form class="login-form" action="login.php" method="post" name="text_form" onsubmit="return Blank_TextField_Validator()">
<input type="text" name="username" id="username" placeHolder="&#xf007;  Username" style="font-family:Arial, 'Font Awesome 6 Free'" />
<input type="password" name="password" id="password" placeHolder="&#xf023;  Password" style="font-family:Arial, 'Font Awesome 6 Free'" />
<input type="submit" name="submit" id="submitku" value="   Login   " /><br>
 <p class="message">Ingin mendaftar? <a href="https://goo.gl/forms/OlZywbPBrBcG2nSy1" target="_blank">Ajukan Permohonan</a></p>
  </form>
</div>
</body>

</html><script>
// Password field animation - vanilla JavaScript
const passwordInput = document.querySelector('input[type="password"]');
if (passwordInput) {
  passwordInput.addEventListener('focus', function() {
    document.body.classList.add('password');
  });
  passwordInput.addEventListener('blur', function() {
    document.body.classList.remove('password');
  });
}

// Sidebar collapse for login page
var d = document.getElementById("dignet-indihome");
if (d) {
  d.className += " sidebar-collapse";
}
</script>