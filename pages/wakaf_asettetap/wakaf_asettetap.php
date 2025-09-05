<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=wakaf_asettetap';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/wakaf_asettetap/act_wakaf_asettetap.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=wakaf_asettetap&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM wakaf_asettetap WHERE id_aset_tetap = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=wakaf_asettetap");
				}

			}
			else
			{
				$act = "$aksi?page=wakaf_asettetap&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Wakaf asset tetap</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_aset_tetap']) ? $c['id_aset_tetap'] : '';?><?php echo"'"?> <?php echo isset($c['id_aset_tetap']) ? ' readonly' : ' ';?><?php echo" >
								</div>
													<div class='form-group'>
    <label>NAMA WAKIF</label>
    <select required class='form-control' name='id_wakif'>"?><?php echo"
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
					<div class='form-group'><label >TANGGAL</label>
					<input required type='DATE' class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JENIS ASSET TETAP</label>
					<input required type='text' class='form-control' placeholder='Jenis Asset Tetap' name='jenis_asset_tetap' value='"?><?php echo isset($c['jenis_asset_tetap']) ? $c['jenis_asset_tetap'] : '';?><?php echo"'"?> <?php echo isset($c['jenis_asset_tetap']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >LUAS</label>
					<input required type='text' class='form-control' placeholder='Luas' name='luas' value='"?><?php echo isset($c['luas']) ? $c['luas'] : '';?><?php echo"'"?> <?php echo isset($c['luas']) ? ' ' : ' ';?><?php echo" >
										</div><div class='form-group'>
    <label>WAKTU</label>
    <select required class='form-control' name='waktu'>
        <option value=''>-- Pilih Waktu --</option>
        <option value='Wakaf Mu_abbad' "?><?php if(isset($_POST['waktu']) && $_POST['waktu'] == "'Wakaf Mu'abbad'") echo 'selected'; ?><?php echo " > Wakaf Mu'abbad (Permanen)"?></option><?php echo" >
        <option value='Wakaf Mu_aqot'"?> <?php if(isset($_POST['waktu']) && $_POST['waktu'] == "'Wakaf Mu'aqot'") echo 'selected'; ?><?php echo" >Wakaf Mu'aqot (Sementara)"?></option><?php echo" >
    </select>
</div>
					<div class='form-group'><label >BILA MUAQOT HINGGA</label>
					<input type='date' class='form-control' placeholder='Bila Muaqot Hingga' name='bila_muaqot_hingga' value='"?><?php echo isset($c['bila_muaqot_hingga']) ? $c['bila_muaqot_hingga'] : '';?><?php echo"'"?> <?php echo isset($c['bila_muaqot_hingga']) ? ' ' : ' ';?><?php echo" >
										</div>
				<div class='form-group'>
    <label>Penerima Manfaat (Mauquf Alaih)</label>
    <select required class='form-control' name='penerima_manfaat'>
        <option value=''>-- Pilih Waktu --</option>
        <option value='Wakaf Ahli/Dzurri' "?><?php if(isset($_POST['penerima_manfaat']) && $_POST['penerima_manfaat'] == 'Wakaf Ahli/Dzurri') echo 'selected'; ?><?php echo " > Wakaf Ahli/Dzurri (Keluarga)"?></option><?php echo" >
        <option value='Wakaf Kahiri'"?> <?php if(isset($_POST['penerima_manfaat']) && $_POST['penerima_manfaat'] == 'Wakaf Kahiri') echo 'selected'; ?><?php echo" >Wakaf Kahiri (Umum)"?></option><?php echo" >
		<option value='Wakaf Musytarak'"?> <?php if(isset($_POST['penerima_manfaat']) && $_POST['penerima_manfaat'] == 'Wakaf Musytarak') echo 'selected'; ?><?php echo" >Wakaf Musytarak (Umum & Keluarga)"?></option><?php echo" >
    </select>
</div>
					<div class='form-group'><label >SURAT KEPEMILIKAN</label>
					<input required type='text' class='form-control' placeholder='Surat Kepemilikan' name='surat_kepemilikan' value='"?><?php echo isset($c['surat_kepemilikan']) ? $c['surat_kepemilikan'] : '';?><?php echo"'"?> <?php echo isset($c['surat_kepemilikan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >NO SURAT KEPEMILIKAN</label>
					<input required type='text' class='form-control' placeholder='No Surat Kepemilikan' name='no_surat_kepemilikan' value='"?><?php echo isset($c['no_surat_kepemilikan']) ? $c['no_surat_kepemilikan'] : '';?><?php echo"'"?> <?php echo isset($c['no_surat_kepemilikan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT</label>
					<input required  type='text' class='form-control' placeholder='Alamat' name='alamat' value='"?><?php echo isset($c['alamat']) ? $c['alamat'] : '';?><?php echo"'"?> <?php echo isset($c['alamat']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DESA/KELURAHAN</label>
					<input required type='text' class='form-control' placeholder='Desa Kelurahan' name='desa_kelurahan' value='"?><?php echo isset($c['desa_kelurahan']) ? $c['desa_kelurahan'] : '';?><?php echo"'"?> <?php echo isset($c['desa_kelurahan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input required type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KOTA/KABUPATEN</label>
					<input required type='text' class='form-control' placeholder='Kota Kabupaten' name='kota_kabupaten' value='"?><?php echo isset($c['kota_kabupaten']) ? $c['kota_kabupaten'] : '';?><?php echo"'"?> <?php echo isset($c['kota_kabupaten']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KODE POS</label>
					<input required type='text' class='form-control' placeholder='Kode Pos' name='kode_pos' value='"?><?php echo isset($c['kode_pos']) ? $c['kode_pos'] : '';?><?php echo"'"?> <?php echo isset($c['kode_pos']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PROVINSI</label>
					<input required type='text' class='form-control' placeholder='Provinsi' name='provinsi' value='"?><?php echo isset($c['provinsi']) ? $c['provinsi'] : '';?><?php echo"'"?> <?php echo isset($c['provinsi']) ? ' ' : ' ';?><?php echo" >
										</div>
								<div class='form-group'>
    <label>NAMA NAZIR</label>
    <select required class='form-control' name='id_nazir'>"?><?php echo"
        <option value=''>-- Pilih Nazir --</option>"?><?php
        
        // mengamil data dari tabel NAZIR
        $wakifQuery = mysqli_query($conn, "SELECT id_nazir, nama_nazir FROM data_nazir");
        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $selected = (isset($c['id_nazir']) && $c['id_nazir'] == $row['id_nazir']) ? 'selected' : '';
            echo "<option value='{$row['id_nazir']}' $selected>{$row['nama_nazir']}</option>";
        }
        ?><?php echo"
    </select>
</div>
					<div class='form-group'>  <label>KUA</label>
    <select required class='form-control' name='id_kua'>"?><?php echo"
        <option value=''>-- Pilih KUA --</option>"?><?php
        
        // mengamil data dari tabel KUA
        $wakifQuery = mysqli_query($conn, "SELECT id_kua, kecamatan FROM kua");
        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $selected = (isset($c['id_kua']) && $c['id_kua'] == $row['id_kua']) ? 'selected' : '';
            echo "<option value='{$row['id_kua']}' $selected>{$row['kecamatan']}</option>";
        }
        ?><?php echo"
    </select>
</div>
					<div class='form-group'>
					<label >AKTE IKRAR WAKAF</label>
					<input required type='file' class='form-control' placeholder='Akte Ikrar Wakaf' name='akte_ikrar_wakaf' value='"?><?php echo isset($c['akte_ikrar_wakaf']) ? $c['akte_ikrar_wakaf'] : '';?><?php echo"'"?> <?php echo isset($c['akte_ikrar_wakaf']) ? ' ' : ' ';?><?php echo" >
					<small class='text-muted'>Format JPG/PNG/PDF, max 2MB</small>
					</div>
										<div class='box-footer'>
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
              <h3 class='box-title'>Wakaf asset tetap</h3><br/>
			  <small>Wakaf asset tetap</small><br/><br/>
			  <a href='index.php?page=wakaf_asettetap&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>TANGGAL</th>
						<th>JENIS ASSET TETAP</th>
						<th>LUAS</th>
						<th>WAKTU</th>
						<th>BILA MUAQOT HINGGA</th>
						<th>PENERIMA MANFAAT</th>
						<th>SURAT KEPEMILIKAN</th>
						<th>NO SURAT KEPEMILIKAN</th>
						<th>ALAMAT</th>
						<th>DESA KELURAHAN</th>
						<th>KECAMATAN</th>
						<th>KOTA KABUPATEN</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
						<th>NAMA NAZIR</th>
						<th>KUA</th>
						<th>AKTE IKRAR WAKAF</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT w.*, w2.nama_wakif ,n.nama_nazir,k.kecamatan as keca
						  FROM 	wakaf_asettetap AS w 
						  LEFT JOIN wakif       AS w2  ON w.id_wakif = w2.id_wakif 
						  LEFT JOIN data_nazir  AS n   ON w.id_nazir = n.id_nazir
						  LEFT JOIN kua         AS k   ON w.id_kua   = k.id_kua  ";

				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
	 echo '<tr>
            <td>' . $no . '</td>
            <td>' . $m['nama_wakif'] . '</td>
            <td>' . $m['tanggal'] . '</td>
            <td>' . $m['jenis_asset_tetap'] . '</td>
            <td>' . $m['luas'] . '</td>
            <td>' . $m['waktu'] . '</td>
            <td>' . $m['bila_muaqot_hingga'] . '</td>
            <td>' . $m['penerima_manfaat'] . '</td>
            <td>' . $m['surat_kepemilikan'] . '</td>
            <td>' . $m['no_surat_kepemilikan'] . '</td>
            <td>' . $m['alamat'] . '</td>
		    <td>' . $m['desa_kelurahan'] . '</td>
		    <td>' . $m['kecamatan'] . '</td>
	 	    <td>' . $m['kota_kabupaten'] . '</td>
	 	    <td>' . $m['kode_pos'] . '</td>
			<td>' . $m['provinsi'] . '</td>
			<td>' . $m['nama_nazir'] . '</td>
			<td>' . $m['keca'] . '</td>
          	<td>
                <img src="pages/wakaf_asettetap/uploads/' . $m['akte_ikrar_wakaf'] . '" 
                     alt="File Gambar" 
                     class="icon-img" 
                     onerror="this.onerror=null;this.src=\'image-not-found.png\';this.alt=\'Image Not Found\';" 
                     style="max-width:100px;max-height:100px;cursor:pointer"
					 onclick="openModal(this.src)">
            </td>
			'?><?php echo"		
							<td><a href='index.php?page=wakaf_asettetap&act=form&id=$m[id_aset_tetap]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=wakaf_asettetap&act=hapus&id=$m[id_aset_tetap]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
			
				else
				{
					echo"<tr>
						<td colspan='20'><div class='w3-center'><i>Data Wakaf asset tetap Not Found.</i></div></td>
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