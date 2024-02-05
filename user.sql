

GRANT USAGE ON *.* TO 'appuser'@'localhost' IDENTIFIED BY '';
GRANT ALL PRIVILEGES ON onlineShopping.* TO 'appuser'@'localhost';
FLUSH PRIVILEGES;

USE onlineshopping;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;


-- --------------------------------------------------------

--
-- Table structure for table `user`
--
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user` (`id`, `username`, `email`, `password_hash`) VALUES
(1, '123', 'momo@gmail.com', '$2y$10$fck0DlzeHbdtHgQM5U1Nlex/a0lRrbEH0zgmH/uwRI/Lt8e1ke/zO'),
(3, '456', 'baba@gmail.com', '$2y$10$A3O76LHpe4H36AWLrEPKkeFi6yDpkx5a1aM1pdYEDaKTIdRYzV7e.'),
(4, '789', 'gaga@gmail.com', '$2y$10$3N89Y6Y1mG2B77OlIs0Yf.hLSgzt1Nx7g5cHhuIpkQBb1rrZ1/my2'),
(5, '123123123', 'lolol@gmail.com', '$2y$10$0Q8x.2f.KJZxsdfhdY8gPOPfwTHMTZbcs9LZgL5yh7Iziki/cxtHe'),
(6, 'test', 'test@test.test', '$2y$10$gfaCkKaT1z/wsVQGo/EUfOKaECIBEnMW3cjMg7v3uo5tb/5NmC.26');
