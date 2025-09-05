<?php
// config.php - Hanya berisi konfigurasi

class Config {
    private static $config = [];
    
    public static function load() {
        // Load dari .env atau gunakan default
        self::$config = [
            'DB_HOST' => getenv('DB_HOST') ?: 'db',
            'DB_USER' => getenv('DB_USER') ?: 'wakafuser',
            'DB_PASS' => getenv('DB_PASS') ?: 'wakafpass', 
            'DB_NAME' => getenv('DB_NAME') ?: 'wakaf',
            'BASE_URL' => getenv('BASE_URL') ?: '',
            'ENVIRONMENT' => getenv('ENVIRONMENT') ?: 'production'
        ];
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