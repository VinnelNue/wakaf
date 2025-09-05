<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

if (isset($_GET['id_wakif'])) {
    $id = $_GET['id_wakif'];

    $query = mysqli_query($conn, "SELECT SUM(jumlah_uang) as total FROM uang_wakaf WHERE id_wakif = '$id'");
    $data = mysqli_fetch_assoc($query);

    echo json_encode(['jumlah' => $data['total'] ?? 0]);
}
?>