-- phpMyAdmin SQL Dump
-- version 4.8.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 16 Sty 2019, 21:57
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
-- Struktura tabeli dla tabeli `items`
--

CREATE TABLE `items` (
  `id` int(11) NOT NULL,
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
  `vendorCost` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `items`
--

INSERT INTO `items` (`id`, `itemType`, `name`, `addStrenght`, `addIntelect`, `addDex`, `addArmor`, `addDamage`, `dropChance`, `rarity`, `forLevel`, `forClass`, `vendorCost`) VALUES
(1, '0', 'Patyk', 5, 0, 0, 0, 5, 0, 'common', 1, 'woj', 10),
(2, '0', 'Puszka', 0, 5, 0, 0, 5, 0, 'common', 1, 'mag', 10),
(3, '0', 'Ostry patyk', 5, 0, 0, 0, 20, 0, 'common', 2, 'woj', 20),
(4, 'o', 'Zgnieciona puszka', 0, 5, 0, 0, 20, 0, 'common', 2, 'mag', 20),
(5, '0', 'Plastikowy widelec', 5, 0, 0, 0, 30, 0, 'common', 5, 'woj', 50),
(6, '0', 'Zabawkowy kostur', 0, 5, 0, 0, 30, 0, 'common', 5, 'mag', 50),
(7, '0', 'Butelka CocaCola', 5, 0, 0, 0, 65, 0, 'common', 7, 'woj', 70),
(8, '0', 'Butelka Pepsi', 0, 5, 0, 0, 65, 0, 'common', 7, 'mag', 70),
(9, '0', 'Plastikowy miecz', 5, 0, 0, 0, 80, 0, 'commmon', 10, 'woj', 80),
(10, '0', 'Plastikowa różdżka', 0, 5, 0, 0, 80, 0, 'common', 10, 'mag', 100),
(11, '0', 'Ekierka', 10, 0, 0, 0, 120, 0, 'common', 12, 'woj', 120),
(12, '0', 'Kreda', 0, 10, 0, 0, 120, 0, 'common', 12, 'mag', 120),
(13, '0', 'Linijka', 10, 0, 0, 0, 175, 0, 'common', 15, 'woj', 150),
(14, '0', 'Figura geometryczna', 0, 10, 0, 0, 175, 0, 'common', 15, 'mag', 150),
(15, '0', 'Ram Mojżesza', 10, 0, 0, 0, 210, 0, 'common', 18, 'woj', 150),
(16, '0', 'Dysk Mojżesza', 0, 10, 0, 0, 210, 0, 'common', 18, 'mag', 180),
(17, '0', 'Piórnik', 10, 0, 0, 0, 250, 0, 'common', 20, 'woj', 200),
(18, '0', 'Reklamówka', 0, 10, 0, 0, 250, 0, 'common', 20, 'mag', 200),
(19, '0', 'Nóż do masła', 10, 0, 0, 0, 280, 0, 'common', 23, 'woj', 230),
(20, '0', 'Zamek z bluzy', 0, 10, 0, 0, 280, 0, 'common', 23, 'mag', 230),
(21, '0', 'Cyrkiel', 10, 0, 0, 0, 320, 0, 'common', 25, 'woj', 250),
(22, '0', 'Kątomierz', 0, 10, 0, 0, 320, 0, 'common', 25, 'mag', 250),
(23, '0', 'Prawie prawdziwy miecz', 10, 0, 0, 0, 360, 0, 'common', 27, 'woj', 270),
(24, '0', 'Prawie prawdziwa różdżka', 0, 10, 0, 0, 360, 0, 'common', 27, 'mag', 270),
(25, '0', 'Prawdziwy miecz', 10, 0, 0, 0, 400, 0, 'common', 30, 'woj', 300),
(26, '0', 'Prawdziwa różdżka', 0, 10, 0, 0, 400, 0, 'common', 30, 'mag', 300),
(27, '0', 'Kij baseballowy', 15, 0, 0, 0, 410, 0, 'common', 30, 'woj', 400),
(28, '0', 'Znak drogowy', 0, 15, 0, 0, 410, 0, 'common', 30, 'mag', 400),
(29, '0', 'Niejednoznaczny miecz', 20, 0, 0, 0, 450, 0, 'common', 30, 'woj', 500),
(30, '0', 'Magia w proszku', 0, 20, 0, 0, 450, 0, 'common', 30, 'mag', 500);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `items`
--
ALTER TABLE `items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
