<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php

$query = "SELECT * FROM tblSupplier";

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
$query = $query . " ORDER BY SupCode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Search Supplier</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(symbol) {
  if (window.opener && !window.opener.closed)
    window.opener.document.SampPackagingForm.Supplier3.value = symbol;
  window.close();
}
// -->
</SCRIPT>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td>
		    <font class="InLineFormHeaderFont">List of Supplier </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
		</td>
	</tr>
	<tr>
		<td>
			<form name="SupplierPopup">
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
    				<td width="71" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CODE</a></td>
    				<td width="200" nowrap class="InLineColumnTD" colspan="4"><a class="InLineSorterLink" href="#">COMPANY</a></td>
    				<td width="130" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CONTACT</a></td>
    				<td width="130" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">ITEMS</a></td>
  				</tr>
				<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
					$tu = $_GET['ID'];
  				echo"<tr>
    				<td class=\"InLineDataTD\">
					<a href=\"#\" onClick=\"javascript:pick('$alldata[SupCode]')\" class=\"InLineDataLink\" >$alldata[SupCode]	</a></td>
    				<td class=\"InLineDataTD\" colspan=\"4\">$alldata[SupCompany]</td> 
    				<td class=\"InLineDataTD\">$alldata[SupContact]</td>
    				<td class=\"InLineDataTD\">$alldata[SupItems]</td>
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