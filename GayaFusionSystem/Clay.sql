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
-- Table structure for table `tblclay`
--

CREATE TABLE `tblclay` (
  `ID` int(11) NOT NULL auto_increment,
  `ClayCode` varchar(10) NOT NULL,
  `ClayDescription` varchar(100) NOT NULL,
  `ClayDate` date NOT NULL default '0000-00-00',
  `ClayTechDraw` varchar(50) default NULL,
  `ClayPhoto1` varchar(50) default NULL,
  `ClayPhoto2` varchar(50) default NULL,
  `ClayPhoto3` varchar(50) default NULL,
  `ClayPhoto4` varchar(50) default NULL,
  `ClayNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ClayCode` (`ClayCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblclay`
--

