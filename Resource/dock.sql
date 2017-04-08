-- MySQL dump 10.13  Distrib 5.7.12, for osx10.9 (x86_64)
--
-- Host: localhost    Database: dock
-- ------------------------------------------------------
-- Server version	5.7.17

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
-- Table structure for table `Guest`
--

DROP TABLE IF EXISTS `Guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Guest` (
  `UserId` int(11) NOT NULL,
  `level_of_security` int(11) DEFAULT NULL,
  PRIMARY KEY (`UserId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Guest`
--

LOCK TABLES `Guest` WRITE;
/*!40000 ALTER TABLE `Guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `Guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `email` varchar(40) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `surname` varchar(40) NOT NULL,
  `username` varchar(40) NOT NULL,
  `phone_number` varchar(40) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `password` varchar(40) NOT NULL,
  `level_of_security` int(11) NOT NULL,
  `profile` varchar(2000) DEFAULT NULL,
  `photo_path` varchar(40) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`email`),
  UNIQUE KEY `token_UNIQUE` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES ('123@qq.com',NULL,'Shou','Jiafeng Shou',NULL,NULL,'123',4,NULL,NULL,NULL,NULL,1),('134@qq.com',NULL,'123','123 123',NULL,NULL,'asdf',4,NULL,NULL,NULL,'',0),('213',999,'123','4343',NULL,NULL,'123123',12,NULL,NULL,NULL,'ATYDNltsCQpbe1d+VmYCMltmUjZUZ1M5UGYOb1NsWmA=',1),('524867701@qq.com',NULL,'Shou','Jiafeng Shou',NULL,NULL,'qwert',4,NULL,NULL,NULL,'Dz9TZQc3XDlVZVdjVmBXYwE0UkdWIQYlV38BMABoXD9SCQ0vBCoPY1VnUGoHN1dmADxTN1FjB2EAPw==',1);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_module`
--

DROP TABLE IF EXISTS `User_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_module` (
  `email` int(11) NOT NULL,
  `module_code` varchar(45) NOT NULL,
  PRIMARY KEY (`email`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_module`
--

LOCK TABLES `User_module` WRITE;
/*!40000 ALTER TABLE `User_module` DISABLE KEYS */;
INSERT INTO `User_module` VALUES (213,'COMP208'),(213,'COMP211'),(213,'COMP213'),(213,'COMP220');
/*!40000 ALTER TABLE `User_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_feedback`
--

DROP TABLE IF EXISTS `application_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_feedback` (
  `feedback_id` varchar(20) NOT NULL,
  `UserID` int(11) DEFAULT NULL,
  `feedback_content` varchar(45) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  `scale` int(11) DEFAULT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_feedback`
--

LOCK TABLES `application_feedback` WRITE;
/*!40000 ALTER TABLE `application_feedback` DISABLE KEYS */;
/*!40000 ALTER TABLE `application_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `repository_path` varchar(100) NOT NULL,
  `name` varchar(45) NOT NULL,
  `size` int(11) DEFAULT NULL,
  `type` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`repository_path`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `module`
--

DROP TABLE IF EXISTS `module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `module` (
  `Module_code` varchar(10) NOT NULL,
  `module_name` varchar(40) NOT NULL,
  `module_description` varchar(2000) NOT NULL,
  `materials_path` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`Module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `module`
--

LOCK TABLES `module` WRITE;
/*!40000 ALTER TABLE `module` DISABLE KEYS */;
INSERT INTO `module` VALUES ('COMP208','Group Project','learn group work',NULL),('COMP211','Internet Principle','lean internet ',NULL),('COMP213','Advanced Java','learn advanced java',NULL),('COMP220','Software tool','learn software tool to build project',NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repository`
--

DROP TABLE IF EXISTS `repository`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `repository` (
  `repository_path` varchar(100) NOT NULL,
  `whole_size` int(11) NOT NULL,
  `type` tinyint(1) NOT NULL,
  `remain_size` int(11) NOT NULL,
  `file_list` varchar(300) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`repository_path`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repository`
--

LOCK TABLES `repository` WRITE;
/*!40000 ALTER TABLE `repository` DISABLE KEYS */;
/*!40000 ALTER TABLE `repository` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic`
--

DROP TABLE IF EXISTS `topic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic` (
  `topic_id` int(11) NOT NULL,
  `module_code` varchar(40) DEFAULT NULL,
  `forum` varchar(45) DEFAULT NULL,
  `topic_name` varchar(45) DEFAULT NULL,
  `topic_content` varchar(45) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  `isReport` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_reponse`
--

DROP TABLE IF EXISTS `topic_reponse`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic_reponse` (
  `topic_id` varchar(40) NOT NULL,
  `floor_number` int(11) DEFAULT NULL,
  `time` datetime DEFAULT NULL,
  `UserId` varchar(45) DEFAULT NULL,
  `response_content` varchar(45) DEFAULT NULL,
  `isReport` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`topic_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_reponse`
--

LOCK TABLES `topic_reponse` WRITE;
/*!40000 ALTER TABLE `topic_reponse` DISABLE KEYS */;
/*!40000 ALTER TABLE `topic_reponse` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votingOption`
--

DROP TABLE IF EXISTS `votingOption`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votingOption` (
  `poll_id` int(11) NOT NULL,
  `poll_option` varchar(45) NOT NULL,
  `UserID` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`poll_id`,`poll_option`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votingOption`
--

LOCK TABLES `votingOption` WRITE;
/*!40000 ALTER TABLE `votingOption` DISABLE KEYS */;
/*!40000 ALTER TABLE `votingOption` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `votingpoll`
--

DROP TABLE IF EXISTS `votingpoll`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `votingpoll` (
  `poll_id` int(11) NOT NULL,
  `poll_title` varchar(45) DEFAULT NULL,
  `poll_date` varchar(45) DEFAULT NULL,
  `UserID` int(11) DEFAULT NULL,
  PRIMARY KEY (`poll_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votingpoll`
--

LOCK TABLES `votingpoll` WRITE;
/*!40000 ALTER TABLE `votingpoll` DISABLE KEYS */;
/*!40000 ALTER TABLE `votingpoll` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-04-08 21:02:16
