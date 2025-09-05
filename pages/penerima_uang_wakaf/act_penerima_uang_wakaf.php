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

	if($mod == "penerima_uang_wakaf" AND $act == "simpan")
	{
		//variable input
		
		$nama_penerima= $_POST['nama_penerima'];
		$nama_institusi_penerima= $_POST['nama_institusi_penerima'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$nomor_telepon= $_POST['nomor_telepon'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "INSERT INTO penerima_uang_wakaf(
										nama_penerima, 
										nama_institusi_penerima, 
										nomor_ktp, 
										nomor_telepon, 
										alamat_ktp, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi)
									VALUES (
										'$nama_penerima', 
										'$nama_institusi_penerima', 
										'$nomor_ktp', 
										'$nomor_telepon', 
										'$alamat_ktp', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "penerima_uang_wakaf" AND $act == "edit") 
	{
		//variable input
		$id_penerima_manfaat_wakaf = trim($_POST['id']);
		$nama_penerima= $_POST['nama_penerima'];
		$nama_institusi_penerima= $_POST['nama_institusi_penerima'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$nomor_telepon= $_POST['nomor_telepon'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "UPDATE penerima_uang_wakaf SET 
										nama_penerima= '$nama_penerima', 
										nama_institusi_penerima= '$nama_institusi_penerima', 
										nomor_ktp= '$nomor_ktp', 
										nomor_telepon= '$nomor_telepon', 
										alamat_ktp= '$alamat_ktp', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' 
					WHERE id_penerima_manfaat_wakaf = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "penerima_uang_wakaf" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM penerima_uang_wakaf WHERE id_penerima_manfaat_wakaf = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>