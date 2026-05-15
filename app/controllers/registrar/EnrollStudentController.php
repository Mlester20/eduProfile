<?php
session_start();

require_once __DIR__ . '/../../models/registrar/EnrollStudentsModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../controllers/Controller.php';
require_once __DIR__ . '/../../services/Students.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class EnrollStudentController extends Controller{
        public function __construct($con) {
            parent::__construct(new EnrollStudentsModel($con)); // $this->model is set by the parent
        }

        public function index(){
            try{
                return $this->model->index();
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        /**
         * Get paginated students with full names
         * @param int $page Page number (1-based)
         * @return array Paginated students with full names
         */
        public function getPaginatedStudents($page = 1) {
            try {
                $result = $this->model->getPaginated($page);
                
                if (isset($result['error'])) {
                    return $result;
                }

                // Add full names to students
                $result['students'] = Students::addFullNames($result['students']);

                return $result;
            } catch (Exception $e) {
                error_log($e->getMessage());
                return ['error' => 'Failed to fetch students'];
            }
        }

        public function create($data){
            try{
                if($this->model->create($data)){
                    setFlash('success', 'Student enrolled successfully');
                    header('Location: ../../../resources/views/registrar/enroll-students.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to enroll student');
                    header('Location: ../../../resources/views/registrar/enroll-students.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Failed to enroll student.'];
            }
        }
        public function update($id, $data){
            try{
                if($this->model->update($id, $data)){
                    setFlash('success', 'Student updated successfully');
                    header('Location: ../../../resources/views/registrar/enroll-students.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to update student');
                    header('Location: ../../../resources/views/registrar/enroll-students.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Failed to update student.'];
            }
        }

        public function getById($id){
            try{
                return $this->model->getById($id);
            }catch(Exception $e){
                error_log($e->getMessage());
                return null;
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    return ['success' => true, 'message' => 'Student deleted successfully'];
                }else{
                    return ['success' => false, 'message' => 'Failed to delete student'];
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'An error occurred'];
            }
        }
    }

    // bootstrap model and controller
    try{
        $controller = new EnrollStudentController($con);
        $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $paginatedData = $controller->getPaginatedStudents($page);
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
    }

    //nested if to handle form submission for creating, updating, and deleting a new student
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['enrollStudent'])){
            // Handle file upload for profile photo
            $profilePhoto = '';
            if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['size'] > 0){
                $uploadDir = __DIR__ . '/../../../uploads/';
                if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = time() . '_' . basename($_FILES['profile_photo']['name']);
                $uploadFile = $uploadDir . $fileName;
                if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadFile)){
                    $profilePhoto = $fileName;
                }
            }

            $controller->create(
                [
                    'lrn' => $_POST['lrn'],
                    'first_name' => $_POST['first_name'],
                    'middle_name' => $_POST['middle_name'],
                    'last_name' => $_POST['last_name'],
                    'suffix' => $_POST['suffix'] ?? '',
                    'gender' => $_POST['gender'],
                    'birth_date' => $_POST['birth_date'],
                    'age' => $_POST['age'],
                    'place_of_birth' => $_POST['place_of_birth'],
                    'nationality' => $_POST['nationality'],
                    'religion' => $_POST['religion'],
                    'address' => $_POST['address'],
                    'contact_number' => $_POST['contact_number'],
                    'email' => $_POST['email'] ?? '',
                    'profile_photo' => $profilePhoto,
                    'enrollment_status' => $_POST['enrollment_status'] ?? ''
                ]
            );
        }
        elseif(isset($_GET['action']) && $_GET['action'] === 'update' && isset($_POST['id'])){
            // Handle file upload for profile photo update
            $id = intval($_POST['id']);
            $existingStudent = $controller->getById($id);
            $profilePhoto = $existingStudent['profile_photo'] ?? '';
            
            if(isset($_FILES['profile_photo']) && $_FILES['profile_photo']['size'] > 0){
                // Delete old photo if exists
                if($profilePhoto){
                    $oldFile = __DIR__ . '/../../../uploads/' . $profilePhoto;
                    if(file_exists($oldFile)) unlink($oldFile);
                }
                
                $uploadDir = __DIR__ . '/../../../uploads/';
                if(!is_dir($uploadDir)) mkdir($uploadDir, 0755, true);
                $fileName = time() . '_' . basename($_FILES['profile_photo']['name']);
                $uploadFile = $uploadDir . $fileName;
                if(move_uploaded_file($_FILES['profile_photo']['tmp_name'], $uploadFile)){
                    $profilePhoto = $fileName;
                }
            }

            $controller->update(
                $id,
                [
                    'lrn' => $_POST['lrn'],
                    'first_name' => $_POST['first_name'],
                    'middle_name' => $_POST['middle_name'],
                    'last_name' => $_POST['last_name'],
                    'suffix' => $_POST['suffix'] ?? '',
                    'gender' => $_POST['gender'],
                    'birth_date' => $_POST['birth_date'],
                    'age' => $_POST['age'],
                    'place_of_birth' => $_POST['place_of_birth'],
                    'nationality' => $_POST['nationality'],
                    'religion' => $_POST['religion'],
                    'address' => $_POST['address'],
                    'contact_number' => $_POST['contact_number'],
                    'email' => $_POST['email'] ?? '',
                    'profile_photo' => $profilePhoto,
                    'enrollment_status' => $_POST['enrollment_status'] ?? ''
                ]
            );
        }
        elseif(isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_POST['id'])){
            header('Content-Type: application/json');
            $id = intval($_POST['id']);
            
            // Get student to delete their photo
            $student = $controller->getById($id);
            if($student && $student['profile_photo']){
                $photoFile = __DIR__ . '/../../../uploads/' . $student['profile_photo'];
                if(file_exists($photoFile)) unlink($photoFile);
            }
            
            $result = $controller->delete($id);
            echo json_encode($result);
            exit();
        }
    }
    
    // Handle GET request to fetch student data (for edit modal)
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['action']) && $_GET['action'] === 'get'){
        header('Content-Type: application/json');
        if(isset($_GET['id'])){
            $id = intval($_GET['id']);
            $student = $controller->getById($id);
            if($student){
                echo json_encode($student);
            }else{
                echo json_encode(['error' => 'Student not found']);
            }
        }else{
            echo json_encode(['error' => 'ID not provided']);
        }
        exit();
    }
?>