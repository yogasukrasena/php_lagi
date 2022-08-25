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

$DesignCode = $_POST['DesignSelect'];
$Description = $_POST['Description'];
$OrderBy = $_GET['OB'];
//$SortType
$SortType = $_GET['ST'];
$CodeNew = $_POST['CodeNew'];
$DescNew = $_POST['DescNew'];



//$OrSort1 = $_GET['OB'].$_GET['ST'];
$query="select * from tblCollect_Group_H WHERE 1=1 ";

if (!empty($DesignCode))
{
	$query .= " AND DesignCode = '$DesignCode'";
}
if (!empty($Description))
{
	$query .= " AND Description LIKE '%$Description%'";
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
$Code = mysql_query("SELECT * FROM tblCollect_Master");
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<SCRIPT LANGUAGE="JavaScript" src="../RndCod/calendar.js"></SCRIPT>
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
</script>
</head>
<body link="#000000" alink="#0000ff" vlink="#000000" text="#000000" class="">
<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
		<td width="50%" height="39" class="TopContentTitle">COLLECTION IN GROUP </td>
  	</tr>
  	<tr>
    	<td>&nbsp;</td>
  	</tr>
  	<tr>
    	<td >
			<form method="post" action="CollectionGroup.php" name="CollectionGroupForm">
  			<font class="InLineFormHeaderFont">Edit Collection in Group </font>
  			<table width="100%" cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    		<!-- BEGIN Error 
    		<tr>
      			<td colspan="8" class="InLineErrorDataTD">{Error}</td> 
    		</tr>
 			<!-- END Error -->
    			<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Code</td> 
      				<td width="86%" class="InLineDataTD"><input type="text" name="GroupCode" size="15" value="<?php echo $CodeGroup ?>" >&nbsp;</td> 
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Date</td> 
      				<td width="86%" class="InLineDataTD"><input type="text" name="DateField" value="<?php echo $alldata['GroupDate']; ?>" size="10" />&nbsp;<a href="javascript:void(0)" onClick="showCalendar(CollectionGroupForm.DateField,'yyyy-mm-dd','Choose date')"><img src="../images/DatePicker1.gif" width="17" height="15" border="0"/></a></td> 
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Design</td> 
      				<td width="86%" class="InLineDataTD">
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
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Description</td> 
      				<td width="86%" class="InLineDataTD"><input size="50" type="text" name="GroupDescription" value="<?php echo $alldata['GroupDescription']?>" ></td> 
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Client Code </td> 
      				<td width="86%" class="InLineDataTD"><input size="35" type="text" name="ClientCode" value="<?php echo $alldata['ClientCode']?>" ></td> 
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Client Description </td> 
      				<td width="86%" class="InLineDataTD"><input size="50" type="text" name="ClientDescription" value="<?php echo $alldata['ClientDescription']?>" ></td> 
				</tr>
				<tr>
      				<td width="14%" class="InLineFieldCaptionTD">Photo</td> 
      				<td width="86%" class="InLineDataTD">
						<?php 
							if (empty($alldata['GroupPhoto'])){
								echo "<input type=\"file\" name=\"GroupPhoto\" value=\"\" />";
							}
							else{
								echo substr($alldata['GroupPhoto'],15).".";
								echo "&nbsp; Delete <input type=\"checkbox\" name=\"DelGroupPhoto\" value=\"$alldata[GroupPhoto]\" /> ";
							}
						?>
						&nbsp;
					</td> 
				</tr>
  			</table>
			</form>
		</td>
	</tr>
	<tr>
		<td>
			<p></p>
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
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=CollectCode&ST=<?php echo $ST?>">CODE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=DesignCode&ST=<?php echo $ST?>">DESIGN</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=NameCode&ST=<?php echo $ST?>">NAME</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=CategoryCode&ST=<?php echo $ST?>">CATEGORY</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=SizeCode&ST=<?php echo $ST?>">INFO/SIZE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=TextureCode&ST=<?php echo $ST?>">TEXTURE</a></td>
    				<td nowrap class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=ColorCode&ST=<?php echo $ST?>">COLOR</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="MainCollection.php?OB=MaterialCode&ST=<?php echo $ST?>">MATERIAL</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="#">PHOTO</a></td>
    				<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="#">WORKPLAN</a></td>
					<td nowrap="nowrap" class="InLineColumnTD"><a class="InLineSorterLink" href="#">QTY</a></td>	
  				</tr>
  				<!-- BEGIN New Row -->
				
  				<?php
				if (!empty($Kosong))
				{
					echo "<tr>
							<td class=\"InLineDataTD\" colspan=\"11\">$Kosong</td>
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
					<td class=\"InLineDataTD\">$alldata[Qty]</td>
  				</tr>";
				};
				 				?>
				<tr>
  					<td class="InLineFooterTD" colspan="11"><a class="InLineNavigatorLink" href=View_AddCollect.php>ADD ITEM</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a class="InLineNavigatorLink" href=View_AddCollect.php>SUBMIT</a> &nbsp;</td>
				</tr>
			</table>
		</td>
  	</tr>
</table>
</body>
</html>