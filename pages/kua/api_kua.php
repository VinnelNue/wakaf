<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_kua']) ? $_REQUEST['id_kua'] : '';
    
		$kecamatan= isset($_REQUEST['kecamatan']) ? $_REQUEST['kecamatan'] : '' ;
		$kabupaten_kota= isset($_REQUEST['kabupaten_kota']) ? $_REQUEST['kabupaten_kota'] : '' ;
		$kode_pos= isset($_REQUEST['kode_pos']) ? $_REQUEST['kode_pos'] : '' ;
		$provinsi= isset($_REQUEST['provinsi']) ? $_REQUEST['provinsi'] : '' ;
		$alamat= isset($_REQUEST['alamat']) ? $_REQUEST['alamat'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM kua ".($key ?" WHERE id_kua =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE kua SET 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi', 
										alamat= '$alamat' WHERE id_kua = $key ";
        break;
        case 'POST': $sql = "INSERT INTO kua( 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi, 
										alamat) VALUES (
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi', 
										'$alamat')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM kua WHERE id_kua = $key"; 
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