-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2022 at 07:26 PM
-- Server version: 10.5.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u305683932_mireavn`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` enum('MALE','FEMALE','OTHER') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'MALE',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `gender`, `phone`, `address`, `image`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin@mireavn.ru', 'MALE', '', '', '', 'admin@mireavn.ru', NULL, '$2a$12$K9SX7umOEr67Zx1v.FEheue51hPMoyN7L4vdTAZZeiZzmS2/FpRwW', NULL, NULL, NULL),
(3, 'MIREAVN EDUCATION', 'MALE', '', 'Pass:Mirea123456789', '', 'admin@edu.mireavn.ru', NULL, '$2a$12$.NJQHbkSeTuTcGc3ho2CduijfCZDKAwj2hYPlw4D9Qs8ZP1T74HTS', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 12, '2021-11-14 09:59:24', '2021-11-14 09:59:24'),
(2, 13, '2021-11-14 09:59:28', '2021-11-14 09:59:28');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `i_k_b_o_s`
--

CREATE TABLE `i_k_b_o_s` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `github` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vk` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `i_k_b_o_s`
--

INSERT INTO `i_k_b_o_s` (`id`, `name`, `image`, `email`, `position`, `facebook`, `github`, `instagram`, `vk`, `created_at`, `updated_at`) VALUES
(1, 'Lê Đình Cường', 'cuong.jpg', 'dinhcuong.firewin99@gmail.com', 'WEB DEVELOPER', 'ledhcg', 'ledhcg', 'ledhcg', 'kifirlee', NULL, NULL),
(2, 'Vũ Xuân Cảnh', 'canh.jpg', 'xuancanhit99@gmail.com', 'WEB DEVELOPER', 'xuancanhit99', 'xuancanhit99', 'xuancanh.vu', 'xuancanhit99', NULL, NULL),
(3, 'Phương Tiến Đông', 'dong.jpg', 'dongpt410@gmail.com', 'WEB DEVELOPER', 'tiendong.2000', 'phuongtiendong', 'phuongtien.dong', 'id602943301', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `list_votes`
--

CREATE TABLE `list_votes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `result` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`result`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `list_votes`
--

INSERT INTO `list_votes` (`id`, `user_id`, `result`, `created_at`, `updated_at`) VALUES
(1, 28, '\"[0,1]\"', '2021-11-14 10:01:02', '2021-11-14 10:01:02'),
(2, 12, '\"[1,0]\"', '2021-11-14 10:01:02', '2021-11-14 10:01:02'),
(3, 23, '\"[1,0]\"', '2021-11-14 10:01:03', '2021-11-14 10:01:03'),
(4, 32, '\"[1,0]\"', '2021-11-14 10:01:03', '2021-11-14 10:01:03'),
(5, 27, '\"[1,0]\"', '2021-11-14 10:01:04', '2021-11-14 10:01:04'),
(6, 18, '\"[0,1]\"', '2021-11-14 10:01:05', '2021-11-14 10:01:05'),
(7, 20, '\"[0,1]\"', '2021-11-14 10:01:05', '2021-11-14 10:01:05'),
(8, 8, '\"[1,0]\"', '2021-11-14 10:01:07', '2021-11-14 10:01:07'),
(9, 48, '\"[0,1]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(10, 25, '\"[0,1]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(11, 30, '\"[0,1]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(12, 22, '\"[0,1]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(13, 13, '\"[1,0]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(14, 34, '\"[0,1]\"', '2021-11-14 10:01:08', '2021-11-14 10:01:08'),
(15, 42, '\"[0,1]\"', '2021-11-14 10:01:09', '2021-11-14 10:01:09'),
(16, 36, '\"[1,0]\"', '2021-11-14 10:01:10', '2021-11-14 10:01:10'),
(17, 9, '\"[0,1]\"', '2021-11-14 10:01:11', '2021-11-14 10:01:11'),
(18, 41, '\"[0,1]\"', '2021-11-14 10:01:12', '2021-11-14 10:01:12'),
(19, 15, '\"[0,1]\"', '2021-11-14 10:01:12', '2021-11-14 10:01:12'),
(20, 49, '\"[1,0]\"', '2021-11-14 10:01:12', '2021-11-14 10:01:12'),
(21, 5, '\"[0,1]\"', '2021-11-14 10:01:13', '2021-11-14 10:01:13'),
(22, 19, '\"[0,1]\"', '2021-11-14 10:01:14', '2021-11-14 10:01:14'),
(23, 47, '\"[1,0]\"', '2021-11-14 10:01:14', '2021-11-14 10:01:14'),
(24, 29, '\"[1,0]\"', '2021-11-14 10:01:15', '2021-11-14 10:01:15'),
(25, 10, '\"[0,1]\"', '2021-11-14 10:01:15', '2021-11-14 10:01:15'),
(26, 39, '\"[1,0]\"', '2021-11-14 10:01:16', '2021-11-14 10:01:16'),
(27, 26, '\"[0,1]\"', '2021-11-14 10:01:16', '2021-11-14 10:01:16'),
(28, 45, '\"[1,0]\"', '2021-11-14 10:01:17', '2021-11-14 10:01:17'),
(29, 4, '\"[0,1]\"', '2021-11-14 10:01:21', '2021-11-14 10:01:21'),
(30, 17, '\"[0,1]\"', '2021-11-14 10:01:21', '2021-11-14 10:01:21'),
(31, 24, '\"[1,0]\"', '2021-11-14 10:01:22', '2021-11-14 10:01:22'),
(32, 1, '\"[0,1]\"', '2021-11-14 10:01:27', '2021-11-14 10:01:27'),
(33, 51, '\"[1,0]\"', '2021-11-14 10:01:30', '2021-11-14 10:01:30'),
(34, 7, '\"[1,0]\"', '2021-11-14 10:01:36', '2021-11-14 10:01:36'),
(35, 14, '\"[0,1]\"', '2021-11-14 10:01:38', '2021-11-14 10:01:38'),
(36, 40, '\"[1,0]\"', '2021-11-14 10:01:39', '2021-11-14 10:01:39'),
(37, 38, '\"[0,1]\"', '2021-11-14 10:01:44', '2021-11-14 10:01:44'),
(38, 35, '\"[0,1]\"', '2021-11-14 10:01:45', '2021-11-14 10:01:45'),
(39, 3, '\"[1,0]\"', '2021-11-14 10:01:48', '2021-11-14 10:01:48'),
(40, 37, '\"[0,1]\"', '2021-11-14 10:01:53', '2021-11-14 10:01:53'),
(41, 46, '\"[1,0]\"', '2021-11-14 10:01:59', '2021-11-14 10:01:59'),
(42, 55, '\"[1,0]\"', '2021-11-14 10:02:07', '2021-11-14 10:02:07'),
(43, 59, '\"[1,0]\"', '2021-11-14 10:02:21', '2021-11-14 10:02:21'),
(44, 6, '\"[0,1]\"', '2021-11-14 10:02:28', '2021-11-14 10:02:28'),
(45, 31, '\"[1,0]\"', '2021-11-14 10:02:41', '2021-11-14 10:02:41'),
(46, 21, '\"[1,0]\"', '2021-11-14 10:03:09', '2021-11-14 10:03:09'),
(47, 11, '\"[1,0]\"', '2021-11-14 10:03:35', '2021-11-14 10:03:35');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_10_17_150759_create_admins_table', 1),
(6, '2021_10_23_123447_create_notifications_table', 1),
(7, '2021_10_29_155711_create_candidates_table', 1),
(8, '2021_10_29_184839_create_settings_table', 1),
(9, '2021_10_30_143217_create_list_votes_table', 1),
(10, '2021_11_04_170335_create_i_k_b_o_s_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` bigint(20) UNSIGNED NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('rific99@gmail.com', 'WaHnjsvKIhgBi6Zz5gSqjUczG4rzpvEJN2GsjfM6CXzSM7Yghccr3hK2uICG5Nn1', '2021-11-04 23:56:03');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `qty_receive` int(11) NOT NULL DEFAULT 5,
  `qty_total` int(11) NOT NULL DEFAULT 7,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `qty_receive`, `qty_total`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'INACTIVE', NULL, '2021-11-14 10:06:05');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('ACTIVE','INACTIVE') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'INACTIVE',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `image`, `email`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Trần Hoàng Anh', 'avatar.png', 'anh99hoangtran@gmail.com', 'ACTIVE', NULL, '$2y$10$prya./zYdcAiJ/8BaA1Jju76xuzeAWqc2kVKcZ9fTcKljNH73DSEy', NULL, '2021-11-05 04:47:21', '2021-11-14 08:11:23'),
(2, 'Hồ Thị Ngọc Ánh', 'avatar.png', 'anhthiho.xata@gmail.com', 'ACTIVE', NULL, '$2y$10$ZQ5SfVbvI7UL8sfV7v7mh.ePUS86kDasNDwzdN.cLxPMgCyf2wreG', NULL, '2021-11-05 04:47:22', '2021-11-14 08:16:33'),
(3, 'Nguyễn Xuân Bách', 'avatar.png', 'nxb17111999@gmail.com', 'ACTIVE', NULL, '$2y$10$DJhfwJLaJnsxDGMpLeLKqeDbAXyFDn4jQYHEVUWFuk.vFhvkCVqeS', NULL, '2021-11-05 04:47:23', '2021-11-14 08:11:42'),
(4, 'Vũ Xuân Cảnh', '618732977a118.png', 'xuancanhit99@gmail.com', 'ACTIVE', NULL, '$2y$10$JgTKqnVjJqmCSj5CUbYKWeQ3/ix287CwFyN1cJTRmlTv3bh/SwsNC', NULL, '2021-11-05 04:47:23', '2021-11-14 08:11:44'),
(5, 'Vũ Trí Chiến', 'avatar.png', 'vutrichien00@gmail.com', 'ACTIVE', NULL, '$2y$10$1w.O6g.nNF7I/9SPT/9hBen9jsIQYHn4og/7bhKPCi1NZv2VwziM6', NULL, '2021-11-05 04:47:24', '2021-11-14 08:12:06'),
(6, 'Lê Đình Cường', '6184bb9baf76f.png', 'dinhcuong.firewin99@gmail.com', 'ACTIVE', NULL, '$2y$10$p6HEKnlvhutwsAaMIF6fB.W/ZgrLTM7zIit5o0n7K6r0oFPU.ipdm', NULL, '2021-11-05 04:47:24', '2021-11-14 08:11:55'),
(7, 'Nguyễn Thế Danh', 'avatar.png', 'nguyendanh2401@gmail.com', 'ACTIVE', NULL, '$2y$10$Chpc9vp5rXjd0BOcAd299.nm7.Lyg3aKhqL2/fspt9gMUQGTArI.O', NULL, '2021-11-05 04:47:25', '2021-11-14 08:11:58'),
(8, 'Hoàng Văn Dũng', 'avatar.png', 'tuandung@mail.ru', 'ACTIVE', NULL, '$2y$10$yyfti406b366iPO2dvUaheES5mnOeIOtETewLg8KIn8HVbPcxEMRu', NULL, '2021-11-05 04:47:25', '2021-11-14 08:12:05'),
(9, 'Mai Tiến Dũng', 'avatar.png', 'maitiendungtn1999@gmail.com', 'ACTIVE', NULL, '$2y$10$NbFcpQ8KCK42vU3E0e7KauMnrf8gKIIZAGSbxft/TKnPuzvJ9Ly7C', NULL, '2021-11-05 04:47:26', '2021-11-14 08:12:12'),
(10, 'Phạm Quang Dũng', 'avatar.png', 'phamquangdung92@gmail.com', 'ACTIVE', NULL, '$2y$10$6mnMhudFWPK2PLRbVKlJUu5uQAg8AH4cDE4UzU2VE5UW/b8/uehn2', NULL, '2021-11-05 04:47:26', '2021-11-14 08:12:14'),
(11, 'Nguyễn Việt Đăng', 'avatar.png', 'vietdang94@gmail.com', 'ACTIVE', NULL, '$2y$10$YREv5QjvR34Rwowt.fg91eblsrEnzhC2PhueunP200dcqm17FS6ka', NULL, '2021-11-05 04:49:51', '2021-11-14 08:12:21'),
(12, 'Phương Tiến Đông', '6184e98e4b1d0.png', 'dongpt410@gmail.com', 'ACTIVE', NULL, '$2y$10$AFCu1Do/VSgsAQg3GdY71.dmUtXnX9tZuwpvawVCNC0fvdb40zkSK', NULL, '2021-11-05 04:49:51', '2021-11-14 08:12:26'),
(13, 'Nguyễn Công Đức', 'avatar.png', 'ngcongduc9x@gmail.com', 'ACTIVE', NULL, '$2y$10$VuU3ZyisfSSw3tOW76/NJe97yPjn1uoVlYPC4ecAqFAId7aCmRTji', NULL, '2021-11-05 04:49:52', '2021-11-14 08:12:31'),
(14, 'Phạm Hương Giang', 'avatar.png', 'mionna1999@gmail.com', 'ACTIVE', NULL, '$2y$10$URiSo67iLxdy55eB.UMvve9JLZeQwDPReltJl2DfI9VFUXI2IZD2C', NULL, '2021-11-05 04:49:52', '2021-11-14 08:12:38'),
(15, 'Đỗ Văn Giảng', 'avatar.png', 'dovangiang1996@gmail.com', 'ACTIVE', NULL, '$2y$10$wAK9Aj8iJgYSTVUFOoM0C.O1SMMPVmJQ1NzpZRrC8CHltIb/.s2Wa', NULL, '2021-11-05 04:49:53', '2021-11-14 08:17:49'),
(16, 'Nguyễn Thu Hà', 'avatar.png', 'thuha18041997@gmail.com', 'ACTIVE', NULL, '$2y$10$0QnRTc6RRONDGr3DIs6hjeGYUeIjdrjMJWasl23/2l3gFVRTfZ1LG', NULL, '2021-11-05 04:49:54', '2021-11-14 08:12:48'),
(17, 'Phạm Xuân Hạnh', 'avatar.png', 'phamxuanhanhld161@gmail.com', 'ACTIVE', NULL, '$2y$10$O7dBlkmOPYzEigaHsFOOTe.V7YGCnXL8vtBA4FmMfGsj3zOAuHnUW', NULL, '2021-11-05 04:49:54', '2021-11-14 08:12:58'),
(18, 'Trần Minh Hằng', '6184cc95505f9.png', 'tranminhhang.2512@gmail.com', 'ACTIVE', NULL, '$2y$10$Sr4IbdvMX7Ug7kjVPb4Kg.WNiBIWpB6TBSBFr15wM9GAmktQ.4NFy', NULL, '2021-11-05 04:49:55', '2021-11-14 08:12:57'),
(19, 'Lê Thanh Hiền', 'avatar.png', 'lethanhhien9925@gmail.com', 'ACTIVE', NULL, '$2y$10$2RkurOcd8/pokGN.hLTVmexyDCG2Vqf9KMsDaMggzV5lKozIsw/Pi', NULL, '2021-11-05 04:49:55', '2021-11-14 08:13:10'),
(20, 'Nguyễn Minh Hiếu', 'avatar.png', 'hieuminh735@gmail.com', 'ACTIVE', NULL, '$2y$10$/HWjRxEr.Lu4nJdD.8Qtc.glUk7iajtW7twPfqqZVTh6YhCcl5iMu', NULL, '2021-11-05 04:49:56', '2021-11-14 09:35:45'),
(21, 'Cáp Văn Hòa', 'avatar.png', 'hoacapvan1@gmail.com', 'ACTIVE', NULL, '$2y$10$6i2kZrPCykKOPFKgvCKSZ.YpkhKvdOfAffSScCBT6nCkD6whRnzp2', NULL, '2021-11-05 04:51:24', '2021-11-14 08:13:11'),
(22, 'Trần Thị Thu Hoàn', 'avatar.png', 'tranthuhoan06@gmail.com', 'ACTIVE', NULL, '$2y$10$05JviuUj62veZcaPOHNK.OnCbgWnuN6NguzU/Kv5RP35NrpvpM8ES', NULL, '2021-11-05 04:51:24', '2021-11-14 08:13:20'),
(23, 'Lò Văn Hùng', 'avatar.png', 'hunglo6720@gmail.com', 'ACTIVE', NULL, '$2y$10$F71rWu/tLrqMVBkgvjbBMu6QZ0XWf4TYaFlk3V0nR75Xt.MWBiPqe', NULL, '2021-11-05 04:51:25', '2021-11-14 08:13:24'),
(24, 'Trần Thị Khánh Huyền', 'avatar.png', 'trankhanhmy18@gmail.com', 'ACTIVE', NULL, '$2y$10$cQxDIDMpFnI9wgc7mnRZCeEHPsxc2Up27Jy744q26UbJcUm489Pia', NULL, '2021-11-05 04:51:25', '2021-11-14 08:13:28'),
(25, 'Nguyễn Quang Hưng', 'avatar.png', 'qhung1403@gmail.com', 'ACTIVE', NULL, '$2y$10$ZEBSOknmhCkD.O3qfVPvWORQ/sFfrNMMzmxnU7OWATN6yXT3FxuLW', NULL, '2021-11-05 04:51:26', '2021-11-14 08:13:31'),
(26, 'Đặng Xuân Khang', 'avatar.png', 'dangxuankhang147@gmail.com', 'ACTIVE', NULL, '$2y$10$aWUkjBP9jO8Jcg2UMqmvRO/1rL32JPeUGaffEhgqYaVL6RnuIMzry', NULL, '2021-11-05 04:51:26', '2021-11-14 08:17:42'),
(27, 'Hồ Nhật Khánh', 'avatar.png', 'vmu18honhatkhanh@gmail.com', 'ACTIVE', NULL, '$2y$10$R5rEBmI3gpj3/REq7BbgxubKdrVh92X9UxyRk6CpvKbv/0f6oRImK', NULL, '2021-11-05 04:51:27', '2021-11-14 08:13:42'),
(28, 'Lê Trung Kiên', '618799c2edf14.png', 'letrungkienlk4@gmail.com', 'ACTIVE', NULL, '$2y$10$X/NlEeqCysoIrGS7UNrkMeUAcFJE6nQDd./VH01955.X9Vtxkj1Ai', NULL, '2021-11-05 04:51:28', '2021-11-14 08:13:44'),
(29, 'Đặng Hải Long', 'avatar.png', 'hailong27102000@gmail.com', 'ACTIVE', NULL, '$2y$10$MaUuuPaW//ea6hdqQSFGGOiGX9AsA8kVxE.ZLXL.AeMf.YDXCBzaS', NULL, '2021-11-05 04:51:28', '2021-11-14 09:36:02'),
(30, 'Nguyễn Văn Mạnh', '61879aa88be96.png', 'ngvmanh129@gmail.com', 'ACTIVE', NULL, '$2y$10$MhkZwk9EGOcFX98v2Fm1muAQn0Kvz2tEflLE60aMlskAjLUnf902q', NULL, '2021-11-05 04:51:29', '2021-11-14 08:13:57'),
(31, 'Thái Văn Mạnh', 'avatar.png', 'manh331919@gmail.com', 'ACTIVE', NULL, '$2y$10$/1flXj02NbdnXlKx.s11AOuYe.4oRrkBZinfSz.uSERdBLAjqsBBq', NULL, '2021-11-05 04:53:08', '2021-11-14 08:14:03'),
(32, 'Nguyễn Văn Minh', 'avatar.png', 'minhvtdt1009@gmail.com', 'ACTIVE', NULL, '$2y$10$tA3dxCnElm8zeTE4wqLy9OYN752CS2M51ixw2MSzpohIbrNbbSLAq', NULL, '2021-11-05 04:53:08', '2021-11-14 08:14:09'),
(33, 'Nguyễn Trọng Nghĩa', 'avatar.png', 'ntn221992@gmail.com', 'INACTIVE', NULL, '$2y$10$aG7X8iqMc2fGCTYYuBthduV3bQu1JgZABw7IgmLMKs/AZtbw7D.mq', NULL, '2021-11-05 04:53:09', '2021-11-14 07:39:32'),
(34, 'Hoàng Hạnh Như', 'avatar.png', 'hoanghanhnhu112@gmail.com', 'ACTIVE', NULL, '$2y$10$sJHs3ndEqb6pxRuLAaShauAKxBnzFftWddc0Jjgt77/.S7LV9Wj.W', NULL, '2021-11-05 04:53:09', '2021-11-14 08:14:18'),
(35, 'Đinh Bá Phương', 'avatar.png', 'luaquehuong93ht@gmail.com', 'ACTIVE', NULL, '$2y$10$kXb27vCJRG.yKJo4mmePwenLKTFcZX8ClClTOdHjPM5viBjx/rn5S', NULL, '2021-11-05 04:53:10', '2021-11-14 09:24:14'),
(36, 'Vương Trường Sơn', 'avatar.png', 'tr.son.2112@gmail.com', 'ACTIVE', NULL, '$2y$10$msY2o9Th/vfFwn6fdZkXnuAFCUNWazf8UZGD.K7gwDn5D7ZW7Mc9O', NULL, '2021-11-05 04:53:10', '2021-11-14 08:14:23'),
(37, 'Bùi Văn Thanh', 'avatar.png', 'buithanhmta.2020@gmail.com', 'ACTIVE', NULL, '$2y$10$bIU2FbjAmnxeOiqhgdGV3u0YAVy2YP4AaAp5nlSTsz5GuO4AUBRoy', NULL, '2021-11-05 04:53:11', '2021-11-14 09:36:14'),
(38, 'Đỗ Thị Phương Thảo', 'avatar.png', 'thaothao2396nd@gmail.com', 'ACTIVE', NULL, '$2y$10$PQPNQ3IpY4mzZXgpRJ.5B.Z3uS0RVrcLS4fwf9SL7dmTKtIV9yoHe', NULL, '2021-11-05 04:53:11', '2022-03-19 17:11:47'),
(39, 'Đặng Văn Thức', '6187a1e635df7.png', 'Thuc.dang0209@hcmut.edu.vn', 'ACTIVE', NULL, '$2y$10$s5LCdHToywEMcUSkxEGbp.OoAbvHTz5kRVSZy3Pb7bOD27HdBVKOa', NULL, '2021-11-05 04:53:12', '2021-11-14 08:14:43'),
(40, 'Phạm Thị Hoài Thương', 'avatar.png', 'phamthihoaithuong424@gmail.com', 'ACTIVE', NULL, '$2y$10$9q/EpDFjEq20H.iQG34Wv.FjaVR0m6m1yOYtdy0UNpymL7dYjQFHW', NULL, '2021-11-05 04:53:13', '2021-11-14 08:14:46'),
(41, 'Đỗ Trung Tiến', '61850eb778a26.png', 'dotrungtien1993@gmail.com', 'ACTIVE', NULL, '$2y$10$w8oWmFw4PfGnpStoffRogeVoYNWdOH3QmRaWRrb10Snq7O90YyQAi', NULL, '2021-11-05 04:54:25', '2021-11-14 08:14:54'),
(42, 'Lưu Ngọc Tiến', 'avatar.png', 'alex05vn@gmail.com', 'ACTIVE', NULL, '$2y$10$rAmmvdxYAmBkn8rNYJWmzOYQYN3qPFI0c7xbXe7c0fcwN9CMI3ED.', NULL, '2021-11-05 04:54:26', '2021-11-14 08:14:59'),
(43, 'Nguyễn Xuân Tình', 'avatar.png', 'nguyenxuantinh000@gmail.com', 'ACTIVE', NULL, '$2y$10$HaZtG8/YlW6M2n/EVuIKW.0FEUVq9DoxMgXACnoxsvUR.NzI3tbiO', NULL, '2021-11-05 04:54:26', '2021-11-14 08:15:15'),
(44, 'Nguyễn Hữu Thành Trung', 'avatar.png', 'tuclen123@gmail.com', 'INACTIVE', NULL, '$2y$10$hWvSvrgisfM7tq.BHRIXtuJJ7evacf5bK9/oVOQgcC7jLpkodTLhi', NULL, '2021-11-05 04:54:27', '2021-11-14 07:39:32'),
(45, 'Đinh Nhật Trường', 'avatar.png', 'truongnhat128@gmail.com', 'ACTIVE', NULL, '$2y$10$nhiG6RCPetgj1e/n52vDV.ge59sThZ2QCHK35I18zJKFXRS6rtAR6', NULL, '2021-11-05 04:54:28', '2021-11-14 08:15:17'),
(46, 'Trần Anh Tú', 'avatar.png', 'tutran1998.tt@gmail.com', 'ACTIVE', NULL, '$2y$10$jfFzPqQayUwnFaSoGVML/OVDYQPT/6hHYHZCwPMoXoolf9VXxJRFy', NULL, '2021-11-05 04:54:28', '2021-11-14 08:15:23'),
(47, 'Mai Văn Tuấn', 'avatar.png', '8268826@gmail.com', 'ACTIVE', NULL, '$2y$10$NvMjTkjpGhORfq4Dh00B0.0bMplWM3KYvESwHWAaOaQMup2KqImmG', NULL, '2021-11-05 04:54:29', '2022-03-19 16:59:41'),
(48, 'Nguyễn Văn Tuấn', 'avatar.png', 'tuanmya2pkkq@gmail.com', 'ACTIVE', NULL, '$2y$10$bB0tz8e.11hA.dt/tVit5OYPTFDeLnZ8S52/9y/ipMo2rYRJw49NC', NULL, '2021-11-05 04:54:29', '2022-03-19 17:04:29'),
(49, 'Phạm Thị Thanh Vân', 'avatar.png', 'fanvucattuong@gmail.com', 'ACTIVE', NULL, '$2y$10$pStPfrmVTPKiylS25YGH7.SkT8fseQdjO8Ti237NzL2J0GeiPurHS', NULL, '2021-11-05 04:54:30', '2022-03-13 12:42:44'),
(50, 'Nghiêm Vũ Vinh', 'avatar.png', 'nghiemvuvinh@gmail.com', 'ACTIVE', NULL, '$2y$10$AW7DA5ZEGu92Xa25t7KwvOAZGq6VPszeLu9X.mk2bRkllABS6yOoW', NULL, '2021-11-05 04:54:30', '2021-11-14 08:15:35'),
(51, 'Phạm Thế Vinh', 'avatar.png', 'pmvinh99@gmail.com', 'ACTIVE', NULL, '$2y$10$HikJsCpdetucusv7d5QJMeDYqSUaxAMtyq8SRRgSP0ZhajFxvZiRS', NULL, '2021-11-05 04:55:43', '2021-11-14 08:15:42'),
(52, 'Trần Toàn Thắng', 'avatar.png', 'trantoanthangat17@gmail.com', 'ACTIVE', NULL, '$2y$10$kPsviOP7UcUcmOBBIYhOYuchGvFBzYw6TG/AxvcGjMKIPMGrlECdy', NULL, '2021-11-05 04:55:44', '2022-03-19 17:23:16'),
(53, 'Nguyễn Khắc Thanh Tùng', 'avatar.png', 'nguyenkhacthanhtung12k2002@gmail.com', 'ACTIVE', NULL, '$2y$10$KQq89yLDVZXm91kG6YiaIuqq49cEQ0ktDC770yxKs/Lt0KHTpHWBO', NULL, '2021-11-05 04:55:44', '2021-11-14 08:16:01'),
(54, 'Lê Hồng Quang', 'avatar.png', 'quanghx13@gmail.com', 'ACTIVE', NULL, '$2y$10$Wloi9t8wdjLejlv/.fDvDe4G2OnTFMHNWGDmI5C107NN6Ui.UEmY2', NULL, '2021-11-05 04:55:45', '2021-11-14 08:16:03'),
(55, 'Trần Quốc Bảo', 'avatar.png', 'tbao3406@gmail.com', 'ACTIVE', NULL, '$2y$10$GD5.74xqkr8RzjBXc28xQek2GT12yws5zTSdiq4Ci3YrTDcn3/Hpi', NULL, '2021-11-05 04:55:45', '2021-11-14 08:16:08'),
(56, 'Nguyễn Hữu Bằng', 'avatar.png', 'nbang8502@gmail.com', 'ACTIVE', NULL, '$2y$10$ByN7GnCoJItq5bO/UVKHfe8pfEg4XpdWrzOk0EzK/ilHoGcgzaTVO', NULL, '2021-11-05 04:55:46', '2021-11-14 08:16:12'),
(57, 'Lê Minh Tiến', 'avatar.png', 'minhtien1mta@gmail.com', 'ACTIVE', NULL, '$2y$10$2z6B2hEXr6CFOP5LScOwHOyeAMTsO0aPhGPh.LxoZy7UogDeZWh2K', NULL, '2021-11-05 04:55:47', '2021-11-14 10:01:14'),
(58, 'Lê Quang Khải', 'avatar.png', 'lequangkhai638@gmail.com', 'ACTIVE', NULL, '$2y$10$a/ZdcPddJVSpzNbrddETtefxyGsoqzJMQQ7M64jtFRvm.1.nxdliq', NULL, '2021-11-05 04:55:47', '2021-11-14 08:16:24'),
(59, 'Minh Thành Trung', 'avatar.png', 'trunghnt321@gmail.com', 'ACTIVE', NULL, '$2y$10$c.6M.JSmsz2OakpurA2l7ePA414NAtR643t47brN.J95ZaVnnziGu', NULL, '2021-11-05 04:55:48', '2021-11-14 08:16:28'),
(60, 'Khách mời', 'avatar.png', 'guest@mireavn.ru', 'INACTIVE', NULL, '$2y$10$VA/edSQxopNWpX6MEoKeOuvUCcUfStKZIo8c.0ogWFED7E8a/qepO', NULL, '2021-11-11 18:47:05', '2021-11-14 07:39:33'),
(61, 'BCH CHI ĐOÀN', 'avatar.png', 'mirealienbangnga@gmail.com', 'INACTIVE', NULL, '$2y$10$B7Nqmy.aaIDTu82D5ue.n.g5qzo6km8T/MJrK7up0ndppXUqg56tG', NULL, '2021-11-11 18:47:05', '2021-11-14 07:39:33'),
(66, 'Đỗ Thị Mỹ Linh', 'avatar.png', 'mylinh1004@mail.ru', 'INACTIVE', NULL, '$2y$10$M79nBgJOUEVAxE45oyQO/O8xtZs9brPyZfcdNq2Ek6P7tLWJ8bkRC', NULL, '2022-03-18 08:35:53', '2022-03-19 10:49:49'),
(67, 'Vương Hùng Dũng', 'avatar.png', 'dungvh79@gmail.com', 'INACTIVE', NULL, '$2y$10$Qoom9pS6ujNZExAT3KZH2eA/i/geOFS2CtG6jG5WjPqpf8SLW9Rde', NULL, '2022-03-18 08:35:54', '2022-03-18 08:35:54'),
(68, 'Le Dinh Cuong', 'avatar.png', 'mail@ledinhcuong.com', 'INACTIVE', NULL, '$2y$10$ksieJTIefpNiahMba3Sd4OIYHJCa24iQe1DcuDcgJgNeeHRsPmZ8a', NULL, '2022-03-18 08:35:54', '2022-03-18 14:26:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `i_k_b_o_s`
--
ALTER TABLE `i_k_b_o_s`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `list_votes`
--
ALTER TABLE `list_votes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_type_notifiable_id_index` (`notifiable_type`,`notifiable_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `i_k_b_o_s`
--
ALTER TABLE `i_k_b_o_s`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `list_votes`
--
ALTER TABLE `list_votes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
