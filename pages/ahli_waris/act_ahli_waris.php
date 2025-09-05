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

	if($mod == "ahli_waris" AND $act == "simpan")
	{
		//variable input
		
		$id_wakif= $_POST['id_wakif'];
		$nama_ahlih_waris= $_POST['nama_ahlih_waris'];
		$hubungan_keluarga= $_POST['hubungan_keluarga'];
		$nomor_ktp_penerimawar= $_POST['nomor_ktp_penerimawar'];
		$nomor_telepon_penerimawak= $_POST['nomor_telepon_penerimawak'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "INSERT INTO ahli_waris(
										id_wakif, 
										nama_ahlih_waris, 
										hubungan_keluarga, 
										nomor_ktp_penerimawar, 
										nomor_telepon_penerimawak, 
										alamat_ktp, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi)
									VALUES (
										'$id_wakif', 
										'$nama_ahlih_waris', 
										'$hubungan_keluarga', 
										'$nomor_ktp_penerimawar', 
										'$nomor_telepon_penerimawak', 
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

	elseif ($mod == "ahli_waris" AND $act == "edit") 
	{
		//variable input
		$id_ahli_waris = trim($_POST['id']);
		$id_wakif= $_POST['id_wakif'];
		$nama_ahlih_waris= $_POST['nama_ahlih_waris'];
		$hubungan_keluarga= $_POST['hubungan_keluarga'];
		$nomor_ktp_penerimawar= $_POST['nomor_ktp_penerimawar'];
		$nomor_telepon_penerimawak= $_POST['nomor_telepon_penerimawak'];
		$alamat_ktp= $_POST['alamat_ktp'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten_kota= $_POST['kabupaten_kota'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "UPDATE ahli_waris SET 
										id_wakif= '$id_wakif', 
										nama_ahlih_waris= '$nama_ahlih_waris', 
										hubungan_keluarga= '$hubungan_keluarga', 
										nomor_ktp_penerimawar= '$nomor_ktp_penerimawar', 
										nomor_telepon_penerimawak= '$nomor_telepon_penerimawak', 
										alamat_ktp= '$alamat_ktp', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' 
					WHERE id_ahli_waris = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "ahli_waris" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM ahli_waris WHERE id_ahli_waris = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>