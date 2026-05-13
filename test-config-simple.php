<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
echo "<h1>Config Test</h1>";
if (file_exists('config.php')) {
    echo "<p>✅ config.php exists</p>";
    require_once 'config.php';
    echo "<p>✅ Config loaded</p>";
} else {
    echo "<p>❌ config.php missing</p>";
    echo "<p>Files: " . implode(", ", scandir(__DIR__)) . "</p>";
}
?>
