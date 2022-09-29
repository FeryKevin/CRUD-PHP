-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Sam 09 Avril 2022 à 11:57
-- Version du serveur :  5.7.11
-- Version de PHP :  5.6.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `lyceestvincent`
--

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(2) NOT NULL,
  `libelle` varchar(10) NOT NULL,
  `nom_prof_principal` varchar(100) NOT NULL,
  `localisation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `classe`
--

INSERT INTO `classe` (`id`, `libelle`, `nom_prof_principal`, `localisation`) VALUES
(1, 'BTS 1', 'IDASIAK', 'SL 23'),
(2, 'BTS 2', 'AMMAR', 'SL 21'),
(3, 'TERMINAL 1', 'DUPONT', 'SL 02'),
(4, 'TERMINAL 2', 'DUPOUX', 'SL 03'),
(5, 'TERMINAL 3', 'HOUARAUX', 'SL 06'),
(6, 'TERMINAL 4', 'CHASSAGNE', 'SL 08');

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `fk_id_materiel` int(2) NOT NULL,
  `fk_id_classe` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `fk_id_materiel`, `fk_id_classe`) VALUES
(1, 'Test', 'Test', 1, 3),
(2, 'Test', 'Test', 2, 2),
(3, 'Test', 'Test', 3, 3),
(4, 'Test', 'Test', 4, 4),
(5, 'Test', 'Test', 5, 5),
(6, 'Test', 'Test', 6, 6);

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

CREATE TABLE `materiel` (
  `id` int(2) NOT NULL,
  `libelle` varchar(100) NOT NULL,
  `sn` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `materiel`
--

INSERT INTO `materiel` (`id`, `libelle`, `sn`) VALUES
(1, 'HP ELITEBOOK G230', 'FF1065YP5Y45126'),
(2, 'HP ELITEBOOK G231', 'DD1065YP5Y46127'),
(3, 'ASUS ROG GAMER', 'EE1065YP5Y50489'),
(4, 'LENOVO AYD500', 'YY1065YP5Y13478'),
(5, 'DELL LATITUDE D500', 'DG541DD236FDSDF'),
(6, 'DELL LATITUDE D600', 'QS789LY547CDXWQ');

--
-- Index pour les tables exportées
--

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_materiel` (`fk_id_materiel`),
  ADD KEY `fk_id_classe` (`fk_id_classe`);

--
-- Index pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `materiel`
--
ALTER TABLE `materiel`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD CONSTRAINT `affecter` FOREIGN KEY (`fk_id_classe`) REFERENCES `classe` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `utiliser` FOREIGN KEY (`fk_id_materiel`) REFERENCES `materiel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
