<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<h1>Debug Info</h1>";
require_once 'config.php';
try {
    $stmt = $pdo->query("SELECT version()");
    $version = $stmt->fetch();
    echo "<p style='color:green'>✅ Database connected: " . $version['version'] . "</p>";
} catch (Exception $e) {
    echo "<p style='color:red'>❌ Error: " . $e->getMessage() . "</p>";
}
?>
