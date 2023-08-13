-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2023 at 01:14 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `database_akademik_ta4`
--

-- --------------------------------------------------------

--
-- Table structure for table `daftar_nilais`
--

CREATE TABLE `daftar_nilais` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `judul_kategori` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kategori_tugas` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_tahun_ajaran` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mata_kuliah` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `jadwals`
--

CREATE TABLE `jadwals` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_mata_kuliah_enroll` int(11) DEFAULT NULL,
  `hari` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jam_mulai` time DEFAULT NULL,
  `jam_selesai` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jadwals`
--

INSERT INTO `jadwals` (`id`, `created_at`, `updated_at`, `id_mata_kuliah_enroll`, `hari`, `jam_mulai`, `jam_selesai`) VALUES
(7, '2023-08-13 06:46:55', '2023-08-13 06:46:55', 11, 'minggu', '08:00:00', '14:00:00'),
(8, '2023-08-13 06:58:57', '2023-08-13 06:58:57', 14, 'minggu', '13:00:00', '15:00:00'),
(9, '2023-08-13 06:59:08', '2023-08-13 06:59:08', 15, 'minggu', '13:00:00', '15:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `jadwal_perwalian`
--

CREATE TABLE `jadwal_perwalian` (
  `id` int(12) NOT NULL,
  `keterangan` varchar(255) NOT NULL,
  `id_dosen_wali` int(12) NOT NULL,
  `id_kelas` int(12) NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `jadwal_perwalian`
--

INSERT INTO `jadwal_perwalian` (`id`, `keterangan`, `id_dosen_wali`, `id_kelas`, `tanggal`, `created_at`, `updated_at`) VALUES
(1, 'Keterangan', 25, 15, '2023-08-14', '2023-08-13 14:07:59', '2023-08-13 14:13:58');

-- --------------------------------------------------------

--
-- Table structure for table `jurusans`
--

CREATE TABLE `jurusans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_jurusan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `jurusans`
--

INSERT INTO `jurusans` (`id`, `created_at`, `updated_at`, `nama_jurusan`) VALUES
(1, '2023-07-08 14:28:06', '2023-07-08 14:28:06', 'Manajemen Informatika'),
(4, '2023-07-08 14:28:18', '2023-07-08 14:28:18', 'Agroindustri'),
(5, '2023-07-08 14:28:47', '2023-07-08 14:28:47', 'Kesehatan'),
(6, '2023-07-08 14:28:52', '2023-07-08 14:28:52', 'Teknik Perawatan dan Perbaikan Mesin');

-- --------------------------------------------------------

--
-- Table structure for table `kehadirans`
--

CREATE TABLE `kehadirans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_jadwal` int(11) DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pertemuan` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `jam_masuk_mahasiswa` time NOT NULL DEFAULT '00:00:00',
  `terlambat` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kehadirans`
--

INSERT INTO `kehadirans` (`id`, `created_at`, `updated_at`, `id_jadwal`, `id_mahasiswa`, `deskripsi`, `status`, `pertemuan`, `tanggal`, `jam_masuk_mahasiswa`, `terlambat`) VALUES
(92, '2023-08-13 06:47:41', '2023-08-13 07:06:20', 7, 11, 'Memahami dasar dasar', 'ijin', 1, '2023-08-13', '00:00:00', 0),
(93, '2023-08-13 06:47:41', '2023-08-13 06:47:52', 7, 18, 'Memahami dasar dasar', 'tanpa keterangan', 1, '2023-08-13', '00:00:00', 0),
(94, '2023-08-13 06:47:41', '2023-08-13 06:47:52', 7, 34, 'Memahami dasar dasar', 'hadir', 1, '2023-08-13', '00:00:00', 0),
(95, '2023-08-13 06:47:41', '2023-08-13 06:47:52', 7, 16, 'Memahami dasar dasar', 'hadir', 1, '2023-08-13', '00:00:00', 0),
(96, '2023-08-13 06:48:21', '2023-08-13 06:48:37', 7, 11, 'Memahami dasar dasar 2', 'hadir', 2, '2023-08-16', '00:00:00', 40),
(97, '2023-08-13 06:48:21', '2023-08-13 06:48:37', 7, 18, 'Memahami dasar dasar 2', 'tanpa keterangan', 2, '2023-08-16', '00:00:00', 0),
(98, '2023-08-13 06:48:21', '2023-08-13 06:48:37', 7, 34, 'Memahami dasar dasar 2', 'hadir', 2, '2023-08-16', '00:00:00', 0),
(99, '2023-08-13 06:48:21', '2023-08-13 06:48:37', 7, 16, 'Memahami dasar dasar 2', 'tanpa keterangan', 2, '2023-08-16', '00:00:00', 0),
(100, '2023-08-13 07:00:34', '2023-08-13 07:05:17', 8, 11, 'Memahami dasar dasar', 'sakit', 1, '2023-08-13', '00:00:00', 0),
(101, '2023-08-13 07:01:42', '2023-08-13 07:01:51', 9, 11, 'Mehami', 'hadir', 1, '2023-08-13', '00:00:00', 50),
(102, '2023-08-13 15:18:48', '2023-08-13 15:18:48', 7, 11, 'sdgsdgss', NULL, 3, '2023-08-15', '00:00:00', 0),
(103, '2023-08-13 15:18:48', '2023-08-13 15:18:48', 7, 18, 'sdgsdgss', NULL, 3, '2023-08-15', '00:00:00', 0),
(106, '2023-08-13 15:21:58', '2023-08-13 15:21:58', 7, 11, 'dsgsdgsdgsd', NULL, 4, '2023-08-17', '00:00:00', 0),
(107, '2023-08-13 15:21:58', '2023-08-13 15:21:58', 7, 18, 'dsgsdgsdgsd', NULL, 4, '2023-08-17', '00:00:00', 0),
(108, '2023-08-13 15:21:58', '2023-08-13 15:21:58', 7, 34, 'dsgsdgsdgsd', NULL, 4, '2023-08-17', '00:00:00', 0),
(109, '2023-08-13 15:21:58', '2023-08-13 15:21:58', 7, 16, 'dsgsdgsdgsd', NULL, 4, '2023-08-17', '00:00:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_tahun_ajaran` int(11) DEFAULT NULL,
  `angkatan` int(11) NOT NULL,
  `nama_kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode_kelas` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_dosen_wali` int(11) DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id`, `created_at`, `updated_at`, `id_tahun_ajaran`, `angkatan`, `nama_kelas`, `status`, `kode_kelas`, `id_dosen_wali`, `id_prodi`) VALUES
(15, '2023-08-05 13:54:43', '2023-08-13 13:38:20', 7, 2021, 'Sistem Informasi 1A', 'aktif', 'SI1A01', 25, 1),
(16, '2023-08-06 19:20:41', '2023-08-13 13:38:01', 8, 2021, 'Sistem Informasi 1A', 'tidak aktif', 'SI1A02', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `kelas_enrolls`
--

CREATE TABLE `kelas_enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `kelas_enrolls`
--

INSERT INTO `kelas_enrolls` (`id`, `created_at`, `updated_at`, `id_mahasiswa`, `id_kelas`) VALUES
(10, '2023-08-13 06:41:36', '2023-08-13 06:41:36', 11, 15),
(11, '2023-08-13 06:43:29', '2023-08-13 06:43:29', 18, 15),
(12, '2023-08-13 06:43:48', '2023-08-13 06:43:48', 34, 15),
(13, '2023-08-13 06:44:17', '2023-08-13 06:44:17', 16, 15),
(14, '2023-08-13 06:56:57', '2023-08-13 06:56:57', 11, 16);

-- --------------------------------------------------------

--
-- Table structure for table `mahasiswa_mata_kuliah_enrolls`
--

CREATE TABLE `mahasiswa_mata_kuliah_enrolls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mata_kuliah_enroll` bigint(20) UNSIGNED NOT NULL,
  `id_mahasiswa` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mahasiswa_mata_kuliah_enrolls`
--

INSERT INTO `mahasiswa_mata_kuliah_enrolls` (`id`, `id_mata_kuliah_enroll`, `id_mahasiswa`, `created_at`, `updated_at`) VALUES
(19, 11, 11, '2023-08-13 06:46:55', '2023-08-13 06:46:55'),
(20, 11, 18, '2023-08-13 06:46:55', '2023-08-13 06:46:55'),
(21, 11, 34, '2023-08-13 06:46:55', '2023-08-13 06:46:55'),
(22, 11, 16, '2023-08-13 06:46:55', '2023-08-13 06:46:55'),
(23, 14, 11, '2023-08-13 06:58:57', '2023-08-13 06:58:57'),
(24, 15, 11, '2023-08-13 06:59:08', '2023-08-13 06:59:08');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliahs`
--

CREATE TABLE `mata_kuliahs` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama_mata_kuliah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_prodi` int(11) DEFAULT NULL,
  `kode_mata_kuliah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sks` int(11) DEFAULT NULL,
  `semester` int(11) NOT NULL DEFAULT 0,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mata_kuliahs`
--

INSERT INTO `mata_kuliahs` (`id`, `created_at`, `updated_at`, `nama_mata_kuliah`, `id_prodi`, `kode_mata_kuliah`, `sks`, `semester`, `status`) VALUES
(5, '2023-07-08 16:22:03', '2023-08-13 03:50:11', 'PENDIDIKAN AGAMA', 1, 'PMU0001', 3, 1, 'aktif'),
(6, '2023-07-08 16:22:31', '2023-07-16 02:29:57', 'PEMROGRAMAN DASAR 1', 1, 'PSI3104', 4, 1, 'aktif'),
(7, '2023-07-08 16:22:59', '2023-07-16 02:30:02', 'PENGANTAR TEKNOLOGI INFORMASI DAN KOMUNIKASI', 1, 'PSI3102', 4, 1, 'aktif'),
(8, '2023-07-08 16:23:19', '2023-07-16 02:30:07', 'PENGANTAR AKUNTANSI', 1, 'PSI3206', 2, 2, 'aktif'),
(9, '2023-07-08 16:23:41', '2023-07-16 02:30:11', 'PEMROGRAMAN DASAR 2', 1, 'PSI3204', 4, 2, 'aktif'),
(10, '2023-07-08 16:24:09', '2023-07-16 02:30:16', 'PROJEK 1', 1, 'PMI0004', 2, 2, 'aktif'),
(13, '2023-07-08 16:25:32', '2023-07-16 02:30:29', 'BASIS DATA 1', 1, 'PSI3302', 4, 3, 'aktif'),
(14, '2023-07-08 16:26:00', '2023-08-06 18:31:38', 'ANALISIS DAN PERANCANGAN SISTEM INFORMASI 1', 1, 'PSI3401', 2, 3, 'aktif'),
(15, '2023-07-08 16:26:15', '2023-07-16 02:30:39', 'PEMROGRAMAN WEB', 1, 'PSI3403', 3, 4, 'aktif'),
(16, '2023-07-08 16:26:28', '2023-07-16 02:30:45', 'PROJEK 2', 1, 'PMI0005', 4, 4, 'aktif'),
(17, '2023-07-08 16:27:00', '2023-07-16 02:30:51', 'SISTEM PENGAMBIL KEPUTUSAN', 1, 'PSI3504', 3, 5, 'aktif'),
(18, '2023-07-08 16:27:18', '2023-07-16 02:30:59', 'ANALISIS DAN PERANCANGAN SISTEM INFORMASI 2', 1, 'PSI3501', 5, 5, 'aktif'),
(19, '2023-07-08 16:27:48', '2023-07-16 02:31:05', 'DATA MINING', 1, 'PSI3502', 3, 5, 'aktif'),
(20, '2023-07-08 16:28:06', '2023-07-16 02:31:10', 'MANAJEMEN PROYEK', 1, 'PSI6602', 3, 6, 'aktif'),
(21, '2023-07-08 16:28:28', '2023-07-16 02:31:15', 'KEWIRAUSAHAAN', 1, 'PSI6601', 3, 6, 'aktif'),
(22, '2023-07-08 16:28:40', '2023-07-16 02:31:21', 'ECOMMERCE', 1, 'PSI6604', 4, 6, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `mata_kuliah_enrolls`
--

CREATE TABLE `mata_kuliah_enrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_kelas` int(11) DEFAULT NULL,
  `id_mata_kuliah` int(11) DEFAULT NULL,
  `id_dosen` int(11) DEFAULT NULL,
  `status_dosen` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mata_kuliah_enrolls`
--

INSERT INTO `mata_kuliah_enrolls` (`id`, `created_at`, `updated_at`, `id_kelas`, `id_mata_kuliah`, `id_dosen`, `status_dosen`) VALUES
(11, '2023-08-13 06:45:16', '2023-08-13 06:45:16', 15, 5, 23, 'aktif'),
(12, '2023-08-13 06:45:35', '2023-08-13 06:45:35', 15, 6, 23, 'aktif'),
(13, '2023-08-13 06:45:58', '2023-08-13 06:45:58', 15, 7, 23, 'aktif'),
(14, '2023-08-13 06:57:31', '2023-08-13 06:57:31', 16, 8, 23, 'aktif'),
(15, '2023-08-13 06:58:14', '2023-08-13 06:58:14', 16, 9, 23, 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2023_05_10_141547_create_roles_table', 1),
(3, '2023_06_14_022801_create_jurusans_table', 1),
(4, '2023_06_14_022906_create_tahun_ajarans_table', 1),
(5, '2023_06_14_022928_create_program_studis_table', 1),
(6, '2023_06_14_022950_create_mata_kuliahs_table', 1),
(7, '2023_06_14_023024_create_nilais_table', 1),
(8, '2023_06_14_023049_create_kehadirans_table', 1),
(9, '2023_06_14_023151_create_jadwals_table', 1),
(10, '2023_06_14_023224_create_mata_kuliah_enrolls_table', 1),
(11, '2023_06_14_023243_create_kelas_table', 1),
(12, '2023_06_14_023301_create_kelas_enrolls_table', 1),
(13, '2023_06_15_051738_create_mahasiswa_mata_kuliah_enrolls_table', 1),
(14, '2023_06_16_032217_daftar_nilai', 1),
(15, '2023_06_19_012224_create_perwalians_table', 1),
(16, '2023_07_02_025320_modify_mata_kuliah_enrolls_table', 1),
(17, '2023_07_02_030837_create_sp_table', 1),
(18, '2023_07_03_041513_add_judul_nilai_to_daftar_nilai_table', 1),
(19, '2023_07_03_095840_change_status_at_kehadirans_table', 1),
(20, '2023_07_03_140800_create_orang_tua_table', 1),
(21, '2023_07_05_041548_modify_sp_table', 1),
(22, '2023_07_07_175656_add_status_at_mata_kuliah_table', 2),
(23, '2023_07_07_181528_add_status_at_kelas_table', 2),
(24, '2023_07_09_094302_modify_jadwal_table', 2),
(25, '2023_07_09_095301_add_terlambat_at_kehadiran', 2),
(26, '2023_07_10_173005_modify_kehadirans_table', 2),
(27, '2023_07_12_165357_add_semester_at_mata_kuliah', 3),
(28, '2023_07_13_120608_modify_nilai', 3),
(29, '2023_07_15_173205_modifify_kelas_table', 3),
(30, '2014_10_12_100000_create_password_resets_table', 4),
(31, '2023_07_20_011212_alter_sp_table', 5),
(32, '2023_07_23_052002_add_status_user_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `nilais`
--

CREATE TABLE `nilais` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_daftar_nilai` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_mahasiswa` int(11) DEFAULT NULL,
  `nilai` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `orang_tua`
--

CREATE TABLE `orang_tua` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_mahasiswa` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nim_mahasiswa` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `orang_tua`
--

INSERT INTO `orang_tua` (`id`, `id_mahasiswa`, `name`, `email`, `nim_mahasiswa`, `password`, `address`, `phone_number`, `gender`, `created_at`, `updated_at`) VALUES
(1, 11, 'Ides Legiatawi', 'legiawati@gmail.com', 'P10107040', '$2y$10$i6T10.fSRP0fHiM.RSi/WutH7JEa/iUmZokdJjBFiKwa25ggm/4Lm', 'Purwadadi Subang', '083195739340', 'Laki-laki', '2023-07-10 18:13:17', '2023-07-10 18:13:17'),
(2, 20, 'Orang tua Taupik', 'orangtuataupik@gmail.com', 'P10107043', '$2y$10$6jpiduFaU1gZnl1tiJWRbO1NZUUQrpiHrauTxmg.PqClI7BZQWDnG', 'Jakarta', '083195739340', 'Laki-laki', '2023-07-12 20:31:17', '2023-07-12 20:31:17'),
(3, 15, 'Orang tua rafki', 'orturafki@gmail.com', 'P10107042', '$2y$10$I9w9Q9Pnpbn56xAEm.GvgOeR24A5/SNFoAI7RtRVWV8ocDhDXXzbK', 'Bekasi Barat', '083195739340', 'Laki-laki', '2023-07-16 10:52:07', '2023-07-16 10:52:07'),
(4, 33, 'Orang tua Rahma', 'orturahma@gmail.com', 'P10107044', '$2y$10$HLI/Va/QrjB8j/ynJiecr./hgIf1iFTDxlYpxnBo.ERV3Uia2cujO', 'Purwadadi Subang', '083195739340', 'Laki-laki', '2023-07-25 21:19:44', '2023-07-25 21:19:44'),
(10, 13, 'alan walker', 'aw@gmail.ocm', 'P10107046', '$2y$10$X1I1I1TWwoHnT3I04A2MZu5CxDRZ1JvkpvSvZiXWuZgaAF8fhcA9m', 'adasdasdafsd', '123123', 'Laki-laki', '2023-08-03 16:03:07', '2023-08-03 16:03:07');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('paganim17@gmail.com', '$2y$10$ZFztecUrWklofEDRBjnEGucgWwE3TeyzZc878t12.ZkJHti/THHIu', '2023-07-22 17:07:16'),
('muhammadelang030415@gmail.com', '$2y$10$6ATLQPHvkaOClMKPTx4h.OjHxehmymI.lQjG0yBe30ZYzgPpAuClm', '2023-07-23 01:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `perwalians`
--

CREATE TABLE `perwalians` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_jadwal_perwalian` int(12) NOT NULL,
  `id_kelas` bigint(20) UNSIGNED NOT NULL,
  `id_mahasiswa` bigint(20) UNSIGNED NOT NULL,
  `keluhan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `balasan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `program_studis`
--

CREATE TABLE `program_studis` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `id_jurusan` int(11) DEFAULT NULL,
  `nama_prodi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `program_studis`
--

INSERT INTO `program_studis` (`id`, `created_at`, `updated_at`, `id_jurusan`, `nama_prodi`) VALUES
(1, NULL, '2023-07-08 14:29:03', 1, 'Sistem Informasi'),
(2, NULL, '2023-07-08 14:29:09', 1, 'Rekayasa Perangkat Lunak'),
(3, '2023-07-08 14:29:16', '2023-07-08 14:29:16', 4, 'Agroindustri'),
(4, '2023-07-08 14:29:22', '2023-07-08 14:29:22', 5, 'Keperawatan'),
(5, '2023-07-08 14:29:29', '2023-07-08 14:29:29', 6, 'Pemeliharaan Mesin'),
(6, '2023-07-08 14:29:47', '2023-07-08 14:29:47', 6, 'Teknologi Rekayasa Manufaktur'),
(7, '2023-07-17 06:42:10', '2023-07-17 06:42:10', 4, 'Teknologi Produksi Tanaman Pangan');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `created_at`, `updated_at`, `role_name`) VALUES
(1, NULL, NULL, 'admin polsub'),
(2, NULL, NULL, 'admin jurusan'),
(3, NULL, NULL, 'dosen'),
(4, NULL, NULL, 'mahasiswa'),
(5, NULL, NULL, 'orang tua');

-- --------------------------------------------------------

--
-- Table structure for table `sp`
--

CREATE TABLE `sp` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_kelas` int(10) UNSIGNED NOT NULL,
  `deskripsi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_user_penerima` int(10) UNSIGNED NOT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `jenis_sp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `tahun_ajarans`
--

CREATE TABLE `tahun_ajarans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tahun` int(11) DEFAULT NULL,
  `semester` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `tahun_ajarans`
--

INSERT INTO `tahun_ajarans` (`id`, `created_at`, `updated_at`, `tahun`, `semester`) VALUES
(1, '2023-07-08 07:56:31', '2023-07-08 07:56:31', 2023, 1),
(2, '2023-07-08 07:56:37', '2023-07-08 07:56:37', 2023, 2),
(3, '2023-07-08 07:56:44', '2023-07-17 07:02:51', 2023, 3),
(4, '2023-07-08 07:56:49', '2023-07-17 07:02:56', 2023, 4),
(5, '2023-07-08 07:56:55', '2023-07-17 07:03:01', 2023, 5),
(6, '2023-07-08 07:56:59', '2023-07-17 07:03:09', 2023, 6),
(7, '2023-07-08 14:39:58', '2023-07-08 15:38:01', 2022, 1),
(8, '2023-07-08 14:40:03', '2023-07-08 15:38:06', 2022, 2),
(9, '2023-07-08 14:40:09', '2023-07-08 15:38:10', 2022, 3),
(10, '2023-07-08 14:40:15', '2023-07-08 15:38:18', 2022, 4),
(11, '2023-07-08 14:40:22', '2023-07-08 15:38:25', 2022, 5),
(12, '2023-07-08 14:40:27', '2023-07-08 15:38:32', 2022, 6),
(13, '2023-07-17 07:03:25', '2023-07-17 07:03:25', 2022, 5),
(14, '2023-07-17 07:03:30', '2023-07-17 07:03:30', 2022, 6),
(15, '2023-07-17 07:06:56', '2023-07-17 07:06:56', 2024, 1),
(16, '2023-07-17 07:07:08', '2023-07-17 07:07:08', 2024, 2),
(17, '2023-07-17 07:07:13', '2023-07-17 07:07:13', 2024, 3),
(18, '2023-07-17 07:07:18', '2023-07-17 07:07:18', 2024, 4),
(19, '2023-07-17 07:07:24', '2023-07-17 07:07:24', 2024, 5),
(20, '2023-07-17 07:07:30', '2023-07-17 07:07:30', 2024, 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `identity_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_prodi` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'aktif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `identity_number`, `id_role`, `password`, `address`, `phone_number`, `gender`, `id_prodi`, `created_at`, `updated_at`, `status`) VALUES
(6, 'Admin Jurusan Kesehatan', 'adminjurusankesehatan@gmail.com', '10101010', '2', '$2y$10$8zaC/IiXVZBCfkiv6aFGB.KfoBJmLDCQsIlcdm2qSEGx3DqQkM/36', 'Purwadadi Subang', '083195739340', 'Laki-laki', '4', '2023-07-08 14:42:31', '2023-07-08 14:42:46', 'aktif'),
(7, 'Admin Jurusan Manajemen Informatika', 'adminjurusaninformatik@gmail.com', '20202020', '2', '$2y$10$x8J1.QvccnGEZr9FyztQvOquLvYcpUY393CbswBxcxop8eUcFUs.G', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:43:41', '2023-08-06 21:25:40', 'aktif'),
(8, 'Admin Jurusan Agroindustri', 'adminjurusanagro@gmail.com', '30303030', '2', '$2y$10$9bFXUjyF/MCqefHUMLseBeWryT.6gyMrIznv8YtjSXq4R/GGqeD8y', 'Purwadadi Subang', '083195739340', 'Laki-laki', '3', '2023-07-08 14:44:34', '2023-07-08 14:44:34', 'aktif'),
(10, 'Admin Jurusan Teknik Perawatan dan Perbaikan Mesin', 'adminjurusanmesin@gmail.com', '40404040', '2', '$2y$10$eUeA7Fgdn2mWHgBAWBNxyutpCKjvH/AS9QVWEhJktHweKnJWme/Ea', 'Purwadadi Subang', '083195739340', 'Laki-laki', '5', '2023-07-08 14:47:11', '2023-07-08 14:47:11', 'aktif'),
(11, 'Muhammad Elang Belanegara', 'muhammadelang030415@gmail.com', '10107040', '4', '$2y$10$umpee6Z3tt4NaMBBxMSDROUz17FR/HsYLsAle.MwvUPQ46fUiwb/q', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:52:03', '2023-07-08 14:52:03', 'aktif'),
(12, 'Beni Nuryahya', 'beninuryahya@gmail.com', '10107012', '4', '$2y$10$umpee6Z3tt4NaMBBxMSDROUz17FR/HsYLsAle.MwvUPQ46fUiwb/q', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:52:57', '2023-07-08 14:52:57', 'aktif'),
(13, 'Putri Fitriani', 'putrifitriani@gmail.com', '10107046', '4', '$2y$10$WfI6SkD7G6EWAZC2pdGU5urxBJqh0fThSbOaktWCwSn4D3hDH64Gi', 'Purwadadi Subang', '083195739340', 'Perempuan', '1', '2023-07-08 14:53:37', '2023-07-08 14:53:37', 'aktif'),
(14, 'Teresia Fransiska', 'Teresiafransiska@gmail.com', '10107060', '4', '$2y$10$P7R/W8JHPFiHhogHOeQCHecL6/0KrXM/x67Ct8dY0bjZEtPBfrcru', 'Purwadadi Subang', '083195739340', 'Perempuan', '1', '2023-07-08 14:54:31', '2023-07-08 14:54:31', 'aktif'),
(15, 'Muhammad Rafki Fauz Nasywa', 'muhammadrafki@gmail.com', '10107042', '4', '$2y$10$AsvKJxtXs57V/l2m59KMdu463uryCaOh3x18A3Rfmuuirc4heiBwm', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:55:09', '2023-07-08 14:55:09', 'aktif'),
(16, 'Farras Insan Nurhidayat', 'farrasinsan@gmail.com', '10107028', '4', '$2y$10$obVFp2cQED/jONJqkC3SdukULUXmksSkScij74W7DEhWdcck/.wEi', 'Purwadadi Subang', '83195739339', 'Laki-laki', '1', '2023-07-08 14:55:46', '2023-07-08 14:55:46', 'aktif'),
(17, 'Renaldi Noviandi', 'renaldinoviandi@gmail.com', '10107050', '4', '$2y$10$5KQr2993hxughafOFAewreKn98retAK6bCK9Xk5NA28Tyq2td1dZy', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:56:24', '2023-07-08 14:56:24', 'aktif'),
(18, 'Fajar Gunawan', 'fajargunawan@gmail.com', '10107026', '4', '$2y$10$GG2VvU6BgfBWyO5YMGLat.llQsfpSWownJacUfkc9RbWrKKBdhHgC', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:57:55', '2023-07-08 14:57:55', 'aktif'),
(19, 'Adi Sudrajat1', 'adisudrajat@gmail.com', '10107002', '4', '$2y$10$rycdnnm6IL7teB4QNcUS4Oqn1GSEJkhI6Os77fYJzANqSmQBDZTii', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:58:43', '2023-08-13 03:02:26', 'aktif'),
(20, 'Taupik Herdiansyah', 'taupikherdiansyah@gmail.com', '10107043', '4', '$2y$10$U8LYZOYMs4tFrxwGjijFO.x3di9kr4KohjyutfDk1y4nfWFILtxjO', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:59:25', '2023-07-08 14:59:25', 'aktif'),
(21, 'Nunu Nugraha P., S.Pd., M.Kom. Update', 'dosennunu@gmail.com', '197909152015041001', '3', '$2y$10$lnVRb66AHCCOkKnoODgcIexDR7H1DSf7w7O7MEpLWp5TVn72eSZrS', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:29:53', '2023-08-06 07:18:55', 'aktif'),
(22, 'Tri Herdiawan A., S.ST., M.T.', 'dosentri@gmail.com', '198801052019031008', '3', '$2y$10$pgGbF.b0.O1Oh7EaXKTnWeL60Q6T85OHZ3c9Kp6.khw1p5tTTbUnO', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:30:54', '2023-07-08 15:30:54', 'aktif'),
(23, 'Rian Piarna, S.E., MM.', 'dosenrian@gmail.com', '198709032019031009', '3', '$2y$10$kbKWIPXW2LTyZ0yfq5edNeVJsz8avcU4dc08.wvlxmAgGc6Wl8CTK', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:31:37', '2023-07-08 15:31:37', 'aktif'),
(24, 'Mohammad Iqbal, S.Kom., M.T.', 'doseniqbal@gmail.com', '199001262019031025', '3', '$2y$10$ZGVGJ/i2HUOEVABT9rA1JueEk.U2S6oP1jtJvsBMi8Ryxdxsb2HPS', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:32:14', '2023-07-08 15:32:14', 'aktif'),
(25, 'Dwi Vernanda, S.T., M.Pd.', 'dosendwi@gmail.com', '199104302019032018', '3', '$2y$10$PA87Ay9Lmt6nCe9XnBFf9uAuReGUHMUMSIwYBYhshGmboN.HVEBeG', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:33:04', '2023-07-08 15:33:04', 'aktif'),
(26, 'Slamet Rahayu, S.Pd., M.Pd.', 'dosenslamet@gmail.com', '170900045', '3', '$2y$10$FZOxBs/rcUzbpwVbpNjCMeJNuvgycqr6Infpn8fdppvifyjGmxc7G', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:33:39', '2023-07-08 15:33:39', 'aktif'),
(27, 'Lani Nurlani, S.T., M.Kom', 'dosenlani@gmail.com', '198803042022032002', '3', '$2y$10$x.V0lJI0EUcN2kjOb9ktfep2xnnoLkBKE23/fakapu2dZ5d8yt5Gy', 'Purwadadi Subang', '083195739340', 'Perempuan', '1', '2023-07-08 15:35:07', '2023-07-08 15:35:07', 'aktif'),
(28, 'Nurfitria Khoirunnisa, S.Tr.Kom., M.Kom.', 'dosennurfitria@gmail.com', '199603112020122022', '3', '$2y$10$pSiZF5C8HIfNb0LsTQa9eO3ApyCYA0fTZLrkHhQB5wbWhSod7Vbyy', 'Purwadadi Subang', '083195739340', 'Perempuan', '1', '2023-07-08 15:35:44', '2023-07-08 15:35:44', 'aktif'),
(29, 'Sari Azhariyah, S.Pd, M.Pd.T', 'dosensari@gmail.com', '199408182022032017', '3', '$2y$10$4/XbRjorAUDrN6DLyBiOqec6BxKh2RX5AgDNDrFPRpsEnJG0tyXou', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:36:27', '2023-07-08 15:36:27', 'aktif'),
(30, 'Taufan Abdurrachman, S.T., M.Kom', 'dosentaufan@gmail.com', '199311112022031006', '3', '$2y$10$MqcI7F5mvACJc3CYBDuQzOLXBVXYYOP5IQOm1uuMINa10IjFmUxLa', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:37:13', '2023-07-08 15:37:13', 'aktif'),
(31, 'Admin Politeknik Negeri Subang', 'adminpolsub@gmail.com', '50505050', '1', '$2y$10$/MN9us3irCPntnaDY7WKwOf2vhXJbLhcGNKrmkdEC9SqutDyQxe0O', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 15:44:30', '2023-08-12 00:53:49', 'aktif'),
(33, 'Rahma Kurnia', 'rahma@gmail.com', '10107044', '4', '$2y$10$8sbrQwPRea3zIHOBBsInveYXRito9sIraijOAtVutJaFU2ChSrYya', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-25 08:50:34', '2023-07-25 08:50:34', 'aktif'),
(34, 'Bagas Kurniawan', 'bagas@gmail.com', '10107045', '4', '$2y$10$3139w/zrHqadagYkZs.jxeZAnTbW1Xhg3eAkvYEKixK0..J8bkxuS', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-26 06:22:42', '2023-07-26 06:22:42', 'aktif'),
(35, 'Test Mahasiswa', 'test@gmail.com', '101601578852', '4', '$2y$10$qFr9j5NYUJWFkcxmCVUXMe7o.cX85HrfHZmPD6mymXqxJNP5TpsWe', 'Jalan mana aja', '089670566669', 'Laki-laki', '1', '2023-08-03 13:08:57', '2023-08-03 13:08:57', 'aktif'),
(36, 'Tika Perawat', 'tikaperawat1@gmail.com', '10107000', '4', '$2y$10$3pS0VBfHPoby/6Ba/kNMReNX5gzZQ2JEvogvDeM75ScvDwtRsMSvq', 'Subang', '083195739340', 'Perempuan', '4', '2023-08-12 00:50:49', '2023-08-12 00:50:49', 'aktif');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `daftar_nilais`
--
ALTER TABLE `daftar_nilais`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jadwals`
--
ALTER TABLE `jadwals`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `jadwal_perwalian`
--
ALTER TABLE `jadwal_perwalian`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jurusans`
--
ALTER TABLE `jurusans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kehadirans`
--
ALTER TABLE `kehadirans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `kelas_enrolls`
--
ALTER TABLE `kelas_enrolls`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mahasiswa_mata_kuliah_enrolls`
--
ALTER TABLE `mahasiswa_mata_kuliah_enrolls`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `mata_kuliah_enrolls`
--
ALTER TABLE `mata_kuliah_enrolls`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `nilais`
--
ALTER TABLE `nilais`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `orang_tua`
--
ALTER TABLE `orang_tua`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `orang_tua_email_unique` (`email`) USING BTREE;

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`) USING BTREE;

--
-- Indexes for table `perwalians`
--
ALTER TABLE `perwalians`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `program_studis`
--
ALTER TABLE `program_studis`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `sp`
--
ALTER TABLE `sp`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD UNIQUE KEY `users_email_unique` (`email`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `daftar_nilais`
--
ALTER TABLE `daftar_nilais`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `jadwals`
--
ALTER TABLE `jadwals`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `jadwal_perwalian`
--
ALTER TABLE `jadwal_perwalian`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kehadirans`
--
ALTER TABLE `kehadirans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kelas_enrolls`
--
ALTER TABLE `kelas_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `mahasiswa_mata_kuliah_enrolls`
--
ALTER TABLE `mahasiswa_mata_kuliah_enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mata_kuliah_enrolls`
--
ALTER TABLE `mata_kuliah_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `nilais`
--
ALTER TABLE `nilais`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `orang_tua`
--
ALTER TABLE `orang_tua`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `perwalians`
--
ALTER TABLE `perwalians`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_studis`
--
ALTER TABLE `program_studis`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `sp`
--
ALTER TABLE `sp`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tahun_ajarans`
--
ALTER TABLE `tahun_ajarans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
