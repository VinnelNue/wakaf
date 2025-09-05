<?php
include "../../lib/conn.php";
header('Content-Type: application/json');

$id_pengembangan = $_GET['id_pengembangan'];

$query = mysqli_query($conn, "
    SELECT 
        p.id_pengembangan,
        p.jumlah,
        n.nama_nazir
    FROM pengembangan p
    JOIN uang_wakaf uw ON p.id_uang_wakaf = uw.id_uang_wakaf
    JOIN nazir n ON uw.id_nazir = n.id_nazir
    WHERE p.id_pengembangan = '$id_pengembangan'
");

if ($data = mysqli_fetch_assoc($query)) {
    echo json_encode([
        'jumlah' => $data['jumlah'],
        'nama_nazir' => $data['nama_nazir']
    ]);
} else {
    echo json_encode([
        'jumlah' => 0,
        'nama_nazir' => ''
    ]);
}
?>
