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
<?php
//$DmID = $_GET['DmID'];
//If (!isset($_GET['DmID'])){
$query = "SELECT * FROM tblDesMaterial";
//}
//else
//{
//$query = "SELECT tblDesMaterial.*, tblSupplier.SupCompany, tblUnit.UnitValue FROM tblDesMaterial INNER JOIN tblSupplier ON tblDesMaterial.DmSupplier = tblSupplier.SupCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID where tblDesMaterial.DmID = '$DmID'";
//}
$cari=mysql_query($query);
$jumlah=mysql_num_rows($cari);
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
$query = $query . " ORDER BY DmCode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);
$DesID = $_GET['DmID'];

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D - DESIGN MATERIAL</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(symbol,supplier,unitvalue,unitprice) {
  if (window.opener && !window.opener.closed)
    window.opener.document.SampPackagingForm.DesMat3.value = symbol;
    <!--window.opener.document.SampPackagingForm.DesMat3Desc.value = desc;-->
    window.opener.document.SampPackagingForm.DesMatSup3.value = supplier;
    window.opener.document.SampPackagingForm.DesMatUnit3.value = unitvalue;
    window.opener.document.SampPackagingForm.DesMatUnitPrice3.value = unitprice;			
  window.close();
}
// -->
</SCRIPT>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td>
		    <font class="InLineFormHeaderFont">List of Design Material</font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
	  </td>
	</tr>
	<tr>
		<td>
			<form name="OtherMatPopup">
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
    				<td width="71" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CODE</a></td>
    				<td width="250" nowrap class="InLineColumnTD" colspan="5"><a class="InLineSorterLink" href="#">DESCRIPTION</														a>&nbsp;</td>
    				<td width="89" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">PHOTO</a></td>
  				</tr>
				<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  				echo"<tr>
    				<td class=\"InLineDataTD\">";
					//If ($DmID == null){
					//echo "<a href=$_SERVER[PHP_SELF]?DmID=$alldata[DmID]> $alldata[DmCode]</a> ";
					//}
					//else{
					echo "
					<a href=\"#\" onClick=\"javascript:pick('$alldata[DmCode]','$alldata[DmSupplier]','$alldata[DmUnit]','$alldata[DmUnitPrice]')\" class=\"InLineDataLink\" >$alldata[DmCode]	</a>";
					//}
					echo "</td>
    				<td class=\"InLineDataTD\" colspan=\"5\">$alldata[DmDescription]</td> 
    				<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[DmPhoto1]\" 		width=\"50\">&nbsp;</td>
  				</tr>";
				}
				echo "<tr>";
  					echo"<td class=\"InLineFooterTD\" colspan=\"10\">";

					/* bangun Previous link */
					if($hal > 1){
    					$prev = ($hal - 1);
	   					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=1> First&nbsp;&nbsp; </a> ";
       					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$prev> Prev </a> ";
					}

					echo "&nbsp;$hal of $totalhal&nbsp;";

    				/* bangun Next link */
					if($hal < $totalhal){
    					$next = ($hal + 1);
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$next>Next&nbsp;&nbsp;</a>";
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$totalhal>Last</a>";
					}
 
						echo"  </td>";
	
 				echo" </tr>";
  				?>
  			</table>
			</form>
		</td>
  </tr>
</table>
</body>
</html>