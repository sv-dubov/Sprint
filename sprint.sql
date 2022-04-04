-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Час створення: Квт 04 2022 р., 14:03
-- Версія сервера: 10.4.21-MariaDB
-- Версія PHP: 7.4.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База даних: `sprint`
--

-- --------------------------------------------------------

--
-- Структура таблиці `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `role` varchar(100) NOT NULL DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп даних таблиці `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `status`, `role`) VALUES
(15, 'Mykola', 'Cocacola', 0, 'User'),
(19, 'Ashly', 'Yundt', 1, 'User'),
(20, 'Laurence', 'Littel', 0, 'User'),
(31, 'Petro', 'Petrenko', 1, 'Admin'),
(61, 'Cat', 'Vatt', 0, 'User'),
(62, 'Qwaqwa', 'Qwiqwi', 1, 'Admin');

--
-- Індекси збережених таблиць
--

--
-- Індекси таблиці `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для збережених таблиць
--

--
-- AUTO_INCREMENT для таблиці `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=64;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
