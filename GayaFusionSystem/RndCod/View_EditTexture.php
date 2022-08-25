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
    <td align="center" width="26%" class="TopContentTitleRight">TEXTURE</td>
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
$result = mysql_query("SELECT * FROM tblTexture WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>

<form enctype="multipart/form-data" name="test_form" method="post" action="EditTexture.php" >
<table class="InLineFormTABLE" width="850" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td class="InlineDataTD" width="14%">Code</td>
    <td class="InlineDataTD" ><input type="text" name="Code" value="<?php echo $alldata['TextureCode'] ?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Description</td>
    <td class="InlineDataTD"><input type="text" name="Description" value="<?php echo $alldata['TextureDescription'] ?>" /></td>
  </tr>
  <tr>
    <td class="InlineDataTD">Date</td>
    <td class="InlineDataTD"><input type="text" name="DateField" value="<?php echo $alldata['TextureDate']; ?>" size="10" />&nbsp;<A HREF="javascript:void(0)" onClick="showCalendar(test_form.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></A></td>
  </tr>
  <tr>
    <td class="InLineDataTD">Technical Draw </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['TextureTechDraw'])){
				echo "<input type=\"file\" name=\"TechDraw\" value=\"\" />&nbsp;(600 x 750)";
			}
			else{
				echo substr($alldata['TextureTechDraw'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelTechDraw\" value=\"$alldata[TextureTechDraw]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InLineDataTD">Photo 1 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['TexturePhoto1'])){
				echo "<input type=\"file\" name=\"Photo1\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['TexturePhoto1'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto1\" value=\"$alldata[TexturePhoto1]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 2 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['TexturePhoto2'])){
				echo "<input type=\"file\" name=\"Photo2\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['TexturePhoto2'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto2\" value=\"$alldata[TexturePhoto2]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 3 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['TexturePhoto3'])){
				echo "<input type=\"file\" name=\"Photo3\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['TexturePhoto3'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto3\" value=\"$alldata[TexturePhoto3]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Photo 4 </td>
    <td class="InlineDataTD">
		<?php 
			if (empty($alldata['TexturePhoto4'])){
				echo "<input type=\"file\" name=\"Photo4\" value=\"\" />&nbsp;(200 x 200)";
			}
			else{
				echo substr($alldata['TexturePhoto4'],15).".";
				echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelPhoto4\" value=\"$alldata[TexturePhoto4]\" /> ";
			}
		?>
	</td>
  </tr>
  <tr>
    <td class="InlineDataTD">Notes</td>
    <td class="InlineDataTD"><textarea name="TextureNotes" cols="50" rows="5"><?php echo $alldata['TextureNotes']; ?></textarea>
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
