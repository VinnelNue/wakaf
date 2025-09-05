<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_wakafselainuang']) ? $_REQUEST['id_wakafselainuang'] : '';
    
		$id_wakif= isset($_REQUEST['id_wakif']) ? $_REQUEST['id_wakif'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$jenis_asset_bergerak= isset($_REQUEST['jenis_asset_bergerak']) ? $_REQUEST['jenis_asset_bergerak'] : '' ;
		$jumlah_nilai= isset($_REQUEST['jumlah_nilai']) ? $_REQUEST['jumlah_nilai'] : '' ;
		$waktu= isset($_REQUEST['waktu']) ? $_REQUEST['waktu'] : '' ;
		$bila_muaqot= isset($_REQUEST['bila_muaqot']) ? $_REQUEST['bila_muaqot'] : '' ;
		$penerima_manfaat= isset($_REQUEST['penerima_manfaat']) ? $_REQUEST['penerima_manfaat'] : '' ;
		$detail_penerima_manfaat= isset($_REQUEST['detail_penerima_manfaat']) ? $_REQUEST['detail_penerima_manfaat'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM wakaf_aset_selainuang ".($key ?" WHERE id_wakafselainuang =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE wakaf_aset_selainuang SET 
										id_wakif= '$id_wakif', 
										tanggal= '$tanggal', 
										jenis_asset_bergerak= '$jenis_asset_bergerak', 
										jumlah_nilai= '$jumlah_nilai', 
										waktu= '$waktu', 
										bila_muaqot= '$bila_muaqot', 
										penerima_manfaat= '$penerima_manfaat', 
										detail_penerima_manfaat= '$detail_penerima_manfaat' WHERE id_wakafselainuang = $key ";
        break;
        case 'POST': $sql = "INSERT INTO wakaf_aset_selainuang( 
										id_wakif, 
										tanggal, 
										jenis_asset_bergerak, 
										jumlah_nilai, 
										waktu, 
										bila_muaqot, 
										penerima_manfaat, 
										detail_penerima_manfaat) VALUES (
										'$id_wakif', 
										'$tanggal', 
										'$jenis_asset_bergerak', 
										'$jumlah_nilai', 
										'$waktu', 
										'$bila_muaqot', 
										'$penerima_manfaat', 
										'$detail_penerima_manfaat')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM wakaf_aset_selainuang WHERE id_wakafselainuang = $key"; 
        break;
    }       
      // excecute SQL statement
      $result = mysqli_query($conn,$sql);
      
      // print results, insert id or affected row count
      if ($method == 'GET') {
		  $row = mysqli_num_rows($result);
          if ($row==0) {
              $data['status'] = 201;
              $data['msg'] = 'Data not found';
              echo json_encode($data);
          }else{
			$response = array();
			$response["data"] = array();
			while ($row = mysqli_fetch_assoc($result)) {
				$data = $row;
				array_push($response["data"], $data);
			}
			echo json_encode($response);			  
          }  
      } elseif ($method == 'POST') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Insert failed';  
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Insert successful';
          }
          echo json_encode($data);
      } elseif ($method == 'PUT') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Update failed'; 
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Update successful';
          }
          echo json_encode($data);
      } elseif ($method == 'DELETE') {
          if (!$result) {
              $data['status'] = 201;
              $data['msg'] = 'Delete failed';  
          }else{
              $data['status'] = 200;
              $data['msg'] = 'Delete successful';
          }
          echo json_encode($data);
      }
       
      // close mysql connection
      mysqli_close($conn);
?>