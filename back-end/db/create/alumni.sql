-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2022 at 10:33 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni`
--
CREATE DATABASE IF NOT EXISTS `alumni` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `alumni`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL UNIQUE,
  `password` varchar(50) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `fn` int(11) NOT NULL UNIQUE,
  `email` varchar(50) NOT NULL UNIQUE,
  `address` varchar(50) NOT NULL, 
  `graduation` year(4) DEFAULT 1970,
  `major` varchar(50) NOT NULL,
  `group` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `fn`, `email`, `address`, `graduation`, `major`, `group`) VALUES
(2, 'sjdejanova', '$2y$10$kfa3dpzmQACfmNdtHS4OUOKNssNZbIRHyMr4K7kpy/Y', 'Silvia Deyanova', 62123, 'sjdejanova@uni-sofia.bg', 'Sofia, Bulgaria', 2023, 'Software Engineering', 3),
(3, 'stanislgi1', '$2y$10$g0cNI/o3HbVmbwZkLXuuKuqbvJNr4/b3TWIU6vXTzSe', 'Stanislava Ivanova', 62463, 'stanislgi1@uni-sofia.bg', 'Sofia, Bulgaria', 2023, 'Software Engineering', 3),
(4, 'arhalachev', '$2y$10$uaDBQbImO2I0OyPZ8IlUwuM0FUE5inxsSIkjF7Gf0ki', 'Asibe Halacheva', 62497, 'arhalachev@uni-sofia.bg', 'Sofia, Bulgaria', 2023, 'Software Engineering', 3);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

/*CREATE TABLE categories (
cat_id INT(8) NOT NULL AUTO_INCREMENT,
cat_name VARCHAR(255) NOT NULL,
cat_description VARCHAR(255) NOT NULL,
UNIQUE INDEX cat_name_unique (cat_name),
PRIMARY KEY (cat_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/
-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
`topic_id` INT(8) NOT NULL AUTO_INCREMENT,
`topic_name` VARCHAR(255) NOT NULL,
`topic_subject` VARCHAR(255) NOT NULL,
`topic_date` DATETIME NOT NULL,
`topic_by` INT(8) NOT NULL,
FOREIGN KEY (topic_by) REFERENCES users(id),
PRIMARY KEY (topic_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- link topics to categories



-- topics to user


-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
