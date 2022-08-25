<?php
session_start();
include ("../Includes/sql.php");
$DesignCode = $_POST['DesignSelect'];
$TextureCode = $_POST['TextureSelect'];
$NameCode = $_POST['NameSelect'];
$ColorCode = $_POST['ColorSelect'];
$CategoryCode = $_POST['CategorySelect'];
$MaterialCode = $_POST['MaterialSelect'];
$SizeCode = $_POST['SizeSelect'];

echo "$DesignCode"."<br>"."$TextureCode"."<br>"."$NameCode"."<br>"."$ColorCode"."<br>"."$CategoryCode"."<br>"."$MaterialCode"."<br>"."$SizeCode"."<br>";
?>

