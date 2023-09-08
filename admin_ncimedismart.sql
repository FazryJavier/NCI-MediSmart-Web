-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 08, 2023 at 03:53 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `admin_ncimedismart`
--

-- --------------------------------------------------------

--
-- Table structure for table `abouts`
--

CREATE TABLE `abouts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `video` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `visi` varchar(255) NOT NULL,
  `misi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `abouts`
--

INSERT INTO `abouts` (`id`, `video`, `image`, `description`, `visi`, `misi`, `created_at`, `updated_at`) VALUES
(1, 'https://www.youtube.com/embed/65pOIFtQUyg', 'file-image/Hf6o3N6vcYwUuIdSNKXCLRcWMqPKZp3GECKZV9PH.png', 'NCI-MediSmart memberikan solusi bagi fasilitas kesehatan Indonesia untuk bertransformasi dengan layanan digital dan teknologi terbarukan untuk mendukung fasilitas kesehatan mencapai hasil terbaik dengan skala yang besar.', 'Menjadi Perusahaan IT Terbaik, Bermanfaat dan Berskala Nasional', 'Membangun IT lebih baik dengan cara memberikan latihan', '2023-09-07 18:14:54', '2023-09-07 18:51:46');

-- --------------------------------------------------------

--
-- Table structure for table `advantage_list_products`
--

CREATE TABLE `advantage_list_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `advantageId` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advantage_modul_products`
--

CREATE TABLE `advantage_modul_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulId` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `advantage_products`
--

CREATE TABLE `advantage_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `icon` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `all_clients`
--

CREATE TABLE `all_clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `adminId` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `prioritize` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client_products`
--

CREATE TABLE `client_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `fasilities_modul_products`
--

CREATE TABLE `fasilities_modul_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulId` bigint(20) UNSIGNED NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `image_modul_products`
--

CREATE TABLE `image_modul_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `modulId` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_sliders`
--

CREATE TABLE `landing_sliders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_videos`
--

CREATE TABLE `landing_videos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `maps`
--

CREATE TABLE `maps` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
(20, '2014_10_12_000000_create_users_table', 1),
(21, '2014_10_12_100000_create_password_resets_table', 1),
(22, '2019_08_19_000000_create_failed_jobs_table', 1),
(23, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(24, '2023_09_07_074524_create_products_table', 1),
(25, '2023_09_07_074951_create_client_products_table', 1),
(26, '2023_09_07_075022_create_advantage_products_table', 1),
(27, '2023_09_07_075036_create_modul_products_table', 1),
(28, '2023_09_07_075052_create_advantage_list_products_table', 1),
(29, '2023_09_07_085148_create_advantage_modul_products_table', 1),
(30, '2023_09_07_085439_create_fasilities_modul_products_table', 1),
(31, '2023_09_07_085548_create_image_modul_products_table', 1),
(32, '2023_09_07_085635_create_landing_sliders_table', 1),
(33, '2023_09_07_085659_create_landing_videos_table', 1),
(34, '2023_09_07_085738_create_maps_table', 1),
(35, '2023_09_07_085755_create_all_clients_table', 1),
(36, '2023_09_07_085825_create_articles_table', 1),
(37, '2023_09_07_090053_create_feedback_table', 1),
(38, '2023_09_07_090131_create_abouts_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `modul_products`
--

CREATE TABLE `modul_products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `productId` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subTitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `image_main` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `subTitle` varchar(255) NOT NULL,
  `image_title` varchar(255) NOT NULL,
  `image_show` varchar(255) NOT NULL,
  `description_show` text NOT NULL,
  `description_detail` text NOT NULL,
  `flyer` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `abouts`
--
ALTER TABLE `abouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `advantage_list_products`
--
ALTER TABLE `advantage_list_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advantage_list_products_advantageid_foreign` (`advantageId`);

--
-- Indexes for table `advantage_modul_products`
--
ALTER TABLE `advantage_modul_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advantage_modul_products_modulid_foreign` (`modulId`);

--
-- Indexes for table `advantage_products`
--
ALTER TABLE `advantage_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `advantage_products_productid_foreign` (`productId`);

--
-- Indexes for table `all_clients`
--
ALTER TABLE `all_clients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_adminid_foreign` (`adminId`);

--
-- Indexes for table `client_products`
--
ALTER TABLE `client_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_products_productid_foreign` (`productId`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `fasilities_modul_products`
--
ALTER TABLE `fasilities_modul_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fasilities_modul_products_modulid_foreign` (`modulId`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_modul_products`
--
ALTER TABLE `image_modul_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `image_modul_products_modulid_foreign` (`modulId`);

--
-- Indexes for table `landing_sliders`
--
ALTER TABLE `landing_sliders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_videos`
--
ALTER TABLE `landing_videos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `maps`
--
ALTER TABLE `maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modul_products`
--
ALTER TABLE `modul_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `modul_products_productid_foreign` (`productId`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `abouts`
--
ALTER TABLE `abouts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `advantage_list_products`
--
ALTER TABLE `advantage_list_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advantage_modul_products`
--
ALTER TABLE `advantage_modul_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `advantage_products`
--
ALTER TABLE `advantage_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `all_clients`
--
ALTER TABLE `all_clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client_products`
--
ALTER TABLE `client_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fasilities_modul_products`
--
ALTER TABLE `fasilities_modul_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `image_modul_products`
--
ALTER TABLE `image_modul_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_sliders`
--
ALTER TABLE `landing_sliders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_videos`
--
ALTER TABLE `landing_videos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `maps`
--
ALTER TABLE `maps`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `modul_products`
--
ALTER TABLE `modul_products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `advantage_list_products`
--
ALTER TABLE `advantage_list_products`
  ADD CONSTRAINT `advantage_list_products_advantageid_foreign` FOREIGN KEY (`advantageId`) REFERENCES `advantage_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advantage_modul_products`
--
ALTER TABLE `advantage_modul_products`
  ADD CONSTRAINT `advantage_modul_products_modulid_foreign` FOREIGN KEY (`modulId`) REFERENCES `modul_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `advantage_products`
--
ALTER TABLE `advantage_products`
  ADD CONSTRAINT `advantage_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_adminid_foreign` FOREIGN KEY (`adminId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `client_products`
--
ALTER TABLE `client_products`
  ADD CONSTRAINT `client_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fasilities_modul_products`
--
ALTER TABLE `fasilities_modul_products`
  ADD CONSTRAINT `fasilities_modul_products_modulid_foreign` FOREIGN KEY (`modulId`) REFERENCES `modul_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `image_modul_products`
--
ALTER TABLE `image_modul_products`
  ADD CONSTRAINT `image_modul_products_modulid_foreign` FOREIGN KEY (`modulId`) REFERENCES `modul_products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `modul_products`
--
ALTER TABLE `modul_products`
  ADD CONSTRAINT `modul_products_productid_foreign` FOREIGN KEY (`productId`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
