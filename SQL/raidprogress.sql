-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Maj 2019, 11:23
-- Wersja serwera: 10.1.39-MariaDB
-- Wersja PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `stgo`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `raidprogress`
--

CREATE TABLE `raidprogress` (
  `id` int(11) NOT NULL,
  `userIdOne` int(11) NOT NULL,
  `userIdTwo` int(11) NOT NULL,
  `userIdThree` int(11) NOT NULL,
  `userIdFour` int(11) NOT NULL,
  `userIdFive` int(11) NOT NULL,
  `raidId` int(11) NOT NULL,
  `lastEnemy` int(11) NOT NULL,
  `lastFight` datetime NOT NULL,
  `isFinished` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
