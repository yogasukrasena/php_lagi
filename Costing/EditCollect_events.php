<?php
//BindEvents Method @1-3619FE48
function BindEvents()
{
    global $Costing;
    $Costing->DesignName->CCSEvents["BeforeShow"] = "Costing_DesignName_BeforeShow";
    $Costing->SizeName->CCSEvents["BeforeShow"] = "Costing_SizeName_BeforeShow";
    $Costing->ClayCost->CCSEvents["BeforeShow"] = "Costing_ClayCost_BeforeShow";
    $Costing->ClayPreparationCost->CCSEvents["BeforeShow"] = "Costing_ClayPreparationCost_BeforeShow";
    $Costing->WheelCost->CCSEvents["BeforeShow"] = "Costing_WheelCost_BeforeShow";
    $Costing->SlabCost->CCSEvents["BeforeShow"] = "Costing_SlabCost_BeforeShow";
    $Costing->CastingCost->CCSEvents["BeforeShow"] = "Costing_CastingCost_BeforeShow";
    $Costing->FinishingCost->CCSEvents["BeforeShow"] = "Costing_FinishingCost_BeforeShow";
    $Costing->GlazingCost->CCSEvents["BeforeShow"] = "Costing_GlazingCost_BeforeShow";
    $Costing->StandardBisqueCost->CCSEvents["BeforeShow"] = "Costing_StandardBisqueCost_BeforeShow";
    $Costing->StandardGlazeCost->CCSEvents["BeforeShow"] = "Costing_StandardGlazeCost_BeforeShow";
    $Costing->RakuBisqueCost->CCSEvents["BeforeShow"] = "Costing_RakuBisqueCost_BeforeShow";
    $Costing->RakuGlazeCost->CCSEvents["BeforeShow"] = "Costing_RakuGlazeCost_BeforeShow";
    $Costing->MovementCost->CCSEvents["BeforeShow"] = "Costing_MovementCost_BeforeShow";
    $Costing->PackagingWorkCost->CCSEvents["BeforeShow"] = "Costing_PackagingWorkCost_BeforeShow";
    $Costing->TotalAllCost->CCSEvents["BeforeShow"] = "Costing_TotalAllCost_BeforeShow";
    $Costing->RiskPrice->CCSEvents["BeforeShow"] = "Costing_RiskPrice_BeforeShow";
    $Costing->HypoSellingPrice->CCSEvents["BeforeShow"] = "Costing_HypoSellingPrice_BeforeShow";
    $Costing->ClayPrice->CCSEvents["BeforeShow"] = "Costing_ClayPrice_BeforeShow";
    $Costing->DesignMat1->CCSEvents["BeforeShow"] = "Costing_DesignMat1_BeforeShow";
    $Costing->DesignMat2->CCSEvents["BeforeShow"] = "Costing_DesignMat2_BeforeShow";
    $Costing->DesignMat3->CCSEvents["BeforeShow"] = "Costing_DesignMat3_BeforeShow";
    $Costing->DesignMat4->CCSEvents["BeforeShow"] = "Costing_DesignMat4_BeforeShow";
    $Costing->lblStdBisque->CCSEvents["BeforeShow"] = "Costing_lblStdBisque_BeforeShow";
    $Costing->lblStdGlaze->CCSEvents["BeforeShow"] = "Costing_lblStdGlaze_BeforeShow";
    $Costing->lblRakuBisque->CCSEvents["BeforeShow"] = "Costing_lblRakuBisque_BeforeShow";
    $Costing->lblRakuGlaze->CCSEvents["BeforeShow"] = "Costing_lblRakuGlaze_BeforeShow";
    $Costing->TotDesignMat1->CCSEvents["BeforeShow"] = "Costing_TotDesignMat1_BeforeShow";
    $Costing->TotDesignMat2->CCSEvents["BeforeShow"] = "Costing_TotDesignMat2_BeforeShow";
    $Costing->TotDesignMat3->CCSEvents["BeforeShow"] = "Costing_TotDesignMat3_BeforeShow";
    $Costing->TotDesignMat4->CCSEvents["BeforeShow"] = "Costing_TotDesignMat4_BeforeShow";
    $Costing->TotAllPieces->CCSEvents["BeforeShow"] = "Costing_TotAllPieces_BeforeShow";
    $Costing->NameDesc->CCSEvents["BeforeShow"] = "Costing_NameDesc_BeforeShow";
    $Costing->CategoryName->CCSEvents["BeforeShow"] = "Costing_CategoryName_BeforeShow";
    $Costing->TextureName->CCSEvents["BeforeShow"] = "Costing_TextureName_BeforeShow";
    $Costing->ColorName->CCSEvents["BeforeShow"] = "Costing_ColorName_BeforeShow";
    $Costing->MaterialName->CCSEvents["BeforeShow"] = "Costing_MaterialName_BeforeShow";
    $Costing->LastUpdate->CCSEvents["BeforeShow"] = "Costing_LastUpdate_BeforeShow";
    $Costing->CCSEvents["BeforeShow"] = "Costing_BeforeShow";
    $Costing->CCSEvents["BeforeUpdate"] = "Costing_BeforeUpdate";
}
//End BindEvents Method

//Costing_DesignName_BeforeShow @5-0EF5E5F7
function Costing_DesignName_BeforeShow(& $sender)
{
    $Costing_DesignName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_DesignName_BeforeShow

//Custom Code @250-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("DesignCode","");
	$Costing->DesignName->SetValue(CCDLookUp("DesignName","tblCollect_Design", "DesignCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_DesignName_BeforeShow @5-15371C79
    return $Costing_DesignName_BeforeShow;
}
//End Close Costing_DesignName_BeforeShow

//Costing_SizeName_BeforeShow @6-6295AC75
function Costing_SizeName_BeforeShow(& $sender)
{
    $Costing_SizeName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_SizeName_BeforeShow

//Custom Code @253-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("SizeCode","");
	$Costing->SizeName->SetValue(CCDLookUp("SizeName","tblCollect_Size", "SizeCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_SizeName_BeforeShow @6-7781D5A5
    return $Costing_SizeName_BeforeShow;
}
//End Close Costing_SizeName_BeforeShow

//Costing_ClayCost_BeforeShow @11-50A0632B
function Costing_ClayCost_BeforeShow(& $sender)
{
    $Costing_ClayCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_ClayCost_BeforeShow

//Custom Code @266-2A29BDB7
global $DBGayaFusionAll;
$IDnya = $Costing->ClayType->GetValue();
if($IDnya > 0){
	$ClayPrice = CCDLookUp("PricePerKG", "tblCosting_Clay","ID = $IDnya", $DBGayaFusionAll);
	$ClayKG = $Costing->ClayKG->GetValue();
	$ClayCost = $ClayKG * $ClayPrice;
	$Costing->ClayCost->SetValue($ClayCost);
}
//End Custom Code

//Close Costing_ClayCost_BeforeShow @11-FC909DFB
    return $Costing_ClayCost_BeforeShow;
}
//End Close Costing_ClayCost_BeforeShow

//Costing_ClayPreparationCost_BeforeShow @13-83C987DB
function Costing_ClayPreparationCost_BeforeShow(& $sender)
{
    $Costing_ClayPreparationCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_ClayPreparationCost_BeforeShow

//Custom Code @267-2A29BDB7
$CPcpm = $Costing->ClayPreparationCPM->GetValue();
$CPMinute = $Costing->ClayPreparationMinute->GetValue();
$Costing->ClayPreparationCost->SetValue($CPcpm *  $CPMinute);
//End Custom Code

//Close Costing_ClayPreparationCost_BeforeShow @13-48BB0564
    return $Costing_ClayPreparationCost_BeforeShow;
}
//End Close Costing_ClayPreparationCost_BeforeShow

//Costing_WheelCost_BeforeShow @15-731641A3
function Costing_WheelCost_BeforeShow(& $sender)
{
    $Costing_WheelCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_WheelCost_BeforeShow

//Custom Code @268-2A29BDB7
$WCPm = $Costing->WheelCPM->GetValue();
$WMinute = $Costing->WheelMinute->GetValue();
$Costing->WheelCost->SetValue($WCPm * $WMinute);
//End Custom Code

//Close Costing_WheelCost_BeforeShow @15-4892DF0C
    return $Costing_WheelCost_BeforeShow;
}
//End Close Costing_WheelCost_BeforeShow

//Costing_SlabCost_BeforeShow @17-17F5A90A
function Costing_SlabCost_BeforeShow(& $sender)
{
    $Costing_SlabCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_SlabCost_BeforeShow

//Custom Code @269-2A29BDB7
$Scpm = $Costing->SlabCPM->GetValue();
$Sminute = $Costing->SlabMinute->GetValue();
$Costing->SlabCost->SetValue($Scpm * $Sminute);
//End Custom Code

//Close Costing_SlabCost_BeforeShow @17-6400A061
    return $Costing_SlabCost_BeforeShow;
}
//End Close Costing_SlabCost_BeforeShow

//Costing_CastingCost_BeforeShow @19-72431FBA
function Costing_CastingCost_BeforeShow(& $sender)
{
    $Costing_CastingCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_CastingCost_BeforeShow

//Custom Code @270-2A29BDB7
$cpm = $Costing->CastingCPM->GetValue();
$minute = $Costing->CastingMinute->GetValue();
$Costing->CastingCost->SetValue($cpm*$minute);
//End Custom Code

//Close Costing_CastingCost_BeforeShow @19-AEE90EF2
    return $Costing_CastingCost_BeforeShow;
}
//End Close Costing_CastingCost_BeforeShow

//Costing_FinishingCost_BeforeShow @21-702335E8
function Costing_FinishingCost_BeforeShow(& $sender)
{
    $Costing_FinishingCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_FinishingCost_BeforeShow

//Custom Code @271-2A29BDB7
$cpm = $Costing->FinishingCPM->GetValue();
$minute = $Costing->FinishingMinute->GetValue();
$Costing->FinishingCost->SetValue($cpm*$minute);
//End Custom Code

//Close Costing_FinishingCost_BeforeShow @21-9315A18C
    return $Costing_FinishingCost_BeforeShow;
}
//End Close Costing_FinishingCost_BeforeShow

//Costing_GlazingCost_BeforeShow @23-10E060DC
function Costing_GlazingCost_BeforeShow(& $sender)
{
    $Costing_GlazingCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_GlazingCost_BeforeShow

//Custom Code @272-2A29BDB7
$cpm = $Costing->GlazingCPM->GetValue();
$minute = $Costing->GlazingMinute->GetValue();
$Costing->GlazingCost->SetValue($cpm*$minute);
//End Custom Code

//Close Costing_GlazingCost_BeforeShow @23-081117BD
    return $Costing_GlazingCost_BeforeShow;
}
//End Close Costing_GlazingCost_BeforeShow

//Costing_StandardBisqueCost_BeforeShow @25-3D2F9E65
function Costing_StandardBisqueCost_BeforeShow(& $sender)
{
    $Costing_StandardBisqueCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_StandardBisqueCost_BeforeShow

//Custom Code @273-2A29BDB7
$loading = $Costing->StandardBisqueLoading->GetValue();
if($loading > 0){
	$ClayKG = $Costing->ClayKG->GetValue();
	$FiringPrice = $Costing->StdBisquePerFiring->GetValue();
	$Costing->StandardBisqueCost->SetValue($ClayKG * $FiringPrice);
}
//End Custom Code

//Close Costing_StandardBisqueCost_BeforeShow @25-179DFE04
    return $Costing_StandardBisqueCost_BeforeShow;
}
//End Close Costing_StandardBisqueCost_BeforeShow

//Costing_StandardGlazeCost_BeforeShow @27-70AAF73E
function Costing_StandardGlazeCost_BeforeShow(& $sender)
{
    $Costing_StandardGlazeCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_StandardGlazeCost_BeforeShow

//Custom Code @274-2A29BDB7
$loading = $Costing->StandardGlazeLoading->GetValue();
if($loading > 0){
	$claykg = $Costing->ClayKG->GetValue();
	$firingprice = $Costing->StdGlazePerFiring->GetValue();
	$Costing->StandardGlazeCost->SetValue($claykg * $firingprice);
}
//End Custom Code

//Close Costing_StandardGlazeCost_BeforeShow @27-33BBA699
    return $Costing_StandardGlazeCost_BeforeShow;
}
//End Close Costing_StandardGlazeCost_BeforeShow

//Costing_RakuBisqueCost_BeforeShow @29-F731B1B6
function Costing_RakuBisqueCost_BeforeShow(& $sender)
{
    $Costing_RakuBisqueCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_RakuBisqueCost_BeforeShow

//Custom Code @275-2A29BDB7
$loading = $Costing->RakuBisqueLoading->GetValue();
if($loading > 0){
	$claykg = $Costing->ClayKG->GetValue();
	$firingprice = $Costing->RakuBisquePerFiring->GetValue();
	$Costing->RakuBisqueCost->SetValue($claykg * $firingprice);
}
//End Custom Code

//Close Costing_RakuBisqueCost_BeforeShow @29-2AADA9D1
    return $Costing_RakuBisqueCost_BeforeShow;
}
//End Close Costing_RakuBisqueCost_BeforeShow

//Costing_RakuGlazeCost_BeforeShow @31-6A3CA023
function Costing_RakuGlazeCost_BeforeShow(& $sender)
{
    $Costing_RakuGlazeCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_RakuGlazeCost_BeforeShow

//Custom Code @276-2A29BDB7
$loading = $Costing->RakuGlazeLoading->GetValue();
if($loading > 0){
	$claykg = $Costing->ClayKG->GetValue();
	$firingprice = $Costing->RakuGlazePerFiring->GetValue();
	$Costing->RakuGlazeCost->SetValue($claykg * $firingprice);
}
//End Custom Code

//Close Costing_RakuGlazeCost_BeforeShow @31-DB79A4FC
    return $Costing_RakuGlazeCost_BeforeShow;
}
//End Close Costing_RakuGlazeCost_BeforeShow

//Costing_MovementCost_BeforeShow @33-F9A9484C
function Costing_MovementCost_BeforeShow(& $sender)
{
    $Costing_MovementCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_MovementCost_BeforeShow

//Custom Code @277-2A29BDB7
$cpm = $Costing->MovementCPM->GetValue();
$minute = $Costing->MovementMinute->GetValue();
$Costing->MovementCost->SetValue($cpm * $minute);
//End Custom Code

//Close Costing_MovementCost_BeforeShow @33-ACFF07C6
    return $Costing_MovementCost_BeforeShow;
}
//End Close Costing_MovementCost_BeforeShow

//Costing_PackagingWorkCost_BeforeShow @35-87CB59F3
function Costing_PackagingWorkCost_BeforeShow(& $sender)
{
    $Costing_PackagingWorkCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_PackagingWorkCost_BeforeShow

//Custom Code @278-2A29BDB7
$cpm = $Costing->PackagingCPM->GetValue();
$minute = $Costing->PackagingWorkMinute->GetValue();
$Costing->PackagingWorkCost->SetValue($cpm * $minute);
//End Custom Code

//Close Costing_PackagingWorkCost_BeforeShow @35-743373CD
    return $Costing_PackagingWorkCost_BeforeShow;
}
//End Close Costing_PackagingWorkCost_BeforeShow

//Costing_TotalAllCost_BeforeShow @44-946A2940
function Costing_TotalAllCost_BeforeShow(& $sender)
{
    $Costing_TotalAllCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotalAllCost_BeforeShow

//Custom Code @279-2A29BDB7
$clay = $Costing->ClayCost->GetValue();
$cp = $Costing->ClayPreparationCost->GetValue();
$wheel = $Costing->WheelCost->GetValue();
$slab = $Costing->SlabCost->GetValue();
$casting = $Costing->CastingCost->GetValue();
$finishing = $Costing->FinishingCost->GetValue();
$glazing = $Costing->GlazingCost->GetValue();
$stdbisque = $Costing->StandardBisqueCost->GetValue();
$stdglaze = $Costing->StandardGlazeCost->GetValue();
$rakubisque = $Costing->RakuBisqueCost->GetValue();
$rakuglaze = $Costing->RakuGlazeCost->GetValue();
  $IDna = $Costing->DesignMat1->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$price = $db->f("DesignMatUnitPrice");
		}
		$db->close();
	}
  $qty = $Costing->DesignMatQty1->GetValue();
$dm1 = ($qty * $price);
  $IDna = $Costing->DesignMat2->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$price = $db->f("DesignMatUnitPrice");
		}
		$db->close();
	}
  $qty = $Costing->DesignMatQty2->GetValue();
$dm2 = ($qty * $price);
  $IDna = $Costing->DesignMat3->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$price = $db->f("DesignMatUnitPrice");
		}
		$db->close();
	}
  $qty = $Costing->DesignMatQty3->GetValue();
$dm3 = ($qty * $price);
  $IDna = $Costing->DesignMat4->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$price = $db->f("DesignMatUnitPrice");
		}
		$db->close();
	}
  $qty = $Costing->DesignMatQty4->GetValue();
$dm4 = ($qty * $price);
$movement = $Costing->MovementCost->GetValue();
$packaging = $Costing->PackagingWorkCost->GetValue();
$TotAllCost = ($clay + $cp + $wheel + $slab + $casting + $finishing + $glazing + $stdbisque) ;
$TotAllCost += ($stdglaze + $rakubisque + $rakuglaze + $dm1 + $dm2 + $dm3 + $dm4 + $movement + $packaging);
$Costing->TotalAllCost->SetValue($TotAllCost);
//End Custom Code

//Close Costing_TotalAllCost_BeforeShow @44-4AD2AFD1
    return $Costing_TotalAllCost_BeforeShow;
}
//End Close Costing_TotalAllCost_BeforeShow

//Costing_RiskPrice_BeforeShow @45-7598A8CD
function Costing_RiskPrice_BeforeShow(& $sender)
{
    $Costing_RiskPrice_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_RiskPrice_BeforeShow

//Custom Code @280-2A29BDB7
$TotAllCost = $Costing->TotalAllCost->GetValue();
$RiskPrice = (($TotAllCost * 0.1) + $TotAllCost);
$Costing->RiskPrice->SetValue($RiskPrice);
//End Custom Code

//Close Costing_RiskPrice_BeforeShow @45-515F5D63
    return $Costing_RiskPrice_BeforeShow;
}
//End Close Costing_RiskPrice_BeforeShow

//Costing_HypoSellingPrice_BeforeShow @46-A24276C2
function Costing_HypoSellingPrice_BeforeShow(& $sender)
{
    $Costing_HypoSellingPrice_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_HypoSellingPrice_BeforeShow

//Custom Code @281-2A29BDB7
$risk = $Costing->RiskPrice->GetValue();
$hypo = ($risk * 3);
$Costing->HypoSellingPrice->SetValue($hypo);
//End Custom Code

//Close Costing_HypoSellingPrice_BeforeShow @46-8D63DBB3
    return $Costing_HypoSellingPrice_BeforeShow;
}
//End Close Costing_HypoSellingPrice_BeforeShow

//Costing_ClayPrice_BeforeShow @49-47AF17FC
function Costing_ClayPrice_BeforeShow(& $sender)
{
    $Costing_ClayPrice_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_ClayPrice_BeforeShow

//Custom Code @51-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = $Costing->ClayType->GetValue();
	if($IDnya > 0){
		$Costing->ClayPrice->SetValue(CCDLookUp("PricePerKG", "tblCosting_Clay","ID = $IDnya", $DBGayaFusionAll));
	}
//End Custom Code

//Close Costing_ClayPrice_BeforeShow @49-2F5D1495
    return $Costing_ClayPrice_BeforeShow;
}
//End Close Costing_ClayPrice_BeforeShow

//Costing_DesignMat1_BeforeShow @60-0281A532
function Costing_DesignMat1_BeforeShow(& $sender)
{
    $Costing_DesignMat1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_DesignMat1_BeforeShow

//Custom Code @109-2A29BDB7
$IDna = $Costing->DesignMat1->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tblunit.UnitValue, tbldesignmat.DesignMatDescription, tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$Costing->lblDesignMat1->SetValue($db->f("DesignMatDescription"));
			$Costing->DesignMatUnitPrice1->SetValue($db->f("DesignMatUnitPrice"));
			$Costing->lblUnit1->SetValue($db->f("UnitValue"));
		}
		$db->close();
	}
//End Custom Code

//Close Costing_DesignMat1_BeforeShow @60-4A1A8B5B
    return $Costing_DesignMat1_BeforeShow;
}
//End Close Costing_DesignMat1_BeforeShow

//Costing_DesignMat2_BeforeShow @61-7151A5FD
function Costing_DesignMat2_BeforeShow(& $sender)
{
    $Costing_DesignMat2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_DesignMat2_BeforeShow

//Custom Code @110-2A29BDB7
	$IDna = $Costing->DesignMat2->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tblunit.UnitValue, tbldesignmat.DesignMatDescription, tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$Costing->lblDesignMat2->SetValue($db->f("DesignMatDescription"));
			$Costing->DesignMatUnitPrice2->SetValue($db->f("DesignMatUnitPrice"));
			$Costing->lblUnit2->SetValue($db->f("UnitValue"));
		}
		$db->close();
	}
//End Custom Code

//Close Costing_DesignMat2_BeforeShow @61-367BAE80
    return $Costing_DesignMat2_BeforeShow;
}
//End Close Costing_DesignMat2_BeforeShow

//Costing_DesignMat3_BeforeShow @62-5FE1A5B8
function Costing_DesignMat3_BeforeShow(& $sender)
{
    $Costing_DesignMat3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_DesignMat3_BeforeShow

//Custom Code @111-2A29BDB7
	$IDna = $Costing->DesignMat3->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tblunit.UnitValue, tbldesignmat.DesignMatDescription, tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$Costing->lblDesignMat3->SetValue($db->f("DesignMatDescription"));
			$Costing->DesignMatUnitPrice3->SetValue($db->f("DesignMatUnitPrice"));
			$Costing->lblUnit3->SetValue($db->f("UnitValue"));
		}
		$db->close();
	}
//End Custom Code

//Close Costing_DesignMat3_BeforeShow @62-AB744FF6
    return $Costing_DesignMat3_BeforeShow;
}
//End Close Costing_DesignMat3_BeforeShow

//Costing_DesignMat4_BeforeShow @63-96F1A463
function Costing_DesignMat4_BeforeShow(& $sender)
{
    $Costing_DesignMat4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_DesignMat4_BeforeShow

//Custom Code @112-2A29BDB7
	$IDna = $Costing->DesignMat4->GetValue();
	if($IDna > 0){
		$db = new clsDBGayaFusionAll;
		$sql = "SELECT tblunit.UnitValue, tbldesignmat.DesignMatDescription, tbldesignmat.DesignMatUnitPrice FROM
 				tbldesignmat INNER JOIN tblunit ON (tbldesignmat.DesignMatUnit=tblunit.UnitID) WHERE tblDesignMat.DesignMatID = $IDna";
		$db->query($sql);
		$result = $db->next_record();
		if ($result){
			$Costing->lblDesignMat4->SetValue($db->f("DesignMatDescription"));
			$Costing->DesignMatUnitPrice4->SetValue($db->f("DesignMatUnitPrice"));
			$Costing->lblUnit4->SetValue($db->f("UnitValue"));
		}
		$db->close();
	}
//End Custom Code

//Close Costing_DesignMat4_BeforeShow @63-CEB9E536
    return $Costing_DesignMat4_BeforeShow;
}
//End Close Costing_DesignMat4_BeforeShow

//Costing_lblStdBisque_BeforeShow @72-44ABD605
function Costing_lblStdBisque_BeforeShow(& $sender)
{
    $Costing_lblStdBisque_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_lblStdBisque_BeforeShow

//Custom Code @189-2A29BDB7
	$Loading = $Costing->StandardBisqueLoading->GetValue();
	if(!$Loading == ""){
		$Costnya = $Costing->StandardBisqueCost->GetValue();
		$control = $Costnya * $Loading;
		if($control == 0 or $control < 400000){
			$Costing->StdBisqueColor->SetValue("RED");
		}elseif($control == 400000 or $control < 700000){
			$Costing->StdBisqueColor->SetValue("#FF9966");
		}elseif($control > 700000){
			$Costing->StdBisqueColor->SetValue("GREEN");
		}
		$Costing->lblStdBisque->SetValue($control);
	}
//End Custom Code

//Close Costing_lblStdBisque_BeforeShow @72-954EB6CB
    return $Costing_lblStdBisque_BeforeShow;
}
//End Close Costing_lblStdBisque_BeforeShow

//Costing_lblStdGlaze_BeforeShow @73-0AA19EF2
function Costing_lblStdGlaze_BeforeShow(& $sender)
{
    $Costing_lblStdGlaze_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_lblStdGlaze_BeforeShow

//Custom Code @190-2A29BDB7
	$Loading = $Costing->StandardGlazeLoading->GetValue();
	if(!$Loading == ""){
		$Costnya = $Costing->StandardGlazeCost->GetValue();
		$control = $Costnya * $Loading;
		if(($control == 0) or ($control < 400000)){
			$Costing->StdGlazeColor->SetValue("RED");
		}elseif(($control == 400000) or ($control < 700000)){
			$Costing->StdGlazeColor->SetValue("#FF9966");
		}elseif($control > 700000){
			$Costing->StdGlazeColor->SetValue("GREEN");
		}
		$Costing->lblStdGlaze->SetValue($control);
	}
//End Custom Code

//Close Costing_lblStdGlaze_BeforeShow @73-7D2500C0
    return $Costing_lblStdGlaze_BeforeShow;
}
//End Close Costing_lblStdGlaze_BeforeShow

//Costing_lblRakuBisque_BeforeShow @74-938676B7
function Costing_lblRakuBisque_BeforeShow(& $sender)
{
    $Costing_lblRakuBisque_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_lblRakuBisque_BeforeShow

//Custom Code @191-2A29BDB7
	$Loading = $Costing->RakuBisqueLoading->GetValue();
	if(!$Loading == ""){
		$Costnya = $Costing->RakuBisqueCost->GetValue();
		$control = $Costnya * $Loading;
		if(($control == 0) or ($control < 400000)){
			$Costing->RakuBisqueColor->SetValue("RED");
		}elseif(($control == 400000) or ($control < 700000)){
			$Costing->RakuBisqueColor->SetValue("#FF9966");
		}elseif($control > 700000){
			$Costing->RakuBisqueColor->SetValue("GREEN");
		}
		$Costing->lblRakuBisque->SetValue($control);
	}
//End Custom Code

//Close Costing_lblRakuBisque_BeforeShow @74-DF8CE786
    return $Costing_lblRakuBisque_BeforeShow;
}
//End Close Costing_lblRakuBisque_BeforeShow

//Costing_lblRakuGlaze_BeforeShow @75-93EC0C05
function Costing_lblRakuGlaze_BeforeShow(& $sender)
{
    $Costing_lblRakuGlaze_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_lblRakuGlaze_BeforeShow

//Custom Code @192-2A29BDB7
	$Loading = $Costing->RakuGlazeLoading->GetValue();
	if(!$Loading == ""){
		$Costnya = $Costing->RakuGlazeCost->GetValue();
		$control = $Costnya * $Loading;
		if($control == 0 or $control < 400000){
			$Costing->RakuGlazeColor->SetValue("RED");
		}elseif($control == 400000 or $control < 700000){
			$Costing->RakuGlazeColor->SetValue("#FF9966");
		}elseif($control > 700000){
			$Costing->RakuGlazeColor->SetValue("GREEN");
		}
		$Costing->lblRakuGlaze->SetValue($control);
	}
//End Custom Code

//Close Costing_lblRakuGlaze_BeforeShow @75-60D10CA4
    return $Costing_lblRakuGlaze_BeforeShow;
}
//End Close Costing_lblRakuGlaze_BeforeShow

//Costing_TotDesignMat1_BeforeShow @84-8FF07702
function Costing_TotDesignMat1_BeforeShow(& $sender)
{
    $Costing_TotDesignMat1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotDesignMat1_BeforeShow

//Custom Code @113-2A29BDB7
	$qty = $Costing->DesignMatQty1->GetValue();
	$price = $Costing->DesignMatUnitPrice1->GetValue();
	$hasil = $qty * $price;
	$Costing->TotDesignMat1->SetValue($hasil);
//End Custom Code

//Close Costing_TotDesignMat1_BeforeShow @84-7D0BC27B
    return $Costing_TotDesignMat1_BeforeShow;
}
//End Close Costing_TotDesignMat1_BeforeShow

//Costing_TotDesignMat2_BeforeShow @85-90A06B11
function Costing_TotDesignMat2_BeforeShow(& $sender)
{
    $Costing_TotDesignMat2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotDesignMat2_BeforeShow

//Custom Code @114-2A29BDB7
	$qty = $Costing->DesignMatQty2->GetValue();
	$price = $Costing->DesignMatUnitPrice2->GetValue();
	$hasil = $qty * $price;
	$Costing->TotDesignMat2->SetValue($hasil);
//End Custom Code

//Close Costing_TotDesignMat2_BeforeShow @85-016AE7A0
    return $Costing_TotDesignMat2_BeforeShow;
}
//End Close Costing_TotDesignMat2_BeforeShow

//Costing_TotDesignMat3_BeforeShow @86-2CBF62DF
function Costing_TotDesignMat3_BeforeShow(& $sender)
{
    $Costing_TotDesignMat3_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotDesignMat3_BeforeShow

//Custom Code @115-2A29BDB7
	$qty = $Costing->DesignMatQty3->GetValue();
	$price = $Costing->DesignMatUnitPrice3->GetValue();
	$hasil = $qty * $price;
	$Costing->TotDesignMat3->SetValue($hasil);
//End Custom Code

//Close Costing_TotDesignMat3_BeforeShow @86-9C6506D6
    return $Costing_TotDesignMat3_BeforeShow;
}
//End Close Costing_TotDesignMat3_BeforeShow

//Costing_TotDesignMat4_BeforeShow @87-AE005337
function Costing_TotDesignMat4_BeforeShow(& $sender)
{
    $Costing_TotDesignMat4_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotDesignMat4_BeforeShow

//Custom Code @116-2A29BDB7
	$qty = $Costing->DesignMatQty4->GetValue();
	$price = $Costing->DesignMatUnitPrice4->GetValue();
	$hasil = $qty * $price;
	$Costing->TotDesignMat4->SetValue($hasil);
//End Custom Code

//Close Costing_TotDesignMat4_BeforeShow @87-F9A8AC16
    return $Costing_TotDesignMat4_BeforeShow;
}
//End Close Costing_TotDesignMat4_BeforeShow

//Costing_TotAllPieces_BeforeShow @88-C10F46E2
function Costing_TotAllPieces_BeforeShow(& $sender)
{
    $Costing_TotAllPieces_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TotAllPieces_BeforeShow

//Custom Code @282-2A29BDB7
$TotAllCost = $Costing->TotalAllCost->GetValue();
$RiskPrice = (($TotAllCost * 0.1) + $TotAllCost);
$TotPiecesWorker = $Costing->TotPiecesWorker->GetValue();
$TotAllPieces = $RiskPrice * $TotPiecesWorker;
$Costing->TotAllPieces->SetValue($TotAllPieces);
//End Custom Code

//Close Costing_TotAllPieces_BeforeShow @88-72F5E06D
    return $Costing_TotAllPieces_BeforeShow;
}
//End Close Costing_TotAllPieces_BeforeShow

//Costing_NameDesc_BeforeShow @195-CFA02ACD
function Costing_NameDesc_BeforeShow(& $sender)
{
    $Costing_NameDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_NameDesc_BeforeShow

//Custom Code @251-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("NameCode","");
	$Costing->NameDesc->SetValue(CCDLookUp("NameDesc","tblCollect_Name", "NameCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_NameDesc_BeforeShow @195-E7DD70BB
    return $Costing_NameDesc_BeforeShow;
}
//End Close Costing_NameDesc_BeforeShow

//Costing_CategoryName_BeforeShow @197-EA1DBF7A
function Costing_CategoryName_BeforeShow(& $sender)
{
    $Costing_CategoryName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_CategoryName_BeforeShow

//Custom Code @252-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("CategoryCode","");
	$Costing->CategoryName->SetValue(CCDLookUp("CategoryName","tblCollect_Category", "CategoryCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_CategoryName_BeforeShow @197-921A06FA
    return $Costing_CategoryName_BeforeShow;
}
//End Close Costing_CategoryName_BeforeShow

//Costing_TextureName_BeforeShow @200-9B72C1B8
function Costing_TextureName_BeforeShow(& $sender)
{
    $Costing_TextureName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_TextureName_BeforeShow

//Custom Code @254-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("TextureCode","");
	$Costing->TextureName->SetValue(CCDLookUp("TextureName","tblCollect_Texture", "TextureCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_TextureName_BeforeShow @200-C5C2B5D2
    return $Costing_TextureName_BeforeShow;
}
//End Close Costing_TextureName_BeforeShow

//Costing_ColorName_BeforeShow @202-3B6FEF96
function Costing_ColorName_BeforeShow(& $sender)
{
    $Costing_ColorName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_ColorName_BeforeShow

//Custom Code @255-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("ColorCode","");
	$Costing->ColorName->SetValue(CCDLookUp("ColorName","tblCollect_Color", "ColorCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_ColorName_BeforeShow @202-0694379D
    return $Costing_ColorName_BeforeShow;
}
//End Close Costing_ColorName_BeforeShow

//Costing_MaterialName_BeforeShow @204-3BB6E106
function Costing_MaterialName_BeforeShow(& $sender)
{
    $Costing_MaterialName_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_MaterialName_BeforeShow

//Custom Code @256-2A29BDB7
	global $DBGayaFusionAll;
	$IDnya = CCGetFromGet("MaterialCode","");
	$Costing->MaterialName->SetValue(CCDLookUp("MaterialName","tblCollect_Material", "MaterialCode = ".$DBGayaFusionAll->ToSQL($IDnya,ccsString),$DBGayaFusionAll));
//End Custom Code

//Close Costing_MaterialName_BeforeShow @204-ED6371AB
    return $Costing_MaterialName_BeforeShow;
}
//End Close Costing_MaterialName_BeforeShow

//Costing_LastUpdate_BeforeShow @283-BE63DEE6
function Costing_LastUpdate_BeforeShow(& $sender)
{
    $Costing_LastUpdate_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_LastUpdate_BeforeShow

//Custom Code @293-2A29BDB7
//$lup = date('d/m/Y');
//$Costing->LastUpdate->SetValue($lup);
//End Custom Code

//Close Costing_LastUpdate_BeforeShow @283-47DB012A
    return $Costing_LastUpdate_BeforeShow;
}
//End Close Costing_LastUpdate_BeforeShow


//Costing_BeforeShow @2-B9A83B48
function Costing_BeforeShow(& $sender)
{
    $Costing_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_BeforeShow

//Custom Code @50-2A29BDB7
	$db = new clsDBGayaFusionAll;
	
	$sql = "SELECT tblCosting_Casting.CostPerMinute as CastingCPM,tblcosting_claypreparation.CostPerMinute as ClayPrepCPM,tblcosting_costbudgetpreview.BudgetYear as BudgetYear,tblcosting_costbudgetpreview.CostBudgetAmmount as CostBudget,tblcosting_rakubisque.PricePerFiring as RakuBisquePPF,tblcosting_wheel.CostPerMinute as WheelCPM,tblcosting_standardbisque.PricePerFiring as StdBisquePPF,tblcosting_standardglaze.PricePerFiring as StdGlazePPF,tblcosting_packagingwork.CostPerMinute as PackWorkCPM,tblcosting_movement.CostPerMinute as MovementCPM,tblcosting_glazing.CostPerMinute as GlazingCPM,tblcosting_finishing.CostPerMinute as FinishingCPM,tblcosting_rakuglaze.PricePerFiring as RakuGlazePPF,tblcosting_trowworker.TrowWorker as TrowWorker,tblcosting_slab.CostPerMinute as SlabCPM,tblcosting_productivehours.`Day` AS ProdDay,tblcosting_productivehours.`Month` AS ProdMonth,tblcosting_productivehours.`Year` AS ProdYear, tblCosting_costbudgetpreview.budgetyear as BudgetYear, tblcosting_costbudgetpreview.costbudgetammount as CostBudgetAmmount 
	FROM tblcosting_casting,tblcosting_claypreparation,tblcosting_costbudgetpreview,tblcosting_rakubisque,tblcosting_wheel,tblcosting_standardbisque,tblcosting_standardglaze,tblcosting_packagingwork,tblcosting_movement,tblcosting_glazing,tblcosting_finishing,tblcosting_rakuglaze,tblcosting_trowworker,tblcosting_slab,tblcosting_productivehours";
  	$db->query($sql);
	$result = $db->next_record();
	if($result){
  	$Costing->ClayPreparationCPM->SetValue($db->f("ClayPrepCPM"));
  	$Costing->WheelCPM->SetValue($db->f("WheelCPM"));
	$Costing->SlabCPM->SetValue($db->f("SlabCPM"));
	$Costing->CastingCPM->SetValue($db->f("CastingCPM"));
	$Costing->FinishingCPM->SetValue($db->f("FinishingCPM"));
	$Costing->GlazingCPM->SetValue($db->f("GlazingCPM"));
	$Costing->StdBisquePerFiring->SetValue($db->f("StdBisquePPF"));
	$Costing->StdGlazePerFiring->SetValue($db->f("StdGlazePPF"));
	$Costing->RakuBisquePerFiring->SetValue($db->f("RakuBisquePPF"));
	$Costing->RakuGlazePerFiring->SetValue($db->f("RakuGlazePPF"));
	$Costing->MovementCPM->SetValue($db->f("MovementCPM"));
	$Costing->PackagingCPM->SetValue($db->f("PackWorkCPM"));
	$Costing->Day->SetValue($db->f("ProdDay"));
	$Costing->Month->SetValue($db->f("ProdMonth"));
	$Costing->Year->SetValue($db->f("ProdYear"));
	$Costing->Worker->SetValue($db->f("TrowWorker"));
	$Costing->lblYear->SetValue($db->f("BudgetYear"));
	$Costing->lblYear1->SetValue($db->f("BudgetYear"));
	$Costing->CostBudget->SetValue($db->f("CostBudgetAmmount"));
	}
	$db->close();
	$WheelPPH = $Costing->WheelPPH->GetValue();
	if($WheelPPH > 0){
		$Costing->WheelPPH1->SetValue($WheelPPH);
		$Day = $Costing->Day->GetValue();
		$Month = $Costing->Month->GetValue();
		$Year = $Costing->Year->GetValue();
		$Worker = $Costing->Worker->GetValue();
		$TotPiecesDay = $WheelPPH * $Day;
		$TotPiecesMonth = $TotPiecesDay * $Month;
		$TotPiecesYear = $TotPiecesMonth * $Year;
		$TotPiecesWorker= $TotPiecesYear * $Worker;
		$RiskPrice = $Costing->RiskPrice->GetValue();
		$CostBudget = $Costing->CostBudget->GetValue();
		$TotAllPieces = $RiskPrice * $TotPiecesWorker;
		$BEP = $CostBudget / $TotPiecesWorker;
		$Costing->TotPiecesDay->SetValue($TotPiecesDay);
		$Costing->TotPiecesMonth->SetValue($TotPiecesMonth);
		$Costing->TotPiecesYear->SetValue($TotPiecesYear);
		$Costing->TotPiecesWorker->SetValue($TotPiecesWorker);
		$Costing->TotAllPieces->SetValue($TotAllPieces);
		$Costing->BEP->SetValue($BEP);
	}

//End Custom Code

//Close Costing_BeforeShow @2-9D83F81E
    return $Costing_BeforeShow;
}
//End Close Costing_BeforeShow

//Costing_BeforeUpdate @2-75380AEB
function Costing_BeforeUpdate(& $sender)
{
    $Costing_BeforeUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Costing; //Compatibility
//End Costing_BeforeUpdate

//Custom Code @292-2A29BDB7
global $DBGayaFusionAll;
$LastUpdate = $Costing->LastUpdate->GetValue();
$ID = $Costing->ID->GetValue();
$sql = "UPDATE tblCollect_Master SET LastUpdate = $LastUpdate WHERE ID = $ID";
$DBGayaFusionAll->query($sql);
//End Custom Code

//Close Costing_BeforeUpdate @2-F283DB58
    return $Costing_BeforeUpdate;
}
//End Close Costing_BeforeUpdate
?>