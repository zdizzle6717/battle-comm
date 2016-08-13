-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 29, 2015 at 03:12 AM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hyberion_battlecomm_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `bc_news`
--

CREATE TABLE IF NOT EXISTS `bc_news` (
  `news_id` int(10) unsigned NOT NULL,
  `news_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured_image` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `news_callout` text COLLATE utf8_unicode_ci NOT NULL,
  `news_body` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `news_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_date_submitted` date NOT NULL,
  `publish` set('yes','no','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `news_date_published` date DEFAULT NULL,
  `news_featured` set('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `tags` text COLLATE utf8_unicode_ci,
  `parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_system` text COLLATE utf8_unicode_ci,
  `news_submitted_IP_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `bc_news`
--

INSERT INTO `bc_news` (`news_id`, `news_title`, `featured_image`, `news_callout`, `news_body`, `news_author`, `news_date_submitted`, `publish`, `news_date_published`, `news_featured`, `tags`, `parent`, `game_system`, `news_submitted_IP_number`) VALUES
(33, 'Welcome to Battle-Comm', 'Uploads/news/battlecomm.png', '', 'Welcome to Battle-Comm, the home to find all levels of friendly, local, table-top gaming. With a long running list of supported table-top gaming systems, Battle-comm is a community of individuals making connections through competition. Battle-Comm is almost ready to open it''s doors and bring you into a world of excitement, interaction, and swag! Battle-Comm is ready to bring you the future of table top events, online play matching, community interaction, and. . of course...swag! So read on to find out more about this exciting new service, how Battle-Comm can benefit you as a player, as a shop owner, or as an event organizer. Together we will make Battle-Comm the primary destination for all table-top gamers, because at Battle-Comm even when you lose. . you Win!', '', '2015-01-15', 'yes', NULL, 'no', '', 'Updates', 'Chess', ''),
(32, 'Product Review', 'Uploads/news/magic.jpg', '', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Bryce', '2015-05-26', '', NULL, 'no', '', '', 'Magic The Gathering', ''),
(31, 'Announcement', 'Uploads/news/warhammer_02.jpg', '', 'Cras sit amet tristique ex, ac commodo lacus. Praesent metus orci, dapibus at venenatis a, commodo eget tortor. Vivamus aliquam nisl turpis, at lacinia ligula dapibus et. Integer malesuada ultricies mi eget malesuada. Phasellus eget ultrices erat. Etiam interdum quis augue ac volutpat. Praesent sit amet mi massa. Ut nulla augue, ultricies sed sagittis id, laoreet nec odio.', 'Brad', '2015-05-26', 'yes', NULL, 'no', '', '', 'Warhammer', ''),
(30, 'New Product', 'Uploads/news/warhammer_01.jpg', '', 'In sit amet eros elementum, commodo urna vitae, convallis massa. Pellentesque dolor eros, commodo quis libero faucibus, tristique iaculis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin volutpat ex ligula. Nulla semper nisl ligula, vitae pellentesque leo rhoncus et. Nunc eu nunc dui. Cras condimentum pretium massa, et iaculis ex accumsan viverra. Nam euismod hendrerit interdum. Etiam vulputate pharetra nunc a tristique. Curabitur sollicitudin quam ut justo euismod viverra. Suspendisse eget ante nisl.', 'Gordon', '2015-05-26', 'no', NULL, 'no', '', '', 'Warhammer', ''),
(29, 'Upcoming Event', 'Uploads/news/chess.jpg', '', 'In sit amet eros elementum, commodo urna vitae, convallis massa. Pellentesque dolor eros, commodo quis libero faucibus, tristique iaculis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin volutpat ex ligula. Nulla semper nisl ligula, vitae pellentesque leo rhoncus et. Nunc eu nunc dui. Cras condimentum pretium massa, et iaculis ex accumsan viverra. Nam euismod hendrerit interdum. Etiam vulputate pharetra nunc a tristique. Curabitur sollicitudin quam ut justo euismod viverra. Suspendisse eget ante nisl.', '', '2015-05-26', '', NULL, 'no', '', 'Events', 'Chess', ''),
(28, 'Calling All Gamers', 'Uploads/news/battlecomm.png', '', 'In sit amet eros elementum, commodo urna vitae, convallis massa. Pellentesque dolor eros, commodo quis libero faucibus, tristique iaculis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin volutpat ex ligula. Nulla semper nisl ligula, vitae pellentesque leo rhoncus et. Nunc eu nunc dui. Cras condimentum pretium massa, et iaculis ex accumsan viverra. Nam euismod hendrerit interdum. Etiam vulputate pharetra nunc a tristique. Curabitur sollicitudin quam ut justo euismod viverra. Suspendisse eget ante nisl.', '', '2015-03-26', '', NULL, 'no', '', '', '', ''),
(27, 'Tournament Info', 'Uploads/news/magic3.jpg', '', 'In sit amet eros elementum, commodo urna vitae, convallis massa. Pellentesque dolor eros, commodo quis libero faucibus, tristique iaculis ex. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Proin volutpat ex ligula. Nulla semper nisl ligula, vitae pellentesque leo rhoncus et. Nunc eu nunc dui. Cras condimentum pretium massa, et iaculis ex accumsan viverra. Nam euismod hendrerit interdum. Etiam vulputate pharetra nunc a tristique. Curabitur sollicitudin quam ut justo euismod viverra. Suspendisse eget ante nisl.', 'Joe', '2015-06-11', '', NULL, 'no', '', '', 'Magic The Gathering', ''),
(34, 'New Test', 'Uploads/news/chess.jpg', '', 'Quisque id magna tristique, tempor sem a, efficitur velit. Cras magna odio, hendrerit ut nulla eget, ultricies cursus odio. Aenean eu vestibulum sem. Integer quis tortor vestibulum, sagittis lacus eu, blandit odio. Duis imperdiet convallis mi. Nulla facilisi. Quisque blandit pretium venenatis. Maecenas vel porttitor risus, sit amet suscipit neque.', 'Zack', '2015-06-28', '', NULL, 'no', 'New,', 'test1', 'Magic The Gathering', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bc_news`
--
ALTER TABLE `bc_news`
  ADD PRIMARY KEY (`news_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bc_news`
--
ALTER TABLE `bc_news`
  MODIFY `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=48;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
