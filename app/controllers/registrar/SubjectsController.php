<?php
session_start();

require_once __DIR__ . '/../../models/registrar/SubjectsModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';

    class SubjectsController extends Controller{
        protected $logs;

        public function __construct($con){
            parent::__construct(new SubjectsModel($con));
            $this->logs = new AuditLogs($con);
        }

        public function index(){
            try{
                return $this->model->index();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function getPaginated($page = 1, $limit = 10){
            try{
                return $this->model->getPaginated($page, $limit);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function getTotal(){
            try{
                return $this->model->getTotal();
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function create($data){
            if($this->model->create($data)){
                // Log the action
                $user_id = $_SESSION['user']['id'] ?? null;
                $role = $_SESSION['user']['role'] ?? 'unknown';
                $this->logs->log(
                    $user_id,
                    $role,
                    'CREATE',
                    'subjects',
                    null,
                    'subjects',
                    "Created new subject with code: {$data['subject_code']} and name: {$data['subject_name']}"
                );

                setFlash('success', 'Subject added successfully.');
                header('Location: ../../../resources/views/registrar/subjects.php');
                exit();
            }
        }

        public function update($id, $data){
            if($this->model->update($id, $data)){
                // Log the action
                $user_id = $_SESSION['user']['id'] ?? null;
                $role = $_SESSION['user']['role'] ?? 'unknown';
                $this->logs->log(
                    $user_id,
                    $role,
                    'UPDATE',
                    'subjects',
                    $id,
                    'subjects',
                    "Updated subject with code: {$data['subject_code']} and name: {$data['subject_name']}"
                );

                setFlash('success', 'Subject updated successfully.');
                header('Location: ../../../resources/views/registrar/subjects.php');
                exit();
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    // Log the action
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? 'unknown';
                    $this->logs->log(
                        $user_id,
                        $role,
                        'DELETE',
                        'subjects',
                        $id,
                        'subjects',
                        "Deleted subject record ID: {$id}"
                    );

                    setFlash('success', 'Subject deleted successfully.');
                    header('Location: ../../../resources/views/registrar/subjects.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to delete subject');
                    header('Location: ../../../resources/views/registrar/subjects.php');
                    exit();
                }
            }catch(Exception $e){
                    error_log($e->getMessage());
                    return ['success' => false, 'message' => 'Failed to delete guardian.'];
            }
        }
    }

    try{
        $controller = new SubjectsController($con);
        
        // Pagination setup
        $entries_per_page = 10;
        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $total_subjects = $controller->getTotal();
        $total_pages = ceil($total_subjects / $entries_per_page);
        $offset = ($current_page - 1) * $entries_per_page;
        
        // Ensure current page is valid
        if ($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
            $offset = ($current_page - 1) * $entries_per_page;
        }
        
        $subjects = $controller->getPaginated($current_page, $entries_per_page);
    }catch(Exception $e){
        echo($e->getMessage());
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['add_subject'])){
            $controller->create(
                [
                    'subject_code' => $_POST['subject_code'],
                    'subject_name' => $_POST['subject_name']
                ]
            );
        }
        if(isset($_POST['update_subject'])){
            $id = $_POST['id'];
            $controller->update(
                $id,
                [
                    'subject_code' => $_POST['subject_code'],
                    'subject_name' => $_POST['subject_name']
                ]
            );
        }
        if(isset($_POST['delete_subject'])){
            $id = $_POST['id'];
            try{
                $subject_id = $_POST['id'];
                $controller->delete($id);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
    }