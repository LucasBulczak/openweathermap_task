-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Cze 2018, 22:21
-- Wersja serwera: 10.1.32-MariaDB
-- Wersja PHP: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `weather`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `info`
--

CREATE TABLE `info` (
  `id` int(11) NOT NULL,
  `city` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL,
  `dateFrom` date NOT NULL,
  `dateTo` date NOT NULL,
  `userIP` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `info`
--

INSERT INTO `info` (`id`, `city`, `dateFrom`, `dateTo`, `userIP`) VALUES
(108, 'Moscow', '2018-06-14', '2018-06-19', '127.0.0.1'),
(109, 'Warsaw', '2018-06-14', '2018-06-19', '127.0.0.1'),
(110, 'Tokyo', '2018-06-14', '2018-06-19', '127.0.0.1'),
(111, 'Dublin', '2018-06-14', '2018-06-19', '127.0.0.1'),
(112, 'london, us', '2018-06-14', '2018-06-19', '127.0.0.1'),
(113, 'Gdansk', '2018-06-14', '2018-06-19', '127.0.0.1'),
(114, 'Poznan', '2018-06-14', '2018-06-19', '127.0.0.1'),
(115, 'New York', '2018-06-14', '2018-06-19', '127.0.0.1');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `info`
--
ALTER TABLE `info`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `info`
--
ALTER TABLE `info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
