-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2024 at 04:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eventdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendees`
--

CREATE TABLE `attendees` (
  `id` int(11) NOT NULL,
  `student_number` text NOT NULL,
  `payment` int(255) NOT NULL,
  `event_id` int(255) NOT NULL,
  `time_in` time NOT NULL,
  `time_out` time DEFAULT NULL,
  `time_attended` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_info`
--

CREATE TABLE `event_info` (
  `event_id` int(11) NOT NULL,
  `event_name` varchar(50) NOT NULL,
  `event_description` text NOT NULL,
  `event_type` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `registration_fee` float NOT NULL,
  `venue` text NOT NULL,
  `oic` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_info`
--

CREATE TABLE `student_info` (
  `id` text NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `middle_initial` varchar(10) NOT NULL,
  `student_number` text NOT NULL,
  `program` varchar(255) NOT NULL,
  `current_year` varchar(5) NOT NULL,
  `ue_email` text NOT NULL,
  `contact_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_info`
--

INSERT INTO `student_info` (`id`, `first_name`, `last_name`, `middle_initial`, `student_number`, `program`, `current_year`, `ue_email`, `contact_number`) VALUES
('20230122028', 'David', 'Miranda', '', '49fa714d', '', '', 'miranda.davidjoseph@ue.edu.ph', ''),
('20230108426', 'Joezer', 'Cornita', '', '90da0bcc', '', '', 'cornita.joezer@ue.edu.ph', ''),
('20230145150', 'Mc Jade Roger', 'Ebueza', '', '4cc535fb', '', '', 'ebueza.mcjaderoger@ue.edu.ph', ''),
('20190154768', 'Patrick', 'Yacat', '', '1dff6238', '', '', 'yacat.patrick@ue.edu.ph', ''),
('20190163714', 'Daryl', 'Montes', '', 'd250e7cc', '', '', 'MONTES.DARYLJAY@UE.EDU.PH', ''),
('20210132302', 'Rolly boy', 'Pilapil', '', '84632ae6', '', '', 'pilapil.rollyboy@ue.edu.ph', ''),
('20190148062', 'Joseph', 'Baslag', '', '509a7d8d', '', '', 'baslag.joseph@ue.edu.ph', ''),
('20200102109', 'Josh', 'Pineda', '', '04b32dde', '', '', 'pineda.joshderence@ue.edu.ph', ''),
('20210113454', 'Francesca', 'Borbon', '', 'd75e6fc6', '', '', 'borbon.francesca@ue.edu.ph', ''),
('20210111743', 'Ryan Joshua', 'Cruz', '', '26f5a81c', '', '', 'cruz.ryanjoshua@ue.edu.ph', ''),
('20200118667', 'Timothy Jorge', 'Sumigcay', '', 'f5c1d0a0', '', '', 'sumigcay.timothyjorge@ue.edu.ph', ''),
('20150113670', 'Zejirah Gavin', 'Gregorio', '', '185bc74f', '', '', 'gregorio.zejirahgavin@ue.edu.ph', ''),
('20220112890', 'Janfreitz', 'Supnet', '', '782e7aa9', '', '', 'supnet.janfreitz@ue.edu.ph', ''),
('20220127720', 'JAMES', 'BUELA', '', '79d0c217', '', '', 'buela.jamesvictor@ue.edu.ph', ''),
('20180153382', 'Anton Jeremy', 'Mojana', '', '5fc9c797', '', '', 'mojana.antonjeremy@ue.edu.ph', ''),
('20180146116', 'Christ Gabriel', 'Guardo', '', '8aaee4c4', '', '', 'guardo.christgabriel@ue.edu.ph', ''),
('20170130957', 'Lawrenz Dan', 'Capili', '', '71eb6d6b', '', '', 'capili.lawrenzdan@ue.edu.ph', ''),
('20140143426', 'Angelo Ian Miguel', 'Daniel', '', '041443fd', '', '', 'daniel.angeloianmiguel@ue.edu.ph', ''),
('20190140068', 'Jedh Carlo', 'Villarosa', '', '69e3becc', '', '', 'villarosa.jedhcarlo@ue.edu.ph', ''),
('20230114053', 'marc gregory', 'marquez', '', 'aa631a99', '', '', 'marquez.marcgregory@ue.edu.ph', ''),
('20230129154', 'Sean Harvey', 'De Leon', '', '50ac13d8', '', '', 'deleon.seanharvey@ue.edu.ph', ''),
('20200132407', 'Jayson', 'Gopio', '', '76482f0c', '', '', 'gopio.jayson@ue.edu.ph', ''),
('20230137390', 'RAIKO JOAQUIN VICTOR', 'AGATEP', '', '28b9e89e', '', '', 'agatep.raikojoaquinvictor@ue.edu.ph', ''),
('20190163429', 'Jasmine Sophia', 'Lapidario', '', 'd7667c38', '', '', 'lapidario.jasminesophia@ue.edu.ph', ''),
('20230149243', 'Marianne Deirra', 'Tayhopon', '', '780dbf08', '', '', 'tayhopon.mariannedeirra@ue.edu.ph', ''),
('20220144581', 'Shawn Filbert', 'Bueno', '', '7b751920', '', '', 'bueno.shawnfilbert@ue.edu.ph', ''),
('20190170935', 'Cyrus', 'Berosil II', '', 'f8200df1', '', '', 'berosilii.cyrus@ue.edu.ph', ''),
('20230130582', 'Beatrice Gillianne', 'Dueñas', '', '52be7375', '', '', 'Duenas.beatricegillianne@ue.edu.ph', ''),
('20180144836', 'Gimeno Franz', 'De los Reyes', '', '450c0aa4', '', '', 'delosreyes.gimenofranz@ue.edu.ph', ''),
('20220119119', 'BRYAN', 'CRUZADO', '', 'd06cf4b4', '', '', 'cruzado.bryan@ue.edu.ph', ''),
('20230127783', 'Franco Iñigo', 'Ramos', '', 'bee3f6e3', '', '', 'ramos.francoinigo@ue.edu.ph', ''),
('20230145343', 'Sean Andre Benedict', 'Chacon', '', '8d1c9884', '', '', 'chacon.seanandrebenedict@ue.edu.ph', ''),
('20220134714', 'John Angelo', 'Dela Cruz', '', '46133219', '', '', 'delacruz.johnangelo@ue.edu.ph', ''),
('20230131110', 'James Cedrick', 'Decena', '', 'b26b2870', '', '', 'decena.jamescedrick@ue.edu.ph', ''),
('20230141487', 'Galadrielle', 'Cruz', '', '76a7da2b', '', '', 'cruz.galadrielle@ue.edu.ph', ''),
('2023015210', 'Marie Fe', 'Pronebo', '', '03e1ec97', '', '', 'pronebo.mariefe@ue.edu.ph', ''),
('20220120945', 'Ryan Ken', 'Casem', '', 'aeee2921', '', '', 'casem.ryanken@ue.edu.ph', ''),
('20230135792', 'Reiyaen', 'Berango', '', '9c6fd208', '', '', 'berango.reiyaenlouisse@ue.edu.ph', ''),
('20220200408', 'John Ernest', 'Japson', '', 'cfb5d9ce', '', '', 'japson.johnernest@ue.edu.ph', ''),
('20230114100', 'Keane Nedd', 'Cregencia', '', 'f4d34ec7', '', '', 'cregencia.keanenedd@ue.edu.ph', ''),
('20220112583', 'Benjie', 'Asumen', '', '3e77dfca', '', '', 'asumen.benjie@ue.edu.ph', ''),
('20230130617', 'CharlesLawrence', 'Cruz', '', '07a8335d', '', '', 'CRUZ.CHARLESLAWRENCE@UE.EDU.PH', ''),
('20180108218', 'Wenn Marc Jeone', 'De Villa', '', '90326e47', '', '', 'devillla.wennmarcjeone@ue.edu.ph', ''),
('20230143869', 'JOHN NATHANIEL', 'BACCAY', '', 'e5d9b52f', '', '', 'BACCAY.JOHNNATHANIEL@UE.EDU.PH', ''),
('20230141374', 'Angel Grace', 'Ramirez', '', '262ce39b', '', '', 'ramirez.angelgrace@ue.edu.ph', ''),
('20210106120', 'Neil Francis', 'Teresa', '', '06aa0440', '', '', 'teresa.neilfrancis@ue.edu.ph', ''),
('20190115549', 'Alvin Dale', 'Soliven', '', 'ba4e0450', '', '', 'soliven.alvindale@ue.edu.ph', ''),
('20230134697', 'Heart Gia', 'Santos', '', '0aeecdab', '', '', 'santos.heartgia@ue.edu.ph', ''),
('20230117767', 'alexandria', 'borbe', '', 'b0123f78', '', '', 'borbe.alexandria@ue.edu.ph', ''),
('20140114892', 'Jhon Toffe', 'Bulaybulay', '', 'a0c8e16b', '', '', 'bulaybulay.jhontoffe@ue.edu.ph', ''),
('20230127681', 'Sebastian', 'Estacio', '', '4652ae6d', '', '', 'estacio.sebastian@ue.edu.ph', ''),
('20230139829', 'CLAUDE DAVE', 'VERGARA', '', '577c7314', '', '', 'vergara.claudedave@ue.edu.ph', ''),
('20230148002', 'Thimothy Jace', 'Javier', '', 'bd995bb0', '', '', 'javier.thimothyjace@ue.edu.ph', ''),
('20190163156', 'JOEMHEL JHON', 'CORAL', '', 'acd92c1c', '', '', 'coral.joemheljhon@ue.edu.ph', ''),
('20190128622', 'Miguel Joaquin', 'Carpio', '', 'f506c0f9', '', '', 'carpio.migueljoaquin@ue.edu.ph', ''),
('20210126775', 'REYNALDO III', 'CASTILLO', '', '978765a9', '', '', 'castillo.reynaldoiii@ue.edu.ph', ''),
('20200120098', 'AMADEUS JOHN', 'JUNSAY', '', '5769cf68', '', '', 'JUNSAY.AMADEUSJOHN@UE.EDU.PH', ''),
('20170115216', 'Tom Jeffrev', 'Janolo', '', '859e279d', '', '', 'janolo.tomjeffrev@ue.edu.ph', ''),
('20140105915', 'Norwyn Isaiah', 'Yumul', '', '2a9942fa', '', '', 'yumul.norwynisaiah@ue.edu.ph', ''),
('20230137709', 'Marcus Zuey', 'Miranda', '', 'e136f0ee', '', '', 'miranda.marcuszuey@ue.edu.ph', ''),
('20220145459', 'Axle', 'Jimenez', '', 'd4d56793', '', '', 'jimenez.axleglenn@ue.edu.ph', ''),
('20220122509', 'Earl Jim', 'Correa', '', '8904cdde', '', '', 'correa.earljim@ue.edu.ph', ''),
('20220132821', 'Marielle Ysabela', 'Regaspe', '', '450260c1', '', '', 'regaspe.marielleysabela@ue.edu.ph', ''),
('20220126556', 'Sean Vincent Vien', 'Viñas', '', '54f3970a', '', '', 'vinas.seanvincentvien@ue.edu.ph', ''),
('20200113402', 'Joshua', 'Manuel', '', '18e4d6d0', '', '', 'manuel.joshua@ue.edu.ph', ''),
('20200114052', 'Miguel Ivan', 'De Guzman', '', 'de4cd959', '', '', 'deguzman.miguelivan@ue.edu.ph', ''),
('20230129892', 'MICAH NIRVANA', 'RICALDE', '', '24ff3b75', '', '', 'RICALDE.MICAHNIRVANA@UE.EDU.PH', ''),
('20200121717', 'Vanessa', 'Leoperio', '', 'c252f128', '', '', 'leoperio.vanessa@ue.edu.ph', ''),
('20230115738', 'Angel', 'Repato', '', '307d63c3', '', '', 'repato.angel@ue.edu.ph', ''),
('20220116621', 'John Carlo', 'Salamanca', '', 'fc5169f8', '', '', 'SALAMANCA.JOHNCARLO@UE.EDU.PH', ''),
('20191115363', 'MARK GERARD', 'SANGAN', '', 'f58e8159', '', '', 'sangan.markgerard@ue.edu.ph', ''),
('20210200569', 'John Paul', 'Asadon', '', '483f9c57', '', '', 'asadon.johnpaul@ue.edu.ph', ''),
('20220110190', 'Angel', 'Egaran', '', '75d6bee6', '', '', 'egaran.maryangel@ue.edu.ph', ''),
('20210108568', 'John Paul', 'Pascual', '', '3ddb91f1', '', '', 'pascual.johnpaul@ue.edu.ph', ''),
('20180120983', 'Gene Reneil', 'Campillos', '', 'dab76657', '', '', 'campillos.genereneil@ue.edu.ph', ''),
('20180151375', 'Kent Joshua', 'Landicho', '', 'e1ee0caf', '', '', 'landicho.kentjoshua@ue.edu.ph', ''),
('20120114876', 'Michael Angelo', 'Samonte', '', '350e13fa', '', '', 'samonte.michaelangelo@ue.edu.ph', ''),
('20160148243', 'MARON', 'MAURICIO', '', 'b2d383d2', '', '', 'mauricio.maron@ue.edu.ph', ''),
('20200104309', 'Paolo', 'Barrado', '', '2e0ac2f0', '', '', 'barrado.paolo@ue.edu.ph', ''),
('20220122963', 'Sam Daniel', 'Garcia', '', 'ad281f2e', '', '', 'garcia.samdaniel@ue.edu.ph', ''),
('20230104720', 'Cris abcde', 'Cristobal', '', 'fe9bfc2a', '', '', 'cristobal.crisabcde@ue.edu.ph', ''),
('20210111925', 'Jacob', 'Bautista', '', 'cd587a9d', '', '', 'bautista.jacob@ue.edu.ph', ''),
('20230135372', 'Milric cloud', 'Santos', '', '27ddd892', '', '', 'santos.milriccloud@ue.edu.ph', ''),
('20220108849', 'Mark Martin', 'Mercado', '', '2cb50c21', '', '', 'mercado.markmartin@ue.edu.ph', ''),
('20220136710', 'Kian Carlos', 'De Jesus', '', '5d1f8d02', '', '', 'dejesus.kiancarlos@ue.edu.ph', ''),
('20190171610', 'Angela', 'De Asas', '', '73cbdae4', '', '', 'deasas.angela@ue.edu.ph', ''),
('20200104774', 'Marc Anthony', 'Dela Cruz', '', '35d12b34', '', '', 'delacruz.marcanthony@ue.edu.ph', ''),
('20230126268', 'NASH', 'LUCES', '', '4cbe4747', '', '', 'luces.nash@ue.edu.ph', ''),
('20230138804', 'John emmanuel', 'Secuban', '', 'b05d54ee', '', '', 'secuban.johnemmanuel@ue.edu.ph', ''),
('20190134895', 'John Gabriel', 'Namoro', '', '3a4b05ee', '', '', 'namoro.johngabriel@ue.edu.ph', ''),
('20220120321', 'Nathan Aaron', 'Monasterial', '', '9b919611', '', '', 'monasterial.nathanaaron@ue.edu.ph', ''),
('20180171157', 'Summer Jane', 'Palomo', '', 'f59fe609', '', '', 'palomo.summerjane@ue.edu.ph', ''),
('20200110389', 'Joshua Claude', 'Florentin', '', 'ce307f7b', '', '', 'florentin.joshuaclaude@ue.edu.ph', ''),
('20220131373', 'VHINZ', 'INTAL', '', '20ba90e6', '', '', 'intal.vhinzaaron@ue.edu.ph', ''),
('20190143205', 'CLARIZZA', 'REYES', '', '24cd1f92', '', '', 'REYES.CLARIZZA@UE.EDU.PH', ''),
('20200114814', 'Marvin', 'Cayosa', '', 'f4ae51b2', '', '', 'cayosa.marvin@ue.edu.ph', ''),
('20210133032', 'Lord Jerome', 'Araullo', '', '9e423f34', '', '', 'araullo.lordjerome@ue.edu.ph', ''),
('20220137860', 'SKHART AYE', 'MERCADO', '', '13f127be', '', '', 'mercado.skhartaye@ue.edu.ph', ''),
('20210124393', 'Neil Alexis', 'Perez', '', 'd14529ae', '', '', 'perez.neilalexis@ue.edu.ph', ''),
('20190130382', 'Kurt', 'Mendaje', '', '8dc6608d', '', '', 'mendaje.kurtjohn@ue.edu.ph', ''),
('20180123095', 'Shaira', 'Pagaduan', '', '6445f4d0', '', '', 'pagaduan.ladyshairamae@ue.edu.ph', ''),
('20220109079', 'Chrisha', 'Ledesma', '', '71ddeb08', '', '', 'ledesma.chrisha@ue.edu.ph', ''),
('20150116964', 'Adrian', 'Danao', '', '7aa04be9', '', '', 'danao.adrian@ue.edu.ph', ''),
('20220126227', 'ALLIYA BERNADETTE', 'VIRTUCIO', '', '7c14db9e', '', '', 'virtucio.alliyabernadette@ue.edu.ph', ''),
('20210103369', 'JOAQUIN', 'ABELARDO', '', '63f43eba', '', '', 'abelardo.joaquinkester@ue.edu.ph', ''),
('20200200040', 'JESSIE KIRK', 'RECIO', '', 'c9ce68a4', '', '', 'recio.jessiekirk@ue.edu.ph', ''),
('S20230131723', 'Ransen', 'Mercado', '', '523e29d4', '', '', 'mercado.ransen@ue.edu.ph', ''),
('20210101329', 'Shaun Paul Alexis', 'Mistula', '', 'a3ec85b9', '', '', 'mistula.shaunpaulalexis@ue.edu.ph', ''),
('20200113253', 'ANDRE DOMINIC', 'LACRA', '', '05afed07', '', '', 'lacra.andredominic@ue.edu.ph', ''),
('20210116715', 'Io Ven Josef', 'Decena', '', '6da7f1bd', '', '', 'decena.iovenjosef@ue.edu.ph', ''),
('20230141329', 'Kathlen Mae', 'Merindo', '', '22e31464', '', '', 'merindo.kathlenmae@ue.edu.ph', ''),
('20220129099', 'Khristine Ann Nicole', 'De Guzman', '', '737dc3d7', '', '', 'deguzman.khristineannnicole@ue.edu.ph', ''),
('20200120123', 'DYLANN', 'ESTEBAN', '', '82b855aa', '', '', 'esteban.dylann@ue.edu.ph', ''),
('20180157088', 'Andre Francis', 'Palillo', '', '68f4703e', '', '', 'palillo.andrefrancis@ue.edu.ph', ''),
('20170143381', 'Christian Rei', 'Martinez', '', 'fc8e203d', '', '', 'martinez.christianrei@ue.edu.ph', ''),
('20210111798', 'Edward Jeshua', 'Leonardo', '', '1a8aab5a', '', '', 'leonardo.edwardjeshua@ue.edu.ph', ''),
('20190123241', 'Joshua', 'Fajardo', '', 'acd65df8', '', '', 'fajardo.joshua@ue.edu.ph', ''),
('20200112603', 'Alerie Anne', 'Dionisio', '', '9235cc86', '', '', 'dionisio.alerieanne@ue.edu.ph', ''),
('20210114866', 'CHRISTINE', 'GOLINGAY', '', '02994587', '', '', 'golingay.christine@ue.edu.ph', ''),
('20140152961', 'Jude Ashley', 'Abuan', '', 'ecf961c5', '', '', 'abuan.judeashley@ue.edu.ph', ''),
('20190171358', 'Alexander', 'Castro', '', '8c619f36', '', '', 'castro.alexandersebastian@ue.edu.ph', ''),
('20190115549', 'Alvin Dale', 'Soliven', '', '6c5bf364', '', '', 'soliven.alvindale@ue.edu.ph', ''),
('290070115036', 'Errol John', 'Antonio', '', '32287628', '', '', 'erroljohn.antonio@ue.edu.ph', ''),
('', '', '', '', '', '\\', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendees`
--
ALTER TABLE `attendees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_info`
--
ALTER TABLE `event_info`
  ADD PRIMARY KEY (`event_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendees`
--
ALTER TABLE `attendees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event_info`
--
ALTER TABLE `event_info`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
