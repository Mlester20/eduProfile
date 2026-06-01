-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 06:17 PM
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
-- Table structure for table `academic_history`
--

CREATE TABLE `academic_history` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `grade_level` varchar(50) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `enrollment_status` enum('Enrolled','Transferred','Graduated','Inactive') DEFAULT 'Enrolled',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_section_subjects`
--

CREATE TABLE `assign_section_subjects` (
  `id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_section_subjects`
--

INSERT INTO `assign_section_subjects` (`id`, `section_id`, `subject_id`, `created_at`) VALUES
(1, 11, 15, '2026-06-01 13:23:56'),
(2, 11, 16, '2026-06-01 13:23:56'),
(3, 11, 17, '2026-06-01 13:23:56'),
(4, 11, 18, '2026-06-01 13:23:56'),
(5, 11, 19, '2026-06-01 13:23:56'),
(6, 11, 20, '2026-06-01 13:23:56'),
(7, 11, 21, '2026-06-01 13:23:56'),
(8, 11, 22, '2026-06-01 13:23:56');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` enum('Present','Absent','Late','Excused') NOT NULL DEFAULT 'Present',
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(59, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-19 16:21:35'),
(60, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-21 06:06:04'),
(61, 14, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 2 logged in', '::1', 'success', '2026-05-21 06:38:42'),
(62, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 1 logged in', '::1', 'success', '2026-05-21 06:42:38'),
(63, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-21 06:44:57'),
(64, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-21 06:46:58'),
(65, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-22 01:30:44'),
(66, 15, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'teacher 3 logged in', '::1', 'success', '2026-05-22 02:25:53'),
(67, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-22 02:26:49'),
(68, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-22 02:28:28'),
(69, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-22 13:05:50'),
(70, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-22 13:20:36'),
(71, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-24 05:20:51'),
(72, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-24 05:33:58'),
(73, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-24 05:49:26'),
(74, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-24 14:22:46'),
(75, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-24 14:47:39'),
(76, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-24 14:52:59'),
(77, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-24 14:53:09'),
(78, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-25 05:51:15'),
(79, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-25 07:57:04'),
(80, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-26 14:42:07'),
(81, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 04:42:58'),
(82, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 05:00:26'),
(83, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-28 05:48:18'),
(84, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-28 05:48:57'),
(85, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 13:31:58'),
(86, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 14:28:14'),
(87, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 14:40:40'),
(88, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-28 14:48:32'),
(89, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 14:58:30'),
(90, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-28 15:10:06'),
(91, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-28 15:30:53'),
(92, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-28 15:31:27'),
(93, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 01:24:04'),
(94, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 03:02:33'),
(95, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 11:58:35'),
(96, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 13:11:29'),
(97, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 14:11:34'),
(98, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-29 14:33:08'),
(99, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-29 15:33:49'),
(100, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 12:31:02'),
(101, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-30 12:32:23'),
(102, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 12:33:00'),
(103, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-30 13:24:24'),
(104, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-30 13:26:07'),
(105, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-30 13:28:27'),
(106, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-30 13:53:57'),
(107, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 13:55:05'),
(108, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 14:03:58'),
(109, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-30 14:04:56'),
(110, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-30 14:05:34'),
(111, 4, 'admin', 'LOGIN', 'AUTH', NULL, NULL, 'admin logged in', '::1', 'success', '2026-05-30 14:05:57'),
(112, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 14:09:59'),
(113, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 14:10:51'),
(114, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 14:12:17'),
(115, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-30 14:12:40'),
(116, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-05-30 14:17:21'),
(117, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-05-31 13:00:28'),
(118, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-06-01 12:51:38'),
(119, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-06-01 13:25:25'),
(120, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-06-01 15:30:22'),
(121, 5, 'teacher', 'LOGIN', 'AUTH', NULL, NULL, 'Jennifer J. Upton logged in', '::1', 'success', '2026-06-01 16:11:00');

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

--
-- Dumping data for table `sections`
--

INSERT INTO `sections` (`id`, `section_name`, `grade_level`, `adviser_id`, `school_year_id`, `max_students`, `created_at`) VALUES
(11, 'Pine', 'Grade 1', 5, 8, 35, '2026-06-01 13:11:00');

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
  `grade_level` varchar(50) NOT NULL,
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

INSERT INTO `students` (`id`, `lrn`, `first_name`, `middle_name`, `last_name`, `suffix`, `grade_level`, `gender`, `birth_date`, `age`, `place_of_birth`, `nationality`, `religion`, `address`, `contact_number`, `email`, `profile_photo`, `enrollment_status`, `created_at`) VALUES
(25, '2026100025', 'Juan', 'Cruz', 'Santos', NULL, 'Grade 1', 'Male', '2019-03-12', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Alimannao, Roxas, Isabela', '09171234501', NULL, NULL, 'Enrolled', '2026-06-01 00:00:00'),
(26, '2026100026', 'Maria', 'Reyes', 'Garcia', NULL, 'Grade 1', 'Female', '2019-05-20', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Baguinay, Roxas, Isabela', '09181234502', NULL, NULL, 'Enrolled', '2026-06-01 00:01:00'),
(27, '2026100027', 'Jose', 'Lim', 'Torres', NULL, 'Grade 1', 'Male', '2019-07-08', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Casibarag, Roxas, Isabela', '09191234503', NULL, NULL, 'Enrolled', '2026-06-01 00:02:00'),
(28, '2026100028', 'Ana', 'Dela Cruz', 'Villanueva', NULL, 'Grade 1', 'Female', '2019-01-15', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 4, Brgy. Dammang, Roxas, Isabela', '09201234504', NULL, NULL, 'Enrolled', '2026-06-01 00:03:00'),
(29, '2026100029', 'Carlo', 'Bautista', 'Mendoza', NULL, 'Grade 1', 'Male', '2019-09-22', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Ecreta, Roxas, Isabela', '09211234505', NULL, NULL, 'Enrolled', '2026-06-01 00:04:00'),
(30, '2026100030', 'Liza', 'Fernandez', 'Ramos', NULL, 'Grade 1', 'Female', '2019-11-30', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Fuyo, Roxas, Isabela', '09221234506', NULL, NULL, 'Enrolled', '2026-06-01 00:05:00'),
(31, '2026100031', 'Marco', 'Navarro', 'Lopez', NULL, 'Grade 1', 'Male', '2019-04-17', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Gaddang, Roxas, Isabela', '09231234507', NULL, NULL, 'Enrolled', '2026-06-01 00:06:00'),
(32, '2026100032', 'Sofia', 'Aquino', 'Castillo', NULL, 'Grade 1', 'Female', '2019-06-03', 7, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 3, Brgy. Hugot, Roxas, Isabela', '09241234508', NULL, NULL, 'Enrolled', '2026-06-01 00:07:00'),
(33, '2026100033', 'Angelo', 'Pascual', 'Rivera', NULL, 'Grade 1', 'Male', '2019-08-25', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Ipil, Roxas, Isabela', '09251234509', NULL, NULL, 'Enrolled', '2026-06-01 00:08:00'),
(34, '2026100034', 'Jasmine', 'Macaraeg', 'Domingo', NULL, 'Grade 1', 'Female', '2019-02-14', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Jower, Roxas, Isabela', '09261234510', NULL, NULL, 'Enrolled', '2026-06-01 00:09:00'),
(35, '2026100035', 'Renz', 'Soriano', 'Dela Peña', NULL, 'Grade 1', 'Male', '2019-10-11', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Kalinga, Roxas, Isabela', '09271234511', NULL, NULL, 'Enrolled', '2026-06-01 00:10:00'),
(36, '2026100036', 'Katrina', 'Manalo', 'Bernardo', NULL, 'Grade 1', 'Female', '2019-03-28', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 2, Brgy. Lanna, Roxas, Isabela', '09281234512', NULL, NULL, 'Enrolled', '2026-06-01 00:11:00'),
(37, '2026100037', 'Kristoffer', 'Dimaculangan', 'Aguilar', NULL, 'Grade 1', 'Male', '2019-05-05', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Magsaysay, Roxas, Isabela', '09291234513', NULL, NULL, 'Enrolled', '2026-06-01 00:12:00'),
(38, '2026100038', 'Daniela', 'Reyes', 'Ocampo', NULL, 'Grade 1', 'Female', '2019-07-19', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Naguilian, Roxas, Isabela', '09301234514', NULL, NULL, 'Enrolled', '2026-06-01 00:13:00'),
(39, '2026100039', 'Eduardo', 'Tolentino', 'Flores', NULL, 'Grade 1', 'Male', '2019-12-01', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Osmeña, Roxas, Isabela', '09311234515', NULL, NULL, 'Enrolled', '2026-06-01 00:14:00'),
(40, '2026100040', 'Roselyn', 'Cabrera', 'Gutierrez', NULL, 'Grade 1', 'Female', '2019-01-09', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Pag-asa, Roxas, Isabela', '09321234516', NULL, NULL, 'Enrolled', '2026-06-01 00:15:00'),
(41, '2026100041', 'Andrei', 'Hidalgo', 'Salazar', NULL, 'Grade 1', 'Male', '2019-04-23', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Quezon, Roxas, Isabela', '09331234517', NULL, NULL, 'Enrolled', '2026-06-01 00:16:00'),
(42, '2026100042', 'Lovely', 'Espino', 'Miranda', NULL, 'Grade 1', 'Female', '2019-09-16', 6, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 3, Brgy. Roxas, Roxas, Isabela', '09341234518', NULL, NULL, 'Enrolled', '2026-06-01 00:17:00'),
(43, '2026100043', 'Francis', 'Abad', 'Reyes', NULL, 'Grade 1', 'Male', '2019-06-30', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Saguday, Roxas, Isabela', '09351234519', NULL, NULL, 'Enrolled', '2026-06-01 00:18:00'),
(44, '2026100044', 'Hazel', 'Corpuz', 'Santiago', NULL, 'Grade 1', 'Female', '2019-08-07', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Tappan, Roxas, Isabela', '09361234520', NULL, NULL, 'Enrolled', '2026-06-01 00:19:00'),
(45, '2026100045', 'Reginald', 'Ilustre', 'Beltran', NULL, 'Grade 1', 'Male', '2019-02-18', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Upi, Roxas, Isabela', '09371234521', NULL, NULL, 'Enrolled', '2026-06-01 00:20:00'),
(46, '2026100046', 'Jennilyn', 'Olegario', 'Valdez', NULL, 'Grade 1', 'Female', '2019-11-12', 6, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 2, Brgy. Villaros, Roxas, Isabela', '09381234522', NULL, NULL, 'Enrolled', '2026-06-01 00:21:00'),
(47, '2026100047', 'Bernard', 'Policarpio', 'Castro', NULL, 'Grade 1', 'Male', '2019-03-04', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Warat, Roxas, Isabela', '09391234523', NULL, NULL, 'Enrolled', '2026-06-01 00:22:00'),
(48, '2026100048', 'Bianca', 'Dela Torre', 'Reyes', NULL, 'Grade 1', 'Female', '2019-07-27', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Yawan, Roxas, Isabela', '09401234524', NULL, NULL, 'Enrolled', '2026-06-01 00:23:00'),
(49, '2026100049', 'Jomar', 'Paguio', 'Dela Cruz', NULL, 'Grade 1', 'Male', '2019-10-03', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Zitanga, Roxas, Isabela', '09411234525', NULL, NULL, 'Enrolled', '2026-06-01 00:24:00'),
(50, '2026100050', 'Carmela', 'Bayani', 'Pangilinan', NULL, 'Grade 1', 'Female', '2019-01-31', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Alimannao, Roxas, Isabela', '09421234526', NULL, NULL, 'Enrolled', '2026-06-01 00:25:00'),
(51, '2026100051', 'Dexter', 'Umali', 'Lim', NULL, 'Grade 1', 'Male', '2019-05-14', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 2, Brgy. Baguinay, Roxas, Isabela', '09431234527', NULL, NULL, 'Enrolled', '2026-06-01 00:26:00'),
(52, '2026100052', 'Rowena', 'Viray', 'Enriquez', NULL, 'Grade 1', 'Female', '2019-08-18', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Casibarag, Roxas, Isabela', '09441234528', NULL, NULL, 'Enrolled', '2026-06-01 00:27:00'),
(53, '2026100053', 'Alvin', 'Gatchalian', 'Marquez', NULL, 'Grade 1', 'Male', '2019-12-22', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Dammang, Roxas, Isabela', '09451234529', NULL, NULL, 'Enrolled', '2026-06-01 00:28:00'),
(54, '2026100054', 'Princess', 'Quiambao', 'Abella', NULL, 'Grade 1', 'Female', '2019-04-06', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Ecreta, Roxas, Isabela', '09461234530', NULL, NULL, 'Enrolled', '2026-06-01 00:29:00'),
(55, '2026100055', 'Vincent', 'Rosario', 'Dela Vega', NULL, 'Grade 1', 'Male', '2019-09-09', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Fuyo, Roxas, Isabela', '09471234531', NULL, NULL, 'Enrolled', '2026-06-01 00:30:00'),
(56, '2026100056', 'Melissa', 'Tuazon', 'Nieto', NULL, 'Grade 1', 'Female', '2019-02-26', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 2, Brgy. Gaddang, Roxas, Isabela', '09481234532', NULL, NULL, 'Enrolled', '2026-06-01 00:31:00'),
(57, '2026100057', 'Nathaniel', 'Lacson', 'Evangelista', NULL, 'Grade 1', 'Male', '2019-06-15', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Hugot, Roxas, Isabela', '09491234533', NULL, NULL, 'Enrolled', '2026-06-01 00:32:00'),
(58, '2026100058', 'Clarissa', 'Ybañez', 'Dela Rosa', NULL, 'Grade 1', 'Female', '2019-10-29', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Ipil, Roxas, Isabela', '09501234534', NULL, NULL, 'Enrolled', '2026-06-01 00:33:00'),
(59, '2026100059', 'Reynaldo', 'Zaragoza', 'Samson', NULL, 'Grade 1', 'Male', '2019-03-19', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Jower, Roxas, Isabela', '09511234535', NULL, NULL, 'Enrolled', '2026-06-01 00:34:00'),
(60, '2026100060', 'Gabriel', 'Aldaba', 'Tan', NULL, 'Grade 1', 'Male', '2019-04-02', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Kalinga, Roxas, Isabela', '09521234536', NULL, NULL, 'Enrolled', '2026-06-01 00:35:00'),
(61, '2026100061', 'Patricia', 'Balagtas', 'Bello', NULL, 'Grade 1', 'Female', '2019-07-11', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Lanna, Roxas, Isabela', '09531234537', NULL, NULL, 'Enrolled', '2026-06-01 00:36:00'),
(62, '2026100062', 'Michael', 'Calaguas', 'Resurreccion', NULL, 'Grade 1', 'Male', '2019-11-24', 6, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 3, Brgy. Magsaysay, Roxas, Isabela', '09541234538', NULL, NULL, 'Enrolled', '2026-06-01 00:37:00'),
(63, '2026100063', 'Rachelle', 'Dacumos', 'Villarin', NULL, 'Grade 1', 'Female', '2019-01-27', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Naguilian, Roxas, Isabela', '09551234539', NULL, NULL, 'Enrolled', '2026-06-01 00:38:00'),
(64, '2026100064', 'Darius', 'Eraldo', 'Magno', NULL, 'Grade 1', 'Male', '2019-05-31', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Osmeña, Roxas, Isabela', '09561234540', NULL, NULL, 'Enrolled', '2026-06-01 00:39:00'),
(65, '2026100065', 'Shaina', 'Fajardo', 'Pascua', NULL, 'Grade 1', 'Female', '2019-08-13', 6, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 1, Brgy. Pag-asa, Roxas, Isabela', '09571234541', NULL, NULL, 'Enrolled', '2026-06-01 00:40:00'),
(66, '2026100066', 'Ivan', 'Gatdula', 'Dizon', NULL, 'Grade 1', 'Male', '2019-12-07', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Quezon, Roxas, Isabela', '09581234542', NULL, NULL, 'Enrolled', '2026-06-01 00:41:00'),
(67, '2026100067', 'Glenda', 'Hernandez', 'Aquino', NULL, 'Grade 1', 'Female', '2019-03-25', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Roxas, Roxas, Isabela', '09591234543', NULL, NULL, 'Enrolled', '2026-06-01 00:42:00'),
(68, '2026100068', 'Jerome', 'Ignacio', 'Chua', NULL, 'Grade 1', 'Male', '2019-06-18', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Saguday, Roxas, Isabela', '09601234544', NULL, NULL, 'Enrolled', '2026-06-01 00:43:00'),
(69, '2026100069', 'Leonora', 'Jacinto', 'Guinto', NULL, 'Grade 1', 'Female', '2019-10-05', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Tappan, Roxas, Isabela', '09611234545', NULL, NULL, 'Enrolled', '2026-06-01 00:44:00'),
(70, '2026100070', 'Kevin', 'Labrador', 'Ong', NULL, 'Grade 1', 'Male', '2019-01-20', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Upi, Roxas, Isabela', '09621234546', NULL, NULL, 'Enrolled', '2026-06-01 00:45:00'),
(71, '2026100071', 'Marian', 'Macaraeg', 'Dela Cruz', NULL, 'Grade 1', 'Female', '2019-07-03', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 2, Brgy. Villaros, Roxas, Isabela', '09631234547', NULL, NULL, 'Enrolled', '2026-06-01 00:46:00'),
(72, '2026100072', 'Norman', 'Natividad', 'Medina', NULL, 'Grade 1', 'Male', '2019-09-28', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Warat, Roxas, Isabela', '09641234548', NULL, NULL, 'Enrolled', '2026-06-01 00:47:00'),
(73, '2026100073', 'Olivia', 'Orbeta', 'Reyes', NULL, 'Grade 1', 'Female', '2019-02-10', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Yawan, Roxas, Isabela', '09651234549', NULL, NULL, 'Enrolled', '2026-06-01 00:48:00'),
(74, '2026100074', 'Patrick', 'Ponce', 'Laguardia', NULL, 'Grade 1', 'Male', '2019-05-22', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Zitanga, Roxas, Isabela', '09661234550', NULL, NULL, 'Enrolled', '2026-06-01 00:49:00'),
(75, '2026100075', 'Queenie', 'Quiroz', 'Andrada', NULL, 'Grade 1', 'Female', '2019-11-16', 6, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 1, Brgy. Alimannao, Roxas, Isabela', '09671234551', NULL, NULL, 'Enrolled', '2026-06-01 00:50:00'),
(76, '2026100076', 'Raymund', 'Ramirez', 'Abalos', NULL, 'Grade 1', 'Male', '2019-04-14', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Baguinay, Roxas, Isabela', '09681234552', NULL, NULL, 'Enrolled', '2026-06-01 00:51:00'),
(77, '2026100077', 'Shiela', 'Silverio', 'Bautista', NULL, 'Grade 1', 'Female', '2019-08-27', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Casibarag, Roxas, Isabela', '09691234553', NULL, NULL, 'Enrolled', '2026-06-01 00:52:00'),
(78, '2026100078', 'Teodoro', 'Tenorio', 'Valenzuela', NULL, 'Grade 1', 'Male', '2019-12-19', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Dammang, Roxas, Isabela', '09701234554', NULL, NULL, 'Enrolled', '2026-06-01 00:53:00'),
(79, '2026100079', 'Ulrica', 'Umali', 'Canete', NULL, 'Grade 1', 'Female', '2019-03-08', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 5, Brgy. Ecreta, Roxas, Isabela', '09711234555', NULL, NULL, 'Enrolled', '2026-06-01 00:54:00'),
(80, '2026100080', 'Vladimir', 'Vergara', 'Espiritu', NULL, 'Grade 1', 'Male', '2019-07-24', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Fuyo, Roxas, Isabela', '09721234556', NULL, NULL, 'Enrolled', '2026-06-01 00:55:00'),
(81, '2026100081', 'Wendy', 'Wenceslao', 'Florendo', NULL, 'Grade 1', 'Female', '2019-10-17', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Gaddang, Roxas, Isabela', '09731234557', NULL, NULL, 'Enrolled', '2026-06-01 00:56:00'),
(82, '2026100082', 'Xavier', 'Xenos', 'Manalang', NULL, 'Grade 1', 'Male', '2019-01-06', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Hugot, Roxas, Isabela', '09741234558', NULL, NULL, 'Enrolled', '2026-06-01 00:57:00'),
(83, '2026100083', 'Yvonne', 'Yap', 'Lacaba', NULL, 'Grade 1', 'Female', '2019-05-09', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 4, Brgy. Ipil, Roxas, Isabela', '09751234559', NULL, NULL, 'Enrolled', '2026-06-01 00:58:00'),
(84, '2026100084', 'Zachary', 'Zablan', 'Villegas', NULL, 'Grade 1', 'Male', '2019-09-01', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Jower, Roxas, Isabela', '09761234560', NULL, NULL, 'Enrolled', '2026-06-01 00:59:00'),
(85, '2026100085', 'Abigail', 'Aguilar', 'Buenaventura', NULL, 'Grade 1', 'Female', '2019-02-22', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Kalinga, Roxas, Isabela', '09771234561', NULL, NULL, 'Enrolled', '2026-06-01 01:00:00'),
(86, '2026100086', 'Benjamin', 'Bondoc', 'Alonzo', NULL, 'Grade 1', 'Male', '2019-06-05', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Lanna, Roxas, Isabela', '09781234562', NULL, NULL, 'Enrolled', '2026-06-01 01:01:00'),
(87, '2026100087', 'Christine', 'Cabanero', 'Delos Reyes', NULL, 'Grade 1', 'Female', '2019-11-28', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Magsaysay, Roxas, Isabela', '09791234563', NULL, NULL, 'Enrolled', '2026-06-01 01:02:00'),
(88, '2026100088', 'Dominic', 'De Guzman', 'Padilla', NULL, 'Grade 1', 'Male', '2019-04-19', 7, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 4, Brgy. Naguilian, Roxas, Isabela', '09801234564', NULL, NULL, 'Enrolled', '2026-06-01 01:03:00'),
(89, '2026100089', 'Erika', 'Enriquez', 'Sarmiento', NULL, 'Grade 1', 'Female', '2019-08-11', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Osmeña, Roxas, Isabela', '09811234565', NULL, NULL, 'Enrolled', '2026-06-01 01:04:00'),
(90, '2026100090', 'Ferdinand', 'Franco', 'Alvarez', NULL, 'Grade 1', 'Male', '2019-12-14', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Pag-asa, Roxas, Isabela', '09821234566', NULL, NULL, 'Enrolled', '2026-06-01 01:05:00'),
(91, '2026100091', 'Giselle', 'Garcia', 'Roque', NULL, 'Grade 1', 'Female', '2019-03-01', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Quezon, Roxas, Isabela', '09831234567', NULL, NULL, 'Enrolled', '2026-06-01 01:06:00'),
(92, '2026100092', 'Harold', 'Hilario', 'Camposano', NULL, 'Grade 1', 'Male', '2019-07-15', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 3, Brgy. Roxas, Roxas, Isabela', '09841234568', NULL, NULL, 'Enrolled', '2026-06-01 01:07:00'),
(93, '2026100093', 'Irene', 'Ilustre', 'Catalan', NULL, 'Grade 1', 'Female', '2019-10-23', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Saguday, Roxas, Isabela', '09851234569', NULL, NULL, 'Enrolled', '2026-06-01 01:08:00'),
(94, '2026100094', 'Jayson', 'Javellana', 'Taguiam', NULL, 'Grade 1', 'Male', '2019-01-13', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Tappan, Roxas, Isabela', '09861234570', NULL, NULL, 'Enrolled', '2026-06-01 01:09:00'),
(95, '2026100095', 'Karen', 'Katigbak', 'Uy', NULL, 'Grade 1', 'Female', '2019-04-08', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Upi, Roxas, Isabela', '09871234571', NULL, NULL, 'Enrolled', '2026-06-01 01:10:00'),
(96, '2026100096', 'Luis', 'Legarda', 'Reyes', NULL, 'Grade 1', 'Male', '2019-08-21', 6, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 2, Brgy. Villaros, Roxas, Isabela', '09881234572', NULL, NULL, 'Enrolled', '2026-06-01 01:11:00'),
(97, '2026100097', 'Maribel', 'Magpantay', 'Acosta', NULL, 'Grade 1', 'Female', '2019-12-04', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Warat, Roxas, Isabela', '09891234573', NULL, NULL, 'Enrolled', '2026-06-01 01:12:00'),
(98, '2026100098', 'Nelson', 'Navarra', 'Borja', NULL, 'Grade 1', 'Male', '2019-03-15', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Yawan, Roxas, Isabela', '09901234574', NULL, NULL, 'Enrolled', '2026-06-01 01:13:00'),
(99, '2026100099', 'Odessa', 'Ocampo', 'Dela Cruz', NULL, 'Grade 1', 'Female', '2019-07-28', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Zitanga, Roxas, Isabela', '09911234575', NULL, NULL, 'Enrolled', '2026-06-01 01:14:00'),
(100, '2026100100', 'Paolo', 'Pasia', 'Macapagal', NULL, 'Grade 1', 'Male', '2019-11-08', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Alimannao, Roxas, Isabela', '09921234576', NULL, NULL, 'Enrolled', '2026-06-01 01:15:00'),
(101, '2026100101', 'Queena', 'Quimpo', 'Ngo', NULL, 'Grade 1', 'Female', '2019-02-03', 7, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 2, Brgy. Baguinay, Roxas, Isabela', '09931234577', NULL, NULL, 'Enrolled', '2026-06-01 01:16:00'),
(102, '2026100102', 'Roberto', 'Recto', 'Ferrer', NULL, 'Grade 1', 'Male', '2019-06-26', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Casibarag, Roxas, Isabela', '09941234578', NULL, NULL, 'Enrolled', '2026-06-01 01:17:00'),
(103, '2026100103', 'Sheila', 'Salcedo', 'Oracion', NULL, 'Grade 1', 'Female', '2019-09-19', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Dammang, Roxas, Isabela', '09951234579', NULL, NULL, 'Enrolled', '2026-06-01 01:18:00'),
(104, '2026100104', 'Timothy', 'Tamayo', 'Soriano', NULL, 'Grade 1', 'Male', '2019-01-25', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Ecreta, Roxas, Isabela', '09961234580', NULL, NULL, 'Enrolled', '2026-06-01 01:19:00'),
(105, '2026100105', 'Ursula', 'Urbano', 'Estrada', NULL, 'Grade 1', 'Female', '2019-05-17', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 1, Brgy. Fuyo, Roxas, Isabela', '09971234581', NULL, NULL, 'Enrolled', '2026-06-01 01:20:00'),
(106, '2026100106', 'Vince', 'Velarde', 'Manzano', NULL, 'Grade 1', 'Male', '2019-10-13', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Gaddang, Roxas, Isabela', '09981234582', NULL, NULL, 'Enrolled', '2026-06-01 01:21:00'),
(107, '2026100107', 'Wena', 'Waga', 'Cayanan', NULL, 'Grade 1', 'Female', '2019-02-16', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Hugot, Roxas, Isabela', '09091234583', NULL, NULL, 'Enrolled', '2026-06-01 01:22:00'),
(108, '2026100108', 'Xerxes', 'Ximenez', 'Paras', NULL, 'Grade 1', 'Male', '2019-07-01', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 4, Brgy. Ipil, Roxas, Isabela', '09081234584', NULL, NULL, 'Enrolled', '2026-06-01 01:23:00'),
(109, '2026100109', 'Yannie', 'Yalong', 'Ballesteros', NULL, 'Grade 1', 'Female', '2019-11-20', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Jower, Roxas, Isabela', '09071234585', NULL, NULL, 'Enrolled', '2026-06-01 01:24:00'),
(110, '2026100110', 'Zenon', 'Zoleta', 'Quizon', NULL, 'Grade 1', 'Male', '2019-04-30', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Kalinga, Roxas, Isabela', '09061234586', NULL, NULL, 'Enrolled', '2026-06-01 01:25:00'),
(111, '2026100111', 'Almira', 'Abano', 'Malicdem', NULL, 'Grade 1', 'Female', '2019-08-23', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Lanna, Roxas, Isabela', '09051234587', NULL, NULL, 'Enrolled', '2026-06-01 01:26:00'),
(112, '2026100112', 'Basilio', 'Bantay', 'Ilustrisimo', NULL, 'Grade 1', 'Male', '2019-12-12', 6, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 3, Brgy. Magsaysay, Roxas, Isabela', '09041234588', NULL, NULL, 'Enrolled', '2026-06-01 01:27:00'),
(113, '2026100113', 'Corazon', 'Castañeda', 'Leal', NULL, 'Grade 1', 'Female', '2019-03-07', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Naguilian, Roxas, Isabela', '09031234589', NULL, NULL, 'Enrolled', '2026-06-01 01:28:00'),
(114, '2026100114', 'Dionisio', 'Delos Santos', 'Tagalog', NULL, 'Grade 1', 'Male', '2019-06-20', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Osmeña, Roxas, Isabela', '09021234590', NULL, NULL, 'Enrolled', '2026-06-01 01:29:00'),
(115, '2026100115', 'Estrella', 'Estrellado', 'Pineda', NULL, 'Grade 1', 'Female', '2019-09-14', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Pag-asa, Roxas, Isabela', '09011234591', NULL, NULL, 'Enrolled', '2026-06-01 01:30:00'),
(116, '2026100116', 'Florencio', 'Flores', 'Tolosa', NULL, 'Grade 1', 'Male', '2019-01-18', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 2, Brgy. Quezon, Roxas, Isabela', '09161234592', NULL, NULL, 'Enrolled', '2026-06-01 01:31:00'),
(117, '2026100117', 'Gracia', 'Guevara', 'Laquindanum', NULL, 'Grade 1', 'Female', '2019-05-02', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Roxas, Roxas, Isabela', '09151234593', NULL, NULL, 'Enrolled', '2026-06-01 01:32:00'),
(118, '2026100118', 'Hernando', 'Herrera', 'Camacho', NULL, 'Grade 1', 'Male', '2019-10-26', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Saguday, Roxas, Isabela', '09141234594', NULL, NULL, 'Enrolled', '2026-06-01 01:33:00'),
(119, '2026100119', 'Imelda', 'Isip', 'Narvasa', NULL, 'Grade 1', 'Female', '2019-02-05', 7, 'Roxas, Isabela', 'Filipino', 'Aglipayan', 'Purok 5, Brgy. Tappan, Roxas, Isabela', '09131234595', NULL, NULL, 'Enrolled', '2026-06-01 01:34:00'),
(120, '2026100120', 'Joselito', 'Joson', 'Panganiban', NULL, 'Grade 1', 'Male', '2019-07-09', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Upi, Roxas, Isabela', '09121234596', NULL, NULL, 'Enrolled', '2026-06-01 01:35:00'),
(121, '2026100121', 'Karina', 'Kapunan', 'Dacanay', NULL, 'Grade 1', 'Female', '2019-11-04', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 2, Brgy. Villaros, Roxas, Isabela', '09111234597', NULL, NULL, 'Enrolled', '2026-06-01 01:36:00'),
(122, '2026100122', 'Lorenzo', 'Lacuesta', 'Perez', NULL, 'Grade 1', 'Male', '2019-04-16', 7, 'Roxas, Isabela', 'Filipino', 'Born Again', 'Purok 3, Brgy. Warat, Roxas, Isabela', '09101234598', NULL, NULL, 'Enrolled', '2026-06-01 01:37:00'),
(123, '2026100123', 'Maricel', 'Mallari', 'Bugayong', NULL, 'Grade 1', 'Female', '2019-08-29', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Yawan, Roxas, Isabela', '09091234599', NULL, NULL, 'Enrolled', '2026-06-01 01:38:00'),
(124, '2026100124', 'Noel', 'Nepomuceno', 'Tinio', NULL, 'Grade 1', 'Male', '2019-12-26', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Zitanga, Roxas, Isabela', '09081234600', NULL, NULL, 'Enrolled', '2026-06-01 01:39:00'),
(125, '2026100125', 'Ofelia', 'Orense', 'Tamondong', NULL, 'Grade 1', 'Female', '2019-03-21', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 1, Brgy. Alimannao, Roxas, Isabela', '09071234601', NULL, NULL, 'Enrolled', '2026-06-01 01:40:00'),
(126, '2026100126', 'Pedro', 'Padua', 'Villacorta', NULL, 'Grade 1', 'Male', '2019-06-13', 7, 'Roxas, Isabela', 'Filipino', 'Iglesia ni Cristo', 'Purok 2, Brgy. Baguinay, Roxas, Isabela', '09061234602', NULL, NULL, 'Enrolled', '2026-06-01 01:41:00'),
(127, '2026100127', 'Quirina', 'Quines', 'Lagman', NULL, 'Grade 1', 'Female', '2019-10-07', 6, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 3, Brgy. Casibarag, Roxas, Isabela', '09051234603', NULL, NULL, 'Enrolled', '2026-06-01 01:42:00'),
(128, '2026100128', 'Rodrigo', 'Recio', 'Ocfemia', NULL, 'Grade 1', 'Male', '2019-01-24', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 4, Brgy. Dammang, Roxas, Isabela', '09041234604', NULL, NULL, 'Enrolled', '2026-06-01 01:43:00'),
(129, '2026100129', 'Salvacion', 'Santos', 'Dychiao', NULL, 'Grade 1', 'Female', '2019-05-26', 7, 'Roxas, Isabela', 'Filipino', 'Catholic', 'Purok 5, Brgy. Ecreta, Roxas, Isabela', '09031234605', NULL, NULL, 'Enrolled', '2026-06-01 01:44:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_health_records`
--

CREATE TABLE `student_health_records` (
  `health_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `height` decimal(5,2) DEFAULT NULL,
  `weight` decimal(5,2) DEFAULT NULL,
  `blood_type` varchar(10) DEFAULT NULL,
  `allergies` text DEFAULT NULL,
  `medical_conditions` text DEFAULT NULL,
  `vaccination_status` text DEFAULT NULL,
  `emergency_contact_name` varchar(150) DEFAULT NULL,
  `emergency_contact_number` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_sections`
--

CREATE TABLE `student_sections` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_sections`
--

INSERT INTO `student_sections` (`id`, `student_id`, `section_id`) VALUES
(1, 25, 11),
(2, 26, 11),
(3, 27, 11),
(4, 28, 11),
(5, 29, 11),
(6, 30, 11),
(7, 31, 11),
(8, 32, 11),
(9, 33, 11),
(10, 34, 11),
(11, 35, 11),
(12, 36, 11),
(13, 37, 11),
(14, 38, 11),
(15, 39, 11),
(16, 40, 11),
(17, 41, 11),
(18, 42, 11),
(19, 43, 11),
(20, 44, 11),
(21, 45, 11),
(22, 46, 11),
(23, 47, 11),
(24, 48, 11),
(25, 49, 11),
(26, 50, 11),
(27, 51, 11),
(28, 52, 11),
(29, 53, 11),
(30, 54, 11),
(31, 55, 11),
(32, 56, 11),
(33, 57, 11),
(34, 58, 11),
(35, 59, 11);

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
(15, 'G1-FIL', 'Grade 1', 'Filipino 1', '2026-06-01 13:05:42', NULL),
(16, 'G1-ENG', 'Grade 1', 'English 1', '2026-06-01 13:06:11', NULL),
(17, 'G1-MATH', 'Grade 1', 'Mathematics 1', '2026-06-01 13:07:56', NULL),
(18, 'G1-SCI', 'Grade 1', 'Science 1', '2026-06-01 13:08:50', NULL),
(19, 'G1-MTB', 'Grade 1', 'Mother Tongue 1', '2026-06-01 13:09:12', NULL),
(20, 'G1-ESP', 'Grade 1', 'Edukasyon sa Pagpapakatao 1', '2026-06-01 13:09:24', NULL),
(21, 'G1-MAPEH', 'Grade 1', 'MAPEH 1', '2026-06-01 13:09:59', NULL),
(22, 'G1-AP', 'Grade 1', 'Araling Panlipunan 1', '2026-06-01 13:09:38', NULL);

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
(5, 'Jennifer J. Upton', 'teacher@gmail.com', '$2y$10$JIgDIhgM0PF2mpHSeNWEk.EwMUrAhweKqBinP9shLxyInzdhrbwbe', 'teacher', 'storage/profiles/pfp_5_1779345881.png', '2026-05-10', '2026-05-21'),
(13, 'Registrar', 'registrar@school.edu.ph', '$2y$10$IEz8YAjPkN2ddoQTR6YRUupEwnweJ6YNzsl8opZsKoXrMMFkaJYZG', 'registrar', 'storage/profiles/pfp_13_1779633057.jpg', '2026-05-15', '2026-05-30'),
(14, 'teacher 2', 'teacher1@gmail.com', '$2y$10$1LxuNhIoGyP5pgS2rnMGheE2vsCuzAQqAqSHqqSkTl6DHBeXaH.pm', 'teacher', NULL, '2026-05-19', '2026-05-19'),
(15, 'John Doe', 'teacher3@gmail.com', '$2y$10$MH6VDut/tBSlLmu23a55geQaSo08Yplt7XPdXEg2yFKU38qfc4Mdu', 'teacher', 'storage/profiles/pfp_15_1779416785.png', '2026-05-19', '2026-05-22'),
(16, 'teacher 4', 'teacher4@gmail.com', '$2y$10$1kGUkbDy5q4l9wL.g6YlW.RdTV2sgmoOiCNdpmezmoXzfJ9nRTCi.', 'teacher', NULL, '2026-05-19', '2026-05-19'),
(101, 'Rodrigo B. Reyes', 'rodrigobreyes101@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(102, 'Cecilia M. Flores', 'ceciliamflores102@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(103, 'Ernesto T. Garcia', 'ernestotgarcia103@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(104, 'Lorna V. Lopez', 'lornavlopez104@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(105, 'Ramon C. Torres', 'ramonctorres105@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(106, 'Gloria P. Ramos', 'gloriapramos106@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(107, 'Nestor F. Bautista', 'nestorfbautista107@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(108, 'Anita R. Mendoza', 'anitarmendoza108@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(109, 'Alfredo S. De Leon', 'alfredosdeleon109@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(110, 'Zenaida N. Salvador', 'zenaidansalvador110@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(111, 'Benedict J. Villanueva', 'benedictjvillanueva111@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(112, 'Teresita D. Navarro', 'teresitadnavarro112@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(113, 'Angelo E. Fernandez', 'angeloefernandez113@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01'),
(114, 'Maricel G. Domingo', 'maricelgdomingo114@school.edu.ph', '$2y$10$placeholderHashForSampleData.xxxxxxxxxxxxxxxxxxxxxx', 'teacher', NULL, '2026-06-01', '2026-06-01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_student_year` (`student_id`,`school_year_id`),
  ADD KEY `fk_ah_school_year` (`school_year_id`),
  ADD KEY `fk_ah_section` (`section_id`);

--
-- Indexes for table `assign_section_subjects`
--
ALTER TABLE `assign_section_subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_section_subject` (`section_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_attendance` (`student_id`,`section_id`,`date`,`subject_id`),
  ADD KEY `fk_att_student` (`student_id`),
  ADD KEY `fk_att_section` (`section_id`),
  ADD KEY `fk_att_teacher` (`teacher_id`),
  ADD KEY `fk_att_school_year` (`school_year_id`),
  ADD KEY `idx_att_date` (`date`);

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
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- Indexes for table `student_health_records`
--
ALTER TABLE `student_health_records`
  ADD PRIMARY KEY (`health_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

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
-- AUTO_INCREMENT for table `academic_history`
--
ALTER TABLE `academic_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assign_section_subjects`
--
ALTER TABLE `assign_section_subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=122;

--
-- AUTO_INCREMENT for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_year`
--
ALTER TABLE `school_year`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `sections`
--
ALTER TABLE `sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `student_health_records`
--
ALTER TABLE `student_health_records`
  MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_sections`
--
ALTER TABLE `student_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `academic_history`
--
ALTER TABLE `academic_history`
  ADD CONSTRAINT `fk_ah_school_year` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ah_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_ah_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `assign_section_subjects`
--
ALTER TABLE `assign_section_subjects`
  ADD CONSTRAINT `assign_section_subjects_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `assign_section_subjects_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `fk_att_school_year` FOREIGN KEY (`school_year_id`) REFERENCES `school_year` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_att_section` FOREIGN KEY (`section_id`) REFERENCES `sections` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_att_student` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_att_teacher` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
-- Constraints for table `student_health_records`
--
ALTER TABLE `student_health_records`
  ADD CONSTRAINT `student_health_records_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`) ON DELETE CASCADE;

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
