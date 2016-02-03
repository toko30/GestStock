-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 03 Février 2016 à 21:35
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `gestion`
--

-- --------------------------------------------------------

--
-- Structure de la table `appro`
--

CREATE TABLE IF NOT EXISTS `appro` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(3) NOT NULL,
  `date_commande` date NOT NULL,
  `type_produit` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `appro`
--

INSERT INTO `appro` (`id`, `id_fournisseur`, `date_commande`, `type_produit`) VALUES
(6, 6, '2015-12-16', 3),
(7, 6, '2015-12-16', 3),
(12, 5, '2016-01-12', 2),
(14, 6, '2016-01-13', 3),
(16, 6, '2016-01-14', 3),
(24, 1, '2016-01-18', 1),
(25, 2, '2016-01-18', 1),
(26, 5, '2016-01-18', 2);

-- --------------------------------------------------------

--
-- Structure de la table `appro_autre`
--

CREATE TABLE IF NOT EXISTS `appro_autre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_commande` int(10) NOT NULL,
  `id_autre` int(10) NOT NULL,
  `quantite` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `appro_composant`
--

CREATE TABLE IF NOT EXISTS `appro_composant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `appro_composant`
--

INSERT INTO `appro_composant` (`id`, `id_commande`, `id_produit`, `quantite`) VALUES
(9, 24, 2, 3000),
(10, 24, 3, 500),
(11, 25, 3, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `appro_identifiant`
--

CREATE TABLE IF NOT EXISTS `appro_identifiant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(10) NOT NULL,
  `id_identifiant` int(3) NOT NULL,
  `quantite` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `appro_identifiant`
--

INSERT INTO `appro_identifiant` (`id`, `id_commande`, `id_identifiant`, `quantite`) VALUES
(6, 12, 1, 1000),
(7, 26, 3, 2000),
(8, 26, 2, 1000);

-- --------------------------------------------------------

--
-- Structure de la table `appro_lecteur`
--

CREATE TABLE IF NOT EXISTS `appro_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_commande` int(10) NOT NULL,
  `id_lecteur` int(3) NOT NULL,
  `quantite` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `appro_lecteur`
--

INSERT INTO `appro_lecteur` (`id`, `id_commande`, `id_lecteur`, `quantite`) VALUES
(1, 6, 4, 20),
(2, 6, 3, 10),
(3, 7, 3, 5),
(4, 6, 4, 50),
(5, 14, 4, 10),
(6, 16, 3, 10),
(7, 16, 4, 50);

-- --------------------------------------------------------

--
-- Structure de la table `autre`
--

CREATE TABLE IF NOT EXISTS `autre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reference` varchar(150) NOT NULL,
  `designation` text NOT NULL,
  `id_fournisseur` int(10) NOT NULL,
  `quantite` int(10) NOT NULL,
  `type` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `autre`
--

INSERT INTO `autre` (`id`, `reference`, `designation`, `id_fournisseur`, `quantite`, `type`) VALUES
(1, 'AXB568KJL', 'Imprimante', 4, 30, 1),
(2, 'BDGFT58PL', 'Tablette tactile', 4, 20, 2),
(3, 'test', 'tesgrdqs', 4, 0, 2);

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `badge`
--

INSERT INTO `badge` (`id`, `id_type`, `quantite`) VALUES
(1, 1, 8700),
(2, 3, 10550),
(3, 2, 28100);

-- --------------------------------------------------------

--
-- Structure de la table `carte_test`
--

CREATE TABLE IF NOT EXISTS `carte_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(100) NOT NULL,
  `id_lot` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  `assemble` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Contenu de la table `carte_test`
--

INSERT INTO `carte_test` (`id`, `num_serie`, `id_lot`, `etat`, `assemble`) VALUES
(11, '12573242', 2, 1, 0),
(12, '70657348', 2, 1, 0),
(13, '25262451', 2, 1, 0),
(14, '31906127', 2, 1, 0),
(15, '17004394', 2, 1, 0),
(16, '34902954', 2, 1, 0),
(17, '84283447', 2, 1, 0),
(18, '96444702', 2, 1, 0),
(19, '57958984', 2, 1, 0),
(20, '80203247', 2, 1, 0),
(21, '78265380', 3, 1, 0),
(22, '71725463', 3, 1, 0),
(23, '69812011', 3, 1, 0),
(24, '53433227', 3, 1, 0),
(25, '16583251', 3, 1, 0),
(26, '02621459', 4, 1, 0),
(27, '68725585', 4, 1, 0),
(28, '41262817', 4, 1, 0),
(29, '71258544', 4, 1, 0),
(30, '95480346', 4, 1, 0),
(31, '96594238', 4, 1, 0),
(32, '60195922', 4, 1, 0),
(33, '91217041', 4, 1, 0),
(34, '02206420', 4, 1, 0),
(35, '35986328', 4, 1, 0),
(36, '77206420', 5, 1, 0),
(37, '10986328', 5, 1, 0),
(38, '10183715', 5, 1, 0),
(39, '96136474', 5, 1, 0),
(40, '69674682', 5, 1, 0),
(41, '96276855', 5, 1, 0),
(42, '88101196', 5, 1, 0),
(43, '45391845', 5, 1, 0),
(44, '69760131', 5, 1, 0),
(45, '11840820', 5, 1, 0),
(46, '56597900', 6, 1, 0),
(47, '53720092', 6, 1, 0),
(48, '75976562', 6, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE IF NOT EXISTS `client` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  `ref_compta` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `composant`
--

CREATE TABLE IF NOT EXISTS `composant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `info` text,
  `boitier` varchar(100) DEFAULT NULL,
  `stock_interne` int(11) NOT NULL,
  `stock_mini` int(11) NOT NULL,
  `id_famille` int(11) NOT NULL,
  `id_sous_famille` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `famille` (`id_famille`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Contenu de la table `composant`
--

INSERT INTO `composant` (`id`, `nom`, `info`, `boitier`, `stock_interne`, `stock_mini`, `id_famille`, `id_sous_famille`) VALUES
(1, 'Test 1', '', '0608', 1770, 1000, 1, 1),
(2, '10.2 kohm, 63 mW, ± 1%, 50 V', '', '0608', 2150, 10, 1, 2),
(3, 'Test 3', '', '1012', 2000, 5000, 2, 3),
(4, 'Test 4', '', '0406', 200, 100, 1, 1),
(5, 'Test 5', '', '0608', 1500, 2000, 1, 1),
(8, 'test 6', NULL, '1214', 100, 200, 3, 0),
(9, 'test 7', NULL, '1012', 2005, 100, 4, 0),
(10, 'test12', NULL, '', 0, 0, 1, 1),
(11, 'test 0', NULL, '', 0, 10, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composant_fournisseur`
--

CREATE TABLE IF NOT EXISTS `composant_fournisseur` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `reference` varchar(250) NOT NULL,
  `prix` float NOT NULL,
  `id_composant` int(10) NOT NULL,
  `id_fournisseur` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Contenu de la table `composant_fournisseur`
--

INSERT INTO `composant_fournisseur` (`id`, `reference`, `prix`, `id_composant`, `id_fournisseur`) VALUES
(1, 'AKFJIJNHIFF', 0.25, 1, 3),
(2, 'MC0063W0603110K2', 0.012, 2, 1),
(3, 'DFSGSDFGFDSGFDS', 0.002, 1, 2),
(4, 'HGJJFGZSTHRZH', 2.56, 3, 1),
(5, 'HSRJTEYKUYKIYUK', 0.0021, 3, 2),
(6, 'RYUKFHSRFHRTHRZS', 457, 5, 1),
(7, 'JTEYJTYJDFGHJDYTDJ', 0.1, 5, 3),
(13, 'FRGHHJJGFE', 1, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composant_nomenclature`
--

CREATE TABLE IF NOT EXISTS `composant_nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_composant` int(11) NOT NULL,
  `id_version` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `position` text NOT NULL,
  `option_st` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `composant_nomenclature`
--

INSERT INTO `composant_nomenclature` (`id`, `id_composant`, `id_version`, `quantite`, `position`, `option_st`) VALUES
(1, 1, 4, 5, 'U1,U2', 0),
(2, 3, 4, 10, 'D1,D2', 0),
(3, 5, 4, 2, 'A1,A2', 1),
(4, 2, 3, 3, 'A1,A2', 0),
(5, 3, 3, 5, 'D1,D2,D8,D9', 0),
(24, 2, 8, 5, 'U5', 0),
(25, 4, 8, 1, '0', 1),
(26, 5, 8, 2, '0', 0);

-- --------------------------------------------------------

--
-- Structure de la table `composant_sous_traitant`
--

CREATE TABLE IF NOT EXISTS `composant_sous_traitant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_sous_traitant` int(11) DEFAULT NULL,
  `id_composant` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `composant_sous_traitant`
--

INSERT INTO `composant_sous_traitant` (`id`, `id_sous_traitant`, `id_composant`, `quantite`) VALUES
(1, 2, 2, 310),
(2, 2, 3, 1550),
(3, 2, 5, 1190),
(4, 2, 4, 200),
(5, 2, 1, 513),
(6, 1, 2, 200),
(7, 1, 3, 200);

-- --------------------------------------------------------

--
-- Structure de la table `erreur_test`
--

CREATE TABLE IF NOT EXISTS `erreur_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(250) NOT NULL,
  `id_etape` int(11) NOT NULL,
  `reprise` int(11) NOT NULL,
  `date_test` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `etape`
--

CREATE TABLE IF NOT EXISTS `etape` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `famille`
--

CREATE TABLE IF NOT EXISTS `famille` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `famille`
--

INSERT INTO `famille` (`id`, `nom`) VALUES
(1, 'Composant'),
(2, 'PCB'),
(3, 'Boitier'),
(4, 'Accessoire');

-- --------------------------------------------------------

--
-- Structure de la table `firmware`
--

CREATE TABLE IF NOT EXISTS `firmware` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `commentaire` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `fournisseur`
--

CREATE TABLE IF NOT EXISTS `fournisseur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `email` varchar(250) NOT NULL,
  `numero` int(11) NOT NULL,
  `site` varchar(250) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `contact`, `email`, `numero`, `site`, `type`) VALUES
(1, 'FARNELL', 'test', '', 637179932, 'http://www.farnell.fr', 1),
(2, 'RS', '', '', 0, '', 1),
(3, 'WURTH', '', '', 0, '', 1),
(4, 'FOURNISSEUR 4', '', '', 0, '', 4),
(5, 'TW', '', '', 0, '', 2),
(6, 'CV', '', '', 0, '', 3);

-- --------------------------------------------------------

--
-- Structure de la table `histo_appro`
--

CREATE TABLE IF NOT EXISTS `histo_appro` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_fournisseur` int(11) NOT NULL,
  `id_produit` int(11) NOT NULL,
  `type_produit` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_appro` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `histo_prod`
--

CREATE TABLE IF NOT EXISTS `histo_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_version` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_prod` date NOT NULL,
  `lieu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `histo_vente_badge`
--

CREATE TABLE IF NOT EXISTS `histo_vente_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) NOT NULL,
  `id_type_badge` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL,
  `date_vente` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `histo_vente_lecteur`
--

CREATE TABLE IF NOT EXISTS `histo_vente_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_client` int(11) DEFAULT NULL,
  `num_serie` varchar(100) NOT NULL,
  `id_lecteur` int(10) NOT NULL,
  `date_prod` date NOT NULL,
  `date_vente` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lecteur`
--

CREATE TABLE IF NOT EXISTS `lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(100) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_prod` date NOT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `lecteur`
--

INSERT INTO `lecteur` (`id`, `num_serie`, `id_lecteur`, `date_prod`, `date_creation`) VALUES
(1, '123', 1, '0000-00-00', '2015-12-14'),
(2, '1324', 1, '0000-00-00', '2015-12-14'),
(3, '13245', 2, '0000-00-00', '2015-12-14'),
(4, '789', 2, '0000-00-00', '2015-12-14'),
(5, '78946', 1, '0000-00-00', '2015-12-14'),
(6, '45345', 1, '0000-00-00', '2015-12-02'),
(7, '453453', 2, '0000-00-00', '2015-12-09'),
(8, '5365643', 2, '0000-00-00', '2015-12-17'),
(9, '45634563', 2, '0000-00-00', '2015-12-01');

-- --------------------------------------------------------

--
-- Structure de la table `lecteur_autre`
--

CREATE TABLE IF NOT EXISTS `lecteur_autre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(100) NOT NULL,
  `id_lecteur_autre` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `liste_test`
--

CREATE TABLE IF NOT EXISTS `liste_test` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` text NOT NULL,
  `id_etape` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lot`
--

CREATE TABLE IF NOT EXISTS `lot` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(11) NOT NULL,
  `date_prod` date NOT NULL,
  `date_test` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `lot`
--

INSERT INTO `lot` (`id`, `id_nomenclature`, `date_prod`, `date_test`) VALUES
(2, 4, '2015-12-08', '2015-12-23'),
(3, 4, '2015-12-10', '2015-12-23'),
(4, 2, '2015-12-23', '2015-12-23'),
(5, 4, '2015-12-23', '2015-12-23'),
(6, 2, '2015-12-24', '2015-12-24');

-- --------------------------------------------------------

--
-- Structure de la table `nomenclature`
--

CREATE TABLE IF NOT EXISTS `nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `nomenclature`
--

INSERT INTO `nomenclature` (`id`, `nom`) VALUES
(1, '7201-U'),
(2, '7701-U'),
(3, 'tesdt'),
(4, 'test');

-- --------------------------------------------------------

--
-- Structure de la table `pret`
--

CREATE TABLE IF NOT EXISTS `pret` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(250) NOT NULL,
  `date_envoi` date NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `production`
--

CREATE TABLE IF NOT EXISTS `production` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_lieu` int(3) NOT NULL,
  `id_nomenclature` int(3) NOT NULL,
  `quantite` int(5) NOT NULL,
  `etape` int(1) NOT NULL,
  `date_prod` date NOT NULL,
  `composant_utilise` text,
  PRIMARY KEY (`id`),
  KEY `id_lieu` (`id_lieu`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=88 ;

--
-- Contenu de la table `production`
--

INSERT INTO `production` (`id`, `id_lieu`, `id_nomenclature`, `quantite`, `etape`, `date_prod`, `composant_utilise`) VALUES
(39, 0, 3, 10, 2, '2015-12-22', NULL),
(41, 0, 4, 20, 2, '2015-12-22', NULL),
(42, 0, 3, 100, 2, '2015-12-22', NULL),
(43, 0, 3, 67, 2, '2015-12-22', NULL),
(44, 0, 3, 33, 2, '2015-12-22', NULL),
(45, 1, 3, 10, 2, '2015-12-23', '2,3'),
(46, 1, 3, 10, 2, '2015-12-23', '2,3'),
(47, 0, 3, 10, 2, '2015-12-23', NULL),
(49, 0, 3, 118, 2, '2015-12-23', NULL),
(69, 0, 3, 10, 1, '2015-12-24', NULL),
(70, 0, 4, 95, 1, '2015-12-24', NULL),
(71, 0, 4, 5, 2, '2016-01-08', NULL),
(72, 0, 4, 10, 1, '2015-12-24', NULL),
(73, 0, 3, 10, 1, '2015-12-24', NULL),
(75, 0, 3, 100, 1, '2016-01-13', NULL),
(76, 0, 3, 100, 1, '2016-01-13', NULL),
(77, 0, 3, 100, 1, '2016-01-13', NULL),
(78, 0, 3, 500, 1, '2016-01-13', NULL),
(79, 0, 3, 500, 1, '2016-01-13', NULL),
(84, 1, 3, 20, 1, '2016-01-13', '2,3'),
(87, 2, 3, 100, 1, '2016-01-14', '2,3');

-- --------------------------------------------------------

--
-- Structure de la table `produit_fini_nomenclature`
--

CREATE TABLE IF NOT EXISTS `produit_fini_nomenclature` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_version` int(10) NOT NULL,
  `id_composant` int(10) NOT NULL,
  `quantite` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `produit_fini_nomenclature`
--

INSERT INTO `produit_fini_nomenclature` (`id`, `id_version`, `id_composant`, `quantite`) VALUES
(3, 8, 9, 1);

-- --------------------------------------------------------

--
-- Structure de la table `sav`
--

CREATE TABLE IF NOT EXISTS `sav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `num_serie` varchar(250) NOT NULL,
  `etape` int(11) DEFAULT NULL,
  `etat` int(11) NOT NULL,
  `date_reception` date NOT NULL,
  `date_renvoi` date NOT NULL,
  `commentaire` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `sous_famille`
--

CREATE TABLE IF NOT EXISTS `sous_famille` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `id_famille` int(3) NOT NULL,
  `nom` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sous_famille` (`id_famille`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `sous_famille`
--

INSERT INTO `sous_famille` (`id`, `id_famille`, `nom`) VALUES
(0, 0, ''),
(1, 1, 'Resistance'),
(2, 1, 'Capa'),
(3, 2, 'sous famille2'),
(4, 1, 'sous famille3'),
(6, 1, 'test'),
(7, 1, 'test3'),
(8, 3, 'test1');

-- --------------------------------------------------------

--
-- Structure de la table `sous_traitant`
--

CREATE TABLE IF NOT EXISTS `sous_traitant` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `sous_traitant`
--

INSERT INTO `sous_traitant` (`id`, `nom`) VALUES
(0, 'Idcapt'),
(1, 'SFEI'),
(2, 'sous-traitant 2');

-- --------------------------------------------------------

--
-- Structure de la table `sous_type_badge`
--

CREATE TABLE IF NOT EXISTS `sous_type_badge` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `sous_type_badge`
--

INSERT INTO `sous_type_badge` (`id`, `nom`) VALUES
(1, 'Badge PVC'),
(2, 'Badge clamshell'),
(3, 'Mini badge'),
(4, 'Tag Clear Disk'),
(5, 'Porte clés'),
(6, 'Etiquette'),
(7, 'Tag montre'),
(8, 'Bracelet jetable');

-- --------------------------------------------------------

--
-- Structure de la table `sous_type_lecteur`
--

CREATE TABLE IF NOT EXISTS `sous_type_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `sous_type_lecteur`
--

INSERT INTO `sous_type_lecteur` (`id`, `nom`) VALUES
(1, 'Lecteur de bureau'),
(2, 'Lecteur OEM'),
(3, 'Lecteur mobile'),
(4, 'Lecteur mural encastré'),
(5, 'Lecteur mural boitier'),
(6, 'Lecteur mural boitier large'),
(7, 'Terminal lecteur'),
(8, 'Lecteur longue distance');

-- --------------------------------------------------------

--
-- Structure de la table `test_nomenclature`
--

CREATE TABLE IF NOT EXISTS `test_nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(11) NOT NULL,
  `id_liste_test` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_autre`
--

CREATE TABLE IF NOT EXISTS `type_autre` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `type_autre`
--

INSERT INTO `type_autre` (`id`, `nom`) VALUES
(1, 'Imprimante'),
(2, 'Tablette');

-- --------------------------------------------------------

--
-- Structure de la table `type_badge`
--

CREATE TABLE IF NOT EXISTS `type_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `frequence` int(2) NOT NULL,
  `type` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_badge`
--

INSERT INTO `type_badge` (`id`, `reference`, `designation`, `frequence`, `type`, `id_fournisseur`) VALUES
(1, 'BG125001', 'Badge PVC blanc Chip 125 KHz EMxx', 2, 1, 5),
(2, 'BG125002', 'Badge PVC Format ISO Chip 125 KHz ATA55xx encodable', 2, 1, 5),
(3, 'BG1356001', 'Badge PVC format ISO 13,56MHz - ISO14443A - 1Ko', 1, 6, 5),
(4, 'BG1356003', 'Badge format ISO Mifare Ultralight - 13.56 MHz - ISO14443A', 1, 1, 5),
(5, 'BDGJ12005', 'test12', 2, 4, 5);

-- --------------------------------------------------------

--
-- Structure de la table `type_lecteur`
--

CREATE TABLE IF NOT EXISTS `type_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(10) NOT NULL,
  `designation` text NOT NULL,
  `frequence` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `petite` int(2) NOT NULL,
  `moyenne` int(2) NOT NULL,
  `grande` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `type_lecteur`
--

INSERT INTO `type_lecteur` (`id`, `id_nomenclature`, `designation`, `frequence`, `type`, `petite`, `moyenne`, `grande`) VALUES
(1, 1, 'Lecteur USB 13,56MHz	', 1, 1, 0, 0, 0),
(2, 2, 'Lecteur Autonome 13,56MHz avec Afficheur/Memoire/Horloge - Synchronisation par USB', 1, 2, 0, 0, 0),
(3, 3, 'test', 2, 4, 2, 1, 1),
(4, 4, 'test', 2, 8, 1, 2, 0),
(5, 1, 'dfhrthtedjhtjet', 2, 6, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_lecteur_autre`
--

CREATE TABLE IF NOT EXISTS `type_lecteur_autre` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(250) NOT NULL,
  `designation` text NOT NULL,
  `frequence` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `petite` int(2) NOT NULL,
  `moyenne` int(2) NOT NULL,
  `grande` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_lecteur_autre`
--

INSERT INTO `type_lecteur_autre` (`id`, `reference`, `designation`, `frequence`, `type`, `id_fournisseur`, `petite`, `moyenne`, `grande`) VALUES
(1, '3300AT-2', 'Module OEM 13,56MHz  Antenne Intégrée - ISO14443A - ISO15693', 1, 1, 6, 1, 0, 0),
(2, '5600-2-1F', 'Lecteur RS232 W26 C&D I/F, ISO14443A Mifare Secure Sector', 1, 3, 6, 0, 0, 0),
(3, 'test', 'tzsrgs', 2, 6, 6, 0, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE IF NOT EXISTS `type_produit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `type_produit`
--

INSERT INTO `type_produit` (`id`, `nom`) VALUES
(1, 'Matière première'),
(2, 'Identifiant'),
(3, 'Lecteur'),
(4, 'Autre');

-- --------------------------------------------------------

--
-- Structure de la table `version_nomenclature`
--

CREATE TABLE IF NOT EXISTS `version_nomenclature` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(10) NOT NULL,
  `version` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `version_nomenclature`
--

INSERT INTO `version_nomenclature` (`id`, `id_nomenclature`, `version`) VALUES
(1, 1, 3),
(2, 1, 2),
(3, 1, 4),
(4, 2, 2),
(5, 1, 1),
(6, 2, 1),
(7, 4, 1),
(8, 4, 2),
(9, 1, 5);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
