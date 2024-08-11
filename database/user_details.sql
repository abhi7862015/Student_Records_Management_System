-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 26, 2022 at 06:58 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `user_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

DROP TABLE IF EXISTS `user_details`;
CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(225) NOT NULL,
  `middle_name` varchar(225) NOT NULL,
  `last_name` varchar(225) NOT NULL,
  `email` varchar(225) NOT NULL,
  `user_name` varchar(225) NOT NULL,
  `password` varchar(225) DEFAULT NULL,
  `user_type` varchar(30) NOT NULL,
  `user_status` varchar(30) NOT NULL,
  `date_added` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `user_name` (`user_name`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_name`, `middle_name`, `last_name`, `email`, `user_name`, `password`, `user_type`, `user_status`, `date_added`) VALUES
(1, 'Aakash', 'K', 'Mishra', 'aakashk2@gmail.com', 'aakash_mishra123', 'e10adc3949ba59abbe56e057f20f883e', 'Admin', 'Active', '2022-08-24 10:23:19.000000'),
(2, 'Abhishek', 'K', 'Shrivastav', 'abhi786.2015@gmail.com', 'abhi_123', 'e10adc3949ba59abbe56e057f20f883e', 'Updater', 'Active', '2022-08-24 10:29:09.553301'),
(3, 'Ashish', 'Kumar', 'Sharma', 'ashish1@gmail.com', 'ashish_89712', '25d55ad283aa400af464c76d713c07ad', 'Viewer', 'Inactive', '2022-08-24 10:29:57.206405'),
(4, 'Sanjana', 'K', 'Thakur', 'sanjana@gmail.com', 'sanjana123_', 'e10adc3949ba59abbe56e057f20f883e', 'Viewer', 'Active', '2022-08-24 10:30:49.170264'),
(5, 'Vimal', 'K', 'Kumar', 'vimalk@gmail.com', 'vimal_k123', '8d70d8ab2768f232ebe874175065ead3', 'Viewer', 'Inactive', '2022-08-24 10:31:30.658777'),
(6, 'Anjali', 'K', 'Kumari', 'anjali_k@gmail.com', 'anjali_k', '8d70d8ab2768f232ebe874175065ead3', 'Updater', 'Inactive', '2022-08-24 10:32:31.299014'),
(7, 'Sumit', 'Pal', 'Kumar', 'sumit@gmail.com', 'sumit123', '8117da1feb656f657786cad4f6669744', 'Viewer', 'Inactive', '2022-08-24 10:33:17.525881'),
(8, 'Amit', 'Pal', 'Kumar', 'amit@gmail.com', 'amit2341', '8117da1feb656f657786cad4f6669744', 'Admin', 'Active', '2022-08-24 10:33:43.495725'),
(9, 'Sakshi', 'K', 'Tiwari', 'sakshi@gmail.com', 'sakshi_123', 'f3bb06607732c34aecec5683f27d2fcd', 'Viewer', 'Active', '2022-08-24 10:35:16.944752'),
(10, 'Krishna', 'K', 'Thakur', 'krishna@gmail.com', 'krishna123', 'cb5e35fe0160c0a3439ecec60523ff30', 'Admin', 'Inactive', '2022-08-24 10:36:01.877695'),
(11, 'Swati', 'K', 'Arora', 'swati@gmail.com', 'swati_122', 'cb5e35fe0160c0a3439ecec60523ff30', 'Viewer', 'Inactive', '2022-08-24 10:36:54.068795'),
(12, 'Abhimanyu', 'K', 'Mishra', 'abhi2015@gmail.com', 'abhi_12322', 'fcea920f7412b5da7be0cf42b8c93759', 'Viewer', 'Active', '2022-08-25 08:49:18.334214'),
(13, 'Akshay', 'Kumar', 'Tiwari', 'akshay@gmail.com', 'akshay123', '4297f44b13955235245b2497399d7a93', 'Viewer', 'Active', '2022-08-25 08:50:13.346417'),
(15, 'Abhay', 'Kumar', 'Sharma', 'abhay@gmail.com', 'abhay123', NULL, 'Viewer', 'Inactive', '2022-08-25 15:40:10.194613'),
(14, 'Aman', 'Kumar', 'Yadav', 'aman@gmail.com', 'aman123_', NULL, 'Admin', 'Active', '2022-08-25 13:19:01.323310');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
