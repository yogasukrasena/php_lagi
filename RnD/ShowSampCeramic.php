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
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Sample Ceramic - Work Plan</title>
<link rel="stylesheet" type="text/css" href="../Includes/Graphite.css">
</head>
<body link="#000000" vlink="#000000" alink="#0000ff" bgcolor="#ffffff" text="#000000" class="GraphitePageBODY">
<?php
error_reporting(0);
$id=$_GET['sid'];
$Casting1 = $_GET['Casting1'];
$Casting2 = $_GET['Casting2'];
$Casting3 = $_GET['Casting3'];
$Casting4 = $_GET['Casting4'];
$Estruder1 = $_GET['Estruder1'];
$Estruder2 = $_GET['Estruder2'];
$Estruder3 = $_GET['Estruder3'];
$Estruder4 = $_GET['Estruder4'];
$Texture1 = $_GET['Texture1'];
$Texture2 = $_GET['Texture2'];
$Texture3 = $_GET['Texture3'];
$Texture4 = $_GET['Texture4'];
$Tools1 = $_GET['Tools1'];
$Tools2 = $_GET['Tools2'];
$Tools3 = $_GET['Tools3'];
$Tools4 = $_GET['Tools4'];
$Engobe1 = $_GET['Engobe1'];
$Engobe2 = $_GET['Engobe2'];
$Engobe3 = $_GET['Engobe3'];
$Engobe4 = $_GET['Engobe4'];
$StainOxide1 = $_GET['StainOxide1'];
$StainOxide2 = $_GET['StainOxide2'];
$StainOxide3 = $_GET['StainOxide3'];
$StainOxide4 = $_GET['StainOxide4'];
$Glaze1 = $_GET['Glaze1'];
$Glaze2 = $_GET['Glaze2'];
$Glaze3 = $_GET['Glaze3'];
$Glaze4 = $_GET['Glaze4'];
$DesignMat1 = $_GET['DesignMat1'];
$DesignMat2 = $_GET['DesignMat2'];
$DesignMat3 = $_GET['DesignMat3'];
$DesignMat4 = $_GET['DesignMat4'];
$result = mysql_query("SELECT SampleCeramic.*, tblClay.ClayDescription FROM SampleCeramic INNER JOIN tblClay ON SampleCeramic.Clay = tblClay.ClayCode WHERE SampleCeramic.sID = $id");
$alldata = mysql_fetch_array($result);
$ResultCasting1 = mysql_query("SELECT CastingDescription FROM tblCasting WHERE CastingCode = '$Casting1'");
$ResultCasting2 = mysql_query("SELECT CastingDescription FROM tblCasting WHERE CastingCode = '$Casting2'");
$ResultCasting3 = mysql_query("SELECT CastingDescription FROM tblCasting WHERE CastingCode = '$Casting3'");
$ResultCasting4 = mysql_query("SELECT CastingDescription FROM tblCasting WHERE CastingCode = '$Casting4'");
$DataCasting1 = mysql_fetch_array($ResultCasting1);
$DataCasting2 = mysql_fetch_array($ResultCasting2);
$DataCasting3 = mysql_fetch_array($ResultCasting3);
$DataCasting4 = mysql_fetch_array($ResultCasting4);

$ResultEstruder1 = mysql_query("SELECT EstruderDescription FROM tblEstruder WHERE EstruderCode = '$Estruder1'");
$ResultEstruder2 = mysql_query("SELECT EstruderDescription FROM tblEstruder WHERE EstruderCode = '$Estruder2'");
$ResultEstruder3 = mysql_query("SELECT EstruderDescription FROM tblEstruder WHERE EstruderCode = '$Estruder3'");
$ResultEstruder4 = mysql_query("SELECT EstruderDescription FROM tblEstruder WHERE EstruderCode = '$Estruder4'");
$DataEstruder1 = mysql_fetch_array($ResultEstruder1);
$DataEstruder2 = mysql_fetch_array($ResultEstruder2);
$DataEstruder3 = mysql_fetch_array($ResultEstruder3);
$DataEstruder4 = mysql_fetch_array($ResultEstruder4);

$ResultTexture1 = mysql_query("SELECT TextureDescription FROM tblTexture WHERE TextureCode = '$Texture1'");
$ResultTexture2 = mysql_query("SELECT TextureDescription FROM tblTexture WHERE TextureCode = '$Texture2'");
$ResultTexture3 = mysql_query("SELECT TextureDescription FROM tblTexture WHERE TextureCode = '$Texture3'");
$ResultTexture4 = mysql_query("SELECT TextureDescription FROM tblTexture WHERE TextureCode = '$Texture4'");
$DataTexture1 = mysql_fetch_array($ResultTexture1);
$DataTexture2 = mysql_fetch_array($ResultTexture2);
$DataTexture3 = mysql_fetch_array($ResultTexture3);
$DataTexture4 = mysql_fetch_array($ResultTexture4);

$ResultTools1 = mysql_query("SELECT ToolsPhoto1 FROM tblTools WHERE ToolsCode = '$Tools1'");
$ResultTools2 = mysql_query("SELECT ToolsPhoto1 FROM tblTools WHERE ToolsCode = '$Tools2'");
$ResultTools3 = mysql_query("SELECT ToolsPhoto1 FROM tblTools WHERE ToolsCode = '$Tools3'");
$ResultTools4 = mysql_query("SELECT ToolsPhoto1 FROM tblTools WHERE ToolsCode = '$Tools4'");
$DataTools1= mysql_fetch_array($ResultTools1);
$DataTools2= mysql_fetch_array($ResultTools2);
$DataTools3= mysql_fetch_array($ResultTools3);
$DataTools4= mysql_fetch_array($ResultTools4);

$ResultEngobe1 = mysql_query("SELECT EngobeDescription FROM tblEngobe WHERE EngobeCode = '$Engobe1'");
$ResultEngobe2 = mysql_query("SELECT EngobeDescription FROM tblEngobe WHERE EngobeCode = '$Engobe2'");
$ResultEngobe3 = mysql_query("SELECT EngobeDescription FROM tblEngobe WHERE EngobeCode = '$Engobe3'");
$ResultEngobe4 = mysql_query("SELECT EngobeDescription FROM tblEngobe WHERE EngobeCode = '$Engobe4'");
$DataEngobe1= mysql_fetch_array($ResultEngobe1);
$DataEngobe2= mysql_fetch_array($ResultEngobe2);
$DataEngobe3= mysql_fetch_array($ResultEngobe3);
$DataEngobe4= mysql_fetch_array($ResultEngobe4);

$ResultStainOxide1 = mysql_query("SELECT StainOxideDescription FROM tblStainOxide WHERE StainOxideCode = '$StainOxide1'");
$ResultStainOxide2 = mysql_query("SELECT StainOxideDescription FROM tblStainOxide WHERE StainOxideCode = '$StainOxide2'");
$ResultStainOxide3 = mysql_query("SELECT StainOxideDescription FROM tblStainOxide WHERE StainOxideCode = '$StainOxide3'");
$ResultStainOxide4 = mysql_query("SELECT StainOxideDescription FROM tblStainOxide WHERE StainOxideCode = '$StainOxide4'");
$DataStainOxide1= mysql_fetch_array($ResultStainOxide1);
$DataStainOxide2= mysql_fetch_array($ResultStainOxide2);
$DataStainOxide3= mysql_fetch_array($ResultStainOxide3);
$DataStainOxide4= mysql_fetch_array($ResultStainOxide4);

$ResultGlaze1 = mysql_query("SELECT GlazeDescription FROM tblGlaze WHERE GlazeCode = '$Glaze1'");
$ResultGlaze2 = mysql_query("SELECT GlazeDescription FROM tblGlaze WHERE GlazeCode = '$Glaze2'");
$ResultGlaze3 = mysql_query("SELECT GlazeDescription FROM tblGlaze WHERE GlazeCode = '$Glaze3'");
$ResultGlaze4 = mysql_query("SELECT GlazeDescription FROM tblGlaze WHERE GlazeCode = '$Glaze4'");
$DataGlaze1= mysql_fetch_array($ResultGlaze1);
$DataGlaze2= mysql_fetch_array($ResultGlaze2);
$DataGlaze3= mysql_fetch_array($ResultGlaze3);
$DataGlaze4= mysql_fetch_array($ResultGlaze4);

$ResultDesignMat1 = mysql_query("SELECT tblDesMaterial.DmDescription, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID WHERE DmCode = '$DesignMat1'");
$ResultDesignMat2 = mysql_query("SELECT tblDesMaterial.DmDescription, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID WHERE DmCode = '$DesignMat2'");
$ResultDesignMat3 = mysql_query("SELECT tblDesMaterial.DmDescription, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID WHERE DmCode = '$DesignMat3'");
$ResultDesignMat4 = mysql_query("SELECT tblDesMaterial.DmDescription, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID WHERE DmCode = '$DesignMat4'");
$DataDesignMat1= mysql_fetch_array($ResultDesignMat1);
$DataDesignMat2= mysql_fetch_array($ResultDesignMat2);
$DataDesignMat3= mysql_fetch_array($ResultDesignMat3);
$DataDesignMat4= mysql_fetch_array($ResultDesignMat4);

?>
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <tr>
      <td class="GraphiteColumnTD" colspan="6" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>SAMPLE CERAMIC</h2></td>
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
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Clay&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Clay']; ?>&nbsp; &nbsp;<?php echo $alldata['ClayDescription']?></td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">KG&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['ClayKG'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Build Technique&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['BuildTech'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['BuildTechNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Rim&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Rim'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Feet&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Feet'] ?>&nbsp;</td> 
    </tr>
    <tr>
	  <?php
	  $QueryCasting = mysql_query("SELECT CastingDescription FROM tblCasting where CastingCode = '$alldata[Casting1]'");
	  $ResultCasting = mysql_fetch_array($QueryCasting);
	  ?>
	  <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Casting&nbsp;</td> 
	  <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Casting1']." - ".$DataCasting1['CastingDescription']?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Casting2']." - ".$DataCasting2['CastingDescription'] ?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Casting3']." - ".$DataCasting3['CastingDescription'] ?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Casting4']." - ".$DataCasting4['CastingDescription'] ?></td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Casting Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['CastingNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Estruder&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Estruder1']." - ".$DataEstruder1['EstruderDescription'] ?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Estruder2']." - ".$DataEstruder2['EstruderDescription'] ?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Estruder3']." - ".$DataEstruder3['EstruderDescription'] ?></td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Estruder4']." - ".$DataEstruder4['EstruderDescription'] ?></td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Estruder Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['EstruderNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Texture&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Texture1']." - ".$DataTexture1['TextureDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Texture2']." - ".$DataTexture2['TextureDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Texture3']." - ".$DataTexture3['TextureDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Texture4']." - ".$DataTexture4['TextureDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Texture Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['TextureNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Tools&nbsp;</td> 
      <td width="200" class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$DataTools1[ToolsPhoto1]\" >" ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$DataTools2[ToolsPhoto1]\" >" ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$DataTools3[ToolsPhoto1]\" >" ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTD"><?php echo "<img class=\"GraphiteInput\" width=\"150\" src=\"../UploadImg/$DataTools4[ToolsPhoto1]\" >" ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Tools Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['ToolsNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Engobe&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Engobe1']." - ".$DataEngobe1['EngobeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Engobe2']." - ".$DataEngobe2['EngobeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Engobe3']." - ".$DataEngobe3['EngobeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Engobe4']." - ".$DataEngobe4['EngobeDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Engobe Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['EngobeNote'] ?>&nbsp;</td> 
    </tr>
	<!-- disini nti bisquetemp -->
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Stain &amp; Oxide&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['StainOxide1']." - ".$DataStainOxide1['StainOxideDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['StainOxide2']." - ".$DataStainOxide2['StainOxideDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['StainOxide3']." - ".$DataStainOxide3['StainOxideDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['StainOxide4']." - ".$DataStainOxide4['StainOxideDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Stain &amp; Oxide Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['StainOxideNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Glaze&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Glaze1']." - ".$DataGlaze1['GlazeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Glaze2']." - ".$DataGlaze2['GlazeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Glaze3']." - ".$DataGlaze3['GlazeDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['Glaze4']." - ".$DataGlaze4['GlazeDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Density&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['GlazeDensity1'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['GlazeDensity2'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['GlazeDensity3'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['GlazeDensity4'] ?>&nbsp;</td> 
    </tr>
	<tr>
	  <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Glaze Temp&nbsp;</td>
	  <td class="GraphiteDataTD" colspan="4">
	  	<?php
		if (empty($alldata['GlazeTemp']))
		{
			echo "";
		}
		else
		{
		 	echo $alldata['GlazeTemp']."&deg;" ;
		}
		?>&nbsp;
	  </td>
	</tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Glaze Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo "$alldata[GlazeNote]" ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Bisque Temp&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['BisqueTemp'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Firing Atmosphere&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Firing'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Firing Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['FiringNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Final Size&nbsp;</td> 
      <td width="125" class="GraphiteDataTableTD">&Oslash;=&nbsp;<?php echo $alldata['Diameter'] ?>&nbsp;</td>
	  <td width="125" class="GraphiteDataTableTD">W=&nbsp;<?php echo $alldata['Width'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTableTD">L=&nbsp;<?php echo $alldata['Length'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTableTD">H=&nbsp;<?php echo $alldata['Height'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['FinalSizeNote'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Design Material&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMat1']." - ".$DataDesignMat1['DmDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMat2']." - ".$DataDesignMat2['DmDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMat3']." - ".$DataDesignMat3['DmDescription'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMat4']." - ".$DataDesignMat4['DmDescription'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Quantity&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMatQty1']." ".$DataDesignMat1['UnitValue'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMatQty2']." ".$DataDesignMat2['UnitValue'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMatQty3']." ".$DataDesignMat3['UnitValue'] ?>&nbsp;</td> 
      <td width="200" class="GraphiteDataTableTD"><?php echo $alldata['DesignMatQty4']." ".$DataDesignMat4['UnitValue'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavNotesTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTDNotes"><?php echo $alldata['DesignMatNote'] ?>&nbsp;</td> 
    </tr>
</table>
<!-- END Grid c_color_c_design_c_textur --></p>
</body>
</html>