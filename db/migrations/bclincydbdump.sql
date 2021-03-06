-- MySQL dump 10.13  Distrib 5.7.25, for Linux (x86_64)
--
-- Host: localhost    Database: brianclincy
-- ------------------------------------------------------
-- Server version	5.7.25-0ubuntu0.18.04.2

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
-- Table structure for table `Community`
--

DROP TABLE IF EXISTS `Community`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Community` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` varchar(255) NOT NULL,
  `Description` mediumtext NOT NULL,
  `location` varchar(255) NOT NULL DEFAULT 'Muskegon, MI',
  `tags` varchar(255) DEFAULT NULL,
  `modified` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Community';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Community`
--

LOCK TABLES `Community` WRITE;
/*!40000 ALTER TABLE `Community` DISABLE KEYS */;
INSERT INTO `Community` VALUES (1,'Love Community Garden','Grassroots organization that works toward improving the quality of life Muskegon and surround commmunity. A faction of people who just wanted to grow food, became a group of people who created change in Muskegon, MI. \nI learned best principles in garden. I Learned how to care for the soil, I learned the difference from the soil and the dirt. I learn that people come together around food, and how important it is for clean water. \nI met some pretty inspiring people. Throughout the garden world it was people building some incredible things from design an rain water system to growing plants for fixtures for shade. Amazing people that fought for fair treatment of people and their freedom from systems that put junk food in school meals. I met modern day freedom fighters that just wanted to do good for their community\nDuties: Built the Web sites, create marketing material, photographer, videographer and promotional video producer, grant writer, developing reporting, creating and presenting project deliverable to other organizations and help in community projects: building a hoop house, putting together multiple Mini gardens, organizing youth events and leading youth in field trips and activities.','400 Monroe Ave, Muskegon, MI 49441','Learning, garden, impressive people','2018-09-23 07:04:26','2018-09-23 07:04:14');
/*!40000 ALTER TABLE `Community` ENABLE KEYS */;
UNLOCK TABLES;

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
-- Table structure for table `board_apps`
--

DROP TABLE IF EXISTS `board_apps`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `board_apps` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fname` varchar(255) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `bio` mediumtext,
  `address` varchar(200) DEFAULT NULL,
  `address_2` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `zipcode` varchar(100) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `state` varchar(70) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_CA8A2779AF37D4EA` (`fname`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Board Applications';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `board_apps`
--

LOCK TABLES `board_apps` WRITE;
/*!40000 ALTER TABLE `board_apps` DISABLE KEYS */;
/*!40000 ALTER TABLE `board_apps` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `boardapps_states`
--

DROP TABLE IF EXISTS `boardapps_states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `boardapps_states` (
  `boardapps_id` int(11) NOT NULL,
  `states_id` int(11) NOT NULL,
  PRIMARY KEY (`boardapps_id`,`states_id`),
  KEY `IDX_4430435EF7FAC555` (`boardapps_id`),
  KEY `IDX_4430435EB17973F` (`states_id`),
  CONSTRAINT `FK_4430435EF7FAC555` FOREIGN KEY (`boardapps_id`) REFERENCES `board_apps` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `boardapps_states`
--

LOCK TABLES `boardapps_states` WRITE;
/*!40000 ALTER TABLE `boardapps_states` DISABLE KEYS */;
/*!40000 ALTER TABLE `boardapps_states` ENABLE KEYS */;
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
  `modifiedOn` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact`
--

LOCK TABLES `contact` WRITE;
/*!40000 ALTER TABLE `contact` DISABLE KEYS */;
INSERT INTO `contact` VALUES (1,'Brian','Clincy','bclincy@gmail.com','general','Let\'s go into the out now!!!',0,'2018-10-10 13:50:59',NULL,'2018-10-10 13:50:59'),(2,'Brian','K','bclincy@gmail.com','suggestions','hello world',0,'2019-03-14 23:24:24',NULL,'2019-03-14 23:24:24'),(3,'Brian','Clincy','CEEC12@GMAIL.COM','Talk to me','testing',0,'2019-03-14 23:25:36',NULL,'2019-03-14 23:25:36');
/*!40000 ALTER TABLE `contact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customers`
--

DROP TABLE IF EXISTS `customers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customers` (
  `customerNumber` int(11) NOT NULL,
  `customerName` varchar(50) NOT NULL,
  `contactLastName` varchar(50) NOT NULL,
  `contactFirstName` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` varchar(15) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `salesRepEmployeeNumber` int(11) DEFAULT NULL,
  `creditLimit` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`customerNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customers`
--

LOCK TABLES `customers` WRITE;
/*!40000 ALTER TABLE `customers` DISABLE KEYS */;
/*!40000 ALTER TABLE `customers` ENABLE KEYS */;
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
  `docType` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `docName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_id` int(11) NOT NULL DEFAULT '1',
  `defaultImage` varchar(150) COLLATE utf8_unicode_ci DEFAULT '/images/brianclincy.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_51572BB72B36786B` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docs`
--

LOCK TABLES `docs` WRITE;
/*!40000 ALTER TABLE `docs` DISABLE KEYS */;
INSERT INTO `docs` VALUES (1,'About Brian','Brian Clincy, bclincy, bclincy photos, photos by brian','Introducing Brian Clincy, one of the coolest hardworking technical guy you\'ll ever meet. On top of all of that he\'s just trying to be best person he can be and leave this world better than he found it.','<h1>I am...</h1><p>If you <a href=\"https://google.com/search?q=Brian#%20Clincy\" target=\"#_new\">google me</a> the results will have diverse results because I\'ve been around a few corners and been apart of different organizations, movements and I have an opinion on all of it. I\'m dynamic and my nature is to there is always more solutions to most challenges. I have been blessed with a life that has had a multitude of reinventions, becoming a better version of myself from a vision of knowledge and wisdom.</p><p>I don\'t like to talk about all of the things I\'ve done, the way I\'d have it is to let other people tell my story. I\'m one of those guys who won\'t tell you how talented his children are, I\'d like to let their body of work speak for them. I am all about action and letting someone narrate the process.</p>','2017-10-07 07:39:43','Web',1,'About','{\"about\": [\"personality\"]}',1,'/images/brianclincy.jpg'),(2,'The Business','Brian Clincy, bclincy, bclincy photos, photos by brian',NULL,'<h1>I am a Business</h1><p>If you google me, You\'ll find out about a lot of what I\'ve done online, but wait there\'s more. I am about to change a lot of people lives by launch a series of business, that will give them ownership of a company and say so in the direction of a company','2017-10-08 04:20:46','Web',1,'InBusiness','{\"about\": [\"Business\"]}',1,'/images/brianclincy.jpg'),(3,'ACHIEVE','Healthy Community, Brian Healthy Initatives, Wellness','Health and wellness is are one of the same, and Action Communities for Health Innovation and EnVironmental ChangE helped me understand. It was a journey of knowledge','<h1>Health and Wellness are not Same</h1><p>Action Communities for Health Innovation and EnVironmental ChangE (ACHIEVE) helped me understand. It was a journey of knowledge and wisdom. It help me understand how Enviormental changes can change also be health and have economical impact.<p>','2017-11-14 20:58:23','Web',1,'ACHIEVE','{\"community\":[\"community\", \"garden\", \"government\", \"health\", \"policy\"]}',1,'/images/brianclincy.jpg'),(4,'Testing','Brian','Sweet','Need more content','2017-11-19 07:19:59','web',1,'test','{\"about\":[\"garden\", \"life\", \"love\", \"real\"]}',1,'/images/brianclincy.jpg'),(5,'Goals','Goals, brian clincy, My goals, Goals from the hood','I got goals and they\'re really not ','    <img src=\"/images/seeMySuccess.jpg\" width=\"756\" height=\"351\" alt=\"I believe in the future\" />\n    <h1>My Goals</h1>\n    <p>Brian Clincy, I\'m a work in process. Everyday my goal is to be collectively be better than I was yesterday. Today at\n    the intersection of knowledge and wisdom meet is where you\'ll find me. As I share my journey and status of everyday\n    lessons my dream is to help other avoid my pitfalls, and connect my history with my future.</p>\n<p><a name=\"continue\"></a>\n    See my Granny (Beatrice Pascal) always had goals, and you\'d often see them written down around the house. I didn\'t\n    know how much of a hustler my granny was, but she was a dreamer. She was a person who bought real estate, and other\n    ways of making her dreams reality. She was my hero, and her motivation and had a lasting impact on me. So I developed\n    goals like my granny. The financial goals wasn\'t the only goals my granny had, she wanted to make sure her kids had\n    the tools they needed to make it. Out of this I learned how taking care of family is priority.\n</p>\n<p>I started a podcast called NNUtS as in Nothing New Under the Sun, because I thought about all the things my grandmother\n    had told me. All the game my great cousin Sonny-Man also gave me. Those old sayings, like \"See a fool leave a fool,\n    or you might end up acting like a fool!\" are classic and need to be shared. Nothing new under the sun is tribute to\n    how all things are \'New\' has already been done before (You aint doing nothing but the funky chicken). It is my hope\n    that I get to share these with my future generations, so they can see what was passed down to me, for them.\n</p>\n<p>Part of my work in progress is to leave the world a better place than what I found it. I want to be a net positive for\n    the future. My goal is to be as efficient as possible. I want to use less gasoline, least possible petroleum based\n    products and appreciate the earth resources\n</p>','2017-12-03 20:44:56','Post',1,'goals','{\"blog\": [\"Growth\", \"Personal Growth\"]}',1,'/images/brianclincy.jpg'),(6,'Brian Clincy Professional Bio','Brian Clincy, Professional Bio, The entrepreneur, technology, clincy in technology, Top 40 under 40','Brian Clincy professional bio, where you will learn about his contributes to Technology and technical ideology.','<h1>In my Profession</h1>Brian Clincy is an entrepreneur who specializes in innovative technology, designing and programming solutions in eCommerce, data aggregation, and customer added value services. The eternal optimist, Brian uses his powers to fight waste and increase usability. Brian’s hustle and thirst for knowledge propels him forward as one of the hardest working people in technology that you’ll ever have met. Brian channels his inner Steve Jobs by matching complexity of problems with solutions designed not to look like what it does, but to actually work like it’s designed. *\n                         Brian has landed coverage in numerous media outlets, he’s been a driving force for change and diversity. Between his work with technology and community organizing he’s landed in The Top 40 under 40 publish by mlive.com. His services to the community made him one of the founding board members of TEDx Muskegon, the Chairman of a federal designated Healthy Community Initiative Project (ACHIEVE),  a TEDx Presenter, a MPS Parent Advocate and PTO President, a candidate for a local school board, and published article writer. \n                         * Steve Jobs, “Design is not just what it looks like and feels like. Design is how it works.”\n                         --Brian co-founded a software solutions company and lead the start-up for over 10 years, working through the ranks of the Designer, Web Developer, Dev Manager, and project manager. Through failed deadlines, long nights, and early mornings, Brian created a process that helped produce products that have had a 5 year production life. \n','2018-10-31 07:21:00','web',1,'bio professional','{\"about\": [\"Bio\", \"Profession\"]}',1,'/images/brianclincy.jpg'),(7,'Brian Clincy presents NNUtS Nothing New Under the Sun with Brian Clincy','Podcast, NNUtS, Nothing New Under the Sun, Money, Family, Sports, Entertainment, Enlightment ','Brian Clincy presents the Nothing New Under the Sun the Podcast. This podcast is my legacy, it is the beautiful blessing of life and I\'m sharing knowledge from the old-school to the new-school.','<p>Brian Clincy presents the Nothing New Under the Sun the Podcast. NNUtS is legacy project to transfer the knowledge my family and friends has blessed me with. My granny was something like a profit and also a shooter, and just gives you context on how people can be dynamic and the lines are often blur. This is my journey of connecting the old-school with the new-school.</p>','2019-04-21 22:46:12','web',1,'nnuts','{\"podcast\" : [\"NNUts\"]}',1,'/images/socialMediaNNUts.jpeg');
/*!40000 ALTER TABLE `docs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobleads`
--

DROP TABLE IF EXISTS `jobleads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobleads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `agency` varchar(255) DEFAULT NULL,
  `DevType` varchar(50) DEFAULT NULL,
  `note` mediumtext,
  `linkedIn` varchar(200) DEFAULT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobleads`
--

LOCK TABLES `jobleads` WRITE;
/*!40000 ALTER TABLE `jobleads` DISABLE KEYS */;
INSERT INTO `jobleads` VALUES (1,'Brian Clincy','bclincy@gmail.com','None','DRUPAL','I think you\'re freaking awesome','http://linkedIn.com/in/bclincy','2018-10-20 02:04:56','2018-10-20 02:04:56'),(2,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying','http://linkedIn.com/in/bclincy','2018-10-21 05:35:42','2018-10-21 05:35:42'),(3,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying hello','http://linkedIn.com/in/bclincy','2018-10-21 05:51:26','2018-10-21 05:51:26'),(4,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying hello','http://linkedIn.com/in/bclincy','2018-10-21 05:54:17','2018-10-21 05:54:17'),(5,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying hello','http://linkedIn.com/in/bclincy','2018-10-21 05:56:09','2018-10-21 05:56:09'),(6,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying hello','http://linkedIn.com/in/bclincy','2018-10-21 06:46:33','2018-10-21 06:46:33'),(7,'Brian Clincy','bclincy@gmail.com','','PHP','I\'m trying hello people','http://linkedIn.com/in/bclincy','2018-10-21 06:56:14','2018-10-21 06:56:14'),(8,'Brian Clincy','bclincy@gmail.com','None','DRUPAL','I think you\'re freaking awesome','http://linkedIn.com/in/bclincy','2018-10-21 08:22:44','2018-10-21 08:22:44'),(9,'Brian Clincy','bclincy@gmail.com','none','DRUPAL','Just want to see the resume','https://linkedin.com/in/brianclincy','2019-02-04 10:57:00','2019-02-04 10:57:00');
/*!40000 ALTER TABLE `jobleads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` varchar(255) NOT NULL,
  `description` mediumtext,
  `isActive` tinyint(4) DEFAULT '0',
  `created` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime DEFAULT NULL,
  `tags` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `links_url_uindex` (`url`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1 COMMENT='All the links I think are cool';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (2,'https://www.ted.com/tedx/events/1670','TEDxMuskegon was started with two of my mentors brought me to the table as they felt like it was an awesome opportunity, to share ideas. Sharing ideas that could help our community be prospers. We pull it off and it was great, and during the years we got to hear and meet some some pretty interesting people. Checkout the videos and let me know what you think. I also got to do my own TEDx Talk.',1,'2018-09-07 00:38:44','2018-09-07 00:38:49',NULL),(3,'https://c9.io','Awesome cloud provider that great for testing and deploying and it\'s free so learn how to administrator your software and application. Start up a node app and create something awesome.',1,'2018-09-07 01:32:44','2018-09-07 01:32:49',NULL),(4,'http://lovecommunitygarden.com','Love Community Garden is a real garden in the city of Muskegon, Michigan providing knowledge, a safe place, and fresh produce to the community in which it\'s vital piece in sustainability and progress. ',1,'2018-09-23 09:20:47','2018-09-23 09:21:00',NULL);
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `relpath` varchar(255) NOT NULL,
  `filepath` varchar(255) NOT NULL,
  `savefile` blob,
  `displayOg` tinyint(1) DEFAULT '0',
  `ogType` varchar(20) DEFAULT 'image',
  `createdOn` datetime DEFAULT NULL,
  `modifiedOn` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `docId` int(11) DEFAULT NULL,
  `postId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,'/images/gallery/clincy/custom_made_signs.jpg','/var/www/b/public/images/gallery/clincy/custom_made_signs.jpg',NULL,0,'image','2018-10-13 12:10:02','2018-10-13 16:10:11',1,NULL),(2,'/images/gallery/clincy/dreaming.jpg','/var/www/b/public/images/gallery/clincy/dreaming.jpg',NULL,0,'image','2018-10-13 12:14:39','2018-10-13 16:14:51',1,NULL);
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `message` mediumtext NOT NULL,
  `created_on` datetime DEFAULT NULL,
  `update_on` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1 COMMENT='Site messages';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (1,'contactFrm','<h3>Thank you for Being Awesome!</h3>\n<p>We have received your message and would like to thank you for writing to us. If your inquiry is urgent, please use the telephone number listed below to talk to one of our staff members. Otherwise, we will reply by email as soon as possible.</p>\n   \n<p class=\"mt-3\">If your email requires a response please allow 24 hours to response.</p>','2018-09-21 09:25:21','2018-09-21 09:25:32');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
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
-- Table structure for table `offices`
--

DROP TABLE IF EXISTS `offices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `offices` (
  `officeCode` varchar(10) NOT NULL,
  `city` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `addressLine1` varchar(50) NOT NULL,
  `addressLine2` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `country` varchar(50) NOT NULL,
  `postalCode` varchar(15) NOT NULL,
  `territory` varchar(10) NOT NULL,
  PRIMARY KEY (`officeCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `offices`
--

LOCK TABLES `offices` WRITE;
/*!40000 ALTER TABLE `offices` DISABLE KEYS */;
/*!40000 ALTER TABLE `offices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orderdetails` (
  `orderNumber` int(11) NOT NULL,
  `productCode` varchar(15) NOT NULL,
  `quantityOrdered` int(11) NOT NULL,
  `priceEach` decimal(10,2) NOT NULL,
  `orderLineNumber` smallint(6) NOT NULL,
  PRIMARY KEY (`orderNumber`,`productCode`),
  KEY `productCode` (`productCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `orders` (
  `orderNumber` int(11) NOT NULL,
  `orderDate` date NOT NULL,
  `requiredDate` date NOT NULL,
  `shippedDate` date DEFAULT NULL,
  `status` varchar(15) NOT NULL,
  `comments` text,
  `customerNumber` int(11) NOT NULL,
  PRIMARY KEY (`orderNumber`),
  KEY `customerNumber` (`customerNumber`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`customerNumber`) REFERENCES `customers` (`customerNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payments`
--

DROP TABLE IF EXISTS `payments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payments` (
  `customerNumber` int(11) NOT NULL,
  `checkNumber` varchar(50) NOT NULL,
  `paymentDate` date NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  PRIMARY KEY (`customerNumber`,`checkNumber`),
  CONSTRAINT `payments_ibfk_1` FOREIGN KEY (`customerNumber`) REFERENCES `customers` (`customerNumber`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payments`
--

LOCK TABLES `payments` WRITE;
/*!40000 ALTER TABLE `payments` DISABLE KEYS */;
/*!40000 ALTER TABLE `payments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `phinxlog`
--

DROP TABLE IF EXISTS `phinxlog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `phinxlog` (
  `version` bigint(20) NOT NULL,
  `migration_name` varchar(100) DEFAULT NULL,
  `start_time` timestamp NULL DEFAULT NULL,
  `end_time` timestamp NULL DEFAULT NULL,
  `breakpoint` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `phinxlog`
--

LOCK TABLES `phinxlog` WRITE;
/*!40000 ALTER TABLE `phinxlog` DISABLE KEYS */;
/*!40000 ALTER TABLE `phinxlog` ENABLE KEYS */;
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
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `language` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'english',
  `lastBuildDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `pubDate` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `webmaster` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `media` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `video` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `image_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'http://brianclincy.com/images/nnuts-rss.jpg',
  `duration` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '01:00:00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast`
--

LOCK TABLES `podcast` WRITE;
/*!40000 ALTER TABLE `podcast` DISABLE KEYS */;
INSERT INTO `podcast` VALUES (1,'1st Outtakes','Getting started with my podcast finally and Dez is fooling, it was good  look at how much fun you can have with your daughter. check us out on https://www.facebook.com/NNUTSun/ and more to come at brianclincy.com/NNUTS','http://brianclincy.com/nnuts/1st_outtakes','en','2017-10-24 03:18:38','2017-10-26 03:18:29','bclincy','https://s3.us-east-2.amazonaws.com/black-rob-place/NNUTS+OutTakes.mp3','http://brianclincy.com/podcast/1stouttakes.mp3','https://www.youtube.com/watch?v=3JDfJZCcgcg','2019-04-08 03:18:44','2019-04-08 03:18:45','http://brianclincy.com/images/nnuts-rss.jpg','01:00:00'),(2,'NNUTS Podcast Generational Credit eps 1','Nothing New Under the sun\'s With special Guest Destiana Clincy, tackling issues of lessons learn, Trump investigating University for reverse discrimination, Colin Stand, Smoking Weed Parenting, and word association, and naming cars.','http://brianclincy.com/nnuts/NNUTS_Podcast_Generational_Credit_eps_1','en','2018-09-09 16:40:53','2017-08-27 16:41:27','bclincy','https://s3.us-east-2.amazonaws.com/black-rob-place/NNUTS+Podcast+Generational+Credit+eps+1.mp3\n','http://brianclincy.com/prodcast/NNUTS_Generational_Credit_eps 1.mp3','https://www.youtube.com/watch?v=DGlVLjbr2uo','2019-04-08 03:18:44','2019-04-08 03:18:45','http://brianclincy.com/images/socialMediaNNUts.jpeg','01:00:00');
/*!40000 ALTER TABLE `podcast` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podcast_guest`
--

DROP TABLE IF EXISTS `podcast_guest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcast_guest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstName` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastName` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `isConnected` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast_guest`
--

LOCK TABLES `podcast_guest` WRITE;
/*!40000 ALTER TABLE `podcast_guest` DISABLE KEYS */;
/*!40000 ALTER TABLE `podcast_guest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podcast_notes`
--

DROP TABLE IF EXISTS `podcast_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcast_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `noteName` varchar(255) NOT NULL,
  `description` longtext,
  `link` varchar(200) DEFAULT NULL,
  `linkText` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tags` varchar(255) DEFAULT NULL,
  `podcast_id` int(11) DEFAULT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `IDX_7E9A8FA9786136AB` (`podcast_id`),
  CONSTRAINT `FK_7E9A8FA9786136AB` FOREIGN KEY (`podcast_id`) REFERENCES `podcast` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='Pieces of podcast that make it';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast_notes`
--

LOCK TABLES `podcast_notes` WRITE;
/*!40000 ALTER TABLE `podcast_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `podcast_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `podcast_podcastnote`
--

DROP TABLE IF EXISTS `podcast_podcastnote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `podcast_podcastnote` (
  `podcast_id` int(11) NOT NULL,
  `podcastnote_id` int(11) NOT NULL,
  PRIMARY KEY (`podcast_id`,`podcastnote_id`),
  KEY `IDX_3986B7E8786136AB` (`podcast_id`),
  KEY `IDX_3986B7E894A5BAB8` (`podcastnote_id`),
  CONSTRAINT `FK_3986B7E8786136AB` FOREIGN KEY (`podcast_id`) REFERENCES `podcast` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_3986B7E894A5BAB8` FOREIGN KEY (`podcastnote_id`) REFERENCES `podcast_notes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `podcast_podcastnote`
--

LOCK TABLES `podcast_podcastnote` WRITE;
/*!40000 ALTER TABLE `podcast_podcastnote` DISABLE KEYS */;
/*!40000 ALTER TABLE `podcast_podcastnote` ENABLE KEYS */;
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
  `body` mediumtext CHARACTER SET utf8 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  `slug` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_5A8A6C8D2B36786B` (`title`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post`
--

LOCK TABLES `post` WRITE;
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` VALUES (1,'Growing','Growing, inspired, proverty, ','<h1>I\'m Growing</h1><p>I used to think my life was special, I used to think that the stuff I went through probably nobody could do what I\'ve done. In actuality there is a lot of people that have had it worse, and then I put it in perspective. As I\'ve raised my kids and try to understand how bad they have it. I think about how I was so appreciative of what I did have. You\'ll here me say, \"My mom was 15 when she had me and I\'m the second oldest\". I grew up with my mother. I grew up in some of the poverty stricken, areas in Michigan and the growth is where I started.</p>\n<p>The time and experience gave me knowledge of myself. They gave me knowledge of the game. When I say the game, I\'m really saying how the system works. I\'m a systems guy I have to learn to operate where the holes in the system and opportunity cost of managing system processes.</p>',0,'bee notes',100,'2018-09-22 08:52:25','2019-04-07 22:21:12');
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
-- Table structure for table `productlines`
--

DROP TABLE IF EXISTS `productlines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `productlines` (
  `productLine` varchar(50) NOT NULL,
  `textDescription` varchar(4000) DEFAULT NULL,
  `htmlDescription` mediumtext,
  `image` mediumblob,
  PRIMARY KEY (`productLine`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `productlines`
--

LOCK TABLES `productlines` WRITE;
/*!40000 ALTER TABLE `productlines` DISABLE KEYS */;
INSERT INTO `productlines` VALUES ('Outfits','Live life and go random, let me know a little about your style and I\'ll put something together for you. Outfits from head to toe customized just for you.',NULL,NULL),('T-Shirts','Attention smart enthusiasts: I\'m got some custom smart witty T-shirts. When people read\n  your shirt, the response will be a woke head-nod or look of wonder that might question you.',NULL,NULL);
/*!40000 ALTER TABLE `productlines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `productCode` varchar(15) NOT NULL,
  `productLine` varchar(50) NOT NULL,
  `productScale` varchar(10) NOT NULL,
  `productVendor` varchar(50) NOT NULL,
  `productDescription` text NOT NULL,
  `quantityInStock` smallint(6) NOT NULL,
  `buyPrice` decimal(10,2) NOT NULL,
  `MSRP` decimal(10,2) NOT NULL,
  `productName` varchar(70) NOT NULL,
  PRIMARY KEY (`prod_id`),
  KEY `productLine` (`productLine`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (2,'t00198901','2','1:10','clincy','T-shirt Supreme Legal Team Thurgood Marshall Est 1908',0,19.99,25.99,'Supreme Legal Team'),(3,'t00198901','2','1:10','clincy','Stay Woke, Can\'t afford to Sleep',0,19.99,25.99,'Stay Woke');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `states`
--

DROP TABLE IF EXISTS `states`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `states` (
  `stateId` int(11) NOT NULL AUTO_INCREMENT,
  `state` varchar(25) NOT NULL,
  `abbreviation` varchar(2) NOT NULL,
  PRIMARY KEY (`stateId`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `states`
--

LOCK TABLES `states` WRITE;
/*!40000 ALTER TABLE `states` DISABLE KEYS */;
INSERT INTO `states` VALUES (1,'Alabama','AL'),(2,'Alaska','AK'),(3,'American Samoa','AS'),(4,'Arizona','AZ'),(5,'Arkansas','AR'),(6,'California','CA'),(7,'Colorado','CO'),(8,'Connecticut','CT'),(9,'Delaware','DE'),(10,'District of Co','DC'),(11,'FS OF Micrones','FM'),(12,'Florida','FL'),(13,'Georgia','GA'),(14,'Guam','GU'),(15,'Hawaii','HI'),(16,'Idaho','ID'),(17,'Illinois','IL'),(18,'Indiana','IN'),(19,'Iowa','IA'),(20,'Kansas','KS'),(21,'Kentucky','KY'),(22,'Louisiana','LA'),(23,'Maine','ME'),(24,'Marshall Islan','MH'),(25,'Maryland','MD'),(26,'Massachusetts','MA'),(27,'Michigan','MI'),(28,'Minnesota','MN'),(29,'Mississippi','MS'),(30,'Missouri','MO'),(31,'Montana','MT'),(32,'Nebraska','NE'),(33,'Nevada','NV'),(34,'New Hampshire','NH'),(35,'New Jersey','NJ'),(36,'New Mexico','NM'),(37,'New York','NY'),(38,'North Carolina','NC'),(39,'North Dakota','ND'),(40,'N. Mariana Isl','MP'),(41,'Ohio','OH'),(42,'Oklahoma','OK'),(43,'Oregon','OR'),(44,'Palau','PW'),(45,'Pennsylvania','PA'),(46,'Puerto Rico','PR'),(47,'Rhode Island','RI'),(48,'South Carolina','SC'),(49,'South Dakota','SD'),(50,'Tennessee','TN'),(51,'Texas','TX'),(52,'Utah','UT'),(53,'Vermont','VT'),(54,'Virgin Islands','VI'),(55,'Virginia','VA'),(56,'Washington','WA'),(57,'West Virginia','WV'),(58,'Wisconsin','WI'),(59,'Wyoming','WY');
/*!40000 ALTER TABLE `states` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `usernamecanonical` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isEnabled` tinyint(1) NOT NULL DEFAULT '0',
  `salt` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `confirmationToken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passwordRequestAt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `role` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firstName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lastName` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `customerId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-04-24  1:54:06
