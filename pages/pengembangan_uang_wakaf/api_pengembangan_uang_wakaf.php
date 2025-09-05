<?php
	header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

    $method = isset($_POST['_METHOD']) ? $_POST['_METHOD'] : $_SERVER['REQUEST_METHOD'];

    $key = isset($_REQUEST['id_pengembangan__uang_wakaf']) ? $_REQUEST['id_pengembangan__uang_wakaf'] : '';
    
		$id_uang_wakaf= isset($_REQUEST['id_uang_wakaf']) ? $_REQUEST['id_uang_wakaf'] : '' ;
		$instrument_pengembangan= isset($_REQUEST['instrument_pengembangan']) ? $_REQUEST['instrument_pengembangan'] : '' ;
		$institusi_pengelola= isset($_REQUEST['institusi_pengelola']) ? $_REQUEST['institusi_pengelola'] : '' ;
		$jumlah_uang= isset($_REQUEST['jumlah_uang_raw']) ? $_REQUEST['jumlah_uang_raw'] : '' ;
		$tanggal_mulai= isset($_REQUEST['tanggal_mulai']) ? $_REQUEST['tanggal_mulai'] : '' ;
		$tanggal_berakhir= isset($_REQUEST['tanggal_berakhir']) ? $_REQUEST['tanggal_berakhir'] : '' ;
		$persentase_hasil_pengembangan= isset($_REQUEST['persentase_hasil_pengembangan']) ? $_REQUEST['persentase_hasil_pengembangan'] : '' ;
		$jumlah_hasil_perkembangan= isset($_REQUEST['jumlah_hasil_perkembangan_raw']) ? $_REQUEST['jumlah_hasil_perkembangan_raw'] : '' ;
        /*$sisa_saldo= isset($_REQUEST['sisa_hasil_perkembangan_raw']) ? $_REQUEST['sisa_hasil_perkembangan_raw'] : '' ;*/
  
        switch ($method) {
        case 'GET':
          $sql = "SELECT * FROM pengembangan_uang_wakaf ".($key ?" WHERE id_pengembangan__uang_wakaf =$key":''); 
        break;
        case 'PUT': $sql = "UPDATE pengembangan_uang_wakaf SET 
										id_uang_wakaf= '$id_uang_wakaf', 
										instrument_pengembangan= '$instrument_pengembangan', 
										institusi_pengelola= '$institusi_pengelola', 
										jumlah_uang= '$jumlah_uang', 
										tanggal_mulai= '$tanggal_mulai', 
										tanggal_berakhir= '$tanggal_berakhir', 
										persentase_hasil_pengembangan= '$persentase_hasil_pengembangan', 
										jumlah_hasil_perkembangan= '$jumlah_hasil_perkembangan'
                                        /*sisa_saldo='$sisa_saldo'*/
                                         WHERE id_pengembangan__uang_wakaf = $key ";
        break;
        case 'POST': $sql = "INSERT INTO pengembangan_uang_wakaf( 
										id_uang_wakaf, 
										instrument_pengembangan, 
										institusi_pengelola, 
										jumlah_uang, 
										tanggal_mulai, 
										tanggal_berakhir, 
										persentase_hasil_pengembangan, 
										jumlah_hasil_perkembangan
                                        /*sisa_saldo*/) VALUES (
										'$id_uang_wakaf', 
										'$instrument_pengembangan', 
										'$institusi_pengelola', 
										'$jumlah_uang', 
										'$tanggal_mulai', 
										'$tanggal_berakhir', 
										'$persentase_hasil_pengembangan', 
										'$jumlah_hasil_perkembangan'
                                        /*'$sisa_saldo'*/)";
        break;
        case 'DELETE':
           $sql = "DELETE FROM pengembangan_uang_wakaf WHERE id_pengembangan__uang_wakaf = $key"; 
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