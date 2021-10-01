-- phpMyAdmin SQL Dump
-- version 4.0.10deb1ubuntu0.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 01, 2021 at 03:36 AM
-- Server version: 5.5.62-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `f32ee`
--

-- --------------------------------------------------------

--
-- Table structure for table `confirmation_details`
--

CREATE TABLE IF NOT EXISTS `confirmation_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text NOT NULL,
  `email` text NOT NULL,
  `phone` text NOT NULL,
  `checkout_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `order_id` text NOT NULL,
  `movie_details` text NOT NULL,
  `address` text NOT NULL,
  `price` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `confirmation_details`
--

INSERT INTO `confirmation_details` (`id`, `name`, `email`, `phone`, `checkout_time`, `order_id`, `movie_details`, `address`, `price`) VALUES
(1, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-09-30 17:10:16', 'abc', 'Marvel_2021-10-13_1200_Funan_', 'hall 16, #2-7', 0),
(2, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:28:43', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 0),
(3, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:30:09', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 2560),
(4, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:30:28', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 2560),
(5, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:30:39', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 2560),
(6, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:30:48', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 2560),
(7, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:31:00', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 2560),
(8, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:31:33', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 80),
(9, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:32:33', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 80),
(10, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:36:50', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 110),
(11, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:39:05', 'abc', 'Marvel_2021-09-30_1200_Funan_', 'hall 16, #2-7', 0),
(12, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:41:06', 'abc', 'Marvel_2021-09-30_1200_Funan_""', 'hall 16, #2-7', 0),
(13, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:41:45', 'abc', 'Marvel_2021-09-30_1200_Funan_"A4,A5,A6,B5,B6,C3,C4,C5,C6,D4,D5,D6,"', 'hall 16, #2-7', 120),
(14, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:44:00', 'abc', 'Marvel_2021-09-30_1200_Funan_"A4,A5,A6,B5,B6,C3,C4,C5,C6,D4,D5,D6,"', 'hall 16, #2-7', 120),
(15, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:44:17', 'abc', 'Marvel_2021-09-30_1200_Funan_""', 'hall 16, #2-7', 0),
(16, 'Marvel', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 01:44:51', 'abc', 'Marvel_2021-09-30_1200_Funan_""', 'hall 16, #2-7', 0),
(17, 'abc', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 03:09:02', 'abc', 'abc_2021-10-07_1200_ Bedok_"A3,A4,A5,A6,C3,C4,C5,"', 'hall 16, #2-7', 70),
(18, 'abc', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 03:09:02', 'abc', 'abc_2021-10-07_1200_ Bedok_"A3,A4,A5,A6,C3,C4,C5,"', 'hall 16, #2-7', 70),
(19, 'abc', 'fulong98@hotmail.com', '+6584318390', '2021-10-01 03:09:02', 'abc', 'abc_2021-10-07_1200_ Bedok_"A3,A4,A5,A6,C3,C4,C5,"', 'hall 16, #2-7', 70);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
