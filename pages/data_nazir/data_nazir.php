<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=data_nazir';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/data_nazir/act_data_nazir.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=data_nazir&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM data_nazir WHERE id_nazir = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=data_nazir");
				}

			}
			else
			{
				$act = "$aksi?page=data_nazir&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Data nazir</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_nazir']) ? $c['id_nazir'] : '';?><?php echo"'"?> <?php echo isset($c['id_nazir']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >NAMA</label>
					<input type='text' class='form-control' placeholder='Nama' name='nama_nazir' value='"?><?php echo isset($c['nama_nazir']) ? $c['nama_nazir'] : '';?><?php echo"'"?> <?php echo isset($c['nama_nazir']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR KTP</label>
					<input type='text' class='form-control' placeholder='Nomor Ktp' name='nomor_ktp' value='"?><?php echo isset($c['nomor_ktp']) ? $c['nomor_ktp'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_ktp']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >TEMPAT LAHIR</label>
					<input type='text' class='form-control' placeholder='Tempat Lahir' name='tempat_lahir' value='"?><?php echo isset($c['tempat_lahir']) ? $c['tempat_lahir'] : '';?><?php echo"'"?> <?php echo isset($c['tempat_lahir']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >TANGGAL LAHIR</label>
					<input type='date' class='form-control' placeholder='Tanggal Lahir' name='tanggal_lahir' value='"?><?php echo isset($c['tanggal_lahir']) ? $c['tanggal_lahir'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal_lahir']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >AGAMA</label>
					<input type='text' class='form-control' placeholder='Agama' name='agama' value='"?><?php echo isset($c['agama']) ? $c['agama'] : '';?><?php echo"'"?> <?php echo isset($c['agama']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PEKERJAAN</label>
					<input type='text' class='form-control' placeholder='Pekerjaan' name='pekerjaan' value='"?><?php echo isset($c['pekerjaan']) ? $c['pekerjaan'] : '';?><?php echo"'"?> <?php echo isset($c['pekerjaan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JABATAN</label>
					<input type='text' class='form-control' placeholder='Jabatan' name='jabatan' value='"?><?php echo isset($c['jabatan']) ? $c['jabatan'] : '';?><?php echo"'"?> <?php echo isset($c['jabatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KEWARGANEGARAAN</label>
					<input type='text' class='form-control' placeholder='Kewarganegaraan' name='kewarganegaraan' value='"?><?php echo isset($c['kewarganegaraan']) ? $c['kewarganegaraan'] : '';?><?php echo"'"?> <?php echo isset($c['kewarganegaraan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT SESUAI KTP</label>
					<input type='text' class='form-control' placeholder='Alamat' name='alamat' value='"?><?php echo isset($c['alamat']) ? $c['alamat'] : '';?><?php echo"'"?> <?php echo isset($c['alamat']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DESA/KELURAHAN</label>
					<input type='text' class='form-control' placeholder='Desa' name='desa' value='"?><?php echo isset($c['desa']) ? $c['desa'] : '';?><?php echo"'"?> <?php echo isset($c['desa']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KABUPATEN/KOTA</label>
					<input type='text' class='form-control' placeholder='Kabupaten' name='kabupaten' value='"?><?php echo isset($c['kabupaten']) ? $c['kabupaten'] : '';?><?php echo"'"?> <?php echo isset($c['kabupaten']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Data nazir</h3><br/>
			  <small>Data nazir</small><br/><br/>
			  <a href='index.php?page=data_nazir&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA</th>
						<th>NOMOR KTP</th>
						<th>TEMPAT LAHIR</th>
						<th>TANGGAL LAHIR</th>
						<th>AGAMA</th>
						<th>PEKERJAAN</th>
						<th>JABATAN</th>
						<th>KEWARGANEGARAAN</th>
						<th>ALAMAT</th>
						<th>DESA/KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN/KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM data_nazir ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_nazir]</td>
							<td>$m[nomor_ktp]</td>
							<td>$m[tempat_lahir]</td>
							<td>$m[tanggal_lahir]</td>
							<td>$m[agama]</td>
							<td>$m[pekerjaan]</td>
							<td>$m[jabatan]</td>
							<td>$m[kewarganegaraan]</td>
							<td>$m[alamat]</td>
							<td>$m[desa]</td>
							<td>$m[kecamatan]</td>
							<td>$m[kabupaten]</td>
							<td>$m[kode_pos]</td>
							<td>$m[provinsi]</td>
							<td><a href='index.php?page=data_nazir&act=form&id=$m[id_nazir]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=data_nazir&act=hapus&id=$m[id_nazir]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='16'><div class='w3-center'><i>Data Data nazir Not Found.</i></div></td>
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