-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 15, 2016 at 10:21 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travel_agency`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` text NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `image` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `display_name`, `username`, `password`, `email`, `image`, `usertype`, `status`) VALUES
(1, 'Mandip Tharu', 'memandip', 'mandip', '0318c4a8cca2117b58485f595e65a67416410646', 'mandip810@gmail.com', 'Me.jpg', 'admin', 1),
(2, 'Mandip Tharu', 'mandy', 'memandip', '0ceb282f27e7eeb69c0249fbd5b2ba79e9f2716a', 'mandip810@gmail.com', 'PhotoFunia_042861233.jpg', 'admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ordered_package`
--

CREATE TABLE IF NOT EXISTS `ordered_package` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` int(11) NOT NULL,
  `country` varchar(100) NOT NULL,
  `package_desc` blob NOT NULL,
  `query` varchar(100) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ordered_package`
--

INSERT INTO `ordered_package` (`id`, `customer_name`, `email`, `phone`, `country`, `package_desc`, `query`, `status`) VALUES
(2, 'Mandip tharu', 'chaudhary_mandip@yahoo.com', 987878878, 'Nepal', '', 'I don''t have any queries........', 0),
(4, 'Mandip tharu', 'chaudhary_mandip@yahoo.com', 2147483647, 'Finland', 0x4920776f756c64206c696b6520746f207265717565737420796f75206120746f757220746f206d757374616e6720696e206166666f726461626c652070726963652e20497420776f756c64206265206265747465722069662074686520746f757220776f756c6420636f6d65207769746820736f6d6520666163696c69746965732061732077656c6c2e, 'I have no queries at all.', 1),
(5, 'mandip''s tour package', 'chaudhary_mandip@yahoo.com', 2147483647, 'Nepal', 0x5c2773205c272073205c2773205c2773205c2773205c277320, 'Please provide me some details as soon as possiable.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_by`
--

CREATE TABLE IF NOT EXISTS `order_by` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `query` varchar(250) NOT NULL,
  `country` varchar(250) NOT NULL,
  `phone` varchar(250) NOT NULL,
  `packages_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `phone` (`phone`),
  KEY `packages_id_2` (`packages_id`),
  KEY `packages_id_3` (`packages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `order_by`
--

INSERT INTO `order_by` (`id`, `name`, `email`, `query`, `country`, `phone`, `packages_id`, `status`) VALUES
(1, 'Mandip tharu', 'chaudhary_mandip@yahoo.com', 'I have no queries at all.', 'Nepal', '989898989898', 1, 0),
(7, 'memandip', 'mandip810@gmail.com', 'Please provide some details about it''s cost.', 'USA', '989898989', 2, 1),
(8, 'Monika Thapa', 'monika0518@gmail.com', 'No queries yet.......', 'Nepal', '9817145474', 7, 1),
(9, 'Mandip tharu', 'memandip810@gmail.com', 'I want this package available as soon as possible.', 'Nepal', '988989898', 1, 1),
(10, 'Mandip tharu', 'chaudhary_mandip@yahoo.com', 'I want this package available as soon as possible.', 'Nepal', '9817145474', 1, 1),
(11, 'Mandip tharu', 'chaudhary_mandip@yahoo.com', 'I want this package available as soon as possible.', 'Nepal', '9817145474', 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `order_feedback`
--

CREATE TABLE IF NOT EXISTS `order_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_by_id` int(11) NOT NULL,
  `status` varchar(250) NOT NULL,
  `feedback` text NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `order_by_id` (`order_by_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL,
  `image` varchar(250) NOT NULL,
  `description` longblob NOT NULL,
  `status` tinyint(1) NOT NULL,
  `added_by` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`id`, `title`, `image`, `description`, `status`, `added_by`) VALUES
(1, 'Barcelona', 'nou_camp.jpg', 0x54686973207061636b61676520697320666f722074686f73652077686f20776f756c64206c6f766520746f20676f20746f2074726176656c20666f722042617263656c6f6e612e, 1, 'mandip'),
(2, 'Pokhara tour ', 'Awesome himalaya.jpg', 0x54686973206973206f6e65206f6620746865206265737420706c61636520746f207370656e6420796f7572207661636174696f6e2e20416e64206974277320616c736f206f6e65206f6620746865206265737420706c61636520696e2074686520776f726c642e, 0, 'mandip'),
(4, 'Europe tour', 'Etretat france.jpg', 0x5468697320746f75722069732064656469636174656420746f2074686f73652077686f206861766520647265616d656420746f2074726176656c204575726f7065206275742061726520756e61626c6520746f2066756c66696c6c207468617420647265616d2064756520746f20736f6d652070726f626c656d732e205765206f6666657220616e206174747261637469766520616e64206578636c757369766520746f7572207061636b6167657320746f20736f6d65206e65766572206265666f7265206578706c6f72656420706c6163657320696e204575726f70652e20416e6420776520616c736f206f666665722074686973207061636b61676520696e207375636820612068616e64736f6d6520616e64206166666f726461626c652070726963652e, 1, 'mandip'),
(5, 'Bardiya National Park Tour', 'africanwildlife5.jpg', 0x54686973207061636b61676520697320666f722074686f73652077686f206c6f766520746f207365652077696c646c6966652066726f6d20746865206e6561722e205468697320746f7572206665617475726573206d616e79206f662074686520666163696c69746965732e, 1, 'mandip'),
(6, 'Mustang Tour', '11_harvesttime.jpg', 0x5468697320746f7572207061636b61676520697320666f722074686f73652077686f20776f756c64206c6f766520746f2074726176656c20616e64207472656b2061206c6f742e204d757374616e672069732063616c6c65642061732074686520646573657274206f6620746865206d6f756e7461696e20726567696f6e2e204920626574206f757220637573746f6d65727320776f756c64206c6f766520746f2074726176656c204d757374616e672e20, 1, 'mandip'),
(7, 'Chitwan National Park Tour', 'africanwildlife14.jpg', 0x54686973206973206f7572206578636c757369766520746f7572207468617420696e766f6c76657320746865206a756e676c65207361666172692e204f757220637573746f6d65722063616e2063686f6f736520686f7720746865792077616e7420746f2074726176656c20746865206a756e676c6520696e206a656570206f7220696e20656c657068616e742e2054686973207061636b616765206973206f75722062657374207061636b61676520617661696c61626c65207965742e, 1, 'mandip'),
(8, 'ulalala tour', 'the-minions-have-the-phone-box-reprint-detail_95383.jpg', 0x5468697320746f75722069732064656469636174656420746f2074686f73652077686f20776f756c64206c6f766520746f2074726176656c20746f206d696e696f6e20636974792e205765206861766520616e206578636c75736976652064696e6e65722077697468204d722e2047727520616c6f6e67207769746820616c6c20746865206d696e696f6e732e20536f2c2067657420726561647920666f72207468697320756c616c616c6120746f75722e200d0a2d2d2d2d6f6820646573706963616265206d65203a29, 1, 'mandip');

-- --------------------------------------------------------

--
-- Table structure for table `pricing_table`
--

CREATE TABLE IF NOT EXISTS `pricing_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `package_id` int(11) NOT NULL,
  `persons` int(11) NOT NULL,
  `price` int(11) NOT NULL,
  `days` int(11) NOT NULL,
  `facilities` blob NOT NULL,
  PRIMARY KEY (`id`),
  KEY `package_id` (`package_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `pricing_table`
--

INSERT INTO `pricing_table` (`id`, `package_id`, `persons`, `price`, `days`, `facilities`) VALUES
(2, 1, 5, 2000000, 20, 0x6d616e7920666163696c69746965732077696c6c2062652070726f766964656420686572652e2057652074616b6520676f6f642063617265206f66206f757220637573746f6d6572732e),
(3, 2, 5, 3000000, 30, 0x57652077696c6c2074727920746f2070726f76696465206173206d616e7920666163696c69746965732061732077652063616e20746f206d616b65206f757220637573746f6d657273206d6f726520616464696374656420746f206f7572207061636b616765732e),
(4, 4, 10, 40000000, 100, 0x77652077696c6c2074727920746f2070726f76696465206173206d616e7920666163696c69746965732061732077652063616e20746f206d616b65206f757220637573746f6d6572732068617070792e2049207468696e6b206e6f206f6e6520656c73652063616e2074616b652073756368206120676f6f642063617265206f6620746865697220637573746f6d65727320696e207468652077617920776520646f2e),
(5, 5, 10, 5000000, 150, 0x77652077696c6c2074727920746f2070726f76696465206173206d616e7920666163696c69746965732061732077652063616e20746f206d616b65206f757220637573746f6d6572732068617070792e2049207468696e6b206e6f206f6e6520656c73652063616e2074616b652073756368206120676f6f642063617265206f6620746865697220637573746f6d65727320696e207468652077617920776520646f2e),
(6, 6, 40, 6000000, 100, 0x77652077696c6c2074727920746f2070726f76696465206173206d616e7920666163696c69746965732061732077652063616e20746f206d616b65206f757220637573746f6d6572732068617070792e2049207468696e6b206e6f206f6e6520656c73652063616e2074616b652073756368206120676f6f642063617265206f6620746865697220637573746f6d65727320696e207468652077617920776520646f2e),
(7, 8, 124, 149999988, 100, 0x77652077696c6c2074727920746f2070726f76696465206173206d616e7920666163696c69746965732061732077652063616e20746f206d616b65206f757220637573746f6d6572732068617070792e2049207468696e6b206e6f206f6e6520656c73652063616e2074616b652073756368206120676f6f642063617265206f6620746865697220637573746f6d65727320696e207468652077617920776520646f2e),
(8, 1, 11, 41092489, 100, 0x616c6c206b696e6473206f6620666163696c69746965732077696c6c2062652070726f766964656420686572652e);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` text NOT NULL,
  `display_name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `image` varchar(100) NOT NULL,
  `usertype` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `full_name`, `display_name`, `username`, `password`, `email`, `image`, `usertype`, `status`) VALUES
(4, 'Mandip Tharu', 'mandy', 'mandip', '0ceb282f27e7eeb69c0249fbd5b2ba79e9f2716a', 'mandip810@gmail.com', 'PhotoFunia_042861233.jpg', 'user', 1),
(6, 'Mandip Tharu', '', 'memandip', '0ceb282f27e7eeb69c0249fbd5b2ba79e9f2716a', 'chaudhary_mandip@yahoo.com', 'mandip.jpg', 'user', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `order_feedback`
--
ALTER TABLE `order_feedback`
  ADD CONSTRAINT `order_feedback_ibfk_1` FOREIGN KEY (`order_by_id`) REFERENCES `order_by` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `pricing_table`
--
ALTER TABLE `pricing_table`
  ADD CONSTRAINT `pricing_table_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `packages` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
