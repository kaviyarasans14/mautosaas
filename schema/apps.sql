-- MySQL dump 10.13  Distrib 5.5.58, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: leadsengage_apps
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
  `usermail` varchar(500) NOT NULL DEFAULT '',
  `usermobile` varchar(500) DEFAULT '',
  `createdon` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applicationlist`
--

LOCK TABLES `applicationlist` WRITE;
/*!40000 ALTER TABLE `applicationlist` DISABLE KEYS */;
INSERT INTO `applicationlist` VALUES ('7','','',' ','','','2017-12-17 06:42:16'),('1','abc','Ericssion','Gunalan','prabhu@cratio.in','9710247372','2017-12-15 10:52:23'),('2','bbc','Leads Roll','Kaviarasan','kaviarasan@dacamsys.com','9710247372','2017-12-15 11:04:30'),('4','freshsales','Fresh Sales','Prabu S','prabhu@freshsales.io','9710247372','2017-12-15 11:16:55'),('3','leadsroll','Leads Engage','Suresh Shamalan','sureshshamalan@dacamsys.com','9710247372','2017-12-15 11:07:58'),('6','mautic','Mautic','Prabu Priya','prabu@mautic.com','9710247372','2017-12-17 06:38:43'),('8','quickbooks','quickbooks','Mantu Sarkar','mantu@dacamsys.com','9710247372','2017-12-17 06:47:42'),('9','salesforce','salesforce','Jagadesh S','jagadesh@dacamsys.com','9710247372','2017-12-17 06:49:46'),('0','xyz','Leads Engage','Prabhu','prabhu@dacamsys.com','9710247372','2017-12-15 07:53:56'),('5','zoho','Zoho Corp','Bevek Kumar','bevek@dacamsys.com','9710247372','2017-12-16 10:20:29');
/*!40000 ALTER TABLE `applicationlist` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cronmonitorinfo`
--

DROP TABLE IF EXISTS `cronmonitorinfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cronmonitorinfo` (
  `domain` varchar(100) DEFAULT '',
  `command` varchar(100) DEFAULT '',
  `skiplimit` int(10) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cronmonitorinfo`
--

LOCK TABLES `cronmonitorinfo` WRITE;
/*!40000 ALTER TABLE `cronmonitorinfo` DISABLE KEYS */;
/*!40000 ALTER TABLE `cronmonitorinfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `freeappidtable`
--

DROP TABLE IF EXISTS `freeappidtable`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `freeappidtable` (
  `appid` int(1) NOT NULL DEFAULT '0',
  `schemastatus` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `freeappidtable`
--

LOCK TABLES `freeappidtable` WRITE;
/*!40000 ALTER TABLE `freeappidtable` DISABLE KEYS */;
INSERT INTO `freeappidtable` VALUES (10,''),(11,''),(12,''),(13,''),(14,''),(15,''),(16,''),(17,''),(18,'');
/*!40000 ALTER TABLE `freeappidtable` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-17 12:45:19
