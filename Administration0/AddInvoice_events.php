<?php
//BindEvents Method @1-19090E62
function BindEvents()
{
    global $AddNewHeader;
    global $AddNewDetail;
    $AddNewHeader->LinkChangeInvoiceContact->CCSEvents["BeforeShow"] = "AddNewHeader_LinkChangeInvoiceContact_BeforeShow";
    $AddNewHeader->LinkChangeDeliveryContact->CCSEvents["BeforeShow"] = "AddNewHeader_LinkChangeDeliveryContact_BeforeShow";
    $AddNewHeader->PackagingCost->CCSEvents["BeforeShow"] = "AddNewHeader_PackagingCost_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeShow"] = "AddNewHeader_BeforeShow";
    $AddNewHeader->CCSEvents["BeforeDelete"] = "AddNewHeader_BeforeDelete";
    $AddNewHeader->CCSEvents["AfterUpdate"] = "AddNewHeader_AfterUpdate";
    $AddNewDetail->CCSEvents["BeforeShowRow"] = "AddNewDetail_BeforeShowRow";
    $AddNewDetail->ds->CCSEvents["BeforeBuildInsert"] = "AddNewDetail_ds_BeforeBuildInsert";
}
//End BindEvents Method

//AddNewHeader_LinkChangeInvoiceContact_BeforeShow @32-1503C482
function AddNewHeader_LinkChangeInvoiceContact_BeforeShow(& $sender)
{
    $AddNewHeader_LinkChangeInvoiceContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_LinkChangeInvoiceContact_BeforeShow

//Custom Code @120-2A29BDB7
$Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
$DeliveryContactID = CCGetFromGet("DeliveryContactID","");
$AddressID = $AddNewHeader->AddressID->GetValue();
$AddNewHeader->LinkChangeInvoiceContact->SetLink("AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&DeliveryContactID=".$DeliveryContactID."&AddressID=".$AddressID);
//End Custom Code

//Close AddNewHeader_LinkChangeInvoiceContact_BeforeShow @32-3C971C0B
    return $AddNewHeader_LinkChangeInvoiceContact_BeforeShow;
}
//End Close AddNewHeader_LinkChangeInvoiceContact_BeforeShow

//AddNewHeader_LinkChangeDeliveryContact_BeforeShow @36-DE7092C3
function AddNewHeader_LinkChangeDeliveryContact_BeforeShow(& $sender)
{
    $AddNewHeader_LinkChangeDeliveryContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_LinkChangeDeliveryContact_BeforeShow

//Custom Code @121-2A29BDB7
$Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
$InvoiceContactID = CCGetFromGet("InvoiceContactID","");
$AddressID = $AddNewHeader->AddressID->GetValue();
$AddNewHeader->LinkChangeDeliveryContact->SetLink("AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&InvoiceContactID=".$InvoiceContactID."&AddressID=".$AddressID);
//End Custom Code

//Close AddNewHeader_LinkChangeDeliveryContact_BeforeShow @36-A623217D
    return $AddNewHeader_LinkChangeDeliveryContact_BeforeShow;
}
//End Close AddNewHeader_LinkChangeDeliveryContact_BeforeShow

//AddNewHeader_PackagingCost_BeforeShow @95-41DC297E
function AddNewHeader_PackagingCost_BeforeShow(& $sender)
{
    $AddNewHeader_PackagingCost_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_PackagingCost_BeforeShow

//Custom Code @96-2A29BDB7

if(!$AddNewHeader->EditMode){
	global $DBGayaFusionAll;
	$Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
	if($Proforma_H_ID > 0){
		$AddNewHeader->PackagingCost->SetValue(CCDLookUp("PackagingCost","tblAdminist_Proforma_H","Proforma_H_ID = $Proforma_H_ID",$DBGayaFusionAll));
	}else{
		$AddNewHeader->PackagingCost->SetValue("0");
	}
}
//End Custom Code

//Close AddNewHeader_PackagingCost_BeforeShow @95-ED814858
    return $AddNewHeader_PackagingCost_BeforeShow;
}
//End Close AddNewHeader_PackagingCost_BeforeShow

//AddNewHeader_BeforeShow @2-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @50-2A29BDB7
global $AddNewHeader, $AddNewDetail;
global $DBGayaFusionAll;

//$AddNewHeader->Label1->SetValue(CCGetFromGet("sql",""));
//if(!$AddNewHeader->EditMode){
//  $AddNewDetail->Visible=false;
//}
$InvoiceContactID = CCGetFromGet("InvoiceContactID","");
if($InvoiceContactID == "") $AddNewDetail->Visible = false;

$Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
//$InvoiceNo = CCDLookUp("InvoiceNo","tblAdminist_Invoice_h","Invoice_H_ID=".$Invoice_H_ID,$DBGayaFusionAll);
//$Proforma_H_ID = CCDLookUp("Proforma_H_ID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
//$CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//$AddNewHeader->InvoiceNo->SetValue($InvoiceNo);
//$AddNewHeader->Proforma_H_ID->SetValue($Proforma_H_ID);
//$AddNewHeader->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));

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

//Custom Code @81-2A29BDB7
$Invoice_H_ID = CCGetFromGet("Invoice_H_ID",0);	
   
if(intval($Invoice_H_ID) >0){
//Create a new database connection object
  $NewConnection = new clsDBGayaFusionAll();
  $NewConnection->query("DELETE FROM tblAdminist_Invoice_D WHERE Invoice_H_ID=".$NewConnection->ToSQL($Invoice_H_ID,ccsInteger));
}
//Close and destroy the database connection object
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @2-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterUpdate @2-D4CE57C7
function AddNewHeader_AfterUpdate(& $sender)
{
    $AddNewHeader_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterUpdate

//Custom Code @119-2A29BDB7
global $DBGayaFusionAll;
global $Redirect,$FileName;

$Invoice_H_ID = $AddNewHeader->Invoice_H_ID->GetValue();
$Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
$ClientID = $AddNewHeader->ClientID->GetValue();
if($Proforma_H_ID == "") ($Proforma_H_ID = 0);
$DueDate = CCDLookUp("duedate","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll);
$sql = "UPDATE ar_Invoice SET ClientID = ".$DBGayaFusionAll->ToSQL($ClientID,csInteger).",due_date = ".$DBGayaFusionAll->ToSQL($DueDate,ccsDate).",Currency=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger).",Rate=".$DBGayaFusionAll->ToSQL($CurrencyRate,ccsFloat)." WHERE Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger);
$DBGayaFusionAll->query($sql);

$InvoiceContactID = CCDLookUp("InvoiceContactID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$DeliveryContactID = CCDLookUp("DeliveryContactID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
$Redirect = $FileName."?Invoice_H_ID=".$Invoice_H_ID."&InvoiceContactID=".$InvoiceContactID."&DeliveryContactID=".$DeliveryContactID;
//End Custom Code

//Close AddNewHeader_AfterUpdate @2-9A0A8CA3
    return $AddNewHeader_AfterUpdate;
}
//End Close AddNewHeader_AfterUpdate

//AddNewDetail_BeforeShowRow @51-E5384DC1
function AddNewDetail_BeforeShowRow(& $sender)
{
    $AddNewDetail_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_BeforeShowRow

//Custom Code @72-2A29BDB7
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

//Close AddNewDetail_BeforeShowRow @51-3351FC09
    return $AddNewDetail_BeforeShowRow;
}
//End Close AddNewDetail_BeforeShowRow

//AddNewDetail_ds_BeforeBuildInsert @51-537ADC74
function AddNewDetail_ds_BeforeBuildInsert(& $sender)
{
    $AddNewDetail_ds_BeforeBuildInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewDetail; //Compatibility
//End AddNewDetail_ds_BeforeBuildInsert

//Custom Code @73-2A29BDB7
global $AddNewDetail;
$Invoice_H_ID = intval(CCGetFromGet("Invoice_H_ID",0));
if($Invoice_H_ID > 0){
  $AddNewDetail->ds->Invoice_H_ID->SetValue($Invoice_H_ID);
}
//End Custom Code

//Close AddNewDetail_ds_BeforeBuildInsert @51-88ED8B8D
    return $AddNewDetail_ds_BeforeBuildInsert;
}
//End Close AddNewDetail_ds_BeforeBuildInsert

?>