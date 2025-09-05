<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_aset_tetap']) ? $_REQUEST['id_aset_tetap'] : '';
    
		$id_wakif= isset($_REQUEST['id_wakif']) ? $_REQUEST['id_wakif'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$jenis_asset_tetap= isset($_REQUEST['jenis_asset_tetap']) ? $_REQUEST['jenis_asset_tetap'] : '' ;
		$luas= isset($_REQUEST['luas']) ? $_REQUEST['luas'] : '' ;
		$waktu= isset($_REQUEST['waktu']) ? $_REQUEST['waktu'] : '' ;
		$bila_muaqot_hingga= isset($_REQUEST['bila_muaqot_hingga']) ? $_REQUEST['bila_muaqot_hingga'] : '' ;
		$penerima_manfaat= isset($_REQUEST['penerima_manfaat']) ? $_REQUEST['penerima_manfaat'] : '' ;
		$surat_kepemilikan= isset($_REQUEST['surat_kepemilikan']) ? $_REQUEST['surat_kepemilikan'] : '' ;
		$no_surat_kepemilikan= isset($_REQUEST['no_surat_kepemilikan']) ? $_REQUEST['no_surat_kepemilikan'] : '' ;
		$alamat= isset($_REQUEST['alamat']) ? $_REQUEST['alamat'] : '' ;
		$desa_kelurahan= isset($_REQUEST['desa_kelurahan']) ? $_REQUEST['desa_kelurahan'] : '' ;
		$kecamatan= isset($_REQUEST['kecamatan']) ? $_REQUEST['kecamatan'] : '' ;
		$kota_kabupaten= isset($_REQUEST['kota_kabupaten']) ? $_REQUEST['kota_kabupaten'] : '' ;
		$kode_pos= isset($_REQUEST['kode_pos']) ? $_REQUEST['kode_pos'] : '' ;
		$provinsi= isset($_REQUEST['provinsi']) ? $_REQUEST['provinsi'] : '' ;
		$id_nazir= isset($_REQUEST['id_nazir']) ? $_REQUEST['id_nazir'] : '' ;
		$id_kua= isset($_REQUEST['id_kua']) ? $_REQUEST['id_kua'] : '' ;
		$akte_ikrar_wakaf= isset($_REQUEST['akte_ikrar_wakaf']) ? $_REQUEST['akte_ikrar_wakaf'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM wakaf_asettetap ".($key ?" WHERE id_aset_tetap =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE wakaf_asettetap SET 
										id_wakif= '$id_wakif', 
										tanggal= '$tanggal', 
										jenis_asset_tetap= '$jenis_asset_tetap', 
										luas= '$luas', 
										waktu= '$waktu', 
										bila_muaqot_hingga= '$bila_muaqot_hingga', 
										penerima_manfaat= '$penerima_manfaat', 
										surat_kepemilikan= '$surat_kepemilikan', 
										no_surat_kepemilikan= '$no_surat_kepemilikan', 
										alamat= '$alamat', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kota_kabupaten= '$kota_kabupaten', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi', 
										id_nazir= '$id_nazir', 
										id_kua= '$id_kua', 
										akte_ikrar_wakaf= '$akte_ikrar_wakaf' WHERE id_aset_tetap = $key ";
        break;
        case 'POST': $sql = "INSERT INTO wakaf_asettetap( 
										id_wakif, 
										tanggal, 
										jenis_asset_tetap, 
										luas, 
										waktu, 
										bila_muaqot_hingga, 
										penerima_manfaat, 
										surat_kepemilikan, 
										no_surat_kepemilikan, 
										alamat, 
										desa_kelurahan, 
										kecamatan, 
										kota_kabupaten, 
										kode_pos, 
										provinsi, 
										id_nazir, 
										id_kua, 
										akte_ikrar_wakaf) VALUES (
										'$id_wakif', 
										'$tanggal', 
										'$jenis_asset_tetap', 
										'$luas', 
										'$waktu', 
										'$bila_muaqot_hingga', 
										'$penerima_manfaat', 
										'$surat_kepemilikan', 
										'$no_surat_kepemilikan', 
										'$alamat', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kota_kabupaten', 
										'$kode_pos', 
										'$provinsi', 
										'$id_nazir', 
										'$id_kua', 
										'$akte_ikrar_wakaf')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM wakaf_asettetap WHERE id_aset_tetap = $key"; 
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