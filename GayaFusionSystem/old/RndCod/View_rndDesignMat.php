<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$querycari="select * from tblDesMaterial order by DmCode";
$cari=mysql_query($querycari);
//$hasilcari=mysql_fetch_row($cari);
$jumlah=mysql_num_rows($cari);
//$data=mysql_fetch_array($cari);
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

// Function to run upon closing the dialog with "OK".
function setPrefs_ColorCodi() {
	// We're just displaying the returned value in a text box.
	document.c_codificationSearch.s_c_col_id.value = dialogWin.returnedValue_s_c_col_id
}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">

<form method="post" action="{Action}" name="{HTMLFormName}">
  <font class="InLineFormHeaderFont">Search Design Material </font> 
  <table width="772" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <!-- BEGIN Error -->
    <tr>
      <td colspan="11" class="InLineErrorDataTD">{Error}</td> 
    </tr>
 <!-- END Error -->
    <tr>
      <td width="33" class="InLineFieldCaptionTD">Code</td> 
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
<!-- BEGIN Grid c_codification --><font class="InLineFormHeaderFont">List of Design Material
</font><br>
Total Records : <?php echo "<strong>$jumlah</strong>"; ?>  &nbsp;<br>
<!-- Order by 
<!-- BEGIN Sorter Sorter10 <a href="{Sort_URL}">Design, Department, and
Category</a><!-- END Sorter Sorter10 <br>-->
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="71" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter1 --><a class="InLineSorterLink" href="{Sort_URL}">CODE</a></td> 
    <td width="350" nowrap class="InLineColumnTD" colspan="5">
      <!-- BEGIN Sorter Sorter2 --><a class="InLineSorterLink" href="{Sort_URL}">DESCRIPTION</a><!-- END Sorter Sorter2 -->&nbsp;</td> 
    <td width="89" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter7 --><a class="InLineSorterLink" href="{Sort_URL}">SUPPLIER</a></td> 
	<td width="89" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter7 --><a class="InLineSorterLink" href="{Sort_URL}">PHOTO</a></td>
    <td width="50" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter8 --><a class="InLineSorterLink" href="{Sort_URL}">NOTES</a></td> 
  </tr>
 
  <!-- BEGIN Row -->
  <?php
//  $jmldata=0;
  while ($alldata = mysql_fetch_array($cari)){
  	echo"<tr>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"{c_new_code_Src}\">$alldata[DMCode]</a></td>
    <td class=\"InLineDataTD\" colspan=\"5\">$alldata[DMDescription]</td> 
    <td class=\"InLineDataTD\">$alldata[DMSupplier]&nbsp;</td>
    <td class=\"InLineDataTD\">$alldata[DMphoto1]&nbsp;</td>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"../show.php\" target=\"_blank\">show</a>\t<a class=\"InLineDataLink\" href=\"view_addsampceramic.php\" target=\"_blank\">edit</a></td> 
  </tr>";
//  $jmldata++;
  }
  ?>
 <!-- END Row -->
  <!-- BEGIN NoRecords -->
  <tr>
    <td colspan="10" class="InLineDataTD">No records&nbsp;</td> 
  </tr>
 <!-- END NoRecords -->
  <tr>
    <td colspan="10" nowrap class="InLineFooterTD"> 
      <!-- BEGIN Navigator Navigator -->
      <!-- BEGIN First_On --><a class="InLineNavigatorLink" href="{First_URL}">|&lt;</a> <!-- END First_On -->
      <!-- BEGIN Prev_On --><a class="InLineNavigatorLink" href="{Prev_URL}">&lt;&lt;</a> <!-- END Prev_On -->&nbsp;{Page_Number}
      of {Total_Pages}&nbsp; 
      <!-- BEGIN Next_On --><a class="InLineNavigatorLink" href="{Next_URL}">&gt;&gt;</a> <!-- END Next_On -->
      <!-- BEGIN Last_On --><a class="InLineNavigatorLink" href="{Last_URL}">&gt;|</a> <!-- END Last_On --><!-- END Navigator Navigator -->&nbsp; </td> 
  </tr>
</table>
<p>
  <!-- END Grid c_codification -->
</p>
<form action="AddData.php" name="add_DesignMat" method="post">
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <!-- BEGIN Error -->
  <tr>
    <td colspan="8" class="InLineErrorDataTD"><?php echo"&nbsp;" ?></td> <!-- disini pesan eror kalo code suda ada -->
	<input type="hidden" name="tablename" value="tblDesMaterial">
	<input type="hidden" name="field1" value="DmCode">
	<input type="hidden" name="field2" value="DmDescription">
	<input type="hidden" name="pagename" value="rndDesignMat.html">
  </tr>
  <!-- END Error -->
  <tr>
    <td class="InLineFieldCaptionTD">Code</td>
    <td class="InLineDataTD" colspan="5"><input class="InLineInput" value="code" name="codenew" maxlength="12" size="12"></td>
	</tr>
	<tr>
    <td class="InLineFieldCaptionTD">Description</td>
    <td class="InLineDataTD" colspan="5"><input class="InLineInput" name="descnew" maxlength="50" size="50"></td>
  </tr>
  <tr>
    <td colspan="8" align="right" nowrap class="InLineFooterTD"><!-- BEGIN Button Button_DoSearch -->
        <input name="{Button_Name}2" type="submit" value="Add" class="InLineButton">
      <!-- END Button Button_DoSearch -->
      &nbsp; </td>
  </tr>
</table>
</form><p>&nbsp;</p>
</body>
</html>