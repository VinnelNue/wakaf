<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_pendistribusian_uangwakaf']) ? $_REQUEST['id_pendistribusian_uangwakaf'] : '';
    
		$id_pengembangan__uang_wakaf= isset($_REQUEST['id_pengembangan__uang_wakaf']) ? $_REQUEST['id_pengembangan__uang_wakaf'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$penerima_manfaat_wakaf= isset($_REQUEST['penerima_manfaat_wakaf']) ? $_REQUEST['penerima_manfaat_wakaf'] : '' ;
		$besar_manfaat_wakafditerima= isset($_REQUEST['besar_manfaat_wakafditerimaraw']) ? $_REQUEST['besar_manfaat_wakafditerimaraw'] : '' ;
		$tujuan_pengunaan_wakaf_uang= isset($_REQUEST['tujuan_pengunaan_wakaf_uang']) ? $_REQUEST['tujuan_pengunaan_wakaf_uang'] : '' ;
		$petugas_pelaksana= isset($_REQUEST['petugas_pelaksana']) ? $_REQUEST['petugas_pelaksana'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM pendistribusian_uang_wakaf ".($key ?" WHERE id_pendistribusian_uangwakaf =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE pendistribusian_uang_wakaf SET 
										id_pengembangan__uang_wakaf= '$id_pengembangan__uang_wakaf', 
										tanggal= '$tanggal', 
										penerima_manfaat_wakaf= '$penerima_manfaat_wakaf', 
										besar_manfaat_wakafditerima= '$besar_manfaat_wakafditerima', 
										tujuan_pengunaan_wakaf_uang= '$tujuan_pengunaan_wakaf_uang', 
										petugas_pelaksana= '$petugas_pelaksana' WHERE id_pendistribusian_uangwakaf = $key ";
        break;
        case 'POST': $sql = "INSERT INTO pendistribusian_uang_wakaf( 
										id_pengembangan__uang_wakaf, 
										tanggal, 
										penerima_manfaat_wakaf, 
										besar_manfaat_wakafditerima, 
										tujuan_pengunaan_wakaf_uang, 
										petugas_pelaksana) VALUES (
										'$id_pengembangan__uang_wakaf', 
										'$tanggal', 
										'$penerima_manfaat_wakaf', 
										'$besar_manfaat_wakafditerima', 
										'$tujuan_pengunaan_wakaf_uang', 
										'$petugas_pelaksana')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM pendistribusian_uang_wakaf WHERE id_pendistribusian_uangwakaf = $key"; 
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