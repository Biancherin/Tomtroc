-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 21 nov. 2025 à 10:15
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `tomtroc`
--

-- --------------------------------------------------------

--
-- Structure de la table `library`
--

CREATE TABLE `library` (
  `book_id` int(11) NOT NULL,
  `user_t_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` text NOT NULL,
  `is_enabled` tinyint(1) NOT NULL,
  `date_creation` datetime DEFAULT NULL,
  `date_update` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `library`
--

INSERT INTO `library` (`book_id`, `user_t_id`, `title`, `author`, `image`, `content`, `is_enabled`, `date_creation`, `date_update`) VALUES
(1, 2, 'Esther', 'Alabaster', 'img/Esther.png', 'Curieux et passionnant, le génie d\'Esther réside dans son mélange mystérieux et unique de hasard et de providence divine. Si son intrigue paraît aléatoire et hasardeuse au premier abord, elle invite à la considérer comme une rencontre décisive avec Dieu. C\'est un encouragement pour chacun de nous à observer et à écouter, avec curiosité et attention, les actions implicites de Dieu dans les moments heureux. Ce n\'est peut-être pas explicite ou comme on pourrait s\'y attendre, mais Dieu est bel et bien présent.', 1, '2025-11-02 19:11:04', '2025-11-02 19:11:04'),
(2, 2, 'The Kinkfolk Table', 'Nathan Williams', 'img/thekinkfolktable.png', 'J\'ai récemment plongé dans les pages de \'The kinfolk Table\' et j\'ai été enchanté par cette oeuvre captivante. Ce livre va bien au delà d\'une simple collection de recettes ; il célèbre l\'art de partager des moments authentiques autour de la table. Les photographies magnifiques et le ton chaleureux captivent dès le départ, transportant le lecteur dans un voyage à travers des recettes et des histoires qui mettent en avant la beauté de la simplicité et de la convivialité.', 1, '2025-11-01 19:11:28', '2025-11-01 19:11:28'),
(3, 1, 'Wabi Sabi', 'Beth Kempton', 'img/wabisabi.png', 'Dans un monde gouverné par la quête perpétuelle de la perfection, l\'accélération du temps et la performance en tout, le wabi sabi se présente comme une faille salvatrice... et oui la la', 0, '2025-10-31 19:11:48', '2025-11-11 13:22:53'),
(4, 1, 'Milk & honey', 'Rupi Kaur', 'img/milkandhoney.png', 'Le premier livre de Rupi Kaur...', 0, '2025-10-30 19:17:55', '2025-10-30 19:17:55'),
(5, 2, 'Delight!', 'Justin Rossow', 'img/delight.png', 'This book will help you lean into Joyful Delight...', 0, '2025-10-21 19:02:21', '2025-10-21 19:02:21'),
(6, 4, 'Milwaukee Mission', 'Elder Cooper Low', 'img/milwaukee.png', '', 1, '2025-10-21 19:04:15', '2025-10-21 19:04:15'),
(7, 4, 'Minimalist Graphics', 'Julia Schonlau', 'img/minimalist.png', 'ok test test', 1, '2025-10-21 19:06:03', '2025-11-13 12:08:57'),
(8, 6, 'Hygge', 'Meik Wiking', 'img/hygge.png', '', 1, '2025-10-21 19:06:59', '2025-10-21 19:06:59'),
(9, 8, 'Innovation', 'Matt Ridley', 'img/innovation.png', '', 1, '2025-10-14 19:07:49', '2025-10-14 19:07:49'),
(10, 2, 'Psalms', 'Alabaster', 'img/psalms.png', '', 1, '2025-10-14 19:08:46', '2025-10-14 19:08:46'),
(11, 3, 'Thinking, Fast & Slow', 'Daniel Kahneman', 'img/tfs.png', 'test commentaires surper livre', 1, '2025-10-14 19:09:42', '2025-11-18 09:05:53'),
(14, 2, 'A Book Full Of Hope', 'Rupi Kaur', 'img/abook.png', '', 1, '2025-10-14 19:12:29', '2025-10-14 19:12:29'),
(15, 3, 'The Subtle Art Of...', 'Mark Manson', 'img/thesubtle.png', 'ce livre est important pour l\'art de ...', 1, '2025-10-07 19:13:17', '2025-11-21 09:56:42'),
(16, 4, 'Narnia', 'C.S Lewis', 'img/narnia.png', '', 1, '2025-10-07 19:14:10', '2025-10-07 19:14:10'),
(17, 5, 'Company Of One', 'Paul Jarvis', 'img/company.png', '', 1, '2025-10-07 19:14:59', '2025-10-07 19:14:59'),
(18, 2, 'The Two Towers', 'J.R.R Tolkien', 'img/thetwo.png', '', 1, '2025-10-07 19:15:45', '2025-10-07 19:15:45'),
(26, 3, 'test4', 'test', NULL, 'test', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

CREATE TABLE `message` (
  `message_id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `book_id` int(11) DEFAULT NULL,
  `content` text NOT NULL,
  `nickname` varchar(255) DEFAULT NULL,
  `date_message` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_read` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `message`
--

INSERT INTO `message` (`message_id`, `sender_id`, `receiver_id`, `book_id`, `content`, `nickname`, `date_message`, `is_read`) VALUES
(1, 1, 2, 1, 'test', 'Camille1', '2025-11-12 17:57:10', 1),
(2, 1, 2, 1, 'test', 'Camille1', '2025-11-12 17:57:23', 1),
(3, 2, 4, 7, 'test2', 'Alexlecture', '2025-11-13 11:08:04', 1),
(4, 4, 3, 15, 'testhugo', 'nathalire', '2025-11-13 11:09:16', 1),
(5, 1, 1, 4, 'testicone', 'Camille1', '2025-11-14 09:03:18', 1),
(6, 1, 2, 2, 'testicone', 'Camille1', '2025-11-14 09:10:03', 1),
(9, 3, 2, 2, 'helloalex', 'Hugo_1990_12', '2025-11-17 09:58:59', 1),
(10, 1, 3, 15, 'hellohugo', 'Camille1', '2025-11-17 10:08:08', 1);

-- --------------------------------------------------------

--
-- Structure de la table `user_t`
--

CREATE TABLE `user_t` (
  `user_t_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `nickname` varchar(100) NOT NULL,
  `image` varchar(255) DEFAULT 'img/default-user.png',
  `date_creation` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `user_t`
--

INSERT INTO `user_t` (`user_t_id`, `email`, `password`, `nickname`, `image`, `date_creation`) VALUES
(1, 'camille10@gmail.com', '$2y$10$slOiZyjZ.mVJfAFB1na0G.r0BMofe6LuBHz7ex/TooTy4Xx7uvh/.', 'Camille1', 'img/camilleclub.png', '2025-11-06 13:09:08'),
(2, 'alex@gamil.com', '$2y$10$2g8nUeMBrVbpVWf82GaNnuL1YQV37Xan/9/P4GAt7nwGsbUh8xPr6', 'Alexlecture1', 'img/alexlecture.png', '2025-11-06 13:09:08'),
(3, 'hugo@gmail.com', '$2y$10$LQqp5MIZDZp8C2HnVa8oguz.o1dpH7wjJs0ObtmSzqmx2sxMhSyPq', 'Hugo_1990_12', 'img/Hugo.png', '2025-11-06 13:09:08'),
(4, 'nathalire@gmail.com', '$2y$10$vFqN6Z0hIzBrFlkKDQlS9egJbHhDtdLlFpFq2JygfjaLRP3L4Zysy', 'nathalire', 'img/nathalire.png', '2025-11-06 13:09:08'),
(5, 'julie@gmail.com', '$2y$10$GmJiSZR6XplZDb1HAnL58eo7ooxmGjqsR6l/CGOEIH1sJ.8.MrPsW', 'juju1432', 'img/default-user.png', '2025-11-06 13:09:09'),
(6, 'christiane@gmail.com', '$2y$10$AhQ7SQfOYk5ov69FkOxZLejx6t1aPYcs2Ohhodq6LTPts0nOzpY72', 'christiane75014', 'img/default-user.png', '2025-11-06 13:09:09'),
(7, 'hamza@gmail.com', '$2y$10$PKla.Lc9GaTPJUrca2pNzOZtfUitn1jFQ5YN6mljvtTxEbr//LnEq', 'Hamazalecture', 'img/default-user.png', '2025-11-06 13:09:09'),
(8, 'lou@gmail.com', '$2y$10$7gtwLW.qdHDD2PTy8AnLze3QUhl/5kTbwrkdhGedr.IW5X0Z1epnW', 'Lou&Ben50', 'img/default-user.png', '2025-11-06 13:09:09'),
(9, 'ivan@gmail.com', '$2y$10$51.E0/5dZICOxCE3FHvxc.LWxU4Th48bCvH.1RXYdV/mOKRQ4i2eC', 'ivan', 'img/default-user.png', '2025-11-06 13:09:09'),
(11, 'kevin@gmail.com', '$2y$10$O8mGkpRwqhWk.5V4Yjtseuvx1py4DyAMjmWs2T3MQoOgtABbV26jG', 'kevin', 'img/default-user.png', '2025-11-06 13:09:09'),
(12, 'laura@gmail.com', '$2y$10$w0gDoKdtkMnXcYJfZ8nomOrkiKyoH9HfihfA23wYpLV/vIKPL0TRm', 'laura', 'img/default-user.png', '2025-11-06 13:09:09'),
(13, 'marc@gmail.com', '$2y$10$eBsc.iMXGol2YHfjuDv1TemkHxshmv5zKCTvY1r5FW.ae012cWgR.', 'marc', 'img/default-user.png', '2025-11-06 13:09:09'),
(14, 'nadia@gmail.com', '$2y$10$1VHP2tQAmf51yTj/GedeI.9fZH7ES6ZIJsscJ/zpqGPgTX5NuJG1S', 'nadia', 'img/default-user.png', '2025-11-06 13:09:09'),
(15, 'olivier@gmail.com', '$2y$10$mqjq4E8pOh43iSGlWXKJF.eFbfctjvyjPUb66lPyynSeY0cJEx8iq', 'olivier', 'img/default-user.png', '2025-11-06 13:09:09'),
(16, 'test@gmail.com', '$2y$10$pfD8CktLqLLMx2.iB5g6jOlyuLhYST.vrx2ZimvevWykIvFFyYBJW', 'testpseudo', 'img/default-user.png', '2025-11-21 09:22:16');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `library`
--
ALTER TABLE `library`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `idx_user_t_id` (`user_t_id`);

--
-- Index pour la table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`message_id`),
  ADD KEY `sender_id` (`sender_id`),
  ADD KEY `receiver_id` (`receiver_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Index pour la table `user_t`
--
ALTER TABLE `user_t`
  ADD PRIMARY KEY (`user_t_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `library`
--
ALTER TABLE `library`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT pour la table `message`
--
ALTER TABLE `message`
  MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT pour la table `user_t`
--
ALTER TABLE `user_t`
  MODIFY `user_t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `library`
--
ALTER TABLE `library`
  ADD CONSTRAINT `fk_library_user` FOREIGN KEY (`user_t_id`) REFERENCES `user_t` (`user_t_id`) ON DELETE CASCADE;

--
-- Contraintes pour la table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `message_ibfk_1` FOREIGN KEY (`sender_id`) REFERENCES `user_t` (`user_t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `user_t` (`user_t_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `message_ibfk_3` FOREIGN KEY (`book_id`) REFERENCES `library` (`book_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
