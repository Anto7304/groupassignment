<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$db_config = [
    'host' => 'dpg-d81nju83kofs73cu4b60-a.oregon-postgres.render.com',
    'port' => '5432',
    'dbname' => 'realestate_db_unx3',
    'user' => 'realestate_db_unx3_user',
    'pass' => 'N7Z2dlsvmbFAIsR4hxengw1wjQwgXj06'
];

try {
    $dsn = "pgsql:host={$db_config['host']};port={$db_config['port']};dbname={$db_config['dbname']};sslmode=require";
    $pdo = new PDO($dsn, $db_config['user'], $db_config['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>
