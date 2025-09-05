<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=pemanfaatan_wakaf_asset_tetap';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/pemanfaatan_wakaf_asset_tetap/act_pemanfaatan_wakaf_asset_tetap.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=pemanfaatan_wakaf_asset_tetap&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM pemanfaatan_wakaf_asset_tetap WHERE id_pemanfaatan_wakaf_tetap = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=pemanfaatan_wakaf_asset_tetap");
				}

			}
			else
			{
				$act = "$aksi?page=pemanfaatan_wakaf_asset_tetap&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Pemanfaatan wakaf asset tetap</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_pemanfaatan_wakaf_tetap']) ? $c['id_pemanfaatan_wakaf_tetap'] : '';?><?php echo"'"?> <?php echo isset($c['id_pemanfaatan_wakaf_tetap']) ? ' readonly' : ' ';?><?php echo" >
								</div>

			<div class='form-group'>
    <label>NAMA WAKTIF</label>
<select class='form-control' required name='id_aset_tetap'>"?><?php echo"
    <option value=''>-- Pilih WAKIF --</option>"?><?php
        // Ambil semua id_aset_tetap yang sudah digunakan
        $usedQuery = mysqli_query($conn, "SELECT id_aset_tetap FROM pemanfaatan_wakaf_asset_tetap");
        $usedIds = [];
        while ($used = mysqli_fetch_assoc($usedQuery)) {
            // Jika sedang edit dan id ini adalah yang digunakan, jangan masukkan ke list pengecualian
            if (!isset($c['id_aset_tetap']) || $c['id_aset_tetap'] != $used['id_aset_tetap']) {
                $usedIds[] = $used['id_aset_tetap'];
            }
        }

        // Ambil data wakif & aset tetap
        $wakifQuery = mysqli_query($conn, "
            SELECT u.id_aset_tetap, w.nama_wakif
            FROM wakaf_asettetap AS u
            INNER JOIN wakif AS w ON u.id_wakif = w.id_wakif
        ") or die(mysqli_error($conn));

        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $idAset = $row['id_aset_tetap'];
            $namaWakif = $row['nama_wakif'];

            // Skip jika aset sudah digunakan dan bukan aset yang sedang diedit
            if (in_array($idAset, $usedIds)) continue;

            $selected = (isset($c['id_aset_tetap']) && $c['id_aset_tetap'] == $idAset) ? 'selected' : '';
            echo "<option value='$idAset' $selected>$namaWakif</option>";
        }
?><?php echo"	 
</select>
</div>

					<div class='form-group' required><label >PEMANFAATAN</label>
					<input type='text' class='form-control' placeholder='Pemanfaatan' name='pemanfaatan' value='"?><?php echo isset($c['pemanfaatan']) ? $c['pemanfaatan'] : '';?><?php echo"'"?> <?php echo isset($c['pemanfaatan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'required><label >INSTITUSI PENGELOLA</label>
					<input type='text' class='form-control' placeholder='Institusi Pengelola' name='institusi_pengelola' value='"?><?php echo isset($c['institusi_pengelola']) ? $c['institusi_pengelola'] : '';?><?php echo"'"?> <?php echo isset($c['institusi_pengelola']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'required><label >TANGGAL MULAI</label>
					<input type='date' class='form-control' placeholder='Tanggal Mulai' name='tanggal_mulai' value='"?><?php echo isset($c['tanggal_mulai']) ? $c['tanggal_mulai'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal_mulai']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >JUMLAH HASIL PENGEMBANGAN</label>
					<input type='text' class='form-control' placeholder='Jumlah Hasil Pengembangan' name='jumlah_hasil_pengembangan' value='"?><?php echo isset($c['jumlah_hasil_pengembangan']) ? $c['jumlah_hasil_pengembangan'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_hasil_pengembangan']) ? ' ' : ' ';?><?php echo" >				
					<input type='hidden' name='jumlah_hasil_pengembangan_raw' id='jumlah_hasil_pengembangan_raw'>
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
              <h3 class='box-title'>Pemanfaatan wakaf asset tetap</h3><br/>
			  <small>Pemanfaatan wakaf asset tetap</small><br/><br/>
			  <a href='index.php?page=pemanfaatan_wakaf_asset_tetap&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>WAKIF</th>
						<th>PEMANFAATAN</th>
						<th>INSTITUSI PENGELOLA</th>
						<th>TANGGAL MULAI</th>
						<th>JUMLAH HASIL PENGEMBANGAN</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				$query = "SELECT P.*,W.nama_wakif
				FROM pemanfaatan_wakaf_asset_tetap AS p
				LEFT JOIN wakaf_asettetap AS w1 ON p.id_aset_tetap = w1.id_aset_tetap
				LEFT JOIN wakif AS w ON w1.id_wakif = w.id_wakif";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_wakif]</td>
							<td>$m[pemanfaatan]</td>
							<td>$m[institusi_pengelola]</td>
							<td>$m[tanggal_mulai]</td>
                            "?><?php echo'<td>Rp ' . number_format($m['jumlah_hasil_pengembangan'], 0, ',', '.') . '</td>' ?><?php echo"
							<td><a href='index.php?page=pemanfaatan_wakaf_asset_tetap&act=form&id=$m[id_pemanfaatan_wakaf_tetap]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=pemanfaatan_wakaf_asset_tetap&act=hapus&id=$m[id_pemanfaatan_wakaf_tetap]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='7'><div class='w3-center'><i>Data Pemanfaatan wakaf asset tetap Not Found.</i></div></td>
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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('jumlah_hasil_pengembangan');
    const rawInput = document.getElementById('jumlah_hasil_pengembangan_raw');

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

    if (input) {
        input.addEventListener('input', function (e) {
            const rawValue = e.target.value.replace(/[^,\d]/g, '');
            e.target.value = formatRupiahInput(rawValue);

            if (rawInput) {
                rawInput.value = rawValue;
            }
        });
    }
});
</script>


