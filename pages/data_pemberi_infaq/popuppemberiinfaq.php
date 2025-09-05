<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Data Pemberi Infaq </h3><br/>
			  <small>Data Pemberi</small><br/><br/>  
	<a href='javascript:void(0)' onclick='printDiv("printpemberian")' class='w3-text-green'>
   <i class='fa fa-print w3-large'></i>Print data pemberi infaq
</a>

</div>
            <div class='box-body'  style='overflow-x:auto;'>
                
                <div id="printpemberian">
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
          <tr>
					<th>No</th>
						<th>NAMA PEMBERI</th>
						<th>NOMOR KTP</th>
						<th>NOMOR TELEPON</th>
						<th>ALAMAT KTP</th>
						<th>DESA KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
                </tr>
                </thead>
                 <tbody>
                    <?php
    			include "../../lib/conn.php";
				$query = "SELECT * FROM data_pemberi_infaq ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_pemberi]</td>
							<td>$m[nomor_ktp]</td>
							<td>$m[nomor_telepon]</td>
							<td>$m[alamat_ktp]</td>
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
				
        </div>
              </tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
        </div>

<script>function printDiv(divId) {
    var content = document.getElementById(divId).innerHTML;

    var win = window.open('', '', 'width=1024,height=768');
    win.document.write(`
        <html>
        <head>
            <style>
                @page {
                    size: A4;
                    margin: 10mm;
                }
              body {
    margin: 0;
    padding: 0;
    font-family: Arial, sans-serif;
    font-size: 10px;
    color: #000;
}

.scaler {
    position: absolute;
    top: 0;
    left: 50%;
    transform: scale(0.7) translateX(-50%);
    transform-origin: top center;
}

.print-container {
    width: 1024px;
    margin: auto;
}

                table {
                    width: 98.5%;
                    border-collapse: collapse;
                    border-right: 1px solid #000;
                    margin-top: 20px;
                }
                th, td {
                    border: 1px solid #000;
                    padding: 2px;
                    text-align: center;
                    max-width:150px;
                    box-sizing: border-box;
                }
                th {
                    background-color: #454eccff;
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
            <h2 style="text-align:center;">Laporan Data Wakif</h2>
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