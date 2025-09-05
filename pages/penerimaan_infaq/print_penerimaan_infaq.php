<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Data Wakif </h3><br/>
			  <small>Info wakif</small><br/><br/>  
	<a href='javascript:void(0)' onclick='printDiv("printpenerimaan")' class='w3-text-green'>
   <i class='fa fa-print w3-large'></i>Print data penerimaan
</a>

</div>
            <div class='box-body'  style='overflow-x:auto;'>
                
                <div id="printpenerimaan">
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
			     <tr>
					<th>No</th>
						<th>NAMA PEMBERI INFAQ</th>
						<th>ALAMAT</th>
						<th>TANGGAL</th>
						<th>PETUGAS PENERIMA INFAQ</th>
						<th>MAKSUD PENGGUNAAN INFAQ</th>
						<th>JUMLAH UANG INFAQ</th>
                </tr>
                </thead>
                 <tbody>
                    <?php
    				include "../../lib/conn.php";
				$infaq = "SELECT p.*, d.nama_pemberi,d.alamat_ktp
    		     FROM penerimaan_infaq AS p
				 LEFT JOIN data_pemberi_infaq as d
				 ON p.id_pemberi_infaq = d.id_pemberi_infaq";
				 
				$query = "SELECT * FROM penerimaan_infaq ";
				$sql_kul = mysqli_query($conn, $infaq);
				$fd_kul = mysqli_num_rows($sql_kul);
				// <td>$m[id_infaq]</td>:
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_pemberi]</td>
							<td>$m[alamat_ktp]</td>
							<td>$m[tanggal]</td>
							<td>$m[nama_petugas]</td>
							<td>$m[tujuan_penggunaan]</td>"
							?><?php echo'<td>Rp ' . number_format($m['jumlah_infaq_sedekah'], 0, ',', '.') . '</td>'?><?php echo"

						</tr>";
						$no++;
					}
              $total_query = mysqli_query($conn, "SELECT SUM(jumlah_infaq_sedekah) AS total_infaq FROM penerimaan_infaq");
              $total_result = mysqli_fetch_assoc($total_query);
              $total_infaq = $total_result['total_infaq'];

                      echo "<tr>
                <td colspan='6' style='text-align:right;'><strong>Total</strong></td>
                <td><strong>Rp " . number_format($total_infaq, 0, ',', '.') . "</strong></td>
                </tr>";

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
    transform: scale(0.5) translateX(-50%);
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