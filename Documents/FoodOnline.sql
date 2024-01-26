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
  `IdTypeFood` int(11) NOT NULL,
  `NameFood` varchar(50) NOT NULL DEFAULT '',
  `PriceFood` int(11) NOT NULL DEFAULT 0,
  `ImageFood` varchar(50) NOT NULL,
  `IdShop` int(11) NOT NULL,
  PRIMARY KEY (`IdFood`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.food: ~6 rows (approximately)
REPLACE INTO `food` (`IdFood`, `IdTypeFood`, `NameFood`, `PriceFood`, `ImageFood`, `IdShop`) VALUES
	(10, 9, 'ส้มตำ3114', 80, '../../Data/Images/ส้มตำ.jpg', 36),
	(11, 9, 'ไก่ย่าง', 10, '../../Data/Images/maxresdefault.jpg', 36),
	(12, 10, 'ผัดไทยใส่ปูม้า หางกระรอก', 50, '../../Data/Images/ผัดไทย.jpg', 36),
	(13, 12, 'ต้มยำกุ้ง', 40, '../../Data/Images/ต้มยำกุ้ง.webp', 37),
	(14, 12, 'หมูกรอบบบบบบ', 90, '../../Data/Images/หมูกรอบบบบบบ.jpg', 37),
	(15, 13, 'แซลม่อนลุยน้ำท่วมมา', 800, '../../Data/Images/แซลม่อนลุยน้ำมัน.jpg', 38);

-- Dumping structure for table orderfoodonline.orders
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.orders: ~2 rows (approximately)
REPLACE INTO `orders` (`IdOrder`, `IdCustomer`, `IdShop`, `IdRider`, `FoodOrder`, `PriceOrder`, `StatusOrder`, `DateOrder`) VALUES
	(10, 40, 36, 39, '[{"IdFood":"11","NameFood":"ไก่ย่าง","amount":"8","PriceFood":80},{"IdFood":"12","NameFood":"ผัดไทยใส่ปูม้า หางกระรอก","amount":"10","PriceFood":500}]', 580, 3, '2023-09-28'),
	(11, 40, 36, 39, '[{"IdFood":"10","NameFood":"ส้มตำ3114","amount":1,"PriceFood":80},{"IdFood":"11","NameFood":"ไก่ย่าง","amount":"50","PriceFood":500}]', 580, 2, '2023-10-07');

-- Dumping structure for table orderfoodonline.promotion
CREATE TABLE IF NOT EXISTS `promotion` (
  `IdPromotion` int(11) NOT NULL AUTO_INCREMENT,
  `PersenPromotion` int(11) NOT NULL,
  `IdShop` int(11) NOT NULL,
  PRIMARY KEY (`IdPromotion`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.promotion: ~0 rows (approximately)

-- Dumping structure for table orderfoodonline.review
CREATE TABLE IF NOT EXISTS `review` (
  `IdReview` int(11) NOT NULL AUTO_INCREMENT,
  `IdUser` int(11) NOT NULL DEFAULT 0,
  `IdFood` int(11) NOT NULL,
  `Comment` varchar(50) NOT NULL,
  PRIMARY KEY (`IdReview`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.review: ~1 rows (approximately)
REPLACE INTO `review` (`IdReview`, `IdUser`, `IdFood`, `Comment`) VALUES
	(5, 40, 14, 'dasda');

-- Dumping structure for table orderfoodonline.typefood
CREATE TABLE IF NOT EXISTS `typefood` (
  `IdTypeFood` int(11) NOT NULL AUTO_INCREMENT,
  `IdShop` int(11) NOT NULL,
  `NameTypeFood` varchar(255) NOT NULL,
  PRIMARY KEY (`IdTypeFood`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.typefood: ~5 rows (approximately)
REPLACE INTO `typefood` (`IdTypeFood`, `IdShop`, `NameTypeFood`) VALUES
	(9, 36, 'อาหารขายดี'),
	(10, 36, 'อาหารสุดคุ้ม'),
	(11, 36, 'อาหารมาแรง'),
	(12, 37, 'ขายดี'),
	(13, 38, 'อาหารหายาก');

-- Dumping structure for table orderfoodonline.typeshop
CREATE TABLE IF NOT EXISTS `typeshop` (
  `IdTypeShop` int(11) NOT NULL AUTO_INCREMENT,
  `NameTypeShop` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`IdTypeShop`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.typeshop: ~5 rows (approximately)
REPLACE INTO `typeshop` (`IdTypeShop`, `NameTypeShop`) VALUES
	(19, 'ร้านอาหารข้างทาง'),
	(20, 'ร้านอาหารญี่ปุ่น'),
	(21, 'ร้านอาหารอีสาน'),
	(22, 'ร้านอาหารไทย'),
	(23, 'ร้านอาหารฝรั่งเศส');

-- Dumping structure for table orderfoodonline.users
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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table orderfoodonline.users: ~6 rows (approximately)
REPLACE INTO `users` (`idAll`, `NameAll`, `PasswordAll`, `DescriptionShop`, `AddressCustomer`, `ImageAll`, `AccessStatusSCR`, `RoleAll`, `IdTypeShop`) VALUES
	(35, 'OngarjDev', 'Admin', NULL, NULL, '../../Src/Images/Unknown.png', 0, 'Admin', NULL),
	(36, 'OngarjShop', 'Admin', 'ร้านอาหารนี้สดสะอาด อร่อย กินได้', '18/5 หมู่8 ตำบล บางเสาธง อำเภอ เข้าแล้วออกยาก ประเทศไทย 88888', '../../Src/Images/Unknown.png', 1, 'Shop', 21),
	(37, 'OngarjShop2', 'ฤกทรื', 'ร้านเด็ด ไม่เผ็ดขอเพิ่มได้', '90/58 หมู่7 ตำบลบางปลา อำเภอเมือง จังหวัด นครราชสีมา 6666', '../../Src/Images/Unknown.png', 1, 'Shop', 22),
	(38, 'OngarjShop3', 'ฤกทรื', 'อาหารรสชาติดี ปลาสดๆจากมหาสมุทร', '89/56 หมู่4 ตำบลบางบ่อ อำเภอพิเศษ จังหวัด ราชบุรี 7894', '../../Src/Images/Unknown.png', 1, 'Shop', 23),
	(39, 'OngarjRider', 'ฤกทรื', '', '', '../../Src/Images/Unknown.png', 1, 'Rider', NULL),
	(40, 'OngarjCustomer23141', 'ฤกทรื', '', '', '', 0, 'Customer', NULL);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
