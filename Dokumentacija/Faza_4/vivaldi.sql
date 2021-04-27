-- MySQL dump 10.13  Distrib 8.0.24, for Win64 (x86_64)
--
-- Host: localhost    Database: vivaldi
-- ------------------------------------------------------
-- Server version	8.0.24

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
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `korisnik` (
  `IdKorisnik` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `Lozinka` varchar(20) NOT NULL,
  `KorisnickoIme` varchar(20) NOT NULL,
  `JMBG` char(13) NOT NULL,
  `BrojKartice` varchar(16) NOT NULL,
  `Tokeni` double NOT NULL,
  PRIMARY KEY (`IdKorisnik`),
  UNIQUE KEY `idKor_UNIQUE` (`IdKorisnik`),
  UNIQUE KEY `KorisnickoIme_UNIQUE` (`KorisnickoIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `korisnik`
--

LOCK TABLES `korisnik` WRITE;
/*!40000 ALTER TABLE `korisnik` DISABLE KEYS */;
/*!40000 ALTER TABLE `korisnik` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lucky6`
--

DROP TABLE IF EXISTS `lucky6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `lucky6` (
  `IdLucky6` int NOT NULL AUTO_INCREMENT,
  `IzvuceniBrojevi` varchar(130) DEFAULT NULL,
  `Vreme` datetime NOT NULL,
  PRIMARY KEY (`IdLucky6`),
  UNIQUE KEY `IdLucky_UNIQUE` (`IdLucky6`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lucky6`
--

LOCK TABLES `lucky6` WRITE;
/*!40000 ALTER TABLE `lucky6` DISABLE KEYS */;
/*!40000 ALTER TABLE `lucky6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rulet`
--

DROP TABLE IF EXISTS `rulet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `rulet` (
  `IdRulet` int NOT NULL AUTO_INCREMENT,
  `IzvucenBroj` int DEFAULT NULL,
  `Vreme` datetime NOT NULL,
  PRIMARY KEY (`IdRulet`),
  UNIQUE KEY `idIgraRulet_UNIQUE` (`IdRulet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rulet`
--

LOCK TABLES `rulet` WRITE;
/*!40000 ALTER TABLE `rulet` DISABLE KEYS */;
/*!40000 ALTER TABLE `rulet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stavka_rulet`
--

DROP TABLE IF EXISTS `stavka_rulet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stavka_rulet` (
  `IdStavkaRulet` int NOT NULL AUTO_INCREMENT,
  `IdKorisnik` int NOT NULL,
  `IdRulet` int NOT NULL,
  `Tip` varchar(20) NOT NULL,
  `Prosla` tinyint DEFAULT NULL,
  `Ulog` double NOT NULL,
  PRIMARY KEY (`IdStavkaRulet`),
  UNIQUE KEY `IdStavkaRul_UNIQUE` (`IdStavkaRulet`),
  KEY `FK_TiketRulet_Rulet_idRul_idx` (`IdRulet`,`IdKorisnik`),
  CONSTRAINT `FK_StavkaRulet_TiketRulet_IdTiketRul_IdKor` FOREIGN KEY (`IdRulet`, `IdKorisnik`) REFERENCES `tiket_rulet` (`IdRulet`, `IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stavka_rulet`
--

LOCK TABLES `stavka_rulet` WRITE;
/*!40000 ALTER TABLE `stavka_rulet` DISABLE KEYS */;
/*!40000 ALTER TABLE `stavka_rulet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `stavka_tiket`
--

DROP TABLE IF EXISTS `stavka_tiket`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `stavka_tiket` (
  `IdTiketKladjenje` int NOT NULL,
  `IdUtakmica` int NOT NULL,
  `Iznos` double NOT NULL,
  `KonacanIshod` char(1) NOT NULL,
  `Status` int DEFAULT NULL,
  PRIMARY KEY (`IdTiketKladjenje`,`IdUtakmica`),
  KEY `FK_StavkaTiket_IdUtakmica_idx` (`IdUtakmica`),
  CONSTRAINT `FK_StavkaTiket_IdTiketKladjenje` FOREIGN KEY (`IdTiketKladjenje`) REFERENCES `tiket_kladjenje` (`IdTiketKladjenje`),
  CONSTRAINT `FK_StavkaTiket_IdUtakmica` FOREIGN KEY (`IdUtakmica`) REFERENCES `utakmica` (`IdUtakmica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `stavka_tiket`
--

LOCK TABLES `stavka_tiket` WRITE;
/*!40000 ALTER TABLE `stavka_tiket` DISABLE KEYS */;
/*!40000 ALTER TABLE `stavka_tiket` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket_kladjenje`
--

DROP TABLE IF EXISTS `tiket_kladjenje`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiket_kladjenje` (
  `IdTiketKladjenje` int NOT NULL AUTO_INCREMENT,
  `IdKor` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Status` int DEFAULT NULL,
  PRIMARY KEY (`IdTiketKladjenje`),
  UNIQUE KEY `IdTiketKladjenje_UNIQUE` (`IdTiketKladjenje`),
  KEY `FK_TiketKladjenje_Korisnik_IdKorisnik_idx` (`IdKor`),
  CONSTRAINT `FK_TiketKladjenje_Korisnik_IdKorisnik` FOREIGN KEY (`IdKor`) REFERENCES `korisnik` (`IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket_kladjenje`
--

LOCK TABLES `tiket_kladjenje` WRITE;
/*!40000 ALTER TABLE `tiket_kladjenje` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiket_kladjenje` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket_lucky6`
--

DROP TABLE IF EXISTS `tiket_lucky6`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiket_lucky6` (
  `IdKorisnik` int NOT NULL,
  `IdLucky6` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Kombinacija` varchar(20) NOT NULL,
  PRIMARY KEY (`IdKorisnik`,`IdLucky6`),
  KEY `FK_TiketLucky6_Lucky6_IdLucky6_idx` (`IdLucky6`),
  CONSTRAINT `FK_TiketLucky6_Korisnik_IdKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`),
  CONSTRAINT `FK_TiketLucky6_Lucky6_IdLucky6` FOREIGN KEY (`IdLucky6`) REFERENCES `lucky6` (`IdLucky6`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket_lucky6`
--

LOCK TABLES `tiket_lucky6` WRITE;
/*!40000 ALTER TABLE `tiket_lucky6` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiket_lucky6` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket_rulet`
--

DROP TABLE IF EXISTS `tiket_rulet`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiket_rulet` (
  `IdRulet` int NOT NULL,
  `IdKorisnik` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  PRIMARY KEY (`IdRulet`,`IdKorisnik`),
  KEY `FK_TiketRulet_Rulet_idKor_idx` (`IdKorisnik`),
  CONSTRAINT `FK_TiketRulet_Rulet_idKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`),
  CONSTRAINT `FK_TiketRulet_Rulet_idRul` FOREIGN KEY (`IdRulet`) REFERENCES `rulet` (`IdRulet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket_rulet`
--

LOCK TABLES `tiket_rulet` WRITE;
/*!40000 ALTER TABLE `tiket_rulet` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiket_rulet` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiket_slot`
--

DROP TABLE IF EXISTS `tiket_slot`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiket_slot` (
  `IdTiketSlot` int NOT NULL AUTO_INCREMENT,
  `IdKorisnik` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Rezultat` varchar(20) NOT NULL,
  PRIMARY KEY (`IdTiketSlot`),
  UNIQUE KEY `idTiketSlot_UNIQUE` (`IdTiketSlot`),
  KEY `FK_TiketSlot_Korisnik_IdKor_idx` (`IdKorisnik`),
  CONSTRAINT `FK_TiketSlot_Korisnik_IdKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiket_slot`
--

LOCK TABLES `tiket_slot` WRITE;
/*!40000 ALTER TABLE `tiket_slot` DISABLE KEYS */;
/*!40000 ALTER TABLE `tiket_slot` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tim`
--

DROP TABLE IF EXISTS `tim`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tim` (
  `IdTim` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  PRIMARY KEY (`IdTim`),
  UNIQUE KEY `idTim_UNIQUE` (`IdTim`),
  UNIQUE KEY `Ime_UNIQUE` (`Ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tim`
--

LOCK TABLES `tim` WRITE;
/*!40000 ALTER TABLE `tim` DISABLE KEYS */;
/*!40000 ALTER TABLE `tim` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utakmica`
--

DROP TABLE IF EXISTS `utakmica`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `utakmica` (
  `IdUtakmica` int NOT NULL AUTO_INCREMENT,
  `Rezultat` varchar(5) NOT NULL,
  `Vreme` datetime NOT NULL,
  `IdDomacin` int NOT NULL,
  `IdGost` int NOT NULL,
  `KvotaX` double NOT NULL,
  `Kvota1` double NOT NULL,
  `Kvota2` double NOT NULL,
  PRIMARY KEY (`IdUtakmica`),
  UNIQUE KEY `IdUtakmica_UNIQUE` (`IdUtakmica`),
  KEY `FK_Utakmica_Tim_IdDomacin_IdTim_idx` (`IdDomacin`),
  KEY `FK_Utakmica_Tim_IdGost_IdTim_idx` (`IdGost`),
  CONSTRAINT `FK_Utakmica_Tim_IdDomacin_IdTim` FOREIGN KEY (`IdDomacin`) REFERENCES `tim` (`IdTim`),
  CONSTRAINT `FK_Utakmica_Tim_IdGost_IdTim` FOREIGN KEY (`IdGost`) REFERENCES `tim` (`IdTim`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utakmica`
--

LOCK TABLES `utakmica` WRITE;
/*!40000 ALTER TABLE `utakmica` DISABLE KEYS */;
/*!40000 ALTER TABLE `utakmica` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zaposleni`
--

DROP TABLE IF EXISTS `zaposleni`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zaposleni` (
  `IdZaposleni` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `Lozinka` varchar(20) NOT NULL,
  `KorisnickoIme` varchar(20) NOT NULL,
  `JMBG` char(13) NOT NULL,
  `Tip` int NOT NULL,
  PRIMARY KEY (`IdZaposleni`),
  UNIQUE KEY `idZap_UNIQUE` (`IdZaposleni`),
  UNIQUE KEY `KorisnickoIme_UNIQUE` (`KorisnickoIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zaposleni`
--

LOCK TABLES `zaposleni` WRITE;
/*!40000 ALTER TABLE `zaposleni` DISABLE KEYS */;
/*!40000 ALTER TABLE `zaposleni` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-04-27 15:16:52
