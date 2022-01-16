-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2022 at 05:22 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `groceries`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE `address` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `address` varchar(250) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `postalCode` varchar(20) DEFAULT NULL,
  `knownName` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `lattitude` varchar(255) DEFAULT NULL,
  `phone` varchar(20) NOT NULL COMMENT '(Phone number optional)',
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`id`, `user_id`, `address`, `city`, `state`, `country`, `postalCode`, `knownName`, `longitude`, `lattitude`, `phone`, `status`, `created_at`, `updated_at`) VALUES
(2, 1, 'address', 'city', 'state', 'country', 'postalCode', 'knownName', '26.332303405673123', '86.06675578419646', '', 1, '2021-12-10 05:49:15', '2021-12-10 05:49:15'),
(6, 1, 'bhowrra machhata chowk, near pani tanki, Bhavara, Madhubani, Bihar 847212, India', 'Madhubani', 'Bihar', 'India', '847212', 'pani tanki', '86.06673769999999', '26.3322318', '', 1, '2022-01-12 12:20:42', '2022-01-12 12:20:42');

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`id`, `user_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Size', 1, NULL, NULL),
(2, 1, 'Fabric', 1, NULL, NULL),
(3, 1, 'KG', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_stock_id` int(11) DEFAULT 0,
  `qty` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `plateform` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  `upload_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `user_id`, `name`, `upload_id`, `status`, `updated_at`, `created_at`) VALUES
(6, 1, 'Furit', 6, 1, '2021-12-12 05:21:17', '2021-12-12 05:21:17'),
(7, 1, 'Vegitable', 7, 1, '2021-12-12 05:29:19', '2021-12-12 05:29:19'),
(11, 1, 'Frash Fruits & Vegetable', 11, 1, '2021-12-12 10:16:24', '2021-12-12 10:16:24'),
(12, 1, 'Cooking Oil & Ghee', 12, 1, '2021-12-12 10:17:41', '2021-12-12 10:17:41'),
(13, 1, 'Meat & Fish', 13, 1, '2021-12-12 10:18:36', '2021-12-12 10:18:36'),
(14, 1, 'Bakery & Snacks', 14, 1, '2021-12-12 10:19:33', '2021-12-12 10:19:33'),
(15, 1, 'Dairy & Eggs', 15, 1, '2021-12-12 10:20:53', '2021-12-12 10:20:53'),
(16, 1, 'Beverages', 16, 1, '2021-12-12 10:21:34', '2021-12-12 10:21:34'),
(18, 1, 'Foodgrains, Oil & Masala', 40, 1, '2021-12-14 22:35:49', '2021-12-14 22:35:49');

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `exchange_rate` double(10,5) NOT NULL,
  `status` int(10) NOT NULL DEFAULT 0,
  `code` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `name`, `symbol`, `exchange_rate`, `status`, `code`, `created_at`, `updated_at`) VALUES
(1, 'U.S. Dollar', '$', 1.00000, 0, 'USD', '2018-10-09 11:35:08', '2021-09-18 18:51:38'),
(2, 'Australian Dollar', '$', 1.28000, 0, 'AUD', '2018-10-09 11:35:08', '2020-12-31 21:32:48'),
(5, 'Brazilian Real', 'R$', 3.25000, 0, 'BRL', '2018-10-09 11:35:08', '2020-12-31 21:32:49'),
(6, 'Canadian Dollar', '$', 1.27000, 0, 'CAD', '2018-10-09 11:35:08', '2020-12-31 21:32:59'),
(7, 'Czech Koruna', 'Kč', 20.65000, 0, 'CZK', '2018-10-09 11:35:08', '2020-12-31 21:33:00'),
(8, 'Danish Krone', 'kr', 6.05000, 0, 'DKK', '2018-10-09 11:35:08', '2020-12-31 21:33:01'),
(9, 'Euro', '€', 0.85000, 0, 'EUR', '2018-10-09 11:35:08', '2020-12-31 21:33:01'),
(10, 'Hong Kong Dollar', '$', 7.83000, 0, 'HKD', '2018-10-09 11:35:08', '2020-12-31 21:33:02'),
(11, 'Hungarian Forint', 'Ft', 255.24000, 0, 'HUF', '2018-10-09 11:35:08', '2020-12-31 21:33:03'),
(12, 'Israeli New Sheqel', '₪', 3.48000, 0, 'ILS', '2018-10-09 11:35:08', '2020-12-31 21:33:04'),
(13, 'Japanese Yen', '¥', 107.12000, 0, 'JPY', '2018-10-09 11:35:08', '2020-12-31 21:33:19'),
(14, 'Malaysian Ringgit', 'RM', 3.91000, 0, 'MYR', '2018-10-09 11:35:08', '2020-12-31 21:33:20'),
(15, 'Mexican Peso', '$', 18.72000, 0, 'MXN', '2018-10-09 11:35:08', '2020-12-31 21:33:21'),
(16, 'Norwegian Krone', 'kr', 7.83000, 0, 'NOK', '2018-10-09 11:35:08', '2020-12-31 21:33:38'),
(17, 'New Zealand Dollar', '$', 1.38000, 0, 'NZD', '2018-10-09 11:35:08', '2020-12-31 21:33:39'),
(18, 'Philippine Peso', '₱', 52.26000, 0, 'PHP', '2018-10-09 11:35:08', '2020-12-31 21:33:40'),
(19, 'Polish Zloty', 'zł', 3.39000, 0, 'PLN', '2018-10-09 11:35:08', '2020-12-31 21:33:40'),
(20, 'Pound Sterling', '£', 0.72000, 0, 'GBP', '2018-10-09 11:35:08', '2020-12-31 21:33:41'),
(21, 'Russian Ruble', 'руб', 55.93000, 0, 'RUB', '2018-10-09 11:35:08', '2020-12-31 21:33:42'),
(22, 'Singapore Dollar', '$', 1.32000, 0, 'SGD', '2018-10-09 11:35:08', '2020-12-31 21:33:42'),
(23, 'Swedish Krona', 'kr', 8.19000, 0, 'SEK', '2018-10-09 11:35:08', '2020-12-31 21:33:45'),
(24, 'Swiss Franc', 'CHF', 0.94000, 0, 'CHF', '2018-10-09 11:35:08', '2020-12-31 21:33:46'),
(26, 'Thai Baht', '฿', 31.39000, 0, 'THB', '2018-10-09 11:35:08', '2020-12-31 21:33:46'),
(27, 'Taka', '৳', 84.00000, 0, 'BDT', '2018-10-09 11:35:08', '2020-12-31 21:33:47'),
(28, 'Indian Rupee', 'Rs', 68.45000, 1, 'Rupee', '2019-07-07 10:33:46', '2019-07-07 10:33:46');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `is_cod` int(11) NOT NULL DEFAULT 1 COMMENT '1=cod_applicable|0=cod not applicable',
  `cod_resion` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `user_id`, `is_cod`, `cod_resion`, `created_at`, `updated_at`) VALUES
(10, 14, 1, NULL, '2021-12-09 01:19:26', '2021-12-09 01:19:26'),
(11, 15, 1, NULL, '2021-12-09 01:23:12', '2021-12-09 01:23:12'),
(12, 16, 1, NULL, '2021-12-09 08:57:13', '2021-12-09 08:57:13'),
(13, 17, 1, NULL, '2021-12-09 11:44:21', '2021-12-09 11:44:21');

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
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `favicon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `general_settings`
--

INSERT INTO `general_settings` (`id`, `user_id`, `logo`, `favicon`, `site_name`, `address`, `phone`, `email`, `facebook`, `instagram`, `twitter`, `youtube`, `created_at`, `updated_at`) VALUES
(2, 1, '11', '13', 'zender', 'bhowrra machhata chowk near pani tanki\r\nnear Mahadev mandir', '7079692988', 'ranjanashish254@gmail.com', 'facebook.com', 'instagram.com', 'twitter.com', 'youtube.com', '2021-12-24 22:42:43', '2021-12-24 22:42:43');

-- --------------------------------------------------------

--
-- Table structure for table `image_slider`
--

CREATE TABLE `image_slider` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `image` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `image_slider`
--

INSERT INTO `image_slider` (`id`, `user_id`, `image`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '45|50|51', 1, '2021-12-17 23:29:50', '2021-12-17 23:59:56');

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
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `img` varchar(250) DEFAULT NULL,
  `type` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `viewed` int(11) NOT NULL DEFAULT 0,
  `desails` text DEFAULT NULL COMMENT 'id desails have like json or id or other redirect thind desails',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `user_id`, `title`, `description`, `img`, `type`, `status`, `viewed`, `desails`, `created_at`, `updated_at`) VALUES
(1, 1, 'New use created ', 'New user created successfly', NULL, 'new_user', 1, 1, NULL, '2021-12-10 13:30:43', '2022-01-11 12:34:33'),
(8, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-02 23:09:44', '2022-01-12 02:48:34'),
(9, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-02 23:10:48', '2022-01-12 02:48:38'),
(10, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-02 23:12:10', '2022-01-12 02:50:37'),
(11, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-07 10:02:46', '2022-01-07 10:02:46'),
(12, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-07 10:07:31', '2022-01-11 12:36:10'),
(13, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-07 10:07:39', '2022-01-12 02:50:28'),
(14, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-07 10:07:50', '2022-01-12 02:48:39'),
(15, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-07 11:17:04', '2022-01-12 02:48:42'),
(16, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-08 00:38:39', '2022-01-08 00:38:39'),
(17, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-08 01:28:06', '2022-01-12 02:48:44'),
(18, 1, 'New Order', 'New order has been placed successfully', NULL, 'new_order', 1, 0, NULL, '2022-01-09 09:23:09', '2022-01-09 09:23:09'),
(19, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-10 02:10:24', '2022-01-10 02:10:24'),
(20, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-10 02:10:35', '2022-01-10 02:10:35'),
(21, 1, 'New Order', 'New order has been placed successfully', NULL, 'new_order', 1, 0, NULL, '2022-01-11 13:11:12', '2022-01-11 13:11:12'),
(22, 1, 'New Order', 'New order has been placed successfully', NULL, 'new_order', 1, 0, NULL, '2022-01-11 21:57:31', '2022-01-11 21:57:31'),
(23, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-11 22:10:49', '2022-01-11 22:10:49'),
(24, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-11 22:11:03', '2022-01-11 22:11:03'),
(25, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-11 22:13:42', '2022-01-11 22:13:42'),
(26, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-11 22:13:49', '2022-01-11 22:13:49'),
(27, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-11 22:14:15', '2022-01-11 22:14:15'),
(28, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 1, NULL, '2022-01-11 22:14:21', '2022-01-12 02:50:24'),
(29, 1, 'Policy update', 'Privacy policy Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 00:47:33', '2022-01-13 00:47:33'),
(30, 1, 'Policy update', 'Terms and conditions Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 00:57:34', '2022-01-13 00:57:34'),
(31, 1, 'Policy update', 'Return policy Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 01:08:47', '2022-01-13 01:08:47'),
(32, 1, 'Policy update', 'Contact us Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 01:13:44', '2022-01-13 01:13:44'),
(33, 1, 'Policy update', 'About us Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 01:18:14', '2022-01-13 01:18:14'),
(34, 1, 'Policy update', 'About us Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 01:18:41', '2022-01-13 01:18:41'),
(35, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 04:32:51', '2022-01-13 04:32:51'),
(36, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 04:32:58', '2022-01-13 04:32:58'),
(37, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 09:29:39', '2022-01-13 09:29:39'),
(38, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 09:31:58', '2022-01-13 09:31:58'),
(39, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 09:41:43', '2022-01-13 09:41:43'),
(40, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 09:48:13', '2022-01-13 09:48:13'),
(41, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 10:41:34', '2022-01-13 10:41:34'),
(42, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-13 10:44:52', '2022-01-13 10:44:52'),
(43, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 12:56:19', '2022-01-13 12:56:19'),
(44, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 12:56:26', '2022-01-13 12:56:26'),
(45, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 13:05:10', '2022-01-13 13:05:10'),
(46, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 13:06:38', '2022-01-13 13:06:38'),
(47, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 13:07:03', '2022-01-13 13:07:03'),
(48, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 13:07:10', '2022-01-13 13:07:10'),
(49, 1, 'Profile Update', 'Profile update successfully', NULL, 'update', 1, 0, NULL, '2022-01-13 13:07:16', '2022-01-13 13:07:16'),
(50, 1, 'Policy update', 'About us Updated', NULL, 'global_setting', 1, 0, NULL, '2022-01-15 00:18:48', '2022-01-15 00:18:48'),
(51, 1, 'New Order', 'New order has been placed successfully', NULL, 'new_order', 1, 0, NULL, '2022-01-15 01:45:48', '2022-01-15 01:45:48'),
(52, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-15 02:23:14', '2022-01-15 02:23:14'),
(53, 1, 'global setting Update', 'global setting saved successfully', NULL, 'global_setting', 1, 0, NULL, '2022-01-15 02:23:29', '2022-01-15 02:23:29');

-- --------------------------------------------------------

--
-- Table structure for table `offer_exclusive`
--

CREATE TABLE `offer_exclusive` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(500) NOT NULL,
  `image` int(11) NOT NULL,
  `products` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `offer_exclusive`
--

INSERT INTO `offer_exclusive` (`id`, `user_id`, `title`, `image`, `products`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Vagitable offer', 60, '[\"1\",\"6\",\"13\",\"18\"]', 1, '2022-01-07 02:51:03', '2022-01-08 01:42:41'),
(2, 1, 'Fruit offer', 61, '[\"2\",\"12\"]', 1, '2022-01-07 03:30:49', '2022-01-08 01:43:03'),
(3, 1, 'Foodgrains or oil massala offer', 40, '[\"3\",\"5\",\"14\",\"15\"]', 1, '2022-01-07 03:31:29', '2022-01-07 03:31:29');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `guest_id` int(11) DEFAULT NULL,
  `delivery_status` varchar(45) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `shipping_address` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_type` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'unpaid',
  `payment_details` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `grand_total` double(8,2) DEFAULT NULL,
  `coupon_discount` double(8,2) NOT NULL DEFAULT 0.00,
  `code` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` int(20) NOT NULL,
  `viewed` int(1) NOT NULL DEFAULT 0,
  `delivery_viewed` int(1) NOT NULL DEFAULT 0,
  `payment_status_viewed` int(1) DEFAULT 0,
  `commission_calculated` int(11) NOT NULL DEFAULT 0,
  `cashback_coupon` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `guest_id`, `delivery_status`, `shipping_address`, `payment_type`, `payment_status`, `payment_details`, `grand_total`, `coupon_discount`, `code`, `date`, `viewed`, `delivery_viewed`, `payment_status_viewed`, `commission_calculated`, `cashback_coupon`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'pending', '6', 'online', 'done', NULL, 680.00, 0.00, '20211220-060929', 1640023769, 1, 0, 0, 0, 0, '2021-12-20 12:39:29', '2021-12-22 12:57:26'),
(2, 1, NULL, 'pending', '6', 'Cod', 'pending', NULL, 546.00, 0.00, '20211221-044330', 1640105010, 1, 0, 0, 0, 0, '2021-12-21 11:13:30', '2021-12-22 12:57:26'),
(3, 1, NULL, 'on_review', '6', 'Cod', 'pending', NULL, 56.00, 0.00, '20211222-055215', 1640152335, 1, 0, 0, 0, 0, '2021-12-22 00:22:15', '2022-01-09 09:23:58'),
(4, 1, NULL, 'delivered', '6', 'Cod', 'paid', NULL, 281.00, 0.00, '20211222-055327', 1640152407, 1, 0, 0, 0, 0, '2021-12-22 00:23:27', '2022-01-07 10:53:01'),
(5, 1, NULL, 'delivered', '6', 'razorpay', 'paid', '{\"name\":\"razorpay\",\"tid\":\"pay_IbgYZ5bYqhpIqR\"}', 337.00, 0.00, '20211225-110706', 1640430426, 1, 0, 0, 0, 0, '2021-12-25 05:37:06', '2022-01-07 10:52:40'),
(6, 1, NULL, 'cancel', '6', 'cashfree', 'paid', '{\"name\":\"cashfree\",\"paymentMode\":\"CREDIT_CARD\",\"orderId\":\"1640430694338\",\"txTime\":\"2021-12-25 16:42:16\",\"referenceId\":\"1226148\",\"type\":\"CashFreeResponse\",\"txMsg\":\"Transaction Successful\",\"signature\":\"0hcaRO5hb5VK0ctT9BknW7bv0Eh+KNDnvW67WrR1QNY\\u003d\",\"orderAmount\":\"562.00\",\"txStatus\":\"SUCCESS\"}', 562.00, 0.00, '20211225-111218', 1640430738, 1, 0, 0, 0, 0, '2021-12-25 05:42:18', '2021-12-28 02:21:10'),
(7, 1, NULL, 'cancel', '6', 'razorpay', 'paid', '{\"name\":\"razorpay\",\"tid\":\"pay_IcrBko04OsD3bX\"}', 540.00, 0.00, '20211228-100959', 1640686199, 1, 0, 0, 0, 0, '2021-12-28 04:39:59', '2022-01-09 09:18:33'),
(8, 1, NULL, 'pending', '6', 'Cod', 'unpaid', NULL, 1079.00, 0.00, '20220109-025307', 1641739987, 0, 0, 0, 0, 0, '2022-01-09 09:23:07', '2022-01-09 09:23:07'),
(12, 1, NULL, 'pending', '6', 'Cod', 'unpaid', NULL, 392.00, 0.00, '20220111-064111', 1641926471, 1, 0, 0, 0, 0, '2022-01-11 13:11:11', '2022-01-13 12:37:21'),
(17, 1, NULL, 'pending', '6', 'razorpay', 'paid', '{\"name\":\"razorpay\",\"tid\":\"pay_Ijvpq7MgxaM7VU\"}', 546.00, 0.00, '20220115-071544', 1642230944, 1, 0, 0, 0, 0, '2022-01-15 01:45:44', '2022-01-15 03:31:26');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `variation` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double(8,2) DEFAULT NULL,
  `tax` double(8,2) NOT NULL DEFAULT 0.00,
  `shipping_cost` double(8,2) NOT NULL DEFAULT 0.00,
  `quantity` int(11) DEFAULT NULL,
  `payment_status` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'unpaid',
  `delivery_status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'pending',
  `shipping_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT 'home_delivery',
  `pickup_point_id` int(11) DEFAULT NULL,
  `product_referral_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `seller_id`, `product_id`, `variation`, `price`, `tax`, `shipping_cost`, `quantity`, `payment_status`, `delivery_status`, `shipping_type`, `pickup_point_id`, `product_referral_code`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 3, NULL, 104.00, 0.00, 0.00, 1, 'paid', 'pending', 'home_delivery', NULL, NULL, '2021-12-20 12:39:29', '2021-12-20 12:39:29'),
(2, 1, 1, 4, NULL, 281.00, 0.00, 0.00, 1, 'paid', 'pending', 'home_delivery', NULL, NULL, '2021-12-20 12:39:29', '2021-12-20 12:39:29'),
(3, 2, 1, 3, NULL, 265.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2021-12-21 11:13:30', '2021-12-21 11:13:30'),
(4, 2, 1, 4, NULL, 281.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2021-12-21 11:13:31', '2021-12-21 11:13:31'),
(5, 3, 1, 3, NULL, 56.00, 0.00, 0.00, 1, 'unpaid', 'on_review', 'home_delivery', NULL, NULL, '2021-12-22 00:22:15', '2022-01-09 09:23:57'),
(6, 4, 1, 5, NULL, 281.00, 0.00, 0.00, 1, 'paid', 'delivered', 'home_delivery', NULL, NULL, '2021-12-22 00:23:27', '2022-01-07 10:53:01'),
(7, 5, 1, 3, NULL, 56.00, 0.00, 0.00, 1, 'pending', 'delivered', 'home_delivery', NULL, NULL, '2021-12-25 05:37:06', '2022-01-07 10:52:40'),
(8, 5, 1, 4, NULL, 281.00, 0.00, 0.00, 1, 'pending', 'delivered', 'home_delivery', NULL, NULL, '2021-12-25 05:37:07', '2022-01-07 10:52:40'),
(9, 6, 1, 17, NULL, 281.00, 0.00, 0.00, 1, 'pending', 'cancel', 'home_delivery', NULL, NULL, '2021-12-25 05:42:18', '2021-12-27 09:39:34'),
(10, 6, 1, 20, NULL, 281.00, 0.00, 0.00, 1, 'pending', 'cancel', 'home_delivery', NULL, NULL, '2021-12-25 05:42:18', '2021-12-27 09:39:34'),
(11, 7, 1, 3, NULL, 56.00, 0.00, 0.00, 1, 'paid', 'cancel', 'home_delivery', NULL, NULL, '2021-12-28 04:40:00', '2021-12-28 04:40:35'),
(12, 7, 1, 12, NULL, 85.00, 0.00, 0.00, 1, 'paid', 'cancel', 'home_delivery', NULL, NULL, '2021-12-28 04:40:00', '2021-12-28 04:40:35'),
(13, 7, 1, 13, NULL, 399.00, 0.00, 0.00, 1, 'paid', 'cancel', 'home_delivery', NULL, NULL, '2021-12-28 04:40:00', '2021-12-28 04:40:35'),
(14, 8, 1, 14, NULL, 281.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2022-01-09 09:23:07', '2022-01-09 09:23:07'),
(15, 8, 1, 6, NULL, 399.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2022-01-09 09:23:08', '2022-01-09 09:23:08'),
(16, 8, 1, 18, NULL, 399.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2022-01-09 09:23:08', '2022-01-09 09:23:08'),
(17, 12, 1, 3, '10KG', 392.00, 0.00, 0.00, 1, 'unpaid', 'pending', 'home_delivery', NULL, NULL, '2022-01-11 13:11:11', '2022-01-11 13:11:11'),
(19, 17, 1, 4, NULL, 281.00, 0.00, 0.00, 1, 'paid', 'pending', 'home_delivery', NULL, NULL, '2022-01-15 01:45:44', '2022-01-15 01:45:44'),
(20, 17, 1, 3, '5KG', 265.00, 0.00, 0.00, 1, 'paid', 'pending', 'home_delivery', NULL, NULL, '2022-01-15 01:45:45', '2022-01-15 01:45:45');

-- --------------------------------------------------------

--
-- Table structure for table `order_job`
--

CREATE TABLE `order_job` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `type` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_job`
--

INSERT INTO `order_job` (`id`, `order_id`, `type`, `action`, `status`, `created_at`, `updated_at`) VALUES
(1, 12, 'success', 'email', 1, '2022-01-11 18:30:00', '2022-01-11 21:57:37');

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
('ranjanashish254@gmail.com', '$2y$10$Nnv9JVj11Nyl585E6C6ZIO3cEeUN8jU3HMk/c/QNGM/QglR3ML2ee', '2021-12-08 05:21:49');

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

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(5, 'App\\Models\\User', 14, 'user User login api', 'c504720922736bb0bc4c62df440fc1de17472d1a0ea5f11ca7b49015506b2500', '[\"*\"]', NULL, '2021-12-09 01:19:26', '2021-12-09 01:19:26'),
(6, 'App\\Models\\User', 15, 'user User login api', '296940260875c1415e223dc97b1c01198ae52b5137af64450e1665a2ff657c23', '[\"*\"]', NULL, '2021-12-09 01:23:12', '2021-12-09 01:23:12'),
(7, 'App\\Models\\User', 15, 'User login api', 'd135f50b16dfb185c4c75c1ddcda66420f84de752b732c674f4aeff33ad4443b', '[\"*\"]', NULL, '2021-12-09 01:24:36', '2021-12-09 01:24:36'),
(8, 'App\\Models\\User', 1, 'User login api', '637672cdc7bd924224f0ee09e17adcc731f9754108d95c5626ccb47b24e4615b', '[\"*\"]', NULL, '2021-12-09 03:48:37', '2021-12-09 03:48:37'),
(9, 'App\\Models\\User', 1, 'User login api', '0ac0dab6bdc72d817152024b78d16b708f03f2008a241e9a57fe1235d8857f52', '[\"*\"]', NULL, '2021-12-09 04:03:57', '2021-12-09 04:03:57'),
(10, 'App\\Models\\User', 1, 'User login api', '2a486aecff39d2ed89aa25d10c3fd38f59ab04d7a67e11e6bae599f0ea3f6e18', '[\"*\"]', NULL, '2021-12-09 04:05:04', '2021-12-09 04:05:04'),
(11, 'App\\Models\\User', 1, 'User login api', 'eb1aad82c91790493aa0c00d158f7f023d9a03f88d5684ef533cf6d78013ff40', '[\"*\"]', NULL, '2021-12-09 04:05:11', '2021-12-09 04:05:11'),
(12, 'App\\Models\\User', 1, 'User login api', '6089363e51b6d189690e727d30987ec174a20fbcab2f5ad6a618d223da9b0474', '[\"*\"]', NULL, '2021-12-09 04:05:26', '2021-12-09 04:05:26'),
(13, 'App\\Models\\User', 1, 'User login api', 'de110731ed74d787e01dd8206c15387a0e40caeff1aba25877b0997f1d25d97f', '[\"*\"]', NULL, '2021-12-09 04:05:51', '2021-12-09 04:05:51'),
(14, 'App\\Models\\User', 1, 'User login api', '40a06af697d947c19cb8ece593f172d6b679784f479a0832daaaeb623b7bd309', '[\"*\"]', NULL, '2021-12-09 04:11:08', '2021-12-09 04:11:08'),
(15, 'App\\Models\\User', 1, 'User login api', '113fec0f62de1733556267c718e2b123aaedf46d09985cdd00440886d057f390', '[\"*\"]', NULL, '2021-12-09 04:11:15', '2021-12-09 04:11:15'),
(16, 'App\\Models\\User', 1, 'User login api', '5ba9dbc62de28299dff6e2f5f1ef1150176a1ee2370166d264d0163ab4dda981', '[\"*\"]', NULL, '2021-12-09 04:15:49', '2021-12-09 04:15:49'),
(17, 'App\\Models\\User', 1, 'User login api', '614b79ccad408b93a1c6d2e67ac7565b576d95754206fd0fd2458a04f79076b3', '[\"*\"]', NULL, '2021-12-09 04:17:02', '2021-12-09 04:17:02'),
(18, 'App\\Models\\User', 1, 'User login api', '03e355e875bc1609e76425b89315b204cd219c33f6427b8b30781c1e6060278b', '[\"*\"]', NULL, '2021-12-09 04:19:28', '2021-12-09 04:19:28'),
(19, 'App\\Models\\User', 1, 'User login api', 'bd51006b88dcc98100d600a845402bde5be245bd6bcc63469df786f49f522841', '[\"*\"]', NULL, '2021-12-09 04:21:27', '2021-12-09 04:21:27'),
(20, 'App\\Models\\User', 1, 'User login api', 'ac0e65868a0003a944c7793682c2ac0f23c78e07eeb8bfe645a09278fbf069e1', '[\"*\"]', NULL, '2021-12-09 04:25:37', '2021-12-09 04:25:37'),
(21, 'App\\Models\\User', 1, 'User login api', 'e3799772f9b19b79383eb37828b7541030a7030ff1744aa7bce23830118feb58', '[\"*\"]', NULL, '2021-12-09 04:45:22', '2021-12-09 04:45:22'),
(22, 'App\\Models\\User', 1, 'User login api', 'bf1c777684aa2a1b724d0f44c0676c9cbf2c800b4fce1ab886a37dce21d55f28', '[\"*\"]', NULL, '2021-12-09 04:46:36', '2021-12-09 04:46:36'),
(23, 'App\\Models\\User', 1, 'User login api', '65e0f186d9cdc5f6bc993858b1e57035e5f09182ae8b2f652c358bd7e5ad1b77', '[\"*\"]', NULL, '2021-12-09 04:47:20', '2021-12-09 04:47:20'),
(24, 'App\\Models\\User', 1, 'User login api', '16e92a85745851528c9eb42a7d067d40497aec7f65122df65c9e6595c6824324', '[\"*\"]', NULL, '2021-12-09 04:47:50', '2021-12-09 04:47:50'),
(25, 'App\\Models\\User', 1, 'User login api', 'd143f9b79da66851216076a11a02c16e9f6c00974d92bc2ea819237dc2ae4e52', '[\"*\"]', NULL, '2021-12-09 08:51:29', '2021-12-09 08:51:29'),
(26, 'App\\Models\\User', 16, 'user User login api', 'db10bc650787ba9b03de0fa40e104262a2647a604942bc6a6dc3ac6f7d0ef704', '[\"*\"]', NULL, '2021-12-09 08:57:13', '2021-12-09 08:57:13'),
(27, 'App\\Models\\User', 16, 'User login api', '53eee42d51d37d4b5d7b754f09ff838497681c6b64be3c138959c94cbb0c1e78', '[\"*\"]', NULL, '2021-12-09 08:57:35', '2021-12-09 08:57:35'),
(28, 'App\\Models\\User', 17, 'user User login api', '439ebecc8d34095afdf9b2d523d5167a9ffd983e5cd85ac4b634fbf5f19aed36', '[\"*\"]', NULL, '2021-12-09 11:44:22', '2021-12-09 11:44:22'),
(29, 'App\\Models\\User', 1, 'User login api', 'b14f0680db3ee010cb573f013ea3dc2f80c292cca4912cb278be25258e01b7a7', '[\"*\"]', '2022-01-08 09:30:50', '2021-12-09 12:16:28', '2022-01-08 09:30:50'),
(30, 'App\\Models\\User', 15, 'User login api', '1244605cdbfed7f70d85f5dd62a5b28942ccd7d22c077e1e427b007e057e39e6', '[\"*\"]', '2021-12-10 11:44:29', '2021-12-10 03:12:24', '2021-12-10 11:44:29'),
(31, 'App\\Models\\User', 15, 'User login api', '58b15e5bca4dd8f846c934e1b6ab18df45806845d34c457bfc07651f5ddeb6be', '[\"*\"]', NULL, '2021-12-10 03:20:28', '2021-12-10 03:20:28'),
(32, 'App\\Models\\User', 15, 'User login api', '99ccbb5bd4a7581d8dd5cf97cb2b505f2523e7ab401531b86b61f1eb327b43a5', '[\"*\"]', NULL, '2021-12-16 21:18:58', '2021-12-16 21:18:58'),
(33, 'App\\Models\\User', 15, 'User login api', '15315de29c194eff6580705a2f738fa46e8fec33db3682a08d37464895300a95', '[\"*\"]', '2021-12-20 12:30:19', '2021-12-16 21:27:31', '2021-12-20 12:30:19'),
(34, 'App\\Models\\User', 1, 'User login api', '7ed3a5c631ab5197b34cb56875acf1b50efa532a3f1c771d24969329b37224b8', '[\"*\"]', '2021-12-17 00:37:20', '2021-12-16 23:55:07', '2021-12-17 00:37:20'),
(35, 'App\\Models\\User', 1, 'User login api', '5765ac3476f5114c7673f84f271a8cf268f0829d1db02a41405537629ba1e098', '[\"*\"]', '2022-01-12 23:51:08', '2021-12-20 12:30:47', '2022-01-12 23:51:08'),
(36, 'App\\Models\\User', 1, 'User login api', '3021ca8f724f6f3d05e7c2152ea7e872fcc996452de60be1fa64411dd6e4f5e7', '[\"*\"]', NULL, '2021-12-28 02:15:26', '2021-12-28 02:15:26'),
(37, 'App\\Models\\User', 1, 'Personal Access Token', '9387da4d6f956948ba74ffada00930353f948496c3698981df12694ac385ee10', '[\"*\"]', NULL, '2022-01-01 13:52:01', '2022-01-01 13:52:01'),
(38, 'App\\Models\\User', 1, 'Personal Access Token', '1057711e1364e8b03bd21cd7524b1e552abb3d9e94833076a1a60c6e36dce3a6', '[\"*\"]', '2022-01-09 08:46:17', '2022-01-01 13:52:34', '2022-01-09 08:46:17'),
(39, 'App\\Models\\User', 1, 'Personal Access Token', '77f3cef9f09e73fbc11ac7b66c67be211d4a51207fac9741aab6d5dcb780cc26', '[\"*\"]', NULL, '2022-01-01 13:53:07', '2022-01-01 13:53:07'),
(40, 'App\\Models\\User', 1, 'Personal Access Token', 'a9fa841176a508f2fcfbce163706c671dd537681154b641588d83376f071ed53', '[\"*\"]', NULL, '2022-01-01 13:55:03', '2022-01-01 13:55:03'),
(41, 'App\\Models\\User', 1, 'Personal Access Token', 'be9cb90ee2fe7b4bbc373da7b829c601a30e2dd8ffdf6612158485574006d9af', '[\"*\"]', NULL, '2022-01-01 14:02:12', '2022-01-01 14:02:12'),
(42, 'App\\Models\\User', 1, 'Personal Access Token', '66b020c53fe9ed0d202012c827ccebd71dc04142d8036f2d6d6ca32c9294a2a8', '[\"*\"]', NULL, '2022-01-01 23:06:26', '2022-01-01 23:06:26'),
(43, 'App\\Models\\User', 1, 'Personal Access Token', '4e50dd54b361f8c9c37668947f6e7e148b5bb45f39d1299581855d28e52ee5d1', '[\"*\"]', '2022-01-08 09:36:00', '2022-01-08 09:30:51', '2022-01-08 09:36:00'),
(44, 'App\\Models\\User', 1, 'Personal Access Token', 'f1149677130cb73cc5f85929a83dd4bc9ef26e175433b3e883d58959d3d13fc3', '[\"*\"]', '2022-01-08 09:39:51', '2022-01-08 09:36:00', '2022-01-08 09:39:51'),
(45, 'App\\Models\\User', 1, 'Personal Access Token', '8c081a0ba236bbd16d0da72dbb406b140b53d17a53fbd3cad27c0118f3b868a7', '[\"*\"]', '2022-01-08 09:40:48', '2022-01-08 09:39:51', '2022-01-08 09:40:48'),
(46, 'App\\Models\\User', 1, 'Personal Access Token', '7e7beffb255e8b04de71681fcde7cdae29c6b4b300e054e2bcaab7faa1f5a329', '[\"*\"]', '2022-01-08 09:41:42', '2022-01-08 09:40:49', '2022-01-08 09:41:42'),
(47, 'App\\Models\\User', 1, 'Personal Access Token', 'e4caf7e5f0bfc57c8c0d3f4b59d02102126e7c1903e5d7cff4a3c481c068037c', '[\"*\"]', '2022-01-08 09:41:52', '2022-01-08 09:41:42', '2022-01-08 09:41:52'),
(48, 'App\\Models\\User', 1, 'Personal Access Token', '0289e51c6a6d3427c03a498467ab7edff53b023fce50c992e0f0200883b80b7f', '[\"*\"]', '2022-01-08 09:42:40', '2022-01-08 09:41:52', '2022-01-08 09:42:40'),
(49, 'App\\Models\\User', 1, 'Personal Access Token', '41c93db9b5f4ee6892058751c0812f30f90f47f878c7081b725f006938d7ddeb', '[\"*\"]', '2022-01-08 09:42:55', '2022-01-08 09:42:40', '2022-01-08 09:42:55'),
(50, 'App\\Models\\User', 1, 'Personal Access Token', 'ed4268cda88fa69ffd3769837b644d6c9305cedb45b1c7096b5196b3850602f1', '[\"*\"]', '2022-01-08 09:46:39', '2022-01-08 09:42:55', '2022-01-08 09:46:39'),
(51, 'App\\Models\\User', 1, 'Personal Access Token', 'cb165762305cb38fecdd504091044aac6a77f8058899817393e5ab4f78978847', '[\"*\"]', '2022-01-08 10:57:10', '2022-01-08 09:46:39', '2022-01-08 10:57:10'),
(52, 'App\\Models\\User', 1, 'Personal Access Token', '7ae70180c9bd5cba1dd5479402e6f1f48d3a41bc54956e9a660fbdaf9a0ab867', '[\"*\"]', '2022-01-08 10:59:41', '2022-01-08 10:57:11', '2022-01-08 10:59:41'),
(53, 'App\\Models\\User', 1, 'Personal Access Token', 'a57878ec93197a1cfd7abcde57032597f30c4aa1d45738936f1b0dc5fe55d3bf', '[\"*\"]', NULL, '2022-01-08 10:57:18', '2022-01-08 10:57:18'),
(54, 'App\\Models\\User', 1, 'Personal Access Token', '6e76b6e53e88d1a0d1ee004b789d0b443ad8a97d32e28d77c77cb1c3ff89899e', '[\"*\"]', NULL, '2022-01-08 10:57:28', '2022-01-08 10:57:28'),
(55, 'App\\Models\\User', 1, 'Personal Access Token', '5ca17083a47475f3245b0dd5fbe60d316f22330958a1a1408a0af9efa20627ec', '[\"*\"]', NULL, '2022-01-08 10:57:41', '2022-01-08 10:57:41'),
(56, 'App\\Models\\User', 1, 'Personal Access Token', '59a07a59d7b34bdba1418a7bfb696efc299ccf408469ea4413dbc906327f6e7b', '[\"*\"]', '2022-01-10 04:13:29', '2022-01-08 10:59:41', '2022-01-10 04:13:29'),
(57, 'App\\Models\\User', 1, 'Personal Access Token', 'e6a3b0ebcb936e2479802fb6544b5fa22426645203f9ed52c7644b884816d706', '[\"*\"]', '2022-01-10 04:16:29', '2022-01-10 04:13:29', '2022-01-10 04:16:29'),
(58, 'App\\Models\\User', 1, 'Personal Access Token', '5dc1678f2f3534ea6425c2176094d89a5e46fb2384990f78a87e06fdd56504b9', '[\"*\"]', '2022-01-10 04:30:16', '2022-01-10 04:16:29', '2022-01-10 04:30:16'),
(59, 'App\\Models\\User', 1, 'Personal Access Token', '163e8ff9514bb16e26702130cc88f81ad7a462fdbc53ab7fade861f571059650', '[\"*\"]', '2022-01-10 04:33:33', '2022-01-10 04:30:16', '2022-01-10 04:33:33'),
(60, 'App\\Models\\User', 1, 'Personal Access Token', '178aef4bdbfba3d732fe7365c10118afa34295769be22009e6022dd51661d069', '[\"*\"]', '2022-01-10 05:00:23', '2022-01-10 04:33:33', '2022-01-10 05:00:23'),
(61, 'App\\Models\\User', 1, 'Personal Access Token', '83c6723186be153528749482ebb15f5453aeebbbbada4115d70d36c41b234883', '[\"*\"]', '2022-01-10 05:03:21', '2022-01-10 05:00:23', '2022-01-10 05:03:21'),
(62, 'App\\Models\\User', 1, 'Personal Access Token', '8e61ad0eed6fb38ea9f0a90fe5345420818197050793c1613b8248946dfc86de', '[\"*\"]', '2022-01-10 05:22:31', '2022-01-10 05:03:21', '2022-01-10 05:22:31'),
(63, 'App\\Models\\User', 1, 'Personal Access Token', '470de2af8bf0c2e95991f135b86af852c1f46549df4d7fb63e79588deec2af92', '[\"*\"]', '2022-01-11 12:34:28', '2022-01-10 05:22:31', '2022-01-11 12:34:28'),
(64, 'App\\Models\\User', 1, 'Personal Access Token', 'ff6940e8629af8c7a001fc8f149835143fee322e37033aed71c771e080b90552', '[\"*\"]', '2022-01-11 13:11:40', '2022-01-11 12:34:28', '2022-01-11 13:11:40'),
(65, 'App\\Models\\User', 1, 'Personal Access Token', 'c4938cade41148915e6a9897225841beb01a768208b63e90a3213d79d9e24238', '[\"*\"]', '2022-01-12 02:55:17', '2022-01-11 13:11:40', '2022-01-12 02:55:17'),
(66, 'App\\Models\\User', 1, 'Personal Access Token', '37274d14207e38dacc298f33a79c404529e9f4deef045dacf8aea1b5e066b5e1', '[\"*\"]', '2022-01-12 02:55:10', '2022-01-12 02:48:31', '2022-01-12 02:55:10'),
(67, 'App\\Models\\User', 1, 'Personal Access Token', '1aa1c572637240537d52ca3028929e166c058c7e180644bd0a537c13006aba76', '[\"*\"]', '2022-01-12 02:58:56', '2022-01-12 02:55:10', '2022-01-12 02:58:56'),
(68, 'App\\Models\\User', 1, 'Personal Access Token', 'a44a91375c53ee54dd10d580ac09c4390d7a8778e088f951df18dc8d78dd5354', '[\"*\"]', '2022-01-12 03:16:19', '2022-01-12 02:58:56', '2022-01-12 03:16:19'),
(69, 'App\\Models\\User', 1, 'Personal Access Token', '0114f3b3570e469b705a3bcbb1e771bcd469448c246053d859a8d7cb0b7cd921', '[\"*\"]', '2022-01-12 03:18:01', '2022-01-12 03:16:19', '2022-01-12 03:18:01'),
(70, 'App\\Models\\User', 1, 'Personal Access Token', '0ddec63ea558e8b1d06c02435d2efa518967fb77ec8dabfc6904b508fcbb70ba', '[\"*\"]', '2022-01-12 03:19:38', '2022-01-12 03:18:01', '2022-01-12 03:19:38'),
(71, 'App\\Models\\User', 1, 'Personal Access Token', '6172222ebd5848903d83d417a5842611e03ca140212315a3423c1ec769d25402', '[\"*\"]', '2022-01-12 04:05:38', '2022-01-12 03:19:39', '2022-01-12 04:05:38'),
(72, 'App\\Models\\User', 1, 'Personal Access Token', '301623f6aacb55a6ff91171dc7e870dba32e6a217c3d6b326c41f320035c2d01', '[\"*\"]', NULL, '2022-01-12 04:04:30', '2022-01-12 04:04:30'),
(73, 'App\\Models\\User', 1, 'Personal Access Token', '65c2a4e35242159fb4b41c309fcb1de920abdff2af73aeee30f5566cc0a0b518', '[\"*\"]', '2022-01-12 04:08:32', '2022-01-12 04:05:38', '2022-01-12 04:08:32'),
(74, 'App\\Models\\User', 1, 'Personal Access Token', 'be432cf157e3ae550c008d9f1db219b038e8274fecdaca14e4845cb059cbecd9', '[\"*\"]', '2022-01-12 04:36:51', '2022-01-12 04:08:32', '2022-01-12 04:36:51'),
(75, 'App\\Models\\User', 1, 'Personal Access Token', '9e66210d76a755b283a389e7299b7d6061254d3a6230838c430cf1e9dd477149', '[\"*\"]', '2022-01-12 04:41:24', '2022-01-12 04:36:52', '2022-01-12 04:41:24'),
(76, 'App\\Models\\User', 1, 'Personal Access Token', 'e67af56214e49c6aa95aa3fde8e0c109ad3b37bcd10fca2a69e8e5042123255a', '[\"*\"]', NULL, '2022-01-12 04:41:24', '2022-01-12 04:41:24'),
(77, 'App\\Models\\User', 1, 'User login api', 'fd7bc299dce833a32ea47b09348de16879e1e5f86976a9057ec84fbd45ec8579', '[\"*\"]', '2022-01-12 08:53:52', '2022-01-12 08:53:30', '2022-01-12 08:53:52'),
(78, 'App\\Models\\User', 1, 'Personal Access Token', 'e0dc6276ff7fb1042d9ad2561e2e7e063cd5d05fb341b2f360f67e8193c5f4eb', '[\"*\"]', '2022-01-12 08:55:28', '2022-01-12 08:53:52', '2022-01-12 08:55:28'),
(79, 'App\\Models\\User', 1, 'Personal Access Token', '6f6bfdaec5bac12738c48708b696d03f404bc9026fb446aa1f153bcd850a73d5', '[\"*\"]', NULL, '2022-01-12 08:55:28', '2022-01-12 08:55:28'),
(80, 'App\\Models\\User', 1, 'User login api', '8288a2a3c356391ef82953f10b9467ff86ba29ac064a6c1bc738fb673cdfb89a', '[\"*\"]', '2022-01-12 11:41:31', '2022-01-12 09:01:19', '2022-01-12 11:41:31'),
(81, 'App\\Models\\User', 1, 'Personal Access Token', 'cb5f1b00a57b320b79e5bf70d9e7565d6418a79e60005d13567f0aa33b08bf4c', '[\"*\"]', '2022-01-12 12:53:44', '2022-01-12 11:41:37', '2022-01-12 12:53:44'),
(82, 'App\\Models\\User', 1, 'Personal Access Token', 'ad3b294bf0e9339321afab4990abc6fd2211ca8e736473f58e506af874aba8a2', '[\"*\"]', '2022-01-12 12:54:18', '2022-01-12 12:53:45', '2022-01-12 12:54:18'),
(83, 'App\\Models\\User', 1, 'Personal Access Token', '9f55d03ac8572d5f0f1619773aa6f8bc6668c730e40ea99fce84a783740b8c86', '[\"*\"]', '2022-01-12 13:16:12', '2022-01-12 12:54:18', '2022-01-12 13:16:12'),
(84, 'App\\Models\\User', 1, 'Personal Access Token', 'b7eb82b4eb997236f77a66b139bdf86009591329d15d7aea429a769c56a8d35a', '[\"*\"]', '2022-01-12 13:21:49', '2022-01-12 13:16:12', '2022-01-12 13:21:49'),
(85, 'App\\Models\\User', 1, 'Personal Access Token', '22f4cf7b53993c7834343620b6ed2b388d5dfa7d8024fdf3d519dcb748bb667c', '[\"*\"]', '2022-01-12 13:22:10', '2022-01-12 13:21:49', '2022-01-12 13:22:10'),
(86, 'App\\Models\\User', 1, 'Personal Access Token', '16775189ff887ef0646eea14d6a5c99a419aa18a56bf9ca611797f5a6b3b14eb', '[\"*\"]', '2022-01-13 01:20:23', '2022-01-12 13:22:10', '2022-01-13 01:20:23'),
(87, 'App\\Models\\User', 1, 'Personal Access Token', '84740d8b785d03da7b94d4d208e65e28bf25aac4b2217495d1c49069c4c42ce3', '[\"*\"]', '2022-01-13 04:04:09', '2022-01-13 01:20:23', '2022-01-13 04:04:09'),
(88, 'App\\Models\\User', 1, 'Personal Access Token', 'cea5d98bc1860f2e6bdefec9e99a26968ae54d329c82b177c70a8ae63f39198b', '[\"*\"]', '2022-01-13 04:04:11', '2022-01-13 04:04:08', '2022-01-13 04:04:11'),
(89, 'App\\Models\\User', 1, 'Personal Access Token', '57cf03d66ddaff6f68dac1774e2d52683aeeb8bb481dfe3ee06ce53415e3f61d', '[\"*\"]', '2022-01-13 13:38:01', '2022-01-13 04:04:11', '2022-01-13 13:38:01'),
(90, 'App\\Models\\User', 1, 'Personal Access Token', '843acc459a73db46fa878521d75c8926d3bd672fe68dacd0d422f4e39fa0c53f', '[\"*\"]', '2022-01-14 23:06:33', '2022-01-13 13:38:01', '2022-01-14 23:06:33'),
(91, 'App\\Models\\User', 1, 'Personal Access Token', '58d288824dbc49084ee83fc48f23a84597952ae2f35e5d6c7ae9d5bbe081adde', '[\"*\"]', '2022-01-14 23:42:15', '2022-01-14 23:06:33', '2022-01-14 23:42:15'),
(92, 'App\\Models\\User', 1, 'Personal Access Token', 'bdf21282c38f9da518555678f5a1607c0f0212b0ccca089f689979818a3c0fe7', '[\"*\"]', '2022-01-14 23:44:20', '2022-01-14 23:42:15', '2022-01-14 23:44:20'),
(93, 'App\\Models\\User', 1, 'Personal Access Token', '31d7b5ce41166d67939c49899d9a5db499103c16fa1ea26beddbe847a74ae964', '[\"*\"]', '2022-01-14 23:51:17', '2022-01-14 23:44:20', '2022-01-14 23:51:17'),
(94, 'App\\Models\\User', 1, 'Personal Access Token', '21bd93a4d2a8f6e09525d35150551282c679f8b5832ddb7ba1c31d63efb91524', '[\"*\"]', '2022-01-14 23:55:28', '2022-01-14 23:51:18', '2022-01-14 23:55:28'),
(95, 'App\\Models\\User', 1, 'Personal Access Token', '9c295d2b6d92b74db781fd6c6b4a2055c912876648d220b858fdce341052eabe', '[\"*\"]', '2022-01-15 00:08:18', '2022-01-14 23:55:28', '2022-01-15 00:08:18'),
(96, 'App\\Models\\User', 1, 'Personal Access Token', 'c5e913219eaa962d1b5ce464b455b1f1e553548df25a2e35b69ccbe00a5cc148', '[\"*\"]', '2022-01-15 00:09:17', '2022-01-15 00:08:18', '2022-01-15 00:09:17'),
(97, 'App\\Models\\User', 1, 'Personal Access Token', 'ecea756735ce100c2ddb3d65745491c2c725abbe840cb283b5eca98ad6bd3fa7', '[\"*\"]', '2022-01-15 00:17:37', '2022-01-15 00:09:17', '2022-01-15 00:17:37'),
(98, 'App\\Models\\User', 1, 'Personal Access Token', '96de1d03cc3727667d20683272b9f807783dacef0b9acecd67dc68441cb3749e', '[\"*\"]', NULL, '2022-01-15 00:17:06', '2022-01-15 00:17:06'),
(99, 'App\\Models\\User', 1, 'Personal Access Token', '6e57de5b005c99afb1253f2df8bd8925bbac9cfa059beeb44adfa01de10ecf95', '[\"*\"]', '2022-01-15 00:29:36', '2022-01-15 00:17:37', '2022-01-15 00:29:36'),
(100, 'App\\Models\\User', 1, 'Personal Access Token', '6473cd8860f51a77832f53c99d5a8a81ed693f5c03cb1a9cc324e558ff3f0783', '[\"*\"]', '2022-01-15 00:35:33', '2022-01-15 00:29:36', '2022-01-15 00:35:33'),
(101, 'App\\Models\\User', 1, 'Personal Access Token', '554cc9470bea91d9504718ee503a7843b6ec76a35ef9a589c6c4c3ffb6182105', '[\"*\"]', '2022-01-15 00:40:27', '2022-01-15 00:35:34', '2022-01-15 00:40:27'),
(102, 'App\\Models\\User', 1, 'Personal Access Token', 'e2b56cd859d0f857b8f0ed5ef7ab3a4eadfcdf31610d2faafbe646754c736ba7', '[\"*\"]', '2022-01-15 00:41:19', '2022-01-15 00:40:27', '2022-01-15 00:41:19'),
(103, 'App\\Models\\User', 1, 'Personal Access Token', '35b6d899a1d40167328772df72788c77546a1baedec3db3f51b9972171664ae5', '[\"*\"]', '2022-01-15 01:11:29', '2022-01-15 00:41:20', '2022-01-15 01:11:29'),
(104, 'App\\Models\\User', 1, 'Personal Access Token', 'cd7144badf749c07306f70f47eba3f0781ed851bcd6a24c6bc36662a9016ef5a', '[\"*\"]', '2022-01-15 01:15:44', '2022-01-15 01:11:29', '2022-01-15 01:15:44'),
(105, 'App\\Models\\User', 1, 'Personal Access Token', '4b28c047b5d87566ffa265dd737596216362805b449ced7db266ccc49d7a5878', '[\"*\"]', '2022-01-15 01:19:11', '2022-01-15 01:15:44', '2022-01-15 01:19:11'),
(106, 'App\\Models\\User', 1, 'Personal Access Token', '8c12d38363602faafabed993c680b559b6d12771bc04bf64b48a6445a353c231', '[\"*\"]', NULL, '2022-01-15 01:18:23', '2022-01-15 01:18:23'),
(107, 'App\\Models\\User', 1, 'Personal Access Token', '35e6772aa5f43b047574b327cb859cff8896b2b37f11136608e7bf3815a4e9e7', '[\"*\"]', '2022-01-15 01:47:22', '2022-01-15 01:19:11', '2022-01-15 01:47:22'),
(108, 'App\\Models\\User', 1, 'Personal Access Token', 'a5e23e2248d416cff88efa8b20d66ff99c2b33238badd1a11094f68b07e0c9e8', '[\"*\"]', NULL, '2022-01-15 01:47:22', '2022-01-15 01:47:22');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `added_by` varchar(6) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'admin',
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) DEFAULT NULL,
  `subsubcategory_id` int(11) DEFAULT NULL,
  `brand_id` int(11) DEFAULT NULL,
  `photos` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `featured_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `flash_deal_img` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_provider` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `video_link` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `nutritions` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `caution` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_price` double(8,2) NOT NULL,
  `purchase_price` double(8,2) DEFAULT NULL,
  `variant_product` int(1) NOT NULL DEFAULT 0,
  `attributes` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '[]',
  `choice_options` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `colors` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `variations` text COLLATE utf8_unicode_ci DEFAULT NULL,
  `todays_deal` int(11) NOT NULL DEFAULT 0,
  `published` int(11) NOT NULL DEFAULT 1,
  `featured` int(11) NOT NULL DEFAULT 0,
  `current_stock` int(10) DEFAULT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` double(8,2) DEFAULT NULL,
  `discount_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tax` double(8,2) DEFAULT NULL,
  `tax_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'flat_rate',
  `shipping_cost` double(8,2) DEFAULT 0.00,
  `num_of_sale` int(11) NOT NULL DEFAULT 0,
  `meta_title` mediumtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_description` longtext COLLATE utf8_unicode_ci DEFAULT NULL,
  `meta_img` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pdf` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `refundable` int(1) NOT NULL DEFAULT 0,
  `rating` double(8,2) NOT NULL DEFAULT 0.00,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `digital` int(1) NOT NULL DEFAULT 0,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_code` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `exclusive_offer` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `added_by`, `user_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `brand_id`, `photos`, `thumbnail_img`, `featured_img`, `flash_deal_img`, `video_provider`, `video_link`, `tags`, `description`, `nutritions`, `caution`, `unit_price`, `purchase_price`, `variant_product`, `attributes`, `choice_options`, `colors`, `variations`, `todays_deal`, `published`, `featured`, `current_stock`, `unit`, `discount`, `discount_type`, `tax`, `tax_type`, `shipping_type`, `shipping_cost`, `num_of_sale`, `meta_title`, `meta_description`, `meta_img`, `pdf`, `slug`, `refundable`, `rating`, `barcode`, `digital`, `file_name`, `file_path`, `product_code`, `exclusive_offer`, `created_at`, `updated_at`) VALUES
(1, 'SEOAPP', 'admin', 1, 7, NULL, NULL, NULL, '6|7|11|12|13|14|15|16|29', '16', NULL, NULL, NULL, NULL, '555,j,uiuiuo', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 399.00, 399.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"1\",\"2\",\"5\",\"6\"]}]', NULL, NULL, 0, 1, 0, 0, 'PC', 100.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'seoapp', 0, 0.00, NULL, 0, NULL, NULL, 'MB-2214-GO', 0, '2021-12-13 12:29:09', '2021-12-15 02:02:03'),
(2, 'Apple Updat', 'admin', 1, 6, NULL, NULL, NULL, '6|7|11|13|14|34', '6', NULL, NULL, NULL, NULL, 'Apple,sabe,fruit', 'This article is about the fruit and tree. For the American technology company, see Apple Inc. For other uses, see Apple (disambiguation), Apple blossom (disambiguation), and Apple tree (disambiguation).\r\nApple\r\nPink lady and cross section.jpg\r\n\'Cripps Pink\' apples\r\nMalus domestica a1.jpg\r\nFlowers\r\nScientific classificationedit\r\nKingdom:	Plantae\r\nClade:	Tracheophytes\r\nClade:	Angiosperms\r\nClade:	Eudicots\r\nClade:	Rosids\r\nOrder:	Rosales\r\nFamily:	Rosaceae\r\nGenus:	Malus\r\nSpecies:	M. domestica\r\nBinomial name\r\nMalus domestica\r\nBorkh., 1803\r\nSynonyms[1][2]\r\nMalus communis Desf.\r\nMalus pumila Mil.\r\nM. frutescens Medik.\r\nM. paradisiaca (L.) Medikus\r\nM. sylvestris Mil.\r\nPyrus malus L.\r\nPyrus malus var. paradisiaca L.\r\nPyrus dioica Moench\r\nAn apple is an edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today. Apples have been grown for thousands of years in Asia and Europe and were brought to North America by European colonists. Apples have religious and mythological significance in many cultures, including Norse, Greek, and European Christian tradition.', 'Apples grown from seed tend to be very different from those of the parents, and the resultant fruit frequently lack desired characteristics. Generally then, apple cultivars are propagated by clonal grafting onto rootstocks', NULL, 86.00, 85.00, 1, '[\"1\",\"3\"]', '[{\"attribute_id\":\"1\",\"values\":[\"Big\",\"Small\",\"Large\"]},{\"attribute_id\":\"3\",\"values\":[\"0.5KG\",\"1KG\",\"1.5KG\",\"2KG\",\"2.5KG\",\"3KG\",\"3.5KG\",\"4KG\",\"4.5KG\",\"5KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'KG', 5.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'apple-updat', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-14 10:40:24', '2021-12-17 12:55:40'),
(3, 'Aashirvaad Atta/Godihittu - Whole Wheat, 5 kg Pouch', 'admin', 1, 18, NULL, NULL, NULL, '41|42|43', '43', NULL, NULL, NULL, NULL, 'Aashirvaad,attta', 'Aashirvaad Whole Wheat Atta has 0% maida and 100% atta. This means you serve soft, fluffy rotis and a whole lot of health and happiness.\r\nClick here for unique and delicious recipes - https://www.bigbasket.com/flavors/collections/232/flours-sooji/', NULL, NULL, 280.00, 280.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"1KG\",\"2KG\",\"5KG\",\"10KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'KG', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 7, NULL, NULL, NULL, NULL, 'aashirvaad-atta/godihittu--whole-wheat,-5-kg-pouch', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-14 22:40:06', '2022-01-15 01:45:45'),
(4, 'BB Royal Cumin/Jeera/Jeerige - Whole, 200 g Pouch', 'admin', 1, 16, NULL, NULL, NULL, '44|45', '45', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[]', '[]', NULL, NULL, 0, 1, 0, 28, 'G5', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 5, NULL, NULL, NULL, NULL, 'bb-royal-cumin/jeera/jeerige--whole,-200-g-pouch', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-14 22:49:40', '2022-01-15 01:45:45'),
(5, 'BB Royal Cumin/Jeera/Jeerige - Whole, 200 g Pouch', 'admin', 1, 18, NULL, NULL, NULL, '44|45', '45', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G3', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 2, NULL, NULL, NULL, NULL, 'bb-royal-cumin/jeera/jeerige--whole,-200-g-pouch', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-14 23:06:07', '2021-12-22 00:23:27'),
(6, 'SEOAPP 2', 'admin', 1, 7, NULL, NULL, NULL, '6|7|11|12|13|14|15|16|29', '16', NULL, NULL, NULL, NULL, '555,j,uiuiuo', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 399.00, 399.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"1\",\"2\",\"5\",\"6\"]}]', NULL, NULL, 0, 1, 0, -3, 'PC', 100.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 2, NULL, NULL, NULL, NULL, 'seoapp-2', 0, 0.00, NULL, 0, NULL, NULL, 'MB-2214-GO', 0, '2021-12-14 23:06:14', '2022-01-11 12:43:36'),
(7, 'Apple Updat', 'admin', 1, 11, NULL, NULL, NULL, '6|7|11|13|14|34', '6', NULL, NULL, NULL, NULL, 'Apple,sabe,fruit', 'This article is about the fruit and tree. For the American technology company, see Apple Inc. For other uses, see Apple (disambiguation), Apple blossom (disambiguation), and Apple tree (disambiguation).\r\nApple\r\nPink lady and cross section.jpg\r\n\'Cripps Pink\' apples\r\nMalus domestica a1.jpg\r\nFlowers\r\nScientific classificationedit\r\nKingdom:	Plantae\r\nClade:	Tracheophytes\r\nClade:	Angiosperms\r\nClade:	Eudicots\r\nClade:	Rosids\r\nOrder:	Rosales\r\nFamily:	Rosaceae\r\nGenus:	Malus\r\nSpecies:	M. domestica\r\nBinomial name\r\nMalus domestica\r\nBorkh., 1803\r\nSynonyms[1][2]\r\nMalus communis Desf.\r\nMalus pumila Mil.\r\nM. frutescens Medik.\r\nM. paradisiaca (L.) Medikus\r\nM. sylvestris Mil.\r\nPyrus malus L.\r\nPyrus malus var. paradisiaca L.\r\nPyrus dioica Moench\r\nAn apple is an edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today. Apples have been grown for thousands of years in Asia and Europe and were brought to North America by European colonists. Apples have religious and mythological significance in many cultures, including Norse, Greek, and European Christian tradition.', 'Apples grown from seed tend to be very different from those of the parents, and the resultant fruit frequently lack desired characteristics. Generally then, apple cultivars are propagated by clonal grafting onto rootstocks', NULL, 85.00, 85.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"0.5KG\",\"1KG\",\"1.5KG\",\"2KG\",\"2.5KG\",\"3Kg\",\"3.5KG\",\"4KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'KG', 5.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'apple-updat', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-14 23:06:24', '2021-12-14 23:07:14'),
(8, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:23:51', '2021-12-15 10:50:18'),
(9, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:04', '2021-12-15 10:49:29'),
(10, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:09', '2021-12-15 10:48:30'),
(11, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:13', '2021-12-15 10:47:55'),
(12, 'Apple Updat', 'admin', 1, 11, NULL, NULL, NULL, '6|7|11|13|14|34', '6', NULL, NULL, NULL, NULL, 'Apple,sabe,fruit', 'This article is about the fruit and tree. For the American technology company, see Apple Inc. For other uses, see Apple (disambiguation), Apple blossom (disambiguation), and Apple tree (disambiguation).\r\nApple\r\nPink lady and cross section.jpg\r\n\'Cripps Pink\' apples\r\nMalus domestica a1.jpg\r\nFlowers\r\nScientific classificationedit\r\nKingdom:	Plantae\r\nClade:	Tracheophytes\r\nClade:	Angiosperms\r\nClade:	Eudicots\r\nClade:	Rosids\r\nOrder:	Rosales\r\nFamily:	Rosaceae\r\nGenus:	Malus\r\nSpecies:	M. domestica\r\nBinomial name\r\nMalus domestica\r\nBorkh., 1803\r\nSynonyms[1][2]\r\nMalus communis Desf.\r\nMalus pumila Mil.\r\nM. frutescens Medik.\r\nM. paradisiaca (L.) Medikus\r\nM. sylvestris Mil.\r\nPyrus malus L.\r\nPyrus malus var. paradisiaca L.\r\nPyrus dioica Moench\r\nAn apple is an edible fruit produced by an apple tree (Malus domestica). Apple trees are cultivated worldwide and are the most widely grown species in the genus Malus. The tree originated in Central Asia, where its wild ancestor, Malus sieversii, is still found today. Apples have been grown for thousands of years in Asia and Europe and were brought to North America by European colonists. Apples have religious and mythological significance in many cultures, including Norse, Greek, and European Christian tradition.', 'Apples grown from seed tend to be very different from those of the parents, and the resultant fruit frequently lack desired characteristics. Generally then, apple cultivars are propagated by clonal grafting onto rootstocks', NULL, 85.00, 85.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"0.5KG\",\"1KG\",\"1.5KG\",\"2KG\",\"2.5KG\",\"3Kg\",\"3.5KG\",\"4KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'KG', 5.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'apple-updat', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:18', '2021-12-28 04:40:00'),
(13, 'SEOAPP 2', 'admin', 1, 7, NULL, NULL, NULL, '6|7|11|12|13|14|15|16|29', '16', NULL, NULL, NULL, NULL, '555,j,uiuiuo', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 399.00, 399.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"1\",\"2\",\"5\",\"6\"]}]', NULL, NULL, 0, 1, 0, -1, 'PC', 100.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'seoapp-2', 0, 0.00, NULL, 0, NULL, NULL, 'MB-2214-GO', 0, '2021-12-15 05:25:23', '2021-12-28 04:40:00'),
(14, 'BB Royal Cumin/Jeera/Jeerige - Whole, 200 g Pouch', 'admin', 1, 18, NULL, NULL, NULL, '44|45', '45', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G1', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'bb-royal-cumin/jeera/jeerige--whole,-200-g-pouch', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:28', '2022-01-09 09:23:07'),
(15, 'BB Royal Cumin/Jeera/Jeerige - Whole, 200 g Pouch', 'admin', 1, 18, NULL, NULL, NULL, '44|45', '45', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G4', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'bb-royal-cumin/jeera/jeerige--whole,-200-g-pouch', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:35', '2021-12-18 22:40:33'),
(16, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:39', '2021-12-15 05:42:08'),
(17, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 05:25:44', '2021-12-25 05:42:18'),
(18, 'SEOAPP 2', 'admin', 1, 7, NULL, NULL, NULL, '6|7|11|12|13|14|15|16|29', '16', NULL, NULL, NULL, NULL, '555,j,uiuiuo', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 'Get started with Cloudinary by uploading some of your media. You can add upload functionality to your applications using our APIs and SDKs. Alternatively, you can upload using the Media Library or from the command line using the Cloudinary CLI.', 399.00, 399.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"1\",\"2\",\"5\",\"6\"]}]', NULL, NULL, 0, 1, 0, -4, 'PC', 100.00, 'amount', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'seoapp-2', 0, 0.00, NULL, 0, NULL, NULL, 'MB-2214-GO', 0, '2021-12-15 05:25:49', '2022-01-15 01:30:01'),
(19, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 10:50:57', '2021-12-15 10:50:57'),
(20, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 1, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 10:51:07', '2021-12-25 05:42:18'),
(21, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:04:44', '2021-12-15 11:04:44'),
(22, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:04:50', '2021-12-15 11:04:50'),
(23, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:04:58', '2021-12-15 11:04:58'),
(24, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:05:07', '2021-12-15 11:05:07'),
(25, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:05:12', '2021-12-15 11:05:12'),
(26, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:28', '2021-12-15 11:07:28'),
(27, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:35', '2021-12-15 11:07:35'),
(28, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:41', '2021-12-15 11:07:41'),
(29, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:47', '2021-12-15 11:07:47'),
(30, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:52', '2021-12-15 11:07:52'),
(31, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:07:55', '2021-12-15 11:07:55'),
(32, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:00', '2021-12-15 11:08:00'),
(33, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:05', '2021-12-15 11:08:05'),
(34, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:10', '2021-12-15 11:08:10'),
(35, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:16', '2021-12-15 11:08:16'),
(36, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:23', '2021-12-15 11:08:23'),
(37, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:27', '2021-12-15 11:08:27'),
(38, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:31', '2021-12-15 11:08:31'),
(39, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:35', '2021-12-15 11:08:35'),
(40, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:08:39', '2021-12-15 11:08:39'),
(41, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:09:38', '2021-12-15 11:09:38'),
(42, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:09:45', '2021-12-15 11:09:45'),
(43, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:10:07', '2021-12-15 11:10:07'),
(44, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '52', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 0, '2021-12-15 11:10:11', '2021-12-15 13:53:50');
INSERT INTO `products` (`id`, `name`, `added_by`, `user_id`, `category_id`, `subcategory_id`, `subsubcategory_id`, `brand_id`, `photos`, `thumbnail_img`, `featured_img`, `flash_deal_img`, `video_provider`, `video_link`, `tags`, `description`, `nutritions`, `caution`, `unit_price`, `purchase_price`, `variant_product`, `attributes`, `choice_options`, `colors`, `variations`, `todays_deal`, `published`, `featured`, `current_stock`, `unit`, `discount`, `discount_type`, `tax`, `tax_type`, `shipping_type`, `shipping_cost`, `num_of_sale`, `meta_title`, `meta_description`, `meta_img`, `pdf`, `slug`, `refundable`, `rating`, `barcode`, `digital`, `file_name`, `file_path`, `product_code`, `exclusive_offer`, `created_at`, `updated_at`) VALUES
(45, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:15', '2022-01-01 22:30:51'),
(46, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:19', '2022-01-01 22:30:47'),
(47, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:24', '2022-01-01 22:30:46'),
(48, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:28', '2022-01-01 22:30:44'),
(49, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:33', '2022-01-07 09:53:38'),
(50, 'Machi or fish combinations hai', 'admin', 1, 13, NULL, NULL, NULL, '12|13|15|44|45', '50', NULL, NULL, NULL, NULL, 'BB Roya,Jeera', 'Cumin seeds are an important kitchen staple, finds worldwide usage in various culinary - Indian, Mexican and Eastern and have major health benefits. Good for nursing mothers and pregnant as rich in iron, calcium and promotes lactation. Cumin in raw, powdered or oil form is an amazing spice. Bring home health by purchasing the cumin seeds. Superior quality Cumin seeds are powdered using flavour lock technology to ensure a delightful bouquet and distinctive flavour. It is a widely used spice that adds a mouth-watering taste to the food.', NULL, NULL, 281.00, 281.00, 1, '[\"3\"]', '[{\"attribute_id\":\"3\",\"values\":[\"200G\",\"100G\",\"50G\",\"500G\",\"1KG\"]}]', NULL, NULL, 0, 1, 0, NULL, 'G', 2.00, 'percent', NULL, NULL, 'flat_rate', 0.00, 0, NULL, NULL, NULL, NULL, 'machi-or-fish-combinations-hai', 0, 0.00, NULL, 0, NULL, NULL, '', 1, '2021-12-15 11:10:37', '2022-01-07 09:53:52');

-- --------------------------------------------------------

--
-- Table structure for table `product_stocks`
--

CREATE TABLE `product_stocks` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `variant` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sku` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT 0.00,
  `qty` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_stocks`
--

INSERT INTO `product_stocks` (`id`, `product_id`, `variant`, `sku`, `price`, `qty`, `created_at`, `updated_at`) VALUES
(69, 3, '1KG', 'aashirvaad-1KG', 56.00, 10, '2021-12-14 22:40:07', '2021-12-14 22:40:07'),
(70, 3, '2KG', 'aashirvaad-2KG', 104.00, 10, '2021-12-14 22:40:08', '2021-12-14 22:40:08'),
(71, 3, '5KG', 'aashirvaad-5KG', 265.00, 9, '2021-12-14 22:40:08', '2022-01-15 01:45:45'),
(72, 3, '10KG', 'aashirvaad-10KG', 392.00, 9, '2021-12-14 22:40:08', '2022-01-11 13:11:11'),
(78, 7, '0.5KG', '-0.5KG', 85.00, 10, '2021-12-14 23:07:13', '2021-12-14 23:07:13'),
(79, 7, '1KG', '-1KG', 85.00, 10, '2021-12-14 23:07:13', '2021-12-14 23:07:13'),
(80, 7, '1.5KG', '-1.5KG', 85.00, 10, '2021-12-14 23:07:13', '2021-12-14 23:07:13'),
(81, 7, '2KG', '-2KG', 85.00, 10, '2021-12-14 23:07:13', '2021-12-14 23:07:13'),
(82, 7, '2.5KG', '-2.5KG', 85.00, 10, '2021-12-14 23:07:14', '2021-12-14 23:07:14'),
(83, 7, '3Kg', '-3Kg', 85.00, 10, '2021-12-14 23:07:14', '2021-12-14 23:07:14'),
(84, 7, '3.5KG', '-3.5KG', 85.00, 10, '2021-12-14 23:07:14', '2021-12-14 23:07:14'),
(85, 7, '4KG', '-4KG', 85.00, 10, '2021-12-14 23:07:14', '2021-12-14 23:07:14'),
(90, 6, '1', '-1', 399.00, 10, '2021-12-15 01:59:36', '2021-12-15 01:59:36'),
(91, 6, '2', '-2', 399.00, 10, '2021-12-15 01:59:36', '2021-12-15 01:59:36'),
(92, 6, '5', '-5', 399.00, 10, '2021-12-15 01:59:36', '2021-12-15 01:59:36'),
(93, 6, '6', '-6', 399.00, 10, '2021-12-15 01:59:36', '2021-12-15 01:59:36'),
(94, 1, '1', '-1', 399.00, 10, '2021-12-15 02:02:02', '2021-12-15 02:02:02'),
(95, 1, '2', '-2', 399.00, 10, '2021-12-15 02:02:02', '2021-12-15 02:02:02'),
(96, 1, '5', '-5', 399.00, 10, '2021-12-15 02:02:03', '2021-12-15 02:02:03'),
(97, 1, '6', '-6', 399.00, 10, '2021-12-15 02:02:03', '2021-12-15 02:02:03'),
(108, 17, '200G', '-200G', 281.00, 10, '2021-12-15 05:41:35', '2021-12-15 05:41:35'),
(109, 17, '100G', '-100G', 281.00, 10, '2021-12-15 05:41:35', '2021-12-15 05:41:35'),
(110, 17, '50G', '-50G', 281.00, 10, '2021-12-15 05:41:35', '2021-12-15 05:41:35'),
(111, 17, '500G', '-500G', 281.00, 10, '2021-12-15 05:41:35', '2021-12-15 05:41:35'),
(112, 17, '1KG', '-1KG', 281.00, 10, '2021-12-15 05:41:35', '2021-12-15 05:41:35'),
(113, 16, '200G', '-200G', 281.00, 10, '2021-12-15 05:42:07', '2021-12-15 05:42:07'),
(114, 16, '100G', '-100G', 281.00, 10, '2021-12-15 05:42:07', '2021-12-15 05:42:07'),
(115, 16, '50G', '-50G', 281.00, 10, '2021-12-15 05:42:07', '2021-12-15 05:42:07'),
(116, 16, '500G', '-500G', 281.00, 10, '2021-12-15 05:42:07', '2021-12-15 05:42:07'),
(117, 16, '1KG', '-1KG', 281.00, 10, '2021-12-15 05:42:07', '2021-12-15 05:42:07'),
(118, 11, '200G', '-200G', 281.00, 10, '2021-12-15 10:47:55', '2021-12-15 10:47:55'),
(119, 11, '100G', '-100G', 281.00, 10, '2021-12-15 10:47:55', '2021-12-15 10:47:55'),
(120, 11, '50G', '-50G', 281.00, 10, '2021-12-15 10:47:55', '2021-12-15 10:47:55'),
(121, 11, '500G', '-500G', 281.00, 10, '2021-12-15 10:47:55', '2021-12-15 10:47:55'),
(122, 11, '1KG', '-1KG', 281.00, 10, '2021-12-15 10:47:55', '2021-12-15 10:47:55'),
(123, 10, '200G', '-200G', 281.00, 10, '2021-12-15 10:48:30', '2021-12-15 10:48:30'),
(124, 10, '100G', '-100G', 281.00, 10, '2021-12-15 10:48:30', '2021-12-15 10:48:30'),
(125, 10, '50G', '-50G', 281.00, 10, '2021-12-15 10:48:30', '2021-12-15 10:48:30'),
(126, 10, '500G', '-500G', 281.00, 10, '2021-12-15 10:48:30', '2021-12-15 10:48:30'),
(127, 10, '1KG', '-1KG', 281.00, 10, '2021-12-15 10:48:30', '2021-12-15 10:48:30'),
(128, 9, '200G', '-200G', 281.00, 10, '2021-12-15 10:49:29', '2021-12-15 10:49:29'),
(129, 9, '100G', '-100G', 281.00, 10, '2021-12-15 10:49:29', '2021-12-15 10:49:29'),
(130, 9, '50G', '-50G', 281.00, 10, '2021-12-15 10:49:29', '2021-12-15 10:49:29'),
(131, 9, '500G', '-500G', 281.00, 10, '2021-12-15 10:49:29', '2021-12-15 10:49:29'),
(132, 9, '1KG', '-1KG', 281.00, 10, '2021-12-15 10:49:29', '2021-12-15 10:49:29'),
(133, 8, '200G', '-200G', 281.00, 10, '2021-12-15 10:50:18', '2021-12-15 10:50:18'),
(134, 8, '100G', '-100G', 281.00, 10, '2021-12-15 10:50:18', '2021-12-15 10:50:18'),
(135, 8, '50G', '-50G', 281.00, 10, '2021-12-15 10:50:18', '2021-12-15 10:50:18'),
(136, 8, '500G', '-500G', 281.00, 10, '2021-12-15 10:50:18', '2021-12-15 10:50:18'),
(137, 8, '1KG', '-1KG', 281.00, 10, '2021-12-15 10:50:18', '2021-12-15 10:50:18'),
(138, 44, '200G', '-200G', 281.00, 10, '2021-12-15 13:53:50', '2021-12-15 13:53:50'),
(139, 44, '100G', '-100G', 281.00, 10, '2021-12-15 13:53:50', '2021-12-15 13:53:50'),
(140, 44, '50G', '-50G', 281.00, 10, '2021-12-15 13:53:50', '2021-12-15 13:53:50'),
(141, 44, '500G', '-500G', 281.00, 10, '2021-12-15 13:53:50', '2021-12-15 13:53:50'),
(142, 44, '1KG', '-1KG', 281.00, 10, '2021-12-15 13:53:50', '2021-12-15 13:53:50'),
(143, 2, 'Big-0.5KG', '-Big-0.5KG', 20.00, 10, '2021-12-17 12:55:34', '2021-12-17 12:55:34'),
(144, 2, 'Big-1KG', '-Big-1KG', 40.00, 10, '2021-12-17 12:55:35', '2021-12-17 12:55:35'),
(145, 2, 'Big-1.5KG', '-Big-1.5KG', 60.00, 10, '2021-12-17 12:55:35', '2021-12-17 12:55:35'),
(146, 2, 'Big-2KG', '-Big-2KG', 80.00, 10, '2021-12-17 12:55:35', '2021-12-17 12:55:35'),
(147, 2, 'Big-2.5KG', '-Big-2.5KG', 100.00, 10, '2021-12-17 12:55:36', '2021-12-17 12:55:36'),
(148, 2, 'Big-3KG', '-Big-3KG', 120.00, 10, '2021-12-17 12:55:36', '2021-12-17 12:55:36'),
(149, 2, 'Big-3.5KG', '-Big-3.5KG', 140.00, 10, '2021-12-17 12:55:37', '2021-12-17 12:55:37'),
(150, 2, 'Big-4KG', '-Big-4KG', 160.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(151, 2, 'Big-4.5KG', '-Big-4.5KG', 180.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(152, 2, 'Big-5KG', '-Big-5KG', 200.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(153, 2, 'Small-0.5KG', '-Small-0.5KG', 30.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(154, 2, 'Small-1KG', '-Small-1KG', 60.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(155, 2, 'Small-1.5KG', '-Small-1.5KG', 90.00, 10, '2021-12-17 12:55:38', '2021-12-17 12:55:38'),
(156, 2, 'Small-2KG', '-Small-2KG', 120.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(157, 2, 'Small-2.5KG', '-Small-2.5KG', 150.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(158, 2, 'Small-3KG', '-Small-3KG', 180.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(159, 2, 'Small-3.5KG', '-Small-3.5KG', 210.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(160, 2, 'Small-4KG', '-Small-4KG', 240.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(161, 2, 'Small-4.5KG', '-Small-4.5KG', 270.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(162, 2, 'Small-5KG', '-Small-5KG', 300.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(163, 2, 'Large-0.5KG', '-Large-0.5KG', 40.00, 10, '2021-12-17 12:55:39', '2021-12-17 12:55:39'),
(164, 2, 'Large-1KG', '-Large-1KG', 480.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(165, 2, 'Large-1.5KG', '-Large-1.5KG', 120.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(166, 2, 'Large-2KG', '-Large-2KG', 160.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(167, 2, 'Large-2.5KG', '-Large-2.5KG', 200.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(168, 2, 'Large-3KG', '-Large-3KG', 240.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(169, 2, 'Large-3.5KG', '-Large-3.5KG', 280.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(170, 2, 'Large-4KG', '-Large-4KG', 320.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(171, 2, 'Large-4.5KG', '-Large-4.5KG', 360.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(172, 2, 'Large-5KG', '-Large-5KG', 400.00, 10, '2021-12-17 12:55:40', '2021-12-17 12:55:40'),
(183, 14, '200G', '-200G', 281.00, 10, '2021-12-18 22:39:48', '2021-12-18 22:39:48'),
(184, 14, '100G', '-100G', 281.00, 10, '2021-12-18 22:39:48', '2021-12-18 22:39:48'),
(185, 14, '50G', '-50G', 281.00, 10, '2021-12-18 22:39:48', '2021-12-18 22:39:48'),
(186, 14, '500G', '-500G', 281.00, 10, '2021-12-18 22:39:48', '2021-12-18 22:39:48'),
(187, 14, '1KG', '-1KG', 281.00, 10, '2021-12-18 22:39:48', '2021-12-18 22:39:48'),
(193, 15, '200G', '-200G', 281.00, 10, '2021-12-18 22:40:32', '2021-12-18 22:40:32'),
(194, 15, '100G', '-100G', 281.00, 10, '2021-12-18 22:40:32', '2021-12-18 22:40:32'),
(195, 15, '50G', '-50G', 281.00, 10, '2021-12-18 22:40:33', '2021-12-18 22:40:33'),
(196, 15, '500G', '-500G', 281.00, 10, '2021-12-18 22:40:33', '2021-12-18 22:40:33'),
(197, 15, '1KG', '-1KG', 281.00, 10, '2021-12-18 22:40:33', '2021-12-18 22:40:33'),
(198, 5, '200G', '-200G', 281.00, 10, '2021-12-18 22:40:51', '2021-12-18 22:40:51'),
(199, 5, '100G', '-100G', 281.00, 10, '2021-12-18 22:40:51', '2021-12-18 22:40:51'),
(200, 5, '50G', '-50G', 281.00, 10, '2021-12-18 22:40:51', '2021-12-18 22:40:51'),
(201, 5, '500G', '-500G', 281.00, 10, '2021-12-18 22:40:51', '2021-12-18 22:40:51'),
(202, 5, '1KG', '-1KG', 281.00, 10, '2021-12-18 22:40:51', '2021-12-18 22:40:51');

-- --------------------------------------------------------

--
-- Table structure for table `refund_order`
--

CREATE TABLE `refund_order` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `order_Id` int(11) NOT NULL,
  `details` text NOT NULL,
  `status` int(11) NOT NULL,
  `payment_json` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `refund_order`
--

INSERT INTO `refund_order` (`id`, `user_id`, `order_Id`, `details`, `status`, `payment_json`, `created_at`, `updated_at`) VALUES
(3, 1, 6, '{\"name\":\"cashfree\",\"paymentMode\":\"CREDIT_CARD\",\"orderId\":\"1640430694338\",\"txTime\":\"2021-12-25 16:42:16\",\"referenceId\":\"1226148\",\"type\":\"CashFreeResponse\",\"txMsg\":\"Transaction Successful\",\"signature\":\"0hcaRO5hb5VK0ctT9BknW7bv0Eh+KNDnvW67WrR1QNY\\u003d\",\"orderAmount\":\"562.00\",\"txStatus\":\"SUCCESS\"}', 1, '{\r\n\"bank_reference\": null,\r\n\"cf_payment_id\": 1226148,\r\n\"cf_refund_id\": \"refund_31324\",\r\n\"created_at\": \"2021-12-31T11:00:55+05:30\",\r\n\"entity\": \"refund\",\r\n\"failure_reason\": null,\r\n\"order_id\": \"1640430694338\",\r\n\"processed_on\": null,\r\n\"refund_amount\": 562.00,\r\n\"refund_currency\": \"INR\",\r\n\"refund_id\": \"232OL4ye7Azpa0L7CCTtBE0BTKa\",\r\n\"refund_note\": \"refund note for reference\",\r\n\"refund_splits\": [],\r\n\"refund_status\": \"PENDING\",\r\n\"refund_type\": \"refund\"\r\n}', '2021-12-27 09:39:34', '2021-12-30 23:44:54'),
(4, 1, 7, '{\"name\":\"razorpay\",\"tid\":\"pay_IcrBko04OsD3bX\"}', 1, '{\"id\":\"rfnd_IcxUqiK04dzTLw\",\"entity\":\"refund\",\"amount\":54000,\"currency\":\"INR\",\"payment_id\":\"pay_IcrBko04OsD3bX\",\"notes\":[],\"receipt\":null,\"acquirer_data\":{},\"created_at\":1640708409,\"batch_id\":null,\"status\":\"processed\",\"speed_processed\":\"normal\",\"speed_requested\":\"normal\"}', '2021-12-28 04:40:35', '2021-12-28 10:50:10');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `key_name` varchar(120) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `key_name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'login_by_phone', '1', NULL, NULL),
(2, 'cloudinar', '1', NULL, NULL),
(3, 'local', '1', NULL, NULL),
(4, '300x300_resize', '1', NULL, NULL),
(5, 'default_storage', 'cloudinar', NULL, '2021-12-25 01:44:27'),
(8, 'razorpay', '1', '2021-12-31 00:56:19', '2022-01-02 23:10:48'),
(9, 'rzp_details', '{\"RZP_SECRT\":\"XsdjiyVpzFDGBJA3NARVht9a\",\"RZP_KEY\":\"rzp_test_QT7jJ63I5tQDqM\",\"RZP_AUTH\":\"cnpwX3Rlc3RfUVQ3ako2M0k1dFFEcU06WHNkaml5VnB6RkRHQkpBM05BUlZodDlh\"}', '2021-12-31 00:56:19', '2022-01-15 02:23:29'),
(10, 'cashfree', '1', '2021-12-31 01:02:22', '2022-01-02 23:10:48'),
(11, 'cashfree_details', '{\"APP_ID\":\"94885436a7433ff4ddda53f4658849\",\"SecretKey\":\"abc5c7b9572e18fbec1b0df2c7cad7858f707d20\"}', '2021-12-31 01:02:22', '2022-01-15 02:23:29'),
(12, 'max_execlusive', '10', '2022-01-01 22:52:10', '2022-01-01 22:52:10'),
(13, 'system_default_currency', '28', '2022-01-01 22:52:10', '2022-01-01 22:52:10'),
(14, 'symbol_format', '1', '2022-01-02 23:12:07', '2022-01-07 11:17:04'),
(15, 'no_of_decimals', '2', '2022-01-02 23:12:09', '2022-01-02 23:12:10'),
(16, 'exclusive_offer_type', 'card', '2022-01-07 10:07:31', '2022-01-10 02:10:35'),
(21, 'fast_2_sms_api_key', '79rfYePn263dLQ5JMwpCEIXczjO8NS1BWsu0loFyZKARTmbaximTBKH0oLQfXySAtgJxb5aWGwjhi9n8', '2022-01-10 02:21:10', '2022-01-10 02:21:10'),
(22, 'is_f2s_dlt', '1', '2022-01-10 02:21:10', '2022-01-10 02:21:10'),
(23, 'default_sms', 'fast_2_sms', '2022-01-10 02:22:09', '2022-01-10 02:22:09'),
(24, 'default_email', 'smtp', '2022-01-10 23:13:45', '2022-01-10 23:13:45'),
(25, 'app_logo', 'uploads/media/logo/vd2z6YPutSMijzj1NHlQAQvlbmqOxrvunCCUahcZ.png', '2022-01-10 18:30:00', '2022-01-13 10:41:33'),
(26, 'shipping_method', 'home_delivery', '2022-01-10 18:30:00', '2022-01-10 18:30:00'),
(27, 'support_by_phone', '7079692988', '2022-01-10 18:30:00', '2022-01-10 18:30:00'),
(28, 'support_by_email', 'ranjanashish254@gmail.com', '2022-01-10 18:30:00', '2022-01-10 18:30:00'),
(29, 'footer_credit', 'Grrocery app &nbsp;© 2021 nide to buy, Inc. All\r\n                                                                        Rights Reserved', '2022-01-10 18:30:00', '2022-01-10 18:30:00'),
(30, 'is_send_email_at_time_order', 'yes', '2022-01-11 18:30:00', '2022-01-15 02:23:29'),
(31, 'cod', '1', '2022-01-11 18:30:00', '2022-01-13 04:32:58'),
(32, 'privacy_policy', '<p>&nbsp;</p>\r\n<p><strong>Privacy Policy</strong></p>\r\n<p>Ashish Kumar built the Grocery app as a Free app. This SERVICE is provided by Ashish Kumar at no cost and is intended for use as is.</p>\r\n<p>This page is used to inform visitors regarding my policies with the collection, use, and disclosure of Personal Information if anyone decided to use my Service.</p>\r\n<p>If you choose to use my Service, then you agree to the collection and use of information in relation to this policy. The Personal Information that I collect is used for providing and improving the Service. I will not use or share your information with anyone except as described in this Privacy Policy.</p>\r\n<p>The terms used in this Privacy Policy have the same meanings as in our Terms and Conditions, which are accessible at Grocery unless otherwise defined in this Privacy Policy.</p>\r\n<p><strong>Information Collection and Use</strong></p>\r\n<p>For a better experience, while using our Service, I may require you to provide us with certain personally identifiable information, including but not limited to the About grocery app. The information that I request will be retained on your device and is not collected by me in any way.</p>\r\n<div>\r\n<p>The app does use third-party services that may collect information used to identify you.</p>\r\n<p>Link to the privacy policy of third-party service providers used by the app</p>\r\n<ul>\r\n<li><a href=\"https://www.google.com/policies/privacy/\" target=\"_blank\" rel=\"noopener noreferrer\">Google Play Services</a></li>\r\n<li><a href=\"https://firebase.google.com/policies/analytics\" target=\"_blank\" rel=\"noopener noreferrer\">Google Analytics for Firebase</a></li>\r\n</ul>\r\n</div>\r\n<p><strong>Log Data</strong></p>\r\n<p>I want to inform you that whenever you use my Service, in a case of an error in the app I collect data and information (through third-party products) on your phone called Log Data. This Log Data may include information such as your device Internet Protocol (&ldquo;IP&rdquo;) address, device name, operating system version, the configuration of the app when utilizing my Service, the time and date of your use of the Service, and other statistics.</p>\r\n<p><strong>Cookies</strong></p>\r\n<p>Cookies are files with a small amount of data that are commonly used as anonymous unique identifiers. These are sent to your browser from the websites that you visit and are stored on your device\'s internal memory.</p>\r\n<p>This Service does not use these &ldquo;cookies&rdquo; explicitly. However, the app may use third-party code and libraries that use &ldquo;cookies&rdquo; to collect information and improve their services. You have the option to either accept or refuse these cookies and know when a cookie is being sent to your device. If you choose to refuse our cookies, you may not be able to use some portions of this Service.</p>\r\n<p><strong>Service Providers</strong></p>\r\n<p>I may employ third-party companies and individuals due to the following reasons:</p>\r\n<ul>\r\n<li>To facilitate our Service;</li>\r\n<li>To provide the Service on our behalf;</li>\r\n<li>To perform Service-related services; or</li>\r\n<li>To assist us in analyzing how our Service is used.</li>\r\n</ul>\r\n<p>I want to inform users of this Service that these third parties have access to their Personal Information. The reason is to perform the tasks assigned to them on our behalf. However, they are obligated not to disclose or use the information for any other purpose.</p>\r\n<p><strong>Security</strong></p>\r\n<p>I value your trust in providing us your Personal Information, thus we are striving to use commercially acceptable means of protecting it. But remember that no method of transmission over the internet, or method of electronic storage is 100% secure and reliable, and I cannot guarantee its absolute security.</p>\r\n<p><strong>Links to Other Sites</strong></p>\r\n<p>This Service may contain links to other sites. If you click on a third-party link, you will be directed to that site. Note that these external sites are not operated by me. Therefore, I strongly advise you to review the Privacy Policy of these websites. I have no control over and assume no responsibility for the content, privacy policies, or practices of any third-party sites or services.</p>\r\n<p><strong>Children&rsquo;s Privacy</strong></p>\r\n<div>\r\n<p>These Services do not address anyone under the age of 13. I do not knowingly collect personally identifiable information from children under 13 years of age. In the case I discover that a child under 13 has provided me with personal information, I immediately delete this from our servers. If you are a parent or guardian and you are aware that your child has provided us with personal information, please contact me so that I will be able to do the necessary actions.</p>\r\n</div>\r\n<p><strong>Changes to This Privacy Policy</strong></p>\r\n<p>I may update our Privacy Policy from time to time. Thus, you are advised to review this page periodically for any changes. I will notify you of any changes by posting the new Privacy Policy on this page.</p>\r\n<p>This policy is effective as of 2022-01-13</p>\r\n<p><strong>Contact Us</strong></p>\r\n<p>If you have any questions or suggestions about my Privacy Policy, do not hesitate to contact me at ranjanashish254@gmail.com.</p>\r\n<p>This privacy policy page was created at <a href=\"https://privacypolicytemplate.net\" target=\"_blank\" rel=\"noopener noreferrer\">privacypolicytemplate.net </a>and modified/generated by <a href=\"https://app-privacy-policy-generator.nisrulz.com/\" target=\"_blank\" rel=\"noopener noreferrer\">App Privacy Policy Generator</a></p>', '2022-01-12 18:30:00', '2022-01-13 00:47:33'),
(33, 'terms_and_conditions', '<p>&nbsp;</p>\r\n<p><strong>Terms &amp; Conditions</strong></p>\r\n<p>By downloading or using the app, these terms will automatically apply to you &ndash; you should make sure therefore that you read them carefully before using the app. You&rsquo;re not allowed to copy or modify the app, any part of the app, or our trademarks in any way. You&rsquo;re not allowed to attempt to extract the source code of the app, and you also shouldn&rsquo;t try to translate the app into other languages or make derivative versions. The app itself, and all the trademarks, copyright, database rights, and other intellectual property rights related to it, still belong to Ashish Kumar.</p>\r\n<p>Ashish Kumar is committed to ensuring that the app is as useful and efficient as possible. For that reason, we reserve the right to make changes to the app or to charge for its services, at any time and for any reason. We will never charge you for the app or its services without making it very clear to you exactly what you&rsquo;re paying for.</p>\r\n<p>The Grocery app stores and processes personal data that you have provided to us, to provide my Service. It&rsquo;s your responsibility to keep your phone and access to the app secure. We, therefore, recommend that you do not jailbreak or root your phone, which is the process of removing software restrictions and limitations imposed by the official operating system of your device. It could make your phone vulnerable to malware/viruses/malicious programs, compromise your phone&rsquo;s security features and it could mean that the Grocery app won&rsquo;t work properly or at all.</p>\r\n<div>\r\n<p>The app does use third-party services that declare its Terms and Conditions.</p>\r\n<p>Link to Terms and Conditions of third-party service providers used by the app</p>\r\n<ul>\r\n<li><a href=\"https://policies.google.com/terms\" target=\"_blank\" rel=\"noopener noreferrer\">Google Play Services</a></li>\r\n<li><a href=\"https://firebase.google.com/terms/analytics\" target=\"_blank\" rel=\"noopener noreferrer\">Google Analytics for Firebase</a></li>\r\n</ul>\r\n</div>\r\n<p>You should be aware that there are certain things that Ashish Kumar will not take responsibility for. Certain functions of the app will require the app to have an active internet connection. The connection can be Wi-Fi or provided by your mobile network provider, but Ashish Kumar cannot take responsibility for the app not working at full functionality if you don&rsquo;t have access to Wi-Fi, and you don&rsquo;t have any of your data allowance left.</p>\r\n<p>&nbsp;</p>\r\n<p>If you&rsquo;re using the app outside of an area with Wi-Fi, you should remember that the terms of the agreement with your mobile network provider will still apply. As a result, you may be charged by your mobile provider for the cost of data for the duration of the connection while accessing the app, or other third-party charges. In using the app, you&rsquo;re accepting responsibility for any such charges, including roaming data charges if you use the app outside of your home territory (i.e. region or country) without turning off data roaming. If you are not the bill payer for the device on which you&rsquo;re using the app, please be aware that we assume that you have received permission from the bill payer for using the app.</p>\r\n<p>Along the same lines, Ashish Kumar cannot always take responsibility for the way you use the app i.e. You need to make sure that your device stays charged &ndash; if it runs out of battery and you can&rsquo;t turn it on to avail the Service, Ashish Kumar cannot accept responsibility.</p>\r\n<p>With respect to Ashish Kumar responsibility for your use of the app, when you&rsquo;re using the app, it&rsquo;s important to bear in mind that although we endeavor to ensure that it is updated and correct at all times, we do rely on third parties to provide information to us so that we can make it available to you. Ashish Kumar accepts no liability for any loss, direct or indirect, you experience as a result of relying wholly on this functionality of the app.</p>\r\n<p>At some point, we may wish to update the app. The app is currently available on Android &ndash; the requirements for the system(and for any additional systems we decide to extend the availability of the app to) may change, and you&rsquo;ll need to download the updates if you want to keep using the app. Ashish Kumar does not promise that it will always update the app so that it is relevant to you and/or works with the Android version that you have installed on your device. However, you promise to always accept updates to the application when offered to you, We may also wish to stop providing the app, and may terminate use of it at any time without giving notice of termination to you. Unless we tell you otherwise, upon any termination, (a) the rights and licenses granted to you in these terms will end; (b) you must stop using the app, and (if needed) delete it from your device.</p>\r\n<p><strong>Changes to This Terms and Conditions</strong></p>\r\n<p>I may update our Terms and Conditions from time to time. Thus, you are advised to review this page periodically for any changes. I will notify you of any changes by posting the new Terms and Conditions on this page.</p>\r\n<p>These terms and conditions are effective as of 2022-01-13</p>\r\n<p><strong>Contact Us</strong></p>\r\n<p>If you have any questions or suggestions about my Terms and Conditions, do not hesitate to contact me at ranjanashish254@gmail.com.</p>\r\n<p>This Terms and Conditions page was generated by <a href=\"https://app-privacy-policy-generator.nisrulz.com/\" target=\"_blank\" rel=\"noopener noreferrer\">App Privacy Policy Generator</a></p>', '2022-01-13 00:57:34', '2022-01-13 00:57:34'),
(34, 'return_policy', '<h1>Return and Refund Policy</h1>\r\n<p>Last updated: January 13, 2022</p>\r\n<p>Thank you for shopping at Grocery.</p>\r\n<p>If, for any reason, You are not completely satisfied with a purchase We invite You to review our policy on refunds and returns. This Return and Refund Policy has been created with the help of the <a href=\"https://www.freeprivacypolicy.com/free-return-refund-policy-generator/\" target=\"_blank\" rel=\"noopener\">Return and Refund Policy Generator</a>.</p>\r\n<p>The following terms are applicable for any products that You purchased with Us.</p>\r\n<h1>Interpretation and Definitions</h1>\r\n<h2>Interpretation</h2>\r\n<p>The words of which the initial letter is capitalized have meanings defined under the following conditions. The following definitions shall have the same meaning regardless of whether they appear in singular or in plural.</p>\r\n<h2>Definitions</h2>\r\n<p>For the purposes of this Return and Refund Policy:</p>\r\n<ul>\r\n<li>\r\n<p><strong>Application</strong> means the software program provided by the Company downloaded by You on any electronic device, named Grocery</p>\r\n</li>\r\n<li>\r\n<p><strong>Company</strong> (referred to as either \"the Company\", \"We\", \"Us\" or \"Our\" in this Agreement) refers to Grocery.</p>\r\n</li>\r\n<li>\r\n<p><strong>Goods</strong> refer to the items offered for sale on the Service.</p>\r\n</li>\r\n<li>\r\n<p><strong>Orders</strong> mean a request by You to purchase Goods from Us.</p>\r\n</li>\r\n<li>\r\n<p><strong>Service</strong> refers to the Application.</p>\r\n</li>\r\n<li>\r\n<p><strong>You</strong> means the individual accessing or using the Service, or the company, or other legal entity on behalf of which such individual is accessing or using the Service, as applicable.</p>\r\n</li>\r\n</ul>\r\n<h1>Your Order Cancellation Rights</h1>\r\n<p>You are entitled to cancel Your Order within 7 days without giving any reason for doing so.</p>\r\n<p>The deadline for cancelling an Order is 7 days from the date on which You received the Goods or on which a third party you have appointed, who is not the carrier, takes possession of the product delivered.</p>\r\n<p>In order to exercise Your right of cancellation, You must inform Us of your decision by means of a clear statement. You can inform us of your decision by:</p>\r\n<ul>\r\n<li>\r\n<p>By email: ranjanashish254@gmail.com</p>\r\n</li>\r\n<li>\r\n<p>By phone number: 7079692988</p>\r\n</li>\r\n</ul>\r\n<p>We will reimburse You no later than 14 days from the day on which We receive the returned Goods. We will use the same means of payment as You used for the Order, and You will not incur any fees for such reimbursement.</p>\r\n<h1>Conditions for Returns</h1>\r\n<p>In order for the Goods to be eligible for a return, please make sure that:</p>\r\n<ul>\r\n<li>The Goods were purchased in the last 7 days</li>\r\n<li>The Goods are in the original packaging</li>\r\n</ul>\r\n<p>The following Goods cannot be returned:</p>\r\n<ul>\r\n<li>The supply of Goods made to Your specifications or clearly personalized.</li>\r\n<li>The supply of Goods which according to their nature are not suitable to be returned, deteriorate rapidly or where the date of expiry is over.</li>\r\n<li>The supply of Goods which are not suitable for return due to health protection or hygiene reasons and were unsealed after delivery.</li>\r\n<li>The supply of Goods which are, after delivery, according to their nature, inseparably mixed with other items.</li>\r\n</ul>\r\n<p>We reserve the right to refuse returns of any merchandise that does not meet the above return conditions in our sole discretion.</p>\r\n<p>Only regular priced Goods may be refunded. Unfortunately, Goods on sale cannot be refunded. This exclusion may not apply to You if it is not permitted by applicable law.</p>\r\n<h1>Returning Goods</h1>\r\n<p>You are responsible for the cost and risk of returning the Goods to Us. You should send the Goods at the following address:</p>\r\n<p>any data fill</p>\r\n<p>We cannot be held responsible for Goods damaged or lost in return shipment. Therefore, We recommend an insured and trackable mail service. We are unable to issue a refund without actual receipt of the Goods or proof of received return delivery.</p>\r\n<h1>Gifts</h1>\r\n<p>If the Goods were marked as a gift when purchased and then shipped directly to you, You\'ll receive a gift credit for the value of your return. Once the returned product is received, a gift certificate will be mailed to You.</p>\r\n<p>If the Goods weren\'t marked as a gift when purchased, or the gift giver had the Order shipped to themselves to give it to You later, We will send the refund to the gift giver.</p>\r\n<h2>Contact Us</h2>\r\n<p>If you have any questions about our Returns and Refunds Policy, please contact us:</p>\r\n<ul>\r\n<li>\r\n<p>By email: ranjanashish254@gmail.com</p>\r\n</li>\r\n<li>\r\n<p>By phone number: 7079692988</p>\r\n</li>\r\n</ul>', '2022-01-13 01:08:46', '2022-01-13 01:08:46'),
(35, 'contact_us', '<p>contact us</p>', '2022-01-13 01:13:44', '2022-01-13 01:13:44'),
(36, 'about_us', '<h1 style=\"text-align: center;\"><strong>About Us</strong></h1>\r\n<p>Welcome to Grocery, your number one source for all things [product]. We\'re dedicated to giving you the very best of grocery base, with a focus on [store characteristic 1], [store characteristic 2], [store characteristic 3].</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Founded in [year] by [founder name], Grocery has come a long way from its beginnings in [starting location]. When [founder name] first started out, [his/her/their] passion for [brand message - e.g. \"eco-friendly cleaning products\"] drove them to [action: quit day job, do tons of research, etc.] so that Grocery can offer you [competitive differentiator - e.g. \"the world\'s most advanced toothbrush\"]. We now serve customers all over [place - town, country, the world], and are thrilled that we\'re able to turn our passion into [my/our] own website.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>[I/we] hope you enjoy [my/our] products as much as [I/we] enjoy offering them to you. If you have any questions or comments, please don\'t hesitate to contact [me/us].</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>\r\n<p>Sincerely,</p>\r\n<p>&nbsp;</p>\r\n<p>Ashish Kumar</p>', '2022-01-13 01:18:14', '2022-01-15 00:18:48'),
(37, 'favicon', 'uploads/media/logo/JIHwNboAElLDX2dgcWyv6DQRPE9UcktAmpnbjIJV.png', '2022-01-13 09:41:43', '2022-01-13 10:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `sope`
--

CREATE TABLE `sope` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sope_name` varchar(100) NOT NULL,
  `location` text NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `photo` varchar(250) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `upload_to` varchar(50) NOT NULL COMMENT 'local|cloudinary|crop|firebase|etc',
  `location_type` varchar(250) DEFAULT NULL,
  `location_type_id` int(11) DEFAULT NULL,
  `single_file` text DEFAULT NULL,
  `single_file_full_url` text NOT NULL,
  `many_files` text DEFAULT NULL,
  `in_use` int(11) NOT NULL DEFAULT 0,
  `alt` varchar(250) NOT NULL,
  `json_data` text NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `uploads`
--

INSERT INTO `uploads` (`id`, `user_id`, `upload_to`, `location_type`, `location_type_id`, `single_file`, `single_file_full_url`, `many_files`, `in_use`, `alt`, `json_data`, `status`, `created_at`, `updated_at`) VALUES
(6, 1, 'cloudinar', 'create_category', 6, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639306276/products/category/image/cstuhzw1vx0pdsudmqte.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639306276\\/products\\/category\\/image\\/cstuhzw1vx0pdsudmqte.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639306276\\/products\\/category\\/image\\/cstuhzw1vx0pdsudmqte.png\",\"getSize\":192449,\"getReadableSize\":\"187.94 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/cstuhzw1vx0pdsudmqte\",\"getOriginalFileName\":\"php285B\",\"getPublicId\":\"products\\/category\\/image\\/cstuhzw1vx0pdsudmqte\",\"id\":\"products\\/category\\/image\\/cstuhzw1vx0pdsudmqte\",\"getExtension\":\"png\",\"getWidth\":495,\"getHeight\":300,\"getTimeUploaded\":\"2021-12-12T10:51:16Z\"}', 1, '2021-12-12 05:21:17', '2021-12-12 05:21:17'),
(7, 1, 'local', 'create_category', 7, 'uploads/products/category/image/Bh9ga4FiQsNztrcMzE4nAEgDXIiZHmEvCct8xAVw.png', 'http://192.168.2.107:8000/uploads/products/category/image/Bh9ga4FiQsNztrcMzE4nAEgDXIiZHmEvCct8xAVw.png', NULL, 1, '', '{\"stored_path\":\"uploads\\/products\\/category\\/image\\/Bh9ga4FiQsNztrcMzE4nAEgDXIiZHmEvCct8xAVw.png\"}', 1, '2021-12-12 05:29:19', '2021-12-12 05:29:19'),
(11, 1, 'cloudinar', 'create_category', 11, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639323983/products/category/image/nixemnytfkgnxbta9uxk.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639323983\\/products\\/category\\/image\\/nixemnytfkgnxbta9uxk.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639323983\\/products\\/category\\/image\\/nixemnytfkgnxbta9uxk.png\",\"getSize\":58037,\"getReadableSize\":\"56.68 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/nixemnytfkgnxbta9uxk\",\"getOriginalFileName\":\"php58A7\",\"getPublicId\":\"products\\/category\\/image\\/nixemnytfkgnxbta9uxk\",\"id\":\"products\\/category\\/image\\/nixemnytfkgnxbta9uxk\",\"getExtension\":\"png\",\"getWidth\":223,\"getHeight\":151,\"getTimeUploaded\":\"2021-12-12T15:46:23Z\"}', 1, '2021-12-12 10:16:24', '2021-12-12 10:16:24'),
(12, 1, 'cloudinar', 'create_category', 12, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639324060/products/category/image/ztsdqhiblch4yoquzxdo.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324060\\/products\\/category\\/image\\/ztsdqhiblch4yoquzxdo.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324060\\/products\\/category\\/image\\/ztsdqhiblch4yoquzxdo.png\",\"getSize\":93458,\"getReadableSize\":\"91.27 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/ztsdqhiblch4yoquzxdo\",\"getOriginalFileName\":\"php85CE\",\"getPublicId\":\"products\\/category\\/image\\/ztsdqhiblch4yoquzxdo\",\"id\":\"products\\/category\\/image\\/ztsdqhiblch4yoquzxdo\",\"getExtension\":\"png\",\"getWidth\":281,\"getHeight\":281,\"getTimeUploaded\":\"2021-12-12T15:47:40Z\"}', 1, '2021-12-12 10:17:41', '2021-12-12 10:17:41'),
(13, 1, 'cloudinar', 'create_category', 13, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639324114/products/category/image/gie7ym4e8mzjv9323jdo.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324114\\/products\\/category\\/image\\/gie7ym4e8mzjv9323jdo.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324114\\/products\\/category\\/image\\/gie7ym4e8mzjv9323jdo.png\",\"getSize\":118895,\"getReadableSize\":\"116.11 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/gie7ym4e8mzjv9323jdo\",\"getOriginalFileName\":\"php596B\",\"getPublicId\":\"products\\/category\\/image\\/gie7ym4e8mzjv9323jdo\",\"id\":\"products\\/category\\/image\\/gie7ym4e8mzjv9323jdo\",\"getExtension\":\"png\",\"getWidth\":308,\"getHeight\":219,\"getTimeUploaded\":\"2021-12-12T15:48:34Z\"}', 1, '2021-12-12 10:18:36', '2021-12-12 10:18:36'),
(14, 1, 'cloudinar', 'create_category', 14, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639324172/products/category/image/jdoqlicwlxrbamey2cvw.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324172\\/products\\/category\\/image\\/jdoqlicwlxrbamey2cvw.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324172\\/products\\/category\\/image\\/jdoqlicwlxrbamey2cvw.png\",\"getSize\":103764,\"getReadableSize\":\"101.33 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/jdoqlicwlxrbamey2cvw\",\"getOriginalFileName\":\"php3BBD\",\"getPublicId\":\"products\\/category\\/image\\/jdoqlicwlxrbamey2cvw\",\"id\":\"products\\/category\\/image\\/jdoqlicwlxrbamey2cvw\",\"getExtension\":\"png\",\"getWidth\":288,\"getHeight\":213,\"getTimeUploaded\":\"2021-12-12T15:49:32Z\"}', 1, '2021-12-12 10:19:33', '2021-12-12 10:19:34'),
(15, 1, 'cloudinar', 'create_category', 15, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639324251/products/category/image/ovdvzwbaaauy4k3irsbj.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324251\\/products\\/category\\/image\\/ovdvzwbaaauy4k3irsbj.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324251\\/products\\/category\\/image\\/ovdvzwbaaauy4k3irsbj.png\",\"getSize\":58686,\"getReadableSize\":\"57.31 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/ovdvzwbaaauy4k3irsbj\",\"getOriginalFileName\":\"php7306\",\"getPublicId\":\"products\\/category\\/image\\/ovdvzwbaaauy4k3irsbj\",\"id\":\"products\\/category\\/image\\/ovdvzwbaaauy4k3irsbj\",\"getExtension\":\"png\",\"getWidth\":308,\"getHeight\":205,\"getTimeUploaded\":\"2021-12-12T15:50:51Z\"}', 1, '2021-12-12 10:20:53', '2021-12-12 10:20:53'),
(16, 1, 'cloudinar', 'create_category', 16, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639324292/products/category/image/rgkzknonkqbh7ierxta2.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324292\\/products\\/category\\/image\\/rgkzknonkqbh7ierxta2.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639324292\\/products\\/category\\/image\\/rgkzknonkqbh7ierxta2.png\",\"getSize\":118955,\"getReadableSize\":\"116.17 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/rgkzknonkqbh7ierxta2\",\"getOriginalFileName\":\"php1041\",\"getPublicId\":\"products\\/category\\/image\\/rgkzknonkqbh7ierxta2\",\"id\":\"products\\/category\\/image\\/rgkzknonkqbh7ierxta2\",\"getExtension\":\"png\",\"getWidth\":310,\"getHeight\":229,\"getTimeUploaded\":\"2021-12-12T15:51:32Z\"}', 1, '2021-12-12 10:21:33', '2021-12-12 10:21:34'),
(29, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372656/media/image/fmutunb0c6dngun1taap.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372656\\/media\\/image\\/fmutunb0c6dngun1taap.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372656\\/media\\/image\\/fmutunb0c6dngun1taap.png\",\"getSize\":118955,\"getReadableSize\":\"116.17 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/fmutunb0c6dngun1taap\",\"getOriginalFileName\":\"phpAB5\",\"getPublicId\":\"media\\/image\\/fmutunb0c6dngun1taap\",\"id\":\"media\\/image\\/fmutunb0c6dngun1taap\",\"getExtension\":\"png\",\"getWidth\":310,\"getHeight\":229,\"getTimeUploaded\":\"2021-12-13T05:17:36Z\"}', 1, '2021-12-12 23:47:38', '2021-12-12 23:47:38'),
(30, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372660/media/image/r0aoosklxirb4kxbampe.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372660\\/media\\/image\\/r0aoosklxirb4kxbampe.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372660\\/media\\/image\\/r0aoosklxirb4kxbampe.png\",\"getSize\":58686,\"getReadableSize\":\"57.31 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/r0aoosklxirb4kxbampe\",\"getOriginalFileName\":\"php19B9\",\"getPublicId\":\"media\\/image\\/r0aoosklxirb4kxbampe\",\"id\":\"media\\/image\\/r0aoosklxirb4kxbampe\",\"getExtension\":\"png\",\"getWidth\":308,\"getHeight\":205,\"getTimeUploaded\":\"2021-12-13T05:17:40Z\"}', 1, '2021-12-12 23:47:41', '2021-12-12 23:47:41'),
(31, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372663/media/image/go3kn93h49jqra9tbrw3.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372663\\/media\\/image\\/go3kn93h49jqra9tbrw3.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372663\\/media\\/image\\/go3kn93h49jqra9tbrw3.png\",\"getSize\":103764,\"getReadableSize\":\"101.33 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/go3kn93h49jqra9tbrw3\",\"getOriginalFileName\":\"php265D\",\"getPublicId\":\"media\\/image\\/go3kn93h49jqra9tbrw3\",\"id\":\"media\\/image\\/go3kn93h49jqra9tbrw3\",\"getExtension\":\"png\",\"getWidth\":288,\"getHeight\":213,\"getTimeUploaded\":\"2021-12-13T05:17:43Z\"}', 1, '2021-12-12 23:47:44', '2021-12-12 23:47:44'),
(32, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372667/media/image/o9tm6ovulmy4vrbwcxtr.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372667\\/media\\/image\\/o9tm6ovulmy4vrbwcxtr.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372667\\/media\\/image\\/o9tm6ovulmy4vrbwcxtr.png\",\"getSize\":118895,\"getReadableSize\":\"116.11 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/o9tm6ovulmy4vrbwcxtr\",\"getOriginalFileName\":\"php3429\",\"getPublicId\":\"media\\/image\\/o9tm6ovulmy4vrbwcxtr\",\"id\":\"media\\/image\\/o9tm6ovulmy4vrbwcxtr\",\"getExtension\":\"png\",\"getWidth\":308,\"getHeight\":219,\"getTimeUploaded\":\"2021-12-13T05:17:47Z\"}', 1, '2021-12-12 23:47:48', '2021-12-12 23:47:48'),
(33, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372670/media/image/jq9uxpb14ptuydoio675.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372670\\/media\\/image\\/jq9uxpb14ptuydoio675.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372670\\/media\\/image\\/jq9uxpb14ptuydoio675.png\",\"getSize\":93458,\"getReadableSize\":\"91.27 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/jq9uxpb14ptuydoio675\",\"getOriginalFileName\":\"php4282\",\"getPublicId\":\"media\\/image\\/jq9uxpb14ptuydoio675\",\"id\":\"media\\/image\\/jq9uxpb14ptuydoio675\",\"getExtension\":\"png\",\"getWidth\":281,\"getHeight\":281,\"getTimeUploaded\":\"2021-12-13T05:17:50Z\"}', 1, '2021-12-12 23:47:51', '2021-12-12 23:47:51'),
(34, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639372673/media/image/m17hkclt3ear3rlldi19.png', NULL, 1, '', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372673\\/media\\/image\\/m17hkclt3ear3rlldi19.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639372673\\/media\\/image\\/m17hkclt3ear3rlldi19.png\",\"getSize\":58037,\"getReadableSize\":\"56.68 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/m17hkclt3ear3rlldi19\",\"getOriginalFileName\":\"php4EE7\",\"getPublicId\":\"media\\/image\\/m17hkclt3ear3rlldi19\",\"id\":\"media\\/image\\/m17hkclt3ear3rlldi19\",\"getExtension\":\"png\",\"getWidth\":223,\"getHeight\":151,\"getTimeUploaded\":\"2021-12-13T05:17:53Z\"}', 1, '2021-12-12 23:47:55', '2021-12-12 23:47:55'),
(40, 1, 'cloudinar', 'create_category', 18, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541148/products/category/image/phlithakuijtqp7jneee.png', NULL, 0, 'Foodgrains-Oil-Masala-1.png', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541148\\/products\\/category\\/image\\/phlithakuijtqp7jneee.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541148\\/products\\/category\\/image\\/phlithakuijtqp7jneee.png\",\"getSize\":454655,\"getReadableSize\":\"444.00 KB\",\"getFileType\":\"image\",\"getFileName\":\"products\\/category\\/image\\/phlithakuijtqp7jneee\",\"getOriginalFileName\":\"phpE6E8\",\"getPublicId\":\"products\\/category\\/image\\/phlithakuijtqp7jneee\",\"id\":\"products\\/category\\/image\\/phlithakuijtqp7jneee\",\"getExtension\":\"png\",\"getWidth\":600,\"getHeight\":400,\"getTimeUploaded\":\"2021-12-15T04:05:48Z\"}', 1, '2021-12-14 22:35:49', '2021-12-14 22:35:49'),
(41, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541232/media/image/bhvjtvohiroemo3radgi.jpg', NULL, 0, '126903-2_2-aashirvaad-atta-whole-wheat.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541232\\/media\\/image\\/bhvjtvohiroemo3radgi.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541232\\/media\\/image\\/bhvjtvohiroemo3radgi.jpg\",\"getSize\":44961,\"getReadableSize\":\"43.91 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/bhvjtvohiroemo3radgi\",\"getOriginalFileName\":\"php4DFB\",\"getPublicId\":\"media\\/image\\/bhvjtvohiroemo3radgi\",\"id\":\"media\\/image\\/bhvjtvohiroemo3radgi\",\"getExtension\":\"jpg\",\"getWidth\":500,\"getHeight\":500,\"getTimeUploaded\":\"2021-12-15T04:07:12Z\"}', 1, '2021-12-14 22:37:13', '2021-12-14 22:37:13'),
(42, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541236/media/image/lxaff90dmgj4b6ftazgv.jpg', NULL, 0, '126903-4_2-aashirvaad-atta-whole-wheat.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541236\\/media\\/image\\/lxaff90dmgj4b6ftazgv.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541236\\/media\\/image\\/lxaff90dmgj4b6ftazgv.jpg\",\"getSize\":63804,\"getReadableSize\":\"62.31 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/lxaff90dmgj4b6ftazgv\",\"getOriginalFileName\":\"php5BC7\",\"getPublicId\":\"media\\/image\\/lxaff90dmgj4b6ftazgv\",\"id\":\"media\\/image\\/lxaff90dmgj4b6ftazgv\",\"getExtension\":\"jpg\",\"getWidth\":500,\"getHeight\":500,\"getTimeUploaded\":\"2021-12-15T04:07:16Z\"}', 1, '2021-12-14 22:37:17', '2021-12-14 22:37:17'),
(43, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541239/media/image/whrvbslnczkyhp8pr98v.jpg', NULL, 0, '126903_8-aashirvaad-atta-whole-wheat.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541239\\/media\\/image\\/whrvbslnczkyhp8pr98v.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541239\\/media\\/image\\/whrvbslnczkyhp8pr98v.jpg\",\"getSize\":39497,\"getReadableSize\":\"38.57 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/whrvbslnczkyhp8pr98v\",\"getOriginalFileName\":\"php6974\",\"getPublicId\":\"media\\/image\\/whrvbslnczkyhp8pr98v\",\"id\":\"media\\/image\\/whrvbslnczkyhp8pr98v\",\"getExtension\":\"jpg\",\"getWidth\":500,\"getHeight\":500,\"getTimeUploaded\":\"2021-12-15T04:07:19Z\"}', 1, '2021-12-14 22:37:20', '2021-12-14 22:37:20'),
(44, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541819/media/image/k8bytkq2t5wfzlkahyvn.jpg', NULL, 0, '10000486-7_1-bb-royal-cuminjeera-whole.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541819\\/media\\/image\\/k8bytkq2t5wfzlkahyvn.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541819\\/media\\/image\\/k8bytkq2t5wfzlkahyvn.jpg\",\"getSize\":81383,\"getReadableSize\":\"79.48 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/k8bytkq2t5wfzlkahyvn\",\"getOriginalFileName\":\"php418F\",\"getPublicId\":\"media\\/image\\/k8bytkq2t5wfzlkahyvn\",\"id\":\"media\\/image\\/k8bytkq2t5wfzlkahyvn\",\"getExtension\":\"jpg\",\"getWidth\":900,\"getHeight\":900,\"getTimeUploaded\":\"2021-12-15T04:16:59Z\"}', 1, '2021-12-14 22:47:00', '2021-12-14 22:47:00'),
(45, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639541823/media/image/anlilf00vqxbpurfrlqb.jpg', NULL, 0, '10000486_14-bb-royal-cuminjeera-whole.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541823\\/media\\/image\\/anlilf00vqxbpurfrlqb.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639541823\\/media\\/image\\/anlilf00vqxbpurfrlqb.jpg\",\"getSize\":43304,\"getReadableSize\":\"42.29 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/anlilf00vqxbpurfrlqb\",\"getOriginalFileName\":\"php4EAF\",\"getPublicId\":\"media\\/image\\/anlilf00vqxbpurfrlqb\",\"id\":\"media\\/image\\/anlilf00vqxbpurfrlqb\",\"getExtension\":\"jpg\",\"getWidth\":500,\"getHeight\":500,\"getTimeUploaded\":\"2021-12-15T04:17:03Z\"}', 1, '2021-12-14 22:47:04', '2021-12-14 22:47:04'),
(50, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639566681/media/image/g6ccppunp5vjrlscvio5.png', NULL, 0, 'pngfuel.png', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566681\\/media\\/image\\/g6ccppunp5vjrlscvio5.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566681\\/media\\/image\\/g6ccppunp5vjrlscvio5.png\",\"getSize\":58686,\"getReadableSize\":\"57.31 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/g6ccppunp5vjrlscvio5\",\"getOriginalFileName\":\"php9FEF\",\"getPublicId\":\"media\\/image\\/g6ccppunp5vjrlscvio5\",\"id\":\"media\\/image\\/g6ccppunp5vjrlscvio5\",\"getExtension\":\"png\",\"getWidth\":308,\"getHeight\":205,\"getTimeUploaded\":\"2021-12-15T11:11:21Z\"}', 1, '2021-12-15 05:41:22', '2021-12-15 05:41:22'),
(51, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639566684/media/image/fn4rnf6dpg24odfnvjlg.png', NULL, 0, '92f1ea7dcce3b5d06cd1b1418f9b9413 3.png', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566684\\/media\\/image\\/fn4rnf6dpg24odfnvjlg.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566684\\/media\\/image\\/fn4rnf6dpg24odfnvjlg.png\",\"getSize\":13503,\"getReadableSize\":\"13.19 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/fn4rnf6dpg24odfnvjlg\",\"getOriginalFileName\":\"phpAC35\",\"getPublicId\":\"media\\/image\\/fn4rnf6dpg24odfnvjlg\",\"id\":\"media\\/image\\/fn4rnf6dpg24odfnvjlg\",\"getExtension\":\"png\",\"getWidth\":100,\"getHeight\":80,\"getTimeUploaded\":\"2021-12-15T11:11:24Z\"}', 1, '2021-12-15 05:41:25', '2021-12-15 05:41:25'),
(52, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1639566688/media/image/feghami4szb6gdyhl8z7.png', NULL, 0, 'Mask Group.png', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566688\\/media\\/image\\/feghami4szb6gdyhl8z7.png\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1639566688\\/media\\/image\\/feghami4szb6gdyhl8z7.png\",\"getSize\":158373,\"getReadableSize\":\"154.66 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/feghami4szb6gdyhl8z7\",\"getOriginalFileName\":\"phpB703\",\"getPublicId\":\"media\\/image\\/feghami4szb6gdyhl8z7\",\"id\":\"media\\/image\\/feghami4szb6gdyhl8z7\",\"getExtension\":\"png\",\"getWidth\":414,\"getHeight\":375,\"getTimeUploaded\":\"2021-12-15T11:11:28Z\"}', 1, '2021-12-15 05:41:28', '2021-12-15 05:41:28'),
(60, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1641625946/media/image/tssz5x4jv7bdoynrtcuh.jpg', NULL, 0, '360_F_261018762_f15Hmze7A0oL58Uwe7SrDKNS4fZIjLiF.jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641625946\\/media\\/image\\/tssz5x4jv7bdoynrtcuh.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641625946\\/media\\/image\\/tssz5x4jv7bdoynrtcuh.jpg\",\"getSize\":119771,\"getReadableSize\":\"116.96 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/tssz5x4jv7bdoynrtcuh\",\"getOriginalFileName\":\"php7AF4\",\"getPublicId\":\"media\\/image\\/tssz5x4jv7bdoynrtcuh\",\"id\":\"media\\/image\\/tssz5x4jv7bdoynrtcuh\",\"getExtension\":\"jpg\",\"getWidth\":965,\"getHeight\":360,\"getTimeUploaded\":\"2022-01-08T07:12:26Z\"}', 1, '2022-01-08 01:42:27', '2022-01-08 01:42:27'),
(61, 1, 'cloudinar', 'media_controlled', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1641625949/media/image/i38yom49chlqsr1sxzte.jpg', NULL, 0, 'Banner(5).jpg', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641625949\\/media\\/image\\/i38yom49chlqsr1sxzte.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641625949\\/media\\/image\\/i38yom49chlqsr1sxzte.jpg\",\"getSize\":168083,\"getReadableSize\":\"164.14 KB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/i38yom49chlqsr1sxzte\",\"getOriginalFileName\":\"php9265\",\"getPublicId\":\"media\\/image\\/i38yom49chlqsr1sxzte\",\"id\":\"media\\/image\\/i38yom49chlqsr1sxzte\",\"getExtension\":\"jpg\",\"getWidth\":700,\"getHeight\":294,\"getTimeUploaded\":\"2022-01-08T07:12:29Z\"}', 1, '2022-01-08 01:42:31', '2022-01-08 01:42:31'),
(62, 1, 'cloudinar', 'user', NULL, NULL, 'https://res.cloudinary.com/dxvlsczpx/image/upload/v1641654647/media/image/xgzci9qd52ilgisrxcpt.jpg', NULL, 0, 'SampleCropImage.png', '{\"getPath\":\"http:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641654647\\/media\\/image\\/xgzci9qd52ilgisrxcpt.jpg\",\"getSecurePath\":\"https:\\/\\/res.cloudinary.com\\/dxvlsczpx\\/image\\/upload\\/v1641654647\\/media\\/image\\/xgzci9qd52ilgisrxcpt.jpg\",\"getSize\":4766721,\"getReadableSize\":\"4.55 MB\",\"getFileType\":\"image\",\"getFileName\":\"media\\/image\\/xgzci9qd52ilgisrxcpt\",\"getOriginalFileName\":\"php3DF\",\"getPublicId\":\"media\\/image\\/xgzci9qd52ilgisrxcpt\",\"id\":\"media\\/image\\/xgzci9qd52ilgisrxcpt\",\"getExtension\":\"jpg\",\"getWidth\":4312,\"getHeight\":5760,\"getTimeUploaded\":\"2022-01-08T15:10:47Z\"}', 1, '2022-01-08 09:40:47', '2022-01-08 09:40:47');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'customer',
  `phone` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plateform` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `device_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar_original` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_type`, `phone`, `email`, `email_verified_at`, `password`, `remember_token`, `plateform`, `device_token`, `avatar`, `avatar_original`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Ashish Kumar', 'admin', '7079692988', 'ranjanashish254@gmail.com', NULL, '$2y$10$zwCRfYjrIGYG0XczTkPpV.eKPFqmZPClGZnJPTcnXsajvPF./G3me', 'hej8BawgN3pmyvL53vTuM4B7D7eEErUyVq40wJBKrddHgbHXKOSmcZ7o9fiY', 'web', 'ctXpduZySMmDUeip-6ZWYc:APA91bHWmX5cw82XtFVdXmd9-Q2pPp7qFLpgM3lkWADGryJgi_JL3BqYtwypzrhVhArTpgI3ZtRezAZp_-KGjv1MNy_4rMJ4DSpWgC8sIxJugTGVy2yW4xXtsBZWaQyKedc4M-pKsg5a', '62', '', 1, '2021-12-08 05:20:49', '2022-01-13 13:06:38'),
(2, 'Test user 2', 'customer', NULL, 'testemail@gmail.com', NULL, '$2y$10$.TbpP/SAr7ny3j/hnGIJHe.fhQZr37qecW8/6uHfhhb/MykLKpj1u', NULL, 'android', NULL, '', '', 1, '2021-12-08 22:43:47', '2021-12-08 22:43:47'),
(15, 'Name', 'customer', '7079692989', NULL, NULL, '$2y$10$Mw2rhZNOFh0qXk3MafsqU.9qcGDcvZG9IjUBy6lS80o67toG.WIAC', NULL, 'android', 'not connect', NULL, NULL, 1, '2021-12-09 01:23:12', '2021-12-16 21:18:59'),
(16, 'Name', 'customer', '7079692986', NULL, NULL, '$2y$10$F8ceCHuCNCBmb4CarwF9n.5imsUgK6h6KYPDauevtVdTVLBDaCdJq', NULL, 'android', NULL, NULL, NULL, 1, '2021-12-09 08:57:13', '2021-12-09 08:57:13'),
(17, 'Name', 'customer', '7079693652', NULL, NULL, '$2y$10$xRBEDeUY6Aux0RHuppSXyeN.hslraL3Zc/1OjQFadtgJc/2c.uqSO', NULL, 'android', 'ctXpduZySMmDUeip-6ZWYc:APA91bHWmX5cw82XtFVdXmd9-Q2pPp7qFLpgM3lkWADGryJgi_JL3BqYtwypzrhVhArTpgI3ZtRezAZp_-KGjv1MNy_4rMJ4DSpWgC8sIxJugTGVy2yW4xXtsBZWaQyKedc4M-pKsg5a', NULL, NULL, 1, '2021-12-09 11:44:21', '2021-12-09 11:44:22');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `gender`, `created_at`, `updated_at`) VALUES
(1, 1, 'male', '2021-04-12 18:30:00', '2022-01-13 13:07:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `address`
--
ALTER TABLE `address`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `image_slider`
--
ALTER TABLE `image_slider`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `offer_exclusive`
--
ALTER TABLE `offer_exclusive`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_job`
--
ALTER TABLE `order_job`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `product_stocks`
--
ALTER TABLE `product_stocks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `refund_order`
--
ALTER TABLE `refund_order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sope`
--
ALTER TABLE `sope`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `address`
--
ALTER TABLE `address`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `image_slider`
--
ALTER TABLE `image_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `offer_exclusive`
--
ALTER TABLE `offer_exclusive`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `order_job`
--
ALTER TABLE `order_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `product_stocks`
--
ALTER TABLE `product_stocks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=203;

--
-- AUTO_INCREMENT for table `refund_order`
--
ALTER TABLE `refund_order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `sope`
--
ALTER TABLE `sope`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
