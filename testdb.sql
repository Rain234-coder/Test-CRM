-- phpMyAdmin SQL Dump
-- version 3.5.1
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Мар 07 2021 г., 19:35
-- Версия сервера: 5.5.25
-- Версия PHP: 5.3.13

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `testdb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `income_date` date NOT NULL,
  `type` varchar(50) NOT NULL,
  `text` text NOT NULL,
  `comm1` text NOT NULL,
  `comm2` text NOT NULL,
  `status` varchar(30) NOT NULL,
  `work_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `requests`
--

INSERT INTO `requests` (`id`, `income_date`, `type`, `text`, `comm1`, `comm2`, `status`, `work_date`) VALUES
(1, '2021-03-07', 'Интернет', 'Не работает', 'Срочно', 'Сделано', 'Выполнено', '2021-03-10'),
(2, '2021-02-19', 'Телефон', 'Отключился', '', '', 'Входящая', '0000-00-00'),
(3, '2021-03-07', 'Интернет', 'Опять не работает', '', '', 'Входящая', '0000-00-00');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`) VALUES
(1, 'admin', 'admin');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
