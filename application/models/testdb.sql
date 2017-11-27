-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Client :  127.0.0.1
-- Généré le :  Lun 30 Octobre 2017 à 11:37
-- Version du serveur :  10.1.21-MariaDB
-- Version de PHP :  5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `testdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `colors`
--

CREATE TABLE `colors` (
  `id_color` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `color_code` varchar(255) DEFAULT NULL,
  `id_group_color` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `customers`
--

CREATE TABLE `customers` (
  `id_customer` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobil_phone_number` varchar(20) NOT NULL,
  `phone_numer` varchar(20) NOT NULL,
  `mail` varchar(25) NOT NULL,
  `adress` varchar(255) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `id_group_customer` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `etats`
--

CREATE TABLE `etats` (
  `id_etat` int(11) NOT NULL,
  `name_etat` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groups_colors`
--

CREATE TABLE `groups_colors` (
  `id_group_color` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groups_customers`
--

CREATE TABLE `groups_customers` (
  `id_group_customer` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL

) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Insertion d'un groupe par defaut dans la table 'groups_customers'
--
INSERT INTO `groups_customers` (`id_group_customer`, `name`, `actif`) VALUES (NULL, 'Defaut', '1')
-- --------------------------------------------------------


--
-- Structure de la table `groups_members`
--

CREATE TABLE `groups_members` (
  `id_group_member` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `groups_members`
--

INSERT INTO `groups_members` (`id_group_member`, `name`) VALUES
(1, 'Admin'),
(2, 'utilisateurs'),
(3, 'invités');

-- --------------------------------------------------------

--
-- Structure de la table `groups_products`
--

CREATE TABLE `groups_products` (
  `id_group_product` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `groups_sizes`
--

CREATE TABLE `groups_sizes` (
  `id_group_size` int(11) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `members`
--

CREATE TABLE `members` (
  `id_member` int(11) NOT NULL,
  `login` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actif` tinyint(1) NOT NULL,
  `email` varchar(255) NOT NULL,
  `id_group_member` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `members`
--

INSERT INTO `members` (`id_member`, `login`, `password`, `actif`, `email`, `id_group_member`) VALUES
(3, 'dilate', '123456', 0, 'pablo30@gmx.fr', 1),
(4, 'alexandra', '123', 0, 'edfzeaf@fezrf.gt', 3);

-- --------------------------------------------------------

--
-- Structure de la table `methods_payments`
--

CREATE TABLE `methods_payments` (
  `id_method_payment` int(11) NOT NULL,
  `name_method` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `methods_shippings`
--

CREATE TABLE `methods_shippings` (
  `id_method_shipping` int(11) NOT NULL,
  `name_method_shipping` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

CREATE TABLE `orders` (
  `id_order` int(11) NOT NULL,
  `date_order` date NOT NULL,
  `status_order` varchar(255) NOT NULL,
  `comment_order` varchar(255) NOT NULL,
  `price_order` float NOT NULL,
  `id_customer` int(11) NOT NULL,
  `id_method_payment` int(11) NOT NULL,
  `id_method_shipping` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `orders_members`
--

CREATE TABLE `orders_members` (
  `date_cm` date DEFAULT NULL,
  `id_member` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

CREATE TABLE `products` (
  `id_product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `base_price` float NOT NULL,
  `id_group_color` int(11) NOT NULL,
  `id_group_product` int(11) NOT NULL,
  `id_group_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `product_order`
--

CREATE TABLE `product_order` (
  `quantity_product` varchar(25) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `sizes`
--

CREATE TABLE `sizes` (
  `id_size` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` float NOT NULL,
  `id_group_size` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `colors`
--
ALTER TABLE `colors`
  ADD PRIMARY KEY (`id_color`),
  ADD KEY `FK_colors_id_group_color` (`id_group_color`);

--
-- Index pour la table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`id_customer`),
  ADD KEY `FK_customers_id_group_customer` (`id_group_customer`);

--
-- Index pour la table `etats`
--
ALTER TABLE `etats`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `groups_colors`
--
ALTER TABLE `groups_colors`
  ADD PRIMARY KEY (`id_group_color`);

--
-- Index pour la table `groups_customers`
--
ALTER TABLE `groups_customers`
  ADD PRIMARY KEY (`id_group_customer`);

--
-- Index pour la table `groups_members`
--
ALTER TABLE `groups_members`
  ADD PRIMARY KEY (`id_group_member`);

--
-- Index pour la table `groups_products`
--
ALTER TABLE `groups_products`
  ADD PRIMARY KEY (`id_group_product`);

--
-- Index pour la table `groups_sizes`
--
ALTER TABLE `groups_sizes`
  ADD PRIMARY KEY (`id_group_size`);

--
-- Index pour la table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id_member`),
  ADD KEY `FK_members_id_group_member` (`id_group_member`);

--
-- Index pour la table `methods_payments`
--
ALTER TABLE `methods_payments`
  ADD PRIMARY KEY (`id_method_payment`);

--
-- Index pour la table `methods_shippings`
--
ALTER TABLE `methods_shippings`
  ADD PRIMARY KEY (`id_method_shipping`);

--
-- Index pour la table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id_order`),
  ADD KEY `FK_orders_id_customer` (`id_customer`),
  ADD KEY `FK_orders_id_method_payment` (`id_method_payment`),
  ADD KEY `FK_orders_id_method_shipping` (`id_method_shipping`);

--
-- Index pour la table `orders_members`
--
ALTER TABLE `orders_members`
  ADD PRIMARY KEY (`id_member`,`id_order`,`id_etat`),
  ADD KEY `FK_orders_members_id_order` (`id_order`),
  ADD KEY `FK_orders_members_id_etat` (`id_etat`);

--
-- Index pour la table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id_product`),
  ADD KEY `FK_products_id_group_color` (`id_group_color`),
  ADD KEY `FK_products_id_group_product` (`id_group_product`),
  ADD KEY `FK_products_id_group_size` (`id_group_size`);

--
-- Index pour la table `product_order`
--
ALTER TABLE `product_order`
  ADD PRIMARY KEY (`id_product`,`id_order`),
  ADD KEY `FK_product_order_id_order` (`id_order`);

--
-- Index pour la table `sizes`
--
ALTER TABLE `sizes`
  ADD PRIMARY KEY (`id_size`),
  ADD KEY `FK_sizes_id_group_size` (`id_group_size`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `colors`
--
ALTER TABLE `colors`
  MODIFY `id_color` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `customers`
--
ALTER TABLE `customers`
  MODIFY `id_customer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `etats`
--
ALTER TABLE `etats`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groups_colors`
--
ALTER TABLE `groups_colors`
  MODIFY `id_group_color` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groups_customers`
--
ALTER TABLE `groups_customers`
  MODIFY `id_group_customer` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groups_members`
--
ALTER TABLE `groups_members`
  MODIFY `id_group_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT pour la table `groups_products`
--
ALTER TABLE `groups_products`
  MODIFY `id_group_product` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `groups_sizes`
--
ALTER TABLE `groups_sizes`
  MODIFY `id_group_size` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `members`
--
ALTER TABLE `members`
  MODIFY `id_member` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT pour la table `methods_payments`
--
ALTER TABLE `methods_payments`
  MODIFY `id_method_payment` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `methods_shippings`
--
ALTER TABLE `methods_shippings`
  MODIFY `id_method_shipping` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `orders`
--
ALTER TABLE `orders`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `products`
--
ALTER TABLE `products`
  MODIFY `id_product` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `sizes`
--
ALTER TABLE `sizes`
  MODIFY `id_size` int(11) NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `colors`
--
ALTER TABLE `colors`
  ADD CONSTRAINT `FK_colors_id_group_color` FOREIGN KEY (`id_group_color`) REFERENCES `groups_colors` (`id_group_color`);

--
-- Contraintes pour la table `customers`
--
ALTER TABLE `customers`
  ADD CONSTRAINT `FK_customers_id_group_customer` FOREIGN KEY (`id_group_customer`) REFERENCES `groups_customers` (`id_group_customer`);

--
-- Contraintes pour la table `members`
--
ALTER TABLE `members`
  ADD CONSTRAINT `FK_members_id_group_member` FOREIGN KEY (`id_group_member`) REFERENCES `groups_members` (`id_group_member`);

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_orders_id_customer` FOREIGN KEY (`id_customer`) REFERENCES `customers` (`id_customer`),
  ADD CONSTRAINT `FK_orders_id_method_payment` FOREIGN KEY (`id_method_payment`) REFERENCES `methods_payments` (`id_method_payment`),
  ADD CONSTRAINT `FK_orders_id_method_shipping` FOREIGN KEY (`id_method_shipping`) REFERENCES `methods_shippings` (`id_method_shipping`);

--
-- Contraintes pour la table `orders_members`
--
ALTER TABLE `orders_members`
  ADD CONSTRAINT `FK_orders_members_id_etat` FOREIGN KEY (`id_etat`) REFERENCES `etats` (`id_etat`),
  ADD CONSTRAINT `FK_orders_members_id_member` FOREIGN KEY (`id_member`) REFERENCES `members` (`id_member`),
  ADD CONSTRAINT `FK_orders_members_id_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`);

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_products_id_group_color` FOREIGN KEY (`id_group_color`) REFERENCES `groups_colors` (`id_group_color`),
  ADD CONSTRAINT `FK_products_id_group_product` FOREIGN KEY (`id_group_product`) REFERENCES `groups_products` (`id_group_product`),
  ADD CONSTRAINT `FK_products_id_group_size` FOREIGN KEY (`id_group_size`) REFERENCES `groups_sizes` (`id_group_size`);

--
-- Contraintes pour la table `product_order`
--
ALTER TABLE `product_order`
  ADD CONSTRAINT `FK_product_order_id_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id_order`),
  ADD CONSTRAINT `FK_product_order_id_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id_product`);

--
-- Contraintes pour la table `sizes`
--
ALTER TABLE `sizes`
  ADD CONSTRAINT `FK_sizes_id_group_size` FOREIGN KEY (`id_group_size`) REFERENCES `groups_sizes` (`id_group_size`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
