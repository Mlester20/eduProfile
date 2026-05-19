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

        }

        public function getAvailableTeachers(){

        }

        public function getActiveSchoolYear(){

        }

        public function update($id, $data){

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
        $sections = $controller->index();
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['delete_section'])){
            $delete_id = $_POST['delete_section'];
            $controller->delete($delete_id);
        }
    }