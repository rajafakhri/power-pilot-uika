-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 11:33 AM
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
-- Database: `power_pilot`
--

-- --------------------------------------------------------

--
-- Table structure for table `battery`
--

CREATE TABLE `battery` (
  `id_battery` int(11) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `nm_battery` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `bat_watt` int(11) NOT NULL DEFAULT 0,
  `residu_val` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `battery`
--

INSERT INTO `battery` (`id_battery`, `id_users`, `nm_battery`, `capacity`, `bat_watt`, `residu_val`, `created_at`, `updated_at`) VALUES
(1, 6, 'Baterry 1', 10000, 5000, 5000, '2024-05-04 00:29:02', '2024-06-09 23:43:35'),
(2, 6, 'Battery 2', 10000, 5000, 5000, '2024-05-04 03:14:54', '2024-06-09 23:46:09'),
(3, 6, 'Battery 3', 10000, 10000, 0, '2024-05-31 16:21:21', '2024-06-09 23:42:53'),
(4, 7, 'Battery 1', 10000, 7000, 3000, '2024-06-09 23:47:23', '2024-06-09 23:47:23'),
(5, 7, 'Battery 2', 10000, 2000, 8000, '2024-06-09 23:47:43', '2024-06-09 23:47:43'),
(6, 7, 'Battery 3', 10000, 0, 10000, '2024-06-09 23:48:04', '2024-06-09 23:48:04');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `generator`
--

CREATE TABLE `generator` (
  `id_generator` int(11) NOT NULL,
  `id_users` int(11) NOT NULL,
  `kd_gen1` varchar(255) NOT NULL,
  `total_watt_gen1` int(11) DEFAULT NULL,
  `kd_gen2` varchar(255) DEFAULT NULL,
  `total_watt_gen2` int(11) DEFAULT NULL,
  `kd_gen3` varchar(255) DEFAULT NULL,
  `total_watt_gen3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `meters`
--

CREATE TABLE `meters` (
  `id_meters` int(11) NOT NULL,
  `nm_meters` varchar(255) NOT NULL,
  `m_volt` int(11) NOT NULL,
  `m_ampere` int(11) NOT NULL,
  `m_watt` int(11) NOT NULL,
  `id_battery` varchar(255) NOT NULL,
  `m_expore` varchar(1000) DEFAULT NULL,
  `m_import` varchar(1000) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `meters`
--

INSERT INTO `meters` (`id_meters`, `nm_meters`, `m_volt`, `m_ampere`, `m_watt`, `id_battery`, `m_expore`, `m_import`, `created_at`, `updated_at`) VALUES
(1, 'Meter 2', 400, 400, 160000, '1', '', '', '2024-05-04 03:24:29', '2024-05-24 16:14:18');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(9, '2014_10_12_000000_create_users_table', 1),
(10, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(11, '2019_08_19_000000_create_failed_jobs_table', 1),
(12, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `record_elec_use`
--

CREATE TABLE `record_elec_use` (
  `id_rec_elec_use` int(11) NOT NULL,
  `id_users` bigint(20) UNSIGNED NOT NULL,
  `gen_1` int(11) NOT NULL DEFAULT 0,
  `gen_2` int(11) NOT NULL DEFAULT 0,
  `gen_3` int(11) DEFAULT 0,
  `elec_usage` int(11) NOT NULL DEFAULT 0,
  `elec_export` int(11) NOT NULL DEFAULT 0,
  `elec_import` int(11) NOT NULL DEFAULT 0,
  `export_to` bigint(20) DEFAULT NULL,
  `import_from` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `record_elec_use`
--

INSERT INTO `record_elec_use` (`id_rec_elec_use`, `id_users`, `gen_1`, `gen_2`, `gen_3`, `elec_usage`, `elec_export`, `elec_import`, `export_to`, `import_from`, `created_at`, `updated_at`) VALUES
(131, 6, 0, 0, 0, 2000, 1000, 0, 7, NULL, '2024-06-19 02:05:39', '2024-06-19 02:05:39'),
(134, 7, 0, 0, 0, 3000, 0, 10000, NULL, 6, '2024-06-19 02:11:52', '2024-06-19 02:11:52'),
(135, 7, 0, 0, 0, 3000, 0, 5000, NULL, 6, '2024-06-19 02:11:53', '2024-06-19 02:11:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `level` int(11) NOT NULL DEFAULT 3,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `saldo` int(11) NOT NULL DEFAULT 0,
  `persentase` float NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `level`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `saldo`, `persentase`, `created_at`, `updated_at`) VALUES
(2, 1, 'Mohamad Raja Fakhri (Admin)', 'rajafakhrir7@gmail.com', NULL, '$2y$10$8EKT0TbgFEgYFNAW0bnh7uyOksfwFhYhnV8OAHz6QXDaauFvbUV1i', '5rLFfrN7pGb0s9KnvuWCY9O4QokZyMj1KnfnytRfIlj4MnElO5DXfYLH5Gtu', 0, 0, '2024-04-13 23:04:16', '2024-06-09 23:38:16'),
(4, 2, 'Budi (Owner)', 'rajafakhrir@yahoo.co.id', NULL, '$2y$10$CI6RlLv3VCXnjDkTPvOVC.QiUyx5j0NQe3Bz6ZG9/5glhUFzKrnvW', NULL, 0, 0, '2024-04-24 06:29:51', '2024-06-09 23:37:54'),
(6, 3, 'Rendi (User)', 'raja1@triwala.co.id', NULL, '$2y$10$jG/C6tc0ByNs7H.rym8/HeH8KXKvZNWEOasxtWl.Bc88pUlVW5h9m', NULL, 15000, 66.6667, '2024-05-15 06:26:06', '2024-06-09 23:38:58'),
(7, 3, 'Doni (User)', 'doni@gmail.com', NULL, '$2y$10$joRVk4moWRSZBPc08hhSUeczaJDNTloXDHCqLwGZvX9IwlJn4WB1K', NULL, 35000, 40, '2024-06-09 23:46:53', '2024-06-09 23:46:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `battery`
--
ALTER TABLE `battery`
  ADD PRIMARY KEY (`id_battery`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `generator`
--
ALTER TABLE `generator`
  ADD PRIMARY KEY (`id_generator`),
  ADD UNIQUE KEY `kd_generator` (`kd_gen1`),
  ADD KEY `id_users` (`id_users`);

--
-- Indexes for table `meters`
--
ALTER TABLE `meters`
  ADD PRIMARY KEY (`id_meters`),
  ADD KEY `id_battery` (`id_battery`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `record_elec_use`
--
ALTER TABLE `record_elec_use`
  ADD PRIMARY KEY (`id_rec_elec_use`),
  ADD KEY `id_users` (`id_users`);

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
-- AUTO_INCREMENT for table `battery`
--
ALTER TABLE `battery`
  MODIFY `id_battery` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generator`
--
ALTER TABLE `generator`
  MODIFY `id_generator` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meters`
--
ALTER TABLE `meters`
  MODIFY `id_meters` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `record_elec_use`
--
ALTER TABLE `record_elec_use`
  MODIFY `id_rec_elec_use` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=136;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `battery`
--
ALTER TABLE `battery`
  ADD CONSTRAINT `battery_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
