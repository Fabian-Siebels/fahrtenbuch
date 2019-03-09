
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `fahrtenbuch`
--
CREATE DATABASE IF NOT EXISTS `fahrtenbuch` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `fahrtenbuch`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `fahrtenbuchtbl`
--

CREATE TABLE IF NOT EXISTS `fahrtenbuchtbl` (
`id` int(11) NOT NULL,
  `gefahren` varchar(255) CHARACTER SET latin1 NOT NULL,
  `datum` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hin` int(11) NOT NULL,
  `zurueck` int(11) NOT NULL,
  `nicht` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `fahrtenbuchtbl`
--
ALTER TABLE `fahrtenbuchtbl`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `fahrtenbuchtbl`
--
ALTER TABLE `fahrtenbuchtbl`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
