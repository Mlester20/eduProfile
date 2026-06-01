<?php
require_once __DIR__ . '/../Model.php';

    class StudentsListModel extends Model{
        protected $students = 'students';
        protected $sections = 'sections';
        protected $school_year = 'school_year';
        protected $student_sections = 'student_sections';

        public function index(){
            try{
                $query = "SELECT 
                    s.id,
                    s.first_name,
                    s.last_name,
                    s.student_number,
                    sec.section_name,
                    sec.grade_level,
                    sy.school_year
                    FROM {$this->students} s
                    JOIN {$this->sections} sec ON s.section_id = sec.id
                    JOIN {$this->school_year} sy ON sec.school_year_id = sy.id
                    ORDER BY sy.school_year DESC, sec.section_name ASC, s.last_name ASC
                ";  
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log("Error fetching students list: " . $e->getMessage());
                return [];
            }
        }

        /**
         * Fetch all students assigned to a teacher
         * @param int $teacher_id The teacher's user ID
         * @return array Associative array of students with section and school year info
         */
        public function getStudentsByTeacher($teacher_id){
            try{
                $query = "SELECT 
                    s.id,
                    s.lrn,
                    s.first_name,
                    s.middle_name,
                    s.last_name,
                    s.suffix,
                    s.grade_level,
                    s.gender,
                    s.birth_date,
                    s.age,
                    s.enrollment_status,
                    s.contact_number,
                    s.email,
                    s.profile_photo,
                    sec.id as section_id,
                    sec.section_name,
                    sec.grade_level as section_grade_level,
                    sy.id as school_year_id,
                    sy.school_year
                    FROM {$this->students} s
                    JOIN {$this->student_sections} ss ON s.id = ss.student_id
                    JOIN {$this->sections} sec ON ss.section_id = sec.id
                    JOIN {$this->school_year} sy ON sec.school_year_id = sy.id
                    WHERE sec.adviser_id = ? AND sy.status = 'active'
                    ORDER BY sy.school_year DESC, sec.section_name ASC, s.last_name ASC, s.first_name ASC
                ";
                
                $stmt = $this->con->prepare($query);
                if(!$stmt){
                    throw new Exception("Prepare failed: " . $this->con->error);
                }
                
                $stmt->bind_param("i", $teacher_id);
                $stmt->execute();
                $result = $stmt->get_result();
                
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log("Error fetching students by teacher: " . $e->getMessage());
                return [];
            }
        }

        /**
         * Fetch paginated students assigned to a teacher
         * @param int $teacher_id The teacher's user ID
         * @param int $page Current page number (1-indexed)
         * @param int $itemsPerPage Items to display per page
         * @return array Associative array of students with section and school year info
         */
        public function getStudentsByTeacherPaginated($teacher_id, $page = 1, $itemsPerPage = 10){
            try{
                $offset = ($page - 1) * $itemsPerPage;
                
                $query = "SELECT 
                    s.id,
                    s.lrn,
                    s.first_name,
                    s.middle_name,
                    s.last_name,
                    s.suffix,
                    s.grade_level,
                    s.gender,
                    s.birth_date,
                    s.age,
                    s.enrollment_status,
                    s.contact_number,
                    s.email,
                    s.profile_photo,
                    sec.id as section_id,
                    sec.section_name,
                    sec.grade_level as section_grade_level,
                    sy.id as school_year_id,
                    sy.school_year
                    FROM {$this->students} s
                    JOIN {$this->student_sections} ss ON s.id = ss.student_id
                    JOIN {$this->sections} sec ON ss.section_id = sec.id
                    JOIN {$this->school_year} sy ON sec.school_year_id = sy.id
                    WHERE sec.adviser_id = ? AND sy.status = 'active'
                    ORDER BY sy.school_year DESC, sec.section_name ASC, s.last_name ASC, s.first_name ASC
                    LIMIT ? OFFSET ?
                ";
                
                $stmt = $this->con->prepare($query);
                if(!$stmt){
                    throw new Exception("Prepare failed: " . $this->con->error);
                }
                
                $stmt->bind_param("iii", $teacher_id, $itemsPerPage, $offset);
                $stmt->execute();
                $result = $stmt->get_result();
                
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log("Error fetching paginated students by teacher: " . $e->getMessage());
                return [];
            }
        }

        /**
         * Get total count of students assigned to a teacher
         * @param int $teacher_id The teacher's user ID
         * @return int Total number of students
         */
        public function getStudentsCountByTeacher($teacher_id){
            try{
                $query = "SELECT COUNT(*) as total
                    FROM {$this->students} s
                    JOIN {$this->student_sections} ss ON s.id = ss.student_id
                    JOIN {$this->sections} sec ON ss.section_id = sec.id
                    JOIN {$this->school_year} sy ON sec.school_year_id = sy.id
                    WHERE sec.adviser_id = ? AND sy.status = 'active'
                ";
                
                $stmt = $this->con->prepare($query);
                if(!$stmt){
                    throw new Exception("Prepare failed: " . $this->con->error);
                }
                
                $stmt->bind_param("i", $teacher_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                
                return $row['total'] ?? 0;
            }catch(Exception $e){
                error_log("Error getting students count: " . $e->getMessage());
                return 0;
            }
        }
    }