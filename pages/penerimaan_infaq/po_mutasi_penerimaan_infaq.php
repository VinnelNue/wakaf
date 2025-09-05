
<div class="modal-header">
    <a href="javascript:void(0)" onclick='printDiv("printpenerimaaninfaq")' class="w3-text-green">
   <i class="fa fa-print w3-large"></i>Print Bukti Penerimaan Infaq
</a>
</div>
<div class="col-xs-12">
  <div class="box-body" >
    <div class="box-header">
      <center><h4 class="section-title"><u>TANDA TERIMA INFAQ</u></h4></center><br/>
    </div>
<?php
header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: GET");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');
if (isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];

 $query = "SELECT p.*, d.nama_pemberi, d.nomor_ktp, d.nomor_telepon, d.alamat_ktp, 
                     d.desa_kelurahan, d.kecamatan, d.kabupaten_kota, d.kode_pos, d.provinsi
              FROM penerimaan_infaq AS p
              LEFT JOIN data_pemberi_infaq AS d 
              ON p.id_pemberi_infaq = d.id_pemberi_infaq
              WHERE p.id_infaq = $id"; 


    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);

 echo '<div id="printpenerimaaninfaq">
    <div class="box-body">
      <p>Yang bertanda tangan di bawah ini menerangkan bahwa pada tanggal <b>'.$data['tanggal'].'</b> telah </p>
      <p>menerima infaq sebesar  :  <b>Rp '.number_format($data['jumlah_infaq_sedekah'], 0, ',', '.').'</b></p>

      <p>Digunakan untuk : <b>'.$data['tujuan_penggunaan'].'</b></p>
      <hr>

      <h4><u>Data Pemberi Infaq</u></h4>
      <table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
        <tr><th>Nama</th><td>'.$data['nama_pemberi'].'</td></tr>
        <tr><th>Nomor KTP</th><td>'.$data['nomor_ktp'].'</td></tr>
        <tr><th>Nomor Telepon</th><td>'.$data['nomor_telepon'].'</td></tr>
        <tr><th>Alamat KTP</th><td>'.$data['alamat_ktp'].'</td></tr>
        <tr><th>Desa/Kelurahan</th><td>'.$data['desa_kelurahan'].'</td></tr>
        <tr><th>Kecamatan</th><td>'.$data['kecamatan'].'</td></tr>
        <tr><th>Kabupaten/Kota</th><td>'.$data['kabupaten_kota'].'</td></tr>
        <tr><th>Kode POS</th><td>'.$data['kode_pos'].'</td></tr>
        <tr><th>Provinsi</th><td>'.$data['provinsi'].'</td></tr>
      </table>
      <br>
  </div>
      <h4><u>Data Petugas</u></h4>
      <p>Nama Petugas Penerima : <b>'.$data['nama_petugas'].'</b></p>
';
 }
 ?>

      <br><br>
      <table width="100%">
        <tr>
          <td align="center">
             <p align="center" >
            <br><br><br>
            <b>Pemberi Infaq</b><br><br><br>
            (___________________)
          </p></td>
          <td align="center">
            <p align="center">
              <br><br><br>
            <b>Petugas Penerima</b><br><br><br>
            (___________________)
</p></td>
        </tr>
      </table>
    </div>
  </div>
</div>
</div>

<script>

function printDiv(divId) {
    var content = document.getElementById(divId).innerHTML;

    var win = window.open('', '', 'width=1024,height=768');
    win.document.write(`
        <html>
        <head>
            <style>
@page {
    size: A4;
    margin: 15mm;
}

body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    font-size: 12px;
    color: #000;
}

.print-container {
    width: 100%;
    margin: auto;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    table-layout: fixed;
}

th, td {
    border: 1px solid #000;
    padding: 6px 8px;
    text-align: left;
    word-wrap: break-word;
    vertical-align: top;
}

th {
    background-color: #e4e7ff;
    font-weight: bold;
    width: 35%;
}

.no-print {
    display: none;
}

@media print {
    .box-body {
        overflow: visible !important;
    }
}

            </style>
        </head>
        <body>
            <h2 style="text-align:center;">Laporan Data Penerimaan Infaq</h2>
            ${content}
        </body>
        </html>
    `);
    win.document.close();
    win.focus();
    win.print();
    win.close();
}

</script>