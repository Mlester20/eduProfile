<?php
session_start();

require_once __DIR__ . '/../../app/models/AuthModel.php';
require_once __DIR__ . '../../../database/config/config.php';
require_once __DIR__ . '/../../app/helpers/message.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $authModel = new AuthModel($con);

        $email = $_POST['email'];
        $password = $_POST['password'];

        $row = $authModel->getUserByEmail($email);
        if($row && $authModel->verifyPassword($password, $row['password'])){
            $_SESSION['id'] = $row['id'];
            $_SESSION['full_name'] = $row['full_name'];
            $_SESSION['email'] = $row['email'];
            $_SESSION['role'] = $row['role'];
            $_SESSION['profile_picture'] = $row['profile_picture'];

            //check role and redirect
            if($_SESSION['role'] === 'admin'){
                header("Location: ../../resources/views/admin/dashboard.php");
            } 
            else if($_SESSION['role'] === 'administrative'){
                header("Location: ../../resources/views/administrative/home.php");
            } 
            else {
                //throw to login for unknown role
                header("Location: ../../../index.php");
            }
        }else{  
            setFlash('error', 'Invalid email or password');
            header("Location: ../../../index.php");
            exit();
        }
    }
?>