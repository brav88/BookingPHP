CREATE DATABASE Booking;
USE Booking;

CREATE TABLE `booking`.`book` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(100) NOT NULL,
  `description` VARCHAR(1000) NOT NULL,
  `price` DECIMAL NOT NULL,
  `photo` VARCHAR(500) NOT NULL,
PRIMARY KEY (`id`));

INSERT INTO book (name, description, price, photo) VALUES
('Hotel Riu Guanacaste', 
'Located on the stunning Matapalo Beach, Hotel Riu Guanacaste is a 24-hour all-inclusive resort that blends nature, comfort, and entertainment in a prime setting along Costa Rica’s Pacific coast.',
199,
'https://www.riuguanacaste.com/images/gallery/gallery-1.jpg');

INSERT INTO book  (name, description, price, photo) VALUES
('Fiesta Resort', 
'Step into a world of tropical enchantment when you arrive at the all-inclusive Fiesta Resort in Puntarenas, Costa Rica. Embrace the beachfront oasis surrounded by lush tropical gardens, where three expansive swimming pools',
99,
'https://image-tc.galaxy.tf/wijpeg-7yv7fsob1qdeqlqrxdzvylj5/ama-59.jpg?width=567');

INSERT INTO book  (name, description, price, photo) VALUES
('Occidental Papagayo', 
'Overlooking the spectacular cliffs of Culebra Bay, this adults-only all-inclusive resort features a private beach, two freeform swimming pools, and a spa. Each elegant room includes a balcony with partial bay views.',
299,
'https://cf.bstatic.com/xdata/images/hotel/max1024x768/150859895.jpg?k=a149428bc0b18274562b7c29917de5f53b56c129fa28f4dab97d3b1c1643a265&o=');

SELECT * FROM book;

CREATE TABLE `booking`.`reservation` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `idUser` INT NOT NULL,
  `idBook` INT NOT NULL,
  `checkin` DATE NOT NULL,
  `checkout` DATE NOT NULL,
  `adults` INT NOT NULL,
  `kids` INT NOT NULL,
  `total` FLOAT NOT NULL,
  `status` CHAR NOT NULL,
  `created` DATETIME NOT NULL,
PRIMARY KEY (`id`));

SELECT * FROM reservation;

CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `pwd` varchar(50) NOT NULL,
  `status` CHAR NOT NULL,
  `created` DATETIME NOT NULL
);

INSERT INTO `booking`.`users`
(`name`,
`last_name`,
`email`,
`pwd`,
`status`,
`created`)
VALUES
('admin','admin','admin@booking.com','Admin$1234','1', LOCALTIME());

INSERT INTO `booking`.`users`
(`name`,
`last_name`,
`email`,
`pwd`,
`status`,
`created`)
VALUES
('Braulio','Sandi','bsandi@booking.com','Admin$1234','1', LOCALTIME());



