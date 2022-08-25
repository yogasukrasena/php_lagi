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
-- Table structure for table `tblEstruder`
--

CREATE TABLE `tblEstruder` (
  `ID` int(11) NOT NULL auto_increment,
  `EstruderCode` varchar(10) NOT NULL,
  `EstruderDescription` varchar(100) NOT NULL,
  `EstruderDate` date NOT NULL default '0000-00-00',
  `EstruderTechDraw` varchar(50) default NULL,
  `EstruderPhoto1` varchar(50) default NULL,
  `EstruderPhoto2` varchar(50) default NULL,
  `EstruderPhoto3` varchar(50) default NULL,
  `EstruderPhoto4` varchar(50) default NULL,
  `EstruderNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `EstruderCode` (`EstruderCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblEstruder`
--

