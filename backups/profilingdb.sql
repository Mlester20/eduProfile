-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 19, 2026 at 06:44 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `profilingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `audit_logs`
--

CREATE TABLE `audit_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `module` varchar(100) NOT NULL,
  `reference_id` int(10) UNSIGNED DEFAULT NULL,
  `reference_table` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('success','failed') NOT NULL DEFAULT 'success',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `audit_logs`
--

INSERT INTO `audit_logs` (`id`, `user_id`, `role`, `action`, `module`, `reference_id`, `reference_table`, `description`, `ip_address`, `status`, `created_at`) VALUES
(29, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 07:07:17'),
(30, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 11:39:18'),
(31, 4, 'admin', 'CREATE SCHOOL YEAR', 'SCHOOL_YEAR', NULL, 'school_years', 'admin created a new school year record', '::1', 'success', '2026-05-15 11:42:14'),
(33, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 11:48:57'),
(34, 4, 'admin', 'DELETE SCHOOL YEAR', 'SCHOOL_YEAR', 10, 'school_years', 'admin deleted a school year record', '::1', 'success', '2026-05-15 11:49:56'),
(35, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 12:39:38'),
(36, 4, 'admin', 'DELETE USER', 'USERS', 11, 'users', 'admin deleted a user record with ID: 11', '::1', 'success', '2026-05-15 12:40:59'),
(37, 4, 'admin', 'DELETE USER', 'USERS', 12, 'users', 'admin deleted a user record with ID: 12', '::1', 'success', '2026-05-15 12:45:12'),
(38, 4, 'admin', 'UPDATE USER', 'USERS', 5, 'users', 'admin updated a user record with ID: 5', '::1', 'success', '2026-05-15 12:57:41'),
(39, 4, 'admin', 'UPDATE USER', 'USERS', 5, 'users', 'admin updated a user record with ID: 5', '::1', 'success', '2026-05-15 12:57:50'),
(40, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 12:58:11'),
(41, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 13:04:11'),
(42, 4, 'admin', 'CREATE USER', 'USERS', NULL, 'users', 'admin created a new user with email: registrar@gmail.com', '::1', 'success', '2026-05-15 13:04:43'),
(43, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-15 13:07:07'),
(44, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 1 logged in', '::1', 'success', '2026-05-15 13:11:14'),
(45, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 1 logged in', '::1', 'success', '2026-05-15 13:12:45'),
(46, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 1 logged in', '::1', 'success', '2026-05-15 13:13:45'),
(47, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 1 logged in', '::1', 'success', '2026-05-15 13:24:52'),
(48, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-15 13:41:13'),
(49, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-15 13:42:48'),
(50, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-16 13:55:34'),
(51, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-17 04:56:28'),
(52, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-17 04:56:41'),
(53, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-18 04:21:48'),
(54, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-18 04:22:52'),
(55, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 14:20:17'),
(56, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 14:40:38'),
(57, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 16:04:56'),
(58, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 16:09:37'),
(59, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 16:21:35');

-- --------------------------------------------------------

--
-- Table structure for table `parents_guardians`
--

CREATE TABLE `parents_guardians` (
  `id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `father_name` varchar(150) DEFAULT NULL,
  `father_occupation` varchar(100) DEFAULT NULL,
  `father_contact` varchar(20) DEFAULT NULL,
  `mother_name` varchar(150) DEFAULT NULL,
  `mother_occupation` varchar(100) DEFAULT NULL,
  `mother_contact` varchar(20) DEFAULT NULL,
  `guardian_name` varchar(150) DEFAULT NULL,
  `guardian_relationship` varchar(50) DEFAULT NULL,
  `guardian_contact` varchar(20) DEFAULT NULL,
  `monthly_income` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parents_guardians`
--

INSERT INTO `parents_guardians` (`id`, `student_id`, `father_name`, `father_occupation`, `father_contact`, `mother_name`, `mother_occupation`, `mother_contact`, `guardian_name`, `guardian_relationship`, `guardian_contact`, `monthly_income`) VALUES
(4, 2, 'Armando Raguindin Sr.', 'Tricycle Driver', '09360991034', 'Melba Raguindin', 'Baby Sitter', '09685340012', 'Melba Raguindin', 'Mother', '09213001234', 3500.00),
(5, 4, 'Juan Dela-Cruz', 'Engineer', '', 'Maria Dela-Cruz', 'Baby Sitter', '', 'Juan Dela-Cruz', 'Father', '09213001234', 0.00);

-- --------------------------------------------------------

--
-- Table structure for table `school_year`
--

CREATE TABLE `school_year` (
  `id` int(11) NOT NULL,
  `school_year` varchar(20) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` enum('active','inactive','archived') DEFAULT 'inactive',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `school_year`
--

INSERT INTO `school_year` (`id`, `school_year`, `start_date`, `end_date`, `status`, `created_at`, `updated_at`) VALUES
(8, '2026-2027', '2026-06-08', '2027-04-05', 'active', '2026-05-15 05:40:37', '2026-05-15 05:57:44');

-- --------------------------------------------------------

--
-- Table structure for table `sections`
--

CREATE TABLE `sections` (
  `id` int(11) NOT NULL,
  `section_name` varchar(100) NOT NULL,
  `grade_level` varchar(50) DEFAULT NULL,
  `adviser_id` int(11) DEFAULT NULL,
  `school_year_id` int(11) DEFAULT NULL,
  `max_students` int(11) NOT NULL DEFAULT 35,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_subjects`
--

CREATE TABLE `section_subjects` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `lrn` varchar(20) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `suffix` varchar(20) DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `place_of_birth` varchar(150) DEFAULT NULL,
  `nationality` varchar(100) DEFAULT NULL,
  `religion` varchar(100) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `contact_number` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `profile_photo` varchar(255) DEFAULT NULL,
  `enrollment_status` enum('Enrolled','Inactive','Transferred','Graduated') DEFAULT 'Enrolled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `lrn`, `first_name`, `middle_name`, `last_name`, `suffix`, `gender`, `birth_date`, `age`, `place_of_birth`, `nationality`, `religion`, `address`, `contact_number`, `email`, `profile_photo`, `enrollment_status`, `created_at`) VALUES
(2, '20242111365', 'Mark Lester ', 'Suguitan', 'Raguindin', '', 'Male', '2002-12-20', 9, 'Ilagan City, Isabela', 'Filipino', 'Roman Catholic', 'Rizal, Roxas, Isabela', '09349991034', '', 'Array', 'Enrolled', '2026-05-11 13:07:26'),
(3, '2026000001', 'Mark', 'Santos', 'Reyes', NULL, 'Male', '2012-05-14', 14, 'Ilagan City, Isabela', 'Filipino', 'Roman Catholic', 'Luna, Isabela', '09171234567', 'mark.reyes@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(4, '2026000002', 'Angela', 'Lopez', 'Cruz', NULL, 'Female', '2011-09-22', 15, 'Tuguegarao City, Cagayan', 'Filipino', 'Roman Catholic', 'Tumauini, Isabela', '09181234567', 'angela.cruz@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(5, '2026000003', 'Joshua', 'Rivera', 'Fernandez', NULL, 'Male', '2013-01-10', 13, 'Santiago City, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Cabagan, Isabela', '09191234567', 'joshua.fernandez@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(6, '2026000004', 'Sophia', 'Garcia', 'Mendoza', NULL, 'Female', '2012-07-18', 14, 'Cauayan City, Isabela', 'Filipino', 'Roman Catholic', 'Luna, Isabela', '09201234567', 'sophia.mendoza@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(7, '2026000005', 'Daniel', 'Torres', 'Villanueva', 'Jr.', 'Male', '2011-11-30', 15, 'Aparri, Cagayan', 'Filipino', 'Born Again Christian', 'Roxas, Isabela', '09211234567', 'daniel.v@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(8, '2026000006', 'Kimberly', 'Aquino', 'Santiago', NULL, 'Female', '2013-03-25', 13, 'Ilagan City, Isabela', 'Filipino', 'Roman Catholic', 'San Mateo, Isabela', '09221234567', 'kimberly.santiago@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(9, '2026000007', 'Nathan', 'Perez', 'Domingo', NULL, 'Male', '2012-12-05', 14, 'Echague, Isabela', 'Filipino', 'Roman Catholic', 'Jones, Isabela', '09231234567', 'nathan.domingo@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(10, '2026000008', 'Beatrice', 'Castro', 'Flores', NULL, 'Female', '2011-08-16', 15, 'Naguilian, Isabela', 'Filipino', 'Methodist', 'Luna, Isabela', '09241234567', 'beatrice.flores@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(11, '2026000009', 'Christian', 'Ramos', 'De Leon', NULL, 'Male', '2012-02-08', 14, 'Gamu, Isabela', 'Filipino', 'Roman Catholic', 'Tumauini, Isabela', '09251234567', 'christian.deleon@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14'),
(12, '2026000010', 'Patricia', 'Navarro', 'Salvador', NULL, 'Female', '2013-06-27', 13, 'Reina Mercedes, Isabela', 'Filipino', 'Roman Catholic', 'Luna, Isabela', '09261234567', 'patricia.salvador@gmail.com', 'default.png', 'Enrolled', '2026-05-19 14:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `student_sections`
--

CREATE TABLE `student_sections` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_code` varchar(50) DEFAULT NULL,
  `grade_level` varchar(20) DEFAULT NULL,
  `subject_name` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_code`, `grade_level`, `subject_name`, `created_at`, `updated_at`) VALUES
(15, 'G2-FIL', 'Grade 2', 'Filipino 2', '2026-05-19 15:14:30', NULL),
(16, 'G2-ENG', 'Grade 2', 'English 2', '2026-05-19 15:14:30', NULL),
(17, 'G2-MATH', 'Grade 2', 'Mathematics 2', '2026-05-19 15:14:30', NULL),
(18, 'G2-SCI', 'Grade 2', 'Science 2', '2026-05-19 15:14:30', NULL),
(19, 'G2-MTB', 'Grade 2', 'Mother Tongue 2', '2026-05-19 15:14:30', NULL),
(20, 'G2-ESP', 'Grade 2', 'Edukasyon sa Pagpapakatao 2', '2026-05-19 15:14:30', NULL),
(21, 'G2-MAPEH', 'Grade 2', 'MAPEH 2', '2026-05-19 15:14:30', NULL),
(22, 'G2-AP', 'Grade 2', 'Araling Panlipunan 2', '2026-05-19 15:20:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `updated_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `email`, `password`, `role`, `profile_picture`, `created_at`, `updated_at`) VALUES
(3, 'Administrative', 'administrative@gmail.com', '$2y$10$CQASCJeXsOYOvWm4kK03i.S1SxUWsdPMv56Qlz04eq0GazfxE8FSi', 'administrative', 'storage/profiles/pfp_3_1778323470.jpg', '2026-05-09', '2026-05-09'),
(4, 'admin', 'admin@gmail.com', '$2y$10$ihbCVd8WOJO17B4BFQgAUORhb1UEYpIFmpd1Q/ShW6n5uNMkLZ7kq', 'admin', '8.jpg', '2026-05-09', '2026-05-09'),
(5, 'teacher 1', 'teacher@gmail.com', '$2y$10$JIgDIhgM0PF2mpHSeNWEk.EwMUrAhweKqBinP9shLxyInzdhrbwbe', 'teacher', NULL, '2026-05-10', '2026-05-10'),
(13, 'Registrar', 'registrar@gmail.com', '$2y$10$IEz8YAjPkN2ddoQTR6YRUupEwnweJ6YNzsl8opZsKoXrMMFkaJYZG', 'registrar', NULL, '2026-05-15', '0000-00-00'),
(14, 'teacher 2', 'teacher1@gmail.com', '$2y$10$1LxuNhIoGyP5pgS2rnMGheE2vsCuzAQqAqSHqqSkTl6DHBeXaH.pm', 'teacher', NULL, '2026-05-19', '2026-05-19'),
(15, 'teacher 3', 'teacher3@gmail.com', '$2y$10$MH6VDut/tBSlLmu23a55geQaSo08Yplt7XPdXEg2yFKU38qfc4Mdu', 'teacher', NULL, '2026-05-19', '2026-05-19'),
(16, 'teacher 4', 'teacher4@gmail.com', '$2y$10$1kGUkbDy5q4l9wL.g6YlW.RdTV2sgmoOiCNdpmezmoXzfJ9nRTCi.', 'teacher', NULL, '2026-05-19', '2026-05-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_audit_logs_user_id` (`user_id`);

--
-- Indexes for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `school_year`
--
ALTER TABLE `school_year`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `school_year` (`school_year`);

--
-- Indexes for table `sections`
--
ALTER TABLE `sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `adviser_id` (`adviser_id`),
  ADD KEY `school_year_id` (`school_year_id`);

--
-- Indexes for table `section_subjects`
--
ALTER TABLE `section_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_section_subject` (`section_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- Indexes for table `student_sections`
--
ALTER TABLE `student_sections`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `section_subjects`
--
ALTER TABLE `section_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_sections`
--
ALTER TABLE `student_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `audit_logs`
--
ALTER TABLE `audit_logs`
  ADD CONSTRAINT `fk_audit_logs_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  ADD CONSTRAINT `parents_guardians_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);

--
-- Constraints for table `sections`
--
ALTER TABLE `sections`
  ADD CONSTRAINT `sections_ibfk_1` FOREIGN KEY (`adviser_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `sections_ibfk_2` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`id`);

--
-- Constraints for table `section_subjects`
--
ALTER TABLE `section_subjects`
  ADD CONSTRAINT `section_subjects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `section_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_sections`
--
ALTER TABLE `student_sections`
  ADD CONSTRAINT `student_sections_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_sections_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
