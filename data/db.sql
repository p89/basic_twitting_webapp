-- phpMyAdmin SQL Dump
-- version 4.6.6deb4
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Czas generowania: 07 Maj 2017, 09:50
-- Wersja serwera: 5.7.18-0ubuntu0.17.04.1
-- Wersja PHP: 7.0.15-1ubuntu4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `twittapp`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `comment`
--

CREATE TABLE `comment` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `tweet_id` int(11) NOT NULL,
  `content` text NOT NULL,
  `date_posted` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `comment`
--

INSERT INTO `comment` (`id`, `user_id`, `tweet_id`, `content`, `date_posted`) VALUES
(1, 6, 13, 'To jest pierwszy komentarz pod tweetem.', '2017-05-06 06:17:16'),
(2, 11, 14, 'To jest komentarz pod tweetem o Nordstream.', '2017-05-06 13:24:24'),
(3, 7, 14, 'Polsce może grozić jedynie przerwanie dostaw gazu ze wschodu i uzależnienie od dostaw jankesów.', '2017-05-06 20:23:12'),
(17, 7, 14, 'Co grozi Polsce?Ano nic , bo co może grozić wrakowi na dnie? Może zatonięcie?', '2017-05-06 20:46:00'),
(18, 7, 10, 'Bardzo ciekawy artykuł.', '2017-05-07 09:48:31');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `was_read` tinyint(1) NOT NULL,
  `content` text NOT NULL,
  `date_sent` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `was_read`, `content`, `date_sent`) VALUES
(1, 7, 8, 1, 'Even bad coffee is better than no coffee at all.', '2017-05-04 07:10:00'),
(6, 7, 9, 0, 'Pamiętaj, żeby nie udziwniać i nie komplikować tekstu, ponieważ na ekranie odbiorcy może wyglądać to zupełnie inaczej niż u Ciebie;', '2017-05-04 17:42:02'),
(7, 7, 9, 0, 'I hate slick and pretty things. I prefer mistakes and accidents. Which is why I like things like cuts and bruises - they\'re like little flowers. I\'ve always said that if you have a name for something, like \'cut\' or \'bruise,\' people will automatically be disturbed by it. But when you see the same thing in nature, and you don\'t know what it is, it can be very beautiful.', '2017-05-04 17:46:39'),
(8, 10, 7, 1, 'I don\'t think it was pain that made [Vincent Van Gogh] great - I think his painting brought him whatever happiness he had.', '2017-05-04 00:00:00'),
(9, 10, 7, 1, 'Kiedy poprzedni zarząd chwalił się rekordowym budżetem, sytuacja finansowa była tak trudna, że zarząd zdecydował o wcześniejszym spieniężeniu przyszłych rat za transfer Ondreja Dudy do Herthy – mówi Dariusz Mioduski, właściciel 100% akcji mistrza Polski w piłce nożnej, czyli klubu Legia Warszawa.', '2017-05-05 10:23:21'),
(10, 11, 7, 1, 'Pełnomocnik Lecha Wałęsy dysponuje opinią grafologów, podważającą ustalenia działających na zlecenie IPN biegłych Instytutu Ekspertyz Sądowych - dowiedział się dziennikarz RMF FM. W styczniu IPN ogłosił, że ich zdaniem autorem zapisków z teczki TW Bolka był \"kategorycznie i bez wątpliwości\" Lech Wałęsa. Jego adwokat, prof. Jan Widacki ma to zakwestionować opinią własnych ekspertów, którą przedstawi na konferencji w przyszłym tygodniu.\r\n', '2017-05-05 09:29:24'),
(11, 7, 11, 0, 'dzięki jerzy za wiadomość! super :)', '2017-05-05 13:39:22'),
(12, 7, 10, 0, 'Czesc monti, co tam!', '2017-05-06 15:58:10'),
(13, 8, 7, 1, 'Hej Ola!', '2017-05-06 16:10:08'),
(14, 8, 7, 1, 'Ideas are like fish. If you want to catch little fish, you can stay in the shallow water. But if you want to catch the big fish, you’ve got to go deeper. Down deep, the fish are more powerful and more pure.They’re huge and abstract. And they’re very beautiful.', '2017-05-06 17:03:19'),
(15, 8, 7, 1, 'I like to remember things my own way. How I remembered them, not necessarily the way they happened.', '2017-05-06 21:49:14'),
(16, 7, 6, 0, 'Cześć Asia!', '2017-05-07 09:48:58');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `tweet`
--

CREATE TABLE `tweet` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `tweetText` varchar(140) NOT NULL,
  `tweetDate` datetime NOT NULL,
  `author` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `tweet`
--

INSERT INTO `tweet` (`id`, `title`, `tweetText`, `tweetDate`, `author`) VALUES
(1, 'FOMO', 'Pojedynczych uciekinierów nie brakuje. Ale tym razem chodziło o to, żeby nie znikać ze świata na dobre. Lecz przeciwnie.', '2017-04-30 18:32:29', 1),
(2, 'Dubaj', 'Autokracje kochają drapacze chmur. Chociaż budują je bez ekonomicznego sensu', '2017-04-30 18:33:37', 1),
(3, 'Wybory prezydenta Francji', '\"Kandydat banków\" będzie prezydentem Francji? Prześwietlamy sylwetkę Emmanuela Macrona', '2017-04-30 19:04:20', 1),
(4, 'ZUS', 'Emerytalny zakład Pascala. Skoro dostanę mało albo ZUS zbankrutuje, to lepiej płacić jak najmniej', '2017-04-30 19:10:37', 1),
(5, 'MDM', 'Program Mieszkanie dla Młodych definitywnie przechodzi do historii. Za rok prawdopodobnie nie będą już dostępne żadne dotacje z MdM-u.', '2017-04-30 19:11:10', 1),
(6, 'JP Morgan rekrutuje w Warszawie', '3 maja na stronie banku inwestycyjnego pojawiło się pierwsze ogłoszenie o pracę w stolicy Polski — dla szefa działu kadr.', '2017-05-02 06:13:12', 9),
(7, 'Facebook obsypuje stażystów dolarami', 'Spółki technologiczne dominują w rankingu najbardziej lukratywnych programów stażowych. Najlepiej płaci Facebook.', '2017-05-02 22:06:45', 9),
(8, 'Nie matura, lecz chęć szczera…', '51 proc. pracodawców uważa, że osoby wchodzące na rynek nie mają odpowiednich kompetencji — wynika z badań Work Service’u.', '2017-05-02 22:07:54', 9),
(9, 'Mrozy w Bordeaux', 'Właściciele winnic w Bordeaux na południowym zachodzie Francji mogli stracić nawet połowę tegorocznych zbiorów w wyniku przymrozków.', '2017-05-02 22:08:23', 9),
(10, 'Apple liderem rynku wearables', 'Koncern z Cupertino prześcignął Fitbit i stał się największym na świecie producentem gadżetów do ubierania, czyli tzw. wearables.', '2017-05-02 22:09:04', 9),
(11, 'Uber pod lupą prokuratorów federalnych', 'Zastrzeżenia prokuratorów wzbudza stosowanie przez Ubera aplikacji Greyball w celu uniknięcia kar i lokalnych inspekcji.', '2017-05-04 12:30:34', 7),
(12, 'Rekordowy kwartał polskiej motoryzacji', 'Polska branża motoryzacyjna to eksportowy lider - przypada na nią 12,5 proc. całego polskiego eksportu.', '2017-05-05 16:47:47', 7),
(13, 'Na całym świecie widać spadek liczby powołań', 'Na całym świecie obserwujemy nieznaczny spadek liczby powołań; to m. in. wynik zmniejszającej się liczby urodzeń - mówi ks. Emil Parafiniuk.', '2017-05-05 17:25:33', 7),
(14, 'Nord Stream II', 'W tle wyborów w Niemczech i wizyt Angeli Merkel trwa dyplomatyczna potyczka o gaz. Czy Władimir Putin wyprowadzi Rosję z izolacji?', '2017-05-06 14:31:43', 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `hash_password` varchar(100) NOT NULL,
  `salt` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `user`
--

INSERT INTO `user` (`id`, `username`, `email`, `hash_password`, `salt`) VALUES
(1, 'typowyseba', 'test@email.com', '$2y$12$Ns0AMdfajsdnfkjnasdkjfn4u3285923479582AUDQne', 4652),
(6, 'joanna', 'mailer@ok.pl', '$2y$12$Ns0AM2vPyedsNntBAkct.uxmKoJNRWJVoeKzBo4ivnlory3AUDQne', 8519),
(7, 'ola', 'pieknaola@wp.pl', '$2y$12$qG0/UDKI/VpqYn.fhD.1WOmhXmXn5NMQEYnPSIpl53wmqgkAVSgOu', 3564),
(8, 'krolalbanii', 'krolalbanii@gmail.com', '$2y$12$n8OIJ2kSfoL9FikI50if0e.o5vysjv8M4BFv1S6w2/F6aHOy6FNYy', 6495),
(9, 'mammamia', 'mammamia@interia.pl', '$2y$12$/S0Emcp7iwqzgs5D4SPn8.w5pb.7nPPCro6MoaFYFIQpr/JV9zPVW', 2540),
(10, 'montezuma', 'montezuma@gmail.com', '$2y$12$cmUD5OHs/tg99dWEJGaGJunsBRMI7zxKAmUB0qrrZjNne/hEbHqEy', 7991),
(11, 'jerzypolomski', 'jerzypolomski@wp.pl', '$2y$12$lQejFw5tElwkq0zSYg0Wy.DbW9tk9T2uOS/q3ulJCbUgLfs5pVu8q', 5577);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_ibfk_1` (`user_id`),
  ADD KEY `comment_ibfk_2` (`tweet_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`),
  ADD KEY `message_ibfk_1` (`sender_id`),
  ADD KEY `message_ibfk_2` (`receiver_id`);

--
-- Indexes for table `tweet`
--
ALTER TABLE `tweet`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tweet_ibfk_1` (`author`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT dla tabeli `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT dla tabeli `tweet`
--
ALTER TABLE `tweet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comment_ibfk_2` FOREIGN KEY (`tweet_id`) REFERENCES `tweet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ograniczenia dla tabeli `tweet`
--
ALTER TABLE `tweet`
  ADD CONSTRAINT `tweet_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
