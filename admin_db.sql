-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2025 at 05:53 AM
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
-- Database: `admin_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `candidates_admin`
--

CREATE TABLE `candidates_admin` (
  `id` int(11) NOT NULL,
  `nama_kandidat` varchar(255) NOT NULL,
  `urutan_kandidat` int(11) DEFAULT 0,
  `jenis_kandidat` enum('Ketua','Wakil Ketua') DEFAULT 'Ketua',
  `visi` text DEFAULT NULL,
  `misi` text DEFAULT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `votes` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `elections_admin`
--

CREATE TABLE `elections_admin` (
  `id` int(11) NOT NULL,
  `election_name` varchar(255) NOT NULL,
  `period` date NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `status` enum('Aktif','NonAktif') DEFAULT 'NonAktif',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_admin`
--

CREATE TABLE `login_admin` (
  `id` int(11) NOT NULL,
  `adminID` varchar(100) NOT NULL,
  `adminPass` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `voters_admin`
--

CREATE TABLE `voters_admin` (
  `id` int(11) NOT NULL,
  `voter_id` varchar(50) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `nis` varchar(50) DEFAULT NULL,
  `kelas` varchar(50) DEFAULT NULL,
  `status` enum('Not Voted','Voted') DEFAULT 'Not Voted',
  `voted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `voters_admin`
--

INSERT INTO `voters_admin` (`id`, `voter_id`, `nama`, `nis`, `kelas`, `status`, `voted_at`, `created_at`) VALUES
(1, '001', 'Ahmad Fauzi', '2024001', 'XII RPL 1', 'Not Voted', NULL, '2025-11-16 08:02:14'),
(2, '002', 'Budi Santoso', '2024002', 'XII RPL 1', 'Not Voted', NULL, '2025-11-16 08:02:14'),
(3, '003', 'Citra Dewi', '2024003', 'XII RPL 2', 'Voted', NULL, '2025-11-16 08:02:14'),
(4, '004', 'Dina Permata', '2024004', 'XII RPL 2', 'Not Voted', NULL, '2025-11-16 08:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `votes_admin`
--

CREATE TABLE `votes_admin` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `election_id` int(11) NOT NULL,
  `voted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `candidates_admin`
--
ALTER TABLE `candidates_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elections_admin`
--
ALTER TABLE `elections_admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_admin`
--
ALTER TABLE `login_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`adminID`);

--
-- Indexes for table `voters_admin`
--
ALTER TABLE `voters_admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `voter_id` (`voter_id`),
  ADD UNIQUE KEY `nis` (`nis`);

--
-- Indexes for table `votes_admin`
--
ALTER TABLE `votes_admin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `candidate_id` (`candidate_id`),
  ADD KEY `election_id` (`election_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `candidates_admin`
--
ALTER TABLE `candidates_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `elections_admin`
--
ALTER TABLE `elections_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_admin`
--
ALTER TABLE `login_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `voters_admin`
--
ALTER TABLE `voters_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `votes_admin`
--
ALTER TABLE `votes_admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes_admin`
--
ALTER TABLE `votes_admin`
  ADD CONSTRAINT `votes_admin_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `voters_admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_admin_ibfk_2` FOREIGN KEY (`candidate_id`) REFERENCES `candidates_admin` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_admin_ibfk_3` FOREIGN KEY (`election_id`) REFERENCES `elections_admin` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
