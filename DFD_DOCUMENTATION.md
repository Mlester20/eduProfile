# EduProfile: Student Profiling System

## Data Flow Diagram (DFD) Documentation

---

# Project Overview

**EduProfile** is an innovative student profiling and records management system designed for San Jose Sur Elementary School.

The system manages:

* Student information
* Academic records
* Attendance
* Health records
* Student documents
* User management
* Reports and analytics

---

# System Users

| Role      | Responsibilities                        |
| --------- | --------------------------------------- |
| Admin     | Manages users and system settings       |
| Registrar | Handles student enrollment and records  |
| Teacher   | Manages attendance and academic records |
| Principal | Reviews reports and analytics           |

---

# DFD Level 0 — Context Diagram

```text
+------------------+
|      ADMIN       |
+------------------+
          |
          |
          v
+--------------------------------------+
|          EDUPROFILE SYSTEM           |
|  Student Profiling Management System |
+--------------------------------------+
 ^          ^            ^           ^
 |          |            |           |
 |          |            |           |
 |          |            |           |
Registrar   Teacher    Principal   Students/Parents
```

---

# DFD Level 1 — Main System Processes

```text
+----------------+
|     ADMIN      |
+----------------+
        |
        v
+------------------------+
| User Management Module |
+------------------------+
        |
        v
+----------------+
|     USERS      |
|    DATABASE    |
+----------------+



+----------------+
|   REGISTRAR    |
+----------------+
        |
        v
+---------------------------+
| Student Enrollment Module |
+---------------------------+
        |
        v
+------------------+
| STUDENTS TABLE   |
+------------------+
        |
        +--------------------+
        |                    |
        v                    v
+----------------+    +----------------------+
| PARENTS TABLE  |    | HEALTH RECORDS TABLE |
+----------------+    +----------------------+



+----------------+
|    TEACHER     |
+----------------+
        |
        v
+---------------------------+
| Academic Records Module   |
+---------------------------+
        |
        v
+------------------------------+
| STUDENT_ACADEMIC_RECORDS     |
+------------------------------+
        |
        +-------------------+
        |                   |
        v                   v
+---------------+   +----------------+
| GRADE LEVELS  |   |   SECTIONS     |
+---------------+   +----------------+



+----------------+
|    TEACHER     |
+----------------+
        |
        v
+------------------------+
| Attendance Management  |
+------------------------+
        |
        v
+----------------+
| ATTENDANCE     |
+----------------+



+----------------+
|   PRINCIPAL    |
+----------------+
        |
        v
+----------------------+
| Reports & Analytics  |
+----------------------+
        |
        v
+----------------------+
| Generated Reports    |
+----------------------+
```

---

# DFD Level 2 — Student Enrollment Module

```text
REGISTRAR
    |
    v
+----------------------+
| Encode Student Info  |
+----------------------+
    |
    v
+----------------------+
| Validate Information |
+----------------------+
    |
    v
+----------------------+
| Save Student Profile |
+----------------------+
    |
    +-------------------+
    |                   |
    v                   v
STUDENTS          PARENTS_GUARDIANS
TABLE             TABLE
    |
    v
HEALTH_RECORDS
TABLE
```

---

# DFD Level 2 — Academic Records Module

```text
TEACHER / REGISTRAR
        |
        v
+----------------------+
| Encode Grades        |
+----------------------+
        |
        v
+----------------------+
| Validate Grade Data  |
+----------------------+
        |
        v
+----------------------+
| Save Academic Record |
+----------------------+
        |
        v
STUDENT_ACADEMIC_RECORDS
TABLE
        |
        +----------------+
        |                |
        v                v
GRADE_LEVELS         SECTIONS
```

---

# DFD Level 2 — Attendance Module

```text
TEACHER
    |
    v
+----------------------+
| Record Attendance    |
+----------------------+
    |
    v
+----------------------+
| Validate Attendance  |
+----------------------+
    |
    v
+----------------------+
| Save Attendance Data |
+----------------------+
    |
    v
ATTENDANCE TABLE
```

---

# DFD Level 2 — Document Management Module

```text
REGISTRAR
    |
    v
+----------------------+
| Upload Documents     |
+----------------------+
    |
    v
+----------------------+
| Validate File        |
+----------------------+
    |
    v
+----------------------+
| Store File           |
+----------------------+
    |
    +----------------------+
    |                      |
    v                      v
STUDENT_DOCUMENTS      FILE STORAGE
TABLE                  DIRECTORY
```

---

# Database Tables

## users

Stores system user accounts.

| Field     | Description        |
| --------- | ------------------ |
| user_id   | Primary Key        |
| full_name | Full name          |
| username  | Login username     |
| password  | Encrypted password |
| role      | User role          |

---

## students

Stores student profile information.

| Field             | Description              |
| ----------------- | ------------------------ |
| student_id        | Primary Key              |
| lrn               | Learner Reference Number |
| first_name        | Student first name       |
| last_name         | Student last name        |
| gender            | Gender                   |
| birth_date        | Birth date               |
| address           | Home address             |
| enrollment_status | Student status           |

---

## parents_guardians

Stores parent and guardian information.

| Field          | Description    |
| -------------- | -------------- |
| guardian_id    | Primary Key    |
| student_id     | Foreign Key    |
| father_name    | Father's name  |
| mother_name    | Mother's name  |
| guardian_name  | Guardian name  |
| contact_number | Contact number |

---

## student_health_records

Stores student health information.

| Field              | Description        |
| ------------------ | ------------------ |
| health_id          | Primary Key        |
| student_id         | Foreign Key        |
| blood_type         | Blood type         |
| allergies          | Allergies          |
| medical_conditions | Medical conditions |

---

## student_academic_records

Stores academic information.

| Field           | Description                 |
| --------------- | --------------------------- |
| record_id       | Primary Key                 |
| student_id      | Foreign Key                 |
| school_year     | School year                 |
| grade_level     | Grade level                 |
| section         | Section                     |
| general_average | Final average               |
| remarks         | Academic remarks            |
| recorded_by     | User who created the record |

---

## attendance

Stores attendance records.

| Field           | Description         |
| --------------- | ------------------- |
| attendance_id   | Primary Key         |
| student_id      | Foreign Key         |
| attendance_date | Attendance date     |
| status          | Present/Absent/Late |

---

## student_documents

Stores uploaded student documents.

| Field         | Description        |
| ------------- | ------------------ |
| document_id   | Primary Key        |
| student_id    | Foreign Key        |
| document_type | Type of document   |
| file_path     | Uploaded file path |

---

# System Flow Summary

1. Registrar enrolls students.
2. Student profile is saved.
3. Parent and health records are encoded.
4. Teachers manage attendance and academic records.
5. Documents are uploaded and stored.
6. Principal and Admin generate reports.

---

#Development Stack

| Component | Technology  |
| --------- | ----------- |
| Backend   | PHP OOP MVC |
| Frontend  | Bootstrap 5 |
| Database  | MySQL       |
| Charts    | Chart.js    |
| Tables    | DataTables  |
| Alerts    | SweetAlert2 |

---

# Folder Structure

```text
app/
│
├── controllers/
├── models/
├── views/
├── middleware/
├── services/
├── helpers/
│
public/
│
storage/
│   ├── documents/
│   └── profile_photos/
│
database/
│
routes/
```

---

# Notes During Development

* Use MVC architecture.
* Use prepared statements.
* Store passwords using password_hash().
* Validate uploaded files.
* Use role-based authentication.
* Avoid storing duplicate information.
* Use foreign keys for relationships.
* Use timestamps for audit tracking.

---

# Future Enhancements

* Parent portal
* SMS notifications
* PDF report generation
* Student analytics dashboard
* RFID attendance
* Email notifications
* Archive system
* Backup and restore    
