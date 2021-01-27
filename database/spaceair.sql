create database spaceair;

DROP USER IF EXISTS 'sc_space_user'@'localhost' ;
CREATE USER 'sc_space_user'@'localhost' IDENTIFIED BY 'HjdWASFE6cAwJ4nu';
GRANT SELECT, INSERT, UPDATE ON `spaceair`.* TO 'sc_space_user'@'localhost';

use spaceair;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Creato il: Gen 26, 2021 alle 18:39
-- Versione del server: 10.4.16-MariaDB
-- Versione PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spaceair`
--

DELIMITER $$
--
-- Procedure
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `hide_outdated_packets` ()  NO SQL
UPDATE PACKET
    SET Visible = 0
    WHERE CodPacket = ANY(
        SELECT P.CodPacket
        FROM PACKET P 
        WHERE P.DateTimeDeparture < NOW()
        )$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `remove_outdated_packets_in_cart` ()  NO SQL
UPDATE PACKET_IN_ORDER
    SET Quantity = 0
    WHERE CodPacket = ANY(
        SELECT P.CodPacket
        FROM PACKET P 
        WHERE P.DateTimeDeparture < NOW()
        ) && CodOrder = ANY(
            SELECT CodOrder
            FROM ORDERS
            WHERE State = 1
        )$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Struttura della tabella `ADDRESS`
--

CREATE TABLE `ADDRESS` (
  `CodAddress` int(11) NOT NULL,
  `Via` varchar(40) NOT NULL,
  `Civico` varchar(6) NOT NULL,
  `Citta` varchar(20) NOT NULL,
  `Provincia` varchar(20) NOT NULL,
  `Cap` varchar(10) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `Visible` tinyint(1) DEFAULT 1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ADDRESS`
--

INSERT INTO `ADDRESS` (`CodAddress`, `Via`, `Civico`, `Citta`, `Provincia`, `Cap`, `IdUser`) VALUES
(1, 'Puglie', '14', 'Cervia', 'RA', '48015', 2),
(2, 'Caduti', '150', 'Cervia', 'RA', '48015', 3),
(3, 'Tavolato', '1', 'Misano Adriatico', 'RN', '47843', 4),
(5, 'Monte Capone', '106/a', 'Carpegna', 'PU', '65898', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `INTEREST`
--

CREATE TABLE `INTEREST` (
  `Date` datetime NOT NULL,
  `IdUser` int(11) NOT NULL,
  `CodPlanet` int(11) NOT NULL,
  `Visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `INTEREST`
--

INSERT INTO `INTEREST` (`Date`, `IdUser`, `CodPlanet`, `Visible`) VALUES
('2021-01-25 22:18:53', 2, 1, 1),
('2021-01-26 18:14:32', 2, 3, 1),
('2021-01-26 18:15:31', 3, 2, 1),
('2021-01-26 18:34:36', 4, 2, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `ORDERS`
--

CREATE TABLE `ORDERS` (
  `CodOrder` int(11) NOT NULL,
  `PurchaseDate` datetime DEFAULT NULL,
  `Total` float DEFAULT NULL,
  `DestAddressCode` int(11) DEFAULT NULL,
  `State` int(11) NOT NULL,
  `IdUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ORDERS`
--

INSERT INTO `ORDERS` (`CodOrder`, `PurchaseDate`, `Total`, `DestAddressCode`, `State`, `IdUser`) VALUES
(29, '2021-01-25 22:16:52', 2000, 1, 4, 2),
(30, '2021-01-26 17:59:53', 4500, 1, 3, 2),
(31, NULL, NULL, NULL, 1, 2),
(32, '2021-01-26 18:16:17', 12000, 2, 2, 3),
(33, '2021-01-26 18:17:16', 7500, 2, 3, 3),
(34, '2021-01-26 18:24:03', 14500, 5, 4, 4),
(35, '2021-01-26 18:32:46', 30000, 3, 2, 4),
(36, NULL, NULL, NULL, 1, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `ORDER_STATE`
--

CREATE TABLE `ORDER_STATE` (
  `CodState` int(11) NOT NULL,
  `Description` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `ORDER_STATE`
--

INSERT INTO `ORDER_STATE` (`CodState`, `Description`) VALUES
(1, 'Carrello'),
(2, 'Preparazione'),
(3, 'In consegna'),
(4, 'Consegnato');

-- --------------------------------------------------------

--
-- Struttura della tabella `PACKET`
--

CREATE TABLE `PACKET` (
  `CodPacket` int(11) NOT NULL,
  `DateTimeDeparture` datetime NOT NULL,
  `DateTimeArrival` datetime NOT NULL,
  `Price` float NOT NULL,
  `MaxSeats` tinyint(4) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `CodPlanet` int(11) NOT NULL,
  `Visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `PACKET`
--

INSERT INTO `PACKET` (`CodPacket`, `DateTimeDeparture`, `DateTimeArrival`, `Price`, `MaxSeats`, `Description`, `CodPlanet`, `Visible`) VALUES
(17, '2021-02-08 21:40:00', '2021-02-14 21:40:00', 1000, 10, 'Un\'esperienza unica ti aspetta! Un viaggio dalla Terra alla Luna con viste mozzafiato. All\'arrivo ti aspetta un rinfresco su uno dei crateri più suggestivo di tutto il suolo lunare. Durante la permanenza saranno possibili anche escursioni nel \"lato buio\" del satellite!', 1, 1),
(18, '2021-04-01 10:30:00', '2021-01-25 21:45:00', 1500, 15, 'Un viaggio dalla Terra alla Luna con viste mozzafiato. All\'arrivo ti aspetta un rinfresco su uno dei crateri più suggestivo di tutto il suolo lunare. Durante la permanenza saranno possibili anche escursioni nel \"lato buio\" del satellite! ', 1, 1),
(19, '2021-03-10 03:45:00', '2021-04-08 21:45:00', 3500, 10, 'Un\'esperienza unica ti aspetta! Un viaggio dalla Terra a Marte, il pianeta rosso. All\'arrivo ti aspetta un rinfresco su uno dei crateri più suggestivo di tutto il suolo marziano. Durante la permanenza saranno possibili anche escursioni per visitare i resti dei Rover non più in funzione!', 2, 1),
(20, '2021-05-01 00:00:00', '2021-05-05 21:45:00', 1500, 15, 'Un viaggio dalla Terra a Marte, il pianeta rosso. All\'arrivo ti aspetta un rinfresco su uno dei crateri più suggestivo di tutto il suolo marziano. Durante la permanenza saranno possibili anche escursioni per visitare i resti dei Rover non più in funzione!     ', 2, 1),
(21, '2021-03-10 14:30:00', '2021-03-14 03:15:00', 7500, 5, 'Un\'esperienza unica ti aspetta! Un viaggio dalla Terra a Venere, l\'antica dea dell\'amore. Panorami eccezionali e lo spettacolo di avvicinarsi al sole.', 3, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `PACKET_IN_ORDER`
--

CREATE TABLE `PACKET_IN_ORDER` (
  `CodPacket` int(11) NOT NULL,
  `CodOrder` int(11) NOT NULL,
  `Quantity` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `PACKET_IN_ORDER`
--

INSERT INTO `PACKET_IN_ORDER` (`CodPacket`, `CodOrder`, `Quantity`) VALUES
(17, 29, 2),
(19, 30, 0),
(20, 30, 3),
(21, 30, 0),
(21, 31, 1),
(18, 32, 1),
(19, 32, 3),
(18, 33, 5),
(18, 34, 5),
(19, 34, 2),
(21, 35, 4),
(19, 36, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `PLANET`
--

CREATE TABLE `PLANET` (
  `CodPlanet` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Temperature` int(11) NOT NULL,
  `Mass` float NOT NULL,
  `Surface` float NOT NULL,
  `SunDistance` float NOT NULL,
  `Composition` varchar(10) NOT NULL,
  `DayLength` int(11) NOT NULL,
  `Img` varchar(100) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Visible` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `PLANET`
--

INSERT INTO `PLANET` (`CodPlanet`, `Name`, `Temperature`, `Mass`, `Surface`, `SunDistance`, `Composition`, `DayLength`, `Img`, `Description`, `Visible`) VALUES
(1, 'Luna', -23, 7, 38, 149.6, 'Solido', 648, 'moon.png', 'La Luna è un satellite naturale, l\'unico della Terra. Il suo nome proprio viene talvolta utilizzato, per antonomasia e con l\'iniziale minuscola («una luna»), come sinonimo di satellite anche per i corpi celesti che orbitano attorno ad altri pianeti.\r\nOrbita a una distanza media di circa 384400 km dalla Terra, sufficientemente vicina da essere osservabile a occhio nudo, così che sulla sua superficie è possibile distinguere delle macchie scure e delle macchie chiare. Le prime, dette mari, sono regioni quasi piatte coperte da rocce basaltiche e detriti di colore scuro. Le regioni lunari chiare, chiamate terre alte o altopiani, sono elevate di vari kilometri rispetto ai mari e presentano rilievi alti anche 8000-9000 metri. Essendo in rotazione sincrona rivolge sempre la stessa faccia verso la Terra e il suo lato nascosto è rimasto sconosciuto fino al periodo delle esplorazioni spaziali.', 1),
(2, 'Marte', -63, 63.9, 144.8, 228, 'Solido', 25, 'mars.png', 'Marte è il quarto pianeta del sistema solare in ordine di distanza dal Sole; è visibile a occhio nudo ed è l\'ultimo dei pianeti di tipo terrestre dopo Mercurio, Venere e la Terra. Chiamato pianeta rosso per via del suo colore caratteristico causato dalla grande quantità di ossido di ferro che lo ricopre, Marte prende il nome dall\'omonima divinità della mitologia romana e il suo simbolo astronomico è la rappresentazione stilizzata dello scudo e della lancia del dio.\r\nPur presentando temperature medie superficiali piuttosto basse (tra −120 e +20 °C) e un\'atmosfera molto rarefatta, è il pianeta più simile alla Terra tra quelli del sistema solare. Le sue dimensioni sono intermedie tra quelle del nostro pianeta e quelle della Luna, e ha l\'inclinazione dell\'asse di rotazione e la durata del giorno simili a quelle terrestri.', 1),
(3, 'Venere', 464, 486.7, 460, 108.7, 'Solido', 2802, 'venus.png', 'Venere è il secondo pianeta del Sistema solare in ordine di distanza dal Sole con un\'orbita quasi circolare che lo porta a compiere una rivoluzione in 224,7 giorni terrestri. Prende il nome dalla dea romana dell\'amore e della bellezza e il suo simbolo astronomico è la rappresentazione stilizzata della mano di Venere che sorregge uno specchio.\r\nCon una magnitudine massima di −4.6, è l\'oggetto naturale più luminoso nel cielo notturno dopo la Luna e per questo motivo è conosciuto fin dall\'antichità. Venere è visibile soltanto poco dopo il tramonto e poco prima dell\'alba e per questa ragione è spesso stato chiamato dagli antichi Greci (e poi dai Romani) stella della sera o stella del mattino. La scoperta che si tratta dello stesso oggetto sarebbe stata introdotta in occidente da Pitagora, ma sarebbe dovuta agli astronomi della Mesopotamia. Nella Tavoletta di Venere di Ammi-Saduqa, infatti, sono riportate osservazioni risalenti al 1550 a.C. o antecedenti, in cui non si fa distinzione fra l\'', 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `REVIEW`
--

CREATE TABLE `REVIEW` (
  `DateTime` datetime NOT NULL,
  `Title` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Rating` tinyint(4) NOT NULL,
  `IdUser` int(11) NOT NULL,
  `CodPlanet` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `REVIEW`
--

INSERT INTO `REVIEW` (`DateTime`, `Title`, `Description`, `Rating`, `IdUser`, `CodPlanet`) VALUES
('2021-01-25 21:52:39', 'Esperienza eccezionale', 'L\'esperienze più sensazionali della mia vita! Esplorare lo spazio è sempre stato il mio sogno e mettere piede sulla Luna non ha prezzo.', 5, 2, 1),
('2021-01-25 21:55:09', 'Un regalo fantastico', 'Sembrava di essere in un sogno, ed invece era realtà! Il viaggio che segna la vita!', 5, 2, 2),
('2021-01-25 21:56:16', 'Orribile, soffro di vertigini', 'Abbandonate l\'idea di questi viaggi se soffrite di vertigini. Lato positivo: le noccioline erano gratis.', 2, 3, 1),
('2021-01-25 21:56:54', 'Ottima vista', 'Alla vista dall\'oblo di Marte mi sono emozionata. Peccato che per i venti solari non siamo riusciti ad avvicinartci troppo. Consiglio il viaggio in giugno quando il periodo delle tempeste è terminato.', 3, 3, 2),
('2021-01-25 21:59:38', 'Servizio clienti al top', 'Il volo è partito con 15-20 minuti di ritardo, però abbiamo recuperato il tempo perso e siamo arrivati anche con 10 minuti di anticipo! Personale gentile e molto elegante, aereo molto pulito e volo tranquillo. Molto bello!', 4, 4, 1),
('2021-01-25 22:01:52', 'Buoni servizi', 'Il personale è sempre sorridente e disponibile per ogni richiesta.\nM&M\'s a forma di pianeti ottimi, i bimbi li hanno adorati', 4, 4, 2),
('2021-01-25 22:03:42', 'La migliore', 'Consigliatissima! Esperienza da provare almeno una volta nella vita.', 5, 4, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `TEMPLATE_NOTIFICATION`
--

CREATE TABLE `TEMPLATE_NOTIFICATION` (
  `CodNotification` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `Title` varchar(1000) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `CodPlanet` int(11) DEFAULT NULL,
  `CodPacket` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `TEMPLATE_NOTIFICATION`
--

INSERT INTO `TEMPLATE_NOTIFICATION` (`CodNotification`, `DateTime`, `Title`, `Description`, `Type`, `CodPlanet`, `CodPacket`) VALUES
(41, '2021-01-25 21:41:56', 'Nuovo pacchetto disponibile', 'Gentile utente, è ora disponibile un nuovo pacchetto verso Luna!', 1, NULL, 17),
(42, '2021-01-25 21:43:18', 'Nuovo pacchetto disponibile', 'Gentile utente, è ora disponibile un nuovo pacchetto verso Luna!', 1, NULL, 18),
(43, '2021-01-25 21:44:44', 'Nuovo pacchetto disponibile', 'Gentile utente, è ora disponibile un nuovo pacchetto verso Marte!', 1, NULL, 19),
(44, '2021-01-25 21:46:07', 'Nuovo pacchetto disponibile', 'Gentile utente, è ora disponibile un nuovo pacchetto verso Marte!', 1, NULL, 20),
(45, '2021-01-25 21:49:20', 'Nuovo pacchetto disponibile', 'Gentile utente, è ora disponibile un nuovo pacchetto verso Venere!', 1, NULL, 21),
(46, '2021-01-25 22:16:52', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso Luna per un totale di €2000', 0, NULL, NULL),
(47, '2021-01-25 22:16:52', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso Luna per un totale di €2000', 0, NULL, NULL),
(48, '2021-01-26 17:55:19', 'Aggiornamento Tracking', 'Il tuo ordine contenente Luna del 08/02/2021,  è partito!', 0, NULL, NULL),
(49, '2021-01-26 17:58:40', 'Aggiornamento Tracking', 'Il tuo ordine contenente Luna del 08/02/2021,  è stato consegnato! Goditi il viaggio!', 0, NULL, NULL),
(50, '2021-01-26 17:59:53', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso Marte per un totale di €4500', 0, NULL, NULL),
(51, '2021-01-26 17:59:53', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso Marte per un totale di €4500', 0, NULL, NULL),
(52, '2021-01-26 18:06:01', 'Aggiornamento Tracking', 'Il tuo ordine contenente Marte del 01/05/2021,  è partito!', 0, NULL, NULL),
(53, '2021-01-26 18:16:17', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso LunaViaggio verso Marte per un totale di €12000', 0, NULL, NULL),
(54, '2021-01-26 18:16:17', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso LunaViaggio verso Marte per un totale di €12000', 0, NULL, NULL),
(55, '2021-01-26 18:17:16', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso Luna per un totale di €7500', 0, NULL, NULL),
(56, '2021-01-26 18:17:16', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso Luna per un totale di €7500', 0, NULL, NULL),
(57, '2021-01-26 18:20:14', 'Aggiornamento Tracking', 'Il tuo ordine contenente Luna del 01/04/2021,  è partito!', 0, NULL, NULL),
(58, '2021-01-26 18:24:03', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso LunaViaggio verso Marte per un totale di €14500', 0, NULL, NULL),
(59, '2021-01-26 18:24:03', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso LunaViaggio verso Marte per un totale di €14500', 0, NULL, NULL),
(60, '2021-01-26 18:24:57', 'Aggiornamento Tracking', 'Il tuo ordine contenente Marte del 10/03/2021, Luna del 01/04/2021,  è partito!', 0, NULL, NULL),
(62, '2021-01-26 18:31:14', 'Aggiornamento Tracking', 'Il tuo ordine contenente Marte del 10/03/2021, Luna del 01/04/2021,  è stato consegnato! Goditi il viaggio!', 0, NULL, NULL),
(63, '2021-01-26 18:32:46', 'Acqusto effettuato', 'Hai acquistato i seguenti pacchetti Viaggio verso Venere per un totale di €30000', 0, NULL, NULL),
(64, '2021-01-26 18:32:46', 'Nuovo ordine evaso', 'Sono stati acquistati i seguenti pacchetti Viaggio verso Venere per un totale di €30000', 0, NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `TRACK`
--

CREATE TABLE `TRACK` (
  `CodOrder` int(11) NOT NULL,
  `DateTime` datetime NOT NULL,
  `City` varchar(100) NOT NULL,
  `Description` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `TRACK`
--

INSERT INTO `TRACK` (`CodOrder`, `DateTime`, `City`, `Description`) VALUES
(29, '2021-01-26 17:55:19', 'Milano', 'Il pacco ha lasciato la sede e arriverà a destinazione nel minor tempo possibile'),
(29, '2021-01-26 17:56:20', 'Bologna', 'Il pacco è nella stazione di Bologna'),
(29, '2021-01-26 17:57:44', 'Ravenna', 'In elaborazione presso lo stabilimento ACME S.r.l.'),
(29, '2021-01-26 17:58:40', 'Cervia', 'Il pacco è stato consegnato sul pianerottolo'),
(30, '2021-01-26 18:06:01', 'Milano', 'Il pacco ha lasciato la sede e arriverà a destinazione nel minor tempo possibile'),
(33, '2021-01-26 18:20:14', 'Bologna', 'Il pacco è nella stazione di Bologna'),
(34, '2021-01-26 18:24:56', 'Milano', 'Il pacco ha lasciato la sede e arriverà a destinazione nel minor tempo possibile'),
(34, '2021-01-26 18:30:58', 'Bologna', 'Il pacco è nella stazione di Bologna'),
(34, '2021-01-26 18:31:14', 'Carpegna', 'Il pacco è stato consegnato sul pianerottolo');

-- --------------------------------------------------------

--
-- Struttura della tabella `USERS`
--

CREATE TABLE `USERS` (
  `IdUser` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Surname` varchar(20) NOT NULL,
  `Borndate` date NOT NULL,
  `Phone` char(10) NOT NULL,
  `ProfileImg` varchar(100) NOT NULL,
  `Mail` varchar(50) NOT NULL,
  `Password` char(128) NOT NULL,
  `Salt` char(128) NOT NULL,
  `Type` tinyint(4) NOT NULL,
  `PartitaIva` char(11) DEFAULT NULL,
  `Newsletter` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `USERS`
--

INSERT INTO `USERS` (`IdUser`, `Name`, `Surname`, `Borndate`, `Phone`, `ProfileImg`, `Mail`, `Password`, `Salt`, `Type`, `PartitaIva`, `Newsletter`) VALUES
(1, 'Admin', 'Admin', '1999-07-17', '3334456789', 'user.png', 'admin@spaceair.it', 'aa38e64b61fdfb3d0d587621aa8211368cb9ba2819feb6c65a55c41f05eaf4322699bc703125be0dff18ad24befe3293d7ecff31407bb5c90a7a4f5a946e153d', '5ce2d31eb270c670abacfba645024daca300f5ca5d35390a20e07cd27a802081f4219c7041ff8e8f77cccae74fad8a6472ffa76e55a54f03c4c581551559d257', 1, '0764352056C', 0),
(2, 'Alessio', 'Conti', '1999-02-03', '', 'alessio.jpeg', 'alessio@spaceair.it', '9422b3f58eb8c52d51e34e61cc03dc014670c8a7b1a6f9cdc6e372790462e4a99ee620296abc60930f54493de76a86a7ddb9a049f9d98f18f2770fb7a7246375', '84e0c975b53c8ad994ccd11bf029ca4e144149d55b838e3de918e33b2723d6df2d803ce50346603e493216a33903c5374e90aab70937fea6329175f8e1b6e379', 2, NULL, 1),
(3, 'Simone', 'Ceredi', '1999-01-12', '', 'simone.jpeg', 'simone@spaceair.it', '9294e06b19e062abecf9bec105d3d0789bf2a944dfd0ad6be601727bd6b0a5bc7d2fd27941613fb45ac085fa3b39e40c2fd898c24749f739e34bc62f996f8053', '9da661118944317f550b2b6e3fcdd4802069aab3bd612b7febfe8412ef54e3318dc9b1c7c869705e2bbbb4eaae75655b0d7089b28d2df8d9ccdcf0568d1a5c80', 2, NULL, 1),
(4, 'Andrea', 'Giulianelli', '1999-01-01', '', 'andrea.jpeg', 'andrea@spaceair.it', '423c8eda289a47527a306b28b76e44112f3f77c3b2ef874fec5057a9fb59a43d4544379a648b7510a4239b2393d71fbd6bdc3666b16dcf676100103983d9dcc7', 'c71c3948bdefd1a7d091c129160a123e57ce965ee4291693770990eb86bd3fdbe02843a9046adef38094faa7d09a015312f680e85b4c7f8982fc3a83394fd3c9', 2, NULL, 1);


-- --------------------------------------------------------

--
-- Struttura della tabella `USER_NOTIFICATION`
--

CREATE TABLE `USER_NOTIFICATION` (
  `IdUser` int(11) NOT NULL,
  `View` tinyint(4) NOT NULL,
  `CodNotification` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `USER_NOTIFICATION`
--

INSERT INTO `USER_NOTIFICATION` (`IdUser`, `View`, `CodNotification`) VALUES
(1, 1, 47),
(1, 0, 51),
(1, 0, 54),
(1, 0, 56),
(1, 0, 59),
(1, 1, 64),
(2, 1, 41),
(2, 1, 42),
(2, 1, 43),
(2, 1, 44),
(2, 1, 45),
(2, 1, 46),
(2, 1, 48),
(2, 1, 49),
(2, 1, 50),
(2, 0, 52),
(3, 0, 41),
(3, 1, 42),
(3, 1, 43),
(3, 1, 44),
(3, 1, 45),
(3, 1, 53),
(3, 0, 55),
(3, 0, 57),
(4, 1, 41),
(4, 1, 42),
(4, 1, 43),
(4, 1, 44),
(4, 1, 45),
(4, 1, 58),
(4, 1, 60),
(4, 0, 62),
(4, 0, 63);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `ADDRESS`
--
ALTER TABLE `ADDRESS`
  ADD PRIMARY KEY (`CodAddress`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indici per le tabelle `INTEREST`
--
ALTER TABLE `INTEREST`
  ADD PRIMARY KEY (`IdUser`,`CodPlanet`),
  ADD KEY `CodPlanet` (`CodPlanet`);

--
-- Indici per le tabelle `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD PRIMARY KEY (`CodOrder`),
  ADD KEY `DestAddressCode` (`DestAddressCode`),
  ADD KEY `State` (`State`),
  ADD KEY `IdUser` (`IdUser`);

--
-- Indici per le tabelle `ORDER_STATE`
--
ALTER TABLE `ORDER_STATE`
  ADD PRIMARY KEY (`CodState`);

--
-- Indici per le tabelle `PACKET`
--
ALTER TABLE `PACKET`
  ADD PRIMARY KEY (`CodPacket`),
  ADD KEY `CodPlanet` (`CodPlanet`);

--
-- Indici per le tabelle `PACKET_IN_ORDER`
--
ALTER TABLE `PACKET_IN_ORDER`
  ADD PRIMARY KEY (`CodOrder`,`CodPacket`),
  ADD KEY `CodPacket` (`CodPacket`);

--
-- Indici per le tabelle `PLANET`
--
ALTER TABLE `PLANET`
  ADD PRIMARY KEY (`CodPlanet`);

--
-- Indici per le tabelle `REVIEW`
--
ALTER TABLE `REVIEW`
  ADD PRIMARY KEY (`IdUser`,`CodPlanet`),
  ADD KEY `CodPlanet` (`CodPlanet`);

--
-- Indici per le tabelle `TEMPLATE_NOTIFICATION`
--
ALTER TABLE `TEMPLATE_NOTIFICATION`
  ADD PRIMARY KEY (`CodNotification`),
  ADD KEY `CodPacket` (`CodPacket`),
  ADD KEY `CodPlanet` (`CodPlanet`);

--
-- Indici per le tabelle `TRACK`
--
ALTER TABLE `TRACK`
  ADD PRIMARY KEY (`CodOrder`,`DateTime`);

--
-- Indici per le tabelle `USERS`
--
ALTER TABLE `USERS`
  ADD PRIMARY KEY (`IdUser`),
  ADD UNIQUE KEY `Mail` (`Mail`);

--
-- Indici per le tabelle `USER_NOTIFICATION`
--
ALTER TABLE `USER_NOTIFICATION`
  ADD PRIMARY KEY (`IdUser`,`CodNotification`),
  ADD KEY `CodNotification` (`CodNotification`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `ADDRESS`
--
ALTER TABLE `ADDRESS`
  MODIFY `CodAddress` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT per la tabella `ORDERS`
--
ALTER TABLE `ORDERS`
  MODIFY `CodOrder` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT per la tabella `ORDER_STATE`
--
ALTER TABLE `ORDER_STATE`
  MODIFY `CodState` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `PACKET`
--
ALTER TABLE `PACKET`
  MODIFY `CodPacket` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT per la tabella `PLANET`
--
ALTER TABLE `PLANET`
  MODIFY `CodPlanet` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT per la tabella `TEMPLATE_NOTIFICATION`
--
ALTER TABLE `TEMPLATE_NOTIFICATION`
  MODIFY `CodNotification` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;

--
-- AUTO_INCREMENT per la tabella `USERS`
--
ALTER TABLE `USERS`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ADDRESS`
--
ALTER TABLE `ADDRESS`
  ADD CONSTRAINT `address_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `USERS` (`IdUser`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `INTEREST`
--
ALTER TABLE `INTEREST`
  ADD CONSTRAINT `interest_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `USERS` (`IdUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `interest_ibfk_2` FOREIGN KEY (`CodPlanet`) REFERENCES `PLANET` (`CodPlanet`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `ORDERS`
--
ALTER TABLE `ORDERS`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`DestAddressCode`) REFERENCES `ADDRESS` (`CodAddress`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_2` FOREIGN KEY (`State`) REFERENCES `ORDER_STATE` (`CodState`) ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_ibfk_3` FOREIGN KEY (`IdUser`) REFERENCES `USERS` (`IdUser`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `PACKET`
--
ALTER TABLE `PACKET`
  ADD CONSTRAINT `packet_ibfk_1` FOREIGN KEY (`CodPlanet`) REFERENCES `PLANET` (`CodPlanet`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `PACKET_IN_ORDER`
--
ALTER TABLE `PACKET_IN_ORDER`
  ADD CONSTRAINT `packet_in_order_ibfk_1` FOREIGN KEY (`CodOrder`) REFERENCES `ORDERS` (`CodOrder`) ON UPDATE CASCADE,
  ADD CONSTRAINT `packet_in_order_ibfk_2` FOREIGN KEY (`CodPacket`) REFERENCES `PACKET` (`CodPacket`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `REVIEW`
--
ALTER TABLE `REVIEW`
  ADD CONSTRAINT `review_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `USERS` (`IdUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `review_ibfk_2` FOREIGN KEY (`CodPlanet`) REFERENCES `PLANET` (`CodPlanet`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `TEMPLATE_NOTIFICATION`
--
ALTER TABLE `TEMPLATE_NOTIFICATION`
  ADD CONSTRAINT `template_notification_ibfk_1` FOREIGN KEY (`CodPacket`) REFERENCES `PACKET` (`CodPacket`) ON UPDATE CASCADE,
  ADD CONSTRAINT `template_notification_ibfk_2` FOREIGN KEY (`CodPlanet`) REFERENCES `PLANET` (`CodPlanet`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `TRACK`
--
ALTER TABLE `TRACK`
  ADD CONSTRAINT `track_ibfk_1` FOREIGN KEY (`CodOrder`) REFERENCES `ORDERS` (`CodOrder`) ON UPDATE CASCADE;

--
-- Limiti per la tabella `USER_NOTIFICATION`
--
ALTER TABLE `USER_NOTIFICATION`
  ADD CONSTRAINT `user_notification_ibfk_1` FOREIGN KEY (`IdUser`) REFERENCES `USERS` (`IdUser`) ON UPDATE CASCADE,
  ADD CONSTRAINT `user_notification_ibfk_2` FOREIGN KEY (`CodNotification`) REFERENCES `TEMPLATE_NOTIFICATION` (`CodNotification`) ON UPDATE CASCADE;

DELIMITER $$
--
-- Eventi
--
CREATE DEFINER=`root`@`localhost` EVENT `outdated_cart_contol` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-01-25 17:32:08' ON COMPLETION NOT PRESERVE ENABLE DO CALL remove_outdated_packets_in_cart()$$

CREATE DEFINER=`root`@`localhost` EVENT `outdated_packet_contol` ON SCHEDULE EVERY 1 MINUTE STARTS '2021-01-25 17:16:26' ON COMPLETION NOT PRESERVE ENABLE DO CALL hide_outdated_packets()$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


CREATE TABLE `LOGIN_ATTEMPTS` (
   `IdUser` INT(11) NOT NULL,
   `Time` VARCHAR(30) NOT NULL,
   foreign key(IdUser) references USERS(IdUser)
         on delete restrict
         on update cascade
);