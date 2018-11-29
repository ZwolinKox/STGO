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
-- Struktura tabeli dla tabeli `Guilds`
--

CREATE TABLE IF NOT EXISTS `guilds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `guildName` text COLLATE utf8_polish_ci NOT NULL,
  `guildSyntax` text COLLATE utf8_polish_ci  NOT NULL,
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

    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
  
 
