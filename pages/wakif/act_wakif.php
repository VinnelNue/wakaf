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

	if($mod == "wakif" AND $act == "simpan")
	{
		//variable input
		
		$nama_wakif= $_POST['nama_wakif'];
		$nomor_ktp_wakif= $_POST['nomor_ktp_wakif'];
		$nomor_telepon_wakif= $_POST['nomor_telepon_wakif'];
		$alamat_kk= $_POST['alamat_kk'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "INSERT INTO wakif(
										nama_wakif, 
										nomor_ktp_wakif, 
										nomor_telepon_wakif, 
										alamat_kk, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi)
									VALUES (
										'$nama_wakif', 
										'$nomor_ktp_wakif', 
										'$nomor_telepon_wakif', 
										'$alamat_kk', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakif" AND $act == "edit") 
	{
		//variable input
		$id_wakif = trim($_POST['id']);
		$nama_wakif= $_POST['nama_wakif'];
		$nomor_ktp_wakif= $_POST['nomor_ktp_wakif'];
		$nomor_telepon_wakif= $_POST['nomor_telepon_wakif'];
		$alamat_kk= $_POST['alamat_kk'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "UPDATE wakif SET 
										nama_wakif= '$nama_wakif', 
										nomor_ktp_wakif= '$nomor_ktp_wakif', 
										nomor_telepon_wakif= '$nomor_telepon_wakif', 
										alamat_kk= '$alamat_kk', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' 
					WHERE id_wakif = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakif" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM wakif WHERE id_wakif = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>