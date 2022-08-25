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
<title>Show Supplier Data</title>
<link rel="stylesheet" type="text/css" href="../Includes/Graphite.css">
</head>
<body link="#000000" vlink="#000000" alink="#0000ff" bgcolor="#ffffff" text="#000000" class="GraphitePageBODY">
<?php
error_reporting(0);
$id=$_GET['id'];
//$sid=10;
//$query=;
$result = mysql_query("SELECT * FROM tblSupplier WHERE ID = $id");
$alldata = mysql_fetch_array($result);
?>
<!-- BEGIN Record c_codification -->
  <table class="GraphiteFormTABLE" cellspacing="1" cellpadding="3">
    <!-- BEGIN Error -->
    <tr>
      <td class="GraphiteColumnTD" colspan="2" align="center">
	  	<table width="100%" border="0" cellspacing="0" cellpadding="3">
        	<tr>
       		  <td height="50" align="center" valign="middle"><h2>SUPPLIER</h2></td>
				<td height="50"><img src="../images/logo GAYA/logo GAYA C n D transp kcl.jpg" width="300" height="50"></td> 
        	</tr>
      	</table>	  </td> 
    </tr>
    <!-- END Error -->
    <tr>
      <td class="GraphiteDataTD" nowrap colspan="2" align="right">&nbsp;</td> 
    </tr>
    <tr>
		<td width="103" nowrap="nowrap" class="GraphiteDataTD">Company</td>
      	<td width="339" class="GraphiteDataTD"><?php echo $alldata['SupCompany'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Contact Person</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupContact'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Address</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupAddress'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">HP</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupHP'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Office</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupOffice'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Fax</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupFax'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">E-mail</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupEmail'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Items</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupItems'] ?>&nbsp;</td> 
    </tr>
	<tr>
		<td class="GraphiteDataTD" nowrap="nowrap">Other Info</td>
      	<td class="GraphiteDataTD"><?php echo $alldata['SupOtherInfo'] ?>&nbsp;</td> 
    </tr>
</table>
</body>
</html>