<?php
// conn.php - Hanya untuk koneksi database

// REQUIRE config.php karena sangat penting
require_once 'config.php';

// Buat koneksi database
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

// Cek koneksi
if ($conn->connect_error) {
    if (ENVIRONMENT === 'development') {
        die("Koneksi database gagal: " . $conn->connect_error);
    } else {
        error_log("Database connection failed: " . $conn->connect_error);
        die("Maaf, sistem sedang mengalami gangguan. Silakan coba lagi nanti.");
    }
}

// Set charset
$conn->set_charset("utf8mb4");

// Fungsi helper
function getDBConnection() {
    global $conn;
    return $conn;
}

function closeDBConnection() {
    global $conn;
    if ($conn) {
        $conn->close();
    }
}

// Auto close connection on script end
register_shutdown_function('closeDBConnection');
?>