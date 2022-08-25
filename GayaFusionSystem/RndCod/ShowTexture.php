<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>

<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Gaya Design - Work Plan</title>
<link rel="stylesheet" type="text/css" href="../Includes/Graphite.css">
</head>
<body link="#000000" vlink="#000000" alink="#0000ff" bgcolor="#ffffff" text="#000000" class="GraphitePageBODY">
<?php
error_reporting(0);
$id=$_GET['id'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM tblTexture WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>
<!-- BEGIN Record c_codification -->
  <font class="GraphiteFormHeaderFont">Work Plan Gaya&nbsp;Design </font> 
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <!-- BEGIN Error -->
    <tr>
      <td class="GraphiteColumnTD" colspan="2" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>TEXTURE</h2></td>
				<td height="50"><img src="../images/logo GAYA/logo GAYA C n D transp kcl.jpg" width="300" height="50"></td> 
        	</tr>
      	</table>	  </td> 
    </tr>
    <!-- END Error -->
    <tr>
      <td class="GraphiteDataTD" nowrap colspan="2" align="right">&nbsp;</td> 
    </tr>
    <tr>
      <td width="97" align="center" nowrap class="GraphiteFieldCaptionTD">Code</td> 
      <td width="512" align="center" class="GraphiteFieldCaptionTD">Description</td> 
    </tr>
 
    <tr>
      <td class="GraphiteDataTD" nowrap="nowrap"><?php echo $alldata['TextureCode'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['TextureDescription'] ?>&nbsp;</td> 
    </tr>
 	<tr>
      <td class="GraphiteDataTD" nowrap colspan="2" align="right">&nbsp;</td> 
    </tr>
    <tr>
      <td class="GraphiteFieldCaptionTD" colspan="2" nowrap>Notes</td> 
    </tr>
 
    <tr>
      <td class="GraphiteDataTD" colspan="2" nowrap>&nbsp;</td> 
    </tr>
 
    <tr>
      <td class="GraphiteDataTD" nowrap colspan="2">
	  	<table border="1" cellpadding="3" cellspacing="0" width="100%">
			<tr>
				<td height="500" valign="top"><?php echo $alldata['TextureNotes'] ?></td>
			</tr>
		</table>	
	  </td> 
    </tr>
	<tr>
      <td class="GraphiteDataTD" colspan="2" nowrap>&nbsp;</td> 
    </tr>
 	<tr>
      <td class="GraphiteFieldCaptionTD" valign="middle" nowrap align="center" colspan="2">&nbsp;Photo</td> 
    </tr>
	<tr>
	  <td colspan="2">
	  	<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<tr>
	  			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[TexturePhoto1]\" >" ?> </td> 
      			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[TexturePhoto2]\" >" ?></td> 
      			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[TexturePhoto3]\" >" ?></td>
				<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[TexturePhoto4]\" >" ?></td> 
			</tr>
		</table>
	  </td>
    <tr>
      <td class="GraphiteFieldCaptionTD" valign="middle" nowrap align="center" colspan="2">&nbsp;Technical
        Drawing</td> 
    </tr>
 
    <tr>
      <td class="GraphiteDataTD" nowrap colspan="2" align="center" valign="middle">
        <p><?php echo "<img class=\"GraphiteInput\" height=\"750\" width=\"600\" src=\"../UploadImg/$alldata[TextureTechDraw]\" >" ?></p> </td> 
    </tr>
</table>
<!-- END Grid c_color_c_design_c_textur --></p>
</body>
</html>