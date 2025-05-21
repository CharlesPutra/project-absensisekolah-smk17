-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2025 at 03:39 PM
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
-- Database: `project_absensisekolah`
--

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
-- Table structure for table `gurus`
--

CREATE TABLE `gurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_guru` int(11) NOT NULL,
  `nama_guru` varchar(255) NOT NULL,
  `jenis_kelamin` enum('Laki_Laki','Permpuan') NOT NULL,
  `karyawan` enum('Karyawan','Guru') NOT NULL,
  `id_jadwalkaryawan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_jurusan` bigint(20) UNSIGNED DEFAULT NULL,
  `id_jadwalguru` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gurus`
--

INSERT INTO `gurus` (`id`, `no_guru`, `nama_guru`, `jenis_kelamin`, `karyawan`, `id_jadwalkaryawan`, `id_jurusan`, `id_jadwalguru`, `created_at`, `updated_at`) VALUES
(142, 1, 'MUJI ASBIYAH, S.Pd.I', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 17:53:46', '2025-05-19 17:53:46'),
(143, 2, 'RETNO HANDAYANI,SE.MM', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 17:54:16', '2025-05-19 17:54:16'),
(144, 3, 'SOBIRIANTO', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 17:54:52', '2025-05-19 17:58:57'),
(145, 4, 'ITA LUKMAWATI, SE', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 17:59:55', '2025-05-19 17:59:55'),
(146, 5, 'SITI UMI HANIAH, SE', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:00:18', '2025-05-19 18:00:18'),
(147, 6, 'NUR IMAMAH, S.Pd,MM', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:00:41', '2025-05-19 18:00:41'),
(148, 7, 'GATHOT JOYO P, S.Pd', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:01:08', '2025-05-19 18:01:08'),
(149, 8, 'NOVERIA WULANDARI, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:03:39', '2025-05-19 18:03:39'),
(150, 9, 'SAIFURROHMAN, S.Sn', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:04:13', '2025-05-19 18:04:13'),
(151, 10, 'DWI SURYANTI, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:04:41', '2025-05-19 18:04:41'),
(152, 11, 'ILIYIN FAHMA ROLA, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:05:12', '2025-05-19 18:05:12'),
(153, 12, 'WINARKO, SE', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:05:51', '2025-05-19 18:05:51'),
(154, 13, 'RAHMAD GOPAR, S.Pd', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:06:16', '2025-05-19 18:06:16'),
(155, 14, 'PETUT HERI SANTOSO, S.Pd', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:06:50', '2025-05-19 18:06:50'),
(156, 15, 'RAHMAD GOPUR, S.Pd', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:07:16', '2025-05-19 18:07:16'),
(157, 16, 'DWI FEBRIYANI, S.Tr.Par', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:07:47', '2025-05-19 18:07:47'),
(158, 17, 'HERMIN MARDIATI, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:08:18', '2025-05-19 18:08:18'),
(159, 18, 'LINDA DWI FENTI A, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:09:37', '2025-05-19 18:09:37'),
(160, 19, 'FAJAR ISNAINI, SE. MM', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:13:45', '2025-05-19 18:13:45'),
(161, 20, 'SINTA DYAH R, S.T', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:14:11', '2025-05-19 18:14:11'),
(162, 21, 'RESTI IKA F, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:14:38', '2025-05-19 18:14:38'),
(163, 22, 'RENY PARISTA, SM', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:15:02', '2025-05-19 18:15:02'),
(164, 23, 'DENY ANDRI YANTO, A.Md', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:15:41', '2025-05-19 18:15:41'),
(165, 24, 'DICKY RISKIYANTO, A.Md', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:16:06', '2025-05-19 18:16:06'),
(166, 25, 'PUPUT MUDALIANA, SE', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:16:33', '2025-05-19 18:16:33'),
(167, 26, 'KHOLIF FITRIYANI, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:17:57', '2025-05-19 18:17:57'),
(168, 27, 'ZHENITH RIZKYADIN, A.Md', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:18:26', '2025-05-19 18:18:26'),
(169, 28, 'WIWIK WIDYA W, S.Tr.Par', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:18:57', '2025-05-19 18:18:57'),
(170, 29, 'AHMAD MAULANA BAIDOWI', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:19:26', '2025-05-19 18:19:26'),
(171, 30, 'DANANG BAGUS NOFRIANTO, SH', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:19:53', '2025-05-19 18:19:53'),
(172, 31, 'DENOK PERMATASARI, S.Tr.Par', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:20:21', '2025-05-19 18:20:21'),
(173, 32, 'YOGA DWITARA', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:20:47', '2025-05-19 18:20:47'),
(174, 33, 'CHAMIM DJAWAWI, ST', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:21:19', '2025-05-19 18:21:19'),
(175, 34, 'ERNANDA EVENDI', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:21:44', '2025-05-19 18:21:44'),
(176, 35, 'PUTRI INDAH SARI, S.Sos', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:22:17', '2025-05-19 18:22:17'),
(177, 36, 'MOHAMAD SUNYOTO, S.Pd', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:22:55', '2025-05-19 18:22:55'),
(178, 37, 'ISNAINI NOVITA SARI, S.Pd', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:23:34', '2025-05-19 18:23:34'),
(179, 38, 'SAMSUL MUHYIDIN', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:23:59', '2025-05-19 18:23:59'),
(180, 39, 'CITRA MAWARDANI, A.Md', 'Permpuan', 'Guru', NULL, 3, 1, '2025-05-19 18:24:36', '2025-05-19 18:24:36'),
(181, 40, 'NANDA SAPUTRA, S.Tr.Par', 'Laki_Laki', 'Guru', NULL, 3, 1, '2025-05-19 18:25:00', '2025-05-19 18:25:00'),
(182, 41, 'PENI WAHYUNINGSIH', 'Permpuan', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:25:29', '2025-05-19 18:25:29'),
(183, 42, 'SULISTYOWATININGSIH', 'Laki_Laki', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:26:03', '2025-05-19 18:26:03'),
(184, 43, 'SISKA NURDIA MARTA', 'Permpuan', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:26:21', '2025-05-19 18:26:21'),
(185, 44, 'DWI SUSANTI, S.Pd', 'Permpuan', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:26:40', '2025-05-19 18:26:40'),
(186, 45, 'RONI DIMAS ARI WIJAKSONO', 'Laki_Laki', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:27:13', '2025-05-19 18:27:13'),
(187, 46, 'MUHAMMAD MUKHLISIN', 'Laki_Laki', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:27:33', '2025-05-19 18:27:33'),
(188, 47, 'MOH. BAROK ABDILLAH', 'Laki_Laki', 'Karyawan', 1, NULL, NULL, '2025-05-19 18:27:51', '2025-05-19 18:27:51'),
(190, 48, 'CHARLES', 'Laki_Laki', 'Guru', NULL, 6, 11, '2025-05-21 06:01:16', '2025-05-21 06:01:16');

-- --------------------------------------------------------

--
-- Table structure for table `ijins`
--

CREATE TABLE `ijins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_nama` bigint(20) UNSIGNED NOT NULL,
  `tanggal_mulai` date NOT NULL,
  `tanggal_berakhir` date NOT NULL,
  `keterangan` enum('IJIN/CUTI','SAKIT') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ijins`
--

INSERT INTO `ijins` (`id`, `id_nama`, `tanggal_mulai`, `tanggal_berakhir`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 179, '2023-07-20', '2023-07-26', 'IJIN/CUTI', '2025-05-20 05:50:47', '2025-05-20 05:50:47'),
(2, 179, '2023-07-28', '2023-07-30', 'SAKIT', '2025-05-20 06:10:41', '2025-05-20 06:10:41'),
(3, 179, '2025-05-20', '2023-08-29', 'IJIN/CUTI', '2025-05-20 06:11:33', '2025-05-20 06:11:33'),
(4, 190, '2025-05-21', '2025-05-28', 'IJIN/CUTI', '2025-05-21 06:01:47', '2025-05-21 06:01:47');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalgurus`
--

CREATE TABLE `jadwalgurus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_jadwalguru` varchar(255) NOT NULL,
  `masuk` varchar(255) NOT NULL,
  `pulang` varchar(255) NOT NULL,
  `keterlambatan` varchar(255) NOT NULL,
  `id_jurusan` bigint(20) UNSIGNED NOT NULL,
  `keterangan` text NOT NULL,
  `hari` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwalgurus`
--

INSERT INTO `jadwalgurus` (`id`, `no_jadwalguru`, `masuk`, `pulang`, `keterlambatan`, `id_jurusan`, `keterangan`, `hari`, `created_at`, `updated_at`) VALUES
(1, 'JG001', '06.32', '12.40', '90', 3, 'JADWAL GURU', 'Senin,Selasa,Rabu,Kamis,Jumat,Sabtu', NULL, NULL),
(2, 'JG002', '06.32', '12.40', '90', 3, 'JADWAL PAK WINARKO', 'Senin,Selasa', NULL, NULL),
(3, 'JG003', '07:00', '13.00', '60', 3, 'JADWAL PAK EDDY', 'Rabu,Kamis,Sabtu', NULL, NULL),
(4, 'JG004', '06.32', '12.40', '90', 3, 'JADWAL BU FEBRI', 'Selasa', NULL, NULL),
(5, 'JG005', '06.32', '12.40', '90', 3, 'JADWAL PAK ZHENITH, PAK DENY, BU RENI', 'Senin,Selasa,Rabu,Kamis,Sabtu', NULL, NULL),
(6, 'JG006', '06.32', '12.40', '90', 3, 'JADWAL PAK PUR', 'Senin,Rabu,Kamis,Sabtu', NULL, NULL),
(7, 'JG007', '06.32', '12.40', '90', 3, 'JADWAL BU ILIYIN', 'Senin,Selasa,Kamis,Jumat,Sabtu', NULL, NULL),
(8, 'JG008', '06.32', '12.40', '90', 3, 'JADWAL PAK DICKY', 'Selasa,Rabu,Kamis,Jumat,Sabtu', NULL, NULL),
(9, 'JG09', '06.32', '12.40', '90', 3, 'JADWAL BU KHOLIF', 'Senin,Selasa,Rabu,Jumat,Sabtu', NULL, NULL),
(10, 'JG10', '06.32', '12.40', '90', 3, 'JADWAL BU WIDYA', 'Senin,Selasa,Rabu,Kamis,Jumat', NULL, NULL),
(11, 'SDS2345', '06.30', '12.30', '120MENIT', 6, 'GHJ', 'ZADSFDGFGH', '2025-05-21 06:00:50', '2025-05-21 06:00:50');

-- --------------------------------------------------------

--
-- Table structure for table `jadwalkaryawans`
--

CREATE TABLE `jadwalkaryawans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_jadwal` varchar(255) NOT NULL,
  `hari` varchar(255) NOT NULL,
  `masuk` varchar(255) NOT NULL,
  `pulang` varchar(255) NOT NULL,
  `keterlambatan` varchar(255) NOT NULL,
  `keterangan` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jadwalkaryawans`
--

INSERT INTO `jadwalkaryawans` (`id`, `no_jadwal`, `hari`, `masuk`, `pulang`, `keterlambatan`, `keterangan`, `created_at`, `updated_at`) VALUES
(1, 'JK001', 'Senin,Selasa,Rabu,Kamis,Jumat,Sabtu', '06.32', '13.00', '120', 'Jadwal Masuk Karyawan', NULL, NULL),
(2, 'ADFW1234', 'HVFGH', '06.30', '12.30', '120MENIT', 'SWERJ', '2025-05-21 06:00:22', '2025-05-21 06:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_jurusan` varchar(255) NOT NULL,
  `jurusan` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `no_jurusan`, `jurusan`, `created_at`, `updated_at`) VALUES
(1, 'AK', 'AKUNTANSI', NULL, NULL),
(2, 'APH', 'AKOMODASI PERHOTELAN', NULL, NULL),
(3, 'GR', 'GURU', NULL, NULL),
(4, 'RPL', 'REKAYASA PERANGKAT LUNAK', NULL, NULL),
(5, 'TN', 'TATA NIAGA', NULL, NULL),
(6, 'CB', 'COBA', '2025-05-21 05:59:33', '2025-05-21 05:59:33');

-- --------------------------------------------------------

--
-- Table structure for table `laporans`
--

CREATE TABLE `laporans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_absensi` int(11) NOT NULL,
  `id_anggota` bigint(20) UNSIGNED NOT NULL,
  `waktu_absen` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `laporans`
--

INSERT INTO `laporans` (`id`, `id_absensi`, `id_anggota`, `waktu_absen`, `created_at`, `updated_at`) VALUES
(15, 123, 172, '2023-06-07 11:39:42', NULL, NULL),
(16, 231, 165, '2023-06-08 11:39:42', NULL, NULL),
(17, 2233, 175, '2023-06-07 12:39:42', NULL, NULL),
(18, 1243, 148, '2023-06-07 11:39:45', NULL, NULL),
(44, 32874, 176, '2023-06-07 11:39:42', NULL, NULL),
(45, 32875, 179, '2023-06-07 12:01:30', NULL, NULL),
(46, 32876, 180, '2023-06-07 12:03:58', NULL, NULL),
(47, 32877, 183, '2023-06-07 12:05:29', NULL, NULL),
(48, 32878, 181, '2023-06-07 12:05:35', NULL, NULL),
(49, 32879, 184, '2023-06-07 12:13:55', NULL, NULL),
(50, 32874, 179, '2023-07-07 11:39:42', NULL, NULL),
(51, 32875, 179, '2023-08-07 11:39:42', NULL, NULL),
(52, 32876, 179, '2023-09-07 11:39:42', NULL, NULL),
(53, 32874, 179, '2023-07-07 11:39:42', NULL, NULL),
(54, 328745, 179, '2023-06-07 13:39:50', NULL, NULL),
(55, 32874, 190, '2025-05-07 06:20:00', NULL, NULL),
(56, 32874, 190, '2025-05-07 13:39:42', NULL, NULL);

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2025_05_14_134635_create_jurusans_table', 1),
(6, '2025_05_15_082903_create_jadwalgurus_table', 1),
(7, '2025_05_15_111322_add_idjurusan_column_to_jadwalgurus_table', 1),
(8, '2025_05_15_132034_create_jadwalkaryawans_table', 1),
(9, '2025_05_16_020540_create_gurus_table', 1),
(10, '2025_05_17_084114_create_ijins_table', 1),
(11, '2025_05_17_125352_create_laporans_table', 1);

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
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '', NULL, '$2y$10$dCwB3rqODQvPxjibP8GS0u5RowUyQ4jCHFgY8hOxIfRVpLki8Ll3O', NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `gurus`
--
ALTER TABLE `gurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gurus_id_jadwalkaryawan_foreign` (`id_jadwalkaryawan`),
  ADD KEY `gurus_id_jurusan_foreign` (`id_jurusan`),
  ADD KEY `gurus_id_jadwalguru_foreign` (`id_jadwalguru`);

--
-- Indexes for table `ijins`
--
ALTER TABLE `ijins`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ijins_id_nama_foreign` (`id_nama`);

--
-- Indexes for table `jadwalgurus`
--
ALTER TABLE `jadwalgurus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jadwalgurus_id_jurusan_foreign` (`id_jurusan`);

--
-- Indexes for table `jadwalkaryawans`
--
ALTER TABLE `jadwalkaryawans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laporans`
--
ALTER TABLE `laporans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `laporans_id_anggota_foreign` (`id_anggota`);

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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `gurus`
--
ALTER TABLE `gurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `ijins`
--
ALTER TABLE `ijins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `jadwalgurus`
--
ALTER TABLE `jadwalgurus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `jadwalkaryawans`
--
ALTER TABLE `jadwalkaryawans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `laporans`
--
ALTER TABLE `laporans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gurus`
--
ALTER TABLE `gurus`
  ADD CONSTRAINT `gurus_id_jadwalguru_foreign` FOREIGN KEY (`id_jadwalguru`) REFERENCES `jadwalgurus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gurus_id_jadwalkaryawan_foreign` FOREIGN KEY (`id_jadwalkaryawan`) REFERENCES `jadwalkaryawans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gurus_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `ijins`
--
ALTER TABLE `ijins`
  ADD CONSTRAINT `ijins_id_nama_foreign` FOREIGN KEY (`id_nama`) REFERENCES `gurus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `jadwalgurus`
--
ALTER TABLE `jadwalgurus`
  ADD CONSTRAINT `jadwalgurus_id_jurusan_foreign` FOREIGN KEY (`id_jurusan`) REFERENCES `jurusans` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `laporans`
--
ALTER TABLE `laporans`
  ADD CONSTRAINT `laporans_id_anggota_foreign` FOREIGN KEY (`id_anggota`) REFERENCES `gurus` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
