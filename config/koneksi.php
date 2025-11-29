<?php
    // Database configuration - can be overridden by environment variables for hosting
    $server = getenv('DB_HOST') ?: "localhost";
    $username = getenv('DB_USER') ?: "root";
    $password = getenv('DB_PASSWORD') ?: "";
    $database = getenv('DB_NAME') ?: "dignet";

    $conn = mysqli_connect($server, $username, $password, $database);

   /* if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        echo "Koneksi berhasil";
    }*/
?> 
