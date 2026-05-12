<?php
// Production Configuration
session_start();

define("SITE_NAME", "Real Estate Website");
define("SITE_URL", "https://" . $_SERVER["HTTP_HOST"]);
define("BASE_PATH", dirname(__FILE__) . "/");

// Database - Use environment variables for Render
define("DB_HOST", getenv("DB_HOST") ?: "localhost");
define("DB_NAME", getenv("DB_NAME") ?: "real_estate_db");
define("DB_USER", getenv("DB_USER") ?: "root");
define("DB_PASS", getenv("DB_PASS") ?: "");

// Upload settings
define("UPLOAD_DIR", BASE_PATH . "uploads/");
define("MAX_FILE_SIZE", 5242880); // 5MB
define("ALLOWED_EXTENSIONS", ["jpg", "jpeg", "png", "gif", "webp"]);

// Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
