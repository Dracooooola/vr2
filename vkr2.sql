-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 10 2019 г., 00:45
-- Версия сервера: 8.0.16
-- Версия PHP: 7.1.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `vkr2`
--

-- --------------------------------------------------------

--
-- Структура таблицы `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `files`
--

INSERT INTO `files` (`id`, `user_email`, `path`) VALUES
(1, 'klimov-vd@yandex.ru', '/img/9th-8-2019-09:37:21.jpg'),
(2, 'klimov-vd@yandex.ru', '/img/9th-8-2019-09:38:21.jpg'),
(3, 'klimov-vd@yandex.ru', '/img/9th-8-2019-10:21:22.jpg'),
(4, 'roll@ya.ru', '/img/10th-8-2019-12:21:00.jpg');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Ivan',
  `surname` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'Ivanov',
  `birthday` date NOT NULL DEFAULT '2001-01-19',
  `avatar` varchar(255) NOT NULL DEFAULT '/img/index.jpg'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`email`, `password`, `name`, `surname`, `birthday`, `avatar`) VALUES
('klimov-vd@yandex.ru', '4165300cf454b2d5e4265c4046f9a30f64b37b11', 'Влад', 'Ivanov', '2019-08-10', '/img/9th-8-2019-08:40:20.jpg'),
('random@mail.ru', 'f8ae8a7929903edafc20f2d1dae3ba0480006203', 'Ivan', 'Ivanov', '2001-01-19', '/img/index.jpg'),
('roll@ya.ru', '1139513e4a2786db303748b2c11a4463766c5d2d', 'Форма в шапке', 'Ivanov', '1995-02-01', '/img/10th-8-2019-12:19:00.jpg');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_email` (`user_email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`user_email`) REFERENCES `users` (`email`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
