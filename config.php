<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

define("DB_HOST", "dpg-d81nju83kofs73cu4b60-a.oregon-postgres.render.com");
define("DB_NAME", "realestate_db_unx3");
define("DB_USER", "realestate_db_unx3_user");
define("DB_PASS", "N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06");
define("DB_PORT", "5432");

try {
    $dsn = "pgsql:host=" . DB_HOST . ";port=" . DB_PORT . ";dbname=" . DB_NAME . ";sslmode=require";
    $pdo = new PDO($dsn, DB_USER, DB_PASS);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
