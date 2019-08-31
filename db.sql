-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 19, 2018 at 03:10 PM
-- Server version: 5.5.47-0+deb6u1
-- PHP Version: 5.4.36-0+deb7u1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `bbk_burza`
--
-- CREATE DATABASE IF NOT EXISTS `bbk_burza` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `bbk_burza`;

-- --------------------------------------------------------

--
-- Table structure for table `Info`
--

CREATE TABLE IF NOT EXISTS `Info` (
  `ID` int(11) NOT NULL DEFAULT '0',
  `Info_o` varchar(15) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Polozky`
--

CREATE TABLE IF NOT EXISTS `Polozky` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Cislo` varchar(20) COLLATE utf8_bin DEFAULT NULL,
  `UserID` int(10) unsigned NOT NULL,
  `Cena` double NOT NULL,
  `Druh` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `Popis` varchar(100) COLLATE utf8_bin NOT NULL,
  `Velkost` int(10) unsigned NOT NULL,
  `IDBurzy` int(10) unsigned DEFAULT '15',
  `Predane` tinyint(1) DEFAULT NULL,
  `BarCode` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  `BarCodeWSUM` varchar(9) COLLATE utf8_bin DEFAULT NULL,
  `Naskladnene` tinyint(4) NOT NULL DEFAULT '0',
  `Vyskladnene` int(11) NOT NULL DEFAULT '0',
  `Pridane` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Vytlacene` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `Cislo` (`Cislo`,`IDBurzy`),
  UNIQUE KEY `BarCodeUnique` (`BarCode`),
  UNIQUE KEY `BCwS` (`BarCodeWSUM`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21166 ;

-- --------------------------------------------------------

--
-- Table structure for table `Stitky`
--

CREATE TABLE IF NOT EXISTS `Stitky` (
  `ID` varchar(10) COLLATE utf8_bin NOT NULL,
  `CENA` varchar(255) COLLATE utf8_bin NOT NULL,
  `OPIS` varchar(255) COLLATE utf8_bin NOT NULL,
  `Processed` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Table structure for table `Users`
--

CREATE TABLE IF NOT EXISTS `Users` (
  `ID` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `PoslatTeraz` tinyint(11) NOT NULL DEFAULT '0',
  `LoginStr` varchar(100) COLLATE utf8_bin NOT NULL,
  `Name` varchar(128) COLLATE utf8_bin DEFAULT NULL,
  `Mail` varchar(255) COLLATE utf8_bin NOT NULL,
  `Kontakt` varchar(30) COLLATE utf8_bin DEFAULT NULL,
  `Provizia` int(11) NOT NULL DEFAULT '1',
  `info` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `isActive` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID`),
  UNIQUE KEY `LoginStr` (`LoginStr`),
  UNIQUE KEY `Mail` (`Mail`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=145 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
