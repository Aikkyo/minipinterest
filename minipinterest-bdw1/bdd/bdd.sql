-- phpMyAdmin SQL Dump
-- version 4.9.1deb2
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le :  Dim 03 mai 2020 à 21:38
-- Version du serveur :  10.3.22-MariaDB-1:10.3.22+maria~bionic-log
-- Version de PHP :  7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `p1910892`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `cat_id` int(11) NOT NULL,
  `nomCat` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`cat_id`, `nomCat`) VALUES
(17, 'Pomme'),
(18, 'Elephant'),
(19, 'Chien'),
(20, 'Fusee');

-- --------------------------------------------------------

--
-- Structure de la table `photo`
--

CREATE TABLE `photo` (
  `photoID` int(11) NOT NULL,
  `nomFich` varchar(50) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `userID` int(11) DEFAULT NULL,
  `is_cacher` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `photo`
--

INSERT INTO `photo` (`photoID`, `nomFich`, `description`, `catID`, `userID`, `is_cacher`) VALUES
(60, 'd5a7953c873e72e6c0ea4d103a6e3b0e.jpg', 'Ma pomme prÃ©fÃ©rÃ©e', 17, 3, 0),
(61, '4f79fef65a5134d84d3ac8c53eb192c2.jpeg', 'Mon Ã©lÃ©phant prÃ©fÃ©rÃ©', 18, 3, 1),
(62, '1d4b50e97ebf6f85ed79f9781234ea37.jpg', 'Chien trop chou', 19, 3, 0),
(63, '6c869ac627f724a8e2829eed5ccec7be.jpg', 'Mon chien prÃ©fÃ©rÃ©', 19, 2, 0),
(64, 'c5eca4488d16b467647d6c35a45f6bf6.jpg', 'Ma fusÃ©e', 20, 1, 0),
(65, '820afc30ac7fd962b433aae50c0db1c5.jpg', 'Mon chien masquÃ©', 19, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE `utilisateur` (
  `utilisateurID` int(11) NOT NULL,
  `pseudo` varchar(50) DEFAULT NULL,
  `hash_mdp` varchar(50) DEFAULT NULL,
  `is_admin` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`utilisateurID`, `pseudo`, `hash_mdp`, `is_admin`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
(2, 'Paul', '25f9e794323b453885f5181f1b624d0b', 0),
(3, 'Remy', '1a1dc91c907325c69271ddf0c944bc72', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`cat_id`);

--
-- Index pour la table `photo`
--
ALTER TABLE `photo`
  ADD PRIMARY KEY (`photoID`),
  ADD KEY `Photo_categorie_cat_id_fk` (`catID`),
  ADD KEY `photo_utilisateur_utilisateurID_fk` (`userID`);

--
-- Index pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD PRIMARY KEY (`utilisateurID`),
  ADD UNIQUE KEY `utilisateur_pseudo_uindex` (`pseudo`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `cat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT pour la table `photo`
--
ALTER TABLE `photo`
  MODIFY `photoID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  MODIFY `utilisateurID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `photo`
--
ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_categorie_cat_id_fk` FOREIGN KEY (`catID`) REFERENCES `categorie` (`cat_id`),
  ADD CONSTRAINT `photo_utilisateur_utilisateurID_fk` FOREIGN KEY (`userID`) REFERENCES `utilisateur` (`utilisateurID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
