<?php
session_start();

require_once __DIR__ . '/../../models/registrar/SectionsModel.php';
require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class SectionsController extends Controller{
        private $auditLogs;

        public function __construct($con){
            parent::__construct(
                new SectionsModel($con)
            );
            $this->auditLogs = new AuditLogs($con);
        }

        public function index(){
            return $this->model->index();
        }

        public function create($data){
            if($this->model->create($data)){
                $user_id = $_SESSION['user']['id'] ?? null;
                $role = $_SESSION['user']['role'] ?? null;
                $this->auditLogs->log(
                    $user_id,
                    $role,
                    'Created section: ' . $data['section_name'],
                    null,
                    'sections',
                    'created a new section: ' . $data['section_name']
                );

                setFlash('success', 'Section created successfully.');
                header("Location: ../../../resources/views/registrar/sections.php");
                exit();
            }else{
                setFlash('error', 'Failed to create section. Please try again.');
                header("Location: ../../../resources/views/registrar/sections.php");
                exit();
            }
        }

        public function getAvailableTeachers(){
            return $this->model->getAvailableTeachers();
        }

        public function getAllTeachers(){
            return $this->model->getAllTeachers();
        }

        public function getActiveSchoolYear(){
            return $this->model->getActiveSchoolYear();
        }

        public function totalStudents($section_id){
            return $this->model->totalStudents($section_id);
        }

        public function update($id, $data){
            try{
                if($this->model->update($id, $data)){
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? null;
                    $this->auditLogs->log(
                        $user_id,
                        $role,
                        'Updated section with ID: ' . $id,
                        $id,
                        'sections',
                        'updated a section id: ' . $id
                    );

                    setFlash('success', 'Section updated successfully.');
                    header("Location: ../../../resources/views/registrar/sections.php");
                    exit();
                }else{
                    setFlash('error', 'Failed to update section. Please try again.');
                    header("Location: ../../../resources/views/registrar/sections.php");
                    exit();
                }
            }catch(Exception $e){
                throw new Exception("Error " . $e->getMessage(), 500);
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    $user_id = $_SESSION['user']['id'] ?? null;
                    $role = $_SESSION['user']['role'] ?? null;
                    $this->auditLogs->log(
                        $user_id,
                        $role,
                        'Deleted section with ID: ' . $id,
                        $id,
                        'sections',
                        'deleted a section id: ' . $id
                    );

                    setFlash('success', 'Section deleted successfully.');
                    header("Location: ../../../resources/views/registrar/sections.php");
                    exit();
                }
            }catch(Exception $e){
                error_log('Delete section error: ' . $e->getMessage());
                return false;

            }
        }

    }

    try{
        $controller = new SectionsController($con);
        
        // Handle POST requests first
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['save_section'])){
                $controller->create(
                    [
                        'section_name' => $_POST['section_name'],
                        'grade_level' => $_POST['grade_level'],
                        'adviser_id' => $_POST['adviser_id'],
                        'school_year_id' => $_POST['school_year_id'],
                        'max_students' => $_POST['max_students'] ?? 35
                    ]
                );
                exit();
            }
            
            if(isset($_POST['update_section'])){
                $update_id = $_POST['id'];
                $controller->update($update_id, [
                    'section_name' => $_POST['section_name'],
                    'grade_level' => $_POST['grade_level'],
                    'adviser_id' => $_POST['adviser_id'],
                    'school_year_id' => $_POST['school_year_id'],
                    'max_students' => $_POST['max_students'] ?? 35
                ]);
                exit();
            }

            if(isset($_POST['delete_section'])){
                $delete_id = $_POST['delete_section'];
                $controller->delete($delete_id);
                exit();
            }
        }
        
        // Fetch data after POST handling
        $sections = $controller->index();
        $teachers = $controller->getAvailableTeachers();
        $allTeachers = $controller->getAllTeachers(); // For edit modal
        $sy = $controller->getActiveSchoolYear();
        
        // Add total students count for each section
        if(!empty($sections)){
            foreach($sections as &$section){
                $section['total_students'] = $controller->totalStudents($section['id']);
            }
            unset($section); // Remove reference
        }
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
    }