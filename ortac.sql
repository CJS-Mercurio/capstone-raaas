-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 04, 2021 at 09:00 AM
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
(6, 'Bachelor of Science in Secondary Education', 'BSSE', '2021-01-03 10:48:05', '2021-01-03 10:48:05', NULL);

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
(9, '20210103221600', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1609683508, 8);

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
  `branch_id` int(10) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professor`
--

INSERT INTO `professor` (`id`, `f_code`, `email`, `password`, `f_firstname`, `f_middlename`, `f_lastname`, `f_birthdate`, `position`, `f_status`, `f_contact`, `branch_id`, `uniid`, `created_at`, `updated_at`) VALUES
(1, 'FA00088TG2009', 'llynttburton08@gmail.com', '$2y$10$nfpgtkngyqSXHSa1/cp3N.vrchF.3EU1ejtnVxBQy.T.XqZlemtsK', 'Lei', 'Dela Cruz', 'Burton', '1999-10-08', 'Head of Academic Affairs', 'Regular', 2147483647, 0, '8339f9a4410e97e469047dce5071fc37', '2020-12-31 14:37:30', '2020-12-31 14:37:30');

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
  `course_id` int(5) NOT NULL,
  `academic_status` char(10) NOT NULL,
  `batch_year` int(10) NOT NULL,
  `branch_id` int(10) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `activation_date` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `student_number`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `birthdate`, `gender`, `course_id`, `academic_status`, `batch_year`, `branch_id`, `uniid`, `activation_date`, `created_at`, `updated_at`) VALUES
(7, '2018-00484-TG-0', 'railey@yahoo.com', '$2y$10$gukN.Pb59YKSnIDYKkQR.OrtNzg2axE2gi2KNQjmGly/BLrPWCw4u', 'Railey', 'Dela Cruz', 'Burton', '2002-09-22', 'Male', 0, 'Regular', 2019, 0, '76ac87131c146237de6609626c23ce2f', '2020-12-23 03:03:50', '2020-12-23 17:03:50', '2020-12-23 17:03:50'),
(8, '2018-00143-TG-0', 'harry@yahoo.com', '$2y$10$pizcg2DWUVmMwic.BTSxcOzKAM67jrrLbVSRXAadPFK6e7u1amy.e', 'Harry Prince', 'Dela Cruz', 'Asas', '2020-08-04', 'Male', 0, 'Regular', 2020, 0, 'da7f4c623b0891440e36c4edb86a97e0', '2020-12-23 04:44:21', '2020-12-23 18:44:21', '2020-12-28 22:51:53'),
(9, '2018-00145-TG-0', 'syragem@yahoo.com', '$2y$10$maoyqWBsmhFQ6TvxTAzV4.JdQnppYoFNgf1phf6EQzV/H/5UaXcE2', 'Syra Gem', 'Endozo', 'Dela Cruz', '1999-10-08', 'Choose...', 0, 'Regular', 2016, 0, '4219a265eaa4fba6c5dea28ed153f9a0', '2020-12-23 07:36:08', '2020-12-23 21:36:08', '2020-12-23 21:36:08'),
(10, '2018-00444-TG-0', 'lailynette@yahoo.om', '$2y$10$qP2q5ZwxBx5XjkioKaqpZu.aiYPvwow9gWFnQjYTODQJdRVXBLgvC', 'Lailynette', 'Dela Cruz', 'Burton', '1999-10-08', 'Choose...', 0, 'Regular', 2020, 0, '1845f6514b2d48cb252e6a4869fd93b6', '2020-12-28 05:17:11', '2020-12-28 19:17:11', '2020-12-28 19:17:11'),
(11, '2018-00888-TG-0', 'llynttburton08@gmail.com', '$2y$10$Ra9rEEHe/gXshOBeGUnX1.1RVuIFYuccgFQ3.i.MU4I2PisNCaPJK', 'Lailynette', 'Dela Cruz', 'Burton', '1999-10-08', 'Choose...', 0, 'Regular', 2020, 0, 'd7a29a77e3a151119d8412fc443c7714', '2020-12-30 07:39:49', '2020-12-30 21:39:49', '2020-12-31 14:50:40');

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
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor`
--
ALTER TABLE `professor`
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
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `professor`
--
ALTER TABLE `professor`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `student_course`
--
ALTER TABLE `student_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
