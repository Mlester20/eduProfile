-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2026 at 02:53 PM
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
(118, 13, 'registrar', 'LOGIN', 'AUTH', NULL, NULL, 'Registrar logged in', '::1', 'success', '2026-06-01 12:51:38');

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
(10, 'Andres Bonifacio', 'Grade 2', 5, 8, 35, '2026-05-24 14:33:38');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `audit_logs`
--
ALTER TABLE `audit_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `student_health_records`
--
ALTER TABLE `student_health_records`
  MODIFY `health_id` int(11) NOT NULL AUTO_INCREMENT;

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
