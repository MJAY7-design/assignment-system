-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Apr 28, 2026 at 01:05 AM
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
-- Database: `assignment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments`
--

CREATE TABLE `assignments` (
  `assignment_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assignments`
--

INSERT INTO `assignments` (`assignment_id`, `course_id`, `title`, `description`, `due_date`, `file_path`) VALUES
(1, 1, 'HTML Assignment', 'Build a simple webpage', '2026-05-10', 'html.pdf'),
(2, 2, 'Ethical Hacking Assignment', 'Explain penetration testing', '2026-05-12', 'hacking.pdf'),
(3, 3, 'Software Engineering Assignment', 'Explain SDLC', '2026-05-15', 'sdlc.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(100) DEFAULT NULL,
  `lecturer_email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `lecturer_email`) VALUES
(1, 'Web Development', 'lecturer@test.com'),
(2, 'Ethical Hacking', 'lecturer@test.com'),
(3, 'Software Engineering', 'lecturer@test.com');

-- --------------------------------------------------------

--
-- Table structure for table `enrollments`
--

CREATE TABLE `enrollments` (
  `enrollment_id` int(11) NOT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrollments`
--

INSERT INTO `enrollments` (`enrollment_id`, `student_email`, `course_id`) VALUES
(1, 'student@test.com', 1),
(2, 'student@test.com', 2),
(3, 'student@test.com', 3);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `uploaded_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `course_id`, `title`, `file_path`, `uploaded_at`) VALUES
(1, 1, 'Intro to HTML Slides', 'uploads/html_intro.pdf', '2026-04-26 16:24:23');

-- --------------------------------------------------------

--
-- Table structure for table `submissions`
--

CREATE TABLE `submissions` (
  `submission_id` int(11) NOT NULL,
  `assignment_id` int(11) DEFAULT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `submissions`
--

INSERT INTO `submissions` (`submission_id`, `assignment_id`, `student_email`, `file_path`, `grade`, `feedback`) VALUES
(1, 1, 'student@test.com', 'mark mammie lt review.docx', 87, 'Well explained. Consider improving structure and adding deeper insights.'),
(2, 2, 'student@test.com', 'DxDiag.txt', 79, 'Well explained. Consider improving structure and adding deeper insights.'),
(3, 3, 'student@test.com', 'puis23210022 (AutoRecovered).docx', 85, 'Well explained. Consider improving structure and adding deeper insights.');

-- --------------------------------------------------------

--
-- Table structure for table `tests`
--

CREATE TABLE `tests` (
  `test_id` int(11) NOT NULL,
  `course_id` int(11) DEFAULT NULL,
  `question` text DEFAULT NULL,
  `option_a` varchar(255) DEFAULT NULL,
  `option_b` varchar(255) DEFAULT NULL,
  `option_c` varchar(255) DEFAULT NULL,
  `option_d` varchar(255) DEFAULT NULL,
  `correct_answer` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tests`
--

INSERT INTO `tests` (`test_id`, `course_id`, `question`, `option_a`, `option_b`, `option_c`, `option_d`, `correct_answer`) VALUES
(1, 2, 'What is ethical hacking?', 'Illegal hacking', 'Testing security legally', 'Destroying systems', 'Creating malware', 'B'),
(2, 2, 'Which tool is used for network scanning?', 'Photoshop', 'Nmap', 'Word', 'Excel', 'B'),
(3, 2, 'What does VPN stand for?', 'Virtual Private Network', 'Very Private Node', 'Verified Protocol Network', 'Virtual Protocol Node', 'A'),
(4, 2, 'Which attack uses many password attempts?', 'Phishing', 'Brute force', 'Sniffing', 'Spoofing', 'B'),
(5, 2, 'What is phishing?', 'Network scanning', 'Fake message to steal data', 'Password encryption', 'Firewall setup', 'B'),
(6, 2, 'What does a firewall do?', 'Stores files', 'Blocks unauthorized access', 'Deletes viruses', 'Creates accounts', 'B'),
(7, 2, 'Which is a strong password?', '123456', 'password', 'Admin123', 'T3ch@2024!', 'D'),
(8, 2, 'What is malware?', 'Security tool', 'Harmful software', 'Database system', 'Web server', 'B'),
(9, 2, 'SQL Injection targets what?', 'Network cables', 'Database', 'Hardware', 'Monitor', 'B'),
(10, 2, 'Who is a white-hat hacker?', 'Criminal hacker', 'Security tester', 'Student', 'Programmer', 'B'),
(11, 2, 'What is social engineering?', 'Coding technique', 'Human manipulation attack', 'Database design', 'Encryption', 'B'),
(12, 2, 'Which tool captures packets?', 'Wireshark', 'Chrome', 'Excel', 'Word', 'A'),
(13, 2, 'What is encryption?', 'Deleting files', 'Securing data', 'Copying files', 'Scanning ports', 'B'),
(14, 2, 'Which protocol is secure?', 'HTTP', 'FTP', 'HTTPS', 'Telnet', 'C'),
(15, 2, 'What is brute force?', 'Guessing passwords repeatedly', 'Deleting files', 'Scanning devices', 'Creating software', 'A'),
(16, 2, 'Which attack tricks users?', 'Phishing', 'Firewall', 'VPN', 'Encryption', 'A'),
(17, 2, 'What does antivirus do?', 'Hack systems', 'Protect against malware', 'Delete users', 'Encrypt passwords', 'B'),
(18, 2, 'Which is a hacking framework?', 'Metasploit', 'PowerPoint', 'Excel', 'Paint', 'A'),
(19, 2, 'What is penetration testing?', 'Legal security testing', 'Illegal hacking', 'Data entry', 'Networking', 'A'),
(20, 2, 'What is sniffing?', 'Reading network traffic', 'Deleting files', 'Coding', 'Designing UI', 'A');

-- --------------------------------------------------------

--
-- Table structure for table `test_results`
--

CREATE TABLE `test_results` (
  `result_id` int(11) NOT NULL,
  `student_email` varchar(100) DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `feedback` text DEFAULT NULL,
  `date_taken` timestamp NOT NULL DEFAULT current_timestamp(),
  `answers` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `test_results`
--

INSERT INTO `test_results` (`result_id`, `student_email`, `score`, `total`, `feedback`, `date_taken`, `answers`) VALUES
(1, 'student@test.com', 17, 20, NULL, '2026-04-26 17:42:52', '{\"1\":\"B\",\"2\":\"B\",\"3\":\"A\",\"4\":\"A\",\"5\":\"B\",\"6\":\"B\",\"7\":\"D\",\"8\":\"B\",\"9\":\"B\",\"10\":\"B\",\"11\":\"B\",\"12\":\"A\",\"13\":\"B\",\"14\":\"A\",\"15\":\"A\",\"16\":\"A\",\"17\":\"B\",\"18\":\"A\",\"19\":\"C\",\"20\":\"A\"}'),
(2, 'student@test.com', 17, 20, NULL, '2026-04-26 17:47:08', '{\"1\":\"B\",\"2\":\"B\",\"3\":\"A\",\"4\":\"A\",\"5\":\"B\",\"6\":\"B\",\"7\":\"D\",\"8\":\"B\",\"9\":\"B\",\"10\":\"B\",\"11\":\"B\",\"12\":\"A\",\"13\":\"B\",\"14\":\"A\",\"15\":\"A\",\"16\":\"A\",\"17\":\"B\",\"18\":\"A\",\"19\":\"C\",\"20\":\"A\"}'),
(3, 'student@test.com', 19, 20, NULL, '2026-04-27 14:46:32', '{\"1\":\"B\",\"2\":\"B\",\"3\":\"A\",\"4\":\"A\",\"5\":\"B\",\"6\":\"B\",\"7\":\"D\",\"8\":\"B\",\"9\":\"B\",\"10\":\"B\",\"11\":\"B\",\"12\":\"A\",\"13\":\"B\",\"14\":\"C\",\"15\":\"A\",\"16\":\"A\",\"17\":\"B\",\"18\":\"A\",\"19\":\"A\",\"20\":\"A\"}');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('student','lecturer') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(1, 'John Doe', 'lecturer@test.com', '1234', 'lecturer'),
(2, 'John Doe', 'student@test.com', '1234', 'student');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments`
--
ALTER TABLE `assignments`
  ADD PRIMARY KEY (`assignment_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `enrollments`
--
ALTER TABLE `enrollments`
  ADD PRIMARY KEY (`enrollment_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `submissions`
--
ALTER TABLE `submissions`
  ADD PRIMARY KEY (`submission_id`);

--
-- Indexes for table `tests`
--
ALTER TABLE `tests`
  ADD PRIMARY KEY (`test_id`);

--
-- Indexes for table `test_results`
--
ALTER TABLE `test_results`
  ADD PRIMARY KEY (`result_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments`
--
ALTER TABLE `assignments`
  MODIFY `assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `enrollments`
--
ALTER TABLE `enrollments`
  MODIFY `enrollment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `submissions`
--
ALTER TABLE `submissions`
  MODIFY `submission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tests`
--
ALTER TABLE `tests`
  MODIFY `test_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `test_results`
--
ALTER TABLE `test_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
