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

	if($mod == "penerimaan_infaq" AND $act == "simpan")
	{
		//variable input
		
		$id_pemberi_infaq= $_POST['id_pemberi_infaq'];
		$tanggal= $_POST['tanggal'];
		$jumlah_infaq_sedekah= $_POST['jumlah_infaq_sedekah_raw'];
		$tujuan_penggunaan= $_POST['tujuan_penggunaan'];
		$nama_petugas= $_POST['nama_petugas'];

		mysqli_query($conn, "INSERT INTO penerimaan_infaq(
										id_pemberi_infaq, 
										tanggal, 
										jumlah_infaq_sedekah, 
										tujuan_penggunaan, 
										nama_petugas)
									VALUES (
										'$id_pemberi_infaq', 
										'$tanggal', 
										'$jumlah_infaq_sedekah', 
										'$tujuan_penggunaan', 
										'$nama_petugas')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "penerimaan_infaq" AND $act == "edit") 
	{
		//variable input
		$id_infaq = trim($_POST['id']);
		$id_pemberi_infaq= $_POST['id_pemberi_infaq'];
		$tanggal= $_POST['tanggal'];
		$jumlah_infaq_sedekah= $_POST['jumlah_infaq_sedekah_raw'];
		$tujuan_penggunaan= $_POST['tujuan_penggunaan'];
		$nama_petugas= $_POST['nama_petugas'];

		mysqli_query($conn, "UPDATE penerimaan_infaq SET 
										id_pemberi_infaq= '$id_pemberi_infaq', 
										tanggal= '$tanggal', 
										jumlah_infaq_sedekah= '$jumlah_infaq_sedekah', 
										tujuan_penggunaan= '$tujuan_penggunaan', 
										nama_petugas= '$nama_petugas' 
					WHERE id_infaq = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	     

	elseif ($mod == "penerimaan_infaq" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM penerimaan_infaq WHERE id_infaq = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>