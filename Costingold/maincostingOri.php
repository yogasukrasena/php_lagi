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
$tabel=SampleOther;
//$field1=$_POST['field1'];
//$field2=$_POST['field2'];
$field1=samplecode;
$field2=description;
$field1_value=trim($_POST['code']);
$field2_value=$_POST['desc'];

If ((($field1_value == '') || ($field1_value == null))&& (($field2_value == '') || ($field2_value == null))){
		$query="select * from $tabel";
	}
	elseIf ((($field1_value !== '') || ($field1_value !== null))&& (($field2_value == '') || ($field2_value == null))){
		$query="select * from $tabel where $field1 = '$field1_value'";
	}
	elseif ((($field2_value !== '') || ($field2_value !== null))&&(($field1_value == '') || ($field1_value == null))){
		$query="select * from $tabel where $field2 LIKE '%$field2_value%'";
	}
	elseif ((($field1_value !== '') || ($field1_value !== null))&&(($field2_value !== '') || ($field2_value !== null))){
		$query="select * from $tabel where $field1 = '$field1_value' AND $field2 LIKE '%$field2_value%'";
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
$query = $query . " ORDER BY samplecode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Sample Other</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Oren.css">
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


}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
  <tr>
	<td width="74%" height="39" class="TopContentTitle" colspan="2">COSTING</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form method="post" action="View_rndSampOther.php" name="SearchSampOther">
        <p><font class="InLineFormHeaderFont">Search R&amp;D </font> </p>
        <table width="791" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
          <tr>
            <td class="InLineFieldCaptionTD">Code</td>
            <td class="InLineDataTD"><input class="InLineInput" name="code" maxlength="12" size="12"></td>
            <td class="InLineFieldCaptionTD">Description</td>
            <td class="InLineDataTD" colspan="4"><input class="InLineInput" name="desc" maxlength="50" size="50"></td>
            <td class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          </tr>
        </table>
      </form>
      <!-- END Record c_codificationSearch -->
      <br>
      <font class="InLineFormHeaderFont">List of R&amp;D </font><br>
Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="71" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter1 -->
      <a class="InLineSorterLink" href="#">CODE</a></td>
    <td width="85" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter2 -->
        <a class="InLineSorterLink" href="#">DESIGN</a>
      <!-- END Sorter Sorter2 -->
      &nbsp;</td>
    <td width="85" class="InLineColumnTD"><!-- BEGIN Sorter Sorter7 -->
      <a class="InLineSorterLink" href="#">NAME</a></td>
    <td width="92" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter8 -->
      <a class="InLineSorterLink" href="#">CATEGORY </a></td>
    <td width="80" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter9 -->
      <a class="InLineSorterLink" href="#">INFO/SIZE</a></td>
    <td width="80" nowrap class="InLineColumnTD">TEXTURE</td>
    <td width="80" nowrap="nowrap" class="InLineColumnTD">COLOR</td>
    <td width="80" nowrap="nowrap" class="InLineColumnTD">MATERIAL</td>
    <td width="80" nowrap="nowrap" class="InLineColumnTD">PHOTO</td>
    <td width="80" nowrap="nowrap" class="InLineColumnTD">PRICE+<BR />RISK</td>
    <td width="80" nowrap="nowrap" class="InLineColumnTD">REAL<BR />SELLING<BR />PRICE</td>
  </tr>
  <!-- BEGIN Row -->
  <?php
//  $jmldata=0;
		while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  			echo"<tr>
				<td width=\"71\" class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"#\">$alldata[SampleCode]</a></td>
				<td width=\"85\" class=\"InLineDataTD\">$alldata[Description]</td>
    			<td width=\"85\" class=\"InLineDataTD\">&nbsp;</td>
    			<td width=\"85\" class=\"InLineDataTD\">&nbsp;</td>
	   			<td width=\"85\" class=\"InLineDataTD\">&nbsp;</td>
	   			<td width=\"85\" class=\"InLineDataTD\">&nbsp;</td>
    			<td width=\"85\" class=\"InLineDataTD\">&nbsp;</td>
    			<td width=\"92\" class=\"InLineDataTD\">$alldata[CostPrice]&nbsp;</td>
    			<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[Photo1]\" width=\"50\">
				</td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td>
  			</tr>";
		}
		echo "<tr>";
  		echo"<td class=\"InLineFooterTD\" colspan=\"11\">";

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
</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>