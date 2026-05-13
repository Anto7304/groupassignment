<?php
// backend/auth/db.php
require_once __DIR__ . '/../../config.php';

if (!isset($pdo)) {
    http_response_code(500);
    echo json_encode(['success' => false, 'message' => 'Database connection failed']);
    exit();
}
?>