-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 10, 2008 at 01:53 AM
-- Server version: 5.0.45
-- PHP Version: 5.2.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `gayafusionall`
--

-- --------------------------------------------------------

--
-- Table structure for table `c_codification`
--

CREATE TABLE `SampleCeramic` (
  `sID` int(10) NOT NULL auto_increment,
  `SampleCode` varchar(12) NOT NULL default '',
  `Description` varchar(50) NOT NULL default '',
  `ClientCode` varchar(20) NOT NULL default '',
  `ClientDescription` varchar(50) NOT NULL default '',
  `SampleDate`Date NOT NULL default '00-00-0000',
  `TechDraw` varchar(50) default NULL,
  `Photo1` varchar(50) default NULL,
  `Photo2` varchar(50) default NULL,
  `Photo3` varchar(50) default NULL,
  `Photo4` varchar(50) default NULL,
  `Reference` varchar(20) default NULL,
  `ReferenceNote` text,
  `Clay` varchar(50) default NULL,
  `ClayNote` text,
  `BuildTech` varchar(50) default NULL,
  `BuildTechNote` text,
  `Rim` varchar(30) default NULL,
  `Feet` varchar(30) default NULL,
  `Casting1` varchar(50) default NULL,
  `Casting2` varchar(50) default NULL,
  `Casting3` varchar(50) default NULL,
  `Casting4` varchar(50) default NULL,
  `CastingNote` text,
  `Estruder1` varchar(50) default NULL,
  `Estruder2` varchar(50) default NULL,
  `Estruder3` varchar(50) default NULL,
  `Estruder4` varchar(50) default NULL,
  `EstruderNote` text,
  `Texture1` varchar(50) default NULL,
  `Texture2` varchar(50) default NULL,
  `Texture3` varchar(50) default NULL,
  `Texture4` varchar(50) default NULL,
  `TextureNote` text,
  `Tools1` varchar(50) default NULL,
  `Tools2` varchar(50) default NULL,
  `Tools3` varchar(50) default NULL,
  `Tools4` varchar(50) default NULL,
  `ToolsNote` text,
  `Engobe1` varchar(50) default NULL,
  `Engobe2` varchar(50) default NULL,
  `Engobe3` varchar(50) default NULL,
  `Engobe4` varchar(50) default NULL,
  `EngobeNote` text,
  `BisqueTemp` varchar(10) default NULL,
  `StainOxide1` varchar(50) default NULL,
  `StainOxide2` varchar(50) default NULL,
  `StainOxide3` varchar(50) default NULL,
  `StainOxide4` varchar(50) default NULL,
  `StainOxideNote` text,
  `Glaze1` varchar(10) default NULL,
  `Glaze2` varchar(10) default NULL,
  `Glaze3` varchar(10) default NULL,
  `Glaze4` varchar(10) default NULL,
  `GlazeDensity1` varchar(10) default NULL,
  `GlazeDensity2` varchar(10) default NULL,
  `GlazeDensity3` varchar(10) default NULL,
  `GlazeDensity4` varchar(10) default NULL,
  `GlazeNote` text,
  `GlazeTemp` varchar(10) default NULL,
  `Firing` varchar(10) NOT NULL default '',
  `FiringNote` text,
  `Width` decimal(10,2) default NULL,
  `Height` decimal(10,2) default NULL,
  `Length` decimal(10,2) default NULL,
  `Diameter` decimal(10,2) default NULL,
  `FinalSizeNote` text,
  `OtherMat1` varchar(10) default NULL,
  `OtherMat2` varchar(10) default NULL,
  `OtherMat3` varchar(10) default NULL,
  `OtherMat4` varchar(10) default NULL,
  `OtherMatQty1` Int(10) default NULL,
  `OtherMatQty2` Int(10) default NULL,
  `OtherMatQty3` Int(10) default NULL,
  `OtherMatQty4` Int(10) default NULL,
  `OtherMatNote` text,
  `History` text,
  PRIMARY KEY  (`sID`),
  UNIQUE KEY `SampleCode` (`SampleCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_codification`
--

