<?php
session_start();

require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../controllers/admin/UsersController.php';

allowOnly(['admin']);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['id'])) {
    $id = (int)$_GET['id'];
    
    $data = [
        'full_name' => $_POST['full_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'role' => $_POST['role'] ?? 'user'
    ];

    // Only include password if provided
    if (!empty($_POST['password'])) {
        $data['password'] = $_POST['password'];
    }

    try {
        $usersController = new UsersController($con);
        $usersController->update($id, $data);
    } catch (Exception $e) {
        setFlash("error", "An error occurred: " . $e->getMessage());
        header("Location: ../../../resources/views/admin/users.php");
        exit();
    }
} else {
    header("Location: ../../../resources/views/admin/users.php");
    exit();
}
?>
