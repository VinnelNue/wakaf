
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Data Wakif </h3><br/>
			  <small>Info wakif</small><br/><br/>  
              <a href="javascript:void(0)" onclick="printDiv('printdatatt')" class="w3-text-green">
    <i class="fa fa-print w3-large"></i>
</a>
			  </div>
            <div class='box-body'>
                  <div class="table-responsive">
    <div id="printdatatt">
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>NOMOR KTP</th>
						<th>NOMOR TELEPON</th>
						<th>ALAMAT KK</th>
						<th>DESA KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
                </tr>
                </thead>
                <tbody><?php
				
    				include "../../lib/conn.php";
				$query = "SELECT * FROM wakif ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_wakif]</td>
							<td>$m[nomor_ktp_wakif]</td>
							<td>$m[nomor_telepon_wakif]</td>
							<td>$m[alamat_kk]</td>
							<td>$m[desa_kelurahan]</td>
							<td>$m[kecamatan]</td>
							<td>$m[kabupaten_kota]</td>
							<td>$m[kode_pos]</td>
							<td>$m[provinsi]</td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='11'><div class='w3-center'><i>Data Data Wakif  Not Found.</i></div></td>
					</tr>";
				}
				?>
				
              </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
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
    border: 1px solid #000;
}

.print-container {
    width: 100%;
    margin: auto;
    
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th, td {
    border: 1px solid #000;
    padding: 6px 8px;
    text-align: left;
    vertical-align: top;
    white-space: normal;  
    word-break: normal;  
}

th {
    background-color: #e4e7ff;
    font-weight: bold;
}


.no-print {
    display: none;
}

@media print {
    .table-responsive {
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