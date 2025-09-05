<?php
include "../../lib/conn.php";
header("Content-Type: application/json");

if (isset($_GET['id_infaq']) && !empty($_GET['id_infaq'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id_infaq']);

    // Cek apakah ada pengembangan terakhir
    $q = mysqli_query($conn, "
        SELECT jumlah_digunakan 
        FROM data_penggunaan_infaq 
        WHERE id_infaq = '$id' 
        ORDER BY id_pemanfaatan DESC 
        LIMIT 1
    ");

    if ($q && mysqli_num_rows($q) > 0) {
        $d = mysqli_fetch_assoc($q);
        $jumlah = $d['jumlah_digunakan'];
        echo json_encode(['jumlah' => $jumlah, 'sumber' => 'pengembangan']);
    } else {
        // Ambil dari uang_wakaf jika belum pernah dikembangkan
        $q2 = mysqli_query($conn, "
            SELECT jumlah_infaq_sedekah 
            FROM penerimaan_infaq 
            WHERE id_infaq = '$id' 
            LIMIT 1
        ");
        if ($q2 && mysqli_num_rows($q2) > 0) {
            $d2 = mysqli_fetch_assoc($q2);
            $jumlah = $d2['jumlah_infaq_sedekah'] ?? 0;
            echo json_encode(['jumlah' => $jumlah, 'sumber' => 'penerimaan infaq']);
        } else {
            echo json_encode(['jumlah' => 0, 'sumber' => 'not_found']);
        }
    }
} else {
    echo json_encode(['jumlah' => 0, 'sumber' => 'invalid']);
}

?>
