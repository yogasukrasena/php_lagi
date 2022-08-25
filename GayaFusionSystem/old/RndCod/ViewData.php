<?php
session_start();
include ("../Includes/sql.php");
$tabelnya = $_POST['tablename'];
$field1 = $_POST['field1'];
$field2 = $_POST['field2'];
$codescnew = $_POST['codescnew'];
$descscnew = $_POST['descscnew'];
$ambildata = mysql_query("select * from $tabelnya");
$ceksedia = mysql_query("select $field1 from $tabelnya where $field1 = '$codescnew'");
$hasilcek = mysql_num_rows($ceksedia);
$insertquery="insert into $tabelnya ($field1, $field2) value('$codescnew', '$descscnew')";
If ($hasilcek >= 1){
	echo "<br><br><br><center>Code Already Use.</center><br><br><br>";
	die();
}
else{	
	$insert=mysql_query($insertquery);
}
if ($insert)
{
	//include("../header2.php");
	echo "<br><br><br><center>joz</center><br><br><br>";
//	die();
}
else
{
	//include(
	echo "gagal bleh";

}
?>

