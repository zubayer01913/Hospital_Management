-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2015 at 02:11 PM
-- Server version: 5.6.24
-- PHP Version: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `password`) VALUES
(1, 'admin', 'Shahinur Rahman', '21232f297a57a5a743894a0e4a801fc3');

-- --------------------------------------------------------

--
-- Table structure for table `blood`
--

CREATE TABLE IF NOT EXISTS `blood` (
  `b_id` int(11) NOT NULL,
  `b_pic` varchar(255) NOT NULL,
  `b_username` varchar(255) NOT NULL,
  `b_name` varchar(255) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `stock` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `b_status` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL,
  `b_password` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood`
--

INSERT INTO `blood` (`b_id`, `b_pic`, `b_username`, `b_name`, `sex`, `age`, `blood_group`, `stock`, `contact`, `b_status`, `address`, `email`, `add_date`, `b_password`) VALUES
(2, '01717510809.jpg', 'limon1234', 'limon1234', 'Male', '19', 'A+', '2 pounds', '01717510809', 'available', 'dhaka', 'sagor.city@gmail.com', '12-5-2015', '25d55ad283aa400af464c76d713c07ad'),
(3, '0172076876.jpg', 'zubayer1234', 'zubayer bin ayub', 'Male', '18', 'O-', '1pound', '0172076876', 'available', 'dhaka', 'sagor.city@gmail.com', '12-6-2015', '25d55ad283aa400af464c76d713c07ad'),
(4, '01717510805.jpg', 'shagor1234', 'shagor hossain', 'Male', '27', 'AB+', '3 pounds', '01717510805', 'available', 'dhaka', 'sagor@gmail.com', '12-7-15', 'e10adc3949ba59abbe56e057f20f883e'),
(5, '015171712893.jpg', 'rimon1234', 'Rimon Kumar Sarker', 'Male', '27', 'A-', '2 pound', '015171712893', 'available', 'dahaka', 'rimnks@gmail.com', '11-11-13', '25d55ad283aa400af464c76d713c07ad');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `c_id` int(11) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `add_date`) VALUES
(1, 'Post2', '');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `c_id` int(11) NOT NULL,
  `your_name` varchar(255) NOT NULL,
  `your_email` varchar(255) NOT NULL,
  `your_message` text NOT NULL,
  `c_date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`c_id`, `your_name`, `your_email`, `your_message`, `c_date`) VALUES
(1, 'hi', 'liton@gmail.com', 'hi', '2015-07-02'),
(2, 'hi', 'liton@gmail.com', 'kkkkkkkkkkkkkk', '2015-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `doc_id` int(11) NOT NULL,
  `doc_pic` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `doc_username` varchar(100) NOT NULL,
  `sex` varchar(100) NOT NULL,
  `birthday` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `speciality` varchar(255) NOT NULL,
  `consulting_hour` varchar(255) NOT NULL,
  `consulting_day` varchar(255) NOT NULL,
  `room_no` int(11) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `doc_password` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doc_id`, `doc_pic`, `name`, `doc_username`, `sex`, `birthday`, `designation`, `speciality`, `consulting_hour`, `consulting_day`, `room_no`, `address`, `email`, `contact`, `doc_password`, `add_date`) VALUES
(2, '01674548464.jpg', 'Shahinur Rahman', 'shahinur0077', 'Male', '21-08-1988', 'Assistant Professor', 'Medicine', '6 PM - 10 PM', 'Sat - Wed', 202, 'Dhaka', 'shahinur@gmail.com', '01674548464', 'e10adc3949ba59abbe56e057f20f883e', '2015-08-02'),
(4, '019453667643.jpg', 'rimon1234', 'Rimon Kumar Sarker', 'Male', '31-12-1988', 'Proffessor', 'ENT', '8:00 AM - 8:00 PM', 'SUN-SAT', 123, 'dghdnmmn', 'rks@hospital.com', '019453667643', 'e10adc3949ba59abbe56e057f20f883e', '2015-09-14'),
(6, '01717510809.jpg', 'shumonmalakar', 'shumon malakar', 'Male', '02-01-2009', 'Proffessor', 'ENT', '8:00 AM - 8:00 PM', 'tues-sun', 123, 'dhaka', 'sumon@gmail.com', '01717510809', '25d55ad283aa400af464c76d713c07ad', '2015-10-28'),
(7, '01717510807.jpg', 'zubayer', 'zubayer bin ayub', 'Male', '02-01-2008', 'assistant professor', 'medicine', '9-11am', 'sun-wed', 506, 'bangladesh', 'emailQgmail.com', '01717510807', '25d55ad283aa400af464c76d713c07ad', '2015-10-28'),
(8, '01721123456.jpg', 'limon1234', 'shahadat hossain', 'Male', '01-01-2009', 'assistant professor', 'medicine', '8:00 AM - 8:00 PM', 'tues-sun', 503, 'dhaka', 'limon@gmail.com', '01721123456', '25d55ad283aa400af464c76d713c07ad', '2015-10-28'),
(9, '01670685285.jpg', 'biplob', 'jahidul islam', 'Male', '02-01-2009', 'assistant professor', 'ENT', '9am-1pm', 'tues-sun', 503, 'dhaka', 'biplab@gmail.com', '01670685285', '25d55ad283aa400af464c76d713c07ad', '2015-10-28');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE IF NOT EXISTS `patients` (
  `p_id` int(11) NOT NULL,
  `p_pic` varchar(255) NOT NULL,
  `p_username` varchar(30) NOT NULL,
  `p_name` varchar(255) NOT NULL,
  `p_password` varchar(100) NOT NULL,
  `age` int(11) NOT NULL,
  `sex` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `type_of_disease` varchar(255) NOT NULL,
  `treating_doctor` varchar(255) NOT NULL,
  `room_no` int(11) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `p_status` varchar(255) NOT NULL,
  `total_bill` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `add_date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`p_id`, `p_pic`, `p_username`, `p_name`, `p_password`, `age`, `sex`, `blood_group`, `type_of_disease`, `treating_doctor`, `room_no`, `contact`, `p_status`, `total_bill`, `address`, `email`, `add_date`) VALUES
(2, '01719022565.jpg', 'liton', 'Shahinur Rahman', 'e10adc3949ba59abbe56e057f20f883e', 26, 'Male', 'B+', 'Fever', 'Rashed', 302, '01719022565', 'Not good', '300/=', 'Dhaka', 'shahinur0077@gmail.com', '02-08-2015'),
(3, '01720768768.jpg', 'jhasdghj', 'rimonddsfs', '25d55ad283aa400af464c76d713c07ad', 12, 'Male', '0-', 'fever', 'Dr. hassan', 0, '01720768768', 'on treatment', '300', 'dhaka', 'realmahmudulhasan@gmail.com', '12/6/1991'),
(4, '01717117878.jpg', 'shariful1234', 'sharifu lislam', '25d55ad283aa400af464c76d713c07ad', 26, 'Male', 'A+', 'fever', 'Dr. rimon', 506, '01717117878', 'on treatment', '300', 'dhaka', 'rimon@gamil.com', '12-5-91'),
(5, '0172076876.jpg', 'zubayer1234', 'zubayer bin ayub', '25d55ad283aa400af464c76d713c07ad', 12, 'Male', '0-', 'fever', 'Dr. rimon', 123, '0172076876', 'on treatment', '300', 'dhaka', 'rks@hospital.com', '12-6-2915'),
(6, '01670685284.jpg', 'biplob1234', 'jahidul islam', '25d55ad283aa400af464c76d713c07ad', 28, 'Male', 'O-', 'diarrhoea', 'Dr. Shagor', 308, '01670685284', 'on treatment', '400', 'dhaka', 'email@gmail.com', '12-6-2014');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE IF NOT EXISTS `post` (
  `post_id` int(11) NOT NULL,
  `post_title` varchar(255) NOT NULL,
  `post_details` text NOT NULL,
  `post_pic` varchar(255) NOT NULL,
  `c_name` varchar(255) NOT NULL,
  `post_date` varchar(255) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `post_details`, `post_pic`, `c_name`, `post_date`) VALUES
(2, 'Dell Inspiron 5420', '<p>kkkkkkkkkkk</p>\r\n', '2.jpg', 'Post2', '22-Aug-2015');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blood`
--
ALTER TABLE `blood`
  ADD PRIMARY KEY (`b_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doc_id`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`p_id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `blood`
--
ALTER TABLE `blood`
  MODIFY `b_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doc_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
