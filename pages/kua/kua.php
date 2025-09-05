<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=kua';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}
		

	$aksi = 'pages/kua/act_kua.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=kua&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM kua WHERE id_kua = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=kua");
				}

			}
			else
			{
				$act = "$aksi?page=kua&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Data KUA</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_kua']) ? $c['id_kua'] : '';?><?php echo"'"?> <?php echo isset($c['id_kua']) ? ' readonly' : ' ';?><?php echo" >
								</div>
					<div class='form-group'><label >KECAMATAN</label>
					<input type='text' class='form-control' placeholder='Kecamatan' name='kecamatan' value='"?><?php echo isset($c['kecamatan']) ? $c['kecamatan'] : '';?><?php echo"'"?> <?php echo isset($c['kecamatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KABUPATEN KOTA</label>
					<input type='text' class='form-control' placeholder='Kabupaten Kota' name='kabupaten_kota' value='"?><?php echo isset($c['kabupaten_kota']) ? $c['kabupaten_kota'] : '';?><?php echo"'"?> <?php echo isset($c['kabupaten_kota']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KODE POS</label>
					<input type='text' class='form-control' placeholder='Kode Pos' name='kode_pos' value='"?><?php echo isset($c['kode_pos']) ? $c['kode_pos'] : '';?><?php echo"'"?> <?php echo isset($c['kode_pos']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PROVINSI</label>
					<input type='text' class='form-control' placeholder='Provinsi' name='provinsi' value='"?><?php echo isset($c['provinsi']) ? $c['provinsi'] : '';?><?php echo"'"?> <?php echo isset($c['provinsi']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >ALAMAT</label>
					<input type='text' class='form-control' placeholder='Alamat' name='alamat' value='"?><?php echo isset($c['alamat']) ? $c['alamat'] : '';?><?php echo"'"?> <?php echo isset($c['alamat']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Data KUA</h3><br/>
			  <small>Data Kantor Urusan Agama</small><br/><br/>
			  <a href='index.php?page=kua&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>KECAMATAN</th>
						<th>KABUPATEN KOTA</th>
						<th>KODE POS</th>
						<th>PROVINSI</th>
						<th>ALAMAT</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT * FROM kua ";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[kecamatan]</td>
							<td>$m[kabupaten_kota]</td>
							<td>$m[kode_pos]</td>
							<td>$m[provinsi]</td>
							<td>$m[alamat]</td>
							<td><a href='index.php?page=kua&act=form&id=$m[id_kua]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=kua&act=hapus&id=$m[id_kua]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='7'><div class='w3-center'><i>Data Data KUA Not Found.</i></div></td>
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