-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: Guitar
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `accessory`
--

DROP TABLE IF EXISTS `accessory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `accessory` (
  `AccessoryID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `Cost` decimal(9,2) DEFAULT NULL,
  `BrandName` varchar(255) NOT NULL,
  `ReviewID` int(11) NOT NULL,
  PRIMARY KEY (`AccessoryID`),
  KEY `ReviewID` (`ReviewID`),
  CONSTRAINT `accessory_ibfk_1` FOREIGN KEY (`ReviewID`) REFERENCES `review` (`ReviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `accessory`
--

LOCK TABLES `accessory` WRITE;
/*!40000 ALTER TABLE `accessory` DISABLE KEYS */;
/*!40000 ALTER TABLE `accessory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guitar`
--

DROP TABLE IF EXISTS `guitar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `guitar` (
  `GuitarID` int(11) NOT NULL AUTO_INCREMENT,
  `Make` varchar(255) NOT NULL,
  `BrandName` varchar(255) NOT NULL,
  `Cost` decimal(9,2) DEFAULT NULL,
  `YearMade` int(11) DEFAULT NULL,
  `ReviewID` int(11) NOT NULL,
  `ExtraDescription` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`GuitarID`),
  KEY `ReviewID` (`ReviewID`),
  CONSTRAINT `guitar_ibfk_1` FOREIGN KEY (`ReviewID`) REFERENCES `review` (`ReviewID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guitar`
--

LOCK TABLES `guitar` WRITE;
/*!40000 ALTER TABLE `guitar` DISABLE KEYS */;
/*!40000 ALTER TABLE `guitar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `review`
--

DROP TABLE IF EXISTS `review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `review` (
  `ReviewID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(255) NOT NULL,
  `ReviewText` varchar(500) NOT NULL,
  `StarRating` int(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  PRIMARY KEY (`ReviewID`),
  KEY `Email` (`Email`),
  CONSTRAINT `review_ibfk_1` FOREIGN KEY (`Email`) REFERENCES `users` (`Email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `review`
--

LOCK TABLES `review` WRITE;
/*!40000 ALTER TABLE `review` DISABLE KEYS */;
/*!40000 ALTER TABLE `review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `Email` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Forename` varchar(255) NOT NULL,
  `Surname` varchar(255) NOT NULL,
  `UserPassword` varchar(255) NOT NULL,
  PRIMARY KEY (`Email`),
  UNIQUE KEY `Username` (`Username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('adasdasd@g.c','asdadadad','asdasdad','asdasdasd','$2y$10$vCwBFwLg/scfIsl/rz23serS5FynODWqcTjv2Kzy/gtCiWjgMghIy'),('asdasdasdasdadad@gmail.com','asdasdasdasdad','Peter','Tasker','$2y$10$MkZZE6E6pW6aZdl7dlp7Pe4M/K94OcPn0gJYuBHw4NkZqBGnEf4m2'),('fraeside@yahoo.co.uk','scoaby','Peter','Tasker','$2y$10$YVzaqI7v4kbjikM8biXwcuEVxWpopplNsYJLAxjpmohEDRtcf4X1m'),('lauryndrummond@hotmail.co.uk','raccoonman_','Peter','Tasker','$2y$10$A0nrAsaqqwPKPua1ozS/peKRsM28HnR09c0qdVok/lel89kdzUjhG'),('petertasker05@gmail.com','petertasker','Peter','Tasker','$2y$10$63xPHohNjp1Tv6AJTQ.xQO5Ds/TtXrVNIzMq9lWjW9ScXzhuB.Zca'),('test@user.com','testuser','Peter','Tasker','$2y$10$WU5xaawFiY.8EJS14pRxLOy.5lLpiHOFtWCRcyucszMW3OO9OXXIe'),('testuser2@gmail.com','peter','Peter','Tasker','$2y$10$sIYOGRhW8nIM6M.1g.NCT.hwe.qsTq1GLBE388f80/WnuuKYNM8ee');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-10-23 16:56:58
