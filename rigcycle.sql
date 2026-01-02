-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Des 2025 pada 18.25
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rigcycle`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `carts`
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
-- Dumping data untuk tabel `carts`
--

INSERT INTO `carts` (`id`, `user_id`, `product_id`, `quantity`, `created_at`, `updated_at`) VALUES
(6, 6, 51, 3, '2025-12-14 16:55:00', '2025-12-14 16:55:00'),
(13, 9, 52, 1, '2025-12-15 04:52:49', '2025-12-16 07:58:00'),
(14, 9, 51, 1, '2025-12-15 05:15:20', '2025-12-16 07:57:53');

-- --------------------------------------------------------

--
-- Struktur dari tabel `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `icon`, `created_at`, `updated_at`) VALUES
(1, 'Processors (CPU)', 'processors-cpu', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(2, 'Graphics Cards (GPU)', 'graphics-cards-gpu', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(3, 'Motherboards', 'motherboards', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(4, 'Memory (RAM)', 'memory-ram', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(5, 'Storage (SSD/HDD)', 'storage-ssdhdd', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(6, 'Power Supply (PSU)', 'power-supply-psu', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(7, 'PC Cases', 'pc-cases', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(8, 'Cooling & Fans', 'cooling-fans', NULL, '2025-12-14 15:05:40', '2025-12-14 15:05:40');

-- --------------------------------------------------------

--
-- Struktur dari tabel `failed_jobs`
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
-- Struktur dari tabel `jobs`
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
-- Struktur dari tabel `job_batches`
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
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_12_14_200345_create_stores_table', 1),
(5, '2025_12_14_200353_create_categories_table', 1),
(6, '2025_12_14_200358_create_products_table', 1),
(7, '2025_12_14_205130_create_carts_table', 1),
(8, '2025_12_14_210530_create_orders_table', 1),
(9, '2025_12_14_210536_create_order_items_table', 1),
(10, '2025_12_14_232104_add_address_to_orders_table', 2),
(11, '2025_12_15_000614_add_description_to_products_table', 3),
(12, '2025_12_15_002951_add_role_to_users_table', 4),
(13, '2025_12_15_004806_add_avatar_to_users_table', 5),
(14, '2025_12_15_011352_add_stock_to_products_table', 6),
(15, '2025_12_15_015552_add_shipping_details_to_orders_table', 7),
(16, '2025_12_15_015640_add_missing_columns_to_orders_table', 7),
(17, '2025_12_15_021310_fix_missing_columns_in_orders_table', 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `shipping_address` varchar(500) DEFAULT NULL,
  `order_number` varchar(255) NOT NULL,
  `total_price` decimal(15,2) NOT NULL,
  `subtotal` decimal(15,2) DEFAULT NULL,
  `shipping_cost` decimal(15,2) DEFAULT NULL,
  `status` enum('unpaid','paid','cancelled') NOT NULL DEFAULT 'unpaid',
  `address` text DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `zip_code` varchar(10) DEFAULT NULL,
  `courier` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `snap_token` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `user_name`, `user_phone`, `shipping_address`, `order_number`, `total_price`, `subtotal`, `shipping_cost`, `status`, `address`, `province`, `city`, `zip_code`, `courier`, `payment_method`, `snap_token`, `created_at`, `updated_at`) VALUES
(4, 6, NULL, NULL, NULL, 'ORD-ESLGMYJGT6', 4500000.00, NULL, NULL, 'paid', 'asdasdasds, asdsad, 12333', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 16:42:43', '2025-12-14 16:50:22'),
(5, 6, NULL, NULL, NULL, 'ORD-ILK1WZKAHU', 9000000.00, NULL, NULL, 'paid', 'dnfndsfdsfnfndfdsnfnd, nasdfnsdnf, 324324', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 16:51:47', '2025-12-14 17:20:45'),
(7, 7, NULL, NULL, NULL, 'ORD-55XTRXAYCS', 4500000.00, NULL, NULL, 'unpaid', 'Jl. Babakan Radio, Bandung, 40175', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 17:58:32', '2025-12-14 17:58:32'),
(8, 7, NULL, NULL, NULL, 'ORD-EWABIJYKDS', 9000000.00, NULL, NULL, 'unpaid', 'jasldsadldadjdjjdsajdj, bandung, 23123', NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 18:52:44', '2025-12-14 18:52:44'),
(9, 7, NULL, NULL, NULL, 'ORD-MNZCJAFK1N', 8000000.00, NULL, NULL, 'unpaid', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2025-12-14 19:03:42', '2025-12-14 19:03:42'),
(10, 7, 'Ridwan', '08123882828', 'asdasdsadsadasdasd', 'ORD-CP7IHCXO3N', 2015000.00, 2000000.00, 15000.00, 'unpaid', NULL, 'jawa', 'bandung', '40182', 'SiCepat Reguler', 'Midtrans', NULL, '2025-12-14 19:18:48', '2025-12-14 19:18:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(15,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`, `created_at`, `updated_at`) VALUES
(3, 4, 51, 1, 4500000.00, '2025-12-14 16:42:43', '2025-12-14 16:42:43'),
(4, 5, 51, 2, 4500000.00, '2025-12-14 16:51:47', '2025-12-14 16:51:47'),
(5, 7, 51, 1, 4500000.00, '2025-12-14 17:58:32', '2025-12-14 17:58:32'),
(6, 8, 51, 2, 4500000.00, '2025-12-14 18:52:44', '2025-12-14 18:52:44'),
(7, 9, 52, 4, 2000000.00, '2025-12-14 19:03:42', '2025-12-14 19:03:42'),
(8, 10, 52, 1, 2000000.00, '2025-12-14 19:18:48', '2025-12-14 19:18:48');

-- --------------------------------------------------------

--
-- Struktur dari tabel `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `store_id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `price` bigint(20) UNSIGNED NOT NULL,
  `stock` int(11) NOT NULL DEFAULT 100,
  `weight` int(11) NOT NULL,
  `condition` enum('new','used','refurbished') NOT NULL DEFAULT 'used',
  `specs` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`specs`)),
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `store_id`, `category_id`, `name`, `description`, `slug`, `image`, `price`, `stock`, `weight`, `condition`, `specs`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Ducimus sit.', NULL, 'ut-rerum-et-necessitatibus-distinctio-animi', NULL, 5987472, 100, 1913, 'new', '{\"brand\":\"ratione\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(2, 1, 1, 'Doloribus error consequatur non.', NULL, 'laboriosam-maiores-et-odit-illo', NULL, 4797337, 100, 1690, 'new', '{\"brand\":\"deserunt\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(3, 1, 1, 'Temporibus culpa autem.', NULL, 'perspiciatis-laborum-et-minima-quasi', NULL, 10901697, 100, 550, 'new', '{\"brand\":\"eveniet\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(4, 1, 1, 'Nisi cumque perferendis autem.', NULL, 'quod-eveniet-quia-ea-officiis-repudiandae-rem-enim', NULL, 594436, 100, 3670, 'new', '{\"brand\":\"voluptatem\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(5, 1, 1, 'Mollitia vel voluptatibus rerum.', NULL, 'et-omnis-vel-eos-non-quia-sint', NULL, 6823105, 100, 3256, 'new', '{\"brand\":\"deleniti\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(6, 1, 1, 'Voluptates provident sunt sed.', NULL, 'accusamus-rerum-ullam-perferendis-est-est', NULL, 1120696, 100, 1400, 'refurbished', '{\"brand\":\"voluptas\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(7, 1, 1, 'Quo placeat sit laboriosam.', NULL, 'totam-voluptatem-aut-quidem-velit-veniam-occaecati', NULL, 10948587, 100, 1413, 'refurbished', '{\"brand\":\"ratione\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(8, 1, 1, 'Dicta sed repellat autem.', NULL, 'praesentium-qui-consequuntur-sunt-est', NULL, 742976, 100, 613, 'refurbished', '{\"brand\":\"eaque\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(9, 1, 1, 'Veniam quia at voluptas.', NULL, 'dolore-perferendis-similique-quo-voluptatem-earum-sit-excepturi-et', NULL, 13332066, 100, 2845, 'used', '{\"brand\":\"at\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(10, 1, 1, 'Est inventore corporis.', NULL, 'ducimus-quis-dolorem-qui-itaque-aut-atque-inventore', NULL, 3752862, 100, 4651, 'new', '{\"brand\":\"quae\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(11, 2, 2, 'Laudantium labore esse.', NULL, 'omnis-iure-qui-molestiae-quae-adipisci-et-expedita', NULL, 4511330, 100, 1312, 'new', '{\"brand\":\"ut\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(12, 2, 2, 'Quia hic tempora eos.', NULL, 'facilis-aut-aut-et-laudantium-veritatis-velit-ab-voluptatibus', NULL, 14916265, 100, 3858, 'used', '{\"brand\":\"et\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(13, 2, 2, 'Fugit nobis beatae.', NULL, 'provident-reprehenderit-officia-quisquam-accusantium-dolores-delectus', NULL, 9464870, 100, 4856, 'new', '{\"brand\":\"consequatur\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(14, 2, 2, 'Quia porro laboriosam ut.', NULL, 'fuga-ullam-reprehenderit-velit-ipsam-praesentium-reprehenderit', NULL, 7399586, 100, 4319, 'new', '{\"brand\":\"asperiores\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(15, 2, 2, 'Cupiditate laboriosam beatae molestiae.', NULL, 'quod-eum-enim-commodi-nobis-commodi-minima', NULL, 7881599, 100, 1015, 'new', '{\"brand\":\"nulla\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(16, 2, 2, 'Suscipit nemo quam hic.', NULL, 'deleniti-nobis-adipisci-ea-autem-ipsa-veritatis-quis-dolores', NULL, 5135648, 100, 446, 'used', '{\"brand\":\"repudiandae\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(17, 2, 2, 'Eligendi voluptas temporibus et.', NULL, 'saepe-exercitationem-soluta-et-et-nihil', NULL, 6728702, 100, 4706, 'refurbished', '{\"brand\":\"consectetur\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(18, 2, 2, 'Repellat consequatur quis.', NULL, 'asperiores-quia-eveniet-nisi-eius', NULL, 581256, 100, 4769, 'used', '{\"brand\":\"hic\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(19, 2, 2, 'Quam iste autem fuga.', NULL, 'velit-maxime-qui-repellendus-nulla-iure-et-dolorum-laborum', NULL, 13798802, 100, 3936, 'refurbished', '{\"brand\":\"facilis\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(20, 2, 2, 'Totam ea omnis.', NULL, 'molestiae-non-et-voluptates-velit', NULL, 5998138, 100, 4435, 'new', '{\"brand\":\"aliquam\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(21, 3, 6, 'Recusandae repellendus iure.', NULL, 'aperiam-et-nemo-modi-consequatur', NULL, 8556310, 100, 2591, 'refurbished', '{\"brand\":\"sit\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(22, 3, 6, 'Est fugit fugit.', NULL, 'sunt-dolor-reprehenderit-soluta', NULL, 6680371, 100, 4208, 'used', '{\"brand\":\"enim\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(23, 3, 6, 'Eveniet nemo ea.', NULL, 'et-nihil-ex-quidem-laudantium-saepe-vero', NULL, 5920997, 100, 2540, 'refurbished', '{\"brand\":\"eum\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(24, 3, 6, 'Fuga distinctio similique.', NULL, 'et-ducimus-quo-cum-velit-et-velit-qui-et', NULL, 820759, 100, 1601, 'used', '{\"brand\":\"laudantium\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(25, 3, 6, 'Perspiciatis iure asperiores repellat.', NULL, 'aliquid-a-nesciunt-odit', NULL, 13411501, 100, 3784, 'used', '{\"brand\":\"mollitia\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(26, 3, 6, 'Perspiciatis eos sunt.', NULL, 'iste-autem-est-fugit-ut-velit-totam-assumenda', NULL, 2075377, 100, 4110, 'new', '{\"brand\":\"ipsa\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(27, 3, 6, 'Deleniti impedit id.', NULL, 'recusandae-placeat-fugit-earum-illum', NULL, 3815837, 100, 755, 'new', '{\"brand\":\"et\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(29, 3, 6, 'Blanditiis numquam incidunt est.', NULL, 'quia-distinctio-fuga-dolore-a-explicabo-quo', NULL, 5264746, 100, 475, 'refurbished', '{\"brand\":\"nesciunt\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(30, 3, 6, 'Vel dolorem non rerum.', NULL, 'neque-tenetur-nihil-et-sint-vitae-tenetur-quia', NULL, 8761028, 100, 4005, 'used', '{\"brand\":\"est\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(31, 4, 3, 'Sint sunt vel accusamus.', NULL, 'earum-quis-qui-quia-ut', NULL, 14207365, 100, 4592, 'refurbished', '{\"brand\":\"maiores\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(32, 4, 3, 'Libero et qui omnis.', NULL, 'ducimus-dicta-repellendus-sit-reprehenderit-odio', NULL, 14195120, 100, 3080, 'refurbished', '{\"brand\":\"voluptatem\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(33, 4, 3, 'Consectetur sit recusandae.', NULL, 'rem-qui-reprehenderit-cumque-ratione-illo-maxime-quia', NULL, 1525192, 100, 493, 'new', '{\"brand\":\"fuga\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(34, 4, 3, 'Ea repellendus consequatur fuga.', NULL, 'atque-eos-eos-illo-illo-ut', NULL, 8729987, 100, 330, 'new', '{\"brand\":\"possimus\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(35, 4, 3, 'Molestias consequatur similique.', NULL, 'sit-labore-harum-sequi-architecto-non', NULL, 5223786, 100, 2519, 'used', '{\"brand\":\"illum\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(36, 4, 3, 'Est vero et.', NULL, 'explicabo-sit-explicabo-facilis-omnis-voluptas-fuga', NULL, 7182547, 100, 3010, 'new', '{\"brand\":\"accusantium\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(37, 4, 3, 'Blanditiis et numquam dolores.', NULL, 'eos-esse-enim-sapiente-quibusdam-doloribus-et-delectus', NULL, 13807225, 100, 414, 'new', '{\"brand\":\"neque\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(38, 4, 3, 'Voluptas voluptatem totam.', NULL, 'aut-quas-quis-animi-voluptatem-natus', NULL, 9293013, 100, 2524, 'used', '{\"brand\":\"tenetur\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(39, 4, 3, 'Itaque omnis consequatur exercitationem.', NULL, 'inventore-ut-asperiores-in-officiis-hic-alias-voluptatibus', NULL, 3215869, 100, 1300, 'refurbished', '{\"brand\":\"exercitationem\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(40, 4, 3, 'Placeat placeat.', NULL, 'laborum-vel-illo-iste-consequatur-qui-voluptatem', NULL, 8883219, 100, 1463, 'used', '{\"brand\":\"dolorum\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(41, 5, 5, 'Necessitatibus repudiandae voluptatem.', NULL, 'reiciendis-voluptas-et-minus', NULL, 3060332, 100, 889, 'refurbished', '{\"brand\":\"autem\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(42, 5, 5, 'Hic sunt vitae iusto.', NULL, 'suscipit-adipisci-natus-accusamus-saepe-doloribus-itaque-consectetur', NULL, 6834916, 100, 3975, 'used', '{\"brand\":\"molestiae\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(43, 5, 5, 'Temporibus enim cumque.', NULL, 'et-pariatur-in-ipsam', NULL, 9982061, 100, 3650, 'used', '{\"brand\":\"molestiae\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(44, 5, 5, 'Eius temporibus sunt fugit.', NULL, 'autem-nulla-atque-minus-nisi-rem-ut', NULL, 7548629, 100, 3512, 'refurbished', '{\"brand\":\"consequatur\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(45, 5, 5, 'Beatae similique est quidem velit.', NULL, 'voluptates-quidem-harum-velit-est-autem-atque', NULL, 12642976, 100, 4846, 'refurbished', '{\"brand\":\"amet\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(46, 5, 5, 'Ratione ea distinctio.', NULL, 'quisquam-laudantium-deserunt-rerum', NULL, 6453087, 100, 1029, 'new', '{\"brand\":\"doloribus\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(47, 5, 5, 'Nam quae consequatur officiis.', NULL, 'quidem-cumque-laborum-qui', NULL, 5977914, 100, 528, 'new', '{\"brand\":\"neque\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(48, 5, 5, 'Aut quia ab.', NULL, 'voluptatibus-nesciunt-similique-minima-quasi-iste-cupiditate', NULL, 7214663, 100, 3245, 'refurbished', '{\"brand\":\"vero\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(49, 5, 5, 'Cumque illum tempora ipsum.', NULL, 'blanditiis-consectetur-aut-quia-fugiat-numquam-praesentium-nobis-asperiores', NULL, 5221251, 100, 1925, 'refurbished', '{\"brand\":\"at\",\"warranty\":\"Distributor\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(50, 5, 5, 'Iure et beatae et.', NULL, 'soluta-autem-ea-ipsa', NULL, 5513989, 100, 4046, 'used', '{\"brand\":\"provident\",\"warranty\":\"Official\",\"notes\":\"Unit only, no box\"}', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(51, 1, 2, 'RTX 3060', 'sadasdasd', 'rtx-3060', 'products/TCuXdrBXXBiofaJsgvVeT4OMgHpGFPJXYMaDMUBe.png', 4500000, 100, 1500, 'new', NULL, 1, '2025-12-14 15:54:01', '2025-12-14 17:11:08'),
(52, 1, 2, 'RX 6600', 'adasdd', 'rx-6600', 'products/X4fuhIQ0kdYWnYWaGwFDawAfXDn2Wmi3vMM6yjor.jpg', 2000000, 12, 1000, 'new', NULL, 1, '2025-12-14 18:22:38', '2025-12-14 18:22:49');

-- --------------------------------------------------------

--
-- Struktur dari tabel `sessions`
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
-- Dumping data untuk tabel `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('2rdr87iog0f4SODSfPM6Gd8iQTvfJgXNM9dJUmul', 9, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36 Edg/143.0.0.0', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoibWJtMmdkZ3dUWTZNaGJIR3FaVnlsd1NqazFabmN5Wkd5b1hqQ2VJcSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6OTt9', 1765897204),
('ADcKkUtXcU27ynNop7zTBz4UCyBxlMYWH41kTQ0J', 7, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoielducWNBVHk0YklCWldKelNnT1F1VzJMa09HMUpzc2hqMHhaRWZBTSI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6Nzt9', 1765808464),
('CPiVgt6OSDwyfUSetvifEKdoVGagZWc3JDOnVfS1', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiY2V6eXU0THo3blU5NVhqb0JCZUZ0ZVV2UTNGNmdyUWtYejRsMDFHRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765897024),
('PhzppzUM46pe7IHsnuy9hjDxWUIS6dePh6G6D4V0', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/143.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiOXBsb2hNTVo0SXNZN1JpcnVsclZDT2NvRzRva0lxNUl5V2g5TUFQRSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7czo0OiJob21lIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1765828766);

-- --------------------------------------------------------

--
-- Struktur dari tabel `stores`
--

CREATE TABLE `stores` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `stores`
--

INSERT INTO `stores` (`id`, `user_id`, `name`, `slug`, `description`, `city_id`, `created_at`, `updated_at`) VALUES
(1, 1, 'Bartoletti-Kemmer', 'nisi-laudantium-vel-voluptatem-vero-dolorem-aut-dolor', 'Ab commodi autem vitae dicta animi reiciendis debitis. Ut alias enim ullam modi esse culpa repellat. Incidunt ut harum ad aperiam non architecto.', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(2, 2, 'McKenzie LLC', 'est-numquam-optio-quae-aperiam-et-delectus-nesciunt', 'Nostrum voluptatibus est eius inventore ea a. Rerum repellendus distinctio quas dignissimos magnam hic. Totam consequatur quo asperiores necessitatibus velit sit quia. Earum maiores deserunt nulla consectetur provident.', 1, '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(3, 3, 'Trantow, McCullough and Volkman', 'voluptatem-harum-voluptas-hic-possimus-eum-nulla', 'Officia est culpa culpa illo est temporibus. Et numquam minima eos illo est et cum consequuntur. Explicabo eligendi voluptas corrupti nihil aut qui expedita aliquam.', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(4, 4, 'Konopelski and Sons', 'quo-fugiat-ex-repudiandae-magni-enim-voluptas-iusto', 'Odio veritatis assumenda distinctio est voluptas omnis aut molestiae. Recusandae nulla vitae enim atque. Quis quae hic quo vitae sit dolorum.', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41'),
(5, 5, 'Bogan and Sons', 'ut-dignissimos-minus-dignissimos-inventore-rerum-exercitationem', 'Repudiandae adipisci assumenda tenetur officia voluptatem quis. Quia eligendi laboriosam eius minus unde odio mollitia quia. Id facere nulla aut repellat quis quia natus. Repudiandae eum soluta eaque officia porro voluptas minus.', 1, '2025-12-14 15:05:41', '2025-12-14 15:05:41');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `avatar`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Jacinto Ernser', 'langworth.nico@example.net', NULL, 'user', '2025-12-14 15:05:40', '$2y$12$ZDAlA5JjUq67V0a3cJe8FuFQk1P/9CU0mY6/2gKNwtf23kWLPRSTW', '83oxg0rBAX', '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(2, 'Larry Stehr', 'destin72@example.net', NULL, 'user', '2025-12-14 15:05:40', '$2y$12$ZDAlA5JjUq67V0a3cJe8FuFQk1P/9CU0mY6/2gKNwtf23kWLPRSTW', 'tVGZjL6HD2', '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(3, 'Leanna Robel', 'akemmer@example.net', NULL, 'user', '2025-12-14 15:05:40', '$2y$12$ZDAlA5JjUq67V0a3cJe8FuFQk1P/9CU0mY6/2gKNwtf23kWLPRSTW', 'apEsjZrv1i', '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(4, 'Prof. Anderson Douglas', 'epaucek@example.net', NULL, 'user', '2025-12-14 15:05:40', '$2y$12$ZDAlA5JjUq67V0a3cJe8FuFQk1P/9CU0mY6/2gKNwtf23kWLPRSTW', 's5RQ4zutdg', '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(5, 'Lessie Conroy', 'blangosh@example.com', NULL, 'user', '2025-12-14 15:05:40', '$2y$12$ZDAlA5JjUq67V0a3cJe8FuFQk1P/9CU0mY6/2gKNwtf23kWLPRSTW', 'aNwIKPi6bc', '2025-12-14 15:05:40', '2025-12-14 15:05:40'),
(6, 'Admin', 'admn@rigcycle.com', NULL, 'user', '2025-12-14 15:05:41', '$2y$12$mh2pgZLC//.4F37yKJmomOmoSazSFAfl4mdKXUrwmyN2aGPPTHq9u', 'V8VBACf2N9qrKONCq4WpPfVtrqWXWnoqpcL6vnSoGr8XjgRO2QHaeekfDWOD', '2025-12-14 15:05:41', '2025-12-14 16:39:38'),
(7, 'Ridwan', 'ridwan@gmail.com', 'avatars/ERox34CJYfA8sX9Em3gpChbIujTJkWhbDbbuhApJ.jpg', 'user', NULL, '$2y$12$VMRQOll9ShZ9BXFJvCmMy.IZvenNXP/y7w942DQYmu8gsjqJemscS', NULL, '2025-12-14 17:27:09', '2025-12-14 17:57:47'),
(9, 'Admin Ganteng Pacar Cerydra', 'admin@rigcycle.com', 'avatars/RftXhlNUPB3y5GwQtgmfueAkbW5uVBEXHgZAAriu.png', 'admin', NULL, '$2y$12$X819poE6RTcuNOX5u2MiXecPEhhSmyq0MwlNtAKXbc6MsXZo.9X7a', NULL, '2025-12-14 17:32:16', '2025-12-15 04:44:50');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indeks untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `carts_user_id_product_id_unique` (`user_id`,`product_id`),
  ADD KEY `carts_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Indeks untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indeks untuk tabel `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indeks untuk tabel `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `orders_order_number_unique` (`order_number`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indeks untuk tabel `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_store_id_foreign` (`store_id`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Indeks untuk tabel `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indeks untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `stores_slug_unique` (`slug`),
  ADD KEY `stores_user_id_foreign` (`user_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `carts`
--
ALTER TABLE `carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT untuk tabel `stores`
--
ALTER TABLE `stores`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `carts_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `carts_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Ketidakleluasaan untuk tabel `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_store_id_foreign` FOREIGN KEY (`store_id`) REFERENCES `stores` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `stores`
--
ALTER TABLE `stores`
  ADD CONSTRAINT `stores_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
