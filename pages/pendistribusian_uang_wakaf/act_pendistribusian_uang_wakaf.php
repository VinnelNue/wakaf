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

	if($mod == "pendistribusian_uang_wakaf" AND $act == "simpan")
	{
		//variable input
		
		$id_pengembangan__uang_wakaf= $_POST['id_pengembangan__uang_wakaf'];
		$tanggal= $_POST['tanggal'];
		$id_penerima_manfaat_wakaf= $_POST['id_penerima_manfaat_wakaf'];
		$besar_manfaat_wakafditerima= $_POST['besar_manfaat_wakafditerimaraw'];
		$tujuan_pengunaan_wakaf_uang= $_POST['tujuan_pengunaan_wakaf_uang'];
		$petugas_pelaksana= $_POST['petugas_pelaksana'];

		mysqli_query($conn, "INSERT INTO pendistribusian_uang_wakaf(
										id_pengembangan__uang_wakaf, 
										tanggal, 
										id_penerima_manfaat_wakaf, 
										besar_manfaat_wakafditerima, 
										tujuan_pengunaan_wakaf_uang, 
										petugas_pelaksana)
									VALUES (
										'$id_pengembangan__uang_wakaf', 
										'$tanggal', 
										'$id_penerima_manfaat_wakaf', 
										'$besar_manfaat_wakafditerima', 
										'$tujuan_pengunaan_wakaf_uang', 
										'$petugas_pelaksana')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pendistribusian_uang_wakaf" AND $act == "edit") 
	{
		//variable input
		$id_pendistribusian_uangwakaf = trim($_POST['id']);
		$id_pengembangan__uang_wakaf= $_POST['id_pengembangan__uang_wakaf'];
		$tanggal= $_POST['tanggal'];
		$id_penerima_manfaat_wakaf= $_POST['id_penerima_manfaat_wakaf'];
		$besar_manfaat_wakafditerima= $_POST['besar_manfaat_wakafditerimaraw'];
		$tujuan_pengunaan_wakaf_uang= $_POST['tujuan_pengunaan_wakaf_uang'];
		$petugas_pelaksana= $_POST['petugas_pelaksana'];

		mysqli_query($conn, "UPDATE pendistribusian_uang_wakaf SET 
										id_pengembangan__uang_wakaf= '$id_pengembangan__uang_wakaf', 
										tanggal= '$tanggal', 
										id_penerima_manfaat_wakaf= '$id_penerima_manfaat_wakaf', 
										besar_manfaat_wakafditerima= '$besar_manfaat_wakafditerima', 
										tujuan_pengunaan_wakaf_uang= '$tujuan_pengunaan_wakaf_uang', 
										petugas_pelaksana= '$petugas_pelaksana' 
					WHERE id_pendistribusian_uangwakaf = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "pendistribusian_uang_wakaf" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM pendistribusian_uang_wakaf WHERE id_pendistribusian_uangwakaf = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>