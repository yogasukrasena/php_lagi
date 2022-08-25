<?php
//BindEvents Method @1-66D863D8
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
    $AddNewDetail->ds->CCSEvents["BeforeExecuteDelete"] = "AddNewDetail_ds_BeforeExecuteDelete";
}
//End BindEvents Method

//AddNewHeader_InvoiceAddressContact_BeforeShow @11-92BE27D9
function AddNewHeader_InvoiceAddressContact_BeforeShow(& $sender)
{
    $AddNewHeader_InvoiceAddressContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_InvoiceAddressContact_BeforeShow

//Close AddNewHeader_InvoiceAddressContact_BeforeShow @11-158C6158
    return $AddNewHeader_InvoiceAddressContact_BeforeShow;
}
//End Close AddNewHeader_InvoiceAddressContact_BeforeShow

//AddNewHeader_DeliveryAddressContact_BeforeShow @19-3BCB677B
function AddNewHeader_DeliveryAddressContact_BeforeShow(& $sender)
{
    $AddNewHeader_DeliveryAddressContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_DeliveryAddressContact_BeforeShow

//Close AddNewHeader_DeliveryAddressContact_BeforeShow @19-12A3F2DC
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

//Custom Code @35-2A29BDB7
global $AddNewHeader, $AddNewDetail;
$db = new clsDBGayaFusionAll();
if(!$AddNewHeader->EditMode){
  $AddNewDetail->Visible=false;
  $Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
  $AddNewHeader->Invoice_H_ID->SetValue($Invoice_H_ID);
  $AddNewHeader->OrderRef->SetValue(CCDLookUp("ClientOrderRef","tblAdminist_Invoice_H","Invoice_H_ID = ".$db->ToSQL($Invoice_H_ID,ccsInteger),$db));
  $AddNewHeader->AddressID->SetValue(CCGetFromGet("AddressID",""));
  $AddNewHeader->DeliveryAddressID->SetValue(CCGetFromGet("DeliveryAddressID",""));
  $AddNewHeader->InvoiceAddressContact->SetValue(CCGetFromGet("InvoiceContactID",""));
  $AddNewHeader->DeliveryAddressContact->SetValue(CCGetFromGet("DeliveryContactID",""));
  
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
$db->close();
$PL_H_ID = CCGetFromGet("PL_H_ID",0);


//$AddNewHeader->DumyAddress1->SetValue(CCGetFromGet("AddressID",""));ini langsung di set ke addressid
//$AddNewHeader->DumyAddress2->SetValue($AddressID);

//to handle the address-attn

$InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
if($InvoiceContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
  //$AddNewHeader->ContactID->SetValue($InvoiceContactID);//ini dpake sama DelContactID utk ngisi contact id, pada waktu ambil data dari invoice
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
  $AddNewHeader->InvoiceAddressContact->SetValue($InvoiceContactID);
  $AddNewHeader->InvoiceAddress->SetValue($address);
  $AddNewHeader->InvoicePhone->SetValue($phone);
  $AddNewHeader->InvoiceFax->SetValue($fax);
}
//if($AddNewHeader->Invoice_H_ID->GetValue() > 0){ //=>nti lanjuti dsini.
$DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
if($DeliveryContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
  //$AddNewHeader->DelContactID->SetValue($DeliveryContactID);
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
  $AddNewHeader->DeliveryAddressContact->SetValue($DeliveryContactID);
  $AddNewHeader->DeliveryAddress->SetValue($address);
  $AddNewHeader->DeliveryPhone->SetValue($phone);
  $AddNewHeader->DeliveryFax->SetValue($fax);
  $NewConnection->close();
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

//Custom Code @36-2A29BDB7
$PL_H_ID = CCGetFromGet("PL_H_ID",0);	
if(intval($PL_H_ID) >0){
//Create a new database connection object
  $NewConnection = new clsDBGayaFusionAll();
  $NewConnection->query("DELETE FROM tblAdminist_PackingList_D WHERE PL_H_ID=".$NewConnection->ToSQL($PL_H_ID,ccsInteger));
  $NewConnection->close();
}
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

//Custom Code @37-2A29BDB7
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

//AddNewDetail_BeforeShowRow @40-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @56-2A29BDB7
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

//Close AddNewDetail_BeforeShowRow @40-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @40-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @57-2A29BDB7
global $AddNewDetail;
$PL_H_ID = intval(CCGetFromGet("PL_H_ID",0));
if($PL_H_ID > 0){
  $AddNewDetail->ds->PL_H_ID->SetValue($PL_H_ID);
}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @40-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

//AddNewDetail_ds_BeforeExecuteDelete @40-65DE9FF0
function AddNewDetail_ds_BeforeExecuteDelete(& $sender)
{
    $AddNewDetail_ds_BeforeExecuteDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeExecuteDelete

//Custom Code @63-2A29BDB7
global $DBGayaFusionAll;
$Box_H_ID = $AddNewDetail->Box_H_ID->GetValue();
$sql = "DELETE FROM tblAdminist_Box_D WHERE Box_H_ID = ".$DBGayaFusionAll->ToSQL($Box_H_ID,ccsInteger);
$DBGayaFusionAll->query($sql);
$sql = "DELETE FROM tblAdminist_Box_H WHERE Box_H_ID = ".$DBGayaFusionAll->ToSQL($Box_H_ID,ccsInteger);
$DBGayaFusionAll->query($sql);
//End Custom Code

//Close AddNewDetail_ds_BeforeExecuteDelete @40-297B2C8E
    return $AddNewDetail_ds_BeforeExecuteDelete;
}
//End Close AddNewDetail_ds_BeforeExecuteDelete

//Page_BeforeInitialize @1-9AD64625
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddPackList; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill3 Initialization @12-CD0F78C6
    if ('AddNewHeaderInvoiceAddressContactPTAutoFill3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill3 Initialization

//PTAutoFill3 DataSource @12-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill3 DataSource

//PTAutoFill3 DataFields @12-C00B1622
        $Service->AddDataSourceField('Address',ccs,"");
        $Service->AddDataSourceField('Phone',ccs,"");
        $Service->AddDataSourceField('Fax',ccsText,"");
//End PTAutoFill3 DataFields

//PTAutoFill3 Execution @12-028A6C4C
        echo $Service->Execute();
//End PTAutoFill3 Execution

//PTAutoFill3 Loading @12-27890EF8
        exit;
    }
//End PTAutoFill3 Loading

//PTAutoFill2 Initialization @20-CB535E25
    if ('AddNewHeaderDeliveryAddressContactPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @20-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @20-D358F474
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccsText,"");
        $Service->AddDataSourceField('Address',ccsText,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @20-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @20-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize


?>
