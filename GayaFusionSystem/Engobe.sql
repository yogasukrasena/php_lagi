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
-- Table structure for table `tblEngobe`
--

CREATE TABLE `tblEngobe` (
  `ID` int(11) NOT NULL auto_increment,
  `EngobeCode` varchar(10) NOT NULL,
  `EngobeDescription` varchar(100) NOT NULL,
  `EngobeDate` date NOT NULL default '0000-00-00',
  `EngobeTechDraw` varchar(50) default NULL,
  `EngobePhoto1` varchar(50) default NULL,
  `EngobePhoto2` varchar(50) default NULL,
  `EngobePhoto3` varchar(50) default NULL,
  `EngobePhoto4` varchar(50) default NULL,
  `EngobeNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `EngobeCode` (`EngobeCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblEngobe`
--

