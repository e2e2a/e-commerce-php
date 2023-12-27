DROP TABLE IF EXISTS users;
CREATE TABLE users(
    user_id int PRIMARY KEY AUTO_INCREMENT,
    username varchar(200),
    fullname varchar(200),
    email varchar(200),
    birthdate date,
    password varchar(200),
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;
INSERT INTO users (username,fullname,email,birthdate,password) VALUES('admin', 'Reymond Godoy', 'admin@gmail.com', '3322-12-12', '123');

DROP TABLE IF EXISTS message;
CREATE TABLE message(
    message_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    subject varchar(200),
    message varchar(200),
    created_at datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DROP TABLE IF EXISTS products;
CREATE TABLE products(
    product_id int PRIMARY KEY AUTO_INCREMENT,
    product_name varchar(200),
    category varchar(100),
    price decimal(10,2),
    description varchar(500),
    images varchar(200),
    width varchar(20),
    height varchar(20),
    depth varchar(20),
    weight varchar(20),
    quantity int,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DROP TABLE IF EXISTS upcoming_products;
CREATE TABLE upcoming_products(
    upcoming_id int PRIMARY KEY AUTO_INCREMENT,
    product_name varchar(200),
    category varchar(100),
    price decimal(10,2),
    description varchar(500),
    images_upcoming varchar(200),
    width varchar(20),
    height varchar(20),
    depth varchar(20),
    weight varchar(20),
    quantity int,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf32;

DROP TABLE IF EXISTS cart;
CREATE TABLE cart (
    cart_id int PRIMARY KEY AUTO_INCREMENT,
    user_id int,
    product_id int,
    quantity int,
    created_at datetime DEFAULT CURRENT_TIMESTAMP,
    updated_at datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(product_id) ON DELETE CASCADE ON UPDATE CASCADE
);