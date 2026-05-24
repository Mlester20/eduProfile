<?php
require_once __DIR__ . '/../Model.php';

    class StudentSectionModel extends Model{
        protected $students = 'students';
        protected $users = 'users';
        protected $sections = 'sections';
        protected $student_sections = 'student_sections';

        public function index($page = 1, $limit = 10){
            try{
                $offset = ($page - 1) * $limit;
                $query = "SELECT 
                            ss.id,
                            CONCAT(s.first_name, ' ', IFNULL(s.middle_name, ''), ' ', s.last_name) AS student_name,
                            sec.section_name,
                            sec.grade_level,
                            sy.school_year,
                            u.full_name AS teacher_name,
                            ss.student_id,
                            ss.section_id
                          FROM {$this->student_sections} ss
                          INNER JOIN {$this->students} s ON ss.student_id = s.id
                          INNER JOIN {$this->sections} sec ON ss.section_id = sec.id
                          LEFT JOIN {$this->users} u ON sec.adviser_id = u.id
                          LEFT JOIN school_year sy ON sec.school_year_id = sy.id
                          ORDER BY sy.school_year DESC, sec.section_name ASC, s.last_name ASC
                          LIMIT ? OFFSET ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('ii', $limit, $offset);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get student sections error: ' . $e->getMessage());
                return [];
            }
        }

        public function getTotalCount(){
            try{
                $query = "SELECT COUNT(*) as total FROM {$this->student_sections}";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row['total'];
            }catch(Exception $e){
                error_log('Get total count error: ' . $e->getMessage());
                return 0;
            }
        }

        public function getAvailableStudents(){
            try{
                $query = "SELECT * FROM {$this->students} 
                          WHERE id NOT IN (
                              SELECT DISTINCT student_id FROM {$this->student_sections}
                          )";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get available students error: ' . $e->getMessage());
                return [];
            }
        }

        public function getAllStudents(){
            try{
                $query = "SELECT * FROM {$this->students} ORDER BY last_name ASC, first_name ASC";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get all students error: ' . $e->getMessage());
                return [];
            }
        }

        public function getAvailableSections(){
            try{
                $query = "SELECT s.id, CONCAT(s.section_name, ' - ', s.grade_level) AS section_info 
                          FROM {$this->sections} s
                          WHERE (SELECT COUNT(*) FROM {$this->student_sections} WHERE section_id = s.id) < s.max_students";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get available sections error: ' . $e->getMessage());
                return [];
            }
        }   

        public function create($data){
            try{
                $query = "INSERT INTO {$this->student_sections} (student_id, section_id) VALUES (?, ?)";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    'ii',
                    $data['student_id'],
                    $data['section_id']
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log('Create student section error: ' . $e->getMessage());
                return false;
            }
        }

        public function update($id, $data){
            try{
                $query = "UPDATE {$this->student_sections} SET student_id = ?, section_id = ? WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    'iii',
                    $data['student_id'],
                    $data['section_id'],
                    $id
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log('Update student section error: ' . $e->getMessage());
                return false;
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->student_sections} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param('i', $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log('Delete student section error: ' . $e->getMessage());
                return false;
            }
        }
    }