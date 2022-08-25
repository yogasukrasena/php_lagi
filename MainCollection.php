<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	
?>
<?php

$DesignCode = $_POST['DesignSelect'];
$NameCode = $_POST['NameSelect'];
$CategoryCode = $_POST['CategorySelect'];
$SizeCode = $_POST['SizeSelect'];
$TextureCode = $_POST['TextureSelect'];
$ColorCode = $_POST['ColorSelect'];
$MaterialCode = $_POST['MaterialSelect'];
$CollectCode = $_POST['CollectCode'];
$OrderBy = $_GET['OB'];
//$SortType
$SortType = $_GET['ST'];

//$OrSort1 = $_GET['OB'].$_GET['ST'];
$query="select * from tblCollect_Master WHERE 1=1 ";

if (!empty($DesignCode))
{
	$query .= " AND DesignCode = '$DesignCode'";
}
if (!empty($NameCode))
{
	$query .= " AND NameCode = '$NameCode'";
}
if (!empty($CategoryCode))
{
	$query .= " AND CategoryCode = '$CategoryCode'";
}
if (!empty($SizeCode))
{
	$query .= " AND SizeCode = '$SizeCode'";
}
if (!empty($TextureCode))
{
	$query .= " AND TextureCode = '$TextureCode'";
}
if (!empty($ColorCode))
{
	$query .= " AND ColorCode = '$ColorCode'";
}
if (!empty($MaterialCode))
{
	$query .= " AND MaterialCode = '$MaterialCode'";
}
if (!empty($CollectCode))
{
	$query .= " AND CollectCode LIKE '%$CollectCode%'";
}

$cari=mysql_query($query);
$jumlah=mysql_num_rows($cari);
if ($jumlah == 0)
{
$Kosong = "No Record";
}
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
if (!empty ($OrderBy))
{
	$query = $query . " ORDER BY $OrderBy ";
	
}
if (!empty($SortType))
{
	$query .= " $SortType ";
}
$query = $query . " LIMIT $from, $maxresult";
//echo $query;
$sqlcari= mysql_query($query);

$QueryDesign = "SELECT * FROM tblCollect_Design";
$Design = mysql_query($QueryDesign);
$QueryTexture = "SELECT * FROM tblCollect_Texture";
$Texture = mysql_query($QueryTexture);
$QueryName = "SELECT * FROM tblCollect_Name";
$Name = mysql_query($QueryName);
$QueryColor = "SELECT * FROM tblCollect_Color";
$Color = mysql_query($QueryColor);
$QueryCategory = "SELECT * FROM tblCollect_Category";
$Category = mysql_query($QueryCategory);
$QueryMaterial = "SELECT * FROM tblCollect_Material";
$Material = mysql_query($QueryMaterial);
$QuerySize = "SELECT * FROM tblCollect_Size";
$Size = mysql_query($QuerySize);
$Code = mysql_query("SELECT * FROM tblCollect_Master");
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Costing</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<script language="JavaScript">
function sortir()
{
	if ((CollectionForm.SortType.value = '') || (CollectionForm.SortType.value = 'Desc'))
	{
		CollectionForm.SortType.value = 'Asc';
	}
	elseif (CollectionForm.SortType.value = 'Asc'
	{
		CollectionForm.SortType.value = 'Desc';
	}
}
function haha()
{
alert('hoiii');
function pick() {
}
   MainCollectionForm.SortType.value = 'huahahahaha';
   <!--document.EditCosting.ClayType.value = type;   -->
}
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td width="50%" height="39" class="TopContentTitle">COLLECTION</td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
  	</tr>
  	<tr>
    	<td >
			<form method="post" action="MainCollection.php" name="CollectionForm">
  			<font class="InLineFormHeaderFont">Search Collection </font> 
  			<table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    		<!-- BEGIN Error 
    		<tr>
      			<td colspan="8" class="InLineErrorDataTD">{Error}</td> 
    		</tr>
 			<!-- END Error -->
    			<tr>
      				<td class="InLineFieldCaptionTD">Design</td> 
      				<td class="InLineDataTD">
        				<select name="DesignSelect" class="InLineSelect">
          				<option value="" selected>Select Value</option>
 						<?php
							for ($i = 0; $i < $DesignRow = mysql_num_rows($Design); $i++)
							{
								$DataDesign = mysql_fetch_array($Design);
								if ($DesignCode != $DataDesign['DesignCode'])
								{
									echo "<option value=\"$DataDesign[DesignCode]\">$DataDesign[DesignName]</option>";
								}
								else
								{
									echo "<option value=\"$DataDesign[DesignCode]\" selected>$DataDesign[DesignName]</option>";
								}
							}
        				?> 
        				</select>
 					</td> 
      				<td class="InLineFieldCaptionTD">Name</td> 
      				<td class="InLineDataTD">
        				<select name="NameSelect" class="InLineSelect">
          				<option value="" selected>Select Value</option>
 						<?php
							for ($i = 0; $i < $NameRow = mysql_num_rows($Name); $i++)
							{
								$DataName = mysql_fetch_array($Name);
								if ($NameCode == $DataName['NameCode'])
								{
									echo "<option value=\"$DataName[NameCode]\" Selected>$DataName[NameDesc]</option>";
								}
								else
								{
									echo "<option value=\"$DataName[NameCode]\">$DataName[NameDesc]</option>";
								}
							}
        				?>  
        				</select>
 					</td> 
      				<td class="InLineFieldCaptionTD">Category</td> 
      				<td class="InLineDataTD">
        				<select name="CategorySelect" class="InLineSelect">
          				<option value="" selected>Select Value</option>
 						<?php
							for ($i = 0; $i < $CategoryRow = mysql_num_rows($Category); $i++)
							{
								$DataCategory = mysql_fetch_array($Category);
								if ($CategoryCode == $DataCategory['CategoryCode'])
								{
									echo "<option value=\"$DataCategory[CategoryCode]\" Selected>$DataCategory[CategoryName]</option>";
								}
								else
								{
									echo "<option value=\"$DataCategory[CategoryCode]\">$DataCategory[CategoryName]</option>";
								}
							}
        				?>  
        				</select>
 					</td> 
      				<td class="InLineFieldCaptionTD">Info/Size</td> 
      				<td class="InLineDataTD">
        				<select name="SizeSelect" class="InLineSelect">
          				<option value="">Select Value</option>
          				<?php
							for ($i = 0; $i < $SizeRow = mysql_num_rows($Size); $i++)
							{
								$DataSize = mysql_fetch_array($Size);
								if ($SizeCode == $DataSize['SizeCode'])
								{
									echo "<option value=\"$DataSize[SizeCode]\" Selected>$DataSize[SizeName]</option>";
								}
								else
								{
									echo "<option value=\"$DataSize[SizeCode]\">$DataSize[SizeName]</option>";
								}
							}
        				?> 
        				</select>&nbsp; 
					</td> 
    			</tr>
    			<tr>
      				<td class="InLineFieldCaptionTD">Texture</td> 
      				<td class="InLineDataTD">
						<select name="TextureSelect" class="InLineSelect">
          				<option value="">Select Value</option>
          				<?php
							for ($i = 0; $i < $TextureRow = mysql_num_rows($Texture); $i++)
							{
								$DataTexture = mysql_fetch_array($Texture);
								if ($TextureCode == $DataTexture['TextureCode'])
								{
									echo "<option value=\"$DataTexture[TextureCode]\" Selected>$DataTexture[TextureName]</option>";
								}
								else
								{
									echo "<option value=\"$DataTexture[TextureCode]\">$DataTexture[TextureName]</option>";
								}
							}
        				?> 
        				</select>
        				&nbsp;
	  				</td> 
      				<td class="InLineFieldCaptionTD">Color</td> 
      				<td class="InLineDataTD">
        				<select name="ColorSelect" class="InLineSelect">
          				<option value="" selected>Select Value</option>
 						<?php
							for ($i = 0; $i < $ColorRow = mysql_num_rows($Color); $i++)
							{
								$DataColor = mysql_fetch_array($Color);
								if ($ColorCode == $DataColor['ColorCode'])
								{
									echo "<option value=\"$DataColor[ColorCode]\" Selected>$DataColor[ColorName]</option>";
								}
								else
								{
									echo "<option value=\"$DataColor[ColorCode]\">$DataColor[ColorName]</option>";
								}
							}
        				?> 
        				</select>
 					</td> 
      				<td class="InLineFieldCaptionTD">Material</td> 
      				<td class="InLineDataTD">
        				<select name="MaterialSelect" class="InLineSelect">
          				<option value="" selected>Select Value</option>
 						<?php
							for ($i = 0; $i < $MaterialRow = mysql_num_rows($Material); $i++)
							{
								$DataMaterial = mysql_fetch_array($Material);
								if ($MaterialCode == $DataMaterial['MaterialCode'])
								{
									echo "<option value=\"$DataMaterial[MaterialCode]\" Selected>$DataMaterial[MaterialName]</option>";
								}
								else
								{
									echo "<option value=\"$DataMaterial[MaterialCode]\">$DataMaterial[MaterialName]</option>";
								}
							}
        				?>  
        				</select>
 						&nbsp; 
					</td> 
      				<td class="InLineFieldCaptionTD">Code</td> 
      				<td class="InLineDataTD"><input name="CollectCode" size="15" value="<?php echo $CollectCode ?>"></td> 
    			</tr> 
    			<tr>
      				<td colspan="8" align="right" nowrap class="InLineFooterTD">
        				<input name="Search" type="submit" value="Search" class="InLineButton">&nbsp; 
					</td> 
    			</tr>
  			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>
      		<!-- END Record c_codificationSearch -->
      		<br>
      		<font class="InLineFormHeaderFont">List of Collection </font><br>
			Total Records : <?php echo"<strong>$jumlah</strong>";?> &nbsp;<br>
			<table width="100%" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
  				<tr>
					<?php
							if ($SortType == "Asc")
							{
								$ST="Desc";
							}
							elseif ($SortType == "Desc" || $SortType == "")
							{
								$ST="Asc";
							}
					?>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=CollectCode&ST=<?php echo $ST?>">COLLECT CODE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=DesignCode&ST=<?php echo $ST?>">DESIGN</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=NameCode&ST=<?php echo $ST?>">NAME</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=CategoryCode&ST=<?php echo $ST?>">CATEGORY</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=SizeCode&ST=<?php echo $ST?>">INFO/SIZE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=TextureCode&ST=<?php echo $ST?>">TEXTURE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=ColorCode&ST=<?php echo $ST?>">COLOR</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=MaterialCode&ST=<?php echo $ST?>">MATERIAL</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="#">PHOTO</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="#">WORKPLAN</a></td>	
  				</tr>
  				<!-- BEGIN New Row -->
				
  				<?php
				if (!empty($Kosong))
				{
					echo "<tr>
							<td class=\"InLineDataTD\" colspan=\"10\">$Kosong</td>
						</tr>";
				}
				while ($alldata = mysql_fetch_array($sqlcari))
				{ //ini nampilin data
				$QueryDesign = "SELECT * FROM tblCollect_Design WHERE tblCollect_Design.DesignCode = '$alldata[DesignCode]' ";
				$Design = mysql_query($QueryDesign);
				$DesignData = mysql_fetch_assoc($Design);
				$QueryTexture = "SELECT * FROM tblCollect_Texture WHERE tblCollect_Texture.TextureCode = '$alldata[TextureCode]' ";
				$Texture = mysql_query($QueryTexture);
				$TextureData = mysql_fetch_array($Texture);
				$QueryName = "SELECT * FROM tblCollect_Name WHERE tblCollect_Name.NameCode = '$alldata[NameCode]' ";
				$Name = mysql_query($QueryName);
				$NameData = mysql_fetch_array($Name);
				$QueryColor = "SELECT * FROM tblCollect_Color WHERE tblCollect_Color.ColorCode = '$alldata[ColorCode]' ";
				$Color = mysql_query($QueryColor);
				$ColorData = mysql_fetch_array($Color);
				$QueryCategory = "SELECT * FROM tblCollect_Category WHERE tblCollect_Category.CategoryCode = '$alldata[CategoryCode]' ";
				$Category = mysql_query($QueryCategory);
				$CategoryData = mysql_fetch_array($Category);
				$QueryMaterial = "SELECT * FROM tblCollect_Material WHERE tblCollect_Material.MaterialCode = '$alldata[MaterialCode]' ";
				$Material = mysql_query($QueryMaterial);
				$MaterialData = mysql_fetch_array($Material);
				$QuerySize = "SELECT * FROM tblCollect_Size WHERE tblCollect_Size.SizeCode = '$alldata[SizeCode]' ";
				$Size = mysql_query($QuerySize);
				$SizeData = mysql_fetch_array($Size);

  				echo"<tr>
					<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"View_AddCollect.php?id=$alldata[ID]&des=$DesignData[DesignCode]&nam=$NameData[NameCode]&cat=$CategoryData[CategoryCode]&siz=$SizeData[SizeCode]&tex=$TextureData[TextureCode]&col=$ColorData[ColorCode]&mat=$MaterialData[MaterialCode]\">$alldata[CollectCode]</a></td>
					<td class=\"InLineDataTD\">$DesignData[DesignName]</td>
					<td class=\"InLineDataTD\">$NameData[NameDesc]</td>
					<td class=\"InLineDataTD\">$CategoryData[CategoryName]</td>
					<td class=\"InLineDataTD\">$SizeData[SizeName]</td>
					<td class=\"InLineDataTD\">$TextureData[TextureName]</td>
					<td class=\"InLineDataTD\">$ColorData[ColorName]</td>
					<td class=\"InLineDataTD\">$MaterialData[MaterialName]</td>
					<td class=\"InLineDataTD\"><img class=\"InLineInput\" height=\"50\" src=\"../UploadImg/$alldata[Photo1]\" width=\"50\"></td>
					<td class=\"InLineDataTD\"><a class=\"InLineDataLink\" href=\"#\">Show</a></td>
  				</tr>";
				}
				echo "<tr>";
  					echo"<td class=\"InLineFooterTD\" colspan=\"10\"><a class=\"InLineNavigatorLink\" href=View_AddCollect.php>Add New</a>&nbsp;&nbsp;";
					/* bangun Previous link */
					if($hal > 1)
					{
    					$prev = ($hal - 1);
	   					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=1> First&nbsp;&nbsp; </a> ";
       					echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$prev> Prev </a> ";
					}
						echo "&nbsp;$hal of $totalhal&nbsp;";

    				/* bangun Next link */
					if($hal < $totalhal)
					{
    					$next = ($hal + 1);
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$next>Next&nbsp;&nbsp;</a>";
   						echo "<a class=\"InLineNavigatorLink\" href=$_SERVER[PHP_SELF]?hal=$totalhal>Last</a>";
					}
 
					echo"  </td>";
 				echo" </tr>";
 				?>
			</table>
		</td>
  	</tr>
</table>
<p>&nbsp;</p>
</body>
</html>