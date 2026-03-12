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
'Ubicado en la espectacular Playa Matapalo, el Hotel Riu Guanacaste es un resort Todo Incluido 24h que combina naturaleza, confort y entretenimiento en un entorno privilegiado frente al Pacífico costarricense',
199,
'https://www.riuguanacaste.com/images/gallery/gallery-1.jpg');

INSERT INTO book  (name, description, price, photo) VALUES
('Fiesta Resort', 
'Step into a world of tropical enchantment when you arrive at the all-inclusive Fiesta Resort in Puntarenas, Costa Rica. Embrace the beachfront oasis surrounded by lush tropical gardens, where three expansive swimming pools',
99,
'https://image-tc.galaxy.tf/wijpeg-7yv7fsob1qdeqlqrxdzvylj5/ama-59.jpg?width=567');

INSERT INTO book  (name, description, price, photo) VALUES
('Occidental Papagayo', 
'Con vistas a los espectaculares acantilados de la bahía de CulebraEste complejo todo incluido solo para adultos ofrece una playa privada, 2 piscinas de forma libre y un spa. Cada una de las elegantes habitaciones cuenta con un balcón con vistas parciales a la bahía.',
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
