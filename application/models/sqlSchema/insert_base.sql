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
INSERT INTO `groups_colors` (`id_group_color`, `name_group_color`) VALUES (NULL, 'Defaut');

#Insertion dans la table groups_colors les groupes obligatoires par defaut
#--------------------------------------------------------------------------
INSERT INTO `groups_sizes` (`id_group_size`, `name_group_size`) VALUES (NULL, 'Defaut');
