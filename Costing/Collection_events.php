<?php
//BindEvents Method @1-69662362
function BindEvents()
{
    global $GridCollection;
    global $Panel1;
    global $CCSEvents;
    $GridCollection->tblcollect_category_tblco1_TotalRecords->CCSEvents["BeforeShow"] = "GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow";
    $GridCollection->CCSEvents["BeforeShow"] = "GridCollection_BeforeShow";
    $GridCollection->CCSEvents["BeforeShowRow"] = "GridCollection_BeforeShowRow";
    $Panel1->CCSEvents["BeforeShow"] = "Panel1_BeforeShow";
    $CCSEvents["AfterInitialize"] = "Page_AfterInitialize";
    $CCSEvents["BeforeShow"] = "Page_BeforeShow";
    $CCSEvents["BeforeOutput"] = "Page_BeforeOutput";
    $CCSEvents["BeforeUnload"] = "Page_BeforeUnload";
}
//End BindEvents Method

//GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-A8013ABB
function GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow(& $sender)
{
    $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

//Retrieve number of records @29-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow @28-F5257CAF
    return $GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow;
}
//End Close GridCollection_tblcollect_category_tblco1_TotalRecords_BeforeShow

//GridCollection_BeforeShow @2-44C2F77F
function GridCollection_BeforeShow(& $sender)
{
    $GridCollection_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_BeforeShow

//Custom Code @247-2A29BDB7
$db = new clsDBGayaFusionAll;
$sql = "SELECT tblcosting_rakubisque.PricePerFiring as RakuBisquePPF,tblcosting_standardbisque.PricePerFiring as StdBisquePPF,tblcosting_standardglaze.PricePerFiring as StdGlazePPF,tblcosting_rakuglaze.PricePerFiring as RakuGlazePPF 
	FROM tblcosting_rakubisque,tblcosting_standardbisque,tblcosting_standardglaze,tblcosting_rakuglaze ";
$db->query($sql);
$result = $db->next_record();
if($result){
  $GridCollection->StdBisquePerFiring->SetValue($db->f("StdBisquePPF"));
  $GridCollection->StdGlazePerFiring->SetValue($db->f("StdGlazePPF"));
  $GridCollection->RakuBisquePerFiring->SetValue($db->f("RakuBisquePPF"));
  $GridCollection->RakuGlazePerFiring->SetValue($db->f("RakuGlazePPF"));
}
$db->close();
//End Custom Code

//Close GridCollection_BeforeShow @2-BABBC657
    return $GridCollection_BeforeShow;
}
//End Close GridCollection_BeforeShow

//GridCollection_BeforeShowRow @2-C952A723
function GridCollection_BeforeShowRow(& $sender)
{
    $GridCollection_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $GridCollection; //Compatibility
//End GridCollection_BeforeShowRow

//Custom Code @248-2A29BDB7
global $DBGayaFusionAll;
$ID = $GridCollection->ID->GetValue();
$dm1 = $GridCollection->DesignMat1->GetValue();
$dm2 = $GridCollection->DesignMat2->GetValue();
$dm3 = $GridCollection->DesignMat3->GetValue();
$dm4 = $GridCollection->DesignMat4->GetValue();
$QtyDesignMat1 = $GridCollection->DesignMatQty1->GetValue();
$QtyDesignMat2 = $GridCollection->DesignMatQty2->GetValue();
$QtyDesignMat3 = $GridCollection->DesignMatQty3->GetValue();
$QtyDesignMat4 = $GridCollection->DesignMatQty4->GetValue();
$dmPrice1 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm1,ccsInteger), $DBGayaFusionAll);
$dmPrice2 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm2,ccsInteger), $DBGayaFusionAll);
$dmPrice3 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm3,ccsInteger), $DBGayaFusionAll);
$dmPrice4 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm4,ccsInteger), $DBGayaFusionAll);
$TotDM1 = $QtyDesignMat1 * $dmPrice1;
$TotDM2 = $QtyDesignMat2 * $dmPrice2;
$TotDM3 = $QtyDesignMat3 * $dmPrice3;
$TotDM4 = $QtyDesignMat4 * $dmPrice4;
$ClayKG = $GridCollection->ClayKG->GetValue();
if($GridCollection->StdBisqueLoading->GetValue() > 0){
  $StdBisqCost = $ClayKG * $GridCollection->StdBisquePerFiring->GetValue();
} else {
($StdBisqCost = 0);
}
if($GridCollection->StdGlazeLoading->GetValue() > 0){
  $StdGlazeCost = $ClayKG * $GridCollection->StdGlazePerFiring->GetValue();
} else {
  $StdGlazeCost = 0;
}
if($GridCollection->RakuBisqueLoading->GetValue() > 0) {
  $RakuBisqCost = $ClayKG * $GridCollection->RakuBisquePerFiring->GetValue();
} else {
  $RakuBisqCost = 0;
}
if($GridCollection->RakuGlazeLoading->GetValue() > 0) {
  $RakuGlazeCost = $ClayKG * $GridCollection->RakuGlazePerFiring->GetValue() ;
} else {
  $RakuGlazeCost = 0;
}
$Total = $GridCollection->ClayCost->GetValue() + $GridCollection->ClayPreparationCost->GetValue();
$Total += $GridCollection->WheelCost->GetValue() + $GridCollection->SlabCost->GetValue() + $GridCollection->CastingCost->GetValue();
$Total += $GridCollection->FinishingCost->GetValue() + $GridCollection->GlazingCost->GetValue() + $StdBisqCost + $StdGlazeCost + $RakuBisqCost + $RakuGlazeCost ;
$Total += $TotDM1 + $TotDM2 + $TotDM3 + $TotDM4 + $GridCollection->MovementCost->GetValue() + $GridCollection->PackagingWorkCost->GetValue();

$Total = $Total + ($Total * 0.1) ;
$GridCollection->RiskPrice->SetValue($Total);
$RealPrice = CCDLookUp("RealSellingPrice", "tblCollect_Master","ID = ".$DBGayaFusionAll->ToSQL($ID, ccsInteger), $DBGayaFusionAll);
if($RealPrice < $Total){
  $GridCollection->RealPriceColor->SetValue("RED");
}elseif($RealPrice == $Total){
  $GridCollection->RealPriceColor->SetValue("BLACK");
}else{
  $GridCollection->RealPriceColor->SetValue("GREEN");
}
//End Custom Code

//Close GridCollection_BeforeShowRow @2-7A2BED15
    return $GridCollection_BeforeShowRow;
}
//End Close GridCollection_BeforeShowRow

//DEL  

//DEL  	

//Panel1_BeforeShow @58-AAD8AF72
function Panel1_BeforeShow(& $sender)
{
    $Panel1_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Panel1; //Compatibility
//End Panel1_BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-546243CA
    global $CCSFormFilter;
    if ($CCSFormFilter == "Panel1") {
        $Component->BlockPrefix = "";
        $Component->BlockSuffix = "";
    } else {
        $Component->BlockPrefix = "<div id=\"Panel1\">";
        $Component->BlockSuffix = "</div>";
    }
//End Panel1UpdatePanel Page BeforeShow

//Close Panel1_BeforeShow @58-D21EBA68
    return $Panel1_BeforeShow;
}
//End Close Panel1_BeforeShow

//Page_BeforeInitialize @1-21DBB6BA
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeInitialize

//Panel1UpdatePanel PageBeforeInitialize @115-B4F71FC5
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

//Page_AfterInitialize @1-AEBF9C9D
function Page_AfterInitialize(& $sender)
{
    $Page_AfterInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_AfterInitialize

//Close Page_AfterInitialize @1-379D319D
    return $Page_AfterInitialize;
}
//End Close Page_AfterInitialize

//Page_BeforeShow @1-8FB0AA00
function Page_BeforeShow(& $sender)
{
    $Page_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeShow

//Panel1UpdatePanel Page BeforeShow @115-9F5F0EA1
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

//Page_BeforeOutput @1-385B106D
function Page_BeforeOutput(& $sender)
{
    $Page_BeforeOutput = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeOutput

//Panel1UpdatePanel PageBeforeOutput @115-69FFB31D
    global $CCSFormFilter, $Tpl, $main_block;
    if ($CCSFormFilter == "Panel1") {
        $main_block = $Tpl->getvar("/Panel Panel1");
    }
//End Panel1UpdatePanel PageBeforeOutput

//Close Page_BeforeOutput @1-8964C188
    return $Page_BeforeOutput;
}
//End Close Page_BeforeOutput

//Page_BeforeUnload @1-3D78200B
function Page_BeforeUnload(& $sender)
{
    $Page_BeforeUnload = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Collection; //Compatibility
//End Page_BeforeUnload

//Panel1UpdatePanel PageBeforeUnload @115-483BFCB6
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
