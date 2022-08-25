<?php
//BindEvents Method @1-0480A22F
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    global $CCSEvents;
    $AddNewHeader->InvoiceAddressContact->CCSEvents["BeforeShow"] = "AddNewHeader_InvoiceAddressContact_BeforeShow";
    $AddNewHeader->DeliveryAddressContact->CCSEvents["BeforeShow"] = "AddNewHeader_DeliveryAddressContact_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
}
//End BindEvents Method

//AddNewHeader_InvoiceAddressContact_BeforeShow @14-92BE27D9
function AddNewHeader_InvoiceAddressContact_BeforeShow(& $sender)
{
    $AddNewHeader_InvoiceAddressContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_InvoiceAddressContact_BeforeShow

//Close AddNewHeader_InvoiceAddressContact_BeforeShow @14-158C6158
    return $AddNewHeader_InvoiceAddressContact_BeforeShow;
}
//End Close AddNewHeader_InvoiceAddressContact_BeforeShow

//AddNewHeader_DeliveryAddressContact_BeforeShow @25-3BCB677B
function AddNewHeader_DeliveryAddressContact_BeforeShow(& $sender)
{
    $AddNewHeader_DeliveryAddressContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_DeliveryAddressContact_BeforeShow

//Close AddNewHeader_DeliveryAddressContact_BeforeShow @25-12A3F2DC
    return $AddNewHeader_DeliveryAddressContact_BeforeShow;
}
//End Close AddNewHeader_DeliveryAddressContact_BeforeShow

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @68-2A29BDB7
global $AddNewHeader, $AddNewDetail;
global $DBGayaFusionAll;
if(!$AddNewHeader->EditMode){
  $AddNewDetail->Visible=false;
  $AddNewHeader->Invoice_H_ID->SetValue(CCGetFromGet("Invoice_H_ID",""));
  //$AddNewHeader->AddressID->SetValue(CCGetFromGet("AddressID",""));dganti jadi dumy
  //make prefix for invoice
  $Prefix = "PL".date(Ym);
  $sqlquery = "SELECT PL_H_ID FROM tblAdminist_PackingList_H WHERE PLNo LIKE '".$Prefix."%'";
  $jumlah = mysql_num_rows(mysql_query($sqlquery));
  if($jumlah > 0){
	$sqlquery = "SELECT MAX(PLNo) FROM tblAdminist_PackingList_H";
	$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
	$NoTrans = $Prefix.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
  }else{
	$NoTrans = $Prefix."01";
  }
  $AddNewHeader->PackingListNo->SetValue($NoTrans);
}
$PL_H_ID = CCGetFromGet("PL_H_ID",0);
$AddressID = CCDLookUp("AddressID","tblAdminist_PackingList_H","PL_H_ID=".$DBGayaFusionAll->ToSQL($PL_H_ID,ccsInteger),$DBGayaFusionAll);
//$AddNewHeader->DumyAddress1->SetValue(CCGetFromGet("AddressID",""));ini langsung di set ke addressid
$AddNewHeader->DumyAddress2->SetValue($AddressID);

//to handle the address-attn
$InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
if($InvoiceContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
  $AddNewHeader->InvoiceAddressContact->Visible=false;
  $AddNewHeader->lblInvoiceAddressContact->Visible=true;
  $AddNewHeader->LinkChangeInvoiceContact->Visible = true;
  $addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$InvoiceContactID;
  $NewConnection->query($addquery);
  $Result = $NewConnection->next_record();
  if($Result){
	$company = $NewConnection->f("Company");
	$contactname = $NewConnection->f("ContactName");
	$address = $NewConnection->f("Address");
	$phone = $NewConnection->f("Phone");
	$fax = $NewConnection->f("Fax");
  }
  $NewConnection->close;
  $AddNewHeader->lblInvoiceAddressContact->SetValue($contactname);
  $AddNewHeader->InvoiceAddress->SetValue($address);
  $AddNewHeader->InvoicePhone->SetValue($phone);
  $AddNewHeader->InvoiceFax->SetValue($fax);
}else{
  $AddNewHeader->InvoiceAddressContact->Visible= true;
  $AddNewHeader->lblInvoiceAddressContact->Visible= false;
  $AddNewHeader->LinkChangeInvoiceContact->Visible=false;
}

$DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
if($DeliveryContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
  $AddNewHeader->DeliveryAddressContact->Visible= false;
  $AddNewHeader->lblDeliveryAddressContact->Visible=true;
  $AddNewHeader->LinkChangeDeliveryContact->Visible=true;
  $addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$DeliveryContactID;
  $NewConnection->query($addquery);
  $Result = $NewConnection->next_record();
  if($Result){
	$company = $NewConnection->f("Company");
	$contactname = $NewConnection->f("ContactName");
	$address = $NewConnection->f("Address");
	$phone = $NewConnection->f("Phone");
	$fax = $NewConnection->f("Fax");
  }
  $NewConnection->close;
  $AddNewHeader->lblDeliveryAddressContact->SetValue($contactname);
  $AddNewHeader->DeliveryAddress->SetValue($address);
  $AddNewHeader->DeliveryPhone->SetValue($phone);
  $AddNewHeader->DeliveryFax->SetValue($fax);
}else{
  $AddNewHeader->DeliveryAddressContact->Visible= true;
  $AddNewHeader->lblDeliveryAddressContact->Visible=false;
  $AddNewHeader->LinkChangeDeliveryContact->Visible=false;
}
//End Custom Code

//Close AddNewHeader_BeforeShow @2-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_BeforeDelete @2-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @69-2A29BDB7
$PL_H_ID = CCGetFromGet("PL_H_ID",0);	
if(intval($PL_H_ID) >0){
//Create a new database connection object
  $NewConnection = new clsDBGayaFusionAll();
  $NewConnection->query("DELETE FROM tblAdminist_PackingList_D WHERE PL_H_ID=".$NewConnection->ToSQL($PL_H_ID,ccsInteger));
}
//Close and destroy the database connection object
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @2-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterInsert @2-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @70-2A29BDB7
global $DBGayaFusionAll;	
global $Redirect;
$PL_H_ID = CCDLookUp("max(PL_H_ID)","tblAdminist_PackingList_H","", $DBGayaFusionAll);
$InvoiceContactID = CCDLookUp("InvoiceContactID","tblAdminist_PackingList_H","PL_H_ID = ".$DBGayaFusionAll->ToSQL($PL_H_ID,ccsInteger),$DBGayaFusionAll);
$DeliveryContactID = CCDLookUp("DeliveryContactID","tblAdminist_PackingList_H","PL_H_ID = ".$DBGayaFusionAll->ToSQL($PL_H_ID,ccsInteger),$DBGayaFusionAll);
$Redirect = "AddPackList.php"."?PL_H_ID=".$PL_H_ID."&InvoiceContactID=".$InvoiceContactID."&DeliveryContactID=".$DeliveryContactID;
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//DEL  global $DBGayaFusionAll;
//DEL  $Box_H_ID = $AddNewDetail->Box_H_ID->GetValue();
//DEL  $AddNewDetail->BoxNumber->SetValue(CCDLookUp("BoxNumber","tblAdminist_Box_H","Box_H_ID=".$DBGayaFusionAll->ToSQL($Box_H_ID,ccsInteger),$DBGayaFusionAll));

//AddNewDetail_BeforeShowRow @42-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @63-2A29BDB7
  	global $AddNewDetail;
  	global $RowNumber;
    
    	$RowNumber++;
    	$AddNewDetail->RowIDAttribute->SetValue($RowNumber);
  
    	if( ($RowNumber <= $AddNewDetail->ds->RecordsCount) && ($RowNumber <= $AddNewDetail->PageSize) ){
      	
  		$AddNewDetail->RowNameAttribute->SetValue("FillRow");
  
    	}else{ 
  
  		$AddNewDetail->RowNameAttribute->SetValue("EmptyRow");
      	$AddNewDetail->RowStyleAttribute->SetValue("style='display:none;'");
       	
  		if($AddNewDetail->EditMode){
  
  		    if($AddNewDetail->ErrorMessages[$RowNumber]) $AddNewDetail->RowStyleAttribute->SetValue("");
          }
  	 }
  	global $AddNewDetail;
  	$PL_H_ID = intval(CCGetFromGet("PL_H_ID",0));
  	if($PL_H_ID > 0){
  		$AddNewDetail->ds->PL_H_ID->SetValue($PL_H_ID);
    	}
//End Custom Code

//Close AddNewDetail_BeforeShowRow @42-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @42-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @64-2A29BDB7
global $AddNewDetail;
$PL_H_ID = intval(CCGetFromGet("PL_H_ID",0));
if($PL_H_ID > 0){
  $AddNewDetail->ds->PL_H_ID->SetValue($PL_H_ID);
}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @42-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

//Page_BeforeInitialize @1-9AD64625
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddPackList; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill2 Initialization @12-B890BE5B
    if ('AddNewHeaderInvoiceAddressContactPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @12-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @12-F022CBD7
        $Service->AddDataSourceField('Address',ccsInteger,"");
        $Service->AddDataSourceField('Phone',ccs,"");
        $Service->AddDataSourceField('Fax',ccs,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @12-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @12-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//PTAutoFill1 Initialization @23-55F31582
    if ('AddNewHeaderDeliveryAddressContactPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @23-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @23-AB89ED27
        $Service->AddDataSourceField('Phone',ccsInteger,"");
        $Service->AddDataSourceField('Fax',ccs,"");
        $Service->AddDataSourceField('Address',ccs,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @23-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @23-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

?>