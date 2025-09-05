<?php
	if(!isset($_SESSION['login_user'])){
		header('location: login.php'); // Mengarahkan ke Home Page
	}
include __DIR__ . '/lib/conn.php';

$query = "
    SELECT 
        DATE_FORMAT(tanggal_mulai, '%M %Y') AS bulan_tahun,
        SUM(jumlah_uang * (persentase_hasil_pengembangan / 100)) AS total_untung
    FROM pengembangan_uang_wakaf
    GROUP BY YEAR(tanggal_mulai), MONTH(tanggal_mulai)
    ORDER BY YEAR(tanggal_mulai), MONTH(tanggal_mulai)
";

$result = $conn->query($query);

$labels = [];
$data = [];

while ($row = $result->fetch_assoc()) {
    $labels[] = $row['bulan_tahun'];
    $data[] = (float)$row['total_untung'];
}

header('Content-Type: application/json');
echo json_encode([
    "labels" => $labels,
    "data" => $data
]);
