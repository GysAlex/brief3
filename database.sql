-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: gestion_projet
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

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
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin'),(2,'client');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login_time` datetime DEFAULT current_timestamp(),
  `logout_time` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `sessions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES (1,'2025-03-25 07:50:14','2025-03-25 07:58:23',1),(3,'2025-03-25 08:05:27','2025-03-25 08:06:28',1),(4,'2025-03-25 08:06:42',NULL,1);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status` enum('active','inactive') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `image` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role_id` (`role_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'alex','fokoalex5@gmail.com','$2y$10$U3LxXbDvrRLzgKbVWtHvueTohLEtfLx7yisiYnMpeqjRJwVMxKQcm',1,'active','2025-03-21 15:28:58','698bbe59db4c3e26bba9f8c8001d0c8a.jpeg'),(2,'Gyslain','alex@gmail.com','$2y$10$GACudELJoXFU7KzxJAFak.jbeFtMj5eCtkziPAfFkk2ADR59p2FDy',1,'active','2025-03-21 18:24:26',NULL),(17,'Odile','odile@gmail.com','$2y$10$I1rm3XfHpYRkZ88x2OY5Ne.yJ5sRQ0U8QyAvK/x04jRfUJNbZUE2W',1,'active','2025-03-24 15:51:51',NULL),(18,'Prof. Verner Kassulke Jr.','wintheiser.jenifer@yahoo.com','$2y$10$qZRVonPmkHzStkfZZiXktOrqgrfgu61noiytbMbPv4/EMKCIl9EeS',2,'active','2025-03-24 16:50:02',NULL),(19,'Dr. Quentin Roberts','claude.brown@satterfield.net','$2y$10$jtSgRe6sRMMBTGWcgIr5T.HtqELvJPmx46ZG3BtO3yd/KQ5y76SYG',2,'active','2025-03-24 16:50:02',NULL),(20,'Mavis Hansen III','tmorar@pollich.com','$2y$10$3GBwqFu.KPvgwjwos9iWt.l0SYRnz/reqmWR1gQ/2RqtbvsbwEIYq',2,'active','2025-03-24 16:50:03',NULL),(21,'Mr. Hudson Konopelski','emiliano16@yahoo.com','$2y$10$.szibBgIama5GHYaJB7ZHu/ryc8G3VOD7DKlpx7XwSdPoynYl23Na',2,'inactive','2025-03-24 16:50:03',NULL),(23,'Mr. Judah Buckridge','isabella63@gmail.com','$2y$10$raekFEXMHVF3UX8cpWrToOK4e1MLVaPYPGVR8.43pIK7S7wH/Ap8C',2,'active','2025-03-24 16:50:04',NULL),(24,'Ms. Yadira Stracke','lang.katelin@hotmail.com','$2y$10$Womx50tSpANqWtuhHJjkX.mp54w41Cpfm.LR9jhiyFTpo0.jGfs.m',2,'active','2025-03-24 16:50:04',NULL),(25,'Emmitt Bauch','dimitri.hane@yahoo.com','$2y$10$iGJCZCnCFaIt.cYMsFaxPer0M7eyAxLddHorXLqTIO3d8qrmAXeL6',2,'active','2025-03-24 16:50:04',NULL),(26,'Lera Romaguera IV','dion.okeefe@gmail.com','$2y$10$W4uFXhhCOQz4uhBvyLLhh..MLhrvJ9J12kMXjB9oOBDNupQmj36BW',2,'active','2025-03-24 16:50:04',NULL),(27,'Lauretta Blanda','rosalind.morissette@yahoo.com','$2y$10$oBMsuJ/H8W3JaKwtIJ7fzu0dtQbhaWVJXVz6Uk3voMLGeG/rhj3I6',2,'active','2025-03-24 16:50:05',NULL);
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

-- Dump completed on 2025-03-25  8:24:55
