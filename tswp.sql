-- Adminer 4.0.2 MySQL dump

SET NAMES utf8;
SET foreign_key_checks = 0;
SET time_zone = '+02:00';
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `article`;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `actual_version` varchar(20) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `article_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `article` (`id`, `user_id`, `name`, `description`, `actual_version`, `created`) VALUES
(2,	1,	'Prvý článok',	'Popis',	'1.2',	'0000-00-00'),
(3,	1,	'Clanok numero uno',	'Caca',	'0.2',	'2014-05-04');

DROP TABLE IF EXISTS `file`;
CREATE TABLE `file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `type` varchar(100) NOT NULL,
  `url` varchar(255) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version_id` (`version_id`),
  CONSTRAINT `file_ibfk_1` FOREIGN KEY (`version_id`) REFERENCES `version` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `file` (`id`, `version_id`, `name`, `type`, `url`, `created`) VALUES
(1,	1,	'Moj_subor',	'file',	'/store/file',	'0000-00-00'),
(2,	1,	'soabenefits',	'png',	'article-blabla/version-0-1/soabenefits-2014-05-04-14-50-46.png',	'2014-05-04'),
(3,	1,	'Insurance',	'png',	'article-blabla/version-0-1/insurance-2014-05-04-14-58-21.png',	'2014-05-04'),
(5,	2,	'AAa',	'png',	'article-blabla/version-1-0/aaa-2014-05-04-15-39-18.png',	'2014-05-04'),
(6,	2,	'Druhy subor',	'png',	'article-blabla/version-1-1/druhy-subor-2014-05-04-15-39-34.png',	'2014-05-04'),
(7,	5,	'Subor',	'png',	'article-blabla/version-0-1/subor-2014-05-04-15-40-02.png',	'2014-05-04');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(200) NOT NULL,
  `role` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `user` (`id`, `email`, `password`, `role`) VALUES
(1,	'student@student.tuke.sk',	'204036a1ef6e7360e536300ea78c6aeb4a9333dd',	'student');

DROP TABLE IF EXISTS `version`;
CREATE TABLE `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `version_1` smallint(6) NOT NULL,
  `version_2` smallint(6) NOT NULL,
  `created` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article_id` (`article_id`),
  CONSTRAINT `version_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `version` (`id`, `article_id`, `version_1`, `version_2`, `created`) VALUES
(1,	2,	0,	2,	'0000-00-00'),
(2,	2,	1,	2,	'2014-05-04'),
(5,	3,	0,	2,	'2014-05-04');

-- 2014-05-04 15:53:35