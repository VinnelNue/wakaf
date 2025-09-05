<?php
include "lib/conn.php";
$error=''; // Variabel untuk menyimpan pesan error
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
		$username=$_POST['username'];
		$password=$_POST['password'];

		//for sql injection security
		$stmt = $conn->prepare("SELECT * FROM user WHERE usernm = ?");
		$stmt ->bind_param("s",$username);
		$stmt ->execute();
		$result = $stmt ->get_result();

		if($user = $result->fetch_assoc()){
	    if (password_verify($password, $user['passwd'])) {
            session_start();

			$token = bin2hex(random_bytes(32));
			$token_expired_at  = date("Y-m-d",strtotime("+ 1 hour"));

			$_SESSION['login_user']= $user['usernm']; // Membuat Sesi/session
			$_SESSION['login_id'] = $user['id_user'];
			$_SESSION['level'] = $user['level'];
			$_SESSION['nama'] = $user['nama_lengkap'];
			$_SESSION['token'] = $token;

			$stmtUpdate = $conn->prepare("UPDATE user SET last_login = NOW(), token = ?, token_expired_at = ? WHERE id_user = ?");
			$stmtUpdate->bind_param("ssi",$token,$token_expired_at,$user['id_user']);
			$stmtUpdate->execute();

			setcookie("auth_token_" . $user['id_user'], $token, time() + 3600, "/", "", false, true);


			header("Location: index.php?page=dashboard"); // Mengarahkan ke halaman dashboard
			exit();
      } else {
            // Password salah
            header("Location: login.php?error=" . urlencode("Password salah"));
            exit();
        }
    } else {
        // Username tidak ditemukan
        header("Location: login.php?error=" . urlencode("Username tidak ditemukan"));
        exit();
    }
}

?>