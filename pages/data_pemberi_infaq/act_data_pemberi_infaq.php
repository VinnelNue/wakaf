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

	if($mod == "data_pemberi_infaq" AND $act == "simpan")
	{
		//variable input
		
		$nama_pemberi= $_POST['nama_pemberi'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$nomor_telepon= $_POST['nomor_telepon'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "INSERT INTO data_pemberi_infaq(
										nama_pemberi, 
										nomor_ktp, 
										nomor_telepon, 
										alamat_ktp, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi)
									VALUES (
										'$nama_pemberi', 
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

	elseif ($mod == "data_pemberi_infaq" AND $act == "edit") 
	{
		//variable input
		$id_pemberi_infaq = trim($_POST['id']);
		$nama_pemberi= $_POST['nama_pemberi'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$nomor_telepon= $_POST['nomor_telepon'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "UPDATE data_pemberi_infaq SET 
										nama_pemberi= '$nama_pemberi', 
										nomor_ktp= '$nomor_ktp', 
										nomor_telepon= '$nomor_telepon', 
										alamat_ktp= '$alamat_ktp', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' 
					WHERE id_pemberi_infaq = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "data_pemberi_infaq" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM data_pemberi_infaq WHERE id_pemberi_infaq = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>