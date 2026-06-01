<?php
// Start session FIRST before anything else
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Set JSON header
header('Content-Type: application/json');

// Error handling
ini_set('display_errors', 0);
error_reporting(E_ALL);
set_error_handler(function($errno, $errstr, $errfile, $errline) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Server error',
        'error' => $errstr
    ]);
    exit();
});

// Check authentication
if (!isset($_SESSION['id']) || !isset($_SESSION['role']) || $_SESSION['role'] !== 'teacher') {
    http_response_code(401);
    echo json_encode(['success' => false, 'message' => 'Unauthorized']);
    exit();
}

if (!isset($_GET['student_id']) || empty($_GET['student_id'])) {
    http_response_code(400);
    echo json_encode(['success' => false, 'message' => 'Student ID is required']);
    exit();
}

$student_id = (int)$_GET['student_id'];

try {
    require_once __DIR__ . '/../../controllers/teacher/StudentsListController.php';
    require_once __DIR__ . '/../../../database/config/config.php';
    
    $controller = new StudentsListController($con);
    $result = $controller->getStudentWithGuardian($student_id);
    
    http_response_code($result['success'] ? 200 : 404);
    echo json_encode($result);

} catch (Exception $e) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Internal server error',
        'error' => $e->getMessage()
    ]);
}
?>