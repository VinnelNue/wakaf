<?php
// config.php - Hanya berisi konfigurasi

class Config {
    private static $config = [];
    
    public static function load() {
        // Langsung baca environment variables.
        // Jika variabel tidak ada, getenv() akan mengembalikan false.
        self::$config = [
            'DB_HOST' => getenv('DB_HOST'),
            'DB_USER' => getenv('DB_USER'),
            'DB_PASS' => getenv('DB_PASS'),
            'DB_NAME' => getenv('DB_NAME'),
            'BASE_URL' => getenv('BASE_URL'),
            'ENVIRONMENT' => getenv('ENVIRONMENT') ?: 'production' // Boleh ada fallback
        ];

        // Periksa apakah variabel penting sudah diatur. Jika tidak, hentikan aplikasi.
        if (empty(self::$config['DB_HOST']) || empty(self::$config['DB_USER']) || empty(self::$config['DB_NAME'])) {
            die("FATAL ERROR: Environment variables DB_HOST, DB_USER, dan DB_NAME harus diatur di Coolify!");
        }
    }
    
    public static function get($key, $default = null) {
        return self::$config[$key] ?? $default;
    }
}

// Load configuration
Config::load();

// Define constants
define('DB_HOST', Config::get('DB_HOST'));
define('DB_USER', Config::get('DB_USER'));
define('DB_PASS', Config::get('DB_PASS'));
define('DB_NAME', Config::get('DB_NAME'));
define('BASE_URL', Config::get('BASE_URL'));
define('ENVIRONMENT', Config::get('ENVIRONMENT'));
?>