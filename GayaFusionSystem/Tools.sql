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
-- Table structure for table `tblTools`
--

CREATE TABLE `tblTools` (
  `ID` int(11) NOT NULL auto_increment,
  `ToolsCode` varchar(10) NOT NULL,
  `ToolsDescription` varchar(100) NOT NULL,
  `ToolsDate` date NOT NULL default '0000-00-00',
  `ToolsTechDraw` varchar(50) default NULL,
  `ToolsPhoto1` varchar(50) default NULL,
  `ToolsPhoto2` varchar(50) default NULL,
  `ToolsPhoto3` varchar(50) default NULL,
  `ToolsPhoto4` varchar(50) default NULL,
  `ToolsNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ToolsCode` (`ToolsCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblTools`
--

