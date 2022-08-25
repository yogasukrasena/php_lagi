-- phpMyAdmin SQL Dump
-- version 2.11.0
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 18, 2008 at 05:39 AM
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

CREATE TABLE `c_codification` (
  `sID` int(10) NOT NULL auto_increment,
  `c_client_id` char(2) NOT NULL default '',
  `c_dept_id` char(2) NOT NULL default '',
  `c_unit_id` char(1) NOT NULL default '',
  `c_cat_id` char(2) NOT NULL default '',
  `c_text_id` char(1) NOT NULL default '',
  `c_col_id` char(2) NOT NULL default '',
  `c_mat_id` char(1) NOT NULL default '',
  `c_size_id` char(1) NOT NULL default '',
  `c_kode` varchar(12) NOT NULL default '',
  `c_tech_draw` varchar(50) default NULL,
  `c_photo` varchar(50) default NULL,
  `c_clay` varchar(30) default NULL,
  `c_kg` text,
  `c_build_tech` varchar(50) default NULL,
  `c_note_build_tech` text,
  `c_rim` varchar(30) default NULL,
  `c_feet` varchar(30) default NULL,
  `c_note_texture` text,
  `c_bisque_temp` varchar(10) default NULL,
  `c_glaze` varchar(10) default NULL,
  `c_glaze_density` varchar(10) default NULL,
  `c_glaze_tech` varchar(10) default NULL,
  `c_glaze_temp` varchar(10) default NULL,
  `c_firing` varchar(10) NOT NULL default '',
  `c_date` date NOT NULL default '0000-00-00',
  `c_end_measures` varchar(10) default NULL,
  `c_note` text,
  `c_p_material` varchar(75) default NULL,
  `c_p_supplier` varchar(50) default NULL,
  `c_p_tech_draw` varchar(50) default NULL,
  `c_p_photo` varchar(50) default NULL,
  `c_p_box_size` varchar(20) default NULL,
  `c_p_total` varchar(10) default NULL,
  `c_p_width` decimal(10,2) default NULL,
  `c_p_height` decimal(10,2) default NULL,
  `c_p_length` decimal(10,2) default NULL,
  `c_p_diameter` decimal(10,2) default NULL,
  `c_p_note` text,
  `c_p_price_box` int(10) default NULL,
  `c_p_qty` int(10) default NULL,
  `c_name_measure` varchar(50) default NULL,
  `c_width` decimal(10,2) NOT NULL default '0.00',
  `c_height` decimal(10,2) NOT NULL default '0.00',
  `c_length` decimal(10,2) NOT NULL default '0.00',
  `c_diameter` decimal(10,2) NOT NULL default '0.00',
  `c_image_texture` varchar(75) default NULL,
  PRIMARY KEY  (`sID`),
  UNIQUE KEY `c_kode` (`c_kode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `c_codification`
--


-- --------------------------------------------------------

--
-- Table structure for table `sampleceramic`
--

CREATE TABLE `sampleceramic` (
  `sID` int(10) NOT NULL auto_increment,
  `SampleCode` varchar(12) NOT NULL default '',
  `Description` varchar(50) NOT NULL default '',
  `ClientCode` varchar(20) NOT NULL default '',
  `ClientDescription` varchar(50) NOT NULL default '',
  `SampleDate` date NOT NULL default '0000-00-00',
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
  `OtherMatQty1` int(10) default NULL,
  `OtherMatQty2` int(10) default NULL,
  `OtherMatQty3` int(10) default NULL,
  `OtherMatQty4` int(10) default NULL,
  `OtherMatNote` text,
  `History` text,
  PRIMARY KEY  (`sID`),
  UNIQUE KEY `SampleCode` (`SampleCode`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `sampleceramic`
--

INSERT INTO `sampleceramic` (`sID`, `SampleCode`, `Description`, `ClientCode`, `ClientDescription`, `SampleDate`, `TechDraw`, `Photo1`, `Photo2`, `Photo3`, `Photo4`, `Reference`, `ReferenceNote`, `Clay`, `ClayNote`, `BuildTech`, `BuildTechNote`, `Rim`, `Feet`, `Casting1`, `Casting2`, `Casting3`, `Casting4`, `CastingNote`, `Estruder1`, `Estruder2`, `Estruder3`, `Estruder4`, `EstruderNote`, `Texture1`, `Texture2`, `Texture3`, `Texture4`, `TextureNote`, `Tools1`, `Tools2`, `Tools3`, `Tools4`, `ToolsNote`, `Engobe1`, `Engobe2`, `Engobe3`, `Engobe4`, `EngobeNote`, `BisqueTemp`, `StainOxide1`, `StainOxide2`, `StainOxide3`, `StainOxide4`, `StainOxideNote`, `Glaze1`, `Glaze2`, `Glaze3`, `Glaze4`, `GlazeDensity1`, `GlazeDensity2`, `GlazeDensity3`, `GlazeDensity4`, `GlazeNote`, `GlazeTemp`, `Firing`, `FiringNote`, `Width`, `Height`, `Length`, `Diameter`, `FinalSizeNote`, `OtherMat1`, `OtherMat2`, `OtherMat3`, `OtherMat4`, `OtherMatQty1`, `OtherMatQty2`, `OtherMatQty3`, `OtherMatQty4`, `OtherMatNote`, `History`) VALUES
(1, 'code', 'asd', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 'tes', 'tester', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'ctess', 'gaga', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'cod', 'codenya', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 'lima', 'lima tes', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 'nam', 'enam', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 'tuju', 'tuju', '', '', '0000-00-00', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(2) NOT NULL auto_increment,
  `UserName` varchar(15) NOT NULL,
  `Passwd` varchar(10) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbladmin`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblcasting`
--

CREATE TABLE `tblcasting` (
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
-- Dumping data for table `tblcasting`
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


-- --------------------------------------------------------

--
-- Table structure for table `tbldepartment`
--

CREATE TABLE `tbldepartment` (
  `ID` int(3) NOT NULL auto_increment,
  `DepartmentName` varchar(100) NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tbldepartment`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbldesmaterial`
--

CREATE TABLE `tbldesmaterial` (
  `DmID` int(11) NOT NULL,
  `DmCode` varchar(10) NOT NULL,
  `DmDescription` varchar(100) NOT NULL,
  `DmTechDraw` varchar(50) default NULL,
  `DmPhoto1` varchar(50) default NULL,
  `DmPhoto2` varchar(50) default NULL,
  `DmPhoto3` varchar(50) default NULL,
  `DmPhoto4` varchar(50) default NULL,
  `DmSupplier` varchar(10) default NULL,
  `DmUnit` varchar(2) default NULL,
  `DmUnitPrice` decimal(10,2) default NULL,
  `DmNote` text,
  `DmDate` date NOT NULL default '0000-00-00',
  PRIMARY KEY  (`DmID`),
  UNIQUE KEY `DmCode` (`DmCode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbldesmaterial`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblengobe`
--

CREATE TABLE `tblengobe` (
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
-- Dumping data for table `tblengobe`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblestruder`
--

CREATE TABLE `tblestruder` (
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
-- Dumping data for table `tblestruder`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblfiringplan`
--

CREATE TABLE `tblfiringplan` (
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
-- Dumping data for table `tblfiringplan`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblglaze`
--

CREATE TABLE `tblglaze` (
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
-- Dumping data for table `tblglaze`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblstainoxid`
--

CREATE TABLE `tblstainoxid` (
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
-- Dumping data for table `tblstainoxid`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblsupplier`
--

CREATE TABLE `tblsupplier` (
  `SupID` int(11) NOT NULL auto_increment,
  `SupCode` varchar(15) NOT NULL,
  `SupCompany` varchar(100) default NULL,
  `SupContact` varchar(100) NOT NULL,
  `SupAddress` varchar(200) default NULL,
  `SupHP` varchar(15) default NULL,
  `SupOffice` varchar(100) default NULL,
  `SupFax` varchar(20) default NULL,
  `SupEmail` varchar(50) default NULL,
  `SupItems` varchar(100) default NULL,
  `SupOtherInfo` text,
  PRIMARY KEY  (`SupID`),
  UNIQUE KEY `SupCode` (`SupCode`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tblsupplier`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbltexture`
--

CREATE TABLE `tbltexture` (
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
-- Dumping data for table `tbltexture`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbltools`
--

CREATE TABLE `tbltools` (
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
-- Dumping data for table `tbltools`
--


-- --------------------------------------------------------

--
-- Table structure for table `tblunit`
--

CREATE TABLE `tblunit` (
  `UnitID` varchar(2) NOT NULL,
  `UnitValue` varchar(30) NOT NULL,
  PRIMARY KEY  (`UnitID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblunit`
--


-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(11) NOT NULL auto_increment,
  `UserLogin` varchar(10) NOT NULL,
  `UserName` varchar(50) NOT NULL,
  `Passwd` varchar(10) NOT NULL,
  `DeptID` int(3) NOT NULL,
  `Status` enum('0','1') NOT NULL,
  PRIMARY KEY  (`ID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `UserLogin`, `UserName`, `Passwd`, `DeptID`, `Status`) VALUES
(1, 'rnd', 'rnd', 'rnd', 1, '1');
