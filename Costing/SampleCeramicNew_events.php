<?php
//BindEvents Method @1-8604C2FF
function BindEvents()
{
    global $sampleceramicGrid;
    $sampleceramicGrid->TotalRecord->CCSEvents["BeforeShow"] = "sampleceramicGrid_TotalRecord_BeforeShow";
    $sampleceramicGrid->CCSEvents["BeforeShow"] = "sampleceramicGrid_BeforeShow";
    $sampleceramicGrid->CCSEvents["BeforeShowRow"] = "sampleceramicGrid_BeforeShowRow";
}
//End BindEvents Method

//sampleceramicGrid_TotalRecord_BeforeShow @3-AAADD3EE
function sampleceramicGrid_TotalRecord_BeforeShow(& $sender)
{
    $sampleceramicGrid_TotalRecord_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramicGrid; //Compatibility
//End sampleceramicGrid_TotalRecord_BeforeShow

//Retrieve number of records @4-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close sampleceramicGrid_TotalRecord_BeforeShow @3-5CB5F081
    return $sampleceramicGrid_TotalRecord_BeforeShow;
}
//End Close sampleceramicGrid_TotalRecord_BeforeShow

//sampleceramicGrid_BeforeShow @2-0638F456
function sampleceramicGrid_BeforeShow(& $sender)
{
    $sampleceramicGrid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramicGrid; //Compatibility
//End sampleceramicGrid_BeforeShow

//Custom Code @42-2A29BDB7
$db = new clsDBGayaFusionAll;
$sql = "SELECT tblcosting_rakubisque.PricePerFiring as RakuBisquePPF,tblcosting_standardbisque.PricePerFiring as StdBisquePPF,tblcosting_standardglaze.PricePerFiring as StdGlazePPF,tblcosting_rakuglaze.PricePerFiring as RakuGlazePPF 
	FROM tblcosting_rakubisque,tblcosting_standardbisque,tblcosting_standardglaze,tblcosting_rakuglaze ";
$db->query($sql);
$result = $db->next_record();
if($result){
  $sampleceramicGrid->StdBisquePerFiring->SetValue($db->f("StdBisquePPF"));
  $sampleceramicGrid->StdGlazePerFiring->SetValue($db->f("StdGlazePPF"));
  $sampleceramicGrid->RakuBisquePerFiring->SetValue($db->f("RakuBisquePPF"));
  $sampleceramicGrid->RakuGlazePerFiring->SetValue($db->f("RakuGlazePPF"));
}
$db->close();
//End Custom Code

//Close sampleceramicGrid_BeforeShow @2-EC2E4B80
    return $sampleceramicGrid_BeforeShow;
}
//End Close sampleceramicGrid_BeforeShow

//sampleceramicGrid_BeforeShowRow @2-60798FE5
function sampleceramicGrid_BeforeShowRow(& $sender)
{
    $sampleceramicGrid_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramicGrid; //Compatibility
//End sampleceramicGrid_BeforeShowRow

//Custom Code @43-2A29BDB7
global $DBGayaFusionAll;
$SID = $sampleceramicGrid->sID->GetValue();
$dm1 = $sampleceramicGrid->DesignMat1->GetValue();
$dm2 = $sampleceramicGrid->DesignMat2->GetValue();
$dm3 = $sampleceramicGrid->DesignMat3->GetValue();
$dm4 = $sampleceramicGrid->DesignMat4->GetValue();
$QtyDesignMat1 = $sampleceramicGrid->DesignMatQty1->GetValue();
$QtyDesignMat2 = $sampleceramicGrid->DesignMatQty2->GetValue();
$QtyDesignMat3 = $sampleceramicGrid->DesignMatQty3->GetValue();
$QtyDesignMat4 = $sampleceramicGrid->DesignMatQty4->GetValue();
$dmPrice1 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm1,ccsInteger), $DBGayaFusionAll);
$dmPrice2 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm2,ccsInteger), $DBGayaFusionAll);
$dmPrice3 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm3,ccsInteger), $DBGayaFusionAll);
$dmPrice4 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm4,ccsInteger), $DBGayaFusionAll);
$TotDM1 = $QtyDesignMat1 * $dmPrice1;
$TotDM2 = $QtyDesignMat2 * $dmPrice2;
$TotDM3 = $QtyDesignMat3 * $dmPrice3;
$TotDM4 = $QtyDesignMat4 * $dmPrice4;
$ClayKG = $sampleceramicGrid->ClayKG->GetValue();
if($sampleceramicGrid->StdBisqueLoading->GetValue() > 0){
  $StdBisqCost = $ClayKG * $sampleceramicGrid->StdBisquePerFiring->GetValue();
} else {
($StdBisqCost = 0);
}
if($sampleceramicGrid->StdGlazeLoading->GetValue() > 0){
  $StdGlazeCost = $ClayKG * $sampleceramicGrid->StdGlazePerFiring->GetValue();
} else {
  $StdGlazeCost = 0;
}
if($sampleceramicGrid->RakuBisqueLoading->GetValue() > 0) {
  $RakuBisqCost = $ClayKG * $sampleceramicGrid->RakuBisquePerFiring->GetValue();
} else {
  $RakuBisqCost = 0;
}
if($sampleceramicGrid->RakuGlazeLoading->GetValue() > 0) {
  $RakuGlazeCost = $ClayKG * $sampleceramicGrid->RakuGlazePerFiring->GetValue() ;
} else {
  $RakuGlazeCost = 0;
}
$Total = $sampleceramicGrid->ClayCost->GetValue() + $sampleceramicGrid->ClayPreparationCost->GetValue();
$Total += $sampleceramicGrid->WheelCost->GetValue() + $sampleceramicGrid->SlabCost->GetValue() + $sampleceramicGrid->CastingCost->GetValue();
$Total += $sampleceramicGrid->FinishingCost->GetValue() + $sampleceramicGrid->GlazingCost->GetValue() + $StdBisqCost + $StdGlazeCost + $RakuBisqCost + $RakuGlazeCost ;
$Total += $TotDM1 + $TotDM2 + $TotDM3 + $TotDM4 + $sampleceramicGrid->MovementCost->GetValue() + $sampleceramicGrid->PackagingWorkCost->GetValue();

$Total = $Total + ($Total * 0.1) ;
$sampleceramicGrid->RiskPrice->SetValue($Total);
$RealPrice = CCDLookUp("RealSellingPrice", "sampleCeramic","sID = ".$DBGayaFusionAll->ToSQL($SID, ccsInteger), $DBGayaFusionAll);
if($RealPrice < $Total){
  $sampleceramicGrid->RealPriceColor->SetValue("RED");
}elseif($RealPrice == $Total){
  $sampleceramicGrid->RealPriceColor->SetValue("BLACK");
}else{
  $sampleceramicGrid->RealPriceColor->SetValue("GREEN");
}

//End Custom Code

//Close sampleceramicGrid_BeforeShowRow @2-FCA54F3B
    return $sampleceramicGrid_BeforeShowRow;
}
//End Close sampleceramicGrid_BeforeShowRow


?>
