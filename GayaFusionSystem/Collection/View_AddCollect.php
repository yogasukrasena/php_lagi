<?php
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}	

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

$DesignCode = $_POST['DesignSelect'];
$TextureCode = $_POST['TextureSelect'];
$NameCode = $_POST['NameSelect'];
$ColorCode = $_POST['ColorSelect'];
$CategoryCode = $_POST['CategorySelect'];
$MaterialCode = $_POST['MaterialSelect'];
$SizeCode = $_POST['SizeSelect'];
$CollectCode = $DesignCode.$NameCode.$CategoryCode.$SizeCode.$TextureCode.$ColorCode.$MaterialCode.
$TipeForm = $_POST['TipeForm'];
If ($TipeForm == "Add")
{
$QueryOperation = "INSERT INTO tblCollect_Master (DesignCode, TextureCode, NameCode, ColorCode, CategoryCode, MaterialCode, SizeCode, CollectCode) ";
$QueryOperation .= " VALUE ('$DesignCode', '$TextureCode', '$NameCode', '$ColorCode', '$CategoryCode', '$MaterialCode', '$SizeCode','$CollectCode')";
	if (empty($DesignCode))
	{
		$error = "The value in field Design is required.";
	}
	if (empty($TextureCode))
	{
		$error .= "<br>The value in field Texture is required.";
	} 
	if (empty($NameCode))
	{
		$error .= "<br>The value in field Name is required.";
	} 
	if (empty($ColorCode))
	{
		$error .= "The value in field Color is required.";
	} 
	if (empty($CategoryCode))
	{
		$error .= "The value in field Category is required.";
	} 
	if (empty($MaterialCode))
	{
		$error .= "The value in field Material is required.";
	} 
	if (empty($SizeCode))
	{
		$error .= "The value in field Size is required.";
	} 
	
	if (empty($error))
	{
		$ExecQuery = mysql_query($QueryOperation);
		if ($ExecQuery)
		{
			header("location: MainCollection.php");
		}
		else
		{
			$sala = mysql_error();
			echo "$sala"."<br>"."Failed Add Data";
		}
	}
}
elseif ($TipeForm == "Edit")
{
$QueryOperation="UPDATE tblCollect_Master SET 
		tblCollect_Master.DesignCode = '$DesignCode', 
		tblCollect_Master.TextureCode = '$TextureCode',
		tblCollect_Master.NameCode = '$NameCode',
		tblCollect_Master.ColorCode = '$ColorCode',
		tblCollect_Master.CategoryCode = '$CategoryCode',
		tblCollect_Master.MaterialCode = '$MaterialCode',
		tblCollect_Master.SizeCode = '$SizeCode'
		where tblCollect_Master.CollectCode = '$CollectCode';";
$ExecQuery = mysql_query($QueryOperation);
	if ($ExecQuery)
	{
	header("location: MainCollection.php");
	}
	else
	{
	$sala = mysql_error();
	echo "$sala"."<br>"."Failed Update Data";
	}
}
elseif ($TipeForm == "Del")
{
$QueryOperation="Delete FROM tblCollect_Master WHERE tblCollect_Master.CollectCode = '$CollectCode';";
$ExecQuery = mysql_query($QueryOperation);
	if ($ExecQuery)
	{
	header("location: MainCollection.php");
	}
	else
	{
	$sala = mysql_error();
	echo "$sala"."<br>"."Failed Delete Data";
	}
}
?>
<html>
<head>
<meta name="GENERATOR" content="CodeCharge Studio 2.3.2.24">
<meta http-equiv="content-type" content="text/html; charset=iso-8859-1">
<title>Add Collection</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Collect.css">
<script language="JavaScript">
var Nav4 = ((navigator.appName == "Netscape") && (parseInt(navigator.appVersion) == 4))

var dialogWin = new Object()

function openDialog(url, width, height, returnFunc, args) {
	if (!dialogWin.win || (dialogWin.win && dialogWin.win.closed)) {
		dialogWin.returnFunc = returnFunc
		dialogWin.returnedValue_c_col_id = ""
		dialogWin.args = args
		dialogWin.url = url
		dialogWin.width = width
		dialogWin.height = height
		dialogWin.name = (new Date()).getSeconds().toString()

		if (Nav4) {
			dialogWin.left = window.screenX + 
			   ((window.outerWidth - dialogWin.width) / 2)
			dialogWin.top = window.screenY + 
			   ((window.outerHeight - dialogWin.height) / 2)
			var attr = "screenX=" + dialogWin.left + 
			   ",screenY=" + dialogWin.top + ",resizable=no,width=" + 
			   dialogWin.width + ",height=" + dialogWin.height
		} else {
			dialogWin.left = (screen.width - dialogWin.width) / 2
			dialogWin.top = (screen.height - dialogWin.height) / 2
			var attr = "left=" + dialogWin.left + ",top=" + 
			   dialogWin.top + ",resizable=no,width=" + dialogWin.width + 
			   ",height=" + dialogWin.height
		}
		
		dialogWin.win=window.open(dialogWin.url, dialogWin.name, attr)
		dialogWin.win.focus()
	} else {
		dialogWin.win.focus()
	}
}

</script>
</head>
<body bgcolor="#ffffff" link="#000000" alink="#000000" vlink="#000000" text="#000000" class="InLinePageBODY">
<!-- BEGIN Record c_codification -->&nbsp;<a class="InLineDataLink" href="{Link1_Src}">{Link1}</a><a class="InLineDataLink" href="{c_kode_Src}">{c_kode}</a>
<form method="post" action="View_AddCollect.php" name="AddCollectForm">
  <font class="InLineFormHeaderFont">Add/Edit Collection </font> 
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
					echo "<option value=\"$DataDesign[DesignCode]\">$DataDesign[DesignName]</option>";
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
				echo "<option value=\"$DataName[NameCode]\">$DataName[NameDesc]</option>";
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
				echo "<option value=\"$DataCategory[CategoryCode]\">$DataCategory[CategoryName]</option>";
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
				echo "<option value=\"$DataTexture[TextureCode]\">$DataTexture[TextureName]</option>";
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
				echo "<option value=\"$DataColor[ColorCode]\">$DataColor[ColorName]</option>";
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
				echo "<option value=\"$DataMaterial[MaterialCode]\">$DataMaterial[MaterialName]</option>";
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
				echo "<option value=\"$DataSize[SizeCode]\">$DataSize[SizeName]</option>";
			}
          ?>  
        </select>
 &nbsp;</td> 
    </tr>
 
    <tr>
      <td colspan="2" align="right" nowrap class="InLineFooterTD"><input type="hidden" name="TipeForm" value="Add" />
        <!-- BEGIN Button Button_Insert --><input name="Add" type="submit" value="Add" class="InLineButton"><!-- END Button Button_Insert -->
        <!-- BEGIN Button Button_Update --><input name="Submit" type="submit" value="Submit" class="InLineButton"><!-- END Button Button_Update -->
        <!-- BEGIN Button Button_Delete --><input name="Delete" type="submit" value="Delete" class="InLineButton"><!-- END Button Button_Delete -->&nbsp; </td> 
    </tr>
 
  </table>
</form>
<!-- END Record c_codification -->
</body>
</html>