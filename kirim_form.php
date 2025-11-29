<?php
if(isset($_POST['contactFrmSubmit']) && $_POST['contactFrmSubmit'] == 1){ // Cek apakah form telah disubmit
    // Sanitize input to prevent email header injection
    $nama = filter_var($_POST['nama'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $pesan = filter_var($_POST['pesan'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    
    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo 'err';
        exit();
    }
    
    // Remove any newlines from name and email to prevent header injection
    $nama = str_replace(["\r", "\n", "%0a", "%0d"], '', $nama);
    $email = str_replace(["\r", "\n", "%0a", "%0d"], '', $email);

    $to = 'galang.putra.maulana19@mhs.ubharajaya.ac.id'; // Email tujuan
    $subject = 'Pesan Kontak dari ' . $nama; // Subjek email
    $htmlContent = "<h2>Pesan Kontak</h2><p><b>Nama: </b>".htmlspecialchars($nama, ENT_QUOTES, 'UTF-8')."</p><p><b>Email: </b>".htmlspecialchars($email, ENT_QUOTES, 'UTF-8')."</p><p><b>Pesan: </b>".htmlspecialchars($pesan, ENT_QUOTES, 'UTF-8')."</p>"; // Konten email dalam format HTML

    $headers = "MIME-Version: 1.0" . "\r\n"; // Header untuk versi MIME
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; // Header untuk konten HTML
    $headers .= 'From: noreply@' . $_SERVER['HTTP_HOST'] . "\r\n"; // Use server domain as sender
    $headers .= 'Reply-To: ' . $email . "\r\n"; // Set reply-to as user's email

    if(mail($to, $subject, $htmlContent, $headers)){ // Kirim email
        echo 'ok'; // Tampilkan 'ok' jika email berhasil dikirim
    }else{
        echo 'err'; // Tampilkan 'err' jika email gagal dikirim
    }
}
?>
