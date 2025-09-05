<p><div class="box-header">
              <h3 class="box-title">Detai Pengembangan Wakaf Uang </h3><br/></p>
<p><a href="javascript:void(0)"
                   onclick="printDiv('printdatadistribusi')"
                   class="w3-text-green">
                    <i class="fa fa-print w3-large">  Print Detail Pengembangan Wakaf Uang</i>
                </a></p>
          <div class="modal-body-content">
  <div class="table-responsive">
    <div id="printdatadistribusi">
<?php
    include "../../lib/conn.php";
    mysqli_set_charset($conn,'utf8');

if(isset($_GET['action']) && $_GET['action'] == 'view' && isset($_GET['id'])) {
$id = (int)$_GET['id'];
$query = "
SELECT 
    d.*, 
    p.instrument_pengembangan, p.institusi_pengelola, p.jumlah_uang AS jumlah_pengembangan,
    p.tanggal_mulai, p.tanggal_berakhir, p.persentase_hasil_pengembangan, p.jumlah_hasil_perkembangan,
    u.tanggal AS tanggal_wakaf, u.jumlah_uang AS jumlah_wakaf, u.waktu, u.bila_muaqot_sampai_tanggal,
    u.penerima_manfaat, u.detail_penerima_manfaat, u.lks_penerima_wakaf_uang, u.nomor_sertifikat, u.sertifikat_wakaf_uang,
    w.nama_wakif, w.nomor_telepon_wakif, w.nomor_ktp_wakif,
    n.nama_nazir,
    p2.nama_penerima, p2.nama_institusi_penerima, p2.nomor_ktp, p2.nomor_telepon, p2.alamat_ktp
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
<h4 class="section-title">Informasi Wakif</h4>
<table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0px 10px ;">

      
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
        <tr><th>JUMLAH UANG</th><td>Rp ' . number_format($data['jumlah_wakaf'], 0, ',', '.') . '</td></tr>
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
    


<!-- untuk popup pengembangan  
 <div class="modal-body-content">
  <div class="table-responsive">-->

   <h4 class="section-title">Informasi Pengembangan</h4>
    <table class="table table-bordered info-table">
                <thead class="thead-light">
                    <tr>
    <th>INSTRUMENT<p> PENGEMBANGAN</p></th>
    <th>INSTITUSI<p> PENGELOLA</p></th>
    <th><p>JUMLAH UANG</p></th>
    <th><p>TANGGAL MULAI</p></th>
    <th><p>TANGGAL BERAKHIR</p></th>
    <th><p>PERSENTASE PENGEMBANGAN</p></th>
    <th><p>HASIL PERKEMBANGAN</p></th>               
     </tr>
      </thead>
      <tbody>
      <tr>
          
    <td>'.$data['instrument_pengembangan'].'</td>
    <td>'.$data['institusi_pengelola'].'</td>
    <td>Rp ' . number_format($data['jumlah_pengembangan'], 0, ',', '.') . '</td>
    <td>'.$data['tanggal_mulai'].'</td>
    <td>'.$data['tanggal_berakhir'].'</td>
    '?><?php echo'<td>' . number_format($data['persentase_hasil_pengembangan'], 2, ',', '.') . '%</td>' ?><?php echo'
    <td>Rp ' . number_format($data['jumlah_hasil_perkembangan'], 0, ',', '.') . '</td>
    </tr>
    
      </tbody>
      </table>
<!--<div></div> -->
 
<!--  <div class="modal-body-content">
  <div class="table-responsive">-->

    <h4 class="section-title">Informasi Pendistribusian Wakaf Uang</h4>
    <div class="row">
    <div class="col-md-6">
  <table class="table table-bordered info-table" style="width: 100%; border-collapse: separate; border-spacing: 0 10px;">
    <tr><th>TANGGAL</th><td>'.$data['tanggal'].'</td></tr>
      <tr><th>PENERIMA MANFAAT WAKAF</th><td>'.$data['nama_penerima'].'</td></tr>
      <tr><th>BESAR MANFAAT WAKAFDITERIMA</th><td>Rp ' . number_format($data['besar_manfaat_wakafditerima'], 0, ',', '.') . '</td></tr>
      <tr><th>TUJUAN PENGUNAAN</th><td>'.$data['tujuan_pengunaan_wakaf_uang'].'</td></tr>
      <tr><th>PETUGAS PELAKSANA</th><td>'.$data['petugas_pelaksana'].'</td></tr>
    </table>
    </div>

  </div>
 </div>
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
    margin: 15mm 10mm;
  }

  body {
    font-family: Arial, sans-serif;
    font-size: 11px;
    color: #000;
    margin: 0;
    padding: 0;
  }

  h2 {
    text-align: center;
    margin-top: 20px;
    font-size: 16px;
    font-weight: bold;
  }

  .section-title {
    font-weight: bold;
    font-size: 12px;
    margin-top: 25px;
    margin-bottom: 5px;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 15px;
  }

  th, td {
    border: 1px solid #000;
    padding: 6px 4px;
    text-align: left;
    vertical-align: top;
    box-sizing: border-box;
    font-size: 10px;
  }

  th {
    background-color: #e0e6ff;
    text-align: center;
    font-weight: bold;
  }

  td[colspan] {
    text-align: center;
  }

  .signature {
    margin-top: 40px;
  }

  .signature td {
    border: none;
    text-align: center;
    font-size: 11px;
    padding-top: 30px;
  }

  .signature-line {
    margin-top: 40px;
    display: block;
    border-top: 1px solid #000;
    width: 60%;
    margin-left: auto;
    margin-right: auto;
  }

  @media print {
    .no-print {
      display: none;
    }

    body {
      -webkit-print-color-adjust: exact;
      print-color-adjust: exact;
    }
  }
</style>

        </head>
        <body>
            <h2 style="text-align:center;">Laporan Data Wakaf Uangf</h2>
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
