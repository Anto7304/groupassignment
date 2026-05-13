
<?php
// config.php - Works on both local and Render
session_start();

// Detect environment
$is_render = getenv('RENDER') !== false;

if ($is_render) {
    // Render production environment
        
    define("DB_HOST", getenv("DB_HOST") ?: "dpg-d81nju83kofs73cu4b60-a");
    define("DB_NAME", getenv("DB_NAME") ?: "realestate_db_unx3");
    define("DB_USER", getenv("DB_USER") ?: "realestate_db_unx3_user");
    define("DB_PASS", getenv("DB_PASS") ?: "N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06");
;
} else {
    // Local development
    define("DB_HOST", "localhost");
    define("DB_NAME", "real_estate_db");
    define("DB_USER", "root");
    define("DB_PASS", "");
}

define("SITE_NAME", "Real Estate Website");
define("SITE_URL", $is_render ? "https://" . $_SERVER["HTTP_HOST"] : "http://localhost");
define("BASE_PATH", dirname(__FILE__) . "/");
define("UPLOAD_DIR", BASE_PATH . "uploads/");
define("MAX_FILE_SIZE", 5242880);
define("ALLOWED_EXTENSIONS", ["jpg", "jpeg", "png", "gif", "webp"]);

// Error reporting - turn off in production
if ($is_render) {
    error_reporting(0);
    ini_set("display_errors", 0);
} else {
    error_reporting(E_ALL);
    ini_set("display_errors", 1);
}

// Database connection
try {
    $pdo = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4", DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>