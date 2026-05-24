<?php
require_once __DIR__ . '/../Model.php';

    class SubjectsModel extends Model{
        protected $subjects = 'subjects';

        public function index(){
            try{
                $query = "SELECT * FROM {$this->subjects} ORDER BY id ASC";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function getPaginated($page = 1, $limit = 10){
            try{
                $offset = ($page - 1) * $limit;
                $query = "SELECT * FROM {$this->subjects} ORDER BY id ASC LIMIT ? OFFSET ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('ii', $limit, $offset);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function getTotal(){
            try{
                $query = "SELECT COUNT(*) as total FROM {$this->subjects}";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total'];
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function create($data){
            try{
                $query = "INSERT INTO {$this->subjects} (subject_code, grade_level, subject_name) VALUES (?, ?, ?)";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    'sss', 
                    $data['subject_code'], 
                    $data['grade_level'], 
                    $data['subject_name']
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function update($id, $data){
            try{
                $query = "UPDATE {$this->subjects} SET subject_code = ?, grade_level = ?, subject_name = ? WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('sssi', $data['subject_code'], $data['grade_level'], $data['subject_name'], $id);
                $stmt->execute();   
                return true;
            }catch(Exception $e){
                die($e->getMessage());
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->subjects} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                die($e->getMessage());
            }
        }
    }