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