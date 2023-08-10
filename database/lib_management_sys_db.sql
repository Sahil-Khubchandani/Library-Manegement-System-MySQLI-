-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 07, 2023 at 03:04 PM
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
-- Database: `lib_management_sys`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `bookID` int(11) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `stock` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`bookID`, `bookName`, `stock`) VALUES
(1, 'Rich Dad Poor Dad', 19),
(2, 'Money Pshycology', 10),
(3, 'The power of money', 9);

-- --------------------------------------------------------

--
-- Table structure for table `book_issue_request`
--

CREATE TABLE `book_issue_request` (
  `id` int(255) NOT NULL,
  `studentID` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `bookName` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `issueDate` date DEFAULT NULL,
  `returnDate` date DEFAULT NULL,
  `returnedDate` date DEFAULT NULL,
  `penalty` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_issue_request`
--

INSERT INTO `book_issue_request` (`id`, `studentID`, `fullName`, `email`, `bookName`, `status`, `issueDate`, `returnDate`, `returnedDate`, `penalty`) VALUES
(1, '0001', 'Test User', 'testuser@gmail.com', 'Rich Dad Poor Dad', 3, '2023-06-15', '2023-07-15', '2023-08-07', 2300),
(2, '0001', 'Test User', 'testuser@gmail.com', 'Money Pshycology', 3, '2023-07-07', '2023-08-06', '2023-08-07', 100),
(3, '0001', 'Test User', 'testuser@gmail.com', 'The power of money', 3, '2023-07-15', '2023-08-14', '2023-08-07', 0),
(4, '0001', 'Test User', 'testuser@gmail.com', 'Rich Dad Poor Dad', 1, '2023-07-01', '2023-07-31', NULL, 0),
(5, '0001', 'Test User', 'testuser@gmail.com', 'The power of money', 2, NULL, NULL, NULL, 0),
(6, '0002', 'Test User1', 'testuser1@gmail.com', 'Rich Dad Poor Dad', 3, '2023-07-01', '2023-07-31', '2023-08-07', 700),
(7, '0002', 'Test User1', 'testuser1@gmail.com', 'The power of money', 1, '2023-08-07', '2023-09-06', NULL, 0),
(8, '0002', 'Test User1', 'testuser1@gmail.com', 'Money Pshycology', 0, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `mobileNumber` bigint(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `regDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`id`, `fullName`, `mobileNumber`, `email`, `password`, `regDate`) VALUES
(1, 'Mr. Admin', 1234567890, 'admin@gmail.com', 'admin@1234', '2023-07-28 17:49:45');

-- --------------------------------------------------------

--
-- Table structure for table `student_details`
--

CREATE TABLE `student_details` (
  `id` int(11) NOT NULL,
  `studentID` varchar(255) NOT NULL,
  `fullName` varchar(255) NOT NULL,
  `mobileNumber` bigint(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `regDate` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_details`
--

INSERT INTO `student_details` (`id`, `studentID`, `fullName`, `mobileNumber`, `password`, `email`, `address`, `regDate`) VALUES
(1, '0001', 'Test User', 1234567890, '1234567890', 'testuser@gmail.com', 'Surat', '2023-07-31 17:01:00'),
(2, '0002', 'Test User1', 987654321, '987654321', 'testuser1@gmail.com', 'Surat', '2023-08-02 17:09:59'),
(3, '0003', 'Test User2', 1234509876, '1234509876', 'testuser2@gmail.com', 'Surat', '2023-08-02 17:16:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`bookID`);

--
-- Indexes for table `book_issue_request`
--
ALTER TABLE `book_issue_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_details`
--
ALTER TABLE `student_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `studentID` (`studentID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `bookID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `book_issue_request`
--
ALTER TABLE `book_issue_request`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `student_details`
--
ALTER TABLE `student_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
