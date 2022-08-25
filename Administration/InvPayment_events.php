<?php
//BindEvents Method @1-74852A0A
function BindEvents()
{
    global $Grid;
    $Grid->ar_invoice_pay_invoice_TotalRecords->CCSEvents["BeforeShow"] = "Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow";
    $Grid->lblClient->CCSEvents["BeforeShow"] = "Grid_lblClient_BeforeShow";
    $Grid->InvoiceNo->CCSEvents["BeforeShow"] = "Grid_InvoiceNo_BeforeShow";
    $Grid->lblCurrency->CCSEvents["BeforeShow"] = "Grid_lblCurrency_BeforeShow";
    $Grid->lblProforma->CCSEvents["BeforeShow"] = "Grid_lblProforma_BeforeShow";
}
//End BindEvents Method

//Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow @8-CABA5C84
function Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow(& $sender)
{
    $Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow

//Retrieve number of records @9-ABE656B4
    $Component->SetValue($Container->DataSource->RecordsCount);
//End Retrieve number of records

//Close Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow @8-504D16D2
    return $Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow;
}
//End Close Grid_ar_invoice_pay_invoice_TotalRecords_BeforeShow

//Grid_lblClient_BeforeShow @29-5EDCA8B3
function Grid_lblClient_BeforeShow(& $sender)
{
    $Grid_lblClient_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblClient_BeforeShow

//Custom Code @33-2A29BDB7
global $DBGayaFusionAll;
$ClientID = CCGetFromGet("ClientID",0);
$Grid->lblClient->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID=".$DBGayaFusionAll->ToSQL($ClientID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblClient_BeforeShow @29-B30F0E89
    return $Grid_lblClient_BeforeShow;
}
//End Close Grid_lblClient_BeforeShow

//Grid_InvoiceNo_BeforeShow @31-4A3CFA74
function Grid_InvoiceNo_BeforeShow(& $sender)
{
    $Grid_InvoiceNo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_InvoiceNo_BeforeShow

//Custom Code @34-2A29BDB7
global $DBGayaFusionAll;
$Invoice_H_ID = $Grid->Invoice_H_ID->GetValue();
$InvNo = CCDLookUp("InvoiceNo","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$Grid->InvoiceNo->SetValue($InvNo);
//End Custom Code

//Close Grid_InvoiceNo_BeforeShow @31-41158C8E
    return $Grid_InvoiceNo_BeforeShow;
}
//End Close Grid_InvoiceNo_BeforeShow

//Grid_lblCurrency_BeforeShow @45-8164FF6D
function Grid_lblCurrency_BeforeShow(& $sender)
{
    $Grid_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblCurrency_BeforeShow

//Custom Code @47-2A29BDB7
global $DBGayaFusionAll;
$CurrencyID = $Grid->CurrencyID->GetValue();
$Grid->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblCurrency_BeforeShow @45-09E85BAB
    return $Grid_lblCurrency_BeforeShow;
}
//End Close Grid_lblCurrency_BeforeShow

//Grid_lblProforma_BeforeShow @48-14C7A391
function Grid_lblProforma_BeforeShow(& $sender)
{
    $Grid_lblProforma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_lblProforma_BeforeShow

//Custom Code @49-2A29BDB7
global $DBGayaFusionAll;
$ProID = $Grid->proforma_h_id->GetValue();
$Grid->lblProforma->SetValue(CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID=".$DBGayaFusionAll->ToSQL($ProID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Grid_lblProforma_BeforeShow @48-1285453C
    return $Grid_lblProforma_BeforeShow;
}
//End Close Grid_lblProforma_BeforeShow
?>
