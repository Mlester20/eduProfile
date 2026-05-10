<?php
session_start();

require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../controllers/admin/UsersController.php';

allowOnly(['admin']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'full_name' => $_POST['full_name'] ?? '',
        'email' => $_POST['email'] ?? '',
        'password' => $_POST['password'] ?? '',
        'role' => $_POST['role'] ?? 'user'
    ];

    try {
        $usersController = new UsersController($con);
        $usersController->create($data);
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
