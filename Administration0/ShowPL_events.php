<?php
//BindEvents Method @1-4A0EC150
function BindEvents()
{
    global $Header;
    global $Detil;
    $Header->CCSEvents["BeforeShow"] = "Header_BeforeShow";
    $Detil->lblAdministrasi->CCSEvents["BeforeShow"] = "Detil_lblAdministrasi_BeforeShow";
    $Detil->CCSEvents["BeforeShowRow"] = "Detil_BeforeShowRow";
    $Detil->CCSEvents["BeforeShow"] = "Detil_BeforeShow";
}
//End BindEvents Method

//Header_BeforeShow @2-19A6F438
function Header_BeforeShow(& $sender)
{
    $Header_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Header; //Compatibility
//End Header_BeforeShow

//Custom Code @44-2A29BDB7
global $Header;

$PL_H_ID = CCGetFromGet("PL_H_ID",0);

//to handle the address-attn
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

//DEL  

//Detil_lblAdministrasi_BeforeShow @73-29A1ACCA
function Detil_lblAdministrasi_BeforeShow(& $sender)
{
    $Detil_lblAdministrasi_BeforeShow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_lblAdministrasi_BeforeShow

//Custom Code @74-2A29BDB7
global $Header;
global $DBGayaFusionAll;
//$Detil->lblAdministrasi->SetValue(CCDLookUp("Firstname","tblUser","id = ".$DBGayaFusionAll->ToSQL(($Header->DocMaker->GetValue()),ccsInteger),$DBGayaFusionAll));
//End Custom Code

//Close Detil_lblAdministrasi_BeforeShow @73-98ABBD6E
    return $Detil_lblAdministrasi_BeforeShow;
}
//End Close Detil_lblAdministrasi_BeforeShow

//Detil_BeforeShowRow @45-36388CCD
function Detil_BeforeShowRow(& $sender)
{
    $Detil_BeforeShowRow = true;
    $Component = & $sender;
    $Container = & CCGetParentContainer($sender);
    global $Detil; //Compatibility
//End Detil_BeforeShowRow

//Custom Code @85-2A29BDB7
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

//Custom Code @86-2A29BDB7
global $Header, $Detil;
global $DBGayaFusionAll;
$Invoice_H_ID = CCGetFromGet("Invoice_H_ID",0);
//$company = $Header->lblAddress->GetValue();
//$Detil->Company->SetValue($company);
//$Detil->PackCost->SetValue(CCDLookUp("PackagingCost","tblAdminist_Invoice_H","Invoice_H_ID = ".$DBGayaFusionAll->ToSQL($Invoice_H_ID, ccsInteger),$DBGayaFusionAll)."%");

//End Custom Code

//Close Detil_BeforeShow @45-9E220C4A
    return $Detil_BeforeShow;
}
//End Close Detil_BeforeShow

?>