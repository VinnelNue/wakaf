<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_wakif']) ? $_REQUEST['id_wakif'] : '';
    
		$nama_wakif= isset($_REQUEST['nama_wakif']) ? $_REQUEST['nama_wakif'] : '' ;
		$nomor_ktp_wakif= isset($_REQUEST['nomor_ktp_wakif']) ? $_REQUEST['nomor_ktp_wakif'] : '' ;
		$nomor_telepon_wakif= isset($_REQUEST['nomor_telepon_wakif']) ? $_REQUEST['nomor_telepon_wakif'] : '' ;
		$alamat_kk= isset($_REQUEST['alamat_kk']) ? $_REQUEST['alamat_kk'] : '' ;
		$desa_kelurahan= isset($_REQUEST['desa_kelurahan']) ? $_REQUEST['desa_kelurahan'] : '' ;
		$kecamatan= isset($_REQUEST['kecamatan']) ? $_REQUEST['kecamatan'] : '' ;
		$kabupaten_kota= isset($_REQUEST['kabupaten_kota']) ? $_REQUEST['kabupaten_kota'] : '' ;
		$kode_pos= isset($_REQUEST['kode_pos']) ? $_REQUEST['kode_pos'] : '' ;
		$provinsi= isset($_REQUEST['provinsi']) ? $_REQUEST['provinsi'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM wakif ".($key ?" WHERE id_wakif =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE wakif SET 
										nama_wakif= '$nama_wakif', 
										nomor_ktp_wakif= '$nomor_ktp_wakif', 
										nomor_telepon_wakif= '$nomor_telepon_wakif', 
										alamat_kk= '$alamat_kk', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' WHERE id_wakif = $key ";
        break;
        case 'POST': $sql = "INSERT INTO wakif( 
										nama_wakif, 
										nomor_ktp_wakif, 
										nomor_telepon_wakif, 
										alamat_kk, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi) VALUES (
										'$nama_wakif', 
										'$nomor_ktp_wakif', 
										'$nomor_telepon_wakif', 
										'$alamat_kk', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM wakif WHERE id_wakif = $key"; 
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