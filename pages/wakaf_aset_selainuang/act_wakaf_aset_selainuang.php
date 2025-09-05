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

	if($mod == "wakaf_aset_selainuang" AND $act == "simpan")
	{
		//variable input
		
		$id_wakif= $_POST['id_wakif'];
		$tanggal= $_POST['tanggal'];
		$jenis_asset_bergerak= $_POST['jenis_asset_bergerak'];
		$jumlah_nilai= $_POST['jumlah_nilai'];
		$waktu= $_POST['waktu'];
		$bila_muaqot= $_POST['bila_muaqot'];
		$penerima_manfaat= $_POST['penerima_manfaat'];
		$detail_penerima_manfaat= $_POST['detail_penerima_manfaat'];
		$bila_muaqot = !empty($_POST['bila_muaqot']) ? $_POST['bila_muaqot'] : 'NULL';


		mysqli_query($conn, "INSERT INTO wakaf_aset_selainuang(
										id_wakif, 
										tanggal, 
										jenis_asset_bergerak, 
										jumlah_nilai, 
										waktu, 
										bila_muaqot, 
										penerima_manfaat, 
										detail_penerima_manfaat)
									VALUES (
										'$id_wakif', 
										'$tanggal', 
										'$jenis_asset_bergerak', 
										'$jumlah_nilai', 
										'$waktu', 
										" .($bila_muaqot == 'NULL' ? 'NULL' : "'$bila_muaqot'") . ",
										'$penerima_manfaat', 
										'$detail_penerima_manfaat')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakaf_aset_selainuang" AND $act == "edit") 
	{
		//variable input
		$id_wakafselainuang = trim($_POST['id']);
		$id_wakif= $_POST['id_wakif'];
		$tanggal= $_POST['tanggal'];
		$jenis_asset_bergerak= $_POST['jenis_asset_bergerak'];
		$jumlah_nilai= $_POST['jumlah_nilai'];
		$waktu= $_POST['waktu'];
		$bila_muaqot= $_POST['bila_muaqot'];
		$penerima_manfaat= $_POST['penerima_manfaat'];
		$detail_penerima_manfaat= $_POST['detail_penerima_manfaat'];

		$bila_muaqot = !empty($_POST['bila_muaqot']) ? $_POST['bila_muaqot'] : 'NULL';


		mysqli_query($conn, "UPDATE wakaf_aset_selainuang SET 
										id_wakif= '$id_wakif', 
										tanggal= '$tanggal', 
										jenis_asset_bergerak= '$jenis_asset_bergerak', 
										jumlah_nilai= '$jumlah_nilai', 
										waktu= '$waktu', 
									    bila_muaqot = " .($bila_muaqot == 'NULL' ? 'NULL' : "'$bila_muaqot'") . ",
            							penerima_manfaat= '$penerima_manfaat', 
										detail_penerima_manfaat= '$detail_penerima_manfaat' 
					WHERE id_wakafselainuang = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakaf_aset_selainuang" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM wakaf_aset_selainuang WHERE id_wakafselainuang = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>