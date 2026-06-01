<?php
require_once __DIR__ . '/../../services/StudentsService.php';
require_once __DIR__ . '/../../../database/config/config.php';

header('Content-Type: application/json');

    //check if status is not set, else set to session_start
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    //check if session is set to role === registrar
    if(!isset($_SESSION['role']) || $_SESSION['role'] !== 'registrar'){
        http_response_code(403); //forbidden
        echo json_encode(['success' => false, 'message' => 'Uauthorized access']);
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] !== 'GET'){
        http_response_code(405);
        echo json_encode(['success' => false, 'message' => 'Method not allowed']);
        exit();
    }

    if(!isset($_GET['q']) || empty(trim($_GET['q']))){
        http_response_code(400); //bad request
        echo json_encode(['success' => false, 'message' => 'Search query is required']);
        exit();
    }

    try{
        $keyword = trim($_GET['q']);
        $studentService = new StudentsService($con);
        $results = $studentService->searchStudents($keyword);

        echo json_encode([
            "success" => true,
            'data' => $results ?? [],
            'count' => count($results ?? [])
        ]);
    }catch(Exception $e){
        error_log("Search Student Error: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['success' => false, 'message' => 'An error occurred while searching']);
    }finally{
        if(isset($con)){
            $con->close();
        }
    }