<?php
session_start();

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../models/registrar/StudentSectionModel.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';

    class StudentSectionController extends Controller{
        protected $auditLog;
        public function __construct($con){
            parent::__construct(
                new StudentSectionModel($con)
            );
            $this->auditLog = new AuditLogs($con);
        }

        public function index($page = 1, $limit = 10){
            return $this->model->index($page, $limit);
        }

        public function getTotalCount(){
            return $this->model->getTotalCount();
        }

        public function getAvailableStudents(){
            return $this->model->getAvailableStudents();
        }

        public function getAllStudents(){
            return $this->model->getAllStudents();
        }

        public function getAvailableSections(){
            return $this->model->getAvailableSections();
        }

        public function create($data){
            try{
                if($this->model->create($data)){
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? null;
                    $this->auditLog->log(
                        $user_id,
                        $role,
                        'Added student section',
                        null,
                        $data['student_id'] ?? null,
                        'student_sections',
                        'Added student ID: ' . ($data['student_id'] ?? 'unknown') . ' to section ID: ' . ($data['section_id'] ?? 'unknown')
                    );
                    
                    setFlash('success', 'Student section added successfully.');
                    return true;
                }else{
                    setFlash('error', 'Failed to add student section. Please try again.');
                    return false;
                }
            }catch(Exception $e){
                error_log('Create student section error: ' . $e->getMessage());
                $this->auditLog->log(
                    $_SESSION['user']['id'] ?? null,
                    $_SESSION['user']['role'] ?? null,
                    'Failed to add student section',
                    null,
                    $data['student_id'] ?? null,
                    'student_sections',
                    'Error: ' . $e->getMessage(),
                    'error'
                );
                setFlash('error', 'Failed to add student section. Please try again.');
                return false;
            }
        }

        public function update($id, $data){
            try{
                if($this->model->update($id, $data)){
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? null;
                    $this->auditLog->log(
                        $user_id,
                        $role,
                        'Updated student section',
                        $id,
                        'student_sections',
                        'Updated student section ID: ' . $id . ' with new data'
                    );
                    
                    setFlash('success', 'Student section updated successfully.');
                    return true;
                }else{
                    setFlash('error', 'Failed to update student section. Please try again.');
                    return false;
                }
            }catch(Exception $e){
                error_log('Update student section error: ' . $e->getMessage());
                $this->auditLog->log(
                    $_SESSION['user']['id'] ?? null,
                    $_SESSION['user']['role'] ?? null,
                    'Failed to update student section',
                    $id,
                    'student_sections',
                    'Error: ' . $e->getMessage(),
                    'error'
                );
                setFlash('error', 'Failed to update student section. Please try again.');
                return false;
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? null;
                    $this->auditLog->log(
                        $user_id,
                        $role,
                        'Deleted student section',
                        $id,
                        'student_sections',
                        'Deleted student section ID: ' . $id
                    );
                    
                    setFlash('success', 'Student section deleted successfully.');
                    return true;
                }else{
                    setFlash('error', 'Failed to delete student section. Please try again.');
                    return false;
                }
            }catch(Exception $e){
                error_log('Delete student section error: ' . $e->getMessage());
                $this->auditLog->log(
                    $_SESSION['user']['id'] ?? null,
                    $_SESSION['user']['role'] ?? null,
                    'Failed to delete student section',
                    $id,
                    'student_sections',
                    'Error: ' . $e->getMessage(),
                    'error'
                );
                setFlash('error', 'Failed to delete student section. Please try again.');
                return false;
            }
        }
    }

    // ============= Bootstrap The Controller ============= //
    try {
        $controller = new StudentSectionController($con);
        
        // Pagination setup
        $items_per_page = 10;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        if($current_page < 1) $current_page = 1;
        
        $student_sections = $controller->index($current_page, $items_per_page);
        $total_items = $controller->getTotalCount();
        $total_pages = ceil($total_items / $items_per_page);
        
        // Ensure current page doesn't exceed total pages
        if($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
            $student_sections = $controller->index($current_page, $items_per_page);
        }
        
        $students = $controller->getAvailableStudents();
        $sections = $controller->getAvailableSections();
        $all_students = $controller->getAllStudents(); // For edit modal
        
        // Get all sections for edit modal (not just available ones)
        try{
            $query = "SELECT s.id, CONCAT(s.section_name, ' - ', s.grade_level) AS section_info 
                      FROM sections s
                      ORDER BY s.section_name";
            $stmt = $con->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            $all_sections = $result->fetch_all(MYSQLI_ASSOC);
        }catch(Exception $e){
            $all_sections = [];
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['add_student_section'])){
                 $data = [
                    'student_id' => $_POST['student_id'] ?? null,
                    'section_id' => $_POST['section_id'] ?? null
                ];
                $controller->create($data);
                header("Location: ../../../resources/views/registrar/student-sections.php");
                exit();
            }

            if(isset($_POST['update_student_section'])){
                $id = $_POST['id'] ?? null;
                $data = [
                    'student_id' => $_POST['student_id'] ?? null,
                    'section_id' => $_POST['section_id'] ?? null
                ];
                if($id){
                    $controller->update($id, $data);
                }
                header("Location: ../../../resources/views/registrar/student-sections.php");
                exit();
            }

            if(isset($_POST['delete_student_section'])){
                $id = $_POST['id'] ?? null;
                if($id){
                    $controller->delete($id);
                }
                header("Location: ../../../resources/views/registrar/student-sections.php");
                exit();
            }
        }
    }catch(Exception $e) {
        throw new Exception("Error " . $e->getMessage(),500);
    }