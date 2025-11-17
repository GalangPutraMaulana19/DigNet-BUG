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
if (!empty($_SESSION['username']) && !empty($_SESSION['password'])) {
    $act = $_GET['act'] ?? '';
    switch ($act) {
        default:
            echo "<div class='card premium-shadow'>
                    <div class='card-body'>
                      <form method='post' action='?module=password&act=updatepassword'>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Password Lama</label>
                          <input class='form-control' autocomplete='off' placeholder='Masukkan password lama...' type='password' name='oldPass' required />
                        </div>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Password Baru</label>
                          <input class='form-control' autocomplete='off' placeholder='Masukkan password baru...' type='password' name='newPass1' required />
                        </div>
                        <div class='mb-4'>
                          <label class='form-label'><i class='fa-solid fa-lock me-2'></i>Ulangi Password Baru</label>
                          <input class='form-control' autocomplete='off' placeholder='Ulangi password baru...' type='password' name='newPass2' required />
                        </div>
                        <div class='mt-4'>
                          <button class='btn btn-success' type='submit' name='submit'>
                            <i class='fa-solid fa-save me-2'></i>Simpan Perubahan
                          </button>
                          <a href='./' class='btn btn-secondary'>
                            <i class='fa-solid fa-xmark me-2'></i>Batal
                          </a>
                        </div>
                        <input type='hidden' name='pass' value='" . $_SESSION['password'] . "'>
                        <input type='hidden' name='nama' value='" . $_SESSION['username'] . "'>
                      </form>
                    </div>
                  </div>";
            break;

        case "updatepassword":
            include "config/koneksi.php";
            $user = $_POST['nama'];
            $passwordlama = $_POST['oldPass'];
            $passwordbaru1 = $_POST['newPass1'];
            $passwordbaru2 = $_POST['newPass2'];
            $query = "SELECT * FROM admin WHERE username = '$user'";
            $hasil = mysqli_query($conn, $query);
            $data = mysqli_fetch_array($hasil);

            if ($data['password'] == md5($passwordlama)) {
                if ($passwordbaru1 == $passwordbaru2) {
                    $passwordbaruenkrip = md5($passwordbaru1);
                    $query = "UPDATE admin SET password = '$passwordbaruenkrip' WHERE username = '$user'";
                    $hasil = mysqli_query($conn, $query);

                    if ($hasil) {
                        echo "<div class='alert alert-success premium-shadow'>
                                <h4><i class='fa-solid fa-check me-2'></i>Berhasil!</h4>
                                <p>Password berhasil diubah. Silakan login kembali dengan password baru Anda.</p>
                                <a href='logout.php' class='btn btn-success mt-2'>
                                  <i class='fa-solid fa-right-from-bracket me-2'></i>Logout Sekarang
                                </a>
                              </div>";
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
