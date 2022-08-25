<?php
session_start();
//BindEvents Method @1-F3CA8904
function BindEvents()
{
    global $AddNewHeader;
    global $CCSEvents;
    $AddNewHeader->Attn->CCSEvents["BeforeShow"] = "AddNewHeader_Attn_BeforeShow";
    $AddNewHeader->DeliveryContactID->CCSEvents["BeforeShow"] = "AddNewHeader_DeliveryContactID_BeforeShow";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
}
//End BindEvents Method

//AddNewHeader_Attn_BeforeShow @13-C0B4F923
function AddNewHeader_Attn_BeforeShow(& $sender)
{
    $AddNewHeader_Attn_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_Attn_BeforeShow

//Close AddNewHeader_Attn_BeforeShow @13-674E9276
    return $AddNewHeader_Attn_BeforeShow;
}
//End Close AddNewHeader_Attn_BeforeShow

//AddNewHeader_DeliveryContactID_BeforeShow @56-45B16C9D
function AddNewHeader_DeliveryContactID_BeforeShow(& $sender)
{
    $AddNewHeader_DeliveryContactID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_DeliveryContactID_BeforeShow

//Close AddNewHeader_DeliveryContactID_BeforeShow @56-3346C6E3
    return $AddNewHeader_DeliveryContactID_BeforeShow;
}
//End Close AddNewHeader_DeliveryContactID_BeforeShow

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
$DeliveryAddressID = CCDLookUp("DeliveryAddressID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$InvoiceContactID = CCDLookUp("InvoiceContactID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$DeliveryContactID = CCDLookUp("DeliveryContactID","tblAdminist_Invoice_H","invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
$ClientID = CCDLookUp("ClientID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll);
if($Proforma_H_ID == "") ($Proforma_H_ID = 0);
//$DueDate = $AddNewHeader->DueDate->GetValue();
$sql = "INSERT INTO ar_Invoice (ClientID,Invoice_H_ID,Proforma_H_ID,Currency,Rate) VALUES (".$DBGayaFusionAll->ToSQL($ClientID,csInteger).",".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger).",".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger).",".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger).",".$DBGayaFusionAll->ToSQL($CurrencyRate,ccsFloat).")";
$DBGayaFusionAll->query($sql);

if($Quotation_H_ID > 0){
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&quotation_h_id=".$Quotation_H_ID."&AddressID=".$AddressID."&InvoiceContactID=".$InvoiceContactID."&DeliveryAddressID=".$DeliveryAddressID."&DeliveryContactID=".$DeliveryContactID;
}elseif ($Proforma_H_ID > 0){
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&proforma_h_id=".$Proforma_H_ID."&AddressID=".$AddressID."&InvoiceContactID=".$InvoiceContactID."&DeliveryAddressID=".$DeliveryAddressID."&DeliveryContactID=".$DeliveryContactID;
}else{
  $Redirect = "AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&AddressID=".$AddressID."&InvoiceContactID=".$InvoiceContactID."&DeliveryAddressID=".$DeliveryAddressID."&DeliveryContactID=".$DeliveryContactID;
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
		$DeliveryAddressID = CCGetFromGet("DeliveryAddressID","");
		$InvoiceContactID = CCGetFromGet("InvoiceContactID","");
		$DeliveryContactID = CCGetFromGet("DeliveryContactID","");
		$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", "");
		$Proforma_H_ID = CCGetFromGet("Proforma_H_ID", "");
		$AddNewHeader->ClientID->SetValue($ClientID);
		$AddNewHeader->AddressID->SetValue($AddressID);
		$AddNewHeader->DeliveryAddressID->SetValue($DeliveryAddressID);
		$AddNewHeader->Attn->SetValue($InvoiceContactID);
		$AddNewHeader->DeliveryContactID->SetValue($DeliveryContactID);
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

//Page_BeforeInitialize @1-F546F0B6
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddInvoice1; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill1 Initialization @48-8A3F6187
    if ('AddNewHeaderAttnPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @48-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @48-3053F711
        $Service->AddDataSourceField('Email',ccs,"");
        $Service->AddDataSourceField('Address',ccs,"");
        $Service->AddDataSourceField('Phone',ccs,"");
        $Service->AddDataSourceField('Fax',ccs,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @48-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @48-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//PTAutoFill2 Initialization @60-80500AAC
    if ('AddNewHeaderDeliveryContactIDPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @60-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @60-00E16AB5
        $Service->AddDataSourceField('Address',ccs,"");
        $Service->AddDataSourceField('Phone',ccs,"");
        $Service->AddDataSourceField('Fax',ccs,"");
        $Service->AddDataSourceField('Email',ccs,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @60-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @60-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

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
