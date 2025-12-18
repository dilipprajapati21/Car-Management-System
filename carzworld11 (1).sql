-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 03:58 PM
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
-- Database: `carzworld11`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `password`) VALUES
(1, 'ashvin', 'admin123'),
(2, 'dilip', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `car` varchar(50) NOT NULL,
  `booking_date` date NOT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(20) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `email`, `phone`, `car`, `booking_date`, `message`, `created_at`, `status`) VALUES
(2, 'DILIP PRAJAPATI', 'dp234@gmail.com', '9579567767', 'SUV', '2025-09-11', 'nice to interact', '2025-09-19 18:05:39', 'Approved'),
(5, 'nitesh patel', 'nkpra@gmail.com', '7686686868', 'Hatchback', '2025-09-11', 'no one', '2025-09-21 04:27:05', 'Pending'),
(6, 'hardik', 'hardik123@gmail.com', '9427683719', 'Luxury Sedan', '2025-09-09', 'nice\r\n', '2025-09-22 17:46:59', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` varchar(50) NOT NULL,
  `engine` varchar(100) DEFAULT NULL,
  `mileage` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`id`, `name`, `price`, `engine`, `mileage`, `description`, `image`) VALUES
(1, 'fortuner legendar', '5000000', '567kps', '45/km', 'smoothly running', 'car1img.jpg'),
(2, 'fortunner sports', '20,00,000', '678lgh', '60/km', 'well structured', 'carimg3.jpg'),
(3, 'newSimbha', '60,00,000', 'ghz++', '100/km', 'very superfast', 'car1.jpg'),
(4, 'suv', '20,00,000', '1200cc', '100/km', 'look is best \r\n', 'download3.jpg'),
(5, 'inova', '20,00,000', '1200cc', '100/km', 'nice', 'download3.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contacts1`
--

CREATE TABLE `contacts1` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts1`
--

INSERT INTO `contacts1` (`name`, `email`, `message`) VALUES
('DILIP PRAJAPATI', 'dp45@gmail.com', 'i want to extra rental services'),
('ashvin', 'ashvin@123.com', 'nice cars'),
('hardik', 'hardik123@gmail.com', 'nice'),
('naresh', '', ''),
('naresh', 'naresh123@gmail.com', 'nice to meet you ');

-- --------------------------------------------------------

--
-- Table structure for table `my_bookings`
--

CREATE TABLE `my_bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `car` varchar(100) DEFAULT NULL,
  `booking_date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` varchar(50) DEFAULT 'Pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `car` varchar(100) NOT NULL,
  `address` text NOT NULL,
  `payment` varchar(50) NOT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `email`, `phone`, `car`, `address`, `payment`, `order_date`) VALUES
(1, 'vipul prajapati', 'vips123@gmail.com', '9579567767', 'fortuner++', 'palanpur gujrat-385001', 'upi', '2025-09-20 16:48:28'),
(2, 'vipul prajapati', 'vips123@gmail.com', '9579567767', 'fortuner++', 'palanpur gujrat-385001', 'upi', '2025-09-20 16:50:21'),
(3, 'kiran sen', 'kiran009@gmail.com', '8799699132', 'lagendar', 'dhanera gujrat 385310', 'credit', '2025-09-20 16:51:37'),
(5, 'hardik\\\\', 'hardik123@gmail.com', '9427683719', '2025', 'maheshana ', 'upi', '2025-09-22 17:45:00'),
(6, 'hitnai', 'hit123@gmail.com', '987456123', '2025', 'palanpur', 'cod', '2025-09-25 06:22:14'),
(7, 'hitnai', 'ashvin@123.com', '9427683719', '2025', 'palanpur', 'debit', '2025-09-25 06:27:40'),
(9, 'kirit prajapati', 'kirit67@gmail.com', '8980101091', '2024', 'deesa', 'credit', '2025-09-25 06:33:27'),
(10, 'kirit prajapati', 'kirit67@gmail.com', '8980101091', '2024', 'deesa', 'credit', '2025-09-25 06:34:59'),
(11, 'swet patel', 'swet67@gmail.com', '9824127132', '2023', 'dhanera', 'upi', '2025-09-25 06:36:01'),
(12, 'nikhil', 'nikhil123@gmail.com', '1234567889', 'fortuner legender', 'ambaji', 'cod', '2025-09-26 10:05:00'),
(13, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'upi', '2025-10-01 03:20:35'),
(14, 'nikhil rana', 'nikhil45@gmail.com', '8799699132', '4056', 'deesa', 'credit', '2025-10-01 07:35:48'),
(15, 'nikhil rana', 'nikhil45@gmail.com', '8799699132', '4056', 'deesa', 'credit', '2025-10-01 07:36:49'),
(16, 'dilip', 'ayush123@gmail.com', '09054696426', '2025', 'kj', 'upi', '2025-10-08 03:15:46'),
(17, 'dilip', 'ayush123@gmail.com', '09054696426', '2025', 'kj', 'upi', '2025-10-08 03:17:34'),
(18, 'dilip', 'ayush123@gmail.com', '09054696426', '2025', 'kj', 'upi', '2025-10-08 03:18:44'),
(19, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 03:30:49'),
(20, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 03:35:54'),
(21, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 03:38:17'),
(22, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 03:39:30'),
(23, 'dilip', 'ayush123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 03:40:11'),
(24, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'kj', 'debit', '2025-10-08 03:44:37'),
(25, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'kj', 'debit', '2025-10-08 04:08:24'),
(26, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'kj', 'cod', '2025-10-08 04:09:01'),
(27, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'kj', 'debit', '2025-10-08 04:16:37'),
(28, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'kj', 'debit', '2025-10-08 04:16:55'),
(29, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:18:02'),
(30, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:21:40'),
(31, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:25:23'),
(32, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:25:54'),
(33, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'debit', '2025-10-12 03:29:35'),
(34, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'debit', '2025-10-12 03:32:11'),
(35, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:43:59'),
(36, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:44:28'),
(37, 'vijay', 'vijay123@gmail.com', '09054696426', '123', 'palanpur', 'cod', '2025-10-12 03:45:32'),
(38, 'navin', 'navin123@gmail.com', '09054696426', '2025', 'palanpur', 'cod', '2025-10-12 04:16:46'),
(39, 'mitesh prajapati', 'miteshp748@gmail.com', '8799699132', '2025', 'deesa', 'cod', '2025-10-13 04:54:05'),
(40, 'navin', 'navin123@gmail.com', '09054696426', '2025', 'palanpur', 'upi', '2025-11-09 03:16:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `profile_pic` varchar(255) DEFAULT 'default-profile.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `profile_pic`) VALUES
(2, 'ashvin05', 'ashvinprajapati748@gmail.com', 'ashvin001', '2025-09-18 02:47:59', 'default-profile.jpg'),
(4, 'nirav09', 'niravp4@gmail.com', '3456', '2025-09-19 11:48:54', 'default-profile.jpg'),
(5, 'vipul', 'vip234@gmail.com', '$2y$10$yIooLBxdB9ifJuhh6m4wDObtryIncJpCTbbQzIlIm3fS8LsQt/olu', '2025-09-19 12:41:35', 'default-profile.jpg'),
(6, 'nitesh', 'nitesh45@gmail.com', '$2y$10$Zv4cHnjKzGXO6BPbvq1yOOTm6Bv5kRUfDXvMYzFAZPm5Tkde7zNM.', '2025-09-19 13:36:30', 'default-profile.jpg'),
(8, 'hp06', 'hp23@gmail.com', '$2y$10$BCLeSn36/VSvkyKJhMSHQe0xG1LXhE.dqyXifCAiGla3ZCgXBRRvy', '2025-09-19 15:00:20', 'default-profile.jpg'),
(9, 'sanjay', 'sanjay34@gmail.com', '$2y$10$pVr0bjuEviYCgNaoJ1GYNufIa/p/n3vjPaD2iPBHXHajAYhjoqP4m', '2025-09-21 03:49:24', 'default-profile.jpg'),
(10, 'hardik', 'hardik123@gmail.com', '$2y$10$hjogKhmllhPNrQGMzJFMyOqN/7hYozVC1mgBYssSwBQ2RA9qSZ1Qm', '2025-09-22 17:37:56', 'default-profile.jpg'),
(11, 'shakshi', 'shakshi123@gmail.com', '$2y$10$Ef1dEVuKwqExiccnPbUktuTiNu3oa4VoO.0/Le7rQsZ0bWfDtPnXu', '2025-09-25 05:21:26', 'default-profile.jpg'),
(12, 'rita', 'rita123@gmail.com', '$2y$10$KLShnwSBbqcHDJWKdM0yNeA2c8Z5/7R9cl55Yg4ggCV6U89EQSBEG', '2025-09-25 05:26:58', 'default-profile.jpg'),
(13, 'hit', 'hi123@gmail.com', '$2y$10$88mfvuKj.JiQ0OWzykqp1uaFwyFMu8yT7RPKFTvjLN7RAEBIuUG8G', '2025-09-25 06:19:44', 'default-profile.jpg'),
(14, 'alpesh bhai', 'alpesh123@gmail.com', '$2y$10$HT2o6l9HzGQX33MOg7Ij6uRNiaKbgAMTqEaevN36O3iu.5aca4pJu', '2025-09-25 06:39:54', 'default-profile.jpg'),
(15, 'rajesh', 'rajesh123@gmail.com', '$2y$10$vO6TyTikgjdl91tUZBvQnOujQdFhHGSJcKvTXueN45LStkhqhQ2Lu', '2025-09-26 07:35:32', 'default-profile.jpg'),
(16, 'nihal', 'nikhil123@gmail.com', '$2y$10$5RlE3gvo00Pqt2cmeGEtn.e/HZg2E6FV920hWpSSMCx/wXkM/ZMUC', '2025-09-26 10:03:40', '1759058004_Screenshot 2025-06-14 162621.png'),
(17, 'ayush', 'ayush123@gmail.com', '$2y$10$9UFKhmOc7T9yrUrRGi7YDuvm8dZz9j7Ini9hQ4bxq/gDDywF5ffuG', '2025-09-28 13:11:15', 'default-profile.jpg'),
(18, 'vijay', 'vijay123@gmail.com', '$2y$10$WfXCmW1KeG2QWWzc9iAqx.2B2V8zRyyBYPPPXRtev2ozuQwp5w7qW', '2025-10-01 05:59:16', 'default-profile.jpg'),
(19, 'navin', 'navin123@gmail.com', '$2y$10$claHqTBtRnyfg/Lz5qW5KuKsNNfxN4./NCzJJYo0q.4KBrSroDZGW', '2025-10-12 04:15:57', 'default-profile.jpg'),
(20, 'mitesh', 'miteshp748@gmail.com', '$2y$10$1A8JZV9v5ZvjV7gsI5uHFeXC4p9.wCpdLAJ4hlXSYA7J4xBTJdc7y', '2025-10-13 04:52:00', 'default-profile.jpg'),
(21, 'vishal', 'vishal123@gmail.com', '$2y$10$v6I/UaPIE4IZ0Mk.q.1a..ve4uZRSDLtyI5eErjSCGFBa5MVuIqG6', '2025-11-09 03:24:33', 'default-profile.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `my_bookings`
--
ALTER TABLE `my_bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `my_bookings`
--
ALTER TABLE `my_bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `my_bookings`
--
ALTER TABLE `my_bookings`
  ADD CONSTRAINT `my_bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
