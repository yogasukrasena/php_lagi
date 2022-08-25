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
-- Table structure for table `tblCasting`
--

CREATE TABLE `tblCasting` (
  `ID` int(11) NOT NULL auto_increment,
  `CastingCode` varchar(10) NOT NULL,
  `CastingDescription` varchar(100) NOT NULL,
  `CastingDate` date NOT NULL default '0000-00-00',
  `CastingTechDraw` varchar(50) default NULL,
  `CastingPhoto1` varchar(50) default NULL,
  `CastingPhoto2` varchar(50) default NULL,
  `CastingPhoto3` varchar(50) default NULL,
  `CastingPhoto4` varchar(50) default NULL,
  `CastingNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `CastingCode` (`CastingCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblCasting`
--

