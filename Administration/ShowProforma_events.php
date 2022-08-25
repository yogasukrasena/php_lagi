<?php
session_start();
//BindEvents Method @1-E959A79E
function BindEvents()
{
    global $Detil;
    global $lblAdministrasi;
    global $lblCustomer;
    global $Header;
    $Detil->Total->CCSEvents["BeforeShow"] = "Detil_Total_BeforeShow";
    $Detil->lblCurrency->CCSEvents["BeforeShow"] = "Detil_lblCurrency_BeforeShow";
    $Detil->DocNotes->CCSEvents["BeforeShow"] = "Detil_DocNotes_BeforeShow";
    $Detil->ClientCode->CCSEvents["BeforeShow"] = "Detil_ClientCode_BeforeShow";
    $Detil->ClientDesc->CCSEvents["BeforeShow"] = "Detil_ClientDesc_BeforeShow";
    $Detil->CCSEvents["BeforeShowRow"] = "Detil_BeforeShowRow";
    $Detil->CCSEvents["BeforeShow"] = "Detil_BeforeShow";
    $lblAdministrasi->CCSEvents["BeforeShow"] = "lblAdministrasi_BeforeShow";
    $lblCustomer->CCSEvents["BeforeShow"] = "lblCustomer_BeforeShow";
    $Header->Client->CCSEvents["BeforeShow"] = "Header_Client_BeforeShow";
    $Header->Address->CCSEvents["BeforeShow"] = "Header_Address_BeforeShow";
    $Header->QuotationContact->CCSEvents["BeforeShow"] = "Header_QuotationContact_BeforeShow";
    $Header->DeliveryContact->CCSEvents["BeforeShow"] = "Header_DeliveryContact_BeforeShow";
    $Header->DeliveryTem->CCSEvents["BeforeShow"] = "Header_DeliveryTem_BeforeShow";
    $Header->DeliveryTime->CCSEvents["BeforeShow"] = "Header_DeliveryTime_BeforeShow";
    $Header->PaymentTerm->CCSEvents["BeforeShow"] = "Header_PaymentTerm_BeforeShow";
    $Header->DeliveryAddr->CCSEvents["BeforeShow"] = "Header_DeliveryAddr_BeforeShow";
}
//End BindEvents Method

//DEL  $ID = $Container->AddressID->GetValue();
//DEL  if(!$ID == ""){
//DEL    $db = new clsDBGayaFusionAll();
//DEL    $Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($ID,ccsInteger),$db));
//DEL    $db->close();
//DEL  }

//DEL  $ID = $Container->ContactID->GetValue();
//DEL  if(!$ID == ""){
//DEL    $db = new clsDBGayaFusionAll();
//DEL    $sql = "SELECT ContactName,Email,Address,Phone,Fax FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$db->ToSQL($ID,ccsInteger);
//DEL    $db->query($sql);
//DEL    $result = $db->next_record();
//DEL    if ($result){
//DEL      $Component->SetValue($db->f("Email"));
//DEL  	$Container->Address->SetValue($db->f("Address"));
//DEL  	$Container->ContactName->SetValue($db->f("ContactName"));
//DEL  	$Container->Phone->SetValue($db->f("Phone"));
//DEL  	$Container->Fax->SetValue($db->f("Fax"));
//DEL    }
//DEL    $db->close();
//DEL  }

//DEL  $ID = $Container->DeliveryTermID->GetValue();
//DEL  if(!$ID == ""){
//DEL    $db = new clsDBGayaFusionAll();
//DEL    $Component->SetValue(CCDLookUp("DeliveryTerm","tblAdminist_DeliveryTerm","DeliveryTermID = ".$db->ToSQL($ID,ccsInteger),$db));
//DEL    $db->close();
//DEL  }

//DEL  $ID = $Container->DeliveryTimeID->GetValue();
//DEL  if(!$ID == ""){
//DEL    $db = new clsDBGayaFusionAll();
//DEL    $Component->SetValue(CCDLookUp("DeliveryTime","tblAdminist_DeliveryTime","DeliveryTimeID = ".$db->ToSQL($ID,ccsInteger),$db));
//DEL    $db->close();
//DEL  }

//DEL  $ID = $Container->PaymentTermID->GetValue();
//DEL  if(!$ID == ""){
//DEL    $db = new clsDBGayaFusionAll();
//DEL    $Component->SetValue(CCDLookUp("PaymentTerm","tblAdminist_PaymentTerm","PaymentTermID = ".$db->ToSQL($ID,ccsInteger),$db));
//DEL    $db->close();
//DEL  }

//DEL  

//Detil_Total_BeforeShow @92-ED649264
function Detil_Total_BeforeShow(& $sender)
{
    $Detil_Total_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_Total_BeforeShow

//Custom Code @152-2A29BDB7
$UPrice = $Detil->UnitPrice->GetValue();
$Qty = $Detil->Qty->GetValue();
$Detil->Total->SetValue($UPrice * $Qty);
//End Custom Code

//Close Detil_Total_BeforeShow @92-FF2D58FA
    return $Detil_Total_BeforeShow;
}
//End Close Detil_Total_BeforeShow

//Detil_lblCurrency_BeforeShow @150-29090376
function Detil_lblCurrency_BeforeShow(& $sender)
{
    $Detil_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_lblCurrency_BeforeShow

//Custom Code @151-2A29BDB7
global $DBGayaFusionAll;
$proID = $Detil->Proforma_H_ID->GetValue();
$id = CCDLookUp("Currency","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($proID,ccsInteger),$DBGayaFusionAll);
$Detil->lblCurrency->SetValue(CCDLookUp("CurrencyCode","tbladminist_currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($id,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Detil_lblCurrency_BeforeShow @150-A25C728D
    return $Detil_lblCurrency_BeforeShow;
}
//End Close Detil_lblCurrency_BeforeShow

//Detil_DocNotes_BeforeShow @153-9F1BD73E
function Detil_DocNotes_BeforeShow(& $sender)
{
    $Detil_DocNotes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_DocNotes_BeforeShow

//Custom Code @154-2A29BDB7
include ("../settings.php");
$Detil->DocNotes->SetValue($cfg_DocNotes);
//End Custom Code

//Close Detil_DocNotes_BeforeShow @153-EB64B09F
    return $Detil_DocNotes_BeforeShow;
}
//End Close Detil_DocNotes_BeforeShow

//Detil_ClientCode_BeforeShow @196-DF692E63
function Detil_ClientCode_BeforeShow(& $sender)
{
    $Detil_ClientCode_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_ClientCode_BeforeShow

//Custom Code @198-2A29BDB7
$CollectID = $Detil->CollectID->GetValue();
$db = new clsDBGayaFusionAll();
$Detil->ClientCode->SetValue(CCDLookUp("ClientCode","tblCollect_Master","ID = ".$CollectID,$db));
$db->close();
//End Custom Code

//Close Detil_ClientCode_BeforeShow @196-9EBAB48E
    return $Detil_ClientCode_BeforeShow;
}
//End Close Detil_ClientCode_BeforeShow

//Detil_ClientDesc_BeforeShow @197-73558F1A
function Detil_ClientDesc_BeforeShow(& $sender)
{
    $Detil_ClientDesc_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_ClientDesc_BeforeShow

//Custom Code @199-2A29BDB7
$CollectID = $Detil->CollectID->GetValue();
$db = new clsDBGayaFusionAll();
$Detil->ClientDesc->SetValue(CCDLookUp("ClientDescription","tblCollect_Master","ID = ".$CollectID,$db));
$db->close();
//End Custom Code

//Close Detil_ClientDesc_BeforeShow @197-6D3AA90A
    return $Detil_ClientDesc_BeforeShow;
}
//End Close Detil_ClientDesc_BeforeShow

//Detil_BeforeShowRow @45-36388CCD
function Detil_BeforeShowRow(& $sender)
{
    $Detil_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_BeforeShowRow

//Custom Code @134-2A29BDB7
$Component->Attributes->SetValue('LocalRowNumber', $Component->RowNumber);
//End Custom Code

//Close Detil_BeforeShowRow @45-D613C936
    return $Detil_BeforeShowRow;
}
//End Close Detil_BeforeShowRow

//Detil_BeforeShow @45-0884EB49
function Detil_BeforeShow(& $sender)
{
    $Detil_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_BeforeShow

//Custom Code @144-2A29BDB7
global $Header, $Detil;
global $DBGayaFusionAll;
$Proforma_H_ID = CCGetFromGet("Proforma_H_ID",0);
$AddressID = $Header->AddressID->GetValue();
$Detil->PackCost->SetValue(CCDLookUp("PackagingCost","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID, ccsInteger),$DBGayaFusionAll)."%");
$DBGayaFusionAll->query("SELECT SubTotal,Discount,Packaging,Fumigation,GrandTotal FROM ar_proforma WHERE Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID, ccsInteger));
$result = $DBGayaFusionAll->next_record();
if($result){
  $Detil->SubTotal->SetValue($DBGayaFusionAll->f("SubTotal"));
  $Detil->Discount->SetValue($DBGayaFusionAll->f("Discount"));
  $Detil->Packaging->SetValue($DBGayaFusionAll->f("Packaging"));
  $Detil->Fumigation->SetValue($DBGayaFusionAll->f("Fumigation"));
  $Detil->GrandTotal->SetValue($DBGayaFusionAll->f("GrandTotal"));
}
//End Custom Code

//Close Detil_BeforeShow @45-9E220C4A
    return $Detil_BeforeShow;
}
//End Close Detil_BeforeShow

//lblAdministrasi_BeforeShow @146-52E7D33D
function lblAdministrasi_BeforeShow(& $sender)
{
    $lblAdministrasi_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblAdministrasi; //Compatibility
//End lblAdministrasi_BeforeShow

//Custom Code @147-2A29BDB7
global $Header;
$db = new clsDBGayaFusionAll();
$Component->SetValue(CCDLookUp("Firstname","tblUser","id = ".$db->ToSQL($Header->DocMaker->GetValue(),ccsInteger),$db));
$db->close();
//End Custom Code

//Close lblAdministrasi_BeforeShow @146-E5CCD1BF
    return $lblAdministrasi_BeforeShow;
}
//End Close lblAdministrasi_BeforeShow

//lblCustomer_BeforeShow @135-9F1B654F
function lblCustomer_BeforeShow(& $sender)
{
    $lblCustomer_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $lblCustomer; //Compatibility
//End lblCustomer_BeforeShow

//Custom Code @166-2A29BDB7
global $Header;
$Component->SetValue($Header->Client->GetValue());
//End Custom Code

//Close lblCustomer_BeforeShow @135-7C7DE75F
    return $lblCustomer_BeforeShow;
}
//End Close lblCustomer_BeforeShow

//Header_Client_BeforeShow @67-E9F9A0AD
function Header_Client_BeforeShow(& $sender)
{
    $Header_Client_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Client_BeforeShow

//Custom Code @68-2A29BDB7
$ID = $Container->ClientID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("ClientCompany","tblAdminist_Client","ClientID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_Client_BeforeShow @67-19ED7B5B
    return $Header_Client_BeforeShow;
}
//End Close Header_Client_BeforeShow

//Header_Address_BeforeShow @69-53FB48DF
function Header_Address_BeforeShow(& $sender)
{
    $Header_Address_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_Address_BeforeShow

//Custom Code @70-2A29BDB7
$ID = $Container->AddressID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_Address_BeforeShow @69-ADFE77C0
    return $Header_Address_BeforeShow;
}
//End Close Header_Address_BeforeShow

//Header_QuotationContact_BeforeShow @71-6023E43E
function Header_QuotationContact_BeforeShow(& $sender)
{
    $Header_QuotationContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_QuotationContact_BeforeShow

//Custom Code @175-2A29BDB7
$ID = $Container->QuotationContactID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $sql = "SELECT ContactName,Address,Email,Phone,Fax FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$db->ToSQL($ID,ccsInteger);
  $db->query($sql);
  $result = $db->next_record();
  if ($result){
    $Component->SetValue($db->f("ContactName"));
    $Container->QuotationEmail->SetValue($db->f("Email"));
    $Container->QuotationAddress->SetValue($db->f("Address"));
    $Container->QuotationPhone->SetValue($db->f("Phone"));
    $Container->QuotationFax->SetValue($db->f("Fax"));
  }
  $db->close();
}
//End Custom Code

//Close Header_QuotationContact_BeforeShow @71-89FB67BE
    return $Header_QuotationContact_BeforeShow;
}
//End Close Header_QuotationContact_BeforeShow

//Header_DeliveryContact_BeforeShow @180-A51F3614
function Header_DeliveryContact_BeforeShow(& $sender)
{
    $Header_DeliveryContact_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryContact_BeforeShow

//Custom Code @181-2A29BDB7
$ID = $Container->DeliveryContactID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $sql = "SELECT ContactName,Address,Email,Phone,Fax FROM tblAdminist_AddressBook_Contact WHERE ContactID = ".$db->ToSQL($ID,ccsInteger);
  $db->query($sql);
  $result = $db->next_record();
  if ($result){
    $Component->SetValue($db->f("ContactName"));
    $Container->DeliveryEmail->SetValue($db->f("Email"));
    $Container->DeliveryAddress->SetValue($db->f("Address"));
    $Container->DeliveryPhone->SetValue($db->f("Phone"));
    $Container->DeliveryFax->SetValue($db->f("Fax"));
  }
  $db->close();
}
//End Custom Code

//Close Header_DeliveryContact_BeforeShow @180-498A62AE
    return $Header_DeliveryContact_BeforeShow;
}
//End Close Header_DeliveryContact_BeforeShow

//Header_DeliveryTem_BeforeShow @186-0E24CFEC
function Header_DeliveryTem_BeforeShow(& $sender)
{
    $Header_DeliveryTem_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryTem_BeforeShow

//Custom Code @187-2A29BDB7
$ID = $Container->DeliveryTermID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("DeliveryTerm","tblAdminist_DeliveryTerm","DeliveryTermID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryTem_BeforeShow @186-2400C371
    return $Header_DeliveryTem_BeforeShow;
}
//End Close Header_DeliveryTem_BeforeShow

//Header_DeliveryTime_BeforeShow @84-0328E101
function Header_DeliveryTime_BeforeShow(& $sender)
{
    $Header_DeliveryTime_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryTime_BeforeShow

//Custom Code @188-2A29BDB7
$ID = $Container->DeliveryTimeID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("DeliveryTime","tblAdminist_DeliveryTime","DeliveryTimeID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryTime_BeforeShow @84-89F792CF
    return $Header_DeliveryTime_BeforeShow;
}
//End Close Header_DeliveryTime_BeforeShow

//Header_PaymentTerm_BeforeShow @189-94971505
function Header_PaymentTerm_BeforeShow(& $sender)
{
    $Header_PaymentTerm_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_PaymentTerm_BeforeShow

//Custom Code @190-2A29BDB7
$ID = $Container->PaymentTermID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("PaymentTerm","tblAdminist_PaymentTerm","PaymentTermID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_PaymentTerm_BeforeShow @189-955C2E33
    return $Header_PaymentTerm_BeforeShow;
}
//End Close Header_PaymentTerm_BeforeShow

//Header_DeliveryAddr_BeforeShow @194-8735EC6B
function Header_DeliveryAddr_BeforeShow(& $sender)
{
    $Header_DeliveryAddr_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_DeliveryAddr_BeforeShow

//Custom Code @195-2A29BDB7
$ID = $Container->DeliveryAddressID->GetValue();
if(!$ID == ""){
  $db = new clsDBGayaFusionAll();
  $Component->SetValue(CCDLookUp("Company","tblAdminist_AddressBook","AddressID = ".$db->ToSQL($ID,ccsInteger),$db));
  $db->close();
}
//End Custom Code

//Close Header_DeliveryAddr_BeforeShow @194-164F24A4
    return $Header_DeliveryAddr_BeforeShow;
}
//End Close Header_DeliveryAddr_BeforeShow
?>