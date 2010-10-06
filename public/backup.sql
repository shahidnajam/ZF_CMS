/*
SQLyog Enterprise - MySQL GUI v6.1
MySQL - 5.0.45-community-nt : Database - zf_cms
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

/*Table structure for table `bugs` */

CREATE TABLE `bugs` (
  `id` int(11) unsigned NOT NULL auto_increment,
  `author` varchar(250) default NULL,
  `email` varchar(250) default NULL,
  `date` int(11) default NULL,
  `url` varchar(250) default NULL,
  `description` text,
  `priority` varchar(50) default NULL,
  `status` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `bugs` */

insert  into `bugs`(`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`) values (3,'Marge Simpson','philip@philipdamra.com',0,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),(5,'Marge Simpson','philip@philipdamra.com',11,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),(6,'Philip','djheru@gmail.com',7,'http://www.mediag.com/','Faz Baz is Bar Foo','high','in_progress');

/*Table structure for table `categories` */

CREATE TABLE `categories` (
  `id` int(11) NOT NULL auto_increment,
  `category` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category`) values (1,'PHP'),(2,'Flex Builder'),(3,'HTML/CSS'),(4,'Javascript/jQuery'),(5,'Flash'),(6,'Photoshop');

/*Table structure for table `comments` */

CREATE TABLE `comments` (
  `id` int(11) NOT NULL auto_increment,
  `page_id` int(11) default NULL,
  `name` varchar(64) default NULL,
  `email` varchar(255) default NULL,
  `timestamp` int(16) default NULL,
  `content` text,
  `approved` tinyint(1) default '1',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

insert  into `comments`(`id`,`page_id`,`name`,`email`,`timestamp`,`content`,`approved`) values (1,15,'asdf','asdf',5452541,'asdfaas adas sdfasdf asdf asdf asdasdfasdfasdfasdf asdf asdfasdfasdfasdf a',1);

/*Table structure for table `content_nodes` */

CREATE TABLE `content_nodes` (
  `id` int(11) NOT NULL auto_increment,
  `page_id` int(11) default NULL,
  `node` varchar(50) default NULL,
  `content` text,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=latin1;

/*Data for the table `content_nodes` */

insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (73,17,'headline','This is a php tut'),(74,17,'image',NULL),(75,17,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(76,17,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(77,17,'comments','1'),(78,18,'headline','Javascript Tutorial'),(79,18,'image',NULL),(80,18,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(81,18,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(82,18,'comments','1'),(83,19,'headline','This is html css'),(84,19,'image',NULL),(85,19,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(86,19,'blogContent','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(87,19,'comments','1'),(88,19,'category_id','3'),(89,18,'category_id','4'),(90,17,'category_id','1');

/*Table structure for table `menu_items` */

CREATE TABLE `menu_items` (
  `id` int(11) NOT NULL auto_increment,
  `menu_id` int(11) default NULL,
  `label` varchar(250) default NULL,
  `page_id` int(11) default NULL,
  `link` varchar(250) default NULL,
  `position` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

/*Data for the table `menu_items` */

insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (1,1,'Contact',0,'/contact/index',4),(2,1,'Home',0,'/index',1),(3,1,'Blog',0,'/blog',2),(8,2,'Manage Pages',0,'/page/list',2),(9,2,'Manage Menus',0,'/menu',4),(10,2,'Manage Users',0,'/user/list',1),(11,2,'Rebuild Search Index',0,'/search/build',5),(12,2,'Manage Posts',0,'/blog/list',3),(13,1,'RSS',0,'/feed/rss',5),(14,1,'Portfolio',0,'/portfolio',3);

/*Table structure for table `menus` */

CREATE TABLE `menus` (
  `id` int(11) NOT NULL auto_increment,
  `name` varchar(50) default NULL,
  `access_level` varchar(50) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`access_level`) values (1,'main_menu',NULL),(2,'admin_menu',NULL);

/*Table structure for table `pages` */

CREATE TABLE `pages` (
  `id` int(11) NOT NULL auto_increment,
  `parent_id` int(11) default NULL,
  `namespace` varchar(50) default NULL,
  `name` varchar(100) default NULL,
  `date_created` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`parent_id`,`namespace`,`name`,`date_created`) values (17,0,'blog','PHP Tutorial Title',1268798453),(18,0,'blog','Javascript Tutorial Title',1268798591),(19,0,'blog','HTMLCSS Tutorial',1268798665);

/*Table structure for table `tags` */

CREATE TABLE `tags` (
  `id` int(11) NOT NULL auto_increment,
  `page_id` int(11) default NULL,
  `tag` varchar(64) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

/*Data for the table `tags` */

insert  into `tags`(`id`,`page_id`,`tag`) values (22,17,'Foo'),(23,18,'Bar'),(28,18,'Baz'),(29,19,'Foo'),(30,17,'Bar'),(31,17,'bjazz'),(32,18,'bjazz'),(33,18,'Foo'),(34,18,'Fazazz'),(35,19,'bjazz'),(36,19,'Baz'),(37,19,'Foozle');

/*Table structure for table `users` */

CREATE TABLE `users` (
  `id` int(11) NOT NULL auto_increment,
  `username` varchar(50) default NULL,
  `password` varchar(250) default NULL,
  `first_name` varchar(50) default NULL,
  `last_name` varchar(50) default NULL,
  `role` varchar(25) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`first_name`,`last_name`,`role`) values (1,'admin','adfd6757cbf6d0aff2e675de88b769de','Philip','Damra','Administrator'),(3,'djheru','adfd6757cbf6d0aff2e675de88b769de','dj','heru','User');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;