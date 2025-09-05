<!DOCTYPE html>
<html>
<head>
    <title>Register User</title>
</head>
<?php
include "lib/conn.php";

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
        echo "Username sudah terdaftar. <a href='form_register.php'>Kembali</a>";
    } else {
        // Simpan user baru
$stmt = $conn->prepare("INSERT INTO user (usernm, passwd, nama_lengkap, level, last_login) VALUES (?, ?, ?, ?, NULL)");
$stmt->bind_param("ssss", $username, $hashedPassword, $nama, $level);

        if ($stmt->execute()) {
            echo "Registrasi berhasil! <a href='login.php'>Login di sini</a>";
        } else {
            echo "Gagal registrasi: " . $stmt->error;
        }
    }
}
?>

<body>
    <h2>Form Registrasi</h2>
    <form method="POST" action="form_register.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>

        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>

        <label>Nama Lengkap:</label><br>
        <input type="text" name="nama" required><br><br>

        <label>Level:</label><br>
        <select name="level" required>
            <option value="admin">Admin</option>
            <option value="user">User</option>
        </select><br><br>

        <button type="submit">Daftar</button>
    </form>
</body>
</html>
