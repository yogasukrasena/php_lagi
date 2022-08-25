<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$field_value=$_POST['CategorySearch'];

If ($field_value == ''){
		$query="select * from tblCollect_Category";
	}
	elseif ($field_value !== ''){
		$query="select * from tblCollect_Category where CategoryName LIKE '%$field_value%'";
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
$query = $query . " ORDER BY CategoryID ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<title>COLLECTION - CATEGORY</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(id,code,name) {

  document.AddCategory.CodeHid.value = id;
  document.AddCategory.codenew.value = code;
  document.AddCategory.descnew.value = name;  
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
		<td height="38" width="74%" class="TopContentTitle">COLLECTION - CATEGORY</td>
	</tr>
	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2"><form method="post" action="View_Category.php" name="SearchCategory">
        	<table width="450" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
				<td colspan="3"><font class="InLineFormHeaderFont">Search Category</font></td>
				</tr>
          		<tr>
            		<td width="91" class="InLineFieldCaptionTD">Name</td>
            		<td class="InLineDataTD" ><input class="InLineInput" name="CategorySearch" maxlength="50" size="50" /></td>
            		<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          		</tr>
        	</table>
    	</form>
	  		<br>
      		<font class="InLineFormHeaderFont">List of Category </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="159" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CATEGORY ID</a></td>
    				<td width="282" nowrap class="InLineColumnTD" ><a class="InLineSorterLink" href="#">CATEGORY NAME </a>&nbsp;</td>
  				</tr>
  			<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  						echo"<tr>
    					<td class=\"InLineDataTD\"><a onClick=\"javascript:pick('$alldata[CategoryID]','$alldata[CategoryCode]','$alldata[CategoryName]')\" class=\"InLineDataLink\" href=\"#\">$alldata[CategoryCode]</a></td>
    					<td class=\"InLineDataTD\" colspan=\"5\">$alldata[CategoryName]</td>
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
			<form name="AddCategory" action="AddData.php" method="post" >
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td colspan="8" class="InLineColumnTD">ADD CATEGORY</td> <!-- disini pesan eror kalo code suda ada -->
					<input type="hidden" name="tablename" value="tblCollect_Category">
					<input type="hidden" name="CodeHid" value="" />
					<input type="hidden" name="field0" value="CategoryID">					
					<input type="hidden" name="field1" value="CategoryCode">
					<input type="hidden" name="field2" value="CategoryName">
					<input type="hidden" name="pagename" value="view_Category.php">
  				</tr>
  				<tr>
    				<td class="InLineFieldCaptionTD">Category ID</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" value="" maxlength="12" size="12"></td>
				</tr>
				<tr>
    				<td class="InLineFieldCaptionTD">Category Name</td>
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