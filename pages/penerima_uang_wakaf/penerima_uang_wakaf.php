<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=penerima_uang_wakaf';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/penerima_uang_wakaf/act_penerima_uang_wakaf.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=penerima_uang_wakaf&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM penerima_uang_wakaf WHERE id_penerima_manfaat_wakaf = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=penerima_uang_wakaf");
				}

			}
			else
			{
				$act = "$aksi?page=penerima_uang_wakaf&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Penerima manfaat uang wakaf</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_penerima_manfaat_wakaf']) ? $c['id_penerima_manfaat_wakaf'] : '';?><?php echo"'"?> <?php echo isset($c['id_penerima_manfaat_wakaf']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >NAMA PENERIMA</label>
					<input required type='text' class='form-control' placeholder='Nama Penerima' name='nama_penerima' value='"?><?php echo isset($c['nama_penerima']) ? $c['nama_penerima'] : '';?><?php echo"'"?> <?php echo isset($c['nama_penerima']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NAMA INSTITUSI PENERIMA</label>
					<input required type='text' class='form-control' placeholder='Nama Institusi Penerima' name='nama_institusi_penerima' value='"?><?php echo isset($c['nama_institusi_penerima']) ? $c['nama_institusi_penerima'] : '';?><?php echo"'"?> <?php echo isset($c['nama_institusi_penerima']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR KTP</label>
					<input required type='text' class='form-control' placeholder='Nomor Ktp' name='nomor_ktp' value='"?><?php echo isset($c['nomor_ktp']) ? $c['nomor_ktp'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_ktp']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR TELEPON</label>
					<input required type='text' class='form-control' placeholder='Nomor Telepon' name='nomor_telepon' value='"?><?php echo isset($c['nomor_telepon']) ? $c['nomor_telepon'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_telepon']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT KTP</label>
					<input required type='text' class='form-control' placeholder='Alamat Ktp' name='alamat_ktp' value='"?><?php echo isset($c['alamat_ktp']) ? $c['alamat_ktp'] : '';?><?php echo"'"?> <?php echo isset($c['alamat_ktp']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DESA KELURAHAN</label>
					<input required type='text' class='form-control' placeholder='Desa Kelurahan' name='desa_kelurahan' value='"?><?php echo isset($c['desa_kelurahan']) ? $c['desa_kelurahan'] : '';?><?php echo"'"?> <?php echo isset($c['desa_kelurahan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input required type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KABUPATEN KOTA</label>
					<input required type='text' class='form-control' placeholder='Kabupaten Kota' name='kabupaten_kota' value='"?><?php echo isset($c['kabupaten_kota']) ? $c['kabupaten_kota'] : '';?><?php echo"'"?> <?php echo isset($c['kabupaten_kota']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KODE POS</label>
					<input required type='text' class='form-control' placeholder='Kode Pos' name='kode_pos' value='"?><?php echo isset($c['kode_pos']) ? $c['kode_pos'] : '';?><?php echo"'"?> <?php echo isset($c['kode_pos']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PROVINSI</label>
					<input required type='text' class='form-control' placeholder='Provinsi' name='provinsi' value='"?><?php echo isset($c['provinsi']) ? $c['provinsi'] : '';?><?php echo"'"?> <?php echo isset($c['provinsi']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Penerima manfaat Wakaf Uang </h3><br/>
			  <small>Penerima manfaat uang wakaf</small><br/><br/>
			  <a href='index.php?page=penerima_uang_wakaf&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA PENERIMA</th>
						<th>NAMA INSTITUSI PENERIMA</th>
						<th>NOMOR KTP</th>
						<th>NOMOR TELEPON</th>
						<th>ALAMAT KTP</th>
						<th>DESA/KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN/KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM penerima_uang_wakaf ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_penerima]</td>
							<td>$m[nama_institusi_penerima]</td>
							<td>$m[nomor_ktp]</td>
							<td>$m[nomor_telepon]</td>
							<td>$m[alamat_ktp]</td>
							<td>$m[desa_kelurahan]</td>
							<td>$m[kecamatan]</td>
							<td>$m[kabupaten_kota]</td>
							<td>$m[kode_pos]</td>
							<td>$m[provinsi]</td>
							<td><a href='index.php?page=penerima_uang_wakaf&act=form&id=$m[id_penerima_manfaat_wakaf]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=penerima_uang_wakaf&act=hapus&id=$m[id_penerima_manfaat_wakaf]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='12'><div class='w3-center'><i>Data Penerima manfaat uang wakaf Not Found.</i></div></td>
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

		break;
	}

	
?>