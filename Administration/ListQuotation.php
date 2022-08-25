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
//Include Common Files @1-B6B0717C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ListQuotation.php");
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

//Class_Initialize Event @2-24CEBCF8
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
            $this->QuotationNo = new clsControl(ccsTextBox, "QuotationNo", "Quotation No", ccsText, "", CCGetRequestParam("QuotationNo", $Method, NULL), $this);
            $this->Validity = new clsControl(ccsTextBox, "Validity", "Validity", ccsText, "", CCGetRequestParam("Validity", $Method, NULL), $this);
            $this->QuotationDate = new clsControl(ccsTextBox, "QuotationDate", "Quotation Date", ccsDate, $DefaultDateFormat, CCGetRequestParam("QuotationDate", $Method, NULL), $this);
            $this->QuotationDate->Required = true;
            $this->DatePicker_QuotationDate = new clsDatePicker("DatePicker_QuotationDate", "AddNewHeader", "QuotationDate", $this);
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
            $this->SpecialInstruction = new clsControl(ccsTextArea, "SpecialInstruction", "Special Instruction", ccsMemo, "", CCGetRequestParam("SpecialInstruction", $Method, NULL), $this);
            $this->Revis = new clsControl(ccsTextBox, "Revis", "Revis", ccsText, "", CCGetRequestParam("Revis", $Method, NULL), $this);
            $this->LinkRev = new clsControl(ccsLink, "LinkRev", "LinkRev", ccsText, "", CCGetRequestParam("LinkRev", $Method, NULL), $this);
            $this->LinkRev->Page = "RevQuotation.php";
            $this->Currency = new clsControl(ccsListBox, "Currency", "Currency", ccsInteger, "", CCGetRequestParam("Currency", $Method, NULL), $this);
            $this->Currency->DSType = dsTable;
            $this->Currency->DataSource = new clsDBGayaFusionAll();
            $this->Currency->ds = & $this->Currency->DataSource;
            $this->Currency->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
            list($this->Currency->BoundColumn, $this->Currency->TextColumn, $this->Currency->DBFormat) = array("CurrencyID", "Currency", "");
            $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsListBox, "AddressID", "AddressID", ccsText, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
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
            $this->LinkChange->Page = "ListQuotation.php";
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
            $this->LinkChangeDeliveryContact->Page = "ListQuotation.php";
            $this->DeliveryAddress = new clsControl(ccsTextArea, "DeliveryAddress", "DeliveryAddress", ccsText, "", CCGetRequestParam("DeliveryAddress", $Method, NULL), $this);
            $this->DeliveryPhone = new clsControl(ccsTextBox, "DeliveryPhone", "Phone", ccsText, "", CCGetRequestParam("DeliveryPhone", $Method, NULL), $this);
            $this->DeliveryFax = new clsControl(ccsTextBox, "DeliveryFax", "Fax", ccsText, "", CCGetRequestParam("DeliveryFax", $Method, NULL), $this);
            $this->DeliveryEmail = new clsControl(ccsTextBox, "DeliveryEmail", "Email", ccsText, "", CCGetRequestParam("DeliveryEmail", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-045B5529
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-56949C63
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        if($this->EditMode && strlen($this->DataSource->Where))
            $Where = " AND NOT (" . $this->DataSource->Where . ")";
        $this->DataSource->QuotationNo->SetValue($this->QuotationNo->GetValue());
        if(CCDLookUp("COUNT(*)", "tbladminist_quotation_h", "QuotationNo=" . $this->DataSource->ToSQL($this->DataSource->QuotationNo->GetDBValue(), $this->DataSource->QuotationNo->DataType) . $Where, $this->DataSource) > 0)
            $this->QuotationNo->Errors->addError($CCSLocales->GetText("CCS_UniqueValue", "Quotation No"));
        $Validation = ($this->QuotationNo->Validate() && $Validation);
        $Validation = ($this->Validity->Validate() && $Validation);
        $Validation = ($this->QuotationDate->Validate() && $Validation);
        $Validation = ($this->DeliveryTerm->Validate() && $Validation);
        $Validation = ($this->DeliveryTime->Validate() && $Validation);
        $Validation = ($this->PaymentTerm->Validate() && $Validation);
        $Validation = ($this->SpecialInstruction->Validate() && $Validation);
        $Validation = ($this->Revis->Validate() && $Validation);
        $Validation = ($this->Currency->Validate() && $Validation);
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
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->QuotationNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Validity->Errors->Count() == 0);
        $Validation =  $Validation && ($this->QuotationDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTime->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PaymentTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SpecialInstruction->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Revis->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Currency->Errors->Count() == 0);
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
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-822DC7AF
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->QuotationNo->Errors->Count());
        $errors = ($errors || $this->Validity->Errors->Count());
        $errors = ($errors || $this->QuotationDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_QuotationDate->Errors->Count());
        $errors = ($errors || $this->DeliveryTerm->Errors->Count());
        $errors = ($errors || $this->DeliveryTime->Errors->Count());
        $errors = ($errors || $this->PaymentTerm->Errors->Count());
        $errors = ($errors || $this->SpecialInstruction->Errors->Count());
        $errors = ($errors || $this->Revis->Errors->Count());
        $errors = ($errors || $this->LinkRev->Errors->Count());
        $errors = ($errors || $this->Currency->Errors->Count());
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

//Operation Method @2-2D35286A
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
            $Redirect = "Quotation.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Quotation_H_ID", "AddressID", "ContactID"));
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "Quotation.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Quotation.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Quotation_H_ID", "AddressID", "QuotationContactID", "DeliveryContactID"));
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

//InsertRow Method @2-0F0BFED5
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->QuotationNo->SetValue($this->QuotationNo->GetValue(true));
        $this->DataSource->Validity->SetValue($this->Validity->GetValue(true));
        $this->DataSource->QuotationDate->SetValue($this->QuotationDate->GetValue(true));
        $this->DataSource->DeliveryTerm->SetValue($this->DeliveryTerm->GetValue(true));
        $this->DataSource->DeliveryTime->SetValue($this->DeliveryTime->GetValue(true));
        $this->DataSource->PaymentTerm->SetValue($this->PaymentTerm->GetValue(true));
        $this->DataSource->SpecialInstruction->SetValue($this->SpecialInstruction->GetValue(true));
        $this->DataSource->Revis->SetValue($this->Revis->GetValue(true));
        $this->DataSource->LinkRev->SetValue($this->LinkRev->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
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
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-67FE0EB9
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->QuotationNo->SetValue($this->QuotationNo->GetValue(true));
        $this->DataSource->Validity->SetValue($this->Validity->GetValue(true));
        $this->DataSource->QuotationDate->SetValue($this->QuotationDate->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->PackagingCost->SetValue($this->PackagingCost->GetValue(true));
        $this->DataSource->DeliveryTerm->SetValue($this->DeliveryTerm->GetValue(true));
        $this->DataSource->DeliveryTime->SetValue($this->DeliveryTime->GetValue(true));
        $this->DataSource->PaymentTerm->SetValue($this->PaymentTerm->GetValue(true));
        $this->DataSource->SpecialInstruction->SetValue($this->SpecialInstruction->GetValue(true));
        $this->DataSource->Revis->SetValue($this->Revis->GetValue(true));
        $this->DataSource->Attn->SetValue($this->Attn->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->DeliveryContactID->SetValue($this->DeliveryContactID->GetValue(true));
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

//Show Method @2-6E465F93
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
        $this->Currency->Prepare();
        $this->AddressID->Prepare();
        $this->Attn->Prepare();
        $this->ClientID->Prepare();
        $this->DeliveryContactID->Prepare();

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
                    $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
                    $this->Validity->SetValue($this->DataSource->Validity->GetValue());
                    $this->QuotationDate->SetValue($this->DataSource->QuotationDate->GetValue());
                    $this->DeliveryTerm->SetValue($this->DataSource->DeliveryTerm->GetValue());
                    $this->DeliveryTime->SetValue($this->DataSource->DeliveryTime->GetValue());
                    $this->PaymentTerm->SetValue($this->DataSource->PaymentTerm->GetValue());
                    $this->SpecialInstruction->SetValue($this->DataSource->SpecialInstruction->GetValue());
                    $this->Revis->SetValue($this->DataSource->Revis->GetValue());
                    $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                    $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                    $this->Attn->SetValue($this->DataSource->Attn->GetValue());
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
                    $this->DeliveryContactID->SetValue($this->DataSource->DeliveryContactID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        $this->LinkRev->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkRev->Parameters = CCAddParam($this->LinkRev->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
        $this->LinkChange->Parameters = CCGetQueryString("QueryString", array("QuotationContactID", "ccsForm"));
        $this->LinkChange->Parameters = CCAddParam($this->LinkChange->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
        $this->LinkChange->Parameters = CCAddParam($this->LinkChange->Parameters, "AddressID", $this->DataSource->f("AddressID"));
        $this->LinkChangeDeliveryContact->Parameters = CCGetQueryString("QueryString", array("DeliveryContactID", "ccsForm"));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "AddressID", $this->DataSource->f("AddressID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->QuotationNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Validity->Errors->ToString());
            $Error = ComposeStrings($Error, $this->QuotationDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_QuotationDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTime->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PaymentTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SpecialInstruction->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Revis->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkRev->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Currency->Errors->ToString());
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
        $this->QuotationNo->Show();
        $this->Validity->Show();
        $this->QuotationDate->Show();
        $this->DatePicker_QuotationDate->Show();
        $this->DeliveryTerm->Show();
        $this->DeliveryTime->Show();
        $this->PaymentTerm->Show();
        $this->SpecialInstruction->Show();
        $this->Revis->Show();
        $this->LinkRev->Show();
        $this->Currency->Show();
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
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-2310F113
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
    public $QuotationNo;
    public $Validity;
    public $QuotationDate;
    public $DeliveryTerm;
    public $DeliveryTime;
    public $PaymentTerm;
    public $SpecialInstruction;
    public $Revis;
    public $LinkRev;
    public $Currency;
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-62BF9B2D
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->Validity = new clsField("Validity", ccsText, "");
        
        $this->QuotationDate = new clsField("QuotationDate", ccsDate, $this->DateFormat);
        
        $this->DeliveryTerm = new clsField("DeliveryTerm", ccsText, "");
        
        $this->DeliveryTime = new clsField("DeliveryTime", ccsText, "");
        
        $this->PaymentTerm = new clsField("PaymentTerm", ccsText, "");
        
        $this->SpecialInstruction = new clsField("SpecialInstruction", ccsMemo, "");
        
        $this->Revis = new clsField("Revis", ccsText, "");
        
        $this->LinkRev = new clsField("LinkRev", ccsText, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsText, "");
        
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
        

        $this->InsertFields["QuotationNo"] = array("Name" => "QuotationNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Validity"] = array("Name" => "Validity", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["QuotationDate"] = array("Name" => "QuotationDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryTermID"] = array("Name" => "DeliveryTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["PaymentTermID"] = array("Name" => "PaymentTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SpecialInstruction"] = array("Name" => "SpecialInstruction", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Rev"] = array("Name" => "Rev", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DocMaker"] = array("Name" => "DocMaker", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["QuotationContactID"] = array("Name" => "QuotationContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["DeliveryContactID"] = array("Name" => "DeliveryContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["QuotationNo"] = array("Name" => "QuotationNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Validity"] = array("Name" => "Validity", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["QuotationDate"] = array("Name" => "QuotationDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTermID"] = array("Name" => "DeliveryTermID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTimeID"] = array("Name" => "DeliveryTimeID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["PaymentTermID"] = array("Name" => "PaymentTermID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["SpecialInstruction"] = array("Name" => "SpecialInstruction", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Rev"] = array("Name" => "Rev", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["QuotationContactID"] = array("Name" => "QuotationContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Currency"] = array("Name" => "Currency", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryContactID"] = array("Name" => "DeliveryContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-473C7BB8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-854E22A8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_quotation_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-7C53DF39
    function SetValues()
    {
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->Validity->SetDBValue($this->f("Validity"));
        $this->QuotationDate->SetDBValue(trim($this->f("QuotationDate")));
        $this->DeliveryTerm->SetDBValue($this->f("DeliveryTermID"));
        $this->DeliveryTime->SetDBValue($this->f("DeliveryTimeID"));
        $this->PaymentTerm->SetDBValue($this->f("PaymentTermID"));
        $this->SpecialInstruction->SetDBValue($this->f("SpecialInstruction"));
        $this->Revis->SetDBValue($this->f("Rev"));
        $this->Currency->SetDBValue(trim($this->f("Currency")));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
        $this->AddressID->SetDBValue($this->f("AddressID"));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->Attn->SetDBValue(trim($this->f("QuotationContactID")));
        $this->ClientID->SetDBValue(trim($this->f("ClientID")));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->DeliveryContactID->SetDBValue(trim($this->f("DeliveryContactID")));
    }
//End SetValues Method

//Insert Method @2-1EC99DBD
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["QuotationNo"]["Value"] = $this->QuotationNo->GetDBValue(true);
        $this->InsertFields["Validity"]["Value"] = $this->Validity->GetDBValue(true);
        $this->InsertFields["QuotationDate"]["Value"] = $this->QuotationDate->GetDBValue(true);
        $this->InsertFields["DeliveryTermID"]["Value"] = $this->DeliveryTerm->GetDBValue(true);
        $this->InsertFields["DeliveryTimeID"]["Value"] = $this->DeliveryTime->GetDBValue(true);
        $this->InsertFields["PaymentTermID"]["Value"] = $this->PaymentTerm->GetDBValue(true);
        $this->InsertFields["SpecialInstruction"]["Value"] = $this->SpecialInstruction->GetDBValue(true);
        $this->InsertFields["Rev"]["Value"] = $this->Revis->GetDBValue(true);
        $this->InsertFields["Currency"]["Value"] = $this->Currency->GetDBValue(true);
        $this->InsertFields["DocMaker"]["Value"] = $this->DocMaker->GetDBValue(true);
        $this->InsertFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->InsertFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->InsertFields["QuotationContactID"]["Value"] = $this->Attn->GetDBValue(true);
        $this->InsertFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->InsertFields["PackagingCost"]["Value"] = $this->PackagingCost->GetDBValue(true);
        $this->InsertFields["DeliveryContactID"]["Value"] = $this->DeliveryContactID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_quotation_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-171FF5C9
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->cp["QuotationNo"] = new clsSQLParameter("ctrlQuotationNo", ccsText, "", "", $this->QuotationNo->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["Validity"] = new clsSQLParameter("ctrlValidity", ccsText, "", "", $this->Validity->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["QuotationDate"] = new clsSQLParameter("ctrlQuotationDate", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->QuotationDate->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ClientOrderRef"] = new clsSQLParameter("ctrlClientOrderRef", ccsText, "", "", $this->ClientOrderRef->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["ClientID"] = new clsSQLParameter("ctrlClientID", ccsInteger, "", "", $this->ClientID->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PackagingCost"] = new clsSQLParameter("ctrlPackagingCost", ccsFloat, "", "", $this->PackagingCost->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DeliveryTermID"] = new clsSQLParameter("ctrlDeliveryTerm", ccsInteger, "", "", $this->DeliveryTerm->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DeliveryTimeID"] = new clsSQLParameter("ctrlDeliveryTime", ccsInteger, "", "", $this->DeliveryTime->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["PaymentTermID"] = new clsSQLParameter("ctrlPaymentTerm", ccsInteger, "", "", $this->PaymentTerm->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["SpecialInstruction"] = new clsSQLParameter("ctrlSpecialInstruction", ccsMemo, "", "", $this->SpecialInstruction->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["Rev"] = new clsSQLParameter("ctrlRevis", ccsText, "", "", $this->Revis->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["QuotationContactID"] = new clsSQLParameter("ctrlAttn", ccsInteger, "", "", $this->Attn->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["AddressID"] = new clsSQLParameter("ctrlAddressID", ccsText, "", "", $this->AddressID->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["Currency"] = new clsSQLParameter("ctrlCurrency", ccsInteger, "", "", $this->Currency->GetValue(true), NULL, false, $this->ErrorBlock);
        $this->cp["DeliveryContactID"] = new clsSQLParameter("ctrlDeliveryContactID", ccsInteger, "", "", $this->DeliveryContactID->GetValue(true), NULL, false, $this->ErrorBlock);
        $wp = new clsSQLParameters($this->ErrorBlock);
        $wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", CCGetFromGet("Quotation_H_ID", NULL), "", false);
        if(!$wp->AllParamsSet()) {
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        }
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        if (!is_null($this->cp["QuotationNo"]->GetValue()) and !strlen($this->cp["QuotationNo"]->GetText()) and !is_bool($this->cp["QuotationNo"]->GetValue())) 
            $this->cp["QuotationNo"]->SetValue($this->QuotationNo->GetValue(true));
        if (!is_null($this->cp["Validity"]->GetValue()) and !strlen($this->cp["Validity"]->GetText()) and !is_bool($this->cp["Validity"]->GetValue())) 
            $this->cp["Validity"]->SetValue($this->Validity->GetValue(true));
        if (!is_null($this->cp["QuotationDate"]->GetValue()) and !strlen($this->cp["QuotationDate"]->GetText()) and !is_bool($this->cp["QuotationDate"]->GetValue())) 
            $this->cp["QuotationDate"]->SetValue($this->QuotationDate->GetValue(true));
        if (!is_null($this->cp["ClientOrderRef"]->GetValue()) and !strlen($this->cp["ClientOrderRef"]->GetText()) and !is_bool($this->cp["ClientOrderRef"]->GetValue())) 
            $this->cp["ClientOrderRef"]->SetValue($this->ClientOrderRef->GetValue(true));
        if (!is_null($this->cp["ClientID"]->GetValue()) and !strlen($this->cp["ClientID"]->GetText()) and !is_bool($this->cp["ClientID"]->GetValue())) 
            $this->cp["ClientID"]->SetValue($this->ClientID->GetValue(true));
        if (!is_null($this->cp["PackagingCost"]->GetValue()) and !strlen($this->cp["PackagingCost"]->GetText()) and !is_bool($this->cp["PackagingCost"]->GetValue())) 
            $this->cp["PackagingCost"]->SetValue($this->PackagingCost->GetValue(true));
        if (!is_null($this->cp["DeliveryTermID"]->GetValue()) and !strlen($this->cp["DeliveryTermID"]->GetText()) and !is_bool($this->cp["DeliveryTermID"]->GetValue())) 
            $this->cp["DeliveryTermID"]->SetValue($this->DeliveryTerm->GetValue(true));
        if (!is_null($this->cp["DeliveryTimeID"]->GetValue()) and !strlen($this->cp["DeliveryTimeID"]->GetText()) and !is_bool($this->cp["DeliveryTimeID"]->GetValue())) 
            $this->cp["DeliveryTimeID"]->SetValue($this->DeliveryTime->GetValue(true));
        if (!is_null($this->cp["PaymentTermID"]->GetValue()) and !strlen($this->cp["PaymentTermID"]->GetText()) and !is_bool($this->cp["PaymentTermID"]->GetValue())) 
            $this->cp["PaymentTermID"]->SetValue($this->PaymentTerm->GetValue(true));
        if (!is_null($this->cp["SpecialInstruction"]->GetValue()) and !strlen($this->cp["SpecialInstruction"]->GetText()) and !is_bool($this->cp["SpecialInstruction"]->GetValue())) 
            $this->cp["SpecialInstruction"]->SetValue($this->SpecialInstruction->GetValue(true));
        if (!is_null($this->cp["Rev"]->GetValue()) and !strlen($this->cp["Rev"]->GetText()) and !is_bool($this->cp["Rev"]->GetValue())) 
            $this->cp["Rev"]->SetValue($this->Revis->GetValue(true));
        if (!is_null($this->cp["QuotationContactID"]->GetValue()) and !strlen($this->cp["QuotationContactID"]->GetText()) and !is_bool($this->cp["QuotationContactID"]->GetValue())) 
            $this->cp["QuotationContactID"]->SetValue($this->Attn->GetValue(true));
        if (!is_null($this->cp["AddressID"]->GetValue()) and !strlen($this->cp["AddressID"]->GetText()) and !is_bool($this->cp["AddressID"]->GetValue())) 
            $this->cp["AddressID"]->SetValue($this->AddressID->GetValue(true));
        if (!is_null($this->cp["Currency"]->GetValue()) and !strlen($this->cp["Currency"]->GetText()) and !is_bool($this->cp["Currency"]->GetValue())) 
            $this->cp["Currency"]->SetValue($this->Currency->GetValue(true));
        if (!is_null($this->cp["DeliveryContactID"]->GetValue()) and !strlen($this->cp["DeliveryContactID"]->GetText()) and !is_bool($this->cp["DeliveryContactID"]->GetValue())) 
            $this->cp["DeliveryContactID"]->SetValue($this->DeliveryContactID->GetValue(true));
        $wp->Criterion[1] = $wp->Operation(opEqual, "Quotation_H_ID", $wp->GetDBValue("1"), $this->ToSQL($wp->GetDBValue("1"), ccsInteger),false);
        $Where = 
             $wp->Criterion[1];
        $this->UpdateFields["QuotationNo"]["Value"] = $this->cp["QuotationNo"]->GetDBValue(true);
        $this->UpdateFields["Validity"]["Value"] = $this->cp["Validity"]->GetDBValue(true);
        $this->UpdateFields["QuotationDate"]["Value"] = $this->cp["QuotationDate"]->GetDBValue(true);
        $this->UpdateFields["ClientOrderRef"]["Value"] = $this->cp["ClientOrderRef"]->GetDBValue(true);
        $this->UpdateFields["ClientID"]["Value"] = $this->cp["ClientID"]->GetDBValue(true);
        $this->UpdateFields["PackagingCost"]["Value"] = $this->cp["PackagingCost"]->GetDBValue(true);
        $this->UpdateFields["DeliveryTermID"]["Value"] = $this->cp["DeliveryTermID"]->GetDBValue(true);
        $this->UpdateFields["DeliveryTimeID"]["Value"] = $this->cp["DeliveryTimeID"]->GetDBValue(true);
        $this->UpdateFields["PaymentTermID"]["Value"] = $this->cp["PaymentTermID"]->GetDBValue(true);
        $this->UpdateFields["SpecialInstruction"]["Value"] = $this->cp["SpecialInstruction"]->GetDBValue(true);
        $this->UpdateFields["Rev"]["Value"] = $this->cp["Rev"]->GetDBValue(true);
        $this->UpdateFields["QuotationContactID"]["Value"] = $this->cp["QuotationContactID"]->GetDBValue(true);
        $this->UpdateFields["AddressID"]["Value"] = $this->cp["AddressID"]->GetDBValue(true);
        $this->UpdateFields["Currency"]["Value"] = $this->cp["Currency"]->GetDBValue(true);
        $this->UpdateFields["DeliveryContactID"]["Value"] = $this->cp["DeliveryContactID"]->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_quotation_h", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $Where, "");
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

//Delete Method @2-6C397083
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbladminist_quotation_h";
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

class clsEditableGridAddNewDetail { //AddNewDetail Class @24-254BF570

//Variables @24-F9538F3C

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

//Class_Initialize Event @24-8471DE6B
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
        $this->CachedColumns["Quotation_D_ID"][0] = "Quotation_D_ID";
        $this->DataSource = new clsAddNewDetailDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 30;
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

        $this->RndCode = new clsControl(ccsTextBox, "RndCode", "Rnd Code", ccsText, "", NULL, $this);
        $this->RndCode->Required = true;
        $this->UnitPrice = new clsControl(ccsTextBox, "UnitPrice", "Unit Price", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), NULL, $this);
        $this->Remark = new clsControl(ccsTextArea, "Remark", "Remark", ccsMemo, "", NULL, $this);
        $this->CheckBox_Delete = new clsControl(ccsCheckBox, "CheckBox_Delete", "CheckBox_Delete", ccsBoolean, $CCSLocales->GetFormatInfo("BooleanFormat"), NULL, $this);
        $this->CheckBox_Delete->CheckedValue = true;
        $this->CheckBox_Delete->UncheckedValue = false;
        $this->Button_Submit = new clsButton("Button_Submit", $Method, $this);
        $this->RowIDAttribute = new clsControl(ccsLabel, "RowIDAttribute", "RowIDAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute = new clsControl(ccsLabel, "RowStyleAttribute", "RowStyleAttribute", ccsText, "", NULL, $this);
        $this->RowStyleAttribute->HTML = true;
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation H ID", ccsInteger, "", NULL, $this);
        $this->RowNameAttribute = new clsControl(ccsLabel, "RowNameAttribute", "RowNameAttribute", ccsText, "", NULL, $this);
        $this->AddItemBtn = new clsButton("AddItemBtn", $Method, $this);
        $this->RndPop = new clsControl(ccsImageLink, "RndPop", "RndPop", ccsText, "", NULL, $this);
        $this->RndPop->Parameters = CCGetQueryString("QueryString", array("Quotation_H_ID", "AddressID", "ContactID", "ccsForm"));
        $this->RndPop->Page = "RndPopup.php";
    }
//End Class_Initialize Event

//Initialize Method @24-43924252
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlQuotation_H_ID"] = CCGetFromGet("Quotation_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @24-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @24-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @24-8E3E7753
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["RndCode"][$RowNumber] = CCGetFromPost("RndCode_" . $RowNumber, NULL);
            $this->FormParameters["UnitPrice"][$RowNumber] = CCGetFromPost("UnitPrice_" . $RowNumber, NULL);
            $this->FormParameters["Remark"][$RowNumber] = CCGetFromPost("Remark_" . $RowNumber, NULL);
            $this->FormParameters["CheckBox_Delete"][$RowNumber] = CCGetFromPost("CheckBox_Delete_" . $RowNumber, NULL);
            $this->FormParameters["Quotation_H_ID"][$RowNumber] = CCGetFromPost("Quotation_H_ID_" . $RowNumber, NULL);
        }
    }
//End GetFormParameters Method

//Validate Method @24-1142D603
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Quotation_D_ID"] = $this->CachedColumns["Quotation_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->RndCode->SetText($this->FormParameters["RndCode"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
            $this->Remark->SetText($this->FormParameters["Remark"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->Quotation_H_ID->SetText($this->FormParameters["Quotation_H_ID"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @24-23A30696
    function ValidateRow()
    {
        global $CCSLocales;
        $this->RndCode->Validate();
        $this->UnitPrice->Validate();
        $this->Remark->Validate();
        $this->CheckBox_Delete->Validate();
        $this->Quotation_H_ID->Validate();
        $this->RowErrors = new clsErrors();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidateRow", $this);
        $errors = "";
        $errors = ComposeStrings($errors, $this->RndCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Remark->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CheckBox_Delete->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $this->RndCode->Errors->Clear();
        $this->UnitPrice->Errors->Clear();
        $this->Remark->Errors->Clear();
        $this->CheckBox_Delete->Errors->Clear();
        $this->Quotation_H_ID->Errors->Clear();
        $errors = ComposeStrings($errors, $this->RowErrors->ToString());
        $this->RowsErrors[$this->RowNumber] = $errors;
        return $errors != "" ? 0 : 1;
    }
//End ValidateRow Method

//CheckInsert Method @24-0E83A057
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["RndCode"][$this->RowNumber]) && count($this->FormParameters["RndCode"][$this->RowNumber])) || strlen($this->FormParameters["RndCode"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["UnitPrice"][$this->RowNumber]) && count($this->FormParameters["UnitPrice"][$this->RowNumber])) || strlen($this->FormParameters["UnitPrice"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Remark"][$this->RowNumber]) && count($this->FormParameters["Remark"][$this->RowNumber])) || strlen($this->FormParameters["Remark"][$this->RowNumber]));
        $filed = ($filed || (is_array($this->FormParameters["Quotation_H_ID"][$this->RowNumber]) && count($this->FormParameters["Quotation_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["Quotation_H_ID"][$this->RowNumber]));
        return $filed;
    }
//End CheckInsert Method

//CheckErrors Method @24-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @24-8694AC85
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
        }

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Submit") {
            if(!CCGetEvent($this->Button_Submit->CCSEvents, "OnClick", $this->Button_Submit) || !$this->UpdateGrid()) {
                $Redirect = "";
            } else {
                $Redirect = "Quotation.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Quotation_H_ID", "AddressID", "ContactID"));
            }
        } else if($this->PressedButton == "AddItemBtn") {
            if(!CCGetEvent($this->AddItemBtn->CCSEvents, "OnClick", $this->AddItemBtn)) {
                $Redirect = "";
            }
        } else {
            $Redirect = "";
        }
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//UpdateGrid Method @24-EBD73A19
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Quotation_D_ID"] = $this->CachedColumns["Quotation_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->RndCode->SetText($this->FormParameters["RndCode"][$this->RowNumber], $this->RowNumber);
            $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
            $this->Remark->SetText($this->FormParameters["Remark"][$this->RowNumber], $this->RowNumber);
            $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
            $this->Quotation_H_ID->SetText($this->FormParameters["Quotation_H_ID"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @24-9BC0E4F3
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->RndCode->SetValue($this->RndCode->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
        $this->DataSource->Remark->SetValue($this->Remark->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->RndPop->SetValue($this->RndPop->GetValue(true));
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

//UpdateRow Method @24-5A885354
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->RndCode->SetValue($this->RndCode->GetValue(true));
        $this->DataSource->UnitPrice->SetValue($this->UnitPrice->GetValue(true));
        $this->DataSource->Remark->SetValue($this->Remark->GetValue(true));
        $this->DataSource->RowIDAttribute->SetValue($this->RowIDAttribute->GetValue(true));
        $this->DataSource->RowStyleAttribute->SetValue($this->RowStyleAttribute->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->RowNameAttribute->SetValue($this->RowNameAttribute->GetValue(true));
        $this->DataSource->RndPop->SetValue($this->RndPop->GetValue(true));
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

//DeleteRow Method @24-A4A656F6
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

//FormScript Method @24-F93E4F6A
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var AddNewDetailElements;\n";
        $script .= "var AddNewDetailEmptyRows = 30;\n";
        $script .= "var " . $this->ComponentName . "RndCodeID = 0;\n";
        $script .= "var " . $this->ComponentName . "UnitPriceID = 1;\n";
        $script .= "var " . $this->ComponentName . "RemarkID = 2;\n";
        $script .= "var " . $this->ComponentName . "DeleteControl = 3;\n";
        $script .= "var " . $this->ComponentName . "Quotation_H_IDID = 4;\n";
        $script .= "\nfunction initAddNewDetailElements() {\n";
        $script .= "\tvar ED = document.forms[\"AddNewDetail\"];\n";
        $script .= "\tAddNewDetailElements = new Array (\n";
        for($i = 1; $i <= $TotalRows; $i++) {
            $script .= "\t\tnew Array(" . "ED.RndCode_" . $i . ", " . "ED.UnitPrice_" . $i . ", " . "ED.Remark_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.Quotation_H_ID_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @24-232720C2
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
                $this->CachedColumns["Quotation_D_ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["Quotation_D_ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @24-B0B376E2
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["Quotation_D_ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @24-C74FC89A
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
        $this->ControlsVisible["RndCode"] = $this->RndCode->Visible;
        $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
        $this->ControlsVisible["Remark"] = $this->Remark->Visible;
        $this->ControlsVisible["CheckBox_Delete"] = $this->CheckBox_Delete->Visible;
        $this->ControlsVisible["RowIDAttribute"] = $this->RowIDAttribute->Visible;
        $this->ControlsVisible["RowStyleAttribute"] = $this->RowStyleAttribute->Visible;
        $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
        $this->ControlsVisible["RowNameAttribute"] = $this->RowNameAttribute->Visible;
        $this->ControlsVisible["RndPop"] = $this->RndPop->Visible;
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
                    $this->CachedColumns["Quotation_D_ID"][$this->RowNumber] = $this->DataSource->CachedColumns["Quotation_D_ID"];
                    $this->CheckBox_Delete->SetValue("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RndPop->SetText("");
                    $this->RndCode->SetValue($this->DataSource->RndCode->GetValue());
                    $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                    $this->Remark->SetValue($this->DataSource->Remark->GetValue());
                    $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                } elseif ($this->FormSubmitted && $is_next_record) {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RndPop->SetText("");
                    $this->RndCode->SetText($this->FormParameters["RndCode"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                    $this->Remark->SetText($this->FormParameters["Remark"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->Quotation_H_ID->SetText($this->FormParameters["Quotation_H_ID"][$this->RowNumber], $this->RowNumber);
                } elseif (!$this->FormSubmitted) {
                    $this->CachedColumns["Quotation_D_ID"][$this->RowNumber] = "";
                    $this->RndCode->SetText("");
                    $this->UnitPrice->SetText("");
                    $this->Remark->SetText("");
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->Quotation_H_ID->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RndPop->SetText("");
                } else {
                    $this->RowIDAttribute->SetText("");
                    $this->RowStyleAttribute->SetText("");
                    $this->RowNameAttribute->SetText("");
                    $this->RndPop->SetText("");
                    $this->RndCode->SetText($this->FormParameters["RndCode"][$this->RowNumber], $this->RowNumber);
                    $this->UnitPrice->SetText($this->FormParameters["UnitPrice"][$this->RowNumber], $this->RowNumber);
                    $this->Remark->SetText($this->FormParameters["Remark"][$this->RowNumber], $this->RowNumber);
                    $this->CheckBox_Delete->SetText($this->FormParameters["CheckBox_Delete"][$this->RowNumber], $this->RowNumber);
                    $this->Quotation_H_ID->SetText($this->FormParameters["Quotation_H_ID"][$this->RowNumber], $this->RowNumber);
                }
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->RndCode->Show($this->RowNumber);
                $this->UnitPrice->Show($this->RowNumber);
                $this->Remark->Show($this->RowNumber);
                $this->CheckBox_Delete->Show($this->RowNumber);
                $this->RowIDAttribute->Show($this->RowNumber);
                $this->RowStyleAttribute->Show($this->RowNumber);
                $this->Quotation_H_ID->Show($this->RowNumber);
                $this->RowNameAttribute->Show($this->RowNumber);
                $this->RndPop->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["Quotation_D_ID"] == $this->CachedColumns["Quotation_D_ID"][$this->RowNumber])) {
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

} //End AddNewDetail Class @24-FCB6E20C

class clsAddNewDetailDataSource extends clsDBGayaFusionAll {  //AddNewDetailDataSource Class @24-9729D968

//DataSource Variables @24-5C8FBF0D
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
    public $RndCode;
    public $UnitPrice;
    public $Remark;
    public $CheckBox_Delete;
    public $RowIDAttribute;
    public $RowStyleAttribute;
    public $Quotation_H_ID;
    public $RowNameAttribute;
    public $RndPop;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-959FD28D
    function clsAddNewDetailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->Initialize();
        $this->RndCode = new clsField("RndCode", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Remark = new clsField("Remark", ccsMemo, "");
        
        $this->CheckBox_Delete = new clsField("CheckBox_Delete", ccsBoolean, $this->BooleanFormat);
        
        $this->RowIDAttribute = new clsField("RowIDAttribute", ccsText, "");
        
        $this->RowStyleAttribute = new clsField("RowStyleAttribute", ccsText, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->RowNameAttribute = new clsField("RowNameAttribute", ccsText, "");
        
        $this->RndPop = new clsField("RndPop", ccsText, "");
        

        $this->InsertFields["RndCode"] = array("Name" => "RndCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["Remark"] = array("Name" => "Remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->InsertFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["RndCode"] = array("Name" => "RndCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["Remark"] = array("Name" => "Remark", "Value" => "", "DataType" => ccsMemo, "OmitIfEmpty" => 1);
        $this->UpdateFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @24-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @24-473C7BB8
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlQuotation_H_ID", ccsInteger, "", "", $this->Parameters["urlQuotation_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Quotation_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @24-7FB24A4A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_quotation_d";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_quotation_d {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-698501BB
    function SetValues()
    {
        $this->CachedColumns["Quotation_D_ID"] = $this->f("Quotation_D_ID");
        $this->RndCode->SetDBValue($this->f("RndCode"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Remark->SetDBValue($this->f("Remark"));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
    }
//End SetValues Method

//Insert Method @24-5AA6239B
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["RndCode"]["Value"] = $this->RndCode->GetDBValue(true);
        $this->InsertFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->InsertFields["Remark"]["Value"] = $this->Remark->GetDBValue(true);
        $this->InsertFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_quotation_d", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-D4036B2D
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Quotation_D_ID=" . $this->ToSQL($this->CachedColumns["Quotation_D_ID"], ccsInteger);
        $this->UpdateFields["RndCode"]["Value"] = $this->RndCode->GetDBValue(true);
        $this->UpdateFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->UpdateFields["Remark"]["Value"] = $this->Remark->GetDBValue(true);
        $this->UpdateFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_quotation_d", $this->UpdateFields, $this);
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

//Delete Method @24-71509385
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Quotation_D_ID=" . $this->ToSQL($this->CachedColumns["Quotation_D_ID"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_quotation_d";
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

} //End AddNewDetailDataSource Class @24-FCB6E20C





//Initialize Page @1-6E3AA8E9
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
$TemplateFileName = "ListQuotation.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-F68F0F66
include_once("./ListQuotation_events.php");
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

//Show Page @1-7D56FD7C
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
