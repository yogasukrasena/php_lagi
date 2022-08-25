<?php
session_start();
//BindEvents Method @1-68D1AD1B
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    global $CCSEvents;
    $AddNewHeader->Attn->CCSEvents["BeforeShow"] = "AddNewHeader_Attn_BeforeShow";
    $AddNewHeader->DeliveryContactID->CCSEvents["BeforeShow"] = "AddNewHeader_DeliveryContactID_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["AfterInsert"] = "AddNewHeader_AfterInsert";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->ds->CCSEvents["BeforeBuildInsert"] = "AddNewHeader_ds_BeforeBuildInsert";
    $AddNewHeader->CCSEvents["AfterUpdate"] = "AddNewHeader_AfterUpdate";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
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

//AddNewHeader_DeliveryContactID_BeforeShow @356-45B16C9D
function AddNewHeader_DeliveryContactID_BeforeShow(& $sender)
{
    $AddNewHeader_DeliveryContactID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_DeliveryContactID_BeforeShow

//Close AddNewHeader_DeliveryContactID_BeforeShow @356-3346C6E3
    return $AddNewHeader_DeliveryContactID_BeforeShow;
}
//End Close AddNewHeader_DeliveryContactID_BeforeShow

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @373-2A29BDB7
global $AddNewDetail;
global $ProformaNo;
global $AddProforma;
global $NoTrans;
//global $ContactID;//this is to get the contact id

$NewConnection = new clsDBGayaFusionAll();
$Prefik = "PRO".date(Ym);
if(!$AddNewHeader->EditMode){ 
	$dbf = new db_functions("localhost","root","","gayafusionall","","","");
	$AddNewHeader->DocMaker->SetValue($dbf->FieldToid("tblUser",'id',$_SESSION['session_user_id']));
 	
	$AddNewDetail->Visible = false;
	$AddNewHeader->Revis->Visible = false;
	$AddNewHeader->LinkRev->Visible = false;

	$sqlquery = "SELECT Proforma_H_ID FROM tblAdminist_Proforma_H WHERE ProformaNo LIKE '".$Prefik."%'";
	$jumlah = mysql_num_rows(mysql_query($sqlquery));
	if($jumlah > 0){
		$sqlquery = "SELECT MAX(ProformaNo) FROM tblAdminist_Proforma_H";
		$NoTrans = mysql_fetch_array(mysql_query($sqlquery));
		$NoTrans = $Prefik.substr("0".strval(intval(substr($NoTrans[0],-2)+1)),-2);
	}else{
		$NoTrans = $Prefik."01";
	}
	$AddNewHeader->ProformaNo->SetValue($NoTrans);
	$Quotation_H_ID = CCGetFromGet("Quotation_H_ID", 0);
		if($Quotation_H_ID > 0){
			$sql = "SELECT Validity,ClientOrderRef,ClientID,AddressID,QuotationContactID,DeliveryAddressID,DeliveryContactID,PackagingCost,DeliveryTermID, DeliveryTimeID,PaymentTermID,Currency, SpecialInstruction 
			  FROM tbladminist_quotation_h WHERE Quotation_H_ID = $Quotation_H_ID";
			$NewConnection->query($sql);
			$Result = $NewConnection->next_record();
			if($Result){
				$AddNewHeader->Validity->SetValue($NewConnection->f("Validity"));
				$AddNewHeader->ClientOrderRef->SetValue($NewConnection->f("ClientOrderRef"));
				$AddNewHeader->ClientID->SetValue($NewConnection->f("ClientID"));
				$AddNewHeader->AddressID->SetValue($NewConnection->f("AddressID"));
				$AddNewHeader->DeliveryAddressID->SetValue($NewConnection->f("DeliveryAddressID"));
				$AddNewHeader->Attn->SetValue($NewConnection->f("QuotationContactID"));
				$AddNewHeader->DeliveryContactID->SetValue($NewConnection->f("DeliveryContactID"));
				$AddNewHeader->PackagingCost->SetValue($NewConnection->f("PackagingCost"));
				$AddNewHeader->DeliveryTime->SetValue($NewConnection->f("DeliveryTimeID"));
				$AddNewHeader->DeliveryTerm->SetValue($NewConnection->f("DeliveryTermID"));
				$AddNewHeader->PaymentTerm->SetValue($NewConnection->f("PaymentTermID"));
				$AddNewHeader->SpecialInstruction->SetValue($NewConnection->f("SpecialInstruction"));
				$AddNewHeader->Currency->SetValue($NewConnection->f("Currency"));
			}
			$AddNewHeader->Quotation_H_ID->SetValue($Quotation_H_ID);
		}

}else{//to handle the revision
	$AddNewHeader->LinkRev->Visible = true;
	$Proforma_H_ID = CCGetFromGet("Proforma_H_ID",0);
	if($Proforma_H_ID > 0){
		$sqlquery = "SELECT Rev FROM tblAdminist_Proforma_H WHERE Proforma_H_ID = ".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger);
		$NewConnection->query($sqlquery);
		$Result = $NewConnection->next_record();
		if($Result){
			$AddNewHeader->Revis->Visible = true;
		}
	}		
}
//Isi quot address & delivery address
$AddressID = CCGetFromGet("AddressID",0);
$DeliveryAddressID = CCGetFromGet("DeliveryAddressID",0);
//$Container->SpecialInstruction->SetValue($AddressID);
if ($AddressID > 0){
  $Container->lblAddress->Visible = true;
  $Container->AddressID->Visible = false;
  $Container->lblAddress->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$NewConnection->ToSQL($AddressID,ccsInteger),$NewConnection));
}else{
  $Container->lblAddress->Visible = false;
  $Container->AddressID->Visible = true;
}
if ($DeliveryAddressID > 0){
  $Container->lblDeliveryAddress->Visible = true;
  $Container->DeliveryAddressID->Visible = false;
  $Container->lblDeliveryAddress->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$NewConnection->ToSQL($DeliveryAddressID,ccsInteger),$NewConnection));
}else{
  $Container->lblDeliveryAddress->Visible = false;
  $Container->DeliveryAddressID->Visible = true;
}
//to handle the address-attn
$ProformaContactID = CCGetFromGet("ProformaContactID",0);
if($ProformaContactID > 0){
	$AddNewHeader->Attn->Visible = false;
	$AddNewHeader->lblAttn->Visible = true;//lblattn = quotationcontactname
	$AddNewHeader->LinkChange->Visible = true;
	$addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$NewConnection->ToSQL($ProformaContactID,ccsInteger);
	$NewConnection->query($addquery);
	$Result = $NewConnection->next_record();
	if($Result){
		$company = $NewConnection->f("Company");
		$contactname = $NewConnection->f("ContactName");
		$email = $NewConnection->f("Email");
		$address = $NewConnection->f("Address");
		$phone = $NewConnection->f("Phone");
		$fax = $NewConnection->f("Fax");
	}
	$NewConnection->close;
	//show the value
	$AddNewHeader->lblAttn->SetValue($contactname);
	$AddNewHeader->Email->SetValue($email);
	$AddNewHeader->Address->SetValue($address);
	$AddNewHeader->Phone->SetValue($phone);
	$AddNewHeader->Fax->SetValue($fax);
}
else{
	$AddNewHeader->Attn->Visible = true;
	$AddNewHeader->lblAttn->Visible = false;
	$AddNewHeader->LinkChange->Visible = false;
}
$DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
if ($DeliveryContactID > 0){
$NewConnection = new clsDBGayaFusionAll;
  $AddNewHeader->DeliveryContactID->Visible= false;
  $AddNewHeader->lblDeliveryAddressContact->Visible=true;
  $AddNewHeader->LinkChangeDeliveryContact->Visible=true;
  $addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$DeliveryContactID;
  $NewConnection->query($addquery);
  $Result = $NewConnection->next_record();
  if($Result){
	$company = $NewConnection->f("Company");
	$contactname = $NewConnection->f("ContactName");
	$address = $NewConnection->f("Address");
	$email = $NewConnection->f("Email");
	$phone = $NewConnection->f("Phone");
	$fax = $NewConnection->f("Fax");
  }
  $NewConnection->close;
  $AddNewHeader->lblDeliveryContactID->SetValue($contactname);
  $AddNewHeader->DeliveryEmail->SetValue($email);
  $AddNewHeader->DeliveryAddress->SetValue($address);
  $AddNewHeader->DeliveryPhone->SetValue($phone);
  $AddNewHeader->DeliveryFax->SetValue($fax);
}else{
  $AddNewHeader->DeliveryContactID->Visible= true;
  $AddNewHeader->lblDeliveryContactID->Visible=false;
  $AddNewHeader->LinkChangeDeliveryContact->Visible=false;
$NewConnection->close();
}
//End Custom Code

//Close AddNewHeader_BeforeShow @2-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_AfterInsert @2-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @374-2A29BDB7
$db = new clsDBGayaFusionAll();
global $Redirect,$FileName;

$ClientID = $AddNewHeader->ClientID->GetValue();
$predate = $AddNewHeader->PreviewDPDate->GetValue();
$Proforma_H_ID = CCDLookUp("last_insert_id()","tblAdminist_Proforma_H","",$db);
$Quotation_H_ID = $AddNewHeader->Quotation_H_ID->GetValue();
$AddressID = $AddNewHeader->AddressID->GetValue();
$ContactID = $AddNewHeader->Attn->GetValue();
$DeliveryAddressID = $AddNewHeader->DeliveryAddressID->GetValue();
$DeliveryContactID = $AddNewHeader->DeliveryContactID->GetValue();
//$AddNewHeader->AddressIDAdd->SetValue($Quotation_H_ID);
$CurrencyID = $AddNewHeader->Currency->GetValue();
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$db->ToSQL($CurrencyID,ccsInteger),$db);

//if($Quotation_H_ID > 0) $db->query("UPDATE tblAdminist_Proforma_H SET AddressID = ".$db->ToSQL($AddressID,ccsInteger).",ContactID = ".$db->ToSQL($ContactID, ccsInteger)." WHERE Proforma_H_ID = ".$db->ToSQL($Proforma_H_ID,ccsInteger));

$sql = "INSERT INTO ar_proforma (Client_ID, Proforma_H_ID, pre_date,Currency,Rate) VALUES (".$db->ToSQL($ClientID,csInteger).",". $db->ToSQL($Proforma_H_ID,ccsInteger).",". $db->ToSQL($predate,ccsDate).",".$db->ToSQL($CurrencyID,ccsInteger).",".$db->ToSQL($CurrencyRate,ccsFloat).")";
$db->query($sql);
		
$ContactID = CCDLookUp("ContactID","tblAdminist_Proforma_H","Proforma_H_ID = ".$db->ToSQL($Proforma_H_ID,ccsInteger),$db);
$Redirect = $FileName."?Proforma_H_ID=".$Proforma_H_ID."&ContactID=".$ContactID;//CCDLookUp("max(Proforma_H_ID)","tblAdminist_Proforma_H","", $DBGayaFusionAll);
$db->close();
//End Custom Code

//Close AddNewHeader_AfterInsert @2-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewHeader_BeforeDelete @2-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @375-2A29BDB7
$Proforma_H_ID = CCGetFromGet("Proforma_H_ID",0);
if(intval($Proforma_H_ID) >0){
//Create a new database connection object
	$NewConnection = new clsDBGayaFusionAll();
	$NewConnection->query("DELETE FROM tblAdminist_Proforma_D WHERE Proforma_H_ID=".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
	$NewConnection->query("DELETE FROM ar_proforma WHERE Proforma_H_ID = ".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
}
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @2-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_ds_BeforeBuildInsert @2-D3DAC484
function AddNewHeader_ds_BeforeBuildInsert(& $sender)
{
    $AddNewHeader_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_ds_BeforeBuildInsert

//Custom Code @383-2A29BDB7
$PrevDpDate = $AddNewHeader->PreviewDPDate->GetValue();
$NowDate = $AddNewHeader->ProformaDate->GetValue();
if($PrevDpDate < $NowDate){
	$AddNewHeader->Errors->addError("Preview Deposit Date Can Not Smaller Than Proforma Date");
}
//End Custom Code

//Close AddNewHeader_ds_BeforeBuildInsert @2-27820F79
    return $AddNewHeader_ds_BeforeBuildInsert;
}
//End Close AddNewHeader_ds_BeforeBuildInsert

//AddNewHeader_AfterUpdate @2-D4CE57C7
function AddNewHeader_AfterUpdate(& $sender)
{
    $AddNewHeader_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterUpdate

//Custom Code @384-2A29BDB7
$db = new clsDBGayaFusionAll;
$ClientID = $AddNewHeader->ClientID->GetValue();
$predate = $AddNewHeader->PreviewDPDate->GetValue();
$proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
$CurrencyID = $AddNewHeader->Currency->GetValue();
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$db->ToSQL($CurrencyID,ccsInteger),$db);
$sql = "UPDATE ar_proforma SET Client_ID = ".$db->ToSQL($ClientID,ccsInteger).", pre_date = ".$db->ToSQL($predate,ccsDate).", Currency = ".$db->ToSQL($CurrencyID,ccsInteger).", Rate = ".$db->ToSQL($CurrencyRate,ccsFloat)." WHERE proforma_H_ID = ".$db->ToSQL($proforma_H_ID,ccsInteger);
$db->query($sql);
$db->close();
//End Custom Code

//Close AddNewHeader_AfterUpdate @2-9A0A8CA3
    return $AddNewHeader_AfterUpdate;
}
//End Close AddNewHeader_AfterUpdate


//AddNewDetail_BeforeShowRow @197-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @234-2A29BDB7
global $AddNewDetail;
global $RowNumber;
global $DBGayaFusionAll;    
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
$CollectID = $AddNewDetail->CollectID->GetValue();
$DBGayaFusionAll->query("SELECT DesignCode, NameCode, CategoryCode, SizeCode, TextureCode, ColorCode, MaterialCode FROM tblCollect_Master
	WHERE ID = ".$DBGayaFusionAll->ToSQL($CollectID,ccsInteger));
$Result = $DBGayaFusionAll->next_record();
if($Result){
	$DesignCode = $DBGayaFusionAll->f("DesignCode");
	$NameCode = $DBGayaFusionAll->f("NameCode");
	$CategoryCode = $DBGayaFusionAll->f("CategoryCode");
	$SizeCode = $DBGayaFusionAll->f("SizeCode");
	$TextureCode = $DBGayaFusionAll->f("TextureCode");
	$ColorCode = $DBGayaFusionAll->f("ColorCode");
	$MaterialCode = $DBGayaFusionAll->f("MaterialCode");
}
$DB = new clsDBGayaFusionAll;
$query = "SELECT CategoryName, ColorName, DesignName, MaterialName, NameDesc, SizeName, TextureName 
FROM ((((((tblcollect_master INNER JOIN tblcollect_category ON
tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON
tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON
tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON
tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON
tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON
tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON
tblcollect_master.MaterialCode = tblcollect_material.MaterialCode
WHERE tblcollect_color.ColorCode = ".$DB->ToSQL($ColorCode, ccsText)." AND tblcollect_category.CategoryCode = ".$DB->ToSQL($CategoryCode,ccsText).
" AND tblcollect_design.DesignCode = ".$DB->ToSQL($DesignCode,ccsText)." AND tblcollect_material.MaterialCode = ".$DB->ToSQL($MaterialCode,ccsText).
" AND tblcollect_texture.TextureCode = ".$DB->ToSQL($TextureCode,ccsText)." AND tblcollect_size.SizeCode = ".$DB->ToSQL($SizeCode,ccsText).
" AND tblcollect_name.NameCode = ". $DB->ToSQL($NameCode, ccsText)." AND tblcollect_master.ID = ".$DB->ToSQL($CollectID, ccsInteger);
$DB->query($query);
$Result = $DB->next_record();
if($Result){
	$AddNewDetail->Design->SetValue($DB->f("DesignName"));
	$AddNewDetail->NameDesc->SetValue($DB->f("NameDesc"));
	$AddNewDetail->Category->SetValue($DB->f("CategoryName"));
	$AddNewDetail->Size->SetValue($DB->f("SizeName"));
	$AddNewDetail->Texture->SetValue($DB->f("TextureName"));
	$AddNewDetail->Color->SetValue($DB->f("ColorName"));
	$AddNewDetail->Material->SetValue($DB->f("MaterialName"));
}
$DB->close();
//End Custom Code

//Close AddNewDetail_BeforeShowRow @197-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @197-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @329-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = intval(CCGetFromGet("Proforma_H_ID",0));
if($Proforma_H_ID > 0){
  $AddNewDetail->ds->Proforma_H_ID->SetValue($Proforma_H_ID);
 }
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @197-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

//Page_BeforeInitialize @1-78E34480
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddProforma; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill3 Initialization @152-6100ECBD
    if ('AddNewHeaderAttnPTAutoFill3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill3 Initialization

//PTAutoFill3 DataSource @152-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill3 DataSource

//PTAutoFill3 DataFields @152-22D517C6
        $Service->AddDataSourceField('Email',ccsText,"");
        $Service->AddDataSourceField('Address',ccsText,"");
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccsText,"");
//End PTAutoFill3 DataFields

//PTAutoFill3 Execution @152-028A6C4C
        echo $Service->Execute();
//End PTAutoFill3 Execution

//PTAutoFill3 Loading @152-27890EF8
        exit;
    }
//End PTAutoFill3 Loading

//PTAutoFill1 Initialization @357-1EF0410B
    if ('AddNewHeaderDeliveryContactIDPTAutoFill1' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill1 Initialization

//PTAutoFill1 DataSource @357-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill1 DataSource

//PTAutoFill1 DataFields @357-6021879F
        $Service->AddDataSourceField('Address',ccsInteger,"");
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccsFloat,"");
        $Service->AddDataSourceField('Email',ccsText,"");
//End PTAutoFill1 DataFields

//PTAutoFill1 Execution @357-028A6C4C
        echo $Service->Execute();
//End PTAutoFill1 Execution

//PTAutoFill1 Loading @357-27890EF8
        exit;
    }
//End PTAutoFill1 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize
?>