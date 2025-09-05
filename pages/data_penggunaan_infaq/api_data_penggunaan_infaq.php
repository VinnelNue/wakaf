<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_pemanfaatan']) ? $_REQUEST['id_pemanfaatan'] : '';
    
		$id_infaq= isset($_REQUEST['id_infaq']) ? $_REQUEST['id_infaq'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$pengunaan= isset($_REQUEST['pengunaan']) ? $_REQUEST['pengunaan'] : '' ;
		$jumlah_digunakan= isset($_REQUEST['jumlah_digunakan_raw']) ? $_REQUEST['jumlah_digunakan_raw'] : '' ;
		$pelaksana= isset($_REQUEST['pelaksana']) ? $_REQUEST['pelaksana'] : '' ;
		$keterangan= isset($_REQUEST['keterangan']) ? $_REQUEST['keterangan'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM data_penggunaan_infaq ".($key ?" WHERE id_pemanfaatan =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE data_penggunaan_infaq SET 
										id_infaq= '$id_infaq', 
										tanggal= '$tanggal', 
										pengunaan= '$pengunaan', 
										jumlah_digunakan= '$jumlah_digunakan', 
										pelaksana= '$pelaksana', 
										keterangan= '$keterangan' WHERE id_pemanfaatan = $key ";
        break;
        case 'POST': $sql = "INSERT INTO data_penggunaan_infaq( 
										id_infaq, 
										tanggal, 
										pengunaan, 
										jumlah_digunakan, 
										pelaksana, 
										keterangan) VALUES (
										'$id_infaq', 
										'$tanggal', 
										'$pengunaan', 
										'$jumlah_digunakan', 
										'$pelaksana', 
										'$keterangan')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM data_penggunaan_infaq WHERE id_pemanfaatan = $key"; 
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