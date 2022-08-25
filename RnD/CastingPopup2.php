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

$query = "SELECT * FROM tblCasting";
//$FieldBox = $_POST['Casting'];
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
$query = $query . " ORDER BY CastingCode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D - CASTING</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">

</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(symbol) {
  if (window.opener && !window.opener.closed)
    window.opener.document.SampCeramicForm.Casting2.value = symbol;
  window.close();
}
// -->
</SCRIPT>
<table width="765" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td>
		    <font class="InLineFormHeaderFont">List of Casting </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
		</td>
	</tr>
	<tr>
		<td>
			<form name="CastingPopup">
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
    				<td class=\"InLineDataTD\"><input type=\"hidden\" name=\"CastingCode\" value=\"$alldata[CastingCode]\" />
					<a href=\"#\" onClick=\"javascript:pick('$alldata[CastingCode]')\" class=\"InLineDataLink\" >$alldata[CastingCode]	</a></td>
    				<td class=\"InLineDataTD\" colspan=\"5\">$alldata[CastingDescription]</td> 
    				<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[CastingPhoto1]\" 		width=\"50\">&nbsp;</td>
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