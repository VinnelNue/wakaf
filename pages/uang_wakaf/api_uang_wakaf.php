<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_uang_wakaf']) ? $_REQUEST['id_uang_wakaf'] : '';
    
		$id_wakif= isset($_REQUEST['id_wakif']) ? $_REQUEST['id_wakif'] : '' ;
		$tanggal= isset($_REQUEST['tanggal']) ? $_REQUEST['tanggal'] : '' ;
		$jumlah_uang= isset($_REQUEST['jumlah_uang_raw']) ? $_REQUEST['jumlah_uang_raw'] : '' ;
		$waktu= isset($_REQUEST['waktu']) ? $_REQUEST['waktu'] : '' ;
		$bila_muaqot_sampai_tanggal= isset($_REQUEST['bila_muaqot_sampai_tanggal']) ? $_REQUEST['bila_muaqot_sampai_tanggal'] : '' ;
		$penerima_manfaat= isset($_REQUEST['penerima_manfaat']) ? $_REQUEST['penerima_manfaat'] : '' ;
		$detail_penerima_manfaat= isset($_REQUEST['detail_penerima_manfaat']) ? $_REQUEST['detail_penerima_manfaat'] : '' ;
		$id_nazir= isset($_REQUEST['id_nazir']) ? $_REQUEST['id_nazir'] : '' ;
		$lks_penerima_wakaf_uang= isset($_REQUEST['lks_penerima_wakaf_uang']) ? $_REQUEST['lks_penerima_wakaf_uang'] : '' ;
		$nomor_sertifikat= isset($_REQUEST['nomor_sertifikat']) ? $_REQUEST['nomor_sertifikat'] : '' ;
		$sertifikat_wakaf_uang= isset($_REQUEST['sertifikat_wakaf_uang']) ? $_REQUEST['sertifikat_wakaf_uang'] : '' ;
    switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM uang_wakaf ".($key ?" WHERE id_uang_wakaf =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE uang_wakaf SET 
										id_wakif= '$id_wakif', 
										tanggal= '$tanggal', 
										jumlah_uang= '$jumlah_uang', 
										waktu= '$waktu', 
										bila_muaqot_sampai_tanggal= '$bila_muaqot_sampai_tanggal', 
										penerima_manfaat= '$penerima_manfaat', 
										detail_penerima_manfaat= '$detail_penerima_manfaat', 
										id_nazir= '$id_nazir', 
										lks_penerima_wakaf_uang= '$lks_penerima_wakaf_uang', 
										nomor_sertifikat= '$nomor_sertifikat', 
										sertifikat_wakaf_uang= '$sertifikat_wakaf_uang' 
                                        WHERE id_uang_wakaf = $key ";
        break;
        case 'POST': $sql = "INSERT INTO uang_wakaf( 
										id_wakif, 
										tanggal, 
										jumlah_uang, 
										waktu, 
										bila_muaqot_sampai_tanggal, 
										penerima_manfaat, 
										detail_penerima_manfaat, 
										id_nazir, 
										lks_penerima_wakaf_uang, 
										nomor_sertifikat, 
										sertifikat_wakaf_uang) VALUES (
										'$id_wakif', 
										'$tanggal', 
										'$jumlah_uang', 
										'$waktu', 
										'$bila_muaqot_sampai_tanggal', 
										'$penerima_manfaat', 
										'$detail_penerima_manfaat', 
										'$id_nazir', 
										'$lks_penerima_wakaf_uang', 
										'$nomor_sertifikat', 
										'$sertifikat_wakaf_uang')";
        break;
        case 'DELETE':
           $sql = "DELETE FROM uang_wakaf WHERE id_uang_wakaf = $key"; 
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