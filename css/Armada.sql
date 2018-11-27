-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Nov 07, 2018 at 04:01 PM
-- Server version: 5.6.38
-- PHP Version: 7.2.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `Armada`
--

-- --------------------------------------------------------

--
-- Table structure for table `Administrator`
--

CREATE TABLE `Administrator` (
  `id` int(11) NOT NULL,
  `idInscrit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Administrator`
--

INSERT INTO `Administrator` (`id`, `idInscrit`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `Boat`
--

CREATE TABLE `Boat` (
  `id` int(11) NOT NULL,
  `nomBoat` varchar(20) NOT NULL,
  `greement` varchar(20) NOT NULL,
  `longueur` float NOT NULL,
  `lancement` int(11) NOT NULL,
  `idResponsable` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Inscrit`
--

CREATE TABLE `Inscrit` (
  `id` int(11) NOT NULL,
  `nom` varchar(20) NOT NULL,
  `prenom` varchar(15) NOT NULL,
  `unom` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Inscrit`
--

INSERT INTO `Inscrit` (`id`, `nom`, `prenom`, `unom`, `email`, `password`) VALUES
(1, 'zhao', 'yinjie', 'admin', 'jack0825@126.com', '0000'),
(2, 'ss', 'yiyi', 'ssa', '90@121', '121'),
(3, 'ss', 'yiyi', 'ssa', '90@121', '121'),
(4, 'asa', 'yiy', 'qqq', 'qq@11', '123'),
(11, 'DC', 'Mariana', 'mari', '123@123', '123');

-- --------------------------------------------------------

--
-- Table structure for table `Responsable`
--

CREATE TABLE `Responsable` (
  `id` int(11) NOT NULL,
  `idInscrit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Responsable`
--

INSERT INTO `Responsable` (`id`, `idInscrit`) VALUES
(1, 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idInscritAdmin` (`idInscrit`);

--
-- Indexes for table `Boat`
--
ALTER TABLE `Boat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idResponsable` (`idResponsable`);

--
-- Indexes for table `Inscrit`
--
ALTER TABLE `Inscrit`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Responsable`
--
ALTER TABLE `Responsable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_idInscrit` (`idInscrit`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Administrator`
--
ALTER TABLE `Administrator`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `Boat`
--
ALTER TABLE `Boat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `Inscrit`
--
ALTER TABLE `Inscrit`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `Responsable`
--
ALTER TABLE `Responsable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `Administrator`
--
ALTER TABLE `Administrator`
  ADD CONSTRAINT `fk_idInscritAdmin` FOREIGN KEY (`idInscrit`) REFERENCES `Inscrit` (`id`);

--
-- Constraints for table `Boat`
--
ALTER TABLE `Boat`
  ADD CONSTRAINT `fk_idResponsable` FOREIGN KEY (`idResponsable`) REFERENCES `Responsable` (`id`);

--
-- Constraints for table `Responsable`
--
ALTER TABLE `Responsable`
  ADD CONSTRAINT `fk_idInscrit` FOREIGN KEY (`idInscrit`) REFERENCES `Inscrit` (`id`);