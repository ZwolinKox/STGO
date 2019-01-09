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
-- Struktura tabeli dla tabeli `Enemy`
--

CREATE TABLE IF NOT EXISTS `enemy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` text COLLATE utf8_polish_ci NOT NULL,
  `rarity` text COLLATE utf8_polish_ci NOT NULL,
  `enemyLevel` int(11) NOT NULL,
  `enemyHp` int(11) NOT NULL,
  `enemyDamage` int(11) NOT NULL,
  `enemyArmor` int (11) NOT NULL,
  `dropXp` int(11) NOT NULL,
  `dropSlyszCoin` int(11) NOT NULL,
  `dropItemOne` int(11) NOT NULL,
  `dropItemTwo` int(11) NOT NULL,
  `dropItemThree` int(11) NOT NULL,
  `dropItemFour` int(11) NOT NULL,
  `dropItemFive` int(11) NOT NULL,
  `dropItemSix` int(11) NOT NULL,
  `dropItemSeven` int(11) NOT NULL,
  `dropItemEight` int(11) NOT NULL,
  `dropItemNine` int(11) NOT NULL,
  `dropItemTen` int(11) NOT NULL,
  `dropItemEleven` int(11) NOT NULL,
  `dropItemTwelve` int(11) NOT NULL,
  `dropItemThirteen` int(11) NOT NULL,
  `dropItemFourteen` int(11) NOT NULL,
  `dropItemFifteen` int(11) NOT NULL,

  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

