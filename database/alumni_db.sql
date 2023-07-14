-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 09, 2023 at 08:55 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alumni_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnus_bio`
--

CREATE TABLE `alumnus_bio` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `firstname` varchar(200) NOT NULL,
  `middlename` varchar(200) NOT NULL,
  `lastname` varchar(200) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `batch` year(4) NOT NULL,
  `course_id` int(30) NOT NULL,
  `email` varchar(250) NOT NULL,
  `connected_to` text NOT NULL,
  `avatar` text NOT NULL,
  `date_created` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `alumnus_bio`
--

INSERT INTO `alumnus_bio` (`id`, `user_id`, `firstname`, `middlename`, `lastname`, `gender`, `batch`, `course_id`, `email`, `connected_to`, `avatar`, `date_created`) VALUES
(1, 2, 'Jonas', 'Greiser', 'Snow', 'Male', '2009', 1, 'jonas@gmail.com', 'Google Inc', 'alumni.jpg', '2020-10-15'),
(2, 4, 'Willette', 'Letherbury', 'Danzey', 'Female', '2008', 10, 'danzey@gmail.com', 'Wikido', '1688142480_g1.jpg', '2023-07-01'),
(15, 80, 'Codee', 'Hatchell', 'Harradine', 'Male', '2004', 9, 'harradine@gmail.com', 'Jabberbean', '1688148060_g2.jpg', '2023-07-01'),
(16, 81, 'Shalna', 'Burdus', 'McGuinley', 'Female', '1994', 9, 'mcguinley@gmail.com', 'Livetube', '1688148120_g3.jpg', '2023-07-01'),
(17, 82, 'Korrie', 'Jadczak', 'Orpee', 'Female', '2006', 2, 'orpee@gmail.com', 'Twinte', '1688148180_g4.jpg', '2023-07-01'),
(18, 83, 'Ula', 'Niles', 'Coare', 'Female', '2001', 4, 'coare@gmail.com', 'Snaptags', '1688148240_g5.jpg', '2023-07-01'),
(19, 84, 'Merilyn', 'Meigh', 'Sanpere', 'Female', '1991', 2, 'sanpere@gmail.com', 'Babblestorm', '1688148300_g6.jpg', '2023-07-01'),
(20, 85, 'Eva', 'Lilly', 'Climson', 'Female', '2004', 1, 'climson@gmail.com', 'Wordware', '1688148360_g7.jpg', '2023-07-01'),
(21, 86, 'Cherin', 'Finnigan', 'Brosh', 'Female', '2017', 2, 'brosh@gmail.com', 'Zoovu', '1688148420_g8.jpg', '2023-07-01'),
(22, 87, 'Ash', 'Vicson', 'Garmans', 'Male', '2005', 1, 'garmans@gmail.com', 'Mymm', '1688148540_b1.jpg', '2023-07-01'),
(23, 88, 'Kurtis', 'Giabucci', 'Coundley', 'Male', '2008', 2, 'coundley@gmail.com', 'Facebook', '1688148600_b2.jpg', '2023-07-01'),
(24, 89, 'Denis', 'Hernik', 'Headingham', 'Male', '1999', 9, 'headingham@gmail.com', 'Gigazoom', '1688148600_b3.jpg', '2023-07-01'),
(25, 90, 'Garrett', 'Rummery', 'Fields', 'Male', '1999', 5, 'garrett@gmail.com', 'Oloo', '1688148720_b4.jpg', '2023-07-01'),
(26, 91, 'Matty', 'Lowater', 'Clouston', 'Male', '2001', 3, 'clouston@gmail.com', 'Makati Medical Center', '1688148780_b5.jpg', '2023-07-01'),
(27, 92, 'Adrian', 'Presho', 'Lemery', 'Male', '2001', 1, 'lemery@gmail.com', 'UP Diliman', '1688148840_b6.jpg', '2023-07-01'),
(28, 93, 'Tally', 'Cancelier', 'Chadd', 'Male', '2005', 10, 'chadd@gmail.com', 'Quinu', '1688148900_b9.jpg', '2023-07-01');

-- --------------------------------------------------------

--
-- Table structure for table `careers`
--

CREATE TABLE `careers` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `company` varchar(250) NOT NULL,
  `location` text NOT NULL,
  `job_title` text NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `careers`
--

INSERT INTO `careers` (`id`, `user_id`, `company`, `location`, `job_title`, `description`, `date_created`) VALUES
(5, 1, 'San Miguel Holdings Corp.', 'Manila City', 'Finance Analyst', '&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;/p&gt;&lt;span style=&quot;font-size:12px;font-weight: var(--zdj8ld48);&quot;&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48); font-size: 12px;&quot;&gt;JOB DESCRIPTION:&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;General Ledger Maintenance&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;External Reporting&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Tax Compliance&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Fixed Assets&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Payables Processing&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Account schedule preparation and analysis&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Bank reconciliation&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;General Audit&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48); font-size: 12px;&quot;&gt;QUALIFICATIONS:&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Graduate of BS Accountancy;&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Must be a Certified Public Accountant;&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Required skill(s): SAP.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;With 1-2 years&rsquo; experience is required for this position;&lt;/li&gt;&lt;/ul&gt;&lt;/span&gt;', '2023-07-01 01:43:49'),
(6, 1, 'Power Mac Center', 'Zamboanga City', 'Marketing Officer', '&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;/p&gt;&lt;span style=&quot;font-size:12px;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif;&quot;&gt;&lt;span style=&quot;font-size: 12px; margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif;&quot;&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;Plans and executes year-long campaigns and programs following brand guidelines. He/She safeguards internal and external branding on all channels and creates avenues to strengthen the company branding.&amp;nbsp;&lt;/p&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;br style=&quot;font-size: 12px;&quot;&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48); font-size: 12px;&quot;&gt;ROLES AND RESPONSIBILITIES&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Researches and analyses market trends and demands, competitor offerings, demographics and other information that affects marketing strategies.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Creates Marketing Plans for the assigned teams while considering the approved budget.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Ensures implementation and effectivity of Marketing Campaigns and Demand Generation Programs through close monitoring of activities and proper coordination with all concerned teams.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Works with accredited Suppliers and ensures that brand guidelines are being followed.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Liaises with Stakeholders and vendors to promote success of activities.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;Handles external communications and appearances to represent the Company in media engagements and the like.&amp;nbsp;&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 12px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48); font-size: 12px;&quot;&gt;JOB REQUIREMENTS&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;University Degree preferably of any four-year Business course or&amp;nbsp;equivalent.&amp;nbsp;&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda); font-size: 12px;&quot;&gt;With at least 1 year experience in Brand Management, Event Management, Advertising/Media Planning, Customer Service Practices, Marketing Research, Communications, Creative Planning and Content Writing.&lt;/li&gt;&lt;/ul&gt;&lt;/span&gt;', '2023-07-01 01:44:28'),
(7, 1, 'SM Investments Corporation', 'Makati City', 'Accounting Assistant', '&lt;span style=&quot;font-size:12px;&quot;&gt;DISBURSEMENT PROCESS&lt;ul style=&quot;font-size:12px;&quot;&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Checks and validates invoices/bills, Statement of Accounts, petty cash vouchers with supporting documents, payroll entries.&lt;/li&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Prepares cash disbursement/payment voucher with valid attachment.&lt;/li&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Post entries in the Cash Disbursement Books, General Ledgers and Purchase Books and subsidiary books&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;font-size:12px;&quot;&gt;REPORTS&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4);&quot;&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Prepares Weekly Cash Position Reports&lt;/li&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Prepares Summary of Construction in Progress&lt;/li&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Prepares monthly returns &ndash; EWT &amp;amp; attachments, Withholding Tax -Compensation Returns, VAT &amp;amp; attachments&lt;/li&gt;&lt;li style=&quot;font-size:12px;&quot;&gt;Prepares various schedules for Financial Statement Analysis&lt;/li&gt;&lt;/ul&gt;&lt;/span&gt;', '2023-07-01 01:45:24'),
(8, 2, 'Security Bank Corporation', 'Makati City', 'Customer Advisor Staff ', '&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;As a&amp;nbsp;&lt;span style=&quot;font-weight: var(--zdj8ld48);&quot;&gt;Customer Advisor&lt;/span&gt;, you will&amp;nbsp;handle marketing, bank operations, and relationship and portfolio management responsibilities. When it comes to career growth, it is an opportunity to get valuable corporate experience while learning from seasoned veterans of a highly competitive field.&lt;/p&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;As a member of the Branch Banking group, you will be at the forefront of giving personalized and quality service to our clients. By managing and growing the existing portfolio of the branch, the Customer Advisor will be instrumental in ensuring the efficiency of our branch business.&lt;/p&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48);&quot;&gt;How will you contribute&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Managing and growing the existing portfolio of the branch by cross-selling and in-house selling of the bank&amp;#x2019;s products and services.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Assessing customer needs and ensuring prompt and efficient service delivery in compliance with the bank&rsquo;s service standards.&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Processing account opening of new accounts, renewal, termination, and payment of matured placements.&lt;/li&gt;&lt;/ul&gt;&lt;p style=&quot;margin-bottom: var(--zdj8ld4); margin-top: var(--zdj8ld4); padding: 0px; color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;span style=&quot;font-weight: var(--zdj8ld48);&quot;&gt;What we&amp;#x2019;re looking for&lt;/span&gt;&lt;/p&gt;&lt;ul style=&quot;margin-bottom: var(--zdj8ld4); color: rgb(46, 56, 73); font-family: Roboto, &amp;quot;Helvetica Neue&amp;quot;, HelveticaNeue, Helvetica, Arial, sans-serif; font-size: 16px;&quot;&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Graduate of a Bachelor&rsquo;s Degree&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;With at least 1-year branch banking or related experience handling new account transactions&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Experience in cross-selling of bank products&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Able to understand and analyze numerical information and to make the right conclusions and decisions&lt;/li&gt;&lt;li style=&quot;list-style: disc; margin-left: calc(1 * var(--zdj8ld4)); padding-bottom: var(--zdj8lda);&quot;&gt;Must have good interpersonal skills, negotiation skills, and a strong customer service orientation&lt;/li&gt;&lt;/ul&gt;', '2023-07-01 01:50:57');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(30) NOT NULL,
  `course` text NOT NULL,
  `about` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course`, `about`) VALUES
(1, 'BS Education', ''),
(2, 'BS Information Technology', ''),
(3, 'BS Nursing', ''),
(4, 'BS Electrical Engineering', ''),
(5, 'BS Civil Engineering', ''),
(6, 'BS Chemistry', ''),
(7, 'BS Social Work', ''),
(8, 'BS Mechanical Engineering', ''),
(9, 'BS Architecture', ''),
(10, 'BA Political Science', '');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `content` text NOT NULL,
  `schedule` datetime NOT NULL,
  `banner` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `user_id`, `title`, `content`, `schedule`, `banner`, `date_created`) VALUES
(1, 1, 'Sports Fest 2023', 'We are holding a sports program in our school. In which we would like to you as a participant and guess. And we want you to make your school team part of our Alumni program. Of course, this program will make the relationship between our students and schools very pleasant. So we are looking forward to your participation.&nbsp;', '2023-11-23 01:02:00', '1688144640_sportsfest.jpg', '2023-07-01 01:04:41'),
(8, 1, 'Charity Fun Run 2023', 'Looking for an exciting way to get involved with your alma mater? Join us at the Alumni Fun Run this year 2023 and help raise money for a great cause! Register now and run, walk or cycle in support of those most affected by the pandemic.&amp;nbsp;', '2023-12-13 09:00:00', '1688145240_funrun.jpg', '2023-07-01 01:14:36'),
(9, 1, 'WMSU Music Festival', '&lt;span style=&quot;font-family: Roboto, sans-serif; font-size: 18px;&quot;&gt;Several Filipino musical acts, including Ben&amp;amp;Ben and Zack Tabudlo, are performing on one concert stage this summer at WMSU Music Festival 2023, happening on Septermber 2023, at the WMSU field, Zamboanga City. Fifteen of the local top musical acts will gather in the hotly anticipated day-to-night spectacle that features both seasoned and upcoming artists.&lt;/span&gt;', '2023-09-21 18:00:00', '1688145720_ben-zack.jpg', '2023-07-01 01:22:06');

-- --------------------------------------------------------

--
-- Table structure for table `event_commits`
--

CREATE TABLE `event_commits` (
  `id` int(30) NOT NULL,
  `event_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_commits`
--

INSERT INTO `event_commits` (`id`, `event_id`, `user_id`) VALUES
(12, 9, 86),
(13, 1, 88),
(14, 9, 87);

-- --------------------------------------------------------

--
-- Table structure for table `forum_comments`
--

CREATE TABLE `forum_comments` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `topic_id` int(30) NOT NULL,
  `comment` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_comments`
--

INSERT INTO `forum_comments` (`id`, `user_id`, `topic_id`, `comment`, `date_created`) VALUES
(16, 2, 8, 'I am not supporting the use of AI!', '2023-07-01 01:54:15'),
(17, 86, 9, 'Gcash as the top fintech company in PH? Meh. The work culture there is toxic!', '2023-07-01 02:20:22'),
(18, 88, 9, 'I think google should be included on the list as well. What do you think?', '2023-07-01 02:21:52'),
(19, 87, 9, 'Universities should be also included on the list.... not only private corporate companies', '2023-07-01 02:23:43');

-- --------------------------------------------------------

--
-- Table structure for table `forum_topics`
--

CREATE TABLE `forum_topics` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `title` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forum_topics`
--

INSERT INTO `forum_topics` (`id`, `user_id`, `title`, `description`, `date_created`) VALUES
(8, 1, 'The Future of AI - Artificial Intelligence', '&lt;span style=&quot;font-size:12px;color: rgb(48, 48, 48); font-family: Lato, sans-serif;&quot;&gt;The digital revolution has already changed how people live, work, and communicate. And it&rsquo;s only just getting started. But the same technologies that have the potential to help billions of people live happier, healthier, and more productive lives are also creating new challenges for citizens and governments around the world. From election meddling to data breaches and cyberattacks, recent events have shown that technology is changing how we think about privacy, national security, and maybe even democracy itself.&amp;nbsp;&lt;/span&gt;', '2023-07-01 01:53:36'),
(9, 1, 'Best Place to Work in PH', 'Professional networking platform LinkedIn released its third annual list of top companies list on Wednesday, April 19, composed of firms from sectors such as information and technology (IT), financial technology (fintech) and consumer goods. IT services and consulting firm Accenture was named the top company, while fintech giants Mynt (GCash) and Maya followed suit to round up the frontrunners.&amp;nbsp;', '2023-07-01 01:56:30');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE `gallery` (
  `id` int(30) NOT NULL,
  `about` text NOT NULL,
  `path` text NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`id`, `about`, `path`, `created`) VALUES
(1, 'Andrea B Phasellus non venenatis metus. Ut semper, nunc id maximus convallis, arcu leo tempus lacus, id tincidunt purus velit nec tellus. Nulla sit amet nibh dictum, blandit augue eleifend, sagittis lorem', 'gallery-1.jpg', '2020-10-15 13:15:37'),
(2, 'Fusce dictum consectetur semper. Etiam dignissim in augue ut tempor. Proin rhoncus vestibulum mollis. Integer pellentesque ullamcorper turpis. Quisque turpis lacus, iaculis id sodales tincidunt', 'gallery-3.jpg', '2020-10-15 13:15:45'),
(3, 'Mauris augue felis, mattis sit amet sodales nec, pellentesque eu elit. Aliquam ultrices sem eget purus laoreet suscipit. Integer nec risus iaculis, sollicitudin velit ac, maximus ante', 'gallery-4.jpg', '2020-10-15 13:15:53'),
(4, 'Curabitur ut malesuada orci. In sed rhoncus eros, sit amet malesuada tortor. Phasellus lobortis, nisl et euismod volutpat, orci odio malesuada neque, mollis iaculis erat ante non ante. Nulla tempus at leo ac condimentum. Morbi vitae malesuada ex', 'gallery-5.jpg', '2020-10-15 13:16:07'),
(5, ' Ut semper, nunc id maximus convallis, arcu leo tempus lacus, id tincidunt purus velit nec tellus. Nulla sit amet nibh dictum, blandit augue eleifend, sagittis lorem', 'gallery-2.jpeg', '2023-06-28 01:56:56');

-- --------------------------------------------------------

--
-- Table structure for table `job_classification`
--

CREATE TABLE `job_classification` (
  `id` int(30) NOT NULL,
  `name` varchar(255) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_classification`
--

INSERT INTO `job_classification` (`id`, `name`, `status`) VALUES
(1, 'Regular', 'ACTIVE'),
(2, 'Job Order', 'ACTIVE'),
(3, 'Contractual', 'ACTIVE'),
(4, 'Resigned', 'ACTIVE'),
(5, 'Seasonal', 'ACTIVE'),
(6, 'Fixed', 'ACTIVE'),
(7, 'Organic', 'ACTIVE'),
(8, 'COS Ongoing', 'ACTIVE'),
(9, 'Probationary', 'ACTIVE'),
(10, 'Inorganic', 'ACTIVE'),
(11, 'Casual', 'ACTIVE'),
(12, 'Open Contract', 'ACTIVE'),
(13, 'Part-Time', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE `job_type` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `status` enum('ACTIVE','INACTIVE','','') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`id`, `name`, `status`) VALUES
(1, 'Other', 'ACTIVE'),
(2, 'Architect', 'ACTIVE'),
(3, 'Engineer', 'ACTIVE'),
(4, 'Nurse', 'ACTIVE'),
(5, 'Teacher', 'ACTIVE'),
(6, 'Software Engineer', 'ACTIVE'),
(7, 'Clerk', 'ACTIVE'),
(8, 'Baker', 'ACTIVE'),
(9, 'Military', 'ACTIVE'),
(10, 'Pilot', 'ACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `name` varchar(250) NOT NULL,
  `description` text NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `valid_until` datetime NOT NULL,
  `photo` text NOT NULL,
  `date_created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `user_id`, `name`, `description`, `price`, `quantity`, `valid_until`, `photo`, `date_created`) VALUES
(1, 1, 'Alumni Shirt 2023', 'Shirts are available in different sizes. All are encouraged to pair the alumni shirt with khaki pants for the parade. Thank you and see you all on August!&lt;p&gt;&lt;br&gt;&lt;p&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; text-align: justify;&quot;&gt;Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt. Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem.&lt;/span&gt;&lt;/p&gt;&lt;/p&gt;', 550, 300, '2023-08-24 14:07:00', 'alumni-shirt.jpg', '2023-06-11 14:09:20'),
(7, 1, 'Alumni Mug', '&lt;p&gt;&lt;span style=&quot;font-size:16px;color: rgb(0, 0, 0); font-family: Montserrat, Arial, Helvetica, &amp;quot;sans-serif&amp;quot;;&quot;&gt;Bean here, learned that! Enjoy coffee, tea, or anything in between in this campus&amp;nbsp; alumni mug. Ceramic mug features a comfortable &amp;#x2019;C&amp;#x2019; shaped handle, a smooth glazed finish, and the school name with an &amp;#x2019;Alumni&amp;#x2019; headline printed on the front. 15 oz. capacity.&lt;/span&gt;&lt;/p&gt;', 230, 400, '2023-10-31 02:27:00', '1688149680_cup.jpg', '2023-07-01 02:28:54');

-- --------------------------------------------------------

--
-- Table structure for table `product_commits`
--

CREATE TABLE `product_commits` (
  `id` int(30) NOT NULL,
  `product_id` int(30) NOT NULL,
  `user_id` int(30) NOT NULL,
  `quantity` int(11) NOT NULL,
  `status` enum('RESERVED','CANCELLED') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `product_commits`
--

INSERT INTO `product_commits` (`id`, `product_id`, `user_id`, `quantity`, `status`) VALUES
(47, 1, 86, 3, 'RESERVED'),
(48, 1, 88, 4, 'RESERVED'),
(49, 7, 2, 2, 'RESERVED'),
(50, 7, 2, 1, 'RESERVED');

-- --------------------------------------------------------

--
-- Table structure for table `system_settings`
--

CREATE TABLE `system_settings` (
  `id` int(30) NOT NULL,
  `name` text NOT NULL,
  `email` varchar(200) NOT NULL,
  `contact` varchar(20) NOT NULL,
  `cover_img` text NOT NULL,
  `about_content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `system_settings`
--

INSERT INTO `system_settings` (`id`, `name`, `email`, `contact`, `cover_img`, `about_content`) VALUES
(1, 'Alumni Management System', 'techsupport@wmsu.com.ph', '+6948 8542 623', 'background.jpg', '&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;span style=&quot;color: rgb(0, 0, 0); font-family: &amp;quot;Open Sans&amp;quot;, Arial, sans-serif; font-weight: 400; text-align: justify;&quot;&gt;&amp;nbsp;is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry&rsquo;s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.&lt;/span&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p style=&quot;text-align: center; background: transparent; position: relative;&quot;&gt;&lt;br&gt;&lt;/p&gt;&lt;p&gt;&lt;/p&gt;');

-- --------------------------------------------------------

--
-- Table structure for table `tracer_survey`
--

CREATE TABLE `tracer_survey` (
  `id` int(11) NOT NULL,
  `user_id` int(30) NOT NULL,
  `first_job` int(30) DEFAULT NULL,
  `first_job_other` text NOT NULL,
  `first_job_status` int(30) DEFAULT NULL,
  `cur_employed` enum('EMPLOYED','UNEMPLOYED') NOT NULL,
  `cur_unemployed_reason` text NOT NULL,
  `cur_job` int(30) DEFAULT NULL,
  `cur_job_other` text NOT NULL,
  `cur_job_company` text NOT NULL,
  `cur_job_find` text NOT NULL,
  `cur_job_status` int(30) DEFAULT NULL,
  `cur_job_salary` text NOT NULL,
  `cur_job_start` year(4) NOT NULL,
  `cur_job_end` year(4) NOT NULL,
  `grad_course` text NOT NULL,
  `grad_course_status` text NOT NULL,
  `award_job` text NOT NULL,
  `tracer_version` int(30) NOT NULL,
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_survey`
--

INSERT INTO `tracer_survey` (`id`, `user_id`, `first_job`, `first_job_other`, `first_job_status`, `cur_employed`, `cur_unemployed_reason`, `cur_job`, `cur_job_other`, `cur_job_company`, `cur_job_find`, `cur_job_status`, `cur_job_salary`, `cur_job_start`, `cur_job_end`, `grad_course`, `grad_course_status`, `award_job`, `tracer_version`, `date_created`) VALUES
(19, 2, 5, '', 1, 'EMPLOYED', '', 5, '', 'Ateneo de Manila University', '1 month to 6 months', 1, 'Between ₱63,700 to ₱109,200', '2021', '2022', '', '', '', 1, '2023-07-01 14:16:09'),
(20, 4, 5, '', 1, 'EMPLOYED', '', 1, 'Lawyer', 'Zamboanga Law Office', '1 month to 6 months', 9, 'Between ₱36,400 to ₱63,700', '2022', '2022', '', '', '', 1, '2023-07-01 14:25:02'),
(21, 80, 2, '', 1, 'EMPLOYED', '', 2, '', 'GFP Architects', '6 months to 12 months', 1, 'Less than ₱9,100', '2005', '2022', '', '', '', 1, '2023-07-01 14:27:12'),
(22, 83, 3, '', 12, 'EMPLOYED', '', 3, '', 'DPWH', 'Less than 1 month', 3, 'Between ₱63,700 to ₱109,200', '2020', '2022', '', '', '', 1, '2023-07-01 14:29:46'),
(23, 84, 6, '', 1, 'EMPLOYED', '', 6, '', 'Oracle PH', 'Less than 1 month', 1, 'At least ₱182,000 and up', '2017', '2022', '', '', '', 1, '2023-07-01 14:31:05'),
(24, 86, 6, '', 1, 'EMPLOYED', '', 6, '', 'Canva PH', '1 month to 6 months', 1, 'Between ₱109,200 to ₱182,000', '2018', '2022', 'Master in Information technology', 'On-going', '', 1, '2023-07-01 14:33:57'),
(25, 87, 5, '', 1, 'UNEMPLOYED', 'Further study', NULL, '', '', '', NULL, '', '0000', '0000', 'Masteral in Secondary Education', 'On-going', '', 1, '2023-07-01 14:35:21'),
(26, 88, 6, '', 2, 'EMPLOYED', '', 6, '', 'Microsoft Inc', 'Less than 1 month', 1, 'At least ₱182,000 and up', '2018', '2022', '', '', '', 1, '2023-07-01 14:36:37'),
(27, 89, NULL, '', 3, 'UNEMPLOYED', 'No job opportunity', NULL, '', '', '', NULL, '', '0000', '0000', '', '', '', 1, '2023-07-01 14:37:31');

-- --------------------------------------------------------

--
-- Table structure for table `tracer_version`
--

CREATE TABLE `tracer_version` (
  `id` int(30) NOT NULL,
  `version` year(4) NOT NULL,
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'ACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tracer_version`
--

INSERT INTO `tracer_version` (`id`, `version`, `status`) VALUES
(1, '2022', 'INACTIVE');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(30) NOT NULL,
  `first_name` varchar(200) NOT NULL,
  `middle_name` varchar(200) DEFAULT NULL,
  `last_name` varchar(200) NOT NULL,
  `username` varchar(200) NOT NULL,
  `password` text NOT NULL,
  `type` enum('ADMIN','OFFICER','ALUMNI','') NOT NULL DEFAULT 'ALUMNI',
  `status` enum('ACTIVE','INACTIVE') NOT NULL DEFAULT 'INACTIVE'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `middle_name`, `last_name`, `username`, `password`, `type`, `status`) VALUES
(1, 'Admin', '', '', 'admin', '0192023a7bbd73250516f069df18b500', 'ADMIN', 'ACTIVE'),
(2, 'Jonas', 'Greiser', 'Snow', 'jonas@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(3, 'Amy', 'Smith', 'Taylor', 'amy@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'OFFICER', 'ACTIVE'),
(4, 'Willette', 'Letherbury', 'Danzey', 'danzey@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(5, 'Rose', 'Cruz', 'Sebastian', 'rose@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'OFFICER', 'ACTIVE'),
(80, 'Codee', 'Hatchell', 'Harradine', 'harradine@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(81, 'Shalna', 'Burdus', 'McGuinley', 'mcguinley@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(82, 'Korrie', 'Jadczak', 'Orpee', 'orpee@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(83, 'Ula', 'Niles', 'Coare', 'coare@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(84, 'Merilyn', 'Meigh', 'Sanpere', 'sanpere@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(85, 'Eva', 'Lilly', 'Climson', 'climson@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(86, 'Cherin', 'Finnigan', 'Brosh', 'brosh@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(87, 'Ash', 'Vicson', 'Garmans', 'garmans@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'INACTIVE'),
(88, 'Kurtis', 'Giabucci', 'Coundley', 'coundley@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(89, 'Denis', 'Hernik', 'Headingham', 'headingham@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(90, 'Garrett', 'Rummery', 'Fields', 'garrett@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(91, 'Matty', 'Lowater', 'Clouston', 'clouston@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'INACTIVE'),
(92, 'Adrian', 'Presho', 'Lemery', 'lemery@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE'),
(93, 'Tally', 'Cancelier', 'Chadd', 'chadd@gmail.com', '5e8ff9bf55ba3508199d22e984129be6', 'ALUMNI', 'ACTIVE');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD PRIMARY KEY (`id`),
  ADD KEY `course_alumni` (`course_id`),
  ADD KEY `user_alumni` (`user_id`);

--
-- Indexes for table `careers`
--
ALTER TABLE `careers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_career` (`user_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_event` (`user_id`);

--
-- Indexes for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_commit` (`user_id`),
  ADD KEY `event_commit` (`event_id`);

--
-- Indexes for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_comment` (`user_id`),
  ADD KEY `forum_comment` (`topic_id`);

--
-- Indexes for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_forum` (`user_id`);

--
-- Indexes for table `gallery`
--
ALTER TABLE `gallery`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_classification`
--
ALTER TABLE `job_classification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_user` (`user_id`);

--
-- Indexes for table `product_commits`
--
ALTER TABLE `product_commits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_commit` (`user_id`),
  ADD KEY `product_commit` (`product_id`);

--
-- Indexes for table `system_settings`
--
ALTER TABLE `system_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tracer_survey`
--
ALTER TABLE `tracer_survey`
  ADD PRIMARY KEY (`id`),
  ADD KEY `first_job` (`first_job`),
  ADD KEY `cur_job` (`cur_job`),
  ADD KEY `tracer_version` (`tracer_version`),
  ADD KEY `tracer_user` (`user_id`),
  ADD KEY `cur_job_classification` (`cur_job_status`),
  ADD KEY `first_job_classification` (`first_job_status`);

--
-- Indexes for table `tracer_version`
--
ALTER TABLE `tracer_version`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `careers`
--
ALTER TABLE `careers`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `event_commits`
--
ALTER TABLE `event_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `forum_comments`
--
ALTER TABLE `forum_comments`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `forum_topics`
--
ALTER TABLE `forum_topics`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gallery`
--
ALTER TABLE `gallery`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `job_classification`
--
ALTER TABLE `job_classification`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `product_commits`
--
ALTER TABLE `product_commits`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `system_settings`
--
ALTER TABLE `system_settings`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tracer_survey`
--
ALTER TABLE `tracer_survey`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tracer_version`
--
ALTER TABLE `tracer_version`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnus_bio`
--
ALTER TABLE `alumnus_bio`
  ADD CONSTRAINT `course_alumni` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`),
  ADD CONSTRAINT `user_alumni` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `careers`
--
ALTER TABLE `careers`
  ADD CONSTRAINT `user_career` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `events`
--
ALTER TABLE `events`
  ADD CONSTRAINT `user_event` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `event_commits`
--
ALTER TABLE `event_commits`
  ADD CONSTRAINT `event_commit` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_commit` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forum_comments`
--
ALTER TABLE `forum_comments`
  ADD CONSTRAINT `forum_comment` FOREIGN KEY (`topic_id`) REFERENCES `forum_topics` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `user_comment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `forum_topics`
--
ALTER TABLE `forum_topics`
  ADD CONSTRAINT `user_forum` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `product_commits`
--
ALTER TABLE `product_commits`
  ADD CONSTRAINT `product_commit` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_commit` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tracer_survey`
--
ALTER TABLE `tracer_survey`
  ADD CONSTRAINT `cur_job` FOREIGN KEY (`cur_job`) REFERENCES `job_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `cur_job_classification` FOREIGN KEY (`cur_job_status`) REFERENCES `job_classification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `first_job` FOREIGN KEY (`first_job`) REFERENCES `job_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `first_job_classification` FOREIGN KEY (`first_job_status`) REFERENCES `job_classification` (`id`),
  ADD CONSTRAINT `tracer_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `tracer_version` FOREIGN KEY (`tracer_version`) REFERENCES `tracer_version` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
