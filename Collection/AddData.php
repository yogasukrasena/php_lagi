<?php
session_start();
session_start();
include ("../settings.php");
include ("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");
$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}

$page = $_POST['pagename'];
$tabelnya = $_POST['tablename'];
$field0 = $_POST['field0'];
$field1 = $_POST['field1'];
$field2 = $_POST['field2'];
$codescnew = $_POST['codenew'];
$descscnew = $_POST['descnew'];
$codehid = $_POST['CodeHid'];
$ceksedia = mysql_query("select $field1 from $tabelnya where $field1 = '$codescnew'");
$hasilcek = mysql_num_rows($ceksedia);
if (!$codehid == null)
{	
	$UpdateQuery="UPDATE $tabelnya SET 
		$tabelnya.$field1 = '$codescnew', 
		$tabelnya.$field2 = '$descscnew' 
		where $tabelnya.$field0 = '$codehid';";
	$Update = mysql_query($UpdateQuery);
		if ($Update)
		{
			header("location: $page");
		}else
		{
		//include(
		$sala = mysql_error();
		echo "$sala";
		echo "Failed Edit Data";
		}
}
else
{
	//$hasilcek = mysql_num_rows($ceksedia);
	$insertquery="insert into $tabelnya ($field1, $field2) value('$codescnew', '$descscnew')";
	If ($hasilcek >= 1)
	{
		echo "<br><br><br><center>Code Already Use.</center><br><br><br>";
		die();
	}
	else
	{	
		$insert=mysql_query($insertquery);
	}
	if ($insert)
	{
	//include("../header2.php");
		header("location: $page");
//	die();
	}
	else
	{
	$sala = mysql_error();
	echo "$sala";
	echo "Failed Add New Data";
	}
}
?>

