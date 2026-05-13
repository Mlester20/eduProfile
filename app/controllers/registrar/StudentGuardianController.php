<?php
session_start();

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../models/registrar/StudentGuardianModel.php';
require_once __DIR__ . '/../../models/registrar/EnrollStudentsModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../services/Students.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class StudentGuardianController extends Controller{
        protected $students;
        protected $auditLogs;

        public function __construct($con){
            parent::__construct(
                new StudentGuardianModel($con)
            );
            $this->students = new EnrollStudentsModel($con);
            $this->auditLogs = new AuditLogs($con);
        }

        public function index(){
            try{
                return $this->model->index();
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        public function getStudents(){
            try{
                return $this->students->index();
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        public function getTotalGuardianCount(){
            try{
                return $this->model->getTotalCount();
            }catch(Exception $e){
                error_log($e->getMessage());
                return 0;
            }
        }

        public function getGuardiansWithPagination($offset, $limit){
            try{
                return $this->model->getWithPagination($offset, $limit);
            }catch(Exception $e){
                error_log($e->getMessage());
                return [];
            }
        }

        public function create($data){
            try{
                if($this->model->create($data)){
                    // Log the action
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? 'unknown';
                    $this->auditLogs->log(
                        $user_id,
                        $role,
                        'CREATE',
                        'Parents/Guardians',
                        null,
                        'parents_guardians',
                        "Added guardian for student ID: {$data['student_id']}"
                    );

                    setFlash('success', 'Guardian added successfully');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to add guardian');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Failed to add guardian.'];
            }
        }

        public function update($id, $data){
            try{
                if($this->model->update($id, $data)){
                    // Log the action
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? 'unknown';
                    $this->auditLogs->log(
                        $user_id,
                        $role,
                        'UPDATE',
                        'Parents/Guardians',
                        $id,
                        'parents_guardians',
                        "Updated guardian for student ID: {$data['student_id']}"
                    );

                    setFlash('success', 'Guardian updated successfully');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to update guardian');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Failed to update guardian.'];
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    // Log the action
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? 'unknown';
                    $this->auditLogs->log(
                        $user_id,
                        $role,
                        'DELETE',
                        'Parents/Guardians',
                        $id,
                        'parents_guardians',
                        "Deleted guardian record ID: {$id}"
                    );

                    setFlash('success', 'Guardian deleted successfully');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to delete guardian');
                    header('Location: ../../../resources/views/registrar/student-guardian.php');
                    exit();
                }
            }catch(Exception $e){
                    error_log($e->getMessage());
                    return ['success' => false, 'message' => 'Failed to delete guardian.'];
            }
        }
    }

    try{
        $controller = new StudentGuardianController($con);        
        // Pagination setup
        $entries_per_page = 10;
        $current_page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $total_guardians = $controller->getTotalGuardianCount();
        $total_pages = ceil($total_guardians / $entries_per_page);
        $offset = ($current_page - 1) * $entries_per_page;
        
        // Ensure current page is valid
        if ($current_page > $total_pages && $total_pages > 0) {
            $current_page = $total_pages;
            $offset = ($current_page - 1) * $entries_per_page;
        }
        
        $guardians = $controller->getGuardiansWithPagination($offset, $entries_per_page);
        $students = $controller->getStudents();
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['addGuardian'])){
            $controller->create(
                [
                    "student_id" => $_POST['student_id'],
                    "father_name" => $_POST['father_name'],
                    "father_occupation" => $_POST['father_occupation'],
                    "father_contact" => $_POST['father_contact'],
                    "mother_name" => $_POST['mother_name'],
                    "mother_occupation" => $_POST['mother_occupation'],
                    "mother_contact" => $_POST['mother_contact'],
                    "guardian_name" => $_POST['guardian_name'],
                    "guardian_relationship" => $_POST['guardian_relationship'],
                    "guardian_contact" => $_POST['guardian_contact'],
                    "monthly_income" => $_POST['monthly_income']
                ]
            );
        }
        if(isset($_POST['updateGuardian'])){
            $guardian_id = $_POST['id'];
            $controller->update(
                $guardian_id,
                [
                    "student_id" => $_POST['student_id'],
                    "father_name" => $_POST['father_name'],
                    "father_occupation" => $_POST['father_occupation'],
                    "father_contact" => $_POST['father_contact'],
                    "mother_name" => $_POST['mother_name'],
                    "mother_occupation" => $_POST['mother_occupation'],
                    "mother_contact" => $_POST['mother_contact'],
                    "guardian_name" => $_POST['guardian_name'],
                    "guardian_relationship" => $_POST['guardian_relationship'],
                    "guardian_contact" => $_POST['guardian_contact'],
                    "monthly_income" => $_POST['monthly_income']
                ]
            );
        }
        if(isset($_POST['deleteGuardian'])){
            $guardian_id = $_POST['guardian_id'];
            $controller->delete($guardian_id);
        }
    }
?>