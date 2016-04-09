-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 07, 2016 at 10:56 PM
-- Server version: 5.5.47-0ubuntu0.14.04.1
-- PHP Version: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `visit`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `passwd` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `email`, `passwd`) VALUES
(1, 'admin', 'admin@yahoo.com', '1234');

-- --------------------------------------------------------

--
-- Table structure for table `car_reservation`
--

CREATE TABLE IF NOT EXISTS `car_reservation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `location` varchar(50) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE IF NOT EXISTS `city` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `atitude` int(50) NOT NULL,
  `latitude` int(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `rating` int(10) NOT NULL,
  `description` varchar(100) NOT NULL,
  `country_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`id`, `name`, `atitude`, `latitude`, `image`, `rating`, `description`, `country_id`) VALUES
(1, 'mansoura', 0, 0, '/images/city/mansoura.jpg', 9, 'gcygcyugc jkvkrjv kjvhrv\r\nkvljhv', 10),
(2, 'ras el bar ', 0, 0, '/images/city/ras el bar.jpg', 12, 'hckhgc cjhgscy hgchgsch\r\nkjchkjc \r\njcshkj', 10),
(4, '6october', 131, 12121, '/images/city/6october.jpg', 9, 'hghghg hvbhvb fvd\r\nvdnlvn ', 1),
(8, 'giza', 0, 0, '/images/city/giza.jpg', 5, 'jb mbhj bhcb hb hb \r\nhbvhjsbvh', 1),
(9, 'nasrcity', 0, 0, '/images/city/nasrcity.jpg', 3, 'hvkjbjvh hbgjhgj gcjhgjc', 1),
(10, 'oldcairo', 554, 5454, '/images/city/oldcairo.jpg', 22, 'hghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 5),
(11, 'tour', 4, 54545, '/images/city/tour.jpg', 5, 'hjgjghgjhghghgxhx \r\nhbchsbjhsbc', 1),
(12, '3ageba', 54545, 4, '/images/city/3ageba.jpg', 15, 'hgghghhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh', 6),
(13, 'fayed', 434, 454, '/images/city/fayed.jpg', 5, 'hghjgjhg', 4),
(14, 'noba', 675765, 65765, '/images/city/noba.jpg', 6, 'fgfhgf', 9);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(200) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `content`, `post_id`, `user_id`) VALUES
(1, 'ramez', 1, 1),
(5, 'jn jn jv ', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `rating` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `image`, `rating`, `description`) VALUES
(1, 'cairo', '/images/country/cairo.jpg', 10, 'knk'),
(3, 'hkj', '/images/country/2.jpg', 5, 'gjhgjhgj'),
(4, 'ismailia', '/images/country/ismailia.jpg', 9, 'kgkghg uhijvhiuh hvhbv hbvhfbv hhbv '),
(5, 'aswan', '/images/country/aswan.jpg', 2, 'jhkghjgh'),
(6, 'matrou7', '/images/country/matrou7.jpg', 3, 'jhjhj ghguhguygjn j \r\nfjvndkjvndj\r\nlkvnlno jfvnjkf fvn'),
(8, '8 country', '/images/ghghg.jpg', 8, 'ghghghgjgh'),
(9, 'luxor', '/images/country/luxor.jpg', 7, 'gjhjhvghjfgvjhgfvhjgv'),
(10, 'dakhlya', '/images/country/dakhlya.jpg', 3, 'hghjghjghjgjhg jdcnjhchjs\r\ncjhjsdchjk hkchsdgc');

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `address` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `rate` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `hotel`
--

INSERT INTO `hotel` (`id`, `name`, `address`, `email`, `phone`, `rate`, `city_id`) VALUES
(1, 'hotel 1', 'kjcjhjch', 'hotel1@yahoo.com', '012502', 2, 4);

-- --------------------------------------------------------

--
-- Table structure for table `hotel_reservation`
--

CREATE TABLE IF NOT EXISTS `hotel_reservation` (
  `id` int(11) NOT NULL,
  `hotel_id` int(50) NOT NULL,
  `from` datetime NOT NULL,
  `to` datetime NOT NULL,
  `member` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE IF NOT EXISTS `location` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `image` varchar(100) NOT NULL,
  `city_id` int(11) NOT NULL,
  `describtion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `image`, `city_id`, `describtion`) VALUES
(7, 'mansoura1', '/images/location/mansoura1.jpg', 1, 'gjgyg hvghgv hghgv \r\nkhkh'),
(8, 'mansoura2', '/images/location/mansoura2.jpg', 1, 'hggiy hbhjfvb hfvhfbv\r\nvjhjkfvh'),
(9, 'mansoura3', '/images/location/mansoura3.jpg', 1, 'hckjhsckj \r\nckjsldhcjk'),
(10, 'ras el bar1', '/images/location/ras el bar1.jpg', 2, 'hckhsgcjhgkh\r\ncljshjh\r\ncji'),
(11, 'ras el bar2', '/images/location/ras el bar1.jpg', 2, 'ygyg cjhgc cjhgc'),
(12, 'ras el bar1', '/images/location/ras el bar2.jpg', 2, ' hgjhgvh\r\nvjhjfvh \r\nvhjfv');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `title` varchar(30) NOT NULL,
  `content` varchar(200) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `user_id`, `city_id`, `title`, `content`, `image`) VALUES
(2, 1, 1, 'alaaaaa', 'gamsa', '/images/post/alaaaaa.jpg'),
(4, 1, 1, 'post3', 'hfbhbvhf', '/images/post/post3.jpg'),
(5, 1, 12, 'alaa', 'jnhhibhjbbbhu', '/images/post/alaa.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `passwd` varchar(30) NOT NULL,
  `email` varchar(50) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `passwd`, `email`, `gender`, `active`) VALUES
(1, 'jhjh', 'alaa', 'alaa@yahoo.com', 'jhjhh', 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
