-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : ven. 29 mai 2026 à 19:45
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `fitspace`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `full_description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `author_id` int UNSIGNED DEFAULT NULL,
  `status` enum('draft','published') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'published',
  `published_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug` (`slug`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles`
--

INSERT INTO `articles` (`id`, `title`, `slug`, `short_description`, `full_description`, `image`, `author_id`, `status`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 'Abonnement Premium', 'abonnement-premium', 'Accès illimité à toutes les salles et cours collectifs.', 'L\'abonnement Premium vous offre un accès illimité à l\'ensemble de nos équipements cardio et musculation, ainsi qu\'à tous les cours collectifs (yoga, spinning, HIIT, cross-training). Profitez également de vestiaires premium, casiers sécurisés et d\'un suivi personnalisé avec un coach dédié une fois par mois.', 'premium.jpg', 1, 'published', '2026-05-17 17:36:00', '2026-05-17 17:36:57', '2026-05-28 12:10:28'),
(2, 'Abonnement Standard', 'abonnement-standard', 'L\'essentiel pour progresser à votre rythme.', 'L\'abonnement Standard inclut l\'accès à la salle de musculation et cardio aux heures creuses et pleines. Idéal pour les sportifs autonomes qui souhaitent un rapport qualité-prix optimal. Vestiaires et douches inclus.', 'standard.jpg', 1, 'published', '2026-05-17 17:36:00', '2026-05-17 17:36:57', '2026-05-28 12:11:13'),
(3, 'Cours Collectifs', 'cours-collectifs', 'Plus de 30 cours par semaine animés par des coachs certifiés.', 'Rejoignez nos cours collectifs : yoga, pilates, spinning, Zumba, body pump, HIIT et bien plus. Planning flexible du lundi au dimanche. Réservation en ligne depuis votre espace membre.', 'cours.jpg', 1, 'published', '2026-05-17 17:36:57', '2026-05-17 17:36:57', NULL),
(4, 'Coaching Personnel', 'coaching-personnel', 'Un programme sur mesure adapté à vos objectifs.', 'Bénéficiez d\'un accompagnement individuel avec nos coachs diplômés. Bilan initial, programme personnalisé, suivi nutritionnel et ajustements réguliers pour atteindre vos objectifs : perte de poids, prise de masse ou remise en forme.', 'coaching.jpg', 1, 'published', '2026-05-17 17:36:57', '2026-05-17 17:36:57', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `article_id` int UNSIGNED NOT NULL,
  `reservation_date` datetime NOT NULL,
  `status` enum('pending','confirmed','cancelled') COLLATE utf8mb4_unicode_ci DEFAULT 'confirmed',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `relation1` (`user_id`),
  KEY `relation2` (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reservations`
--

INSERT INTO `reservations` (`id`, `user_id`, `article_id`, `reservation_date`, `status`, `created_at`) VALUES
(1, 1, 1, '2026-06-10 18:30:00', 'confirmed', '2026-05-29 12:11:07'),
(2, 1, 2, '2026-06-11 07:00:00', 'confirmed', '2026-05-29 12:11:07'),
(3, 1, 3, '2026-06-12 19:00:00', 'confirmed', '2026-05-29 12:11:07'),
(4, 1, 3, '2026-06-10 18:30:00', 'confirmed', '2026-05-29 12:13:29'),
(5, 1, 4, '2026-06-11 07:00:00', 'confirmed', '2026-05-29 12:13:29'),
(6, 1, 1, '2026-06-12 19:00:00', 'confirmed', '2026-05-29 12:13:29'),
(7, 1, 4, '2026-05-29 14:43:37', 'confirmed', '2026-05-29 14:43:37'),
(8, 1, 4, '2026-05-29 14:43:50', 'cancelled', '2026-05-29 14:43:50');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` enum('user','admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'user',
  `membership` enum('basic','pro','elite') COLLATE utf8mb4_unicode_ci DEFAULT 'basic',
  `reset_token` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reset_expires` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `username`, `email`, `avatar`, `password`, `role`, `membership`, `reset_token`, `reset_expires`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'FitSpace', 'admin', 'admin@fitspace.fr', 'avatar_1_1780056618.jpg', '$2y$10$CcFcV.CZcoZK5DjP97cX2OSmSyaUPDhGLYoOl6IpFV3W9qP2qMhqW', 'admin', 'elite', NULL, NULL, '2026-05-17 17:36:57', '2026-05-29 14:10:18');

-- --------------------------------------------------------

--
-- Structure de la table `user_stats`
--

DROP TABLE IF EXISTS `user_stats`;
CREATE TABLE IF NOT EXISTS `user_stats` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int UNSIGNED NOT NULL,
  `calories_burned` int DEFAULT '0',
  `streak_days` int DEFAULT '0',
  `total_volume` int DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user_stats`
--

INSERT INTO `user_stats` (`id`, `user_id`, `calories_burned`, `streak_days`, `total_volume`, `created_at`) VALUES
(1, 1, 12450, 14, 42800, '2026-05-29 11:57:48');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles`
--
ALTER TABLE `articles`
  ADD CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Contraintes pour la table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `relation1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `relation2` FOREIGN KEY (`article_id`) REFERENCES `articles` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Contraintes pour la table `user_stats`
--
ALTER TABLE `user_stats`
  ADD CONSTRAINT `relation3` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
