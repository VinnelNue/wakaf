<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_pemanfaatan_wakaf_tetap']) ? $_REQUEST['id_pemanfaatan_wakaf_tetap'] : '';
    
		$id_aset_tetap= isset($_REQUEST['id_aset_tetap']) ? $_REQUEST['id_aset_tetap'] : '' ;
		$pemanfaatan= isset($_REQUEST['pemanfaatan']) ? $_REQUEST['pemanfaatan'] : '' ;
		$institusi_pengelola= isset($_REQUEST['institusi_pengelola']) ? $_REQUEST['institusi_pengelola'] : '' ;
		$tanggal_mulai= isset($_REQUEST['tanggal_mulai']) ? $_REQUEST['tanggal_mulai'] : '' ;
		$jumlah_hasil_pengembangan= isset($_REQUEST['jumlah_hasil_pengembangan']) ? $_REQUEST['jumlah_hasil_pengembangan'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM pemanfaatan_wakaf_asset_tetap ".($key ?" WHERE id_pemanfaatan_wakaf_tetap =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE pemanfaatan_wakaf_asset_tetap SET 
										id_aset_tetap= '$id_aset_tetap', 
										pemanfaatan= '$pemanfaatan', 
										institusi_pengelola= '$institusi_pengelola', 
										tanggal_mulai= '$tanggal_mulai', 
										jumlah_hasil_pengembangan= '$jumlah_hasil_pengembangan' WHERE id_pemanfaatan_wakaf_tetap = $key ";
        break;
        case 'POST': $sql = "INSERT INTO pemanfaatan_wakaf_asset_tetap( 
										id_aset_tetap, 
										pemanfaatan, 
										institusi_pengelola, 
										tanggal_mulai, 
										jumlah_hasil_pengembangan) VALUES (
										'$id_aset_tetap', 
										'$pemanfaatan', 
										'$institusi_pengelola', 
										'$tanggal_mulai', 
										'$jumlah_hasil_pengembangan')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM pemanfaatan_wakaf_asset_tetap WHERE id_pemanfaatan_wakaf_tetap = $key"; 
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