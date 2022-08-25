<?php
session_start();
include ("../Includes/sql.php");
$ClayType = $_POST['ClayType'];
$PricePerKG = $_POST['PricePerKG'];
$codehid = $_POST['CodeHid'];

if (!$codehid == null){
	$UpdateQuery="UPDATE tblCosting_Clay SET 
		tblCosting_Clay.ClayType = '$ClayType', 
		tblCosting_Clay.PricePerKG = '$PricePerKG' 
		where tblCosting_Clay.ID = '$codehid';";
	$Update = mysql_query($UpdateQuery);
	if ($Update)
	{
		header("location: View_Clay.php");
	}else
	{
	//include(
	$sala = mysql_error();
	echo "$sala";
	echo "Failed Edit Data";
	}
}else{ 
	//$ceksedia = mysql_query("select ClayType from $tabelnya where $field1 = '$codescnew'");
	//$hasilcek = mysql_num_rows($ceksedia);
	$insertquery="insert into tblCosting_Clay (ClayType, PricePerKG) value('$ClayType', '$PricePerKG')";
	//If ($hasilcek >= 1){
		//echo "<br><br><br><center>Code Already Use.</center><br><br><br>";
		//die();
	//}else{	
		$insert=mysql_query($insertquery);
	//}
	
	if ($insert)
	{
		header("location: View_Clay.php");
	}else
	{
	//include(
	$sala = mysql_error();
	echo "$sala";
	echo "Failed Add New Data";

	}
}
?>

