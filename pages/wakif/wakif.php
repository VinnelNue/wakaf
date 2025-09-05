<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=wakif';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/wakif/act_wakif.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=wakif&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM wakif WHERE id_wakif = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=wakif");
				}

			}
			else
			{
				$act = "$aksi?page=wakif&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Data Wakif </h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_wakif']) ? $c['id_wakif'] : '';?><?php echo"'"?> <?php echo isset($c['id_wakif']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >NAMA WAKIF</label>
					<input type='text' class='form-control' placeholder='Nama Wakif' name='nama_wakif' value='"?><?php echo isset($c['nama_wakif']) ? $c['nama_wakif'] : '';?><?php echo"'"?> <?php echo isset($c['nama_wakif']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR KTP</label>
					<input type='text' class='form-control' placeholder='Nomor Ktp' name='nomor_ktp_wakif' value='"?><?php echo isset($c['nomor_ktp_wakif']) ? $c['nomor_ktp_wakif'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_ktp_wakif']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR TELEPON</label>
					<input type='text' class='form-control' placeholder='Nomor Telepon' name='nomor_telepon_wakif' value='"?><?php echo isset($c['nomor_telepon_wakif']) ? $c['nomor_telepon_wakif'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_telepon_wakif']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT SESUAI KTP</label>
					<input type='text' class='form-control' placeholder='Alamat Kk' name='alamat_kk' value='"?><?php echo isset($c['alamat_kk']) ? $c['alamat_kk'] : '';?><?php echo"'"?> <?php echo isset($c['alamat_kk']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DESA/KELURAHAN</label>
					<input type='text' class='form-control' placeholder='Desa Kelurahan' name='desa_kelurahan' value='"?><?php echo isset($c['desa_kelurahan']) ? $c['desa_kelurahan'] : '';?><?php echo"'"?> <?php echo isset($c['desa_kelurahan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KABUPATEN/KOTA</label>
					<input type='text' class='form-control' placeholder='Kabupaten Kota' name='kabupaten_kota' value='"?><?php echo isset($c['kabupaten_kota']) ? $c['kabupaten_kota'] : '';?><?php echo"'"?> <?php echo isset($c['kabupaten_kota']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KODE POS</label>
					<input type='text' class='form-control' placeholder='Kode Pos' name='kode_pos' value='"?><?php echo isset($c['kode_pos']) ? $c['kode_pos'] : '';?><?php echo"'"?> <?php echo isset($c['kode_pos']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PROVINSI</label>
					<input type='text' class='form-control' placeholder='Provinsi' name='provinsi' value='"?><?php echo isset($c['provinsi']) ? $c['provinsi'] : '';?><?php echo"'"?> <?php echo isset($c['provinsi']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Data Wakif </h3><br/>
			  <small>Info wakif</small><br/><br/>
			  <a href='index.php?page=wakif&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>NOMOR KTP</th>
						<th>NOMOR TELEPON</th>
						<th>ALAMAT KK</th>
						<th>DESA/KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN/KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
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
							<td>
							<a href='index.php?page=wakif&act=form&id=$m[id_wakif]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=wakif&act=hapus&id=$m[id_wakif]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
							<a href='javascript:void(0)' onclick='showPrintWakif({$m['id_wakif']})' class='w3-text-green'><i class='fa fa-eye w3-large'></i></a>
							</td>
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
				
				
                echo "</tbody>
                <tfoot>
                </tfoot>
              </table>
            </div>
			</div>
          </div>
        </div>";

		echo'
<div id="detailPopupprintwakif" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Wakif report</h4>
            </div>
            <div class="modal-body" id="detailContentwakif">
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
	     function showPrintWakif(id) {
    $('#detailPopupprintwakif').modal('show');
    $.ajax({
        url: 'pages/wakif/popupwakif.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContentwakif').html(response);
        },
        error: function() {
            $('#detailContentwakif').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}



</script>