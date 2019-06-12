-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 12 Cze 2019, 21:29
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
-- Struktura tabeli dla tabeli `legendarypassives`
--

CREATE TABLE `legendarypassives` (
  `id` int(11) NOT NULL,
  `chance` int(11) NOT NULL,
  `name` text COLLATE utf8_polish_ci NOT NULL,
  `description` text COLLATE utf8_polish_ci NOT NULL,
  `itemDescription` text COLLATE utf8_polish_ci NOT NULL,
  `itemId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `legendarypassives`
--

INSERT INTO `legendarypassives` (`id`, `chance`, `name`, `description`, `itemDescription`, `itemId`) VALUES
(1, 5, 'Klątwa palca Pawła', '5% szans na zadanie przeciwnikowi obrażeń równych 10% jego maksymalnego życia', 'Za młodu Paweł był kąpany przez swoją matkę w kociołku \"Browara Raciborskiego\". To umocniło jego ciało jak i pozwoliło mu w przyszłości umocnić swoją pozycję w niebiańskich oddziałach Lil Piszczana. Jednak trzymała ona go za duży palec u stopy, żeby nie wpadł do środka. Z tego powodu ten palec stał się jego słabym punktem, co po kilku przegranych spowodowanych nadepnięciem na niego doprowadziło Pawła do dramatycznej decyzji. Odciął on swój palec i wrzucił do żwirowni. Legenda głosi, że posiadacz tego palca wzmocni dzięki niemu swoje moce bojowe. Jesteś godzien go przy sobie nosić?', 57),
(2, 7, 'Dotyk Konona', '7% szansa na wyleczenie ran w wysokości 6% twojego maksymalnego życia podczas zadawania ciosu', 'Wojtek w dzieciństwie był ambitnym i inteligentnym chłopcem. Podobały mu się dziewczyny z czym nigdy się nie krył. Dostał się do dobrej szkoły, wszyscy wróżyli mu świetlaną przyszłość. Jednak gdy szukał paliwa do kosiarki znalazł tajemniczy trunek schowany pomiędzy oponami w garażu. Na pojemniku widniał tylko rozmazany napis \"NITRO\". Chcąc sprawdzić co to jest Wojtek powąchał ciecz. Przeszedł go dreszcz, zaczęło mu się kręcić w głowie. Odłożył specyfik i wrócił do domu. Niedługo zauważył, że jak komuś walnął w cymbał to spadał z wersalki. Uświadomił sobie, że wąchanie rozpuszczalnika dodaje mu siły. Jednak miało to swoją cenę, tracił iq wraz z przyrostem siły. Ostatecznie osiągnął dzięki niemu boską formę. Chcesz spróbować tego specyfiku?', 58);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `legendarypassives`
--
ALTER TABLE `legendarypassives`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `legendarypassives`
--
ALTER TABLE `legendarypassives`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
