<?php
session_start();

require_once __DIR__ . '/../Controller.php';
require_once __DIR__ . '/../../models/admin/UsersModel.php';
require_once __DIR__ . '/../../helpers/message.php';
require_once __DIR__ . '/../../helpers/auditLogs.php';
require_once __DIR__ . '/../../../database/config/config.php';

    class UsersController extends Controller{
        protected $logs;

        public function __construct($con) {
            parent::__construct(new UsersModel($con)); // $this->model is set by the parent
            $this->logs = new AuditLogs($con);
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
                    if(isset($_SESSION['id'])){
                        $this->logs->log(
                            $_SESSION['id'],
                            $_SESSION['role'] ?? 'unknown',
                            'CREATE USER',
                            'USERS',
                            null,
                            'users',
                            $_SESSION['full_name'] . ' created a new user with email: ' . $data['email'],
                            'success'
                        );
                    }
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
                if($this->model->update($id, $data)){
                    if(isset($_SESSION['id'])){
                        $this->logs->log(
                            $_SESSION['id'],
                            $_SESSION['role'] ?? 'unknown',
                            'UPDATE USER',
                            'USERS',
                            $id,
                            'users',
                            $_SESSION['full_name'] . ' updated a user record with ID: ' . $id,
                            'success'
                        );
                    }
                    setFlash('success', 'User updated successfully');
                    header('Location: ../../../resources/views/admin/users.php');
                    exit();
                }else{
                    setFlash('error', 'Failed to update user');
                    header('Location: ../../../resources/views/admin/users.php');
                    exit();
                }
            }catch(Exception $e){
                error_log($e->getMessage());
            }
        }

        public function delete($id){
            try{
                if($this->model->delete($id)){
                    $this->logs->log(
                        $_SESSION['id'] ?? null,
                        $_SESSION['role'] ?? 'unknown',
                        'DELETE USER',
                        'USERS',
                        $id,
                        'users',
                        $_SESSION['full_name'] . ' deleted a user record with ID: ' . $id,
                        'success'
                    );
                    setFlash('success', 'User deleted successfully');
                } else {
                    setFlash('error', 'Failed to delete user');
                }

                header('Location: ../../../resources/views/admin/users.php');
                exit();

            } catch(Exception $e){
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
        if(isset($_POST['updateUser'])){
            $usersController->update(
                $user_id = $_POST['id'],
                [
                    'full_name' => $_POST['full_name'],
                    'email' => $_POST['email'],
                    'role' => $_POST['role']
                ]
            );
        }
        if(isset($_POST['deleteUser'])){
            $usersController->delete($_POST['id']);
        }
    }

?>