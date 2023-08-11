-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 23 Jul 2023 pada 19.16
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci4_tokocornerfiesta`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_activation_attempts`
--

CREATE TABLE `auth_activation_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups`
--

CREATE TABLE `auth_groups` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups`
--

INSERT INTO `auth_groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'kasir', 'kasir'),
(3, 'user', 'user Public');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_permissions`
--

CREATE TABLE `auth_groups_permissions` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups_permissions`
--

INSERT INTO `auth_groups_permissions` (`group_id`, `permission_id`) VALUES
(1, 1),
(1, 2),
(3, 2);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_groups_users`
--

CREATE TABLE `auth_groups_users` (
  `group_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_groups_users`
--

INSERT INTO `auth_groups_users` (`group_id`, `user_id`) VALUES
(1, 7),
(3, 8);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_logins`
--

CREATE TABLE `auth_logins` (
  `id` int(11) UNSIGNED NOT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `date` datetime NOT NULL,
  `success` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_logins`
--

INSERT INTO `auth_logins` (`id`, `ip_address`, `email`, `user_id`, `date`, `success`) VALUES
(1, '::1', 'testdemo123@mail.com', NULL, '2023-07-05 21:11:45', 0),
(2, '::1', 'cobainaja@gmail.com', 6, '2023-07-05 21:12:57', 1),
(3, '::1', 'cobainaja@gmail.com', 6, '2023-07-05 21:14:35', 1),
(4, '::1', 'cobainaja@gmail.com', 6, '2023-07-05 21:31:25', 1),
(5, '::1', 'cobainaja@gmail.com', 6, '2023-07-05 21:35:06', 1),
(6, '::1', 'admin@admin.com', 7, '2023-07-05 21:49:09', 1),
(7, '::1', 'user@user.com', 8, '2023-07-05 21:52:30', 1),
(8, '::1', 'admin@admin.com', 7, '2023-07-05 22:01:46', 1),
(9, '::1', 'user@user.com', 8, '2023-07-05 22:02:14', 1),
(10, '::1', 'admin@admin.com', 7, '2023-07-05 22:07:59', 1),
(11, '::1', 'user@user.com', 8, '2023-07-05 22:08:26', 1),
(12, '::1', 'user@user.com', 8, '2023-07-05 22:08:42', 1),
(13, '::1', 'user@user.com', 8, '2023-07-05 22:18:31', 1),
(14, '::1', 'user@user.com', 8, '2023-07-05 22:27:10', 1),
(15, '::1', 'admin@admin.com', 7, '2023-07-05 22:31:57', 1),
(16, '::1', 'user@user.com', 8, '2023-07-06 00:33:38', 1),
(17, '::1', 'admin@admin.com', 7, '2023-07-06 00:35:45', 1),
(18, '::1', 'user@user.com', NULL, '2023-07-06 00:41:09', 0),
(19, '::1', 'admin@admin.com', 7, '2023-07-06 00:51:29', 1),
(20, '::1', 'asdad@asd.cc', NULL, '2023-07-06 01:02:41', 0),
(21, '::1', 'admin@admin.com', 7, '2023-07-06 01:02:56', 1),
(22, '::1', 'user@user.com', 8, '2023-07-06 02:30:29', 1),
(23, '::1', 'admin@admin.com', 7, '2023-07-06 03:24:30', 1),
(24, '::1', 'user@user.com', 8, '2023-07-06 03:29:23', 1),
(25, '::1', 'user@user.com', 8, '2023-07-06 09:16:00', 1),
(26, '::1', 'admin@admin.com', 7, '2023-07-06 13:38:50', 1),
(27, '::1', 'user@user.com', 8, '2023-07-06 18:36:51', 1),
(28, '::1', 'user@user.com', 8, '2023-07-06 18:51:09', 1),
(29, '::1', 'user@user.com', 8, '2023-07-06 18:56:32', 1),
(30, '::1', 'user@user.com', 8, '2023-07-06 20:09:11', 1),
(31, '::1', 'admin@admin.com', 7, '2023-07-06 20:54:42', 1),
(32, '::1', 'user@user.com', 8, '2023-07-06 23:09:11', 1),
(33, '::1', 'admin@admin.com', 7, '2023-07-06 23:10:24', 1),
(34, '::1', 'user@user.com', 8, '2023-07-06 23:39:00', 1),
(35, '::1', 'admin@admin.com', 7, '2023-07-07 01:51:20', 1),
(36, '::1', 'admin@admin.com', 7, '2023-07-07 02:09:40', 1),
(37, '::1', 'user@user.com', NULL, '2023-07-07 08:19:31', 0),
(38, '::1', 'user@user.com', 8, '2023-07-07 08:19:50', 1),
(39, '::1', 'user2@user2.com', 9, '2023-07-07 08:23:14', 1),
(40, '::1', 'admin@admin.com', 7, '2023-07-07 08:47:08', 1),
(41, '::1', 'admin@admin.com', 7, '2023-07-07 09:08:47', 1),
(42, '::1', 'user2@user2.com', 9, '2023-07-07 09:09:07', 1),
(43, '::1', 'admin@admin.com', 7, '2023-07-07 11:58:23', 1),
(44, '::1', 'admin@admin.com', 7, '2023-07-07 12:01:51', 1),
(45, '::1', 'user@user.com', 8, '2023-07-07 12:02:08', 1),
(46, '::1', 'admin@admin.com', 7, '2023-07-07 12:02:31', 1),
(47, '::1', 'user2@user2.com', 9, '2023-07-07 12:18:36', 1),
(48, '::1', 'admin@admin.com', 7, '2023-07-07 12:23:24', 1),
(49, '::1', 'admin@admin.com', 7, '2023-07-10 20:18:13', 1),
(50, '::1', 'user@user.com', 8, '2023-07-10 22:55:48', 1),
(51, '::1', 'user@user.com', 8, '2023-07-10 22:56:41', 1),
(52, '::1', 'admin@admin.com', 7, '2023-07-11 14:15:20', 1),
(53, '::1', 'user', NULL, '2023-07-11 14:18:29', 0),
(54, '::1', 'user', NULL, '2023-07-11 14:19:40', 0),
(55, '::1', 'user@user.com', 8, '2023-07-11 14:19:45', 1),
(56, '::1', 'admin', NULL, '2023-07-11 15:24:38', 0),
(57, '::1', 'admin@admin.com', 7, '2023-07-11 15:24:46', 1),
(58, '::1', 'admin', NULL, '2023-07-11 15:26:09', 0),
(59, '::1', 'admin@admin.com', 7, '2023-07-11 15:26:19', 1),
(60, '::1', 'user@user.com', 8, '2023-07-11 15:27:36', 1),
(61, '::1', 'admin@admin.com', 7, '2023-07-11 18:35:38', 1),
(62, '::1', 'admin@admin.com', 7, '2023-07-11 18:41:38', 1),
(63, '::1', 'user@user.com', 8, '2023-07-11 18:58:30', 1),
(64, '::1', 'user@user.com', 8, '2023-07-11 18:59:46', 1),
(65, '::1', 'admin@admin.com', 7, '2023-07-11 23:00:28', 1),
(66, '::1', 'admin@admin.com', 7, '2023-07-12 11:26:55', 1),
(67, '::1', 'admin@admin.com', 7, '2023-07-12 12:33:55', 1),
(68, '::1', 'user@user.com', 8, '2023-07-12 12:34:44', 1),
(69, '::1', 'admin@admin.com', 7, '2023-07-12 12:48:59', 1),
(70, '::1', 'user@user.com', 8, '2023-07-12 19:39:22', 1),
(71, '::1', 'admin@admin.com', 7, '2023-07-12 22:37:50', 1),
(72, '::1', 'user@user.com', 8, '2023-07-12 23:31:19', 1),
(73, '::1', 'admin@admin.com', 7, '2023-07-12 23:34:37', 1),
(74, '::1', 'user@user.com', 8, '2023-07-12 23:40:43', 1),
(75, '::1', 'asdasd@asdasd.cac', NULL, '2023-07-13 21:25:13', 0),
(76, '::1', 'okaskdok@asd.cc', NULL, '2023-07-13 21:26:01', 0),
(77, '::1', 'admin@admin.com', 7, '2023-07-13 21:26:18', 1),
(78, '::1', 'user@user.com', 8, '2023-07-13 21:43:36', 1),
(79, '::1', 'user@user.com', 8, '2023-07-13 22:17:05', 1),
(80, '::1', 'user@user.com', 8, '2023-07-14 11:37:22', 1),
(81, '::1', 'user@user.com', 8, '2023-07-14 15:36:05', 1),
(82, '::1', 'admin@admin.com', 7, '2023-07-14 22:54:15', 1),
(83, '::1', 'user@user.com', 8, '2023-07-14 23:32:14', 1),
(84, '::1', 'user@user.com', 8, '2023-07-14 23:33:16', 1),
(85, '::1', 'admin@admin.com', NULL, '2023-07-14 23:41:48', 0),
(86, '::1', 'admin@admin.com', 7, '2023-07-14 23:41:55', 1),
(87, '::1', 'admin@admin.com', 7, '2023-07-15 16:05:15', 1),
(88, '::1', 'user@user.com', 8, '2023-07-15 16:06:13', 1),
(89, '::1', 'admin@admin.com', 7, '2023-07-15 18:22:49', 1),
(90, '::1', 'user@user.com', 8, '2023-07-15 18:27:03', 1),
(91, '::1', 'admin@admin.com', 7, '2023-07-16 02:01:10', 1),
(92, '::1', 'user@user.com', NULL, '2023-07-16 02:31:49', 0),
(93, '::1', 'user@user.com', 8, '2023-07-16 02:31:58', 1),
(94, '::1', 'user@user.com', 8, '2023-07-16 09:04:55', 1),
(95, '::1', 'admin@admin.com', 7, '2023-07-16 11:56:21', 1),
(96, '::1', 'admin@admin.com', 7, '2023-07-16 11:58:34', 1),
(97, '::1', 'user@user.com', NULL, '2023-07-18 15:34:46', 0),
(98, '::1', 'user@user.com', NULL, '2023-07-18 15:34:53', 0),
(99, '::1', 'user@user.com', NULL, '2023-07-18 15:35:21', 0),
(100, '::1', 'user@user.com', 8, '2023-07-18 15:35:26', 1),
(101, '::1', 'user@user.com', NULL, '2023-07-23 14:21:16', 0),
(102, '::1', 'user@user.com', NULL, '2023-07-23 14:21:26', 0),
(103, '::1', 'user@user.com', NULL, '2023-07-23 14:22:06', 0),
(104, '::1', 'user@user.com', NULL, '2023-07-23 14:22:16', 0),
(105, '::1', 'user@user.com', 8, '2023-07-23 14:22:45', 1),
(106, '::1', 'user@user.com', 8, '2023-07-23 15:28:28', 1),
(107, '::1', 'user@user.com', 8, '2023-07-23 15:30:41', 1),
(108, '::1', 'admin@admin.com', 7, '2023-07-23 16:08:28', 1),
(109, '::1', 'admin@admin.com', 7, '2023-07-23 16:28:48', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_permissions`
--

CREATE TABLE `auth_permissions` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `auth_permissions`
--

INSERT INTO `auth_permissions` (`id`, `name`, `description`) VALUES
(1, 'manage-user', 'Manage All user'),
(2, 'manage-profile', 'Manage Users profile');

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_reset_attempts`
--

CREATE TABLE `auth_reset_attempts` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `user_agent` varchar(255) NOT NULL,
  `token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_tokens`
--

CREATE TABLE `auth_tokens` (
  `id` int(11) UNSIGNED NOT NULL,
  `selector` varchar(255) NOT NULL,
  `hashedValidator` varchar(255) NOT NULL,
  `user_id` int(11) UNSIGNED NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth_users_permissions`
--

CREATE TABLE `auth_users_permissions` (
  `user_id` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `permission_id` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(1, '2017-11-20-223112', 'Myth\\Auth\\Database\\Migrations\\CreateAuthTables', 'default', 'Myth\\Auth', 1688588825, 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `kd_barang` int(11) NOT NULL,
  `nama_barang` varchar(100) DEFAULT NULL,
  `harga_beli` varchar(100) DEFAULT NULL,
  `harga_jual` varchar(100) DEFAULT NULL,
  `stok` varchar(100) DEFAULT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  `keterangan` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`kd_barang`, `nama_barang`, `harga_beli`, `harga_jual`, `stok`, `gambar`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'Garlic Cheese', '15000', '23000', '50', 'garlic_cheese.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 23:00:59', NULL),
(13, 'Chicken Nugget', '15000', '24500', '50', 'chicken_nugget.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 22:59:09', NULL),
(15, 'Crispy bubble', '15000', '25000', '41', '4.jpeg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-23 16:57:49', '2023-07-23 16:57:49'),
(16, 'Cheesy Lover', '15000', '25000', '38', 'cheesy_lover.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-23 16:57:49', '2023-07-23 16:57:49'),
(17, 'Chicken Nugget', '15000', '24500', '50', 'chicken_nugget.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 22:59:09', NULL),
(18, 'Crispy bubble', '15000', '25000', '50', '4.jpeg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 22:59:28', NULL),
(19, 'Cheesy Lover', '15000', '25000', '50', 'cheesy_lover.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 23:12:57', '0000-00-00 00:00:00'),
(20, 'Garlic Cheese', '15000', '23000', '50', 'garlic_cheese.jpg', 'makanan keluarga cocok untuk temani makan setiap harimu', '2023-07-13 23:00:59', NULL);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_keranjang`
--

CREATE TABLE `tb_keranjang` (
  `id` int(11) NOT NULL,
  `id_barang` varchar(255) DEFAULT NULL,
  `id_pembeli` varchar(255) DEFAULT NULL,
  `quantity_beli` varchar(255) DEFAULT NULL,
  `total_harga` varchar(255) DEFAULT NULL,
  `status_dikeranjang` varchar(255) DEFAULT NULL,
  `status_pembayaran` varchar(255) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_keranjang`
--

INSERT INTO `tb_keranjang` (`id`, `id_barang`, `id_pembeli`, `quantity_beli`, `total_harga`, `status_dikeranjang`, `status_pembayaran`, `created_at`, `updated_at`) VALUES
(1, '15', '8', '3', '75000', 'aktif', '', '2023-07-15 09:25:36', '2023-07-14 00:00:00'),
(3, '16', '8', '4', '100000', 'aktif', '', '2023-07-15 09:25:39', '2023-07-14 00:00:00'),
(4, '13', '8', '3', '73500', 'aktif', NULL, '2023-07-23 00:00:00', '2023-07-23 00:00:00');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama` varchar(50) DEFAULT NULL,
  `telp` varchar(13) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `username` varchar(20) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pembeli`
--

CREATE TABLE `tb_pembeli` (
  `id` int(11) NOT NULL,
  `id_pembeli` varchar(100) DEFAULT NULL,
  `nama_pembeli` varchar(100) DEFAULT NULL,
  `telp` varchar(100) DEFAULT NULL,
  `alamat` varchar(100) DEFAULT NULL,
  `jenis_kelamin` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_transaksi`
--

CREATE TABLE `tb_transaksi` (
  `id` int(11) NOT NULL,
  `kd_pesanan` varchar(255) DEFAULT NULL,
  `id_pembeli` int(11) DEFAULT NULL,
  `jml_barang` varchar(11) DEFAULT NULL,
  `kd_barang` varchar(100) DEFAULT NULL,
  `total_harga` varchar(100) DEFAULT NULL,
  `bukti_pembayaran` varchar(100) DEFAULT NULL,
  `status_transaksi` varchar(100) DEFAULT NULL,
  `tgl_transaksi` varchar(100) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `tanggal_kirim` date DEFAULT NULL,
  `tanggal_sampai` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `tb_transaksi`
--

INSERT INTO `tb_transaksi` (`id`, `kd_pesanan`, `id_pembeli`, `jml_barang`, `kd_barang`, `total_harga`, `bukti_pembayaran`, `status_transaksi`, `tgl_transaksi`, `updated_at`, `tanggal_kirim`, `tanggal_sampai`) VALUES
(14, 'IN534', 8, '3', '15', '75000', '1689373364SOUND.png', 'SELESAI', '2023-07-14', '2023-07-23 16:57:49', '2023-07-21', '2023-07-22'),
(15, 'IN534', 8, '4', '16', '100000', '1689373364SOUND.png', 'SELESAI', '2023-07-14', '2023-07-23 16:57:49', '2023-07-21', '2023-07-22');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(30) DEFAULT NULL,
  `password_hash` varchar(255) NOT NULL,
  `reset_hash` varchar(255) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `activate_hash` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 0,
  `force_pass_reset` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `password_hash`, `reset_hash`, `reset_at`, `reset_expires`, `activate_hash`, `status`, `status_message`, `active`, `force_pass_reset`, `created_at`, `updated_at`, `deleted_at`) VALUES
(7, 'admin@admin.com', 'admin', '$2y$10$pG7fOKUHKya5D3qrTvUH/efWgFuVChIu27uYUzmOzaXb9U0NZ4jf.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-05 21:39:12', '2023-07-05 21:39:12', NULL),
(8, 'user@user.com', 'user', '$2y$10$pG7fOKUHKya5D3qrTvUH/efWgFuVChIu27uYUzmOzaXb9U0NZ4jf.', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2023-07-05 21:42:18', '2023-07-05 21:42:18', NULL);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD KEY `auth_groups_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `group_id_permission_id` (`group_id`,`permission_id`);

--
-- Indeks untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD KEY `auth_groups_users_user_id_foreign` (`user_id`),
  ADD KEY `group_id_user_id` (`group_id`,`user_id`);

--
-- Indeks untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `email` (`email`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `auth_tokens_user_id_foreign` (`user_id`),
  ADD KEY `selector` (`selector`);

--
-- Indeks untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD KEY `auth_users_permissions_permission_id_foreign` (`permission_id`),
  ADD KEY `user_id_permission_id` (`user_id`,`permission_id`);

--
-- Indeks untuk tabel `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`kd_barang`) USING BTREE;

--
-- Indeks untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`);

--
-- Indeks untuk tabel `tb_pembeli`
--
ALTER TABLE `tb_pembeli`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `auth_activation_attempts`
--
ALTER TABLE `auth_activation_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_groups`
--
ALTER TABLE `auth_groups`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `auth_logins`
--
ALTER TABLE `auth_logins`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT untuk tabel `auth_permissions`
--
ALTER TABLE `auth_permissions`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `auth_reset_attempts`
--
ALTER TABLE `auth_reset_attempts`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `kd_barang` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_keranjang`
--
ALTER TABLE `tb_keranjang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_pembeli`
--
ALTER TABLE `tb_pembeli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `tb_transaksi`
--
ALTER TABLE `tb_transaksi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `auth_groups_permissions`
--
ALTER TABLE `auth_groups_permissions`
  ADD CONSTRAINT `auth_groups_permissions_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_groups_users`
--
ALTER TABLE `auth_groups_users`
  ADD CONSTRAINT `auth_groups_users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `auth_groups` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_groups_users_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_tokens`
--
ALTER TABLE `auth_tokens`
  ADD CONSTRAINT `auth_tokens_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `auth_users_permissions`
--
ALTER TABLE `auth_users_permissions`
  ADD CONSTRAINT `auth_users_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `auth_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `auth_users_permissions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
