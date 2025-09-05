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

	if($mod == "pengembangan_uang_wakaf" AND $act == "simpan")
	{
		//variable input
		
		$id_uang_wakaf= $_POST['id_uang_wakaf'];
		$instrument_pengembangan= $_POST['instrument_pengembangan'];
		$institusi_pengelola= $_POST['institusi_pengelola'];
		$jumlah_uang= $_POST['jumlah_uang_raw'];
		$tanggal_mulai= $_POST['tanggal_mulai'];
		$tanggal_berakhir= $_POST['tanggal_berakhir'];
		$persentase_hasil_pengembangan = floatval(str_replace(',', '.', $_POST['persentase_hasil_pengembangan']));
		$jumlah_hasil_perkembangan= $_POST['jumlah_hasil_perkembangan_raw'];
		/*$sisa_saldo= $_POST['sisa_hasil_perkembangan_raw'];*/

		mysqli_query($conn, "INSERT INTO pengembangan_uang_wakaf(
										id_uang_wakaf, 
										instrument_pengembangan, 
										institusi_pengelola, 
										jumlah_uang, 
										tanggal_mulai, 
										tanggal_berakhir, 
										persentase_hasil_pengembangan, 
										jumlah_hasil_perkembangan
										/*sisa_saldo*/)
									VALUES (
										'$id_uang_wakaf', 
										'$instrument_pengembangan', 
										'$institusi_pengelola', 
										'$jumlah_uang', 
										'$tanggal_mulai', 
										'$tanggal_berakhir', 
										'$persentase_hasil_pengembangan', 
										'$jumlah_hasil_perkembangan'
										/*'$sisa_saldo'*/)") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pengembangan_uang_wakaf" AND $act == "edit") 
	{
		//variable input
		$id_pengembangan__uang_wakaf = trim($_POST['id']);
		$id_uang_wakaf= $_POST['id_uang_wakaf'];
		$instrument_pengembangan= $_POST['instrument_pengembangan'];
		$institusi_pengelola= $_POST['institusi_pengelola'];
		$jumlah_uang= $_POST['jumlah_uang_raw'];
		$tanggal_mulai= $_POST['tanggal_mulai'];
		$tanggal_berakhir= $_POST['tanggal_berakhir'];
		$persentase_hasil_pengembangan = floatval(str_replace(',', '.', $_POST['persentase_hasil_pengembangan']));
		$jumlah_hasil_perkembangan= $_POST['jumlah_hasil_perkembangan_raw'];
		/*$sisa_saldo=$_POST['sisa_hasil_perkembangan_raw'];*/

		mysqli_query($conn, "UPDATE pengembangan_uang_wakaf SET 
										id_uang_wakaf= '$id_uang_wakaf', 
										instrument_pengembangan= '$instrument_pengembangan', 
										institusi_pengelola= '$institusi_pengelola', 
										jumlah_uang= '$jumlah_uang', 
										tanggal_mulai= '$tanggal_mulai', 
										tanggal_berakhir= '$tanggal_berakhir', 
										persentase_hasil_pengembangan= '$persentase_hasil_pengembangan', 
										jumlah_hasil_perkembangan= '$jumlah_hasil_perkembangan'
										/*sisa_saldo='$sisa_saldo'*/
					WHERE id_pengembangan__uang_wakaf = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pengembangan_uang_wakaf" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM pengembangan_uang_wakaf WHERE id_pengembangan__uang_wakaf = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>