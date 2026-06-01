<?php
session_start();

require_once __DIR__ . '/../../models/teacher/SubjectListModel.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class SubjectListController{
        private $model;

        public function __construct($con){
            $this->model = new SubjectListModel($con);
        }

        public function index(){
            $teacher_id = $_SESSION['id'];
            return $this->model->getSubjectsByTeacher($teacher_id);
        }
    }

    try{
        $controller = new SubjectListController($con);
        $assigned_subjects = $controller->index();
    }catch(Exception $e){
        error_log("Error in SubjectListController: " . $e->getMessage());
    }