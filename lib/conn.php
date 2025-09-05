<?php
require 'config.php';

$conn = @new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if ($conn->connect_errno) {
    http_response_code(500);
    echo "DB not ready: ".$conn->connect_error;
    exit;
}

echo "DB OK";
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