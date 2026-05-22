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

        public function index(){
            return $this->model->index();
        }

        public function getAvailableStudents(){
            return $this->model->getAvailableStudents();
        }

        public function getAvailableSections(){
            return $this->model->getAvailableSections();
        }

        public function create($data){

        }

        public function update($id, $data){

        }

        public function delete($id){

        }
    }

    // ============= Bootstrap The Controller ============= //
    try {
        $controller = new StudentSectionController($con);
        $student_sections = $controller->index();
        $students = $controller->getAvailableStudents();
        $sections = $controller->getAvailableSections();
    }catch(Exception $e) {
        throw new Exception("Error " . $e->getMessage(),500);
    }