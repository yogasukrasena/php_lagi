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

$field1=Supcode;
$field2=SupCompany;
$field3=SupItems;
$field1_value=trim($_POST['code']);
$field2_value=$_POST['desc'];
$field3_value=$_POST['item'];
$query = "SELECT * FROM tblSupplier WHERE 1=1 ";

if (!empty($field1_value))
{
	$query .= " AND SupCode = '$field1_value'";
}
if (!empty($field2_value))
{
	$query .= " AND SupCompany LIKE '%$field2_value%'";
}
if (!empty($field3_value))
{
	$query .= " AND SupItems LIKE '%$field3_value%'";
}


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
<title>C Codification</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<script language="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) == 4))

var dialogWin = new Object()

function openDialog(url, width, height, returnFunc, args) {
	if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
		dialogWin.returnFunc = returnFunc
		dialogWin.returnedValue_s_c_col_id = ""
		dialogWin.args = args
		dialogWin.url = url
		dialogWin.width = width
		dialogWin.height = height
		dialogWin.name = (new Date()).getSeconds().toString()

		if (Nav4) {
			dialogWin.left = window.screenX + 
			   ((window.outerWidth - dialogWin.width) / 2)
			dialogWin.top = window.screenY + 
			   ((window.outerHeight - dialogWin.height) / 2)
			var attr = "screenX=" + dialogWin.left + 
			   ",screenY=" + dialogWin.top + ",resizable=no,width=" + 
			   dialogWin.width + ",height=" + dialogWin.height
		} else {
			dialogWin.left = (screen.width - dialogWin.width) / 2
			dialogWin.top = (screen.height - dialogWin.height) / 2
			var attr = "left=" + dialogWin.left + ",top=" + 
			   dialogWin.top + ",resizable=no,width=" + dialogWin.width + 
			   ",height=" + dialogWin.height
		}
		
		dialogWin.win=window.open(dialogWin.url, dialogWin.name, attr)
		dialogWin.win.focus()
	} else {
		dialogWin.win.focus()
	}
}

</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="830" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="39" width="74%" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    <td align="center" width="26%" class="TopContentTitleRight">SUPPLIER</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form method="post" action="view_rndSupplier.php" name="SearchSupplier">
        <table width="830" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  <tr>
			<td colspan="11"><font class="InLineFormHeaderFont">Search Supplier </font></td>
		  </tr>
          <tr>
            <td width="33" height="50" class="InLineFieldCaptionTD">Code</td>
            <td width="85" class="InLineDataTD"><input class="InLineInput" name="code" maxlength="12" size="12"></td>
            <td width="52" class="InLineFieldCaptionTD">Company</td>
            <td width="20" class="InLineDataTD" colspan="5"><input class="InLineInput" name="desc" maxlength="50" size="50"></td>
            <td width="20" class="InLineFieldCaptionTD">Items</td>
            <td width="138" class="InLineDataTD"><input class="InLineInput" name="item" maxlength="50" size="20"></td>
            <td width="68" class="InLineDataTD"><input name="submit" type="submit" value="Search" class="InLineButton"></td>
          </tr>
        </table>
      </form>
      <!-- END Record c_codificationSearch -->
      <br>
      <font class="InLineFormHeaderFont">List of Supplier </font><br>
Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
<!-- Order by 
<!-- BEGIN Sorter Sorter10 <a href="#">Design, Department, and
Category</a><!-- END Sorter Sorter10 <br>-->
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="80" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CODE</a></td>
    <td width="200" align="center" nowrap class="InLineColumnTD" ><a class="InLineSorterLink" href="#">COMPANY</a>&nbsp;</td>
    <td width="150" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CONTACT<br>PERSON </a></td>
    <td width="100" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">ITEMS</a></td>
    <td width="99" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">HP</a></td>
    <td width="102" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">OFFICE</a></td>
    <td width="99" align="center" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">NOTES</a></td>
  </tr>
  <!-- BEGIN Row -->
  <?php
//  $jmldata=0; 
  while ($alldata = mysql_fetch_array($cari)){
  	echo"<tr>
    <td align=\"center\" class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"view_EditSupplier.php?id=$alldata[ID]\" >$alldata[SupCode]</a></td>
    <td align=\"center\" class=\"InLineDataTD\" >$alldata[SupCompany]</td> 
    <td align=\"center\" class=\"InLineDataTD\">$alldata[SupContact]&nbsp;</td>
	<td align=\"center\" class=\"InLineDataTD\">$alldata[SupItems]</td>
    <td align=\"center\" class=\"InLineDataTD\">$alldata[SupHP]</td> 
    <td align=\"center\" class=\"InLineDataTD\">$alldata[SupOffice]&nbsp;</td>
    <td align=\"center\" class=\"InLineDataTD\">
	<a class=\"InLineDataLink\" href=\"ShowSupplier.php?id=$alldata[ID]\" target=\"_blank\">show</a>\t
	<a class=\"InLineDataLink\" href=\"view_EditSupplier.php?id=$alldata[ID]\" >edit</a></td> 
  </tr>";
  }
  echo "<tr>";
  echo"<td class=\"InLineFooterTD\" colspan=\"7\">";

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
<p>
  <!-- END Grid c_codification -->
</p>
<form action="AddData.php" name="add_Supplier" method="post">
  <table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <!-- BEGIN Error -->
    <tr>
      <td colspan="8" class="InLineColumnTD">ADD SUPPLIER</td>
      <!-- disini pesan eror kalo code suda ada -->
      <input type="hidden" name="tablename" value="tblSupplier">
      <input type="hidden" name="field1" value="SupCode">
      <input type="hidden" name="field2" value="SupCompany">
      <input type="hidden" name="pagename" value="view_rndSupplier.php">
    </tr>
    <!-- END Error -->
    <tr>
      <td class="InLineFieldCaptionTD">Code</td>
      <td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" maxlength="12" size="12"></td>
    </tr>
    <tr>
      <td class="InLineFieldCaptionTD">Company</td>
      <td class="InLineDataTD" colspan="5"><input class="InLineInput" name="descnew" maxlength="50" size="50"></td>
    </tr>
    <tr>
      <td colspan="8" align="right" nowrap class="InLineFooterTD"><!-- BEGIN Button Button_DoSearch -->
          <input name="addnew" type="submit" onClick="chkcode()" value="Add" class="InLineButton">
          <!-- END Button Button_DoSearch -->
        &nbsp; </td>
    </tr>
  </table>
</form>
<p></p></td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>