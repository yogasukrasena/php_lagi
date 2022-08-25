<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$field_value=$_POST['TextureSearch'];

If ($field_value == ''){
		$query="select * from tblCollect_Texture";
	}
	elseif ($field_value !== ''){
		$query="select * from tblCollect_Texture where TextureName LIKE '%$field_value%'";
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
$query = $query . " ORDER BY TextureID ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<title>COLLECTION - TEXTURE</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(id,code,name) {

  document.AddTexture.CodeHid.value = id;
  document.AddTexture.codenew.value = code;
  document.AddTexture.descnew.value = name;  
}

function toggleSubmit(clkme)
    {
      var submit = document.getElementById('submit');
      var textarea = document.getElementById('justification');
      submit.value = (chkbox.checked) ? 'Emergency' : 'Non Emergency';
  	  submit.style.display = (submit.value == 'Emergency') ? 'block' : 'none';
      textarea.style.display = (submit.value == 'lpEmergency') ? 'block' : 'none';
    }
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="450" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td height="38" width="74%" class="TopContentTitle">COLLECTION - TEXTURE</td>
	</tr>
	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2"><form method="post" action="View_Texture.php" name="SearchTexture">
        	<table width="450" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
				<td colspan="3"><font class="InLineFormHeaderFont">Search Texture </font></td>
				</tr>
          		<tr>
            		<td width="91" class="InLineFieldCaptionTD">Name</td>
            		<td class="InLineDataTD" ><input class="InLineInput" name="TextureSearch" maxlength="50" size="50"></td>
            		<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          		</tr>
        	</table></form>
	  		<br>
      		<font class="InLineFormHeaderFont">List of Texture </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="159" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">TEXTURE ID</a></td>
    				<td width="282" nowrap class="InLineColumnTD" ><a class="InLineSorterLink" href="#">TEXTURE NAME </a>&nbsp;</td>
  				</tr>
  			<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  						echo"<tr>
    					<td class=\"InLineDataTD\"><a onClick=\"javascript:pick('$alldata[TextureID]','$alldata[TextureCode]','$alldata[TextureName]')\" class=\"InLineDataLink\" href=\"#\">$alldata[TextureCode]</a></td>
    					<td class=\"InLineDataTD\" colspan=\"5\">$alldata[TextureName]</td>
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
			<p></p>
			<form name="AddTexture" action="AddData.php" method="post" >
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td colspan="8" class="InLineColumnTD">ADD TEXTURE</td> <!-- disini pesan eror kalo code suda ada -->
					<input type="hidden" name="tablename" value="tblCollect_Texture">
					<input type="hidden" name="CodeHid" value="" />
					<input type="hidden" name="field0" value="TextureID">					
					<input type="hidden" name="field1" value="TextureCode">
					<input type="hidden" name="field2" value="TextureName">
					<input type="hidden" name="pagename" value="view_Texture.php">
  				</tr>
  				<tr>
    				<td class="InLineFieldCaptionTD">Texture ID</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" value="" maxlength="12" size="12"></td>
				</tr>
				<tr>
    				<td class="InLineFieldCaptionTD">Texture Name</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="descnew" value="" maxlength="50" size="50"></td>
  				</tr>
  				<tr>
    				<td colspan="8" align="right" nowrap class="InLineFooterTD"><!-- BEGIN Button Button_DoSearch -->
        			<input name="addnew" type="submit" onClick="chkcode()" value="Add" class="InLineButton"> &nbsp; </td>
					
					<!--<input name="Delete" type="submit" onClick="chkcode()" value="Add" class="InLineButton"> &nbsp; </td>-->
  				</tr>
			</table>
			</form>
		</td>
	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>