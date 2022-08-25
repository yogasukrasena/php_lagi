<?php
session_start();
include ("../settings.php");
include("../language/$cfg_language");
include ("../classes/db_functions.php");
include ("../classes/security_functions.php");

$lang=new language();
$dbf=new db_functions($cfg_server,$cfg_username,$cfg_password,$cfg_database,$cfg_tableprefix,$cfg_theme,$lang);
$sec=new security_functions($dbf,'RnD',$lang);

if(!$sec->isLoggedIn())
{
	header ("location: ../login.php");
	exit();
}
//Include Common Files @1-781450CC
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddProforma.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
include_once(RelativePath . "/Services.php");
//End Include Common Files

class clsRecordAddNewHeader { //AddNewHeader Class @2-5850F9DE

//Variables @2-9E315808

    // Public variables
    public $ComponentType = "Record";
    public $ComponentName;
    public $Parent;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormEnctype;
    public $Visible;
    public $IsEmpty;

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode      = false;
    public $ds;
    public $DataSource;
    public $ValidatingControls;
    public $Controls;
    public $Attributes;

    // Class variables
//End Variables

//Class_Initialize Event @2-F89C6A2F
    function clsRecordAddNewHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->DataSource = new clsAddNewHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddNewHeader";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->ProformaNo = new clsControl(ccsTextBox, "ProformaNo", "Proforma No", ccsText, "", CCGetRequestParam("ProformaNo", $Method, NULL), $this);
            $this->Validity = new clsControl(ccsTextBox, "Validity", "Validity", ccsText, "", CCGetRequestParam("Validity", $Method, NULL), $this);
            $this->ProformaDate = new clsControl(ccsTextBox, "ProformaDate", "Proforma Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("ProformaDate", $Method, NULL), $this);
            $this->ProformaDate->Required = true;
            $this->DatePicker_ProformaDate = new clsDatePicker("DatePicker_ProformaDate", "AddNewHeader", "ProformaDate", $this);
            $this->DeliveryTerm = new clsControl(ccsListBox, "DeliveryTerm", "Delivery Term", ccsText, "", CCGetRequestParam("DeliveryTerm", $Method, NULL), $this);
            $this->DeliveryTerm->DSType = dsTable;
            $this->DeliveryTerm->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryTerm->ds = & $this->DeliveryTerm->DataSource;
            $this->DeliveryTerm->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_deliveryterm {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryTerm->BoundColumn, $this->DeliveryTerm->TextColumn, $this->DeliveryTerm->DBFormat) = array("DeliveryTermID", "DeliveryTerm", "");
            $this->DeliveryTime = new clsControl(ccsListBox, "DeliveryTime", "Delivery Time", ccsText, "", CCGetRequestParam("DeliveryTime", $Method, NULL), $this);
            $this->DeliveryTime->DSType = dsTable;
            $this->DeliveryTime->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryTime->ds = & $this->DeliveryTime->DataSource;
            $this->DeliveryTime->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_deliverytime {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryTime->BoundColumn, $this->DeliveryTime->TextColumn, $this->DeliveryTime->DBFormat) = array("DeliveryTimeID", "DeliveryTime", "");
            $this->PaymentTerm = new clsControl(ccsListBox, "PaymentTerm", "Payment Term", ccsText, "", CCGetRequestParam("PaymentTerm", $Method, NULL), $this);
            $this->PaymentTerm->DSType = dsTable;
            $this->PaymentTerm->DataSource = new clsDBGayaFusionAll();
            $this->PaymentTerm->ds = & $this->PaymentTerm->DataSource;
            $this->PaymentTerm->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_paymentterm {SQL_Where} {SQL_OrderBy}";
            list($this->PaymentTerm->BoundColumn, $this->PaymentTerm->TextColumn, $this->PaymentTerm->DBFormat) = array("PaymentTermID", "PaymentTerm", "");
            $this->Revis = new clsControl(ccsTextBox, "Revis", "Revis", ccsText, "", CCGetRequestParam("Revis", $Method, NULL), $this);
            $this->LinkRev = new clsControl(ccsLink, "LinkRev", "LinkRev", ccsText, "", CCGetRequestParam("LinkRev", $Method, NULL), $this);
            $this->LinkRev->Page = "RevQuotation.php";
            $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsListBox, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->AddressID->DSType = dsTable;
            $this->AddressID->DataSource = new clsDBGayaFusionAll();
            $this->AddressID->ds = & $this->AddressID->DataSource;
            $this->AddressID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
            list($this->AddressID->BoundColumn, $this->AddressID->TextColumn, $this->AddressID->DBFormat) = array("AddressID", "Company", "");
            $this->lblAddress = new clsControl(ccsTextBox, "lblAddress", "lblAddress", ccsText, "", CCGetRequestParam("lblAddress", $Method, NULL), $this);
            $this->ClientOrderRef = new clsControl(ccsTextBox, "ClientOrderRef", "Client Order Ref", ccsText, "", CCGetRequestParam("ClientOrderRef", $Method, NULL), $this);
            $this->ClientOrderRef->Required = true;
            $this->Attn = new clsControl(ccsListBox, "Attn", "Attn", ccsInteger, "", CCGetRequestParam("Attn", $Method, NULL), $this);
            $this->Attn->DSType = dsTable;
            $this->Attn->DataSource = new clsDBGayaFusionAll();
            $this->Attn->ds = & $this->Attn->DataSource;
            $this->Attn->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
            list($this->Attn->BoundColumn, $this->Attn->TextColumn, $this->Attn->DBFormat) = array("ContactId", "ContactName", "");
            $this->Attn->DataSource->Parameters["expr158"] = 0;
            $this->Attn->DataSource->wp = new clsSQLParameters();
            $this->Attn->DataSource->wp->AddParameter("1", "expr158", ccsInteger, "", "", $this->Attn->DataSource->Parameters["expr158"], "", false);
            $this->Attn->DataSource->wp->Criterion[1] = $this->Attn->DataSource->wp->Operation(opEqual, "AddressID", $this->Attn->DataSource->wp->GetDBValue("1"), $this->Attn->DataSource->ToSQL($this->Attn->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->Attn->DataSource->Where = 
                 $this->Attn->DataSource->wp->Criterion[1];
            $this->lblAttn = new clsControl(ccsTextBox, "lblAttn", "lblAttn", ccsText, "", CCGetRequestParam("lblAttn", $Method, NULL), $this);
            $this->LinkChange = new clsControl(ccsLink, "LinkChange", "LinkChange", ccsText, "", CCGetRequestParam("LinkChange", $Method, NULL), $this);
            $this->LinkChange->Page = "AddProforma.php";
            $this->ClientID = new clsControl(ccsListBox, "ClientID", "Client ID", ccsInteger, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->ClientID->DSType = dsTable;
            $this->ClientID->DataSource = new clsDBGayaFusionAll();
            $this->ClientID->ds = & $this->ClientID->DataSource;
            $this->ClientID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->ClientID->BoundColumn, $this->ClientID->TextColumn, $this->ClientID->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->ClientID->Required = true;
            $this->Address = new clsControl(ccsTextArea, "Address", "Address", ccsText, "", CCGetRequestParam("Address", $Method, NULL), $this);
            $this->PackagingCost = new clsControl(ccsTextBox, "PackagingCost", "Packaging Cost", ccsFloat, "", CCGetRequestParam("PackagingCost", $Method, NULL), $this);
            $this->Email = new clsControl(ccsTextBox, "Email", "Email", ccsText, "", CCGetRequestParam("Email", $Method, NULL), $this);
            $this->Phone = new clsControl(ccsTextBox, "Phone", "Phone", ccsText, "", CCGetRequestParam("Phone", $Method, NULL), $this);
            $this->Fax = new clsControl(ccsTextBox, "Fax", "Fax", ccsText, "", CCGetRequestParam("Fax", $Method, NULL), $this);
            $this->DeliveryContactID = new clsControl(ccsListBox, "DeliveryContactID", "DeliveryContactID", ccsInteger, "", CCGetRequestParam("DeliveryContactID", $Method, NULL), $this);
            $this->DeliveryContactID->DSType = dsTable;
            $this->DeliveryContactID->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryContactID->ds = & $this->DeliveryContactID->DataSource;
            $this->DeliveryContactID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryContactID->BoundColumn, $this->DeliveryContactID->TextColumn, $this->DeliveryContactID->DBFormat) = array("ContactId", "ContactName", "");
            $this->DeliveryContactID->DataSource->Parameters["expr286"] = 0;
            $this->DeliveryContactID->DataSource->wp = new clsSQLParameters();
            $this->DeliveryContactID->DataSource->wp->AddParameter("1", "expr286", ccsInteger, "", "", $this->DeliveryContactID->DataSource->Parameters["expr286"], "", false);
            $this->DeliveryContactID->DataSource->wp->Criterion[1] = $this->DeliveryContactID->DataSource->wp->Operation(opEqual, "AddressID", $this->DeliveryContactID->DataSource->wp->GetDBValue("1"), $this->DeliveryContactID->DataSource->ToSQL($this->DeliveryContactID->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->DeliveryContactID->DataSource->Where = 
                 $this->DeliveryContactID->DataSource->wp->Criterion[1];
            $this->lblDeliveryContactID = new clsControl(ccsTextBox, "lblDeliveryContactID", "lblDeliveryContactID", ccsText, "", CCGetRequestParam("lblDeliveryContactID", $Method, NULL), $this);
            $this->LinkChangeDeliveryContact = new clsControl(ccsLink, "LinkChangeDeliveryContact", "LinkChangeDeliveryContact", ccsText, "", CCGetRequestParam("LinkChangeDeliveryContact", $Method, NULL), $this);
            $this->LinkChangeDeliveryContact->Page = "AddProforma.php";
            $this->DeliveryAddress = new clsControl(ccsTextArea, "DeliveryAddress", "DeliveryAddress", ccsText, "", CCGetRequestParam("DeliveryAddress", $Method, NULL), $this);
            $this->DeliveryPhone = new clsControl(ccsTextBox, "DeliveryPhone", "Phone", ccsText, "", CCGetRequestParam("DeliveryPhone", $Method, NULL), $this);
            $this->DeliveryFax = new clsControl(ccsTextBox, "DeliveryFax", "Fax", ccsText, "", CCGetRequestParam("DeliveryFax", $Method, NULL), $this);
            $this->DeliveryEmail = new clsControl(ccsTextBox, "DeliveryEmail", "Email", ccsText, "", CCGetRequestParam("DeliveryEmail", $Method, NULL), $this);
            $this->Currency = new clsControl(ccsListBox, "Currency", "Currency", ccsInteger, "", CCGetRequestParam("Currency", $Method, NULL), $this);
            $this->Currency->DSType = dsTable;
            $this->Currency->DataSource = new clsDBGayaFusionAll();
            $this->Currency->ds = & $this->Currency->DataSource;
            $this->Currency->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
            list($this->Currency->BoundColumn, $this->Currency->TextColumn, $this->Currency->DBFormat) = array("CurrencyID", "Currency", "");
            $this->DeliveryAddressID = new clsControl(ccsListBox, "DeliveryAddressID", "DeliveryAddressID", ccsInteger, "", CCGetRequestParam("DeliveryAddressID", $Method, NULL), $this);
            $this->DeliveryAddressID->DSType = dsTable;
            $this->DeliveryAddressID->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryAddressID->ds = & $this->DeliveryAddressID->DataSource;
            $this->DeliveryAddressID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryAddressID->BoundColumn, $this->DeliveryAddressID->TextColumn, $this->DeliveryAddressID->DBFormat) = array("AddressID", "Company", "");
            $this->lblDeliveryAddress = new clsControl(ccsTextBox, "lblDeliveryAddress", "lblDeliveryAddress", ccsText, "", CCGetRequestParam("lblDeliveryAddress", $Method, NULL), $this);
            $this->PreviewDPDate = new clsControl(ccsTextBox, "PreviewDPDate", "Preview DPDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("PreviewDPDate", $Method, NULL), $this);
            $this->PreviewDPDate->Required = true;
            $this->DatePicker_PreviewDPDate = new clsDatePicker("DatePicker_PreviewDPDate", "AddNewHeader", "PreviewDPDate", $this);
            $this->SpecialInstruction = new clsControl(ccsTextArea, "SpecialInstruction", "SpecialInstruction", ccsMemo, "", CCGetRequestParam("SpecialInstruction", $Method, NULL), $this);
            $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", $Method, NULL), $this);
            $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-B1F106E5
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-B01BF113
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->ProformaNo->SetValue($this->ProformaNo->GetValue());
        if(CCDLookUp("COUNT(*)", "tbladminist_proforma_h", "ProformaNo=" . $this->DataSource->ToSQL($this->DataSource->ProformaNo->GetDBValue(), $this->DataSource->ProformaNo->DataType) . $Where, $this->DataSource) > 0)
            $this->ProformaNo->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Proforma No"));
        $Validation = ($this->ProformaNo->Validate() && $Validation);
        $Validation = ($this->Validity->Validate() && $Validation);
        $Validation = ($this->ProformaDate->Validate() && $Validation);
        $Validation = ($this->DeliveryTerm->Validate() && $Validation);
        $Validation = ($this->DeliveryTime->Validate() && $Validation);
        $Validation = ($this->PaymentTerm->Validate() && $Validation);
        $Validation = ($this->Revis->Validate() && $Validation);
        $Validation = ($this->DocMaker->Validate() && $Validation);
        $Validation = ($this->AddressID->Validate() && $Validation);
        $Validation = ($this->lblAddress->Validate() && $Validation);
        $Validation = ($this->ClientOrderRef->Validate() && $Validation);
        $Validation = ($this->Attn->Validate() && $Validation);
        $Validation = ($this->lblAttn->Validate() && $Validation);
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->Address->Validate() && $Validation);
        $Validation = ($this->PackagingCost->Validate() && $Validation);
        $Validation = ($this->Email->Validate() && $Validation);
        $Validation = ($this->Phone->Validate() && $Validation);
        $Validation = ($this->Fax->Validate() && $Validation);
        $Validation = ($this->DeliveryContactID->Validate() && $Validation);
        $Validation = ($this->lblDeliveryContactID->Validate() && $Validation);
        $Validation = ($this->DeliveryAddress->Validate() && $Validation);
        $Validation = ($this->DeliveryPhone->Validate() && $Validation);
        $Validation = ($this->DeliveryFax->Validate() && $Validation);
        $Validation = ($this->DeliveryEmail->Validate() && $Validation);
        $Validation = ($this->Currency->Validate() && $Validation);
        $Validation = ($this->DeliveryAddressID->Validate() && $Validation);
        $Validation = ($this->lblDeliveryAddress->Validate() && $Validation);
        $Validation = ($this->PreviewDPDate->Validate() && $Validation);
        $Validation = ($this->SpecialInstruction->Validate() && $Validation);
        $Validation = ($this->Quotation_H_ID->Validate() && $Validation);
        $Validation = ($this->Proforma_H_ID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ProformaNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Validity->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ProformaDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTime->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PaymentTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Revis->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DocMaker->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientOrderRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Attn->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblAttn->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Address->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackagingCost->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Email->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Phone->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Fax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryContactID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblDeliveryContactID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryPhone->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryFax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryEmail->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Currency->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblDeliveryAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PreviewDPDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SpecialInstruction->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Quotation_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Proforma_H_ID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-68D76300
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ProformaNo->Errors->Count());
        $errors = ($errors || $this->Validity->Errors->Count());
        $errors = ($errors || $this->ProformaDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_ProformaDate->Errors->Count());
        $errors = ($errors || $this->DeliveryTerm->Errors->Count());
        $errors = ($errors || $this->DeliveryTime->Errors->Count());
        $errors = ($errors || $this->PaymentTerm->Errors->Count());
        $errors = ($errors || $this->Revis->Errors->Count());
        $errors = ($errors || $this->LinkRev->Errors->Count());
        $errors = ($errors || $this->DocMaker->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->lblAddress->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->Attn->Errors->Count());
        $errors = ($errors || $this->lblAttn->Errors->Count());
        $errors = ($errors || $this->LinkChange->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->Address->Errors->Count());
        $errors = ($errors || $this->PackagingCost->Errors->Count());
        $errors = ($errors || $this->Email->Errors->Count());
        $errors = ($errors || $this->Phone->Errors->Count());
        $errors = ($errors || $this->Fax->Errors->Count());
        $errors = ($errors || $this->DeliveryContactID->Errors->Count());
        $errors = ($errors || $this->lblDeliveryContactID->Errors->Count());
        $errors = ($errors || $this->LinkChangeDeliveryContact->Errors->Count());
        $errors = ($errors || $this->DeliveryAddress->Errors->Count());
        $errors = ($errors || $this->DeliveryPhone->Errors->Count());
        $errors = ($errors || $this->DeliveryFax->Errors->Count());
        $errors = ($errors || $this->DeliveryEmail->Errors->Count());
        $errors = ($errors || $this->Currency->Errors->Count());
        $errors = ($errors || $this->DeliveryAddressID->Errors->Count());
        $errors = ($errors || $this->lblDeliveryAddress->Errors->Count());
        $errors = ($errors || $this->PreviewDPDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_PreviewDPDate->Errors->Count());
        $errors = ($errors || $this->SpecialInstruction->Errors->Count());
        $errors = ($errors || $this->Quotation_H_ID->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @2-ED598703
function SetPrimaryKeys($keyArray)
{
    $this->PrimaryKeys = $keyArray;
}
function GetPrimaryKeys()
{
    return $this->PrimaryKeys;
}
function GetPrimaryKey($keyName)
{
    return $this->PrimaryKeys[$keyName];
}
//End MasterDetail

//Operation Method @2-E69993F3
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            $Redirect = "Proforma.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Proforma_H_ID", "AddressID", "DeliveryAddressID", "ContactID", "DeliveryContactID"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "Proforma.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Proforma.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Proforma_H_ID", "AddressID", "DeliveryAddressID", "ProformaContactID", "DeliveryContactID"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//InsertRow Method @2-9DCF8DF9
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ProformaNo->SetValue($this->ProformaNo->GetValue(true));
        $this->DataSource->Validity->SetValue($this->Validity->GetValue(true));
        $this->DataSource->ProformaDate->SetValue($this->ProformaDate->GetValue(true));
        $this->DataSource->DeliveryTerm->SetValue($this->DeliveryTerm->GetValue(true));
        $this->DataSource->DeliveryTime->SetValue($this->DeliveryTime->GetValue(true));
        $this->DataSource->PaymentTerm->SetValue($this->PaymentTerm->GetValue(true));
        $this->DataSource->Revis->SetValue($this->Revis->GetValue(true));
        $this->DataSource->LinkRev->SetValue($this->LinkRev->GetValue(true));
        $this->DataSource->DocMaker->SetValue($this->DocMaker->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->lblAddress->SetValue($this->lblAddress->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->Attn->SetValue($this->Attn->GetValue(true));
        $this->DataSource->lblAttn->SetValue($this->lblAttn->GetValue(true));
        $this->DataSource->LinkChange->SetValue($this->LinkChange->GetValue(true));
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->Address->SetValue($this->Address->GetValue(true));
        $this->DataSource->PackagingCost->SetValue($this->PackagingCost->GetValue(true));
        $this->DataSource->Email->SetValue($this->Email->GetValue(true));
        $this->DataSource->Phone->SetValue($this->Phone->GetValue(true));
        $this->DataSource->Fax->SetValue($this->Fax->GetValue(true));
        $this->DataSource->DeliveryContactID->SetValue($this->DeliveryContactID->GetValue(true));
        $this->DataSource->lblDeliveryContactID->SetValue($this->lblDeliveryContactID->GetValue(true));
        $this->DataSource->LinkChangeDeliveryContact->SetValue($this->LinkChangeDeliveryContact->GetValue(true));
        $this->DataSource->DeliveryAddress->SetValue($this->DeliveryAddress->GetValue(true));
        $this->DataSource->DeliveryPhone->SetValue($this->DeliveryPhone->GetValue(true));
        $this->DataSource->DeliveryFax->SetValue($this->DeliveryFax->GetValue(true));
        $this->DataSource->DeliveryEmail->SetValue($this->DeliveryEmail->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->DeliveryAddressID->SetValue($this->DeliveryAddressID->GetValue(true));
        $this->DataSource->lblDeliveryAddress->SetValue($this->lblDeliveryAddress->GetValue(true));
        $this->DataSource->PreviewDPDate->SetValue($this->PreviewDPDate->GetValue(true));
        $this->DataSource->SpecialInstruction->SetValue($this->SpecialInstruction->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-DD073B50
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ProformaNo->SetValue($this->ProformaNo->GetValue(true));
        $this->DataSource->Validity->SetValue($this->Validity->GetValue(true));
        $this->DataSource->ProformaDate->SetValue($this->ProformaDate->GetValue(true));
        $this->DataSource->DeliveryTerm->SetValue($this->DeliveryTerm->GetValue(true));
        $this->DataSource->DeliveryTime->SetValue($this->DeliveryTime->GetValue(true));
        $this->DataSource->PaymentTerm->SetValue($this->PaymentTerm->GetValue(true));
        $this->DataSource->Revis->SetValue($this->Revis->GetValue(true));
        $this->DataSource->LinkRev->SetValue($this->LinkRev->GetValue(true));
        $this->DataSource->DocMaker->SetValue($this->DocMaker->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->lblAddress->SetValue($this->lblAddress->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->Attn->SetValue($this->Attn->GetValue(true));
        $this->DataSource->lblAttn->SetValue($this->lblAttn->GetValue(true));
        $this->DataSource->LinkChange->SetValue($this->LinkChange->GetValue(true));
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->Address->SetValue($this->Address->GetValue(true));
        $this->DataSource->PackagingCost->SetValue($this->PackagingCost->GetValue(true));
        $this->DataSource->Email->SetValue($this->Email->GetValue(true));
        $this->DataSource->Phone->SetValue($this->Phone->GetValue(true));
        $this->DataSource->Fax->SetValue($this->Fax->GetValue(true));
        $this->DataSource->DeliveryContactID->SetValue($this->DeliveryContactID->GetValue(true));
        $this->DataSource->lblDeliveryContactID->SetValue($this->lblDeliveryContactID->GetValue(true));
        $this->DataSource->LinkChangeDeliveryContact->SetValue($this->LinkChangeDeliveryContact->GetValue(true));
        $this->DataSource->DeliveryAddress->SetValue($this->DeliveryAddress->GetValue(true));
        $this->DataSource->DeliveryPhone->SetValue($this->DeliveryPhone->GetValue(true));
        $this->DataSource->DeliveryFax->SetValue($this->DeliveryFax->GetValue(true));
        $this->DataSource->DeliveryEmail->SetValue($this->DeliveryEmail->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->DeliveryAddressID->SetValue($this->DeliveryAddressID->GetValue(true));
        $this->DataSource->lblDeliveryAddress->SetValue($this->lblDeliveryAddress->GetValue(true));
        $this->DataSource->PreviewDPDate->SetValue($this->PreviewDPDate->GetValue(true));
        $this->DataSource->SpecialInstruction->SetValue($this->SpecialInstruction->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @2-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @2-1F17C930
    function Show()
    {
        global $CCSUseAmp;
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        $Error = "";

        if(!$this->Visible)
            return;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);

        $this->DeliveryTerm->Prepare();
        $this->DeliveryTime->Prepare();
        $this->PaymentTerm->Prepare();
        $this->AddressID->Prepare();
        $this->Attn->Prepare();
        $this->ClientID->Prepare();
        $this->DeliveryContactID->Prepare();
        $this->Currency->Prepare();
        $this->DeliveryAddressID->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if($this->EditMode) {
            if($this->DataSource->Errors->Count()){
                $this->Errors->AddErrors($this->DataSource->Errors);
                $this->DataSource->Errors->clear();
            }
            $this->DataSource->Open();
            if($this->DataSource->Errors->Count() == 0 && $this->DataSource->next_record()) {
                $this->DataSource->SetValues();
                if(!$this->FormSubmitted){
                    $this->ProformaNo->SetValue($this->DataSource->ProformaNo->GetValue());
                    $this->Validity->SetValue($this->DataSource->Validity->GetValue());
                    $this->ProformaDate->SetValue($this->DataSource->ProformaDate->GetValue());
                    $this->DeliveryTerm->SetValue($this->DataSource->DeliveryTerm->GetValue());
                    $this->DeliveryTime->SetValue($this->DataSource->DeliveryTime->GetValue());
                    $this->PaymentTerm->SetValue($this->DataSource->PaymentTerm->GetValue());
                    $this->Revis->SetValue($this->DataSource->Revis->GetValue());
                    $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                    $this->Attn->SetValue($this->DataSource->Attn->GetValue());
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
                    $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
                    $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                    $this->DeliveryAddressID->SetValue($this->DataSource->DeliveryAddressID->GetValue());
                    $this->PreviewDPDate->SetValue($this->DataSource->PreviewDPDate->GetValue());
                    $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
                    $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        $this->LinkRev->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkRev->Parameters = CCAddParam($this->LinkRev->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
        $this->LinkChange->Parameters = CCGetQueryString("QueryString", array("ProformaContactID", "AddressID", "ccsForm"));
        $this->LinkChange->Parameters = CCAddParam($this->LinkChange->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
        $this->LinkChange->Parameters = CCAddParam($this->LinkChange->Parameters, "AddressID", $this->DataSource->f("AddressID"));
        $this->LinkChangeDeliveryContact->Parameters = CCGetQueryString("QueryString", array("DeliveryContactID", "DeliveryAddressID", "ccsForm"));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "AddressID", $this->DataSource->f("AddressID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ProformaNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Validity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ProformaDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_ProformaDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PaymentTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Revis->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkRev->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DocMaker->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Attn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblAttn->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkChange->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Address->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Email->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Phone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Fax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryContactID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryContactID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkChangeDeliveryContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryPhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryEmail->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Currency->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PreviewDPDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_PreviewDPDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SpecialInstruction->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Quotation_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Proforma_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->EditMode ? $this->ComponentName . ":" . "Edit" : $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->ProformaNo->Show();
        $this->Validity->Show();
        $this->ProformaDate->Show();
        $this->DatePicker_ProformaDate->Show();
        $this->DeliveryTerm->Show();
        $this->DeliveryTime->Show();
        $this->PaymentTerm->Show();
        $this->Revis->Show();
        $this->LinkRev->Show();
        $this->DocMaker->Show();
        $this->AddressID->Show();
        $this->lblAddress->Show();
        $this->ClientOrderRef->Show();
        $this->Attn->Show();
        $this->lblAttn->Show();
        $this->LinkChange->Show();
        $this->ClientID->Show();
        $this->Address->Show();
        $this->PackagingCost->Show();
        $this->Email->Show();
        $this->Phone->Show();
        $this->Fax->Show();
        $this->DeliveryContactID->Show();
        $this->lblDeliveryContactID->Show();
        $this->LinkChangeDeliveryContact->Show();
        $this->DeliveryAddress->Show();
        $this->DeliveryPhone->Show();
        $this->DeliveryFax->Show();
        $this->DeliveryEmail->Show();
        $this->Currency->Show();
        $this->DeliveryAddressID->Show();
        $this->lblDeliveryAddress->Show();
        $this->PreviewDPDate->Show();
        $this->DatePicker_PreviewDPDate->Show();
        $this->SpecialInstruction->Show();
        $this->Quotation_H_ID->Show();
        $this->Proforma_H_ID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-263B5A02
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $ProformaNo;
    public $Validity;
    public $ProformaDate;
    public $DeliveryTerm;
    public $DeliveryTime;
    public $PaymentTerm;
    public $Revis;
    public $LinkRev;
    public $DocMaker;
    public $AddressID;
    public $lblAddress;
    public $ClientOrderRef;
    public $Attn;
    public $lblAttn;
    public $LinkChange;
    public $ClientID;
    public $Address;
    public $PackagingCost;
    public $Email;
    public $Phone;
    public $Fax;
    public $DeliveryContactID;
    public $lblDeliveryContactID;
    public $LinkChangeDeliveryContact;
    public $DeliveryAddress;
    public $DeliveryPhone;
    public $DeliveryFax;
    public $DeliveryEmail;
    public $Currency;
    public $DeliveryAddressID;
    public $lblDeliveryAddress;
    public $PreviewDPDate;
    public $SpecialInstruction;
    public $Quotation_H_ID;
    public $Proforma_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-24E4A472
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->ProformaNo = new clsField("ProformaNo", ccsText, "");
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->ProformaDate = new clsField("ProformaDate", ccsDate, $this->DateFormat);
        
        $this->DeliveryTerm = new clsField("DeliveryTerm", ccsText, "");
        
        $this->DeliveryTime = new clsField("DeliveryTime", ccsText, "");
        
        $this->PaymentTerm = new clsField("PaymentTerm", ccsText, "");
        
        $this->Revis = new clsField("Revis", ccsText, "");
        
        $this->LinkRev = new clsField("LinkRev", ccsText, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->lblAddress = new clsField("lblAddress", ccsText, "");
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->Attn = new clsField("Attn", ccsInteger, "");
        
        $this->lblAttn = new clsField("lblAttn", ccsText, "");
        
        $this->LinkChange = new clsField("LinkChange", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsInteger, "");
        
        $this->Address = new clsField("Address", ccsText, "");
        
        $this->PackagingCost = new clsField("PackagingCost", ccsFloat, "");
        
        $this->Email = new clsField("Email", ccsText, "");
        
        $this->Phone = new clsField("Phone", ccsText, "");
        
        $this->Fax = new clsField("Fax", ccsText, "");
        
        $this->DeliveryContactID = new clsField("DeliveryContactID", ccsInteger, "");
        
        $this->lblDeliveryContactID = new clsField("lblDeliveryContactID", ccsText, "");
        
        $this->LinkChangeDeliveryContact = new clsField("LinkChangeDeliveryContact", ccsText, "");
        
        $this->DeliveryAddress = new clsField("DeliveryAddress", ccsText, "");
        
        $this->DeliveryPhone = new clsField("DeliveryPhone", ccsText, "");
        
        $this->DeliveryFax = new clsField("DeliveryFax", ccsText, "");
        
        $this->DeliveryEmail = new clsField("DeliveryEmail", ccsText, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->DeliveryAddressID = new clsField("DeliveryAddressID", ccsInteger, "");
        
        $this->lblDeliveryAddress = new clsField("lblDeliveryAddress", ccsText, "");
        
        $this->PreviewDPDate = new clsField("PreviewDPDate", ccsDate, $this->DateFormat);
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        

        $this->InsertFields["ProformaNo"] = array("Name" => "ProformaNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Validity"] = array("Name" => "Validity", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ProformaDate"] = array("Name" => "ProformaDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryTermID"] = array("Name" => "DeliveryTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["PaymentTermID"] = array("Name" => "PaymentTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Rev"] = array("Name" => "Rev", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["DocMaker"] = array("Name" => "DocMaker", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ProformaContactID"] = array("Name" => "ProformaContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryContactID"] = array("Name" => "DeliveryContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryAddressID"] = array("Name" => "DeliveryAddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["PreviewDPDate"] = array("Name" => "PreviewDPDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["SpecialInstruction"] = array("Name" => "SpecialInstruction", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ProformaNo"] = array("Name" => "ProformaNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Validity"] = array("Name" => "Validity", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ProformaDate"] = array("Name" => "ProformaDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTermID"] = array("Name" => "DeliveryTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["PaymentTermID"] = array("Name" => "PaymentTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Rev"] = array("Name" => "Rev", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DocMaker"] = array("Name" => "DocMaker", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ProformaContactID"] = array("Name" => "ProformaContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryContactID"] = array("Name" => "DeliveryContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryAddressID"] = array("Name" => "DeliveryAddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PreviewDPDate"] = array("Name" => "PreviewDPDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["SpecialInstruction"] = array("Name" => "SpecialInstruction", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-E98D79D9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsInteger, "", "", $this->Parameters["urlProforma_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Proforma_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-87A51F46
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_proforma_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-039789B3
    function SetValues()
    {
        $this->ProformaNo->SetDBValue($this->f("ProformaNo"));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->ProformaDate->SetDBValue(trim($this->f("ProformaDate")));
        $this->DeliveryTerm->SetDBValue($this->f("DeliveryTermID"));
        $this->DeliveryTime->SetDBValue($this->f("DeliveryTimeID"));
        $this->PaymentTerm->SetDBValue($this->f("PaymentTermID"));
        $this->Revis->SetDBValue($this->f("Rev"));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->Attn->SetDBValue(trim($this->f("ProformaContactID")));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->Currency->SetDBValue(trim($this->f("Currency")));
        $this->DeliveryAddressID->SetDBValue(trim($this->f("DeliveryAddressID")));
        $this->PreviewDPDate->SetDBValue(trim($this->f("PreviewDPDate")));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
    }
//End SetValues Method

//Insert Method @2-FAB439C1
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ProformaNo"]["Value"] = $this->ProformaNo->GetDBValue(true);
        $this->InsertFields["Validity"]["Value"] = $this->Validity->GetDBValue(true);
        $this->InsertFields["ProformaDate"]["Value"] = $this->ProformaDate->GetDBValue(true);
        $this->InsertFields["DeliveryTermID"]["Value"] = $this->DeliveryTerm->GetDBValue(true);
        $this->InsertFields["DeliveryTimeID"]["Value"] = $this->DeliveryTime->GetDBValue(true);
        $this->InsertFields["PaymentTermID"]["Value"] = $this->PaymentTerm->GetDBValue(true);
        $this->InsertFields["Rev"]["Value"] = $this->Revis->GetDBValue(true);
        $this->InsertFields["DocMaker"]["Value"] = $this->DocMaker->GetDBValue(true);
        $this->InsertFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->InsertFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->InsertFields["ProformaContactID"]["Value"] = $this->Attn->GetDBValue(true);
        $this->InsertFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->InsertFields["PackagingCost"]["Value"] = $this->PackagingCost->GetDBValue(true);
        $this->InsertFields["DeliveryContactID"]["Value"] = $this->DeliveryContactID->GetDBValue(true);
        $this->InsertFields["Currency"]["Value"] = $this->Currency->GetDBValue(true);
        $this->InsertFields["DeliveryAddressID"]["Value"] = $this->DeliveryAddressID->GetDBValue(true);
        $this->InsertFields["PreviewDPDate"]["Value"] = $this->PreviewDPDate->GetDBValue(true);
        $this->InsertFields["SpecialInstruction"]["Value"] = $this->SpecialInstruction->GetDBValue(true);
        $this->InsertFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->InsertFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_proforma_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-377F14A0
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ProformaNo"]["Value"] = $this->ProformaNo->GetDBValue(true);
        $this->UpdateFields["Validity"]["Value"] = $this->Validity->GetDBValue(true);
        $this->UpdateFields["ProformaDate"]["Value"] = $this->ProformaDate->GetDBValue(true);
        $this->UpdateFields["DeliveryTermID"]["Value"] = $this->DeliveryTerm->GetDBValue(true);
        $this->UpdateFields["DeliveryTimeID"]["Value"] = $this->DeliveryTime->GetDBValue(true);
        $this->UpdateFields["PaymentTermID"]["Value"] = $this->PaymentTerm->GetDBValue(true);
        $this->UpdateFields["Rev"]["Value"] = $this->Revis->GetDBValue(true);
        $this->UpdateFields["DocMaker"]["Value"] = $this->DocMaker->GetDBValue(true);
        $this->UpdateFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->UpdateFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->UpdateFields["ProformaContactID"]["Value"] = $this->Attn->GetDBValue(true);
        $this->UpdateFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->UpdateFields["PackagingCost"]["Value"] = $this->PackagingCost->GetDBValue(true);
        $this->UpdateFields["DeliveryContactID"]["Value"] = $this->DeliveryContactID->GetDBValue(true);
        $this->UpdateFields["Currency"]["Value"] = $this->Currency->GetDBValue(true);
        $this->UpdateFields["DeliveryAddressID"]["Value"] = $this->DeliveryAddressID->GetDBValue(true);
        $this->UpdateFields["PreviewDPDate"]["Value"] = $this->PreviewDPDate->GetDBValue(true);
        $this->UpdateFields["SpecialInstruction"]["Value"] = $this->SpecialInstruction->GetDBValue(true);
        $this->UpdateFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->UpdateFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_proforma_h", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-FA5CF478
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_proforma_h";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End AddNewHeaderDataSource Class @2-FCB6E20C



class clsEditableGridAddNewDetail { //AddNewDetail Class @197-254BF570

//Variables @197-F9538F3C

    // Public variables
    public $ComponentType = "EditableGrid";
    public $ComponentName;
    public $HTMLFormAction;
    public $PressedButton;
    public $Errors;
    public $ErrorBlock;
    public $FormSubmitted;
    public $FormParameters;
    public $FormState;
    public $FormEnctype;
    public $CachedColumns;
    public $TotalRows;
    public $UpdatedRows;
    public $EmptyRows;
    public $Visible;
    public $RowsErrors;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";

    public $InsertAllowed = false;
    public $UpdateAllowed = false;
    public $DeleteAllowed = false;
    public $ReadAllowed   = false;
    public $EditMode;
    public $ValidatingControls;
    public $Controls;
    public $ControlsErrors;
    public $RowNumber;
    public $Attributes;
    public $PrimaryKeys;

    // Class variables
//End Variables

//Class_Initialize Event @197-7BE346F5
    function clsEditableGridAddNewDetail($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->ControlsErrors = array();
        $this->ComponentName = "AddNewDetail";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->CachedColumns["Proforma_D_ID"][0] = "Proforma_D_ID";
        $this->DataSource = new clsAddNewDetailDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: EditableGrid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->EmptyRows = 30;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if(!$this->Visible) return;

        $CCSForm = CCGetFromGet("ccsForm", "");
        $this->FormEnctype = "application/x-www-form-urlencoded";
        $this->FormSubmitted = ($CCSForm == $this->ComponentName);
        if($this->FormSubmitted) {
            $this->FormState = CCGetFromPost("FormState", "");
            $this->SetFormState($this->FormState);
        } else {
            $this->FormState = "";
        }
        $Method = $this->FormSubmitted ? ccsPost : ccsGet;

        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma H ID", ccsInteger, "", NULL, $this);
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "Collect ID", ccsInteger, "", NULL, $this);
        $this->CollectID->Required = true;
        $this->Qty = new clsControl(ccsTextBox, "Qty", "Qty", ccsInteger, "", NULL, $this);
        $this->Qty->Required = true;
        $this->Unit = new clsControl(ccsTextBox, "Unit", "Unit", ccsText, "", NULL, $this);
        $this->UnitPrice = new clsControl(ccsTextBox, "UnitPrice", "Unit Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), NULL, $this);
        $this->SumPrice = new clsControl(ccsTextBox, "SumPrice", "Total", ccsFloat, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->AddItemBtn = new clsButton("AddItemBtn", $Method, $this);
        $this->CollectPopup = new clsControl(ccsImageLink, "CollectPopup", "CollectPopup", ccsText, "", NULL, $this);
        $this->CollectPopup->Page = "PriceList.php";
        $this->CollectCode = new clsControl(ccsTextBox, "CollectCode", "CollectCode", ccsText, "", NULL, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->Design = new clsControl(ccsTextBox, "Design", "Design", ccsText, "", NULL, $this);
        $this->NameDesc = new clsControl(ccsTextBox, "NameDesc", "NameDesc", ccsText, "", NULL, $this);
        $this->Category = new clsControl(ccsTextBox, "Category", "Category", ccsText, "", NULL, $this);
        $this->Size = new clsControl(ccsTextBox, "Size", "Size", ccsText, "", NULL, $this);
        $this->Texture = new clsControl(ccsTextBox, "Texture", "Texture", ccsText, "", NULL, $this);
        $this->Color = new clsControl(ccsTextBox, "Color", "Color", ccsText, "", NULL, $this);
        $this->Material = new clsControl(ccsTextBox, "Material", "Material", ccsText, "", NULL, $this);
        $this->Total = new clsButton("Total", $Method, $this);
        $this->Total_price = new clsControl(ccsHidden, "Total_price", "Total_price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), NULL, $this);
    }
//End Class_Initialize Event

//Initialize Method @197-D8DE462F
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlProforma_H_ID"] = CCGetFromGet("Proforma_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @197-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @197-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @197-31375B15
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["Proforma_H_ID"][$RowNumber] = CCGetFromPost("Proforma_H_ID_" . $RowNumber, NULL);
            $this->FormParameters["CollectID"][$RowNumber] = CCGetFromPost("CollectID_" . $RowNumber, NULL);
            $this->FormParameters["Qty"][$RowNumber] = CCGetFromPost("Qty_" . $RowNumber, NULL);
            $this->FormParameters["Unit"][$RowNumber] = CCGetFromPost("Unit_" . $RowNumber, NULL);
            $this->FormParameters["UnitPrice"][$RowNumber] = CCGetFromPost("UnitPrice_" . $RowNumber, NULL);
            $this->FormParameters["SumPrice"][$RowNumber] = CCGetFromPost("SumPrice_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["CollectCode"][$RowNumber] = CCGetFromPost("CollectCode_" . $RowNumber, NULL);
            $this->FormParameters["Design"][$RowNumber] = CCGetFromPost("Design_" . $RowNumber, NULL);
            $this->FormParameters["NameDesc"][$RowNumber] = CCGetFromPost("NameDesc_" . $RowNumber, NULL);
            $this->FormParameters["Category"][$RowNumber] = CCGetFromPost("Category_" . $RowNumber, NULL);
            $this->FormParameters["Size"][$RowNumber] = CCGetFromPost("Size_" . $RowNumber, NULL);
            $this->FormParameters["Texture"][$RowNumber] = CCGetFromPost("Texture_" . $RowNumber, NULL);
            $this->FormParameters["Color"][$RowNumber] = CCGetFromPost("Color_" . $RowNumber, NULL);
            $this->FormParameters["Material"][$RowNumber] = CCGetFromPost("Material_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @197-A86535EE
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Proforma_D_ID"] = $this->CachedColumns["Proforma_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Proforma_H_ID->SetText($this->FormParameters["Proforma_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
            $this->SumPrice->SetText($this->FormParameters["SumPrice"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if(!$this->CheckBox_Delete->Value)
                    $Validation = ($this->ValidateRow() && $Validation);
            }
            else if($this->CheckInsert())
            {
                $Validation = ($this->ValidateRow() && $Validation);
            }
        }
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//ValidateRow Method @197-8177BEF2
    function ValidateRow()
    {
        global $CCSLocales;
        $this->Proforma_H_ID->Validate();
        $this->CollectID->Validate();
        $this->Qty->Validate();
        $this->Unit->Validate();
        $this->UnitPrice->Validate();
        $this->SumPrice->Validate();
        $this->CheckBox_Delete->Validate();
        $this->CollectCode->Validate();
        $this->Design->Validate();
        $this->NameDesc->Validate();
        $this->Category->Validate();
        $this->Size->Validate();
        $this->Texture->Validate();
        $this->Color->Validate();
        $this->Material->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SumPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Design->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Category->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Size->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Texture->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Color->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Material->Errors->ToString());
        $this->Proforma_H_ID->Errors->Clear();
        $this->CollectID->Errors->Clear();
        $this->Qty->Errors->Clear();
        $this->Unit->Errors->Clear();
        $this->UnitPrice->Errors->Clear();
        $this->SumPrice->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->CollectCode->Errors->Clear();
        $this->Design->Errors->Clear();
        $this->NameDesc->Errors->Clear();
        $this->Category->Errors->Clear();
        $this->Size->Errors->Clear();
        $this->Texture->Errors->Clear();
        $this->Color->Errors->Clear();
        $this->Material->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @197-75E27D8D
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["Proforma_H_ID"][$this->RowNumber]) && count($this->FormParameters["Proforma_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["Proforma_H_ID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectID"][$this->RowNumber]) && count($this->FormParameters["CollectID"][$this->RowNumber])) || strlen($this->FormParameters["CollectID"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Qty"][$this->RowNumber]) && count($this->FormParameters["Qty"][$this->RowNumber])) || strlen($this->FormParameters["Qty"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Unit"][$this->RowNumber]) && count($this->FormParameters["Unit"][$this->RowNumber])) || strlen($this->FormParameters["Unit"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["UnitPrice"][$this->RowNumber]) && count($this->FormParameters["UnitPrice"][$this->RowNumber])) || strlen($this->FormParameters["UnitPrice"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["SumPrice"][$this->RowNumber]) && count($this->FormParameters["SumPrice"][$this->RowNumber])) || strlen($this->FormParameters["SumPrice"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["CollectCode"][$this->RowNumber]) && count($this->FormParameters["CollectCode"][$this->RowNumber])) || strlen($this->FormParameters["CollectCode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Design"][$this->RowNumber]) && count($this->FormParameters["Design"][$this->RowNumber])) || strlen($this->FormParameters["Design"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["NameDesc"][$this->RowNumber]) && count($this->FormParameters["NameDesc"][$this->RowNumber])) || strlen($this->FormParameters["NameDesc"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Category"][$this->RowNumber]) && count($this->FormParameters["Category"][$this->RowNumber])) || strlen($this->FormParameters["Category"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Size"][$this->RowNumber]) && count($this->FormParameters["Size"][$this->RowNumber])) || strlen($this->FormParameters["Size"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Texture"][$this->RowNumber]) && count($this->FormParameters["Texture"][$this->RowNumber])) || strlen($this->FormParameters["Texture"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Color"][$this->RowNumber]) && count($this->FormParameters["Color"][$this->RowNumber])) || strlen($this->FormParameters["Color"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Material"][$this->RowNumber]) && count($this->FormParameters["Material"][$this->RowNumber])) || strlen($this->FormParameters["Material"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @197-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @197-663BB095
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted)
            return;

        $this->GetFormParameters();
        $this->PressedButton = "Button_Submit";
        if($this->Button_Submit->Pressed) {
            $this->PressedButton = "Button_Submit";
        } else if($this->AddItemBtn->Pressed) {
            $this->PressedButton = "AddItemBtn";
        } else if($this->Total->Pressed) {
            $this->PressedButton = "Total";
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = "Proforma.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Proforma_H_ID"));
            }
        } else if($this->PressedButton == "AddItemBtn") {
            if(!CCGetEvent($this->AddItemBtn->CCSEvents, "OnClick", $this->AddItemBtn)) {
                $Redirect = "";
            }
        } else if($this->PressedButton == "Total") {
            if(!CCGetEvent($this->Total->CCSEvents, "OnClick", $this->Total)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @197-3F8BAC59
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Proforma_D_ID"] = $this->CachedColumns["Proforma_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Proforma_H_ID->SetText($this->FormParameters["Proforma_H_ID"][$this->RowNumber], $this->RowNumber);
            $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
            $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
            $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
            $this->SumPrice->SetText($this->FormParameters["SumPrice"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
            $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
            $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
            $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
            $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
            $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
            $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
            $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
            if ($this->UpdatedRows >= $this->RowNumber) {
                if($this->CheckBox_Delete->Value) {
                    if($this->DeleteAllowed) { $Validation = ($this->DeleteRow() && $Validation); }
                } else if($this->UpdateAllowed) {
                    $Validation = ($this->UpdateRow() && $Validation);
                }
            }
            else if($this->CheckInsert() && $this->InsertAllowed)
            {
                $Validation = ($Validation && $this->InsertRow());
            }
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterSubmit", $this);
        if ($this->Errors->Count() == 0 && $Validation){
            $this->DataSource->close();
            return true;
        }
        return false;
    }
//End UpdateGrid Method

//InsertRow Method @197-75EB367F
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->Unit->SetValue($this->Unit->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
        $this->DataSource->SumPrice->SetValue($this->SumPrice->GetValue(true));
        $this->DataSource->CollectPopup->SetValue($this->CollectPopup->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Design->SetValue($this->Design->GetValue(true));
        $this->DataSource->NameDesc->SetValue($this->NameDesc->GetValue(true));
        $this->DataSource->Category->SetValue($this->Category->GetValue(true));
        $this->DataSource->Size->SetValue($this->Size->GetValue(true));
        $this->DataSource->Texture->SetValue($this->Texture->GetValue(true));
        $this->DataSource->Color->SetValue($this->Color->GetValue(true));
        $this->DataSource->Material->SetValue($this->Material->GetValue(true));
        $this->DataSource->Insert();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End InsertRow Method

//UpdateRow Method @197-3024BBBF
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->CollectID->SetValue($this->CollectID->GetValue(true));
        $this->DataSource->Qty->SetValue($this->Qty->GetValue(true));
        $this->DataSource->Unit->SetValue($this->Unit->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
        $this->DataSource->SumPrice->SetValue($this->SumPrice->GetValue(true));
        $this->DataSource->CollectPopup->SetValue($this->CollectPopup->GetValue(true));
        $this->DataSource->CollectCode->SetValue($this->CollectCode->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->Design->SetValue($this->Design->GetValue(true));
        $this->DataSource->NameDesc->SetValue($this->NameDesc->GetValue(true));
        $this->DataSource->Category->SetValue($this->Category->GetValue(true));
        $this->DataSource->Size->SetValue($this->Size->GetValue(true));
        $this->DataSource->Texture->SetValue($this->Texture->GetValue(true));
        $this->DataSource->Color->SetValue($this->Color->GetValue(true));
        $this->DataSource->Material->SetValue($this->Material->GetValue(true));
        $this->DataSource->Update();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End UpdateRow Method

//DeleteRow Method @197-A4A656F6
    function DeleteRow()
    {
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $errors = "";
        if($this->DataSource->Errors->Count() > 0) {
            $errors = $this->DataSource->Errors->ToString();
            $this->RowsErrors[$this->RowNumber] = $errors;
            $this->DataSource->Errors->Clear();
        }
        return (($this->Errors->Count() == 0) && !strlen($errors));
    }
//End DeleteRow Method

//FormScript Method @197-948CBF60
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var AddNewDetailElements;\n";
        $script .= "var AddNewDetailEmptyRows = 30;\n";
        $script .= "var " . $this->ComponentName . "Proforma_H_IDID = 0;\n";
        $script .= "var " . $this->ComponentName . "CollectIDID = 1;\n";
        $script .= "var " . $this->ComponentName . "QtyID = 2;\n";
        $script .= "var " . $this->ComponentName . "UnitID = 3;\n";
        $script .= "var " . $this->ComponentName . "UnitPriceID = 4;\n";
        $script .= "var " . $this->ComponentName . "SumPriceID = 5;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 6;\n";
        $script .= "var " . $this->ComponentName . "CollectCodeID = 7;\n";
        $script .= "var " . $this->ComponentName . "DesignID = 8;\n";
        $script .= "var " . $this->ComponentName . "NameDescID = 9;\n";
        $script .= "var " . $this->ComponentName . "CategoryID = 10;\n";
        $script .= "var " . $this->ComponentName . "SizeID = 11;\n";
        $script .= "var " . $this->ComponentName . "TextureID = 12;\n";
        $script .= "var " . $this->ComponentName . "ColorID = 13;\n";
        $script .= "var " . $this->ComponentName . "MaterialID = 14;\n";
        $script .= "\nfunction initAddNewDetailElements() {\n";
        $script .= "\tvar ED = document.forms[\"AddNewDetail\"];\n";
        $script .= "\tAddNewDetailElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.Proforma_H_ID_" . $i . ", " . "ED.CollectID_" . $i . ", " . "ED.Qty_" . $i . ", " . "ED.Unit_" . $i . ", " . "ED.UnitPrice_" . $i . ", " . "ED.SumPrice_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.CollectCode_" . $i . ", " . "ED.Design_" . $i . ", " . "ED.NameDesc_" . $i . ", " . "ED.Category_" . $i . ", " . "ED.Size_" . $i . ", " . "ED.Texture_" . $i . ", " . "ED.Color_" . $i . ", " . "ED.Material_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @197-EA86D969
    function SetFormState($FormState)
    {
        if(strlen($FormState)) {
            $FormState = str_replace("\\\\", "\\" . ord("\\"), $FormState);
            $FormState = str_replace("\\;", "\\" . ord(";"), $FormState);
            $pieces = explode(";", $FormState);
            $this->UpdatedRows = $pieces[0];
            $this->EmptyRows   = $pieces[1];
            $this->TotalRows = $this->UpdatedRows + $this->EmptyRows;
            $RowNumber = 0;
            for($i = 2; $i < sizeof($pieces); $i = $i + 1)  {
                $piece = $pieces[$i + 0];
                $piece = str_replace("\\" . ord("\\"), "\\", $piece);
                $piece = str_replace("\\" . ord(";"), ";", $piece);
                $this->CachedColumns["Proforma_D_ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["Proforma_D_ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @197-ACF39253
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["Proforma_D_ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @197-0C698573
    function Show()
    {
        global $Tpl;
        global $FileName;
        global $CCSLocales;
        global $CCSUseAmp;
        $Error = "";

        if(!$this->Visible) { return; }

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->open();
        $is_next_record = ($this->ReadAllowed && $this->DataSource->next_record());
        $this->IsEmpty = ! $is_next_record;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) { return; }

        $this->Attributes->Show();
        $this->Button_Submit->Visible = $this->Button_Submit->Visible && ($this->InsertAllowed || $this->UpdateAllowed || $this->DeleteAllowed);
        $ParentPath = $Tpl->block_path;
        $EditableGridPath = $ParentPath . "/EditableGrid " . $this->ComponentName;
        $EditableGridRowPath = $ParentPath . "/EditableGrid " . $this->ComponentName . "/Row";
        $Tpl->block_path = $EditableGridRowPath;
        $this->RowNumber = 0;
        $NonEmptyRows = 0;
        $EmptyRowsLeft = $this->EmptyRows;
        $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
        $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
        $this->ControlsVisible["Qty"] = $this->Qty->Visible;
        $this->ControlsVisible["Unit"] = $this->Unit->Visible;
        $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
        $this->ControlsVisible["SumPrice"] = $this->SumPrice->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["CollectPopup"] = $this->CollectPopup->Visible;
        $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["Design"] = $this->Design->Visible;
        $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
        $this->ControlsVisible["Category"] = $this->Category->Visible;
        $this->ControlsVisible["Size"] = $this->Size->Visible;
        $this->ControlsVisible["Texture"] = $this->Texture->Visible;
        $this->ControlsVisible["Color"] = $this->Color->Visible;
        $this->ControlsVisible["Material"] = $this->Material->Visible;
        if ($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed)) {
            do {
                $this->RowNumber++;
                if($is_next_record) {
                    $NonEmptyRows++;
                    $this->DataSource->SetValues();
                }
                if (!($is_next_record) || !($this->DeleteAllowed)) {
                    $this->CheckBox_Delete->Visible = false;
                }
                if (!($this->FormSubmitted) && $is_next_record) {
                    $this->CachedColumns["Proforma_D_ID"][$this->RowNumber] = $this->DataSource->CachedColumns["Proforma_D_ID"];
                    $this->SumPrice->SetText("");
                    $this->CheckBox_Delete->SetValue("");
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Design->SetText("");
                    $this->NameDesc->SetText("");
                    $this->Category->SetText("");
                    $this->Size->SetText("");
                    $this->Texture->SetText("");
                    $this->Color->SetText("");
                    $this->Material->SetText("");
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                    $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                    $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                    $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                    $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                    $this->CollectPopup->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                    $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Proforma_H_ID->SetText($this->FormParameters["Proforma_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                    $this->SumPrice->SetText($this->FormParameters["SumPrice"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["Proforma_D_ID"][$this->RowNumber] = "";
                    $this->Proforma_H_ID->SetText("");
                    $this->CollectID->SetText("");
                    $this->Qty->SetText("");
                    $this->Unit->SetText("");
                    $this->UnitPrice->SetText("");
                    $this->SumPrice->SetText("");
                    $this->CollectPopup->SetText("");
                    $this->CollectCode->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Design->SetText("");
                    $this->NameDesc->SetText("");
                    $this->Category->SetText("");
                    $this->Size->SetText("");
                    $this->Texture->SetText("");
                    $this->Color->SetText("");
                    $this->Material->SetText("");
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                } else {
                    $this->CollectPopup->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->Proforma_H_ID->SetText($this->FormParameters["Proforma_H_ID"][$this->RowNumber], $this->RowNumber);
                    $this->CollectID->SetText($this->FormParameters["CollectID"][$this->RowNumber], $this->RowNumber);
                    $this->Qty->SetText($this->FormParameters["Qty"][$this->RowNumber], $this->RowNumber);
                    $this->Unit->SetText($this->FormParameters["Unit"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                    $this->SumPrice->SetText($this->FormParameters["SumPrice"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->CollectCode->SetText($this->FormParameters["CollectCode"][$this->RowNumber], $this->RowNumber);
                    $this->Design->SetText($this->FormParameters["Design"][$this->RowNumber], $this->RowNumber);
                    $this->NameDesc->SetText($this->FormParameters["NameDesc"][$this->RowNumber], $this->RowNumber);
                    $this->Category->SetText($this->FormParameters["Category"][$this->RowNumber], $this->RowNumber);
                    $this->Size->SetText($this->FormParameters["Size"][$this->RowNumber], $this->RowNumber);
                    $this->Texture->SetText($this->FormParameters["Texture"][$this->RowNumber], $this->RowNumber);
                    $this->Color->SetText($this->FormParameters["Color"][$this->RowNumber], $this->RowNumber);
                    $this->Material->SetText($this->FormParameters["Material"][$this->RowNumber], $this->RowNumber);
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
                    $this->CollectPopup->Parameters = CCAddParam($this->CollectPopup->Parameters, "CollectID", $this->DataSource->f("CollectID"));
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Proforma_H_ID->Show($this->RowNumber);
                $this->CollectID->Show($this->RowNumber);
                $this->Qty->Show($this->RowNumber);
                $this->Unit->Show($this->RowNumber);
                $this->UnitPrice->Show($this->RowNumber);
                $this->SumPrice->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->CollectPopup->Show($this->RowNumber);
                $this->CollectCode->Show($this->RowNumber);
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->Design->Show($this->RowNumber);
                $this->NameDesc->Show($this->RowNumber);
                $this->Category->Show($this->RowNumber);
                $this->Size->Show($this->RowNumber);
                $this->Texture->Show($this->RowNumber);
                $this->Color->Show($this->RowNumber);
                $this->Material->Show($this->RowNumber);
                if (isset($this->RowsErrors[$this->RowNumber]) && ($this->RowsErrors[$this->RowNumber] != "")) {
                    $Tpl->setblockvar("RowError", "");
                    $Tpl->setvar("Error", $this->RowsErrors[$this->RowNumber]);
                    $this->Attributes->Show();
                    $Tpl->parse("RowError", false);
                } else {
                    $Tpl->setblockvar("RowError", "");
                }
                $Tpl->setvar("FormScript", $this->FormScript($this->RowNumber));
                $Tpl->parse();
                if ($is_next_record) {
                    if ($this->FormSubmitted) {
                        $is_next_record = $this->RowNumber < $this->UpdatedRows;
                        if (($this->DataSource->CachedColumns["Proforma_D_ID"] == $this->CachedColumns["Proforma_D_ID"][$this->RowNumber])) {
                            if ($this->ReadAllowed) $this->DataSource->next_record();
                        }
                    }else{
                        $is_next_record = ($this->RowNumber < $this->PageSize) &&  $this->ReadAllowed && $this->DataSource->next_record();
                    }
                } else { 
                    $EmptyRowsLeft--;
                }
            } while($is_next_record || ($EmptyRowsLeft && $this->InsertAllowed));
        } else {
            $Tpl->block_path = $EditableGridPath;
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $Tpl->block_path = $EditableGridPath;
        $this->Button_Submit->Show();
        $this->AddItemBtn->Show();
        $this->Total->Show();
        $this->Total_price->Show();

        if($this->CheckErrors()) {
            $Error = ComposeStrings($Error, $this->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DataSource->Errors->ToString());
            $Tpl->SetVar("Error", $Error);
            $Tpl->Parse("Error", false);
        }
        $CCSForm = $this->ComponentName;
        $this->HTMLFormAction = $FileName . "?" . CCAddParam(CCGetQueryString("QueryString", ""), "ccsForm", $CCSForm);
        $Tpl->SetVar("Action", !$CCSUseAmp ? $this->HTMLFormAction : str_replace("&", "&amp;", $this->HTMLFormAction));
        $Tpl->SetVar("HTMLFormName", $this->ComponentName);
        $Tpl->SetVar("HTMLFormEnctype", $this->FormEnctype);
        if (!$CCSUseAmp) {
            $Tpl->SetVar("HTMLFormProperties", "method=\"POST\" action=\"" . $this->HTMLFormAction . "\" name=\"" . $this->ComponentName . "\"");
        } else {
            $Tpl->SetVar("HTMLFormProperties", "method=\"post\" action=\"" . str_replace("&", "&amp;", $this->HTMLFormAction) . "\" id=\"" . $this->ComponentName . "\"");
        }
        $Tpl->SetVar("FormState", CCToHTML($this->GetFormState($NonEmptyRows)));
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewDetail Class @197-FCB6E20C

class clsAddNewDetailDataSource extends clsDBGayaFusionAll {  //AddNewDetailDataSource Class @197-9729D968

//DataSource Variables @197-256B1E28
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $CountSQL;
    public $wp;
    public $AllParametersSet;

    public $CachedColumns;
    public $CurrentRow;
    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $Proforma_H_ID;
    public $CollectID;
    public $Qty;
    public $Unit;
    public $UnitPrice;
    public $SumPrice;
    public $CheckBox_Delete;
    public $CollectPopup;
    public $CollectCode;
    public $RowIDAttribute;
    public $RowStyleAttribute;
    public $RowNameAttribute;
    public $Design;
    public $NameDesc;
    public $Category;
    public $Size;
    public $Texture;
    public $Color;
    public $Material;
//End DataSource Variables

//DataSourceClass_Initialize Event @197-81283263
    function clsAddNewDetailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->Initialize();
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->SumPrice = new clsField("SumPrice", ccsFloat, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->CollectPopup = new clsField("CollectPopup", ccsText, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->Design = new clsField("Design", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->Category = new clsField("Category", ccsText, "");
        
        $this->Size = new clsField("Size", ccsText, "");
        
        $this->Texture = new clsField("Texture", ccsText, "");
        
        $this->Color = new clsField("Color", ccsText, "");
        
        $this->Material = new clsField("Material", ccsText, "");
        

        $this->InsertFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @197-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @197-E98D79D9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlProforma_H_ID", ccsInteger, "", "", $this->Parameters["urlProforma_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Proforma_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @197-18E9A8C2
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_proforma_d";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_proforma_d {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @197-7A095F9C
    function SetValues()
    {
        $this->CachedColumns["Proforma_D_ID"] = $this->f("Proforma_D_ID");
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
    }
//End SetValues Method

//Insert Method @197-64820E02
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->InsertFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->InsertFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->InsertFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->InsertFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->InsertFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_proforma_d", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @197-3377AF48
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Proforma_D_ID=" . $this->ToSQL($this->CachedColumns["Proforma_D_ID"], ccsInteger);
        $this->UpdateFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->UpdateFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->UpdateFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->UpdateFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->UpdateFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->UpdateFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_proforma_d", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Update Method

//Delete Method @197-65C548DB
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Proforma_D_ID=" . $this->ToSQL($this->CachedColumns["Proforma_D_ID"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_proforma_d";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
        $this->Where = $SelectWhere;
    }
//End Delete Method

} //End AddNewDetailDataSource Class @197-FCB6E20C







//Initialize Page @1-9A397DBB
// Variables
$FileName = "";
$Redirect = "";
$Tpl = "";
$TemplateFileName = "";
$BlockToParse = "";
$ComponentName = "";
$Attributes = "";

// Events;
$CCSEvents = "";
$CCSEventResult = "";

$FileName = FileName;
$Redirect = "";
$TemplateFileName = "AddProforma.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-47384D23
include_once("./AddProforma_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D7B2DEB3
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddNewHeader = new clsRecordAddNewHeader("", $MainPage);
$AddNewDetail = new clsEditableGridAddNewDetail("", $MainPage);
$MainPage->AddNewHeader = & $AddNewHeader;
$MainPage->AddNewDetail = & $AddNewDetail;
$AddNewHeader->Initialize();
$AddNewDetail->Initialize();

BindEvents();

$CCSEventResult = CCGetEvent($CCSEvents, "AfterInitialize", $MainPage);

if ($Charset) {
    header("Content-Type: " . $ContentType . "; charset=" . $Charset);
} else {
    header("Content-Type: " . $ContentType);
}
//End Initialize Objects

//Initialize HTML Template @1-E710DB26
$CCSEventResult = CCGetEvent($CCSEvents, "OnInitializeView", $MainPage);
$Tpl = new clsTemplate($FileEncoding, $TemplateEncoding);
$Tpl->LoadTemplate(PathToCurrentPage . $TemplateFileName, $BlockToParse, "CP1252");
$Tpl->block_path = "/$BlockToParse";
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeShow", $MainPage);
$Attributes->SetValue("pathToRoot", "");
$Attributes->Show();
//End Initialize HTML Template

//Execute Components @1-5A7F0812
$AddNewHeader->Operation();
$AddNewDetail->Operation();
//End Execute Components

//Go to destination page @1-D72800B7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddNewHeader);
    unset($AddNewDetail);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C8B851A7
$AddNewHeader->Show();
$AddNewDetail->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-142ABB44
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddNewHeader);
unset($AddNewDetail);
unset($Tpl);
//End Unload Page
?>