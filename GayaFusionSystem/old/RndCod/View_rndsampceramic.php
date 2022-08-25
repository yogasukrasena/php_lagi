<?php	
session_start();
include ("../Includes/sql.php");
//include_once("rnd_home.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$tabel=sampleceramic;
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
<title>Sample Ceramic</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<!--<link rel="stylesheet" type="text/javascript" href="../Includes/fungsi.js"> -->

<script language="javascript">

function chkcode()
{
 codenew=new String();
 codenew=document.addsampleceramic.codenew.value
 if ( codenew.length == 0 )
 {
  alert ("Please Enter Code First");
  document.addsampleceramic.codenew.setfocus
 }
 else
 {
  chkdesc()
 }
}
 
function chkdesc()
{
 descnew=new String();
 descnew=document.addsampleceramic.descnew.value
 if (descnew.length == 0)
 {
  alert ("Please Enter The Description");
  document.addsampleceramic.descnew.setfocus
 }
}
</script>

</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<!--<p align="left"><font>&nbsp;</font><img src="../images/header.jpg" width="700" height="150"><br></p> -->
  <table width="765" border="0" cellspacing="0" cellpadding="3">
    <tr>
      <td width="74%" height="39" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
      <td width="26%" height="39" align="center" class="TopContentTitleRight">Sample Ceramic</td>
    </tr>
    <tr>
      <td colspan="2">&nbsp;</td>
    </tr>
    <tr>
      <td colspan="2"><form method="post" action="view_rndsampceramic.php" name="searchsampceramic">
  		<table width="804" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  	<tr>
				<td colspan="8"><font class="InLineFormHeaderFont">Search Sample Ceramic </font></td>
			</tr>
		    <tr>
				<td width="43" height="50" class="InLineFieldCaptionTD">Code</td> 
			    <td width="106" height="30" class="InLineDataTD"><input class="InLineInput" name="code" maxlength="12" size="12"></td>
			  	<td width="91" class="InLineFieldCaptionTD">Description</td>
			 	<td class="InLineDataTD" colspan="4"><input class="InLineInput" name="desc" maxlength="50" size="50"></td>	 
				<td width="106" align="center" class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
		    </tr>
  		</table></form>
		<br>
		<font class="InLineFormHeaderFont">List of Sample Ceramic</font><br>
		Total Records : <?php echo "<strong>$jumlah</strong>" ;?>  &nbsp;<br>
		<!-- Order by -->
		<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  <tr>
    			<td width="71" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">CODE</a></td> 
    			<td width="350" class="InLineColumnTD" colspan="5"><a class="InLineSorterLink" href="#">DESCRIPTION</a>&nbsp;</td> 
    			<td width="89" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">PHOTO</a></td> 
    			<td width="90" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">NOTES</a></td> 
    			<td width="73" nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="#">COPY</a></td> 
    			<td width="89" nowrap class="InLineColumnTD">REF</td> 
  		  </tr>
 
 			<?php
		  		while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  				echo"<tr>
    			<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"view_editsampceramic.php?sid=$alldata[sID]\">$alldata[SampleCode]</a></td>
    			<td class=\"InLineDataTD\" colspan=\"5\">$alldata[Description]</td> 
    			<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[Photo1]\" width=\"50\">&nbsp;</td>
    			<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"ShowSampCeramic.php?sid=$alldata[sID]\" target=\"_blank\">show</a>\t
    			<a class=\"InLineDataLink\" href=\"view_editsampceramic.php?sid=$alldata[sID]\" >edit</a></td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td> 
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
		<form name="addsampleceramic" action="AddData.php" method="post" >
		<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
			<tr>
    			<td colspan="8" class="InLineColumnTD">ADD SAMPLE CERAMIC</td> <!-- disini pesan eror kalo code suda ada -->
				<input type="hidden" name="tablename" value="sampleceramic">
				<input type="hidden" name="field1" value="SampleCode">
				<input type="hidden" name="field2" value="Description">
				<input type="hidden" name="pagename" value="view_rndsampCeramic.php">
  			</tr>
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
        		<input name="addnew" type="submit" onClick="chkcode()" value="Add" class="InLineButton">&nbsp; </td>
  			</tr>
		</table>
		</form>
	  </td>
    </tr>
  </table>

<p>&nbsp;</p>
</body>
</html>