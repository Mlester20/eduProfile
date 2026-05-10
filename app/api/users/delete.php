<?php
session_start();

require_once __DIR__ . '/../../middleware/auth.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../controllers/admin/UsersController.php';

allowOnly(['admin']);

if (isset($_GET['id'])) {
    $id = (int)$_GET['id'];

    try {
        $usersController = new UsersController($con);
        $usersController->delete($id);
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
