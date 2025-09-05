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

	if($mod == "dashboard" AND $act == "simpan")
	{
		//variable input
		
		$aaa= $_POST['aaa'];

		mysqli_query($conn, "INSERT INTO dashboard(
										aaa)
									VALUES (
										'$aaa')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "dashboard" AND $act == "edit") 
	{
		//variable input
		$id_dashboard = trim($_POST['id']);
		$aaa= $_POST['aaa'];

		mysqli_query($conn, "UPDATE dashboard SET 
										aaa= '$aaa' 
					WHERE id_dashboard = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "dashboard" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM dashboard WHERE id_dashboard = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>