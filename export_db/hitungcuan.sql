-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 23, 2022 at 12:44 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hitungcuan`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(9) DEFAULT NULL,
  `foto` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `nama`, `username`, `email`, `password`, `tgl_lahir`, `jenis_kelamin`, `foto`) VALUES
(1, 'Felix Savero', 'felixsavero78', 'felixsavero78@gmail.com', '$2y$10$Xar.nbt9yqjXw3AQsOH9cee1fQIjEj8wIaCW2Nb4FG.JgFjzK65Oq', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `author`
--

CREATE TABLE `author` (
  `id` int(10) NOT NULL,
  `nama` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `author`
--

INSERT INTO `author` (`id`, `nama`) VALUES
(1, 'Felix Savero'),
(2, 'Renard Renady'),
(3, 'Albert Salomo'),
(4, 'Jessica Octavianny'),
(5, 'Dea Afrizal'),
(8, 'Haenim Sunim');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `id_user` int(255) NOT NULL,
  `username` varchar(100) NOT NULL,
  `tanggal` date NOT NULL,
  `teks` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `judul_berita` varchar(100) NOT NULL,
  `gambar` varchar(255) NOT NULL DEFAULT 'berita.png',
  `id_author` int(10) NOT NULL,
  `tanggal_rilis` date NOT NULL DEFAULT '2022-04-01',
  `teks` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `judul_berita`, `gambar`, `id_author`, `tanggal_rilis`, `teks`) VALUES
(1, 'berita', '', 1, '2022-04-01', 'lorem ipsum'),
(2, 'Tes penulis baru 4', '', 1, '2022-04-26', '1'),
(3, 'Tes penulis baru 4', 'cryptocurrency1.jpg', 1, '2022-04-26', '1'),
(4, 'Tes penulis baru 4', '6267e0a3e8636.jpg', 1, '2022-04-26', '1'),
(5, '1adadadda', '6267e0fe375ea.png', 1, '2022-04-26', 'adadad'),
(6, 'Tes penulis baru', 'default.png', 8, '2022-04-26', '1'),
(7, 'Tes penulis baru 4', '6273d59e222c3.jpg', 1, '2022-05-05', 'gojo satoru');

-- --------------------------------------------------------

--
-- Table structure for table `news_comment`
--

CREATE TABLE `news_comment` (
  `id` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_berita` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `tanggal` date NOT NULL,
  `teks` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news_comment`
--

INSERT INTO `news_comment` (`id`, `id_user`, `id_berita`, `username`, `tanggal`, `teks`) VALUES
(3, 1, 3, 'felixsavero87', '2022-05-23', 'tes komentar dengan id berita'),
(4, 1, 3, 'felixsavero87', '2022-05-23', 'tes komentar dengan id berita'),
(5, 1, 3, 'felixsavero87', '2022-05-23', 'tes komentar dengan id berita');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `username` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(9) DEFAULT NULL,
  `foto` varchar(100) NOT NULL DEFAULT 'nophoto.jpg',
  `tgl_gabung` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `nama`, `username`, `email`, `password`, `tgl_lahir`, `jenis_kelamin`, `foto`, `tgl_gabung`) VALUES
(1, 'Felix Savero', 'felixsavero87', 'felixsavero78@gmail.com', '$2y$10$0rdAFIKg4WDKQYubENhDz.1XhKBxi7D5Fcan3lugIdnn1EtFJuIbK', '2022-03-01', 'Laki-laki', 'childe.png', '2022-03-05'),
(3, 'pelik sapero', 'pelik', 'peliksapero78@gmail.com', '$2y$10$juUNez1HWFiUCIe9sxJ24.AWY5vlGfo6ayTD/ZESSxuseid6i3DBW', '0000-00-00', '', 'nophoto.jpg', '2022-05-23');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_USERS_ID` (`id_user`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_author_id` (`id_author`);

--
-- Indexes for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_berita_id` (`id_berita`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nama` (`nama`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `author`
--
ALTER TABLE `author`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `news_comment`
--
ALTER TABLE `news_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `FK_USERS_ID` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`);

--
-- Constraints for table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `fk_author_id` FOREIGN KEY (`id_author`) REFERENCES `author` (`id`);

--
-- Constraints for table `news_comment`
--
ALTER TABLE `news_comment`
  ADD CONSTRAINT `fk_berita_id` FOREIGN KEY (`id_berita`) REFERENCES `news` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
