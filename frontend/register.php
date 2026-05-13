<?php
// backend/auth/reg.php - PostgreSQL version
error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');

// Handle preflight requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Include database connection
require_once __DIR__ . '/db.php';

$response = ['success' => false, 'message' => ''];

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method';
    echo json_encode($response);
    exit();
}

// Get JSON input
$input = json_decode(file_get_contents('php://input'), true);

if (!$input) {
    $response['message'] = 'Invalid input data';
    echo json_encode($response);
    exit();
}

$full_name = trim($input['full_name'] ?? '');
$email = trim($input['email'] ?? '');
$phone = trim($input['phone'] ?? '');
$password = $input['password'] ?? '';

// Validation
if (empty($full_name) || empty($email) || empty($phone) || empty($password)) {
    $response['message'] = 'All fields are required';
    echo json_encode($response);
    exit();
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $response['message'] = 'Invalid email format';
    echo json_encode($response);
    exit();
}

if (strlen($password) < 6) {
    $response['message'] = 'Password must be at least 6 characters';
    echo json_encode($response);
    exit();
}

try {
    // Check if email already exists
    $stmt = $pdo->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->execute([$email]);
    
    if ($stmt->fetch()) {
        $response['message'] = 'Email already registered';
        echo json_encode($response);
        exit();
    }
    
    // Hash password and insert user - FIXED: removed NOW() for PostgreSQL
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    
    // PostgreSQL will automatically use DEFAULT CURRENT_TIMESTAMP for created_at
    $stmt = $pdo->prepare("INSERT INTO users (full_name, email, phone, password) VALUES (?, ?, ?, ?)");
    
    if ($stmt->execute([$full_name, $email, $phone, $hashed_password])) {
        // Start session and log user in
        session_start();
        $_SESSION['user_id'] = $pdo->lastInsertId();
        $_SESSION['user_name'] = $full_name;
        $_SESSION['user_email'] = $email;
        
        $response['success'] = true;
        $response['message'] = 'Registration successful!';
        echo json_encode($response);
        exit();
    } else {
        $response['message'] = 'Registration failed. Please try again.';
        echo json_encode($response);
        exit();
    }
    
} catch (PDOException $e) {
    $response['message'] = 'Database error: ' . $e->getMessage();
    echo json_encode($response);
    exit();
}
?>