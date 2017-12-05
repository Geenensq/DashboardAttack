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
