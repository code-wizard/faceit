# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.6.26)
# Database: faceit
# Generation Time: 2017-01-26 04:46:34 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table faces
# ------------------------------------------------------------

DROP TABLE IF EXISTS `faces`;

CREATE TABLE `faces` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) NOT NULL,
  `confident_level` varchar(11) DEFAULT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `top_left_x` int(11) DEFAULT NULL,
  `top_left_y` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-faces-image_id` (`image_id`),
  CONSTRAINT `fk-faces-image_id` FOREIGN KEY (`image_id`) REFERENCES `image` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `faces` WRITE;
/*!40000 ALTER TABLE `faces` DISABLE KEYS */;

INSERT INTO `faces` (`id`, `image_id`, `confident_level`, `width`, `height`, `gender`, `top_left_x`, `top_left_y`)
VALUES
	(24,31,'80%',182,182,'F',183,69),
	(25,32,'100%',646,646,'M',620,334),
	(26,33,'100%',646,646,'M',620,334),
	(27,34,'100%',646,646,'M',620,334),
	(28,35,'100%',646,646,'M',620,334),
	(29,36,'100%',646,646,'M',620,334),
	(30,37,'60%',163,163,'M',88,122),
	(31,38,'60%',163,163,'M',88,122),
	(32,39,'60%',163,163,'M',88,122),
	(33,40,'60%',163,163,'M',88,122),
	(34,41,'100%',646,646,'M',620,334),
	(35,42,'60%',163,163,'M',88,122),
	(36,43,'100%',131,131,'F',145,100),
	(37,44,'90%',240,240,'F',158,96),
	(38,45,'90%',328,328,'F',138,75),
	(39,46,'90%',328,328,'F',138,75),
	(40,47,'70%',281,281,'M',37,70),
	(41,48,'70%',54,54,'M',235,28),
	(42,48,'50%',52,52,'M',295,27),
	(43,48,'70%',51,51,'F',354,33),
	(44,48,'70%',62,62,'M',180,30),
	(45,48,'70%',45,45,'F',95,106),
	(46,48,'100%',63,63,'F',89,25);

/*!40000 ALTER TABLE `faces` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table image
# ------------------------------------------------------------

DROP TABLE IF EXISTS `image`;

CREATE TABLE `image` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `link` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `image` WRITE;
/*!40000 ALTER TABLE `image` DISABLE KEYS */;

INSERT INTO `image` (`id`, `name`, `width`, `height`, `link`)
VALUES
	(31,'1485350102.jpg',475,435,'/downloaded_images/1485350102.jpg'),
	(32,'1485350107.png',1917,1604,'/downloaded_images/1485350107.png'),
	(33,'1485353179.png',1917,1604,'/downloaded_images/1485353179.png'),
	(34,'1485353208.png',1917,1604,'/downloaded_images/1485353208.png'),
	(35,'1485353266.png',1917,1604,'/downloaded_images/1485353266.png'),
	(36,'1485354249.png',1917,1604,'/downloaded_images/1485354249.png'),
	(37,'1485354257.jpg',403,403,'/downloaded_images/1485354257.jpg'),
	(38,'1485354381.jpg',403,403,'/downloaded_images/1485354381.jpg'),
	(39,'1485354444.jpg',403,403,'/downloaded_images/1485354444.jpg'),
	(40,'1485354510.jpg',403,403,'/downloaded_images/1485354510.jpg'),
	(41,'1485354941.png',1917,1604,'/downloaded_images/1485354941.png'),
	(42,'1485354948.jpg',403,403,'/downloaded_images/1485354948.jpg'),
	(43,'1485354954.jpg',420,459,'/downloaded_images/1485354954.jpg'),
	(44,'1485354958.jpg',600,582,'/downloaded_images/1485354958.jpg'),
	(45,'1485355025.jpg',592,624,'/downloaded_images/1485355025.jpg'),
	(46,'1485355055.jpg',592,624,'/downloaded_images/1485355055.jpg'),
	(47,'1485359247.jpg',500,455,'/downloaded_images/1485359247.jpg'),
	(48,'1485361543.jpg',494,228,'/downloaded_images/1485361543.jpg');

/*!40000 ALTER TABLE `image` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migration
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration`;

CREATE TABLE `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `migration` WRITE;
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;

INSERT INTO `migration` (`version`, `apply_time`)
VALUES
	('m000000_000000_base',1485261524),
	('m170124_122823_create_image_table',1485261526),
	('m170124_153250_create_faces_table',1485272189),
	('m170124_153455_drop_confident_level_column_from_image_table',1485272190),
	('m170125_130759_add_topX_column_to_faces_table',1485349694);

/*!40000 ALTER TABLE `migration` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
