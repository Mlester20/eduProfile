<?php
require_once __DIR__ . '/../Model.php';

    class SectionSubjectModel extends Model{
        protected $section = 'sections';
        protected $subject = 'subjects';
        protected $assign_subjects = 'assign_section_subjects';
        protected $school_year = 'school_year';

        public function index(){
            try{
                $query = "SELECT 
                    ss.id,
                    ss.section_id,
                    ss.subject_id,
                    sy.school_year,
                    s.section_name,
                    s.grade_level,
                    sub.subject_name AS subject_name
                    FROM {$this->assign_subjects} ss
                    JOIN {$this->section} s ON ss.section_id = s.id
                    JOIN {$this->school_year} sy ON s.school_year_id = sy.id
                    JOIN subjects sub ON ss.subject_id = sub.id
                    ORDER BY sy.school_year DESC, s.section_name ASC
                ";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                error_log("Error fetching assign subjects: " . $e->getMessage());
                return [];
            }
        }

        public function create($data){
            try{
                $query = "INSERT INTO {$this->assign_subjects} (section_id, subject_id) VALUES (?,?)";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    "ii",
                    $data['section_id'],
                    $data['subject_id']
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log("Error creating section subject assignment: " . $e->getMessage());
                return false;
            }
        }

        public function checkDuplicate($section_id, $subject_id){
            try{
                $query = "SELECT id FROM {$this->assign_subjects} WHERE section_id = ? AND subject_id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("ii", $section_id, $subject_id);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->num_rows > 0;
            }catch(Exception $e){
                error_log("Error checking duplicate: " . $e->getMessage());
                return false;
            }
        }

        public function createMultiple($section_id, $subject_ids){
            try{
                if(empty($subject_ids) || !is_array($subject_ids)){
                    return ['success' => false, 'message' => 'No subjects provided'];
                }

                $inserted = 0;
                $duplicates = 0;
                $errors = [];

                foreach($subject_ids as $subject_id){
                    // Check for duplicates
                    if($this->checkDuplicate($section_id, $subject_id)){
                        $duplicates++;
                        continue;
                    }

                    $query = "INSERT INTO {$this->assign_subjects} (section_id, subject_id) VALUES (?,?)";
                    $stmt = $this->con->prepare($query);
                    $stmt->bind_param("ii", $section_id, $subject_id);
                    
                    if($stmt->execute()){
                        $inserted++;
                    } else {
                        $errors[] = "Failed to assign subject ID: {$subject_id}";
                    }
                }

                return [
                    'success' => $inserted > 0,
                    'inserted' => $inserted,
                    'duplicates' => $duplicates,
                    'errors' => $errors
                ];
            }catch(Exception $e){
                error_log("Error creating multiple assignments: " . $e->getMessage());
                return ['success' => false, 'message' => 'Database error: ' . $e->getMessage()];
            }
        }

        public function getAssignedSubjects($section_id){
            try{
                $query = "SELECT subject_id FROM {$this->assign_subjects} WHERE section_id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $section_id);
                $stmt->execute();
                $result = $stmt->get_result();
                $assigned = [];
                while($row = $result->fetch_assoc()){
                    $assigned[] = $row['subject_id'];
                }
                return $assigned;
            }catch(Exception $e){
                error_log("Error getting assigned subjects: " . $e->getMessage());
                return [];
            }
        }

        public function update($id, $data){
            try{
                $query = "UPDATE {$this->assign_subjects} SET section_id = ? , subject_id = ? WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    "iii",
                    $data['section_id'],
                    $data['subject_id'],
                    $id
                );
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log("Error updating section subject assignment: " . $e->getMessage());
                return false;
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->assign_subjects} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                return true;
            }catch(Exception $e){
                error_log("Error deleting this record " . $e->getMessage());
                return false;
            }
        }
    }