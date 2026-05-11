-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 11, 2026 at 04:34 PM
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
(1, 2, 'Armando Raguindin', 'Tricycle Driver', NULL, 'Melba Raguindin', 'Baby Sitter', NULL, 'Melba Raguindin', 'Parents', NULL, NULL);

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
(2, '20242111365', 'Mark Lester ', 'Suguitan', 'Raguindin', '', 'Male', '2002-12-20', 23, 'Ilagan City, Isabela', 'Filipino', 'Roman Catholic', 'Rizal, Roxas, Isabela', '09349991034', '', 'Array', 'Enrolled', '2026-05-11 13:07:26');

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
(6, 'registrar 1', 'registrar@gmail.com', '$2y$10$9Q0F.LEhZcTQs4uUEWIX.On1wcNUZx.TdPA6VwdEmLlmPRHfUL4tG', 'registrar', 'storage/profiles/pfp_6_1778483665.png', '2026-05-10', '2026-05-11'),
(7, 'Super Admin', 'superadmin@gmail.com', '$2y$10$s7yJsTNr9S1pM/a0CGihludIK0V2/kkXvWTmorhOD9AH6I859ly2q', 'admin', NULL, '2026-05-10', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lrn` (`lrn`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parents_guardians`
--
ALTER TABLE `parents_guardians`
  ADD CONSTRAINT `parents_guardians_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
