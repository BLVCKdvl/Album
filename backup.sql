-- MySQL dump 10.13  Distrib 5.7.44, for Win64 (x86_64)
--
-- Host: localhost    Database: albums
-- ------------------------------------------------------
-- Server version	5.7.44-log

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
-- Table structure for table `albums`
--

DROP TABLE IF EXISTS `albums`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `albums` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `albums`
--

LOCK TABLES `albums` WRITE;
/*!40000 ALTER TABLE `albums` DISABLE KEYS */;
INSERT INTO `albums` VALUES (1,'Ð›ÐµÑ','Ð’ ÑÑ‚Ð¾Ð¼ Ð°Ð»ÑŒÐ±Ð¾Ð¼Ðµ Ð±ÑƒÐ´ÑƒÑ‚ ÑÐ¾Ð±Ñ€Ð°Ð½Ñ‹ ÐºÑ€Ð°ÑÐ¸Ð²Ñ‹Ðµ Ñ„Ð¾Ñ‚Ð¾Ð³Ñ€Ð°Ñ„Ð¸Ð¸ Ð»ÐµÑÐ° Ð¸ Ð¿Ñ€Ð¸Ñ€Ð¾Ð´Ñ‹. ÐšÐ¾Ñ€Ð¾Ñ‚ÐºÐ¾ Ð³Ð¾Ð²Ð¾Ñ€Ñ Ð¾ Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸ÐºÐµ - Ð»ÐµÑ.'),(11,'ÐÐ²Ñ‚Ð¾Ð¼Ð¾Ð±Ð¸Ð»Ð¸','Ð¢ÑƒÑ‚ ÑÐ¾Ð±Ñ€Ð°Ð½Ð° ÐºÐ¾Ð»Ð»ÐµÐºÑ†Ð¸Ñ Ñ„Ð¾Ñ‚Ð¾ÐºÐ°Ñ€Ñ‚Ð¾Ñ‡ÐµÐº Ð°Ð²Ñ‚Ð¾Ð¼Ð¾Ð±Ð¸Ð»ÐµÐ¹ Ð¼Ð¾ÐµÐ³Ð¾ Ð¾Ñ‚Ñ†Ð°, Ð´ÐµÐ´Ð°, Ð¼Ð½Ð¾Ð³Ð¸Ñ… Ð´Ñ€ÑƒÐ·ÐµÐ¹ Ð° Ñ‚Ð°ÐºÐ¶Ðµ Ð¼Ð¾Ð¸ Ð½Ð°Ñ€Ð°Ð±Ð¾Ñ‚ÐºÐ¸. ÐŸÐ¾ÑÐºÐ¾Ð»ÑŒÐºÑƒ ÑÐ²Ð¾Ð¸Ñ… Ð´Ñ€ÑƒÐ·ÐµÐ¹ Ñ Ð¿Ñ€Ð¸Ð´ÑƒÐ¼Ð°Ð», Ð¾Ñ‚ÐµÑ† Ð½Ðµ Ð¸Ð½Ñ‚ÐµÑ€ÐµÑÑƒÐµÑ‚ÑÑ Ð¼Ð°ÑˆÐ¸Ð½Ð°Ð¼Ð¸, Ð° Ð´ÐµÐ´Ñƒ Ð¸ Ð¿Ð¾Ð´Ð°Ð²Ð½Ð¾ ÑÑ‚Ð¾ Ð½Ðµ Ð½ÑƒÐ¶Ð½Ð¾, Ñ‚Ð¾ Ð·Ð´ÐµÑÑŒ Ð±ÑƒÐ´ÑƒÑ‚ Ñ‚Ð¾Ð»ÑŒÐºÐ¾ Ð¼Ð¾Ð¸ Ñ„Ð¾Ñ‚Ð¾Ð³Ñ€Ð°Ñ„Ð¸Ð¸ Ð¿Ð¾ ÑÐ¾Ð¾Ñ‚Ð²ÐµÑ‚ÑÑ‚Ð²ÑƒÑŽÑ‰ÐµÐ¹ Ñ‚ÐµÐ¼Ð°Ñ‚Ð¸ÐºÐµ'),(13,'Ð•Ð³Ð¸Ð¿ÐµÑ‚','Ñ„Ð¾Ñ‚Ð¾ Ñ Ð¿ÑƒÑ‚ÐµÑˆÐµÑÑ‚Ð²Ð¸Ñ Ð² Ð•Ð³Ð¸Ð¿ÐµÑ‚ Ð¾Ñ‚ ÑÑ‹Ð½Ð° Ð¼Ð°Ð¼Ð¸Ð½Ð¾Ð¹ Ð¿Ð¾Ð´Ñ€ÑƒÐ³Ð¸, Ñ Ð¶Ðµ Ð´ÐµÐ½ÑŒÐ³Ð¸ Ð½Ð° Ð¼Ð°ÑˆÐ¸Ð½Ñƒ ÑÐ¾Ð±Ð¸Ñ€Ð°ÑŽ, Ð¼Ð½Ðµ Ð½Ðµ Ð´Ð¾ Ð¿ÑƒÑ‚ÐµÑˆÐµÑÑ‚Ð²Ð¸Ð¹');
/*!40000 ALTER TABLE `albums` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `text` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `images`
--

DROP TABLE IF EXISTS `images`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `album_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text,
  `file_path` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `album_id` (`album_id`),
  CONSTRAINT `images_ibfk_1` FOREIGN KEY (`album_id`) REFERENCES `albums` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `images`
--

LOCK TABLES `images` WRITE;
/*!40000 ALTER TABLE `images` DISABLE KEYS */;
INSERT INTO `images` VALUES (21,1,'Ð´Ð¾Ñ€Ð¾Ð³Ð° Ð² Ð»ÐµÑÑƒ','gf','../images/67ccf48d3ba70.jpg'),(25,1,'Ñ‚ÑƒÐ¼Ð°Ð½Ð½Ñ‹Ð¹ Ð»ÐµÑ','ÐºÑ€Ð°ÑÐ¸Ð²Ð¾Ðµ Ñ„Ð¾Ñ‚Ð¾, Ð²Ñ‹Ð¿Ð¾Ð»Ð½ÐµÐ½Ð½Ð¾Ðµ Ñ Ð´Ñ€Ð¾Ð½Ð°','../images/67cdde871770c.jpg'),(26,1,'Ñ‚ÐµÐ¼Ð½Ð°Ñ Ñ€Ð¾Ñ‰Ð°','Ð½Ð° ÑÑ‚Ð¾Ð¼ Ð¼Ð¾Ð¼ÐµÐ½Ñ‚Ðµ Ð´Ñ€Ð¾Ð½ Ñ€Ð°Ð·Ñ€ÑÐ´Ð¸Ð»ÑÑ, Ð¸ Ð¿Ñ€Ð¸ÑˆÐ»Ð¾ÑÑŒ Ñ„Ð¾Ñ‚Ð¾Ð³Ñ€Ð°Ñ„Ð¸Ñ€Ð¾Ð²Ð°Ñ‚ÑŒ ÑƒÐ¶Ðµ Ñ Ð·ÐµÐ¼Ð»Ð¸','../images/67cddeaf82c9f.jpg'),(27,11,'BMW','M5 F90 competition. Ð¡Ð¾Ð´ÐµÑ€Ð¶Ð°Ð½Ð¸Ðµ Ñ‚Ð°ÐºÐ¾Ð¹ ÑˆÑ‚ÑƒÐºÐ¸ Ð±ÑƒÐ´ÐµÑ‚ Ð¾Ð±Ñ…Ð¾Ð´Ð¸Ñ‚ÑŒÑÑ Ð² 3 Ð¼Ð¾Ð¸Ñ… Ð·Ð°Ñ€Ð¿Ð»Ð°Ñ‚Ñ‹ Ð² Ð¼ÐµÑÑÑ†','../images/67cdeba16ff75.jpg'),(28,11,'LADA 2105','Ð¶Ð¸Ð³ÑƒÐ»Ð¸','../images/67cdf6edbee6b.jpg'),(29,11,'Honda Accord X','Ð§ÑƒÐ´Ð¾Ð¼Ð¾Ð±Ð¸Ð»ÑŒ','../images/67cdf7095de95.jpg'),(30,11,'Mersedes','banana','../images/67cdf72c1a734.jpg'),(31,11,'Toyota Supra MKIV','Ð»ÐµÐ³ÐµÐ½Ð´Ð°Ñ€Ð½Ñ‹Ð¹ Ð°Ð²Ñ‚Ð¾Ð¼Ð¾Ð±Ð¸Ð»ÑŒ ÑÐ¿Ð¾Ð½ÑÐºÐ¾Ð³Ð¾ Ð°Ð²Ñ‚Ð¾Ð¿Ñ€Ð¾Ð¼Ð°, Ñ…Ð¾Ñ€Ð¾Ñˆ Ð½Ð°ÑÑ‚Ð¾Ð»ÑŒÐºÐ¾, Ñ‡Ñ‚Ð¾ Ð²Ð¼ÐµÑÑ‚Ð¾ Ð¾Ð´Ð½Ð¾Ð¹ Ð¿ÐµÑ€ÐµÐ´Ð½ÐµÐ¹ Ñ„Ð°Ñ€Ñ‹ Ñ‚ÑƒÐ´Ð° ÑÑ‚Ð°Ð²ÑÑ‚ Ð¾Ñ‚Ð²Ð¾Ð´ Ñ‚ÑƒÑ€Ð±Ð¸Ð½Ñ‹','../images/67cdfd65d97c6.jpg'),(32,11,'Honda Accord V','Ð¼Ð°ÑˆÐ¸Ð½Ð°, ÐºÐ¾Ñ‚Ð¾Ñ€ÑƒÑŽ Ñ Ð¿Ð»Ð°Ð½Ð¸Ñ€ÑƒÑŽ ÐºÑƒÐ¿Ð¸Ñ‚ÑŒ. Ð”Ð° - Ð¾Ð½Ð° ÑÑ‚Ð°Ñ€Ð°Ñ, Ð´Ð° - Ð² Ð½ÐµÑ‘ Ð½ÑƒÐ¶Ð½Ð¾ Ð±ÑƒÐ´ÐµÑ‚ Ð²Ð»Ð¾Ð¶Ð¸Ñ‚ÑŒ Ð½ÐµÐ¼Ð°Ð»Ð¾ Ð´ÐµÐ½ÐµÐ³, Ð´Ð° - Ð¾Ð±ÑÐ»ÑƒÐ¶Ð¸Ð²Ð°Ñ‚ÑŒ ÐµÑ‘ Ð½ÑƒÐ¶Ð½Ð¾ ÐºÐ°Ðº Ð‘ÐœÐ’. Ð¯ Ð² ÐºÑƒÑ€ÑÐµ, Ð½Ðµ Ð±ÐµÑÐ¿Ð¾ÐºÐ¾Ð¹Ñ‚ÐµÑÑŒ)','../images/67cdff3952944.jpg'),(33,11,'ACCORD V','ÐµÑ‰Ðµ Ð¾Ð´Ð¸Ð½ Ð°ÐºÐºÐ¾Ñ€Ð´','../images/67ce1b5da83c6.jpg');
/*!40000 ALTER TABLE `images` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `likes`
--

DROP TABLE IF EXISTS `likes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `likes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image_id` int(11) DEFAULT NULL,
  `type` enum('like','dislike') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `image_id` (`image_id`),
  CONSTRAINT `likes_ibfk_1` FOREIGN KEY (`image_id`) REFERENCES `images` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `likes`
--

LOCK TABLES `likes` WRITE;
/*!40000 ALTER TABLE `likes` DISABLE KEYS */;
/*!40000 ALTER TABLE `likes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-03-10  2:49:52
