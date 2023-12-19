-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: laiadata
-- ------------------------------------------------------
-- Server version	8.0.34
 create database laiaData;
 use laiaData;
/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `juegos`
--

DROP TABLE IF EXISTS `juegos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `juegos` (
  `idjuegos` int NOT NULL,
  `descripcion` varchar(255) NOT NULL,
  PRIMARY KEY (`idjuegos`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `juegos`
--

LOCK TABLES `juegos` WRITE;
/*!40000 ALTER TABLE `juegos` DISABLE KEYS */;
INSERT INTO `juegos` VALUES (1,'Warcelona'),(2,'Brasil'),(3,'Kenia'),(4,'India');
/*!40000 ALTER TABLE `juegos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `puntuacion`
--

DROP TABLE IF EXISTS `puntuacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `puntuacion` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `idjuegos` int DEFAULT NULL,
  `puntuacion` int DEFAULT NULL,
  KEY `idUsuario` (`idUsuario`),
  KEY `idjuegos` (`idjuegos`),
  CONSTRAINT `puntuacion_ibfk_1` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`idUsuario`),
  CONSTRAINT `puntuacion_ibfk_2` FOREIGN KEY (`idjuegos`) REFERENCES `juegos` (`idjuegos`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `puntuacion`
--

LOCK TABLES `puntuacion` WRITE;
/*!40000 ALTER TABLE `puntuacion` DISABLE KEYS */;
INSERT INTO `puntuacion` VALUES (7,1,1),(7,3,60),(7,4,26),(8,1,2),(8,2,78),(8,3,40),(8,4,50),(12,1,3),(15,1,4),(16,1,1),(14,1,2),(17,1,2),(12,2,94),(15,2,72),(14,2,71),(15,3,80),(16,2,98),(14,3,40),(12,3,60),(17,2,80),(16,3,60),(16,3,60),(16,3,60),(17,3,80),(15,4,45),(12,4,51),(17,4,59),(16,4,45),(16,3,0),(16,3,0),(16,3,0),(16,3,0),(19,1,4),(18,1,4),(19,2,77),(18,2,70),(19,3,80),(18,3,60),(19,4,71),(18,3,0),(18,4,41),(22,1,2),(23,1,2),(24,1,9),(23,2,84),(22,2,70),(23,3,80),(24,2,94),(22,3,80),(24,3,100),(25,1,6),(25,2,70),(26,1,10),(22,4,75),(25,3,80),(24,4,69),(23,4,53),(26,2,100),(26,1,1),(25,2,93),(27,1,4),(26,3,60),(26,3,60),(27,2,70),(27,3,80),(25,4,42),(27,4,64),(24,1,14),(26,4,47),(29,1,6),(32,1,5),(31,1,9),(30,1,6),(29,2,88),(32,2,70),(31,2,100),(29,3,100),(32,3,60),(30,2,100),(31,3,60),(30,3,80),(32,4,65),(29,4,47),(31,4,60),(30,4,60),(17,3,80),(33,1,8),(34,1,5),(34,2,91),(36,1,5),(35,1,8),(34,3,80),(35,2,95),(35,3,80),(37,1,4),(35,3,80),(34,4,77),(37,2,89),(37,3,80),(33,2,80),(36,3,60),(35,4,55),(33,3,60),(36,4,87),(38,1,9),(33,4,66),(38,3,80),(38,4,72),(41,1,6),(40,1,7),(41,2,94),(40,2,70),(41,3,80),(40,3,80),(41,3,60),(20,4,92),(20,1,16),(43,1,3),(43,2,70),(44,1,6),(45,1,5),(43,3,60),(46,1,3),(47,1,3),(45,2,100),(44,2,70),(48,1,1),(45,3,60),(46,2,70),(44,3,80),(43,4,44),(45,4,63),(47,3,60),(46,3,40),(44,4,59),(45,2,100),(46,4,49),(47,4,13),(9,1,1),(49,1,7),(50,1,2),(21,1,4),(49,2,70),(49,3,60),(50,3,60),(49,4,39),(9,1,2),(9,1,2),(9,2,70),(9,2,70),(9,2,70),(9,2,70),(50,4,48),(9,3,40),(9,4,64),(50,1,12),(51,1,4),(52,1,7),(51,2,100),(51,3,80),(52,2,70),(52,2,70),(52,2,70),(52,2,70),(53,1,2),(43,2,74),(43,3,60),(51,4,48),(43,4,49),(57,4,69),(11,1,15),(36,1,6),(36,2,80),(36,3,80),(36,4,44),(36,2,100),(21,1,17);
/*!40000 ALTER TABLE `puntuacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `idRol` int NOT NULL AUTO_INCREMENT,
  `rol` varchar(255) NOT NULL,
  PRIMARY KEY (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'SUPERADMIN'),(2,'ADMIN'),(3,'JUGADOR');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `usuarios` (
  `idUsuario` int NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `nombreUsuario` varchar(255) DEFAULT NULL,
  `contrasena` varchar(255) NOT NULL,
  `apellido1` varchar(255) NOT NULL,
  `fechaNacimiento` date NOT NULL,
  `id_Rol` int DEFAULT NULL,
  `warcelonaDone` tinyint(1) DEFAULT NULL,
  `brasilDone` tinyint(1) DEFAULT NULL,
  `kenyaDone` tinyint(1) DEFAULT NULL,
  `indiaDone` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `nombreUsuario` (`nombreUsuario`),
  KEY `id_Rol` (`id_Rol`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_Rol`) REFERENCES `roles` (`idRol`)
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'WarcelonaWatcher','SuperAdminUser','superadmin123','Apellido1Super','1990-01-01',1,NULL,NULL,NULL,NULL),(2,'Admin','AdminUser','admin123','Apellido1Admin','1990-01-01',2,NULL,NULL,NULL,NULL),(6,'alex','Al','123','rivero','1998-12-05',3,0,0,0,0),(7,'m','m','123','m','2023-12-18',3,1,0,1,1),(8,'Alba','Alba','Albmure.','Muñoz Rey','2005-10-05',3,1,1,1,1),(9,'pedro','pedro','123','gallego','1998-10-14',3,1,1,1,1),(11,'jordi','jordi','123','gallego','2023-12-12',3,1,0,0,0),(12,'judit','judit','123','casino','2023-09-08',3,1,1,1,1),(14,'MARTINA','MARTINA','MARTINASP','SANCHO','2004-05-07',3,1,1,1,0),(15,'alba','alba1','1234','lopera','2005-06-29',3,1,1,1,1),(16,'Carla','Carla','Carlita16','Alpuente','2023-04-16',3,1,1,1,1),(17,'Simon','SimonElMejor','12345678','Lopez','2023-12-15',3,1,1,1,1),(18,'younes','younes','123456789','belabbes','2000-07-02',3,1,1,1,1),(19,'Marcos','Socram','12345678','Puertas Ventanas','1975-12-28',3,1,1,1,1),(20,'Aleix','Aleix','123','Corres','2023-12-20',3,1,0,0,1),(21,'jean','jean','123','lopera','2023-12-27',3,1,0,0,0),(22,'Carla','Carlai','12345','Cayero','1994-01-04',3,1,1,1,1),(23,'virginia','virginia','1234','poglonig','1994-03-30',3,1,1,1,1),(24,'Damian','Damian','123456','Molins','2003-09-10',3,1,1,1,1),(25,'Erfan','Erfan','informatica','Ribas','1994-03-21',3,1,1,1,1),(26,'Eric','Eric','cientifics05','Peralta Sandoval','2023-09-18',3,1,1,1,1),(27,'Natalia','Natalia','123','Calvo','1999-06-14',3,1,1,1,1),(29,'Jesus','jesuspadilla','jesuspadilla','padilla','1999-12-12',3,1,1,1,1),(30,'Jordi','DIRO98','123','asdfuhairufhawer','2023-12-18',3,1,1,1,1),(31,'lev','Lev','lev','lev','2023-12-27',3,1,1,1,1),(32,'marc','marc','1234','bosch serrano','1996-09-13',3,1,1,1,1),(33,'Hugo','Hugo','1234','Torres','2005-11-02',3,1,1,1,1),(34,'filip','filip','hola','rendon','2002-10-08',3,1,1,1,1),(35,'Marc','MarcP','123456','P R','2023-12-13',3,1,1,1,1),(36,'Ivana','juanjo','12345','Alfreda','2004-05-21',3,1,1,1,1),(37,'Jose Manuel','JoseBarco','1998jmbarco','Barco','1998-10-08',3,1,1,1,0),(38,'Roger','Roger','patata','Ortí','2023-04-05',3,1,0,1,1),(39,'Jiajie','jiajie','1234','Chen','2003-12-12',3,0,0,0,0),(40,'holapepe','holapepe','holapepe','holapepe','2023-12-14',3,1,1,1,0),(41,'pol','pool','1234','gp','2002-12-05',3,1,1,1,0),(43,'David','David','123','Morillas','2023-12-01',3,1,1,1,1),(44,'sergi','clapped sasuke','123','martínez castro','2023-12-13',3,1,1,1,1),(45,'HND','HND','123','DNH','2023-12-21',3,1,1,1,1),(46,'Abraham','Crocrock','1234567','garcia','2023-12-19',3,1,1,1,1),(47,'Maria','Maria','1234','sabanza bru','2023-12-04',3,1,0,1,1),(48,'rebeca','rebeca','123','q','2023-12-20',3,1,0,0,0),(49,'maria','maria2','123','mateu','2023-12-20',3,1,1,1,1),(50,'Pablo','mistercreeper','123','Mariano','2012-01-03',3,1,0,1,1),(51,'eva','Eva','123','m','2009-12-10',3,1,1,1,1),(52,'berta','12berta.bruna@tfc.cat','123','bruna','2023-12-13',3,1,1,0,0),(53,'ana','ana','ana','ana','2023-12-05',3,1,0,0,0),(55,'pol','pipo tiene hambre','44456','bla','2023-12-14',3,0,0,0,0),(56,'HOLA','HOLA','HOLA','HOLA','2023-12-14',3,0,0,0,0),(57,'JL','JL','a','a','2023-12-19',3,0,0,0,1);
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

-- Dump completed on 2023-12-19 12:39:48
