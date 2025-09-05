<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_pemberi_infaq']) ? $_REQUEST['id_pemberi_infaq'] : '';
    
		$nama_pemberi= isset($_REQUEST['nama_pemberi']) ? $_REQUEST['nama_pemberi'] : '' ;
		$nomor_ktp= isset($_REQUEST['nomor_ktp']) ? $_REQUEST['nomor_ktp'] : '' ;
		$nomor_telepon= isset($_REQUEST['nomor_telepon']) ? $_REQUEST['nomor_telepon'] : '' ;
		$alamat_ktp= isset($_REQUEST['alamat_ktp']) ? $_REQUEST['alamat_ktp'] : '' ;
		$desa_kelurahan= isset($_REQUEST['desa_kelurahan']) ? $_REQUEST['desa_kelurahan'] : '' ;
		$kecamatan= isset($_REQUEST['kecamatan']) ? $_REQUEST['kecamatan'] : '' ;
		$kabupaten_kota= isset($_REQUEST['kabupaten_kota']) ? $_REQUEST['kabupaten_kota'] : '' ;
		$kode_pos= isset($_REQUEST['kode_pos']) ? $_REQUEST['kode_pos'] : '' ;
		$provinsi= isset($_REQUEST['provinsi']) ? $_REQUEST['provinsi'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM data_pemberi_infaq ".($key ?" WHERE id_pemberi_infaq =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE data_pemberi_infaq SET 
										nama_pemberi= '$nama_pemberi', 
										nomor_ktp= '$nomor_ktp', 
										nomor_telepon= '$nomor_telepon', 
										alamat_ktp= '$alamat_ktp', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kabupaten_kota= '$kabupaten_kota', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi' WHERE id_pemberi_infaq = $key ";
        break;
        case 'POST': $sql = "INSERT INTO data_pemberi_infaq( 
										nama_pemberi, 
										nomor_ktp, 
										nomor_telepon, 
										alamat_ktp, 
										desa_kelurahan, 
										kecamatan, 
										kabupaten_kota, 
										kode_pos, 
										provinsi) VALUES (
										'$nama_pemberi', 
										'$nomor_ktp', 
										'$nomor_telepon', 
										'$alamat_ktp', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kabupaten_kota', 
										'$kode_pos', 
										'$provinsi')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM data_pemberi_infaq WHERE id_pemberi_infaq = $key"; 
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