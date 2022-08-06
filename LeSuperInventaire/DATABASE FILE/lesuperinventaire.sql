-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2022 at 04:36 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `brand_id` int(11) NOT NULL,
  `brand_name` varchar(255) NOT NULL,
  `brand_active` int(11) NOT NULL DEFAULT '0',
  `brand_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`brand_id`, `brand_name`, `brand_active`, `brand_status`) VALUES
(1, 'Cool Industries', 1, 1),
(2, 'WOUAH !', 1, 1),
(3, 'I say it in english, so it is cooler', 1, 1),
(4, 'Une marque très très classe', 1, 1),
(5, 'Et pourquoi pas ?', 1, 1),
(6, 'Tu pousses le bouchon Maurice', 1, 1),
(7, 'Imprononçable', 1, 1),
(8, 'Allez viens, on est bien', 1, 1),
(9, 'Que la force soit avec ton code', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `categories_id` int(11) NOT NULL,
  `categories_name` varchar(255) NOT NULL,
  `categories_active` int(11) NOT NULL DEFAULT '0',
  `categories_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`, `categories_active`, `categories_status`) VALUES
(1, 'Puissant artefact', 1, 1),
(2, 'Truc cool', 1, 1),
(3, 'Ce qui peut servir', 1, 1),
(4, 'Indispensable', 1, 1),
(5, 'On est pas sûr de son utilité', 1, 1),
(6, 'On ferait quoi sans lui ?', 1, 1),
(7, 'Surement une erreur', 1, 1);


-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `client_contact` varchar(255) NOT NULL,
  `sub_total` varchar(255) NOT NULL,
  `vat` varchar(255) NOT NULL,
  `total_amount` varchar(255) NOT NULL,
  `discount` varchar(255) NOT NULL,
  `grand_total` varchar(255) NOT NULL,
  `paid` varchar(255) NOT NULL,
  `due` varchar(255) NOT NULL,
  `payment_type` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL,
  `payment_place` int(11) NOT NULL,
  `gstn` varchar(255) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `order_date`, `client_name`, `client_contact`, `sub_total`, `vat`, `total_amount`, `discount`, `grand_total`, `paid`, `due`, `payment_type`, `payment_status`, `payment_place`, `gstn`, `order_status`, `user_id`) VALUES
(1, '2021-06-02', 'Le roi Arthur', '7014444410', '49.00', '8.82', '57.82', '0', '57.82', '57.82', '0.00', 2, 1, 1, '8.82', 1, 1),
(2, '2021-06-02', 'Jean Philippe Smet', '7014445400', '45.00', '8.10', '53.10', '0', '53.10', '53.10', '0.00', 3, 1, 1, '8.10', 1, 1),
(3, '2021-06-02', 'Elon Musk', '7896500020', '45.00', '8.10', '53.10', '0', '53.10', '53.10', '0.00', 2, 2, 2, '8.10', 1, 1),
(4, '2022-01-18', 'Ma tante Gertrude', '8547854444', '264.00', '47.52', '311.52', '0', '311.52', '311.52', '0.00', 2, 1, 1, '47.52', 1, 1),
(5, '2022-01-26', 'Mon futur employeur que je respecte énormément', '8540001014', '106.00', '19.08', '125.08', '0', '125.08', '125.08', '0.00', 1, 1, 1, '19.08', 1, 1),
(6, '2022-01-31', 'Mon oncle Gertrude', '5214440120', '742.00', '133.56', '875.56', '0', '875.56', '875.56', '0.00', 2, 1, 1, '133.56', 1, 1),
(7, '2022-01-31', 'Kevin', '7450126690', '90.00', '16.20', '106.20', '0', '106.20', '106.20', '0.00', 3, 1, 1, '16.20', 1, 2),
(8, '2022-01-30', 'Dany Boon', '8540001250', '348.00', '62.64', '410.64', '0', '410.64', '410.64', '0.00', 2, 1, 1, '62.64', 1, 2),
(9, '2022-02-02', 'Spider Man', '7401114536', '1284.00', '231.12', '1515.12', '0', '1515.12', '1515.12', '0.00', 2, 1, 1, '231.12', 1, 1),
(10, '2022-02-02', 'Un des 7 nains', '7410000069', '274.00', '49.32', '323.32', '10', '313.32', '313.32', '0.00', 3, 1, 1, '49.32', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `order_item`
--

CREATE TABLE `order_item` (
  `order_item_id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL DEFAULT '0',
  `product_id` int(11) NOT NULL DEFAULT '0',
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `order_item_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order_item`
--

INSERT INTO `order_item` (`order_item_id`, `order_id`, `product_id`, `quantity`, `rate`, `total`, `order_item_status`) VALUES
(1, 1, 1, '2', '49', '49.00', 1),
(2, 2, 13, '2', '45', '45.00', 1),
(3, 3, 15, '31', '45', '45.00', 1),
(4, 0, 16, '12', '22', '264.00', 1),
(5, 0, 16, '13', '22', '264.00', 1),
(6, 0, 16, '12', '22', '286.00', 1),
(7, 4, 16, '12', '22', '264.00', 1),
(8, 5, 3, '2', '53', '106.00', 1),
(9, 6, 3, '14', '53', '742.00', 1),
(10, 7, 15, '2', '45', '90.00', 1),
(11, 8, 9, '4', '87', '348.00', 1),
(12, 9, 14, '4', '321', '1284.00', 1),
(13, 10, 6, '1', '70', '70.00', 1),
(14, 10, 7, '1', '29', '29.00', 1),
(15, 10, 10, '1', '35', '35.00', 1),
(16, 10, 4, '1', '140', '140.00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `product_id` int(11) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `product_image` text NOT NULL,
  `brand_id` int(11) NOT NULL,
  `categories_id` int(11) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `rate` varchar(255) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `product_image`, `brand_id`, `categories_id`, `quantity`, `rate`, `active`, `status`) VALUES
(1, 'Les bonnes séries horreurs', '', 1, 1, '0', '69', 1, 1),
(2, 'Excalibur', '../assests/images/stock/Excalibur.jpg', 1, 1, '105', '53', 1, 1),
(3, 'Fleur de feu', '../assests/images/stock/FleurDeFeu.png', 2, 2, '118', '140', 1, 1),
(4, 'Un super codeur qui fait des supers projets', '../assests/images/stock/UnCodeur.png', 9, 6, '97', '210', 1, 1),
(5, 'Une voiture cool', '../assests/images/stock/AstonMartin.jpg', 1, 2, '244', '70', 1, 1),
(6, 'Un martien', '../assests/images/stock/UnMartien.jpg', 5, 6, '368', '29', 1, 1),
(7, 'Des hommes en noir', '../assests/images/stock/HommesEnNoir.jpg', 3, 5, '512', '28', 1, 1),
(8, 'Une cape qui rend invisible', '../assests/images/stock/CapeInvisibilite.jpg', 1, 3, '216', '87', 1, 1),
(9, 'La collection intégrale de Columbo', '../assests/images/stock/CollectionColumbo.jpg', 6, 7, '151', '35', 1, 1),
(10, 'Un sabre laser', '../assests/images/stock/SabreLaser.jpg', 3, 2, '256', '60', 1, 1),
(11, 'Une pioche', '../assests/images/stock/UnePioche.jpg', 5, 3, '126', '45', 1, 1),
(12, 'Un menu maxi best of', '../assests/images/stock/MaxiBestOf.jpg', 8, 7, '257', '45', 1, 1),
(13, 'Eyjafjallajökull', '../assests/images/stock/Eyjafjallajökull.jpg', 7, 7, '254', '321', 1, 1),
(14, 'Un diabolo menthe', '../assests/images/stock/DiaboloMenthe.jpeg', 4, 4, '332', '45', 1, 1),
(15, 'Le super inventaire', '../assests/images/stock/LeSuperInventaire.png', 8, 4, '15', '22', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`) VALUES
(1, 'Valentin', 'a61beab25850918a32d5b4e3bf6fe0ab', ''),
(2, 'Chapel', '5f4dcc3b5aa765d61d8327deb882cf99', 'staff@stockmg.com');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`brand_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`categories_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `order_item`
--
ALTER TABLE `order_item`
  ADD PRIMARY KEY (`order_item_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`product_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `brand_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `categories_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `order_item`
--
ALTER TABLE `order_item`
  MODIFY `order_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `product_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
