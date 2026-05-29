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
                return $e->getMessage();
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