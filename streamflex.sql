-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 14, 2025 at 07:00 AM
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
-- Database: `streamflex`
--

-- --------------------------------------------------------

--
-- Table structure for table `movies`
--

CREATE TABLE `movies` (
  `movie_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `rating` decimal(3,1) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `release_year` year(4) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `trailer_url` varchar(255) DEFAULT NULL,
  `imdb_url` varchar(255) DEFAULT NULL,
  `tmdb_url` varchar(255) DEFAULT NULL,
  `movie_file_url` varchar(255) NOT NULL,
  `poster_image_url` varchar(255) DEFAULT NULL,
  `uploaded_by` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`movie_id`, `title`, `genre`, `rating`, `language`, `description`, `release_year`, `price`, `trailer_url`, `imdb_url`, `tmdb_url`, `movie_file_url`, `poster_image_url`, `uploaded_by`, `created_at`) VALUES
(1, 'Avatar', 'Action', 7.9, NULL, 'A paraplegic Marine dispatched to the moon Pandora on a unique mission becomes torn between following his orders and protecting the world he feels is his home.', '2009', 50.00, 'https://www.youtube.com/embed/5PSNL1qE6VY', 'https://www.imdb.com/title/tt0499549', 'https://www.themoviedb.org/movie/19995-avatar', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/pxbrFOTV2j8MmZQlfin3dwz5cXV.jpg', 1, '2025-07-13 16:45:29'),
(2, 'Ballerina', 'Thriller', 7.0, NULL, 'An assassin trained in the traditions of the Ruska Roma organization sets out to seek revenge after her father\'s death.', '2025', 100.00, 'https://www.youtube.com/embed/0FSwsrFpkbw', 'https://www.imdb.com/title/tt7181546', 'https://www.themoviedb.org/movie/541671-ballerina', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/2VUmvqsHb6cEtdfscEA6fqqVzLg.jpg', 1, '2025-07-13 16:55:16'),
(4, 'Sinners', 'Drama', 7.7, NULL, 'Trying to leave their troubled lives behind, twin brothers return to their hometown to start again, only to discover that an even greater evil is waiting to welcome them back.', '2025', 80.00, 'https://www.youtube.com/embed/7joulECTx_U', 'https://www.imdb.com/title/tt31193180', 'https://www.themoviedb.org/movie/1233413-sinners', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/1FuibpeOH8Qce0z6pOLrqBc3ttK.jpg', 1, '2025-07-13 17:00:15'),
(5, 'Jurassic World Rebirth', 'Adventure', 6.2, 'English', 'Five years post-Jurassic World: Dominion (2022), an expedition braves isolated equatorial regions to extract DNA from three massive prehistoric creatures for a groundbreaking medical breakthrough.', '2025', 95.00, 'https://www.youtube.com/embed/jan5CFWs9ic', 'https://www.imdb.com/title/tt31036941', 'https://www.themoviedb.org/movie/1234821-jurassic-world-rebirth', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/q0fGCmjLu42MPlSO9OYWpI5w86I.jpg', 1, '2025-07-13 17:02:01'),
(6, 'Jawan', 'Crime', 6.9, NULL, 'A prison warden recruits inmates to commit outrageous crimes that shed light on corruption and injustice - and that lead him to an unexpected reunion.', '2023', 79.00, 'https://www.youtube.com/embed/COv52Qyctws', 'https://www.imdb.com/title/tt15354916', 'https://www.themoviedb.org/movie/872906', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/jFt1gS4BGHlK8xt76Y81Alp4dbt.jpg', 1, '2025-07-13 19:33:35'),
(7, 'Thunderbolts', 'Action', 7.3, 'Indonesian', 'After finding themselves ensnared in a death trap, an unconventional team of antiheroes must go on a dangerous mission that will force them to confront the darkest corners of their pasts.', '2025', 40.00, 'https://www.youtube.com/embed/hUUszE29jS0', 'https://www.imdb.com/title/tt20969586', 'https://www.themoviedb.org/movie/986056-thunderbolts', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/yBdljcPFFaj54aWVgj36MB47Pb6.jpg', 1, '2025-07-13 19:38:41'),
(8, 'Kung Fu Panda 4', 'Animation', 6.7, 'English', 'After Po is tapped to become the Spiritual Leader of the Valley of Peace, he needs to find and train a new Dragon Warrior, while a wicked sorceress plans to re-summon all the master villains whom Po has vanquished to the spirit realm.', '2024', 70.00, 'https://www.youtube.com/embed/_inKs4eeHiI', 'https://www.imdb.com/title/tt21692408', 'https://www.themoviedb.org/movie/1011985-kung-fu-panda-4', 'https://nihalxx1.sol.usbx.me/filebrowser/api/public/dl/A6ObZmey/downloads/KungFuPanda04Final.mp4', 'https://image.tmdb.org/t/p/original/kDp1vUBnMpe8ak4rjgl3cLELqjU.jpg', 1, '2025-07-14 01:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `purchase_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `purchase_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`role_id`, `role_name`) VALUES
(1, 'admin'),
(2, 'normaluser'),
(3, 'subscribeduser');

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `subscription_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('active','expired','cancelled') NOT NULL,
  `transaction_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `transaction_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(100) NOT NULL,
  `status` enum('completed','failed','pending') NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(20) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `phone_number`, `password_hash`, `role_id`, `created_at`) VALUES
(1, 'nihal', 'nihalglobal3@gmail.com', '01705215925', '$2a$12$KSzwpPwLeg.Krenh0J2WuuwcTY.Zk/o6jEUJgCaTzhA6VSU4AiUgy', 1, '2025-07-13 16:44:38'),
(2, 'tanvir', 'tanvir@gmail.com', '01711223344', '$2y$10$TvGHEUSqJpWrNCnCGRm/Nu3DX/jLjvSjaqdHtEEclAFVhS8IDMtbW', 1, '2025-07-14 01:16:36'),
(3, 'fardin', 'fardin@gmail.com', '01611889900', '$2y$10$GWKsy9PAR314.rITUTBxo.ImZpjjg88knVDvhHpXSCHA/kXBBOuza', 2, '2025-07-14 01:16:36'),
(4, 'fardin2', 'fardin2@gmail.com', '0145566332', '$2y$10$/3Xewd1iTpFBfJfRM5I1zekvcL1t0zkx9XmVQvcHPpli.m6W6fnii', 2, '2025-07-14 03:33:22'),
(5, 'fahad', 'fahad@gmail.com', '01711223399', '$2y$10$Jb0qO7hVwuokgwsQ8lIg7eyopKF0zeQBRAs44GDiFRwcGKLN604pO', 2, '2025-07-14 04:48:11'),
(6, 'fahad2', 'fahad2@gmail.com', '01711223398', '$2y$10$Am8E7gzIQ9tAVzUWTNFFouwhP1gLoZdZcEnX9bXNjxTR6UyQbSPeW', 2, '2025-07-14 04:50:18'),
(7, 'siam', 'siam@gmail.com', '01712345678', '$2y$10$Y1xob76Q25oT5Rk2VW4tgO7dpw5Ke2iHwqy0diOaotoKuponLO0KK', 2, '2025-07-14 04:51:27'),
(8, 'ridwan', 'ridwan@gmail.com', '01912457889', '$2y$10$tgdJXopKfXzK/ETpMmERrOkhM0vnuY5WuHnSOG4Qce9mYEuQHLu1a', 2, '2025-07-14 04:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `watch_history`
--

CREATE TABLE `watch_history` (
  `history_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `movie_id` int(11) NOT NULL,
  `watched_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `progress` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `movies`
--
ALTER TABLE `movies`
  ADD PRIMARY KEY (`movie_id`),
  ADD KEY `uploaded_by` (`uploaded_by`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`purchase_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`role_id`),
  ADD UNIQUE KEY `role_name` (`role_name`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`subscription_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`transaction_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone_number` (`phone_number`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `watch_history`
--
ALTER TABLE `watch_history`
  ADD PRIMARY KEY (`history_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `movie_id` (`movie_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `movies`
--
ALTER TABLE `movies`
  MODIFY `movie_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `purchase_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `subscription_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `transaction_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `watch_history`
--
ALTER TABLE `watch_history`
  MODIFY `history_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `movies`
--
ALTER TABLE `movies`
  ADD CONSTRAINT `movies_ibfk_1` FOREIGN KEY (`uploaded_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `purchases`
--
ALTER TABLE `purchases`
  ADD CONSTRAINT `purchases_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `purchases_ibfk_3` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD CONSTRAINT `subscriptions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `subscriptions_ibfk_2` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`transaction_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `watch_history`
--
ALTER TABLE `watch_history`
  ADD CONSTRAINT `watch_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `watch_history_ibfk_2` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`movie_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
