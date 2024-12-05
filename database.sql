-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2024 at 06:50 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `comparaison`
--

-- --------------------------------------------------------

--
-- Table structure for table `appartement`
--

CREATE TABLE `appartement` (
  `id_ap` int(11) NOT NULL,
  `ville_ap` varchar(50) DEFAULT NULL,
  `pays_ap` varchar(50) DEFAULT NULL,
  `quartier_ap` varchar(250) DEFAULT NULL,
  `salon_ap` int(11) DEFAULT NULL,
  `chambre_ap` int(11) DEFAULT NULL,
  `douche_ap` int(11) DEFAULT NULL,
  `prix_ap` int(11) DEFAULT NULL,
  `detail_ap` varchar(200) DEFAULT NULL,
  `comment_ap` varchar(250) DEFAULT NULL,
  `superficie_ap` int(11) DEFAULT NULL,
  `atouts_ap` varchar(250) DEFAULT NULL,
  `photo_ap` varchar(250) DEFAULT NULL,
  `maps_ap` varchar(250) NOT NULL,
  `cuisine_ap` int(2) NOT NULL,
  `tel_ap` varchar(50) NOT NULL,
  `mobilier` varchar(250) NOT NULL,
  `nom_ap` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chambre_hotel`
--

CREATE TABLE `chambre_hotel` (
  `id_chambre` int(11) NOT NULL,
  `date_debut` date DEFAULT NULL,
  `nbre_chambre` int(11) DEFAULT NULL,
  `nbre_adultes` int(11) DEFAULT NULL,
  `nbre_enfants` int(11) DEFAULT NULL,
  `categorie_ch` varchar(50) DEFAULT NULL,
  `prix_ch` int(11) DEFAULT NULL,
  `option_ch` int(11) DEFAULT NULL,
  `detail_ch` varchar(250) DEFAULT NULL,
  `debut_date` date NOT NULL,
  `fin_date` date NOT NULL,
  `familial` tinyint(1) NOT NULL,
  `atout_ch` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `gestionnaire_appartement`
--

CREATE TABLE `gestionnaire_appartement` (
  `id_ges_ap` int(11) NOT NULL,
  `id_villa` int(11) NOT NULL,
  `id_ap` int(11) NOT NULL,
  `nom_ges_ap` varchar(50) DEFAULT NULL,
  `email_ges_ap` varchar(50) DEFAULT NULL,
  `date_nais_ges_ap` date DEFAULT NULL,
  `tel_ges_ap` varchar(15) DEFAULT NULL,
  `ville_ges_ap` varchar(50) DEFAULT NULL,
  `quartier_ges_ap` varchar(50) DEFAULT NULL,
  `pays_ges_ap` varchar(50) DEFAULT NULL,
  `nationalite_ges_ap` varchar(50) DEFAULT NULL,
  `num_cni_ges_ap` varchar(50) DEFAULT NULL,
  `num_pass_ges_ap` varchar(50) DEFAULT NULL,
  `num_permis_ges_ap` varchar(50) DEFAULT NULL,
  `photo_ges_ap` varchar(250) DEFAULT NULL,
  `mdp_ges_ap` int(6) NOT NULL,
  `id_chambre` int(11) NOT NULL,
  `id_hotel` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hotel`
--

CREATE TABLE `hotel` (
  `id_hotel` int(11) NOT NULL,
  `id_ges_ap` int(11) NOT NULL,
  `id_chambre` int(11) DEFAULT NULL,
  `nom_hotel` varchar(50) DEFAULT NULL,
  `pays_hotel` varchar(50) DEFAULT NULL,
  `ville_hotel` varchar(50) DEFAULT NULL,
  `quartier_hotel` varchar(250) DEFAULT NULL,
  `nbre_etoile` int(20) DEFAULT NULL,
  `commentaire_hotel` varchar(250) DEFAULT NULL,
  `photo_hotel` varchar(250) DEFAULT NULL,
  `detail_hotel` varchar(255) NOT NULL,
  `atout_hotel` varchar(255) NOT NULL,
  `maps_hotel` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `louer`
--

CREATE TABLE `louer` (
  `id_ap` int(11) NOT NULL,
  `id_ges_ap` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reserver`
--

CREATE TABLE `reserver` (
  `id_ges_ap` int(11) NOT NULL,
  `id_chambre` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `villa`
--

CREATE TABLE `villa` (
  `id_villa` int(11) NOT NULL,
  `pays_villa` varchar(50) DEFAULT NULL,
  `ville_villa` varchar(50) DEFAULT NULL,
  `quartier_villa` varchar(50) DEFAULT NULL,
  `prix_villa` int(11) DEFAULT NULL,
  `superficie_villa` int(11) DEFAULT NULL,
  `atout_villa` varchar(250) DEFAULT NULL,
  `detail_villa` varchar(250) DEFAULT NULL,
  `salon_villa` int(11) DEFAULT NULL,
  `chambre_villa` int(11) DEFAULT NULL,
  `douche_villa` int(11) DEFAULT NULL,
  `cuisuine_villa` int(11) DEFAULT NULL,
  `photo_villa` varchar(250) DEFAULT NULL,
  `commentaire_villa` varchar(250) DEFAULT NULL,
  `nom_villa` varchar(250) NOT NULL,
  `mobilier_villa` varchar(250) NOT NULL,
  `maps_villa` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vivre`
--

CREATE TABLE `vivre` (
  `id_ges_ap` int(11) NOT NULL,
  `id_villa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appartement`
--
ALTER TABLE `appartement`
  ADD PRIMARY KEY (`id_ap`);

--
-- Indexes for table `chambre_hotel`
--
ALTER TABLE `chambre_hotel`
  ADD PRIMARY KEY (`id_chambre`);

--
-- Indexes for table `gestionnaire_appartement`
--
ALTER TABLE `gestionnaire_appartement`
  ADD PRIMARY KEY (`id_ges_ap`),
  ADD KEY `gestionnaire_appartement_ibfk_1` (`id_villa`),
  ADD KEY `gestionnaire_appartement_ibfk_2` (`id_ap`),
  ADD KEY `id_chambre` (`id_chambre`),
  ADD KEY `id_hotel` (`id_hotel`);

--
-- Indexes for table `hotel`
--
ALTER TABLE `hotel`
  ADD PRIMARY KEY (`id_hotel`),
  ADD KEY `hotel_ibfk_1` (`id_ges_ap`),
  ADD KEY `id_chambre` (`id_chambre`);

--
-- Indexes for table `louer`
--
ALTER TABLE `louer`
  ADD PRIMARY KEY (`id_ap`,`id_ges_ap`),
  ADD KEY `louer_ibfk_2` (`id_ges_ap`);

--
-- Indexes for table `reserver`
--
ALTER TABLE `reserver`
  ADD PRIMARY KEY (`id_ges_ap`,`id_chambre`),
  ADD KEY `reserver_ibfk_2` (`id_chambre`);

--
-- Indexes for table `villa`
--
ALTER TABLE `villa`
  ADD PRIMARY KEY (`id_villa`);

--
-- Indexes for table `vivre`
--
ALTER TABLE `vivre`
  ADD PRIMARY KEY (`id_ges_ap`,`id_villa`),
  ADD KEY `id_villa` (`id_villa`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `louer`
--
ALTER TABLE `louer`
  MODIFY `id_ges_ap` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gestionnaire_appartement`
--
ALTER TABLE `gestionnaire_appartement`
  ADD CONSTRAINT `gestionnaire_appartement_ibfk_1` FOREIGN KEY (`id_villa`) REFERENCES `villa` (`id_villa`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestionnaire_appartement_ibfk_2` FOREIGN KEY (`id_ap`) REFERENCES `appartement` (`id_ap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestionnaire_appartement_ibfk_3` FOREIGN KEY (`id_chambre`) REFERENCES `chambre_hotel` (`id_chambre`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `gestionnaire_appartement_ibfk_4` FOREIGN KEY (`id_hotel`) REFERENCES `hotel` (`id_hotel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `hotel`
--
ALTER TABLE `hotel`
  ADD CONSTRAINT `hotel_ibfk_1` FOREIGN KEY (`id_chambre`) REFERENCES `chambre_hotel` (`id_chambre`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `louer`
--
ALTER TABLE `louer`
  ADD CONSTRAINT `louer_ibfk_1` FOREIGN KEY (`id_ap`) REFERENCES `appartement` (`id_ap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `louer_ibfk_2` FOREIGN KEY (`id_ges_ap`) REFERENCES `gestionnaire_appartement` (`id_ges_ap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `reserver`
--
ALTER TABLE `reserver`
  ADD CONSTRAINT `reserver_ibfk_2` FOREIGN KEY (`id_chambre`) REFERENCES `gestionnaire_appartement` (`id_ges_ap`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vivre`
--
ALTER TABLE `vivre`
  ADD CONSTRAINT `vivre_ibfk_1` FOREIGN KEY (`id_ges_ap`) REFERENCES `gestionnaire_appartement` (`id_ges_ap`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `vivre_ibfk_2` FOREIGN KEY (`id_villa`) REFERENCES `villa` (`id_villa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
