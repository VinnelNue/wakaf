<?php
    include "../../lib/conn.php";
    
if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
$query = "SELECT p.*, u.*, w.nama_wakif, w.nomor_telepon_wakif, w.nomor_ktp_wakif, d.nama_nazir
          FROM pengembangan_uang_wakaf AS p
          LEFT JOIN uang_wakaf u ON p.id_uang_wakaf = u.id_uang_wakaf
          LEFT JOIN wakif w ON u.id_wakif = w.id_wakif
          LEFT JOIN data_nazir d ON u.id_nazir = d.id_nazir
          WHERE p.id_pengembangan__uang_wakaf = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '
    <div class="table-responsive">
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
      <tr><th>PENERIMA MANFAAT</th><td class="penerima-manfaat">'.$data['detail_penerima_manfaat'].'</td></tr>
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
  </div>

<!-- untuk popup pengembangan-->
<div class="modal-body-content">
   <h4 class="section-title">Informasi Pengembangan</h4>
    <table class="table table-bordered info-table">
                <thead class="thead-light">
                    <tr>
    <th>INSTRUMENT PENGEMBANGAN</th>
    <th>INSTITUSI PENGELOLA</th>
    <th>JUMLAH UANG</th>
    <th>TANGGAL MULAI</th>
    <th>TANGGAL BERAKHIR</th>
    <th>PERSENTASE PENGEMBANGAN</th>
    <th>HASIL PERKEMBANGAN</th>               
     </tr>
      </thead>
      <tbody>
      <tr>
          
    <td>'.$data['instrument_pengembangan'].'</td>
    <td>'.$data['institusi_pengelola'].'</td>
    <td>Rp ' . number_format($data['jumlah_uang'], 0, ',', '.') . '</td>
    <td>'.$data['tanggal_mulai'].'</td>
    <td>'.$data['tanggal_berakhir'].'</td>
    '?><?php echo'<td>' . number_format($data['persentase_hasil_pengembangan'], 2, ',', '.') . '%</td>' ?><?php echo'
    <td>Rp ' . number_format($data['jumlah_hasil_perkembangan'], 0, ',', '.') . '</td>
    </tr>
  </div>
  </div>
</div>
';
}
/*  <h4 class="section-title">Informasi Pengembangan</h4>
  <table class="table table-bordered info-table">
    <tr><th>INSTRUMENT PENGEMBANGAN</th>
    <th>INSTITUSI PENGELOLA</th>
    <th>JUMLAH UANG</th>
    <th>TANGGAL MULAI</th>
    <th>TANGGAL BERAKHIR</th>
    <th>PERSENTASE PENGEMBANGAN</th>
    <th>HASIL PERKEMBANGAN</th>
    
    <td>'.$data['instrument_pengembangan'].'</td>
    <td>'.$data['institusi_pengelola'].'</td>
    <td>Rp ' . number_format($data['jumlah_uang'], 0, ',', '.') . '</td>
    <td>'.$data['tanggal_mulai'].'</td>
    <td>'.$data['tanggal_berakhir'].'</td>
    <td>'.$data['persentase_hasil_pengembangan'].'%</td>
    <td>Rp ' . number_format($data['jumlah_hasil_perkembangan'], 0, ',', '.') . '</td>
    </table>
</div>
*/