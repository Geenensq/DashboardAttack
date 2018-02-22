#--------------------------------------------------------------------------
#Insertion dans la table groups_members les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_members` (`id_group_member`, `name`, `actif`) VALUES (NULL, 'Administrateurs', '1');
INSERT INTO `groups_members` (`id_group_member`, `name`, `actif`) VALUES (NULL, 'Utilisateurs', '1');
INSERT INTO `groups_members` (`id_group_member`, `name`, `actif`) VALUES (NULL, 'Invités', '1');

#--------------------------------------------------------------------------
#Insertion dans la table groups_customers les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_customers` (`id_group_customer`, `name` , `actif` ) VALUES (NULL, 'Defaut', '1');
INSERT INTO `customers` (`id_customer`, `firstname`, `lastname`, `mobil_phone_number`, `phone_number`, `mail`, `address`, `zip_code`, `city`, `actif`, `id_group_customer`) VALUES (NULL, 'Default', 'Default', '0606060606', '0404040404', 'mail@mail.fr', '1 rue de la paie', '75000', 'Paris', '1', '1');
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
INSERT INTO `products` (`id_product`, `product_name`, `reference`, `description`, `base_price`, `img_url`, `actif`, `id_group_product`, `id_color`, `id_size`) VALUES (NULL, 'defaut', 'defaut', 'defaut', 'default.jpg', '0.00', '1', '1', '1', '1');
#Insertion dans la table groups_colors des méthodes de paiements par defaut
#--------------------------------------------------------------------------
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'Espèces');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'C.B');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'Chèques');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'Paypal');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'Payplug');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'SAV');
INSERT INTO `methods_payments` (`id_method_payment`, `name_method`) VALUES (NULL, 'Virement');

#Insertion dans la table methods_shipping des methodes de livraisons par defaut
#--------------------------------------------------------------------------
INSERT INTO `methods_shippings` (`id_method_shipping`, `name_method_shipping`) VALUES (NULL, 'Lettre suivie');
INSERT INTO `methods_shippings` (`id_method_shipping`, `name_method_shipping`) VALUES (NULL, 'Lettre sans suivie');
INSERT INTO `methods_shippings` (`id_method_shipping`, `name_method_shipping`) VALUES (NULL, 'Colissimo');
INSERT INTO `methods_shippings` (`id_method_shipping`, `name_method_shipping`) VALUES (NULL, 'DPD');

#Insertion dans la table states des status par defaut
#--------------------------------------------------------------------------

INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'Prêt');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'Livré');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'En cours de production');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'En attente de paiement');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'Annulé');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'Acompte versé');
INSERT INTO `states` (`id_state`, `name_state`) VALUES (NULL, 'Expédié');




