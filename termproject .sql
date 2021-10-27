-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 27, 2021 at 02:44 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `termproject`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `code` varchar(6) NOT NULL,
  `name` varchar(35) NOT NULL,
  `subjects_code` varchar(6) DEFAULT NULL,
  `teacher_id` varchar(6) NOT NULL,
  `course_des` varchar(500) NOT NULL,
  `id` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`code`, `name`, `subjects_code`, `teacher_id`, `course_des`, `id`, `created_at`, `updated_at`) VALUES
('COU001', 'Algebra 1', 'SUB001', 'TEA001', 'Algebra 1- consists of the general concepts of algebra. \r\nIt introduces evaluating equations and inequalities, \r\nreal numbers, and their properties, which include additive \r\nand multiplicative identities, inverse operations, \r\nand the distributive and commutative properties.', 1, NULL, NULL),
('COU002', 'Algebra 2', 'SUB002', 'TEA001', 'Algebra 2 is the third math course in high school and \r\nwill guide you through among other things linear equations, \r\ninequalities, graphs, matrices, polynomials and \r\nradical expressions, quadratic equations, functions, \r\nexponential and logarithmic expressions, sequences and series, \r\nprobability and trigonometry.', 2, NULL, NULL),
('COU003', 'Trigonometry', 'SUB001', 'TEA002', 'Trigonometry, the branch of mathematics concerned with\r\nspecific functions of angles and their application to calculations. \r\nThere are six functions of an angle commonly used in trigonometry. \r\nTheir names and abbreviations are sine (sin), cosine (cos), \r\ntangent (tan), cotangent (cot), secant (sec), and cosecant (csc).', 3, NULL, NULL),
('COU004', 'Precalculus', 'SUB001', 'TEA003', 'Pre-Calculus is the preparation for Calculus. \r\nThe course approaches topics from a function point of view, \r\nwhere appropriate, and is designed to strengthen and \r\nenhance conceptual understanding and mathematical reasoning \r\nused when modeling and solving mathematical and real-world problems.', 4, NULL, NULL),
('COU005', 'Calculus 1', 'SUB001', 'TEA003', 'Involves a study of limits, continuity, derivatives and integrals; \r\ncomputations of derivatives—sum, product, and quotient formulas, \r\nchain rule, implicit differentiation, applications of derivatives to \r\noptimization problems and related rate problems; mean-value theorem; \r\ndefinite integrals and the fundamental theorem of calculus; \r\napplication of definite integrals to computations of areas and volumes.', 5, NULL, NULL),
('COU006', 'Calculus 2', 'SUB001', 'TEA003', 'Topics include techniques of integration, \r\napplications of the definite integral,\r\nimproper integrals, an introduction to differential equations, \r\nconvergence of sequences and series, Taylor series, \r\nparametric equations, and polar coordinates.', 6, NULL, NULL),
('COU007', 'Linear algebra', 'SUB001', 'TEA001', 'This course covers matrix theory and linear algebra, \nemphasizing topics useful in other disciplines. \nLinear algebra is a branch of mathematics that studies systems of \nlinear equations and the properties of matrices. \nThe concepts of linear algebra are extremely useful in physics, \neconomics and social sciences, natural sciences, and engineering. \nDue to its broad range of applications.\n', 7, NULL, NULL),
('COU008', 'Statistics and probability', 'SUB001', 'TEA004', 'Probability & Statistics introduces students to \r\nthe basic concepts and logic of statistical reasoning and \r\ngives the students introductory-level practical ability to choose, \r\ngenerate, and properly interpret appropriate descriptive and \r\ninferential methods.', 8, NULL, NULL),
('COU009', ' Basic geometry and measurement', 'SUB001', 'TEA002', 'Measurement and Geometry are inextricably related. When students measure, \r\nthey are measuring two-dimensional shapes and three-dimensional objects. \r\nThe properties of the shapes and objects dictate how they are measured.', 9, NULL, NULL),
('COU010', 'Fundamental Mathematics 1', 'SUB001', 'TEA005', 'Fundamentals of Mathematics is designed for the student \r\nwho needs to improve or review basic ', 10, NULL, NULL),
('COU011', 'Fundamental Mathematics 2', 'SUB001', 'TEA005', 'Fundamentals of Mathematics is designed for the student \r\nwho needs to improve or review basic ', 11, NULL, NULL),
('COU012', 'Fundamental Mathematics 3', 'SUB001', 'TEA005', 'Fundamentals of Mathematics is designed for the student \r\nwho needs to improve or review basic ', 12, NULL, NULL),
('COU013', ' High school biology', 'SUB002', 'TEA006', 'This course includes a study of living organisms and vital processes. \r\nThemes that will be covered in this course include scientific skills, \r\necology, biochemistry, cellular processes, genetics, evolution, \r\nclassification of organisms, as well as plant and human body systems.', 13, NULL, NULL),
('COU014', 'Organic Chemistry', 'SUB002', 'TEA007', 'This course provides a systematic study of the theories, principles, \r\nand techniques of organic chemistry. Topics include nomenclature, \r\nstructure, properties, reactions, and mechanisms of hydrocarbons, \r\nalkyl halides, alcohols, and ethers; further topics include isomerization, stereochemistry, and spectroscopy. ', 14, NULL, NULL),
('COU015', 'Physics 1', 'SUB002', 'TEA008', 'Physics 1 is an algebra-based, introductory college-level physics course. \r\nStudents cultivate their understanding of physics through classroom study, \r\nin-class activity, and hands-on, inquiry-based laboratory work as \r\nthey explore concepts like systems, fields, force interactions, \r\nchange, conservation, and waves.', 15, NULL, NULL),
('COU016', 'Physics 2', 'SUB002', 'TEA008', 'Physics 2 is an algebra-based, introductory college-level physics course\r\nin which students explore fluid statics and dynamics; \r\nthermodynamics with kinetic theory; PV diagrams and probability; \r\nelectrostatics; electrical circuits with capacitors; magnetic fields; \r\nelectromagnetism; physical and geometric optics; and quantum, atomic, \r\nand nuclear physics. Through inquiry-based learning, \r\nstudents develop scientific critical thinking and reasoning skills.', 16, NULL, NULL),
('COU017', 'Cosmology and astronomy', 'SUB002', 'TEA009', 'Cosmology is a branch of astronomy that involves the origin and evolution \r\nof the universe, from the Big Bang to today and on into the future. \r\nAccording to NASA, the definition of cosmology is \r\n\"the scientific study of the large scale properties of the universe as a whole.\"', 17, NULL, NULL),
('COU018', 'Environmental science', 'SUB002', 'TEA010', 'Environmental science is the study of interactions among the physical, \r\nchemical and biological components of the environment.', 18, NULL, NULL),
('COU019', 'Intro to biology', 'SUB002', 'TEA006', 'Biology is the study of living things. \r\nIt encompasses the cellular basis of living things, \r\nthe energy metabolism that underlies the activities of life, \r\nand the genetic basis for inheritance in organisms. \r\nBiology also includes the study of evolutionary relationships \r\namong organisms and the diversity of life on Earth.', 19, NULL, NULL),
('COU020', 'Fundamental Science', 'SUB002', 'TEA010', 'Fundamental science is the pursuit of knowledge and information \r\nto better understand and explain natural phenomena.', 20, NULL, NULL),
('COU021', 'Critical reading ', 'SUB003', 'TEA011', 'Critical reading means that a reader applies certain processes, \r\nmodels, questions, and theories that result in enhanced clarity and \r\ncomprehension. There is more involved, both in effort and understand', 21, NULL, NULL),
('COU022', 'Effective writing', 'SUB003', 'TEA011', 'Effective writing is readable — that is, clear, accurate, and concise. \r\nWhen you are writing a paper, try to get your ideas across \r\nin such a way that the audience will understand them effortlessly, \r\nunambiguously, and rapidly. To this end, strive to write in a straightforward way.', 22, NULL, NULL),
('COU023', 'Basic grammar ', 'SUB003', 'TEA012', 'Grammar is the collection of rules and conventions that make languages go. \r\nThis section is about Standard English, but there\'s something here for everyone.', 23, NULL, NULL),
('COU024', 'Intensive grammar', 'SUB003', 'TEA012', 'Intensive Grammar course is the ideal guide for understanding and \r\napplying English grammar rules. Concise explanations with \r\nhelpful examples and activities are provided to help students \r\nfrom all levels boost their knowledge and skills in grammar rules.', 24, NULL, NULL),
('COU025', 'British literature', 'SUB003', 'TEA013', 'British Literature specifically is a rigorous course in which \r\nstudents will study the early forms of written English and \r\nthe British tradition in literature. Students will critically read and \r\nevaluate various forms and types of texts including novels, poetry, \r\ninformational texts and visual texts.', 25, NULL, NULL),
('COU026', 'Rhetoric', 'SUB003', 'TEA011', 'Rhetoric courses help students to develop skills in speaking, writing, listening, and critical reading.', 26, NULL, NULL),
('COU027', 'Creative writing', 'SUB003', 'TEA011', 'Introduction to elements and craft of various genres of creative writing, including narrative, verse, and dialogue, using materials drawn from individual’s own work and selected texts from established and peer writers. Practice in writing in various genres. Introduction to workshop method.', 27, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `code` varchar(6) NOT NULL,
  `sub_name` varchar(15) NOT NULL,
  `id` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`code`, `sub_name`, `id`, `created_at`, `updated_at`) VALUES
('SUB001', 'Mathematics', 1, NULL, NULL),
('SUB002', 'Science', 2, NULL, NULL),
('SUB003', 'English', 3, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `code` varchar(6) NOT NULL,
  `t_firstname` varchar(15) NOT NULL,
  `t_lastname` varchar(15) NOT NULL,
  `t_special` varchar(100) NOT NULL,
  `subject_id` varchar(6) NOT NULL,
  `id` int(3) DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`code`, `t_firstname`, `t_lastname`, `t_special`, `subject_id`, `id`, `updated_at`, `created_at`) VALUES
('TEA001', 'Fern', 'Stevens', 'Algebra', 'SUB001', 1, NULL, NULL),
('TEA002', 'Jeannine', 'Ford', 'Trigonometry and Geometry', 'SUB001', 2, NULL, NULL),
('TEA003', 'Marissa', 'Ruggles', 'Calculus', 'SUB001', 3, NULL, NULL),
('TEA004', 'José Ángel', 'Borja', 'Probability and statistics', 'SUB001', 4, NULL, NULL),
('TEA005', 'Kyle', 'Mendel', 'Basic Mathematics', 'SUB001', 5, NULL, NULL),
('TEA006', 'Isiah', 'Mercer', 'Biology', 'SUB002', 6, NULL, NULL),
('TEA007', 'Jason', 'Bourke', 'Chemistry', 'SUB002', 7, NULL, NULL),
('TEA008', 'Larrie', 'Schuhmacher', 'Physics', 'SUB002', 8, NULL, NULL),
('TEA009', 'Eric', 'Henderson', 'Cosmology and astronomy', 'SUB002', 9, NULL, NULL),
('TEA010', 'Clive', 'Farnham', 'Science', 'SUB003', 10, NULL, NULL),
('TEA011', 'Kerrie ', 'Hudson', 'English writing', 'SUB003', 11, NULL, NULL),
('TEA012', 'Enola', 'Bennett', 'English Grammar', 'SUB003', 12, NULL, NULL),
('TEA013', 'Lola', 'Watts', 'English literature', 'SUB003', 13, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(16) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Administrator', 'admin@abcschool.com', '2021-10-24 15:11:59', '$2y$10$RGuRSLsfJUdaELnY9ZUER.w4pqSyoHeiluriZRahtJB1nWBNYUuwW', 'EveKzuO6HSLSEoiBm4ednHc3FY5vayupZ1nWlMedF9GFWcTnqkKcUeoxIZM6', 'ADMIN', '2021-10-24 15:11:59', '2021-10-24 15:11:59'),
(2, 'User', 'user@abcschool.com', '2021-10-24 15:11:59', '$2y$10$ggNGqa1vmznIwhTFcSRkoeBEI5ZN/EDYTwQAfBeIHYogpxGCNzfJG', NULL, 'USER', '2021-10-24 15:11:59', '2021-10-24 15:11:59'),
(3, 'Spooky', 'spooky@abcschool.com', NULL, '1234', NULL, 'ADMIN', '2021-10-25 08:05:22', '2021-10-26 03:21:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`code`),
  ADD KEY `teacher_id` (`teacher_id`),
  ADD KEY `subject_id` (`subjects_code`);
ALTER TABLE `courses` ADD FULLTEXT KEY `c_id` (`code`,`name`,`subjects_code`,`teacher_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `sub_id` (`code`,`sub_name`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`code`),
  ADD UNIQUE KEY `t_firstname` (`t_firstname`,`t_lastname`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`subjects_code`) REFERENCES `subjects` (`code`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`code`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
