-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.0.2-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for orderfoodonline
DROP DATABASE IF EXISTS `orderfoodonline`;
CREATE DATABASE IF NOT EXISTS `orderfoodonline` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `orderfoodonline`;

-- Dumping structure for table orderfoodonline.food
DROP TABLE IF EXISTS `food`;
CREATE TABLE IF NOT EXISTS `food` (
  `IdFood` int(11) NOT NULL AUTO_INCREMENT,
  `IdTypeFood` int(11) NOT NULL,
  `NameFood` varchar(50) NOT NULL DEFAULT '',
  `PriceFood` int(11) NOT NULL DEFAULT 0,
  `ImageFood` varchar(50) NOT NULL,
  `IdShop` int(11) NOT NULL,
  PRIMARY KEY (`IdFood`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.orders
DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `IdOrder` int(11) NOT NULL AUTO_INCREMENT,
  `IdCustomer` int(11) NOT NULL,
  `IdShop` int(11) NOT NULL,
  `IdRider` int(11) DEFAULT NULL,
  `FoodOrder` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`FoodOrder`)),
  `PriceOrder` float DEFAULT NULL,
  `StatusOrder` int(11) DEFAULT NULL,
  `DateOrder` date DEFAULT NULL,
  PRIMARY KEY (`IdOrder`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.promotion
DROP TABLE IF EXISTS `promotion`;
CREATE TABLE IF NOT EXISTS `promotion` (
  `IdPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `PersenPromotion` int(11) NOT NULL,
  `IdShop` int(11) NOT NULL,
  PRIMARY KEY (`IdPromotion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.review
DROP TABLE IF EXISTS `review`;
CREATE TABLE IF NOT EXISTS `review` (
  `IdReview` int(11) NOT NULL AUTO_INCREMENT,
  `IdUser` int(11) NOT NULL DEFAULT 0,
  `IdFood` int(11) NOT NULL,
  `Comment` varchar(50) NOT NULL,
  PRIMARY KEY (`IdReview`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.typefood
DROP TABLE IF EXISTS `typefood`;
CREATE TABLE IF NOT EXISTS `typefood` (
  `IdTypeFood` int(11) NOT NULL AUTO_INCREMENT,
  `IdShop` int(11) NOT NULL,
  `NameTypeFood` varchar(255) NOT NULL,
  PRIMARY KEY (`IdTypeFood`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.typeshop
DROP TABLE IF EXISTS `typeshop`;
CREATE TABLE IF NOT EXISTS `typeshop` (
  `IdTypeShop` int(11) NOT NULL AUTO_INCREMENT,
  `NameTypeShop` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`IdTypeShop`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `idAll` int(11) NOT NULL AUTO_INCREMENT,
  `NameAll` varchar(50) NOT NULL,
  `PasswordAll` varchar(50) NOT NULL,
  `DescriptionShop` varchar(255) DEFAULT NULL,
  `AddressCustomer` varchar(255) DEFAULT NULL,
  `ImageAll` varchar(255) DEFAULT '../../Src/Images/Unknown.png',
  `AccessStatusSCR` int(11) DEFAULT 0,
  `RoleAll` varchar(255) NOT NULL,
  `IdTypeShop` int(11) DEFAULT NULL,
  PRIMARY KEY (`idAll`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
