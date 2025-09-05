<?php
    include "../../lib/conn.php";
    SESSION_START();
if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
$query = "SELECT d.*, p.*, d_i.nama_pemberi, d_i.nomor_telepon, d_i.nomor_ktp
          FROM data_penggunaan_infaq AS d
          LEFT JOIN penerimaan_infaq p ON d.id_infaq = p.id_infaq
          LEFT JOIN data_pemberi_infaq d_i ON p.id_pemberi_infaq = d_i.id_pemberi_infaq
          WHERE d.id_pemanfaatan = $id";
    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '
<h4 class="section-title">Informasi Pemberi Infaq</h4>
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
        <td>'.$data['nama_pemberi'].'</td>
        <td>'.$data['nomor_telepon'].'</td>
        <td>'.$data['nomor_ktp'].'</td>
    </tr>
  </tbody>
</table>

<h4 class="section-title">Informasi Pemberi Infaq</h4>
<div class="row">
  <!-- KIRI -->
  <div class="col-md-6">
  <table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
      <tr><th>TANGGAL</th><td>'.$data['tanggal'].'</td></tr>
      <tr><th>JUMLAH INFAQ SEDEKAH</th><td>RP'. number_format($data['jumlah_infaq_sedekah'], 0, ',', '.').'</td></tr>
      <tr><th>TUJUAN PENGUNAAN</th><td class="penerima-manfaat">'.$data['tujuan_penggunaan'].'</td></tr>
      <tr><th>NAMA PETUGAS</th><td>'.$data['nama_petugas'].'</td></tr>'?>
      <?php if ($_SESSION['level'] === 'admin'){
        echo'<tr><th>CREATED AT</th><td>'.$data['created_at'].'</td></tr>
             <tr><th>UPDATE AT</th><td>'.$data['updated_at'].'</td></tr>';
      } else {
        echo'';
      }
        
        ?>
      <?php echo'
      
    </table>
  </div>
  </div>

<!-- untuk popup pengembangan-->
<div class="modal-body-content">
  <div class="table-responsive">
   <h4 class="section-title">Informasi Pengunaan Infaq</h4>
    <table class="table table-bordered info-table">
                <thead class="thead-light">
                    <tr>
    <th>Tanggal</th>
    <th>Pengunaan</th>
    <th>Jumlah digunakan</th>
    <th>Pelaksana</th>
    <th>Keterangan</th>
    '?>
    <?php if ($_SESSION['level'] === 'admin'){
        echo'<th>Created at</th>
             <th>Update at</th>';
    } else {
        echo'';
    }
    ?>
    <?php echo'
     </tr>
      </thead>
      <tbody>
      <tr>
          
    <td>'.$data['tanggal'].'</td>
    <td>'.$data['pengunaan'].'</td>
    <td>Rp ' . number_format($data['jumlah_digunakan'], 0, ',', '.') . '</td>
    <td>'.$data['pelaksana'].'</td>
    <td>'.$data['keterangan'].'</td>
    '?><?php
    if ($_SESSION['level'] === 'admin'){
        echo'<td>'.$data['created_at'].'</td>
             <td>'.$data['updated_at'].'</td>';
    } else{
        echo'';
    }
    ?><?php echo'
    </tr>
  </div>
  </div>

';
}