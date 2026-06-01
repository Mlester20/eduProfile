<?php
require_once __DIR__ . '/../models/Model.php';

    class StudentsService extends Model {
        //protected students property
        protected $students = 'students';

        /**
         * Create full name from student name components
         * @param string $firstName
         * @param string $middleName
         * @param string $lastName
         * @param string $suffix
         * @return string Full name
         */
        public static function getFullName($firstName, $middleName = '', $lastName = '', $suffix = '') {
            $nameParts = [];
            
            if (!empty($firstName)) $nameParts[] = $firstName;
            if (!empty($middleName)) $nameParts[] = $middleName;
            if (!empty($lastName)) $nameParts[] = $lastName;
            if (!empty($suffix)) $nameParts[] = $suffix;
            
            return implode(' ', $nameParts);
        }

        /**
         * Add full name to student records
         * @param array $students Array of student records
         * @return array Students with full_name added
         */
        public static function addFullNames($students) {
            foreach ($students as &$student) {
                $student['full_name'] = self::getFullName(
                    $student['first_name'] ?? '',
                    $student['middle_name'] ?? '',
                    $student['last_name'] ?? '',
                    $student['suffix'] ?? ''
                );
            }
            return $students;
        }

        /** 
         * Search Specific Students
         * Prepare the Like keyword
        */
        public function searchStudents($keyword){
            $keyword = trim($keyword);

            if(empty($keyword) || strlen($keyword) < 2){
                return []; //simply returns an empty array
            }

            //prepare the keyword for LIKE search
            $searchKeyword = '%' . $keyword . '%';
            $query = "SELECT
                s.id,
                s.lrn,
                s.first_name,
                s.middle_name,
                s.last_name,
                s.suffix,
                s.gender,
                s.birth_date,
                s.age,
                s.place_of_birth,
                s.nationality,
                s.religion,
                s.address,
                s.contact_number,
                s.email,
                s.grade_level,
                s.enrollment_status,
                s.profile_photo
                FROM {$this->students} s
                WHERE 
                s.lrn LIKE ? OR
                s.first_name LIKE ? OR
                s.middle_name LIKE ? OR
                s.last_name LIKE ?
                ORDER BY s.first_name ASC, s.last_name ASC
            ";

            $stmt = null;
            $result = [];

            try{
                //prepare the statement
                $stmt = $this->con->prepare($query);

                //check if stmt is not successfully
                if(!$stmt){
                    return []; //return an empty array
                }

                $stmt->bind_param(
                    "ssss",
                    $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword
                );
                $stmt->execute();

                //get the result
                $result = $stmt->get_result();
                $results = $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log("Search Students Error: " . $e->getMessage());
                return [];
            }finally{
                if($stmt){
                    $stmt->close();
                }
            }
            //return the results
            return $results ?? [];
        }

        // view student details for the teacher
        public function getStudentDetails(){
            try{
                $query = "SELECT
                    s.id,
                    s.lrn,
                    s.first_name,
                    s.middle_name,
                    s.last_name,
                    s.suffix,
                    s.gender,
                    s.birth_date,
                    s.age,
                    s.place_of_birth,
                    s.nationality,
                    s.religion,
                    s.address,
                    s.contact_number,
                    s.email,
                    s.grade_level,
                    s.enrollment_status,
                    s.profile_photo
                    FROM {$this->students} s
                    WHERE s.id = ?
                    ORDER BY s.first_name ASC, s.last_name ASC
                ";
                $stmt = $this->con->prepare($query);

                //check if stmt is not successfully prepared
                if(!$stmt){
                    return null; //return null if statement preparation fails
                }
                $stmt->bind_param("i", $_SESSION['id']);
                $stmt->execute();
                $result = $stmt->get_result();
                $result = $result->fetch_all(MYSQLI_ASSOC);
                return $result[0] ?? null; //return the first result or null if not found
            }catch(Exception $e){
                error_log("Get Student Details Error: " . $e->getMessage());
                return null;
            }finally{
                if($stmt){
                    $stmt->close();
                }
            }
        }

        /**
         * Get student details by student ID
         * @param int $student_id The student's ID
         * @return array|null Student details or null if not found
         */
        public function getStudentDetailsById($student_id){
            try{
                $query = "SELECT
                    s.id,
                    s.lrn,
                    s.first_name,
                    s.middle_name,
                    s.last_name,
                    s.suffix,
                    s.gender,
                    s.birth_date,
                    s.age,
                    s.place_of_birth,
                    s.nationality,
                    s.religion,
                    s.address,
                    s.contact_number,
                    s.email,
                    s.grade_level,
                    s.enrollment_status,
                    s.profile_photo
                    FROM {$this->students} s
                    WHERE s.id = ?
                ";
                $stmt = $this->con->prepare($query);
                
                if(!$stmt){
                    return null;
                }
                $stmt->bind_param("i", $student_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row ?? null;
            }catch(Exception $e){
                error_log("Get Student Details By ID Error: " . $e->getMessage());
                return null;
            }finally{
                if($stmt){
                    $stmt->close();
                }
            }
        }

        /**
         * Get guardian information by student ID
         * @param int $student_id The student's ID
         * @return array|null Guardian information or null if not found
         */
        public function getGuardianInfoByStudentId($student_id){
            try{
                $query = "SELECT
                    pg.id,
                    pg.student_id,
                    pg.father_name,
                    pg.father_occupation,
                    pg.father_contact,
                    pg.mother_name,
                    pg.mother_occupation,
                    pg.mother_contact,
                    pg.guardian_name,
                    pg.guardian_relationship,
                    pg.guardian_contact,
                    pg.monthly_income
                    FROM parents_guardians pg
                    WHERE pg.student_id = ?
                ";
                $stmt = $this->con->prepare($query);
                
                if(!$stmt){
                    return null;
                }
                $stmt->bind_param("i", $student_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                return $row ?? null;
            }catch(Exception $e){
                error_log("Get Guardian Info Error: " . $e->getMessage());
                return null;
            }finally{
                if($stmt){
                    $stmt->close();
                }
            }
        }
    }

?>