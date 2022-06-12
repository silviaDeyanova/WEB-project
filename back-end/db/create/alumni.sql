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
  `id` int(11) NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `username` varchar(30) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `full_name` varchar(50) NOT NULL,
  `fn` int(11) NOT NULL UNIQUE,
  `email` varchar(50) NOT NULL UNIQUE,
  `graduation` year(4),
  `major` varchar(50),
  `groupN` int(10)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `full_name`, `fn`, `email`, `graduation`, `major`, `groupN`) VALUES
(1, 'sjdejanova', '$2y$10$yXoONHqZ9lExslTyk1wFJ./4b2FpMkRzKy9XDPObWIgSxiEwWlg22', 'Silvia Deyanova', 62448, 'sjdejanova@uni-sofia.bg', 2023, 'Software Engineering', 3),
(2, 'stanislgi1', '$2y$10$foJL0YFlm0kJKjQVbVDl3O0ZT1nzfagpeYG4Qg0efhmaKeluVmEJW', 'Stanislava Ivanova', 62463, 'stanislgi1@uni-sofia.bg', 2023, 'Software Engineering', 3);

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
`topic_by` INT(8) NOT NULL,
FOREIGN KEY (topic_by) REFERENCES users(id),
PRIMARY KEY (topic_id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- topics to user

INSERT INTO `topics` (`topic_id`, `topic_name`, `topic_subject`, `topic_by`) VALUES
(2, 'Тема 1 ', 'Описание', 2);

INSERT INTO `topics` (`topic_name`, `topic_subject`, `topic_by`) VALUES
('Тема 2 ', 'Описание ново', 2);

INSERT INTO `topics` (`topic_name`, `topic_subject`,`topic_by`) VALUES
('Тема 3 ', 'Проба', 2);



-- --------------------------------------------------------



/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
