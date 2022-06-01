-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2021 at 11:18 AM
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
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `abbreviate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bachelor of Science in Infomation Technology', '', '2021-01-03 09:44:56', '2021-01-03 09:44:56', NULL),
(2, 'Diploma in Information Communication Technology', 'DICT', '2021-01-03 10:21:56', '2021-01-03 10:21:56', NULL),
(3, 'adsfadsfasdf', 'adfa', '2021-01-03 10:26:58', '2021-01-03 10:26:58', NULL),
(4, 'newewww', 'adfadf', '2021-01-03 10:45:59', '2021-01-03 10:45:59', NULL),
(5, 'omygrrr', 'adfa', '2021-01-03 10:46:28', '2021-01-03 10:46:28', NULL),
(6, 'Bachelor of Science in Secondary Education', 'BSSE', '2021-01-03 10:48:05', '2021-01-03 10:48:05', NULL),
(7, 'Bachelor of Science in Education Major in Math', 'asdfdsf', '2021-01-04 02:32:55', '2021-01-04 02:32:55', NULL),
(8, 'Bachelor of Science Human Resources', 'BSHR', '2021-01-04 02:43:32', '2021-01-04 02:43:32', NULL),
(9, 'Bachelor of Science Major in Marketing Management', 'BSMM', '2021-01-06 01:09:25', '2021-01-06 01:09:25', NULL),
(10, 'Sample', 'Sample', '2021-01-06 22:20:13', '2021-01-06 22:20:13', NULL),
(11, 'Sample 2', 'Sample 2', '2021-01-06 22:23:00', '2021-01-06 22:23:00', NULL),
(12, 'Sample 3', 'SS3', '2021-01-07 06:31:28', '2021-01-07 06:31:28', NULL),
(13, 'Sample 4', 'SS4', '2021-01-07 06:32:55', '2021-01-07 06:32:55', NULL),
(14, 'Sample 5', 'Sample 5', '2021-01-07 06:33:57', '2021-01-07 06:33:57', NULL),
(15, 'Sample 6', 'SS6', '2021-01-07 06:41:13', '2021-01-07 06:41:13', NULL),
(16, 'Ano ba nmana ', 'grrrrrr', '2021-01-07 06:42:33', '2021-01-07 06:42:33', NULL),
(17, 'lailynette', 'lei', '2021-01-07 06:44:02', '2021-01-07 06:44:02', NULL),
(18, 'railey', 'ali', '2021-01-07 06:44:19', '2021-01-07 06:44:19', NULL),
(19, 'Meriel', 'baba', '2021-01-07 06:47:12', '2021-01-07 06:47:12', NULL),
(20, 'Charmie', 'charms', '2021-01-07 07:17:25', '2021-01-07 07:17:25', NULL),
(21, 'John Carlo', 'jcc', '2021-01-07 07:21:41', '2021-01-07 07:21:41', NULL),
(22, '123244', '112', '2021-01-07 07:22:17', '2021-01-07 07:22:17', NULL),
(23, 'Trial', 'tr1', '2021-01-07 07:23:29', '2021-01-07 07:23:29', NULL);

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
(2, 'FA00014TG2009', 'Gecelie', 'Almiranez', '2021-01-08 04:10:17', '2021-01-08 04:10:17', NULL);

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
(22, '20210108171500', 'App\\Database\\Migrations\\CreateAdminConfig', 'default', 'App', 1610097375, 17);

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
  `school_year` date NOT NULL,
  `defense_date` date NOT NULL,
  `date_submitted` date NOT NULL,
  `director` int(5) NOT NULL,
  `papertype_id` int(5) NOT NULL,
  `reason_for_denial` varchar(100) NOT NULL,
  `research_status` int(5) NOT NULL,
  `authors` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`authors`)),
  `panels` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`panels`)),
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
(16, '2018-00339-TG-0', 'jennie@gmail.com', '$2y$10$5OBnaj6usXeu9eNCSRGEI./YBF2ONBzXKNEQOrUwL6Uj0wPGr/9Mq', 'Jennie', 'ajghd', 'ghdf', '1999-08-05', 'Female', 'Regular', 'V', 2020, '017910f3a7e3e5c71dd3a756bc37819a', '2021-01-08 14:51:34', '2021-01-08 14:51:34');

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
(7, 16, 23, '2021-01-08 14:51:34', '2021-01-08 14:51:34', NULL);

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student_research`
--
ALTER TABLE `student_research`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
