-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 14 dec 2015 om 09:25
-- Serverversie: 5.6.21
-- PHP-versie: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `school`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ts_companies`
--

CREATE TABLE IF NOT EXISTS `ts_companies` (
`id` int(5) NOT NULL,
  `name` varchar(60) NOT NULL,
  `image` blob NOT NULL,
  `location` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ts_tickets`
--

CREATE TABLE IF NOT EXISTS `ts_tickets` (
`id` int(10) unsigned NOT NULL,
  `subject` varchar(100) NOT NULL,
  `message` longtext NOT NULL,
  `department` varchar(100) NOT NULL,
  `priority` int(1) NOT NULL,
  `email` varchar(100) NOT NULL,
  `status` int(1) NOT NULL,
  `published` datetime NOT NULL,
  `user` int(5) NOT NULL,
  `working_on` int(5) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ts_tickets`
--

INSERT INTO `ts_tickets` (`id`, `subject`, `message`, `department`, `priority`, `email`, `status`, `published`, `user`, `working_on`) VALUES
(3, 'asdsadAlwin', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:30', 1, NULL),
(4, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:54', 1, NULL),
(5, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:57', 1, NULL),
(6, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:54:00', 1, NULL),
(7, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 2, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:44:45', 1, NULL),
(8, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 2, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:45:20', 1, NULL),
(9, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:45:39', 1, NULL),
(10, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:46:42', 1, NULL),
(11, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:47:10', 1, NULL),
(12, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:47:31', 1, NULL),
(13, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:48:44', 1, NULL),
(14, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:48:47', 1, NULL),
(15, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:49:09', 1, NULL),
(16, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:49:23', 1, NULL),
(17, 'asdsadalwin', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-12-04 16:49:36', 1, NULL);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `ts_users`
--

CREATE TABLE IF NOT EXISTS `ts_users` (
`id` int(5) unsigned NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `firstname` varchar(40) NOT NULL,
  `lastname` varchar(40) NOT NULL,
  `tickets` int(10) NOT NULL,
  `role` int(1) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ts_users`
--

INSERT INTO `ts_users` (`id`, `username`, `password`, `firstname`, `lastname`, `tickets`, `role`) VALUES
(1, 'alwintje', '6c8bbdec29b23a0218b2c6ba8b9f48f1', 'Alwin', 'Kroesen', 0, 2);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `ts_companies`
--
ALTER TABLE `ts_companies`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ts_tickets`
--
ALTER TABLE `ts_tickets`
 ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `ts_users`
--
ALTER TABLE `ts_users`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `ts_companies`
--
ALTER TABLE `ts_companies`
MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `ts_tickets`
--
ALTER TABLE `ts_tickets`
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT voor een tabel `ts_users`
--
ALTER TABLE `ts_users`
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
