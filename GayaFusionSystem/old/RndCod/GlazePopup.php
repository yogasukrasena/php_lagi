<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php

$query = "SELECT * FROM tblGlaze";
$FieldBox = $_POST['Glaze'];
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
$query = $query . " ORDER BY GlazeCode ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&amp;D - CLAY</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<script language="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) == 4))

var dialogWin = new Object()

function openDialog(url, width, height, returnFunc, args) {
	if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
		dialogWin.returnFunc = returnFunc
		dialogWin.returnedValue_GlazeCode = ""
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
	document.c_codificationSearch.Glaze.value = dialogWin.returnedValue_Glaze
}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td>
		    <font class="InLineFormHeaderFont">List of Glaze </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
		</td>
	</tr>
	<tr>
		<td>
			<form name="GlazePopup">
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
    				<td width="71" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="{Sort_URL}">CODE</a></td>
    				<td width="250" nowrap class="InLineColumnTD" colspan="5"><a class="InLineSorterLink" href="{Sort_URL}">DESCRIPTION</														a>&nbsp;</td>
    				<td width="89" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="{Sort_URL}">PHOTO</a></td>
  				</tr>
				<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  				echo"<tr>
    				<td class=\"InLineDataTD\"><input type=\"hidden\" name=\"GlazeCode\" value=\"$alldata[GlazeCode]\" />
					<a href=\"#\" onClick=\"javascript:window.opener.document.SampCeramicForm.Glaze.value=document.GlazePopup.GlazeCode.value;window.close()\" class=\"InLineDataLink\" >$alldata[GlazeCode]	</a></td>
    				<td class=\"InLineDataTD\" colspan=\"5\">$alldata[GlazeDescription]</td> 
    				<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[GlazePhoto1]\" 		width=\"50\">&nbsp;</td>
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