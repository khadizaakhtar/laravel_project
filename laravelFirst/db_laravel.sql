-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2014 at 12:01 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_laravel`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE IF NOT EXISTS `tbl_admin` (
  `ID` int(2) NOT NULL AUTO_INCREMENT,
  `type` varchar(10) NOT NULL,
  `remember_token` varchar(500) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `image` varchar(200) NOT NULL,
  `activation` int(1) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`ID`, `type`, `remember_token`, `firstname`, `lastname`, `username`, `email`, `password`, `image`, `activation`) VALUES
(5, 'admin', '6gy5Da5G89MrbvXZLnt5m9YdCSyHQmkscGVY5j1cCEc4DIGSIhz0C4eEAvdH', 'tarek', 'monjur', 'tarek', 'tarek_21ahammed@yahoo.com', '$2y$10$jB99UvWcBKLaY1OOoX5vT.kYeps3xooOUmJpApyxDnsNfWeVocPpy', '1416046828.jpg', 1),
(8, '', 'TfZukEahPzAoxH81EtNhS1U1mxfDI2IhORAXp97sa1NRh5aMLHhwG4sz06OZ', 'monjur', 'islam', 'test', 'test@gmail.com', '$2y$10$Wo4mz4txDREpueOdGeKXtO64Mi/c836NZMpbFiGwt/X2W6tmbQNpK', 'CLZ5pX.jpg', 1),
(9, '', '', 'Mon', 'Jur', 'mon', 'mon@gmail.com', '$2y$10$R4/inzqENl2CeFtgWjY3eeQEIojptsL5A.aKDyI0swdf0JEENIh2e', 'AySFlp.jpg', 1),
(10, '', '', 'Asad', 'Hossin', 'asad', 'asad@gmail.com', '$2y$10$zUmmnEaByZWo1VcAwrwcJ.DLSPZs93T.SqmyyRphnr4st1fXg2NHS', 'uhK1tD.jpg', 1),
(11, '', '', 'Asik', 'Hossin', 'asik', 'asik@gmail.com', '$2y$10$F4wxAkoKf6SJrvBeZolWQexLaoBKSz1Sx2dzPYHdeHBnCrfmEGJb2', 'QLnXLw.jpg', 1),
(12, '', '', 'Fahim', 'Hossin', 'fahim', 'fahim@gmail.com', '$2y$10$kGMa5wo/wSCBdeMFNyTAUugr7Xy4QWpPmW3eLE89byfRKvgbbJnh2', 'UhERVw.jpg', 1),
(13, '', '', 'Samir', 'Hossin', 'samir', 'samir@gmail.com', '$2y$10$L60bir3FR3qLC6FSKW8nFuDUIHeQEGowi6V1QhbBJuph2hxnwkxwG', 'WMhXMc.jpg', 1),
(14, 'admin', 'WqlNUYGaqgBYDjN8RPx5uH2UyvFu4UKIaFgZ0Q0hyAUamLBZ8AZ1f3YCDIWm', 'laravel', 'admin', 'admin', 'admin@gmail.com', '$2y$10$hYz6exxVjnI18xyYv/EkWOc/8ZUhB9EGbY86m2EeSJWmhir9.FDja', 'iOlvT8.jpg', 1),
(15, 'admin', 'HlZxtrQnO8osdVo28jfSLrW8fpX38xfRbQU15l8tw7oqueASWYX66MxpsC5k', 'tarek', 'monjur', 'tarekmonjur', 'tarekmonjur@gmail.com', '$2y$10$5Rj.wQ/2tru2156VhOh3rOaPTK5QoEWlMXZykDmImHK3jRiUGymBe', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_category`
--

CREATE TABLE IF NOT EXISTS `tbl_category` (
  `category_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_name` varchar(100) NOT NULL,
  `type` int(5) NOT NULL,
  `c_image` varchar(20) NOT NULL,
  PRIMARY KEY (`category_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_category`
--

INSERT INTO `tbl_category` (`category_id`, `category_name`, `type`, `c_image`) VALUES
(1, 'Pizza', 0, '1416061232.jpg'),
(2, 'Burger', 0, '1416061258.jpg'),
(3, 'Beef', 2, '1416061283.JPG'),
(4, 'Chicken', 2, '1416061315.jpg'),
(5, 'Chicken', 1, '1416061355.jpg'),
(6, 'Kebabs', 0, '1416061373.jpg'),
(7, 'Beef', 6, '1416061450.jpg'),
(8, 'Vegetable Pizza', 1, '1416062712.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cms`
--

CREATE TABLE IF NOT EXISTS `tbl_cms` (
  `content_id` int(11) NOT NULL AUTO_INCREMENT,
  `content_title` text NOT NULL,
  `content_description` text NOT NULL,
  PRIMARY KEY (`content_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_cms`
--

INSERT INTO `tbl_cms` (`content_id`, `content_title`, `content_description`) VALUES
(1, 'contact Us', '<p><strong>When using any tool in the "real world", you feel more confidence if you understand how that tool works. Application development is no different. When you understand how your development tools function, you feel more comfortable and confident using them. The goal of this document is to give you a good, high-level overview of how the Laravel framework "works". By getting to know the overall framework better, everything feels less "magical" and you will be more confident</strong></p>'),
(2, 'about', '<p>When using any tool in the "real world", you feel more confidence if you understand how that tool works. Application development is no different. When you understand how your development tools function, you feel more comfortable and confident using them. The goal of this document is to give you a good, high-level overview of how the Laravel framework "works". By getting to know the overall framework better, everything feels less "magical" and you will be more confident</p>\r\n<p><img src="/images/BURGER.JPG" alt="" /></p>\r\n<p>building your applications. In addition to a high-level overview of the request lifecycle, we''ll cover "start" files and application events. If you don''t understand all of the terms right away, don''t lose heart! Just try to get a basic grasp of what is going on, and your knowledge will grow as you explore other sections of the documentation.</p>'),
(3, 'footer', '<table style="height: 128px;" width="100%">\r\n<tbody>\r\n<tr>\r\n<td>\r\n<p style="text-align: center;"><span style="color: #bf1717;"><strong>Footer Content Left</strong></span></p>\r\n<p style="text-align: center;"><strong>content one</strong></p>\r\n<p style="text-align: center;"><strong>content two</strong></p>\r\n<p style="text-align: center;"><strong>content three</strong></p>\r\n</td>\r\n<td>\r\n<p style="text-align: center;"><span style="color: #bf1717;"><strong>Footer Content Center</strong></span></p>\r\n<p style="text-align: center;"><strong>content one</strong></p>\r\n<p style="text-align: center;"><strong>content two</strong></p>\r\n<p style="text-align: center;"><strong>content three</strong></p>\r\n</td>\r\n<td>\r\n<p style="text-align: center;"><strong><span style="color: #bf1717;">Footer Content Center</span><br /></strong></p>\r\n<p style="text-align: center;"><strong>content one</strong></p>\r\n<p style="text-align: center;"><strong>content two</strong></p>\r\n<p style="text-align: center;"><strong>content three</strong></p>\r\n</td>\r\n<td>\r\n<p style="text-align: center;"><strong><span style="color: #bf1717;">Footer Content Right</span><br /></strong></p>\r\n<p style="text-align: center;"><strong>content one</strong></p>\r\n<p style="text-align: center;"><strong>content two</strong></p>\r\n<p style="text-align: center;"><strong>content three</strong></p>\r\n</td>\r\n</tr>\r\n</tbody>\r\n</table>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_contact`
--

CREATE TABLE IF NOT EXISTS `tbl_contact` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` int(5) NOT NULL,
  `message` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `tbl_contact`
--

INSERT INTO `tbl_contact` (`id`, `user_id`, `name`, `email`, `mobile`, `message`) VALUES
(22, 14, 'tarek', 'tarekmonjur@gmail.com', 453535, 'fg sgsfd gfdsg fdsg fdsg fdsg fds gs'),
(23, 15, 'tarek', 'tarek_21ahammed@yahoo.com', 1832308565, 'Sir \r\nHow are you , i hope well.......................\r\nsldfj alf lakfj afkdasf klsdjfkl af........dsaf dsa fdsa '),
(25, 15, 'tarek ahammed', 'tarek_21ahammed@yahoo.com', 1832308565, 'Sir \r\nHow are you , i hope well....................... sldfj alf lakfj afkdasf klsdjfkl af........dsaf dsa fdsa fda fas fsaf a\r\nfa sfdsaf a\r\nf asfda sdf a\r\nad sfdasf sa fas fsadf asfsadf sadf safdsa \r\n sfasdf asdf asdf dsaf a');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_cuisine`
--

CREATE TABLE IF NOT EXISTS `tbl_cuisine` (
  `cuisineID` int(11) NOT NULL AUTO_INCREMENT,
  `cuisine_name` varchar(100) NOT NULL,
  PRIMARY KEY (`cuisineID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `tbl_cuisine`
--

INSERT INTO `tbl_cuisine` (`cuisineID`, `cuisine_name`) VALUES
(1, 'Bangladeshi'),
(2, 'Indian'),
(4, 'Thai'),
(5, 'Pakistani'),
(6, 'African'),
(7, 'English'),
(8, 'Italian');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_location`
--

CREATE TABLE IF NOT EXISTS `tbl_location` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(100) NOT NULL,
  `postal_code` varchar(20) NOT NULL,
  `location_details` text NOT NULL,
  PRIMARY KEY (`location_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_location`
--

INSERT INTO `tbl_location` (`location_id`, `location_name`, `postal_code`, `location_details`) VALUES
(1, 'Tejgaon ', '1215', ''),
(2, 'Banani', '1213', 'fdsg fdsg sfdg fdsg sdfg dsfg sfd g'),
(3, 'Gulshan Model Town ', '1212', ''),
(4, 'Mirpur Bazar ', '1218', ''),
(9, 'Rampura', '1215', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order`
--

CREATE TABLE IF NOT EXISTS `tbl_order` (
  `orderID` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `restaurant_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `city` varchar(200) NOT NULL,
  `area` varchar(200) NOT NULL,
  `address` varchar(255) NOT NULL,
  `total_price` float NOT NULL,
  `total_qty` int(11) NOT NULL,
  `active` int(1) NOT NULL,
  PRIMARY KEY (`orderID`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_order`
--

INSERT INTO `tbl_order` (`orderID`, `userID`, `restaurant_id`, `name`, `mobile`, `email`, `city`, `area`, `address`, `total_price`, `total_qty`, `active`) VALUES
(4, 15, 19, 'fadsfa', '453535', 'tarek_21ahammed@yahoo.com', 'Dhaka', 'rampura', 'rssoftware', 52, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_order_product`
--

CREATE TABLE IF NOT EXISTS `tbl_order_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `product_name` varchar(100) NOT NULL,
  `product_price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL,
  `topping_id` varchar(100) NOT NULL,
  `p_image` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `tbl_order_product`
--

INSERT INTO `tbl_order_product` (`id`, `orderID`, `product_id`, `product_name`, `product_price`, `qty`, `topping_id`, `p_image`) VALUES
(4, 4, 12, 'fdsgsdgs', '52.00', 1, '2', '1418467699.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_product`
--

CREATE TABLE IF NOT EXISTS `tbl_product` (
  `product_id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `owner_id` int(5) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `p_image` varchar(200) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `tbl_product`
--

INSERT INTO `tbl_product` (`product_id`, `category_id`, `owner_id`, `name`, `price`, `p_image`) VALUES
(1, 5, 8, 'BBQ Chicken Pizza', '150.03', '1416061684.jpg'),
(2, 5, 9, 'Buck Chicken Pizza', '130.00', '1416061730.jpg'),
(3, 5, 10, ' Chicken Pizza', '180.00', '1416061773.jpg'),
(4, 4, 11, 'Breakfast class chicken burger', '90.00', '1416061919.png'),
(5, 4, 0, 'GDL Spicy Chicken Burger', '110.00', '1416061973.jpg'),
(6, 2, 12, 'Burger king', '120.00', '1416062280.jpg'),
(7, 3, 13, 'Beef bargar', '90.00', '1416062463.jpg'),
(8, 3, 8, 'Halaa Beef Burger', '115.00', '1416062521.gif'),
(9, 8, 9, 'Veggie pizza', '60.00', '1416062793.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_restaurant`
--

CREATE TABLE IF NOT EXISTS `tbl_restaurant` (
  `restaurant_id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(5) NOT NULL,
  `restaurant_name` varchar(100) NOT NULL,
  `location_id` int(11) NOT NULL,
  `rating` int(5) NOT NULL,
  `offer` text NOT NULL,
  `sponsor` varchar(10) NOT NULL,
  `address` text NOT NULL,
  `r_image` varchar(50) NOT NULL,
  `activation` int(1) NOT NULL,
  PRIMARY KEY (`restaurant_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `tbl_restaurant`
--

INSERT INTO `tbl_restaurant` (`restaurant_id`, `owner_id`, `restaurant_name`, `location_id`, `rating`, `offer`, `sponsor`, `address`, `r_image`, `activation`) VALUES
(20, 9, 'Restaurant One', 1, 4, '20% off today on orders over £15', '', 'Teskuni pada, Road no 3 , Tajgaon ,Dhaka', '1418377790.jpg', 1),
(21, 10, 'Restaurant Two', 1, 2, '', 'no', 'Teskuni pada, Road no 1, Tajgaon ,Dhaka', '1418378278.jpg', 1),
(22, 11, 'Restaurant Three', 2, 5, '', 'yes', 'Block no A, Road no 2, Banani, Dhaka', '1418379132.jpg', 1),
(23, 12, 'Restaurant fore', 3, 6, '', 'yes', 'Block B, Road no 3, Gulshan ', '1418383836.jpg', 1),
(24, 13, 'Restaurant five', 4, 4, '', 'yes', 'Block C, Road no 4, Mirpur, Dhaka', '1418385366.jpg', 1),
(19, 8, 'test restaurnt ', 2, 4, '50% off today on orders over £30', '', 'f afdaf fa sdf dsfds fsf s', '1418384929.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_res_category`
--

CREATE TABLE IF NOT EXISTS `tbl_res_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `tbl_res_category`
--

INSERT INTO `tbl_res_category` (`id`, `restaurant_id`, `category_id`) VALUES
(32, 24, 1),
(29, 23, 1),
(28, 22, 6),
(27, 22, 2),
(26, 22, 1),
(25, 21, 6),
(24, 20, 2),
(23, 20, 1),
(31, 23, 6),
(30, 23, 2),
(33, 24, 2),
(34, 19, 2),
(35, 19, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_res_cuisine`
--

CREATE TABLE IF NOT EXISTS `tbl_res_cuisine` (
  `c_id` int(11) NOT NULL AUTO_INCREMENT,
  `restaurant_id` int(11) NOT NULL,
  `cuisineID` int(11) NOT NULL,
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `tbl_res_cuisine`
--

INSERT INTO `tbl_res_cuisine` (`c_id`, `restaurant_id`, `cuisineID`) VALUES
(30, 24, 5),
(29, 24, 1),
(28, 23, 7),
(27, 23, 6),
(26, 23, 4),
(25, 22, 8),
(24, 22, 6),
(23, 22, 1),
(22, 21, 7),
(21, 21, 6),
(20, 21, 4),
(19, 20, 5),
(18, 20, 1),
(16, 19, 2),
(17, 19, 4);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_toppings`
--

CREATE TABLE IF NOT EXISTS `tbl_toppings` (
  `topping_id` int(11) NOT NULL AUTO_INCREMENT,
  `topping_name` varchar(100) NOT NULL,
  `topping_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`topping_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `tbl_toppings`
--

INSERT INTO `tbl_toppings` (`topping_id`, `topping_name`, `topping_price`) VALUES
(1, 'Sweet Corn', '25.00'),
(2, 'Cheese', '40.00'),
(3, 'Red Capsicum', '25.00'),
(4, 'Olives', '15.00'),
(5, 'Tomato', '25.00');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `ID` int(5) NOT NULL AUTO_INCREMENT,
  `remember_token` varchar(500) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_mobile` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_address` text NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`ID`, `remember_token`, `firstname`, `lastname`, `username`, `email`, `user_mobile`, `password`, `user_address`, `image`) VALUES
(14, 'cuu8e16TUsc3fyOn6rlYYoCkx4rFiHpafMwSCUInsAqIELI3DvELQngeXNOr', 'taek', 'monjur', 'tarek', 'tarekmonjur@gmail.com', '01832308565', '$2y$10$f7zn6iAHYHXoUogwVYSkDepP98ic1j.cN.2d8DHlu8nB5jqXMz1FG', 'fdssa fdsaf dsaf sadf asfd a', 'images\\FaapVG.jpg'),
(15, 'Q5E2czAsCqr5Zozuc9I7weX2YOBHIiHcfd4IKgP9eyk8gLNs9AHigofjd880', 'monujr', 'alam', 'monjur', 'tarek_21ahammed@yahoo.com', '', '$2y$10$g10tnRZpb59KJu60kdCkTuiJFOzl1BynvIMzOJz4qWU81NPKG/jdi', '', '1417672733.jpg'),
(16, '', 'mmm', 'mm', 'mmmmm', 'mmmm@yahoo.com', '', '$2y$10$nb.pqBdznzfhMPlY4pW7weo/amkhitR5SbpRkOOI3I20l80m.1E3q', '', 'images\\iiKsHq.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
