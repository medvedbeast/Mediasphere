-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: localhost:3306
-- Время создания: Июн 14 2018 г., 10:40
-- Версия сервера: 5.6.39
-- Версия PHP: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `applingi_mediasphere`
--

-- --------------------------------------------------------

--
-- Структура таблицы `AGENTS`
--

CREATE TABLE `AGENTS` (
  `id` int(11) NOT NULL,
  `name` varchar(512) NOT NULL,
  `workplace` varchar(512) NOT NULL,
  `position` varchar(512) NOT NULL,
  `phone` varchar(512) NOT NULL,
  `email` varchar(512) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `AGENTS`
--

INSERT INTO `AGENTS` (`id`, `name`, `workplace`, `position`, `phone`, `email`, `contact_id`) VALUES
(5, 'Yoba Face', '2ch.ru', 'Мєм', '+ 8 800 555 35 35', 'yoba@eto.ti', 69),
(8, 'Представник 1', 'НУК ім. адмірала Макарова', 'Помічник директора', '+380932699009', 'agent_1@nuos.edu.ua', 90),
(9, 'Представник 2', 'НУК ім. адмірала Макарова', 'Помічник директора', '+380932699009', 'agent_2@nuos.edu.ua', 90);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTACTS`
--

CREATE TABLE `CONTACTS` (
  `id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `workplace` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `position` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `group_id` int(11) NOT NULL,
  `points` int(11) NOT NULL DEFAULT '100',
  `photo` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `vk` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `facebook` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `twitter` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `verified` int(11) NOT NULL,
  `author_id` int(11) NOT NULL,
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `CONTACTS`
--

INSERT INTO `CONTACTS` (`id`, `name`, `workplace`, `position`, `location`, `group_id`, `points`, `photo`, `phone`, `email`, `password`, `vk`, `facebook`, `twitter`, `website`, `verified`, `author_id`, `registered`, `views`) VALUES
(14, 'Ростислав Олександрович Савельєв', 'НУК ім. адмірала Макарова', 'Директор', 'Миколаїв, Україна', 1, 999983, 'contact_14.png', '+380932699007', 'medvedbeast@live.com', 'QAZwsxedc123', 'vk.com/medvedbeast', 'facebook.com/medvedbeast', 'twitter.com/medvedbeast', 'mediasphere.com.ua', 1, 0, '2017-12-30 20:00:00', 203),
(26, 'Олександр Сергійович Турчановський', 'НУК ім. адмірала Макарова', 'Заступник директора', 'Миколаїв, Україна', 1, 70, 'contact_26.png', '+88005553535', 'turcha@gmail.com', 'qazwsx123', 'vk.com/turcha', 'facebook.com/turcha', 'twitter.com/turcha', 'double.trouble.inc.com/turcha', 1, 0, '2017-12-09 18:46:24', 122),
(69, 'Нетворк Мастер', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 26, '2017-12-10 16:45:34', 177),
(71, 'Єхідний Колобок (3)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 26, '2017-12-10 16:45:34', 23),
(72, 'Єхідний Колобок (4)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:34', 8),
(73, 'Єхідний Колобок (5)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 2),
(74, 'Єхідний Колобок (6)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(75, 'Єхідний Колобок (7)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 4),
(76, 'Єхідний Колобок (8)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 1),
(77, 'Єхідний Колобок (9)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(78, 'Єхідний Колобок (10)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(79, 'Єхідний Колобок (11)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(80, 'Єхідний Колобок (12)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(81, 'Єхідний Колобок (13)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(82, 'Єхідний Колобок (14)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:35', 0),
(83, 'Єхідний Колобок (15)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 0),
(84, 'Єхідний Колобок (16)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 0),
(85, 'Єхідний Колобок (17)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 0),
(86, 'Єхідний Колобок (18)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 0),
(87, 'Єхідний Колобок (19)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 0),
(88, 'Єхідний Колобок (20)', '2ch.ru', 'Мєм', '2ch, 4ch', 3, 100, 'contact_16.png', '+ 8 800 555 35 35', 'kolobok@2ch.ru', '', 'vk.com/kolobok', 'facebook.com/kolobok', 'twitter.com/kolobok', 'website.com/kolobok', 1, 14, '2017-12-10 16:45:36', 12),
(90, 'Контакт Контактович', 'НУК ім. адмірала Макарова', 'Директор', 'Миколаїв, Україна', 5, 100, 'contact_90.png', '+380932699008', 'boss@nuos.edu.ua', '', 'vk.com/boss.nuos', 'facebook.com/boss.nuos', 'twitter.com/boss.nuos', 'nuos.edu.ua/pages/boss', 0, 14, '2017-12-17 16:01:24', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `CONTACTS_SCOPE`
--

CREATE TABLE `CONTACTS_SCOPE` (
  `id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `sphere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `CONTACTS_SCOPE`
--

INSERT INTO `CONTACTS_SCOPE` (`id`, `contact_id`, `sphere_id`) VALUES
(56, 26, 26),
(57, 26, 34),
(58, 14, 8),
(59, 14, 20),
(151, 69, 46),
(152, 69, 30),
(153, 70, 24),
(154, 70, 39),
(155, 71, 40),
(156, 72, 4),
(157, 73, 36),
(158, 74, 19),
(159, 75, 32),
(160, 75, 33),
(161, 76, 24),
(162, 76, 43),
(163, 76, 16),
(164, 77, 36),
(165, 78, 12),
(166, 79, 20),
(167, 80, 40),
(168, 80, 61),
(169, 81, 8),
(170, 82, 48),
(171, 82, 37),
(172, 83, 23),
(173, 84, 41),
(174, 84, 26),
(175, 85, 62),
(176, 85, 62),
(177, 85, 46),
(178, 86, 33),
(179, 87, 49),
(180, 88, 37),
(181, 88, 27),
(182, 90, 5),
(183, 90, 46),
(184, 90, 57);

-- --------------------------------------------------------

--
-- Структура таблицы `GROUPS`
--

CREATE TABLE `GROUPS` (
  `id` int(11) NOT NULL,
  `name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `access` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `GROUPS`
--

INSERT INTO `GROUPS` (`id`, `name`, `access`) VALUES
(1, 'Адміністратор', 0),
(2, 'Користувач', 1),
(3, 'Публічна особа', 2),
(4, 'Стрінгер', 2),
(5, 'Експерт', 2);

-- --------------------------------------------------------

--
-- Структура таблицы `MATERIALS`
--

CREATE TABLE `MATERIALS` (
  `id` int(11) NOT NULL,
  `title` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `short_description` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(1024) COLLATE utf8_unicode_ci NOT NULL,
  `deadline` varchar(512) COLLATE utf8_unicode_ci NOT NULL,
  `author_id` int(11) NOT NULL,
  `verified` int(11) NOT NULL DEFAULT '0',
  `registered` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `MATERIALS`
--

INSERT INTO `MATERIALS` (`id`, `title`, `short_description`, `description`, `location`, `deadline`, `author_id`, `verified`, `registered`, `views`) VALUES
(16, 'Інтригуючий заголовок', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.\n\n', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\n\n', 'Миколаїв, Україна', '10.12.2017', 14, 1, '2017-12-10 13:12:53', 112),
(17, 'Інтригуючий заголовок (1)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 54),
(18, 'Інтригуючий заголовок (2)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(19, 'Інтригуючий заголовок (3)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 27),
(20, 'Інтригуючий заголовок (4)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(21, 'Інтригуючий заголовок (5)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(22, 'Інтригуючий заголовок (6)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(23, 'Інтригуючий заголовок (7)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(24, 'Інтригуючий заголовок (8)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(25, 'Інтригуючий заголовок (9)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:57', 0),
(26, 'Інтригуючий заголовок (10)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(27, 'Інтригуючий заголовок (11)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(28, 'Інтригуючий заголовок (12)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(29, 'Інтригуючий заголовок (13)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(30, 'Інтригуючий заголовок (14)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(31, 'Інтригуючий заголовок (15)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(32, 'Інтригуючий заголовок (16)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(33, 'Інтригуючий заголовок (17)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(34, 'Інтригуючий заголовок (18)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(35, 'Інтригуючий заголовок (19)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0),
(36, 'Інтригуючий заголовок (20)', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '12.12.2017', 14, 1, '2017-12-10 16:54:58', 0);
INSERT INTO `MATERIALS` (`id`, `title`, `short_description`, `description`, `location`, `deadline`, `author_id`, `verified`, `registered`, `views`) VALUES
(37, 'Крутий матеріал', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 'Sed ut perspiciatis, unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam eaque ipsa, quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt, explicabo. Nemo enim ipsam voluptatem, quia voluptas sit, aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos, qui ratione voluptatem sequi nesciunt, neque porro quisquam est, qui dolorem ipsum, quia dolor sit, amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt, ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit, qui in ea voluptate velit esse, quam nihil molestiae consequatur, vel illum, qui dolorem eum fugiat, quo voluptas nulla pariatur? At vero eos et accusamus et iusto odio dignissimos ducimus, qui blanditiis praesentium voluptatum deleniti atque corrupti, quos dolores et quas molestias excepturi sint, obcaecati cupiditate non provident, similique sunt in culpa, qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio, cumque nihil impedit, quo minus id, quod maxime placeat, facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet, ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.', 'Миколаїв, Україна', '25.12.2017', 14, 0, '2017-12-17 16:07:26', 1);

-- --------------------------------------------------------

--
-- Структура таблицы `MATERIALS_SCOPE`
--

CREATE TABLE `MATERIALS_SCOPE` (
  `id` int(11) NOT NULL,
  `material_id` int(11) NOT NULL,
  `sphere_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `MATERIALS_SCOPE`
--

INSERT INTO `MATERIALS_SCOPE` (`id`, `material_id`, `sphere_id`) VALUES
(6, 16, 20),
(7, 16, 21),
(8, 16, 45),
(9, 17, 55),
(10, 17, 15),
(11, 18, 28),
(12, 19, 34),
(13, 19, 23),
(14, 19, 14),
(15, 20, 62),
(16, 20, 52),
(17, 21, 4),
(18, 22, 21),
(19, 22, 52),
(20, 22, 28),
(21, 23, 42),
(22, 23, 59),
(23, 23, 62),
(24, 24, 40),
(25, 25, 14),
(26, 26, 21),
(27, 27, 1),
(28, 28, 33),
(29, 29, 36),
(30, 29, 46),
(31, 29, 19),
(32, 30, 16),
(33, 31, 33),
(34, 31, 43),
(35, 32, 21),
(36, 32, 60),
(37, 33, 18),
(38, 33, 16),
(39, 34, 46),
(40, 34, 5),
(41, 35, 40),
(42, 36, 11),
(43, 37, 1),
(44, 37, 2),
(45, 37, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `NOTIFICATIONS`
--

CREATE TABLE `NOTIFICATIONS` (
  `id` int(11) NOT NULL,
  `content` varchar(1024) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `type_id` int(11) NOT NULL,
  `occurred` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `NOTIFICATIONS`
--

INSERT INTO `NOTIFICATIONS` (`id`, `content`, `contact_id`, `type_id`, `occurred`) VALUES
(16, 'Ви відкрили контакт <b>\'Єхідний Колобок (7)\'</b>.<br/>З вас списано <b>10</b> балів.', 26, 2, '2017-12-14 10:57:09');

-- --------------------------------------------------------

--
-- Структура таблицы `NOTIFICATION_TYPES`
--

CREATE TABLE `NOTIFICATION_TYPES` (
  `id` int(11) NOT NULL,
  `name` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `NOTIFICATION_TYPES`
--

INSERT INTO `NOTIFICATION_TYPES` (`id`, `name`) VALUES
(1, 'Зарахування'),
(2, 'Списання'),
(3, 'Інформація');

-- --------------------------------------------------------

--
-- Структура таблицы `PURCHASES`
--

CREATE TABLE `PURCHASES` (
  `id` int(11) NOT NULL,
  `buyer_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `PURCHASES`
--

INSERT INTO `PURCHASES` (`id`, `buyer_id`, `contact_id`) VALUES
(3, 26, 72),
(4, 26, 88),
(5, 26, 75);

-- --------------------------------------------------------

--
-- Структура таблицы `REPORTS`
--

CREATE TABLE `REPORTS` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `contact_id` int(11) NOT NULL,
  `content` varchar(2048) NOT NULL,
  `sent` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `REPORTS`
--

INSERT INTO `REPORTS` (`id`, `sender_id`, `contact_id`, `content`, `sent`) VALUES
(6, 14, 71, 'тест', '2017-12-17 16:15:38');

-- --------------------------------------------------------

--
-- Структура таблицы `SPHERES`
--

CREATE TABLE `SPHERES` (
  `id` int(11) NOT NULL,
  `name` varchar(512) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Дамп данных таблицы `SPHERES`
--

INSERT INTO `SPHERES` (`id`, `name`) VALUES
(1, 'Архітектура'),
(2, 'Благодійність'),
(3, 'Будівництво'),
(4, 'Вибори'),
(5, 'Вища освіта'),
(6, 'Волонтерство'),
(7, 'Гендер'),
(8, 'Дизайн'),
(9, 'Доступ до інформації'),
(10, 'Е-демократія'),
(11, 'Екологія'),
(12, 'Євроінтеграція'),
(13, 'ЖКГ'),
(14, 'Заповідні території'),
(15, 'Захист тварин'),
(16, 'ЗНО'),
(17, 'Зовнішня політика'),
(18, 'Інклюзина освіта'),
(19, 'Історія'),
(20, 'ІТ'),
(21, 'Кіно'),
(22, 'Кліматичні зміни'),
(23, 'Книговидання'),
(24, 'Конфліктологія'),
(25, 'Культорологія'),
(26, 'Культура та мистецтво'),
(27, 'Культурна політика'),
(28, 'Літературознавство'),
(29, 'Медіа'),
(30, 'Медіакомунікації'),
(31, 'Медіаправо'),
(32, 'Менеджмент'),
(33, 'Міграційна політика'),
(34, 'Міжнародна діяльність'),
(35, 'Місцеве самоврядування'),
(36, 'Мовна політика'),
(37, 'Музейна справа'),
(38, 'Музикознавство'),
(39, 'Нацменшини'),
(40, 'Нерухомість'),
(41, 'Неформальна освіта'),
(42, 'Обмежені можливості'),
(43, 'Освіта та наука '),
(44, 'Охорона довкілля'),
(45, 'Переробка відходів'),
(46, 'Політика'),
(47, 'Політологія та економіка'),
(48, 'Права людини'),
(49, 'Психологія'),
(50, 'Реклама'),
(51, 'Релігія'),
(52, 'Реформа освіти'),
(53, 'Розробка'),
(54, 'Свобода слова'),
(55, 'Середня освіта '),
(56, 'Соціологія'),
(57, 'Стартапи'),
(58, 'Суспільство'),
(59, 'Суспільствознавство'),
(60, 'Театрознавство'),
(61, 'Транспортна система'),
(62, 'Туризм'),
(63, 'Урбаністика'),
(64, 'Цифрова безпека');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `AGENTS`
--
ALTER TABLE `AGENTS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `CONTACTS`
--
ALTER TABLE `CONTACTS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CONTACTS_fk0` (`group_id`);

--
-- Индексы таблицы `CONTACTS_SCOPE`
--
ALTER TABLE `CONTACTS_SCOPE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CONTACTS_SCOPE_fk0` (`contact_id`),
  ADD KEY `CONTACTS_SCOPE_fk1` (`sphere_id`);

--
-- Индексы таблицы `GROUPS`
--
ALTER TABLE `GROUPS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `MATERIALS`
--
ALTER TABLE `MATERIALS`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MATERIALS_fk0` (`author_id`);

--
-- Индексы таблицы `MATERIALS_SCOPE`
--
ALTER TABLE `MATERIALS_SCOPE`
  ADD PRIMARY KEY (`id`),
  ADD KEY `MATERIALS_SCOPE_fk0` (`material_id`),
  ADD KEY `MATERIALS_SCOPE_fk1` (`sphere_id`);

--
-- Индексы таблицы `NOTIFICATIONS`
--
ALTER TABLE `NOTIFICATIONS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `NOTIFICATION_TYPES`
--
ALTER TABLE `NOTIFICATION_TYPES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `PURCHASES`
--
ALTER TABLE `PURCHASES`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `REPORTS`
--
ALTER TABLE `REPORTS`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `SPHERES`
--
ALTER TABLE `SPHERES`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `AGENTS`
--
ALTER TABLE `AGENTS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT для таблицы `CONTACTS`
--
ALTER TABLE `CONTACTS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT для таблицы `CONTACTS_SCOPE`
--
ALTER TABLE `CONTACTS_SCOPE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT для таблицы `GROUPS`
--
ALTER TABLE `GROUPS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `MATERIALS`
--
ALTER TABLE `MATERIALS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT для таблицы `MATERIALS_SCOPE`
--
ALTER TABLE `MATERIALS_SCOPE`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `NOTIFICATIONS`
--
ALTER TABLE `NOTIFICATIONS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `NOTIFICATION_TYPES`
--
ALTER TABLE `NOTIFICATION_TYPES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `PURCHASES`
--
ALTER TABLE `PURCHASES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `REPORTS`
--
ALTER TABLE `REPORTS`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT для таблицы `SPHERES`
--
ALTER TABLE `SPHERES`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
