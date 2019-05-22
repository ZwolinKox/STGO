-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 22 Maj 2019, 17:07
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
(2, 'Elektryk zdolny', 'standard', 'common', 7, 50, 10, 12, 20, 5, 31, 32, 33, 34, 35),
(3, 'Elektronik', 'standard', 'common', 10, 150, 15, 50, 20, 5, 31, 32, 33, 34, 36),
(4, 'Elektronik zdolny', 'standard', 'common', 12, 180, 17, 80, 20, 5, 31, 32, 33, 34, 36),
(5, 'Mechatronik', 'standard', 'common', 15, 200, 20, 100, 40, 10, 37, 38, 39, 40, 41),
(6, 'Mechatronik zdolny', 'standard', 'common', 17, 250, 22, 120, 40, 10, 37, 38, 39, 40, 41),
(7, 'Informatyk', 'standard', 'common', 20, 400, 25, 150, 40, 10, 37, 38, 39, 40, 42),
(8, 'Informatyk zdolny', 'standard', 'common', 22, 420, 28, 200, 40, 10, 37, 38, 39, 40, 42),
(9, 'Energia odnawialna', 'standard', 'common', 25, 600, 30, 300, 60, 20, 43, 44, 45, 46, 47),
(10, 'Energia odnawialna zdolny', 'standard', 'common', 27, 700, 32, 400, 60, 20, 43, 44, 45, 46, 47),
(11, 'Mechanik', 'standard', 'common', 30, 800, 35, 550, 60, 20, 43, 44, 45, 46, 48),
(12, 'Mechanik zdolny', 'standard', 'common', 30, 900, 40, 600, 60, 20, 43, 44, 45, 46, 48);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
