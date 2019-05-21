-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 21 Maj 2019, 23:00
-- Wersja serwera: 10.1.30-MariaDB
-- Wersja PHP: 7.2.1

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
-- Struktura tabeli dla tabeli `guilds`
--

CREATE TABLE `guilds` (
  `id` int(11) NOT NULL,
  `guildName` text COLLATE utf8_polish_ci NOT NULL,
  `guildSyntax` text COLLATE utf8_polish_ci NOT NULL,
  `guildOwner` int(11) NOT NULL,
  `guildPoints` int(11) NOT NULL,
  `guildMemberTwo` int(11) NOT NULL,
  `guildMemberThree` int(11) NOT NULL,
  `guildMemberFour` int(11) NOT NULL,
  `guildMemberFive` int(11) NOT NULL,
  `guildMemberSix` int(11) NOT NULL,
  `guildMemberSeven` int(11) NOT NULL,
  `guildMemberEight` int(11) NOT NULL,
  `guildMemberNine` int(11) NOT NULL,
  `guildMemberTen` int(11) NOT NULL,
  `guildBankSlyszCoin` int(11) NOT NULL,
  `guildBankSlotOne` int(11) NOT NULL,
  `guildBankSlotTwo` int(11) NOT NULL,
  `guildBankSlotThree` int(11) NOT NULL,
  `guildBankSlotFour` int(11) NOT NULL,
  `guildBankSlotFive` int(11) NOT NULL,
  `guildBankSlotSix` int(11) NOT NULL,
  `guildBankSlotSeven` int(11) NOT NULL,
  `guildBankSlotEight` int(11) NOT NULL,
  `guildBankSlotNine` int(11) NOT NULL,
  `guildBankSlotTen` int(11) NOT NULL,
  `guildLevel` int(255) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `guilds`
--


--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `guilds`
--
ALTER TABLE `guilds`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `guilds`
--
ALTER TABLE `guilds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
