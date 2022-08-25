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
$result = mysql_query("SELECT * FROM SampleOther WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <tr>
      <td class="GraphiteColumnTD" colspan="6" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>SAMPLE OTHER </h2></td>
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
		  <table width="100%" cellpadding="3" cellspacing="0" border="0">
		  	<tr>
				<td width="30%" class="GraphiteDataTD">Design Material</td>
				<td width="30%" class="GraphiteDataTD"> Supplier</td>
				<td width="10%" class="GraphiteDataTD">Qty</td>
				<td width="10%" class="GraphiteDataTD"> Unit</td>
				<td width="10%" class="GraphiteDataTD">Unit Price</td>
				<td width="10%" class="GraphiteDataTD">Total</td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DesMat1']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DmSup']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat1']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnit']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnitPrice']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat1']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DesMat2']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DmSup']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat2']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnit']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnitPrice']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat2']?> </td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DesMat3']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DmSup']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat3']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnit']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnitPrice']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat3']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DesMat4']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DmSup']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat4']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnit']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnitPrice']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat4']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DesMat5']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['DmSup']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['QtyDesMat5']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnit']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['DmUnitPrice']?></td>
				<td width="10%" class="GraphiteDataTD"><?php echo $alldata['TotalDesMat5']?></td>
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
		  <table width="100%" cellpadding="3" cellspacing="0" border="0">
		  	<tr>
				<td width="30%" class="GraphiteDataTD">Supplier</td>
				<td width="30%" class="GraphiteDataTD">Material</td>
				<td width="20%" class="GraphiteDataTD">Color</td>
				<td width="20%" class="GraphiteDataTD">Cost Price</td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Supplier1']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material1']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color1']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['CostPrice1']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Supplier2']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material2']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color2']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['CostPrice2']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Supplier3']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material3']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color3']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['CostPrice3']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Supplier4']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material4']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color4']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['CostPrice4']?></td>
			</tr>
			<tr>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Supplier5']?></td>
				<td width="30%" class="GraphiteDataTD"><?php echo $alldata['Material5']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['Color5']?></td>
				<td width="20%" class="GraphiteDataTD"><?php echo $alldata['CostPrice5']?></td>
			</tr>	
		  </table>	
	  </td> 
    </tr>
    <tr>
      <td class="GraphiteDataTD" colspan="6" nowrap>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Final Size&nbsp;</td> 
      <td width="125" class="GraphiteDataTD">&Oslash;=&nbsp;<?php echo $alldata['Diameter'] ?>&nbsp;</td>
	  <td width="125" class="GraphiteDataTD">W=&nbsp;<?php echo $alldata['Width'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTD">L=&nbsp;<?php echo $alldata['Length'] ?>&nbsp;</td> 
	  <td width="125" class="GraphiteDataTD">H=&nbsp;<?php echo $alldata['Height'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Volume&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Volume'] ?>&nbsp;</td> 
    </tr>
    <tr>
      <td width="100" colspan="2" class="GraphiteDataTD" nowrap="nowrap">Notes&nbsp;</td> 
      <td colspan="4" class="GraphiteDataTD"><?php echo $alldata['Notes'] ?>&nbsp;</td> 
    </tr>
</table>
<!-- END Grid c_color_c_design_c_textur --></p>
</body>
</html>