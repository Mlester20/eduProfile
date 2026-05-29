<?php
session_start();

require_once __DIR__ . '/../../models/teacher/StudentsListModel.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../app/services/StudentsService.php';

    class StudentsListController{
        private $model;
        protected $studentsService;

        public function __construct($con){
            $this->model = new StudentsListModel($con);
            $this->studentsService = new StudentsService($con);
        }

        public function index(){
            $teacher_id = $_SESSION['id'];
            $students = $this->model->getStudentsByTeacher($teacher_id);
            
            // Add full names using the service
            if (!empty($students)) {
                $students = $this->studentsService->addFullNames($students);
            }
            
            return $students;
        }
    }

    try{
        $controller = new StudentsListController($con);
        $students = $controller->index();
    }catch(Exception $e){
        error_log("Error in StudentsListController: " . $e->getMessage());
        $students = [];
    }