<?php
//BindEvents Method @1-3530DF64
function BindEvents()
{
    global $samplepackaging;
    $samplepackaging->CCSEvents["BeforeShowRow"] = "samplepackaging_BeforeShowRow";
}
//End BindEvents Method

//samplepackaging_BeforeShowRow @2-A9F35B93
function samplepackaging_BeforeShowRow(& $sender)
{
    $samplepackaging_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $samplepackaging; //Compatibility
//End samplepackaging_BeforeShowRow

//Custom Code @56-2A29BDB7
global $DBGayaFusionAll;
$dm1 = $samplepackaging->DesMat1->GetValue();
$dm2 = $samplepackaging->DesMat2->GetValue();
$dm3 = $samplepackaging->DesMat3->GetValue();
$dm4 = $samplepackaging->DesMat4->GetValue();
$dm5 = $samplepackaging->DesMat5->GetValue();
$dmPrice1 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm1, ccsInteger), $DBGayaFusionAll);
$dmPrice2 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm2, ccsInteger), $DBGayaFusionAll);
$dmPrice3 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm3, ccsInteger), $DBGayaFusionAll);
$dmPrice4 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm4, ccsInteger), $DBGayaFusionAll);
$dmPrice5 = CCDLookUp("DesignMatUnitPrice","tblDesignMat","DesignMatID = ".$DBGayaFusionAll->ToSQL($dm5, ccsInteger), $DBGayaFusionAll);
$TotDM1 = $samplepackaging->QtyDesMat1->GetValue() * $dmPrice1;
$TotDM2 = $samplepackaging->QtyDesMat2->GetValue() * $dmPrice2;
$TotDM3 = $samplepackaging->QtyDesMat3->GetValue() * $dmPrice3;
$TotDM4 = $samplepackaging->QtyDesMat4->GetValue() * $dmPrice4;
$TotDM5 = $samplepackaging->QtyDesMat5->GetValue() * $dmPrice5;
$TotCostPrice = $samplepackaging->TotalCostPrice->GetValue();
$TotCost= $TotCostPrice + $TotDM1 + $TotDM2 + $TotDM3 + $TotDM4 + $TotDM5;
$samplepackaging->TotalCost->SetValue($TotCost);
//End Custom Code

//Close samplepackaging_BeforeShowRow @2-6C899E10
    return $samplepackaging_BeforeShowRow;
}
//End Close samplepackaging_BeforeShowRow


?>
