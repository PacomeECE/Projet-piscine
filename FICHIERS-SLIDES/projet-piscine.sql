-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 30 mai 2024 à 16:16
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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `coachs`
--

INSERT INTO `coachs` (`id_coach`, `id_utilisateur`, `specialite`, `photo_url`, `video_url`, `cv`) VALUES
(1, 1, 'Fitness', 'coach1.jpg', 'https://youtu.be/EKR3kZg6wck?si=LLk9X3yrei0id2VM', '<Coach>\r\n    <ID>1</ID>\r\n    <Nom>Fit</Nom>\r\n    <Prenom>Guy</Prenom>\r\n    <Specialite>Fitness</Specialite>\r\n    <Photo>coach1.jpg</Photo>\r\n    <Video>https://youtu.be/EKR3kZg6wck?si=LLk9X3yrei0id2VM</Video>\r\n    <Telephone>07 46 91 73 22</Telephone>\r\n    <Email>guy.fit@edu.ece.fr</Email>\r\n    <CV>Formation: Licence STAPS. Expériences: Coach personnel depuis 5 ans. Autres: Spécialisé en nutrition sportive.</CV>\r\n</Coach>'),
(2, 2, 'Cardio-Training', 'coach2.jpeg', 'https://youtu.be/cJhMDf1UzD8?si=vNgclgB0CdG7pfzw', '<Coach>\r\n    <ID>2</ID>\r\n    <Nom>Detente</Nom>\r\n    <Prenom>Maxine</Prenom>\r\n    <Specialite>Cardio-Training</Specialite>\r\n    <Photo>coach2.jpeg</Photo>\r\n    <Video>https://youtu.be/cJhMDf1UzD8?si=vNgclgB0CdG7pfzw</Video>\r\n    <Telephone>07 46 91 73 23</Telephone>\r\n    <Email>maxine.detente@edu.ece.fr</Email>\r\n    <CV>Formation: Diplôme de professeur de yoga sportif. Expériences: Enseigne le Cardio-Training depuis 8 ans. Autres: Expert en méditation et relaxation.</CV>\r\n</Coach>'),
(3, 3, 'Biking', 'coach3.jpg', 'None', '<Coach>\r\n    <ID>3</ID>\r\n    <Nom>Saroule</Nom>\r\n    <Prenom>Sylvain</Prenom>\r\n    <Specialite>Biking</Specialite>\r\n    <Photo>coach3.jpg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 24</Telephone>\r\n    <Email>sylvain.saroule@edu.ece.fr</Email>\r\n    <CV>Formation: Champion national de vélo d\'interieur. Expériences: Entraîneur de Biking depuis 10 ans. Autres: Spécialisé en préparation physique.</CV>\r\n</Coach>'),
(4, 4, 'Cours Collectifs', 'coach4.jpg', 'None', '<Coach>\r\n    <ID>4</ID>\r\n    <Nom>Baha</Nom>\r\n    <Prenom>Angela</Prenom>\r\n    <Specialite>Cours Collectifs</Specialite>\r\n    <Photo>coach4.jpg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 25</Telephone>\r\n    <Email>angela.baha@edu.ece.fr</Email>\r\n    <CV>Formation: Instructrice certifiée Pilates. Expériences: Enseigne le Pilates depuis 7 ans. Autres: Spécialisée en rééducation posturale.</CV>\r\n</Coach>'),
(5, 5, 'Musculation', 'coach5.jpeg', 'https://youtu.be/45l6bl8Uyr4?si=bqgYPtALl3NsEV3h', '<Coach>\r\n    <ID>5</ID>\r\n    <Nom>Matrixé</Nom>\r\n    <Prenom>Ilies</Prenom>\r\n    <Specialite>Musculation</Specialite>\r\n    <Photo>coach5.jpeg</Photo>\r\n    <Video>https://youtu.be/45l6bl8Uyr4?si=bqgYPtALl3NsEV3h</Video>\r\n    <Telephone>07 46 91 73 26</Telephone>\r\n    <Email>ilies.matrixe@edu.ece.fr</Email>\r\n    <CV>Formation: Diplôme en sciences du sport. Expériences: Entraîneur personnel depuis 12 ans. Autres: Spécialisé en hypertrophie musculaire.</CV>\r\n</Coach>'),
(6, 6, 'Basketball', 'coach6.jpeg', 'https://youtu.be/3bxihqPKF08?si=7gbvOv2naC0KVgOA', '<Coach>\r\n    <ID>6</ID>\r\n    <Nom>Possible</Nom>\r\n    <Prenom>Kim</Prenom>\r\n    <Specialite>Basketball</Specialite>\r\n    <Photo>coach6.jpeg</Photo>\r\n    <Video>https://youtu.be/3bxihqPKF08?si=7gbvOv2naC0KVgOA</Video>\r\n    <Telephone>07 46 91 73 27</Telephone>\r\n    <Email>kim.possible@edu.ece.fr</Email>\r\n    <CV>Formation: Diplôme en éducation physique. Expériences: Entraîneur de basketball depuis 10 ans. Autres: Spécialisée en stratégie de jeu.</CV>\r\n</Coach>'),
(7, 7, 'Football', 'coach7.jpeg', 'None', '<Coach>\r\n    <ID>7</ID>\r\n    <Nom>Legrand</Nom>\r\n    <Prenom>Zizou</Prenom>\r\n    <Specialite>Football</Specialite>\r\n    <Photo>coach7.jpeg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 28</Telephone>\r\n    <Email>zizou.legrand@edu.ece.fr</Email>\r\n    <CV>Formation: Licence en sciences du sport. Expériences: Entraîneur de football depuis 8 ans. Autres: Spécialisé en technique de jeu et fitness.</CV>\r\n</Coach>'),
(8, 8, 'Rugby', 'coach8.jpg', 'None', '<Coach>\r\n    <ID>8</ID>\r\n    <Nom>Unfrigo</Nom>\r\n    <Prenom>Come</Prenom>\r\n    <Specialite>Rugby</Specialite>\r\n    <Photo>coach8.jpg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 29</Telephone>\r\n    <Email>come.unfrigo@edu.ece.fr</Email>\r\n    <CV>Formation: Champion national de rugby. Expériences: Entraîneur de rugby depuis 12 ans. Autres: Spécialisé en préparation physique.</CV>\r\n</Coach>'),
(9, 9, 'Tennis', 'coach9.jpeg', 'None', '<Coach>\r\n    <ID>9</ID>\r\n    <Nom>Iguess</Nom>\r\n    <Prenom>Nina</Prenom>\r\n    <Specialite>Tennis</Specialite>\r\n    <Photo>coach9.jpeg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 30</Telephone>\r\n    <Email>nina.iguess@edu.ece.fr</Email>\r\n    <CV>Formation: Diplômée en tennis de compétition. Expériences: Entraîneur de tennis depuis 7 ans. Autres: Spécialisée en technique de jeu et stratégie.</CV>\r\n</Coach>'),
(10, 10, 'Natation', 'coach10.jpeg', 'None', '<Coach>\r\n    <ID>10</ID>\r\n    <Nom>Laptitesirene</Nom>\r\n    <Prenom>Ariel</Prenom>\r\n    <Specialite>Natation</Specialite>\r\n    <Photo>coach10.jpeg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 31</Telephone>\r\n    <Email>ariel.laptitesirene@edu.ece.fr</Email>\r\n    <CV>Formation: Diplômée en natation sportive. Expériences: Entraîneur de natation depuis 5 ans. Autres: Spécialisée en endurance et technique de nage.</CV>\r\n</Coach>'),
(11, 11, 'Plongeon', 'coach11.jpeg', 'None', '<Coach>\r\n    <ID>11</ID>\r\n    <Nom>Latetenba</Nom>\r\n    <Prenom>Nicolas</Prenom>\r\n    <Specialite>Plongeon</Specialite>\r\n    <Photo>coach11.jpeg</Photo>\r\n    <Video>None</Video>\r\n    <Telephone>07 46 91 73 32</Telephone>\r\n    <Email>nicolas.latetenba@edu.ece.fr</Email>\r\n    <CV>Formation: Champion national de plongeon. Expériences: Entraîneur de plongeon depuis 6 ans. Autres: Spécialisé en technique et acrobatie.</CV>\r\n</Coach>');

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
-- Structure de la table `paiements`
--

DROP TABLE IF EXISTS `paiements`;
CREATE TABLE IF NOT EXISTS `paiements` (
  `id_paiement` int NOT NULL AUTO_INCREMENT,
  `id_client` int DEFAULT NULL,
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
  `numero_carte` varchar(16) DEFAULT NULL,
  `nom_proprietaire` varchar(100) DEFAULT NULL,
  `date_expiration` varchar(5) DEFAULT NULL,
  `cvv` varchar(4) DEFAULT NULL,
  `type_carte` enum('Visa','MasterCard','American Express','PayPal') DEFAULT NULL,
  PRIMARY KEY (`id_utilisateur`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `prenom`, `nom`, `email`, `mot_de_passe`, `adresse_ligne1`, `adresse_ligne2`, `ville`, `code_postal`, `pays`, `telephone`, `carte_etudiant`, `role_utilisateur`, `cree_a`, `numero_carte`, `nom_proprietaire`, `date_expiration`, `cvv`, `type_carte`) VALUES
(1, 'Guy', 'Fit', 'guy.fit@edu.ece.fr', 'password1', '123 Fitness St.', 'Apt 1', 'Paris', '75001', 'France', '07 46 91 73 22', '123456789', 'coach', '2024-05-30 11:45:05', '1234567890123456', 'Guy Fit', '12/25', '123', 'Visa'),
(2, 'Maxine', 'Detente', 'maxine.detente@edu.ece.fr', 'password2', '456 Cardio Blvd.', 'Suite 2', 'Lyon', '69001', 'France', '07 46 91 73 23', '987654321', 'coach', '2024-05-30 11:45:05', '2345678901234567', 'Maxine Detente', '11/24', '456', 'MasterCard'),
(3, 'Sylvain', 'Saroule', 'sylvain.saroule@edu.ece.fr', 'password3', '789 Biking Way', '', 'Marseille', '13001', 'France', '07 46 91 73 24', '192837465', 'coach', '2024-05-30 11:45:05', '3456789012345678', 'Sylvain Saroule', '10/23', '789', 'American Express'),
(4, 'Angela', 'Baha', 'angela.baha@edu.ece.fr', 'password4', '321 Collective Rd.', 'Floor 4', 'Toulouse', '31000', 'France', '07 46 91 73 25', '564738291', 'coach', '2024-05-30 11:45:05', '4567890123456789', 'Angela Baha', '09/22', '012', 'PayPal'),
(5, 'Ilies', 'Matrixé', 'ilies.matrixe@edu.ece.fr', 'password5', '654 Muscle Ave.', 'Apt 5', 'Nice', '06000', 'France', '07 46 91 73 26', '918273645', 'coach', '2024-05-30 11:45:05', '5678901234567890', 'Ilies Matrixé', '08/21', '345', 'Visa'),
(6, 'Kim', 'Possible', 'kim.possible@edu.ece.fr', 'password6', '987 Basket St.', '', 'Bordeaux', '33000', 'France', '07 46 91 73 27', '837465192', 'coach', '2024-05-30 11:45:05', '6789012345678901', 'Kim Possible', '07/20', '678', 'MasterCard'),
(7, 'Zizou', 'Legrand', 'zizou.legrand@edu.ece.fr', 'password7', '159 Football Dr.', '', 'Lille', '59000', 'France', '07 46 91 73 28', '647382910', 'coach', '2024-05-30 11:45:05', '7890123456789012', 'Zizou Legrand', '06/19', '901', 'American Express'),
(8, 'Come', 'Unfrigo', 'come.unfrigo@edu.ece.fr', 'password8', '753 Rugby Cir.', '', 'Strasbourg', '67000', 'France', '07 46 91 73 29', '564738291', 'coach', '2024-05-30 11:45:05', '8901234567890123', 'Come Unfrigo', '05/18', '234', 'PayPal'),
(9, 'Nina', 'Iguess', 'nina.iguess@edu.ece.fr', 'password9', '951 Tennis Ln.', '', 'Montpellier', '34000', 'France', '07 46 91 73 30', '182736495', 'coach', '2024-05-30 11:45:05', '9012345678901234', 'Nina Iguess', '04/17', '567', 'Visa'),
(10, 'Ariel', 'Laptitesirene', 'ariel.laptitesirene@edu.ece.fr', 'password10', '357 Swim Dr.', '', 'Rennes', '35000', 'France', '07 46 91 73 31', '293847561', 'coach', '2024-05-30 11:45:05', '0123456789012345', 'Ariel Laptitesirene', '03/16', '890', 'MasterCard'),
(11, 'Nicolas', 'Latetenba', 'nicolas.latetenba@edu.ece.fr', 'password11', '468 Dive Blvd.', '', 'Reims', '51100', 'France', '07 46 91 73 32', '748392615', 'coach', '2024-05-30 11:45:05', '1234567890123456', 'Nicolas Latetenba', '02/15', '123', 'American Express'),
(12, 'Lola', 'Legall', 'lola.legall@edu.ece.fr', 'martin', '1 Admin St.', 'Apt 101', 'Paris', '75001', 'France', '06 12 34 56 78', '123456780', 'admin', '2024-05-30 15:06:16', '1111222233334444', 'Lola Legall', '12/26', '123', 'Visa'),
(13, 'Pacôme', 'Golvet', 'pacome.golvet@edu.ece.fr', 'Rohr', '2 Admin Blvd.', '', 'Epalles', '03251', 'France', '06 87 65 43 21', '123456781', 'admin', '2024-05-30 15:06:16', '5555666677778888', 'Pacôme Golvet', '11/25', '456', 'MasterCard'),
(14, 'Amandine', 'Soyez', 'amandine.soyez@edu.ece.fr', 'Rohr', '3 Admin Ave.', 'Suite 300', 'Fayot', '03250', 'France', '06 98 76 54 32', '123456782', 'admin', '2024-05-30 15:06:16', '9999000011112222', 'Amandine Soyez', '10/24', '789', 'American Express'),
(16, 'Amandine', 'Soyez', 'amandine27478@gmail.com', 'Moulin', '25 Bis rue de l\'Armorique', 'Appartement 4', 'PARIS 15', '75015', 'France', '0631779407', '123456789', 'client', '2024-05-30 16:11:50', '1234567890123456', 'Amandine Soyez', '12/14', '123', 'American Express');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
