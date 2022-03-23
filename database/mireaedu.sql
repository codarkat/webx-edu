-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 08:56 PM
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
(7, '1', '{\"1\":\"\\u0441\\u043e\\u0441\\u0415\\u0434\",\"2\":\"\\u0418\\u043d\\u0434\\u0438\\u0432\\u0438\\u0434\",\"3\":\"\\u0433\\u041e\\u043b\\u0443\\u0431\\u043e\\u0439\",\"4\":\"\\u043d\\u0435\\u041e\\u0431\\u0445\\u043e\\u0434\\u0438\\u043c\\u043e\"}', '7', '2022-03-12 01:22:09', '2022-03-12 01:22:09'),
(8, '4', '{\"1\":\"\\u041d\\u0435 \\u0442\\u043e\\u043b\\u044c\\u043a\\u043e\\u2026\\u043d\\u043e \\u0438\",\"2\":\"\\u0422\\u043e\\u2026\\u0442\\u043e\",\"3\":\"\\u041b\\u0438\\u0431\\u043e\\u2026\\u043b\\u0438\\u0431\\u043e\",\"4\":\"\\u0415\\u0441\\u043b\\u0438\\u2026\\u0442\\u043e\"}', '8', '2022-03-12 01:23:32', '2022-03-12 01:23:32'),
(9, '1', '{\"1\":\"\\u043d\\u0435 \\u0442\\u043e\\u043b\\u044c\\u043a\\u043e\\u2026\\u043d\\u043e \\u0438\",\"2\":\"\\u043a\\u0430\\u043a\\u2026\\u0442\\u0430\\u043a \\u0438\",\"3\":\"\\u0435\\u0441\\u043b\\u0438\\u2026\\u0442\\u043e\",\"4\":\"\\u043d\\u0435\\u2026\\u043d\\u0435\"}', '9', '2022-03-12 01:27:29', '2022-03-12 01:27:29'),
(10, '1', '{\"1\":\"\\u0430\",\"2\":\"\\u043f\\u043e\\u0442\\u043e\\u043c\\u0443 \\u0447\\u0442\\u043e\",\"3\":\"\\u0447\\u0442\\u043e\\u0431\\u044b\",\"4\":\"\\u0445\\u043e\\u0442\\u044f\"}', '10', '2022-03-12 01:28:41', '2022-03-12 01:28:41'),
(11, '3', '{\"1\":\"\\u041a\\u0435\\u043a\",\"2\":\"\\u0421\\u043e\\u0440\\u044f\\u043d\",\"3\":\"\\u0417\\u0430\\u0434\\u0440\\u0430\\u043b\\u043e\",\"4\":\"\\u0427\\u0438\\u043b\\u0438\\u0442\\u044c\"}', '11', '2022-03-12 01:30:07', '2022-03-12 01:30:07'),
(12, '[\"132\"]', NULL, '12', '2022-03-12 01:56:25', '2022-03-12 01:56:25'),
(13, '[\"\\u0445\\u043e\\u0442\\u044f\"]', NULL, '13', '2022-03-12 02:00:21', '2022-03-23 19:38:20'),
(14, '[\"xin l\\u1ed7i\"]', NULL, '14', '2022-03-12 02:01:20', '2022-03-23 19:38:34'),
(15, '[\"m\\u1eb7c k\\u1ec7\"]', NULL, '15', '2022-03-12 02:02:14', '2022-03-23 19:38:49'),
(16, '[\"\\u043e\\u0432\\u043e\\u0449\\u0438\"]', NULL, '16', '2022-03-12 02:02:46', '2022-03-23 19:39:02');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
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
(7, '<p>Hãy chọn từ có trọng âm đúng:</p>', '5', 'CHOICE', 'ACTIVE', '2022-03-12 01:22:09', '2022-03-23 19:37:24'),
(8, '<p>Hãy điền liên từ đúng vào câu sau đây:&nbsp;</p><p><strong>… тебе не понравится эту сумку, … отдай другим.</strong></p>', '5', 'CHOICE', 'ACTIVE', '2022-03-12 01:23:32', '2022-03-23 19:34:30'),
(9, '<p>Hãy điền liên từ đúng vào câu sau đây:&nbsp;</p><p><strong>Он мечтал … об отдыхе на море, … о покупке собственной яхты.</strong></p>', '5', 'CHOICE', 'ACTIVE', '2022-03-12 01:27:29', '2022-03-23 19:34:41'),
(10, '<p>Hãy điền liên từ đúng vào câu sau đây:&nbsp;</p><p><strong>Вика уже не маленькая девочка, … взрослая.</strong></p>', '5', 'CHOICE', 'ACTIVE', '2022-03-12 01:28:41', '2022-03-23 19:34:51'),
(11, '<p>Hãy điền từ đúng vào câu sau:&nbsp;</p><p><strong>Я домой хочу. … всё это делать, проверять.</strong></p>', '5', 'CHOICE', 'ACTIVE', '2022-03-12 01:30:07', '2022-03-23 19:35:01'),
(12, '<p>Hãy xếp các số theo thứ tự phù hợp với đoạn hội thoại sau đây:&nbsp;</p><p><strong>Я:&nbsp;</strong></p><p><strong>Преподаватель: Добрый день! Конечно, заходите. Почему Вы опоздали?&nbsp;</strong></p><p><strong>Я:&nbsp;</strong></p><p><strong>Преподаватель: Понятно. На первый раз прощаю. Но потом постарайтесь не опаздывать.&nbsp;</strong></p><p><strong>Я:&nbsp;</strong></p><ol><li><i><strong>Здравствуйте! Извините за опоздание. Можно войти?&nbsp;</strong></i></li><li><i><strong>Извините еще раз. Больше такого не повторится!&nbsp;</strong></i></li><li><i><strong>Я долго искал аудиторию.&nbsp;</strong></i></li></ol><p>Hình thức đáp án (ví dụ): 123</p>', '5', 'FORM', 'ACTIVE', '2022-03-12 01:56:25', '2022-03-23 19:38:08'),
(13, '<p>Hãy điền liên từ đúng vào câu sau đây:&nbsp;</p><p><strong>… у меня сильно болит голова, я еду к Маше.&nbsp;</strong></p><p>Hình thức đáp án: 1 từ</p>', '5', 'FORM', 'ACTIVE', '2022-03-12 02:00:21', '2022-03-23 19:38:20'),
(14, '<p>Hãy dịch từ sau đây&nbsp;</p><h3><strong>Сорян&nbsp;</strong></h3><p>Hình thức đáp án: 2 từ</p>', '5', 'FORM', 'ACTIVE', '2022-03-12 02:01:20', '2022-03-23 19:38:34'),
(15, '<p>Hãy dịch từ sau đây&nbsp;</p><h3><strong>Забить&nbsp;</strong></h3><p>Hình thức đáp án: 2 từ</p>', '5', 'FORM', 'ACTIVE', '2022-03-12 02:02:14', '2022-03-23 19:38:49'),
(16, '<p>Hãy cho biết nhóm từ sau đây thuộc chủ đề gì (viết bằng tiếng Nga):&nbsp;</p><h3><strong>баклажан, помидор, лук</strong></h3>', '5', 'FORM', 'ACTIVE', '2022-03-12 02:02:46', '2022-03-23 19:39:02');

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
  `data` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `results`
--

INSERT INTO `results` (`id`, `topic_id`, `user_id`, `num_correct`, `num_incorrect`, `status`, `result`, `data`, `created_at`, `updated_at`) VALUES
(31, '5', '49', '10', '0', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"m\\u1eb7c k\\u1ec7\",\"isCorrect\":true},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-13 15:48:04', '2022-03-13 15:50:17'),
(32, '5', '18', '10', '0', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"m\\u1eb7c k\\u1ec7\",\"isCorrect\":true},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-14 21:33:13', '2022-03-14 21:37:53'),
(33, '5', '11', '9', '1', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ghi b\\u00e0n\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:11:53', '2022-03-19 20:23:45'),
(34, '5', '48', '8', '2', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"2\",\"isCorrect\":false},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ghi b\\u00e0n\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:13:51', '2022-03-19 20:21:11'),
(35, '5', '14', '7', '3', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"2\",\"isCorrect\":false},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":false},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"\\u0111\\u00f3ng v\\u00e0o\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:14:37', '2022-03-19 20:24:43'),
(36, '5', '47', '8', '2', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":false},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"m\\u1eb7c k\\u1ec7\",\"isCorrect\":true},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043f\\u0440\\u043e\\u0434\\u0443\\u043a\\u0442\\u044b\",\"isCorrect\":false}]', NULL, '2022-03-19 20:15:49', '2022-03-19 20:30:46'),
(37, '5', '28', '6', '4', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"2\",\"isCorrect\":false},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"123\",\"isCorrect\":false},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0435\\u0441\\u043b\\u0438\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ghi b\\u00e0n\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:15:55', '2022-03-19 20:27:13'),
(38, '5', '22', '8', '2', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0425\\u043e\\u0442\\u044f\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"m\\u1eb7c k\\u1ec7\",\"isCorrect\":true},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u041e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":false}]', NULL, '2022-03-19 20:16:03', '2022-03-19 20:25:28'),
(39, '5', '38', '8', '2', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0425\\u043e\\u0442\\u044f\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ph\\u1edbt l\\u1edd\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:16:32', '2022-03-19 20:24:23'),
(40, '5', '17', '3', '7', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":false},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"2\",\"isCorrect\":false},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"2\",\"isCorrect\":false},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u043d\\u0435\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"x\\u1ea3 r\\u00e1c\",\"isCorrect\":false},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"\\u0111\\u00f3ng k\\u00edn\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u0435\\u0434\\u0430\",\"isCorrect\":false}]', NULL, '2022-03-19 20:17:25', '2022-03-19 20:26:32'),
(41, '5', '67', '5', '5', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":false},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0422\\u0430\\u043a \\u043a\\u0430\\u043a\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"Cho t\\u00f4i xin\",\"isCorrect\":false},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"M\\u1eb7c k\\u1ec7\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u041e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":false}]', NULL, '2022-03-19 20:20:30', '2022-03-19 20:28:52'),
(42, '5', '40', '9', '1', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0445\\u043e\\u0442\\u044f\",\"isCorrect\":true},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ghi b\\u00e0n\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:21:24', '2022-03-19 20:30:42'),
(43, '5', '51', '6', '4', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u043f\\u043e\\u0442\\u043e\\u043c\\u0443 \\u0447\\u0442\\u043e\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u00f5i\",\"isCorrect\":false},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"ghi b\\u00e0n (m\\u1eb7c k\\u1ec7 m\\u1ed9t vi\\u1ec7c g\\u00ec \\u0111\\u00f3 )\",\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u044c\",\"isCorrect\":false}]', NULL, '2022-03-19 20:24:06', '2022-03-19 20:31:00'),
(44, '5', '52', '9', '1', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":\"4\",\"isCorrect\":true},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":\"1\",\"isCorrect\":true},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":\"3\",\"isCorrect\":true},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":\"132\",\"isCorrect\":true},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":\"\\u0435\\u0441\\u043b\\u0438\",\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":\"xin l\\u1ed7i\",\"isCorrect\":true},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":\"m\\u1eb7c k\\u1ec7\",\"isCorrect\":true},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":\"\\u043e\\u0432\\u043e\\u0449\\u0438\",\"isCorrect\":true}]', NULL, '2022-03-19 20:24:39', '2022-03-19 20:32:30'),
(45, '5', '66', '0', '10', 'FINISHED', '[{\"question_id\":\"7\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"8\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"9\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"10\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"11\",\"question_type\":\"CHOICE\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"12\",\"question_type\":\"FORM\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"13\",\"question_type\":\"FORM\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"14\",\"question_type\":\"FORM\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"15\",\"question_type\":\"FORM\",\"answer\":null,\"isCorrect\":false},{\"question_id\":\"16\",\"question_type\":\"FORM\",\"answer\":null,\"isCorrect\":false}]', NULL, '2022-03-19 20:26:14', '2022-03-19 20:41:34');

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
(14, '5', '49', '2022-03-13 15:47:56', '2022-03-13 15:47:56'),
(15, '5', '18', '2022-03-14 21:33:01', '2022-03-14 21:33:01'),
(16, '5', '11', '2022-03-15 23:01:51', '2022-03-15 23:01:51'),
(17, '5', '17', '2022-03-17 14:33:14', '2022-03-17 14:33:14'),
(18, '5', '66', '2022-03-19 13:51:42', '2022-03-19 13:51:42'),
(19, '5', '28', '2022-03-19 19:55:23', '2022-03-19 19:55:23'),
(20, '5', '47', '2022-03-19 20:00:06', '2022-03-19 20:00:06'),
(21, '5', '48', '2022-03-19 20:13:45', '2022-03-19 20:13:45'),
(22, '5', '14', '2022-03-19 20:14:18', '2022-03-19 20:14:18'),
(23, '5', '22', '2022-03-19 20:15:53', '2022-03-19 20:15:53'),
(24, '5', '38', '2022-03-19 20:16:05', '2022-03-19 20:16:05'),
(25, '5', '67', '2022-03-19 20:20:20', '2022-03-19 20:20:20'),
(26, '5', '40', '2022-03-19 20:21:10', '2022-03-19 20:21:10'),
(27, '5', '51', '2022-03-19 20:24:01', '2022-03-19 20:24:01'),
(28, '5', '52', '2022-03-19 20:24:34', '2022-03-19 20:24:34');

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
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `name`, `description`, `num_question`, `deadline`, `duration`, `status`, `created_at`, `updated_at`) VALUES
(5, 'Bài kiểm tra 19/03/2022', 'CÂU LẠC BỘ TIẾNG NGA', '10', '2022-03-19 20:20', '15', 'ACTIVE', '2022-03-12 01:21:09', '2022-03-12 23:51:54');

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `results`
--
ALTER TABLE `results`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `subscribes`
--
ALTER TABLE `subscribes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
