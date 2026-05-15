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
                if(!$stmt){
                    throw new Exception("Error preparing statement");
                }
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
                $query = "UPDATE {$this->users} SET full_name = ?, email = ?, role = ? WHERE id = ?";
                $stmt = $this->con->prepare($query);
                if(!$stmt){
                    throw new Exception("Error preparing statement");
                }
                $stmt->bind_param("sssi", $data['full_name'], $data['email'], $data['role'], $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->users} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log($e->getMessage());
                exit();
            }
        }   
    }

?>