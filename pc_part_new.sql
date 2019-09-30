-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2019 at 06:37 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pc_part_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `compatible`
--

CREATE TABLE `compatible` (
  `id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `type` varchar(5000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `compatible`
--

INSERT INTO `compatible` (`id`, `category_id`, `type`, `status`) VALUES
(1, 4, 'Core i3', 1),
(2, 4, 'Core i5', 1),
(3, 4, 'Core i7', 1),
(4, 6, 'DDR3', 1),
(5, 6, 'DDR4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE `item` (
  `id` int(255) NOT NULL,
  `vendor_id` int(255) NOT NULL,
  `item_id` int(11) NOT NULL,
  `location_id` int(255) NOT NULL,
  `province_id` int(255) NOT NULL,
  `district_id` int(255) NOT NULL,
  `city_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `label_1` int(255) NOT NULL,
  `label_2` int(255) NOT NULL,
  `label_3` int(255) NOT NULL,
  `label_4` int(255) NOT NULL,
  `label_5` int(255) NOT NULL,
  `amount` float NOT NULL,
  `compatible_1` int(255) NOT NULL,
  `compatible_2` int(255) NOT NULL,
  `available_status` tinyint(1) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `vendor_id`, `item_id`, `location_id`, `province_id`, `district_id`, `city_id`, `category_id`, `label_1`, `label_2`, `label_3`, `label_4`, `label_5`, `amount`, `compatible_1`, `compatible_2`, `available_status`, `status`) VALUES
(1, 4, 1, 12, 1, 10, 12, 4, 1, 2, 0, 0, 0, 55000, 3, 5, 1, 1),
(2, 4, 2, 12, 1, 10, 12, 4, 5, 6, 0, 0, 0, 50000, 3, 5, 1, 1),
(3, 5, 2, 13, 1, 10, 13, 4, 5, 7, 0, 0, 0, 60000, 2, 5, 1, 1),
(4, 5, 2, 13, 1, 10, 13, 4, 4, 6, 0, 0, 0, 45000, 2, 5, 1, 1),
(5, 4, 2, 12, 1, 10, 12, 4, 3, 6, 0, 0, 0, 40000, 2, 5, 1, 1),
(6, 4, 3, 12, 1, 10, 12, 6, 8, 0, 0, 0, 0, 6000, 5, 0, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `job`
--

CREATE TABLE `job` (
  `id` int(255) NOT NULL,
  `tech_id` int(255) NOT NULL,
  `client_id` int(255) NOT NULL,
  `add_time` datetime NOT NULL,
  `approve_status` tinyint(1) NOT NULL,
  `approve_time` datetime NOT NULL,
  `complete_status` tinyint(1) NOT NULL,
  `complete_time` datetime NOT NULL,
  `delivery` tinyint(1) NOT NULL,
  `delivery_amount` float NOT NULL,
  `job_amount` float NOT NULL,
  `travelling_amount` float NOT NULL,
  `other_amount` float NOT NULL,
  `payment_method_id` int(255) NOT NULL,
  `payment` tinyint(1) NOT NULL,
  `payment_time` datetime NOT NULL,
  `delivered` tinyint(1) NOT NULL,
  `delivered_time` datetime NOT NULL,
  `recieved` tinyint(1) NOT NULL,
  `recieved_time` datetime NOT NULL,
  `feedback` longtext NOT NULL,
  `review` tinyint(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job`
--

INSERT INTO `job` (`id`, `tech_id`, `client_id`, `add_time`, `approve_status`, `approve_time`, `complete_status`, `complete_time`, `delivery`, `delivery_amount`, `job_amount`, `travelling_amount`, `other_amount`, `payment_method_id`, `payment`, `payment_time`, `delivered`, `delivered_time`, `recieved`, `recieved_time`, `feedback`, `review`) VALUES
(1, 3, 2, '2019-06-19 18:09:50', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(2, 3, 2, '2019-06-19 18:10:40', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(3, 1, 2, '2019-06-19 18:11:24', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(4, 1, 2, '2019-06-19 18:13:55', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(5, 1, 2, '2019-06-19 18:14:34', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(6, 1, 2, '2019-06-19 18:14:59', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(7, 1, 2, '2019-06-19 18:15:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 3, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(8, 1, 2, '2019-06-19 18:31:35', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(9, 1, 2, '2019-06-19 18:31:59', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(10, 1, 2, '2019-06-19 18:33:10', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(11, 3, 2, '2019-06-19 18:33:37', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(12, 3, 2, '2019-06-19 18:34:32', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(13, 3, 2, '2019-06-19 18:35:17', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 1, 0, 0, 0, 0, 1, 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', 0, '0000-00-00 00:00:00', '', 0),
(14, 3, 2, '2019-06-19 18:35:44', 1, '2019-06-28 23:14:41', 1, '2019-06-28 23:15:09', 1, 2500, 0, 1750, 750, 1, 1, '2019-06-28 23:15:40', 1, '2019-06-28 23:15:27', 1, '2019-06-28 19:46:44', '', 0),
(15, 3, 2, '2019-06-19 18:36:03', 1, '2019-06-23 21:59:48', 1, '2019-06-23 21:57:36', 1, 1000, 56000, 1500, 2000, 1, 1, '2019-06-23 22:00:36', 1, '2019-06-23 22:02:27', 1, '2019-06-23 18:41:44', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` int(255) NOT NULL,
  `parent_id` int(255) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `level` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `parent_id`, `name`, `level`, `status`) VALUES
(1, 0, 'Western', 1, 1),
(2, 0, 'Central', 1, 1),
(3, 0, 'Southern', 1, 1),
(4, 0, 'Eastern', 1, 1),
(5, 0, 'North Western', 1, 1),
(6, 0, 'Sabaragamuwa', 1, 1),
(7, 0, 'Uva', 1, 1),
(8, 0, 'North Central', 1, 1),
(9, 0, 'Northern', 1, 1),
(10, 1, 'Colombo', 2, 1),
(11, 2, 'Kandy', 2, 1),
(12, 10, 'Colombo 04', 3, 1),
(13, 10, 'Colombo 03', 3, 1),
(14, 10, 'Nugegoda', 3, 1),
(15, 11, 'Kandy', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_method`
--

CREATE TABLE `payment_method` (
  `id` int(255) NOT NULL,
  `type` varchar(5000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_method`
--

INSERT INTO `payment_method` (`id`, `type`, `status`) VALUES
(1, 'DIRECT BANK TRANSFER ', 1),
(2, 'CASH ON DELIVERY', 1),
(3, 'CREDIT CARD PAYMENT ', 1),
(4, 'CHEQUE PAYMENT ', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_brand`
--

CREATE TABLE `product_brand` (
  `id` int(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_brand`
--

INSERT INTO `product_brand` (`id`, `title`, `status`) VALUES
(1, 'Samsung', 1),
(2, 'Sandick', 1),
(3, 'AMG', 1),
(4, 'Asus', 1),
(5, 'Intel', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_category`
--

CREATE TABLE `product_category` (
  `id` int(255) NOT NULL,
  `parent_id` int(255) NOT NULL,
  `type` varchar(5000) NOT NULL,
  `level` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_category`
--

INSERT INTO `product_category` (`id`, `parent_id`, `type`, `level`, `status`) VALUES
(1, 0, 'PC Parts', 1, 1),
(2, 0, 'PC Accesories', 1, 1),
(3, 0, 'Software', 1, 1),
(4, 1, 'Motherboard', 2, 1),
(5, 1, 'Power Supply', 2, 1),
(6, 1, 'RAM', 2, 1),
(7, 1, 'Hard Disk', 2, 1),
(8, 1, 'Graphic Card', 2, 1),
(9, 2, 'Keyboard', 2, 1),
(10, 2, 'Mouse', 2, 1),
(11, 2, 'Monitor', 2, 1),
(12, 1, 'DVD ROM', 2, 1),
(13, 1, 'Processor', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_items`
--

CREATE TABLE `product_items` (
  `id` int(255) NOT NULL,
  `brand_id` int(255) NOT NULL,
  `category_id` int(255) NOT NULL,
  `sub_category_id` int(255) NOT NULL,
  `title` varchar(5000) NOT NULL,
  `description` longtext NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_items`
--

INSERT INTO `product_items` (`id`, `brand_id`, `category_id`, `sub_category_id`, `title`, `description`, `status`) VALUES
(1, 5, 1, 4, 'Test', '\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"\r\n\r\n\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"', 1),
(2, 5, 1, 4, 'New Title', '\"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"  \"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"  \"At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga. Et harum quidem rerum facilis est et expedita distinctio. Nam libero tempore, cum soluta nobis est eligendi optio cumque nihil impedit quo minus id quod maxime placeat facere possimus, omnis voluptas assumenda est, omnis dolor repellendus. Temporibus autem quibusdam et aut officiis debitis aut rerum necessitatibus saepe eveniet ut et voluptates repudiandae sint et molestiae non recusandae. Itaque earum rerum hic tenetur a sapiente delectus, ut aut reiciendis voluptatibus maiores alias consequatur aut perferendis doloribus asperiores repellat.\"', 1),
(3, 1, 1, 6, 'DDR 4', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_item_label`
--

CREATE TABLE `product_item_label` (
  `id` int(255) NOT NULL,
  `type` varchar(5000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_item_label`
--

INSERT INTO `product_item_label` (`id`, `type`, `status`) VALUES
(1, 'Storage', 1),
(2, 'Capacity', 1),
(3, 'Memory', 1),
(4, 'Processor', 1),
(5, 'Cache Memory', 1),
(6, 'RPM', 1);

-- --------------------------------------------------------

--
-- Table structure for table `product_item_label_type`
--

CREATE TABLE `product_item_label_type` (
  `id` int(255) NOT NULL,
  `product_item_id` int(255) NOT NULL,
  `product_label_id` int(255) NOT NULL,
  `type` varchar(5000) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_item_label_type`
--

INSERT INTO `product_item_label_type` (`id`, `product_item_id`, `product_label_id`, `type`, `status`) VALUES
(1, 1, 4, 'Core i7', 1),
(2, 1, 5, '8M', 1),
(3, 2, 4, 'Core i3', 1),
(4, 2, 4, 'Core i5', 1),
(5, 2, 4, 'Core i7', 1),
(6, 2, 5, '6M', 1),
(7, 2, 5, '8M', 1),
(8, 3, 3, '8GB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sale_assemble`
--

CREATE TABLE `sale_assemble` (
  `id` int(255) NOT NULL,
  `job_id` int(255) NOT NULL,
  `user_id` int(255) NOT NULL,
  `item_id` int(255) NOT NULL,
  `item_purchase_amount` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sale_assemble`
--

INSERT INTO `sale_assemble` (`id`, `job_id`, `user_id`, `item_id`, `item_purchase_amount`, `status`) VALUES
(12, 15, 2, 6, 6000, 1),
(16, 15, 2, 2, 50000, 1),
(17, 0, 2, 5, 0, 0),
(19, 0, 2, 6, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(255) NOT NULL,
  `username` varchar(5000) NOT NULL,
  `password` longtext NOT NULL,
  `name` varchar(5000) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `address` longtext NOT NULL,
  `location_id` int(255) NOT NULL,
  `province_id` int(255) NOT NULL,
  `district_id` int(255) NOT NULL,
  `city_id` int(255) NOT NULL,
  `level_id` int(255) NOT NULL,
  `travel_cost_av` tinyint(1) NOT NULL,
  `hour_rate` float NOT NULL,
  `assemble_rate` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `name`, `contact`, `address`, `location_id`, `province_id`, `district_id`, `city_id`, `level_id`, `travel_cost_av`, `hour_rate`, `assemble_rate`, `status`) VALUES
(1, 'Admin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Admin', '', '', 0, 1, 0, 0, 1, 0, 0, 0, 1),
(2, 'user@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Test User', '0712345678', 'Test Address Line 01,\r\nTest Address Line 02,\r\nTest Address Line 03,\r\nTest Address Line 04,\r\nTest Address Line 05', 0, 1, 0, 0, 4, 0, 0, 0, 1),
(3, 'tech@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Test Technician', '0712345678', '', 12, 1, 10, 12, 3, 1, 1000, 2500, 1),
(4, 'barclays@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Barclays Computers (PVT) Ltd', '0112123456', '', 12, 1, 10, 12, 2, 0, 0, 0, 1),
(5, 'pchouse@test.com', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'PC House', '0112123456', '', 13, 1, 10, 13, 2, 0, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `vendor`
--

CREATE TABLE `vendor` (
  `id` int(255) NOT NULL,
  `name` varchar(5000) NOT NULL,
  `contact` varchar(5000) NOT NULL,
  `email` varchar(5000) NOT NULL,
  `location_id` int(255) NOT NULL,
  `location_province_id` int(255) NOT NULL,
  `location_district_id` int(255) NOT NULL,
  `location_city_id` int(255) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vendor`
--

INSERT INTO `vendor` (`id`, `name`, `contact`, `email`, `location_id`, `location_province_id`, `location_district_id`, `location_city_id`, `status`) VALUES
(1, 'Barclays Computers (PVT) Ltd', '0112123456', 'test@test.com', 12, 1, 10, 12, 1),
(2, 'PC House', '0710222111', 'test@test.com', 13, 1, 10, 13, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compatible`
--
ALTER TABLE `compatible`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `item`
--
ALTER TABLE `item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job`
--
ALTER TABLE `job`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `payment_method`
--
ALTER TABLE `payment_method`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_brand`
--
ALTER TABLE `product_brand`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_category`
--
ALTER TABLE `product_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_items`
--
ALTER TABLE `product_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_item_label`
--
ALTER TABLE `product_item_label`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_item_label_type`
--
ALTER TABLE `product_item_label_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sale_assemble`
--
ALTER TABLE `sale_assemble`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor`
--
ALTER TABLE `vendor`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compatible`
--
ALTER TABLE `compatible`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `item`
--
ALTER TABLE `item`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job`
--
ALTER TABLE `job`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `payment_method`
--
ALTER TABLE `payment_method`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `product_brand`
--
ALTER TABLE `product_brand`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `product_category`
--
ALTER TABLE `product_category`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `product_items`
--
ALTER TABLE `product_items`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `product_item_label`
--
ALTER TABLE `product_item_label`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `product_item_label_type`
--
ALTER TABLE `product_item_label_type`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sale_assemble`
--
ALTER TABLE `sale_assemble`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vendor`
--
ALTER TABLE `vendor`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
