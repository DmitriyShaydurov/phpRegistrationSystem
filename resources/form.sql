-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 03, 2020 at 07:52 AM
-- Server version: 5.7.29
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `form`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `email`) VALUES
(3, 'dmitriyshaydurov', '$2y$10$ymCAizu/YyXABHqsQYkS6OpRlM5OEoVILjHmL6BkZ0celNEY23uVm', 'Шайдуров', 'dmitriy.shaydurov@gmail.com'),
(4, 'dmitriy', '$2y$10$4RTJSGYeFsoILfxpFFpRKeFlgp3lbjFOcdn6d0UP8IEFkEpnZbWE6', 'Шайдуров', 'dmitriy.shaydurov@gmail.com'),
(5, 'dmitri', '$2y$10$kt6HwKOsxG..GeZNOWD0oOS1MoVpbKnPB1bMYMQcRmxYczDHstvzK', 'Шайдуров', 'dmitriy.shaydurov@gmail.com'),
(6, 'dm1971', '$2y$10$8JADiGJ5cDrarQaC22OdyuFteiRM2WSZET2H7MU0Cw9LmXgmCm2Fu', 'Дмитрий Шайдуров', 'dmitriy.shaydurov@gmail.com'),
(7, 'dmitriyshaydorov', '$2y$10$ZkBVfAP5H2Gjy3fymLp29u.c6s7O39bgRTDWbn2/i.2R7aL71Jcue', 'Shaydurov', 'dmitriy.shaydurov@gmail.com'),
(8, 'dm', '$2y$10$Ee.al5VvIiHY4b2I8c8rBupHh1r5gjwamvwI64iMARYn9ftQGxzwS', 'Shaydurov', 'dmitriy.shaydurov@gmail.com'),
(9, 'dm1', '$2y$10$m8hlIYgdg4/Tfnuh3QcGKOL5ysyGM00EtHZTRlr2DsVhMZWXFvcu2', 'Shaydurov', 'dmitriy.shaydurov@gmail.com'),
(10, 'dm2', '$2y$10$pPy6VB4AA/tjY4X4yiWsJOLCa4J93tCPm.zqe5l/F/Rvi.tWzCrAG', 'Шайдуров', 'dmitriy.shaydurov@gmail.com'),
(11, 'iv', '$2y$10$WcRVyifC/3nhiB4rJxVLiO2FUub2iGk7zvADzd0p6T4yf09c.D5iW', 'Петров', 'dmitriy.shaydurov@gmail.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
