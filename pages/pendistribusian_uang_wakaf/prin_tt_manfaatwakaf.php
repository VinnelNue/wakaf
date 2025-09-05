<p><div class="box-header"><h3 class="box-title">Tanda Terima Manfaat Wakaf Uang </h3><br/></p>
<p><a href="javascript:void(0)" onclick="printDiv('printdatatt')" class="w3-text-green">
    <i class="fa fa-print w3-large">  Print Bukti Penerimaan Wakaf Uang</i>
                </a><div></p>
    <div class="modal-body-content">
  <div class="table-responsive">
    <div id="printdatatt">
<?php
header("Access-Control-Allow-Origin: *");
	session_start();
	header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE, OPTIONS");
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
$id = (int)$_GET['id'];
$query = "
SELECT 
    d.*, d.tanggal as tanggal_diterima,
    p.instrument_pengembangan, p.institusi_pengelola, p.jumlah_uang AS jumlah_pengembangan,
    p.tanggal_mulai, p.tanggal_berakhir, p.persentase_hasil_pengembangan, p.jumlah_hasil_perkembangan,
    u.tanggal AS tanggal_wakaf, u.jumlah_uang AS jumlah_wakaf, u.waktu, u.bila_muaqot_sampai_tanggal,
    u.penerima_manfaat, u.detail_penerima_manfaat, u.lks_penerima_wakaf_uang, u.nomor_sertifikat, u.sertifikat_wakaf_uang,
    w.nama_wakif, w.nomor_telepon_wakif, w.nomor_ktp_wakif,
    n.nama_nazir,

    p2.nama_penerima, p2.nama_institusi_penerima, p2.nomor_ktp as ktp_penerima, p2.nomor_telepon as nomor_penerima, 
    p2.alamat_ktp as alamat_penerima, p2.desa_kelurahan as desa_penerima, p2.kecamatan as kecamatan_penerima,
    p2.kabupaten_kota as kabupaten_penerima, p2.kode_pos as kode_penerima, p2.provinsi as provinsi_penerima

FROM pendistribusian_uang_wakaf AS d
LEFT JOIN pengembangan_uang_wakaf AS p ON d.id_pengembangan__uang_wakaf = p.id_pengembangan__uang_wakaf
LEFT JOIN uang_wakaf AS u ON p.id_uang_wakaf = u.id_uang_wakaf
LEFT JOIN wakif AS w ON u.id_wakif = w.id_wakif
LEFT JOIN data_nazir AS n ON u.id_nazir = n.id_nazir
LEFT JOIN penerima_uang_wakaf AS p2 ON d.id_penerima_manfaat_wakaf = p2.id_penerima_manfaat_wakaf
WHERE d.id_pendistribusian_uangwakaf = $id";

    $result = mysqli_query($conn, $query);
    $data = mysqli_fetch_assoc($result);
    echo '
<h4 class="section-title" align="center">Tanda Terima Manfaat Wakaf Uang</h4>
<table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0px 10px ;">
    <div class="row">
    <div class="col-xs-6">
  <h4 class="section-title">Saya yang bertanda tangan di bawah ini </h4>
  <tr><th>Penerim Manfaat Wakaf Uang</th><td>'.$data['nama_penerima'].'</td></tr>
  <tr><th>Nomor KTP</th><td>'.$data['ktp_penerima'].'</td></tr>    
  <tr><th>Nomor Telepon</th><td>'.$data['nomor_penerima'].'</td></tr>      
      <tr><th>Alamat Sesuai KTP</th><td>'.$data['alamat_penerima']. '</td></tr>
      <tr><th>Desa/Kelurahan</th><td>'.$data['desa_penerima'].'</td></tr>
      <tr><th>Kecamatan</th><td>'.$data['kecamatan_penerima'].'</td></tr>
      <tr><th>Kabupaten/Kota</th><td>'.$data['kabupaten_penerima'].'</td></tr>
      <tr><th>Kode POS</th><td>'.$data['kode_penerima'].'</td></tr>
      <tr><th>Provinsi</th><td>'.$data['provinsi_penerima'].'</td></tr>
      <tr><th>Nama Petugas Yang Menyerahkan</th><td>'.$data['petugas_pelaksana'].'</td></tr>
      </div>
</table>
<table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0px 10px ;">
 
    <h4><p>Dengan ini menerangkan bahwa pada tanggal <b>'.$data['tanggal_diterima'].' </b>saya sudah menerima penyaluran manfaat</p>
    <p>Wakaf Uang dari Yayasan Energi Amanah Sejahtera sebesar <b>Rp ' . number_format($data['jumlah_hasil_perkembangan'], 0, ',', '.') . '</b></p>
    <p>Uang tersebut akan saya gunakan untuk <b>'.$data['tujuan_pengunaan_wakaf_uang'].'</b></p>
    <p>Uang ini berasal dari pengembangan wakaf uang dari sdr.<b>'.$data['nama_wakif'].'</b></p>
    <p>Nomor Sertifikat Pengembangan <b>'.$data['nomor_sertifikat'].'</b></p>
    <p>Periode pengembangan <b>'.$data['tanggal_mulai'].'</b> Hingga <b>'.$data['tanggal_berakhir'].'</b></p>
    </h4>
    </div>
   </table>

      <br><br>
<table width="100%">
  <tr>
    <td align="center">
      <p align="center">
        <br><br><br>
        <b>Penerima</b><br><br><br>
        (___________________)<br>
        '.$data['nama_penerima'].'
      </p>
    </td>
    <td align="center">
      <p align="center">
        <br><br><br>
        <b>Petugas Pelaksana</b><br><br><br>
        (___________________)<br>
        '.$data['petugas_pelaksana'].'
      </p>
    </td>
  </tr>
</table>
 </div>
  </div> 
 </div>
';
    echo'
    <div id="detailPopuptt" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="detailContentt">
                <!-- Konten akan diisi via AJAX -->
                <div class="text-center">
                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                    <p>Loading data...</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
    ';
						
} ?>
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
            <h2 style="text-align:center;">Laporan Tanda Terima</h2>
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