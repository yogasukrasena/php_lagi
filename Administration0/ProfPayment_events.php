<?php
//BindEvents Method @1-3D309DA4
function BindEvents()
{
    global $Grid;
    $Grid->ar_proforma_pay_proforma_TotalRecords->CCSEvents["BeforeShow"] = "Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow";
    $Grid->lnkProforma->CCSEvents["BeforeShow"] = "Grid_lnkProforma_BeforeShow";
    $Grid->lblClient->CCSEvents["BeforeShow"] = "Grid_lblClient_BeforeShow";
    $Grid->lblCurrency->CCSEvents["BeforeShow"] = "Grid_lblCurrency_BeforeShow";
}
//End BindEvents Method

//Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow @9-48234404
function Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow(& $sender)
{
    $Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow

//Retrieve number of records @10-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow @9-03F2C0A0
    return $Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow;
}
//End Close Grid_ar_proforma_pay_proforma_TotalRecords_BeforeShow

//Grid_lnkProforma_BeforeShow @31-1AE9CB2D
function Grid_lnkProforma_BeforeShow(& $sender)
{
    $Grid_lnkProforma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lnkProforma_BeforeShow

//Custom Code @49-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = $Grid->proforma_h_id->GetValue();
$ProNo = CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
$ProRev = CCDLookUp("Rev","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
$Grid->lnkProforma->SetValue($ProNo." ".$ProRev);
//End Custom Code

//Close Grid_lnkProforma_BeforeShow @31-77B999C9
    return $Grid_lnkProforma_BeforeShow;
}
//End Close Grid_lnkProforma_BeforeShow

//Grid_lblClient_BeforeShow @30-5EDCA8B3
function Grid_lblClient_BeforeShow(& $sender)
{
    $Grid_lblClient_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblClient_BeforeShow

//Custom Code @48-2A29BDB7
global $DBGayaFusionAll;
$ClientID = CCGetFromGet("ClientID",0);
$Grid->lblClient->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID=".$DBGayaFusionAll->ToSQL($ClientID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblClient_BeforeShow @30-B30F0E89
    return $Grid_lblClient_BeforeShow;
}
//End Close Grid_lblClient_BeforeShow

//Grid_lblCurrency_BeforeShow @50-8164FF6D
function Grid_lblCurrency_BeforeShow(& $sender)
{
    $Grid_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblCurrency_BeforeShow

//Custom Code @52-2A29BDB7
global $DBGayaFusionAll;
$CurrencyID = $Grid->CurrencyID->GetValue();
$Grid->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblCurrency_BeforeShow @50-09E85BAB
    return $Grid_lblCurrency_BeforeShow;
}
//End Close Grid_lblCurrency_BeforeShow

//DEL  global $DBGayaFusionAll;
//DEL  $ClientID = $Grid->client_id->GetValue();
//DEL  $Proforma_H_ID = $Grid->proforma_h_id->GetValue();
//DEL  $Grid->lblClient->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID = ".$DBGayaFusionAll->ToSQL($ClientID,ccsInteger),$DBGayaFusionAll));
//DEL  $ProNo = CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $ProRev = CCDLookUp("Rev","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $Grid->lnkProforma->SetValue($ProNo." ".$ProRev);

?>