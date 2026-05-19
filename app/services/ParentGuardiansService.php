<?php
require_once __DIR__ . '/../models/Model.php';

    class ParentGuardianService extends Model{
        public function searchParentsGuardians($keyword)
        {
            // Sanitize and trim the keyword
            $keyword = trim($keyword);

            // Return empty array if keyword is empty or less than 2 characters
            if (empty($keyword) || strlen($keyword) < 2) {
                return [];
            }

            // Prepare the keyword for LIKE search
            $searchKeyword = '%' . $keyword . '%';

            // SQL query with LEFT JOIN
            $sql = "SELECT 
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
                        pg.monthly_income,
                        s.id AS student_id_from_table,
                        s.lrn,
                        s.first_name,
                        s.middle_name,
                        s.last_name,
                        s.suffix
                    FROM parents_guardians pg
                    LEFT JOIN students s ON pg.student_id = s.id
                    WHERE 
                        pg.father_name LIKE ? OR
                        pg.mother_name LIKE ? OR
                        pg.guardian_name LIKE ? OR
                        s.first_name LIKE ? OR
                        s.last_name LIKE ? OR
                        s.lrn LIKE ?
                    ORDER BY s.first_name ASC, s.last_name ASC";

            $stmt = null;
            $results = [];

            try {
                // Prepare the statement
                $stmt = $this->con->prepare($sql);

                if (!$stmt) {
                    return [];
                }

                // Bind parameters (6 parameters, all with the same search keyword)
                $stmt->bind_param('ssssss', $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword, $searchKeyword);

                // Execute the statement
                $stmt->execute();

                // Get the result
                $result = $stmt->get_result();

                // Fetch all results as associative array
                $results = $result->fetch_all(MYSQLI_ASSOC);
            } catch (Exception $e) {
                // Log or handle the exception if needed
                return [];
            } finally {
                // Close the statement
                if ($stmt) {
                    $stmt->close();
                }
            }

            return $results;
        }
    }