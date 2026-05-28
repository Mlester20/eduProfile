<?php
require_once __DIR__ . '/../Model.php';

    class SectionSubjectModel extends Model{
        protected $section = 'sections';
        protected $subject = 'subjects';

        public function index(){
            try{
                $query = "SELECT 
                    ss.id,
                    s.section_name,
                    sub.subject_name AS subject_name
                    FROM section_subjects ss
                    JOIN sections s ON ss.section_id = s.id
                    JOIN subjects sub ON ss.subject_id = sub.id
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