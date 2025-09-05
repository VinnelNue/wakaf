<?php /*
include "../../lib/conn.php";
header("Content-Type: application/json");

if (isset($_GET['id_uang_wakaf']) && !empty($_GET['id_uang_wakaf'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id_uang_wakaf']);

    // Ambil langsung dari uang_wakaf (tanpa cek pengembangan)
    $q = mysqli_query($conn, "
        SELECT jumlah_uang 
        FROM uang_wakaf 
        WHERE id_uang_wakaf = '$id' 
        LIMIT 1
    ");

    if ($q && mysqli_num_rows($q) > 0) {
        $d = mysqli_fetch_assoc($q);
        $jumlah = $d['jumlah_uang'] ?? 0;
        echo json_encode(['jumlah' => $jumlah, 'sumber' => 'uang_wakaf']);
    } else {
        echo json_encode(['jumlah' => 0, 'sumber' => 'not_found']);
    }
} else {
    echo json_encode(['jumlah' => 0, 'sumber' => 'invalid']);
} */
?>
