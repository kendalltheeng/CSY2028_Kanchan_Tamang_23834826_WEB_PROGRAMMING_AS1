-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2024 at 02:07 PM
-- Server version: 8.0.30
-- PHP Version: 8.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assignment1`
--

-- --------------------------------------------------------

--
-- Table structure for table `auction`
--

CREATE TABLE `auction` (
  `auction_id` int NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `category` int NOT NULL,
  `end_date` date DEFAULT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `auction`
--

INSERT INTO `auction` (`auction_id`, `title`, `description`, `category`, `end_date`, `user_id`) VALUES
(11, 'Luxury Estate Vehicles Auction', 'Bid on a selection of spacious, high-performance estate vehicles perfect for families and adventurers alike. From luxury comfort to robust utility, find your ideal estate vehicle here.', 10, '2024-04-30', 2),
(12, 'Future-Forward Electric Car Auction', 'Embrace sustainability and innovation with our electric car auction. Bid on cutting-edge electric vehicles equipped with advanced technology and eco-friendly features, leading the way towards a greener future.', 11, '2024-03-31', 2),
(13, 'Performance Sports Cars Extravaganza', 'Rev up your adrenaline with our performance sports cars auction. Experience the thrill of speed and precision as you bid on a range of iconic sports cars designed for ultimate performance on the road and track.', 12, '2024-04-17', 2),
(14, 'Hybrid Innovation Showcase', 'Experience the best of both worlds with our hybrid innovation showcase. Bid on state-of-the-art hybrid vehicles combining fuel efficiency with powerful performance, setting new standards for eco-conscious driving.', 13, '2024-04-11', 2),
(15, 'Eco-Friendly Hybrid Cars Auction', 'Join us in our commitment to sustainability with our eco-friendly hybrid cars auction. Discover a range of efficient and environmentally-conscious vehicles that redefine the driving experience while minimizing your carbon footprint.', 13, '2024-04-24', 2),
(16, 'Sleek Coupe Classics Auction', 'Elevate your driving experience with our sleek coupe classics auction. Bid on a selection of iconic two-door vehicles renowned for their style, performance, and timeless appeal, perfect for enthusiasts and collectors alike', 14, '2024-03-29', 2),
(17, 'Modern Coupe Cars Auction', 'Explore the epitome of contemporary design and performance in our modern coupe cars auction. From elegant luxury coupes to sporty models, find your perfect blend of style and driving dynamics in our curated selection.', 14, '2024-03-31', 2),
(18, 'Classic Estate Cars Auction', 'Discover timeless elegance and practicality in our collection of classic estate cars. Whether you\'re a collector or seeking a vintage ride, explore our range of well-maintained estates from different eras.', 10, '2024-04-18', 2),
(19, 'Affordable Electric Vehicles Auction', 'Join our auction to find affordable electric vehicles that don\'t compromise on performance or style. From compact city cars to versatile crossovers, electrify your driving experience without breaking the bank.', 11, '2024-05-08', 2),
(20, 'vintage Sports Cars Auction', 'Indulge your passion for classic speedsters with our vintage sports cars auction. Explore a curated selection of timeless models, each embodying the spirit of athleticism and style from bygone eras.', 12, '2024-05-01', 2);

-- --------------------------------------------------------

--
-- Table structure for table `bid`
--

CREATE TABLE `bid` (
  `bid_id` int NOT NULL,
  `bid` int NOT NULL,
  `auction_id` int NOT NULL,
  `user_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `category_id` int NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`category_id`, `name`) VALUES
(10, 'Estate'),
(11, 'Electric'),
(12, 'Sports'),
(13, 'Hybrid'),
(14, 'Coupe');

-- --------------------------------------------------------

--
-- Table structure for table `review`
--

CREATE TABLE `review` (
  `review_id` int NOT NULL,
  `reviewtext` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `date` date NOT NULL,
  `user_id` int NOT NULL,
  `author_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`) VALUES
(1, 'admin', 'admin@admin.com', '$2y$12$wWsBHKPXWVdbx9.5zdqt0.sN5xsz.escGq8Zguv7CkZPnhc0LJsDe', 'admin'),
(2, 'user', 'user@user.com', '$2y$12$NQpNSdH09p1D.Lpft978ieMGNl6ELRntCCMRuBgWJ9k0BcJM5Dz.y', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auction`
--
ALTER TABLE `auction`
  ADD PRIMARY KEY (`auction_id`),
  ADD KEY `auctions_category_id_foreign` (`category`),
  ADD KEY `auctions_user_id_foreign` (`user_id`);

--
-- Indexes for table `bid`
--
ALTER TABLE `bid`
  ADD PRIMARY KEY (`bid_id`),
  ADD KEY `bid_auction_id_foreign` (`auction_id`),
  ADD KEY `bid_user_id_foreign` (`user_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `review`
--
ALTER TABLE `review`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `review_user_id_foreign` (`user_id`),
  ADD KEY `review_author_id_foreign` (`author_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auction`
--
ALTER TABLE `auction`
  MODIFY `auction_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `bid`
--
ALTER TABLE `bid`
  MODIFY `bid_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `category_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `review`
--
ALTER TABLE `review`
  MODIFY `review_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `auction`
--
ALTER TABLE `auction`
  ADD CONSTRAINT `auctions_category_id_foreign` FOREIGN KEY (`category`) REFERENCES `category` (`category_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `auctions_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `bid`
--
ALTER TABLE `bid`
  ADD CONSTRAINT `bid_auction_id_foreign` FOREIGN KEY (`auction_id`) REFERENCES `auction` (`auction_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `bid_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Constraints for table `review`
--
ALTER TABLE `review`
  ADD CONSTRAINT `review_author_id_foreign` FOREIGN KEY (`author_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `review_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
