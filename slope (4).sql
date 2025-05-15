-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Mar 27, 2025 alle 16:30
-- Versione del server: 10.4.32-MariaDB
-- Versione PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slope`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `admin`
--

CREATE TABLE `admin` (
  `idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `admin`
--

INSERT INTO `admin` (`idUser`) VALUES
(0);

-- --------------------------------------------------------

--
-- Struttura della tabella `creditcard`
--

CREATE TABLE `creditcard` (
  `idCreditCard` int(3) NOT NULL,
  `cardHolderName` varchar(255) NOT NULL,
  `cardHolderSurname` varchar(255) NOT NULL,
  `expiryDate` varchar(255) NOT NULL,
  `cardNumber` varchar(255) NOT NULL,
  `cvv` varchar(255) NOT NULL,
  `idUser` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `creditcard`
--

INSERT INTO `creditcard` (`idCreditCard`, `cardHolderName`, `cardHolderSurname`, `expiryDate`, `cardNumber`, `cvv`, `idUser`) VALUES
(32, 'Lorenzo', 'D\'Amico', '2100-01', '1234567890123456', '123', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `image`
--

CREATE TABLE `image` (
  `idImage` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `imageData` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `insurance`
--

CREATE TABLE `insurance` (
  `idInsurance` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `period` int(3) NOT NULL,
  `price` float NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `idUser` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `insurance`
--

INSERT INTO `insurance` (`idInsurance`, `name`, `surname`, `email`, `type`, `period`, `price`, `startDate`, `idUser`) VALUES
(21, 'Lorenzo', 'D\'Amico', 'lorenzo@gmail.com', 'intero', 1, 10, '2025-03-01', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `insurancetemp`
--

CREATE TABLE `insurancetemp` (
  `idInsuranceTemp` int(3) NOT NULL,
  `type` varchar(255) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `insurancetemp`
--

INSERT INTO `insurancetemp` (`idInsuranceTemp`, `type`, `value`) VALUES
(1, 'intero', 10);

-- --------------------------------------------------------

--
-- Struttura della tabella `liftstructure`
--

CREATE TABLE `liftstructure` (
  `idLiftStructure` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `seats` int(3) NOT NULL,
  `idSkiFacility` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `liftstructure`
--

INSERT INTO `liftstructure` (`idLiftStructure`, `name`, `type`, `status`, `seats`, `idSkiFacility`) VALUES
(1, 'Pizzalto 1', 'seggiovia', 'chiuso', 4, 1),
(2, 'Pizzalto 2', 'seggiovia', 'chiuso', 4, 1),
(3, 'Ombrellone', 'seggiovia', 'chiuso', 4, 1),
(4, 'Toppe del Tesoro', 'cabinovia', 'chiuso', 8, 1),
(5, 'Pallottieri', 'seggiovia', 'chiuso', 4, 2),
(6, 'Aremogna', 'seggiovia', 'chiuso', 6, 2),
(7, 'Valle Verde', 'cabinovia', 'chiuso', 8, 2),
(8, 'Macchione', 'seggiovia', 'chiuso', 4, 2),
(9, 'Pratello', 'cabinovia', 'chiuso', 8, 3),
(10, 'Valle Delle Gravare', 'seggiovia', 'chiuso', 4, 3),
(11, 'Pino Solitario', 'seggiovia', 'chiuso', 4, 3),
(12, 'Sotto Tofana', 'seggiovia', 'chiuso', 2, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `payment`
--

CREATE TABLE `payment` (
  `idPayment` int(3) NOT NULL,
  `totalAmount` float NOT NULL,
  `date` varchar(255) NOT NULL,
  `extObjClass` varchar(255) NOT NULL,
  `idExternalObj` int(3) NOT NULL,
  `idCreditCard` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `payment`
--

INSERT INTO `payment` (`idPayment`, `totalAmount`, `date`, `extObjClass`, `idExternalObj`, `idCreditCard`) VALUES
(9, 35, '2025-03-01', 'ESkipassBooking', 32, 32),
(10, 10, '2025-03-01', 'EInsurance', 21, 32);

-- --------------------------------------------------------

--
-- Struttura della tabella `person`
--

CREATE TABLE `person` (
  `idUser` int(2) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `birthDate` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `person`
--

INSERT INTO `person` (`idUser`, `name`, `surname`, `email`, `phoneNumber`, `birthDate`) VALUES
(1, 'Lorenzo', 'D\'Amico', 'lorenzo@gmail.com', '1234567891', '2002-10-10');

-- --------------------------------------------------------

--
-- Struttura della tabella `price`
--

CREATE TABLE `price` (
  `idPrice` int(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` int(3) NOT NULL,
  `extClass` varchar(255) NOT NULL,
  `idExtObj` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `price`
--

INSERT INTO `price` (`idPrice`, `description`, `value`, `extClass`, `idExtObj`) VALUES
(13, 'assicurazione intero', 10, 'EInsuranceTemp', 1),
(14, 'assicurazione ridotto', 5, 'EInsuranceTemp', 2);

-- --------------------------------------------------------

--
-- Struttura della tabella `skifacility`
--

CREATE TABLE `skifacility` (
  `idSkiFacility` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `skifacility`
--

INSERT INTO `skifacility` (`idSkiFacility`, `name`, `status`, `description`) VALUES
(1, 'Roccaraso', 'chiuso', 'Roccaraso è senza dubbio il più grande comprensorio sciistico dell\'Italia centrale grazie ai suoi 130 km di piste che collegano le località di Rivisondoli, Pescocostanzo e Pescasseroli.'),
(2, 'Ovindoli', 'chiuso', 'La stazione di sport invernali di Ovindoli (sci e Snowboard) denominata “MONTE MAGNOLA IMPIANTI” (1500-2000 mt slm) si trova nel cuore del Parco Regionale Velino-Sirente, nella caratteristica cornice delle montagne dell’Appenino Abruzzese.'),
(3, 'Campo Felice', 'chiuso', 'Si trova al centro di una vasta conchiglia, fatta con i bordi di cinque montagne, tutte alte più di 2000 metri ed innevate da novembre ad aprile. \r\n');

-- --------------------------------------------------------

--
-- Struttura della tabella `skifacilityimages`
--

CREATE TABLE `skifacilityimages` (
  `idSkiFacility` int(2) NOT NULL,
  `idImage` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `skipassbooking`
--

CREATE TABLE `skipassbooking` (
  `idSkipassBooking` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `value` float NOT NULL,
  `period` int(3) NOT NULL,
  `idUser` int(3) NOT NULL,
  `idSkipassObj` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `skipassbooking`
--

INSERT INTO `skipassbooking` (`idSkipassBooking`, `name`, `surname`, `type`, `startDate`, `email`, `value`, `period`, `idUser`, `idSkipassObj`) VALUES
(32, 'Lorenzo', 'D\'Amico', 'intero', '2025-03-01', 'lorenzo@gmail.com', 35, 1, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `skipassobj`
--

CREATE TABLE `skipassobj` (
  `idSkipassObj` int(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `value` float NOT NULL,
  `idSkiFacility` int(3) NOT NULL,
  `idSkipassTemp` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `skipassobj`
--

INSERT INTO `skipassobj` (`idSkipassObj`, `description`, `value`, `idSkiFacility`, `idSkipassTemp`) VALUES
(1, 'giornaliero Roccaraso', 35, 1, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `skipasstemp`
--

CREATE TABLE `skipasstemp` (
  `idSkipassTemp` int(3) NOT NULL,
  `description` varchar(255) NOT NULL,
  `period` int(3) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `skipasstemp`
--

INSERT INTO `skipasstemp` (`idSkipassTemp`, `description`, `period`, `type`) VALUES
(1, 'giornaliero', 1, 'intero');

-- --------------------------------------------------------

--
-- Struttura della tabella `skirun`
--

CREATE TABLE `skirun` (
  `idSkiRun` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `idSkiFacility` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `skirun`
--

INSERT INTO `skirun` (`idSkiRun`, `name`, `type`, `status`, `idSkiFacility`) VALUES
(1, 'Pista Direttissima', 'nera', 'chiuso', 1),
(2, 'Pista Lupo', 'nera', 'chiuso', 1),
(3, 'Pista Gravare', 'rossa', 'chiuso', 1),
(4, 'Pista Monte Pratello', 'blu', 'chiuso', 1),
(5, 'Pista Pallottieri', 'nera', 'chiuso', 2),
(6, 'Pista Paradiso', 'nera', 'chiuso', 2),
(7, 'Pista Gravare', 'rossa', 'chiuso', 2),
(8, 'Pista Valle Verde', 'blu', 'chiuso', 2),
(9, 'Pista Paradiso Alta', 'blu', 'chiuso', 2),
(10, 'Pista Pratello Direttissima', 'nera', 'chiuso', 3),
(11, 'Pista Pino Solitario', 'rossa', 'chiuso', 3),
(12, 'Pista Osservatorio', 'rossa', 'chiuso', 3),
(13, 'Pista Panoramica', 'blu', 'chiuso', 3),
(14, 'Pista Mucchia di Pacentro', 'blu', 'chiuso', 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `subscription`
--

CREATE TABLE `subscription` (
  `idSubscription` int(3) NOT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `period` varchar(255) NOT NULL,
  `startDate` varchar(255) NOT NULL,
  `idUser` int(3) NOT NULL,
  `idPrice` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struttura della tabella `user`
--

CREATE TABLE `user` (
  `idUser` int(11) NOT NULL,
  `idImage` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `user`
--

INSERT INTO `user` (`idUser`, `idImage`, `username`, `password`) VALUES
(1, 0, 'Lorenzo20', '$2y$10$ld38c2Qezbj/8hqiOa9q/eS7rrxpnHGTnN5L65MZWZa2FuoIjbJlO'),
(0, 0, 'admin', '$2y$10$sPXD90Fr3VVmpvAE0glnw.EOCOdje4fIdDz02TD0KDxtyt1FssXPO');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`idUser`);

--
-- Indici per le tabelle `creditcard`
--
ALTER TABLE `creditcard`
  ADD PRIMARY KEY (`idCreditCard`);

--
-- Indici per le tabelle `image`
--
ALTER TABLE `image`
  ADD PRIMARY KEY (`idImage`);

--
-- Indici per le tabelle `insurance`
--
ALTER TABLE `insurance`
  ADD PRIMARY KEY (`idInsurance`);

--
-- Indici per le tabelle `insurancetemp`
--
ALTER TABLE `insurancetemp`
  ADD PRIMARY KEY (`idInsuranceTemp`);

--
-- Indici per le tabelle `liftstructure`
--
ALTER TABLE `liftstructure`
  ADD PRIMARY KEY (`idLiftStructure`);

--
-- Indici per le tabelle `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`idPayment`);

--
-- Indici per le tabelle `person`
--
ALTER TABLE `person`
  ADD PRIMARY KEY (`idUser`);

--
-- Indici per le tabelle `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`idPrice`);

--
-- Indici per le tabelle `skifacility`
--
ALTER TABLE `skifacility`
  ADD PRIMARY KEY (`idSkiFacility`);

--
-- Indici per le tabelle `skipassbooking`
--
ALTER TABLE `skipassbooking`
  ADD PRIMARY KEY (`idSkipassBooking`);

--
-- Indici per le tabelle `skipassobj`
--
ALTER TABLE `skipassobj`
  ADD PRIMARY KEY (`idSkipassObj`);

--
-- Indici per le tabelle `skipasstemp`
--
ALTER TABLE `skipasstemp`
  ADD PRIMARY KEY (`idSkipassTemp`);

--
-- Indici per le tabelle `skirun`
--
ALTER TABLE `skirun`
  ADD PRIMARY KEY (`idSkiRun`);

--
-- Indici per le tabelle `subscription`
--
ALTER TABLE `subscription`
  ADD PRIMARY KEY (`idSubscription`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `admin`
--
ALTER TABLE `admin`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `creditcard`
--
ALTER TABLE `creditcard`
  MODIFY `idCreditCard` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `image`
--
ALTER TABLE `image`
  MODIFY `idImage` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `insurance`
--
ALTER TABLE `insurance`
  MODIFY `idInsurance` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `insurancetemp`
--
ALTER TABLE `insurancetemp`
  MODIFY `idInsuranceTemp` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `liftstructure`
--
ALTER TABLE `liftstructure`
  MODIFY `idLiftStructure` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `payment`
--
ALTER TABLE `payment`
  MODIFY `idPayment` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT per la tabella `person`
--
ALTER TABLE `person`
  MODIFY `idUser` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `price`
--
ALTER TABLE `price`
  MODIFY `idPrice` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT per la tabella `skifacility`
--
ALTER TABLE `skifacility`
  MODIFY `idSkiFacility` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `skipassbooking`
--
ALTER TABLE `skipassbooking`
  MODIFY `idSkipassBooking` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT per la tabella `skipassobj`
--
ALTER TABLE `skipassobj`
  MODIFY `idSkipassObj` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `skipasstemp`
--
ALTER TABLE `skipasstemp`
  MODIFY `idSkipassTemp` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT per la tabella `skirun`
--
ALTER TABLE `skirun`
  MODIFY `idSkiRun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT per la tabella `subscription`
--
ALTER TABLE `subscription`
  MODIFY `idSubscription` int(3) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
