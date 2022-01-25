-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le :  mar. 25 jan. 2022 à 02:03
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `api-forfaits-voyages`
--

-- --------------------------------------------------------

--
-- Structure de la table `forfaits`
--

CREATE TABLE `forfaits` (
  `id` int(11) NOT NULL,
  `destination` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ville_depart` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_nom` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_coordonnees` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hotel_etoiles` int(1) NOT NULL,
  `hotel_chambres` int(1) NOT NULL,
  `hotel_caracteristiques` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date_depart` date NOT NULL,
  `date_retour` date NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `rabais` decimal(7,2) NOT NULL,
  `vedette` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `forfaits`
--

INSERT INTO `forfaits` (`id`, `destination`, `ville_depart`, `hotel_nom`, `hotel_coordonnees`, `hotel_etoiles`, `hotel_chambres`, `hotel_caracteristiques`, `date_depart`, `date_retour`, `prix`, `rabais`, `vedette`) VALUES
(1, 'Cayo Coco, Cuba', 'Montréal', 'Memories Flamenco Beach Resort', 'ici… les coordonnées de l\'hôtel', 4, 350, 'Plage de sable blanc;Miniclub avec personnages Toupie et Binou', '2021-12-06', '2021-12-13', '1725.00', '1070.00', 1),
(2, 'Varadero, Cuba', 'Montréal', 'Gran Memories Varadero', 'ici… les coordonnées de l\'hôtel', 3, 250, 'Bar cubain;Hôtel familial', '2021-12-12', '2021-12-19', '1615.00', '900.00', 0),
(3, 'Jamaïque', 'Montréal', 'Iberostar Grand Rose Hall', 'ici… les coordonnées de l\'hôtel', 5, 1025, 'Plat à la carte;Service de majordome;Entouré de montages et de la mer des Caraïbes', '2021-12-05', '2021-12-12', '2875.00', '670.00', 0),
(4, 'Riviera Maya, Mexique', 'Montréal', 'Ocean Riviera Paradise', 'ici… les coordonnées de l\'hôtel', 5, 850, 'Famille de 5 et plus;Complexe aquatique;Piscine pour enfants', '2021-12-06', '2021-12-13', '1705.00', '680.00', 1),
(5, 'Riviera Maya, Mexique', 'Québec', 'Grand Sirenis Riviera Maya Resort', 'ici… les coordonnées de l\'hôtel', 4, 420, 'Propriété moderne et luxueuse;Grande rivière', '2021-12-03', '2021-12-10', '1845.00', '500.00', 1),
(6, 'Panama', 'Québec', 'Bijao Beach Resort', 'ici… les coordonnées de l\'hôtel', 4, 1610, 'Glissades d\'eau;Hébergement Premium;Suite sur la plage', '2022-03-11', '2022-03-18', '1345.00', '220.00', 0);

-- --------------------------------------------------------

--
-- Structure de la table `meteo`
--

CREATE TABLE `meteo` (
  `id` int(11) NOT NULL,
  `jour` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_jour` date NOT NULL,
  `temp_jour` int(2) NOT NULL,
  `temp_nuit` int(2) NOT NULL,
  `description_meteo` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `meteo`
--

INSERT INTO `meteo` (`id`, `jour`, `date_jour`, `temp_jour`, `temp_nuit`, `description_meteo`) VALUES
(1, 'LUNDI', '2022-01-24', 22, 14, 'Ensoleillé avec passages nuageux'),
(2, 'MARDI', '2022-01-25', 28, 18, 'Ensoleillé avec passages nuageux'),
(3, 'MERCREDI', '2022-01-26', 29, 19, 'Quelques averses'),
(4, 'JEUDI', '2022-01-27', 26, 18, 'Risque d\'averses'),
(5, 'VENDREDI', '2022-01-28', 25, 17, 'Ciel variable'),
(6, 'SAMEDI', '2022-01-29', 22, 14, 'Risque d\'averses'),
(7, 'DIMANCHE', '2022-01-30', 22, 15, 'Ciel variable');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `forfaits`
--
ALTER TABLE `forfaits`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `meteo`
--
ALTER TABLE `meteo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `forfaits`
--
ALTER TABLE `forfaits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `meteo`
--
ALTER TABLE `meteo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
