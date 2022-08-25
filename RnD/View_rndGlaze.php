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
$tabel=tblGlaze;
//$field1=$_POST['field1'];
//$field2=$_POST['field2'];
$field1=Glazecode;
$field2=GlazeDescription;
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
$query = $query . " ORDER BY GlazeCode ASC LIMIT $from, $maxresult";
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

</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td height="39" width="74%" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    	<td align="center" width="26%" class="TopContentTitleRight">GLAZE</td>
	</tr>
	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2"><form method="post" action="view_rndGlaze.php" name="SearchGlaze">
        	<table width="792" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
				<td colspan="8"><font class="InLineFormHeaderFont">Search Glaze </font></td>
				</tr>
          		<tr>
            		<td width="43" height="50" class="InLineFieldCaptionTD">Code</td>
            		<td  width="106" height="30" class="InLineDataTD"><input class="InLineInput" value="" name="code" maxlength="12" size="12"></td>
            		<td width="91" class="InLineFieldCaptionTD">Description</td>
            		<td class="InLineDataTD" colspan="4"><input class="InLineInput" name="desc" maxlength="50" size="50"></td>
            		<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          		</tr>
        	</table></form>
	  		<br>
      		<font class="InLineFormHeaderFont">List of Glaze </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="71" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CODE</a></td>
    				<td width="350" nowrap class="InLineColumnTD" colspan="5"><a class="InLineSorterLink" href="#">DESCRIPTION</a>&nbsp;</td>
    				<td width="89" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">PHOTO</a></td>
    				<td width="50" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">NOTES</a></td>
  				</tr>
  			<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  						echo"<tr>
    					<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"view_EditGlaze.php?id=$alldata[ID]\">$alldata[GlazeCode]</a></td>
    					<td class=\"InLineDataTD\" colspan=\"5\">$alldata[GlazeDescription]</td> 
    					<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[GlazePhoto1]\" width=\"50\">&nbsp;</td>
    					<td class=\"InLineDataTD\">
						<a class=\"InLineDataLink\" href=\"ShowGlaze.php?id=$alldata[ID]\" target=\"_blank\">show</a>\t
    					<a class=\"InLineDataLink\" href=\"view_EditGlaze.php?id=$alldata[ID]\" >edit</a></td> 
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
			<p></p>
			<form name="AddGlaze" action="AddData.php" method="post" >
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  			<!-- BEGIN Error -->
  				<tr>
    				<td colspan="8" class="InLineColumnTD">ADD GLAZE</td> <!-- disini pesan eror kalo code suda ada -->
					<input type="hidden" name="tablename" value="tblGlaze">
					<input type="hidden" name="field1" value="GlazeCode">
					<input type="hidden" name="field2" value="GlazeDescription">
					<input type="hidden" name="pagename" value="view_rndGlaze.php">
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
        			<input name="addnew" type="submit" onClick="chkcode()" value="Add" class="InLineButton"> &nbsp; </td>
  				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>