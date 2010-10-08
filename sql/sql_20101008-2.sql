# Sequel Pro dump
# Version 2492
# http://code.google.com/p/sequel-pro
#
# Host: localhost (MySQL 5.1.44)
# Database: zfcms
# Generation Time: 2010-10-08 08:53:02 -0400
# ************************************************************

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table bugs
# ------------------------------------------------------------

DROP TABLE IF EXISTS `bugs`;

CREATE TABLE `bugs` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(250) DEFAULT NULL,
  `email` varchar(250) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `url` varchar(250) DEFAULT NULL,
  `description` text,
  `priority` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `bugs` WRITE;
/*!40000 ALTER TABLE `bugs` DISABLE KEYS */;
INSERT INTO `bugs` (`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`)
VALUES
	(3,'Marge Simpson','philip@philipdamra.com',0,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),
	(5,'Marge Simpson','philip@philipdamra.com',11,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),
	(6,'Philip','djheru@gmail.com',7,'http://www.mediag.com/','Faz Baz is Bar Foo','high','in_progress');

/*!40000 ALTER TABLE `bugs` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table categories
# ------------------------------------------------------------

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`,`category`)
VALUES
	(1,'PHP'),
	(2,'Flex Builder'),
	(3,'HTML/CSS'),
	(4,'Javascript/jQuery'),
	(5,'Flash'),
	(6,'Photoshop');

/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table comments
# ------------------------------------------------------------

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `timestamp` int(16) DEFAULT NULL,
  `content` text,
  `approved` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` (`id`,`page_id`,`name`,`email`,`timestamp`,`content`,`approved`)
VALUES
	(1,17,'asdf','asdf',5452541,'asdfaas adas sdfasdf asdf asdf asdasdfasdfasdfasdf asdf asdfasdfasdfasdf a',1),
	(2,17,'DOOfls','asfdoj',12652541,'a sjkd; asdfajs; kdasdfiua sdofijsdalf kj\r\n\r\nasdlf kjasdl;kfj\r\nasdf;aljksfd \r\n\r\nasd fh;sdlfj',1),
	(3,17,'Fundoodooos','pdamra@philidamra.com',1286426917,'This si test',1),
	(4,17,'Philip','philip@philipdamra.com',1286426994,'adfasdf afa dfasdfa',1),
	(5,17,'Entrees','pdamra@philidamra.com',1286427049,'asdf sd afa sdf asdf sssssssss',1),
	(6,17,'Fundoodooos','a sdasd asd f',1286427129,'asd fas dfasdfsdf sdf',1),
	(7,17,'Philip','djheru@gmail.com',1286427296,'asfd sas df',1),
	(8,17,'Philip','djheru@gmail.com',1286427325,'asfd sas dfa sdsad d as df<br />\n<br />\na sdfas df',1),
	(9,19,'Philip','pdamra@philidamra.com',1286427760,'This is a foo',1),
	(10,19,'Philip','pdamra@philidamra.com',1286427824,'This is a foo1',1),
	(11,19,'Fundoodooos','pdamra@philidamra.com',1286427853,'This is bar',1),
	(12,19,'Fassdo','fdoaso@asdfo.com',1286503556,'alsdfo dfsad f<br />\n<br />\nJDFosajdf <br />\n<br />\n<?php ODJFodsafoos; ?>',1);

/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table content_nodes
# ------------------------------------------------------------

DROP TABLE IF EXISTS `content_nodes`;

CREATE TABLE `content_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `node` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

LOCK TABLES `content_nodes` WRITE;
/*!40000 ALTER TABLE `content_nodes` DISABLE KEYS */;
INSERT INTO `content_nodes` (`id`,`page_id`,`node`,`content`)
VALUES
	(73,17,'headline','This is a php tut'),
	(74,17,'image',NULL),
	(75,17,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),
	(76,17,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. FooBar BasFz</p>'),
	(77,17,'comments','1'),
	(78,18,'headline','Javascript Tutorial'),
	(79,18,'image',NULL),
	(80,18,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),
	(81,18,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),
	(82,18,'comments','1'),
	(83,19,'headline','This is html css'),
	(85,19,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),
	(86,19,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.</p>'),
	(87,19,'comments','1'),
	(88,19,'category_id','3'),
	(89,18,'category_id','4'),
	(90,17,'category_id','1'),
	(91,20,'headline','This is a new test page 1'),
	(92,20,'description','Here is the test page description'),
	(93,20,'pageContent','<p>This is teh test page content.</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');

/*!40000 ALTER TABLE `content_nodes` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menu_items
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

LOCK TABLES `menu_items` WRITE;
/*!40000 ALTER TABLE `menu_items` DISABLE KEYS */;
INSERT INTO `menu_items` (`id`,`menu_id`,`label`,`page_id`,`link`,`position`)
VALUES
	(1,1,'Contact',0,'/contact/index',4),
	(2,1,'Home',0,'/index/index',1),
	(3,1,'Tutorials',0,'/blog/index',2),
	(8,2,'Manage Pages',0,'/page/list',2),
	(9,2,'Manage Menus',0,'/menu',4),
	(10,2,'Manage Users',0,'/user/list',1),
	(11,2,'Rebuild Search Index',0,'/search/build',5),
	(12,2,'Manage Posts',0,'/blog/list',3),
	(13,1,'RSS',0,'/feed/rss',5),
	(14,1,'Articles',0,'/page/index',3),
	(15,2,'Log Out',0,'/user/logout',6);

/*!40000 ALTER TABLE `menu_items` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table menus
# ------------------------------------------------------------

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` (`id`,`name`,`access_level`)
VALUES
	(1,'main_menu',NULL),
	(2,'admin_menu',NULL);

/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table pages
# ------------------------------------------------------------

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` (`id`,`parent_id`,`namespace`,`name`,`date_created`)
VALUES
	(17,0,'blog','PHP Tutorial Title',1268798453),
	(18,0,'blog','Javascript Tutorial Title',1268798591),
	(19,0,'blog','HTMLCSS Tutorial',1268798665),
	(20,0,'page','Test Page 1s',1286495810);

/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table tags
# ------------------------------------------------------------

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

LOCK TABLES `tags` WRITE;
/*!40000 ALTER TABLE `tags` DISABLE KEYS */;
INSERT INTO `tags` (`id`,`page_id`,`tag`)
VALUES
	(22,17,'Foo'),
	(23,18,'Bar'),
	(28,18,'Baz'),
	(29,19,'Foo'),
	(30,17,'Bar'),
	(31,17,'bjazz'),
	(32,18,'bjazz'),
	(33,18,'Foo'),
	(34,18,'Fazazz'),
	(35,19,'bjazz'),
	(36,19,'Baz'),
	(37,19,'Foozle');

/*!40000 ALTER TABLE `tags` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `role` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`,`username`,`password`,`first_name`,`last_name`,`role`)
VALUES
	(1,'admin','adfd6757cbf6d0aff2e675de88b769de','Philip','Damra','Administrator');

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;





/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
