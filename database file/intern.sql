-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 18, 2019 at 05:32 PM
-- Server version: 10.1.33-MariaDB
-- PHP Version: 7.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `intern`
--

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `batch_id` varchar(30) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT '0',
  `teacher_id` varchar(20) NOT NULL DEFAULT 'Not assigned',
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `semester_id` int(11) NOT NULL DEFAULT '0',
  `req_to_complete` int(1) NOT NULL DEFAULT '0',
  `grade_report_title` varchar(100) NOT NULL DEFAULT '0',
  `grade_report_path` varchar(200) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `batches`
--

INSERT INTO `batches` (`batch_id`, `approved`, `teacher_id`, `date`, `semester_id`, `req_to_complete`, `grade_report_title`, `grade_report_path`) VALUES
('2019-2020,Fall batch 1', 1, 't', '2019-08-06 22:09:32', 2, 0, '0', '0'),
('2019-2020,Fall batch 3', 0, 'Not assigned', '2019-08-06 22:09:32', 2, 0, '0', '0'),
('2019-2020,Fall batch 4', 0, 'Not assigned', '2019-08-06 22:39:12', 2, 0, '0', '0'),
('2019-2020,Summer batch 1', 1, 't', '2019-09-01 07:45:14', 9, 0, '0', '0'),
('2019-2020,Summer batch 2', 1, 'Not assigned', '2019-08-30 15:51:57', 9, 0, '0', '0'),
('2019-2020,Summer batch 3', 1, 'Not assigned', '2019-08-30 15:51:59', 9, 0, '0', '0'),
('2019-2020,Summer batch 4', 0, 'Not assigned', '2019-08-30 15:52:01', 9, 0, '0', '0'),
('2019-2020,Summer batch 5', 0, 'Not assigned', '2019-09-01 07:45:21', 9, 0, '0', '0'),
('2019-2020,Summer batch 6', 0, 'Not assigned', '2019-09-01 07:45:57', 9, 0, '0', '0'),
('2019-2020,Summer batch 7', 0, 'Not assigned', '2019-09-01 07:46:05', 9, 0, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `student_id` varchar(20) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `first_comment` varchar(5000) NOT NULL,
  `final_comment` varchar(5000) NOT NULL DEFAULT 'later',
  `first_comment_date` varchar(30) NOT NULL,
  `final_comment_date` varchar(30) NOT NULL DEFAULT 'later'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`student_id`, `teacher_id`, `first_comment`, `final_comment`, `first_comment_date`, `final_comment_date`) VALUES
('11111', 't', 'ddasdsa', 'dsadsadasdasadsa', '2019-08-28 10:20:11', '2019-08-28 10:20:19'),
('a', 't', 'first', 'second', '2019-07-02 07:20:42', '2019-07-02 07:23:35'),
('b', 't', 'first', 'asdas', '2019-07-02 08:48:23', '2019-07-02 09:06:49'),
('c', 't', 'asdas', 'asdasasdasd', '2019-07-02 09:08:04', '2019-07-02 09:08:11');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_type` varchar(50) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `company_website` varchar(50) NOT NULL,
  `company_contact` int(10) NOT NULL,
  `verified` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`company_id`, `company_name`, `company_type`, `company_address`, `company_website`, `company_contact`, `verified`) VALUES
(1, 'Aiub', 'Univresity', 'kuratoli', 'aiub.edu', 12312, 1),
(11, 't', 't', 't', 'http://www.demo.com', 12312, 0);

-- --------------------------------------------------------

--
-- Table structure for table `evaluations`
--

CREATE TABLE `evaluations` (
  `student_id` varchar(20) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `question_1` varchar(15) NOT NULL,
  `question_2` varchar(15) NOT NULL,
  `question_3` varchar(15) NOT NULL,
  `question_4` varchar(15) NOT NULL,
  `question_5` varchar(15) NOT NULL,
  `question_6` varchar(15) NOT NULL,
  `question_7` varchar(15) NOT NULL,
  `question_8` varchar(15) NOT NULL,
  `question_9` varchar(15) NOT NULL,
  `question_10` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `evaluations`
--

INSERT INTO `evaluations` (`student_id`, `comment`, `question_1`, `question_2`, `question_3`, `question_4`, `question_5`, `question_6`, `question_7`, `question_8`, `question_9`, `question_10`) VALUES
('16-32435-2', 'bad', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction', 'distinction'),
('s', 'sadas', 'good', 'good', 'good', 'good', 'good', 'deficient', 'deficient', 'deficient', 'deficient', 'deficient');

-- --------------------------------------------------------

--
-- Table structure for table `logins`
--

CREATE TABLE `logins` (
  `id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `name` varchar(30) NOT NULL DEFAULT 'later',
  `password` varchar(20) NOT NULL,
  `access_status` tinyint(1) NOT NULL DEFAULT '0',
  `reset_pass` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logins`
--

INSERT INTO `logins` (`id`, `user_id`, `name`, `password`, `access_status`, `reset_pass`) VALUES
(1, 'a', 'test', 'a', 2, '0'),
(2, 't', 'teacher test', 't', 3, '0'),
(3, 's', 'test test', 's', 4, '0'),
(4, 'h', 'Head', 'h', 1, '0'),
(5, '123456', 'bulbul', '2', 4, '0'),
(9, 'b', 'test', 'ntowuKjb', 4, '0'),
(11, 'c', 'teacher three', 'JX5mySQt', 4, '0'),
(13, 'e', 'test', 'hdH8EzXx', 4, '0'),
(20, 'f', 'test', 'vMZuiQGa', 4, '0'),
(21, 'g', 'test', 'mDo28tLx', 4, '0'),
(23, 'i', 'test', 'qD8zFuIY', 4, '0'),
(24, 'p', 'later', 'p', 4, '0'),
(25, '11111', 'x', 'gPeRLtpW', 4, '0'),
(26, 'sa', 'Super Admin', 'sa', 0, '0'),
(27, '16-32435-2', 'monjirul kabir', '1', 4, '0'),
(29, '12-21241-2', 'Md.Al-Amin', '3LXNfa2z', 4, '0');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `notice_id` int(11) NOT NULL,
  `subject` varchar(2000) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`notice_id`, `subject`, `content`, `teacher_id`, `date`) VALUES
(2, 'test', 'test', 't', '2019-07-01 17:57:56');

-- --------------------------------------------------------

--
-- Table structure for table `semesters`
--

CREATE TABLE `semesters` (
  `semester_id` int(11) NOT NULL,
  `semester_name` varchar(20) NOT NULL,
  `start_date` varchar(20) NOT NULL DEFAULT 'later',
  `end_date` varchar(20) NOT NULL DEFAULT 'later',
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semesters`
--

INSERT INTO `semesters` (`semester_id`, `semester_name`, `start_date`, `end_date`, `created_date`, `status`) VALUES
(2, '2019-2020,Fall', 'later', 'later', '2019-06-29 15:42:44', 0),
(3, '2019-2020,Spring', 'later', 'later', '2019-07-01 13:42:24', 0),
(9, '2019-2020,Summer', 'later', 'later', '2019-08-30 14:44:23', 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `student_id` varchar(15) NOT NULL,
  `name` varchar(50) NOT NULL,
  `department` varchar(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNo` bigint(11) NOT NULL,
  `evaluation` varchar(100) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_id`, `name`, `department`, `email`, `mobileNo`, `evaluation`) VALUES
(1, 'a', 'test', 'CSE', 'a@gmail.com', 12312311112, '0'),
(2, 'b', 'test', 'cs', 'b@gmail.com', 12312311112, '0'),
(3, 'c', 'test', 'cse', 'c@gmail.com', 12312311112, '0'),
(4, 'd', 'test', 'cse', 'd@gmail.com', 12312311112, '0'),
(5, 'e', 'test', 'cse', 'e@gmail.com', 12312311112, '0'),
(6, 'f', 'test', 'cse', 'f@gmail.com', 12312311112, '0'),
(7, 'g', 'test', 'cse', 'g@gmail.com', 12312311112, '0'),
(8, 'h', 'test', 'cse', 'h@gmail.com', 12312311112, '0'),
(9, 'i', 'test', 'cse', 'i@gmail.com', 12312311112, '0'),
(10, 'j', 'test', 'cse', 'j@gmail.com', 12312311112, '0'),
(11, 'k', 'test', 'cse', 'k@gmail.com', 12312311112, '0'),
(12, 'l', 'test', 'cse', 'l@gmail.com', 12312311112, '0'),
(13, 'm', 'test', 'cse', 'm@gmail.com', 12312311112, '0'),
(14, 'n', 'test', 'cse', 'n@gmail.com', 12312311112, '0'),
(15, 'o', 'test', 'cse', 'o@gmail.com', 12312311112, '0'),
(16, 'p', 'test', 'cse', 'p@gmail.com', 12312311112, '0'),
(17, 'q', 'test', 'cse', 'q@gmail.com', 12312311112, '0'),
(18, 'r', 'test', 'cse', 'r@gmail.com', 12312311112, '0'),
(20, 't', 'test', 'cse', 't@gmail.com', 12312311112, '0'),
(21, 'u', 'test', 'cse', 'u@gmail.com', 12312311112, '0'),
(23, 'tt', 'test', 'cse', 't@gmail', 12345678901, '0'),
(24, 'z', 'test', 'cse', 'aa@gmail.com', 12312311112, '0'),
(25, '123456', 'bulbul', 'SE', 'mk16324352@gmail.com', 12312311112, '0'),
(26, '1234435', 'asdas', 'asda', 'asda', 12312, '0'),
(27, '123124', 'asda', 'asda', 'asdas', 123, '0'),
(28, '1234354', 'asdasdzasda', 'dasd', 'asdas', 12312, '0'),
(29, '123543453a', 'dasd', 'asd', 'asd', 1231, '0'),
(31, '11111', 'x', 'CSE', 'asdas@gmail.com', 1231231111, '0'),
(32, 's', 'Super ', 'cs', '', 0, '0'),
(34, '16-32435-2', 'monjirul kabir', 'CSE', 'monjirul.kabir.aiub@gmail.com', 1732260546, '2'),
(35, '12-21241-2', 'Md.Al-Amin', 'SE', 'amin.se.aiub@gmail.com', 1710004078, '0'),
(37, '16-32527-2', 'test', 'CSE', 'khalid.has69000@gmail.com', 1521331679, '0'),
(38, '16-32447-2', 'test', 'CSE', '6nasan9@gmail.com', 1521331679, '0'),
(39, '16-32457-2', 'test', 'CSE', '66nasan99@gmail.com', 1521331679, '0'),
(40, '16-32427-1', 'test', 'CSE', 'khalid@gmail.com', 1521331679, '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_enrollments`
--

CREATE TABLE `student_enrollments` (
  `student_id` varchar(20) NOT NULL,
  `credits_left` int(11) NOT NULL DEFAULT '0',
  `subjects_left` int(11) NOT NULL DEFAULT '0',
  `batch_id` varchar(30) NOT NULL DEFAULT '0',
  `TA_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `applied_TA` varchar(20) NOT NULL DEFAULT '0',
  `company_id` int(11) NOT NULL DEFAULT '0',
  `semester_id` int(11) NOT NULL DEFAULT '0',
  `token_no` varchar(100) NOT NULL DEFAULT '0',
  `internship_status` tinyint(1) NOT NULL DEFAULT '0',
  `registration_status` tinyint(1) NOT NULL DEFAULT '0',
  `registration_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `enrollment_date` varchar(30) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_enrollments`
--

INSERT INTO `student_enrollments` (`student_id`, `credits_left`, `subjects_left`, `batch_id`, `TA_confirmed`, `applied_TA`, `company_id`, `semester_id`, `token_no`, `internship_status`, `registration_status`, `registration_date`, `enrollment_date`) VALUES
('11111', 3, 1, '2019-2020,Fall batch 1', 0, '0', 1, 2, '111115d679bcd26517', 0, 0, '2019-08-05 16:58:02', '2019-08-29 09:33:01'),
('12-21241-2', 6, 2, '2019-2020,Summer batch 1', 0, '0', 0, 9, 'expired', 1, 1, '2019-09-01 06:48:25', '2019-09-08 01:17:30'),
('123456', 7, 2, '2019-2020,Fall batch 1', 0, '0', 1, 2, 'expired', 1, 0, '2019-07-23 21:34:54', '0'),
('16-32427-1', 0, 0, '0', 0, '0', 0, 0, '0', 0, 0, '2019-09-04 14:34:47', '0'),
('16-32435-2', 6, 2, '2019-2020,Summer batch 1', 1, 'a', 10, 9, '16-32435-25d7004a03d140', 1, 1, '2019-08-30 14:35:09', '2019-09-04 06:38:24'),
('16-32447-2', 0, 0, '0', 0, '0', 0, 0, '0', 0, 0, '2019-09-04 14:28:43', '0'),
('16-32457-2', 0, 0, '0', 0, '0', 0, 0, '0', 0, 0, '2019-09-04 14:32:58', '0'),
('16-32527-2', 0, 0, '0', 0, '0', 0, 0, '0', 0, 0, '2019-09-04 14:27:19', '0'),
('a', 12, 0, '2019-2020,Fall batch 1', 0, '0', 0, 2, 'expired', 1, 1, '2019-07-01 12:47:15', '2019-08-05 06:50:00'),
('b', 12, 0, '2019-2020,Fall batch 1', 0, '0', 0, 2, 'expired', 1, 1, '2019-07-01 12:47:36', '2019-08-05 06:55:56'),
('c', 12, 0, '2019-2020,Fall batch 1', 0, '0', 0, 2, 'expired', 1, 1, '2019-07-01 12:48:25', '2019-08-05 06:55:57'),
('d', 12, 0, '2019-2020,Fall batch 1', 0, '0', 0, 2, 'expired', 1, 0, '2019-07-01 12:48:42', '2019-08-05 06:55:56'),
('e', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 1, '2019-07-01 12:48:59', '0'),
('f', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 1, '2019-07-01 12:49:20', '0'),
('g', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 1, '2019-07-01 12:49:35', '0'),
('h', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 1, '2019-07-01 12:49:50', '0'),
('i', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 1, '2019-07-01 12:50:11', '0'),
('j', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:50:28', '0'),
('k', 12, 0, '0', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:50:54', '0'),
('l', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:51:12', '0'),
('m', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:51:26', '0'),
('n', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:51:49', '0'),
('o', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:52:06', '0'),
('p', 12, 4, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 1, 1, '2019-07-01 12:52:20', '2019-08-05 04:52:11'),
('q', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:52:32', '0'),
('r', 12, 0, '2019-2020,Fall batch 3', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:52:49', '0'),
('s', 12, 4, '2019-2020,Summer batch 1', 0, '0', 0, 9, 's5d7004a08b742', 1, 1, '2019-07-01 12:53:09', '2019-09-04 06:38:24'),
('t', 12, 0, '2019-2020,Fall batch 4', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-01 12:53:40', '0'),
('tt', 12, 2, '2019-2020,Fall batch 4', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-17 13:56:50', '0'),
('u', 12, 0, '2019-2020,Fall batch 4', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-04 04:37:35', '0'),
('z', 12, 2, '0', 0, '0', 0, 2, 'expired', 0, 0, '2019-07-17 17:13:31', '0');

-- --------------------------------------------------------

--
-- Table structure for table `student_uploads`
--

CREATE TABLE `student_uploads` (
  `student_id` varchar(20) NOT NULL,
  `cv_title` varchar(100) NOT NULL,
  `appointment_letter_title` varchar(100) NOT NULL DEFAULT 'later',
  `book_report_title` varchar(100) NOT NULL DEFAULT 'later',
  `cv_path` varchar(200) NOT NULL,
  `appointment_letter_path` varchar(200) NOT NULL DEFAULT 'later',
  `book_report_path` varchar(200) NOT NULL DEFAULT 'later',
  `cv_upload_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `apl_upload_date` varchar(30) NOT NULL DEFAULT 'later',
  `book_report_upload_date` varchar(30) NOT NULL DEFAULT 'later'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student_uploads`
--

INSERT INTO `student_uploads` (`student_id`, `cv_title`, `appointment_letter_title`, `book_report_title`, `cv_path`, `appointment_letter_path`, `book_report_path`, `cv_upload_date`, `apl_upload_date`, `book_report_upload_date`) VALUES
('11111', 'later', 'later', 'later', 'later', 'later', 'later', '2019-08-05 17:11:49', 'later', 'later'),
('123456', 'Admin.pdf', 'Admin.pdf', 'later', 'public/storage/hYjKW5yn6b7yhGSaUdscj5hhmunkFpxocTFyJ02n.pdf', 'public/storage/kg9ZU60yu4EVDpcdqPPc75rzpfQL7zi1GfJHLbJ5.pdf', 'later', '2019-07-23 21:47:04', '2019-07-23 09:47:14', '2019-07-23 09:47:30'),
('16-32435-2', 'Mushfiq Hossain signature.JPG', 'Mushfiq Hossain upload.jpg', 'Mushfiq Hossain upload.jpg', 'public/storage/Xdq0uX2hRDZO8ZRjPRUUApqOkJpsaiFg5JJR9Kjd.jpeg', 'public/storage/MHFsz98h2JXYd5ZXET40gdySZ2G9SnKmVgNg1EjB.jpeg', 'public/storage/ye0ygXdppZhuZB1dKJ2j90aplw8xqZYhUMdq2Keq.jpeg', '2019-08-30 16:26:01', '2019-08-31 04:23:58', '2019-08-31 04:22:44'),
('s', 'Admin.pdf', 'Admin.pdf', 'later', 'public/storage/HRrEVtbBvzC7Uca0hmVrpLaLIIpbN8bgGBSeOoLJ.pdf', 'public/storage/lJtZxVYvmysqoHQEnubMEPXQE3Y6gYV7C2kdzT4a.pdf', 'later', '2019-07-03 08:05:56', '2019-07-03 08:12:26', '2019-07-03 08:12:44');

-- --------------------------------------------------------

--
-- Table structure for table `supervisors`
--

CREATE TABLE `supervisors` (
  `supervisor_id` int(11) NOT NULL,
  `supervisor_name` varchar(100) NOT NULL,
  `supervisor_number` varchar(10) NOT NULL,
  `supervisor_email` varchar(320) NOT NULL,
  `supervisor_designation` varchar(50) NOT NULL,
  `assigned_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `supervisors`
--

INSERT INTO `supervisors` (`supervisor_id`, `supervisor_name`, `supervisor_number`, `supervisor_email`, `supervisor_designation`, `assigned_date`, `student_id`) VALUES
(2, 't', '2344232323', 'khalid.hasan69000@gmail.com', 't', '2019-08-30 16:46:10', '16-32435-2');

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `teacher_id` varchar(20) NOT NULL,
  `require_TA` tinyint(1) NOT NULL DEFAULT '0',
  `TA_position` varchar(20) NOT NULL DEFAULT '0',
  `TA_vacancy` int(2) NOT NULL DEFAULT '0',
  `TA_courses` varchar(500) NOT NULL DEFAULT '0',
  `access_status` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobileNo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`id`, `name`, `teacher_id`, `require_TA`, `TA_position`, `TA_vacancy`, `TA_courses`, `access_status`, `email`, `mobileNo`) VALUES
(1, 'teacher test', 't', 1, 'Teacher Assistance', 0, 'CN\nACN\nWebtech', 3, 'aa@gmail.com', 1231),
(3, 'teacher three', 'c', 0, '0', 0, '', 3, 'c@gmail.com', 1231),
(4, 'admin', 'a', 1, 'TA', 10, 'haksdjalshdlashfasf', 2, 'asdas@gmail.com', 123123);

-- --------------------------------------------------------

--
-- Table structure for table `temp_companies`
--

CREATE TABLE `temp_companies` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `company_id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `company_type` varchar(50) NOT NULL,
  `company_address` varchar(200) NOT NULL,
  `company_website` varchar(50) NOT NULL,
  `company_contact` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_companies`
--

INSERT INTO `temp_companies` (`id`, `student_id`, `company_id`, `company_name`, `company_type`, `company_address`, `company_website`, `company_contact`) VALUES
(11, 's', 1, 'Aiub', 'Univresityaaaaaaa', 'kuratoli', 'aiub.edu', 12312);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`batch_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `evaluations`
--
ALTER TABLE `evaluations`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `logins`
--
ALTER TABLE `logins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `semesters`
--
ALTER TABLE `semesters`
  ADD PRIMARY KEY (`semester_id`),
  ADD UNIQUE KEY `semester_name` (`semester_name`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `student_enrollments`
--
ALTER TABLE `student_enrollments`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_uploads`
--
ALTER TABLE `student_uploads`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `supervisors`
--
ALTER TABLE `supervisors`
  ADD PRIMARY KEY (`supervisor_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temp_companies`
--
ALTER TABLE `temp_companies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logins`
--
ALTER TABLE `logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `semesters`
--
ALTER TABLE `semesters`
  MODIFY `semester_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `supervisors`
--
ALTER TABLE `supervisors`
  MODIFY `supervisor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `temp_companies`
--
ALTER TABLE `temp_companies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
