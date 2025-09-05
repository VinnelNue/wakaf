<?php
    session_start();
    include "/../../lib/conn";
    
    if(!isset($_SESSION['login_user'])){
	header('location: ../../login.php'); // Mengarahkan ke Home Page
	}
    
    $query_wakaf_money = "SELECT SUM(jumlah_uang) AS wakaf_uang FROM uang_wakaf ";
    $result = $conn->query($query_wakaf_money);
    if($result->num_rows > 0 ) {
            $total_wakaf_uang = $result->fetch_assoc();
            echo"". number_format($total_wakaf_uang['wakaf_uang'], 0, ',', '.') . "";
        }
 
$conn->close();
?>