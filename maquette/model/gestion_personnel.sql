-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 30 août 2024 à 05:53
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gestion_personnel`
--

-- --------------------------------------------------------

--
-- Structure de la table `balise`
--

CREATE TABLE `balise` (
  `id` int(11) NOT NULL,
  `statut` enum('désinstallée','installée','en stock') NOT NULL,
  `id_intervention` int(11) DEFAULT NULL,
  `num_serie` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `balise`
--

INSERT INTO `balise` (`id`, `statut`, `id_intervention`, `num_serie`) VALUES
(1, 'en stock', 1, 'AA352');

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

CREATE TABLE `clients` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `type_client` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `adresse_postale` varchar(255) NOT NULL,
  `situation_geographique` varchar(255) NOT NULL,
  `date_debut_contrat` date NOT NULL,
  `date_fin_contrat` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`id`, `nom`, `type_client`, `email`, `telephone`, `adresse_postale`, `situation_geographique`, `date_debut_contrat`, `date_fin_contrat`) VALUES
(1, 'Basson', 'nicolas', 'fabrice.basson@gmail.com', '698264212', 'Bonaberi', 'Douala', '2024-07-29', '2024-08-30');

-- --------------------------------------------------------

--
-- Structure de la table `interventions`
--

CREATE TABLE `interventions` (
  `id` int(11) NOT NULL,
  `objet` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `debut_travaux` date DEFAULT NULL,
  `fin_travaux` date DEFAULT NULL,
  `lieu_intervention` varchar(255) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `interventions`
--

INSERT INTO `interventions` (`id`, `objet`, `description`, `client_id`, `debut_travaux`, `fin_travaux`, `lieu_intervention`, `users_id`) VALUES
(1, 'installation', 'on installe cette balise', 1, '0000-00-00', '0000-00-00', 'douala', 1),
(2, 'desintallation', 'on installe cette balise', 1, '2024-08-08', '2024-08-18', 'douala', 1);

-- --------------------------------------------------------

--
-- Structure de la table `travaux`
--

CREATE TABLE `travaux` (
  `id` int(11) NOT NULL,
  `technicien_id` int(11) NOT NULL,
  `intervention_id` int(11) NOT NULL,
  `type_intervention` enum('installation','désinstallation','maintenance') NOT NULL,
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `user_name`, `password`, `role`) VALUES
(1, 'elias', '123', 'admin'),
(2, 'john', 'abc', 'technicien');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `balise`
--
ALTER TABLE `balise`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_intervention` (`id_intervention`);

--
-- Index pour la table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `users_id` (`users_id`);

--
-- Index pour la table `travaux`
--
ALTER TABLE `travaux`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technicien_id` (`technicien_id`),
  ADD KEY `intervention_id` (`intervention_id`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `balise`
--
ALTER TABLE `balise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `interventions`
--
ALTER TABLE `interventions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `travaux`
--
ALTER TABLE `travaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `balise`
--
ALTER TABLE `balise`
  ADD CONSTRAINT `balise_ibfk_1` FOREIGN KEY (`id_intervention`) REFERENCES `interventions` (`id`);

--
-- Contraintes pour la table `interventions`
--
ALTER TABLE `interventions`
  ADD CONSTRAINT `interventions_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `clients` (`id`),
  ADD CONSTRAINT `interventions_ibfk_2` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`);

--
-- Contraintes pour la table `travaux`
--
ALTER TABLE `travaux`
  ADD CONSTRAINT `travaux_ibfk_1` FOREIGN KEY (`technicien_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `travaux_ibfk_2` FOREIGN KEY (`intervention_id`) REFERENCES `interventions` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
