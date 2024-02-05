-- Create database
CREATE DATABASE onlineShopping;

-- Grant privileges
GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON onlineShopping.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

-- Use the database
USE onlineShopping;

-- Create table
CREATE TABLE IF NOT EXISTS `items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` int(10) NOT NULL,
  `image` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- Trigger to prepend 'img/' to the image column
DELIMITER //

CREATE TRIGGER before_insert_items
BEFORE INSERT ON `items`
FOR EACH ROW
BEGIN
  SET NEW.image = CONCAT('img/', NEW.image);
END;

//

DELIMITER ;

-- Insert data
INSERT INTO `items` (`name`, `description`, `price`, `image`) VALUES
  ('nike', 'basball hat', 67.99, 'nike1.jpg'),
  ('adidas', 'running hat', 89.99, 'adidas1.jpg'),
  ('nike', 'basball hat', 67.99, 'nike1.jpg'),
  ('adidas', 'running hat', 89.99, 'adidas1.jpg'),
  ('puma', 'soccer hat', 24.99, 'puma1.jpg'),
  ('under armour', 'sports hat', 129.99, 'underarmour1.jpg'),
  ('nike', 'basketball hat', 59.99, 'nike2.jpg'),
  ('adidas', 'tennis hat', 49.99, 'adidas2.jpg'),
  ('puma', 'gym hat', 34.99, 'puma2.jpg'),
  ('under armour', 'hiking hat', 79.99, 'underarmour2.jpg'),
  ('nike', 'golf hat', 199.99, 'nike3.jpg'),
  ('adidas', 'swimming hat', 19.99, 'adidas3.jpg'),
  ('puma', 'fitness hat', 74.99, 'puma3.jpg'),
  ('under armour', 'yoga hat', 29.99, 'underarmour3.jpg'),
  ('nike', 'baseball hat', 44.99, 'nike4.jpg'),
  ('adidas', 'bicycle hat', 39.99, 'adidas4.jpg'),
  ('puma', 'weightlifting hat', 14.99, 'puma4.jpg'),
  ('under armour', 'treadmill hat', 799.99, 'underarmour4.jpg'),
  ('nike', 'running shorts hat', 29.99, 'nike5.jpg'),
  ('adidas', 'golf balls hat', 24.99, 'adidas5.jpg');
