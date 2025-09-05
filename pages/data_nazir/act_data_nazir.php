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

	if($mod == "data_nazir" AND $act == "simpan")
	{
		//variable input
		
		$nama_nazir= $_POST['nama_nazir'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$tempat_lahir= $_POST['tempat_lahir'];
		$tanggal_lahir= $_POST['tanggal_lahir'];
		$agama= $_POST['agama'];
		$pekerjaan= $_POST['pekerjaan'];
		$jabatan= $_POST['jabatan'];
		$kewarganegaraan= $_POST['kewarganegaraan'];
		$alamat= $_POST['alamat'];
		$desa= $_POST['desa'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten= $_POST['kabupaten'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "INSERT INTO data_nazir(
										nama_nazir, 
										nomor_ktp, 
										tempat_lahir, 
										tanggal_lahir, 
										agama, 
										pekerjaan, 
										jabatan, 
										kewarganegaraan, 
										alamat, 
										desa, 
										kecamatan, 
										kabupaten, 
										kode_pos, 
										provinsi)
									VALUES (
										'$nama_nazir', 
										'$nomor_ktp', 
										'$tempat_lahir', 
										'$tanggal_lahir', 
										'$agama', 
										'$pekerjaan', 
										'$jabatan', 
										'$kewarganegaraan', 
										'$alamat', 
										'$desa', 
										'$kecamatan', 
										'$kabupaten', 
										'$kode_pos', 
										'$provinsi')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "data_nazir" AND $act == "edit") 
	{
		//variable input
		$id_nazir = trim($_POST['id']);
		$nama_nazir= $_POST['nama_nazir'];
		$nomor_ktp= $_POST['nomor_ktp'];
		$tempat_lahir= $_POST['tempat_lahir'];
		$tanggal_lahir= $_POST['tanggal_lahir'];
		$agama= $_POST['agama'];
		$pekerjaan= $_POST['pekerjaan'];
		$jabatan= $_POST['jabatan'];
		$kewarganegaraan= $_POST['kewarganegaraan'];
		$alamat= $_POST['alamat'];
		$desa= $_POST['desa'];
		$kecamatan= $_POST['kecamatan'];
		$kabupaten= $_POST['kabupaten'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];

		mysqli_query($conn, "UPDATE data_nazir SET 
										nama_nazir= '$nama_nazir', 
										nomor_ktp= '$nomor_ktp', 
										tempat_lahir= '$tempat_lahir', 
										tanggal_lahir= '$tanggal_lahir', 
										agama= '$agama', 
										pekerjaan= '$pekerjaan', 
										jabatan= '$jabatan', 
										kewarganegaraan= '$kewarganegaraan', 
										alamat= '$alamat', 
										desa= '$desa', 
										kecamatan= '$kecamatan', 
										kabupaten= '$kabupaten', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' 
					WHERE id_nazir = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "data_nazir" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM data_nazir WHERE id_nazir = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>