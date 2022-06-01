-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 09, 2021 at 03:18 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ortac`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', '2021-01-02 15:32:17', '2021-01-02 15:32:17');

-- --------------------------------------------------------

--
-- Table structure for table `admin_config`
--

CREATE TABLE `admin_config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `current_director` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_config`
--

INSERT INTO `admin_config` (`id`, `school_year`, `current_director`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020-2021', 'Dr. Gecelie Almiranez', '2021-01-08 03:44:47', '2021-01-08 18:05:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `abbreviate` varchar(60) NOT NULL,
  `paper_type` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `abbreviate`, `paper_type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diploma in Information Communication Technology', 'DICT', 'Capstone', '2021-01-08 11:01:41', '2021-01-08 11:01:41', NULL),
(2, 'Bachelor of Science in Infomation Technology', 'BSIT', 'Capstone', '2021-01-08 11:01:52', '2021-01-08 11:01:52', NULL),
(3, 'Bachelor of Science in Pyschology', 'BSP', 'Theses', '2021-01-08 11:02:08', '2021-01-08 11:02:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_code` varchar(50) NOT NULL,
  `f_firstname` varchar(100) NOT NULL,
  `f_lastname` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `f_code`, `f_firstname`, `f_lastname`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FA00013TG2009', 'Bernadette', 'Canlas', '2021-01-07 07:33:11', '2021-01-07 07:33:11', NULL),
(2, 'FA00014TG2009', 'Gecelie', 'Almiranez', '2021-01-08 04:10:17', '2021-01-08 04:10:17', NULL),
(3, 'FA00015TG2009', 'Blances ', 'Sanchez', '2021-01-09 07:05:05', '2021-01-09 07:05:05', NULL),
(4, 'FA00016TG2009', 'Elvin', 'Catantan', '2021-01-09 07:05:26', '2021-01-09 07:05:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` text NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '20201222204600', 'App\\Database\\Migrations\\CreateStudents', 'default', 'App', 1608645961, 1),
(2, '20201223154600', 'App\\Database\\Migrations\\CreateStudents', 'default', 'App', 1608712022, 2),
(3, '20201224155700', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1608797108, 3),
(4, '20201224172400', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1608800388, 4),
(5, '20201231143300', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1609396626, 5),
(6, '20210102143300', 'App\\Database\\Migrations\\CreateAdmin', 'default', 'App', 1609571403, 6),
(7, '20210103220900', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1609683345, 7),
(8, '20210103221000', 'App\\Database\\Migrations\\CreateStudentCourse', 'default', 'App', 1609683345, 7),
(9, '20210103221600', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1609683508, 8),
(10, '20210106161400', 'App\\Database\\Migrations\\CreateFaculty', 'default', 'App', 1609921207, 9),
(11, '20210107192600', 'App\\Database\\Migrations\\CreateFaculty', 'default', 'App', 1610026052, 10),
(12, '20210107215000', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1610027597, 11),
(13, '20210107215100', 'App\\Database\\Migrations\\CreateStudents', 'default', 'App', 1610027598, 11),
(14, '20210107215800', 'App\\Database\\Migrations\\CreateStudents', 'default', 'App', 1610027942, 12),
(15, '20210107231200', 'App\\Database\\Migrations\\CreateResearches', 'default', 'App', 1610032571, 13),
(16, '20210107231300', 'App\\Database\\Migrations\\CreateStudentResearch', 'default', 'App', 1610032573, 13),
(17, '20210108134300', 'App\\Database\\Migrations\\CreateStudent', 'default', 'App', 1610084774, 14),
(18, '20210108134500', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610084775, 14),
(19, '20210108134500', 'App\\Database\\Migrations\\CreateStudentResearch', 'default', 'App', 1610084776, 14),
(20, '20210108161300', 'App\\Database\\Migrations\\CreatePaperType', 'default', 'App', 1610093637, 15),
(21, '20210108161500', 'App\\Database\\Migrations\\CreatePaperType', 'default', 'App', 1610093732, 16),
(22, '20210108171500', 'App\\Database\\Migrations\\CreateAdminConfig', 'default', 'App', 1610097375, 17),
(23, '20210108222300', 'App\\Database\\Migrations\\CreateResearchPanel', 'default', 'App', 1610115905, 18),
(24, '20210108223100', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610116368, 19),
(25, '20210108223600', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610116656, 20),
(26, '20210108230700', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1610118521, 21),
(27, '20210108245900', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1610125181, 22),
(28, '20210109113700', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610163456, 23),
(29, '20210109120900', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610165369, 24),
(30, '20210109164200', 'App\\Database\\Migrations\\CreateResearch', 'default', 'App', 1610181818, 25);

-- --------------------------------------------------------

--
-- Table structure for table `paper_type`
--

CREATE TABLE `paper_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type_of_final_paper` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paper_type`
--

INSERT INTO `paper_type` (`id`, `type_of_final_paper`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Feasibility Study', '2021-01-08 16:17:03', '2021-01-08 16:17:03', NULL),
(2, 'Theses', '2021-01-08 16:17:16', '2021-01-08 16:17:16', NULL),
(3, 'Capstone', '2021-01-08 16:17:24', '2021-01-08 16:17:24', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `professor`
--

CREATE TABLE `professor` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_code` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `f_firstname` varchar(100) NOT NULL,
  `f_middlename` varchar(100) NOT NULL,
  `f_lastname` varchar(100) NOT NULL,
  `f_birthdate` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `f_status` char(10) NOT NULL,
  `f_contact` int(20) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `research`
--

CREATE TABLE `research` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `abstract` varchar(350) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `defense_date` date NOT NULL,
  `date_submitted` date NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `director` varchar(50) NOT NULL,
  `paper_type` varchar(50) NOT NULL,
  `file` varchar(255) NOT NULL,
  `reason_for_denial` varchar(100) NOT NULL,
  `research_status` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `research`
--

INSERT INTO `research` (`id`, `title`, `abstract`, `keywords`, `school_year`, `defense_date`, `date_submitted`, `adviser`, `director`, `paper_type`, `file`, `reason_for_denial`, `research_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sample Research with File', 'adfads', 'asdf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', 'http://localhost/OrtacFinal/public/researches/ortacs-converted_1.docx', '', 0, '2021-01-09 16:44:53', '2021-01-09 16:55:34', NULL),
(2, 'Sample for r_id', 'adfasf', 'sdfsdf', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:00:53', '2021-01-09 17:00:53', NULL),
(3, 'Trial 3', 'adfdsf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:04:37', '2021-01-09 17:04:37', NULL),
(4, 'Fourth Trial', 'adfadsf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Choose here...', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:15:51', '2021-01-09 17:15:51', NULL),
(5, 'fifth', 'adf', 'dsf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:17:52', '2021-01-09 17:17:52', NULL),
(6, 'sixth', 'adfadsf', 'dsf', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:19:44', '2021-01-09 17:19:44', NULL),
(7, 'seventh', 'adfads', 'Online Repository of Research and Capstone Projects', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:22:38', '2021-01-09 17:22:38', NULL),
(8, 'Exercise 1', 'adfads', 'Online Repository of Research and Capstone Projects', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:24:21', '2021-01-09 17:24:21', NULL),
(9, 'Exercise 3', 'adfads', 'Online Repository of Research and Capstone Projects', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:26:10', '2021-01-09 17:26:10', NULL),
(10, 'Exercise 2', 'dsfasdf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:27:18', '2021-01-09 17:27:18', NULL),
(11, 'eight', 'adsfsd', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:31:47', '2021-01-09 17:31:47', NULL),
(12, 'ninth', 'adsfadsf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Choose here...', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:32:11', '2021-01-09 17:32:11', NULL),
(13, 'tenth', 'asdf', 'af', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:43:56', '2021-01-09 17:43:56', NULL),
(14, 'eleventh', 'adferqew', 'af', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:45:12', '2021-01-09 17:45:12', NULL),
(15, 'twelveth', 'adsfdsf', 'sdf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:57:48', '2021-01-09 17:57:48', NULL),
(16, 'tirten', 'asdzcv', 'f', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 17:59:42', '2021-01-09 17:59:42', NULL),
(17, 'forten', 'adfs', 'f', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:00:12', '2021-01-09 18:00:12', NULL),
(18, 'fiften', 'adfds', 'f', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:02:11', '2021-01-09 18:02:11', NULL),
(19, 'sixten', 'adfdsf', 'asdf', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:07:05', '2021-01-09 18:07:05', NULL),
(20, 'twenty', 'asdfdsf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:28:47', '2021-01-09 18:28:47', NULL),
(21, 'seventen', 'asdfadsf', 'asdf', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:32:34', '2021-01-09 18:32:34', NULL),
(22, 'eigten', 'adsfds', 'asdf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:43:31', '2021-01-09 18:43:31', NULL),
(23, 'twention', 'adsfads', 'asdf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 18:53:40', '2021-01-09 18:53:40', NULL),
(24, 'twentyto', 'adsfsdf', 'adsf', '2020-2021', '2021-01-09', '2021-01-09', 'Bernadette Canlas', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 19:04:26', '2021-01-09 19:04:26', NULL),
(25, 'twentytri', 'sdfdsf', 'adsf', '2020-2021', '2021-01-09', '2021-01-09', 'Choose here...', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 19:20:42', '2021-01-09 19:20:42', NULL),
(26, 'twentyfour', 'sdsfasf', 'adsf', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 19:22:08', '2021-01-09 19:22:08', NULL),
(27, 'one', 'adsf', 'Guru App Documentation', '2020-2021', '2021-01-09', '2021-01-09', 'Gecelie Almiranez', 'Dr. Gecelie Almiranez', 'Theses', '', '', 0, '2021-01-09 19:52:32', '2021-01-09 19:52:32', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `research_panel`
--

CREATE TABLE `research_panel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `panel_id` int(5) NOT NULL,
  `research_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` char(10) NOT NULL,
  `academic_status` char(10) NOT NULL,
  `year` char(5) NOT NULL,
  `batch_year` int(10) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_number`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `birthdate`, `gender`, `academic_status`, `year`, `batch_year`, `uniid`, `created_at`, `updated_at`) VALUES
(1, '2018-00484-TG-0', 'llynttburton08@gmail.com', '$2y$10$ImdfbmDwMNIinT6oJzUW1.I4Fwas1mLBpyZa1noF40tw2pVoofvHO', 'Lailynette', 'Dela Cruz', 'Burton', '1999-10-08', 'Female', 'Regular', 'III', 2020, 'ee162de0428104f3a9591c5602caf0ce', '2021-01-08 13:47:06', '2021-01-08 13:47:06'),
(2, '2018-00333-TG-0', 'j.balatong1999@gmail.com', '$2y$10$7h8jADr5SQANvY5CGO8KCenTf9z41okJwM2mr8SWzMfFGf0cgjyCO', 'Jayson', 'Senias', 'Balatong', '1999-12-13', 'Male', 'Regular', 'III', 2020, 'd2bc969d9a2de1d127818b999d3368d5', '2021-01-08 13:53:31', '2021-01-08 13:53:31'),
(3, '2018-00111-TG-0', 'railey@yahoo.com', '$2y$10$RSsYRPppeKCccqel5IN.Re7U8CJ3JZ1Mwo67S05wMUwwsS1bCOVV.', 'Railey', 'Dela Cruz', 'Burton', '1999-12-13', 'Male', 'Regular', 'I', 2020, 'ab19232d1125eaec3b3084d5cdf5fb3a', '2021-01-08 13:57:01', '2021-01-08 13:57:01'),
(4, '2018-00222-TG-0', 'sarah@yahoo.com', '$2y$10$/EzqiFtnWO5c1Lzbh0o/V..ZcrmU5IDNr7X98jqMHEJs5X905ZWSG', 'Sarah', 'Dela Cruz', 'Burton', '1999-12-13', 'Choose...', 'Regular', 'Choos', 2020, 'bb9d81681bd96aa86998836b391161d4', '2021-01-08 13:58:21', '2021-01-08 13:58:21'),
(5, '2018-00444-TG-0', 'melchor@yahoo.com', '$2y$10$eA7lqKyORK6bA3hhcw0t6.ht.t8PQ7rAldKocXvjvmx3YPCASmnwa', 'Melchor', 'Alejo', 'Burton', '1999-12-14', 'Male', 'Regular', 'I', 2020, '7ad34200bfbca69d5b91ca85378cf361', '2021-01-08 14:07:37', '2021-01-08 14:07:37'),
(6, '2018-00555-TG-0', 'adsdfs@yahoo.com', '$2y$10$lZh6g6d39nzWdt4Phr8wVeVFUoQqPDdG9mVyJwH3YeJx51wqutkg6', 'adsfds', 'Alejofsadfasdf', 'Burtonasfdsf', '1999-12-14', 'Male', 'Regular', 'III', 2020, '1c3f59e860393af6e49a6c367434b5b1', '2021-01-08 14:08:39', '2021-01-08 14:08:39'),
(7, '2018-00666-TG-0', 'adsfdsdsdf@yahoo.com', '$2y$10$7blhsjWG3ZKKszj0vTWUa.eTgI2unzi0iwjD5y1JYJxoGZi.gL5o2', 'asdfds', 'dsfdsf', 'asfdsf', '1999-08-31', 'Female', 'Regular', 'II', 2020, 'd765fe4a685b7d3d4a2ba63962674079', '2021-01-08 14:12:57', '2021-01-08 14:12:57'),
(8, '2018-00777-TG-0', 'adfaf@yahoo.com', '$2y$10$Ir.cJbutrTWGKpDeAPiC5.MBjeV.LmpCYs.vqdiF3IsMEj.pECe7y', 'asdfds', 'dsfdsf', 'asfdsf', '1999-08-31', 'Choose...', 'Regular', 'Choos', 2020, 'fb9bc9f38f031a3155e20d7233c17d54', '2021-01-08 14:14:17', '2021-01-08 14:14:17'),
(9, '2018-00888-TG-0', 'qqq@yahoo.com', '$2y$10$uTwoQWa05ONX5OAMNRyfTOpj8IY3a1d3YD74k0MvQzyRwAIH4UKsC', 'asdfds', 'dsfdsf', 'asfdsf', '1999-08-31', 'Male', 'Regular', 'III', 2020, '69da3649000190eea0ebb29ea5bd285b', '2021-01-08 14:14:50', '2021-01-08 14:14:50'),
(10, '2018-00999-TG-0', 'qerqew@gmail.com', '$2y$10$8k3v1/FFSPlE4g4xe/cpPOGnnweyIcVGFoIsTrQ4k.HN7pHqKGTXC', 'qewrqew', 'qwerewr', 'werewrwqr', '1999-08-31', 'Choose...', 'Regular', 'Choos', 2020, '9ed13b92e029f53ca9266d8e506e09ed', '2021-01-08 14:35:35', '2021-01-08 14:35:35'),
(11, '2018-00199-TG-0', 'czc@gmail.com', '$2y$10$fOBgUvESy4fwRxJIKvShe.U4BXiBqMEfJf.5/5tIZvK9wTdHQOpHC', 'qewrqew', 'qwerewr', 'werewrwqr', '1999-08-31', 'Other', 'Regular', 'III', 2020, '5c8e6a69490aacd13af86aa382f5a9e2', '2021-01-08 14:40:49', '2021-01-08 14:40:49'),
(12, '2018-00119-TG-0', 'bernadette@gmail.com', '$2y$10$5P2fLyUu3nIBnPzuJDVOdui0RhLJuV7UpZ3x1vIjdNqPXehsJP.fS', 'Berna', 'Villanaba', 'Tradio', '1998-07-31', 'Choose...', 'Regular', 'Choos', 2020, '061bc8f7c94d70a0eb3a4f30c4a2a5b3', '2021-01-08 14:42:18', '2021-01-08 14:42:18'),
(13, '2018-00299-TG-0', 'xcvxvc@gmail.com', '$2y$10$N/PDFUpp/AH1DdKo8epXKewk2GIV056hkKvPIlzb6VHZSMrnN8PJa', 'ghjgj', 'fghjhg', 'hgj', '1999-12-08', 'Choose...', 'Regular', 'Choos', 2020, 'a916f3543f9f976c54ccd41c9fa498f7', '2021-01-08 14:43:53', '2021-01-08 14:43:53'),
(14, '2018-00229-TG-0', 'zcvzv2@gmail.com', '$2y$10$8F/zQtx5LBY.wCHwQrGdzuCOaJk70Was3hqoSw6xv4y3FebwUrF1i', 'jklj', 'lkhjl', 'lhjkl', '1999-08-31', 'Male', 'Regular', 'IV', 2020, 'e3d32b475a80f43a9cf2fb65ed9890af', '2021-01-08 14:49:06', '2021-01-08 14:49:06'),
(15, '2018-00399-TG-0', 'jkjkl67@gmail.com', '$2y$10$uWSHsToyeToXpErl7Dz5n.kn/1Dd065CwAlaOPOXFYmaOub6Wq4s.', 'jklj', 'lkhjl', 'lhjkl', '1999-08-31', 'Choose...', 'Regular', 'Choos', 2020, '11acc860cd953fe41d7350a5934fec97', '2021-01-08 14:50:22', '2021-01-08 14:50:22'),
(16, '2018-00339-TG-0', 'jennie@gmail.com', '$2y$10$5OBnaj6usXeu9eNCSRGEI./YBF2ONBzXKNEQOrUwL6Uj0wPGr/9Mq', 'Jennie', 'ajghd', 'ghdf', '1999-08-05', 'Female', 'Regular', 'V', 2020, '017910f3a7e3e5c71dd3a756bc37819a', '2021-01-08 14:51:34', '2021-01-08 14:51:34'),
(17, '2018-00000-TG-0', 'trial@gmail.com', '$2y$10$GqktvgNmSPh1rL7V1VVTbeKbsvLaaEoxmSD4.GmuBVh9RMv99CuWS', 'sdf', 'asdfds', 'asdf', '1999-10-08', 'Choose...', 'Regular', 'Choos', 2020, 'af114535ac1ecd48685a5e6e280acfe2', '2021-01-08 20:05:21', '2021-01-08 20:05:21'),
(18, '2018-00449-TG-0', 'acz@gmail.com', '$2y$10$3Bkre4GgesHYlNb6I5VTAelLG5jJFbuhJxTxXu8BAfw0rrRifIxn6', 'dsfafd', 'sdfas', 'asdfadsf', '1999-10-08', 'Female', 'Regular', 'IV', 2020, 'e3143f39ffedacf0bc8417b01f38b368', '2021-01-08 20:40:38', '2021-01-08 20:40:38'),
(19, '2018-00499-TG-0', 'bernadettetradio@gmail.com', '$2y$10$dGkerz1xUZ4heoY/Up6RSucQjhE.wLn/8QGOVFeBKteKxd/.OUSpy', 'Bernadette', 'Villanaba', 'Tradio', '1998-07-31', 'Choose...', 'Regular', 'Choos', 2020, '4826fe43154109ef5baf8d92b409f19e', '2021-01-09 10:56:45', '2021-01-09 10:56:45'),
(20, '2018-00559-TG-0', 'cabanelacharmie@yahoo.com', '$2y$10$46fO6so.DncM6WI3uAgTV.eiUdJT3BXWDnnoclF9rnXVd.1pRo1tS', 'Charmie', 'Ablon', 'Cabanela', '1999-04-08', 'Female', 'Regular', 'III', 2020, '0da5f09479e6cbba7d4e36108b8bc216', '2021-01-09 11:20:46', '2021-01-09 11:20:46'),
(21, '2018-00699-TG-0', 'trieal@yahoo.com', '$2y$10$AbkhKPzatKnhLUn6Hhl9zen0ZInBvYibuFR946skMJKWv2lcPzMMq', 'TrialTrial', 'Ablon', 'asdfdsf', '1999-10-08', 'Female', 'Regular', 'III', 2020, 'c76e2cbaffacbc22f9b068a8f035b1f0', '2021-01-09 22:17:08', '2021-01-09 22:17:08');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 14, '2021-01-08 14:08:39', '2021-01-08 14:08:39', NULL),
(2, 69, 7, '2021-01-08 14:14:50', '2021-01-08 14:14:50', NULL),
(3, 11, 8, '2021-01-08 14:40:49', '2021-01-08 14:40:49', NULL),
(4, 12, 0, '2021-01-08 14:42:18', '2021-01-08 14:42:18', NULL),
(5, 13, 0, '2021-01-08 14:43:53', '2021-01-08 14:43:53', NULL),
(6, 15, 5, '2021-01-08 14:50:22', '2021-01-08 14:50:22', NULL),
(7, 16, 23, '2021-01-08 14:51:34', '2021-01-08 14:51:34', NULL),
(8, 17, 0, '2021-01-08 20:05:21', '2021-01-08 20:05:21', NULL),
(9, 18, 9, '2021-01-08 20:40:38', '2021-01-08 20:40:38', NULL),
(10, 19, 0, '2021-01-09 10:56:45', '2021-01-09 10:56:45', NULL),
(11, 20, 3, '2021-01-09 11:20:46', '2021-01-09 11:20:46', NULL),
(12, 21, 2, '2021-01-09 22:17:08', '2021-01-09 22:17:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `student_research`
--

CREATE TABLE `student_research` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `research_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_research`
--

INSERT INTO `student_research` (`id`, `student_id`, `course_id`, `research_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 20, 3, 8, '2021-01-09 11:35:31', '2021-01-09 11:35:31', NULL),
(2, 20, 3, 1, '2021-01-09 11:46:07', '2021-01-09 11:46:07', NULL),
(3, 20, 3, 2, '2021-01-09 11:48:32', '2021-01-09 11:48:32', NULL),
(4, 20, 3, 1, '2021-01-09 12:10:10', '2021-01-09 12:10:10', NULL),
(5, 20, 3, 2, '2021-01-09 15:47:28', '2021-01-09 15:47:28', NULL),
(6, 20, 3, 3, '2021-01-09 15:50:18', '2021-01-09 15:50:18', NULL),
(7, 20, 3, 4, '2021-01-09 16:36:52', '2021-01-09 16:36:52', NULL),
(8, 20, 3, 1, '2021-01-09 16:44:53', '2021-01-09 16:44:53', NULL),
(9, 20, 3, 2, '2021-01-09 17:00:53', '2021-01-09 17:00:53', NULL),
(10, 20, 3, 3, '2021-01-09 17:04:37', '2021-01-09 17:04:37', NULL),
(11, 20, 3, 4, '2021-01-09 17:15:51', '2021-01-09 17:15:51', NULL),
(12, 20, 3, 9, '2021-01-09 17:26:10', '2021-01-09 17:26:10', NULL),
(13, 20, 3, 10, '2021-01-09 17:27:18', '2021-01-09 17:27:18', NULL),
(14, 20, 3, 12, '2021-01-09 17:32:11', '2021-01-09 17:32:11', NULL),
(15, 20, 3, 14, '2021-01-09 17:45:13', '2021-01-09 17:45:13', NULL),
(16, 20, 3, 15, '2021-01-09 17:57:48', '2021-01-09 17:57:48', NULL),
(17, 20, 3, 18, '2021-01-09 18:02:11', '2021-01-09 18:02:11', NULL),
(18, 20, 3, 19, '2021-01-09 18:07:05', '2021-01-09 18:07:05', NULL),
(19, 20, 3, 20, '2021-01-09 18:28:47', '2021-01-09 18:28:47', NULL),
(20, 20, 3, 22, '2021-01-09 18:43:31', '2021-01-09 18:43:31', NULL),
(21, 20, 3, 24, '2021-01-09 19:04:26', '2021-01-09 19:04:26', NULL),
(22, 20, 3, 25, '2021-01-09 19:20:42', '2021-01-09 19:20:42', NULL),
(23, 20, 3, 26, '2021-01-09 19:22:08', '2021-01-09 19:22:08', NULL),
(24, 20, 3, 27, '2021-01-09 19:52:32', '2021-01-09 19:52:32', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_config`
--
ALTER TABLE `admin_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `paper_type`
--
ALTER TABLE `paper_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research`
--
ALTER TABLE `research`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `research_panel`
--
ALTER TABLE `research_panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_course`
--
ALTER TABLE `student_course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_research`
--
ALTER TABLE `student_research`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admin_config`
--
ALTER TABLE `admin_config`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `paper_type`
--
ALTER TABLE `paper_type`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `research`
--
ALTER TABLE `research`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `research_panel`
--
ALTER TABLE `research_panel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_research`
--
ALTER TABLE `student_research`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
