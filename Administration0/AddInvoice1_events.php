<?php
session_start();
//BindEvents Method @1-846A1C2C
function BindEvents()
{
    global $AddNewHeader;
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
}
//End BindEvents Method

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
 
$Invoice_H_ID = CCDLookup("max(Invoice_H_ID)","tblAdminist_invoice_H","",$DBGayaFusionAll);
$Proforma_H_ID = CCDLookUp("Proforma_H_ID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$Quotation_H_ID = CCDLookUp("Quotation_H_ID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$AddressID = CCDLookUp("AddressID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$ContactID = CCGetFromGet("ContactID",0);
$ClientID = CCDLookUp("ClientID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll);
if($Proforma_H_ID == "") ($Proforma_H_ID = 0);
//$DueDate = $AddNewHeader->DueDate->GetValue();
$sql = "INSERT INTO ar_Invoice (ClientID,Invoice_H_ID,Proforma_H_ID,Currency,Rate) VALUES (".$DBGayaFusionAll->ToSQL($ClientID,csInteger).",".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger).",".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger).",".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger).",".$DBGayaFusionAll->ToSQL($CurrencyRate,ccsFloat).")";
$DBGayaFusionAll->query($sql);

if($Quotation_H_ID > 0){
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&quotation_h_id=".$Quotation_H_ID."&addressid=".$AddressID."&contactid=".$ContactID;
}elseif ($Proforma_H_ID > 0){
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&proforma_h_id=".$Proforma_H_ID."&addressid=".$AddressID."&contactid=".$ContactID;
}else{
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID;
}    
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

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
		//$Grid->Visible = false;
		$db = new clsDBGayaFusionAll;
		$ClientID = CCGetFromGet("ClientID","");
		$AddressID = CCGetFromGet("AddressID","");
		$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", "");
		$Proforma_H_ID = CCGetFromGet("Proforma_H_ID", "");
		$AddNewHeader->ClientID->SetValue($ClientID);
		$AddNewHeader->AddressID->SetValue($AddressID);
		$AddNewHeader->Quotation_H_ID->SetValue($Quotation_H_ID);
		$AddNewHeader->Proforma_H_ID->SetValue($Proforma_H_ID);
		$dbf = new db_functions("localhost","root","","gayafusionall","","","");
		$AddNewHeader->DocMaker->SetValue($dbf->FieldToid("tblUser",'id',$_SESSION['session_user_id']));
		//make prefix for invoice
		$Prefix = "INV".date(Ym);
		$sqlquery = "SELECT * FROM tbladminist_invoice_h WHERE InvoiceNo LIKE '".$Prefix."%'";
		$db->query($sqlquery);
		$jumlah = $db->num_rows("InvoiceNo");
		if($jumlah > 0){
			$sqlquery = "SELECT MAX(InvoiceNo) FROM tblAdminist_Invoice_H";
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

//DEL  global $AddNewHeader, $Grid;
//DEL  $Invoice_SH_ID = $Grid->Invoice_SH_ID->GetValue();
//DEL  $Quotation_H_ID = $AddNewHeader->Quotation_H_ID->GetValue();
//DEL  $Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
//DEL  $AddressID = $AddNewHeader->AddressID->GetValue();
//DEL  
//DEL  $Grid->Link2->SetLink("AddInvoice.php?Invoice_SH_ID=".$Invoice_SH_ID."&proforma_h_id=".$Proforma_H_ID."&quotation_h_id=".$Quotation_H_ID."&addressid=".$AddressID);
//DEL  
//DEL  


//DEL  

?>
