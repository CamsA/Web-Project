-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 24 avr. 2018 à 19:34
-- Version du serveur :  5.7.19
-- Version de PHP :  5.6.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `webproject`
--
DROP DATABASE IF EXISTS `webproject`;
CREATE DATABASE IF NOT EXISTS `webproject` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `webproject`;

-- --------------------------------------------------------

--
-- Structure de la table `article`
--

DROP TABLE IF EXISTS `article`;
CREATE TABLE IF NOT EXISTS `article` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Price` int(11) NOT NULL,
  `Id_Category` int(11) NOT NULL,
  `Pictures` varchar(1000) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `article`
--

INSERT INTO `article` (`Id`, `Name`, `Description`, `Price`, `Id_Category`, `Pictures`) VALUES
(5, 'yolo', '', 999, 1, '[\"98\"]'),
(6, 'Bomber', 'Joli', 50, 2, '[\"99\"]'),
(7, 'Ves', 'vv', 123, 2, '[\"100\"]'),
(8, 'Ves', 'vv', 123, 2, '[\"101\"]'),
(9, 'Ves', 'vv', 123, 2, '[\"102\"]'),
(10, 'f', 'f', 7, 1, '[\"103\"]'),
(11, 'gg', 'cxcx', 1, 2, '[\"104\"]'),
(12, 'sqqs', 'vb', 5, 1, '[\"105\"]'),
(13, 'Sweet-shirt', 'It\'s .', 120, 2, '[\"106\"]');

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `category`
--

INSERT INTO `category` (`Id`, `Name`) VALUES
(1, 'T-Shirt'),
(2, 'Veste');

-- --------------------------------------------------------

--
-- Structure de la table `event`
--

DROP TABLE IF EXISTS `event`;
CREATE TABLE IF NOT EXISTS `event` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) DEFAULT NULL,
  `Title` varchar(25) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Date_ev` date NOT NULL,
  `Price` int(11) NOT NULL,
  `Votes` varchar(1000) NOT NULL,
  `Pictures` varchar(1000) NOT NULL,
  `Valid` tinyint(1) DEFAULT '0',
  `Registered` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `event`
--

INSERT INTO `event` (`Id`, `Id_User`, `Title`, `Description`, `Date_ev`, `Price`, `Votes`, `Pictures`, `Valid`, `Registered`) VALUES
(56, 4, 'Cesiades', 'Chaque annÃ©e, tous les BDE des diffÃ©rents campus #CESI de France se rÃ©unissent Ã  l\'occasion des CESIADES !\r\n\r\nLes CESIADES c\'est quoi ? Trois jours festifs ðŸŽ‰ et sportifs ðŸ‹ï¸â€â™‚ï¸ avec des challenges, dÃ©fis et jeux inter campus ðŸ†\r\n\r\nTout le Campus CESI Saint-Nazaire souhaite bonne chance au Bde Cesi Saint-Nazaire ðŸ˜ƒ', '2018-05-16', 0, '[]', '[\"69\"]', 0, '[]'),
(57, 4, 'Portes ouvertes', '[#JPO] J-1 !!! Vous Ãªtes Ã  la recherche d\'une formation ? ðŸ¤”ðŸ’­\r\n\r\nâœ… Venez nous rencontrer le 24 mars lors de notre JournÃ©e Portes Ouvertes ! ðŸ˜€\r\n\r\nEcole d\'ingÃ©nieurs CESI : inscription ici âž¡ www.eicesi.fr/portes-ouvertes-samedi-24-mars-2018-cesi-saint-nazaire/\r\n\r\nSpÃ©cialitÃ© informatique de l\'Ã©cole d\'ingÃ©nieurs CESI : inscription ici âž¡ https://exia.cesi.fr/portes-ouvertes-ecole-ingenieurs-informatique-saint-nazaire-24-mars-2018/\r\n', '2018-05-24', 0, '[]', '[\"70\"]', 0, '[]'),
(58, 4, 'Mister Frizz', 'Ayez froid', '2018-04-28', 0, '[]', '[\"71\"]', 0, '[]'),
(65, 4, 'SoirÃ©e Disco', 'Ce soir, Boris est chez lui!\r\nIl a Ã©teint toutes les lumiÃ¨res\r\nIl a son p\'tit pantalon Ã  pattes d\'eph\' rouge, pompes\r\nblanches\r\nCe soir, attention, Boris danse!\r\nCe soir, chez Boris: Ã©vÃ©nement!\r\nC\'est SoirÃ©e disco!', '2018-04-28', 0, '[]', '[\"89\",\"90\",\"91\"]', 0, '[]');

-- --------------------------------------------------------

--
-- Structure de la table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Id_User` int(11) NOT NULL,
  `Id_Article` int(11) NOT NULL,
  `Quantity` int(11) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `pictures`
--

DROP TABLE IF EXISTS `pictures`;
CREATE TABLE IF NOT EXISTS `pictures` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Link` varchar(1000) NOT NULL,
  `Comments` varchar(1000) DEFAULT NULL,
  `Likes` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `pictures`
--

INSERT INTO `pictures` (`Id`, `Link`, `Comments`, `Likes`) VALUES
(69, '15241440070.png', NULL, NULL),
(70, '15241440970.jpg', NULL, NULL),
(71, '15241442570.jpg', NULL, NULL),
(72, '15242126660.jpg', NULL, NULL),
(73, '15242126661.jpg', NULL, NULL),
(74, '15242126662.jpg', NULL, NULL),
(75, '15242130590.jpg', NULL, NULL),
(76, '15242130591.jpg', NULL, NULL),
(77, '15242130592.jpg', NULL, NULL),
(78, '15242131640.jpg', NULL, NULL),
(79, '15242131641.jpg', NULL, NULL),
(80, '15242131642.jpg', NULL, NULL),
(81, '15242132580.jpg', NULL, NULL),
(82, '15242132581.jpg', NULL, NULL),
(83, '15242132592.jpg', NULL, NULL),
(84, '15242133470.jpg', NULL, NULL),
(85, '15242133471.jpg', NULL, NULL),
(86, '15242133472.jpg', NULL, NULL),
(87, '15242134000.png', NULL, NULL),
(88, '15242134001.jpg', NULL, NULL),
(89, '15242136410.jpg', NULL, NULL),
(90, '15242136411.jpg', NULL, NULL),
(91, '15242136412.jpg', NULL, NULL),
(92, '15242276150.', NULL, NULL),
(93, '15242276310.jpg', NULL, NULL),
(94, '15242280680.jpg', NULL, NULL),
(95, '15242281940.jpg', NULL, NULL),
(96, '15242283150.jpg', NULL, NULL),
(97, '15242287360.jpg', NULL, NULL),
(98, '15242288710.jpg', NULL, NULL),
(99, '15242290810.jpg', NULL, NULL),
(100, '15242292090.jpg', NULL, NULL),
(101, '15242292290.jpg', NULL, NULL),
(102, '15242292500.jpg', NULL, NULL),
(103, '15242292980.svg', NULL, NULL),
(104, '15242293950.jpg', NULL, NULL),
(105, '15242294560.jpg', NULL, NULL),
(106, '15242346750.jpg', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Surname` varchar(25) NOT NULL,
  `Firstname` varchar(25) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Pass` varchar(25) NOT NULL,
  `Role` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`Id`, `Surname`, `Firstname`, `Email`, `Pass`, `Role`) VALUES
(1, 'azerazer', 'azer', 'azer@gmail.com', 'areerz', 0),
(3, 'Guillotin', 'Kylian', 'Kylian56350@gmail.fr', 'azer', 0),
(4, 'oo', 'oo', 'ml@laposte.net', 'DD4', 1),
(5, 'Aubret', 'Camille', 'abrt.camille@gmail.com', 'Dd4', 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
