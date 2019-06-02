-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 02 Cze 2019, 10:44
-- Wersja serwera: 10.1.38-MariaDB
-- Wersja PHP: 7.3.2

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
-- Struktura tabeli dla tabeli `raidsession`
--

CREATE TABLE `raidsession` (
  `id` int(11) NOT NULL,
  `tour` int(11) NOT NULL,
  `leaderId` int(11) NOT NULL,
  `userTwoId` int(11) NOT NULL,
  `userThreeId` int(11) NOT NULL,
  `userFourId` int(11) NOT NULL,
  `userFiveId` int(11) NOT NULL,
  `userOneHp` int(11) NOT NULL,
  `userTwoHp` int(11) NOT NULL,
  `userThreeHp` int(11) NOT NULL,
  `userFourHp` int(11) NOT NULL,
  `userFiveHp` int(11) NOT NULL,
  `currentFight` int(11) NOT NULL,
  `currentEnemyArmor` int(11) NOT NULL,
  `currentEnemyHp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `raidsession`
--
ALTER TABLE `raidsession`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `raidsession`
--
ALTER TABLE `raidsession`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
