-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2026 at 08:03 PM
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
-- Database: `db_pathseeker`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_bookmarks`
--

CREATE TABLE `tbl_bookmarks` (
  `bookmark_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_careers`
--

CREATE TABLE `tbl_careers` (
  `career_id` int(11) NOT NULL,
  `career_name` varchar(150) NOT NULL,
  `description` text DEFAULT NULL,
  `required_education` varchar(200) DEFAULT NULL,
  `required_skills` text DEFAULT NULL,
  `salary_range` varchar(100) DEFAULT NULL,
  `career_scope` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_careers`
--

INSERT INTO `tbl_careers` (`career_id`, `career_name`, `description`, `required_education`, `required_skills`, `salary_range`, `career_scope`, `created_at`) VALUES
(1, 'Front-End Developer', 'Builds interactive and responsive user interfaces for websites.', 'Bachelors in CS/SE', 'HTML, CSS, JavaScript, React', 'PKR 80,000 - 250,000', 'Massive demand globally.', '2026-08-27 09:58:37'),
(2, 'UI/UX Designer', 'Focuses on user experience and visual design to make products intuitive.', 'Bachelors in Design', 'Figma, Adobe XD, User Research', 'PKR 70,000 - 200,000', 'High demand in product companies.', '2026-08-27 09:58:37'),
(3, 'Data Analyst', 'Collects and analyzes data to help businesses make decisions.', 'Bachelors in Statistics/CS', 'Python, SQL, Power BI', 'PKR 90,000 - 300,000', 'Core role in AI/ML companies.', '2026-08-27 09:58:37'),
(4, 'Cybersecurity Analyst', 'Protects systems and networks from cyber threats.', 'Bachelors in CS/Cybersecurity', 'Network Security, Kali Linux', 'PKR 100,000 - 350,000', 'Critical demand worldwide.', '2026-08-27 09:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_feedback`
--

CREATE TABLE `tbl_feedback` (
  `feedback_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profiles`
--

CREATE TABLE `tbl_profiles` (
  `profile_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `education` varchar(150) DEFAULT NULL,
  `skills` text DEFAULT NULL,
  `interests` text DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `bio` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_options`
--

CREATE TABLE `tbl_quiz_options` (
  `option_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `option_text` varchar(255) NOT NULL,
  `career_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quiz_options`
--

INSERT INTO `tbl_quiz_options` (`option_id`, `question_id`, `option_text`, `career_id`) VALUES
(1, 1, 'Building interactive websites and web apps', 1),
(2, 1, 'Designing beautiful user interfaces', 2),
(3, 1, 'Working with data to find patterns', 3),
(4, 1, 'Securing systems and finding vulnerabilities', 4),
(5, 2, 'Coding and programming languages', 1),
(6, 2, 'Creativity and visual design', 2),
(7, 2, 'Mathematics and logical reasoning', 3),
(8, 2, 'Problem-solving and network defense', 4),
(9, 3, 'Dynamic tech companies with rapid releases', 1),
(10, 3, 'Creative agencies or freelance', 2),
(11, 3, 'Office-based analytical teams', 3),
(12, 3, 'Fast-paced security operations centers', 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_questions`
--

CREATE TABLE `tbl_quiz_questions` (
  `question_id` int(11) NOT NULL,
  `question_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quiz_questions`
--

INSERT INTO `tbl_quiz_questions` (`question_id`, `question_text`, `created_at`) VALUES
(1, 'What type of work do you enjoy most?', '2026-08-27 10:04:41'),
(2, 'Which skill is your strongest?', '2026-08-27 10:04:41'),
(3, 'What work environment suits you best?', '2026-08-27 10:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_quiz_results`
--

CREATE TABLE `tbl_quiz_results` (
  `result_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_id` int(11) NOT NULL,
  `match_percentage` decimal(5,2) NOT NULL,
  `taken_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_quiz_results`
--

INSERT INTO `tbl_quiz_results` (`result_id`, `user_id`, `career_id`, `match_percentage`, `taken_at`) VALUES
(1, 10, 3, 66.67, '2026-08-27 15:44:31'),
(2, 10, 1, 100.00, '2026-08-27 15:48:40'),
(3, 10, 1, 100.00, '2026-08-27 15:52:20'),
(4, 10, 1, 66.67, '2026-08-27 16:12:06'),
(5, 10, 4, 66.67, '2026-08-27 16:18:29'),
(6, 10, 2, 100.00, '2026-08-27 16:22:11'),
(7, 10, 2, 100.00, '2026-08-27 17:42:22'),
(8, 10, 1, 33.33, '2026-08-27 17:46:18'),
(9, 10, 1, 33.33, '2026-08-27 17:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_recommendations`
--

CREATE TABLE `tbl_recommendations` (
  `recommendation_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `career_id` int(11) NOT NULL,
  `recommendation_text` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_recommendations`
--

INSERT INTO `tbl_recommendations` (`recommendation_id`, `user_id`, `career_id`, `recommendation_text`, `created_at`) VALUES
(1, 10, 3, 'Based on your answers, we recommend Data Analyst (66.67% match).', '2026-08-27 15:44:31'),
(2, 10, 1, 'Based on your answers, we recommend Front-End Developer (100% match).', '2026-08-27 15:48:40'),
(3, 10, 1, 'Based on your answers, we recommend Front-End Developer (100% match).', '2026-08-27 15:52:20'),
(4, 10, 1, 'Based on your answers, we recommend Front-End Developer (66.67% match).', '2026-08-27 16:12:06'),
(5, 10, 4, 'Based on your answers, we recommend Cybersecurity Analyst (66.67% match).', '2026-08-27 16:18:29'),
(6, 10, 2, 'Based on your answers, we recommend UI/UX Designer (100% match).', '2026-08-27 16:22:11'),
(7, 10, 2, 'Based on your answers, we recommend UI/UX Designer (100% match).', '2026-08-27 17:42:22'),
(8, 10, 1, 'Based on your answers, we recommend Front-End Developer (33.33% match).', '2026-08-27 17:46:18'),
(9, 10, 1, 'Based on your answers, we recommend Front-End Developer (33.33% match).', '2026-08-27 17:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_resources`
--

CREATE TABLE `tbl_resources` (
  `resource_id` int(11) NOT NULL,
  `career_id` int(11) NOT NULL,
  `resource_title` varchar(200) NOT NULL,
  `resource_type` enum('course','book','video','article','website') NOT NULL,
  `resource_link` varchar(500) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_resources`
--

INSERT INTO `tbl_resources` (`resource_id`, `career_id`, `resource_title`, `resource_type`, `resource_link`, `description`, `created_at`) VALUES
(1, 1, 'Meta Front-End Developer Certificate', 'course', 'https://www.coursera.org/professional-certificates/meta-front-end-developer', 'Complete front-end development course by Meta on Coursera.', '2026-08-27 10:08:16'),
(2, 2, 'Google UX Design Certificate', 'course', 'https://www.coursera.org/professional-certificates/google-ux-design', 'Entry-level UX design course by Google.', '2026-08-27 10:08:16'),
(3, 3, 'IBM Data Analyst Certificate', 'course', 'https://www.coursera.org/professional-certificates/ibm-data-analyst', 'Learn Python, SQL, and data visualization.', '2026-08-27 10:08:16'),
(4, 4, 'Google Cybersecurity Certificate', 'course', 'https://www.coursera.org/professional-certificates/google-cybersecurity', 'Hands-on cybersecurity training by Google.', '2026-08-27 10:08:16');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_success_stories`
--

CREATE TABLE `tbl_success_stories` (
  `story_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `person_name` varchar(100) NOT NULL,
  `person_title` varchar(150) DEFAULT NULL,
  `story_text` text NOT NULL,
  `image_url` varchar(500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('student','graduate','professional','admin') DEFAULT 'student',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `full_name`, `email`, `password`, `role`, `created_at`) VALUES
(10, 'hamza arshad', 'bachaparty2318@gmail.com', '$2y$10$gbXYJuO.K/ofLox868DfZ.lJAsXQw1Xmcpd6OGvQrdgCIpsirN3M2', 'student', '2026-08-27 15:38:53'),
(11, 'techtrio', 'techtrio194@gmail.com', '$2y$10$N8dNbnFbpkArCpatM4X2HOojIl5fJVX702JlC1IuiJhk4wNe3riV.', 'student', '2026-08-27 17:55:59');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_bookmarks`
--
ALTER TABLE `tbl_bookmarks`
  ADD PRIMARY KEY (`bookmark_id`),
  ADD UNIQUE KEY `unique_bookmark` (`user_id`,`career_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `tbl_careers`
--
ALTER TABLE `tbl_careers`
  ADD PRIMARY KEY (`career_id`);

--
-- Indexes for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD PRIMARY KEY (`feedback_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD PRIMARY KEY (`profile_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_quiz_options`
--
ALTER TABLE `tbl_quiz_options`
  ADD PRIMARY KEY (`option_id`),
  ADD KEY `question_id` (`question_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `tbl_quiz_questions`
--
ALTER TABLE `tbl_quiz_questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `tbl_quiz_results`
--
ALTER TABLE `tbl_quiz_results`
  ADD PRIMARY KEY (`result_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `tbl_recommendations`
--
ALTER TABLE `tbl_recommendations`
  ADD PRIMARY KEY (`recommendation_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `tbl_resources`
--
ALTER TABLE `tbl_resources`
  ADD PRIMARY KEY (`resource_id`),
  ADD KEY `career_id` (`career_id`);

--
-- Indexes for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  ADD PRIMARY KEY (`story_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_bookmarks`
--
ALTER TABLE `tbl_bookmarks`
  MODIFY `bookmark_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_careers`
--
ALTER TABLE `tbl_careers`
  MODIFY `career_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  MODIFY `profile_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_quiz_options`
--
ALTER TABLE `tbl_quiz_options`
  MODIFY `option_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tbl_quiz_questions`
--
ALTER TABLE `tbl_quiz_questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_quiz_results`
--
ALTER TABLE `tbl_quiz_results`
  MODIFY `result_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_recommendations`
--
ALTER TABLE `tbl_recommendations`
  MODIFY `recommendation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_resources`
--
ALTER TABLE `tbl_resources`
  MODIFY `resource_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  MODIFY `story_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_bookmarks`
--
ALTER TABLE `tbl_bookmarks`
  ADD CONSTRAINT `tbl_bookmarks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_bookmarks_ibfk_2` FOREIGN KEY (`career_id`) REFERENCES `tbl_careers` (`career_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_feedback`
--
ALTER TABLE `tbl_feedback`
  ADD CONSTRAINT `tbl_feedback_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `tbl_profiles`
--
ALTER TABLE `tbl_profiles`
  ADD CONSTRAINT `tbl_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`);

--
-- Constraints for table `tbl_quiz_options`
--
ALTER TABLE `tbl_quiz_options`
  ADD CONSTRAINT `tbl_quiz_options_ibfk_1` FOREIGN KEY (`question_id`) REFERENCES `tbl_quiz_questions` (`question_id`),
  ADD CONSTRAINT `tbl_quiz_options_ibfk_2` FOREIGN KEY (`career_id`) REFERENCES `tbl_careers` (`career_id`);

--
-- Constraints for table `tbl_quiz_results`
--
ALTER TABLE `tbl_quiz_results`
  ADD CONSTRAINT `tbl_quiz_results_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_quiz_results_ibfk_2` FOREIGN KEY (`career_id`) REFERENCES `tbl_careers` (`career_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_recommendations`
--
ALTER TABLE `tbl_recommendations`
  ADD CONSTRAINT `tbl_recommendations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tbl_recommendations_ibfk_2` FOREIGN KEY (`career_id`) REFERENCES `tbl_careers` (`career_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_resources`
--
ALTER TABLE `tbl_resources`
  ADD CONSTRAINT `tbl_resources_ibfk_1` FOREIGN KEY (`career_id`) REFERENCES `tbl_careers` (`career_id`) ON DELETE CASCADE;

--
-- Constraints for table `tbl_success_stories`
--
ALTER TABLE `tbl_success_stories`
  ADD CONSTRAINT `tbl_success_stories_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `tbl_users` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
