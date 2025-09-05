<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=pengembangan_uang_wakaf';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/pengembangan_uang_wakaf/act_pengembangan_uang_wakaf.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=pengembangan_uang_wakaf&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM pengembangan_uang_wakaf WHERE id_pengembangan__uang_wakaf = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=pengembangan_uang_wakaf");
				}

			}
			else
			{
				$act = "$aksi?page=pengembangan_uang_wakaf&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Pengembangan uang wakaf</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                  
                  <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_pengembangan__uang_wakaf']) ? $c['id_pengembangan__uang_wakaf'] : '';?><?php echo"'"?> <?php echo isset($c['id_pengembangan__uang_wakaf']) ? ' readonly' : ' ';?><?php echo" >
								</div>
							<div class='form-group'>
    <label>NAMA WAKTIF</label>
<select class='form-control' required name='id_uang_wakaf'>"?><?php echo"
    <option value=''>-- Pilih WAKIF --</option>"?><?php
    
    $wakifQuery = mysqli_query($conn, "
        SELECT u.id_uang_wakaf, w.nama_wakif, u.jumlah_uang
        FROM uang_wakaf AS u
        INNER JOIN wakif AS w ON u.id_wakif = w.id_wakif
        ORDER BY u.id_uang_wakaf DESC
        LIMIT 1
    ") or die(mysqli_error($conn));

    while ($row = mysqli_fetch_assoc($wakifQuery)) {
        $id_uang_wakaf = $row['id_uang_wakaf'];
        $nama_wakif = $row['nama_wakif'];
        $jumlah_uang = $row['jumlah_uang'];

        // Buat label
        $label = "$nama_wakif - Rp" . number_format($jumlah_uang, 0, ',', '.') .
                 "";

        $selected = (isset($c['id_uang_wakaf']) && $c['id_uang_wakaf'] == $id_uang_wakaf)
                    ? 'selected' : '';

        echo "<option value='$id_uang_wakaf' $selected>$label</option>";
    }
    ?><?php echo"
</select>
</div>
					<div class='form-group'><label >INSTRUMENT PENGEMBANGAN</label>
					<input type='text' required class='form-control' placeholder='Instrument Pengembangan' name='instrument_pengembangan' value='"?><?php echo isset($c['instrument_pengembangan']) ? $c['instrument_pengembangan'] : '';?><?php echo"'"?> <?php echo isset($c['instrument_pengembangan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'>
					<label>INSTITUSI PENGELOLA</label>
					<input type='text' required class='form-control' placeholder='Institusi Pengelola' name='institusi_pengelola' value='"?><?php echo isset($c['institusi_pengelola']) ? $c['institusi_pengelola'] : '';?><?php echo"'"?> <?php echo isset($c['institusi_pengelola']) ? ' ' : ' ';?><?php echo" >
										</div>
						<div class='form-group'><label >JUMLAH UANG</label>
						<input type='text' required id='jumlah_uang' class='form-control' placeholder='Jumlah Uang' name='jumlah_uang' value='"?><?php echo isset($c['jumlah_uang']) ? $c['jumlah_uang'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_uang']) ? ' ' : ' ';?><?php echo" >
						<input type='hidden' name='jumlah_uang_raw' id='jumlah_uang_raw' value='"?><?php echo isset($c['jumlah_uang']) ? $c['jumlah_uang'] : ''; ?><?php echo"'"?><?php echo isset($c['jumlah_uang']) ? ' ' : ' ';?><?php echo" >
						</div>
					<div class='form-group'><label >TANGGAL MULAI</label>
					<input type='date' required class='form-control' placeholder='Tanggal Mulai' name='tanggal_mulai' value='"?><?php echo isset($c['tanggal_mulai']) ? $c['tanggal_mulai'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal_mulai']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >TANGGAL BERAKHIR</label>
					<input type='date' required class='form-control' placeholder='Tanggal Berakhir' name='tanggal_berakhir' value='"?><?php echo isset($c['tanggal_berakhir']) ? $c['tanggal_berakhir'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal_berakhir']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PERSENTASE HASIL PENGEMBANGAN</label>
					<input type='number' required step='0.0001' class='form-control' id='persentase' placeholder='%' name='persentase_hasil_pengembangan' value='"?><?php echo isset($c['persentase_hasil_pengembangan']) ? $c['persentase_hasil_pengembangan'] : '';?><?php echo"'"?> <?php echo isset($c['persentase_hasil_pengembangan']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label > HASIL PERKEMBANGAN</label>
					<input readonly type='text' class='form-control' id='jumlah_hasil_perkembangan' placeholder='Jumlah Hasil Perkembangan' name='jumlah_hasil_perkembangan' value='"?><?php echo isset($c['jumlah_hasil_perkembangan']) ? $c['jumlah_hasil_perkembangan'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_hasil_perkembangan']) ? ' readonly' : ' ';?><?php echo" >
					<input type='hidden' name='jumlah_hasil_perkembangan_raw' id='jumlah_hasil_perkembangan_raw'>					
					</div>
                    <div class='box-footer'>
				<button type='submit' class='btn btn-primary'>Submit</button>
<button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
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
              <h3 class='box-title'>Pengembangan uang wakaf</h3><br/>
			  <small>Data perkembengan</small><br/><br/>
			  <a href='index.php?page=pengembangan_uang_wakaf&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
            <div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped' >
                <thead>
                <tr>
					<th>No</th>
						<th>INSTRUMENT PENGEMBANGAN</th>
						<th>INSTITUSI PENGELOLA</th>
						<th>JUMLAH UANG</th>
						<th>TANGGAL MULAI</th>
						<th>TANGGAL BERAKHIR</th>
						<th>PERSENTASE HASIL PENGEMBANGAN</th>
						<th>JUMLAH HASIL PERKEMBANGAN</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";  
				//<th>ID UANG WAKAF</th><td>$m[nama_wakif]</td>
$query = "SELECT p.*,u.id_wakif,w.nama_wakif
          FROM pengembangan_uang_wakaf AS p
          LEFT JOIN uang_wakaf AS u 
             ON p.id_uang_wakaf = u.id_uang_wakaf
          LEFT JOIN wakif AS w 
             ON u.id_wakif = w.id_wakif";


				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[instrument_pengembangan]</td>
							<td>$m[institusi_pengelola]</td>"
    				     	?><?php echo'<td>Rp ' . number_format($m['jumlah_uang'], 0, ',', '.') . '</td>'?><?php echo"
							<td>$m[tanggal_mulai]</td>
							<td>$m[tanggal_berakhir]</td>
                            "?><?php echo'<td>' . number_format($m['persentase_hasil_pengembangan'], 2, ',', '.') . '%</td>' ?><?php echo"
                            "?><?php echo'<td>Rp ' . number_format($m['jumlah_hasil_perkembangan'], 0, ',', '.') . '</td>' ?><?php echo"
                            <td><a href='index.php?page=pengembangan_uang_wakaf&act=form&id=$m[id_pengembangan__uang_wakaf]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a>
							<a href='$aksi?page=pengembangan_uang_wakaf&act=hapus&id=$m[id_pengembangan__uang_wakaf]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
						    <a href='javascript:void(0)' 
                   onclick='showDetailpengembangan({$m['id_pengembangan__uang_wakaf']})'
                   class='w3-text-green'>
                    <i class='fa fa-eye w3-large'></i>
                </a></td>
						
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='10'><div class='w3-center'><i>Data Pengembangan uang wakaf Not Found.</i></div></td>
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
<div id="detailPopuppengembangan" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Pengembangan</h4>
            </div>
            <div class="modal-body" id="detailContentpengembangan">
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
		  function showDetailpengembangan(id) {
    $('#detailPopuppengembangan').modal('show');
    $.ajax({
        url: 'pages/pengembangan_uang_wakaf/pengembanganpopup.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContentpengembangan').html(response);
        },
        error: function() {
            $('#detailContentpengembangan').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}

document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("input[name='jumlah_uang']");
    const inputRaw = document.getElementById("jumlah_uang_raw");
    const selectWakif = document.querySelector("select[name='id_uang_wakaf']");
    const persenInput = document.getElementById("persentase");
    const hasilPerkembangan = document.getElementById("jumlah_hasil_perkembangan");

    // Format angka ke Rupiah
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

    // Hitung hasil pengembangan
  function hitungPerkembangan() {
    const jumlah = parseFloat(inputRaw?.value || 0);
    const persen = parseFloat(persenInput?.value || 0);

    if (!isNaN(jumlah) && !isNaN(persen)) {
        const hasil = (jumlah * persen) / 100;
        hasilPerkembangan.value = formatRupiahInput(hasil.toFixed(0));

        const hidden = document.getElementById("jumlah_hasil_perkembangan_raw");
        if (hidden) {
            hidden.value = hasil.toFixed(0);
        }
    } else {
        hasilPerkembangan.value = '';
        const hidden = document.getElementById("jumlah_hasil_perkembangan_raw");
        if (hidden) hidden.value = '';
    }
}
    if (input && inputRaw) {
        input.addEventListener('input', function () {
            const numeric = this.value.replace(/[^0-9]/g, '');
            this.value = formatRupiahInput(numeric);
            inputRaw.value = numeric || '';
            hitungPerkembangan();
        });
    }
    
    // Event input persentase
    if (persenInput) {
        persenInput.addEventListener('input', hitungPerkembangan);
    }

    // Event change pilih wakif
    if (selectWakif) {
        selectWakif.addEventListener("change", function () {
            const idWakif = this.value;
            if (idWakif) {
                fetch("pages/pengembangan_uang_wakaf/get_uang_wakaf.php?id_uang_wakaf=" + idWakif)
    .then(response => response.text())
    .then(text => {
        try {
            const data = JSON.parse(text);
            const total = data.jumlah || '';
            input.value = formatRupiahInput(total.toString());
            inputRaw.value = total.toString();
            hitungPerkembangan();
        } catch (e) {
            console.error("Gagal parsing JSON:", text);
        }
    })
    .catch(err => {
        console.error("Gagal ambil data:", err);
    });

            }
        });
    }

    // Inisialisasi saat halaman pertama kali dibuka
    if (input && inputRaw) {
        input.value = formatRupiahInput(inputRaw.value || '');
    }
    hitungPerkembangan();
});

</script>
