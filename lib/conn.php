<?php
	$host = "db";
	$user = "wakafuser";
	$pass = "wakafpass";
	$db = "wakaf";

	$base_url = "";

	//$conn = mysqli_connect($host, $user, $pass, $db) or die("Can not connect to database");
	$conn = new mysqli($host, $user, $pass, $db);

// Cek koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>