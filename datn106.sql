-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 16, 2024 at 12:43 PM
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
-- Database: `datn106`
--

-- --------------------------------------------------------

--
-- Table structure for table `attribute_products`
--

CREATE TABLE `attribute_products` (
  `attribute_product_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `color_id` int UNSIGNED NOT NULL,
  `size_id` int UNSIGNED NOT NULL,
  `in_stock` int NOT NULL DEFAULT '100000',
  `price` double(16,2) NOT NULL DEFAULT '100000.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_products`
--

INSERT INTO `attribute_products` (`attribute_product_id`, `product_id`, `color_id`, `size_id`, `in_stock`, `price`, `created_at`, `updated_at`) VALUES
(18, 3, 1, 1, 100000, 99999.00, NULL, NULL),
(19, 3, 1, 2, 100000, 104580.00, NULL, NULL),
(20, 3, 2, 1, 100000, 107600.00, NULL, NULL),
(21, 3, 2, 2, 100000, 145000.00, NULL, NULL),
(100, 8, 1, 1, 100000, 107500.00, NULL, NULL),
(101, 8, 1, 2, 100000, 107697.00, NULL, NULL),
(102, 8, 2, 1, 100000, 185000.00, NULL, NULL),
(103, 8, 2, 2, 100000, 574000.00, NULL, NULL),
(121, 4, 1, 1, 100000, 350000.00, NULL, NULL),
(122, 4, 1, 2, 100000, 350000.00, NULL, NULL),
(123, 4, 2, 1, 100000, 140000.00, NULL, NULL),
(124, 4, 2, 2, 100000, 100860.00, NULL, NULL),
(125, 6, 1, 1, 100000, 100000.00, NULL, NULL),
(126, 6, 1, 2, 100000, 100000.00, NULL, NULL),
(127, 6, 2, 1, 100000, 100000.00, NULL, NULL),
(128, 6, 2, 2, 100000, 100000.00, NULL, NULL),
(129, 7, 1, 1, 100000, 100000.00, NULL, NULL),
(130, 7, 1, 2, 100000, 100000.00, NULL, NULL),
(131, 7, 2, 1, 100000, 100000.00, NULL, NULL),
(132, 7, 2, 2, 100000, 100000.00, NULL, NULL),
(133, 5, 1, 1, 100000, 100000.00, NULL, NULL),
(134, 5, 1, 2, 100000, 100000.00, NULL, NULL),
(135, 5, 2, 1, 100000, 100000.00, NULL, NULL),
(136, 5, 2, 2, 100000, 100000.00, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `banned_words`
--

CREATE TABLE `banned_words` (
  `banned_word_id` int UNSIGNED NOT NULL,
  `word` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`, `description`, `slug`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'vdgedjke', 'bswgfdkefgye', 'vdgedjke', 1, '2024-12-06 02:42:58', '2024-12-06 02:42:58', NULL),
(2, 'polo', 'ao thoi trang polo', 'polo', 1, '2024-12-14 07:42:23', '2024-12-14 07:42:23', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int UNSIGNED NOT NULL,
  `shopping_cart_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `color_id` int UNSIGNED NOT NULL,
  `size_id` int UNSIGNED NOT NULL,
  `qty` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `shopping_cart_id`, `product_id`, `color_id`, `size_id`, `qty`, `created_at`, `updated_at`) VALUES
(152, 6, 4, 2, 2, 1, '2024-12-14 20:18:41', '2024-12-14 20:18:41'),
(153, 6, 5, 1, 1, 1, '2024-12-14 20:23:00', '2024-12-14 20:23:00'),
(189, 5, 4, 1, 2, 1, '2024-12-16 05:12:05', '2024-12-16 05:12:05'),
(190, 5, 8, 1, 2, 1, '2024-12-16 05:12:33', '2024-12-16 05:12:33'),
(191, 5, 7, 1, 2, 3, '2024-12-16 05:16:39', '2024-12-16 05:16:39'),
(192, 5, 7, 2, 1, 1, '2024-12-16 05:23:28', '2024-12-16 05:23:28');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL DEFAULT '1',
  `parent_id` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `image`, `slug`, `is_active`, `parent_id`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'vsnhwed', 'bhwdeydi', 'default.jpg', 'vsnhwed', 1, 0, '2024-12-06 02:41:19', '2024-12-06 02:41:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `color_id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `color_code` varchar(7) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`color_id`, `name`, `color_code`, `created_at`, `updated_at`) VALUES
(1, 'red', '#a42828', '2024-12-06 02:41:58', '2024-12-06 02:41:58'),
(2, 'blue', '#a42892', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `coupon_id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `quantity` int NOT NULL DEFAULT '0',
  `min_order_value` decimal(10,2) DEFAULT NULL,
  `max_order_value` decimal(10,2) DEFAULT NULL,
  `condition` text COLLATE utf8mb4_unicode_ci,
  `is_public` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`coupon_id`, `code`, `discount_amount`, `discount_percentage`, `quantity`, `min_order_value`, `max_order_value`, `condition`, `is_public`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'giam10pt', NULL, '10.00', 300, '50000.00', '10000000.00', NULL, 1, '2024-12-15', '2024-12-31', 1, '2024-12-16 01:03:57', '2024-12-16 01:03:57', NULL),
(2, 'giam15pt', NULL, '15.00', 42, '10000.00', '99999999.00', NULL, 1, '2024-12-03', '2024-12-31', 1, '2024-12-16 04:38:30', '2024-12-16 04:38:30', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `coupon_product`
--

CREATE TABLE `coupon_product` (
  `coupon_product_id` int UNSIGNED NOT NULL,
  `coupon_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `coupon_user`
--

CREATE TABLE `coupon_user` (
  `coupon_user_id` int UNSIGNED NOT NULL,
  `coupon_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `customer_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `loyalty_points` int NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `employee_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `role` enum('admin','managerCate','managerpro','managerCoupon','managerOder') COLLATE utf8mb4_unicode_ci NOT NULL,
  `salary` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `like_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `review_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(34, '2014_10_12_000000_create_users_table', 1),
(35, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(36, '2014_10_12_100000_create_password_resets_table', 1),
(37, '2019_08_19_000000_create_failed_jobs_table', 1),
(38, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(39, '2024_10_16_154810_create_brands_table', 1),
(40, '2024_10_16_154830_create_categories_table', 1),
(41, '2024_10_16_154942_create_products_table', 1),
(42, '2024_10_16_163033_create_shopping_carts_table', 1),
(43, '2024_10_16_163053_create_cart_items_table', 1),
(44, '2024_10_16_163854_create_orders_table', 1),
(45, '2024_10_16_163903_create_order_items_table', 1),
(46, '2024_10_16_170920_create_payments_table', 1),
(47, '2024_10_17_175258_add_deleted_at_to_brands', 1),
(48, '2024_10_18_135054_add_column_deleted_at_to_table_categories', 1),
(49, '2024_10_29_132236_create_product_views_table', 1),
(50, '2024_10_31_073934_create_coupon_table', 1),
(51, '2024_10_31_081812_create_coupon_user_table', 1),
(52, '2024_10_31_082034_create_coupon_product_table', 1),
(53, '2024_11_11_135917_update_users_table_remember_token_nullable', 1),
(54, '2024_11_21_104752_create_colors_table', 1),
(55, '2024_11_21_104813_create_sizes_table', 1),
(56, '2024_11_21_110145_create_attribute_products_table', 1),
(57, '2024_11_21_110246_create_product_images_table', 1),
(58, '2024_11_25_135436_add_column_is_banned', 1),
(59, '2024_11_25_144747_create_banned_words_table', 1),
(60, '2024_11_27_230903_add_flags_to_products_table', 1),
(61, '2024_11_28_121420_create_reviews_table', 1),
(62, '2024_11_28_121743_create_reports_table', 1),
(63, '2024_11_28_121940_create_likes_table', 1),
(64, '2024_11_29_144955_create_review_replies_table', 1),
(65, '2024_12_02_191005_add_role_to_users_table', 1),
(66, '2024_12_04_082421_add_vnpay_fields_to_payments_table', 1),
(67, '2024_12_07_064716_add_color_id_and_size_id_to_cart_items_table', 2),
(68, '2024_12_09_171452_add_is_best_seller_to_products_table', 2),
(69, '2024_12_09_182630_remove_is_active_is_hot_is_best_seller_from_products_table', 3),
(70, '2024_12_09_182725_add_is_active_is_hot_is_best_seller_to_products_table', 4),
(71, '2024_12_06_141955_create_customers_table', 5),
(72, '2024_12_09_024258_add_delete_at', 5),
(73, '2024_12_09_085426_create_employees_table', 5),
(74, '2024_12_09_195650_add_is_active_is_hot_is_best_seller_to_products_table', 6),
(75, '2024_12_12_193406_add_color_and_size_to_order_items_table', 7),
(76, '2024_12_13_102932_add_shipping_address_to_orders_table', 8),
(77, '2024_12_13_113222_add_phone_to_orders_table', 9),
(78, '2024_12_14_125851_add_payment_method_to_orders_table', 10),
(79, '2024_12_11_090310_create_prom_pers_table', 11),
(80, '2024_12_11_090631_create_prom_per_product_table', 11),
(81, '2024_12_15_113157_add_recipient_name_to_orders_table', 12),
(82, '2024_12_15_123034_add_received_to_orders', 12);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('pending','processing','shipped','delivered','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `invoice_date` timestamp NULL DEFAULT NULL,
  `payment_status` enum('pending','paid','failed','refunded','cancelled','authorized') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shipping_address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Địa chỉ nhận hàng',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recipient_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `received` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `total`, `invoice_date`, `payment_status`, `created_at`, `updated_at`, `shipping_address`, `phone`, `payment_method`, `recipient_name`, `received`) VALUES
(210, 1, '2024-12-15 15:21:46', 'completed', '140000.00', '2024-12-15 02:21:47', 'pending', '2024-12-12 17:00:00', '2024-12-15 03:56:16', 'Phuc Dien', '0967365963', 'COD', 'Vân ANh Cute', 0),
(211, 1, '2024-12-15 15:21:43', 'completed', '140000.00', '2024-12-15 02:26:19', 'pending', '2024-12-15 02:09:15', '2024-12-15 03:55:35', 'Phuc Dien', '0967365963', 'COD', 'Vân ANh Cute', 0),
(212, 1, '2024-12-15 15:38:36', 'delivered', '140000.00', '2024-12-15 04:30:52', 'paid', '2024-12-15 04:30:52', '2024-12-15 08:36:24', 'New Mya', '(331) 798-9906', 'VNPAY', 'Vân ANh Cute', 1),
(213, 1, '2024-12-15 15:42:56', 'pending', '440000.00', '2024-12-15 08:42:56', 'pending', '2024-12-15 08:42:56', '2024-12-15 08:42:56', 'Yên Thọ - Yên Định - Thanh Hóa', '0967365963', 'COD', 'Hồ Xuân Đăng', 0),
(214, 1, '2024-12-15 16:21:08', 'pending', '440000.00', '2024-12-15 09:21:08', 'pending', '2024-12-15 09:21:08', '2024-12-15 09:21:08', 'New Mya', '(331) 798-9906', 'COD', 'bryon92', 0),
(216, 1, '2024-12-15 16:31:34', 'pending', '340000.00', '2024-12-15 09:31:34', 'pending', '2024-12-15 09:31:34', '2024-12-15 09:31:34', 'New Mya', '(331) 798-9906', 'COD', 'bryon92', 0),
(227, 1, '2024-12-16 01:39:43', 'pending', '306000.00', '2024-12-16 01:39:43', 'pending', '2024-12-16 01:39:43', '2024-12-16 01:39:43', 'New Mya', '(331) 798-9906', 'VNPAY', 'bryon92', 0),
(266, 1, '2024-12-16 10:02:14', 'pending', '126000.00', '2024-12-16 03:02:14', 'pending', '2024-12-16 03:02:14', '2024-12-16 03:02:14', 'New Mya', '(331) 798-9906', 'COD', 'bryon92', 0),
(267, 1, '2024-12-16 03:04:24', 'pending', '140000.00', '2024-12-16 03:04:24', 'pending', '2024-12-16 03:04:24', '2024-12-16 03:04:24', 'New Mya', '(331) 798-9906', 'VNPAY', 'bryon92', 0),
(268, 1, '2024-12-16 10:21:59', 'pending', '126000.00', '2024-12-16 03:04:37', 'failed', '2024-12-16 03:04:37', '2024-12-16 03:21:59', 'New Mya', '(331) 798-9906', 'VNPAY', 'bryon92', 0),
(269, 1, '2024-12-16 11:42:04', 'pending', '374000.00', '2024-12-16 04:42:04', 'pending', '2024-12-16 04:42:04', '2024-12-16 04:42:04', 'New Mya', '(331) 798-9906', 'COD', 'bryon92', 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `quantity` int NOT NULL DEFAULT '1',
  `price` decimal(10,2) NOT NULL,
  `total` decimal(10,2) GENERATED ALWAYS AS ((`quantity` * `price`)) VIRTUAL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `color_id` int UNSIGNED DEFAULT NULL,
  `size_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`, `color_id`, `size_id`) VALUES
(128, 210, 6, 1, '100000.00', '2024-12-15 02:21:47', '2024-12-15 02:21:47', 2, 1),
(129, 211, 5, 1, '100000.00', '2024-12-15 02:26:19', '2024-12-15 02:26:19', 1, 1),
(130, 212, 7, 1, '100000.00', '2024-12-15 04:31:33', '2024-12-15 04:31:33', 1, 1),
(131, 213, 5, 1, '100000.00', '2024-12-15 08:42:56', '2024-12-15 08:42:56', 1, 1),
(132, 213, 5, 3, '100000.00', '2024-12-15 08:42:56', '2024-12-15 08:42:56', 2, 2),
(133, 214, 4, 1, '100000.00', '2024-12-15 09:21:08', '2024-12-15 09:21:08', 1, 1),
(134, 214, 4, 3, '100000.00', '2024-12-15 09:21:08', '2024-12-15 09:21:08', 1, 2),
(135, 216, 4, 1, '100000.00', '2024-12-15 09:31:34', '2024-12-15 09:31:34', 1, 1),
(136, 216, 5, 2, '100000.00', '2024-12-15 09:31:34', '2024-12-15 09:31:34', 1, 1),
(152, 266, 4, 1, '100000.00', '2024-12-16 03:02:14', '2024-12-16 03:02:14', 1, 1),
(153, 269, 4, 3, '100000.00', '2024-12-16 04:42:04', '2024-12-16 04:42:04', 1, 1),
(154, 269, 4, 1, '100000.00', '2024-12-16 04:42:04', '2024-12-16 04:42:04', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('ngoisao00304@gmail.com', '$2y$10$1DiG8RxYc5H7pyHc/EA30uFvBgTzAtddmBcVbknQiFxXdjZk.S5ie', '2024-12-11 09:02:45');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('pending','completed','failed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `vnp_txnref` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_bankcode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_responsecode` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_transactionno` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_securehash` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vnp_transdate` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
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
  `product_id` int UNSIGNED NOT NULL,
  `brand_id` int UNSIGNED NOT NULL,
  `product_category_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `main_image_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `view_count` bigint NOT NULL DEFAULT '0',
  `discount` double(16,2) NOT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `is_sale` tinyint(1) NOT NULL DEFAULT '0',
  `sold_count` bigint UNSIGNED NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `is_hot` tinyint(1) NOT NULL DEFAULT '0',
  `is_best_seller` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `brand_id`, `product_category_id`, `name`, `main_image_url`, `view_count`, `discount`, `start_date`, `end_date`, `description`, `sku`, `subtitle`, `slug`, `deleted_at`, `created_at`, `updated_at`, `is_sale`, `sold_count`, `is_active`, `is_hot`, `is_best_seller`) VALUES
(3, 1, 1, 'expedita', 'imagePro/1733504287.jpg', 618, 37.00, NULL, NULL, 'Recusandae veniam id sit et quidem. Ullam dolor aut praesentium quo labore exercitationem. Itaque aliquam sed numquam nihil.', 'Est eos perspiciatis consequatur velit. Sed consequatur fugiat placeat. Velit aut nesciunt nam similique enim quaerat natus. Consequatur qui explicabo doloribus ex provident ex suscipit.', 'Vitae pariatur nemo quidem saepe. Qui quo ea veniam officia recusandae vel assumenda. Omnis fugit a facere. Molestiae numquam rem in.', 'expedita', '2024-12-11 08:27:58', '1973-11-09 03:05:02', '2024-12-11 08:27:58', 1, 84, 1, 1, 1),
(4, 1, 1, 'ao polo mau xanh luc', 'imagePro/1734232561.jpg', 541, 48.00, '1980-07-13', '1980-07-13', 'Ut autem illum modi assumenda deserunt. Suscipit atque sint eaque ut. Consequatur officia veritatis aliquam.', 'Et incidunt non velit aperiam at. Enim voluptatem quisquam quos magnam nemo consequatur. Aut quaerat aut facilis voluptatum.', 'Laudantium et possimus aliquid et est. Quasi qui provident voluptatem consequuntur culpa. Quia ea sit omnis. Accusamus nemo voluptas cupiditate sit.', 'ao-polo-mau-xanh-luc', NULL, '2021-07-31 16:52:09', '2024-12-14 20:16:01', 1, 451, 1, 1, 1),
(5, 1, 1, 'ao polo xam', 'imagePro/1734232631.jpg', 582, 45.00, '1994-10-06', '1994-10-06', 'Ut quasi et voluptate autem. Saepe sed perspiciatis quae sit optio cupiditate. Officia ut commodi in sed. Recusandae non veritatis id et aliquid.', 'Ducimus et dolorem blanditiis. Expedita ut officia tenetur qui dolorum voluptate ducimus. Non nihil non voluptatibus dicta ut ratione reiciendis.', 'Sunt nostrum eveniet maiores. Consectetur unde nulla eum fuga. Non incidunt et porro quia omnis itaque voluptates quisquam. Rerum nam nesciunt fuga dolorem.', 'ao-polo-xam', NULL, '1987-02-01 11:34:20', '2024-12-14 20:17:11', 1, 347, 1, 1, 1),
(6, 1, 1, 'ao polo xanh dam', 'imagePro/1734232588.jpg', 243, 27.00, '2005-11-13', '2005-11-13', 'Omnis ullam sed est omnis quidem impedit. Qui assumenda qui aliquid voluptas. Accusamus et fuga distinctio qui.', 'Et qui fuga aut deserunt sapiente sit distinctio. Cum modi est cupiditate assumenda quae sed. Illum quia magnam optio. Cupiditate vel accusantium odit nihil sapiente sed.', 'Perferendis esse omnis laudantium dolores repellat. Ut quis sunt quas rerum quidem eligendi qui. Porro omnis blanditiis voluptas non. Et delectus illo illum labore repellat unde ex.', 'ao-polo-xanh-dam', NULL, '2003-05-01 23:44:16', '2024-12-14 20:16:28', 0, 492, 1, 0, 0),
(7, 1, 1, 'ao polo trang', 'imagePro/1734232609.jpg', 954, 19.00, '2000-07-26', '2000-07-26', 'Officia exercitationem voluptatem adipisci officiis impedit. Temporibus non fugit doloribus. Quidem magnam rerum quos molestiae autem repellendus. Sit quidem qui quod a.', 'Illo numquam sint a a. Voluptatem pariatur at mollitia ad. Eos asperiores sequi aliquid aperiam quas placeat.', 'Ea velit doloribus natus est. Ut optio saepe temporibus dicta magnam velit quis. Maxime aut dolorem quidem facilis voluptas molestiae. Minus officia et provident saepe.', 'ao-polo-trang', NULL, '2000-09-29 18:18:59', '2024-12-14 20:16:49', 1, 250, 1, 0, 0),
(8, 1, 1, 'ut123', 'imagePro/1734175163.jpg', 0, 10.00, '2024-12-01', '2024-12-01', 'co', '123', '1234', 'ut123', NULL, '2024-12-07 02:39:23', '2024-12-14 04:19:23', 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `product_image_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `color_id` int UNSIGNED NOT NULL,
  `url` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`product_image_id`, `product_id`, `color_id`, `url`, `created_at`, `updated_at`) VALUES
(7, 8, 1, 'public/images/color_1/T9dt2xMGrGFmQdWm0AsVHbfLk1bkGBwdReE66Zom.jpg', NULL, NULL),
(8, 8, 2, 'public/images/color_2/loSjIKU0Y3kxatATFf3FsHxl2yemb9SnvVP9Lmqg.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_views`
--

CREATE TABLE `product_views` (
  `product_view_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `view_at` timestamp NOT NULL DEFAULT '2024-12-06 02:39:12',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prom_pers`
--

CREATE TABLE `prom_pers` (
  `prom_per_id` int UNSIGNED NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_amount` decimal(10,2) DEFAULT NULL,
  `discount_percentage` decimal(5,2) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `prom_per_product`
--

CREATE TABLE `prom_per_product` (
  `prom_per_product_id` int UNSIGNED NOT NULL,
  `prom_per_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `review_id` int UNSIGNED NOT NULL,
  `reason` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `rating` int UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `review_replies`
--

CREATE TABLE `review_replies` (
  `review_replie_id` int UNSIGNED NOT NULL,
  `review_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shopping_carts`
--

CREATE TABLE `shopping_carts` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shopping_carts`
--

INSERT INTO `shopping_carts` (`id`, `user_id`, `created_at`, `updated_at`) VALUES
(4, 6, '2024-12-13 02:54:51', '2024-12-13 02:54:51'),
(5, 1, '2024-12-14 02:42:09', '2024-12-14 02:42:09'),
(6, 2, '2024-12-14 20:18:41', '2024-12-14 20:18:41');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `size_id` int UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`size_id`, `name`, `created_at`, `updated_at`) VALUES
(1, 's', '2024-12-06 02:41:40', '2024-12-06 02:41:40'),
(2, 'l', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` tinyint UNSIGNED NOT NULL DEFAULT '2',
  `is_banned` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`, `remember_token`, `address`, `phone`, `role`, `is_banned`) VALUES
(1, 'bryon92', 'stracke.libby@example.com', '2024-12-06 07:57:49', '$2y$10$JTgEO/84ijhXsMExCk9r3uFSui3CtvvwO/6duYdOLlz33Eu5Ne9Ya', '1978-07-21 19:11:52', '1991-04-12 03:39:19', 'ErmVVQzLmGTjB1qyDqqFRSvdk5jmPz2MXcmLIJXFyFk5QviiQSx3rrl2XjLw', 'New Mya', '(331) 798-9906', 2, 0),
(2, 'gmetz', 'rudy99@example.org', '2024-12-06 07:57:50', '$2y$10$JTgEO/84ijhXsMExCk9r3uFSui3CtvvwO/6duYdOLlz33Eu5Ne9Ya', '2023-01-24 00:12:37', '2024-12-14 11:00:12', 'qui', 'Rohanstad', '734-975-1850', 1, 0),
(3, 'pyost', 'francisca.jacobson@example.org', '2024-12-06 07:57:50', '$2y$10$JTgEO/84ijhXsMExCk9r3uFSui3CtvvwO/6duYdOLlz33Eu5Ne9Ya', '1991-01-04 15:06:01', '2023-05-07 06:36:21', 'quo', 'Harrisview', '(938) 583-8770', 2, 0),
(4, 'favian.upton', 'michele99@example.net', '2024-12-06 07:57:50', '$2y$10$JTgEO/84ijhXsMExCk9r3uFSui3CtvvwO/6duYdOLlz33Eu5Ne9Ya', '1996-01-06 16:49:04', '1975-01-16 14:20:57', 'et', 'Sheridantown', '1-626-526-7869', 2, 0),
(5, 'milan61', 'zpfeffer@example.org', '2024-12-06 07:57:50', '$2y$10$JTgEO/84ijhXsMExCk9r3uFSui3CtvvwO/6duYdOLlz33Eu5Ne9Ya', '1977-06-17 02:56:06', '1999-12-07 12:20:31', 'et', 'Luthertown', '845-880-6287', 2, 0),
(6, 'Lê Trung Hiếu', 'ngoisao00304@gmail.com', NULL, '$2y$10$bj2Tb1TGU51wfQR/brwdAOV8XdP1PB9DmK5beGVc3e1sKuSwyAvK.', '2024-12-09 05:54:22', '2024-12-09 05:54:22', NULL, 'Nam Tu Liem', '0988745255', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attribute_products`
--
ALTER TABLE `attribute_products`
  ADD PRIMARY KEY (`attribute_product_id`),
  ADD KEY `attribute_products_product_id_foreign` (`product_id`),
  ADD KEY `attribute_products_color_id_foreign` (`color_id`),
  ADD KEY `attribute_products_size_id_foreign` (`size_id`);

--
-- Indexes for table `banned_words`
--
ALTER TABLE `banned_words`
  ADD PRIMARY KEY (`banned_word_id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cart_items_shopping_cart_id_foreign` (`shopping_cart_id`),
  ADD KEY `cart_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`color_id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`coupon_id`),
  ADD UNIQUE KEY `coupons_code_unique` (`code`);

--
-- Indexes for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD PRIMARY KEY (`coupon_product_id`),
  ADD KEY `coupon_product_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD PRIMARY KEY (`coupon_user_id`),
  ADD KEY `coupon_user_coupon_id_foreign` (`coupon_id`),
  ADD KEY `coupon_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`customer_id`),
  ADD KEY `customers_user_id_foreign` (`user_id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`employee_id`),
  ADD KEY `employees_user_id_foreign` (`user_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`like_id`),
  ADD KEY `likes_user_id_foreign` (`user_id`),
  ADD KEY `likes_review_id_foreign` (`review_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`),
  ADD KEY `order_items_color_id_foreign` (`color_id`),
  ADD KEY `order_items_size_id_foreign` (`size_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

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
  ADD PRIMARY KEY (`product_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`),
  ADD KEY `products_product_category_id_foreign` (`product_category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`product_image_id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`),
  ADD KEY `product_images_color_id_foreign` (`color_id`);

--
-- Indexes for table `product_views`
--
ALTER TABLE `product_views`
  ADD PRIMARY KEY (`product_view_id`),
  ADD KEY `product_views_product_id_foreign` (`product_id`),
  ADD KEY `product_views_user_id_foreign` (`user_id`);

--
-- Indexes for table `prom_pers`
--
ALTER TABLE `prom_pers`
  ADD PRIMARY KEY (`prom_per_id`),
  ADD UNIQUE KEY `prom_pers_code_unique` (`code`);

--
-- Indexes for table `prom_per_product`
--
ALTER TABLE `prom_per_product`
  ADD PRIMARY KEY (`prom_per_product_id`),
  ADD KEY `prom_per_product_prom_per_id_foreign` (`prom_per_id`),
  ADD KEY `prom_per_product_product_id_foreign` (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`),
  ADD KEY `reports_user_id_foreign` (`user_id`),
  ADD KEY `reports_review_id_foreign` (`review_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `reviews_product_id_foreign` (`product_id`),
  ADD KEY `reviews_user_id_foreign` (`user_id`);

--
-- Indexes for table `review_replies`
--
ALTER TABLE `review_replies`
  ADD PRIMARY KEY (`review_replie_id`),
  ADD KEY `review_replies_review_id_foreign` (`review_id`),
  ADD KEY `review_replies_user_id_foreign` (`user_id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_user_id_foreign` (`user_id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`size_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attribute_products`
--
ALTER TABLE `attribute_products`
  MODIFY `attribute_product_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT for table `banned_words`
--
ALTER TABLE `banned_words`
  MODIFY `banned_word_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=193;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `color_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `coupon_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `coupon_product`
--
ALTER TABLE `coupon_product`
  MODIFY `coupon_product_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `coupon_user`
--
ALTER TABLE `coupon_user`
  MODIFY `coupon_user_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `customer_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `employee_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `like_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=270;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=155;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `product_image_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `product_views`
--
ALTER TABLE `product_views`
  MODIFY `product_view_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prom_pers`
--
ALTER TABLE `prom_pers`
  MODIFY `prom_per_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prom_per_product`
--
ALTER TABLE `prom_per_product`
  MODIFY `prom_per_product_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `review_replies`
--
ALTER TABLE `review_replies`
  MODIFY `review_replie_id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `size_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_products`
--
ALTER TABLE `attribute_products`
  ADD CONSTRAINT `attribute_products_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_products_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_shopping_cart_id_foreign` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_carts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_product`
--
ALTER TABLE `coupon_product`
  ADD CONSTRAINT `coupon_product_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `coupon_user`
--
ALTER TABLE `coupon_user`
  ADD CONSTRAINT `coupon_user_coupon_id_foreign` FOREIGN KEY (`coupon_id`) REFERENCES `coupons` (`coupon_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `coupon_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `customers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `likes`
--
ALTER TABLE `likes`
  ADD CONSTRAINT `likes_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `likes_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_size_id_foreign` FOREIGN KEY (`size_id`) REFERENCES `sizes` (`size_id`) ON DELETE SET NULL;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`brand_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_product_category_id_foreign` FOREIGN KEY (`product_category_id`) REFERENCES `categories` (`category_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_color_id_foreign` FOREIGN KEY (`color_id`) REFERENCES `colors` (`color_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `product_views`
--
ALTER TABLE `product_views`
  ADD CONSTRAINT `product_views_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_views_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `prom_per_product`
--
ALTER TABLE `prom_per_product`
  ADD CONSTRAINT `prom_per_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `prom_per_product_prom_per_id_foreign` FOREIGN KEY (`prom_per_id`) REFERENCES `prom_pers` (`prom_per_id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reports_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `reviews_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `review_replies`
--
ALTER TABLE `review_replies`
  ADD CONSTRAINT `review_replies_review_id_foreign` FOREIGN KEY (`review_id`) REFERENCES `reviews` (`review_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `review_replies_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
