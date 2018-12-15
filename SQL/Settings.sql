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
-- Struktura tabeli dla tabeli `Settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gameruleName` text COLLATE utf8_polish_ci NOT NULL,
  `levelCap` int(11) NOT NULL,
  `chanceCar` int(11) NOT NULL,
  `chanceDres` int(11) NOT NULL,
  `chanceKielich` int(11) NOT NULL,
  `chancePapa` int(11) NOT NULL,
  `chanceMocher` int(11) NOT NULL,
  `chanceSztanga` int(11) NOT NULL,
  `chanceZawiasy` int(11) NOT NULL,
  `chanceSchoolTrobule` int(11) NOT NULL,
  `chanceParkTrouble` int(11) NOT NULL,
  `chanceMinistrantTrouble` int(11) NOT NULL,
  `chanceGoldTrain` int(11) NOT NULL,
  `chanceLotekWin` int(11) NOT NULL,
  `chanceKomulacja` int(11) NOT NULL,
  `expLegs` int(11) NOT NULL,
  `expArms` int(11) NOT NULL,
  `jobPcRepair` int(11) NOT NULL,
  `deathItems` tinyint(1) NOT NULL,
  `deathLevel` tinyint(1) NOT NULL,
  `deathPvpItems` tinyint(1) NOT NULL,
  `deathPvpLevel` tinyint(1) NOT NULL,

PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

--
-- Zrzut danych tabeli `settings`
--

INSERT INTO `settigs` (`id`, `gameruleName`, `levelCap`, `chanceCar`, `chanceDres`, `chanceKielich`, `chancePapa`, `chanceMocher`, `chanceSztanga`, `chanceZawiasy`, `chanceSchoolTrobule`, `chanceParkTrouble`, `chanceMinistrantTrouble`, `chanceGoldTrain`, `chanceLotekWin`, `chanceKomulacja`, `expLegs`, `expArms`, `jobPcRepair`, `deathItems`, `deathLevel`, `deathPvpItems`, `deathPvpLevel` ) VALUES
(1, 'vanilla', 40, 10, 10, 1, 1, 10, 10, 100, 100, 100, 100, 1, 1, 1, 7500, 7500, 5000, 0, 0, 0, 0),
(2, 'hardcore', 40, 50, 50, 15, 15, 50, 50, 175, 175, 175, 175, 15, 15, 15, 8000, 8000, 6000, 1, 0, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

  
 
 
  
  
  
  
  
  