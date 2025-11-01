<?php
if(isset($_POST['contactFrmSubmit']) && $_POST['contactFrmSubmit'] == 1){ // Cek apakah form telah disubmit
    $nama = $_POST['nama']; // Ambil nama dari form
    $email = $_POST['email']; // Ambil email dari form
    $pesan = $_POST['pesan']; // Ambil pesan dari form

    $to = 'galang.putra.maulana19@mhs.ubharajaya.ac.id'; // Email tujuan
    $subject = 'Pesan Kontak dari ' . $nama; // Subjek email
    $htmlContent = "<h2>Pesan Kontak</h2><p><b>Nama: </b>".$nama."</p><p><b>Email: </b>".$email."</p><p><b>Pesan: </b>".$pesan."</p>"; // Konten email dalam format HTML

    $headers = "MIME-Version: 1.0" . "\r\n"; // Header untuk versi MIME
    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n"; // Header untuk konten HTML
    $headers .= 'From: '.$nama.'<'.$email.'>' . "\r\n"; // Header tambahan untuk pengirim

    if(mail($to, $subject, $htmlContent, $headers)){ // Kirim email
        echo 'ok'; // Tampilkan 'ok' jika email berhasil dikirim
    }else{
        echo 'err'; // Tampilkan 'err' jika email gagal dikirim
    }
}
?>
