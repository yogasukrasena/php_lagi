<?php	
session_start();
include ("../settings.php");
include("../language/$cfg_language");
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
?>

<html>
<head>
<SCRIPT LANGUAGE="JavaScript" src="calendar.js"></SCRIPT>
<title>Add Data</title></head>
<link rel="stylesheet" type="text/css" href="../Includes/Style.css">
<body>
<table width="765" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="39" width="74%" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    <td align="center" width="26%" class="TopContentTitleRight">SUPPLIER</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p>
<?php
error_reporting(0);
$id=$_GET['id'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM tblSupplier WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>

<form enctype="multipart/form-data" name="test_form" method="post" action="EditSupplier.php" >
<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td class="InlineDataTD" width="14%">Code</td>
    <td class="InlineDataTD" ><input type="text" name="Code" value="<?php echo $alldata['SupCode'] ?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Company</td>
    <td class="InlineDataTD"><input type="text" name="SupCompany" value="<?php echo $alldata['SupCompany']; ?>" size="25" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Contact Person </td>
    <td class="InlineDataTD"><input type="text" name="SupContact" value="<?php echo $alldata['SupContact']; ?>" size="25" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Address</td>
    <td class="InlineDataTD"><textarea name="SupAddress" cols="50" rows="5"><?php echo $alldata['SupAddress']; ?></textarea></td>
  </tr>
  <tr>
    <td class="InLineDataTD">HP </td>
    <td class="InlineDataTD"><input type="text" name="SupHP" value="<?php echo $alldata['SupHP'];?>" />	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Office </td>
    <td class="InlineDataTD"><input type="text" name="SupOffice" value="<?php echo $alldata['SupOffice'];?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Fax </td>
    <td class="InlineDataTD"><input type="text" name="SupFax" value="<?php echo $alldata['SupFax'];?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">E-mail</td>
    <td class="InlineDataTD"><input type="text" name="SupEmail" value="<?php echo $alldata['SupEmail'];?>" /></td>
  </tr>
    <tr>
    <td class="InlineDataTD" width="14%">Items</td>
    <td class="InlineDataTD" ><input type="text" name="SupItems" value="<?php echo $alldata['SupItems'];?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Other Info</td>
    <td class="InlineDataTD"><textarea name="SupOtherInfo" cols="50" rows="5"><?php echo $alldata['SupOtherInfo']; ?></textarea>
    &nbsp;</td>
  </tr>
  <tr>
    <td class="InLineFooterTD" colspan="2" align="center"><input type="hidden" value="<?php echo $alldata['ID']; ?>" name="ID"><input type="submit" name="submit" value="SUBMIT" size="30" />&nbsp;<input type="reset" name="cancel" value="CANCEL" size="30" /></td>
  </tr>
</table>
</form></td>
</tr>
</table>
</body>
</html>
