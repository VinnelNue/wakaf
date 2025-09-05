<?php
session_start();
include "../../lib/conn.php";

// Cek login
if (!isset($_SESSION['login_user'])) {
    header('location: ../../login.php');
    exit;
}

// Cek parameter
$mod = $_GET['page'] ?? '';
$act = $_GET['act'] ?? '';

// Fungsi upload file
function handleFileUpload($fieldName, $existingFile = '', $customDir = 'uploads_sertifikat/')
{
    $upload_dir = __DIR__ . '/' . $customDir;
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

        $new_file_name = time() . '_' . preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $file_name);
        $target_path = $upload_dir . '/' . $new_file_name;

        if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $target_path)) {
            if (!empty($existingFile)) {
                $old_file = $upload_dir . '/' . $existingFile;
                if (file_exists($old_file)) {
                    unlink($old_file);
                }
            }
            return ['success' => $new_file_name];
        } else {
            return ['error' => 'Gagal mengupload file'];
        }
    }

    return ['success' => $existingFile]; // Tidak ada file baru
}

if ($mod == "setting" && $act == "simpan") {
    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);

    // Upload file
    $upload_profil = handleFileUpload('photo_profil', '', 'uploads_profil/');
    if (isset($upload_profil['error'])) {
        die("<script>alert('Gagal upload Foto Profil: " . $upload_profil['error'] . "'); window.history.back();</script>");
    }
    $photo_profil = $upload_profil['success'];

    mysqli_query($conn, "INSERT INTO setting (id_user, photo_profil )
                         VALUES ('$id_user', '$photo_profil' )");

    echo "<script>window.history.go(-2);</script>";
	
} elseif ($mod == "setting" && $act == "edit") {
    $id_usr = mysqli_real_escape_string($conn, $_POST['id']);
    $id_user = mysqli_real_escape_string($conn, $_POST['id_user']);

    // Ambil data lama
    $old = mysqli_fetch_assoc(mysqli_query($conn, "SELECT photo_profil FROM setting WHERE id_usr = '$id_usr'"));

    // Upload file
    $upload_profil = handleFileUpload('photo_profil', $old['photo_profil'], 'uploads_profil/');

    if (isset($upload_profil['error'])) {
        die("<script>alert('Gagal upload Foto Profil: " . $upload_profil['error'] . "'); window.history.back();</script>");
    }


    $photo_profil = $upload_profil['success'];

    mysqli_query($conn, "UPDATE setting SET 
        id_user = '$id_user',
        photo_profil = '$photo_profil'
        WHERE id_usr = '$id_usr'");

    echo "<script>window.history.go(-2);</script>";
}

elseif ($mod == "setting" && $act == "hapus") {
    $id_usr = mysqli_real_escape_string($conn, $_GET['id']);
    $query = "SELECT photo_profil FROM setting WHERE id_usr = '$id_usr'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $file_path = __DIR__ . "/uploads_profil/" . $row['photo_profil'];
        if (file_exists($file_path)) {
            unlink($file_path);
        }
    }

    mysqli_query($conn, "DELETE FROM setting WHERE id_usr = '$id_usr'");
    echo "<script>window.history.back();</script>";
}
//register user
	if($mod == "setting" AND $act == "simpan_register"){

	if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $nama = $_POST['nama'];
    $level = $_POST['level'];
    
    // Hash password dengan bcrypt
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Cek apakah username sudah digunakan
    $cek = $conn->prepare("SELECT id_user FROM user WHERE usernm = ?");
    $cek->bind_param("s", $username);
    $cek->execute();
    $cek->store_result();

    if ($cek->num_rows > 0) {
         echo "<script>window.history.go(-2);</script>";
    } else {
        // Simpan user baru
$stmt = $conn->prepare("INSERT INTO user 
        (usernm, passwd, nama_lengkap, level, last_login) 
        VALUES (?, ?, ?, ?, NULL)");
        $stmt->bind_param("ssss", $username, $hashedPassword, $nama, $level);

        if ($stmt->execute()) {
            echo "<script>window.history.go(-2);</script>";
        } else {
            echo "<script>window.history.go(-2);</script>";
        }
    }
  }
}

	/*elseif ($mod == "dashboard" AND $act == "edit"){
		//variable input
		$id_dashboard = trim($_POST['id']);
		$aaa= $_POST['aaa'];

		mysqli_query($conn, "UPDATE dashboard SET 
										aaa= '$aaa' 
					WHERE id_dashboard = '$_POST[id]'");

		echo"<script>
			window.history.go(-2);
		</script>";
	}

	elseif ($mod == "dashboard" AND $act == "hapus") 
	{
		mysqli_query($conn, "DELETE FROM dashboard WHERE id_dashboard = '$_GET[id]'");
		echo"<script>
			window.history.back();
		</script>";	
	}*/

?>
