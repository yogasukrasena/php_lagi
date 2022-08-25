<?php
session_start();
//BindEvents Method @1-A3352AFD
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

//AddNewHeader_DeliveryContactID_BeforeShow @172-45B16C9D
function AddNewHeader_DeliveryContactID_BeforeShow(& $sender)
{
    $AddNewHeader_DeliveryContactID_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_DeliveryContactID_BeforeShow

//Close AddNewHeader_DeliveryContactID_BeforeShow @172-3346C6E3
    return $AddNewHeader_DeliveryContactID_BeforeShow;
}
//End Close AddNewHeader_DeliveryContactID_BeforeShow

//AddNewHeader_BeforeShow @142-F3C590C7
function AddNewHeader_BeforeShow(& $sender)
{
    $AddNewHeader_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeShow

//Custom Code @197-2A29BDB7
global $AddNewDetail;
$InvoiceContactID = CCGetFromGet("InvoiceContactID","");
if($InvoiceContactID == "") $AddNewDetail->Visible = false;
//$Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");

//Isi quot address & delivery address
$AddressID = CCGetFromGet("AddressID",0);
$DeliveryAddressID = CCGetFromGet("DeliveryAddressID",0);
//$Container->SpecialInstruction->SetValue($AddressID);
$NewConnection = new clsDBGayaFusionAll();
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
$NewConnection->close();
//to handle the address-attn
$InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
if($InvoiceContactID > 0){
	$NewConnection = new clsDBGayaFusionAll();
	$AddNewHeader->Attn->Visible = false;
	$AddNewHeader->lblAttn->Visible = true;//lblattn = quotationcontactname
	$AddNewHeader->LinkChange->Visible = true;
	$addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$NewConnection->ToSQL($InvoiceContactID,ccsInteger);
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

//Close AddNewHeader_BeforeShow @142-57E968BE
    return $AddNewHeader_BeforeShow;
}
//End Close AddNewHeader_BeforeShow

//AddNewHeader_AfterInsert @142-A55E4721
function AddNewHeader_AfterInsert(& $sender)
{
    $AddNewHeader_AfterInsert = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterInsert

//Custom Code @198-2A29BDB7
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

//Close AddNewHeader_AfterInsert @142-55234D2C
    return $AddNewHeader_AfterInsert;
}
//End Close AddNewHeader_AfterInsert

//AddNewHeader_BeforeDelete @142-5BB1DF18
function AddNewHeader_BeforeDelete(& $sender)
{
    $AddNewHeader_BeforeDelete = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_BeforeDelete

//Custom Code @199-2A29BDB7
$Proforma_H_ID = CCGetFromGet("Proforma_H_ID",0);
if(intval($Proforma_H_ID) >0){
//Create a new database connection object
	$NewConnection = new clsDBGayaFusionAll();
	$NewConnection->query("DELETE FROM tblAdminist_Proforma_D WHERE Proforma_H_ID=".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
	$NewConnection->query("DELETE FROM ar_proforma WHERE Proforma_H_ID = ".$NewConnection->ToSQL($Proforma_H_ID,ccsInteger));
}
$NewConnection->close();
//End Custom Code

//Close AddNewHeader_BeforeDelete @142-30AF98EE
    return $AddNewHeader_BeforeDelete;
}
//End Close AddNewHeader_BeforeDelete

//AddNewHeader_AfterUpdate @142-D4CE57C7
function AddNewHeader_AfterUpdate(& $sender)
{
    $AddNewHeader_AfterUpdate = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddNewHeader; //Compatibility
//End AddNewHeader_AfterUpdate

//Custom Code @201-2A29BDB7
$db = new clsDBGayaFusionAll;
$ClientID = $AddNewHeader->ClientID->GetValue();
$predate = $AddNewHeader->PreviewDPDate->GetValue();
$proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
$CurrencyID = $AddNewHeader->CurrencyID->GetValue();
$CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$db->ToSQL($CurrencyID,ccsInteger),$db);
$sql = "UPDATE ar_proforma SET Client_ID = ".$db->ToSQL($ClientID,ccsInteger).", pre_date = ".$db->ToSQL($predate,ccsDate).", Currency = ".$db->ToSQL($CurrencyID,ccsInteger).", Rate = ".$db->ToSQL($CurrencyRate,ccsFloat)." WHERE proforma_H_ID = ".$db->ToSQL($proforma_H_ID,ccsInteger);
$db->query($sql);
$db->close();
//End Custom Code

//Close AddNewHeader_AfterUpdate @142-9A0A8CA3
    return $AddNewHeader_AfterUpdate;
}
//End Close AddNewHeader_AfterUpdate

//DEL  $Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
//DEL  $DeliveryContactID = CCGetFromGet("DeliveryContactID","");
//DEL  $AddressID = $AddNewHeader->AddressID->GetValue();
//DEL  $AddNewHeader->LinkChangeInvoiceContact->SetLink("AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&DeliveryContactID=".$DeliveryContactID."&AddressID=".$AddressID);

//DEL  $Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
//DEL  $InvoiceContactID = CCGetFromGet("InvoiceContactID","");
//DEL  $AddressID = $AddNewHeader->AddressID->GetValue();
//DEL  $AddNewHeader->LinkChangeDeliveryContact->SetLink("AddInvoice.php?Invoice_H_ID=".$Invoice_H_ID."&InvoiceContactID=".$InvoiceContactID."&AddressID=".$AddressID);

//DEL  
//DEL  if(!$AddNewHeader->EditMode){
//DEL  	global $DBGayaFusionAll;
//DEL  	$Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
//DEL  	if($Proforma_H_ID > 0){
//DEL  		$AddNewHeader->PackagingCost->SetValue(CCDLookUp("PackagingCost","tblAdminist_Proforma_H","Proforma_H_ID = $Proforma_H_ID",$DBGayaFusionAll));
//DEL  	}else{
//DEL  		$AddNewHeader->PackagingCost->SetValue("0");
//DEL  	}
//DEL  }

//DEL  global $AddNewHeader, $AddNewDetail;
//DEL  global $DBGayaFusionAll;
//DEL  
//DEL  //$AddNewHeader->Label1->SetValue(CCGetFromGet("sql",""));
//DEL  //if(!$AddNewHeader->EditMode){
//DEL  //  $AddNewDetail->Visible=false;
//DEL  //}
//DEL  $InvoiceContactID = CCGetFromGet("InvoiceContactID","");
//DEL  if($InvoiceContactID == "") $AddNewDetail->Visible = false;
//DEL  
//DEL  $Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");
//DEL  //$InvoiceNo = CCDLookUp("InvoiceNo","tblAdminist_Invoice_h","Invoice_H_ID=".$Invoice_H_ID,$DBGayaFusionAll);
//DEL  //$Proforma_H_ID = CCDLookUp("Proforma_H_ID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger), $DBGayaFusionAll);
//DEL  //$CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  //$AddNewHeader->InvoiceNo->SetValue($InvoiceNo);
//DEL  //$AddNewHeader->Proforma_H_ID->SetValue($Proforma_H_ID);
//DEL  //$AddNewHeader->lblCurrency->SetValue(CCDLookUp("Currency","tblAdminist_Currency","CurrencyID=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll));
//DEL  
//DEL  $AddressID = CCGetFromGet("InvoiceAddressID",0);
//DEL  $DeliveryAddressID = CCGetFromGet("DeliveryAddressID",0);
//DEL  $NewConnection = new clsDBGayaFusionAll();
//DEL  if ($AddressID > 0){
//DEL    $Container->lblAddress->Visible = true;
//DEL    $Container->AddressID->Visible = false;
//DEL    $Container->lblAddress->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$NewConnection->ToSQL($AddressID,ccsInteger),$NewConnection));
//DEL  }else{
//DEL    $Container->lblAddress->Visible = false;
//DEL    $Container->AddressID->Visible = true;
//DEL  }
//DEL  if ($DeliveryAddressID > 0){
//DEL    $Container->lblDeliveryAddress->Visible = true;
//DEL    $Container->DeliveryAddressID->Visible = false;
//DEL    $Container->lblDeliveryAddress->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$NewConnection->ToSQL($DeliveryAddressID,ccsInteger),$NewConnection));
//DEL  }else{
//DEL    $Container->lblDeliveryAddress->Visible = false;
//DEL    $Container->DeliveryAddressID->Visible = true;
//DEL  }
//DEL  $NewConnection->close();
//DEL  //to handle the address-attn
//DEL  $InvoiceContactID = CCGetFromGet("InvoiceContactID",0);
//DEL  if($InvoiceContactID > 0){
//DEL    $NewConnection = new clsDBGayaFusionAll;
//DEL    $AddNewHeader->InvoiceAddressContact->Visible=false;
//DEL    $AddNewHeader->lblInvoiceAddressContact->Visible=true;
//DEL    $AddNewHeader->LinkChangeInvoiceContact->Visible = true;
//DEL    $addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$InvoiceContactID;
//DEL    $NewConnection->query($addquery);
//DEL    $Result = $NewConnection->next_record();
//DEL    if($Result){
//DEL  	$company = $NewConnection->f("Company");
//DEL  	$contactname = $NewConnection->f("ContactName");
//DEL  	$address = $NewConnection->f("Address");
//DEL  	$phone = $NewConnection->f("Phone");
//DEL  	$fax = $NewConnection->f("Fax");
//DEL    }
//DEL    $NewConnection->close;
//DEL    $AddNewHeader->lblInvoiceAddressContact->SetValue($contactname);
//DEL    $AddNewHeader->InvoiceAddress->SetValue($address);
//DEL    $AddNewHeader->InvoicePhone->SetValue($phone);
//DEL    $AddNewHeader->InvoiceFax->SetValue($fax);
//DEL  }else{
//DEL    $AddNewHeader->InvoiceAddressContact->Visible= true;
//DEL    $AddNewHeader->lblInvoiceAddressContact->Visible= false;
//DEL    $AddNewHeader->LinkChangeInvoiceContact->Visible=false;
//DEL  }
//DEL  
//DEL  $DeliveryContactID = CCGetFromGet("DeliveryContactID",0);
//DEL  if($DeliveryContactID > 0){
//DEL    $NewConnection = new clsDBGayaFusionAll;
//DEL    $AddNewHeader->DeliveryAddressContact->Visible= false;
//DEL    $AddNewHeader->lblDeliveryAddressContact->Visible=true;
//DEL    $AddNewHeader->LinkChangeDeliveryContact->Visible=true;
//DEL    $addquery = "SELECT tblAdminist_AddressBook_Contact.*, tblAdminist_AddressBook.* FROM tblAdminist_AddressBook_Contact INNER JOIN tblAdminist_AddressBook ON tblAdminist_AddressBook_Contact.AddressID = tblAdminist_AddressBook.AddressID WHERE ContactID = ".$DeliveryContactID;
//DEL    $NewConnection->query($addquery);
//DEL    $Result = $NewConnection->next_record();
//DEL    if($Result){
//DEL  	$company = $NewConnection->f("Company");
//DEL  	$contactname = $NewConnection->f("ContactName");
//DEL  	$address = $NewConnection->f("Address");
//DEL  	$phone = $NewConnection->f("Phone");
//DEL  	$fax = $NewConnection->f("Fax");
//DEL    }
//DEL    $NewConnection->close;
//DEL    $AddNewHeader->lblDeliveryAddressContact->SetValue($contactname);
//DEL    $AddNewHeader->DeliveryAddress->SetValue($address);
//DEL    $AddNewHeader->DeliveryPhone->SetValue($phone);
//DEL    $AddNewHeader->DeliveryFax->SetValue($fax);
//DEL  }else{
//DEL    $AddNewHeader->DeliveryAddressContact->Visible= true;
//DEL    $AddNewHeader->lblDeliveryAddressContact->Visible=false;
//DEL    $AddNewHeader->LinkChangeDeliveryContact->Visible=false;
//DEL  }

//DEL  $Invoice_H_ID = CCGetFromGet("Invoice_H_ID",0);	
//DEL     
//DEL  if(intval($Invoice_H_ID) >0){
//DEL  //Create a new database connection object
//DEL    $NewConnection = new clsDBGayaFusionAll();
//DEL    $NewConnection->query("DELETE FROM tblAdminist_Invoice_D WHERE Invoice_H_ID=".$NewConnection->ToSQL($Invoice_H_ID,ccsInteger));
//DEL  }
//DEL  //Close and destroy the database connection object
//DEL  $NewConnection->close();

//DEL  global $DBGayaFusionAll;
//DEL  global $Redirect,$FileName;
//DEL  
//DEL  $Invoice_H_ID = $AddNewHeader->Invoice_H_ID->GetValue();
//DEL  $Proforma_H_ID = $AddNewHeader->Proforma_H_ID->GetValue();
//DEL  $ClientID = $AddNewHeader->ClientID->GetValue();
//DEL  if($Proforma_H_ID == "") ($Proforma_H_ID = 0);
//DEL  $DueDate = CCDLookUp("duedate","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $CurrencyID = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $CurrencyRate = CCDLookUp("Rate","tblAdminist_Currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger),$DBGayaFusionAll);
//DEL  $sql = "UPDATE ar_Invoice SET ClientID = ".$DBGayaFusionAll->ToSQL($ClientID,csInteger).",due_date = ".$DBGayaFusionAll->ToSQL($DueDate,ccsDate).",Currency=".$DBGayaFusionAll->ToSQL($CurrencyID,ccsInteger).",Rate=".$DBGayaFusionAll->ToSQL($CurrencyRate,ccsFloat)." WHERE Invoice_H_ID=".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger);
//DEL  $DBGayaFusionAll->query($sql);
//DEL  
//DEL  $InvoiceContactID = CCDLookUp("InvoiceContactID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $DeliveryContactID = CCDLookUp("DeliveryContactID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID,ccsInteger),$DBGayaFusionAll);
//DEL  $Redirect = $FileName."?Invoice_H_ID=".$Invoice_H_ID."&InvoiceContactID=".$InvoiceContactID."&DeliveryContactID=".$DeliveryContactID;

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

//DEL  $PrevDpDate = $AddNewHeader->PreviewDPDate->GetValue();
//DEL  $NowDate = $AddNewHeader->ProformaDate->GetValue();
//DEL  if($PrevDpDate < $NowDate){
//DEL  	$AddNewHeader->Errors->addError("Preview Deposit Date Can Not Smaller Than Proforma Date");
//DEL  }

//Page_BeforeInitialize @1-5B8BE094
function Page_BeforeInitialize(& $sender)
{
    $Page_BeforeInitialize = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $AddInvoice; //Compatibility
//End Page_BeforeInitialize

//PTAutoFill2 Initialization @155-149F2A20
    if ('AddNewHeaderAttnPTAutoFill2' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill2 Initialization

//PTAutoFill2 DataSource @155-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill2 DataSource

//PTAutoFill2 DataFields @155-360D0E95
        $Service->AddDataSourceField('Email',ccs,"");
        $Service->AddDataSourceField('Address',ccs,"");
        $Service->AddDataSourceField('Phone',ccsText,"");
        $Service->AddDataSourceField('Fax',ccs,"");
//End PTAutoFill2 DataFields

//PTAutoFill2 Execution @155-028A6C4C
        echo $Service->Execute();
//End PTAutoFill2 Execution

//PTAutoFill2 Loading @155-27890EF8
        exit;
    }
//End PTAutoFill2 Loading

//PTAutoFill3 Initialization @176-F5CFCC31
    if ('AddNewHeaderDeliveryContactIDPTAutoFill3' == CCGetParam('callbackControl')) {
        $Service = new Service();
        $Service->SetFormatter(new JsonFormatter());
//End PTAutoFill3 Initialization

//PTAutoFill3 DataSource @176-3D3BDCAD
        $Service->DataSource = new clsDBGayaFusionAll();
        $Service->ds = & $Service->DataSource;
        $Service->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
        $Service->SetDataSourceQuery(CCBuildSQL($Service->DataSource->SQL, $Service->DataSource->Where, $Service->DataSource->Order));
//End PTAutoFill3 DataSource

//PTAutoFill3 DataFields @176-00E16AB5
        $Service->AddDataSourceField('Address',ccs,"");
        $Service->AddDataSourceField('Phone',ccs,"");
        $Service->AddDataSourceField('Fax',ccs,"");
        $Service->AddDataSourceField('Email',ccs,"");
//End PTAutoFill3 DataFields

//PTAutoFill3 Execution @176-028A6C4C
        echo $Service->Execute();
//End PTAutoFill3 Execution

//PTAutoFill3 Loading @176-27890EF8
        exit;
    }
//End PTAutoFill3 Loading

//Close Page_BeforeInitialize @1-23E6A029
    return $Page_BeforeInitialize;
}
//End Close Page_BeforeInitialize

?>