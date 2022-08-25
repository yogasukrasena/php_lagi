<?php
//BindEvents Method @1-1C3BD879
function BindEvents()
{
    global $sampleceramicGrid;
    global $Panel1;
    global $CCSEvents;
    $sampleceramicGrid->TotalRecord->CCSEvents["BeforeShow"] = "sampleceramicGrid_TotalRecord_BeforeShow";
    $sampleceramicGrid->CCSEvents["BeforeShow"] = "sampleceramicGrid_BeforeShow";
    $sampleceramicGrid->CCSEvents["BeforeShowRow"] = "sampleceramicGrid_BeforeShowRow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//sampleceramicGrid_TotalRecord_BeforeShow @30-AAADD3EE
function sampleceramicGrid_TotalRecord_BeforeShow(& $sender)
{
    $sampleceramicGrid_TotalRecord_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $sampleceramicGrid; //Compatibility
//End sampleceramicGrid_TotalRecord_BeforeShow

//Retrieve number of records @31-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close sampleceramicGrid_TotalRecord_BeforeShow @30-5CB5F081
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

//Custom Code @87-2A29BDB7
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

//Custom Code @160-2A29BDB7
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

//Panel1_BeforeShow @40-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @76-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @40-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-8F60E7F7
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SampleCeramic; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @76-B4F71FC5
    if (CCGetFromGet("FormFilter") == "Panel1" && CCGetFromGet("IsParamsEncoded") != "true") {
        global $TemplateEncoding, $CCSIsParamsEncoded;
        CCConvertDataArrays("UTF-8", $TemplateEncoding);
        $CCSIsParamsEncoded = true;
    }
//End Panel1UpdatePanel PageBeforeInitialize

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

//Page_AfterInitialize @1-97D6DE74
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SampleCeramic; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-7BBE7912
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SampleCeramic; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @76-9F5F0EA1
    global $CCSFormFilter;
    if (CCGetFromGet("FormFilter") == "Panel1") {
        $CCSFormFilter = CCGetFromGet("FormFilter");
        unset($_GET["FormFilter"]);
        if (isset($_GET["IsParamsEncoded"])) unset($_GET["IsParamsEncoded"]);
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Page_BeforeShow @1-4BC230CD
    return $Page_BeforeShow;
}
//End Close Page_BeforeShow

//Page_BeforeOutput @1-12435C14
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SampleCeramic; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @76-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-2338AC02
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $SampleCeramic; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @76-483BFCB6
    global $Redirect, $CCSFormFilter, $CCSIsParamsEncoded;
    if ($Redirect && $CCSFormFilter == "Panel1") {
        if ($CCSIsParamsEncoded) $Redirect = CCAddParam($Redirect, "IsParamsEncoded", "true");
        $Redirect = CCAddParam($Redirect, "FormFilter", $CCSFormFilter);
    }
//End Panel1UpdatePanel PageBeforeUnload

//Close Page_BeforeUnload @1-CFAEC742
    return $Page_BeforeUnload;
}
//End Close Page_BeforeUnload


?>
