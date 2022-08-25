<?php
//BindEvents Method @1-8819F865
function BindEvents()
{
    global $Payment;
    $Payment->lblCurrency->CCSEvents["BeforeShow"] = "Payment_lblCurrency_BeforeShow";
    $Payment->CCSEvents["BeforeShow"] = "Payment_BeforeShow";
    $Payment->CCSEvents["BeforeInsert"] = "Payment_BeforeInsert";
}
//End BindEvents Method

//Payment_lblCurrency_BeforeShow @15-E73B2E0E
function Payment_lblCurrency_BeforeShow(& $sender)
{
    $Payment_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Payment; //Compatibility
//End Payment_lblCurrency_BeforeShow

//Custom Code @18-2A29BDB7
global $DBGayaFusionAll;
$CurrencyID = $Payment->currency_id->GetValue();
$Payment->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Payment_lblCurrency_BeforeShow @15-06DCEB8C
    return $Payment_lblCurrency_BeforeShow;
}
//End Close Payment_lblCurrency_BeforeShow

//Payment_BeforeShow @2-2FC4E308
function Payment_BeforeShow(& $sender)
{
    $Payment_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Payment; //Compatibility
//End Payment_BeforeShow

//Custom Code @16-2A29BDB7
if(!$Payment->EditMode){
  global $DBGayaFusionAll;
  $ar_invoice_id = CCGetFromGet("ar_invoice_id",0);
  $CurrencyID = CCDLookUp("Currency","ar_invoice","ar_invoice_id=".$DBGayaFusionAll->ToSQL($ar_invoice_id,ccsInteger),$DBGayaFusionAll);
  $Payment->currency_id->SetValue($CurrencyID);
  $Payment->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
  $Payment->Rate->SetValue(CCDLookUp("Rate","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
  $Payment->amount_paid->SetValue(CCDLookUp("GrandTotal","ar_invoice","ar_invoice_id=".$DBGayaFusionAll->ToSQL($ar_invoice_id,ccsInteger),$DBGayaFusionAll));
}
//End Custom Code

//Close Payment_BeforeShow @2-9F021A37
    return $Payment_BeforeShow;
}
//End Close Payment_BeforeShow

//Payment_BeforeInsert @2-20C4E354
function Payment_BeforeInsert(& $sender)
{
    $Payment_BeforeInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Payment; //Compatibility
//End Payment_BeforeInsert

//Custom Code @17-2A29BDB7
global $DBGayaFusionAll;
$ar_invoice_id = CCGetFromGet("ar_invoice_id",0);
$DBGayaFusionAll->query("UPDATE ar_invoice SET PAID=1 WHERE ar_invoice_id = ".$DBGayaFusionAll->ToSQL($ar_invoice_id,ccsInteger));
//End Custom Code

//Close Payment_BeforeInsert @2-37E804E9
    return $Payment_BeforeInsert;
}
//End Close Payment_BeforeInsert


?>
