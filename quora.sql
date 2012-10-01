-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 23, 2012 at 07:33 PM
-- Server version: 5.5.24
-- PHP Version: 5.3.10-1ubuntu3.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `quora`
--

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `answer` text,
  `qid` int(11) NOT NULL,
  `giver_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`aid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `ans_cmnt`
--

CREATE TABLE IF NOT EXISTS `ans_cmnt` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cmnt` text,
  `aid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `follow`
--

CREATE TABLE IF NOT EXISTS `follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `follower` int(11) NOT NULL,
  `followed` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `follow`
--

INSERT INTO `follow` (`id`, `follower`, `followed`) VALUES
(1, 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `questions_followed`
--

CREATE TABLE IF NOT EXISTS `questions_followed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `questions_followed`
--

INSERT INTO `questions_followed` (`id`, `user_id`, `qid`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(9, 1, 5),
(10, 1, 6),
(11, 1, 8),
(12, 1, 10),
(13, 1, 13),
(14, 8, 13),
(15, 9, 13),
(16, 9, 10),
(17, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `question_stats`
--

CREATE TABLE IF NOT EXISTS `question_stats` (
  `qid` int(11) NOT NULL AUTO_INCREMENT,
  `question` text,
  `asker_id` int(11) NOT NULL,
  `votes` int(11) NOT NULL DEFAULT '0',
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `answers` int(11) NOT NULL DEFAULT '0',
  `views` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`qid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `question_stats`
--

INSERT INTO `question_stats` (`qid`, `question`, `asker_id`, `votes`, `time`, `answers`, `views`) VALUES
(1, 'Hello, how is the new site going?', 1, 1, '0000-00-00 00:00:00', 0, 0),
(2, 'I think this site is gonna rock!', 4, 2, '0000-00-00 00:00:00', 0, 0),
(3, 'How are you?', 1, 0, '0000-00-00 00:00:00', 0, 0),
(4, 'HOW?', 1, 0, '0000-00-00 00:00:00', 0, 0),
(5, 'Hey man, ''sup?', 1, 0, '0000-00-00 00:00:00', 0, 0),
(6, 'TONMOY', 1, 0, '0000-00-00 00:00:00', 0, 0),
(7, 'Which laptop should I buy?', 1, 0, '0000-00-00 00:00:00', 0, 0),
(8, 'Where can I learn to use this site?', 1, 6, '2012-08-22 03:54:03', 0, 0),
(9, 'SO, what''s new in this idea?', 4, 0, '0000-00-00 00:00:00', 0, 0),
(10, 'What''s different from quora?', 4, 2, '2012-08-22 03:54:14', 0, 0),
(11, 'PLEASE, CAN YOU UPDATE TIME?', 4, 0, '2012-08-21 21:45:53', 0, 0),
(12, 'What''s up with it? Why is it not running?', 1, 0, '2012-08-22 03:59:22', 0, 0),
(13, 'Now that the euphoria over Responsive Web Design is settling down, the opinion that it fails to deliver a quality mobile experience (ie it''s just a narrow desktop layout that does not take full advantage of how mobile works and what makes mobile unique) is taking hold. If 2011 was the year of Responsive Web Design, how will we address these valid criticisms in 2012?\r\n\r\nSome parts of the Responsive Web Design methodology are solid:\r\none link (ie no m.blah.com)\r\none codebase for updating\r\ncontrol over font size so content stays readable\r\n\r\nBut some things are serious issues:\r\nlarge image downloads on mobile (current solutions are hacks)\r\ndifficult to do a true design for mobile; it''s more like a rearrangement\r\ndisplay: hidden\r\n\r\nhttp://du.tumblr.com/post/147094...\r\n\r\nI think Responsive Web Design is a misnomer. It is only responsive insofar as the screen size of a device, which is, in my opinion, the least interesting characteristic of any device.', 1, 0, '2012-08-22 08:16:57', 0, 0),
(14, 'bhag ja makhi!', 9, 0, '2012-08-22 11:51:18', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `ques_cmnt`
--

CREATE TABLE IF NOT EXISTS `ques_cmnt` (
  `cid` int(11) NOT NULL AUTO_INCREMENT,
  `cmnt` text,
  `qid` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`cid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `tid` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(32) DEFAULT NULL,
  `count` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tid`, `tag`, `count`) VALUES
(1, 'Site', 11),
(2, 'new', 2),
(3, 'Laptop', 1),
(4, 'Mobile Web', 1),
(5, 'Media Queries', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tag_questions`
--

CREATE TABLE IF NOT EXISTS `tag_questions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tid` int(11) NOT NULL,
  `qid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `tag_questions`
--

INSERT INTO `tag_questions` (`id`, `tid`, `qid`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(40) NOT NULL,
  `description` text,
  `gender` char(1) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `phone_no` int(10) DEFAULT NULL,
  `city` varchar(32) DEFAULT NULL,
  `state` varchar(2) DEFAULT NULL,
  `picture` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE IF NOT EXISTS `user_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(32) DEFAULT NULL,
  `password` varchar(40) DEFAULT NULL,
  `security_question` text,
  `security_answer` text,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `user_info`
--

INSERT INTO `user_info` (`user_id`, `username`, `password`, `security_question`, `security_answer`, `time`) VALUES
(1, 'Piyush', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '0000-00-00 00:00:00'),
(4, 'sajith', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '0000-00-00 00:00:00'),
(5, 'rahul', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '0000-00-00 00:00:00'),
(6, 'makhi', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '0000-00-00 00:00:00'),
(7, 'hello', 'f0dd5b589a88296609c20abafc625e9b9789654c', NULL, NULL, '0000-00-00 00:00:00'),
(8, 'makhi1', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '2012-08-22 11:47:36'),
(9, 'john', 'a9993e364706816aba3e25717850c26c9cd0d89d', NULL, NULL, '2012-08-22 11:49:08');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
