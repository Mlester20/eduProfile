<?php
require_once __DIR__ . '/../Model.php';

    class EnrollStudentsModel extends Model{
        protected $students = 'students';
        protected $perPage = 10;

        public function index(){
            try{
                $query = "SELECT * FROM {$this->students} ORDER BY id ASC ";
                $stmt = $this->con->prepare($query);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_all(MYSQLI_ASSOC);
            }catch(Exception $e){
                return $e->getMessage();
            }
        }

        /**
         * Get paginated students
         * @param int $page Page number (1-based)
         * @return array ['students' => [], 'total' => int, 'totalPages' => int, 'currentPage' => int]
         */
        public function getPaginated($page = 1) {
            try {
                $page = max(1, intval($page));
                $offset = ($page - 1) * $this->perPage;

                // Get total count
                $countQuery = "SELECT COUNT(*) as total FROM {$this->students}";
                $countStmt = $this->con->prepare($countQuery);
                $countStmt->execute();
                $countResult = $countStmt->get_result();
                $total = $countResult->fetch_assoc()['total'];

                // Get paginated results
                $query = "SELECT * FROM {$this->students} ORDER BY id ASC LIMIT ? OFFSET ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("ii", $this->perPage, $offset);
                $stmt->execute();
                $result = $stmt->get_result();
                $students = $result->fetch_all(MYSQLI_ASSOC);

                $totalPages = ceil($total / $this->perPage);

                return [
                    'students' => $students,
                    'total' => $total,
                    'totalPages' => $totalPages,
                    'currentPage' => $page,
                    'perPage' => $this->perPage
                ];
            } catch (Exception $e) {
                return ['error' => $e->getMessage()];
            }
        }   

        public function create($data){
            try{
                $query = "
                    INSERT INTO {$this->students}
                    (lrn, first_name, middle_name, last_name,suffix, gender, birth_date, age, place_of_birth, nationality, religion, address, contact_number, email, profile_photo, enrollment_status)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
                ";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    "sssssssissssssss",
                    $data['lrn'],
                    $data['first_name'],
                    $data['middle_name'],
                    $data['last_name'],
                    $data['suffix'],
                    $data['gender'],
                    $data['birth_date'],
                    $data['age'],
                    $data['place_of_birth'],
                    $data['nationality'],
                    $data['religion'],
                    $data['address'],
                    $data['contact_number'],
                    $data['email'],
                    $data['profile_photo'],
                    $data['enrollment_status']
                );
                return $stmt->execute();

            }catch(Exception $e){
                return $e->getMessage();
            }
        }

        public function update($id, $data){
            try{
                $query = "
                    UPDATE {$this->students}
                    SET lrn = ?, first_name = ?, middle_name = ?, last_name = ?, suffix = ?, gender = ?, 
                        birth_date = ?, age = ?, place_of_birth = ?, nationality = ?, religion = ?, 
                        address = ?, contact_number = ?, email = ?, profile_photo = ?, enrollment_status = ?
                    WHERE id = ?
                ";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param(
                    "sssssssissssssssi",
                    $data['lrn'],
                    $data['first_name'],
                    $data['middle_name'],
                    $data['last_name'],
                    $data['suffix'],
                    $data['gender'],
                    $data['birth_date'],
                    $data['age'],
                    $data['place_of_birth'],
                    $data['nationality'],
                    $data['religion'],
                    $data['address'],
                    $data['contact_number'],
                    $data['email'],
                    $data['profile_photo'],
                    $data['enrollment_status'],
                    $id
                );
                return $stmt->execute();
                
            }catch(Exception $e){
                return $e->getMessage();
            }
        }

        public function getById($id){
            try{
                $query = "SELECT * FROM {$this->students} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();
                return $result->fetch_assoc();
            }catch(Exception $e){
                return null;
            }
        }

        public function delete($id){
            try{
                $query = "DELETE FROM {$this->students} WHERE id = ?";
                $stmt = $this->con->prepare($query);
                $stmt->bind_param("i", $id);
                return $stmt->execute();
            }catch(Exception $e){
                return $e->getMessage();
            }
        }
    }

?>