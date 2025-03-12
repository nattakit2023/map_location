-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2025 at 11:45 AM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scmonitor`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(256) NOT NULL,
  `c_mobile` varchar(15) NOT NULL,
  `c_email` varchar(100) NOT NULL,
  `c_address` varchar(256) NOT NULL,
  `c_created_date` datetime NOT NULL,
  `c_pwd` varchar(100) DEFAULT NULL,
  `c_isactive` varchar(11) NOT NULL DEFAULT '1',
  `c_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_from_sc`
--

CREATE TABLE `data_from_sc` (
  `id` int(100) NOT NULL,
  `esn` varchar(255) NOT NULL,
  `esnName` varchar(255) NOT NULL,
  `messageType` varchar(255) NOT NULL,
  `messageDetail` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `timeInGMTSecond` varchar(255) NOT NULL,
  `latitude` varchar(255) NOT NULL,
  `longitude` varchar(255) NOT NULL,
  `batteryState` varchar(255) NOT NULL,
  `idRawMessage` varchar(255) NOT NULL,
  `idMessage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `data_from_sc`
--

INSERT INTO `data_from_sc` (`id`, `esn`, `esnName`, `messageType`, `messageDetail`, `timestamp`, `timeInGMTSecond`, `latitude`, `longitude`, `batteryState`, `idRawMessage`, `idMessage`) VALUES
(32, '0-9999991', '0-9999991', 'UNLIMITED-TRACK', 'null', '2025-01-30 12:25:10', '', '8.02865', '102.31508', 'GOOD', '4c4343ee-ccc7-4431-a96f-047902642b2e', '2242908835'),
(33, '0-9999991', '0-9999991', 'UNLIMITED-TRACK', 'null', '2025-01-30 12:25:10', '', '8.02865', '102.31508', 'GOOD', '4c4343ee-ccc7-4431-a96f-047902642b2e', '2242908835'),
(34, '0-9999991', 'Test', 'Standard', '0x0010EEA74726104B00', '2025-02-17 06:59:29', '', '11.905478239059448', '100.0528335571289', 'GOOD', '759cfc804efb47b9994c325309d35c04', '0-9999991_1739800769'),
(35, '0-4587880', 'SC NATA', 'Standard', '0x00101A6C47F9424B00', '2025-02-17 06:58:37', '', '11.322569847106934', '101.21296405792236', 'GOOD', '015fecf089dc10068f74831c7524030e', '0-4587880_1739800717'),
(36, '0-4587880', 'SC NATA', 'Standard', '0x0010192647F9C44B00', '2025-02-17 07:18:20', '', '11.319072246551514', '101.21575355529785', 'GOOD', '47db9c8889dc10068520831c7524030e', '0-4587880_1739801900'),
(37, '0-4587880', 'SC NATA', 'Standard', '0x0010171C47FB684B00', '2025-02-17 07:28:36', '', '11.313471794128418', '101.22476577758789', 'GOOD', '6ca1a4b889dc1006815e831c7524030e', '0-4587880_1739802516'),
(38, '0-4587880', 'SC NATA', 'Standard', '0x001017C247FB534B00', '2025-02-17 07:43:37', '', '11.315252780914307', '101.22431516647339', 'GOOD', 'a24f9a2089dc10068b1c831c7524030e', '0-4587880_1739803417'),
(39, '0-4587880', 'SC NATA', 'Standard', '0x0010187047FB3C4B00', '2025-02-17 08:03:22', '', '11.317119598388672', '101.22382164001465', 'GOOD', 'e8eed36089dc10068cef831c7524030e', '0-4587880_1739804602'),
(40, '0-4587880', 'SC NATA', 'Standard', '0x0010191A47FB1B4B00', '2025-02-17 08:18:23', '', '11.318943500518799', '101.22311353683472', 'GOOD', '1ea6bf9089dd100684fc831c7524030e', '0-4587880_1739805503'),
(41, '0-4587880', 'SC NATA', 'Standard', '0x00101A5647FAB84B00', '2025-02-17 08:48:25', '', '11.322333812713623', '101.22098922729492', 'GOOD', '8a1098c889dd1006812e831c7524030e', '0-4587880_1739807305'),
(42, '0-4587880', 'SC NATA', 'Standard', '0x00101B1247FAA44B00', '2025-02-17 08:58:35', '', '11.324350833892822', '101.22056007385254', 'GOOD', 'ae76fc9889dd100684e6831c7524030e', '0-4587880_1739807915'),
(43, '0-4587880', 'SC NATA', 'Standard', '0x00101BCF47FA854B00', '2025-02-17 09:23:33', '', '11.326378583908081', '101.21989488601685', 'GOOD', '07be882089de10068d2e831c7524030e', '0-4587880_1739809413'),
(44, '0-4587880', 'SC NATA', 'Standard', '0x00101B9447FAA54B00', '2025-02-17 09:28:36', '', '11.325745582580566', '101.22058153152466', 'GOOD', '19cc82b089de1006822c831c7524030e', '0-4587880_1739809716'),
(45, '0-4587880', 'SC NATA', 'Standard', '0x001015D547FAA54B00', '2025-02-17 09:43:36', '', '11.309963464736938', '101.22058153152466', 'GOOD', '4f63796089de10068f9b831c7524030e', '0-4587880_1739810616'),
(46, '0-4587880', 'SC NATA', 'Standard', '0x001015EF47FAAA4B00', '2025-02-17 09:58:36', '', '11.310242414474487', '101.22068881988525', 'GOOD', '851b177089de10068a24831c7524030e', '0-4587880_1739811516'),
(47, '0-4587880', 'SC NATA', 'Standard', '0x0010155547FA944B00', '2025-02-17 10:13:36', '', '11.308590173721313', '101.22021675109863', 'GOOD', 'bab8c8c889de10068056831c7524030e', '0-4587880_1739812416'),
(48, '0-4587880', 'SC NATA', 'Standard', '0x001015EE47FA504B00', '2025-02-17 10:28:35', '', '11.310231685638428', '101.21875762939453', 'GOOD', 'f04ba0c889de10068b7e831c7524030e', '0-4587880_1739813315'),
(49, '0-4587880', 'SC NATA', 'Standard', '0x001016B847FA314B00', '2025-02-17 10:43:36', '', '11.312398910522461', '101.21809244155884', 'GOOD', '25efd61889df10068bc0831c7524030e', '0-4587880_1739814216'),
(50, '0-4587880', 'SC NATA', 'Standard', '0x0010176C47F9F24B00', '2025-02-17 10:58:37', '', '11.314330101013184', '101.21674060821533', 'GOOD', '5ba30b4089df1006838a831c7524030e', '0-4587880_1739815117'),
(51, '0-4587880', 'SC NATA', 'Standard', '0x001015D747FA9F4B00', '2025-02-17 11:13:35', '', '11.309984922409058', '101.22045278549194', 'GOOD', '913d1ae889df100682c8831c7524030e', '0-4587880_1739816015'),
(52, '0-4587880', 'SC NATA', 'Standard', '0x001015FF47FAA54B00', '2025-02-17 11:33:20', '', '11.31041407585144', '101.22058153152466', 'GOOD', 'd7d6782889df10068fc6831c7524030e', '0-4587880_1739817200'),
(53, '0-4587880', 'SC NATA', 'Standard', '0x001015FF47FAA54B00', '2025-02-17 11:48:23', '', '11.31041407585144', '101.22058153152466', 'GOOD', '0dae63c089e0100687e0831c7524030e', '0-4587880_1739818103'),
(54, '0-4587880', 'SC NATA', 'Standard', '0x0010160247FAA34B00', '2025-02-17 12:03:47', '', '11.31044626235962', '101.22053861618042', 'GOOD', '44b81c8089e0100686ee831c7524030e', '0-4587880_1739819027'),
(55, '0-4587880', 'SC NATA', 'Standard', '0x0010160147FAA24B00', '2025-02-17 12:18:20', '', '11.31043553352356', '101.2205171585083', 'GOOD', '78c65ff089e010068ba0831c7524030e', '0-4587880_1739819900'),
(56, '0-4587880', 'SC NATA', 'Standard', '0x0010160147FAA24B00', '2025-02-17 12:33:21', '', '11.31043553352356', '101.2205171585083', 'GOOD', 'ae8145d889e01006857e831c7524030e', '0-4587880_1739820801'),
(57, '0-4587880', 'SC NATA', 'Standard', '0x0010160047FAA24B00', '2025-02-17 12:43:36', '', '11.3104248046875', '101.2205171585083', 'GOOD', 'd326605889e0100682f4831c7524030e', '0-4587880_1739821416'),
(58, '0-4587880', 'SC NATA', 'Standard', '0x0010160147FAA14B00', '2025-02-17 13:08:11', '', '11.31043553352356', '101.22049570083618', 'GOOD', '2b2556b089e1100688c6831c7524030e', '0-4587880_1739822891'),
(59, '0-4587880', 'SC NATA', 'Standard', '0x0010160347FAA24B00', '2025-02-17 13:23:11', '', '11.310456991195679', '101.2205171585083', 'GOOD', '60b1b28889e110068725831c7524030e', '0-4587880_1739823791'),
(60, '0-4587880', 'SC NATA', 'Standard', '0x0010160447FAA04B00', '2025-02-17 13:28:35', '', '11.310467720031738', '101.22047424316406', 'GOOD', '73f3df8889e110068ae6831c7524030e', '0-4587880_1739824115'),
(61, '0-4587880', 'SC NATA', 'Standard', '0x001015FE47FAA34B00', '2025-02-17 13:48:22', '', '11.31040334701538', '101.22053861618042', 'GOOD', 'bac10e6889e110068eb2831c7524030e', '0-4587880_1739825302'),
(62, '0-4587880', 'SC NATA', 'Standard', '0x0010163947FA8F4B00', '2025-02-17 13:58:36', '', '11.311036348342896', '101.22010946273804', 'GOOD', 'df57e49089e1100686c7831c7524030e', '0-4587880_1739825916'),
(63, '0-4587880', 'SC NATA', 'Standard', '0x001016F747FA644B00', '2025-02-17 14:18:24', '', '11.313074827194214', '101.21918678283691', 'GOOD', '263090d889e210068ce9831c7524030e', '0-4587880_1739827104'),
(64, '0-4587880', 'SC NATA', 'Standard', '0x001017C047F9FB4B00', '2025-02-17 14:28:36', '', '11.315231323242188', '101.2169337272644', 'GOOD', '4a9cdc6089e2100687fb831c7524030e', '0-4587880_1739827716'),
(65, '0-4587880', 'SC NATA', 'Standard', '0x0010187C47F9AD4B00', '2025-02-17 14:48:24', '', '11.317248344421387', '101.21526002883911', 'GOOD', '91796cc089e210068deb831c7524030e', '0-4587880_1739828904'),
(66, '0-4587880', 'SC NATA', 'Standard', '0x0010193F47F9624B00', '2025-02-17 15:08:10', '', '11.319340467453003', '101.21365070343018', 'GOOD', 'd81a153089e210068218831c7524030e', '0-4587880_1739830090'),
(67, '0-4587880', 'SC NATA', 'Standard', '0x00101A0647F91D4B00', '2025-02-17 15:18:46', '', '11.321475505828857', '101.21217012405396', 'GOOD', 'fe11a43889e210068d41831c7524030e', '0-4587880_1739830726'),
(68, '0-4587880', 'SC NATA', 'Standard', '0x00101AB447F8D34B00', '2025-02-17 15:28:36', '', '11.323342323303223', '101.21058225631714', 'GOOD', '2137fa7089e31006866a831c7524030e', '0-4587880_1739831316'),
(69, '0-4587880', 'SC NATA', 'Standard', '0x0010198D47F8F84B00', '2025-02-17 15:48:22', '', '11.32017731666565', '101.21137619018555', 'GOOD', '67e535a089e310068320831c7524030e', '0-4587880_1739832502'),
(70, '0-4587880', 'SC NATA', 'Standard', '0x001015F147FAAA4B00', '2025-02-17 16:03:22', '', '11.310263872146606', '101.22068881988525', 'GOOD', '9d8b4f5089e31006848f831c7524030e', '0-4587880_1739833402'),
(71, '0-4587880', 'SC NATA', 'Standard', '0x001015F247FAAA4B00', '2025-02-17 16:13:36', '', '11.310274600982666', '101.22068881988525', 'GOOD', 'c2241d6089e31006879d831c7524030e', '0-4587880_1739834016'),
(72, '0-4587880', 'SC NATA', 'Standard', '0x0010153047F9764B00', '2025-02-17 16:28:36', '', '11.30819320678711', '101.21407985687256', 'GOOD', 'f7dbcef889e310068e9e831c7524030e', '0-4587880_1739834916'),
(73, '0-4587880', 'SC NATA', 'Standard', '0x001015B647F92B4B00', '2025-02-17 16:48:19', '', '11.309630870819092', '101.21247053146362', 'GOOD', '3e6234c089e410068d19831c7524030e', '0-4587880_1739836099'),
(74, '0-4587880', 'SC NATA', 'Standard', '0x001015F647FAAE4B00', '2025-02-17 16:58:34', '', '11.310317516326904', '101.22077465057373', 'GOOD', '62f02d6089e410068787831c7524030e', '0-4587880_1739836714'),
(75, '0-4587880', 'SC NATA', 'Standard', '0x0010156647FA394B00', '2025-02-17 17:13:34', '', '11.308772563934326', '101.21826410293579', 'GOOD', '98a1f74089e4100682a3831c7524030e', '0-4587880_1739837614'),
(76, '0-4587880', 'SC NATA', 'Standard', '0x0010155347F9C94B00', '2025-02-17 17:28:57', '', '11.308568716049194', '101.21586084365845', 'GOOD', 'cfa080b889e4100688e0831c7524030e', '0-4587880_1739838537'),
(77, '0-4587880', 'SC NATA', 'Standard', '0x001015E747FAB94B00', '2025-02-17 17:58:34', '', '11.31015658378601', '101.22101068496704', 'GOOD', '39979bc889e510068f19831c7524030e', '0-4587880_1739840314'),
(78, '0-4587880', 'SC NATA', 'Standard', '0x0010160747FA974B00', '2025-02-17 18:28:35', '', '11.310499906539917', '101.22028112411499', 'GOOD', 'a4e1f29889e510068240831c7524030e', '0-4587880_1739842115'),
(79, '0-4587880', 'SC NATA', 'Standard', '0x0010138147FB554B00', '2025-02-17 18:48:22', '', '11.303569078445435', '101.22435808181763', 'GOOD', 'ebadb63089e510068012831c7524030e', '0-4587880_1739843302'),
(80, '0-4587880', 'SC NATA', 'Standard', '0x00100C4147FE614B00', '2025-02-17 18:58:35', '', '11.283656358718872', '101.24109506607056', 'GOOD', '10295b6889e610068103831c7524030e', '0-4587880_1739843915'),
(81, '0-4587880', 'SC NATA', 'Standard', '0x001004294800EB4B00', '2025-02-17 19:13:35', '', '11.261426210403442', '101.255042552948', 'GOOD', '45d8a0c089e6100680a4831c7524030e', '0-4587880_1739844815'),
(82, '0-4587880', 'SC NATA', 'Standard', '0x0010011048022F4B00', '2025-02-17 19:28:34', '', '11.252918243408203', '101.2619948387146', 'GOOD', '7b63200889e6100680fa831c7524030e', '0-4587880_1739845714'),
(83, '0-4587880', 'SC NATA', 'Standard', '0x001001164802314B00', '2025-02-17 19:43:37', '', '11.25298261642456', '101.26203775405884', 'GOOD', 'b1383ce089e61006809e831c7524030e', '0-4587880_1739846617'),
(84, '0-4587880', 'SC NATA', 'Standard', '0x0010011C4802304B00', '2025-02-17 19:59:00', '', '11.253046989440918', '101.26201629638672', 'GOOD', 'e83e53f089e610068ea2831c7524030e', '0-4587880_1739847540'),
(85, '0-4587880', 'SC NATA', 'Standard', '0x0010011D4802304B00', '2025-02-17 20:13:36', '1739848416', '11.253057718276978', '101.26201629638672', 'GOOD', '1c6bb82089e7100681a8831c7524030e', '0-4587880_1739848416'),
(86, '0-4587880', 'SC NATA', 'Standard', '0x0010011E48022E4B00', '2025-02-17 20:28:36', '1739849316', '11.253068447113037', '101.26197338104248', 'GOOD', '521344e889e710068055831c7524030e', '0-4587880_1739849316'),
(87, '0-4587880', 'SC NATA', 'Standard', '0x001001154802304B00', '2025-02-17 20:48:19', '1739850499', '11.252971887588501', '101.26201629638672', 'GOOD', '98a99cb889e71006832f831c7524030e', '0-4587880_1739850499'),
(88, '0-4587880', 'SC NATA', 'Standard', '0x001001134802344B00', '2025-02-17 21:18:22', '1739852302', '11.252950429916382', '101.2621021270752', 'GOOD', '0412221889e81006812c831c7524030e', '0-4587880_1739852302'),
(89, '0-4587880', 'SC NATA', 'Standard', '0x0010011C4802354B00', '2025-02-17 21:28:37', '1739852917', '11.253046989440918', '101.26212358474731', 'GOOD', '28c6b97089e810068e33831c7524030e', '0-4587880_1739852917'),
(90, '0-4587880', 'SC NATA', 'Standard', '0x001001174802394B00', '2025-02-17 21:43:37', '1739853817', '11.25299334526062', '101.26220941543579', 'GOOD', '5e5f986889e810068094831c7524030e', '0-4587880_1739853817');

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `d_id` int(11) NOT NULL,
  `d_name` varchar(100) NOT NULL,
  `d_mobile` varchar(15) NOT NULL,
  `d_address` varchar(250) NOT NULL,
  `d_age` int(11) NOT NULL,
  `d_licenseno` varchar(100) NOT NULL,
  `d_license_expdate` date NOT NULL,
  `d_total_exp` int(11) NOT NULL,
  `d_doj` date NOT NULL,
  `d_ref` varchar(256) DEFAULT NULL,
  `d_is_active` int(11) NOT NULL DEFAULT 1,
  `d_created_by` varchar(100) NOT NULL,
  `d_created_date` datetime NOT NULL,
  `d_modified_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `email_template`
--

CREATE TABLE `email_template` (
  `et_id` int(11) NOT NULL,
  `et_name` varchar(256) NOT NULL,
  `et_subject` varchar(100) NOT NULL,
  `et_body` longtext NOT NULL,
  `et_created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `email_template`
--

INSERT INTO `email_template` (`et_id`, `et_name`, `et_subject`, `et_body`, `et_created_date`) VALUES
(1, 'booking', 'Booking Confirmation - VMS', '<p>Dear Customer,<p>\r\n\r\n<p>Thank you for choosing VMS<p>\r\n\r\n<p>We look forward to welcoming you to strat trip.<p>\r\n\r\n<p>{{bookingdetails}}<p>\r\n\r\n<p>Our professional and friendly staff are committed to ensuring your travel is both enjoyable and comfortable.<p>\r\n\r\n<p>Should you have any requests prior to your travel, please do not hesitate to contact us and we will endeavor to assist you whenever possible.<p>', '2020-07-30 19:47:12'),
(2, 'tracking', 'Trip Tracking - VMS', '<p>Dear Customer,</p>\r\n\r\n<p>Please use below url to track trip live location.</p>\r\n\r\n<p>URL : {{url}}<p>', '2020-07-30 20:09:21');

-- --------------------------------------------------------

--
-- Table structure for table `fuel`
--

CREATE TABLE `fuel` (
  `v_fuel_id` int(10) NOT NULL,
  `v_id` int(100) NOT NULL,
  `v_fuel_quantity` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_odometerreading` varchar(100) DEFAULT NULL,
  `v_fuelprice` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_fuelfilldate` date NOT NULL,
  `v_fueladdedby` varchar(100) NOT NULL,
  `v_fuelcomments` varchar(256) NOT NULL,
  `v_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `geofences`
--

CREATE TABLE `geofences` (
  `geo_id` int(11) NOT NULL,
  `geo_name` varchar(128) NOT NULL,
  `geo_description` varchar(128) DEFAULT NULL,
  `geo_area` varchar(4096) NOT NULL,
  `geo_vehicles` varchar(256) NOT NULL,
  `geo_createddate` datetime NOT NULL DEFAULT current_timestamp(),
  `geo_modifieddate` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `geofence_events`
--

CREATE TABLE `geofence_events` (
  `ge_id` int(11) NOT NULL,
  `ge_v_id` varchar(11) NOT NULL,
  `ge_geo_id` varchar(11) NOT NULL,
  `ge_event` varchar(256) NOT NULL,
  `ge_timestamp` varchar(100) NOT NULL,
  `ge_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `incomeexpense`
--

CREATE TABLE `incomeexpense` (
  `ie_id` int(11) NOT NULL,
  `ie_v_id` varchar(100) NOT NULL,
  `ie_date` date NOT NULL,
  `ie_type` varchar(100) NOT NULL,
  `ie_description` varchar(256) NOT NULL,
  `ie_amount` int(100) NOT NULL,
  `ie_created_date` datetime NOT NULL DEFAULT current_timestamp(),
  `ie_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `u_id` int(11) NOT NULL,
  `u_name` varchar(250) NOT NULL,
  `u_username` varchar(250) NOT NULL,
  `u_password` varchar(250) NOT NULL,
  `u_isactive` varchar(100) NOT NULL DEFAULT '1',
  `u_email` varchar(256) NOT NULL,
  `u_created_date` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`u_id`, `u_name`, `u_username`, `u_password`, `u_isactive`, `u_email`, `u_created_date`) VALUES
(1, 'nutphakawat', 'nutphakawat@shipexpert.net', 'fd181490bd826c77698db621b9770320', '1', 'nutphakawat@shipexpert.net', '2025-02-13 17:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `login_roles`
--

CREATE TABLE `login_roles` (
  `lr_id` int(11) NOT NULL,
  `lr_u_id` int(11) NOT NULL,
  `lr_vech_list` int(11) NOT NULL DEFAULT 0,
  `lr_vech_list_view` int(11) NOT NULL DEFAULT 0,
  `lr_vech_list_edit` int(11) NOT NULL DEFAULT 0,
  `lr_vech_add` int(11) NOT NULL DEFAULT 0,
  `lr_vech_group` int(11) NOT NULL DEFAULT 0,
  `lr_vech_group_add` int(11) NOT NULL DEFAULT 0,
  `lr_vech_group_action` int(11) NOT NULL DEFAULT 0,
  `lr_drivers_list` int(11) NOT NULL DEFAULT 0,
  `lr_drivers_list_edit` int(11) NOT NULL DEFAULT 0,
  `lr_drivers_add` int(11) NOT NULL DEFAULT 0,
  `lr_trips_list` int(11) NOT NULL DEFAULT 0,
  `lr_trips_list_edit` int(11) NOT NULL DEFAULT 0,
  `lr_trips_add` int(11) NOT NULL DEFAULT 0,
  `lr_cust_list` int(11) NOT NULL DEFAULT 0,
  `lr_cust_edit` int(11) NOT NULL DEFAULT 0,
  `lr_cust_add` int(11) NOT NULL DEFAULT 0,
  `lr_fuel_list` int(11) NOT NULL DEFAULT 0,
  `lr_fuel_edit` int(11) NOT NULL DEFAULT 0,
  `lr_fuel_add` int(11) NOT NULL DEFAULT 0,
  `lr_reminder_list` int(11) NOT NULL DEFAULT 0,
  `lr_reminder_delete` int(11) NOT NULL DEFAULT 0,
  `lr_reminder_add` int(11) NOT NULL DEFAULT 0,
  `lr_ie_list` int(11) NOT NULL DEFAULT 0,
  `lr_ie_edit` int(11) NOT NULL DEFAULT 0,
  `lr_ie_add` int(11) NOT NULL DEFAULT 0,
  `lr_tracking` int(11) NOT NULL DEFAULT 0,
  `lr_liveloc` int(11) NOT NULL DEFAULT 0,
  `lr_geofence_add` int(11) NOT NULL DEFAULT 0,
  `lr_geofence_list` int(11) NOT NULL DEFAULT 0,
  `lr_geofence_delete` int(11) NOT NULL DEFAULT 0,
  `lr_geofence_events` int(11) NOT NULL DEFAULT 0,
  `lr_reports` int(11) NOT NULL DEFAULT 0,
  `lr_settings` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_roles`
--

INSERT INTO `login_roles` (`lr_id`, `lr_u_id`, `lr_vech_list`, `lr_vech_list_view`, `lr_vech_list_edit`, `lr_vech_add`, `lr_vech_group`, `lr_vech_group_add`, `lr_vech_group_action`, `lr_drivers_list`, `lr_drivers_list_edit`, `lr_drivers_add`, `lr_trips_list`, `lr_trips_list_edit`, `lr_trips_add`, `lr_cust_list`, `lr_cust_edit`, `lr_cust_add`, `lr_fuel_list`, `lr_fuel_edit`, `lr_fuel_add`, `lr_reminder_list`, `lr_reminder_delete`, `lr_reminder_add`, `lr_ie_list`, `lr_ie_edit`, `lr_ie_add`, `lr_tracking`, `lr_liveloc`, `lr_geofence_add`, `lr_geofence_list`, `lr_geofence_delete`, `lr_geofence_events`, `lr_reports`, `lr_settings`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `n_id` int(11) NOT NULL,
  `n_subject` varchar(256) NOT NULL,
  `n_message` varchar(256) DEFAULT NULL,
  `n_is_read` int(11) NOT NULL DEFAULT 0,
  `n_created_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT current_timestamp(),
  `v_id` int(11) NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  `altitude` double DEFAULT NULL,
  `speed` double DEFAULT NULL,
  `bearing` double DEFAULT NULL,
  `accuracy` int(11) DEFAULT NULL,
  `provider` varchar(100) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reminder`
--

CREATE TABLE `reminder` (
  `r_id` int(11) NOT NULL,
  `r_v_id` varchar(11) NOT NULL,
  `r_date` date NOT NULL,
  `r_message` varchar(256) NOT NULL,
  `r_isread` varchar(11) NOT NULL DEFAULT '0',
  `r_created_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `s_id` int(11) NOT NULL,
  `s_companyname` varchar(100) DEFAULT NULL,
  `s_address` varchar(100) DEFAULT NULL,
  `s_inovice_prefix` varchar(100) NOT NULL,
  `s_logo` varchar(100) NOT NULL,
  `s_price_prefix` varchar(100) NOT NULL,
  `s_inovice_termsandcondition` varchar(256) NOT NULL,
  `s_inovice_servicename` varchar(100) NOT NULL,
  `s_googel_api_key` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`s_id`, `s_companyname`, `s_address`, `s_inovice_prefix`, `s_logo`, `s_price_prefix`, `s_inovice_termsandcondition`, `s_inovice_servicename`, `s_googel_api_key`) VALUES
(1, 'VMS', '19/14,First Street,Chennai-1000', 'TEST', 'sitelogo.jpg', '$ ', 'Sample invoice terms and condition..Please change it in settings page............                                                                                                                                                                               ', 'Vehicle Booking', 'AIzaSyA1tT5eHsRh7kbZDzebF-lfVzVgSX8zpLg');

-- --------------------------------------------------------

--
-- Table structure for table `settings_smtp`
--

CREATE TABLE `settings_smtp` (
  `smtp_host` varchar(100) NOT NULL,
  `smtp_auth` varchar(100) NOT NULL,
  `smtp_uname` varchar(100) NOT NULL,
  `smtp_pwd` varchar(100) NOT NULL,
  `smtp_issecure` varchar(100) NOT NULL,
  `smtp_port` varchar(100) NOT NULL,
  `smtp_emailfrom` varchar(100) NOT NULL,
  `smtp_replyto` varchar(100) NOT NULL,
  `smtp_createddate` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `t_id` int(11) NOT NULL,
  `t_customer_id` varchar(11) NOT NULL,
  `t_vechicle` varchar(100) NOT NULL,
  `t_type` varchar(100) NOT NULL,
  `t_driver` varchar(100) NOT NULL,
  `t_start_date` date NOT NULL,
  `t_end_date` date NOT NULL,
  `t_trip_fromlocation` varchar(100) NOT NULL,
  `t_trip_tolocation` varchar(100) NOT NULL,
  `t_trip_fromlat` varchar(100) DEFAULT NULL,
  `t_trip_fromlog` varchar(100) DEFAULT NULL,
  `t_trip_tolat` varchar(100) DEFAULT NULL,
  `t_trip_tolog` varchar(100) NOT NULL,
  `t_totaldistance` varchar(100) NOT NULL,
  `t_trip_amount` varchar(100) NOT NULL DEFAULT '0',
  `t_trip_status` varchar(50) NOT NULL DEFAULT 'OnGoing',
  `t_trackingcode` varchar(100) DEFAULT NULL,
  `t_created_by` varchar(100) NOT NULL,
  `t_created_date` datetime NOT NULL,
  `t_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `trip_payments`
--

CREATE TABLE `trip_payments` (
  `tp_id` int(11) NOT NULL,
  `tp_trip_id` int(11) NOT NULL,
  `tp_v_id` int(11) NOT NULL,
  `tp_amount` int(100) NOT NULL,
  `tp_notes` varchar(256) DEFAULT NULL,
  `tp_created_date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `update_data_from_sc`
--

CREATE TABLE `update_data_from_sc` (
  `id` int(11) NOT NULL,
  `data_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `update_data_from_sc`
--

INSERT INTO `update_data_from_sc` (`id`, `data_id`) VALUES
(4, 34),
(5, 90);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `v_id` int(10) NOT NULL,
  `v_registration_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_name` varchar(100) NOT NULL,
  `v_model` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_chassis_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_engine_no` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_manufactured_by` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `v_type` varchar(100) NOT NULL,
  `v_color` varchar(100) NOT NULL,
  `v_mileageperlitre` varchar(100) NOT NULL,
  `v_is_active` int(10) NOT NULL DEFAULT 1,
  `v_group` int(11) NOT NULL,
  `v_reg_exp_date` varchar(100) NOT NULL,
  `v_api_url` varchar(100) NOT NULL,
  `v_api_username` varchar(100) NOT NULL,
  `v_api_password` varchar(100) NOT NULL,
  `v_created_by` varchar(100) NOT NULL,
  `v_created_date` datetime NOT NULL,
  `v_modified_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_group`
--

CREATE TABLE `vehicle_group` (
  `gr_id` int(11) NOT NULL,
  `gr_name` varchar(256) NOT NULL,
  `gr_desc` varchar(256) NOT NULL,
  `gr_created_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `data_from_sc`
--
ALTER TABLE `data_from_sc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`d_id`);

--
-- Indexes for table `email_template`
--
ALTER TABLE `email_template`
  ADD PRIMARY KEY (`et_id`);

--
-- Indexes for table `fuel`
--
ALTER TABLE `fuel`
  ADD PRIMARY KEY (`v_fuel_id`);

--
-- Indexes for table `geofences`
--
ALTER TABLE `geofences`
  ADD PRIMARY KEY (`geo_id`);

--
-- Indexes for table `geofence_events`
--
ALTER TABLE `geofence_events`
  ADD PRIMARY KEY (`ge_id`);

--
-- Indexes for table `incomeexpense`
--
ALTER TABLE `incomeexpense`
  ADD PRIMARY KEY (`ie_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`u_id`);

--
-- Indexes for table `login_roles`
--
ALTER TABLE `login_roles`
  ADD PRIMARY KEY (`lr_id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`n_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_user_id` (`v_id`);

--
-- Indexes for table `reminder`
--
ALTER TABLE `reminder`
  ADD PRIMARY KEY (`r_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`s_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`t_id`);

--
-- Indexes for table `trip_payments`
--
ALTER TABLE `trip_payments`
  ADD PRIMARY KEY (`tp_id`);

--
-- Indexes for table `update_data_from_sc`
--
ALTER TABLE `update_data_from_sc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`v_id`);

--
-- Indexes for table `vehicle_group`
--
ALTER TABLE `vehicle_group`
  ADD PRIMARY KEY (`gr_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customers`
--
ALTER TABLE `customers`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `data_from_sc`
--
ALTER TABLE `data_from_sc`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=91;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `d_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `email_template`
--
ALTER TABLE `email_template`
  MODIFY `et_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fuel`
--
ALTER TABLE `fuel`
  MODIFY `v_fuel_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `geofences`
--
ALTER TABLE `geofences`
  MODIFY `geo_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `geofence_events`
--
ALTER TABLE `geofence_events`
  MODIFY `ge_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomeexpense`
--
ALTER TABLE `incomeexpense`
  MODIFY `ie_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `u_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `login_roles`
--
ALTER TABLE `login_roles`
  MODIFY `lr_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `n_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reminder`
--
ALTER TABLE `reminder`
  MODIFY `r_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `s_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `trip_payments`
--
ALTER TABLE `trip_payments`
  MODIFY `tp_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `update_data_from_sc`
--
ALTER TABLE `update_data_from_sc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `v_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicle_group`
--
ALTER TABLE `vehicle_group`
  MODIFY `gr_id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
