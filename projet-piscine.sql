-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 29 mai 2024 à 10:28
-- Version du serveur : 8.0.31
-- Version de PHP : 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projet-piscine`
--

-- --------------------------------------------------------

--
-- Structure de la table `coachs`
--

DROP TABLE IF EXISTS `coachs`;
CREATE TABLE IF NOT EXISTS `coachs` (
  `id_coach` int NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int DEFAULT NULL,
  `specialite` varchar(100) DEFAULT NULL,
  `photo_url` varchar(255) DEFAULT NULL,
  `video_url` varchar(255) DEFAULT NULL,
  `cv` text,
  PRIMARY KEY (`id_coach`),
  KEY `id_utilisateur` (`id_utilisateur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `coachs_services`
--

DROP TABLE IF EXISTS `coachs_services`;
CREATE TABLE IF NOT EXISTS `coachs_services` (
  `id_coach_service` int NOT NULL AUTO_INCREMENT,
  `id_coach` int DEFAULT NULL,
  `id_service` int DEFAULT NULL,
  PRIMARY KEY (`id_coach_service`),
  KEY `id_coach` (`id_coach`),
  KEY `id_service` (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `creneaux`
--

DROP TABLE IF EXISTS `creneaux`;
CREATE TABLE IF NOT EXISTS `creneaux` (
  `id_creneau` int NOT NULL AUTO_INCREMENT,
  `jour_semaine` enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi') DEFAULT NULL,
  `heure_debut` time DEFAULT NULL,
  `heure_fin` time DEFAULT NULL,
  PRIMARY KEY (`id_creneau`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `creneaux`
--

INSERT INTO `creneaux` (`id_creneau`, `jour_semaine`, `heure_debut`, `heure_fin`) VALUES
(1, 'Lundi', '08:00:00', '08:30:00'),
(2, 'Lundi', '08:30:00', '09:00:00'),
(3, 'Lundi', '09:00:00', '09:30:00'),
(4, 'Lundi', '09:30:00', '10:00:00'),
(5, 'Lundi', '10:00:00', '10:30:00'),
(6, 'Lundi', '10:30:00', '11:00:00'),
(7, 'Lundi', '11:00:00', '11:30:00'),
(8, 'Lundi', '11:30:00', '12:00:00'),
(9, 'Lundi', '12:00:00', '12:30:00'),
(10, 'Lundi', '12:30:00', '13:00:00'),
(11, 'Lundi', '13:00:00', '13:30:00'),
(12, 'Lundi', '13:30:00', '14:00:00'),
(13, 'Lundi', '14:00:00', '14:30:00'),
(14, 'Lundi', '14:30:00', '15:00:00'),
(15, 'Lundi', '15:00:00', '15:30:00'),
(16, 'Lundi', '15:30:00', '16:00:00'),
(17, 'Lundi', '16:00:00', '16:30:00'),
(18, 'Lundi', '16:30:00', '17:00:00'),
(19, 'Lundi', '17:00:00', '17:30:00'),
(20, 'Lundi', '17:30:00', '18:00:00'),
(21, 'Lundi', '18:00:00', '18:30:00'),
(22, 'Lundi', '18:30:00', '19:00:00'),
(23, 'Lundi', '19:00:00', '19:30:00'),
(24, 'Lundi', '19:30:00', '20:00:00'),
(25, 'Mardi', '08:00:00', '08:30:00'),
(26, 'Mardi', '08:30:00', '09:00:00'),
(27, 'Mardi', '09:00:00', '09:30:00'),
(28, 'Mardi', '09:30:00', '10:00:00'),
(29, 'Mardi', '10:00:00', '10:30:00'),
(30, 'Mardi', '10:30:00', '11:00:00'),
(31, 'Mardi', '11:00:00', '11:30:00'),
(32, 'Mardi', '11:30:00', '12:00:00'),
(33, 'Mardi', '12:00:00', '12:30:00'),
(34, 'Mardi', '12:30:00', '13:00:00'),
(35, 'Mardi', '13:00:00', '13:30:00'),
(36, 'Mardi', '13:30:00', '14:00:00'),
(37, 'Mardi', '14:00:00', '14:30:00'),
(38, 'Mardi', '14:30:00', '15:00:00'),
(39, 'Mardi', '15:00:00', '15:30:00'),
(40, 'Mardi', '15:30:00', '16:00:00'),
(41, 'Mardi', '16:00:00', '16:30:00'),
(42, 'Mardi', '16:30:00', '17:00:00'),
(43, 'Mardi', '17:00:00', '17:30:00'),
(44, 'Mardi', '17:30:00', '18:00:00'),
(45, 'Mardi', '18:00:00', '18:30:00'),
(46, 'Mardi', '18:30:00', '19:00:00'),
(47, 'Mardi', '19:00:00', '19:30:00'),
(48, 'Mardi', '19:30:00', '20:00:00'),
(49, 'Mercredi', '08:00:00', '08:30:00'),
(50, 'Mercredi', '08:30:00', '09:00:00'),
(51, 'Mercredi', '09:00:00', '09:30:00'),
(52, 'Mercredi', '09:30:00', '10:00:00'),
(53, 'Mercredi', '10:00:00', '10:30:00'),
(54, 'Mercredi', '10:30:00', '11:00:00'),
(55, 'Mercredi', '11:00:00', '11:30:00'),
(56, 'Mercredi', '11:30:00', '12:00:00'),
(57, 'Mercredi', '12:00:00', '12:30:00'),
(58, 'Mercredi', '12:30:00', '13:00:00'),
(59, 'Mercredi', '13:00:00', '13:30:00'),
(60, 'Mercredi', '13:30:00', '14:00:00'),
(61, 'Mercredi', '14:00:00', '14:30:00'),
(62, 'Mercredi', '14:30:00', '15:00:00'),
(63, 'Mercredi', '15:00:00', '15:30:00'),
(64, 'Mercredi', '15:30:00', '16:00:00'),
(65, 'Mercredi', '16:00:00', '16:30:00'),
(66, 'Mercredi', '16:30:00', '17:00:00'),
(67, 'Mercredi', '17:00:00', '17:30:00'),
(68, 'Mercredi', '17:30:00', '18:00:00'),
(69, 'Mercredi', '18:00:00', '18:30:00'),
(70, 'Mercredi', '18:30:00', '19:00:00'),
(71, 'Mercredi', '19:00:00', '19:30:00'),
(72, 'Mercredi', '19:30:00', '20:00:00'),
(73, 'Jeudi', '08:00:00', '08:30:00'),
(74, 'Jeudi', '08:30:00', '09:00:00'),
(75, 'Jeudi', '09:00:00', '09:30:00'),
(76, 'Jeudi', '09:30:00', '10:00:00'),
(77, 'Jeudi', '10:00:00', '10:30:00'),
(78, 'Jeudi', '10:30:00', '11:00:00'),
(79, 'Jeudi', '11:00:00', '11:30:00'),
(80, 'Jeudi', '11:30:00', '12:00:00'),
(81, 'Jeudi', '12:00:00', '12:30:00'),
(82, 'Jeudi', '12:30:00', '13:00:00'),
(83, 'Jeudi', '13:00:00', '13:30:00'),
(84, 'Jeudi', '13:30:00', '14:00:00'),
(85, 'Jeudi', '14:00:00', '14:30:00'),
(86, 'Jeudi', '14:30:00', '15:00:00'),
(87, 'Jeudi', '15:00:00', '15:30:00'),
(88, 'Jeudi', '15:30:00', '16:00:00'),
(89, 'Jeudi', '16:00:00', '16:30:00'),
(90, 'Jeudi', '16:30:00', '17:00:00'),
(91, 'Jeudi', '17:00:00', '17:30:00'),
(92, 'Jeudi', '17:30:00', '18:00:00'),
(93, 'Jeudi', '18:00:00', '18:30:00'),
(94, 'Jeudi', '18:30:00', '19:00:00'),
(95, 'Jeudi', '19:00:00', '19:30:00'),
(96, 'Jeudi', '19:30:00', '20:00:00'),
(97, 'Vendredi', '08:00:00', '08:30:00'),
(98, 'Vendredi', '08:30:00', '09:00:00'),
(99, 'Vendredi', '09:00:00', '09:30:00'),
(100, 'Vendredi', '09:30:00', '10:00:00'),
(101, 'Vendredi', '10:00:00', '10:30:00'),
(102, 'Vendredi', '10:30:00', '11:00:00'),
(103, 'Vendredi', '11:00:00', '11:30:00'),
(104, 'Vendredi', '11:30:00', '12:00:00'),
(105, 'Vendredi', '12:00:00', '12:30:00'),
(106, 'Vendredi', '12:30:00', '13:00:00'),
(107, 'Vendredi', '13:00:00', '13:30:00'),
(108, 'Vendredi', '13:30:00', '14:00:00'),
(109, 'Vendredi', '14:00:00', '14:30:00'),
(110, 'Vendredi', '14:30:00', '15:00:00'),
(111, 'Vendredi', '15:00:00', '15:30:00'),
(112, 'Vendredi', '15:30:00', '16:00:00'),
(113, 'Vendredi', '16:00:00', '16:30:00'),
(114, 'Vendredi', '16:30:00', '17:00:00'),
(115, 'Vendredi', '17:00:00', '17:30:00'),
(116, 'Vendredi', '17:30:00', '18:00:00'),
(117, 'Vendredi', '18:00:00', '18:30:00'),
(118, 'Vendredi', '18:30:00', '19:00:00'),
(119, 'Vendredi', '19:00:00', '19:30:00'),
(120, 'Vendredi', '19:30:00', '20:00:00'),
(121, 'Samedi', '08:00:00', '08:30:00'),
(122, 'Samedi', '08:30:00', '09:00:00'),
(123, 'Samedi', '09:00:00', '09:30:00'),
(124, 'Samedi', '09:30:00', '10:00:00'),
(125, 'Samedi', '10:00:00', '10:30:00'),
(126, 'Samedi', '10:30:00', '11:00:00'),
(127, 'Samedi', '11:00:00', '11:30:00'),
(128, 'Samedi', '11:30:00', '12:00:00'),
(129, 'Samedi', '12:00:00', '12:30:00'),
(130, 'Samedi', '12:30:00', '13:00:00'),
(131, 'Samedi', '13:00:00', '13:30:00'),
(132, 'Samedi', '13:30:00', '14:00:00'),
(133, 'Samedi', '14:00:00', '14:30:00'),
(134, 'Samedi', '14:30:00', '15:00:00'),
(135, 'Samedi', '15:00:00', '15:30:00'),
(136, 'Samedi', '15:30:00', '16:00:00'),
(137, 'Samedi', '16:00:00', '16:30:00'),
(138, 'Samedi', '16:30:00', '17:00:00'),
(139, 'Samedi', '17:00:00', '17:30:00'),
(140, 'Samedi', '17:30:00', '18:00:00'),
(141, 'Samedi', '18:00:00', '18:30:00'),
(142, 'Samedi', '18:30:00', '19:00:00'),
(143, 'Samedi', '19:00:00', '19:30:00'),
(144, 'Samedi', '19:30:00', '20:00:00');

-- --------------------------------------------------------

--
-- Structure de la table `disponibilites_coachs`
--

DROP TABLE IF EXISTS `disponibilites_coachs`;
CREATE TABLE IF NOT EXISTS `disponibilites_coachs` (
  `id_disponibilite` int NOT NULL AUTO_INCREMENT,
  `id_coach` int DEFAULT NULL,
  `id_creneau` int DEFAULT NULL,
  `disponible` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id_disponibilite`),
  KEY `id_coach` (`id_coach`),
  KEY `id_creneau` (`id_creneau`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `messages`
--

DROP TABLE IF EXISTS `messages`;
CREATE TABLE IF NOT EXISTS `messages` (
  `id_message` int NOT NULL AUTO_INCREMENT,
  `id_expediteur` int DEFAULT NULL,
  `id_destinataire` int DEFAULT NULL,
  `texte_message` text,
  `envoye_a` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_message`),
  KEY `id_expediteur` (`id_expediteur`),
  KEY `id_destinataire` (`id_destinataire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id_paiement` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `methode_paiement` enum('Visa','MasterCard','American Express','PayPal') DEFAULT NULL,
  `numero_carte` varchar(20) DEFAULT NULL,
  `nom_carte` varchar(100) DEFAULT NULL,
  `expiration_carte` date DEFAULT NULL,
  `code_securite_carte` varchar(4) DEFAULT NULL,
  `montant` decimal(10,2) DEFAULT NULL,
  `date_paiement` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_paiement`),
  KEY `id_client` (`id_client`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rendezvous`
--

DROP TABLE IF EXISTS `rendezvous`;
CREATE TABLE IF NOT EXISTS `rendezvous` (
  `id_rdv` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
  `id_coach` int DEFAULT NULL,
  `id_creneau` int DEFAULT NULL,
  `date_rdv` date DEFAULT NULL,
  `statut` enum('confirmé','annulé') DEFAULT NULL,
  `cree_a` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_rdv`),
  KEY `id_client` (`id_client`),
  KEY `id_coach` (`id_coach`),
  KEY `id_creneau` (`id_creneau`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `services`
--

DROP TABLE IF EXISTS `services`;
CREATE TABLE IF NOT EXISTS `services` (
  `id_service` int NOT NULL AUTO_INCREMENT,
  `categorie` enum('Activité','Sport compétitif','Salle de sport') DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id_service`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id_utilisateur` int NOT NULL AUTO_INCREMENT,
  `prenom` varchar(100) DEFAULT NULL,
  `nom` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mot_de_passe` varchar(255) DEFAULT NULL,
  `adresse_ligne1` varchar(255) DEFAULT NULL,
  `adresse_ligne2` varchar(255) DEFAULT NULL,
  `ville` varchar(100) DEFAULT NULL,
  `code_postal` varchar(20) DEFAULT NULL,
  `pays` varchar(100) DEFAULT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `carte_etudiant` varchar(9) DEFAULT NULL,
  `role_utilisateur` enum('admin','coach','client') DEFAULT NULL,
  `cree_a` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
