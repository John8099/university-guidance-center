-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 13, 2023 at 02:58 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblanswer`
--

CREATE TABLE `tblanswer` (
  `AnswerID` int(11) UNSIGNED NOT NULL,
  `Question` text NOT NULL,
  `Category` varchar(255) NOT NULL,
  `WellnessType` varchar(255) NOT NULL,
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `Answer` varchar(255) DEFAULT NULL,
  `Score` decimal(10,2) UNSIGNED DEFAULT NULL,
  `Negative` decimal(10,2) DEFAULT NULL,
  `Neutral` decimal(10,2) DEFAULT NULL,
  `Positive` decimal(10,2) DEFAULT NULL,
  `Compound` decimal(10,2) DEFAULT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `ResultID` int(11) UNSIGNED NOT NULL,
  `QuestionID` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblanswer`
--

INSERT INTO `tblanswer` (`AnswerID`, `Question`, `Category`, `WellnessType`, `WellnessCheckID`, `Answer`, `Score`, `Negative`, `Neutral`, `Positive`, `Compound`, `CreatedOn`, `CreatedBy`, `ResultID`, `QuestionID`) VALUES
(1, 'You regular make new friends.', 'Physical Wellness', 'Quantitative', 1, '1', '1.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 1),
(2, 'You spend a lot of your free time exploring various random topics that pique your interest.', 'Physical Wellness', 'Quantitative', 1, '2', '2.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 2),
(3, 'Seeing other people cry can easily make you feel like you want to cry too.', 'Physical Wellness', 'Quantitative', 1, '2', '2.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 3),
(4, 'You often make a backup plan for a backup plan.', 'Physical Wellness', 'Quantitative', 1, '3', '3.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 4),
(5, 'You usually stay calm, even under a lot of pressure.', 'Physical Wellness', 'Quantitative', 1, '3', '3.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 5),
(6, 'At social events, you rarely try to introduce yourself to new people and mostly talk to the ones you already know.', 'Physical Wellness', 'Quantitative', 1, '4', '4.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 6),
(7, 'You prefer to completely finish one project before starting another.', 'Physical Wellness', 'Quantitative', 1, '4', '4.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 7),
(8, 'You are very sentimental.', 'Physical Wellness', 'Quantitative', 1, '4', '4.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 8),
(9, 'You like to use organizing tools like schedules and lists.', 'Physical Wellness', 'Quantitative', 1, '4', '4.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 9),
(10, 'Even a small mistake can cause you to doubt your overall abilities and knowledge.', 'Physical Wellness', 'Quantitative', 1, '4', '4.00', '0.00', '0.00', '0.00', '0.00', '2023-01-13 09:51:00', 10, 1, 10),
(11, '4', 'NONE', 'Qualitative', 4, 'good', '0.00', '0.00', '0.00', '1.00', '0.44', '2023-01-13 09:51:44', 10, 2, 20),
(12, '4', 'NONE', 'Qualitative', 4, 'good', '0.00', '0.00', '0.00', '1.00', '0.44', '2023-01-13 09:51:44', 10, 2, 21),
(13, '4', 'NONE', 'Qualitative', 4, 'good', '0.00', '0.00', '0.00', '1.00', '0.44', '2023-01-13 09:51:44', 10, 2, 22),
(14, '4', 'NONE', 'Qualitative', 4, 'good', '0.00', '0.00', '0.00', '1.00', '0.44', '2023-01-13 09:51:44', 10, 2, 23),
(15, '4', 'NONE', 'Qualitative', 4, 'good', '0.00', '0.00', '0.00', '1.00', '0.44', '2023-01-13 09:51:44', 10, 2, 24);

-- --------------------------------------------------------

--
-- Table structure for table `tblappointment`
--

CREATE TABLE `tblappointment` (
  `AppointmentID` int(11) UNSIGNED NOT NULL,
  `Referrer` varchar(255) NOT NULL,
  `StudentName` varchar(255) NOT NULL,
  `YearSection` varchar(255) NOT NULL,
  `Address` text NOT NULL,
  `PhoneNumber` varchar(255) NOT NULL,
  `OtherContact` varchar(255) NOT NULL,
  `Platform` varchar(255) NOT NULL,
  `PreferredTime` varchar(255) NOT NULL,
  `SelectedDate` date DEFAULT NULL,
  `Category` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Pending',
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `CollegeID` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `AppointmentSchedID` int(11) UNSIGNED NOT NULL,
  `Remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblappointment`
--

INSERT INTO `tblappointment` (`AppointmentID`, `Referrer`, `StudentName`, `YearSection`, `Address`, `PhoneNumber`, `OtherContact`, `Platform`, `PreferredTime`, `SelectedDate`, `Category`, `Email`, `Status`, `CreatedOn`, `CreatedBy`, `CollegeID`, `AppointmentSchedID`, `Remarks`) VALUES
(1, 'Admin', 'King Kong', 'CAS 4D', 'Manila', '09126152211', '09126152211', 'Face to Face', '10:00 AM - 11:00 AM', '2023-01-10', 'Personal', 'kingkong@wvsu.edu.ph', 'Pending', '2023-01-09 18:44:12', 1, 2, 7, ''),
(2, '', 'Horry Potter', '3E', 'Manila', '09713765121', '4123', 'Face to Face', '9:00 AM - 10:00 AM', '2023-01-11', 'Personal', 'horrypotter@wvsu.edu.ph', 'Completed', '2023-01-09 19:10:05', 10, 1, 10, 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor '),
(3, '', 'Horry Potter', '3E', 'Manila', '09713765121', '09713765121', 'Face to Face', '8:00 AM - 9:00 AM', '2023-01-11', 'Academic', 'horrypotter@wvsu.edu.ph', 'Rescheduled', '2023-01-09 19:20:28', 10, 1, 8, ''),
(4, '', 'Horry Potter', '3E', 'Manila', '09713765121', '09713765121', 'Google Meet', '10:00 AM - 11:00 AM', '2023-01-12', 'Social', 'horrypotter@wvsu.edu.ph', 'Pending', '2023-01-09 20:41:02', 10, 1, 9, '');

-- --------------------------------------------------------

--
-- Table structure for table `tblappointmentsched`
--

CREATE TABLE `tblappointmentsched` (
  `AppointmentSchedID` int(11) UNSIGNED NOT NULL,
  `AppointmentDate` date NOT NULL,
  `AppointmentTime` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Active',
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblappointmentsched`
--

INSERT INTO `tblappointmentsched` (`AppointmentSchedID`, `AppointmentDate`, `AppointmentTime`, `Status`, `CreatedOn`, `CreatedBy`) VALUES
(1, '2023-01-04', '8:00 AM - 9:00 AM', 'Occupied', '2023-01-03 14:03:42', 1),
(2, '2023-01-04', '1:00 PM - 2:00 PM', 'Occupied', '2023-01-03 15:14:56', 10),
(3, '2023-01-11', '8:00 AM - 9:00 AM', 'Occupied', '2023-01-08 20:45:13', 1),
(4, '2023-01-11', '9:00 AM - 10:00 AM', 'Occupied', '2023-01-08 22:18:47', 1),
(5, '2023-01-17', '10:00 AM - 11:00 AM', 'Occupied', '2023-01-08 22:39:28', 1),
(6, '2023-01-13', '8:00 AM - 9:00 AM', 'Occupied', '2023-01-08 23:30:06', 1),
(7, '2023-01-10', '10:00 AM - 11:00 AM', 'Occupied', '2023-01-09 13:46:47', 1),
(8, '2023-01-11', '8:00 AM - 9:00 AM', 'Occupied', '2023-01-09 17:40:26', 1),
(9, '2023-01-12', '10:00 AM - 11:00 AM', 'Occupied', '2023-01-09 17:40:57', 1),
(10, '2023-01-11', '9:00 AM - 10:00 AM', 'Occupied', '2023-01-09 17:58:16', 2),
(11, '2023-01-11', '8:00 AM - 9:00 AM', 'Active', '2023-01-09 21:54:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblassessment`
--

CREATE TABLE `tblassessment` (
  `AssessmentID` int(11) UNSIGNED NOT NULL,
  `Assessment` varchar(255) NOT NULL,
  `Semester` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Inactive',
  `NumberQuestion` int(11) UNSIGNED NOT NULL,
  `NumberQuestionSent` int(11) UNSIGNED NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblassessment`
--

INSERT INTO `tblassessment` (`AssessmentID`, `Assessment`, `Semester`, `Status`, `NumberQuestion`, `NumberQuestionSent`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'Wellness Check 2023', '2nd', '1', 5, 3, '2023-01-06 09:01:59', 1),
(2, 'Emotional Wellness', '1st', 'Inactive', 6, 6, '2023-01-07 04:07:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcollege`
--

CREATE TABLE `tblcollege` (
  `CollegeID` int(11) UNSIGNED NOT NULL,
  `College` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblcollege`
--

INSERT INTO `tblcollege` (`CollegeID`, `College`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'CICT', '2022-07-09 16:41:45', 0),
(2, 'CAS', '2022-07-09 16:41:50', 0),
(3, 'CBM', '2022-07-09 16:41:55', 0),
(4, 'COC', '2022-07-09 16:42:01', 0),
(5, 'CON', '2022-07-09 16:42:06', 0),
(6, 'COM', '2022-07-09 16:42:11', 0),
(8, 'COE', '2022-11-23 00:58:21', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblnotification`
--

CREATE TABLE `tblnotification` (
  `NotificationID` int(11) UNSIGNED NOT NULL,
  `Notification` text NOT NULL,
  `NotificationTo` int(11) UNSIGNED NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Unread',
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblnotification`
--

INSERT INTO `tblnotification` (`NotificationID`, `Notification`, `NotificationTo`, `Status`, `CreatedOn`, `CreatedBy`) VALUES
(1, '213123', 2, 'Unread', '2023-01-08 23:36:54', 1),
(2, 'Hello JOhn! Your scheduled appointment on 2023-01-11 9:00 AM - 10:00 AM with  is approved. See you there!', 35, 'Unread', '2023-01-08 23:38:07', 1),
(3, 'Hello JOhn! Your scheduled appointment on 2023-01-13 8:00 AM - 9:00 AM with  is approved. See you there!', 35, 'Unread', '2023-01-08 23:38:58', 1),
(4, 'Hello JOhn! Your scheduled appointment on 2023-01-13 8:00 AM - 9:00 AM with Admin is approved. See you there!', 35, 'Unread', '2023-01-08 23:41:44', 1),
(5, 'Hello Horry Potter! Your scheduled appointment on 2023-01-11 9:00 AM - 10:00 AM with Admin CAS is approved. See you there!', 10, 'Unread', '2023-01-09 19:20:52', 1),
(6, 'Hello Horry Potter! Your scheduled appointment on 2023-01-11 8:00 AM - 9:00 AM with Superadmin is approved. See you there!', 10, 'Unread', '2023-01-09 20:09:38', 1),
(7, 'Hello Horry Potter! Your scheduled appointment on 2023-01-11 8:00 AM - 9:00 AM with Superadmin is rescheduled.', 10, 'Unread', '2023-01-09 20:09:45', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblquestion`
--

CREATE TABLE `tblquestion` (
  `QuestionID` int(11) UNSIGNED NOT NULL,
  `Question` text NOT NULL,
  `QuestionNumber` int(11) UNSIGNED NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Type` varchar(255) NOT NULL,
  `AssessmentID` int(11) UNSIGNED NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblquestion`
--

INSERT INTO `tblquestion` (`QuestionID`, `Question`, `QuestionNumber`, `Category`, `Type`, `AssessmentID`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'You prefer to completely finish one project before starting another.', 1, 'SentanceBased', '', 1, '2023-01-06 09:06:34', 1),
(2, 'You are very sentimental.', 2, 'SentanceBased', '', 1, '2023-01-06 09:06:34', 1),
(3, 'You like to use organizing tools like schedules.', 3, 'SentanceBased', '', 1, '2023-01-06 09:06:34', 1),
(4, 'You regularly make new friends.', 1, 'MultipleChoice', '', 1, '2023-01-06 09:06:34', 1),
(5, 'You spend a lot of your free time exploring various random topics that pique your interest.', 2, 'MultipleChoice', '', 1, '2023-01-06 09:06:34', 1),
(6, 'Seeing other people cry can easily make you fell like you want to cry too.', 3, 'MultipleChoice', '', 1, '2023-01-06 09:06:34', 1),
(7, 'You often make a backup plan for a backup plan.', 4, 'MultipleChoice', '', 1, '2023-01-06 09:06:34', 1),
(8, 'You usually stay calm, even under a lot of pressure.', 5, 'MultipleChoice', '', 1, '2023-01-06 09:06:34', 1),
(9, 'q1s', 1, 'SentanceBased', '', 2, '2023-01-07 04:12:54', 1),
(10, 'q2s', 2, 'SentanceBased', '', 2, '2023-01-07 04:12:54', 1),
(11, 'q4s', 3, 'SentanceBased', '', 2, '2023-01-07 04:12:54', 1),
(12, 'q5s', 4, 'SentanceBased', '', 2, '2023-01-07 04:12:55', 1),
(13, 'q6s', 5, 'SentanceBased', '', 2, '2023-01-07 04:12:55', 1),
(14, 'q6s', 6, 'SentanceBased', '', 2, '2023-01-07 04:12:55', 1),
(15, 'q1s', 1, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1),
(16, 'q2s', 2, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1),
(17, 'q3s', 3, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1),
(18, 'q4s', 4, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1),
(19, 'q5s', 5, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1),
(20, 'q6s', 6, 'MultipleChoice', '', 2, '2023-01-07 04:12:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblquestionbank`
--

CREATE TABLE `tblquestionbank` (
  `QuestionID` int(11) UNSIGNED NOT NULL,
  `Question` text NOT NULL,
  `Category` varchar(255) NOT NULL,
  `Status` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblquestionbank`
--

INSERT INTO `tblquestionbank` (`QuestionID`, `Question`, `Category`, `Status`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'You prefer to completely finish one project before starting another.', 'Sentiment Analysis Questions', 1, '2023-01-06 00:00:00', 1),
(2, 'You are very sentimental.', 'Sentiment Analysis Questions', 1, '2023-01-06 00:00:00', 1),
(3, 'You like to use organizing tools like schedules.', 'Sentiment Analysis Questions', 1, '2023-01-06 00:00:00', 1),
(4, 'You regularly make new friends.', 'Quantitative Questions', 1, '2023-01-06 00:00:00', 1),
(5, 'You spend a lot of your free time exploring various random topics that pique your interest.', 'Quantitative Questions', 1, '2023-01-06 00:00:00', 1),
(6, 'Seeing other people cry can easily make you fell like you want to cry too.', 'Quantitative Questions', 1, '2023-01-06 00:00:00', 1),
(7, 'You often make a backup plan for a backup plan.', 'Quantitative Questions', 1, '2023-01-06 00:00:00', 1),
(8, 'You usually stay calm, even under a lot of pressure.', 'Quantitative Questions', 1, '2023-01-06 00:00:00', 1),
(9, 'tests', 'Quantitative Questions', 2, '2023-01-05 00:00:00', 1),
(10, 'test', 'Quantitative Questions', 0, '2023-01-07 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblresult`
--

CREATE TABLE `tblresult` (
  `ResultID` int(11) UNSIGNED NOT NULL,
  `Remarks` varchar(255) NOT NULL,
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `QScore` int(11) UNSIGNED NOT NULL,
  `SScore` decimal(10,2) NOT NULL,
  `Results` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblresult`
--

INSERT INTO `tblresult` (`ResultID`, `Remarks`, `WellnessCheckID`, `QScore`, `SScore`, `Results`, `CreatedOn`, `CreatedBy`) VALUES
(1, '', 1, 31, '0.00', '', '2023-01-13 09:51:00', 10),
(2, '', 4, 0, '5.00', 'Positive', '2023-01-13 09:51:44', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tblresultquan`
--

CREATE TABLE `tblresultquan` (
  `ResultQuanID` int(11) UNSIGNED NOT NULL,
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `ResultID` int(11) UNSIGNED NOT NULL,
  `Category` varchar(255) NOT NULL,
  `IdealScore` int(11) UNSIGNED NOT NULL,
  `Score` int(11) UNSIGNED NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblresultquan`
--

INSERT INTO `tblresultquan` (`ResultQuanID`, `WellnessCheckID`, `ResultID`, `Category`, `IdealScore`, `Score`, `CreatedOn`, `CreatedBy`) VALUES
(1, 1, 1, 'Physical Wellness', 40, 31, '2023-01-13 09:51:00', 10);

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `UserID` int(11) UNSIGNED NOT NULL,
  `HashedPassword` varchar(255) NOT NULL,
  `Fullname` varchar(255) NOT NULL,
  `UserType` varchar(255) NOT NULL DEFAULT 'Administrator',
  `Address` text NOT NULL,
  `IdentifiedGender` int(11) NOT NULL DEFAULT 0 COMMENT '0 = Female, 1 = Male',
  `BiologicalSex` varchar(255) NOT NULL,
  `Course` varchar(255) NOT NULL,
  `YearSec` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `SchoolID` varchar(255) NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Active',
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `CollegeID` int(11) UNSIGNED NOT NULL,
  `DateBirth` date DEFAULT NULL,
  `PlaceBirth` varchar(255) DEFAULT NULL,
  `SexualOrientation` varchar(255) DEFAULT NULL,
  `SexBirth` varchar(255) DEFAULT NULL,
  `Nationality` varchar(255) DEFAULT NULL,
  `Religion` varchar(255) DEFAULT NULL,
  `CivilStatus` varchar(255) DEFAULT NULL,
  `MobileNo` varchar(255) DEFAULT NULL,
  `TelephoneNo` varchar(255) DEFAULT NULL,
  `DSWDHouseholdNo` varchar(255) DEFAULT NULL,
  `Disability` varchar(255) DEFAULT NULL,
  `Region` varchar(255) DEFAULT NULL,
  `Province` varchar(255) DEFAULT NULL,
  `MunicipalityCity` varchar(255) DEFAULT NULL,
  `Barangay` varchar(255) DEFAULT NULL,
  `ZipCode` varchar(255) DEFAULT NULL,
  `ACRNo` varchar(255) DEFAULT NULL,
  `PlacedIssued` varchar(255) DEFAULT NULL,
  `DateIssued` varchar(255) DEFAULT NULL,
  `AuthorizedStay` varchar(255) DEFAULT NULL,
  `PassportNo` varchar(255) DEFAULT NULL,
  `PassportExpixy` varchar(255) DEFAULT NULL,
  `DateArrival` varchar(255) DEFAULT NULL,
  `VisaType` varchar(255) DEFAULT NULL,
  `VisaStatus` varchar(255) DEFAULT NULL,
  `ImageLoc` varchar(255) DEFAULT 'dummy-profile-pic.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`UserID`, `HashedPassword`, `Fullname`, `UserType`, `Address`, `IdentifiedGender`, `BiologicalSex`, `Course`, `YearSec`, `Email`, `SchoolID`, `Status`, `CreatedOn`, `CreatedBy`, `CollegeID`, `DateBirth`, `PlaceBirth`, `SexualOrientation`, `SexBirth`, `Nationality`, `Religion`, `CivilStatus`, `MobileNo`, `TelephoneNo`, `DSWDHouseholdNo`, `Disability`, `Region`, `Province`, `MunicipalityCity`, `Barangay`, `ZipCode`, `ACRNo`, `PlacedIssued`, `DateIssued`, `AuthorizedStay`, `PassportNo`, `PassportExpixy`, `DateArrival`, `VisaType`, `VisaStatus`, `ImageLoc`) VALUES
(1, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Superadmin', 'Superadmin', '', 1, '', '', '', 'superadmin@wvsu.edu.ph', 'superadmin', 'Active', '2023-01-09 00:54:10', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'bb166a9efc46efed2a6bf974e60eb92f.jpg'),
(2, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin CAS', 'Administrator', '', 0, '', '', '', 'admincas@wvsu.edu.ph', '2023L00002', 'Active', '2023-01-09 01:26:21', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(3, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin CICT', 'Administrator', '', 1, '', '', '', 'admincict@wvsu.edu.ph', '2023W00003', 'Active', '2023-01-09 01:28:27', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(4, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin CBM', 'Administrator', '', 0, '', '', '', 'admincbm@wvsu.edu.ph', '2023V00004', 'Active', '2023-01-09 01:28:00', 0, 3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(5, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin COC', 'Administrator', '', 1, '', '', '', 'admincoc@wvsu.edu.ph', '2023Q00005', 'Active', '2023-01-09 01:29:34', 0, 4, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(6, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin CON', 'Administrator', '', 0, '', '', '', 'admincom@wvsu.edu.ph', '2023J00006', 'Active', '2023-01-09 01:30:27', 0, 5, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(7, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin COM', 'Administrator', '', 0, '', '', '', 'admincom@wvsu.edu.ph', '2023U00007', 'Active', '2023-01-09 01:30:50', 0, 6, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(8, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin COE', 'Administrator', '', 1, '', '', '', 'admincoe@wvsu.edu.ph', '2023N00008', 'Active', '2023-01-09 01:31:15', 0, 8, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(9, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Admin CICT', 'Administrator', '', 0, '', '', '', 'admincict@wvsu.edu.ph', '2023A00009', 'Inactive', '2023-01-09 01:36:59', 0, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(10, '03ac674216f3e15c761ee1a5e255f067953623c8b388b4459e13f978d7c846f4', 'Horry Potter', 'Student', 'Manila', 0, 'Male', 'BSIT', '3E', '', '04-1314-01944', 'Active', '2023-01-09 12:56:16', 0, 2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '8654961a64c7443db12710f5d1ebc756.png');

-- --------------------------------------------------------

--
-- Table structure for table `tblwellnessanswer`
--

CREATE TABLE `tblwellnessanswer` (
  `WellnessAnswerID` int(11) UNSIGNED NOT NULL,
  `Question` text NOT NULL,
  `QuestionNumber` int(11) UNSIGNED NOT NULL,
  `Category` varchar(255) NOT NULL,
  `WellnessType` varchar(255) NOT NULL,
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Disable',
  `IsPublish` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblwellnesscheck`
--

CREATE TABLE `tblwellnesscheck` (
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `Title` varchar(255) NOT NULL,
  `WellnessType` varchar(255) NOT NULL,
  `NumberQuestion` int(11) UNSIGNED NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Disable',
  `EndDate` varchar(255) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblwellnesscheck`
--

INSERT INTO `tblwellnesscheck` (`WellnessCheckID`, `Title`, `WellnessType`, `NumberQuestion`, `Status`, `EndDate`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'Personality Test', 'Quantitative', 10, 'Enable', '30', '2023-01-09 00:00:00', 1),
(3, 'sadasd', 'Quantitative', 3, 'Disable', '30', '2023-01-10 00:00:00', 1),
(4, 'hjgjk', 'Qualitative', 5, 'Enable', '15', '2023-01-10 00:00:00', 1),
(5, 'dsasa', 'Qualitative', 12, 'Disable', '15', '2023-01-11 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblwellnessquestion`
--

CREATE TABLE `tblwellnessquestion` (
  `QuestionID` int(11) UNSIGNED NOT NULL,
  `Question` text NOT NULL,
  `QuestionNumber` int(11) UNSIGNED NOT NULL,
  `Category` varchar(255) NOT NULL,
  `WellnessType` varchar(255) NOT NULL,
  `WellnessCheckID` int(11) UNSIGNED NOT NULL,
  `Status` varchar(255) NOT NULL DEFAULT 'Disable',
  `IsPublish` int(11) UNSIGNED NOT NULL DEFAULT 0,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblwellnessquestion`
--

INSERT INTO `tblwellnessquestion` (`QuestionID`, `Question`, `QuestionNumber`, `Category`, `WellnessType`, `WellnessCheckID`, `Status`, `IsPublish`, `CreatedOn`, `CreatedBy`) VALUES
(1, 'You regular make new friends.', 1, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:02', 1),
(2, 'You spend a lot of your free time exploring various random topics that pique your interest.', 2, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(3, 'Seeing other people cry can easily make you feel like you want to cry too.', 3, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(4, 'You often make a backup plan for a backup plan.', 4, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(5, 'You usually stay calm, even under a lot of pressure.', 5, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(6, 'At social events, you rarely try to introduce yourself to new people and mostly talk to the ones you already know.', 6, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(7, 'You prefer to completely finish one project before starting another.', 7, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(8, 'You are very sentimental.', 8, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(9, 'You like to use organizing tools like schedules and lists.', 9, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(10, 'Even a small mistake can cause you to doubt your overall abilities and knowledge.', 10, 'Physical Wellness', 'Quantitative', 1, 'Disable', 0, '2023-01-09 13:46:03', 1),
(14, 'asdasd', 1, 'Emotional Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:10:48', 1),
(15, 'asdasd', 2, 'Emotional Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:10:48', 1),
(16, 'asdasdasd', 3, 'Emotional Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:10:48', 1),
(17, 'asdas', 1, 'Environmental Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:11:03', 1),
(18, 'asd', 2, 'Environmental Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:11:03', 1),
(19, 'asd', 3, 'Environmental Wellness', 'Quantitative', 3, 'Disable', 0, '2023-01-09 22:11:03', 1),
(20, 'sadasd', 1, 'NONE', 'Qualitative', 4, 'Disable', 0, '2023-01-09 22:18:44', 1),
(21, 'asd', 2, 'NONE', 'Qualitative', 4, 'Disable', 0, '2023-01-09 22:18:44', 1),
(22, 'asd', 3, 'NONE', 'Qualitative', 4, 'Disable', 0, '2023-01-09 22:18:44', 1),
(23, 'asd', 4, 'NONE', 'Qualitative', 4, 'Disable', 0, '2023-01-09 22:18:44', 1),
(24, 'ad', 5, 'NONE', 'Qualitative', 4, 'Disable', 0, '2023-01-09 22:18:44', 1),
(25, 'dzczx', 1, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(26, 'zxc', 2, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(27, 'zxc', 3, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(28, 'zxc', 4, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(29, 'zxc', 5, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(30, 'zxc', 6, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(31, 'zxc', 7, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(32, 'zxc', 8, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(33, 'zxc', 9, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:53', 1),
(34, 'zxc', 10, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:54', 1),
(35, 'zxc', 11, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:54', 1),
(36, 'zxc', 12, 'NONE', 'Qualitative', 5, 'Disable', 0, '2023-01-09 22:54:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblwellnessquestionpublish`
--

CREATE TABLE `tblwellnessquestionpublish` (
  `PublishID` int(11) UNSIGNED NOT NULL,
  `QuestionID` int(11) UNSIGNED NOT NULL,
  `WeekPublish` int(11) NOT NULL,
  `CreatedOn` datetime NOT NULL DEFAULT current_timestamp(),
  `CreatedBy` int(11) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblanswer`
--
ALTER TABLE `tblanswer`
  ADD PRIMARY KEY (`AnswerID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `WellnessCheckID` (`WellnessCheckID`),
  ADD KEY `ResultID` (`ResultID`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- Indexes for table `tblappointment`
--
ALTER TABLE `tblappointment`
  ADD PRIMARY KEY (`AppointmentID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `CollegeID` (`CollegeID`),
  ADD KEY `AppointmentSchedID` (`AppointmentSchedID`);

--
-- Indexes for table `tblappointmentsched`
--
ALTER TABLE `tblappointmentsched`
  ADD PRIMARY KEY (`AppointmentSchedID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `tblassessment`
--
ALTER TABLE `tblassessment`
  ADD PRIMARY KEY (`AssessmentID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `tblcollege`
--
ALTER TABLE `tblcollege`
  ADD PRIMARY KEY (`CollegeID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `tblnotification`
--
ALTER TABLE `tblnotification`
  ADD PRIMARY KEY (`NotificationID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `NotificationTo` (`NotificationTo`);

--
-- Indexes for table `tblquestion`
--
ALTER TABLE `tblquestion`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `AssessmentID` (`AssessmentID`);

--
-- Indexes for table `tblquestionbank`
--
ALTER TABLE `tblquestionbank`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `tblresult`
--
ALTER TABLE `tblresult`
  ADD PRIMARY KEY (`ResultID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `WellnessCheckID` (`WellnessCheckID`);

--
-- Indexes for table `tblresultquan`
--
ALTER TABLE `tblresultquan`
  ADD PRIMARY KEY (`ResultQuanID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `WellnessCheckID` (`WellnessCheckID`),
  ADD KEY `ResultID` (`ResultID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`UserID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `UserType` (`UserType`),
  ADD KEY `CollegeID` (`CollegeID`);

--
-- Indexes for table `tblwellnessanswer`
--
ALTER TABLE `tblwellnessanswer`
  ADD PRIMARY KEY (`WellnessAnswerID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `WellnessCheckID` (`WellnessCheckID`);

--
-- Indexes for table `tblwellnesscheck`
--
ALTER TABLE `tblwellnesscheck`
  ADD PRIMARY KEY (`WellnessCheckID`),
  ADD KEY `CreatedBy` (`CreatedBy`);

--
-- Indexes for table `tblwellnessquestion`
--
ALTER TABLE `tblwellnessquestion`
  ADD PRIMARY KEY (`QuestionID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `WellnessCheckID` (`WellnessCheckID`);

--
-- Indexes for table `tblwellnessquestionpublish`
--
ALTER TABLE `tblwellnessquestionpublish`
  ADD PRIMARY KEY (`PublishID`),
  ADD KEY `CreatedBy` (`CreatedBy`),
  ADD KEY `QuestionID` (`QuestionID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tblanswer`
--
ALTER TABLE `tblanswer`
  MODIFY `AnswerID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblappointment`
--
ALTER TABLE `tblappointment`
  MODIFY `AppointmentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblappointmentsched`
--
ALTER TABLE `tblappointmentsched`
  MODIFY `AppointmentSchedID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `tblassessment`
--
ALTER TABLE `tblassessment`
  MODIFY `AssessmentID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcollege`
--
ALTER TABLE `tblcollege`
  MODIFY `CollegeID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblnotification`
--
ALTER TABLE `tblnotification`
  MODIFY `NotificationID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblquestion`
--
ALTER TABLE `tblquestion`
  MODIFY `QuestionID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblquestionbank`
--
ALTER TABLE `tblquestionbank`
  MODIFY `QuestionID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblresult`
--
ALTER TABLE `tblresult`
  MODIFY `ResultID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblresultquan`
--
ALTER TABLE `tblresultquan`
  MODIFY `ResultQuanID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `UserID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tblwellnessanswer`
--
ALTER TABLE `tblwellnessanswer`
  MODIFY `WellnessAnswerID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblwellnesscheck`
--
ALTER TABLE `tblwellnesscheck`
  MODIFY `WellnessCheckID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblwellnessquestion`
--
ALTER TABLE `tblwellnessquestion`
  MODIFY `QuestionID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `tblwellnessquestionpublish`
--
ALTER TABLE `tblwellnessquestionpublish`
  MODIFY `PublishID` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
