-- MariaDB dump 10.19  Distrib 10.5.23-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: businessclub_digiboard
-- ------------------------------------------------------
-- Server version	10.5.23-MariaDB-0+deb11u1

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
-- Table structure for table `calendar`
--

DROP TABLE IF EXISTS `calendar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL,
  `title` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `calendar`
--

LOCK TABLES `calendar` WRITE;
/*!40000 ALTER TABLE `calendar` DISABLE KEYS */;
/*!40000 ALTER TABLE `calendar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `feature_requests`
--

DROP TABLE IF EXISTS `feature_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `feature_requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state` int(1) NOT NULL,
  `request` varchar(255) NOT NULL,
  `discription` longtext NOT NULL,
  `comment` longtext NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `feature_requests`
--

LOCK TABLES `feature_requests` WRITE;
/*!40000 ALTER TABLE `feature_requests` DISABLE KEYS */;
INSERT INTO `feature_requests` VALUES (4,1,'Feature request module','Mogelijkheid om wijzigingen en bugs te melden aan development.','De feature request module is voltooid.'),(5,1,'Feature request updates mailen','Bij updates op feature requests, dit mailen naar alle users.','Bij nieuwe features en updates op features ontvangen alle gebruikers een notificatiemail.'),(6,1,'Teletekst pagina','Het zou mooi zijn als er een full screen marquee over slides kan rollen met de teletekst data van pagina 834.\r\nGraag een complete look en feel van teletekst. Target 25-03-2023','De teletekst slide is voltooid, deze wordt weergegeven op zaterdag van +/- 14:15 uur tot 17:00 uur en de data wordt elke 20 seconden bijgewerkt vanaf teletekst.'),(7,1,'Afbeelding wijzigen sponsoren','Het is nu niet mogelijk om een sponsorafbeelding te wijzigen, dit is wel gewenst','Dit is nu wel mogelijk.'),(8,1,'Afbeelding wijzigen berichten','Het is nu niet mogelijk om afbeelding van een bericht te wijzigen, dit is wel gewenst.','Dit is nu mogelijk.'),(9,1,'Afbeelding aanpassen evenement','Het is nu niet mogelijk om afbeelding van een evenement te wijzigen, dit is wel gewenst.','Is nu mogelijk.'),(10,1,'Videoslide','Het zou mooi zijn om video\'s (Youtube (is de makkelijkste en beste source)) als slide weer te kunnen geven. Testvideo URL: https://youtu.be/cJdnoNo6leE','Youtube videoslides is nu mogelijk. Let wel op, audio wordt niet afgespeeld.'),(11,1,'Borgen van technisch beheer Digiboard Pi','De wallboards worden aangestuurd via een Raspberry Pi4, In deze app opnemen hoe deze wordt aangesloten, en hoe deze kan worden herstart en resolutie kan worden ingesteld.','Deze informatie is geborgd onder HWinfo'),(12,1,'Bug: bij vervangen van afbeelding slide, wordt de oude niet verwijderd.','Dit zorgt voor extra opslag, wat zonde is.','Opgelost in controller.'),(13,1,'Status weergeven in feature request mails','Ook de status weergeven in de mails die worden verstuurd bij feature request aanpassingen.','Status wordt nu weergegeven in de mail'),(14,1,'Blijven zoeken naar slides als er geen slides meer zijn.','Als er nu geen slides meer zijn, of actief zijn, dan moet de Raspberry Pi herstart worden om de nieuwe content op te halen.\r\nDit is onhandig.','Herstart is niet meer nodig na code uitbreiding in home.php'),(15,1,'Bediening via een presenter?','Onderzoeken of het mogelijk is digiboard te bedienen met een presenter incl. un-mute van videoslides.','Het is nu mogelijk door slides heen te navigeren met de meegeleverde presenter.'),(16,1,'Duratie van slide weergeven in slides overzicht','Het is handig om de slide duratie in het overzicht weer te geven.','Toegevoegd'),(17,1,'Digiboard webapp ontwikkeling','Wat is de ontwikkelingstijd geweest voor het Digiboard?','De applicatie incl. testen met Raspberry Pi en inrichten Raspberry Pi heeft ongeveer 40 uur in beslag genomen.'),(18,1,'Algemene instellingen','Pagina teletekst pagina kan worden opgegeven.','De settings pagina is beschikbaar, hier kun je aangeven of je de teletekst pagina wilt zien op de eerstvolgende zaterdag tussen 14:30 en 17:00 uur en welke teletekst pagina dat moet zijn.'),(19,1,'Bug: er wordt op speeldag het woord TUSSENSTANDEN weergegeven.','Dit zorgt voor een extra onverwachte slide. Deze eruit halen.','Fixed'),(20,1,'Volgorde slides','Hey Dennis,\r\n\r\nHet lukt niet....\r\n\r\n\r\nHey Dennis,\r\n\r\nGraag zou ik de volgorde van de slides willen kunnen wijzigen.\r\nHoe doe ik dat?\r\n\r\n','Volgorde kan worden gewijzigd middels pijlen in het slides overzicht.'),(21,1,'Additionele timeropties','10 seconden en 30 seconden toevoegen aan slide timer instellingen.','Voltooid'),(22,1,'Volgorde slides','Hey Dennis,\r\n\r\nHet lukt niet om de volgorde van de slides aan te passen met de pijltjes..','De pijltjes zijn vervangen voor dropdowns. Hiermee kun je de volgorde bepalen. Vergeet niet op de knop volgorde opslaan te klikken als je de volgorder hebt bepaald.'),(23,1,'Bug: code 5 crash op Raspberry Pi','Sinds kort crashed het digiboard regelmatig met error code 5. Bij controle van de wallpapers bevat deze 42MB! aan bestandsgrootte, de wallpapers zijn veel te groot.\r\nError 5;\r\nError 5 means something\'s wrong with the HTML / JS in general, or you\'re calling the function before things get loaded\r\n\r\nHet duurt te lang om de wallpapers in te laden, de functies laden sneller, hierdoor ontstaat 404 errors, wat volgt in error 5.\r\nTodo: \r\n\r\n- Uploadlimiet voor wallpapers van 600KB\r\n','- Wallpapers zijn verkleind (nu nog maar 6MB in totaal!)\r\n- Als een wallpaper wordt verwijderd, wordt ook de slide verwijderd die de wallpaper gebruikt.\r\n- Uploadlimiet van 750KB ingesteld.\r\n\r\nHiermee wordt de hardware en browsercache niet meer zwaar belast, wat code 5 voorkomt.'),(24,1,'Afbeeldingen upload restricties','Om grote afbeeldingen (in formaat (MB\'s)) te voorkomen, restricties plaatsen in maximaal grootte van de te uploaden bestanden.','Restricties zijn toegepast op de volgende functions\r\nadd_sponsor\r\nmod_sponsor\r\nadd_slide\r\nmod_slide\r\nadd_message\r\nmod_message\r\nadd_event\r\nmod_event'),(25,3,'Grootte slides','Ha Dennis,\r\n\r\nIk kan mijn slides niet uploaden want ik kan maar 750 kb....\r\nDan raak ik de resolutie van de kwaliteit van mijn wallpapers kwijt..\r\n\r\n','Dit staat los van de resolutie, de wallpapers zijn veel te zwaar. Gebruik Photoshop of elk ander kwalitatief bewerkingsprogramma om de bestandgrootte te verkleinen.\r\nBij te grote bestanden is er een verhoogd risico op storingen bij het ophalen van de slides door de Raspberry pi.'),(26,1,'Voetbalcafe slide loopt niet','Hey Dennis,\r\n\r\nDe videoslide van het voetbalcafe loopt niet automatisch.. Ik snap niet waar het aan ligt. De andere twee kerstgala wel...\r\n\r\n#HELP','Na nieuwe upload richting Youtube werkt deze wel.');
/*!40000 ALTER TABLE `feature_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(150) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (26,'Volg ons op Facebook','20230117172017.png','Blijf op de hoogte van de businessclub via Facebook.'),(27,'Volg ons op Insta','20230118130841.png','Volg @debusinessclub op Instagram!');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `teletekst` int(1) NOT NULL,
  `teletekst_pagina` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,1,834);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `slides`
--

DROP TABLE IF EXISTS `slides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `slides` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `discription` varchar(150) NOT NULL,
  `title` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `active` int(1) NOT NULL,
  `sponsors` longtext NOT NULL,
  `calendar` longtext NOT NULL,
  `messages` longtext NOT NULL,
  `wallpaper` varchar(255) NOT NULL,
  `fontcolor` varchar(10) NOT NULL,
  `ran_last` datetime NOT NULL,
  `duration` int(11) NOT NULL,
  `order` int(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `active` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=279 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `slides`
--

LOCK TABLES `slides` WRITE;
/*!40000 ALTER TABLE `slides` DISABLE KEYS */;
INSERT INTO `slides` VALUES (120,'VST - Narrowcasting','','','',1,'','','','17narrowcastingvst.png','white','2024-04-11 16:16:00',45,8),(129,'CMC Hoofdsponsor','','','',1,'','','','wallpapercmc.jpg','white','2024-04-11 16:12:13',45,5),(173,'Terugblik','','','https://youtu.be/4TA-WT0RHic',1,'','','','achterzijdestandaard1.jpg','','2024-04-11 16:17:30',16,11),(192,'Ton & Coby','','','',1,'','','','ton&coby1.jpg','white','2024-04-11 16:16:45',45,6),(218,'Hoofdsponsoren','','','',1,'','','','hoofdsponsoren.jpg','white','2024-04-11 16:12:59',45,7),(241,'kerstgala','','','https://youtu.be/lGSWp7Dz_kI',1,'','','','achterzijdestandaard1.jpg','','2024-04-11 16:17:53',67,12),(242,'Voetbalcafe','','','https://youtu.be/w5MTp3b_n2A',1,'','','','achterzijdestandaard1.jpg','','2024-04-11 16:19:08',69,13),(261,'sponsors','','','',1,'','','','sponsorbord3.jpg','white','2024-04-11 16:10:43',45,3),(272,'bch next','','','',1,'','','','bchnext.jpg','white','2024-04-11 16:15:14',45,10),(273,'Rally','','','',1,'','','','rally.jpg','white','2024-04-11 16:13:44',45,14),(276,'DOVO - harkemase boys','','','',1,'','','','wallpaperwedstrijd134.jpg','white','2024-04-11 16:11:28',45,2),(278,'Bal buf wed','','','',1,'','','','134def.jpg','white','2024-04-11 16:14:29',45,0);
/*!40000 ALTER TABLE `slides` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sponsors`
--

DROP TABLE IF EXISTS `sponsors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sponsors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `img` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sponsors`
--

LOCK TABLES `sponsors` WRITE;
/*!40000 ALTER TABLE `sponsors` DISABLE KEYS */;
INSERT INTO `sponsors` VALUES (25,'Rockline - Brons','20230117165525.jpg'),(26,'VST ICT & Telecom - Hoofd BCH','20230117165547.png'),(27,'Crossbow Coffee - Zilver','20230117165626.png'),(31,'De Beren Veenendaal - Brons','20230117165826.jpg'),(32,'Huisartsenpraktijk D.G. Bos - Zilver','20230117165857.jpg'),(36,'Rabobank Vallei en Rijn - Brons','20230206143504.jpg'),(37,'Bakkerij ’t Haverland - Brons','20230117231932.jpg'),(40,'7 continenten - brons','20230130143640.png'),(41,'Stichtsbeheer - Brons','20230130143710.jpg'),(43,'TuinhuisMakelaar - Brons','20230130144206.jpg'),(44,'VAG - Brons','20230130144306.jpg'),(45,'Van Verseveld Infra - Brons','20230130144350.png'),(46,'CMC - Hoofdsponsor','20230206143526.png'),(47,'Crop - Goud','20230130144704.png'),(48,'Schuiteman - Zilver','20230130144911.jpg'),(50,'Henken - Hoofdsponsor','20230130145102.jpg'),(51,'Simac - Goud','20230208110648.png'),(52,'Van Beek Olie - Zilver','20230220135423.png'),(54,'Van Ree - Zilver','20230220140203.png'),(55,'TechTron - brons','20230927122829.png'),(56,'Heuvelman Staal - zilver','20231023135311.jpg'),(57,'OFM - eventpartner','20231106124222.jpg'),(58,'Donker Bouwproducten - brons','20240324124633.jpg'),(59,'jecawear - brons','20240324124701.jpg');
/*!40000 ALTER TABLE `sponsors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `mail` varchar(150) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `passwd` varchar(255) NOT NULL,
  `login` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Dennis Gaasbeek','d.gaasbeek@vstelecom.nl','0642003999','a9e7e6c76cacd8f40f41e5be0ca36e29','2024-04-07'),(17,'Anne Mulder','marcom@deheuvelrug.nl','0611479501','584cafdc1dcb5bca6b76f413a594e0a5','2024-04-10'),(19,'Wim van Silfhout','voorzitter@deheuvelrug.nl','0639721660','a56ee7965deac385adba857b6d1df057','2023-03-14');
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

-- Dump completed on 2024-04-11 16:19:54
