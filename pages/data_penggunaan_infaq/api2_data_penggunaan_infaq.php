<?php
header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
  					$penggunaan = "SELECT d.*, p.id_infaq
    		     FROM penerimaan_infaq AS p
				 LEFT JOIN data_penggunaan_infaq as d
				 ON p.id_infaq = d.id_infaq";
				$query = "SELECT * FROM data_penggunaan_infaq ";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    
    if($data) {
        echo '
        	<div class="col-xs-12">
         <div class="box">
        <div class="box-body">
        <thead>
                <table class="table table-striped">
                    <tr>
                    <th>Nama Wakif</th>
                     <th>Nomor Telepon Wakif</th>
                     <th>Nomor KTP Wakif</th>
                    </tr>
        </thead>
    <tbody>
    <tr>    
    <td>'.$data['nama_wakif'].'</td>  
    <td>'.$data['nomor_telepon_wakif'].'</td>   
    <td>'.$data['nomor_ktp_wakif'].'</td>
         </tr>
            </tbody>
            </div>
        </div>
        </div>
</div>

           <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                  <tr><th>Nama Ahli Waris </th><td>'.$data['nama_ahlih_waris'].'</td></tr>
                  <tr><th>Hubungan Keluarga</th><td>'.$data['hubungan_keluarga'].'</td></tr>
                    <tr><th>Nomor telepon penerima ahli waris </th><td>'.$data['nomor_telepon_penerimawak'].'</td></tr>
                    <tr><th>Alamat sesuai KTP</th><td>'.$data['alamat_ktp'].'</td></tr>
                    <tr><th>Desa/Kelurahan</th><td>'.$data['desa_kelurahan'].'</td></tr>
                    <tr><th>kecamatan</th><td>'.$data['kecamatan'].'</td></tr>
                </table>
            </div>
            </div>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <tr><th>Kabupaten/Kota</th><td>'.$data['kabupaten_kota'].'</td></tr>
                    <tr><th>Kode Pos</th><td>'.$data['kode_pos'].'</td></tr>
                    <tr><th>Provinsi</th><td>'.$data['provinsi'].'</td></tr>
                </table>
            </div>
            </div>
        </div>';
    } else {
        echo '<div class="alert alert-warning">Data tidak ditemukan</div>';
    }
    exit;
}