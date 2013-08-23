-- MySQL dump 10.13  Distrib 5.5.31, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: sharetime
-- ------------------------------------------------------
-- Server version	5.5.31-0ubuntu0.12.04.2

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
-- Table structure for table `activities`
--

DROP TABLE IF EXISTS `activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `subject` varchar(300) NOT NULL,
  `profile` varchar(2000) DEFAULT NULL,
  `start_time` datetime DEFAULT NULL,
  `organizer_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `type` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activities`
--

LOCK TABLES `activities` WRITE;
/*!40000 ALTER TABLE `activities` DISABLE KEYS */;
INSERT INTO `activities` VALUES (1,'看电影','跟女朋友约会看电影',NULL,1,'2013-06-02 12:49:37',NULL),(2,'打dota','找人玩dota开黑店',NULL,1,'2013-06-29 06:15:39',NULL),(5,'看演唱会','跟一堆朋友一起去看谢霆锋演唱会',NULL,1,'2013-08-21 08:56:18',NULL),(6,'aaaa','',NULL,1,'2013-08-21 09:09:23',NULL),(7,'ffffff','',NULL,1,'2013-08-21 09:11:06',NULL),(8,'a','',NULL,1,'2013-08-21 09:11:16',NULL),(9,'a','',NULL,1,'2013-08-21 09:11:20',NULL),(10,'打牌','一起打牌赌钱',NULL,1,'2013-08-22 05:56:11',1),(11,'PHP技术分享','开讲座分享PHP技术','2013-08-22 15:32:20',2,'2013-08-22 07:32:20',5);
/*!40000 ALTER TABLE `activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` char(32) NOT NULL,
  `expire` int(11) DEFAULT NULL,
  `data` longblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('hbv6f5dcp1rvkq2n05jrtdoam5',1377247650,''),('iie3lk4gjv2jqk3q1b3hqhr5r5',1377239398,'Yii.CCaptchaAction.1641fc28.user.captcha|s:7:\"topzxum\";Yii.CCaptchaAction.1641fc28.user.captchacount|i:2;user|O:4:\"User\":14:{s:9:\"password2\";N;s:10:\"verifyCode\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"fate2013\";s:8:\"realname\";s:9:\"张凯宏\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";}s:23:\"\0CActiveRecord\0_related\";a:2:{s:7:\"profile\";O:11:\"UserProfile\":13:{s:5:\"image\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:8:\"portrait\";s:17:\"/images/fate.jpeg\";s:3:\"age\";s:2:\"28\";s:3:\"sex\";s:1:\"1\";}s:23:\"\0CActiveRecord\0_related\";a:0:{}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}s:12:\"related_acts\";a:1:{i:0;O:8:\"Activity\":12:{s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:7:{s:2:\"id\";s:1:\"1\";s:7:\"subject\";s:9:\"看电影\";s:7:\"profile\";s:27:\"跟女朋友约会看电影\";s:10:\"start_time\";N;s:8:\"end_time\";N;s:12:\"organizer_id\";s:1:\"1\";s:10:\"created_at\";s:19:\"2013-06-02 20:49:37\";}s:23:\"\0CActiveRecord\0_related\";a:1:{s:9:\"organizer\";O:4:\"User\":14:{s:9:\"password2\";N;s:10:\"verifyCode\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"fate2013\";s:8:\"realname\";s:9:\"张凯宏\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";}s:23:\"\0CActiveRecord\0_related\";a:1:{s:7:\"profile\";O:11:\"UserProfile\":13:{s:5:\"image\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:8:\"portrait\";s:17:\"/images/fate.jpeg\";s:3:\"age\";s:2:\"28\";s:3:\"sex\";s:1:\"1\";}s:23:\"\0CActiveRecord\0_related\";a:0:{}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}81057d4dfe8295c82d2f38af0b24400a__id|s:8:\"fate2013\";81057d4dfe8295c82d2f38af0b24400a__name|s:8:\"fate2013\";81057d4dfe8295c82d2f38af0b24400a__states|a:0:{}'),('j00m3h97vcjg7u0erj4t0hq993',1377247847,'Yii.CCaptchaAction.1641fc28.user.captcha|s:7:\"eikonuq\";Yii.CCaptchaAction.1641fc28.user.captchacount|i:3;user|O:4:\"User\":14:{s:9:\"password2\";N;s:10:\"verifyCode\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"fate2013\";s:8:\"realname\";s:9:\"张凯宏\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";}s:23:\"\0CActiveRecord\0_related\";a:2:{s:12:\"related_acts\";a:1:{i:0;O:8:\"Activity\":12:{s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:7:{s:2:\"id\";s:1:\"1\";s:7:\"subject\";s:9:\"看电影\";s:7:\"profile\";s:27:\"跟女朋友约会看电影\";s:10:\"start_time\";N;s:8:\"end_time\";N;s:12:\"organizer_id\";s:1:\"1\";s:10:\"created_at\";s:19:\"2013-06-02 20:49:37\";}s:23:\"\0CActiveRecord\0_related\";a:1:{s:9:\"organizer\";O:4:\"User\":14:{s:9:\"password2\";N;s:10:\"verifyCode\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:4:\"name\";s:8:\"fate2013\";s:8:\"realname\";s:9:\"张凯宏\";s:8:\"password\";s:32:\"e10adc3949ba59abbe56e057f20f883e\";}s:23:\"\0CActiveRecord\0_related\";a:1:{s:7:\"profile\";O:11:\"UserProfile\":13:{s:5:\"image\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:8:\"portrait\";s:17:\"/images/fate.jpeg\";s:3:\"age\";s:2:\"28\";s:3:\"sex\";s:1:\"1\";}s:23:\"\0CActiveRecord\0_related\";a:0:{}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:7:\"profile\";O:11:\"UserProfile\":13:{s:5:\"image\";N;s:18:\"\0CActiveRecord\0_md\";N;s:19:\"\0CActiveRecord\0_new\";b:0;s:26:\"\0CActiveRecord\0_attributes\";a:4:{s:2:\"id\";s:1:\"1\";s:8:\"portrait\";s:17:\"/images/fate.jpeg\";s:3:\"age\";s:2:\"28\";s:3:\"sex\";s:1:\"1\";}s:23:\"\0CActiveRecord\0_related\";a:0:{}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}}s:17:\"\0CActiveRecord\0_c\";N;s:18:\"\0CActiveRecord\0_pk\";s:1:\"1\";s:21:\"\0CActiveRecord\0_alias\";s:1:\"t\";s:15:\"\0CModel\0_errors\";a:0:{}s:19:\"\0CModel\0_validators\";N;s:17:\"\0CModel\0_scenario\";s:6:\"update\";s:14:\"\0CComponent\0_e\";N;s:14:\"\0CComponent\0_m\";N;}81057d4dfe8295c82d2f38af0b24400a__id|s:8:\"fate2013\";81057d4dfe8295c82d2f38af0b24400a__name|s:8:\"fate2013\";81057d4dfe8295c82d2f38af0b24400a__states|a:0:{}');
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_activities`
--

DROP TABLE IF EXISTS `user_activities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `aid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_uid_aid` (`uid`,`aid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_activities`
--

LOCK TABLES `user_activities` WRITE;
/*!40000 ALTER TABLE `user_activities` DISABLE KEYS */;
INSERT INTO `user_activities` VALUES (2,1,1),(3,1,11),(4,2,1);
/*!40000 ALTER TABLE `user_activities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_profiles`
--

DROP TABLE IF EXISTS `user_profiles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `portrait` varchar(300) DEFAULT NULL,
  `age` smallint(6) DEFAULT NULL,
  `sex` tinyint(4) DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_profiles`
--

LOCK TABLES `user_profiles` WRITE;
/*!40000 ALTER TABLE `user_profiles` DISABLE KEYS */;
INSERT INTO `user_profiles` VALUES (1,'/images/fate.jpeg',26,0,'1987-10-13'),(2,'/images/收藏夹的添加修改删除.png',25,0,NULL),(8,'/images/收藏夹的添加修改删除.png',11,1,NULL),(9,NULL,11,0,NULL);
/*!40000 ALTER TABLE `user_profiles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `realname` varchar(20) DEFAULT NULL,
  `password` char(32) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'fate2013','张凯宏','e10adc3949ba59abbe56e057f20f883e'),(2,'zcc','庄翠翠','e10adc3949ba59abbe56e057f20f883e'),(3,'xtf','谢霆锋','e10adc3949ba59abbe56e057f20f883e'),(5,'halo',NULL,'e10adc3949ba59abbe56e057f20f883e'),(6,'haloo',NULL,'e10adc3949ba59abbe56e057f20f883e'),(7,'uuu',NULL,'e10adc3949ba59abbe56e057f20f883e'),(8,'ttt',NULL,'e10adc3949ba59abbe56e057f20f883e'),(9,'bbb',NULL,'698d51a19d8a121ce581499d7b701668');
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

-- Dump completed on 2013-08-22 16:51:30
