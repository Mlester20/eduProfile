<?php

class Students {
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
}

?>