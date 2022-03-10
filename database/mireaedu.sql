-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2022 at 11:16 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mireaedu`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE `answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `answer` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `option_answer` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `question_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`id`, `answer`, `option_answer`, `question_id`, `created_at`, `updated_at`) VALUES
(1, '2', '{\"1\":\"dwad\",\"2\":\"adc\",\"3\":\"ac\",\"4\":\"dfadfad\"}', '1', '2022-03-09 20:55:14', '2022-03-09 20:55:14'),
(2, '[\"2\",\"3\",\"4\"]', '{\"1\":\"fsad\",\"2\":\"cad\",\"3\":\"cacadc\",\"4\":\"dca\"}', '2', '2022-03-09 20:55:26', '2022-03-09 20:55:26'),
(3, 'dwa', NULL, '3', '2022-03-09 20:55:37', '2022-03-09 20:55:37'),
(4, '3', '{\"1\":\"dwadw\",\"2\":\"dw\",\"3\":\"dwad\",\"4\":\"da\"}', '4', '2022-03-09 20:57:44', '2022-03-09 20:57:44'),
(5, 'dsad', NULL, '5', '2022-03-10 21:36:48', '2022-03-10 21:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('CHOICE','FORM','MULTIPLE_CHOICE') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `content`, `topic_id`, `type`, `status`, `created_at`, `updated_at`) VALUES
(1, '3sadsv', '1', 'CHOICE', 'ACTIVE', '2022-03-09 20:55:14', '2022-03-09 20:55:14'),
(2, '3sadsv', '1', 'MULTIPLE_CHOICE', 'ACTIVE', '2022-03-09 20:55:26', '2022-03-09 20:55:26'),
(3, '3sadsvada', '1', 'FORM', 'ACTIVE', '2022-03-09 20:55:37', '2022-03-09 20:55:37'),
(4, 'adda', '2', 'CHOICE', 'ACTIVE', '2022-03-09 20:57:44', '2022-03-09 20:57:44'),
(5, 'dsaasd', '1', 'FORM', 'ACTIVE', '2022-03-10 21:36:48', '2022-03-10 21:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `results`
--

CREATE TABLE `results` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_correct` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `num_incorrect` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('PROCESSING','FINISHED') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'PROCESSING',
  `result` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `topic_id`, `user_id`, `num_correct`, `num_incorrect`, `status`, `result`, `created_at`, `updated_at`) VALUES
(24, '1', '6', '0', '3', 'FINISHED', '[{\"question_id\":\"1\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"2\",\"question_type\":\"MULTIPLE_CHOICE\",\"answer\":[\"3\",\"4\"],\"isCorrect\":false},{\"question_id\":\"3\",\"question_type\":\"FORM\",\"answer\":\"2\",\"isCorrect\":false}]', '2022-03-10 21:34:21', '2022-03-10 21:35:21');

-- --------------------------------------------------------

--
-- Table structure for table `subscribes`
--

CREATE TABLE `subscribes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `topic_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscribes`
--

INSERT INTO `subscribes` (`id`, `topic_id`, `user_id`, `created_at`, `updated_at`) VALUES
(5, '1', '6', '2022-03-10 21:25:23', '2022-03-10 21:25:23'),
(6, '2', '6', '2022-03-10 21:26:04', '2022-03-10 21:26:04');

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `num_question` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deadline` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'ACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `num_question`, `deadline`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cau lac bo tieng nga', 'Cau lac bo tieng nga', '4', '2022-03-08 12:00', '1', 'ACTIVE', '2022-03-09 20:54:52', '2022-03-10 21:36:48'),
(2, 'caddada', 'csac', '1', '2022-03-16 12:00', '2', 'ACTIVE', '2022-03-09 20:57:09', '2022-03-09 20:57:44');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `answers`
--
ALTER TABLE `answers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `results`
--
ALTER TABLE `results`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subscribes`
--
ALTER TABLE `subscribes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `answers`
--
ALTER TABLE `answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
