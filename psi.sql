-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2024 at 08:09 AM
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
-- Database: `psi`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('356a192b7913b04c54574d18c28d46e6395428ab', 'i:1;', 1731737770),
('356a192b7913b04c54574d18c28d46e6395428ab:timer', 'i:1731737770;', 1731737770),
('a17961fa74e9275d529f489537f179c05d50c2f3', 'i:3;', 1731737334),
('a17961fa74e9275d529f489537f179c05d50c2f3:timer', 'i:1731737334;', 1731737334);

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(15, 2, 3, 1, '2024-10-20 01:01:59', '2024-10-20 01:01:59');

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
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `landing_pages`
--

CREATE TABLE `landing_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(255) NOT NULL,
  `image_title` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `landing_pages`
--

INSERT INTO `landing_pages` (`id`, `image_path`, `image_title`, `created_at`, `updated_at`) VALUES
(1, '01JCSFMDNZS5XF8WH9CC55RTRA.jpg', 'Landing', '2024-11-15 19:17:59', '2024-11-15 19:17:59'),
(3, '01JCSSMYBSTMWHCJJBR4HDVEH9.jpg', 'About', '2024-11-15 19:44:18', '2024-11-15 22:13:01'),
(4, '01JCSSRZT52Y6V17BF1DNA4T5Y.png', 'Header', '2024-11-15 22:15:14', '2024-11-15 22:15:14');

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
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2024_09_15_102704_add_role_to_users', 2),
(5, '2024_09_15_104740_create_personal_access_tokens_table', 3),
(6, '2024_10_03_125150_create_products_table', 4),
(7, '2024_10_03_130903_create_transactions_table', 5),
(8, '2024_10_03_164635_create_products_table', 6),
(9, '2024_10_03_164928_create_carts_table', 7),
(10, '2024_10_03_164929_create_transactions_table', 7),
(11, '2024_10_03_170627_create_products_table', 8),
(12, '2024_10_03_171937_create_products_table', 9),
(13, '2024_10_03_172956_create_products_table', 10),
(14, '2024_10_03_174248_create_carts_table', 11),
(15, '2024_10_03_174557_create_transactions_table', 12),
(16, '2024_10_03_174616_create_transaction_items_table', 12),
(17, '2024_10_04_065933_landing_pages', 13),
(18, '2024_10_05_013629_add_discount_to_products_table', 14),
(19, '2024_10_05_060807_add_shipping_address_to_transactions_table', 15),
(20, '2024_10_05_062401_add_shipping_address_to_transactions_table', 16),
(21, '2024_10_06_170104_add_phone_to_transactions_table', 17),
(22, '2024_11_15_113746_update_status_in_transactions_table', 18),
(23, '2024_11_15_120043_landing_pages', 19),
(24, '2024_11_16_031206_create_activity_logs_table', 19),
(25, '2024_11_16_032312_create_activity_logs_table', 20),
(26, '2024_11_16_033808_create_activity_logs_table', 21),
(27, '2024_11_16_035050_create_activity_log_table', 22),
(28, '2024_11_16_035328_create_activity_log_table', 23),
(29, '2024_11_16_035329_add_event_column_to_activity_log_table', 23),
(30, '2024_11_16_035330_add_batch_uuid_column_to_activity_log_table', 23),
(31, '2024_11_16_045135_create_testimonials_table', 24);

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `discount_percentage` decimal(5,2) NOT NULL DEFAULT 0.00,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `image`, `description`, `stock`, `price`, `discount_percentage`, `start_date`, `end_date`, `created_at`, `updated_at`) VALUES
(3, 'Rambut Nenek Original Turbo', '01J9D5BBA2QB54ZVZG63XX0TJ3.jpg', 'Rambut Nenek Original merupakan produk original dari Rambut Nenek Balikpapan yang memiliki cita rasa manis yang otentik', 758, 19000.00, 20.00, '2024-10-06', '2024-10-07', '2024-10-04 17:40:17', '2024-10-29 17:07:18'),
(8, 'Rambut Nenek Premium', '01JAMF6DXTT7CQAF5FS6CN6ZP5.jpg', 'Lorem Ipsum del almot', 20, 14000.00, 0.00, NULL, NULL, '2024-10-20 00:02:44', '2024-10-20 00:02:44'),
(9, 'Rambut Nenek Combo', '01JBCG0KNJ1X1AMDTCRDMJ0RYN.jpg', 'Combo Kenikmatam Rambut Nenek dipadukan dengan sensai Kriuk dari Kerupuk nya', 30, 23000.00, 0.00, NULL, NULL, '2024-10-29 07:58:49', '2024-10-29 07:58:49'),
(10, 'Rambut Nenek Party ', '01JBCG2DVC7V0R7YT1D4Z3DZAT.jpg', 'Combo 4 Rambut Nenek Balikpapan', 29, 60000.00, 20.00, '2024-11-14', '2024-11-16', '2024-10-29 07:59:48', '2024-11-15 03:43:13'),
(13, 'Rambut Nenek Duo', '01JCR9DWW9JFMDRXPPF6QFH7F7.jpg', 'Lorem Ipsum', 3, 33000.00, 0.00, NULL, NULL, '2024-11-15 08:10:19', '2024-11-15 09:10:03');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('f3GoqwFXZ8UkqOfGRlzkWlyVhNzNWPDKtaWGXypk', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/130.0.0.0 Safari/537.36 Edg/130.0.0.0', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoienBETGh2cU43NndtVmRnR1RuUERoclBNbmIzcVFIUlJlWUFMUnZrMyI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi90ZXN0aW1vbmlhbHMiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkNEhaSDJlY3ozQy5qLlZDa2EvMTJrLnV2YzVZbm4zTUp3ZU5BdndzSnpjbnlYVU1SU1NZOUMiO3M6MTc6IkRhc2hib2FyZF9maWx0ZXJzIjthOjI6e3M6OToic3RhcnREYXRlIjtOO3M6NzoiZW5kRGF0ZSI7Tjt9czo4OiJmaWxhbWVudCI7YTowOnt9fQ==', 1731740938),
('xOrnBhG38KE08a9SaX12iyNZpkHSmeOmjbGvifeE', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiUzJHTlpvU1ByTG12TlJsWGRRWklnNzNaWmxqMUFxVVBId2RpUVF5YSI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1731740925);

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `testimonial` text NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `customer_name`, `testimonial`, `image`, `created_at`, `updated_at`) VALUES
(1, 'Ali Rahmad Saputra', 'Rambut apa yang menemani rambut nenek, rambut kakek xixixii', 'testimonials/01JCSNKRYHE9EK6MS0FG7DJXC1.jpg', '2024-11-15 21:02:29', '2024-11-15 21:02:29'),
(2, 'Priyo Gilang Prasetiawan', 'sangat cocok menemani nyemil di berbagai aktivitas termasuk saat buang air besar', 'testimonials/01JCSP58KDGPYW9NM8156NZPH8.JPG', '2024-11-15 21:12:02', '2024-11-15 21:12:02'),
(3, 'Shello Juliano Prasetyo', 'Saya adalah orang tertampan di alam semesta, saya bisa membuat Gilang terpanah panah', 'testimonials/01JCSPPVAQFK2MJQS5M9WKAHAH.jpg', '2024-11-15 21:21:38', '2024-11-15 21:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `total` decimal(10,2) NOT NULL,
  `payment_method` enum('QRIS','Transfer Bank') NOT NULL,
  `status` enum('Diproses','Dikirim','Diterima','Dibatalkan') NOT NULL DEFAULT 'Diproses',
  `payment_proof` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `total`, `payment_method`, `status`, `payment_proof`, `shipping_address`, `created_at`, `updated_at`, `phone`) VALUES
(4, 2, 10000.00, 'Transfer Bank', 'Diterima', 'payment_proofs/lsxihsR5ZzvusinWjTgT5vwLxEoekb4WAqmotISe.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Fusce eget neque arcu. In euismod rutrum ante, vitae viverra erat convallis vel. Sed at dapibus nisi, nec viverra ligula. Ut tempor felis auctor neque posuere, sed dapibus nibh convallis. Aenean iac', '2024-10-03 10:28:40', '2024-10-03 10:46:40', NULL),
(8, 2, 34000.00, 'QRIS', 'Dikirim', 'payment_proofs/IfM8YDkVMlOcPdmhIQDLvyQL39EvQLSwsokyMx97.png', 'TESTINGGG 01201320123123', '2024-10-04 22:28:14', '2024-10-04 22:40:30', NULL),
(12, 2, 34000.00, 'QRIS', 'Diterima', 'payment_proofs/zP8Pw182DZw3w9jsvetNJPZzYHh9MziWHeWIzYUO.png', '132132', '2024-10-20 00:23:37', '2024-10-20 00:31:55', '12313'),
(13, 13, 34000.00, 'QRIS', 'Dikirim', 'payment_proofs/UHYE8wRe7Zg9Vq4T3EEyS19ks6PzhSydJz0isgRi.jpg', 'nsakasjkbfgjasfjasf', '2024-10-29 08:02:52', '2024-10-29 08:03:49', '081549216635'),
(14, 14, 38000.00, 'QRIS', 'Diterima', 'payment_proofs/46QpMKjyFWATEmdPeofMx3vhxD8KpndZt7ezN2Ig.jpg', 'afihiuafsijafsbiaufsbiuafs', '2024-10-29 17:07:18', '2024-10-29 17:08:59', '081549216635'),
(15, 15, 60000.00, 'QRIS', 'Dibatalkan', 'payment_proofs/69sTG05FdOrxl3CHwxlzQoHM31hijLtwf2JwRoIe.jpg', 'asdasdas12312', '2024-11-15 03:31:44', '2024-11-15 03:40:27', '123414211254412');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_items`
--

CREATE TABLE `transaction_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `transaction_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction_items`
--

INSERT INTO `transaction_items` (`id`, `transaction_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(8, 8, 3, 2, 17000.00, '2024-10-04 22:28:14', '2024-10-04 22:28:14'),
(13, 12, 3, 2, 17000.00, '2024-10-20 00:23:37', '2024-10-20 00:23:37'),
(14, 13, 3, 2, 17000.00, '2024-10-29 08:02:53', '2024-10-29 08:02:53'),
(15, 14, 3, 2, 19000.00, '2024-10-29 17:07:18', '2024-10-29 17:07:18'),
(16, 15, 10, 1, 60000.00, '2024-11-15 03:31:44', '2024-11-15 03:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, '$2y$12$4HZH2ecz3C.j.VCka/12k.uvc5Ynn3MJweNAvwsJzcnyXUMRSSY9C', '9w2VIEb0kHRbuleg1t8AVdZsdGC4Gqjw7QDwEFV6MDOH3ugMT9dbgkWa4jKl', '2024-09-15 02:28:48', '2024-09-15 03:03:46', 'SUPER ADMIN'),
(2, 'test', 'test@gmail.com', NULL, '$2y$12$x2uBCfHvhsCjN3fnBYP8Se7a50yt80eQ2D2FIa6S/.iYbydSNYgm6', NULL, '2024-09-15 03:44:10', '2024-09-15 04:12:15', 'USER'),
(3, 'admin2', 'admin2@gmail.com', NULL, '$2y$12$LDO5mHZ09NtgN.FrEyChPulUIWEGynmqCczisa.aUquPRT8jfpJB6', NULL, '2024-09-15 04:35:46', '2024-11-15 19:39:33', 'ADMIN'),
(11, 'putu', 'putugaming@gmail.com', NULL, '$2y$12$MN78zs5TqLs8zC5PHC5EWebwVKUnuRAxMfHH1uI4VtdAOsPz3d1YO', NULL, '2024-10-05 05:16:13', '2024-10-05 05:16:13', 'USER'),
(12, 'psi123', 'psi@gmail.com', NULL, '$2y$12$ARtzCd0laTeuHPWBcPTXb.dllHJlgYY8aESHSlwYwCh5O9gbyGH5S', NULL, '2024-10-06 08:21:14', '2024-10-06 08:48:25', 'USER'),
(13, 'Jein Ananda', 'anandajein12@gmail.com', NULL, '$2y$12$Zkv5v.iIy5MaoGRZHLAa5emCZ9EK0g9UX2OV2m23H9nKAplLLonZ.', 'omgzcobpsV4R9PaDNBgxCOII9RnqPttDtzP9icfcsw8Gvva2NXAnYWinSWWH', '2024-10-29 07:53:42', '2024-10-29 07:53:42', 'USER'),
(14, 'Jein Ananda', '10221031@student.itk.ac.id', NULL, '$2y$12$R68Jbod4SvGvIQcpox5o4eWSMfKA.x.dfeuX71X.TdH760gd9GoVa', 'ATo3X1OmqX2egU3apJyprAfqLhym7Eea9mnqsuLTtXsDbpBMD13LBvcSbC49', '2024-10-29 16:56:16', '2024-10-29 16:56:16', 'USER'),
(15, 'Jein Ananda', 'venommancer123@gmail.com', NULL, '$2y$12$WbPCr/Cq2KPuelaxB0jMH.UWsEmLbe.wmpY3q4bUWWdfQoc1Ptho2', 'oIKDW43wqu4tsNM7KrbjakGcUyQ2i2GRbQQOv3kpyUUhtwolI0s9xrbvH5pm', '2024-11-15 03:29:52', '2024-11-15 03:29:52', 'USER');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `landing_pages`
--
ALTER TABLE `landing_pages`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_user_id_foreign` (`user_id`);

--
-- Indexes for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_items_transaction_id_foreign` (`transaction_id`),
  ADD KEY `transaction_items_product_id_foreign` (`product_id`);

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
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `landing_pages`
--
ALTER TABLE `landing_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `transaction_items`
--
ALTER TABLE `transaction_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transaction_items`
--
ALTER TABLE `transaction_items`
  ADD CONSTRAINT `transaction_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `transaction_items_transaction_id_foreign` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
