-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 09, 2021 at 02:28 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `real_time_table`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `post_title` varchar(80) NOT NULL,
  `post_desc` varchar(80) NOT NULL,
  `count` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `post_title`, `post_desc`, `count`, `user_id`, `created_at`) VALUES
(1, 'My Post', 'This is my post', 1, 1, '2021-04-09 07:41:29'),
(2, 'My Post', 'This is my post', 5, 2, '2021-04-09 07:41:29'),
(3, 'My Post', 'This is my post', 3, 3, '2021-04-09 07:41:29'),
(4, 'My Post', 'This is my post', 4, 4, '2021-04-09 07:41:29'),
(5, 'My Post', 'This is my post', 8, 5, '2021-04-09 07:41:29'),
(6, 'My Post', 'This is my post', 10, 6, '2021-04-09 07:41:29'),
(7, 'My Post', 'This is my post', 15, 7, '2021-04-09 09:26:01'),
(8, 'My Post', 'This is my post', 17, 8, '2021-04-09 07:41:29'),
(9, 'My Post', 'This is my post', 22, 9, '2021-04-09 07:41:29'),
(10, 'My Post', 'This is my post', 27, 10, '2021-04-09 07:41:29'),
(11, 'My Post', 'This is my post', 14, 11, '2021-04-09 09:26:44'),
(12, 'My Post', 'This is my post', 16, 12, '2021-04-09 07:41:29'),
(13, 'My Post', 'This is my post', 25, 13, '2021-04-09 07:41:29'),
(14, 'My Post', 'This is my post', 44, 14, '2021-04-09 09:26:37'),
(15, 'My Post', 'This is my post', 19, 15, '2021-04-09 07:41:29'),
(16, 'My Post', 'This is my post', 21, 16, '2021-04-09 09:27:01'),
(17, 'My Post', 'This is my post', 19, 17, '2021-04-09 09:27:07'),
(18, 'My Post', 'This is my post', 45, 18, '2021-04-09 09:27:48'),
(19, 'My Post', 'This is my post', 23, 19, '2021-04-09 07:41:29'),
(20, 'My Post', 'This is my post', 25, 20, '2021-04-09 09:27:31');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `status`) VALUES
(1, 'User-1', 0),
(2, 'User-2', 0),
(3, 'User-3', 0),
(4, 'User-4', 0),
(5, 'User-5', 0),
(6, 'User-6', 0),
(7, 'User-7', 0),
(8, 'User-8', 0),
(9, 'User-9', 0),
(10, 'User-10', 0),
(11, 'User-11', 0),
(12, 'User-12', 0),
(13, 'User-13', 0),
(14, 'User-14', 0),
(15, 'User-15', 0),
(16, 'User-16', 0),
(17, 'User-17', 0),
(18, 'User-18', 0),
(19, 'User-19', 0),
(20, 'User-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
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
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
