<?php
require_once __DIR__ . '/../Model.php';

    class SectionSubjectModel extends Model{
        protected $section = 'sections';
        protected $subject = 'subjects';

        public function index(){
            try{
                $query = "SELECT 
                    ss.id,
                    sy.school_year,
                    s.section_name,
                    s.grade_level,
                    sub.subject_name AS subject_name
                    FROM section_subjects ss
                    JOIN sections s ON ss.section_id = s.id
                    JOIN school_year sy ON s.school_year_id = sy.id
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

        }

        public function update($id, $data){

        }

        public function delete($id){

        }
    }