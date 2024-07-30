-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 31 Lip 2024, 01:08
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `traveltask`
--
CREATE DATABASE IF NOT EXISTS `traveltask` DEFAULT CHARACTER SET utf8 COLLATE utf8_polish_ci;
USE `traveltask`;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `costs`
--

CREATE TABLE `costs` (
  `id_costs` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `amount` double NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` varchar(50) DEFAULT NULL,
  `id_vehicle` int(11) DEFAULT NULL,
  `id_delegation` int(11) DEFAULT NULL,
  `id_users` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `costs`
--

INSERT INTO `costs` (`id_costs`, `expense_date`, `amount`, `description`, `category`, `id_vehicle`, `id_delegation`, `id_users`) VALUES
(1, '2024-07-01', 200, 'Paliwo', 'car', 1, NULL, 2),
(2, '2024-07-05', 150, 'Wymiana oleju', 'car', 1, NULL, 2),
(3, '2024-07-10', 500, 'Ubezpieczenie OC', 'car', 1, NULL, 2),
(4, '2024-07-15', 350, 'Wymiana opon', 'car', 1, NULL, 2),
(5, '2024-07-20', 100, 'Myjnia', 'car', 1, NULL, 2),
(6, '2024-07-28', 20, 'Nowy płyn do spryskiwaczy', 'car', 1, NULL, 2),
(7, '2024-07-31', 123, 'test', 'route', NULL, 7, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `id_users` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `notes`
--

INSERT INTO `notes` (`id`, `title`, `content`, `created_at`, `updated_at`, `id_users`) VALUES
(3, '', '', '2024-07-28 00:23:03', '2024-07-28 21:27:50', 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `travel`
--

CREATE TABLE `travel` (
  `id_travel` int(11) NOT NULL,
  `location_1` varchar(30) DEFAULT NULL,
  `location_2` varchar(30) DEFAULT NULL,
  `id_delegation` int(11) DEFAULT NULL,
  `time_del_1` datetime DEFAULT NULL,
  `time_del_2` datetime DEFAULT NULL,
  `distance` int(11) NOT NULL,
  `id_user_fk` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `travel`
--

INSERT INTO `travel` (`id_travel`, `location_1`, `location_2`, `id_delegation`, `time_del_1`, `time_del_2`, `distance`, `id_user_fk`) VALUES
(1, 'Dubicko', 'Dynów', 1, '2024-07-30 22:05:15', '2024-07-30 23:05:15', 0, 2),
(2, 'Dynów', 'Dubicko', 1, '2024-07-30 23:07:31', '2024-07-30 23:20:31', 0, 2),
(3, 'Dubicko', 'Nozdrzec', 1, '2024-07-30 23:52:24', '2024-07-31 23:52:24', 0, 2),
(4, 'Dynów', 'Dubiceko', 1, '2024-07-31 00:13:32', '2024-07-31 00:13:35', 123, 2),
(5, 'Dynów', 'Dubiceko', 1, '2024-07-31 00:13:44', '2024-07-31 00:13:45', 1234, 2),
(6, 'Dynów', 'Dubiceko', 2, '2024-07-31 00:15:42', '2024-07-31 00:15:43', 1234, 2),
(7, 'Dynów', 'Dubiceko', 3, '2024-07-31 00:18:24', '2024-07-31 00:18:26', 12, 2),
(8, 'Dynów', 'Dubiceko', 4, '2024-07-31 00:19:35', '2024-07-31 00:19:36', 12, 2),
(9, 'Dubicko', 'Dynów', 4, '2024-07-31 00:19:41', '2024-07-31 00:19:42', 12, 2),
(10, 'Dynów', 'Dubiceko', 5, '2024-07-31 00:21:41', '2024-07-31 00:21:42', 13, 2),
(11, 'Dubicko', 'Dynów', 5, '2024-07-31 00:21:49', '2024-07-31 00:21:50', 14, 2),
(12, 'Dynów', 'Dubiceko', 6, '2024-07-31 00:42:34', '2024-07-31 00:42:39', 12, 2),
(13, 'Dynów', 'Dubiceko', 7, '2024-07-31 00:51:14', '2024-07-31 00:53:43', 12, 2);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `phone_number` varchar(10) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `pwd` varchar(255) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `user_status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id_users`, `user_name`, `phone_number`, `email`, `pwd`, `last_login`, `user_status`) VALUES
(1, 'Maniu', '123456789', 'qwerty@gmail.pl', '1234567', '2024-07-25 22:21:31', 'aktywne'),
(2, 'Maniu2', '123456789', 'admin@gmail.com', '$2y$10$.7cPu0ZhpTu2Cw29nkycTez8KgDW5ynny2ay1POBBR4OwFwmtvNy6', '2024-07-31 00:19:24', 'aktywne');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `vehicle`
--

CREATE TABLE `vehicle` (
  `id_vehicle` int(11) NOT NULL,
  `id_users` int(11) DEFAULT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` datetime NOT NULL,
  `engine_car` varchar(50) NOT NULL,
  `course` varchar(10) DEFAULT NULL,
  `path_photo` varchar(30) DEFAULT NULL,
  `last_service` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `vehicle`
--

INSERT INTO `vehicle` (`id_vehicle`, `id_users`, `make`, `model`, `year`, `engine_car`, `course`, `path_photo`, `last_service`) VALUES
(1, 2, 'Opel', 'Astra', '2007-01-01 00:00:00', '1,6 benzyna', '247000', NULL, '2024-07-28 22:43:15'),
(2, 2, 'Audi', 'A4 B7', '2005-01-01 00:00:00', '2.0 Diesel', '250000', NULL, '2024-05-28 22:30:55');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id_costs`),
  ADD KEY `FK_id_vehicle` (`id_vehicle`),
  ADD KEY `FK_id_users` (`id_users`);

--
-- Indeksy dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_users` (`id_users`);

--
-- Indeksy dla tabeli `travel`
--
ALTER TABLE `travel`
  ADD PRIMARY KEY (`id_travel`),
  ADD KEY `id_user_fk` (`id_user_fk`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`);

--
-- Indeksy dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`id_vehicle`),
  ADD KEY `id_users` (`id_users`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `costs`
--
ALTER TABLE `costs`
  MODIFY `id_costs` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT dla tabeli `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT dla tabeli `travel`
--
ALTER TABLE `travel`
  MODIFY `id_travel` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `id_vehicle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `costs`
--
ALTER TABLE `costs`
  ADD CONSTRAINT `FK_id_users` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`),
  ADD CONSTRAINT `FK_id_vehicle` FOREIGN KEY (`id_vehicle`) REFERENCES `vehicle` (`id_vehicle`);

--
-- Ograniczenia dla tabeli `notes`
--
ALTER TABLE `notes`
  ADD CONSTRAINT `notes_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `travel`
--
ALTER TABLE `travel`
  ADD CONSTRAINT `travel_ibfk_1` FOREIGN KEY (`id_user_fk`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `vehicle`
--
ALTER TABLE `vehicle`
  ADD CONSTRAINT `vehicle_ibfk_1` FOREIGN KEY (`id_users`) REFERENCES `users` (`id_users`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
