<?php
require_once __DIR__ . '/../Model.php';
require_once __DIR__ . '/../registrar/EnrollStudentsModel.php'; //fetch index of students to get student data for guardian model

    class StudentGuardianModel extends Model{
        protected $parents_guardians = 'parents_guardians';
        protected $students = 'students';

        public function index(){
            try{
                $query = "
                        SELECT pg.*, s.first_name AS student_first_name, s.last_name AS student_last_name FROM {$this->parents_guardians} pg JOIN {$this->students} s ON pg.student_id = s.id ORDER BY pg.id ASC
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

            }catch(Exception $e){
                return $e->getMessage();
            }
        }
    }
?>