-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 12, 2024 at 07:15 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `home_service`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `Email` varchar(200) NOT NULL,
  `Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`Email`, `Password`) VALUES
('[m]', '[m]'),
('m', 'm');

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `service_type` enum('Self-Isolation Package','Elderly and Special Needs Care','Home Sanitization and Disinfection Package','COVID-19 Testing and Health Checkups','Home Security Services','Contactless Delivery Servicese') NOT NULL,
  `preferred_start_date` date NOT NULL,
  `preferred_end_date` date NOT NULL,
  `duration` int(11) NOT NULL,
  `cost` decimal(10,2) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `name`, `mobile`, `email`, `service_type`, `preferred_start_date`, `preferred_end_date`, `duration`, `cost`, `notes`, `created_at`) VALUES
(7, 'Hd23Q1lbPNYqZYkpQDnAIDi2iG07k7Ej2I3ALordTjY=', '2VaNzRKWNKCaNCBWFWVP', 'K/eTPXMjlVf+1jPTcq5nFIgQM4MRfNP7bJEecdMIP8k=', 'Elderly and Special Needs Care', '2024-10-28', '2024-11-09', 11, '56.00', '9GGEqkLs+lwD3zNFAeqr/oUza648JV/XbevxLcEW7Bqu2jH524Sgj5OWa8KqtSZD', '2024-11-11 17:39:11'),
(8, 'aWk5S/8IjpKkXBNpRNIcTQ==', 'UMMSWSF9NHu1WFsweU9e/Q==', 'qscp9iXw0i8Cl3jiobSSKQ==', 'Home Sanitization and Disinfection Package', '2024-11-04', '2024-11-11', 7, '15.00', '8BTLV4EPRmRvkLa6FxGkuHTBteP6xwx6UGb4siMKwEI=', '2024-11-11 17:51:50'),
(9, 'Hd23Q1lbPNYqZYkpQDnAIDi2iG07k7Ej2I3ALordTjY=', '2VaNzRKWNKCaNCBWFWVPRA==', 'K/eTPXMjlVf+1jPTcq5nFIgQM4MRfNP7bJEecdMIP8k=', 'COVID-19 Testing and Health Checkups', '2024-11-07', '2024-11-12', 5, '23.00', '8BTLV4EPRmRvkLa6FxGkuIL8jFAsoL7nQVNPvPyOcAQ=', '2024-11-11 18:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `booking_requests`
--

CREATE TABLE `booking_requests` (
  `id` int(11) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `service_type` varchar(100) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `covid_vaccine_status` varchar(10) DEFAULT NULL,
  `other_details` text DEFAULT NULL,
  `status` enum('Pending','Accepted','Rejected') DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `booking_requests`
--

INSERT INTO `booking_requests` (`id`, `username`, `email`, `service_type`, `preferred_date`, `covid_vaccine_status`, `other_details`, `status`, `created_at`) VALUES
(1, 'Mredul Chakraborty', 'mredul@gmail.com', 'Self-Isolation Package', '2024-11-04', 'Yes', 'Required Fully furnished and clean room.', 'Accepted', '2024-11-12 17:58:34'),
(2, 'Nayan Halder', 'nayan@gmail.com', 'Home Sanitization and Disinfection Package', '2024-11-06', 'No', 'Please come after 12 pm', 'Accepted', '2024-11-12 17:58:34'),
(3, 'John Doe', 'john@gmail.com', 'Elderly and Special Needs Care', '2024-11-12', 'No', 'Please take care of my grandmother', 'Pending', '2024-11-12 18:07:00');

-- --------------------------------------------------------

--
-- Table structure for table `pending_requests`
--

CREATE TABLE `pending_requests` (
  `Username` varchar(200) NOT NULL,
  `Email` varchar(200) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Phone_Number` varchar(200) NOT NULL,
  `Pending` varchar(200) NOT NULL,
  `Covid_vaccine_status` varchar(200) NOT NULL,
  `Covid_infected` varchar(200) NOT NULL,
  `Other` varchar(200) NOT NULL,
  `Phone` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pending_requests`
--

INSERT INTO `pending_requests` (`Username`, `Email`, `Address`, `Phone_Number`, `Pending`, `Covid_vaccine_status`, `Covid_infected`, `Other`, `Phone`) VALUES
('a', 'a', 'a]', 'a', 'a', 'a', 'a', 'a', 'a'),
('b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `review_text` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `user_id`, `service_id`, `rating`, `review_text`, `created_at`) VALUES
(6, 8, 3, 4, 'Their services are very good. Must be recommended.', '2024-11-11 18:12:39'),
(7, 9, 4, 4, 'They are always available and sensible about their work. Also, they were very friendly with children and elder members in my house.', '2024-11-11 18:15:52'),
(8, 8, 4, 3, 'They are very punctual and deliver reports in a short period.', '2024-11-11 18:17:50'),
(9, 7, 2, 4, 'They are very responsible and caring.', '2024-11-11 18:45:18');

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `service_id` int(11) NOT NULL,
  `service_name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `estimated_duration` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`service_id`, `service_name`, `description`, `estimated_duration`, `price`, `created_at`, `image_path`) VALUES
(1, 'Self-Isolation Package', 'Delivery of essential supplies such as groceries, medicines, and hygiene products for individuals in quarantine.\r\nMeal preparation and delivery services for patients who are isolating at home.\r\nProviding oxygen concentrators or medical equipment rental for those with mild symptoms.', '3 hours per day', '100.00', '2024-11-09 15:30:34', 'images\\contact.jpg'),
(2, 'Elderly and Special Needs Care', 'At-home nursing and caregiving services for elderly and vulnerable individuals.\r\nAssistance with daily activities like bathing, dressing, and mobility support.\r\nPhysiotherapy sessions and wellness checks to monitor the health of elderly family members.', '11 days ', '30.00', '2024-11-09 15:52:42', 'images/social-isolation.jpg'),
(3, 'Home Sanitization and Disinfection Package', 'Complete sanitization and deep cleaning of the home to ensure it is free from viruses, bacteria, and other pathogens.\r\nSpecialized disinfection of high-touch surfaces such as door handles, light switches, countertops, and appliances.\r\nUse of eco-friendly, non-toxic disinfectants to maintain a healthy environment.', '1 hours per day', '8.00', '2024-11-09 17:22:37', 'images/home sanitationjpg.jpg'),
(4, 'COVID-19 Testing and Health Checkups', 'At-home COVID-19 testing services for individuals and families.\r\nBasic health checkups, including temperature checks, blood pressure monitoring, and oxygen saturation level tests.\r\nVirtual consultations with doctors and healthcare professionals.', '1 hours per day', '10.00', '2024-11-09 17:22:37', 'images/covid test.jpeg'),
(5, 'Home Security Services', 'Installation of security systems, including smart doorbells, surveillance cameras, and motion sensors.\r\nSecurity audits to identify potential vulnerabilities and enhance home safety.', '11 days', '50.00', '2024-11-09 17:25:15', 'images/monitor.jpeg'),
(6, 'Contactless Delivery Services', 'Contactless delivery of groceries, meals, pharmaceuticals, and other essentials.\r\nSafe handling and sanitization protocols for all deliveries.', ' 2 days per week', '35.00', '2024-11-09 17:25:15', 'images/deliver.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `Username` varchar(100) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Address` varchar(500) NOT NULL,
  `Phone_Number` int(14) NOT NULL,
  `Password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`Username`, `Email`, `Address`, `Phone_Number`, `Password`) VALUES
('a', 'a', 'a', 450521575, 'a'),
('m', 'm', 'm', 0, 'm'),
('x', 'x', 'x', 0, 'x');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `citizenship` varchar(50) NOT NULL,
  `vaccinated` enum('Yes','No') NOT NULL,
  `profession` varchar(100) NOT NULL,
  `language` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `age`, `mobile`, `email`, `citizenship`, `vaccinated`, `profession`, `language`, `password`, `created_at`) VALUES
(6, 'Mona Islam', 28, 'PT8z5vbMQCBDiW2mqu9kZA==', '4dRNNP58CdJVdphsP7mw3w==', 'India', 'No', 'Housewife', 'English', '$2y$10$s/veqzDj6kCSet81Jk.PoOQIUE1ex4AU9tZ0bq3e.sskjwofS4ojq', '2024-11-11 17:25:15'),
(7, 'Mredul Chakraborty', 27, '2VaNzRKWNKCaNCBWFWVPRA==', 'K/eTPXMjlVf+1jPTcq5nFIgQM4MRfNP7bJEecdMIP8k=', 'Bangladesh', 'Yes', 'Student', 'English', '$2y$10$tB3RYPhkTuSOhUh8K7DpD.QRdR1ppJF89vTHnk48Lm4OSoSF0v5.S', '2024-11-11 17:36:04'),
(8, 'Nayan Haldar', 27, 'UMMSWSF9NHu1WFsweU9e/Q==', 'qscp9iXw0i8Cl3jiobSSKQ==', 'Bangladesh', 'No', 'Student', 'English', '$2y$10$BOYZFz4f0q0azrC66KVtueqNFJJI3SX.qipvQ3ik1y9OyXUD2/hzu', '2024-11-11 17:36:52'),
(9, 'John Doe', 30, 'UMMSWSF9NHu1WFsweU9e/Q==', '/GwKEIGSsdgdemBKR2nNUg==', 'Australia', 'No', 'Businessman', 'English', '$2y$10$KpnVwz6JBB8YpoViRHO3eu3OKi8wkoAtH0ZY06iCXaPruzSBV5sjO', '2024-11-11 17:37:26');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `booking_requests`
--
ALTER TABLE `booking_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `booking_requests`
--
ALTER TABLE `booking_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
