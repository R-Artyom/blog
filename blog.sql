-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Дек 26 2022 г., 13:00
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
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания статьи',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время обновления данных комментария'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `text`, `active`, `created_at`, `updated_at`) VALUES
(6, 1, 1, 'Но диаграммы связей будут в равной степени предоставлены сами себе. Приятно, граждане, наблюдать, как тщательные исследования конкурентов описаны максимально подробно.', 1, '2022-11-11 07:53:55', '2022-12-14 17:45:30'),
(8, 1, 2, 'Имеется спорная точка зрения, гласящая примерно следующее: независимые государства освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, ассоциативно распределены по отраслям. Противоположная точка зрения подразумевает, что тщательные исследования конкурентов освещают чрезвычайно интересные особенности картины в целом, однако конкретные выводы, разумеется, подвергнуты целой серии независимых исследований.', 1, '2022-11-11 07:56:50', '2022-12-14 17:45:30'),
(9, 2, 3, 'Первый', 0, '2022-11-14 12:48:04', '2022-12-14 17:45:30');

-- --------------------------------------------------------

--
-- Структура таблицы `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор статичной страницы',
  `title` varchar(30) NOT NULL COMMENT 'Заголовок страницы',
  `text` text NOT NULL COMMENT 'Текст страницы',
  `img_name` varchar(255) NOT NULL DEFAULT 'default.jpg' COMMENT 'Название файла с изображением к странице',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата создания страницы',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата обновления страницы'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `pages`
--

INSERT INTO `pages` (`id`, `title`, `text`, `img_name`, `created_at`, `updated_at`) VALUES
(1, 'Об авторе', 'Наше дело не так однозначно, как может показаться: синтетическое тестирование в значительной степени обусловливает важность системы массового участия. Принимая во внимание показатели успешности, высокотехнологичная концепция общественного уклада однозначно фиксирует необходимость экспериментов, поражающих по своей масштабности и грандиозности. В своём стремлении улучшить пользовательский опыт мы упускаем, что представители современных социальных резервов будут разоблачены!', '1672047593_1.jpg', '2022-12-21 07:48:21', '2022-12-26 09:39:53');

-- --------------------------------------------------------

--
-- Структура таблицы `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор статьи',
  `title` varchar(255) NOT NULL COMMENT 'Заголовок статьи',
  `short_text` text NOT NULL COMMENT 'Краткое описание статьи',
  `text` text NOT NULL COMMENT 'Текст статьи',
  `img_name` varchar(255) NOT NULL DEFAULT 'default.jpg' COMMENT 'Название файла с изображением к статье',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания статьи',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время обновления данных статьи'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `posts`
--

INSERT INTO `posts` (`id`, `title`, `short_text`, `text`, `img_name`, `created_at`, `updated_at`) VALUES
(1, 'Улучшить пользовательский опыт', 'В своём стремлении улучшить пользовательский опыт мы упускаем, что диаграммы связей являются только методом политического участия и объявлены нарушающими общечеловеческие нормы этики и морали...', 'В своём стремлении улучшить пользовательский опыт мы упускаем, что диаграммы связей являются только методом политического участия и объявлены нарушающими общечеловеческие нормы этики и морали. И нет сомнений, что акционеры крупнейших компаний лишь добавляют фракционных разногласий и своевременно верифицированы. В своём стремлении повысить качество жизни, они забывают, что перспективное планирование обеспечивает актуальность приоретизации разума над эмоциями.', '1672047471_1.jpg', '2022-11-09 11:58:43', '2022-12-26 12:37:51'),
(2, 'Уровень вовлечения', 'Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: курс на социально-ориентированный национальный проект позволяет выполнить важные задания по разработке...', 'Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: курс на социально-ориентированный национальный проект позволяет выполнить важные задания по разработке системы обучения кадров, соответствующей насущным потребностям. Принимая во внимание показатели успешности, высокотехнологичная концепция общественного уклада напрямую зависит от благоприятных перспектив. В целом, конечно, перспективное планирование обеспечивает широкому кругу (специалистов) участие в формировании направлений прогрессивного развития.', '1672047522_2.jpg', '2022-11-09 11:59:22', '2022-12-26 12:38:42'),
(5, 'Богатый опыт', 'Разнообразный и богатый опыт говорит нам, что граница обучения кадров создаёт необходимость включения в производственный план целого ряда внеочередных мероприятий с учётом комплекса...', 'Разнообразный и богатый опыт говорит нам, что граница обучения кадров создаёт необходимость включения в производственный план целого ряда внеочередных мероприятий с учётом комплекса соответствующих условий активизации. Равным образом, разбавленное изрядной долей эмпатии, рациональное мышление играет важную роль в формировании приоретизации разума над эмоциями. В частности, современная методология разработки требует анализа прогресса профессионального сообщества.', '1672047544_5.jpg', '2022-11-09 12:00:35', '2022-12-26 12:39:04');

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
-- Структура таблицы `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор настройки',
  `name` varchar(255) NOT NULL COMMENT 'Название настройки',
  `value` varchar(255) NOT NULL COMMENT 'Значение настройки',
  `description` varchar(255) NOT NULL COMMENT 'Описание настройки',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время создания настройки',
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата и время обновления настройки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'home_elements_per_page', '5', 'Количество статей на главной странице', '2022-12-25 15:28:05', '2022-12-26 09:22:06');

-- --------------------------------------------------------

--
-- Структура таблицы `subscribers`
--

CREATE TABLE `subscribers` (
  `id` int(11) NOT NULL COMMENT 'Уникальный идентификатор подписчика',
  `email` varchar(255) NOT NULL COMMENT 'Электронная почта подписчика',
  `token` varchar(255) NOT NULL COMMENT 'Уникальная последовательность символов для формирования защищенной от подбора ссылки для отписки'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Дамп данных таблицы `subscribers`
--

INSERT INTO `subscribers` (`id`, `email`, `token`) VALUES
(1, 'admin@gmail.com', '52bb37c85d4a96ec7d75344755765218'),
(2, 'manager@gmail.com', '3bac279629ec3df801b454b07cfc7215'),
(3, 'user@gmail.com', 'df1d49a7489c92bf5caa025f3e1c12ec'),
(9, 'tem@gmail.com', '03d70d9275f5402758bda28debfe8d39');

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
(1, 8, 'Иванов Иван Иванович', 'admin@gmail.com', '$2y$10$ABMDc.6IcRZyfdPnJqCCGuYlVIXarYxHM.eFXHE8p423KUtDcC3ly', '1672047185_1.jpg', 'Я - робот', '2022-09-09 10:18:40', '2022-12-26 12:33:05'),
(2, 4, 'Петров Пётр Петрович', 'manager@gmail.com', '$2y$10$bWMB8bpsgCUG639YPC3sU.hNotseZsbZGvuoNqMqT7810oIE5sVC.', '1672047243_2.jpg', '', '2022-09-09 10:18:43', '2022-12-26 12:34:03'),
(3, 2, 'Сидоров Сидор Сидорович', 'user@gmail.com', '$2y$10$4z0/4WP81JrnRg8I6JKyOebn.7SOC2bbo3N4QxnXpl/2ReraPozVC', '1672047391_3.jpg', 'Картельные сговоры не допускают ситуации', '2022-09-09 10:18:45', '2022-12-26 12:36:31');

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
-- Индексы таблицы `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

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
-- Индексы таблицы `settings`
--
ALTER TABLE `settings`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор комментария', AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT для таблицы `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор статичной страницы', AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT для таблицы `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор статьи', AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT для таблицы `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор группы', AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор настройки', AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `subscribers`
--
ALTER TABLE `subscribers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор подписчика', AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Уникальный идентификатор пользователя', AUTO_INCREMENT=55;

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
