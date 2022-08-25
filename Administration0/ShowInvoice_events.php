<?php
//BindEvents Method @1-04170292
function BindEvents()
{
    global $Header;
    global $Detil;
    $Header->ProformaNo->CCSEvents["BeforeShow"] = "Header_ProformaNo_BeforeShow";
    $Header->CCSEvents["BeforeShow"] = "Header_BeforeShow";
    $Detil->Total->CCSEvents["BeforeShow"] = "Detil_Total_BeforeShow";
    $Detil->lblAdministrasi->CCSEvents["BeforeShow"] = "Detil_lblAdministrasi_BeforeShow";
    $Detil->lblCurrency->CCSEvents["BeforeShow"] = "Detil_lblCurrency_BeforeShow";
    $Detil->DocNotes->CCSEvents["BeforeShow"] = "Detil_DocNotes_BeforeShow";
    $Detil->CCSEvents["BeforeShowRow"] = "Detil_BeforeShowRow";
    $Detil->CCSEvents["BeforeShow"] = "Detil_BeforeShow";
}
//End BindEvents Method

//Header_ProformaNo_BeforeShow @46-18769E55
function Header_ProformaNo_BeforeShow(& $sender)
{
    $Header_ProformaNo_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_ProformaNo_BeforeShow

//Custom Code @47-2A29BDB7
global $DBGayaFusionAll;
$Proforma_H_ID = $Header->Proforma_H_ID->GetValue();
if($Proforma_H_ID > 0){
	$Header->ProformaNo->SetValue(CCDLookUp("ProformaNo","tblAdminist_Proforma_H","Proforma_H_ID = ".$DBGayaFusionAll->ToSQL($Proforma_H_ID,ccsInteger),$DBGayaFusionAll));
}else{
	$Header->ProformaNo->SetValue("-");
}
//End Custom Code

//Close Header_ProformaNo_BeforeShow @46-D69F239E
    return $Header_ProformaNo_BeforeShow;
}
//End Close Header_ProformaNo_BeforeShow

//Header_BeforeShow @2-19A6F438
function Header_BeforeShow(& $sender)
{
    $Header_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_BeforeShow

//Custom Code @52-2A29BDB7

$Invoice_H_ID = CCGetFromGet("Invoice_H_ID","");

$InvoiceContactID = $Header->InvoiceAddressContact->GetValue();
if($InvoiceContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
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
  $Header->lblInvoiceAddressContact->SetValue($contactname);
  $Header->InvoiceAddress->SetValue($address);
  $Header->InvoicePhone->SetValue($phone);
  $Header->InvoiceFax->SetValue($fax);
}

$DeliveryContactID = $Header->DeliveryAddressContact->GetValue();
if($DeliveryContactID > 0){
  $NewConnection = new clsDBGayaFusionAll;
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
  $Header->lblDeliveryAddressContact->SetValue($contactname);
  $Header->DeliveryAddress->SetValue($address);
  $Header->DeliveryPhone->SetValue($phone);
  $Header->DeliveryFax->SetValue($fax);
}
//End Custom Code

//Close Header_BeforeShow @2-E0152CE0
    return $Header_BeforeShow;
}
//End Close Header_BeforeShow


//Detil_Total_BeforeShow @103-ED649264
function Detil_Total_BeforeShow(& $sender)
{
    $Detil_Total_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_Total_BeforeShow

//Custom Code @104-2A29BDB7
$UPrice = $Detil->UnitPrice->GetValue();
$Qty = $Detil->Qty->GetValue();
$Detil->Total->SetValue($UPrice * $Qty);
//End Custom Code

//Close Detil_Total_BeforeShow @103-FF2D58FA
    return $Detil_Total_BeforeShow;
}
//End Close Detil_Total_BeforeShow

//Detil_lblAdministrasi_BeforeShow @117-29A1ACCA
function Detil_lblAdministrasi_BeforeShow(& $sender)
{
    $Detil_lblAdministrasi_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_lblAdministrasi_BeforeShow

//Custom Code @118-2A29BDB7
global $Header;
global $DBGayaFusionAll;
$Detil->lblAdministrasi->SetValue(CCDLookUp("Firstname","tblUser","id = ".$DBGayaFusionAll->ToSQL(($Header->DocMaker->GetValue()),ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Detil_lblAdministrasi_BeforeShow @117-98ABBD6E
    return $Detil_lblAdministrasi_BeforeShow;
}
//End Close Detil_lblAdministrasi_BeforeShow

//Detil_lblCurrency_BeforeShow @119-29090376
function Detil_lblCurrency_BeforeShow(& $sender)
{
    $Detil_lblCurrency_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_lblCurrency_BeforeShow

//Custom Code @120-2A29BDB7
global $DBGayaFusionAll;
$InvID = $Detil->Invoice_H_ID->GetValue();
$id = CCDLookUp("CurrencyID","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($InvID,ccsInteger),$DBGayaFusionAll);
$Detil->lblCurrency->SetValue(CCDLookUp("CurrencyCode","tbladminist_currency","CurrencyID = ".$DBGayaFusionAll->ToSQL($id,ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Detil_lblCurrency_BeforeShow @119-A25C728D
    return $Detil_lblCurrency_BeforeShow;
}
//End Close Detil_lblCurrency_BeforeShow

//Detil_DocNotes_BeforeShow @121-9F1BD73E
function Detil_DocNotes_BeforeShow(& $sender)
{
    $Detil_DocNotes_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_DocNotes_BeforeShow

//Custom Code @122-2A29BDB7
include ("../settings.php");
$Detil->DocNotes->SetValue($cfg_DocNotes);
//End Custom Code

//Close Detil_DocNotes_BeforeShow @121-EB64B09F
    return $Detil_DocNotes_BeforeShow;
}
//End Close Detil_DocNotes_BeforeShow

//Detil_BeforeShowRow @45-36388CCD
function Detil_BeforeShowRow(& $sender)
{
    $Detil_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_BeforeShowRow

//Custom Code @129-2A29BDB7
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

//Custom Code @130-2A29BDB7
global $Header, $Detil;
global $DBGayaFusionAll;
$Invoice_H_ID = CCGetFromGet("Invoice_H_ID",0);
$company = $Header->lblAddress->GetValue();
$Detil->Company->SetValue($company);
$Detil->PackCost->SetValue(CCDLookUp("PackagingCost","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger),$DBGayaFusionAll)."%");
$DBGayaFusionAll->query("SELECT SubTotal,Discount,Packaging,Fumigation,GrandTotal FROM ar_invoice WHERE Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger));
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
?>