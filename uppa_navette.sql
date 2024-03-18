-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:8889
-- Généré le : lun. 18 mars 2024 à 09:24
-- Version du serveur : 5.7.39
-- Version de PHP : 7.4.33

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

-- --------------------------------------------------------

--
-- Structure de la table `date`
--

CREATE TABLE `date` (
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `date`
--

INSERT INTO `date` (`date`) VALUES
('2024-01-27'),
('2024-01-28'),
('2024-01-29'),
('2024-01-30'),
('2024-01-31'),
('2024-02-01'),
('2024-02-02'),
('2024-02-03'),
('2024-02-06'),
('2024-02-08'),
('2024-02-13'),
('2024-02-15'),
('2024-02-20'),
('2024-02-22'),
('2024-02-28'),
('2024-03-05'),
('2024-03-07'),
('2024-03-12'),
('2024-03-14'),
('2024-03-19'),
('2024-03-21'),
('2024-03-26');

-- --------------------------------------------------------

--
-- Structure de la table `horaire`
--

CREATE TABLE `horaire` (
  `id_horaire` int(11) NOT NULL,
  `hourStart` varchar(5) NOT NULL,
  `hourFinish` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `horaire`
--

INSERT INTO `horaire` (`id_horaire`, `hourStart`, `hourFinish`) VALUES
(1, '8h00', '9h30'),
(2, '10h00', '11h30'),
(3, '17h00', '18h30'),
(4, '19h00', '20h30');

-- --------------------------------------------------------

--
-- Structure de la table `reserver`
--

CREATE TABLE `reserver` (
  `id_trajet` int(11) NOT NULL,
  `id_utilisateur` int(11) NOT NULL,
  `id_start` int(11) NOT NULL,
  `id_finish` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `reserver`
--

INSERT INTO `reserver` (`id_trajet`, `id_utilisateur`, `id_start`, `id_finish`) VALUES
(3, 3, 1, 5),
(4, 12, 1, 6),
(11, 3, 1, 6),
(11, 12, 1, 6),
(12, 12, 6, 1);

-- --------------------------------------------------------

--
-- Structure de la table `station`
--

CREATE TABLE `station` (
  `id` int(11) NOT NULL,
  `ville` varchar(50) NOT NULL,
  `lieu` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `station`
--

INSERT INTO `station` (`id`, `ville`, `lieu`) VALUES
(1, 'Pau', 'Parking Cap Sud'),
(2, 'Lescar', 'Aire de covoiturage'),
(3, 'Orthez', 'Entrée / Sortie d\'autoroute'),
(4, 'IKEA - Bayonne', 'Aire de covoiturage'),
(5, 'Bayonne', 'Campus de la Nive'),
(6, 'Anglet', 'Montaury');

-- --------------------------------------------------------

--
-- Structure de la table `terminal`
--

CREATE TABLE `terminal` (
  `direction` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `terminal`
--

INSERT INTO `terminal` (`direction`) VALUES
('Pau'),
('Anglet');

-- --------------------------------------------------------

--
-- Structure de la table `trajets`
--

CREATE TABLE `trajets` (
  `id_trajet` int(11) NOT NULL,
  `id_date` int(11) NOT NULL,
  `id_horaire` int(11) NOT NULL,
  `direction` varchar(30) NOT NULL,
  `cancel` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `trajets`
--

INSERT INTO `trajets` (`id_trajet`, `id_date`, `id_horaire`, `direction`, `cancel`) VALUES
(3, 11, 1, '1', NULL),
(4, 13, 1, '1', NULL),
(5, 11, 3, '2', NULL),
(6, 14, 4, '1', NULL),
(7, 22, 1, '1', NULL),
(8, 13, 3, '2', NULL),
(9, 17, 1, '1', NULL),
(10, 14, 1, '1', NULL),
(11, 15, 1, '1', NULL),
(12, 15, 3, '2', NULL);

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
  ADD PRIMARY KEY (`date`);

--
-- Index pour la table `horaire`
--
ALTER TABLE `horaire`
  ADD PRIMARY KEY (`id_horaire`);

--
-- Index pour la table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`id_trajet`,`id_utilisateur`);

--
-- Index pour la table `station`
--
ALTER TABLE `station`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT pour la table `station`
--
ALTER TABLE `station`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

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
