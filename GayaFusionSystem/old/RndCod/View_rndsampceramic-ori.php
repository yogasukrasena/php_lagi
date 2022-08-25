<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php
$querycari="select * from sampleceramic order by samplecode";
$cari=mysql_query($querycari);
//$hasilcari=mysql_fetch_row($cari);
$jumlah=mysql_num_rows($cari);
//$data=mysql_fetch_array($cari);
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>R&D-Sample Ceramic</title>
<link rel="stylesheet" type="text/css" href="../includes/Style.css">
<!--<link rel="stylesheet" type="text/javascript" href="../Includes/fungsi.js"> -->

<script language="javascript">

function clicksubmit () 
{
	var code = document.add_sample_ceramic.codescnew.value;
	var desc = document.add_sample_ceramic.descscnew.value;
	If ((code == null) (code == ""))
	{
		alert ("Please Fill The Code First");
		document.add_sample_ceramic.codescnew.focus ();
		return false;
	}
	If ((desc == null) (desc == ""))
	{
		alert("Please Fill The Description First");
		document.add_sample_ceramic.descscnew.focus ();
		return false;
	}
	return true;
}
</script>

</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000">

<form method="post" action="searching.php" name="searchsampceramic">
  <font class="InLineFormHeaderFont">Search Sample Ceramic </font> 
  <table width="792" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <!-- BEGIN Error -->
    <tr>
      <td colspan="8" class="InLineErrorDataTD"><?php echo"&nbsp;" ?></td> 
    </tr>
 <!-- END Error -->
    <tr>
      <td class="InLineFieldCaptionTD">Code</td> 
      <td class="InLineDataTD"><input type="hidden" name="sampleceramic" value="sampleceramic"><input class="InLineInput" value="code" name="kode" maxlength="12" size="12"></td>
	 <td class="InLineFieldCaptionTD">Description</td>
	 <td class="InLineDataTD" colspan="4"><input class="InLineInput" name="{desc}" maxlength="50" size="50"></td>	 
	<td class="InLineDataTD"><input name="{Button_Name}" type="submit" value="Search" class="InLineButton"></td>
    </tr>
  </table>
</form>
<!-- END Record c_codificationSearch -->
<!-- BEGIN Grid c_codification --><font class="InLineFormHeaderFont">List of Sample Ceramic
</font><br>
Total Records : <?php echo "<strong>$jumlah</strong>" ;?>  &nbsp;<br>
<!-- Order by -->
<!-- BEGIN Sorter Sorter10 <a href="{Sort_URL}">Design, Department, and
Category</a><!-- END Sorter Sorter10 <br>-->
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <tr>
    <td width="71" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter1 --><a class="InLineSorterLink" href="{Sort_URL}">CODE</a></td> 
    <td width="350" class="InLineColumnTD" colspan="5">
      <!-- BEGIN Sorter Sorter2 --><a class="InLineSorterLink" href="{Sort_URL}">DESCRIPTION</a><!-- END Sorter Sorter2 -->&nbsp;</td> 
    <td width="89" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter7 --><a class="InLineSorterLink" href="{Sort_URL}">PHOTO</a></td> 
    <td width="90" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter8 --><a class="InLineSorterLink" href="{Sort_URL}">NOTES</a></td> 
    <td width="73" nowrap class="InLineColumnTD">
      <!-- BEGIN Sorter Sorter9 --><a class="InLineSorterLink" href="{Sort_URL}">COPY</a></td> 
    <td width="89" nowrap class="InLineColumnTD">REF</td> 
  </tr>
 
  <!-- BEGIN Row To Show Data-->
  <?php
//  $jmldata=0;
  while ($alldata = mysql_fetch_array($cari)){
  	echo"<tr>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"{c_new_code_Src}\">$alldata[SampleCode]</a></td>
    <td class=\"InLineDataTD\" colspan=\"5\">$alldata[Description]</td> 
    <td class=\"InLineDataTD\">$alldata[photo1]&nbsp;</td>
    <td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"../show.php\" target=\"_blank\">show</a>\t<a class=\"InLineDataLink\" href=\"view_addsampceramic.php\" target=\"_blank\">edit</a></td>
    <td class=\"InLineDataTD\">phpcode&nbsp;</td>
    <td class=\"InLineDataTD\">phpcode&nbsp;</td> 
  </tr>";
//  $jmldata++;
  }
  ?>
 <!-- END Row -->
  <!-- BEGIN NoRecords -->
  <!-- deleted -->
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
<form action="AddData.php" name="add_sample_ceramic" method="post" onSubmit="return clicksubmit ()">
<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  <!-- BEGIN Error -->
  <tr>
    <td colspan="8" class="InLineErrorDataTD"><?php echo"&nbsp;" ?></td> <!-- disini pesan eror kalo code suda ada -->
	<input type="hidden" name="tablename" value="sampleceramic">
	<input type="hidden" name="field1" value="SampleCode">
	<input type="hidden" name="field2" value="Description">
	<input type="hidden" name="pagename" value="rndsampCeramic.html">
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
        <input name="addnew" type="submit" value="Add" class="InLineButton">
      <!-- END Button Button_DoSearch -->
      &nbsp; </td>
  </tr>
</table>
</form>
<p>&nbsp;</p>
</body>
</html>