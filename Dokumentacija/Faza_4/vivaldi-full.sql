-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jun 05, 2021 at 07:38 PM
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
CREATE DATABASE IF NOT EXISTS `vivaldi` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `vivaldi`;

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`IdKorisnik`, `Ime`, `Prezime`, `Lozinka`, `KorisnickoIme`, `JMBG`, `BrojKartice`, `Tokeni`) VALUES
(1, 'Marko', 'Liske', '$2y$10$novkAILjM96d/XLkvzVCouYw493khCMQFng4CCkoO/1AZVfh5DPB.', 'foxy', '0202995000000', '1234567890123456', 840),
(2, 'Stefan', 'Luki', '$2y$10$4aBnbJoWqJ0bA6EzBMs/m.ItQuCTG.TuTuf8GpiBpAXXbDjY3Vi4W', 'kele', '0303990000000', '1234567890123456', 14),
(3, 'Marko', 'Glog', '$2y$10$2toCBq8hH/nF2TUh20ElK.nx1PF0h1Q5yWesbw30EW8Dq.HIYTIEO', 'gloz', '0303980000000', '1234567890123456', 1300),
(4, 'Nikola', 'Marinak', '$2y$10$EvUYA80Va/Hv0d4NemMJmuq79CCqOPzbuW3Sg3VDEvUCnkgbrVKjO', 'mrci', '0404998000000', '1234567890123456', 215);

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `lucky6`
--

INSERT INTO `lucky6` (`IdLucky6`, `IzvuceniBrojevi`, `Vreme`) VALUES
(1, '11,6,37,32,15,43,46,28,16,3,41,30,44,1,33,45,5,9,35,17,27,10,4,19,18,14,29,22,8,40,24,39,23,25,2,0', '2021-06-05 11:14:12'),
(2, '47,7,20,30,28,9,24,2,41,29,16,18,36,31,10,23,15,25,11,1,3,37,44,33,43,17,22,35,19,38,39,6,5,27,12,0', '2021-06-05 11:21:51'),
(3, '5,40,46,19,3,41,26,6,15,44,34,10,45,1,29,2,43,21,30,18,28,33,11,8,38,37,4,47,12,14,25,27,32,16,17,0', '2021-06-05 11:23:08');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rulet`
--

INSERT INTO `rulet` (`IdRulet`, `IzvucenBroj`, `Vreme`) VALUES
(1, 15, '2021-06-05 11:10:47'),
(2, 10, '2021-06-05 11:11:17'),
(3, 13, '2021-06-05 11:12:17'),
(4, 9, '2021-06-05 02:17:49'),
(5, 15, '2021-06-05 02:18:19'),
(6, 17, '2021-06-05 02:18:49'),
(7, 15, '2021-06-05 02:19:19');

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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `stavka_rulet`
--

INSERT INTO `stavka_rulet` (`IdStavkaRulet`, `IdKorisnik`, `IdRulet`, `Tip`, `Prosla`, `Ulog`) VALUES
(1, 2, 1, '29', 0, 4),
(2, 2, 1, '1 to 18', 1, 6),
(3, 2, 2, '0', 0, 5),
(4, 2, 2, '4', 0, 5),
(5, 2, 2, '5', 0, 5),
(6, 2, 2, '3rd12', 0, 10),
(7, 2, 3, 'Black', 1, 15),
(8, 4, 4, '5', 0, 7),
(9, 4, 4, '17', 0, 5),
(10, 4, 4, '3rd12', 0, 8),
(11, 4, 5, '2 to 1 a', 1, 15),
(12, 4, 5, '1st12', 0, 15),
(13, 4, 6, '11', 0, 5),
(14, 4, 6, '20', 0, 10),
(15, 4, 6, '1st12', 0, 10),
(16, 4, 6, '3rd12', 0, 10),
(17, 4, 7, '11', 0, 10),
(18, 4, 7, '29', 0, 5),
(19, 4, 7, '2 to 1 a', 1, 15),
(20, 4, 7, '2 to 1 c', 0, 10);

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

--
-- Dumping data for table `stavka_tiket`
--

INSERT INTO `stavka_tiket` (`IdTiketKladjenje`, `IdUtakmica`, `Iznos`, `KonacanIshod`, `Status`) VALUES
(1, 3, 0, '1', 2),
(1, 6, 0, '1', 1),
(1, 8, 0, 'X', 2),
(2, 1, 0, 'X', 0),
(3, 8, 0, '1', 1),
(4, 1, 0, '1', 0),
(4, 2, 0, '2', 0),
(4, 3, 0, '2', 1),
(5, 6, 0, 'X', 2),
(6, 4, 0, '1', 0),
(6, 8, 0, '1', 1),
(6, 9, 0, '1', 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tiket_kladjenje`
--

INSERT INTO `tiket_kladjenje` (`IdTiketKladjenje`, `IdKor`, `Ulog`, `Dobitak`, `Status`) VALUES
(1, 2, 300, 0, 1),
(2, 2, 50, 3, 0),
(3, 2, 70, 0, 1),
(4, 3, 350, 0, 1),
(5, 3, 100, 350, 2),
(6, 3, 600, 0, 1);

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

--
-- Dumping data for table `tiket_lucky6`
--

INSERT INTO `tiket_lucky6` (`IdKorisnik`, `IdLucky6`, `Ulog`, `Dobitak`, `Kombinacija`) VALUES
(1, 2, 100, 0, '44,26,18,21,22,30'),
(1, 3, 200, 0, '11,12,13,46,47,48'),
(2, 1, 50, 0, '19,20,28,36,32,24');

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

--
-- Dumping data for table `tiket_rulet`
--

INSERT INTO `tiket_rulet` (`IdRulet`, `IdKorisnik`, `Ulog`, `Dobitak`) VALUES
(1, 2, 10, 12),
(2, 2, 25, 0),
(3, 2, 15, 30),
(4, 4, 20, 0),
(5, 4, 30, 45),
(6, 4, 35, 0),
(7, 4, 40, 45);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tiket_slot`
--

INSERT INTO `tiket_slot` (`IdTiketSlot`, `IdKorisnik`, `Ulog`, `Dobitak`, `Rezultat`) VALUES
(1, 2, 10, 0, '2,4,7'),
(2, 2, 16, 0, '2,1,5'),
(3, 2, 16, 0, '4,5,1'),
(4, 2, 13, 0, '3,2,2'),
(5, 2, 3, 0, '1,6,3'),
(6, 2, 50, 100, '5,6,7'),
(7, 1, 15, 0, '1,0,5'),
(8, 1, 60, 120, '5,7,5'),
(9, 1, 63, 126, '5,6,7'),
(10, 1, 60, 120, '5,6,7'),
(11, 1, 20, 0, '2,3,0'),
(12, 1, 8, 0, '4,3,1');

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tim`
--

INSERT INTO `tim` (`IdTim`, `Ime`) VALUES
(4, 'Borac'),
(2, 'Crvena Zvezda'),
(3, 'Hajduk'),
(1, 'Partizan'),
(5, 'Spartak');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `utakmica`
--

INSERT INTO `utakmica` (`IdUtakmica`, `Rezultat`, `Vreme`, `IdDomacin`, `IdGost`, `KvotaX`, `Kvota1`, `Kvota2`) VALUES
(1, '0', '2021-06-20 17:54:00', 1, 2, 3, 2, 2),
(2, '0', '2021-06-15 17:55:00', 5, 4, 1.3, 1.2, 5),
(3, '1', '2021-06-01 17:55:00', 3, 2, 1.3, 2, 3),
(4, '0', '2021-06-21 17:56:00', 4, 1, 2, 3, 3),
(5, '0', '2021-06-05 17:57:00', 4, 3, 1.5, 2, 2.4),
(6, 'X', '2021-06-04 18:00:00', 2, 5, 3.5, 4, 1.5),
(7, '0', '2021-06-10 18:06:00', 2, 4, 6, 2, 3.8),
(8, 'X', '2021-06-02 18:07:00', 5, 3, 10, 5, 2),
(9, '1', '2021-06-01 18:07:00', 1, 5, 7.8, 2.4, 3.6);

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `zaposleni`
--

INSERT INTO `zaposleni` (`IdZaposleni`, `Ime`, `Prezime`, `Lozinka`, `KorisnickoIme`, `JMBG`, `Tip`) VALUES
(1, 'admin', 'admin', '$2y$10$3I4BljfwqNjG/ji.3/ZigOJ8/wM5aKEQFe7B6/28Ic2iVsYWKdsQG', 'admin', '0101999000000', 1),
(2, 'Tamara', 'Sekularac', '$2y$10$bfEyXQ5LtDd6aGjSJn5BNesa4A5TOMcAgg92zt9SYhUH/QPm9RYIG', 'tasha', '0505994000000', 0),
(3, 'Drazen', 'Draskovic', '$2y$10$2C.qf9YwoBuyex0BLvOnWui/mC4govcPlmQ2mH7Ss5hT//.FItrki', 'draza', '0606996000000', 0),
(4, 'Dragan', 'Bojic', '$2y$10$DPoR6dEm1EDxnw63QGMYB.UcXjqBeGOLJjWtc1HYtMXcsOv6qwjL.', 'gagi', '0707980000000', 1);

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
