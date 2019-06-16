-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 16, 2019 at 11:36 AM
-- Server version: 5.7.26-0ubuntu0.18.04.1
-- PHP Version: 7.2.19-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `perfautom`
--

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `lastname` varchar(120) NOT NULL,
  `firstname` varchar(120) NOT NULL,
  `birth_date` date NOT NULL,
  `reason_hospitalisation` varchar(250) NOT NULL,
  `room_number` int(11) NOT NULL,
  `doctor` varchar(120) NOT NULL,
  `number_day_hospitalisation` int(11) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `lastname`, `firstname`, `birth_date`, `reason_hospitalisation`, `room_number`, `doctor`, `number_day_hospitalisation`, `service_id`) VALUES
(1, 'X', 'Monsieur', '1974-01-02', 'Arthroscopie du genou', 14, 'Dupont', 3, 2),
(2, 'Y', 'Madame', '1984-06-17', 'Douleurs thoraciques', 15, 'Dupond', 4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `service`
--

CREATE TABLE `service` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `manager_name` varchar(120) NOT NULL,
  `specialty` varchar(120) NOT NULL,
  `rooms_number` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `service`
--

INSERT INTO `service` (`id`, `manager_name`, `specialty`, `rooms_number`) VALUES
(1, 'Decan', 'Traumatologie', 25),
(2, 'Rose', 'Urgences', 40),
(3, 'Blure', 'Chirurgie', 30),
(4, 'Waloviak', 'Urologie', 15),
(5, 'Dupas', 'Réanimation', 20),
(6, 'Merchez', 'Ambulatoire', 10);

-- --------------------------------------------------------

--
-- Table structure for table `syringe`
--

CREATE TABLE `syringe` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `substance` varchar(120) DEFAULT NULL,
  `prescribed_dose` float DEFAULT NULL,
  `max_dose` float DEFAULT NULL,
  `prescriber` varchar(120) DEFAULT NULL,
  `ip_address` varchar(50) NOT NULL,
  `state` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `syringe`
--

INSERT INTO `syringe` (`id`, `patient_id`, `substance`, `prescribed_dose`, `max_dose`, `prescriber`, `ip_address`, `state`) VALUES
(1, NULL, NULL, NULL, NULL, NULL, '10.153.179.102', 0),
(2, NULL, NULL, NULL, NULL, NULL, '172.30.25.8', 0),
(3, 2, 'Adrénaline', 12.5, 16, 'Dupont', '10.153.172.100', 1),
(4, 2, 'Kétamine', 9, 15, 'Tournesol', '10.153.172.104', 2),
(5, 2, 'Propofol', 13, 18, 'Tournesol', '10.153.172.105', 3);

-- --------------------------------------------------------

--
-- Table structure for table `treatment`
--

CREATE TABLE `treatment` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `syringe_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `new_dose` float NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `treatment`
--

INSERT INTO `treatment` (`id`, `syringe_id`, `patient_id`, `date_time`, `new_dose`, `user_id`) VALUES
(10, 3, 2, '2019-06-16 11:26:16', 12.5, 1),
(11, 4, 2, '2019-06-16 11:26:44', 9, 1),
(12, 5, 2, '2019-06-16 11:27:06', 13, 1),
(13, 4, 2, '2019-06-16 11:28:14', 11.5, 1),
(14, 4, 2, '2019-06-16 11:28:17', 12.75, 1),
(15, 4, 2, '2019-06-16 11:28:36', 11.5, 1),
(16, 4, 2, '2019-06-16 11:28:39', 14, 1),
(17, 4, 2, '2019-06-16 11:28:42', 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `login` varchar(11) NOT NULL,
  `password` varchar(10) NOT NULL,
  `lastname` varchar(30) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `profession` varchar(50) NOT NULL,
  `service_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `login`, `password`, `lastname`, `firstname`, `profession`, `service_id`) VALUES
(1, 'user', 'password', 'Lammens', 'Julien', 'Médecin', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `syringe`
--
ALTER TABLE `syringe`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `treatment`
--
ALTER TABLE `treatment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `service`
--
ALTER TABLE `service`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `syringe`
--
ALTER TABLE `syringe`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `treatment`
--
ALTER TABLE `treatment`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
