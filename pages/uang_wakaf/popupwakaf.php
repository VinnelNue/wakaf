<?php
header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    

    $query = "SELECT u.*, w.nama_wakif, w.nomor_telepon_wakif, w.nomor_ktp_wakif, d.nama_nazir
              FROM uang_wakaf AS u
              LEFT JOIN wakif w ON u.id_wakif = w.id_wakif
              LEFT JOIN data_nazir d ON u.id_nazir = d.id_nazir
              WHERE u.id_uang_wakaf = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '
<h4 class="section-title">Informasi Wakif</h4>
<table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 10px 0;">
  <colgroup>
    <col style="width: 30%;">
    <col style="width: 30%;">
    <col style="width: 30%;">
  <thead class="thead-light">
    <tr>
      <th>Nama Wakif</th>
      <th>Nomor KTP</th>
      <th>Nomor Telepon</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>'.$data['nama_wakif'].'</td>
        <td>'.$data['nomor_telepon_wakif'].'</td>
        <td>'.$data['nomor_ktp_wakif'].'</td>
    </tr>
  </tbody>
</table>

<h4 class="section-title">Informasi Uang Wakaf</h4>
<div class="row">
  <!-- KIRI -->
  <div class="col-md-6">
  <table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
      <tr><th>TANGGAL</th><td>'.$data['tanggal'].'</td></tr>
      <tr><th>WAKTU</th><td>'.$data['waktu'].'</td></tr>
      <tr><th>PENERIMA MANFAAT</th><td>'.$data['detail_penerima_manfaat'].'</td></tr>
      <tr><th>NAMA NAZIR</th><td>'.$data['nama_nazir'].'</td></tr>
      <tr><th>LKS PENERIMA WAKAF UANG</th><td>'.$data['lks_penerima_wakaf_uang'].'</td></tr>
      <tr><th>NOMOR SERTIFIKAT</th><td>'.$data['nomor_sertifikat'].'</td></tr>
    </table>
  </div>

  <!-- KANAN -->
  <div class="col-md-6">
  <table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
      <tr><th>BILA MUAQOT SAMPAI TANGGAL</th><td>'.$data['bila_muaqot_sampai_tanggal'].'</td></tr>
      <tr><th>JUMLAH UANG</th><td>Rp ' . number_format($data['jumlah_uang'], 0, ',', '.') . '</td></tr>
      <tr>
        <th>SERTIFIKAT WAKAF UANG</th>
        <td>
          <img src="pages/uang_Wakaf/uploads_sertifikat/' . $data['sertifikat_wakaf_uang'] . '" 
               alt="File Gambar" 
               class="icon-img" 
               onerror="this.onerror=null;this.src=\'image-not-found.png\';this.alt=\'Image Not Found\';" 
               style="max-width:100px;max-height:100px;cursor:pointer"
               onclick="openModal(this.src)">
        </td>
      </tr>
    </table>
  </div>
</div>';


}
/*<div class="card">
  <div class="card-header">
    <h4 class="card-title"><b>Informasi Wakif</b></h4>
  </div>
  <div class="card-body">
    <div class="row text-center font-weight-bold">
      <div class="col-md-4">Nama Wakif</div>
      <div class="col-md-4">Nomor KTP</div>
      <div class="col-md-4">Nomor Telepon</div>
    </div>
    <div class="row text-center">
      <div class="col-md-4"> <td>'.$data['nama_wakif'].'</td></div>
      <div class="col-md-4"> <td>'.$data['nomor_telepon_wakif'].'</td></div>
      <div class="col-md-4"><td>'.$data['nomor_ktp_wakif'].'</td></div>
    </div>
  </div>
</div>*/