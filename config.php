<?php
// Production Configuration
session_start();

define("SITE_NAME", "Real Estate Website");
define("SITE_URL", "https://" . $_SERVER["HTTP_HOST"]);
define("BASE_PATH", dirname(__FILE__) . "/");

// Database - Use environment variables for Render
define("DB_HOST", getenv("DB_HOST") ?: "dpg-d81nju83kofs73cu4b60-a");
define("DB_NAME", getenv("DB_NAME") ?: "realestate_db_unx3");
define("DB_USER", getenv("DB_USER") ?: "realestate_db_unx3_user");
define("DB_PASS", getenv("DB_PASS") ?: "N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06");

// Upload settings
define("UPLOAD_DIR", BASE_PATH . "uploads/");
define("MAX_FILE_SIZE", 5242880); // 5MB
define("ALLOWED_EXTENSIONS", ["jpg", "jpeg", "png", "gif", "webp"]);

// Error reporting
error_reporting(E_ALL);
ini_set("display_errors", 1);
?>
