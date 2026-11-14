-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 14, 2026 at 01:55 PM
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
-- Database: `travexa_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `about`
--

CREATE TABLE `about` (
  `id` int(11) NOT NULL,
  `student_id` varchar(20) NOT NULL,
  `member_name` varchar(100) NOT NULL,
  `part1_contribution` text NOT NULL,
  `part2_contribution` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `about`
--

INSERT INTO `about` (`id`, `student_id`, `member_name`, `part1_contribution`, `part2_contribution`) VALUES
(1, '106728599', 'Soo Kian Meng', 'Worked on merging GitHub and designing the structure for apply.html and about.html.', 'Converted website pages into PHP using reusable include files. Created the EOI database table. Responsible for database connection, form data processing, database insertion, EOI number generation and display in process_eoi.php. '),
(2, '106728609', 'Pang Hui Xin', 'Responsible for header design and CSS styling for apply and about page.', 'Developed the About database and dynamic About page. Responsible for server-side validation and security in process_eoi.php, including POST checking, input validation, data sanitisation, error handling, automatic EOI table creation.'),
(3, '106729071', 'Jarome Loo', 'Worked on sorting Jira and designing the structure for index.html and jobs.html.', 'Developed the HR Manager login and Manage Page, including displaying all EOI records, searching by job reference and applicant name, deleting records, updating application status and sorting records.'),
(4, '106730934', 'Lee Xiao Yan', 'Responsible for CSS styling for index and jobs page.', 'Configured the database connection settings in settings.php. Created the Job database table and developed the dynamic Jobs page to retrieve, display and search job listings from the database.');

-- --------------------------------------------------------

--
-- Table structure for table `destinations`
--

CREATE TABLE `destinations` (
  `Id` int(11) NOT NULL,
  `Country Name` varchar(50) NOT NULL,
  `Cities` text NOT NULL,
  `Description` text NOT NULL,
  `Images` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `destinations`
--

INSERT INTO `destinations` (`Id`, `Country Name`, `Cities`, `Description`, `Images`) VALUES
(1, 'Japan', 'Tokyo\r\nHokkaido\r\nOsaka\r\nKyoto\r\nShikoku', 'Blend ancient traditions with modern wonders. From Tokyo\'s neon lights to Kyoto\'s serene temples, Japan offers an unforgettable journey.', 'Images/tokyo.jpg\r\nImages/hokkaido.jpg\r\nImages/osaka.jpg\r\nImages/kyoto.jpg\r\nImages/shikoku.jpg\r\n\r\n'),
(2, 'China', 'Beijing\r\nShanghai\r\nGuangzhou\r\nShenzhen\r\nChengdu', 'Ancient wonders meet modern marvels. Explore the Great Wall, bustling megacities, and rich cultural heritage.\r\n', 'Images/beijing.jpg\r\nImages/shanghai.jpg\r\nImages/guangzhou.jpg\r\nImages/shenzhen.jpg\r\nImages/chengdu.jpg'),
(3, 'Greece', 'Athens\r\nThessaloniki\r\nCrete\r\nRhodes\r\nCorfu', 'Where history meets the sea. Discover ancient ruins, sun-drenched islands, and Mediterranean charm.', 'Images/athens.jpg\r\nImages/thessaloniki.jpg\r\nImages/crete.jpg\r\nImages/rhodes.jpg\r\nImages/corfu.jpg'),
(4, 'Korea', 'Seoul\r\nBusan\r\nJeju Island\r\nIncheon\r\nGyeongju', 'Tradition and trend in perfect harmony. Experience vibrant cities, serene temples, and breathtaking island landscapes.\r\n', 'Images/seoul.jpg\r\nImages/busan.jpg\r\nImages/jeju_island.jpg\r\nImages/incheon.jpg\r\nImages/gyeongju.jpg'),
(5, 'Indonesia', 'Jakarta\r\nBali\r\nSurabaya\r\nMedan\r\nBandung', 'A tropical paradise of diverse cultures. From bustling Jakarta to the serene beaches of Bali.', 'Images/jakarta.jpg\r\nImages/bali.jpg\r\nImages/surabaya.jpg\r\nImages/medan.jpg\r\nImages/bandung.jpg'),
(6, 'United States', 'New York\r\nLos Angeles\r\nChicago\r\nMiami\r\nSan Francisco', 'From coast to coast, endless possibilities. Experience iconic cities, stunning national parks, and diverse cultures.', 'Images/new_york.jpg\r\nImages/los_angeles.jpg\r\nImages/chicago.jpg\r\nImages/miami.jpg\r\nImages/san_francisco.jpg'),
(7, 'Australia', 'Sydney\r\nMelbourne\r\nBrisbane\r\nPerth\r\nAdelaide', 'Where nature and modern life collide. Explore vibrant cities, stunning beaches, and unique wildlife.', 'Images/sydney.jpg\r\nImages/melbourne.jpg\r\nImages/brisbane.jpg\r\nImages/perth.jpg\r\nImages/adelaide.jpg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `EOINumber` int(11) NOT NULL,
  `jobRefNum` varchar(5) NOT NULL,
  `firstName` varchar(20) NOT NULL,
  `lastName` varchar(20) NOT NULL,
  `dateOfBirth` varchar(10) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `streetAddress` varchar(40) NOT NULL,
  `suburbTown` varchar(40) NOT NULL,
  `state` varchar(3) NOT NULL,
  `postcode` varchar(5) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phoneNumber` varchar(12) NOT NULL,
  `skills` varchar(100) DEFAULT NULL,
  `otherSkills` text DEFAULT NULL,
  `status` enum('New','Current','Final') DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `Reference Number` varchar(10) NOT NULL,
  `Title` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `Responsibilities` text NOT NULL,
  `Essential Requirements` text NOT NULL,
  `Preferred Qualifications` text NOT NULL,
  `Salary` varchar(100) NOT NULL,
  `Reporting to` varchar(100) NOT NULL,
  `Images` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `jobs`
--

INSERT INTO `jobs` (`Reference Number`, `Title`, `description`, `Responsibilities`, `Essential Requirements`, `Preferred Qualifications`, `Salary`, `Reporting to`, `Images`) VALUES
('TRV26', 'Data Enginner', 'Building and maintaining data pipelines that turn all flight, hotel, and booking events into insights for pricing, marketing, and operations teams.', 'Design and maintain scalable data pipelines to process large volumes of data.\r\nCollaborate with teams to understand data requirements and deliver business solutions.\r\nImplement data quality checks, monitoring, and optimize storage for performance.\r\nStay updated with emerging technologies and best practices in data engineering.', 'Bachelor\'s degree in Computer Science, Data Engineering, or a related field.\r\nProven experience as a Data Engineer or similar role, with a strong knowledge of ETL processes.\r\nProficiency in programming languages such as Python, Java, or Scala.\r\nExperience with big data technologies (e.g., Hadoop, Spark) and cloud platforms (e.g., AWS, GCP, Azure).\r\nStrong problem-solving skills and teamwork skills.', 'Master\'s degree in Computer Science, Data Engineering, or a related field.\r\nExperience with Machine Learning and Artificial Intelligence Technologies.', '$4000-$8000 per month + Performance Bonus', 'Lead Data Engineer and Head of Data & Analytics', 'Images/engineer.jpg'),
('TRV27', 'IT Support Specialist', 'Providing technical support and assistance to end-users, troubleshooting hardware and software issues, and ensuring the smooth operation of IT systems within the organization.', 'Provide technical support to end-users via phone, email, or in-person.\r\nTroubleshoot hardware, software and peripheral issues across the company.\r\nInstall, configure, and maintain computer systems and applications.\r\nMonitor IT infrastructure and document support activities and resolutions.', 'Bachelor\'s degree in Information Technology, Computer Science, or a related field.\r\nProven experience as an IT Support Specialist or similar role.\r\nStrong knowledge of computer systems, networks, and software applications.\r\nExcellent problem-solving, communication, and teamwork skills.', 'Certifications such as CompTIA A+, Microsoft Certified IT Professional (MCITP), or Cisco Certified Network Associate (CCNA).\r\nExperience with cloud-based technologies and virtualization.', '$3000-$5000 per month + Performance Bonus', 'IT Manager', 'Images/itspecialist.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$6Zqte8zMDoTujt02ieyS5uYQj4Fuxbga86jYWo9zKRHUUg/eAoKfS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about`
--
ALTER TABLE `about`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `destinations`
--
ALTER TABLE `destinations`
  ADD PRIMARY KEY (`Id`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`EOINumber`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`Reference Number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `about`
--
ALTER TABLE `about`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `destinations`
--
ALTER TABLE `destinations`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `EOINumber` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
