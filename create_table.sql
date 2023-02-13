-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               10.4.24-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for influencer
CREATE DATABASE IF NOT EXISTS `influencer` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `influencer`;

-- Dumping structure for table influencer.dayly
CREATE TABLE IF NOT EXISTS `dayly` (
  `day` int(11) DEFAULT NULL,
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `network` enum('instagram','facebook','twitter','tiktok','youtube') DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `total_post` int(11) DEFAULT NULL,
  `unique_post` int(11) DEFAULT NULL,
  `duplicate` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.dayly: ~0 rows (approximately)
/*!40000 ALTER TABLE `dayly` DISABLE KEYS */;
/*!40000 ALTER TABLE `dayly` ENABLE KEYS */;

-- Dumping structure for table influencer.monthly
CREATE TABLE IF NOT EXISTS `monthly` (
  `month` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `network` enum('instagram','facebook','twitter','tiktok','youtube') DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `total_post` int(11) DEFAULT NULL,
  `unique_post` int(11) DEFAULT NULL,
  `duplicate` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.monthly: ~0 rows (approximately)
/*!40000 ALTER TABLE `monthly` DISABLE KEYS */;
/*!40000 ALTER TABLE `monthly` ENABLE KEYS */;

-- Dumping structure for table influencer.over_all
CREATE TABLE IF NOT EXISTS `over_all` (
  `network` enum('instagram','facebook','twitter','tiktok') NOT NULL,
  `account` int(11) NOT NULL,
  `follower` int(11) NOT NULL,
  `total_post` int(11) NOT NULL,
  `unique_post` int(11) NOT NULL,
  `duplicate` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.over_all: ~0 rows (approximately)
/*!40000 ALTER TABLE `over_all` DISABLE KEYS */;
/*!40000 ALTER TABLE `over_all` ENABLE KEYS */;

-- Dumping structure for table influencer.post_unique
CREATE TABLE IF NOT EXISTS `post_unique` (
  `influencer_id` int(11) NOT NULL DEFAULT 0,
  `facebook` longtext DEFAULT NULL,
  `instagram` longtext DEFAULT NULL,
  `twitter` longtext DEFAULT NULL,
  `tiktok` longtext DEFAULT NULL,
  `update_date` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`influencer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.post_unique: ~0 rows (approximately)
/*!40000 ALTER TABLE `post_unique` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_unique` ENABLE KEYS */;

-- Dumping structure for table influencer.stat_running_log
CREATE TABLE IF NOT EXISTS `stat_running_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `last_id` mediumint(9) NOT NULL,
  `last_running` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.stat_running_log: ~1 rows (approximately)
/*!40000 ALTER TABLE `stat_running_log` DISABLE KEYS */;
INSERT IGNORE INTO `stat_running_log` (`id`, `last_id`, `last_running`) VALUES
	(1, 0, '0000-00-00 00:00:00');
/*!40000 ALTER TABLE `stat_running_log` ENABLE KEYS */;

-- Dumping structure for table influencer.weekly
CREATE TABLE IF NOT EXISTS `weekly` (
  `week` int(11) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `network` enum('instagram','facebook','twitter','tiktok') DEFAULT NULL,
  `account` int(11) DEFAULT NULL,
  `follower` int(11) DEFAULT NULL,
  `total_post` int(11) DEFAULT NULL,
  `unique_post` int(11) DEFAULT NULL,
  `duplicate` float DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table influencer.weekly: ~0 rows (approximately)
/*!40000 ALTER TABLE `weekly` DISABLE KEYS */;
/*!40000 ALTER TABLE `weekly` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
