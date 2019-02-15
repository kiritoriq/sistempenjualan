# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 192.168.0.5 (MySQL 5.5.47-MariaDB)
# Database: master_develop2
# Generation Time: 2016-07-22 14:10:11 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table application_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `application_log`;

CREATE TABLE `application_log` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `aksi` varchar(255) DEFAULT NULL,
  `module` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `user` bigint(20) DEFAULT NULL,
  `waktu` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;



# Dump of table configurations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `configurations`;

CREATE TABLE `configurations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `configurations` WRITE;
/*!40000 ALTER TABLE `configurations` DISABLE KEYS */;

INSERT INTO `configurations` (`id`, `name`, `value`, `created_at`, `updated_at`)
VALUES
	(1,'site-name','Master Develop Dinustek','2014-02-19 00:00:00','2014-03-12 12:16:47'),
	(2,'list-limit','25','2014-02-19 00:00:00','2014-02-26 02:28:22'),
	(3,'Framework Version','5.1','2015-05-01 13:46:29','2016-06-09 03:19:42');

/*!40000 ALTER TABLE `configurations` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table contexts
# ------------------------------------------------------------

DROP TABLE IF EXISTS `contexts`;

CREATE TABLE `contexts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_path` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `uses` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT ' ',
  `flag` int(11) DEFAULT NULL,
  `is_nav_bar` int(11) DEFAULT NULL,
  `icons` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `contexts` WRITE;
/*!40000 ALTER TABLE `contexts` DISABLE KEYS */;

INSERT INTO `contexts` (`id`, `module_path`, `name`, `path`, `uses`, `flag`, `is_nav_bar`, `icons`, `order`, `created_at`, `updated_at`)
VALUES
	(1,0,'Dashboard','/dashboard','HomeController@dashboard',1,1,'fa-dashboard',1,'2014-02-06 00:00:00','2014-02-06 00:00:00'),
	(2,0,'Developer','','',1,1,'fa-wrench',2,'2014-02-06 00:00:00','2014-02-06 00:00:00'),
	(3,0,'Settings','','',1,1,'fa-gears',3,'2014-02-12 00:00:00','2014-02-12 00:00:00');

/*!40000 ALTER TABLE `contexts` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table migrations
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



# Dump of table modules
# ------------------------------------------------------------

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_path` int(11) NOT NULL,
  `id_context` int(11) NOT NULL,
  `id_parent` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(350) COLLATE utf8_unicode_ci NOT NULL,
  `path` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `uses` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `flag` int(11) NOT NULL,
  `is_nav_bar` int(11) NOT NULL,
  `icons` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `order` int(11) NOT NULL,
  `table_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `modules` WRITE;
/*!40000 ALTER TABLE `modules` DISABLE KEYS */;

INSERT INTO `modules` (`id`, `module_path`, `id_context`, `id_parent`, `name`, `description`, `path`, `uses`, `flag`, `is_nav_bar`, `icons`, `order`, `table_name`, `created_at`, `updated_at`)
VALUES
	(1,0,2,0,'Context','Contexts Moduls','/developer/context','ContextController',1,1,'fa-align-left',0,'contexts','2014-02-20 00:00:00','0000-00-00 00:00:00'),
	(2,0,2,0,'Modules','Modules','/developer/modules','ModulesController',1,1,'fa-bolt',1,'modules','2014-02-20 00:00:00','0000-00-00 00:00:00'),
	(3,0,3,0,'Permissions','','/settings/permissions','PermissionsController',1,1,'fa-check-square-o',1,'permissions','2014-02-22 00:00:00','2014-02-22 00:00:00'),
	(4,0,3,0,'Permissions Matrix','','/settings/permissionsmatrix','PermissionsmatrixController',1,1,'fa-check-square-o',2,'role_permission','2014-02-22 00:00:00','2014-02-22 00:00:00'),
	(5,0,3,0,'Roles','','/settings/roles','RolesController',1,1,'fa-child',3,'roles','2014-02-24 00:00:00','2014-02-24 00:00:00'),
	(6,0,3,0,'Configurations','','/settings/configurations','ConfigurationsController',1,1,'fa-wrench',0,'configurations','2014-02-24 00:00:00','2014-02-24 00:00:00'),
	(7,0,3,0,'Users','','/settings/users','UsersController',1,1,'fa-users',4,'users','2014-02-24 00:00:00','2014-02-24 00:00:00');

/*!40000 ALTER TABLE `modules` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table permissions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','Inactive') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;

INSERT INTO `permissions` (`id`, `name`, `description`, `status`, `created_at`, `updated_at`)
VALUES
	(1,'site-login','Allow User to login','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(2,'context-dashboard','Allow View Dashboard','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(3,'context-developer','Allow View Developer','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(4,'context-settings','Allow View Settings','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(5,'mod-context-index','Allow Access Context Index','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(6,'mod-context-create','Allow Access Context Create','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(7,'mod-context-edit','Allow Access Context Edit','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(8,'mod-context-delete','Allow Access Context Delete','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(9,'mod-modules-index','Allow Access Modules Index','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(10,'mod-modules-create','Allow Access Modules Create','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(11,'mod-modules-edit','Allow Access Modules Edit','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(12,'mod-modules-delete','Allow Access Modules Delete','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(13,'mod-permissions-index','Allow Access Permissions Index','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(14,'mod-permissions-create','Allow Access Permissions Create','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(15,'mod-permissions-edit','Allow Access Permissions Edit','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(16,'mod-permissions-delete','Allow Access Permissions Delete','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(17,'mod-roles-index','Allow Access Roles Index','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(18,'mod-roles-create','Allow Access Roles Create','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(19,'mod-roles-edit','Allow Access Roles Edit','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(20,'mod-roles-delete','Allow Access Roles Delete','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(21,'mod-permissionsmatrix-index','Allow Access Permissions Matrix Index','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(22,'mod-permissionsmatrix-create','Allow Access Permissions Matrix Create','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(23,'mod-permissionsmatrix-edit','Allow Access Permissions Matrix Edit','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(24,'mod-permissionsmatrix-delete','Allow Access Permissions Matrix Delete','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(25,'mod-users-index','Allow Access Users Index','Active','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(26,'mod-users-create','Allow Access Users Create','Active','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(27,'mod-users-edit','Allow Access Users Edit','Active','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(28,'mod-users-delete','Allow Access Users Delete','Active','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(30,'mod-configurations-index','Allow Access Configurations Index','Active','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(31,'mod-configurations-create','Allow Access Configurations Create','Active','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(32,'mod-configurations-edit','Allow Access Configurations Edit','Active','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(33,'mod-configurations-delete','Allow Access Configurations Delete','Active','2014-02-19 00:00:00','2014-02-19 00:00:00');

/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table role_permission
# ------------------------------------------------------------

DROP TABLE IF EXISTS `role_permission`;

CREATE TABLE `role_permission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `role_id` bigint(20) NOT NULL,
  `role_parent` bigint(20) NOT NULL,
  `permission_id` bigint(20) NOT NULL,
  `start_date` datetime DEFAULT '0000-00-00 00:00:00',
  `end_date` datetime DEFAULT '0000-00-00 00:00:00',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `role_permission` WRITE;
/*!40000 ALTER TABLE `role_permission` DISABLE KEYS */;

INSERT INTO `role_permission` (`id`, `role_id`, `role_parent`, `permission_id`, `start_date`, `end_date`, `created_at`, `updated_at`)
VALUES
	(1,1,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(2,1,0,3,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(3,1,0,4,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(4,1,0,9,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(5,1,0,10,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(6,1,0,11,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(7,1,0,12,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(8,1,0,13,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(9,1,0,14,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(10,1,0,15,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(11,1,0,16,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(12,1,0,17,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(13,1,0,18,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(14,1,0,19,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(15,1,0,20,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(16,1,0,21,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(17,1,0,22,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(18,1,0,23,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(19,1,0,24,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-18 00:00:00','2014-02-18 00:00:00'),
	(20,1,0,25,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(21,1,0,26,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(22,1,0,27,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(23,1,0,28,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(24,1,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(26,1,0,7,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(27,1,0,6,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(29,1,0,30,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(30,1,0,31,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(31,1,0,32,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(34,1,0,5,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-19 00:00:00','2014-02-19 00:00:00'),
	(81,1,0,8,'0000-00-00 00:00:00','0000-00-00 00:00:00','2014-02-24 00:00:00','2014-02-24 00:00:00'),
	(84,1,0,36,'0000-00-00 00:00:00','0000-00-00 00:00:00','2015-04-29 23:53:43','2015-04-29 23:53:43'),
	(85,1,0,37,'0000-00-00 00:00:00','0000-00-00 00:00:00','2015-04-29 23:53:43','2015-04-29 23:53:43'),
	(86,1,0,38,'0000-00-00 00:00:00','0000-00-00 00:00:00','2015-04-29 23:53:43','2015-04-29 23:53:43'),
	(87,1,0,39,'0000-00-00 00:00:00','0000-00-00 00:00:00','2015-04-29 23:53:43','2015-04-29 23:53:43'),
	(89,2,0,1,'0000-00-00 00:00:00','0000-00-00 00:00:00','2016-06-09 04:14:51','2016-06-09 04:14:51'),
	(90,1,0,33,'0000-00-00 00:00:00','0000-00-00 00:00:00','2016-06-09 04:20:14','2016-06-09 04:20:14'),
	(91,1,0,33,'0000-00-00 00:00:00','0000-00-00 00:00:00','2016-06-09 04:20:14','2016-06-09 04:20:14'),
	(166,2,0,2,'0000-00-00 00:00:00','0000-00-00 00:00:00','2016-06-09 14:18:47','2016-06-09 14:18:47');

/*!40000 ALTER TABLE `role_permission` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table roles
# ------------------------------------------------------------

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parent` bigint(20) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `login_destination` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('Active','In Active') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Active',
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;

INSERT INTO `roles` (`id`, `parent`, `name`, `description`, `login_destination`, `status`, `created_at`, `updated_at`)
VALUES
	(1,0,'Administrator','Administrator Role','dashboard','Active','2014-02-12 00:00:00','2014-02-12 00:00:00'),
	(2,0,'Super Admin','Untuk super admin','dashboard','Active','2016-06-09 04:13:52','2016-06-09 04:13:52');

/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table users
# ------------------------------------------------------------

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(320) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` bigint(20) NOT NULL,
  `foto` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;

INSERT INTO `users` (`id`, `name`, `username`, `email`, `password`, `role_id`, `foto`, `remember_token`, `created_at`, `updated_at`, `deleted_at`)
VALUES
	(1,'Developer','admin','admin@local','$2y$10$OGJ2VjPwXaJ02eYaw.ki8OZGm3j/vUz8nw3TOoKWwYHLrOPkLGToi',1,'bunny.jpg','y2sfCbM93a7pxxxTYXwEHglfAt1cIdF5h4vPgfuMi0Z30KVy2FUvBwBHJXrR','2014-02-25 00:00:00','2016-06-09 15:41:03',NULL);

/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
