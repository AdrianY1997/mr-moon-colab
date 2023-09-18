-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: mr_moon
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
-- Table structure for table `codes`
--

DROP TABLE IF EXISTS `codes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `codes` (
  `code_id` int(11) NOT NULL AUTO_INCREMENT,
  `code_email` varchar(255) DEFAULT NULL,
  `code_code` varchar(255) DEFAULT NULL,
  `code_status` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`code_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `codes`
--

LOCK TABLES `codes` WRITE;
/*!40000 ALTER TABLE `codes` DISABLE KEYS */;
/*!40000 ALTER TABLE `codes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `even_id` int(11) NOT NULL AUTO_INCREMENT,
  `even_name` varchar(255) DEFAULT NULL,
  `even_path` varchar(255) DEFAULT NULL,
  `even_text` varchar(255) DEFAULT NULL,
  `even_fech` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`even_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Bartender Invitado','img/eventos/bartender.jpg','En esta exclusiva velada, nuestro talentoso mixólogo compartirá sus conocimientos y técnicas innovadoras mientras prepara bebidas de autor impresionantes. Desde clásicos reinventados hasta creaciones vanguardistas, cada sorbo será una explosión de sabores','2023-07-18 11:03:26','2023-09-18 13:05:31','2023-09-18 13:05:31'),(2,'Noche de Karaoke','img/eventos/Karaoke.jpg','Ven y únete a la diversión mientras llenamos el escenario con cantantes de todas las edades y talentos. Desde baladas clásicas hasta éxitos actuales, hay algo para cada amante de la música.','2023-09-15 05:44:25','2023-09-18 13:05:31','2023-09-18 13:05:31'),(3,'Festividades','img/eventos/festividades.jpg','¡Celebremos juntos la magia de la temporada en nuestro espectacular evento de festividades Luces Brillantes y Alegría Festiva!','2023-12-24 12:00:00','2023-09-18 13:05:31','2023-09-18 13:05:31'),(4,'Noches de Trivia','img/eventos/20190820.png','¡Bienvenidos a nuestra emocionante Noche de Trivia: Desafía tu Conocimiento! Prepárate para poner a prueba tu mente y divertirte con amigos en una noche llena de preguntas intrigantes y respuestas sorprendentes.','2023-10-15 03:00:00','2023-09-18 13:05:31','2023-09-18 13:05:31');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `galerias`
--

DROP TABLE IF EXISTS `galerias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `galerias` (
  `gale_id` int(11) NOT NULL AUTO_INCREMENT,
  `gale_name` varchar(255) DEFAULT NULL,
  `gale_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`gale_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `galerias`
--

LOCK TABLES `galerias` WRITE;
/*!40000 ALTER TABLE `galerias` DISABLE KEYS */;
INSERT INTO `galerias` VALUES (1,'Galeria','img/gallery/home-event.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(2,'Galeria','img/gallery/home-drink.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(3,'Galeria','img/gallery/cafebar}.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(4,'Galeria','img/gallery/home-food.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(5,'Galeria','img/gallery/unnamed (1).png','2023-09-18 13:05:31','2023-09-18 13:05:31'),(6,'Galeria','img/gallery/granizado-de-cafe-2.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(7,'Galeria','img/gallery/unnamed (2).png','2023-09-18 13:05:31','2023-09-18 13:05:31'),(8,'Galeria','img/gallery/unnamed.png','2023-09-18 13:05:31','2023-09-18 13:05:31'),(9,'Galeria','img/gallery/unnamed (3).png','2023-09-18 13:05:31','2023-09-18 13:05:31'),(10,'Galeria','img/gallery/copteles.jpeg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(11,'Galeria','img/gallery/cockteleles-modernos.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(12,'Galeria','img/gallery/50caf20e7f61dbe6fd88d1d18af34420.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31');
/*!40000 ALTER TABLE `galerias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `menu_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(255) DEFAULT NULL,
  `menu_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (1,'Bebidas','img/menu/menu-bebidas.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(2,'Principal','img/menu/menu-principal.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31'),(3,'Comidas','img/menu/menu-comidas.jpg','2023-09-18 13:05:31','2023-09-18 13:05:31');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `product_provider`
--

DROP TABLE IF EXISTS `product_provider`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_provider` (
  `prod_id` int(11) DEFAULT NULL,
  `prov_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  KEY `prod_id` (`prod_id`),
  KEY `prov_id` (`prov_id`),
  CONSTRAINT `product_provider_ibfk_1` FOREIGN KEY (`prod_id`) REFERENCES `products` (`prod_id`),
  CONSTRAINT `product_provider_ibfk_2` FOREIGN KEY (`prov_id`) REFERENCES `providers` (`prov_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `product_provider`
--

LOCK TABLES `product_provider` WRITE;
/*!40000 ALTER TABLE `product_provider` DISABLE KEYS */;
INSERT INTO `product_provider` VALUES (1,1,'2023-09-18 13:54:03','2023-09-18 13:54:03');
/*!40000 ALTER TABLE `product_provider` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `prod_id` int(11) NOT NULL AUTO_INCREMENT,
  `prod_ref` varchar(255) DEFAULT NULL,
  `prod_name` varchar(255) DEFAULT NULL,
  `prod_desc` text DEFAULT NULL,
  `prod_stock` varchar(255) DEFAULT NULL,
  `prod_value` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prod_id`),
  UNIQUE KEY `prod_ref` (`prod_ref`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'10023','Wiski','asdasd','2','5000','2023-09-18 13:54:03','2023-09-18 13:54:10');
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `providers`
--

DROP TABLE IF EXISTS `providers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `providers` (
  `prov_id` int(11) NOT NULL AUTO_INCREMENT,
  `prov_nit` varchar(255) DEFAULT NULL,
  `prov_name` varchar(255) DEFAULT NULL,
  `prov_email` varchar(255) DEFAULT NULL,
  `prov_phone` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`prov_id`),
  UNIQUE KEY `prov_nit` (`prov_nit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `providers`
--

LOCK TABLES `providers` WRITE;
/*!40000 ALTER TABLE `providers` DISABLE KEYS */;
INSERT INTO `providers` VALUES (1,'21121-56','Wiski2','yasnoadriandatos@gmail.com','3157832393','2023-09-18 13:53:19','2023-09-18 13:53:28'),(2,'10221-5','Sanchez','jhonsju@hotmail.com','3157832393','2023-09-18 13:53:44','2023-09-18 13:53:44');
/*!40000 ALTER TABLE `providers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `rese_id` int(11) NOT NULL AUTO_INCREMENT,
  `rese_urid` varchar(255) DEFAULT NULL,
  `rese_name` varchar(255) DEFAULT NULL,
  `rese_lastname` varchar(255) DEFAULT NULL,
  `rese_email` varchar(255) DEFAULT NULL,
  `rese_quantity` varchar(255) DEFAULT NULL,
  `rese_table` varchar(255) DEFAULT NULL,
  `rese_day` varchar(255) DEFAULT NULL,
  `rese_time` varchar(255) DEFAULT NULL,
  `rese_details` text DEFAULT NULL,
  `rese_method` varchar(255) DEFAULT NULL,
  `rese_pay_img` text DEFAULT NULL,
  `rese_status` varchar(255) DEFAULT 'PENDING',
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`rese_id`),
  UNIQUE KEY `rese_urid` (`rese_urid`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `reservations_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,'1-1695045142-1650856165c76b','Adrian','Urrea','yasnoadriandatos@gmail.com','2','2','2023-09-19','morning: 10','','Nequi','Public/img/facturas/16950453201-1695045142-1650856165c76b.jpg','3',1,'2023-09-18 13:52:22','2023-09-18 13:55:39');
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `subs_id` int(11) NOT NULL AUTO_INCREMENT,
  `subs_name` varchar(255) DEFAULT NULL,
  `subs_lastname` varchar(255) DEFAULT NULL,
  `subs_email` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`subs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_nick` varchar(255) DEFAULT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `user_lastname` varchar(255) DEFAULT NULL,
  `user_address` varchar(255) DEFAULT NULL,
  `user_phone` varchar(255) DEFAULT NULL,
  `user_img_path` varchar(255) DEFAULT 'img/static/profiles/avatar1.png',
  `user_privileges` int(11) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `user_nick` (`user_nick`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Guest','guest@mail.com','$2y$10$oVY0ngkO7lJ.nreAcPydZ.AwTFP.sS82ktO92GM0s1As0AB4UoWBK',NULL,NULL,NULL,NULL,'img/static/profiles/avatar1.png',1,'2023-09-18 13:05:30','2023-09-18 13:05:30'),(2,'Administrator','admin@mail.com','$2y$10$HArumTXhX.xNnUmXJ1jT7ONqVWj/Zz1WVkF0tCi7ybJuV7sZgozWW',NULL,NULL,NULL,NULL,'img/static/profiles/avatar1.png',3,'2023-09-18 13:05:31','2023-09-18 13:05:31'),(3,'Master','master@mail.com','$2y$10$uCuK4W5tDG5hdkAy.lIrBumrc.qNxOB8z81RpVelYdMEw6IjSpavm',NULL,NULL,NULL,NULL,'img/static/profiles/avatar1.png',7,'2023-09-18 13:05:31','2023-09-18 13:05:31');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `webdatas`
--

DROP TABLE IF EXISTS `webdatas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `webdatas` (
  `webd_id` int(11) NOT NULL AUTO_INCREMENT,
  `webd_name` varchar(255) DEFAULT NULL,
  `webd_subt` varchar(255) DEFAULT NULL,
  `webd_logo` varchar(255) DEFAULT NULL,
  `webd_email` varchar(255) DEFAULT NULL,
  `webd_phone` varchar(255) DEFAULT NULL,
  `webd_address` varchar(255) DEFAULT NULL,
  `webd_city` varchar(255) DEFAULT NULL,
  `webd_fblink` varchar(255) DEFAULT NULL,
  `webd_twlink` varchar(255) DEFAULT NULL,
  `webd_iglink` varchar(255) DEFAULT NULL,
  `webd_ytlink` varchar(255) DEFAULT NULL,
  `webd_m` varchar(255) DEFAULT NULL,
  `webd_v` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`webd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `webdatas`
--

LOCK TABLES `webdatas` WRITE;
/*!40000 ALTER TABLE `webdatas` DISABLE KEYS */;
INSERT INTO `webdatas` VALUES (1,'Mr. Moon','Coffee & Bar','img/static/mr_moon_logo.png','email@email.com','+57 312 334 5555','Cra 4 No. 4 - 58','La Plata, Huila','https://facebook.com/','https://twitter.com/','https://instagram.com/','https://www.youtube.com/','En nuestra empresa aspira ser un negocio que sastistace las necesidades de nuestros clientes','En el año 2035 ser uno de los mas negocios mas populares y tener diferentes surcusales en el pais','2023-09-18 13:05:31','2023-09-18 13:05:31');
/*!40000 ALTER TABLE `webdatas` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-09-18  8:56:07
