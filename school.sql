-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 27 nov 2015 om 09:19
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
  `user` int(5) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `ts_tickets`
--

INSERT INTO `ts_tickets` (`id`, `subject`, `message`, `department`, `priority`, `email`, `status`, `published`, `user`) VALUES
(3, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:30', 1),
(4, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:54', 1),
(5, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:53:57', 1),
(6, 'asdsad', 'asdsadsa\r\ndas\r\nd\r\nsa\r\nd\r\nsad', 'sad', 3, 'alwinkroesen@hotmail.com', 1, '2015-11-20 13:54:00', 1);

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
MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT voor een tabel `ts_users`
--
ALTER TABLE `ts_users`
MODIFY `id` int(5) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
