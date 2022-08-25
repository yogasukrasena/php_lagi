<?php
//Include Common Files @1-F9AC08A7
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddInvoice.php");
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

//Class_Initialize Event @2-4AFCB688
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
        $this->UpdateAllowed = true;
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
            $this->InvoiceNo = new clsControl(ccsTextBox, "InvoiceNo", "Invoice No", ccsText, "", CCGetRequestParam("InvoiceNo", $Method, NULL), $this);
            $this->DueDate = new clsControl(ccsTextBox, "DueDate", "Due Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("DueDate", $Method, NULL), $this);
            $this->DueDate->Required = true;
            $this->DatePicker_DueDate = new clsDatePicker("DatePicker_DueDate", "AddNewHeader", "DueDate", $this);
            $this->InvoiceAddressContact = new clsControl(ccsListBox, "InvoiceAddressContact", "Invoice Address", ccsInteger, "", CCGetRequestParam("InvoiceAddressContact", $Method, NULL), $this);
            $this->InvoiceAddressContact->DSType = dsTable;
            $this->InvoiceAddressContact->DataSource = new clsDBGayaFusionAll();
            $this->InvoiceAddressContact->ds = & $this->InvoiceAddressContact->DataSource;
            $this->InvoiceAddressContact->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
            list($this->InvoiceAddressContact->BoundColumn, $this->InvoiceAddressContact->TextColumn, $this->InvoiceAddressContact->DBFormat) = array("ContactId", "ContactName", "");
            $this->InvoiceAddressContact->DataSource->Parameters["urladdressid"] = CCGetFromGet("addressid", NULL);
            $this->InvoiceAddressContact->DataSource->wp = new clsSQLParameters();
            $this->InvoiceAddressContact->DataSource->wp->AddParameter("1", "urladdressid", ccsInteger, "", "", $this->InvoiceAddressContact->DataSource->Parameters["urladdressid"], "", false);
            $this->InvoiceAddressContact->DataSource->wp->Criterion[1] = $this->InvoiceAddressContact->DataSource->wp->Operation(opEqual, "AddressID", $this->InvoiceAddressContact->DataSource->wp->GetDBValue("1"), $this->InvoiceAddressContact->DataSource->ToSQL($this->InvoiceAddressContact->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->InvoiceAddressContact->DataSource->Where = 
                 $this->InvoiceAddressContact->DataSource->wp->Criterion[1];
            $this->DeliveryAddressContact = new clsControl(ccsListBox, "DeliveryAddressContact", "Delivery Address", ccsInteger, "", CCGetRequestParam("DeliveryAddressContact", $Method, NULL), $this);
            $this->DeliveryAddressContact->DSType = dsTable;
            $this->DeliveryAddressContact->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryAddressContact->ds = & $this->DeliveryAddressContact->DataSource;
            $this->DeliveryAddressContact->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook_contact {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryAddressContact->BoundColumn, $this->DeliveryAddressContact->TextColumn, $this->DeliveryAddressContact->DBFormat) = array("ContactId", "ContactName", "");
            $this->DeliveryAddressContact->DataSource->Parameters["urladdressid"] = CCGetFromGet("addressid", NULL);
            $this->DeliveryAddressContact->DataSource->wp = new clsSQLParameters();
            $this->DeliveryAddressContact->DataSource->wp->AddParameter("1", "urladdressid", ccsInteger, "", "", $this->DeliveryAddressContact->DataSource->Parameters["urladdressid"], "", false);
            $this->DeliveryAddressContact->DataSource->wp->Criterion[1] = $this->DeliveryAddressContact->DataSource->wp->Operation(opEqual, "AddressID", $this->DeliveryAddressContact->DataSource->wp->GetDBValue("1"), $this->DeliveryAddressContact->DataSource->ToSQL($this->DeliveryAddressContact->DataSource->wp->GetDBValue("1"), ccsInteger),false);
            $this->DeliveryAddressContact->DataSource->Where = 
                 $this->DeliveryAddressContact->DataSource->wp->Criterion[1];
            $this->DeliveryTerm = new clsControl(ccsListBox, "DeliveryTerm", "DeliveryTerm", ccsText, "", CCGetRequestParam("DeliveryTerm", $Method, NULL), $this);
            $this->DeliveryTerm->DSType = dsTable;
            $this->DeliveryTerm->DataSource = new clsDBGayaFusionAll();
            $this->DeliveryTerm->ds = & $this->DeliveryTerm->DataSource;
            $this->DeliveryTerm->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_deliveryterm {SQL_Where} {SQL_OrderBy}";
            list($this->DeliveryTerm->BoundColumn, $this->DeliveryTerm->TextColumn, $this->DeliveryTerm->DBFormat) = array("DeliveryTermID", "DeliveryTerm", "");
            $this->PaymentTerm = new clsControl(ccsListBox, "PaymentTerm", "PaymentTerm", ccsText, "", CCGetRequestParam("PaymentTerm", $Method, NULL), $this);
            $this->PaymentTerm->DSType = dsTable;
            $this->PaymentTerm->DataSource = new clsDBGayaFusionAll();
            $this->PaymentTerm->ds = & $this->PaymentTerm->DataSource;
            $this->PaymentTerm->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_paymentterm {SQL_Where} {SQL_OrderBy}";
            list($this->PaymentTerm->BoundColumn, $this->PaymentTerm->TextColumn, $this->PaymentTerm->DBFormat) = array("PaymentTermID", "PaymentTerm", "");
            $this->ClientOrderRef = new clsControl(ccsTextBox, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsListBox, "AddressID", "AddressID", ccsInteger, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->AddressID->DSType = dsTable;
            $this->AddressID->DataSource = new clsDBGayaFusionAll();
            $this->AddressID->ds = & $this->AddressID->DataSource;
            $this->AddressID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
            list($this->AddressID->BoundColumn, $this->AddressID->TextColumn, $this->AddressID->DBFormat) = array("AddressID", "Company", "");
            $this->GayaOrderRef = new clsControl(ccsTextBox, "GayaOrderRef", "GayaOrderRef", ccsText, "", CCGetRequestParam("GayaOrderRef", $Method, NULL), $this);
            $this->InvoiceAddress = new clsControl(ccsTextArea, "InvoiceAddress", "Address", ccsMemo, "", CCGetRequestParam("InvoiceAddress", $Method, NULL), $this);
            $this->InvoicePhone = new clsControl(ccsTextBox, "InvoicePhone", "Phone", ccsText, "", CCGetRequestParam("InvoicePhone", $Method, NULL), $this);
            $this->DeliveryPhone = new clsControl(ccsTextBox, "DeliveryPhone", "Phone", ccsText, "", CCGetRequestParam("DeliveryPhone", $Method, NULL), $this);
            $this->InvoiceFax = new clsControl(ccsTextBox, "InvoiceFax", "Fax", ccsText, "", CCGetRequestParam("InvoiceFax", $Method, NULL), $this);
            $this->DeliveryFax = new clsControl(ccsTextBox, "DeliveryFax", "Fax", ccsText, "", CCGetRequestParam("DeliveryFax", $Method, NULL), $this);
            $this->DeliveryAddress = new clsControl(ccsTextArea, "DeliveryAddress", "Address", ccsMemo, "", CCGetRequestParam("DeliveryAddress", $Method, NULL), $this);
            $this->lblInvoiceAddressContact = new clsControl(ccsTextBox, "lblInvoiceAddressContact", "lblInvoiceAddressContact", ccsText, "", CCGetRequestParam("lblInvoiceAddressContact", $Method, NULL), $this);
            $this->LinkChangeInvoiceContact = new clsControl(ccsLink, "LinkChangeInvoiceContact", "LinkChangeInvoiceContact", ccsText, "", CCGetRequestParam("LinkChangeInvoiceContact", $Method, NULL), $this);
            $this->LinkChangeInvoiceContact->Page = "";
            $this->lblDeliveryAddressContact = new clsControl(ccsTextBox, "lblDeliveryAddressContact", "lblDeliveryAddressContact", ccsText, "", CCGetRequestParam("lblDeliveryAddressContact", $Method, NULL), $this);
            $this->LinkChangeDeliveryContact = new clsControl(ccsLink, "LinkChangeDeliveryContact", "LinkChangeDeliveryContact", ccsText, "", CCGetRequestParam("LinkChangeDeliveryContact", $Method, NULL), $this);
            $this->LinkChangeDeliveryContact->Page = "";
            $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", $Method, NULL), $this);
            $this->InvoiceDate = new clsControl(ccsTextBox, "InvoiceDate", "Invoice Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("InvoiceDate", $Method, NULL), $this);
            $this->InvoiceDate->Required = true;
            $this->DatePicker_InvoiceDate = new clsDatePicker("DatePicker_InvoiceDate", "AddNewHeader", "InvoiceDate", $this);
            $this->PackagingCost = new clsControl(ccsTextBox, "PackagingCost", "PackagingCost", ccsInteger, "", CCGetRequestParam("PackagingCost", $Method, NULL), $this);
            $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", $Method, NULL), $this);
            $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", $Method, NULL), $this);
            $this->ClientID = new clsControl(ccsListBox, "ClientID", "ClientID", ccsText, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->ClientID->DSType = dsTable;
            $this->ClientID->DataSource = new clsDBGayaFusionAll();
            $this->ClientID->ds = & $this->ClientID->DataSource;
            $this->ClientID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->ClientID->BoundColumn, $this->ClientID->TextColumn, $this->ClientID->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->lblCurrency = new clsControl(ccsListBox, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", $Method, NULL), $this);
            $this->lblCurrency->DSType = dsTable;
            $this->lblCurrency->DataSource = new clsDBGayaFusionAll();
            $this->lblCurrency->ds = & $this->lblCurrency->DataSource;
            $this->lblCurrency->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
            list($this->lblCurrency->BoundColumn, $this->lblCurrency->TextColumn, $this->lblCurrency->DBFormat) = array("CurrencyID", "Currency", "");
        }
    }
//End Class_Initialize Event

//Initialize Method @2-8B553631
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-921AF1AF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->InvoiceNo->Validate() && $Validation);
        $Validation = ($this->DueDate->Validate() && $Validation);
        $Validation = ($this->InvoiceAddressContact->Validate() && $Validation);
        $Validation = ($this->DeliveryAddressContact->Validate() && $Validation);
        $Validation = ($this->DeliveryTerm->Validate() && $Validation);
        $Validation = ($this->PaymentTerm->Validate() && $Validation);
        $Validation = ($this->ClientOrderRef->Validate() && $Validation);
        $Validation = ($this->AddressID->Validate() && $Validation);
        $Validation = ($this->GayaOrderRef->Validate() && $Validation);
        $Validation = ($this->InvoiceAddress->Validate() && $Validation);
        $Validation = ($this->InvoicePhone->Validate() && $Validation);
        $Validation = ($this->DeliveryPhone->Validate() && $Validation);
        $Validation = ($this->InvoiceFax->Validate() && $Validation);
        $Validation = ($this->DeliveryFax->Validate() && $Validation);
        $Validation = ($this->DeliveryAddress->Validate() && $Validation);
        $Validation = ($this->lblInvoiceAddressContact->Validate() && $Validation);
        $Validation = ($this->lblDeliveryAddressContact->Validate() && $Validation);
        $Validation = ($this->Invoice_H_ID->Validate() && $Validation);
        $Validation = ($this->InvoiceDate->Validate() && $Validation);
        $Validation = ($this->PackagingCost->Validate() && $Validation);
        $Validation = ($this->Proforma_H_ID->Validate() && $Validation);
        $Validation = ($this->Quotation_H_ID->Validate() && $Validation);
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->lblCurrency->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->InvoiceNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DueDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoiceAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PaymentTerm->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientOrderRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GayaOrderRef->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoiceAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoicePhone->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryPhone->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoiceFax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryFax->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddress->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblInvoiceAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblDeliveryAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Invoice_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->InvoiceDate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->PackagingCost->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Proforma_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Quotation_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->lblCurrency->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-F1CFD364
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->DueDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_DueDate->Errors->Count());
        $errors = ($errors || $this->InvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->DeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->DeliveryTerm->Errors->Count());
        $errors = ($errors || $this->PaymentTerm->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->GayaOrderRef->Errors->Count());
        $errors = ($errors || $this->InvoiceAddress->Errors->Count());
        $errors = ($errors || $this->InvoicePhone->Errors->Count());
        $errors = ($errors || $this->DeliveryPhone->Errors->Count());
        $errors = ($errors || $this->InvoiceFax->Errors->Count());
        $errors = ($errors || $this->DeliveryFax->Errors->Count());
        $errors = ($errors || $this->DeliveryAddress->Errors->Count());
        $errors = ($errors || $this->lblInvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->LinkChangeInvoiceContact->Errors->Count());
        $errors = ($errors || $this->lblDeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->LinkChangeDeliveryContact->Errors->Count());
        $errors = ($errors || $this->Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->InvoiceDate->Errors->Count());
        $errors = ($errors || $this->DatePicker_InvoiceDate->Errors->Count());
        $errors = ($errors || $this->PackagingCost->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->Quotation_H_ID->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->lblCurrency->Errors->Count());
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

//Operation Method @2-F39BE638
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
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert)) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//UpdateRow Method @2-E4E4099F
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->InvoiceNo->SetValue($this->InvoiceNo->GetValue(true));
        $this->DataSource->DueDate->SetValue($this->DueDate->GetValue(true));
        $this->DataSource->InvoiceAddressContact->SetValue($this->InvoiceAddressContact->GetValue(true));
        $this->DataSource->DeliveryAddressContact->SetValue($this->DeliveryAddressContact->GetValue(true));
        $this->DataSource->DeliveryTerm->SetValue($this->DeliveryTerm->GetValue(true));
        $this->DataSource->PaymentTerm->SetValue($this->PaymentTerm->GetValue(true));
        $this->DataSource->ClientOrderRef->SetValue($this->ClientOrderRef->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->GayaOrderRef->SetValue($this->GayaOrderRef->GetValue(true));
        $this->DataSource->InvoiceAddress->SetValue($this->InvoiceAddress->GetValue(true));
        $this->DataSource->InvoicePhone->SetValue($this->InvoicePhone->GetValue(true));
        $this->DataSource->DeliveryPhone->SetValue($this->DeliveryPhone->GetValue(true));
        $this->DataSource->InvoiceFax->SetValue($this->InvoiceFax->GetValue(true));
        $this->DataSource->DeliveryFax->SetValue($this->DeliveryFax->GetValue(true));
        $this->DataSource->DeliveryAddress->SetValue($this->DeliveryAddress->GetValue(true));
        $this->DataSource->lblInvoiceAddressContact->SetValue($this->lblInvoiceAddressContact->GetValue(true));
        $this->DataSource->LinkChangeInvoiceContact->SetValue($this->LinkChangeInvoiceContact->GetValue(true));
        $this->DataSource->lblDeliveryAddressContact->SetValue($this->lblDeliveryAddressContact->GetValue(true));
        $this->DataSource->LinkChangeDeliveryContact->SetValue($this->LinkChangeDeliveryContact->GetValue(true));
        $this->DataSource->Invoice_H_ID->SetValue($this->Invoice_H_ID->GetValue(true));
        $this->DataSource->InvoiceDate->SetValue($this->InvoiceDate->GetValue(true));
        $this->DataSource->PackagingCost->SetValue($this->PackagingCost->GetValue(true));
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->lblCurrency->SetValue($this->lblCurrency->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-0AFD80B5
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

        $this->InvoiceAddressContact->Prepare();
        $this->DeliveryAddressContact->Prepare();
        $this->DeliveryTerm->Prepare();
        $this->PaymentTerm->Prepare();
        $this->AddressID->Prepare();
        $this->ClientID->Prepare();
        $this->lblCurrency->Prepare();

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
                    $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
                    $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
                    $this->InvoiceAddressContact->SetValue($this->DataSource->InvoiceAddressContact->GetValue());
                    $this->DeliveryAddressContact->SetValue($this->DataSource->DeliveryAddressContact->GetValue());
                    $this->DeliveryTerm->SetValue($this->DataSource->DeliveryTerm->GetValue());
                    $this->PaymentTerm->SetValue($this->DataSource->PaymentTerm->GetValue());
                    $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->GayaOrderRef->SetValue($this->DataSource->GayaOrderRef->GetValue());
                    $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                    $this->InvoiceDate->SetValue($this->DataSource->InvoiceDate->GetValue());
                    $this->PackagingCost->SetValue($this->DataSource->PackagingCost->GetValue());
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                    $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->lblCurrency->SetValue($this->DataSource->lblCurrency->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }
        $this->LinkChangeInvoiceContact->Parameters = CCGetQueryString("QueryString", array("InvoiceContactID", "ccsForm"));
        $this->LinkChangeInvoiceContact->Parameters = CCAddParam($this->LinkChangeInvoiceContact->Parameters, "AddressID", CCGetFromPost("AddressID", NULL));
        $this->LinkChangeInvoiceContact->Parameters = CCAddParam($this->LinkChangeInvoiceContact->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));
        $this->LinkChangeDeliveryContact->Parameters = CCGetQueryString("QueryString", array("DeliveryContactID", "ccsForm"));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "AddressID", CCGetFromPost("AddressID", NULL));
        $this->LinkChangeDeliveryContact->Parameters = CCAddParam($this->LinkChangeDeliveryContact->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->InvoiceNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DueDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_DueDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PaymentTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GayaOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoicePhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryPhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblInvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkChangeInvoiceContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkChangeDeliveryContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Invoice_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_InvoiceDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->PackagingCost->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Proforma_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Quotation_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblCurrency->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->InvoiceNo->Show();
        $this->DueDate->Show();
        $this->DatePicker_DueDate->Show();
        $this->InvoiceAddressContact->Show();
        $this->DeliveryAddressContact->Show();
        $this->DeliveryTerm->Show();
        $this->PaymentTerm->Show();
        $this->ClientOrderRef->Show();
        $this->AddressID->Show();
        $this->GayaOrderRef->Show();
        $this->InvoiceAddress->Show();
        $this->InvoicePhone->Show();
        $this->DeliveryPhone->Show();
        $this->InvoiceFax->Show();
        $this->DeliveryFax->Show();
        $this->DeliveryAddress->Show();
        $this->lblInvoiceAddressContact->Show();
        $this->LinkChangeInvoiceContact->Show();
        $this->lblDeliveryAddressContact->Show();
        $this->LinkChangeDeliveryContact->Show();
        $this->Invoice_H_ID->Show();
        $this->InvoiceDate->Show();
        $this->DatePicker_InvoiceDate->Show();
        $this->PackagingCost->Show();
        $this->Proforma_H_ID->Show();
        $this->Quotation_H_ID->Show();
        $this->ClientID->Show();
        $this->lblCurrency->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-7651FDCF
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $UpdateFields = array();

    // Datasource fields
    public $InvoiceNo;
    public $DueDate;
    public $InvoiceAddressContact;
    public $DeliveryAddressContact;
    public $DeliveryTerm;
    public $PaymentTerm;
    public $ClientOrderRef;
    public $AddressID;
    public $GayaOrderRef;
    public $InvoiceAddress;
    public $InvoicePhone;
    public $DeliveryPhone;
    public $InvoiceFax;
    public $DeliveryFax;
    public $DeliveryAddress;
    public $lblInvoiceAddressContact;
    public $LinkChangeInvoiceContact;
    public $lblDeliveryAddressContact;
    public $LinkChangeDeliveryContact;
    public $Invoice_H_ID;
    public $InvoiceDate;
    public $PackagingCost;
    public $Proforma_H_ID;
    public $Quotation_H_ID;
    public $ClientID;
    public $lblCurrency;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-5612BDCD
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        
        $this->InvoiceAddressContact = new clsField("InvoiceAddressContact", ccsInteger, "");
        
        $this->DeliveryAddressContact = new clsField("DeliveryAddressContact", ccsInteger, "");
        
        $this->DeliveryTerm = new clsField("DeliveryTerm", ccsText, "");
        
        $this->PaymentTerm = new clsField("PaymentTerm", ccsText, "");
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->AddressID = new clsField("AddressID", ccsInteger, "");
        
        $this->GayaOrderRef = new clsField("GayaOrderRef", ccsText, "");
        
        $this->InvoiceAddress = new clsField("InvoiceAddress", ccsMemo, "");
        
        $this->InvoicePhone = new clsField("InvoicePhone", ccsText, "");
        
        $this->DeliveryPhone = new clsField("DeliveryPhone", ccsText, "");
        
        $this->InvoiceFax = new clsField("InvoiceFax", ccsText, "");
        
        $this->DeliveryFax = new clsField("DeliveryFax", ccsText, "");
        
        $this->DeliveryAddress = new clsField("DeliveryAddress", ccsMemo, "");
        
        $this->lblInvoiceAddressContact = new clsField("lblInvoiceAddressContact", ccsText, "");
        
        $this->LinkChangeInvoiceContact = new clsField("LinkChangeInvoiceContact", ccsText, "");
        
        $this->lblDeliveryAddressContact = new clsField("lblDeliveryAddressContact", ccsText, "");
        
        $this->LinkChangeDeliveryContact = new clsField("LinkChangeDeliveryContact", ccsText, "");
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
        $this->InvoiceDate = new clsField("InvoiceDate", ccsDate, $this->DateFormat);
        
        $this->PackagingCost = new clsField("PackagingCost", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->ClientID = new clsField("ClientID", ccsText, "");
        
        $this->lblCurrency = new clsField("lblCurrency", ccsText, "");
        

        $this->UpdateFields["InvoiceNo"] = array("Name" => "InvoiceNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DueDate"] = array("Name" => "DueDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["InvoiceContactID"] = array("Name" => "InvoiceContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryContactID"] = array("Name" => "DeliveryContactID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DeliveryTermID"] = array("Name" => "DeliveryTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["PaymentTermID"] = array("Name" => "PaymentTermID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientOrderRef"] = array("Name" => "ClientOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["GayaOrderRef"] = array("Name" => "GayaOrderRef", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Invoice_H_ID"] = array("Name" => "Invoice_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["InvoiceDate"] = array("Name" => "InvoiceDate", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["PackagingCost"] = array("Name" => "PackagingCost", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["CurrencyID"] = array("Name" => "CurrencyID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-165F7009
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-6D3F5593
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_invoice_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-CF9D98F5
    function SetValues()
    {
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
        $this->InvoiceAddressContact->SetDBValue(trim($this->f("InvoiceContactID")));
        $this->DeliveryAddressContact->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->DeliveryTerm->SetDBValue($this->f("DeliveryTermID"));
        $this->PaymentTerm->SetDBValue($this->f("PaymentTermID"));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->AddressID->SetDBValue(trim($this->f("AddressID")));
        $this->GayaOrderRef->SetDBValue($this->f("GayaOrderRef"));
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
        $this->InvoiceDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->PackagingCost->SetDBValue(trim($this->f("PackagingCost")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->ClientID->SetDBValue($this->f("ClientID"));
        $this->lblCurrency->SetDBValue($this->f("CurrencyID"));
    }
//End SetValues Method

//Update Method @2-8717DE9E
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["InvoiceNo"]["Value"] = $this->InvoiceNo->GetDBValue(true);
        $this->UpdateFields["DueDate"]["Value"] = $this->DueDate->GetDBValue(true);
        $this->UpdateFields["InvoiceContactID"]["Value"] = $this->InvoiceAddressContact->GetDBValue(true);
        $this->UpdateFields["DeliveryContactID"]["Value"] = $this->DeliveryAddressContact->GetDBValue(true);
        $this->UpdateFields["DeliveryTermID"]["Value"] = $this->DeliveryTerm->GetDBValue(true);
        $this->UpdateFields["PaymentTermID"]["Value"] = $this->PaymentTerm->GetDBValue(true);
        $this->UpdateFields["ClientOrderRef"]["Value"] = $this->ClientOrderRef->GetDBValue(true);
        $this->UpdateFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->UpdateFields["GayaOrderRef"]["Value"] = $this->GayaOrderRef->GetDBValue(true);
        $this->UpdateFields["Invoice_H_ID"]["Value"] = $this->Invoice_H_ID->GetDBValue(true);
        $this->UpdateFields["InvoiceDate"]["Value"] = $this->InvoiceDate->GetDBValue(true);
        $this->UpdateFields["PackagingCost"]["Value"] = $this->PackagingCost->GetDBValue(true);
        $this->UpdateFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->UpdateFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->UpdateFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->UpdateFields["CurrencyID"]["Value"] = $this->lblCurrency->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_invoice_h", $this->UpdateFields, $this);
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

} //End AddNewHeaderDataSource Class @2-FCB6E20C

class clsEditableGridAddNewDetail { //AddNewDetail Class @51-254BF570

//Variables @51-F9538F3C

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

//Class_Initialize Event @51-AFC1DE47
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
        $this->CachedColumns["Invoice_D_ID"][0] = "Invoice_D_ID";
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

        $this->EmptyRows = 31;
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

        $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", NULL, $this);
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
        $this->Total_price = new clsControl(ccsHidden, "Total_price", "Total_price", ccsText, "", NULL, $this);
        $this->Total = new clsButton("Total", $Method, $this);
    }
//End Class_Initialize Event

//Initialize Method @51-D0A83D48
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);
    }
//End Initialize Method

//SetPrimaryKeys Method @51-EBC3F86C
    function SetPrimaryKeys($PrimaryKeys) {
        $this->PrimaryKeys = $PrimaryKeys;
        return $this->PrimaryKeys;
    }
//End SetPrimaryKeys Method

//GetPrimaryKeys Method @51-74F9A772
    function GetPrimaryKeys() {
        return $this->PrimaryKeys;
    }
//End GetPrimaryKeys Method

//GetFormParameters Method @51-A9CF027D
    function GetFormParameters()
    {
        for($RowNumber = 1; $RowNumber <= $this->TotalRows; $RowNumber++)
        {
            $this->FormParameters["Invoice_H_ID"][$RowNumber] = CCGetFromPost("Invoice_H_ID_" . $RowNumber, NULL);
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

//Validate Method @51-A40A0F69
    function Validate()
    {
        $Validation = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);

        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Invoice_D_ID"] = $this->CachedColumns["Invoice_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Invoice_H_ID->SetText($this->FormParameters["Invoice_H_ID"][$this->RowNumber], $this->RowNumber);
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

//ValidateRow Method @51-29CDDB76
    function ValidateRow()
    {
        global $CCSLocales;
        $this->Invoice_H_ID->Validate();
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
        $errors = ComposeStrings($errors, $this->Invoice_H_ID->Errors->ToString());
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
        $this->Invoice_H_ID->Errors->Clear();
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

//CheckInsert Method @51-EFB8EB87
    function CheckInsert()
    {
        $filed = false;
        $filed = ($filed || (is_array($this->FormParameters["Invoice_H_ID"][$this->RowNumber]) && count($this->FormParameters["Invoice_H_ID"][$this->RowNumber])) || strlen($this->FormParameters["Invoice_H_ID"][$this->RowNumber]));
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

//CheckErrors Method @51-F5A3B433
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//Operation Method @51-AF3B2A18
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
                $Redirect = "Invoice.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//UpdateGrid Method @51-2EE4A01B
    function UpdateGrid()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSubmit", $this);
        if(!$this->Validate()) return;
        $Validation = true;
        for($this->RowNumber = 1; $this->RowNumber <= $this->TotalRows; $this->RowNumber++)
        {
            $this->DataSource->CachedColumns["Invoice_D_ID"] = $this->CachedColumns["Invoice_D_ID"][$this->RowNumber];
            $this->DataSource->CurrentRow = $this->RowNumber;
            $this->Invoice_H_ID->SetText($this->FormParameters["Invoice_H_ID"][$this->RowNumber], $this->RowNumber);
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

//InsertRow Method @51-1C9FEA0B
    function InsertRow()
    {
        if(!$this->InsertAllowed) return false;
        $this->DataSource->Invoice_H_ID->SetValue($this->Invoice_H_ID->GetValue(true));
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

//UpdateRow Method @51-5F5122D8
    function UpdateRow()
    {
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->Invoice_H_ID->SetValue($this->Invoice_H_ID->GetValue(true));
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

//DeleteRow Method @51-A4A656F6
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

//FormScript Method @51-31531CC5
    function FormScript($TotalRows)
    {
        $script = "";
        $script .= "\n<script language=\"JavaScript\" type=\"text/javascript\">\n<!--\n";
        $script .= "var AddNewDetailElements;\n";
        $script .= "var AddNewDetailEmptyRows = 31;\n";
        $script .= "var " . $this->ComponentName . "Invoice_H_IDID = 0;\n";
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
            $script .= "\t\tnew Array(" . "ED.Invoice_H_ID_" . $i . ", " . "ED.CollectID_" . $i . ", " . "ED.Qty_" . $i . ", " . "ED.Unit_" . $i . ", " . "ED.UnitPrice_" . $i . ", " . "ED.SumPrice_" . $i . ", " . "ED.CheckBox_Delete_" . $i . ", " . "ED.CollectCode_" . $i . ", " . "ED.Design_" . $i . ", " . "ED.NameDesc_" . $i . ", " . "ED.Category_" . $i . ", " . "ED.Size_" . $i . ", " . "ED.Texture_" . $i . ", " . "ED.Color_" . $i . ", " . "ED.Material_" . $i . ")";
            if($i != $TotalRows) $script .= ",\n";
        }
        $script .= ");\n";
        $script .= "}\n";
        $script .= "\n//-->\n</script>";
        return $script;
    }
//End FormScript Method

//SetFormState Method @51-050AA7B8
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
                $this->CachedColumns["Invoice_D_ID"][$RowNumber] = $piece;
                $RowNumber++;
            }

            if(!$RowNumber) { $RowNumber = 1; }
            for($i = 1; $i <= $this->EmptyRows; $i++) {
                $this->CachedColumns["Invoice_D_ID"][$RowNumber] = "";
                $RowNumber++;
            }
        }
    }
//End SetFormState Method

//GetFormState Method @51-ED28FBB7
    function GetFormState($NonEmptyRows)
    {
        if(!$this->FormSubmitted) {
            $this->FormState  = $NonEmptyRows . ";";
            $this->FormState .= $this->InsertAllowed ? $this->EmptyRows : "0";
            if($NonEmptyRows) {
                for($i = 0; $i <= $NonEmptyRows; $i++) {
                    $this->FormState .= ";" . str_replace(";", "\\;", str_replace("\\", "\\\\", $this->CachedColumns["Invoice_D_ID"][$i]));
                }
            }
        }
        return $this->FormState;
    }
//End GetFormState Method

//Show Method @51-AF31EF0D
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
        $this->ControlsVisible["Invoice_H_ID"] = $this->Invoice_H_ID->Visible;
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
                    $this->CachedColumns["Invoice_D_ID"][$this->RowNumber] = $this->DataSource->CachedColumns["Invoice_D_ID"];
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
                    $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
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
                    $this->Invoice_H_ID->SetText($this->FormParameters["Invoice_H_ID"][$this->RowNumber], $this->RowNumber);
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
                    $this->CachedColumns["Invoice_D_ID"][$this->RowNumber] = "";
                    $this->Invoice_H_ID->SetText("");
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
                    $this->Invoice_H_ID->SetText($this->FormParameters["Invoice_H_ID"][$this->RowNumber], $this->RowNumber);
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
                $this->Invoice_H_ID->Show($this->RowNumber);
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
                        if (($this->DataSource->CachedColumns["Invoice_D_ID"] == $this->CachedColumns["Invoice_D_ID"][$this->RowNumber])) {
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
        $this->Total_price->Show();
        $this->Total->Show();

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

} //End AddNewDetail Class @51-FCB6E20C

class clsAddNewDetailDataSource extends clsDBGayaFusionAll {  //AddNewDetailDataSource Class @51-9729D968

//DataSource Variables @51-12A7F46B
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
    public $Invoice_H_ID;
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

//DataSourceClass_Initialize Event @51-7D9BCA40
    function clsAddNewDetailDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "EditableGrid AddNewDetail/Error";
        $this->Initialize();
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
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
        

        $this->InsertFields["Invoice_H_ID"] = array("Name" => "Invoice_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Invoice_H_ID"] = array("Name" => "Invoice_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectID"] = array("Name" => "CollectID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Qty"] = array("Name" => "Qty", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Unit"] = array("Name" => "Unit", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["UnitPrice"] = array("Name" => "UnitPrice", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["CollectCode"] = array("Name" => "CollectCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//SetOrder Method @51-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @51-165F7009
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @51-FDBBBC29
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_invoice_d";
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_invoice_d {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @51-0C955EC8
    function SetValues()
    {
        $this->CachedColumns["Invoice_D_ID"] = $this->f("Invoice_D_ID");
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
    }
//End SetValues Method

//Insert Method @51-F97C9A93
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["Invoice_H_ID"]["Value"] = $this->Invoice_H_ID->GetDBValue(true);
        $this->InsertFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->InsertFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->InsertFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->InsertFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->InsertFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_invoice_d", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @51-7606D169
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Invoice_D_ID=" . $this->ToSQL($this->CachedColumns["Invoice_D_ID"], ccsInteger);
        $this->UpdateFields["Invoice_H_ID"]["Value"] = $this->Invoice_H_ID->GetDBValue(true);
        $this->UpdateFields["CollectID"]["Value"] = $this->CollectID->GetDBValue(true);
        $this->UpdateFields["Qty"]["Value"] = $this->Qty->GetDBValue(true);
        $this->UpdateFields["Unit"]["Value"] = $this->Unit->GetDBValue(true);
        $this->UpdateFields["UnitPrice"]["Value"] = $this->UnitPrice->GetDBValue(true);
        $this->UpdateFields["CollectCode"]["Value"] = $this->CollectCode->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbladminist_invoice_d", $this->UpdateFields, $this);
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

//Delete Method @51-4D67739A
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $SelectWhere = $this->Where;
        $this->Where = "Invoice_D_ID=" . $this->ToSQL($this->CachedColumns["Invoice_D_ID"], ccsInteger);
        $this->SQL = "DELETE FROM tbladminist_invoice_d";
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

} //End AddNewDetailDataSource Class @51-FCB6E20C

//Initialize Page @1-D8C261B7
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
$TemplateFileName = "AddInvoice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-46D865E7
include_once("./AddInvoice_events.php");
//End Include events file

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

//Show Page @1-490B26BD
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
