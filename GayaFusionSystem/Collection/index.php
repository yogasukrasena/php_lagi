<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<html>
<head>
<title>.:: Gaya Fusion - Costing ::.</title>
</head>

<frameset cols="200,*" frameborder="NO" border="0" framespacing="0" rows="*"> 
  <frame name="leftFrame" scrolling="YES" noresize src="leftnav.php">
  <frame name="mainFrame" src="MainCollection.php">
</frameset>
<noframes><body bgcolor="#FFFFFF" text="#000000" link="#000099" alink="#FF0000" vlink="#000099">

</body></noframes>

</html>