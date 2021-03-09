-- MySQL dump 10.13  Distrib 5.6.38, for osx10.9 (x86_64)
--
-- Host: localhost    Database: dropnshop
-- ------------------------------------------------------
-- Server version	5.6.38

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
-- Table structure for table `Education`
--

DROP TABLE IF EXISTS `Education`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Education` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `degree_name` varchar(45) DEFAULT NULL,
  `university` varchar(45) DEFAULT NULL,
  `startDate` varchar(45) DEFAULT NULL,
  `endDate` varchar(45) DEFAULT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Education_Users1_idx` (`Users_id`),
  CONSTRAINT `fk_Education_Users1` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Education`
--

LOCK TABLES `Education` WRITE;
/*!40000 ALTER TABLE `Education` DISABLE KEYS */;
INSERT INTO `Education` VALUES (24,'Computer Programming','GCU','2018','2022',39);
/*!40000 ALTER TABLE `Education` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Groups`
--

DROP TABLE IF EXISTS `Groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `GroupName` varchar(45) DEFAULT NULL,
  `GroupDescription` varchar(45) DEFAULT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Users_id`),
  KEY `fk_Groups_Users1_idx` (`Users_id`),
  CONSTRAINT `fk_Groups_Users1` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Groups`
--

LOCK TABLES `Groups` WRITE;
/*!40000 ALTER TABLE `Groups` DISABLE KEYS */;
INSERT INTO `Groups` VALUES (9,'Cooking Group','We really like to cook!',39);
/*!40000 ALTER TABLE `Groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `JobHistory`
--

DROP TABLE IF EXISTS `JobHistory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JobHistory` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobtitle` varchar(45) DEFAULT NULL,
  `jobcompany` varchar(45) DEFAULT NULL,
  `startdate` varchar(45) DEFAULT NULL,
  `enddate` varchar(45) DEFAULT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Users_id`),
  KEY `fk_JobHistory_Users1_idx` (`Users_id`),
  CONSTRAINT `fk_JobHistory_Users1` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JobHistory`
--

LOCK TABLES `JobHistory` WRITE;
/*!40000 ALTER TABLE `JobHistory` DISABLE KEYS */;
INSERT INTO `JobHistory` VALUES (32,'ITS Helpdesk','GCU','2018','2020',39);
/*!40000 ALTER TABLE `JobHistory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `JobPosting`
--

DROP TABLE IF EXISTS `JobPosting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `JobPosting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `jobtitle` varchar(45) DEFAULT NULL,
  `company` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `requirements` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `JobPosting`
--

LOCK TABLES `JobPosting` WRITE;
/*!40000 ALTER TABLE `JobPosting` DISABLE KEYS */;
INSERT INTO `JobPosting` VALUES (4,'Software Engineer','Carvana','Website for Carvana',30,'Job Experience'),(5,'Fry Cook','Chickfila','Cook at Chickfila!',12,'No Job Requirements');
/*!40000 ALTER TABLE `JobPosting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Members`
--

DROP TABLE IF EXISTS `Members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `groupname` varchar(45) DEFAULT NULL,
  `userfirstname` varchar(45) DEFAULT NULL,
  `userlastname` varchar(30) NOT NULL,
  `users_id` int(11) NOT NULL,
  `groups_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`users_id`,`groups_id`),
  KEY `fk_Members_Users1_idx` (`users_id`),
  KEY `fk_Members_Groups1_idx` (`groups_id`),
  CONSTRAINT `fk_Members_Groups1` FOREIGN KEY (`groups_id`) REFERENCES `Groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_Members_Users1` FOREIGN KEY (`users_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Members`
--

LOCK TABLES `Members` WRITE;
/*!40000 ALTER TABLE `Members` DISABLE KEYS */;
INSERT INTO `Members` VALUES (42,'Cooking Group','Cyrus','Duncan',39,9);
/*!40000 ALTER TABLE `Members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Profiles`
--

DROP TABLE IF EXISTS `Profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `country` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `street` varchar(45) NOT NULL,
  `zip` varchar(11) NOT NULL,
  `status` int(11) NOT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_Profiles_Users_idx` (`Users_id`),
  CONSTRAINT `fk_Profiles_Users` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Profiles`
--

LOCK TABLES `Profiles` WRITE;
/*!40000 ALTER TABLE `Profiles` DISABLE KEYS */;
INSERT INTO `Profiles` VALUES (21,'Cyrus','Duncan','United States','Colorado','Fruita','131 Compton Court','81521',0,39);
/*!40000 ALTER TABLE `Profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(16) NOT NULL,
  `email` text NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `role` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (39,'Cyrus','Duncan','cyrusd4264@gmail.com','Cyrus','Duncan','admin');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `skills`
--

DROP TABLE IF EXISTS `skills`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `skills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `skill` varchar(20) NOT NULL,
  `Users_id` int(11) NOT NULL,
  PRIMARY KEY (`id`,`Users_id`),
  KEY `fk_skills_Users1_idx` (`Users_id`),
  CONSTRAINT `fk_skills_Users1` FOREIGN KEY (`Users_id`) REFERENCES `Users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `skills`
--

LOCK TABLES `skills` WRITE;
/*!40000 ALTER TABLE `skills` DISABLE KEYS */;
INSERT INTO `skills` VALUES (53,'NA',39),(54,'Fishing',39);
/*!40000 ALTER TABLE `skills` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-03 11:55:43
