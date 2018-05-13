CREATE DATABASE gitgudgames
CHARACTER SET utf8
COLLATE utf8_general_ci;
USE gitgudgames;

CREATE TABLE game_studios (
studio_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
studio_name VARCHAR(40) NOT NULL,
PRIMARY KEY (studio_id)
) ENGINE=InnoDB;

CREATE TABLE games (
game_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
studio_id INT UNSIGNED NOT NULL,
game_name VARCHAR(60) NOT NULL,
game_price DECIMAL(5,2) UNSIGNED NOT NULL,
game_desc VARCHAR(255) DEFAULT NULL,
game_dir VARCHAR(60) NOT NULL,
PRIMARY KEY (game_id),
FOREIGN KEY (studio_id) REFERENCES game_studios (studio_id)
ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE customers (
customer_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
email VARCHAR(60) NOT NULL,
pass CHAR(40) NOT NULL,
PRIMARY KEY (customer_id),
UNIQUE (email)
) ENGINE=InnoDB;

CREATE TABLE customer_games (
customer_id INT UNSIGNED NOT NULL,
game_id INT UNSIGNED NOT NULL,
PRIMARY KEY (customer_id, game_id),
FOREIGN KEY (customer_id) REFERENCES customers (customer_id)
ON DELETE NO ACTION ON UPDATE NO ACTION,
FOREIGN KEY (game_id) REFERENCES games (game_id)
ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE orders (
order_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
customer_id INT UNSIGNED NOT NULL,
order_total DECIMAL(6,2) UNSIGNED NOT NULL,
order_date TIMESTAMP,
PRIMARY KEY (order_id),
FOREIGN KEY (customer_id) REFERENCES customers (customer_id)
ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

CREATE TABLE order_details (
order_detail_id INT UNSIGNED NOT NULL AUTO_INCREMENT,
order_id INT UNSIGNED NOT NULL,
game_id INT UNSIGNED NOT NULL,
PRIMARY KEY (order_detail_id, order_id, game_id),
FOREIGN KEY (order_id) REFERENCES orders (order_id)
ON DELETE NO ACTION ON UPDATE NO ACTION,
FOREIGN KEY (game_id) REFERENCES games (game_id)
ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB;

INSERT INTO game_studios (studio_name)
VALUES ('AAA Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (1, 'AAA Title 1', 39.99, 'Hyperbole to the max! This game has almost no substance!', 'aaa-title1');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (1, 'AAA Title 2', 49.99, 'The sequel to AAA Title 1! This game has less substance than the original!', 'aaa-title2');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (1, 'AAA Title 3', 59.99, 'The prequel to AAA Title 1! Now you have the option to pay-to-win!', 'aaa-title3');

INSERT INTO game_studios (studio_name)
VALUES ('Indie Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (2, 'Indie Title 1', 1.99, 'Our humble beginning as a game studio.', 'indie-title1');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (2, 'Indie Title 2', 2.99, 'Our passion project brought to you by the proceeds from our first title.', 'indie-title2');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (2, 'Indie Title 3', 4.99, 'We just changed gaming once again and everyone loves us!', 'indie-title3');

INSERT INTO game_studios (studio_name)
VALUES ('Passionate Game Studio');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (3, 'Beloved Title', 9.99, 'The game from a decade ago that everyone played and loved.', 'beloved-title');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (3, 'Free Title', 0.00, 'Get hooked on our games for free! Supported by cute outfits and cool weapons you can buy for your avatar!', 'free-title');

INSERT INTO games (studio_id, game_name, game_price, game_desc, game_dir)
VALUES (3, 'Innovative Title', 49.99, 'The game that everyone is playing right now!', 'innovative-title');