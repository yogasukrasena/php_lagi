<?php
//BindEvents Method @1-E471C113
function BindEvents()
{
    global $Grid;
    global $Report_Print;
    $Grid->lblCurrency->CCSEvents["BeforeShow"] = "Grid_lblCurrency_BeforeShow";
    $Grid->lblProforma->CCSEvents["BeforeShow"] = "Grid_lblProforma_BeforeShow";
    $Grid->Navigator->CCSEvents["BeforeShow"] = "Grid_Navigator_BeforeShow";
    $Report_Print->CCSEvents["BeforeShow"] = "Report_Print_BeforeShow";
}
//End BindEvents Method

//Grid_lblCurrency_BeforeShow @108-8164FF6D
function Grid_lblCurrency_BeforeShow(& $sender)
{
    $Grid_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblCurrency_BeforeShow

//Custom Code @118-2A29BDB7
global $DBGayaFusionAll;
$CurrencyID = $Grid->Currency->GetValue();
$Grid->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblCurrency_BeforeShow @108-09E85BAB
    return $Grid_lblCurrency_BeforeShow;
}
//End Close Grid_lblCurrency_BeforeShow

//Grid_lblProforma_BeforeShow @106-14C7A391
function Grid_lblProforma_BeforeShow(& $sender)
{
    $Grid_lblProforma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblProforma_BeforeShow

//Custom Code @138-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = $Grid->proforma_h_id->GetValue();
$Grid->lblProforma->SetValue(CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID=".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblProforma_BeforeShow @106-1285453C
    return $Grid_lblProforma_BeforeShow;
}
//End Close Grid_lblProforma_BeforeShow

//Grid_Navigator_BeforeShow @65-2E240DB6
function Grid_Navigator_BeforeShow(& $sender)
{
    $Grid_Navigator_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_Navigator_BeforeShow

//Hide-Show Component @66-286333C6
    $Parameter1 = $Container->TotalPages;
    $Parameter2 = 2;
    if (((is_array($Parameter1) || strlen($Parameter1)) && (is_array($Parameter2) || strlen($Parameter2))) && 0 >  CCCompareValues($Parameter1, $Parameter2, ccsInteger))
        $Component->Visible = false;
//End Hide-Show Component

//Close Grid_Navigator_BeforeShow @65-902DB2F3
    return $Grid_Navigator_BeforeShow;
}
//End Close Grid_Navigator_BeforeShow

//Report_Print_BeforeShow @46-6CD7E3F9
function Report_Print_BeforeShow(& $sender)
{
    $Report_Print_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Report_Print; //Compatibility
//End Report_Print_BeforeShow

//Hide-Show Component @48-286F3E6C
    $Parameter1 = CCGetFromGet("ViewMode", "");
    $Parameter2 = "Print";
    if (0 == CCCompareValues($Parameter1, $Parameter2, ccsText))
        $Component->Visible = false;
//End Hide-Show Component

//Close Report_Print_BeforeShow @46-0DD1CC60
    return $Report_Print_BeforeShow;
}
//End Close Report_Print_BeforeShow


?>
