<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_nazir']) ? $_REQUEST['id_nazir'] : '';
    
		$nama_nazir= isset($_REQUEST['nama_nazir']) ? $_REQUEST['nama_nazir'] : '' ;
		$nomor_ktp= isset($_REQUEST['nomor_ktp']) ? $_REQUEST['nomor_ktp'] : '' ;
		$tempat_lahir= isset($_REQUEST['tempat_lahir']) ? $_REQUEST['tempat_lahir'] : '' ;
		$tanggal_lahir= isset($_REQUEST['tanggal_lahir']) ? $_REQUEST['tanggal_lahir'] : '' ;
		$agama= isset($_REQUEST['agama']) ? $_REQUEST['agama'] : '' ;
		$pekerjaan= isset($_REQUEST['pekerjaan']) ? $_REQUEST['pekerjaan'] : '' ;
		$jabatan= isset($_REQUEST['jabatan']) ? $_REQUEST['jabatan'] : '' ;
		$kewarganegaraan= isset($_REQUEST['kewarganegaraan']) ? $_REQUEST['kewarganegaraan'] : '' ;
		$alamat= isset($_REQUEST['alamat']) ? $_REQUEST['alamat'] : '' ;
		$desa= isset($_REQUEST['desa']) ? $_REQUEST['desa'] : '' ;
		$kecamatan= isset($_REQUEST['kecamatan']) ? $_REQUEST['kecamatan'] : '' ;
		$kabupaten= isset($_REQUEST['kabupaten']) ? $_REQUEST['kabupaten'] : '' ;
		$kode_pos= isset($_REQUEST['kode_pos']) ? $_REQUEST['kode_pos'] : '' ;
		$provinsi= isset($_REQUEST['provinsi']) ? $_REQUEST['provinsi'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM data_nazir ".($key ?" WHERE id_nazir =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE data_nazir SET 
										nama_nazir= '$nama_nazir', 
										nomor_ktp= '$nomor_ktp', 
										tempat_lahir= '$tempat_lahir', 
										tanggal_lahir= '$tanggal_lahir', 
										agama= '$agama', 
										pekerjaan= '$pekerjaan', 
										jabatan= '$jabatan', 
										kewarganegaraan= '$kewarganegaraan', 
										alamat= '$alamat', 
										desa= '$desa', 
										kecamatan= '$kecamatan', 
										kabupaten= '$kabupaten', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' WHERE id_nazir = $key ";
        break;
        case 'POST': $sql = "INSERT INTO data_nazir( 
										nama_nazir, 
										nomor_ktp, 
										tempat_lahir, 
										tanggal_lahir, 
										agama, 
										pekerjaan, 
										jabatan, 
										kewarganegaraan, 
										alamat, 
										desa, 
										kecamatan, 
										kabupaten, 
										kode_pos, 
										provinsi) VALUES (
										'$nama_nazir', 
										'$nomor_ktp', 
										'$tempat_lahir', 
										'$tanggal_lahir', 
										'$agama', 
										'$pekerjaan', 
										'$jabatan', 
										'$kewarganegaraan', 
										'$alamat', 
										'$desa', 
										'$kecamatan', 
										'$kabupaten', 
										'$kode_pos', 
										'$provinsi')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM data_nazir WHERE id_nazir = $key"; 
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