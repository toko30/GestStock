-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 10 Décembre 2015 à 17:09
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
  `lieu` int(11) NOT NULL,
  `etat` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `appro_composant`
--

INSERT INTO `appro_composant` (`id`, `id_commande`, `id_produit`, `quantite`, `lieu`, `etat`) VALUES
(1, 1, 1, 50, 0, 1),
(2, 1, 2, 1000, 0, 1);

-- --------------------------------------------------------

--
-- Structure de la table `badge`
--

CREATE TABLE IF NOT EXISTS `badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantite` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `info` text NOT NULL,
  `boitier` varchar(100) DEFAULT NULL,
  `stock_interne` int(11) NOT NULL,
  `stock_mini` int(11) NOT NULL,
  `id_famille` int(11) NOT NULL,
  `id_sous_famille` int(3) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `famille` (`id_famille`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `composant`
--

INSERT INTO `composant` (`id`, `nom`, `info`, `boitier`, `stock_interne`, `stock_mini`, `id_famille`, `id_sous_famille`) VALUES
(1, 'Test', '', '0608', 1000, 1000, 1, 1),
(2, 'test 2', '', '0608', 150, 10, 1, 2),
(3, 'test 3', '', '1012', 2500, 5000, 2, 3),
(4, 'test 3', '', '0406', 150, 100, 1, 1),
(5, 'test 4', '', '0608', 1500, 2000, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composant_nomenclature`
--

CREATE TABLE IF NOT EXISTS `composant_nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_composant` int(11) NOT NULL,
  `id_nomenclature` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  `sous_type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `contact`, `email`, `numero`, `site`, `type`) VALUES
(1, 'FARNELL', '', '', 0, '', 0),
(2, 'RS', '', '', 0, '', 0),
(3, 'WURTH', '', '', 0, '', 0),
(4, 'FOURNISSEUR 4', '', '', 0, '', 0);

-- --------------------------------------------------------

--
-- Structure de la table `historique_prod`
--

CREATE TABLE IF NOT EXISTS `historique_prod` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `date_prod` date NOT NULL,
  `lieu` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `date_vente` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `lecteur`
--

CREATE TABLE IF NOT EXISTS `lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etat` int(11) NOT NULL,
  `num_serie` varchar(100) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_creation` date DEFAULT NULL,
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `moq`
--

CREATE TABLE IF NOT EXISTS `moq` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_composant` int(11) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `ref` text NOT NULL,
  `moq` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `nomenclature`
--

CREATE TABLE IF NOT EXISTS `nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(250) DEFAULT NULL,
  `version` int(11) NOT NULL,
  `type` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `nomenclature`
--

INSERT INTO `nomenclature` (`id`, `nom`, `version`, `type`) VALUES
(1, '7201', 1, 2),
(2, '7701', 2, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `sous_famille`
--

INSERT INTO `sous_famille` (`id`, `id_famille`, `nom`) VALUES
(1, 1, 'Resistance'),
(2, 1, 'Capa'),
(3, 2, 'sous famille2'),
(4, 2, 'sous famille3');

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
(1, 'SFEI'),
(2, 'sous-traitant 2');

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
-- Structure de la table `type_badge`
--

CREATE TABLE IF NOT EXISTS `type_badge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_lecteur`
--

CREATE TABLE IF NOT EXISTS `type_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_produit`
--

CREATE TABLE IF NOT EXISTS `type_produit` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `nom` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_produit`
--

INSERT INTO `type_produit` (`id`, `nom`) VALUES
(1, 'Matière première'),
(2, 'Identifiant'),
(3, 'Lecteur CV');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `composant`
--
ALTER TABLE `composant`
  ADD CONSTRAINT `composant_ibfk_1` FOREIGN KEY (`id_famille`) REFERENCES `famille` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
