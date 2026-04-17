-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 17 avr. 2026 à 10:23
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
-- Base de données : `ecommerce_db`
--

-- --------------------------------------------------------

--
-- Structure de la table `commandes`
--

CREATE TABLE `commandes` (
  `id_com` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `date_com` datetime DEFAULT current_timestamp(),
  `total_com` decimal(10,2) NOT NULL,
  `statut` varchar(50) DEFAULT 'En attente'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `commandes`
--

INSERT INTO `commandes` (`id_com`, `id_user`, `date_com`, `total_com`, `statut`) VALUES
(4, 5, '2026-04-17 01:50:54', 25000.00, 'En attente'),
(5, 5, '2026-04-17 03:32:05', 20500.00, 'En attente');

-- --------------------------------------------------------

--
-- Structure de la table `ligne_commande`
--

CREATE TABLE `ligne_commande` (
  `id_ligne` int(11) NOT NULL,
  `id_com` int(11) NOT NULL,
  `id_prod` int(11) NOT NULL,
  `quantite` int(11) NOT NULL,
  `prix_unitaire` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `ligne_commande`
--

INSERT INTO `ligne_commande` (`id_ligne`, `id_com`, `id_prod`, `quantite`, `prix_unitaire`) VALUES
(4, 4, 10, 1, 10000.00),
(5, 4, 3, 1, 15000.00),
(6, 5, 3, 1, 15000.00),
(7, 5, 5, 1, 3500.00),
(8, 5, 8, 1, 2000.00);

-- --------------------------------------------------------

--
-- Structure de la table `produits`
--

CREATE TABLE `produits` (
  `id_prod` int(11) NOT NULL,
  `nom_prod` varchar(150) DEFAULT NULL,
  `categrie` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `prix` decimal(10,2) DEFAULT NULL,
  `image_prod` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `produits`
--

INSERT INTO `produits` (`id_prod`, `nom_prod`, `categrie`, `description`, `prix`, `image_prod`) VALUES
(1, 'Collier Perles Royales', 'Colliers', 'Parure prestigieuse en perles de nacre véritables, idéale pour les grandes cérémonies.', 55000.00, 'collier_1.jfif'),
(2, 'Collier Perles fines', 'Colliers', 'Un collier délicat et léger pour apporter une touche d\'élégance discrète à votre tenue.', 5000.00, 'collier_2.jfif'),
(3, 'Sautoir Tradition', 'Colliers', 'Sautoir artisanal multi-rangs alliant modernité et savoir-faire traditionnel.', 15000.00, 'collier_3.jfif'),
(4, 'Baya Séduction', 'Bayas', 'Ensemble de perles de hanches raffinées, conçu pour sublimer la silhouette féminine.', 25000.00, 'baya_1.jfif'),
(5, 'Baya Éclat', 'Bayas', 'Fines perles de taille aux reflets changeants, parfaites pour un port quotidien.', 3500.00, 'baya_2.jfif'),
(6, 'Trio de Bayas', 'Bayas', 'Assortiment de trois parures de hanches aux couleurs vibrantes et harmonieuses.', 12000.00, 'baya_3.jfif'),
(7, 'Boucles d\'oreilles Orfèvre', 'Boucles', 'Créoles sculptées à la main avec des finitions dorées de haute qualité.', 30000.00, 'boucle_1.jfif'),
(8, 'Puces d\'oreilles Perles', 'Boucles', 'Classiques et intemporelles, ces puces en perles s\'adaptent à tous les styles.', 2000.00, 'boucle_2.jfif'),
(9, 'Pendants Scintillants', 'Boucles', 'Boucles d\'oreilles pendantes ornées de cristaux pour un éclat incomparable.', 8500.00, 'boucle_3.jfif'),
(10, 'Chevillère Royale', 'Chevillères', 'Chaîne de cheville élégante avec de fins détails travaillés pour un port distingué.', 10000.00, 'cheville_1.jfif'),
(11, 'Chevillère Bohème', 'Chevillères', 'Mélange de perles colorées et de petits coquillages pour un style estival.', 1500.00, 'cheville_2.jfif'),
(12, 'Double Chaîne Acier', 'Chevillères', 'Double rang de chaîne en acier inoxydable, résistant et très tendance.', 5500.00, 'cheville_3.jfif');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

CREATE TABLE `utilisateurs` (
  `id_user` int(11) NOT NULL,
  `pseudo` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL,
  `photo_profil` varchar(255) DEFAULT 'default.png',
  `is_confirmed` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id_user`, `pseudo`, `email`, `password`, `photo_profil`, `is_confirmed`) VALUES
(1, 'zaza', 'mamoudouzakiya07@gmail.com', '$2y$10$6GUkCE64gyByFvRwth65pOq1sBDWH2JGMrr5zMSajwY66NKxJJdMC', 'profil_1776379359.png', 0),
(5, 'lola', 'mamoudouzakiya1956@gmail.com', '$2y$10$FJ017iftPd4486HtOxm3eukv39CcSFuChiuyi8I6rzCOhVe5hCt.W', 'profil_1776390561.png', 0);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD PRIMARY KEY (`id_com`),
  ADD KEY `id_user` (`id_user`);

--
-- Index pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD PRIMARY KEY (`id_ligne`),
  ADD KEY `fk1` (`id_com`),
  ADD KEY `fk2` (`id_prod`);

--
-- Index pour la table `produits`
--
ALTER TABLE `produits`
  ADD PRIMARY KEY (`id_prod`);

--
-- Index pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  ADD PRIMARY KEY (`id_user`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `commandes`
--
ALTER TABLE `commandes`
  MODIFY `id_com` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  MODIFY `id_ligne` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `produits`
--
ALTER TABLE `produits`
  MODIFY `id_prod` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `utilisateurs`
--
ALTER TABLE `utilisateurs`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `commandes`
--
ALTER TABLE `commandes`
  ADD CONSTRAINT `commandes_ibfk_1` FOREIGN KEY (`id_user`) REFERENCES `utilisateurs` (`id_user`) ON DELETE CASCADE;

--
-- Contraintes pour la table `ligne_commande`
--
ALTER TABLE `ligne_commande`
  ADD CONSTRAINT `fk1` FOREIGN KEY (`id_com`) REFERENCES `commandes` (`id_com`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk2` FOREIGN KEY (`id_prod`) REFERENCES `produits` (`id_prod`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
