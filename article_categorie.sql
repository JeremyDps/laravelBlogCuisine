-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 26 août 2020 à 13:02
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `laravelblogcuisine`
--

-- --------------------------------------------------------

--
-- Structure de la table `article_categorie`
--

DROP TABLE IF EXISTS `article_categorie`;
CREATE TABLE IF NOT EXISTS `article_categorie` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `article_categorie`
--

INSERT INTO `article_categorie` (`id`, `article_id`, `categorie_id`) VALUES
(19, 2, 15),
(18, 2, 8),
(17, 2, 2),
(4, 3, 2),
(5, 3, 3),
(6, 3, 4),
(20, 1, 3),
(16, 2, 3),
(21, 4, 1),
(22, 4, 6);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
