<?php
// config.php - PostgreSQL for Render
session_start();

// Detect environment
$is_render = getenv('RENDER') !== false;

if ($is_render) {
    // Use Render's PostgreSQL database
    // Get connection from environment variable or use hardcoded values
    $database_url = 'postgresql://realestate_db_unx3_user:N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06@dpg-d81nju83kofs73cu4b60-a.oregon-postgres.render.com/realestate_db_unx3';
    
    if ($database_url) {
        // Parse the DATABASE_URL from Render
        $db = parse_url($database_url);
        define("DB_HOST", $db['host']);
        define("DB_NAME", ltrim($db['path'], '/'));
        define("DB_USER", $db['user']);
        define("DB_PASS", $db['pass']);
        define("DB_PORT", $db['port']);
    } else {
        // Fallback to your specific database values
        define("DB_HOST", "dpg-d81nju83kofs73cu4b60-a.oregon-postgres.render.com");
        define("DB_NAME", "realestate_db_unx3");
        define("DB_USER", "realestate_db_unx3_user");
        define("DB_PASS", "N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06");
        define("DB_PORT", "5432");
    }
    define("DB_DRIVER", "pgsql");
} else {
    // Local development - MySQL
    define("DB_HOST", "localhost");
    define("DB_NAME", "real_estate_db");
    define("DB_USER", "root");
    define("DB_PASS", "");
    define("DB_PORT", "3306");
    define("DB_DRIVER", "mysql");
}

define("SITE_NAME", "Real Estate Website");
define("SITE_URL", $is_render ? "https://" . $_SERVER["HTTP_HOST"] : "http://localhost");
define("BASE_PATH", dirname(__FILE__) . "/");
define("UPLOAD_DIR", BASE_PATH . "uploads/");
define("MAX_FILE_SIZE", 5242880);
define("ALLOWED_EXTENSIONS", ["jpg", "jpeg", "png", "gif", "webp"]);

// Error reporting
if ($is_render) {
    error_reporting(0);
    ini_set("display_errors", 0);
} else {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// Database connection
try {
    if (DB_DRIVER === 'pgsql') {
        $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";sslmode=require";
    } else {
        $dsn = "mysql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";charset=utf8mb4";
    }
    
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>