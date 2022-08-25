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
$tabel=tblUnit;
$field1=UnitValue;
$field1_value=$_POST['UnitValue'];

If ((($field1_value == '') || ($field1_value == null))){
		$query="select * from $tabel";
	}
	elseIf ((($field1_value !== '') || ($field1_value !== null))){
		$query="select * from $tabel where $field1 LIKE '%$field1_value%'";
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
$query = $query . " ORDER BY UnitId ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>

<?php
	error_reporting(0);
	$id=$_GET['id'];
	$result = mysql_query("SELECT * FROM tblUnit WHERE UnitID = '$id'");
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D-UNIT</title>
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
<table width="765" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="39" width="74%" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    <td align="center" width="26%" class="TopContentTitleRight">UNIT</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form method="post" action="view_rndUnit.php" name="searchUnit">
        <table width="300" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  <tr>
			<td colspan="3"><font class="InLineFormHeaderFont">Search Unit </font></td>
		  </tr>
          <tr>
            <td width="68" height="50" class="InLineFieldCaptionTD">Name </td>
            <td width="117" class="InLineDataTD"><input class="InLineInput" type="text" name="UnitValue" maxlength="50" size="25"></td>
            <td width="95" align="center" class="InLineDataTD"><input name="search" type="submit" value="Search" class="InLineButton"></td>
          </tr>
        </table>
      </form>

	  <br>
      <font class="InLineFormHeaderFont">List of Unit </font><br>
Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
<!-- Order by 
<!-- BEGIN Sorter Sorter10 <a href="#">Design, Department, and
Category</a><!-- END Sorter Sorter10 <br>-->
<table cellpadding="3" width="300" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="10" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter1 -->
      <a class="InLineSorterLink" href="#">UNIT ID</a></td>
    <td width="20" nowrap class="InLineColumnTD" colspan="3"><!-- BEGIN Sorter Sorter2 -->
        <a class="InLineSorterLink" href="#">UNIT NAME </a>
      <!-- END Sorter Sorter2 -->
      &nbsp;</td>
  </tr>
  <!-- BEGIN Row -->
  <?php
//  $jmldata=0;
  while ($alldata = mysql_fetch_array($sqlcari)){
  	echo"<tr>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"view_rndUnit.php?id=$alldata[UnitID]\">$alldata[UnitID]</a></td>
    <td class=\"InLineDataTD\">$alldata[UnitValue]</td> 
  </tr>";
  }
  echo "<tr>";
  echo"<td class=\"InLineFooterTD\" colspan=\"3\">";

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

<form name="AddUnit" action="AddUnit.php" method="post" >
<font class="InLineFormHeaderFont">Add/Edit Unit </font>
<table width="300" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="78" class="InLineFieldCaptionTD">
		Unit ID
		<input type="hidden" name="tablename" value="tblUnit" />
		<input type="hidden" name="field1" value="UnitID" />
		<input type="hidden" name="field2" value="UnitValue" />
		<input type="hidden" name="pagename" value="view_rndUnit.php" />
	</td>
    <td width="208" colspan="5" class="InLineDataTD">
	<?php
		$alldetail = mysql_fetch_array($result);
		echo "<input type=\"hidden\" name=\"codehid\" value=\"$alldetail[UnitID]\" />";
		echo "<input class=\"InLineInput\" name=\"codenew\" maxlength=\"12\" size=\"12\" value=\"$alldetail[UnitID]\" />";
	?>	
	</td>
  </tr>
  <tr>
    <td class="InLineFieldCaptionTD">Unit Name</td>
    <td class="InLineDataTD" colspan="5">
    <!--<input class="InLineInput" name="descnew" maxlength="50" size="30">-->
    <?php
		//$alldetail = mysql_fetch_array($result);
		echo "<input class=\"InLineInput\" name=\"descnew\" maxlength=\"50\" size=\"30\" value=\"$alldetail[UnitValue]\" />";
	?>
    </td>
  </tr>
  <tr>
    <td colspan="2" align="right" nowrap class="InLineFooterTD"><!-- BEGIN Button Button_DoSearch -->
        <input name="Add" type="submit" value="Add" class="InLineButton">
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