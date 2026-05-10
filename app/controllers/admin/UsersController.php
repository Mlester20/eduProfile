<?php
session_start();

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../models/admin/UsersModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class UsersController extends Controller{

        public function __construct($con) {
            parent::__construct(new UsersModel($con)); // $this->model is set by the parent
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
                    setFlash('success', 'User created successfully');
                    header('Location: ../../../resources/views/admin/users.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to create user');
                    header('Location: ../../../resources/views/admin/users.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
                return ['success' => false, 'message' => 'Failed to create user.'];
            }
        }

        public function update($id, $data){
            try{
                
            }catch(Exception $e){
                error_log($e->getMessage());
            }
        }

        public function delete($id){
            try{
                
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }
    }

    // bootstrap model and controller 
    try{
        $usersController = new UsersController($con);
        $users = $usersController->index();
    }catch(Exception $e){
        error_log($e->getMessage());
        exit();
    }

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['createUser'])){
            $usersController->create(
                [
                    'full_name' => $_POST['full_name'],
                    'email' => $_POST['email'],
                    'password' => $_POST['password'],
                    'role' => $_POST['role']
                ]
            );
        }
    }

?>