<?php
require_once __DIR__ . '/../Model.php';

    class SectionsModel extends Model{
        protected $users = 'users'; //get user where role is teacher
        protected $school_years = 'school_year'; //get active school year
        protected $sections = 'sections';

        public function index(){
            $query = "SELECT s.*, u.full_name AS adviser_name, sy.school_year FROM {$this->sections} s 
                      LEFT JOIN {$this->users} u ON s.adviser_id = u.id 
                      LEFT JOIN {$this->school_years} sy ON s.school_year_id = sy.id";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function create($data){
            $query = "INSERT INTO {$this->sections} (section_name, grade_level, adviser_id, school_year_id, max_students) VALUES (?, ?, ?, ?, ?)";
            $stmt = $this->con->prepare($query);
            $stmt->bind_param(
                "ssiii",
                $data['section_name'],
                $data['grade_level'],
                $data['adviser_id'],
                $data['school_year_id'],
                $data['max_students']
            );
            $stmt->execute();
            return true;
        }

        public function getTeachers(){
            try{
                $query = "SELECT id, name FROM {$this->users} WHERE role = 'teacher'";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get teachers error: ' . $e->getMessage());
                return [];
            }
        }

        public function getActiveSchoolYear(){
            try{
                $query = "SELECT * FROM {$this->school_years} WHERE status = 'active' LIMIT 1";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC)[0] ?? null;
            }catch(Exception $e){
                error_log('Get active school year error: ' . $e->getMessage());
                return null;
            }
        }

        public function update($id, $data){
            try{
                $query = "UPDATE {$this->sections} SET section_name = ?, grade_level = ?, adviser_id = ?, school_year_id = ?, max_students = ? WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    "ssiiiii",
                    $data['section_name'],
                    $data['grade_level'],
                    $data['adviser_id'],
                    $data['school_year_id'],
                    $data['max_students'],
                    $id
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log('Update section error: ' . $e->getMessage());
                return false;
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->sections} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log('Delete section error: ' . $e->getMessage());
                return false;
            }
        }
    }