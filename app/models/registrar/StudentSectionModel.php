<?php
require_once __DIR__ . '/../Model.php';

    class StudentSectionModel extends Model{
        protected $students = 'students';
        protected $users = 'users';
        protected $sections = 'sections';
        protected $student_sections = 'student_sections';

        public function index(){
            try{
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
                          ORDER BY sy.school_year DESC, sec.section_name ASC, s.last_name ASC";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log('Get student sections error: ' . $e->getMessage());
                return [];
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

        public function getAvailableSections(){
            try{
                $query = "SELECT s.id, CONCAT(s.section_name, ' - ', s.grade_level) AS section_info 
                          FROM {$this->sections} s
                          LEFT JOIN {$this->student_sections} ss ON s.id = ss.section_id
                          GROUP BY s.id
                          HAVING COUNT(ss.student_id) < s.max_students";
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

        }

        public function update($id, $data){

        }

        public function delete($id){

        }
    }