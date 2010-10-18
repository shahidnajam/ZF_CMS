/*
SQLyog Enterprise - MySQL GUI v6.1
MySQL - 5.1.50-community : Database - zfcms
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

insert  into `bugs`(`id`,`author`,`email`,`date`,`url`,`description`,`priority`,`status`) values (3,'Marge Simpson','philip@philipdamra.com',0,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),(5,'Marge Simpson','philip@philipdamra.com',11,'http://www.zfcms.com/bug/submit','Frogs eat poo','med','in_progress'),(6,'Philip','djheru@gmail.com',7,'http://www.mediag.com/','Faz Baz is Bar Foo','high','in_progress');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `categories` */

insert  into `categories`(`id`,`category`) values (1,'PHP'),(2,'Flex Builder'),(3,'HTML/CSS'),(4,'Javascript/jQuery'),(5,'Flash');

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
  PRIMARY KEY (`id`),
  KEY `page_id` (`page_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `comments` */

/*Table structure for table `content_nodes` */

DROP TABLE IF EXISTS `content_nodes`;

CREATE TABLE `content_nodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `node` varchar(50) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

/*Data for the table `content_nodes` */

insert  into `content_nodes`(`id`,`page_id`,`node`,`content`) values (73,17,'headline','PHP Tutorial'),(74,17,'image',NULL),(75,17,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(76,17,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. FooBar BasFz</p>\r\n<p>\r\n<span class=\"php\"><code>public function commentAction()\r\n    {\r\n        $this-&gt;_helper-&gt;layout-&gt;disableLayout();\r\n        $id = $this-&gt;_request-&gt;getParam(\'id\');\r\n        $commentForm = new Form_Comment();\r\n        $commentForm-&gt;setAction(\'/blog/comment/id/\'.$id);\r\n        $commentForm-&gt;getElement(\'id\')-&gt;setValue($id);\r\n        $commentsModel = new Model_Comment();\r\n        if($this-&gt;_request-&gt;isPost() &amp;&amp; $commentForm-&gt;isValid($_POST))\r\n        {\r\n            $data = array(\r\n                \'page_id\'=&gt; $id,\r\n                \'name\'=&gt; strip_tags($commentForm-&gt;getValue(\'name\')),\r\n                \'email\'=&gt; strip_tags($commentForm-&gt;getValue(\'email\')),\r\n                \'timestamp\'=&gt; time(),\r\n                \'content\'=&gt; htmlentities($commentForm-&gt;getValue(\'content\'))\r\n            );\r\n            $commentsModel-&gt;insert($data);\r\n        }\r\n        $this-&gt;view-&gt;form = $commentForm;\r\n        $this-&gt;view-&gt;comments = $commentsModel-&gt;getCommentsByPage($id);\r\n    }</code></span>\r\n</p>'),(77,17,'comments','1'),(78,18,'headline','Javascript Tutorial'),(79,18,'image',NULL),(80,18,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(81,18,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.</p>\r\n<p><span class=\"javascript\"><code>\r\njQuery(\'document\').ready(function($){\r\n    $(\'#hideTags\').appendTo(\'#tags-element\');\r\n    $(\'div#hideTags ul.Zend_Tag_Cloud li a\').click(function(){\r\n        var tagFieldContents = $(\'#tags\').val();\r\n        if(tagFieldContents == \'\' &amp;&amp; tagFieldContents.indexOf($(this).text()) &lt; 0) {\r\n            tagFieldContents += $(this).text();\r\n        }\r\n        else if(tagFieldContents.indexOf($(this).text()) &lt; 0) {\r\n            tagFieldContents += \',\' + $(this).text();\r\n        }\r\n        $(\'#tags\').val(tagFieldContents);\r\n        return false;\r\n    });\r\n});\r\n</code></span></p>'),(82,18,'comments','1'),(83,19,'headline','HTML/CSS Tutorial'),(85,19,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(86,19,'blogContent','<p>Lorem ipssum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id. Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.</p>\r\n<p>\r\n<span class=\"css\"><code>\r\nul#categoryMenu { \r\n	list-style-type: none;\r\n	margin-left: 8px;\r\n	margin-top: 8px;\r\n}\r\nul#categoryMenu li {\r\n	padding-left: 30px;\r\n	padding-top: 6px;\r\n	min-height: 24px;\r\n}\r\nli.php {\r\n	background-image: url(../_img/icons/php_sm.png);\r\n	background-repeat: no-repeat;\r\n	background-position: center left;\r\n}\r\nli.flash {\r\n	background-image: url(../_img/icons/flash_sm.png);\r\n	background-repeat: no-repeat;\r\n	background-position: center left;\r\n}\r\n</code></span></p>'),(87,19,'comments','1'),(88,19,'category_id','3'),(89,18,'category_id','4'),(90,17,'category_id','1'),(97,22,'headline','Page Content Title'),(98,22,'description','This is the content displayed on the right column of the homepage'),(99,22,'pageContent','<p>Lorem ipsum dolor sit amet, <a href=\"/page/edit/id/#1\">consectetur adipisicing</a> elit,  							sed do eiusm tempor incididunt ut labore et dolore magna aliqua. Ut enim   							veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea  							commodo consequat. Duis aute irure dolor in reprehenderit.</p>\r\n<p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui offi  							deserunt mollit anim id est laborum.  <a href=\"/page/edit/id/#2\">Sed ut perspiciatis</a> natus error sit voluptatem accusantium doloremque laudantium, totam  							rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi arch  							beatae vitae dicta sunt explicabo.</p>\r\n<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corpori  							suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis  							autem vel eum iure reprehenderit qui in ea voluptate velit esse qu  							nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluu  							nulla pariatur?</p>\r\n<p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corpori  							suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis  							autem vel eum iure reprehenderit qui in ea voluptate velit esse qu  							nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluu  							nulla pariatur?</p>'),(100,23,'headline','Welcome to DevDamra'),(101,23,'description','This is the content that is shown at the top right.'),(102,23,'pageContent','<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.  						Nam cursus. Morbi ut mi. Nullam enim leo, egestas id,  						condimentum at, laoreet mattis, massa. Sed eleifend  						nonummy diam.</p>\r\n<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in 						adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo,  						egestas id, condimentum at, laoreet mattis, massa. Sed  						eleifend nonummy diam.</p>'),(103,19,'image',NULL),(104,24,'headline','Flex Builder Tutorial'),(105,24,'category_id','2'),(106,24,'image',NULL),(107,24,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(108,24,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.</p>\r\n<p><span class=\"AS3\"><code>\r\n[Bindable] private var _contact:ContactsVO = new ContactsVO();\r\npublic function set contact(contact:ContactsVO):void\r\n{\r\n	this._contact = contact;\r\n}\r\nprivate function submit():void\r\n{\r\n	if(first_name.text == \'\' || last_name.text == \'\')\r\n	{\r\n		Alert.show(\"Please enter at least a first and last name before pressing \'Save\'\", \"Enter a Name\");\r\n	}\r\n	else\r\n	{\r\n		_contact.first_name = first_name.text;\r\n		_contact.last_name = last_name.text;\r\n		_contact.email = email.text;\r\n		_contact.phone = phone.text;\r\n		_contact.im = im.text;\r\n		\r\n		var event:SaveContactEvent = new SaveContactEvent(_contact);\r\n		event.dispatch();\r\n	}\r\n}\r\n</code></span></p>'),(109,24,'comments','1'),(110,25,'headline','Flash Tutorial'),(111,25,'category_id','5'),(112,25,'image',NULL),(113,25,'description','Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.'),(114,25,'blogContent','<p>Lorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.\r\nLorem ipsum dolor sit amet, consectetuer asd sdeefe in adipiscing elit. Nam cursus. Morbi ut mi. Nullam enim leo, egestas id.</p>\r\n<p><span class=\"AS3\"><code>\r\n[Bindable] private var _contact:ContactsVO = new ContactsVO();\r\npublic function set contact(contact:ContactsVO):void\r\n{\r\n	this._contact = contact;\r\n}\r\nprivate function submit():void\r\n{\r\n	if(first_name.text == \'\' || last_name.text == \'\')\r\n	{\r\n		Alert.show(\"Please enter at least a first and last name before pressing \'Save\'\", \"Enter a Name\");\r\n	}\r\n	else\r\n	{\r\n		_contact.first_name = first_name.text;\r\n		_contact.last_name = last_name.text;\r\n		_contact.email = email.text;\r\n		_contact.phone = phone.text;\r\n		_contact.im = im.text;\r\n		\r\n		var event:SaveContactEvent = new SaveContactEvent(_contact);\r\n		event.dispatch();\r\n	}\r\n}\r\n</code></span></p>'),(115,25,'comments','0');

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

/*Data for the table `menu_items` */

insert  into `menu_items`(`id`,`menu_id`,`label`,`page_id`,`link`,`position`) values (1,1,'Contact',0,'/contact/index',4),(2,1,'Home',0,'/index/index',1),(3,1,'Tutorials',0,'/blog/index',2),(8,2,'Manage Pages',0,'/page/list',2),(9,2,'Manage Menus',0,'/menu',4),(10,2,'Manage Users',0,'/user/list',3),(11,2,'Rebuild Search Index',0,'/search/build',5),(12,2,'Manage Posts',0,'/blog/list',1),(13,1,'RSS',0,'/feed/rss',5),(14,1,'Articles',0,'/page/index',3),(15,2,'Log Out',0,'/user/logout',6);

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `access_level` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `menus` */

insert  into `menus`(`id`,`name`,`access_level`) values (1,'main_menu',NULL),(2,'admin_menu',NULL);

/*Table structure for table `pages` */

DROP TABLE IF EXISTS `pages`;

CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `namespace` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `date_created` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `pages` */

insert  into `pages`(`id`,`parent_id`,`namespace`,`name`,`date_created`) values (17,0,'blog','PHP Tutorial Title',1268798453),(18,0,'blog','Javascript Tutorial Title',1268798591),(19,0,'blog','HTML CSS Tutorial Title',1268798665),(22,0,'page','homeContent',1286603990),(23,0,'page','welcomeContent',1286604327),(24,0,'blog','Flex Builder Tutorial Title',1287198810),(25,0,'blog','Flash Tutorial Title',1287276870);

/*Table structure for table `tags` */

DROP TABLE IF EXISTS `tags`;

CREATE TABLE `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `tag` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=latin1;

/*Data for the table `tags` */

insert  into `tags`(`id`,`page_id`,`tag`) values (22,17,'Foo'),(23,18,'Bar'),(28,18,'Baz'),(29,19,'Foo'),(30,17,'Bar'),(31,17,'bjazz'),(32,18,'bjazz'),(33,18,'Foo'),(34,18,'Fazazz'),(35,19,'bjazz'),(36,19,'Baz'),(37,19,'Foozle'),(42,19,'Fazazz'),(43,19,'Flloop Floop'),(44,24,'bjazz'),(45,24,'Flloop Floop'),(46,24,'Bar'),(47,25,'bjazz'),(48,25,'Fazazz'),(49,25,'Flloop Floop');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`username`,`password`,`first_name`,`last_name`,`role`) values (1,'admin','0436d3cff1a2439b8701b7d1e2be1403','Philip','Damra','Administrator');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
