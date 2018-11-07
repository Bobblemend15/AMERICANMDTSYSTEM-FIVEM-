-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 06, 2018 at 08:39 PM
-- Server version: 5.6.41-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mdtsystem`
--

-- --------------------------------------------------------

--
-- Table structure for table `calls`
--

CREATE TABLE `calls` (
  `callid` mediumint(9) NOT NULL,
  `type` mediumtext NOT NULL,
  `location` mediumtext NOT NULL,
  `description` mediumtext NOT NULL,
  `police_grade` mediumtext NOT NULL,
  `rmu_grade` mediumtext NOT NULL,
  `channel` mediumtext NOT NULL,
  `caller` mediumint(9) NOT NULL,
  `status` mediumint(9) NOT NULL,
  `dateline` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `civilians`
--

CREATE TABLE `civilians` (
  `civid` bigint(20) NOT NULL,
  `name` mediumtext NOT NULL,
  `dob` mediumtext NOT NULL,
  `address` mediumtext NOT NULL,
  `markers` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `civilian_notes`
--

CREATE TABLE `civilian_notes` (
  `noteid` bigint(20) NOT NULL,
  `civid` int(11) NOT NULL,
  `unit` varchar(255) NOT NULL,
  `note` mediumtext NOT NULL,
  `dateline` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `logid` bigint(20) NOT NULL,
  `user` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `category` mediumtext NOT NULL,
  `dateline` bigint(20) NOT NULL,
  `visible` int(1) NOT NULL DEFAULT '1' COMMENT '1 = Visible, 0 = Hidden'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `markers`
--

CREATE TABLE `markers` (
  `id` bigint(20) NOT NULL,
  `acronym` mediumtext NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `markers`
--

INSERT INTO `markers` (`id`, `acronym`, `name`) VALUES
(1, 'T1A', 'Assault'),
(2, 'T1AA', 'Assault with a Deadly Weapon'),
(3, 'T1B', 'Battery'),
(4, 'T1BA', 'Battery with Serious Bodily Harm'),
(5, 'T1C', 'False Imprisonment'),
(6, 'T1D', 'Kidnapping'),
(7, 'T1E', 'Attempted Murder'),
(8, 'T1FA', '1st Degree Murder'),
(9, 'T1FB', '2nd Degree Murder'),
(10, 'T1FC', '3rd Degree Murder'),
(11, 'T1GA', 'Voluntary Manslaughter'),
(12, 'T1GB', 'Involuntary Manslaughter'),
(13, 'T1GC', 'Vehicular Manslaughter'),
(14, 'T1H', 'Sexual Battery'),
(15, 'T1I', 'Toture'),
(16, 'T1J', 'Violating A Restraining Order'),
(17, 'T2A', 'Arson'),
(18, 'T2B', 'Trespassing'),
(19, 'T2C', 'Breaking and Entering'),
(20, 'T2D', 'Burglary'),
(21, 'T2E', 'Possession of criminal tools '),
(22, 'T2F', 'Vandalism'),
(23, 'T3A', 'Forgery'),
(24, 'T3B', 'Fraud'),
(25, 'T3C', 'Money Laundering'),
(26, 'T3DA', 'Petty Theft'),
(27, 'T3DB', 'Theft'),
(28, 'T3DC', 'Grand Theft'),
(29, 'T3DD', 'Grand Theft Auto'),
(30, 'T3DE', 'Grand Theft of Firearms'),
(31, 'T3E', 'Receiving Stolen Property'),
(32, 'T3F', 'Robbery'),
(33, 'T3G', 'Armed Robbery'),
(34, 'T3H', 'Extortion'),
(35, 'T3I', 'Counterfeiting'),
(36, 'T3J', 'Embezzlement'),
(37, 'T3K', 'Carjacking'),
(38, 'T4A', 'Bribery'),
(39, 'T4AA', 'Bribery of a Government Official'),
(40, 'T4AB', 'Accepting A Bribe'),
(41, 'T4B', 'Failure To Pay A Fine'),
(42, 'T4C', 'Resisting Arrest'),
(43, 'T4D', 'Escaping Custody'),
(44, 'T4E', 'Obstruction'),
(45, 'T4F', 'Misuse of a Government Helpline'),
(46, 'T4G', 'Human Trafficking'),
(47, 'T4H', 'Aiding and Abetting'),
(48, 'T4I', 'Accessory After The Fact'),
(49, 'T4J', 'Tampering With Evidence'),
(50, 'T4KA', 'Impersonation Of Another Person'),
(51, 'TK4B', 'Impersonation of a Government Official'),
(52, 'T4KC', 'Contempt of Court '),
(53, 'T4L', 'Corruption'),
(54, 'T4LA', 'Corruption of a Public Office'),
(55, 'T4LB', 'Corruption of Public Duty'),
(56, 'T5A', 'Indecent Exposure'),
(57, 'T5B', 'Disturbing the Peace'),
(58, 'T5C', 'Littering'),
(59, 'T5D', 'Unlawful Assembly'),
(60, 'T5E', 'Rioting'),
(61, 'T5EA', 'Participating in a Riot'),
(62, 'T5EB', 'Initiating a Riot'),
(63, 'T5F', 'Prostitution'),
(64, 'T5G', 'Pimping'),
(65, 'T6A', 'Public Intoxication'),
(66, 'T6B', 'Terrorism'),
(67, 'T6C', 'Possession of a controlled substance'),
(68, 'T6D', 'Possession of a controlled substance with intent'),
(69, 'T6E', 'Sale of a Controlled Substance'),
(70, 'T6FA', 'Manufacture of a Controlled Substance'),
(71, 'T6FB', 'Manufacturing of Alcohol without a license'),
(72, 'T6G', 'Sale of Alcohol to a minor'),
(73, 'T7A', 'Eluding / Evading a Peace Officer'),
(74, 'T7B', 'Reckless Elusion / Evasion?'),
(75, 'T7C', 'Hit and Run'),
(76, 'T7D', 'Hit and Run with Injury'),
(77, 'T7E', 'Failure to yield at a stop sign'),
(78, 'T7F', 'Reckless Driving'),
(79, 'T7G', 'Speeding'),
(80, 'T7H', 'Parking Violation'),
(81, 'T7I', 'Illegal Window Tint'),
(82, 'T7J', 'Driving without Valid License'),
(83, 'T7L', 'Failure to show I.D.'),
(84, 'T7M', 'Open Alcohol Container'),
(85, 'T7N', 'Driving Under the Influence'),
(86, 'T7O', 'Driving Under the Influence of Drugs'),
(87, 'T7P', 'Operation of a ATV on Streets/Highways'),
(88, 'T7Q', 'Operation of a Golf Cart on Streets/Highways'),
(89, 'T7R', 'Failure to Display plates'),
(90, 'T7S', 'Engaging in a Speed Contest'),
(91, 'T8A', 'Carrying a concealed weapon'),
(92, 'T8B', 'Possession of an Automatic Assault Rifle'),
(93, 'T8C', 'Felon in possession of a firearm'),
(94, 'T8D', 'High Dangerous Device'),
(95, 'T8E', 'Brandishing a weapon'),
(96, 'T8F', 'Brandishing a firearm'),
(97, 'T8G', 'Drive By Shooting'),
(98, 'T8H', 'General Prohibited weapons violation'),
(99, 'T8I', 'Weapons Discharge Violation'),
(100, 'T8IA', 'Weapons Discharge Violation (In Public)'),
(101, 'T8J', 'Unlawful sale of a firearm'),
(102, 'T8JA', 'Unlawful sale of a firearm to an unlicensed person'),
(103, 'CLEAN', 'CLEAN RECORD');

-- --------------------------------------------------------

--
-- Table structure for table `mdt_sessions`
--

CREATE TABLE `mdt_sessions` (
  `id` mediumint(9) NOT NULL,
  `session_id` mediumtext NOT NULL,
  `user_id` mediumint(9) NOT NULL,
  `ip` varchar(255) NOT NULL,
  `timestamp` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdt_sessions`
--

INSERT INTO `mdt_sessions` (`id`, `session_id`, `user_id`, `ip`, `timestamp`) VALUES
(2, 'f5aos3n8mpf9830rosq59ctp8k', 1, '::1', 8388607),
(3, 'tb3l8sk7jeskm08nagbgggpms9', 1, '::1', 8388607),
(14, 'iovf81sg2lf0i10g118r91uld7', 1, '24.165.178.147', 8388607);

-- --------------------------------------------------------

--
-- Table structure for table `mdt_users`
--

CREATE TABLE `mdt_users` (
  `userid` mediumint(9) NOT NULL,
  `first_name` text NOT NULL,
  `surname` mediumtext NOT NULL,
  `email` mediumtext NOT NULL,
  `steamid` longtext NOT NULL,
  `password` mediumtext NOT NULL,
  `collar` mediumtext NOT NULL,
  `groups` mediumtext NOT NULL,
  `joindate` bigint(20) NOT NULL,
  `theme` int(11) NOT NULL DEFAULT '1',
  `last_ip` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mdt_users`
--

INSERT INTO `mdt_users` (`userid`, `first_name`, `surname`, `email`, `steamid`, `password`, `collar`, `groups`, `joindate`, `theme`, `last_ip`) VALUES
(1, 'Change', 'Me', 'Changeme@gmail.com', '', '$2y$10$Hd6BbW4F4SNJv1wVq0o6xOHZpdPMoGYYpI.mtZVY3ntkfqveVre/i', '1234', '1,2,3,4,5,6,7,8,9,10,11,12,13,14,', 1530222515, 2, '24.165.178.147');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `messageid` mediumint(9) NOT NULL,
  `recive` mediumtext NOT NULL,
  `post` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `dateline` bigint(20) NOT NULL,
  `visible` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `pois`
--

CREATE TABLE `pois` (
  `id` bigint(20) NOT NULL,
  `civ_id` bigint(20) NOT NULL,
  `image` mediumtext NOT NULL,
  `reason` mediumtext NOT NULL,
  `notes` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `remarks`
--

CREATE TABLE `remarks` (
  `remarkid` mediumint(9) NOT NULL,
  `unit` mediumtext NOT NULL,
  `content` mediumtext NOT NULL,
  `dateline` bigint(20) NOT NULL,
  `callid` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` bigint(20) NOT NULL,
  `user` bigint(20) NOT NULL,
  `incident` mediumtext NOT NULL,
  `cad` mediumtext NOT NULL,
  `located` mediumtext NOT NULL,
  `otherUnits` mediumtext NOT NULL,
  `arrested` mediumtext NOT NULL,
  `person` mediumtext NOT NULL,
  `arrestedFor` mediumtext NOT NULL,
  `foundItems` mediumtext NOT NULL,
  `whatHappened` longtext NOT NULL,
  `dateline` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `unitid` mediumint(9) NOT NULL,
  `unit` mediumtext NOT NULL,
  `callid` mediumint(9) NOT NULL,
  `status` mediumtext NOT NULL,
  `collar` mediumtext NOT NULL,
  `steamid` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `usergroups`
--

CREATE TABLE `usergroups` (
  `id` mediumint(9) NOT NULL,
  `name` mediumtext NOT NULL,
  `perms` mediumint(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `usergroups`
--

INSERT INTO `usergroups` (`id`, `name`, `perms`) VALUES
(1, 'Registered User', 1),
(2, 'Community Member', 17),
(3, 'Trooper', 211),
(4, 'Corporal', 209),
(5, 'Sergeant', 241),
(6, 'Lieutenant', 8959),
(7, 'Captain', 25343),
(8, 'Chief', 27647),
(9, 'Moderator', 60159),
(10, 'Field Training Officer', 255),
(11, 'Dispatcher', 59647),
(12, 'Director', 64255),
(13, 'Administrator', 64511),
(14, 'Website Administrator', 16383);

-- --------------------------------------------------------

--
-- Table structure for table `user_perms`
--

CREATE TABLE `user_perms` (
  `perm` bigint(20) NOT NULL,
  `name` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `user_perms`
--

INSERT INTO `user_perms` (`perm`, `name`) VALUES
(1, 'Is A Registered Member[Do not uncheck this or will break usergroups!]'),
(2, 'Can Access Call Overview Page'),
(4, 'Can Access Assign Calls Page [Must have \"Can Access Call Overview Page\" Enabled]'),
(8, 'Can Access Dismiss Calls Page [Must have \"Can Access Call Overview Page\" Enabled]'),
(16, 'Can Access Civilian Area'),
(32, 'Can Access BOLO Area'),
(64, 'Can Access Reports Area'),
(128, 'Can Access CAD Area'),
(256, 'Can Access Admin Area'),
(512, 'Is a Command Member'),
(2048, 'Can End Shifts'),
(4096, 'Can Ban mdt_users'),
(8192, 'Can View Reports'),
(16384, 'Can view Form Responses'),
(32768, 'Can create & Delete events');

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicleid` bigint(20) NOT NULL,
  `vehicle` mediumtext NOT NULL,
  `vrm` mediumtext NOT NULL,
  `owner` bigint(20) NOT NULL,
  `status` mediumtext NOT NULL,
  `insurer` mediumtext NOT NULL,
  `insurance_number` mediumtext NOT NULL,
  `registered_drivers` mediumtext NOT NULL,
  `markers` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vois`
--

CREATE TABLE `vois` (
  `id` bigint(20) NOT NULL,
  `vehicle_id` bigint(20) NOT NULL,
  `image` mediumtext NOT NULL,
  `reason` mediumtext NOT NULL,
  `notes` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calls`
--
ALTER TABLE `calls`
  ADD PRIMARY KEY (`callid`);

--
-- Indexes for table `civilians`
--
ALTER TABLE `civilians`
  ADD PRIMARY KEY (`civid`);

--
-- Indexes for table `civilian_notes`
--
ALTER TABLE `civilian_notes`
  ADD PRIMARY KEY (`noteid`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`logid`);

--
-- Indexes for table `markers`
--
ALTER TABLE `markers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdt_sessions`
--
ALTER TABLE `mdt_sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mdt_users`
--
ALTER TABLE `mdt_users`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`messageid`);

--
-- Indexes for table `pois`
--
ALTER TABLE `pois`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remarks`
--
ALTER TABLE `remarks`
  ADD PRIMARY KEY (`remarkid`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`unitid`);

--
-- Indexes for table `usergroups`
--
ALTER TABLE `usergroups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicleid`);

--
-- Indexes for table `vois`
--
ALTER TABLE `vois`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calls`
--
ALTER TABLE `calls`
  MODIFY `callid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `civilians`
--
ALTER TABLE `civilians`
  MODIFY `civid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `civilian_notes`
--
ALTER TABLE `civilian_notes`
  MODIFY `noteid` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `logid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=315;

--
-- AUTO_INCREMENT for table `markers`
--
ALTER TABLE `markers`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `mdt_sessions`
--
ALTER TABLE `mdt_sessions`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `mdt_users`
--
ALTER TABLE `mdt_users`
  MODIFY `userid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `messageid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `pois`
--
ALTER TABLE `pois`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `remarks`
--
ALTER TABLE `remarks`
  MODIFY `remarkid` mediumint(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `unitid` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `usergroups`
--
ALTER TABLE `usergroups`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicleid` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vois`
--
ALTER TABLE `vois`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
