-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sty 26, 2025 at 10:33 PM
-- Wersja serwera: 10.4.32-MariaDB
-- Wersja PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dashboard`
--
CREATE DATABASE IF NOT EXISTS `dashboard` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `dashboard`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events_list`
--

CREATE TABLE `events_list` (
  `id` int(11) NOT NULL,
  `eventType` int(11) NOT NULL COMMENT 'rodzaj wydarzenia',
  `userId` int(11) NOT NULL COMMENT 'id użytkownika, który dodał wydarzenie',
  `name` varchar(50) NOT NULL COMMENT 'nazwa wydarzenia',
  `guestDescription` text NOT NULL COMMENT 'opis dla gości',
  `userDescription` text NOT NULL COMMENT 'prywatne notatki',
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data utworzenia',
  `maxAcceptDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data do kiedy można akceptować zaproszenia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_list`
--

INSERT INTO `events_list` (`id`, `eventType`, `userId`, `name`, `guestDescription`, `userDescription`, `creationDate`, `maxAcceptDate`) VALUES
(1, 1, 1, 'Wesele Magdy i Pawła', 'Opis dla gości', 'Uwagi własne', '2025-01-26 21:02:38', '2025-01-30 23:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `events_locations`
--

CREATE TABLE `events_locations` (
  `id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL COMMENT 'id wydarzenia',
  `street` text NOT NULL COMMENT 'ulica',
  `zipCode` text NOT NULL COMMENT 'kod pocztowy',
  `town` text NOT NULL COMMENT 'miasto',
  `country` text NOT NULL COMMENT 'kraj',
  `name` text NOT NULL COMMENT 'jakaś nazwa lokalizacji, gdzie będzie odbywać się wydarzenie',
  `date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp() COMMENT 'data wydarzenia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events_locations`
--

INSERT INTO `events_locations` (`id`, `eventId`, `street`, `zipCode`, `town`, `country`, `name`, `date`) VALUES
(1, 1, 'Nowy Sącz 69', '32-300', 'Nowy Sącz', 'Polska', 'Dom weselny Strumyk', '2025-02-22 23:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invation`
--

CREATE TABLE `invation` (
  `id` int(11) NOT NULL COMMENT 'id zaproszenia',
  `invationCode` varchar(6) NOT NULL COMMENT 'kod do potwierdzenia online',
  `eventId` int(11) NOT NULL COMMENT 'id wydarzenia'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invation`
--

INSERT INTO `invation` (`id`, `invationCode`, `eventId`) VALUES
(1, 'GTYT12', 1),
(2, 'IOIS7Z', 1),
(3, 'XCGCVV', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `invited_guests`
--

CREATE TABLE `invited_guests` (
  `id` int(11) NOT NULL,
  `eventId` int(11) NOT NULL COMMENT 'id wydarzenia',
  `invationId` int(11) NOT NULL COMMENT 'id zaproszenia ',
  `name` text NOT NULL COMMENT 'imię gościa',
  `surname` text NOT NULL COMMENT 'nazwisko',
  `isKid` int(1) NOT NULL COMMENT 'czy gość jest dzieckiem czy dorosłym',
  `email` text NOT NULL COMMENT 'email',
  `phone` text NOT NULL COMMENT 'telefon',
  `sex` varchar(1) NOT NULL COMMENT 'płeć',
  `description` text NOT NULL COMMENT 'opis dla organizatora',
  `isAccepted` int(11) NOT NULL COMMENT 'czy gość zaakceptował zaproszenie',
  `notes` text NOT NULL COMMENT 'notatka od gościa dla organizatora'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `invited_guests`
--

INSERT INTO `invited_guests` (`id`, `eventId`, `invationId`, `name`, `surname`, `isKid`, `email`, `phone`, `sex`, `description`, `isAccepted`, `notes`) VALUES
(1, 1, 1, 'Jan', 'Kowalski', 0, 'jkowalski@gmail.com', '695 231 789', '0', 'Stryj Jan ', 2, ''),
(2, 1, 1, 'Janina', 'Kowalska', 0, '', '', '1', 'Żona Jana', 2, ''),
(3, 1, 1, 'Brajan', 'Kowalski', 1, '', '', '0', 'Syn Janiny i Jana', 2, ''),
(4, 1, 2, 'Józef', 'Bolo', 0, '', '', '0', 'Sąsiad', 0, 'Niestety nie mogę wziąć udziału w waszym weselu'),
(5, 1, 3, 'Kamil', 'Rybak', 0, '', '525 789 666', '0', 'Kolega z pracy', 2, ''),
(6, 1, 3, 'Zofia', 'Rybak', 0, '', '', '1', 'Żona Kamila', 2, ''),
(7, 1, 3, 'Hania', 'Rybak', 1, '', '', '1', 'Córka Zofii i Kamila', 2, ''),
(8, 1, 3, 'Jacek', 'Rybak', 0, '', '', '0', 'Syn Zofii i Kamila', 2, '');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `userType` int(11) NOT NULL DEFAULT 2 COMMENT 'typ użytkownika',
  `name` varchar(50) DEFAULT NULL COMMENT 'imię',
  `surname` varchar(50) DEFAULT NULL COMMENT 'nazwisko',
  `login` text NOT NULL COMMENT 'login',
  `password` text NOT NULL COMMENT 'hasło',
  `email` varchar(50) NOT NULL COMMENT 'email',
  `accountIsActive` varchar(255) NOT NULL COMMENT 'czy konto zostało aktywowane',
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'data utworzenia konta',
  `lastLoggin` timestamp NULL DEFAULT NULL COMMENT 'ostatnie logowanie',
  `editDate` timestamp NULL DEFAULT NULL COMMENT 'data edycji'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `userType`, `name`, `surname`, `login`, `password`, `email`, `accountIsActive`, `creationDate`, `lastLoggin`, `editDate`) VALUES
(1, 2, 'admin', 'admin', 'admin', '$2y$10$hLOz/9awLW4UZRVtfJ68WOGcdaj3/CZ8MvX/ffaXPMV2SyRv0BN56', 'noreply@partyplanner.com.pl', '1', '2025-01-26 20:55:49', '2025-01-26 20:56:07', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Klient');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `events_list`
--
ALTER TABLE `events_list`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `events_locations`
--
ALTER TABLE `events_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `invation`
--
ALTER TABLE `invation`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitationCode` (`invationCode`);

--
-- Indeksy dla tabeli `invited_guests`
--
ALTER TABLE `invited_guests`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events_list`
--
ALTER TABLE `events_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events_locations`
--
ALTER TABLE `events_locations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `invation`
--
ALTER TABLE `invation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id zaproszenia', AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invited_guests`
--
ALTER TABLE `invited_guests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
