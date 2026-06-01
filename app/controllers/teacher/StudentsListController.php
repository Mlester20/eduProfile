<?php
require_once __DIR__ . '/../../models/teacher/StudentsListModel.php';
require_once __DIR__ . '/../../../database/config/config.php';
require_once __DIR__ . '/../../../app/services/StudentsService.php';

    class StudentsListController{
        private $model;
        protected $studentsService;
        protected $itemsPerPage = 10;

        public function __construct($con){
            $this->model = new StudentsListModel($con);
            $this->studentsService = new StudentsService($con);
        }

        public function index(){
            $teacher_id = $_SESSION['id'];
            $students = $this->model->getStudentsByTeacher($teacher_id);
            
            // Add full names using the service
            if (!empty($students)) {
                $students = $this->studentsService->addFullNames($students);
            }
            
            return $students;
        }

      

        public function getPaginatedStudents(){
            $teacher_id = $_SESSION['id'];
            
            // Get current page from query string, default to 1
            $currentPage = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            
            // Get total count
            $totalStudents = $this->model->getStudentsCountByTeacher($teacher_id);
            $totalPages = ceil($totalStudents / $this->itemsPerPage);
            
            // Ensure page doesn't exceed total pages
            if ($totalPages > 0) {
                $currentPage = min($currentPage, $totalPages);
            } else {
                $currentPage = 1;
            }
            
            // Get paginated students
            $students = $this->model->getStudentsByTeacherPaginated($teacher_id, $currentPage, $this->itemsPerPage);
            
            // Add full names using the service
            if (!empty($students)) {
                $students = $this->studentsService->addFullNames($students);
            }
            
            return [
                'students' => $students,
                'currentPage' => $currentPage,
                'totalPages' => $totalPages,
                'total' => $totalStudents,
                'perPage' => $this->itemsPerPage
            ];
        }

        /**
         * Get student details with guardian information
         * @param int $student_id The student ID to fetch details for
         * @return array Student details with guardian info
         */
        public function getStudentWithGuardian($student_id){
            try {
                // Fetch student details
                $studentDetails = $this->studentsService->getStudentDetailsById($student_id);
                
                if (!$studentDetails) {
                    return [
                        'success' => false,
                        'message' => 'Student not found',
                        'student' => null,
                        'guardian' => null
                    ];
                }

                // Add full name to student details
                $studentDetails['full_name'] = $this->studentsService->getFullName(
                    $studentDetails['first_name'] ?? '',
                    $studentDetails['middle_name'] ?? '',
                    $studentDetails['last_name'] ?? '',
                    $studentDetails['suffix'] ?? ''
                );

                // Fetch guardian information
                $guardianInfo = $this->studentsService->getGuardianInfoByStudentId($student_id);

                return [
                    'success' => true,
                    'student' => $studentDetails,
                    'guardian' => $guardianInfo
                ];
            } catch (Exception $e) {
                error_log("Error fetching student with guardian: " . $e->getMessage());
                return [
                    'success' => false,
                    'message' => 'Error fetching student information',
                    'student' => null,
                    'guardian' => null
                ];
            }
        }
    }

    try{
        $controller = new StudentsListController($con);
        $students = $controller->index();
        $paginatedData = $controller->getPaginatedStudents();
    }catch(Exception $e){
        error_log("Error in StudentsListController: " . $e->getMessage());
        $students = [];
    }