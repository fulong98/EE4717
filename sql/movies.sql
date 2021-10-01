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
-- Table structure for table `movies`
--

CREATE TABLE IF NOT EXISTS `movies` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(50) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  `location` char(30) NOT NULL,
  `details` text NOT NULL,
  `pic_url` text NOT NULL,
  `trailer_url` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `movies`
--

INSERT INTO `movies` (`id`, `name`, `starting_date`, `ending_date`, `location`, `details`, `pic_url`, `trailer_url`) VALUES
(1, 'Marvel', '2021-09-01', '2021-11-23', 'Boon Lay; Funan; Suntec;', '{"Cast":"Simu Liu, Tony Leung, Awkwafina, Michelle Yeoh, Fala Chen, Meng''er Zhang, Florian Munteanu, Ronny Chieng", "Director":"Destin Daniel Cretton", "Genre":"Action/Adventure","Running Time":"132 minutes"}', 'https://www.gv.com.sg/media/imagesresize/img6932.jpg', 'https://www.youtube.com/watch?v=giWIr7U1deA&ab_channel=MarvelEntertainment'),
(2, 'Dune', '2021-09-01', '2021-11-30', 'Boon Lay;', '{"Cast":"Timothée Chalamet, Rebecca Ferguson, Oscar Isaac, Josh Brolin, Stellan Skarsgård, Dave Bautista", "Director":"Destin Daniel Cretton", "Genre":"Action/Adventure","Running Time":"132 minutes"}', 'https://www.gv.com.sg/media/imagesresize/img6840.jpg', 'https://www.youtube.com/watch?v=8g18jFHCLXk&ab_channel=WarnerBros.Pictures'),
(3, 'Escape Room 2: Tournament Of Champions', '2021-09-23', '2021-10-31', 'Funan;Boon Lay;', '{"Cast":"Taylor Russell, Logan Miller, Indya Moore, Holland Roden", "Director":"Adam Robitel", "Genre":"Horror/ Suspense","Running Time":"88 minutes"}', 'https://www.gv.com.sg/media/imagesresize/img6948.jpg', 'https://www.youtube.com/watch?v=vKaMhYrc0ro&ab_channel=KinoCheckInternational'),
(4, 'The Boss Baby: Family Business', '2021-09-15', '2022-01-31', 'Boon Lay; Funan; Suntec;', '{"Cast":"Alec Baldwin, Jeff Goldblum, Ariana Greenblatt, Jimmy Kimmel, Lisa Kudrow, Eva Longoria, James Marsden, Amy Sedaris", "Director":"Tom McGrath", "Genre":"\r\nAnimation","Running Time":"108 minutes"}', 'https://www.gv.com.sg/media/imagesresize/img6880.jpg', 'https://www.youtube.com/watch?v=QPzy8Ckza08&ab_channel=PeacockKids'),
(5, 'Crayon Shinchan the Movie: School Mystery! The Spl', '2021-09-01', '2021-11-30', 'Boon Lay;', '{"Cast":"Yumiko Kobayashi, Tamao Hayashi, Mari Mashiba, Teiyu Ichiryusai, Chie Sato, Ryou Hirohashi,", "Director":"Wataru Takahashi", "Genre":"Animation","Running Time":"105 minutes"}', 'https://media.gv.com.sg/imagesresize/img7210.jpg', 'https://www.youtube.com/watch?v=k_gm1vN1frw&ab_channel=MuseAsia'),
(7, 'Candyman', '2021-09-30', '2021-11-30', ' Funan; Bedok; Boon Lay;', '', 'https://www.gv.com.sg/media/imagesresize/img6809.jpg', 'https://www.gv.com.sg/media/imagesresize/img6809.jpg'),
(8, 'abc', '2021-10-28', '2021-11-04', ' Funan; Bedok; Boon Lay;', '', 'https://www.gv.com.sg/media/imagesresize/img6773.jpg', 'https://www.gv.com.sg/media/imagesresize/img6773.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
