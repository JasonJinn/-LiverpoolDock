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
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `salt` varchar(90) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `token_UNIQUE` (`token`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'123@qq.com',NULL,'Shou','Jiafeng Shou',NULL,NULL,'123',4,NULL,NULL,NULL,'VWFRZ1ZhAB0FcgFzUn0GYVQ/ADhSCgF1AS0AY1BjCD9UYww5VWEAb1NtBzJQaA==',1,NULL),(2,'134@qq.com',NULL,'123','123 123',NULL,NULL,'asdf',4,NULL,NULL,NULL,'',0,NULL),(3,'213',999,'123','4343',NULL,NULL,'123123',0,NULL,NULL,NULL,'ADdXYltsAANbew4nBzcENAA9B2FWY1IwVWNQO19uX2Y=',1,NULL),(10,'524867701@qq.com',NULL,'Shou','Jiafeng Shou',NULL,NULL,'27e0735759fe80d76f2dad129a9ae934',0,NULL,NULL,NULL,'UmIGMAc3C24FNVNnADZQZAE0CB1RJlJxDCRTYlY+WzgDWAwuAy1dMVVnBz1XZVJjADNSNF1rVzUHNg==',1,'31c91e4002d2418c62a927d1e4515b56');
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_module`
--

DROP TABLE IF EXISTS `User_module`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_module` (
  `email` varchar(45) NOT NULL,
  `module_code` varchar(45) NOT NULL,
  PRIMARY KEY (`email`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_module`
--

LOCK TABLES `User_module` WRITE;
/*!40000 ALTER TABLE `User_module` DISABLE KEYS */;
INSERT INTO `User_module` VALUES ('213','COMP208'),('213','COMP211'),('213','COMP213'),('213','COMP220'),('524867701@qq.com','COMP211'),('524867701@qq.com','COMP220');
/*!40000 ALTER TABLE `User_module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User_profile`
--

DROP TABLE IF EXISTS `User_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User_profile` (
  `email` varchar(45) NOT NULL,
  `profile` varchar(300) DEFAULT NULL,
  `photoname` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `google` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `education` varchar(300) DEFAULT NULL,
  `experience` varchar(300) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User_profile`
--

LOCK TABLES `User_profile` WRITE;
/*!40000 ALTER TABLE `User_profile` DISABLE KEYS */;
INSERT INTO `User_profile` VALUES ('524867701@qq.com',NULL,NULL,NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `User_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `application_feedback`
--

DROP TABLE IF EXISTS `application_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `application_feedback` (
  `feedback_id` varchar(20) NOT NULL,
  `email` varchar(100) NOT NULL,
  `feedback_content` varchar(45) DEFAULT NULL,
  `feedback_date` datetime DEFAULT NULL,
  `scale` int(11) DEFAULT NULL,
  PRIMARY KEY (`feedback_id`,`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `application_feedback`
--

LOCK TABLES `application_feedback` WRITE;
/*!40000 ALTER TABLE `application_feedback` DISABLE KEYS */;
INSERT INTO `application_feedback` VALUES ('1','524867701@qq.com','hello','2017-04-25 00:04:00',NULL),('2','524867701@qq.com','hello','2017-04-25 00:04:19',NULL);
/*!40000 ALTER TABLE `application_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `email` varchar(100) NOT NULL,
  `event_from` datetime NOT NULL,
  `event_end` datetime NOT NULL,
  `event_name` varchar(80) NOT NULL,
  PRIMARY KEY (`email`,`event_from`,`event_end`,`event_name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
INSERT INTO `calendar` VALUES ('213','2017-04-09 00:00:00','2017-04-19 00:00:00','watchTV');
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `file`
--

DROP TABLE IF EXISTS `file`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `file` (
  `file_id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(100) NOT NULL,
  `name` varchar(45) NOT NULL,
  `size` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL,
  `Repo` varchar(45) NOT NULL,
  `isDelete` varchar(45) NOT NULL DEFAULT '0',
  `time` datetime DEFAULT NULL,
  PRIMARY KEY (`file_id`,`name`,`Repo`,`mail`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `file`
--

LOCK TABLES `file` WRITE;
/*!40000 ALTER TABLE `file` DISABLE KEYS */;
INSERT INTO `file` VALUES (4,'524867701@qq.com','Untitled.sql',18940,NULL,'private','0','2017-04-30 16:53:17'),(5,'524867701@qq.com','hotel3.pdf',354329,NULL,'private','0','2017-04-30 17:01:00');
/*!40000 ALTER TABLE `file` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `message`
--

DROP TABLE IF EXISTS `message`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `message` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `from_user` varchar(100) NOT NULL,
  `to_user` varchar(100) NOT NULL,
  `content` varchar(500) NOT NULL,
  `time` datetime NOT NULL,
  `isRead` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `message`
--

LOCK TABLES `message` WRITE;
/*!40000 ALTER TABLE `message` DISABLE KEYS */;
INSERT INTO `message` VALUES (3,'Jason','Jeffer','nihao','2017-04-27 13:11:51',1),(4,'Jeffer','Jeffer','nihao','2017-04-27 13:12:10',1),(5,'Jason','Jeffer','nihao','2017-04-27 13:12:36',1);
/*!40000 ALTER TABLE `message` ENABLE KEYS */;
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
INSERT INTO `module` VALUES ('COMP208','Group Project','learn group work',NULL),('COMP211','Internet Principle','lean internet ',NULL),('COMP213','Advanced Java','learn advanced java',NULL),('COMP220','Software tool','learn software tool to build project',NULL),('ECO101','I dont know','I make up it',NULL),('ECO102','I really dont know','I make up it again',NULL),('ECO201','I still dont know','I give up',NULL);
/*!40000 ALTER TABLE `module` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news`
--

DROP TABLE IF EXISTS `news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news` (
  `title` varchar(200) NOT NULL,
  `content` varchar(5000) NOT NULL,
  `url` varchar(200) NOT NULL,
  PRIMARY KEY (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news`
--

LOCK TABLES `news` WRITE;
/*!40000 ALTER TABLE `news` DISABLE KEYS */;
INSERT INTO `news` VALUES ('','',''),('?Climate of chronic insecurity? created by welfare changes','Ongoing changes to the welfare system have resulted in ?a climate of chronic insecurity?, according to University of Liverpool research that followed three groups of claimants over a five year period.<br><a href=\"https://www.liverpool.ac.uk/law/staff/ruth-patrick/\">Dr Ruth Patrick</a>, from the University?s <a href=\"https://www.liverpool.ac.uk/law-and-social-justice/\">School of Law and Social Justice</a>, interviewed 22 claimants, followed 14 for two years and eight claimants for five years, to assess the impact of welfare reform.<br>Each participant came from one of three groups; either a single parent, in receipt of disability support or a young job-seeker.<br><strong>&#8220;Demoralising&#8221;</strong><br>Over the five year period ? 2011-2016 ? not one claimant in any of the three groups secured stable, full-time work as a direct result of any welfare-to-work support received.<br>Instead, Dr Patrick reported, participants found contact with the benefits system and surrounding government rhetoric ?profoundly damaging? and ?demoralising?.<br>Dr Patrick said: ?The evidence from this study is that those directly affected by the changes, and by the climate of insecurity they create, do not benefit at all and are much more likely to see a deterioration in their circumstances.?<br>Only one study participant was helped into work, but on a zero hour contract that failed to provide enough income ?to escape poverty?, said Dr Patrick, forcing her to ?think about going to a foodbank to get by?.<br>Of the 14 participants followed for two years, three secured full-time work, but this was not because of assistance provided by Government.<br>Dr Patrick said: ?One participant, a single parent, was in the work programme but training to become a teaching assistant at the same time. She reported her employment advisor telling her that she would find it hard to get a job doing that, and that she should seek care work instead.<br>?That was a big knock to her confidence, but she persevered and did get a job as a teaching assistant.?<br>In another case, a single parent with two young children was so affected by benefit changes and sanctions that it ?pushed her over the edge?, said Dr Patrick, and she ended up on disability support.<br><strong>Major changes</strong><br>The changes include, placing new Employment Support Allowance (ESA) claimants falling into the Work-Related Activity Group on the same level of benefit as Jobseekers? Allowance &#8211; a drop of around £30 per week; excluding those aged between 18-21 from claiming housing support; removing the first child premium; forcing lone parents to look for work when their youngest child turns three and confining child benefit payments to the first two children.<br>Dr Patrick said: ?In my research, we see how experiences of out-of-work benefits receipt and successive waves of welfare reform have created a climate of chronic insecurity in which individuals are fearful about how future changes might further impact upon their lives.<br>?We also see how transitions into the paid labour market so rarely deliver security or an escape from poverty, but rather are frequently characterised by a continued state of insecurity and struggles to make ends meet.<br>?These findings suggest the Prime Minister, Theresa May would be best served by undertaking a complete rethink of the welfare reform policy framing and focus &#8211; a rethink that currently, at least, does not appear a likely prospect.?<br><strong><em>For Whose Benefit? The everyday realities of welfare reform</em> by Dr Ruth Patrick is published by Policy Press. For more information, please visit </strong><a href=\"http://www.policypress.co.uk/for-whose-benefit\"><strong>www.policypress.co.uk/for-whose-benefit</strong></a><br>','https://news.liverpool.ac.uk/wp-content/uploads/2017/04/job-centre-sign-1w.jpg'),('Academics invited to partner engagement and negotiation workshops','Business Gateway is hosting a suite of workshops to help academics explore the key concepts and skills required for working with non-academic partners.<br>The workshops will enable participants to:<br>Academics from all faculties are welcome to attend. The workshops will provide tips and tools on how to develop relationships and work effectively with prospective partners to maximise impact from their research.<br>Academic staff can register for one or as many of the following sessions as they wish:<br><strong>1.) Delivering Projects with External Partners</strong><br>Wednesday, 17 May , The Hub, Foresight Centre, 9:15am ? 1pm<br>(lunch to follow)<br><strong>2.) Improving Negotiations with Prospective Partners</strong><br>Thursday, 1 June , The Hub, Foresight Centre, 9.15am ? 1pm<br>(lunch to follow)<br><strong>3.) Providing Consultancy from Start to Finish</strong><br>Thursday, 8 June, The Hub, Foresight Centre, 9.15am-1pm (lunch following)<br>To register for the workshops please visit: <a href=\"https://business_gateway.eventbrite.com\">https://business_gateway.eventbrite.com</a><br>Or for more information please contact Kelli Cassidy, Business Gateway at: <a href=\"mailto:kelli.cassidy@liverpool.ac.uk\">kelli.cassidy@liverpool.ac.uk</a> / Ext. 48341<br><a href=\"//news.liverpool.ac.uk/staff-only/recent-posts\">All recent news for staff</a><br><a href=\"http://www.facebook.com\" class=\"ss-icon ss-social-circle facebook\">facebook</a><a href=\"http://www.facebook.com/UniversityofLiverpool\">Like us on Facebook</a><br><a href=\"//www.liverpool.ac.uk/contacts/social-media\">More Social Media</a><br>','https://news.liverpool.ac.uk/wp-content/uploads/2017/04/knowledge-exchange.jpg');
/*!40000 ALTER TABLE `news` ENABLE KEYS */;
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
  `module_code` varchar(40) NOT NULL,
  `forum` varchar(1) NOT NULL,
  `topic_name` varchar(45) NOT NULL,
  `topic_content` varchar(200) NOT NULL,
  `Username` varchar(45) NOT NULL,
  `isReport` tinyint(1) DEFAULT NULL,
  `email` varchar(45) NOT NULL,
  `time` datetime DEFAULT NULL,
  `floor` int(11) DEFAULT NULL,
  PRIMARY KEY (`topic_id`,`module_code`,`forum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic`
--

LOCK TABLES `topic` WRITE;
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` VALUES (1,'COMP211','G','jason is sb','I think jason is sb','4343',0,'213','2017-04-12 15:04:59',3),(1,'COMP220','G','jasonisbigsb','Istillagree','4343',1,'213','2017-04-12 14:04:51',1),(2,'COMP211','G','jason is still sb','I also think jason is sb','4343',0,'213','2017-04-12 15:04:50',5),(3,'COMP211','G','jasonisbigsb','Istillagree','4343',0,'213','2017-04-12 14:04:52',1);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `topic_response`
--

DROP TABLE IF EXISTS `topic_response`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `topic_response` (
  `topic_id` varchar(40) NOT NULL,
  `floor_number` int(11) NOT NULL,
  `time` datetime NOT NULL,
  `Username` varchar(45) NOT NULL,
  `response_content` varchar(45) NOT NULL,
  `isReport` tinyint(1) NOT NULL,
  `email` varchar(45) NOT NULL,
  `forum` varchar(1) NOT NULL,
  `module_code` varchar(45) NOT NULL,
  PRIMARY KEY (`topic_id`,`floor_number`,`module_code`,`forum`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `topic_response`
--

LOCK TABLES `topic_response` WRITE;
/*!40000 ALTER TABLE `topic_response` DISABLE KEYS */;
INSERT INTO `topic_response` VALUES ('1',1,'2017-04-09 21:09:50','4343','I think jason is sb',0,'213','G','COMP211'),('1',1,'2017-04-12 14:04:51','4343','Istillagree',1,'213','G','COMP220'),('1',2,'2017-04-09 21:30:07','Jiafeng Shou','jason is sb',0,'524867701@qq.com','G','COMP211'),('1',3,'2017-04-12 15:04:59','4343','sorryIdisagree',0,'213','G','COMP211'),('2',1,'2017-04-09 21:10:50','4343','jason is still sb',0,'213','G','COMP211'),('2',2,'2017-04-09 21:11:50','4343','because they both say he is sb',0,'213','G','COMP211'),('2',3,'2017-04-09 21:12:55','Jiafeng Shou','I agree',0,'524867701@qq.com','G','COMP211'),('2',4,'2017-04-12 14:04:58','4343','Ialwaysagree',0,'213','G','COMP211'),('2',5,'2017-04-12 15:04:50','Jiafeng Shou','Iwillalwaysagree',0,'524867701@qq.com','G','COMP211'),('3',1,'2017-04-12 14:04:52','4343','Istillagree',0,'213','G','COMP211');
/*!40000 ALTER TABLE `topic_response` ENABLE KEYS */;
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
  `email` varchar(45) NOT NULL,
  `module_code` varchar(45) NOT NULL,
  PRIMARY KEY (`poll_id`,`poll_option`,`email`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votingOption`
--

LOCK TABLES `votingOption` WRITE;
/*!40000 ALTER TABLE `votingOption` DISABLE KEYS */;
INSERT INTO `votingOption` VALUES (1,'very agree','213','COMP211'),(1,'very agree','null','COMP211'),(1,'yes','213','COMP211'),(1,'yes','524867701@qq.com','COMP211'),(1,'yes','null','COMP211');
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
  `poll_title` varchar(45) NOT NULL,
  `poll_date` datetime NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(45) NOT NULL,
  `module_code` varchar(45) NOT NULL,
  PRIMARY KEY (`poll_id`,`module_code`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `votingpoll`
--

LOCK TABLES `votingpoll` WRITE;
/*!40000 ALTER TABLE `votingpoll` DISABLE KEYS */;
INSERT INTO `votingpoll` VALUES (1,'is Jason sb','2017-04-13 19:45:32','213','4343','COMP211');
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

-- Dump completed on 2017-05-01  3:50:19
