<?php
// Aktifkan laporan error paling detail
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

echo "<h1>Tes Koneksi Database - Diagnostik Coolify</h1>";

// 1. Baca Environment Variables dari sistem
$db_host = getenv('DB_HOST');
$db_user = getenv('DB_USER');
$db_pass = getenv('DB_PASS');
$db_name = getenv('DB_NAME');

// 2. Tampilkan variabel yang berhasil dibaca (untuk debugging)
echo "<h2>1. Variabel yang Dibaca dari Coolify:</h2>";
echo "<pre style='background-color:#f0f0f0; padding: 15px; border: 1px solid #ccc;'>";
echo "<b>DB_HOST:</b> " . ($db_host ? htmlspecialchars($db_host) : "<span style='color:red;'>KOSONG / TIDAK DITEMUKAN</span>") . "\n";
echo "<b>DB_USER:</b> " . ($db_user ? htmlspecialchars($db_user) : "<span style='color:red;'>KOSONG / TIDAK DITEMUKAN</span>") . "\n";
echo "<b>DB_PASS:</b> " . ($db_pass ? "******** (ada isinya)" : "<span style='color:red;'>KOSONG / TIDAK DITEMUKAN</span>") . "\n";
echo "<b>DB_NAME:</b> " . ($db_name ? htmlspecialchars($db_name) : "<span style='color:red;'>KOSONG / TIDAK DITEMUKAN</span>") . "\n";
echo "</pre>";

// 3. Lakukan tes koneksi hanya jika semua variabel ada
if ($db_host && $db_user && $db_pass && $db_name) {
    echo "<h2>2. Mencoba Koneksi ke Database...</h2>";
    
    // Gunakan mysqli_connect untuk mendapatkan error yang lebih jelas
    // Tambahkan @ untuk menekan warning default agar kita bisa format sendiri
    $conn = @mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    // 4. Periksa hasil koneksi
    if ($conn) {
        echo "<h3 style='color:green;'>SUKSES! Koneksi Berhasil!</h3>";
        echo "<p>Aplikasi PHP Anda berhasil terhubung ke database MySQL yang di-host di Coolify.</p>";
        echo "<p>Masalah 502 kemungkinan ada di file lain (seperti `index.php` atau `session.php`).</p>";
        mysqli_close($conn);
    } else {
        echo "<h3 style='color:red;'>GAGAL! Koneksi Tidak Berhasil!</h3>";
        echo "<p><b>Pesan Error dari MySQL:</b><br><pre style='background-color:#ffe0e0; padding: 15px; border: 1px solid red;'>" . htmlspecialchars(mysqli_connect_error()) . "</pre></p>";
        echo "<p><b>Kode Error:</b> " . mysqli_connect_errno() . "</p>";
        echo "<h4>Saran:</h4>";
        echo "<ul>";
        echo "<li><b>Jika error 'Access denied':</b> Pastikan `DB_USER` dan `DB_PASS` yang Anda masukkan di Coolify sudah 100% benar (copy-paste dari halaman detail database).</li>";
        echo "<li><b>Jika error 'Unknown database':</b> Pastikan `DB_NAME` yang Anda masukkan di Coolify sudah benar.</li>";
        echo "<li><b>Jika error 'Connection timed out' atau 'name resolution':</b> Pastikan `DB_HOST` adalah **Host Internal** yang diberikan Coolify, bukan IP publik.</li>";
        echo "</ul>";
    }
} else {
    echo "<h3 style='color:red;'>GAGAL: Variabel Lingkungan Tidak Ditemukan!</h3>";
    echo "<p>Aplikasi PHP Anda tidak bisa membaca Environment Variables dari Coolify. Pastikan Anda sudah mengaturnya di bagian **Production Environment Variables**, menyimpannya, dan melakukan **Redeploy**.</p>";
}