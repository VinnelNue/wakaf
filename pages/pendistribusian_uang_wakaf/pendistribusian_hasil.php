<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
header("Content-Type: application/json"); // WAJIB!

session_start();
include "../../lib/conn.php";
mysqli_set_charset($conn,'utf8');

if (isset($_GET['id_pengembangan'])) {
    $id = intval($_GET['id_pengembangan']);

    $query = mysqli_query($conn, "
        SELECT jumlah_hasil_perkembangan 
        FROM pengembangan_uang_wakaf 
        WHERE id_pengembangan__uang_wakaf = $id
    ");

    if ($query && mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_assoc($query);
        echo json_encode(['jumlah' => $data['jumlah_hasil_perkembangan']]);
    } else {
        echo json_encode(['jumlah' => 0]);
    }
} else {
    echo json_encode(['jumlah' => 0]);
}
?>
