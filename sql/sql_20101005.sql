/*
SQLyog Enterprise - MySQL GUI v6.1
MySQL - 5.1.39-community : Database - zfcms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `bugs` */

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

/*Data for the table `bugs` */

insert  into `bugs`(`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`) values (3,'Marge Simpson','philip@philipdamra.com',0,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress');
insert  into `bugs`(`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`) values (5,'Marge Simpson','philip@philipdamra.com',11,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress');
insert  into `bugs`(`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`) values (6,'Philip','djheru@gmail.com',7,'http://www.mediag.com/','Faz Baz is Bar Foo','high','in_progress');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category`) values (1,'PHP');
insert  into `categories`(`id`,`category`) values (2,'Flex Builder');
insert  into `categories`(`id`,`category`) values (3,'HTML/CSS');
insert  into `categories`(`id`,`category`) values (4,'Javascript/jQuery');
insert  into `categories`(`id`,`category`) values (5,'Flash');
insert  into `categories`(`id`,`category`) values (6,'Photoshop');

/*Table structure for table `comments` */

DROP TABLE IF EXISTS `comments`;

CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `name` varchar(64) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `timestamp` int(16) DEFAULT NULL,
  `content` text,
  `approved` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

insert  into `comments`(`id`,`page_id`,`name`,`email`,`timestamp`,`content`,`approved`) values (1,15,'asdf','asdf',5452541,'asdfaas adas sdfasdf asdf asdf asdasdfasdfasdfasdf asdf asdfasdfasdfasdf a',1);

/*Table structure for table `content_nodes` */

DROP TABLE IF EXISTS `content_nodes`;

CREATE TABLE `content_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `node` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Data for the table `content_nodes` */

insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (73,17,'headline','This is a php tut');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (74,17,'image',NULL);
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (75,17,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (76,17,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (77,17,'comments','1');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (78,18,'headline','Javascript Tutorial');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (79,18,'image',NULL);
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (80,18,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (81,18,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (82,18,'comments','1');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (83,19,'headline','This is html css');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (84,19,'image',NULL);
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (85,19,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (86,19,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (87,19,'comments','1');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (88,19,'category_id','3');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (89,18,'category_id','4');
insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (90,17,'category_id','1');

/*Table structure for table `menu_items` */

DROP TABLE IF EXISTS `menu_items`;

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) DEFAULT NULL,
  `label` varchar(250) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `link` varchar(250) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `menu_items` */

insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (1,1,'Contact',0,'/contact/index',4);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (2,1,'Home',0,'/index',1);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (3,1,'Blog',0,'/blog',2);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (8,2,'Manage Pages',0,'/page/list',2);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (9,2,'Manage Menus',0,'/menu',4);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (10,2,'Manage Users',0,'/user/list',1);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (11,2,'Rebuild Search Index',0,'/search/build',5);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (12,2,'Manage Posts',0,'/blog/list',3);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (13,1,'RSS',0,'/feed/rss',5);
insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (14,1,'Portfolio',0,'/portfolio',3);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`access_level`) values (1,'main_menu',NULL);
insert  into `menus`(`id`,`name`,`access_level`) values (2,'admin_menu',NULL);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`parent_id`,`namespace`,`name`,`date_created`) values (17,0,'blog','PHP Tutorial Title',1268798453);
insert  into `pages`(`id`,`parent_id`,`namespace`,`name`,`date_created`) values (18,0,'blog','Javascript Tutorial Title',1268798591);
insert  into `pages`(`id`,`parent_id`,`namespace`,`name`,`date_created`) values (19,0,'blog','HTMLCSS Tutorial',1268798665);

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `tags` */

insert  into `tags`(`id`,`page_id`,`tag`) values (22,17,'Foo');
insert  into `tags`(`id`,`page_id`,`tag`) values (23,18,'Bar');
insert  into `tags`(`id`,`page_id`,`tag`) values (28,18,'Baz');
insert  into `tags`(`id`,`page_id`,`tag`) values (29,19,'Foo');
insert  into `tags`(`id`,`page_id`,`tag`) values (30,17,'Bar');
insert  into `tags`(`id`,`page_id`,`tag`) values (31,17,'bjazz');
insert  into `tags`(`id`,`page_id`,`tag`) values (32,18,'bjazz');
insert  into `tags`(`id`,`page_id`,`tag`) values (33,18,'Foo');
insert  into `tags`(`id`,`page_id`,`tag`) values (34,18,'Fazazz');
insert  into `tags`(`id`,`page_id`,`tag`) values (35,19,'bjazz');
insert  into `tags`(`id`,`page_id`,`tag`) values (36,19,'Baz');
insert  into `tags`(`id`,`page_id`,`tag`) values (37,19,'Foozle');

/*Table structure for table `users` */

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

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`first_name`,`last_name`,`role`) values (1,'admin','adfd6757cbf6d0aff2e675de88b769de','Philip','Damra','Administrator');
insert  into `users`(`id`,`username`,`password`,`first_name`,`last_name`,`role`) values (3,'djheru','adfd6757cbf6d0aff2e675de88b769de','dj','heru','User');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
