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
$id=$_GET['sid'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM SampleCeramic WHERE sID = $id");
$alldata = mysql_fetch_array($result);
?>
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <tr>
      <td class="GraphiteColumnTD" colspan="6" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>SAMPLE Ceramic</h2></td>
				<td height="50"><img src="../images/logo GAYA/logo GAYA C n D transp kcl.jpg" width="300" height="50"></td> 
        	</tr>
   	  	</table>
	  </td> 
    </tr>
    <!-- END Error -->
    <tr>
      <td class="GraphiteDataTD" nowrap colspan="6" align="right">&nbsp;</td> 
    </tr>
	<tr>
    	<td class="GraphiteDataTD" nowrap colspan="6" align="center" valign="middle">
        <p><?php echo "<img class=\"GraphiteInput\" height=\"750\" width=\"600\" src=\"../UploadImg/$alldata[TechDraw]\" >" ?></p> </td> 
    </tr>
	<tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
	<tr>
		<td colspan="6">
	  	<table width="100%" cellpadding="3" cellspacing="0" border="0">
			<tr>
	  			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Photo1]\" >" ?> </td> 
      			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Photo2]\" >" ?></td> 
      			<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Photo3]\" >" ?></td>
				<td class="GraphiteDataTD" align="center"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Photo4]\" >" ?></td> 
			</tr>
		</table>
	  	</td>
	</tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
	<tr>
      <td colspan="2" width="162" align="center" nowrap class="GraphiteFieldCaptionTD">Code</td> 
      <td colspan="4" width="75" align="center" class="GraphiteFieldCaptionTD">Description</td> 
    </tr>
    <tr>
      <td colspan="2" class="GraphiteDataTD" nowrap="nowrap"><?php echo $alldata['SampleCode'] ?>&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Description'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
	<tr>
      <td colspan="2" width="100" align="center" nowrap class="GraphiteFieldCaptionTD">Barcode</td> 
      <td colspan="2" width="150" align="center" class="GraphiteFieldCaptionTD">Client Code</td> 
      <td colspan="2" width="200" align="center" class="GraphiteFieldCaptionTD">Client Description</td> 
    </tr>
    <tr>
      <td colspan="2" class="GraphiteDataTD" nowrap="nowrap">&nbsp;</td> 
      <td colspan="2" class="GraphiteDataTD"><?php echo $alldata['ClientCode'] ?>&nbsp;</td> 
      <td colspan="2" class="GraphiteDataTD"><?php echo $alldata['ClientDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
    <tr>
      <td class="GraphiteFieldCaptionTD" colspan="6" nowrap>TECHNICAL NOTES</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Clay&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Clay'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">KG&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['ClayKG'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Build Technique&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['BuildTech'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['BuildTechNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Rim&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Rim'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Feet&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Feet'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Casting&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Casting1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Casting2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Casting3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Casting4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Casting Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['CastingNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Estruder&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Estruder1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Estruder2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Estruder3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Estruder4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Estruder Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['EstruderNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Texture&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Texture1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Texture2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Texture3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Texture4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Texture Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['TextureNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Tools&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Tools1]\" >" ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Tools2]\" >" ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Tools3]\" >" ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$alldata[Tools4]\" >" ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Tools Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['ToolsNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Engobe&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Engobe1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Engobe2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Engobe3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Engobe4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Engobe Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['EngobeNote'] ?>&nbsp;</td> 
    </tr>
	<!-- disini nti bisquetemp -->
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Stain &amp; Oxide&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['StainOxide1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['StainOxide2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['StainOxide3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['StainOxide4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Stain &amp; Oxide Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['StainOxideNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Glaze&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Glaze1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Glaze2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Glaze3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['Glaze4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Density&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['GlazeDensity1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['GlazeDensity2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['GlazeDensity3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['GlazeDensity4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Glaze Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['GlazeNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Bisque Temp&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['BisqueTemp'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Firing Atmosphere&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Firing'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Firing Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['FiringNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Final Size&nbsp;</td> 
      <td width="125" class="GraphiteDataTD">&Oslash;=&nbsp;<?php echo $alldata['Diameter'] ?>&nbsp;</td>
	  <td width="125" class="GraphiteDataTD">W=&nbsp;<?php echo $alldata['Width'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTD">L=&nbsp;<?php echo $alldata['Length'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTD">H=&nbsp;<?php echo $alldata['Height'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['FinalSizeNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Other Material&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMat1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMat2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMat3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMat4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Quantity&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMatQty1'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMatQty2'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMatQty3'] ?>&nbsp;</td> 
      <td class="GraphiteDataTD"><?php echo $alldata['OtherMatQty4'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['OtherMatNote'] ?>&nbsp;</td> 
    </tr>
</table>
<!-- END Grid c_color_c_design_c_textur --></p>
</body>
</html>