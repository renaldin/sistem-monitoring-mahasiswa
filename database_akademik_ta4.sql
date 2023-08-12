-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 12, 2023 at 02:54 AM
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

--
-- Dumping data for table `daftar_nilais`
--

INSERT INTO `daftar_nilais` (`id`, `judul_kategori`, `kategori_tugas`, `id_tahun_ajaran`, `id_kelas`, `id_mata_kuliah`, `created_at`, `updated_at`) VALUES
(1, 'Tugas 1', 'tugas/kuis', '1', 15, 5, '2023-08-06 18:41:35', '2023-08-06 18:41:35'),
(2, 'Tugas 2', 'tugas/kuis', '1', 15, 5, '2023-08-06 18:42:03', '2023-08-06 18:42:03'),
(3, 'Lain lain', 'nilai lain lain', '1', 15, 5, '2023-08-06 18:43:49', '2023-08-06 18:43:49'),
(4, 'UTS', 'UTS', '1', 15, 5, '2023-08-06 18:46:02', '2023-08-06 18:46:02'),
(5, 'UAS', 'UAS', '1', 15, 5, '2023-08-06 18:46:22', '2023-08-06 18:46:22'),
(6, 'UTS', 'UTS', '1', 15, 6, '2023-08-06 19:09:52', '2023-08-06 19:09:52'),
(9, 'UAS', 'UAS', '1', 15, 6, '2023-08-06 19:12:05', '2023-08-06 19:12:05'),
(10, 'Lain lain', 'nilai lain lain', '1', 15, 6, '2023-08-06 19:12:27', '2023-08-06 19:12:27'),
(11, 'UTS', 'UTS', '1', 15, 7, '2023-08-06 19:13:11', '2023-08-06 19:13:11'),
(12, 'UAS', 'UAS', '1', 15, 7, '2023-08-06 19:13:30', '2023-08-06 19:13:30'),
(13, 'Lain lain', 'nilai lain lain', '1', 15, 7, '2023-08-06 19:13:50', '2023-08-06 19:13:50'),
(14, 'UTS', 'UTS', '8', 16, 8, '2023-08-06 19:41:45', '2023-08-06 19:41:45'),
(15, 'UAS', 'UAS', '8', 16, 8, '2023-08-06 19:42:19', '2023-08-06 19:42:19'),
(16, 'Lain lain', 'nilai lain lain', '8', 16, 8, '2023-08-06 19:42:38', '2023-08-06 19:42:38'),
(17, 'UTS', 'UTS', '8', 16, 9, '2023-08-06 19:44:19', '2023-08-06 19:44:19'),
(18, 'UAS', 'UAS', '8', 16, 9, '2023-08-06 19:44:34', '2023-08-06 19:44:34'),
(19, 'Lain lain', 'nilai lain lain', '8', 16, 9, '2023-08-06 19:44:46', '2023-08-06 19:44:46');

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
(1, '2023-08-06 18:33:05', '2023-08-06 18:33:05', 1, 'senin', '00:10:00', '05:00:00'),
(2, '2023-08-06 18:33:19', '2023-08-06 18:33:19', 2, 'senin', '00:00:00', '20:00:00'),
(3, '2023-08-06 18:33:50', '2023-08-06 18:33:50', 3, 'senin', '01:00:00', '03:00:00'),
(4, '2023-08-06 19:36:38', '2023-08-06 19:36:38', 4, 'rabu', '09:00:00', '10:00:00'),
(5, '2023-08-06 19:36:50', '2023-08-10 14:40:15', 5, 'kamis', '21:00:00', '23:00:00'),
(6, '2023-08-06 19:37:05', '2023-08-06 19:37:05', 6, 'rabu', '06:00:00', '08:00:00');

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
(1, 'Perwalian Akademik  Semester 1 Tahun 2021', 25, 15, '2023-08-08', '2023-08-06 19:16:28', '2023-08-06 19:16:28'),
(2, 'Perwalian Akademik  Semester 2 Tahun 2022', 25, 16, '2023-08-07', '2023-08-06 19:38:37', '2023-08-06 19:38:37');

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
(1, '2023-08-06 18:35:40', '2023-08-06 18:35:54', 1, 11, 'Pertemuan 1 memahami dasar dasar', 'hadir', 1, '2023-08-07', '00:00:00', 0),
(2, '2023-08-06 18:35:41', '2023-08-06 18:35:54', 1, 34, 'Pertemuan 1 memahami dasar dasar', 'tanpa keterangan', 1, '2023-08-07', '00:00:00', 0),
(3, '2023-08-06 18:35:41', '2023-08-06 18:35:54', 1, 12, 'Pertemuan 1 memahami dasar dasar', 'hadir', 1, '2023-08-07', '00:00:00', 0),
(4, '2023-08-06 18:35:41', '2023-08-06 18:35:54', 1, 20, 'Pertemuan 1 memahami dasar dasar', 'tanpa keterangan', 1, '2023-08-07', '00:00:00', 0),
(5, '2023-08-06 18:35:41', '2023-08-06 18:35:54', 1, 33, 'Pertemuan 1 memahami dasar dasar', 'hadir', 1, '2023-08-07', '00:00:00', 0),
(6, '2023-08-06 18:37:37', '2023-08-07 08:23:00', 1, 11, 'Pertemuan 2 Memahami agama islam lebih dalam', 'hadir', 2, '2023-08-14', '00:00:00', 200),
(7, '2023-08-06 18:37:37', '2023-08-06 18:40:25', 1, 34, 'Pertemuan 2 Memahami agama islam lebih dalam', 'tanpa keterangan', 2, '2023-08-14', '00:00:00', 0),
(8, '2023-08-06 18:37:37', '2023-08-06 18:40:25', 1, 12, 'Pertemuan 2 Memahami agama islam lebih dalam', 'hadir', 2, '2023-08-14', '00:00:00', 0),
(9, '2023-08-06 18:37:37', '2023-08-06 18:40:25', 1, 20, 'Pertemuan 2 Memahami agama islam lebih dalam', 'hadir', 2, '2023-08-14', '00:00:00', 0),
(10, '2023-08-06 18:37:38', '2023-08-06 18:40:25', 1, 33, 'Pertemuan 2 Memahami agama islam lebih dalam', 'hadir', 2, '2023-08-14', '00:00:00', 0),
(11, '2023-08-06 18:40:57', '2023-08-06 18:41:12', 1, 11, 'Memahami Al - Quran dan isinya', 'hadir', 3, '2023-08-28', '00:00:00', 10),
(12, '2023-08-06 18:40:57', '2023-08-06 18:41:12', 1, 34, 'Memahami Al - Quran dan isinya', 'tanpa keterangan', 3, '2023-08-28', '00:00:00', 0),
(13, '2023-08-06 18:40:57', '2023-08-06 18:41:12', 1, 12, 'Memahami Al - Quran dan isinya', 'hadir', 3, '2023-08-28', '00:00:00', 0),
(14, '2023-08-06 18:40:57', '2023-08-06 18:41:12', 1, 20, 'Memahami Al - Quran dan isinya', 'tanpa keterangan', 3, '2023-08-28', '00:00:00', 0),
(15, '2023-08-06 18:40:57', '2023-08-06 18:41:12', 1, 33, 'Memahami Al - Quran dan isinya', 'hadir', 3, '2023-08-28', '00:00:00', 0),
(16, '2023-08-06 18:49:43', '2023-08-06 18:50:28', 1, 11, 'Pembacaan Tajwid', 'hadir', 4, '2023-09-04', '00:00:00', 100),
(17, '2023-08-06 18:49:44', '2023-08-06 18:50:03', 1, 34, 'Pembacaan Tajwid', 'ijin', 4, '2023-09-04', '00:00:00', 0),
(18, '2023-08-06 18:49:44', '2023-08-06 18:50:03', 1, 12, 'Pembacaan Tajwid', 'tanpa keterangan', 4, '2023-09-04', '00:00:00', 0),
(19, '2023-08-06 18:49:44', '2023-08-06 18:50:03', 1, 20, 'Pembacaan Tajwid', 'hadir', 4, '2023-09-04', '00:00:00', 0),
(20, '2023-08-06 18:49:44', '2023-08-06 18:50:03', 1, 33, 'Pembacaan Tajwid', 'sakit', 4, '2023-09-04', '00:00:00', 0),
(21, '2023-08-06 18:56:39', '2023-08-06 18:57:01', 1, 11, 'Iman Kepada Allah SWT', 'tanpa keterangan', 5, '2023-09-11', '00:00:00', 0),
(22, '2023-08-06 18:56:39', '2023-08-07 03:02:40', 1, 34, 'Iman Kepada Allah SWT', 'hadir', 5, '2023-09-11', '00:00:00', 120),
(23, '2023-08-06 18:56:39', '2023-08-06 18:57:01', 1, 12, 'Iman Kepada Allah SWT', 'tanpa keterangan', 5, '2023-09-11', '00:00:00', 0),
(24, '2023-08-06 18:56:39', '2023-08-06 18:57:02', 1, 20, 'Iman Kepada Allah SWT', 'hadir', 5, '2023-09-11', '00:00:00', 0),
(25, '2023-08-06 18:56:39', '2023-08-06 18:57:02', 1, 33, 'Iman Kepada Allah SWT', 'hadir', 5, '2023-09-11', '00:00:00', 0),
(26, '2023-08-06 18:57:36', '2023-08-06 18:57:49', 1, 11, 'Iman Kepada Malaikat', 'hadir', 6, '2023-09-18', '00:00:00', 0),
(27, '2023-08-06 18:57:37', '2023-08-06 18:57:49', 1, 34, 'Iman Kepada Malaikat', 'hadir', 6, '2023-09-18', '00:00:00', 0),
(28, '2023-08-06 18:57:37', '2023-08-06 18:57:49', 1, 12, 'Iman Kepada Malaikat', 'hadir', 6, '2023-09-18', '00:00:00', 0),
(29, '2023-08-06 18:57:37', '2023-08-06 18:57:49', 1, 20, 'Iman Kepada Malaikat', 'tanpa keterangan', 6, '2023-09-18', '00:00:00', 0),
(30, '2023-08-06 18:57:37', '2023-08-06 18:57:49', 1, 33, 'Iman Kepada Malaikat', 'tanpa keterangan', 6, '2023-09-18', '00:00:00', 0),
(31, '2023-08-06 18:58:13', '2023-08-06 18:58:32', 1, 11, 'Shalat Wajib Berjamaah', 'hadir', 7, '2023-09-18', '00:00:00', 50),
(32, '2023-08-06 18:58:13', '2023-08-06 18:58:33', 1, 34, 'Shalat Wajib Berjamaah', 'tanpa keterangan', 7, '2023-09-18', '00:00:00', 0),
(33, '2023-08-06 18:58:13', '2023-08-06 18:58:33', 1, 12, 'Shalat Wajib Berjamaah', 'hadir', 7, '2023-09-18', '00:00:00', 0),
(34, '2023-08-06 18:58:14', '2023-08-06 18:58:33', 1, 20, 'Shalat Wajib Berjamaah', 'tanpa keterangan', 7, '2023-09-18', '00:00:00', 0),
(35, '2023-08-06 18:58:14', '2023-08-06 18:58:33', 1, 33, 'Shalat Wajib Berjamaah', 'hadir', 7, '2023-09-18', '00:00:00', 0),
(36, '2023-08-06 18:59:00', '2023-08-06 18:59:18', 1, 11, 'Shalat Jum\'at', 'tanpa keterangan', 8, '2023-09-25', '00:00:00', 0),
(37, '2023-08-06 18:59:01', '2023-08-06 18:59:18', 1, 34, 'Shalat Jum\'at', 'tanpa keterangan', 8, '2023-09-25', '00:00:00', 0),
(38, '2023-08-06 18:59:01', '2023-08-06 18:59:18', 1, 12, 'Shalat Jum\'at', 'tanpa keterangan', 8, '2023-09-25', '00:00:00', 0),
(39, '2023-08-06 18:59:03', '2023-08-06 18:59:18', 1, 20, 'Shalat Jum\'at', 'hadir', 8, '2023-09-25', '00:00:00', 0),
(40, '2023-08-06 18:59:04', '2023-08-06 18:59:18', 1, 33, 'Shalat Jum\'at', 'tanpa keterangan', 8, '2023-09-25', '00:00:00', 0),
(41, '2023-08-06 18:59:45', '2023-08-06 18:59:59', 1, 11, 'Shalat Jamak dan Qasar', 'hadir', 9, '2023-10-02', '00:00:00', 0),
(42, '2023-08-06 18:59:46', '2023-08-06 18:59:59', 1, 34, 'Shalat Jamak dan Qasar', 'tanpa keterangan', 9, '2023-10-02', '00:00:00', 0),
(43, '2023-08-06 18:59:46', '2023-08-06 18:59:59', 1, 12, 'Shalat Jamak dan Qasar', 'tanpa keterangan', 9, '2023-10-02', '00:00:00', 0),
(44, '2023-08-06 18:59:46', '2023-08-06 18:59:59', 1, 20, 'Shalat Jamak dan Qasar', 'hadir', 9, '2023-10-02', '00:00:00', 0),
(45, '2023-08-06 18:59:46', '2023-08-06 18:59:59', 1, 33, 'Shalat Jamak dan Qasar', 'tanpa keterangan', 9, '2023-10-02', '00:00:00', 0),
(46, '2023-08-06 19:00:22', '2023-08-06 19:00:33', 1, 11, 'Kewajiban Menuntut Ilmu', 'tanpa keterangan', 10, '2023-10-09', '00:00:00', 0),
(47, '2023-08-06 19:00:22', '2023-08-06 19:00:33', 1, 34, 'Kewajiban Menuntut Ilmu', 'hadir', 10, '2023-10-09', '00:00:00', 0),
(48, '2023-08-06 19:00:22', '2023-08-06 19:00:33', 1, 12, 'Kewajiban Menuntut Ilmu', 'tanpa keterangan', 10, '2023-10-09', '00:00:00', 0),
(49, '2023-08-06 19:00:22', '2023-08-06 19:00:33', 1, 20, 'Kewajiban Menuntut Ilmu', 'hadir', 10, '2023-10-09', '00:00:00', 0),
(50, '2023-08-06 19:00:22', '2023-08-06 19:00:33', 1, 33, 'Kewajiban Menuntut Ilmu', 'tanpa keterangan', 10, '2023-10-09', '00:00:00', 0),
(51, '2023-08-06 19:00:56', '2023-08-06 19:01:11', 1, 11, 'Sikap Ikhlas, Sabar', 'hadir', 11, '2023-10-16', '00:00:00', 0),
(52, '2023-08-06 19:00:57', '2023-08-06 19:01:11', 1, 34, 'Sikap Ikhlas, Sabar', 'hadir', 11, '2023-10-16', '00:00:00', 0),
(53, '2023-08-06 19:00:57', '2023-08-06 19:01:11', 1, 12, 'Sikap Ikhlas, Sabar', 'hadir', 11, '2023-10-16', '00:00:00', 0),
(54, '2023-08-06 19:00:57', '2023-08-06 19:01:11', 1, 20, 'Sikap Ikhlas, Sabar', 'hadir', 11, '2023-10-16', '00:00:00', 0),
(55, '2023-08-06 19:00:57', '2023-08-06 19:01:11', 1, 33, 'Sikap Ikhlas, Sabar', 'hadir', 11, '2023-10-16', '00:00:00', 0),
(56, '2023-08-06 19:01:47', '2023-08-06 19:02:01', 1, 11, 'hukum-hukum serta akhlak dan moral', 'hadir', 12, '2023-10-23', '00:00:00', 0),
(57, '2023-08-06 19:01:47', '2023-08-06 19:02:01', 1, 34, 'hukum-hukum serta akhlak dan moral', 'tanpa keterangan', 12, '2023-10-23', '00:00:00', 0),
(58, '2023-08-06 19:01:47', '2023-08-06 19:02:01', 1, 12, 'hukum-hukum serta akhlak dan moral', 'hadir', 12, '2023-10-23', '00:00:00', 0),
(59, '2023-08-06 19:01:47', '2023-08-06 19:02:02', 1, 20, 'hukum-hukum serta akhlak dan moral', 'tanpa keterangan', 12, '2023-10-23', '00:00:00', 0),
(60, '2023-08-06 19:01:47', '2023-08-06 19:02:02', 1, 33, 'hukum-hukum serta akhlak dan moral', 'hadir', 12, '2023-10-23', '00:00:00', 0),
(61, '2023-08-06 19:02:31', '2023-08-06 19:08:31', 1, 11, 'juru dakwa dan rekan penyuluh untuk mengkaji', 'ijin', 13, '2023-10-30', '00:00:00', 0),
(62, '2023-08-06 19:02:32', '2023-08-06 19:02:45', 1, 34, 'juru dakwa dan rekan penyuluh untuk mengkaji', 'hadir', 13, '2023-10-30', '00:00:00', 0),
(63, '2023-08-06 19:02:32', '2023-08-06 19:02:45', 1, 12, 'juru dakwa dan rekan penyuluh untuk mengkaji', 'tanpa keterangan', 13, '2023-10-30', '00:00:00', 0),
(64, '2023-08-06 19:02:32', '2023-08-06 19:02:45', 1, 20, 'juru dakwa dan rekan penyuluh untuk mengkaji', 'hadir', 13, '2023-10-30', '00:00:00', 0),
(65, '2023-08-06 19:02:32', '2023-08-06 19:02:45', 1, 33, 'juru dakwa dan rekan penyuluh untuk mengkaji', 'hadir', 13, '2023-10-30', '00:00:00', 0),
(66, '2023-08-06 19:03:42', '2023-08-06 19:08:19', 1, 11, 'agama Islam dari sumber utamanya kitab suci al-Quran dan al-Hadits', 'sakit', 14, '2023-11-06', '00:00:00', 0),
(67, '2023-08-06 19:03:42', '2023-08-06 19:04:04', 1, 34, 'agama Islam dari sumber utamanya kitab suci al-Quran dan al-Hadits', 'tanpa keterangan', 14, '2023-11-06', '00:00:00', 0),
(68, '2023-08-06 19:03:43', '2023-08-06 19:04:04', 1, 12, 'agama Islam dari sumber utamanya kitab suci al-Quran dan al-Hadits', 'tanpa keterangan', 14, '2023-11-06', '00:00:00', 0),
(69, '2023-08-06 19:03:43', '2023-08-06 19:04:04', 1, 20, 'agama Islam dari sumber utamanya kitab suci al-Quran dan al-Hadits', 'hadir', 14, '2023-11-06', '00:00:00', 0),
(70, '2023-08-06 19:03:43', '2023-08-06 19:04:04', 1, 33, 'agama Islam dari sumber utamanya kitab suci al-Quran dan al-Hadits', 'tanpa keterangan', 14, '2023-11-06', '00:00:00', 0),
(71, '2023-08-06 19:04:32', '2023-08-06 19:08:08', 1, 11, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'ijin', 15, '2023-10-30', '00:00:00', 0),
(72, '2023-08-06 19:04:32', '2023-08-06 19:04:43', 1, 34, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'tanpa keterangan', 15, '2023-10-30', '00:00:00', 0),
(73, '2023-08-06 19:04:32', '2023-08-06 19:04:43', 1, 12, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'hadir', 15, '2023-10-30', '00:00:00', 0),
(74, '2023-08-06 19:04:32', '2023-08-06 19:04:43', 1, 20, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'tanpa keterangan', 15, '2023-10-30', '00:00:00', 0),
(75, '2023-08-06 19:04:32', '2023-08-06 19:04:43', 1, 33, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'hadir', 15, '2023-10-30', '00:00:00', 0),
(76, '2023-08-06 19:05:02', '2023-08-06 19:08:00', 1, 11, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'sakit', 16, '2023-11-06', '00:00:00', 0),
(77, '2023-08-06 19:05:02', '2023-08-06 19:05:14', 1, 34, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'hadir', 16, '2023-11-06', '00:00:00', 0),
(78, '2023-08-06 19:05:02', '2023-08-06 19:05:14', 1, 12, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'tanpa keterangan', 16, '2023-11-06', '00:00:00', 0),
(79, '2023-08-06 19:05:02', '2023-08-06 19:05:14', 1, 20, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'hadir', 16, '2023-11-06', '00:00:00', 0),
(80, '2023-08-06 19:05:02', '2023-08-06 19:05:14', 1, 33, 'kegiatan bimbingan, pengajaran, latihan, serta penggunaan pengalaman', 'tanpa keterangan', 16, '2023-11-06', '00:00:00', 0),
(81, '2023-08-06 19:46:56', '2023-08-06 19:47:09', 3, 11, 'Memahami dasar dasar', 'sakit', 1, '2023-08-08', '00:00:00', 0),
(82, '2023-08-06 19:46:56', '2023-08-06 19:47:09', 3, 34, 'Memahami dasar dasar', 'hadir', 1, '2023-08-08', '00:00:00', 0),
(83, '2023-08-06 19:46:56', '2023-08-06 19:47:09', 3, 12, 'Memahami dasar dasar', 'sakit', 1, '2023-08-08', '00:00:00', 0),
(84, '2023-08-06 19:46:56', '2023-08-06 19:47:09', 3, 20, 'Memahami dasar dasar', 'hadir', 1, '2023-08-08', '00:00:00', 0),
(85, '2023-08-06 19:46:56', '2023-08-06 19:47:09', 3, 33, 'Memahami dasar dasar', 'sakit', 1, '2023-08-08', '00:00:00', 0),
(86, '2023-08-06 19:47:36', '2023-08-06 19:47:52', 3, 11, 'dsd', 'tanpa keterangan', 2, '2023-08-14', '00:00:00', 0),
(87, '2023-08-06 19:47:36', '2023-08-06 19:47:52', 3, 34, 'dsd', 'ijin', 2, '2023-08-14', '00:00:00', 0),
(88, '2023-08-06 19:47:36', '2023-08-06 19:47:52', 3, 12, 'dsd', 'hadir', 2, '2023-08-14', '00:00:00', 0),
(89, '2023-08-06 19:47:36', '2023-08-06 19:47:52', 3, 20, 'dsd', 'sakit', 2, '2023-08-14', '00:00:00', 0),
(90, '2023-08-06 19:47:36', '2023-08-06 19:47:52', 3, 33, 'dsd', 'tanpa keterangan', 2, '2023-08-14', '00:00:00', 0),
(91, '2023-08-12 00:22:56', '2023-08-12 00:23:05', 4, 11, 'Dasar dasar', 'hadir', 1, '2023-08-12', '00:00:00', 20);

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
(15, '2023-08-05 13:54:43', '2023-08-12 00:23:49', 7, 2021, 'Sistem Informasi 1A', 'tidak aktif', 'SI1A01', 25, 1),
(16, '2023-08-06 19:20:41', '2023-08-06 19:34:50', 8, 2021, 'Sistem Informasi 1A', 'aktif', 'SI1A02', 25, 1);

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
(1, '2023-08-06 18:29:08', '2023-08-06 18:29:08', 11, 15),
(2, '2023-08-06 18:29:29', '2023-08-06 18:29:29', 34, 15),
(3, '2023-08-06 18:29:47', '2023-08-06 18:29:47', 12, 15),
(4, '2023-08-06 18:30:08', '2023-08-06 18:30:08', 20, 15),
(5, '2023-08-06 18:30:44', '2023-08-06 18:30:44', 33, 15),
(6, '2023-08-06 19:21:32', '2023-08-06 19:21:32', 11, 16),
(7, '2023-08-07 02:57:17', '2023-08-07 02:57:17', 15, 16);

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
(1, 1, 11, '2023-08-06 18:33:05', '2023-08-06 18:33:05'),
(2, 1, 34, '2023-08-06 18:33:05', '2023-08-06 18:33:05'),
(3, 1, 12, '2023-08-06 18:33:05', '2023-08-06 18:33:05'),
(4, 1, 20, '2023-08-06 18:33:05', '2023-08-06 18:33:05'),
(5, 1, 33, '2023-08-06 18:33:05', '2023-08-06 18:33:05'),
(6, 2, 11, '2023-08-06 18:33:19', '2023-08-06 18:33:19'),
(7, 2, 34, '2023-08-06 18:33:19', '2023-08-06 18:33:19'),
(8, 2, 12, '2023-08-06 18:33:20', '2023-08-06 18:33:20'),
(9, 2, 20, '2023-08-06 18:33:20', '2023-08-06 18:33:20'),
(10, 2, 33, '2023-08-06 18:33:20', '2023-08-06 18:33:20'),
(11, 3, 11, '2023-08-06 18:33:50', '2023-08-06 18:33:50'),
(12, 3, 34, '2023-08-06 18:33:50', '2023-08-06 18:33:50'),
(13, 3, 12, '2023-08-06 18:33:50', '2023-08-06 18:33:50'),
(14, 3, 20, '2023-08-06 18:33:50', '2023-08-06 18:33:50'),
(15, 3, 33, '2023-08-06 18:33:50', '2023-08-06 18:33:50'),
(16, 4, 11, '2023-08-06 19:36:38', '2023-08-06 19:36:38'),
(17, 5, 11, '2023-08-06 19:36:50', '2023-08-06 19:36:50'),
(18, 6, 11, '2023-08-06 19:37:05', '2023-08-06 19:37:05');

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
(5, '2023-07-08 16:22:03', '2023-08-05 12:32:02', 'PENDIDIKAN AGAMA', 1, 'PMU0001', 3, 1, 'aktif'),
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
  `id_dosen` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `mata_kuliah_enrolls`
--

INSERT INTO `mata_kuliah_enrolls` (`id`, `created_at`, `updated_at`, `id_kelas`, `id_mata_kuliah`, `id_dosen`) VALUES
(1, '2023-08-06 18:31:50', '2023-08-06 18:31:50', 15, 5, 23),
(2, '2023-08-06 18:32:02', '2023-08-06 18:32:02', 15, 6, 23),
(3, '2023-08-06 18:32:13', '2023-08-06 18:32:13', 15, 7, 23),
(4, '2023-08-06 19:35:29', '2023-08-06 19:35:29', 16, 8, 23),
(5, '2023-08-06 19:36:00', '2023-08-06 19:36:00', 16, 9, 23),
(6, '2023-08-06 19:36:13', '2023-08-06 19:36:13', 16, 10, 23);

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

--
-- Dumping data for table `nilais`
--

INSERT INTO `nilais` (`id`, `created_at`, `updated_at`, `id_daftar_nilai`, `id_mahasiswa`, `nilai`) VALUES
(4, '2023-08-06 18:41:35', '2023-08-06 18:41:43', '1', 11, 80),
(5, '2023-08-06 18:41:35', '2023-08-06 18:41:43', '1', 34, 90),
(6, '2023-08-06 18:41:35', '2023-08-06 18:41:43', '1', 12, 70),
(7, '2023-08-06 18:41:35', '2023-08-06 18:41:43', '1', 20, 80),
(8, '2023-08-06 18:41:35', '2023-08-06 18:41:43', '1', 33, 90),
(9, '2023-08-06 18:42:03', '2023-08-06 18:42:28', '2', 11, 90),
(10, '2023-08-06 18:42:03', '2023-08-06 18:42:28', '2', 34, 78),
(11, '2023-08-06 18:42:03', '2023-08-06 18:42:28', '2', 12, 68),
(12, '2023-08-06 18:42:03', '2023-08-06 18:42:28', '2', 20, 78),
(13, '2023-08-06 18:42:03', '2023-08-06 18:42:28', '2', 33, 90),
(14, '2023-08-06 18:43:49', '2023-08-06 18:45:51', '3', 11, 90),
(15, '2023-08-06 18:43:49', '2023-08-06 18:45:51', '3', 12, 70),
(16, '2023-08-06 18:43:49', '2023-08-06 18:45:51', '3', 20, 80),
(17, '2023-08-06 18:43:49', '2023-08-06 18:45:51', '3', 33, 89),
(18, '2023-08-06 18:43:49', '2023-08-06 18:45:51', '3', 34, 70),
(19, '2023-08-06 18:46:02', '2023-08-06 18:46:12', '4', 11, 90),
(20, '2023-08-06 18:46:02', '2023-08-06 18:46:13', '4', 34, 89),
(21, '2023-08-06 18:46:02', '2023-08-06 18:46:13', '4', 12, 90),
(22, '2023-08-06 18:46:02', '2023-08-06 18:46:13', '4', 20, 68),
(23, '2023-08-06 18:46:02', '2023-08-06 18:46:13', '4', 33, 89),
(24, '2023-08-06 18:46:22', '2023-08-06 18:46:34', '5', 11, 60),
(25, '2023-08-06 18:46:23', '2023-08-06 18:46:34', '5', 34, 80),
(26, '2023-08-06 18:46:23', '2023-08-06 18:46:35', '5', 12, 89),
(27, '2023-08-06 18:46:23', '2023-08-06 18:46:35', '5', 20, 90),
(28, '2023-08-06 18:46:23', '2023-08-06 18:46:35', '5', 33, 89),
(29, '2023-08-06 19:09:52', '2023-08-06 19:10:02', '6', 11, 70),
(30, '2023-08-06 19:09:52', '2023-08-06 19:10:02', '6', 34, 80),
(31, '2023-08-06 19:09:52', '2023-08-06 19:10:02', '6', 12, 90),
(32, '2023-08-06 19:09:52', '2023-08-06 19:10:02', '6', 20, 68),
(33, '2023-08-06 19:09:52', '2023-08-06 19:10:02', '6', 33, 90),
(44, '2023-08-06 19:12:05', '2023-08-06 19:12:17', '9', 11, 90),
(45, '2023-08-06 19:12:05', '2023-08-06 19:12:17', '9', 34, 78),
(46, '2023-08-06 19:12:05', '2023-08-06 19:12:17', '9', 12, 67),
(47, '2023-08-06 19:12:05', '2023-08-06 19:12:17', '9', 20, 89),
(48, '2023-08-06 19:12:05', '2023-08-06 19:12:17', '9', 33, 87),
(49, '2023-08-06 19:12:27', '2023-08-06 19:12:39', '10', 11, 58),
(50, '2023-08-06 19:12:27', '2023-08-06 19:12:39', '10', 12, 78),
(51, '2023-08-06 19:12:27', '2023-08-06 19:12:39', '10', 20, 78),
(52, '2023-08-06 19:12:27', '2023-08-06 19:12:39', '10', 33, 90),
(53, '2023-08-06 19:12:27', '2023-08-06 19:12:39', '10', 34, 89),
(54, '2023-08-06 19:13:11', '2023-08-06 19:13:19', '11', 11, 35),
(55, '2023-08-06 19:13:11', '2023-08-06 19:13:19', '11', 34, 45),
(56, '2023-08-06 19:13:11', '2023-08-06 19:13:19', '11', 12, 67),
(57, '2023-08-06 19:13:11', '2023-08-06 19:13:19', '11', 20, 45),
(58, '2023-08-06 19:13:11', '2023-08-06 19:13:19', '11', 33, 44),
(59, '2023-08-06 19:13:30', '2023-08-06 19:14:27', '12', 11, 75),
(60, '2023-08-06 19:13:30', '2023-08-06 19:13:41', '12', 34, 87),
(61, '2023-08-06 19:13:30', '2023-08-06 19:13:41', '12', 12, 56),
(62, '2023-08-06 19:13:30', '2023-08-06 19:13:41', '12', 20, 56),
(63, '2023-08-06 19:13:30', '2023-08-06 19:13:42', '12', 33, 67),
(64, '2023-08-06 19:13:50', '2023-08-06 19:14:20', '13', 11, 77),
(65, '2023-08-06 19:13:50', '2023-08-06 19:14:01', '13', 12, 66),
(66, '2023-08-06 19:13:51', '2023-08-06 19:14:01', '13', 20, 78),
(67, '2023-08-06 19:13:51', '2023-08-06 19:14:01', '13', 33, 66),
(68, '2023-08-06 19:13:51', '2023-08-06 19:14:01', '13', 34, 56),
(69, '2023-08-06 19:41:45', '2023-08-06 19:42:02', '14', 11, 59),
(70, '2023-08-06 19:42:19', '2023-08-06 19:42:27', '15', 11, 90),
(71, '2023-08-06 19:42:38', '2023-08-06 19:42:50', '16', 11, 89),
(72, '2023-08-06 19:42:38', '2023-08-06 19:42:38', '16', 12, 0),
(73, '2023-08-06 19:42:38', '2023-08-06 19:42:38', '16', 20, 0),
(74, '2023-08-06 19:42:38', '2023-08-06 19:42:38', '16', 33, 0),
(75, '2023-08-06 19:42:38', '2023-08-06 19:42:38', '16', 34, 0),
(76, '2023-08-06 19:44:19', '2023-08-06 19:44:25', '17', 11, 70),
(77, '2023-08-06 19:44:34', '2023-08-06 19:44:38', '18', 11, 88),
(78, '2023-08-06 19:44:46', '2023-08-06 19:44:54', '19', 11, 60),
(79, '2023-08-06 19:44:46', '2023-08-06 19:44:46', '19', 12, 0),
(80, '2023-08-06 19:44:46', '2023-08-06 19:44:46', '19', 20, 0),
(81, '2023-08-06 19:44:47', '2023-08-06 19:44:47', '19', 33, 0),
(82, '2023-08-06 19:44:47', '2023-08-06 19:44:47', '19', 34, 0);

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

--
-- Dumping data for table `perwalians`
--

INSERT INTO `perwalians` (`id`, `id_jadwal_perwalian`, `id_kelas`, `id_mahasiswa`, `keluhan`, `balasan`, `created_at`, `updated_at`) VALUES
(1, 1, 15, 11, 'Maaf pak dalam semester sekarang ini sayan mengalami masalah terhadap ekonomi, dan saya kesulitan untuk membayar UKT di semester tahun depan, bagaimana ya pak solusinya', NULL, '2023-08-06 19:17:34', '2023-08-06 19:17:34'),
(2, 2, 16, 11, 'Saya mengalami kendala kendaraan pak, jadi saya sering bolos kuliah karena tidak ada kendaraannya, bagaimana ya pak', 'Coba kamu keruangan saya, nanti saya kasih mobil', '2023-08-06 19:39:18', '2023-08-06 19:39:57'),
(3, 2, 16, 15, 'ibu saya mengalami permasalahan ekonomi untuk biaya UKT, apakah ada solusi bu untuk mengatasinya?', 'coba kamu bisa ajukan penurunan UKT ke bagian akademik ya', '2023-08-07 02:58:20', '2023-08-07 02:59:31');

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

--
-- Dumping data for table `sp`
--

INSERT INTO `sp` (`id`, `id_kelas`, `deskripsi`, `id_user_penerima`, `file`, `jenis_sp`, `created_at`, `updated_at`, `user_id`) VALUES
(1, 15, 'Mendapatkan surat peringatan lisan karena telat 130 menit', 11, '1691348026_Agile Development Methods.pdf', 'Surat Peringatan Lisan 1', '2023-08-06 18:53:47', '2023-08-06 18:53:47', 7),
(2, 15, 'Surat Peringatan Lisan 1', 34, '1691377432_Jurnal JSI Unsurya Dian Gustina.pdf', 'Surat Peringatan Lisan 1', '2023-08-07 03:03:52', '2023-08-07 03:03:52', 7);

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
(19, 'Adi Sudrajat', 'adisudrajat@gmail.com', '10107002', '4', '$2y$10$rycdnnm6IL7teB4QNcUS4Oqn1GSEJkhI6Os77fYJzANqSmQBDZTii', 'Purwadadi Subang', '083195739340', 'Laki-laki', '1', '2023-07-08 14:58:43', '2023-07-08 14:58:43', 'aktif'),
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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `jadwal_perwalian`
--
ALTER TABLE `jadwal_perwalian`
  MODIFY `id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `jurusans`
--
ALTER TABLE `jurusans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `kehadirans`
--
ALTER TABLE `kehadirans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `kelas_enrolls`
--
ALTER TABLE `kelas_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `mahasiswa_mata_kuliah_enrolls`
--
ALTER TABLE `mahasiswa_mata_kuliah_enrolls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `mata_kuliahs`
--
ALTER TABLE `mata_kuliahs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `mata_kuliah_enrolls`
--
ALTER TABLE `mata_kuliah_enrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
