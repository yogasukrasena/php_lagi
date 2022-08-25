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
-- Table structure for table `tblTexture`
--

CREATE TABLE `tblTexture` (
  `ID` int(11) NOT NULL auto_increment,
  `TextureCode` varchar(10) NOT NULL,
  `TextureDescription` varchar(100) NOT NULL,
  `TextureDate` date NOT NULL default '0000-00-00',
  `TextureTechDraw` varchar(50) default NULL,
  `TexturePhoto1` varchar(50) default NULL,
  `TexturePhoto2` varchar(50) default NULL,
  `TexturePhoto3` varchar(50) default NULL,
  `TexturePhoto4` varchar(50) default NULL,
  `TextureNotes` text,
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `TextureCode` (`TextureCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblTexture`
--

