-- phpMyAdmin SQL Dump
-- version 2.11.11.3
-- http://www.phpmyadmin.net
--
-- Serveur: localhost
-- Généré le : Mer 21 Mai 2014 à 15:30
-- Version du serveur: 5.5.24
-- Version de PHP: 5.3.25

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `app1`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin_user`
--

CREATE TABLE IF NOT EXISTS `admin_user` (
  `au_id` int(11) NOT NULL AUTO_INCREMENT,
  `au_username` varchar(30) NOT NULL,
  `au_password` char(32) NOT NULL COMMENT 'Hash MD5',
  `au_lastlogin` datetime NOT NULL,
  PRIMARY KEY (`au_id`),
  UNIQUE KEY `cu_username` (`au_username`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `admin_user`
--

INSERT INTO `admin_user` (`au_id`, `au_username`, `au_password`, `au_lastlogin`) VALUES
(1, 'admin', 'afc5bd9d18aba20a5a9ef04805e9aa28', '2010-05-02 09:06:32'),
(2, 'user', 'afc5bd9d18aba20a5a9ef04805e9aa28', '2010-04-20 14:36:46');

-- --------------------------------------------------------

--
-- Structure de la table `arret_quote`
--

CREATE TABLE IF NOT EXISTS `arret_quote` (
  `arr_id_user` int(255) NOT NULL,
  `arr_ext_id` int(255) NOT NULL,
  `arr_moneo` smallint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `arret_quote`
--


-- --------------------------------------------------------

--
-- Structure de la table `carte`
--

CREATE TABLE IF NOT EXISTS `carte` (
  `ca_id` int(11) NOT NULL AUTO_INCREMENT,
  `ca_nom` varchar(255) NOT NULL,
  `ca_description` text NOT NULL,
  `ca_coordonnees` varchar(255) NOT NULL,
  `ca_flotte` int(11) NOT NULL,
  `ca_class` varchar(255) NOT NULL,
  `ca_zoom` tinyint(4) NOT NULL,
  `ca_epice` int(11) NOT NULL,
  `ca_epice_jour` int(11) NOT NULL,
  `ca_diplomate` int(11) NOT NULL,
  `ca_civ` int(11) NOT NULL,
  `ca_effet_diplo` text NOT NULL,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `carte`
--

INSERT INTO `carte` (`ca_id`, `ca_nom`, `ca_description`, `ca_coordonnees`, `ca_flotte`, `ca_class`, `ca_zoom`, `ca_epice`, `ca_epice_jour`, `ca_diplomate`, `ca_civ`, `ca_effet_diplo`) VALUES
(1, 'Gamont', 'Planète chaude', '274-138', 50, 'green', 0, 10000, 50, 0, 0, ''),
(2, 'Balut', 'Planète froide', '285-295', 15, '', 0, 2500, 10, 0, 0, ''),
(3, 'Chusuk', 'Planète bleue', '199-310', 15, 'blue', 0, 5000, 55, 1, 1, ''),
(4, 'Belpha-IX', 'Planète équatoriale', '134-468', 5, 'blue', 0, 500, 10, 0, 0, ''),
(5, 'Aquator-IV', 'Planète gazeuse', '99-160', 10, '', 0, 700, 20, 0, 0, ''),
(6, 'Klingon-XII', 'Planète perdue', '334-368', 50, '', 0, 200, 10, 25, 25, 'Application_Common::setEpices(5000, 1);\r\n$epices=5000;\r\n$messageFinal=''<tr><td>Parce que vous avez envoyé un ambassadeur sur notre planète, recevez ce modeste présent</td></tr>'';'),
(7, 'Alpha-necrosis', 'Planète morte', '174-408', 5, '', 0, 200, 5, 0, 0, ''),
(8, 'G-vaudan', 'Planète sauvage', '585-295', 15, 'green', 0, 1000, 25, 5, 5, ''),
(9, 'Ophiuchi', 'Etoile mourante', '99-410', 25, 'blue', 0, 1300, 30, 4, 4, ''),
(10, 'Giedi-Prime', 'Planète maudite', '99-250', 15, '', 0, 800, 15, 0, 0, ''),
(11, 'Algedi-Prima', 'Planète civique', '399-410', 30, '', 0, 2500, 50, 17, 17, 'Application_Common::setEpices(2000, 1);\r\n$epices=2000;\r\n$messageFinal=''<tr><td>Parce que vous avez envoyé un ambassadeur sur notre planète, recevez ce modeste présent</td></tr>'';'),
(12, 'Thei-shallat', 'Vaste monde océan', '50-300', 50, 'green', 1, 50, 20, 5, 5, ''),
(13, 'Vilormis', 'Monde de crystal', '100-200', 150, '', 1, 5000, 100, 0, 0, ''),
(14, 'Pashadah-IV', 'Forteresse immémoriale', '450-150', 150, 'blue', 1, 15000, 500, 0, 0, ''),
(15, 'Novebruns', 'Terre fertile', '250-250', 40, 'blue', 1, 5000, 50, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `carte_pirate`
--

CREATE TABLE IF NOT EXISTS `carte_pirate` (
  `cap_id` int(11) NOT NULL AUTO_INCREMENT,
  `cap_coordonnees` varchar(211) NOT NULL,
  `cap_race` varchar(211) NOT NULL,
  PRIMARY KEY (`cap_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `carte_pirate`
--


-- --------------------------------------------------------

--
-- Structure de la table `carte_user`
--

CREATE TABLE IF NOT EXISTS `carte_user` (
  `cau_id` int(11) NOT NULL AUTO_INCREMENT,
  `cau_id_user` int(11) NOT NULL,
  `cau_ca_id` int(11) NOT NULL,
  `cau_troupe` int(11) NOT NULL,
  `cau_etat` int(11) NOT NULL,
  `cau_jour` int(11) NOT NULL,
  `cau_heure` int(11) NOT NULL,
  `cau_envoi` int(11) NOT NULL,
  `cau_diplomate` int(11) NOT NULL,
  PRIMARY KEY (`cau_id`),
  UNIQUE KEY `cau_id_user` (`cau_id_user`,`cau_ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `carte_user`
--


-- --------------------------------------------------------

--
-- Structure de la table `cms_static`
--

CREATE TABLE IF NOT EXISTS `cms_static` (
  `cs_id` int(11) NOT NULL AUTO_INCREMENT,
  `cs_headtitle` varchar(250) NOT NULL,
  `cs_keywords` text NOT NULL,
  `cs_description` text NOT NULL,
  `cs_title` varchar(250) NOT NULL,
  `cs_content` text NOT NULL,
  PRIMARY KEY (`cs_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `cms_static`
--

INSERT INTO `cms_static` (`cs_id`, `cs_headtitle`, `cs_keywords`, `cs_description`, `cs_title`, `cs_content`) VALUES
(1, 'Page statique 1', 'Sed, ut, perspiciatis', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium', 'Page statique 1', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?');

-- --------------------------------------------------------

--
-- Structure de la table `contact_page`
--

CREATE TABLE IF NOT EXISTS `contact_page` (
  `cp_id` int(11) NOT NULL AUTO_INCREMENT,
  `cp_headtitle` varchar(250) NOT NULL,
  `cp_title` varchar(250) NOT NULL,
  `cp_description` text NOT NULL,
  `cp_keywords` text NOT NULL,
  `cp_content` text NOT NULL,
  PRIMARY KEY (`cp_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `contact_page`
--


-- --------------------------------------------------------

--
-- Structure de la table `core_urlrewrite`
--

CREATE TABLE IF NOT EXISTS `core_urlrewrite` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_path` varchar(250) NOT NULL,
  `response_path` varchar(250) NOT NULL,
  `response_code` int(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `core_urlrewrite`
--

INSERT INTO `core_urlrewrite` (`id`, `request_path`, `response_path`, `response_code`) VALUES
(1, 'index.html', 'Core/index/index', 301),
(2, 'erreur.html', 'Core/error/error', 301),
(4, 'pages-statique.html', 'Cms/static/view/pid/1', 301),
(5, 'nous-contacter.html', 'Contact/page/view', 301);

-- --------------------------------------------------------

--
-- Structure de la table `customer_user`
--

CREATE TABLE IF NOT EXISTS `customer_user` (
  `cuu_id` int(11) NOT NULL AUTO_INCREMENT,
  `cuu_login` varchar(15) NOT NULL,
  `cuu_password` varchar(32) NOT NULL,
  `cuu_name` varchar(15) NOT NULL,
  `cuu_email` varchar(25) NOT NULL,
  `cuu_securitytoken` varchar(255) NOT NULL,
  `cuu_heure` varchar(8) NOT NULL,
  `cuu_jour` int(11) NOT NULL,
  `cuu_epice` float NOT NULL,
  `cuu_impot` float NOT NULL,
  `cuu_soin` float NOT NULL,
  `cuu_serviteur` float NOT NULL,
  `cuu_influence` float NOT NULL,
  `cuu_gardien` float NOT NULL,
  `cuu_vaisseau` int(11) NOT NULL,
  `cuu_troupe` int(11) NOT NULL,
  `cuu_corruption` int(11) NOT NULL,
  `cuu_entretien` varchar(121) NOT NULL,
  `cuu_salle` int(11) NOT NULL,
  `cuu_renommee` int(11) NOT NULL,
  `cuu_delai_attentat` int(11) NOT NULL,
  `cuu_nb_victime` int(11) NOT NULL,
  `cuu_valeur_serviteur` int(11) NOT NULL,
  `cuu_valeur_troupe` int(11) NOT NULL,
  `cuu_valeur_vaisseau` int(11) NOT NULL,
  `cuu_entrainement` int(11) NOT NULL,
  `cuu_exploration` int(11) NOT NULL,
  PRIMARY KEY (`cuu_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=18 ;

--
-- Contenu de la table `customer_user`
--

INSERT INTO `customer_user` (`cuu_id`, `cuu_login`, `cuu_password`, `cuu_name`, `cuu_email`, `cuu_securitytoken`, `cuu_heure`, `cuu_jour`, `cuu_epice`, `cuu_impot`, `cuu_soin`, `cuu_serviteur`, `cuu_influence`, `cuu_gardien`, `cuu_vaisseau`, `cuu_troupe`, `cuu_corruption`, `cuu_entretien`, `cuu_salle`, `cuu_renommee`, `cuu_delai_attentat`, `cuu_nb_victime`, `cuu_valeur_serviteur`, `cuu_valeur_troupe`, `cuu_valeur_vaisseau`, `cuu_entrainement`, `cuu_exploration`) VALUES
(12, 'kaking', 'afc5bd9d18aba20a5a9ef04805e9aa28', 'Joab', 'joachim_thibout@yahoo.fr', 'e9b149f04bac380f8c6d104a40d7ae76', '1', 0, 4000, 5, 0, 2, 2, 4, 15, 250, 0, '0', 1, 0, 3, 1, 50, 0, 100, 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `externe_quete`
--

CREATE TABLE IF NOT EXISTS `externe_quete` (
  `ext_id` int(255) NOT NULL AUTO_INCREMENT,
  `ext_id_perso` int(255) NOT NULL,
  `ext_id_perso_concerne` int(255) NOT NULL,
  `ext_id_perso_quete` int(255) NOT NULL,
  `ext_us_id_ext` int(255) NOT NULL,
  `ext_id_quote` int(255) NOT NULL,
  `ext_moneo` smallint(2) NOT NULL,
  `ext_arret` smallint(1) NOT NULL,
  PRIMARY KEY (`ext_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=266 ;

--
-- Contenu de la table `externe_quete`
--

INSERT INTO `externe_quete` (`ext_id`, `ext_id_perso`, `ext_id_perso_concerne`, `ext_id_perso_quete`, `ext_us_id_ext`, `ext_id_quote`, `ext_moneo`, `ext_arret`) VALUES
(3, 3, 4, 1, 3, 17, 1, 0),
(4, 3, 2, 2, 3, 3, 1, 1),
(5, 2, 2, 3, 3, 9, 0, 1),
(6, 2, 2, 2, 3, 10, 0, 0),
(7, 2, 2, 0, 0, 1, 0, 0),
(8, 3, 3, 0, 0, 5, 0, 0),
(9, 4, 4, 0, 0, 14, 0, 0),
(10, 2, 2, 0, 0, 1, 1, 1),
(11, 2, 2, 1, 3, 2, 1, 0),
(12, 2, 2, 0, 0, 11, 1, 0),
(13, 2, 2, 0, 0, 12, 1, 0),
(14, 2, 2, 0, 0, 13, 1, 0),
(17, 4, 4, 0, 0, 15, 1, 1),
(18, 4, 4, 0, 0, 18, 1, 0),
(19, 4, 4, 0, 0, 19, 1, 0),
(20, 4, 4, 1, 3, 16, 1, 1),
(21, 4, 4, 1, 3, 17, 0, 0),
(22, 4, 4, 3, 3, 19, 0, 1),
(23, 2, 2, 2, 3, 22, 0, 0),
(24, 2, 2, 1, 0, 20, 1, 0),
(25, 9, 9, 0, 0, 24, 0, 0),
(26, 10, 10, 0, 0, 25, 0, 0),
(27, 12, 12, 0, 0, 26, 0, 0),
(28, 12, 12, 0, 0, 22, 1, 0),
(29, 12, 12, 0, 0, 23, 1, 0),
(30, 12, 12, 0, 0, 21, 1, 0),
(31, 5, 5, 0, 0, 29, 0, 0),
(32, 6, 6, 0, 0, 30, 0, 0),
(33, 7, 7, 0, 0, 31, 0, 0),
(34, 8, 8, 0, 0, 32, 0, 0),
(35, 4, 4, 1, 0, 33, 0, 0),
(36, 2, 2, 1, 0, 34, 0, 0),
(37, 2, 2, 1, 0, 24, 1, 0),
(38, 2, 2, 1, 0, 25, 1, 0),
(39, 2, 2, 0, 0, 25, 1, 0),
(40, 2, 2, 0, 0, 36, 0, 0),
(41, 3, 3, 0, 0, 26, 1, 0),
(42, 3, 3, 1, 3, 27, 1, 0),
(44, 3, 3, 1, 3, 28, 1, 0),
(45, 3, 3, 1, 3, 29, 1, 0),
(46, 3, 3, 1, 3, 30, 1, 0),
(47, 3, 3, 3, 3, 31, 1, 0),
(48, 3, 3, 3, 3, 32, 1, 0),
(49, 3, 3, 1, 3, 33, 1, 0),
(50, 3, 3, 0, 0, 34, 1, 0),
(51, 3, 3, 0, 0, 35, 1, 0),
(52, 13, 13, 0, 0, 45, 0, 0),
(53, 13, 13, 0, 0, 36, 1, 0),
(54, 13, 13, 0, 0, 37, 1, 0),
(55, 13, 13, 0, 0, 38, 1, 0),
(56, 13, 13, 2, 0, 38, 1, 0),
(57, 13, 13, 2, 0, 37, 1, 0),
(58, 13, 13, 2, 1, 39, 1, 0),
(59, 13, 13, 2, 1, 40, 1, 0),
(60, 13, 13, 4, 1, 41, 1, 0),
(61, 13, 13, 5, 1, 42, 1, 0),
(62, 13, 13, 0, 0, 43, 1, 0),
(63, 13, 13, 6, 1, 52, 0, 0),
(64, 5, 5, 0, 0, 44, 1, 0),
(65, 5, 5, 0, 0, 45, 1, 0),
(66, 15, 15, 0, 0, 54, 0, 0),
(67, 15, 13, 6, 1, 46, 1, 0),
(68, 15, 15, 0, 0, 47, 1, 0),
(69, 15, 15, 0, 0, 48, 1, 1),
(70, 15, 15, 1, 2, 49, 1, 0),
(71, 15, 15, 2, 2, 50, 1, 0),
(72, 15, 15, 3, 2, 51, 1, 0),
(73, 15, 15, 4, 2, 61, 0, 0),
(74, 15, 15, 0, 0, 52, 1, 0),
(75, 15, 15, 2, 1, 53, 1, 0),
(76, 15, 15, 2, 1, 54, 1, 0),
(77, 13, 13, 7, 1, 52, 0, 0),
(78, 13, 13, 7, 1, 55, 1, 0),
(79, 14, 14, 0, 0, 65, 0, 0),
(80, 14, 14, 1, 1, 56, 1, 0),
(81, 14, 14, 0, 0, 57, 1, 0),
(82, 14, 14, 0, 0, 58, 1, 0),
(83, 14, 14, 2, 1, 59, 1, 0),
(84, 14, 14, 1, 2, 60, 1, 0),
(85, 12, 14, 1, 1, 61, 1, 1),
(86, 12, 12, 1, 1, 62, 1, 0),
(87, 12, 12, 2, 1, 72, 0, 0),
(88, 12, 12, 3, 1, 73, 0, 0),
(89, 12, 12, 3, 1, 63, 1, 0),
(90, 14, 14, 3, 1, 75, 0, 0),
(91, 14, 14, 3, 1, 64, 1, 0),
(92, 15, 15, 5, 2, 61, 0, 0),
(93, 15, 15, 5, 2, 65, 1, 0),
(94, 11, 11, 0, 0, 78, 0, 0),
(95, 9, 9, 0, 0, 66, 1, 0),
(96, 9, 9, 0, 0, 67, 1, 0),
(97, 9, 9, 0, 0, 68, 1, 0),
(98, 5, 5, 0, 0, 69, 1, 1),
(99, 5, 5, 1, 1, 82, 0, 0),
(100, 5, 5, 2, 1, 70, 1, 0),
(101, 5, 5, 3, 1, 84, 0, 0),
(102, 15, 15, 6, 2, 71, 1, 0),
(103, 16, 16, 0, 0, 86, 0, 0),
(104, 17, 17, 0, 0, 87, 0, 0),
(105, 17, 17, 0, 0, 72, 1, 0),
(106, 17, 17, 0, 0, 73, 1, 0),
(107, 17, 17, 0, 0, 74, 1, 0),
(108, 13, 17, 1, 1, 90, 0, 0),
(109, 17, 17, 1, 1, 75, 1, 0),
(110, 17, 17, 2, 1, 76, 1, 0),
(111, 17, 17, 3, 1, 77, 1, 0),
(112, 13, 17, 4, 1, 90, 0, 0),
(113, 12, 17, 4, 1, 78, 1, 1),
(114, 12, 12, 1, 2, 79, 1, 0),
(115, 3, 17, 4, 1, 97, 0, 0),
(116, 18, 18, 0, 0, 98, 0, 0),
(117, 18, 18, 0, 0, 80, 1, 0),
(118, 18, 18, 0, 0, 81, 1, 0),
(119, 18, 18, 0, 0, 82, 1, 0),
(120, 18, 18, 1, 1, 83, 1, 0),
(121, 18, 18, 2, 1, 84, 1, 0),
(122, 18, 18, 3, 1, 85, 1, 0),
(123, 4, 18, 4, 1, 86, 1, 0),
(124, 18, 18, 0, 0, 87, 1, 0),
(125, 18, 18, 5, 1, 88, 1, 1),
(126, 18, 18, 7, 1, 89, 1, 1),
(127, 18, 18, 7, 1, 106, 0, 0),
(128, 4, 18, 7, 1, 90, 1, 0),
(129, 18, 18, 8, 1, 106, 0, 0),
(130, 18, 18, 8, 1, 91, 1, 0),
(131, 4, 4, 1, 0, 19, 1, 0),
(132, 2, 3, 1, 1, 92, 1, 1),
(133, 6, 6, 0, 0, 93, 1, 1),
(134, 6, 6, 0, 0, 94, 1, 0),
(135, 6, 6, 1, 1, 95, 1, 0),
(136, 2, 2, 1, 4, 112, 0, 0),
(137, 6, 6, 2, 1, 96, 1, 0),
(138, 6, 6, 3, 1, 97, 1, 0),
(139, 6, 6, 4, 1, 115, 0, 0),
(140, 19, 19, 0, 0, 116, 0, 0),
(141, 19, 19, 0, 0, 98, 1, 0),
(142, 19, 19, 0, 0, 99, 1, 0),
(143, 19, 19, 0, 0, 100, 1, 0),
(144, 19, 19, 0, 0, 101, 1, 0),
(145, 6, 6, 5, 1, 115, 0, 0),
(146, 20, 20, 0, 0, 120, 0, 0),
(147, 20, 20, 0, 0, 102, 1, 0),
(148, 6, 6, 6, 1, 115, 0, 0),
(149, 19, 19, 1, 1, 121, 0, 1),
(150, 19, 19, 1, 1, 103, 1, 0),
(151, 19, 19, 2, 1, 104, 1, 0),
(152, 19, 19, 2, 1, 105, 1, 0),
(153, 19, 19, 3, 1, 106, 1, 0),
(154, 6, 19, 4, 1, 107, 1, 1),
(155, 6, 19, 3, 1, 108, 1, 1),
(156, 6, 6, 1, 1, 126, 0, 0),
(157, 21, 21, 0, 0, 127, 0, 0),
(158, 21, 21, 0, 0, 109, 1, 0),
(159, 21, 21, 0, 0, 110, 1, 0),
(160, 21, 21, 0, 0, 111, 1, 0),
(161, 21, 21, 0, 0, 112, 1, 0),
(162, 21, 21, 1, 1, 113, 1, 1),
(163, 10, 10, 1, 1, 131, 0, 1),
(164, 22, 22, 0, 0, 133, 0, 0),
(165, 22, 22, 0, 0, 114, 1, 0),
(166, 22, 22, 0, 0, 115, 1, 0),
(167, 22, 22, 0, 0, 116, 1, 0),
(168, 22, 22, 1, 1, 117, 1, 0),
(169, 18, 22, 2, 1, 118, 1, 0),
(170, 21, 18, 1, 2, 119, 1, 0),
(172, 18, 18, 3, 2, 120, 1, 0),
(173, 18, 18, 3, 2, 121, 1, 0),
(174, 18, 18, 5, 2, 122, 1, 1),
(175, 14, 22, 3, 1, 123, 1, 1),
(176, 22, 22, 3, 1, 124, 1, 0),
(177, 14, 14, 0, 0, 125, 1, 0),
(178, 7, 7, 0, 0, 126, 1, 1),
(179, 7, 7, 0, 0, 127, 1, 0),
(180, 7, 7, 0, 0, 128, 1, 0),
(181, 12, 7, 1, 1, 129, 1, 0),
(182, 21, 7, 2, 1, 130, 1, 0),
(183, 9, 7, 3, 1, 131, 1, 0),
(184, 21, 7, 3, 1, 130, 1, 0),
(185, 9, 7, 4, 1, 131, 1, 0),
(186, 12, 7, 2, 1, 129, 1, 0),
(187, 23, 23, 0, 0, 132, 1, 0),
(188, 23, 7, 4, 1, 133, 1, 0),
(189, 23, 23, 0, 0, 151, 0, 0),
(190, 23, 7, 5, 1, 133, 1, 0),
(191, 7, 7, 5, 1, 134, 1, 0),
(192, 23, 7, 7, 1, 135, 1, 0),
(193, 7, 7, 8, 1, 136, 1, 0),
(194, 23, 7, 5, 1, 137, 1, 0),
(195, 7, 7, 6, 1, 138, 1, 1),
(196, 7, 7, 9, 1, 138, 1, 1),
(197, 3, 7, 1, 2, 139, 1, 0),
(198, 7, 7, 3, 2, 157, 0, 0),
(199, 7, 7, 1, 2, 157, 0, 0),
(201, 3, 7, 2, 2, 140, 1, 0),
(202, 3, 7, 2, 2, 141, 1, 0),
(203, 7, 7, 3, 2, 142, 1, 0),
(204, 7, 7, 3, 2, 143, 1, 0),
(205, 6, 7, 1, 2, 144, 1, 0),
(206, 6, 6, 2, 2, 145, 1, 0),
(207, 6, 6, 2, 2, 146, 1, 0),
(208, 7, 6, 3, 2, 147, 1, 0),
(209, 7, 6, 3, 2, 148, 1, 0),
(210, 3, 7, 1, 2, 149, 1, 0),
(211, 7, 7, 8, 2, 157, 0, 0),
(212, 7, 7, 8, 2, 150, 1, 0),
(213, 7, 7, 8, 2, 151, 1, 0),
(214, 8, 8, 0, 0, 152, 1, 0),
(215, 8, 8, 0, 0, 153, 1, 1),
(216, 8, 8, 1, 1, 154, 1, 0),
(217, 8, 8, 0, 0, 155, 1, 0),
(218, 8, 8, 2, 1, 156, 1, 1),
(219, 8, 8, 3, 1, 157, 1, 0),
(220, 4, 4, 0, 0, 158, 1, 0),
(221, 4, 4, 1, 0, 158, 1, 0),
(222, 5, 5, 4, 1, 159, 1, 0),
(223, 5, 5, 5, 1, 161, 1, 0),
(224, 5, 5, 5, 1, 160, 1, 0),
(225, 5, 5, 6, 1, 162, 1, 0),
(226, 5, 5, 7, 1, 178, 0, 0),
(227, 24, 24, 0, 0, 163, 1, 0),
(228, 24, 24, 0, 0, 179, 0, 0),
(229, 24, 5, 7, 1, 164, 1, 1),
(230, 24, 24, 1, 1, 181, 0, 0),
(231, 24, 24, 2, 1, 165, 1, 0),
(232, 25, 25, 0, 0, 183, 0, 0),
(233, 25, 25, 0, 0, 166, 1, 1),
(234, 25, 25, 1, 1, 167, 1, 0),
(235, 25, 25, 1, 1, 168, 1, 0),
(236, 25, 25, 2, 1, 169, 1, 0),
(237, 2, 25, 2, 1, 170, 1, 0),
(238, 1, 25, 4, 1, 189, 0, 0),
(239, 1, 1, 0, 0, 171, 1, 0),
(240, 1, 1, 1, 1, 172, 1, 0),
(241, 1, 1, 2, 1, 173, 1, 0),
(242, 1, 1, 3, 1, 174, 1, 0),
(243, 1, 1, 4, 1, 175, 1, 0),
(244, 1, 1, 5, 1, 176, 1, 0),
(245, 1, 1, 6, 1, 177, 1, 0),
(246, 1, 1, 7, 1, 178, 1, 0),
(247, 1, 1, 8, 1, 179, 1, 0),
(248, 1, 1, 9, 1, 180, 1, 0),
(249, 1, 1, 0, 0, 181, 1, 0),
(250, 1, 1, 11, 1, 182, 1, 0),
(251, 1, 1, 12, 1, 183, 1, 0),
(252, 1, 1, 13, 1, 184, 1, 0),
(253, 1, 1, 14, 1, 185, 1, 0),
(254, 1, 1, 15, 1, 186, 1, 0),
(255, 1, 1, 16, 1, 187, 1, 0),
(256, 1, 1, 17, 1, 188, 1, 0),
(257, 1, 1, 18, 1, 189, 1, 0),
(258, 1, 1, 19, 1, 190, 1, 0),
(259, 1, 1, 0, 0, 191, 1, 0),
(260, 1, 1, 21, 1, 192, 1, 0),
(261, 1, 1, 22, 1, 193, 1, 0),
(262, 1, 25, 5, 1, 189, 0, 0),
(263, 2, 25, 3, 1, 194, 1, 0),
(264, 26, 26, 0, 0, 214, 0, 0),
(265, 26, 26, 1, 1, 214, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `faction`
--

CREATE TABLE IF NOT EXISTS `faction` (
  `fac_id` int(255) NOT NULL AUTO_INCREMENT,
  `fac_nom` varchar(255) NOT NULL,
  PRIMARY KEY (`fac_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `faction`
--

INSERT INTO `faction` (`fac_id`, `fac_nom`) VALUES
(1, 'Empereur'),
(2, 'Truitesse'),
(3, 'Bene Guesserit'),
(4, 'Bene tleilax'),
(5, 'Ix'),
(6, 'Guilde');

-- --------------------------------------------------------

--
-- Structure de la table `gardien`
--

CREATE TABLE IF NOT EXISTS `gardien` (
  `gar_id` int(11) NOT NULL AUTO_INCREMENT,
  `gar_id_user` int(11) NOT NULL,
  `gar_id_faction` int(11) NOT NULL,
  `gar_nb_gardien` int(11) NOT NULL,
  PRIMARY KEY (`gar_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `gardien`
--

INSERT INTO `gardien` (`gar_id`, `gar_id_user`, `gar_id_faction`, `gar_nb_gardien`) VALUES
(1, 12, 3, 0),
(2, 12, 4, 0),
(3, 12, 5, 0),
(4, 12, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `gardien_trainer`
--

CREATE TABLE IF NOT EXISTS `gardien_trainer` (
  `gart_id` int(11) NOT NULL AUTO_INCREMENT,
  `gart_id_user` int(11) NOT NULL,
  `gart_id_niveau` int(11) NOT NULL,
  `gart_nb_gardien` int(11) NOT NULL,
  `gart_time` int(11) NOT NULL,
  PRIMARY KEY (`gart_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `gardien_trainer`
--


-- --------------------------------------------------------

--
-- Structure de la table `humeur_faction`
--

CREATE TABLE IF NOT EXISTS `humeur_faction` (
  `hum_id` int(11) NOT NULL AUTO_INCREMENT,
  `hum_id_user` int(255) NOT NULL,
  `hum_id_faction` int(255) NOT NULL,
  `hum_humeur` int(255) NOT NULL,
  PRIMARY KEY (`hum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Contenu de la table `humeur_faction`
--

INSERT INTO `humeur_faction` (`hum_id`, `hum_id_user`, `hum_id_faction`, `hum_humeur`) VALUES
(1, 12, 3, 0),
(2, 12, 6, 0),
(3, 12, 4, 0),
(4, 12, 5, 0),
(5, 12, 1, 0),
(6, 12, 2, 0);

-- --------------------------------------------------------

--
-- Structure de la table `influence`
--

CREATE TABLE IF NOT EXISTS `influence` (
  `inf_id` int(11) NOT NULL AUTO_INCREMENT,
  `inf_id_user` int(11) NOT NULL,
  `inf_id_faction` int(11) NOT NULL,
  `inf_nb_influence` int(11) NOT NULL,
  PRIMARY KEY (`inf_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `influence`
--

INSERT INTO `influence` (`inf_id`, `inf_id_user`, `inf_id_faction`, `inf_nb_influence`) VALUES
(1, 12, 3, 0),
(2, 12, 4, 0),
(3, 12, 5, 0),
(4, 12, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `moneo_quote`
--

CREATE TABLE IF NOT EXISTS `moneo_quote` (
  `mon_id` int(255) NOT NULL AUTO_INCREMENT,
  `mon_id_perso` int(255) NOT NULL,
  `mon_maj_quete` smallint(6) NOT NULL,
  `mon_maj_quete_perso` int(255) NOT NULL,
  `mon_maj_quete_id_ext` int(255) NOT NULL,
  `mon_quote` text NOT NULL,
  `mon_humeur` int(255) NOT NULL,
  `mon_quote_seul` smallint(1) NOT NULL,
  `mon_reponse` int(255) NOT NULL,
  `mon_id_multiple` int(255) NOT NULL,
  `mon_nb_multiple` int(255) NOT NULL,
  `mon_recompense_multi` int(11) NOT NULL,
  `mon_recompense_nb_multi` int(11) NOT NULL,
  `mon_fnctn` text NOT NULL,
  PRIMARY KEY (`mon_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=195 ;

--
-- Contenu de la table `moneo_quote`
--

INSERT INTO `moneo_quote` (`mon_id`, `mon_id_perso`, `mon_maj_quete`, `mon_maj_quete_perso`, `mon_maj_quete_id_ext`, `mon_quote`, `mon_humeur`, `mon_quote_seul`, `mon_reponse`, `mon_id_multiple`, `mon_nb_multiple`, `mon_recompense_multi`, `mon_recompense_nb_multi`, `mon_fnctn`) VALUES
(1, 2, 0, 0, 0, 'Que puis je faire pour me rendre utile ?', 0, 0, 3, 0, 0, 0, 0, ''),
(2, 2, 2, 2, 3, 'Je me charge d''aller prévenir le scribe officiel au sujet des mémoires de notre empereur', 0, 1, -1, 0, 0, 0, 0, ''),
(3, 3, 3, 2, 3, 'Nayla s''inquiète au sujet des mémoire de l''empereur', 0, 0, 8, 0, 0, 0, 0, ''),
(11, 2, 0, 0, 0, 'Parlez-moi un peu d''Arrakis...', 0, 0, 12, 0, 0, 0, 0, ''),
(12, 2, 0, 0, 0, 'Depuis combien de temps l''empereur-Dieu règne t-il ainsi ?', 0, 0, 13, 0, 0, 0, 0, ''),
(13, 2, 0, 0, 0, 'Merci pour ces renseignements', 0, 0, -1, 0, 0, 0, 0, ''),
(15, 4, 0, 0, 0, 'Voudriez-vous que je vous offres mes services ?', 0, 0, 15, 0, 0, 0, 0, ''),
(16, 4, 0, 0, 0, 'Il en sera fait selon vos désirs...', 0, 1, 16, 0, 0, 0, 0, ''),
(17, 3, 2, 4, 3, 'l''inquisiteur voudrait les documents spécifiques au Duncan...', 0, 0, 21, 0, 0, 0, 0, ''),
(18, 4, 0, 0, 0, 'Pourquoi le soleil ne se couche t-il jamais ?', 0, 0, 18, 0, 0, 0, 0, ''),
(19, 4, 0, 0, 0, 'Je retourne à mes obligations', 0, 0, -1, 0, 0, 0, 0, ''),
(20, 2, 0, 0, 0, 'Que puis je faire pour vous proposer mes services ?', 5, 0, 23, 0, 0, 0, 0, ''),
(21, 12, 0, 0, 0, 'Comment gagner de l''épice ?', 0, 0, 27, 0, 0, 0, 0, ''),
(22, 12, 0, 0, 0, 'Comment gagne t-on de l''influence vis à vis des maisons ?', 0, 0, 28, 0, 0, 0, 0, ''),
(23, 12, 0, 0, 0, 'Je retourne à mes obligations', 0, 0, -1, 0, 0, 0, 0, ''),
(24, 2, 0, 0, 0, 'Je retourne à mes obligations...', 0, 0, -1, 0, 0, 0, 0, ''),
(25, 2, 0, 0, 0, 'Que signifie la cérémonie du partage ?', 0, 0, 35, 0, 0, 0, 0, ''),
(26, 3, 0, 0, 0, 'Quelles sont les différentes maisons qui composent l''Imperiuum ?', 0, 0, 37, 0, 0, 0, 0, ''),
(27, 3, 0, 0, 0, 'Parlez moi de la maison Tleilaxu', 0, 1, 38, 0, 0, 0, 0, ''),
(28, 3, 2, 3, 3, 'Merci de votre collaboration', 0, 1, -1, 0, 0, 0, 0, ''),
(29, 3, 0, 0, 0, 'Parlez moi de la Guilde', 0, 1, 39, 0, 0, 0, 0, ''),
(30, 3, 0, 0, 0, 'Parlez moi du Bene Guesserit', 0, 1, 40, 0, 0, 0, 0, ''),
(31, 3, 0, 0, 0, 'Pourquoi accepter une telle maison, si elle est si abominable ?', 0, 1, 41, 0, 0, 0, 0, ''),
(32, 3, 0, 0, 0, 'des tentatives d''assassinat ?', 0, 1, 42, 0, 0, 0, 0, ''),
(33, 3, 0, 0, 0, 'Parlez moi de la maison d''Ix', 0, 1, 43, 0, 0, 0, 0, ''),
(34, 3, 0, 0, 0, 'Quoi faire des Seviteurs, Escortes et Points d''influences ?', 0, 0, 44, 0, 0, 0, 0, ''),
(35, 3, 0, 0, 0, 'Veuillez m''excuser', 0, 0, -1, 0, 0, 0, 0, ''),
(36, 13, 0, 0, 0, 'Quelles sont les dernières rumeurs qui circulent au palais ?', 0, 0, 46, 0, 0, 0, 0, '$getMaj=$quotes->getMajQuete(1,17,0);\r\nif($getMaj)$value[''mon_reponse'']=95;'),
(37, 13, 0, 0, 0, 'Que pensez vous des différentes maisons qui logent dans le palais ? ', 0, 0, 47, 0, 0, 0, 0, ''),
(38, 13, 0, 0, 0, 'Y''a t''il une maison particulière que vous n''appréciez pas ?', 0, 0, 48, 0, 0, 0, 0, ''),
(39, 13, 3, 13, 1, 'surement', 0, 1, 49, 0, 0, 0, 0, ''),
(40, 13, 1, 13, 1, 'Non, plus tard peut-être', 0, 1, -1, 0, 0, 0, 0, ''),
(41, 13, 0, 0, 0, 'vous savez pourquoi ?', 0, 1, 50, 0, 0, 0, 0, ''),
(42, 13, 0, 0, 0, 'Et alors? qu''à t''il fait?', 0, 1, 51, 0, 0, 0, 0, ''),
(43, 13, 0, 0, 0, 'Au revoir', 0, 0, -1, 0, 0, 0, 0, ''),
(44, 5, 0, 0, 0, 'Qu''esperez-vous au juste de l''empereur ?', 0, 0, 53, 0, 0, 0, 0, ''),
(45, 5, 0, 0, 0, 'Mes respects', 0, 0, -1, 0, 0, 0, 0, ''),
(46, 15, 0, 0, 0, 'J''ai eu une discussion très interessante avec le barman à votre sujet...', 0, 0, 55, 0, 0, 0, 0, ''),
(47, 15, 0, 0, 0, 'Parlez-moi un peu de votre discipline Bene Guesserit...', 0, 0, 56, 0, 0, 0, 0, ''),
(48, 15, 0, 0, 0, 'De quelle maison vous méfiez-vous le plus ?', 0, 0, 57, 0, 0, 0, 0, ''),
(49, 15, 0, 0, 0, 'Qu''est-ce qu''au juste un danseur-visage ?', 0, 1, 58, 0, 0, 0, 0, ''),
(50, 15, 0, 0, 0, 'Mais comment décèler un danseur-visage d''une vraie personne ?', 0, 1, 59, 0, 0, 0, 0, ''),
(51, 15, 0, 0, 0, 'Dites-moi donc', 0, 1, 60, 0, 0, 0, 0, ''),
(52, 15, 0, 0, 0, 'Je vous remercie', 0, 0, -1, 0, 0, 0, 0, ''),
(53, 15, 0, 0, 0, 'Donnez moi l''argent de la consommation en échange de mon silence', 0, 1, 62, 0, 0, 0, 0, ''),
(54, 15, 0, 0, 0, 'Donnez moi l''argent de la consommation plus une petite consolation en échange de mon silence', 0, 1, 63, 0, 0, 0, 0, ''),
(55, 13, 0, 0, 0, 'J''ai l''argent de la soeur Bene Guesserit (-500 épices)', 0, 0, 64, 0, 0, 0, 0, ''),
(56, 14, 0, 0, 0, 'Vous me semblez imbibé d''alcool d''épice...', 0, 0, 66, 0, 0, 0, 0, ''),
(57, 14, 0, 0, 0, 'Que vous inspire le Sentier d''Or ?', 0, 0, 67, 0, 0, 0, 0, ''),
(58, 14, 0, 0, 0, 'Je vais y aller', 0, 0, -1, 0, 0, 0, 0, ''),
(59, 14, 1, 14, 2, 'Quelles sortes d''expériences? et pourquoi?', 0, 1, 68, 0, 0, 0, 0, '$quotes=new Core_Model_Mapper_Quote();\r\n$perso=new Core_Model_Mapper_Personnage();\r\n$getMaj=$quotes->getMajQuete(4,15,2);\r\nif(!$getMaj)$stop=1;'),
(60, 14, 0, 0, 0, '(Verser la fiole d''hormones dans le verre de l''interlocuteur)', 0, 0, 69, 0, 0, 0, 0, ''),
(61, 12, 0, 0, 0, 'Je soupçonne quelqu''un de préparer un attentat contre l''Empereur-dieu Leto II', 0, 0, 70, 0, 0, 0, 0, ''),
(62, 12, 0, 0, 0, 'En effet, l''ambassadeur Trokir me semble louche', 0, 1, 71, 0, 0, 0, 0, ''),
(63, 12, 0, 0, 0, 'Ce ne sera pas nécessaire: ma source était corrompue... je suis sincèrement désolé, c''était une erreur', 0, 1, 74, 0, 0, 0, 0, ''),
(64, 14, 0, 0, 0, 'Chassons ce mauvais souvenir et buvons à la santé de empereur !', 0, 1, 76, 0, 0, 0, 0, ''),
(65, 15, 0, 0, 0, 'Ca y''est, j''ai versé la fiole d''hormones dans son verre...', 0, 0, 77, 0, 0, 0, 0, ''),
(66, 9, 0, 0, 0, 'Comment attaquer une planète ?', 0, 0, 79, 0, 0, 0, 0, ''),
(67, 9, 0, 0, 0, 'A quoi me sert un diplomate ?', 0, 0, 80, 0, 0, 0, 0, ''),
(68, 9, 0, 0, 0, 'Merci commandant', 0, 0, -1, 0, 0, 0, 0, ''),
(69, 5, 0, 0, 0, 'En quoi puis-je vous satisfaire ?', 0, 0, 81, 0, 0, 0, 0, ''),
(70, 5, 0, 0, 0, 'Vous désirez autre chose ?', 0, 0, 83, 0, 0, 0, 0, ''),
(71, 15, 0, 0, 0, 'Pourquoi les danseurs-visage dégagent une odeur unique ?', 0, 0, 85, 0, 0, 0, 0, ''),
(72, 17, 0, 0, 0, 'Que pouvez vous me dire à propos du Sareer ?', 0, 0, 88, 0, 0, 0, 0, ''),
(73, 17, 0, 0, 0, 'Que pensez vous de l''armée de truitesse ?', 0, 0, 89, 0, 0, 0, 0, ''),
(74, 17, 0, 0, 0, 'Au revoir', 0, 0, -1, 0, 0, 0, 0, ''),
(75, 17, 0, 0, 0, 'La température a légèrement augmenté n''est ce pas ?', 0, 0, 91, 0, 0, 0, 0, ''),
(76, 17, 0, 0, 0, 'Effectivement, je vois que la chaleur vous mets très mal à l''aise...', 0, 1, 92, 0, 0, 0, 0, ''),
(77, 17, 4, 17, 1, 'Désolé de vous importuner, au revoir (fine odeur désagréable)', 0, 1, -1, 0, 0, 0, 0, ''),
(78, 12, 0, 0, 0, 'Un danseur visage a infiltré le palais royal', 0, 0, 93, 0, 0, 0, 0, ''),
(79, 12, 0, 0, 0, 'Le client adossé au bar est un danseur-visage. Il en veut à la vie de l''inquisiteur impérial', 0, 1, 94, 0, 0, 0, 0, ''),
(80, 18, 0, 0, 0, 'Un Fremen de... musée ?', 0, 0, 99, 0, 0, 0, 0, ''),
(81, 18, 0, 0, 0, 'Comment s''appelle votre accoutrement atypique ?', 0, 0, 100, 0, 0, 0, 0, ''),
(82, 18, 0, 0, 0, 'Qu''attendez vous de l''Empereur-dieu ?', 0, 0, 101, 0, 0, 0, 0, ''),
(83, 18, 0, 0, 0, 'Vos...Sietchs ?', 0, 1, 102, 0, 0, 0, 0, ''),
(84, 18, 0, 0, 0, 'Et que voulez-vous au juste ?', 0, 1, 103, 0, 0, 0, 0, ''),
(85, 18, 4, 18, 1, 'Je vais voir ce que je peux faire...', 0, 1, -1, 0, 0, 0, 0, ''),
(86, 4, 0, 0, 0, 'Un Fremen de musée voudrait une entrevue avec l''empereur-dieu', 0, 0, 104, 0, 0, 0, 0, ''),
(87, 18, 0, 0, 0, 'Le devoir m''appelle', 0, 0, -1, 0, 0, 0, 0, ''),
(88, 18, 6, 18, 1, 'Dites-moi donc l''objet de votre requête, j''ai une entrevue avec le grand inquisiteur, à 16h00 l''après-midi', 0, 1, 105, 0, 0, 0, 0, ''),
(89, 18, 0, 0, 0, 'Je vais voir ce que je peux faire...', 0, 1, -1, 0, 0, 0, 0, ''),
(90, 4, 0, 0, 0, 'Le Fremen de musée voudrait la permission d''utiliser les tournevis laser', 0, 0, 107, 0, 0, 0, 0, '$heur=Application_Common::getHeure();\r\nif($heur>=56 &&  $heur<67){}else\r\n$stop=1;'),
(91, 18, 0, 0, 0, 'Désolé, mais l''empereur-dieu a été catégorique : la réponse est non !', 0, 0, 108, 0, 0, 0, 0, ''),
(92, 2, 0, 0, 0, 'Les mémoires ! elles ont été volées !!!', 0, 1, 109, 0, 0, 0, 0, ''),
(93, 6, 0, 0, 0, 'Quel service la maison Tleilax voudrait-elle que je lui rende ?', 0, 0, 110, 0, 0, 0, 0, ''),
(94, 6, 0, 0, 0, 'Le devoir m''appelle...', 0, 0, -1, 0, 0, 0, 0, ''),
(95, 6, 2, 6, 1, 'La planète Chusuk a été conquise à votre demande...', 0, 0, 111, 0, 0, 0, 0, '$oui=Application_Common::getMyStar(3);\r\nif(!$oui)\r\n$stop=1;\r\n'),
(96, 6, 0, 0, 0, 'Avez vous une requête à formuler ?', 0, 0, 113, 0, 0, 0, 0, ''),
(97, 6, 0, 0, 0, 'Le savoir Tleilax ?', 0, 1, 114, 0, 0, 0, 0, ''),
(98, 19, 0, 0, 0, 'Le devoir m''appelle...', 0, 0, -1, 0, 0, 0, 0, ''),
(99, 19, 0, 0, 0, 'A quand remonte l''inimitié entre les Atréïdes et le Bene Tleilax ?', 0, 0, 117, 0, 0, 0, 0, ''),
(100, 19, 0, 0, 0, 'Qu''y a t-il aux abords du palais ?', 0, 0, 118, 0, 0, 0, 0, ''),
(101, 19, 0, 0, 0, 'Quelle pièce du palais préférez vous ?', 0, 0, 119, 0, 0, 0, 0, ''),
(102, 20, 0, 0, 0, 'Que Shai-Hulud vous protège...', 0, 0, -1, 0, 0, 0, 0, ''),
(103, 19, 0, 0, 0, 'Le Bene Tleilax est au courant de votre traîtrise...Votre félonie vous coûtera votre vie !', 0, 1, 122, 0, 0, 0, 0, ''),
(104, 19, 3, 19, 1, 'Ne savez vous donc pas que je sers l''Empereur-dieu depuis plus d''un siècle et que je suis insensible à votre esprit de souk ?', 0, 1, 123, 0, 0, 0, 0, ''),
(105, 19, 4, 19, 1, 'Vous avez raison, il y a surement un moyen de s''entendre...', 0, 1, 124, 0, 0, 0, 0, ''),
(106, 19, 0, 0, 0, 'La loyauté envers mon souverain LETO II est totale... Il m''a tant appris, tant montré, tant éduqué... il a fait tant de sacrifice...son humanité perdue...je n''ai envers vous que mépris et dédain...', 0, 1, -1, 0, 0, 0, 0, ''),
(107, 6, 0, 0, 0, 'Je me suis occupé moi-même de ce traître !', 0, 0, 125, 0, 0, 0, 0, ''),
(108, 6, 0, 0, 0, 'Le général traître ne vous nuira plus, vous en avez ma parole', 0, 0, 125, 0, 0, 0, 0, ''),
(109, 21, 0, 0, 0, 'Quelle est votre fonction dans le palais ?', 0, 0, 128, 0, 0, 0, 0, ''),
(110, 21, 0, 0, 0, 'Quelles sont les horaires d''ouverture du surplus ?', 0, 0, 129, 0, 0, 0, 0, ''),
(111, 21, 0, 0, 0, 'Le devoir m''appelle', 0, 0, -1, 0, 0, 0, 0, ''),
(112, 21, 0, 0, 0, 'Faites moi profiter de votre savoir Ixien...', 0, 0, 130, 0, 0, 0, 0, ''),
(113, 21, 0, 0, 0, 'Merci... il est rare de voir un tel engouement pour la philosophie de la part d''un Ixien...l''empereur sera tenu au courant du présent que vous lui faites...', 0, 1, -1, 0, 0, 0, 0, ''),
(114, 22, 0, 0, 0, 'Mon temps, tout comme l''eau d''Arrakis, est extremement précieux...', 0, 0, -1, 0, 0, 0, 0, ''),
(115, 22, 0, 0, 0, 'Que pensez vous du Sentier d''Or ?', 0, 0, 134, 0, 0, 0, 0, ''),
(116, 22, 0, 0, 0, 'Ou puis je trouver un distille ?', 0, 0, 135, 0, 0, 0, 0, ''),
(117, 22, 0, 0, 0, 'Quel genre de service ?', 0, 1, 136, 0, 0, 0, 0, ''),
(118, 18, 0, 0, 0, 'Que me donnerez-vous en échange de votre Krys ?', 0, 0, 137, 0, 0, 0, 0, '$king=Application_Common::getMajQueste(2,21,2);\r\nif($king){\r\n$value[''mon_quote'']=''Ekkeri-akairi, fillissin-follas. Kivi a-kavi, nakalas! Nakalas! Ukair-an ... jan, jan, jan'';\r\n}'),
(119, 21, 0, 0, 0, 'Pouvez vous m''apprendre le Chakobsa ?', 0, 0, 138, 0, 0, 0, 0, ''),
(120, 18, 4, 18, 2, 'Donner la moitié de son épice en échange du Krys', 0, 1, 140, 0, 0, 0, 0, ''),
(121, 18, 1, 18, 2, 'Refuser', 0, 1, -1, 0, 0, 0, 0, 'Application_Common::majQueste(2,22,1);'),
(122, 18, 0, 0, 0, 'Quelle pitié que de vendre un objet pareil...vous autres, Fremen de musée ne m''inspirez aucune confiance...votre esprit est loin de la pureté des premiers Naib...', 0, 1, -1, 0, 0, 0, 0, ''),
(123, 14, 0, 0, 0, 'J''ai un Krys sur moi...voudriez-vous que je vous le montre ?', 0, 1, 141, 0, 0, 0, 0, ''),
(124, 22, 0, 0, 0, 'J''ai récupéré un Krys', 0, 0, 142, 0, 0, 0, 0, ''),
(125, 14, 0, 0, 0, 'Quelle civilisation vous fascine le plus ?', 0, 0, 143, 0, 0, 0, 0, ''),
(126, 7, 0, 0, 0, 'Auriez-vous une requête à me soumettre ?', 0, 0, 144, 0, 0, 0, 0, ''),
(127, 7, 0, 0, 0, 'Est-il vrai que la guilde aie fait alliance avec votre maison ?', 0, 0, 145, 0, 0, 0, 0, ''),
(128, 7, 0, 0, 0, 'Le devoir m''appelle...', 0, 0, -1, 0, 0, 0, 0, ''),
(129, 12, 0, 0, 0, 'Le représentant Ixien a reçu une lettre de menace...', 0, 0, 147, 0, 0, 0, 0, ''),
(130, 21, 0, 0, 0, 'Pourriez-vous lire cette lettre ?', 0, 0, 148, 0, 0, 0, 0, ''),
(131, 9, 0, 0, 0, 'Que savez-vous à propos de la planète CoSentience ?', 0, 0, 149, 0, 0, 0, 0, ''),
(132, 23, 0, 0, 0, 'Le devoir m''appelle...', 0, 0, -1, 0, 0, 0, 0, ''),
(133, 23, 0, 0, 0, 'êtes-vous l''auteur de cette lettre de menace ?', 0, 0, 150, 0, 0, 0, 0, ''),
(134, 7, 0, 0, 0, 'L''auteur de la lettre de menace est un technicien de la Guilde affecté à l''entretien des long-courriers (+25000 épice)', 0, 0, 152, 0, 0, 0, 0, ''),
(135, 23, 0, 0, 0, 'A la dernière cérémonie du partage, IX n''a rien reçu...', 0, 1, 153, 0, 0, 0, 0, ''),
(136, 7, 0, 0, 0, 'Je me suis personnellement occupé de votre affaire : vous ne recevrez plus de lettres de menace', 0, 1, 154, 0, 0, 0, 0, ''),
(137, 23, 0, 0, 0, 'La planète Novebruns est maintenant notre...', 0, 0, 153, 0, 0, 0, 0, '$star=Application_Common::getMyStar(15);\r\nif($star!=1)\r\n$stop=1;'),
(138, 7, 0, 0, 0, 'Comment-puis je vous être agréable...', 0, 0, 155, 0, 0, 0, 0, ''),
(139, 3, 0, 0, 0, 'Seriez-vous intéressé par des poésies originales datant de l''ère pré-ridulien ?', 0, 0, 156, 0, 0, 0, 0, '$getMaj=Application_Common::getMajQueste(3,6,2);\r\nif($getMaj)$stop=1;\r\n\r\n$retur=Application_Common::getMajQueste(1,6,2);\r\nif($retur)\r\n$stop=1;'),
(140, 3, 0, 0, 0, 'Oui, ca me paraît-être un prix convenable', 0, 1, 158, 0, 0, 0, 0, ''),
(141, 3, 1, 7, 2, 'Non, laissez-moi le temps...', 0, 1, -1, 0, 0, 0, 0, ''),
(142, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 5000 épices (-5000 épices)', 0, 0, 159, 0, 0, 0, 0, ''),
(143, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 1000 épices (-1000 épice)', 0, 0, 160, 0, 0, 0, 0, ''),
(144, 6, 0, 0, 0, 'J''ai sur moi quelques poèmes datant de l''ère pré-ridulien...', 0, 0, 161, 0, 0, 0, 0, '$getMaj=Application_Common::getMajQueste(3,6,2);\r\nif($getMaj)$stop=1;'),
(145, 6, 0, 0, 0, 'Vendre les poèmes pour 6000 épices', 0, 1, 162, 0, 0, 0, 0, ''),
(146, 6, 1, 6, 2, 'Ne pas vendre les poèmes...', 0, 1, -1, 0, 0, 0, 0, ''),
(147, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 6000 épices (-6000 épices)', 0, 0, 163, 0, 0, 0, 0, ''),
(148, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 3000 épices (-3000 épices)', 0, 0, 164, 0, 0, 0, 0, ''),
(149, 3, 0, 0, 0, 'Le Bene tleilax me propose 6000 épices contre ces poèmes...', 0, 0, 165, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(1,6,2);\r\nif(!$retur)\r\n$stop=1;'),
(150, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 10 000 épices (-10 000 épices)', 0, 0, 166, 0, 0, 0, 0, ''),
(151, 7, 0, 0, 0, 'Les poèmes ont été vendu pour 5000 épices (-5000 épices)', 0, 0, 168, 0, 0, 0, 0, ''),
(152, 8, 0, 0, 0, 'Pourquoi la guilde a t-elle tant besoin d''épice ?', 0, 0, 169, 0, 0, 0, 0, ''),
(153, 8, 0, 0, 0, 'Que désirez-vous ?', 0, 0, 170, 0, 0, 0, 0, ''),
(154, 8, 0, 0, 0, 'Notre empire s''étend sur au moins 5 planètes...', 0, 0, 171, 0, 0, 0, 0, '$myStars=Application_Common::getMyStarOne();\r\nif($myStars<5)\r\n$stop=1;'),
(155, 8, 0, 0, 0, 'Mon temps est précieux...', 0, 0, -1, 0, 0, 0, 0, ''),
(156, 8, 0, 0, 0, 'Que désirez-vous ?', 0, 0, 172, 0, 0, 0, 0, ''),
(157, 8, 0, 0, 0, 'Notre empire s''étend sur au moins 10 planètes...', 0, 0, 173, 0, 0, 0, 0, '$myStars=Application_Common::getMyStarOne();\r\nif($myStars<10)\r\n$stop=1;'),
(158, 4, 0, 0, 0, 'Le palais est-il un endroit sûr ?', 0, 0, 174, 0, 0, 0, 0, ''),
(159, 5, 0, 0, 0, 'Que désirez vous donc ?', 0, 0, 175, 0, 0, 0, 0, ''),
(160, 5, 0, 0, 0, 'Oui, la maison Bene Guesserit est une maison puissante et redoutable en qui je mets ma confiance', 0, 1, 176, 0, 0, 0, 0, ''),
(161, 5, 4, 5, 1, 'Mmmmh...laissez moi encore un peu de temps...', 0, 1, -1, 0, 0, 0, 0, ''),
(162, 5, 0, 0, 0, 'la Prescience de notre Empereur ? mais...c''est terrible !', 0, 1, 177, 0, 0, 0, 0, ''),
(163, 24, 0, 0, 0, 'Je reviendrai...', 0, 0, -1, 0, 0, 0, 0, ''),
(164, 24, 0, 0, 0, 'Je viens au nom du Bene Guesserit...', 0, 0, 180, 0, 0, 0, 0, ''),
(165, 24, 0, 0, 0, 'On m''avais parlé d''une récompense...', 0, 0, 182, 0, 0, 0, 0, ''),
(166, 25, 0, 0, 0, 'Ainsi...Ainsi c''était toi ! toi qui as volé les mémoires de notre empereur ? Ma Siona ! la rébellion n''est pas une issue ! je suis moi-même passé par ce chemin...crois moi : l''Empereur-dieu m''a montré tellement de choses...il est encore temps pour toi de renoncer à cette folie !', 0, 0, 184, 0, 0, 0, 0, ''),
(167, 25, 0, 0, 0, '(Menacer Siona -votre fille- avec son laser) SIONA !!! RENDS MOI LES MEMOIRES', 0, 1, 185, 0, 0, 0, 0, ''),
(168, 25, 0, 0, 0, 'Siona, je t''en supplie, donne moi les mémoires !', 0, 1, 186, 0, 0, 0, 0, ''),
(169, 25, 0, 0, 0, 'Non, Siona, tu te trompes...j''ai appris à servir de tout mon coeur l''être le plus solitaire- car unique- de tout l''univers...(prendre de force les Mémoires)', 0, 1, 187, 0, 0, 0, 0, ''),
(170, 2, 0, 0, 0, 'J''ai retrouvé les mémoires...', 0, 0, 188, 0, 0, 0, 0, ''),
(171, 1, 0, 0, 0, 'Excusez ma fille, elle a perdu bien des compagnons de rébellion...', 0, 0, 190, 0, 0, 0, 0, ''),
(172, 1, 0, 0, 0, 'Oui mon Seigneur...*pause*...Vous avez du connaître beaucoup de rébellion, mon Seigneur...', 0, 1, 191, 0, 0, 0, 0, ''),
(173, 1, 0, 0, 0, 'J''imagine vos voyages intérieurs, mon Seigneur', 0, 1, 192, 0, 0, 0, 0, ''),
(174, 1, 0, 0, 0, 'Pas vous, mon Seigneur. Certainement pas vous.', 0, 1, 193, 0, 0, 0, 0, ''),
(175, 1, 0, 0, 0, 'Je ne voulais pas vous mettre en colère, mon Seigneur', 0, 1, 194, 0, 0, 0, 0, ''),
(176, 1, 0, 0, 0, 'Pardonnez-moi ma présomption, mon Seigneur', 0, 1, 195, 0, 0, 0, 0, ''),
(177, 1, 0, 0, 0, 'Je ne comprends pas, mon Seigneur (enhardit)', 0, 1, 196, 0, 0, 0, 0, ''),
(178, 1, 0, 0, 0, 'Mes connaissances n''englobent pas tout ces titres, mon Seigneur', 0, 1, 197, 0, 0, 0, 0, ''),
(179, 1, 0, 0, 0, 'Comme l''ordonnera mon Seigneur', 0, 1, 198, 0, 0, 0, 0, ''),
(180, 1, 0, 0, 0, 'C''est ce que vous m''avez enseigné, mon Seigneur', 0, 1, 199, 0, 0, 0, 0, ''),
(181, 1, 0, 0, 0, 'Je suis désolé au sujet de Siona', 0, 0, 200, 0, 0, 0, 0, ''),
(182, 1, 0, 0, 0, 'Pouruqoi ai-je peur d''elle, dans ce cas, mon Seigneur ?', 0, 1, 201, 0, 0, 0, 0, ''),
(183, 1, 0, 0, 0, 'Mais j''ignore la raison de cette peur !', 0, 1, 202, 0, 0, 0, 0, ''),
(184, 1, 0, 0, 0, 'Je ne vous comprends pas, mon Seigneur', 0, 1, 203, 0, 0, 0, 0, ''),
(185, 1, 0, 0, 0, 'Que viennent faire les couleurs dans tout cela, mon Seigneur ?', 0, 1, 204, 0, 0, 0, 0, ''),
(186, 1, 0, 0, 0, 'Mais vous voyez des choses que nous ne voyons pas, mon Seigneur !', 0, 1, 205, 0, 0, 0, 0, ''),
(187, 1, 0, 0, 0, 'Mon Seigneur, je sais que vous avez évolué bien au-delà du reste d''entre nous. C''est la raison pour laquelle nous vous vénérons et...', 0, 1, 206, 0, 0, 0, 0, ''),
(188, 1, 0, 0, 0, 'Elle est ixienne, mon Seigneur. Peut-être que...', 0, 1, 207, 0, 0, 0, 0, ''),
(189, 1, 0, 0, 0, 'Comment serait-ce possible, Mon Seigneur ? Vos truitesses...', 0, 1, 208, 0, 0, 0, 0, ''),
(190, 1, 0, 0, 0, 'Mon Seigneur...je ne peux pas ! (tremblements) Je n''ai pas votre connaissance de...', 0, 1, 209, 0, 0, 0, 0, ''),
(191, 1, 0, 0, 0, 'Encore merci, mon Seigneur', 0, 0, 210, 0, 0, 0, 0, ''),
(192, 1, 0, 0, 0, 'Mon Seigneur ?', 0, 1, 211, 0, 0, 0, 0, ''),
(193, 1, 0, 0, 0, 'Bien sûr, mon Seigneur', 0, 1, 212, 0, 0, 0, 0, ''),
(194, 2, 0, 0, 0, 'Ma fille s''est enfuie avec les mémoires...', 0, 0, 0, 0, 0, 0, 0, '');

-- --------------------------------------------------------

--
-- Structure de la table `multi_condition`
--

CREATE TABLE IF NOT EXISTS `multi_condition` (
  `mu_id` int(255) NOT NULL AUTO_INCREMENT,
  `mu_id_lien` int(255) NOT NULL,
  `mu_id_quete` int(255) NOT NULL,
  `mu_id_perso` int(255) NOT NULL,
  `mu_id_ext` int(255) NOT NULL,
  PRIMARY KEY (`mu_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `multi_condition`
--

INSERT INTO `multi_condition` (`mu_id`, `mu_id_lien`, `mu_id_quete`, `mu_id_perso`, `mu_id_ext`) VALUES
(1, 2, 4, 2, 3),
(2, 2, 4, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `multi_maj`
--

CREATE TABLE IF NOT EXISTS `multi_maj` (
  `mum_id` int(255) NOT NULL AUTO_INCREMENT,
  `mum_id_lien` int(255) NOT NULL,
  `mum_id_quete` int(255) NOT NULL,
  `mum_id_perso` int(255) NOT NULL,
  `mum_id_ext` int(255) NOT NULL,
  PRIMARY KEY (`mum_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `multi_maj`
--

INSERT INTO `multi_maj` (`mum_id`, `mum_id_lien`, `mum_id_quete`, `mum_id_perso`, `mum_id_ext`) VALUES
(1, 2, 1, 2, 0),
(2, 2, 1, 4, 0);

-- --------------------------------------------------------

--
-- Structure de la table `objet`
--

CREATE TABLE IF NOT EXISTS `objet` (
  `obj_id` int(11) NOT NULL AUTO_INCREMENT,
  `obj_commentaire` varchar(255) NOT NULL,
  `obj_nom` varchar(255) NOT NULL,
  `obj_image` varchar(255) NOT NULL,
  `obj_dbl` text NOT NULL,
  PRIMARY KEY (`obj_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Contenu de la table `objet`
--

INSERT INTO `objet` (`obj_id`, `obj_commentaire`, `obj_nom`, `obj_image`, `obj_dbl`) VALUES
(1, 'Porte chambre', 'Cle', 'clef.png', 'if ( $(''#porte_2'').length){\r\nopenDoorLoin(1, 1);\r\najaxClef(1, 1, 1);\r\n$(this).hide();\r\n}'),
(2, 'Boussole', 'Boussole', 'boussole.png', 'if ( $(''#desert1'').length || $(''#desert2'').length || $(''#desert3'').length){\r\nreturnVillage();\r\n}'),
(3, 'Fiole d''hormomes', 'Fiole d''hormomes', 'fiole.jpg', 'if ( $(''#client1'').length || $(''#bar'').length==false){}else{\r\nrecompenseDisplay(''Vous versez le contenu de la fiole d\\''hormones dans le verre de l\\''ambassadeur'');\r\nhormones();\r\n$(this).hide();\r\n}'),
(4, 'Liqueur d''épice', 'Liqueur d''épice', 'liqueur.png', ''),
(5, 'Tournevis', 'Tournevis laser', 'tournevis.png', 'if ( $(''#barfond'').length){\r\nmv_nuage();\r\n$(this).hide();\r\nrecompenseDisplay(''Vous cassez le dispositif d\\''aération du bar'');\r\n}'),
(6, 'indice', 'indice', 'indice.png', 'openIndice();\r\n'),
(7, 'Réacteur', 'Réacteur', 'reacteur.png', ''),
(8, 'Distille', 'Distille', 'distille.png', ''),
(9, 'Puce linguistique', 'Puce linguistique', 'puce.png', ' 	if ( $(''#village4'').length){\r\nlearnLang();\r\n$(this).hide();\r\nrecompenseDisplay(''Vous apprenez les rudiments du langage Chakobsa'');\r\n}'),
(10, 'Krys', 'Krys', 'krys.png', ''),
(11, 'Lettre de menace', 'Lettre de menace', 'menace.jpg', ''),
(12, 'Laser', 'Laser', 'laser.jpg', ''),
(13, 'poesies', 'poesies', 'poesies.jpg', ''),
(14, 'Preuves', 'preuves', 'preuves.jpg', ''),
(15, 'Memoires', 'Memoires', 'memoires.jpg', '');

-- --------------------------------------------------------

--
-- Structure de la table `objet_user`
--

CREATE TABLE IF NOT EXISTS `objet_user` (
  `obu_id` int(11) NOT NULL AUTO_INCREMENT,
  `obu_id_objet` int(11) NOT NULL,
  `obu_id_user` int(11) NOT NULL,
  PRIMARY KEY (`obu_id`),
  UNIQUE KEY `obu_id_objet` (`obu_id_objet`,`obu_id_user`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Contenu de la table `objet_user`
--


-- --------------------------------------------------------

--
-- Structure de la table `personnage`
--

CREATE TABLE IF NOT EXISTS `personnage` (
  `pers_id` int(255) NOT NULL AUTO_INCREMENT,
  `pers_nom` varchar(255) NOT NULL,
  `pers_faction` int(255) NOT NULL,
  PRIMARY KEY (`pers_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Contenu de la table `personnage`
--

INSERT INTO `personnage` (`pers_id`, `pers_nom`, `pers_faction`) VALUES
(1, 'Leto II', 1),
(2, 'Nayla', 2),
(3, 'SayyaOto', 2),
(4, 'Aloa', 2),
(5, 'representant_guesserit', 3),
(6, 'representant_tleilax', 4),
(7, 'representant_ix', 5),
(8, 'representant_guilde', 6),
(9, 'commandant', 2),
(10, 'surplus', 2),
(11, 'Rahuyta', 2),
(12, 'garde_couloir_1', 2),
(13, 'barman', 1),
(14, 'client1', 2),
(15, 'soeur_1', 3),
(16, 'vendeur_1', 2),
(17, 'client_2', 2),
(18, 'fremen1', 3),
(19, 'Tarhani', 4),
(20, 'Hwitaka', 2),
(21, 'linguiste', 5),
(22, 'Karaguhl', 1),
(23, 'menace_guilde', 6),
(24, 'contact', 2),
(25, 'Siona', 2),
(26, 'fremen2', 3);

-- --------------------------------------------------------

--
-- Structure de la table `porte`
--

CREATE TABLE IF NOT EXISTS `porte` (
  `por_id` int(11) NOT NULL AUTO_INCREMENT,
  `por_id_salle` int(11) NOT NULL,
  `por_id_type` int(11) NOT NULL,
  PRIMARY KEY (`por_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Contenu de la table `porte`
--

INSERT INTO `porte` (`por_id`, `por_id_salle`, `por_id_type`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 8, 2),
(4, 16, 1),
(5, 15, 1),
(6, 15, 1),
(7, 15, 1),
(8, 15, 1);

-- --------------------------------------------------------

--
-- Structure de la table `porte_user`
--

CREATE TABLE IF NOT EXISTS `porte_user` (
  `poru_id` int(11) NOT NULL AUTO_INCREMENT,
  `poru_id_porte` int(11) NOT NULL,
  `poru_id_user` int(11) NOT NULL,
  `poru_etat` int(11) NOT NULL,
  PRIMARY KEY (`poru_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `porte_user`
--

INSERT INTO `porte_user` (`poru_id`, `poru_id_porte`, `poru_id_user`, `poru_etat`) VALUES
(1, 1, 12, 0),
(2, 2, 12, 0),
(3, 3, 12, 0),
(4, 4, 12, 0),
(5, 5, 12, 0),
(6, 6, 12, 1),
(7, 7, 12, 1),
(8, 8, 12, 1);

-- --------------------------------------------------------

--
-- Structure de la table `quote`
--

CREATE TABLE IF NOT EXISTS `quote` (
  `quo_id` int(255) NOT NULL AUTO_INCREMENT,
  `quo_id_perso` int(255) NOT NULL,
  `quo_maj_quete` int(255) NOT NULL,
  `quo_maj_quete_perso` int(255) NOT NULL,
  `quo_maj_quete_id_ext` int(255) NOT NULL,
  `quo_quote` text NOT NULL,
  `quo_humeur` varchar(55) NOT NULL,
  `quo_reponse` int(255) NOT NULL,
  `quo_id_multiple` int(255) NOT NULL,
  `quo_nb_multiple` int(255) NOT NULL,
  `quo_recompense_multi` int(11) NOT NULL,
  `quo_recompense_nb_multi` int(11) NOT NULL,
  `quo_fnctn` text NOT NULL,
  PRIMARY KEY (`quo_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=215 ;

--
-- Contenu de la table `quote`
--

INSERT INTO `quote` (`quo_id`, `quo_id_perso`, `quo_maj_quete`, `quo_maj_quete_perso`, `quo_maj_quete_id_ext`, `quo_quote`, `quo_humeur`, `quo_reponse`, `quo_id_multiple`, `quo_nb_multiple`, `quo_recompense_multi`, `quo_recompense_nb_multi`, `quo_fnctn`) VALUES
(1, 2, 0, 0, 0, 'Je me nomme Nayla, chef truitesse au service de l''empereur-dieu LETO ATREIDES II///Il règne en tyran depuis plus de 300 décennies sur l''univers connu///Toutes les grandes maisons lui font la cour dans l''espoir de recevoir une part d''épice///L''Empereur-dieu les tiens ainsi par la ou ca fait le plus mal.../// leur cupidité !///', '0', 0, 0, 0, 0, 0, '/*$persos=new Customer_Model_Mapper_User();\r\n$nbInfluence=$persos->getInfluenceFaction(3);\r\nif($nbInfluence< 2){\r\n$maj=0;\r\n$quoteRendu[''quo_id_multiple'']=0;\r\n$quoteRendu[''quo_recompense_multi'']=0;\r\n$text=''Mmmmh...revenez quand vous aurez plus de pion Influences///pour desservir ma faction!'';\r\n}*/'),
(3, 2, 1, 2, 3, 'D''abord, prenez cette boussole, sur Dune, tout le monde en possède une...question de survie...Une boussole vous rappellera toujours le chemin du retour...Ensuite...///Pourriez vous demander au scribe de l''empereur de vérifier si les Mémoires de son altesse sont bien à leur place ?///Ces mémoires sont très précieuses pour notre Empereur-dieu LETO II///elles contiennent des centaines de décennies de pensées intimes///Sa seigneurerie n''est jamais seule, la Mémoire Seconde l''accompagne partout///il a prit l''habitude de noter ses "incursions" mentales dans ce registre...///je ne suis jamais rassuré quand je pense à ses mémoires... si jamais un jour quelqu''un se les procurait...///tout les secrets que ces mémoires renferment....///', '', 0, 0, 0, 0, 0, ''),
(5, 3, 0, 0, 0, 'Scribe officiel de l''empereur, au rapport !///', '0', 0, 0, 0, 0, 0, ''),
(8, 3, 0, 0, 0, 'Le registre est bien à sa place rangé dans les archives du palais... ///il ne faudrait pas que ce livre tombe entre de mauvaises mains///notre cher LETO II règne depuis bien longtemps, il a eu le temps de se faire des ennemis///ceux qui ne comprennent pas la raison de son despotisme forcé cherchent par tout les moyens de lui faire du mal ///assurément, ce mémoire ferait une arme redoutable entre de mauvaises mains...///mais faites donc savoir à la chef truitesse qu''il n''y a pas lieu de s''inquiéter///', '', 0, 0, 0, 0, 0, ''),
(9, 2, 4, 2, 3, 'Merci bien ! je vais envoyer le scribe chercher le journal///l''Empereur-dieu me le réclamait encore hier soir...tenez, voici la clef qui mène à l''aile administrative du palais... pour utiliser un objet, double-cliquez dessus///', '', 0, 2, 2, 1, 2, ''),
(10, 2, 0, 0, 0, 'qu''en dit le scribe?///j''attend sa réponse///', '0', 0, 0, 0, 0, 0, ''),
(12, 2, 0, 0, 0, 'Arrakis est le nerf du monde de l''imperiuum///qui controle Arrakis controle l''épice///et qui controle l''épice controle l''univers !///', '', 0, 0, 0, 0, 0, ''),
(13, 2, 0, 0, 0, 'Il règne depuis plus de 300 générations///longtemps avant, des vers de sables, générateurs d''épices parcouraient la planète///mais ils ont au fur et à mesure disparu, et il en est resté un, mi-homme, mi-vers, monarque éclairé condamné à la solitude aux dons extraordinaire...///LETO II nous guide ainsi depuis des milliers d''années pour nous préparer à la "Grande Dispersion"///l''Histoire orale est très claire à ce sujet...///', '', 0, 0, 0, 0, 0, ''),
(14, 4, 0, 0, 0, 'Je suis le grand inquisiteur impérial...///chargé de vérifier la bonne marche des procédures de la Cérémonie du Partage, chantre de l''empire de notre bon empereur LETO II///', '0', 0, 0, 0, 0, 0, ''),
(15, 4, 1, 4, 3, 'En effet, J''aurai aimé faire savoir au scribe de l''empereur que je voudrai faire appel à ses services.../// pour qu''il m''apporte les documents attestants de l''ascendance du dernier Duncan...je voudrai être sur qu''il soit génétiquement parfait.../// pour accomplir le plan multi-générationnel de notre empereur...///Le Duncan est le ghola le plus vieux qui existe ! il a combattu aux côtés du père de notre vénérable Empereur-dieu Paul Atreïdes !///', '', 0, 0, 0, 0, 0, ''),
(16, 4, 0, 0, 0, 'Allons, Moneo, vous êtes bien plus qu''un simple majordome...///ne faites pas l''erreur de croire que je ne vous considère pas à votre juste valeur...vous servez l''empereur-dieu depuis près d''un siècle///l''épice que vous absorbez vous donnant une longévité inégalée...personne dans tout l''empire ne peut se targuer...///d''être aussi proche que vous de notre empereur LETO II///', '', -1, 0, 0, 0, 0, ''),
(17, 4, 0, 0, 0, 'Qu''à dit le scribe ?///', '0', 0, 0, 0, 0, 0, ''),
(18, 4, 0, 0, 0, 'Le climat de ce désert artificiel, géré par les ixiens, empêche la nuit de tomber dans cette partie du globe...///l''aridité du Sareer s''en trouve renforcé, conformément aux désirs de l''empereur-dieu LETO II///', '', 0, 0, 0, 0, 0, ''),
(19, 4, 4, 4, 3, 'merci Moneo ! L''empereur a de la chance de pouvoir compter sur un serviteur aussi fidèle que vous///le programme génétique est tellement important aux yeux de l''empereur///', '0', 0, 2, 2, 1, 2, ''),
(20, 4, 0, 0, 0, 'Qu''y''a t''il cher Moneo ?///', '0', 0, 0, 0, 0, 0, ''),
(21, 3, 3, 4, 3, 'Mmmmh...le programme génétique du Duncan est complexe.../// et l''Empereur-Dieu prend un soin tout particulier à regénérer depuis plus de 3000 ans son ancien mentor...///Il le fait se reproduire avec des femelles triées sur le volet et leur descendance est soumise à une stricte surveillance de la part de notre empereur///nul ne connaît encore la raison précise de se programme génétique...///mais dites donc au grand inquisiteur que j''irai chercher les documents nécessaires à une vérification///', '', 0, 0, 0, 0, 0, ''),
(22, 2, 0, 0, 0, 'Quoi encore ? que me cherchez vous ?///', '0', 0, 0, 0, 0, 0, ''),
(23, 2, 0, 0, 0, 'Il faudrait  que vous fassiez des efforts vis à vis de notre maison...///Je ne vous fais pas assez confiance actuellement///', '', 0, 0, 0, 0, 0, ''),
(24, 9, 0, 0, 0, 'Je suis le commandant de votre flotte spatiale///je m''occupe des expéditions///', '', 0, 0, 0, 0, 0, ''),
(25, 10, 0, 0, 0, 'Je m''occupe de la vente des vaisseaux///saisissez le nombre de vaisseaux que vous voulez acheter...///', '', 0, 0, 0, 0, 0, ''),
(26, 12, 0, 0, 0, 'Salutations, Moneo///Je suis l''agent chargé de la sécurité de LETO II///Vous désirez un renseignement ?///', '', 0, 0, 0, 0, 0, ''),
(27, 12, 0, 0, 0, 'Un des moyens les plus simple est de conquérir de nouvelles planètes grâce aux vaisseaux militaires///Vous pouvez en acheter dans la salle de commandement au fond du couloir///Tout le landstraad s''en trouverait ébranlé si nous n''avions plus assez d''épice pour la cérémonie du partage...///', '', 0, 0, 0, 0, 0, ''),
(28, 12, 0, 0, 0, 'Le meilleur moyen de gagner de l''influence vis à vis des différentes maisons est de satisfaire les demandes des représentants///il savent se montrer généreux dans leur récompense///ils peuvent vous faire gagner des Serviteurs, des Points d''influence ou bien des Escortes///libre à vous ensuite de les affilier à la maison de votre choix...///Plus vous serez attentif à leur demande, plus les grandes maisons se confieront et auront confiance...les représentants qui se sentent en confiance ont toujours tendance à se confier un peu plus...///', '0', 0, 0, 0, 0, 0, ''),
(29, 5, 0, 0, 0, 'Je représente la noble maison Guesserit///notre règne ancien était grandiose, jusqu''à l''arrivée de LETO II///nous voila aujourd''hui réduit à quémender notre épice///mais tout n''est pas encore joué...///', '', 0, 0, 0, 0, 0, '$sl=Application_Common::getSalle();\r\nif($sl==1)$quoteRendu[''quo_reponse'']=-1;'),
(30, 6, 0, 0, 0, 'Nunepti, de la maison Tleilax...///La maison Tleilax est, et sera toujouurs dévoué à l''Empereur-dieu de Dune///nous espérons plus d''épice de la part de notre empereur///peut-être pourriez vous lui en toucher un mot ?///', '', 0, 0, 0, 0, 0, '$sl=Application_Common::getSalle();\r\nif($sl==1)$quoteRendu[''quo_reponse'']=-1;'),
(31, 7, 0, 0, 0, 'La maison IX est heureuse de participer à la cérémonie du partage///même notre technologie ultra-avancée est dépendante de l''épice fourni parcimonieusement par notre vénérable Empereur-dieu...///', '0', 0, 0, 0, 0, 0, 'if($retur=Application_Common::getObject(11))\r\n$text=''Avez-vous trouvé l\\''auteur de la lettre de menace ?///'';'),
(32, 8, 0, 0, 0, 'blub...blub...///nos vaisseaux ont besoin du mélange...///le précieux mélange...blub...l''épice, le coeur de l''univers !///', '0', 0, 0, 0, 0, 0, ''),
(33, 4, 0, 0, 0, 'La cérémonie du partage est le garant de la paix de LETO...///continuons à fournir aux maisons de l''épice, et elles nous seront à jamais soumises...///', '0', 0, 0, 0, 0, 0, ''),
(34, 2, 0, 0, 0, 'Vous désirez ? /// l''empereur est bien triste...///normal, dans ce monde de péché...///', '0', 0, 0, 0, 0, 0, '/*echo"<script>musicBox(''fond2.mp3'')</script>";*/'),
(35, 2, 0, 0, 0, 'La cérémonie du partage a lieu tout les 5 jours et débute lorsque vous cliquez sur le diamant situé au dessus du trône...///cette cérémonie est le nerf de tout l''Impériuum///toute les grandes maisons viennent demander leur portion d''épice à l''Empereur-dieu LETO II///si nos caisses ne peuvent pas supporter leur demandes, alors, c''en est fini de nous tous !///votre travail est de gérer le stock d''épice pour qu''un tel scénario ne se réalise jamais ! ///', '0', 0, 0, 0, 0, 0, ''),
(36, 2, 0, 0, 0, 'Je vous salue///', '3', 0, 0, 0, 0, 0, ''),
(37, 3, 1, 3, 3, 'Jadis, avant l''avènement de l''Empereur tyran, l''Imperiuum était constitué de multiples maisons...///Ces maisons passaient leur temps à se faire la guerre, et toutes se battaient au nom de l''épice...///Mais depuis maintenant plus de 3000 ans, règne la "Paix forcé" imposée par notre empereur...///Les Atréïdes, en sont sorti grandi, mais bon nombre de maisons n''ont pas su s''adapter et ont sombrées...///ils ne restent maintenant plus que 4 autres grandes maisons ...///les Ixiens, les Bene Guesserit, les Bene Tleilax et la Guilde///', '0', 0, 0, 0, 0, 0, ''),
(38, 3, 3, 3, 3, 'Les Tleilaxu sont des êtres vils et retords, spécialisés dans les manipulations génétiques...///au cours de ces dernières centaines d''année, ils ont plusieurs fois envoyés leur maître assassins pour essayer d''assassiner l''Atréides Leto II...///mais à chaque tentative, l''empereur a su parer et envoyer ses truitesses pour punir les tleilaxu...///cela fait maintenant quelques dizaines d''années qu''ils se tiennent plus tranquille...méfiance...///', '0', 0, 0, 0, 0, 0, ''),
(39, 3, 0, 0, 0, 'La Guilde Spatiale fut créée en l’an 0 du calendrier impérial///Leurs vaisseaux sont dirigés par des Navigateurs dépendant de l''épice et propulsés par des générateurs Holtzmann///Ce sont des gros consommateurs d''épice, ils saturent leur pilotes du précieux mélange...///pour leur permettre d''accéder à un certain niveau de prescience, afin de plier l''espace Temps...///et de voyager à travers les étoiles...///ils sont les transporteurs officiels du Landsraad///', '0', 0, 0, 0, 0, 0, ''),
(40, 3, 0, 0, 0, 'Le Bene Gesserit est une organisation féminine et matriarcale de pouvoir spirituel et religieux sans équivalent/// Son emprise sur le pouvoir était incontestable avant l''arrivée de Leto II///L''ordre des Sœurs préfère influencer et agir dans l''ombre plutôt que d''avoir une place active au sein de la société de l''Imperiuum///L''Empereur-dieu de dune s''en méfie, étant donné qu''elles possèdent la Mémoire Seconde/// qui donne accès à la mémoire de tous les ancêtres des Révérendes Mère qui ont composées cette maison///L''empereur possède cette  Mémoire Seconde mais en plus poussé: Il a accès à la mémoire de tout ses ancêtres, hommes ou femmes...///et sait discerner les méandres du futur///mais d''aucuns disent que c''est sa perspicacité et sa longue expérience de l''humanité qui lui permettent de "prévoir" ce qui va arriver...///', '0', 0, 0, 0, 0, 0, ''),
(41, 3, 0, 0, 0, 'Parce que l''Empereur-dieu en a besoin pour ses expériences génétiques sur le Duncan...Comprenez bien ceci :/// Depuis plus de 3000 ans, notre empereur fais renaître son maître d''arme Duncan Idaho, seul témoin d''un temps à jamais révolu...///il le sert fidèlement une cinquantaine d''années, pui presque systématiquement, il finit par se rebeller contre son maître...///il se fait tuer et notre empereur le refait naître...///ne voyez rien de barbare la dedans, à chaque nouveau Duncan, l''empereur lui explique sa condition et ne lui cache rien...///n''essayez pas de comprendre les plans d''un niveau supérieur de notre empereur, il a ses raisons et il est le seul à se comprendre...///', '0', 0, 0, 0, 0, 0, ''),
(42, 3, 1, 3, 3, 'Plusieurs maison ont du mal à accepter cette Paix Forcée imposée par l''empereur...///ils complotent contre son "Sentier d''Or", sa vision pacifiste de l''univers imperiuum...///Une fois, ils ont envoyé un Duncan deffectueux programmé pour surprendre et tuer l''empereur...///mais celui-ci, grâce à la prescience ? s''en est aperçu et l''a renvoyé aux cuves Axolotl pour qu''ils en remodèlent un autre...///sa colère était épouvantable, et les tleilax depuis se tiennent à leur place...///mais patience, mon ami, patience...///', '0', 0, 0, 0, 0, 0, ''),
(43, 3, 0, 0, 0, 'La maison Ix est la maison la plus avancée technologiquement///créateurs des machines pensantes, à l''origine du Jihad Butlérien, les ixiens ont des interêts commun avec la Guilde spatiale...///ils essayent de résoudre technologiquement un problème que toute les maisons se posent:///mais que faire donc pour ne plus avoir à se soumettre au joug de paix forcé créé par l''empereur Atréides Leto II ?///', '0', 0, 0, 0, 0, 0, ''),
(44, 3, 0, 0, 0, 'Le tableau de bord est un des endroits les plus vitales du palais impérial...///A partir de cette pièce, il vous est possible de répartir les Points d''influence, les Serviteurs et les Escortes aux différentes maisons...///un Serviteur augmente la confiance de la maison à votre égard de 50 points...///les Points d''influences permettent de gagner plus de points de renommée à chaque cérémonie du partage...///le curseur à droite, permet de savoir quelle quantité d''épice vous voulez donner à la maison lors de la cérémonie de partage...///plus vous en donnez, plus vous recevez de renommée, d''autant plus que vous avez de Points d''influence affilié à la maison...///les Escortes protègent de leur vie les Serviteurs...une maison sans Escorte expose ses Serviteurs à toute sorte de danger...///', '0', 0, 0, 0, 0, 0, ''),
(45, 13, 0, 0, 0, 'Qu''est ce que j''vous sers ?///', '0', 0, 0, 0, 0, 0, ''),
(46, 13, 0, 0, 0, 'On raconte qu''un danseur-visage se serait glissé dans le palais...///', '0', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(4,7,1);\r\nif($retur)\r\n$text=''Un louche individu traîne aux abords du bar entre minuit et 6h00///je ne lui fais pas confiance...///'';\r\n$retur=Application_Common::getMajQueste(1,7,2);\r\nif($retur)\r\n$text=''J\\''ai entendu dire que l\\''ambassadeur Tleilaxu était très intéressé par la poésie et les beaux arts...///'';'),
(47, 13, 0, 0, 0, 'Toutes les maisons se trainent à demander l''aumône à notre bien aimé Tyran///elles en sont réduites à faire des courbettes pour espérer une dose du mélange qui leur permet de subsister...///mais posez vous donc la question...///depuis combien de temps ces anciennes grandes maisons ne se sont pas fait la guerre ?///', '0', 0, 0, 0, 0, 0, ''),
(48, 13, 2, 13, 1, 'Je ne supporte pas les Bene Guesserit...///ces vieilles sorcières sont bien trop rigides pour dépenser le moindre épice autour d''un verre dans un bar...///d''ailleurs...maintenant que vous m''y faites penser...pourriez vous me rendre un service ?///', '0', 0, 0, 0, 0, 0, ''),
(49, 13, 4, 13, 1, 'Voila, un jour, une de ces sorcières est venue dans mon bar et semblait visiblement très troublée...///d''habitude si rigides et opaques, celle-ci s''est effondrée au bar et m''a commandée mon meilleur rhum d''épice...///de ma vie, jamais je n''avais vu de Bene Guesserit dans un état pareil...///elles ont un niveau de maitrîse de soit absolument inimaginable, comprenez bien...///et elle s''est mise à parler sur ce qui l''avait mis dans un état pareil...///', '0', 0, 0, 0, 0, 0, ''),
(50, 13, 5, 13, 1, 'Elle venait d''avoir une entrevue avec l''Empereur-dieu...///elle était avec son mentor, car ces sorcières Guesserit marchent toujours par deux...///pour demander une augmentation d''épice au Tyran, et elle m''expliquait qu''elle avait essayer d''introduire une fiole d''épice concentrée...///dans les plis de sa robe pour vérifier si le Tyran souffrait d''un point faible lorsqu''il était confronté à une dose concentrée du mélange...///en effet, certaines créatures réagissent très mal au contact de l''épice concentré...///toujours est-il que son auguste altesse s''en est aperçu et l''a...comment dire...remise à sa place...///', '0', 0, 0, 0, 0, 0, ''),
(51, 13, 6, 13, 1, 'Figurez vous qu''il ne lui a rien fait, si ce n''est qu''il lui a longuement parlé et sévèrement mis en garde...///le Tyran a toujours trouvé les Bene Guesserit plus interessantes que les autres...///il ont beaucoup en commun...///il se plait à rappeler qu''elles sont bien trop dangereuse pour qu''il leur lache plus d''épice que la portion allouée actuellement...///toujours est il qu''après cette entrevue, elle était tellement choqué de ne pas être morte ou pire même, qu''elle s''est assise dans mon bar...///et n''a pas payé ses consommations...remmenez moi mon dû et je vous donnerais un objet qui ne me sert plus depuis bien longtemps///', '0', 0, 0, 0, 0, 0, '$quotes=new Core_Model_Mapper_Quote();\r\n$quotes->putArretQuoteMoneo(56);\r\n$quotes->putArretQuoteMoneo(55);'),
(52, 13, 0, 0, 0, 'Alors? vous avez l''argent?///', '0', 0, 0, 0, 0, 0, ''),
(53, 5, 0, 0, 0, 'DE L''EPIIIIICE !!! TOUJOURS PLUS D''EPIIIIICE !!!///', '0', 0, 0, 0, 0, 0, ''),
(54, 15, 0, 0, 0, ' Je ne connaîtrai pas la peur car la peur tue l''...Bonjour Monéo...///', '0', 0, 0, 0, 0, 0, ''),
(55, 15, 1, 15, 1, 'Je vous prie d''arrêter immédiatement de me parler de ce sujet...///ma mère supérieur pourrait en avoir vent, et je pourrais être radiée de l''ordre...///si vous y tenez, venez me retrouver entre 18 heures et 6 heures à la bibliothèque...///nous pourrons en parler librement...///', '0', -1, 0, 0, 0, 0, '$quotes=new Core_Model_Mapper_Quote();\r\n$perso=new Core_Model_Mapper_Personnage();\r\n$getMaj=$quotes->getMajQuete(1,15,1);\r\n\r\n$getSall=$perso->getPersonnage($idPerso);\r\nif($getSall[''soeur_1''][''pers_salle'']!=12){\r\nif($getMaj)\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}else{\r\n$quoteRendu[''quo_maj_quete'']=2;\r\n$quoteRendu[''quo_reponse'']=0;\r\n$text=''Je suis désolé de n\\''avoir pas pu vous parler tout à l\\''heure devant la chambre de ma Révérende Mère...///mais ce que j\\''ai fais dans ce bar va à l\\''encontre de toutes les règles du Prana-Bindu...///J\\''ai en effet eu un moment de faiblesse, après cette fameuse entrevue avec le Tyran...///mais les informations que j\\''en ai tiré, et ce que j\\''en ai dévoilé à mes soeurs valent largement les risques que j\\''ai pris...///nous savons maintenant le Tyran immunisé contre une arme à l\\''épice...mais patience...un jour, nous découvrirons son point faible...///'';\r\n}\r\n'),
(56, 15, 0, 0, 0, 'Nous autres membres du Bene Gesserit avons, après notre initiation, accès un enseignement spécifique très poussé...///ainsi qu''à plusieurs disciplines et capacités spéciales, qui font de nous des adversaires autant craintes que respectées///Ces diverses connaissances ont été développées et codifiées jalousement au fil des millénaires par nos Sœurs.../// et demeurent un des secret les mieux gardés de l''Ordre/// L''importance et la valeur du Bene Gesserit par rapport aux autres factions qui s''agitent dans l''Imperiuum vient en grande partie de cet enseignement///Preuve de notre valeur, nos ennemis nous ont attribué le surnom de Sorcières du Bene Gesserit...///enfin tout ceci a largement été amoindri avec « la Paix de Leto » qui nous écrase sous sa domination permanente depuis plus de 3000 ans...///', '0', 0, 0, 0, 0, 0, ''),
(57, 15, 1, 15, 2, 'J''ai en horreur la maison Tleilaxu...mais méfiez-vous...///on dit qu''un danseur-visage s''est glissé dans le palais...///je serais le grand inquisiteur impérial, je me méfierai...///en effet, les tleilaxu ont tout intérêt à supprimer un tel obstacle dans leur course effréné du pouvoir...///', '', 0, 0, 0, 0, 0, ''),
(58, 15, 2, 15, 2, 'les Danseurs-Visages sont des êtres polymorphes utilisés surtout en tant qu’assassins///ils sont des créations des Tleilaxu, peuple spécialisé dans la génétique et les manipulations diverses///un Danseur-Visage est une sorte de caméléon humain pouvant à son gré transformer son apparence et sa voix. Ils sont hermaphrodites et stériles///se sont les assassins les plus redoutable de tout l''imperiuum///', '0', 0, 0, 0, 0, 0, ''),
(59, 15, 3, 15, 2, 'Les Bene Guesserit ont appris avec le temps à les reconnaître...voyez-vous, ils ont une particularité subtile...qui les rend...différent///je pourrais vous donner cette subtilité...mais en échange d''un petit service...///', '0', 0, 0, 0, 0, 0, ''),
(60, 15, 4, 15, 2, 'Les Bene Guesserit, tout comme le Tyran Leto II s''interessent de très près à la génétique...nous avons de notre côté nous aussi recours à la manipulation génétique...///c''est ainsi qu''indirectement Leto II a vu le jour, étant le fils du kwisatz haderach...///dernièrement, nous avons commis une erreur génétique en réutilisant des ambrions Corrino...///cette ancienne noble maison qui régna des centaines d''années avant l''avènement de Paul Atréïdes ne nous interesse plus...///or, un rejeton Corrino se trouve encore dans ce palais, fruit d''une expérience ratée dans nos calcul générationnel. Trouvez le...///et versez le contenu de cette fiole d''hormone dans son verre...///cette fiole le rendra stérile sitôt qu''il en aura bu le contenu...///faites en sorte qu''il la boive, et je vous donnerai le détail vous permettant de reconnaïtre un danseur-visage...///', '0', -1, 0, 0, 0, 0, ''),
(61, 15, 0, 0, 0, 'Alors ? le Corrino a bu son verre ?///', '0', 0, 0, 0, 0, 0, ''),
(62, 15, 3, 15, 1, 'Merci de votre compréhension...///le Bene Guesserit, à travers moi, vous est reconnaissant...veuillez transmettre mes salutations à notre cher Tyran...///', '', -1, 0, 0, 0, 0, '$perso=new Core_Model_Mapper_Quote();\r\n$perso->majQuete(7,13,1);'),
(63, 15, 4, 15, 1, 'Monéo...votre réputation serait-elle usurpée ? vous, le plus proche serviteur du Tyran, connu pour son intégrité morale, en êtes réduit au chantage ?///les affres du Bene Guesserit ne vous font donc pas peur ? je dois avouer que je suis à votre merci... il en sera donc ainsi///', '', -1, 0, 0, 0, 0, '$perso=new Core_Model_Mapper_Quote();\r\n$perso->majQuete(7,13,1);'),
(64, 13, 8, 13, 1, 'Merci Moneo! ca fait plaisir de pouvoir compter sur des hommes de confiance...///on dira ce qu''on voudra du Tyran, mais il sait s''entourer d''hommes intègres...///il doit me rester de la liqueur d''épice forte...un breuvage rare et de très bon goût! prenez le, j''insiste, il est à vous!///', '', -1, 0, 0, 0, 0, '$user=new Customer_Model_Mapper_User();\r\n$us=new Customer_Model_User();\r\n$user->find(0, $us);\r\n$myEpice=$us->getEpice();\r\nif($myEpice<500){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$text=''Haaaa...non, désolé, le compte n\\''y est pas...revenez quand vous aurez plus d\\''argent!///'';\r\n}'),
(65, 14, 1, 14, 1, 'grnf...rrrf...argnf...///', '', -1, 0, 0, 0, 0, '$gtq=Application_Common::getMajQueste(2,14,1);\r\nif($gtq)\r\nApplication_Common::majQueste(1,14,1);\r\n\r\n$perso=new Core_Model_Mapper_Personnage();\r\n$myObj=$perso->getObjet(4);\r\nif($myObj){\r\n$quoteRendu[''quo_reponse'']=0;\r\n$text=''armpf...mais que vois-je donc? de la liqueur d\\''épice? mmmh...laissez-moi vous en délester...///'';\r\n}else\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n\r\n$quotes=new Core_Model_Mapper_Quote();\r\n$perso=new Core_Model_Mapper_Personnage();\r\n$getMaj=$quotes->getMajQuete(1,14,1);\r\n$getMaj2=$quotes->getMajQuete(4,14,1);\r\nif($getMaj || $getMaj2)\r\n$quoteRendu[''quo_reponse'']=0;\r\n'),
(66, 14, 2, 14, 1, 'Si vous saviez...halalala...///Je me nomme Trokir, ambassadeur, je viens de la planète Corrin ou les truitesses du Tyran gouvernent d''une main de fer...///En tant que haut-conseiller impérial, en raison de ma haute lignée d''ascendant datant d''avant la guerre de Corrin.../// je suis obligé de séjourner dans ce palais...///ce palais que j''excècre, ou se joue toutes les intrigues et les complots pour ramasser le plus d''épice possible...///dernièrement, j''ai été approché par les soeur du Bene Guesserit...///elles ont fait des calculs génétiques et elles voulaient me faire passer des tests...///mais quelque chose n''a pas fonctionné///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(4,15,2);\r\n\r\nif(!$retur)\r\n$quoteRendu[''quo_reponse'']=-1;'),
(67, 14, 0, 0, 0, 'Le Sentier d''Or ? hahaha...///un alcoolique comme moi n''en a qu''une très vague idée...///le Sentier d''Or...le fameux Sentier d''Or...///voila plus de 3000 ans que Leto II règne en tyran absolue, imposant sa paix forcée...///grâce à ses fidèles truitesses qui seules, utilisent des engins motorisés...///mais je ne vous apprends rien, Moneo, vous, le plus proche des serviteurs de Leto II...///mais tout ceci...tout ceci...au nom du Sentier d''Or...au nom du Secher Nbiw, en language Fremen...sensé prévenir et sauvegarder l''humanité...je ne sais que penser sur ce point ///', '', 0, 0, 0, 0, 0, ''),
(68, 14, 1, 14, 1, 'Je...je devais m''accoupler avec une des \r\nsoeur Bene Guesserit sélectionnée d''après son patrimoine génétique...///j''ai refusé...tout ceci me paraissait malsain...///et maintenant, vous devez sans doute vous demander quel est le but de ces sélections génétiques? je n''en sais rien moi-même...///', '', 0, 0, 0, 0, 0, ''),
(69, 14, 0, 0, 0, 'Hé...non merci, j''aime prendre mes liqueurs sans nectar...///', '', 0, 0, 0, 0, 0, ''),
(70, 12, 1, 12, 1, 'Vous avez un suspect ?///', '', 0, 0, 0, 0, 0, ''),
(71, 12, 2, 12, 1, 'L''ambassadeur de Corrin ? cela me paraît fort étrange...mais ne courons aucun risque...///je vais le mandater pour le questionner au sujet de ce soupçon qui pèse sur lui...///on n''est jamais trop prudent...///', '', 0, 0, 0, 0, 0, '$perso=new Core_Model_Mapper_Personnage();\r\n$perso->mouveSalle(14, 2);'),
(72, 12, 0, 0, 0, 'Je suis en plein interrogatoire...///', '0', -1, 0, 0, 0, 0, '$perso=new Core_Model_Mapper_Personnage();\r\n$persoDansSalle=$perso->getPersonnage(14);\r\nif($persoDansSalle[''client1''][''pers_salle'']!=2){\r\n$text=''Je vais mandater sur le champs cet ambassadeur suspect...///'';\r\n}\r\n'),
(73, 12, 0, 0, 0, 'Mmmh...j''ai beau l''interroger, je ne vois rien qui m''inquiète chez cet homme...///je pourrais bien sûr le soumettre à la question gràce à notre droïde ixien de torture...///', '', 0, 0, 0, 0, 0, ''),
(74, 12, 4, 12, 1, 'Ha je vois...mmmmh, c''est fâcheux...///mais venant de vous Monéo, plus proche serviteur de l''Empereur-dieu LETO II, je peux bien prendre sur moi...///ne soyez pas gêné, vous avez fais ce qui vous semblait juste...///je vais donc relacher ce pauvre homme en m''excusant...///', '', -1, 0, 0, 0, 0, 'Application_Common::moveSalle(14, 13);\r\nApplication_Common::majQueste(3,14,1);\r\nApplication_Common::majQueste(2,14,2);'),
(75, 14, 0, 0, 0, 'Ha vous revoila... je ne sais pas ce qui c''est passé...///j''étais assis ici, quand un détachement entier de truitesses m''a sommé l''ordre de les suivre...///je n''ai pourtant rien d''un conspirateur !///', '', 0, 0, 0, 0, 0, ''),
(76, 14, 4, 14, 1, 'Bien parlé, c''est vrai que ça m''a donné soif...glou glou...///mmmh...vraiment fameuse cette liqueur...///', '', 0, 0, 0, 0, 0, 'Application_Common::majQueste(5,15,2);'),
(77, 15, 6, 15, 2, 'Merci Moneo...je vous sais dans la confidence de l''Empereur-dieu...///et même s''il doit sans doute être déjà au courant...///inutile de lui parler du programme génétique qu''entreprennent les soeurs Guesserit...///quant au détail qui pourrai vous servir pour repérer un danseur-visage...je vous mets au courant...///les danseurs-visage...///dégagent une odeur spécifique...subtile, mais reconnaissable si l''on y prête attention...///', '', -1, 0, 0, 0, 0, 'Application_Common::majPortes(5, 1);\r\necho ''<script>\r\nopenDoorLoin(5, 1);</script>'';\r\n'),
(78, 11, 0, 0, 0, 'Conseiller galactique rahuyta, chef diplomate Atréides, à votre service, fidèle Monéo...///', '0', -1, 0, 0, 0, 0, '$diplo=Application_Common::diplomates();\r\n$text.=''///Rapport envoyé sur papier ridulien de notre diplomate envoyé sur ''.$diplo->ca_nom.'', la ''.$diplo->ca_description.'':///'';\r\nif($diplo->ca_diplomate<5){$text.=''"la planète est très primitive, je n\\''ai pas pu installé d\\''ambassade...toute relation diplomatique est inutile...///si vous voulez cette planète, préparez les vaisseaux de combats, aucune solution pacifiste en vue"///'';\r\nApplication_Common::setdiplomateNull($diplo->ca_id, 0);\r\n}\r\nif($diplo->ca_diplomate>15){$text.=''"la planète est très évoluée, pacifique et totalement acquise à notre cause...///l\\''ambassade a été installée, et ils ont hâte de faire partie de notre empire !"///'';\r\nApplication_Common::setdiplomateNull($diplo->ca_id, 1);\r\nApplication_Common::setEpices($diplo->ca_epice, 1);\r\n$epices=0;\r\n$messageFinal='''';\r\neval($diplo->ca_effet_diplo);\r\n$tot=$diplo->ca_epice+$epices;\r\nApplication_Common::displayRecompense($messageFinal.''<tr><td>Total épice reçu : ''.$tot.''</td></tr>'');\r\n}\r\nif($diplo->ca_id=='''')$text=''Rien à signaler pour le moment...///'';'),
(79, 9, 0, 0, 0, 'Les planètes sont des revenus d''épice importants...///pour en conquérir une, il vous faut des vaisseaux que vous pouvez acheter dans le palais///Si vous ne voulez pas prendre de risque lors de l''invasion d''une planète, je vous conseille d''envoyer d''abord un vaisseau d''exploration.../// qui nous renseignera quant à la présence d''une flotte insoumise sur la planète...///si vous possédez assez de vaisseau pour passer à l''attaque, envoyez l''assaut ! il y''aura des pertes, mais...///que ne ferait on pas pour imposer "La Paix de Leto"...///par exemple, Balut est une planète facile d''accès, sans grande armée dessus...///de plus, à chaque prise de possession d''une planète, diplomatiquement, ou par la force, une récompense en épice nous est offerte...///', '', 0, 0, 0, 0, 0, ''),
(80, 9, 0, 0, 0, 'Les diplomates sont un moyen pacifiste de conquérir une planète...///en effet, certaines planètes ne nous sont pas hostiles, et il serait dommage d''user nos force...///alors que la domination peut se faire de manière pacifiste...///les diplomates peuvent ainsi, si le niveau de civilisation de la planète est assez élevé, permettre l''installation d''une ambassade...///pour que la planète nous revienne en toute tranquillité...à un moindre coût...///', '', 0, 0, 0, 0, 0, ''),
(81, 5, 1, 5, 1, 'Mmmh...vous me semblez assez honnête pour que je vous demande un service...///La pièce que vous m''avez allouez, bien que spartiate, me convient tout à fait...///je n''ai jamais aimé les fauteuils en Lochon, mais par contre, je ne vois aucun serviteurs...///mettez au service du Bene Guesserit 2 serviteurs, et je pourrais vous témoigner de la gratitude...///les révérendes mères ne sont pas à prendre à la légère...///', '', -1, 0, 0, 0, 0, ''),
(82, 5, 2, 5, 1, 'Haaa...merveilleux...j''apprécie votre dévouement envers la maison Bene Guesserit...///le Tyran a de la chance de pouvoir compter sur un serviteur de votre acabit...///Veuillez accepter ces modestes présents...///', '', 0, 0, 0, 0, 0, '$persos=new Customer_Model_Mapper_User();\r\n$nbInfluence=$persos->getServiteurFaction(3);\r\nif($nbInfluence< 2){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$text=''Mmmmh...j\\''attends avec impatience la venue prochaine de mes serviteurs...///'';\r\n}else{\r\nApplication_Common::setInfluence(2);\r\n}'),
(83, 5, 3, 5, 1, 'Notre maison n''est pas assez influente envers l''empereur-dieu...///quand je vois que la maison Bene Tleilax est traitée avec autant d''égard que nous...excusez moi un moment...///...voila...///j''ai fait un réajustement moléculaire pour apaiser mon sentiment d''injustice...///les Bene Tleilax...///ces immondes cloportes ne doivent leur survie que parcequ''ils sont les seuls à pouvoir fournir à notre Tyran les Duncan...///faites en sorte que notre maison dispose d''au moins 4 points d''influence ET que l''influence des Bene Tleilax soit inférieur à la notre///Vous serez justement récompensé pour cette petite aide que vous pouvez nous fournir...///', '', -1, 0, 0, 0, 0, ''),
(84, 5, 4, 5, 1, 'Merci Monéo...///ces infâmes Tleilaxu ne sont pas les bienvenu au palais du Tyran...///L''Influence grandissante du Bene Guesserit est maintenant stable et les Tleilaxu s''en trouvent rabaissé...et ils en ont bien conscience !///', '', 0, 0, 0, 0, 0, '$persos=new Customer_Model_Mapper_User();\r\n$nbInfluence=$persos->getInfluenceFaction(3);\r\n$nbInfluenceTleilax=$persos->getInfluenceFaction(4);\r\nif($nbInfluence>= 4 && $nbInfluence > $nbInfluenceTleilax){\r\nApplication_Common::setEpices(7000);\r\n}else{\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$text=''Notre influence envers l\\''Empereur-dieu n\\''est toujours pas satisfaisante...///nous avions passé un accord, Moneo :///4 points d\\''influence pour notre maison au moins, et que la maison Tleilax soit moins influente que la notre...///j\\''attends toujours...///'';\r\n}'),
(85, 15, 0, 0, 0, 'Les danseurs-visage n''ont pas cessé d''évoluer au fil du temps, et des décennies passées...///mais malgré tout leur effort pour réussir à disparaître sous l''identité de leur victime...///ces polymorphes continuent de dégager cette odeur acide...///mais pour sentir cette infime odeur sans entraînement Bene Guesserit...///il faudrait vraiment que le danseur-visage ne se tienne plus...qu''il se laisse aller...///mais dans un milieu normal, ces infâmes créatures font attention aux apparences... ///', '', -1, 0, 0, 0, 0, ''),
(86, 16, 0, 0, 0, 'Bonjour, je gère les stock du Palais///de temps en temps, un objet est mis en vente ici par l''équipe du palais///', '', -1, 0, 0, 0, 0, ''),
(87, 17, 0, 0, 0, 'Bonjour, honorable Moneo...///', '', 0, 0, 0, 0, 0, ''),
(88, 17, 0, 0, 0, 'Le Sareer...seul vestige de désert qui reste sur Arrakis, le Sareer entoure le palais. De temps à autre, quand le Tyran le peut, il aime piquer une tête dans son désert...le Ver peut alors sortir et s''exprimer librement dans son milieu naturel///Ce désert artificiel est maintenu par des satellites microscopiques Ixien capable de réguler la température et l''humidité///Ces satellites ont été commandés par l''Empereur-dieu lui même au début de son règne alors que la planète n''était qu''un immense désert...///il avait prévu la disparition des vers de sable et donc la disparition totale du désert d''Arrakis...sa lente métamorphose en ver, dernier de son espèce, source générateur d''épice, l''oblige à rester dans un milieu désertique...///d''où la création de ce désert artificiel///Les Ixien sont capable de prodige en matière de technologie...mais n''y connaissent rien en géopolitique...///lorsque LETO II a passé sa commande, il y a de ça des milliers d''années, ils pensaient qu''il allait s''en servir à des fins militaires...imaginez seulement le pouvoir de ces satellites capable d''assécher une planète entière...///c''était mal connaître notre cher Tyran///', '', 0, 0, 0, 0, 0, ''),
(89, 17, 0, 0, 0, 'Assurément, les truitesses forment une armée redoutée dans tout l''empire de Leto II///Ces guerrières jouent aussi le rôle de prêtresses de la religion créée par l''empereur-dieu où il se déifie///ce rôle autant social que guerrier fait de ses truitesses un des éléments fondamentale du maintient de son règne...///Le pouvoir de la religion couplé à celui de l''armée a toujours été un art délicat à maîtriser...///mais il semblerait que notre Tyran soit passé maître dans l''art de dominer autant par les armes que par l''esprit...///', '', 0, 0, 0, 0, 0, ''),
(90, 13, 0, 0, 0, 'La ventilation du bar est complètement détraqué ! ///les agents de l''entretien vont m''entendre///', '', 0, 0, 0, 0, 0, ''),
(91, 17, 2, 17, 1, '...en effet...///...il me semble...///que la température a sensiblement augmenté...///', '', 0, 0, 0, 0, 0, ''),
(92, 17, 3, 17, 1, 'Je...///oui, en effet...///je transpire beaucoup...///je ne sais pas comment vous faites pour tenir le coup...///je transpire à grosses gouttes///', '', 0, 0, 0, 0, 0, ''),
(93, 12, 1, 12, 2, 'Un danseur-visage ? dans le palais ! ///dites-moi vite de qui il s''agit Monéo !///', '', 0, 0, 0, 0, 0, ''),
(94, 12, 2, 12, 2, 'Haaaa...///j''envoie de suite mes truitesses pour exterminer cette racaille...///ces Bene Tleilax...///il y''a longtemps que je me serai débarrassé de cette engeance malsaine qui passe son temps à conspirer...///mais notre empereur-dieu LETO II a d''autres plans pour eux...///ne cherchez jamais à comprendre les intentions de notre bien aimé empereur...///Quant à vous, brave Moneo, acceptez ce présent de la part de toutes les truitesses du palais///Nous ne saurions nous montrer assez reconnaissant///', '', 0, 0, 0, 0, 0, 'Application_Common::setEpices(1500, 1);\r\nApplication_Common::setServiteur(3, 1);\r\nApplication_Common::explore(5);\r\nApplication_Common::majQueste(1,17,0);\r\nApplication_Common::displayRecompense(''<tr><td>5 planètes ont été explorées</td><td>Vous avez reçu 1500 épices</td></tr><tr><td>Vous avez reçu 3 serviteurs</td><td></td></tr>'');'),
(95, 13, 0, 0, 0, 'On raconte qu''un voleur se serait introduit dans le palais...///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(4,7,1);\r\nif($retur)\r\n$text=''Un louche individu traîne aux abords du bar entre minuit et 6h00///je ne lui fais pas confiance...///'';\r\n$retur=Application_Common::getMajQueste(1,7,2);\r\nif($retur)\r\n$text=''J\\''ai entendu dire que l\\''ambassadeur Tleilaxu était très intéressé par la poésie et les beaux arts...///'';'),
(96, 3, 0, 0, 0, 'Ces mémoires imprimés sur cristal ridulien sont d''une valeur inestimable...///Plus de 3000 années de réflexion de notre Empereur-dieu y sont retranscrites...///il y explique pourquoi il a fait ce choix de métamorphose...choix que son père, le grand Muad dib, a refusé... le prix de la paix de LETO, du sentier d''or est cette terrible solitude qu''il épanche à travers ces volumes...///il y parle de ses safaris à travers la mémoire seconde, de sa politique, et de la mise en place de sa religion...///amusant encore une fois de constater qu''il a repris ce procédé des Bene Guesserit...///la missionaria protectiva qu''elles répandaient avait tant de similitude avc la religion de LETO...///Il a vite interdit cette pratique Guesserit, car la différence fondamentale entre elles et notre bien aimé Tyran est le but de tout ceci : qui sert-il?///vous pensez que son altesse LETO II y prend du plaisir ou qu''il aime à se glorifier ? vous vous tromperiez lourdement...///', '', -1, 0, 0, 0, 0, ''),
(97, 3, 1, 3, 1, 'C''est affreux ! /// horrible ! /// les mémoires ! elles ont disparus ! /// allez vite prévenir Nayla, la chef truitesse, sans tarder !///', '1', -1, 0, 0, 0, 0, '$renom=Application_Common::getRenommee();\r\nif($renom < 500){\r\n    $text=''Le danseur-visage a été attrapé...bien Moneo...///mais hâtez vous d\\''acquérir plus de renommée...(500)///'';\r\n$quoteRendu[''quo_reponse'']=0;\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}\r\n$retur=Application_Common::getMajQueste(1,3,1);\r\n\r\nif($retur){\r\n$text=''Vite, les mémoires, retrouvez les mémoires !///'';\r\n$quoteRendu[''quo_reponse'']=0;\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}'),
(98, 18, 0, 0, 0, 'Je suis le représentants des Fremen de musée d''Arrakis///Nous sommes les derniers Fremen encore en vie dans tout l''empire///', '', 0, 0, 0, 0, 0, ''),
(99, 18, 0, 0, 0, 'Les Fremen sont le peuple premier de Dune, descendants des nomades Zensunni.///\r\nL’accession à l’empire de Paul Atréides a fait de nous l’un des peuples les plus importants de la Galaxie.../// conquérant de nombreux mondes sous la bannière verte des Atréides. Malheureusement, ce temps révolu.../// marqua le début de notre décadence. Depuis l''accession au trône de LETO II, nous sommes réduits à l’état de « Fremen de musée ».../// reliques vivantes d''autres temps plus ancien, confinés dans des « quartiers de sietch » en toc, vivant des dons des pèlerins et de petits trafics...///notre mode de vie volontairement démodé permet aux rites Fremen de subsister à travers nous. Notre situation peu enviable a été.../// mis en place par l''empereur-dieu lui même...nous n''avons même plus de krys véritable...tout ce que nous utilisons est en plastique...///depuis combien d''années n''avons nous plus vu de véritables dents de Shai Hulud ?///', '', 0, 0, 0, 0, 0, ''),
(100, 18, 0, 0, 0, 'Notre accoutrement unique s''appelle le "Distille". il s’agit d’un vêtement intégral qui, une fois correctement mis.../// ne laisse visibles que les yeux, et par un jeu de micro-mécanismes et de principes physiques élémentaires, récupère l’eau du corps.../// émise dans la transpiration, dans les déchets humains ou la vapeur créée par la parole. Un homme portant un distille correctement ajusté est censé pouvoir survivre.../// en perdant moins d'' « un dé à coudre d’eau par jour ». L’eau récupérée est répartie dans des poches spéciales. Des tuyaux flexibles à plusieurs endroits permettent de boire...///autant vous dire que sans ces distilles, les Fremen seraient mort il y a bien longtemps...mais aujourd''hui, pour un choix qui m''échappe, alors qu''Arrakis est devenue une planète verdoyante...///L''empereur-dieu nous oblige à vivre dans ce désert synthétique pour nous conformer aux anciens rites Fremen...///', '', 0, 0, 0, 0, 0, ''),
(101, 18, 1, 18, 1, 'Une requête ! Je suis venu ici dans l''espoir de me voir accorder une entrevue...///voyez-vous, notre mode de vie rudimentaire peut parfois être très lourd à porter...///nos Sietchs, vétustes et anciens, ainsi que nos pièges à vent, demandent des travaux d''entretiens constant...///qui sont pénible à utiliser avec des outils Fremen d''origine...///', '', 0, 0, 0, 0, 0, '/*$retur=Application_Common::getMajQueste(2,18,1);\r\nif($retur){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}*/'),
(102, 18, 2, 18, 1, 'Les Sietchs sont des habitations aménagées dans des roches/// Ces grottes, habitat traditionnel des Fremen, sont dirigées par des Naib : ceux qui ont juré de mourir plutôt que d’être capturés par l’ennemi...///en l''occurence, moi-même, même si, encore une fois, ce titre est devenue, avec la Paix de Leto, dépassé par la politique du Tyran...///', '', 0, 0, 0, 0, 0, ''),
(103, 18, 3, 18, 1, 'Je voudrai que vous sollicitiez une audience à notre majesté LETO II...///je sais bien que notre Majesté est très occupée, aussi, si vous, majordome officiel du vrai Shai Hulud, pouviez m''arranger une entrevue avec l''Empereur-dieu...///je vous en serai très reconnaissant///', '', 0, 0, 0, 0, 0, ''),
(104, 4, 5, 18, 1, 'Les Fremen de musée...*hhh...Ces pitoyables individus, à la mentalité de souk passent leur temps à demander des entrevues...///ils sollicitent des requêtes dès qu''il le peuvent, pour essayer de rompre avec leur mode de vie étriqué et monotone...///il y a longtemps, les Fremen étaient un peuple redoutable et respectable...mais maintenant, seuls ces vestiges...///sans âmes respectent le rite ancien des Fremen, à la demande de l''Empereur uniquement ! s''il n''y avait que moi, il y a longtemps que j''aurai dispersé cette racaille...///je ne supporte pas ces pauvres d''esprit ! enfin...*hhh*...///dites donc au Fremen de musée que j''accorderai mon attention à sa requête l''après-midi, à 16h00 précise...///mais que ce ne soit pas lui qui se déplace, jouez donc les intermédiaires, Moneo, de peur qu''il ne se sente trop important...///et qu''il ne recommence à nous importuner avec ses problèmes futiles !///', '', -1, 0, 0, 0, 0, 'Application_Common::setArret(119,1);'),
(105, 18, 7, 18, 1, 'Merci ! j''ai une entière confiance en votre bonne foi, Moneo. Voila donc l''objet de ma requête :///Pour respecter l''antique tradition Fremen, nous n''utilisons pas de Tournevis laser...///en effet, à l''époque, les vibrations générées par ce tournevis attirait les Vers de sable et était donc une source de danger pour les Fremen...///mais maintenant que les vers des sables ont disparu, ne pourrait-on pas les réutiliser ? le temps des travaux d''entretien est...///multiplié par 10 avec des tournevis traditionnel !///', '', 0, 0, 0, 0, 0, ''),
(106, 18, 0, 0, 0, 'Alors ? l''entretien prévu à 16h00 avec le grand inquisiteur s''est bien passé ?///', '', 0, 0, 0, 0, 0, ''),
(107, 4, 8, 18, 1, 'Je retransmets par ma bouche, les paroles même de notre empereur LETO II :///\r\n**Ces Fremen de musée ne cesseront donc jamais de m''inportuner avec de telles requêtes totalement inacceptables...///leur mode de vie doit être, à tout prix, conforme aux anciens rites Fremen...leur médiocrité intellectuelle me sont en horreur...///mais je suis bien conscient que ce joug qui leur est imposé n''est pas évident à porter...///mais malheureusement pour eux, les Fremen de musée ont un rôle capitale à jouer dans ma vision du Sentier d''Or, tant qu''ils se conforment aux rites originaux**///...Voila...///Il me semble donc évident que notre empereur ne veut pas leur laisser cette liberté !///', '', -1, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(6,15,2);\r\nif(!$retur){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$text=''Mmmmh...des affaires courantes m\\''accaparent actuellement...///je vais être obligé de reporter ma décision sur cette affaire demain, même heure...///'';\r\n}'),
(108, 18, 9, 18, 1, 'A vrai dire... je m''en doutais...///l''empereur-dieu ne nous considère pas avec grand estime...lui qui a connu les vrai Fremen, à l''époque de Stilgar le grand Naib...///voit mieux que quiconque ce que nous sommes devenu...de pâles copies sans forces, condamnés à répéter des rites qui n''ont plus de sens...///au nom de son sentier d''or...///mais merci quand même, Moneo, vous avez bien fait votre travail ! je vais vendre mon tournevis laser acheté pour l''occasion au surplus du palais...///et je vous laisse à vos tâches///', '', -1, 0, 0, 0, 0, ''),
(109, 2, 1, 2, 4, 'Les mémoires de l''empereur ?! pas possible !///Il faut impérativement les retrouver ! vite Moneo, allez enquêter hors du palais.../// avec un peu de chance, le voleur est toujours dans la citée qui entoure le palais !///cette citée est assez petite, contrairement à la citée de Onn...hâtez vous Moneo, cette nouvelle terrible risque de faire surgir le Ver de l''intérieur de notre empereur///', '', 0, 0, 0, 0, 0, ''),
(110, 6, 1, 6, 1, 'La planète Chusuk appartenait autrefois à l''empire Tleilax...///appropriez-vous cette planète pour nous permettre de continuer nos expériences genétiques sur ces habitants...///', '', 0, 0, 0, 0, 0, ''),
(111, 6, 0, 0, 0, 'Biennn...notre réserve de cobaye vient de décupler grâce à votre aide, Moneo...///je tiens à vous remercier d''une manière très...Tleilaxu...///', '', 0, 0, 0, 0, 0, ''),
(112, 2, 0, 0, 0, 'Les Mémoires volées sont une priorité pour l''empereur LETO II...///il faut absolument les retrouver...///je ne veux pas qu''il l''apprenne...///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getQuesteGlobal(25,1);\r\nif($retur)\r\n$text=''Il ne vous reste plus qu\\''à aller prévenir l\\''Empereur-dieu...///Il se trouve dans la salle du Siaynoq...///vous ne voyez ici qu\\''un hologramme...///'';'),
(113, 6, 3, 6, 1, 'Mon cher Moneo...Votre serviabilité légendaire va m''être d''une grande utilité dans cette délicate affaire...///Le général Tarhani est un Tleilaxu dissident suspecté de vendre le savoir Tleilax aux maisons les plus offrantes...///Si cela s''avère vrai, il nous faut agir au plus vite, imaginez que le savoir Tleilax se répande dans tout l''empire... nous ne serions plus d''aucunes utilité au Ver !///Votre mission est de trouver une preuve que le général vend des données Tleilax pour le prendre sur le fait et de me le rapporter///', '', 0, 0, 0, 0, 0, '$inf=Application_Common::getHumeurByFaction(4);\r\nif($inf<200){\r\n$text=''Mmmmmh...///Ma maison ne vous fait pas assez confiance pour que je vous soumette une requête...///'';\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n}'),
(114, 6, 4, 6, 1, 'Les gholas, Moneo, les gholas !!! Nous possédons le savoir du ghola depuis de milliers d''années !///Le Ver LETO II est d''ailleurs friand de nos gholas ! Il fait appel à nous depuis plus de 3000 ans pour que nous lui fournissions le ghola Duncan Idaho...///imaginez donc s''il pouvait se passer de nos services... il nous éliminerai !///Menez l''enquête au sujet du général et faites moi un rapport !///Vous serez justement récompensé...///', '', -1, 0, 0, 0, 0, '');
INSERT INTO `quote` (`quo_id`, `quo_id_perso`, `quo_maj_quete`, `quo_maj_quete_perso`, `quo_maj_quete_id_ext`, `quo_quote`, `quo_humeur`, `quo_reponse`, `quo_id_multiple`, `quo_nb_multiple`, `quo_recompense_multi`, `quo_recompense_nb_multi`, `quo_fnctn`) VALUES
(115, 6, 0, 0, 0, 'L''enquête au sujet de la trahison du général Tarhani avance ?///', '', 0, 0, 0, 0, 0, ''),
(116, 19, 0, 0, 0, 'Général Tarhani, grand commanditaire Tleilax///Les Ixiens trament dans l''ombre avec l''aide de la Guilde...///', '', 0, 0, 0, 0, 0, ''),
(117, 19, 0, 0, 0, 'Cela remonte à très, très longtemps, du temps de LETO premier du nom, le grand père de l''actuel empereur...///Le Bene Tleilax est entré en quasi-conflit avec la Maison Atréides lors de la jeunesse du Duc Leto/// croyant que la frégate de celui-ci avait détruit un vaisseau Tleilaxu qui se trouvait à bord d’un Long-Courrier de la Guilde/// Seul un jugement par forfaiture devant le Landsraad a permis à Leto de s’en tirer et de laver son honneur///', '', 0, 0, 0, 0, 0, ''),
(118, 19, 0, 0, 0, 'Le palais est entouré du désert artificiel créé de toute pièce par LETO II. Le Sareer///le soleil brille de mille feux dans ce désert, à toutes les heures du jour, comme de nuit...///Mais le palais, source d''épice et d''intrigue politique, attire aussi à lui les badauds qui ont installés leurs étals aux portes de celui-ci...///mais la première grande ville se trouve à des kilomètre de la, la grande citée d''Onn...///on dit aussi que le Tyran a fait construire dans les premiers siècles de son règne, un "nid d''aigle", une tour isolée en plein désert, ou il peut se recueillir librement...///mais on dit tellement de chose...une chose est sur : ne vous aventurez jamais dans le désert seul et sans équipement !///le soleil vous ravagerait en quelques heures !///', '', 0, 0, 0, 0, 0, ''),
(119, 19, 0, 0, 0, 'Etant ici en tant qu''aristocrate, j''ai beaucoup de temps libre...temps libre que je passe le plus clair de mon temps /// au hangar, croisée des chemins entre la diplomatie, la guerre et le commerce de vaisseaux...///ce palais me laisse perplexe...tant de pouvoir réuni en une seule batisse...de ce palais, et de ses acteurs...///dépendent tant de choses ! les truitesses, par exemple, police, armée et prêtresses du Tyran, stabilisent l''empire ///imaginez 5 secondes les répercussions sur tout le l''imperiuum si l''on découvrait un moyen de corrompre les truitesses...///', '', 0, 0, 0, 0, 0, ''),
(120, 20, 0, 0, 0, 'Hwitaka, fremen de musée, pour vous servir...///', '', 0, 0, 0, 0, 0, ''),
(121, 19, 0, 0, 0, 'Moneo ???///Que...que faites vous ici ? Vous m''avez suivi ! ///', '', 0, 0, 0, 0, 0, ''),
(122, 19, 2, 19, 1, 'Je vous en supplie...si vous ne me dénoncez pas, je vous révèle toutes les planètes du premier secteur qui ont un seuil de civilisation assez élevé pour y installer une ambassade...///ayant beaucoup guerroyé durant ma jeunesse, je connais bien les mondes rebelles et les mondes pacifistes...///ne me dénoncez pas, je vous en prie, les Tleilaxu sont sans pitié vis à vis des traîtres...quand ils ne sont pas à leur solde...///', '', 0, 0, 0, 0, 0, ''),
(123, 19, 0, 0, 0, 'Vous me forcez à l''exil...///Les tleilaxu me poursuivront sans aucun répit!///Misérable serviteur du Ver...///soyez maudit! ///', '', 0, 0, 0, 0, 0, 'Application_Common::moveSalle(19, 333);'),
(124, 19, 0, 0, 0, 'Haaa...voila un language que je connais à merveille...///je transmet à votre amiral toutes les coordonnées des planètes civilisées du premier secteur...///voila !///Cher Moneo, sachez que je vous suis reconnaissant au possible...///Je vais prendre des vacances quelques temps et attendre que les choses se calment...me faire tout petit/// le Ver n''a qu''a bien se tenir, avec vous dans les parages...///', '', -1, 0, 0, 0, 0, 'Application_Common::allDiplo(0);\r\nApplication_Common::setCorruption(500, 1);\r\nApplication_Common::displayRecompense(''<tr><td>Les planètes pacifistes ont été explorées</td><td>Votre corruption augmente</td></tr>'');\r\nApplication_Common::moveSalle(19, 333);'),
(125, 6, 10, 6, 1, 'Merveilleux, Moneo...je savais que je pouvais compter sur vous...Prenez ce présent bien mérité de ma part/// La maison Tleilax adresse au Ver...pardon, à sa majesté ses plus sincères salutations', '', 0, 0, 0, 0, 0, ''),
(126, 6, 0, 0, 0, 'La planète Chusuk nous est très chère...///Nous avons hâte de la revoir notre...///', '', 0, 0, 0, 0, 0, ''),
(127, 21, 0, 0, 0, 'N''oublions pas qu''il existe, à la base de tout ordre social, une certaine mesure de malveillance. C''est la lutte pour l''existence d''une entité artificielle, derrière laquelle se profilent l''esclavage et le despotisme./// Beaucoup de torts sont causés, d''où la nécessité des lois. La loi édifice sa propre structure de pouvoir, source de nouveaux maux et de nouvelles injustices///', '', 0, 0, 0, 0, 0, '$r=rand(0,7);\r\nif($r==1)\r\n$text=''Ne fabriquez surtout point de héros'';\r\nif($r==2)\r\n$text=''Les monarchies, par exemple, ont quelques bons côtés à part leurs qualités vedettes. Elles peuvent réduire la taille et le caractère parasitaire de la bureaucratie administrative/// Elle peuvent accélérer les décisions lorsque c\\''est nécessaire. Elles répondent à un très ancien besoin humain de hiérarchie parentale (ou tribale, ou féodale) où chacun reconnaît sa place///'';\r\nif($r==3)\r\n$text=''Avant toute chose, assurez-vous que l\\''armée soit avec vous///'';\r\nif($r==4)\r\n$text=''La civilisation est en grande partie fondée sur la couardise. Il est si simple de civiliser en enseignant à être lâche. Étouffez les critères qui conduiraient au courage. Limitez l\\''exercice de la volonté./// Égalisez les appétits. Bouchez les horizons. Décréter une loi pour chaque mouvement. Niez l\\''existence du chaos. Apprenez même aux enfants à respirer lentement/// Domptez.///'';\r\nif($r==5)\r\n$text=''Le passé évolue continuellement, mais rares sont ceux qui s\\''en aperçoivent.///'';\r\nif($r==6)\r\n$text=''Bien des choses dépendent de ce que les gens rêvent dans leur cœur.///'';\r\nif($r==7)\r\n$text=''Vos ennemis vous renforcent. Vos alliés vous affaiblissent.///'';'),
(128, 21, 0, 0, 0, 'Je suis le linguiste officiel Ixien de sa majesté LETO II...Je parle couramment le Galach ancien et une plétore d''autres langages morts depuis des siècles...///Souvent, perdu dans sa solitude, l''Empereur-dieu fait appel à mes services, et nous discutons ne serait-ce que pour refaire vivre... ///quelques instants ces dialectes oubliés de tous...de vous à moi...je n''ai jamais vu de toute ma carrière un être aussi cultivé que notre empereur///il a un amour des mots, des poèmes et des tournures, une connaissance et une subtilité exquise que je n''avais encore jamais rencontré auparavant...///quel plaisir que de servir un tel philosophe !///', '', 0, 0, 0, 0, 0, ''),
(129, 21, 0, 0, 0, 'Le surplus ouvre toutes les après-midi jusqu''à 18H00...///il sert de magasin à l''occasion, quand une personne veut se débarasser d''un objet inutile...///', '', 0, 0, 0, 0, 0, ''),
(130, 21, 1, 21, 1, 'Mmmmh...///connaissant l''érudition de votre maître, je suis prêt à vous faire un cadeau...je possède un turbo réacteur de fabrication ixienne tout à fait inédit...///je l''ai déposé au surplus, et je vous conseille de l''acheter... ce petit bijou technologique vous permettra de réduire considérablement le coût des vaisseaux que vous achetez pour conquérir de nouvelles planètes...///la propagation du savoir de LETO doit s''étendre dans tout l''univers, pour le bienfait de celui-ci...évidemment, qui dit puissance, dit répression et rébellion, mais avouez tout de même...///que notre Empereur-dieu ne s''en sort pas si mal...///', '', 0, 0, 0, 0, 0, '$inf=Application_Common::getHumeurByFaction(5);\r\nif($inf<300){\r\n$text=''Mmmmmh...///Ma maison ne vous pas assez confiance pour que je  vous révéle un secret typiquement ixien...///'';\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n}\r\nelse{\r\nApplication_Common::setArret(161,1);\r\n\r\n}'),
(131, 10, 0, 0, 0, 'Que... Vous possédez un réacteur ixien ? Moneo, vous nous sauvez la mise !/// Avec un composant pareil, la consommation énergétique est réduite considérablement... On peut aisément diviser par deux les prix des vaisseaux !/// Je vous le prends pour intégrer tout de suite ce nouveau type de modèle à tout nos vaisseaux...///la prochaine fois que vous viendrez, les moteurs Ixiens auront été posés sur les vaisseaux !///', '', -1, 0, 0, 0, 0, 'Application_Common::setValeurVaisseau(50);\r\nApplication_Common::deleteobject(7);\r\necho ''<script>afficheObject();</script>'';\r\n'),
(132, 20, 0, 0, 0, 'Il vous est impossible de continuer sans distille...///le soleil du Sareer vous brulerai et vous déshydraterai en quelques heures seulement...///', '', -1, 0, 0, 0, 0, ''),
(133, 22, 0, 0, 0, 'Je me nomme Kharagul, se qui en Chakobsa signifie "enfant du désert"///que puis-je faire pour vous ? ///', '', 0, 0, 0, 0, 0, ''),
(134, 22, 0, 0, 0, 'Le sentier d''or... une vaste excuse du Ver pour nous maintenir tous dans l''ignorance et la docilité ! La paix de Leto, le culte, les truitesses...///tout est fait pour que nous nous sentions en sécurité...mais dans SON monde, avec SES règles...de quel droit nous impose t''il son mode de vie...///Il n''existe plus aucune grande ville dans tout l''imperiuum, les plus grandes qui soient sont des copies des plus petites avec juste des batiments administratifs en plus...///qu''il est plus pratique de contrôler une population se terrant dans des bourgs délimités et cloisonnés que dans des grandes mégalopoles...///le Ver a en effet interdit les grandes mégapoles...mais un jour...un jour oui...le tyran tombera de son trône, par la main même qu''il nourrit depuis des millénaires...///', '', 0, 0, 0, 0, 0, ''),
(135, 22, 1, 22, 1, 'Un distille ? J''ai beaucoup de distille d''apparat pour touriste... mais de vrai distille...///il m''en reste un, et il est d''excellente facture...///je vous le donne en échange d''un petit service...///', '', 0, 0, 0, 0, 0, ''),
(136, 22, 2, 22, 1, 'Voila, comme vous le savez sans doute, nous autres Fremen de musée sommes liés par les anciennes traditions Fremen...///Or le Krys, ce coutelas formé à partir d''une dent d''un ver de sable a une valeur inestimable pour nous...le problème étant que le seul qui en possède un véritable est le représentant fremen au palais...///nous autre devons nous contenter d''une caricature de Krys faite en plastique fragile...///tout ce que je vous demande, c''est de me trouver un Kys en échange d''un distille...///essayez de faire affaire avec le représentant, peut-être se laissera t-il acheter...///', '', 0, 0, 0, 0, 0, ''),
(137, 18, 1, 18, 2, 'Vous n''y pensez pas ??? mon Krys est ce qui fait toute ma dignité de Fremen...///à moins bien sûr que vous n''y mettiez les moyens...mais je ne suis pas une bête à souk: si vous voulez qu''on parle affaire, faisons le grâce à l''antique voie Fremen...///parlons le Chakobsa, comme les premiers Fremen...///et si vous ne le parlez pas, alors, pas de deal !///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(1,18,2);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$king=Application_Common::getMajQueste(2,21,2);\r\nif($king){\r\n$text=''Je...///très impressionnant!///ainsi nous pouvons parler affaire...///alors vous voulez donc m\\''acheter mon Krys ?mmmh...Je vous le donne en échange de la moitié de votre fortune...///'';\r\n$quoteRendu[''quo_maj_quete'']=3;\r\nApplication_Common::majQueste(3,22,1);\r\n}'),
(138, 21, 1, 21, 2, 'Bi-lal kaifa ! ///Ekkeri-akairi ! ///Il n''est pas donné à tout le monde d''apprendre cette langue...///j''ai sur moi une puce Ixienne qui favorise et facilite l''apprentissage des dialectes, pour peu que l''on soit en phase avec le langage que l''on veut apprendre...///Moneo, je veux bien vous apprendre les rudiments de cette langue, mais il va falloir que vous vous rendiez aux portes du désert et que vous avaliez cette puce...///alors seulement, vous connaitrez les fondamentaux de cette langue...///', '', 0, 0, 0, 0, 0, ' 	$inf=Application_Common::getHumeurByFaction(5);\r\nif($inf<150){\r\n$text=''Mmmmmh...///Les Ixiens n\\''ont pas assez confiance en vous pour vous apprendre cette langue...///'';\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n}\r\nelse{\r\nApplication_Common::setArret(170,1);\r\n\r\n}'),
(139, 21, 0, 0, 0, 'Vous êtes allez aux portes du désert manger la puce linguistique ?///', '', 0, 0, 0, 0, 0, ''),
(140, 18, 5, 18, 2, 'Haaaa...marché conclu, inestimable Moneo...je sais ce que vous devez penser...vendre un tel objet...même pour tout l''épice du monde je n''aurai pas du...///mais comprenez...il faut bien vivre...les frais du palais coûtent si cher...', '', 0, 0, 0, 0, 0, ''),
(141, 14, 1, 14, 9, 'Un Krys ! un véritable Krys ! je n''en crois pas mes yeux !///j''ai parcouru des centaines de mondes, voyagé à travers les longs courriers de la Guilde spatiale, mais de Krys véritable, je n''en avais jamais trouvé ! Merci Moneo, Vous êtes un homme bon///', '', 0, 0, 0, 0, 0, ''),
(142, 22, 4, 22, 1, 'Un krys véritable !!! par la barbe du prophète ! vous avez réussi !///comme promis, voila un distille qui vous permettra d''affronter le soleil aride du Sareer///', '', 0, 0, 0, 0, 0, ''),
(143, 14, 0, 0, 0, 'Les Fremen... les fiers Fremen que l''on aperçoit dans les livres d''histoire...j''ai passé la moitié de ma vie à étudier les Fremen qui ont aidé l''Empereur-dieu à accéder au pouvoir...///pauvres Fremen de musée...///ils n''ont pas compris ce qui faisait l''essence même des Fremen...///une phrase résume par ailleurs très bien leur pensée : "ne te retrouve jamais à côté d''une personne avec qui tu ne voudrais pas mourir"...voila quel souffle animait ces fiers guerriers...///si vous saviez ce que je serai prêt à donner pour voir de mes propres yeux un véritable Krys...je donnerai une fortune, ne serait-ce que pour en voir un quelques minutes...///et l''on dit qu''il en reste un ou deux dans le palais...///', '', 0, 0, 0, 0, 0, ''),
(144, 7, 1, 7, 1, 'Il y a en effet un troublant message que j''ai reçu ce matin même...Il exige que nous, les Ixiens, ne soyons plus présent lors de la cérémonie du partage...///Voyez avec le responsable de la sécurité du palais qui est à l''origine de cette missive et revenez me voir uniquement lorsque l''enquête sera résolue///Ces lettres de menace ne doivent pas rester impuni! Vous n''aurez pas affaire à un ingrat...///', '', 0, 0, 0, 0, 0, ''),
(145, 7, 0, 0, 0, 'Mmmmmmmh...///alliance est un bien grand mot...///disons que nous sommes lié par d''étroits liens commerciaux...///L''empereur-dieu est, plus que notre souverain, le premier client des technologies ixienne...///il raffole en effet de nos suspenseurs, nos graveurs de mémoires et autres générateurs de champs Holtzman...///jamais nous ne tenterons quoi que ce soit contre notre majesté!///', '', 0, 0, 0, 0, 0, ''),
(147, 12, 2, 7, 1, 'Les lettres de menaces sont un moyen abject de chantage qui a libre cours dans ce palais...montrez-moi donc la fameuse lettre...de temps en temps, des indices cruciaux s''y dissimulent...///Mmmmh...///*hhh*///les tournures de phrases et le vocabulaire employé ici me paraissent très étrange... le dialecte employé ici a l''air particulier.../// voyez si un expert ne pourrait pas mieux vous renseigner quant à la provenance d''un tel langage...///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(2,7,1);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;'),
(148, 21, 3, 7, 1, 'Bien volontiers...Hmmm...c''est une lettre qui menace le receveur de représailles s''il ne baisse pas sa demande d''épice dans les prochains jours...///le langage pourrait s''apparenter à du Bu Sab, langage archaïque utilisé sur la planète CoSentience et plus généralement dans le système mère Calibane...///il faudrait se renseigner sur cette planète pour trouver quelle maison majeure en gère la propriété...peut-être connaissez vous un expert planétaire ?///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(3,7,1);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;'),
(149, 9, 4, 7, 1, 'La planète CoSentience... attendez que ça me revienne... je regarde dans mes cartes...oui, ca y''est ! ///Le système Calibane a été un des premiers fiefs de la maison majeure Guilde spatiale...///elle a été habilement marchandé à des représentants marchands contre une réduction du service de transport de la Guilde dans ses long-courriers...///La planète CoSentience est une des planètes les moins signifiantes du système, mais elle n''en demeure pas moins entièrement soumise à l''autorité de la Guilde spatiale...///je me sens toujours déplacé, en parlant d"autorité" quand il ne s''agit pas de l''Empereur-dieu...///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(4,7,1);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;'),
(150, 23, 5, 7, 1, 'Croyez-vous m''impressionner avec vos accusations ridicu...ho ! Un laser !Vous possédez un laser !!!/// L''empereur-dieu doit avoir extrêmement confiance en vous, lui qui a interdit les armes laser dans son royaume///je...j''avoue, la lettre de menace au dirigeant Ixien vient de moi...mais j''y ai été forcé par les Tleilaxu !///ils détiennent ma famille en otage sur la lointaine planète Novebruns...Je vous en prie ! si au moins l''empereur-dieu possédait cette planète, les Tleilaxu ne pourraient plus menacer ma famille...///la Paix de LETO rend les prises d''otage impossible ! Je vous en prie...///conquérez la planète Novebruns pour empêcher les Tleilaxu de me nuire ou acceptez le chantage Tleilax.../// et au prochain partage d''épice, faites en sorte que les Ixiens ne recoivent aucun épice...///mais par dessus tout...ne me dénoncez pas aux Ixiens...ils me tueraient et ma famille mourra avec moi !///', '', 0, 0, 0, 0, 0, '$inf=Application_Common::getHumeurByFaction(6);\r\nif($inf<100){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n$text=''Mmmmh...la Guilde spatiale ne vous fais pas assez confiance pour que je réponde à vos accusations !///'';\r\n}else{\r\n$myObj=Application_Common::getObject(12);\r\nif(!$myObj){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n$text=''Une aussi grosse accusation de la part d\\''un homme même pas armé... Vous croyez que je vais vous répondre ?///'';\r\n}\r\n}\r\n 	$retur=Application_Common::getMajQueste(5,7,1);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;'),
(151, 23, 0, 0, 0, 'Je suis un technicien de nuit appartenant à la Guilde...je fais parti de l''équipe de maintenance des long-courriers///', '', 0, 0, 0, 0, 0, ''),
(152, 7, 6, 7, 1, 'Ainsi, la Guilde spatiale ne respecte pas ses contrats...c''est bon à savoir...///j''envoie immédiatement un contingent de ma garde s''occuper de ce technicien...///Merci brave Moneo, vous avez été à la hauteur de la tâche que je vous ai assigné...L''empereur-dieu doit être fier de vous///', '', 0, 0, 0, 0, 0, 'Application_Common::deleteobject(11);\r\necho ''<script>afficheObject();</script>'';'),
(153, 23, 8, 7, 1, 'Merci pour tout ! les Tleilaxu vont libérer ma famille, et je vais pouvoir reprendre ma vie normale !///', '', 0, 0, 0, 0, 0, ''),
(154, 7, 9, 7, 1, 'Merci brave Moneo, vous avez été à la hauteur de la tâche que je vous ai assigné...Vous avez géré en toute discrétion cette épineuse affaire...///L''empereur-dieu doit être fier de vous///', '', 0, 0, 0, 0, 0, 'Application_Common::deleteobject(11);\r\necho ''<script>afficheObject();</script>'';'),
(155, 7, 1, 7, 2, 'Il est de notoriété publique que le scribe officiel de l''empereur est un passionné des écritures datant de l''ère pré-ridulien...///j''ai en ma possession quelques poésies écrit par les grands auteurs de cette époque que je voudrai vendre...occupez vous de la transaction mais tirez-en un bon prix !///Je suis certain que d''autres dans le palais pourraient être intéressé par une telle transaction...///', '', 0, 0, 0, 0, 0, '$inf=Application_Common::getHumeurByFaction(5);\r\nif($inf<150){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n$text=''Mmmmh...La maison d\\''Ix ne vous fais pas assez confiance pour que je puisse vous répondre...///'';\r\n}else{\r\nApplication_Common::setobject(13);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';\r\n}'),
(156, 3, 2, 7, 2, 'Des poésies pré-riduliennes ? mais ce sont là des pièces de collection ! La qualité de  conservation de ces pièces uniques est tout simplement splendide !///je vous fais un prix : 5000 épice///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(2,7,2);\r\nif($retur)\r\n$quoteRendu[''quo_maj_quete'']=0;'),
(157, 7, 0, 0, 0, 'Vous avez vendu mes textes riduliens ?', '', 0, 0, 0, 0, 0, ''),
(158, 3, 3, 7, 2, 'Merci Moneo, voila un achat qui va faire des envieux ! L''empereur-dieu LETO II est friand de ce genre de délices intellectuels...///', '', 0, 0, 0, 0, 0, ''),
(159, 7, 4, 7, 2, 'Merci Moneo, je suis sur que vous aurez pu faire monter les prix, mais je vais me contenter de cet épice...///', '', 0, 0, 0, 0, 0, ''),
(160, 7, 5, 7, 2, '2000 épices ? de qui vous moquez-vous Moneo ? Vous croyez vraiment que je ne vois pas votre misérable combine ?///vous me décevez énormément...///', '', 0, 0, 0, 0, 0, ''),
(161, 6, 2, 6, 2, 'Des poèmes pré-ridulien ?///sachez que je suis prêt à dépenser 6000 épices pour obtenir ces merveilles...Cela vous étonne t-il que je soit amateur d''art, moi, ambassadeur Tleilaxu ?///Tout le monde sait pourtant que le scribe officiel de l''empereur est féru de poème pré-ridulien...///en obtenant ces poèmes, je possèderai un moyen de pression indéniable sur le scribe...///j''ai toujours accordé beaucoup d''intérêt aux passions des gens...///et vous, Moneo, qu''est-ce qui vous passionne ?///', '', 0, 0, 0, 0, 0, ''),
(162, 6, 3, 6, 2, 'Merci Moneo, en agissant ainsi, vous renforcez le pouvoir du Bene Tleilax au sein de l''empire de notre bon empereur-dieu LETO II ...///', '', 0, 0, 0, 0, 0, ''),
(163, 6, 6, 7, 2, 'Merci Moneo, je suis sur que vous aurez pu faire monter les prix, mais je vais me contenter de cet épice...///', '', 0, 0, 0, 0, 0, ''),
(164, 6, 7, 7, 2, 'C''est bien moins que ce que j''espérais...L''empereur-dieu n''aurait il pas surestimé vos talents de négociations ?///', '', 0, 0, 0, 0, 0, ''),
(165, 3, 8, 7, 2, 'Je vais vous faire une offre que vous ne pourrez pas refuser : je vous les achète pour 10 000 épices///Il ne faut surtout pas que de telles pièces de collections terminent entre les mains des sales Tleilaxu !/// L''empereur-dieu LETO II est friand de ce genre de délices intellectuels...voila qui lui fera certainement plaisir...///', '', 0, 0, 0, 0, 0, ''),
(166, 7, 9, 7, 2, '10 000 épices, Moneo ? je n''en attendais pas tant !///vos talents de marchandage ont été à la hauteur de leur réputation...je vais vous laisser une marge.../// ', '', 0, 0, 0, 0, 0, ''),
(168, 7, 10, 7, 2, 'Merci Moneo, je suis sur que vous aurez pu faire monter les prix, mais je vais me contenter de cet épice...///', '', 0, 0, 0, 0, 0, ''),
(169, 8, 0, 0, 0, 'Nos vaisseaux sont dirigés par des Navigateurs et propulsés par des générateurs Holtzmann. ///Nous sommes le plus gros consommateur d’épice, celle-ci étant utilisée comme un carburant mental et un agent de mutation pour nos navigateurs qui en sont totalement dépendants/// en particulier pour trouver une voie sûre dans l’espace...///Nous sommes donc très concernée par les décisions politiques prises sur Arrakis. Les navigateurs et les générateurs Holtzmann sont très coûteux...///', '', 0, 0, 0, 0, 0, ''),
(170, 8, 1, 8, 1, 'Blub...///Plus vous possédez de planètes...///plus la Guilde se fortifie...Les truitesses font encore appel à nos services pour les transports de troupes...Blub...///conquérez au moins 5 planètes !///la Guilde spatiale vous fournira des troupes à envoyer sur les planètes pour les défendre une fois conquises...///', '', 0, 0, 0, 0, 0, ''),
(171, 8, 2, 8, 1, 'Biennn, Moneo...Blub...notre partenariat progresse...///Vous fournissez les planètes...je fournis les troupes...///', '', 0, 0, 0, 0, 0, ''),
(172, 8, 3, 8, 1, 'Blub...///Plus vous possédez de planètes...///plus la Guilde se fortifie...Les truitesses font encore appel à nos services pour les transports de troupes...Blub...///conquérez au moins 10 planètes !///la Guilde spatiale vous fournira des troupes à envoyer sur les planètes pour les défendre une fois conquises...///', '', 0, 0, 0, 0, 0, ''),
(173, 8, 4, 8, 1, 'Biennn, Moneo...Blub...notre partenariat progresse...///Vous fournissez les planètes...je fournis les troupes...///', '', 0, 0, 0, 0, 0, ''),
(174, 4, 0, 0, 0, 'Mon brave Moneo...Ce palais, immense forteresse abritant l''empereur-dieu, est paradoxalement un des endroits les moins sûr de tout l''empire...///tout les deux jours à peu près, une tentative d''attentat est faite sur les maisons majeures visant à éliminer les serviteurs de ceux-ci...///pour que cela n''arrive pas, allez donc voir le représentant Ixien, qui vous fournira des Escortes vous permettant de conserver les Serviteurs...///En effet, si les serviteurs meurent, les maisons à qui ils appartiennent nous feront moins confiance...les Escortes meurent à la place des Serviteurs///Si vous affiliez des Serviteurs à une maison, affiliez lui aussi des Escortes pour protéger vos Serviteurs.../// Le représentant de la Guilde, quant à lui, vous fournira les troupes nécessaires pour défendre nos planètes des pirates...///', '', 0, 0, 0, 0, 0, ''),
(175, 5, 5, 5, 1, 'Moneo...Je vois que je peux vous faire confiance...si vraiment c''est ce que vous voulez...///Ce que j''ai à vous demander est si important qu''aucun autre représentant des autres maisons majeures ne voudra plus vous adresser la parole///êtes-vous sûr de vouloir continuer ? (prendre le parti de l''Empereur-dieu)', '', 0, 0, 0, 0, 0, ''),
(176, 5, 6, 5, 1, 'Moneo...mon brave Moneo...de longue date, la maison Bene Guesserit ne partage ce type d''information qu''avec une des soeurs...///mais je préfère vous donner ici ces données sensibles...je ne veux impliquer que le plus proche serviteur de l''Empereur dans ce qui va suivre...///soyons clair : LETO II ne sert pas les plans du Bene Guesserit, l''épice qu''il distribue est en quantité bien insuffisante et sa tyrannie bienveillante...///est une hérésie pour nous autres soeurs...nous ne le supportons que parce que nous nous adaptons : en aucun cas nous le soutenons...mais à choisir...///je préfère mille fois le règne de l''Empereur-dieu plutôt que de tomber dans les affres d''un gouvernement ixien couplé avec les agents de la Guilde...///car c''est en effet ce qui se trame dans l''ombre depuis longtemps...j''ai ici sur moi les preuves qu''ils préparent un complot visant à exploiter la non-technologie : ///ils préparent un voile gigantesque, une machine infernale qui bloquerait la prescience de l''Empereur-dieu///', '', 0, 0, 0, 0, 0, '$inf=Application_Common::getHumeurByFaction(6);\r\n$persos=new Customer_Model_Mapper_User();\r\n$nbInfluence=$persos->getInfluenceFaction(3);\r\nif($inf<500 && $nbInfluence>=6){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n$quoteRendu[''quo_reponse'']=-1;\r\n$text=''Mmmmh...pour me prouvez que je peux vous faire confiance, faites que la maison Guesserit dispose d''au moins 10 Serviteurs et de 6 Points d''Influence...///'';\r\n}'),
(177, 5, 7, 5, 1, 'En effet... en bloquant la capacité de l''Empereur-dieu de deviner les différents chemins possibles, avec leurs conséquences et leur probabilité, en supprimant la prescience de notre Empereur.../// ils réussiront tôt ou tard à renverser le Tyran...le Bene Guesserit ne PEUT PAS laisser faire une telle chose...du moins tant qu''elle n''est pas l''investigatrice d''un tel complot...///aussi, veuillez transmettre ces informations cruciales concernant les différentes maisons présentes au palais- dont les preuves du complot- à notre contact qui se trouve sur les marches du palais...///même si le Bene Tleilax n''a rien à voir la dedans, il n''appréciera certainement pas  de voir certaines de ses données confidentielles révélées au grand jour...///je compte sur vous, Moneo, vous participez aujourd''hui à la chute, ou à la destruction de l''imperiuum !///', '', 0, 0, 0, 0, 0, ''),
(178, 5, 0, 0, 0, 'Remettez ces preuves à mon contact qui se trouve sur les marches du palais...///une fois ces preuves transmises, nous ne seront plus en contact, je retourne sur le chapitre pour protéger mes arrières...///ça a été un honneur de vous cotoyer, Moneo...///', '', 0, 0, 0, 0, 0, ''),
(179, 24, 0, 0, 0, 'Je ne suis qu''un courtisan au service de l''empereur...', '', 0, 0, 0, 0, 0, ''),
(180, 24, 1, 24, 1, 'Le palais a des oreilles...retrouvez-moi au coeur du village à 20H00...je disparaît d''ici là, l''endroit devient malsain...///', '', 0, 0, 0, 0, 0, ' 	$perso=new Core_Model_Mapper_Personnage();\r\n$perso->mouveSalle(24, 26);'),
(181, 24, 2, 24, 1, 'Haaa, Moneo...laissez moi prendre ces documents...///Merci, je les transmets à l''heure même sur le Chapitre, la planète mère des Bene Guesserit///ce qui signifie qu''au moment ou nous parlons, l''Empereur est au courant du complot ourdi par la Guilde et les Ixiens...///les fous...///mais dites-vous bien Moneo que vous avez rendu un fier service à la couronne...///', '', 0, 0, 0, 0, 0, '$sl=Application_Common::getSalle();\r\nif($sl!=26){\r\n$text=''Rendez-vous à 20h00 au coeur du village///'';\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}'),
(182, 24, 0, 0, 0, 'En effet...j''ai cru comprendre que vous étiez intéressé par les mémoires perdues de l''Empereur-dieu...j''ai vu une ombre...///se glisser la nuit hors du palais...pour retrouver cette ombre, et pour ne trahir personne, je vais me contenter de répondre ceci :///ayez foi, et perséverez droit dans votre pensée, droit devant vous...///je sais, cela peut paraître assez sibyllin, mais cela devrait vous suffire à trouver ce que vous cherchez...mais attention...///êtes vous sur que vous êtes prêt à trouver ce que vous recherchez ?', '', 0, 0, 0, 0, 0, '$renom=Application_Common::getRenommee();\r\nif($renom < 1000){\r\n   $text=''Hâtez vous d\\''acquérir plus de renommée...(1000)///j\\''ai hâte de vous délivrer un indice...///'';\r\n}'),
(183, 25, 0, 0, 0, 'Que...PERE ! /// Vous ici ???///', '', 0, 0, 0, 0, 0, ''),
(184, 25, 1, 25, 1, 'Je vous connais, Père, rien de ce que vous direz ne me fera changer d''avis...maudit soit le Ver, maudit soit ses serviteurs et sa tyrannie...///Moi, Siona Ibn Fuad al-Seyefa Atreides, fruit des expériences génétiques du Ver, ce meurtrier sanguignaire.../// je m''insurge contre votre acceptation passive de son despotisme théologique...///MORT AU VER !///', '', 0, 0, 0, 0, 0, ''),
(185, 25, 2, 25, 1, 'Vous ne reculez donc devant rien ! ///menacer sa propre fille ! êtes-vous donc à ce point dépourvu de scrupule ?///', '', 0, 0, 0, 0, 0, ''),
(186, 25, 3, 25, 1, 'Vous me faites de la peine, Père, incapable de sortir de votre servitude, mais tout aussi incapable de servir correctement...Je ne regrette rien ! Adieu !///', '', 0, 0, 0, 0, 0, 'echo ''<script>\r\nmouveLeft("siona");\r\n</script>'';\r\n$perso->mouveSalle(25, 999);'),
(187, 25, 0, 0, 0, 'Je...Père...votre dévouement au service de l''empereur est au moins aussi fort que ma haine vis à vis de lui...Adieu !///', '', 0, 0, 0, 0, 0, 'echo ''<script>\r\nmouveLeft("siona");\r\n</script>'';\r\n$perso=new Core_Model_Mapper_Personnage();\r\n$perso->mouveSalle(25, 999);'),
(188, 2, 4, 25, 1, 'Les mémoires ? Moneo... Vous n''imaginez pas mon soulagement...L''Empereur-dieu lui-même tient à vous remercier///rendez vous pour le Siaynoq !/// Vous ne voyez ici qu''un hologramme...hâtez vous de le rejoindre ! ///Vous avez été un fidèle serviteur de l''Empereur-dieu...///C''est un honneur de vous connaître...///', '', 0, 0, 0, 0, 0, ''),
(189, 1, 0, 0, 0, '*murmures* Moneo...///Entre donc, Moneo...///Vois comme je suis content de pouvoir enfin avoir cette entrevue...///tu as donc récupéré les mémoires, Moneo...///tu as aussi choisi de dénoncer le complot des Ixiens et de la Guilde...les sots...///s''ils savaient...///Ta vie arrive bientôt à son terme, Moneo, mais saches qu''en plus de 300 siècles de règne, je n''ai jamais rencontré un serviteur aussi dévoué que toi...///menacer sa propre fille...tu as réussi l''épreuve, Moneo...tu as tout réussi...vois comme je suis heureux...///', '', 0, 0, 0, 0, 0, '$retur=Application_Common::getMajQueste(5,25,1);\r\nif($retur)\r\n$text=''*murmures* Moneo... Entre donc, Moneo...///Vois comme je suis content de pouvoir enfin avoir cette entrevue...///tu n\\''as donc pas pu récupérer les mémoires, Moneo...///tu as par contre choisi de dénoncer le complot des Ixiens et de la Guilde...les sots...///s\\''ils savaient...///Ta vie arrive bientôt à son terme, Moneo, mais saches qu\\''en plus de 300 siècles de règne, tu as été un de mes serviteurs le plus dévoué...///et pourtant... saches que le Sentier d\\''Or exige ta soumission la plus totale... ta fille aurait dû me rapporter mes mémoires...///mais ne te formalises pas...en les emportant avec elle, elle accomplit son devoir, elle prends sa place qui lui est assignée par le Sentier d\\''Or...///'';'),
(190, 1, 1, 1, 1, 'Ses compagnons ? moi-même j''en ai eu de semblables autrefois...les aberrations de notre passé sont plus nombreuses que tu ne peux l''imaginer.', '', 0, 0, 0, 0, 0, ''),
(191, 1, 2, 1, 1, '*murmures* Si tu savais Moneo...///Mes voyages à travers les labyrinthes ancestraux ont fait resurgir dans ma mémoire d''innombrables lieux et événements que je ne voudrais jamais voir répétés///', '', 0, 0, 0, 0, 0, ''),
(192, 1, 3, 1, 1, 'Non, tu ne les imagines pas. J''ai vu un si grand nombre de peuples et de planètes que cela en perd toute signification même en imagination///Les paysages que j''ai contemplés ! La calligraphie des chemins étrangers entrevus dans l''espace et imprimés dans mes plus intimes visions !///Les sculptures érodées de falaises et de canyons et de galaxies ont gravé en moi la certitude absolue de n''être qu''un grain de poussière///', '', 0, 0, 0, 0, 0, ''),
(193, 1, 4, 1, 1, 'Moins qu''un grain de poussière ! j''ai vu des peuples et leurs sociétés stériles dans des postures...///tellement répétitives que leur inanité m''emplit d''un ennui sans nom. Tu m''entends ?///', '', 0, 0, 0, 0, 0, ''),
(194, 1, 5, 1, 1, 'Tu ne me mets pas en colère. Quelquefois, tu m''agaces, c''est le maximum. Tu ne peux pas imaginer ce que j''ai vu...///caliges et mjeeds, rakahs, rajahs et pachas, rois et empereurs, primitos et présidents...///je les ai tous vus. Des chefs de clans féodaux, du premier jusq''au dernier. Des petits pharaons///', '', 0, 0, 0, 0, 0, ''),
(195, 1, 6, 1, 1, 'Maudits Romains ! <i>Maudits Romains !</i>', '', 0, 0, 0, 0, 0, ''),
(196, 1, 7, 1, 1, 'Bien sûr que tu ne comprends pas. Les Romains ont répandu la maladie pharaonique comme le fermier répand sur son champ le grain de la prochaine récolte///Césars, kaisers, tsars, imperators, caseris, palatos...maudits pharaons !///', '', 0, 0, 0, 0, 0, ''),
(197, 1, 8, 1, 1, 'Je suis peut-être le dernier du lot, Moneo. Prie pour qu''il en soit ainsi///', '', 0, 0, 0, 0, 0, ''),
(198, 1, 9, 1, 1, 'Toi et moi, Moeno, nous sommes les tueurs-de-mythes. C''est le rêve que nous partageons. Du haut de mon divin piédestal olympien...///je peux t''assurer que le gouvernement n''est rien d''autre qu''un mythe partagé. Quand le mythe s''éteint, le gouvernement meurt///', '', 0, 0, 0, 0, 0, ''),
(199, 1, 10, 1, 1, 'Cette machine humaine, qui a pour nom l''armée, c''est elle qui a créé notre rêve actuel, mon ami.///<i>Moneo sait ce que c''est que l''armée; il n''ignore pas que c''est un rêve stupide qui a fait des armées l''instrument de gouvernement de base</i>///', '', 0, 0, 0, 0, 0, 'Application_Common::majQueste(0,1,1);'),
(200, 1, 11, 1, 1, 'Elle sent le Sentier d''Or aussi profondément que toi, Moneo///', '', 0, 0, 0, 0, 0, ''),
(201, 1, 12, 1, 1, 'Parce que tu places la raison au-dessus de tout///', '', 0, 0, 0, 0, 0, ''),
(202, 1, 13, 1, 1, '*sourire*///<i>C''est comme si je cherchait à secouer les dés d''un cornet aux dimensions infinies/// Les émotions de Moneo représentent une magnifique pièce jouée sur une scène unique. Il s''approche parfois du bord, mais il ne le voit jamais !</i>///Pourquoi insistes-tu pour découper le continuum en tranches ? quand tu vois la totalité du spectre, y a-t-il une couleur qui domine les autres ?///', '', 0, 0, 0, 0, 0, ''),
(203, 1, 14, 1, 1, '*yeux fermés*///Tant qu''il restera un seul humain pour les voir, les couleurs ne connaîtront pas de fin linéaire, même si ta propre vie prend fin, Moneo///', '', 0, 0, 0, 0, 0, ''),
(204, 1, 15, 1, 1, 'C''est le continuum, l''infinitude, le Sentier d''Or///', '', 0, 0, 0, 0, 0, ''),
(205, 1, 16, 1, 1, 'Que vous <b>REFUSEZ</b> de voir !///', '', 0, 0, 0, 0, 0, ''),
(206, 1, 17, 1, 1, 'Va au diable, Moneo !///<i>ce cher Moneo est fatigué, il ne comprends pas la leçon...brusquons le un peu</i>///Les civilisations s''écroulent quand leur pouvoir séculier dépasse leur religion ! Pourquoi ne vois-tu pas cela ? Hwi (ma fancée) le voit !///', '', 0, 0, 0, 0, 0, ''),
(207, 1, 18, 1, 1, 'C''est une Truitesse ! Elle l''est de naissance, faite pour me servir. Non !/// Les truitesses sont troublées parce que je les avais autorisées à se considérer comme mes épouses et qu''elles voient à présent une étrangère au rite du Siaynoq le pratiquer mieux qu''elles///', '', 0, 0, 0, 0, 0, ''),
(208, 1, 19, 1, 1, 'Tais-toi ! Chacun de nous naît en sachant qui il est et ce qu''il a à faire///Les petits enfants le savent. Ce n''est qu''après avoir été déformés par les adultes qu''ils enfouissent cette connaissance au plus profond d''eux-mêmes///Enlève tes barrières, Moneo !', '', 0, 0, 0, 0, 0, ''),
(209, 1, 20, 1, 1, 'ARRETE !///******///Ne crains rien, Moeno. Je vois que j''ai surestimé tes forces. Tu es epuisé///<i>Un jour peut-être -sûrement, même -  comprendra il là ou je veux en venir</i>///', '', 0, 0, 0, 0, 0, ''),
(210, 1, 21, 1, 1, 'Une dernière chose, Moneo...///<i>Moneo est fatigué, quelle tentation pour lui que de laisser derrière lui toutes ces années de labeur et de se laisser porter par le temps qui le rattrape</i>///Chaque tentation contient une leçon, Moneo///...///vois la leçon contenue dans ma vie, Moneo///', '', 0, 0, 0, 0, 0, ''),
(211, 1, 22, 1, 1, 'Ils me tentent d''abord par le mal, puis par le bien. Chaque tentation est exquisément adaptée à mes possibilités///Dis moi, Moneo/// Si je choisis ce qui est bien, est-ce que cela me rend forcément bon ?///', '', 0, 0, 0, 0, 0, ''),
(212, 1, 23, 1, 1, '*murmures*///Peut-être ne perdras-tu jamais l''habitude de juger...///', '', 0, 0, 0, 0, 0, ''),
(213, 2, 5, 25, 1, 'Les mémoires sont donc maintenant en passe de se retrouver entre les mains de toutes les maisons majeures...///nul doute que la Guilde, IX, le Bene Tleilax et le Bene Guesserit vont oeuvrer pour décrypter ces mémoires et les rendre publique...///Il faut vite avertir l''empereur !///il se trouve dans la salle du Siaynoq...vous ne voyez ici qu''un hologramme...///sachez tout de même que j''ai beaucoup d''estime pour vous, Moneo...///ca a été un réel plaisir de travailler à vos côté...///', '', 0, 0, 0, 0, 0, ''),
(214, 26, 1, 26, 1, 'La Forteresse Immémoriale !///Prenez la, PRENEZ LA ! ///', '', -1, 0, 0, 0, 0, '$oui=Application_Common::getMyStar(14);\r\nif(!$oui){\r\n$quoteRendu[''quo_maj_quete'']=0;\r\n}else\r\n$text=''Enfin ! Les hordes de truitesses vont pouvoir débarquer et exécuter la famille régnante sur la Forteresse Immémoriale///Ces monstres sont le fruits de mariages consanguins des descendants direct de la famille Harkonnen dégénérescente///'';');

-- --------------------------------------------------------

--
-- Structure de la table `recompense`
--

CREATE TABLE IF NOT EXISTS `recompense` (
  `re_id` int(11) NOT NULL AUTO_INCREMENT,
  `re_id_ext` int(11) NOT NULL,
  `re_id_quete` int(11) NOT NULL,
  `re_id_perso` int(11) NOT NULL,
  `re_renommee` int(11) NOT NULL,
  `re_influence` int(11) NOT NULL,
  `re_influence_faction` int(11) NOT NULL,
  `re_gardien` int(11) NOT NULL,
  `re_gardien_faction` int(11) NOT NULL,
  `re_serviteur` int(11) NOT NULL,
  `re_serviteur_faction` int(11) NOT NULL,
  `re_epice` int(11) NOT NULL,
  `re_troupe` int(11) NOT NULL,
  `re_vaisseau` int(11) NOT NULL,
  `re_corruption` int(11) NOT NULL,
  `re_fnctn` text NOT NULL,
  `re_display` text NOT NULL,
  PRIMARY KEY (`re_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=38 ;

--
-- Contenu de la table `recompense`
--

INSERT INTO `recompense` (`re_id`, `re_id_ext`, `re_id_quete`, `re_id_perso`, `re_renommee`, `re_influence`, `re_influence_faction`, `re_gardien`, `re_gardien_faction`, `re_serviteur`, `re_serviteur_faction`, `re_epice`, `re_troupe`, `re_vaisseau`, `re_corruption`, `re_fnctn`, `re_display`) VALUES
(1, 3, 4, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(1);\r\necho ''<script>\r\nafficheSpice();\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(2, 3, 1, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(2);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(3, 2, 4, 15, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ' 	$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(3);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(4, 1, 3, 15, 0, 0, 0, 0, 0, 0, 0, 0, 500, 0, 0, '$persos=new Core_Model_Mapper_Personnage();\r\n$persos->mouveSalle(15, 15);\r\necho ''<script>\r\nafficheSpice();\r\n</script>'';', '<tr><td>Vous gagnez 500 épices</td></tr>'),
(5, 1, 4, 15, 0, 0, 0, 0, 0, 0, 0, 2000, 0, 0, 100, '$persos=new Core_Model_Mapper_Personnage();\r\n$persos->mouveSalle(15, 15);\r\necho ''<script>\r\nafficheSpice();\r\n</script>'';', '<tr><td>Vous gagnez 2000 épices</td><td>Votre corruption augmente</td></tr>'),
(6, 1, 8, 13, 0, 0, 0, 0, 0, 0, 0, -500, 0, 0, 0, '  $squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(4);\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td><td>Vous perdez 500 épice</td></tr>'),
(7, 1, 1, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$perso=new Core_Model_Mapper_Personnage();\r\nif($perso->getObjet(4)){\r\n$perso->supprObjet(0,4);\r\necho''<script>afficheObject();</script>'';\r\n}\r\nelse $stopDisplay=1;\r\n', '<tr><td>Vous donnez votre liqueur d''épice</td></tr>'),
(9, 1, 9, 18, 0, 2, 0, 2, 0, 2, 0, 0, 0, 0, 0, '', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>2 Points d\\''influence</td><td>2 Escortes</td></tr><tr><td>2 Serviteurs</td><td></td></tr>'),
(10, 1, 2, 6, 0, 0, 0, 0, 0, 2, 4, 0, 0, 0, 100, 'echo ''<script>afficheGraphe();</script>'';', '<tr><td>Les Tleilaxu reçoivent deux serviteurs</td><td>Votre corruption augmente</td></tr>'),
(11, 1, 10, 6, 0, 3, 0, 3, 0, 3, 0, 3500, 0, 15, 0, '$perso=new Core_Model_Mapper_Personnage();\r\n\r\n$perso->supprObjet(0,6);\r\necho''<script>afficheSpice();afficheObject();</script>'';\r\n', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>3 Points d\\''influence</td><td>3 Escortes</td></tr><tr><td>3 Serviteurs</td><td>3500 épices</td></tr><tr><td>15 vaisseaux</td><td></td></tr>'),
(13, 2, 1, 21, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ' 	$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(9);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(14, 2, 5, 18, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '  $squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(10);\r\nApplication_Common::setEpices(''-half'', 1);\r\n\r\n$king=Application_Common::getMajQueste (3,22,1);\r\nif(!$king)\r\nApplication_Common::majQueste(3,22,1);\r\n\r\n\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td><td>Vous perdez la moitié de votre épice</td></tr>'),
(15, 9, 1, 14, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Application_Common::setEpices(''half'', 1);\r\n\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td></td><td>Vous gagnez la moitié de votre épice</td></tr>'),
(16, 1, 4, 22, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '  $squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->supprObjet(0,10);\r\n$squotes->addObjet(8);\r\nApplication_Common::setArret(167,1);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez donné le Krys</td><td>Vous avez remporté un objet</td></tr>'),
(17, 1, 1, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(11);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(18, 1, 6, 7, 0, 0, 0, 7, 0, 0, 0, 25000, 0, 0, 200, '$perso=new Core_Model_Mapper_Personnage();\r\n$perso->mouveSalle(23, 200);\r\n\r\necho ''<script>\r\nafficheSpice();\r\n</script>'';', ' 	<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>7 Escortes</td><td>25000 épices</td></tr><tr><td>Votre corruption augmente</td><td></td></tr>'),
(19, 1, 8, 7, 0, 2, 0, 2, 0, 2, 0, 2000, 0, 0, 0, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';', ' <tr><td >Vous avez remporté :</td><td></td></tr><tr><td>2 Escortes</td><td>2000 épices</td></tr><tr><td>2 Serviteurs</td><td>2 Points d\\''influence</td></tr>'),
(20, 1, 9, 7, 0, 0, 0, 9, 0, 2, 0, 2000, 0, 0, 0, 'Application_Common::setZeroCorruption();\r\n\r\necho ''<script>\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>9 Escortes</td><td>2000 épices</td></tr><tr><td>2 Serviteurs</td><td>Votre corruption est désormais à 0</td></tr>'),
(21, 2, 3, 7, 0, 0, 0, 0, 0, 0, 0, 5000, 0, 0, 0, 'Application_Common::deleteobject(13);\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez vendu :</td><td></td></tr><tr><td>les poésies pour 5000 épices</td><td></td></tr><tr><td></td><td></td></tr>'),
(22, 2, 4, 7, 0, 2, 0, 5, 0, 2, 0, -5000, 0, 0, 0, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>5 Escortes</td><td>2 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 5000 épices</td></tr>'),
(23, 2, 5, 7, 0, 2, 0, 5, 0, 2, 0, -1000, 0, 0, 350, 'Application_Common::setServiteurHouse(-999, 5);\r\necho ''<script>\r\nafficheSpice();\r\nafficheGraphe();\r\n</script>'';', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>5 Escortes</td><td>2 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 1000 épices</td></tr><tr><td>Votre corruption augmente</td><td>Les serviteurs Ixien sont parti</td></tr>'),
(24, 2, 3, 6, 0, 0, 0, 0, 0, 0, 0, 6000, 0, 0, 0, 'Application_Common::deleteobject(13);\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez vendu :</td><td></td></tr><tr><td>les poésies pour 6000 épices</td><td></td></tr><tr><td></td><td></td></tr>'),
(25, 2, 6, 7, 0, 2, 0, 8, 0, 3, 0, -6000, 0, 0, 0, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';\r\nApplication_Common::majQueste (4,6,2);', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>8 Escortes</td><td>3 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 6000 épices</td></tr>'),
(26, 2, 7, 7, 0, 2, 0, 5, 0, 2, 0, -3000, 0, 0, 250, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';\r\nApplication_Common::majQueste (4,6,2);', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>5 Escortes</td><td>2 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 3000 épices</td></tr><tr><td>Votre corruption augmente</td><td></td></tr>'),
(27, 2, 8, 7, 0, 0, 0, 0, 0, 0, 0, 10000, 0, 0, 0, 'Application_Common::deleteobject(13);\r\necho ''<script>\r\nafficheObject();\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez vendu :</td><td></td></tr><tr><td>les poésies pour 10 000 épices</td><td></td></tr><tr><td></td><td></td></tr>'),
(28, 2, 9, 7, 0, 2, 0, 8, 0, 3, 0, -8000, 0, 0, 0, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';\r\n', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>8 Escortes</td><td>3 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 8000 épices</td></tr>'),
(29, 2, 10, 7, 0, 2, 0, 5, 0, 2, 0, -5000, 0, 0, 250, 'echo ''<script>\r\nafficheSpice();\r\n</script>'';', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>5 Escortes</td><td>2 Serviteurs</td></tr><tr><td>2 Points d''influence</td><td>Vous perdez 5000 épices</td></tr><tr><td>Votre corruption augmente</td><td></td></tr>'),
(30, 1, 2, 8, 0, 0, 0, 0, 0, 2, 0, 0, 500, 0, 0, '', '<tr><td>Vous avez remporté :</td><td></td></tr><tr><td> 500 Troupes</td><td>2 Serviteurs</td></tr>'),
(31, 1, 4, 8, 0, 0, 0, 0, 0, 4, 0, 0, 1000, 0, 0, '', '<tr><td>Vous avez remporté :</td><td></td></tr><tr><td> 1000 Troupes</td><td>4 Serviteurs</td></tr>'),
(32, 1, 7, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(14);\r\n\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td><td></td></tr>'),
(33, 1, 2, 24, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Application_Common::deleteobject(14);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';\r\n$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->majPorte(5, 0);\r\n$squotes->majPorte(6, 0);\r\n$squotes->majPorte(7, 0);\r\n$squotes->majPorte(8, 0);', '<tr><td >Vous avez donné les preuves</td><td></td></tr><tr><td>Les maisons majeures ne vous recevront plus</td></tr>'),
(34, 1, 2, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, ' 	$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->addObjet(15);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';', '<tr><td>Vous avez remporté un objet</td></tr>'),
(35, 1, 4, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 'Application_Common::deleteobject(15);\r\necho ''<script>\r\nafficheObject();\r\n</script>'';\r\n$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->majPorte(4, 1);', '<tr><td>Vous donnez les Mémoires volées</td></tr><tr><td colspan=2>Une porte du palais est maintenant ouverte</td></tr>'),
(36, 1, 5, 25, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->majPorte(4, 1);', '<tr><td colspan=2>Une porte du palais est maintenant ouverte</td></tr>'),
(37, 1, 1, 26, 0, 4, 0, 0, 0, 4, 0, 0, 0, 0, 0, '', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>4 Points d\\''influence</td<td>4 Serviteurs</td><td></td></tr>');

-- --------------------------------------------------------

--
-- Structure de la table `recompense_multi`
--

CREATE TABLE IF NOT EXISTS `recompense_multi` (
  `rem_id` int(11) NOT NULL AUTO_INCREMENT,
  `rem_id_lien` int(11) NOT NULL,
  `rem_renommee` int(11) NOT NULL,
  `rem_influence` int(11) NOT NULL,
  `rem_influence_faction` int(11) NOT NULL,
  `rem_gardien` int(11) NOT NULL,
  `rem_gardien_faction` int(11) NOT NULL,
  `rem_serviteur` int(11) NOT NULL,
  `rem_serviteur_faction` int(11) NOT NULL,
  `rem_epice` int(11) NOT NULL,
  `rem_troupe` int(11) NOT NULL,
  `rem_vaisseau` int(11) NOT NULL,
  `rem_corruption` int(11) NOT NULL,
  `rem_fnctn` text NOT NULL,
  `rem_display` text NOT NULL,
  PRIMARY KEY (`rem_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Contenu de la table `recompense_multi`
--

INSERT INTO `recompense_multi` (`rem_id`, `rem_id_lien`, `rem_renommee`, `rem_influence`, `rem_influence_faction`, `rem_gardien`, `rem_gardien_faction`, `rem_serviteur`, `rem_serviteur_faction`, `rem_epice`, `rem_troupe`, `rem_vaisseau`, `rem_corruption`, `rem_fnctn`, `rem_display`) VALUES
(1, 1, 0, 1, 0, 2, 0, 2, 0, 250, 0, 10, 0, '$squotes=new Core_Model_Mapper_Personnage();\r\n$squotes->mouveSalle(3, 12);\r\n$squotes->majPorte(2, 1);\r\necho ''<script>\r\nafficheSpice();\r\nopenDoorCote(2, 2);\r\n$("#sayyaoto").stopTime().mouvMarcheDrt();\r\nmouveLeft("sayyaoto");\r\n</script>'';', '<tr><td >Vous avez remporté :</td><td></td></tr><tr><td>1 Point d''Influence</td><td>2 Escortes</td></tr><tr><td>2 Serviteurs</td><td>250 épices</td></tr><tr><td>10 vaisseaux</td><td></td></tr>');

-- --------------------------------------------------------

--
-- Structure de la table `recompense_multi_condition`
--

CREATE TABLE IF NOT EXISTS `recompense_multi_condition` (
  `remc_id` int(255) NOT NULL AUTO_INCREMENT,
  `remc_id_lien` int(255) NOT NULL,
  `remc_id_quete` int(255) NOT NULL,
  `remc_id_perso` int(255) NOT NULL,
  `remc_id_ext` int(255) NOT NULL,
  PRIMARY KEY (`remc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `recompense_multi_condition`
--

INSERT INTO `recompense_multi_condition` (`remc_id`, `remc_id_lien`, `remc_id_quete`, `remc_id_perso`, `remc_id_ext`) VALUES
(3, 1, 4, 2, 3),
(4, 1, 4, 4, 3);

-- --------------------------------------------------------

--
-- Structure de la table `salle`
--

CREATE TABLE IF NOT EXISTS `salle` (
  `sa_id` int(11) NOT NULL AUTO_INCREMENT,
  `sa_nom` varchar(255) NOT NULL,
  `sa_musique` varchar(211) NOT NULL,
  PRIMARY KEY (`sa_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Contenu de la table `salle`
--

INSERT INTO `salle` (`sa_id`, `sa_nom`, `sa_musique`) VALUES
(1, 'trone', 'fond2.mp3'),
(2, 'couloir', 'hangar.mp3'),
(3, 'vaisseaux', 'hangar.mp3'),
(4, 'chambre', 'fond1.mp3'),
(5, 'carte', 'hangar.mp3'),
(6, 'hangar', 'hangar.mp3'),
(7, 'diplomate', 'hangar.mp3'),
(8, 'couloir2', 'fond1.mp3'),
(9, 'commune', 'fond1.mp3'),
(10, 'magasinpalais', 'magasin.mp3'),
(11, 'couloir3', 'fond1.mp3'),
(12, 'bibliotheque', 'fond1.mp3'),
(13, 'bar', 'scumm.mp3'),
(14, 'entree', 'fond1.mp3'),
(15, 'representants', 'fond1.mp3'),
(16, 'couloir4', 'fond1.mp3'),
(17, 'chambre1', 'fond1.mp3'),
(18, 'chambre2', 'fond1.mp3'),
(19, 'chambre3', 'fond1.mp3'),
(20, 'chambre4', 'fond1.mp3'),
(21, 'barfond', 'scumm.mp3'),
(22, 'indice', ''),
(23, 'marches', 'village.mp3'),
(24, 'village1', 'village.mp3'),
(25, 'village2', 'village.mp3'),
(26, 'village3', 'village.mp3'),
(27, 'desert1', 'desert.mp3'),
(28, 'desert2', 'desert.mp3'),
(29, 'desert3', 'desert.mp3'),
(30, 'desert4', 'desert.mp3'),
(31, 'desert5', 'fond1.mp3'),
(32, 'desert6', 'fond1.mp3'),
(33, 'village4', 'village.mp3'),
(34, 'habitat1', 'distille.mp3'),
(35, 'siaynoq', 'fond_end.mp3');

-- --------------------------------------------------------

--
-- Structure de la table `salle_perso`
--

CREATE TABLE IF NOT EXISTS `salle_perso` (
  `sal_id` int(11) NOT NULL AUTO_INCREMENT,
  `sal_id_salle` int(255) NOT NULL,
  `sal_id_user` int(255) NOT NULL,
  `sal_id_perso` int(255) NOT NULL,
  PRIMARY KEY (`sal_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Contenu de la table `salle_perso`
--

INSERT INTO `salle_perso` (`sal_id`, `sal_id_salle`, `sal_id_user`, `sal_id_perso`) VALUES
(1, 1, 12, 1),
(2, 1, 12, 2),
(3, 9, 12, 3),
(4, 1, 12, 4),
(6, 1, 12, 5),
(7, 1, 12, 6),
(8, 1, 12, 7),
(9, 1, 12, 8),
(10, 3, 12, 10),
(11, 5, 12, 9),
(12, 7, 12, 11),
(13, 2, 12, 12),
(14, 13, 12, 13),
(15, 13, 12, 14),
(16, 15, 12, 15),
(17, 10, 12, 16),
(18, 13, 12, 17),
(19, 9, 12, 18),
(20, 14, 12, 19),
(21, 33, 12, 20),
(22, 11, 12, 21),
(23, 34, 12, 22),
(24, 333, 12, 23),
(25, 23, 12, 24),
(26, 999, 12, 25),
(27, 34, 12, 26);

-- --------------------------------------------------------

--
-- Structure de la table `serviteur`
--

CREATE TABLE IF NOT EXISTS `serviteur` (
  `ser_id` int(11) NOT NULL AUTO_INCREMENT,
  `ser_id_user` int(11) NOT NULL,
  `ser_id_faction` int(11) NOT NULL,
  `ser_nb_serviteur` int(11) NOT NULL,
  PRIMARY KEY (`ser_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `serviteur`
--

INSERT INTO `serviteur` (`ser_id`, `ser_id_user`, `ser_id_faction`, `ser_nb_serviteur`) VALUES
(1, 12, 3, 0),
(2, 12, 4, 0),
(3, 12, 5, 0),
(4, 12, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `suggestion_epice`
--

CREATE TABLE IF NOT EXISTS `suggestion_epice` (
  `sug_id` int(11) NOT NULL AUTO_INCREMENT,
  `sug_id_user` int(11) NOT NULL,
  `sug_id_faction` int(11) NOT NULL,
  `sug_nb_suggestion` int(11) NOT NULL,
  PRIMARY KEY (`sug_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `suggestion_epice`
--

INSERT INTO `suggestion_epice` (`sug_id`, `sug_id_user`, `sug_id_faction`, `sug_nb_suggestion`) VALUES
(1, 12, 3, 40),
(2, 12, 4, 40),
(3, 12, 5, 40),
(4, 12, 6, 40);

-- --------------------------------------------------------

--
-- Structure de la table `user_quete`
--

CREATE TABLE IF NOT EXISTS `user_quete` (
  `us_id` int(255) NOT NULL AUTO_INCREMENT,
  `us_id_user` int(255) NOT NULL,
  `us_id_quete` int(255) NOT NULL,
  `us_id_perso` int(255) NOT NULL,
  `us_id_ext` int(255) NOT NULL,
  PRIMARY KEY (`us_id`),
  UNIQUE KEY `us_id_user` (`us_id_user`,`us_id_quete`,`us_id_perso`,`us_id_ext`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=514 ;

--
-- Contenu de la table `user_quete`
--

INSERT INTO `user_quete` (`us_id`, `us_id_user`, `us_id_quete`, `us_id_perso`, `us_id_ext`) VALUES
(498, 12, 0, 1, 0),
(26, 12, 0, 2, 0),
(1, 12, 0, 3, 0),
(488, 12, 0, 4, 0),
(72, 12, 0, 5, 0),
(73, 12, 0, 6, 0),
(74, 12, 0, 7, 0),
(75, 12, 0, 8, 0),
(63, 12, 0, 9, 0),
(64, 12, 0, 10, 0),
(209, 12, 0, 11, 0),
(71, 12, 0, 12, 0),
(133, 12, 0, 13, 0),
(163, 12, 0, 14, 0),
(142, 12, 0, 15, 0),
(233, 12, 0, 16, 0),
(264, 12, 0, 18, 0),
(305, 12, 0, 19, 0),
(306, 12, 0, 20, 0),
(358, 12, 0, 21, 0),
(363, 12, 0, 22, 0),
(401, 12, 0, 23, 0),
(493, 12, 0, 24, 0),
(495, 12, 0, 25, 0),
(513, 12, 0, 26, 0);
