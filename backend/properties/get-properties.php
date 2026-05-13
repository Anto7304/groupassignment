<?php
// backend/properties/get-properties.php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

require_once __DIR__ . '/../auth/db.php';

$user_id = $_GET['user_id'] ?? null;

try {
    $sql = "SELECT p.*, u.full_name as seller_name, u.email as seller_email, u.phone as seller_phone 
            FROM properties p 
            JOIN users u ON p.user_id = u.id 
            ORDER BY p.created_at DESC";
    
    $params = [];
    
    if ($user_id) {
        $sql .= " WHERE p.user_id = ?";
        $params[] = $user_id;
    }
    
    $stmt = $pdo->prepare($sql);
    $stmt->execute($params);
    $properties = $stmt->fetchAll();
    
    // Make sure image URLs are web-accessible
    foreach ($properties as &$property) {
        if ($property['image_url'] && !str_starts_with($property['image_url'], '/')) {
            $property['image_url'] = '/' . ltrim($property['image_url'], '/');
        }
    }
    
    echo json_encode(['success' => true, 'properties' => $properties]);
} catch (PDOException $e) {
    echo json_encode(['success' => false, 'message' => 'Database error: ' . $e->getMessage()]);
}
?>