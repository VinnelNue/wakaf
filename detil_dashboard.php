<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=pendistribusian_uang_wakaf';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/pendistribusian_uang_wakaf/act_pendistribusian_uang_wakaf.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=pendistribusian_uang_wakaf&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM pendistribusian_uang_wakaf WHERE id_pendistribusian_uangwakaf = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=pendistribusian_uang_wakaf");
				}

			}
			else
			{
				$act = "$aksi?page=pendistribusian_uang_wakaf&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Distribusi wakaf</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_pendistribusian_uangwakaf']) ? $c['id_pendistribusian_uangwakaf'] : '';?><?php echo"'"?> <?php echo isset($c['id_pendistribusian_uangwakaf']) ? ' readonly' : ' ';?><?php echo" >
								</div>
										<div class='form-group'>
    <label>NAMA WAKIF</label>
    <select class='form-control' name='id_pengembangan__uang_wakaf'>"?><?php echo"
        <option value=''>-- Pilih WAKIF --</option>"?><?php
        
        // mengamil data dari tabel wakif
$wakifQuery = mysqli_query($conn, "
SELECT 
    pengembangan_uang_wakaf.id_pengembangan__uang_wakaf,
    wakif.nama_wakif
FROM 
    pengembangan_uang_wakaf
INNER JOIN uang_wakaf 
    ON pengembangan_uang_wakaf.id_uang_wakaf = uang_wakaf.id_uang_wakaf
INNER JOIN wakif 
    ON uang_wakaf.id_wakif = wakif.id_wakif
");


        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $selected = (isset($c['id_pengembangan__uang_wakaf']) && $c['id_pengembangan__uang_wakaf'] == $row['id_pengembangan__uang_wakaf']) ? 'selected' : '';
            echo "<option value='{$row['id_pengembangan__uang_wakaf']}' $selected>{$row['nama_wakif']}</option>";
        }
        ?><?php echo"
    </select>
</div>
					<div class='form-group'><label >TANGGAL</label>
					<input type='date' class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'>
					<label >PENERIMA MANFAAT WAKAF</label>
								
    <select class='form-control' name='id_penerima_manfaat_wakaf'required >"?><?php echo"
        <option value=''>-- Pilih Penerima --</option>"?><?php
        
        // mengamil data dari tabel wakif
$wakifQuery = mysqli_query($conn, "SELECT id_penerima_manfaat_wakaf, nama_penerima FROM penerima_uang_wakaf");
        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $selected = (isset($c['id_penerima_manfaat_wakaf']) && $c['id_penerima_manfaat_wakaf'] == $row['id_penerima_manfaat_wakaf']) ? 'selected' : '';
            echo "<option value='{$row['id_penerima_manfaat_wakaf']}' $selected>{$row['nama_penerima']}</option>";
        }
        ?><?php echo"
    </select>
</div>
					<div class='form-group'><label >BESAR MANFAAT WAKAF DITERIMA</label>
					<input type='text' class='form-control' placeholder='Besar Manfaat Wakafditerima' name='besar_manfaat_wakafditerima' value='"?><?php echo isset($c['besar_manfaat_wakafditerima']) ? $c['besar_manfaat_wakafditerima'] : '';?><?php echo"'"?> <?php echo isset($c['besar_manfaat_wakafditerima']) ? ' ' : ' ';?><?php echo" >
					<input type='hidden' id='besar_manfaat_wakafditerimaraw' name='besar_manfaat_wakafditerimaraw' />
					</div>
					<div class='form-group'><label >MAKSUD PENGUNAAN </label>
					<input type='text' class='form-control' placeholder='Tujuan Pengunaan Wakaf Uang' name='tujuan_pengunaan_wakaf_uang' value='"?><?php echo isset($c['tujuan_pengunaan_wakaf_uang']) ? $c['tujuan_pengunaan_wakaf_uang'] : '';?><?php echo"'"?> <?php echo isset($c['tujuan_pengunaan_wakaf_uang']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PETUGAS PELAKSANA</label>
					<input type='text' class='form-control' placeholder='Petugas Pelaksana' name='petugas_pelaksana' value='"?><?php echo isset($c['petugas_pelaksana']) ? $c['petugas_pelaksana'] : '';?><?php echo"'"?> <?php echo isset($c['petugas_pelaksana']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Distribusi wakaf</h3><br/>
			  <small>Data distribusi</small><br/><br/>
			  <a href='index.php?page=pendistribusian_uang_wakaf&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
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
							<td><a href='index.php?page=pendistribusian_uang_wakaf&act=form&id=$m[id_pendistribusian_uangwakaf]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=pendistribusian_uang_wakaf&act=hapus&id=$m[id_pendistribusian_uangwakaf]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
							  <a href='javascript:void(0)' 
                   onclick='showDetaildistribusi({$m['id_pendistribusian_uangwakaf']})'
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
<div id="detailPopupdist" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Pengembangan</h4>
            </div>
            <div class="modal-body" id="detailContentdist">
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
    		break;
	}
?>

<script>    
function showDetaildistribusi1(id) {
    $('#detailPopupdist1').modal('show');
    $.ajax({
        url: 'detil_dashboard.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContentdist1').html(response);
        },
        error: function() {
            $('#detailContentdist1').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("input[name='besar_manfaat_wakafditerima']");
    const inputRaw = document.getElementById("besar_manfaat_wakafditerimaraw");
    const selectPengembangan = document.querySelector("select[name='id_pengembangan__uang_wakaf']");

    // Fungsi untuk memformat angka ke format Rupiah
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

    // Saat dropdown pengembangan dipilih
    if (selectPengembangan) {
        selectPengembangan.addEventListener("change", function () {
            const idPengembangan = this.value;
            console.log("ID Pengembangan dipilih:", idPengembangan); // debug log

            if (idPengembangan) {
                // Ubah di sini parameternya agar cocok dengan PHP
                fetch("pages/pendistribusian_uang_wakaf/pendistribusian_hasil.php?id_pengembangan=" + idPengembangan)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error("HTTP error " + response.status);
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log("Data dari server:", data); // debug log
                        const total = data.jumlah ?? '0';
                        input.value = formatRupiahInput(total.toString());
                        if (inputRaw) inputRaw.value = total.toString();
                    })
                    .catch(err => {
                        console.error("Gagal ambil data:", err);
                        input.value = 'Rp';
                        if (inputRaw) inputRaw.value = '';
                    });
            } else {
                input.value = 'Rp';
                if (inputRaw) inputRaw.value = '';
            }
        });
    }

    // Jika sudah ada value awal, format ulang saat form dimuat
    if (input && inputRaw) {
        input.value = formatRupiahInput(inputRaw.value || '');
    }

    // Format manual input ketika diketik
    input.addEventListener('input', function () {
        const numeric = this.value.replace(/[^0-9]/g, '');
        this.value = formatRupiahInput(numeric);
        if (inputRaw) inputRaw.value = numeric || '';
    });
});
</script>
