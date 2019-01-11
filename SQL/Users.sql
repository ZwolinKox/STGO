-- phpMyAdmin SQL Dump
-- version 4.1.6
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 27 Lis 2018, 10:30
-- Server version: 5.5.36
-- PHP Version: 5.4.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


-- Database: `STGO`


-- --------------------------------------------------------


-- Struktura tabeli dla tabeli `Users`


CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `username` text COLLATE utf8_polish_ci NOT NULL,
  `dayWeek` int(11) NOT NULL,
  `dayGame` int(11) NOT NULL,
  `slyszCoin` int(11) NOT NULL,
  `xpPoints` int(11) NOT NULL,
  `userLevel` int(11) NOT NULL,
  `userLeaguePoints` int(11) NOT NULL,
  `userEnergy` int(11) NOT NULL,
  `statStrength` int(11) NOT NULL,
  `statIntelect` int(11) NOT NULL,
  `statDex` int(11) NOT NULL,
  `statArmor` int(11) NOT NULL,
  `statHp` int(11) NOT NULL,
  `statDamage` int(11) NOT NULL,
  `statToAdd` int(11) NOT NULL,
  `statCritChance` int(11) NOT NULL,
  `luck` int(11) NOT NULL,
  `eqMainHand` int(11) NOT NULL,
  `eqOffHand` int(11) NOT NULL,
  `eqArmor` int(11) NOT NULL,
  `eqNeck` int(11) NOT NULL,
  `eqSlotOne` int(11) NOT NULL,
  `eqSlotTwo` int(11) NOT NULL,
  `eqSlotThree` int(11) NOT NULL,
  `eqSlotFour` int(11) NOT NULL,
  `eqSlotFive` int(11) NOT NULL,
  `eqSlotSix` int(11) NOT NULL,
  `eqSlotSeven` int(11) NOT NULL,
  `eqSlotEight` int(11) NOT NULL,
  `maxHp` int(11) NOT NULL,
  `maxEnergy` int(11) NOT NULL,
  `maxXp` int(11) NOT NULL,
  `boolLotek` tinyint(1) NOT NULL,
  `boolChurch` tinyint(1) NOT NULL,
  `boolSchool` tinyint(1) NOT NULL,
  `boolSchoolBan` tinyint(1) NOT NULL,
  `boolVest` tinyint(1) NOT NULL,
  `banCheck` tinyint(1) NOT NULL,
  `banInfo` text COLLATE utf8_polish_ci NOT NULL,
  `nickCol` int(11) NOT NULL,
  `team` int(11) NOT NULL,
  `boolGuild` tinyint(1) NOT NULL,
  `guildName` text COLLATE utf8_polish_ci NOT NULL,
  
  
  
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
