-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Mar 2019, 14:31
-- Wersja serwera: 10.1.33-MariaDB
-- Wersja PHP: 7.2.6

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
-- Struktura tabeli dla tabeli `enemy`
--

CREATE TABLE `enemy` (
  `id` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `type` text COLLATE utf8_polish_ci NOT NULL,
  `rarity` text COLLATE utf8_polish_ci NOT NULL,
  `enemyLevel` int(11) NOT NULL,
  `enemyHp` int(11) NOT NULL,
  `enemyDamage` int(11) NOT NULL,
  `enemyArmor` int(11) NOT NULL,
  `dropXp` int(11) NOT NULL,
  `dropSlyszCoin` int(11) NOT NULL,
  `dropItemOne` int(11) NOT NULL,
  `dropItemTwo` int(11) NOT NULL,
  `dropItemThree` int(11) NOT NULL,
  `dropItemFour` int(11) NOT NULL,
  `dropItemFive` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `enemy`
--

INSERT INTO `enemy` (`id`, `name`, `type`, `rarity`, `enemyLevel`, `enemyHp`, `enemyDamage`, `enemyArmor`, `dropXp`, `dropSlyszCoin`, `dropItemOne`, `dropItemTwo`, `dropItemThree`, `dropItemFour`, `dropItemFive`) VALUES
(1, 'Elektryk', 'standard', 'common', 5, 25, 8, 10, 20, 5, 31, 32, 33, 34, 35),
(2, 'Elektronik', 'standard', 'common', 10, 150, 15, 50, 20, 5, 31, 32, 33, 34, 36),
(3, 'Mechatronik', 'standard', 'common', 15, 200, 20, 100, 40, 10, 37, 38, 39, 40, 41),
(4, 'Informatyk', 'standard', 'common', 20, 400, 25, 150, 40, 10, 37, 38, 39, 40, 42),
(5, 'Energia odnawialna', 'standard', 'common', 25, 600, 30, 300, 60, 20, 43, 44, 45, 46, 47),
(6, 'Mechanik', 'standard', 'common', 30, 800, 35, 550, 60, 20, 43, 44, 45, 46, 48);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `enemy`
--
ALTER TABLE `enemy`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `enemy`
--
ALTER TABLE `enemy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
