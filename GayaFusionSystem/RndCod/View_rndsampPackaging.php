<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}
function money_form($money)
{
	return str_replace(",", "." , number_format($money));
	return str_replace(".", "," , number_format($money));
}	
?>
<?php
$tabel=SamplePackaging;
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
<title>Sample Packaging</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="765" border="0" cellspacing="0" cellpadding="3">
  <tr>
	<td width="74%" height="39" class="TopContentTitle">RESEARCH &amp; DEVELOPMENT</td>
    <td width="26%" height="39" align="center" class="TopContentTitleRight">Sample Packaging</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2"><form method="post" action="View_rndSampPackaging.php" name="SearchSampPackaging">
        <table width="791" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
		  <tr>
			<td colspan="8"><font class="InLineFormHeaderFont">Search Sample Packaging </font></td>
		  </tr>
          <tr>
            <td height="50" class="InLineFieldCaptionTD">Code</td>
            <td class="InLineDataTD"><input class="InLineInput" name="code" maxlength="12" size="12"></td>
            <td class="InLineFieldCaptionTD">Description</td>
            <td class="InLineDataTD" colspan="4"><input class="InLineInput" name="desc" maxlength="50" size="50"></td>
            <td class="InLineDataTD"><input name="Search" type="submit" value="Search" class="InLineButton"></td>
          </tr>
        </table>
      </form>
      <!-- END Record c_codificationSearch -->
      <br>
      <font class="InLineFormHeaderFont">List of Sample Packaging </font><br>
Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
<!--Order by -->
<!-- BEGIN Sorter Sorter10 <a href="#">Design, Department, and
Category</a><!-- END Sorter Sorter10<br> -->
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="71" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter1 -->
      <a class="InLineSorterLink" href="#">CODE</a></td>
    <td width="200" nowrap class="InLineColumnTD" colspan="5"><!-- BEGIN Sorter Sorter2 -->
        <a class="InLineSorterLink" href="#">DESCRIPTION</a>
      <!-- END Sorter Sorter2 -->
      &nbsp;</td>
    <td width="160" class="InLineColumnTD"><table border="0" cellpadding="1" cellspacing="0" width="160">
      <tr>
        <td align="center" colspan="4" ><a class="InLineSorterLink" href="#">FINAL SIZE</a></td>
      </tr>
      <tr>
        <td align="center" width="40" class="InLineColumnTD"><a class="InLineSorterLink" href="#">&Oslash;</a></td>
        <td align="center" width="40" class="InLineColumnTD"><a class="InLineSorterLink" href="#">W</a></td>
        <td align="center" width="40" class="InLineColumnTD"><a class="InLineSorterLink" href="#">L</a></td>
        <td align="center" width="40" class="InLineColumnTD"><a class="InLineSorterLink" href="#">H</a></td>
      </tr>
    </table></td>
    <td width="89" class="InLineColumnTD"><!-- BEGIN Sorter Sorter7 -->
      <a class="InLineSorterLink" href="#">PHOTO</a></td>
    <td width="90" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter8 -->
      <a class="InLineSorterLink" href="#">COST PRICE </a></td>
    <td width="50" nowrap class="InLineColumnTD"><!-- BEGIN Sorter Sorter9 -->
      <a class="InLineSorterLink" href="#">NOTES</a></td>
    <td width="50" nowrap class="InLineColumnTD">COPY</td>
    <td width="50" nowrap="nowrap" class="InLineColumnTD">REF</td>
  </tr>
  <!-- BEGIN Row -->
  <?php
//  $jmldata=0;
		while ($alldata = mysql_fetch_array($sqlcari)){ //ini nampilin data
  			echo"<tr>
				<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"{c_new_code_Src}\">$alldata[SampleCode]</a></td>
				<td class=\"InLineDataTD\" colspan=\"5\">$alldata[Description]</td>
				<td class=\"InLineDataTD\" width=\"100\">
					<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" width=\"160\">
						<tr>
							<td align=\"center\" width=\"40\" class=\"InLineDataTD\">$alldata[Diameter]</td>
							<td align=\"center\" width=\"40\" class=\"InLineDataTD\">$alldata[Width]</td>
							<td align=\"center\" width=\"40\" class=\"InLineDataTD\">$alldata[Length]</td>
							<td align=\"center\" width=\"40\" class=\"InLineDataTD\">$alldata[Height]</td>
						</tr>
					</table>
				</td>
    			<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[Photo1]\" width=\"50\">&nbsp;</td>
    			<td class=\"InLineDataTD\" align=\"right\">". money_form($alldata['TotalCost'])."</td>
    			<td class=\"InLineDataTD\">
					<a onmouseover=\"status='Search Record...';return true\" onmouseout=\"status='';return true\" class=\"InLineDataLink\" href=\"ShowSampPackaging.php?id=$alldata[ID]&DesMat1=$alldata[DesMat1]&DesMat2=$alldata[DesMat2]&DesMat3=$alldata[DesMat3]&DesMat4=$alldata[DesMat4]&DesMat5=$alldata[DesMat5]&Supplier1=$alldata[Supplier1]&Supplier2=$alldata[Supplier2]&Supplier3=$alldata[Supplier3]&Supplier4=$alldata[Supplier4]&Supplier5=$alldata[Supplier5]\" target=\"_blank\">show</a>\t
					<a onmouseover=\"status='Search Record...';return true\" onmouseout=\"status='';return true\" class=\"InLineDataLink\" href=\"view_editsampPackaging.php?id=$alldata[ID]&DesMat1=$alldata[DesMat1]&DesMat2=$alldata[DesMat2]&DesMat3=$alldata[DesMat3]&DesMat4=$alldata[DesMat4]&DesMat5=$alldata[DesMat5]\" >edit</a>
				</td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td>
    			<td class=\"InLineDataTD\">phpcode&nbsp;</td>
  			</tr>";
		}
		echo "<tr>";
  		echo"<td class=\"InLineFooterTD\" colspan=\"12\">";

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
<form action="AddData.php" name="add_Sample_Packaging" method="post">
  <table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <!-- BEGIN Error -->
    <tr>
      <input type="hidden" name="tablename" value="SamplePackaging">
      <input type="hidden" name="field1" value="SampleCode">
      <input type="hidden" name="field2" value="Description">
      <input type="hidden" name="pagename" value="View_rndSampPackaging.php">
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
          <input name="{Button_Name}2" type="submit" value="Add" class="InLineButton">
          <!-- END Button Button_DoSearch -->
        &nbsp; </td>
    </tr>
  </table>
</form>
</td>
  </tr>
</table>
<p>&nbsp;</p>
</body>
</html>