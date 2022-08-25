<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'Costing',$lang);


if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
?>
<?php
$query= "SELECT * FROM tblCosting_Clay";
$sqlcari= mysql_query($query);
$alldata= mysql_fetch_array($sqlcari);
//$add = $_POST['CodeHid'];
//$CodeHid = ;
//$ClayType = $_POST['ClayType'];
//$PricePerKG = $_POST['PricePerKG'];
$query= "SELECT * FROM tblCosting_Clay";
$sqlcari= mysql_query($query);
$alldata= mysql_fetch_array($sqlcari);	

//$cari=mysql_query($query);
$jumlah=mysql_num_rows($sqlcari);
global $hal;
$hal = $_GET['hal'];
  /* jika page default nya 1 */
if(!isset($_GET['hal'])){
    $hal = 1;
} else {
    $hal = $_GET['hal'];
}
 
 $maxresult = 10;
  $totalhal = ceil($jumlah/$maxresult);
  $from = (($hal * $maxresult) - $maxresult); 
$query = $query . " ORDER BY Id ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D-TYPE OF CLAY</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-oren.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(id,type,price) {

  document.ClayForm.CodeHid.value = id;
  document.ClayForm.ClayType.value = type;
  document.ClayForm.PricePerKG.value = price; 
 -->
}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="300" border="0" cellspacing="0" cellpadding="3">
	<tr>
    	<td height="39" width="74%" class="TopContentTitle">CLAY</td>
  	</tr>
  	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2">
      		<font class="InLineFormHeaderFont">List of Clay </font><br>Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" width="300" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="149" class="InLineColumnTD"><a class="InLineSorterLink" href="#">CLAY TYPE </a></td>
    				<td width="137" class="InLineColumnTD" colspan="3"><a class="InLineSorterLink" href="#">PRICE/KG</a>&nbsp;</td>
  				</tr>
  				<!-- BEGIN Row -->
  				<?php
  				while ($alldata = mysql_fetch_array($sqlcari))
  				{
  				echo"<tr>
    				<td class=\"InLineDataTD\"><a onClick=\"javascript:pick('$alldata[ID]','$alldata[ClayType]','$alldata[PricePerKG]')\"  class=\"InLineDataLink\" href=\"#\">$alldata[ClayType]</a></td>
    				<td width=\"137\" class=\"InLineDataTD\">$alldata[PricePerKG]</td> 
  				</tr>";
  				}
  				echo "<tr>";
  					echo"<td class=\"InLineFooterTD\" colspan=\"3\">";

						/* bangun Previous link */
						if($hal > 1)
						{
    					$prev = ($hal - 1);
	   					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=1> First&nbsp;&nbsp; </a> ";
       					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$prev> Prev </a> ";
						}

						echo "&nbsp;$hal of $totalhal&nbsp;";

    					/* bangun Next link */
						if($hal < $totalhal)
						{
    					$next = ($hal + 1);
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$next>Next&nbsp;&nbsp;</a>";
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$totalhal>Last</a>";
						}
 
					echo"  </td>";
 				echo" </tr>";
  				?>
			</table>
		</td>
	</tr>
	<tr>
		<td colspan="2">
			<form name="ClayForm" method="post" action="AddClay.php">
			<table border="0" cellpadding="3" cellspacing="0" width="300">
				<tr>
					<td colspan="2"><font class="InLineFormHeaderFont">Add/Edit Clay</font></td>
				</tr>
				<tr>
					<td class="InLineTitleTD" colspan="2">
						<?php
							If ($edit)
							{
							echo "Data  Successfully Edited";
							}
							else 
							{
							echo "&nbsp";
							}
						?>
					</td>
				</tr>
				<tr>
					<td class="InLineDataTD">Clay Type </td>
					<td class="InLineDataTD"><input type="hidden" name="CodeHid" value="" /><input type="text" name="ClayType" value="" /></td>
				</tr>
				<tr>
					<td class="InLineDataTD">Price/KG</td>
					<td class="InLineDataTD"><input type="text" name="PricePerKG" value="" /></td>
				</tr>
				<tr>
					<td class="InLineFooterTD" colspan="2"><input class="InLineButton" type="submit" name="Submit" value="SUBMIT" /></td>
				</tr>
			</table>
			</form><p></p>
		</td>
  	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>