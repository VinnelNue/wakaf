<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=wakaf_aset_selainuang';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/wakaf_aset_selainuang/act_wakaf_aset_selainuang.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=wakaf_aset_selainuang&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM wakaf_aset_selainuang WHERE id_wakafselainuang = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=wakaf_aset_selainuang");
				}

			}
			else
			{
				$act = "$aksi?page=wakaf_aset_selainuang&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Wakaf asset selain uang</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
			  
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_wakafselainuang']) ? $c['id_wakafselainuang'] : '';?><?php echo"'"?> <?php echo isset($c['id_wakafselainuang']) ? ' readonly' : ' ';?><?php echo" >
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
					<input required type='date' class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JENIS ASSET BERGERAK</label>
					<input required type='text' class='form-control' placeholder='Jenis Asset Bergerak' name='jenis_asset_bergerak' value='"?><?php echo isset($c['jenis_asset_bergerak']) ? $c['jenis_asset_bergerak'] : '';?><?php echo"'"?> <?php echo isset($c['jenis_asset_bergerak']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JUMLAH NILAI</label>
					<input required type='text' class='form-control' placeholder='Jumlah Nilai' name='jumlah_nilai' value='"?><?php echo isset($c['jumlah_nilai']) ? $c['jumlah_nilai'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_nilai']) ? ' ' : ' ';?><?php echo" >
										</div>
    <div class='form-group'>	<label>WAKTU</label>
    <select required class='form-control' name='waktu'>
        <option value=''>-- Pilih Waktu --</option>
        <option value='Wakaf Mu_abbad' "?><?php if(isset($_POST['waktu']) && $_POST['waktu'] == "'Wakaf Mu'abbad'") echo 'selected'; ?><?php echo " > Wakaf Mu'abbad (Permanen)"?></option><?php echo" >
        <option value='Wakaf Mu_aqot'"?> <?php if(isset($_POST['waktu']) && $_POST['waktu'] == "'Wakaf Mu'aqot'") echo 'selected'; ?><?php echo" >Wakaf Mu'aqot (Sementara)"?></option><?php echo" >
    </select>
</div>
					<div class='form-group'><label >BILA MUAQOT</label>
					<input type='date' class='form-control' placeholder='Bila Muaqot' name='bila_muaqot' value='"?><?php echo isset($c['bila_muaqot']) ? $c['bila_muaqot'] : '';?><?php echo"'"?> <?php echo isset($c['bila_muaqot']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PENERIMA MANFAAT</label>
					<input required type='text' class='form-control' placeholder='Penerima Manfaat' name='penerima_manfaat' value='"?><?php echo isset($c['penerima_manfaat']) ? $c['penerima_manfaat'] : '';?><?php echo"'"?> <?php echo isset($c['penerima_manfaat']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >DETAIL PENERIMA MANFAAT</label>
					<input required type='text' class='form-control' placeholder='Detail Penerima Manfaat' name='detail_penerima_manfaat' value='"?><?php echo isset($c['detail_penerima_manfaat']) ? $c['detail_penerima_manfaat'] : '';?><?php echo"'"?> <?php echo isset($c['detail_penerima_manfaat']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Wakaf asset selain uang</h3><br/>
			  <small>Wakaf asset selain uang</small><br/><br/>
			  <a href='index.php?page=wakaf_aset_selainuang&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>TANGGAL</th>
						<th>JENIS ASSET BERGERAK</th>
						<th>JUMLAH NILAI</th>
						<th>WAKTU</th>
						<th>BILA MUAQOT</th>
						<th>PENERIMA MANFAAT</th>
						<th>DETAIL PENERIMA MANFAAT</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT w.*, w2.nama_wakif 
						  FROM wakaf_aset_selainuang AS w 
						  LEFT JOIN wakif AS w2 ON w.id_wakif = w2.id_wakif ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_wakif]</td>
							<td>$m[tanggal]</td>
							<td>$m[jenis_asset_bergerak]</td>
							<td>$m[jumlah_nilai]</td>
							<td>$m[waktu]</td>
							<td>$m[bila_muaqot]</td>
							<td>$m[penerima_manfaat]</td>
							<td>$m[detail_penerima_manfaat]</td>
							<td><a href='index.php?page=wakaf_aset_selainuang&act=form&id=$m[id_wakafselainuang]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=wakaf_aset_selainuang&act=hapus&id=$m[id_wakafselainuang]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='10'><div class='w3-center'><i>Data Wakaf asset selain uang Not Found.</i></div></td>
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