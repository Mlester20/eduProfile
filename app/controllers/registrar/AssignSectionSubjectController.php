<?php
session_start();

require_once __DIR__ . '/../../models/registrar/AssignSectionSubjectModel.php';
require_once __DIR__ . '/../../models/registrar/SectionsModel.php'; //get index of section models
require_once __DIR__ . '/../../models/registrar/SubjectsModel.php'; // get index of subject models
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../controllers/Controller.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class SectionSubjectController extends Controller{
        protected $logs;
        protected $sections;
        protected $subjects;

        public function __construct($con){
            parent::__construct(
                new SectionSubjectModel($con)
            );
            $this->logs = new AuditLogs($con);
            $this->sections = new SectionsModel($con);
            $this->subjects = new SubjectsModel($con);
        }



        public function index(){
            return $this->model->index();
        }

        public function getSections(){
            return $this->sections->index();
        }

        public function getSubjects(){
            return $this->subjects->index();
        }

        public function create($data){
            try{
                // Validate that required fields are not empty
                if(empty($data['section_id']) || empty($data['subject_id'])){
                    setFlash('error', 'Please select both a section and a subject.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }
                if($this->model->create($data)){
                    $this->logs->log(
                        $_SESSION['user']['id'] ?? null,
                        $_SESSION['user']['role'] ?? null,
                        'Assigned subject to section: ' . $data['subject_id'] . ' to section ' . $data['section_id'],
                        null,
                        'section_subjects',
                        'assigned subject to section: ' . $data['subject_id'] . ' to section ' . $data['section_id']
                    );
                    setFlash('success', 'Subject assigned to section successfully.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }
            }catch(Exception $e){
                echo $e->getMessage();
                exit();
            }
        }

        public function update($id, $data){
            try{
                if(empty($data['section_id']) || empty($data['subject_id'])){
                    setFlash('error', 'Please select both a section and a subject.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }
                if($this->model->update($id, $data)){
                    setFlash('success', 'Section subject assignment updated successfully.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to update section subject assignment.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    setFlash('success', 'Section subject deleted successfully.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to delete section subject.');
                    header('Location: ../../../resources/views/registrar/assign-section-subjects.php');
                    exit();
                }
            }catch(Exception $e){
                echo $e->getMessage();
            }
        }
    }

    try{
        $controller = new SectionSubjectController($con);
        $assignSubjects = $controller->index();
        $sections = $controller->getSections();
        $subjects = $controller->getSubjects();

        //implement the create, update, and delete functions via check if statements and $_POST data
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(isset($_POST['assign_subject'])){
                $controller->create([
                    'section_id' => $_POST['section_id'],
                    'subject_id' => $_POST['subject_id']
                ]);
            }
            if(isset($_POST['update_assign_subject'])){
                $id = $_POST['assign_subject_id'];
                $controller->update($id, [
                    'section_id' => $_POST['section_id'],
                    'subject_id' => $_POST['subject_id']
                ]);
            }
            if(isset($_POST['delete_assign_subject'])){
                $id = $_POST['delete_assign_subject'];
                $controller->delete($id);
            }
        }
    }catch(Exception $e){
        echo $e->getMessage();
    }