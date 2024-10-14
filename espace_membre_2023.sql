-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : dim. 26 mai 2024 à 11:33
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `espace_membre_2023`
--

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `photo` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `confirmation_token` varchar(150) DEFAULT NULL,
  `confirmed_at` datetime DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_at` datetime DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `username`, `photo`, `email`, `password`, `confirmation_token`, `confirmed_at`, `reset_token`, `reset_at`, `remember_token`) VALUES
(118, 'rostodev', '', 'rostodev@gmail.com', '$2y$10$3KYAZhFko1CdGspJyE2AEOFzpBHszkwHRiCBOUjyAPsDtEiQYkKvC', NULL, '2023-09-05 02:46:39', NULL, NULL, NULL),
(119, 'eva', '', 'eva@gmail.com', '$2y$10$ERwBociX/MlOYcuD4KjJdeCe9Y02CV.1/g2JXVBi1KCLoCBwIK5TC', NULL, '2023-09-05 02:56:57', NULL, NULL, 'JkE1Pdn3bQahVbsbqp7ldGiZ43fiKUO3it316pKkocOe4R9unDIEHYpj1tDaa2cUqOUu6lKD8BvdfzRByPYUrq6UMOA8Irw2UFDf'),
(120, 'lele', '', 'lele@gmail.com', '$2y$10$3jLlkVPLXlftOpCmTI1JVuRQJeGwtv7AszsB.CLEU5K/EqQN3Vqs6', NULL, '2023-09-05 13:27:26', NULL, NULL, NULL),
(121, 'waffo', '', 'waffo@gmail.com', '$2y$10$Lhv1YPr0zF2WqdScLMtC9.JG5KDBMsP4vYQfhvQNHk3GcZqTJzvnm', NULL, '2023-09-05 14:38:15', NULL, NULL, 'YA0z16dFeo3sDGFssWZXGF1sCyVOJiFpdEitgR0olzZvWF6O9egx1rcTczuHA4L0g5wK5fqQOYIlrZT7oi2ANoSszBo8fkLX8qu9'),
(122, 'waffi', '', 'waffi@gmail.com', '$2y$10$hRPwi836KE26cy8Jkiu6YetyKb8aoMN6DjjXkOS7zrFQkOzCdZD2u', 'KGnnYSWquV', NULL, NULL, NULL, NULL),
(123, 'lilio', '', 'rostoinfocuslilio@gmail.com', '$2y$10$gVyeHZMgL3/ZzdDFUTiaeeEUzPaudiammKOlhwknuJ7g/6n/84moe', NULL, '2024-05-15 06:24:16', NULL, NULL, '26z9gKxgXbGVpJNjPx1gp7DKVtPCW8Gz0PZW2EmFuthPc2f6vfj3uqHYxXPdpnnhdJ5cmuzLrBvP2cZTDqxSxievj0kYhWwtlwQe'),
(124, 'rostodev2', '', 'rostodev2@gmail.com', '$2y$10$rXXS7D2yY8PkECuLFmm7kOvDUFS/4MpQMFAe4Y/yWrKA64lh1NSqW', '75LUPnKwdx', NULL, NULL, NULL, NULL),
(125, 'rostodev123', '', 'rostodev123@gmail.com', '$2y$10$61S02v59pw4JuEGAgE3U3O0tRvFNWqlvHB4CQ3kJViOcXROepokxC', NULL, '2024-05-24 03:07:33', NULL, NULL, '9xCVxBOeowqtgzUdDbb1kR7bTIcK9AUOyvoScmksl2nubTgprXBaxIzvGDqNh4rHeYsQP3scnqTEZEVl7vkXgenwBUrRzqjOLysk');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
