-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Mar 02 Avril 2013 à 18:28
-- Version du serveur: 5.5.29
-- Version de PHP: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Base de données: `CalendrierWeb`
--

-- --------------------------------------------------------

--
-- Structure de la table `Event`
--

CREATE TABLE `Event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `jour` int(2) NOT NULL,
  `mois` int(2) NOT NULL,
  `annee` int(4) NOT NULL,
  `heure_debut` int(2) NOT NULL,
  `min_debut` int(2) NOT NULL,
  `heure_fin` int(2) NOT NULL,
  `min_fin` int(2) NOT NULL,
  `titre` varchar(30) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Contenu de la table `Event`
--

INSERT INTO `Event` (`id`, `user_id`, `jour`, `mois`, `annee`, `heure_debut`, `min_debut`, `heure_fin`, `min_fin`, `titre`, `description`) VALUES
(8, 19, 12, 13, 1434, 10, 10, 11, 12, 'tony', 'RDV '),
(9, 19, 12, 13, 1434, 10, 10, 11, 12, 'tony', 'RDV '),
(10, 20, 12, 4, 2013, 11, 11, 12, 10, 'RDV', 'Rdv avec les patrons'),
(11, 20, 3, 3, 2013, 11, 11, 12, 12, 'ttt', 'dajazdjaljfezlk'),
(14, 20, 10, 0, 2, 10, 10, 11, 12, 'tony', 'azzza'),
(15, 20, 10, 2, 2013, 10, 10, 11, 12, 'tony', 'azzza'),
(16, 20, 10, 12, 2013, 10, 10, 11, 12, 'tony', 'azzza'),
(17, 20, 2, 2, 2013, 10, 10, 11, 12, 'tony', 'azzza'),
(18, 20, 2, 12, 2013, 10, 10, 11, 12, 'tony', 'azzza'),
(19, 20, 12, 3, 2013, 11, 11, 12, 12, 'ttt', 'tg');

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(50) COLLATE utf8_bin NOT NULL,
  `pass` varchar(255) COLLATE utf8_bin NOT NULL,
  `pays` varchar(40) COLLATE utf8_bin NOT NULL,
  `pseudo` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`),
  UNIQUE KEY `pseudo` (`pseudo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=21 ;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id`, `login`, `pass`, `pays`, `pseudo`) VALUES
(17, 'tony@free.fr', 'e9d201156af7da6c52faf85ab4fa43268edf7ecba64a9c016167a0d460dc6ecc', 'france', 'tony'),
(19, 'titi@free.fr', 'a665a45920422f9d417e4867efdc4fb8a04a1f3fff1fa07e998e86f7f7a27ae3', 'france', 'titi'),
(20, 'ppt@free.fr', 'f2d81a260dea8a100dd517984e53c56a7523d96942a834b9cdc249bd4e8c7aa9', 'france', 'tony675');

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `Event`
--
ALTER TABLE `Event`
  ADD CONSTRAINT `Event_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `members` (`id`);
