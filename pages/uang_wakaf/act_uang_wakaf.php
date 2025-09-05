<?php
session_start();
include "../../lib/conn.php";

if(!isset($_SESSION['login_user'])){
    header('location: ../../login.php');
}

if(isset($_GET['page']) && isset($_GET['act'])) {
    $mod = $_GET['page'];
    $act = $_GET['act'];
} else {
    $mod = "";
    $act = "";
}
// Fungsi upload file
function handleFileUpload($fieldName, $existingFile = '')
{
    $upload_dir = __DIR__ . "/uploads_sertifikat/";
    $max_size = 2 * 1024 * 1024; // 2MB
    $allowed_ext = ['jpg', 'jpeg', 'png', 'gif'];
    $allowed_mime = ['image/jpeg', 'image/png', 'image/gif'];

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

// Aksi SIMPAN
if ($mod == "uang_wakaf" && $act == "simpan") {
    $upload_result = handleFileUpload('sertifikat_wakaf_uang');
    if (isset($upload_result['error'])) {
        die("<script>alert('" . $upload_result['error'] . "'); window.history.back();</script>");
    }
    $sertifikat_file = $upload_result['success'];

    $id_wakif = $_POST['id_wakif'];
    $tanggal = $_POST['tanggal'];
    $jumlah_uang = $_POST['jumlah_uang_raw'];
    $waktu = $_POST['waktu'];
    $bila_muaqot_sampai_tanggal = $_POST['bila_muaqot_sampai_tanggal'];
    $penerima_manfaat = $_POST['penerima_manfaat'];
    $detail_penerima_manfaat = $_POST['detail_penerima_manfaat'];
    $id_nazir = $_POST['id_nazir'];
    $lks_penerima_wakaf_uang = $_POST['lks_penerima_wakaf_uang'];
    $nomor_sertifikat = $_POST['nomor_sertifikat'];

    $bila_muaqot_sampai_tanggal = !empty($_POST['bila_muaqot_sampai_tanggal']) ? $_POST['bila_muaqot_sampai_tanggal'] : 'NULL';

    $query = "INSERT INTO uang_wakaf (
        id_wakif, tanggal, jumlah_uang, waktu, bila_muaqot_sampai_tanggal,
        penerima_manfaat, detail_penerima_manfaat, id_nazir,
        lks_penerima_wakaf_uang, nomor_sertifikat, sertifikat_wakaf_uang
    ) VALUES (
        '$id_wakif', '$tanggal', '$jumlah_uang', '$waktu',  " . 
    ($bila_muaqot_sampai_tanggal == 'NULL' ? 'NULL' : "'$bila_muaqot_sampai_tanggal'") . ",
        '$penerima_manfaat', '$detail_penerima_manfaat', '$id_nazir',
        '$lks_penerima_wakaf_uang', '$nomor_sertifikat', '$sertifikat_file'
    )";

    mysqli_query($conn, $query);
    echo "<script>window.history.go(-2);</script>";
}


elseif ($mod == "uang_wakaf" && $act == "edit") {
    $id_uang_wakaf = trim($_POST['id']);

    $get_old = mysqli_query($conn, "SELECT sertifikat_wakaf_uang FROM uang_wakaf WHERE id_uang_wakaf = '$id_uang_wakaf'");
    $existingFile = ($get_old && $r = mysqli_fetch_assoc($get_old)) ? $r['sertifikat_wakaf_uang'] : '';

    $upload_result = handleFileUpload('sertifikat_wakaf_uang', $existingFile);
    if (isset($upload_result['error'])) {
        die("<script>alert('" . $upload_result['error'] . "'); window.history.back();</script>");
    }
    $sertifikat_file = $upload_result['success'];
               $id_uang_wakaf = trim($_POST['id']);
        $id_wakif = $_POST['id_wakif'];
        $tanggal = $_POST['tanggal'];
        $jumlah_uang = $_POST['jumlah_uang_raw'];
        $waktu = $_POST['waktu'];
        $bila_muaqot_sampai_tanggal = $_POST['bila_muaqot_sampai_tanggal'];
        $penerima_manfaat = $_POST['penerima_manfaat'];
        $detail_penerima_manfaat = $_POST['detail_penerima_manfaat'];
        $id_nazir = $_POST['id_nazir'];
        $lks_penerima_wakaf_uang = $_POST['lks_penerima_wakaf_uang'];
        $nomor_sertifikat = $_POST['nomor_sertifikat'];
        $sertifikat_wakaf_uang = $sertifikat_file;
        
        $bila_muaqot_sampai_tanggal = !empty($_POST['bila_muaqot_sampai_tanggal']) ? $_POST['bila_muaqot_sampai_tanggal'] : 'NULL';

        mysqli_query($conn, "UPDATE uang_wakaf SET 
            id_wakif='$id_wakif',
            tanggal='$tanggal',
            jumlah_uang='$jumlah_uang',
            waktu='$waktu', 
            bila_muaqot_sampai_tanggal = " .($bila_muaqot_sampai_tanggal == 'NULL' ? 'NULL' : "'$bila_muaqot_sampai_tanggal'") . ",
            penerima_manfaat='$penerima_manfaat',
            detail_penerima_manfaat='$detail_penerima_manfaat',
            id_nazir='$id_nazir',
            lks_penerima_wakaf_uang='$lks_penerima_wakaf_uang',
            nomor_sertifikat='$nomor_sertifikat',
            sertifikat_wakaf_uang='$sertifikat_wakaf_uang'

            WHERE id_uang_wakaf = '$_POST[id]'");

    echo "<script>window.history.go(-2);</script>";
}

// Aksi HAPUS
elseif ($mod == "uang_wakaf" && $act == "hapus") {
    $id_uang_wakaf = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT sertifikat_wakaf_uang FROM uang_wakaf WHERE id_uang_wakaf = '$id_uang_wakaf'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_path = __DIR__ . "/uploads_sertifikat/" . $row['sertifikat_wakaf_uang'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    mysqli_query($conn, "DELETE FROM uang_wakaf WHERE id_uang_wakaf = '$id_uang_wakaf'");
    echo "<script>window.history.back();</script>";
}
?>
