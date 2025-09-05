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

	if($mod == "pemanfaatan_wakaf_asset_tetap" AND $act == "simpan")
	{
		//variable input
		
		$id_aset_tetap= $_POST['id_aset_tetap'];
		$pemanfaatan= $_POST['pemanfaatan'];
		$institusi_pengelola= $_POST['institusi_pengelola'];
		$tanggal_mulai= $_POST['tanggal_mulai'];
		$jumlah_hasil_pengembangan= $_POST['jumlah_hasil_pengembangan'];

		mysqli_query($conn, "INSERT INTO pemanfaatan_wakaf_asset_tetap(
										id_aset_tetap, 
										pemanfaatan, 
										institusi_pengelola, 
										tanggal_mulai, 
										jumlah_hasil_pengembangan)
									VALUES (
										'$id_aset_tetap', 
										'$pemanfaatan', 
										'$institusi_pengelola', 
										'$tanggal_mulai', 
										'$jumlah_hasil_pengembangan')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pemanfaatan_wakaf_asset_tetap" AND $act == "edit") 
	{
		//variable input
		$id_pemanfaatan_wakaf_tetap = trim($_POST['id']);
		$id_aset_tetap= $_POST['id_aset_tetap'];
		$pemanfaatan= $_POST['pemanfaatan'];
		$institusi_pengelola= $_POST['institusi_pengelola'];
		$tanggal_mulai= $_POST['tanggal_mulai'];
		$jumlah_hasil_pengembangan= $_POST['jumlah_hasil_pengembangan'];

		mysqli_query($conn, "UPDATE pemanfaatan_wakaf_asset_tetap SET 
										id_aset_tetap= '$id_aset_tetap', 
										pemanfaatan= '$pemanfaatan', 
										institusi_pengelola= '$institusi_pengelola', 
										tanggal_mulai= '$tanggal_mulai', 
										jumlah_hasil_pengembangan= '$jumlah_hasil_pengembangan' 
					WHERE id_pemanfaatan_wakaf_tetap = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pemanfaatan_wakaf_asset_tetap" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM pemanfaatan_wakaf_asset_tetap WHERE id_pemanfaatan_wakaf_tetap = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>