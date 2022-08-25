-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2008 at 08:00 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gayafusionall`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblFiringPlan`
--

CREATE TABLE `tblFiringPlan` (
  `ID` int(11) NOT NULL auto_increment,
  `FiringPlanCode` varchar(10) NOT NULL,
  `FiringPlanDescription` varchar(100) NOT NULL,
  `FiringPlanDate` date NOT NULL default '0000-00-00',
  `FiringPlanTechDraw` varchar(50) default NULL,
  `FiringPlanPhoto1` varchar(50) default NULL,
  `FiringPlanPhoto2` varchar(50) default NULL,
  `FiringPlanPhoto3` varchar(50) default NULL,
  `FiringPlanPhoto4` varchar(50) default NULL,
  `FiringPlanNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `FiringPlanCode` (`FiringPlanCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblFiringPlan`
--

