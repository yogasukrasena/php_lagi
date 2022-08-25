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
-- Table structure for table `tblGlaze`
--

CREATE TABLE `tblGlaze` (
  `ID` int(11) NOT NULL auto_increment,
  `GlazeCode` varchar(10) NOT NULL,
  `GlazeDescription` varchar(100) NOT NULL,
  `GlazeDate` date NOT NULL default '0000-00-00',
  `GlazeTechDraw` varchar(50) default NULL,
  `GlazePhoto1` varchar(50) default NULL,
  `GlazePhoto2` varchar(50) default NULL,
  `GlazePhoto3` varchar(50) default NULL,
  `GlazePhoto4` varchar(50) default NULL,
  `GlazeNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `GlazeCode` (`GlazeCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblGlaze`
--

