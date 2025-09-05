<?php
	if(!isset($_SESSION['login_user']) || !isset($_SESSION['token'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=uang_wakaf';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/uang_wakaf/act_uang_wakaf.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=uang_wakaf&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM uang_wakaf WHERE id_uang_wakaf = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=uang_wakaf");
				}

			}
			else
			{
				$act = "$aksi?page=uang_wakaf&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Uang wakaf</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
                <div class='form-group'>
                         <input type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_uang_wakaf']) ? $c['id_uang_wakaf'] : '';?><?php echo"'"?> <?php echo isset($c['id_uang_wakaf']) ? ' readonly' : ' ';?><?php echo" >
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
					<input type='date' required class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
							<div class='form-group'><label >JUMLAH UANG</label>
						<input type='text' class='form-control' placeholder='Jumlah Uang' name='jumlah_uang' value='"?><?php echo isset($c['jumlah_uang']) ? $c['jumlah_uang'] : '';?><?php echo"'"?><?php echo isset($c['jumlah_uang']) ? ' ' : ' ';?><?php echo" >
						<input type='hidden' name='jumlah_uang_raw' id='jumlah_uang_raw' value='"?><?php echo isset($c['jumlah_uang']) ? $c['jumlah_uang'] : ''; ?><?php echo"'"?><?php echo isset($c['jumlah_uang']) ? ' ' : ' ';?><?php echo" >
						</div>

<div class='form-group'>
    <label>WAKTU</label>
    <select class='form-control' name='waktu' required>
        <option value=''>-- Pilih Waktu --</option>
        <option value='Wakaf Mu_abbad'"?><?php if(isset($c['waktu']) && $c['waktu'] == 'Wakaf Mu_abbad') echo 'selected'; ?><?php echo "> Wakaf Mu'abbad (Permanen)"?></option><?php echo" >
        <option value='Wakaf Mu_aqot'"?><?php if(isset($c['waktu']) && $c['waktu'] == 'Wakaf Mu_aqot') echo 'selected'; ?><?php echo" >Wakaf Mu'aqot (Sementara)"?></option><?php echo" >
    </select>
</div>

					<div class='form-group'><label >BILA MU'AQOT SAMPAI TANGGAL</label>
					<input type='date' class='form-control' placeholder='Bila Mu'aqot Sampai Tanggal' name='bila_muaqot_sampai_tanggal' value='"?><?php echo isset($c['bila_muaqot_sampai_tanggal']) ? $c['bila_muaqot_sampai_tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['bila_muaqot_sampai_tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
				<div class='form-group'>
    <label>Penerima Manfaat (Mauquf Alaih)</label>
    <select class='form-control' name='penerima_manfaat' required>
        <option value=''>-- Penerima manfaat --</option>
        <option value='Wakaf Ahli/Dzurri'"?><?php if(isset($c['penerima_manfaat']) && $c['penerima_manfaat'] == 'Wakaf Ahli/Dzurri') echo 'selected'; ?><?php echo " > Wakaf Ahli/Dzurri (Keluarga)"?></option><?php echo" >
        <option value='Wakaf Kahiri'"?><?php if(isset($c['penerima_manfaat']) && $c['penerima_manfaat'] == 'Wakaf Kahiri') echo 'selected'; ?><?php echo" >Wakaf Kahiri (Umum)"?></option><?php echo" >
		<option value='Wakaf Musytarak'"?><?php if(isset($c['penerima_manfaat']) && $c['penerima_manfaat'] == 'Wakaf Musytarak') echo 'selected'; ?><?php echo" >Wakaf Musytarak (Umum & Keluarga)"?></option><?php echo" >
    </select>
</div>

					<div class='form-group'><label >DETAIL PENERIMA MANFAAT</label>
					<input type='text' required class='form-control' placeholder='Detail Penerima Manfaat' name='detail_penerima_manfaat' value='"?><?php echo isset($c['detail_penerima_manfaat']) ? $c['detail_penerima_manfaat'] : '';?><?php echo"'"?> <?php echo isset($c['detail_penerima_manfaat']) ? ' ' : ' ';?><?php echo" >
										</div>
								<div class='form-group'>

    <label>Nama Nazir</label>
    <select class='form-control' name='id_nazir' required>"?><?php echo"
        <option value=''>-- Pilih Nazir --</option>"?><?php
        
        // mengamil data dari tabel wakif
        $wakifQuery = mysqli_query($conn, "SELECT id_nazir, nama_nazir FROM data_nazir");
        while ($row = mysqli_fetch_assoc($wakifQuery)) {
            $selected = (isset($c['id_nazir']) && $c['id_nazir'] == $row['id_nazir']) ? 'selected' : '';
            echo "<option value='{$row['id_nazir']}' $selected>{$row['nama_nazir']}</option>";
        }
        ?><?php echo"
    </select>
</div>
					<div class='form-group'><label >LKS PENERIMA WAKAF UANG</label>
					<input type='text' class='form-control' placeholder='Lks Penerima Wakaf Uang' name='lks_penerima_wakaf_uang' value='"?><?php echo isset($c['lks_penerima_wakaf_uang']) ? $c['lks_penerima_wakaf_uang'] : '';?><?php echo"'"?> <?php echo isset($c['lks_penerima_wakaf_uang']) ? ' ' : ' ';?><?php echo" required>
										</div>
					<div class='form-group'><label >NOMOR SERTIFIKAT</label>
					<input type='text' class='form-control' placeholder='Nomor Sertifikat' name='nomor_sertifikat' value='"?><?php echo isset($c['nomor_sertifikat']) ? $c['nomor_sertifikat'] : '';?><?php echo"'"?> <?php echo isset($c['nomor_sertifikat']) ? ' ' : ' ';?><?php echo"required >
										</div>
	  
	            <div class='form-group'>
              <label for='sertifikat_wakaf_uang'required>Sertifikat</label>
             <input type='file' class='form-control' placeholder='file sertifikat' name='sertifikat_wakaf_uang' value='"?><?php echo isset($c['sertifikat_wakaf_uang']) ? $c['sertifikat_wakaf_uang'] : '';?><?php echo"'"?> <?php echo isset($c['sertifikat_wakaf_uang']) ? ' ' : ' ';?><?php echo" required >
			 </div>
	<small class='text-muted'>Format JPG/PNG, max 2MB</small>
</div><div class='box-footer'>
					<button type='submit' class='btn btn-primary'>Submit</button> <button type='button' class='btn btn-primary' onclick='history.back()'><i class='fa fa-rotate-left'></i> Kembali</button>
				</div>
			  </div>			
            </form>
          </div>
		";
		break;

		default :
		echo"
		<div class='col-xs-12'>
         <div class='box'>
            <div class='box-header'>
              <h3 class='box-title'>Wakaf Uang</h3><br/>
			  <small>Wakaf Uang</small><br/><br/>
			  <a href='index.php?page=uang_wakaf&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
            <div class='table-responsive'>
              <table id='example1'class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
						<th>NAMA WAKIF</th>
						<th>TANGGAL</th>
						<th>JUMLAH UANG</th>
						<th>WAKTU</th>
						<th>BILA MU'AQOT SAMPAI TANGGAL</th>
						<th>PENERIMA MANFAAT</th>
						<th>DETAIL PENERIMA MANFAAT</th>
						<th>NAMA NAZIR</th>
						<th>LKS PENERIMA WAKAF UANG</th>
						<th>NOMOR SERTIFIKAT</th>
						<th>SERTIFIKAT WAKAF UANG</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";
				   $query = "SELECT u.*, w.nama_wakif ,d.nama_nazir
       						  FROM uang_wakaf AS u
        					  LEFT JOIN wakif w ON u.id_wakif = w.id_wakif
							  LEFT JOIN data_nazir d ON u.id_nazir = d.id_nazir";
				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				//tinggal menambah nama_wakif jika ingin nama wakif yang di tampilkan
				// :
		if ($fd_kul > 0) {
    $no = 1;
    while ($m = mysqli_fetch_assoc($sql_kul)) {
        echo '<tr>
            <td>' . $no . '</td>
            <td>'. $m['nama_wakif'].'</td>
            <td>' . $m['tanggal'] . '</td>
           <td>Rp ' . number_format($m['jumlah_uang'], 0, ',', '.') . '</td>
            <td>' . $m['waktu'] . '</td>
            <td>' . $m['bila_muaqot_sampai_tanggal'] . '</td>
            <td>' . $m['penerima_manfaat'] . '</td>
            <td>' . $m['detail_penerima_manfaat'] . '</td>
            <td>' . $m['nama_nazir'] . '</td>
            <td>' . $m['lks_penerima_wakaf_uang'] . '</td>
            <td>' . $m['nomor_sertifikat'] . '</td>
            <td>
                <img src="pages/uang_Wakaf/uploads_sertifikat/' . $m['sertifikat_wakaf_uang'] . '" 
                     alt="File Gambar" 
                     class="icon-img" 
                     onerror="this.onerror=null;this.src=\'image-not-found.png\';this.alt=\'Image Not Found\';" 
                     style="max-width:100px;max-height:100px;cursor:pointer"
					 onclick="openModal(this.src)">
            </td>
			'?><?php echo"		
			<td><a href='index.php?page=uang_wakaf&act=form&id=$m[id_uang_wakaf]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
			<a href='$aksi?page=uang_wakaf&act=hapus&id=$m[id_uang_wakaf]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
							</a>
							  <a href='javascript:void(0)' 
                   onclick='showDetailwakafuang({$m['id_uang_wakaf']})'
                   class='w3-text-green'>
                    <i class='fa fa-eye w3-large'></i>
                </a>
							</td>
				"?>	<?php echo'	
        </tr>';
        $no++;
    }
}
				else
				{
					echo"<tr>
						<td colspan='13'><div class='w3-center'><i>Data Uang wakaf Not Found.</i></div></td>
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
<div id="detailPopupwakaf" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Ahli Waris</h4>
            </div>
            <div class="modal-body" id="detailContentwakaf">
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

	
?><script>
document.addEventListener("DOMContentLoaded", function () {
    const input = document.querySelector("input[name='jumlah_uang']");
    const inputRaw = document.getElementById("jumlah_uang_raw");
    const selectWakif = document.querySelector("select[name='id_wakif']");

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

input.addEventListener('input', function () {
    const numeric = this.value.replace(/[^0-9]/g, ''); 
    this.value = formatRupiahInput(numeric);
    if (inputRaw) inputRaw.value = numeric || '';
});


    // Saat pilih wakif
    if (selectWakif) {
        selectWakif.addEventListener("change", function () {
            const idWakif = this.value;

            if (idWakif) {
                fetch("pages/uang_wakaf/jumlahuang.php?id_wakif=" + idWakif)
                    .then(response => response.json())
                    .then(data => {
                        const total = data.jumlah || '';
                        input.value = formatRupiahInput(total.toString());
                        if (inputRaw) inputRaw.value = total.toString();
                    })
                    .catch(err => {
                        console.error("Gagal ambil data:", err);
                    });
            } else {
                input.value = 'Rp';
                if (inputRaw) inputRaw.value = '';
            }
        });
    }

    // Inisialisasi awal
    input.value = formatRupiahInput(inputRaw?.value || '');
});
  function showDetailwakafuang(id) {
    $('#detailPopupwakaf').modal('show');
    $.ajax({
        url: 'pages/uang_wakaf/popupwakaf.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailContentwakaf').html(response);
        },
        error: function() {
            $('#detailContentwakaf').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}
</script>
