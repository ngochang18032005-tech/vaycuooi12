-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 08, 2025 at 10:48 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ngochang`
--

-- --------------------------------------------------------

--
-- Table structure for table `banners`
--

CREATE TABLE `banners` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` enum('slideshow','ads') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'slideshow',
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `sort_order` int UNSIGNED DEFAULT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `slug`, `image`, `description`, `sort_order`, `created_by`, `updated_by`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'The weird', 'the-weird', '1746541869_the-weird.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:30:37', '2025-05-06 07:31:09'),
(2, 'God vibe', 'god-vibe', '1746541896_hviSpp.png', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:31:36', '2025-05-06 07:31:36'),
(3, '4 Lucky', '4-lucky', '1746541917_4lqeeN.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:31:57', '2025-05-06 07:31:57'),
(4, 'Julido', 'julido', '1746541949_julido.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:32:05', '2025-05-06 07:32:29'),
(5, 'Haven', 'haven', '1746541971_qEiEOS.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:32:51', '2025-05-06 07:32:51'),
(6, 'Karantss', 'karantss', '1746541993_4AT6c9.jpg', NULL, NULL, NULL, NULL, NULL, 1, '2025-05-06 07:33:13', '2025-05-06 08:48:27');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint UNSIGNED NOT NULL,
  `category_name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_id` int UNSIGNED NOT NULL DEFAULT '0',
  `sort_order` int UNSIGNED DEFAULT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `slug`, `parent_id`, `sort_order`, `image`, `description`, `created_by`, `updated_by`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'váy cưới trắng', 'vay-cuoi-trang', 0, 0, '1759579872_z7056438664427_2f4b3fa20feb654321f30af14c6e4f82.jpg', NULL, NULL, NULL, NULL, 1, '2025-05-06 07:22:33', '2025-10-04 05:11:12'),
(2, 'váy cưới đỏ', 'vay-cuoi-o', 0, 0, '1759581907_vay-cuoi-mau-do-3-1.jpg', NULL, NULL, NULL, NULL, 1, '2025-05-06 07:25:24', '2025-10-04 05:45:07'),
(3, 'váy đuôi cá đen', 'vay-uoi-ca-en', 0, 0, '1759581848_image (1).jpg', NULL, NULL, NULL, NULL, 1, '2025-05-06 07:29:53', '2025-10-04 05:44:08'),
(4, 'váy cưới đen', 'vay-cuoi-en', 0, 0, '1759581809_tải xuống (2).jpeg', NULL, NULL, NULL, NULL, 1, '2025-05-06 07:34:08', '2025-10-04 05:43:29'),
(5, 'váy cưới _trắng', 'vay-cuoi-trang', 0, 0, '1759579638_05_Anne-640x960-1_403x576_acf_cropped.jpg', NULL, NULL, NULL, NULL, 1, '2025-05-06 07:35:57', '2025-10-08 03:34:02'),
(7, 'váy đuôi cá', 'vay-uoi-ca', 0, 0, '1759580177_z7056438717471_08fa0690df2e9256e13481a8a6450ffb.jpg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:11:30', '2025-10-04 05:16:17'),
(8, 'váy cưới nơ', 'vay-cuoi-no', 0, 0, '1759580277_pwg2rL.jpg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:17:57', '2025-10-04 05:17:57'),
(9, 'hoa cưới', 'hoa-cuoi', 0, 0, '1759580356_SRi9Aj.jpeg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:19:16', '2025-10-04 05:19:16'),
(10, 'khăn veil', 'khan-veil', 0, 0, '1759580527_mxdrtn.jpg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:22:07', '2025-10-04 05:22:07'),
(11, 'Giày cưới', 'giay-cuoi', 0, 0, '1759580896_BYtGnB.jpg', 'Giày cao guốc', NULL, NULL, NULL, 1, '2025-10-04 05:28:16', '2025-10-04 05:28:16'),
(12, 'Giày đen', 'giay-den', 0, 0, '1759580966_wxnSNl.jpg', 'Giày đen', NULL, NULL, NULL, 1, '2025-10-04 05:29:26', '2025-10-04 05:29:26'),
(13, 'Mũ thời trang', 'mu-thoi-trang', 0, 0, '1759581148_yDP86w.jpg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:32:28', '2025-10-04 05:32:28'),
(14, 'Mũ ren hoa', 'mu-ren-hoa', 0, 0, '1759581185_5jUaen.jpg', 'mũ hoa', NULL, NULL, NULL, 1, '2025-10-04 05:33:05', '2025-10-04 05:33:05'),
(15, 'Mũ hoa', 'mu-hoa', 0, 0, '1759581221_Q1bROa.jpg', 'mũ hoa', NULL, NULL, NULL, 1, '2025-10-04 05:33:41', '2025-10-04 05:33:41'),
(16, 'váy đen', 'vay-den', 0, 0, '1759582141_VTmBRI.jpeg', NULL, NULL, NULL, NULL, 1, '2025-10-04 05:49:01', '2025-10-04 05:49:01');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `custom_users`
--

CREATE TABLE `custom_users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','user') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `queue` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` enum('mainmenu','footermenu') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'mainmenu',
  `sort_order` int UNSIGNED NOT NULL DEFAULT '0',
  `parent_id` int UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2025_04_16_122302_create_banners_table', 1),
(2, '2025_04_16_122311_create_brands_table', 1),
(3, '2025_04_16_122320_create_categories_table', 1),
(4, '2025_04_16_122328_create_contacts_table', 1),
(5, '2025_04_16_122336_create_menus_table', 1),
(6, '2025_04_16_122345_create_products_table', 1),
(7, '2025_04_16_122353_create_orders_table', 1),
(8, '2025_04_16_122403_create_order_details_table', 1),
(9, '2025_04_16_122409_create_posts_table', 1),
(10, '2025_04_16_122419_create_custom_users_table', 1),
(11, '2025_04_16_122431_create_product_images_table', 1),
(12, '2025_04_16_122752_create_cache_table', 1),
(13, '2025_04_16_122842_create_job_table', 1),
(14, '2025_04_23_080316_create_users_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int UNSIGNED NOT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `email`, `phone`, `address`, `created_by`, `updated_by`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Đinh Quốc Cường', 'cuongzzz546@gmail.com', '0866177340', 'demo', 1, NULL, NULL, 1, '2025-05-06 08:45:19', '2025-05-06 08:45:19'),
(2, 1, 'Đinh Quốc Cường', 'cuongzzz546@gmail.com', '0866177340', 'demo', 1, NULL, NULL, 1, '2025-05-06 09:04:51', '2025-05-06 09:04:51'),
(3, 1, 'Đinh Quốc Cường', 'cuongzzz546@gmail.com', '0866177340', 'demo', 1, NULL, NULL, 1, '2025-05-07 09:39:22', '2025-05-07 09:39:22'),
(4, 7, 'abcd', 'abcd@gmail.com', '01212343412', 'abcd', 7, NULL, NULL, 2, '2025-05-08 02:46:56', '2025-05-08 02:51:21'),
(5, 1, 'Đinh Quốc Cườngg', 'cuongzzz5467@gmail.com', '0866177340', 'demo', 1, NULL, NULL, 2, '2025-05-08 04:59:05', '2025-05-08 05:08:44');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `price` double NOT NULL,
  `discount` double NOT NULL DEFAULT '0',
  `amount` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `qty`, `price`, `discount`, `amount`) VALUES
(1, 1, 51, 2, 299000, 0, 598000),
(2, 1, 53, 1, 299000, 0, 299000),
(3, 1, 48, 1, 399000, 0, 399000),
(4, 2, 53, 1, 299000, 0, 299000),
(5, 3, 53, 1, 299000, 0, 299000),
(6, 4, 50, 2, 350000, 0, 700000),
(7, 5, 52, 1, 350000, 0, 350000),
(8, 5, 51, 1, 299000, 0, 299000);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint UNSIGNED NOT NULL,
  `product_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint UNSIGNED NOT NULL,
  `brand_id` bigint UNSIGNED NOT NULL DEFAULT '0',
  `image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` double NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `is_on_sale` tinyint(1) NOT NULL DEFAULT '0',
  `sale_price` double NOT NULL DEFAULT '0',
  `views` int NOT NULL DEFAULT '0',
  `qty` int UNSIGNED NOT NULL DEFAULT '0',
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `slug`, `cat_id`, `brand_id`, `image`, `price`, `description`, `is_on_sale`, `sale_price`, `views`, `qty`, `created_by`, `updated_by`, `deleted_at`, `status`, `created_at`, `updated_at`) VALUES
(1, 'MIDNIGHT STATEMENT - ATK1237 - ATK1237', 'midnight-statement-atk1237-atk1237', 2, 1, '1746542737_theweird01.jpg', 3590000, NULL, 0, 1990000, 2414, 2112, 1, NULL, NULL, 1, '2025-05-06 07:45:37', '2025-10-04 06:22:26'),
(2, 'ETHEREAL WINGS - ATK1238 - ATK1238', 'ethereal-wings-atk1238-atk1238', 2, 2, '1746542763_theweird02.jpg', 3500000, NULL, 0, 2990000, 124, 1241, 1, NULL, NULL, 1, '2025-05-06 07:46:03', '2025-10-04 06:22:00'),
(3, 'PHANTOM BLAZE - ATK1236 - ATK1236', 'phantom-blaze-atk1236-atk1236', 2, 3, '1746542792_theweird03.jpg', 3500000, NULL, 0, 299000, 2352, 1313, 1, NULL, NULL, 1, '2025-05-06 07:46:32', '2025-10-08 03:36:24'),
(4, 'EVIL RABBIT - ATK1235 - ATK1235', 'evil-rabbit-atk1235-atk1235', 8, 4, '1746542829_theweird04.jpg', 35000000, NULL, 0, 29900000, 23543, 1413, 1, NULL, NULL, 1, '2025-05-06 07:47:09', '2025-10-04 06:21:31'),
(5, 'LIQUID ILLUSION - ATK1234 - ATK1234', 'liquid-illusion-atk1234-atk1234', 5, 5, '1746542889_theweird05.jpg', 3500000, NULL, 0, 2990000, 0, 2131, 1, NULL, NULL, 1, '2025-05-06 07:48:09', '2025-10-04 06:21:08'),
(6, 'SHADOW MIST - ATK1233 - ATK1233', 'shadow-mist-atk1233-atk1233', 8, 6, '1746542926_theweird06.jpg', 3500000, NULL, 0, 2990000, 0, 121, 1, NULL, NULL, 1, '2025-05-06 07:48:46', '2025-10-04 06:20:29'),
(8, 'URBAN STRIKE - CAP8821 - CAP8821', 'urban-strike-cap8821-cap8821', 5, 1, '1759577081_05_Anne-640x960-1_403x576_acf_cropped.jpg', 35000000, NULL, 0, 0, 0, 141, 1, NULL, NULL, 1, '2025-05-06 07:58:34', '2025-10-04 06:17:48'),
(9, 'NIGHT RIDER - HAT5512 - HAT5512', 'night-rider-hat5512-hat5512', 16, 2, '1746543543_mu02.jpg', 999000, NULL, 0, 0, 0, 124, 1, NULL, NULL, 1, '2025-05-06 07:59:03', '2025-10-04 06:17:02'),
(10, 'STREET VIBE - SNK4499 - SNK4499', 'street-vibe-snk4499-snk4499', 8, 3, '1759583791_af098c72-ffc8-4a5b-b732-410f85705dd4.jpeg', 19900000, NULL, 0, 0, 0, 131, 1, NULL, NULL, 1, '2025-05-06 07:59:30', '2025-10-04 06:16:31'),
(11, 'DARK FORCE - BLK2025 - BLK2025', 'dark-force-blk2025-blk2025', 8, 4, '1759583758_11866a0c-2951-413a-8e2a-68105aeda760.jpeg', 990000, NULL, 0, 0, 0, 32, 1, NULL, NULL, 1, '2025-05-06 07:59:58', '2025-10-04 06:15:58'),
(12, 'BLAZE CORE - FYA6677 - FYA6677', 'blaze-core-fya6677-fya6677', 8, 5, '1759583691_2e18ff69-b203-4e81-be9f-aa9eaf974933.jpeg', 29900000, NULL, 0, 0, 0, 1313, 1, NULL, NULL, 1, '2025-05-06 08:00:39', '2025-10-04 06:15:13'),
(13, 'ICE FANG - ICX3310 - ICX3310', 'ice-fang-icx3310-icx3310', 8, 6, '1759583665_1ec8434a-df53-427c-a5a8-f493ba6a7c68.jpeg', 54000000, NULL, 0, 0, 0, 141, 1, NULL, NULL, 1, '2025-05-06 08:01:13', '2025-10-04 06:14:25'),
(14, 'METRO BEAT - MTB9901 - MTB9901', 'metro-beat-mtb9901-mtb9901', 8, 1, '1759583430_OIP (2).webp', 15000000, NULL, 0, 0, 0, 19, 1, NULL, NULL, 1, '2025-05-06 08:01:47', '2025-10-04 06:10:30'),
(15, 'WOLF EDGE - WED7742 - WED7742', 'wolf-edge-wed7742-wed7742', 5, 2, '1759583388_All posts • Instagram (1).jpeg', 24500000, NULL, 0, 0, 0, 131, 1, NULL, NULL, 1, '2025-05-06 08:02:34', '2025-10-04 06:09:48'),
(16, 'PHANTOM ZONE - PHZ8844 - PHZ8844', 'phantom-zone-phz8844-phz8844', 5, 3, '1759583063_stella-dress-7.jpg', 1200000, NULL, 0, 0, 0, 13, 1, NULL, NULL, 1, '2025-05-06 08:03:03', '2025-10-04 06:08:48'),
(17, 'STORM HUNTER - STR1508 - STR1508', 'storm-hunter-str1508-str1508', 5, 4, '1759583013_z7056438717418_d501359e28382e5b462334496898d04a.jpg', 12000000, NULL, 0, 0, 0, 1313, 1, NULL, NULL, 1, '2025-05-06 08:03:41', '2025-10-04 06:03:33'),
(18, 'RED VENOM - RDV6023 - RDV6023', 'red-venom-rdv6023-rdv6023', 13, 5, '1759579374_z7070634353150_8cfd198aba3aef0a8645295e55b28028.jpg', 599000, NULL, 0, 0, 0, 141, 1, NULL, NULL, 1, '2025-05-06 08:04:22', '2025-10-04 06:01:59'),
(19, 'FROST WING - FSW3355 - FSW3355', 'frost-wing-fsw3355-fsw3355', 14, 1, '1759578786_z7070634529178_53d57661f8402f386694e0eaa74b56cf.jpg', 840000, NULL, 0, 0, 141, 1411, 1, NULL, NULL, 1, '2025-05-06 08:05:12', '2025-10-04 06:01:34'),
(20, 'TITAN GRAY - TTG2219 - TTG2219', 'titan-gray-ttg2219-ttg2219', 13, 2, '1746543947_mu13.jpg', 450000, NULL, 0, 0, 0, 5141, 1, NULL, NULL, 1, '2025-05-06 08:05:47', '2025-10-04 06:01:12'),
(21, 'FIRE HAWK - FHK3377 - FHK3377', 'fire-hawk-fhk3377-fhk3377', 14, 3, '1746544036_mu13.jpg', 399000, NULL, 0, 199000, 2414, 13143, 1, NULL, NULL, 1, '2025-05-06 08:07:16', '2025-10-04 06:00:26'),
(22, 'STEEL SHADOW - SSH2288 - SSH2288', 'steel-shadow-ssh2288-ssh2288', 13, 4, '1746544065_mu14.jpg', 299000, NULL, 0, 0, 0, 13124, 1, NULL, NULL, 1, '2025-05-06 08:07:45', '2025-10-04 06:00:09'),
(23, 'STREET BLAZE - STB1101 - STB1101', 'street-blaze-stb1101-stb1101', 11, 1, '1746544309_giay04.jpg', 3990000, NULL, 0, 0, 2415, 1313, 1, NULL, NULL, 1, '2025-05-06 08:11:49', '2025-10-04 05:40:27'),
(24, 'URBAN RUNNER - URR2233 - URR2233', 'urban-runner-urr2233-urr2233', 11, 1, '1746544412_giay10.jpg', 3500000, NULL, 0, 0, 0, 1314, 1, NULL, NULL, 1, '2025-05-06 08:13:32', '2025-10-04 05:58:48'),
(25, 'SKY TRACK - SKT3344 - SKT3344', 'sky-track-skt3344-skt3344', 1, 1, '1759579163_05_Anne-640x960-1_403x576_acf_cropped.jpg', 1000000, NULL, 0, 599000, 0, 24141, 1, NULL, NULL, 1, '2025-05-06 08:14:05', '2025-10-04 04:59:23'),
(26, 'NEO JUMP - NJP4455 - NJP4455', 'neo-jump-njp4455-njp4455', 1, 2, '1759578948_z7056438664427_2f4b3fa20feb654321f30af14c6e4f82.jpg', 45000000, NULL, 0, 400000, 0, 120, 1, NULL, NULL, 1, '2025-05-06 08:14:44', '2025-10-04 04:55:48'),
(27, 'HYPE ZONE - HZC5566 - HZC5566', 'hype-zone-hzc5566-hzc5566', 9, 2, '1759578748_hoa-cuoi-long-lay.jpg.webp', 399000, NULL, 0, 0, 0, 1313, 1, NULL, NULL, 1, '2025-05-06 08:15:07', '2025-10-08 03:37:15'),
(28, 'FAST EDGE - FSE6677 - FSE6677', 'fast-edge-fse6677-fse6677', 12, 2, '1746544543_giay15.jpg', 13400000, NULL, 0, 11000000, 345, 12412, 1, NULL, NULL, 1, '2025-05-06 08:15:43', '2025-10-04 05:40:07'),
(29, 'GRAVITY STEP - GST7788 - GST7788', 'gravity-step-gst7788-gst7788', 1, 2, '1759578659_chloe-dresss-3.jpg', 67000000, NULL, 0, 0, 0, 1239, 1, NULL, NULL, 1, '2025-05-06 08:16:30', '2025-10-04 04:50:59'),
(30, 'FADED CORE - ATK1232 - ATK1232', 'faded-core-atk1232-atk1232', 2, 1, '1746544643_theweird08.jpg', 3990000, NULL, 0, 2990000, 235, 14142, 1, NULL, NULL, 1, '2025-05-06 08:17:23', '2025-10-04 06:19:36'),
(31, 'BLURRED WEIRD - ATK1231 - ATK1231', 'blurred-weird-atk1231-atk1231', 2, 1, '1746544677_theweird09.jpg', 35000000, NULL, 0, 19900000, 352, 1511, 1, NULL, NULL, 1, '2025-05-06 08:17:57', '2025-10-04 06:19:05'),
(32, 'CHAINBOUND - ATK1230 - ATK1230', 'chainbound-atk1230-atk1230', 2, 1, '1746544710_theweird10.jpg', 19900000, NULL, 0, 0, 0, 1241, 1, NULL, NULL, 1, '2025-05-06 08:18:30', '2025-10-04 06:18:33'),
(33, 'PUNK FIRE - ATK1228 - ATK1228', 'punk-fire-atk1228-atk1228', 16, 6, '1759582568_Vay_cuoi_mau_den_3.webp', 4500000, NULL, 0, 4100000, 0, 1313, 1, NULL, NULL, 1, '2025-05-06 08:20:07', '2025-10-04 05:56:08'),
(34, 'DARK INFERNO - ATK1227 - ATK1227', 'dark-inferno-atk1227-atk1227', 16, 6, '1746544839_theweird13.jpg', 3990000, NULL, 0, 0, 0, 1241, 1, NULL, NULL, 1, '2025-05-06 08:20:39', '2025-10-04 05:54:43'),
(35, 'TRIBAL MASK - ATK1226 - ATK1226', 'tribal-mask-atk1226-atk1226', 3, 5, '1746544870_theweird12.jpg', 29900000, NULL, 0, 0, 74, 1241, 1, NULL, NULL, 1, '2025-05-06 08:21:10', '2025-10-04 05:54:20'),
(36, 'B.SICK - ATK1225 - ATK1225', 'bsick-atk1225-atk1225', 1, 2, '1759577333_z7056476439382_976ef3788c98c3db75c35a2e31f3d5e8.jpg', 25000000, NULL, 0, 0, 0, 12113, 1, NULL, NULL, 1, '2025-05-06 08:21:52', '2025-10-04 06:20:03'),
(37, 'MUSF - ATK1224 - ATK1224', 'musf-atk1224-atk1224', 16, 2, '1746544946_theweird15.jpg', 3100000, NULL, 0, 1900000, 0, 12441, 1, NULL, NULL, 1, '2025-05-06 08:22:26', '2025-10-04 05:53:55'),
(38, 'JEANS WEIRD - ATK1223 - ATK1223', 'jeans-weird-atk1223-atk1223', 3, 2, '1746544985_theweird16.jpg', 32900000, NULL, 0, 29900000, 0, 1213, 1, NULL, NULL, 1, '2025-05-06 08:23:05', '2025-10-04 05:53:14'),
(39, 'EVIL SMILE - ATK1222 - ATK1222', 'evil-smile-atk1222-atk1222', 8, 2, '1759578886_z7056474633007_4a3d1d150d198e199947ebd3c93a07f6.jpg', 39000000, NULL, 0, 0, 2355, 124, 1, NULL, NULL, 1, '2025-05-06 08:23:40', '2025-10-04 05:55:03'),
(40, 'DARK AURA - ATK1221 - ATK1221', 'dark-aura-atk1221-atk1221', 2, 3, '1746545076_theweird18.jpg', 35000000, NULL, 0, 29900000, 0, 1241, 1, NULL, NULL, 1, '2025-05-06 08:24:36', '2025-10-04 05:51:45'),
(41, 'MAVERICK - ATK1220 - ATK1220', 'maverick-atk1220-atk1220', 2, 3, '1746545104_theweird19.jpg', 29900000, NULL, 0, 0, 1, 343, 1, NULL, NULL, 1, '2025-05-06 08:25:04', '2025-10-04 05:51:10'),
(42, 'BRAVE HEART - ATK1219 - ATK1219', 'brave-heart-atk1219-atk1219', 3, 3, '1759582232_vay-cuoi-mau-den-26.jpg', 19900000, NULL, 0, 0, 0, 4142, 1, NULL, NULL, 1, '2025-05-06 08:25:31', '2025-10-04 05:50:50'),
(43, 'ANACONDA - ATK1218 - ATK1218', 'anaconda-atk1218-atk1218', 1, 4, '1759577310_z7056476439381_46b00854f68e135f85a2fba78ef56715.jpg', 59900000, NULL, 0, 39900000, 0, 12341, 1, NULL, NULL, 1, '2025-05-06 08:26:12', '2025-10-04 05:48:15'),
(44, 'F_DENIM - ATK1217 - ATK1217', 'fdenim-atk1217-atk1217', 7, 5, '1759577230_OIP (2).webp', 45000000, NULL, 0, 0, 0, 1231, 1, NULL, NULL, 1, '2025-05-06 08:27:07', '2025-10-04 05:38:08'),
(45, 'ZOE - ATK1216 - ATK1216', 'zoe-atk1216-atk1216', 5, 5, '1746545269_theweird23.jpg', 5000000, NULL, 0, 3990000, 0, 134, 1, NULL, NULL, 1, '2025-05-06 08:27:49', '2025-10-04 05:47:44'),
(46, 'MIXIF - ATK1215 - ATK1215', 'mixif-atk1215-atk1215', 5, 5, '1759577211_z7056476439380_50ffbd9ce6726882d7f776250030c0ce.jpg', 35000000, NULL, 0, 19900000, 0, 1244, 1, NULL, NULL, 1, '2025-05-06 08:28:20', '2025-10-04 05:46:48'),
(47, 'WEANS - ATK1214 - ATK1214', 'weans-atk1214-atk1214', 7, 5, '1759577190_giselle-dress-5.jpg', 39900000, NULL, 0, 0, 232, 2352, 1, NULL, NULL, 1, '2025-05-06 08:28:53', '2025-10-04 05:36:38'),
(48, 'OGENEUS - ATK1213 - ATK1213', 'ogeneus-atk1213-atk1213', 16, 6, '1746545370_theweird25.jpg', 3990000, NULL, 0, 0, 2, 3121, 1, NULL, NULL, 1, '2025-05-06 08:29:30', '2025-10-04 05:49:50'),
(49, 'VINS - ATK1212 - ATK1212', 'vins-atk1212-atk1212', 7, 6, '1746545399_theweird26.jpg', 29900000, NULL, 0, 0, 0, 1241, 1, NULL, NULL, 1, '2025-05-06 08:29:59', '2025-10-04 05:35:57'),
(50, 'LIOUS - ATK1211 - ATK1211', 'lious-atk1211-atk1211', 5, 6, '1759577148_Gala-Galia-Lahav-Spring-2025-Dress-5-403b4dd5a5db4e8e901fa712ab173249.webp', 42500000, NULL, 0, 35000000, 2, 3521, 1, NULL, NULL, 1, '2025-05-06 08:30:36', '2025-10-04 05:47:13'),
(51, 'PLINT - ATK1209 - ATK1209', 'plint-atk1209-atk1209', 13, 6, '1759577133_z7070634412048_5f1903ce84237484ceee5ca9de26c36f.jpg', 5190000, NULL, 0, 2990000, 4, 6433, 1, NULL, NULL, 1, '2025-05-06 08:31:06', '2025-10-04 05:35:06'),
(52, 'GOUIC - ATK1210 - ATK1210', 'gouic-atk1210-atk1210', 7, 6, '1759577116_OIP (1).webp', 3500000, NULL, 0, 0, 0, 2353, 1, NULL, NULL, 1, '2025-05-06 08:31:42', '2025-10-04 05:49:28'),
(53, 'MATIS - ATK1208 - ATK1208', 'matis-atk1208-atk1208', 14, 6, '1759577098_bridal-gowns-3-1.jpg', 2990000, NULL, 0, 0, 11, 322, 1, NULL, NULL, 1, '2025-05-06 08:32:14', '2025-10-04 05:34:18'),
(54, 'Hoa cưới tulip', 'hoa-cuoi-tulip', 9, 1, '1759918820_d332cf18-26ba-428c-9d3a-5a3c10439f23.jpeg', 850000, NULL, 0, 0, 0, 300, 1, NULL, NULL, 1, '2025-10-08 03:20:20', '2025-10-08 03:20:20'),
(55, 'Hoa cưới phi yến trắng', 'hoa-cuoi-phi-yen-trang', 9, 5, '1759919110_Hoa cưới Phi Yến Trắng.jpeg', 750000, NULL, 0, 0, 0, 300, 1, NULL, NULL, 1, '2025-10-08 03:25:10', '2025-10-08 03:33:21'),
(56, 'Hoa cưới tulip hồng', 'hoa-cuoi-tulip-hong', 9, 5, '1759919193_f5c93ec3-ef47-493d-bc29-7812dc4d4c57.jpeg', 950000, NULL, 0, 0, 0, 300, 1, NULL, NULL, 1, '2025-10-08 03:26:33', '2025-10-08 03:26:33'),
(57, 'khăn veil trắng', 'khan-veil-trang', 10, 1, '1759919271_z7070608472562_6669ae06c1ed44de7de1492d938977d4.jpg', 1050000, NULL, 0, 0, 0, 300, 1, NULL, NULL, 1, '2025-10-08 03:27:51', '2025-10-08 03:27:51'),
(58, 'khăn veil nhẹ', 'khan-veil-nhe-nhang', 10, 1, '1759919391_1f37e75f-d287-42ff-95c1-b3b93986c2b5.jpeg', 1500000, NULL, 0, 0, 0, 300, 1, NULL, NULL, 1, '2025-10-08 03:29:51', '2025-10-08 03:29:51'),
(59, 'khăn che đơn giản', 'khan-che-on-gian', 10, 1, '1759919506_Cô dâu đơn giản màu trắng 60cm nơ voan ngắn yếu tố hạt trang trí móng tay tạo kiểu sáng tạo tiệc ảnh phụ kiện tóc ngày lễ tình nhân.jpeg', 440000, NULL, 0, 0, 0, 56, 1, NULL, NULL, 1, '2025-10-08 03:31:46', '2025-10-08 03:32:30'),
(60, 'giày đen nơ', 'giay-en-no', 12, 1, '1759920082_674b7b92-02f7-4172-9c99-172a787ca787.jpeg', 892000, NULL, 0, 0, 0, 124, 1, NULL, NULL, 1, '2025-10-08 03:41:22', '2025-10-08 03:41:22'),
(61, 'Giày đen nơ đính đá', 'giay-en-no-inh-a', 12, 3, '1759920139_0871131c-594f-4ac8-a3bf-057d5569ea6d.jpeg', 2460000, NULL, 0, 0, 0, 243, 1, NULL, NULL, 1, '2025-10-08 03:42:19', '2025-10-08 03:44:50'),
(62, 'giày cưới mũi nhọn công nương', 'giay-cuoi-mui-nhon-cong-nuong', 11, 2, '1759920260_8bb325a0-22fd-479e-ba2f-12734765349d.jpeg', 1310000, NULL, 0, 0, 0, 49, 1, NULL, NULL, 1, '2025-10-08 03:44:20', '2025-10-08 03:44:20'),
(63, 'cao gót mũi nhọn', 'cao-got-mui-nhon', 12, 3, '1759920373_40bc2768-f3d0-4e98-8879-9066242b545c.jpeg', 590000, NULL, 0, 0, 0, 890, 1, NULL, NULL, 1, '2025-10-08 03:46:13', '2025-10-08 03:46:34'),
(64, 'cao gót mũi  9cm', 'cao-got-mui-9cm', 12, 3, '1759920475_ce2072db-5b93-48d3-bada-0e8d2ef964c8.jpeg', 890000, NULL, 0, 0, 0, 234, 1, NULL, NULL, 1, '2025-10-08 03:47:55', '2025-10-08 03:47:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` int UNSIGNED DEFAULT NULL,
  `updated_by` int UNSIGNED DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `status` int UNSIGNED NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `fullname` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` enum('male','female') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `username`, `email`, `phone`, `address`, `birthday`, `gender`, `avatar`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Ngọc Hằng', 'hahaha.qc04', 'cuongzzz5467@gmail.com', '0866177340', 'demo', '2004-08-28', 'male', '1746545892_avt.jpg', '$2y$12$jUAUCG7kPIVsuf5lzhJT7uH1F0D2CqNqXxzRnpI.k8BxmDtaWMTdS', 'admin', '2025-05-06 06:22:13', '2025-10-04 05:57:27'),
(2, 'nguyễn văn a', 'aaa', 'aaa@gmail.com', '0123456789', 'aaa', '2025-05-06', 'male', '1746546658_avt.jpg', '$2y$12$.cQGCbU7RMU1dZI1bqcrJeayZvEleuS8E3woJOd8Sf54D9nHKT5FS', 'user', '2025-05-06 08:50:58', '2025-05-06 08:50:58'),
(3, 'nguyễn văn aa', 'aaaaaa', 'aaaaaa@gmail.com', '0987654321', 'aaaaaa', '2025-05-06', 'male', '1746546893_avt.jpg', '$2y$12$ZLNeGdo7L8fzR7oF67j51eHOHkuHE9cgfbBmG0VLcavURGI1lboMu', 'user', '2025-05-06 08:54:53', '2025-05-06 08:54:53'),
(4, 'le van hieu', 'levanhieu', 'levanhieu@gmail.com', '0989898989', 'le van hieu', '2025-05-06', 'male', '1746547116_cat01.jpg', '$2y$12$FW7UA0UD8yUVMm2C2kJi4.J3LSh72IhQE9V8m32/z16SoeFhDVQYG', 'user', '2025-05-06 08:58:36', '2025-05-06 08:58:36'),
(5, 'ha ha ha', 'haha', 'hahaha@gmail.com', '046687654', 'aaa', '2025-05-06', 'male', '1746547186_cat05.jpg', '$2y$12$xkOhEA6hN/duzyeui7j1ku5erxTbuMXgy33eENiOJWNlwWvTA0io2', 'user', '2025-05-06 08:59:46', '2025-05-06 08:59:46'),
(6, 'Lê Văn Hiếu', 'zxcvbnm', 'zxcvbnm@gmail.com', '0123432123', 'zxcvbnm', '2025-05-06', 'male', '1746547345_tui-4.jpg', '$2y$12$7V4BeFDEyQ9oPBjK7W64zeTJnj/sMnLAGz8cqMDCO4VD3vz92L3NW', 'user', '2025-05-06 09:02:26', '2025-05-06 09:02:26'),
(7, 'abcd', 'abcd', 'abcd@gmail.com', '01212343412', 'abcd', '2004-08-28', 'male', '1746697546_kaki-shirt1-atk632-4694.jpg', '$2y$12$Eja/LHIQ9QX3U3l.0x9fFeumoagFo.HhS/iwR484b7h3/7bdLtiGa', 'user', '2025-05-08 02:45:46', '2025-05-08 02:45:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `custom_users`
--
ALTER TABLE `custom_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `custom_users_username_unique` (`username`),
  ADD UNIQUE KEY `custom_users_email_unique` (`email`),
  ADD UNIQUE KEY `custom_users_phone_unique` (`phone`);

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
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
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
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_product_name_unique` (`product_name`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `banners`
--
ALTER TABLE `banners`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `custom_users`
--
ALTER TABLE `custom_users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
