<?php
require_once __DIR__ . '/../Model.php';

class SubjectListModel extends Model {
    protected $assign_section = 'assign_section_subjects'; // ✅ restored
    protected $subject        = 'subjects';
    protected $section        = 'sections';
    protected $school_year    = 'school_year';

    /**
     * Fetch all subjects assigned to the sections handled by the logged-in teacher
     * @param int $teacher_id $_SESSION['id']
     * @return array
     */
    public function getSubjectsByTeacher($teacher_id) {
        try {
            $query = "SELECT
                        ass.id         AS assign_id,
                        ass.section_id,
                        ass.subject_id,
                        sub.subject_code,
                        sub.subject_name,
                        sub.grade_level AS subject_grade_level,
                        sec.section_name,
                        sec.grade_level AS section_grade_level,
                        sy.school_year
                    FROM {$this->assign_section} ass
                    JOIN {$this->subject} sub  ON sub.id  = ass.subject_id
                    JOIN {$this->section} sec  ON sec.id  = ass.section_id
                    JOIN {$this->school_year} sy ON sy.id = sec.school_year_id
                    WHERE sec.adviser_id = ?
                      AND sy.status = 'active'
                    ORDER BY sec.section_name ASC, sub.subject_name ASC";

            $stmt = $this->con->prepare($query);
            if (!$stmt) {
                throw new Exception("Prepare failed: " . $this->con->error);
            }

            $stmt->bind_param("i", $teacher_id);
            $stmt->execute();
            $result = $stmt->get_result();

            return $result->fetch_all(MYSQLI_ASSOC);

        } catch (Exception $e) {
            error_log("Error fetching subjects by teacher: " . $e->getMessage());
            return [];
        }
    }
}