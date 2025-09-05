<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=ahli_waris';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/ahli_waris/act_ahli_waris.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=ahli_waris&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM ahli_waris WHERE id_ahli_waris = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=ahli_waris");
				}

			}
			else
			{
				$act = "$aksi?page=ahli_waris&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Penerima warisan</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_ahli_waris']) ? $c['id_ahli_waris'] : '';?><?php echo"'"?> <?php echo isset($c['id_ahli_waris']) ? ' readonly' : ' ';?><?php echo" >
								</div>
								<div class='form-group'>
   				 <label>NAMA WAKIF</label>
   				 <select class='form-control' name='id_wakif'>"?><?php echo"
      		     <option value=''>-- Pilih WAKIF --</option>"?><?php
        
        // mengamil data dari tabel wakif
      			  $wakifQuery = mysqli_query($conn, "SELECT id_wakif, nama_wakif FROM wakif");
       			  while ($row = mysqli_fetch_assoc($wakifQuery)) {
       		      $selected = (isset($c['id_wakif']) && $c['id_wakif'] == $row['id_wakif']) ? 'selected' : '';
        	      echo "<option value='{$row['id_wakif']}' $selected>{$row['nama_wakif']}</option>";
        			}
       			 ?><?php echo"
   				 </select>
				</div>
					<div class='form-group'><label >NAMA AHLIH WARIS</label>
					<input required  type='text' class='form-control' placeholder='Nama Ahlih Waris' name='nama_ahlih_waris' value='"?><?php echo isset($c['nama_ahlih_waris']) ? $c['nama_ahlih_waris'] : '';?><?php echo"'"?> <?php echo isset($c['nama_ahlih_waris']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >HUBUNGAN KELUARGA</label>
					<input required type='text' class='form-control' placeholder='Hubungan Keluarga' name='hubungan_keluarga' value='"?><?php echo isset($c['hubungan_keluarga']) ? $c['hubungan_keluarga'] : '';?><?php echo"'"?> <?php echo isset($c['hubungan_keluarga']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR KTP</label>
					<input required type='text' class='form-control' placeholder='Nomor Ktp' name='nomor_ktp_penerimawar' value='"?><?php echo isset($c['nomor_ktp_penerimawar']) ? $c['nomor_ktp_penerimawar'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_ktp_penerimawar']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NOMOR TELEPON</label>
					<input required type='text' class='form-control' placeholder='Nomor Telepon' name='nomor_telepon_penerimawak' value='"?><?php echo isset($c['nomor_telepon_penerimawak']) ? $c['nomor_telepon_penerimawak'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_telepon_penerimawak']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT SESUAI KTP</label>
					<input required type='text' class='form-control' placeholder='Alamat Ktp' name='alamat_ktp' value='"?><?php echo isset($c['alamat_ktp']) ? $c['alamat_ktp'] : '';?><?php echo"'"?> <?php echo isset($c['alamat_ktp']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DESA/KELURAHAN</label>
					<input required type='text' class='form-control' placeholder='Desa Kelurahan' name='desa_kelurahan' value='"?><?php echo isset($c['desa_kelurahan']) ? $c['desa_kelurahan'] : '';?><?php echo"'"?> <?php echo isset($c['desa_kelurahan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input required type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KABUPATEN/KOTA</label>
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
              <h3 class='box-title'>Penerima warisan</h3><br/>
			  <small>Data penerima warisan</small><br/><br/>
			  <a href='index.php?page=ahli_waris&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>NAMA AHLIH WARIS</th>
						<th>HUBUNGAN KELUARGA</th>
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
				    $query = "SELECT a.*, w.nama_wakif 
       						  FROM ahli_waris AS a
        					  LEFT JOIN wakif AS w 
          					  ON a.id_wakif = w.id_wakif";

				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				//tinggal menganti menjadi id_wakif jika ingin id wakif yang di tampilkan
				// <td>$m[id_wakif]</td>:
				 
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_wakif]</td>
							<td>$m[nama_ahlih_waris]</td>
							<td>$m[hubungan_keluarga]</td>
							<td>$m[nomor_ktp_penerimawar]</td>
							<td>$m[nomor_telepon_penerimawak]</td>
							<td>$m[alamat_ktp]</td>
							<td>$m[desa_kelurahan]</td>
							<td>$m[kecamatan]</td>
							<td>$m[kabupaten_kota]</td>
							<td>$m[kode_pos]</td>
							<td>$m[provinsi]</td>
							<td><a href='index.php?page=ahli_waris&act=form&id=$m[id_ahli_waris]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=ahli_waris&act=hapus&id=$m[id_ahli_waris]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
							</a>
							  <a href='javascript:void(0)' 
                   onclick='showDetail({$m['id_ahli_waris']})'
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
						<td colspan='13'><div class='w3-center'><i>Data Penerima warisan Not Found.</i></div></td>
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
	<div id="detailPopup" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">Detail Ahli Waris</h4>
                            </div>
                            <div class="modal-body" id="detailContent">
                                <div class="text-center">
                                    <i class="fa fa-spinner fa-spin fa-3x"></i>
                                    <p>Loading data...</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

		break;
	}
?>