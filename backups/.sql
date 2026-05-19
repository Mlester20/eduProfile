CREATE TABLE sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    section_name VARCHAR(100) NOT NULL,
    grade_level VARCHAR(50),
    adviser_id INT NULL,
    school_year_id INT,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (adviser_id) REFERENCES users(id),
    FOREIGN KEY (school_year_id) REFERENCES school_years(id)
);

CREATE TABLE student_sections (
    id INT PRIMARY KEY AUTO_INCREMENT,
    student_id INT NOT NULL,
    section_id INT NOT NULL,

    FOREIGN KEY (student_id) REFERENCES students(id),
    FOREIGN KEY (section_id) REFERENCES sections(id)
);

-- Step 1: Add grade_level to subjects
-- (Grade 1 Filipino is different from Grade 2 Filipino)
ALTER TABLE `subjects`
  ADD COLUMN `grade_level` varchar(20) DEFAULT NULL AFTER `subject_code`;

-- Update existing subjects to Grade 1
UPDATE `subjects` SET `grade_level` = 'Grade 1';

-- Step 2: Assign subjects to sections (a section has many subjects)
CREATE TABLE `section_subjects` (
  `id`         int(11) NOT NULL AUTO_INCREMENT,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_section_subject` (`section_id`, `subject_id`),
  FOREIGN KEY (`section_id`) REFERENCES `sections`(`id`) ON DELETE CASCADE,
  FOREIGN KEY (`subject_id`) REFERENCES `subjects`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Step 3: Store student grades per subject per section per school year
CREATE TABLE `student_grades` (
  `id`               int(11) NOT NULL AUTO_INCREMENT,
  `student_id`       int(11) NOT NULL,
  `subject_id`       int(11) NOT NULL,
  `section_id`       int(11) NOT NULL,
  `school_year_id`   int(11) NOT NULL,
  `quarter_1`        decimal(5,2) DEFAULT NULL,
  `quarter_2`        decimal(5,2) DEFAULT NULL,
  `quarter_3`        decimal(5,2) DEFAULT NULL,
  `quarter_4`        decimal(5,2) DEFAULT NULL,
  `final_grade`      decimal(5,2) DEFAULT NULL,
  `remarks`          enum('Passed','Failed','Incomplete','Dropped') DEFAULT NULL,
  `created_at`       timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at`       timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_student_subject_sy` (`student_id`, `subject_id`, `school_year_id`),
  FOREIGN KEY (`student_id`)     REFERENCES `students`(`id`)     ON DELETE CASCADE,
  FOREIGN KEY (`subject_id`)     REFERENCES `subjects`(`id`)     ON DELETE CASCADE,
  FOREIGN KEY (`section_id`)     REFERENCES `sections`(`id`)     ON DELETE CASCADE,
  FOREIGN KEY (`school_year_id`) REFERENCES `school_year`(`id`)  ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------
-- Sample data: Add Grade 2 subjects
-- --------------------------------------------------------
INSERT INTO `subjects` (`subject_code`, `grade_level`, `subject_name`) VALUES
('G2-FIL',  'Grade 2', 'Filipino 2'),
('G2-ENG',  'Grade 2', 'English 2'),
('G2-MATH', 'Grade 2', 'Mathematics 2'),
('G2-SCI',  'Grade 2', 'Science 2'),
('G2-MTB',  'Grade 2', 'Mother Tongue 2'),
('G2-ESP',  'Grade 2', 'Edukasyon sa Pagpapakatao 2'),
('G2-MAPEH','Grade 2', 'MAPEH 2'),
('G2-AP',   'Grade 2', 'Araling Panlipunan 2');