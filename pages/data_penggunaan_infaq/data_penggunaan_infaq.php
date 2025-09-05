<?php
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	//link buat paging
	$linkaksi = 'index.php?page=data_penggunaan_infaq';

	if(isset($_GET['act']))
	{
		$act = $_GET['act'];
		$linkaksi .= '&act=$act';
	}
	else
	{
		$act = '';
	}

	$aksi = 'pages/data_penggunaan_infaq/act_data_penggunaan_infaq.php';

	switch ($act) {
		case 'form':
			if(!empty($_GET['id']))
			{
				$act = "$aksi?page=data_penggunaan_infaq&act=edit";
				$query = mysqli_query($conn, "SELECT * FROM data_penggunaan_infaq WHERE id_pemanfaatan = '$_GET[id]'");
				$temukan = mysqli_num_rows($query);
				if($temukan > 0)
				{
					$c = mysqli_fetch_assoc($query);
				}
				else
				{
					header("location:index.php?page=data_penggunaan_infaq");
				}

			}
			else
			{
				$act = "$aksi?page=data_penggunaan_infaq&act=simpan";
			}

		echo"<div class='col-md-12'>
          <div class='box box-primary'>
            <div class='box-header with-border'>
              <h3 class='box-title'> Data Pengunaan Infaq</h3>
			</div>";
			
            echo"<form role='form'  method='POST' action='$act' enctype='multipart/form-data' >
              <div class='box-body'>
			  
                <div class='form-group'>                  
                  <input required type='hidden' class='form-control' name='id' value='"?><?php echo isset($c['id_pemanfaatan']) ? $c['id_pemanfaatan'] : '';?><?php echo"'"?> <?php echo isset($c['id_pemanfaatan']) ? ' readonly' : ' ';?><?php echo" >
								</div>
								<div class='form-group'>
    <label>PETUGAS PENERIMA INFAQ</label>
    <select required class='form-control' name='id_infaq' id='id_infaq'>"?><?php echo"
        <option value=''>-- Pilih Petugas --</option>"?><?php
        
        // mengamil data dari tabel wakif
        $query_penerima = mysqli_query($conn, "
    SELECT id_infaq, nama_petugas 
    FROM penerimaan_infaq 
    WHERE id_infaq NOT IN (
        SELECT DISTINCT id_infaq FROM data_penggunaan_infaq )");
        while ($row = mysqli_fetch_assoc($query_penerima)) {
            $selected = (isset($c['id_infaq']) && $c['id_infaq'] == $row['id_infaq']) ? 'selected' : '';
            echo "<option value='{$row['id_infaq']}' $selected>{$row['nama_petugas']}</option>";
        }
        ?><?php echo"
    </select>     
	
    </div>
					<div class='form-group'><label >TANGGAL</label>
					<input required type='date' class='form-control' placeholder='Tanggal' name='tanggal' value='"?><?php echo isset($c['tanggal']) ? $c['tanggal'] : '';?><?php echo"'"?> <?php echo isset($c['tanggal']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >PENGUNAAN</label>
					<input required type='text' class='form-control' placeholder='Pengunaan' name='pengunaan' value='"?><?php echo isset($c['pengunaan']) ? $c['pengunaan'] : '';?><?php echo"'"?> <?php echo isset($c['pengunaan']) ? ' ' : ' ';?><?php echo" >
										</div>
						<div class='form-group'><label >JUMLAH DIGUNAKAN</label>
						<input type='text' id='jumlah_digunakan' class='form-control' placeholder='Jumlah digunakan' name='jumlah_digunakan' value='"?><?php echo isset($c['jumlah_digunakan']) ? $c['jumlah_digunakan'] : '';?><?php echo"'"?> <?php echo isset($c['jumlah_digunakan']) ? ' ' : ' ';?><?php echo" >
						<input type='hidden' name='jumlah_digunakan_raw' id='jumlah_digunakan_raw' value='"?><?php echo isset($c['jumlah_digunakan']) ? $c['jumlah_digunakan'] : ''; ?><?php echo"'"?><?php echo isset($c['jumlah_digunakan']) ? ' ' : ' ';?><?php echo" >
						</div>
					<div class='form-group'><label >PELAKSANA</label>
					<input required type='text' class='form-control' placeholder='Pelaksana' name='pelaksana' value='"?><?php echo isset($c['pelaksana']) ? $c['pelaksana'] : '';?><?php echo"'"?> <?php echo isset($c['pelaksana']) ? ' ' : ' ';?><?php echo" >
										</div>
					<div class='form-group'><label >KETERANGAN</label>
					<input required type='text' class='form-control' placeholder='Keterangan' name='keterangan' value='"?><?php echo isset($c['keterangan']) ? $c['keterangan'] : '';?><?php echo"'"?> <?php echo isset($c['keterangan']) ? ' ' : ' ';?><?php echo" >
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
              <h3 class='box-title'>Data Pengunaan Infaq</h3><br/>
			  <small>Data Pengunaan Infaq</small><br/><br/>
			  <a href='index.php?page=data_penggunaan_infaq&act=form' class='w3-btn w3-big w3-blue' style='font-size:16px'><i class='fa fa-file'></i> ADD DATA</a>
            </div>
            <div class='box-body'>
			<div class='table-responsive'>
              <table id='example1' class='table table-bordered table-striped'>
                <thead>
                <tr>
					<th>No</th>
					 	<th>Nama</th>
						<th>TANGGAL</th>
						<th>PENGUNAAN</th>
						<th>JUMLAH DIGUNAKAN</th>
						<th>PELAKSANA</th>
						<th>KETERANGAN</th>
						<th>Action</th>
                </tr>
                </thead>
                <tbody>";

$query = "SELECT p.id_infaq, d.*, i.nama_pemberi 
FROM data_penggunaan_infaq d
LEFT JOIN penerimaan_infaq p ON d.id_infaq = p.id_infaq
LEFT JOIN data_pemberi_infaq i ON p.id_pemberi_infaq = i.id_pemberi_infaq";

				$sql_kul = mysqli_query($conn, $query);
				$fd_kul = mysqli_num_rows($sql_kul);
				//<td>$m[nama_pemberi]</td>
				if($fd_kul > 0)
				{
					$no =  1;
					while ($m = mysqli_fetch_assoc($sql_kul)) {
						echo"<tr>
						
							<td>$no</td>
							<td>$m[nama_pemberi]</td>
							<td>$m[tanggal]</td>
							<td>$m[pengunaan]</td>
							 "?><?php echo'<td>Rp ' . number_format($m['jumlah_digunakan'], 0, ',', '.') . '</td>' ?><?php echo"
                            <td>$m[pelaksana]</td>
							<td>$m[keterangan]</td>
							<td><a href='index.php?page=data_penggunaan_infaq&act=form&id=$m[id_pemanfaatan]'><i class='fa fa-pencil-square w3-large w3-text-blue'></i></a> 
							<a href='$aksi?page=data_penggunaan_infaq&act=hapus&id=$m[id_pemanfaatan]' onclick=\"return confirm('Are You sure want to delete?');\"><i class='fa fa-trash w3-large w3-text-red'></i></a>
						  <a href='javascript:void(0)'onclick='showmutasipenngunaaninfaq({$m['id_pemanfaatan']})'class='w3-text-green'>
                    <i class='fa fa-eye w3-large'></i>
                </a></td>
						</tr>";
						$no++;
					}
				}
				else
				{
					echo"<tr>
						<td colspan='8'><div class='w3-center'><i>Data data_penggunaan_infaq Not Found.</i></div></td>
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
<div id="detailpopenggunaaninfaq" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Detail Pengembangan</h4>
            </div>
            <div class="modal-body" id="detailcontenpenggunaaninfaq">
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
</div>';
		break;
	}

	
?>	
<script>
     function showmutasipenngunaaninfaq(id) {
    $('#detailpopenggunaaninfaq').modal('show');
    $.ajax({
        url: 'pages/data_penggunaan_infaq/po_data_penggunaan_infaq.php?action=view&id=' + id,
        type: 'GET',
        success: function(response) {
            $('#detailcontenpenggunaaninfaq').html(response);
        },
        error: function() {
            $('#detailcontenpenggunaaninfaq').html('<div class="alert alert-danger">Gagal memuat data</div>');
        }
    });
}  
document.addEventListener("DOMContentLoaded", function () {
    const select = document.getElementById("id_infaq");
    const inputJumlah = document.getElementById("jumlah_digunakan");
    const inputJumlahRaw = document.getElementById("jumlah_digunakan_raw");

    // Fungsi untuk format ke Rupiah
    function formatRupiah(angka) {
        let number_string = angka.toString().replace(/[^,\d]/g, ''),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            let separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] !== undefined ? rupiah + ',' + split[1] : rupiah;
        return 'Rp ' + rupiah;
    }

    if (select && inputJumlah) {
        select.addEventListener("change", function () {
            const id = this.value;
            if (id) {
                fetch("pages/data_penggunaan_infaq/get_jumlah_digunakan.php?id_infaq=" + id)
                    .then(response => response.json())
                    .then(data => {
                        const raw = data.jumlah || 0;
                        inputJumlah.value = formatRupiah(raw);
                        if (inputJumlahRaw) inputJumlahRaw.value = raw;
                    })
                    .catch(error => {
                        console.error("Gagal ambil jumlah:", error);
                        inputJumlah.value = '';
                        if (inputJumlahRaw) inputJumlahRaw.value = '';
                    });
            } else {
                inputJumlah.value = '';
                if (inputJumlahRaw) inputJumlahRaw.value = '';
            }
        });
    }
});
</script>