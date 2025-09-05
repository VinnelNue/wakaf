<?php
	session_start();
	include "../../lib/conn.php";
	
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_GET['page']) && isset($_GET['act']))
	{
		$mod = $_GET['page'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}

	if($mod == "data_penggunaan_infaq" AND $act == "simpan")
	{
		//variable input
		
		$id_infaq= $_POST['id_infaq'];
		$tanggal= $_POST['tanggal'];
		$pengunaan= $_POST['pengunaan'];
		$jumlah_digunakan= $_POST['jumlah_digunakan_raw'];
		$pelaksana= $_POST['pelaksana'];
		$keterangan= $_POST['keterangan'];

		mysqli_query($conn, "INSERT INTO data_penggunaan_infaq(
										id_infaq, 
										tanggal, 
										pengunaan, 
										jumlah_digunakan, 
										pelaksana, 
										keterangan)
									VALUES (
										'$id_infaq', 
										'$tanggal', 
										'$pengunaan', 
										'$jumlah_digunakan', 
										'$pelaksana', 
										'$keterangan')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "data_penggunaan_infaq" AND $act == "edit") 
	{
		//variable input
		$id_pemanfaatan = trim($_POST['id']);
		$id_infaq= $_POST['id_infaq'];
		$tanggal= $_POST['tanggal'];
		$pengunaan= $_POST['pengunaan'];
		$jumlah_digunakan= $_POST['jumlah_digunakan'];
		$pelaksana= $_POST['pelaksana'];
		$keterangan= $_POST['keterangan'];

		mysqli_query($conn, "UPDATE data_penggunaan_infaq SET 
										id_infaq= '$id_infaq', 
										tanggal= '$tanggal', 
										pengunaan= '$pengunaan', 
										jumlah_digunakan= '$jumlah_digunakan', 
										pelaksana= '$pelaksana', 
										keterangan= '$keterangan' 
					WHERE id_pemanfaatan = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "data_penggunaan_infaq" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM data_penggunaan_infaq WHERE id_pemanfaatan = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>