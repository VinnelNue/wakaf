<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_usr']) ? $_REQUEST['id_usr'] : '';
    
		$id_user= isset($_REQUEST['id_user']) ? $_REQUEST['id_user'] : '' ;
		$photo_profil= isset($_REQUEST['photo_profil']) ? $_REQUEST['photo_profil'] : '' ;
		$photo_halamanlogin= isset($_REQUEST['photo_halamanlogin']) ? $_REQUEST['photo_halamanlogin'] : '' ;
		$created_at= isset($_REQUEST['created_at']) ? $_REQUEST['created_at'] : '' ;
		$updated_at= isset($_REQUEST['updated_at']) ? $_REQUEST['updated_at'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM setting ".($key ?" WHERE id_usr =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE setting SET 
										id_user= '$id_user', 
										photo_profil= '$photo_profil', 
										photo_halamanlogin= '$photo_halamanlogin', 
										created_at= '$created_at', 
										updated_at= '$updated_at' WHERE id_usr = $key ";
        break;
        case 'POST': $sql = "INSERT INTO setting( 
										id_user, 
										photo_profil, 
										photo_halamanlogin, 
										created_at, 
										updated_at) VALUES (
										'$id_user', 
										'$photo_profil', 
										'$photo_halamanlogin', 
										'$created_at', 
										'$updated_at')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM setting WHERE id_usr = $key"; 
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