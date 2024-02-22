-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : mar. 20 fév. 2024 à 10:13
-- Version du serveur :  5.7.32
-- Version de PHP : 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `uppa_navette`
--
CREATE DATABASE IF NOT EXISTS `uppa_navette` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `uppa_navette`;

-- --------------------------------------------------------

--
-- Structure de la table `date`
--

CREATE TABLE `date` (
  `id_date` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `date`
--

INSERT INTO `date` (`id_date`, `date`) VALUES
(1, '2024-01-28'),
(2, '2024-01-29'),
(3, '2024-01-27'),
(4, '2024-01-30'),
(5, '2024-01-31'),
(6, '2024-02-01'),
(7, '2024-02-02'),
(8, '2024-02-03'),
(9, '2024-02-06'),
(10, '2024-02-08'),
(11, '2024-02-13'),
(12, '2024-02-15'),
(13, '2024-02-20'),
(14, '2024-02-22'),
(15, '2024-03-05'),
(16, '2024-03-07'),
(17, '2024-03-12'),
(18, '2024-03-14'),
(19, '2024-03-19'),
(20, '2024-03-21'),
(21, '2024-03-26'),
(22, '2024-02-28');

-- --------------------------------------------------------

--
-- Structure de la table `directions`
--

CREATE TABLE `directions` (
  `id_direction` int(11) NOT NULL,
  `label` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `directions`
--

INSERT INTO `directions` (`id_direction`, `label`) VALUES
(1, 'P -> A'),
(2, 'A -> P');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id_horaire` int(11) NOT NULL,
  `heureDepart` varchar(5) NOT NULL,
  `heureArrivee` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id_horaire`, `heureDepart`, `heureArrivee`) VALUES
(1, '8h00', '9h30'),
(2, '10h00', '11h30'),
(3, '17h00', '18h30'),
(4, '19h00', '20h30');

-- --------------------------------------------------------

--
-- Structure de la table `lieux`
--

CREATE TABLE `lieux` (
  `id_lieu` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `lieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `lieux`
--

INSERT INTO `lieux` (`id_lieu`, `ville`, `lieu`) VALUES
(1, 'Pau', 'Parking Cap Sud'),
(2, 'Lescar', 'Aire de covoiturage'),
(3, 'Orthez', 'Entrée / Sortie d\'autoroute'),
(4, 'IKEA - Bayonne', 'Aire de covoiturage'),
(5, 'Bayonne', 'Campus de la Nive'),
(6, 'Anglet', 'Montaury');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `id_trajet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_lieuDepart` int(11) NOT NULL,
  `id_lieuArrivee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`id_trajet`, `id_utilisateur`, `id_lieuDepart`, `id_lieuArrivee`) VALUES
(3, 3, 1, 5),
(4, 12, 1, 6),
(11, 3, 1, 6),
(11, 12, 1, 6),
(12, 12, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE `trajets` (
  `id_trajet` int(11) NOT NULL,
  `id_date` int(11) NOT NULL,
  `id_horaire` int(11) NOT NULL,
  `id_direction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trajets`
--

INSERT INTO `trajets` (`id_trajet`, `id_date`, `id_horaire`, `id_direction`) VALUES
(3, 11, 1, 1),
(4, 13, 1, 1),
(5, 11, 3, 2),
(6, 14, 4, 1),
(7, 22, 1, 1),
(8, 13, 3, 2),
(9, 17, 1, 1),
(10, 14, 1, 1),
(11, 15, 1, 1),
(12, 15, 3, 2);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_utilisateur` int(11) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `prenom` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(30) NOT NULL,
  `password` varchar(500) NOT NULL,
  `type` varchar(50) NOT NULL,
  `residence_administrative` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_utilisateur`, `nom`, `prenom`, `email`, `phone`, `password`, `type`, `residence_administrative`) VALUES
(1, 'Peyre', 'Arthur', 'arth.peyre@gmail.com', '0625503382', '$2y$10$cv3QNJyLqcp4QypshBD2meZENrxlmPbbzISodlGUpvQRjBWF/ZTYy', '', ''),
(3, 'Monlucq', 'Sylvie', 'smonlucq@univ-pau.fr', '0600100220', '$2y$10$9hyqW.5DhRfj1KnJXAUyy.hHBrDixJWUKbnfFvth400xHsqkbd2bC', '', ''),
(5, 'Thierry', 'Pigot', 'tp@univ-pau.fr', '0611223344', '$2y$10$KyLELOqu/VAxH9lYFq8WOuJiotjXc3krfp17L/H1f22MwPi42vJAS', '', ''),
(12, 'Mundubeltz', 'Armelle', 'armelle.mundubeltz@univ-pau.fr', '0640070077', '$2y$10$Zks4V0jWYVjwwFRY7.5LaeBa3bpFYQxc8PXH4qT9dhcLjkBtbHWS2', '', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `date`
--
ALTER TABLE `date`
  ADD PRIMARY KEY (`id_date`);

--
-- Index pour la table `directions`
--
ALTER TABLE `directions`
  ADD PRIMARY KEY (`id_direction`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id_horaire`);

--
-- Index pour la table `lieux`
--
ALTER TABLE `lieux`
  ADD PRIMARY KEY (`id_lieu`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`id_trajet`,`id_utilisateur`);

--
-- Index pour la table `trajets`
--
ALTER TABLE `trajets`
  ADD PRIMARY KEY (`id_trajet`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_utilisateur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `date`
--
ALTER TABLE `date`
  MODIFY `id_date` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT pour la table `directions`
--
ALTER TABLE `directions`
  MODIFY `id_direction` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `lieux`
--
ALTER TABLE `lieux`
  MODIFY `id_lieu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `trajets`
--
ALTER TABLE `trajets`
  MODIFY `id_trajet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_utilisateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
