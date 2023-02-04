-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 04 Lut 2023, 22:24
-- Wersja serwera: 10.4.27-MariaDB
-- Wersja PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `ogloszenia_reklamowe`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listing_item`
--

CREATE TABLE `listing_item` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `address` varchar(70) NOT NULL,
  `content` varchar(1000) NOT NULL,
  `category` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `width` double(5,2) NOT NULL,
  `height` double(5,2) NOT NULL,
  `price` double(10,2) NOT NULL,
  `position_X` double NOT NULL,
  `position_Y` double NOT NULL,
  `add_date` date NOT NULL,
  `expiration_date` date NOT NULL,
  `blocked` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `listing_item`
--

INSERT INTO `listing_item` (`id`, `title`, `address`, `content`, `category`, `user_id`, `width`, `height`, `price`, `position_X`, `position_Y`, `add_date`, `expiration_date`, `blocked`) VALUES
(3, 'Billboard przy autostradzie w Częstochowie', 'Autostrada Bursztynowa, Częstochowa', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nunc metus, pellentesque ut pellentesque suscipit, ultrices mattis libero. Morbi sed dignissim ante. Curabitur quis nibh a leo posuere scelerisque in ut erat. Donec vel sollicitudin libero. Nullam sollicitudin nisl id mi facilisis mattis semper et enim. Maecenas dapibus nulla nec aliquet congue. Nunc quis fermentum lectus. Etiam rhoncus pharetra urna vitae volutpat.', 'Bilbord', 2, 6.00, 3.00, 1499.00, 50.809686789422, 19.017763137817, '2023-02-03', '2023-03-05', 0),
(4, 'Banery obok browaru Łomża', 'Poznańska 121, 18-402 Łomża', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nunc metus, pellentesque ut pellentesque suscipit, ultrices mattis libero. Morbi sed dignissim ante. Curabitur quis nibh a leo posuere scelerisque in ut erat. Donec vel sollicitudin libero. Nullam sollicitudin nisl id mi facilisis mattis semper et enim. Maecenas dapibus nulla nec aliquet congue. Nunc quis fermentum lectus. Etiam rhoncus pharetra urna vitae volutpat.', 'Baner', 2, 0.50, 1.50, 499.00, 53.185161476117, 22.027802467346, '2023-02-03', '2023-03-05', 0),
(5, 'Bilboard przy ruchliwej ulicy w Poznaniu', 'Głogowska 300, 60-266 Poznań', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nunc metus, pellentesque ut pellentesque suscipit, ultrices mattis libero. Morbi sed dignissim ante. Curabitur quis nibh a leo posuere scelerisque in ut erat. Donec vel sollicitudin libero. Nullam sollicitudin nisl id mi facilisis mattis semper et enim. Maecenas dapibus nulla nec aliquet congue. Nunc quis fermentum lectus. Etiam rhoncus pharetra urna vitae volutpat.', 'Bilbord', 5, 6.00, 3.00, 2499.00, 52.373866107634, 16.868187189102, '2023-02-03', '2023-03-05', 0),
(6, 'Witryna na starym rynku w Poznaniu', 'Stary Rynek, 61-001 Poznań', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut nunc metus, pellentesque ut pellentesque suscipit, ultrices mattis libero. Morbi sed dignissim ante. Curabitur quis nibh a leo posuere scelerisque in ut erat. Donec vel sollicitudin libero. Nullam sollicitudin nisl id mi facilisis mattis semper et enim. Maecenas dapibus nulla nec aliquet congue. Nunc quis fermentum lectus. Etiam rhoncus pharetra urna vitae volutpat.', 'Witryna', 5, 0.60, 1.00, 999.00, 52.407777671954, 16.932860612869, '2023-02-03', '2023-03-05', 0);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `listing_pictures`
--

CREATE TABLE `listing_pictures` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `listing_item_id` int(11) NOT NULL,
  `order_position` int(11) NOT NULL,
  `src` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `listing_pictures`
--

INSERT INTO `listing_pictures` (`id`, `listing_item_id`, `order_position`, `src`) VALUES
(5, 3, 0, '1675454638_0.jpg'),
(6, 4, 0, '1675454923_0.jpg'),
(7, 5, 0, '1675463541_0.jpg'),
(8, 5, 1, '1675463541_1.jpg'),
(9, 5, 2, '1675463541_2.jpg'),
(10, 6, 0, '1675463611_0.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2023_02_01_194501_listing_item', 1),
(5, '2023_02_01_194521_listing_pictures', 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(30) NOT NULL,
  `email` varchar(40) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) DEFAULT 'user',
  `phone_number` varchar(11) NOT NULL,
  `blocked` tinyint(1) DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `phone_number`, `blocked`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'Tadeusz Kaczmarek', 'tad.kaczmarek@mail.com', '2023-02-03 20:02:58', '$2y$10$yhac6cR4dBj6yFukn0chBu8T3t/xOjD.fApc09zMXDUL1XUN4Sq0i', 'user', '321-321-321', 0, NULL, '2023-02-03 19:02:45', '2023-02-04 09:21:04'),
(4, 'Krzysztof Król', 'admin@adlistings.com', '2023-02-03 21:40:22', '$2y$10$9V3gJy2HK3PFA4p.EIHckepMiuTxzzogFWejEVtik.kwu6INCEhby', 'admin', '133-713-370', 0, NULL, '2023-02-03 20:39:41', '2023-02-03 20:39:41'),
(5, 'Kamil Ślimak', 'kamil.slimak@ggwp.pl', '2023-02-03 22:28:44', '$2y$10$IpOpy8QDvwFCZnoi2UfKNOKyRPif8LPF.owLfRHkt2rGn6b5qjdWO', 'user', '321-321-321', 0, 'pJW0cnCKAnBBG0OOgUr90dxx5jhm91erKUYXq4002HUJGRqOfALNgk0aU4Ug', '2023-02-03 21:27:51', '2023-02-03 21:27:51'),
(6, 'Błażej Anonim', 'nieistniejacy@mail.br', NULL, '$2y$10$GqZ0F7QU/UOvM2RMAQlubOPNt80QOMXZWp.50GbjVIkuqtsq0OkZm', 'user', '543-234-763', 0, NULL, '2023-02-04 19:37:00', '2023-02-04 19:37:00'),
(7, 'Tomasz Zbanowany', 'banned@mail.com', '2023-02-04 20:39:48', '$2y$10$Ge4NFcvClykaP2a2/fD4uOveTSQI4RIcYV.pdj74uVWjHS9tbv8Fq', 'user', '000-000-000', 1, NULL, '2023-02-04 19:39:36', '2023-02-04 19:39:36');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `listing_item`
--
ALTER TABLE `listing_item`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `listing_item_id_unique` (`id`);

--
-- Indeksy dla tabeli `listing_pictures`
--
ALTER TABLE `listing_pictures`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `listing_item`
--
ALTER TABLE `listing_item`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `listing_pictures`
--
ALTER TABLE `listing_pictures`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT dla tabeli `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
