-- MySQL dump 10.13  Distrib 8.0.25, for Linux (x86_64)
--
-- Host: localhost    Database: estoubem
-- ------------------------------------------------------
-- Server version	8.0.25-0ubuntu0.20.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `categorias`
--

DROP TABLE IF EXISTS `categorias`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `categorias` (
  `id` int NOT NULL AUTO_INCREMENT,
  `idpub` varchar(64) NOT NULL,
  `nome` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categorias`
--

LOCK TABLES `categorias` WRITE;
/*!40000 ALTER TABLE `categorias` DISABLE KEYS */;
INSERT INTO `categorias` VALUES (1,'e3a082afd1cc66bf67bc30bb476ebfab18a84bc3092aa454a1e17fbd6429cb56','Ebook');
/*!40000 ALTER TABLE `categorias` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postagens`
--

DROP TABLE IF EXISTS `postagens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `postagens` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `idpub` varchar(64) NOT NULL,
  `title` varchar(45) NOT NULL,
  `subtitle` varchar(45) DEFAULT NULL,
  `text` text,
  `author` varchar(45) DEFAULT NULL,
  `public_at` datetime DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`idpub`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postagens`
--

LOCK TABLES `postagens` WRITE;
/*!40000 ALTER TABLE `postagens` DISABLE KEYS */;
INSERT INTO `postagens` VALUES (1,'4837dac0ec8e4433e1d212dada12c7bc4d1641a8761aa246b9469e22a851aeda','4837dac0ec8e4433e1d212dada12c7bc4d1641a8761aa246b9469e22a851aeda','Primeiro Titulo','Primeiro subtitulo','Primeiro texto de uma postagem','Eu sou ',NULL,'2021-07-03 08:24:56','2021-07-14 06:11:16',NULL),(2,'fef986bd5247a7c046b5efcad221bdcf59c084dd5b9cd588fe20cf6f4cbfb470','fef986bd5247a7c046b5efcad221bdcf59c084dd5b9cd588fe20cf6f4cbfb470','Segundo Titulo','Segundo subtitulo','Segundo texto de uma postagem atualizado','Eu sou ','2021-07-03 13:01:46','2021-07-03 08:25:21','2021-07-14 06:11:16',NULL);
/*!40000 ALTER TABLE `postagens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produtos`
--

DROP TABLE IF EXISTS `produtos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `produtos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `idpub` varchar(64) NOT NULL,
  `title` varchar(45) NOT NULL,
  `subtitle` varchar(45) DEFAULT NULL,
  `pages` int DEFAULT NULL,
  `author` varchar(45) DEFAULT NULL,
  `description` text,
  `cover` varchar(45) DEFAULT NULL,
  `categorias_id` int DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `price_promo` decimal(10,2) DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`idpub`,`key`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produtos`
--

LOCK TABLES `produtos` WRITE;
/*!40000 ALTER TABLE `produtos` DISABLE KEYS */;
INSERT INTO `produtos` VALUES (1,'add49ddb3ada03142f0120be8b285f3ccdfe2e19c061ac2ec21e0251df034a36','yogue-se','Yogue-se','Yoga para auto perfeição',11,'Ivan','Vestibulum in venenatis eros. Aenean vitae odio lectus. Suspendisse potenti. Vivamus auctor metus ac volutpat gravida. Ut ipsum justo, imperdiet sit amet ipsum nec, porta auctor sapien. Donec non pellentesque leo. Suspendisse in leo malesuada, laoreet ante gravida, tincidunt massa. Vestibulum dui magna, sollicitudin ut ex et, varius dictum tortor. Praesent tincidunt ante condimentum purus aliquet sollicitudin. Mauris ullamcorper vulputate commodo. Donec a maximus erat, at sagittis tellus. Cras id commodo tortor. Integer semper rutrum ultrices. ','yogue-se1.webp',1,9.99,NULL,'2021-06-27 11:14:51','2021-07-23 05:35:05',NULL),(14,'ee053372c5adf96d4ad533d45a740b1595525a61009b614edf8a9695b0f9101d','ee053372c5adf96d4ad533d45a740b1595525a61009b614edf8a9695b0f9101d','Meditação para iniciantes','Todos podem meditar',6,'Author','Curabitur et auctor nibh. Vestibulum sollicitudin justo nec viverra aliquet. Aliquam rhoncus ultrices arcu sit amet dignissim. Suspendisse potenti. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Praesent suscipit sollicitudin bibendum. Sed fringilla purus tellus, non rutrum dui convallis et. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. ',NULL,1,19.99,9.99,'2021-06-27 15:20:01','2021-07-23 05:35:05',NULL),(15,'f2fccbb2fbf7d2e4bccbfcfd9226e3e400edad09cf4d223e0c04cebc283cbb0b','f2fccbb2fbf7d2e4bccbfcfd9226e3e400edad09cf4d223e0c04cebc283cbb0b','Novo titulo d','Novo subtitulo',11,'Author','Descrição do novo livro depois de inserido',NULL,1,NULL,NULL,'2021-06-27 15:21:00','2021-07-23 05:20:39',NULL);
/*!40000 ALTER TABLE `produtos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `key` varchar(64) NOT NULL,
  `nome` varchar(254) DEFAULT NULL,
  `email` varchar(254) DEFAULT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `documento` varchar(50) DEFAULT NULL,
  `senha` varchar(256) DEFAULT NULL COMMENT 'Senha SHA-256; no MySQL: sha2("str", 256); no PHP: hash("sha256", "str");',
  `token` varchar(256) DEFAULT NULL COMMENT 'Token SHA-256; no MySQL: sha2("str", 256); no PHP: hash("sha256", "str");',
  `status` enum('1','2','3','9') NOT NULL DEFAULT '1' COMMENT '1: Aguardando confirmação; 2: Confirmado; 9: Inativo',
  `tipo` enum('admin','profissional','cliente') DEFAULT NULL,
  `create_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `deleted_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`,`key`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `telefone_UNIQUE` (`telefone`),
  UNIQUE KEY `token_UNIQUE` (`token`),
  UNIQUE KEY `documento_UNIQUE` (`documento`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'chaveteste','ivan','ivannack@gmail.com','44999262946',NULL,'03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4',NULL,'1',NULL,'2021-07-16 06:11:04','2021-07-16 06:21:50',NULL);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-07-23  7:43:11
