<?php	
session_start();
include ("../Includes/sql.php");
if (!$_SESSION["userlogin"]) {
	header("location: ../index.php");
}
/*
Price For Firing :
pieces per hour dihitung secara otomatis ama system,
hasil dari control dibagi loading.
Jadi yang perlu master cuma control aja.
*/	
function money_form($money)
{
	return str_replace(",", "." , number_format($money));
	return str_replace(".", "," , number_format($money));
}
?>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Costing</title>
<link rel="stylesheet" type="text/css" href="../includes/Style-Oren.css">
<script language="javascript">
function pick(price) {
   document.EditCosting.ClayPricePerKG.value = price;
  <!-- document.EditCosting.ClayCost.value = price * document.EditCosting.ClayKG.value ; -->
   <!--document.EditCosting.ClayType.value = type;   -->
}
</script>
</head>

<body>
<table width="70%" border="0" cellspacing="0" cellpadding="0">

  	<tr>
   	  	<td>
		<?php
			error_reporting(0);
			$sid=$_GET['sid'];
			$result = mysql_query("SELECT SampleCeramic.*, tblDesMaterial.*, tblUnit.* FROM sampleceramic INNER JOIN tblDesMaterial ON SampleCeramic.DesignMat1 = tblDesMaterial.DmCode INNER JOIN tblUnit ON tblDesMaterial.DmUnit = tblUnit.UnitID WHERE sID = $sid");
			$alldata = mysql_fetch_array($result);
		?>		
			<form name="EditCosting" method="post" action="EditCosting.php">
			<input type="hidden" name="sID" value="<?php echo $sid ?>" />
			<input type="hidden" name="Dm1" value="<?php echo $result['DesignMat1']?>"/>
			<table width="100%" border="0" cellspacing="0" cellpadding="3">
      			<tr>
        			<td class="InLineDataTD"><b>Design</b><br /><?php echo $alldata['DesignName']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Name</b><br /><?php echo $alldata['NameDescription']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Category</b><br /><?php echo $alldata['CategoryName']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Info/Size</b><br /><?php echo $alldata['SizeName']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Texture</b><br /><?php echo $alldata['TextureName']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Color</b><br /><?php echo $alldata['ColorName']?>&nbsp;</td>
        			<td class="InLineDataTD"><b>Material</b><br /><?php echo $alldata['MaterialName']?>&nbsp;</td>																									
      			</tr>
				<tr>
        			<td colspan="2" class="InLineDataTD"><b>Barcode</b><br />
       			  &nbsp;</td>
        			<td colspan="2" class="InLineDataTD"><b>Client Code</b><br /><?php echo $alldata['ClientCode']?>&nbsp;</td>
        			<td colspan="3" class="InLineDataTD"><b>Client Description</b><br />
       			  <?php echo $alldata['ClientDescription']?>&nbsp;</td>
      			</tr>
				<tr>
					<td colspan="7" class="TopSeparator">&nbsp;</td>
				</tr>
				<tr>
       			  	<td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>CLAY</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Clay</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>KG</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Price / KG</b>&nbsp;</td>
        			<td colspan="2" align="center" class="InLineColumnBlackTD"><b>Total Clay Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Clay");
						//$ResultMaster = mysql_fetch_array($QueryMaster);
						$ClayAmount = mysql_num_rows($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%">
						<select name="ClayType" class="InLineSelect">
						<option value=""<?php if (empty($alldata['ClayType'])) echo "selected";?>>- select -</option>
						
						<?php
								for ($i = 0; $i < $ClayAmount = mysql_num_rows($QueryMaster); $i++)
								{
									$ResultMaster = mysql_fetch_array($QueryMaster);
									//$option .= "<option ";
									//$option .= "value=\"$ClayID[$i]\">$ClayType[$i]</option> \n";
									if ($ResultMaster['ID'] == $alldata['ClayType'])
									{
									echo "<option onClick=\"javascript:pick('$ResultMaster[PricePerKG]')\"  value=\"$ResultMaster[ID]\" selected>$ResultMaster[ClayType]</option>";
										
									}
									else
									{
									echo "<option onClick=\"javascript:pick('$ResultMaster[PricePerKG]')\" value=\"$ResultMaster[ID]\">$ResultMaster[ClayType]</option>";
									}
								}
        				?>
						</select>        			</td>
        			<td class="InLineDataTD" width="13%"><input type="hidden" name="ClayKG" value="<?php echo$alldata['ClayKG']?>" />
        			<?php echo$alldata['ClayKG']?></td>
        			<td class="InLineDataTD" colspan="2">
						<?php
							$QueryMaster = mysql_query("SELECT PricePerKG FROM tblCosting_Clay WHERE ID = '$alldata[ClayType]'");
							$ClayPrice = mysql_fetch_array($QueryMaster);
						?>
						<input readonly="yes" name="ClayPricePerKG" value="<?php echo $ClayPrice['PricePerKG']?>" />					</td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['ClayCost'])?></td>
      			</tr>
				<tr>
       			  	<td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>CLAY PREPARATION</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Clay Preparation Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_ClayPreparation");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="ClayPreparationCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="ClayPreparationMinute" size="12" value="<?php echo $alldata['ClayPreparationMinute']?>"  /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['ClayPreparationPPH']?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['ClayPreparationCost'])?></td>
				</tr>
				<tr>
       			  	<td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>WHEEL</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Wheel Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Wheel");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="WheelCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="WheelMinute" size="12" value="<?php echo $alldata['WheelMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['WheelPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['WheelCost'])?></td>
				</tr>
				<tr>
       			  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>SLAB</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Slab Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Slab");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="SlabCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="SlabMinute" size="12" value="<?php echo $alldata['SlabMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['SlabPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['SlabCost']) ?></td>
				</tr>
				<tr>
       			  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>CASTING</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Casting Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Casting");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="CastingCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="CastingMinute" size="12" value="<?php echo $alldata['CastingMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['CastingPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['CastingCost']) ?></td>
				</tr>
				<tr>
       			  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>FINISHING</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Finishing Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Finishing");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="FinishingCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="FinishingMinute" size="12" value="<?php echo $alldata['FinishingMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['FinishingPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['FinishingCost']) ?></td>
				</tr>
				<tr>
   			  	  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>GLAZING</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Glazing Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Glazing");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="GlazingCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="GlazingMinute" size="12" value="<?php echo $alldata['GlazingMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['GlazingPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['GlazingCost']) ?></td>
				</tr>
				<tr>
	  	  	  	  <td width="16%" rowspan="3" align="center" class="InLineDataTD"><b>FIRING STANDARD</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Firing Category </b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Loading</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="11%"><b>Control</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Price/Firing</b>&nbsp;</td>					
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Firing Standard Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_StandardBisque");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%">BISQUE</td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="StandardBisqueLoading" size="12" value="<?php echo $alldata['StandardBisqueLoading']?>" /></td>
					<?php 
						$Control = $alldata['StandardBisqueCost'] * $alldata['StandardBisqueLoading'];
						if (($Control == 0) || ($Control < 400000))
						{
							echo "<td align=\"right\" class=\"InLineForControl\" style=\"color:#FF0000\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control == 400000) || ($Control < 700000))
						{
							echo "<td style=\"color:#FF9966\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control > 700000))
						{
							echo "<td style=\"color:#009900\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
					?>
        			<td align="right" class="InLineDataTD"><?php echo money_form($ResultMaster['PricePerFiring'])?></td>					
        			<td colspan="2" align="right" class="InLineDataTD"><input type="hidden" name="StandardBisqueCost" value="<?php echo ($alldata['ClayKG'] * $ResultMaster['PricePerFiring'])?>" /><?php echo money_form($alldata['StandardBisqueCost'])?>
					</td>
				</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_StandardGlaze");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%">GLAZE</td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="StandardGlazeLoading" size="12" value="<?php echo $alldata['StandardGlazeLoading']?>" /></td>
					<?php 
						$Control = ($alldata['StandardGlazeCost'] * $alldata['StandardGlazeLoading']);
						if (($Control == 0) || ($Control < 400000))
						{
							echo "<td align=\"right\" class=\"InLineForControl\" style=\"color:#FF0000\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control == 400000) || ($Control < 700000))
						{
							echo "<td style=\"color:#FF9966\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control > 700000))
						{
							echo "<td style=\"color:#009900\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
					?>
        			<td align="right" class="InLineDataTD"><?php echo money_form($ResultMaster['PricePerFiring'])?></td>					
        			<td colspan="2" align="right" class="InLineDataTD"><input type="hidden" name="StandardGlazeCost" value="<?php echo ($alldata['ClayKG'] * $ResultMaster['PricePerFiring'])?>" /><?php echo money_form($alldata['StandardGlazeCost'])?></td>
				</tr>
				<tr>
		  	  	  	<td width="16%" rowspan="3" align="center" class="InLineDataTD"><b>FIRING RAKU</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Firing Category </b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Loading</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="11%"><b>Control</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Price/Firing</b>&nbsp;</td>					
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Firing Raku Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_RakuBisque");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%">BISQUE</td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="RakuBisqueLoading" size="12" value="<?php echo $alldata['RakuBisqueLoading']?>" /></td>
        			<?php 
        				$Control = ($alldata['RakuBisqueCost'] * $alldata['RakuBisqueLoading']);
        				if (($Control == 0) || ($Control < 400000))
						{
							echo "<td align=\"right\" class=\"InLineForControl\" style=\"color:#FF0000\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control == 400000) || ($Control < 700000))
						{
							echo "<td style=\"color:#FF9966\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control > 700000))
						{
							echo "<td style=\"color:#009900\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
        			?>
        			<td align="right" class="InLineDataTD"><?php echo money_form($ResultMaster['PricePerFiring'])?></td>					
        			<td colspan="2" align="right" class="InLineDataTD"><input type="hidden" name="RakuBisqueCost" value="<?php echo ($alldata['ClayKG'] * $ResultMaster['PricePerFiring'])?>" /><?php echo money_form($alldata['RakuBisqueCost'])?></td>
				</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_RakuGlaze");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%">GLAZE</td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="RakuGlazeLoading" size="12" value="<?php echo $alldata['RakuGlazeLoading']?>" /></td>
        			<?php
	        			 $Control = ($alldata['RakuGlazeCost'] * $alldata['RakuGlazeLoading']);
	        			 if (($Control == 0) || ($Control < 400000))
						{
							echo "<td align=\"right\" class=\"InLineForControl\" style=\"color:#FF0000\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control == 400000) || ($Control < 700000))
						{
							echo "<td style=\"color:#FF9966\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
						elseif (($Control > 700000))
						{
							echo "<td style=\"color:#009900\" align=\"right\" class=\"InLineForControl\"><b>".money_form($Control)."</b></td>";
						}
        			?>
        			<td align="right" class="InLineDataTD"><?php echo money_form($ResultMaster['PricePerFiring'])?></td>					
        			<td colspan="2" align="right" class="InLineDataTD"><input type="hidden" name="RakuGlazeCost" value="<?php echo ($alldata['ClayKG'] * $ResultMaster['PricePerFiring'])?>" /><?php echo money_form($alldata['RakuGlazeCost'])?></td>
				</tr>
				<tr>
		  	  	  	<td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>DESIGN MATERIAL</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Design Material</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Quantity</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="11%"><b>Unit</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="right" width="15%"><b>Price/Unit</b>&nbsp;</td>					
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Design Material Cost</b></td>
      			</tr>
				<tr>
        			<td class="InLineDataTD" width="15%"><?php echo $alldata['DmDescription']?></td>
        			<td class="InLineDataTD" width="13%"><?php echo $alldata['DesignMatQty1']?></td>
        			<td align="center" class="InLineDataTD"><?php echo $alldata['UnitValue']?></td>
        			<td align="right" class="InLineDataTD"><?php echo money_form($alldata['DmUnitPrice'])?></td>	
					<?php $DesignMatCost = ($alldata['DesignMatQty1'] * $alldata['DmUnitPrice']); ?>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($DesignMatCost)?> </td>
				</tr>
				<tr>
   			  	  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>MOVEMENT</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Movement Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_Movement");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="MovementCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="MovementMinute" size="12" value="<?php echo $alldata['MovementMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['MovementPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['MovementCost']) ?></td>
				</tr>
				<tr>
   			  	  <td width="16%" rowspan="2" align="center" class="InLineDataTD"><b>PACKAGING WORK</b>&nbsp;</td>
        			<td class="InLineColumnBlackTD" align="center" width="15%"><b>Cost/Minute</b></td>
        			<td class="InLineColumnBlackTD" align="center" width="13%"><b>Minute</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Pieces/Hour</b>&nbsp;</td>
        			<td colspan="2" class="InLineColumnBlackTD" align="center"><b>Total Packaging Work Cost</b></td>
      			</tr>
				<tr>
					<?php
						$QueryMaster = mysql_query("SELECT * FROM tblCosting_PackagingWork");
						$ResultMaster = mysql_fetch_array($QueryMaster);
					?>
        			<td class="InLineDataTD" width="15%"><input type="hidden" name="PackagingWorkCostPerMinute" value="<?php echo $ResultMaster['CostPerMinute']?>" /><?php echo money_form($ResultMaster['CostPerMinute']) ?></td>
        			<td class="InLineDataTD" width="13%"><input type="text" name="PackagingWorkMinute" size="12" value="<?php echo $alldata['PackagingWorkMinute']?>" /></td>
        			<td class="InLineDataTD" colspan="2"><?php echo $alldata['PackagingWorkPPH'] ?></td>
        			<td colspan="2" align="right" class="InLineDataTD"><?php echo money_form($alldata['PackagingWorkCost']) ?></td>
				</tr>
				<tr>
					<td colspan="5" class="InLineColumnBlackTD" align="right"><b>TOTAL</b></td>
					<td width="5%" align="Left" class="MoneyBlackTD"><b>Rp.</b></td>					
					<td class="InLineColumnBlackTD" align="right"><?php echo money_form($alldata['TotalAllCost']) ?></td>
				</tr>
				<tr>
					<td colspan="5" class="InLineDataTD" align="right"><b>RISK</b>(TOTAL+10%)</td>
					<td width="5%" align="Left" class="MoneyTD"><b>Rp.</b></td>
					<td width="25%" align="right" class="InLineDataTD"><?php echo money_form(ceil($alldata['RiskPrice'])) ?></td>					
				</tr>
				<tr>
					<td colspan="5" class="InLineDataTD" align="right"><b>HYPOTHETICAL SELLING PRICE</b> (RISK X 3)</td>
					<td width="5%" align="Left" class="MoneyTD"><b>Rp.</b></td>					
					<td class="InLineDataTD" align="right"><?php echo money_form($alldata['HypoSellingPrice']) ?></td>
				</tr>
				<tr>
					<td colspan="5" class="InLineColumnBlackTD" align="right"><b>REAL SELLING PRICE</b>&nbsp;&nbsp;<input size="15" type="text" name="RealSellingPrice" value="<?php echo $alldata['RealSellingPrice'] ?>" /></td>
					<td width="5%" align="Left" class="MoneyBlackTD"><b>Rp.</b></td>			
					<td class="InLineColumnBlackTD" align="right"><?php echo money_form($alldata['RealSellingPrice'])?></td>
				</tr>
				<tr>
					<td colspan="7" class="FooterSubmit" align="center"><input class="InLineButton" type="submit" name="submit" value="SUBMIT" />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input class="InLineButton" type="reset" name="cancel" value="CANCEL" /></td>
				</tr>				
    		</table>
			</form>
		</td>
  	</tr>
</table>
<p></p>

<table width="50%" border="0" cellpadding="3" cellspacing="0">
	<tr>
		<td class="InLineColumnBlackTD" width="97"></td>
		<td class="InLineColumnBlackTD" width="100" align="center"><b>Multiplier</b></td>
		<td class="InLineColumnBlackTD" width="101" align="center"><b>Unit</b></td>
		<td class="InLineColumnBlackTD" width="80" align="center"><b>Wheel pcs</b></td>	
		<td class="InLineColumnBlackTD" width="83" align="center"><b>Total/Pieces</b></td>
	</tr>
	<tr>
		<?php
			$QueryMaster = mysql_query("SELECT * FROM tblCosting_ProductiveHours");
			$ResultMaster = mysql_fetch_array($QueryMaster);
			//$QueryWheel = mysql_query("SELECT * FROM tblCosting_Wheel");
			//$ResultWheel = mysql_fetch_array($QueryWheel);
			$TotalPiecesDay = round(($ResultMaster['Day']) * ($alldata['WheelPPH']));
			$TotalPiecesMonth = ($TotalPiecesDay * ($ResultMaster['Month']));
			$TotalPiecesYear = ($TotalPiecesMonth * ($ResultMaster['Year']));
		?>
		<td class="InLineDataTD" align="center"><b>DAY</b></td>
		<td class="InLineDataTD" align="right"><?php echo $ResultMaster['Day'] ?>&nbsp;</td>
		<td class="InLineDataTD" align="left">Productive Hours</td>
		<td class="InLineDataTD" align="right"><?php echo $alldata['WheelPPH']?>&nbsp;</td>
		<td class="InLineDataTD" align="right"><?php echo money_form($TotalPiecesDay) ?>&nbsp;</td>
	</tr>
	<tr>
		<td class="InLineDataTD" align="center"><b>MONTH</b></td>
		<td class="InLineDataTD" align="right"><?php echo $ResultMaster['Month']?>&nbsp;</td>
		<td class="InLineDataTD" align="left">Days</td>
		<td class="InLineDataTD" align="left">&nbsp;</td>
		<td class="InLineDataTD" align="right"><?php echo money_form($TotalPiecesMonth) ?>&nbsp;</td>
	</tr>
	<tr>
		<td class="InLineDataTD" align="center"><b>YEAR</b></td>
		<td class="InLineDataTD" align="right"><?php echo $ResultMaster['Year']?>&nbsp;</td>
		<td class="InLineDataTD" align="left">Months</td>
		<td class="InLineDataTD" align="left">&nbsp;</td>
		<td class="InLineDataTD" align="right"><?php echo money_form($TotalPiecesYear)?>&nbsp;</td>
	</tr>
	<tr>
		<?php
			unset($QueryWheel);
			unset($ResultWheel);
			$QueryMaster = mysql_query("SELECT * FROM tblCosting_TrowWorker");
			$ResultMaster = mysql_fetch_array($QueryMaster);
			$TotalPiecesWorker = ($TotalPiecesYear * ($ResultMaster['TrowWorker']));
		?>
		<td class="InLineDataTD" align="center"><b>WORKER</b></td>
		<td class="InLineDataTD" align="right"><?php echo $ResultMaster['TrowWorker']?>&nbsp;</td>
		<td class="InLineDataTD" align="left">Trow Worker</td>
		<td class="InLineDataTD" align="left">&nbsp;</td>
		<td class="InLineDataTD" align="right"><?php echo money_form($TotalPiecesWorker)?>&nbsp;</td>
	</tr>
	<tr>
		<td class="InLineColumnBlackTD" align="right" colspan="3"><b>TOTAL</b>(on total cost + risk)</td>
		<td class="MoneyBlackTD">
			<table width="5%" border="0" cellpadding="1" cellspacing="0">
				<tr>
					<td><b>Rp.</b></td>
				</tr>
			</table>
		</td>
		<td class="InLineColumnBlackTD" colspan="2" align="right"><b><?php echo money_form(($alldata['RiskPrice'] * $TotalPiecesWorker))?></b></td>
	</tr>
	<tr>
		<?php
			$QueryMaster = mysql_query("SELECT * FROM tblCosting_CostBudgetPreview");
			$ResultMaster = mysql_fetch_array($QueryMaster);
		?>
		<td class="InLineColumnBlackTD" align="right" colspan="3"><b>COST BUDGET PREVIEW <?PHP echo $ResultMaster['BudgetYear']?></b></td>
		<td class="MoneyBlackTD">
			<table width="5%" border="0" cellpadding="1" cellspacing="0">
				<tr>
					<td><b>Rp.</b></td>
				</tr>
			</table>
		</td>
		<td class="InLineColumnBlackTD" colspan="2" align="right"><b><?php echo money_form($ResultMaster['CostBudgetAmmount'])?></b></td>
	</tr>
	<tr>
		<td class="InLineColumnBlackTD" align="right" colspan="3"><b>COST PRICE REACHING BUDGET PREVIEW <?PHP echo $ResultMaster['BudgetYear']?></b></td>
		<td class="MoneyBlackTD">
			<table width="5%" border="0" cellpadding="1" cellspacing="0">
				<tr>
					<td><b>Rp.</b></td>
				</tr>
			</table>
		</td>
		<td class="InLineColumnBlackTD" colspan="2" align="right"><b><?php echo money_form($ResultMaster['CostBudgetAmmount'] / $TotalPiecesWorker)?></b></td>
	</tr>		
</table>
</body>
</html>
