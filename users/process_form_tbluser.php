<?php session_start(); ?>

<html>
<head>

</head>

<body>
<?php

include ("../settings.php");
include ("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

//creates 3 objects needed for this script.
$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Admin',$lang);

//checks if user is logged in.
if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit ();
}

//variables needed globably in this file.
$tablename="$cfg_tableprefix".'tbluser';
$field_names=null;
$field_data=null;
$id=-1;



	//checks to see if action is delete and an ID is specified. (only delete uses $_GET.)
	if(isset($_GET['action']) and isset($_GET['id']))
	{
		$action=$_GET['action'];
		$id=$_GET['id'];
	}
	//checks to make sure data is comming from form ($action is either delete or update)
	elseif(isset($_POST['FirstName']) and isset($_POST['LastName']) and isset($_POST['UserName']) 
	and isset($_POST['Password']) and isset($_POST['Cpassword']) and isset($_POST['Type'])
	and isset($_POST['id']) and isset($_POST['action']) )
	{
	
		$action=$_POST['action'];
		$id = $_POST['id'];
		
		//gets variables entered by user.
		$FirstName = $_POST['FirstName'];
		$LastName = $_POST['LastName'];
		$UserName = $_POST['UserName'];
		$Password = $_POST['Password'];
		$Cpassword = $_POST['Cpassword'];
		$Type = $_POST['Type'];
		
		
		//insure all fields are filled in.
		if($FirstName=='' or $LastName=='' or $UserName=='' or $Password=='' or $Cpassword=='' or $Type=='')
		{
			echo "$lang->forgottenFields";
			exit();
		}
		elseif($Password!=$Cpassword)
		{
			echo "$lang->passwordsDoNotMatch";
			exit();
		}
		elseif($action=='insert')
		{
			//encrypts password for new user and creates arrays to be used later.
			$Password=md5($Password);
			$field_names=array('FirstName','LastName','UserName','Password','type');
			$field_data=array("$FirstName","$LastName","$UserName","$Password","$Type");
	
		}
		elseif($Password=="*notchanged*")
		{
			/*
			Does NOT encrypt password because user did not change their password, but other
			info might have changed and needs to be updated.  Info stored in arrays.
			*/
			
			$field_names=array('FirstName','LastName','UserName','Type');
			$field_data=array("$FirstName","$LastName","$UserName","$Type");	
		}
		else
		{
			/*
			user did change password and the new password is encrypted.  Stores
			info in arrays
			*/
			
			$Password=md5($Password);
			$field_names=array('FirstName','LastName','UserName','Password','Type');
			$field_data=array("$FirstName","$LastName","$UserName","$Password","$Type");	
		}
	}
	else
	{
		//outputs error message because user did not use form to fill out data.
		echo "$lang->mustUseForm";
		exit();
	}
	


switch ($action)
{
	//finds out what action needs to be taken and preforms it by calling methods from dbf class.
	case $action=="insert":
		$dbf->insert($field_names,$field_data,$tablename,true);

	break;
		
	case $action=="update":
		//echo "$field_names[0],$field_names[1],$field_names[2],$field_names[3],$field_names[4]<br>";
		//echo "$field_data[0],$field_data[1],$field_data[2],$field_data[3],$field_data[4],<br>$tablename<br>$id";
		$dbf->update($field_names,$field_data,$tablename,$id,true);
				
	break;
	
	case $action=="delete":
		$dbf->deleteRow($tablename,$id);
	
	break;
	
	default:
		echo "$lang->noActionSpecified";
	break;
}
$dbf->closeDBlink();

?>
<br>
<a href="manage_users.php"><?php echo "$lang->manageUsers"; ?>--></a>
<br>
<a href="form_users.php?action=insert"><?php echo "$lang->createUser"; ?>--></a>
</body>
</html>