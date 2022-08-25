<?php
session_start();
//BindEvents Method @1-1E7E4ECA
function BindEvents()
{
    global $Detil;
    global $lblAdministrasi;
    global $lblCustomer;
    $Detil->lblCurrency->CCSEvents["BeforeShow"] = "Detil_lblCurrency_BeforeShow";
    $Detil->CCSEvents["BeforeShowRow"] = "Detil_BeforeShowRow";
    $lblAdministrasi->CCSEvents["BeforeShow"] = "lblAdministrasi_BeforeShow";
    $lblCustomer->CCSEvents["BeforeShow"] = "lblCustomer_BeforeShow";
}
//End BindEvents Method

//Detil_lblCurrency_BeforeShow @136-29090376
function Detil_lblCurrency_BeforeShow(& $sender)
{
    $Detil_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_lblCurrency_BeforeShow

//Custom Code @137-2A29BDB7
global $DBGayaFusionAll;
$quoID = $Detil->Quotation_H_ID->GetValue();
$id = CCDLookUp("Currency","tblAdminist_Quotation_H","Quotation_H_ID = ".$DBGayaFusionAll->ToSQL($quoID,ccsInteger),$DBGayaFusionAll);
$Detil->lblCurrency->SetValue(CCDLookUp("CurrencyCode","tbladminist_currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($id,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Detil_lblCurrency_BeforeShow @136-A25C728D
    return $Detil_lblCurrency_BeforeShow;
}
//End Close Detil_lblCurrency_BeforeShow

//Detil_BeforeShowRow @2-36388CCD
function Detil_BeforeShowRow(& $sender)
{
    $Detil_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_BeforeShowRow

//Custom Code @100-2A29BDB7
$Component->Attributes->SetValue('LocalRowNumber', $Component->RowNumber);
//End Custom Code

//Close Detil_BeforeShowRow @2-D613C936
    return $Detil_BeforeShowRow;
}
//End Close Detil_BeforeShowRow

//lblAdministrasi_BeforeShow @129-52E7D33D
function lblAdministrasi_BeforeShow(& $sender)
{
    $lblAdministrasi_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblAdministrasi; //Compatibility
//End lblAdministrasi_BeforeShow

//Custom Code @133-2A29BDB7
global $Header;
global $DBGayaFusionAll;
$lblAdministrasi->SetValue(CCDLookUp("Firstname","tblUser","id = ".$DBGayaFusionAll->ToSQL(($Header->DocMaker->GetValue()),ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close lblAdministrasi_BeforeShow @129-E5CCD1BF
    return $lblAdministrasi_BeforeShow;
}
//End Close lblAdministrasi_BeforeShow

//lblCustomer_BeforeShow @130-9F1B654F
function lblCustomer_BeforeShow(& $sender)
{
    $lblCustomer_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblCustomer; //Compatibility
//End lblCustomer_BeforeShow

//Custom Code @132-2A29BDB7
global $Header;
$customer = $Header->AddressID->GetValue();
$lblCustomer->SetValue($customer);
//End Custom Code

//Close lblCustomer_BeforeShow @130-7C7DE75F
    return $lblCustomer_BeforeShow;
}
//End Close lblCustomer_BeforeShow

?>