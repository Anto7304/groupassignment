<?php
// backend/auth/db.php
require_once __DIR__ . '/../../config.php';

// Check if PDO connection exists
if (!isset($pdo)) {
    $response = ['success' => false, 'message' => 'Database connection not established'];
    echo json_encode($response);
    exit();
}
?>Desktop/real-estate-website