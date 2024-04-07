-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 07, 2024 at 12:05 PM
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
-- Database: `scan`
--

-- --------------------------------------------------------

--
-- Table structure for table `database_sample`
--

CREATE TABLE `database_sample` (
  `id` int(11) NOT NULL,
  `model` varchar(100) NOT NULL,
  `nomor_asset` varchar(100) NOT NULL,
  `sn` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `database_sample`
--

INSERT INTO `database_sample` (`id`, `model`, `nomor_asset`, `sn`, `name`, `status`, `timestamp`) VALUES
(69, 'SM-S928F', 'AS12345', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:13:32'),
(70, 'SM-S926F', 'AS12346', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:14:00'),
(71, 'SM-S921F', 'AS12347', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:13:43'),
(72, 'SM-S928F', 'AS12348', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:13:54'),
(73, 'SM-S926F', 'AS12349', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:14:10'),
(74, 'SM-S921F', 'AS12350', '', 'Paseo Pertiwi', 'PINJAM', '2024-04-07 09:13:48'),
(75, 'SM-S928F', 'AS12351', '', 'Paseo Pertiwi', 'KEMBALI', '2024-04-07 09:11:12'),
(76, 'SM-S926F', 'AS12352', '', 'Endri Susanto', 'PINJAM', '2024-04-07 12:04:28'),
(77, 'SM-S921F', 'AS12353', '', 'Endri Susanto', 'PINJAM', '2024-04-07 09:18:32'),
(78, 'SM-S928F', 'AS12354', '', 'Endri Susanto', 'PINJAM', '2024-04-07 09:18:36'),
(79, 'SM-S926F', 'AS12355', '', 'Endri Susanto', 'PINJAM', '2024-04-07 09:18:40'),
(80, 'SM-S921F', 'AS12356', '', 'Endri Susanto', 'PINJAM', '2024-04-07 09:18:46'),
(81, 'SM-S928F', 'AS12357', '', 'Susi Susanti', 'PINJAM', '2024-04-07 09:19:08'),
(82, 'SM-S926F', 'AS12358', '', 'Susi Susanti', 'PINJAM', '2024-04-07 09:19:19'),
(83, 'SM-S928F', 'AS12359', '', 'Susi Susanti', 'PINJAM', '2024-04-07 09:19:26'),
(84, 'SM-S926F', 'AS12360', '', 'Susi Susanti', 'PINJAM', '2024-04-07 09:19:31'),
(85, 'SM-S921F', 'AS12361', '', 'Gema Show Indo', 'PINJAM', '2024-04-07 09:19:55'),
(88, 'SM-S921F', 'AS12987', '', 'Endri Susanto', 'KEMBALI', '2024-04-07 12:03:57'),
(89, 'SM-S921F', 'AS12987', '', 'Endri Susanto', 'KEMBALI', '2024-04-07 12:03:57');

-- --------------------------------------------------------

--
-- Table structure for table `flow_sample`
--

CREATE TABLE `flow_sample` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `nomor_asset` varchar(100) NOT NULL,
  `model` int(11) NOT NULL,
  `status` varchar(100) NOT NULL,
  `timestamp` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `flow_sample`
--

INSERT INTO `flow_sample` (`id`, `name`, `nomor_asset`, `model`, `status`, `timestamp`) VALUES
(102, 'Paseo Pertiwi', 'AS12345', 0, 'PINJAM', '2024-04-07 09:07:51'),
(103, 'Paseo Pertiwi', 'AS12345', 0, 'KEMBALI', '2024-04-07 09:08:04'),
(104, 'Paseo Pertiwi', 'AS12351', 0, 'PINJAM', '2024-04-07 09:10:47'),
(105, 'Paseo Pertiwi', 'AS12351', 0, 'KEMBALI', '2024-04-07 09:10:49'),
(106, 'Paseo Pertiwi', 'AS12351', 0, 'PINJAM', '2024-04-07 09:10:50'),
(107, 'Paseo Pertiwi', 'AS12351', 0, 'KEMBALI', '2024-04-07 09:10:50'),
(108, 'Paseo Pertiwi', 'AS12351', 0, 'PINJAM', '2024-04-07 09:10:51'),
(109, 'Paseo Pertiwi', 'AS12351', 0, 'KEMBALI', '2024-04-07 09:10:51'),
(110, 'Paseo Pertiwi', 'AS12351', 0, 'PINJAM', '2024-04-07 09:10:52'),
(111, 'Paseo Pertiwi', 'AS12351', 0, 'KEMBALI', '2024-04-07 09:10:53'),
(112, 'Paseo Pertiwi', 'AS12351', 0, 'PINJAM', '2024-04-07 09:10:54'),
(113, 'Paseo Pertiwi', 'AS12351', 0, 'KEMBALI', '2024-04-07 09:11:12'),
(114, 'Paseo Pertiwi', 'AS12345', 0, 'PINJAM', '2024-04-07 09:12:45'),
(115, 'Paseo Pertiwi', 'AS12345', 0, 'KEMBALI', '2024-04-07 09:12:51'),
(116, 'Paseo Pertiwi', 'AS12345', 0, 'PINJAM', '2024-04-07 09:13:28'),
(117, 'Paseo Pertiwi', 'AS12345', 0, 'KEMBALI', '2024-04-07 09:13:30'),
(118, 'Paseo Pertiwi', 'AS12345', 0, 'PINJAM', '2024-04-07 09:13:32'),
(119, 'Paseo Pertiwi', 'AS12347', 0, 'PINJAM', '2024-04-07 09:13:43'),
(120, 'Paseo Pertiwi', 'AS12350', 0, 'PINJAM', '2024-04-07 09:13:48'),
(121, 'Paseo Pertiwi', 'AS12348', 0, 'PINJAM', '2024-04-07 09:13:54'),
(122, 'Paseo Pertiwi', 'AS12346', 0, 'PINJAM', '2024-04-07 09:14:00'),
(123, 'Paseo Pertiwi', 'AS12349', 0, 'PINJAM', '2024-04-07 09:14:10'),
(124, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 09:18:28'),
(125, 'Endri Susanto', 'AS12353', 0, 'PINJAM', '2024-04-07 09:18:32'),
(126, 'Endri Susanto', 'AS12354', 0, 'PINJAM', '2024-04-07 09:18:36'),
(127, 'Endri Susanto', 'AS12355', 0, 'PINJAM', '2024-04-07 09:18:40'),
(128, 'Endri Susanto', 'AS12356', 0, 'PINJAM', '2024-04-07 09:18:46'),
(129, 'Susi Susanti', 'AS12357', 0, 'PINJAM', '2024-04-07 09:19:08'),
(130, 'Susi Susanti', 'AS12358	', 0, 'PINJAM', '2024-04-07 09:19:13'),
(131, 'Susi Susanti', 'AS12358', 0, 'PINJAM', '2024-04-07 09:19:19'),
(132, 'Susi Susanti', 'AS12359', 0, 'PINJAM', '2024-04-07 09:19:26'),
(133, 'Susi Susanti', 'AS12360', 0, 'PINJAM', '2024-04-07 09:19:31'),
(134, 'Gema Show Indo', 'AS12361', 0, 'PINJAM', '2024-04-07 09:19:55'),
(135, 'Mega Febri', 'AS00000', 0, 'PINJAM', '2024-04-07 10:14:06'),
(136, 'Mega Febri', 'AS12987', 0, 'KEMBALI', '2024-04-07 10:58:35'),
(137, 'Mega Febri', 'AS12987', 0, 'PINJAM', '2024-04-07 10:58:39'),
(138, 'Mega Febri', 'AS12987', 0, 'KEMBALI', '2024-04-07 10:58:46'),
(139, 'Mega Febri', 'AS12987', 0, 'PINJAM', '2024-04-07 10:58:48'),
(140, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:03:09'),
(141, 'Endri Susanto', 'AS12987', 0, 'PINJAM', '2024-04-07 12:03:41'),
(142, 'Endri Susanto', 'AS12987', 0, 'KEMBALI', '2024-04-07 12:03:54'),
(143, 'Endri Susanto', 'AS12987', 0, 'PINJAM', '2024-04-07 12:03:56'),
(144, 'Endri Susanto', 'AS12987', 0, 'KEMBALI', '2024-04-07 12:03:57'),
(145, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:19'),
(146, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:20'),
(147, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:21'),
(148, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:21'),
(149, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:22'),
(150, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:23'),
(151, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:23'),
(152, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:24'),
(153, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:24'),
(154, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:25'),
(155, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:26'),
(156, 'Endri Susanto', 'AS12352', 0, 'KEMBALI', '2024-04-07 12:04:26'),
(157, 'Endri Susanto', 'AS12352', 0, 'PINJAM', '2024-04-07 12:04:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `qr` varchar(100) NOT NULL,
  `level` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `qr`, `level`) VALUES
(12, 'Endri Susanto', 'endri.s@samsung.com', '$2y$10$mOXk6CrpQtdgclV2lDYKTOBXHjK2J9HQD4U1lgbpgLgL626/HyFhe', 'qr/Endri Susanto_20240407.png', 'super user'),
(13, 'Budi Santoso', 'budi@samsung.com', '$2y$10$GT6lx8RzwnSyMhDT85YWS.nFB2QgVQy4enjoU6sOozAbb75arHVqC', 'qr/Budi Santoso_20240407.png', 'member'),
(14, 'Susi Susanti', 'susi@samsung.com', '$2y$10$t90g4j40/QtPGPFaU46bneDMal./9SJMjkYYf6CJMXBG7p4bRqg1K', 'qr/Susi Susanti_20240407.png', 'member'),
(15, 'Gema Show Indo', 'gema@samsung.com', '$2y$10$JDNISCh6CwcUSNPPX6MhmeJr./dbcrmJb4WWg98.kbEeJy.kxds7W', 'qr/Gema Show Indo_20240407.png', 'member'),
(16, 'Paseo Pertiwi', 'paseo@samsung.com', '$2y$10$KSYmu2ecni/BVvGs6y0QRObaQN7MBGqEl/tymtF.mzvmrnrhm0vBq', 'qr/Paseo Pertiwi_20240407.png', 'member'),
(17, 'KIKI', 'kiki@samsung.com', '$2y$10$gMpSt9sGa.hUXfn6JHpSk.fLfbK2TWH7zr1JiSbjCNzFJy2d14bhm', 'qr/KIKI_20240407.png', 'member'),
(18, 'Mega Febri', 'mega@samsung.com', '$2y$10$bgD5IhAqqaZElj1tFz4mde2Q.r3HHF5scHaCT9v/HvRbh9FglkQK.', 'qr/Mega Febri_20240407.png', 'member');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `database_sample`
--
ALTER TABLE `database_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `flow_sample`
--
ALTER TABLE `flow_sample`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `database_sample`
--
ALTER TABLE `database_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `flow_sample`
--
ALTER TABLE `flow_sample`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
