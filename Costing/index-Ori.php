<?php	
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Costing',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
?>
<html>
<head>
<title>.:: Gaya Fusion - Costing ::.</title>
</head>

<frameset cols="200,*" frameborder="NO" border="0" framespacing="0" rows="*"> 
  <frame name="leftFrame" scrolling="YES" noresize src="leftnav.php">
  <frame name="mainFrame" src="maincosting.php">
</frameset>
<noframes><body bgcolor="#FFFFFF" text="#000000" link="#000099" alink="#FF0000" vlink="#000099">

</body></noframes>

</html>