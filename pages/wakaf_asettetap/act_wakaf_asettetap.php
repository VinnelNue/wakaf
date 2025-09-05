<?php
	session_start();
	include "../../lib/conn.php";
	
	if(!isset($_SESSION['login_user'])){
		header('location: ../../login.php'); // Mengarahkan ke Home Page
	}

	if(isset($_GET['page']) && isset($_GET['act']))
	{
		$mod = $_GET['page'];
		$act = $_GET['act'];
	}
	else
	{
		$mod = "";
		$act = "";
	}
// Fungsi upload file
function handleFileUploadpdf($fieldName, $existingFile = '')
{
    $upload_dir = __DIR__ . "/uploads/";
    $max_size = 2 * 1024 * 1024; // 2MB
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif','pdf'];
    $allowed_mime = ['image/jpeg', 'image/png', 'image/gif','application/pdf'];

    if (!file_exists($upload_dir)) {
        if (!mkdir($upload_dir, 0755, true)) {
            return ['error' => 'Gagal membuat folder upload'];
        }
    }

    if (!is_writable($upload_dir)) {
        return ['error' => 'Folder upload tidak dapat ditulisi'];
    }

    if (isset($_FILES[$fieldName]) && $_FILES[$fieldName]['error'] == UPLOAD_ERR_OK) {
        if ($_FILES[$fieldName]['size'] > $max_size) {
            return ['error' => 'Ukuran file maksimal 2MB'];
        }
        $file_name = basename($_FILES[$fieldName]['name']);
        $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
        if (!in_array($file_ext, $allowed_ext)) {
            return ['error' => 'Format file harus JPG, PNG, atau GIF'];
        }

        $file_info = finfo_open(FILEINFO_MIME_TYPE);
        $mime_type = finfo_file($file_info, $_FILES[$fieldName]['tmp_name']);
        finfo_close($file_info);
        if (!in_array($mime_type, $allowed_mime)) {
            return ['error' => 'Tipe file tidak valid'];
        }

        $new_file_name = preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $file_name);
        $target_path = $upload_dir . $new_file_name;

        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_path)) {
            if (!empty($existingFile)) {
                $old_file = $upload_dir . $existingFile;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
            return ['success' => $new_file_name];
        } else {
            return ['error' => 'Gagal mengupload file'];
        }
    }

    return ['success' => $existingFile];
}

	if($mod == "wakaf_asettetap" AND $act == "simpan")
	{
	$upload_result = handleFileUploadpdf('akte_ikrar_wakaf');
    if (isset($upload_result['error'])) {
        die("<script>alert('" . $upload_result['error'] . "'); window.history.back();</script>");
    }
    $sertifikat_pdf = $upload_result['success'];

		$id_wakif= $_POST['id_wakif'];
		$tanggal= $_POST['tanggal'];
		$jenis_asset_tetap= $_POST['jenis_asset_tetap'];
		$luas= $_POST['luas'];
		$waktu= $_POST['waktu'];
		$bila_muaqot_hingga= $_POST['bila_muaqot_hingga'];
		$penerima_manfaat= $_POST['penerima_manfaat'];
		$surat_kepemilikan= $_POST['surat_kepemilikan'];
		$no_surat_kepemilikan= $_POST['no_surat_kepemilikan'];
		$alamat= $_POST['alamat'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kota_kabupaten= $_POST['kota_kabupaten'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];
		$id_nazir= $_POST['id_nazir'];
		$id_kua= $_POST['id_kua'];
		$akte_ikrar_wakaf= $_POST['akte_ikrar_wakaf'];
        $bila_muaqot_hingga = !empty($_POST['bila_muaqot_hingga']) ? $_POST['bila_muaqot_hingga'] : 'NULL';

		mysqli_query($conn, "INSERT INTO wakaf_asettetap(
										id_wakif, 
										tanggal, 
										jenis_asset_tetap, 
										luas, 
										waktu, 
										bila_muaqot_hingga, 
										penerima_manfaat, 
										surat_kepemilikan, 
										no_surat_kepemilikan, 
										alamat, 
										desa_kelurahan, 
										kecamatan, 
										kota_kabupaten, 
										kode_pos, 
										provinsi, 
										id_nazir, 
										id_kua, 
										akte_ikrar_wakaf)
									VALUES (
										'$id_wakif', 
										'$tanggal', 
										'$jenis_asset_tetap', 
										'$luas', 
										'$waktu', 
										" . ($bila_muaqot_hingga == 'NULL' ? 'NULL' : "'$bila_muaqot_hingga'") . ", 
										'$penerima_manfaat', 
										'$surat_kepemilikan', 
										'$no_surat_kepemilikan', 
										'$alamat', 
										'$desa_kelurahan', 
										'$kecamatan', 
										'$kota_kabupaten', 
										'$kode_pos', 
										'$provinsi', 
										'$id_nazir', 
										'$id_kua', 
										'$sertifikat_pdf')") ;
		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakaf_asettetap" AND $act == "edit") 
	{
	$id_aset_tetap = trim($_POST['id']);
    $get_old = mysqli_query($conn, "SELECT akte_ikrar_wakaf FROM wakaf_asettetap WHERE akte_ikrar_wakaf = '$akte_ikrar_wakaf'");
    $existingFile = ($get_old && $r = mysqli_fetch_assoc($get_old)) ? $r['akte_ikrar_wakaf'] : '';

    $upload_result = handleFileUploadpdf('akte_ikrar_wakaf', $existingFile);
    if (isset($upload_result['error'])) {
        die("<script>alert('" . $upload_result['error'] . "'); window.history.back();</script>");
    }
    $sertifikat_pdf = $upload_result['success'];

		$id_aset_tetap = trim($_POST['id']);
		$id_wakif= $_POST['id_wakif'];
		$tanggal= $_POST['tanggal'];
		$jenis_asset_tetap= $_POST['jenis_asset_tetap'];
		$luas= $_POST['luas'];
		$waktu= $_POST['waktu'];
		$bila_muaqot_hingga= $_POST['bila_muaqot_hingga'];
		$penerima_manfaat= $_POST['penerima_manfaat'];
		$surat_kepemilikan= $_POST['surat_kepemilikan'];
		$no_surat_kepemilikan= $_POST['no_surat_kepemilikan'];
		$alamat= $_POST['alamat'];
		$desa_kelurahan= $_POST['desa_kelurahan'];
		$kecamatan= $_POST['kecamatan'];
		$kota_kabupaten= $_POST['kota_kabupaten'];
		$kode_pos= $_POST['kode_pos'];
		$provinsi= $_POST['provinsi'];
		$id_nazir= $_POST['id_nazir'];
		$id_kua= $_POST['id_kua'];
		$akte_ikrar_wakaf= $_POST['sertifikat_pdf'];
        
        $bila_muaqot_hingga = !empty($_POST['bila_muaqot_hingga']) ? $_POST['bila_muaqot_hingga'] : 'NULL';

		mysqli_query($conn, "UPDATE wakaf_asettetap SET 
										id_wakif= '$id_wakif', 
										tanggal= '$tanggal', 
										jenis_asset_tetap= '$jenis_asset_tetap', 
										luas= '$luas', 
										waktu= '$waktu', 
										bila_muaqot_hingga = " .($bila_muaqot_hingga == 'NULL' ? 'NULL' : "'$bila_muaqot_hingga'") . ", 
										penerima_manfaat= '$penerima_manfaat', 
										surat_kepemilikan= '$surat_kepemilikan', 
										no_surat_kepemilikan= '$no_surat_kepemilikan', 
										alamat= '$alamat', 
										desa_kelurahan= '$desa_kelurahan', 
										kecamatan= '$kecamatan', 
										kota_kabupaten= '$kota_kabupaten', 
										kode_pos= '$kode_pos', 
										provinsi= '$provinsi', 
										id_nazir= '$id_nazir', 
										id_kua= '$id_kua', 
										akte_ikrar_wakaf= '$sertifikat_pdf' 
					WHERE id_aset_tetap = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "wakaf_asettetap" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM wakaf_asettetap WHERE id_aset_tetap = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}

?>