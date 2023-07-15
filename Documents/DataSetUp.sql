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
CREATE DATABASE IF NOT EXISTS `orderfoodonline` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `orderfoodonline`;

-- Dumping structure for table orderfoodonline.food
CREATE TABLE IF NOT EXISTS `food` (
  `IdFood` int(11) NOT NULL AUTO_INCREMENT,
  `NameFood` int(11) NOT NULL,
  `PriceFood` float NOT NULL,
  `ImageFood` varchar(50) DEFAULT NULL,
  `NameTypeFood` int(11) DEFAULT NULL,
  PRIMARY KEY (`IdFood`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.order
CREATE TABLE IF NOT EXISTS `order` (
  `IdOrder` int(11) NOT NULL AUTO_INCREMENT,
  `IdCustomer` int(11) NOT NULL DEFAULT 0,
  `IdShop` int(11) NOT NULL DEFAULT 0,
  `IdRider` int(11) NOT NULL DEFAULT 0,
  `IdPromotion` int(11) NOT NULL DEFAULT 0,
  `FoodOrder` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`FoodOrder`)),
  `PriceOrder` float DEFAULT 0,
  `StatusOrder` int(11) DEFAULT 0,
  `DateOrder` date DEFAULT NULL,
  PRIMARY KEY (`IdOrder`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `IdPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `NamePromotion` varchar(50) NOT NULL,
  `PersenPromotion` int(11) NOT NULL,
  PRIMARY KEY (`IdPromotion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

-- Dumping structure for table orderfoodonline.users
CREATE TABLE IF NOT EXISTS `users` (
  `idAll` int(11) NOT NULL AUTO_INCREMENT,
  `NameAll` varchar(50) NOT NULL,
  `PasswordAll` varchar(50) NOT NULL,
  `DescriptionShop` varchar(255) DEFAULT NULL,
  `AddressCustomer` varchar(255) DEFAULT NULL,
  `ImageAll` varchar(255) NOT NULL,
  `WaitPermisionSCR` int(11) DEFAULT 0,
  `SuspensionSCR` int(11) DEFAULT 0,
  `RoleAll` varchar(255) NOT NULL,
  `TypeShopS` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`idAll`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Data exporting was unselected.

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
