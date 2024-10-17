-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 17, 2024 at 06:15 AM
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
-- Table structure for table `attributes`
--

CREATE TABLE `attributes` (
  `attribute_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attributes`
--

INSERT INTO `attributes` (`attribute_id`, `name`, `value`, `created_at`, `updated_at`) VALUES
(1, 'id', 'necessitatibus', '1973-06-15 06:41:44', '2022-09-26 12:52:35'),
(2, 'quam', 'quasi', '1971-01-01 22:33:56', '1990-11-21 16:54:16'),
(3, 'quasi', 'eum', '2004-08-20 05:42:37', '1979-05-16 10:59:59'),
(4, 'et', 'saepe', '1973-08-11 12:44:57', '1987-04-14 00:50:29'),
(5, 'consequatur', 'repellat', '2015-12-16 14:57:12', '1992-03-15 09:54:06');

-- --------------------------------------------------------

--
-- Table structure for table `attribute_products`
--

CREATE TABLE `attribute_products` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `attribute_id` int UNSIGNED NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `in_stock` int NOT NULL,
  `price` double(16,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attribute_products`
--

INSERT INTO `attribute_products` (`id`, `product_id`, `attribute_id`, `image`, `in_stock`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'https://via.placeholder.com/640x480.png/00ddcc?text=vel', 4, 22.00, '1981-05-26 08:45:12', '2009-04-17 04:31:41'),
(2, 4, 4, 'https://via.placeholder.com/640x480.png/00bbcc?text=nihil', 3, 25.70, '2003-12-17 06:29:54', '1985-12-20 02:46:25'),
(3, 2, 2, 'https://via.placeholder.com/640x480.png/00ff00?text=illum', 5, 17.30, '1983-02-23 12:57:55', '1992-12-04 09:55:12'),
(4, 4, 4, 'https://via.placeholder.com/640x480.png/00bbee?text=vel', 4, 28.30, '2006-12-16 18:14:18', '2012-11-10 00:06:22'),
(5, 2, 5, 'https://via.placeholder.com/640x480.png/002222?text=magnam', 1, 41.30, '2023-12-21 11:56:11', '2005-05-26 02:32:02');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `name`, `description`, `slug`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'modi', 'Quia voluptates incidunt temporibus earum et et. Quia ab nesciunt excepturi id excepturi sapiente. Quia est aut quia magnam cum.', 'Qui eius iste qui fugit. Provident quo et eum dolorem qui voluptatem sed. Veritatis quae tempora beatae architecto harum. Voluptatum officiis et aut aut eos quia.', 4, '1989-11-28 10:20:04', '1986-04-17 06:12:54'),
(2, 'quod', 'Itaque cupiditate quia ab est laborum. Et consequatur eveniet iusto autem ex temporibus blanditiis. Velit magnam expedita quibusdam qui expedita rerum beatae.', 'Et earum sit ut placeat aspernatur. Velit aut consequatur accusantium suscipit est eveniet alias animi. Praesentium recusandae vel cumque id. Et velit doloribus repellat amet corporis illum.', 6, '2011-07-05 17:26:43', '1970-01-12 09:50:57'),
(3, 'omnis', 'Accusantium omnis ducimus ratione commodi vel quia quaerat velit. Animi nostrum rerum quia. Voluptas officia odit voluptate voluptatum et quae. Itaque est saepe et atque tempore esse ipsam.', 'Nulla hic porro enim qui id pariatur minus. Hic sunt in libero neque. Quibusdam neque accusamus est non consequatur.', 2, '1976-10-29 01:39:58', '2002-08-27 10:48:56'),
(4, 'et', 'Ipsum qui qui suscipit molestiae soluta reprehenderit. Porro quo voluptatem sint ab reprehenderit dolore. Maiores dolorem animi vitae sed sed nostrum. Id beatae deserunt quasi modi.', 'Optio minus aliquam eum sequi. Alias nobis in vel officiis eligendi. Beatae velit est sunt et sequi omnis magnam.', 1, '1977-11-27 22:00:16', '1985-04-22 18:33:45'),
(5, 'assumenda', 'Cum sit hic aut eum consequuntur. Vel alias aut nihil aperiam veniam. Numquam nisi repellendus labore et non nemo enim.', 'Corporis eum ea animi veritatis necessitatibus est unde. Quasi labore architecto quia sequi. Et est eius et ut pariatur. Aut et consequatur dolorem quidem.', 9, '1995-06-04 02:39:53', '1990-07-11 02:07:15');

-- --------------------------------------------------------

--
-- Table structure for table `cart_items`
--

CREATE TABLE `cart_items` (
  `id` int UNSIGNED NOT NULL,
  `shopping_cart_id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart_items`
--

INSERT INTO `cart_items` (`id`, `shopping_cart_id`, `product_id`, `created_at`, `updated_at`) VALUES
(1, 5, 1, '1994-02-07 00:44:16', '1973-10-31 11:40:58'),
(2, 3, 4, '2003-08-09 16:02:18', '1991-01-13 20:51:28'),
(3, 3, 2, '2011-09-19 02:42:42', '1983-05-11 20:57:49'),
(4, 1, 1, '2021-09-17 16:54:41', '2014-03-18 23:31:10'),
(5, 2, 4, '1992-04-03 04:54:07', '1993-11-02 12:15:03');

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
  `is_active` tinyint NOT NULL,
  `parent_id` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `name`, `description`, `image`, `slug`, `is_active`, `parent_id`, `created_at`, `updated_at`) VALUES
(1, 'ut', 'Quam quam quam inventore exercitationem quia corporis. Vel repudiandae dolores repellat magni qui consectetur sequi. Et asperiores deleniti enim fugit. Consectetur est consequatur culpa ipsa.', 'https://via.placeholder.com/640x480.png/00ddee?text=sint', 'Dolorum assumenda accusantium soluta rerum. Quis nobis quisquam pariatur dolores quis sit. Mollitia minima perspiciatis quis modi.', 9, 5, '1983-06-01 04:08:42', '1997-02-06 16:44:13'),
(2, 'ipsum', 'Ab quia inventore consequatur rerum consequuntur expedita iste rerum. Illum cupiditate nulla similique consequatur aut id. Placeat sapiente vel beatae labore.', 'https://via.placeholder.com/640x480.png/008866?text=eum', 'Officiis id iure omnis eius reprehenderit repudiandae numquam. Fugit quia omnis rerum dolor maxime. Corporis tempore omnis officia et. Quaerat architecto veritatis sed vel.', 6, 3, '1979-08-06 00:41:53', '2022-12-18 12:58:11'),
(3, 'saepe', 'Inventore voluptas autem debitis ea et non fugit. Sed non alias qui reprehenderit id. Sit qui minima qui assumenda velit incidunt. Vel iste facere sed quia.', 'https://via.placeholder.com/640x480.png/006600?text=delectus', 'Dignissimos id eum natus ullam vel sit. Molestiae aut aspernatur vel voluptas ea recusandae tempore rerum.', 6, 1, '1973-04-16 18:21:01', '1983-11-23 11:05:39'),
(4, 'explicabo', 'Placeat necessitatibus earum quam. Illo velit aut ut optio excepturi ut. Itaque omnis accusantium at at ipsa exercitationem. Vel ipsa in excepturi quos quod.', 'https://via.placeholder.com/640x480.png/00ee88?text=deleniti', 'Est ipsa et dolor nesciunt voluptatem assumenda. Sint accusantium temporibus nemo sunt a.', 6, 3, '2018-10-13 11:52:51', '2008-04-30 13:46:11'),
(5, 'architecto', 'Temporibus dolor eius eos eum. Est voluptatibus dolores et eum odio voluptates ut. Sed ex iure itaque.', 'https://via.placeholder.com/640x480.png/005500?text=non', 'Veniam exercitationem vel occaecati doloremque ad. Qui molestiae quis qui earum consectetur et sed. Sed enim aut incidunt quia quaerat. Dolorum quos dolorem veniam qui aspernatur illum qui.', 3, 6, '2020-06-24 21:04:18', '1996-05-27 05:54:18');

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
(31, '2014_10_12_000000_create_users_table', 1),
(32, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(33, '2019_08_19_000000_create_failed_jobs_table', 1),
(34, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(35, '2024_10_16_151934_create_attributes_table', 1),
(36, '2024_10_16_154810_create_brands_table', 1),
(37, '2024_10_16_154830_create_categories_table', 1),
(38, '2024_10_16_154942_create_products_table', 1),
(39, '2024_10_16_155029_create_attribute_products_table', 1),
(40, '2024_10_16_155112_create_product_images_table', 1),
(41, '2024_10_16_163033_create_shopping_carts_table', 1),
(42, '2024_10_16_163053_create_cart_items_table', 1),
(43, '2024_10_16_163854_create_orders_table', 1),
(44, '2024_10_16_163903_create_order_items_table', 1),
(45, '2024_10_16_170920_create_payments_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `order_date` timestamp NOT NULL,
  `status` enum('pending','processing','shipped','delivered','cancelled','completed') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `invoice_date` timestamp NOT NULL,
  `payment_status` enum('pending','paid','failed','refunded','cancelled','authorized') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'pending',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `order_date`, `status`, `total`, `invoice_date`, `payment_status`, `created_at`, `updated_at`) VALUES
(1, 4, '1998-12-30 06:04:34', 'completed', '13.80', '1995-03-21 06:30:01', 'paid', '2023-03-03 06:04:49', '1971-08-15 18:57:42'),
(2, 5, '2022-05-10 18:17:38', 'completed', '38.90', '1970-11-19 21:03:25', 'paid', '1983-07-21 06:14:18', '1984-04-23 01:18:18'),
(3, 4, '2003-09-27 11:33:28', 'processing', '25.30', '1992-06-26 16:36:13', 'paid', '1989-06-20 05:34:14', '2012-06-18 07:58:40'),
(4, 1, '2019-06-22 14:36:15', 'cancelled', '27.90', '2013-12-01 04:49:06', 'paid', '1974-06-11 04:46:54', '2003-11-30 19:15:50'),
(5, 3, '2000-01-19 09:54:24', 'pending', '44.30', '1977-08-05 22:24:45', 'refunded', '2002-07-27 07:36:37', '1997-11-04 05:23:01');

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(1, 4, 4, 9, '35.20', '1999-02-02 16:46:02', '2008-11-21 08:00:25'),
(2, 1, 5, 8, '39.60', '1994-03-12 19:56:49', '1994-02-25 23:04:47'),
(3, 5, 3, 9, '8.90', '2003-11-29 19:24:53', '1979-02-17 03:09:48'),
(4, 3, 3, 9, '2.80', '1991-01-03 14:26:47', '1999-12-08 17:25:12'),
(5, 5, 5, 4, '49.80', '2006-07-09 22:15:49', '2024-01-09 18:51:59');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `order_id`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, '28.60', 'Ut ducimus expedita iure corporis. Et aut consectetur est aut eum et harum itaque. Soluta culpa qui autem eligendi tempora qui. Dolores aut consectetur nulla rem.', 'pending', '1982-12-12 00:26:55', '2013-05-24 17:16:48'),
(2, 4, '22.40', 'Reprehenderit voluptatibus et soluta aspernatur et nostrum voluptates. Ab non dolorum assumenda rerum veniam veritatis.', 'pending', '1990-08-02 14:00:17', '1977-08-15 00:49:58'),
(3, 3, '45.90', 'Eos ea atque et laborum consectetur ipsam molestias. Ut est et architecto beatae ut maxime consequuntur. Pariatur enim ipsum molestias iusto qui nobis. Dolores aspernatur et quos enim.', 'completed', '2017-08-23 09:37:02', '2010-04-10 08:54:21'),
(4, 4, '24.60', 'Modi ut perferendis occaecati magni. Voluptatibus tenetur beatae et dolore esse. Maxime ea et architecto facilis dolorem ad. Qui numquam magni reprehenderit sint soluta doloremque sit porro.', 'failed', '1989-11-26 11:46:41', '2020-05-03 11:20:56'),
(5, 1, '45.30', 'Maiores quidem voluptatibus ipsam ipsum qui nobis. Amet vel cum et ex maxime eum autem. Aperiam dolores temporibus nostrum. Sed et occaecati ipsa. Quidem hic voluptatibus doloremque voluptatum.', 'failed', '2012-09-18 12:33:46', '2001-06-28 16:04:54');

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
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `sku` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitle` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_active` tinyint NOT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`product_id`, `brand_id`, `product_category_id`, `name`, `description`, `sku`, `subtitle`, `slug`, `is_active`, `deleted_at`, `created_at`, `updated_at`) VALUES
(1, 4, 2, 'in', 'Magni quod aspernatur nesciunt dolore. Ab soluta expedita aut et harum soluta. Assumenda quasi similique perferendis facilis nesciunt sapiente error.', 'Impedit asperiores illum exercitationem. Dolores atque aut impedit cupiditate vel voluptas. Nemo velit vel consectetur hic. Voluptate facere deleniti officia ipsam.', 'At officiis reprehenderit et accusamus nisi odit doloremque. Ullam ut excepturi vel sed aut ducimus qui. Cum ducimus animi commodi saepe magni odit accusantium. Perferendis aut quo rerum alias ut.', 'Quisquam provident aperiam laborum sit qui et praesentium. Ipsa accusantium dolores voluptas adipisci voluptas inventore reprehenderit. Molestias qui tenetur perferendis natus ea sapiente.', 8, NULL, '1974-03-03 05:26:21', '1997-11-03 21:27:46'),
(2, 4, 4, 'et', 'Repudiandae magnam sunt voluptas porro magnam dolores. Delectus non culpa sint sunt veniam autem. Est ullam nulla eos fugiat veniam consequatur. Iste quas libero eum optio laudantium suscipit.', 'Dolor amet cum dolores. Rem nobis laudantium aut facere modi.', 'Dolor nihil ut unde blanditiis. Dolorem eligendi consequatur labore laudantium et. Et numquam suscipit suscipit quia neque.', 'Distinctio explicabo hic corrupti fugiat temporibus quaerat. At officiis ducimus consequatur molestiae voluptatem saepe voluptatem. Velit ut dolorum sint vero.', 7, NULL, '2014-07-05 16:04:52', '2006-04-08 07:57:27'),
(3, 4, 3, 'voluptas', 'Et in ipsa sint qui fugit. Adipisci in porro recusandae suscipit.', 'Quia nemo omnis a nulla consequatur molestias illum. Soluta facere quis est et saepe autem. Numquam qui accusamus adipisci magni.', 'Culpa nihil voluptas cupiditate eaque. Reprehenderit tempore sit iste nihil. Molestias porro nostrum distinctio aut.', 'Nihil qui at voluptas velit officiis distinctio. Quibusdam harum facilis praesentium repellat nisi saepe et quod. Voluptas totam et iusto vitae voluptatem ullam expedita rem.', 4, NULL, '1996-07-08 01:24:06', '2007-01-31 01:43:50'),
(4, 5, 3, 'sequi', 'Ea molestiae aut tempora nesciunt sunt et voluptatum. Excepturi voluptatem temporibus qui delectus consequatur aliquid quia amet. Natus maiores consequatur cum similique ad impedit dolor.', 'Minima ea quis eveniet qui temporibus repudiandae. Id architecto quo amet libero esse id minima magni. Eos saepe dolores vel vel deserunt modi molestiae.', 'Quas quia eveniet doloremque quae neque unde dicta. Eligendi temporibus saepe dolorum aut. Beatae sit nulla cum quam voluptatem.', 'Veniam quod qui nisi quia eveniet architecto sit. Natus nobis est rerum ad non. Doloribus ad aut illum assumenda possimus eum.', 2, NULL, '2021-04-02 19:52:42', '1975-11-11 12:11:11'),
(5, 5, 3, 'deserunt', 'Id sunt expedita ad repellendus tempore. Rerum sequi perspiciatis iste sed. Unde aut ut iusto aut ut aliquam perspiciatis.', 'Modi dolor ab doloremque autem ut molestiae. Deserunt voluptas doloribus culpa itaque aut. Nisi sit sed tenetur ut nam doloremque laboriosam.', 'Consequatur et dolor totam fugit rerum. Magni voluptas dolorum nostrum ut quibusdam facere. Dolore error qui atque non iusto quae. Molestias ut omnis consequatur nisi laudantium aliquid magni.', 'Voluptatem expedita nam ipsam laudantium at. Quisquam maiores sed impedit at quo debitis iure. Aut facilis et ut rerum aut quae. Cupiditate commodi distinctio architecto similique quos quo non.', 5, NULL, '1970-04-09 18:55:42', '1979-06-16 02:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int UNSIGNED NOT NULL,
  `attribute_product_id` int UNSIGNED NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `attribute_product_id`, `image`, `created_at`, `updated_at`) VALUES
(1, 5, 'https://via.placeholder.com/640x480.png/007700?text=dolores', '2023-03-21 15:16:20', '1986-12-11 02:59:56'),
(2, 1, 'https://via.placeholder.com/640x480.png/007700?text=qui', '2003-01-29 23:46:29', '2019-12-03 19:44:04'),
(3, 5, 'https://via.placeholder.com/640x480.png/00bb77?text=dicta', '2005-04-10 13:01:28', '2010-07-07 16:00:58'),
(4, 3, 'https://via.placeholder.com/640x480.png/006644?text=recusandae', '2018-08-11 20:00:25', '1985-12-15 22:05:24'),
(5, 5, 'https://via.placeholder.com/640x480.png/0066ff?text=consequatur', '1977-12-11 03:49:16', '2019-03-11 00:32:22'),
(6, 3, 'https://via.placeholder.com/640x480.png/005533?text=aliquam', '1982-01-26 17:08:14', '1979-06-08 00:34:23'),
(7, 3, 'https://via.placeholder.com/640x480.png/003366?text=id', '2008-10-26 02:12:33', '2011-10-02 15:24:21'),
(8, 3, 'https://via.placeholder.com/640x480.png/005500?text=voluptatem', '2021-01-24 10:10:26', '2019-08-20 06:33:19'),
(9, 4, 'https://via.placeholder.com/640x480.png/00bb55?text=fugit', '1984-03-24 12:59:33', '2023-12-25 02:10:22'),
(10, 5, 'https://via.placeholder.com/640x480.png/00ff44?text=modi', '2004-02-09 04:06:33', '1982-04-10 03:56:11'),
(11, 4, 'https://via.placeholder.com/640x480.png/005522?text=et', '1983-06-08 07:15:46', '2000-05-03 18:12:19'),
(12, 1, 'https://via.placeholder.com/640x480.png/00cc44?text=magni', '1972-04-30 06:19:54', '1997-08-02 00:25:13'),
(13, 4, 'https://via.placeholder.com/640x480.png/00ee55?text=velit', '2022-10-21 21:39:27', '1970-08-30 16:13:26'),
(14, 2, 'https://via.placeholder.com/640x480.png/002222?text=quam', '1993-09-16 19:43:11', '1977-04-23 03:18:01'),
(15, 2, 'https://via.placeholder.com/640x480.png/000077?text=ad', '1993-09-25 00:42:07', '2015-05-24 19:50:05'),
(16, 1, 'https://via.placeholder.com/640x480.png/00ddff?text=mollitia', '2017-11-12 13:32:11', '1970-01-20 23:14:46'),
(17, 3, 'https://via.placeholder.com/640x480.png/001199?text=repudiandae', '1972-07-30 15:26:53', '2004-06-18 08:16:53'),
(18, 3, 'https://via.placeholder.com/640x480.png/0044ee?text=repellat', '2021-03-03 16:21:28', '1990-07-24 17:43:38'),
(19, 2, 'https://via.placeholder.com/640x480.png/00ddaa?text=quia', '1978-10-16 21:12:54', '1975-04-12 06:01:01'),
(20, 3, 'https://via.placeholder.com/640x480.png/001155?text=iusto', '1970-10-28 05:31:03', '1974-03-21 07:46:23');

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
(1, 1, '1970-11-02 02:25:25', '1990-08-22 08:35:09'),
(2, 5, '1976-09-25 04:15:55', '2024-09-27 01:44:24'),
(3, 2, '1995-11-14 11:55:38', '1991-07-13 08:16:49'),
(4, 1, '1970-10-01 14:26:17', '2001-09-28 00:33:32'),
(5, 3, '2007-09-02 05:22:44', '1992-06-24 23:57:30');

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
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `email_verified_at`, `password`, `created_at`, `updated_at`, `remember_token`, `address`, `phone`) VALUES
(1, 'ledner.tatyana', 'vturner@example.net', '2024-10-16 22:56:24', '$2y$10$nSgG0na0VuV/ezjvRQE6ReTLGcBfRC80zbnKuHuU/uGvsy/rmE2Zu', '1990-02-03 09:25:43', '2009-08-13 04:16:01', 'laboriosam', 'Kennastad', '458-606-1402'),
(2, 'lehner.hertha', 'spencer.destinee@example.net', '2024-10-16 22:56:24', '$2y$10$nSgG0na0VuV/ezjvRQE6ReTLGcBfRC80zbnKuHuU/uGvsy/rmE2Zu', '2003-11-19 11:57:30', '2005-03-10 00:15:12', 'quibusdam', 'Cydneybury', '(361) 673-5345'),
(3, 'garrison.altenwerth', 'larkin.ofelia@example.com', '2024-10-16 22:56:24', '$2y$10$nSgG0na0VuV/ezjvRQE6ReTLGcBfRC80zbnKuHuU/uGvsy/rmE2Zu', '2002-06-18 22:00:13', '1991-06-04 05:56:41', 'cum', 'New Gabeton', '+1.229.562.0849'),
(4, 'rmckenzie', 'uheathcote@example.net', '2024-10-16 22:56:24', '$2y$10$nSgG0na0VuV/ezjvRQE6ReTLGcBfRC80zbnKuHuU/uGvsy/rmE2Zu', '2019-11-28 13:07:20', '1970-02-21 15:45:50', 'fuga', 'New Gudrun', '1-567-763-4482'),
(5, 'jean73', 'wolf.kailyn@example.com', '2024-10-16 22:56:24', '$2y$10$nSgG0na0VuV/ezjvRQE6ReTLGcBfRC80zbnKuHuU/uGvsy/rmE2Zu', '2017-03-22 19:58:04', '1996-06-09 19:03:24', 'aut', 'West Clarissa', '913-203-2797');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attributes`
--
ALTER TABLE `attributes`
  ADD PRIMARY KEY (`attribute_id`);

--
-- Indexes for table `attribute_products`
--
ALTER TABLE `attribute_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `attribute_products_product_id_foreign` (`product_id`),
  ADD KEY `attribute_products_attribute_id_foreign` (`attribute_id`);

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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
  ADD KEY `order_items_product_id_foreign` (`product_id`);

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
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_attribute_product_id_foreign` (`attribute_product_id`);

--
-- Indexes for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shopping_carts_user_id_foreign` (`user_id`);

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
-- AUTO_INCREMENT for table `attributes`
--
ALTER TABLE `attributes`
  MODIFY `attribute_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `attribute_products`
--
ALTER TABLE `attribute_products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `cart_items`
--
ALTER TABLE `cart_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `product_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_products`
--
ALTER TABLE `attribute_products`
  ADD CONSTRAINT `attribute_products_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`attribute_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_products_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

--
-- Constraints for table `cart_items`
--
ALTER TABLE `cart_items`
  ADD CONSTRAINT `cart_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_items_shopping_cart_id_foreign` FOREIGN KEY (`shopping_cart_id`) REFERENCES `shopping_carts` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`product_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `product_images_attribute_product_id_foreign` FOREIGN KEY (`attribute_product_id`) REFERENCES `attribute_products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `shopping_carts`
--
ALTER TABLE `shopping_carts`
  ADD CONSTRAINT `shopping_carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
