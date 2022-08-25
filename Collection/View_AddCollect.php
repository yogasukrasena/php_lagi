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
	
$id = $_GET['id'];
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

//ini utk edit/del, diambil dari get
$DesCode = $_GET['des'];
$TexCode = $_GET['tex'];
$NamCode = $_GET['nam'];
$ColCode = $_GET['col'];
$CatCode = $_GET['cat'];
$MatCode = $_GET['mat'];
$SizCode = $_GET['siz'];
$ColekCode = $DesignCode.$NameCode.$CategoryCode.$SizeCode.$TextureCode.$ColorCode.$MaterialCode;

//Tipe Form
if (!empty($id))
{
	$TipeForm = "Edit";
}
else
{
	$TipeForm = "Add";
}

?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Add Collection</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
</head>
<body bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" text="#000000" class="InLinePageBODY">
<!-- BEGIN Record c_codification &nbsp;<a class="InLineDataLink" href="{Link1_Src}">{Link1}</a><a class="InLineDataLink" href="{c_kode_Src}">{c_kode}</a>-->
<form method="post" action="AddCollect.php" name="AddCollectForm">
  <font class="InLineFormHeaderFont"><?php echo "$TipeForm "."Collection" ?> </font> 
  <table cellpadding="3" cellspacing="0" class="InLineFormTABLE">
    <?php
		if (!empty($error))
		{
		echo "<tr>
				<td colspan=\"2\" class=\"InLineErrorDataTD\">$error</td>
			 </tr>";
		}
	?>
    <tr>
      <td class="InLineFieldCaptionTD">Design</td> 
      <td class="InLineDataTD">
        <select name="DesignSelect" class="InLineSelect">
          <option value="" selected>Select Value</option>
 			<?php
				for ($i = 0; $i < $DesignRow = mysql_num_rows($Design); $i++)
				{
					$DataDesign = mysql_fetch_array($Design);
					if ($DesCode == $DataDesign['DesignCode'])
					{
						echo "<option value=\"$DataDesign[DesignCode]\" Selected>$DataDesign[DesignName]</option>";
					}
					else
					{
						echo "<option value=\"$DataDesign[DesignCode]\">$DataDesign[DesignName]</option>";
					}
				}
        	?>  
        </select>
 &nbsp;</td> 
    </tr>
 
    <tr>
      <td class="InLineFieldCaptionTD">Name&nbsp;</td> 
      <td class="InLineDataTD">
        <select name="NameSelect" class="InLineSelect">
          <option value="" selected>Select Value</option>
 		  <?php
			for ($i = 0; $i < $NameRow = mysql_num_rows($Name); $i++)
			{
				$DataName = mysql_fetch_array($Name);
				if ($NamCode == $DataName['NameCode'])
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
 &nbsp;</td> 
    </tr>
    <tr>
      <td class="InLineFieldCaptionTD">Category</td> 
      <td class="InLineDataTD">
        <select name="CategorySelect" class="InLineSelect">
          <option value="" selected>Select Value</option>
 		  <?php
			for ($i = 0; $i < $CategoryRow = mysql_num_rows($Category); $i++)
			{
				$DataCategory = mysql_fetch_array($Category);
				if ($CatCode == $DataCategory['CategoryCode'])
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
 &nbsp;</td> 
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
				if ($TexCode == $DataTexture['TextureCode'])
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
        &nbsp;</td> 
    </tr>
 
    <tr>
      <td class="InLineFieldCaptionTD">Color</td> 
      <td class="InLineDataTD"><select name="ColorSelect" class="InLineSelect">
          <option value="">Select Value</option>
          <?php
			for ($i = 0; $i < $ColorRow = mysql_num_rows($Color); $i++)
			{
				$DataColor = mysql_fetch_array($Color);
				if ($ColCode == $DataColor['ColorCode'])
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
        &nbsp;
	  </td> 
    </tr>
 
    <tr>
      <td class="InLineFieldCaptionTD">Material</td> 
      <td class="InLineDataTD">
        <select name="MaterialSelect" class="InLineSelect">
          <option value="" selected>Select Value</option>
		  <?php
			for ($i = 0; $i < $MaterialRow = mysql_num_rows($Material); $i++)
			{
				$DataMaterial = mysql_fetch_array($Material);
				if ($MatCode == $DataMaterial['MaterialCode'])
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
 &nbsp;</td> 
    </tr>
 
    <tr>
      <td class="InLineFieldCaptionTD">Info/Size</td> 
      <td class="InLineDataTD">
        <select name="SizeSelect" class="InLineSelect">
          <option value="" selected>Select Value</option>
 		  <?php
			for ($i = 0; $i < $SizeRow = mysql_num_rows($Size); $i++)
			{
				$DataSize = mysql_fetch_array($Size);
				if ($SizCode == $DataSize['SizeCode'])
				{
					echo "<option value=\"$DataSize[SizeCode]\" Selected>$DataSize[SizeName]</option>";
				}
				else
				{
					echo "<option value=\"$DataSize[SizeCode]\">$DataSize[SizeName]</option>";
				}
			}
          ?>  
        </select>
 &nbsp;</td> 
    </tr>
 
    <tr>
      <td colspan="2" align="right" nowrap class="InLineFooterTD"><input type="hidden" name="id" value="<?php echo $id?>"><input type="hidden" name="TipeForm" value="<?php echo $TipeForm?>">
	  <?php
	  	If ($TipeForm == "Add")
		{
        	echo "<input name=\"Add\" type=\"submit\" value=\"Add\" class=\"InLineButton\">";
		}
		else
		{
        	echo "<input name=\"Submit\" type=\"submit\" value=\"Submit\" onClick=\"AddCollectForm.TipeForm.value = 'Edit'\" class=\"InLineButton\">
        <input name=\"Delete\" type=\"submit\" value=\"Delete\" onClick=\"AddCollectForm.TipeForm.value = 'Del'\" class=\"InLineButton\">				&nbsp;";
		}
	  ?>	 
		</td> 
    </tr>
 
  </table>
</form>
</body>
</html>