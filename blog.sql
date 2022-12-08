-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 08 2022 г., 10:58
-- Версия сервера: 5.7.38
-- Версия PHP: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `blog`
--

-- --------------------------------------------------------

--
-- Структура таблицы `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор комментария',
  `post_id` int(11) NOT NULL COMMENT 'Уникальный идентификатор статьи',
  `user_id` int(11) NOT NULL COMMENT 'Уникальный идентификатор пользователя',
  `text` text NOT NULL COMMENT 'Текст статьи',
  `active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Признак активности комментария (одобрено(1) / не одобрено (0))',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания статьи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`, `active`, `created_at`) VALUES
(6, 1, 1, 'Но диаграммы связей будут в равной степени предоставлены сами себе. Приятно, граждане, наблюдать, как тщательные исследования конкурентов описаны максимально подробно.', 1, '2022-11-11 07:53:55'),
(8, 1, 2, 'Имеется спорная точка зрения, гласящая примерно следующее: независимые государства освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, ассоциативно распределены по отраслям. Противоположная точка зрения подразумевает, что тщательные исследования конкурентов освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, подвергнуты целой серии независимых исследований.', 1, '2022-11-11 07:56:50'),
(9, 2, 1, 'Первый', 0, '2022-11-14 12:48:04'),
(10, 2, 1, 'Второй', 0, '2022-11-14 12:50:31'),
(11, 2, 1, 'Третий', 0, '2022-11-15 06:23:21'),
(12, 2, 1, 'Пятый', 0, '2022-11-15 06:52:57'),
(13, 2, 1, 'Седьмой', 1, '2022-11-15 06:59:03'),
(14, 2, 1, 'Восьмой', 0, '2022-11-15 07:10:37'),
(15, 2, 1, 'Девятый', 1, '2022-11-15 07:52:42'),
(16, 2, 1, 'Десять', 0, '2022-11-15 09:17:11'),
(17, 2, 1, '11)', 0, '2022-11-15 12:26:30'),
(18, 2, 1, '12', 0, '2022-11-15 12:37:10'),
(19, 2, 1, 'Опять первый', 1, '2022-11-15 13:21:21'),
(20, 2, 1, 'Ха-ха-ха', 0, '2022-11-15 14:21:39'),
(21, 2, 1, 'Ахахах', 0, '2022-11-15 14:23:01'),
(23, 5, 1, 'Первый', 0, '2022-11-15 16:13:29'),
(24, 2, 1, 'Второй', 0, '2022-11-15 16:13:55'),
(25, 1, 1, '\r\nПетров Пётр Петрович\r\nИмеется спорная точка зрения, гласящая примерно следующее: независимые государства освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, ассоциативно распределены по отраслям. Противоположная точка зрения подразумевает, что тщательные исследования конкурентов освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, подвергнуты целой серии независимых исследований.\r\n11.11.2022-07:56:50 ', 0, '2022-11-16 07:37:30'),
(26, 1, 1, '\r\nПетров Пётр Петрович\r\nИмеется спорная точка зрения, гласящая примерно следующее: независимые государства освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, ассоциативно распределены по отраслям. Противоположная точка зрения подразумевает, что тщательные исследования конкурентов освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, подвергнуты целой серии независимых исследований.\r\n11.11.2022-07:56:50 ', 0, '2022-11-16 07:38:24'),
(27, 2, 1, 'Ноябрь,16', 0, '2022-11-16 08:08:35'),
(28, 2, 1, 'Опять ноябрь, 16', 0, '2022-11-16 08:10:18'),
(29, 2, 1, '13^25!!!', 0, '2022-11-16 09:25:15'),
(30, 2, 1, 'Внимание!!! Комментарий не может быть пустым ', 0, '2022-11-16 09:27:16'),
(31, 2, 1, '\r\nКомментарий успешно отправлен ', 0, '2022-11-16 09:28:01'),
(32, 2, 1, 'Ха!', 0, '2022-11-17 08:39:03'),
(33, 1, 1, 'Ага', 0, '2022-11-21 09:22:49'),
(34, 5, 2, 'Привет!', 0, '2022-11-28 17:23:13'),
(35, 2, 2, 'Еще раз', 0, '2022-11-28 17:26:03'),
(36, 5, 1, 'Привет!', 0, '2022-11-28 17:28:06'),
(37, 2, 2, 'Проверен?', 0, '2022-11-29 08:47:06'),
(38, 2, 1, 'Проверен?', 0, '2022-11-29 08:48:45'),
(39, 2, 1, 'Проверен?', 1, '2022-11-29 08:50:50'),
(40, 2, 1, 'Точно', 0, '2022-11-29 08:57:12'),
(41, 2, 1, 'Теперь точно точно', 1, '2022-11-29 08:57:41'),
(42, 2, 2, 'А теперь я', 1, '2022-11-29 08:59:21'),
(43, 2, 3, 'И я', 0, '2022-11-29 09:00:18'),
(44, 1, 3, 'Требуется проверка?', 0, '2022-11-29 09:02:58'),
(45, 2, 2, 'Требуется проверка?', 1, '2022-11-29 09:03:56'),
(46, 2, 2, 'Манагер', 1, '2022-11-29 19:37:40');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор статьи',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок статьи',
  `short_text` text NOT NULL COMMENT 'Краткое описание статьи',
  `text` text NOT NULL COMMENT 'Текст статьи',
  `img_name` varchar(255) NOT NULL COMMENT 'Название файла с изображением к статье',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания статьи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `short_text`, `text`, `img_name`, `created_at`) VALUES
(1, 'Улучшить пользовательский опыт', 'В своём стремлении улучшить пользовательский опыт мы упускаем, что диаграммы связей являются только методом политического участия и объявлены нарушающими общечеловеческие нормы этики и морали...', 'В своём стремлении улучшить пользовательский опыт мы упускаем, что диаграммы связей являются только методом политического участия и объявлены нарушающими общечеловеческие нормы этики и морали. И нет сомнений, что акционеры крупнейших компаний лишь добавляют фракционных разногласий и своевременно верифицированы. В своём стремлении повысить качество жизни, они забывают, что перспективное планирование обеспечивает актуальность приоретизации разума над эмоциями.', '1.jpg', '2022-11-09 11:58:43'),
(2, 'Уровень вовлечения', 'Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: курс на социально-ориентированный национальный проект позволяет выполнить важные задания по разработке...', 'Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: курс на социально-ориентированный национальный проект позволяет выполнить важные задания по разработке системы обучения кадров, соответствующей насущным потребностям. Принимая во внимание показатели успешности, высокотехнологичная концепция общественного уклада напрямую зависит от благоприятных перспектив. В целом, конечно, перспективное планирование обеспечивает широкому кругу (специалистов) участие в формировании направлений прогрессивного развития.', '2.jpg', '2022-11-09 11:59:22'),
(5, 'Богатый опыт', 'Разнообразный и богатый опыт говорит нам, что граница обучения кадров создаёт необходимость включения в производственный план целого ряда внеочередных мероприятий с учётом комплекса...', 'Разнообразный и богатый опыт говорит нам, что граница обучения кадров создаёт необходимость включения в производственный план целого ряда внеочередных мероприятий с учётом комплекса соответствующих условий активизации. Равным образом, разбавленное изрядной долей эмпатии, рациональное мышление играет важную роль в формировании приоретизации разума над эмоциями. В частности, современная методология разработки требует анализа прогресса профессионального сообщества.', '5.jpg', '2022-11-09 12:00:35');

-- --------------------------------------------------------

--
-- Структура таблицы `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор группы',
  `name` varchar(255) NOT NULL COMMENT 'Название группы',
  `description` varchar(255) NOT NULL COMMENT 'Описание группы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `roles`
--

INSERT INTO `roles` (`id`, `name`, `description`) VALUES
(2, 'user', 'Зарегистрированный пользователь – может оставлять комментарии'),
(4, 'manager', 'Контент менеджер – может изменять/создавать статьи и модерирует комментарии к ним'),
(8, 'admin', 'Администратор – полный доступ к админке');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор подписчика',
  `email` varchar(255) NOT NULL COMMENT 'Электронная почта подписчика'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`) VALUES
(9, 'admin@gmail.com'),
(15, 'manager@gmail.com'),
(11, 'sdf@ngs.ru'),
(10, 'tem@gmail.com'),
(12, 'user@gmail.com');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор пользователя',
  `role_id` int(11) NOT NULL DEFAULT '2' COMMENT 'Роль пользователя на сайте',
  `name` varchar(255) NOT NULL COMMENT 'Имя пользователя',
  `email` varchar(255) NOT NULL COMMENT 'Электронная почта (логин)',
  `password` varchar(255) NOT NULL COMMENT 'Пароль (в зашифрованном виде)',
  `img_name` varchar(255) NOT NULL COMMENT 'Аватар (название файла)',
  `about_me` varchar(255) NOT NULL DEFAULT '' COMMENT 'Краткая информация о себе',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время регистрации пользователя',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время обновления данных пользователя'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `role_id`, `name`, `email`, `password`, `img_name`, `about_me`, `created_at`, `updated_at`) VALUES
(1, 8, 'Иванов Иван Иванович', 'admin@gmail.com', '$2y$10$ABMDc.6IcRZyfdPnJqCCGuYlVIXarYxHM.eFXHE8p423KUtDcC3ly', '1.jpg', 'Я - робот', '2022-09-09 10:18:40', '2022-12-08 07:34:38'),
(2, 4, 'Петров Пётр Петрович', 'manager@gmail.com', '$2y$10$bWMB8bpsgCUG639YPC3sU.hNotseZsbZGvuoNqMqT7810oIE5sVC.', '2.jpg', '', '2022-09-09 10:18:43', '2022-12-05 10:00:52'),
(3, 2, 'Сидоров Сидор Сидорович', 'user@gmail.com', '$2y$10$XtIeUhwA6nLBtaCTzJLKX.YZDl4XZSJ2I7C7XEaF8G4AZ2skpKc.a', '3.jpg', 'Картельные сговоры не допускают ситуации, при которой некоторые особенности внутренней политики являются только методом политического участия и призваны к ответу.', '2022-09-09 10:18:45', '2022-12-05 10:00:52'),
(4, 2, 'Васильев Василий Васильевич', 'vasiliev@gmail.com', '$2y$10$bZbHhWIfGNUA9UHNe0HNc.6XK9J3e2Y56v0FOU1IkQo.oy9yc29Zy', '4.jpg', 'Краткость', '2022-09-09 10:18:47', '2022-12-06 13:14:19'),
(5, 2, 'Андреев Андрей Андреевич', 'andreev@gmail.com', '$2y$10$7vWGrFJf35Hj/o/5FL.90uLvhctur1cuXyWsbRJCTLFB.qBnGho7W', '', '', '2022-09-09 10:18:49', '2022-12-05 10:00:52'),
(6, 2, 'Александров Александр Александрович', 'aleksandrov@gmail.com', '$2y$10$u1Paw83vBxpxwkrboOo80upkk3RV8vTm.mfGtZle8VscKvZUVs/d.', '', '', '2022-09-09 10:18:50', '2022-12-05 10:00:52'),
(7, 2, 'Любаев Любим Любимович', 'lyubaev@gmail.com', '$2y$10$LPU0n1/UawbLhZxVkj.AZePDkTu8lK69JuXIKqddSDcbMP./vZBda', '', '', '2022-09-09 10:18:51', '2022-12-05 10:00:52'),
(23, 2, 'Ива', 'sidorov@gmail.com', '$2y$10$junTauKtEnk77uSAQh.OGuPuvORvBV5zE4ONeRMY4TRky1oIv6Mj2', 'default.jpg', '', '2022-09-09 10:18:55', '2022-12-05 10:00:52'),
(24, 2, 'Tem', 'ivano@gmail.com', '$2y$10$NQhPG1yZhfwspqtFbdGPgupw2vOEX1CSpHg2Ri3RG5N87o6.UAzBi', 'default.jpg', '', '2022-11-21 10:26:34', '2022-12-05 10:00:52'),
(25, 2, 'Ар', 'ivan@gmail.com', '$2y$10$iV8jZotdLaqj011JbNPIru0Zv5ECd1iRJhI5gh2ikktIafTZNAkQC', 'default.jpg', '', '2022-11-21 12:51:39', '2022-12-05 10:00:52'),
(26, 2, 'Arte', 'asd@gmail.com', '$2y$10$zngfa6hEIIO6snUKzPbL6OzSdK9ohlEcLee8xqV6JxsVzjLdwBsZO', 'default.jpg', '', '2022-11-23 11:20:00', '2022-12-05 10:00:52'),
(27, 2, 'Arte', 'asd2@gmail.com', '$2y$10$/ddIm1Q8NaCT.qAXm5scEeVO8d5uFAYZYfvpyUw5UanQ/nAlBvRbm', 'default.jpg', '', '2022-11-23 11:21:51', '2022-12-05 10:00:52'),
(28, 2, 'Arte', 'asd3@gmail.com', '$2y$10$3pFA3RX35h6slX/npfXwn.XK9u8X/sD522G54NxZ0efmMXJVJtEeO', 'default.jpg', '', '2022-11-23 11:22:25', '2022-12-05 10:00:52'),
(29, 2, 'D', 'Emai@m.ru', '$2y$10$Q7uJA5FBlWQdtz9L1oe0R.6cjWF.pxO2vQUBuRWoaWkJs.3rngzma', 'default.jpg', '', '2022-11-23 11:30:57', '2022-12-05 10:00:52'),
(40, 2, 'ert', 'ivanove@gmail.com', '$2y$10$Te6Nm4Ib8ZmAO5IRBJb7lOFDlTYBqx1CLp1warurzRNGOsSJekeZK', 'default.jpg', '', '2022-11-23 17:34:50', '2022-12-05 10:00:52'),
(41, 2, 'Кolyan', 'ko@gmail.com', '$2y$10$oaFTGoqjk8yDC91nBSCyO.f.0rLHsMZ0nbVlpXvF0AgeK3rrOUEka', 'default.jpg', '', '2022-11-24 07:28:16', '2022-12-05 10:00:52'),
(42, 2, 'Ivva', 'iva@gmail.com', '$2y$10$cXRJanzFlDgD6FS1VL0doetKaYw5ZdjzNO6L7uZdolkkAUhCCiUQK', 'default.jpg', '', '2022-11-24 19:09:03', '2022-12-05 10:00:52'),
(43, 2, 'варвар', 'ivanovk@gmail.com', '$2y$10$GNrsPMXumZkyhVTSBbpndOwLglPh.eYkNT34/11w.h7Egiul1p9HW', 'default.jpg', '', '2022-11-27 14:46:05', '2022-12-05 10:00:52'),
(49, 2, 'Ян', 'yan@mail.com', '$2y$10$2JKhpSkZ.IhwhInevQoqZOajXrqmD94OvUF8oZ/.f6wTCsTITu/d.', 'default.jpg', '', '2022-12-01 09:23:24', '2022-12-05 10:00:52'),
(51, 2, 'min', 'min@gmail.com', '$2y$10$suiB8/uWkHKIzoy5lIPmf.ssrrTrGkbJY2NalhqCY9neyRB44ImqK', 'default.jpg', '', '2022-12-02 17:21:18', '2022-12-05 10:00:52'),
(52, 2, 'Петров Иван Иваныч', 'petr@petr.ru', '$2y$10$bG2c.c.BlBW37yDMmAub7efQx3Q0X3coNU3oDaUb7oX65s0dwoOX6', 'default.jpg', '', '2022-12-04 16:02:02', '2022-12-05 10:00:52'),
(53, 2, 'Иванов Иван Иванович', 'gmail@gmail.com', '$2y$10$S3TnLkJ3otxSxsCnGzEE/.OomdJcqS07fYbk3m/1abuTCrkGLg9x6', 'default.jpg', '', '2022-12-05 08:00:04', '2022-12-05 10:00:52');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `post_id` (`post_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Индексы таблицы `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Индексы таблицы `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Индексы таблицы `subscribers`
--
ALTER TABLE `subscribers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `users_ibfk_1` (`role_id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор комментария', AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор статьи', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор группы', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор подписчика', AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор пользователя', AUTO_INCREMENT=54;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
