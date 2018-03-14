#--------------------------------------------------------------------------
#Insertion dans la table groups_members les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_members` (`id_group_member`, `name`, `actif`) VALUES 
(NULL, 'Administrateurs', '1'),
(NULL, 'Utilisateurs', '1'),
(NULL, 'Invités', '1');

#--------------------------------------------------------------------------
#Insertion dans la table groups_customers les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_customers` (`id_group_customer`, `name` , `actif` ) VALUES 
(NULL, 'Defaut', '1');

INSERT INTO `customers` (`id_customer`, `firstname`, `lastname`, `mobil_phone_number`, `phone_number`, `mail`, `address`, `zip_code`, `city`, `actif`, `id_group_customer`) VALUES 
(NULL, 'Default', 'Default', '0606060606', '0404040404', 'mail@mail.fr', '1 rue de la paie', '75000', 'Paris', '1', '1');

#Insertion dans la table groups_colors les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_colors` (`id_group_color`, `name_group_color`, `actif`) VALUES (NULL, 'defaut', '1');
INSERT INTO `colors` (`id_color`, `color_name`, `color_code` , `actif` , `id_group_color`) VALUES (NULL, 'defaut', '#ffffff' , '1' , '1');

#Insertion dans la table groups_sizes les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_sizes` (`id_group_size`, `name_group_size`, `actif`) VALUES (NULL, 'defaut', '1');
INSERT INTO `sizes` (`id_size`, `size_name`, `price`, `actif`, `id_group_size`) VALUES (NULL, 'defaut', '0.00', '1', '1');
#Insertion dans la table groups_products les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_products` (`id_group_product`, `name_group_product`, `description`, `actif`) VALUES (NULL, 'defaut', 'defaut', '1');
INSERT INTO `products` (`id_product`, `product_name`, `reference`, `description`, `base_price`, `img_url`, `actif`, `id_group_product`) VALUES (NULL, 'defaut', 'defaut', 'defaut', '0.00', 'default.jpg', '1', '1');

#Insertion dans la table groups_colors des méthodes de paiements par defaut
#--------------------------------------------------------------------------
INSERT INTO `methods_payments` (`id_method_payment`, `name_method` , `actif`) VALUES 
(NULL, 'Espèces', 1),
(NULL, 'C.B', 1),
(NULL, 'Chèques', 1),
(NULL, 'Paypal', 1),
(NULL, 'Payplug', 1),
(NULL, 'SAV', 1),
(NULL, 'Virement', 1);

#Insertion dans la table methods_shipping des methodes de livraisons par defaut
#--------------------------------------------------------------------------
INSERT INTO `methods_shippings` (`id_method_shipping`, `name_method_shipping`, `price_method_shipping`) VALUES
(1, 'Lettre suivie', 3.25),
(2, 'Lettre sans suivie', 1.58),
(3, 'Colissimo', 6.58),
(4, 'DPD', 8.25),
(5, 'DPD relais', 4.92);

#Insertion dans la table states des status par defaut
#--------------------------------------------------------------------------

INSERT INTO `states` (`id_state`, `name_state`, `actif`) VALUES
(1, 'Prêt' , 1),
(2, 'Livré' , 1),
(3, 'En cours de production' , 1),
(4, 'En attente de paiement' , 1),
(5, 'Annulé' , 1),
(6, 'Acompte versé', 1),
(7, 'Expédié', 1),
(8, 'Réglé', 1),
(9, 'Fichiers prets', 1),
(10, 'Broderie', 1),
(11, 'Broderie + stickers', 1),
(12, 'Broderie + flocages', 1);



INSERT INTO `meanings` (`id_meaning`, `meaning_name`, `actif`) VALUES 
(NULL, 'normal', '1'), (NULL, 'inversé', '1');