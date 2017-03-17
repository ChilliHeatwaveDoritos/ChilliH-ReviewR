-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


--
-- Database: `group15`
--

CREATE DATABASE IF NOT EXISTS `group15` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `group15`;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `fname` varchar(32) NOT NULL,
  `sname` varchar(32) NOT NULL,
  `sid` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `major` varchar(32) NOT NULL,
  `score` bigint(25) UNSIGNED NOT NULL DEFAULT '0',
  `jdate` datetime(6) NOT NULL,
  `status` varchar(16) NOT NULL DEFAULT 'user',
  `password` varchar(32) NOT NULL,
PRIMARY KEY (`user_id`),
UNIQUE KEY `uk_email` (`email`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`
CREATE TABLE IF NOT EXISTS `tags` (
  `tag_id` mediumint(10) NOT NULL,
  `value` varchar(255) NOT NULL,
PRIMARY KEY (`tag_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user_tags`
--

DROP TABLE IF EXISTS `user_tags`;
CREATE TABLE IF NOT EXISTS `user_tags` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `tag1` mediumint(10) UNSIGNED NOT NULL,
  `tag2` mediumint(10) UNSIGNED NOT NULL,
  `tag3` mediumint(10) UNSIGNED NOT NULL,
  `tag4` mediumint(10) UNSIGNED NOT NULL,   
PRIMARY KEY (`user_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

DROP TABLE IF EXISTS `tasks`;
CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` bigint(14) UNSIGNED NOT NULL,
  `poster_id` mediumint(8) UNSIGNED NOT NULL,
  `title` varchar(64) NOT NULL,
  `type` varchar(32) NOT NULL,
  `desc` varchar(1000) NOT NULL,
  `pages` int(6) NOT NULL,
  `words` int(16) NOT NULL,
  `format` varchar(16) NOT NULL,
  `tag1` mediumint(10) NOT NULL,
  `tag2` mediumint(10) NOT NULL,
  `tag3` mediumint(10) NOT NULL,
  `tag4` mediumint(10) NOT NULL,
  `create_date` datetime NOT NULL,
  `due_date` datetime NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
PRIMARY KEY (`task_id`),
KEY `fk_poster` (`poster_id`),
KEY `fk_tag1` (`tag1`),
KEY `fk_tag2` (`tag2`),
KEY `fk_tag3` (`tag3`),
KEY `fk_tag4` (`tag4`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `active_session`
--

DROP TABLE IF EXISTS `active_session`;
CREATE TABLE IF NOT EXISTS `active_session` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `log_in_time` datetime NOT NULL,
PRIMARY KEY (`user_id`),
UNIQUE KEY `uk_session_id` (`session_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `banned_users`
--

DROP TABLE IF EXISTS `banned_users`;
CREATE TABLE IF NOT EXISTS `banned_users` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `reason` varchar(300) NOT NULL,
PRIMARY KEY (`user_id`),
KEY `email` (`email`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
CREATE TABLE IF NOT EXISTS `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `location` varchar(255) NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `type` tinyint(1) UNSIGNED DEFAULT NULL,
PRIMARY KEY (`id`),
KEY `fk_taskdoc_id` (`task_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `claimed_tasks`
--

DROP TABLE IF EXISTS `claimed_tasks`;
CREATE TABLE IF NOT EXISTS `claimed_tasks` (
  `id` bigint(14) UNSIGNED NOT NULL,
  `task_id` bigint(14) UNSIGNED NOT NULL,
  `poster_id` mediumint(8) UNSIGNED NOT NULL,
  `claimant_id` mediumint(8) UNSIGNED NOT NULL,
PRIMARY KEY (`id`),
KEY `fk_task_id` (`task_id`),
KEY `fk_poster_id` (`poster_id`),
KEY `fk_claimant_id` (`claimant_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `flagged_tasks`
--

DROP TABLE IF EXISTS`flagged_tasks`;
CREATE TABLE IF NOT EXISTS `flagged_tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `reporter_id` mediumint(8) UNSIGNED NOT NULL,
  `resolved` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
PRIMARY KEY (`id`),
KEY `fk_reporter_id` (`reporter_id`),
KEY `fk_taskid` (`task_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session_log`
--

DROP TABLE IF EXISTS `session_log`;
CREATE TABLE IF NOT EXISTS `session_log` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `session_id` varchar(32) NOT NULL,
  `log_in_time` datetime NOT NULL,
  `log_out_time` datetime NOT NULL,
PRIMARY KEY (`user_id`,`log_in_time`),
KEY `session_id` (`session_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session_log`
--

DROP TABLE IF EXISTS `viewed_task`;
CREATE TABLE IF NOT EXISTS `viewed_task` (
  `user_id` mediumint(8) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(32) NOT NULL,
  `tag1` varchar(32) NOT NULL,
  `tag2` varchar(32) NOT NULL,
  `tag3` varchar(32) NOT NULL,
  `tag4` varchar(32) NOT NULL,
PRIMARY KEY (`user_id`,`task_id`),
KEY `fk_task_viewed` (`task_id`)
); ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Constraints for dumped tables
--

--
-- Constraints for table `user_tags`
--

ALTER TABLE `user_tags`
	ADD CONSTRAINT `fk_user_tags` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
  
--
-- Constraints for table `tasks`
--

ALTER TABLE `tasks`
	ADD CONSTRAINT `fk_poster` FOREIGN KEY (`poster_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_tag1` FOREIGN KEY (`tag1`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_tag2` FOREIGN KEY (`tag2`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_tag3` FOREIGN KEY (`tag3`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_tag4` FOREIGN KEY (`tag4`) REFERENCES `tags` (`tag_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `active_session`
--

ALTER TABLE `active_session`
	ADD CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;

--
-- Constraints for table `banned_users`
--

ALTER TABLE `banned_users`	
	ADD CONSTRAINT `fk_u_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_u_email` FOREIGN KEY (`email`) REFERENCES `users` (`email`) ON UPDATE CASCADE;
	
--
-- Constraints for table `documents`
--

ALTER TABLE `documents`
	ADD CONSTRAINT `fk_taskdoc_id` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `claimed_tasks`
--

ALTER TABLE `claimed_tasks`
	ADD CONSTRAINT `fk_claimant_id` FOREIGN KEY (`claimant_id`) REFERENCES `users` (`user_id`) ON DELETE NO ACTION ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_poster_id` FOREIGN KEY (`poster_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_task_id` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `flagged_tasks`
--

ALTER TABLE `flagged_tasks`
	ADD CONSTRAINT `fk_reporter_id` FOREIGN KEY (`reporter_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_taskid` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON UPDATE CASCADE;

--
-- Constraints for table `session_log`
--	

ALTER TABLE `session_log`
	ADD CONSTRAINT `fk_sessionid` FOREIGN KEY (`session_id`) REFERENCES `active_session` (`session_id`) ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE;
	
--
-- Constraints for table `viewed_task`
--
ALTER TABLE `viewed_task`
	ADD CONSTRAINT `fk_task_viewed` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`) ON UPDATE CASCADE,
	ADD CONSTRAINT `fk_user_viewed` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;