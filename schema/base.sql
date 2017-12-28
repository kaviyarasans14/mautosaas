-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: leadsengage_appsbase
-- ------------------------------------------------------
-- Server version	5.5.58-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `applicationlist`
--

DROP TABLE IF EXISTS `applicationlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applicationlist` (
  `appid` varchar(50) NOT NULL DEFAULT '',
  `domain` varchar(100) NOT NULL DEFAULT '',
  `company` varchar(500) DEFAULT '',
  `username` varchar(500) DEFAULT '',
  `useremail` varchar(500) NOT NULL DEFAULT '',
  `usermobile` varchar(100) DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`appid`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicationlist`
--

LOCK TABLES `applicationlist` WRITE;
/*!40000 ALTER TABLE `applicationlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `applicationlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `asset_downloads`
--

DROP TABLE IF EXISTS `asset_downloads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `asset_downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) DEFAULT NULL,
  `ip_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `email_id` int(11) DEFAULT NULL,
  `date_download` datetime NOT NULL,
  `code` int(11) NOT NULL,
  `referer` longtext COLLATE utf8_unicode_ci,
  `tracking_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A6494C8F5DA1941` (`asset_id`),
  KEY `IDX_A6494C8FA03F5E9F` (`ip_id`),
  KEY `IDX_A6494C8F55458D` (`lead_id`),
  KEY `IDX_A6494C8FA832C1C9` (`email_id`),
  KEY `download_tracking_search` (`tracking_id`),
  KEY `download_source_search` (`source`,`source_id`),
  KEY `asset_date_download` (`date_download`),
  CONSTRAINT `FK_A6494C8F55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_A6494C8F5DA1941` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A6494C8FA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_A6494C8FA832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `asset_downloads`
--

LOCK TABLES `asset_downloads` WRITE;
/*!40000 ALTER TABLE `asset_downloads` DISABLE KEYS */;
/*!40000 ALTER TABLE `asset_downloads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `storage_location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `original_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `download_count` int(11) NOT NULL,
  `unique_download_count` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `extension` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_79D17D8E12469DE2` (`category_id`),
  KEY `asset_alias_search` (`alias`),
  CONSTRAINT `FK_79D17D8E12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,NULL,1,'2017-12-15 05:38:03',2,'Prabhu Leads Engage','2017-12-15 05:38:08',2,'Prabhu Leads Engage',NULL,NULL,'Prabhu Leads Engage','Test',NULL,'test','remote',NULL,'http://www.cratiocrm.com/','www.cratiocrm.com','en',NULL,NULL,0,0,2,'','text/html; charset=UTF-8',-1);
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `audit_log`
--

DROP TABLE IF EXISTS `audit_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `audit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bundle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `object` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `object_id` int(11) NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `date_added` datetime NOT NULL,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `object_search` (`object`,`object_id`),
  KEY `timeline_search` (`bundle`,`object`,`action`,`object_id`),
  KEY `date_added_index` (`date_added`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `audit_log`
--

LOCK TABLES `audit_log` WRITE;
/*!40000 ALTER TABLE `audit_log` DISABLE KEYS */;
INSERT INTO `audit_log` VALUES (1,1,'Sadmin LeadsEngage','user','role',2,'create','a:3:{s:4:\"name\";a:2:{i:0;N;i:1;s:6:\"Custom\";}s:7:\"isAdmin\";a:2:{i:0;b:0;i:1;i:0;}s:14:\"rawPermissions\";a:2:{i:0;N;i:1;a:28:{s:16:\"asset:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"asset:assets\";a:1:{i:0;s:4:\"full\";}s:19:\"campaign:categories\";a:1:{i:0;s:4:\"full\";}s:18:\"campaign:campaigns\";a:1:{i:0;s:4:\"full\";}s:19:\"category:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:leads\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:lists\";a:1:{i:0;s:4:\"full\";}s:11:\"lead:fields\";a:1:{i:0;s:4:\"full\";}s:12:\"lead:imports\";a:1:{i:0;s:4:\"full\";}s:11:\"core:themes\";a:1:{i:0;s:4:\"full\";}s:25:\"dynamiccontent:categories\";a:1:{i:0;s:4:\"full\";}s:30:\"dynamiccontent:dynamiccontents\";a:1:{i:0;s:4:\"full\";}s:16:\"email:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"email:emails\";a:1:{i:0;s:4:\"full\";}s:16:\"focus:categories\";a:1:{i:0;s:4:\"full\";}s:11:\"focus:items\";a:1:{i:0;s:4:\"full\";}s:15:\"form:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"form:forms\";a:1:{i:0;s:4:\"full\";}s:15:\"page:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"page:pages\";a:1:{i:0;s:4:\"full\";}s:22:\"page:preference_center\";a:1:{i:0;s:4:\"full\";}s:16:\"point:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"point:points\";a:1:{i:0;s:4:\"full\";}s:14:\"point:triggers\";a:1:{i:0;s:4:\"full\";}s:14:\"report:reports\";a:1:{i:0;s:4:\"full\";}s:14:\"sms:categories\";a:1:{i:0;s:4:\"full\";}s:9:\"sms:smses\";a:1:{i:0;s:4:\"full\";}s:10:\"user:users\";a:1:{i:0;s:4:\"full\";}}}}','2017-12-09 12:00:35','127.0.0.1'),(2,1,'Sadmin LeadsEngage','user','user',2,'create','a:10:{s:8:\"username\";a:2:{i:0;N;i:1;s:22:\"prabhu@leadsengage.com\";}s:9:\"firstName\";a:2:{i:0;N;i:1;s:6:\"Prabhu\";}s:8:\"lastName\";a:2:{i:0;N;i:1;s:12:\"Leads Engage\";}s:8:\"position\";a:2:{i:0;N;i:1;s:1:\"2\";}s:5:\"email\";a:2:{i:0;N;i:1;s:22:\"prabhu@leadsengage.com\";}s:8:\"timezone\";a:2:{i:0;s:0:\"\";i:1;s:12:\"Asia/Kolkata\";}s:6:\"locale\";a:2:{i:0;s:0:\"\";i:1;s:5:\"en_US\";}s:9:\"signature\";a:2:{i:0;N;i:1;s:25:\"Best regards, |FROM_NAME|\";}s:4:\"role\";a:2:{i:0;N;i:1;s:10:\"Custom (2)\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}}','2017-12-09 12:01:51','127.0.0.1'),(3,0,'System','lead','lead',1,'create','a:1:{s:11:\"ipAddresses\";a:2:{i:0;s:0:\"\";i:1;s:9:\"127.0.0.1\";}}','2017-12-11 07:33:40','127.0.0.1'),(4,0,'System','lead','lead',1,'ipadded','a:2:{i:0;s:0:\"\";i:1;s:9:\"127.0.0.1\";}','2017-12-11 07:33:40','127.0.0.1'),(5,2,'Prabhu Leads Engage','lead','lead',2,'create','a:7:{s:5:\"owner\";a:2:{i:0;N;i:1;i:2;}s:9:\"firstname\";a:2:{i:0;N;i:1;s:6:\"Prabhu\";}s:6:\"fields\";a:3:{s:9:\"firstname\";a:2:{i:0;N;i:1;s:6:\"Prabhu\";}s:8:\"lastname\";a:2:{i:0;N;i:1;s:1:\"S\";}s:8:\"address1\";a:2:{i:0;N;i:1;s:7:\"Chennai\";}}s:8:\"lastname\";a:2:{i:0;N;i:1;s:1:\"S\";}s:6:\"points\";a:2:{i:0;i:0;i:1;s:0:\"\";}s:8:\"address1\";a:2:{i:0;N;i:1;s:7:\"Chennai\";}s:14:\"dateIdentified\";a:2:{i:0;s:0:\"\";i:1;O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2017-12-12 15:04:13.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:12:\"Asia/Kolkata\";}}}','2017-12-12 09:34:13','127.0.0.1'),(6,2,'Prabhu Leads Engage','lead','lead',2,'identified','a:0:{}','2017-12-12 09:34:13','127.0.0.1'),(7,1,'Sadmin LeadsEngage','user','role',2,'update','a:3:{s:7:\"isAdmin\";a:2:{i:0;b:0;i:1;i:0;}s:14:\"rawPermissions\";a:2:{i:0;a:28:{s:16:\"asset:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"asset:assets\";a:1:{i:0;s:4:\"full\";}s:19:\"campaign:categories\";a:1:{i:0;s:4:\"full\";}s:18:\"campaign:campaigns\";a:1:{i:0;s:4:\"full\";}s:19:\"category:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:leads\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:lists\";a:1:{i:0;s:4:\"full\";}s:11:\"lead:fields\";a:1:{i:0;s:4:\"full\";}s:12:\"lead:imports\";a:1:{i:0;s:4:\"full\";}s:11:\"core:themes\";a:1:{i:0;s:4:\"full\";}s:25:\"dynamiccontent:categories\";a:1:{i:0;s:4:\"full\";}s:30:\"dynamiccontent:dynamiccontents\";a:1:{i:0;s:4:\"full\";}s:16:\"email:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"email:emails\";a:1:{i:0;s:4:\"full\";}s:16:\"focus:categories\";a:1:{i:0;s:4:\"full\";}s:11:\"focus:items\";a:1:{i:0;s:4:\"full\";}s:15:\"form:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"form:forms\";a:1:{i:0;s:4:\"full\";}s:15:\"page:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"page:pages\";a:1:{i:0;s:4:\"full\";}s:22:\"page:preference_center\";a:1:{i:0;s:4:\"full\";}s:16:\"point:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"point:points\";a:1:{i:0;s:4:\"full\";}s:14:\"point:triggers\";a:1:{i:0;s:4:\"full\";}s:14:\"report:reports\";a:1:{i:0;s:4:\"full\";}s:14:\"sms:categories\";a:1:{i:0;s:4:\"full\";}s:9:\"sms:smses\";a:1:{i:0;s:4:\"full\";}s:10:\"user:users\";a:1:{i:0;s:4:\"full\";}}i:1;a:26:{s:16:\"asset:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"asset:assets\";a:1:{i:0;s:4:\"full\";}s:19:\"campaign:categories\";a:1:{i:0;s:4:\"full\";}s:18:\"campaign:campaigns\";a:1:{i:0;s:4:\"full\";}s:19:\"category:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:leads\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:lists\";a:1:{i:0;s:4:\"full\";}s:11:\"lead:fields\";a:1:{i:0;s:4:\"full\";}s:12:\"lead:imports\";a:1:{i:0;s:4:\"full\";}s:11:\"core:themes\";a:1:{i:0;s:4:\"full\";}s:16:\"email:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"email:emails\";a:1:{i:0;s:4:\"full\";}s:16:\"focus:categories\";a:1:{i:0;s:4:\"full\";}s:11:\"focus:items\";a:1:{i:0;s:4:\"full\";}s:15:\"form:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"form:forms\";a:1:{i:0;s:4:\"full\";}s:15:\"page:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"page:pages\";a:1:{i:0;s:4:\"full\";}s:22:\"page:preference_center\";a:1:{i:0;s:4:\"full\";}s:16:\"point:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"point:points\";a:1:{i:0;s:4:\"full\";}s:14:\"point:triggers\";a:1:{i:0;s:4:\"full\";}s:14:\"report:reports\";a:1:{i:0;s:4:\"full\";}s:14:\"sms:categories\";a:1:{i:0;s:4:\"full\";}s:9:\"sms:smses\";a:1:{i:0;s:4:\"full\";}s:10:\"user:users\";a:1:{i:0;s:4:\"full\";}}}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-12T12:18:06+00:00\";}}','2017-12-12 12:18:06','127.0.0.1'),(8,2,'Prabhu Leads Engage','lead','lead',2,'delete','a:1:{s:4:\"name\";s:8:\"Prabhu S\";}','2017-12-13 10:03:51','127.0.0.1'),(9,2,'Prabhu Leads Engage','lead','lead',4,'create','a:5:{s:5:\"owner\";a:2:{i:0;N;i:1;i:2;}s:9:\"firstname\";a:2:{i:0;N;i:1;s:6:\"Suresh\";}s:6:\"fields\";a:1:{s:9:\"firstname\";a:2:{i:0;N;i:1;s:6:\"Suresh\";}}s:6:\"points\";a:2:{i:0;i:0;i:1;s:0:\"\";}s:14:\"dateIdentified\";a:2:{i:0;s:0:\"\";i:1;O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2017-12-14 11:07:27.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:12:\"Asia/Kolkata\";}}}','2017-12-14 05:37:27','127.0.0.1'),(10,2,'Prabhu Leads Engage','lead','lead',4,'identified','a:0:{}','2017-12-14 05:37:27','127.0.0.1'),(11,1,'Sadmin LeadsEngage','report','report',1,'update','a:10:{s:7:\"columns\";a:2:{i:0;a:0:{}i:1;a:7:{i:0;s:11:\"ph.date_hit\";i:1;s:6:\"ph.url\";i:2;s:12:\"ph.url_title\";i:3;s:10:\"ph.referer\";i:4;s:12:\"i.ip_address\";i:5;s:7:\"ph.city\";i:6;s:10:\"ph.country\";}}s:6:\"graphs\";a:2:{i:0;a:0:{}i:1;a:8:{i:0;s:35:\"mautic.page.graph.line.time.on.site\";i:1;s:27:\"mautic.page.graph.line.hits\";i:2;s:38:\"mautic.page.graph.pie.new.vs.returning\";i:3;s:31:\"mautic.page.graph.pie.languages\";i:4;s:34:\"mautic.page.graph.pie.time.on.site\";i:5;s:27:\"mautic.page.table.referrers\";i:6;s:30:\"mautic.page.table.most.visited\";i:7;s:37:\"mautic.page.table.most.visited.unique\";}}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:6:\"system\";a:2:{i:0;b:1;i:1;i:1;}s:8:\"settings\";a:2:{i:0;a:0:{}i:1;a:3:{s:20:\"showGraphsAboveTable\";i:0;s:18:\"showDynamicFilters\";i:0;s:19:\"hideDateRangeFilter\";i:0;}}s:11:\"isScheduled\";a:2:{i:0;i:0;i:1;b:0;}s:12:\"scheduleUnit\";a:2:{i:0;s:5:\"DAILY\";i:1;N;}s:11:\"scheduleDay\";a:2:{i:0;s:2:\"MO\";i:1;N;}s:7:\"filters\";a:2:{i:0;a:2:{i:0;a:3:{s:6:\"column\";s:7:\"ph.code\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:3:\"200\";}i:1;a:3:{s:6:\"column\";s:14:\"p.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";}}i:1;a:2:{i:0;a:5:{s:6:\"column\";s:7:\"ph.code\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:3:\"200\";s:4:\"glue\";s:3:\"and\";s:7:\"dynamic\";i:1;}i:1;a:5:{s:6:\"column\";s:14:\"p.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";s:4:\"glue\";s:3:\"and\";s:7:\"dynamic\";N;}}}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T11:36:27+00:00\";}}','2017-12-14 11:36:27','127.0.0.1'),(12,1,'Sadmin LeadsEngage','report','report',1,'update','a:8:{s:7:\"columns\";a:2:{i:0;a:0:{}i:1;a:7:{i:0;s:11:\"ph.date_hit\";i:1;s:6:\"ph.url\";i:2;s:12:\"ph.url_title\";i:3;s:10:\"ph.referer\";i:4;s:12:\"i.ip_address\";i:5;s:7:\"ph.city\";i:6;s:10:\"ph.country\";}}s:6:\"graphs\";a:2:{i:0;a:0:{}i:1;a:8:{i:0;s:35:\"mautic.page.graph.line.time.on.site\";i:1;s:27:\"mautic.page.graph.line.hits\";i:2;s:38:\"mautic.page.graph.pie.new.vs.returning\";i:3;s:31:\"mautic.page.graph.pie.languages\";i:4;s:34:\"mautic.page.graph.pie.time.on.site\";i:5;s:27:\"mautic.page.table.referrers\";i:6;s:30:\"mautic.page.table.most.visited\";i:7;s:37:\"mautic.page.table.most.visited.unique\";}}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:6:\"system\";a:2:{i:0;b:1;i:1;i:1;}s:11:\"isScheduled\";a:2:{i:0;i:0;i:1;b:0;}s:12:\"scheduleUnit\";a:2:{i:0;s:5:\"DAILY\";i:1;N;}s:11:\"scheduleDay\";a:2:{i:0;s:2:\"MO\";i:1;N;}s:12:\"dateModified\";a:2:{i:0;s:25:\"2017-12-14T11:36:27+00:00\";i:1;s:25:\"2017-12-14T11:36:30+00:00\";}}','2017-12-14 11:36:30','127.0.0.1'),(13,1,'Sadmin LeadsEngage','lead','field',4,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:15:40+00:00\";}}','2017-12-14 12:15:41','127.0.0.1'),(14,1,'Sadmin LeadsEngage','lead','field',28,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:15:43+00:00\";}}','2017-12-14 12:15:43','127.0.0.1'),(15,1,'Sadmin LeadsEngage','lead','field',5,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:15:53+00:00\";}}','2017-12-14 12:15:54','127.0.0.1'),(16,1,'Sadmin LeadsEngage','lead','field',18,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:17:05+00:00\";}}','2017-12-14 12:17:05','127.0.0.1'),(17,1,'Sadmin LeadsEngage','lead','field',19,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:17:06+00:00\";}}','2017-12-14 12:17:06','127.0.0.1'),(18,1,'Sadmin LeadsEngage','lead','field',17,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:17:23+00:00\";}}','2017-12-14 12:17:23','127.0.0.1'),(19,1,'Sadmin LeadsEngage','lead','field',20,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:17:30+00:00\";}}','2017-12-14 12:17:30','127.0.0.1'),(20,1,'Sadmin LeadsEngage','lead','field',10,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:18:06+00:00\";}}','2017-12-14 12:18:06','127.0.0.1'),(21,1,'Sadmin LeadsEngage','lead','field',8,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:18:53+00:00\";}}','2017-12-14 12:18:53','127.0.0.1'),(22,1,'Sadmin LeadsEngage','lead','field',34,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:12+00:00\";}}','2017-12-14 12:19:12','127.0.0.1'),(23,1,'Sadmin LeadsEngage','lead','field',33,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:13+00:00\";}}','2017-12-14 12:19:13','127.0.0.1'),(24,1,'Sadmin LeadsEngage','lead','field',29,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:19+00:00\";}}','2017-12-14 12:19:19','127.0.0.1'),(25,1,'Sadmin LeadsEngage','lead','field',30,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:20+00:00\";}}','2017-12-14 12:19:20','127.0.0.1'),(26,1,'Sadmin LeadsEngage','lead','field',31,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:21+00:00\";}}','2017-12-14 12:19:21','127.0.0.1'),(27,1,'Sadmin LeadsEngage','lead','field',32,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:22+00:00\";}}','2017-12-14 12:19:22','127.0.0.1'),(28,1,'Sadmin LeadsEngage','lead','field',35,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:28+00:00\";}}','2017-12-14 12:19:28','127.0.0.1'),(29,1,'Sadmin LeadsEngage','lead','field',36,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:30+00:00\";}}','2017-12-14 12:19:30','127.0.0.1'),(30,1,'Sadmin LeadsEngage','lead','field',37,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:36+00:00\";}}','2017-12-14 12:19:36','127.0.0.1'),(31,1,'Sadmin LeadsEngage','lead','field',38,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:41+00:00\";}}','2017-12-14 12:19:41','127.0.0.1'),(32,1,'Sadmin LeadsEngage','lead','field',39,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:42+00:00\";}}','2017-12-14 12:19:42','127.0.0.1'),(33,1,'Sadmin LeadsEngage','lead','field',40,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:44+00:00\";}}','2017-12-14 12:19:44','127.0.0.1'),(34,1,'Sadmin LeadsEngage','lead','field',41,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:46+00:00\";}}','2017-12-14 12:19:46','127.0.0.1'),(35,1,'Sadmin LeadsEngage','lead','field',42,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:19:49+00:00\";}}','2017-12-14 12:19:49','127.0.0.1'),(36,1,'Sadmin LeadsEngage','lead','field',21,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:31+00:00\";}}','2017-12-14 12:22:31','127.0.0.1'),(37,1,'Sadmin LeadsEngage','lead','field',22,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:32+00:00\";}}','2017-12-14 12:22:32','127.0.0.1'),(38,1,'Sadmin LeadsEngage','lead','field',23,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:33+00:00\";}}','2017-12-14 12:22:33','127.0.0.1'),(39,1,'Sadmin LeadsEngage','lead','field',24,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:34+00:00\";}}','2017-12-14 12:22:34','127.0.0.1'),(40,1,'Sadmin LeadsEngage','lead','field',25,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:35+00:00\";}}','2017-12-14 12:22:35','127.0.0.1'),(41,1,'Sadmin LeadsEngage','lead','field',26,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:36+00:00\";}}','2017-12-14 12:22:36','127.0.0.1'),(42,1,'Sadmin LeadsEngage','lead','field',27,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;b:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T12:22:37+00:00\";}}','2017-12-14 12:22:37','127.0.0.1'),(43,2,'Prabhu Leads Engage','user','user',2,'update','a:3:{s:8:\"position\";a:2:{i:0;s:1:\"2\";i:1;s:18:\"Software Developer\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-14T17:55:35+05:30\";}}','2017-12-14 12:25:35','127.0.0.1'),(44,2,'Prabhu Leads Engage','asset','asset',1,'create','a:6:{s:15:\"storageLocation\";a:2:{i:0;s:5:\"local\";i:1;s:6:\"remote\";}s:10:\"remotePath\";a:2:{i:0;N;i:1;s:25:\"http://www.cratiocrm.com/\";}s:5:\"title\";a:2:{i:0;N;i:1;s:4:\"Test\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:16:\"originalFileName\";a:2:{i:0;N;i:1;s:17:\"www.cratiocrm.com\";}s:5:\"alias\";a:2:{i:0;N;i:1;s:4:\"test\";}}','2017-12-15 05:38:03','127.0.0.1'),(45,2,'Prabhu Leads Engage','asset','asset',1,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-15T11:08:08+05:30\";}}','2017-12-15 05:38:08','127.0.0.1'),(46,2,'Prabhu Leads Engage','form','form',1,'update','a:7:{s:4:\"name\";a:2:{i:0;N;i:1;s:4:\"Test\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:10:\"postAction\";a:2:{i:0;s:6:\"return\";i:1;s:7:\"message\";}s:18:\"postActionProperty\";a:2:{i:0;N;i:1;s:9:\"Thank you\";}s:6:\"fields\";a:2:{s:43:\"newd8ff5c45f1338764ee1cdb5f10883cbaa9b01d01\";a:7:{s:5:\"label\";a:2:{i:0;N;i:1;s:5:\"Email\";}s:10:\"properties\";a:2:{i:0;a:0:{}i:1;a:1:{s:11:\"placeholder\";N;}}s:10:\"isRequired\";a:2:{i:0;b:0;i:1;i:1;}s:5:\"alias\";a:2:{i:0;N;i:1;s:5:\"email\";}s:15:\"labelAttributes\";a:2:{i:0;N;i:1;s:19:\"Your business email\";}s:4:\"type\";a:2:{i:0;N;i:1;s:5:\"email\";}s:5:\"order\";a:2:{i:0;i:0;i:1;i:1;}}s:43:\"newacc0195e88be5e31cff40499c832f5005eebafb8\";a:5:{s:5:\"label\";a:2:{i:0;N;i:1;s:12:\"Download Now\";}s:5:\"alias\";a:2:{i:0;N;i:1;s:12:\"download_now\";}s:4:\"type\";a:2:{i:0;N;i:1;s:6:\"button\";}s:15:\"inputAttributes\";a:2:{i:0;N;i:1;s:23:\"class=\"btn btn-default\"\";}s:5:\"order\";a:2:{i:0;i:0;i:1;i:2;}}}s:5:\"alias\";a:2:{i:0;N;i:1;s:4:\"test\";}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-15T11:12:37+05:30\";}}','2017-12-15 05:42:37','127.0.0.1'),(47,2,'Prabhu Leads Engage','form','form',1,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:12:\"dateModified\";a:2:{i:0;s:25:\"2017-12-15T11:12:37+05:30\";i:1;s:25:\"2017-12-15T11:12:39+05:30\";}}','2017-12-15 05:42:39','127.0.0.1'),(48,2,'Prabhu Leads Engage','page','page',1,'create','a:5:{s:5:\"title\";a:2:{i:0;N;i:1;s:6:\"Test 1\";}s:8:\"template\";a:2:{i:0;N;i:1;s:10:\"fresh-left\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:18:\"isPreferenceCenter\";a:2:{i:0;N;i:1;i:0;}s:5:\"alias\";a:2:{i:0;N;i:1;s:6:\"test-1\";}}','2017-12-15 05:51:13','127.0.0.1'),(49,2,'Prabhu Leads Engage','page','page',1,'update','a:3:{s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:18:\"isPreferenceCenter\";a:2:{i:0;b:0;i:1;i:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-15T11:21:31+05:30\";}}','2017-12-15 05:51:31','127.0.0.1'),(50,1,'Sadmin LeadsEngage','lead','lead',4,'update','a:2:{s:5:\"email\";a:2:{i:0;s:0:\"\";i:1;s:17:\"suresh@cratio.com\";}s:6:\"fields\";a:1:{s:5:\"email\";a:2:{i:0;s:0:\"\";i:1;s:17:\"suresh@cratio.com\";}}}','2017-12-15 05:54:55','127.0.0.1'),(51,1,'Sadmin LeadsEngage','lead','lead',5,'create','a:6:{s:5:\"owner\";a:2:{i:0;N;i:1;i:1;}s:8:\"lastname\";a:2:{i:0;N;i:1;s:8:\"Shamalan\";}s:6:\"fields\";a:2:{s:8:\"lastname\";a:2:{i:0;N;i:1;s:8:\"Shamalan\";}s:5:\"email\";a:2:{i:0;N;i:1;s:17:\"suresh@cratio.com\";}}s:5:\"email\";a:2:{i:0;N;i:1;s:17:\"suresh@cratio.com\";}s:6:\"points\";a:2:{i:0;i:0;i:1;s:0:\"\";}s:14:\"dateIdentified\";a:2:{i:0;s:0:\"\";i:1;O:8:\"DateTime\":3:{s:4:\"date\";s:26:\"2017-12-15 05:55:34.000000\";s:13:\"timezone_type\";i:3;s:8:\"timezone\";s:3:\"UTC\";}}}','2017-12-15 05:55:34','127.0.0.1'),(52,1,'Sadmin LeadsEngage','lead','lead',5,'identified','a:0:{}','2017-12-15 05:55:34','127.0.0.1'),(53,1,'Sadmin LeadsEngage','lead','lead',5,'update','a:2:{s:9:\"firstname\";a:2:{i:0;s:0:\"\";i:1;s:6:\"Suresh\";}s:6:\"fields\";a:1:{s:9:\"firstname\";a:2:{i:0;s:0:\"\";i:1;s:6:\"Suresh\";}}}','2017-12-15 05:56:49','127.0.0.1'),(54,1,'Sadmin LeadsEngage','lead','lead',4,'merge','a:1:{s:11:\"merged_into\";i:5;}','2017-12-15 05:56:49','127.0.0.1'),(55,1,'Sadmin LeadsEngage','lead','lead',4,'delete','a:1:{s:4:\"name\";s:6:\"Suresh\";}','2017-12-15 05:56:50','127.0.0.1'),(56,1,'Sadmin LeadsEngage','email','email',1,'create','a:4:{s:7:\"subject\";a:2:{i:0;N;i:1;s:10:\"Test Email\";}s:7:\"utmTags\";a:2:{i:0;a:0:{}i:1;a:4:{s:9:\"utmSource\";N;s:9:\"utmMedium\";N;s:11:\"utmCampaign\";N;s:10:\"utmContent\";N;}}s:8:\"template\";a:2:{i:0;N;i:1;s:5:\"blank\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}}','2017-12-15 06:16:21','127.0.0.1'),(57,1,'Sadmin LeadsEngage','campaign','campaign',1,'create','a:4:{s:4:\"name\";a:2:{i:0;N;i:1;s:4:\"Test\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:0;}s:5:\"lists\";a:1:{s:5:\"added\";a:1:{i:1;s:4:\"Test\";}}s:6:\"events\";a:1:{s:5:\"added\";a:1:{s:43:\"newb1b05d101b2f0a7f8eec516324cb8debc1503bfd\";a:2:{i:0;s:43:\"newb1b05d101b2f0a7f8eec516324cb8debc1503bfd\";i:1;a:5:{s:4:\"name\";a:2:{i:0;N;i:1;s:10:\"Send email\";}s:15:\"triggerInterval\";a:2:{i:0;i:0;i:1;d:1;}s:19:\"triggerIntervalUnit\";a:2:{i:0;N;i:1;s:1:\"d\";}s:10:\"properties\";a:2:{i:0;a:0:{}i:1;a:18:{s:14:\"canvasSettings\";a:2:{s:8:\"droppedX\";s:3:\"483\";s:8:\"droppedY\";s:3:\"155\";}s:4:\"name\";s:0:\"\";s:11:\"triggerMode\";s:9:\"immediate\";s:11:\"triggerDate\";N;s:15:\"triggerInterval\";s:1:\"1\";s:19:\"triggerIntervalUnit\";s:1:\"d\";s:6:\"anchor\";s:10:\"leadsource\";s:10:\"properties\";a:4:{s:5:\"email\";s:1:\"1\";s:10:\"email_type\";s:13:\"transactional\";s:8:\"priority\";s:1:\"2\";s:8:\"attempts\";s:1:\"3\";}s:4:\"type\";s:10:\"email.send\";s:9:\"eventType\";s:6:\"action\";s:15:\"anchorEventType\";s:6:\"source\";s:10:\"campaignId\";s:47:\"mautic_cd13e998965e85717bcee62c6b1dc4f9dcf141b9\";s:6:\"_token\";s:43:\"XqxRdbSee2cwXfGX6YqEabEXnT0Icoja6Uaam87B_go\";s:7:\"buttons\";a:1:{s:4:\"save\";s:0:\"\";}s:5:\"email\";s:1:\"1\";s:10:\"email_type\";s:13:\"transactional\";s:8:\"priority\";i:2;s:8:\"attempts\";d:3;}}s:4:\"type\";a:2:{i:0;N;i:1;s:10:\"email.send\";}}}}}}','2017-12-15 06:17:48','127.0.0.1'),(58,2,'Prabhu Leads Engage','page','page',2,'create','a:5:{s:5:\"title\";a:2:{i:0;N;i:1;s:4:\"Test\";}s:8:\"template\";a:2:{i:0;N;i:1;s:10:\"fresh-left\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:1;}s:18:\"isPreferenceCenter\";a:2:{i:0;N;i:1;i:0;}s:5:\"alias\";a:2:{i:0;N;i:1;s:4:\"test\";}}','2017-12-15 06:20:22','127.0.0.1'),(59,2,'Prabhu Leads Engage','focus','focus',1,'create','a:9:{s:4:\"name\";a:2:{i:0;N;i:1;s:4:\"Test\";}s:7:\"utmTags\";a:2:{i:0;a:0:{}i:1;a:4:{s:9:\"utmSource\";N;s:9:\"utmMedium\";N;s:11:\"utmCampaign\";N;s:10:\"utmContent\";N;}}s:8:\"htmlMode\";a:2:{i:0;N;i:1;s:5:\"basic\";}s:7:\"website\";a:2:{i:0;N;i:1;s:25:\"http://www.cratiocrm.com/\";}s:11:\"isPublished\";a:2:{i:0;b:1;i:1;i:0;}s:10:\"properties\";a:2:{i:0;a:0:{}i:1;a:12:{s:3:\"bar\";a:5:{s:10:\"allow_hide\";i:1;s:9:\"push_page\";i:1;s:6:\"sticky\";i:1;s:4:\"size\";s:5:\"large\";s:9:\"placement\";s:3:\"top\";}s:5:\"modal\";a:1:{s:9:\"placement\";s:6:\"middle\";}s:12:\"notification\";a:1:{s:9:\"placement\";s:8:\"top_left\";}s:4:\"page\";a:0:{}s:7:\"animate\";i:1;s:15:\"link_activation\";i:1;s:6:\"colors\";a:4:{s:7:\"primary\";s:6:\"f2ef96\";s:4:\"text\";s:6:\"1c1a1a\";s:6:\"button\";s:6:\"150f96\";s:11:\"button_text\";s:6:\"fffcfc\";}s:7:\"content\";a:6:{s:8:\"headline\";s:24:\"Looking for CRM Software\";s:7:\"tagline\";s:27:\"Try our Cratio Software Now\";s:9:\"link_text\";N;s:8:\"link_url\";N;s:15:\"link_new_window\";i:1;s:4:\"font\";s:28:\"Arial, Helvetica, sans-serif\";}s:4:\"when\";s:13:\"scroll_slight\";s:7:\"timeout\";s:2:\"45\";s:9:\"frequency\";s:4:\"once\";s:21:\"stop_after_conversion\";i:1;}}s:4:\"type\";a:2:{i:0;N;i:1;s:4:\"form\";}s:5:\"style\";a:2:{i:0;N;i:1;s:4:\"page\";}s:4:\"form\";a:2:{i:0;N;i:1;i:1;}}','2017-12-15 06:26:10','127.0.0.1'),(60,2,'Prabhu Leads Engage','focus','focus',1,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:0;i:1;i:0;}s:12:\"dateModified\";a:2:{i:0;N;i:1;s:25:\"2017-12-15T11:56:15+05:30\";}}','2017-12-15 06:26:15','127.0.0.1'),(61,2,'Prabhu Leads Engage','focus','focus',1,'update','a:3:{s:7:\"utmTags\";a:2:{i:0;a:4:{s:9:\"utmSource\";N;s:9:\"utmMedium\";N;s:11:\"utmCampaign\";N;s:10:\"utmContent\";N;}i:1;a:4:{s:9:\"utmSource\";s:12:\"Website Camp\";s:9:\"utmMedium\";s:7:\"Adwords\";s:11:\"utmCampaign\";s:5:\"Test1\";s:10:\"utmContent\";s:5:\"Test1\";}}s:11:\"isPublished\";a:2:{i:0;b:0;i:1;i:0;}s:12:\"dateModified\";a:2:{i:0;s:25:\"2017-12-15T11:56:15+05:30\";i:1;s:25:\"2017-12-15T11:59:26+05:30\";}}','2017-12-15 06:29:26','127.0.0.1'),(62,2,'Prabhu Leads Engage','focus','focus',1,'update','a:2:{s:11:\"isPublished\";a:2:{i:0;b:0;i:1;i:0;}s:12:\"dateModified\";a:2:{i:0;s:25:\"2017-12-15T11:59:26+05:30\";i:1;s:25:\"2017-12-15T11:59:29+05:30\";}}','2017-12-15 06:29:29','127.0.0.1');
/*!40000 ALTER TABLE `audit_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_items`
--

DROP TABLE IF EXISTS `cache_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_items` (
  `item_id` varbinary(255) NOT NULL,
  `item_data` longblob NOT NULL,
  `item_lifetime` int(10) unsigned DEFAULT NULL,
  `item_time` int(10) unsigned NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_items`
--

LOCK TABLES `cache_items` WRITE;
/*!40000 ALTER TABLE `cache_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_events`
--

DROP TABLE IF EXISTS `campaign_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_order` int(11) NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `trigger_date` datetime DEFAULT NULL,
  `trigger_interval` int(11) DEFAULT NULL,
  `trigger_interval_unit` varchar(1) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trigger_mode` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `decision_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `temp_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8EC42EE7F639F774` (`campaign_id`),
  KEY `IDX_8EC42EE7727ACA70` (`parent_id`),
  KEY `campaign_event_search` (`type`,`event_type`),
  KEY `campaign_event_type` (`event_type`),
  KEY `campaign_event_channel` (`channel`,`channel_id`),
  CONSTRAINT `FK_8EC42EE7727ACA70` FOREIGN KEY (`parent_id`) REFERENCES `campaign_events` (`id`),
  CONSTRAINT `FK_8EC42EE7F639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_events`
--

LOCK TABLES `campaign_events` WRITE;
/*!40000 ALTER TABLE `campaign_events` DISABLE KEYS */;
INSERT INTO `campaign_events` VALUES (1,1,NULL,'Send email',NULL,'email.send','action',0,'a:18:{s:14:\"canvasSettings\";a:2:{s:8:\"droppedX\";s:3:\"483\";s:8:\"droppedY\";s:3:\"155\";}s:4:\"name\";s:0:\"\";s:11:\"triggerMode\";s:9:\"immediate\";s:11:\"triggerDate\";N;s:15:\"triggerInterval\";s:1:\"1\";s:19:\"triggerIntervalUnit\";s:1:\"d\";s:6:\"anchor\";s:10:\"leadsource\";s:10:\"properties\";a:4:{s:5:\"email\";s:1:\"1\";s:10:\"email_type\";s:13:\"transactional\";s:8:\"priority\";s:1:\"2\";s:8:\"attempts\";s:1:\"3\";}s:4:\"type\";s:10:\"email.send\";s:9:\"eventType\";s:6:\"action\";s:15:\"anchorEventType\";s:6:\"source\";s:10:\"campaignId\";s:47:\"mautic_cd13e998965e85717bcee62c6b1dc4f9dcf141b9\";s:6:\"_token\";s:43:\"XqxRdbSee2cwXfGX6YqEabEXnT0Icoja6Uaam87B_go\";s:7:\"buttons\";a:1:{s:4:\"save\";s:0:\"\";}s:5:\"email\";s:1:\"1\";s:10:\"email_type\";s:13:\"transactional\";s:8:\"priority\";i:2;s:8:\"attempts\";d:3;}',NULL,1,'d','immediate',NULL,'newb1b05d101b2f0a7f8eec516324cb8debc1503bfd','email',1);
/*!40000 ALTER TABLE `campaign_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_form_xref`
--

DROP TABLE IF EXISTS `campaign_form_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_form_xref` (
  `campaign_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  PRIMARY KEY (`campaign_id`,`form_id`),
  KEY `IDX_3048A8B2F639F774` (`campaign_id`),
  KEY `IDX_3048A8B25FF69B7D` (`form_id`),
  CONSTRAINT `FK_3048A8B25FF69B7D` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3048A8B2F639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_form_xref`
--

LOCK TABLES `campaign_form_xref` WRITE;
/*!40000 ALTER TABLE `campaign_form_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_form_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_lead_event_failed_log`
--

DROP TABLE IF EXISTS `campaign_lead_event_failed_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_lead_event_failed_log` (
  `log_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `reason` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`log_id`),
  KEY `campaign_event_failed_date` (`date_added`),
  CONSTRAINT `FK_E50614D2EA675D86` FOREIGN KEY (`log_id`) REFERENCES `campaign_lead_event_log` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_lead_event_failed_log`
--

LOCK TABLES `campaign_lead_event_failed_log` WRITE;
/*!40000 ALTER TABLE `campaign_lead_event_failed_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_lead_event_failed_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_lead_event_log`
--

DROP TABLE IF EXISTS `campaign_lead_event_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_lead_event_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `campaign_id` int(11) DEFAULT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `rotation` int(11) NOT NULL,
  `date_triggered` datetime DEFAULT NULL,
  `is_scheduled` tinyint(1) NOT NULL,
  `trigger_date` datetime DEFAULT NULL,
  `system_triggered` tinyint(1) NOT NULL,
  `metadata` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `non_action_path_taken` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `campaign_rotation` (`event_id`,`lead_id`,`rotation`),
  KEY `IDX_B7420BA171F7E88B` (`event_id`),
  KEY `IDX_B7420BA155458D` (`lead_id`),
  KEY `IDX_B7420BA1F639F774` (`campaign_id`),
  KEY `IDX_B7420BA1A03F5E9F` (`ip_id`),
  KEY `campaign_event_upcoming_search` (`is_scheduled`,`lead_id`),
  KEY `campaign_date_triggered` (`date_triggered`),
  KEY `campaign_leads` (`lead_id`,`campaign_id`,`rotation`),
  KEY `campaign_log_channel` (`channel`,`channel_id`,`lead_id`),
  CONSTRAINT `FK_B7420BA155458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B7420BA171F7E88B` FOREIGN KEY (`event_id`) REFERENCES `campaign_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B7420BA1A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_B7420BA1F639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_lead_event_log`
--

LOCK TABLES `campaign_lead_event_log` WRITE;
/*!40000 ALTER TABLE `campaign_lead_event_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_lead_event_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_leadlist_xref`
--

DROP TABLE IF EXISTS `campaign_leadlist_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_leadlist_xref` (
  `campaign_id` int(11) NOT NULL,
  `leadlist_id` int(11) NOT NULL,
  PRIMARY KEY (`campaign_id`,`leadlist_id`),
  KEY `IDX_6480052EF639F774` (`campaign_id`),
  KEY `IDX_6480052EB9FC8874` (`leadlist_id`),
  CONSTRAINT `FK_6480052EB9FC8874` FOREIGN KEY (`leadlist_id`) REFERENCES `lead_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6480052EF639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_leadlist_xref`
--

LOCK TABLES `campaign_leadlist_xref` WRITE;
/*!40000 ALTER TABLE `campaign_leadlist_xref` DISABLE KEYS */;
INSERT INTO `campaign_leadlist_xref` VALUES (1,1);
/*!40000 ALTER TABLE `campaign_leadlist_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_leads`
--

DROP TABLE IF EXISTS `campaign_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_leads` (
  `campaign_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `manually_removed` tinyint(1) NOT NULL,
  `manually_added` tinyint(1) NOT NULL,
  `date_last_exited` datetime DEFAULT NULL,
  `rotation` int(11) NOT NULL,
  PRIMARY KEY (`campaign_id`,`lead_id`),
  KEY `IDX_5995213DF639F774` (`campaign_id`),
  KEY `IDX_5995213D55458D` (`lead_id`),
  KEY `campaign_leads_date_added` (`date_added`),
  KEY `campaign_leads_date_exited` (`date_last_exited`),
  KEY `campaign_leads` (`campaign_id`,`manually_removed`,`lead_id`,`rotation`),
  CONSTRAINT `FK_5995213D55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_5995213DF639F774` FOREIGN KEY (`campaign_id`) REFERENCES `campaigns` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_leads`
--

LOCK TABLES `campaign_leads` WRITE;
/*!40000 ALTER TABLE `campaign_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `campaign_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaigns`
--

DROP TABLE IF EXISTS `campaigns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaigns` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `canvas_settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_E373747012469DE2` (`category_id`),
  CONSTRAINT `FK_E373747012469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaigns`
--

LOCK TABLES `campaigns` WRITE;
/*!40000 ALTER TABLE `campaigns` DISABLE KEYS */;
INSERT INTO `campaigns` VALUES (1,NULL,0,'2017-12-15 06:17:48',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Test',NULL,NULL,NULL,'a:2:{s:5:\"nodes\";a:2:{i:0;a:3:{s:2:\"id\";s:1:\"1\";s:9:\"positionX\";s:3:\"483\";s:9:\"positionY\";s:3:\"155\";}i:1;a:3:{s:2:\"id\";s:5:\"lists\";s:9:\"positionX\";s:3:\"583\";s:9:\"positionY\";s:2:\"50\";}}s:11:\"connections\";a:1:{i:0;a:3:{s:8:\"sourceId\";s:5:\"lists\";s:8:\"targetId\";s:1:\"1\";s:7:\"anchors\";a:2:{s:6:\"source\";s:10:\"leadsource\";s:6:\"target\";s:3:\"top\";}}}}');
/*!40000 ALTER TABLE `campaigns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bundle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_alias_search` (`alias`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `channel_url_trackables`
--

DROP TABLE IF EXISTS `channel_url_trackables`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `channel_url_trackables` (
  `redirect_id` int(11) NOT NULL,
  `channel_id` int(11) NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(11) NOT NULL,
  `unique_hits` int(11) NOT NULL,
  PRIMARY KEY (`redirect_id`,`channel_id`),
  KEY `IDX_2F81A41DB42D874D` (`redirect_id`),
  KEY `channel_url_trackable_search` (`channel`,`channel_id`),
  CONSTRAINT `FK_2F81A41DB42D874D` FOREIGN KEY (`redirect_id`) REFERENCES `page_redirects` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `channel_url_trackables`
--

LOCK TABLES `channel_url_trackables` WRITE;
/*!40000 ALTER TABLE `channel_url_trackables` DISABLE KEYS */;
/*!40000 ALTER TABLE `channel_url_trackables` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `social_cache` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `score` int(11) DEFAULT NULL,
  `companyemail` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyaddress1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyaddress2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyphone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companycity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companystate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyzipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companycountry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companywebsite` longtext COLLATE utf8_unicode_ci,
  `companyindustry` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companydescription` longtext COLLATE utf8_unicode_ci,
  `companynumber_of_employees` double DEFAULT NULL,
  `companyfax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyannual_revenue` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8244AA3A7E3C61F9` (`owner_id`),
  KEY `companyaddress1_search` (`companyaddress1`),
  KEY `companyaddress2_search` (`companyaddress2`),
  KEY `companyemail_search` (`companyemail`),
  KEY `companyphone_search` (`companyphone`),
  KEY `companycity_search` (`companycity`),
  KEY `companystate_search` (`companystate`),
  KEY `companyzipcode_search` (`companyzipcode`),
  KEY `companycountry_search` (`companycountry`),
  KEY `companyname_search` (`companyname`),
  KEY `companynumber_of_employees_search` (`companynumber_of_employees`),
  KEY `companyfax_search` (`companyfax`),
  KEY `companyannual_revenue_search` (`companyannual_revenue`),
  KEY `companyindustry_search` (`companyindustry`),
  KEY `company_filter` (`companyname`,`companyemail`),
  KEY `company_match` (`companyname`,`companycity`,`companycountry`,`companystate`),
  CONSTRAINT `FK_8244AA3A7E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies_leads`
--

DROP TABLE IF EXISTS `companies_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies_leads` (
  `company_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `is_primary` tinyint(1) DEFAULT NULL,
  `manually_removed` tinyint(1) NOT NULL,
  `manually_added` tinyint(1) NOT NULL,
  PRIMARY KEY (`company_id`,`lead_id`),
  KEY `IDX_F4190AB6979B1AD6` (`company_id`),
  KEY `IDX_F4190AB655458D` (`lead_id`),
  CONSTRAINT `FK_F4190AB655458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F4190AB6979B1AD6` FOREIGN KEY (`company_id`) REFERENCES `companies` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies_leads`
--

LOCK TABLES `companies_leads` WRITE;
/*!40000 ALTER TABLE `companies_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `companies_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact_merge_records`
--

DROP TABLE IF EXISTS `contact_merge_records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_merge_records` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contact_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `merged_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D9B4F2BFE7A1254A` (`contact_id`),
  KEY `contact_merge_date_added` (`date_added`),
  KEY `contact_merge_ids` (`merged_id`),
  CONSTRAINT `FK_D9B4F2BFE7A1254A` FOREIGN KEY (`contact_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_merge_records`
--

LOCK TABLES `contact_merge_records` WRITE;
/*!40000 ALTER TABLE `contact_merge_records` DISABLE KEYS */;
INSERT INTO `contact_merge_records` VALUES (1,5,'2017-12-15 05:56:49',4,'Suresh');
/*!40000 ALTER TABLE `contact_merge_records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dynamic_content`
--

DROP TABLE IF EXISTS `dynamic_content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dynamic_content` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `translation_parent_id` int(11) DEFAULT NULL,
  `variant_parent_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `sent_count` int(11) NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variant_settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `variant_start_date` datetime DEFAULT NULL,
  `filters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `is_campaign_based` tinyint(1) NOT NULL DEFAULT '1',
  `slot_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_20B9DEB212469DE2` (`category_id`),
  KEY `IDX_20B9DEB29091A2FB` (`translation_parent_id`),
  KEY `IDX_20B9DEB291861123` (`variant_parent_id`),
  KEY `is_campaign_based_index` (`is_campaign_based`),
  KEY `slot_name_index` (`slot_name`),
  CONSTRAINT `FK_20B9DEB212469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_20B9DEB29091A2FB` FOREIGN KEY (`translation_parent_id`) REFERENCES `dynamic_content` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_20B9DEB291861123` FOREIGN KEY (`variant_parent_id`) REFERENCES `dynamic_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dynamic_content`
--

LOCK TABLES `dynamic_content` WRITE;
/*!40000 ALTER TABLE `dynamic_content` DISABLE KEYS */;
/*!40000 ALTER TABLE `dynamic_content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dynamic_content_lead_data`
--

DROP TABLE IF EXISTS `dynamic_content_lead_data`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dynamic_content_lead_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `dynamic_content_id` int(11) DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `slot` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_515B221B55458D` (`lead_id`),
  KEY `IDX_515B221BD9D0CD7` (`dynamic_content_id`),
  CONSTRAINT `FK_515B221B55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_515B221BD9D0CD7` FOREIGN KEY (`dynamic_content_id`) REFERENCES `dynamic_content` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dynamic_content_lead_data`
--

LOCK TABLES `dynamic_content_lead_data` WRITE;
/*!40000 ALTER TABLE `dynamic_content_lead_data` DISABLE KEYS */;
/*!40000 ALTER TABLE `dynamic_content_lead_data` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dynamic_content_stats`
--

DROP TABLE IF EXISTS `dynamic_content_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dynamic_content_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dynamic_content_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `date_sent` datetime NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `tokens` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `sent_count` int(11) DEFAULT NULL,
  `last_sent` datetime DEFAULT NULL,
  `sent_details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_E48FBF80D9D0CD7` (`dynamic_content_id`),
  KEY `IDX_E48FBF8055458D` (`lead_id`),
  KEY `stat_dynamic_content_search` (`dynamic_content_id`,`lead_id`),
  KEY `stat_dynamic_content_source_search` (`source`,`source_id`),
  CONSTRAINT `FK_E48FBF8055458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_E48FBF80D9D0CD7` FOREIGN KEY (`dynamic_content_id`) REFERENCES `dynamic_content` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dynamic_content_stats`
--

LOCK TABLES `dynamic_content_stats` WRITE;
/*!40000 ALTER TABLE `dynamic_content_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `dynamic_content_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_assets_xref`
--

DROP TABLE IF EXISTS `email_assets_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_assets_xref` (
  `email_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`email_id`,`asset_id`),
  KEY `IDX_CA315778A832C1C9` (`email_id`),
  KEY `IDX_CA3157785DA1941` (`asset_id`),
  CONSTRAINT `FK_CA3157785DA1941` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_CA315778A832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_assets_xref`
--

LOCK TABLES `email_assets_xref` WRITE;
/*!40000 ALTER TABLE `email_assets_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_assets_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_copies`
--

DROP TABLE IF EXISTS `email_copies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_copies` (
  `id` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `date_created` datetime NOT NULL,
  `body` longtext COLLATE utf8_unicode_ci,
  `subject` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_copies`
--

LOCK TABLES `email_copies` WRITE;
/*!40000 ALTER TABLE `email_copies` DISABLE KEYS */;
INSERT INTO `email_copies` VALUES ('bd708c968a7fe00759f763aa6adf76c9','2017-12-15 07:30:02','<!DOCTYPE html><html><head><title></title><link rel=\"stylesheet\" href=\"https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css\" /></head><body aria-disabled=\"false\" style=\"min-height: 300px;\">Test Email From New MAS | LeadsEngage<br /><img src=\"http://192.168.1.38/mautic/media/images/43f84e3898f5ab2bd38c03c537c0221d.png\" class=\"fr-fic fr-dib\" style=\"width: 229px; height: 193.041px;\" /><img height=\"1\" width=\"1\" src=\"{tracking_pixel}\" alt=\"\" /></body></html>','Test Email From New MAS | LeadsEngage');
/*!40000 ALTER TABLE `email_copies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_list_xref`
--

DROP TABLE IF EXISTS `email_list_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_list_xref` (
  `email_id` int(11) NOT NULL,
  `leadlist_id` int(11) NOT NULL,
  PRIMARY KEY (`email_id`,`leadlist_id`),
  KEY `IDX_2E24F01CA832C1C9` (`email_id`),
  KEY `IDX_2E24F01CB9FC8874` (`leadlist_id`),
  CONSTRAINT `FK_2E24F01CA832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2E24F01CB9FC8874` FOREIGN KEY (`leadlist_id`) REFERENCES `lead_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_list_xref`
--

LOCK TABLES `email_list_xref` WRITE;
/*!40000 ALTER TABLE `email_list_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_list_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_stat_replies`
--

DROP TABLE IF EXISTS `email_stat_replies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_stat_replies` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:guid)',
  `stat_id` int(11) NOT NULL,
  `date_replied` datetime NOT NULL,
  `message_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_11E9F6E09502F0B` (`stat_id`),
  KEY `email_replies` (`stat_id`,`message_id`),
  KEY `date_email_replied` (`date_replied`),
  CONSTRAINT `FK_11E9F6E09502F0B` FOREIGN KEY (`stat_id`) REFERENCES `email_stats` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_stat_replies`
--

LOCK TABLES `email_stat_replies` WRITE;
/*!40000 ALTER TABLE `email_stat_replies` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_stat_replies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_stats`
--

DROP TABLE IF EXISTS `email_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `copy_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` datetime NOT NULL,
  `is_read` tinyint(1) NOT NULL,
  `is_failed` tinyint(1) NOT NULL,
  `viewed_in_browser` tinyint(1) NOT NULL,
  `date_read` datetime DEFAULT NULL,
  `tracking_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `retry_count` int(11) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `tokens` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `open_count` int(11) DEFAULT NULL,
  `last_opened` datetime DEFAULT NULL,
  `open_details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_CA0A2625A832C1C9` (`email_id`),
  KEY `IDX_CA0A262555458D` (`lead_id`),
  KEY `IDX_CA0A26253DAE168B` (`list_id`),
  KEY `IDX_CA0A2625A03F5E9F` (`ip_id`),
  KEY `IDX_CA0A2625A8752772` (`copy_id`),
  KEY `stat_email_search` (`email_id`,`lead_id`),
  KEY `stat_email_search2` (`lead_id`,`email_id`),
  KEY `stat_email_failed_search` (`is_failed`),
  KEY `stat_email_read_search` (`is_read`),
  KEY `stat_email_hash_search` (`tracking_hash`),
  KEY `stat_email_source_search` (`source`,`source_id`),
  KEY `email_date_sent` (`date_sent`),
  KEY `email_date_read` (`date_read`),
  CONSTRAINT `FK_CA0A26253DAE168B` FOREIGN KEY (`list_id`) REFERENCES `lead_lists` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_CA0A262555458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_CA0A2625A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_CA0A2625A832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_CA0A2625A8752772` FOREIGN KEY (`copy_id`) REFERENCES `email_copies` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_stats`
--

LOCK TABLES `email_stats` WRITE;
/*!40000 ALTER TABLE `email_stats` DISABLE KEYS */;
INSERT INTO `email_stats` VALUES (1,NULL,5,NULL,NULL,'bd708c968a7fe00759f763aa6adf76c9','suresh@cratio.com','2017-12-15 07:30:02',0,0,0,NULL,'5a3379fa73bd0',0,NULL,NULL,'a:7:{s:18:\"{unsubscribe_text}\";s:121:\"<a href=\'http://192.168.1.38/mautic/email/unsubscribe/5a3379fa73bd0\'>Unsubscribe</a> to no longer receive emails from us.\";s:17:\"{unsubscribe_url}\";s:58:\"http://192.168.1.38/mautic/email/unsubscribe/5a3379fa73bd0\";s:14:\"{webview_text}\";s:112:\"<a href=\'http://192.168.1.38/mautic/email/view/5a3379fa73bd0\'>Having trouble reading this email? Click here.</a>\";s:13:\"{webview_url}\";s:51:\"http://192.168.1.38/mautic/email/view/5a3379fa73bd0\";s:11:\"{signature}\";s:26:\"Best regards, Leads Engage\";s:9:\"{subject}\";s:37:\"Test Email From New MAS | LeadsEngage\";s:16:\"{tracking_pixel}\";s:50:\"http://192.168.1.38/mautic/email/5a3379fa73bd0.gif\";}',NULL,NULL,'a:0:{}');
/*!40000 ALTER TABLE `email_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `email_stats_devices`
--

DROP TABLE IF EXISTS `email_stats_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_stats_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_id` int(11) DEFAULT NULL,
  `stat_id` int(11) DEFAULT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_opened` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7A8A1C6F94A4C7D4` (`device_id`),
  KEY `IDX_7A8A1C6F9502F0B` (`stat_id`),
  KEY `IDX_7A8A1C6FA03F5E9F` (`ip_id`),
  KEY `date_opened_search` (`date_opened`),
  CONSTRAINT `FK_7A8A1C6F94A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `lead_devices` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7A8A1C6F9502F0B` FOREIGN KEY (`stat_id`) REFERENCES `email_stats` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_7A8A1C6FA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_stats_devices`
--

LOCK TABLES `email_stats_devices` WRITE;
/*!40000 ALTER TABLE `email_stats_devices` DISABLE KEYS */;
/*!40000 ALTER TABLE `email_stats_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `translation_parent_id` int(11) DEFAULT NULL,
  `variant_parent_id` int(11) DEFAULT NULL,
  `unsubscribeform_id` int(11) DEFAULT NULL,
  `preference_center_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `subject` longtext COLLATE utf8_unicode_ci,
  `from_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `from_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reply_to_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bcc_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `utm_tags` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `plain_text` longtext COLLATE utf8_unicode_ci,
  `custom_html` longtext COLLATE utf8_unicode_ci,
  `email_type` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `read_count` int(11) NOT NULL,
  `sent_count` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variant_settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `variant_start_date` datetime DEFAULT NULL,
  `dynamic_content` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `variant_sent_count` int(11) NOT NULL,
  `variant_read_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C81E85212469DE2` (`category_id`),
  KEY `IDX_4C81E8529091A2FB` (`translation_parent_id`),
  KEY `IDX_4C81E85291861123` (`variant_parent_id`),
  KEY `IDX_4C81E8522DC494F6` (`unsubscribeform_id`),
  KEY `IDX_4C81E852834F9C5B` (`preference_center_id`),
  CONSTRAINT `FK_4C81E85212469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_4C81E8522DC494F6` FOREIGN KEY (`unsubscribeform_id`) REFERENCES `forms` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_4C81E852834F9C5B` FOREIGN KEY (`preference_center_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_4C81E8529091A2FB` FOREIGN KEY (`translation_parent_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_4C81E85291861123` FOREIGN KEY (`variant_parent_id`) REFERENCES `emails` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,NULL,NULL,NULL,NULL,NULL,1,'2017-12-15 06:16:20',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Test Email',NULL,'Test Email',NULL,NULL,NULL,NULL,'blank','a:0:{}','a:4:{s:9:\"utmSource\";N;s:9:\"utmMedium\";N;s:11:\"utmCampaign\";N;s:10:\"utmContent\";N;}',NULL,'<!DOCTYPE html>\n<html>\n    <head>\n        <title>{subject}</title>\n        <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n        <style type=\"text/css\" media=\"only screen and (max-width: 480px)\">\n            /* Mobile styles */\n            @media only screen and (max-width: 480px) {\n\n                [class=\"w320\"] {\n                    width: 320px !important;\n                }\n\n                [class=\"mobile-block\"] {\n                    width: 100% !important;\n                    display: block !important;\n                }\n            }\n        </style>\n    </head>\n    <body style=\"margin:0\">\n        <div data-section-wrapper=\"1\">\n            <center>\n                <table data-section=\"1\" style=\"width: 600;\" width=\"600\" cellpadding=\"0\" cellspacing=\"0\">\n                    <tbody>\n                        <tr>\n                            <td>\n                                <div data-slot-container=\"1\" style=\"min-height: 30px\">\n                                    <div data-slot=\"text\">\n                                        <br />\n                                        <h2>Hello there!</h2>\n                                        <br />\n                                        We haven\'t heard from you for a while...\n                                        <br />\n                                        <br />\n                                        {unsubscribe_text} | {webview_text}\n                                        <br />\n                                    </div>\n                                </div>\n                            </td>\n                        </tr>\n                    </tbody>\n                </table>\n            </center>\n        </div>\n    </body>\n</html>','template',NULL,NULL,0,0,1,'en','a:0:{}',NULL,'a:1:{i:0;a:3:{s:9:\"tokenName\";s:17:\"Dynamic Content 1\";s:7:\"content\";s:23:\"Default Dynamic Content\";s:7:\"filters\";a:1:{i:0;a:2:{s:7:\"content\";N;s:7:\"filters\";a:0:{}}}}}',0,0);
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `focus`
--

DROP TABLE IF EXISTS `focus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `focus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `focus_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `utm_tags` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `form_id` int(11) DEFAULT NULL,
  `cache` longtext COLLATE utf8_unicode_ci,
  `html_mode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `editor` longtext COLLATE utf8_unicode_ci,
  `html` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_62C04AE912469DE2` (`category_id`),
  KEY `focus_type` (`focus_type`),
  KEY `focus_style` (`style`),
  KEY `focus_form` (`form_id`),
  CONSTRAINT `FK_62C04AE912469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `focus`
--

LOCK TABLES `focus` WRITE;
/*!40000 ALTER TABLE `focus` DISABLE KEYS */;
INSERT INTO `focus` VALUES (1,NULL,0,'2017-12-15 06:26:10',2,'Prabhu Leads Engage','2017-12-15 06:29:29',2,'Prabhu Leads Engage',NULL,NULL,'Prabhu Leads Engage','Test',NULL,'form','page','http://www.cratiocrm.com/',NULL,NULL,'a:12:{s:3:\"bar\";a:5:{s:10:\"allow_hide\";i:1;s:9:\"push_page\";i:1;s:6:\"sticky\";i:1;s:4:\"size\";s:5:\"large\";s:9:\"placement\";s:3:\"top\";}s:5:\"modal\";a:1:{s:9:\"placement\";s:6:\"middle\";}s:12:\"notification\";a:1:{s:9:\"placement\";s:8:\"top_left\";}s:4:\"page\";a:0:{}s:7:\"animate\";i:1;s:15:\"link_activation\";i:1;s:6:\"colors\";a:4:{s:7:\"primary\";s:6:\"f2ef96\";s:4:\"text\";s:6:\"1c1a1a\";s:6:\"button\";s:6:\"150f96\";s:11:\"button_text\";s:6:\"fffcfc\";}s:7:\"content\";a:6:{s:8:\"headline\";s:24:\"Looking for CRM Software\";s:7:\"tagline\";s:27:\"Try our Cratio Software Now\";s:9:\"link_text\";N;s:8:\"link_url\";N;s:15:\"link_new_window\";i:1;s:4:\"font\";s:28:\"Arial, Helvetica, sans-serif\";}s:4:\"when\";s:13:\"scroll_slight\";s:7:\"timeout\";s:2:\"45\";s:9:\"frequency\";s:4:\"once\";s:21:\"stop_after_conversion\";i:1;}','a:4:{s:9:\"utmSource\";s:12:\"Website Camp\";s:9:\"utmMedium\";s:7:\"Adwords\";s:11:\"utmCampaign\";s:5:\"Test1\";s:10:\"utmContent\";s:5:\"Test1\";}',1,'(function (window) {\nif (typeof window.MauticFocusParentHeadStyleInserted == \'undefined\') {\nwindow.MauticFocusParentHeadStyleInserted = false;\n}window.MauticFocus1 = function () {\nvar Focus = {\ndebug: false,\nmodalsDismissed: {},\nignoreConverted: true,// Initialize the focus\ninitialize: function () {\nif (Focus.debug)\nconsole.log(\'initialize()\');Focus.insertStyleIntoHead();\nFocus.registerFocusEvent();// Add class to body\nFocus.addClass(document.getElementsByTagName(\'body\')[0], \'MauticFocusPage\');\n},// Register click events for toggling bar, closing windows, etc\nregisterClickEvents: function () {\nvar closer = Focus.iframeDoc.getElementsByClassName(\'mf-page-close\');\nvar aTag = closer[0].getElementsByTagName(\'a\');\nvar container = Focus.iframeDoc.getElementsByClassName(\'mf-page\');container.onclick = function(e) {\nif (e) { e.stopPropagation(); }\nelse { window.event.cancelBubble = true; }\n};\ndocument.onclick = function() {\naTag[0].click();\n};aTag[0].addEventListener(\'click\', function (event) {\n// Prevent multiple engagements for link clicks on exit intent\nFocus.modalsDismissed[\"1\"] = true;// Remove iframe\nif (Focus.iframe.parentNode) {\nFocus.iframe.parentNode.removeChild(Focus.iframe);\n}var overlays = document.getElementsByClassName(\'mf-modal-overlay-1\');\nif (overlays.length) {\noverlays[0].parentNode.removeChild(overlays[0]);\n}\n});\nvar buttons = Focus.iframeDoc.getElementsByClassName(\'mauticform-button\');\nif (buttons.length) {\nbuttons[0].addEventListener(\'click\', function (event) {\nFocus.convertVisitor();\n});\n}\n},toggleBarCollapse: function (collapser, useCookie) {\nvar svg = collapser.getElementsByTagName(\'svg\');\nvar g = svg[0].getElementsByTagName(\'g\');\nvar currentSize = svg[0].getAttribute(\'data-transform-size\');\nvar currentDirection = svg[0].getAttribute(\'data-transform-direction\');\nvar currentScale = svg[0].getAttribute(\'data-transform-scale\');if (useCookie) {\nif (Focus.cookies.hasItem(\'mf-bar-collapser-1\')) {\nvar newDirection = Focus.cookies.getItem(\'mf-bar-collapser-1\');\nif (isNaN(newDirection)) {\nvar newDirection = currentDirection;\n}\n} else {\n// Set cookie with current direction\nvar newDirection = currentDirection;\n}\n} else {\nvar newDirection = (parseInt(currentDirection) * -1);\nFocus.cookies.setItem(\'mf-bar-collapser-1\', newDirection);\n}setTimeout(function () {\ng[0].setAttribute(\'transform\', \'scale(\' + currentScale + \') rotate(\' + newDirection + \' \' + currentSize + \' \' + currentSize + \')\');\nsvg[0].setAttribute(\'data-transform-direction\', newDirection);\n}, 500);var isTop = Focus.hasClass(Focus.iframeFocus, \'mf-bar-top\');\nif ((!isTop && newDirection == 90) || (isTop && newDirection == -90)) {\n// Open it up\nif (isTop) {\nFocus.iframe.style.marginTop = 0;\n} else {\nFocus.iframe.style.marginBottom = 0;\n}Focus.removeClass(collapser, \'mf-bar-collapsed\');\nFocus.enableIframeResizer();} else {\n// Collapse it\nvar iframeHeight = Focus.iframe.style.height;iframeHeight.replace(\'px\', \'\');\nvar newMargin = (parseInt(iframeHeight) * -1) + \'px\';\nif (isTop) {\nFocus.iframe.style.marginTop = newMargin;\n} else {\nFocus.iframe.style.marginBottom = newMargin;\n}Focus.addClass(collapser, \'mf-bar-collapsed\');\nFocus.disableIFrameResizer();\n}\n},// Register scroll events, etc\nregisterFocusEvent: function () {\nif (Focus.debug)\nconsole.log(\'registerFocusEvent()\');if (Focus.debug)\nconsole.log(\'scroll event registered\');if (Focus.debug)\nconsole.log(\'timeout event registered\');setTimeout(function () {\nwindow.addEventListener(\'scroll\', Focus.engageVisitorAtScrollPosition);\n}, 45000);\n},// Insert global style into page head\ninsertStyleIntoHead: function () {\nif (!window.MauticFocusParentHeadStyleInserted) {\nif (Focus.debug)\nconsole.log(\'insertStyleIntoHead()\');var css = \"\\x2emf\\x2dbar\\x2diframe\\x7bwidth\\x3a100\\x25\\x3bposition\\x3astatic\\x3bz\\x2dindex\\x3a20000\\x3bleft\\x3a0\\x3bright\\x3a0\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2dtransition\\x2dproperty\\x3amargin\\x3btransition\\x2dproperty\\x3amargin\\x3b\\x2dwebkit\\x2dtransition\\x2dduration\\x3a \\x2e5s\\x3btransition\\x2dduration\\x3a \\x2e5s\\x3btransition\\x2dtiming\\x2dfunction\\x3acubic\\x2dbezier\\x280\\x2c1\\x2c0\\x2e5\\x2c1\\x29\\x3b\\x2dwebkit\\x2dtransition\\x2dtiming\\x2dfunction\\x3acubic\\x2dbezier\\x280\\x2c1\\x2c0\\x2e5\\x2c1\\x29\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dtop\\x7btop\\x3a0\\x3bmargin\\x2dtop\\x3a\\x2d100px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dbottom\\x7bbottom\\x3a0\\x3bmargin\\x2dbottom\\x3a\\x2d100px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dregular body\\x2c\\x0a\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dregular\\x0ahtml\\x7bmin\\x2dheight\\x3a30px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dregular\\x2emf\\x2dbar\\x2diframe\\x2dtop\\x7bmargin\\x2dtop\\x3a\\x2d30px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dregular\\x2emf\\x2dbar\\x2diframe\\x2dbottom\\x7bmargin\\x2dbottom\\x3a\\x2d30px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dlarge body\\x2c\\x0a\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dlarge\\x0ahtml\\x7bmin\\x2dheight\\x3a50px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dlarge\\x2emf\\x2dbar\\x2diframe\\x2dtop\\x7bmargin\\x2dtop\\x3a\\x2d50px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dlarge\\x2emf\\x2dbar\\x2diframe\\x2dbottom\\x7bmargin\\x2dbottom\\x3a\\x2d50px\\x7d\\x2emf\\x2dbar\\x2diframe\\x2emf\\x2dbar\\x2diframe\\x2dsticky\\x7bposition\\x3afixed\\x7d\\x2emf\\x2dbar\\x2dspacer\\x7bdisplay\\x3ablock\\x3boverflow\\x3ahidden\\x3bposition\\x3arelative\\x7d\\x2emf\\x2dbar\\x2dspacer\\x2emf\\x2dbar\\x2dspacer\\x2dregular\\x7bheight\\x3a30px\\x7d\\x2emf\\x2dbar\\x2dspacer\\x2emf\\x2dbar\\x2dspacer\\x2dlarge\\x7bheight\\x3a50px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x7bopacity\\x3a0\\x2e3\\x3btext\\x2ddecoration\\x3anone\\x3btransition\\x2dproperty\\x3aall\\x3btransition\\x2dduration\\x3a \\x2e5s\\x3btransition\\x2dtiming\\x2dfunction\\x3acubic\\x2dbezier\\x280\\x2c1\\x2c0\\x2e5\\x2c1\\x29\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x3ahover\\x7bopacity\\x3a0\\x2e7\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x7bposition\\x3aabsolute\\x3bright\\x3a3px\\x3bwidth\\x3a24px\\x3bheight\\x3a24px\\x3btext\\x2dalign\\x3acenter\\x3bz\\x2dindex\\x3a21000\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop\\x7btop\\x3a0\\x3bborder\\x2dbottom\\x2dright\\x2dradius\\x3a4px\\x3bborder\\x2dbottom\\x2dleft\\x2dradius\\x3a4px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a2px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom\\x7bbottom\\x3a0\\x3bborder\\x2dtop\\x2dright\\x2dradius\\x3a4px\\x3bborder\\x2dtop\\x2dleft\\x2dradius\\x3a4px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d2px 0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x7bwidth\\x3a40px\\x3bheight\\x3a40px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x2emf\\x2dbar\\x2dcollapser\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a4px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d4px 0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dsticky\\x7bposition\\x3afixed\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop\\x2emf\\x2dbar\\x2dcollapsed \\x2emf\\x2dbar\\x2dcollapser\\x2dicon svg\\x2c\\x0a\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom\\x2emf\\x2dbar\\x2dcollapsed \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a0\\x7d\\x2emf\\x2dbar\\x2dcollapser a\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x7bposition\\x3arelative\\x3bdisplay\\x3ainline\\x2dblock\\x7d\\x2emf\\x2dbar\\x2dcollapser a\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x3aafter\\x7bcontent\\x3a\\x22\\x22\\x3bposition\\x3aabsolute\\x3btop\\x3a0\\x3bright\\x3a0\\x3bbottom\\x3a0\\x3bleft\\x3a0\\x7d\\x40media only screen and \\x28max\\x2dwidth\\x3a 667px\\x29\\x7b\\x2emf\\x2dbar\\x2dcollapser\\x7bdisplay\\x3anone \\x21important\\x7d\\x7d\\x40\\x2dwebkit\\x2dkeyframes mf\\x2dmodal\\x2dslide\\x2ddown\\x2dtop\\x7b0\\x25\\x7bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dtop\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x7d\\x40keyframes mf\\x2dmodal\\x2dslide\\x2ddown\\x2dtop\\x7b0\\x25\\x7bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dtop\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x7d\\x40\\x2dwebkit\\x2dkeyframes mf\\x2dmodal\\x2dslide\\x2ddown\\x2dmiddle\\x7b0\\x25\\x7bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dtop\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x7d\\x7d\\x40keyframes mf\\x2dmodal\\x2dslide\\x2ddown\\x2dmiddle\\x7b0\\x25\\x7bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dtop\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x7d\\x7d\\x40\\x2dwebkit\\x2dkeyframes mf\\x2dmodal\\x2dslide\\x2dup\\x2dbottom\\x7b0\\x25\\x7bmargin\\x2dbottom\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dbottom\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x7d\\x40keyframes mf\\x2dmodal\\x2dslide\\x2dup\\x2dbottom\\x7b0\\x25\\x7bmargin\\x2dbottom\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c150\\x25\\x29\\x7d100\\x25\\x7bmargin\\x2dbottom\\x3a0\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x7d\\x2emf\\x2dmodal\\x2doverlay\\x7bposition\\x3afixed\\x3btop\\x3a0\\x3bleft\\x3a0\\x3bright\\x3a0\\x3bbackground\\x3a\\x23000\\x3bz\\x2dindex\\x3a21002\\x3bwidth\\x3a100\\x25\\x3bheight\\x3a100\\x25\\x3bopacity\\x3a \\x2e7\\x7d\\x2emf\\x2dmodal\\x2diframe\\x7bposition\\x3afixed\\x3bz\\x2dindex\\x3a21003\\x3bleft\\x3a50\\x25\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dfill\\x2dmode\\x3aforwards\\x3banimation\\x2dfill\\x2dmode\\x3aforwards\\x3b\\x2dwebkit\\x2danimation\\x2dduration\\x3a0\\x2e3s\\x3banimation\\x2dduration\\x3a0\\x2e3s\\x3b\\x2dwebkit\\x2danimation\\x2dtiming\\x2dfunction\\x3aease\\x2din\\x2dout\\x3banimation\\x2dtiming\\x2dfunction\\x3aease\\x2din\\x2dout\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dtop\\x7btop\\x3a10px\\x3bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dtop\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2ddown\\x2dtop\\x3banimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2ddown\\x2dtop\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dmiddle\\x7btop\\x3a50\\x25\\x3bmargin\\x2dtop\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dmiddle\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2ddown\\x2dmiddle\\x3banimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2ddown\\x2dmiddle\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dbottom\\x7bbottom\\x3a10px\\x3bmargin\\x2dbottom\\x3a\\x2d100\\x25\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c0\\x29\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dmodal\\x2diframe\\x2dbottom\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2dup\\x2dbottom\\x3banimation\\x2dname\\x3amf\\x2dmodal\\x2dslide\\x2dup\\x2dbottom\\x7d\\x2emf\\x2dmodal\\x2diframe\\x2emf\\x2dloaded\\x7bmargin\\x2dtop\\x3a0\\x3bmargin\\x2dbottom\\x3a0\\x7d\\x40\\x2dwebkit\\x2dkeyframes mf\\x2dnotification\\x2dslide\\x2dleft\\x7b0\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28150\\x25\\x29\\x3btransform\\x3atranslateX\\x28150\\x25\\x29\\x7d50\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x7d65\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3btransform\\x3atranslateX\\x284\\x25\\x29\\x7d80\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x7d95\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x282\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x282\\x25\\x29\\x3btransform\\x3atranslateX\\x282\\x25\\x29\\x7d100\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3btransform\\x3atranslateX\\x280\\x25\\x29\\x7d\\x7d\\x40keyframes mf\\x2dnotification\\x2dslide\\x2dleft\\x7b0\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28150\\x25\\x29\\x3btransform\\x3atranslateX\\x28150\\x25\\x29\\x7d50\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d8\\x25\\x29\\x7d65\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3btransform\\x3atranslateX\\x284\\x25\\x29\\x7d80\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x7d95\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x282\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x282\\x25\\x29\\x3btransform\\x3atranslateX\\x282\\x25\\x29\\x7d100\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3btransform\\x3atranslateX\\x280\\x25\\x29\\x7d\\x7d\\x40\\x2dwebkit\\x2dkeyframes mf\\x2dnotification\\x2dslide\\x2dright\\x7b0\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x7d50\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x288\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x288\\x25\\x29\\x3btransform\\x3atranslateX\\x288\\x25\\x29\\x7d65\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x7d80\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3btransform\\x3atranslateX\\x284\\x25\\x29\\x7d95\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x7d100\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3btransform\\x3atranslateX\\x280\\x25\\x29\\x7d\\x7d\\x40keyframes mf\\x2dnotification\\x2dslide\\x2dright\\x7b0\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d150\\x25\\x29\\x7d50\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x288\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x288\\x25\\x29\\x3btransform\\x3atranslateX\\x288\\x25\\x29\\x7d65\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d4\\x25\\x29\\x7d80\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x284\\x25\\x29\\x3btransform\\x3atranslateX\\x284\\x25\\x29\\x7d95\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x3btransform\\x3atranslateX\\x28\\x2d2\\x25\\x29\\x7d100\\x25\\x7b\\x2dwebkit\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslateX\\x280\\x25\\x29\\x3btransform\\x3atranslateX\\x280\\x25\\x29\\x7d\\x7d\\x2emf\\x2dnotification\\x2diframe\\x7bposition\\x3afixed\\x3bz\\x2dindex\\x3a21001\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dduration\\x3a1s\\x3banimation\\x2dduration\\x3a1s\\x3b\\x2dwebkit\\x2danimation\\x2dtiming\\x2dfunction\\x3aease\\x2din\\x2dout\\x3banimation\\x2dtiming\\x2dfunction\\x3aease\\x2din\\x2dout\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dtop\\x2dleft\\x7btop\\x3a5px\\x3bleft\\x3a5px\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dtop\\x2dleft\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dright\\x3banimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dright\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dtop\\x2dright\\x7btop\\x3a5px\\x3bright\\x3a5px\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dtop\\x2dright\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dleft\\x3banimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dleft\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dbottom\\x2dleft\\x7bbottom\\x3a5px\\x3bleft\\x3a5px\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dbottom\\x2dleft\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dright\\x3banimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dright\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dbottom\\x2dright\\x7bbottom\\x3a5px\\x3bright\\x3a5px\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dnotification\\x2diframe\\x2dbottom\\x2dright\\x2emf\\x2danimate\\x7b\\x2dwebkit\\x2danimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dleft\\x3banimation\\x2dname\\x3amf\\x2dnotification\\x2dslide\\x2dleft\\x7d\\x2emf\\x2dnotification\\x2diframe\\x2emf\\x2dresponsive\\x7bleft\\x3a0 \\x21important\\x3bright\\x3a0 \\x21important\\x7d\\x2emf\\x2dpage\\x2diframe\\x7bposition\\x3afixed\\x3bz\\x2dindex\\x3a21005\\x3btop\\x3a1px\\x3bright\\x3a1px\\x3bleft\\x3a1px\\x3bbottom\\x3a1px\\x3bwidth\\x3a100\\x25\\x3bheight\\x3a100\\x25\\x7d\\x40media only screen and \\x28max\\x2dwidth\\x3a 667px\\x29\\x7b\\x2emf\\x2dpage\\x2diframe\\x7btop\\x3a0\\x3bright\\x3a0\\x3bleft\\x3a0\\x3bbottom\\x3a0\\x7d\\x7d\",\nhead = document.head || document.getElementsByTagName(\'head\')[0],\nstyle = document.createElement(\'style\');head.appendChild(style);\nstyle.type = \'text/css\';\nif (style.styleSheet) {\nstyle.styleSheet.cssText = css;\n} else {\nstyle.appendChild(document.createTextNode(css));\n}\n} else if (Focus.debug) {\nconsole.log(\'Shared style already inserted into head\');\n}\n},// Inserts styling into the iframe\'s head\ninsertFocusStyleIntoIframeHead: function () {\n// Insert style into iframe header\nvar frameDoc = Focus.iframe.contentDocument;\nvar frameHead = frameDoc.getElementsByTagName(\'head\').item(0);var css = \"\\x2emf\\x2dbar\\x2diframe\\x7bz\\x2dindex\\x3a19000\\x7d\\x2emf\\x2dcontent\\x7bline\\x2dheight\\x3a1\\x2e1\\x7d\\x2emf\\x2dcontent \\x2emf\\x2dinner\\x2dcontainer\\x7bmargin\\x2dtop\\x3a20px\\x7d\\x2emf\\x2dcontent a\\x2emf\\x2dlink\\x2c\\x0a\\x2emf\\x2dcontent \\x2emauticform\\x2dbutton\\x7bpadding\\x3a5px\\x0a15px\\x3b\\x2dwebkit\\x2dborder\\x2dradius\\x3a4px\\x3b\\x2dmoz\\x2dborder\\x2dradius\\x3a4px\\x3bborder\\x2dradius\\x3a4px\\x3bcursor\\x3apointer\\x3btext\\x2dalign\\x3acenter\\x3btext\\x2ddecoration\\x3anone\\x3bborder\\x3anone\\x7d\\x2emf\\x2dcontent a\\x2emf\\x2dlink\\x3ahover\\x2c\\x0a\\x2emf\\x2dcontent \\x2emauticform\\x2dbutton\\x3ahover\\x7bopacity\\x3a0\\x2e9\\x3btext\\x2ddecoration\\x3anone\\x3bborder\\x3anone\\x7d\\x2emautic\\x2dfocus \\x2emauticform\\x5fwrapper\\x0aform\\x7bpadding\\x3a0\\x3bmargin\\x3a0\\x7d\\x2emautic\\x2dfocus \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emautic\\x2dfocus\\x0aselect\\x7bborder\\x2dradius\\x3a2px\\x3bpadding\\x3a5px\\x0a8px\\x3bcolor\\x3a\\x23757575\\x3bborder\\x3a1px\\x0asolid \\x23ababab\\x7d\\x2emautic\\x2dfocus \\x2emauticform\\x2dinput\\x3afocus\\x2c\\x0a\\x2emautic\\x2dfocus select\\x3afocus\\x7boutline\\x3anone\\x3bborder\\x3a1px\\x0asolid \\x23757575\\x7d\\x2emf\\x2dbar\\x7bwidth\\x3a100\\x25\\x3bposition\\x3afixed\\x3bleft\\x3a0\\x3bright\\x3a0\\x3bdisplay\\x3atable\\x3bpadding\\x2dleft\\x3a5px\\x3bpadding\\x2dright\\x3a5px\\x3bz\\x2dindex\\x3a20000\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dtop\\x7btop\\x3a0\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dbottom\\x7bbottom\\x3a0\\x7d\\x2emf\\x2dbar \\x2emf\\x2dbar\\x2dcollapse\\x7bwidth\\x3a100px\\x3bdisplay\\x3atable\\x2dcell\\x3bvertical\\x2dalign\\x3amiddle\\x3bline\\x2dheight\\x3a13px\\x7d\\x2emf\\x2dbar \\x2emf\\x2dcontent\\x7bdisplay\\x3atable\\x2dcell\\x3bvertical\\x2dalign\\x3amiddle\\x3btext\\x2dalign\\x3acenter\\x7d\\x2emf\\x2dbar \\x2emf\\x2dcontent \\x2emf\\x2dlink\\x7bmargin\\x2dleft\\x3a10px\\x3bpadding\\x3a2px\\x0a15px\\x7d\\x2emf\\x2dbar \\x2emf\\x2dcontent \\x2emf\\x2dheadline\\x7bdisplay\\x3ainline\\x2dblock\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular\\x7bheight\\x3a30px\\x3bfont\\x2dsize\\x3a14px\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular\\x2e\\x2emf\\x2dbar\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a3px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular\\x2e\\x2emf\\x2dbar\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d3px 0 0 0\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular select\\x2c\\x0a\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dregular \\x2emauticform\\x2dbutton\\x7bpadding\\x3a3px\\x0a6px\\x3bfont\\x2dsize\\x3a0\\x2e9em\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge\\x7bheight\\x3a50px\\x3bfont\\x2dsize\\x3a17px\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge\\x2e\\x2emf\\x2dbar\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a5px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge\\x2e\\x2emf\\x2dbar\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d5px 0 0 0\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge \\x2emf\\x2dlink\\x7bfont\\x2dsize\\x3a1em\\x7d\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge select\\x2c\\x0a\\x2emf\\x2dbar\\x2emf\\x2dbar\\x2dlarge \\x2emauticform\\x2dbutton\\x7bfont\\x2dsize\\x3a1em\\x7d\\x2emf\\x2dbar \\x2emauticform\\x2drow\\x2c\\x0a\\x2emf\\x2dbar \\x2emauticform\\x2dcheckboxgrp\\x2drow\\x2c\\x0a\\x2emf\\x2dbar \\x2emauticform\\x2dradiogrp\\x2drow\\x7bdisplay\\x3ainline\\x2dblock\\x3bmargin\\x2dright\\x3a3px\\x7d\\x2emf\\x2dbar \\x2emauticform\\x2drow \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dbar \\x2emauticform\\x2drow\\x0aselect\\x7bcolor\\x3a\\x23000\\x7d\\x2emf\\x2dbar \\x2emauticform\\x2dlabel\\x7bdisplay\\x3anone\\x7d\\x2emf\\x2dbar\\x0a\\x2emauticform\\x5fwrapper\\x7bdisplay\\x3ainline\\x2dblock\\x7d\\x2emf\\x2dbar \\x2emf\\x2dresponsive \\x2emf\\x2dbar\\x2dcollapse\\x2c\\x0a\\x2emf\\x2dbar \\x2emf\\x2dresponsive \\x2emf\\x2dbar\\x2dcollapser\\x7bdisplay\\x3anone \\x21important\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x7bposition\\x3aabsolute\\x3bright\\x3a3px\\x3bwidth\\x3a24px\\x3bheight\\x3a24px\\x3btext\\x2dalign\\x3acenter\\x3bz\\x2dindex\\x3a21000\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop\\x7btop\\x3a0\\x3bborder\\x2dbottom\\x2dright\\x2dradius\\x3a4px\\x3bborder\\x2dbottom\\x2dleft\\x2dradius\\x3a4px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a2px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom\\x7bbottom\\x3a0\\x3bborder\\x2dtop\\x2dright\\x2dradius\\x3a4px\\x3bborder\\x2dtop\\x2dleft\\x2dradius\\x3a4px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d2px 0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x7bwidth\\x3a40px\\x3bheight\\x3a40px\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x2emf\\x2dbar\\x2dcollapser\\x2dtop \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a4px\\x0a0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dlarge\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a\\x2d4px 0 0 0\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dsticky\\x7bposition\\x3afixed\\x7d\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dtop\\x2emf\\x2dbar\\x2dcollapsed \\x2emf\\x2dbar\\x2dcollapser\\x2dicon svg\\x2c\\x0a\\x2emf\\x2dbar\\x2dcollapser\\x2emf\\x2dbar\\x2dcollapser\\x2dbottom\\x2emf\\x2dbar\\x2dcollapsed \\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x0asvg\\x7bmargin\\x3a0\\x7d\\x2emf\\x2dbar\\x2dcollapser a\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x7bposition\\x3arelative\\x3bdisplay\\x3ainline\\x2dblock\\x7d\\x2emf\\x2dbar\\x2dcollapser a\\x2emf\\x2dbar\\x2dcollapser\\x2dicon\\x3aafter\\x7bcontent\\x3a\\x22\\x22\\x3bposition\\x3aabsolute\\x3btop\\x3a0\\x3bright\\x3a0\\x3bbottom\\x3a0\\x3bleft\\x3a0\\x7d\\x40media only screen and \\x28max\\x2dwidth\\x3a 667px\\x29\\x7b\\x2emf\\x2dbar\\x2dcollapse\\x2c\\x2emf\\x2dbar\\x2dcollapser\\x7bdisplay\\x3anone \\x21important\\x7d\\x7d\\x2emf\\x2dmodal\\x7bposition\\x3afixed\\x3bopacity\\x3a1\\x3bz\\x2dindex\\x3a2000\\x3bmargin\\x3aauto\\x3bpadding\\x3a45px\\x3bborder\\x2dradius\\x3a4px\\x3bborder\\x2dwidth\\x3a6px 1px 1px 1px\\x3bborder\\x2dstyle\\x3asolid\\x3bbackground\\x3a\\x23fff\\x3bwidth\\x3a40em\\x3bmax\\x2dwidth\\x3a40em\\x3btext\\x2dalign\\x3acenter\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dcontent\\x7bmargin\\x2dbottom\\x3a30px\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dcontent \\x2emf\\x2dheadline\\x7bfont\\x2dsize\\x3a1\\x2e6em\\x3bfont\\x2dweight\\x3a600\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dcontent \\x2emf\\x2dtagline\\x7bfont\\x2dsize\\x3a1\\x2e2em\\x3bfont\\x2dweight\\x3anormal\\x3bmargin\\x2dtop\\x3a4px\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dcontent a\\x2emf\\x2dlink\\x7bdisplay\\x3ablock\\x3bmax\\x2dwidth\\x3a70\\x25\\x3bpadding\\x3a10px\\x3bmargin\\x3aauto\\x3bfont\\x2dsize\\x3a1\\x2e2em\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dmodal\\x2dclose\\x7bposition\\x3aabsolute\\x3btop\\x3a0\\x3bright\\x3a8px\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dmodal\\x2dclose\\x0aa\\x7bfont\\x2dsize\\x3a1\\x2e4em\\x3bcolor\\x3a\\x23757575\\x3bopacity\\x3a \\x2e4\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dmodal \\x2emf\\x2dmodal\\x2dclose a\\x3ahover\\x7bopacity\\x3a \\x2e8\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dmodal \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dmodal \\x2emauticform\\x2drow select\\x2c\\x0a\\x2emf\\x2dmodal \\x2emauticform\\x2dbutton\\x7bwidth\\x3a75\\x25\\x3bheight\\x3a35px\\x3bmargin\\x2dbottom\\x3a5px\\x7d\\x2emf\\x2dresponsive\\x2emf\\x2dmodal\\x2c\\x0a\\x2emf\\x2dresponsive \\x2emf\\x2dmodal\\x7bwidth\\x3a90\\x25\\x3bpadding\\x3a10px\\x7d\\x2emf\\x2dnotification\\x7bposition\\x3afixed\\x3bopacity\\x3a1\\x3bz\\x2dindex\\x3a2000\\x3bmargin\\x3aauto\\x3bbackground\\x3a\\x23fff\\x3bborder\\x2dradius\\x3a4px\\x3bborder\\x2dwidth\\x3a6px 1px 1px 1px\\x3bborder\\x2dstyle\\x3asolid\\x3bmin\\x2dheight\\x3a8em\\x3bpadding\\x3a10px\\x0a20px\\x3bwidth\\x3a350px\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dcontent\\x7bmargin\\x2dbottom\\x3a30px\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dcontent \\x2emf\\x2dheadline\\x7bfont\\x2dsize\\x3a1\\x2e2em\\x3bfont\\x2dweight\\x3a600\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dcontent \\x2emf\\x2dtagline\\x7bfont\\x2dsize\\x3a1em\\x3bfont\\x2dweight\\x3anormal\\x3bmargin\\x2dtop\\x3a4px\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dnotification\\x2dclose\\x7bposition\\x3aabsolute\\x3btop\\x3a0\\x3bright\\x3a8px\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dnotification\\x2dclose\\x0aa\\x7bfont\\x2dsize\\x3a1em\\x3bcolor\\x3a\\x23757575\\x3bopacity\\x3a \\x2e4\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dnotification \\x2emf\\x2dnotification\\x2dclose a\\x3ahover\\x7bopacity\\x3a \\x2e8\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dnotification \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dnotification \\x2emauticform\\x2drow select\\x2c\\x0a\\x2emf\\x2dnotification \\x2emauticform\\x2dbutton\\x7bwidth\\x3a100\\x25\\x3bheight\\x3a28px\\x3bmargin\\x2dbottom\\x3a2px\\x7d\\x2emf\\x2dresponsive\\x2emf\\x2dnotification\\x2c\\x0a\\x2emf\\x2dresponsive \\x2emf\\x2dnotification\\x7bwidth\\x3a90\\x25\\x3bpadding\\x3a10px\\x3bleft\\x3a0\\x3bright\\x3a0\\x7d\\x2emf\\x2dpage\\x7bposition\\x3afixed\\x3bopacity\\x3a1\\x3bz\\x2dindex\\x3a20000\\x3bmargin\\x3aauto\\x3bpadding\\x3a45px\\x3bbackground\\x3a\\x23fff\\x3bborder\\x2dradius\\x3a2px\\x3bborder\\x2dwidth\\x3a6px 1px 1px 1px\\x3bborder\\x2dstyle\\x3asolid\\x3btop\\x3a1px\\x3bright\\x3a1px\\x3bleft\\x3a1px\\x3bbottom\\x3a1px\\x3btext\\x2dalign\\x3acenter\\x7d\\x2emf\\x2dpage \\x2emf\\x2dcontent\\x7bposition\\x3aabsolute\\x3bmin\\x2dwidth\\x3a75\\x25\\x3btop\\x3a50\\x25\\x3bleft\\x3a50\\x25\\x3bright\\x3a0\\x3btransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3b\\x2dwebkit\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3b\\x2dms\\x2dtransform\\x3atranslate\\x28\\x2d50\\x25\\x2c\\x2d50\\x25\\x29\\x3bmargin\\x2dbottom\\x3a30px\\x7d\\x2emf\\x2dpage \\x2emf\\x2dcontent \\x2emf\\x2dheadline\\x7bfont\\x2dsize\\x3a2\\x2e5em\\x3bfont\\x2dweight\\x3a600\\x7d\\x2emf\\x2dpage \\x2emf\\x2dcontent \\x2emf\\x2dtagline\\x7bfont\\x2dsize\\x3a1\\x2e8em\\x3bfont\\x2dweight\\x3anormal\\x3bmargin\\x2dtop\\x3a4px\\x7d\\x2emf\\x2dpage \\x2emf\\x2dcontent a\\x2emf\\x2dlink\\x7bpadding\\x3a10px\\x0a15px\\x3bdisplay\\x3ablock\\x3bmax\\x2dwidth\\x3a50\\x25\\x3bmargin\\x3aauto\\x3bfont\\x2dsize\\x3a1\\x2e8em\\x7d\\x2emf\\x2dpage \\x2emf\\x2dpage\\x2dclose\\x7bposition\\x3aabsolute\\x3btop\\x3a0\\x3bright\\x3a8px\\x7d\\x2emf\\x2dpage \\x2emf\\x2dpage\\x2dclose\\x0aa\\x7bfont\\x2dsize\\x3a1\\x2e8em\\x3bcolor\\x3a\\x23757575\\x3bopacity\\x3a \\x2e4\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dpage \\x2emf\\x2dpage\\x2dclose a\\x3ahover\\x7bopacity\\x3a \\x2e8\\x3btext\\x2ddecoration\\x3anone\\x7d\\x2emf\\x2dpage \\x2emauticform\\x2dinput\\x2c\\x0a\\x2emf\\x2dpage \\x2emauticform\\x2drow select\\x2c\\x0a\\x2emf\\x2dpage \\x2emauticform\\x2dbutton\\x7bwidth\\x3a75\\x25\\x3bheight\\x3a40px\\x3bfont\\x2dsize\\x3a1\\x2e6em\\x3bmargin\\x2dbottom\\x3a8px\\x7d\";\nvar style = frameDoc.createElement(\'style\');style.type = \'text/css\';\nif (style.styleSheet) {\nstyle.styleSheet.cssText = css;\n} else {\nstyle.appendChild(frameDoc.createTextNode(css));\n}\nframeHead.appendChild(style);var metaTag = frameDoc.createElement(\'meta\');\nmetaTag.name = \"viewport\"\nmetaTag.content = \"width=device-width,initial-scale=1,minimum-scale=1.0 maximum-scale=1.0\"\nframeHead.appendChild(metaTag);\n},// Generates the focus HTML\nengageVisitor: function () {\nvar now = Math.floor(Date.now() / 1000);if (Focus.cookies.hasItem(\'mautic_focus_1\')) {\nif (Focus.debug)\nconsole.log(\'Cookie exists thus checking frequency\');var lastEngaged = parseInt(Focus.cookies.getItem(\'mautic_focus_1\')),\nfrequency = \'once\',\nengage;if (Focus.ignoreConverted && lastEngaged == -1) {\nif (Focus.debug)\nconsole.log(\'Visitor converted; abort\');return false;\n}switch (frequency) {\ncase \'once\':\nengage = false;\nif (Focus.debug)\nconsole.log(\'Engage once, abort\');break;\ncase \'everypage\':\nengage = true;\nif (Focus.debug)\nconsole.log(\'Engage on every page, continue\');break;\ncase \'q2min\':\nengage = (now - lastEngaged) >= 120;\nif (Focus.debug) {\nvar debugMsg = \'Engage q2 minute, \';\nif (engage) {\ndebugMsg += \'continue\';\n} else {\ndebugMsg += \'engage in \' + (120 - (now - lastEngaged)) + \' seconds\';\n}\nconsole.log(debugMsg);\n}break;\ncase \'q15min\':\nengage = (now - lastEngaged) >= 900;\nif (Focus.debug) {\nvar debugMsg = \'Engage q15 minute, \';\nif (engage) {\ndebugMsg += \'continue\';\n} else {\ndebugMsg += \'engage in \' + (120 - (now - lastEngaged)) + \' seconds\';\n}\nconsole.log(debugMsg);\n}break;\ncase \'hourly\':\nengage = (now - lastEngaged) >= 3600;\nif (Focus.debug) {\nvar debugMsg = \'Engage hourly, \';\nif (engage) {\ndebugMsg += \'continue\';\n} else {\ndebugMsg += \'engage in \' + (120 - (now - lastEngaged)) + \' seconds\';\n}\nconsole.log(debugMsg);\n}break;\ncase \'daily\':\nengage = (now - lastEngaged) >= 86400;\nif (Focus.debug) {\nvar debugMsg = \'Engage daily, \';\nif (engage) {\ndebugMsg += \'continue\';\n} else {\ndebugMsg += \'engage in \' + (120 - (now - lastEngaged)) + \' seconds\';\n}\nconsole.log(debugMsg);\n}break;\n}if (!engage) {return false;\n}\n}if (Focus.debug)\nconsole.log(\'engageVisitor()\');// Inject iframe\nFocus.createIframe();// Inject content into iframe\nFocus.iframeDoc.open();\nFocus.iframeDoc.write(\"\\x3cdiv\\x3e\\x3cstyle scoped\\x3e\\x2emautic\\x2dfocus \\x7b\\x0a            font\\x2dfamily\\x3a Arial\\x2c Helvetica\\x2c sans\\x2dserif\\x3b\\x0a            color\\x3a \\x231c1a1a\\x3b\\x0a        \\x7d\\x0a\\x0a        \\x0a        \\x2emf\\x2dcontent a\\x2emf\\x2dlink\\x2c \\x2emf\\x2dcontent \\x2emauticform\\x2dbutton \\x7b\\x0a            background\\x2dcolor\\x3a \\x23150f96\\x3b\\x0a            color\\x3a \\x23fffcfc\\x3b\\x0a        \\x7d\\x0a\\x0a        \\x2emauticform\\x2dinput\\x3afocus\\x2c select\\x3afocus \\x7b\\x0a            border\\x3a 1px solid \\x23150f96\\x3b\\x0a        \\x7d\\x3c\\x2fstyle\\x3e\\x3cstyle scoped\\x3e\\x2emf\\x2dpage \\x7b\\x0a            border\\x2dcolor\\x3a \\x23f2ef96        \\x7d\\x3c\\x2fstyle\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mautic\\x2dfocus mf\\x2dpage\\x22\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dpage\\x2dcontainer\\x22\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dpage\\x2dclose\\x22\\x3e\\x0a\\x3ca\\x0ahref\\x3d\\x22javascript\\x3avoid\\x280\\x29\\x22\\x3ex\\x3c\\x2fa\\x3e\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dcontent\\x22\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dheadline\\x22\\x3eLooking for CRM Software\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dtagline\\x22\\x3eTry our Cratio Software Now\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mf\\x2dinner\\x2dcontainer\\x22\\x3e\\x0a \\x3cscript type\\x3d\\x22text\\x2fjavascript\\x22\\x3e\\x2f\\x2a\\x2a This section is only needed once per page if manually copying \\x2a\\x2a\\x2f\\x0a    if \\x28typeof MauticSDKLoaded \\x3d\\x3d \\x27undefined\\x27\\x29 \\x7b\\x0a        var MauticSDKLoaded \\x3d true\\x3b\\x0a        var head            \\x3d document\\x2egetElementsByTagName\\x28\\x27head\\x27\\x29\\x5b0\\x5d\\x3b\\x0a        var script          \\x3d document\\x2ecreateElement\\x28\\x27script\\x27\\x29\\x3b\\x0a        script\\x2etype         \\x3d \\x27text\\x2fjavascript\\x27\\x3b\\x0a        script\\x2esrc          \\x3d \\x27http\\x3a\\x2f\\x2flocalhost\\x2fmautic\\x2fmedia\\x2fjs\\x2fmautic\\x2dform\\x2ejs\\x27\\x3b\\x0a        script\\x2eonload       \\x3d function\\x28\\x29 \\x7b\\x0a            MauticSDK\\x2eonLoad\\x28\\x29\\x3b\\x0a        \\x7d\\x3b\\x0a        head\\x2eappendChild\\x28script\\x29\\x3b\\x0a        var MauticDomain \\x3d \\x27http\\x3a\\x2f\\x2flocalhost\\x2fmautic\\x27\\x3b\\x0a        var MauticLang   \\x3d \\x7b\\x0a            \\x27submittingMessage\\x27\\x3a \\x22Please wait\\x2e\\x2e\\x2e\\x22\\x0a        \\x7d\\x0a    \\x7d\\x3c\\x2fscript\\x3e \\x3cscript\\x3evar MauticFocusHandler \\x3d function \\x28messageType\\x2c message\\x29 \\x7b\\x0a            \\x2f\\x2f Store the HTML\\x0a            var wrapper \\x3d document\\x2egetElementById\\x28\\x27mauticform\\x5fwrapper\\x5ftest\\x5ffocus\\x27\\x29\\x3b\\x0a            var innerForm \\x3d wrapper\\x2egetElementsByClassName\\x28\\x27mauticform\\x2dinnerform\\x27\\x29\\x3b\\x0a            innerForm\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22none\\x22\\x3b\\x0a\\x0a                        document\\x2egetElementById\\x28\\x27mauticform\\x5ftest\\x5ffocus\\x5f\\x27 \\x2b messageType\\x29\\x2estyle\\x2efontSize \\x3d \\x222em\\x22\\x3b\\x0a            \\x0a            var headline \\x3d document\\x2egetElementsByClassName\\x28\\x27mf\\x2dheadline\\x27\\x29\\x3b\\x0a            if \\x28headline\\x2elength\\x29 \\x7b\\x0a                headline\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22none\\x22\\x3b\\x0a            \\x7d\\x0a\\x0a            var tagline \\x3d document\\x2egetElementsByClassName\\x28\\x27mf\\x2dtagline\\x27\\x29\\x3b\\x0a            if \\x28tagline\\x2elength\\x29 \\x7b\\x0a                tagline\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22none\\x22\\x3b\\x0a            \\x7d\\x0a\\x0a            if \\x28message\\x29 \\x7b\\x0a                document\\x2egetElementById\\x28\\x27mauticform\\x5ftest\\x5ffocus\\x5f\\x27 \\x2b messageType\\x29\\x2einnerHTML \\x3d message\\x3b\\x0a            \\x7d\\x0a\\x0a            setTimeout\\x28function \\x28\\x29 \\x7b\\x0a                if \\x28headline\\x2elength\\x29 \\x7b\\x0a                                        headline\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22block\\x22\\x3b\\x0a                                    \\x7d\\x0a                if \\x28tagline\\x2elength\\x29 \\x7b\\x0a                    tagline\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22inherit\\x22\\x3b\\x0a                \\x7d\\x0a\\x0a                innerForm\\x5b0\\x5d\\x2estyle\\x2edisplay \\x3d \\x22inherit\\x22\\x3b\\x0a                document\\x2egetElementById\\x28\\x27mauticform\\x5ftest\\x5ffocus\\x5f\\x27 \\x2b messageType\\x29\\x2einnerHTML \\x3d \\x27\\x27\\x3b\\x0a            \\x7d\\x2c \\x28messageType \\x3d\\x3d \\x27error\\x27\\x29 \\x3f 1500 \\x3a 5000\\x29\\x3b\\x0a        \\x7d\\x0a        if \\x28typeof MauticFormCallback \\x3d\\x3d \\x27undefined\\x27\\x29 \\x7b\\x0a            var MauticFormCallback \\x3d \\x7b\\x7d\\x3b\\x0a        \\x7d\\x0a        MauticFormCallback\\x5b\\x22test\\x5ffocus\\x22\\x5d \\x3d \\x7b\\x0a            onMessageSet\\x3a function \\x28data\\x29 \\x7b\\x0a                if \\x28data\\x2emessage\\x29 \\x7b\\x0a                    MauticFocusHandler\\x28data\\x2etype\\x29\\x3b\\x0a                \\x7d\\x0a            \\x7d\\x2c\\x0a            onErrorMark\\x3a function \\x28data\\x29 \\x7b\\x0a                if \\x28data\\x2evalidationMessage\\x29 \\x7b\\x0a                    MauticFocusHandler\\x28\\x27error\\x27\\x2c data\\x2evalidationMessage\\x29\\x3b\\x0a\\x0a                    return true\\x3b\\x0a                \\x7d\\x0a            \\x7d\\x2c\\x0a            onResponse\\x3a function \\x28data\\x29 \\x7b\\x0a                if \\x28data\\x2edownload\\x29 \\x7b\\x0a                    \\x2f\\x2f Hit the download in the iframe\\x0a                    document\\x2egetElementById\\x28\\x27mauticiframe\\x5ftest\\x5ffocus\\x27\\x29\\x2esrc \\x3d data\\x2edownload\\x3b\\x0a\\x0a                    \\x2f\\x2f Register a callback for a redirect\\x0a                    if \\x28data\\x2eredirect\\x29 \\x7b\\x0a                        setTimeout\\x28function \\x28\\x29 \\x7b\\x0a                            window\\x2etop\\x2elocation \\x3d data\\x2eredirect\\x3b\\x0a                        \\x7d\\x2c 2000\\x29\\x3b\\x0a                    \\x7d\\x0a\\x0a                    return true\\x3b\\x0a                \\x7d else if \\x28data\\x2eredirect\\x29 \\x7b\\x0a                    window\\x2etop\\x2elocation \\x3d data\\x2eredirect\\x3b\\x0a\\x0a                    return true\\x3b\\x0a                \\x7d\\x0a\\x0a                return false\\x3b\\x0a            \\x7d\\x0a        \\x7d\\x3c\\x2fscript\\x3e \\x3cdiv\\x0aid\\x3d\\x22mauticform\\x5fwrapper\\x5ftest\\x5ffocus\\x22 class\\x3d\\x22mauticform\\x5fwrapper\\x22\\x3e\\x3cform\\x0aautocomplete\\x3d\\x22false\\x22 role\\x3d\\x22form\\x22 method\\x3d\\x22post\\x22 action\\x3d\\x22http\\x3a\\x2f\\x2f192\\x2e168\\x2e1\\x2e38\\x2fmautic\\x2fform\\x2fsubmit\\x3fformId\\x3d1\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x22  data\\x2dmautic\\x2dform\\x3d\\x22test\\x5ffocus\\x22 enctype\\x3d\\x22multipart\\x2fform\\x2ddata\\x22\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mauticform\\x2derror\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5ferror\\x22\\x3e\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mauticform\\x2dmessage\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5fmessage\\x22\\x3e\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aclass\\x3d\\x22mauticform\\x2dinnerform\\x22\\x3e\\x3cdiv\\x0aid\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5femail\\x22  data\\x2dvalidate\\x3d\\x22email\\x22 data\\x2dvalidation\\x2dtype\\x3d\\x22email\\x22 class\\x3d\\x22mauticform\\x2drow mauticform\\x2demail mauticform\\x2dfield\\x2d1 mauticform\\x2drequired\\x22\\x3e\\x0a\\x3clabel\\x0aid\\x3d\\x22mauticform\\x5flabel\\x5ftest\\x5ffocus\\x5femail\\x22 for\\x3d\\x22mauticform\\x5finput\\x5ftest\\x5ffocus\\x5femail\\x22 Your business email class\\x3d\\x22mauticform\\x2dlabel\\x22\\x3eEmail\\x3c\\x2flabel\\x3e\\x0a\\x3cinput\\x0aid\\x3d\\x22mauticform\\x5finput\\x5ftest\\x5ffocus\\x5femail\\x22 name\\x3d\\x22mauticform\\x5bemail\\x5d\\x22 value\\x3d\\x22\\x22 class\\x3d\\x22mauticform\\x2dinput\\x22 type\\x3d\\x22email\\x22 \\x2f\\x3e\\x0a\\x3cspan\\x0aclass\\x3d\\x22mauticform\\x2derrormsg\\x22 style\\x3d\\x22display\\x3a none\\x3b\\x22\\x3eThis is required\\x2e\\x3c\\x2fspan\\x3e\\x3c\\x2fdiv\\x3e\\x3cdiv\\x0aid\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5fdownload\\x5fnow\\x22  class\\x3d\\x22mauticform\\x2drow mauticform\\x2dbutton\\x2dwrapper mauticform\\x2dfield\\x2d2\\x22\\x3e\\x0a\\x3cbutton\\x0atype\\x3d\\x22submit\\x22 name\\x3d\\x22mauticform\\x5bdownload\\x5fnow\\x5d\\x22 id\\x3d\\x22mauticform\\x5finput\\x5ftest\\x5ffocus\\x5fdownload\\x5fnow\\x22 name\\x3d\\x22mauticform\\x5bdownload\\x5fnow\\x5d\\x22 value\\x3d\\x22\\x22 class\\x3d\\x22mauticform\\x2dbutton btn btn\\x2ddefault\\x22 value\\x3d\\x221\\x22\\x3eDownload Now\\x3c\\x2fbutton\\x3e\\x3c\\x2fdiv\\x3e\\x3c\\x2fdiv\\x3e\\x3cinput\\x0atype\\x3d\\x22hidden\\x22 name\\x3d\\x22mauticform\\x5bformId\\x5d\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5fid\\x22 value\\x3d\\x221\\x22\\x2f\\x3e\\x0a\\x3cinput\\x0atype\\x3d\\x22hidden\\x22 name\\x3d\\x22mauticform\\x5breturn\\x5d\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5freturn\\x22 value\\x3d\\x22\\x22\\x2f\\x3e\\x0a\\x3cinput\\x0atype\\x3d\\x22hidden\\x22 name\\x3d\\x22mauticform\\x5bformName\\x5d\\x22 id\\x3d\\x22mauticform\\x5ftest\\x5ffocus\\x5fname\\x22 value\\x3d\\x22test\\x5ffocus\\x22\\x2f\\x3e\\x3cinput\\x0atype\\x3d\\x22hidden\\x22 name\\x3d\\x22mauticform\\x5bfocusId\\x5d\\x22 id\\x3d\\x22mauticform\\x3c\\x3fphp echo \\x5ftest\\x5ffocus \\x3f\\x3e\\x5ffocus\\x5fid\\x22 value\\x3d\\x221\\x22\\x2f\\x3e\\x3c\\x2fform\\x3e\\x3c\\x2fdiv\\x3e\\x3c\\x2fdiv\\x3e\\x3c\\x2fdiv\\x3e\\x3c\\x2fdiv\\x3e\\x3c\\x2fdiv\\x3e\\x3cimg\\x0asrc\\x3d\\x22\\x2f\\x2f192\\x2e168\\x2e1\\x2e38\\x2fmautic\\x2ffocus\\x2f1\\x2fviewpixel\\x2egif\\x22 alt\\x3d\\x22Mautic Focus\\x22 style\\x3d\\x22display\\x3a none\\x3b\\x22\\x2f\\x3e\\x3c\\x2fdiv\\x3e\");\nFocus.iframeDoc.close();var animate = true;Focus.iframe.onload = function() {\nif (Focus.debug)\nconsole.log(\'iframe loaded for \'+Focus.iframe.getAttribute(\'src\'));// Resize iframe\nif (Focus.enableIframeResizer()) {\n// Give iframe chance to resize\nsetTimeout(function () {\nif (animate) {\nFocus.addClass(Focus.iframe, \"mf-animate\");\n}\nFocus.addClass(Focus.iframe, \"mf-loaded\");\n}, 35);\n} else {\nif (animate) {\nFocus.addClass(Focus.iframe, \"mf-animate\");\n}\nFocus.addClass(Focus.iframe, \"mf-loaded\");\n}\n}// Set body margin to 0\nFocus.iframeDoc.getElementsByTagName(\'body\')[0].style.margin = 0;// Find elements that should be moved to parent\nvar move = Focus.iframeDoc.getElementsByClassName(\'mf-move-to-parent\');\nfor (var i = 0; i < move.length; i++) {\nvar bodyFirstChild = document.body.firstChild;\nFocus.addClass(move[i], \'mf-moved-1\');\nbodyFirstChild.parentNode.insertBefore(move[i], Focus.iframe);\n}// Find elements that should be copied to parent\nvar copy = Focus.iframeDoc.getElementsByClassName(\'mf-copy-to-parent\');\nfor (var i = 0; i < copy.length; i++) {\nvar bodyFirstChild = document.body.firstChild;\nvar clone = copy[i].cloneNode(true);\nFocus.addClass(clone, \'mf-moved-1\');\nbodyFirstChild.parentNode.insertBefore(clone, Focus.iframe);\n}// Get the main focus element\nvar focus = Focus.iframeDoc.getElementsByClassName(\'mautic-focus\');\nFocus.iframeFocus = focus[0];// Insert style into iframe head\nFocus.insertFocusStyleIntoIframeHead();// Register events\nFocus.registerClickEvents();\n// Add cookie of last engagement\nif (Focus.debug)\nconsole.log(\'mautic_focus_1 cookie set for \' + now);Focus.cookies.removeItem(\'mautic_focus_1\');\nFocus.cookies.setItem(\'mautic_focus_1\', now, Infinity, \'/\');\nreturn true;\n},// Enable iframe resizer\nenableIframeResizer: function () {\nif (typeof Focus.iframeResizerEnabled !== \'undefined\') {\nreturn true;\n}\nreturn false;\n},// Disable iframe resizer\ndisableIFrameResizer: function () {\nif (typeof Focus.iframeResizerEnabled !== \'undefined\') {\ndelete(Focus.iframeResizerEnabled);\n}},// Create iframe to load into body\ncreateIframe: function () {\nif (Focus.debug)\nconsole.log(\'createIframe()\');Focus.iframe = document.createElement(\'iframe\');\nFocus.iframe.style.border = 0;\nFocus.iframe.style.width = \"100%\";\nFocus.iframe.style.height = \"100%\";\nFocus.iframe.src = \"about:blank\";\nFocus.iframe.scrolling = \"no\";\nFocus.iframe.className = \"mf-page-iframe\";var bodyFirstChild = document.body.firstChild;\nbodyFirstChild.parentNode.insertBefore(Focus.iframe, bodyFirstChild);Focus.iframeDoc = Focus.iframe.contentWindow.document;\n},// Execute event at current position\nengageVisitorAtScrollPosition: function (event) {\nvar visualHeight = \"innerHeight\" in window\n? window.innerHeight\n: document.documentElement.offsetHeight;var scrollPos = window.pageYOffset,\natPos = 0;atPos = 10;\nif (Focus.debug)\nconsole.log(\'scrolling: \' + scrollPos + \' >= \' + atPos);if (scrollPos >= atPos) {\nwindow.removeEventListener(\'scroll\', Focus.engageVisitorAtScrollPosition);\nFocus.engageVisitor();\n}\n},// Create cookie noting visitor has been converted if applicable\nconvertVisitor: function () {\nif (Focus.ignoreConverted) {\nif (Focus.debug)\nconsole.log(\'Visitor converted\');Focus.cookies.setItem(\'mautic_focus_1\', -1, Infinity);\n} else if (Focus.debug) {\nconsole.log(\'Visitor converted but ignoreConverted not enabled\');\n}\n},// Element has class\nhasClass: function (element, hasClass) {\nreturn ( (\" \" + element.className + \" \").replace(/[\\n\\t]/g, \" \").indexOf(\" \" + hasClass + \" \") > -1 );\n},// Add class to element\naddClass: function (element, addClass) {\nif (!Focus.hasClass(element, addClass)) {\nelement.className += \" \" + addClass;\n}\n},// Remove class from element\nremoveClass: function (element, removeClass) {\nelement.className = element.className.replace(new RegExp(\'\\\\b\' + removeClass + \'\\\\b\'), \'\');\n},// Cookie handling\ncookies: {\n/**\n* :: cookies.js ::\n* https://developer.mozilla.org/en-US/docs/Web/API/document.cookie\n* http://www.gnu.org/licenses/gpl-3.0-standalone.html\n*/\ngetItem: function (sKey) {\nif (!sKey) {\nreturn null;\n}\nreturn decodeURIComponent(document.cookie.replace(new RegExp(\"(?:(?:^|.*;)\\\\s*\" + encodeURIComponent(sKey).replace(/[\\-\\.\\+\\*]/g, \"\\\\$&\") + \"\\\\s*\\\\=\\\\s*([^;]*).*$)|^.*$\"), \"$1\")) || null;\n},\nsetItem: function (sKey, sValue, vEnd, sPath, sDomain, bSecure) {\nif (!sKey || /^(?:expires|max\\-age|path|domain|secure)$/i.test(sKey)) {\nreturn false;\n}this.removeItem(sKey);var sExpires = \"\";\nif (vEnd) {\nswitch (vEnd.constructor) {\ncase Number:\nsExpires = vEnd === Infinity ? \"; expires=Fri, 31 Dec 9999 23:59:59 GMT\" : \"; max-age=\" + vEnd;\nbreak;\ncase String:\nsExpires = \"; expires=\" + vEnd;\nbreak;\ncase Date:\nsExpires = \"; expires=\" + vEnd.toUTCString();\nbreak;\n}\n}\ndocument.cookie = encodeURIComponent(sKey) + \"=\" + encodeURIComponent(sValue) + sExpires + (sDomain ? \"; domain=\" + sDomain : \"\") + (sPath ? \"; path=\" + sPath : \"\") + (bSecure ? \"; secure\" : \"\");\nreturn true;\n},\nremoveItem: function (sKey, sPath, sDomain) {\nif (!this.hasItem(sKey)) {\nreturn false;\n}\ndocument.cookie = encodeURIComponent(sKey) + \"=; expires=Thu, 01 Jan 1970 00:00:00 GMT\" + (sDomain ? \"; domain=\" + sDomain : \"\") + (sPath ? \"; path=\" + sPath : \"\");\nreturn true;\n},\nhasItem: function (sKey) {\nif (!sKey) {\nreturn false;\n}\nreturn (new RegExp(\"(?:^|;\\\\s*)\" + encodeURIComponent(sKey).replace(/[\\-\\.\\+\\*]/g, \"\\\\$&\") + \"\\\\s*\\\\=\")).test(document.cookie);\n},\nkeys: function () {\nvar aKeys = document.cookie.replace(/((?:^|\\s*;)[^\\=]+)(?=;|$)|^\\s*|\\s*(?:\\=[^;]*)?(?:\\1|$)/g, \"\").split(/\\s*(?:\\=[^;]*)?;\\s*/);\nfor (var nLen = aKeys.length, nIdx = 0; nIdx < nLen; nIdx++) {\naKeys[nIdx] = decodeURIComponent(aKeys[nIdx]);\n}\nreturn aKeys;\n}\n}\n};return Focus;\n}// Initialize\nMauticFocus1().initialize();\n})(window);','basic',NULL,NULL);
/*!40000 ALTER TABLE `focus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `focus_stats`
--

DROP TABLE IF EXISTS `focus_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `focus_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `focus_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C36970DC51804B42` (`focus_id`),
  KEY `IDX_C36970DC55458D` (`lead_id`),
  KEY `focus_type` (`type`),
  KEY `focus_type_id` (`type`,`type_id`),
  KEY `focus_date_added` (`date_added`),
  CONSTRAINT `FK_C36970DC51804B42` FOREIGN KEY (`focus_id`) REFERENCES `focus` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C36970DC55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `focus_stats`
--

LOCK TABLES `focus_stats` WRITE;
/*!40000 ALTER TABLE `focus_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `focus_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_actions`
--

DROP TABLE IF EXISTS `form_actions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_actions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `action_order` int(11) NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_342491D45FF69B7D` (`form_id`),
  KEY `form_action_type_search` (`type`),
  CONSTRAINT `FK_342491D45FF69B7D` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_actions`
--

LOCK TABLES `form_actions` WRITE;
/*!40000 ALTER TABLE `form_actions` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_actions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_fields`
--

DROP TABLE IF EXISTS `form_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `label` longtext COLLATE utf8_unicode_ci NOT NULL,
  `show_label` tinyint(1) DEFAULT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_custom` tinyint(1) NOT NULL,
  `custom_parameters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `default_value` longtext COLLATE utf8_unicode_ci,
  `is_required` tinyint(1) NOT NULL,
  `validation_message` longtext COLLATE utf8_unicode_ci,
  `help_message` longtext COLLATE utf8_unicode_ci,
  `field_order` int(11) DEFAULT NULL,
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `label_attr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `input_attr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `container_attr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lead_field` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `save_result` tinyint(1) DEFAULT NULL,
  `is_auto_fill` tinyint(1) DEFAULT NULL,
  `show_when_value_exists` tinyint(1) DEFAULT NULL,
  `show_after_x_submissions` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7C0B37265FF69B7D` (`form_id`),
  KEY `form_field_type_search` (`type`),
  CONSTRAINT `FK_7C0B37265FF69B7D` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_fields`
--

LOCK TABLES `form_fields` WRITE;
/*!40000 ALTER TABLE `form_fields` DISABLE KEYS */;
INSERT INTO `form_fields` VALUES (1,1,'Email',1,'email','email',0,'a:0:{}',NULL,1,NULL,NULL,1,'a:1:{s:11:\"placeholder\";N;}','Your business email',NULL,NULL,'email',1,0,1,NULL),(2,1,'Download Now',1,'download_now','button',0,'a:0:{}',NULL,0,NULL,NULL,2,'a:0:{}',NULL,'class=\"btn btn-default\"',NULL,NULL,1,0,NULL,NULL);
/*!40000 ALTER TABLE `form_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_results_1_test`
--

DROP TABLE IF EXISTS `form_results_1_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_results_1_test` (
  `submission_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`submission_id`),
  UNIQUE KEY `UNIQ_BE8A65A5E1FD49335FF69B7D` (`submission_id`,`form_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_results_1_test`
--

LOCK TABLES `form_results_1_test` WRITE;
/*!40000 ALTER TABLE `form_results_1_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_results_1_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `form_submissions`
--

DROP TABLE IF EXISTS `form_submissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `form_submissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `ip_id` int(11) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `tracking_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_submitted` datetime NOT NULL,
  `referer` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C80AF9E65FF69B7D` (`form_id`),
  KEY `IDX_C80AF9E6A03F5E9F` (`ip_id`),
  KEY `IDX_C80AF9E655458D` (`lead_id`),
  KEY `IDX_C80AF9E6C4663E4` (`page_id`),
  KEY `form_submission_tracking_search` (`tracking_id`),
  KEY `form_date_submitted` (`date_submitted`),
  CONSTRAINT `FK_C80AF9E655458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_C80AF9E65FF69B7D` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C80AF9E6A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_C80AF9E6C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `form_submissions`
--

LOCK TABLES `form_submissions` WRITE;
/*!40000 ALTER TABLE `form_submissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `form_submissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `forms`
--

DROP TABLE IF EXISTS `forms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cached_html` longtext COLLATE utf8_unicode_ci,
  `post_action` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `post_action_property` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `in_kiosk_mode` tinyint(1) DEFAULT NULL,
  `render_style` tinyint(1) DEFAULT NULL,
  `form_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FD3F1BF712469DE2` (`category_id`),
  CONSTRAINT `FK_FD3F1BF712469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `forms`
--

LOCK TABLES `forms` WRITE;
/*!40000 ALTER TABLE `forms` DISABLE KEYS */;
INSERT INTO `forms` VALUES (1,NULL,1,'2017-12-15 05:42:36',2,'Prabhu Leads Engage','2017-12-15 05:42:39',2,'Prabhu Leads Engage',NULL,NULL,'Prabhu Leads Engage','Test',NULL,'test','\n\n<style type=\"text/css\" scoped>\n    .mauticform_wrapper { max-width: 600px; margin: 10px auto; }\n    .mauticform-innerform {}\n    .mauticform-post-success {}\n    .mauticform-name { font-weight: bold; font-size: 1.5em; margin-bottom: 3px; }\n    .mauticform-description { margin-top: 2px; margin-bottom: 10px; }\n    .mauticform-error { margin-bottom: 10px; color: red; }\n    .mauticform-message { margin-bottom: 10px;color: green; }\n    .mauticform-row { display: block; margin-bottom: 20px; }\n    .mauticform-label { font-size: 1.1em; display: block; font-weight: bold; margin-bottom: 5px; }\n    .mauticform-row.mauticform-required .mauticform-label:after { color: #e32; content: \" *\"; display: inline; }\n    .mauticform-helpmessage { display: block; font-size: 0.9em; margin-bottom: 3px; }\n    .mauticform-errormsg { display: block; color: red; margin-top: 2px; }\n    .mauticform-selectbox, .mauticform-input, .mauticform-textarea { width: 100%; padding: 0.5em 0.5em; border: 1px solid #CCC; background: #fff; box-shadow: 0px 0px 0px #fff inset; border-radius: 4px; box-sizing: border-box; }\n    .mauticform-checkboxgrp-row {}\n    .mauticform-checkboxgrp-label { font-weight: normal; }\n    .mauticform-checkboxgrp-checkbox {}\n    .mauticform-radiogrp-row {}\n    .mauticform-radiogrp-label { font-weight: normal; }\n    .mauticform-radiogrp-radio {}\n    .mauticform-button-wrapper .mauticform-button.btn-default, .mauticform-pagebreak-wrapper .mauticform-pagebreak.btn-default { color: #5d6c7c;background-color: #ffffff;border-color: #dddddd;}\n    .mauticform-button-wrapper .mauticform-button, .mauticform-pagebreak-wrapper .mauticform-pagebreak { display: inline-block;margin-bottom: 0;font-weight: 600;text-align: center;vertical-align: middle;cursor: pointer;background-image: none;border: 1px solid transparent;white-space: nowrap;padding: 6px 12px;font-size: 13px;line-height: 1.3856;border-radius: 3px;-webkit-user-select: none;-moz-user-select: none;-ms-user-select: none;user-select: none;}\n    .mauticform-button-wrapper .mauticform-button.btn-default[disabled], .mauticform-pagebreak-wrapper .mauticform-pagebreak.btn-default[disabled] { background-color: #ffffff; border-color: #dddddd; opacity: 0.75; cursor: not-allowed; }\n    .mauticform-pagebreak-wrapper .mauticform-button-wrapper {  display: inline; }\n</style>\n<div id=\"mauticform_wrapper_test\" class=\"mauticform_wrapper\">\n    <form autocomplete=\"false\" role=\"form\" method=\"post\" action=\"http://192.168.1.38/mautic/form/submit?formId=1\" id=\"mauticform_test\"  data-mautic-form=\"test\" enctype=\"multipart/form-data\">\n        <div class=\"mauticform-error\" id=\"mauticform_test_error\"></div>\n        <div class=\"mauticform-message\" id=\"mauticform_test_message\"></div>\n        <div class=\"mauticform-innerform\">\n\n            \n          <div class=\"mauticform-page-wrapper mauticform-page-1\" data-mautic-form-page=\"1\">\n\n            <div id=\"mauticform_test_email\"  data-validate=\"email\" data-validation-type=\"email\" class=\"mauticform-row mauticform-email mauticform-field-1 mauticform-required\">\n                <label id=\"mauticform_label_test_email\" for=\"mauticform_input_test_email\" Your business email class=\"mauticform-label\">Email</label>\n                <input id=\"mauticform_input_test_email\" name=\"mauticform[email]\" value=\"\" class=\"mauticform-input\" type=\"email\" />\n                <span class=\"mauticform-errormsg\" style=\"display: none;\">This is required.</span>\n            </div>\n\n            <div id=\"mauticform_test_download_now\"  class=\"mauticform-row mauticform-button-wrapper mauticform-field-2\">\n                <button type=\"submit\" name=\"mauticform[download_now]\" id=\"mauticform_input_test_download_now\" name=\"mauticform[download_now]\" value=\"\" class=\"mauticform-button btn btn-default\" value=\"1\">Download Now</button>\n            </div>\n            </div>\n        </div>\n\n        <input type=\"hidden\" name=\"mauticform[formId]\" id=\"mauticform_test_id\" value=\"1\"/>\n        <input type=\"hidden\" name=\"mauticform[return]\" id=\"mauticform_test_return\" value=\"\"/>\n        <input type=\"hidden\" name=\"mauticform[formName]\" id=\"mauticform_test_name\" value=\"test\"/>\n\n        </form>\n</div>\n','message','Thank you',NULL,NULL,NULL,0,1,'standalone');
/*!40000 ALTER TABLE `forms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imports`
--

DROP TABLE IF EXISTS `imports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dir` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `original_file` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `line_count` int(11) NOT NULL,
  `inserted_count` int(11) NOT NULL,
  `updated_count` int(11) NOT NULL,
  `ignored_count` int(11) NOT NULL,
  `priority` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_started` datetime DEFAULT NULL,
  `date_ended` datetime DEFAULT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`),
  KEY `import_object` (`object`),
  KEY `import_status` (`status`),
  KEY `import_priority` (`priority`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imports`
--

LOCK TABLES `imports` WRITE;
/*!40000 ALTER TABLE `imports` DISABLE KEYS */;
/*!40000 ALTER TABLE `imports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `integration_entity`
--

DROP TABLE IF EXISTS `integration_entity`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `integration_entity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_added` datetime NOT NULL,
  `integration` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `integration_entity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `integration_entity_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `internal_entity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `internal_entity_id` int(11) DEFAULT NULL,
  `last_sync_date` datetime DEFAULT NULL,
  `internal` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `integration_external_entity` (`integration`,`integration_entity`,`integration_entity_id`),
  KEY `integration_internal_entity` (`integration`,`internal_entity`,`internal_entity_id`),
  KEY `integration_entity_match` (`integration`,`internal_entity`,`integration_entity`),
  KEY `integration_last_sync_date` (`integration`,`last_sync_date`),
  KEY `internal_integration_entity` (`internal_entity_id`,`integration_entity_id`,`internal_entity`,`integration_entity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `integration_entity`
--

LOCK TABLES `integration_entity` WRITE;
/*!40000 ALTER TABLE `integration_entity` DISABLE KEYS */;
/*!40000 ALTER TABLE `integration_entity` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_addresses`
--

DROP TABLE IF EXISTS `ip_addresses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_addresses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ip_details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `ip_search` (`ip_address`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_addresses`
--

LOCK TABLES `ip_addresses` WRITE;
/*!40000 ALTER TABLE `ip_addresses` DISABLE KEYS */;
INSERT INTO `ip_addresses` VALUES (1,'127.0.0.1','a:10:{s:4:\"city\";s:0:\"\";s:6:\"region\";s:0:\"\";s:7:\"zipcode\";s:0:\"\";s:7:\"country\";s:0:\"\";s:8:\"latitude\";s:0:\"\";s:9:\"longitude\";s:0:\"\";s:3:\"isp\";s:0:\"\";s:12:\"organization\";s:0:\"\";s:8:\"timezone\";s:0:\"\";s:5:\"extra\";s:0:\"\";}');
/*!40000 ALTER TABLE `ip_addresses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_categories`
--

DROP TABLE IF EXISTS `lead_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `manually_removed` tinyint(1) NOT NULL,
  `manually_added` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_12685DF412469DE2` (`category_id`),
  KEY `IDX_12685DF455458D` (`lead_id`),
  CONSTRAINT `FK_12685DF412469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_12685DF455458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_categories`
--

LOCK TABLES `lead_categories` WRITE;
/*!40000 ALTER TABLE `lead_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_companies_change_log`
--

DROP TABLE IF EXISTS `lead_companies_change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_companies_change_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A034C81B55458D` (`lead_id`),
  KEY `company_date_added` (`date_added`),
  CONSTRAINT `FK_A034C81B55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_companies_change_log`
--

LOCK TABLES `lead_companies_change_log` WRITE;
/*!40000 ALTER TABLE `lead_companies_change_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_companies_change_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_devices`
--

DROP TABLE IF EXISTS `lead_devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `client_info` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `device` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_os_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_os_shortname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_os_version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_os_platform` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_brand` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_model` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `device_fingerprint` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_48C912F455458D` (`lead_id`),
  KEY `date_added_search` (`date_added`),
  KEY `device_search` (`device`),
  KEY `device_os_name_search` (`device_os_name`),
  KEY `device_os_shortname_search` (`device_os_shortname`),
  KEY `device_os_version_search` (`device_os_version`),
  KEY `device_os_platform_search` (`device_os_platform`),
  KEY `device_brand_search` (`device_brand`),
  KEY `device_model_search` (`device_model`),
  KEY `device_fingerprint_search` (`device_fingerprint`),
  CONSTRAINT `FK_48C912F455458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_devices`
--

LOCK TABLES `lead_devices` WRITE;
/*!40000 ALTER TABLE `lead_devices` DISABLE KEYS */;
INSERT INTO `lead_devices` VALUES (1,1,'2017-12-11 07:33:40','a:6:{s:4:\"type\";s:7:\"browser\";s:4:\"name\";s:7:\"Firefox\";s:10:\"short_name\";s:2:\"FF\";s:7:\"version\";s:4:\"57.0\";s:6:\"engine\";s:5:\"Gecko\";s:14:\"engine_version\";s:0:\"\";}','desktop','Ubuntu','UBT','','x86','','',NULL),(2,3,'2017-12-12 10:53:44','a:6:{s:4:\"type\";s:7:\"browser\";s:4:\"name\";s:6:\"Chrome\";s:10:\"short_name\";s:2:\"CH\";s:7:\"version\";s:4:\"47.0\";s:6:\"engine\";s:5:\"Blink\";s:14:\"engine_version\";s:0:\"\";}','desktop','GNU/Linux','LIN','','x86','','',NULL);
/*!40000 ALTER TABLE `lead_devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_donotcontact`
--

DROP TABLE IF EXISTS `lead_donotcontact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_donotcontact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `reason` smallint(6) NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `comments` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `IDX_71DC0B1D55458D` (`lead_id`),
  KEY `dnc_reason_search` (`reason`),
  CONSTRAINT `FK_71DC0B1D55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_donotcontact`
--

LOCK TABLES `lead_donotcontact` WRITE;
/*!40000 ALTER TABLE `lead_donotcontact` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_donotcontact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_event_log`
--

DROP TABLE IF EXISTS `lead_event_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_event_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bundle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `object_id` int(11) DEFAULT NULL,
  `date_added` datetime NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`),
  KEY `lead_id_index` (`lead_id`),
  KEY `lead_object_index` (`object`,`object_id`),
  KEY `lead_timeline_index` (`bundle`,`object`,`action`,`object_id`),
  KEY `lead_date_added_index` (`date_added`),
  CONSTRAINT `FK_753AF2E55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_event_log`
--

LOCK TABLES `lead_event_log` WRITE;
/*!40000 ALTER TABLE `lead_event_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_event_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_fields`
--

DROP TABLE IF EXISTS `lead_fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_fields` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `label` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `field_group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `default_value` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_required` tinyint(1) NOT NULL,
  `is_fixed` tinyint(1) NOT NULL,
  `is_visible` tinyint(1) NOT NULL,
  `is_short_visible` tinyint(1) NOT NULL,
  `is_listable` tinyint(1) NOT NULL,
  `is_publicly_updatable` tinyint(1) NOT NULL,
  `is_unique_identifer` tinyint(1) DEFAULT NULL,
  `field_order` int(11) DEFAULT NULL,
  `object` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `search_by_object` (`object`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_fields`
--

LOCK TABLES `lead_fields` WRITE;
/*!40000 ALTER TABLE `lead_fields` DISABLE KEYS */;
INSERT INTO `lead_fields` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Title','title','lookup','core',NULL,0,1,1,0,0,0,0,1,'lead','a:1:{s:4:\"list\";s:11:\"Mr|Mrs|Miss\";}'),(2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'First Name','firstname','text','core',NULL,0,1,1,1,0,0,0,2,'lead','a:0:{}'),(3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Last Name','lastname','text','core',NULL,0,1,1,1,0,0,0,3,'lead','a:0:{}'),(4,0,NULL,NULL,NULL,'2017-12-14 12:15:40',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Company','company','text','core',NULL,0,1,1,0,0,0,0,4,'lead','a:0:{}'),(5,0,NULL,NULL,NULL,'2017-12-14 12:15:53',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Position','position','text','core',NULL,0,1,1,0,0,0,0,5,'lead','a:0:{}'),(6,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Email','email','email','core',NULL,0,1,1,1,0,0,1,11,'lead','a:0:{}'),(7,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Mobile','mobile','tel','core',NULL,0,1,1,0,1,0,0,13,'lead','a:0:{}'),(8,0,NULL,NULL,NULL,'2017-12-14 12:18:53',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Phone','phone','tel','core',NULL,0,1,1,0,1,0,0,15,'lead','a:0:{}'),(9,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Points','points','number','core',NULL,0,1,1,0,0,0,0,17,'lead','a:0:{}'),(10,0,NULL,NULL,NULL,'2017-12-14 12:18:06',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Fax','fax','tel','core',NULL,0,0,1,0,1,0,0,19,'lead','a:0:{}'),(11,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Address Line 1','address1','text','core',NULL,0,1,1,0,1,0,0,21,'lead','a:0:{}'),(12,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Address Line 2','address2','text','core',NULL,0,1,1,0,1,0,0,23,'lead','a:0:{}'),(13,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'City','city','text','core',NULL,0,1,1,0,0,0,0,25,'lead','a:0:{}'),(14,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'State','state','region','core',NULL,0,1,1,0,0,0,0,27,'lead','a:0:{}'),(15,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Zip Code','zipcode','text','core',NULL,0,1,1,0,0,0,0,29,'lead','a:0:{}'),(16,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Country','country','country','core',NULL,0,1,1,0,0,0,0,31,'lead','a:0:{}'),(17,0,NULL,NULL,NULL,'2017-12-14 12:17:23',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Preferred Locale','preferred_locale','locale','core',NULL,0,1,1,0,1,0,0,32,'lead','a:0:{}'),(18,0,NULL,NULL,NULL,'2017-12-14 12:17:05',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Attribution Date','attribution_date','datetime','core',NULL,0,1,1,0,1,0,0,33,'lead','a:0:{}'),(19,0,NULL,NULL,NULL,'2017-12-14 12:17:06',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Attribution','attribution','number','core',NULL,0,1,1,0,1,0,0,34,'lead','a:2:{s:9:\"roundmode\";i:4;s:9:\"precision\";i:2;}'),(20,0,NULL,NULL,NULL,'2017-12-14 12:17:30',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Website','website','url','core',NULL,0,0,1,0,1,0,0,35,'lead','a:0:{}'),(21,0,NULL,NULL,NULL,'2017-12-14 12:22:31',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Facebook','facebook','text','social',NULL,0,0,1,0,1,0,0,36,'lead','a:0:{}'),(22,0,NULL,NULL,NULL,'2017-12-14 12:22:32',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Foursquare','foursquare','text','social',NULL,0,0,1,0,1,0,0,37,'lead','a:0:{}'),(23,0,NULL,NULL,NULL,'2017-12-14 12:22:33',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Google+','googleplus','text','social',NULL,0,0,1,0,1,0,0,38,'lead','a:0:{}'),(24,0,NULL,NULL,NULL,'2017-12-14 12:22:34',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Instagram','instagram','text','social',NULL,0,0,1,0,1,0,0,39,'lead','a:0:{}'),(25,0,NULL,NULL,NULL,'2017-12-14 12:22:35',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'LinkedIn','linkedin','text','social',NULL,0,0,1,0,1,0,0,40,'lead','a:0:{}'),(26,0,NULL,NULL,NULL,'2017-12-14 12:22:36',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Skype','skype','text','social',NULL,0,0,1,0,1,0,0,41,'lead','a:0:{}'),(27,0,NULL,NULL,NULL,'2017-12-14 12:22:37',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Twitter','twitter','text','social',NULL,0,0,1,0,1,0,0,42,'lead','a:0:{}'),(28,0,NULL,NULL,NULL,'2017-12-14 12:15:43',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Address 1','companyaddress1','text','core',NULL,0,1,1,0,1,0,0,6,'company','a:0:{}'),(29,0,NULL,NULL,NULL,'2017-12-14 12:19:19',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Address 2','companyaddress2','text','core',NULL,0,1,1,0,1,0,0,7,'company','a:0:{}'),(30,0,NULL,NULL,NULL,'2017-12-14 12:19:20',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Company Email','companyemail','email','core',NULL,0,1,1,0,0,0,1,8,'company','a:0:{}'),(31,0,NULL,NULL,NULL,'2017-12-14 12:19:21',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Phone','companyphone','tel','core',NULL,0,1,1,0,1,0,0,9,'company','a:0:{}'),(32,0,NULL,NULL,NULL,'2017-12-14 12:19:22',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'City','companycity','text','core',NULL,0,1,1,0,1,0,0,10,'company','a:0:{}'),(33,0,NULL,NULL,NULL,'2017-12-14 12:19:13',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'State','companystate','region','core',NULL,0,1,1,0,0,0,0,12,'company','a:0:{}'),(34,0,NULL,NULL,NULL,'2017-12-14 12:19:12',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Zip Code','companyzipcode','text','core',NULL,0,1,1,0,1,0,0,14,'company','a:0:{}'),(35,0,NULL,NULL,NULL,'2017-12-14 12:19:28',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Country','companycountry','country','core',NULL,0,1,1,0,0,0,0,16,'company','a:0:{}'),(36,0,NULL,NULL,NULL,'2017-12-14 12:19:30',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Company Name','companyname','text','core',NULL,1,1,1,0,0,0,0,18,'company','a:0:{}'),(37,0,NULL,NULL,NULL,'2017-12-14 12:19:36',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Website','companywebsite','url','core',NULL,0,1,1,0,1,0,0,20,'company','a:0:{}'),(38,0,NULL,NULL,NULL,'2017-12-14 12:19:41',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Number of Employees','companynumber_of_employees','number','professional',NULL,0,0,1,0,0,0,0,22,'company','a:2:{s:9:\"roundmode\";i:4;s:9:\"precision\";i:0;}'),(39,0,NULL,NULL,NULL,'2017-12-14 12:19:42',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Fax','companyfax','tel','professional',NULL,0,0,1,0,1,0,0,24,'company','a:0:{}'),(40,0,NULL,NULL,NULL,'2017-12-14 12:19:44',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Annual Revenue','companyannual_revenue','number','professional',NULL,0,0,1,0,1,0,0,26,'company','a:2:{s:9:\"roundmode\";i:4;s:9:\"precision\";i:2;}'),(41,0,NULL,NULL,NULL,'2017-12-14 12:19:46',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Industry','companyindustry','select','professional',NULL,0,1,1,0,0,0,0,28,'company','a:1:{s:4:\"list\";s:349:\"Agriculture|Apparel|Banking|Biotechnology|Chemicals|Communications|Construction|Education|Electronics|Energy|Engineering|Entertainment|Environmental|Finance|Food & Beverage|Government|Healthcare|Hospitality|Insurance|Machinery|Manufacturing|Media|Not for Profit|Recreation|Retail|Shipping|Technology|Telecommunications|Transportation|Utilities|Other\";}'),(42,0,NULL,NULL,NULL,'2017-12-14 12:19:49',1,'Sadmin LeadsEngage',NULL,NULL,NULL,'Description','companydescription','text','professional',NULL,0,1,1,0,0,0,0,30,'company','a:0:{}');
/*!40000 ALTER TABLE `lead_fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_frequencyrules`
--

DROP TABLE IF EXISTS `lead_frequencyrules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_frequencyrules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `frequency_number` smallint(6) DEFAULT NULL,
  `frequency_time` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `preferred_channel` tinyint(1) NOT NULL,
  `pause_from_date` datetime DEFAULT NULL,
  `pause_to_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AA8A57F455458D` (`lead_id`),
  KEY `channel_frequency` (`channel`),
  CONSTRAINT `FK_AA8A57F455458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_frequencyrules`
--

LOCK TABLES `lead_frequencyrules` WRITE;
/*!40000 ALTER TABLE `lead_frequencyrules` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_frequencyrules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_ips_xref`
--

DROP TABLE IF EXISTS `lead_ips_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_ips_xref` (
  `lead_id` int(11) NOT NULL,
  `ip_id` int(11) NOT NULL,
  PRIMARY KEY (`lead_id`,`ip_id`),
  KEY `IDX_9EED7E6655458D` (`lead_id`),
  KEY `IDX_9EED7E66A03F5E9F` (`ip_id`),
  CONSTRAINT `FK_9EED7E6655458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_9EED7E66A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_ips_xref`
--

LOCK TABLES `lead_ips_xref` WRITE;
/*!40000 ALTER TABLE `lead_ips_xref` DISABLE KEYS */;
INSERT INTO `lead_ips_xref` VALUES (1,1);
/*!40000 ALTER TABLE `lead_ips_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_lists`
--

DROP TABLE IF EXISTS `lead_lists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_lists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `filters` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `is_global` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_lists`
--

LOCK TABLES `lead_lists` WRITE;
/*!40000 ALTER TABLE `lead_lists` DISABLE KEYS */;
INSERT INTO `lead_lists` VALUES (1,1,'2017-12-14 10:56:51',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,'Prabhu Leads Engage','Test',NULL,'test','a:0:{}',1);
/*!40000 ALTER TABLE `lead_lists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_lists_leads`
--

DROP TABLE IF EXISTS `lead_lists_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_lists_leads` (
  `leadlist_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `manually_removed` tinyint(1) NOT NULL,
  `manually_added` tinyint(1) NOT NULL,
  PRIMARY KEY (`leadlist_id`,`lead_id`),
  KEY `IDX_F5F47C7CB9FC8874` (`leadlist_id`),
  KEY `IDX_F5F47C7C55458D` (`lead_id`),
  CONSTRAINT `FK_F5F47C7C55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F5F47C7CB9FC8874` FOREIGN KEY (`leadlist_id`) REFERENCES `lead_lists` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_lists_leads`
--

LOCK TABLES `lead_lists_leads` WRITE;
/*!40000 ALTER TABLE `lead_lists_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_lists_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_notes`
--

DROP TABLE IF EXISTS `lead_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` longtext COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_67FC6B0355458D` (`lead_id`),
  CONSTRAINT `FK_67FC6B0355458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_notes`
--

LOCK TABLES `lead_notes` WRITE;
/*!40000 ALTER TABLE `lead_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_points_change_log`
--

DROP TABLE IF EXISTS `lead_points_change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_points_change_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `ip_id` int(11) NOT NULL,
  `type` tinytext COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delta` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_949C2CCC55458D` (`lead_id`),
  KEY `IDX_949C2CCCA03F5E9F` (`ip_id`),
  KEY `point_date_added` (`date_added`),
  CONSTRAINT `FK_949C2CCC55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_949C2CCCA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_points_change_log`
--

LOCK TABLES `lead_points_change_log` WRITE;
/*!40000 ALTER TABLE `lead_points_change_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_points_change_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_stages_change_log`
--

DROP TABLE IF EXISTS `lead_stages_change_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_stages_change_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `action_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_73B42EF355458D` (`lead_id`),
  KEY `IDX_73B42EF32298D193` (`stage_id`),
  CONSTRAINT `FK_73B42EF32298D193` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_73B42EF355458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_stages_change_log`
--

LOCK TABLES `lead_stages_change_log` WRITE;
/*!40000 ALTER TABLE `lead_stages_change_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_stages_change_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_tags`
--

DROP TABLE IF EXISTS `lead_tags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lead_tag_search` (`tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_tags`
--

LOCK TABLES `lead_tags` WRITE;
/*!40000 ALTER TABLE `lead_tags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_tags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_tags_xref`
--

DROP TABLE IF EXISTS `lead_tags_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_tags_xref` (
  `lead_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`lead_id`,`tag_id`),
  KEY `IDX_F2E51EB655458D` (`lead_id`),
  KEY `IDX_F2E51EB6BAD26311` (`tag_id`),
  CONSTRAINT `FK_F2E51EB655458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F2E51EB6BAD26311` FOREIGN KEY (`tag_id`) REFERENCES `lead_tags` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_tags_xref`
--

LOCK TABLES `lead_tags_xref` WRITE;
/*!40000 ALTER TABLE `lead_tags_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_tags_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lead_utmtags`
--

DROP TABLE IF EXISTS `lead_utmtags`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lead_utmtags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  `query` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `referer` longtext COLLATE utf8_unicode_ci,
  `remote_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` longtext COLLATE utf8_unicode_ci,
  `utm_campaign` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utm_content` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utm_medium` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utm_source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `utm_term` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C51BCB8D55458D` (`lead_id`),
  CONSTRAINT `FK_C51BCB8D55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lead_utmtags`
--

LOCK TABLES `lead_utmtags` WRITE;
/*!40000 ALTER TABLE `lead_utmtags` DISABLE KEYS */;
/*!40000 ALTER TABLE `lead_utmtags` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `leads`
--

DROP TABLE IF EXISTS `leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `leads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner_id` int(11) DEFAULT NULL,
  `stage_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `points` int(11) NOT NULL,
  `last_active` datetime DEFAULT NULL,
  `internal` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `social_cache` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `date_identified` datetime DEFAULT NULL,
  `preferred_profile_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zipcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preferred_locale` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attribution_date` datetime DEFAULT NULL COMMENT '(DC2Type:datetime)',
  `attribution` double DEFAULT NULL,
  `website` longtext COLLATE utf8_unicode_ci,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foursquare` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `googleplus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_179045527E3C61F9` (`owner_id`),
  KEY `IDX_179045522298D193` (`stage_id`),
  KEY `lead_date_added` (`date_added`),
  KEY `title_search` (`title`),
  KEY `firstname_search` (`firstname`),
  KEY `lastname_search` (`lastname`),
  KEY `company_search` (`company`),
  KEY `position_search` (`position`),
  KEY `email_search` (`email`),
  KEY `mobile_search` (`mobile`),
  KEY `phone_search` (`phone`),
  KEY `points_search` (`points`),
  KEY `fax_search` (`fax`),
  KEY `address1_search` (`address1`),
  KEY `address2_search` (`address2`),
  KEY `city_search` (`city`),
  KEY `state_search` (`state`),
  KEY `zipcode_search` (`zipcode`),
  KEY `country_search` (`country`),
  KEY `preferred_locale_search` (`preferred_locale`),
  KEY `attribution_date_search` (`attribution_date`),
  KEY `attribution_search` (`attribution`),
  KEY `facebook_search` (`facebook`),
  KEY `foursquare_search` (`foursquare`),
  KEY `googleplus_search` (`googleplus`),
  KEY `instagram_search` (`instagram`),
  KEY `linkedin_search` (`linkedin`),
  KEY `skype_search` (`skype`),
  KEY `twitter_search` (`twitter`),
  KEY `contact_attribution` (`attribution`,`attribution_date`),
  KEY `date_added_country_index` (`date_added`,`country`),
  CONSTRAINT `FK_179045522298D193` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_179045527E3C61F9` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `leads`
--

LOCK TABLES `leads` WRITE;
/*!40000 ALTER TABLE `leads` DISABLE KEYS */;
INSERT INTO `leads` VALUES (1,NULL,NULL,1,'2017-12-11 07:33:40',NULL,' ','2017-12-11 07:33:40',NULL,' ',NULL,NULL,NULL,0,'2017-12-11 07:33:40','a:0:{}','a:0:{}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(3,NULL,NULL,1,'2017-12-12 10:53:43',NULL,' ','2017-12-12 11:48:39',NULL,' ',NULL,NULL,NULL,0,'2017-12-12 11:48:39','a:0:{}','a:0:{}',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(5,1,NULL,1,'2017-12-15 05:55:34',1,'Sadmin LeadsEngage','2017-12-15 05:56:49',1,'Sadmin LeadsEngage',NULL,NULL,'Sadmin LeadsEngage',0,NULL,'a:0:{}','a:0:{}','2017-12-15 05:55:34','gravatar','','Suresh','Shamalan',NULL,NULL,'suresh@cratio.com',NULL,'','','','','','',NULL,'',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_channels`
--

DROP TABLE IF EXISTS `message_channels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_channels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `message_id` int(11) NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `properties` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:json_array)',
  `is_enabled` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `channel_index` (`message_id`,`channel`),
  KEY `IDX_FA3226A7537A1329` (`message_id`),
  KEY `channel_entity_index` (`channel`,`channel_id`),
  KEY `channel_enabled_index` (`channel`,`is_enabled`),
  CONSTRAINT `FK_FA3226A7537A1329` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_channels`
--

LOCK TABLES `message_channels` WRITE;
/*!40000 ALTER TABLE `message_channels` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_channels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message_queue`
--

DROP TABLE IF EXISTS `message_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `event_id` int(11) DEFAULT NULL,
  `lead_id` int(11) NOT NULL,
  `channel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `channel_id` int(11) NOT NULL,
  `priority` smallint(6) NOT NULL,
  `max_attempts` smallint(6) NOT NULL,
  `attempts` smallint(6) NOT NULL,
  `success` tinyint(1) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_published` datetime DEFAULT NULL,
  `scheduled_date` datetime DEFAULT NULL,
  `last_attempt` datetime DEFAULT NULL,
  `date_sent` datetime DEFAULT NULL,
  `options` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_805B808871F7E88B` (`event_id`),
  KEY `IDX_805B808855458D` (`lead_id`),
  KEY `message_status_search` (`status`),
  KEY `message_date_sent` (`date_sent`),
  KEY `message_scheduled_date` (`scheduled_date`),
  KEY `message_priority` (`priority`),
  KEY `message_success` (`success`),
  KEY `message_channel_search` (`channel`,`channel_id`),
  CONSTRAINT `FK_805B808855458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_805B808871F7E88B` FOREIGN KEY (`event_id`) REFERENCES `campaign_events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message_queue`
--

LOCK TABLES `message_queue` WRITE;
/*!40000 ALTER TABLE `message_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `message_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_DB021E9612469DE2` (`category_id`),
  KEY `date_message_added` (`date_added`),
  CONSTRAINT `FK_DB021E9612469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitor_post_count`
--

DROP TABLE IF EXISTS `monitor_post_count`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitor_post_count` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `monitor_id` int(11) DEFAULT NULL,
  `post_date` date NOT NULL,
  `post_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E3AC20CA4CE1C902` (`monitor_id`),
  CONSTRAINT `FK_E3AC20CA4CE1C902` FOREIGN KEY (`monitor_id`) REFERENCES `monitoring` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitor_post_count`
--

LOCK TABLES `monitor_post_count` WRITE;
/*!40000 ALTER TABLE `monitor_post_count` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitor_post_count` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring`
--

DROP TABLE IF EXISTS `monitoring`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitoring` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lists` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `network_type` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `revision` int(11) NOT NULL,
  `stats` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `properties` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BA4F975D12469DE2` (`category_id`),
  CONSTRAINT `FK_BA4F975D12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring`
--

LOCK TABLES `monitoring` WRITE;
/*!40000 ALTER TABLE `monitoring` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `monitoring_leads`
--

DROP TABLE IF EXISTS `monitoring_leads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `monitoring_leads` (
  `monitor_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `date_added` datetime NOT NULL,
  PRIMARY KEY (`monitor_id`,`lead_id`),
  KEY `IDX_45207A4A4CE1C902` (`monitor_id`),
  KEY `IDX_45207A4A55458D` (`lead_id`),
  CONSTRAINT `FK_45207A4A4CE1C902` FOREIGN KEY (`monitor_id`) REFERENCES `monitoring` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_45207A4A55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `monitoring_leads`
--

LOCK TABLES `monitoring_leads` WRITE;
/*!40000 ALTER TABLE `monitoring_leads` DISABLE KEYS */;
/*!40000 ALTER TABLE `monitoring_leads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notifications`
--

DROP TABLE IF EXISTS `notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `type` varchar(25) COLLATE utf8_unicode_ci DEFAULT NULL,
  `header` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime NOT NULL,
  `icon_class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_read` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_6000B0D3A76ED395` (`user_id`),
  KEY `notification_read_status` (`is_read`),
  KEY `notification_type` (`type`),
  KEY `notification_user_read_status` (`is_read`,`user_id`),
  CONSTRAINT `FK_6000B0D3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notifications`
--

LOCK TABLES `notifications` WRITE;
/*!40000 ALTER TABLE `notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth1_access_tokens`
--

DROP TABLE IF EXISTS `oauth1_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth1_access_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` bigint(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C33AC86237FDBD6D` (`consumer_id`),
  KEY `IDX_C33AC862A76ED395` (`user_id`),
  KEY `oauth1_access_token_search` (`token`),
  CONSTRAINT `FK_C33AC86237FDBD6D` FOREIGN KEY (`consumer_id`) REFERENCES `oauth1_consumers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C33AC862A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth1_access_tokens`
--

LOCK TABLES `oauth1_access_tokens` WRITE;
/*!40000 ALTER TABLE `oauth1_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth1_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth1_consumers`
--

DROP TABLE IF EXISTS `oauth1_consumers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth1_consumers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `consumer_key` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `consumer_secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `callback` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `consumer_search` (`consumer_key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth1_consumers`
--

LOCK TABLES `oauth1_consumers` WRITE;
/*!40000 ALTER TABLE `oauth1_consumers` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth1_consumers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth1_nonces`
--

DROP TABLE IF EXISTS `oauth1_nonces`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth1_nonces` (
  `nonce` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`nonce`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth1_nonces`
--

LOCK TABLES `oauth1_nonces` WRITE;
/*!40000 ALTER TABLE `oauth1_nonces` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth1_nonces` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth1_request_tokens`
--

DROP TABLE IF EXISTS `oauth1_request_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth1_request_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `consumer_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` bigint(20) NOT NULL,
  `verifier` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_80F3C6EA37FDBD6D` (`consumer_id`),
  KEY `IDX_80F3C6EAA76ED395` (`user_id`),
  KEY `oauth1_request_token_search` (`token`),
  CONSTRAINT `FK_80F3C6EA37FDBD6D` FOREIGN KEY (`consumer_id`) REFERENCES `oauth1_consumers` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_80F3C6EAA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth1_request_tokens`
--

LOCK TABLES `oauth1_request_tokens` WRITE;
/*!40000 ALTER TABLE `oauth1_request_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth1_request_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth2_accesstokens`
--

DROP TABLE IF EXISTS `oauth2_accesstokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth2_accesstokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` bigint(20) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_3A18CA5A5F37A13B` (`token`),
  KEY `IDX_3A18CA5A19EB6921` (`client_id`),
  KEY `IDX_3A18CA5AA76ED395` (`user_id`),
  KEY `oauth2_access_token_search` (`token`),
  CONSTRAINT `FK_3A18CA5A19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3A18CA5AA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth2_accesstokens`
--

LOCK TABLES `oauth2_accesstokens` WRITE;
/*!40000 ALTER TABLE `oauth2_accesstokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth2_accesstokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth2_authcodes`
--

DROP TABLE IF EXISTS `oauth2_authcodes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth2_authcodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` bigint(20) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_uri` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D2B4847B5F37A13B` (`token`),
  KEY `IDX_D2B4847B19EB6921` (`client_id`),
  KEY `IDX_D2B4847BA76ED395` (`user_id`),
  CONSTRAINT `FK_D2B4847B19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_D2B4847BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth2_authcodes`
--

LOCK TABLES `oauth2_authcodes` WRITE;
/*!40000 ALTER TABLE `oauth2_authcodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth2_authcodes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth2_clients`
--

DROP TABLE IF EXISTS `oauth2_clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth2_clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `random_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `redirect_uris` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `allowed_grant_types` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `client_id_search` (`random_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth2_clients`
--

LOCK TABLES `oauth2_clients` WRITE;
/*!40000 ALTER TABLE `oauth2_clients` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth2_clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth2_refreshtokens`
--

DROP TABLE IF EXISTS `oauth2_refreshtokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth2_refreshtokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expires_at` bigint(20) DEFAULT NULL,
  `scope` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_328C5B1B5F37A13B` (`token`),
  KEY `IDX_328C5B1B19EB6921` (`client_id`),
  KEY `IDX_328C5B1BA76ED395` (`user_id`),
  KEY `oauth2_refresh_token_search` (`token`),
  CONSTRAINT `FK_328C5B1B19EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_328C5B1BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth2_refreshtokens`
--

LOCK TABLES `oauth2_refreshtokens` WRITE;
/*!40000 ALTER TABLE `oauth2_refreshtokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth2_refreshtokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `oauth2_user_client_xref`
--

DROP TABLE IF EXISTS `oauth2_user_client_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `oauth2_user_client_xref` (
  `client_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`client_id`,`user_id`),
  KEY `IDX_1AE3441319EB6921` (`client_id`),
  KEY `IDX_1AE34413A76ED395` (`user_id`),
  CONSTRAINT `FK_1AE3441319EB6921` FOREIGN KEY (`client_id`) REFERENCES `oauth2_clients` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_1AE34413A76ED395` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `oauth2_user_client_xref`
--

LOCK TABLES `oauth2_user_client_xref` WRITE;
/*!40000 ALTER TABLE `oauth2_user_client_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `oauth2_user_client_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_hits`
--

DROP TABLE IF EXISTS `page_hits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `page_id` int(11) DEFAULT NULL,
  `redirect_id` int(11) DEFAULT NULL,
  `email_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `ip_id` int(11) NOT NULL,
  `device_id` int(11) DEFAULT NULL,
  `date_hit` datetime NOT NULL,
  `date_left` datetime DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` int(11) NOT NULL,
  `referer` longtext COLLATE utf8_unicode_ci,
  `url` longtext COLLATE utf8_unicode_ci,
  `url_title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_agent` longtext COLLATE utf8_unicode_ci,
  `remote_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `page_language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser_languages` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `tracking_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `query` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_9D4B70F1C4663E4` (`page_id`),
  KEY `IDX_9D4B70F1B42D874D` (`redirect_id`),
  KEY `IDX_9D4B70F1A832C1C9` (`email_id`),
  KEY `IDX_9D4B70F155458D` (`lead_id`),
  KEY `IDX_9D4B70F1A03F5E9F` (`ip_id`),
  KEY `IDX_9D4B70F194A4C7D4` (`device_id`),
  KEY `page_hit_tracking_search` (`tracking_id`),
  KEY `page_hit_code_search` (`code`),
  KEY `page_hit_source_search` (`source`,`source_id`),
  KEY `page_date_hit` (`date_hit`),
  KEY `date_hit_left_index` (`date_hit`,`date_left`),
  CONSTRAINT `FK_9D4B70F155458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9D4B70F194A4C7D4` FOREIGN KEY (`device_id`) REFERENCES `lead_devices` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9D4B70F1A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_9D4B70F1A832C1C9` FOREIGN KEY (`email_id`) REFERENCES `emails` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9D4B70F1B42D874D` FOREIGN KEY (`redirect_id`) REFERENCES `page_redirects` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_9D4B70F1C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_hits`
--

LOCK TABLES `page_hits` WRITE;
/*!40000 ALTER TABLE `page_hits` DISABLE KEYS */;
INSERT INTO `page_hits` VALUES (1,NULL,NULL,NULL,1,1,1,'2017-12-11 07:33:40',NULL,'','','','','',404,NULL,'http://localhost/mautic/index_dev.php/slogin',NULL,'Mozilla/5.0 (X11; Ubuntu; Linux i686; rv:57.0) Gecko/20100101 Firefox/57.0',NULL,NULL,'a:2:{i:0;s:5:\"en-US\";i:1;s:8:\"en;q=0.5\";}','b0e33f8f04455101da3d0433e19586fbc7c4209e',NULL,NULL,'a:1:{s:8:\"page_url\";s:44:\"http://localhost/mautic/index_dev.php/slogin\";}'),(2,NULL,NULL,NULL,3,1,2,'2017-12-12 10:53:44','2017-12-12 10:56:52','','','','','',404,NULL,'http://localhost/mautic//s/login',NULL,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',NULL,NULL,'a:2:{i:0;s:5:\"en-US\";i:1;s:8:\"en;q=0.8\";}','e49860a3909d117aa3a782e77d92a8c63356c499',NULL,NULL,'a:1:{s:8:\"page_url\";s:32:\"http://localhost/mautic//s/login\";}'),(3,NULL,NULL,NULL,3,1,2,'2017-12-12 10:56:52','2017-12-12 10:57:53','','','','','',404,NULL,'http://localhost/mautic//s/login',NULL,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',NULL,NULL,'a:2:{i:0;s:5:\"en-US\";i:1;s:8:\"en;q=0.8\";}','e49860a3909d117aa3a782e77d92a8c63356c499',NULL,NULL,'a:1:{s:8:\"page_url\";s:32:\"http://localhost/mautic//s/login\";}'),(4,NULL,NULL,NULL,3,1,2,'2017-12-12 10:57:53',NULL,'','','','','',404,NULL,'http://localhost/mautic//s/login',NULL,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',NULL,NULL,'a:2:{i:0;s:5:\"en-US\";i:1;s:8:\"en;q=0.8\";}','e49860a3909d117aa3a782e77d92a8c63356c499',NULL,NULL,'a:1:{s:8:\"page_url\";s:32:\"http://localhost/mautic//s/login\";}'),(5,NULL,NULL,NULL,3,1,2,'2017-12-12 11:48:39',NULL,'','','','','',404,NULL,'http://localhost/mautic/i/s/login',NULL,'Mozilla/5.0 (X11; Linux i686) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/47.0.2526.106 Safari/537.36',NULL,NULL,'a:2:{i:0;s:5:\"en-US\";i:1;s:8:\"en;q=0.8\";}','e49860a3909d117aa3a782e77d92a8c63356c499',NULL,NULL,'a:1:{s:8:\"page_url\";s:33:\"http://localhost/mautic/i/s/login\";}');
/*!40000 ALTER TABLE `page_hits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `page_redirects`
--

DROP TABLE IF EXISTS `page_redirects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `page_redirects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_id` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci NOT NULL,
  `hits` int(11) NOT NULL,
  `unique_hits` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `page_redirects`
--

LOCK TABLES `page_redirects` WRITE;
/*!40000 ALTER TABLE `page_redirects` DISABLE KEYS */;
/*!40000 ALTER TABLE `page_redirects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `translation_parent_id` int(11) DEFAULT NULL,
  `variant_parent_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `template` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `custom_html` longtext COLLATE utf8_unicode_ci,
  `content` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `hits` int(11) NOT NULL,
  `unique_hits` int(11) NOT NULL,
  `variant_hits` int(11) NOT NULL,
  `revision` int(11) NOT NULL,
  `meta_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_type` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `redirect_url` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_preference_center` tinyint(1) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `variant_settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `variant_start_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2074E57512469DE2` (`category_id`),
  KEY `IDX_2074E5759091A2FB` (`translation_parent_id`),
  KEY `IDX_2074E57591861123` (`variant_parent_id`),
  KEY `page_alias_search` (`alias`),
  CONSTRAINT `FK_2074E57512469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_2074E5759091A2FB` FOREIGN KEY (`translation_parent_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2074E57591861123` FOREIGN KEY (`variant_parent_id`) REFERENCES `pages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
INSERT INTO `pages` VALUES (1,NULL,NULL,NULL,1,'2017-12-15 05:51:12',2,'Prabhu Leads Engage','2017-12-15 05:51:31',2,'Prabhu Leads Engage',NULL,NULL,'Prabhu Leads Engage','Test 1','test-1','fresh-left','<!DOCTYPE html>\n<html>\n    <head>\n                <title>{pagetitle}</title>\n        <meta name=\"description\" content=\"{pagemetadescription}\" />\n        <meta charset=\"UTF-8\" />\n                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n        <link rel=\"stylesheet\" href=\"/mautic/themes/fresh-left/css/style.css\" type=\"text/css\" />\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/jquery.min.js\"></script>\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/parallax-element.js\"></script>\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/extras.js\"></script>\n    </head>\n    <body id=\"bodyTag\">\n        \n        <header data-section-wrapper=\"1\" id=\"top\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_white.svg\" />\n      </div>\n    </div>\n  </div>\n</header>\n<section data-section-wrapper=\"1\" class=\"hero\" style=\"background-color: #00bf9a;\">\n  <div data-section=\"1\">\n    <div class=\"background\">\n      <div data-slot-container=\"1\">\n        <div data-slot=\"text\">\n        <img class=\"background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n        </div>\n      </div>\n    </div>\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"c6 form-container\">\n          <div class=\"form white\">\n            <h2>H2 Call-To-Action</h2>\n            <div>\n              <img src=\"/mautic/themes/fresh-left/assets/img_form-demo.jpg\" style=\"margin: 0 auto;\" />\n              <!-- PLACE FORM HERE -->\n            </div>\n          </div>\n        </div>\n        <div class=\"c6 hero-details-container\">\n          <div class=\"hero-details\">\n            <h1>H1 Header</h1>\n            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n            <h2>H2 Customers</h2>\n            <div class=\"customers\">\n              <div class=\"logos\">\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-i.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-ii.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-iii.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-iv.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-v.svg\" />\n                </div>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"details\" style=\"background-color: #f5f5f5;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Details</h2>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"speakers\" style=\"background-color: #f5f5f5;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Speakers</h2>\n        <div class=\"speakers-container\">\n          <div class=\"speaker\">\n            <div class=\"speaker-image\">\n              <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n            </div>\n            <div class=\"speaker-details\">\n              <h3>H3 Name</h3>\n              <p>Details about speaker</p>\n              <p>More details about speaker</p>\n            </div>\n          </div>\n          <div class=\"speaker\">\n            <div class=\"speaker-image\">\n              <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n            </div>\n            <div class=\"speaker-details\">\n              <h3>H3 Name</h3>\n              <p>Details about speaker</p>\n              <p>More details about speaker</p>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"grid\" style=\"background-color: #00bf9a;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Grid</h2>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" style=\"background-color: #3f3f45;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2 class=\"green\">H2 About Company</h2>\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"testimonials\" style=\"background-color: #3f3f45;\">\n  <div data-slot=\"text\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"testimonials-container\">\n          <div class=\"testimonial\">\n            <div class=\"c12 testimonial-quote\">\n              <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula.”</p>\n            </div>\n            <div class=\"testimonial-details\">\n              <div class=\"c5\">\n                  <div class=\"speaker-image\">\n                      <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n                  </div>\n              </div>\n              <div class=\"c7 details\">\n                <h3>H3 Name</h3>\n                <p>Details about speaker</p>\n                <p>More details about speaker</p>\n              </div>\n            </div>\n          </div>\n          <div class=\"testimonial\">\n            <div class=\"c12 testimonial-quote\">\n              <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula.”</p>\n            </div>\n            <div class=\"testimonial-details\">\n              <div class=\"c5\">\n                  <div class=\"speaker-image\">\n                      <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n                  </div>\n              </div>\n              <div class=\"c7 details\">\n                <h3>H3 Name</h3>\n                <p>Details about speaker</p>\n                <p>More details about speaker</p>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" style=\"background-color: #00bf9a;\" class=\"thank-you\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h1>H1 Thank You</h1>\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n        <a class=\"button\">Get Your Asset</a>\n      </div>\n    </div>\n  </div>\n</section>\n<footer data-section-wrapper=\"1\" id=\"bottom\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"c6 logo-container\">\n          <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_white.svg\" />\n        </div>\n        <div class=\"c6\">\n          <p class=\"copyright\">© Mautic 2017</p>\n        </div>\n      </div>\n    </div>\n  </div>\n</footer>\n        \n    </body>\n    <script type=\"text/javascript\">\n        if ( $( \".background-image\" ).length ) {\n            $(\'.background-image\').parallaxElement({\n                disableMobile: true,\n                defaultSpeed:  -0.2,\n            });\n        }\n    </script>\n</html>','a:0:{}',NULL,NULL,0,0,0,2,NULL,NULL,NULL,0,'en','a:0:{}',NULL),(2,NULL,NULL,NULL,1,'2017-12-15 06:20:22',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Test','test','fresh-left','<!DOCTYPE html>\n<html>\n    <head>\n                <title>{pagetitle}</title>\n        <meta name=\"description\" content=\"{pagemetadescription}\" />\n        <meta charset=\"UTF-8\" />\n                <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />\n        <link rel=\"stylesheet\" href=\"/mautic/themes/fresh-left/css/style.css\" type=\"text/css\" />\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/jquery.min.js\"></script>\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/parallax-element.js\"></script>\n        <script type=\"text/javascript\" src=\"/mautic/themes/fresh-left/js/extras.js\"></script>\n    </head>\n    <body id=\"bodyTag\">\n        \n        <header data-section-wrapper=\"1\" id=\"top\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_white.svg\" />\n      </div>\n    </div>\n  </div>\n</header>\n<section data-section-wrapper=\"1\" class=\"hero\" style=\"background-color: #00bf9a;\">\n  <div data-section=\"1\">\n    <div class=\"background\">\n      <div data-slot-container=\"1\">\n        <div data-slot=\"text\">\n        <img class=\"background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n        </div>\n      </div>\n    </div>\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"c6 form-container\">\n          <div class=\"form white\">\n            <h2>H2 Call-To-Action</h2>\n            <div>\n              <img src=\"/mautic/themes/fresh-left/assets/img_form-demo.jpg\" style=\"margin: 0 auto;\" />\n              <!-- PLACE FORM HERE -->\n            </div>\n          </div>\n        </div>\n        <div class=\"c6 hero-details-container\">\n          <div class=\"hero-details\">\n            <h1>H1 Header</h1>\n            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n            <h2>H2 Customers</h2>\n            <div class=\"customers\">\n              <div class=\"logos\">\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-i.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-ii.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-iii.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-iv.svg\" />\n                </div>\n                <div class=\"logo-container\">\n                  <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_demo-company-v.svg\" />\n                </div>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"details\" style=\"background-color: #f5f5f5;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Details</h2>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n        <div class=\"c3 detail\">\n          <p><strong>Detail:</strong> Lorem Ipsum</p>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"speakers\" style=\"background-color: #f5f5f5;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Speakers</h2>\n        <div class=\"speakers-container\">\n          <div class=\"speaker\">\n            <div class=\"speaker-image\">\n              <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n            </div>\n            <div class=\"speaker-details\">\n              <h3>H3 Name</h3>\n              <p>Details about speaker</p>\n              <p>More details about speaker</p>\n            </div>\n          </div>\n          <div class=\"speaker\">\n            <div class=\"speaker-image\">\n              <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n            </div>\n            <div class=\"speaker-details\">\n              <h3>H3 Name</h3>\n              <p>Details about speaker</p>\n              <p>More details about speaker</p>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"grid\" style=\"background-color: #00bf9a;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2>H2 Grid</h2>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n        <div class=\"grid-container\">\n          <div class=\"grid-item\">\n            <img class=\"grid-background-image\" src=\"/mautic/themes/fresh-left/assets/photo_hero-background.jpg\" />\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n          <div class=\"grid-item\">\n            <img class=\"icon\" src=\"/mautic/themes/fresh-left/assets/icon_grid.svg\" />\n            <h3>H3 Grid Item</h3>\n            <p>Grid item details</p>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" style=\"background-color: #3f3f45;\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h2 class=\"green\">H2 About Company</h2>\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" class=\"testimonials\" style=\"background-color: #3f3f45;\">\n  <div data-slot=\"text\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"testimonials-container\">\n          <div class=\"testimonial\">\n            <div class=\"c12 testimonial-quote\">\n              <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula.”</p>\n            </div>\n            <div class=\"testimonial-details\">\n              <div class=\"c5\">\n                  <div class=\"speaker-image\">\n                      <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n                  </div>\n              </div>\n              <div class=\"c7 details\">\n                <h3>H3 Name</h3>\n                <p>Details about speaker</p>\n                <p>More details about speaker</p>\n              </div>\n            </div>\n          </div>\n          <div class=\"testimonial\">\n            <div class=\"c12 testimonial-quote\">\n              <p>“Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula.”</p>\n            </div>\n            <div class=\"testimonial-details\">\n              <div class=\"c5\">\n                  <div class=\"speaker-image\">\n                      <img src=\"/mautic/themes/fresh-left/assets/photo_man.jpg\" />\n                  </div>\n              </div>\n              <div class=\"c7 details\">\n                <h3>H3 Name</h3>\n                <p>Details about speaker</p>\n                <p>More details about speaker</p>\n              </div>\n            </div>\n          </div>\n        </div>\n      </div>\n    </div>\n  </div>\n</section>\n<section data-section-wrapper=\"1\" style=\"background-color: #00bf9a;\" class=\"thank-you\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <h1>H1 Thank You</h1>\n        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed metus felis, convallis porta cursus vehicula, iaculis at erat. Suspendisse quis pulvinar ligula. Etiam sagittis, velit a cursus sollicitudin, enim ex vestibulum felis, ac finibus dui dui ac est.</p>\n        <a class=\"button\">Get Your Asset</a>\n      </div>\n    </div>\n  </div>\n</section>\n<footer data-section-wrapper=\"1\" id=\"bottom\">\n  <div data-section=\"1\">\n    <div class=\"container\" data-slot-container=\"1\">\n      <div data-slot=\"text\">\n        <div class=\"c6 logo-container\">\n          <img class=\"logo\" src=\"/mautic/themes/fresh-left/assets/logo_white.svg\" />\n        </div>\n        <div class=\"c6\">\n          <p class=\"copyright\">&copy; Mautic 2017</p>\n        </div>\n      </div>\n    </div>\n  </div>\n</footer>\n        \n    </body>\n    <script type=\"text/javascript\">\n        if ( $( \".background-image\" ).length ) {\n            $(\'.background-image\').parallaxElement({\n                disableMobile: true,\n                defaultSpeed:  -0.2,\n            });\n        }\n    </script>\n</html>','a:0:{}',NULL,NULL,0,0,0,1,NULL,NULL,NULL,0,'en','a:0:{}',NULL);
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `bundle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bitwise` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_perm` (`bundle`,`name`,`role_id`),
  KEY `IDX_2DEDCC6FD60322AC` (`role_id`),
  CONSTRAINT `FK_2DEDCC6FD60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES (29,2,'asset','categories',1024),(30,2,'asset','assets',1024),(31,2,'campaign','categories',1024),(32,2,'campaign','campaigns',1024),(33,2,'category','categories',1024),(34,2,'lead','leads',1024),(35,2,'lead','lists',1024),(36,2,'lead','fields',1024),(37,2,'lead','imports',1024),(38,2,'core','themes',1024),(39,2,'email','categories',1024),(40,2,'email','emails',1024),(41,2,'focus','categories',1024),(42,2,'focus','items',1024),(43,2,'form','categories',1024),(44,2,'form','forms',1024),(45,2,'page','categories',1024),(46,2,'page','pages',1024),(47,2,'page','preference_center',1024),(48,2,'point','categories',1024),(49,2,'point','points',1024),(50,2,'point','triggers',1024),(51,2,'report','reports',1024),(52,2,'sms','categories',1024),(53,2,'sms','smses',1024),(54,2,'user','users',1024);
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin_citrix_events`
--

DROP TABLE IF EXISTS `plugin_citrix_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugin_citrix_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) NOT NULL,
  `product` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `event_desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `event_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `event_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D77731055458D` (`lead_id`),
  KEY `citrix_event_email` (`product`,`email`),
  KEY `citrix_event_name` (`product`,`event_name`,`event_type`),
  KEY `citrix_event_type` (`product`,`event_type`,`event_date`),
  KEY `citrix_event_product` (`product`,`email`,`event_type`),
  KEY `citrix_event_product_name` (`product`,`email`,`event_type`,`event_name`),
  KEY `citrix_event_product_name_lead` (`product`,`event_type`,`event_name`,`lead_id`),
  KEY `citrix_event_product_type_lead` (`product`,`event_type`,`lead_id`),
  KEY `citrix_event_date` (`event_date`),
  CONSTRAINT `FK_D77731055458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin_citrix_events`
--

LOCK TABLES `plugin_citrix_events` WRITE;
/*!40000 ALTER TABLE `plugin_citrix_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugin_citrix_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin_crm_pipedrive_owners`
--

DROP TABLE IF EXISTS `plugin_crm_pipedrive_owners`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugin_crm_pipedrive_owners` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `owner_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email` (`email`),
  KEY `owner_id` (`owner_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin_crm_pipedrive_owners`
--

LOCK TABLES `plugin_crm_pipedrive_owners` WRITE;
/*!40000 ALTER TABLE `plugin_crm_pipedrive_owners` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugin_crm_pipedrive_owners` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugin_integration_settings`
--

DROP TABLE IF EXISTS `plugin_integration_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugin_integration_settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plugin_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `supported_features` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `api_keys` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `feature_settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_941A2CE0EC942BCF` (`plugin_id`),
  CONSTRAINT `FK_941A2CE0EC942BCF` FOREIGN KEY (`plugin_id`) REFERENCES `plugins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugin_integration_settings`
--

LOCK TABLES `plugin_integration_settings` WRITE;
/*!40000 ALTER TABLE `plugin_integration_settings` DISABLE KEYS */;
INSERT INTO `plugin_integration_settings` VALUES (1,NULL,'OneSignal',0,'a:4:{i:0;s:6:\"mobile\";i:1;s:20:\"landing_page_enabled\";i:2;s:28:\"welcome_notification_enabled\";i:3;s:21:\"tracking_page_enabled\";}','a:0:{}','a:0:{}'),(2,NULL,'Twilio',0,'a:0:{}','a:0:{}','a:0:{}');
/*!40000 ALTER TABLE `plugin_integration_settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plugins`
--

DROP TABLE IF EXISTS `plugins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plugins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `is_missing` tinyint(1) NOT NULL,
  `bundle` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_bundle` (`bundle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plugins`
--

LOCK TABLES `plugins` WRITE;
/*!40000 ALTER TABLE `plugins` DISABLE KEYS */;
/*!40000 ALTER TABLE `plugins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_lead_action_log`
--

DROP TABLE IF EXISTS `point_lead_action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_lead_action_log` (
  `point_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_fired` datetime NOT NULL,
  PRIMARY KEY (`point_id`,`lead_id`),
  KEY `IDX_6DF94A56C028CEA2` (`point_id`),
  KEY `IDX_6DF94A5655458D` (`lead_id`),
  KEY `IDX_6DF94A56A03F5E9F` (`ip_id`),
  CONSTRAINT `FK_6DF94A5655458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6DF94A56A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_6DF94A56C028CEA2` FOREIGN KEY (`point_id`) REFERENCES `points` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_lead_action_log`
--

LOCK TABLES `point_lead_action_log` WRITE;
/*!40000 ALTER TABLE `point_lead_action_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_lead_action_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_lead_event_log`
--

DROP TABLE IF EXISTS `point_lead_event_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_lead_event_log` (
  `event_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_fired` datetime NOT NULL,
  PRIMARY KEY (`event_id`,`lead_id`),
  KEY `IDX_C2A3BDBA71F7E88B` (`event_id`),
  KEY `IDX_C2A3BDBA55458D` (`lead_id`),
  KEY `IDX_C2A3BDBAA03F5E9F` (`ip_id`),
  CONSTRAINT `FK_C2A3BDBA55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C2A3BDBA71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `point_trigger_events` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_C2A3BDBAA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_lead_event_log`
--

LOCK TABLES `point_lead_event_log` WRITE;
/*!40000 ALTER TABLE `point_lead_event_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_lead_event_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_trigger_events`
--

DROP TABLE IF EXISTS `point_trigger_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_trigger_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trigger_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `action_order` int(11) NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_D5669585FDDDCD6` (`trigger_id`),
  KEY `trigger_type_search` (`type`),
  CONSTRAINT `FK_D5669585FDDDCD6` FOREIGN KEY (`trigger_id`) REFERENCES `point_triggers` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_trigger_events`
--

LOCK TABLES `point_trigger_events` WRITE;
/*!40000 ALTER TABLE `point_trigger_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_trigger_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `point_triggers`
--

DROP TABLE IF EXISTS `point_triggers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `point_triggers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `points` int(11) NOT NULL,
  `color` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `trigger_existing_leads` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9CABD32F12469DE2` (`category_id`),
  CONSTRAINT `FK_9CABD32F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `point_triggers`
--

LOCK TABLES `point_triggers` WRITE;
/*!40000 ALTER TABLE `point_triggers` DISABLE KEYS */;
/*!40000 ALTER TABLE `point_triggers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `points`
--

DROP TABLE IF EXISTS `points`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `points` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `delta` int(11) NOT NULL,
  `properties` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_27BA8E2912469DE2` (`category_id`),
  KEY `point_type_search` (`type`),
  CONSTRAINT `FK_27BA8E2912469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `points`
--

LOCK TABLES `points` WRITE;
/*!40000 ALTER TABLE `points` DISABLE KEYS */;
/*!40000 ALTER TABLE `points` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_ids`
--

DROP TABLE IF EXISTS `push_ids`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_ids` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `push_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `mobile` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4F2393E855458D` (`lead_id`),
  CONSTRAINT `FK_4F2393E855458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_ids`
--

LOCK TABLES `push_ids` WRITE;
/*!40000 ALTER TABLE `push_ids` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_ids` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notification_list_xref`
--

DROP TABLE IF EXISTS `push_notification_list_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_notification_list_xref` (
  `notification_id` int(11) NOT NULL,
  `leadlist_id` int(11) NOT NULL,
  PRIMARY KEY (`notification_id`,`leadlist_id`),
  KEY `IDX_473919EFEF1A9D84` (`notification_id`),
  KEY `IDX_473919EFB9FC8874` (`leadlist_id`),
  CONSTRAINT `FK_473919EFB9FC8874` FOREIGN KEY (`leadlist_id`) REFERENCES `lead_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_473919EFEF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `push_notifications` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notification_list_xref`
--

LOCK TABLES `push_notification_list_xref` WRITE;
/*!40000 ALTER TABLE `push_notification_list_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notification_list_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notification_stats`
--

DROP TABLE IF EXISTS `push_notification_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_notification_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `notification_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_sent` datetime NOT NULL,
  `date_read` datetime DEFAULT NULL,
  `is_clicked` tinyint(1) NOT NULL,
  `date_clicked` datetime DEFAULT NULL,
  `tracking_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `retry_count` int(11) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `tokens` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `click_count` int(11) DEFAULT NULL,
  `last_clicked` datetime DEFAULT NULL,
  `click_details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_DE63695EEF1A9D84` (`notification_id`),
  KEY `IDX_DE63695E55458D` (`lead_id`),
  KEY `IDX_DE63695E3DAE168B` (`list_id`),
  KEY `IDX_DE63695EA03F5E9F` (`ip_id`),
  KEY `stat_notification_search` (`notification_id`,`lead_id`),
  KEY `stat_notification_clicked_search` (`is_clicked`),
  KEY `stat_notification_hash_search` (`tracking_hash`),
  KEY `stat_notification_source_search` (`source`,`source_id`),
  CONSTRAINT `FK_DE63695E3DAE168B` FOREIGN KEY (`list_id`) REFERENCES `lead_lists` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_DE63695E55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_DE63695EA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_DE63695EEF1A9D84` FOREIGN KEY (`notification_id`) REFERENCES `push_notifications` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notification_stats`
--

LOCK TABLES `push_notification_stats` WRITE;
/*!40000 ALTER TABLE `push_notification_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notification_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `push_notifications`
--

DROP TABLE IF EXISTS `push_notifications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `push_notifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `url` longtext COLLATE utf8_unicode_ci,
  `heading` longtext COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `button` longtext COLLATE utf8_unicode_ci,
  `utm_tags` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `notification_type` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `read_count` int(11) NOT NULL,
  `sent_count` int(11) NOT NULL,
  `mobile` tinyint(1) NOT NULL,
  `mobileSettings` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_5B9B7E4F12469DE2` (`category_id`),
  CONSTRAINT `FK_5B9B7E4F12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `push_notifications`
--

LOCK TABLES `push_notifications` WRITE;
/*!40000 ALTER TABLE `push_notifications` DISABLE KEYS */;
/*!40000 ALTER TABLE `push_notifications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports`
--

DROP TABLE IF EXISTS `reports`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `system` tinyint(1) NOT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `columns` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `filters` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `table_order` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `graphs` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `group_by` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `aggregators` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `settings` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  `is_scheduled` tinyint(1) NOT NULL,
  `schedule_unit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule_day` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `schedule_month_frequency` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports`
--

LOCK TABLES `reports` WRITE;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` VALUES (1,1,NULL,NULL,NULL,'2017-12-14 11:36:30',1,'Sadmin LeadsEngage',NULL,NULL,'Sadmin LeadsEngage','Visits published Pages',NULL,1,'page.hits','a:7:{i:0;s:11:\"ph.date_hit\";i:1;s:6:\"ph.url\";i:2;s:12:\"ph.url_title\";i:3;s:10:\"ph.referer\";i:4;s:12:\"i.ip_address\";i:5;s:7:\"ph.city\";i:6;s:10:\"ph.country\";}','a:2:{i:0;a:5:{s:6:\"column\";s:7:\"ph.code\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:3:\"200\";s:4:\"glue\";s:3:\"and\";s:7:\"dynamic\";i:1;}i:1;a:5:{s:6:\"column\";s:14:\"p.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";s:4:\"glue\";s:3:\"and\";s:7:\"dynamic\";N;}}','a:1:{i:0;a:2:{s:6:\"column\";s:11:\"ph.date_hit\";s:9:\"direction\";s:3:\"ASC\";}}','a:8:{i:0;s:35:\"mautic.page.graph.line.time.on.site\";i:1;s:27:\"mautic.page.graph.line.hits\";i:2;s:38:\"mautic.page.graph.pie.new.vs.returning\";i:3;s:31:\"mautic.page.graph.pie.languages\";i:4;s:34:\"mautic.page.graph.pie.time.on.site\";i:5;s:27:\"mautic.page.table.referrers\";i:6;s:30:\"mautic.page.table.most.visited\";i:7;s:37:\"mautic.page.table.most.visited.unique\";}','a:0:{}','a:0:{}','{\"showGraphsAboveTable\":0,\"showDynamicFilters\":0,\"hideDateRangeFilter\":0}',0,NULL,NULL,NULL,NULL),(2,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Downloads of all Assets',NULL,1,'asset.downloads','a:7:{i:0;s:16:\"ad.date_download\";i:1;s:7:\"a.title\";i:2;s:12:\"i.ip_address\";i:3;s:11:\"l.firstname\";i:4;s:10:\"l.lastname\";i:5;s:7:\"l.email\";i:6;s:4:\"a.id\";}','a:1:{i:0;a:3:{s:6:\"column\";s:14:\"a.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";}}','a:1:{i:0;a:2:{s:6:\"column\";s:16:\"ad.date_download\";s:9:\"direction\";s:3:\"ASC\";}}','a:4:{i:0;s:33:\"mautic.asset.graph.line.downloads\";i:1;s:31:\"mautic.asset.graph.pie.statuses\";i:2;s:34:\"mautic.asset.table.most.downloaded\";i:3;s:32:\"mautic.asset.table.top.referrers\";}','a:0:{}','a:0:{}','[]',0,NULL,NULL,NULL,NULL),(3,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Submissions of published Forms',NULL,1,'form.submissions','a:0:{}','a:1:{i:1;a:3:{s:6:\"column\";s:14:\"f.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";}}','a:0:{}','a:3:{i:0;s:34:\"mautic.form.graph.line.submissions\";i:1;s:32:\"mautic.form.table.most.submitted\";i:2;s:31:\"mautic.form.table.top.referrers\";}','a:0:{}','a:0:{}','[]',0,NULL,NULL,NULL,NULL),(4,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'All Emails',NULL,1,'email.stats','a:5:{i:0;s:12:\"es.date_sent\";i:1;s:12:\"es.date_read\";i:2;s:9:\"e.subject\";i:3;s:16:\"es.email_address\";i:4;s:4:\"e.id\";}','a:1:{i:0;a:3:{s:6:\"column\";s:14:\"e.is_published\";s:9:\"condition\";s:2:\"eq\";s:5:\"value\";s:1:\"1\";}}','a:1:{i:0;a:2:{s:6:\"column\";s:12:\"es.date_sent\";s:9:\"direction\";s:3:\"ASC\";}}','a:6:{i:0;s:29:\"mautic.email.graph.line.stats\";i:1;s:42:\"mautic.email.graph.pie.ignored.read.failed\";i:2;s:35:\"mautic.email.table.most.emails.read\";i:3;s:35:\"mautic.email.table.most.emails.sent\";i:4;s:43:\"mautic.email.table.most.emails.read.percent\";i:5;s:37:\"mautic.email.table.most.emails.failed\";}','a:0:{}','a:0:{}','[]',0,NULL,NULL,NULL,NULL),(5,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Leads and Points',NULL,1,'lead.pointlog','a:7:{i:0;s:13:\"lp.date_added\";i:1;s:7:\"lp.type\";i:2;s:13:\"lp.event_name\";i:3;s:11:\"l.firstname\";i:4;s:10:\"l.lastname\";i:5;s:7:\"l.email\";i:6;s:8:\"lp.delta\";}','a:0:{}','a:1:{i:0;a:2:{s:6:\"column\";s:13:\"lp.date_added\";s:9:\"direction\";s:3:\"ASC\";}}','a:6:{i:0;s:29:\"mautic.lead.graph.line.points\";i:1;s:29:\"mautic.lead.table.most.points\";i:2;s:29:\"mautic.lead.table.top.actions\";i:3;s:28:\"mautic.lead.table.top.cities\";i:4;s:31:\"mautic.lead.table.top.countries\";i:5;s:28:\"mautic.lead.table.top.events\";}','a:0:{}','a:0:{}','[]',0,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reports_schedulers`
--

DROP TABLE IF EXISTS `reports_schedulers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reports_schedulers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_id` int(11) NOT NULL,
  `schedule_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_C74CA6B84BD2A4C0` (`report_id`),
  CONSTRAINT `FK_C74CA6B84BD2A4C0` FOREIGN KEY (`report_id`) REFERENCES `reports` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reports_schedulers`
--

LOCK TABLES `reports_schedulers` WRITE;
/*!40000 ALTER TABLE `reports_schedulers` DISABLE KEYS */;
/*!40000 ALTER TABLE `reports_schedulers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `is_admin` tinyint(1) NOT NULL,
  `readable_permissions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Super Administrator','Full system access',1,'N;'),(2,1,'2017-12-09 12:00:35',1,'Sadmin LeadsEngage','2017-12-12 12:18:06',1,'Sadmin LeadsEngage',NULL,NULL,'Sadmin LeadsEngage','Administrator',NULL,0,'a:26:{s:16:\"asset:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"asset:assets\";a:1:{i:0;s:4:\"full\";}s:19:\"campaign:categories\";a:1:{i:0;s:4:\"full\";}s:18:\"campaign:campaigns\";a:1:{i:0;s:4:\"full\";}s:19:\"category:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:leads\";a:1:{i:0;s:4:\"full\";}s:10:\"lead:lists\";a:1:{i:0;s:4:\"full\";}s:11:\"lead:fields\";a:1:{i:0;s:4:\"full\";}s:12:\"lead:imports\";a:1:{i:0;s:4:\"full\";}s:11:\"core:themes\";a:1:{i:0;s:4:\"full\";}s:16:\"email:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"email:emails\";a:1:{i:0;s:4:\"full\";}s:16:\"focus:categories\";a:1:{i:0;s:4:\"full\";}s:11:\"focus:items\";a:1:{i:0;s:4:\"full\";}s:15:\"form:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"form:forms\";a:1:{i:0;s:4:\"full\";}s:15:\"page:categories\";a:1:{i:0;s:4:\"full\";}s:10:\"page:pages\";a:1:{i:0;s:4:\"full\";}s:22:\"page:preference_center\";a:1:{i:0;s:4:\"full\";}s:16:\"point:categories\";a:1:{i:0;s:4:\"full\";}s:12:\"point:points\";a:1:{i:0;s:4:\"full\";}s:14:\"point:triggers\";a:1:{i:0;s:4:\"full\";}s:14:\"report:reports\";a:1:{i:0;s:4:\"full\";}s:14:\"sms:categories\";a:1:{i:0;s:4:\"full\";}s:9:\"sms:smses\";a:1:{i:0;s:4:\"full\";}s:10:\"user:users\";a:1:{i:0;s:4:\"full\";}}');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `saml_id_entry`
--

DROP TABLE IF EXISTS `saml_id_entry`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `saml_id_entry` (
  `id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `entity_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `expiryTimestamp` int(11) NOT NULL,
  PRIMARY KEY (`id`,`entity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `saml_id_entry`
--

LOCK TABLES `saml_id_entry` WRITE;
/*!40000 ALTER TABLE `saml_id_entry` DISABLE KEYS */;
/*!40000 ALTER TABLE `saml_id_entry` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_message_list_xref`
--

DROP TABLE IF EXISTS `sms_message_list_xref`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_message_list_xref` (
  `sms_id` int(11) NOT NULL,
  `leadlist_id` int(11) NOT NULL,
  PRIMARY KEY (`sms_id`,`leadlist_id`),
  KEY `IDX_B032FC2EBD5C7E60` (`sms_id`),
  KEY `IDX_B032FC2EB9FC8874` (`leadlist_id`),
  CONSTRAINT `FK_B032FC2EB9FC8874` FOREIGN KEY (`leadlist_id`) REFERENCES `lead_lists` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_B032FC2EBD5C7E60` FOREIGN KEY (`sms_id`) REFERENCES `sms_messages` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_message_list_xref`
--

LOCK TABLES `sms_message_list_xref` WRITE;
/*!40000 ALTER TABLE `sms_message_list_xref` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_message_list_xref` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_message_stats`
--

DROP TABLE IF EXISTS `sms_message_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_message_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `list_id` int(11) DEFAULT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_sent` datetime NOT NULL,
  `tracking_hash` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `tokens` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_FE1BAE9BD5C7E60` (`sms_id`),
  KEY `IDX_FE1BAE955458D` (`lead_id`),
  KEY `IDX_FE1BAE93DAE168B` (`list_id`),
  KEY `IDX_FE1BAE9A03F5E9F` (`ip_id`),
  KEY `stat_sms_search` (`sms_id`,`lead_id`),
  KEY `stat_sms_hash_search` (`tracking_hash`),
  KEY `stat_sms_source_search` (`source`,`source_id`),
  CONSTRAINT `FK_FE1BAE93DAE168B` FOREIGN KEY (`list_id`) REFERENCES `lead_lists` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_FE1BAE955458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_FE1BAE9A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`),
  CONSTRAINT `FK_FE1BAE9BD5C7E60` FOREIGN KEY (`sms_id`) REFERENCES `sms_messages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_message_stats`
--

LOCK TABLES `sms_message_stats` WRITE;
/*!40000 ALTER TABLE `sms_message_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_message_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sms_messages`
--

DROP TABLE IF EXISTS `sms_messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sms_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `lang` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sms_type` longtext COLLATE utf8_unicode_ci,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  `sent_count` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDF43F9712469DE2` (`category_id`),
  CONSTRAINT `FK_BDF43F9712469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sms_messages`
--

LOCK TABLES `sms_messages` WRITE;
/*!40000 ALTER TABLE `sms_messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `sms_messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stage_lead_action_log`
--

DROP TABLE IF EXISTS `stage_lead_action_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stage_lead_action_log` (
  `stage_id` int(11) NOT NULL,
  `lead_id` int(11) NOT NULL,
  `ip_id` int(11) DEFAULT NULL,
  `date_fired` datetime NOT NULL,
  PRIMARY KEY (`stage_id`,`lead_id`),
  KEY `IDX_A506AFBE2298D193` (`stage_id`),
  KEY `IDX_A506AFBE55458D` (`lead_id`),
  KEY `IDX_A506AFBEA03F5E9F` (`ip_id`),
  CONSTRAINT `FK_A506AFBE2298D193` FOREIGN KEY (`stage_id`) REFERENCES `stages` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A506AFBE55458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_A506AFBEA03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stage_lead_action_log`
--

LOCK TABLES `stage_lead_action_log` WRITE;
/*!40000 ALTER TABLE `stage_lead_action_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `stage_lead_action_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stages`
--

DROP TABLE IF EXISTS `stages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `stages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `weight` int(11) NOT NULL,
  `publish_up` datetime DEFAULT NULL,
  `publish_down` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2FA26A6412469DE2` (`category_id`),
  CONSTRAINT `FK_2FA26A6412469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stages`
--

LOCK TABLES `stages` WRITE;
/*!40000 ALTER TABLE `stages` DISABLE KEYS */;
/*!40000 ALTER TABLE `stages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweet_stats`
--

DROP TABLE IF EXISTS `tweet_stats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweet_stats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `twitter_tweet_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `handle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_sent` datetime DEFAULT NULL,
  `is_failed` tinyint(1) DEFAULT NULL,
  `retry_count` int(11) DEFAULT NULL,
  `source` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `source_id` int(11) DEFAULT NULL,
  `favorite_count` int(11) DEFAULT NULL,
  `retweet_count` int(11) DEFAULT NULL,
  `response_details` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:json_array)',
  PRIMARY KEY (`id`),
  KEY `IDX_CB8CBAE51041E39B` (`tweet_id`),
  KEY `IDX_CB8CBAE555458D` (`lead_id`),
  KEY `stat_tweet_search` (`tweet_id`,`lead_id`),
  KEY `stat_tweet_search2` (`lead_id`,`tweet_id`),
  KEY `stat_tweet_failed_search` (`is_failed`),
  KEY `stat_tweet_source_search` (`source`,`source_id`),
  KEY `favorite_count_index` (`favorite_count`),
  KEY `retweet_count_index` (`retweet_count`),
  KEY `tweet_date_sent` (`date_sent`),
  KEY `twitter_tweet_id_index` (`twitter_tweet_id`),
  CONSTRAINT `FK_CB8CBAE51041E39B` FOREIGN KEY (`tweet_id`) REFERENCES `tweets` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_CB8CBAE555458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweet_stats`
--

LOCK TABLES `tweet_stats` WRITE;
/*!40000 ALTER TABLE `tweet_stats` DISABLE KEYS */;
/*!40000 ALTER TABLE `tweet_stats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tweets`
--

DROP TABLE IF EXISTS `tweets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tweets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `page_id` int(11) DEFAULT NULL,
  `asset_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `media_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `text` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sent_count` int(11) DEFAULT NULL,
  `favorite_count` int(11) DEFAULT NULL,
  `retweet_count` int(11) DEFAULT NULL,
  `lang` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_AA38402512469DE2` (`category_id`),
  KEY `IDX_AA384025C4663E4` (`page_id`),
  KEY `IDX_AA3840255DA1941` (`asset_id`),
  KEY `tweet_text_index` (`text`),
  KEY `sent_count_index` (`sent_count`),
  KEY `favorite_count_index` (`favorite_count`),
  KEY `retweet_count_index` (`retweet_count`),
  CONSTRAINT `FK_AA38402512469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_AA3840255DA1941` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_AA384025C4663E4` FOREIGN KEY (`page_id`) REFERENCES `pages` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tweets`
--

LOCK TABLES `tweets` WRITE;
/*!40000 ALTER TABLE `tweets` DISABLE KEYS */;
/*!40000 ALTER TABLE `tweets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_id` int(11) NOT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `timezone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `locale` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `last_active` datetime DEFAULT NULL,
  `online_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preferences` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `signature` longtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9F85E0677` (`username`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`),
  KEY `IDX_1483A5E9D60322AC` (`role_id`),
  CONSTRAINT `FK_1483A5E9D60322AC` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,1,1,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Prabhu Leads Engage','sadmin@leadsengage.com','$2y$13$tOYhMnQwlwKSh6x6RedTqe5FvwwxoXHBjF1QfQZENhhg3vGRnsRxO','Sadmin','LeadsEngage','sadmin@leadsengage.com',NULL,'','','2017-12-15 05:53:43','2017-12-15 06:19:04','offline','a:0:{}',NULL),(2,2,1,'2017-12-09 12:01:51',1,'Sadmin LeadsEngage','2017-12-14 12:25:35',2,'Prabhu Leads Engage',NULL,NULL,'Prabhu Leads Engage','prabhu@leadsengage.com','$2y$12$VRaVO1duT70BwmQPTrv5geUY4LX7xFQ0aOJpfDxFBQDI/jX1SumsO','Prabhu','Leads Engage','prabhu@leadsengage.com','Software Developer','Asia/Kolkata','en_US','2017-12-15 06:19:47','2017-12-15 07:41:04','online','a:0:{}','Best regards, |FROM_NAME|');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_hits`
--

DROP TABLE IF EXISTS `video_hits`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `video_hits` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `lead_id` int(11) DEFAULT NULL,
  `ip_id` int(11) NOT NULL,
  `date_hit` datetime NOT NULL,
  `date_left` datetime DEFAULT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `region` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `code` int(11) NOT NULL,
  `referer` longtext COLLATE utf8_unicode_ci,
  `url` longtext COLLATE utf8_unicode_ci,
  `user_agent` longtext COLLATE utf8_unicode_ci,
  `remote_host` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_language` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `browser_languages` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  `channel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `channel_id` int(11) DEFAULT NULL,
  `time_watched` int(11) DEFAULT NULL,
  `duration` int(11) DEFAULT NULL,
  `query` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  KEY `IDX_1D1831F755458D` (`lead_id`),
  KEY `IDX_1D1831F7A03F5E9F` (`ip_id`),
  KEY `video_date_hit` (`date_hit`),
  KEY `video_channel_search` (`channel`,`channel_id`),
  KEY `video_guid_lead_search` (`guid`,`lead_id`),
  CONSTRAINT `FK_1D1831F755458D` FOREIGN KEY (`lead_id`) REFERENCES `leads` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_1D1831F7A03F5E9F` FOREIGN KEY (`ip_id`) REFERENCES `ip_addresses` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_hits`
--

LOCK TABLES `video_hits` WRITE;
/*!40000 ALTER TABLE `video_hits` DISABLE KEYS */;
/*!40000 ALTER TABLE `video_hits` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhook_events`
--

DROP TABLE IF EXISTS `webhook_events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webhook_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webhook_id` int(11) NOT NULL,
  `event_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7AD44E375C9BA60B` (`webhook_id`),
  CONSTRAINT `FK_7AD44E375C9BA60B` FOREIGN KEY (`webhook_id`) REFERENCES `webhooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhook_events`
--

LOCK TABLES `webhook_events` WRITE;
/*!40000 ALTER TABLE `webhook_events` DISABLE KEYS */;
/*!40000 ALTER TABLE `webhook_events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhook_logs`
--

DROP TABLE IF EXISTS `webhook_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webhook_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webhook_id` int(11) NOT NULL,
  `status_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `runtime` double DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_45A353475C9BA60B` (`webhook_id`),
  CONSTRAINT `FK_45A353475C9BA60B` FOREIGN KEY (`webhook_id`) REFERENCES `webhooks` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhook_logs`
--

LOCK TABLES `webhook_logs` WRITE;
/*!40000 ALTER TABLE `webhook_logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `webhook_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhook_queue`
--

DROP TABLE IF EXISTS `webhook_queue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webhook_queue` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `webhook_id` int(11) NOT NULL,
  `event_id` int(11) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F52D9A1A5C9BA60B` (`webhook_id`),
  KEY `IDX_F52D9A1A71F7E88B` (`event_id`),
  CONSTRAINT `FK_F52D9A1A5C9BA60B` FOREIGN KEY (`webhook_id`) REFERENCES `webhooks` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_F52D9A1A71F7E88B` FOREIGN KEY (`event_id`) REFERENCES `webhook_events` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhook_queue`
--

LOCK TABLES `webhook_queue` WRITE;
/*!40000 ALTER TABLE `webhook_queue` DISABLE KEYS */;
/*!40000 ALTER TABLE `webhook_queue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webhooks`
--

DROP TABLE IF EXISTS `webhooks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webhooks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `webhook_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `events_orderby_dir` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_998C4FDD12469DE2` (`category_id`),
  CONSTRAINT `FK_998C4FDD12469DE2` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webhooks`
--

LOCK TABLES `webhooks` WRITE;
/*!40000 ALTER TABLE `webhooks` DISABLE KEYS */;
/*!40000 ALTER TABLE `webhooks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `widgets`
--

DROP TABLE IF EXISTS `widgets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `widgets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `is_published` tinyint(1) NOT NULL,
  `date_added` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_modified` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  `modified_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `checked_out` datetime DEFAULT NULL,
  `checked_out_by` int(11) DEFAULT NULL,
  `checked_out_by_user` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `width` int(11) NOT NULL,
  `height` int(11) NOT NULL,
  `cache_timeout` int(11) DEFAULT NULL,
  `ordering` int(11) DEFAULT NULL,
  `params` longtext COLLATE utf8_unicode_ci COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `widgets`
--

LOCK TABLES `widgets` WRITE;
/*!40000 ALTER TABLE `widgets` DISABLE KEYS */;
INSERT INTO `widgets` VALUES (12,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Contacts created','created.leads.in.time',100,330,NULL,0,'a:2:{s:5:\"lists\";s:21:\"identifiedVsAnonymous\";s:4:\"flag\";N;}'),(13,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Visits','page.hits.in.time',50,330,NULL,1,'a:1:{s:4:\"flag\";N;}'),(14,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Contact map','map.of.leads',50,330,NULL,3,'a:0:{}'),(15,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Emails sent / opened','emails.in.time',50,330,NULL,5,'a:1:{s:4:\"flag\";N;}'),(16,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Points','points.in.time',50,330,NULL,6,'a:0:{}'),(17,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Unique/returning visitors','unique.vs.returning.leads',25,330,NULL,7,'a:0:{}'),(18,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Identified vs anonymous leads','anonymous.vs.identified.leads',25,330,NULL,8,'a:0:{}'),(19,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Ignored/opened emails','ignored.vs.read.emails',25,330,NULL,9,'a:0:{}'),(20,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Upcoming Emails','upcoming.emails',25,330,NULL,10,'a:0:{}'),(21,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Top Contact Creators','top.creators',100,330,NULL,11,'a:0:{}'),(22,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Dwell times','dwell.times',25,330,NULL,12,'a:0:{}'),(23,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Recent activity','recent.activity',50,330,NULL,13,'a:0:{}'),(24,1,'2017-12-09 10:47:29',1,'Sadmin LeadsEngage',NULL,NULL,NULL,NULL,NULL,NULL,'Top lists','top.lists',25,330,NULL,14,'a:0:{}'),(25,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Contacts created','created.leads.in.time',100,330,NULL,3,'a:1:{s:5:\"lists\";s:21:\"identifiedVsAnonymous\";}'),(26,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Contact map','map.of.leads',75,445,NULL,4,'a:0:{}'),(27,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Top lists','top.lists',25,445,NULL,5,'a:0:{}'),(28,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Visits','page.hits.in.time',100,330,NULL,6,'a:0:{}'),(29,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Emails sent / opened','emails.in.time',100,330,NULL,7,'a:0:{}'),(30,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Unique/returning visitors','unique.vs.returning.leads',25,215,NULL,8,'a:0:{}'),(31,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Ignored/opened emails','ignored.vs.read.emails',25,215,NULL,9,'a:0:{}'),(32,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Identified vs anonymous leads','anonymous.vs.identified.leads',25,215,NULL,10,'a:0:{}'),(33,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Dwell times','dwell.times',25,215,NULL,11,'a:0:{}'),(34,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Recent activity','recent.activity',50,330,NULL,12,'a:0:{}'),(35,1,'2017-12-09 12:02:07',2,'Prabhu Leads Engage',NULL,NULL,NULL,NULL,NULL,NULL,'Upcoming Emails','upcoming.emails',50,330,NULL,13,'a:0:{}');
/*!40000 ALTER TABLE `widgets` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-17 12:44:24
