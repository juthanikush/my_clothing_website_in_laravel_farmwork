-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2021 at 09:43 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_ecom`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `email`, `password`, `created_at`, `updated_at`) VALUES
(1, 'juthanikush@gmail.com', 'kush', '2021-03-20 02:16:21', '2021-03-20 02:16:21');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_home` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `name`, `image`, `status`, `is_home`, `created_at`, `updated_at`) VALUES
(3, 'honda', '45559.png', 1, 1, '2021-03-25 07:36:33', '2021-04-03 08:18:29'),
(6, 'Maruti', '62611.png', 1, 1, '2021-04-03 08:18:17', '2021-04-03 08:18:17'),
(7, 'dgdd', '63369.png', 1, 1, '2021-04-03 08:18:45', '2021-04-03 08:18:45');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `user_type` enum('Reg','Not-Reg') NOT NULL,
  `qty` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `parent_categories_id` int(11) NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_home` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`, `category_slug`, `parent_categories_id`, `category_image`, `is_home`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Man', 'man', 0, '1617365778.jpg', 1, 1, '2021-03-23 01:25:33', '2021-04-02 06:46:18'),
(3, 'Sports', 'sports', 1, '1617365825.jpg', 1, 1, '2021-03-23 02:23:09', '2021-04-02 06:47:05'),
(5, 'Woman', 'woman', 0, '1617365815.jpg', 0, 1, '2021-03-30 02:12:44', '2021-04-07 06:29:08'),
(6, 'Kids', 'kids', 0, '1617365764.jpg', 1, 1, '2021-04-02 06:17:28', '2021-04-02 06:46:04');

-- --------------------------------------------------------

--
-- Table structure for table `colors`
--

CREATE TABLE `colors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `colors`
--

INSERT INTO `colors` (`id`, `color`, `status`, `created_at`, `updated_at`) VALUES
(1, 'red', 1, '2021-03-20 09:45:42', '2021-03-24 03:47:31'),
(2, 'black', 1, '2021-03-20 09:45:55', '2021-03-24 08:19:32'),
(3, 'yellow', 1, '2021-03-24 08:19:30', '2021-03-24 08:19:30');

-- --------------------------------------------------------

--
-- Table structure for table `coupons`
--

CREATE TABLE `coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('Value','Per') COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_order_amt` int(11) NOT NULL,
  `is_one_time` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `coupons`
--

INSERT INTO `coupons` (`id`, `title`, `code`, `value`, `type`, `min_order_amt`, `is_one_time`, `status`, `created_at`, `updated_at`) VALUES
(2, 'New Coupon', 'New', '5', 'Per', 500, 0, 1, '2021-03-26 06:30:52', '2021-03-26 06:31:13'),
(3, 'New Coupon', 'KUSH', '500', 'Value', 100, 0, 1, '2021-05-11 04:56:45', '2021-05-11 05:19:27');

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `zip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gstin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `is_verify` int(11) NOT NULL,
  `rand_id` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_forgot_password` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`id`, `name`, `email`, `mobile`, `password`, `address`, `city`, `state`, `zip`, `company`, `gstin`, `status`, `is_verify`, `rand_id`, `is_forgot_password`, `created_at`, `updated_at`) VALUES
(2, 'KUSH  JUTHNAI', 'juthanikush@gmail.com', '9427368831', 'eyJpdiI6IjFxakZVMW1DUit5VE5sN1k3R1dMZlE9PSIsInZhbHVlIjoiMEZRWk9hbVk4b2gxVVNvelFpTzZXUT09IiwibWFjIjoiMTBjOWQ5MTE5ODRmNDJmNzQxMDlkYzIxMTgxMjU5M2I2MzM5NzBlYzNlNDJiNTIyODczOWFmYWJmMjg0NjUzNyJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '', 0, '2021-05-06 02:46:37', '2021-05-06 02:46:37'),
(3, 'alok', 'abc@gmail.com', '7845123695', 'eyJpdiI6InFYZ05qamYveklEeWRmNmpDYmVxWWc9PSIsInZhbHVlIjoiZFlLbUgycFdsVWdrU0kwOTdqa25kQT09IiwibWFjIjoiMTdmNGQyMjgwOGRlZTM4M2U4NDQzMjhhZTZkYzI3NDllNjVmMWI0NDFiNGQ4MjM4ZTM4ZWVjYzA0ZTY5Mjg3NCJ9', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '299688853', 0, '2021-05-14 21:00:03', '2021-05-14 21:00:03'),
(4, 'milan', 'milan@gmail.com', '7845123777', 'eyJpdiI6Imt4a1RCR3l5NWRhY1MxVWwzN2NKQnc9PSIsInZhbHVlIjoiYzJ6L2pyNWk1R0c2WTFLNVc5b295Zz09IiwibWFjIjoiZWRmMmI5ZDAxNzg0MjM5MTZkMTVhMzIyM2FjNmVjMGNmMzRiMzA5ODc1NmY3OTM0MTI4MjJlOWZkN2VlZWJkMiJ9', 'test2', 'rajkot', 'Gujarat', '360001', NULL, NULL, 1, 1, '174300295', 0, '2021-05-14 21:06:33', '2021-05-14 21:06:33'),
(5, 'milan pala', 'juthanikush18@gmail.com', '7845128954', 'eyJpdiI6IkEzU0pjV3VUdVJBRyt2Yzc0ZmF6Snc9PSIsInZhbHVlIjoiUG96QVVHaEdxTVZQZmVZRmhicUpZZz09IiwibWFjIjoiZTc2Y2VlNDNjMmY0N2UyMjIzN2ExZjk2MDYyODg0ZWVlM2NjY2M1ZTRlMTA3YmFmMmI5OGQzMjQzMjIxMTAwMyJ9', 'test2', 'rajkot', 'Gujarat', '360001', NULL, NULL, 1, 1, '721401032', 0, '2021-05-14 21:23:45', '2021-05-14 21:23:45');

-- --------------------------------------------------------

--
-- Table structure for table `home_banners`
--

CREATE TABLE `home_banners` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `btn_txt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `btn_link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `home_banners`
--

INSERT INTO `home_banners` (`id`, `image`, `btn_txt`, `btn_link`, `status`, `created_at`, `updated_at`) VALUES
(4, '1617543558.jpg', 'Shop Now', 'https://www.google.com/', 1, '2021-04-04 08:09:18', '2021-04-04 08:36:08'),
(5, '1617544804.jpg', NULL, NULL, 1, '2021-04-04 08:30:04', '2021-04-04 08:30:04'),
(6, '1617544874.jpg', NULL, NULL, 1, '2021-04-04 08:31:14', '2021-04-04 08:31:14');

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
(1, '2021_03_19_080752_create_admins_table', 1),
(2, '2021_03_19_110548_create_categories_table', 2),
(3, '2021_03_20_085422_create_coupons_table', 3),
(4, '2021_03_20_123815_create_sizes_table', 4),
(5, '2021_03_20_143325_create_colors_table', 5),
(6, '2021_03_23_070024_create_products_table', 6),
(7, '2021_03_25_120921_create_brands_table', 7),
(8, '2021_03_26_124710_create_taxes_table', 8),
(9, '2021_03_30_025129_create_customers_table', 9),
(10, '2021_04_04_121103_create_home_banners_table', 10);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `customers_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `address` varchar(500) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `pincode` varchar(25) NOT NULL,
  `coupon_code` varchar(100) DEFAULT NULL,
  `coupon_value` int(11) DEFAULT NULL,
  `order_status` int(11) NOT NULL,
  `payment_type` enum('COD','Gateway') NOT NULL,
  `payment_status` varchar(50) NOT NULL,
  `payment_id` varchar(50) DEFAULT NULL,
  `txn_id` varchar(100) DEFAULT NULL,
  `total_amt` int(11) NOT NULL,
  `track_details` text DEFAULT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customers_id`, `name`, `email`, `mobile`, `address`, `city`, `state`, `pincode`, `coupon_code`, `coupon_value`, `order_status`, `payment_type`, `payment_status`, `payment_id`, `txn_id`, `total_amt`, `track_details`, `added_on`) VALUES
(1, 2, 'milan', 'milan@gmail.com', '7845123777', 'test2', 'rajkot', 'Gujarat', '360001', NULL, 0, 1, 'COD', '3', NULL, NULL, 3725, 'on the way', '2021-05-16 07:13:42'),
(2, 2, 'milan pala', 'juthanikush18@gmail.com', '7845128954', 'test2', 'rajkot', 'Gujarat', '360001', NULL, 0, 1, 'Gateway', 'Success', 'MOJO1516E05A09043831', 'dbe8eed6e41c40ea9169c6bca654a20a', 1322, NULL, '2021-05-16 07:14:14'),
(3, 2, 'KUSH  JUTHNAI', 'juthanikush@gmail.com', '9427368831', 'a', 'b', 'c', '3', 'kush', 500, 2, 'COD', 'Pending', NULL, NULL, 3325, NULL, '2021-05-17 06:05:40'),
(4, 2, 'KUSH  JUTHNAI', 'juthanikush@gmail.com', '9427368831', 'a', 'b', 'c', '3', NULL, 0, 1, 'COD', 'Pending', NULL, NULL, 500, NULL, '2021-05-17 06:59:48'),
(5, 2, 'KUSH', 'juthanikush@gmail.com', '9427368831', 'jut', 'Rajkot', 'Gujarat', '360001', NULL, 0, 1, 'Gateway', 'Pending', NULL, '3c4eba639e904bec8a502e3a136e7a1c', 500, NULL, '2021-06-06 07:56:30'),
(6, 2, 'kush', 'juthanikush@gmail.com', '9427368831', 'juthani', 'Rajkot', '21', 'pla', NULL, 0, 1, 'COD', 'Pending', NULL, NULL, 1525, NULL, '2021-06-08 06:55:56'),
(7, 2, 'milan', 'milan@gmail.com', '7845123777', 'test2', 'rajkot', 'Gujarat', '360001', 'kush', 500, 1, 'Gateway', 'Success', 'MOJO1608T05A07422313', '3a52081377a94a92b89268675aa6ee59', 1300, NULL, '2021-06-08 08:09:23');

-- --------------------------------------------------------

--
-- Table structure for table `orders_detalis`
--

CREATE TABLE `orders_detalis` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_attr_id` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_detalis`
--

INSERT INTO `orders_detalis` (`id`, `order_id`, `product_id`, `product_attr_id`, `price`, `qty`) VALUES
(56, 1, 11, 34, 500, 7),
(57, 2, 4, 1, 1300, 1),
(58, 2, 5, 27, 22, 1),
(59, 3, 11, 33, 500, 1),
(60, 3, 4, 1, 1300, 2),
(61, 3, 10, 31, 225, 1),
(62, 4, 11, 33, 500, 1),
(63, 5, 11, 33, 500, 1),
(64, 6, 4, 1, 1300, 1),
(65, 6, 10, 31, 225, 1),
(66, 7, 4, 1, 1300, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders_status`
--

CREATE TABLE `orders_status` (
  `id` int(11) NOT NULL,
  `orders_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders_status`
--

INSERT INTO `orders_status` (`id`, `orders_status`) VALUES
(1, 'Placed'),
(2, 'On The Way'),
(3, 'Delivered');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `keywords` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `technical_specification` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `uses` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `lead_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tax_id` int(255) NOT NULL,
  `is_promo` int(11) NOT NULL,
  `is_featured` int(11) NOT NULL,
  `is_discounted` int(11) NOT NULL,
  `is_tranding` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `image`, `slug`, `brand`, `model`, `short_desc`, `desc`, `keywords`, `technical_specification`, `uses`, `warranty`, `lead_time`, `tax_id`, `is_promo`, `is_featured`, `is_discounted`, `is_tranding`, `status`, `created_at`, `updated_at`) VALUES
(4, 1, 'Shirt', '1617455474.png', 'Shirt', '3', 'Shirt', '<p>Shop from a wide range of T-Shirt from Scott International . Perfect for your everyday use, you could pair it with a stylish pair of Jeans or Trousers complete the look.</p>', '<p>Shop from a wide range of T-Shirt from Scott International . Perfect for your everyday use, you could pair it with a stylish pair of Jeans or Trousers complete the look.Shop from a wide range of T-Shirt from Scott International . Perfect for your everyday use, you could pair it with a stylish pair of Jeans or Trousers complete the look.</p>', 'shirt', '<p>clothe</p>', 'clothe', '2 years', '2-3 day', 1, 0, 1, 0, 0, 1, '2021-03-23 06:46:25', '2021-04-06 02:15:40'),
(5, 5, 'test', '1617455499.png', 'ASP.NET t', '3', '5', '<p>677</p>', '<p>7</p>', '8', '<p>9</p>', '9', '12', '2-3 day', 1, 1, 1, 0, 1, 1, '2021-03-25 22:29:45', '2021-04-24 01:01:51'),
(6, 5, 'test', '1617455487.png', 'about.us', '3', '5', '<p>test</p>', '<p>test</p>', 'keyword', '<p>teec</p>', 'kushs', '33', NULL, 1, 0, 0, 0, 0, 1, '2021-03-25 23:07:44', '2021-04-24 01:01:44'),
(10, 1, 'test', '1617369876.png', 'test1', '3', '5', '<p>test</p>', '<p>test</p>', 'test', '<p>teat</p>', 'test', 'test', 'test', 1, 0, 0, 0, 0, 1, '2021-04-02 07:54:36', '2021-04-02 07:54:36'),
(11, 1, 'Men\'s Solid Regular Polo Shirt', '1619249681.jpg', 'Men\'s Solid Regular Polo Shirt', '6', 'Shirt', '<p>Care Instructions: Machine wash cold with similar colors, gentle cycle, only non-chlorine bleach (when needed), tumble dry low, warm iron if needed, do not iron on print</p>', '<ul>\r\n	<li>Care Instructions: Machine wash cold with similar colors, gentle cycle, only non-chlorine bleach (when needed), tumble dry low, warm iron if needed, do not iron on print</li>\r\n	<li>Fit Type: Regular Fit</li>\r\n	<li>Material - 60% Cotton and 40% Polyester</li>\r\n	<li>Fit Type - Regular fit; Half sleeve Polo T-Shirt</li>\r\n	<li>Pattern - Solid</li>\r\n	<li>Polo with classic collar</li>\r\n	<li>Hand wash</li>\r\n</ul>', 'Polo Shirt', '<p>cloath</p>', 'fashionable', '5 day', '2-3 day', 1, 1, 1, 1, 1, 1, '2021-04-07 07:12:33', '2021-04-24 02:04:41');

-- --------------------------------------------------------

--
-- Table structure for table `product_attr`
--

CREATE TABLE `product_attr` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `sku` varchar(255) NOT NULL,
  `image_attr` varchar(255) DEFAULT NULL,
  `mrp` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `qty` int(11) NOT NULL,
  `size_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_attr`
--

INSERT INTO `product_attr` (`id`, `product_id`, `sku`, `image_attr`, `mrp`, `price`, `qty`, `size_id`, `color_id`) VALUES
(1, 4, '1', '', 1200, 1300, 100, 1, 2),
(27, 5, '543', '128397364.png', 33332, 22, 2, 2, 2),
(28, 6, '552', '926300998.png', 2, 8, 748, 1, 2),
(30, 6, '2332', '205767559.jpg', 2050, 11, 11, 0, 0),
(31, 10, '23321', '373887600.png', 222, 225, 15, 1, 3),
(32, 10, '23322', '262475953.jpg', 500, 450, 10, 2, 2),
(33, 11, '18', '904852941.jpg', 450, 500, 10, 1, 1),
(34, 11, '19', '862082431.jpg', 450, 500, 10, 2, 2),
(35, 11, '20', '658650667.jpg', 450, 500, 11, 3, 3),
(36, 10, '14526', '290426683.png', 225, 225, 3, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `images` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `images`) VALUES
(1, 4, '196058970.png'),
(3, 5, '537551894.png'),
(4, 6, '425235704.png'),
(11, 11, '879067140.jpg'),
(12, 11, '672849511.jpg'),
(13, 11, '494699889.jpg'),
(14, 11, '213794693.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `product_review`
--

CREATE TABLE `product_review` (
  `id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `rating` varchar(15) NOT NULL,
  `review` text NOT NULL,
  `status` int(11) NOT NULL,
  `added_on` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_review`
--

INSERT INTO `product_review` (`id`, `customer_id`, `product_id`, `rating`, `review`, `status`, `added_on`) VALUES
(1, 2, 11, 'fnatastic', 'i like', 0, '2021-05-22 12:52:11'),
(2, 2, 11, 'good', 'hello', 1, '2021-05-22 01:05:50');

-- --------------------------------------------------------

--
-- Table structure for table `sizes`
--

CREATE TABLE `sizes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `size` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sizes`
--

INSERT INTO `sizes` (`id`, `size`, `status`, `created_at`, `updated_at`) VALUES
(1, 'XL', 1, '2021-03-24 03:46:01', '2021-03-24 03:46:01'),
(2, 'XLL', 1, '2021-03-24 08:18:07', '2021-03-24 08:18:07'),
(3, 'XLLL', 1, '2021-03-24 08:18:12', '2021-03-24 08:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `taxs`
--

CREATE TABLE `taxs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tax_desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tax_value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `taxs`
--

INSERT INTO `taxs` (`id`, `tax_desc`, `tax_value`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GST 18%', '20', 1, '2021-03-26 08:17:33', '2021-03-26 08:18:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `coupons`
--
ALTER TABLE `coupons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `home_banners`
--
ALTER TABLE `home_banners`
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
-- Indexes for table `orders_detalis`
--
ALTER TABLE `orders_detalis`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders_status`
--
ALTER TABLE `orders_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_attr`
--
ALTER TABLE `product_attr`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_review`
--
ALTER TABLE `product_review`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `taxs`
--
ALTER TABLE `taxs`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `colors`
--
ALTER TABLE `colors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `coupons`
--
ALTER TABLE `coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `home_banners`
--
ALTER TABLE `home_banners`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `orders_detalis`
--
ALTER TABLE `orders_detalis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `orders_status`
--
ALTER TABLE `orders_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `product_attr`
--
ALTER TABLE `product_attr`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `product_review`
--
ALTER TABLE `product_review`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `taxs`
--
ALTER TABLE `taxs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
