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

	if($mod == "kua" AND $act == "simpan")
	{
		//variable input
		
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];
		$alamat= $_POST['alamat'];

		mysqli_query($conn, "INSERT INTO kua(
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi, 
										alamat)
									VALUES (
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi', 
										'$alamat')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "kua" AND $act == "edit") 
	{
		//variable input
		$id_kua = trim($_POST['id']);
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];
		$alamat= $_POST['alamat'];

		mysqli_query($conn, "UPDATE kua SET 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi', 
										alamat= '$alamat' 
					WHERE id_kua = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "kua" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM kua WHERE id_kua = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>