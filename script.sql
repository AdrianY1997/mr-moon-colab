DROP DATABASE IF EXISTS mr_moon_script;
CREATE DATABASE IF NOT EXISTS mr_moon_script;

USE mr_moon_script;

CREATE TABLE IF NOT EXISTS users (
    user_id INT AUTO_INCREMENT,
    user_nick VARCHAR(255) UNIQUE,
    user_pass VARCHAR(255),
    user_name VARCHAR(255),
    user_lastname VARCHAR(255),
    user_phone VARCHAR(255),
    user_email VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (user_id)
);

CREATE TABLE IF NOT EXISTS employers (
    empl_id INT AUTO_INCREMENT PRIMARY KEY,
    empl_position VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_UserEmpl FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS roles (
    role_id INT AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(255) UNIQUE,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS user_role (
    user_id INT,
    role_id INT DEFAULT (SELECT role_id FROM roles WHERE role_name = "USER"),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_UserRole FOREIGN KEY (user_id) REFERENCES users(user_id),
    CONSTRAINT FK_RoleUser FOREIGN KEY (role_id) REFERENCES roles(role_id)
);

CREATE TABLE IF NOT EXISTS bills (
    bill_id INT AUTO_INCREMENT PRIMARY KEY,
    bill_serial VARCHAR(255) UNIQUE,
    bill_date VARCHAR(255),
    bill_total VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_UserBill FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS products (
    prod_id INT AUTO_INCREMENT PRIMARY KEY,
    prod_ref VARCHAR(255) UNIQUE,
    prod_name VARCHAR(255),
    prod_stock VARCHAR(255),
    prod_value VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS providers (
    prov_id INT AUTO_INCREMENT PRIMARY KEY,
    prov_nit VARCHAR(255) UNIQUE,
    prov_name VARCHAR(255),
    prov_email VARCHAR(255),
    prov_phone VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS product_provider (
    prod_id INT,
    prov_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_ProdProv FOREIGN KEY (prod_id) REFERENCES products(prod_id),
    CONSTRAINT FK_ProvProd FOREIGN KEY (prov_id) REFERENCES providers(prov_id)
);

CREATE TABLE IF NOT EXISTS orders (
    orde_id INT AUTO_INCREMENT PRIMARY KEY,
    orde_quantity VARCHAR(255),
    bill_id INT,
    prod_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_BillOrder FOREIGN KEY (bill_id) REFERENCES bills(bill_id),
    CONSTRAINT FK_ProdOrder FOREIGN KEY (prod_id) REFERENCES products(prod_id)
);

CREATE TABLE IF NOT EXISTS reservations (
    rese_id INT AUTO_INCREMENT PRIMARY KEY,
    rese_code VARCHAR(255) UNIQUE,
    rese_table VARCHAR(255),
    rese_date VARCHAR(255),
    user_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_UserRese FOREIGN KEY (user_id) REFERENCES users(user_id)
);

CREATE TABLE IF NOT EXISTS menus (
    menu_id INT AUTO_INCREMENT PRIMARY KEY,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS product_menu (
    prod_id INT,
    menu_id INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    
    CONSTRAINT FK_ProdMenu FOREIGN KEY (prod_id) REFERENCES products(prod_id),
    CONSTRAINT FK_MenuProd FOREIGN KEY (menu_id) REFERENCES menus(menu_id)
);

CREATE TABLE IF NOT EXISTS webdatas (
    webd_id INT AUTO_INCREMENT PRIMARY KEY,
    webd_name VARCHAR(255),
    webd_subt VARCHAR(255),
    webd_logo VARCHAR(255),
    webd_email VARCHAR(255),
    webd_phone VARCHAR(255),
    webd_address VARCHAR(255),
    webd_city VARCHAR(255),
    webd_fblink VARCHAR(255),
    webd_twlink VARCHAR(255),
    webd_iglink VARCHAR(255),
    webd_ytlink VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

INSERT IGNORE INTO users (
    user_nick, user_pass, user_name, user_lastname, user_phone, user_email
) VALUES (
    'DarkMorita', '123', 'Adrian', 'Yasno', '+57 3157832393', 'yasnoadriandatos@gmail.com'
);

INSERT IGNORE INTO employers (
    empl_position, user_id
) VALUES (
    'dev', (SELECT user_id FROM users WHERE user_nick = 'DarkMorita'
));

INSERT IGNORE INTO roles (
    role_name
) VALUES (
    'ADMIN'
);

INSERT IGNORE INTO roles (
    role_name
) VALUES (
    'USER'
);

INSERT IGNORE INTO user_role (
    role_id, user_id
) VALUES (
    (SELECT role_id FROM roles WHERE role_name = 'ADMIN'), 
    (SELECT user_id FROM users WHERE user_nick = 'DarkMorita')
);

INSERT IGNORE INTO products (
    prod_ref, prod_name, prod_stock, prod_value
) VALUES (
    '10001', 'Prod Name', '100', '12000,00'
);

INSERT IGNORE INTO providers (
    prov_nit, prov_name, prov_email, prov_phone
) VALUES (
    '1233123', 'Prov Name', 'prov@mail.com', '+57 3112221122'
);

INSERT IGNORE INTO menus () VALUES ();

INSERT IGNORE INTO product_menu (
    prod_id, menu_id
) VALUES (
    1, 1
);

INSERT IGNORE INTO webdatas (
    webd_id, webd_name, webd_subt, webd_logo, webd_email, webd_phone, webd_address, webd_city, webd_fblink, webd_twlink, webd_iglink, webd_ytlink
) VALUES (
    1, 'Mr. Moon', 'Coffee & Bar', 'img/static/mr_moon_logo', 'email@email.com', '+57 312 334 5555', 'Cra 4 No. 4 - 58', 'La Plata, Huila', 'https://facebook.com/', 'https://twitter.com/', 'https://instagram.com/', 'https://www.youtube.com/'
)