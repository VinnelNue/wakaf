<?php
header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    $query = "SELECT a.*, w.nama_wakif,w.nomor_ktp_wakif,w.nomor_telepon_wakif
              FROM ahli_waris a 
              LEFT JOIN wakif w ON a.id_wakif = w.id_wakif 
              WHERE a.id_ahli_waris = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '
<div class="modal-body-content">
  <h4 class="section-title">Informasi Wakif</h4>
  <table class="table table-bordered info-table">
    <tr><th>Nama Wakif</th><td>'.$data['nama_wakif'].'</td></tr>
    <tr><th>Nomor Telepon Wakif</th><td>'.$data['nomor_telepon_wakif'].'</td></tr>
    <tr><th>Nomor KTP Wakif</th><td>'.$data['nomor_ktp_wakif'].'</td></tr>
  </table>

  <h4 class="section-title">Informasi Ahli Waris</h4>
  <table class="table table-bordered info-table">
    <tr><th>Nama Ahli Waris</th><td>'.$data['nama_ahlih_waris'].'</td></tr>
    <tr><th>Hubungan Keluarga</th><td>'.$data['hubungan_keluarga'].'</td></tr>
    <tr><th>No. Telepon Penerima</th><td>'.$data['nomor_telepon_penerimawak'].'</td></tr>
    <tr><th>Alamat sesuai KTP</th><td>'.$data['alamat_ktp'].'</td></tr>
    <tr><th>Desa/Kelurahan</th><td>'.$data['desa_kelurahan'].'</td></tr>
    <tr><th>Kecamatan</th><td>'.$data['kecamatan'].'</td></tr>
    <tr><th>Kabupaten/Kota</th><td>'.$data['kabupaten_kota'].'</td></tr>
    <tr><th>Kode Pos</th><td>'.$data['kode_pos'].'</td></tr>
    <tr><th>Provinsi</th><td>'.$data['provinsi'].'</td></tr>
  </table>
</div>';

}