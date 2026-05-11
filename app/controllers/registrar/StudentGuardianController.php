<?php
session_start();

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../models/registrar/StudentGuardianModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../services/Students.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class StudentGuardianController extends Controller{
        public function __construct($con){
            parent::__construct(new StudentGuardianModel(($con)));
        }

        public function index(){
            try{
                return $this->model->index();
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        public function create($data){
            try{
                if($this->model->create($data)){
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
        $guardians = $controller->index();
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
     }
?>