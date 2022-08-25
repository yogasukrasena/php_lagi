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
//9 juni
$id = $_POST['id'];
$TipeForm = $_POST['TipeForm'];
$DesignCode = $_POST['DesignSelect'];
$TextureCode = $_POST['TextureSelect'];
$NameCode = $_POST['NameSelect'];
$ColorCode = $_POST['ColorSelect'];
$CategoryCode = $_POST['CategorySelect'];
$MaterialCode = $_POST['MaterialSelect'];
$SizeCode = $_POST['SizeSelect'];
$CollectCode = $DesignCode.$NameCode.$CategoryCode.$SizeCode.$TextureCode.$ColorCode.$MaterialCode;

	if (empty($DesignCode))
	{
		$error = "The value in field Design is required.";
	}
	if (empty($TextureCode))
	{
		$error .= "<br>The value in field Texture is required.";
	} 
	if (empty($NameCode))
	{
		$error .= "<br>The value in field Name is required.";
	} 
	if (empty($ColorCode))
	{
		$error .= "The value in field Color is required.";
	} 
	if (empty($CategoryCode))
	{
		$error .= "The value in field Category is required.";
	} 
	if (empty($MaterialCode))
	{
		$error .= "The value in field Material is required.";
	} 
	if (empty($SizeCode))
	{
		$error .= "The value in field Size is required.";
	} 
if (empty($error))
{
	If ($TipeForm == "Add")
	{
		$QueryOperation = "INSERT INTO tblCollect_Master (DesignCode, TextureCode, NameCode, ColorCode, CategoryCode, MaterialCode, SizeCode, CollectCode) ";
		$QueryOperation .= " VALUE ('$DesignCode', '$TextureCode', '$NameCode', '$ColorCode', '$CategoryCode', '$MaterialCode', '$SizeCode','$CollectCode')";
		
		$ExecQuery = mysql_query($QueryOperation);
		if ($ExecQuery)
		{
			header("location: MainCollection.php");
		}
		else
		{
			$sala = mysql_error();
			echo "$sala"."<br>"."Failed Add Data";
		}
	}
	elseif ($TipeForm == "Edit")
	{
		$QueryOperation="UPDATE tblCollect_Master SET 
			tblCollect_Master.DesignCode = '$DesignCode', 
			tblCollect_Master.TextureCode = '$TextureCode',
			tblCollect_Master.NameCode = '$NameCode',
			tblCollect_Master.ColorCode = '$ColorCode',
			tblCollect_Master.CategoryCode = '$CategoryCode',
			tblCollect_Master.MaterialCode = '$MaterialCode',
			tblCollect_Master.SizeCode = '$SizeCode', 
			tblCollect_Master.CollectCode = '$CollectCode' 	
			where tblCollect_Master.ID = '$id';";
		$ExecQuery = mysql_query($QueryOperation);
		if ($ExecQuery)
		{
			header("location: MainCollection.php");
		}
		else
		{
			$sala = mysql_error();
			echo "$sala"."<br>"."Failed Update Data";
		}
	}
	elseif ($TipeForm == "Del")
	{
		$QueryOperation="Delete FROM tblCollect_Master WHERE tblCollect_Master.ID = '$id';";
		$ExecQuery = mysql_query($QueryOperation);
		if ($ExecQuery)
		{
			header("location: MainCollection.php");
		}
		else
		{
			$sala = mysql_error();
			echo "$sala"."<br>"."Failed Delete Data";
		}
	}
}
else
{
	echo "$error"."<br>"."Failed Update Data";
}
?>

