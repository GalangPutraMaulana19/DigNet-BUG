<title>Ubah Password - DigNet 1.0</title>

<!-- Premium Page Header -->
<div class="mb-5">
    <h2 class="text text-primary">
        <i class="fa-solid fa-key me-3"></i>
        Ubah Password
    </h2>
    <p class="text-muted" style="font-size: 1.1rem; margin-top: 1rem;">
        Ubah password akun administrator untuk keamanan yang lebih baik
    </p>
</div>

<?php
// Generate CSRF token if not exists
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

if (!empty($_SESSION['username'])) {
    $act = $_GET['act'] ?? '';
    switch ($act) {
        default:
            echo "<div class='card premium-shadow'>
                    <div class='card-body'>
                      <form method='post' action='?module=password&act=updatepassword'>
                        <input type='hidden' name='csrf_token' value='" . htmlspecialchars($_SESSION['csrf_token'], ENT_QUOTES, 'UTF-8') . "'>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Password Lama</label>
                          <input class='form-control' autocomplete='off' placeholder='Masukkan password lama...' type='password' name='oldPass' required />
                        </div>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Password Baru</label>
                          <input class='form-control' autocomplete='off' placeholder='Masukkan password baru...' type='password' name='newPass1' required minlength='8' />
                          <small class='text-muted'>Minimal 8 karakter</small>
                        </div>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Ulangi Password Baru</label>
                          <input class='form-control' autocomplete='off' placeholder='Ulangi password baru...' type='password' name='newPass2' required minlength='8' />
                        </div>
                        <div class='mt-4'>
                          <button class='btn btn-success' type='submit' name='submit'>
                            <i class='fa-solid fa-save me-2'></i>Simpan Perubahan
                          </button>
                          <a href='./' class='btn btn-secondary'>
                            <i class='fa-solid fa-xmark me-2'></i>Batal
                          </a>
                        </div>
                        <input type='hidden' name='nama' value='" . htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8') . "'>
                      </form>
                    </div>
                  </div>";
            break;

        case "updatepassword":
            // Verify CSRF token
            if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
                echo "<div class='alert alert-danger'>Invalid security token. Please try again.</div>";
                break;
            }
            
            include "config/koneksi.php";
            $user = mysqli_real_escape_string($conn, $_POST['nama'] ?? '');
            $passwordlama = $_POST['oldPass'] ?? '';
            $passwordbaru1 = $_POST['newPass1'] ?? '';
            $passwordbaru2 = $_POST['newPass2'] ?? '';
            
            // Use prepared statement
            $stmt = mysqli_prepare($conn, "SELECT * FROM admin WHERE username = ?");
            mysqli_stmt_bind_param($stmt, "s", $user);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            $data = mysqli_fetch_array($result);
            mysqli_stmt_close($stmt);

            // Verify old password (supports both password_hash and legacy md5)
            $old_pass_valid = false;
            if ($data) {
                $old_pass_valid = password_verify($passwordlama, $data['password']) || md5($passwordlama) === $data['password'];
            }

            if ($old_pass_valid) {
                if ($passwordbaru1 == $passwordbaru2) {
                    if (strlen($passwordbaru1) < 8) {
                        echo "<div class='alert alert-danger premium-shadow'>
                                <h4><i class='fa-solid fa-triangle-exclamation me-2'></i>Gagal!</h4>
                                <p>Password baru harus minimal 8 karakter.</p>
                                <a href='?module=password' class='btn btn-danger mt-2'>
                                  <i class='fa-solid fa-rotate-left me-2'></i>Coba Lagi
                                </a>
                              </div>";
                    } else {
                        // Use password_hash for secure hashing
                        $passwordbaruenkrip = password_hash($passwordbaru1, PASSWORD_DEFAULT);
                        $stmt = mysqli_prepare($conn, "UPDATE admin SET password = ? WHERE username = ?");
                        mysqli_stmt_bind_param($stmt, "ss", $passwordbaruenkrip, $user);
                        $hasil = mysqli_stmt_execute($stmt);
                        mysqli_stmt_close($stmt);

                        if ($hasil) {
                            // Regenerate CSRF token after successful update
                            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
                            echo "<div class='alert alert-success premium-shadow'>
                                    <h4><i class='fa-solid fa-check me-2'></i>Berhasil!</h4>
                                    <p>Password berhasil diubah. Silakan login kembali dengan password baru Anda.</p>
                                    <a href='logout.php' class='btn btn-success mt-2'>
                                      <i class='fa-solid fa-right-from-bracket me-2'></i>Logout Sekarang
                                    </a>
                                  </div>";
                        }
                    }
                } else {
                    echo "<div class='alert alert-danger premium-shadow'>
                            <h4><i class='fa-solid fa-triangle-exclamation me-2'></i>Gagal!</h4>
                            <p>Password baru yang Anda masukkan tidak sama. Silakan coba lagi.</p>
                            <a href='?module=password' class='btn btn-danger mt-2'>
                              <i class='fa-solid fa-rotate-left me-2'></i>Coba Lagi
                            </a>
                          </div>";
                }
            } else {
                echo "<div class='alert alert-danger premium-shadow'>
                        <h4><i class='fa-solid fa-triangle-exclamation me-2'></i>Gagal!</h4>
                        <p>Password lama yang Anda masukkan salah. Silakan coba lagi.</p>
                        <a href='?module=password' class='btn btn-danger mt-2'>
                          <i class='fa-solid fa-rotate-left me-2'></i>Coba Lagi
                        </a>
                      </div>";
            }
            break;
    }
} else {
    echo "<div class='alert alert-danger premium-shadow text-center'>
            <h2><i class='fa-solid fa-ban me-2'></i>Akses Ditolak</h2>
            <p class='mt-3'>Anda harus login untuk dapat mengakses menu ini!</p>
            <a href='./' class='btn btn-danger mt-3'>
              <i class='fa-solid fa-right-to-bracket me-2'></i>Login Sekarang
            </a>
          </div>";
}
?>
