CREATE DATABASE  IF NOT EXISTS `brianclincy` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `brianclincy`;
-- MySQL dump 10.13  Distrib 5.7.21, for Linux (x86_64)
--
-- Host: localhost    Database: brianclincy
-- ------------------------------------------------------
-- Server version	5.7.21-0ubuntu0.17.10.1

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
-- Table structure for table `Shoutouts`
--

DROP TABLE IF EXISTS `Shoutouts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Shoutouts` (
  `idShoutouts` int(24) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `shoutout` mediumtext NOT NULL,
  `website` varchar(200) DEFAULT NULL COMMENT ' website with shoutout	',
  `slugs` varchar(255) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idShoutouts`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Shoutouts`
--

LOCK TABLES `Shoutouts` WRITE;
/*!40000 ALTER TABLE `Shoutouts` DISABLE KEYS */;
INSERT INTO `Shoutouts` VALUES (1,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ','NULL','[\"family\", \" My Mom\"]','2018-02-04 18:45:03','NULL'),(2,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ','NULL','[\"family\", \" My Mom\"]','2018-02-04 18:45:10','NULL'),(3,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ','Array','[\"family\", \" My Mom\"]','2018-02-05 16:04:44','Array'),(4,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ','Array','[\"family\", \" My Mom\"]','2018-02-05 20:40:03','Array'),(5,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:32:34',NULL),(6,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:33:22',NULL),(7,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:35:53',NULL),(8,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:36:32',NULL),(9,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:37:34',NULL),(10,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 22:38:13',NULL),(11,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 23:05:46',NULL),(12,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-05 23:15:32','works'),(13,'My Family','My family is not the driving force, they are also my legancy. My mom has always been there for me, we may have not had a lot but I\'ve alway have had my mom love. Being 15 with \'2\' kids  never hinder her ability to not be the perfect parent but she was the best parent I could have asked for. Sisters who whipped me into shape and lead the trail and came up behind me. ',NULL,'[\"family\",\" My Mom\"]','2018-02-06 21:05:44','works');
/*!40000 ALTER TABLE `Shoutouts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contact`
--

DROP TABLE IF EXISTS `contact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `subject` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:simple_array)',
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `isReturned` tinyint(1) NOT NULL DEFAULT '0',
  `recievedOn` datetime NOT NULL,
  `serverDump` mediumtext COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello World we have the time to go',0,'2018-01-21 01:54:15',NULL),(2,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello World',0,'2018-01-21 10:28:51',NULL),(3,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello World',0,'2018-01-21 10:29:57',NULL),(4,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello world',0,'2018-01-21 10:38:29',NULL),(5,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello world',0,'2018-01-21 10:40:19',NULL),(6,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello world',0,'2018-01-21 10:46:12',NULL),(7,'Brian','Clincy','bclincy@gmail.com','Talk to me','Hello world',0,'2018-01-21 10:48:39',NULL);
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docs`
--

DROP TABLE IF EXISTS `docs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `keywords` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `createdDate` datetime NOT NULL,
  `docType` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT 'Web',
  `authorID` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `active` smallint(6) NOT NULL DEFAULT '0',
  `docName` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docs`
--

LOCK TABLES `docs` WRITE;
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
INSERT INTO `docs` VALUES (1,'About Brian','Brian Clincy, bclincy, bclincy photos, photos by brian',NULL,'<h1>I am...</h1><p>If you google me, you will see that a lot, and it\'s because I am whatever I want to be, and the first thing I will tell you is that I am a man that God has blessed with a life that I am appreciative of.','2017-10-07 07:39:43','Web',1,1,'About','[\"about\", \"personality\"]'),(2,'The Business','Brian Clincy, bclincy, bclincy photos, photos by brian',NULL,'<h1>I am a Business</h1><p>If you google me, You\'ll find out about a lot of what I\'ve done online, but wait there\'s more. I am about to change a lot of people lives by launch a series of business, that will give them ownership of a company and say so in the direction of a company','2017-10-08 04:20:46','Web',1,1,'InBusiness','[\"about\", \"blog\"]'),(3,'ACHIEVE','Healthy Community, Brian Healthy Initatives, Wellness','Health and wellness is are one of the same, and Action Communities for Health Innovation and EnVironmental ChangE helped me understand. It was a journey of knowledge','<h1>Health and Wellness are not Same</h1><p>Action Communities for Health Innovation and EnVironmental ChangE (ACHIEVE) helped me understand. It was a journey of knowledge and wisdom. It help me understand how Enviormental changes can change also be health and have economical impact.<p>','2017-11-14 20:58:23','Web',1,1,'ACHIEVE','[\"community\", \"garden\", \"government\", \"health\", \"policy\"]'),(4,'Testing','Brian','Sweet','Need more content','2017-11-19 07:19:59','web',1,1,'test','[\"about\", \"garden\", \"life\", \"love\", \"real\"]'),(5,'Goals','Goals, brian clincy, My goals, Goals from the hood','I got goals and they\'re really not ','    <img src=\"/images/seeMySuccess.jpg\" width=\"756\" height=\"351\" alt=\"I believe in the future\" />\n    <h1>My Goals</h1>\n    <p>Brian Clincy, I\'m a work in process. Everyday my goal is to be collectively be better than I was yesterday. Today at\n    the intersection of knowledge and wisdom meet is where you\'ll find me. As I share my journey and status of everyday\n    lessons my dream is to help other avoid my pitfalls, and connect my history with my future.</p>\n<p><a name=\"continue\"></a>\n    See my Granny (Beatrice Pascal) always had goals, and you\'d often see them written down around the house. I didn\'t\n    know how much of a hustler my granny was, but she was a dreamer. She was a person who bought real estate, and other\n    ways of making her dreams reality. She was my hero, and her motivation and had a lasting impact on me. So I developed\n    goals like my granny. The financial goals wasn\'t the only goals my granny had, she wanted to make sure her kids had\n    the tools they needed to make it. Out of this I learned how taking care of family is priority.\n</p>\n<p>I started a podcast called NNUtS as in Nothing New Under the Sun, because I thought about all the things my grandmother\n    had told me. All the game my great cousin Sonny-Man also gave me. Those old sayings, like \"See a fool leave a fool,\n    or you might end up acting like a fool!\" are classic and need to be shared. Nothing new under the sun is tribute to\n    how all things are \'New\' has already been done before (You aint doing nothing but the funky chicken). It is my hope\n    that I get to share these with my future generations, so they can see what was passed down to me, for them.\n</p>\n<p>Part of my work in progress is to leave the world a better place than what I found it. I want to be a net positive for\n    the future. My goal is to be as efficient as possible. I want to use less gasoline, least possible petroleum based\n    products and appreciate the earth resources\n</p>','2017-12-03 20:44:56','Post',1,1,'My Goals','{\"blog\": [\"Growth\", \"Personal Growth\"]}');
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `newsletter`
--

DROP TABLE IF EXISTS `newsletter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `newsletter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(120) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `addedOn` datetime NOT NULL,
  `referrer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `list` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `newsletter`
--

LOCK TABLES `newsletter` WRITE;
/*!40000 ALTER TABLE `newsletter` DISABLE KEYS */;
/*!40000 ALTER TABLE `newsletter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podcast`
--

DROP TABLE IF EXISTS `podcast`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcast` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastBuildDate` datetime NOT NULL,
  `pubDate` datetime NOT NULL,
  `webmaster` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `guid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_D7E805BD36AC99F1` (`link`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast`
--

LOCK TABLES `podcast` WRITE;
/*!40000 ALTER TABLE `podcast` DISABLE KEYS */;
INSERT INTO `podcast` VALUES (1,'1st Outtakes','Getting started with my podcast finally and Dez is fooling, it was good  look at how much fun you can have with your daughter. check us out on https://www.facebook.com/NNUTSun/ and more to come at brianclincy.com/NNUTS','http://brianclincy.com/nnuts/1st_outtakes','en','2017-10-24 03:18:38','2017-10-26 03:18:29','bclincy','1','http://brianclincy.com/podcast/1stouttakes.mp3','https://www.youtube.com/watch?v=3JDfJZCcgcg');
/*!40000 ALTER TABLE `podcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post`
--

DROP TABLE IF EXISTS `post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tags` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `body` mediumtext CHARACTER SET utf8 NOT NULL,
  `createdOn` datetime NOT NULL,
  `weight` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_type`
--

DROP TABLE IF EXISTS `post_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `lft` int(11) NOT NULL,
  `rgt` int(11) NOT NULL,
  `dateCreated` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_458B30225E237E06` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_type`
--

LOCK TABLES `post_type` WRITE;
/*!40000 ALTER TABLE `post_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `fname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DOB` date NOT NULL,
  `customerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_8D93D64992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_8D93D649A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_8D93D649C05FB297` (`confirmation_token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'brianclincy'
--

--
-- Dumping routines for database 'brianclincy'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-03 17:51:31
GRANT ALL PRIVILEGES ON brianclincy.* TO 'bclincy'@'localhost' IDENTIFIED BY 'klincy1';