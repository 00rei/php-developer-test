-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Авг 04 2022 г., 10:20
-- Версия сервера: 5.7.33
-- Версия PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `php_test`
--

-- --------------------------------------------------------

--
-- Структура таблицы `genders`
--

CREATE TABLE `genders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `genders`
--

INSERT INTO `genders` (`id`, `name`) VALUES
(1, 'Мужской'),
(2, 'Женский');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Администратор'),
(2, 'Пользователь');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `id_genders` int(11) DEFAULT NULL,
  `id_roles` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `name`, `surname`, `date_of_birth`, `id_genders`, `id_roles`) VALUES
(3, 'polyakov', 'veryhardpassword', 'Евдоким', 'Поляков', '2022-08-01', 1, 1),
(4, 'kalashnikov47', 'password123', 'Аскольд', 'Калашников', '2022-06-01', 1, 1),
(7, 'walter_ppk', 'qwerty123', 'Вальтер', 'Сысоев', '2022-08-03', 1, 1),
(8, 'nose_mc12', 'adrian11', 'Адриан12', 'Носов12', '2022-08-02', 2, 2),
(9, 'bob', 'qqwwee331', 'Пелагея', 'Бобылёва', '2022-08-05', 2, 2),
(10, 'the_best11409', 'ltPcna23YjmR', 'Раиса', 'Шестакова', '2022-08-01', 2, 2),
(11, 'hello_world', '88112345', 'Гаянэ', 'Молчанова', '2022-08-02', 2, 2),
(12, 'admin', 'password', 'Андрей', 'Верстунин', '2000-03-10', 1, 1),
(114, 'rr', 'rr', 'rr', 'rr', '2022-08-01', 1, 1),
(116, 'new_user', 'password', 'Виктория', 'Евгеньева', '2022-08-01', 2, 2),
(117, 'useruser', 'password', 'Евгения', 'Викторьева', '2002-04-15', 2, 2);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `genders`
--
ALTER TABLE `genders`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `LOGIN` (`login`),
  ADD KEY `fk_genders` (`id_genders`),
  ADD KEY `fk_roles` (`id_roles`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `genders`
--
ALTER TABLE `genders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `fk_genders` FOREIGN KEY (`id_genders`) REFERENCES `genders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_roles` FOREIGN KEY (`id_roles`) REFERENCES `roles` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
