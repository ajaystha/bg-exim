-- phpMyAdmin SQL Dump
-- version 2.9.0.1
-- http://www.phpmyadmin.net
-- 
-- Host: localhost
-- Generation Time: Nov 24, 2008 at 08:44 AM
-- Server version: 5.0.24
-- PHP Version: 5.1.6
-- 
-- Database: `bg`
-- 

-- --------------------------------------------------------

-- 
-- Table structure for table `categories`
-- 

DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_image` varchar(64) collate latin1_general_ci default NULL,
  `parent_id` int(11) NOT NULL default '0',
  `sort_order` int(3) default NULL,
  `date_added` datetime default NULL,
  `last_modified` datetime default NULL,
  PRIMARY KEY  (`categories_id`),
  KEY `idx_categories_parent_id` (`parent_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `categories`
-- 

INSERT INTO `categories` VALUES (1, NULL, 0, NULL, '2007-08-03 09:23:38', NULL);
INSERT INTO `categories` VALUES (2, NULL, 0, NULL, '2007-08-03 09:23:51', NULL);
INSERT INTO `categories` VALUES (3, NULL, 3, NULL, '2007-08-03 09:23:58', '2008-11-24 14:08:07');
INSERT INTO `categories` VALUES (4, NULL, 0, NULL, '2007-08-03 09:24:05', NULL);
INSERT INTO `categories` VALUES (5, NULL, 0, NULL, '2007-08-03 09:24:27', NULL);
INSERT INTO `categories` VALUES (50, NULL, 2, NULL, '2007-08-03 09:29:26', NULL);
INSERT INTO `categories` VALUES (51, NULL, 2, NULL, '2007-08-03 09:30:48', NULL);
INSERT INTO `categories` VALUES (52, NULL, 2, NULL, '2007-08-03 09:31:15', NULL);
INSERT INTO `categories` VALUES (53, NULL, 2, NULL, '2007-08-03 09:31:15', NULL);
INSERT INTO `categories` VALUES (54, NULL, 2, NULL, '2007-08-03 09:31:15', NULL);
INSERT INTO `categories` VALUES (55, NULL, 2, NULL, '2007-08-03 09:31:15', NULL);
INSERT INTO `categories` VALUES (56, NULL, 2, NULL, '2007-08-03 09:31:15', NULL);

-- --------------------------------------------------------

-- 
-- Table structure for table `categories_description`
-- 

DROP TABLE IF EXISTS `categories_description`;
CREATE TABLE `categories_description` (
  `categories_id` int(11) NOT NULL default '0',
  `categories_name` varchar(32) collate latin1_general_ci NOT NULL default '',
  `categories_description` varchar(500) collate latin1_general_ci default NULL,
  `categories_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`categories_id`),
  KEY `idx_categories_name` (`categories_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `categories_description`
-- 

INSERT INTO `categories_description` VALUES (1, 'Handicrafts', NULL, 1);
INSERT INTO `categories_description` VALUES (2, 'Jewelleries', NULL, 1);
INSERT INTO `categories_description` VALUES (3, 'Carpets', '', 1);
INSERT INTO `categories_description` VALUES (4, 'Cashmiri Pashmina', NULL, 1);
INSERT INTO `categories_description` VALUES (51, 'Rings', NULL, 1);
INSERT INTO `categories_description` VALUES (52, 'Pendents', NULL, 1);
INSERT INTO `categories_description` VALUES (54, 'Others', NULL, 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `company_news`
-- 

DROP TABLE IF EXISTS `company_news`;
CREATE TABLE `company_news` (
  `news_id` int(11) NOT NULL auto_increment,
  `news_head` varchar(100) collate latin1_general_ci NOT NULL,
  `news_slug` varchar(200) collate latin1_general_ci NOT NULL,
  `company_news` varchar(2000) collate latin1_general_ci NOT NULL,
  `published_date` datetime NOT NULL,
  `news_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`news_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=4 ;

-- 
-- Dumping data for table `company_news`
-- 

INSERT INTO `company_news` VALUES (1, 'Getting started with Internet Explorer', 'With an Internet connection and Internet Explorer, you can find and view information about anything on the Web. Just click the topics below to get started. You''ll find more information to help you bro', 'With an Internet connection and Internet Explorer, you can find and view information about anything on the Web. Just click the topics below to get started. You''ll find more information to help you browse the Internet in the Help Contents.With an Internet connection and Internet Explorer, you can find and view information about anything on the Web. Just click the topics below to get started. You''ll find more information to help you browse the Internet in the Help Contents.', '2007-09-06 23:22:30', 1);
INSERT INTO `company_news` VALUES (2, 'Using Content Advisor to control access', 'The Internet provides unprecedented access to a wide variety of information. Some information, however, may not be suitable for every viewer. For example, you might want to prevent your children from ', 'The Internet provides unprecedented access to a wide variety of information. Some information, however, may not be suitable for every viewer. For example, you might want to prevent your children from seeing Web sites that contain violent or sexual content. Content Advisor provides a way to help you control the types of content that your computer can gain access to on the Internet. After you turn on Content Advisor, only rated content that meets or exceeds your criteria can be viewed. You can adjust the settings.', '2007-09-06 23:22:30', 1);
INSERT INTO `company_news` VALUES (3, 'Welcome to Mozilla Firefox Help', 'To display information about Mozilla Firefox in this window, click topics in', 'To display information about Mozilla Firefox in this window, click topics in', '2007-09-10 21:56:04', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `contact_details`
-- 

DROP TABLE IF EXISTS `contact_details`;
CREATE TABLE `contact_details` (
  `contact_details` text collate latin1_general_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci;

-- 
-- Dumping data for table `contact_details`
-- 

INSERT INTO `contact_details` VALUES ('hello world\r\ni am doing good here');

-- --------------------------------------------------------

-- 
-- Table structure for table `feedback`
-- 

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE `feedback` (
  `FeedbackID` int(11) unsigned NOT NULL auto_increment,
  `Feedback` varchar(1000) collate latin1_general_ci NOT NULL,
  `DateTime` date NOT NULL,
  `SenderName` varchar(50) collate latin1_general_ci NOT NULL,
  `SenderAddress` varchar(100) collate latin1_general_ci NOT NULL,
  `SenderEmail` varchar(50) collate latin1_general_ci default NULL,
  `SenderTelephone` varchar(20) collate latin1_general_ci default NULL,
  `feedback_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`FeedbackID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=27 ;

-- 
-- Dumping data for table `feedback`
-- 

INSERT INTO `feedback` VALUES (2, 'Good Job', '2007-08-01', 'Kritartha Shakya', 'Patan, Sundhara', 'kritartha.s@gmail.com', '9841613262', 1);
INSERT INTO `feedback` VALUES (3, 'nepal fm 91.8 naya nepal ko samabesi radio', '2007-08-01', 'Nava Raj Bogatee', 'Dhalko, chhatrapati', 'nava.bogatee@gmail.com', '9841635487', 1);
INSERT INTO `feedback` VALUES (4, 'You can also use the Search bar to find specific You can also use the Search bar to find specificYou can also use the Search bar to find specific You can also use the Search bar to find specific You can also use the Search bar to find specific You can also use the Search bar to find specific', '2007-08-01', 'Nava Raj Bogatee', 'Dhalko, chhatrapati', 'nava.bogatee@gmail.com', '9841635487', 1);
INSERT INTO `feedback` VALUES (5, 'asdfasdf', '2007-08-01', 'asdfasf', 'asdf', 'asdf', 'asdf', 1);
INSERT INTO `feedback` VALUES (6, 'hello world', '2007-08-01', 'juna bogatee', 'kathmandu', 'juna.b@hotmail.com', '9841635486', 1);
INSERT INTO `feedback` VALUES (7, 'hello world', '2007-08-01', 'juna bogatee', 'kathmandu', 'juna.b@hotmail.com', '9841635486', 1);
INSERT INTO `feedback` VALUES (8, 'hello world', '2007-08-01', 'juna bogatee', 'kathmandu', 'juna.b@hotmail.com', '9841635486', 1);
INSERT INTO `feedback` VALUES (9, 'hello world', '2007-08-01', 'juna bogatee', 'kathmandu', 'juna.b@hotmail.com', '9841635486', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `members`
-- 

DROP TABLE IF EXISTS `members`;
CREATE TABLE `members` (
  `member_id` int(11) NOT NULL auto_increment,
  `username` char(14) NOT NULL,
  `password` char(32) NOT NULL,
  `date_created` date NOT NULL,
  `date_modified` date NOT NULL,
  `member_status` tinyint(1) NOT NULL default '1',
  PRIMARY KEY  (`member_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- 
-- Dumping data for table `members`
-- 

INSERT INTO `members` VALUES (4, 'admin', 'Yy8', '2008-11-24', '0000-00-00', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `products`
-- 

DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `products_id` int(11) NOT NULL auto_increment,
  `products_quantity` int(4) NOT NULL default '0',
  `products_category` varchar(12) collate latin1_general_ci default NULL,
  `products_image` varchar(64) collate latin1_general_ci default NULL,
  `products_thumb` varchar(50) collate latin1_general_ci default NULL,
  `products_price` decimal(15,4) NOT NULL default '0.0000',
  `products_date_added` datetime NOT NULL default '0000-00-00 00:00:00',
  `show_front` tinyint(1) NOT NULL default '0',
  `products_weight` decimal(5,2) NOT NULL default '0.00',
  `products_keyword` varchar(100) collate latin1_general_ci default NULL,
  `products_status` tinyint(1) NOT NULL default '0',
  PRIMARY KEY  (`products_id`),
  KEY `idx_products_date_added` (`products_date_added`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=94 ;

-- 
-- Dumping data for table `products`
-- 

INSERT INTO `products` VALUES (69, 10, '52', '69_jennifer_aniston_004.jpg', '69_th_jennifer_aniston_004.jpg', 205.0000, '2007-09-10 22:32:32', 1, 25.00, 'Khukuri', 1);
INSERT INTO `products` VALUES (70, 500, '52', '70_0083.jpg', '70_th_0083.jpg', 0.0000, '2007-09-08 13:16:19', 0, 25.30, 'Nepalese Carpets', 1);
INSERT INTO `products` VALUES (72, 0, '52', '72_248498~Anna-Kournikova-Posters.jpg', '72_th_248498~Anna-Kournikova-Posters.jpg', 251.0000, '2007-09-10 22:25:28', 1, 25.00, 'Del Monte', 1);

-- --------------------------------------------------------

-- 
-- Table structure for table `products_description`
-- 

DROP TABLE IF EXISTS `products_description`;
CREATE TABLE `products_description` (
  `products_id` int(11) NOT NULL auto_increment,
  `products_name` varchar(64) collate latin1_general_ci NOT NULL default '',
  `products_description` text collate latin1_general_ci,
  `products_url` varchar(255) collate latin1_general_ci default NULL,
  `products_viewed` int(5) default '0',
  PRIMARY KEY  (`products_id`),
  KEY `products_name` (`products_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COLLATE=latin1_general_ci AUTO_INCREMENT=94 ;

-- 
-- Dumping data for table `products_description`
-- 

INSERT INTO `products_description` VALUES (69, 'hello Hello Hello Khukuri', 'More and more web developers are ditching tables and coming round to the idea of using CSS to control the layout of their site. With the many benefits of using CSS, such as quicker download time, improved accessibility and easier site management, why not?', NULL, 3);
INSERT INTO `products_description` VALUES (70, 'Nepalese Carpets', 'The way browser detection using CSS hacks works is to send one CSS rule to the browser(s) you''re trying to trick, and then send a second CSS rule to the other browsers, overriding this first command. If you have two CSS rules with identical selectors then the second CSS rule will always take precedence.\r\n\r\nSay for example you wanted the space between your header area and the content to have a gap of 25px in Internet Explorer, or IE as it''s affectionately known. This gap looks good in IE but in Firefox, Opera and Safari the gap is huge and a 10px gap looks far better. To achieve this perfect look in all these browsers you would need the following two CSS rules:\r\n\r\n#header {margin-bottom: 25px;}\r\n#header {margin-bottom: 10px;} \r\n\r\nThe first command is intended for IE, the second for all other browsers. How does this work? Well, it won''t at the moment because all browsers can understand both CSS rules so will use the second CSS rule because it comes after the first one.\r\n\r\nBy inserting a CSS hack we can perform our browser detection by hiding the second CSS rule from IE. This means that IE won''t even know it exists and will therefore use the first CSS rule. How do we do this? Read on and find out!\r\n', NULL, 5);
INSERT INTO `products_description` VALUES (72, 'Del Monte', 'BG ExIm Traders Pvt. Ltd. this concept has been created with the ambitions of a renounced Entrepreneur in this trade export Import; there are lots of Handicraft Manufacturers in Nepal hence every manufacturer are seeking of market promotion. After long survey BG decided to promote their product\r\n<br />\r\nBG ExIm Traders Pvt. Ltd. this concept has been created with the ambitions of a renounced Entrepreneur in this trade export Import; there are lots of Handicraft Manufacturers in Nepal hence every manufacturer are seeking of market promotion. After long survey BG decided to promote their product', NULL, 0);
