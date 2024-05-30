-- MySQL dump 10.19  Distrib 10.2.44-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: projecte
-- ------------------------------------------------------
-- Server version	10.2.44-MariaDB-1:10.2.44+maria~bionic

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
-- Table structure for table `calendari`
--

DROP TABLE IF EXISTS `calendari`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendari` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titol` varchar(50) NOT NULL,
  `inici` datetime NOT NULL,
  `final` datetime NOT NULL,
  `usuari_id` int(11) NOT NULL,
  `descripcio` varchar(255) DEFAULT NULL,
  `color` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuari_ids` (`usuari_id`),
  CONSTRAINT `id_usuari_ids` FOREIGN KEY (`usuari_id`) REFERENCES `usuaris` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendari`
--

LOCK TABLES `calendari` WRITE;
/*!40000 ALTER TABLE `calendari` DISABLE KEYS */;
INSERT INTO `calendari` VALUES (19,'nou','2024-05-30 12:12:00','2024-05-31 14:14:00',1,'Comida de Grecia (Casa)','#000000');
/*!40000 ALTER TABLE `calendari` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comentaris`
--

DROP TABLE IF EXISTS `comentaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comentaris` (
  `id` int(11) NOT NULL,
  `id_tasca` int(11) DEFAULT NULL,
  `id_usuari` int(11) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comentaris`
--

LOCK TABLES `comentaris` WRITE;
/*!40000 ALTER TABLE `comentaris` DISABLE KEYS */;
/*!40000 ALTER TABLE `comentaris` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `projectes`
--

DROP TABLE IF EXISTS `projectes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projectes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `descripcio` text NOT NULL,
  `data_inici` date NOT NULL,
  `data_fi` date NOT NULL,
  `text` text DEFAULT NULL,
  `comentari` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projectes`
--

LOCK TABLES `projectes` WRITE;
/*!40000 ALTER TABLE `projectes` DISABLE KEYS */;
INSERT INTO `projectes` VALUES (5,'DVD','descripcio David','0000-00-00','0000-00-00','asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas',NULL),(6,'DVD','dvddvdvdvdvdvdvdv','0000-00-00','0000-00-00','asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas',NULL),(7,'DVD','dvddvdvdvdvdvdvdv','2024-04-16','2024-04-19','asasass\nasaa,snaks\ns\nas\nas\nassssasassaasasas','\nasasSA\nd.vallmanya@sapalomera.cat: lksjask\nb.martinez2@sapalomera.cat: as\nd.vallmanya@sapalomera.cat: ertgyhu\nDVD: asas\nDVD: asas\nDVD: asasas\nDVD: a'),(8,'DVD2','dvddvdvdvdvdvdvdv','2024-04-16','2024-04-19','assasas\nasoh\naosijasoi\nasjoaisj\nasloaihsoiahsoasijaosi\naslkajsoa\nsalsmas\nasaksa\nsasnaasassaas','Hola! ¿Cómo estás\n1234\nqw\nDavid\nHola DVD\nsasa\naaaaaaaaa\naaaaaaaa\na\n1\nDVD2\n221\nDVD2\nsdfghj\nhOLA dvd\nHola Benito\nHello\nasaasas\nsa\n1\nUsuario: 1\n1\nd.vallmanya@sapalomera.cat1\nDavid1\nDavid: 1\nDavid: kshkuh\nDavid: skdjbkjbskdj\nDavid: 1324r4ty\nDavid: 123245678\nBenito: qewretr4\nBenito2: 12\nDavid: qsdwefgrhjk\nDavid: erwaertyuy\nDavid: saxdfgrt\nDavid: wqEARTEYR6UT7IYTYTUYRETRWAQ\nDavid: qewrg\nDavid: we\nDavid: w\nDavid: we\nBenito2: qew\nBenito2: 12\nBenito2: 12\nBenito2: 12\nBenito2: sd\nBenito2: as\nBenito2: as\nBenito2: as\nBenito2: sa\nBenito2: as\nBenito2: as\nUsuario Desconocido: as\nbmartinezflorido@gmail.com: as\nbmartinezflorido@gmail.com: as\nd.vallmanya@sapalomera.cat: f\nd.vallmanya@sapalomera.cat: f'),(9,'$nombre_proyecto','$descripcion','0000-00-00','0000-00-00',NULL,NULL),(10,'asd','asdd','2024-04-16','2024-04-24','ASASAS\nASAS\nAS\nAS\nASSSSS12','Hola \na\nHola soy el projecto asd\nASD\naaasssas\nas\ns\nas\nas\nasas\nas\nas\nas\nas\n12\n1235\nASAS\nA\nkajsn\nHola soy un comentario\nasd\nwsexdftgyh\ndxrcftv'),(13,'Nuevo Proyecto para Voluntarios','Es un proyectop','2024-04-17','2024-04-20','titititititit\naosijsoias\naosijasajs\naskjabsk\njfro\neo\nasoiajsoansoasijoaisajos\nFirma de Benito1\naska\nFirma de Benito2',NULL),(14,'David V','putube','2024-04-17','2024-10-20',NULL,NULL),(24,'PUTUBE','PUTUBE','2024-04-29','2024-04-30','sAS\nas\nASa\nAs\nASas\nsaaasas','\nDVD: qewarstdyfy\nDVD: as\nDVD: as'),(25,'Putube2','12','2024-04-29','2024-05-01',NULL,NULL),(26,'Youtube','Youtube','2024-05-01','2024-05-02',NULL,NULL),(27,'Youtube','Youtube','2024-05-01','2024-05-02',NULL,NULL),(28,'Youtube','Youtube','2024-05-01','2024-05-02',NULL,NULL),(29,'youtube2','youtube2','2024-05-01','2024-05-02',NULL,NULL),(30,'Putube22','2','2024-05-01','2024-05-02',NULL,NULL),(31,'Projecto Admin','Projecto Admin','2024-05-01','2024-05-02','sadasd\nsadasds','\nBenito: sdsd\nBenito: aaa'),(33,'Ehhhhh','Ehhhhh','2024-05-03','2024-05-04','daSfzgxhcvjbknsdfdghjsdfghsakjSNKJnsasasasas','\nBenito: as\nDVD: sdfghjklÃ±\nBenito: sa\nBenito: asas\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\nBenito: as\n2024-05-30T13:36:41+00:00Benito: sZDFXHVGJB'),(35,'Y luego','Y luego','2024-05-05','2024-05-02','aasd','\nBenito: ASDASDSAD\nBenito: as\nBenito: S\nDVD: A\nBenito: A\nBenito: qewarstyfguh\nBenito: s\nBenito: asas\n2024-05-30T13:35:29+00:00Benito: asas'),(36,'Ruben','Ruben','2024-05-07','2024-05-09','asasasaasasas','\nBenito: as\nDavid: as\nDavid V: aasas'),(37,'Ruberga','Ruberga','2024-05-07','2024-05-10','Ã¡sdfxcgvhnbmn,earsdtfyguhi','\nBenito: asdfghjklÃ±\nBenito2: as\nBenito: sesrdtfy\nBenito: A\nBenito: as\nBenito: as\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: a\nBenito: serdtfyguio'),(39,'Musculitos','Musculitos','2024-05-12','2024-05-24','','\nDavid V: as\nDavid V: as\nDavid V: as\nDavid V: a\nDavid V: a\nDavid V: a\nDavid V: a\nDavid V: 1\nDavid V: 3\nDavid V: 4\nDavid V: 5\nDavid V: 6\nDavid V: 7\nDavid V: 12\nBenito: asasas\nBenito: asd\nBenito: ZXcvbnmbvcxzXdcfxvbnm\nBenito: asas\nBenito: as\nDavid V: as\nDavid V: ss\nBenito: wewewewe\nBenito: kydbakisbdkisad\nBenito: hola\nBenito: sduhsd\nBenito: qewrdtfyhgjk');
/*!40000 ALTER TABLE `projectes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `proyecto_usuario`
--

DROP TABLE IF EXISTS `proyecto_usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `proyecto_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_proyecto` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `permissos` enum('editar','comentar','visualitzar') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_usuario__id` (`id_usuario`),
  KEY `id_projecto__id` (`id_proyecto`),
  CONSTRAINT `id_projecte_id` FOREIGN KEY (`id_proyecto`) REFERENCES `projectes` (`id`) ON DELETE CASCADE,
  CONSTRAINT `id_usuario_id` FOREIGN KEY (`id_usuario`) REFERENCES `usuaris` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `proyecto_usuario`
--

LOCK TABLES `proyecto_usuario` WRITE;
/*!40000 ALTER TABLE `proyecto_usuario` DISABLE KEYS */;
INSERT INTO `proyecto_usuario` VALUES (11,33,1,'editar'),(15,35,1,'editar'),(20,36,1,'editar'),(23,37,1,'editar'),(33,39,1,'editar'),(46,39,29,'editar');
/*!40000 ALTER TABLE `proyecto_usuario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tasques`
--

DROP TABLE IF EXISTS `tasques`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tasques` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_projecte` int(11) NOT NULL,
  `descripcio` varchar(255) NOT NULL,
  `estat` enum('Por hacer','En progres','En revisio','Completades') NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_projecte` (`id_projecte`),
  CONSTRAINT `id_projecte` FOREIGN KEY (`id_projecte`) REFERENCES `projectes` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=79 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tasques`
--

LOCK TABLES `tasques` WRITE;
/*!40000 ALTER TABLE `tasques` DISABLE KEYS */;
INSERT INTO `tasques` VALUES (1,31,'nUEVA TATREA','En revisio'),(2,31,'asas','Por hacer'),(3,31,'zcxvb','En revisio'),(4,31,'qss','En revisio'),(5,31,'szzdfxgchj','Completades'),(6,31,'asdfghvbjknl','En progres'),(7,31,'zfdxghcvjbknl','Completades'),(8,31,'sadfghjkl','Por hacer'),(9,31,'Nueva cosa','Por hacer'),(10,31,'as','Por hacer'),(11,31,'zsaDZFXGHJKLÃ‘KJHGNFBCXDSz','En revisio'),(12,31,'A','En revisio'),(13,31,'Z','Por hacer'),(14,31,'a','Por hacer'),(15,31,'a','Por hacer'),(16,31,'as','Por hacer'),(17,31,'nueva coas','Por hacer'),(18,31,'qewret','Por hacer'),(19,31,'qwewr','Por hacer'),(20,31,'as','Por hacer'),(21,31,'as','Por hacer'),(22,31,'25','Por hacer'),(23,25,'25','En progres'),(24,25,'12','Por hacer'),(25,25,'as','Por hacer'),(26,25,'as','Por hacer'),(27,25,'as','Por hacer'),(28,24,'1234567890','Por hacer'),(29,31,'11232454657645321','Por hacer'),(35,35,'sdZFXCVGHBN','En revisio'),(37,35,'asasas','En revisio'),(38,35,'as','En revisio'),(39,35,'as','En revisio'),(40,35,'aaaaa','En progres'),(42,35,'d','En progres'),(43,35,'123456','En progres'),(44,35,'134567','En progres'),(54,35,'213456789','Por hacer'),(55,35,'w','Por hacer'),(56,35,'1234567890','Por hacer'),(57,35,'nueie','Por hacer'),(77,39,'KISGUiyshiUAS','En revisio'),(78,39,'AsAS','En progres');
/*!40000 ALTER TABLE `tasques` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuaris`
--

DROP TABLE IF EXISTS `usuaris`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuaris` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuari` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contrasenya` varchar(255) NOT NULL,
  `rol` enum('admin','membre') NOT NULL,
  `imatge` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuari_UNIQUE` (`usuari`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuaris`
--

LOCK TABLES `usuaris` WRITE;
/*!40000 ALTER TABLE `usuaris` DISABLE KEYS */;
INSERT INTO `usuaris` VALUES (1,'Benito','b.martinez2@sapalomera.cat','$2y$10$i8sg8DBk/8/egLct0G455OYqwzOwnpBm7RAb5KBlgTnTn1YVGFJgW','admin','../uploads/ruberga.png'),(28,'David V','d.vallmanya@sapalomera.cat','$2y$10$i8sg8DBk/8/egLct0G455OYqwzOwnpBm7RAb5KBlgTnTn1YVGFJgW','membre','../uploads/WhatsApp Image 2024-05-26 at 23.27.51.jpeg'),(29,'OrnitoBot','bmartinezflorido@gmail.com','$2y$10$3N/l0JJg5NHrZyZ3UgLYVeYN/68BXcuC43T4ICn8obA/JL9BRleeW','membre','../uploads/pizza.jpeg');
/*!40000 ALTER TABLE `usuaris` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-05-30 14:13:09
