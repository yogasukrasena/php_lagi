<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>

<?php
$query= "SELECT * FROM tblCosting_Movement";
$sqlcari= mysql_query($query);
$alldata= mysql_fetch_array($sqlcari);
$add = $alldata['ID'];
//$CostPerMinute = 400;
//$PiecesPerHour = 4;
$CostPerMinute = $_POST['CostPerMinute'];

If (!empty($add)){
	If ((!empty($CostPerMinute))){
		$dataedit = "UPDATE tblCosting_Movement SET 
			tblCosting_Movement.CostPerMinute = '$CostPerMinute'";
		$edit = mysql_query($dataedit);	
	}
}
else{
	$AddData = "INSERT INTO tblCosting_Movement (CostPerMinute) VALUE ('$CostPerMinute')";
	$insert = mysql_query($AddData);
}
$query= "SELECT * FROM tblCosting_Movement";
$sqlcari= mysql_query($query);
$alldata= mysql_fetch_array($sqlcari);	
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D-UNIT</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-oren.css">
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="300" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="39" width="74%" class="TopContentTitle">MOVEMENT</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">
		<form name="ClayPreparationForm" method="post" action="View_Movement.php">
		<table border="0" cellpadding="3" cellspacing="0" width="300">
			<tr>
				<td colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="InLineTitleTD" colspan="2">
					<?php
						If ($edit){
							echo "Data  Successfully Edited";
						}
						else {
							echo "&nbsp";
						}
					?>
				</td>
			</tr>
			<tr>
				<td class="InLineDataTD">Cost / Minute</td>
				<td class="InLineDataTD"><input type="text" name="CostPerMinute" value="<?php echo $alldata['CostPerMinute']?>" /></td>
			</tr>
			<tr>
				<td class="InLineFooterTD" colspan="2"><input class="InLineButton" type="submit" name="Submit" value="SUBMIT" /></td>
			</tr>
		</table>
		</form>
	</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>