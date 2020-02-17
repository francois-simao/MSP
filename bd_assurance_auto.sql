-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  lun. 17 fév. 2020 à 13:20
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `bd_assurance_auto`
--

-- --------------------------------------------------------

--
-- Structure de la table `t_accidents`
--

DROP TABLE IF EXISTS `t_accidents`;
CREATE TABLE IF NOT EXISTS `t_accidents` (
  `ID_ACCIDENT` int(11) NOT NULL AUTO_INCREMENT,
  `id_contrat` int(11) NOT NULL,
  `DATE_ACCIDENT` date NOT NULL,
  `LIEU` varchar(50) NOT NULL,
  `NATURE` varchar(50) NOT NULL COMMENT 'Nature accidents/situation',
  `DOMMAGE` varchar(100) NOT NULL COMMENT 'Dommages matériels et corporels',
  `TEMOINS` varchar(255) NOT NULL,
  `NOM_PERSONNE` varchar(50) NOT NULL COMMENT 'Nom de personnes impliqué',
  `COORDONNEES` varchar(50) NOT NULL COMMENT 'Coordonnées de l’assurance',
  `RESPONSABILITE` varchar(50) NOT NULL,
  `DATE_CONSTAT` date NOT NULL COMMENT 'Date envoi du constat',
  PRIMARY KEY (`ID_ACCIDENT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_accidents`
--

INSERT INTO `t_accidents` (`ID_ACCIDENT`, `id_contrat`, `DATE_ACCIDENT`, `LIEU`, `NATURE`, `DOMMAGE`, `TEMOINS`, `NOM_PERSONNE`, `COORDONNEES`, `RESPONSABILITE`, `DATE_CONSTAT`) VALUES
(1, 1, '2020-02-11', 'Lons le Saunier', 'aaa', 'aaaa', 'aaaa', 'aaaa', 'aaaaa', 'aaaa', '2020-02-11');

-- --------------------------------------------------------

--
-- Structure de la table `t_client`
--

DROP TABLE IF EXISTS `t_client`;
CREATE TABLE IF NOT EXISTS `t_client` (
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_CLIENT` varchar(50) NOT NULL,
  `PRENOM_CLIENT` varchar(50) NOT NULL,
  `ADRESSE_CLIENT` varchar(100) NOT NULL,
  `TEL_CLIENT` varchar(13) NOT NULL,
  `MAIL_CLIENT` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_client`
--

INSERT INTO `t_client` (`ID_CLIENT`, `NOM_CLIENT`, `PRENOM_CLIENT`, `ADRESSE_CLIENT`, `TEL_CLIENT`, `MAIL_CLIENT`) VALUES
(1, 'fffff', 'ffffffff', 'fffffff', '5555555555', 'fffff@fffff'),
(2, 'gggggg', 'gggggggg', 'ggggg', '6666666666', 'ggggg@ggggg'),
(3, 'hhhh', 'hhhhhh', 'hhhhhhh', '7777777777', 'hhhhhh@hhhhh');

-- --------------------------------------------------------

--
-- Structure de la table `t_contrat`
--

DROP TABLE IF EXISTS `t_contrat`;
CREATE TABLE IF NOT EXISTS `t_contrat` (
  `ID_CONTRAT` int(11) NOT NULL AUTO_INCREMENT,
  `CAT_PRO` varchar(100) NOT NULL COMMENT 'Catégories professionnelles',
  `TRAJETS` varchar(50) NOT NULL COMMENT 'Trajets privé ou travail',
  `ADRESSE_TRAVAIL` varchar(50) NOT NULL COMMENT 'Adresse de travail',
  `KM_ANS` varchar(50) NOT NULL COMMENT 'Moyenne de km par an',
  `TEMPS_VOITURE` varchar(50) NOT NULL COMMENT 'Combien de temps avez-vous gardez votre derniere voiture',
  `TITULAIRE` varchar(50) NOT NULL COMMENT 'Titulaire de la carte grise',
  `CONDUCTEUR_SEC` varchar(50) NOT NULL COMMENT 'Ajouter un conducteur secondaire',
  `VEHIC_ENREGISTRER` varchar(50) NOT NULL COMMENT 'Véhicule enregistrées',
  `IMMATRICULATION` varchar(50) NOT NULL COMMENT 'immatriculation',
  `PERMIS` date NOT NULL COMMENT 'Date d’obtention du permis',
  `TYPE_PERMIS` varchar(50) NOT NULL COMMENT 'Type de permis',
  `PERMIS_SUSPENDU` varchar(50) NOT NULL COMMENT 'Permis déjà été suspendu ou retiré',
  `TYPE_CONTRAT` varchar(50) NOT NULL COMMENT 'Type de contrat',
  `DATE_ENREGISTREMENT` date NOT NULL COMMENT 'Date enregistrement',
  `DATE_FIN` date NOT NULL COMMENT 'Date de fin de contrat',
  `BONUS_MALUS` varchar(50) NOT NULL COMMENT 'Bonus malus',
  `id_client` int(11) NOT NULL,
  PRIMARY KEY (`ID_CONTRAT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_contrat`
--

INSERT INTO `t_contrat` (`ID_CONTRAT`, `CAT_PRO`, `TRAJETS`, `ADRESSE_TRAVAIL`, `KM_ANS`, `TEMPS_VOITURE`, `TITULAIRE`, `CONDUCTEUR_SEC`, `VEHIC_ENREGISTRER`, `IMMATRICULATION`, `PERMIS`, `TYPE_PERMIS`, `PERMIS_SUSPENDU`, `TYPE_CONTRAT`, `DATE_ENREGISTREMENT`, `DATE_FIN`, `BONUS_MALUS`, `id_client`) VALUES
(1, '1', 'pro', 'aaaa', '100', '100', 'aaaa', 'aaa', 'aaaaa', 'dr-54-gg', '2019-08-05', 'zzz', 'non', 'eeee', '2020-02-10', '2020-02-26', '0.68', 1);

-- --------------------------------------------------------

--
-- Structure de la table `t_expert`
--

DROP TABLE IF EXISTS `t_expert`;
CREATE TABLE IF NOT EXISTS `t_expert` (
  `ID_EXPERT` int(11) NOT NULL AUTO_INCREMENT,
  `NOM_EXPERT` varchar(50) NOT NULL,
  `PRENOM_EXPERT` varchar(50) NOT NULL,
  `ADRESSE` varchar(100) NOT NULL,
  `TEL_EXPERT` varchar(13) NOT NULL,
  `MAIL_EXPERT` varchar(50) NOT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_EXPERT`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_expert`
--

INSERT INTO `t_expert` (`ID_EXPERT`, `NOM_EXPERT`, `PRENOM_EXPERT`, `ADRESSE`, `TEL_EXPERT`, `MAIL_EXPERT`, `id_intervention`) VALUES
(1, 'aaaaa', 'aaaaaa', 'aaaaaaa', '1111111111', 'aaaaaa@aaaaa', NULL),
(2, 'bbbbbbb', 'bbbbbbbb', 'bbbbbbb', '222222222', 'bbbbb@bbbbb', NULL),
(3, 'ccccccc', 'cccccccc', 'ccccccc', '3333333333', 'cccccc@ccccc', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `t_intervention`
--

DROP TABLE IF EXISTS `t_intervention`;
CREATE TABLE IF NOT EXISTS `t_intervention` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `id_accident` int(11) NOT NULL,
  `id_expert` int(11) NOT NULL,
  `DATE_EXPERTISE` date NOT NULL,
  `RAPPORT_EXPERTISE` varchar(255) NOT NULL,
  `EVAL_INDEMNISATION` varchar(100) NOT NULL COMMENT 'evaluation d’indemnisation',
  `FRANCHISE` varchar(100) NOT NULL,
  `INDEMNISATION` varchar(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_intervention`
--

INSERT INTO `t_intervention` (`ID`, `id_accident`, `id_expert`, `DATE_EXPERTISE`, `RAPPORT_EXPERTISE`, `EVAL_INDEMNISATION`, `FRANCHISE`, `INDEMNISATION`) VALUES
(1, 1, 1, '2020-02-19', 'fgbfbhgfhdhrdhh', 'grggeg', '320', '3617');

-- --------------------------------------------------------

--
-- Structure de la table `t_login`
--

DROP TABLE IF EXISTS `t_login`;
CREATE TABLE IF NOT EXISTS `t_login` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `USERNAME` varchar(50) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `t_login`
--

INSERT INTO `t_login` (`ID`, `USERNAME`, `PASSWORD`) VALUES
(1, 'pomme1', '968132e03403f7d01250f8ca30f16cf9');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
