-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 17, 2025 at 10:22 AM
-- Server version: 8.0.39
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `student_management_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `code`, `name`, `created_at`, `updated_at`) VALUES
(1, 'BSIT', 'Bachelor of Science in Information Technology', '2025-04-25 09:57:13', NULL),
(2, 'BSAC', 'Bachelor of Science in Accountancy', '2025-04-25 09:57:13', NULL),
(3, 'BSA', 'Bachelor of Science in Agriculture', '2025-04-25 09:57:13', NULL),
(4, 'BPEd', 'Bachelor of Physical Education', '2025-04-25 09:57:13', NULL),
(5, 'BSHM', 'Bachelor of Science in Hospitality Management', '2025-05-16 23:55:11', NULL),
(6, 'BSABE', 'Bachelor of Science in Agricultural and Biosystems Engineering', '2025-05-16 23:56:58', NULL),
(7, 'BSBA', 'Bachelor of Science in Business Administration', '2025-05-16 23:58:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `instructor_id` int NOT NULL,
  `grade` decimal(3,2) DEFAULT NULL,
  `remarks` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `birthdate` date NOT NULL,
  `course_id` int NOT NULL,
  `year_level` tinyint NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `gender`, `birthdate`, `course_id`, `year_level`, `status`, `created_at`, `updated_at`) VALUES
(26, 'S1001', 'John Doe', 'Male', '2005-05-12', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(27, 'S1002', 'Jane Smith', 'Female', '2005-07-23', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(28, 'S1003', 'Michael Johnson', 'Male', '2005-09-15', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(29, 'S1004', 'Emily Davis', 'Female', '2005-11-08', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(30, 'S1005', 'Daniel Garcia', 'Male', '2005-03-02', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(31, 'S1006', 'Sophia Martinez', 'Female', '2005-06-14', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(32, 'S1007', 'David Rodriguez', 'Male', '2005-08-19', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(33, 'S1008', 'Olivia Wilson', 'Female', '2005-10-30', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(34, 'S1009', 'Christopher Brown', 'Male', '2005-01-22', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(35, 'S1010', 'Emma Hernandez', 'Female', '2005-04-11', 1, 1, 'active', '2025-05-17 01:09:22', NULL),
(36, 'S1021', 'Lucas White', 'Male', '2004-05-20', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(37, 'S1022', 'Grace Scott', 'Female', '2004-07-18', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(38, 'S1023', 'Henry Parker', 'Male', '2004-09-08', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(39, 'S1024', 'Scarlett Cooper', 'Female', '2004-11-25', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(40, 'S1025', 'Daniel Mitchell', 'Male', '2004-03-30', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(41, 'S1026', 'Evelyn Ross', 'Female', '2004-06-12', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(42, 'S1027', 'Benjamin Lewis', 'Male', '2004-08-22', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(43, 'S1028', 'Amelia Young', 'Female', '2004-10-14', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(44, 'S1029', 'James Hill', 'Male', '2004-12-01', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(45, 'S1030', 'Charlotte Adams', 'Female', '2004-04-05', 1, 2, 'active', '2025-05-17 01:09:22', NULL),
(46, 'S1041', 'Ethan Carter', 'Male', '2003-05-18', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(47, 'S1042', 'Sophia Johnson', 'Female', '2003-07-21', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(48, 'S1043', 'Noah Bennett', 'Male', '2003-09-05', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(49, 'S1044', 'Emma Collins', 'Female', '2003-11-15', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(50, 'S1045', 'Oliver Diaz', 'Male', '2003-03-29', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(51, 'S1046', 'Ava Evans', 'Female', '2003-06-10', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(52, 'S1047', 'Elijah Foster', 'Male', '2003-08-30', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(53, 'S1048', 'Mia Garcia', 'Female', '2003-10-22', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(54, 'S1049', 'James Hughes', 'Male', '2003-12-05', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(55, 'S1050', 'Charlotte Jordan', 'Female', '2003-04-14', 1, 3, 'active', '2025-05-17 01:09:22', NULL),
(56, 'S1061', 'William King', 'Male', '2002-05-20', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(57, 'S1062', 'Amelia Lewis', 'Female', '2002-07-18', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(58, 'S1063', 'Benjamin Miller', 'Male', '2002-09-08', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(59, 'S1064', 'Harper Nelson', 'Female', '2002-11-25', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(60, 'S1065', 'Lucas Owens', 'Male', '2002-03-30', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(61, 'S1066', 'Evelyn Perez', 'Female', '2002-06-12', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(62, 'S1067', 'Henry Quinn', 'Male', '2002-08-22', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(63, 'S1068', 'Scarlett Roberts', 'Female', '2002-10-14', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(64, 'S1069', 'Daniel Scott', 'Male', '2002-12-01', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(65, 'S1070', 'Grace Taylor', 'Female', '2002-04-05', 1, 4, 'active', '2025-05-17 01:09:22', NULL),
(66, 'S2001', 'Nathan Cruz', 'Male', '2005-01-10', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(67, 'S2002', 'Sophia Reyes', 'Female', '2005-03-25', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(68, 'S2003', 'Jacob Fernandez', 'Male', '2005-06-15', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(69, 'S2004', 'Emma Torres', 'Female', '2005-08-05', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(70, 'S2005', 'Liam Mendoza', 'Male', '2005-10-28', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(71, 'S2006', 'Isabella Gomez', 'Female', '2005-12-12', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(72, 'S2007', 'Gabriel Santos', 'Male', '2005-02-18', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(73, 'S2008', 'Mia Gutierrez', 'Female', '2005-05-07', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(74, 'S2009', 'Daniel Rojas', 'Male', '2005-07-21', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(75, 'S2010', 'Charlotte Herrera', 'Female', '2005-09-14', 2, 1, 'active', '2025-05-17 01:13:07', NULL),
(76, 'S2021', 'Ethan Navarro', 'Male', '2004-05-18', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(77, 'S2022', 'Olivia Ramos', 'Female', '2004-07-21', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(78, 'S2023', 'Mason Vega', 'Male', '2004-09-05', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(79, 'S2024', 'Scarlett Jimenez', 'Female', '2004-11-15', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(80, 'S2025', 'Michael Castillo', 'Male', '2004-03-29', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(81, 'S2026', 'Harper Cruz', 'Female', '2004-06-10', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(82, 'S2027', 'Lucas Morales', 'Male', '2004-08-30', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(83, 'S2028', 'Evelyn Vasquez', 'Female', '2004-10-22', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(84, 'S2029', 'James Ruiz', 'Male', '2004-12-05', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(85, 'S2030', 'Amelia Ortega', 'Female', '2004-04-14', 2, 2, 'active', '2025-05-17 01:13:07', NULL),
(86, 'S2041', 'Benjamin Flores', 'Male', '2003-05-20', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(87, 'S2042', 'Victoria Delgado', 'Female', '2003-07-18', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(88, 'S2043', 'Alexander Pineda', 'Male', '2003-09-08', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(89, 'S2044', 'Sophia Vasquez', 'Female', '2003-11-25', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(90, 'S2045', 'Matthew Rivera', 'Male', '2003-03-30', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(91, 'S2046', 'Isabelle Castillo', 'Female', '2003-06-12', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(92, 'S2047', 'Henry Espinoza', 'Male', '2003-08-22', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(93, 'S2048', 'Natalie Fernandez', 'Female', '2003-10-14', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(94, 'S2049', 'William Santos', 'Male', '2003-12-01', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(95, 'S2050', 'Aubrey Ramirez', 'Female', '2003-04-05', 2, 3, 'active', '2025-05-17 01:13:07', NULL),
(96, 'S2061', 'Samuel Garcia', 'Male', '2002-05-20', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(97, 'S2062', 'Abigail Mendoza', 'Female', '2002-07-18', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(98, 'S2063', 'Julian Lopez', 'Male', '2002-09-08', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(99, 'S2064', 'Savannah Reyes', 'Female', '2002-11-25', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(100, 'S2065', 'Nathaniel Vega', 'Male', '2002-03-30', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(101, 'S2066', 'Lily Gonzalez', 'Female', '2002-06-12', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(102, 'S2067', 'Dominic Rojas', 'Male', '2002-08-22', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(103, 'S2068', 'Leah Torres', 'Female', '2002-10-14', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(104, 'S2069', 'Owen Martinez', 'Male', '2002-12-01', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(105, 'S2070', 'Stella Hernandez', 'Female', '2002-04-05', 2, 4, 'active', '2025-05-17 01:13:07', NULL),
(106, 'S3001', 'Lucas Ramirez', 'Male', '2005-02-15', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(107, 'S3002', 'Sophia Torres', 'Female', '2005-04-18', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(108, 'S3003', 'Ethan Cruz', 'Male', '2005-06-10', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(109, 'S3004', 'Mia Santos', 'Female', '2005-08-22', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(110, 'S3005', 'Daniel Herrera', 'Male', '2005-10-05', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(111, 'S3006', 'Emma Gonzalez', 'Female', '2005-12-11', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(112, 'S3007', 'Benjamin Reyes', 'Male', '2005-03-09', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(113, 'S3008', 'Charlotte Mendoza', 'Female', '2005-05-30', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(114, 'S3009', 'William Rojas', 'Male', '2005-07-14', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(115, 'S3010', 'Harper Gutierrez', 'Female', '2005-09-25', 3, 1, 'active', '2025-05-17 01:14:22', NULL),
(116, 'S3021', 'Henry Vasquez', 'Male', '2004-01-18', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(117, 'S3022', 'Scarlett Navarro', 'Female', '2004-03-27', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(118, 'S3023', 'James Delgado', 'Male', '2004-05-15', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(119, 'S3024', 'Ava Morales', 'Female', '2004-07-08', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(120, 'S3025', 'Matthew Vega', 'Male', '2004-09-21', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(121, 'S3026', 'Isabelle Jimenez', 'Female', '2004-11-03', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(122, 'S3027', 'Lucas Castillo', 'Male', '2004-02-19', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(123, 'S3028', 'Evelyn Espinoza', 'Female', '2004-04-25', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(124, 'S3029', 'Owen Rivera', 'Male', '2004-06-30', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(125, 'S3030', 'Stella Pineda', 'Female', '2004-08-14', 3, 2, 'active', '2025-05-17 01:14:22', NULL),
(126, 'S3041', 'Samuel Garcia', 'Male', '2003-05-21', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(127, 'S3042', 'Victoria Mendoza', 'Female', '2003-07-30', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(128, 'S3043', 'Julian Lopez', 'Male', '2003-09-18', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(129, 'S3044', 'Savannah Reyes', 'Female', '2003-11-29', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(130, 'S3045', 'Nathaniel Vega', 'Male', '2003-03-06', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(131, 'S3046', 'Lily Gonzalez', 'Female', '2003-06-17', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(132, 'S3047', 'Dominic Rojas', 'Male', '2003-08-26', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(133, 'S3048', 'Leah Torres', 'Female', '2003-10-15', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(134, 'S3049', 'Owen Martinez', 'Male', '2003-12-07', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(135, 'S3050', 'Stella Hernandez', 'Female', '2003-04-09', 3, 3, 'active', '2025-05-17 01:14:22', NULL),
(136, 'S3061', 'Benjamin Flores', 'Male', '2002-05-22', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(137, 'S3062', 'Victoria Delgado', 'Female', '2002-07-31', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(138, 'S3063', 'Alexander Pineda', 'Male', '2002-09-19', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(139, 'S3064', 'Sophia Vasquez', 'Female', '2002-11-30', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(140, 'S3065', 'Matthew Rivera', 'Male', '2002-03-07', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(141, 'S3066', 'Isabelle Castillo', 'Female', '2002-06-18', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(142, 'S3067', 'Henry Espinoza', 'Male', '2002-08-27', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(143, 'S3068', 'Natalie Fernandez', 'Female', '2002-10-16', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(144, 'S3069', 'William Santos', 'Male', '2002-12-08', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(145, 'S3070', 'Aubrey Ramirez', 'Female', '2002-04-10', 3, 4, 'active', '2025-05-17 01:14:22', NULL),
(146, 'S4001', 'Nathan Cruz', 'Male', '2005-01-10', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(147, 'S4002', 'Sophia Reyes', 'Female', '2005-03-25', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(148, 'S4003', 'Jacob Fernandez', 'Male', '2005-06-15', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(149, 'S4004', 'Emma Torres', 'Female', '2005-08-05', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(150, 'S4005', 'Liam Mendoza', 'Male', '2005-10-28', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(151, 'S4006', 'Isabella Gomez', 'Female', '2005-12-12', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(152, 'S4007', 'Gabriel Santos', 'Male', '2005-02-18', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(153, 'S4008', 'Mia Gutierrez', 'Female', '2005-05-07', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(154, 'S4009', 'Daniel Rojas', 'Male', '2005-07-21', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(155, 'S4010', 'Charlotte Herrera', 'Female', '2005-09-14', 4, 1, 'active', '2025-05-17 01:15:11', NULL),
(156, 'S4021', 'Ethan Navarro', 'Male', '2004-05-18', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(157, 'S4022', 'Olivia Ramos', 'Female', '2004-07-21', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(158, 'S4023', 'Mason Vega', 'Male', '2004-09-05', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(159, 'S4024', 'Scarlett Jimenez', 'Female', '2004-11-15', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(160, 'S4025', 'Michael Castillo', 'Male', '2004-03-29', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(161, 'S4026', 'Harper Cruz', 'Female', '2004-06-10', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(162, 'S4027', 'Lucas Morales', 'Male', '2004-08-30', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(163, 'S4028', 'Evelyn Vasquez', 'Female', '2004-10-22', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(164, 'S4029', 'James Ruiz', 'Male', '2004-12-05', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(165, 'S4030', 'Amelia Ortega', 'Female', '2004-04-14', 4, 2, 'active', '2025-05-17 01:15:11', NULL),
(166, 'S4041', 'Benjamin Flores', 'Male', '2003-05-20', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(167, 'S4042', 'Victoria Delgado', 'Female', '2003-07-18', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(168, 'S4043', 'Alexander Pineda', 'Male', '2003-09-08', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(169, 'S4044', 'Sophia Vasquez', 'Female', '2003-11-25', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(170, 'S4045', 'Matthew Rivera', 'Male', '2003-03-30', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(171, 'S4046', 'Isabelle Castillo', 'Female', '2003-06-12', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(172, 'S4047', 'Henry Espinoza', 'Male', '2003-08-22', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(173, 'S4048', 'Natalie Fernandez', 'Female', '2003-10-14', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(174, 'S4049', 'William Santos', 'Male', '2003-12-01', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(175, 'S4050', 'Aubrey Ramirez', 'Female', '2003-04-05', 4, 3, 'active', '2025-05-17 01:15:11', NULL),
(176, 'S4061', 'Samuel Garcia', 'Male', '2002-05-20', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(177, 'S4062', 'Abigail Mendoza', 'Female', '2002-07-18', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(178, 'S4063', 'Julian Lopez', 'Male', '2002-09-08', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(179, 'S4064', 'Savannah Reyes', 'Female', '2002-11-25', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(180, 'S4065', 'Nathaniel Vega', 'Male', '2002-03-30', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(181, 'S4066', 'Lily Gonzalez', 'Female', '2002-06-12', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(182, 'S4067', 'Dominic Rojas', 'Male', '2002-08-22', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(183, 'S4068', 'Leah Torres', 'Female', '2002-10-14', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(184, 'S4069', 'Owen Martinez', 'Male', '2002-12-01', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(185, 'S4070', 'Stella Hernandez', 'Female', '2002-04-05', 4, 4, 'active', '2025-05-17 01:15:11', NULL),
(186, 'S5001', 'Nathan Cruz', 'Male', '2005-01-10', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(187, 'S5002', 'Sophia Reyes', 'Female', '2005-03-25', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(188, 'S5003', 'Jacob Fernandez', 'Male', '2005-06-15', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(189, 'S5004', 'Emma Torres', 'Female', '2005-08-05', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(190, 'S5005', 'Liam Mendoza', 'Male', '2005-10-28', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(191, 'S5006', 'Isabella Gomez', 'Female', '2005-12-12', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(192, 'S5007', 'Gabriel Santos', 'Male', '2005-02-18', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(193, 'S5008', 'Mia Gutierrez', 'Female', '2005-05-07', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(194, 'S5009', 'Daniel Rojas', 'Male', '2005-07-21', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(195, 'S5010', 'Charlotte Herrera', 'Female', '2005-09-14', 5, 1, 'active', '2025-05-17 01:16:20', NULL),
(196, 'S5021', 'Ethan Navarro', 'Male', '2004-05-18', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(197, 'S5022', 'Olivia Ramos', 'Female', '2004-07-21', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(198, 'S5023', 'Mason Vega', 'Male', '2004-09-05', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(199, 'S5024', 'Scarlett Jimenez', 'Female', '2004-11-15', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(200, 'S5025', 'Michael Castillo', 'Male', '2004-03-29', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(201, 'S5026', 'Harper Cruz', 'Female', '2004-06-10', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(202, 'S5027', 'Lucas Morales', 'Male', '2004-08-30', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(203, 'S5028', 'Evelyn Vasquez', 'Female', '2004-10-22', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(204, 'S5029', 'James Ruiz', 'Male', '2004-12-05', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(205, 'S5030', 'Amelia Ortega', 'Female', '2004-04-14', 5, 2, 'active', '2025-05-17 01:16:20', NULL),
(206, 'S5041', 'Benjamin Flores', 'Male', '2003-05-20', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(207, 'S5042', 'Victoria Delgado', 'Female', '2003-07-18', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(208, 'S5043', 'Alexander Pineda', 'Male', '2003-09-08', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(209, 'S5044', 'Sophia Vasquez', 'Female', '2003-11-25', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(210, 'S5045', 'Matthew Rivera', 'Male', '2003-03-30', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(211, 'S5046', 'Isabelle Castillo', 'Female', '2003-06-12', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(212, 'S5047', 'Henry Espinoza', 'Male', '2003-08-22', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(213, 'S5048', 'Natalie Fernandez', 'Female', '2003-10-14', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(214, 'S5049', 'William Santos', 'Male', '2003-12-01', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(215, 'S5050', 'Aubrey Ramirez', 'Female', '2003-04-05', 5, 3, 'active', '2025-05-17 01:16:20', NULL),
(216, 'S5061', 'Samuel Garcia', 'Male', '2002-05-20', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(217, 'S5062', 'Abigail Mendoza', 'Female', '2002-07-18', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(218, 'S5063', 'Julian Lopez', 'Male', '2002-09-08', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(219, 'S5064', 'Savannah Reyes', 'Female', '2002-11-25', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(220, 'S5065', 'Nathaniel Vega', 'Male', '2002-03-30', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(221, 'S5066', 'Lily Gonzalez', 'Female', '2002-06-12', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(222, 'S5067', 'Dominic Rojas', 'Male', '2002-08-22', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(223, 'S5068', 'Leah Torres', 'Female', '2002-10-14', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(224, 'S5069', 'Owen Martinez', 'Male', '2002-12-01', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(225, 'S5070', 'Stella Hernandez', 'Female', '2002-04-05', 5, 4, 'active', '2025-05-17 01:16:20', NULL),
(226, 'S6001', 'Nathan Cruz', 'Male', '2005-01-10', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(227, 'S6002', 'Sophia Reyes', 'Female', '2005-03-25', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(228, 'S6003', 'Jacob Fernandez', 'Male', '2005-06-15', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(229, 'S6004', 'Emma Torres', 'Female', '2005-08-05', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(230, 'S6005', 'Liam Mendoza', 'Male', '2005-10-28', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(231, 'S6006', 'Isabella Gomez', 'Female', '2005-12-12', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(232, 'S6007', 'Gabriel Santos', 'Male', '2005-02-18', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(233, 'S6008', 'Mia Gutierrez', 'Female', '2005-05-07', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(234, 'S6009', 'Daniel Rojas', 'Male', '2005-07-21', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(235, 'S6010', 'Charlotte Herrera', 'Female', '2005-09-14', 6, 1, 'active', '2025-05-17 01:17:07', NULL),
(236, 'S6021', 'Ethan Navarro', 'Male', '2004-05-18', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(237, 'S6022', 'Olivia Ramos', 'Female', '2004-07-21', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(238, 'S6023', 'Mason Vega', 'Male', '2004-09-05', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(239, 'S6024', 'Scarlett Jimenez', 'Female', '2004-11-15', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(240, 'S6025', 'Michael Castillo', 'Male', '2004-03-29', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(241, 'S6026', 'Harper Cruz', 'Female', '2004-06-10', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(242, 'S6027', 'Lucas Morales', 'Male', '2004-08-30', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(243, 'S6028', 'Evelyn Vasquez', 'Female', '2004-10-22', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(244, 'S6029', 'James Ruiz', 'Male', '2004-12-05', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(245, 'S6030', 'Amelia Ortega', 'Female', '2004-04-14', 6, 2, 'active', '2025-05-17 01:17:07', NULL),
(246, 'S6041', 'Benjamin Flores', 'Male', '2003-05-20', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(247, 'S6042', 'Victoria Delgado', 'Female', '2003-07-18', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(248, 'S6043', 'Alexander Pineda', 'Male', '2003-09-08', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(249, 'S6044', 'Sophia Vasquez', 'Female', '2003-11-25', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(250, 'S6045', 'Matthew Rivera', 'Male', '2003-03-30', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(251, 'S6046', 'Isabelle Castillo', 'Female', '2003-06-12', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(252, 'S6047', 'Henry Espinoza', 'Male', '2003-08-22', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(253, 'S6048', 'Natalie Fernandez', 'Female', '2003-10-14', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(254, 'S6049', 'William Santos', 'Male', '2003-12-01', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(255, 'S6050', 'Aubrey Ramirez', 'Female', '2003-04-05', 6, 3, 'active', '2025-05-17 01:17:07', NULL),
(256, 'S6061', 'Samuel Garcia', 'Male', '2002-05-20', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(257, 'S6062', 'Abigail Mendoza', 'Female', '2002-07-18', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(258, 'S6063', 'Julian Lopez', 'Male', '2002-09-08', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(259, 'S6064', 'Savannah Reyes', 'Female', '2002-11-25', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(260, 'S6065', 'Nathaniel Vega', 'Male', '2002-03-30', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(261, 'S6066', 'Lily Gonzalez', 'Female', '2002-06-12', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(262, 'S6067', 'Dominic Rojas', 'Male', '2002-08-22', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(263, 'S6068', 'Leah Torres', 'Female', '2002-10-14', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(264, 'S6069', 'Owen Martinez', 'Male', '2002-12-01', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(265, 'S6070', 'Stella Hernandez', 'Female', '2002-04-05', 6, 4, 'active', '2025-05-17 01:17:07', NULL),
(266, 'S7001', 'Nathan Cruz', 'Male', '2005-01-10', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(267, 'S7002', 'Sophia Reyes', 'Female', '2005-03-25', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(268, 'S7003', 'Jacob Fernandez', 'Male', '2005-06-15', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(269, 'S7004', 'Emma Torres', 'Female', '2005-08-05', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(270, 'S7005', 'Liam Mendoza', 'Male', '2005-10-28', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(271, 'S7006', 'Isabella Gomez', 'Female', '2005-12-12', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(272, 'S7007', 'Gabriel Santos', 'Male', '2005-02-18', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(273, 'S7008', 'Mia Gutierrez', 'Female', '2005-05-07', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(274, 'S7009', 'Daniel Rojas', 'Male', '2005-07-21', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(275, 'S7010', 'Charlotte Herrera', 'Female', '2005-09-14', 7, 1, 'active', '2025-05-17 01:18:05', NULL),
(276, 'S7021', 'Ethan Navarro', 'Male', '2004-05-18', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(277, 'S7022', 'Olivia Ramos', 'Female', '2004-07-21', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(278, 'S7023', 'Mason Vega', 'Male', '2004-09-05', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(279, 'S7024', 'Scarlett Jimenez', 'Female', '2004-11-15', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(280, 'S7025', 'Michael Castillo', 'Male', '2004-03-29', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(281, 'S7026', 'Harper Cruz', 'Female', '2004-06-10', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(282, 'S7027', 'Lucas Morales', 'Male', '2004-08-30', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(283, 'S7028', 'Evelyn Vasquez', 'Female', '2004-10-22', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(284, 'S7029', 'James Ruiz', 'Male', '2004-12-05', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(285, 'S7030', 'Amelia Ortega', 'Female', '2004-04-14', 7, 2, 'active', '2025-05-17 01:18:05', NULL),
(286, 'S7041', 'Benjamin Flores', 'Male', '2003-05-20', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(287, 'S7042', 'Victoria Delgado', 'Female', '2003-07-18', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(288, 'S7043', 'Alexander Pineda', 'Male', '2003-09-08', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(289, 'S7044', 'Sophia Vasquez', 'Female', '2003-11-25', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(290, 'S7045', 'Matthew Rivera', 'Male', '2003-03-30', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(291, 'S7046', 'Isabelle Castillo', 'Female', '2003-06-12', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(292, 'S7047', 'Henry Espinoza', 'Male', '2003-08-22', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(293, 'S7048', 'Natalie Fernandez', 'Female', '2003-10-14', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(294, 'S7049', 'William Santos', 'Male', '2003-12-01', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(295, 'S7050', 'Aubrey Ramirez', 'Female', '2003-04-05', 7, 3, 'active', '2025-05-17 01:18:05', NULL),
(296, 'S7061', 'Samuel Garcia', 'Male', '2002-05-20', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(297, 'S7062', 'Abigail Mendoza', 'Female', '2002-07-18', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(298, 'S7063', 'Julian Lopez', 'Male', '2002-09-08', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(299, 'S7064', 'Savannah Reyes', 'Female', '2002-11-25', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(300, 'S7065', 'Nathaniel Vega', 'Male', '2002-03-30', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(301, 'S7066', 'Lily Gonzalez', 'Female', '2002-06-12', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(302, 'S7067', 'Dominic Rojas', 'Male', '2002-08-22', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(303, 'S7068', 'Leah Torres', 'Female', '2002-10-14', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(304, 'S7069', 'Owen Martinez', 'Male', '2002-12-01', 7, 4, 'active', '2025-05-17 01:18:05', NULL),
(305, 'S7070', 'Stella Hernandez', 'Female', '2002-04-05', 7, 4, 'active', '2025-05-17 01:18:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int NOT NULL,
  `code` varchar(20) NOT NULL,
  `catalog_no` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `day` varchar(10) NOT NULL,
  `time` varchar(20) NOT NULL,
  `room` varchar(20) NOT NULL,
  `course_id` int NOT NULL,
  `semester` tinyint NOT NULL,
  `year_level` tinyint NOT NULL,
  `instructor_id` int NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `code`, `catalog_no`, `name`, `day`, `time`, `room`, `course_id`, `semester`, `year_level`, `instructor_id`, `created_at`, `updated_at`) VALUES
(22, '20250517081241', 'IT101', 'Programming and Software Development', 'Monday', '8:00 AM - 10:00 AM', 'Room 301', 1, 1, 1, 1, '2025-05-17 00:12:41', NULL),
(23, '20250517081328', 'IT202', 'Database Management Systems', 'Wednesday', '10:00 AM - 12:00 PM', 'Room 305', 1, 1, 2, 1, '2025-05-17 00:13:28', NULL),
(24, '20250517081413', 'IT303', 'Computer Networking', 'Friday', '1:00 PM - 3:00 PM', 'Room 310', 1, 1, 3, 3, '2025-05-17 00:14:13', '2025-05-17 00:17:46'),
(25, '20250517081842', 'IT404', 'Systems Analysis and Design', 'Tuesday', '3:00 PM - 5:00 PM', 'Room 320', 1, 1, 4, 3, '2025-05-17 00:18:42', '2025-05-17 00:18:55'),
(26, '20250517084357', 'AC101', 'Financial Accounting and Reporting', 'Monday', '8:00 AM - 10:00 AM', 'Room 301', 2, 1, 1, 15, '2025-05-17 00:43:57', NULL),
(27, '20250517084430', 'AC202', 'Auditing and Assurance Principles', 'Wednesday', '10:00 AM - 12:00 PM', 'Room 305', 2, 1, 2, 17, '2025-05-17 00:44:30', NULL),
(28, '20250517084510', 'AC303', 'Taxation', 'Friday', '1:00 PM - 3:00 PM', 'Room 320', 2, 2, 3, 15, '2025-05-17 00:45:10', NULL),
(29, '20250517084540', 'AC404', 'Cost Accounting and Control', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 305', 2, 1, 4, 17, '2025-05-17 00:45:40', NULL),
(30, '20250517084606', 'AG101', 'Crop Science', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 305', 3, 1, 1, 18, '2025-05-17 00:46:06', NULL),
(31, '20250517084642', 'AG202', 'Animal Science', 'Wednesday', '8:00 AM - 10:00 AM', 'Room 302', 3, 2, 2, 19, '2025-05-17 00:46:42', NULL),
(32, '20250517084733', 'AG303', 'Soil Science', 'Friday', '8:00 AM - 10:00 AM', 'Room 305', 3, 2, 3, 19, '2025-05-17 00:47:33', NULL),
(33, '20250517084810', 'AG404', 'Agricultural Economics', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 301', 3, 1, 4, 18, '2025-05-17 00:48:10', NULL),
(34, '20250517084905', 'PE101', 'Exercise Physiology', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 301', 4, 1, 1, 21, '2025-05-17 00:49:05', NULL),
(35, '20250517084937', 'PE202', 'Sports Psychology', 'Monday', '8:00 AM - 10:00 AM', 'Room 302', 4, 2, 2, 3, '2025-05-17 00:49:37', NULL),
(36, '20250517085009', 'PE303', 'Human Anatomy and Physiology', 'Friday', '8:00 AM - 10:00 AM', 'Room 301', 4, 2, 3, 21, '2025-05-17 00:50:09', NULL),
(37, '20250517085034', 'PE404', 'Motor Control and Learning', 'Thursday', '8:00 AM - 10:00 AM', 'Room 301', 4, 1, 4, 3, '2025-05-17 00:50:34', NULL),
(38, '20250517085104', 'HM101', 'Food and Beverage Management', 'Monday', '8:00 AM - 10:00 AM', 'Room 200', 5, 1, 1, 17, '2025-05-17 00:51:04', NULL),
(39, '20250517085131', 'HM202', 'Front Office Operations', 'Thursday', '8:00 AM - 10:00 AM', 'Room 200', 5, 2, 2, 20, '2025-05-17 00:51:31', NULL),
(40, '20250517085200', 'HM303', 'Housekeeping Procedures', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 202', 5, 2, 3, 20, '2025-05-17 00:52:00', NULL),
(41, '20250517085227', 'HM404', 'Events Management', 'Monday', '8:00 AM - 10:00 AM', 'Room 205', 5, 1, 4, 17, '2025-05-17 00:52:27', NULL),
(42, '20250517085300', 'ABE101', 'Agricultural Machinery', 'Monday', '8:00 AM - 10:00 AM', 'Room 205', 6, 1, 1, 21, '2025-05-17 00:53:00', NULL),
(43, '20250517085330', 'ABE202', 'Soil and Water Conservation Engineering', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 200', 6, 2, 2, 19, '2025-05-17 00:53:30', NULL),
(44, '20250517085357', 'ABE303', 'Post-Harvest and Processing Technologies', 'Friday', '8:00 AM - 10:00 AM', 'Room 205', 6, 2, 3, 19, '2025-05-17 00:53:57', NULL),
(45, '20250517085422', 'ABE404', 'Irrigation and Drainage Engineering', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 202', 6, 1, 4, 21, '2025-05-17 00:54:22', NULL),
(46, '20250517085501', 'BA101', 'Principles of Management', 'Monday', '8:00 AM - 10:00 AM', 'Room 202', 7, 1, 1, 15, '2025-05-17 00:55:01', NULL),
(47, '20250517085535', 'BA202', 'Financial Management', 'Friday', '8:00 AM - 10:00 AM', 'Room 303', 7, 2, 2, 17, '2025-05-17 00:55:35', NULL),
(48, '20250517085559', 'BA303', 'Marketing Management', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 303', 7, 2, 3, 15, '2025-05-17 00:55:59', NULL),
(49, '20250517085625', 'BA404', 'Human Resource Management', 'Tuesday', '8:00 AM - 10:00 AM', 'Room 303', 7, 1, 4, 1, '2025-05-17 00:56:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject_enrollments`
--

CREATE TABLE `subject_enrollments` (
  `id` int NOT NULL,
  `student_id` int NOT NULL,
  `subject_id` int NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject_enrollments`
--

INSERT INTO `subject_enrollments` (`id`, `student_id`, `subject_id`, `status`, `created_at`, `updated_at`) VALUES
(89, 26, 22, 'enrolled', '2025-05-17 01:18:43', NULL),
(90, 27, 22, 'enrolled', '2025-05-17 01:18:47', NULL),
(91, 28, 22, 'enrolled', '2025-05-17 01:18:51', NULL),
(92, 29, 22, 'enrolled', '2025-05-17 01:18:55', NULL),
(93, 30, 22, 'enrolled', '2025-05-17 01:18:58', NULL),
(94, 31, 22, 'enrolled', '2025-05-17 01:19:01', NULL),
(95, 32, 22, 'enrolled', '2025-05-17 01:19:04', NULL),
(96, 33, 22, 'enrolled', '2025-05-17 01:19:06', NULL),
(97, 34, 22, 'enrolled', '2025-05-17 01:19:09', NULL),
(98, 35, 22, 'enrolled', '2025-05-17 01:19:12', NULL),
(99, 36, 23, 'enrolled', '2025-05-17 01:19:56', NULL),
(100, 37, 23, 'enrolled', '2025-05-17 01:20:00', NULL),
(101, 39, 23, 'enrolled', '2025-05-17 01:20:05', NULL),
(102, 38, 23, 'enrolled', '2025-05-17 01:20:07', NULL),
(103, 40, 23, 'enrolled', '2025-05-17 01:20:10', NULL),
(104, 41, 23, 'enrolled', '2025-05-17 01:20:13', NULL),
(105, 42, 23, 'enrolled', '2025-05-17 01:20:15', NULL),
(106, 43, 23, 'enrolled', '2025-05-17 01:20:19', NULL),
(107, 44, 23, 'enrolled', '2025-05-17 01:20:22', NULL),
(108, 45, 23, 'enrolled', '2025-05-17 01:20:28', NULL),
(109, 46, 24, 'enrolled', '2025-05-17 01:20:48', NULL),
(110, 48, 24, 'enrolled', '2025-05-17 01:20:51', NULL),
(111, 49, 24, 'enrolled', '2025-05-17 01:20:54', NULL),
(112, 47, 24, 'enrolled', '2025-05-17 01:20:58', NULL),
(113, 50, 24, 'enrolled', '2025-05-17 01:21:00', NULL),
(114, 51, 24, 'enrolled', '2025-05-17 01:21:03', NULL),
(115, 52, 24, 'enrolled', '2025-05-17 01:21:05', NULL),
(116, 53, 24, 'enrolled', '2025-05-17 01:21:08', NULL),
(117, 54, 24, 'enrolled', '2025-05-17 01:21:10', NULL),
(118, 55, 24, 'enrolled', '2025-05-17 01:21:12', NULL),
(119, 56, 25, 'enrolled', '2025-05-17 01:21:25', NULL),
(120, 58, 25, 'enrolled', '2025-05-17 01:21:28', NULL),
(121, 57, 25, 'enrolled', '2025-05-17 01:21:32', NULL),
(122, 59, 25, 'enrolled', '2025-05-17 01:21:35', NULL),
(123, 60, 25, 'enrolled', '2025-05-17 01:21:37', NULL),
(124, 61, 25, 'enrolled', '2025-05-17 01:21:40', NULL),
(125, 62, 25, 'enrolled', '2025-05-17 01:21:42', NULL),
(126, 63, 25, 'enrolled', '2025-05-17 01:21:45', NULL),
(127, 64, 25, 'enrolled', '2025-05-17 01:21:47', NULL),
(128, 65, 25, 'enrolled', '2025-05-17 01:21:49', NULL),
(129, 66, 26, 'enrolled', '2025-05-17 01:23:18', NULL),
(130, 67, 26, 'enrolled', '2025-05-17 01:23:21', NULL),
(131, 69, 26, 'enrolled', '2025-05-17 01:23:25', NULL),
(132, 68, 26, 'enrolled', '2025-05-17 01:23:28', NULL),
(133, 70, 26, 'enrolled', '2025-05-17 01:23:31', NULL),
(134, 71, 26, 'enrolled', '2025-05-17 01:23:33', NULL),
(135, 72, 26, 'enrolled', '2025-05-17 01:23:36', NULL),
(136, 73, 26, 'enrolled', '2025-05-17 01:23:39', NULL),
(137, 74, 26, 'enrolled', '2025-05-17 01:23:42', NULL),
(138, 75, 26, 'enrolled', '2025-05-17 01:23:44', NULL),
(139, 76, 27, 'enrolled', '2025-05-17 01:24:00', NULL),
(140, 77, 27, 'enrolled', '2025-05-17 01:24:04', NULL),
(141, 78, 27, 'enrolled', '2025-05-17 01:24:08', NULL),
(142, 79, 27, 'enrolled', '2025-05-17 01:24:10', NULL),
(143, 80, 27, 'enrolled', '2025-05-17 01:24:13', NULL),
(144, 81, 27, 'enrolled', '2025-05-17 01:24:16', NULL),
(145, 82, 27, 'enrolled', '2025-05-17 01:24:19', NULL),
(146, 83, 27, 'enrolled', '2025-05-17 01:24:23', NULL),
(147, 84, 27, 'enrolled', '2025-05-17 01:24:26', NULL),
(148, 85, 27, 'enrolled', '2025-05-17 01:24:28', NULL),
(149, 86, 28, 'enrolled', '2025-05-17 01:24:39', NULL),
(150, 87, 28, 'enrolled', '2025-05-17 01:24:43', NULL),
(151, 89, 28, 'enrolled', '2025-05-17 01:24:46', NULL),
(152, 88, 28, 'enrolled', '2025-05-17 01:24:50', NULL),
(153, 90, 28, 'enrolled', '2025-05-17 01:24:52', NULL),
(154, 91, 28, 'enrolled', '2025-05-17 01:24:54', NULL),
(155, 92, 28, 'enrolled', '2025-05-17 01:24:57', NULL),
(156, 93, 28, 'enrolled', '2025-05-17 01:24:59', NULL),
(157, 94, 28, 'enrolled', '2025-05-17 01:25:05', NULL),
(158, 95, 28, 'enrolled', '2025-05-17 01:25:07', NULL),
(159, 96, 29, 'enrolled', '2025-05-17 01:26:28', NULL),
(160, 97, 29, 'enrolled', '2025-05-17 01:26:31', NULL),
(161, 98, 29, 'enrolled', '2025-05-17 01:26:34', NULL),
(162, 99, 29, 'enrolled', '2025-05-17 01:26:37', NULL),
(163, 100, 29, 'enrolled', '2025-05-17 01:26:39', NULL),
(164, 101, 29, 'enrolled', '2025-05-17 01:26:41', NULL),
(165, 102, 29, 'enrolled', '2025-05-17 01:26:43', NULL),
(166, 103, 29, 'enrolled', '2025-05-17 01:26:46', NULL),
(167, 104, 29, 'enrolled', '2025-05-17 01:26:48', NULL),
(168, 105, 29, 'enrolled', '2025-05-17 01:26:50', NULL),
(169, 106, 30, 'enrolled', '2025-05-17 01:27:04', NULL),
(170, 107, 30, 'enrolled', '2025-05-17 01:27:07', NULL),
(171, 109, 30, 'enrolled', '2025-05-17 01:27:09', NULL),
(172, 108, 30, 'enrolled', '2025-05-17 01:27:12', NULL),
(173, 110, 30, 'enrolled', '2025-05-17 01:27:14', NULL),
(174, 112, 30, 'enrolled', '2025-05-17 01:27:17', NULL),
(175, 111, 30, 'enrolled', '2025-05-17 01:27:19', NULL),
(176, 113, 30, 'enrolled', '2025-05-17 01:27:21', NULL),
(177, 114, 30, 'enrolled', '2025-05-17 01:27:24', NULL),
(178, 115, 30, 'enrolled', '2025-05-17 01:27:26', NULL),
(179, 116, 31, 'enrolled', '2025-05-17 01:27:47', NULL),
(180, 117, 31, 'enrolled', '2025-05-17 01:27:50', NULL),
(181, 118, 31, 'enrolled', '2025-05-17 01:27:54', NULL),
(182, 119, 31, 'enrolled', '2025-05-17 01:27:56', NULL),
(183, 120, 31, 'enrolled', '2025-05-17 01:27:59', NULL),
(184, 121, 31, 'enrolled', '2025-05-17 01:28:01', NULL),
(185, 122, 31, 'enrolled', '2025-05-17 01:28:03', NULL),
(186, 123, 31, 'enrolled', '2025-05-17 01:28:05', NULL),
(187, 124, 31, 'enrolled', '2025-05-17 01:28:07', NULL),
(188, 125, 31, 'enrolled', '2025-05-17 01:28:09', NULL),
(189, 126, 32, 'enrolled', '2025-05-17 01:32:03', NULL),
(190, 128, 32, 'enrolled', '2025-05-17 01:32:06', NULL),
(191, 127, 32, 'enrolled', '2025-05-17 01:32:09', NULL),
(192, 130, 32, 'enrolled', '2025-05-17 01:32:11', NULL),
(193, 129, 32, 'enrolled', '2025-05-17 01:32:14', NULL),
(194, 131, 32, 'enrolled', '2025-05-17 01:32:17', NULL),
(195, 132, 32, 'enrolled', '2025-05-17 01:32:19', NULL),
(196, 133, 32, 'enrolled', '2025-05-17 01:32:21', NULL),
(197, 134, 32, 'enrolled', '2025-05-17 01:32:23', NULL),
(198, 135, 32, 'enrolled', '2025-05-17 01:32:26', NULL),
(199, 136, 33, 'enrolled', '2025-05-17 01:32:42', NULL),
(200, 137, 33, 'enrolled', '2025-05-17 01:32:45', NULL),
(201, 138, 33, 'enrolled', '2025-05-17 01:32:48', NULL),
(202, 139, 33, 'enrolled', '2025-05-17 01:32:50', NULL),
(203, 140, 33, 'enrolled', '2025-05-17 01:32:52', NULL),
(204, 141, 33, 'enrolled', '2025-05-17 01:32:55', NULL),
(205, 142, 33, 'enrolled', '2025-05-17 01:32:57', NULL),
(206, 143, 33, 'enrolled', '2025-05-17 01:33:00', NULL),
(207, 144, 33, 'enrolled', '2025-05-17 01:33:02', NULL),
(208, 145, 33, 'enrolled', '2025-05-17 01:33:06', NULL),
(209, 147, 34, 'enrolled', '2025-05-17 01:33:19', NULL),
(210, 151, 34, 'enrolled', '2025-05-17 01:33:22', NULL),
(211, 154, 34, 'enrolled', '2025-05-17 01:33:24', NULL),
(212, 148, 34, 'enrolled', '2025-05-17 01:33:27', NULL),
(213, 146, 34, 'enrolled', '2025-05-17 01:33:30', NULL),
(214, 149, 34, 'enrolled', '2025-05-17 01:33:32', NULL),
(215, 150, 34, 'enrolled', '2025-05-17 01:33:34', NULL),
(216, 152, 34, 'enrolled', '2025-05-17 01:33:37', NULL),
(217, 153, 34, 'enrolled', '2025-05-17 01:33:40', NULL),
(218, 155, 34, 'enrolled', '2025-05-17 01:33:42', NULL),
(219, 157, 35, 'enrolled', '2025-05-17 01:33:55', NULL),
(220, 159, 35, 'enrolled', '2025-05-17 01:33:57', NULL),
(221, 158, 35, 'enrolled', '2025-05-17 01:34:00', NULL),
(222, 160, 35, 'enrolled', '2025-05-17 01:34:03', NULL),
(223, 161, 35, 'enrolled', '2025-05-17 01:34:05', NULL),
(224, 156, 35, 'enrolled', '2025-05-17 01:34:07', NULL),
(225, 162, 35, 'enrolled', '2025-05-17 01:34:10', NULL),
(226, 163, 35, 'enrolled', '2025-05-17 01:34:12', NULL),
(227, 164, 35, 'enrolled', '2025-05-17 01:34:14', NULL),
(228, 165, 35, 'enrolled', '2025-05-17 01:34:16', NULL),
(229, 166, 36, 'enrolled', '2025-05-17 01:34:49', NULL),
(230, 167, 36, 'enrolled', '2025-05-17 01:34:52', NULL),
(231, 169, 36, 'enrolled', '2025-05-17 01:34:56', NULL),
(232, 168, 36, 'enrolled', '2025-05-17 01:35:01', NULL),
(233, 170, 36, 'enrolled', '2025-05-17 01:35:03', NULL),
(234, 171, 36, 'enrolled', '2025-05-17 01:35:04', NULL),
(235, 172, 36, 'enrolled', '2025-05-17 01:35:06', NULL),
(236, 173, 36, 'enrolled', '2025-05-17 01:35:08', NULL),
(237, 174, 36, 'enrolled', '2025-05-17 01:35:09', NULL),
(238, 175, 36, 'enrolled', '2025-05-17 01:35:13', NULL),
(239, 176, 37, 'enrolled', '2025-05-17 01:35:26', NULL),
(240, 177, 37, 'enrolled', '2025-05-17 01:35:29', NULL),
(241, 178, 37, 'enrolled', '2025-05-17 01:35:33', NULL),
(242, 179, 37, 'enrolled', '2025-05-17 01:35:35', NULL),
(243, 180, 37, 'enrolled', '2025-05-17 01:35:37', NULL),
(244, 181, 37, 'enrolled', '2025-05-17 01:35:40', NULL),
(245, 182, 37, 'enrolled', '2025-05-17 01:35:42', NULL),
(246, 184, 37, 'enrolled', '2025-05-17 01:35:44', NULL),
(247, 183, 37, 'enrolled', '2025-05-17 01:35:47', NULL),
(248, 185, 37, 'enrolled', '2025-05-17 01:35:49', NULL),
(249, 186, 38, 'enrolled', '2025-05-17 01:36:01', NULL),
(250, 188, 38, 'enrolled', '2025-05-17 01:36:03', NULL),
(251, 191, 38, 'enrolled', '2025-05-17 01:36:06', NULL),
(252, 187, 38, 'enrolled', '2025-05-17 01:36:09', NULL),
(253, 190, 38, 'enrolled', '2025-05-17 01:36:11', NULL),
(254, 189, 38, 'enrolled', '2025-05-17 01:36:14', NULL),
(255, 192, 38, 'enrolled', '2025-05-17 01:36:17', NULL),
(256, 193, 38, 'enrolled', '2025-05-17 01:36:19', NULL),
(257, 194, 38, 'enrolled', '2025-05-17 01:36:21', NULL),
(258, 195, 38, 'enrolled', '2025-05-17 01:36:24', NULL),
(259, 198, 39, 'enrolled', '2025-05-17 01:36:47', NULL),
(260, 201, 39, 'enrolled', '2025-05-17 01:36:50', NULL),
(261, 202, 39, 'enrolled', '2025-05-17 01:36:53', NULL),
(262, 196, 39, 'enrolled', '2025-05-17 01:36:56', NULL),
(263, 199, 39, 'enrolled', '2025-05-17 01:36:59', NULL),
(264, 200, 39, 'enrolled', '2025-05-17 01:37:00', NULL),
(265, 203, 39, 'enrolled', '2025-05-17 01:37:02', NULL),
(266, 197, 39, 'enrolled', '2025-05-17 01:37:04', NULL),
(267, 205, 39, 'enrolled', '2025-05-17 01:37:06', NULL),
(268, 204, 39, 'enrolled', '2025-05-17 01:37:08', NULL),
(269, 211, 40, 'enrolled', '2025-05-17 01:37:25', NULL),
(270, 212, 40, 'enrolled', '2025-05-17 01:37:28', NULL),
(271, 210, 40, 'enrolled', '2025-05-17 01:37:30', NULL),
(272, 207, 40, 'enrolled', '2025-05-17 01:37:33', NULL),
(273, 208, 40, 'enrolled', '2025-05-17 01:37:35', NULL),
(274, 209, 40, 'enrolled', '2025-05-17 01:37:37', NULL),
(275, 213, 40, 'enrolled', '2025-05-17 01:37:38', NULL),
(276, 214, 40, 'enrolled', '2025-05-17 01:37:40', NULL),
(277, 215, 40, 'enrolled', '2025-05-17 01:37:43', NULL),
(278, 206, 40, 'enrolled', '2025-05-17 01:37:44', NULL),
(279, 216, 41, 'enrolled', '2025-05-17 01:37:56', NULL),
(280, 218, 41, 'enrolled', '2025-05-17 01:38:00', NULL),
(281, 217, 41, 'enrolled', '2025-05-17 01:38:03', NULL),
(282, 219, 41, 'enrolled', '2025-05-17 01:38:06', NULL),
(283, 220, 41, 'enrolled', '2025-05-17 01:38:09', NULL),
(284, 221, 41, 'enrolled', '2025-05-17 01:38:10', NULL),
(285, 222, 41, 'enrolled', '2025-05-17 01:38:12', NULL),
(286, 223, 41, 'enrolled', '2025-05-17 01:38:14', NULL),
(287, 224, 41, 'enrolled', '2025-05-17 01:38:16', NULL),
(288, 225, 41, 'enrolled', '2025-05-17 01:38:17', NULL),
(289, 227, 42, 'enrolled', '2025-05-17 01:38:33', NULL),
(290, 228, 42, 'enrolled', '2025-05-17 01:38:35', NULL),
(291, 226, 42, 'enrolled', '2025-05-17 01:38:38', NULL),
(292, 229, 42, 'enrolled', '2025-05-17 01:38:41', NULL),
(293, 230, 42, 'enrolled', '2025-05-17 01:38:43', NULL),
(294, 231, 42, 'enrolled', '2025-05-17 01:38:45', NULL),
(295, 232, 42, 'enrolled', '2025-05-17 01:38:48', NULL),
(296, 233, 42, 'enrolled', '2025-05-17 01:38:50', NULL),
(297, 234, 42, 'enrolled', '2025-05-17 01:38:56', NULL),
(298, 235, 42, 'enrolled', '2025-05-17 01:38:58', NULL),
(299, 243, 43, 'enrolled', '2025-05-17 01:39:10', NULL),
(300, 240, 43, 'enrolled', '2025-05-17 01:39:13', NULL),
(301, 239, 43, 'enrolled', '2025-05-17 01:39:15', NULL),
(302, 236, 43, 'enrolled', '2025-05-17 01:39:17', NULL),
(303, 237, 43, 'enrolled', '2025-05-17 01:39:20', NULL),
(304, 238, 43, 'enrolled', '2025-05-17 01:39:22', NULL),
(305, 241, 43, 'enrolled', '2025-05-17 01:39:24', NULL),
(306, 242, 43, 'enrolled', '2025-05-17 01:39:28', NULL),
(307, 245, 43, 'enrolled', '2025-05-17 01:39:30', NULL),
(308, 244, 43, 'enrolled', '2025-05-17 01:39:33', NULL),
(309, 248, 44, 'enrolled', '2025-05-17 01:39:43', NULL),
(310, 253, 44, 'enrolled', '2025-05-17 01:39:46', NULL),
(311, 252, 44, 'enrolled', '2025-05-17 01:39:49', NULL),
(312, 247, 44, 'enrolled', '2025-05-17 01:39:51', NULL),
(313, 246, 44, 'enrolled', '2025-05-17 01:39:54', NULL),
(314, 249, 44, 'enrolled', '2025-05-17 01:39:56', NULL),
(315, 250, 44, 'enrolled', '2025-05-17 01:39:58', NULL),
(316, 251, 44, 'enrolled', '2025-05-17 01:40:00', NULL),
(317, 254, 44, 'enrolled', '2025-05-17 01:40:02', NULL),
(318, 255, 44, 'enrolled', '2025-05-17 01:40:04', NULL),
(319, 256, 45, 'enrolled', '2025-05-17 01:40:21', NULL),
(320, 258, 45, 'enrolled', '2025-05-17 01:40:25', NULL),
(321, 263, 45, 'enrolled', '2025-05-17 01:40:27', NULL),
(322, 257, 45, 'enrolled', '2025-05-17 01:40:31', NULL),
(323, 259, 45, 'enrolled', '2025-05-17 01:40:33', NULL),
(324, 260, 45, 'enrolled', '2025-05-17 01:40:35', NULL),
(325, 261, 45, 'enrolled', '2025-05-17 01:40:36', NULL),
(326, 262, 45, 'enrolled', '2025-05-17 01:40:38', NULL),
(327, 264, 45, 'enrolled', '2025-05-17 01:40:40', NULL),
(328, 265, 45, 'enrolled', '2025-05-17 01:40:41', NULL),
(329, 266, 46, 'enrolled', '2025-05-17 01:40:50', NULL),
(330, 275, 46, 'enrolled', '2025-05-17 01:40:53', NULL),
(331, 271, 46, 'enrolled', '2025-05-17 01:40:55', NULL),
(332, 267, 46, 'enrolled', '2025-05-17 01:40:57', NULL),
(333, 268, 46, 'enrolled', '2025-05-17 01:41:00', NULL),
(334, 269, 46, 'enrolled', '2025-05-17 01:41:02', NULL),
(335, 270, 46, 'enrolled', '2025-05-17 01:41:04', NULL),
(336, 272, 46, 'enrolled', '2025-05-17 01:41:05', NULL),
(337, 273, 46, 'enrolled', '2025-05-17 01:41:08', NULL),
(338, 274, 46, 'enrolled', '2025-05-17 01:41:10', NULL),
(339, 281, 47, 'enrolled', '2025-05-17 01:41:18', NULL),
(340, 283, 47, 'enrolled', '2025-05-17 01:41:21', NULL),
(341, 284, 47, 'enrolled', '2025-05-17 01:41:23', NULL),
(342, 276, 47, 'enrolled', '2025-05-17 01:41:25', NULL),
(343, 277, 47, 'enrolled', '2025-05-17 01:41:28', NULL),
(344, 278, 47, 'enrolled', '2025-05-17 01:41:30', NULL),
(345, 279, 47, 'enrolled', '2025-05-17 01:41:33', NULL),
(346, 280, 47, 'enrolled', '2025-05-17 01:41:35', NULL),
(347, 282, 47, 'enrolled', '2025-05-17 01:41:37', NULL),
(348, 285, 47, 'enrolled', '2025-05-17 01:41:39', NULL),
(349, 291, 48, 'enrolled', '2025-05-17 01:41:48', NULL),
(350, 290, 48, 'enrolled', '2025-05-17 01:41:52', NULL),
(351, 289, 48, 'enrolled', '2025-05-17 01:41:54', NULL),
(352, 286, 48, 'enrolled', '2025-05-17 01:41:57', NULL),
(353, 287, 48, 'enrolled', '2025-05-17 01:41:59', NULL),
(354, 288, 48, 'enrolled', '2025-05-17 01:42:01', NULL),
(355, 292, 48, 'enrolled', '2025-05-17 01:42:03', NULL),
(356, 293, 48, 'enrolled', '2025-05-17 01:42:05', NULL),
(357, 294, 48, 'enrolled', '2025-05-17 01:42:08', NULL),
(358, 295, 48, 'enrolled', '2025-05-17 01:42:11', NULL),
(359, 299, 49, 'enrolled', '2025-05-17 01:42:21', NULL),
(360, 303, 49, 'enrolled', '2025-05-17 01:42:24', NULL),
(361, 302, 49, 'enrolled', '2025-05-17 01:42:26', NULL),
(362, 297, 49, 'enrolled', '2025-05-17 01:42:28', NULL),
(363, 298, 49, 'enrolled', '2025-05-17 01:42:31', NULL),
(364, 296, 49, 'enrolled', '2025-05-17 01:42:32', NULL),
(365, 300, 49, 'enrolled', '2025-05-17 01:42:34', NULL),
(366, 301, 49, 'enrolled', '2025-05-17 01:42:36', NULL),
(367, 304, 49, 'enrolled', '2025-05-17 01:42:37', NULL),
(368, 305, 49, 'enrolled', '2025-05-17 01:42:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `status` varchar(20) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `designation` int NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `status`, `created_at`, `updated_at`, `designation`) VALUES
(1, 'Eraser Head', 'instructor2@example.com', '$2y$10$vH0RnbDmPMQbpomNPUWbluNJX3Bn8hnYNOaCqZ7.Nyll1y3Z7goQS', 'instructor', 'active', '2025-04-25 09:56:19', '2025-05-17 00:02:46', 1),
(2, 'admin one', 'admin1@example.com', '$2y$10$wVkQKLxhwMkPPXUBjFmKhuO/wUXRGMvUwsFiYXzMHJNu3RJMCQtry', 'admin', 'active', '2025-04-25 09:56:19', '2025-05-06 00:31:55', 1),
(3, 'All Might', 'instructor1@example.com', '$2y$10$oeVYC9C6K0jIIJ/KmNUbYOA5LJuCq.3ugUPL4ItvuWBfX.jxlWqu.', 'instructor', 'active', '2025-04-25 09:56:19', '2025-05-17 00:01:13', 1),
(9, 'super admin', 'superadmin1@example.com', '$2y$10$d02tkmHAoU7fpo28lhyLcuUq1MSlwgWCTSsIa12K1Vm6uV275vvoe', 'superadmin', 'active', '2025-05-05 13:03:44', NULL, 1),
(15, 'Present Mic', 'instructor3@example.com', '$2y$10$M/9Ll8iKBidgzSxkH9bEZeU6nBjxhUG8JEAlvhLUmhLda.0WAHr9i', 'instructor', 'active', '2025-05-09 06:26:33', '2025-05-17 00:06:42', 1),
(17, 'Midnight', 'instructor4@example.com', '$2y$10$Wcsm.ZE.RQV7rQ1eHGh0w.0Gt/9PZZbon/WE1HLMcR69hqw9qqqAq', 'instructor', 'active', '2025-05-17 00:03:33', NULL, 1),
(18, 'Vlad King', 'instructor5@example.com', '$2y$10$QUNOoSFStWMe1nG8hhxFL.FbqorCf/0OM4ZWrJYp3zFlUwDZTWe82', 'instructor', 'active', '2025-05-17 00:04:59', NULL, 1),
(19, 'Cementoss', 'instructor6@example.com', '$2y$10$dgln7.Zk3v8JhZy2LHsDWOtkPzsK1jHwAXq/mcF99MI.zrKCZgBEG', 'instructor', 'active', '2025-05-17 00:05:34', NULL, 1),
(20, 'Thirteen', 'instructor7@example.com', '$2y$10$Xf1Y7Uj4eOQWcbVjMQXWXO0S4BVcCoFcL7XzVxqe06Un/ExQ2HgXi', 'instructor', 'active', '2025-05-17 00:05:51', NULL, 1),
(21, 'Power Loader', 'instructor8@example.com', '$2y$10$1AmchqFSfMnbWFZp1kkPG.DU8IKrdW9rcZ.hIyeshUfSFAK9OcxpO', 'instructor', 'active', '2025-05-17 00:06:11', NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`),
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `course_id` (`course_id`),
  ADD KEY `instructor_id` (`instructor_id`);

--
-- Indexes for table `subject_enrollments`
--
ALTER TABLE `subject_enrollments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `subject_enrollments`
--
ALTER TABLE `subject_enrollments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=370;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grades`
--
ALTER TABLE `grades`
  ADD CONSTRAINT `grades_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `grades_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
  ADD CONSTRAINT `grades_ibfk_3` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`);

--
-- Constraints for table `subjects`
--
ALTER TABLE `subjects`
  ADD CONSTRAINT `subjects_ibfk_1` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `subjects_ibfk_2` FOREIGN KEY (`instructor_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `subject_enrollments`
--
ALTER TABLE `subject_enrollments`
  ADD CONSTRAINT `subject_enrollments_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `subject_enrollments_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
