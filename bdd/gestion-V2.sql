-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Jeu 17 Décembre 2015 à 17:25
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
  `id_lieu` int(3) NOT NULL,
  `date_commande` date NOT NULL,
  `type_produit` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `appro`
--

INSERT INTO `appro` (`id`, `id_fournisseur`, `id_lieu`, `date_commande`, `type_produit`) VALUES
(1, 0, 1, '2015-12-08', 1),
(3, 0, 1, '2015-12-14', 1),
(4, 5, 0, '2015-12-16', 2),
(5, 5, 0, '2015-12-16', 2),
(6, 6, 0, '2015-12-16', 3),
(7, 6, 0, '2015-12-16', 3);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `appro_composant`
--

INSERT INTO `appro_composant` (`id`, `id_commande`, `id_produit`, `quantite`) VALUES
(1, 1, 1, 50),
(2, 1, 2, 1000),
(3, 3, 3, 250),
(4, 1, 5, 5000),
(5, 3, 1, 10);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `appro_identifiant`
--

INSERT INTO `appro_identifiant` (`id`, `id_commande`, `id_identifiant`, `quantite`) VALUES
(1, 4, 1, 2000),
(2, 4, 3, 600),
(3, 5, 1, 1200),
(4, 4, 3, 200);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `appro_lecteur`
--

INSERT INTO `appro_lecteur` (`id`, `id_commande`, `id_lecteur`, `quantite`) VALUES
(1, 6, 4, 20),
(2, 6, 3, 10),
(3, 7, 3, 5),
(4, 6, 4, 50);

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
(1, 1, 2000),
(2, 3, 5000),
(3, 2, 25000);

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
(1, 'Test 1', '', '0608', 1000, 1000, 1, 1),
(2, 'Test 2', '', '0608', 150, 10, 1, 2),
(3, 'Test 3', '', '1012', 2500, 5000, 2, 3),
(4, 'Test 4', '', '0406', 150, 100, 1, 1),
(5, 'Test 5', '', '0608', 1500, 2000, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `composant_nomenclature`
--

CREATE TABLE IF NOT EXISTS `composant_nomenclature` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_composant` int(11) NOT NULL,
  `id_nomenclature` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `position` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `composant_nomenclature`
--

INSERT INTO `composant_nomenclature` (`id`, `id_composant`, `id_nomenclature`, `quantite`, `position`) VALUES
(1, 1, 1, 5, 'U1,U2'),
(2, 3, 1, 10, 'D1,D2'),
(3, 5, 1, 2, 'A1,A2'),
(4, 2, 2, 3, 'A1,A2'),
(5, 3, 2, 5, 'D1,D2,D8,D9');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `composant_sous_traitant`
--

INSERT INTO `composant_sous_traitant` (`id`, `id_sous_traitant`, `id_composant`, `quantite`) VALUES
(1, 1, 1, 100),
(2, 1, 3, 2000),
(3, 1, 5, 1010),
(4, 2, 4, 200),
(5, 2, 1, 563);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `fournisseur`
--

INSERT INTO `fournisseur` (`id`, `nom`, `contact`, `email`, `numero`, `site`, `type`) VALUES
(1, 'FARNELL', '', '', 0, '', 1),
(2, 'RS', '', '', 0, '', 1),
(3, 'WURTH', '', '', 0, '', 1),
(4, 'FOURNISSEUR 4', '', '', 0, '', 1),
(5, 'TW', '', '', 0, '', 2),
(6, 'CV', '', '', 0, '', 3);

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
  `num_serie` varchar(100) NOT NULL,
  `id_lecteur` int(11) NOT NULL,
  `date_creation` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `lecteur`
--

INSERT INTO `lecteur` (`id`, `num_serie`, `id_lecteur`, `date_creation`) VALUES
(1, '123', 1, '2015-12-14'),
(2, '1324', 1, '2015-12-14'),
(3, '13245', 2, '2015-12-14'),
(4, '789', 2, '2015-12-14'),
(5, '78946', 1, '2015-12-14'),
(6, '45345', 3, '2015-12-02'),
(7, '453453', 3, '2015-12-09'),
(8, '5365643', 3, '2015-12-17'),
(9, '45634563', 4, '2015-12-01');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `moq`
--

INSERT INTO `moq` (`id`, `id_composant`, `id_fournisseur`, `ref`, `moq`) VALUES
(1, 1, 1, '123', 1000),
(2, 1, 1, '1234', 2000),
(3, 1, 2, '77777', 1000),
(4, 1, 1, 'uyfjk', 5000),
(5, 2, 1, 'hgjghf', 1000),
(6, 2, 1, 'uykjuyg', 200),
(7, 3, 2, 'fghfdgh', 10000),
(8, 2, 2, '12345', 200);

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
(1, '7201-U', 1, 2),
(2, '7701-U', 2, 3);

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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `production`
--

INSERT INTO `production` (`id`, `id_lieu`, `id_nomenclature`, `quantite`, `etape`, `date_prod`) VALUES
(3, 0, 1, 10, 2, '2015-12-08'),
(4, 0, 2, 5, 2, '2015-12-10');

-- --------------------------------------------------------

--
-- Structure de la table `produit_fini_nomenclature`
--

CREATE TABLE IF NOT EXISTS `produit_fini_nomenclature` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(10) NOT NULL,
  `id_composant` int(10) NOT NULL,
  `quantite` int(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `type_badge`
--

INSERT INTO `type_badge` (`id`, `reference`, `designation`, `frequence`, `type`, `id_fournisseur`) VALUES
(1, 'BG125001', 'Badge PVC blanc Chip 125 KHz EMxx', 2, 1, 0),
(2, 'BG125002', 'Badge PVC Format ISO Chip 125 KHz ATA55xx encodable', 2, 1, 0),
(3, 'BG1356001', 'Badge PVC format ISO 13,56MHz - ISO14443A - 1Ko', 1, 1, 0),
(4, 'BG1356003', 'Badge format ISO Mifare Ultralight - 13.56 MHz - ISO14443A', 1, 1, 0);

-- --------------------------------------------------------

--
-- Structure de la table `type_lecteur`
--

CREATE TABLE IF NOT EXISTS `type_lecteur` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reference_fournisseur` varchar(250) NOT NULL,
  `reference_interne` varchar(100) NOT NULL,
  `designation` text NOT NULL,
  `frequence` int(2) NOT NULL,
  `type` int(2) NOT NULL,
  `id_fournisseur` int(11) NOT NULL,
  `petite` int(2) NOT NULL,
  `moyenne` int(2) NOT NULL,
  `grande` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `type_lecteur`
--

INSERT INTO `type_lecteur` (`id`, `reference_fournisseur`, `reference_interne`, `designation`, `frequence`, `type`, `id_fournisseur`, `petite`, `moyenne`, `grande`) VALUES
(1, '', '7201-U', 'Lecteur USB 13,56MHz	', 1, 1, 0, 0, 0, 0),
(2, '', '7701-U', 'Lecteur Autonome 13,56MHz avec Afficheur/Memoire/Horloge - Synchronisation par USB', 1, 2, 0, 0, 0, 0),
(3, '', '3300AT-2', 'Module OEM 13,56MHz  Antenne Intégrée - ISO14443A - ISO15693', 1, 2, 6, 0, 0, 0),
(4, '', '5600-2-1F', 'Lecteur RS232 W26 C&D I/F, ISO14443A Mifare Secure Sector', 1, 3, 6, 0, 0, 0);

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

-- --------------------------------------------------------

--
-- Structure de la table `version_nomenclature`
--

CREATE TABLE IF NOT EXISTS `version_nomenclature` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `id_nomenclature` int(10) NOT NULL,
  `version` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
