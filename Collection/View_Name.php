<?php
session_start();
session_start();
include ("../settings.php");
include ("../language/$cfg_language");
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
$field_value=$_POST['NameSearch'];

If ($field_value == ''){
		$query="select * from tblCollect_Name";
	}
	elseif ($field_value !== ''){
		$query="select * from tblCollect_Name where NameDesc LIKE '%$field_value%'";
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
$query = $query . " ORDER BY NameID ASC LIMIT $from, $maxresult";
$sqlcari= mysql_query($query);

?>
<html>
<head>
<title>COLLECTION - NAME</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<SCRIPT LANGUAGE="JavaScript">
<!--
function pick(id,code,name) {

  document.AddName.CodeHid.value = id;
  document.AddName.codenew.value = code;
  document.AddName.descnew.value = name;  
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
		<td height="38" width="74%" class="TopContentTitle">COLLECTION - NAME</td>
	</tr>
	<tr>
    	<td colspan="2">&nbsp;</td>
  	</tr>
  	<tr>
    	<td colspan="2"><form method="post" action="View_Name.php" name="SearchName">
        	<table width="450" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
				<tr>
				<td colspan="3"><font class="InLineFormHeaderFont">Search Name </font></td>
				</tr>
          		<tr>
            		<td width="91" class="InLineFieldCaptionTD">Name</td>
            		<td class="InLineDataTD" ><input class="InLineInput" name="NameSearch" maxlength="50" size="50"></td>
            		<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          		</tr>
        	</table></form>
	  		<br>
      		<font class="InLineFormHeaderFont">List of Name </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td width="159" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">NAMEID</a></td>
    				<td width="282" nowrap class="InLineColumnTD" ><a class="InLineSorterLink" href="#">NAME</a>&nbsp;</td>
  				</tr>
  			<!-- BEGIN Row -->
  				<?php
  					while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  						echo"<tr>
    					<td class=\"InLineDataTD\"><a onClick=\"javascript:pick('$alldata[NameID]','$alldata[NameCode]','$alldata[NameDesc]')\" class=\"InLineDataLink\" href=\"#\">$alldata[NameCode]</a></td>
    					<td class=\"InLineDataTD\" colspan=\"5\">$alldata[NameDesc]</td>
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
			<form name="AddName" action="AddData.php" method="post" >
			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
    				<td colspan="8" class="InLineColumnTD">ADD NAME</td> <!-- disini pesan eror kalo code suda ada -->
					<input type="hidden" name="tablename" value="tblCollect_Name">
					<input type="hidden" name="CodeHid" value="" />
					<input type="hidden" name="field0" value="NameID">					
					<input type="hidden" name="field1" value="NameCode">
					<input type="hidden" name="field2" value="NameDesc">
					<input type="hidden" name="pagename" value="View_Name.php">
  				</tr>
  				<tr>
    				<td class="InLineFieldCaptionTD">Name ID</td>
    				<td class="InLineDataTD" colspan="5"><input class="InLineInput" name="codenew" value="" maxlength="12" size="12"></td>
				</tr>
				<tr>
    				<td class="InLineFieldCaptionTD">Name</td>
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