<?php
    // Database configuration - can be overridden by environment variables for hosting
    // Environment variables are validated to ensure they are non-empty strings
    // Note: Empty password is allowed for local development environments where MySQL may not require authentication
    $db_host = getenv('DB_HOST');
    $db_user = getenv('DB_USER');
    $db_pass = getenv('DB_PASSWORD');
    $db_name = getenv('DB_NAME');
    
    $server = (!empty($db_host) && is_string($db_host)) ? $db_host : "localhost";
    $username = (!empty($db_user) && is_string($db_user)) ? $db_user : "root";
    $password = ($db_pass !== false && is_string($db_pass)) ? $db_pass : "";  // Empty string if DB_PASSWORD not set
    $database = (!empty($db_name) && is_string($db_name)) ? $db_name : "dignet";

    $conn = mysqli_connect($server, $username, $password, $database);

   /* if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        echo "Koneksi berhasil";
    }*/
?> 
