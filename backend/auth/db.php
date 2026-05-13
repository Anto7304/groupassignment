<?php
// backend/auth/db.php
require_once __DIR__ . '/../../config.php';

// $pdo is already defined in config.php
// This file just ensures the connection exists
if (!isset($pdo)) {
    die("Database connection not established");
}
?>