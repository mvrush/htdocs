-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 18, 2021 at 05:22 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `phpmotors`
--

-- --------------------------------------------------------

--
-- Table structure for table `carclassification`
--

CREATE TABLE `carclassification` (
  `classificationId` int(11) NOT NULL,
  `classificationName` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carclassification`
--

INSERT INTO `carclassification` (`classificationId`, `classificationName`) VALUES
(1, 'SUV'),
(2, 'Classic'),
(3, 'Sports'),
(4, 'Trucks'),
(5, 'Used'),
(8, 'Go-Kart');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `clientId` int(10) UNSIGNED NOT NULL,
  `clientFirstname` varchar(15) NOT NULL,
  `clientLastname` varchar(25) NOT NULL,
  `clientEmail` varchar(40) NOT NULL,
  `clientPassword` varchar(255) NOT NULL,
  `clientLevel` enum('1','2','3') NOT NULL DEFAULT '1',
  `comment` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`clientId`, `clientFirstname`, `clientLastname`, `clientEmail`, `clientPassword`, `clientLevel`, `comment`) VALUES
(6, 'Admin', 'User', 'admin@cse340.net', '$2y$10$cYDrEUbz5JJw3MDmEZnx1OSQ9zu/joIlutWAg58biLTKpdDD5Oqj2', '3', NULL),
(7, 'Mick', 'Ronson', 'mr@aol.com', '$2y$10$FF8jJPLAGIluyW/mLEB1lOet8cVZ6PSMOUILjQG87hMBIxjMMJC16', '1', NULL),
(8, 'William', 'Smithers', 'will@aol.com', '$2y$10$pyBfK1aQxaTmYLXjPzq1m.UvMyMMyh4JANaUFMjMVUHwTMsgvD0Qu', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `imgId` int(10) UNSIGNED NOT NULL,
  `invId` int(10) UNSIGNED NOT NULL,
  `imgName` varchar(100) CHARACTER SET latin1 NOT NULL,
  `imgPath` varchar(150) CHARACTER SET latin1 NOT NULL,
  `imgDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `imgPrimary` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`imgId`, `invId`, `imgName`, `imgPath`, `imgDate`, `imgPrimary`) VALUES
(5, 1, 'wrangler.jpg', '/phpmotors/images/vehicles/wrangler.jpg', '2021-07-06 20:47:14', 1),
(6, 1, 'wrangler-tn.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '2021-07-06 20:47:14', 1),
(7, 2, 'model-t.jpg', '/phpmotors/images/vehicles/model-t.jpg', '2021-07-06 20:48:16', 1),
(8, 2, 'model-t-tn.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '2021-07-06 20:48:16', 1),
(9, 3, 'adventador.jpg', '/phpmotors/images/vehicles/adventador.jpg', '2021-07-06 20:50:25', 1),
(10, 3, 'adventador-tn.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '2021-07-06 20:50:25', 1),
(11, 4, 'monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck.jpg', '2021-07-06 20:50:45', 1),
(12, 4, 'monster-truck-tn.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '2021-07-06 20:50:45', 1),
(13, 5, 'mechanic.jpg', '/phpmotors/images/vehicles/mechanic.jpg', '2021-07-06 20:51:12', 1),
(14, 5, 'mechanic-tn.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '2021-07-06 20:51:12', 1),
(15, 6, 'batmobile.jpg', '/phpmotors/images/vehicles/batmobile.jpg', '2021-07-06 20:51:23', 1),
(16, 6, 'batmobile-tn.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '2021-07-06 20:51:23', 1),
(17, 7, 'mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van.jpg', '2021-07-06 20:51:38', 1),
(18, 7, 'mystery-van-tn.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '2021-07-06 20:51:38', 1),
(19, 8, 'fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck.jpg', '2021-07-06 20:51:49', 1),
(20, 8, 'fire-truck-tn.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '2021-07-06 20:51:49', 1),
(21, 9, 'crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic.jpg', '2021-07-06 20:52:01', 1),
(22, 9, 'crwn-vic-tn.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '2021-07-06 20:52:01', 1),
(23, 10, 'camaro.jpg', '/phpmotors/images/vehicles/camaro.jpg', '2021-07-06 20:52:15', 1),
(24, 10, 'camaro-tn.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '2021-07-06 20:52:15', 1),
(25, 11, 'escalade.jpg', '/phpmotors/images/vehicles/escalade.jpg', '2021-07-06 20:52:27', 1),
(26, 11, 'escalade-tn.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '2021-07-06 20:52:27', 1),
(27, 12, 'hummer.jpg', '/phpmotors/images/vehicles/hummer.jpg', '2021-07-06 20:52:41', 1),
(28, 12, 'hummer-tn.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '2021-07-06 20:52:41', 1),
(29, 13, 'aerocar.jpg', '/phpmotors/images/vehicles/aerocar.jpg', '2021-07-06 20:52:52', 1),
(30, 13, 'aerocar-tn.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '2021-07-06 20:52:52', 1),
(31, 14, 'van.jpg', '/phpmotors/images/vehicles/van.jpg', '2021-07-06 20:53:07', 1),
(32, 14, 'van-tn.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '2021-07-06 20:53:07', 1),
(33, 15, 'no-image.png', '/phpmotors/images/vehicles/no-image.png', '2021-07-06 20:53:31', 1),
(34, 15, 'no-image-tn.png', '/phpmotors/images/vehicles/no-image-tn.png', '2021-07-06 20:53:31', 1),
(35, 17, 'kart.jpg', '/phpmotors/images/vehicles/kart.jpg', '2021-07-06 20:53:49', 1),
(36, 17, 'kart-tn.jpg', '/phpmotors/images/vehicles/kart-tn.jpg', '2021-07-06 20:53:49', 1),
(37, 31, 'delorean.jpg', '/phpmotors/images/vehicles/delorean.jpg', '2021-07-06 21:00:55', 1),
(38, 31, 'delorean-tn.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '2021-07-06 21:00:55', 1),
(39, 17, 'kart-crash.jpg', '/phpmotors/images/vehicles/kart-crash.jpg', '2021-07-06 21:04:37', 0),
(40, 17, 'kart-crash-tn.jpg', '/phpmotors/images/vehicles/kart-crash-tn.jpg', '2021-07-06 21:04:37', 0),
(41, 1, 'wrangler-2.jpg', '/phpmotors/images/vehicles/wrangler-2.jpg', '2021-07-06 21:07:35', 0),
(42, 1, 'wrangler-2-tn.jpg', '/phpmotors/images/vehicles/wrangler-2-tn.jpg', '2021-07-06 21:07:35', 0),
(43, 10, 'camaro-2.jpg', '/phpmotors/images/vehicles/camaro-2.jpg', '2021-07-06 21:09:15', 0),
(44, 10, 'camaro-2-tn.jpg', '/phpmotors/images/vehicles/camaro-2-tn.jpg', '2021-07-06 21:09:15', 0),
(45, 12, 'hummer-2.jpg', '/phpmotors/images/vehicles/hummer-2.jpg', '2021-07-06 21:12:32', 0),
(46, 12, 'hummer-2-tn.jpg', '/phpmotors/images/vehicles/hummer-2-tn.jpg', '2021-07-06 21:12:32', 0);

-- --------------------------------------------------------

--
-- Table structure for table `inventory`
--

CREATE TABLE `inventory` (
  `invId` int(10) UNSIGNED NOT NULL,
  `invMake` varchar(30) NOT NULL,
  `invModel` varchar(30) NOT NULL,
  `invDescription` text NOT NULL,
  `invImage` varchar(50) NOT NULL,
  `invThumbnail` varchar(50) NOT NULL,
  `invPrice` varchar(50) NOT NULL,
  `invStock` smallint(6) NOT NULL,
  `invColor` varchar(20) NOT NULL,
  `classificationId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inventory`
--

INSERT INTO `inventory` (`invId`, `invMake`, `invModel`, `invDescription`, `invImage`, `invThumbnail`, `invPrice`, `invStock`, `invColor`, `classificationId`) VALUES
(1, 'Jeep', 'Wrangler', 'The Jeep Wrangler is small and compact with enough power to get you where you want to go. Its great for everyday driving as well as offroading weather that be on the the rocks or in the mud!', '/phpmotors/images/vehicles/wrangler.jpg', '/phpmotors/images/vehicles/wrangler-tn.jpg', '28045', 4, 'Orange', 1),
(2, 'Ford', 'Model T', 'The Ford Model T can be a bit tricky to drive. It was the first car to be put into production. You can get it in any color you want as long as it&#39;s black.', '/phpmotors/images/vehicles/model-t.jpg', '/phpmotors/images/vehicles/model-t-tn.jpg', '30000', 2, 'Black', 2),
(3, 'Lamborghini', 'Adventador', 'This V-12 engine packs a punch in this sporty car. Make sure you wear your seatbelt and obey all traffic laws.', '/phpmotors/images/vehicles/adventador.jpg', '/phpmotors/images/vehicles/adventador-tn.jpg', '417650', 1, 'Blue', 3),
(4, 'Monster', 'Truck', 'Most trucks are for working, this one is for fun. this beast comes with 60in tires giving you tracktions needed to jump and roll in the mud.', '/phpmotors/images/vehicles/monster-truck.jpg', '/phpmotors/images/vehicles/monster-truck-tn.jpg', '150000', 3, 'purple', 4),
(5, 'Mechanic', 'Special', 'Not sure where this car came from. however with a little tlc it will run as good a new.', '/phpmotors/images/vehicles/mechanic.jpg', '/phpmotors/images/vehicles/mechanic-tn.jpg', '100', 200, 'Rust', 5),
(6, 'Batmobile', 'Custom', 'Ever want to be a super hero? now you can with the batmobile. This car allows you to switch to bike mode allowing you to easily maneuver through trafic during rush hour.', '/phpmotors/images/vehicles/batmobile.jpg', '/phpmotors/images/vehicles/batmobile-tn.jpg', '65000', 2, 'Black', 3),
(7, 'Mystery', 'Machine', 'Scooby and the gang always found luck in solving their mysteries because of there 4 wheel drive Mystery Machine. This Van will help you do whatever job you are required to with a success rate of 100%.', '/phpmotors/images/vehicles/mystery-van.jpg', '/phpmotors/images/vehicles/mystery-van-tn.jpg', '10000', 12, 'Green', 1),
(8, 'Spartan', 'Fire Truck', 'Emergencies happen often. Be prepared with this Spartan fire truck. Comes complete with 1000 ft. of hose and a 1000 gallon tank.', '/phpmotors/images/vehicles/fire-truck.jpg', '/phpmotors/images/vehicles/fire-truck-tn.jpg', '50000', 2, 'Red', 4),
(9, 'Ford', 'Crown Victoria', 'After the police force updated their fleet these cars are now available to the public! These cars come equiped with the siren which is convenient for college students running late to class.', '/phpmotors/images/vehicles/crwn-vic.jpg', '/phpmotors/images/vehicles/crwn-vic-tn.jpg', '10000', 5, 'White', 5),
(10, 'Chevy', 'Camaro', 'If you want to look cool this is the car you need! This car has great performance at an affordable price. Own it today!', '/phpmotors/images/vehicles/camaro.jpg', '/phpmotors/images/vehicles/camaro-tn.jpg', '25000', 10, 'Silver', 3),
(11, 'Cadillac', 'Escalade', 'This stylin car is great for any occasion from going to the beach to meeting the president. The luxurious inside makes this car a home away from home.', '/phpmotors/images/vehicles/escalade.jpg', '/phpmotors/images/vehicles/escalade-tn.jpg', '75195', 4, 'Black', 1),
(12, 'GM', 'Hummer', 'Do you have 6 kids and like to go offroading? The Hummer gives you the large interiors with an engine to get you out of any muddy or rocky situation.', '/phpmotors/images/vehicles/hummer.jpg', '/phpmotors/images/vehicles/hummer-tn.jpg', '58800', 5, 'Yellow', 5),
(13, 'Aerocar International', 'Aerocar', 'Are you sick of rushhour trafic? This car converts into an airplane to get you where you are going fast. Only 6 of these were made, get them while they last!', '/phpmotors/images/vehicles/aerocar.jpg', '/phpmotors/images/vehicles/aerocar-tn.jpg', '1000000', 6, 'Red', 2),
(14, 'FBI', 'Surveillance Van', 'Do you like police shows? You&#39;ll feel right at home driving this van, come complete with surveillance equipment for an extra fee of $2,000 a month.', '/phpmotors/images/vehicles/van.jpg', '/phpmotors/images/vehicles/van-tn.jpg', '20000', 1, 'Green', 1),
(15, 'Dog', 'Car', 'Do you like dogs? Well this car is for you straight from the 90s from Aspen, Colorado we have the orginal Dog Car complete with fluffy ears.', '/phpmotors/images/vehicles/no-image.png', '/phpmotors/images/vehicles/no-image-tn.png', '35000', 1, 'Brown', 2),
(17, 'Funco', 'Speedster 11', 'The fastest Go-Kart made. It could win the Go-Kart Daytona! Two times!', '/phpmotors/images/vehicles/kart.jpg', '/phpmotors/images/vehicles/kart-tn.jpg', '2000', 1, 'Red', 8),
(31, 'DMC', 'DeLorean', 'Not just a car, it&#39;s a time machine!', '/phpmotors/images/vehicles/delorean.jpg', '/phpmotors/images/vehicles/delorean-tn.jpg', '17000', 1, 'Silver', 2);

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `reviewId` int(10) UNSIGNED NOT NULL,
  `reviewText` text CHARACTER SET latin1 NOT NULL,
  `reviewDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `invId` int(10) UNSIGNED NOT NULL,
  `clientId` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`reviewId`, `reviewText`, `reviewDate`, `invId`, `clientId`) VALUES
(2, 'It&#39;s an amazing vehicle! It will climb right up a wall!!', '2021-07-14 01:34:47', 1, 6),
(3, 'This is one great Jeep!', '2021-07-15 20:45:46', 1, 8),
(4, 'I love it!', '2021-07-15 20:48:59', 1, 8),
(5, 'The bomb!', '2021-07-15 20:58:32', 1, 8),
(6, 'Runs like a giant monster crazy super friggin&#39; clock!', '2021-07-15 21:04:55', 1, 8),
(7, 'It&#39;s a monster!', '2021-07-16 01:21:44', 4, 6),
(8, 'It&#39;s bigger than a monster!', '2021-07-16 01:23:21', 4, 6),
(13, 'This car rocks my socks!', '2021-07-16 03:18:44', 1, 6),
(14, 'Complete junk. It doesn&#39;t even run but with a little washing and waxing she&#39;ll look as good as new. It will have a rusty waxy glow!', '2021-07-18 00:48:46', 5, 6),
(15, 'It&#39;s enormously huge!', '2021-07-18 03:21:03', 4, 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carclassification`
--
ALTER TABLE `carclassification`
  ADD PRIMARY KEY (`classificationId`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`clientId`),
  ADD UNIQUE KEY `clientEmail` (`clientEmail`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`imgId`),
  ADD KEY `invId` (`invId`);

--
-- Indexes for table `inventory`
--
ALTER TABLE `inventory`
  ADD PRIMARY KEY (`invId`),
  ADD KEY `classificationId` (`classificationId`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`reviewId`),
  ADD KEY `FK_reviews_clients` (`clientId`),
  ADD KEY `FK_reviews_inventory` (`invId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carclassification`
--
ALTER TABLE `carclassification`
  MODIFY `classificationId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `clientId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `imgId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `inventory`
--
ALTER TABLE `inventory`
  MODIFY `invId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `reviewId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `FK_inv_images` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `inventory`
--
ALTER TABLE `inventory`
  ADD CONSTRAINT `inventory_ibfk_1` FOREIGN KEY (`classificationId`) REFERENCES `carclassification` (`classificationId`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `FK_reviews_clients` FOREIGN KEY (`clientId`) REFERENCES `clients` (`clientId`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_reviews_inventory` FOREIGN KEY (`invId`) REFERENCES `inventory` (`invId`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
