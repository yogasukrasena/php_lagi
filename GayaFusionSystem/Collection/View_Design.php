<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$field_value=$_POST['DesignSearch'];

If ($field_value == ''){
		$query="select * from tblCollect_Design";
	}
	elseif ($field_value !== ''){
		$query="select * from tblCollect_Design where DesignName LIKE '%$field_value%'";
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
$query = $query . " ORDER BY DesignID ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<title>COLLECTION - DESIGN</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(id,code,name) {

  document.AddDesign.CodeHid.value = id;
  document.AddDesign.codenew.value = code;
  document.AddDesign.descnew.value = name;  
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
		<td height="38" width="74%" class="TopContentTitle">COLLECTION - DESIGN</td>
	</tr>
	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2"><form method="post" action="View_Design.php" name="SearchDesign">
        	<table width="450" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
				<td colspan="3"><font class="InLineFormHeaderFont">Search Design </font></td>
				</tr>
          		<tr>
            		<td width="91" class="InLineFieldCaptionTD">Name</td>
            		<td class="InLineDataTD" ><input class="InLineInput" name="DesignSearch" maxlength="50" size="50"></td>
            		<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          		</tr>
        	</table></form>
	  		<br>
      		<font class="InLineFormHeaderFont">List of Design </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="159" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">DESIGN ID</a></td>
    				<td width="282" nowrap class="InLineColumnTD" ><a class="InLineSorterLink" href="#">DESIGN NAME </a>&nbsp;</td>
  				</tr>
  			<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  						echo"<tr>
    					<td class=\"InLineDataTD\"><a onClick=\"javascript:pick('$alldata[DesignID]','$alldata[DesignCode]','$alldata[DesignName]')\" class=\"InLineDataLink\" href=\"#\">$alldata[DesignCode]</a></td>
    					<td class=\"InLineDataTD\" colspan=\"5\">$alldata[DesignName]</td>
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
			<form name="AddDesign" action="AddData.php" method="post" >
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td colspan="8" class="InLineColumnTD">ADD DESIGN</td> <!-- disini pesan eror kalo code suda ada -->
					<input type="hidden" name="tablename" value="tblCollect_Design">
					<input type="hidden" name="CodeHid" value="" />
					<input type="hidden" name="field0" value="DesignID">					
					<input type="hidden" name="field1" value="DesignCode">
					<input type="hidden" name="field2" value="DesignName">
					<input type="hidden" name="pagename" value="view_Design.php">
  				</tr>
  				<tr>
    				<td class="InLineFieldCaptionTD">Design ID</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" value="" maxlength="12" size="12"></td>
				</tr>
				<tr>
    				<td class="InLineFieldCaptionTD">Design Name</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="descnew" value="" maxlength="50" size="50"></td>
  				</tr>
  				<tr>
    				<td colspan="8" align="right" nowrap class="InLineFooterTD"><!-- BEGIN Button Button_DoSearch -->
        			<input name="addnew" type="submit" onClick="chkcode()" value="Add" class="InLineButton"> &nbsp; </td>
					<!--<input name="Edit" type="submit" onClick="chkcode()" value="Edit" style="display:none" class="InLineButton"> &nbsp;-->
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