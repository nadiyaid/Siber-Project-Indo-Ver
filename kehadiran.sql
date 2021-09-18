-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 14, 2021 at 04:39 PM
-- Server version: 10.1.28-MariaDB
-- PHP Version: 7.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kehadiran`
--

-- --------------------------------------------------------

--
-- Table structure for table `absensi`
--

CREATE TABLE `absensi` (
  `absen_id` int(11) NOT NULL,
  `tanggal` date DEFAULT NULL,
  `waktu_masuk` time DEFAULT NULL,
  `waktu_pulang` time DEFAULT NULL,
  `jam_kerja` time DEFAULT NULL,
  `stat` varchar(100) NOT NULL,
  `stat_out` varchar(100) NOT NULL DEFAULT '',
  `stat_kerja` varchar(100) NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nip` int(11) NOT NULL,
  `auto_ins` time NOT NULL DEFAULT '09:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `absensi`
--

INSERT INTO `absensi` (`absen_id`, `tanggal`, `waktu_masuk`, `waktu_pulang`, `jam_kerja`, `stat`, `stat_out`, `stat_kerja`, `updated_at`, `nip`, `auto_ins`) VALUES
(3, '2021-08-27', '14:43:45', '14:46:10', '00:02:25', 'late', 'leave early', 'WFH', '2021-08-27 14:46:10', 2, '09:00:00'),
(4, '2021-08-26', '08:30:00', '17:00:00', '08:30:00', '', '', 'WFH', '2021-08-27 14:42:23', 1, '09:00:00'),
(6, '2021-08-24', '09:12:00', '17:15:00', '08:03:00', 'late', '', 'WFH', '2021-08-27 14:42:23', 1, '09:00:00'),
(7, '2021-08-31', '13:28:01', '22:17:01', '08:49:00', '', '', 'WFH', '2021-08-31 22:17:01', 3, '09:00:00'),
(8, '2021-09-02', '08:47:43', NULL, '00:00:00', '', '', 'WFH', '2021-09-02 08:47:43', 1, '09:00:00'),
(9, '2021-09-01', '08:49:49', '17:49:49', '09:00:00', '', '', 'WFH', '2021-09-02 08:49:49', 4, '09:00:00'),
(10, '2021-09-01', NULL, NULL, NULL, 'absent', 'absent', 'WFH', '2021-09-02 08:49:49', 2, '09:00:00'),
(11, '2021-09-01', '10:12:00', '18:12:00', '08:00:00', 'late', '', 'WFH', '2021-09-02 08:49:49', 5, '09:00:00'),
(12, '2021-09-02', '11:06:45', '11:10:19', '00:03:34', 'late', 'leave early', 'WFH', '2021-09-02 11:10:19', 6, '09:00:00'),
(13, '2021-09-03', '11:06:45', '11:10:19', '00:03:34', 'late', 'leave early', 'WFO', '2021-09-02 11:10:19', 6, '09:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `karyawan`
--

CREATE TABLE `karyawan` (
  `nip` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `posisi` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `karyawan`
--

INSERT INTO `karyawan` (`nip`, `nama`, `alamat`, `posisi`, `username`, `password`, `email`, `role`) VALUES
(1, 'Nadiya Ivana', 'jl. juanda', 'Data Science', 'admin', '202cb962ac59075b964b07152d234b70', 'nadiya@gmail.com', 'admin'),
(2, 'Velia Handayani', 'jl. nangka', 'Graphic Design', 'veliahnd', 'ee11cbb19052e40b07aac0ca060c23ee', 'veliahnd@gmail.com', 'user'),
(3, 'Widadi Soetawijasa', '', 'Human Resource', 'superadmin', '202cb962ac59075b964b07152d234b70', 'widadi@gmail.com', 'superadmin'),
(4, 'Andrea', '', 'Back End', 'andrea', '7c7da78e9b5810e427f4a8174e6d25da', 'andre@gmail.com', 'user'),
(5, 'Eko Maulana', '', 'IT Manager', 'eko', 'ee11cbb19052e40b07aac0ca060c23ee', 'ekomaulana@gmail.com', 'admin'),
(6, 'Siti', '', 'Front End', 'siti', '202cb962ac59075b964b07152d234b70', 'siti@gmail.com', 'user');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `request_id` int(11) NOT NULL,
  `tanggal_request` date DEFAULT NULL,
  `status_ketidakhadiran` int(11) NOT NULL DEFAULT '0',
  `keterangan` text NOT NULL,
  `dari_tanggal` date DEFAULT NULL,
  `sampai_tanggal` date DEFAULT NULL,
  `pengganti` varchar(100) NOT NULL,
  `approval` varchar(100) NOT NULL,
  `comment` text,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `nip` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`request_id`, `tanggal_request`, `status_ketidakhadiran`, `keterangan`, `dari_tanggal`, `sampai_tanggal`, `pengganti`, `approval`, `comment`, `updated_at`, `nip`) VALUES
(1, '2021-02-16', 1, 'izin sidang tugas akhir', '2021-02-23', '2021-02-24', 'nadiya ivana', 'approve', '', '2021-02-24 05:25:32', 2),
(2, '2021-02-23', 2, 'sakit', '2021-03-15', '2021-03-16', 'brian', 'approve', '', '2021-03-15 06:42:40', 3),
(3, '2021-03-08', 3, 'cuti lebaran', '2021-05-17', '2021-05-21', 'andrea', 'decline', '', '2021-03-01 08:33:36', 1),
(4, '2021-03-15', 1, 'izin sidang tugas akhir', '2021-03-15', '2021-03-16', 'Juliana C', 'approve', 'oke di approve', '2021-03-15 06:41:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `task_id` int(11) NOT NULL,
  `nama_task` text NOT NULL,
  `deskripsi` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` varchar(100) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `end_time` time NOT NULL,
  `nip` int(11) NOT NULL,
  `status` varchar(30) NOT NULL DEFAULT 'undone',
  `comment` text NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `percentage` double NOT NULL DEFAULT '0',
  `file` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `nama_task`, `deskripsi`, `created_at`, `created_by`, `start_date`, `end_date`, `end_time`, `nip`, `status`, `comment`, `updated_at`, `percentage`, `file`) VALUES
(1, 'Membuat CRUD', 'Membuat CRUD untuk menu task', '2021-01-19 15:14:10', 'Admin', '2021-08-30', '2021-09-06', '15:00:00', 1, 'Dalam pengerjaan', 'udah membuat create task', '2021-08-27 11:33:47', 25, 'attachment/'),
(2, 'Membuat session login', 'Buat session login untuk setiap role', '2021-02-25 08:54:44', 'Admin', '2021-09-06', '2021-09-06', '10:00:00', 2, 'Dalam pengerjaan', 'Session login role admin sudah', '2021-08-27 11:35:58', 50, 'attachment/'),
(3, 'Judul Task', 'Task description', '2021-02-25 18:57:58', 'nadiya ivana', '2021-02-25', '2021-02-26', '00:00:00', 4, 'Selesai', '', '2021-08-25 13:02:11', 100, 'attachment/'),
(4, 'Chart', 'Buat bar chart untuk task progress', '2021-03-09 16:53:45', 'Nadiya Ivana', '2021-08-31', '2021-09-02', '15:00:00', 2, 'Belum dikerjakan', '', '2021-08-27 11:34:28', 0, 'attachment/'),
(5, 'Report attendance', 'Membuat tampilan report attendance untuk hak akses superadmin', '2021-03-09 16:57:12', 'Nadiya Ivana', '2021-08-27', '2021-09-01', '14:00:00', 4, 'Belum dikerjakan', '', '2021-08-31 06:53:08', 0, 'attachment/'),
(6, 'Updates', 'Buat menu untuk nampilin setiap update yang udah dilakuin di task. Jadi kayak timeline', '2021-03-09 17:12:13', 'Nadiya Ivana', '2021-09-07', '2021-09-07', '13:00:00', 1, 'Belum dikerjakan', '', '2021-08-27 11:35:08', 0, 'attachment/'),
(7, 'Deploy ke server', 'Mendeploy tugas yang telah selesai ke server port 500', '2021-03-09 18:03:13', 'Nadiya Ivana', '2021-09-01', '2021-09-01', '15:00:00', 4, 'Dalam pengerjaan', '', '2021-08-27 11:02:31', 50, 'attachment/'),
(8, 'Tes', 'tes', '2021-03-09 18:08:15', 'Nadiya Ivana', '2021-03-09', '2021-03-10', '00:00:00', 2, 'Selesai', '', '2021-08-25 13:02:21', 100, 'attachment/'),
(9, 'Finish task', 'finish', '2021-03-09 18:09:48', 'Nadiya Ivana', '2021-03-01', '2021-03-02', '00:00:00', 1, 'Selesai', '', '2021-08-27 09:47:15', 100, 'attachment/'),
(10, 'Membuat tampilan login', 'membuat tampilan login dari desain yang telah dibuat UI.UX', '2021-09-02 11:08:27', 'Nadiya Ivana', '2021-09-03', '2021-09-03', '12:00:00', 6, 'Selesai', 'akan dikerjakan', '2021-09-02 04:10:03', 100, 'attachment/logo stmi.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monthly_report`
-- (See below for the actual view)
--
CREATE TABLE `v_monthly_report` (
`nip` int(11)
,`nama` varchar(100)
,`tanggal` date
,`1` varchar(1)
,`2` varchar(1)
,`3` varchar(1)
,`4` varchar(1)
,`5` varchar(1)
,`6` varchar(1)
,`7` varchar(1)
,`8` varchar(1)
,`9` varchar(1)
,`10` varchar(1)
,`11` varchar(1)
,`12` varchar(1)
,`13` varchar(1)
,`14` varchar(1)
,`15` varchar(1)
,`16` varchar(1)
,`17` varchar(1)
,`18` varchar(1)
,`19` varchar(1)
,`20` varchar(1)
,`21` varchar(1)
,`22` varchar(1)
,`23` varchar(1)
,`24` varchar(1)
,`25` varchar(1)
,`26` varchar(1)
,`27` varchar(1)
,`28` varchar(1)
,`29` varchar(1)
,`30` varchar(1)
,`31` varchar(1)
);

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_monthly_report2`
-- (See below for the actual view)
--
CREATE TABLE `v_monthly_report2` (
`nip` int(11)
,`nama` varchar(100)
,`tanggal` date
,`1` varchar(3)
,`2` varchar(3)
,`3` varchar(3)
,`4` varchar(3)
,`5` varchar(3)
,`6` varchar(3)
,`7` varchar(3)
,`8` varchar(3)
,`9` varchar(3)
,`10` varchar(3)
,`11` varchar(3)
,`12` varchar(3)
,`13` varchar(3)
,`14` varchar(3)
,`15` varchar(3)
,`16` varchar(3)
,`17` varchar(3)
,`18` varchar(3)
,`19` varchar(3)
,`20` varchar(3)
,`21` varchar(3)
,`22` varchar(3)
,`23` varchar(3)
,`24` varchar(3)
,`25` varchar(3)
,`26` varchar(3)
,`27` varchar(3)
,`28` varchar(3)
,`29` varchar(3)
,`30` varchar(3)
,`31` varchar(3)
);

-- --------------------------------------------------------

--
-- Structure for view `v_monthly_report`
--
DROP TABLE IF EXISTS `v_monthly_report`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_monthly_report`  AS  select `a`.`nip` AS `nip`,`a`.`nama` AS `nama`,`b`.`tanggal` AS `tanggal`,(case when (dayofmonth(`b`.`tanggal`) = 1) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `1`,(case when (dayofmonth(`b`.`tanggal`) = 2) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `2`,(case when (dayofmonth(`b`.`tanggal`) = 3) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `3`,(case when (dayofmonth(`b`.`tanggal`) = 4) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `4`,(case when (dayofmonth(`b`.`tanggal`) = 5) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `5`,(case when (dayofmonth(`b`.`tanggal`) = 6) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `6`,(case when (dayofmonth(`b`.`tanggal`) = 7) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `7`,(case when (dayofmonth(`b`.`tanggal`) = 8) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `8`,(case when (dayofmonth(`b`.`tanggal`) = 9) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `9`,(case when (dayofmonth(`b`.`tanggal`) = 10) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `10`,(case when (dayofmonth(`b`.`tanggal`) = 11) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `11`,(case when (dayofmonth(`b`.`tanggal`) = 12) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `12`,(case when (dayofmonth(`b`.`tanggal`) = 13) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `13`,(case when (dayofmonth(`b`.`tanggal`) = 14) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `14`,(case when (dayofmonth(`b`.`tanggal`) = 15) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `15`,(case when (dayofmonth(`b`.`tanggal`) = 16) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `16`,(case when (dayofmonth(`b`.`tanggal`) = 17) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `17`,(case when (dayofmonth(`b`.`tanggal`) = 18) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `18`,(case when (dayofmonth(`b`.`tanggal`) = 19) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `19`,(case when (dayofmonth(`b`.`tanggal`) = 20) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `20`,(case when (dayofmonth(`b`.`tanggal`) = 21) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `21`,(case when (dayofmonth(`b`.`tanggal`) = 22) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `22`,(case when (dayofmonth(`b`.`tanggal`) = 23) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `23`,(case when (dayofmonth(`b`.`tanggal`) = 24) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `24`,(case when (dayofmonth(`b`.`tanggal`) = 25) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `25`,(case when (dayofmonth(`b`.`tanggal`) = 26) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `26`,(case when (dayofmonth(`b`.`tanggal`) = 27) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `27`,(case when (dayofmonth(`b`.`tanggal`) = 28) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `28`,(case when (dayofmonth(`b`.`tanggal`) = 29) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `29`,(case when (dayofmonth(`b`.`tanggal`) = 30) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `30`,(case when (dayofmonth(`b`.`tanggal`) = 31) then (case when (`b`.`stat` = '') then 'P' when (`b`.`stat` = 'late') then 'L' when (`b`.`stat` = 'absent') then 'A' else 'X' end) end) AS `31` from (`karyawan` `a` join `absensi` `b` on((`a`.`nip` = `b`.`nip`))) ;

-- --------------------------------------------------------

--
-- Structure for view `v_monthly_report2`
--
DROP TABLE IF EXISTS `v_monthly_report2`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_monthly_report2`  AS  select `a`.`nip` AS `nip`,`a`.`nama` AS `nama`,`b`.`tanggal` AS `tanggal`,(case when (dayofmonth(`b`.`tanggal`) = 1) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `1`,(case when (dayofmonth(`b`.`tanggal`) = 2) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `2`,(case when (dayofmonth(`b`.`tanggal`) = 3) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `3`,(case when (dayofmonth(`b`.`tanggal`) = 4) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `4`,(case when (dayofmonth(`b`.`tanggal`) = 5) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `5`,(case when (dayofmonth(`b`.`tanggal`) = 6) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `6`,(case when (dayofmonth(`b`.`tanggal`) = 7) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `7`,(case when (dayofmonth(`b`.`tanggal`) = 8) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `8`,(case when (dayofmonth(`b`.`tanggal`) = 9) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `9`,(case when (dayofmonth(`b`.`tanggal`) = 10) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `10`,(case when (dayofmonth(`b`.`tanggal`) = 11) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `11`,(case when (dayofmonth(`b`.`tanggal`) = 12) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `12`,(case when (dayofmonth(`b`.`tanggal`) = 13) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `13`,(case when (dayofmonth(`b`.`tanggal`) = 14) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `14`,(case when (dayofmonth(`b`.`tanggal`) = 15) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `15`,(case when (dayofmonth(`b`.`tanggal`) = 16) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `16`,(case when (dayofmonth(`b`.`tanggal`) = 17) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `17`,(case when (dayofmonth(`b`.`tanggal`) = 18) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `18`,(case when (dayofmonth(`b`.`tanggal`) = 19) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `19`,(case when (dayofmonth(`b`.`tanggal`) = 20) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `20`,(case when (dayofmonth(`b`.`tanggal`) = 21) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `21`,(case when (dayofmonth(`b`.`tanggal`) = 22) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `22`,(case when (dayofmonth(`b`.`tanggal`) = 23) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `23`,(case when (dayofmonth(`b`.`tanggal`) = 24) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `24`,(case when (dayofmonth(`b`.`tanggal`) = 25) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `25`,(case when (dayofmonth(`b`.`tanggal`) = 26) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `26`,(case when (dayofmonth(`b`.`tanggal`) = 27) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `27`,(case when (dayofmonth(`b`.`tanggal`) = 28) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `28`,(case when (dayofmonth(`b`.`tanggal`) = 29) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `29`,(case when (dayofmonth(`b`.`tanggal`) = 30) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `30`,(case when (dayofmonth(`b`.`tanggal`) = 31) then (case when (`b`.`stat_kerja` = 'WFO') then (case when (`b`.`stat` = '') then 'P-O' when (`b`.`stat` = 'late') then 'L-O' when (`b`.`stat` = 'absent') then 'A-O' else 'X' end) else (case when (`b`.`stat` = '') then 'P-H' when (`b`.`stat` = 'late') then 'L-H' when (`b`.`stat` = 'absent') then 'A-H' else 'X' end) end) end) AS `31` from (`karyawan` `a` join `absensi` `b` on((`a`.`nip` = `b`.`nip`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `absensi`
--
ALTER TABLE `absensi`
  ADD PRIMARY KEY (`absen_id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `karyawan`
--
ALTER TABLE `karyawan`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `nip` (`nip`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `user` (`nip`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `absensi`
--
ALTER TABLE `absensi`
  MODIFY `absen_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `karyawan`
--
ALTER TABLE `karyawan`
  MODIFY `nip` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `absensi`
--
ALTER TABLE `absensi`
  ADD CONSTRAINT `absensi_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `request_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `task_ibfk_1` FOREIGN KEY (`nip`) REFERENCES `karyawan` (`nip`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
