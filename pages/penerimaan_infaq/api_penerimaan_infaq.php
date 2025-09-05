<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_infaq']) ? $_REQUEST['id_infaq'] : '';
    
		$id_pemberi_infaq= isset($_REQUEST['id_pemberi_infaq']) ? $_REQUEST['id_pemberi_infaq'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$jumlah_infaq_sedekah= isset($_REQUEST['jumlah_infaq_sedekah']) ? $_REQUEST['jumlah_infaq_sedekah'] : '' ;
		$tujuan_penggunaan= isset($_REQUEST['tujuan_penggunaan']) ? $_REQUEST['tujuan_penggunaan'] : '' ;
		$nama_petugas= isset($_REQUEST['nama_petugas']) ? $_REQUEST['nama_petugas'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM penerimaan_infaq ".($key ?" WHERE id_infaq =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE penerimaan_infaq SET 
										id_pemberi_infaq= '$id_pemberi_infaq', 
										tanggal= '$tanggal', 
										jumlah_infaq_sedekah= '$jumlah_infaq_sedekah', 
										tujuan_penggunaan= '$tujuan_penggunaan', 
										nama_petugas= '$nama_petugas' WHERE id_infaq = $key ";
        break;
        case 'POST': $sql = "INSERT INTO penerimaan_infaq( 
										id_pemberi_infaq, 
										tanggal, 
										jumlah_infaq_sedekah, 
										tujuan_penggunaan, 
										nama_petugas) VALUES (
										'$id_pemberi_infaq', 
										'$tanggal', 
										'$jumlah_infaq_sedekah', 
										'$tujuan_penggunaan', 
										'$nama_petugas')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM penerimaan_infaq WHERE id_infaq = $key"; 
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