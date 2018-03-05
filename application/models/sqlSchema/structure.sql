#------------------------------------------------------------
#        Script MySQL.
#------------------------------------------------------------


#------------------------------------------------------------
# Table: members
#------------------------------------------------------------

CREATE TABLE members(
        id_member       int (11) Auto_increment  NOT NULL ,
        login           Varchar (255) NOT NULL ,
        password        Varchar (255) NOT NULL ,
        actif           Bool NOT NULL ,
        email           Varchar (255) NOT NULL ,
        id_group_member Int NOT NULL ,
        PRIMARY KEY (id_member )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: customers
#------------------------------------------------------------

CREATE TABLE customers(
        id_customer        int (11) Auto_increment  NOT NULL ,
        firstname          Varchar (255) NOT NULL ,
        lastname           Varchar (255) NOT NULL ,
        mobil_phone_number Varchar (20) NOT NULL ,
        phone_number       Varchar (20) NOT NULL ,
        mail               Varchar (25) NOT NULL ,
        address            Varchar (255) NOT NULL ,
        zip_code           Varchar (255) NOT NULL ,
        city               Varchar (255) NOT NULL ,
        actif              Bool NOT NULL ,
        id_group_customer  Int NOT NULL ,
        PRIMARY KEY (id_customer )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groups_members
#------------------------------------------------------------

CREATE TABLE groups_members(
        id_group_member int (11) Auto_increment  NOT NULL ,
        name            Varchar (255) NOT NULL ,
        actif           Bool NOT NULL ,
        PRIMARY KEY (id_group_member )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groups_customers
#------------------------------------------------------------

CREATE TABLE groups_customers(
        id_group_customer int (11) Auto_increment  NOT NULL ,
        name              Varchar (255) NOT NULL ,
        actif             Bool ,
        PRIMARY KEY (id_group_customer )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: products
#------------------------------------------------------------

CREATE TABLE products(
        id_product       int (11) Auto_increment  NOT NULL ,
        product_name     Varchar (255) NOT NULL ,
        reference        Varchar (255) NOT NULL ,
        description      Text ,
        base_price       Float NOT NULL ,
        img_url          Varchar (255) NOT NULL ,
        actif            Bool NOT NULL ,
        id_group_product Int NOT NULL ,
        PRIMARY KEY (id_product )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groups_products
#------------------------------------------------------------

CREATE TABLE groups_products(
        id_group_product   int (11) Auto_increment  NOT NULL ,
        name_group_product Varchar (25) NOT NULL ,
        description        Text NOT NULL ,
        actif              Bool NOT NULL ,
        PRIMARY KEY (id_group_product )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: colors
#------------------------------------------------------------

CREATE TABLE colors(
        id_color       int (11) Auto_increment  NOT NULL ,
        color_name     Varchar (255) NOT NULL ,
        color_code     Varchar (255) ,
        actif          Bool NOT NULL ,
        id_group_color Int NOT NULL ,
        PRIMARY KEY (id_color )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: sizes
#------------------------------------------------------------

CREATE TABLE sizes(
        id_size       int (11) Auto_increment  NOT NULL ,
        size_name     Varchar (255) NOT NULL ,
        price         Float NOT NULL ,
        actif         Bool NOT NULL ,
        id_group_size Int NOT NULL ,
        PRIMARY KEY (id_size )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groups_sizes
#------------------------------------------------------------

CREATE TABLE groups_sizes(
        id_group_size   int (11) Auto_increment  NOT NULL ,
        name_group_size Varchar (25) NOT NULL ,
        actif           Bool NOT NULL ,
        PRIMARY KEY (id_group_size )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: groups_colors
#------------------------------------------------------------

CREATE TABLE groups_colors(
        id_group_color   int (11) Auto_increment  NOT NULL ,
        name_group_color Varchar (255) NOT NULL ,
        actif            Bool NOT NULL ,
        PRIMARY KEY (id_group_color )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: orders
#------------------------------------------------------------

CREATE TABLE orders(
        id_order           int (11) Auto_increment  NOT NULL ,
        date_order         Date NOT NULL ,
        comment_order      Text NOT NULL ,
        price_order        Float NOT NULL ,
        id_customer        Int NOT NULL ,
        id_method_payment  Int NOT NULL ,
        id_method_shipping Int NOT NULL ,
        id_state           Int NOT NULL ,
        PRIMARY KEY (id_order )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: states
#------------------------------------------------------------

CREATE TABLE states(
        id_state   int (11) Auto_increment  NOT NULL ,
        name_state Varchar (25) NOT NULL ,
        PRIMARY KEY (id_state )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: methods_payments
#------------------------------------------------------------

CREATE TABLE methods_payments(
        id_method_payment int (11) Auto_increment  NOT NULL ,
        name_method       Varchar (25) NOT NULL ,
        PRIMARY KEY (id_method_payment )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: methods_shippings
#------------------------------------------------------------

CREATE TABLE methods_shippings(
        id_method_shipping    int (11) Auto_increment  NOT NULL ,
        name_method_shipping  Varchar (25) NOT NULL ,
        price_method_shipping Float NOT NULL ,
        PRIMARY KEY (id_method_shipping )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: messages
#------------------------------------------------------------

CREATE TABLE messages(
        id_message   int (11) Auto_increment  NOT NULL ,
        text_message Text NOT NULL ,
        date_message Date NOT NULL ,
        id_member    Int NOT NULL ,
        PRIMARY KEY (id_message )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: products_orders
#------------------------------------------------------------

CREATE TABLE products_orders(
        quantity_product Varchar (25) NOT NULL ,
        id_product       Int NOT NULL ,
        id_order         Int NOT NULL ,
        id_size          Int NOT NULL ,
        id_color         Int NOT NULL ,
        PRIMARY KEY (id_product ,id_order ,id_size ,id_color )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: orders_members
#------------------------------------------------------------

CREATE TABLE orders_members(
        date_cm   Date ,
        id_member Int NOT NULL ,
        id_order  Int NOT NULL ,
        PRIMARY KEY (id_member ,id_order )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: products_colors
#------------------------------------------------------------

CREATE TABLE products_colors(
        id_color   Int NOT NULL ,
        id_product Int NOT NULL ,
        PRIMARY KEY (id_color ,id_product )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: products_sizes
#------------------------------------------------------------

CREATE TABLE products_sizes(
        id_product Int NOT NULL ,
        id_size    Int NOT NULL ,
        PRIMARY KEY (id_product ,id_size )
)ENGINE=InnoDB;


#------------------------------------------------------------
# Table: members_messages
#------------------------------------------------------------

CREATE TABLE members_messages(
        state_message TinyINT NOT NULL ,
        id_member     Int NOT NULL ,
        id_message    Int NOT NULL ,
        PRIMARY KEY (id_member ,id_message )
)ENGINE=InnoDB;

ALTER TABLE members ADD CONSTRAINT FK_members_id_group_member FOREIGN KEY (id_group_member) REFERENCES groups_members(id_group_member);
ALTER TABLE customers ADD CONSTRAINT FK_customers_id_group_customer FOREIGN KEY (id_group_customer) REFERENCES groups_customers(id_group_customer);
ALTER TABLE products ADD CONSTRAINT FK_products_id_group_product FOREIGN KEY (id_group_product) REFERENCES groups_products(id_group_product);
ALTER TABLE colors ADD CONSTRAINT FK_colors_id_group_color FOREIGN KEY (id_group_color) REFERENCES groups_colors(id_group_color);
ALTER TABLE sizes ADD CONSTRAINT FK_sizes_id_group_size FOREIGN KEY (id_group_size) REFERENCES groups_sizes(id_group_size);
ALTER TABLE orders ADD CONSTRAINT FK_orders_id_customer FOREIGN KEY (id_customer) REFERENCES customers(id_customer);
ALTER TABLE orders ADD CONSTRAINT FK_orders_id_method_payment FOREIGN KEY (id_method_payment) REFERENCES methods_payments(id_method_payment);
ALTER TABLE orders ADD CONSTRAINT FK_orders_id_method_shipping FOREIGN KEY (id_method_shipping) REFERENCES methods_shippings(id_method_shipping);
ALTER TABLE orders ADD CONSTRAINT FK_orders_id_state FOREIGN KEY (id_state) REFERENCES states(id_state);
ALTER TABLE messages ADD CONSTRAINT FK_messages_id_member FOREIGN KEY (id_member) REFERENCES members(id_member);
ALTER TABLE products_orders ADD CONSTRAINT FK_products_orders_id_product FOREIGN KEY (id_product) REFERENCES products(id_product);
ALTER TABLE products_orders ADD CONSTRAINT FK_products_orders_id_order FOREIGN KEY (id_order) REFERENCES orders(id_order);
ALTER TABLE products_orders ADD CONSTRAINT FK_products_orders_id_size FOREIGN KEY (id_size) REFERENCES sizes(id_size);
ALTER TABLE products_orders ADD CONSTRAINT FK_products_orders_id_color FOREIGN KEY (id_color) REFERENCES colors(id_color);
ALTER TABLE orders_members ADD CONSTRAINT FK_orders_members_id_member FOREIGN KEY (id_member) REFERENCES members(id_member);
ALTER TABLE orders_members ADD CONSTRAINT FK_orders_members_id_order FOREIGN KEY (id_order) REFERENCES orders(id_order);
ALTER TABLE products_colors ADD CONSTRAINT FK_products_colors_id_color FOREIGN KEY (id_color) REFERENCES colors(id_color);
ALTER TABLE products_colors ADD CONSTRAINT FK_products_colors_id_product FOREIGN KEY (id_product) REFERENCES products(id_product);
ALTER TABLE products_sizes ADD CONSTRAINT FK_products_sizes_id_product FOREIGN KEY (id_product) REFERENCES products(id_product);
ALTER TABLE products_sizes ADD CONSTRAINT FK_products_sizes_id_size FOREIGN KEY (id_size) REFERENCES sizes(id_size);
ALTER TABLE members_messages ADD CONSTRAINT FK_members_messages_id_member FOREIGN KEY (id_member) REFERENCES members(id_member);
ALTER TABLE members_messages ADD CONSTRAINT FK_members_messages_id_message FOREIGN KEY (id_message) REFERENCES messages(id_message);
