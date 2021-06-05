-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2021 at 02:50 PM
-- Server version: 8.0.21
-- PHP Version: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vivaldi`
--

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

DROP TABLE IF EXISTS `korisnik`;
CREATE TABLE IF NOT EXISTS `korisnik` (
  `IdKorisnik` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `Lozinka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `KorisnickoIme` varchar(20) NOT NULL,
  `JMBG` char(13) NOT NULL,
  `BrojKartice` varchar(16) NOT NULL,
  `Tokeni` double NOT NULL,
  PRIMARY KEY (`IdKorisnik`),
  UNIQUE KEY `idKor_UNIQUE` (`IdKorisnik`),
  UNIQUE KEY `KorisnickoIme_UNIQUE` (`KorisnickoIme`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `lucky6`
--

DROP TABLE IF EXISTS `lucky6`;
CREATE TABLE IF NOT EXISTS `lucky6` (
  `IdLucky6` int NOT NULL AUTO_INCREMENT,
  `IzvuceniBrojevi` varchar(130) DEFAULT NULL,
  `Vreme` datetime NOT NULL,
  PRIMARY KEY (`IdLucky6`),
  UNIQUE KEY `IdLucky_UNIQUE` (`IdLucky6`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rulet`
--

DROP TABLE IF EXISTS `rulet`;
CREATE TABLE IF NOT EXISTS `rulet` (
  `IdRulet` int NOT NULL AUTO_INCREMENT,
  `IzvucenBroj` int DEFAULT NULL,
  `Vreme` datetime NOT NULL,
  PRIMARY KEY (`IdRulet`),
  UNIQUE KEY `idIgraRulet_UNIQUE` (`IdRulet`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stavka_rulet`
--

DROP TABLE IF EXISTS `stavka_rulet`;
CREATE TABLE IF NOT EXISTS `stavka_rulet` (
  `IdStavkaRulet` int NOT NULL AUTO_INCREMENT,
  `IdKorisnik` int NOT NULL,
  `IdRulet` int NOT NULL,
  `Tip` varchar(20) NOT NULL,
  `Prosla` tinyint DEFAULT NULL,
  `Ulog` double NOT NULL,
  PRIMARY KEY (`IdStavkaRulet`),
  UNIQUE KEY `IdStavkaRul_UNIQUE` (`IdStavkaRulet`),
  KEY `FK_TiketRulet_Rulet_idRul_idx` (`IdRulet`,`IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stavka_tiket`
--

DROP TABLE IF EXISTS `stavka_tiket`;
CREATE TABLE IF NOT EXISTS `stavka_tiket` (
  `IdTiketKladjenje` int NOT NULL,
  `IdUtakmica` int NOT NULL,
  `Iznos` double NOT NULL,
  `KonacanIshod` char(1) NOT NULL,
  `Status` int DEFAULT NULL,
  PRIMARY KEY (`IdTiketKladjenje`,`IdUtakmica`),
  KEY `FK_StavkaTiket_IdUtakmica_idx` (`IdUtakmica`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_kladjenje`
--

DROP TABLE IF EXISTS `tiket_kladjenje`;
CREATE TABLE IF NOT EXISTS `tiket_kladjenje` (
  `IdTiketKladjenje` int NOT NULL AUTO_INCREMENT,
  `IdKor` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Status` int DEFAULT NULL,
  PRIMARY KEY (`IdTiketKladjenje`),
  UNIQUE KEY `IdTiketKladjenje_UNIQUE` (`IdTiketKladjenje`),
  KEY `FK_TiketKladjenje_Korisnik_IdKorisnik_idx` (`IdKor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_lucky6`
--

DROP TABLE IF EXISTS `tiket_lucky6`;
CREATE TABLE IF NOT EXISTS `tiket_lucky6` (
  `IdKorisnik` int NOT NULL,
  `IdLucky6` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Kombinacija` varchar(20) NOT NULL,
  PRIMARY KEY (`IdKorisnik`,`IdLucky6`),
  KEY `FK_TiketLucky6_Lucky6_IdLucky6_idx` (`IdLucky6`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_rulet`
--

DROP TABLE IF EXISTS `tiket_rulet`;
CREATE TABLE IF NOT EXISTS `tiket_rulet` (
  `IdRulet` int NOT NULL,
  `IdKorisnik` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  PRIMARY KEY (`IdRulet`,`IdKorisnik`),
  KEY `FK_TiketRulet_Rulet_idKor_idx` (`IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tiket_slot`
--

DROP TABLE IF EXISTS `tiket_slot`;
CREATE TABLE IF NOT EXISTS `tiket_slot` (
  `IdTiketSlot` int NOT NULL AUTO_INCREMENT,
  `IdKorisnik` int NOT NULL,
  `Ulog` double NOT NULL,
  `Dobitak` double DEFAULT NULL,
  `Rezultat` varchar(20) NOT NULL,
  PRIMARY KEY (`IdTiketSlot`),
  UNIQUE KEY `idTiketSlot_UNIQUE` (`IdTiketSlot`),
  KEY `FK_TiketSlot_Korisnik_IdKor_idx` (`IdKorisnik`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tim`
--

DROP TABLE IF EXISTS `tim`;
CREATE TABLE IF NOT EXISTS `tim` (
  `IdTim` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  PRIMARY KEY (`IdTim`),
  UNIQUE KEY `idTim_UNIQUE` (`IdTim`),
  UNIQUE KEY `Ime_UNIQUE` (`Ime`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `utakmica`
--

DROP TABLE IF EXISTS `utakmica`;
CREATE TABLE IF NOT EXISTS `utakmica` (
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
  KEY `FK_Utakmica_Tim_IdGost_IdTim_idx` (`IdGost`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Table structure for table `zaposleni`
--

DROP TABLE IF EXISTS `zaposleni`;
CREATE TABLE IF NOT EXISTS `zaposleni` (
  `IdZaposleni` int NOT NULL AUTO_INCREMENT,
  `Ime` varchar(20) NOT NULL,
  `Prezime` varchar(20) NOT NULL,
  `Lozinka` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `KorisnickoIme` varchar(20) NOT NULL,
  `JMBG` char(13) NOT NULL,
  `Tip` int NOT NULL,
  PRIMARY KEY (`IdZaposleni`),
  UNIQUE KEY `idZap_UNIQUE` (`IdZaposleni`),
  UNIQUE KEY `KorisnickoIme_UNIQUE` (`KorisnickoIme`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`IdZaposleni`, `Ime`, `Prezime`, `Lozinka`, `KorisnickoIme`, `JMBG`, `Tip`) VALUES
(1, 'admin', 'admin', '$2y$10$3I4BljfwqNjG/ji.3/ZigOJ8/wM5aKEQFe7B6/28Ic2iVsYWKdsQG', 'admin', '0101999000000', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `stavka_rulet`
--
ALTER TABLE `stavka_rulet`
  ADD CONSTRAINT `FK_StavkaRulet_TiketRulet_IdTiketRul_IdKor` FOREIGN KEY (`IdRulet`,`IdKorisnik`) REFERENCES `tiket_rulet` (`IdRulet`, `IdKorisnik`);

--
-- Constraints for table `stavka_tiket`
--
ALTER TABLE `stavka_tiket`
  ADD CONSTRAINT `FK_StavkaTiket_IdTiketKladjenje` FOREIGN KEY (`IdTiketKladjenje`) REFERENCES `tiket_kladjenje` (`IdTiketKladjenje`),
  ADD CONSTRAINT `FK_StavkaTiket_IdUtakmica` FOREIGN KEY (`IdUtakmica`) REFERENCES `utakmica` (`IdUtakmica`);

--
-- Constraints for table `tiket_kladjenje`
--
ALTER TABLE `tiket_kladjenje`
  ADD CONSTRAINT `FK_TiketKladjenje_Korisnik_IdKorisnik` FOREIGN KEY (`IdKor`) REFERENCES `korisnik` (`IdKorisnik`);

--
-- Constraints for table `tiket_lucky6`
--
ALTER TABLE `tiket_lucky6`
  ADD CONSTRAINT `FK_TiketLucky6_Korisnik_IdKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`),
  ADD CONSTRAINT `FK_TiketLucky6_Lucky6_IdLucky6` FOREIGN KEY (`IdLucky6`) REFERENCES `lucky6` (`IdLucky6`);

--
-- Constraints for table `tiket_rulet`
--
ALTER TABLE `tiket_rulet`
  ADD CONSTRAINT `FK_TiketRulet_Rulet_idKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`),
  ADD CONSTRAINT `FK_TiketRulet_Rulet_idRul` FOREIGN KEY (`IdRulet`) REFERENCES `rulet` (`IdRulet`);

--
-- Constraints for table `tiket_slot`
--
ALTER TABLE `tiket_slot`
  ADD CONSTRAINT `FK_TiketSlot_Korisnik_IdKor` FOREIGN KEY (`IdKorisnik`) REFERENCES `korisnik` (`IdKorisnik`);

--
-- Constraints for table `utakmica`
--
ALTER TABLE `utakmica`
  ADD CONSTRAINT `FK_Utakmica_Tim_IdDomacin_IdTim` FOREIGN KEY (`IdDomacin`) REFERENCES `tim` (`IdTim`),
  ADD CONSTRAINT `FK_Utakmica_Tim_IdGost_IdTim` FOREIGN KEY (`IdGost`) REFERENCES `tim` (`IdTim`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
