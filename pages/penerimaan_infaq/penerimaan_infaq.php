<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=penerimaan_infaq';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/penerimaan_infaq/act_penerimaan_infaq.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=penerimaan_infaq&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM penerimaan_infaq WHERE id_infaq = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=penerimaan_infaq");
				}

			}
			else
			{
				$act = "$aksi?page=penerimaan_infaq&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'>ADD DATA PENERIMAAN INFAQ </h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_infaq']) ? $c['id_infaq'] : '';?><?php echo"'"?> <?php echo isset($c['id_infaq']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'>		
					<label >NAMA PEMBERI INFAQ</label>
					<select class='form-control' name='id_pemberi_infaq'>"?><?php echo"
					 <option value=''>-- Pilih pemberi infaq --</option>"?><?php 

					 $Senderid = mysqli_query ($conn,"SELECT id_pemberi_infaq, nama_pemberi FROM data_pemberi_infaq");
					 while ($row = mysqli_fetch_assoc($Senderid)) {
            		$selected = (isset($c['id_pemberi_infaq']) && $c['id_pemberi_infaq'] == $row['id_pemberi_infaq']) ? 'selected' : '';
           		    echo "<option value='{$row['id_pemberi_infaq']}' $selected>{$row['nama_pemberi']}</option>";
       				 }
       				 ?><?php echo"
					 </select></div>
					<div class='form-group'><label >TANGGAL</label>
					<input type='date' class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JUMLAH INFAQ SEDEKAH</label>
					<input type='text' class='form-control' placeholder='Jumlah Infaq Sedekah' name='jumlah_infaq_sedekah' value='"?><?php echo isset($c['jumlah_infaq_sedekah']) ? $c['jumlah_infaq_sedekah'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_infaq_sedekah']) ? ' ' : ' ';?><?php echo" >
					<input type='hidden' name='jumlah_infaq_sedekah_raw' id='jumlah_infaq_sedekah_raw' />
					</div>
					<div class='form-group'><label >TUJUAN PENGGUNAAN</label>
					<input type='text' class='form-control' placeholder='Tujuan Penggunaan' name='tujuan_penggunaan' value='"?><?php echo isset($c['tujuan_penggunaan']) ? $c['tujuan_penggunaan'] : '';?><?php echo"'"?> <?php echo isset($c['tujuan_penggunaan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NAMA PETUGAS</label>
					<input type='text' class='form-control' placeholder='Nama Petugas' name='nama_petugas' value='"?><?php echo isset($c['nama_petugas']) ? $c['nama_petugas'] : '';?><?php echo"'"?> <?php echo isset($c['nama_petugas']) ? ' ' : ' ';?><?php echo" >
										</div><div class='box-footer'>
					<button type='submit' class='btn btn-primary'>Submit</button> <button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
				</div>
			  </div>			
            </form>
          </div>
        </div>
		";
		break;

		default :
		echo"
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Penerimaan Infaq</h3><br/>
			  <small>Data Penerimaan Infaq</small><br/><br/>
			  <p><a href='index.php?page=penerimaan_infaq&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a></p>
			  <a href='javascript:void(0)' onclick='showpenerimaaninfaq()' class='w3-text-green'><i class='fa fa-print w3-large'></i>Print Data Penerima Infaq</a>
			  </div>

            <div class='box-body'>
            <div class='table-responsive'>
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
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
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
							<td>
							<a href='index.php?page=penerimaan_infaq&act=form&id=$m[id_infaq]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=penerimaan_infaq&act=hapus&id=$m[id_infaq]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
							<a href='javascript:void(0)' onclick='showmutasipenerimaaninfaq({$m['id_infaq']})' class='w3-text-green'><i class='fa fa-eye w3-large'></i> </a>
							</td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='7'><div class='w3-center'><i>Data penerimaan_infaq Not Found.</i></div></td>
					</tr>";
				}
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
              </div>
            </div>
          </div>
        </div>";
		echo'
<div id="popenerimaaninfaq" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="detailContenpopenerimaan">
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
</div>';
		echo'
<div id="print_bukti_penerimaan" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body" id="detailContenbuktipenerimaan">
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
</div>';
echo'<div id="pomutasipenerimaaninfaq" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body" id="detailContenpomutasi">
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
</div>';
		break;
	}

	
?>
<script>
//show mutasi popup ById
		function showmutasipenerimaaninfaq(id) {
    $('#pomutasipenerimaaninfaq').modal('show');
    $.ajax({
        url: 'pages/penerimaan_infaq/po_mutasi_penerimaan_infaq.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContenpomutasi').html(response);
        },
        error: function() {
            $('#detailContenpomutasi').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}  
//popupall show all data
	function showpenerimaaninfaq(id) {
    $('#popenerimaaninfaq').modal('show');
    $.ajax({
        url: 'pages/penerimaan_infaq/po_penerimaan_infaq.php?action=viewall',
        type: 'GET',
        success: function(response) {
            $('#detailContenpopenerimaan').html(response);
        },
        error: function() {
            $('#detailContenpopenerimaan').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}
// show popup print
	function print_penerimaan_infaq(id) {
    $('#print_bukti_penerimaan').modal('show');
    $.ajax({
        url: 'pages/penerimaan_infaq/print_penerimaan_infaq.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContenbuktipenerimaan').html(response);
        },
        error: function() {
            $('#detailContenbuktipenerimaan').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("input[name='jumlah_infaq_sedekah']");
    const inputRaw = document.getElementById("jumlah_infaq_sedekah_raw");

    function formatRupiahInput(angka) {
        let number_string = angka.replace(/[^,\d]/g, '').toString();
        if (number_string === '') return 'Rp';

        let split = number_string.split(',');
        let sisa = split[0].length % 3;
        let rupiah = split[0].substr(0, sisa);
        let ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }

    input.addEventListener('input', function () {
        const numeric = this.value.replace(/[^0-9]/g, '');
        this.value = formatRupiahInput(numeric);
        if (inputRaw) inputRaw.value = numeric || '';
    });

    // Inisialisasi awal (jika ada nilai bawaan)
    input.value = formatRupiahInput(inputRaw?.value || '');
});

</script>