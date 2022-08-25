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
-- Table structure for table `c_codificat`
--

CREATE TABLE `c_codificat` (
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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `c_codification`
--

