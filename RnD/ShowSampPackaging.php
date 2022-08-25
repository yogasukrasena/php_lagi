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
<title>Sample Packaging - Work Plan</title>
<link rel="stylesheet" type="text/css" href="../Includes/Graphite.css">
</head>
<body link="#000000" vlink="#000000" alink="#0000ff" bgcolor="#ffffff" text="#000000" class="GraphitePageBODY">
<?php
error_reporting(0);
$id=$_GET['id'];
$DesMat1 = $_GET['DesMat1'];
$DesMat2 = $_GET['DesMat2'];
$DesMat3 = $_GET['DesMat3'];
$DesMat4 = $_GET['DesMat4'];
$DesMat5 = $_GET['DesMat5'];

$Supplier1 = $_GET['Supplier1'];
$Supplier2 = $_GET['Supplier2'];
$Supplier3 = $_GET['Supplier3'];
$Supplier4 = $_GET['Supplier4'];
$Supplier5 = $_GET['Supplier5'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM SamplePackaging WHERE ID = $id");
$alldata = mysql_fetch_array($result);
$ResultDm1 = mysql_query("SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmCode = '$DesMat1'");
$ResultDm2 = mysql_query("SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmCode = '$DesMat2'");
$ResultDm3 = mysql_query("SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmCode = '$DesMat3'");
$ResultDm4 = mysql_query("SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmCode = '$DesMat4'");
$ResultDm5 = mysql_query("SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmCode = '$DesMat5'");
$ResultSup1 = mysql_query("SELECT SupCompany FROM tblSupplier WHERE SupCode = '$Supplier1'");
$ResultSup2 = mysql_query("SELECT SupCompany FROM tblSupplier WHERE SupCode = '$Supplier2'");
$ResultSup3 = mysql_query("SELECT SupCompany FROM tblSupplier WHERE SupCode = '$Supplier3'");
$ResultSup4 = mysql_query("SELECT SupCompany FROM tblSupplier WHERE SupCode = '$Supplier4'");
$ResultSup5 = mysql_query("SELECT SupCompany FROM tblSupplier WHERE SupCode = '$Supplier5'");
$alldata1 = mysql_fetch_array($ResultDm1);
$alldata2 = mysql_fetch_array($ResultDm2);
$alldata3 = mysql_fetch_array($ResultDm3);
$alldata4 = mysql_fetch_array($ResultDm4);
$alldata5 = mysql_fetch_array($ResultDm5);
$SupComp1 = mysql_fetch_array($ResultSup1);
$SupComp2 = mysql_fetch_array($ResultSup2);
$SupComp3 = mysql_fetch_array($ResultSup3);
$SupComp4 = mysql_fetch_array($ResultSup4);
$SupComp5 = mysql_fetch_array($ResultSup5);
?>
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <tr>
      <td class="GraphiteColumnTD" colspan="6" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>SAMPLE PACKAGING </h2></td>
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
      <td class="GraphiteFieldCaptionTD" colspan="6" nowrap>List of Design Material </td> 
    </tr>
 
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>
		  <table width="100%" cellpadding="3" cellspacing="0" border="1">
		  	<tr>
				<td width="30%" class="GraphiteDataTD"><strong>Design Material</strong></td>
				<td width="30%" class="GraphiteDataTD"><strong>Supplier</strong></td>
				<td width="10%" class="GraphiteDataTD"><strong>Qty</strong></td>
				<td width="10%" class="GraphiteDataTD"><strong>Unit</strong></td>
				<td width="10%" class="GraphiteDataTD"><strong>Unit Price</strong></td>
				<td width="10%" class="GraphiteDataTD"><strong>Total</strong></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['DesMat1']))
					{
						echo "";
					}
					else
					{
						echo $alldata['DesMat1']." - ".$alldata1['DmDescription'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata1['SupCompany']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat1']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata1['UnitValue']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata1['DmUnitPrice']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat1']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['DesMat2']))
					{
						echo "";
					}
					else
					{
					 	echo "$alldata[DesMat2]"." - "."$alldata2[DmDescription]";
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata2['SupCompany']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat2']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata2['UnitValue']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata2['DmUnitPrice']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat2']?> </td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['DesMat3']))
					{
						echo "";
					}
					else
					{
						echo $alldata['DesMat3']." - ".$alldata3['DmDescription'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata3['SupCompany']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat3']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata3['UnitValue']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata3['DmUnitPrice']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat3']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['DesMat4']))
					{
						echo "";
					}
					else
					{ 
						echo $alldata['DesMat4']." - ".$alldata4['DmDescription'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata4['SupCompany']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat4']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata4['UnitValue']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata4['DmUnitPrice']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat4']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['DesMat5']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['DesMat5']." - ".$alldata5['DmDescription'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata5['SupCompany']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat5']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata5['UnitValue']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata5['DmUnitPrice']?></td>
				<td width="10%" align="right" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat5']?></td>
			</tr>	
		  </table>	
	  </td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
    <tr>
      <td class="GraphiteFieldCaptionTD" colspan="6" nowrap>List of Work Supplier</td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>
		  <table width="100%" cellpadding="3" cellspacing="0" border="1">
		  	<tr>
				<td width="30%" class="GraphiteDataTD"><strong>Supplier</strong></td>
				<td width="30%" class="GraphiteDataTD"><strong>Material</strong></td>
				<td width="20%" class="GraphiteDataTD"><strong>Color</strong></td>
				<td width="20%" class="GraphiteDataTD"><strong>Cost Price</strong></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['Supplier1']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['Supplier1']." - ".$SupComp1['SupCompany'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material1']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color1']?></td>
				<td width="20%" align="right" class="GraphiteDataTD"><?php echo $alldata['CostPrice1']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['Supplier2']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['Supplier2']." - ".$SupComp2['SupCompany'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material2']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color2']?></td>
				<td width="20%" align="right" class="GraphiteDataTD"><?php echo $alldata['CostPrice2']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['Supplier3']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['Supplier3']." - ".$SupComp3['SupCompany'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material3']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color3']?></td>
				<td width="20%" align="right" class="GraphiteDataTD"><?php echo $alldata['CostPrice3']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['Supplier4']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['Supplier4']." - ".$SupComp4['SupCompany'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material4']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color4']?></td>
				<td width="20%" align="right" class="GraphiteDataTD"><?php echo $alldata['CostPrice4']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD">
					<?php
					if (empty($alldata['Supplier5']))
					{
						echo "";
					}
					else
					{
					 	echo $alldata['Supplier5']." - ".$SupComp5['SupCompany'];
					}
					?>
				</td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material5']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color5']?></td>
				<td width="20%" align="right" class="GraphiteDataTD"><?php echo $alldata['CostPrice5']?></td>
			</tr>	
		  </table>	
	  </td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Inner Quantity&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['InnerQty'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Final Size&nbsp;</td> 
      <td width="125" class="GraphiteDataTableTD">&Oslash;=&nbsp;<?php echo $alldata['Diameter'] ?>&nbsp;</td>
	  <td width="125" class="GraphiteDataTableTD">W=&nbsp;<?php echo $alldata['Width'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTableTD">L=&nbsp;<?php echo $alldata['Length'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTableTD">H=&nbsp;<?php echo $alldata['Height'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Volume&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Volume'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Weight&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Weight'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteNavTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Notes'] ?>&nbsp;</td> 
    </tr>
</table>
<!-- END Grid c_color_c_design_c_textur --></p>
</body>
</html>