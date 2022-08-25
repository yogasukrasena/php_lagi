<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$tabel=tblDesMaterial;
//$field1=$_POST['field1'];
//$field2=$_POST['field2'];
$field1=DmCode;
$field2=DmDescription;
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
$query = $query . " ORDER BY DmCode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
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

// Function to run upon closing the dialog with "OK".
function setPrefs_ColorCodi() {
	// We're just displaying the returned value in a text box.
	document.c_codificationSearch.s_c_col_id.value = dialogWin.returnedValue_s_c_col_id
}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
  <tr>
    <td height="39" width="74%" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    <td align="center" width="26%" class="TopContentTitleRight">DESIGN MATERIAL</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form method="post" action="view_rndDesMaterial.php" name="SearchDesMaterial">
        <table width="772" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  <tr>
			<td colspan="11"><font class="InLineFormHeaderFont">Search Design Material </font></td>
		  </tr>
          <tr>
            <td width="33" height="50" class="InLineFieldCaptionTD">Code</td>
            <td width="85" class="InLineDataTD"><input class="InLineInput" value="code" name="kode" maxlength="12" size="12"></td>
            <td width="52" class="InLineFieldCaptionTD">Description</td>
            <td width="20" class="InLineDataTD" colspan="5"><input class="InLineInput" name="{desc}" maxlength="50" size="50"></td>
            <td width="20" class="InLineFieldCaptionTD">Supp</td>
            <td width="138" class="InLineDataTD"><input class="InLineInput" name="{supp}" maxlength="50" size="20"></td>
            <td width="68" class="InLineDataTD"><input name="{Button_Name}" type="submit" value="Search" class="InLineButton"></td>
          </tr>
        </table>
      </form>
      <!-- END Record c_codificationSearch -->
      <br>
      <font class="InLineFormHeaderFont">List of Design Material </font><br>
Total Records : <?php echo "<strong>$jumlah</strong>"; ?> &nbsp;<br>
<!-- Order by 
<!-- BEGIN Sorter Sorter10 <a href="{Sort_URL}">Design, Department, and
Category</a><!-- END Sorter Sorter10 <br>-->
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="71" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter1 -->
      <a class="InLineSorterLink" href="{Sort_URL}">CODE</a></td>
    <td width="350" nowrap class="InLineColumnTD" colspan="5"><!-- BEGIN Sorter Sorter2 -->
        <a class="InLineSorterLink" href="{Sort_URL}">DESCRIPTION</a>
      <!-- END Sorter Sorter2 -->
      &nbsp;</td>
    <td width="89" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter7 -->
      <a class="InLineSorterLink" href="{Sort_URL}">SUPPLIER</a></td>
    <td width="89" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter7 -->
      <a class="InLineSorterLink" href="{Sort_URL}">PHOTO</a></td>
    <td width="50" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter8 -->
      <a class="InLineSorterLink" href="{Sort_URL}">NOTES</a></td>
  </tr>
  <!-- BEGIN Row -->
  <?php
  while ($alldata = mysql_fetch_array($sqlcari)){
  	echo"<tr>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"view_EditDesMaterial.php?id=$alldata[DmID]\">$alldata[DmCode]</a></td>
    <td class=\"InLineDataTD\" colspan=\"5\">$alldata[DmDescription]</td> 
    <td class=\"InLineDataTD\">$alldata[DmSupplier]&nbsp;</td>
    <td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[DmPhoto1]\" width=\"50\">&nbsp;</td>
    <td class=\"InLineDataTD\">
	<a class=\"InLineDataLink\" href=\"ShowDesMaterial.php?id=$alldata[DmID]\" target=\"_blank\">show</a>\t
	<a class=\"InLineDataLink\" href=\"view_EditDesMaterial.php?id=$alldata[DmID]\" >edit</a></td> 
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
<p>
  <!-- END Grid c_codification -->
</p>
<form action="AddData.php" name="add_DesignMat" method="post">
  <table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <!-- BEGIN Error -->
    <tr>
      <td colspan="8" class="InLineColumnTD">ADD DESIGN MATERIAL</td> 
      <input type="hidden" name="tablename" value="tblDesMaterial">
      <input type="hidden" name="field1" value="DmCode">
      <input type="hidden" name="field2" value="DmDescription">
      <input type="hidden" name="pagename" value="view_rndDesMaterial.php">
    </tr>
    <!-- END Error -->
    <tr>
      <td class="InLineFieldCaptionTD">Code</td>
      <td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" maxlength="12" size="12"></td>
    </tr>
    <tr>
      <td class="InLineFieldCaptionTD">Description</td>
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