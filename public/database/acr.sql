-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 27, 2023 at 12:02 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.1.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `acr`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `firstname` varchar(255) DEFAULT NULL,
  `midname` varchar(255) DEFAULT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT 0 COMMENT '0 = yes\r\n1 = no',
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '0="InActive";1="Active" ',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `role_id`, `firstname`, `midname`, `lastname`, `email`, `password`, `address`, `remember_token`, `is_active`, `status`, `created_at`, `updated_at`) VALUES
(1, 3, 'admin', NULL, NULL, 'admin@acr.com', '$2y$10$1XFnIDVGedKIZonuFtg3GO/C2b5O81p4OniK8Is0P5Qjf2zP8nDf6', 'test address', NULL, 0, 1, '2021-04-27 23:24:27', '2023-07-27 05:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `car_brands`
--

CREATE TABLE `car_brands` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes,1=No',
  `status` tinyint(1) DEFAULT 0 COMMENT '0="In Active";1="Active"	',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `car_brands`
--

INSERT INTO `car_brands` (`id`, `slug`, `title`, `image`, `is_archive`, `status`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'maruti-suzuki', 'Maruti Suzuki', 'bottino16813205461690446408.jpg', 1, 1, 1, '2023-07-27 02:54:46', 1, '2023-07-27 02:56:48'),
(2, 'maruti-suzuiki', 'maruti suzuiki', 'bitcoin16813205461690446306.jpg', 0, 0, 1, '2023-07-27 02:55:06', 1, '2023-07-27 02:56:24'),
(3, 'tata', 'Tata', 'bottino16813205461690446498.jpg', 1, 1, 1, '2023-07-27 02:58:18', 1, '2023-07-27 04:27:23');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` int(11) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `state_id`) VALUES
(1, 'North and Middle Andaman', 32),
(2, 'South Andaman', 32),
(3, 'Nicobar', 32),
(4, 'Adilabad', 1),
(5, 'Anantapur', 1),
(6, 'Chittoor', 1),
(7, 'East Godavari', 1),
(8, 'Guntur', 1),
(9, 'Hyderabad', 1),
(10, 'Kadapa', 1),
(11, 'Karimnagar', 1),
(12, 'Khammam', 1),
(13, 'Krishna', 1),
(14, 'Kurnool', 1),
(15, 'Mahbubnagar', 1),
(16, 'Medak', 1),
(17, 'Nalgonda', 1),
(18, 'Nellore', 1),
(19, 'Nizamabad', 1),
(20, 'Prakasam', 1),
(21, 'Rangareddi', 1),
(22, 'Srikakulam', 1),
(23, 'Vishakhapatnam', 1),
(24, 'Vizianagaram', 1),
(25, 'Warangal', 1),
(26, 'West Godavari', 1),
(27, 'Anjaw', 3),
(28, 'Changlang', 3),
(29, 'East Kameng', 3),
(30, 'Lohit', 3),
(31, 'Lower Subansiri', 3),
(32, 'Papum Pare', 3),
(33, 'Tirap', 3),
(34, 'Dibang Valley', 3),
(35, 'Upper Subansiri', 3),
(36, 'West Kameng', 3),
(37, 'Barpeta', 2),
(38, 'Bongaigaon', 2),
(39, 'Cachar', 2),
(40, 'Darrang', 2),
(41, 'Dhemaji', 2),
(42, 'Dhubri', 2),
(43, 'Dibrugarh', 2),
(44, 'Goalpara', 2),
(45, 'Golaghat', 2),
(46, 'Hailakandi', 2),
(47, 'Jorhat', 2),
(48, 'Karbi Anglong', 2),
(49, 'Karimganj', 2),
(50, 'Kokrajhar', 2),
(51, 'Lakhimpur', 2),
(52, 'Marigaon', 2),
(53, 'Nagaon', 2),
(54, 'Nalbari', 2),
(55, 'North Cachar Hills', 2),
(56, 'Sibsagar', 2),
(57, 'Sonitpur', 2),
(58, 'Tinsukia', 2),
(59, 'Araria', 4),
(60, 'Aurangabad', 4),
(61, 'Banka', 4),
(62, 'Begusarai', 4),
(63, 'Bhagalpur', 4),
(64, 'Bhojpur', 4),
(65, 'Buxar', 4),
(66, 'Darbhanga', 4),
(67, 'Purba Champaran', 4),
(68, 'Gaya', 4),
(69, 'Gopalganj', 4),
(70, 'Jamui', 4),
(71, 'Jehanabad', 4),
(72, 'Khagaria', 4),
(73, 'Kishanganj', 4),
(74, 'Kaimur', 4),
(75, 'Katihar', 4),
(76, 'Lakhisarai', 4),
(77, 'Madhubani', 4),
(78, 'Munger', 4),
(79, 'Madhepura', 4),
(80, 'Muzaffarpur', 4),
(81, 'Nalanda', 4),
(82, 'Nawada', 4),
(83, 'Patna', 4),
(84, 'Purnia', 4),
(85, 'Rohtas', 4),
(86, 'Saharsa', 4),
(87, 'Samastipur', 4),
(88, 'Sheohar', 4),
(89, 'Sheikhpura', 4),
(90, 'Saran', 4),
(91, 'Sitamarhi', 4),
(92, 'Supaul', 4),
(93, 'Siwan', 4),
(94, 'Vaishali', 4),
(95, 'Pashchim Champaran', 4),
(96, 'Bastar', 36),
(97, 'Bilaspur', 36),
(98, 'Dantewada', 36),
(99, 'Dhamtari', 36),
(100, 'Durg', 36),
(101, 'Jashpur', 36),
(102, 'Janjgir-Champa', 36),
(103, 'Korba', 36),
(104, 'Koriya', 36),
(105, 'Kanker', 36),
(106, 'Kawardha', 36),
(107, 'Mahasamund', 36),
(108, 'Raigarh', 36),
(109, 'Rajnandgaon', 36),
(110, 'Raipur', 36),
(111, 'Surguja', 36),
(112, 'Diu', 29),
(113, 'Daman', 29),
(114, 'Central Delhi', 25),
(115, 'East Delhi', 25),
(116, 'New Delhi', 25),
(117, 'North Delhi', 25),
(118, 'North East Delhi', 25),
(119, 'North West Delhi', 25),
(120, 'South Delhi', 25),
(121, 'South West Delhi', 25),
(122, 'West Delhi', 25),
(123, 'North Goa', 26),
(124, 'South Goa', 26),
(125, 'Ahmedabad', 5),
(126, 'Amreli District', 5),
(127, 'Anand', 5),
(128, 'Banaskantha', 5),
(129, 'Bharuch', 5),
(130, 'Bhavnagar', 5),
(131, 'Dahod', 5),
(132, 'The Dangs', 5),
(133, 'Gandhinagar', 5),
(134, 'Jamnagar', 5),
(135, 'Junagadh', 5),
(136, 'Kutch', 5),
(137, 'Kheda', 5),
(138, 'Mehsana', 5),
(139, 'Narmada', 5),
(140, 'Navsari', 5),
(141, 'Patan', 5),
(142, 'Panchmahal', 5),
(143, 'Porbandar', 5),
(144, 'Rajkot', 5),
(145, 'Sabarkantha', 5),
(146, 'Surendranagar', 5),
(147, 'Surat', 5),
(148, 'Vadodara', 5),
(149, 'Valsad', 5),
(150, 'Ambala', 6),
(151, 'Bhiwani', 6),
(152, 'Faridabad', 6),
(153, 'Fatehabad', 6),
(154, 'Gurgaon', 6),
(155, 'Hissar', 6),
(156, 'Jhajjar', 6),
(157, 'Jind', 6),
(158, 'Karnal', 6),
(159, 'Kaithal', 6),
(160, 'Kurukshetra', 6),
(161, 'Mahendragarh', 6),
(162, 'Mewat', 6),
(163, 'Panchkula', 6),
(164, 'Panipat', 6),
(165, 'Rewari', 6),
(166, 'Rohtak', 6),
(167, 'Sirsa', 6),
(168, 'Sonepat', 6),
(169, 'Yamuna Nagar', 6),
(170, 'Palwal', 6),
(171, 'Bilaspur', 7),
(172, 'Chamba', 7),
(173, 'Hamirpur', 7),
(174, 'Kangra', 7),
(175, 'Kinnaur', 7),
(176, 'Kulu', 7),
(177, 'Lahaul and Spiti', 7),
(178, 'Mandi', 7),
(179, 'Shimla', 7),
(180, 'Sirmaur', 7),
(181, 'Solan', 7),
(182, 'Una', 7),
(183, 'Anantnag', 8),
(184, 'Badgam', 8),
(185, 'Bandipore', 8),
(186, 'Baramula', 8),
(187, 'Doda', 8),
(188, 'Jammu', 8),
(189, 'Kargil', 8),
(190, 'Kathua', 8),
(191, 'Kupwara', 8),
(192, 'Leh', 8),
(193, 'Poonch', 8),
(194, 'Pulwama', 8),
(195, 'Rajauri', 8),
(196, 'Srinagar', 8),
(197, 'Samba', 8),
(198, 'Udhampur', 8),
(199, 'Bokaro', 34),
(200, 'Chatra', 34),
(201, 'Deoghar', 34),
(202, 'Dhanbad', 34),
(203, 'Dumka', 34),
(204, 'Purba Singhbhum', 34),
(205, 'Garhwa', 34),
(206, 'Giridih', 34),
(207, 'Godda', 34),
(208, 'Gumla', 34),
(209, 'Hazaribagh', 34),
(210, 'Koderma', 34),
(211, 'Lohardaga', 34),
(212, 'Pakur', 34),
(213, 'Palamu', 34),
(214, 'Ranchi', 34),
(215, 'Sahibganj', 34),
(216, 'Seraikela and Kharsawan', 34),
(217, 'Pashchim Singhbhum', 34),
(218, 'Ramgarh', 34),
(219, 'Bidar', 9),
(220, 'Belgaum', 9),
(221, 'Bijapur', 9),
(222, 'Bagalkot', 9),
(223, 'Bellary', 9),
(224, 'Bangalore Rural District', 9),
(225, 'Bangalore Urban District', 9),
(226, 'Chamarajnagar', 9),
(227, 'Chikmagalur', 9),
(228, 'Chitradurga', 9),
(229, 'Davanagere', 9),
(230, 'Dharwad', 9),
(231, 'Dakshina Kannada', 9),
(232, 'Gadag', 9),
(233, 'Gulbarga', 9),
(234, 'Hassan', 9),
(235, 'Haveri District', 9),
(236, 'Kodagu', 9),
(237, 'Kolar', 9),
(238, 'Koppal', 9),
(239, 'Mandya', 9),
(240, 'Mysore', 9),
(241, 'Raichur', 9),
(242, 'Shimoga', 9),
(243, 'Tumkur', 9),
(244, 'Udupi', 9),
(245, 'Uttara Kannada', 9),
(246, 'Ramanagara', 9),
(247, 'Chikballapur', 9),
(248, 'Yadagiri', 9),
(249, 'Alappuzha', 10),
(250, 'Ernakulam', 10),
(251, 'Idukki', 10),
(252, 'Kollam', 10),
(253, 'Kannur', 10),
(254, 'Kasaragod', 10),
(255, 'Kottayam', 10),
(256, 'Kozhikode', 10),
(257, 'Malappuram', 10),
(258, 'Palakkad', 10),
(259, 'Pathanamthitta', 10),
(260, 'Thrissur', 10),
(261, 'Thiruvananthapuram', 10),
(262, 'Wayanad', 10),
(263, 'Alirajpur', 11),
(264, 'Anuppur', 11),
(265, 'Ashok Nagar', 11),
(266, 'Balaghat', 11),
(267, 'Barwani', 11),
(268, 'Betul', 11),
(269, 'Bhind', 11),
(270, 'Bhopal', 11),
(271, 'Burhanpur', 11),
(272, 'Chhatarpur', 11),
(273, 'Chhindwara', 11),
(274, 'Damoh', 11),
(275, 'Datia', 11),
(276, 'Dewas', 11),
(277, 'Dhar', 11),
(278, 'Dindori', 11),
(279, 'Guna', 11),
(280, 'Gwalior', 11),
(281, 'Harda', 11),
(282, 'Hoshangabad', 11),
(283, 'Indore', 11),
(284, 'Jabalpur', 11),
(285, 'Jhabua', 11),
(286, 'Katni', 11),
(287, 'Khandwa', 11),
(288, 'Khargone', 11),
(289, 'Mandla', 11),
(290, 'Mandsaur', 11),
(291, 'Morena', 11),
(292, 'Narsinghpur', 11),
(293, 'Neemuch', 11),
(294, 'Panna', 11),
(295, 'Rewa', 11),
(296, 'Rajgarh', 11),
(297, 'Ratlam', 11),
(298, 'Raisen', 11),
(299, 'Sagar', 11),
(300, 'Satna', 11),
(301, 'Sehore', 11),
(302, 'Seoni', 11),
(303, 'Shahdol', 11),
(304, 'Shajapur', 11),
(305, 'Sheopur', 11),
(306, 'Shivpuri', 11),
(307, 'Sidhi', 11),
(308, 'Singrauli', 11),
(309, 'Tikamgarh', 11),
(310, 'Ujjain', 11),
(311, 'Umaria', 11),
(312, 'Vidisha', 11),
(313, 'Ahmednagar', 12),
(314, 'Akola', 12),
(315, 'Amrawati', 12),
(316, 'Aurangabad', 12),
(317, 'Bhandara', 12),
(318, 'Beed', 12),
(319, 'Buldhana', 12),
(320, 'Chandrapur', 12),
(321, 'Dhule', 12),
(322, 'Gadchiroli', 12),
(323, 'Gondiya', 12),
(324, 'Hingoli', 12),
(325, 'Jalgaon', 12),
(326, 'Jalna', 12),
(327, 'Kolhapur', 12),
(328, 'Latur', 12),
(329, 'Mumbai City', 12),
(330, 'Mumbai suburban', 12),
(331, 'Nandurbar', 12),
(332, 'Nanded', 12),
(333, 'Nagpur', 12),
(334, 'Nashik', 12),
(335, 'Osmanabad', 12),
(336, 'Parbhani', 12),
(337, 'Pune', 12),
(338, 'Raigad', 12),
(339, 'Ratnagiri', 12),
(340, 'Sindhudurg', 12),
(341, 'Sangli', 12),
(342, 'Solapur', 12),
(343, 'Satara', 12),
(344, 'Thane', 12),
(345, 'Wardha', 12),
(346, 'Washim', 12),
(347, 'Yavatmal', 12),
(348, 'Bishnupur', 13),
(349, 'Churachandpur', 13),
(350, 'Chandel', 13),
(351, 'Imphal East', 13),
(352, 'Senapati', 13),
(353, 'Tamenglong', 13),
(354, 'Thoubal', 13),
(355, 'Ukhrul', 13),
(356, 'Imphal West', 13),
(357, 'East Garo Hills', 14),
(358, 'East Khasi Hills', 14),
(359, 'Jaintia Hills', 14),
(360, 'Ri-Bhoi', 14),
(361, 'South Garo Hills', 14),
(362, 'West Garo Hills', 14),
(363, 'West Khasi Hills', 14),
(364, 'Aizawl', 15),
(365, 'Champhai', 15),
(366, 'Kolasib', 15),
(367, 'Lawngtlai', 15),
(368, 'Lunglei', 15),
(369, 'Mamit', 15),
(370, 'Saiha', 15),
(371, 'Serchhip', 15),
(372, 'Dimapur', 16),
(373, 'Kohima', 16),
(374, 'Mokokchung', 16),
(375, 'Mon', 16),
(376, 'Phek', 16),
(377, 'Tuensang', 16),
(378, 'Wokha', 16),
(379, 'Zunheboto', 16),
(380, 'Angul', 17),
(381, 'Boudh', 17),
(382, 'Bhadrak', 17),
(383, 'Bolangir', 17),
(384, 'Bargarh', 17),
(385, 'Baleswar', 17),
(386, 'Cuttack', 17),
(387, 'Debagarh', 17),
(388, 'Dhenkanal', 17),
(389, 'Ganjam', 17),
(390, 'Gajapati', 17),
(391, 'Jharsuguda', 17),
(392, 'Jajapur', 17),
(393, 'Jagatsinghpur', 17),
(394, 'Khordha', 17),
(395, 'Kendujhar', 17),
(396, 'Kalahandi', 17),
(397, 'Kandhamal', 17),
(398, 'Koraput', 17),
(399, 'Kendrapara', 17),
(400, 'Malkangiri', 17),
(401, 'Mayurbhanj', 17),
(402, 'Nabarangpur', 17),
(403, 'Nuapada', 17),
(404, 'Nayagarh', 17),
(405, 'Puri', 17),
(406, 'Rayagada', 17),
(407, 'Sambalpur', 17),
(408, 'Subarnapur', 17),
(409, 'Sundargarh', 17),
(410, 'Karaikal', 27),
(411, 'Mahe', 27),
(412, 'Puducherry', 27),
(413, 'Yanam', 27),
(414, 'Amritsar', 18),
(415, 'Bathinda', 18),
(416, 'Firozpur', 18),
(417, 'Faridkot', 18),
(418, 'Fatehgarh Sahib', 18),
(419, 'Gurdaspur', 18),
(420, 'Hoshiarpur', 18),
(421, 'Jalandhar', 18),
(422, 'Kapurthala', 18),
(423, 'Ludhiana', 18),
(424, 'Mansa', 18),
(425, 'Moga', 18),
(426, 'Mukatsar', 18),
(427, 'Nawan Shehar', 18),
(428, 'Patiala', 18),
(429, 'Rupnagar', 18),
(430, 'Sangrur', 18),
(431, 'Ajmer', 19),
(432, 'Alwar', 19),
(433, 'Bikaner', 19),
(434, 'Barmer', 19),
(435, 'Banswara', 19),
(436, 'Bharatpur', 19),
(437, 'Baran', 19),
(438, 'Bundi', 19),
(439, 'Bhilwara', 19),
(440, 'Churu', 19),
(441, 'Chittorgarh', 19),
(442, 'Dausa', 19),
(443, 'Dholpur', 19),
(444, 'Dungapur', 19),
(445, 'Ganganagar', 19),
(446, 'Hanumangarh', 19),
(447, 'Juhnjhunun', 19),
(448, 'Jalore', 19),
(449, 'Jodhpur', 19),
(450, 'Jaipur', 19),
(451, 'Jaisalmer', 19),
(452, 'Jhalawar', 19),
(453, 'Karauli', 19),
(454, 'Kota', 19),
(455, 'Nagaur', 19),
(456, 'Pali', 19),
(457, 'Pratapgarh', 19),
(458, 'Rajsamand', 19),
(459, 'Sikar', 19),
(460, 'Sawai Madhopur', 19),
(461, 'Sirohi', 19),
(462, 'Tonk', 19),
(463, 'Udaipur', 19),
(464, 'East Sikkim', 20),
(465, 'North Sikkim', 20),
(466, 'South Sikkim', 20),
(467, 'West Sikkim', 20),
(468, 'Ariyalur', 21),
(469, 'Chennai', 21),
(470, 'Coimbatore', 21),
(471, 'Cuddalore', 21),
(472, 'Dharmapuri', 21),
(473, 'Dindigul', 21),
(474, 'Erode', 21),
(475, 'Kanchipuram', 21),
(476, 'Kanyakumari', 21),
(477, 'Karur', 21),
(478, 'Madurai', 21),
(479, 'Nagapattinam', 21),
(480, 'The Nilgiris', 21),
(481, 'Namakkal', 21),
(482, 'Perambalur', 21),
(483, 'Pudukkottai', 21),
(484, 'Ramanathapuram', 21),
(485, 'Salem', 21),
(486, 'Sivagangai', 21),
(487, 'Tiruppur', 21),
(488, 'Tiruchirappalli', 21),
(489, 'Theni', 21),
(490, 'Tirunelveli', 21),
(491, 'Thanjavur', 21),
(492, 'Thoothukudi', 21),
(493, 'Thiruvallur', 21),
(494, 'Thiruvarur', 21),
(495, 'Tiruvannamalai', 21),
(496, 'Vellore', 21),
(497, 'Villupuram', 21),
(498, 'Dhalai', 22),
(499, 'North Tripura', 22),
(500, 'South Tripura', 22),
(501, 'West Tripura', 22),
(502, 'Almora', 33),
(503, 'Bageshwar', 33),
(504, 'Chamoli', 33),
(505, 'Champawat', 33),
(506, 'Dehradun', 33),
(507, 'Haridwar', 33),
(508, 'Nainital', 33),
(509, 'Pauri Garhwal', 33),
(510, 'Pithoragharh', 33),
(511, 'Rudraprayag', 33),
(512, 'Tehri Garhwal', 33),
(513, 'Udham Singh Nagar', 33),
(514, 'Uttarkashi', 33),
(515, 'Agra', 23),
(516, 'Allahabad', 23),
(517, 'Aligarh', 23),
(518, 'Ambedkar Nagar', 23),
(519, 'Auraiya', 23),
(520, 'Azamgarh', 23),
(521, 'Barabanki', 23),
(522, 'Badaun', 23),
(523, 'Bagpat', 23),
(524, 'Bahraich', 23),
(525, 'Bijnor', 23),
(526, 'Ballia', 23),
(527, 'Banda', 23),
(528, 'Balrampur', 23),
(529, 'Bareilly', 23),
(530, 'Basti', 23),
(531, 'Bulandshahr', 23),
(532, 'Chandauli', 23),
(533, 'Chitrakoot', 23),
(534, 'Deoria', 23),
(535, 'Etah', 23),
(536, 'Kanshiram Nagar', 23),
(537, 'Etawah', 23),
(538, 'Firozabad', 23),
(539, 'Farrukhabad', 23),
(540, 'Fatehpur', 23),
(541, 'Faizabad', 23),
(542, 'Gautam Buddha Nagar', 23),
(543, 'Gonda', 23),
(544, 'Ghazipur', 23),
(545, 'Gorkakhpur', 23),
(546, 'Ghaziabad', 23),
(547, 'Hamirpur', 23),
(548, 'Hardoi', 23),
(549, 'Mahamaya Nagar', 23),
(550, 'Jhansi', 23),
(551, 'Jalaun', 23),
(552, 'Jyotiba Phule Nagar', 23),
(553, 'Jaunpur District', 23),
(554, 'Kanpur Dehat', 23),
(555, 'Kannauj', 23),
(556, 'Kanpur Nagar', 23),
(557, 'Kaushambi', 23),
(558, 'Kushinagar', 23),
(559, 'Lalitpur', 23),
(560, 'Lakhimpur Kheri', 23),
(561, 'Lucknow', 23),
(562, 'Mau', 23),
(563, 'Meerut', 23),
(564, 'Maharajganj', 23),
(565, 'Mahoba', 23),
(566, 'Mirzapur', 23),
(567, 'Moradabad', 23),
(568, 'Mainpuri', 23),
(569, 'Mathura', 23),
(570, 'Muzaffarnagar', 23),
(571, 'Pilibhit', 23),
(572, 'Pratapgarh', 23),
(573, 'Rampur', 23),
(574, 'Rae Bareli', 23),
(575, 'Saharanpur', 23),
(576, 'Sitapur', 23),
(577, 'Shahjahanpur', 23),
(578, 'Sant Kabir Nagar', 23),
(579, 'Siddharthnagar', 23),
(580, 'Sonbhadra', 23),
(581, 'Sant Ravidas Nagar', 23),
(582, 'Sultanpur', 23),
(583, 'Shravasti', 23),
(584, 'Unnao', 23),
(585, 'Varanasi', 23),
(586, 'Birbhum', 24),
(587, 'Bankura', 24),
(588, 'Bardhaman', 24),
(589, 'Darjeeling', 24),
(590, 'Dakshin Dinajpur', 24),
(591, 'Hooghly', 24),
(592, 'Howrah', 24),
(593, 'Jalpaiguri', 24),
(594, 'Cooch Behar', 24),
(595, 'Kolkata', 24),
(596, 'Malda', 24),
(597, 'Midnapore', 24),
(598, 'Murshidabad', 24),
(599, 'Nadia', 24),
(600, 'North 24 Parganas', 24),
(601, 'South 24 Parganas', 24),
(602, 'Purulia', 24),
(603, 'Uttar Dinajpur', 24);

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` int(5) NOT NULL,
  `countryCode` char(2) NOT NULL DEFAULT '',
  `name` varchar(45) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `countryCode`, `name`) VALUES
(1, 'AD', 'Andorra'),
(2, 'AE', 'United Arab Emirates'),
(3, 'AF', 'Afghanistan'),
(4, 'AG', 'Antigua and Barbuda'),
(5, 'AI', 'Anguilla'),
(6, 'AL', 'Albania'),
(7, 'AM', 'Armenia'),
(8, 'AO', 'Angola'),
(9, 'AQ', 'Antarctica'),
(10, 'AR', 'Argentina'),
(11, 'AS', 'American Samoa'),
(12, 'AT', 'Austria'),
(13, 'AU', 'Australia'),
(14, 'AW', 'Aruba'),
(15, 'AX', 'Åland'),
(16, 'AZ', 'Azerbaijan'),
(17, 'BA', 'Bosnia and Herzegovina'),
(18, 'BB', 'Barbados'),
(19, 'BD', 'Bangladesh'),
(20, 'BE', 'Belgium'),
(21, 'BF', 'Burkina Faso'),
(22, 'BG', 'Bulgaria'),
(23, 'BH', 'Bahrain'),
(24, 'BI', 'Burundi'),
(25, 'BJ', 'Benin'),
(26, 'BL', 'Saint Barthélemy'),
(27, 'BM', 'Bermuda'),
(28, 'BN', 'Brunei'),
(29, 'BO', 'Bolivia'),
(30, 'BQ', 'Bonaire'),
(31, 'BR', 'Brazil'),
(32, 'BS', 'Bahamas'),
(33, 'BT', 'Bhutan'),
(34, 'BV', 'Bouvet Island'),
(35, 'BW', 'Botswana'),
(36, 'BY', 'Belarus'),
(37, 'BZ', 'Belize'),
(38, 'CA', 'Canada'),
(39, 'CC', 'Cocos [Keeling] Islands'),
(40, 'CD', 'Democratic Republic of the Congo'),
(41, 'CF', 'Central African Republic'),
(42, 'CG', 'Republic of the Congo'),
(43, 'CH', 'Switzerland'),
(44, 'CI', 'Ivory Coast'),
(45, 'CK', 'Cook Islands'),
(46, 'CL', 'Chile'),
(47, 'CM', 'Cameroon'),
(48, 'CN', 'China'),
(49, 'CO', 'Colombia'),
(50, 'CR', 'Costa Rica'),
(51, 'CU', 'Cuba'),
(52, 'CV', 'Cape Verde'),
(53, 'CW', 'Curacao'),
(54, 'CX', 'Christmas Island'),
(55, 'CY', 'Cyprus'),
(56, 'CZ', 'Czech Republic'),
(57, 'DE', 'Germany'),
(58, 'DJ', 'Djibouti'),
(59, 'DK', 'Denmark'),
(60, 'DM', 'Dominica'),
(61, 'DO', 'Dominican Republic'),
(62, 'DZ', 'Algeria'),
(63, 'EC', 'Ecuador'),
(64, 'EE', 'Estonia'),
(65, 'EG', 'Egypt'),
(66, 'EH', 'Western Sahara'),
(67, 'ER', 'Eritrea'),
(68, 'ES', 'Spain'),
(69, 'ET', 'Ethiopia'),
(70, 'FI', 'Finland'),
(71, 'FJ', 'Fiji'),
(72, 'FK', 'Falkland Islands'),
(73, 'FM', 'Micronesia'),
(74, 'FO', 'Faroe Islands'),
(75, 'FR', 'France'),
(76, 'GA', 'Gabon'),
(77, 'GB', 'United Kingdom'),
(78, 'GD', 'Grenada'),
(79, 'GE', 'Georgia'),
(80, 'GF', 'French Guiana'),
(81, 'GG', 'Guernsey'),
(82, 'GH', 'Ghana'),
(83, 'GI', 'Gibraltar'),
(84, 'GL', 'Greenland'),
(85, 'GM', 'Gambia'),
(86, 'GN', 'Guinea'),
(87, 'GP', 'Guadeloupe'),
(88, 'GQ', 'Equatorial Guinea'),
(89, 'GR', 'Greece'),
(90, 'GS', 'South Georgia and the South Sandwich Islands'),
(91, 'GT', 'Guatemala'),
(92, 'GU', 'Guam'),
(93, 'GW', 'Guinea-Bissau'),
(94, 'GY', 'Guyana'),
(95, 'HK', 'Hong Kong'),
(96, 'HM', 'Heard Island and McDonald Islands'),
(97, 'HN', 'Honduras'),
(98, 'HR', 'Croatia'),
(99, 'HT', 'Haiti'),
(100, 'HU', 'Hungary'),
(101, 'ID', 'Indonesia'),
(102, 'IE', 'Ireland'),
(103, 'IL', 'Israel'),
(104, 'IM', 'Isle of Man'),
(105, 'IN', 'India'),
(106, 'IO', 'British Indian Ocean Territory'),
(107, 'IQ', 'Iraq'),
(108, 'IR', 'Iran'),
(109, 'IS', 'Iceland'),
(110, 'IT', 'Italy'),
(111, 'JE', 'Jersey'),
(112, 'JM', 'Jamaica'),
(113, 'JO', 'Jordan'),
(114, 'JP', 'Japan'),
(115, 'KE', 'Kenya'),
(116, 'KG', 'Kyrgyzstan'),
(117, 'KH', 'Cambodia'),
(118, 'KI', 'Kiribati'),
(119, 'KM', 'Comoros'),
(120, 'KN', 'Saint Kitts and Nevis'),
(121, 'KP', 'North Korea'),
(122, 'KR', 'South Korea'),
(123, 'KW', 'Kuwait'),
(124, 'KY', 'Cayman Islands'),
(125, 'KZ', 'Kazakhstan'),
(126, 'LA', 'Laos'),
(127, 'LB', 'Lebanon'),
(128, 'LC', 'Saint Lucia'),
(129, 'LI', 'Liechtenstein'),
(130, 'LK', 'Sri Lanka'),
(131, 'LR', 'Liberia'),
(132, 'LS', 'Lesotho'),
(133, 'LT', 'Lithuania'),
(134, 'LU', 'Luxembourg'),
(135, 'LV', 'Latvia'),
(136, 'LY', 'Libya'),
(137, 'MA', 'Morocco'),
(138, 'MC', 'Monaco'),
(139, 'MD', 'Moldova'),
(140, 'ME', 'Montenegro'),
(141, 'MF', 'Saint Martin'),
(142, 'MG', 'Madagascar'),
(143, 'MH', 'Marshall Islands'),
(144, 'MK', 'Macedonia'),
(145, 'ML', 'Mali'),
(146, 'MM', 'Myanmar [Burma]'),
(147, 'MN', 'Mongolia'),
(148, 'MO', 'Macao'),
(149, 'MP', 'Northern Mariana Islands'),
(150, 'MQ', 'Martinique'),
(151, 'MR', 'Mauritania'),
(152, 'MS', 'Montserrat'),
(153, 'MT', 'Malta'),
(154, 'MU', 'Mauritius'),
(155, 'MV', 'Maldives'),
(156, 'MW', 'Malawi'),
(157, 'MX', 'Mexico'),
(158, 'MY', 'Malaysia'),
(159, 'MZ', 'Mozambique'),
(160, 'NA', 'Namibia'),
(161, 'NC', 'New Caledonia'),
(162, 'NE', 'Niger'),
(163, 'NF', 'Norfolk Island'),
(164, 'NG', 'Nigeria'),
(165, 'NI', 'Nicaragua'),
(166, 'NL', 'Netherlands'),
(167, 'NO', 'Norway'),
(168, 'NP', 'Nepal'),
(169, 'NR', 'Nauru'),
(170, 'NU', 'Niue'),
(171, 'NZ', 'New Zealand'),
(172, 'OM', 'Oman'),
(173, 'PA', 'Panama'),
(174, 'PE', 'Peru'),
(175, 'PF', 'French Polynesia'),
(176, 'PG', 'Papua New Guinea'),
(177, 'PH', 'Philippines'),
(178, 'PK', 'Pakistan'),
(179, 'PL', 'Poland'),
(180, 'PM', 'Saint Pierre and Miquelon'),
(181, 'PN', 'Pitcairn Islands'),
(182, 'PR', 'Puerto Rico'),
(183, 'PS', 'Palestine'),
(184, 'PT', 'Portugal'),
(185, 'PW', 'Palau'),
(186, 'PY', 'Paraguay'),
(187, 'QA', 'Qatar'),
(188, 'RE', 'Réunion'),
(189, 'RO', 'Romania'),
(190, 'RS', 'Serbia'),
(191, 'RU', 'Russia'),
(192, 'RW', 'Rwanda'),
(193, 'SA', 'Saudi Arabia'),
(194, 'SB', 'Solomon Islands'),
(195, 'SC', 'Seychelles'),
(196, 'SD', 'Sudan'),
(197, 'SE', 'Sweden'),
(198, 'SG', 'Singapore'),
(199, 'SH', 'Saint Helena'),
(200, 'SI', 'Slovenia'),
(201, 'SJ', 'Svalbard and Jan Mayen'),
(202, 'SK', 'Slovakia'),
(203, 'SL', 'Sierra Leone'),
(204, 'SM', 'San Marino'),
(205, 'SN', 'Senegal'),
(206, 'SO', 'Somalia'),
(207, 'SR', 'Suriname'),
(208, 'SS', 'South Sudan'),
(209, 'ST', 'São Tomé and Príncipe'),
(210, 'SV', 'El Salvador'),
(211, 'SX', 'Sint Maarten'),
(212, 'SY', 'Syria'),
(213, 'SZ', 'Swaziland'),
(214, 'TC', 'Turks and Caicos Islands'),
(215, 'TD', 'Chad'),
(216, 'TF', 'French Southern Territories'),
(217, 'TG', 'Togo'),
(218, 'TH', 'Thailand'),
(219, 'TJ', 'Tajikistan'),
(220, 'TK', 'Tokelau'),
(221, 'TL', 'East Timor'),
(222, 'TM', 'Turkmenistan'),
(223, 'TN', 'Tunisia'),
(224, 'TO', 'Tonga'),
(225, 'TR', 'Turkey'),
(226, 'TT', 'Trinidad and Tobago'),
(227, 'TV', 'Tuvalu'),
(228, 'TW', 'Taiwan'),
(229, 'TZ', 'Tanzania'),
(230, 'UA', 'Ukraine'),
(231, 'UG', 'Uganda'),
(232, 'UM', 'U.S. Minor Outlying Islands'),
(233, 'US', 'United States'),
(234, 'UY', 'Uruguay'),
(235, 'UZ', 'Uzbekistan'),
(236, 'VA', 'Vatican City'),
(237, 'VC', 'Saint Vincent and the Grenadines'),
(238, 'VE', 'Venezuela'),
(239, 'VG', 'British Virgin Islands'),
(240, 'VI', 'U.S. Virgin Islands'),
(241, 'VN', 'Vietnam'),
(242, 'VU', 'Vanuatu'),
(243, 'WF', 'Wallis and Futuna'),
(244, 'WS', 'Samoa'),
(245, 'XK', 'Kosovo'),
(246, 'YE', 'Yemen'),
(247, 'YT', 'Mayotte'),
(248, 'ZA', 'South Africa'),
(249, 'ZM', 'Zambia'),
(250, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `email_templates`
--

CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL,
  `label` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `template` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `email_templates`
--

INSERT INTO `email_templates` (`id`, `label`, `value`, `template`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'contact_management', 'Contact Management', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;\r\n			<p>&nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></p>\r\n\r\n			<p>&nbsp;</p>\r\n			</div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello, ACR staff</em></p>\r\n\r\n			<p style=\"text-align:center\"><em>The following Contact form has been submitted. Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Name:</strong> [SENDER-NAME]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Email:</strong> [SENDER-EMAIL]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Subject:</strong>&nbsp;[SENDER-SUBJECT]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Message:</strong> [SENDER-MESSAGE]</p>\r\n\r\n			<p>&nbsp;</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023&nbsp;ACR. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2021-02-15 22:43:06', NULL, '2023-07-27 05:29:43'),
(2, 'contact_user', 'Contact User', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello,</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;&nbsp;Thank You for contacting ACR.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; We received the following information:&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\"><em>.Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Name:</strong> [SENDER-NAME]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Email:</strong> [SENDER-EMAIL]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Subject:</strong>&nbsp;[SENDER-SUBJECT]</p>\r\n\r\n			<p style=\"text-align:center\"><strong>Message:</strong> [SENDER-MESSAGE]</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;Your email will be replied shorlty.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023 ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2021-02-15 22:43:06', NULL, '2023-07-27 05:30:58'),
(9, 'welcome', 'Welcome After Register', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello [USER],</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; Thank you for register at ACR.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2022 ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-11 11:17:33', NULL, '2023-07-27 05:31:48'),
(10, 'forgot_password', 'Forgot Password', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello [USER],</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; You can create a new password using the following link:</p>\r\n\r\n			<p style=\"text-align:center\">[RESET-PASSWORD]&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\">If you have not requested a new password, you can ignore this email. Your current password will be retained</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023&nbsp;ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-11 11:25:23', NULL, '2023-07-27 05:32:38'),
(11, 'booked_service', 'Booked Service', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello,</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;&nbsp;&nbsp; &nbsp; We received the following information:&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\"><em>.Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Name:</strong> [SENDER-NAME]</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;Your email will be replied shorlty.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2022 TsgUsedCars</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-19 07:50:27', NULL, '2023-07-27 05:33:32'),
(12, 'cancel_service', 'Cancel Service', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello,</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;&nbsp;&nbsp; &nbsp; We received the following information:&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\"><em>.Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Name:</strong> [SENDER-NAME]</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;Your email will be replied shorlty.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023&nbsp;ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-19 08:00:28', NULL, '2023-07-27 05:34:27'),
(13, 'time_rearrange', 'Time Rearrange', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello,</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;&nbsp;&nbsp; &nbsp; We received the following information:&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\"><em>.Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Model:</strong> [SENDER-MAKER]</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;Your email will be replied shorlty.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023 ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-30 07:40:26', NULL, '2023-07-27 05:35:53'),
(14, 'request_appointment', 'Request Appointment', '<div style=\"border:1px solid #cccccc; display:contents; width:480px\">\r\n<table align=\"center\" cellpadding=\"0\" cellspacing=\"0\" class=\"mob_center\" style=\"width:60%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">&nbsp;<br />\r\n			&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;<img alt=\"\" src=\"http://localhost/acr/front/images/logo.png\" style=\"height:100px; margin-left:100px; margin-right:100px; width:300px\" /></div>\r\n\r\n			<div style=\"border-top:1px solid #cccccc; margin-bottom:0px; margin-left:50px; margin-right:50px; margin-top:0px\">&nbsp;</div>\r\n\r\n			<div class=\"container\" style=\"background:#ffffff; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><em>Hello,</em></p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;&nbsp;&nbsp; &nbsp; We received the following information:&nbsp;</p>\r\n\r\n			<p style=\"text-align:center\"><em>.Details as follows:&nbsp;</em></p>\r\n\r\n			<p style=\"text-align:center\"><strong>Model:</strong> [SENDER-MAKER]</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp;Your email will be replied shorlty.</p>\r\n\r\n			<p style=\"text-align:center\">&nbsp; &nbsp; Many Thanks.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td style=\"vertical-align:middle\">\r\n			<div class=\"container\" style=\"background:#eeeeee; padding:5px 10px\">\r\n			<p style=\"text-align:center\"><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">Copyright &copy; 2023&nbsp;ACR</span></span></span></span></span></span></span><span style=\"font-family:Roboto,RobotoDraft,Helvetica,Arial,sans-serif\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"font-size:medium\"><span style=\"color:#96a5b5\"><span style=\"font-size:13px\"><span style=\"font-family:Arial,Helvetica,sans-serif\"><span style=\"color:#96a5b5\">. All Rights Reserved</span></span></span></span></span></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>', NULL, '2023-01-30 07:41:46', NULL, '2023-07-27 05:36:48');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE `faq` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT 0 COMMENT '0=No;1=Yes',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`id`, `slug`, `name`, `description`, `is_archive`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'how-i-purchase-a-car-from', 'How I purchase a car from ?', '<p>It is very easy to buy a vehicle from our website. At first, create your own profile and then start searching the cars by the model, color, fuel economy and other features. We help you in communicating with the seller of your chosen car. You may speak to a vehicle consultant to assist you in your car test driveeee.</p>', 0, NULL, '2022-12-12 23:35:39', 1, '2022-12-21 05:31:51'),
(2, 'lorem-ipsum', 'Lorem Ipsum', '<p>Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;</p>', 0, NULL, '2022-12-12 23:36:51', 1, '2023-01-17 04:30:46'),
(3, 'how-will-i-sell-my-new-car', 'How will I sell my  new car?', '<p>Like the buyers, you must also create an account for selling any car. Our team helps you in listing the vehicle at our site. You have to send us the details of your car, and then, we will promote it at our websites added.</p>', 0, NULL, '2022-12-12 23:43:44', 1, '2022-12-12 23:44:14'),
(4, 'aaa', 'aaa', '<p>Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;Lorem Ipsum&nbsp;</p>', 0, NULL, '2022-12-13 01:05:27', 1, '2023-01-17 04:30:34'),
(5, 'asdsadsad', 'asdsadsad', '<p>You must return the Vehicle and use your store credit for a Replacement Vehicle within 7 calendar days of the date of this Order.</p>\r\n\r\n<p>&nbsp;</p>', 0, NULL, '2023-01-10 01:22:00', 1, '2023-01-17 04:30:13'),
(6, 'gfh', 'gfh', '<p>gfhgfh</p>', 1, NULL, '2023-01-20 22:39:37', 1, '2023-01-20 22:39:41'),
(7, 'asdasd', 'asdasd', '<p>sadasd</p>', 1, NULL, '2023-01-20 23:11:49', 1, '2023-01-20 23:12:21');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `carbrand_id` int(11) DEFAULT NULL COMMENT '`id` of `car_brands`',
  `title` varchar(255) DEFAULT NULL,
  `is_archive` tinyint(1) DEFAULT 1 COMMENT '0=Yes;1=No',
  `status` tinyint(1) DEFAULT 1 COMMENT '0="In Active";1="Active"',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`id`, `slug`, `carbrand_id`, `title`, `is_archive`, `status`, `created_at`, `created_by`, `updated_at`, `updated_by`) VALUES
(1, NULL, 1, 'AUDI A4', 0, 1, '2022-12-07 09:33:38', NULL, '2023-01-24 02:47:24', 1),
(2, NULL, 1, 'AUDI RS5', 0, 0, '2022-12-07 09:33:38', NULL, '2023-01-24 02:47:21', 1),
(3, 'redigo', 2, 'REDIGO', 0, 1, '2022-12-07 09:34:27', NULL, '2023-01-20 04:34:12', 1),
(4, NULL, 2, 'Chevrolet Sail U-VA', 0, 1, '2022-12-07 09:34:27', NULL, '2022-12-11 23:12:15', 1),
(5, 'aveo-uva', 12, 'AVEO UVA', 0, 1, '2022-12-11 23:10:52', 1, '2023-07-27 04:26:44', 1),
(6, 'aaa', 2, 'aaa', 0, 1, '2023-01-20 05:14:22', 1, '2023-01-31 05:11:00', 1),
(7, 'test5', 6, 'Test5', 0, 0, '2023-01-20 05:14:33', 1, '2023-01-20 22:12:11', 1),
(11, 'aveo-uva', 12, 'AVEO UVA', 0, 1, '2023-01-24 01:54:55', 1, '2023-01-24 01:55:03', 1),
(20, 'aaa', 2, 'aaa', 0, 1, '2023-01-24 02:50:41', 1, '2023-07-27 04:27:05', 1),
(21, 'aaa', 12, 'aaa', 0, 1, '2023-01-24 02:55:58', 1, '2023-07-27 04:27:01', 1),
(22, 'aa', 2, 'aa', 0, 1, '2023-01-24 02:56:32', 1, '2023-07-27 04:26:58', 1),
(23, 's15', 2, 'S15', 1, 0, '2023-01-24 03:46:12', 1, '2023-01-30 05:02:49', 1),
(24, 'aa', 15, 'aa', 0, 1, '2023-01-24 03:49:22', 1, '2023-07-27 04:26:53', 1),
(25, 'f5', 2, 'F5', 0, 1, '2023-01-30 23:51:47', 1, '2023-07-27 04:26:47', 1),
(26, '6757567', 3, '6757567', 1, 1, '2023-07-27 04:25:20', 1, '2023-07-27 04:28:16', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `is_archive` tinyint(4) DEFAULT 0 COMMENT '0=No;1=Yes',
  `meta_keyword` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `slug`, `name`, `description`, `is_archive`, `meta_keyword`, `meta_description`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'about-us', 'About Us', '<h3>About&nbsp;TSG Used Cars</h3>\r\n\r\n<p>TSG Used Cars is one of the most widely chosen platforms for selling and buying used cars. You can explore the best used cars inventory at great value. You can also expect a completely transparent transaction, large choice of inventory and finance options.</p>\r\n\r\n<p><img alt=\"\" src=\"https://loopcon.in/demo-hireshopifydeveloper-com/usedcar/front/img/feature-car.webp\" style=\"float:left; height:400px; width:400px\" /></p>\r\n\r\n<h2>&nbsp; &nbsp;<strong>&nbsp; &nbsp;</strong></h2>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h3>TSG Used Cars</h3>\r\n\r\n<p>We believe that the experience of buying a pre-owned car shouldn&rsquo;t be any different from that&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;of a new car. That is why we have a wide-ranging selection of used cars for sale, along with&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;services like insurance, finance and accessories, to ensure that you get all the car-buying&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;services under one roof..</p>\r\n\r\n<p style=\"text-align:justify\">&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h3>&nbsp;</h3>\r\n\r\n<h5>Where can I get some?</h5>\r\n\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don&#39;t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn&#39;t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h5>Where does it come from?.&nbsp;&nbsp;<img alt=\"\" src=\"https://tsgusedcars.com/public/uploads/sell_page_content/1550304581Tsgcarbazar_sellyourcar.jpg\" style=\"float:right; height:281px; width:500px\" /></h5>\r\n\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of &quot;de Finibus Bonorum et Malorum&quot; (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, &quot;Lorem ipsum dolor sit amet..&quot;, comes from a line in section 1.10.32.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from &quot;de Finibus Bonorum et Malorum&quot; by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>', 0, 'about us', 'There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable.', NULL, '2022-03-22 00:40:45', 1, '2023-02-16 04:40:24'),
(3, 'er', 'er', '<p>ert</p>', 1, NULL, NULL, NULL, '2022-11-11 01:56:41', 1, '2022-11-11 01:58:03'),
(4, 'contact', 'Contact', '<p><img alt=\"\" src=\"/acr/public/plugins/kcfinder/upload/images/16626189261661518844DSC04668%20(1).jpg\" style=\"height:3648px; width:5472px\" />Aaaa</p>', 1, 'aa', 'aa', NULL, '2022-12-12 22:45:17', 1, '2023-07-26 23:44:47'),
(9, 'test-page-er', 'Test Page Er', '<h2 dir=\"auto\">Debugging Mode</h2>\r\n\r\n<p dir=\"auto\">To enable debugging mode, just set&nbsp;<code>APP_DEBUG=true</code>&nbsp;and the package will include the queries and inputs used when processing the table.</p>\r\n\r\n<p dir=\"auto\"><strong>IMPORTANT:</strong>&nbsp;Please make sure that APP_DEBUG is set to false when your app is on production.</p>\r\n\r\n<h2 dir=\"auto\">PHP ARTISAN SERVE BUG</h2>\r\n\r\n<p dir=\"auto\">Please avoid using&nbsp;<code>php artisan serve</code>&nbsp;when developing with the package. There are known bugs when using this where Laravel randomly returns a redirect and 401 (Unauthorized) if the route requires authentication and a 404 NotFoundHttpException on valid routes.</p>\r\n\r\n<p dir=\"auto\">It is advised to use&nbsp;<a href=\"https://laravel.com/docs/5.4/homestead\" rel=\"nofollow\">Homestead</a>&nbsp;or&nbsp;<a href=\"https://laravel.com/docs/5.4/valet\" rel=\"nofollow\">Valet</a>&nbsp;when working with the package.</p>\r\n\r\n<p dir=\"auto\"><img alt=\"\" src=\"/acr/public/plugins/kcfinder/upload/images/16626189261661518844DSC04668%20(1).jpg\" style=\"height:67px; width:100px\" /></p>\r\n\r\n<p dir=\"auto\">&nbsp;</p>\r\n\r\n<p dir=\"auto\"><img alt=\"\" src=\"/acr/public/plugins/kcfinder/upload/images/cropped.jpg\" style=\"height:212px; width:377px\" /></p>', 1, 'test ff', 'dfgfdg', NULL, '2023-07-26 23:51:57', 1, '2023-07-26 23:52:34');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `label` varchar(100) DEFAULT NULL,
  `value` text DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_by` int(11) DEFAULT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `label`, `value`, `created_by`, `created_at`, `updated_by`, `updated_at`) VALUES
(1, 'Site Name', 'site_name', 'ACR', NULL, '2020-07-08 00:54:10', NULL, '2023-07-27 05:00:53'),
(2, 'Phone', 'phone', '8237823782', NULL, '2020-07-08 01:29:17', NULL, '2022-09-12 05:55:54'),
(3, 'Address', 'address', '5-Hsdf sdfh sdfhj,\r\nKsdhf sdf hsd sdfh sdjf,\r\nCIty.', NULL, '2020-07-08 01:29:43', NULL, '2023-01-04 04:59:04'),
(4, 'Contact Email', 'email', 'info@acr.com', NULL, '2020-07-08 01:32:25', NULL, '2023-07-27 05:00:53'),
(5, 'Facebook', 'facebook', 'facebook.com/Acr', NULL, '2020-07-08 01:33:07', NULL, '2023-07-27 05:00:53'),
(6, 'Twitter', 'twitter', 'twitter.com/Acr', NULL, '2020-07-08 01:33:34', NULL, '2023-07-27 05:00:53'),
(7, 'Instagram', 'instagram', 'instagram.com', NULL, '2020-07-08 01:33:52', NULL, '2022-09-12 05:55:54'),
(8, 'LinkedIn', 'linkedin', 'linkedin.com/company/acr/', NULL, '2020-07-08 01:34:19', NULL, '2023-07-27 05:01:22'),
(9, 'Whatsapp', 'whatsapp', '919205582202', NULL, '2020-07-08 01:34:37', NULL, '2023-03-29 05:07:58'),
(10, 'Fax', 'fax', '8192948588', NULL, '2020-08-01 00:53:25', NULL, '2022-09-12 05:55:54'),
(11, 'Copyright Year', 'copyright_year', '2023', NULL, '2020-09-05 00:59:17', NULL, '2023-07-27 05:01:22'),
(16, 'Cookie Consent', 'cookie_concent', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&#39;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', NULL, '2021-06-05 05:57:53', NULL, '2023-01-04 04:50:31'),
(17, 'Designed By', 'designed_by', 'ACR', NULL, '2022-08-22 05:46:19', NULL, '2023-07-27 05:01:29'),
(29, 'YouTube', 'youtube', 'youtube.com/channel/Acr', NULL, '2023-03-03 10:04:45', NULL, '2023-07-27 05:01:22'),
(30, 'Pinterest', 'pinterest', 'pinterest.com/Acr/', NULL, '2023-03-03 10:04:45', NULL, '2023-07-27 05:01:22'),
(31, 'Phone1', 'phone1', '9205582202', NULL, '2023-03-15 10:36:44', NULL, '2023-03-15 10:36:44'),
(32, 'Phone2', 'phone2', '9311953658', NULL, '2023-03-15 10:36:44', NULL, '2023-03-15 10:36:44');

-- --------------------------------------------------------

--
-- Table structure for table `smtp`
--

CREATE TABLE `smtp` (
  `id` int(11) NOT NULL,
  `sender_name` varchar(255) DEFAULT NULL,
  `mail_address` varchar(255) DEFAULT NULL,
  `mail_mailer` varchar(255) DEFAULT NULL,
  `mail_username` varchar(255) DEFAULT NULL,
  `mail_host` varchar(255) DEFAULT NULL,
  `mail_password` varchar(255) DEFAULT NULL,
  `mail_port` varchar(255) DEFAULT NULL,
  `mail_enc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `smtp`
--

INSERT INTO `smtp` (`id`, `sender_name`, `mail_address`, `mail_mailer`, `mail_username`, `mail_host`, `mail_password`, `mail_port`, `mail_enc`, `created_at`, `updated_at`) VALUES
(1, 'ACR', 'info@tsgusedcars.com', 'smtp', 'info@tsgusedcars.com', 'mail.tsgusedcars.com', 'p_Z!]D&Ve{4}', '465', 'ssl', '2022-03-22 00:40:16', '2023-07-26 23:53:54');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `country_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `country_id`) VALUES
(1, 'ANDHRA PRADESH', 105),
(2, 'ASSAM', 105),
(3, 'ARUNACHAL PRADESH', 105),
(4, 'BIHAR', 105),
(5, 'GUJRAT', 105),
(6, 'HARYANA', 105),
(7, 'HIMACHAL PRADESH', 105),
(8, 'JAMMU & KASHMIR', 105),
(9, 'KARNATAKA', 105),
(10, 'KERALA', 105),
(11, 'MADHYA PRADESH', 105),
(12, 'MAHARASHTRA', 105),
(13, 'MANIPUR', 105),
(14, 'MEGHALAYA', 105),
(15, 'MIZORAM', 105),
(16, 'NAGALAND', 105),
(17, 'ORISSA', 105),
(18, 'PUNJAB', 105),
(19, 'RAJASTHAN', 105),
(20, 'SIKKIM', 105),
(21, 'TAMIL NADU', 105),
(22, 'TRIPURA', 105),
(23, 'UTTAR PRADESH', 105),
(24, 'WEST BENGAL', 105),
(25, 'DELHI', 105),
(26, 'GOA', 105),
(27, 'PONDICHERY', 105),
(28, 'LAKSHDWEEP', 105),
(29, 'DAMAN & DIU', 105),
(30, 'DADRA & NAGAR', 105),
(31, 'CHANDIGARH', 105),
(32, 'ANDAMAN & NICOBAR', 105),
(33, 'UTTARANCHAL', 105),
(34, 'JHARKHAND', 105),
(35, 'CHATTISGARH', 105);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `car_brands`
--
ALTER TABLE `car_brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `email_templates`
--
ALTER TABLE `email_templates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faq`
--
ALTER TABLE `faq`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `smtp`
--
ALTER TABLE `smtp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `car_brands`
--
ALTER TABLE `car_brands`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=604;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=251;

--
-- AUTO_INCREMENT for table `email_templates`
--
ALTER TABLE `email_templates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `faq`
--
ALTER TABLE `faq`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `smtp`
--
ALTER TABLE `smtp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
