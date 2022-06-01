-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 06, 2021 at 03:46 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `system`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_status`
--

CREATE TABLE `academic_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_status` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_status`
--

INSERT INTO `academic_status` (`id`, `academic_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Regular', '2021-05-10 05:53:03', '2021-05-10 05:53:03', NULL),
(2, 'Irregular', '2021-05-10 05:53:08', '2021-05-10 05:53:08', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `academic_year`
--

CREATE TABLE `academic_year` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `academic_year` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic_year`
--

INSERT INTO `academic_year` (`id`, `academic_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'I', '2021-05-10 05:56:37', '2021-05-10 05:56:37', NULL),
(2, 'II', '2021-05-10 05:56:41', '2021-05-10 05:56:41', NULL),
(3, 'III', '2021-05-10 05:56:46', '2021-05-10 05:56:46', NULL),
(4, 'IV', '2021-05-10 05:56:49', '2021-05-10 05:56:49', NULL),
(5, 'V', '2021-05-10 05:56:53', '2021-05-10 05:56:53', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `admin_config`
--

CREATE TABLE `admin_config` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `school_year` varchar(100) NOT NULL,
  `current_director` text NOT NULL,
  `archive_year` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_config`
--

INSERT INTO `admin_config` (`id`, `school_year`, `current_director`, `archive_year`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '2020-2021', 'Dr. Marissa Ferrer', '2018-2024', '2021-05-11 16:18:21', '2021-05-11 16:21:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `course_name` varchar(100) NOT NULL,
  `abbreviate` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `course_name`, `abbreviate`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Diploma in Information Communication Technology', 'DICT', '2021-05-10 06:25:22', '2021-05-10 06:25:22', NULL),
(2, 'Bachelor of Science in Infomation Technology', 'BSIT', '2021-05-10 06:25:34', '2021-05-10 06:25:34', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `course_document`
--

CREATE TABLE `course_document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course_document`
--

INSERT INTO `course_document` (`id`, `document_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 16, 1, '2021-05-15 08:01:46', '2021-05-15 08:01:46', NULL),
(2, 17, 2, '2021-05-15 10:31:38', '2021-05-15 10:31:38', NULL),
(3, 18, 2, '2021-05-16 09:10:05', '2021-05-16 09:10:05', NULL),
(4, 19, 2, '2021-05-18 06:25:02', '2021-05-18 06:25:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `file` varchar(255) NOT NULL,
  `abstract` varchar(350) NOT NULL,
  `keywords` varchar(250) NOT NULL,
  `school_year` varchar(50) NOT NULL,
  `defense_date` date NOT NULL,
  `date_submitted` date NOT NULL,
  `adviser` varchar(50) NOT NULL,
  `director` varchar(50) NOT NULL,
  `approval_sheet` varchar(200) NOT NULL,
  `reason_for_denial` varchar(100) NOT NULL,
  `research_status` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `category_id` int(5) NOT NULL,
  `document_type_id` int(5) NOT NULL,
  `views` int(5) NOT NULL,
  `downloads` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `title`, `file`, `abstract`, `keywords`, `school_year`, `defense_date`, `date_submitted`, `adviser`, `director`, `approval_sheet`, `reason_for_denial`, `research_status`, `course_id`, `category_id`, `document_type_id`, `views`, `downloads`, `created_at`, `updated_at`, `deleted_at`) VALUES
(17, 'Trial for adviser approval', 'Online-Repository-of-Theses-and-Capstone (chap1-3)_3.pdf', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate ', 'Online Repository of Research and Capstone Projects', '2020-2021', '0000-00-00', '2021-05-19', '1', 'Dr. Marissa Ferrer', '', 'No softcopy of research', 2, 2, 0, 1, 0, 0, '2021-05-15 10:31:38', '2021-05-19 22:19:18', NULL),
(18, 'Trial for approval', 'Online-Repository-of-Theses-and-Capstone (chap1-3)_4.pdf', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate ', 'Online Repository of Research and Capstone Projects', '2020-2021', '0000-00-00', '2021-05-18', '1', 'Dr. Marissa Ferrer', '', 'No softcopy of research', 4, 2, 0, 1, 0, 0, '2021-05-16 09:10:05', '2021-05-19 22:12:35', NULL),
(19, 'Trial for approval 1', 'Online-Repository-of-Theses-and-Capstone (chap1-3)_5.pdf', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate ', 'Online Repository of Research and Capstone Projects', '2020-2021', '0000-00-00', '2021-05-03', '', 'Dr. Marissa Ferrer', '', '', 3, 2, 0, 5, 3, 2, '2021-05-18 06:25:01', '2021-06-03 22:33:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_author`
--

CREATE TABLE `document_author` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_id` int(5) NOT NULL,
  `document_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_author`
--

INSERT INTO `document_author` (`id`, `author_id`, `document_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 12, '2021-05-11 16:45:15', '2021-05-11 16:45:15', NULL),
(2, 2, 12, '2021-05-11 16:45:15', '2021-05-11 16:45:15', NULL),
(3, 1, 13, '2021-05-11 16:46:04', '2021-05-11 16:46:04', NULL),
(4, 2, 13, '2021-05-11 16:46:04', '2021-05-11 16:46:04', NULL),
(5, 2, 14, '2021-05-12 23:57:34', '2021-05-12 23:57:34', NULL),
(6, 2, 15, '2021-05-15 20:50:07', '2021-05-15 20:50:07', NULL),
(7, 1, 16, '2021-05-15 21:01:46', '2021-05-15 21:01:46', NULL),
(8, 2, 16, '2021-05-15 21:01:46', '2021-05-15 21:01:46', NULL),
(9, 3, 16, '2021-05-15 21:01:47', '2021-05-15 21:01:47', NULL),
(10, 1, 17, '2021-05-15 23:31:38', '2021-05-15 23:31:38', NULL),
(11, 2, 17, '2021-05-15 23:31:38', '2021-05-15 23:31:38', NULL),
(12, 1, 18, '2021-05-16 22:10:05', '2021-05-16 22:10:05', NULL),
(13, 2, 18, '2021-05-16 22:10:05', '2021-05-16 22:10:05', NULL),
(14, 1, 19, '2021-05-18 19:25:02', '2021-05-18 19:25:02', NULL),
(15, 2, 19, '2021-05-18 19:25:02', '2021-05-18 19:25:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_category`
--

CREATE TABLE `document_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `document_type`
--

CREATE TABLE `document_type` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document_type`
--

INSERT INTO `document_type` (`id`, `type`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Theses', '2021-05-10 06:09:36', '2021-05-10 06:09:36', NULL),
(2, 'Journal', '2021-05-10 06:10:45', '2021-05-10 06:10:45', NULL),
(3, 'Capstone', '2021-05-10 06:10:53', '2021-05-10 06:10:53', NULL),
(4, 'Research Paper', '2021-05-10 06:11:04', '2021-05-10 06:11:04', NULL),
(5, 'Feasibility Study', '2021-05-11 00:32:07', '2021-05-11 00:32:07', NULL),
(6, 'Monograph', '2021-05-11 03:50:52', '2021-05-11 16:51:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_adviser`
--

CREATE TABLE `faculty_adviser` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `f_code` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty_adviser`
--

INSERT INTO `faculty_adviser` (`id`, `f_code`, `first_name`, `middle_name`, `last_name`, `position`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'FA00013TG2009', 'Bernadette', '', 'Canlas', '', '2021-05-11 01:02:42', '2021-05-11 01:02:42', NULL),
(2, 'FA0008TG2009', 'Gecelie', '', 'Almiranez', '', '2021-05-11 01:02:52', '2021-05-11 01:02:52', NULL),
(3, 'FA00014TG2009', 'Blances ', '', 'Sanchez', '', '2021-05-11 01:03:02', '2021-05-11 01:03:02', NULL),
(4, 'FA00088TG2009', 'Elvin', '', 'Catantan', '', '2021-05-11 01:03:12', '2021-05-11 01:03:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `faculty_status`
--

CREATE TABLE `faculty_status` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `faculty_status` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty_status`
--

INSERT INTO `faculty_status` (`id`, `faculty_status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Full-time', '2021-05-10 05:58:50', '2021-05-10 05:58:50', NULL),
(2, 'Part-time', '2021-05-10 05:58:56', '2021-05-10 05:58:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forum`
--

CREATE TABLE `forum` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `date` date NOT NULL,
  `time` varchar(100) NOT NULL,
  `event_type` varchar(100) NOT NULL,
  `start_posting` date NOT NULL,
  `end_posting` date NOT NULL,
  `forum_image` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `details` varchar(300) NOT NULL,
  `location` varchar(300) NOT NULL,
  `submitted_name` varchar(100) NOT NULL,
  `submitted_id` varchar(10) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forum`
--

INSERT INTO `forum` (`id`, `title`, `date`, `time`, `event_type`, `start_posting`, `end_posting`, `forum_image`, `status`, `details`, `location`, `submitted_name`, `submitted_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Forum', '2021-05-18', '21:09', 'Conference', '2021-05-09', '2021-05-20', '', '2', 'yturtyut', '', 'Bernadette Tradio', '2', '2021-05-26 08:49:39', '2021-05-26 21:54:34', NULL),
(2, 'Forum 2', '2021-04-19', '21:53', 'Program', '2021-05-16', '2021-05-22', '', '2', 'qerqreqr', 'PUP Taguig', 'Bernadette Tradio', '2', '2021-05-26 08:53:43', '2021-05-26 21:54:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gender`
--

CREATE TABLE `gender` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gender` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gender`
--

INSERT INTO `gender` (`id`, `gender`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Female', '2021-05-10 05:48:37', '2021-05-10 05:48:37', NULL),
(2, 'Male', '2021-05-10 05:48:42', '2021-05-10 05:48:42', NULL),
(3, 'Rather not say', '2021-05-10 05:48:50', '2021-05-10 05:48:50', NULL);

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
(1, '20210423171900', 'App\\Database\\Migrations\\CreateSuperAdmin', 'default', 'App', 1620634884, 1),
(2, '20210423171900', 'App\\Database\\Migrations\\CreateSuperAdmin', 'default', 'App', 1620634884, 1),
(3, '20210429212800', 'App\\Database\\Migrations\\CreateAdminConfig', 'default', 'App', 1620634886, 1),
(4, '20210429212800', 'App\\Database\\Migrations\\CreateAdminConfig', 'default', 'App', 1620634886, 1),
(5, '20210502135800', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1620634889, 1),
(6, '20210502135800', 'App\\Database\\Migrations\\CreateProfessor', 'default', 'App', 1620634889, 1),
(7, '20210510155600', 'App\\Database\\Migrations\\CreateUser', 'default', 'App', 1620634995, 2),
(8, '20210510155700', 'App\\Database\\Migrations\\CreateDocument', 'default', 'App', 1620634995, 2),
(9, '20210510160700', 'App\\Database\\Migrations\\CreateDocumentCategory', 'default', 'App', 1620634996, 2),
(10, '20210510160800', 'App\\Database\\Migrations\\CreateDocumentType', 'default', 'App', 1620634997, 2),
(11, '20210510160900', 'App\\Database\\Migrations\\CreateResearchPanel', 'default', 'App', 1620634998, 2),
(12, '20210510161000', 'App\\Database\\Migrations\\CreatePanel', 'default', 'App', 1620634999, 2),
(13, '20210510161200', 'App\\Database\\Migrations\\CreateFacultyAdviser', 'default', 'App', 1620634999, 2),
(14, '20210510161500', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1620635000, 2),
(15, '20210510161800', 'App\\Database\\Migrations\\CreateForumImage', 'default', 'App', 1620635000, 2),
(16, '20210510162400', 'App\\Database\\Migrations\\CreateCourse', 'default', 'App', 1620636055, 3),
(17, '20210510162500', 'App\\Database\\Migrations\\CreateCourseDocument', 'default', 'App', 1620636056, 3),
(18, '20210510162700', 'App\\Database\\Migrations\\CreateStudentCourse', 'default', 'App', 1620636056, 3),
(19, '20210510162800', 'App\\Database\\Migrations\\CreateDocumentAuthor', 'default', 'App', 1620636057, 3),
(20, '20210510163000', 'App\\Database\\Migrations\\CreateUserFavorite', 'default', 'App', 1620636057, 3),
(21, '20210510163200', 'App\\Database\\Migrations\\CreateRole', 'default', 'App', 1620636058, 3),
(22, '20210510163300', 'App\\Database\\Migrations\\CreatePermission', 'default', 'App', 1620636058, 3),
(23, '20210510163400', 'App\\Database\\Migrations\\CreateTask', 'default', 'App', 1620636058, 3),
(24, '20210510163500', 'App\\Database\\Migrations\\CreateModule', 'default', 'App', 1620636059, 3),
(25, '20210510163700', 'App\\Database\\Migrations\\CreateAcademicStatus', 'default', 'App', 1620636059, 3),
(26, '20210510163700', 'App\\Database\\Migrations\\CreateDocument', 'default', 'App', 1620636059, 3),
(27, '20210510163700', 'App\\Database\\Migrations\\CreateGender', 'default', 'App', 1620636060, 3),
(28, '20210510163800', 'App\\Database\\Migrations\\CreateAcademicYear', 'default', 'App', 1620636060, 3),
(29, '20210510164000', 'App\\Database\\Migrations\\CreateFacultyStatus', 'default', 'App', 1620636061, 3),
(30, '20210510185000', 'App\\Database\\Migrations\\CreateAcademicStatus', 'default', 'App', 1620643894, 4),
(31, '20210510185000', 'App\\Database\\Migrations\\CreateUser', 'default', 'App', 1620643894, 4),
(32, '20210510185200', 'App\\Database\\Migrations\\CreateAcademicStatus', 'default', 'App', 1620643969, 5),
(33, '20210510185200', 'App\\Database\\Migrations\\CreateAcademicYear', 'default', 'App', 1620643969, 5),
(34, '20210510192000', 'App\\Database\\Migrations\\CreateDocument', 'default', 'App', 1620645649, 6),
(35, '20210510210000', 'App\\Database\\Migrations\\CreateTask', 'default', 'App', 1620651684, 7),
(36, '20210520032100', 'App\\Database\\Migrations\\CreateForumImage', 'default', 'App', 1621452298, 8),
(37, '20210520032300', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1621452298, 8),
(38, '20210520032500', 'App\\Database\\Migrations\\CreateForumImage', 'default', 'App', 1621452371, 9),
(39, '20210520224900', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1621522189, 10),
(40, '20210520225200', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1621522378, 11),
(41, '20210520230500', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1621523129, 12),
(42, '20210521211500', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1621599457, 13),
(43, '20210526170500', 'App\\Database\\Migrations\\CreateForum', 'default', 'App', 1622034685, 14);

-- --------------------------------------------------------

--
-- Table structure for table `module`
--

CREATE TABLE `module` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `module_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `module`
--

INSERT INTO `module` (`id`, `module_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Research Management', '2021-05-10 07:50:47', '2021-05-10 20:52:16', '2021-05-10 07:52:16'),
(2, 'User Management', '2021-05-10 07:50:53', '2021-05-10 07:50:53', NULL),
(3, 'Profile Management', '2021-05-10 07:51:01', '2021-05-10 07:51:01', NULL),
(4, 'Document Management', '2021-05-10 07:52:11', '2021-05-10 07:52:11', NULL),
(5, 'Forum Management', '2021-05-10 07:52:28', '2021-05-10 07:52:28', NULL),
(6, 'Report Management', '2021-05-10 08:08:02', '2021-05-10 08:08:02', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `panel`
--

CREATE TABLE `panel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `middle_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `occupation` varchar(50) NOT NULL,
  `company` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `panel`
--

INSERT INTO `panel` (`id`, `first_name`, `middle_name`, `last_name`, `occupation`, `company`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Bernadette', '', 'Canlas', 'Professor', '', '2021-05-11 14:02:42', '2021-05-11 14:02:42', NULL),
(2, 'Gecelie', '', 'Almiranez', 'Professor', '', '2021-05-11 14:02:52', '2021-05-11 14:02:52', NULL),
(3, 'Blances ', '', 'Sanchez', 'Professor', '', '2021-05-11 14:03:02', '2021-05-11 14:03:02', NULL),
(4, 'Elvin', '', 'Catantan', 'Professor', '', '2021-05-11 14:03:12', '2021-05-11 14:03:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission`
--

CREATE TABLE `permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` int(5) NOT NULL,
  `task_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permission`
--

INSERT INTO `permission` (`id`, `role_id`, `task_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 2, 2, '2021-05-10 21:10:04', '2021-05-10 21:10:04', NULL),
(2, 3, 2, '2021-05-10 21:10:04', '2021-05-10 21:10:04', NULL),
(3, 1, 3, '2021-05-10 21:10:10', '2021-05-10 21:10:10', NULL),
(4, 1, 4, '2021-05-10 21:10:13', '2021-05-10 21:10:13', NULL),
(5, 1, 5, '2021-05-10 21:10:17', '2021-05-10 21:10:17', NULL),
(6, 2, 6, '2021-05-10 21:10:23', '2021-05-10 21:10:23', NULL),
(7, 3, 6, '2021-05-10 21:10:23', '2021-05-10 21:10:23', NULL),
(8, 1, 7, '2021-05-10 21:10:28', '2021-05-10 21:10:28', NULL),
(9, 1, 8, '2021-05-10 21:10:32', '2021-05-10 21:10:32', NULL),
(10, 1, 9, '2021-05-10 21:10:38', '2021-05-10 21:10:38', NULL),
(11, 2, 9, '2021-05-10 21:10:39', '2021-05-10 21:10:39', NULL),
(12, 3, 9, '2021-05-10 21:10:39', '2021-05-10 21:10:39', NULL),
(13, 1, 10, '2021-05-10 21:10:47', '2021-05-10 21:10:47', NULL),
(14, 2, 10, '2021-05-10 21:10:47', '2021-05-10 21:10:47', NULL),
(15, 3, 10, '2021-05-10 21:10:47', '2021-05-10 21:10:47', NULL),
(16, 2, 11, '2021-05-10 21:10:54', '2021-05-10 21:10:54', NULL),
(17, 3, 11, '2021-05-10 21:10:54', '2021-05-10 21:10:54', NULL),
(18, 1, 12, '2021-05-10 21:11:01', '2021-05-10 21:11:01', NULL),
(19, 3, 12, '2021-05-10 21:11:02', '2021-05-10 21:11:02', NULL),
(20, 1, 13, '2021-05-10 21:11:08', '2021-05-10 21:11:08', NULL),
(21, 3, 13, '2021-05-10 21:11:08', '2021-05-10 21:11:08', NULL),
(22, 1, 14, '2021-05-10 21:11:13', '2021-05-10 21:11:13', NULL),
(23, 1, 15, '2021-05-10 21:11:19', '2021-05-10 21:11:19', NULL),
(24, 1, 16, '2021-05-10 21:11:23', '2021-05-10 21:11:23', NULL),
(25, 3, 17, '2021-05-10 21:11:30', '2021-05-10 21:11:30', NULL),
(26, 1, 18, '2021-05-10 21:11:36', '2021-05-10 21:11:36', NULL),
(27, 2, 18, '2021-05-10 21:11:36', '2021-05-10 21:11:36', NULL),
(28, 3, 18, '2021-05-10 21:11:37', '2021-05-10 21:11:37', NULL),
(29, 1, 19, '2021-05-10 21:11:43', '2021-05-10 21:11:43', NULL),
(30, 1, 20, '2021-05-10 21:11:49', '2021-05-10 21:11:49', NULL),
(31, 1, 21, '2021-05-11 13:41:01', '2021-05-11 13:41:01', NULL);

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
  `status` varchar(10) NOT NULL,
  `f_gender` varchar(20) NOT NULL,
  `school_id` varchar(50) NOT NULL,
  `role_id` int(52) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `activation_date` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `professors`
--

CREATE TABLE `professors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `facultycode` varchar(50) NOT NULL,
  `firstname` varchar(100) NOT NULL,
  `middlename` varchar(100) NOT NULL,
  `lastname` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `position` varchar(100) NOT NULL,
  `status` varchar(50) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `professors`
--

INSERT INTO `professors` (`id`, `facultycode`, `firstname`, `middlename`, `lastname`, `birthdate`, `position`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(16, 'FA-00000-TG-0', 'Anna Marie', 'Villanaba', 'Tradio', '1997-07-22', 'IT Faculty', 'Full time', 42, '2021-06-06 21:32:07', '2021-06-06 21:32:07'),
(17, 'FA-00000-TG-0', 'Christine Joy', 'Villanaba', 'Tradio', '2002-03-20', 'President', 'Part-time', 43, '2021-06-06 21:33:03', '2021-06-06 21:33:03');

-- --------------------------------------------------------

--
-- Table structure for table `research_panel`
--

CREATE TABLE `research_panel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `research_id` int(5) NOT NULL,
  `panel_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `research_panel`
--

INSERT INTO `research_panel` (`id`, `research_id`, `panel_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 13, 4, '2021-05-11 16:46:04', '2021-05-11 16:46:04', NULL),
(2, 13, 3, '2021-05-11 16:46:05', '2021-05-11 16:46:05', NULL),
(3, 15, 4, '2021-05-15 20:50:07', '2021-05-15 20:50:07', NULL),
(4, 15, 3, '2021-05-15 20:50:07', '2021-05-15 20:50:07', NULL),
(5, 17, 4, '2021-05-15 23:31:38', '2021-05-15 23:31:38', NULL),
(6, 17, 3, '2021-05-15 23:31:38', '2021-05-15 23:31:38', NULL),
(7, 18, 4, '2021-05-16 22:10:05', '2021-05-16 22:10:05', NULL),
(8, 18, 3, '2021-05-16 22:10:05', '2021-05-16 22:10:05', NULL),
(9, 18, 2, '2021-05-16 22:10:06', '2021-05-16 22:10:06', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_name` varchar(100) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role_name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Admin', '2021-05-10 05:41:31', '2021-05-10 05:41:31', NULL),
(2, 'Student', '2021-05-10 05:41:38', '2021-05-10 05:41:38', NULL),
(3, 'Professor', '2021-05-10 05:41:43', '2021-05-10 05:41:43', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `student_number` varchar(20) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `middlename` varchar(50) NOT NULL,
  `birthdate` date NOT NULL,
  `contact` varchar(15) NOT NULL,
  `academic_status` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `deleted_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_number`, `firstname`, `lastname`, `middlename`, `birthdate`, `contact`, `academic_status`, `course_id`, `user_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(40, '2018-00304-TG-0', 'Bernadette', 'Tradio', 'Villanaba', '1999-07-30', '09494058830', 1, 1, 41, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE `student_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` int(5) NOT NULL,
  `course_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`id`, `student_id`, `course_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, '2021-05-10 19:30:54', '2021-05-10 19:30:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `superadmin`
--

CREATE TABLE `superadmin` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `superadmin`
--

INSERT INTO `superadmin` (`id`, `username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', '17c4520f6cfd1ab53d8745e84681eb49', '2021-05-10 16:42:09', '2021-05-10 16:42:50');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_name` varchar(100) NOT NULL,
  `module_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `task_name`, `module_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Change Password', 2, '2021-05-10 21:02:05', '2021-05-10 21:02:18', '2021-05-10 08:02:18'),
(2, 'Change Password', 3, '2021-05-10 21:02:30', '2021-05-10 21:02:30', NULL),
(3, 'Approve User Account', 2, '2021-05-10 21:02:48', '2021-05-10 21:02:48', NULL),
(4, 'Disapprove User Account', 2, '2021-05-10 21:02:57', '2021-05-10 21:02:57', NULL),
(5, 'Delete Unactivated Account', 2, '2021-05-10 21:03:16', '2021-05-10 21:03:16', NULL),
(6, 'Upload Document', 4, '2021-05-10 21:03:34', '2021-05-10 21:03:34', NULL),
(7, 'Approve Document', 4, '2021-05-10 21:03:42', '2021-05-10 21:03:42', NULL),
(8, 'Disapprove Document', 4, '2021-05-10 21:03:50', '2021-05-10 21:03:50', NULL),
(9, 'View Document', 4, '2021-05-10 21:04:11', '2021-05-10 21:04:11', NULL),
(10, 'Search Document', 4, '2021-05-10 21:04:25', '2021-05-10 21:04:25', NULL),
(11, 'Add to Favorites', 4, '2021-05-10 21:04:44', '2021-05-10 21:04:44', NULL),
(12, 'Add Forum', 5, '2021-05-10 21:05:06', '2021-05-10 21:05:06', NULL),
(13, 'Edit Forum', 5, '2021-05-10 21:05:24', '2021-05-10 21:05:24', NULL),
(14, 'Deactivate Forum', 5, '2021-05-10 21:05:37', '2021-05-10 21:05:37', NULL),
(15, 'Approve Forum', 5, '2021-05-10 21:05:53', '2021-05-10 21:05:53', NULL),
(16, 'Disapprove Forum', 5, '2021-05-10 21:06:01', '2021-05-10 21:06:01', NULL),
(17, 'Approve Research (Adviser)', 4, '2021-05-10 21:07:26', '2021-05-10 21:07:26', NULL),
(18, 'View Analytics', 6, '2021-05-10 21:08:47', '2021-05-10 21:08:47', NULL),
(19, 'Generate Report ', 6, '2021-05-10 21:09:00', '2021-05-10 21:09:00', NULL),
(20, 'View Dashboard', 6, '2021-05-10 21:09:08', '2021-05-10 21:09:08', NULL),
(21, 'Configure', 4, '2021-05-10 21:36:22', '2021-05-10 21:36:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(60) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `birthdate` date NOT NULL,
  `gender` char(10) NOT NULL,
  `valid_id` varchar(100) NOT NULL,
  `academic_status` bigint(20) NOT NULL,
  `academic_year` varchar(50) NOT NULL,
  `batch_year` varchar(50) NOT NULL,
  `student_number` varchar(50) NOT NULL,
  `faculty_code` varchar(50) NOT NULL,
  `faculty_status` varchar(50) NOT NULL,
  `faculty_position` varchar(100) NOT NULL,
  `role_id` int(5) NOT NULL,
  `uniid` varchar(32) NOT NULL,
  `status` varchar(10) NOT NULL,
  `activation_date` datetime DEFAULT current_timestamp(),
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `password`, `first_name`, `middle_name`, `last_name`, `birthdate`, `gender`, `valid_id`, `academic_status`, `academic_year`, `batch_year`, `student_number`, `faculty_code`, `faculty_status`, `faculty_position`, `role_id`, `uniid`, `status`, `activation_date`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '', 'llynttburton08@gmail.com', '$2y$10$Is4MGsLj.w2wIz.vc7tZZectWT6x0ZzWH9ZbjpfxE0QNSKlWVo/XS', 'Lailynette', '', 'Burton', '2021-05-11', 'Female', 'Capture_4.PNG', 0, 'III', '2020-2021', '2018-00484-TG-0', '', '', '', 2, 'fc28d85ec5dc49ec1e57d0adf7bf783a', '1', '2021-05-10 09:06:03', '2021-05-10 19:30:49', '2021-05-10 22:07:43', NULL),
(2, '', 'llynttburton@gmail.com', '$2y$10$8edV5t0NpGbDc/mtXHXbHu8pEkp/uztXvqfLzM3EH/9jxiGUE8Ibe', 'Bernadette', '', 'Tradio', '2021-05-14', 'Male', 'Capture_6.PNG', 0, '', '', '', 'FA00013TG2009', 'Full-time', 'Head of Academic Affairs', 3, '0ce2d3c4131fe9769491d4b37b270724', '1', '2021-05-12 03:48:43', '2021-05-10 06:48:21', '2021-05-12 23:27:20', NULL),
(3, '', 'yuiakuma@yahoo.com', '$2y$10$Lv4B2A10cA0Sh0edDCbITuIvLdTqUMc99PVZYCxWq.DiL0jITJ7Ni', 'Elena', '', 'Mamansag', '2021-05-24', 'Female', 'Capture_7.PNG', 0, '', '', '', '', '', '', 1, '13a414e6831175cc53482161f3d63b18', '1', '2021-05-10 06:54:18', '2021-05-10 19:54:18', '2021-05-10 19:55:33', NULL),
(41, '2018-00304-TG-0', 'bernatrads4@gmail.com', '$2y$10$1uO.sjc1TAV2hVrC1bfS2.S7TFPISC/T7kUz1JZmmw7El9Cd7N2lK', '', '', '', '0000-00-00', '', '', 0, '', '', '', '', '', '', 2, '', '', '2021-06-06 21:21:42', '2021-06-06 08:21:42', '2021-06-06 08:21:42', NULL),
(42, 'FA-00000-TG-0', 'annatradio@gmail.com', '$2y$10$bEcoTUjijfQhlqkcSyfIGec4OC2rUg9.mCCahTvaFIJZ0qotTtpum', '', '', '', '0000-00-00', '', '', 0, '', '', '', '', '', '', 3, '', '', '2021-06-06 21:32:06', '2021-06-06 08:32:06', '2021-06-06 08:32:06', NULL),
(43, 'FA-00000-TG-0', 'tradiobernadette@gmail.com', '$2y$10$uRZ855XyMykoP.EH7cjLU.zgu/PxLEoZogzw5dGd4LpacppIwQGgi', 'Christine Joy', 'Villanaba', 'Tradio', '0000-00-00', '', '', 0, '', '', '', '', '', '', 3, '', '', '2021-06-06 21:33:03', '2021-06-06 08:33:03', '2021-06-06 08:33:03', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_favorite`
--

CREATE TABLE `user_favorite` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(5) NOT NULL,
  `document_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `deleted_at` datetime DEFAULT NULL COMMENT 'Date of soft deletion'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_status`
--
ALTER TABLE `academic_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `academic_year`
--
ALTER TABLE `academic_year`
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
-- Indexes for table `course_document`
--
ALTER TABLE `course_document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_author`
--
ALTER TABLE `document_author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_category`
--
ALTER TABLE `document_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_type`
--
ALTER TABLE `document_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_adviser`
--
ALTER TABLE `faculty_adviser`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty_status`
--
ALTER TABLE `faculty_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `forum`
--
ALTER TABLE `forum`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gender`
--
ALTER TABLE `gender`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `module`
--
ALTER TABLE `module`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `panel`
--
ALTER TABLE `panel`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professors`
--
ALTER TABLE `professors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `professors`
--
ALTER TABLE `professors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
