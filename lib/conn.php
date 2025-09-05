<?php
// conn.php - Hanya untuk koneksi database

// REQUIRE config.php karena sangat penting
require_once 'config.php';
$conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
if ($conn->connect_error) die("Koneksi DB gagal: ".$conn->connect_error);
$conn->set_charset("utf8mb4");


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