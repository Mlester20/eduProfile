<?php
session_start();

require_once __DIR__ . '/../../models/admin/SchoolYearModel.php';
require_once __DIR__ . '/../../controllers/Controller.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../helpers/message.php';

    class SchoolYearController extends Controller{
        protected $logs;

        public function __construct($con){
            parent::__construct(new SchoolYearModel($con));
            $this->logs = new AuditLogs($con);
        }

        public function index(){
            try{
                return $this->model->index();
            }catch(Exception $e){
                return $e->getMessage();
            }
        }

        public function create($data){
            if(empty($data['school_year']) || empty($data['start_date']) || empty($data['end_date'])){
                setFlash('error', 'All fields are required.');
                header('Location: ../../../resources/views/admin/sy.php');
                exit();
            }else{
                if($this->model->create($data)){
                    $this->logs->log(
                            $_SESSION['id'] ?? null,
                            $_SESSION['role'] ?? 'unknown',
                            'CREATE SCHOOL YEAR',
                            'SCHOOL_YEAR',
                            null,
                            'school_years',
                            $_SESSION['full_name'] . ' created a new school year record',
                            'success'
                        );
                    setFlash('success', 'School year created successfully.');
                    header('Location: ../../../resources/views/admin/sy.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to create school year.');
                    header('Location: ../../../resources/views/admin/sy.php');
                    exit();
                }
            }
        }

        //function to avoid deleting active school year
        public function canDelete($id){
            $school_years = $this->model->index();
            foreach($school_years as $sy){
                if($sy['id'] == $id && $sy['status'] == 'active'){
                    return false;
                }
            }
            return true;
        }

        public function update($id, $data){
            if(empty($data['school_year']) || empty($data['start_date']) || empty($data['end_date']) || empty($data['status'])){
                setFlash('error', 'All fields are required.');
                header('Location: ../../../resources/views/admin/sy.php');
                exit();
            }else{
                try{
                    if($this->model->update($id, $data)){
                        $this->logs->log(
                                $_SESSION['id'] ?? null,
                                $_SESSION['role'] ?? 'unknown',
                                'UPDATE SCHOOL YEAR',
                                'SCHOOL_YEAR',
                                $id,
                                'school_years',
                                $_SESSION['full_name'] . ' updated a school year record',
                                'success'
                            );
                        setFlash('success', 'School year updated successfully.');
                        header('Location: ../../../resources/views/admin/sy.php');
                        exit();
                    }else{
                        setFlash('error', 'Failed to update school year.');
                        header('Location: ../../../resources/views/admin/sy.php');
                        exit();
                    }
                }catch(Exception $e){
                    return $e->getMessage();
                }
            }
        }

        public function delete($id){
            try{
                // Check if the school year can be deleted
                if(!$this->canDelete($id)){
                    setFlash('error', 'This is an active school year and cannot be deleted.');
                    header('Location: ../../../resources/views/admin/sy.php');
                    exit();
                }
                if($this->model->delete(['id' => $id])){
                    $this->logs->log(
                            $_SESSION['id'] ?? null,
                            $_SESSION['role'] ?? 'unknown',
                            'DELETE SCHOOL YEAR',
                            'SCHOOL_YEAR',
                            $id,
                            'school_years',
                            $_SESSION['full_name'] . ' deleted a school year record',
                            'success'
                        );
                    setFlash('success', 'School year deleted successfully.');
                    header('Location: ../../../resources/views/admin/sy.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to delete school year.');
                    header('Location: ../../../resources/views/admin/sy.php');
                    exit();
                }
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
        
    }

    try{
        $controller = new SchoolYearController($con);
        $school_years = $controller->index();
    }catch(Exception $e){
        return $e->getMessage();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['create_sy'])){
            $controller->create([
                'school_year' => $_POST['school_year'],
                'start_date' => $_POST['start_date'],
                'end_date' => $_POST['end_date']
            ]);
        }if(isset($_POST['update_sy'])){
            $sy_id = $_POST['id'] ?? null;
            $controller->update(
                $sy_id  ,
                [
                    'school_year' => $_POST['school_year'],
                    'start_date' => $_POST['start_date'],
                    'end_date' => $_POST['end_date'],
                    'status' => $_POST['status']
                ]
            );
        }if(isset($_POST['delete_sy'])){
            $controller->delete($_POST['id']);
        }
    }