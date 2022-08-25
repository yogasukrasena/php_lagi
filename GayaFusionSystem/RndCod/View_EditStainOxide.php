<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
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
    <td align="center" width="26%" class="TopContentTitleRight">STAIN &amp; OXIDE</td>
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
$result = mysql_query("SELECT * FROM tblStainOxide WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>

<form enctype="multipart/form-data" name="test_form" method="post" action="EditStainOxide.php" >
<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td class="InlineDataTD" width="14%">Code</td>
    <td class="InlineDataTD" ><input type="text" name="Code" value="<?php echo $alldata['StainOxideCode'] ?>"/></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Description</td>
    <td class="InlineDataTD"><input type="text" name="Description" value="<?php echo $alldata['StainOxideDescription'] ?>"/></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Date</td>
    <td class="InlineDataTD"><input type="text" name="DateField" value="<?php echo $alldata['StainOxideDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(test_form.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Technical Draw </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['StainOxideTechDraw'])){
				echo "<input type=\"file\" name=\"TechDraw\" value=\"\" />&nbsp;(600 x 750)";
			}
			else{
				echo substr($alldata['StainOxideTechDraw'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelTechDraw\" value=\"$alldata[StainOxideTechDraw]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Photo 1 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['StainOxidePhoto1'])){
				echo "<input type=\"file\" name=\"Photo1\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['StainOxidePhoto1'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto1\" value=\"$alldata[StainOxidePhoto1]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 2 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['StainOxidePhoto2'])){
				echo "<input type=\"file\" name=\"Photo2\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['StainOxidePhoto2'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto2\" value=\"$alldata[StainOxidePhoto2]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 3 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['StainOxidePhoto3'])){
				echo "<input type=\"file\" name=\"Photo3\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['StainOxidePhoto3'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto3\" value=\"$alldata[StainOxidePhoto3]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 4 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['StainOxidePhoto4'])){
				echo "<input type=\"file\" name=\"Photo4\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['StainOxidePhoto4'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto4\" value=\"$alldata[StainOxidePhoto4]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Notes</td>
    <td class="InlineDataTD"><textarea name="StainOxideNotes" cols="50" rows="5"><?php echo $alldata['StainOxideNotes']; ?></textarea>
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
