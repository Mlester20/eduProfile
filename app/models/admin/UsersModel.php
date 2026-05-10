<?php
require_once __DIR__ . '/../Model.php';
require_once __DIR__ . '/../../helpers/hashPassword.php';

    class UsersModel extends Model{
        protected $users = 'users';

        public function index(){
            try{
                $query = "SELECT id, full_name, email, role FROM {$this->users} ORDER BY id ASC";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $users = $stmt->get_result();
                return $users->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        public function create($data){
            try{
                $query = "INSERT INTO {$this->users} (full_name, email, password, role) VALUES (?, ?, ?, ?)";
                $stmt = $this->con->prepare($query);
                $hashedPassword = HashPassword::passwordHash($data['password']);
                $stmt->bind_param("ssss", $data['full_name'], $data['email'], $hashedPassword, $data['role']);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
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

?>