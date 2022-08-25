<?php
//BindEvents Method @1-9BB81AEA
function BindEvents()
{
    global $AddNewHeader;
    global $Grid;
    $AddNewHeader->lblQuotation->CCSEvents["BeforeShow"] = "AddNewHeader_lblQuotation_BeforeShow";
    $AddNewHeader->lblProforma->CCSEvents["BeforeShow"] = "AddNewHeader_lblProforma_BeforeShow";
    $AddNewHeader->lblClient->CCSEvents["BeforeShow"] = "AddNewHeader_lblClient_BeforeShow";
    $AddNewHeader->lblCurrency->CCSEvents["BeforeShow"] = "AddNewHeader_lblCurrency_BeforeShow";
    $AddNewHeader->lblAddress->CCSEvents["BeforeShow"] = "AddNewHeader_lblAddress_BeforeShow";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $Grid->Link2->CCSEvents["BeforeShow"] = "Grid_Link2_BeforeShow";
    $Grid->CCSEvents["BeforeShow"] = "Grid_BeforeShow";
}
//End BindEvents Method

//AddNewHeader_lblQuotation_BeforeShow @78-EC089EA2
function AddNewHeader_lblQuotation_BeforeShow(& $sender)
{
    $AddNewHeader_lblQuotation_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_lblQuotation_BeforeShow

//Custom Code @81-2A29BDB7
global $DBGayaFusionAll;
$Quotation_H_ID=$AddNewHeader->Quotation_H_ID->GetValue();
if($Quotation_H_ID > 0){
  $AddNewHeader->lblQuotation->SetValue(CCDLookUp("QuotationNo","tblAdminist_Quotation_H","Quotation_H_ID=".$DBGayaFusionAll->ToSQL($Quotation_H_ID,ccsInteger),$DBGayaFusionAll));
}else{
  $AddNewHeader->lblQuotation->SetValue("-");
}
//End Custom Code

//Close AddNewHeader_lblQuotation_BeforeShow @78-D22337A8
    return $AddNewHeader_lblQuotation_BeforeShow;
}
//End Close AddNewHeader_lblQuotation_BeforeShow

//AddNewHeader_lblProforma_BeforeShow @79-B479137E
function AddNewHeader_lblProforma_BeforeShow(& $sender)
{
    $AddNewHeader_lblProforma_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_lblProforma_BeforeShow

//Custom Code @82-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID=$AddNewHeader->Proforma_H_ID->GetValue();
if($Proforma_H_ID > 0){
  $AddNewHeader->lblProforma->SetValue(CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID=".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll));
}else{
  $AddNewHeader->lblProforma->SetValue("-");
}
//End Custom Code

//Close AddNewHeader_lblProforma_BeforeShow @79-8A8C1C8E
    return $AddNewHeader_lblProforma_BeforeShow;
}
//End Close AddNewHeader_lblProforma_BeforeShow

//AddNewHeader_lblClient_BeforeShow @80-1DF61FFF
function AddNewHeader_lblClient_BeforeShow(& $sender)
{
    $AddNewHeader_lblClient_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_lblClient_BeforeShow

//Custom Code @83-2A29BDB7
global $DBGayaFusionAll;
$ClientID=$AddNewHeader->ClientID->GetValue();
$AddNewHeader->lblClient->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID=".$DBGayaFusionAll->ToSQL($ClientID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close AddNewHeader_lblClient_BeforeShow @80-71C89AA3
    return $AddNewHeader_lblClient_BeforeShow;
}
//End Close AddNewHeader_lblClient_BeforeShow

//AddNewHeader_lblCurrency_BeforeShow @84-F78EA108
function AddNewHeader_lblCurrency_BeforeShow(& $sender)
{
    $AddNewHeader_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_lblCurrency_BeforeShow

//Custom Code @86-2A29BDB7
global $DBGayaFusionAll;
$CurrencyID=$AddNewHeader->CurrencyID->GetValue();
$AddNewHeader->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close AddNewHeader_lblCurrency_BeforeShow @84-91E10219
    return $AddNewHeader_lblCurrency_BeforeShow;
}
//End Close AddNewHeader_lblCurrency_BeforeShow

//AddNewHeader_lblAddress_BeforeShow @85-4E32A56A
function AddNewHeader_lblAddress_BeforeShow(& $sender)
{
    $AddNewHeader_lblAddress_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_lblAddress_BeforeShow

//Custom Code @87-2A29BDB7
// -------------------------
    // Write your own code here.
// -------------------------
//End Custom Code

//Close AddNewHeader_lblAddress_BeforeShow @85-1EF0280F
    return $AddNewHeader_lblAddress_BeforeShow;
}
//End Close AddNewHeader_lblAddress_BeforeShow

//AddNewHeader_AfterInsert @2-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @7-2A29BDB7
global $DBGayaFusionAll;
global $Redirect;
 
  	$Invoice_SH_ID = CCDLookup("max(Invoice_SH_ID)","tblAdminist_invoice_SH","",$DBGayaFusionAll);
  	$Proforma_H_ID = CCDLookUp("Proforma_H_ID","tblAdminist_Invoice_SH","invoice_SH_ID = ".$DBGayaFusionAll->ToSQL($Invoice_SH_ID, ccsInteger), $DBGayaFusionAll);
	$Quotation_H_ID = CCDLookUp("Quotation_H_ID","tblAdminist_Invoice_SH","invoice_SH_ID = ".$DBGayaFusionAll->ToSQL($Invoice_SH_ID, ccsInteger), $DBGayaFusionAll);
	$AddressID = CCDLookUp("AddressID","tblAdminist_Invoice_SH","invoice_SH_ID = ".$DBGayaFusionAll->ToSQL($Invoice_SH_ID, ccsInteger), $DBGayaFusionAll);
	$ContactID = CCGetFromGet("ContactID",0);
	if($Quotation_H_ID > 0){
		$Redirect = "AddInvoice.php?Invoice_SH_ID=".$Invoice_SH_ID."&quotation_h_id=".$Quotation_H_ID."&addressid=".$AddressID."&contactid=".$ContactID;
	}elseif ($Proforma_H_ID > 0){
		$Redirect = "AddInvoice.php?Invoice_SH_ID=".$Invoice_SH_ID."&proforma_h_id=".$Proforma_H_ID."&addressid=".$AddressID."&contactid=".$ContactID;
	}else{
		$Redirect = "AddInvoice.php?Invoice_SH_ID=".$Invoice_SH_ID;
	}    
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//DEL  

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @9-2A29BDB7
	global $AddNewHeader, $Grid;

	if(!$AddNewHeader->EditMode){
		$Grid->Visible = false;
		$db = new clsDBGayaFusionAll;
		$ClientID = CCGetFromGet("ClientID","");
		$AddressID = CCGetFromGet("AddressID","");
		$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", "");
		$Proforma_H_ID = CCGetFromGet("Proforma_H_ID", "");
		$AddNewHeader->ClientID->SetValue($ClientID);
		$AddNewHeader->AddressID->SetValue($AddressID);
		$AddNewHeader->Quotation_H_ID->SetValue($Quotation_H_ID);
		$AddNewHeader->Proforma_H_ID->SetValue($Proforma_H_ID);
		//make prefix for invoice
		$Prefix = "INV".date(Ym);
		$sqlquery = "SELECT * FROM tbladminist_invoice_sh WHERE InvoiceNo LIKE '".$Prefix."%'";
		$db->query($sqlquery);
		$jumlah = $db->num_rows("InvoiceNo");
		if($jumlah > 0){
			$sqlquery = "SELECT MAX(InvoiceNo) FROM tblAdminist_Invoice_SH";
			$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
			$NoTrans = $Prefix.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
		}else{
			$NoTrans = $Prefix."01";
		}
		$AddNewHeader->InvoiceNo->SetValue($NoTrans);
	}
	
//End Custom Code

//Close AddNewHeader_BeforeShow @2-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//Grid_Link2_BeforeShow @33-7E65D448
function Grid_Link2_BeforeShow(& $sender)
{
    $Grid_Link2_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_Link2_BeforeShow

//Custom Code @44-2A29BDB7
global $AddNewHeader, $Grid;
$Invoice_SH_ID = $Grid->Invoice_SH_ID->GetValue();
$Quotation_H_ID = $AddNewHeader->Quotation_H_ID->GetValue();
$Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
$AddressID = $AddNewHeader->AddressID->GetValue();

$Grid->Link2->SetLink("AddInvoice.php?Invoice_SH_ID=".$Invoice_SH_ID."&proforma_h_id=".$Proforma_H_ID."&quotation_h_id=".$Quotation_H_ID."&addressid=".$AddressID);


//End Custom Code

//Close Grid_Link2_BeforeShow @33-9355734E
    return $Grid_Link2_BeforeShow;
}
//End Close Grid_Link2_BeforeShow

//Grid_BeforeShow @19-9B71DC32
function Grid_BeforeShow(& $sender)
{
    $Grid_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Grid; //Compatibility
//End Grid_BeforeShow

//Custom Code @38-2A29BDB7

//End Custom Code

//Close Grid_BeforeShow @19-C392A694
    return $Grid_BeforeShow;
}
//End Close Grid_BeforeShow
?>
