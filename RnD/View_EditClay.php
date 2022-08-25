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
    <td align="center" width="26%" class="TopContentTitleRight">CLAY</td>
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
$result = mysql_query("SELECT * FROM tblClay WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>

<form enctype="multipart/form-data" name="test_form" method="post" action="EditClay.php" >
<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td class="InLineDataTD" width="14%">Code</td>
    <td class="InlineDataTD" ><input type="text" name="Code" value="<?php echo $alldata['ClayCode'] ?>" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Description</td>
    <td class="InlineDataTD"><input type="text" name="Description" value="<?php echo $alldata['ClayDescription'] ?>" /></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Date</td>
    <td class="InlineDataTD"><input type="text" name="DateField" value="<?php echo $alldata['ClayDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(test_form.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Technical Draw </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['ClayTechDraw'])){
				echo "<input type=\"file\" name=\"TechDraw\" value=\"\" />&nbsp;(600 x 750)";
			}
			else{
				echo substr($alldata['ClayTechDraw'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelTechDraw\" value=\"$alldata[ClayTechDraw]\" /> ";
			}
		?>	
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Photo 1 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['ClayPhoto1'])){
				echo "<input type=\"file\" name=\"Photo1\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['ClayPhoto1'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto1\" value=\"$alldata[ClayPhoto1]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 2 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['ClayPhoto2'])){
				echo "<input type=\"file\" name=\"Photo2\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['ClayPhoto2'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto2\" value=\"$alldata[ClayPhoto2]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 3 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['ClayPhoto3'])){
				echo "<input type=\"file\" name=\"Photo3\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['ClayPhoto3'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto3\" value=\"$alldata[ClayPhoto3]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 4 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['ClayPhoto4'])){
				echo "<input type=\"file\" name=\"Photo4\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['ClayPhoto4'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto4\" value=\"$alldata[ClayPhoto4]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Notes</td>
    <td class="InlineDataTD"><textarea name="ClayNotes" cols="50" rows="5"><?php echo $alldata['ClayNotes']; ?></textarea>
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
