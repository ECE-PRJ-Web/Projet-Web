-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : dim. 02 juin 2024 à 21:00
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `medicare`
--

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `CarteVitale` int DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `type_compte` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `prenom`, `email`, `address`, `CarteVitale`, `password`, `type_compte`) VALUES
(5, 'Prie', 'Galatée', 'Example@gmail.com', NULL, NULL, 'E', 1),
(4, 'Dardeau', 'Noel', 'noel.dardeau@edu.ece.fr', NULL, NULL, 'D', 1),
(3, 'Hirou', 'Briac', 'briac.hirou@edu.ece.fr', NULL, NULL, 'C', 1),
(2, 'Gasnier ', 'Gabriel', 'gabriel.gasnier@edu.ece.fr', NULL, NULL, 'B', 1),
(1, 'Dzierzbicki', 'vadim', 'vadim.dzierzbicki@edu.ece.fr', NULL, NULL, 'A', 2),
(6, 'Belazi', 'Lilia', 'Example2@gmail.com', NULL, NULL, 'F', 1);

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites`
--

DROP TABLE IF EXISTS `disponibilites`;
CREATE TABLE IF NOT EXISTS `disponibilites` (
  `id` int NOT NULL AUTO_INCREMENT,
  `medecin_id` int DEFAULT NULL,
  `jour_semaine` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medecin_id` (`medecin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=274 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `disponibilites`
--

INSERT INTO `disponibilites` (`id`, `medecin_id`, `jour_semaine`, `heure_debut`, `heure_fin`, `disponible`) VALUES
(96, 6, 'mardi', '11:00:00', '12:00:00', 1),
(95, 6, 'mardi', '10:00:00', '11:00:00', 1),
(94, 6, 'mardi', '09:00:00', '10:00:00', 1),
(93, 6, 'lundi', '13:00:00', '14:00:00', 0),
(92, 6, 'lundi', '12:00:00', '13:00:00', 1),
(91, 6, 'lundi', '11:00:00', '12:00:00', 1),
(90, 6, 'lundi', '10:00:00', '11:00:00', 1),
(89, 6, 'lundi', '09:00:00', '10:00:00', 1),
(88, 5, 'mardi', '13:00:00', '14:00:00', 1),
(87, 5, 'mardi', '12:00:00', '13:00:00', 1),
(86, 5, 'mardi', '11:00:00', '12:00:00', 1),
(85, 5, 'mardi', '10:00:00', '11:00:00', 1),
(84, 5, 'mardi', '09:00:00', '10:00:00', 1),
(83, 5, 'lundi', '13:00:00', '14:00:00', 1),
(82, 5, 'lundi', '12:00:00', '13:00:00', 1),
(81, 5, 'lundi', '11:00:00', '12:00:00', 1),
(80, 5, 'lundi', '10:00:00', '11:00:00', 1),
(79, 5, 'lundi', '09:00:00', '10:00:00', 1),
(78, 4, 'mardi', '13:00:00', '14:00:00', 1),
(77, 4, 'mardi', '12:00:00', '13:00:00', 1),
(76, 4, 'mardi', '11:00:00', '12:00:00', 1),
(75, 4, 'mardi', '10:00:00', '11:00:00', 1),
(74, 4, 'mardi', '09:00:00', '10:00:00', 1),
(73, 4, 'lundi', '13:00:00', '14:00:00', 1),
(72, 4, 'lundi', '12:00:00', '13:00:00', 1),
(71, 4, 'lundi', '11:00:00', '12:00:00', 1),
(70, 4, 'lundi', '10:00:00', '11:00:00', 1),
(69, 4, 'lundi', '09:00:00', '10:00:00', 1),
(68, 3, 'mardi', '13:00:00', '14:00:00', 1),
(67, 3, 'mardi', '12:00:00', '13:00:00', 1),
(66, 3, 'mardi', '11:00:00', '12:00:00', 1),
(65, 3, 'mardi', '10:00:00', '11:00:00', 1),
(64, 3, 'mardi', '09:00:00', '10:00:00', 1),
(63, 3, 'lundi', '13:00:00', '14:00:00', 1),
(62, 3, 'lundi', '12:00:00', '13:00:00', 1),
(61, 3, 'lundi', '11:00:00', '12:00:00', 1),
(60, 3, 'lundi', '10:00:00', '11:00:00', 1),
(59, 3, 'lundi', '09:00:00', '10:00:00', 1),
(58, 2, 'mardi', '13:00:00', '14:00:00', 1),
(57, 2, 'mardi', '12:00:00', '13:00:00', 1),
(56, 2, 'mardi', '11:00:00', '12:00:00', 1),
(55, 2, 'mardi', '10:00:00', '11:00:00', 1),
(54, 2, 'mardi', '09:00:00', '10:00:00', 1),
(53, 2, 'lundi', '13:00:00', '14:00:00', 1),
(52, 2, 'lundi', '12:00:00', '13:00:00', 1),
(51, 2, 'lundi', '11:00:00', '12:00:00', 1),
(50, 2, 'lundi', '10:00:00', '11:00:00', 1),
(49, 2, 'lundi', '09:00:00', '10:00:00', 1),
(97, 6, 'mardi', '12:00:00', '13:00:00', 1),
(98, 6, 'mardi', '13:00:00', '14:00:00', 1),
(99, 2, 'lundi', '10:00:00', '11:00:00', 1),
(100, 2, 'lundi', '11:00:00', '12:00:00', 1),
(101, 2, 'lundi', '12:00:00', '13:00:00', 1),
(102, 2, 'lundi', '13:00:00', '14:00:00', 1),
(103, 2, 'mardi', '10:00:00', '11:00:00', 1),
(104, 2, 'mardi', '11:00:00', '12:00:00', 1),
(105, 2, 'mardi', '12:00:00', '13:00:00', 1),
(106, 2, 'mardi', '13:00:00', '14:00:00', 1),
(107, 3, 'lundi', '10:00:00', '11:00:00', 1),
(108, 3, 'lundi', '11:00:00', '12:00:00', 1),
(109, 3, 'lundi', '12:00:00', '13:00:00', 1),
(110, 3, 'lundi', '13:00:00', '14:00:00', 1),
(111, 3, 'mardi', '10:00:00', '11:00:00', 1),
(112, 3, 'mardi', '11:00:00', '12:00:00', 1),
(113, 3, 'mardi', '12:00:00', '13:00:00', 1),
(114, 3, 'mardi', '13:00:00', '14:00:00', 1),
(115, 4, 'lundi', '10:00:00', '11:00:00', 1),
(116, 4, 'lundi', '11:00:00', '12:00:00', 1),
(117, 4, 'lundi', '12:00:00', '13:00:00', 1),
(118, 4, 'lundi', '13:00:00', '14:00:00', 1),
(119, 4, 'mardi', '10:00:00', '11:00:00', 1),
(120, 4, 'mardi', '11:00:00', '12:00:00', 1),
(121, 4, 'mardi', '12:00:00', '13:00:00', 1),
(122, 4, 'mardi', '13:00:00', '14:00:00', 1),
(123, 5, 'lundi', '10:00:00', '11:00:00', 1),
(124, 5, 'lundi', '11:00:00', '12:00:00', 1),
(125, 5, 'lundi', '12:00:00', '13:00:00', 1),
(126, 5, 'lundi', '13:00:00', '14:00:00', 1),
(127, 5, 'mardi', '10:00:00', '11:00:00', 1),
(128, 5, 'mardi', '11:00:00', '12:00:00', 1),
(129, 5, 'mardi', '12:00:00', '13:00:00', 1),
(130, 5, 'mardi', '13:00:00', '14:00:00', 1),
(131, 6, 'lundi', '10:00:00', '11:00:00', 1),
(132, 6, 'lundi', '11:00:00', '12:00:00', 1),
(133, 6, 'lundi', '12:00:00', '13:00:00', 1),
(134, 6, 'lundi', '13:00:00', '14:00:00', 1),
(135, 6, 'mardi', '10:00:00', '11:00:00', 1),
(136, 6, 'mardi', '11:00:00', '12:00:00', 1),
(137, 6, 'mardi', '12:00:00', '13:00:00', 1),
(138, 6, 'mardi', '13:00:00', '14:00:00', 1),
(139, 2, 'mercredi', '09:00:00', '10:00:00', 1),
(140, 2, 'mercredi', '10:00:00', '11:00:00', 1),
(141, 2, 'mercredi', '10:00:00', '11:00:00', 1),
(142, 2, 'mercredi', '11:00:00', '12:00:00', 1),
(143, 2, 'mercredi', '11:00:00', '12:00:00', 1),
(144, 2, 'mercredi', '12:00:00', '13:00:00', 1),
(145, 2, 'mercredi', '12:00:00', '13:00:00', 1),
(146, 2, 'mercredi', '13:00:00', '14:00:00', 1),
(147, 2, 'mercredi', '13:00:00', '14:00:00', 1),
(148, 3, 'mercredi', '09:00:00', '10:00:00', 1),
(149, 3, 'mercredi', '10:00:00', '11:00:00', 1),
(150, 3, 'mercredi', '10:00:00', '11:00:00', 1),
(151, 3, 'mercredi', '11:00:00', '12:00:00', 1),
(152, 3, 'mercredi', '11:00:00', '12:00:00', 1),
(153, 3, 'mercredi', '12:00:00', '13:00:00', 1),
(154, 3, 'mercredi', '12:00:00', '13:00:00', 1),
(155, 3, 'mercredi', '13:00:00', '14:00:00', 1),
(156, 3, 'mercredi', '13:00:00', '14:00:00', 1),
(157, 4, 'mercredi', '09:00:00', '10:00:00', 1),
(158, 4, 'mercredi', '10:00:00', '11:00:00', 1),
(159, 4, 'mercredi', '10:00:00', '11:00:00', 1),
(160, 4, 'mercredi', '11:00:00', '12:00:00', 1),
(161, 4, 'mercredi', '11:00:00', '12:00:00', 1),
(162, 4, 'mercredi', '12:00:00', '13:00:00', 1),
(163, 4, 'mercredi', '12:00:00', '13:00:00', 1),
(164, 4, 'mercredi', '13:00:00', '14:00:00', 1),
(165, 4, 'mercredi', '13:00:00', '14:00:00', 1),
(166, 5, 'mercredi', '09:00:00', '10:00:00', 1),
(167, 5, 'mercredi', '10:00:00', '11:00:00', 1),
(168, 5, 'mercredi', '10:00:00', '11:00:00', 1),
(169, 5, 'mercredi', '11:00:00', '12:00:00', 1),
(170, 5, 'mercredi', '11:00:00', '12:00:00', 1),
(171, 5, 'mercredi', '12:00:00', '13:00:00', 1),
(172, 5, 'mercredi', '12:00:00', '13:00:00', 1),
(173, 5, 'mercredi', '13:00:00', '14:00:00', 1),
(174, 5, 'mercredi', '13:00:00', '14:00:00', 1),
(175, 6, 'mercredi', '09:00:00', '10:00:00', 1),
(176, 6, 'mercredi', '10:00:00', '11:00:00', 1),
(177, 6, 'mercredi', '10:00:00', '11:00:00', 1),
(178, 6, 'mercredi', '11:00:00', '12:00:00', 1),
(179, 6, 'mercredi', '11:00:00', '12:00:00', 1),
(180, 6, 'mercredi', '12:00:00', '13:00:00', 1),
(181, 6, 'mercredi', '12:00:00', '13:00:00', 1),
(182, 6, 'mercredi', '13:00:00', '14:00:00', 1),
(183, 6, 'mercredi', '13:00:00', '14:00:00', 1),
(184, 2, 'jeudi', '09:00:00', '10:00:00', 1),
(185, 2, 'jeudi', '10:00:00', '11:00:00', 1),
(186, 2, 'jeudi', '10:00:00', '11:00:00', 1),
(187, 2, 'jeudi', '11:00:00', '12:00:00', 1),
(188, 2, 'jeudi', '11:00:00', '12:00:00', 1),
(189, 2, 'jeudi', '12:00:00', '13:00:00', 1),
(190, 2, 'jeudi', '12:00:00', '13:00:00', 1),
(191, 2, 'jeudi', '13:00:00', '14:00:00', 1),
(192, 2, 'jeudi', '13:00:00', '14:00:00', 1),
(193, 3, 'jeudi', '09:00:00', '10:00:00', 1),
(194, 3, 'jeudi', '10:00:00', '11:00:00', 1),
(195, 3, 'jeudi', '10:00:00', '11:00:00', 1),
(196, 3, 'jeudi', '11:00:00', '12:00:00', 1),
(197, 3, 'jeudi', '11:00:00', '12:00:00', 1),
(198, 3, 'jeudi', '12:00:00', '13:00:00', 1),
(199, 3, 'jeudi', '12:00:00', '13:00:00', 1),
(200, 3, 'jeudi', '13:00:00', '14:00:00', 1),
(201, 3, 'jeudi', '13:00:00', '14:00:00', 1),
(202, 4, 'jeudi', '09:00:00', '10:00:00', 1),
(203, 4, 'jeudi', '10:00:00', '11:00:00', 1),
(204, 4, 'jeudi', '10:00:00', '11:00:00', 1),
(205, 4, 'jeudi', '11:00:00', '12:00:00', 1),
(206, 4, 'jeudi', '11:00:00', '12:00:00', 1),
(207, 4, 'jeudi', '12:00:00', '13:00:00', 1),
(208, 4, 'jeudi', '12:00:00', '13:00:00', 1),
(209, 4, 'jeudi', '13:00:00', '14:00:00', 1),
(210, 4, 'jeudi', '13:00:00', '14:00:00', 1),
(211, 5, 'jeudi', '09:00:00', '10:00:00', 1),
(212, 5, 'jeudi', '10:00:00', '11:00:00', 1),
(213, 5, 'jeudi', '10:00:00', '11:00:00', 1),
(214, 5, 'jeudi', '11:00:00', '12:00:00', 1),
(215, 5, 'jeudi', '11:00:00', '12:00:00', 1),
(216, 5, 'jeudi', '12:00:00', '13:00:00', 1),
(217, 5, 'jeudi', '12:00:00', '13:00:00', 1),
(218, 5, 'jeudi', '13:00:00', '14:00:00', 1),
(219, 5, 'jeudi', '13:00:00', '14:00:00', 1),
(220, 6, 'jeudi', '09:00:00', '10:00:00', 1),
(221, 6, 'jeudi', '10:00:00', '11:00:00', 1),
(222, 6, 'jeudi', '10:00:00', '11:00:00', 1),
(223, 6, 'jeudi', '11:00:00', '12:00:00', 1),
(224, 6, 'jeudi', '11:00:00', '12:00:00', 1),
(225, 6, 'jeudi', '12:00:00', '13:00:00', 1),
(226, 6, 'jeudi', '12:00:00', '13:00:00', 1),
(227, 6, 'jeudi', '13:00:00', '14:00:00', 1),
(228, 6, 'jeudi', '13:00:00', '14:00:00', 1),
(229, 2, 'vendredi', '09:00:00', '10:00:00', 1),
(230, 2, 'vendredi', '10:00:00', '11:00:00', 1),
(231, 2, 'vendredi', '10:00:00', '11:00:00', 1),
(232, 2, 'vendredi', '11:00:00', '12:00:00', 1),
(233, 2, 'vendredi', '11:00:00', '12:00:00', 1),
(234, 2, 'vendredi', '12:00:00', '13:00:00', 1),
(235, 2, 'vendredi', '12:00:00', '13:00:00', 1),
(236, 2, 'vendredi', '13:00:00', '14:00:00', 1),
(237, 2, 'vendredi', '13:00:00', '14:00:00', 1),
(238, 3, 'vendredi', '09:00:00', '10:00:00', 1),
(239, 3, 'vendredi', '10:00:00', '11:00:00', 1),
(240, 3, 'vendredi', '10:00:00', '11:00:00', 1),
(241, 3, 'vendredi', '11:00:00', '12:00:00', 1),
(242, 3, 'vendredi', '11:00:00', '12:00:00', 1),
(243, 3, 'vendredi', '12:00:00', '13:00:00', 1),
(244, 3, 'vendredi', '12:00:00', '13:00:00', 1),
(245, 3, 'vendredi', '13:00:00', '14:00:00', 1),
(246, 3, 'vendredi', '13:00:00', '14:00:00', 1),
(247, 4, 'vendredi', '09:00:00', '10:00:00', 1),
(248, 4, 'vendredi', '10:00:00', '11:00:00', 1),
(249, 4, 'vendredi', '10:00:00', '11:00:00', 1),
(250, 4, 'vendredi', '11:00:00', '12:00:00', 1),
(251, 4, 'vendredi', '11:00:00', '12:00:00', 1),
(252, 4, 'vendredi', '12:00:00', '13:00:00', 1),
(253, 4, 'vendredi', '12:00:00', '13:00:00', 1),
(254, 4, 'vendredi', '13:00:00', '14:00:00', 1),
(255, 4, 'vendredi', '13:00:00', '14:00:00', 1),
(256, 5, 'vendredi', '09:00:00', '10:00:00', 1),
(257, 5, 'vendredi', '10:00:00', '11:00:00', 1),
(258, 5, 'vendredi', '10:00:00', '11:00:00', 1),
(259, 5, 'vendredi', '11:00:00', '12:00:00', 1),
(260, 5, 'vendredi', '11:00:00', '12:00:00', 1),
(261, 5, 'vendredi', '12:00:00', '13:00:00', 1),
(262, 5, 'vendredi', '12:00:00', '13:00:00', 1),
(263, 5, 'vendredi', '13:00:00', '14:00:00', 1),
(264, 5, 'vendredi', '13:00:00', '14:00:00', 1),
(265, 6, 'vendredi', '09:00:00', '10:00:00', 1),
(266, 6, 'vendredi', '10:00:00', '11:00:00', 1),
(267, 6, 'vendredi', '10:00:00', '11:00:00', 1),
(268, 6, 'vendredi', '11:00:00', '12:00:00', 1),
(269, 6, 'vendredi', '11:00:00', '12:00:00', 1),
(270, 6, 'vendredi', '12:00:00', '13:00:00', 1),
(271, 6, 'vendredi', '12:00:00', '13:00:00', 1),
(272, 6, 'vendredi', '13:00:00', '14:00:00', 1),
(273, 6, 'vendredi', '13:00:00', '14:00:00', 1);

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites_labo`
--

DROP TABLE IF EXISTS `disponibilites_labo`;
CREATE TABLE IF NOT EXISTS `disponibilites_labo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `services_labo_id` int DEFAULT NULL,
  `jour_semaine` enum('lundi','mardi','mercredi','jeudi','vendredi','samedi','dimanche') DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `services_labo_id` (`services_labo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int NOT NULL AUTO_INCREMENT,
  `expediteur_id` int DEFAULT NULL,
  `destinataire_id` int DEFAULT NULL,
  `date_heure` datetime DEFAULT NULL,
  `message` text,
  PRIMARY KEY (`message_id`),
  KEY `expediteur_id` (`expediteur_id`),
  KEY `destinataire_id` (`destinataire_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `messages`
--

INSERT INTO `messages` (`message_id`, `expediteur_id`, `destinataire_id`, `date_heure`, `message`) VALUES
(1, 1, 4, '2024-06-02 20:55:16', '  h jn');

-- --------------------------------------------------------


-- Structure de la table `professionnels`
--

DROP TABLE IF EXISTS `professionnels`;
CREATE TABLE IF NOT EXISTS `professionnels` (
                                                `id` int NOT NULL,
                                                `path_photo` varchar(255) DEFAULT NULL,
    `specialite` varchar(255) DEFAULT 'Généraliste',
    `path_video` varchar(255) DEFAULT NULL,
    `path_CV` varchar(255) DEFAULT NULL,
    `disponible` tinyint(1) DEFAULT '1',
    PRIMARY KEY (`id`)
    ) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `professionnels`
--

INSERT INTO `professionnels` (`id`, `path_photo`, `specialite`, `path_video`, `path_CV`, `disponible`) VALUES
                                                                                                           (3, '', 'Cardiologue', NULL, NULL, 1),
                                                                                                           (6, '', 'Généraliste', NULL, 'CV/cv_lilia_belazi.xml', 1),
                                                                                                           (5, '', 'Podologue', NULL, NULL, 1),
                                                                                                           (4, '', 'Généraliste', NULL, NULL, 1),
                                                                                                           (2, '', 'Généraliste', NULL, NULL, 1);
COMMIT;




-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `rdv_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `medecin_id` int DEFAULT NULL,
  `services_labo_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `statut` enum('programmé','annulé','terminé') NOT NULL,
  PRIMARY KEY (`rdv_id`),
  KEY `client_id` (`client_id`),
  KEY `medecin_id` (`medecin_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `rendezvous`
--

INSERT INTO `rendezvous` (`rdv_id`, `client_id`, `medecin_id`, `services_labo_id`, `date`, `heure`, `statut`) VALUES
(6, 1, 6, NULL, '2024-06-02', '13:00:00', 'programmé');

-- --------------------------------------------------------

--
-- Structure de la table `reservations_services`
--

DROP TABLE IF EXISTS `reservations_services`;
CREATE TABLE IF NOT EXISTS `reservations_services` (
  `reservation_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `service_id` int DEFAULT NULL,
  `date` date DEFAULT NULL,
  `heure` time DEFAULT NULL,
  `statut` enum('réservé','annulé','terminé') NOT NULL,
  PRIMARY KEY (`reservation_id`),
  KEY `client_id` (`client_id`),
  KEY `service_id` (`service_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services_laboratoire`
--

DROP TABLE IF EXISTS `services_laboratoire`;
CREATE TABLE IF NOT EXISTS `services_laboratoire` (
  `service_id` int NOT NULL AUTO_INCREMENT,
  `nom_service` varchar(255) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `details` text NOT NULL,
  `salle` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`service_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `services_laboratoire`
--

INSERT INTO `services_laboratoire` (`service_id`, `nom_service`, `title`, `description`, `details`, `salle`) VALUES
(1, 'Dépistage covid-19', 'Dépistage covid-19', 'La maladie à coronavirus (COVID19) est une maladie infectieuse due au virus SARS-CoV-2. Le virus peut se propager par l\'intermédiaire des gouttelettes de salive ou de sécrétions nasales émises par une personne infectée quand elle tousse, éternue, parle, chante ou respire. Il est donc important d\'appliquer les règles d\'hygiène respiratoire, par exemple en se couvrant la bouche et le nez avec le pli du coude lorsque l’on tousse, et si l’on ne se sent pas bien, de rester chez soi et de s’isoler jusqu’à ce qu’on soit rétabli. Les principaux symptômes, combinés ou isolés, de l\'infection par le Covid-19 sont : fièvre ou sensation de fièvre, des signes respiratoires, comme une toux, un essoufflement ou une sensation d’oppression dans la poitrine, des maux de tête, des courbatures, une fatigue inhabituelle, une perte brutale de l’odorat (sans obstruction nasale), une disparition totale du goût, une diarrhée.', 'Il existe 2 méthodes actuellement en France. Dans le premier cas, le test de référence RT-PCR, se fait sous la forme d’un prélèvement naso-pharyngé dans la majorité des cas. Il ne dure que quelques secondes et peut occasionner une légère gêne dans le nez. Le principe : un échantillon de mucus est prélevé dans le nez grâce à un long coton-tige, appelé écouvillon. Une fois récupéré, l\'échantillon est scellé puis analysé par le laboratoire de biologie médicale. Ce prélèvement n\'est pas adapté à toutes les situations, particulièrement lorsque le test doit être répété. C’est pourquoi il est possible de réaliser un test RT-PCR à partir d’un prélèvement salivaire notamment chez les personnes contact pour qui un prélèvement nasopharyngé n\'est pas envisageable.', '110'),
(2, 'Biologie préventive', 'Biologie préventive', 'La biologie préventive ou biologie fonctionnelle apporte une vision systémique et dynamique du vivant. Le corps humain peut être vu comme un ensemble de sous-systèmes. Avant la lésion d’un organe, il y a la lésion du tissu, précédée de la lésion cellulaire et de la lésion moléculaire. C’est à l’échelle moléculaire que l’on peut prévenir la maladie et améliorer le capital santé d’un patient. La biologie fonctionnelle permet aujourd’hui une mesure complète et objective de l’état de fonctionnement des systèmes métaboliques et endocriniens et de leurs interactions pour prévenir la maladie et optimiser le capital santé des patients. Les champs d’applications et motivations pour la réalisation d’un bilan de biologie fonctionnelle sont : La prévention pure, L’optimisation des performances, Le traitement d’inconforts (douleurs articulaires, digestion…) sans origine connue, L’accompagnement en complément d’une prise en charge médicale pour des pathologies déjà avérées.', '', '020'),
(3, 'Biologie de la femme enceinte', 'Biologie de la femme enceinte', 'La biologie de la femme enceinte concerne les analyses et les examens spécifiques réalisés pendant la grossesse pour surveiller la santé de la mère et du fœtus. Ces examens sont essentiels pour détecter d\'éventuelles complications précoces et assurer un suivi adapté à chaque stade de la grossesse.', '', '240'),
(4, 'Biologie de routine', 'Biologie de routine', 'La biologie de routine comprend un ensemble d\'analyses médicales standard utilisées pour évaluer l\'état de santé général d\'un individu.\r\nLes analyses réalisées dans le cadre de la biologie de routine incluent généralement : La numération formule sanguine (NFS) pour évaluer les cellules sanguines. La glycémie pour mesurer le taux de sucre dans le sang. La fonction rénale et hépatique pour évaluer le fonctionnement des reins et du foie. Le dosage des lipides sanguins (cholestérol, triglycérides) pour évaluer le risque cardiovasculaire. Le dosage des marqueurs inflammatoires pour détecter une inflammation. Le dosage des enzymes cardiaques en cas de suspicion d\'infarctus du myocarde. Le dosage des hormones thyroïdiennes pour évaluer la fonction thyroïdienne.', 'Avant la prise de sang, plusieurs éléments doivent être pris en considération. Dans ce cas-ci, vous devez vous abstenir de manger au moins 12 h avant la prise de sang. L\'eau est la seule chose qu\'il est possible de consommer. Il est également recommandé d\'éviter le tabac et les activités physiques intenses.', '369'),
(5, 'Cancérologie', 'Cancérologie', 'La cancérologie est la branche de la médecine qui étudie et traite le cancer. Elle englobe le diagnostic, le traitement et le suivi des patients atteints de cancer.', 'Les examens utilisés en cancérologie incluent : \r\n  -La biopsie pour prélever un échantillon de tissu à analyser en laboratoire.\r\n  -L\'imagerie médicale (scanner, IRM, PET-scan) pour visualiser les tumeurs et évaluer leur extension.\r\n  -Les analyses sanguines pour détecter des marqueurs spécifiques du cancer.\r\n\r\n\r\nLes traitements en cancérologie comprennent :\r\n  -La chirurgie pour retirer les tumeurs.\r\n  -La radiothérapie pour détruire les cellules cancéreuses.\r\n  -La chimiothérapie pour traiter le cancer par des médicaments.\r\n  -L\'immunothérapie pour renforcer le système immunitaire contre le cancer.', '092'),
(6, 'Gynécologie', 'Gynécologie', 'La gynécologie est la spécialité médicale qui s\'occupe de la santé de l\'appareil génital féminin. Elle englobe le suivi gynécologique, la prévention et le traitement des pathologies gynécologiques, ainsi que le suivi de la grossesse et de l\'accouchement.', 'Consultation gynécologique La consultation gynécologique comprend généralement : \r\n     - Un entretien pour recueillir les antécédents médicaux et les symptômes. \r\n     - Un examen clinique pour évaluer l\'état de santé des organes génitaux. \r\n     - Des examens complémentaires comme une échographie pelvienne ou un frottis cervico-vaginal. \r\nLes pathologies gynécologiques courantes incluent : \r\n     - Les infections vaginales comme la candidose ou la vaginose bactérienne. \r\n     - Les troubles menstruels comme les règles abondantes ou douloureuses. \r\n     - Les pathologies du col de l\'utérus comme les lésions précancéreuses. \r\n     - Les pathologies mammaires comme les kystes ou les tumeurs.', '099');

-- --------------------------------------------------------

--
-- Structure de la table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
CREATE TABLE IF NOT EXISTS `transactions` (
  `transaction_id` int NOT NULL AUTO_INCREMENT,
  `client_id` int DEFAULT NULL,
  `type_carte` enum('Visa','MasterCard','AmericanExpress','PayPal') NOT NULL,
  `numero_carte` varchar(20) NOT NULL,
  `nom_carte` varchar(255) NOT NULL,
  `date_expiration` date NOT NULL,
  `code_securite` varchar(4) NOT NULL,
  `montant` decimal(10,2) NOT NULL,
  `date_transaction` date NOT NULL,
  `statut` enum('validé','refusé') NOT NULL,
  PRIMARY KEY (`transaction_id`),
  KEY `client_id` (`client_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
