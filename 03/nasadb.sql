-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ott 04, 2020 alle 16:49
-- Versione del server: 10.4.14-MariaDB
-- Versione PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasadb`
--

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `truncateAll` ()  BEGIN
	TRUNCATE TABLE events;
	TRUNCATE TABLE news;
	TRUNCATE TABLE small_news;
	SET FOREIGN_KEY_CHECKS=0;
	TRUNCATE TABLE mission_link;
	SELECT sleep(2);
	TRUNCATE TABLE mission;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `action` varchar(20) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `events`
--

INSERT INTO `events` (`id`, `action`, `date`, `content`) VALUES
(1, '', '2019-10-09', 'tiam vitae eros vel sem tristique eleifend nec quis mauris.'),
(2, 'Registration Close', '1970-01-01', 'Curabitur vehicula, elit a faucibus cursus, massa eros consequat magna, et cursus nulla leo nec metus.'),
(3, '', '2025-06-03', 'Duis eleifend augue at iaculis cursus. In at mi vitae orci aliquam porta sed quis lorem. Integer malesuada tellus placerat, tempus sem sed, tristique magna.'),
(4, '', '2016-09-07', 'Construction of the test craft is proceeding apace founder and CEO Elon Musk reveal.'),
(5, '', '2016-09-08', 'All is well on our largest neighbor; NASA\'s Juno spacecraft just managed to spot the shadow of Jupiter\'s moon.'),
(6, 'Registration Open', '1970-01-01', 'As NASA makes a big push to land humans on the moon\'s surface by 2024, the European Space Agency (ESA) wants to learn more about the lunar caves that lie beneath.');

-- --------------------------------------------------------

--
-- Struttura della tabella `mission`
--

CREATE TABLE `mission` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `action` varchar(20) NOT NULL,
  `date` date NOT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `mission`
--

INSERT INTO `mission` (`id`, `title`, `imgurl`, `action`, `date`, `content`) VALUES
(1, 'Ut id eros eros. ', 'https://www.ready.gov/sites/default/files/2019-09/volcano.jpg', 'Exploding ', '1990-03-05', 'Nunc eu tincidunt tellus, a maximus diam. Etiam vel gravida massa, vel vulputate est. Integer ac vehicula sapien. Nulla sit amet rhoncus dolor, eget imperdiet tellus.'),
(2, 'NASA to Launch First US Asteroid Sample Return Mission', 'img/mission/landscape.jpg', 'Launching', '2016-09-08', 'OSIRIS-REx will travel to a near-Earth asteroid called Bennu and bring a small sample back to Earth for study');

-- --------------------------------------------------------

--
-- Struttura della tabella `mission_link`
--

CREATE TABLE `mission_link` (
  `id` int(11) NOT NULL,
  `mission_id` int(11) NOT NULL,
  `text` varchar(50) NOT NULL,
  `url` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `mission_link`
--

INSERT INTO `mission_link` (`id`, `mission_id`, `text`, `url`) VALUES
(1, 1, 'Sed tincidunt sagittis felis.', '#'),
(2, 1, 'Mauris fermentum orci', '#'),
(3, 1, 'Praesent iaculis', '#'),
(4, 1, 'Nunc nulla sapien', '#'),
(5, 2, 'Mission Site', '#'),
(6, 2, 'Briefing Schedule', '#'),
(7, 2, 'Launch Updates', '#'),
(8, 2, 'Video To Bennu and Back', '#');

-- --------------------------------------------------------

--
-- Struttura della tabella `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `content` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `news`
--

INSERT INTO `news` (`id`, `title`, `imgurl`, `content`) VALUES
(1, 'Water found on mars', 'https://imgix.bustle.com/uploads/image/2019/12/12/ee2767b6-fd1e-4cc8-90fc-1a7c4711a14d-water-mars.jpg', 'NASA has been looking into the possibility of water on our interplanetary neighbor Mars, as there have been intriguing finds over the years, such as water trapped within Mars\' north and south polar ic'),
(2, 'Found planet orbiting a Black hole', 'https://static.wikia.nocookie.net/interstellarfilm/images/9/9b/Black_hole.png/revision/latest/smart/width/200/height/200?cb=20150322005003', 'Tens of thousands of planets like Earth and Neptune might orbit the giant black hole at the center of the Milky Way'),
(3, 'SpaceX\'s Next Starship Prototype Taking Shape ', 'img/news/park1.jpg', 'Construction of the test craft is proceeding apace, as two new photos posted on Twitter today (Sept. 17) by company founder and CEO Elon Musk reveal.'),
(4, 'NASA\'s Juno Mission Cheks Out Eclipse on Jupiter', 'img/news/park2.jpg', 'All is well on our largest neighbor; NASA\'s Juno spacecraft just managed to spot the shadow of Jupiter\'s moon, Io, passing over its marbled clouds.'),
(5, 'Europe Wants Ideas for Cave-Spelumking Moon Robots', 'img/news/park3.jpg', 'As NASA makes a big push to land humans on the moon\'s surface by 2024, the European Space Agency (ESA) wants to learn more about the lunar caves that lie beneath.');

-- --------------------------------------------------------

--
-- Struttura della tabella `small_news`
--

CREATE TABLE `small_news` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `imgurl` varchar(255) NOT NULL,
  `content` varchar(200) NOT NULL,
  `extended_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `small_news`
--

INSERT INTO `small_news` (`id`, `title`, `imgurl`, `content`, `extended_content`) VALUES
(1, 'Duis eleifend augue', 'https://images.theconversation.com/files/109822/original/image-20160201-32240-8oqf5e.jpg', 'Class aptent taciti sociosqu ad litora torquent per conubia nostra.', 'Quisque urna dui, interdum et fringilla id, porttitor a mauris. Maecenas vehicula id urna non convallis. Vestibulum molestie nibh eu tellus sagittis pretium. Pellentesque pulvinar mauris mollis sapien vehicula posuere.'),
(2, 'Expedition 48', 'img/small_news/face.jpg', 'NASA\'s Record-breaking Astronaut and Crewmates Safely Return to Earth', 'Fusce eros mauris, luctus a nunc in enim. Nullam sit amet ante placerat, consequat mi vel, finibus ex. Maecenas non diam ut mauris auctor tempus. In vestibulum, nulla et rutrum dapibus, eros mauris malesuada. Cras fermentum lorem eros, sit amet suscipit metus dictum sit amet.');

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`id`, `username`, `password`) VALUES
(1, 'test', '560e912f47956097ae088c44b6a21b4d6ed5021ad1d753d7e3f9ac09bbca0d62');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mission`
--
ALTER TABLE `mission`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `mission_link`
--
ALTER TABLE `mission_link`
  ADD PRIMARY KEY (`id`),
  ADD KEY `mission_id` (`mission_id`) USING BTREE;

--
-- Indici per le tabelle `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `small_news`
--
ALTER TABLE `small_news`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT per la tabella `mission`
--
ALTER TABLE `mission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `mission_link`
--
ALTER TABLE `mission_link`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `small_news`
--
ALTER TABLE `small_news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `mission_link`
--
ALTER TABLE `mission_link`
  ADD CONSTRAINT `mission_link_ibfk_1` FOREIGN KEY (`mission_id`) REFERENCES `mission` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
