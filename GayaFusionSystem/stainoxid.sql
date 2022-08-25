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
-- Table structure for table `tblStainOxid`
--

CREATE TABLE `tblStainOxid` (
  `ID` int(11) NOT NULL auto_increment,
  `StainOxidCode` varchar(10) NOT NULL,
  `StainOxidDescription` varchar(100) NOT NULL,
  `StainOxidDate` date NOT NULL default '0000-00-00',
  `StainOxidTechDraw` varchar(50) default NULL,
  `StainOxidPhoto1` varchar(50) default NULL,
  `StainOxidPhoto2` varchar(50) default NULL,
  `StainOxidPhoto3` varchar(50) default NULL,
  `StainOxidPhoto4` varchar(50) default NULL,
  `StainOxidNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `StainOxidCode` (`StainOxidCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblStainOxid`
--

