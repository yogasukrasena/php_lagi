<?php session_start();

include ("settings.php");
include("language/$cfg_language");
include ("classes/db_functions.php");
include ("classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Public',$lang);


if(!$sec->isLoggedIn())
{
header ("location: login.php");
exit();
}
$tablename = $cfg_tableprefix.'tbluser';
$auth = $dbf->idToField($tablename,'type',$_SESSION['session_user_id']);
$first_name = $dbf->idToField($tablename,'firstname',$_SESSION['session_user_id']);
$last_name= $dbf->idToField($tablename,'lastname',$_SESSION['session_user_id']);

$name=$first_name.' '.$last_name;
$dbf->optimizeTables();

?>
<HTML>
<head> 

</head>
<body>
<?php 
if($auth=="Admin") 
{ 
?>
<p>
<img border="0" src="images/home_print.gif" width="33" height="29" valign="top"><font color="#005B7F" size="4">&nbsp;<b><?php echo $lang->home ?></b></font></p>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->adminHomeWelcomeMessage"; ?> </font></p>
<ul>
  <li><font face="Verdana" size="2"><a href="<?php echo "backupDB.php?onlyDB=$cfg_database&StartBackup=complete&nohtml=1"?>" ><?php echo $lang->backupDatabase ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="users/index.php"><?php echo $lang->addRemoveManageUsers ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="RnD/index.php"><?php echo "View R&amp;D" ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Collection/index.php"><?php echo $lang->ViewCollection ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Costing/index.php"><?php echo $lang->ViewCosting ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="Administration/index.php"><?php echo $lang->ViewAdministration ?></a></font></li>
  <li><font face="Verdana" size="2"><a href="settings/index.php"><?php echo $lang->configureSettings ?></a></font></li>
</ul>
<?php } elseif($auth=="RnD") { ?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" 

bordercolor="#111111" width="550" id="AutoNumber1">
  <tr>
    <td width="37">
    <img border="0" src="images/home_print.gif" width="33" height="29"></td>
    <td width="513"><font face="Verdana" size="4" color="#336699"><?php echo "$name 
    $lang->home" ?></font></td>
  </tr>
</table>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->RndHomeWelcomeMessage"; ?>
<?php } elseif($auth=="Costing") { ?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" 

bordercolor="#111111" width="550" id="AutoNumber1">
  <tr>
    <td width="37">
    <img border="0" src="images/home_print.gif" width="33" height="29"></td>
    <td width="513"><font face="Verdana" size="4" color="#336699"><?php echo "$name 
    $lang->home" ?></font></td>
  </tr>
</table>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->CostingHomeWelcomeMessage"; ?>
<?php
}
else
{
?>
<table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" 

bordercolor="#111111" width="550" id="AutoNumber1">
  <tr>
    <td width="37">
    <img border="0" src="images/home_print.gif" width="33" height="29"></td>
    <td width="513"><font face="Verdana" size="4" color="#336699"><?php echo "$name 
    $lang->home"?></font></td>
  </tr>
</table>
<p><font face="Verdana" size="2"><?php echo "$lang->welcomeTo $cfg_company $lang->AdministrationHomeWelcomeMessage"; ?>


<?php
}
$dbf->closeDBlink();

?>