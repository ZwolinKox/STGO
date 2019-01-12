-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 28 Lis 2018, 11:22
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `STGO`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Items`
--

CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `itemType` text COLLATE utf8_polish_ci NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `addStrenght` int(11) NOT NULL,
  `addIntelect` int(11) NOT NULL,
  `addDex` int(11) NOT NULL, 
  `addArmor` int(11) NOT NULL,
  `addDamage` int(11) NOT NULL,
  `dropChance` int(11) NOT NULL,
  `rarity` text COLLATE utf8_polish_ci NOT NULL,
  `forLevel` int(11) NOT NULL,
  `forClass` text COLLATE utf8_polish_ci NOT NULL,
  `vendorCost` int(11) NOT NULL,
    
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`id`, `itemtype`, `name`, `addStrenght`, `addIntelect`, `addDex`, `addArmor`, `addDamage`, `dropChance`, `rarity`, `forLevel`, `forClass`, `vendorCost`) VALUES


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
