-- MySQL dump 10.13  Distrib 5.7.13, for Linux (x86_64)
--
-- Host: battle-comm-db-main.c2tm0zmnvkz6.us-west-2.rds.amazonaws.com    Database: hyberion_battlecomm
-- ------------------------------------------------------
-- Server version	5.6.23-log

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
-- Table structure for table `AssignedFactions`
--

DROP TABLE IF EXISTS `AssignedFactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `AssignedFactions` (
  `assignedFactionsID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `factions_Name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `factions_id` smallint(6) NOT NULL,
  `player_id` smallint(6) NOT NULL,
  `tournament_id` int(4) unsigned NOT NULL,
  `round_id` int(4) unsigned NOT NULL,
  PRIMARY KEY (`assignedFactionsID`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `AssignedFactions`
--

LOCK TABLES `AssignedFactions` WRITE;
/*!40000 ALTER TABLE `AssignedFactions` DISABLE KEYS */;
INSERT INTO `AssignedFactions` VALUES (1,'Adepta Sororitas (Sisters of Battle)',207,6,0,0),(2,'Adeptus Mechanicus',208,6,0,0),(3,'Astra Militarum',209,6,0,0),(4,'Blood Angels',210,6,0,0),(5,'Chaos Daemons',211,6,0,0),(6,'Evil',31,6,29,49),(7,'Dark Eldar',214,6,18,35),(8,'Eldar',215,6,18,35),(9,'Grey Knights',216,6,18,35),(10,'Harlequins',217,6,18,35),(11,'Dark Angels',213,2,31,51),(12,'Space Wolves',223,2,31,51),(13,'Adepta Sororitas (Sisters of Battle)',207,2,18,35),(14,'Necrons',225,2,18,35),(15,'Tyranids',226,4,18,35),(16,'Chaos Daemons',211,4,18,35),(17,'Eldar',215,4,18,35),(18,'Astra Militarum',209,4,18,35),(19,'Space Marines',222,46,34,65),(20,'Space Marines',222,46,34,65),(21,'Grey Knights',216,10,34,65),(22,'Adeptus Mechanicus',208,47,34,65),(23,'Blood Angels',210,47,34,65),(24,'Dark Angels',213,47,34,65),(25,'Astra Militarum',209,45,34,65),(26,'Grey Knights',216,45,34,65),(27,'Astra Militarum',209,2,34,65),(28,'Space Marines',222,2,34,65),(29,'Astra Militarum',209,44,34,65),(30,'Astra Militarum',209,49,34,65),(31,'Space Marines',222,84,36,70),(32,'Dark Eldar',214,70,39,78),(33,'Tau Empire',224,70,39,78),(34,'Adepta Sororitas (Sisters of Battle)',207,2,39,78),(35,'Blood Angels',210,2,39,78),(36,'Tau Empire',224,70,39,78),(37,'Tyranids',226,70,39,78),(38,'Eldar',215,70,39,78),(39,'Grey Knights',216,70,39,78),(40,'Eldar',215,70,39,78),(41,'Harlequins',217,70,39,78),(42,'Inquisition',219,70,39,78),(43,'Officio Assassianorum',220,2,40,81),(44,'Adepta Sororitas (Sisters of Battle)',207,2,40,81),(45,'Adeptus Mechanicus',208,2,40,81),(46,'Astra Militarum',209,2,40,81),(47,'Blood Angels',210,2,40,81),(48,'Chaos Daemons',211,2,40,81),(49,'Chaos Space Marines',212,2,40,81),(50,'Astra Militarum',209,92,43,85),(51,'Tau Empire',224,92,43,85);
/*!40000 ALTER TABLE `AssignedFactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BinaryMenuChoice`
--

DROP TABLE IF EXISTS `BinaryMenuChoice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BinaryMenuChoice` (
  `choiceID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `choiceTitle` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `choiceValue` int(1) NOT NULL,
  `choiceType` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`choiceID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BinaryMenuChoice`
--

LOCK TABLES `BinaryMenuChoice` WRITE;
/*!40000 ALTER TABLE `BinaryMenuChoice` DISABLE KEYS */;
INSERT INTO `BinaryMenuChoice` VALUES (1,'Yes',1,'Binary'),(2,'No',0,'Binary');
/*!40000 ALTER TABLE `BinaryMenuChoice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ProductOrders`
--

DROP TABLE IF EXISTS `ProductOrders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ProductOrders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(255) DEFAULT NULL,
  `orderDetails` varchar(255) DEFAULT NULL,
  `orderTotal` int(11) DEFAULT NULL,
  `customerFullName` varchar(255) DEFAULT NULL,
  `customerEmail` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `shippingStreet` varchar(255) DEFAULT NULL,
  `shippingAppartment` varchar(255) DEFAULT NULL,
  `shippingCity` varchar(255) DEFAULT NULL,
  `shippingState` varchar(255) DEFAULT NULL,
  `shippingZip` varchar(255) DEFAULT NULL,
  `shippingCountry` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  `userLoginId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `userLoginId` (`userLoginId`),
  CONSTRAINT `ProductOrders_ibfk_1` FOREIGN KEY (`userLoginId`) REFERENCES `user_login` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ProductOrders`
--

LOCK TABLES `ProductOrders` WRITE;
/*!40000 ALTER TABLE `ProductOrders` DISABLE KEYS */;
INSERT INTO `ProductOrders` VALUES (1,'completed','ID:2, Product:Wild Wild West Exodus, RP:1000, Qty:1',1000,'Leroy Jenkins','leyroy@gmail.com','3211231232','123 W 10th St',NULL,'Indianapolis','Indiana','47404','United States','2016-08-20 00:04:02','2016-08-20 00:05:05',4),(2,'processing','ID:2, Product:Wild Wild West Exodus, RP:1000, Qty:1',1000,'Leroy Jenkins','leyroy@gmail.com','3242342342','123 W 10th St',NULL,'Indianapolis','IN','47033','United States','2016-08-20 00:32:15','2016-08-20 02:04:49',4),(3,'completed','ID:1, Product:Malifaux, RP:100, Qty:1',100,'Zack Thomas','zanselm5@gmail.com','3175448348','530 E Ohio St Apt 204',NULL,'Indianapolis','Indiana','46204','United States','2016-08-20 02:05:47','2016-08-20 02:06:02',4);
/*!40000 ALTER TABLE `ProductOrders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Products`
--

DROP TABLE IF EXISTS `Products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `SKU` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_unicode_ci,
  `manufacturerId` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `gameSystem` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `category` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `stockQty` int(11) DEFAULT NULL,
  `inStock` tinyint(1) DEFAULT NULL,
  `filterVal` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `displayStatus` tinyint(1) DEFAULT NULL,
  `featured` tinyint(1) DEFAULT NULL,
  `new` tinyint(1) DEFAULT NULL,
  `onSale` tinyint(1) DEFAULT NULL,
  `imgAlt` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgOneFront` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgOneBack` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgTwoFront` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgTwoBack` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgThreeFront` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgThreeBack` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgFourFront` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `imgFourBack` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Products`
--

LOCK TABLES `Products` WRITE;
/*!40000 ALTER TABLE `Products` DISABLE KEYS */;
INSERT INTO `Products` VALUES (1,'234JKD','Malifaux',100,'Oh boy, this product is cool!','mnu911','mnu911BUSHID','blue','action','Table-Top',200,1,'showit',1,0,1,0,'Malifaux','malifaux.jpg','malifaux.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-14 21:25:15','2016-08-14 23:16:00'),(2,'1234SDF','Wild Wild West Exodus',1000,'This product is awesome, right!??!?!','mnu909','mnu909HORHE','Blue','Action','Action',100,1,'showit',0,0,1,1,'Wild Wild West','wild-wild-west-exodus.jpg','wild-wild-west-exodus2.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-14 23:17:16','2016-08-16 22:31:21'),(4,'1','Land Raider',7495,'Land Raider Kit','mnu910','mnu910WAR40K','Blue','raider','Table top Minature game',8,1,'showit',1,1,1,0,'Land Raider','GWLandRaider.jpg','GWLandRaider.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-15 16:09:17','2016-08-15 22:34:08'),(5,'B','Soul Grinder',6600,'One Games Workshop Soul Grinder model kit','mnu910','mnu910WAR40K',NULL,'soulgrinder','Table top gaming',120,1,'showit',1,0,1,0,'Soul Grinder','GWSoulGrinder04.jpg','GWSoulGrinder04.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-15 22:52:57','2016-08-16 00:16:28'),(6,'Ab','Thunder Wolf Cavalry',5300,'One Games Workshop Thunderwolf Cavalry kit.','mnu910','mnu910WAR40K',NULL,'thunderwolf','Table top gaming',120,1,'showit',1,0,1,0,'Thunderwolf Cavalry','GWThunderwolfCavalry.jpg','GWThunderwolfCavalry.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-15 22:57:48','2016-08-16 00:15:25'),(7,'Bbb','Eldrad',3000,'One Games Workshop Eldrad Ulthwe kit.','mnu910','mnu910WAR40K',NULL,'elrad','Table top gaming',120,1,'showit',1,0,1,0,'Eldrad','GWEldradFront.jpg','GWEldradBack.jpg',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-15 22:59:48','2016-08-16 00:14:34'),(8,'Adf','E-Wing Expansion',1495,'Contains one E-Wing expansion kit.','mnu908','mnu908STARXW',NULL,'A','Table top Minature game',120,1,'showit',1,0,1,0,'E-Wing','Dft','Tfd',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 13:21:42','2016-08-17 13:21:42'),(9,'Ghj','YT-2400 Expansion',2995,'Contains one YT-2400 Expansion kit.','mnu908','mnu908STARXW',NULL,'Yes','Table top Minature game',120,1,'showit',1,0,1,0,'YT-2400','Fdc','Bcd',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 13:29:39','2016-08-17 13:29:39'),(10,'Fdde','Inquisitor Tie Expansion',1495,'Contains one Inquisitor Tie Expansion kit.','mnu908','mnu908STARXW',NULL,'No','Table top Minature game',120,1,'showit',1,0,1,0,'Inquisitor Tie','No','Yes',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 14:33:49','2016-08-17 14:33:49'),(11,'Ghf','K-Wing Expansion',1495,'Contains one K-Wing Expansion Kit.','mnu908','mnu908STARXW',NULL,'Now','Table top Minature game',120,1,'showit',1,0,1,0,'K-Wing','Try','Now',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 14:36:51','2016-08-17 14:36:51'),(12,'Not','Bayou Gators',3500,'Contains on Bayou Gators kit','mnu926','mnu926MALIF',NULL,'Moy','Table top Minature game',120,1,'showit',1,0,1,0,'Bayou Gators','Nom','Nomm',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 14:42:44','2016-08-17 14:42:44'),(13,'Fgte','Crooked Men',1800,'Contains one Crooked Men kit.','mnu926','mnu926MALIF',NULL,'Not','Table top Minature game',120,1,'showit',1,0,1,0,'Crooked Men','Lala','Alal',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 18:42:36','2016-08-17 18:42:36'),(14,'Lalas','Hog Whisperer',1600,'Contains one Hog Whisperer kit','mnu926','mnu926MALIF',NULL,'Notsa','Table top Minature game',120,1,'showit',1,0,1,0,'Hog Whisperer','Rtrt','Trtr',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 18:47:42','2016-08-17 18:47:42'),(15,'Hgh','War Pig',2000,'Contains one War Pig kit.','mnu926','mnu926MALIF',NULL,'Tagsit','Tyfu',120,1,'showit',1,0,1,0,'War Pig','Trtrtr','Ytytyt',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 18:49:18','2016-08-17 18:49:18'),(16,'Wotc','Magic the Gathering: Eldritch Moon booster pack',400,'Contains one Magic the Gathering: Eldritch Moon booster pack','mnu924','mnu924MAGTG',NULL,'Notnow','Table Top Card Game',40000,1,'showit',1,0,1,0,'Eldritch Moon','Rtfg','Gfrt',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 19:04:50','2016-08-17 19:04:50'),(17,'Catsd','Magic the Gathering: Shadows Over Innistrad booster pack',400,'Contains one Magic the Gathering: Shadows Over Innistrad booster pack!','mnu924','mnu924MAGTG',NULL,'Edede','Table top card game',40000,1,'showit',1,0,1,0,'Shadows Over Innistrad booster pack','Tatata','Arararar',NULL,NULL,NULL,NULL,NULL,NULL,'2016-08-17 19:18:37','2016-08-20 00:02:43');
/*!40000 ALTER TABLE `Products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserLogins`
--

DROP TABLE IF EXISTS `UserLogins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserLogins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `activation_key` varchar(255) DEFAULT NULL,
  `activation_state` int(11) DEFAULT NULL,
  `firstName` varchar(255) DEFAULT NULL,
  `lastName` varchar(255) DEFAULT NULL,
  `join_date` datetime DEFAULT NULL,
  `tourneyAdmin` varchar(255) DEFAULT NULL,
  `EventAdmin` varchar(255) DEFAULT NULL,
  `NewsContributor` varchar(255) DEFAULT NULL,
  `venueAdmin` varchar(255) DEFAULT NULL,
  `clubAdmin` varchar(255) DEFAULT NULL,
  `siteAdmin` varchar(255) DEFAULT NULL,
  `user_handle` varchar(255) DEFAULT NULL,
  `user_club` int(11) DEFAULT NULL,
  `user_main_phone` varchar(255) DEFAULT NULL,
  `user_mobile_phone` varchar(255) DEFAULT NULL,
  `user_work_phone` varchar(255) DEFAULT NULL,
  `user_street_address` varchar(255) DEFAULT NULL,
  `user_apt_suite` varchar(255) DEFAULT NULL,
  `user_city` varchar(255) DEFAULT NULL,
  `user_state` varchar(255) DEFAULT NULL,
  `user_zip` varchar(255) DEFAULT NULL,
  `user_Date_of_Birth` datetime DEFAULT NULL,
  `user_bio` text,
  `user_facebook` varchar(255) DEFAULT NULL,
  `user_twitter` varchar(255) DEFAULT NULL,
  `user_instagram` varchar(255) DEFAULT NULL,
  `user_google_plus` varchar(255) DEFAULT NULL,
  `user_youtube` varchar(255) DEFAULT NULL,
  `user_twitch` varchar(255) DEFAULT NULL,
  `user_website` varchar(255) DEFAULT NULL,
  `user_points` int(11) DEFAULT NULL,
  `user_visibility` varchar(255) DEFAULT NULL,
  `user_share_contact` varchar(255) DEFAULT NULL,
  `user_share_name` varchar(255) DEFAULT NULL,
  `user_share_status` varchar(255) DEFAULT NULL,
  `user_newsletter` varchar(255) DEFAULT NULL,
  `user_marketing` varchar(255) DEFAULT NULL,
  `user_sms` varchar(255) DEFAULT NULL,
  `user_allow_play` varchar(255) DEFAULT NULL,
  `user_icon` varchar(255) DEFAULT NULL,
  `totalWins` int(11) DEFAULT NULL,
  `totalLoss` int(11) DEFAULT NULL,
  `totalDraw` int(11) DEFAULT NULL,
  `totalPoints` int(11) DEFAULT NULL,
  `accountActive` varchar(255) DEFAULT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserLogins`
--

LOCK TABLES `UserLogins` WRITE;
/*!40000 ALTER TABLE `UserLogins` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserLogins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bc_news`
--

DROP TABLE IF EXISTS `bc_news`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `bc_news` (
  `news_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `featured_image` varchar(400) COLLATE utf8_unicode_ci NOT NULL,
  `news_callout` text COLLATE utf8_unicode_ci NOT NULL,
  `news_body` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `news_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `news_date_submitted` date NOT NULL,
  `publish` set('yes','no','pending') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'pending',
  `news_date_published` date DEFAULT NULL,
  `news_featured` set('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `tags` text COLLATE utf8_unicode_ci,
  `parent` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `game_system` text COLLATE utf8_unicode_ci,
  `news_submitted_IP_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`news_id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bc_news`
--

LOCK TABLES `bc_news` WRITE;
/*!40000 ALTER TABLE `bc_news` DISABLE KEYS */;
INSERT INTO `bc_news` VALUES (33,'Welcome to Battle-Comm','Uploads/news/battlecomm.png','Welcome to Battle-Comm, the home to find all levels of friendly, local, table-top gaming. With a long running list of supported table-top gaming systems, Battle-comm is a community of individuals making connections through competition. Battle-Comm is almost ready to open it\'s doors and bring you into a world of excitement, interaction, and swag! Battle-Comm is ready to bring you the future of table top events, online play matching, and community interaction. So read on to find out more about this exciting new service and how Battle-Comm can benefit you as a player, as a shop owner, or as an event organizer. Together we will make Battle-Comm the primary destination for all table-top gamers, because at Battle-Comm even when you lose, you still Win Reward Points just for playing!','<p>Welcome to Battle-Comm, the home to find all levels of friendly, local, table-top gaming. With a long running list of supported table-top gaming systems, Battle-comm is a community of individuals making connections through competition. Battle-Comm is almost ready to open it\'s doors and bring you into a world of excitement, interaction, and swag! Battle-Comm is ready to bring you the future of table top events, online play matching, and community interaction. So read on to find out more about this exciting new service and how Battle-Comm can benefit you as a player, as a shop owner, or as an event organizer. Together we will make Battle-Comm the primary destination for all table-top gamers, because at Battle-Comm even when you lose, you still Win Reward Points just for playing!</p>\r\n\r\n<p>Whether you\'re an ultra casual or the ultimate competitive player, Battle-Comm will help turn your gaming and hobby experience up to 11!! Play Battle-Comm matches with your family and friends at home, Friendly Local Gaming Store (FLGS), and Affiliate events to begin creating your own Battle-comm statistical history! You\'ll also be able to earn ranking, achievements, and Reward Points you can then trade in the Battle-Comm RP store for table top gaming and hobby products!</p>\r\n\r\n<p>You, your Club, or FLGS could even win a Battle-Comm upgrade package! If you\'re one of the top ranked players/hobbyists in your region, you could be one of a few who (each Battle-Comm season) participates in the Battle-Comm regional/world championships for cash prizes! Even if you\'re not one of the \'best of the best\' you could still win a chance to compete in one of the Battle-Comm Bonus Campaign events at the world championships.</p>\r\n','Bryce','2015-01-15','yes','2015-10-14','','','Updates','','');
/*!40000 ALTER TABLE `bc_news` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club`
--

DROP TABLE IF EXISTS `club`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club` (
  `club_key` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `clubDescription` text COLLATE utf8_unicode_ci,
  `FLGS_affiliation` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `club_street` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `club_city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_state` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `club_zip` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `club_email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `club_contact_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `club_admin_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title for the Admin Security Level',
  `club_editor_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title for Moderator (sub -admin) security Level',
  `club_moderator_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_Member_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'Title for Standard Members',
  `club_facebook` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_twitter` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_system` int(4) NOT NULL,
  `club_display_Members` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  `club_logo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo_w` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `logo_h` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clubOwner` int(4) NOT NULL,
  PRIMARY KEY (`club_key`),
  KEY `club_key` (`club_key`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club`
--

LOCK TABLES `club` WRITE;
/*!40000 ALTER TABLE `club` DISABLE KEYS */;
INSERT INTO `club` VALUES (6,'The Club','It\'s a club','3','','','','','iamthefrongprince@shouldnottaketwo.com','Mike','God','Demi god','minor diety','worm','facebook.com/huh','twitter.com/chirp','www.theclub.com',0,'no','assistence.cat_.computer1.jpg','320','239',0),(7,' The other Club',NULL,'1','','','','','heylook@that.com','Wilbur Portoney','','','','','','','',0,'no',NULL,NULL,NULL,6),(10,'Tester',NULL,'2','','','','','bnelson@battle-comm.com','Bryce','Ultra Dude','Super Dude','Greater Dude','WannabeaDude','','','',0,'no',NULL,NULL,NULL,2),(9,'No Club Affiliation',NULL,'','','','','','','non/appliable','non/applicable','','','','','','',0,'no',NULL,NULL,NULL,0),(11,'Team Zero Comp',NULL,'3','','','','','frankigiampapa@gmail.com','Frankie','','','','','','','frontlinegaming.org',0,'no','zerker baseball 5.jpg',NULL,NULL,70),(12,'Da Club',NULL,'2','','','','','bnelson@battle-comm.com','Bryce Nelson','','','','','','','',0,'no',NULL,NULL,NULL,2),(13,'Ascension',NULL,'2','','','','','Link123_2002@yahoo.com','John Dyer','','','','','','','',0,'no',NULL,NULL,NULL,26),(14,'Left coast corsairs',NULL,'2','','','','','Darkraptor42@yahoo.com ','Paul McKelvey ','','','','','','','',0,'yes',NULL,NULL,NULL,80),(15,'Team Brohammer ',NULL,'2','','','','','Lozengy@yahoo.com','Tim D','','','','','','','',0,'yes',NULL,NULL,NULL,44),(16,'Mercy Killers',NULL,'2','','','','','Rolgnek@yahoo.com','Steve Sisk ','Lord of War','1st Company','2nd Company','10th Company ','https://www.facebook.com/Mercy-Killers-478242322310531/','','',0,'no','image.jpeg',NULL,NULL,86),(17,'nWo blackshirts ',NULL,'3','','','','','Julnlecs@gmail.com ','Julio Rodriguez ','','','','','','','',0,'yes',NULL,NULL,NULL,87),(18,'Sac City Punisher',NULL,'2','','','','','madfjohn@gmail.com','madfjohn','Omega Prime','Big Duke','Big Tex','','','','',0,'yes','Sac City Punishers 5.jpg',NULL,NULL,88),(20,'Bakersfield Brawlers',NULL,'9','','','','','Farzaddmd@gmail.com','Farzad Mehdipour','','','','','','','',0,'yes',NULL,NULL,NULL,90);
/*!40000 ALTER TABLE `club` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club_user_membership`
--

DROP TABLE IF EXISTS `club_user_membership`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club_user_membership` (
  `user_membership_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_membership_club_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `club_User_Type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`user_membership_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club_user_membership`
--

LOCK TABLES `club_user_membership` WRITE;
/*!40000 ALTER TABLE `club_user_membership` DISABLE KEYS */;
/*!40000 ALTER TABLE `club_user_membership` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `club_user_types`
--

DROP TABLE IF EXISTS `club_user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `club_user_types` (
  `club_user_type_ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club_user_type_security_Level` enum('user','moderator','editor','admin') COLLATE utf8_unicode_ci NOT NULL,
  `club_user_type_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `club_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`club_user_type_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `club_user_types`
--

LOCK TABLES `club_user_types` WRITE;
/*!40000 ALTER TABLE `club_user_types` DISABLE KEYS */;
/*!40000 ALTER TABLE `club_user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clubs_games_affiliation`
--

DROP TABLE IF EXISTS `clubs_games_affiliation`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clubs_games_affiliation` (
  `club_game_affiliation` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `club_id` int(10) unsigned NOT NULL,
  `game_system_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`club_game_affiliation`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs_games_affiliation`
--

LOCK TABLES `clubs_games_affiliation` WRITE;
/*!40000 ALTER TABLE `clubs_games_affiliation` DISABLE KEYS */;
/*!40000 ALTER TABLE `clubs_games_affiliation` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_request`
--

DROP TABLE IF EXISTS `event_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_request` (
  `request_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `request_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `requesting_player_id` int(11) NOT NULL,
  `game_system_id` int(11) NOT NULL,
  `game_venue_id` int(11) NOT NULL,
  `game_start_date_time` datetime NOT NULL,
  `game_total_players` int(11) NOT NULL,
  `game_table` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_notes` text COLLATE utf8_unicode_ci NOT NULL,
  `game_status` enum('open','pending','in progress','cancelled') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'open',
  KEY `request_id` (`request_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_request`
--

LOCK TABLES `event_request` WRITE;
/*!40000 ALTER TABLE `event_request` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `factions`
--

DROP TABLE IF EXISTS `factions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `factions` (
  `faction_id` int(11) NOT NULL AUTO_INCREMENT,
  `faction_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_system_id` int(11) NOT NULL,
  PRIMARY KEY (`faction_id`),
  KEY `faction_id` (`faction_id`)
) ENGINE=MyISAM AUTO_INCREMENT=293 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `factions`
--

LOCK TABLES `factions` WRITE;
/*!40000 ALTER TABLE `factions` DISABLE KEYS */;
INSERT INTO `factions` VALUES (2,'Empire of the Blazing Sun',50),(3,'Federated States of America',50),(4,'Kingdom of Britannia',50),(5,'Prussian Empire',50),(6,'Covenant of Antarctica',50),(7,'Russian Coalition',50),(8,'Republique of France',50),(9,'Alliance Nations',50),(10,'Algoryn',51),(11,'Boromite',51),(12,'Concord',51),(13,'Mercenaries',51),(14,'Prefecture of Ryu',13),(15,'Temple of Ro-Kan',13),(16,'The Cult of Yurei',13),(17,'The Savage Wave',13),(18,'The Ito Clan',13),(19,'Silvermoon Trade Syndicate',13),(20,'Tengu Descension',13),(21,'The Agency',14),(22,'Miskatonic University',14),(23,'The Syndicate',14),(24,'Cthulhu',14),(25,'Hastur',14),(26,'Yog-Sothoth',14),(27,'Shub-Niggurath',14),(28,'Black',15),(29,'White',15),(30,'Good',16),(31,'Evil',16),(32,'Brood',17),(33,'Core',17),(34,'Dragyri',17),(35,'Forsaken',17),(36,'Kukulkani',17),(37,'Outcast',17),(38,'Bounty Hunters',17),(39,'Skarrd',17),(40,'Enforcers',18),(41,'Plague',18),(42,'Rebels',18),(43,'Marauders',18),(44,'Forge Fathers',18),(45,'Asterians',18),(46,'Human',19),(47,'Forge Father',19),(48,'Veer-myn',19),(49,'Marauders',19),(50,'Female Corporation',19),(51,'Judwan',19),(52,'Robots',19),(53,'Z\'zor',19),(54,'UCM',52),(55,'Scourge',52),(56,'PHR',52),(57,'Shaltari',52),(58,'Resistance',52),(59,'UCM',20),(60,'Scourge',20),(61,'PHR',20),(62,'Shaltari',20),(63,'Resistance',20),(64,'Empire of the Blazing Sun',21),(65,'Federated States of America',21),(66,'Kingdom of Britannia',21),(67,'Prussian Empire',21),(68,'Empire of the Blazing Sun',22),(69,'Federated States of America',22),(70,'Kingdom of Britannia',22),(71,'Prussian Empire',22),(72,'Covenant of Antarctica',22),(73,'Russian Coalition',22),(74,'Republique of France',22),(75,'Australians',22),(76,'Chinese Federation',22),(77,'League of Italian States',22),(78,'Ottoman Empire',22),(79,'Polish-Lithuanian Commonwealth',22),(80,'Republic of Egypt',22),(81,'Socialist Union of South America (SUSA)',22),(82,'Aquan Prime',23),(83,'Dindrenzi Federation',23),(84,'Sorylian Collective',23),(85,'Terran Alliance',23),(87,'The Directorate',23),(88,'The Relthoza',23),(89,'Kurak Alliance',23),(90,'Zenian League',23),(91,'Aquan Prime',24),(92,'Dindrenzi Federation',24),(93,'Sorylian Collective',24),(94,'Terran Alliance',24),(95,'The Directorate',24),(96,'The Relthoza',24),(97,'House Martell',26),(98,'House Stark',26),(99,'House Baratheon',26),(100,'House Targaryen',26),(101,'House Lanister',26),(102,'House Greyjoy',26),(103,'United Nation Space Command (UNSC)',53),(104,'Covenant',53),(105,'Belgian Army',12),(106,'Germany',12),(107,'Soviet Union',12),(108,'Finish',12),(109,'Great Britian',12),(110,'USA',12),(111,'French Army',12),(112,'Italy',12),(113,'Japan',12),(114,'Partisans',12),(115,'Poland',12),(116,'Bulgaria',12),(117,'Hungary',12),(118,'Romania',12),(119,'China',12),(120,'Empire',59),(121,'Azur Alliance',59),(122,'Church',59),(123,'Black Sun',59),(124,'Wissenschaft',59),(125,'Samael',59),(126,'Wanderers and Summons',59),(127,'Dark Angels',30),(128,'Emperors Children',30),(129,'Blood Angels',30),(130,'Space Wolves',30),(131,'Iron Hands',30),(132,'Iron Warriors',30),(133,'Night Lords',30),(134,'Salammanders',30),(135,'Raven Guard',30),(136,'Luna Wolves/Sons of Horus',30),(137,'Ultramarines',30),(138,'Death Guard',30),(139,'World Eaters',30),(140,'White Scars',30),(141,'Thousand Sons',30),(142,'Imperial Fists',30),(143,'Alpha Legion',30),(144,'Word Bearers',30),(145,'Panoceania',31),(146,'Yu Jing',31),(147,'Ariadna',31),(148,'Haqqislam',31),(149,'Nomads',31),(151,'Combined Army',31),(152,'Aleph',31),(153,'Tohaa',31),(154,'Abyssal Dwarfs',32),(155,'Dwarfs',32),(156,'Goblins',32),(157,'Ogres',32),(158,'Orcs',32),(159,'Undead',32),(160,'The Council',54),(161,'Uruhvel',54),(162,'Raiders of Saanar',54),(163,'Sovereign Empire',54),(164,'Guardians of Tanaor',54),(165,'Epirian Foundation',55),(166,'Karist Enclave',55),(167,'Red',33),(168,'Blue',33),(169,'Green',33),(170,'Black',33),(171,'White',33),(172,'Guild',34),(173,'Resurrectionists',34),(174,'Arcanists',34),(175,'Neverborn',34),(176,'Outcasts',34),(177,'Gremlins',34),(178,'Ten Thunders',34),(179,'Corporation',35),(180,'Runner',35),(181,'Italian Wars 1494-1559',36),(182,'Thirty Years War 1618-1648',36),(183,'The English Civil Wars 1642-1652',36),(184,'Cerci Speed Circuit',37),(185,'Shattered Sword Paladins',37),(186,'Black Diamond',37),(187,'Noh Empire',37),(188,'Star Nebular Corsairs',37),(189,'Doctrine',37),(190,'United Earth Defence Force (UEDF)',38),(191,'Zentraedi',38),(192,'Federation',40),(193,'Klingon Empire',40),(194,'Romulan Empire',40),(195,'Borg',40),(196,'Dominion',40),(197,'Imperial',10),(198,'Rebel',10),(199,'Imperial',41),(200,'Rebel',41),(201,'Imperial',43),(202,'Rebel',43),(203,'Dark Side',42),(204,'Light Side',42),(205,'Evil',49),(206,'Good',49),(207,'Adepta Sororitas (Sisters of Battle)',9),(208,'Adeptus Mechanicus',9),(209,'Astra Militarum',9),(210,'Blood Angels',9),(211,'Chaos Daemons',9),(212,'Chaos Space Marines',9),(213,'Dark Angels',9),(214,'Dark Eldar',9),(215,'Eldar',9),(216,'Grey Knights',9),(217,'Harlequins',9),(218,'Imperial Knights',9),(219,'Inquisition',9),(220,'Officio Assassianorum',9),(221,'Orks',9),(222,'Space Marines',9),(223,'Space Wolves',9),(224,'Tau Empire',9),(225,'Necrons',9),(226,'Tyranids',9),(227,'Space Marines',44),(228,'Astra Militarum',44),(229,'Orks',44),(230,'Eldar',44),(231,'Tau Empire',44),(232,'Chaos',44),(233,'Dark Eldar',44),(234,'Tyranids',44),(235,'Beastmen',58),(236,'Bretonnia',58),(237,'Daemons of Chaos',58),(238,'Dark Elves',58),(239,'Dwarfs',58),(240,'High Elves',58),(241,'Lizardmen',58),(242,'Ogre Kingdoms',58),(243,'Orcs & Goblins',58),(244,'Skaven',58),(245,'The Empire',58),(246,'Tomb Kings',58),(247,'Vampire Counts',58),(248,'Warriors of Chaos',58),(249,'Wood Elves',58),(250,'Order',45),(251,'Destruction',45),(252,'Cygnar',46),(253,'Cryx',46),(254,'Khador',46),(255,'Retribution of Scyrah',46),(256,'The Protectorate of Menoth',46),(257,'Mercenaries',46),(258,'Trollbloods',46),(259,'Circle Orboros',46),(260,'Skorne',46),(261,'Legion of Everblight',46),(262,'Minions',46),(263,'Corporation',56),(264,'Marauders',56),(265,'Forge Fathers',56),(266,'Enforcers',56),(267,'Veer\'myn',56),(268,'Zombie Apokalypse',56),(269,'Mishima',47),(270,'Cybertronic',47),(271,'Imperial',47),(272,'Dark Legion',47),(273,'Capitol',47),(274,'Brotherhood',47),(275,'Bauhaus',47),(276,'Enlightened',48),(277,'Lawmen',48),(278,'Outlaws',48),(279,'Union',48),(280,'Warrior Nation',48),(281,'Holy Order of Man',48),(282,'Scum & Villany',43),(283,'Napoleonic Wars 1789-1815',11),(284,'The Jacobite Rebellion 1745',11),(285,'American War of Independence 1776-1783',11),(286,'American Civil War 1861-1865',11),(287,'The Mahdist Revolt 1884',11),(288,'French Indian War 1754-1763',11),(289,'The Plains Wars 1850s-1890s',11),(290,'The Crimean War 1853-1856',11),(291,'Anglo-Zulu War 1879',11),(292,'Seminole Wars 1814-1858',11);
/*!40000 ALTER TABLE `factions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_categories`
--

DROP TABLE IF EXISTS `game_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_categories` (
  `game_cat_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_category` varchar(140) NOT NULL,
  `WinPointValue` smallint(5) unsigned NOT NULL,
  `lossPointValue` smallint(5) unsigned NOT NULL,
  `drawPointValue` smallint(5) unsigned NOT NULL,
  PRIMARY KEY (`game_cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_categories`
--

LOCK TABLES `game_categories` WRITE;
/*!40000 ALTER TABLE `game_categories` DISABLE KEYS */;
INSERT INTO `game_categories` VALUES (3,'One',15,13,14),(4,'Two',30,26,28),(5,'Three',15,5,10),(6,'Four (test)',65535,0,10);
/*!40000 ALTER TABLE `game_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `game_system`
--

DROP TABLE IF EXISTS `game_system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `game_system` (
  `game_system_id` int(11) NOT NULL AUTO_INCREMENT,
  `game_system_Title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_system_Title_version` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `game_system_publisher` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `game_system_official_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `game_logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `games_category` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `games_time` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `noOfPlayers` int(3) NOT NULL,
  KEY `game_system_id` (`game_system_id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `game_system`
--

LOCK TABLES `game_system` WRITE;
/*!40000 ALTER TABLE `game_system` DISABLE KEYS */;
INSERT INTO `game_system` VALUES (9,'Warhammer 40K','7th Edition','Games Workshop','http://www.games-workshop.com','LandingPageLogo_40k.png','Three','2 hours',2),(10,'Star Wars Armada','1st Edition','Fantasy Flight Games','','','Three','2 hours',2),(11,'Black Powder','','Warlord Games','','','Two',' 1+ hour',2),(12,'Bolt Action','','Warlord Games','','','Two','1+ hour',2),(13,'Bushido','','GCT Studios','','','Two','1+ hour',2),(14,'Call of Cthulhu: The Card Game','','Fantasy Flight Games','','','One','under 1 ho',2),(15,'Chess','','','','','Two','1+ hour',2),(16,'D&D Attack Wing','1st Edition','Wizkids','','','Two','1+ hour',2),(17,'Dark Age','1st Edition','Dark Age Minatures','','','Two','1+ hour',2),(18,'Dead Zone','','Mantic','','','Two','1+ hour',2),(19,'Dreadball','','Mantic','','','Two','1+ hour',2),(20,'Drop Zone Commander','1st Edition','Hawk Wargames','','','Two','1+ hour',2),(21,'Dystopian Legions','','Spartan Games','','','Two','1+ hour',2),(22,'Dystopian Wars','','Spartan Games','','','Two','1+ hour',2),(23,'Firestorm Armada','','Spartan Games','','','Two','1+ hour',2),(24,'Firestorm Planetfall','','Spartan Games','','','Two','1+ hour',2),(25,'Flames of War','','Battlefront Minatures','','','Two','1+ hour',2),(26,'Game of Thrones: The Card Game','','Fantasy Flight Games','','','Two','1+ hour',4),(27,'Hail Ceaser','','Warlord Games','','','Two','1+ hour',2),(28,'Heavy Gear','','Dream Pod 9','','','One','under an h',2),(29,'Hero Clicks','','Wizkids','','','One','under an h',2),(30,'Horus Heresy','1st Edition','Forge World (Games Workshop)','','','Three','2+ hours',2),(31,'Infinity','3rd Edition','Corvus Belli','','','Two','1+ hour',2),(32,'Kings of War','','Mantic','','','Two','1+ hour',2),(33,'Magic the Gathering','','Wizards of the Coast (Hasbro)','','','One','under an h',2),(34,'Malifaux','2nd Edition','Wyrd','','','Two','1+ hour',2),(35,'Netrunner','','Fantasy Flight Games','','','One','under an h',2),(36,'Pike & Shotte','','Warlord Games','','','Two','1+ hour',2),(37,'Relic Knights','','Ninja Division','','','Two','1+ hour',2),(38,'Robotech Tactics','','Pallaedium Books','','','Two','1+ hour',2),(39,'Saga','','Tomahawk Studios','','','Two','1+ hour',2),(40,'Star Trek Attack Wing','','Wizkids','','','Two','1+ hour',2),(41,'Star Wars Imperial Assault','','Fantasy Flight Games','','','Two','1+ hour',2),(42,'Star Wars: The Card Game','','Fantasy Flight Games','','','One','under an h',2),(43,'Star Wars X-Wing','','Fantasy Flight Games','','','Two','1+ hour',2),(44,'Warhammer 40k: Conquest','','Fantasy Flight Games','','','One','under an h',2),(45,'Warhammer: Invasion','','Fantasy Flight Games','','','Two','1+ hour',2),(46,'Warmachine/Hordes','','Privateer Press','','','Two','1+ hour',2),(47,'Warzone','','Prodos','','','Two','1+ hour',2),(48,'Wild West Exodus','','Outlaw Games','','','Two','1+ hour',2),(49,'The Hobbit/The Lord of the Rings','','Games Workshop','','','Three','2 hours',2),(50,'Armoured Clash','','Spartan Games','','','Two','1+ hour',2),(51,'Beyond the Gates of Antares','','Warlord Games','','','Two','1+ hour',2),(52,'Drop Fleet Commander','','Hawk Wargames','','','Two','1+ hour',2),(53,'Halo Fleet Battles','','Spartan Games','','','Three','2 hour',2),(54,'Last Saga','','Rocket Games','','','Two','1+ hour',2),(55,'Maelstrom\'s Edge','','Spiral Arm Studios','','','Two','1+ hour',2),(56,'Warpath','','Mantic','','','Two','1+ hour',2),(57,'DUST Tactics','','','','','Two','1+ hour',2),(62,'Blood Bowl','','Games Workshop','','','','',2),(59,'Hellderado','','Cipher Studios','','','Two','1+ hour',2),(60,'Wrath of Kings','1','Cool Mini or Not','','','Two','1+ hours',2),(61,'Age of Sigmar','1','Games Workshop','','','Two','1+ hour',2),(63,'Epic 40k','','Games Workshop','','','','',2),(64,'Battle Fleet Gothic','','Games Workshop','','','','',2),(65,'Necromunda','','Games Workshop','','','','',2),(66,'Guildball','','','','','','',2),(67,'Batman The Minatures Game','','','','','','',2);
/*!40000 ALTER TABLE `game_system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `matched_tiebreakers`
--

DROP TABLE IF EXISTS `matched_tiebreakers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `matched_tiebreakers` (
  `matched_tiebreakers` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` int(11) NOT NULL,
  `match_name` varchar(100) NOT NULL,
  `tournament_ID` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `mission_name` varchar(100) NOT NULL,
  `tiebreaker_points` int(4) NOT NULL,
  PRIMARY KEY (`matched_tiebreakers`)
) ENGINE=InnoDB AUTO_INCREMENT=197 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `matched_tiebreakers`
--

LOCK TABLES `matched_tiebreakers` WRITE;
/*!40000 ALTER TABLE `matched_tiebreakers` DISABLE KEYS */;
INSERT INTO `matched_tiebreakers` VALUES (8,2,'Morning',11,5,'Frontline Mission 2 Primary',4),(9,2,'Morning',11,6,'Frontline Mission 2 Secondary',4),(10,2,'Morning',11,20,'Table Quarters',1),(11,2,'Morning',11,15,'First Blood',1),(12,3,'One',12,3,'Frontline Mission 1 Primary',4),(13,3,'One',12,4,'Frontline Mission 1 Secondary',4),(14,3,'One',12,18,'Big Game Hunter',1),(15,3,'One',12,16,'Linebreaker',1),(16,3,'One',12,17,'Slay the Warlord',1),(17,4,'Two',12,5,'Frontline Mission 2 Primary',4),(18,4,'Two',12,6,'Frontline Mission 2 Secondary',4),(19,4,'Two',12,15,'First Blood',1),(20,4,'Two',12,21,'King of the Hill',1),(21,4,'Two',12,20,'Table Quarters',1),(22,5,'Three',12,7,'Frontline Mission 3 Primary',4),(23,5,'Three',12,8,'Frontline Mission 3 Secondary',4),(24,5,'Three',12,22,'Ground Control',1),(25,5,'Three',12,19,'First Strike',1),(26,5,'Three',12,16,'Linebreaker',1),(29,8,'This Round',14,15,'First Blood',1),(30,8,'This Round',14,20,'Table Quarters',1),(36,11,'Other Round',14,9,'Frontline Mission 4 Primary',4),(37,11,'Other Round',14,10,'Frontline Mission 4 Secondary',4),(38,11,'Other Round',14,17,'Slay the Warlord',1),(39,11,'Other Round',14,19,'First Strike',1),(41,27,'1',16,3,'Frontline Mission 1 Primary',4),(42,27,'1',16,4,'Frontline Mission 1 Secondary',4),(43,27,'1',16,15,'First Blood',1),(44,27,'1',16,16,'Linebreaker',1),(45,27,'1',16,17,'Slay the Warlord',1),(46,31,'3',16,3,'Frontline Mission 1 Primary',4),(47,32,'3',16,5,'Frontline Mission 2 Primary',4),(48,33,'3',16,7,'Frontline Mission 3 Primary',4),(49,35,'Game 1',18,9,'Frontline Mission 4 Primary',4),(50,35,'Game 1',18,10,'Frontline Mission 4 Secondary',4),(51,36,'Game 2',18,11,'Frontline Mission 5 Primary',4),(52,36,'Game 2',18,12,'Frontline Mission 5 Secondary',4),(53,37,'Game 3',18,13,'Frontline Mission 6 Primary',4),(54,37,'Game 3',18,14,'Frontline Mission 6 Secondary',4),(55,35,'Game 1',18,18,'Big Game Hunter',1),(56,35,'Game 1',18,16,'Linebreaker',1),(57,35,'Game 1',18,17,'Slay the Warlord',1),(58,36,'Game 2',18,21,'King of the Hill',1),(59,36,'Game 2',18,16,'Linebreaker',1),(60,36,'Game 2',18,17,'Slay the Warlord',1),(61,37,'Game 3',18,15,'First Blood',1),(62,37,'Game 3',18,16,'Linebreaker',1),(63,37,'Game 3',18,17,'Slay the Warlord',1),(64,38,'Round 1',19,3,'Frontline Mission 1 Primary',4),(65,38,'Round 1',19,4,'Frontline Mission 1 Secondary',4),(66,38,'Round 1',19,18,'Big Game Hunter',1),(67,38,'Round 1',19,16,'Linebreaker',1),(68,38,'Round 1',19,17,'Slay the Warlord',1),(69,39,'Round 2',19,5,'Frontline Mission 2 Primary',4),(70,39,'Round 2',19,6,'Frontline Mission 2 Secondary',4),(71,39,'Round 2',19,21,'King of the Hill',1),(72,39,'Round 2',19,16,'Linebreaker',1),(73,39,'Round 2',19,17,'Slay the Warlord',1),(74,40,'Round 3',19,7,'Frontline Mission 3 Primary',4),(75,40,'Round 3',19,9,'Frontline Mission 4 Primary',4),(76,40,'Round 3',19,19,'First Strike',1),(77,40,'Round 3',19,16,'Linebreaker',1),(78,40,'Round 3',19,17,'Slay the Warlord',1),(79,41,'Round 1',20,3,'Frontline Mission 1 Primary',4),(80,41,'Round 1',20,4,'Frontline Mission 1 Secondary',4),(81,41,'Round 1',20,18,'Big Game Hunter',1),(82,41,'Round 1',20,16,'Linebreaker',1),(83,41,'Round 1',20,17,'Slay the Warlord',1),(84,46,'One',23,3,'Frontline Mission 1 Primary',4),(85,46,'One',23,4,'Frontline Mission 1 Secondary',4),(86,46,'One',23,16,'Linebreaker',1),(87,46,'One',23,17,'Slay the Warlord',1),(88,46,'One',23,18,'Big Game Hunter',1),(89,47,'Two',23,5,'Frontline Mission 2 Primary',4),(90,47,'Two',23,6,'Frontline Mission 2 Secondary',4),(91,47,'Two',23,16,'Linebreaker',1),(92,47,'Two',23,17,'Slay the Warlord',1),(93,47,'Two',23,20,'Table Quarters',1),(94,48,'Three',23,11,'Frontline Mission 5 Primary',4),(95,48,'Three',23,12,'Frontline Mission 5 Secondary',4),(96,48,'Three',23,15,'First Blood',1),(97,48,'Three',23,21,'King of the Hill',1),(98,48,'Three',23,22,'Ground Control',1),(99,41,'1',21,23,'40k Twin Linked Red Scenario',3),(100,41,'1',21,24,'40k Twin Linked Blue Scenario',1),(101,41,'1',21,25,'40k Twin Linked Green Scenario',1),(102,43,'2',21,23,'40k Twin Linked Red Scenario',3),(103,43,'2',21,24,'40k Twin Linked Blue Scenario',1),(104,43,'2',21,25,'40k Twin Linked Green Scenario',1),(105,44,'3',21,23,'40k Twin Linked Red Scenario',3),(106,44,'3',21,24,'40k Twin Linked Blue Scenario',1),(107,44,'3',21,25,'40k Twin Linked Green Scenario',1),(108,49,'Test Round 1',29,3,'Frontline Mission 1 Primary',4),(109,49,'Test Round 1',29,5,'Frontline Mission 2 Primary',4),(110,49,'Test Round 1',29,15,'First Blood',1),(111,35,'Game 1',18,11,'Frontline Mission 5 Primary',4),(112,51,'One',31,3,'Frontline Mission 1 Primary',4),(113,51,'One',31,4,'Frontline Mission 1 Secondary',4),(114,51,'One',31,16,'Linebreaker',1),(115,51,'One',31,17,'Slay the Warlord',1),(116,51,'One',31,18,'Big Game Hunter',1),(117,52,'Two',31,5,'Frontline Mission 2 Primary',4),(118,52,'Two',31,6,'Frontline Mission 2 Secondary',4),(119,52,'Two',31,19,'First Strike',1),(120,52,'Two',31,20,'Table Quarters',1),(121,52,'Two',31,21,'King of the Hill',1),(122,53,'Three',31,7,'Frontline Mission 3 Primary',4),(123,53,'Three',31,8,'Frontline Mission 3 Secondary',4),(124,53,'Three',31,15,'First Blood',1),(125,53,'Three',31,22,'Ground Control',1),(126,53,'Three',31,16,'Linebreaker',1),(127,65,'1',34,3,'Frontline Mission 1 Primary',4),(128,65,'1',34,4,'Frontline Mission 1 Secondary',4),(129,65,'1',34,18,'Big Game Hunter',1),(130,65,'1',34,16,'Linebreaker',1),(131,65,'1',34,17,'Slay the Warlord',1),(133,66,'2',34,5,'Frontline Mission 2 Primary',4),(136,66,'2',34,6,'Frontline Mission 2 Secondary',4),(137,66,'2',34,16,'Linebreaker',1),(138,66,'2',34,22,'Ground Control',1),(139,66,'2',34,20,'Table Quarters',1),(140,72,'Round 3',36,15,'First Blood',1),(141,72,'Round 3',36,16,'Linebreaker',1),(142,72,'Round 3',36,17,'Slay the Warlord',1),(143,72,'Round 3',36,13,'Frontline Mission 6 Primary',4),(144,72,'Round 3',36,14,'Frontline Mission 6 Secondary',4),(145,75,'one',38,3,'Frontline Mission 1 Primary',4),(146,75,'one',38,4,'Frontline Mission 1 Secondary',4),(147,75,'one',38,16,'Linebreaker',1),(148,75,'one',38,17,'Slay the Warlord',1),(149,75,'one',38,18,'Big Game Hunter',1),(150,78,'one',39,3,'Frontline Mission 1 Primary',4),(151,78,'one',39,4,'Frontline Mission 1 Secondary',4),(152,78,'one',39,16,'Linebreaker',1),(153,78,'one',39,17,'Slay the Warlord',1),(154,78,'one',39,18,'Big Game Hunter',1),(155,79,'two',39,5,'Frontline Mission 2 Primary',4),(156,79,'two',39,6,'Frontline Mission 2 Secondary',4),(157,79,'two',39,19,'First Strike',1),(158,79,'two',39,15,'First Blood',1),(159,79,'two',39,17,'Slay the Warlord',1),(160,80,'three',39,7,'Frontline Mission 3 Primary',4),(161,80,'three',39,8,'Frontline Mission 3 Secondary',4),(162,80,'three',39,20,'Table Quarters',1),(163,80,'three',39,21,'King of the Hill',1),(164,80,'three',39,22,'Ground Control',1),(165,81,'round 1',40,3,'Frontline Mission 1 Primary',4),(166,81,'round 1',40,4,'Frontline Mission 1 Secondary',4),(167,81,'round 1',40,15,'First Blood',1),(168,81,'round 1',40,16,'Linebreaker',1),(169,81,'round 1',40,17,'Slay the Warlord',1),(170,86,'uno',44,3,'Frontline Mission 1 Primary',4),(171,85,'Alpha',43,3,'Frontline Mission 1 Primary',4),(172,85,'Alpha',43,4,'Frontline Mission 1 Secondary',4),(173,85,'Alpha',43,15,'First Blood',1),(174,86,'uno',44,4,'Frontline Mission 1 Secondary',4),(175,85,'Alpha',43,17,'Slay the Warlord',1),(176,85,'Alpha',43,16,'Linebreaker',1),(177,88,'1st',45,3,'Frontline Mission 1 Primary',4),(178,88,'1st',45,4,'Frontline Mission 1 Secondary',4),(179,88,'1st',45,18,'Big Game Hunter',1),(180,88,'1st',45,16,'Linebreaker',1),(181,88,'1st',45,17,'Slay the Warlord',1),(182,89,'2nd',45,5,'Frontline Mission 2 Primary',4),(183,89,'2nd',45,6,'Frontline Mission 2 Secondary',4),(184,89,'2nd',45,19,'First Strike',1),(185,89,'2nd',45,20,'Table Quarters',1),(186,89,'2nd',45,17,'Slay the Warlord',1),(187,90,'3rd',45,7,'Frontline Mission 3 Primary',4),(188,90,'3rd',45,8,'Frontline Mission 3 Secondary',4),(189,90,'3rd',45,15,'First Blood',1),(190,90,'3rd',45,16,'Linebreaker',1),(191,90,'3rd',45,17,'Slay the Warlord',1),(192,91,'4th',45,13,'Frontline Mission 6 Primary',4),(193,91,'4th',45,14,'Frontline Mission 6 Secondary',4),(194,91,'4th',45,15,'First Blood',1),(195,91,'4th',45,16,'Linebreaker',1),(196,91,'4th',45,17,'Slay the Warlord',1);
/*!40000 ALTER TABLE `matched_tiebreakers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `news_categories`
--

DROP TABLE IF EXISTS `news_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `news_categories` (
  `news_category_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `news_category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`news_category_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `news_categories`
--

LOCK TABLES `news_categories` WRITE;
/*!40000 ALTER TABLE `news_categories` DISABLE KEYS */;
INSERT INTO `news_categories` VALUES (1,'Warhammer 40k'),(2,'Magic The Gathering'),(3,'Tournament'),(4,'Event'),(5,'Dystopian Legions'),(6,'Halo Fleet Battles'),(7,'Horus Heresy'),(8,'Kings of War'),(9,'Net Runner');
/*!40000 ALTER TABLE `news_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification_request`
--

DROP TABLE IF EXISTS `notification_request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification_request` (
  `notification_key` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `notify_fullname` varchar(255) NOT NULL,
  `notify_email` varchar(255) NOT NULL,
  `notify_message` mediumtext NOT NULL,
  `notify_date_sent` datetime NOT NULL,
  PRIMARY KEY (`notification_key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification_request`
--

LOCK TABLES `notification_request` WRITE;
/*!40000 ALTER TABLE `notification_request` DISABLE KEYS */;
INSERT INTO `notification_request` VALUES (1,'Brad Haarer','hyberion@yahoo.com','adfadfadfasdf','0000-00-00 00:00:00'),(2,'Neil Kurgan','hyberion@yahoo.com','This is a thing.','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `notification_request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pages` (
  `pages_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `page_title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_subTitle` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_callout` text COLLATE utf8_unicode_ci NOT NULL,
  `page_body` longtext COLLATE utf8_unicode_ci NOT NULL,
  `page_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `page_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_published_state` enum('draft','pending','published','retracted') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'draft',
  `page_published` date NOT NULL,
  `linkable_to_main_nav` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'no',
  `page_last_modified` datetime NOT NULL,
  `page_keywords` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `page_meta_description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  KEY `pages_id` (`pages_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pages`
--

LOCK TABLES `pages` WRITE;
/*!40000 ALTER TABLE `pages` DISABLE KEYS */;
/*!40000 ALTER TABLE `pages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `players`
--

DROP TABLE IF EXISTS `players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `players` (
  `playerId` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `playerHandle` varchar(200) NOT NULL,
  `playerFirstName` varchar(80) NOT NULL,
  `playerLastName` varchar(80) NOT NULL,
  `playerEmail` varchar(200) NOT NULL,
  `PlayerWinCount` int(3) DEFAULT NULL,
  `PlayerDrawCount` int(3) DEFAULT NULL,
  `PlayerLossCount` int(3) DEFAULT NULL,
  `totalPoints` int(4) unsigned DEFAULT NULL,
  `active` enum('yes','no') NOT NULL DEFAULT 'no',
  `testingAdmin` varchar(140) DEFAULT NULL,
  PRIMARY KEY (`playerId`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `players`
--

LOCK TABLES `players` WRITE;
/*!40000 ALTER TABLE `players` DISABLE KEYS */;
INSERT INTO `players` VALUES (106,'bhaarer','Brad','Haarer','bhaarer@battle-comm.com',NULL,NULL,NULL,275,'yes','Brad'),(107,'zanselm','Zack','Anselm','zanselm@battle-comm.com',NULL,NULL,NULL,310,'yes','Brad'),(108,'bnelson','Bryce','Nelson','bnelson@battle-comm.com',NULL,NULL,NULL,650,'yes','Brad'),(109,'gdanke','Gordon','Danke','gdanke@battle-comm.com',NULL,NULL,NULL,589,'yes','Brad'),(110,'jrossow','Joseph','Rossow','jrossow@battle-comm.com',NULL,NULL,NULL,489,'yes','Brad');
/*!40000 ALTER TABLE `players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_orders`
--

DROP TABLE IF EXISTS `product_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_orders` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `customerId` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` enum('processing','canceled','completed') NOT NULL DEFAULT 'processing',
  `orderDetails` text,
  `orderTotal` int(11) NOT NULL,
  `customerFullName` varchar(70) NOT NULL,
  `customerEmail` varchar(70) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `shippingStreet` varchar(100) NOT NULL,
  `shippingApartment` varchar(11) NOT NULL,
  `shippingCity` varchar(70) NOT NULL,
  `shippingState` varchar(50) NOT NULL,
  `shippingZip` int(11) NOT NULL,
  `shippingCountry` varchar(70) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=174 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_orders`
--

LOCK TABLES `product_orders` WRITE;
/*!40000 ALTER TABLE `product_orders` DISABLE KEYS */;
INSERT INTO `product_orders` VALUES (36,0,'0000-00-00 00:00:00','2016-04-24 14:41:10','processing','ID:4, Product:Fourth Product, RP:4815, Qty:1',4815,'Bobby Jones','bobby@gmail.com','','393 E. Blue St.','','Milwaukee','WI',39399,'United States'),(38,0,'0000-00-00 00:00:00','2016-04-24 14:44:12','processing','ID:4, Product:Fourth Product, RP:4815, Qty:1 || ID:3, Product:Third Product, RP:2115, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:1 || ID:5, Product:Fifth Product, RP:315, Qty:1 || ID:2, Product:Second Product, RP:230, Qty:1',8890,'Johnny Jones','john@gmail.com','','192 E st.','','Carmel','IN',40400,'United States'),(39,0,'0000-00-00 00:00:00','2016-04-24 14:45:05','processing','ID:5, Product:Fifth Product, RP:315, Qty:1 || ID:2, Product:Second Product, RP:230, Qty:1',545,'Jenny Jones','jenny@gmail.com','','3939 W Brendan Ave','','Indianapolis','IN',46206,'United States'),(40,0,'0000-00-00 00:00:00','2016-04-24 16:59:50','canceled','ID:3, Product:Third Product, RP:2115, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:1',3530,'Bob Ronsson','bob@gmail.com','','192 W St.','234','Indianapolis','IN',46204,'United States'),(41,0,'0000-00-00 00:00:00','2016-04-24 16:46:23','completed','ID:2, Product:Second Product, RP:230, Qty:1 || ID:4, Product:Fourth Product, RP:4815, Qty:1',5045,'Tim Andrews','tim@gmail.com','','888 W Illinois St.','','Illinois','IL',39399,'United States'),(42,49,'0000-00-00 00:00:00','2016-06-09 22:56:22','completed','ID:1, Product:First Product, RP:1415, Qty:1',1415,'Alex Anders','alex@gmail.com','312343234323','3939 N ave','','Indianapolis','Indiana',46204,'United States'),(43,0,'0000-00-00 00:00:00','2016-04-24 17:39:23','completed','ID:1, Product:First Product, RP:1415, Qty:1',1415,'Allie Redmond','allie@gmail.com','','999 S Yellow Ave.','','Indianapolis','IN',46204,'United States'),(132,0,'2016-04-24 18:36:45','2016-04-24 18:36:45','processing','ID:1, Product:First Product, RP:1415, Qty:1 || ID:3, Product:Third Product, RP:2115, Qty:1',3530,'Morgan Smith','morgan@gmail.com','3930029393','8383 W st.','909','Indianapolis','IN',46204,'United States'),(133,0,'2016-04-25 01:38:39','2016-04-25 01:40:51','completed','ID:2, Product:Second Product, RP:230, Qty:1 || ID:5, Product:Fifth Product, RP:315, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:1',1960,'Mobile Customer Test','mobile@gmail.com','3737777737','157 Boutel Dr.','5','Flint','MI',49288,'United States'),(134,0,'2016-04-26 04:26:50','2016-04-26 04:30:30','processing','ID:5, Product:Fifth Product, RP:315, Qty:2 || ID:2, Product:Second Product, RP:230, Qty:1',860,'Gordon Danke','GordonDanke@gmail.com','5304173399','3100 Countryside Drive','','Placerville','California',95667,'United States'),(135,0,'2016-05-03 15:25:39','2016-05-03 15:44:57','completed','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Test Order','zanselm5@gmail.com','3175448348','530 E Ohio St Apt 204','204','Indianapolis','Indiana',46204,'United States'),(138,4,'2016-05-03 20:07:59','2016-05-03 20:07:59','processing','ID:2, Product:Second Product, RP:230, Qty:1 || ID:5, Product:Fifth Product, RP:315, Qty:1',545,'Points Test','zanselm5@gmail.com','3175448348','909 W 11th street','3','Bloomington','Indiana',47404,'United States'),(146,4,'2016-05-03 20:56:23','2016-07-17 16:29:10','processing','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'RP Test','zanselm5@gmail.com','3175448348','909 W 11th street','3','Bloomington','Indiana',47404,'United States'),(147,4,'2016-05-03 21:26:48','2016-05-03 21:26:48','processing','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Benny Roland','benny@gmail.com','4848884848','3939 E. st.','3','Sacramento','California',49499,'United States'),(148,4,'2016-05-21 14:39:30','2016-06-09 23:08:10','processing','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Zack Anselm','zanselm5@gmail.com','3432232334','14371 Whitworth Dr.','','Carmel','IN',46033,'United States'),(149,4,'2016-07-17 17:40:11','2016-07-17 17:40:45','canceled','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Zack Anselm test','zanselm5@gmail.com','3175448348','14371 Whitworth Dr.','201','Carmel','IN',46033,'United States'),(150,2,'2016-07-17 19:42:40','2016-07-17 20:35:52','processing','ID:5, Product:Fifth Product, RP:315, Qty:1 || ID:4, Product:Fourth Product, RP:4815, Qty:1 || ID:2, Product:Second Product, RP:230, Qty:1',5360,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','California',95660,'USA'),(151,2,'2016-07-17 21:08:07','2016-07-17 21:08:07','processing','ID:1, Product:First Product, RP:1415, Qty:3 || ID:2, Product:Second Product, RP:230, Qty:4',5165,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North highlands','California',95660,'USA'),(152,2,'2016-07-18 00:07:44','2016-07-18 00:07:44','processing','ID:3, Product:Third Product, RP:2115, Qty:3 || ID:2, Product:Second Product, RP:230, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:3',10820,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','CA',95660,'US'),(153,2,'2016-07-18 01:18:02','2016-07-18 01:18:02','processing','ID:2, Product:Second Product, RP:230, Qty:4 || ID:3, Product:Third Product, RP:2115, Qty:4',9380,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'America'),(154,2,'2016-07-18 03:27:41','2016-07-18 03:27:41','processing','ID:5, Product:Fifth Product, RP:315, Qty:4 || ID:4, Product:Fourth Product, RP:4815, Qty:2',10890,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North Highlands','Ca',95660,'Us'),(155,2,'2016-07-18 04:29:48','2016-07-18 04:29:48','processing','ID:5, Product:Fifth Product, RP:315, Qty:4 || ID:2, Product:Second Product, RP:230, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:2',4320,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'Usa'),(156,2,'2016-07-18 16:59:05','2016-07-18 16:59:05','processing','ID:5, Product:Fifth Product, RP:315, Qty:1 || ID:4, Product:Fourth Product, RP:4815, Qty:1 || ID:3, Product:Third Product, RP:2115, Qty:1 || ID:2, Product:Second Product, RP:230, Qty:1 || ID:1, Product:First Product, RP:1415, Qty:1',8890,'Bryce Nelson','biffater72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(157,2,'2016-07-18 17:02:44','2016-07-18 17:02:44','processing','ID:5, Product:Fifth Product, RP:315, Qty:2 || ID:4, Product:Fourth Product, RP:4815, Qty:1 || ID:2, Product:Second Product, RP:230, Qty:3 || ID:1, Product:First Product, RP:1415, Qty:1',7550,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(158,2,'2016-07-18 17:06:33','2016-07-18 17:06:33','processing','ID:2, Product:Second Product, RP:230, Qty:5 || ID:1, Product:First Product, RP:1415, Qty:1 || ID:5, Product:Fifth Product, RP:315, Qty:5',4140,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(159,2,'2016-07-18 17:11:56','2016-07-18 17:11:56','processing','ID:3, Product:Third Product, RP:2115, Qty:5 || ID:2, Product:Second Product, RP:230, Qty:5',11725,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(160,2,'2016-07-18 17:17:35','2016-07-18 17:17:35','processing','ID:2, Product:Second Product, RP:230, Qty:10',2300,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(161,2,'2016-07-18 17:19:21','2016-07-18 17:19:21','processing','ID:5, Product:Fifth Product, RP:315, Qty:11',3465,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North Highlands','CA',95660,'USA'),(162,2,'2016-07-18 17:21:36','2016-07-18 17:21:36','processing','ID:1, Product:First Product, RP:1415, Qty:2 || ID:2, Product:Second Product, RP:230, Qty:4',3750,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'USA'),(163,2,'2016-07-18 17:46:41','2016-07-18 17:46:41','processing','ID:2, Product:Second Product, RP:230, Qty:10 || ID:5, Product:Fifth Product, RP:315, Qty:10',5450,'Bryce Nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'USA'),(164,2,'2016-07-18 17:48:12','2016-07-18 17:48:12','processing','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'Us'),(165,2,'2016-07-18 17:49:55','2016-07-18 17:49:55','processing','ID:2, Product:Second Product, RP:230, Qty:1',230,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'USA'),(166,2,'2016-07-18 17:52:24','2016-07-18 17:52:24','processing','ID:1, Product:First Product, RP:1415, Qty:1',1415,'Bryce Nelson','biffster72@gmail.co','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'USA'),(167,2,'2016-07-18 17:56:06','2016-07-19 22:47:59','processing','ID:5, Product:Fifth Product, RP:315, Qty:2',630,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North Highlands','Ca',95660,'Usa'),(168,2,'2016-07-18 17:58:34','2016-07-18 17:58:34','processing','ID:5, Product:Fifth Product, RP:315, Qty:2 || ID:2, Product:Second Product, RP:230, Qty:1',860,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind Ave.','','North highlands','Ca',95660,'Usa'),(169,2,'2016-07-18 18:28:28','2016-07-19 22:47:41','processing','ID:2, Product:Second Product, RP:230, Qty:2 || ID:5, Product:Fifth Product, RP:315, Qty:2',1090,'Bryce nelson','biffster72@gmail.com','','3624 Jenny Lind ave.','','North highlands','Ca',95660,'USA'),(170,4,'2016-07-20 01:46:30','2016-08-14 21:11:56','completed','ID:5, Product:Fifth Product, RP:315, Qty:1',315,'Test','test@gmail.com','3122321231','123 W St.','100','Carmel','IN',49499,'United States'),(171,4,'2016-08-14 21:57:50','2016-08-14 21:57:50','processing','ID:1, Product:Malifaux, RP:1000, Qty:1',1000,'Zack','zanselm5@gmail.com','3423243244','123 W 10th St','23','Indianapolis','IN',46030,'United States'),(172,4,'2016-08-17 00:29:16','2016-08-17 00:29:16','processing','ID:2, Product:Wild Wild West Exodus, RP:1000, Qty:1',1000,'New','zanselm5@gmail.com','3175448348','530 E Ohio St Apt 204','2323','Indianapolis','Indiana',46204,'United States'),(173,4,'2016-08-17 23:08:00','2016-08-17 23:08:00','processing','ID:2, Product:Wild Wild West Exodus, RP:1000, Qty:1',1000,'Zack Anselm','zanselm5@gmail.com','3175448348','530 E Ohio St Apt 204','','Indianapolis','Indiana',46204,'United States');
/*!40000 ALTER TABLE `product_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `randomPlayerInfo`
--

DROP TABLE IF EXISTS `randomPlayerInfo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `randomPlayerInfo` (
  `randomPlayerKey` int(11) NOT NULL AUTO_INCREMENT,
  `player_handle` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `playerFirstName` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `playerLastName` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `playerEmail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`randomPlayerKey`)
) ENGINE=MyISAM AUTO_INCREMENT=101 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `randomPlayerInfo`
--

LOCK TABLES `randomPlayerInfo` WRITE;
/*!40000 ALTER TABLE `randomPlayerInfo` DISABLE KEYS */;
INSERT INTO `randomPlayerInfo` VALUES (1,'rutrum non,','Kessie','Hoover','Nullam@ornaresagittis.edu'),(2,'risus. Nulla','Megan','Perkins','nec@lacusAliquam.co.uk'),(3,'lectus pede','George','Andrews','sagittis@luctus.com'),(4,'non dui','Jelani','Cummings','eu.augue@loremvehicula.ca'),(5,'enim, gravida','Addison','Espinoza','elit.pretium@Innec.org'),(6,'adipiscing. Mauris','Addison','Bailey','ante.Vivamus@ut.com'),(7,'facilisi. Sed','Nicole','Navarro','pretium@euismodac.net'),(8,'Cum sociis','Gisela','Flowers','adipiscing@accumsannequeet.net'),(9,'nunc est,','Wilma','Reyes','pede@mauriseuelit.co.uk'),(10,'eu tempor','Basil','Bird','vulputate.posuere@Namtempordiam.org'),(11,'Duis gravida.','Serina','Nixon','et@Etiamimperdiet.ca'),(12,'dictum magna.','Clinton','Downs','cursus@Inornare.edu'),(13,'facilisis lorem','Buckminster','Cooley','Nulla.tempor.augue@feugiatSednec.com'),(14,'hendrerit consectetuer,','Barclay','Horn','orci@utmolestiein.net'),(15,'in sodales','Jaquelyn','Witt','purus.mauris@amet.com'),(16,'egestas. Sed','Linda','Gibbs','lacinia.orci.consectetuer@eutemporerat.net'),(17,'convallis convallis','Gwendolyn','Mccormick','a.tortor@Integersemelit.net'),(18,'est. Nunc','Blake','Burt','metus.vitae.velit@bibendum.net'),(19,'Integer vulputate,','Ariana','Mclaughlin','id@seddolorFusce.org'),(20,'semper cursus.','Athena','Ferrell','Sed@vitaerisusDuis.net'),(21,'nunc ac','Ashely','Koch','odio@Sedpharetra.edu'),(22,'nulla ante,','Jesse','Mcintyre','sapien.gravida.non@dolor.ca'),(23,'et ipsum','Naomi','Perkins','semper.cursus.Integer@hendreritidante.com'),(24,'accumsan neque','Jerry','Hamilton','justo.eu@sedconsequatauctor.co.uk'),(25,'mauris sagittis','Flavia','Terry','nec@magna.edu'),(26,'vel turpis.','Brent','Farrell','sed.consequat@Etiamgravidamolestie.org'),(27,'in, hendrerit','Clio','Harrison','molestie@commodoatlibero.com'),(28,'aliquam, enim','Donna','Farrell','diam.nunc@mollisInteger.org'),(29,'sollicitudin orci','Kim','Chang','Quisque.porttitor.eros@interdumlibero.net'),(30,'nostra, per','Tallulah','Wells','augue.scelerisque@consequat.co.uk'),(31,'sagittis. Nullam','Warren','Morales','blandit.enim.consequat@magnis.ca'),(32,'arcu. Morbi','Jorden','Horne','Nulla.aliquet@nascetur.com'),(33,'eros non','Cody','Wilcox','nisi.Aenean@risusquis.co.uk'),(34,'Nulla facilisi.','Kai','Sykes','luctus.sit.amet@Curabiturconsequatlectus.edu'),(35,'mauris eu','Lara','Golden','eget.tincidunt@a.edu'),(36,'nisi magna','Quintessa','Barton','mattis@amet.edu'),(37,'Nulla eget','Kareem','Carter','Donec@auctorvelit.co.uk'),(38,'Quisque imperdiet,','Duncan','Wooten','augue.Sed@ametmetus.com'),(39,'enim. Etiam','Bernard','Melton','nulla@sitametdapibus.edu'),(40,'enim, condimentum','Dana','Dejesus','Proin@euerat.edu'),(41,'Quisque porttitor','Susan','Delacruz','volutpat.Nulla.dignissim@egestasascelerisque.org'),(42,'taciti sociosqu','Benjamin','Griffin','vitae@ac.com'),(43,'eget metus.','Vivian','Gates','faucibus.Morbi.vehicula@tincidunttempusrisus.edu'),(44,'faucibus. Morbi','Kevin','Bauer','eu.euismod@euismodet.edu'),(45,'egestas nunc','Nevada','Floyd','ante@tristiqueac.org'),(46,'Aliquam tincidunt,','Britanni','Ross','purus@mollisDuissit.edu'),(47,'aliquam, enim','Meghan','Davenport','Phasellus.libero@Suspendissesed.co.uk'),(48,'tempor augue','Rebekah','Spence','dui.Cras@molestie.com'),(49,'cubilia Curae;','Minerva','Rose','Nunc.mauris@cursuset.org'),(50,'volutpat. Nulla','Bradley','Sherman','magnis@atauctorullamcorper.com'),(51,'hendrerit a,','Brett','Stout','Donec.non.justo@MaurismagnaDuis.org'),(52,'dolor. Fusce','Keegan','Wilkinson','neque.sed.sem@lacus.com'),(53,'elementum sem,','Eaton','Estrada','Sed.molestie@SedmolestieSed.co.uk'),(54,'Nulla facilisi.','Francesca','Foley','Suspendisse@odio.ca'),(55,'Cum sociis','Blossom','Glass','massa.Integer.vitae@Lorem.ca'),(56,'Aliquam gravida','Matthew','Peck','nulla.Cras.eu@Aeneansed.co.uk'),(57,'augue, eu','Chester','Anthony','quis.pede@Praesent.com'),(58,'Pellentesque habitant','Callum','Roberts','vitae.diam.Proin@noncursusnon.edu'),(59,'et, commodo','Jerome','Ellison','vitae.odio@semper.co.uk'),(60,'turpis. Nulla','Stacey','Alford','tempor.bibendum@Cras.co.uk'),(61,'ipsum primis','Stewart','Puckett','vehicula.risus@sociisnatoque.ca'),(62,'libero mauris,','Gage','Mcfarland','libero.mauris.aliquam@risusDonecegestas.com'),(63,'et magnis','Uriah','Allen','non.bibendum@vulputatemauris.co.uk'),(64,'Duis mi','Kaitlin','Taylor','gravida@facilisi.ca'),(65,'elit, pharetra','Shannon','Vasquez','ut@Morbisit.edu'),(66,'velit. Aliquam','Larissa','Hogan','ultrices.sit@nibh.edu'),(67,'vel pede','Eden','Holmes','Vestibulum@feugiatmetus.net'),(68,'aliquet lobortis,','Julie','Castro','mollis.lectus@consequatdolor.net'),(69,'in aliquet','Brody','Austin','scelerisque@Etiamgravidamolestie.net'),(70,'dictum. Phasellus','Gareth','Morin','Cum.sociis@leoCras.com'),(71,'sociis natoque','Nerea','Berger','sit@molestiedapibus.ca'),(72,'dui augue','Tucker','Cannon','tortor.at.risus@gravida.net'),(73,'Sed nec','Ulysses','Stark','et@porttitortellusnon.org'),(74,'convallis convallis','Macy','Bates','ipsum.leo@blanditmattis.co.uk'),(75,'ipsum. Phasellus','Tamara','Garrett','Donec.tempor@sedtortor.com'),(76,'Nunc ut','Suki','Sweet','nibh@risus.net'),(77,'congue a,','Kevin','Tillman','purus.in@Vestibulumanteipsum.ca'),(78,'Aenean euismod','Iris','Black','Nullam.feugiat@orci.org'),(79,'orci quis','Germane','Goodman','Quisque@vitae.org'),(80,'mauris, aliquam','Jaquelyn','Bailey','dis@necdiam.com'),(81,'ultrices. Duis','TaShya','Todd','Mauris@quamCurabitur.edu'),(82,'dui nec','Maryam','Sellers','ullamcorper.velit@at.com'),(83,'at risus.','Mikayla','Landry','non.magna@Pellentesque.org'),(84,'volutpat nunc','Cassidy','Whitaker','montes@vellectus.com'),(85,'aliquet, sem','Rhea','May','posuere.vulputate@Duis.co.uk'),(86,'iaculis aliquet','Bert','Golden','Mauris.magna@liberonecligula.net'),(87,'sit amet','Lenore','Gibbs','non.dapibus@Maecenaslibero.net'),(88,'Cras convallis','Drew','Mooney','rutrum.Fusce@interdumNuncsollicitudin.ca'),(89,'eleifend nec,','Quamar','Tate','orci.lacus.vestibulum@necurnaet.ca'),(90,'aliquet vel,','Whoopi','Holcomb','mattis.velit@temporest.edu'),(91,'eu sem.','Keely','Lyons','in@ultricesiaculisodio.edu'),(92,'In lorem.','Hayfa','Mercer','Cras@egestas.edu'),(93,'ac arcu.','Keelie','Bird','Nullam.vitae@eratSed.com'),(94,'eu tellus','Nigel','Reed','augue@dictumcursus.co.uk'),(95,'tempor bibendum.','Quintessa','Sweeney','lacinia.orci.consectetuer@vitaeeratVivamus.edu'),(96,'Nullam nisl.','Holly','Shaw','quam.vel.sapien@risusNuncac.ca'),(97,'vestibulum. Mauris','Zeus','Cross','auctor.velit.Aliquam@nondapibus.org'),(98,'fringilla cursus','Maia','Bray','enim@malesuada.org'),(99,'Proin mi.','Bree','Griffith','Donec.egestas@luctusipsum.com'),(100,'taciti sociosqu','Gemma','Cochran','urna@luctussitamet.com');
/*!40000 ALTER TABLE `randomPlayerInfo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tableFeed`
--

DROP TABLE IF EXISTS `tableFeed`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableFeed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `when` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tableFeed`
--

LOCK TABLES `tableFeed` WRITE;
/*!40000 ALTER TABLE `tableFeed` DISABLE KEYS */;
/*!40000 ALTER TABLE `tableFeed` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tableUpdates`
--

DROP TABLE IF EXISTS `tableUpdates`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tableUpdates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `when` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tableUpdates`
--

LOCK TABLES `tableUpdates` WRITE;
/*!40000 ALTER TABLE `tableUpdates` DISABLE KEYS */;
/*!40000 ALTER TABLE `tableUpdates` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_state`
--

DROP TABLE IF EXISTS `tbl_state`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_state` (
  `state_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'PK: Unique state ID',
  `state_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL COMMENT 'State name with first letter capital',
  `state_abbr` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Optional state abbreviation (US is 2 capital letters)',
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_state`
--

LOCK TABLES `tbl_state` WRITE;
/*!40000 ALTER TABLE `tbl_state` DISABLE KEYS */;
INSERT INTO `tbl_state` VALUES (1,'Alabama','AL'),(2,'Alaska','AK'),(3,'Arizona','AZ'),(4,'Arkansas','AR'),(5,'California','CA'),(6,'Colorado','CO'),(7,'Connecticut','CT'),(8,'Delaware','DE'),(9,'District of Columbia','DC'),(10,'Florida','FL'),(11,'Georgia','GA'),(12,'Hawaii','HI'),(13,'Idaho','ID'),(14,'Illinois','IL'),(15,'Indiana','IN'),(16,'Iowa','IA'),(17,'Kansas','KS'),(18,'Kentucky','KY'),(19,'Louisiana','LA'),(20,'Maine','ME'),(21,'Maryland','MD'),(22,'Massachusetts','MA'),(23,'Michigan','MI'),(24,'Minnesota','MN'),(25,'Mississippi','MS'),(26,'Missouri','MO'),(27,'Montana','MT'),(28,'Nebraska','NE'),(29,'Nevada','NV'),(30,'New Hampshire','NH'),(31,'New Jersey','NJ'),(32,'New Mexico','NM'),(33,'New York','NY'),(34,'North Carolina','NC'),(35,'North Dakota','ND'),(36,'Ohio','OH'),(37,'Oklahoma','OK'),(38,'Oregon','OR'),(39,'Pennsylvania','PA'),(40,'Rhode Island','RI'),(41,'South Carolina','SC'),(42,'South Dakota','SD'),(43,'Tennessee','TN'),(44,'Texas','TX'),(45,'Utah','UT'),(46,'Vermont','VT'),(47,'Virginia','VA'),(48,'Washington','WA'),(49,'West Virginia','WV'),(50,'Wisconsin','WI'),(51,'Wyoming','WY');
/*!40000 ALTER TABLE `tbl_state` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament`
--

DROP TABLE IF EXISTS `tournament`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament` (
  `tournament_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_startDate` date DEFAULT NULL,
  `tournament_startTime` time DEFAULT NULL,
  `Tournament_endDate` date DEFAULT NULL,
  `Tournament_endTime` time DEFAULT NULL,
  `tournament_store_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_add_new_location` enum('yes','no') COLLATE utf8_unicode_ci NOT NULL,
  `tournament_location _name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_logo_icon` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_city` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_state` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_zip` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_phone` varchar(24) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_admin_id` varchar(175) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_admin_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `tournament_info` longtext COLLATE utf8_unicode_ci NOT NULL,
  `tournament_notes` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `tournament_rounds` int(4) NOT NULL,
  `factions_cap` int(3) DEFAULT NULL,
  `No_of_Games` int(3) DEFAULT NULL,
  `game_id` int(3) DEFAULT NULL,
  `game_title` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WinPointValue` smallint(5) unsigned DEFAULT NULL,
  `DrawPointValue` smallint(5) unsigned DEFAULT NULL,
  `LossPointValue` smallint(5) unsigned DEFAULT NULL,
  `tournament_owner` int(11) DEFAULT NULL,
  PRIMARY KEY (`tournament_id`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament`
--

LOCK TABLES `tournament` WRITE;
/*!40000 ALTER TABLE `tournament` DISABLE KEYS */;
INSERT INTO `tournament` VALUES (18,'Contest of Champions','2015-08-24','10:30:00','2015-08-24','07:30:00','','yes','','','1250 Howe Ave Ste 3A','Sacramento','CA','95825','(916) 927-0810','Omegaprime69@Gmail.com','','','','','Testing Update',3,2,20,9,'',1000,500,0,0),(23,'CoC II','2015-10-26','12:00:00','2015-10-26','12:00:00','','yes','','','1250 Howe Ave. Suite 3a','Sacramento','CA','95825','','bnelson@battle-comm.com','','','','<p>1850pt</p>\r\n','',3,2,6,9,'',1000,500,100,0),(36,'No Mercy 3','2015-10-04','09:30:00','2015-10-04','18:30:00','','yes','','','','Sacramento ','CA','','','nomercygr@gmail.com','http://www.leagueofpainters.com/?page_id=1546','49','','','49',3,16,1,9,'',1000,NULL,0,49),(34,'Warhammer 40K Contest of Champions','2015-10-29','10:30:00','2015-10-29','08:15:00','','yes','','','1250 Howe Ave Ste 3a','Sacramento ','CA','95825','(916) 927-0810','Omegaprime69@Gmail.com','','11','','<p><u><span style=\"font-size:inherit\">Army composition:</span></u></p>\r\n\r\n<ol>\r\n	<li>Primary Detachment + up to 3 additional formations or detachments.</li>\r\n	<li>No duplicate formations or detachments.</li>\r\n	<li>Primary Detachment must include an HQ &amp; 2 Troops.</li>\r\n	<li>Warlord must come from the Primary detachment.</li>\r\n	<li>As this will be a themed event players primary detachment must equal at least 1,000+ points.</li>\r\n	<li>Allies can be taken.</li>\r\n	<li>No Forgeworld</li>\r\n</ol>\r\n\r\n<p><strong><span style=\"color:rgb(0, 0, 0); font-size:inherit\"><span style=\"font-size:inherit\"><span style=\"font-size:small\"><u>Fortifications</u></span></span></span></strong></p>\r\n\r\n<ul>\r\n	<li>\r\n	<p><span style=\"color:rgb(0, 0, 0); font-size:inherit\"><span style=\"font-size:inherit\"><span style=\"font-size:small\">All fortification data slates and upgrades from the Stronghold Assault book are legal except the Macro Cannon Aquila Strongpoint and the Vortex Missile Aquila Strongpoint, which are not allowed.</span></span></span></p>\r\n	</li>\r\n	<li>\r\n	<p><span style=\"color:rgb(0, 0, 0); font-size:inherit\"><span style=\"font-size:inherit\"><span style=\"font-size:small\">No Fortification Networks may be taken.</span></span></span></p>\r\n	</li>\r\n</ul>\r\n\r\n<p><u><span style=\"font-size:inherit\">Factions:</span></u></p>\r\n\r\n<p><span style=\"font-size:inherit\">Law &amp; Order:</span>&nbsp;Adepta Sororitas, Astra Militarum, Cult Mechanicus, Imperial Knights, Inquisition, Skitarii, Space Marines (all chapters)</p>\r\n\r\n<p><span style=\"font-size:inherit\">Chaos &amp; Destruction:</span></p>\r\n\r\n<p>Chaos Daemons, Chaos Space Marines, Dark Eldar, Necrons, Khorne Deamonkin &amp; Tyranids</p>\r\n\r\n<p><span style=\"font-size:inherit\">Neautral:</span></p>\r\n\r\n<p>Eldar, Orks &amp; Tau</p>\r\n\r\n<p><span style=\"font-size:inherit\">Tournament format:</span></p>\r\n\r\n<p>1: Players will be divided into two sides based off of their primary detachment.</p>\r\n\r\n<p>2: Neutral armies will be shifted to either side to balance out the tournament.</p>\r\n\r\n<p>3: A team captain &amp; co-team captain will be selected for each side.</p>\r\n\r\n<p>4: Team captains will role off at the start of the tournament.</p>\r\n\r\n<p>5: Starting with the team that lost the roll off, captains will choose an army.</p>\r\n\r\n<p>6: The opposing team captains will choose an army from their roster to battle against each other. 7: Team Captains will not know which players control each army, just the army type.</p>\r\n\r\n<p><u><span style=\"font-size:inherit\">Awards:</span></u></p>\r\n\r\n<p>BEST OVERAL: Overall best score of both factions</p>\r\n\r\n<p>Best Faction Generals: 1 for each faction</p>\r\n\r\n<p>Best Sprtsmanship:</p>\r\n\r\n<p>Best Army (Players Choice)</p>\r\n\r\n<p>Best Painted (Judges Award)</p>\r\n\r\n<p>Grot Award (Lowest Battlescore)</p>\r\n','',3,3,20,9,'',1000,500,0,6),(37,'Bryce Test Uno','2015-10-17','00:00:00','2015-10-17','00:00:00','','yes','','','','','','','','bnelson@battle-comm.com','','2','','','',3,2,500,9,'',15,10,5,2),(38,'B1','2015-11-10','00:00:09','2015-11-10','00:00:08','','yes','','','','','','','','bnelson@battle-comm.com','','2','','','',3,3,100,9,'',10,5,0,2),(40,'LVO TEST','2015-11-13','00:00:03','2015-11-14','00:00:08','','yes','','lvo2016_1.jpg','Las Vegas','Las Vegas','CA','91762','(924) 566-5485','frankiegiampapa@gmail.com','','70','','<p>waeawea</p>\r\n\r\n<p>wae</p>\r\n','',6,2,1,9,'',1000,500,0,70),(41,'12/19 Remote Testing','2015-12-19','00:00:01','2015-12-19','00:00:10','','yes','','test1.jpg','1-800-yo-house','any','','','','frankiegiampapa@gmail.com','','70','','<p>This is the first round of testing of Battlecomm.</p>\r\n','',3,0,60,9,'',100,500,0,70),(45,'Butchers of Bakersfield','2016-01-09','00:00:00','2016-01-09','00:00:00','','yes','','','','','','','','4122423@gmail.com','','92','','','',4,0,25,9,'',1000,500,0,92);
/*!40000 ALTER TABLE `tournament` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_game`
--

DROP TABLE IF EXISTS `tournament_game`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_game` (
  `tournament_game_id` int(11) NOT NULL,
  `match_id` int(11) NOT NULL,
  `in_session` enum('yes','no') NOT NULL DEFAULT 'no',
  `game_completed` enum('yes','no') NOT NULL DEFAULT 'no',
  `game_title` varchar(255) NOT NULL,
  `game_result_status` enum('pending submission','pending approval','approved') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_game`
--

LOCK TABLES `tournament_game` WRITE;
/*!40000 ALTER TABLE `tournament_game` DISABLE KEYS */;
/*!40000 ALTER TABLE `tournament_game` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_game_player`
--

DROP TABLE IF EXISTS `tournament_game_player`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_game_player` (
  `tourney_game_player_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tourney_players_id` int(11) unsigned DEFAULT NULL,
  `player_id` int(11) NOT NULL,
  `player_handle` varchar(100) NOT NULL,
  `clubID` int(11) DEFAULT NULL,
  `tourney_round_id` int(11) NOT NULL,
  `tourney_round_title` varchar(100) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `game_id` int(11) NOT NULL,
  `game_title` varchar(100) NOT NULL,
  `Game_session` varchar(40) NOT NULL,
  `table_id` varchar(40) NOT NULL,
  `game_result` varchar(10) NOT NULL,
  `Game_info` mediumtext NOT NULL,
  `game_points` int(8) unsigned NOT NULL,
  `mission_points` int(8) NOT NULL,
  `total_points` int(8) NOT NULL,
  `Notes_comments` mediumtext,
  `results_approved` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`tourney_game_player_id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_game_player`
--

LOCK TABLES `tournament_game_player` WRITE;
/*!40000 ALTER TABLE `tournament_game_player` DISABLE KEYS */;
INSERT INTO `tournament_game_player` VALUES (1,240,2,'TheDude',NULL,78,'one',39,9,'Warhammer 40K','1','1','loss','',0,1,1,NULL,'no'),(2,241,70,'White925',NULL,78,'one',39,9,'Warhammer 40K','1','1','win','',1000,5,1005,NULL,'no'),(3,242,2,'TheDude',NULL,81,'round 1',40,9,'Warhammer 40K','1','1','loss','',0,1,1,NULL,'no'),(4,243,70,'White925',NULL,81,'round 1',40,9,'Warhammer 40K','1','1','Choose Out','',500,5,505,'','no'),(5,171,10,'DarkLink',NULL,65,'1',34,9,'Warhammer 40K','1','1','','',0,0,0,NULL,'no'),(6,173,46,'TheBrandonOne',NULL,65,'1',34,9,'Warhammer 40K','1','1','','',0,0,0,NULL,'no'),(7,184,47,'Trev',NULL,65,'1',34,9,'Warhammer 40K','2','2','','',0,0,0,NULL,'no'),(8,183,49,'NoahSmall83',NULL,65,'1',34,9,'Warhammer 40K','2','2','','',0,0,0,NULL,'no'),(9,185,2,'TheDude',NULL,65,'1',34,9,'Warhammer 40K','3','3','','',0,0,0,NULL,'no'),(10,236,6,'hyberion',NULL,65,'1',34,9,'Warhammer 40K','3','3','','',0,0,0,NULL,'no'),(11,172,44,'Tee Dee',NULL,65,'1',34,9,'Warhammer 40K','4','4','','',0,0,0,NULL,'no'),(12,175,26,'Ascension ',NULL,65,'1',34,9,'Warhammer 40K','4','4','','',0,0,0,NULL,'no'),(13,178,33,'BAngels Player to lose',NULL,65,'1',34,9,'Warhammer 40K','5','5','','',0,0,0,NULL,'no'),(14,179,48,'Brett',NULL,65,'1',34,9,'Warhammer 40K','5','5','','',0,0,0,NULL,'no'),(15,180,45,'Aftotheb',NULL,65,'1',34,9,'Warhammer 40K','6','6','','',0,0,0,NULL,'no'),(16,181,45,'Aftotheb',NULL,65,'1',34,9,'Warhammer 40K','6','6','','',0,0,0,NULL,'no'),(17,182,45,'Aftotheb',NULL,65,'1',34,9,'Warhammer 40K','7','7','','',0,0,0,NULL,'no'),(18,186,10,'DarkLink',NULL,65,'1',34,9,'Warhammer 40K','7','7','','',0,0,0,NULL,'no'),(19,244,2,'TheDude',NULL,85,'Alpha',43,9,'Warhammer 40K','1','1','loss','',0,1,1,NULL,'no'),(20,245,92,'Chadimus',NULL,85,'Alpha',43,9,'Warhammer 40K','1','1','win','',1000,9,1009,NULL,'no');
/*!40000 ALTER TABLE `tournament_game_player` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_game_tiebreaker_lookup`
--

DROP TABLE IF EXISTS `tournament_game_tiebreaker_lookup`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_game_tiebreaker_lookup` (
  `tournament_game_tiebreaker_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_round_id` int(11) NOT NULL,
  `Round_title` varchar(100) NOT NULL,
  `tournament_id` int(11) NOT NULL,
  `tournament_Title` varchar(255) NOT NULL,
  `tournament_tiebreaker_id` int(11) NOT NULL,
  PRIMARY KEY (`tournament_game_tiebreaker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_game_tiebreaker_lookup`
--

LOCK TABLES `tournament_game_tiebreaker_lookup` WRITE;
/*!40000 ALTER TABLE `tournament_game_tiebreaker_lookup` DISABLE KEYS */;
INSERT INTO `tournament_game_tiebreaker_lookup` VALUES (1,14,'',2,'',1),(2,14,'',2,'',3),(3,14,'',2,'',8),(4,15,'',2,'',15),(5,15,'',2,'',15),(6,15,'',2,'',10),(7,16,'',2,'',19),(8,16,'',2,'',21),(9,16,'',2,'',17),(10,36,'',5,'',11),(11,36,'',5,'',14),(12,36,'',5,'',15),(13,35,'',5,'',6),(14,35,'',5,'',10),(15,35,'',5,'',3),(16,35,'',5,'',18);
/*!40000 ALTER TABLE `tournament_game_tiebreaker_lookup` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_match`
--

DROP TABLE IF EXISTS `tournament_match`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_match` (
  `tournament_match_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_round_id` varchar(100) NOT NULL,
  `tournament_id` varchar(100) NOT NULL,
  `game_system_id` varchar(100) NOT NULL,
  `noOfGames` int(3) unsigned NOT NULL,
  PRIMARY KEY (`tournament_match_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_match`
--

LOCK TABLES `tournament_match` WRITE;
/*!40000 ALTER TABLE `tournament_match` DISABLE KEYS */;
INSERT INTO `tournament_match` VALUES (7,'Round 1','2','Warhammer 40K',4),(8,'Round 2','2','Warhammer 40K',5),(9,'Round 1','2','Traveller',4);
/*!40000 ALTER TABLE `tournament_match` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_players`
--

DROP TABLE IF EXISTS `tournament_players`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_players` (
  `tournament_players_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) NOT NULL,
  `user_login_id` varchar(175) NOT NULL,
  `userHandle` varchar(75) DEFAULT NULL,
  `clubID` int(11) DEFAULT '9',
  `firstName` varchar(100) NOT NULL,
  `lastName` varchar(100) NOT NULL,
  `email_Address` varchar(100) NOT NULL,
  `totalScore` int(4) NOT NULL DEFAULT '0',
  `user_confirmed` enum('yes','no') NOT NULL DEFAULT 'no',
  `dateRegistered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `playerAssigned` enum('yes','no') NOT NULL DEFAULT 'no',
  PRIMARY KEY (`tournament_players_id`)
) ENGINE=InnoDB AUTO_INCREMENT=247 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_players`
--

LOCK TABLES `tournament_players` WRITE;
/*!40000 ALTER TABLE `tournament_players` DISABLE KEYS */;
INSERT INTO `tournament_players` VALUES (2,18,'6','hyberion',6,'Brad','Haarer','hyberion@yahoo.com',1514,'yes','2015-08-05 17:30:21','no'),(3,18,'2','TheDude',0,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-05 23:00:53','no'),(4,18,'12','theJoe',NULL,'Joe','Rossow','hazard.rossow@gmail.com',0,'yes','2015-08-05 23:02:45','no'),(6,18,'4','zdizzle6717',NULL,'Zack','Anselm','zanselm5@gmail.com',0,'yes','2015-08-05 23:38:26','no'),(7,19,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',2610,'yes','2015-08-08 03:55:17','no'),(13,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:38:21','no'),(14,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:38:36','no'),(15,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:38:48','no'),(16,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:39:08','no'),(17,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:39:17','no'),(18,20,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-14 23:41:50','no'),(19,19,'6','hyberion',NULL,'Brad','Haarer','hyberion@yahoo.com',1640,'yes','2015-08-16 01:12:15','no'),(20,22,'13','',NULL,'Frankie','Giampapa','orders@FrontlineGaming.org',0,'yes','2015-08-20 18:42:41','no'),(21,22,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-08-20 19:47:23','no'),(22,22,'6','hyberion',NULL,'Brad','Haarer','hyberion@yahoo.com',0,'yes','2015-08-20 20:56:08','no'),(23,6,'925','arcu. Sed',NULL,'Eaton','Byrd','dictum.cursus@Aliquam.edu',0,'no','2015-08-20 21:02:59','no'),(24,22,'905','lacus vestibulum',NULL,'Joan','Reed','erat@inceptoshymenaeos.net',0,'no','2015-08-20 21:02:59','no'),(25,22,'918','blandit congue.',NULL,'Plato','Hurley','tincidunt.vehicula@utaliquam.co.uk',0,'no','2015-08-20 21:02:59','no'),(26,22,'909','facilisi. Sed',NULL,'Dennis','Hancock','nunc.Quisque.ornare@sitametante.edu',0,'no','2015-08-20 21:02:59','no'),(27,22,'901','odio. Nam',NULL,'Kalia','Reid','vel.arcu@velsapienimperdiet.net',0,'no','2015-08-20 21:02:59','no'),(28,22,'873','massa. Quisque',NULL,'Nelle','Richmond','Donec@milaciniamattis.co.uk',0,'no','2015-08-20 21:02:59','no'),(29,22,'889','lorem ipsum',NULL,'Shea','Christian','ligula.Aenean.gravida@risusDonecnibh.edu',0,'no','2015-08-20 21:02:59','no'),(30,22,'881','eu metus.',NULL,'Aidan','Pate','est@Fusce.edu',0,'no','2015-08-20 21:02:59','no'),(31,22,'915','vel pede',NULL,'Branden','Bennett','semper.dui@orciquislectus.edu',0,'no','2015-08-20 21:02:59','no'),(32,22,'864','eu arcu.',NULL,'Aurora','Flowers','erat@vestibulumMaurismagna.co.uk',0,'no','2015-08-20 21:02:59','no'),(33,6,'892','aliquet lobortis,',NULL,'Roary','Vasquez','tincidunt.aliquam@feugiat.edu',0,'no','2015-08-20 21:02:59','no'),(34,6,'871','amet orci.',NULL,'Arden','Hansen','sit@Suspendisse.edu',0,'no','2015-08-20 21:02:59','no'),(35,6,'924','sed consequat',NULL,'Jeanette','Austin','morbi.tristique@aptenttaciti.co.uk',0,'no','2015-08-20 21:02:59','no'),(36,6,'916','in, hendrerit',NULL,'Hunter','Alston','nec.mauris@tincidunt.net',0,'no','2015-08-20 21:02:59','no'),(37,6,'877','lectus quis',NULL,'Brynne','Livingston','risus@liberoMorbi.com',0,'no','2015-08-20 21:02:59','no'),(38,6,'878','lectus. Nullam',NULL,'Orlando','Ewing','natoque.penatibus.et@magnaNam.net',0,'no','2015-08-20 21:02:59','no'),(39,6,'925','eleifend non,',NULL,'Lareina','Mckee','mollis.non.cursus@eleifendnunc.ca',0,'no','2015-08-20 21:02:59','no'),(40,6,'862','lorem, auctor',NULL,'Abbot','Mckenzie','sagittis.augue.eu@tinciduntadipiscing.ca',0,'no','2015-08-20 21:02:59','no'),(41,6,'875','Donec fringilla.',NULL,'Colleen','Clark','egestas.a@loremvehiculaet.net',0,'no','2015-08-20 21:02:59','no'),(42,6,'883','dui augue',NULL,'Aiko','Sweeney','est.mollis.non@vulputate.ca',0,'no','2015-08-20 21:02:59','no'),(43,6,'906','nisi nibh',NULL,'Casey','Winters','Pellentesque@adipiscingMaurismolestie.ca',0,'no','2015-08-20 21:02:59','no'),(44,6,'867','blandit mattis.',NULL,'Kerry','Floyd','sed@eleifend.ca',0,'no','2015-08-20 21:02:59','no'),(45,6,'870','ut erat.',NULL,'Garrison','Britt','Cras.interdum.Nunc@acturpisegestas.ca',0,'no','2015-08-20 21:02:59','no'),(46,6,'897','vulputate, lacus.',NULL,'Rae','Clarke','orci@necleo.ca',0,'no','2015-08-20 21:02:59','no'),(47,6,'890','Etiam imperdiet',NULL,'Oprah','Harris','eget.magna.Suspendisse@Sed.edu',0,'no','2015-08-20 21:02:59','no'),(48,6,'885','ut, pharetra',NULL,'Wynter','Davenport','non.sapien@Duiscursusdiam.edu',0,'no','2015-08-20 21:02:59','no'),(49,6,'907','nunc risus',NULL,'Jerry','Hines','non@urnajustofaucibus.com',0,'no','2015-08-20 21:02:59','no'),(50,6,'883','orci, consectetuer',NULL,'Lance','Mcdonald','Curabitur@massaInteger.co.uk',0,'no','2015-08-20 21:02:59','no'),(51,6,'893','orci lacus',NULL,'Judith','Lynn','quam@disparturientmontes.ca',0,'no','2015-08-20 21:02:59','no'),(52,6,'879','Integer vulputate,',NULL,'Bevis','Sweeney','sociosqu.ad@egestasDuisac.edu',0,'no','2015-08-20 21:02:59','no'),(53,6,'891','lorem ut',NULL,'Angela','Logan','lobortis@feugiatplacerat.ca',0,'no','2015-08-20 21:02:59','no'),(54,6,'913','semper pretium',NULL,'Nevada','Powers','parturient.montes@leo.ca',0,'no','2015-08-20 21:02:59','no'),(55,6,'893','egestas. Fusce',NULL,'Buckminster','Vega','nonummy.ac.feugiat@accumsansedfacilisis.com',0,'no','2015-08-20 21:02:59','no'),(56,6,'880','nostra, per',NULL,'Isaiah','Terry','ac.tellus@metusAeneansed.edu',0,'no','2015-08-20 21:02:59','no'),(57,6,'869','in lobortis',NULL,'Brandon','Maynard','ipsum.dolor.sit@ornarelibero.com',0,'no','2015-08-20 21:02:59','no'),(58,6,'861','dictum augue',NULL,'Cain','Fulton','lobortis.mauris@Suspendissesed.ca',0,'no','2015-08-20 21:02:59','no'),(59,6,'875','nonummy ac,',NULL,'Lamar','Harrell','at@pedeSuspendisse.org',0,'no','2015-08-20 21:02:59','no'),(60,6,'918','vestibulum massa',NULL,'Baxter','Gates','quis.diam.Pellentesque@commodo.edu',0,'no','2015-08-20 21:02:59','no'),(61,6,'869','sem eget',NULL,'Emi','Valencia','Integer.aliquam.adipiscing@scelerisque.org',0,'no','2015-08-20 21:02:59','no'),(62,6,'928','ligula. Nullam',NULL,'Holly','Foley','semper.pretium.neque@at.org',0,'no','2015-08-20 21:02:59','no'),(63,6,'874','tellus lorem',NULL,'Virginia','Madden','vitae.odio@tempus.edu',0,'no','2015-08-20 21:02:59','no'),(64,6,'928','cubilia Curae;',NULL,'Amir','Solomon','cursus.Nunc.mauris@faucibus.com',0,'no','2015-08-20 21:02:59','no'),(65,6,'918','in sodales',NULL,'Finn','Boyd','convallis.in@Donectincidunt.net',0,'no','2015-08-20 21:02:59','no'),(66,6,'876','sociosqu ad',NULL,'Rudyard','Keith','mauris.Suspendisse@at.net',0,'no','2015-08-20 21:02:59','no'),(67,6,'897','augue ut',NULL,'Oscar','Wilder','Nam.ac.nulla@utcursus.edu',0,'no','2015-08-20 21:02:59','no'),(68,6,'875','nulla vulputate',NULL,'Claudia','Cooper','et.pede@adui.com',0,'no','2015-08-20 21:02:59','no'),(69,6,'904','amet, risus.',NULL,'Charissa','Harper','amet.ornare.lectus@Fusce.org',0,'no','2015-08-20 21:02:59','no'),(70,6,'902','Nunc mauris',NULL,'Sybil','Carlson','est@etliberoProin.net',0,'no','2015-08-20 21:02:59','no'),(71,6,'928','lobortis. Class',NULL,'Karyn','Mcguire','Fusce.mollis.Duis@vulputate.org',0,'no','2015-08-20 21:02:59','no'),(72,6,'928','eros turpis',NULL,'Iona','Franco','ac@habitantmorbitristique.org',0,'no','2015-08-20 21:02:59','no'),(73,6,'910','Curabitur vel',NULL,'Mufutau','Hill','ridiculus.mus.Proin@duinecurna.org',0,'no','2015-08-20 21:02:59','no'),(74,6,'906','Proin ultrices.',NULL,'Kamal','Nash','Duis.gravida@faucibus.net',0,'no','2015-08-20 21:02:59','no'),(75,6,'905','venenatis lacus.',NULL,'Ralph','Baker','Morbi.neque@interdumlibero.edu',0,'no','2015-08-20 21:02:59','no'),(76,6,'927','dui, in',NULL,'Aurora','Rowe','Aliquam.auctor.velit@facilisis.net',0,'no','2015-08-20 21:02:59','no'),(77,6,'906','vel turpis.',NULL,'Libby','Gill','aliquet.Proin@aliquam.ca',0,'no','2015-08-20 21:02:59','no'),(78,6,'871','in felis.',NULL,'Janna','Dotson','ultrices.Vivamus.rhoncus@turpisnonenim.org',0,'no','2015-08-20 21:02:59','no'),(79,6,'918','a, malesuada',NULL,'Gray','Gaines','aliquet.vel.vulputate@vestibulum.edu',0,'no','2015-08-20 21:02:59','no'),(80,6,'906','Suspendisse ac',NULL,'Ivy','Kirk','id@ullamcorper.net',0,'no','2015-08-20 21:02:59','no'),(81,6,'901','Cras lorem',NULL,'Hunter','Mayo','sit.amet@acmetusvitae.net',0,'no','2015-08-20 21:02:59','no'),(82,6,'866','egestas, urna',NULL,'Merrill','Kent','convallis@eu.org',0,'no','2015-08-20 21:02:59','no'),(83,6,'873','Praesent luctus.',NULL,'Jane','Stanton','Aliquam@enimEtiamimperdiet.org',0,'no','2015-08-20 21:02:59','no'),(84,6,'891','urna. Nunc',NULL,'Melanie','Levine','vitae.nibh.Donec@nislelementumpurus.com',0,'no','2015-08-20 21:02:59','no'),(85,6,'893','sapien. Aenean',NULL,'Matthew','Velazquez','dis.parturient@odio.org',0,'no','2015-08-20 21:02:59','no'),(86,6,'895','in lobortis',NULL,'Joan','Jacobson','Duis@leoin.com',0,'no','2015-08-20 21:02:59','no'),(87,6,'861','imperdiet dictum',NULL,'Rina','Talley','Mauris@Mauris.com',0,'no','2015-08-20 21:02:59','no'),(88,6,'898','hendrerit a,',NULL,'Tatum','Stafford','ac@tempusnonlacinia.ca',0,'no','2015-08-20 21:02:59','no'),(89,6,'908','ornare, elit',NULL,'Chelsea','Mccall','arcu@infaucibus.com',0,'no','2015-08-20 21:02:59','no'),(90,6,'905','natoque penatibus',NULL,'Hayley','Koch','nibh.vulputate.mauris@Sedmolestie.com',0,'no','2015-08-20 21:02:59','no'),(91,6,'915','vitae, orci.',NULL,'Sopoline','Bray','lacinia@posuerevulputate.co.uk',0,'no','2015-08-20 21:02:59','no'),(92,6,'873','eu nulla',NULL,'Brennan','Whitehead','lectus.pede@vulputate.co.uk',0,'no','2015-08-20 21:02:59','no'),(93,6,'885','leo, in',NULL,'Basil','Thompson','lacus.Etiam.bibendum@blanditNam.co.uk',0,'no','2015-08-20 21:02:59','no'),(94,6,'877','enim commodo',NULL,'Knox','Ware','Sed.et@Integereu.org',0,'no','2015-08-20 21:02:59','no'),(95,6,'860','a felis',NULL,'Kadeem','Waters','odio@ligula.ca',0,'no','2015-08-20 21:02:59','no'),(96,6,'884','pede et',NULL,'Gay','Aguirre','in@IncondimentumDonec.ca',0,'no','2015-08-20 21:02:59','no'),(97,6,'861','Curabitur massa.',NULL,'Elliott','Garza','conubia@Aliquamvulputate.edu',0,'no','2015-08-20 21:02:59','no'),(98,6,'917','Fusce mollis.',NULL,'Davis','Head','diam.luctus@quisurnaNunc.com',0,'no','2015-08-20 21:02:59','no'),(99,6,'923','ultricies ligula.',NULL,'Keaton','Eaton','lectus@purusinmolestie.ca',0,'no','2015-08-20 21:02:59','no'),(100,6,'916','scelerisque sed,',NULL,'Dustin','Meyer','ac@nulla.net',0,'no','2015-08-20 21:02:59','no'),(101,6,'877','Donec felis',NULL,'Avram','Patton','massa@leoelementum.com',0,'no','2015-08-20 21:02:59','no'),(102,6,'896','semper tellus',NULL,'Leigh','Cotton','turpis.Aliquam@dapibusgravidaAliquam.com',0,'no','2015-08-20 21:02:59','no'),(103,6,'884','posuere, enim',NULL,'Jonas','Ashley','Fusce@Integer.ca',0,'no','2015-08-20 21:02:59','no'),(104,6,'872','neque. Morbi',NULL,'Ruby','Shannon','nec.euismod@loremut.co.uk',0,'no','2015-08-20 21:02:59','no'),(105,6,'894','felis ullamcorper',NULL,'Halee','Bowman','mattis.semper.dui@urnaUt.edu',0,'no','2015-08-20 21:02:59','no'),(106,6,'873','iaculis quis,',NULL,'Ria','Rowland','adipiscing.lacus.Ut@vitaesodalesat.org',0,'no','2015-08-20 21:02:59','no'),(107,6,'903','eget tincidunt',NULL,'Allegra','Chapman','nulla@egestas.edu',0,'no','2015-08-20 21:02:59','no'),(108,6,'909','tincidunt dui',NULL,'Kamal','Browning','a@dapibusgravidaAliquam.edu',0,'no','2015-08-20 21:02:59','no'),(109,6,'904','adipiscing fringilla,',NULL,'Price','Peters','elit.erat.vitae@sed.edu',0,'no','2015-08-20 21:02:59','no'),(110,6,'915','accumsan interdum',NULL,'Kasper','Haney','mauris.ut@Sed.org',0,'no','2015-08-20 21:02:59','no'),(111,6,'865','magna et',NULL,'Candice','Sweeney','lacinia.Sed.congue@Quisqueliberolacus.edu',0,'no','2015-08-20 21:02:59','no'),(112,6,'901','iaculis enim,',NULL,'Herman','Morgan','Proin.velit@ligulaAliquam.org',0,'no','2015-08-20 21:02:59','no'),(113,6,'895','Quisque ornare',NULL,'Ignacia','Blevins','faucibus.orci@porttitor.org',0,'no','2015-08-20 21:02:59','no'),(114,6,'904','fames ac',NULL,'Hedley','Soto','facilisis.Suspendisse.commodo@egestashendreritneque.com',0,'no','2015-08-20 21:02:59','no'),(115,6,'913','cursus non,',NULL,'Ebony','Phelps','consequat@dictumultriciesligula.net',0,'no','2015-08-20 21:02:59','no'),(116,6,'875','egestas. Duis',NULL,'Shelly','Blankenship','amet.luctus.vulputate@vehicula.net',0,'no','2015-08-20 21:02:59','no'),(117,6,'894','diam. Pellentesque',NULL,'Xander','Simmons','diam.lorem.auctor@odioAliquam.co.uk',0,'no','2015-08-20 21:02:59','no'),(118,6,'907','Cum sociis',NULL,'Judah','Mathews','leo.elementum.sem@Nullamut.com',0,'no','2015-08-20 21:02:59','no'),(119,6,'908','Donec consectetuer',NULL,'Laith','Gonzalez','ut.dolor.dapibus@Curabitur.co.uk',0,'no','2015-08-20 21:02:59','no'),(120,6,'868','Duis a',NULL,'Rhiannon','Pitts','sagittis.Nullam.vitae@ultricesa.com',0,'no','2015-08-20 21:02:59','no'),(121,6,'913','blandit enim',NULL,'Chandler','Estes','id.mollis@tincidunttempus.ca',0,'no','2015-08-20 21:02:59','no'),(122,6,'861','et magnis',NULL,'Aurelia','Nicholson','at.pede.Cras@Donec.ca',0,'no','2015-08-20 21:02:59','no'),(123,23,'895','Quisque ornare',NULL,'Ignacia','Blevins','faucibus.orci@porttitor.org',1513,'yes','2015-08-21 02:02:59','no'),(124,23,'904','fames ac',NULL,'Hedley','Soto','facilisis.Suspendisse.commodo@egestashendreritneque.com',1508,'yes','2015-08-21 02:02:59','no'),(125,23,'913','cursus non,',NULL,'Ebony','Phelps','consequat@dictumultriciesligula.net',2022,'yes','2015-08-21 02:02:59','no'),(126,23,'875','egestas. Duis',NULL,'Shelly','Blankenship','amet.luctus.vulputate@vehicula.net',506,'yes','2015-08-21 02:02:59','no'),(127,23,'894','diam. Pellentesque',NULL,'Xander','Simmons','diam.lorem.auctor@odioAliquam.co.uk',2522,'yes','2015-08-21 02:02:59','no'),(128,23,'907','Cum sociis',NULL,'Judah','Mathews','leo.elementum.sem@Nullamut.com',1512,'yes','2015-08-21 02:02:59','no'),(129,23,'908','Donec consectetuer',NULL,'Laith','Gonzalez','ut.dolor.dapibus@Curabitur.co.uk',1513,'yes','2015-08-21 02:02:59','no'),(130,23,'868','Duis a',NULL,'Rhiannon','Pitts','sagittis.Nullam.vitae@ultricesa.com',2521,'yes','2015-08-21 02:02:59','no'),(131,23,'913','blandit enim',NULL,'Chandler','Estes','id.mollis@tincidunttempus.ca',5,'yes','2015-08-21 02:02:59','no'),(132,23,'861','et magnis',NULL,'Aurelia','Nicholson','at.pede.Cras@Donec.ca',1516,'yes','2015-08-21 02:02:59','no'),(134,21,'18','MK',NULL,'Dawson','Davis','ddavis620.dd@gmail.com',163,'yes','2015-08-30 16:13:52','no'),(135,21,'19','MysticMonk',NULL,'Scott','Anderson','scott.anderson1219@hotmail.com',149,'yes','2015-08-30 16:31:52','no'),(137,21,'20',' 	For The Greater Waaaghhh!!! 	',NULL,'Darren','Takemoto','onelung19@yahoo.com',122,'yes','2015-08-30 16:49:33','no'),(138,21,'22',' 	Pie is good.',NULL,'Willow Elizabeth','Ryder','LizRyder33@gmail.com',138,'yes','2015-08-30 16:50:04','no'),(140,21,'21','go big or go home',NULL,'brian','loyd','raftguidebrian@gmail.com',131,'yes','2015-08-30 16:50:52','no'),(142,21,'23','Death Company',NULL,'Daniel','Graf','daniel_graf@sbcglobal.net',138,'yes','2015-08-30 16:54:08','no'),(143,21,'26','Killing on 1\'s',NULL,'John','Dyer','Link123_2002@yahoo.com',142,'yes','2015-08-30 16:56:08','no'),(144,21,'27','Black Crusaders',NULL,'james','massey','Masshiro21@hotmail.com',111,'yes','2015-08-30 16:58:34','no'),(148,21,'25','Dirty Scots',NULL,'Rob','Probert','grunt3111998@yahoo.com',131,'yes','2015-08-30 17:02:06','no'),(149,21,'29','T3 Tantrum',NULL,'domenic','grove','Domenic.grove@yahoo.com',127,'yes','2015-08-30 17:03:30','no'),(150,21,'30','ZoomZoom',NULL,'Zoom','Zoom','tfaires66@gmail.com',146,'yes','2015-08-30 17:03:33','no'),(151,21,'28','The Burning Pickle',NULL,'Jason','Jiru','jasonjiru@comcast.net',132,'yes','2015-08-30 17:03:35','no'),(152,21,'31','Double Irish Arrangement',NULL,'Peter','Kelly','Petes97@gmail.com',128,'yes','2015-08-30 17:04:33','no'),(153,21,'32','Douche  bags \"R\" us',NULL,'Garye','Lawrence','Cpcarrot@aol.com',152,'yes','2015-08-30 17:05:45','no'),(156,21,'33','Ascension by means of Red Wings',NULL,'Cody','Marcu','codymarcu@gmail.com',122,'yes','2015-08-30 17:06:43','no'),(157,21,'34','For the greater Reannimation!',NULL,'Anthony','Villa ','Anthonyvilla1986@yahoo.com',129,'yes','2015-08-30 17:10:38','no'),(158,21,'35','White blood',NULL,'Austin','Warner','Floydfos@hotmail.com',133,'yes','2015-08-30 17:18:13','no'),(159,21,'24','Black & Blue',NULL,'James','DeBenedetti','jamesd@surewest.net',137,'yes','2015-08-30 18:38:50','no'),(160,21,'36','Team Brohammer',NULL,'Peter','Stefancik','goaliebp34@yahoo.com',147,'yes','2015-08-30 18:44:20','no'),(161,21,'37','Pretty Rickey ',NULL,'Rickey ','lane','hill400@hotmail.com',106,'yes','2015-08-30 18:56:25','no'),(162,29,'6','hyberionb',NULL,'Bradley','Haarer','hyberion@yahoo.com',0,'yes','2015-09-04 13:55:54','no'),(163,29,'6','hyberionb',NULL,'Bradley','Haarer','hyberion@yahoo.com',0,'yes','2015-09-10 01:50:51','no'),(164,30,'39','Killing on 1s',NULL,'Austin','Bono','Number47@sbcglobal.net',0,'yes','2015-09-13 20:02:55','no'),(166,31,'6','hyberionb',NULL,'Bradley','Haarer','hyberion@yahoo.com',20,'yes','2015-09-18 21:19:34','no'),(167,31,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',36,'yes','2015-09-18 22:41:07','no'),(168,31,'42','POne',NULL,'Player','One','player1@battlecomm.com',10,'yes','2015-09-18 23:45:48','no'),(169,31,'43','PTwo',NULL,'Player','Two','player2@battlecomm.com',28,'yes','2015-09-18 23:46:30','no'),(170,29,'4','zdizzle6717',NULL,'Zack','Anselm','zanselm5@gmail.com',0,'yes','2015-09-23 20:28:22','no'),(171,34,'10','DarkLink',9,'Gordon','Danke','gdanke88@hotmail.com',1011,'yes','2015-09-26 17:46:05','no'),(172,34,'44','Tee Dee',9,'Timothy','Dierdorff ','Lozengy@yahoo.com',0,'yes','2015-09-26 17:46:31','no'),(173,34,'46','TheBrandonOne',9,'Brandon','Killmeyer','n3obud@gmail.com',1011,'yes','2015-09-26 17:47:43','no'),(175,34,'26','Ascension ',9,'John','Dyer','Link123_2002@yahoo.com',0,'yes','2015-09-26 17:48:53','no'),(178,34,'33','BAngels Player to lose',9,'Cody','Marcu','codymarcu@gmail.com',0,'yes','2015-09-26 17:53:06','no'),(179,34,'48','Brett',9,'Brett','Coker','brettcoker@hotmail.com',0,'yes','2015-09-26 17:55:05','no'),(180,34,'45','Aftotheb',9,'Anthony','Barajas','aftotheb@gmail.com',0,'yes','2015-09-26 18:08:24','no'),(181,34,'45','Aftotheb',9,'Anthony','Barajas','aftotheb@gmail.com',0,'yes','2015-09-26 18:08:35','no'),(182,34,'45','Aftotheb',9,'Anthony','Barajas','aftotheb@gmail.com',0,'yes','2015-09-26 18:08:49','no'),(183,34,'49','NoahSmall83',9,'Noah','Small','sgtsmall83@gmail.com',502,'yes','2015-09-26 18:25:40','no'),(184,34,'47','Trev',9,'Trevor','Van Cleave','Bishop.tmvc@gmail.com',1011,'yes','2015-09-26 18:32:02','no'),(185,34,'2','TheDude',9,'Bryce','Nelson','bnelson@battle-comm.com',1,'yes','2015-09-26 18:42:04','no'),(186,34,'10','DarkLink',9,'Gordon','Danke','gdanke88@hotmail.com',0,'yes','2015-09-26 19:04:16','no'),(187,36,'10','DarkLink',9,'Gordon','Danke','gdanke88@hotmail.com',0,'yes','2015-10-04 16:07:05','no'),(188,36,'26','Ascension ',9,'John','Dyer','Link123_2002@yahoo.com',0,'yes','2015-10-04 16:14:38','no'),(189,36,'24','Black & Blue',9,'James','DeBenedetti','jamesd@surewest.net',0,'yes','2015-10-04 16:14:57','no'),(190,36,'52','Inferno',9,'Mike','Larson','Mlarson814@gmail.com',0,'yes','2015-10-04 16:15:37','no'),(191,36,'51','Tony myers',NULL,'Tony','Myers','Dayone916@outlook.com',0,'yes','2015-10-04 16:15:38','no'),(192,36,'53','Shayne ',NULL,'Shayne','Rucki','S.rucki@hotmail.com',0,'yes','2015-10-04 16:15:59','no'),(193,36,'56','Moriks',NULL,'Lucas','King','Darkslideman2002@yahoo.com',0,'yes','2015-10-04 16:16:17','no'),(194,36,'55','MadHatter',NULL,'Bill','Durrett','Sfwfwarfare@hotmail.com',0,'yes','2015-10-04 16:16:58','no'),(195,36,'57','Snow',NULL,'Austin','Brooks','Riskhalo@hotmail.com',1000,'yes','2015-10-04 16:17:04','no'),(197,36,'60','TheKing87',NULL,'placid','abono','placidabonojr87@gmail.com',0,'yes','2015-10-04 16:17:15','no'),(199,36,'63','General Oadius',NULL,'Mike','Oade','Oadius@gmail.com',0,'yes','2015-10-04 16:17:51','no'),(201,36,'35','White blood',NULL,'Austin','Warner','Floydfos@hotmail.com',0,'yes','2015-10-04 16:17:59','no'),(202,36,'64','Matt B',NULL,'Matt','Barlow','Mtzbk86@gmail.com',0,'yes','2015-10-04 16:18:05','no'),(203,36,'66','TheRastaRenegade ',NULL,'Nick','Hall','Nicholashall.marketing@gmail.com',0,'yes','2015-10-04 16:18:36','no'),(206,36,'65','Loyce8869',NULL,'Mike','Benton','loyce8869@gmail.com',0,'yes','2015-10-04 16:18:49','no'),(207,36,'59','Redfin',NULL,'Dante','DeBenedetti','danted@surewest.net',0,'yes','2015-10-04 16:18:53','no'),(208,36,'68','Ryan Creer',NULL,'Ryan','Creer','ryanisgreatftw123@hotmail.com',0,'yes','2015-10-04 16:18:54','no'),(209,36,'18','mk',NULL,'Dawson','Davis','ddavis620.dd@gmail.com',0,'yes','2015-10-04 16:19:13','no'),(211,36,'69','masos',NULL,'mason','vasquez','vasquez.mason@yahoo.com',0,'yes','2015-10-04 16:19:24','no'),(212,36,'70','White925',NULL,'Frankie ','Giampapa','Frontlinegamingorders@gmail.com',0,'yes','2015-10-04 16:19:48','no'),(213,36,'71','F0rkt',NULL,'Han','Rockhill','han_rockhill@hotmail.com',0,'yes','2015-10-04 16:20:18','no'),(214,36,'73','John bontadelli',NULL,'john','bontadelli','bontadellicharger@gmail.com',0,'yes','2015-10-04 16:21:20','no'),(215,36,'74','ARCTICSHARK',NULL,'Phil','Tracy','piptracy@yahoo.com',0,'yes','2015-10-04 16:21:53','no'),(216,36,'75','Whirlwind',NULL,'Anthony','','anthonydamore18@gmail.com',0,'yes','2015-10-04 16:22:19','no'),(217,36,'76','Nick bass',NULL,'Nick','Bass','Mikebprs@gmail.com',0,'yes','2015-10-04 16:23:53','no'),(218,36,'79','Rawdogger',NULL,'Jason','Butler','jasonbutler83@yahoo.com',0,'yes','2015-10-04 16:25:34','no'),(221,36,'62','Dustin',NULL,'Dustin ','Lane','Dustinlane62@yahoo.com',0,'yes','2015-10-04 16:25:44','no'),(222,36,'54','Phades',NULL,'Shawn','Moore','moore_sh@Hotmail.com',0,'yes','2015-10-04 16:28:06','no'),(223,36,'81','Casey',NULL,'cAsey','Herbst','Erekose42@att.net',0,'yes','2015-10-04 16:28:59','no'),(224,36,'44','Tee Dee',NULL,'Timothy','Dierdorff ','Lozengy@yahoo.com',0,'yes','2015-10-04 16:30:17','no'),(226,36,'82','Pierce',NULL,'Pierce','Dawson','Pierce.dawson@yahoo.com',0,'yes','2015-10-04 16:44:50','no'),(227,36,'83','DocDragon',NULL,'Doc','Glenboski','docdragonis@yahoo.com',0,'yes','2015-10-04 16:45:41','no'),(228,36,'2','TheDude',NULL,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-10-04 16:52:29','no'),(229,36,'58','Adrianmcp',NULL,'Adrian','Phillips','Adrianmcp@gmail.com',0,'yes','2015-10-04 16:56:06','no'),(234,36,'84','Joellucas13',NULL,'Joel','Lucas','Joellucas13@gmail.com',0,'yes','2015-10-04 17:01:14','no'),(235,36,'67','Oldschoolnate ',NULL,'Nathan','Creer','40knate@gmail.com',0,'yes','2015-10-04 17:44:51','no'),(236,34,'6','hyberion',6,'Bradley','Haarer','hyberion@yahoo.com',0,'yes','2015-10-11 15:51:49','no'),(237,37,'2','TheDude',9,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-10-17 23:22:05','no'),(238,37,'6','hyberion',9,'Bradley','Haarer','hyberion@yahoo.com',0,'yes','2015-10-18 01:10:28','no'),(239,38,'2','TheDude',6,'Bryce','Nelson','bnelson@battle-comm.com',0,'yes','2015-11-10 18:49:08','no'),(240,39,'2','TheDude',6,'Bryce','Nelson','bnelson@battle-comm.com',1,'yes','2015-11-12 19:59:31','no'),(241,39,'70','White925',10,'Frankie ','Giampapa','Frontlinegamingorders@gmail.com',1005,'yes','2015-11-12 20:16:26','no'),(242,40,'2','TheDude',6,'Bryce','Nelson','bnelson@battle-comm.com',3,'yes','2015-11-13 22:16:44','no'),(243,40,'70','White925',11,'Frankie ','Giampapa','Frontlinegamingorders@gmail.com',505,'yes','2015-11-13 22:16:55','no'),(244,43,'2','TheDude',12,'Bryce','Nelson','bnelson@battle-comm.com',1,'yes','2016-01-03 20:27:18','no'),(245,43,'92','Chadimus',20,'Chad','Thornton','4122423@gmail.com',1009,'yes','2016-01-03 20:28:36','no'),(246,45,'93','Torpored',16,'Josh','Rosenstein','Torpored@yahoo.com',0,'yes','2016-01-07 03:41:28','no');
/*!40000 ALTER TABLE `tournament_players` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_rounds`
--

DROP TABLE IF EXISTS `tournament_rounds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_rounds` (
  `rounds_id` int(11) NOT NULL AUTO_INCREMENT,
  `tournament_id` int(11) DEFAULT NULL,
  `adminName` varchar(100) NOT NULL,
  `Round_Title` varchar(244) DEFAULT NULL,
  `startTime` time DEFAULT NULL,
  `endTime` time DEFAULT NULL,
  `num_participants` int(8) DEFAULT NULL,
  `games_id` int(11) DEFAULT NULL,
  `games_title` varchar(100) DEFAULT NULL,
  `notes_rules_changes` mediumtext,
  PRIMARY KEY (`rounds_id`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_rounds`
--

LOCK TABLES `tournament_rounds` WRITE;
/*!40000 ALTER TABLE `tournament_rounds` DISABLE KEYS */;
INSERT INTO `tournament_rounds` VALUES (1,0,'','','03:30:24','03:30:24',0,0,'9',''),(2,11,'Simon','Morning','08:00:00','09:30:00',2,9,'9',''),(3,12,'bryce','One','09:00:00','11:00:00',25,9,'9',''),(4,12,'bryce','Two','12:00:00','02:00:00',25,9,'9',''),(5,12,'bryce','Three','02:15:00','04:15:00',25,9,'9',''),(6,13,'zdizzle6717','Starchild','12:00:00','06:23:00',10,12,'12','Begin!'),(7,13,'zdizzle6717','Learn the Game','03:03:00','06:23:00',5,12,'12','Begin!'),(8,14,'Brad','This Round','08:00:00','09:00:00',8,9,'9','All conversations must be phrased in the pat tense.'),(9,14,'Brad','That Round','10:00:00','11:00:00',8,9,'9','All conversations must be phrased in the like the Sweedish Chef.'),(11,14,'Brad','Other Round','01:00:00','02:00:00',8,9,'9','All players must wear silly hats.'),(12,14,'','Round And','12:00:00','06:00:00',8,9,'9',''),(13,14,'','Round And','12:00:00','06:00:00',8,9,'9',''),(14,14,'','r','02:00:00','11:00:00',8,9,'9',''),(15,14,'','r','02:00:00','11:00:00',8,9,'9',''),(16,14,'','r','02:00:00','11:00:00',8,9,'9',''),(17,14,'','r','02:00:00','11:00:00',8,9,'9',''),(18,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(19,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(20,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(21,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(22,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(23,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(24,13,'','ttt','12:00:00','12:00:00',0,12,'12',''),(25,10,'','www','12:00:00','12:00:00',4,44,'44',''),(26,10,'','www','12:00:00','12:00:00',4,44,'44',''),(31,16,'','3','04:00:00','06:30:00',2,9,'9','BAO Mission1'),(32,16,'','3','04:00:00','06:30:00',2,9,'9','BAO Mission2'),(33,16,'','3','04:00:00','06:30:00',2,9,'9','BAO Mission3'),(34,16,'','4','06:00:00','09:00:00',10,9,'9',''),(35,18,'','Game 1','10:30:00','01:00:00',20,9,'9',''),(36,18,'','Game 2','01:45:00','04:15:00',20,9,'9',''),(37,18,'','Game 3','04:45:00','07:15:00',20,9,'9',''),(38,19,'','Round 1','10:00:00','12:00:00',3,9,'9',''),(39,19,'','Round 2','01:00:00','03:00:00',3,9,'9',''),(40,19,'','Round 3','03:15:00','03:00:00',3,9,'9',''),(41,21,'','1','10:30:00','01:15:00',20,9,'9',''),(43,21,'','2','02:00:00','04:45:00',20,9,'9',''),(44,21,'','3','05:15:00','08:00:00',20,9,'9',''),(45,22,'','round 1','01:00:00','11:00:00',128,9,'9',''),(46,23,'','One','09:00:00','11:00:00',6,9,'9',''),(47,23,'','Two','12:00:00','02:00:00',6,9,'9',''),(48,23,'','Three','02:30:00','04:30:00',6,9,'9',''),(49,29,'','Test Round 1','04:30:00','06:00:00',1,16,'16',''),(50,30,'','Game 1','12:00:00','12:00:00',15,43,'43',''),(51,31,'','One','12:00:00','12:00:00',2,9,'9',''),(52,31,'','Two','05:00:00','08:00:00',2,9,'9',''),(53,31,'','Three','08:00:00','09:00:00',2,9,'9',''),(54,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(55,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(56,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(57,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(58,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(59,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(60,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(61,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(62,0,'','Round A','12:00:00','12:00:00',2,0,'',''),(63,29,'','Test Round 2','12:00:00','12:00:00',2,16,'16',''),(64,29,'','Test Round 3','12:00:00','12:00:00',2,16,'16',''),(65,34,'','1','10:30:00','01:30:00',20,9,'9',''),(66,34,'','2','02:15:00','05:15:00',20,9,'9',''),(70,36,'','Round 1','09:30:00','12:00:00',30,9,'9','Enter battle points under notes section when submitting score.'),(71,36,'','Round 2','12:45:00','03:15:00',30,9,'9','Enter battle points under notes section when submitting score.'),(72,36,'','Round 3','03:45:00','06:15:00',30,9,'9',''),(73,34,'','3','10:00:00','07:00:00',20,9,'9',''),(74,37,'','uno','12:00:00','12:00:00',500,9,'9',''),(75,38,'','one','12:00:00','12:00:00',100,9,'9',''),(76,38,'','two','02:00:00','04:30:00',100,9,'9',''),(77,38,'','three','04:45:00','07:15:00',100,9,'9',''),(78,39,'','one','12:00:00','12:00:00',1,9,'9',''),(79,39,'','two','12:00:00','12:00:00',1,9,'9',''),(80,39,'','three','12:00:00','12:00:00',1,9,'9',''),(81,40,'','round 1','12:00:00','02:00:00',180,9,'9',''),(82,0,'','round Alpha','02:00:00','04:00:00',25,0,'',''),(83,0,'','round Alpha','02:00:00','04:00:00',25,0,'',''),(84,0,'','round Alpha','02:00:00','04:00:00',25,0,'',''),(85,43,'','Alpha','01:00:00','03:30:00',25,9,'9',''),(86,44,'','uno','14:24:52','14:24:52',25,9,'9',''),(88,45,'','1st','10:00:00','12:30:00',25,9,'9',''),(89,45,'','2nd','13:00:00','03:30:00',25,9,'9',''),(90,45,'','3rd','16:00:00','06:30:00',25,9,'9',''),(91,45,'','4th','19:00:00','09:30:00',25,9,'9','');
/*!40000 ALTER TABLE `tournament_rounds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tournament_tiebreaker`
--

DROP TABLE IF EXISTS `tournament_tiebreaker`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tournament_tiebreaker` (
  `tourney_tiebreaker_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `match_id` int(11) unsigned NOT NULL,
  `Game Title` varchar(100) NOT NULL,
  `tiebreaker_name` varchar(200) NOT NULL,
  `tiebreaker_conditions` mediumtext NOT NULL,
  `point_value` int(8) unsigned NOT NULL,
  PRIMARY KEY (`tourney_tiebreaker_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tournament_tiebreaker`
--

LOCK TABLES `tournament_tiebreaker` WRITE;
/*!40000 ALTER TABLE `tournament_tiebreaker` DISABLE KEYS */;
INSERT INTO `tournament_tiebreaker` VALUES (3,0,'','Frontline Mission 1 Primary','Modified Emperor\'s Will:4 Mission Points if achieved, 0 pts if lost or tied.',4),(4,0,'','Frontline Mission 1 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if lost or tied. At the beginning\r\n\r\nof each GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note the result below. At \r\n\r\nthe end of each GAME TURN, each player earns 1 pt per Maelstrom Mission achieved (Note, if you roll both Destroy an Enemy Unit objectives, \r\n\r\ndestroying 1 unit earns you 1pt, destroying 2 units earns you 2pts). The player with the most points at the end of the game wins this mission.\r\n\r\n1. Hold Maelstrom Objective 1\r\n\r\n2. Hold Maelstrom Objective 2\r\n\r\n3. Have a scoring unit at least partially within the enemy deployment zone.\r\n\r\n4. Destroy an Enemy Unit\r\n\r\n5. Destroy an Enemy Unit\r\n\r\n6. Have at least 3 of your and none of your opponent\'s scoring units in your deployment zone.',4),(5,0,'','Frontline Mission 2 Primary','Purge the Alien: 4 Mission Points if achieved, 0 pts if lost or tied.',4),(6,0,'','Frontline Mission 2 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if lost or tied. At the beginning of\r\n\r\neach GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note the result below. At the \r\n\r\nend of each GAME TURN, each player earns 1 pt per Maelstrom Mission achieved. The player with the most points at the end of the game wins \r\n\r\n1. Hold Objective 1\r\n\r\n2. Hold Objective 2\r\n\r\n3. Hold Objective 3\r\n\r\n4. Have more scoring units at least partially further than 12\" from your deployment table edge \r\n\r\nthan your opponent.\r\n\r\n5. Have a scoring unit at least partially within 12\" of opponent\'s deployment edge.\r\n\r\n6. Have 3 of your own and no enemy scoring units at least partially within 12\" of your deployment \r\n\r\nedge.',4),(7,0,'','Frontline Mission 3 Primary','The Relic: 4 Mission Points if achieved, 0 pts if lost or tied.',4),(8,0,'','Frontline Mission 3 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if lost or tied. At the beginning of\r\n\r\neach GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note the result below. At the \r\n\r\nend of each GAME TURN, each player earns 1 pt per Maelstrom Mission achieved (Note, if you roll both Destroy an Enemy Unit objectives, \r\n\r\ndestroying 1 unit earns you 1pt, destroying 2 units earns you 2pts). The player with the most points at the end of the game wins this mission.\r\n\r\n1. Hold Maelstrom Objective 1\r\n\r\n2. Hold Maelstrom Objective 2\r\n\r\n3. Destroy an enemy unit.\r\n\r\n4. Destroy an enemy unit.\r\n\r\n5. Have a scoring unit at least partially within the enemy deployment zone.\r\n\r\n6. Have at least 3 of your scoring units and no enemy scoring units at least partially within your \r\n\r\ndeployment zone.',4),(9,0,'','Frontline Mission 4 Primary','The Scouring: 4 Mission Points if achieved, 0 pts if lost or tied.',4),(10,0,'','Frontline Mission 4 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if lost or tied. At the beginning of\r\n\r\neach GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note the result below. At the \r\n\r\nend of each GAME TURN, each player earns 1 pt per Maelstrom Mission achieved (Note, if you roll both Destroy an Enemy Unit objectives, \r\n\r\ndestroying 1 unit earns you 1pt, destroying 2 units earns you 2pts). The player with the most points at the end of the game wins this mission.\r\n\r\n1. Hold Either Objective 1\r\n\r\n2. Hold Either Objective 2\r\n\r\n3. Hold Either Objective 3\r\n\r\n4. Destroy an enemy unit.\r\n\r\n5. Destroy an enemy unit.\r\n\r\n6. Destroy an enemy unit.',4),(11,0,'','Frontline Mission 5 Primary','Big Guns Never Tire: 4 Mission Points if achieved, 0 pts if lost or tied.',4),(12,0,'','Frontline Mission 5 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if    lost or tied. At the beginning of\r\n\r\neach GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note   the result below. At the \r\n\r\nend of each GAME TURN, each player earns 1 pt per Maelstrom   Mission achieved (Note, if you roll both Destroy an Enemy Unit objectives, \r\n\r\ndestroying 1 unit earns you 1pt, destroying 2 units earns you 2pts). The player with the most points at the end of the game wins this mission.\r\n\r\n1. Hold Objective 1 in the enemy deployment zone.\r\n\r\n2. Hold Objective 2 in the enemy deployment zone.\r\n\r\n3. Hold Objective 1 in your deployment zone.\r\n\r\n4. Hold Objective 2 in your deployment zone.\r\n\r\n5. Destroy an enemy unit.\r\n\r\n6. Destroy an enemy unit.',4),(13,0,'','Frontline Mission 6 Primary','Crusade: 4 Mission Points if achieved, 0 pts if lost or tied.',4),(14,0,'','Frontline Mission 6 Secondary','Modified Maelstrom: 4 Mission Points if achieved, 0 pts if    lost or tied. At the beginning of\r\n\r\neach GAME TURN, both players roll twice on this table. Reroll the second roll if it is the same number as the first. Note   the result below. At the \r\n\r\nend of each GAME TURN, each player earns 1 pt per Maelstrom   Mission achieved (Note, if you roll both Destroy an Enemy Unit objectives, \r\n\r\ndestroying 1 unit earns you 1pt, destroying 2 units earns you 2pts). The player with the most points at the end of the game wins this mission.\r\n\r\n1. Hold Either Objective 1\r\n\r\n2. Hold Either Objective 2\r\n\r\n3. Destroy an enemy unit.\r\n\r\n4. Destroy an enemy unit.\r\n\r\n5. Have a scoring unit at least partially within the enemy    deployment zone.\r\n\r\n6. Have at least 3 of your scoring units and no enemy scoring units at least partially within your own deployment zone.',4),(15,0,'','First Blood','Per the BRB',1),(16,0,'','Linebreaker','Per the BRB',1),(17,0,'','Slay the Warlord','Per the BRB',1),(18,0,'','Big Game Hunter',' At the end of the game, of all destroyed units, the player that destroyed the unit worth the most points wins this point. \r\n\r\nâ—¦Note: Independent Characters counts as their own unit,         regardless of whether they are in another unit or not.\r\n\r\nâ—¦Note: Combat Squads of Marines count as a two units, each worth half the total cost of the unit.\r\n',1),(19,0,'','First Strike','A player earns this point if they destroy an enemy unit in the  first game turn. \r\n\r\nâ—¦Note: Both players can earn this point.\r\n',1),(20,0,'','Table Quarters','The player with the most scoring or denial units that are more  than 50% in a table quarter controls that quarter. The player   that controls the most table quarters wins this point. \r\n\r\nâ—¦Note: Independent Characters only count as a point for this    objective if they are not in a unit.\r\n\r\nâ—¦Note: Units in a transport do not count towards this objective unless they are disembarked from their transport.\r\n',1),(21,0,'','King of the Hill','The player with the most scoring or denial units at least       partially within 6â€³ of the center point of the table wins this  point. \r\n\r\nâ—¦Note: Independent Characters only count as a point for  this   objective if they are not in a unit.\r\n\r\nâ—¦Note: Units in a transport do not count towards this objective unless they are disembarked from their transport.\r\n',1),(22,0,'','Ground Control','Control or contest two or more objectives at the end of the game to achieve this point.',1),(23,0,'','40k Twin Linked Red Scenario','Complete Red Scenario Card',3),(24,0,'','40k Twin Linked Blue Scenario','Complete Blue Scenario',1),(25,0,'','40k Twin Linked Green Scenario','Complete Green Scenario',1),(26,0,'','Extreme','Opponent scores 0-8 points',4),(27,0,'','Major','Opponent Scores 9-12 points',3),(28,0,'','Minor','Opponent Scores 13+ points',2),(29,0,'','Insignificant','Win by tie breaker',1);
/*!40000 ALTER TABLE `tournament_tiebreaker` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tourney_admin`
--

DROP TABLE IF EXISTS `tourney_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tourney_admin` (
  `UserID` int(11) NOT NULL AUTO_INCREMENT,
  `UserEmail` varchar(500) DEFAULT NULL,
  `UserPassword` varchar(500) DEFAULT NULL,
  `UserFirstName` varchar(50) DEFAULT NULL,
  `UserLastName` varchar(50) DEFAULT NULL,
  `UserCity` varchar(90) DEFAULT NULL,
  `UserState` varchar(50) DEFAULT NULL,
  `UserZip` varchar(12) DEFAULT NULL,
  `UserEmailVerified` tinyint(1) DEFAULT '0',
  `UserRegistrationDate` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `UserVerificationCode` varchar(20) DEFAULT NULL,
  `UserIP` varchar(50) DEFAULT NULL,
  `UserPhone` varchar(20) DEFAULT NULL,
  `UserFax` varchar(20) DEFAULT NULL,
  `UserCountry` varchar(20) DEFAULT NULL,
  `UserAddress` varchar(100) DEFAULT NULL,
  `UserAddress2` varchar(50) DEFAULT NULL,
  `UserGroupID` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tourney_admin`
--

LOCK TABLES `tourney_admin` WRITE;
/*!40000 ALTER TABLE `tourney_admin` DISABLE KEYS */;
INSERT INTO `tourney_admin` VALUES (1,'bnelson@battle-comm.com','f2195182a7391e5672f50c1976f56f6c','Bryce','Nelson',NULL,NULL,NULL,0,'2015-06-13 23:58:00',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1),(2,'bnelson@battle-comm.com','f2195182a7391e5672f50c1976f56f6c','Bryce','Nelson',NULL,NULL,NULL,0,'2015-06-14 00:01:34',NULL,NULL,NULL,NULL,NULL,NULL,NULL,1);
/*!40000 ALTER TABLE `tourney_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_account_status`
--

DROP TABLE IF EXISTS `user_account_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_account_status` (
  `iduser_account_stats` int(11) NOT NULL AUTO_INCREMENT,
  `user_account_status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser_account_stats`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_account_status`
--

LOCK TABLES `user_account_status` WRITE;
/*!40000 ALTER TABLE `user_account_status` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_account_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_icons`
--

DROP TABLE IF EXISTS `user_icons`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_icons` (
  `iduser_icons` int(11) NOT NULL AUTO_INCREMENT,
  `user_icon_filename` varchar(75) DEFAULT NULL,
  `user_icon_filetype` varchar(10) DEFAULT NULL,
  `user_icon_width` int(5) DEFAULT NULL,
  `user_icon_height` int(5) DEFAULT NULL,
  `iduser_profile` int(11) DEFAULT NULL,
  `user_icon_path` varchar(45) DEFAULT NULL,
  `user_icon_public` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`iduser_icons`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_icons`
--

LOCK TABLES `user_icons` WRITE;
/*!40000 ALTER TABLE `user_icons` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_icons` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_login`
--

DROP TABLE IF EXISTS `user_login`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_login` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `activation_key` varchar(50) NOT NULL,
  `activation_state` tinyint(1) NOT NULL DEFAULT '0',
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(75) NOT NULL,
  `join_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `tourneyAdmin` enum('yes','no') NOT NULL DEFAULT 'no',
  `EventAdmin` enum('yes','no') NOT NULL DEFAULT 'no',
  `NewsContributor` enum('yes','no') NOT NULL DEFAULT 'no',
  `venueAdmin` enum('yes','no') NOT NULL DEFAULT 'no',
  `clubAdmin` enum('yes','no') NOT NULL DEFAULT 'no',
  `siteAdmin` enum('yes','no') NOT NULL DEFAULT 'no',
  `user_handle` varchar(150) DEFAULT NULL,
  `user_club` int(11) DEFAULT '9',
  `user_main_phone` varchar(20) DEFAULT NULL,
  `user_mobile_phone` varchar(20) DEFAULT NULL,
  `user_work_phone` varchar(20) DEFAULT NULL,
  `user_street_address` varchar(45) DEFAULT NULL,
  `user_apt_suite` varchar(45) DEFAULT NULL,
  `user_city` varchar(45) DEFAULT NULL,
  `user_state` varchar(4) DEFAULT NULL,
  `user_zip` varchar(12) DEFAULT NULL,
  `user_Date_of_Birth` date DEFAULT NULL,
  `user_bio` mediumtext,
  `user_facebook` varchar(45) DEFAULT NULL,
  `user_twitter` varchar(45) DEFAULT NULL,
  `user_instagram` varchar(45) DEFAULT NULL,
  `user_google_plus` varchar(45) DEFAULT NULL,
  `user_youtube` varchar(45) DEFAULT NULL,
  `user_twitch` varchar(45) DEFAULT NULL,
  `user_website` varchar(45) DEFAULT NULL,
  `user_points` int(10) DEFAULT NULL,
  `user_visibility` enum('yes','no') DEFAULT NULL,
  `user_share_contact` enum('yes','no') DEFAULT NULL,
  `user_share_name` enum('yes','no') DEFAULT NULL,
  `user_share_status` enum('yes','no') DEFAULT NULL,
  `user_newsletter` enum('yes','no') DEFAULT NULL,
  `user_marketing` enum('yes','no') DEFAULT NULL,
  `user_sms` enum('yes','no') DEFAULT NULL,
  `user_allow_play` enum('yes','no') DEFAULT NULL,
  `user_icon` varchar(200) DEFAULT 'http://www.testbattlecomm.com/images/profile_image_default.png',
  `totalWins` int(4) DEFAULT '0',
  `totalLoss` int(4) DEFAULT '0',
  `totalDraw` int(4) DEFAULT '0',
  `totalPoints` int(4) DEFAULT NULL,
  `accountActive` enum('yes','no') NOT NULL,
  `createdAt` datetime NOT NULL,
  `updatedAt` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=96 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_login`
--

LOCK TABLES `user_login` WRITE;
/*!40000 ALTER TABLE `user_login` DISABLE KEYS */;
INSERT INTO `user_login` VALUES (1,'admin@admin.com','21232f297a57a5a743894a0e4a801fc3','',1,'','','2014-05-13 18:35:08','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(2,'bnelson@battle-comm.com','27451b54fc216218fba06cdbed54a804','IIym@vxpNY4o-!kn',1,'Bryce','Nelson','2015-07-20 21:56:10','yes','yes','yes','yes','yes','yes','TheDude',12,'','','','','','','CA','','1972-09-27','','','','','','','','',2255,'','','','','','','','','BComm_FBPortrait.png',2,0,0,1021,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(4,'zanselm5@gmail.com','dff31a66bae1ae1d59f4f1815bcbf6e9','N%%)lC!K.6r!lvLl',1,'Zack','Anselm','2015-07-21 01:08:33','yes','yes','yes','yes','yes','yes','zdizzle6717',7,'(555) 555-5555','(555) 555-5555','','','','','IN','47404','1992-05-22','','','twitter.com/zdizzle6717','instagram.com/treemachinerecs','','','','',4270,'','','','','','','','','profile.png',1,0,0,1011,'yes','0000-00-00 00:00:00','2016-08-20 02:05:47'),(5,'GordonDanke@gmail.com','11d3397978db8ed6f5b8ba362fffade6','@s,epJQyxly2Jdik',1,'Gordon','Danke','2015-07-21 01:18:39','no','no','no','no','no','no','DarkLink',NULL,'(530) 417-3399','(530) 417-3399','(530) 417-3399','3100 Countryside Drive','','Placerville','CA','1000000',NULL,'Awesome','','','','','','','',10000,'','','','','','','','',NULL,0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(6,'hyberion@yahoo.com','8bcf0edbba028630c711165ef42140e6','Is%PKaCOcbA,%Y:n',1,'Bradley','Haarer','2015-07-21 01:37:07','yes','yes','yes','yes','yes','yes','hyberion',9,'(555) 555-5555','(444) 444-4444','','','','Pembroke pInes','FL','33024',NULL,'','','','','','','','',100000,'','','','','','','','','20140921_111711_Android.jpg',0,1,0,-159,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(7,'biffster72@gmail.com','1cdf37bba33dfe55c439dcc661a278a9','3w-m5TEge$%30pXR',1,'Butt','Man','2015-07-21 17:07:45','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(8,'fake@fake.com','27451b54fc216218fba06cdbed54a804','!*-B_ByycXsOuop)',1,'Neal','Bob','2015-07-22 17:41:11','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(9,'nickv451@gmail.com','2ac9cb7dc02b3c0083eb70898e549b63','grj8vdli3dn#fJoc',1,'Nicolas','Vielleux','2015-07-23 00:52:24','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(10,'gdanke88@hotmail.com','11d3397978db8ed6f5b8ba362fffade6','BpH$Vz$_.!Sy*mrP',1,'Gordon','Danke','2015-07-23 02:10:09','no','no','no','no','no','no','DarkLink',16,'','','','','','','','',NULL,'','','','','','','','',0,'','','','','','','','','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(11,'Omegaprime69@Gmail.com','9a576d5552a2eb7aaa5d880613ea0a63','0w6JjKWP@_KP6CL7',1,'Omega','Prime','2015-07-23 17:00:37','yes','yes','no','no','no','no','Omegaprime',NULL,'(916) 915-2841','','(916) 927-0810','6970 Blackduck Way','','Sacramento','CA','95842','1969-02-28','','','','','','','','',0,'no','','','','','','','','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(12,'hazard.rossow@gmail.com','351f08dea1c650a9392c82922fb51bd1','wS!n;i0b18@!z2ag',1,'Joe','Rossow','2015-08-03 04:40:02','no','no','no','no','no','no','TheJoe',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,1,0,10,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(14,'phantasmagorium@gmail.com','331a844b4d31c058cbac464b3bbcf495','DEYIYfCnzg#OQ#:I',1,'Trevor','Bond','2015-08-21 01:37:42','no','no','no','no','no','no','Phantasmagorium',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(15,'Silenswc@gmail.com','e693b19897184998a260b7b9c7c4ac19','9qdKppujIU9mURE*',1,'Davidm','Shackelford','2015-08-25 23:38:43','no','no','no','no','no','no','Mnemonic',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(16,'darkangel0@hotmail.com','a85efafddac224c251579b10ca4ef9ac','e@tR)!ep1SHh_w9Q',1,'Joshua','Costanich','2015-08-26 00:25:02','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(17,'clubadmin@battlecomm.com','password!!','',1,'Club Admin','Test User','2015-08-30 03:38:08','no','no','no','no','yes','no','clubAdmin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(18,'ddavis620.dd@gmail.com','ce504ded3649ef95eff0d889f1337da7','e-G(6$f8#g_ejV^f',1,'Dawson','Davis','2015-08-30 16:10:56','no','no','no','no','no','no','mk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'Screenshot_2015-07-21-10-40-36.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(19,'scott.anderson1219@hotmail.com','248802a689c214eea625488377285f17','oY-HnF:i6fZT6f:n',1,'Scott','Anderson','2015-08-30 16:30:49','no','no','no','no','no','no','MysticMonk',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(20,'onelung19@yahoo.com','5c9e12db9dbf7f156eabfbafb9daf856','g:EvLCyh1my;!Pi)',1,'Darren','Takemoto','2015-08-30 16:47:47','no','no','no','no','no','no','For The Greater Waaaghhh!!!',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(21,'raftguidebrian@gmail.com','c1c8cf0724b53904a13544673da2cd44','KDEDhp_;(6dmtW,U',1,'brian','loyd','2015-08-30 16:48:53','no','no','no','no','no','no','go big or go home',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(22,'LizRyder33@gmail.com','29cbbb45dc4da832733cbb1849db6075','Ox9WgniW!9675oBm',1,'Willow Elizabeth','Ryder','2015-08-30 16:49:14','no','no','no','no','no','no','Pie is good.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(23,'daniel_graf@sbcglobal.net','17bcbd345bc13759f872909fb6384704','sd8Z#-_qo(E%PZY1',1,'Daniel','Graf','2015-08-30 16:52:00','no','no','no','no','no','no','Death Company',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(24,'jamesd@surewest.net','5e8ff9bf55ba3508199d22e984129be6','eeaSdd-VToCl2DQl',1,'James','DeBenedetti','2015-08-30 16:53:47','no','no','no','no','no','no','James D',NULL,'','','','','','','','',NULL,'','','','','','','','',0,'','','','','','','','','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(25,'grunt3111998@yahoo.com','e88e6e8a7f417a75981341ee8d442a4d','L1ir)9_tCY6vpXet',1,'Rob','Probert','2015-08-30 16:53:48','no','no','no','no','no','no','Dirty Scots',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(26,'Link123_2002@yahoo.com','0063ad13a5c538d561e5c2dc5f91e4ee',';UVQ_4o-Xi$$u%OY',1,'John','Dyer','2015-08-30 16:54:01','no','no','no','no','yes','no','Ascension ',13,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(27,'Masshiro21@hotmail.com','82a27ceb9b693b9415821070474fd24a','f)jWzSgZYrYuTqQ9',1,'james','massey','2015-08-30 16:57:38','no','no','no','no','no','no','Black Crusaders',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(28,'jasonjiru@comcast.net','88ced4d5becd7b2da6fe3279028e7e90','IanX8kpnS!z017)3',1,'Jason','Jiru','2015-08-30 17:00:53','no','no','no','no','no','no','The Burning Pickle',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(29,'Domenic.grove@yahoo.com','d016f8a4c09b8e3890630558864b500d','d^M%hLeQHwy0xuUZ',1,'domenic','grove','2015-08-30 17:01:11','no','no','no','no','no','no','T3 Tantrum',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(30,'tfaires66@gmail.com','c72389d0f8bbe83b396955a9617d307f','(kHg$fm96tPPZ#)A',1,'Zoom','Zoom','2015-08-30 17:02:07','no','no','no','no','no','no','ZoomZoom',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(31,'Petes97@gmail.com','0c3b68093008afecd3da01cc9bb61eda','j#abykm.nKaI2jIw',1,'Peter','Kelly','2015-08-30 17:02:08','no','no','no','no','no','no','Double Irish Arrangement',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(32,'Cpcarrot@aol.com','dd31f53dbe874268b48dd1884618a1dc','(TmMC8hyqux_rS9)',1,'Garye','Lawrence','2015-08-30 17:02:26','no','no','no','no','no','no','Douche  bags \"R\" us',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(33,'codymarcu@gmail.com','4f9d377ad25bc80153829f9715d3cd5b','-5YtmbV1_wpZt*hY',1,'Cody','Marcu','2015-08-30 17:04:50','no','no','no','no','no','no','BAngels Player to lose',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(34,'Anthonyvilla1986@yahoo.com','7153dc8ebc784e376226fedd843afa19','^EUIbl%Bd(W7S:$e',1,'Anthony','Villa ','2015-08-30 17:05:08','no','no','no','no','no','no','For the greater Reannimation!',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(35,'Floydfos@hotmail.com','60c7e8fb808977d80a74084ee645d358','%PNZt!lET_(p2YO$',1,'Austin','Warner','2015-08-30 17:16:46','no','no','no','no','no','no','Wolf Blood',NULL,'','','','','','','','',NULL,'','','','','','','','',0,'','','','','','','','','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(36,'goaliebp34@yahoo.com','f0f73c52c034227d1f042010be875df1','!nGW8WH.,Kd7rO,J',1,'Peter','Stefancik','2015-08-30 18:40:58','no','no','no','no','no','no','Team Brohammer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'image.jpg',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(37,'hill400@hotmail.com','185c8c30725b2d638a34b08ee005870c','68h)-Z3c9)koPLpp',1,'Rickey ','lane','2015-08-30 18:54:41','no','no','no','no','no','no','Pretty Rickey ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(38,'El_ravager@live.com','294db00805de7be081fec87f637eeb77','YcX.r@W84502te_%',1,'Justin','Takemoto','2015-08-30 20:31:34','no','no','no','no','no','no',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(39,'Number47@sbcglobal.net','0bc72a2e91e29d374599a0e2a8b69dee','hn1qCJHROEHOrQQ.',1,'Austin','Bono','2015-09-13 20:01:34','no','no','no','no','no','no','Aurelius47',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(41,'zack@lakhota.org','dff31a66bae1ae1d59f4f1815bcbf6e9','',1,'Zack','Anselm','2015-09-14 20:15:32','no','no','no','no','no','no','zanselm',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'zack.jpg',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(42,'player1@battlecomm.com','5f4dcc3b5aa765d61d8327deb882cf99','',1,'Player','One','2015-09-18 23:44:24','no','no','no','no','no','no','POne',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(43,'player2@battlecomm.com','5f4dcc3b5aa765d61d8327deb882cf99','',1,'Player','Two','2015-09-18 23:44:58','no','no','no','no','no','no','PTwo',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(44,'Lozengy@yahoo.com','5cffdf66839ca9abb520b0b5cff4f320','',1,'Timothy','Dierdorff ','2015-09-26 17:17:54','no','no','no','no','yes','no','Tee Dee',15,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(45,'aftotheb@gmail.com','a43220ee7e279d2c4b85802836de5e11','',1,'Anthony','Barajas','2015-09-26 17:23:41','no','no','no','no','no','no','Aftotheb',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(46,'n3obud@gmail.com','cbafd8d72b7f82ea30223834400b222d','',1,'Brandon','Killmeyer','2015-09-26 17:32:23','no','no','no','no','no','no','TheBrandonOne',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(47,'Bishop.tmvc@gmail.com','5fb237dff54ce078e61ad9686b5259e8','',1,'Trevor','Van Cleave','2015-09-26 17:33:10','no','no','no','no','no','no','Trev',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(48,'brettcoker@hotmail.com','786232df1351aca1a4a6f597c9503135','',1,'Brett','Coker','2015-09-26 17:39:41','no','no','no','no','no','no','Brett',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(49,'sgtsmall83@gmail.com','d6a6bc0db10694a2d90e3a69648f3a03','',1,'Noah','Small','2015-09-26 17:40:24','yes','no','no','no','no','no','NoahSmall83',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(50,'player3@battlecomm.com','5f4dcc3b5aa765d61d8327deb882cf99','',1,'Player','3','2015-09-27 17:15:37','no','no','no','no','no','no','Player 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(51,'Dayone916@outlook.com','77482f3c693d1c4601f82a52fde14708','',1,'Tony','Myers','2015-10-04 16:14:35','no','no','no','no','no','no','Tony myers',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(52,'Mlarson814@gmail.com','fdf50f40b095188140033f5533d9ca58','',1,'Mike','Larson','2015-10-04 16:14:38','no','no','no','no','no','no','Inferno',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(53,'S.rucki@hotmail.com','d67361d7b552b64c7e7285779f11a19c','',1,'Shayne','Rucki','2015-10-04 16:14:45','no','no','no','no','no','no','Shayne ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(54,'moore_sh@Hotmail.com','680c6a06ef8e3e615f54965da3267088','',1,'Shawn','Moore','2015-10-04 16:15:05','no','no','no','no','no','no','Phades',NULL,'','','','','','','CA','',NULL,'','','','','','','','',0,'','','','','','','','','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(55,'Sfwfwarfare@hotmail.com','826d420e0874b674148330b059592c0f','',1,'Bill','Durrett','2015-10-04 16:15:10','no','no','no','no','no','no','MadHatter',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(56,'Darkslideman2002@yahoo.com','c3ba9aa2557d0a7c728c67baf3110024','',1,'Lucas','King','2015-10-04 16:15:16','no','no','no','no','no','no','Moriks',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(57,'Riskhalo@hotmail.com','4a118db5cd128f7679a8d8048a393a6c','',1,'Austin','Brooks','2015-10-04 16:15:33','no','no','no','no','no','no','Snow',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(58,'Adrianmcp@gmail.com','34161dcdc220c69ce1a62b98bc75372b','',1,'Adrian','Phillips','2015-10-04 16:15:53','no','no','no','no','no','no','Adrianmcp',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(59,'danted@surewest.net','21105b3a350e4a25d17c496d8189cbfe','',1,'Dante','DeBenedetti','2015-10-04 16:15:53','no','no','no','no','no','no','Redfin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(60,'placidabonojr87@gmail.com','044f3a55e61753d4fb3d36c4f3dc98dc','',1,'placid','abono','2015-10-04 16:16:05','no','no','no','no','no','no','TheKing87',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(61,'Abohart@pathsolutions.com','38f5f51f3618ba71a6c5a7e0ca1f3a6b','',1,'Andy','Bohart','2015-10-04 16:16:13','no','no','no','no','no','no','Boski51',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(62,'Dustinlane62@yahoo.com','d45ab30c4a9ef22a1920b58722843eb2','',1,'Dustin ','Lane','2015-10-04 16:16:14','no','no','no','no','no','no','Dustin',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(63,'Oadius@gmail.com','21aa1b478efe826e7ea3d8727c67fa83','',1,'Mike','Oade','2015-10-04 16:17:02','no','no','no','no','yes','no','General Oadius',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(64,'Mtzbk86@gmail.com','d78f35d019adeec50ac767e737757e55','',1,'Matt','Barlow','2015-10-04 16:17:23','no','no','no','no','no','no','Matt B',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(65,'loyce8869@gmail.com','b1c25a1c58b7faaebd2fab6767336978','',1,'Mike','Benton','2015-10-04 16:17:53','no','no','no','no','no','no','Loyce8869',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(66,'Nicholashall.marketing@gmail.com','5b6cdd7a25b3395ccf0d56a5bbd48e2e','',1,'Nick','Hall','2015-10-04 16:17:53','no','no','no','no','no','no','TheRastaRenegade ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(67,'40knate@gmail.com','8289cad1845db6de3b406c8c477ca9f3','',1,'Nathan','Creer','2015-10-04 16:17:54','no','no','no','no','no','no','Oldschoolnate ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(68,'ryanisgreatftw123@hotmail.com','aef59580c883b15c09ea4ca3faa7a09b','',1,'Ryan','Creer','2015-10-04 16:18:04','no','no','no','no','no','no','Ryan Creer',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(69,'vasquez.mason@yahoo.com','2cf73e4620a2ed70ed8051b9d4cf7a8a','',1,'mason','vasquez','2015-10-04 16:18:38','no','no','no','no','no','no','masos',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(70,'Frontlinegamingorders@gmail.com','d6919e90f8e55fc227248be2d7d74182','',1,'Frankie ','Giampapa','2015-10-04 16:18:46','yes','yes','yes','yes','yes','yes','White925',11,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(71,'han_rockhill@hotmail.com','0656bd0df56f0135986b491f73dc3813','',1,'Han','Rockhill','2015-10-04 16:19:28','no','no','no','no','no','no','F0rkt',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(72,'Ajdimeola@yahoo.com','30110c60ecdaf3a999c89a8a9333d302','',1,'Anthony','DiMeola','2015-10-04 16:19:44','no','no','no','no','no','no','Anthony ',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(73,'bontadellicharger@gmail.com','b6350f75f35fbbec0bde57babfcfd58f','',1,'john','bontadelli','2015-10-04 16:20:18','no','no','no','no','no','no','John bontadelli',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(74,'piptracy@yahoo.com','1586e0732cd34baa4e57a15709641798','',1,'Phil','Tracy','2015-10-04 16:20:59','no','no','no','no','no','no','ARCTICSHARK',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(75,'anthonydamore18@gmail.com','5dd73caab889247a5ed45e41c1890a72','',1,'Anthony','','2015-10-04 16:21:37','no','no','no','no','no','no','Whirlwind',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(76,'Mikebprs@gmail.com','853835d1fef6140f4a6cc353e45c3c67','',1,'Nick','Bass','2015-10-04 16:22:07','no','no','no','no','no','no','Nick bass',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(77,'Bvizcarra88@gmail.com','f0100dba02ec2872ee407bf9eb794abe','',1,'Ben','Vizcarra','2015-10-04 16:23:05','no','no','no','no','no','no','DocTerror',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(78,'grover_72205@yahoo.com','5d47303ff77654f7a02a35b4dfe136a5','',1,'Grover','Shipman','2015-10-04 16:24:25','no','no','no','no','no','no','doktor_g',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(79,'jasonbutler83@yahoo.com','fa59ee6076f3c7514932b46f67c598c1','',1,'Jason','Butler','2015-10-04 16:24:38','no','no','no','no','no','no','Rawdogger',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(80,'Darkraptor42@yahoo.com','faa4da30b07365c04233369b37465b8a','',1,'Paul','McKelvey','2015-10-04 16:27:08','no','no','no','no','yes','no','Dark Raptor',14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(81,'Erekose42@att.net','211455c1c6bf5f0b92326e818d6597f1','',1,'cAsey','Herbst','2015-10-04 16:27:57','no','no','no','no','no','no','Casey',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(82,'Pierce.dawson@yahoo.com','4fd0dad5de41bfc585064ba69b07b110','',1,'Pierce','Dawson','2015-10-04 16:43:54','no','no','no','no','no','no','Pierce',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(83,'docdragonis@yahoo.com','b9620b819718382a01d4884e1570ec8b','',1,'Doc','Glenboski','2015-10-04 16:44:28','no','no','no','no','no','no','DocDragon',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(84,'Joellucas13@gmail.com','c3d5625475791c5654436b0cb4f1ff14','',1,'Joel','Lucas','2015-10-04 17:00:07','no','no','no','no','no','no','Joellucas13',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(85,'','','',0,'','','2015-11-02 05:55:26','no','no','no','no','no','no',NULL,6,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(86,'Rolgnek@yahoo.com','dc4d646756db6c898895ed68ffdd2c07','',1,'Steve','Sisk','2015-12-12 01:42:06','yes','no','no','no','yes','no','Rolgnek',16,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(87,'Julnlecs@gmail.com','23eb766cc6309e6dc30f687a8551036c','',1,'Julio','Rodriguez ','2015-12-12 18:17:47','no','no','no','no','yes','no','nWo_Julnlecs',9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(88,'madfjohn@gmail.com','0910d8bb8105a74c0a84347897aa060f','',1,'John','Johnston','2015-12-13 05:36:38','no','no','no','no','yes','no','MadFJohn',18,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(89,'gmulroney@gmail.com','ea1beffa5f1fba8f02c7e23facda2989','',1,'Garrett','Mulroney','2015-12-16 20:07:19','no','no','no','no','no','no','gmulroney',14,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(90,'Farzaddmd@gmail.com','c0d7cfa8c56d34734b9b186b474257e4','',1,'Farzad','Mehdipour','2015-12-16 21:42:46','no','no','no','no','yes','no','DasCamel',9,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(91,'Vincew@cityofclovis.com','c33a4bbf3da4f8d02c1cf9c216b555dd','',1,'Vince','Weibert','2015-12-16 22:29:26','no','no','no','no','no','no','Bigpig',17,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(92,'4122423@gmail.com','8000dd6811d71e3bedfe97c843e6ac3b','',1,'Chad','Thornton','2015-12-31 18:27:26','yes','no','no','no','no','no','Chadimus',20,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(93,'Torpored@yahoo.com','1994e7dca8167a4e68fa26b913346b62','',1,'Josh','Rosenstein','2016-01-07 03:39:56','no','no','no','no','no','no','Torpored',16,'','','','','','','CA','',NULL,'','','','','','','','',0,'','no','yes','yes','yes','no','no','yes','http://www.testbattlecomm.com/images/profile_image_default.png',0,0,0,NULL,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00'),(95,'test@gmail.com','dff31a66bae1ae1d59f4f1815bcbf6e9','N%%)lC!K.6r!lvLl',1,'Zack','Anselm','2015-07-21 01:08:33','yes','yes','yes','yes','yes','yes','zdizzle6717',7,'(555) 555-5555','(555) 555-5555','','','','','IN','47404','1992-05-22','','','twitter.com/zdizzle6717','instagram.com/treemachinerecs','','','','',10000,'','','','','','','','','profile.png',1,0,0,1011,'yes','0000-00-00 00:00:00','0000-00-00 00:00:00');
/*!40000 ALTER TABLE `user_login` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profile`
--

DROP TABLE IF EXISTS `user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profile` (
  `iduser_profile` int(11) NOT NULL AUTO_INCREMENT,
  `userID` int(11) NOT NULL,
  `user_handle` varchar(150) NOT NULL,
  `user_main_phone` varchar(20) DEFAULT NULL,
  `user_mobile_phone` varchar(20) DEFAULT NULL,
  `user_work_phone` varchar(20) DEFAULT NULL,
  `user_street_address` varchar(45) DEFAULT NULL,
  `user_apt_suite` varchar(10) DEFAULT NULL,
  `user_city` varchar(45) DEFAULT NULL,
  `user_zip` varchar(12) DEFAULT NULL,
  `user_dateJoined` date DEFAULT NULL,
  `user_birthday` date DEFAULT NULL,
  `user_bio` mediumtext,
  `user_facebook` varchar(45) DEFAULT NULL,
  `user_twitter` varchar(45) DEFAULT NULL,
  `user_instagram` varchar(45) DEFAULT NULL,
  `user_google_plus` varchar(45) DEFAULT NULL,
  `user_youtube` varchar(45) DEFAULT NULL,
  `user_twitch` varchar(45) DEFAULT NULL,
  `user_website` varchar(45) DEFAULT NULL,
  `user_internal_notes` mediumtext,
  `user_security_level` int(11) DEFAULT NULL,
  `user_points` int(10) unsigned DEFAULT NULL,
  `user_cash_value` float DEFAULT NULL,
  `user_visibility` int(11) DEFAULT NULL,
  `user_share_contact` tinyint(1) DEFAULT NULL,
  `user_share_social` tinyint(1) DEFAULT NULL,
  `user_share_name` tinyint(1) DEFAULT NULL,
  `user_share_status` tinyint(1) DEFAULT NULL,
  `user_newsletter` tinyint(1) DEFAULT NULL,
  `user_marketing` tinyint(1) DEFAULT NULL,
  `user_allow_sms` tinyint(1) DEFAULT NULL,
  `user_mobile_carrier` tinyint(1) DEFAULT NULL,
  `user_allow_play_requests` tinyint(1) DEFAULT NULL,
  `user_icon` varchar(175) NOT NULL,
  `totalWins` int(4) unsigned NOT NULL DEFAULT '0',
  `totalLoss` int(4) unsigned NOT NULL DEFAULT '0',
  `totalDraw` int(4) unsigned NOT NULL DEFAULT '0',
  `accountActive` enum('yes','no') DEFAULT 'yes',
  PRIMARY KEY (`iduser_profile`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profile`
--

LOCK TABLES `user_profile` WRITE;
/*!40000 ALTER TABLE `user_profile` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usergroups`
--

DROP TABLE IF EXISTS `usergroups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usergroups` (
  `UserGroupID` int(11) NOT NULL AUTO_INCREMENT,
  `UserGroup` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`UserGroupID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usergroups`
--

LOCK TABLES `usergroups` WRITE;
/*!40000 ALTER TABLE `usergroups` DISABLE KEYS */;
/*!40000 ALTER TABLE `usergroups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_assigned_permissions`
--

DROP TABLE IF EXISTS `users_assigned_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_assigned_permissions` (
  `assigned_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_login_id` int(11) unsigned NOT NULL,
  `permissions_id` int(11) unsigned NOT NULL,
  PRIMARY KEY (`assigned_id`),
  KEY `assigned_id` (`assigned_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_assigned_permissions`
--

LOCK TABLES `users_assigned_permissions` WRITE;
/*!40000 ALTER TABLE `users_assigned_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_assigned_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venue`
--

DROP TABLE IF EXISTS `venue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `venue` (
  `venue_id` int(11) NOT NULL AUTO_INCREMENT,
  `venue_Name` varchar(255) DEFAULT NULL,
  `venue_logo_icon` varchar(255) NOT NULL,
  `venue_Street_Address` varchar(255) NOT NULL,
  `venue_city` varchar(75) NOT NULL,
  `venue_state` varchar(3) NOT NULL,
  `venue_zip_cc_code` varchar(18) NOT NULL,
  `venue_phone` varchar(24) NOT NULL,
  `venue_fax` varchar(24) NOT NULL,
  `venue_email` varchar(255) NOT NULL,
  `venue_website` varchar(255) NOT NULL,
  `venue_facebook` varchar(150) NOT NULL,
  `venue_about` mediumtext NOT NULL,
  `venue_contact_name` varchar(255) NOT NULL,
  `venue_hours` text NOT NULL,
  `venue_notes` mediumtext NOT NULL,
  `venue_outriders` varchar(50) NOT NULL,
  `venue_player_capacity` varchar(100) NOT NULL,
  `venue_map_URL` varchar(255) NOT NULL,
  PRIMARY KEY (`venue_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venue`
--

LOCK TABLES `venue` WRITE;
/*!40000 ALTER TABLE `venue` DISABLE KEYS */;
INSERT INTO `venue` VALUES (2,'Great Escape Games','','1250 Howe Ave.','Sacramento','CA','95825','','','','','','','Gary Lane','','','','80',''),(3,'Past Present Future','ppfgames.png','5917 S University Drive','Davie','FL','33328','(954) 434-4822','','info@ppfcomics.com','http://www.ppfcomics.com/','https://www.facebook.com/FloridaSuperComics','<p><span style=\"font-size:20px\"><span style=\"font-size:28px\">PAST PRESENT FUTURE - SOUTH FLORIDAâ€™S PREMIER COMICS &amp; GAMING CHAIN</span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>For over 30 years, Past Present Future in has served customers from all parts of South Florida. We offer the latest comics and South Floridaâ€™s largest selection of quality Golden Age comics and Silver Age key issues. It doesnâ€™t stop there, as we also stock action figures, toys, Japanese snacks, Gundam kits and role-playing games as well as the hottest statues and collectible figures from Kotobukiya, Bowen Designs, and Sideshow Collectibles!</p>\r\n\r\n<p>&nbsp;</p>\r\n','','Open 7 Days, 10AM-9PM','','10','24','https://www.google.com/maps/place/Past+Present+Future/@26.0468584,-80.2528619,19.75z/data=!4m7!1m4!3m3!1s0x88d9a85e58096553:0xd0ade6fec96e5d46!2s5917+S+University+Dr,+Davie,+FL+33328!3b1!3m1!1s0x0000000000000000:0x0e1b6471138863a7'),(8,'Frontline Gaming','','700 Alhambra Ave. Ste 704','Martinez','CA','94553','','','','','','','','','','','300+',''),(9,'Otto\'s Video Games and More','','7701 White Lane.','Bakersfield','CA','93309','','','','','','','','','','','20','');
/*!40000 ALTER TABLE `venue` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-20 20:36:30
