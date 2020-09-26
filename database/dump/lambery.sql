-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1
-- Время создания: Сен 16 2020 г., 11:41
-- Версия сервера: 10.1.35-MariaDB
-- Версия PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `lambery`
--

-- --------------------------------------------------------

--
-- Структура таблицы `abuses`
--

CREATE TABLE `abuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `abuses`
--

INSERT INTO `abuses` (`id`, `user_id`, `name`, `email`, `text`, `subject`, `created_at`, `updated_at`) VALUES
(1, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qweqweweqweqwe', '', '2020-08-18 10:10:20', '2020-08-18 10:10:20'),
(2, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwertyqwerty', '', '2020-08-18 10:11:51', '2020-08-18 10:11:51'),
(3, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwertet erter terter', '', '2020-08-18 10:13:29', '2020-08-18 10:13:29'),
(4, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwerty qweert', '', '2020-08-25 10:06:00', '2020-08-25 10:06:00'),
(5, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwerty erter', '', '2020-08-25 10:06:18', '2020-08-25 10:06:18'),
(6, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'rtytry rtyrty', '', '2020-08-25 10:08:34', '2020-08-25 10:08:34'),
(7, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'we werw werwerer', '', '2020-08-25 10:09:43', '2020-08-25 10:09:43'),
(8, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwe wrwe were', '', '2020-08-25 10:10:12', '2020-08-25 10:10:12'),
(9, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'ert ertert erter', '', '2020-08-25 10:11:05', '2020-08-25 10:11:05'),
(10, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwe qweqwe qwew', '', '2020-08-25 10:11:33', '2020-08-25 10:11:33'),
(11, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qqwwewewewe', '', '2020-08-25 11:10:02', '2020-08-25 11:10:02'),
(12, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fghfg fghfghgh', '', '2020-08-28 11:07:34', '2020-08-28 11:07:34'),
(13, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwerty erer', '', '2020-08-28 11:09:44', '2020-08-28 11:09:44'),
(14, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qweqrqw qwrw', '', '2020-08-28 11:11:49', '2020-08-28 11:11:49'),
(15, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fghfghghfghfghfghg', '', '2020-08-28 11:12:10', '2020-08-28 11:12:10'),
(16, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fghfgh fghfgh', '', '2020-08-28 11:12:44', '2020-08-28 11:12:44'),
(17, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fghfgh fghfgh', '', '2020-08-28 11:13:14', '2020-08-28 11:13:14'),
(18, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'ert erterterter', '', '2020-08-28 11:13:23', '2020-08-28 11:13:23'),
(19, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'werwe werwer', '', '2020-08-28 11:13:47', '2020-08-28 11:13:47'),
(20, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'wer werwer', '', '2020-08-28 11:14:16', '2020-08-28 11:14:16'),
(21, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwe qweqwew', '', '2020-08-28 11:15:24', '2020-08-28 11:15:24'),
(22, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwe qweqwewe', '', '2020-08-28 11:16:12', '2020-08-28 11:16:12'),
(23, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'wer werwerwer', '', '2020-08-28 11:16:41', '2020-08-28 11:16:41'),
(24, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fghfg fghfghfgh', '', '2020-08-28 11:17:12', '2020-08-28 11:17:12'),
(25, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'fg hfghfg hfghf', '', '2020-08-28 11:17:18', '2020-08-28 11:17:18'),
(26, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwe qwewew qwe', '', '2020-08-28 11:19:43', '2020-08-28 11:19:43'),
(27, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'sdfsd sdfsdfdf', '', '2020-08-28 11:20:32', '2020-08-28 11:20:32'),
(28, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwerty rtyrty', '', '2020-08-28 11:22:53', '2020-08-28 11:22:53'),
(29, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qweqweqw w', '', '2020-08-28 11:25:31', '2020-08-28 11:25:31'),
(30, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'sdf sdfsdfsdfdsfds', '', '2020-08-28 11:44:22', '2020-08-28 11:44:22'),
(31, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'dfg dfgdf gdfgdfg', '', '2020-08-28 11:53:02', '2020-08-28 11:53:02'),
(32, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qweqwe qweqw', 'suggestion', '2020-09-10 08:24:21', '2020-09-10 08:24:21'),
(33, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'errttttttt', 'suggestion', '2020-09-10 08:25:54', '2020-09-10 08:25:54'),
(34, 2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', 'qwerty eee ee e', 'suggestion', '2020-09-10 09:27:55', '2020-09-10 09:27:55');

-- --------------------------------------------------------

--
-- Структура таблицы `activities`
--

CREATE TABLE `activities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `activity` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `new` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `activities`
--

INSERT INTO `activities` (`id`, `user_id`, `activity`, `type`, `new`, `created_at`) VALUES
(1, 1, 'Добавил группу <a href=\"http://lambery.loc/admin/users/roles/3/edit\">&laquo;Менеджер УК&raquo;</a>', 'success', 0, '2020-06-29 06:54:58'),
(2, 1, 'Изменил группу <a href=\"http://lambery.loc/admin/users/roles/3/edit\">&laquo;manager&raquo;</a>', 'success', 0, '2020-06-29 06:55:32'),
(3, 1, 'Изменил данные справочника', 'success', 0, '2020-06-30 14:50:32'),
(4, 1, 'Добавил группу <a href=\"http://lambery.loc/admin/users/roles/4/edit\">&laquo;content_manager&raquo;</a>', 'success', 0, '2020-07-08 11:08:20'),
(5, 1, 'Изменил данные справочника', 'success', 0, '2020-07-08 15:42:21'),
(6, 1, 'Изменил данные справочника', 'success', 0, '2020-07-08 15:42:34'),
(7, 1, 'Изменил данные справочника', 'success', 0, '2020-07-08 16:07:31'),
(8, 1, 'Изменил данные справочника', 'success', 0, '2020-07-08 16:11:04'),
(9, 1, 'Изменил данные справочника', 'success', 0, '2020-07-08 16:15:29'),
(10, 1, 'Изменил группу <a href=\"http://lambery.loc/admin/users/roles/3/edit\">&laquo;manager_uk&raquo;</a>', 'success', 0, '2020-07-09 14:10:32'),
(11, 1, 'Изменил группу <a href=\"http://lambery.loc/admin/users/roles/3/edit\">&laquo;manager_uk&raquo;</a>', 'success', 0, '2020-07-14 11:40:48'),
(12, 1, 'Личный кабинет домовладельца (ФИО, адрес, площадь участка) успешно создан.', 'success', 0, '2020-07-18 13:14:41'),
(13, 1, 'Изменил группу <a href=\"http://lambery.loc/admin/users/roles/4/edit\">&laquo;content_manager&raquo;</a>', 'success', 0, '2020-07-23 09:28:22'),
(14, 1, 'Изменил категорию <a href=\"http://lambery.loc/admin/categories/1/edit\">&laquo;Новости&raquo;</a>', 'success', 0, '2020-07-24 14:42:07'),
(15, 1, 'Изменил категорию <a href=\"http://lambery.loc/admin/categories/2/edit\">&laquo;Объявления&raquo;</a>', 'success', 0, '2020-07-24 14:43:33'),
(16, 1, 'Изменил категорию <a href=\"http://lambery.loc/admin/categories/2/edit\">&laquo;Объявления&raquo;</a>', 'success', 0, '2020-07-24 14:48:17'),
(17, 1, 'Добавил объявление <a href=\"http://lambery.loc/admin/adverts/16/edit\">&laquo;Состоится собрание жильцов&raquo;</a>', 'success', 0, '2020-07-25 10:24:42'),
(18, 1, 'Добавил объявление <a href=\"http://lambery.loc/admin/adverts/17/edit\">&laquo;Изменился телефон поста охраны&raquo;</a>', 'success', 0, '2020-07-25 10:31:37'),
(19, 1, 'Добавил страницу <a href=\"http://work3.loc/admin/pages/18/edit\">&laquo;Контакты&raquo;</a>', 'success', 0, '2020-09-07 06:51:04'),
(20, 1, 'Добавил категорию <a href=\"http://work3.loc/admin/categories/6/edit\">&laquo;Полезная информация&raquo;</a>', 'success', 0, '2020-09-07 08:34:21'),
(21, 1, 'Добавил статью <a href=\"http://work3.loc/admin/handbook/19/edit\">&laquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit&raquo;</a>', 'success', 0, '2020-09-07 08:52:47'),
(22, 1, 'Изменил статью <a href=\"http://work3.loc/admin/handbook/19/edit\">&laquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit.&raquo;</a>', 'success', 0, '2020-09-07 08:55:32'),
(23, 1, 'Изменил статью <a href=\"http://work3.loc/admin/handbook/19/edit\">&laquo;Lorem ipsum dolor, sit amet consectetur adipisicing elit.&raquo;</a>', 'success', 0, '2020-09-07 09:04:05'),
(24, 1, 'Изменил данные справочника', 'success', 0, '2020-09-08 05:59:48');

-- --------------------------------------------------------

--
-- Структура таблицы `admin_todo`
--

CREATE TABLE `admin_todo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `admin_todo`
--

INSERT INTO `admin_todo` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Новая задача', 1, '2018-12-11 06:13:35', NULL),
(2, 'Еще одна задача', 0, '2018-12-11 23:47:28', NULL),
(3, 'qwerty', 1, '2019-12-12 06:29:08', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `contract_number` varchar(50) NOT NULL,
  `contract_date` varchar(50) NOT NULL,
  `contract_file` varchar(255) NOT NULL,
  `land_area` float(8,2) UNSIGNED NOT NULL,
  `house_area` float(8,2) UNSIGNED NOT NULL,
  `quantity_residents` int(2) UNSIGNED NOT NULL,
  `сounters` text,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `areas`
--

INSERT INTO `areas` (`id`, `address`, `contract_number`, `contract_date`, `contract_file`, `land_area`, `house_area`, `quantity_residents`, `сounters`, `created_at`, `updated_at`) VALUES
(1, 'ул. Охтинская, д. 7', '564654656565', '2020-02-22', '', 12.00, 3.00, 5, '{\"water_number\":\"323232\",\"water_verify_date\":\"2020-02-21\",\"water_first_meter\":\"3\",\"electr_number\":\"4563456\",\"electr_verify_date\":\"2020-02-21\",\"electr_first_meter\":\"2\",\"electr_night_first_meter\":\"1\"}', '2020-07-09 12:24:04', '2020-07-09 12:24:08'),
(2, 'ул. Охтинская, д. 10', '3453454345', '2020-02-20', '', 15.00, 2.50, 3, '{\"water_number\":\"323232\",\"water_verify_date\":\"2020-02-21\",\"water_first_meter\":\"3\",\"electr_number\":\"4563456\",\"electr_verify_date\":\"2020-02-21\",\"electr_first_meter\":\"2\",\"electr_night_first_meter\":\"1\"}', '2020-07-09 12:25:02', '2020-07-09 12:25:05'),
(3, 'ул. Охтинская, д. 16', '34534543454', '2020-01-12', '', 20.00, 3.50, 4, '{\"water_number\":\"323232\",\"water_verify_date\":\"2020-02-21\",\"water_first_meter\":\"3\",\"electr_number\":\"4563456\",\"electr_verify_date\":\"2020-02-21\",\"electr_first_meter\":\"2\",\"electr_night_first_meter\":\"1\"}', '2020-07-09 12:25:53', '2020-07-09 12:25:55'),
(4, 'ул. Охтинская, д. 17', '1223412312', '2020-03-12', '', 20.00, 3.00, 3, '{\"water_number\":\"323232\",\"water_verify_date\":\"2020-02-21\",\"water_first_meter\":\"3\",\"electr_number\":\"4563456\",\"electr_verify_date\":\"2020-02-21\",\"electr_first_meter\":\"2\",\"electr_night_first_meter\":\"1\"}', '2020-07-10 09:40:00', '2020-07-10 09:40:00'),
(9, 'ул. Охтинская, д. 1', '23423423', '2020-07-17', 'files/Z747PevBjLngIhk5iNsyAI88vOyZKBwmbvy30BDa.jpeg', 30.00, 2.00, 2, '{\"water_number\":\"323232\",\"water_verify_date\":\"2020-02-21\",\"water_first_meter\":\"3\",\"electr_number\":\"4563456\",\"electr_verify_date\":\"2020-02-21\",\"electr_first_meter\":\"2\",\"electr_night_first_meter\":\"1\"}', '2020-07-17 11:43:47', '2020-07-17 11:43:47');

-- --------------------------------------------------------

--
-- Структура таблицы `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `description` text COLLATE utf8mb4_unicode_ci,
  `metakey` text COLLATE utf8mb4_unicode_ci,
  `metadesc` text COLLATE utf8mb4_unicode_ci,
  `published` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ordering` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `categories`
--

INSERT INTO `categories` (`id`, `parent_id`, `title`, `alias`, `image`, `description`, `metakey`, `metadesc`, `published`, `ordering`, `created_at`, `updated_at`) VALUES
(1, 0, 'Новости', 'news', NULL, 'Наши новости', '', '', '1', 0, NULL, NULL),
(2, 0, 'Объявления', 'adverts', NULL, 'Наши объявления', '', '', '1', 0, NULL, NULL),
(3, 1, 'Спорт', 'sport', NULL, '', NULL, NULL, '1', 0, NULL, NULL),
(4, 1, 'Экономика', 'economic', NULL, '', NULL, NULL, '1', 1, NULL, NULL),
(5, 1, 'Политика', 'politic', NULL, '', NULL, NULL, '1', 1, NULL, NULL),
(6, 0, 'Полезная информация', 'poleznaya-informatsiya-6', NULL, '', '', '', '1', 0, '2020-09-07 08:34:21', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `chat`
--

CREATE TABLE `chat` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat_message`
--

CREATE TABLE `chat_message` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `chat_user`
--

CREATE TABLE `chat_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `object_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `object_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_view` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('off','on','deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `content`
--

CREATE TABLE `content` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cat_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `introtext` text COLLATE utf8mb4_unicode_ci,
  `fulltext` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci,
  `created_by` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `updated_by` bigint(20) UNSIGNED NOT NULL DEFAULT '1',
  `published` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `metakey` text COLLATE utf8mb4_unicode_ci,
  `metadesc` text COLLATE utf8mb4_unicode_ci,
  `enable_comments` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `content`
--

INSERT INTO `content` (`id`, `title`, `alias`, `cat_id`, `introtext`, `fulltext`, `image`, `created_by`, `updated_by`, `published`, `metakey`, `metadesc`, `enable_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'О нас', 'about', 0, '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;', '', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(2, 'Voluptatem cumque consectetur delectus', 'voluptatem-cumque-consectetur-delectus-2', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(3, 'Unde enim earum voluptatem quasi', 'unde-enim-earum-voluptatem-quasi-3', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/HBVFLdg5mskLnZGV.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(4, 'Praesentium velit distinctio suscipit', 'praesentium-velit-distinctio-suscipit-4', 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(5, 'Magnam beatae delectus vitae', 'magnam-beatae-delectus-vitae-5', 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/HBVFLdg5mskLnZGV.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(6, 'Id doloremque quibusdam, praesentium velit distinctio suscipit labore neque', 'id-doloremque-quibusdam-praesentium-velit-distinctio-suscipit-labore-neque-6', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(7, 'Consequatur eligendi ut dolore consequuntur cumque', 'consequatur-eligendi-ut-dolore-consequuntur-cumque-7', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/HBVFLdg5mskLnZGV.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(8, 'Nihil cupiditate alias nobis reprehenderit fugiat', 'nihil-cupiditate-alias-nobis-reprehenderit-fugiat-8', 5, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(9, 'Corrupti velit distinctio suscipit', 'corrupti-velit-distinctio-suscipit-9', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/HBVFLdg5mskLnZGV.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL);
INSERT INTO `content` (`id`, `title`, `alias`, `cat_id`, `introtext`, `fulltext`, `image`, `created_by`, `updated_by`, `published`, `metakey`, `metadesc`, `enable_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(10, 'Rerum voluptatum facilis cumque perspiciatis voluptas', 'rerum-voluptatum-facilis-cumque-perspiciatis-voluptas-10', 4, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(11, 'Id doloremque quibusdam, praesentium velit distinctio suscipit labore neque', 'id-doloremque-quibusdam-praesentium-velit-distinctio-suscipit-labore-neque-11', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/HBVFLdg5mskLnZGV.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(12, 'Corrupti non numquam, nostrum neque earum delectus', 'corrupti-non-numquam-nostrum-neque-earum-delectus-12', 3, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Saepe dolore voluptas deleniti corrupti unde quisquam sequi delectus.', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', 'articles/WhVa4napoMunmLK3.jpg', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(14, 'Помощь', 'help', 0, '', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean rutrum est nec nulla vulputate feugiat. Fusce dolor lectus, hendrerit ut convallis at, posuere vitae erat. Nunc sed purus in dolor hendrerit sodales. Sed dignissim eleifend facilisis. Mauris imperdiet eros in nisl vulputate sed sollicitudin ante faucibus. Pellentesque cursus eros nec nisi pharetra sed gravida purus egestas. Cras ac consectetur purus. Cras dictum euismod orci et tincidunt. Mauris scelerisque lacinia eros eget posuere. Sed non tellus est, ac luctus mi. Morbi sodales ipsum id lacus euismod vel semper risus pretium.&lt;/p&gt;&lt;p&gt;In dictum iaculis diam nec ultricies. Mauris adipiscing tincidunt arcu eleifend scelerisque. Donec hendrerit mollis mauris, non hendrerit mauris luctus vitae. Donec congue elit ut erat semper eget ultrices sapien condimentum. Donec accumsan ligula ante, non gravida sapien. Morbi placerat sollicitudin mauris vel congue. Aenean ultricies dolor ut lorem rutrum non vestibulum diam bibendum. Praesent est lorem, malesuada dignissim scelerisque eu, interdum ut est. Sed fermentum pellentesque diam, ac varius lacus aliquam ac. Donec ac felis tortor, sed eleifend leo. Ut imperdiet accumsan mattis. Aliquam viverra fringilla mi vel posuere. Aliquam massa tortor, molestie sit amet rutrum sed, semper eu risus. Duis commodo felis in lacus venenatis dignissim. Nullam commodo venenatis justo sit amet venenatis. Proin feugiat eros at leo vestibulum quis aliquet nisl condimentum. Nulla porttitor mi eget mauris congue sodales. Nulla dui mauris, sagittis eget elementum ut, gravida eget enim. Duis diam nunc, cursus et venenatis eget, hendrerit at dolor.&lt;/p&gt;&lt;p&gt;Duis pretium, arcu eget blandit pulvinar, est purus viverra tellus, sit amet tempus ligula velit id ligula. Etiam convallis malesuada nisl sed commodo. In hac habitasse platea dictumst. Nullam ac massa mauris. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Integer fermentum imperdiet sodales. In nulla quam, varius ut ornare vitae, ultricies sed erat. Sed facilisis porta metus, vitae tempor metus ultricies et. Integer at libero nibh. Nam viverra euismod varius. Quisque vehicula sodales lorem, nec faucibus elit pretium quis. Duis ornare egestas libero, at congue sapien posuere eget. Maecenas sagittis ipsum sit amet massa congue adipiscing. Phasellus tristique cursus quam a rhoncus. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Donec malesuada, dui at bibendum fringilla, nulla velit fermentum velit, at mattis massa libero in quam. Ut interdum sagittis ante, eu dictum risus euismod sed. Nulla sagittis ante et lacus porttitor auctor. Praesent adipiscing dui a justo posuere rhoncus.&lt;/p&gt;&lt;p&gt;Curabitur fermentum erat at sem ultricies ut aliquet nunc aliquet. Sed metus erat, ornare eu cursus in, cursus non enim. Nullam adipiscing, neque sed convallis mollis, dolor tortor commodo nisi, non aliquet nulla elit rutrum risus. Integer tempus urna eu justo accumsan bibendum bibendum libero consectetur. Suspendisse nibh eros, fringilla pulvinar porta sed, blandit quis massa. Phasellus vestibulum, augue a mollis imperdiet, purus nunc pretium metus, sed sagittis diam lectus sollicitudin risus. Nunc non placerat sem. Cras id ipsum eu quam tempor laoreet sed a lorem. Fusce consectetur lorem sed odio vestibulum id porta elit fermentum. In dignissim aliquam sapien, sed hendrerit ligula vulputate in. In egestas consectetur est, quis ultrices risus posuere sed. Fusce arcu nibh, ornare at scelerisque ut, euismod et tellus. Praesent lobortis magna convallis dolor fringilla id malesuada enim porttitor. Duis imperdiet ligula ac arcu pharetra placerat. Aenean aliquet velit at magna tincidunt et ultrices sapien volutpat. Ut mollis tincidunt mi ac suscipit. Donec et odio lectus, eu elementum purus. In hac habitasse platea dictumst. Donec pharetra fringilla sem, in pretium risus volutpat nec. Morbi ac dui a arcu pharetra ullamcorper a in diam.&lt;/p&gt;&lt;p&gt;Curabitur semper porta eleifend. Aliquam luctus est nec turpis dignissim non vestibulum sapien tempor. Ut ultrices lacus mi. In accumsan hendrerit hendrerit. Donec dapibus, augue in dictum porta, tortor orci rutrum mauris, id lobortis sem augue eget lectus. Proin mattis, nulla ac elementum sollicitudin, tellus odio rhoncus felis, fermentum posuere enim augue eget felis. Ut nisl mi, sagittis non suscipit sit amet, pellentesque et velit. Phasellus pulvinar elit in diam accumsan tincidunt elementum ante porttitor. Nullam gravida viverra tincidunt. Sed erat felis, aliquet eget sollicitudin ac, congue ac mi. Ut tincidunt nisi vitae mi gravida ultricies. Integer pretium, elit eget vehicula congue, nulla dui porttitor leo, vel pharetra quam risus vitae elit. Nam gravida quam sed nunc porta accumsan. Vestibulum rhoncus, tortor at pulvinar tristique, tellus tellus euismod augue, et ultricies urna lorem non purus. Donec ac quam nec dolor sagittis dictum. Vestibulum facilisis luctus mauris, vel dapibus eros hendrerit sit amet.&lt;/p&gt;', '', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(15, 'Политика конфиденциальности', 'privacy_policy', 0, '', '&lt;p&gt;Тут будет страница, которую никто никогда не читает.&lt;/p&gt;', '', 1, 1, '1', '', '', '0', '2020-06-28 15:53:12', NULL, NULL),
(16, 'Состоится собрание жильцов', 'sostoitsya-sobranie-zhiltsov-16', 2, '24 июля состоится собрание жильцов.', '&lt;p&gt;24 июля состоится собрание жильцов. Будут обсуждаться следующие вопросы: проблема парковки, погашение задолженности по квартплате.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-07-25 10:24:42', '2020-07-25 11:28:07', NULL),
(17, 'Изменился телефон поста охраны', 'izmenilsya-telefon-posta-okhrany-17', 2, 'Изменился телефон поста охраны.', '&lt;p&gt;В связи с переходом с 1 апреля 2020 года охраны поселка в штат УК «Ламбери» и расторжением договора с охранной фирмой, изменился телефон поста охраны. Новый телефон охраны +7 (929) 661-14-07.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-07-25 10:31:37', '2020-07-25 11:28:00', NULL),
(18, 'Контакты', 'contacts', 0, NULL, '&lt;ul&gt;\r\n&lt;li&gt;+7 (342) 123-45-67 - Телефон директора &lt;/li&gt;\r\n&lt;li&gt;+7 (342) 123-45-67 - Телефон администратора&lt;/li&gt;\r\n&lt;li&gt;+7 (342) 123-45-67 - Телефон менеджера УК&lt;/li&gt;\r\n&lt;li&gt;+7 (342) 123-45-67 - Телефон охраны&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;mailto:email@email.ru&quot;&gt;email@email.ru&lt;/a&gt; - Наш email&lt;/li&gt;\r\n&lt;li&gt;&lt;a href=&quot;mailto:email@email.ru&quot;&gt;email@email.ru&lt;/a&gt; - Email УК&lt;/li&gt;\r\n&lt;/ul&gt;', NULL, 1, 1, '1', '', '', '1', '2020-09-07 06:47:41', '2020-09-07 06:51:04', NULL),
(19, 'Свежая подборка жилищного законодательства (2019-2020)', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-19', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(20, 'Что нужно знать каждому об установке и поверке счетчиков воды в доме?', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-20', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(21, 'Как установить приборы учета горячей и холодной воды в 2020 году - важные советы', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-21', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(22, 'Porro quaerat debitis explicabo natus enim recusandae', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-22', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(23, 'Lorem ipsum dolor, sit amet consectetur adipisicing elit.', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-23', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL);
INSERT INTO `content` (`id`, `title`, `alias`, `cat_id`, `introtext`, `fulltext`, `image`, `created_by`, `updated_by`, `published`, `metakey`, `metadesc`, `enable_comments`, `created_at`, `updated_at`, `deleted_at`) VALUES
(24, 'Id reprehenderit, temporibus consequuntur vero soluta placeat', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-24', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(25, 'Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-25', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(26, 'Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-26', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(27, 'Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-27', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(28, 'Mollitia repellendus laborum, soluta quibusdam quas ex velit a', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-28', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL),
(29, 'Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam', 'lorem-ipsum-dolor-sit-amet-consectetur-adipisicing-elit-29', 6, NULL, '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi atque obcaecati similique impedit quas tenetur dolorem, voluptate odit non excepturi necessitatibus harum quasi nam numquam aliquam culpa ex vel? Quam.&lt;/p&gt;\r\n&lt;p&gt;Voluptas corporis consequatur consectetur architecto ea sint numquam facere officia vel, inventore soluta laborum delectus laboriosam nisi quasi suscipit eligendi, fuga dolor laudantium aperiam! Labore animi, tenetur magni esse necessitatibus?&lt;/p&gt;\r\n&lt;p&gt;Quasi aspernatur nulla repudiandae aut ad voluptas. Corporis, nam, repellendus illo, aut ex expedita vero dolorem optio itaque voluptatum est blanditiis aperiam? Magni laboriosam maiores expedita eius repudiandae praesentium adipisci!&lt;/p&gt;\r\n&lt;p&gt;Vel laudantium nisi ullam, dolores eos qui ipsum ipsa ex expedita, totam cupiditate voluptas facilis quisquam sit molestiae animi ducimus ipsam repellat inventore id deserunt. Accusantium expedita sunt delectus natus.&lt;/p&gt;\r\n&lt;p&gt;Culpa libero necessitatibus accusantium aut quia veniam totam ut est consequuntur! Repellendus ut ipsum consequuntur aliquid voluptas veniam eligendi perspiciatis debitis saepe sit dolore aperiam, nam odio repellat, at, dicta.&lt;/p&gt;\r\n&lt;p&gt;Aperiam accusantium animi, modi nostrum impedit similique eum labore vitae nihil, quae suscipit, dolores? Ea facere commodi iure, quae ut rem illum itaque assumenda, repellat delectus, doloribus blanditiis consequuntur magnam.&lt;/p&gt;\r\n&lt;p&gt;Sed et illum nobis eos molestiae necessitatibus quisquam, aut, itaque consequuntur possimus pariatur, nulla non esse eius ipsum hic. Accusantium ipsam repellat nostrum aperiam animi in blanditiis, corporis minus a.&lt;/p&gt;\r\n&lt;p&gt;Numquam asperiores similique, quo mollitia? Reprehenderit possimus, sequi ducimus harum a quo quia, cupiditate adipisci aut rem. Dicta id nemo consequatur, animi ad possimus nihil ducimus quod distinctio nisi sunt.&lt;/p&gt;\r\n&lt;p&gt;A possimus modi fuga facilis debitis, nulla illo voluptas. Voluptate cupiditate voluptas ratione perspiciatis aliquam optio? Provident vitae magnam nostrum culpa mollitia iure, expedita similique consequatur quo repudiandae molestias velit.&lt;/p&gt;\r\n&lt;p&gt;Ad iure odit fuga, ratione, eos optio. Porro molestias architecto voluptas quia ducimus blanditiis nihil dolore? Dicta ullam deserunt hic impedit tempora at iusto labore ipsam. Ducimus blanditiis consequuntur consectetur!&lt;/p&gt;\r\n&lt;p&gt;Corporis velit, ullam veniam rerum perspiciatis sunt repellendus! Blanditiis, distinctio minus nesciunt incidunt quo mollitia, in doloribus tempora at eum, sit laborum. Nemo asperiores corrupti eum id dolorum itaque nostrum!&lt;/p&gt;\r\n&lt;p&gt;Id reprehenderit, temporibus consequuntur vero soluta placeat facilis velit quis iure quod distinctio aut, deleniti architecto rem non. Blanditiis culpa deserunt maxime aliquam optio expedita esse commodi laborum neque tenetur.&lt;/p&gt;\r\n&lt;p&gt;Voluptatem similique alias praesentium ullam dolor adipisci, inventore tenetur, deserunt repudiandae provident neque quod blanditiis minima incidunt exercitationem saepe non placeat ad. Iure natus dolorum, nemo minima obcaecati, minus officia.&lt;/p&gt;\r\n&lt;p&gt;Minus veritatis similique hic inventore. Mollitia repellendus laborum, soluta quibusdam quas ex velit a, rem, minus odit ducimus. Illum in provident eos ut dolorum corrupti necessitatibus dignissimos omnis vel sit.&lt;/p&gt;\r\n&lt;p&gt;Mollitia sapiente nostrum ab nisi obcaecati ipsam! Neque delectus animi porro quaerat, asperiores voluptates reiciendis nemo sit quia ratione eos commodi dolorem dolores ipsa eius cum corrupti rem et expedita.&lt;/p&gt;\r\n&lt;p&gt;Praesentium reprehenderit, soluta quam maxime, sit accusamus ut cupiditate facere deserunt nihil eius nesciunt illo ea. Assumenda molestiae, mollitia, sequi voluptatum fuga ipsa doloremque blanditiis rem dolorem dolores sed accusamus!&lt;/p&gt;\r\n&lt;p&gt;Commodi nemo facilis rem iste dolorum, eaque quis ipsam deleniti modi esse voluptate distinctio quibusdam magnam maxime, cum quam error sequi repudiandae a, molestiae soluta! Velit ipsum, assumenda sed esse!&lt;/p&gt;\r\n&lt;p&gt;Minus, modi voluptatem, voluptas hic, nostrum distinctio expedita odit tenetur voluptatibus est eligendi voluptatum, ducimus exercitationem explicabo dignissimos fuga tempore pariatur! Eaque sed quos velit adipisci accusamus excepturi perspiciatis, hic.&lt;/p&gt;\r\n&lt;p&gt;Nisi ut qui totam et beatae excepturi, nemo repellendus vitae commodi perferendis quis fuga atque ratione animi quas vero libero soluta doloribus, reprehenderit deleniti assumenda natus neque minima. Distinctio, qui.&lt;/p&gt;\r\n&lt;p&gt;Autem, cupiditate. Minus eos quia vero, soluta assumenda laudantium veniam repudiandae doloribus hic ipsam saepe aliquam consectetur iusto magni, at provident cum, eum cumque odio enim molestias asperiores nisi. Tempora.&lt;/p&gt;', NULL, 1, 1, '1', NULL, NULL, '1', '2020-09-07 08:52:47', '2020-09-07 09:04:05', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `faq`
--

CREATE TABLE `faq` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cat_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `question` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `faq`
--

INSERT INTO `faq` (`id`, `cat_id`, `name`, `email`, `question`, `answer`, `ip_address`, `published`, `created_at`, `updated_at`) VALUES
(1, 1, 'user1', 'user1@mail.ru', 'Eligendi incidunt numquam repudiandae eaque?', '&lt;p&gt;Lorem ipsum dolor sit amet, consectetur adipisicing elit. Veritatis repellat excepturi eius voluptate vel! Earum ea optio debitis iusto, odit id nam voluptate, dicta possimus obcaecati aliquam delectus recusandae enim.&lt;/p&gt;  &lt;p&gt;Eveniet labore illo, odio dolorem aliquam sapiente, nam corrupti in ea debitis id fugit deleniti non, praesentium maxime quod natus possimus odit aspernatur cupiditate itaque suscipit fugiat consectetur? Hic, aliquid?&lt;/p&gt;  &lt;p&gt;Nihil, provident expedita repudiandae exercitationem maxime rem commodi neque nisi architecto cumque nam enim! Officia ea nulla ex incidunt commodi, praesentium asperiores sequi nam! Ex ab magnam vero nulla iusto.&lt;/p&gt;', '192.168.0.1', '1', NULL, NULL),
(2, 1, 'user2', 'user2@mail.ru', 'Nihil provident expedita repudiandae exercitationem maxime rem commodi?', '&lt;p&gt;Itaque, eligendi! Eligendi incidunt numquam repudiandae eaque? Labore a, nostrum cum ratione laudantium impedit obcaecati, quibusdam dicta iure tempora ad inventore tempore aliquid. Accusantium repellat repellendus iste totam odit vel.&lt;/p&gt;', '192.168.0.1', '1', NULL, NULL),
(3, 2, 'user3', 'user3@mail.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit?', '&lt;p&gt;Nihil, provident expedita repudiandae exercitationem maxime rem commodi neque nisi architecto cumque nam enim! Officia ea nulla ex incidunt commodi, praesentium asperiores sequi nam! Ex ab magnam vero nulla iusto.&lt;/p&gt;  &lt;p&gt;Itaque, eligendi! Eligendi incidunt numquam repudiandae eaque? Labore a, nostrum cum ratione laudantium impedit obcaecati, quibusdam dicta iure tempora ad inventore tempore aliquid. Accusantium repellat repellendus iste totam odit vel.&lt;/p&gt;  &lt;p&gt;Quibusdam tempore voluptate ea modi, quidem quasi illo quisquam nostrum fugit, ipsa voluptatibus aspernatur provident harum quo corporis rem libero aliquid ratione sequi soluta atque doloremque? Eum accusamus voluptates consequuntur!&lt;/p&gt;', '192.168.0.1', '1', NULL, NULL),
(4, 0, 'user4', 'user4@mail.ru', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit?', 'null', '192.168.0.1', '0', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `faq_category`
--

CREATE TABLE `faq_category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `faq_category`
--

INSERT INTO `faq_category` (`id`, `title`) VALUES
(1, 'Категория 1'),
(2, 'Категория 2');

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `attach` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `answer` text COLLATE utf8mb4_unicode_ci,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_view` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `status` enum('on','spam','deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `images`
--

CREATE TABLE `images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `object_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `object_id` bigint(20) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mime_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` bigint(20) UNSIGNED NOT NULL,
  `main` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `ordering` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `parent_id` bigint(20) UNSIGNED NOT NULL DEFAULT '0',
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `page_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '1',
  `ordering` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menus`
--

INSERT INTO `menus` (`id`, `parent_id`, `group_id`, `type`, `page_id`, `title`, `link`, `icon`, `published`, `ordering`) VALUES
(1, 0, 1, 'internal_link', 0, 'Панель управления', '/', 'fa fa-home', '1', 1),
(2, 0, 1, 'internal_link', 0, 'Содержимое', '#', 'fa fa-files-o', '1', 2),
(3, 0, 1, 'internal_link', 0, 'Справочник', '/registry', 'fa fa-book', '1', 8),
(4, 0, 1, 'internal_link', 0, 'Компоненты', '#', 'fa fa-puzzle-piece', '1', 3),
(5, 0, 1, 'internal_link', 0, 'Пользователи', '#', 'fa fa-user', '1', 6),
(6, 0, 1, 'internal_link', 0, 'Отчеты', '#', 'fa fa-bar-chart-o', '1', 7),
(10, 4, 1, 'internal_link', 0, 'Категории', '/categories', '', '1', 1),
(11, 2, 1, 'internal_link', 0, 'Страницы', '/pages', '', '1', 2),
(16, 4, 1, 'internal_link', 0, 'Обратная связь', '/feedback', '', '1', 4),
(18, 5, 1, 'internal_link', 0, 'Группы', '/users/roles', '', '0', 1),
(20, 5, 1, 'internal_link', 0, 'Участки', '/areas', '', '1', 0),
(21, 6, 1, 'internal_link', 0, 'Статистика', '/statistic', '', '1', 1),
(22, 2, 1, 'internal_link', 0, 'Меню', '/menu', '', '1', 1),
(24, 5, 1, 'internal_link', 0, 'Пользователи', '/users', '', '1', 2),
(26, 4, 1, 'internal_link', 0, 'Комментарии', '/comments', '', '0', 3),
(28, 4, 1, 'internal_link', 0, 'Новости', '/articles', '', '1', 2),
(38, 4, 1, 'internal_link', 0, 'Faq', '/faq', '', '1', 6),
(56, 0, 2, 'internal_link', 0, 'Главная', '/', '', '1', 0),
(57, 0, 2, 'internal_link', 0, 'Контакты', '/page/contacts', '', '1', 1),
(58, 0, 2, 'page_link', 1, 'О нас', '/page/about', '', '1', 2),
(62, 0, 2, 'internal_link', 0, 'Вопрос - ответ', '/faq', '', '1', 6),
(72, 4, 1, 'internal_link', 0, 'Объявления', '/adverts', '', '1', 3),
(73, 4, 1, 'internal_link', 0, 'Услуги', '/services', '', '1', 5),
(74, 4, 1, 'internal_link', 0, 'Голосования', '/polls', '', '1', 3),
(75, 4, 1, 'internal_link', 0, 'Полезная информация', '/handbook', '', '1', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `menu_groups`
--

CREATE TABLE `menu_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `menu_groups`
--

INSERT INTO `menu_groups` (`id`, `name`, `title`) VALUES
(1, 'admin', 'Админ меню'),
(2, 'main', 'Главное меню');

-- --------------------------------------------------------

--
-- Структура таблицы `meters_data`
--

CREATE TABLE `meters_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `water` float(20,2) UNSIGNED DEFAULT NULL,
  `electricity` float(20,2) UNSIGNED DEFAULT NULL,
  `electricity_night` float(20,2) UNSIGNED DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `meters_data`
--

INSERT INTO `meters_data` (`id`, `area_id`, `water`, `electricity`, `electricity_night`, `paid_at`, `created_at`, `updated_at`) VALUES
(1, 1, 296.00, 843.00, 396.00, '2020-04-28 06:48:54', '2020-04-28 06:48:54', '2020-04-28 06:48:54'),
(2, 1, 319.00, 885.00, 427.00, '2020-05-28 08:25:16', '2020-05-28 08:25:16', '2020-05-28 08:25:16'),
(3, 1, 339.00, 939.00, 463.00, '2020-06-28 09:45:18', '2020-06-29 09:59:42', '2020-06-29 09:59:45'),
(5, 1, 278.00, 802.00, 382.00, '2020-03-28 06:48:54', '2020-03-28 06:48:54', '2020-03-28 06:48:54'),
(6, 1, 265.00, 786.00, 375.00, '2020-02-28 06:48:54', '2020-02-28 06:48:54', '2020-02-28 06:48:54'),
(7, 1, 250.00, 756.00, 333.00, '2020-01-28 06:48:54', '2020-01-28 06:48:54', '2020-01-28 06:48:54'),
(8, 1, 203.00, 723.00, 302.00, '2019-12-28 06:48:54', '2019-12-28 06:48:54', '2019-12-28 06:48:54'),
(9, 1, 159.00, 689.00, 286.00, '2019-11-28 06:48:54', '2019-11-28 06:48:54', '2019-11-28 06:48:54'),
(11, 1, 350.00, 960.00, 470.00, '2020-09-10 06:38:41', '2020-07-15 15:05:05', '2020-07-28 10:54:56'),
(12, 2, 15.00, 20.00, 10.00, NULL, '2020-07-16 03:32:41', '2020-07-16 03:32:41'),
(14, 3, NULL, 23.00, 12.00, NULL, '2020-07-28 11:28:47', '2020-07-28 11:28:47'),
(15, 1, 376.00, 988.00, 490.00, '2020-09-10 06:38:45', '2020-08-12 15:05:05', '2020-08-28 10:54:56'),
(16, 1, 0.00, 996.00, 502.00, NULL, '2020-09-10 06:39:17', '2020-09-10 06:39:17');

-- --------------------------------------------------------

--
-- Структура таблицы `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_10_21_190000_create_roles_table', 1),
(4, '2016_10_21_190000_create_settings_table', 1),
(5, '2016_11_30_135954_create_permission_table', 1),
(6, '2016_11_30_141208_create_permission_role_table', 1),
(7, '2017_11_26_015000_create_user_role_table', 1),
(8, '2019_08_28_095407_create_content_table', 1),
(9, '2019_08_28_100327_create_categories_table', 1),
(10, '2019_08_28_100350_create_menus_table', 1),
(11, '2019_08_28_100405_create_menu_groups_table', 1),
(12, '2019_09_06_063826_create_feedback_table', 1),
(13, '2019_09_18_084134_create_images_table', 1),
(14, '2019_09_19_143226_create_user_profile_table', 1),
(15, '2019_10_09_153241_create_faq_category_table', 1),
(16, '2019_10_09_153252_create_faq_table', 1),
(17, '2019_10_10_151929_create_comments_table', 1),
(18, '2019_11_27_132512_create_activities_table', 1),
(19, '2019_12_12_121423_create_statistic_table', 1),
(20, '2019_12_12_121452_create_tags_table', 1),
(21, '2019_12_12_121502_create_tags_content_table', 1),
(22, '2020_03_03_185748_create_admin_todo_table', 1),
(23, '2020_06_19_154051_create_notifications_table', 1),
(24, '2020_06_19_154625_create_user_settings_table', 1),
(25, '2020_06_19_154929_create_user_notifications_table', 1),
(26, '2020_06_23_132217_create_chat_table', 1),
(27, '2020_06_23_132657_create_chat_user_table', 1),
(28, '2020_06_23_133719_create_chat_message_table', 1),
(29, '2020_06_25_151739_create_abuse_table', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `sender_id` bigint(20) UNSIGNED DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `notifications`
--

INSERT INTO `notifications` (`id`, `sender_id`, `type`, `text`, `created_at`, `updated_at`) VALUES
(1, 1, 'message', '1 мая все приглашаются на субботник!', '2020-06-29 07:28:22', '2020-06-29 07:28:22'),
(28, 1, 'message', 'Привет, всем!', '2020-06-29 08:09:44', '2020-06-29 08:09:44'),
(29, 1, 'message', 'Привет!', '2020-06-29 08:10:04', '2020-06-29 08:10:04');

-- --------------------------------------------------------

--
-- Структура таблицы `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `amount` float(10,2) UNSIGNED DEFAULT NULL,
  `paid` float(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `paid_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `payments`
--

INSERT INTO `payments` (`id`, `area_id`, `amount`, `paid`, `created_at`, `paid_at`) VALUES
(1, 1, 1269.00, 1269.00, '2020-01-16 07:23:43', '2020-01-16 07:23:43'),
(2, 1, 1354.00, 1354.00, '2020-02-16 07:23:43', '2020-02-16 07:23:43'),
(3, 1, 1348.00, 1348.00, '2020-03-16 07:23:43', '2020-03-16 07:23:43'),
(4, 1, 1257.00, 1300.00, '2020-04-16 07:23:43', '2020-04-16 07:23:43'),
(5, 1, 1673.00, 1673.00, '2020-05-16 07:23:43', '2020-05-16 07:23:43'),
(6, 1, 1564.00, 1564.00, '2020-06-16 07:23:43', '2020-06-16 07:23:43'),
(7, 1, 1365.00, 10000.00, '2020-07-16 07:23:43', '2020-09-10 10:38:39'),
(8, 1, 1402.00, 0.00, '2020-08-16 07:23:43', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permissions`
--

INSERT INTO `permissions` (`id`, `key`, `table_name`, `created_at`, `updated_at`) VALUES
(1, 'browse_dashboard', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(2, 'browse_systems', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(3, 'browse_databases', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(4, 'browse_commands', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(5, 'browse_logs', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(7, 'browse_statistics', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(8, 'browse_hits', '', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(10, 'browse_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(11, 'create_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(12, 'store_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(13, 'edit_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(14, 'update_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(15, 'delete_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(16, 'activate_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(17, 'deactivate_menus', 'menus', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(18, 'browse_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(19, 'create_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(20, 'store_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(21, 'edit_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(22, 'update_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(23, 'delete_roles', 'roles', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(24, 'browse_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(25, 'create_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(26, 'store_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(27, 'edit_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(28, 'update_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(29, 'delete_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(30, 'activate_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(31, 'deactivate_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(32, 'browse_settings', 'settings', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(33, 'update_settings', 'settings', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(34, 'browse_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(35, 'create_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(36, 'store_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(37, 'edit_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(38, 'update_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(39, 'delete_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(40, 'activate_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(41, 'deactivate_categories', 'categories', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(42, 'browse_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(43, 'create_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(44, 'store_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(45, 'edit_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(46, 'update_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(47, 'delete_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(48, 'activate_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(49, 'deactivate_articles', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(50, 'browse_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(51, 'create_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(52, 'store_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(53, 'edit_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(54, 'update_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(55, 'delete_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(56, 'activate_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(57, 'deactivate_pages', 'content', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(58, 'browse_comments', 'comments', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(59, 'show_comments', 'comments', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(60, 'update_comments', 'comments', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(61, 'delete_comments', 'comments', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(62, 'activate_comments', 'comments', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(63, 'deactivate_comments', 'comments', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(64, 'restore_comments', 'comments', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(65, 'force_delete_comments', 'comments', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(77, 'browse_feedback', 'feedback', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(78, 'show_feedback', 'feedback', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(79, 'store_feedback', 'feedback', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(80, 'spam_feedback', 'feedback', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(81, 'restore_feedback', 'feedback', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(82, 'delete_feedback', 'feedback', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(83, 'force_delete_feedback', 'feedback', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(84, 'browse_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(85, 'create_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(86, 'store_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(87, 'edit_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(88, 'update_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(89, 'delete_faqs', 'faq', '2019-05-22 07:23:23', '2019-05-22 07:23:23'),
(90, 'activate_faqs', 'faq', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(91, 'deactivate_faqs', 'faq', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(164, 'edit_accounts', 'users', NULL, NULL),
(165, 'update_accounts', 'users', NULL, NULL),
(166, 'create_faq_categories', 'faq_category', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(167, 'store_faq_categories', 'faq_category', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(168, 'edit_faq_categories', 'faq_category', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(169, 'update_faq_categories', 'faq_category', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(170, 'delete_faq_categories', 'faq_category', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(171, 'browse_feeds', 'activities', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(172, 'delete_all_feeds', 'activities', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(173, 'banned_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(182, 'notify_users', 'abuses', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(183, 'browse_abuses', 'abuses', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(184, 'show_abuses', 'abuses', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(185, 'delete_abuses', 'abuses', '2019-05-11 12:10:02', '2019-05-11 12:10:02'),
(186, 'invite_users', 'users', '2019-05-11 12:10:02', '2019-05-11 12:10:02');

-- --------------------------------------------------------

--
-- Структура таблицы `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 3),
(1, 4),
(24, 3),
(25, 3),
(26, 3),
(27, 3),
(28, 3),
(29, 3),
(30, 3),
(31, 3),
(34, 4),
(35, 4),
(36, 4),
(37, 4),
(38, 4),
(39, 4),
(40, 4),
(41, 4),
(42, 4),
(43, 4),
(44, 4),
(45, 4),
(46, 4),
(47, 4),
(48, 4),
(49, 4),
(50, 4),
(51, 4),
(52, 4),
(53, 4),
(54, 4),
(55, 4),
(56, 4),
(57, 4),
(77, 3),
(78, 3),
(79, 3),
(80, 3),
(81, 3),
(82, 3),
(83, 3),
(84, 3),
(85, 3),
(86, 3),
(87, 3),
(88, 3),
(89, 3),
(90, 3),
(91, 3),
(164, 3),
(165, 3),
(166, 3),
(167, 3),
(168, 3),
(169, 3),
(170, 3),
(173, 3),
(182, 3),
(183, 3),
(184, 3),
(185, 3),
(186, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `polls`
--

CREATE TABLE `polls` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `multiselect` enum('0','1') NOT NULL DEFAULT '0',
  `started_at` date DEFAULT NULL,
  `ended_at` date DEFAULT NULL,
  `published` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `polls`
--

INSERT INTO `polls` (`id`, `title`, `description`, `multiselect`, `started_at`, `ended_at`, `published`, `created_at`, `updated_at`) VALUES
(1, 'Нужна ли нам парковка?', 'Как известно, малая территория двора не позволяет разместиться всем транспортным средствам. Предлагаем оборудовать парковку.', '0', '2020-07-25', '2020-07-30', '1', '2020-07-26 09:06:42', '2020-07-26 09:06:45');

-- --------------------------------------------------------

--
-- Структура таблицы `polls_answers`
--

CREATE TABLE `polls_answers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `question_id` bigint(20) UNSIGNED NOT NULL,
  `title` text NOT NULL,
  `ordering` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `polls_answers`
--

INSERT INTO `polls_answers` (`id`, `question_id`, `title`, `ordering`) VALUES
(1, 1, 'За', 0),
(2, 1, 'Против', 0),
(3, 1, 'Воздержался', 0),
(4, 2, 'За', 0),
(5, 2, 'Против', 0),
(6, 2, 'Воздержался', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `polls_questions`
--

CREATE TABLE `polls_questions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `polls_questions`
--

INSERT INTO `polls_questions` (`id`, `poll_id`, `title`, `description`) VALUES
(1, 1, ' Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', ''),
(2, 1, ' Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '');

-- --------------------------------------------------------

--
-- Структура таблицы `poll_user`
--

CREATE TABLE `poll_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `poll_id` bigint(20) UNSIGNED NOT NULL,
  `answers` text NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `poll_user`
--

INSERT INTO `poll_user` (`id`, `user_id`, `poll_id`, `answers`, `comment`, `created_at`) VALUES
(14, 2, 1, '[2,6]', 'testing...', '2020-07-27 10:47:24');

-- --------------------------------------------------------

--
-- Структура таблицы `registry`
--

CREATE TABLE `registry` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `value` text NOT NULL,
  `group` varchar(50) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `registry`
--

INSERT INTO `registry` (`id`, `key`, `title`, `value`, `group`, `created_at`, `updated_at`) VALUES
(5, 'total_area', 'Общая площадь ДНП', '11000', '', '2020-05-30 14:50:31', '2020-07-08 15:42:34'),
(6, 'meter_reading_period_start', 'Период сдачи показаний, начало', '5', '', '2020-05-30 14:50:31', '2020-07-08 15:42:34'),
(7, 'meter_reading_period_end', 'Период сдачи показаний, конец', '15', '', '2020-05-30 14:50:31', '2020-07-08 15:42:34'),
(8, '2020_05_30_195031_tariff', '', '{\"water\":\"33.140\",\"electricity\":\"4.120\",\"electricity_night\":\"2.75\", \"end_day\":\"2020-06-30\"}', 'tariff_data', '2020-05-30 14:50:31', '2020-06-30 14:50:31'),
(9, '2020_06_30_195031_tariff', '', '{\"water\":\"33.150\",\"electricity\":\"4.220\",\"electricity_night\":\"2.8\", \"end_day\":\"2020-07-20\"}', 'tariff_data', '2020-06-30 14:50:31', '2020-06-30 14:50:31'),
(12, '2020_07_08_210730_tariff', NULL, '{\"water\":\"33.03\",\"electricity\":\"4.200\",\"electricity_night\":\"2.66\",\"end_day\":\"2020-08-08\"}', 'tariff_data', '2020-07-08 16:07:30', '2020-07-08 16:07:30'),
(13, 'date_receipt_calculation', 'Дата расчета квитанций', '20', '', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`) VALUES
(1, 'admin', 'Администратор'),
(2, 'user', 'Пользователь'),
(3, 'manager_uk', 'Менеджер УК'),
(4, 'content_manager', 'Менеджер контента');

-- --------------------------------------------------------

--
-- Структура таблицы `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `unit` varchar(10) NOT NULL,
  `price` varchar(191) NOT NULL,
  `name_company` varchar(191) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `address` text NOT NULL,
  `url` varchar(191) DEFAULT NULL,
  `published` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `services_groups`
--

CREATE TABLE `services_groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `description` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `services_groups`
--

INSERT INTO `services_groups` (`id`, `title`, `description`) VALUES
(1, 'Стрижка газона', NULL),
(2, 'Электро-монтажные работы', NULL),
(3, 'Благоустройство и озеленение', NULL),
(4, 'Механические работы', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `service_requests`
--

CREATE TABLE `service_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `description` text NOT NULL,
  `status` int(1) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `service_requests`
--

INSERT INTO `service_requests` (`id`, `area_id`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Вышел из строя водяной насос', 3, '2020-07-16 07:48:29', '2020-07-16 07:48:34'),
(2, 2, 'Протекает крыша дома', 2, '2020-07-16 07:50:01', '2020-07-16 07:50:05'),
(3, 2, 'Не работает свет на столбе у стоянки', 1, '2020-07-16 08:10:07', '2020-07-16 08:10:11'),
(4, 2, 'Ключ от двери домофона срабатывает через раз', 0, '2020-07-16 08:24:13', '2020-07-16 08:24:16'),
(5, 1, 'test', 0, '2020-08-17 11:32:28', '2020-08-17 11:32:28');

-- --------------------------------------------------------

--
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `value` text COLLATE utf8mb4_unicode_ci,
  `help` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'input',
  `ordering` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `key`, `description`, `value`, `help`, `type`, `group`, `field`, `ordering`) VALUES
(1, 'enable_comments', 'Отображать комментарии', '1', '', 'comments', NULL, 'checkbox', 0),
(2, 'list_contents_count', 'Число записей на странице', '20', NULL, 'articles', NULL, 'input', 1),
(3, 'meta_keywords', 'Ключевые слова, для SEO', 'web, site, html5, responsive, layout, sxcore, laravel, starter, project', NULL, 'seo', NULL, 'textarea', 4),
(4, 'site_title', 'Заголовок сайта', 'Laravel starter project', NULL, 'general', NULL, 'input', 3),
(5, 'meta_description', 'Краткое описание, для SEO', 'Laravel starter project', NULL, 'seo', NULL, 'textarea', 5),
(6, 'phone', 'Телефон', '+7 (654) 65-46-546', NULL, 'contacts', NULL, 'input', 1),
(8, 'email', 'Email администратора сайта', 'admin@gmail.com', NULL, 'contacts', NULL, 'input', 4),
(10, 'facebook', 'Facebook', '', NULL, 'contacts', NULL, 'input', 14),
(11, 'vkontakte', 'ВКонтакте', 'http://vk.com/baluev_rv', NULL, 'contacts', NULL, 'input', 10),
(12, 'twitter', 'Twitter', '', NULL, 'contacts', NULL, 'input', 11),
(13, 'skype', 'Skype', '', NULL, 'contacts', NULL, 'input', 13),
(14, 'address', 'Адрес', 'Российская Федерация, Пермский край, г. Пермь, 614022', NULL, 'contacts', NULL, 'textarea', 0),
(15, 'instagram', 'Instagram', '', NULL, 'contacts', NULL, 'input', 12),
(16, 'site_name', 'Название сайта', 'SX-Core', NULL, 'general', NULL, 'input', 2),
(17, 'google_analytics_id', 'ID Google.Analytics', '', '<a href=\"https://analytics.google.com/analytics/web\" target=\"_blank\">Настроить</a>', 'seo', NULL, 'input', 0),
(18, 'yandex_metric_id', 'ID Yandex.Metrika', '', '<a href=\"https://metrika.yandex.ru/list\" target=\"_blank\">Настроить</a>', 'seo', NULL, 'input', 1),
(19, 'google_site_verification', 'G.Вэбмастер, ключ для верификации сайта', '', '<a href=\"https://www.google.ru/intl/ru/webmasters\" target=\"_blank\">Настроить</a>', 'seo', NULL, 'input', 2),
(20, 'yandex_verification', 'Я.Вэбмастер, ключ для верификации сайта', '', '<a href=\"https://webmaster.yandex.ru\" target=\"_blank\">Настроить</a>', 'seo', NULL, 'input', 3),
(21, 'site_offline', 'Сайт не доступен', '0', 'Внимание! Сайт будет не доступен! Пользователи будут видеть сообщение, что сайт на обслуживании!', 'general', NULL, 'checkbox', 5),
(23, 'admin_developers', 'Разработчикам', '1', 'Включить режим разработчика', 'general', NULL, 'checkbox', 4),
(24, 'email_support', 'Email для поддержки', 'admin@gmail.com', NULL, 'contacts', NULL, 'input', 7),
(28, 'phone2', 'Телефон 2', '+7 (654) 65-46-546', NULL, 'contacts', NULL, 'input', 2),
(29, 'list_comments_count', 'Число комментариев на странице', '10', '', 'comments', NULL, 'input', 0),
(31, 'instagram_token', 'Access Token', '373761376.1677ed0.454fe78112d24c85b2c55903e3b4b8a5', '<a href=\"http://instagram.pixelunion.net/\" target=\"_blank\">Сгенерировать Token</a>', 'keys', 'Instagram', 'input', 1),
(32, 'instagram_photo_amount', 'Кол-во фото', '4', 'Кол-во выводимых фотографий на сайте', 'keys', 'Instagram', 'input', 1),
(33, 'recaptcha_public_key', 'Публичный ключ', '', '', 'keys', 'Recaptcha', 'input', 3),
(34, 'recaptcha_secret_key', 'Секретный ключ', '', '<a href=\"https://www.google.com/recaptcha/admin\" target=\"_blank\">Настроить</a>', 'keys', 'Recaptcha', 'input', 4),
(35, 'google_maps_key', 'Ключ API Google Maps', 'AIzaSyDYWFd5B9y-oGk4311tpUha7WOBCuWWqu8', '<a href=\"https://developers.google.com/maps/documentation/javascript/get-api-key?hl=ru\" target=\"_blank\">Получить ключ</a>', 'keys', 'Google', 'input', 4),
(46, 'admin_notes', '', NULL, NULL, 'admin', NULL, 'input', 0),
(47, 'yandex_key_secret', 'Секретный ключ Yandex.Money', 'WbyQHWrS9gjlRW6K3s9uO3i3', NULL, '', 'YandexMoney', 'input', 0),
(48, 'user_notification_method', 'Способ получения уведомлений', 'email', NULL, 'user', '', 'radio', 0),
(49, 'user_notification_news_events', 'Получать уведомления о новостях и событиях в поселке?', '1', NULL, 'user', '', 'checkbox', 0),
(50, 'user_send_billing', 'Высылать письмо с квитанцией на оплату услуг ЖКХ', '0', NULL, 'user', '', 'checkbox', 0),
(51, 'user_notification_time_from', 'Желаемое время для напоминаний сдачи показаний, от', NULL, NULL, 'user', NULL, 'input', 0),
(52, 'user_notification_time_to', 'Желаемое время для напоминаний сдачи показаний, до', NULL, NULL, 'user', NULL, 'input', 0);

-- --------------------------------------------------------

--
-- Структура таблицы `statistics`
--

CREATE TABLE `statistics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `last_visit` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `visits` int(10) UNSIGNED NOT NULL,
  `params` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `statistics`
--

INSERT INTO `statistics` (`id`, `ip_address`, `uid`, `user_agent`, `user_id`, `last_visit`, `visits`, `params`, `created_at`, `updated_at`) VALUES
(1, '127.0.0.1', '9df61fb35952199adc6064b06ed93d60', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/83.0.4103.116 Safari/537.36', 0, '2020-07-17 15:39:57', 33, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:13:\"83.0.4103.116\";s:8:\"platform\";s:10:\"Windows 10\";s:11:\"device_type\";s:7:\"desktop\";s:19:\"device_manufacturer\";s:0:\"\";s:12:\"device_model\";s:0:\"\";s:8:\"referrer\";s:30:\"http://lambery.loc/admin/users\";}', NULL, NULL),
(2, '127.0.0.1', '0b5827766219093e964602290600b183', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Safari/537.36', 0, '2020-07-29 12:31:04', 14, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:12:\"84.0.4147.89\";s:8:\"platform\";s:10:\"Windows 10\";s:11:\"device_type\";s:7:\"desktop\";s:19:\"device_manufacturer\";s:0:\"\";s:12:\"device_model\";s:0:\"\";s:8:\"referrer\";s:37:\"http://lambery.loc/admin/users/6/edit\";}', NULL, NULL),
(3, '127.0.0.1', 'a530ef0f63a052a7f4f28273a3622451', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/84.0.4147.89 Mobile Safari/537.36', 2, '2020-07-24 15:17:32', 1, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:12:\"84.0.4147.89\";s:8:\"platform\";s:11:\"Android 6.0\";s:11:\"device_type\";s:6:\"mobile\";s:19:\"device_manufacturer\";s:2:\"LG\";s:12:\"device_model\";s:7:\"Nexus 5\";s:8:\"referrer\";s:35:\"http://lambery.loc/admin/categories\";}', NULL, NULL),
(4, '127.0.0.1', 'baa1b6da28cdaeb85874a9a00db0f6e4', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Safari/537.36', 0, '2020-09-16 09:40:24', 91, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:13:\"76.0.3809.132\";s:8:\"platform\";s:10:\"Windows 10\";s:11:\"device_type\";s:7:\"desktop\";s:19:\"device_manufacturer\";s:0:\"\";s:12:\"device_model\";s:0:\"\";s:8:\"referrer\";s:0:\"\";}', NULL, NULL),
(5, '127.0.0.1', 'b792b575d69bef8e7b2000934058949d', 'Mozilla/5.0 (iPhone; CPU iPhone OS 11_0 like Mac OS X) AppleWebKit/604.1.38 (KHTML, like Gecko) Version/11.0 Mobile/15A372 Safari/604.1', 2, '2020-09-02 09:29:28', 1, 'a:7:{s:7:\"browser\";s:6:\"Safari\";s:15:\"browser_version\";s:4:\"11.0\";s:8:\"platform\";s:8:\"iOS 11.0\";s:11:\"device_type\";s:6:\"mobile\";s:19:\"device_manufacturer\";s:5:\"Apple\";s:12:\"device_model\";s:6:\"iPhone\";s:8:\"referrer\";s:22:\"http://work3.loc/login\";}', NULL, NULL),
(6, '127.0.0.1', '38a5940d19feb1240b3ad519354d3a4a', 'Mozilla/5.0 (Linux; U; Android 4.3; en-us; SM-N900T Build/JSS15J) AppleWebKit/534.30 (KHTML, like Gecko) Version/4.0 Mobile Safari/534.30', 2, '2020-09-02 09:29:34', 1, 'a:7:{s:7:\"browser\";s:15:\"Android Browser\";s:15:\"browser_version\";s:0:\"\";s:8:\"platform\";s:11:\"Android 4.3\";s:11:\"device_type\";s:6:\"mobile\";s:19:\"device_manufacturer\";s:7:\"Samsung\";s:12:\"device_model\";s:13:\"Galaxy Note 3\";s:8:\"referrer\";s:22:\"http://work3.loc/login\";}', NULL, NULL),
(7, '127.0.0.1', '4d0b1e973936fc1feea6627b9fac4ba8', 'Mozilla/5.0 (iPad; CPU OS 11_0 like Mac OS X) AppleWebKit/604.1.34 (KHTML, like Gecko) Version/11.0 Mobile/15A5341f Safari/604.1', 2, '2020-09-02 09:29:39', 1, 'a:7:{s:7:\"browser\";s:6:\"Safari\";s:15:\"browser_version\";s:4:\"11.0\";s:8:\"platform\";s:8:\"iOS 11.0\";s:11:\"device_type\";s:6:\"tablet\";s:19:\"device_manufacturer\";s:5:\"Apple\";s:12:\"device_model\";s:4:\"iPad\";s:8:\"referrer\";s:22:\"http://work3.loc/login\";}', NULL, NULL),
(8, '127.0.0.1', 'a530930d61193d969d18861441a2197f', 'Mozilla/5.0 (Linux; Android 5.0; SM-G900P Build/LRX21T) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36', 2, '2020-09-02 09:29:48', 1, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:13:\"76.0.3809.132\";s:8:\"platform\";s:11:\"Android 5.0\";s:11:\"device_type\";s:6:\"mobile\";s:19:\"device_manufacturer\";s:7:\"Samsung\";s:12:\"device_model\";s:9:\"Galaxy S5\";s:8:\"referrer\";s:22:\"http://work3.loc/login\";}', NULL, NULL),
(9, '127.0.0.1', '3e8aecca17e9082409c6ec4452b84126', 'Mozilla/5.0 (Linux; Android 6.0; Nexus 5 Build/MRA58N) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/76.0.3809.132 Mobile Safari/537.36', 2, '2020-09-02 09:30:42', 1, 'a:7:{s:7:\"browser\";s:6:\"Chrome\";s:15:\"browser_version\";s:13:\"76.0.3809.132\";s:8:\"platform\";s:11:\"Android 6.0\";s:11:\"device_type\";s:6:\"mobile\";s:19:\"device_manufacturer\";s:2:\"LG\";s:12:\"device_model\";s:7:\"Nexus 5\";s:8:\"referrer\";s:22:\"http://work3.loc/login\";}', NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tags`
--

CREATE TABLE `tags` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `tags_content`
--

CREATE TABLE `tags_content` (
  `object_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'articles',
  `object_id` bigint(20) UNSIGNED NOT NULL,
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `ip_address` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_login_at` timestamp NULL DEFAULT NULL,
  `invited_at` timestamp NULL DEFAULT NULL,
  `invite_attempts` tinyint(3) UNSIGNED DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_token` varchar(80) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('off','on','banned','deleted') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'on',
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `ip_address`, `password`, `remember_token`, `last_login_at`, `invited_at`, `invite_attempts`, `created_at`, `updated_at`, `api_token`, `status`, `deleted_at`) VALUES
(1, 'admin', 'admin@admin.ru', NULL, '127.0.0.1', '$2y$10$5pBhFFSppEgWEjAgSvfTs.cD/8jgf1qoF.AT3GleKW51amm7j0/9G', NULL, '2020-09-10 06:38:25', NULL, 0, NULL, '2020-09-10 06:38:25', '6ABQHegoP1Wk75ZQd13x6khcGXgevZe7C4vU1F9qus5aTPcLow9XVJtrwx4kald65nfnN09hF5sxcz0Z', 'on', NULL),
(2, 'Афонина Алина Викторовна', 's-fr@yandex.ru', NULL, '127.0.0.1', '$2y$10$XvBTaWKDpSj20gVfSAqmGextF273TMi/SWRAhz9AK/ffP3aX6fPZS', NULL, '2020-09-16 04:07:05', '2020-06-29 07:26:56', 0, '2020-06-29 07:01:50', '2020-09-16 04:07:05', 'l1zD1oiRSako3ajszpmOcaTbCqJehaSxpjoALARZqv3k2w2nvF7qCxtvXRIeJJnGsvhDFRvb6LRBX9lJ', 'on', NULL),
(3, 'Иванова Ирина Федоровна', 'ivanova@gmail.com', NULL, '', '', NULL, NULL, NULL, 0, '2020-06-29 07:06:14', '2020-06-29 07:06:14', 'RtMdYCgBQNGFqejDi2IHAgYh5RAWpfOUkiONbS1Dz4jQxhuFo0172XfJ3vSPCjGTnFPbV2LchOty2qRG', 'on', NULL),
(4, 'Шилова Ольга Ивановна', 'shilova@mail.ru', NULL, '', '', NULL, NULL, NULL, 0, '2020-06-29 09:42:01', '2020-06-29 09:42:01', 'iQQCGmq52KPfwqmDzwXkmcqNWGpaJtDs7V44WlbUtq7CxGWs2RW5PFnzGIU4K8ZgnKA9qi2O6DBHRXnW', 'on', NULL),
(5, 'Иванов Иван Иванович', 'ivanov_ii@mail.ru', NULL, '', '', NULL, NULL, NULL, 0, '2020-07-10 09:46:23', '2020-07-10 09:46:23', 'v4Llr9jSMLlYSVxnC7AIXr5GfvNDBPD8b27OKEL9SCxPed5flA6nTZlThd2QHdgFjqpP3ZubD6IRf2OH', 'on', NULL),
(6, 'Петров Александр Владимирович', 'petroff@mail.ru', NULL, '127.0.0.1', '$2y$10$2lahgHBuSFcjdMZgJ.TPreGgtsOiqcDJf4tOyhKZwEl6h.yhK1vMK', NULL, '2020-07-18 10:37:47', NULL, 0, '2020-07-10 14:08:11', '2020-07-18 10:37:47', '5s7rItCMfFNhfArNf0pXdxOOMLKhpYBC91VOZABRBWqtVmd8xrOVwChRgl3Z7ZOz778Nwagz9Gx2a4lR', 'on', NULL),
(7, 'Новиков Николай Иванович', 'novikoff@mail.ru', NULL, '', '', NULL, NULL, NULL, 0, '2020-07-18 12:59:37', '2020-07-18 12:59:37', '3NXWusGUXKk270vmGawtmyMzU0SS7FqqF5svv2VgzA3x53DS0PZncnkoNhYFzkAPGgD4WnZERM7WrVds', 'on', NULL),
(12, 'Шпак Антон Семёнович', 'shpak@mail.ru', NULL, '', '$2y$10$6LZiY/uWDUlwQm.Y3Z6NQeQSosZIzYv492za4zuPFQueIsV9H29qi', NULL, NULL, '2020-07-18 13:14:41', 0, '2020-07-18 13:14:40', '2020-07-18 13:14:41', 'ZYBEjI3hpbcGSPgbqwt0gMKfpFPB3X2D2aYZVXw7Dtg3d0jywvy0nXobzi9PVEF7VGhKv2BPQxFn7Fhv', 'on', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_area`
--

CREATE TABLE `user_area` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `main` enum('off','on') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'off'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=COMPACT;

--
-- Дамп данных таблицы `user_area`
--

INSERT INTO `user_area` (`id`, `user_id`, `area_id`, `main`) VALUES
(1, 2, 1, 'on'),
(2, 3, 2, 'on'),
(4, 4, 4, 'on'),
(5, 5, 2, 'off'),
(6, 3, 9, 'on'),
(10, 12, 3, 'on');

-- --------------------------------------------------------

--
-- Структура таблицы `user_area_history`
--

CREATE TABLE `user_area_history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_area_history`
--

INSERT INTO `user_area_history` (`id`, `user_id`, `area_id`) VALUES
(7, 4, 3),
(8, 7, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `user_balance`
--

CREATE TABLE `user_balance` (
  `id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `balance` float(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `user_notification`
--

CREATE TABLE `user_notification` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `notification_id` bigint(20) UNSIGNED NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_notification`
--

INSERT INTO `user_notification` (`id`, `user_id`, `notification_id`, `read_at`) VALUES
(1, 2, 1, '2020-06-29 11:05:59'),
(31, 2, 28, NULL),
(32, 2, 29, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_profile`
--

CREATE TABLE `user_profile` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `phone` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone2` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_verified_at` timestamp NULL DEFAULT NULL,
  `avatar` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vkontakte` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `facebook` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `twitter` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `odnoklassniki` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telegram` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_profile`
--

INSERT INTO `user_profile` (`id`, `user_id`, `phone`, `phone2`, `phone_verified_at`, `avatar`, `vkontakte`, `facebook`, `twitter`, `odnoklassniki`, `telegram`) VALUES
(1, 1, '', '', NULL, 'avatars/thumbs/200/9e3607b72b33.jpg', NULL, NULL, NULL, NULL, NULL),
(2, 2, '+7 (908) 24-58-251', '+7 (908) 24-58-2522', NULL, 'avatars/ssxtk4I7fOAWl2wW.jpg', '', '', '', 'ok.ru/afonina-85', '@afonina-85'),
(3, 3, '+79638760737', '+79026462602', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 4, '+7 (987) 98-78-798', '+7 (323) 26-68-465', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 5, '+7 (654) 65-46-546', '+7 (654) 65-46-545', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 6, '+7 (234) 23-42-342', '+7 (234) 23-42-343', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 7, '+7 (656) 54-65-465', '+7 (654) 54-65-451', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 12, '+7 (234) 23-42-342', '+7 (345) 56-45-745', NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `user_role`
--

CREATE TABLE `user_role` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_role`
--

INSERT INTO `user_role` (`user_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(6, 3),
(7, 2),
(12, 2);

-- --------------------------------------------------------

--
-- Структура таблицы `user_service`
--

CREATE TABLE `user_service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `service_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('Y','N') NOT NULL,
  `sum` float(20,2) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Структура таблицы `user_setting`
--

CREATE TABLE `user_setting` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `setting_id` bigint(20) UNSIGNED NOT NULL,
  `setting_value` text COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `user_setting`
--

INSERT INTO `user_setting` (`id`, `user_id`, `setting_id`, `setting_value`) VALUES
(180, 2, 48, 'sms'),
(181, 2, 49, '0'),
(182, 2, 50, '1'),
(183, 2, 51, '12:00'),
(184, 2, 52, '15:00');

-- --------------------------------------------------------

--
-- Структура таблицы `user_transactions`
--

CREATE TABLE `user_transactions` (
  `id` bigint(20) NOT NULL,
  `area_id` bigint(20) NOT NULL,
  `operation` tinyint(4) NOT NULL COMMENT '0 - минус, 1 - плюс',
  `description` varchar(255) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `area_id`, `operation`, `description`, `amount`, `created_at`) VALUES
(1, 1, 1, 'Оплата в сервисе', 10000.00, '2020-07-15 06:39:21'),
(2, 1, 0, 'Оплата за июль 2020', 7600.00, '2020-07-13 06:39:21'),
(3, 1, 1, 'Оплата в сервисе', 10000.00, '2020-08-15 06:39:21'),
(4, 1, 0, 'Оплата за август 2020', 6800.00, '2020-08-13 06:39:21');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `abuses`
--
ALTER TABLE `abuses`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `activities`
--
ALTER TABLE `activities`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `admin_todo`
--
ALTER TABLE `admin_todo`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `chat_user`
--
ALTER TABLE `chat_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `content`
--
ALTER TABLE `content`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `faq_category`
--
ALTER TABLE `faq_category`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `menu_groups`
--
ALTER TABLE `menu_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `meters_data`
--
ALTER TABLE `meters_data`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Индексы таблицы `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permissions_key_index` (`key`);

--
-- Индексы таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_permission_id_index` (`permission_id`),
  ADD KEY `permission_role_role_id_index` (`role_id`);

--
-- Индексы таблицы `polls`
--
ALTER TABLE `polls`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polls_answers`
--
ALTER TABLE `polls_answers`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `polls_questions`
--
ALTER TABLE `polls_questions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `poll_user`
--
ALTER TABLE `poll_user`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `registry`
--
ALTER TABLE `registry`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `key` (`key`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Индексы таблицы `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `services_groups`
--
ALTER TABLE `services_groups`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `service_requests`
--
ALTER TABLE `service_requests`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_key_unique` (`key`);

--
-- Индексы таблицы `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `tags_content`
--
ALTER TABLE `tags_content`
  ADD KEY `tags_content_tag_id_foreign` (`tag_id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Индексы таблицы `user_area`
--
ALTER TABLE `user_area`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_area_history`
--
ALTER TABLE `user_area_history`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_balance`
--
ALTER TABLE `user_balance`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_notification`
--
ALTER TABLE `user_notification`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_profile`
--
ALTER TABLE `user_profile`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD KEY `user_role_user_id_foreign` (`user_id`),
  ADD KEY `user_role_role_id_foreign` (`role_id`);

--
-- Индексы таблицы `user_service`
--
ALTER TABLE `user_service`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_setting`
--
ALTER TABLE `user_setting`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `abuses`
--
ALTER TABLE `abuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT для таблицы `activities`
--
ALTER TABLE `activities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `admin_todo`
--
ALTER TABLE `admin_todo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `chat`
--
ALTER TABLE `chat`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `chat_user`
--
ALTER TABLE `chat_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `content`
--
ALTER TABLE `content`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `faq`
--
ALTER TABLE `faq`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `faq_category`
--
ALTER TABLE `faq_category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `images`
--
ALTER TABLE `images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT для таблицы `menu_groups`
--
ALTER TABLE `menu_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `meters_data`
--
ALTER TABLE `meters_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT для таблицы `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT для таблицы `polls`
--
ALTER TABLE `polls`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `polls_answers`
--
ALTER TABLE `polls_answers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `polls_questions`
--
ALTER TABLE `polls_questions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `poll_user`
--
ALTER TABLE `poll_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT для таблицы `registry`
--
ALTER TABLE `registry`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `services_groups`
--
ALTER TABLE `services_groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `service_requests`
--
ALTER TABLE `service_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT для таблицы `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `tags`
--
ALTER TABLE `tags`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT для таблицы `user_area`
--
ALTER TABLE `user_area`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT для таблицы `user_area_history`
--
ALTER TABLE `user_area_history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `user_balance`
--
ALTER TABLE `user_balance`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_notification`
--
ALTER TABLE `user_notification`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT для таблицы `user_profile`
--
ALTER TABLE `user_profile`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `user_service`
--
ALTER TABLE `user_service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT для таблицы `user_setting`
--
ALTER TABLE `user_setting`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT для таблицы `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `tags_content`
--
ALTER TABLE `tags_content`
  ADD CONSTRAINT `tags_content_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `user_role`
--
ALTER TABLE `user_role`
  ADD CONSTRAINT `user_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_role_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
