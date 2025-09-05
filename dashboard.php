
<?php
echo"
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Distribusi wakaf show</h3><br/>
            </div>
            <div class='box-body'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						
						<th>TANGGAL</th>
						<th>PENERIMA MANFAAT WAKAF</th>
						<th>BESAR MANFAAT WAKAFDITERIMA</th>
						<th>TUJUAN PENGUNAAN WAKAF UANG</th>
						<th>PETUGAS PELAKSANA</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
			  $query = "SELECT d.*, p.nama_penerima 
FROM pendistribusian_uang_wakaf AS d
LEFT JOIN penerima_uang_wakaf AS p 
ON d.id_penerima_manfaat_wakaf = p.id_penerima_manfaat_wakaf
";				
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				//<td>$m[id_pengembangan__uang_wakaf]</td><th>ID PENGEMBANGAN  UANG WAKAF</th>
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>

							<td>$m[tanggal]</td>
							<td>$m[nama_penerima]</td>"
    				     	?><?php echo'<td>Rp ' . number_format($m['besar_manfaat_wakafditerima'], 0, ',', '.') . '</td>'?><?php echo
							"<td>$m[tujuan_pengunaan_wakaf_uang]</td>
							<td>$m[petugas_pelaksana]</td>
							<td><a href='javascript:void(0)' 
                   onclick='showDetaildistribusi1({$m['id_pendistribusian_uangwakaf']})'
                   class='w3-text-green'>
                    <i class='fa fa-eye w3-large'></i>
                </a>
							</td>
              
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='8'><div class='w3-center'><i>Data Distribusi wakaf Not Found.</i></div></td>
					</tr>";
				}
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
          </div>
          
        </div>";
         	echo'
<div id="detailPopupdist1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Pengembangan</h4>
            </div>
            <div class="modal-body" id="detailContentdist1">
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
<div id="imgModal" class="modal-img-container" onclick="closeModal()">
  			 <span class="modal-img-close" onclick="closeModal()">&times;</span>
 			 <img class="modal-img-content" id="modalImage">
	</div>';
        ?>
        
<script>    
function showDetaildistribusi1(id) {
    $('#detailPopupdist1').modal('show');
    $.ajax({
        url: 'pages/pendistribusian_uang_wakaf/popupdistribusi.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContentdist1').html(response);
        },
        error: function() {
            $('#detailContentdist1').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}
</script>