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
include ("../classes/form.php");
include ("../classes/display.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Admin',$lang);
$display=new display($dbf->conn,$cfg_theme,$cfg_currency_symbol,$lang);

if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
//set default values, these will change if $action==update.
$first_name_value='';
$last_name_value='';
$username_value='';
$type_value='';
$password_value='';
$id=-1;

//decides if the form will be used to update or add a user.
if(isset($_GET['action']))
{
	$action=$_GET['action'];
}
else
{
	$action="insert";
}

//if action is update, sets variables to what the current users data is.
if($action=="update")
{
	$display->displayTitle("$lang->updateUser");
	if(isset($_GET['id']))
	{
		$id=$_GET['id'];
		$tablename = "$cfg_tableprefix".'tbluser';
		$result = mysql_query("SELECT * FROM $tablename WHERE id=\"$id\"",$dbf->conn);
		
		$row = mysql_fetch_assoc($result);
		$first_name_value=$row['FirstName'];
		$last_name_value=$row['LastName'];
		$username_value=$row['UserName'];
		$password_value="*notchanged*";
		$type_value=$row['Type'];
	
	}

}
else
{
	$display->displayTitle("$lang->addUser");

}	
//creates a form object
$f1=new form('process_form_tbluser.php','POST','user','415',$cfg_theme,$lang);

//creates form parts.
$f1->createInputField("<b>$lang->firstName:</b>",'text','FirstName',"$first_name_value",'24','180');
$f1->createInputField("<b>$lang->lastName:</b>",'text','LastName',"$last_name_value",'24','180');
$f1->createInputField("<b>$lang->username:</b><i>($lang->usedInLogin)</i>",'text','UserName',"$username_value",'24','180');

$option_values=array("$type_value",'Admin','RnD', 'Costing', 'Administration');
$option_titles=array("$type_value","$lang->admin","$lang->RnD", "$lang->Costing", "$lang->Administration");
$f1->createSelectField("<b>$lang->type:</b> ",'Type',$option_values,$option_titles,'180');

$f1->createInputField("<b>$lang->password:</b>",'password','Password',"$password_value",'24','180');
$f1->createInputField("<b>$lang->confirmPassword:</b>",'password','Cpassword',"$password_value",'24','180');

//sends 2 hidden varibles needed for process_form_users.php.
echo "		
		<input type='hidden' name='action' value='$action'>
		<input type='hidden' name='id' value='$id'>";
$f1->endForm();

$dbf->closeDBlink();

?>
</body>
</html>	




