<?php
//Include Common Files @1-8C12B552
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowInvoice.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordHeader { //Header Class @2-9DE33543

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

//Class_Initialize Event @2-8B3CB90C
    function clsRecordHeader($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Header/Error";
        $this->DataSource = new clsHeaderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Header";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->InvoiceNo = new clsControl(ccsLabel, "InvoiceNo", "Invoice No", ccsText, "", CCGetRequestParam("InvoiceNo", $Method, NULL), $this);
            $this->DueDate = new clsControl(ccsLabel, "DueDate", "Due Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("DueDate", $Method, NULL), $this);
            $this->InvoiceAddressContact = new clsControl(ccsHidden, "InvoiceAddressContact", "Invoice Address", ccsInteger, "", CCGetRequestParam("InvoiceAddressContact", $Method, NULL), $this);
            $this->DeliveryAddressContact = new clsControl(ccsHidden, "DeliveryAddressContact", "Delivery Address", ccsInteger, "", CCGetRequestParam("DeliveryAddressContact", $Method, NULL), $this);
            $this->ClientOrderRef = new clsControl(ccsLabel, "ClientOrderRef", "ClientOrderRef", ccsText, "", CCGetRequestParam("ClientOrderRef", $Method, NULL), $this);
            $this->GayaOrderRef = new clsControl(ccsLabel, "GayaOrderRef", "GayaOrderRef", ccsText, "", CCGetRequestParam("GayaOrderRef", $Method, NULL), $this);
            $this->InvoiceAddress = new clsControl(ccsLabel, "InvoiceAddress", "Address", ccsMemo, "", CCGetRequestParam("InvoiceAddress", $Method, NULL), $this);
            $this->InvoicePhone = new clsControl(ccsLabel, "InvoicePhone", "Phone", ccsText, "", CCGetRequestParam("InvoicePhone", $Method, NULL), $this);
            $this->DeliveryPhone = new clsControl(ccsLabel, "DeliveryPhone", "Phone", ccsText, "", CCGetRequestParam("DeliveryPhone", $Method, NULL), $this);
            $this->InvoiceFax = new clsControl(ccsLabel, "InvoiceFax", "Fax", ccsText, "", CCGetRequestParam("InvoiceFax", $Method, NULL), $this);
            $this->DeliveryFax = new clsControl(ccsLabel, "DeliveryFax", "Fax", ccsText, "", CCGetRequestParam("DeliveryFax", $Method, NULL), $this);
            $this->DeliveryAddress = new clsControl(ccsLabel, "DeliveryAddress", "Address", ccsMemo, "", CCGetRequestParam("DeliveryAddress", $Method, NULL), $this);
            $this->lblInvoiceAddressContact = new clsControl(ccsLabel, "lblInvoiceAddressContact", "lblInvoiceAddressContact", ccsText, "", CCGetRequestParam("lblInvoiceAddressContact", $Method, NULL), $this);
            $this->lblDeliveryAddressContact = new clsControl(ccsLabel, "lblDeliveryAddressContact", "lblDeliveryAddressContact", ccsText, "", CCGetRequestParam("lblDeliveryAddressContact", $Method, NULL), $this);
            $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", $Method, NULL), $this);
            $this->InvoiceDate = new clsControl(ccsLabel, "InvoiceDate", "Invoice Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("InvoiceDate", $Method, NULL), $this);
            $this->ProformaNo = new clsControl(ccsLabel, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", $Method, NULL), $this);
            $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", $Method, NULL), $this);
            $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", $Method, NULL), $this);
            $this->lblAddress = new clsControl(ccsLabel, "lblAddress", "lblAddress", ccsText, "", CCGetRequestParam("lblAddress", $Method, NULL), $this);
            $this->lblClient = new clsControl(ccsLabel, "lblClient", "lblClient", ccsText, "", CCGetRequestParam("lblClient", $Method, NULL), $this);
            $this->lblPaymentTerm = new clsControl(ccsLabel, "lblPaymentTerm", "lblPaymentTerm", ccsText, "", CCGetRequestParam("lblPaymentTerm", $Method, NULL), $this);
            $this->lblDeliveryTerm = new clsControl(ccsLabel, "lblDeliveryTerm", "lblDeliveryTerm", ccsText, "", CCGetRequestParam("lblDeliveryTerm", $Method, NULL), $this);
            $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", $Method, NULL), $this);
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

//Validate Method @2-44F276E8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->InvoiceAddressContact->Validate() && $Validation);
        $Validation = ($this->DeliveryAddressContact->Validate() && $Validation);
        $Validation = ($this->Invoice_H_ID->Validate() && $Validation);
        $Validation = ($this->Proforma_H_ID->Validate() && $Validation);
        $Validation = ($this->DocMaker->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->InvoiceAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DeliveryAddressContact->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Invoice_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Proforma_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DocMaker->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-A5ACA0E0
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->DueDate->Errors->Count());
        $errors = ($errors || $this->InvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->DeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->ClientOrderRef->Errors->Count());
        $errors = ($errors || $this->GayaOrderRef->Errors->Count());
        $errors = ($errors || $this->InvoiceAddress->Errors->Count());
        $errors = ($errors || $this->InvoicePhone->Errors->Count());
        $errors = ($errors || $this->DeliveryPhone->Errors->Count());
        $errors = ($errors || $this->InvoiceFax->Errors->Count());
        $errors = ($errors || $this->DeliveryFax->Errors->Count());
        $errors = ($errors || $this->DeliveryAddress->Errors->Count());
        $errors = ($errors || $this->lblInvoiceAddressContact->Errors->Count());
        $errors = ($errors || $this->lblDeliveryAddressContact->Errors->Count());
        $errors = ($errors || $this->Invoice_H_ID->Errors->Count());
        $errors = ($errors || $this->InvoiceDate->Errors->Count());
        $errors = ($errors || $this->ProformaNo->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->lblCurrency->Errors->Count());
        $errors = ($errors || $this->lblAddress->Errors->Count());
        $errors = ($errors || $this->lblClient->Errors->Count());
        $errors = ($errors || $this->lblPaymentTerm->Errors->Count());
        $errors = ($errors || $this->lblDeliveryTerm->Errors->Count());
        $errors = ($errors || $this->DocMaker->Errors->Count());
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

//Operation Method @2-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @2-CE5C606F
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
                $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
                $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
                $this->ClientOrderRef->SetValue($this->DataSource->ClientOrderRef->GetValue());
                $this->GayaOrderRef->SetValue($this->DataSource->GayaOrderRef->GetValue());
                $this->InvoiceDate->SetValue($this->DataSource->InvoiceDate->GetValue());
                $this->lblCurrency->SetValue($this->DataSource->lblCurrency->GetValue());
                $this->lblAddress->SetValue($this->DataSource->lblAddress->GetValue());
                $this->lblClient->SetValue($this->DataSource->lblClient->GetValue());
                $this->lblPaymentTerm->SetValue($this->DataSource->lblPaymentTerm->GetValue());
                $this->lblDeliveryTerm->SetValue($this->DataSource->lblDeliveryTerm->GetValue());
                if(!$this->FormSubmitted){
                    $this->InvoiceAddressContact->SetValue($this->DataSource->InvoiceAddressContact->GetValue());
                    $this->DeliveryAddressContact->SetValue($this->DataSource->DeliveryAddressContact->GetValue());
                    $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                    $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->InvoiceNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DueDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GayaOrderRef->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoicePhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryPhone->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DeliveryAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblInvoiceAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryAddressContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Invoice_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->InvoiceDate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ProformaNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Proforma_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblCurrency->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblClient->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblPaymentTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblDeliveryTerm->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DocMaker->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->InvoiceNo->Show();
        $this->DueDate->Show();
        $this->InvoiceAddressContact->Show();
        $this->DeliveryAddressContact->Show();
        $this->ClientOrderRef->Show();
        $this->GayaOrderRef->Show();
        $this->InvoiceAddress->Show();
        $this->InvoicePhone->Show();
        $this->DeliveryPhone->Show();
        $this->InvoiceFax->Show();
        $this->DeliveryFax->Show();
        $this->DeliveryAddress->Show();
        $this->lblInvoiceAddressContact->Show();
        $this->lblDeliveryAddressContact->Show();
        $this->Invoice_H_ID->Show();
        $this->InvoiceDate->Show();
        $this->ProformaNo->Show();
        $this->Proforma_H_ID->Show();
        $this->lblCurrency->Show();
        $this->lblAddress->Show();
        $this->lblClient->Show();
        $this->lblPaymentTerm->Show();
        $this->lblDeliveryTerm->Show();
        $this->DocMaker->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Header Class @2-FCB6E20C

class clsHeaderDataSource extends clsDBGayaFusionAll {  //HeaderDataSource Class @2-AB3B61E5

//DataSource Variables @2-72D9349A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $InvoiceNo;
    public $DueDate;
    public $InvoiceAddressContact;
    public $DeliveryAddressContact;
    public $ClientOrderRef;
    public $GayaOrderRef;
    public $InvoiceAddress;
    public $InvoicePhone;
    public $DeliveryPhone;
    public $InvoiceFax;
    public $DeliveryFax;
    public $DeliveryAddress;
    public $lblInvoiceAddressContact;
    public $lblDeliveryAddressContact;
    public $Invoice_H_ID;
    public $InvoiceDate;
    public $ProformaNo;
    public $Proforma_H_ID;
    public $lblCurrency;
    public $lblAddress;
    public $lblClient;
    public $lblPaymentTerm;
    public $lblDeliveryTerm;
    public $DocMaker;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-4136DBC1
    function clsHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Header/Error";
        $this->Initialize();
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        
        $this->InvoiceAddressContact = new clsField("InvoiceAddressContact", ccsInteger, "");
        
        $this->DeliveryAddressContact = new clsField("DeliveryAddressContact", ccsInteger, "");
        
        $this->ClientOrderRef = new clsField("ClientOrderRef", ccsText, "");
        
        $this->GayaOrderRef = new clsField("GayaOrderRef", ccsText, "");
        
        $this->InvoiceAddress = new clsField("InvoiceAddress", ccsMemo, "");
        
        $this->InvoicePhone = new clsField("InvoicePhone", ccsText, "");
        
        $this->DeliveryPhone = new clsField("DeliveryPhone", ccsText, "");
        
        $this->InvoiceFax = new clsField("InvoiceFax", ccsText, "");
        
        $this->DeliveryFax = new clsField("DeliveryFax", ccsText, "");
        
        $this->DeliveryAddress = new clsField("DeliveryAddress", ccsMemo, "");
        
        $this->lblInvoiceAddressContact = new clsField("lblInvoiceAddressContact", ccsText, "");
        
        $this->lblDeliveryAddressContact = new clsField("lblDeliveryAddressContact", ccsText, "");
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
        $this->InvoiceDate = new clsField("InvoiceDate", ccsDate, $this->DateFormat);
        
        $this->ProformaNo = new clsField("ProformaNo", ccsText, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->lblCurrency = new clsField("lblCurrency", ccsText, "");
        
        $this->lblAddress = new clsField("lblAddress", ccsText, "");
        
        $this->lblClient = new clsField("lblClient", ccsText, "");
        
        $this->lblPaymentTerm = new clsField("lblPaymentTerm", ccsText, "");
        
        $this->lblDeliveryTerm = new clsField("lblDeliveryTerm", ccsText, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-3C42680B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_invoice_h.Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-78EBF8D7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT Company, DeliveryTerm, ClientCompany, Currency, Invoice_H_ID, InvoiceNo, InvoiceDate, ClientOrderRef, GayaOrderRef, DueDate,\n\n" .
        "Proforma_H_ID, InvoiceContactID, DeliveryContactID, PaymentTerm, DocMaker \n\n" .
        "FROM ((((tbladminist_invoice_h INNER JOIN tbladminist_addressbook ON\n\n" .
        "tbladminist_invoice_h.AddressID = tbladminist_addressbook.AddressID) INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_invoice_h.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_currency ON\n\n" .
        "tbladminist_invoice_h.CurrencyID = tbladminist_currency.CurrencyID) INNER JOIN tbladminist_deliveryterm ON\n\n" .
        "tbladminist_invoice_h.DeliveryTermID = tbladminist_deliveryterm.DeliveryTermID) INNER JOIN tbladminist_paymentterm ON\n\n" .
        "tbladminist_invoice_h.PaymentTermID = tbladminist_paymentterm.PaymentTermID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B30DB469
    function SetValues()
    {
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
        $this->InvoiceAddressContact->SetDBValue(trim($this->f("InvoiceContactID")));
        $this->DeliveryAddressContact->SetDBValue(trim($this->f("DeliveryContactID")));
        $this->ClientOrderRef->SetDBValue($this->f("ClientOrderRef"));
        $this->GayaOrderRef->SetDBValue($this->f("GayaOrderRef"));
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
        $this->InvoiceDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->lblCurrency->SetDBValue($this->f("Currency"));
        $this->lblAddress->SetDBValue($this->f("Company"));
        $this->lblClient->SetDBValue($this->f("ClientCompany"));
        $this->lblPaymentTerm->SetDBValue($this->f("PaymentTerm"));
        $this->lblDeliveryTerm->SetDBValue($this->f("DeliveryTerm"));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
    }
//End SetValues Method

} //End HeaderDataSource Class @2-FCB6E20C

class clsGridDetil { //Detil class @45-19BDA346

//Variables @45-6E51DF5A

    // Public variables
    public $ComponentType = "Grid";
    public $ComponentName;
    public $Visible;
    public $Errors;
    public $ErrorBlock;
    public $ds;
    public $DataSource;
    public $PageSize;
    public $IsEmpty;
    public $ForceIteration = false;
    public $HasRecord = false;
    public $SorterName = "";
    public $SorterDirection = "";
    public $PageNumber;
    public $RowNumber;
    public $ControlsVisible = array();

    public $CCSEvents = "";
    public $CCSEventResult;

    public $RelativePath = "";
    public $Attributes;

    // Grid Controls
    public $StaticControls;
    public $RowControls;
//End Variables

//Class_Initialize Event @45-15A679EE
    function clsGridDetil($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Detil";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Detil";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsDetilDataSource($this);
        $this->ds = & $this->DataSource;
        $this->PageSize = CCGetParam($this->ComponentName . "PageSize", "");
        if(!is_numeric($this->PageSize) || !strlen($this->PageSize))
            $this->PageSize = 10;
        else
            $this->PageSize = intval($this->PageSize);
        if ($this->PageSize > 100)
            $this->PageSize = 100;
        if($this->PageSize == 0)
            $this->Errors->addError("<p>Form: Grid " . $this->ComponentName . "<br>Error: (CCS06) Invalid page size.</p>");
        $this->PageNumber = intval(CCGetParam($this->ComponentName . "Page", 1));
        if ($this->PageNumber <= 0) $this->PageNumber = 1;

        $this->Invoice_H_ID = new clsControl(ccsHidden, "Invoice_H_ID", "Invoice_H_ID", ccsInteger, "", CCGetRequestParam("Invoice_H_ID", ccsGet, NULL), $this);
        $this->CollectID = new clsControl(ccsLabel, "CollectID", "CollectID", ccsInteger, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
        $this->CollectCode = new clsControl(ccsLabel, "CollectCode", "CollectCode", ccsText, "", CCGetRequestParam("CollectCode", ccsGet, NULL), $this);
        $this->Qty = new clsControl(ccsLabel, "Qty", "Qty", ccsInteger, "", CCGetRequestParam("Qty", ccsGet, NULL), $this);
        $this->Unit = new clsControl(ccsLabel, "Unit", "Unit", ccsText, "", CCGetRequestParam("Unit", ccsGet, NULL), $this);
        $this->UnitPrice = new clsControl(ccsLabel, "UnitPrice", "UnitPrice", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("UnitPrice", ccsGet, NULL), $this);
        $this->Total = new clsControl(ccsLabel, "Total", "Total", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Total", ccsGet, NULL), $this);
        $this->CategoryName = new clsControl(ccsLabel, "CategoryName", "CategoryName", ccsText, "", CCGetRequestParam("CategoryName", ccsGet, NULL), $this);
        $this->ColorName = new clsControl(ccsLabel, "ColorName", "ColorName", ccsText, "", CCGetRequestParam("ColorName", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->Width = new clsControl(ccsLabel, "Width", "Width", ccsFloat, "", CCGetRequestParam("Width", ccsGet, NULL), $this);
        $this->Height = new clsControl(ccsLabel, "Height", "Height", ccsFloat, "", CCGetRequestParam("Height", ccsGet, NULL), $this);
        $this->Length = new clsControl(ccsLabel, "Length", "Length", ccsFloat, "", CCGetRequestParam("Length", ccsGet, NULL), $this);
        $this->Diameter = new clsControl(ccsLabel, "Diameter", "Diameter", ccsFloat, "", CCGetRequestParam("Diameter", ccsGet, NULL), $this);
        $this->MaterialName = new clsControl(ccsLabel, "MaterialName", "MaterialName", ccsText, "", CCGetRequestParam("MaterialName", ccsGet, NULL), $this);
        $this->NameDesc = new clsControl(ccsLabel, "NameDesc", "NameDesc", ccsText, "", CCGetRequestParam("NameDesc", ccsGet, NULL), $this);
        $this->SizeName = new clsControl(ccsLabel, "SizeName", "SizeName", ccsText, "", CCGetRequestParam("SizeName", ccsGet, NULL), $this);
        $this->TextureName = new clsControl(ccsLabel, "TextureName", "TextureName", ccsText, "", CCGetRequestParam("TextureName", ccsGet, NULL), $this);
        $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", ccsGet, NULL), $this);
        $this->Company = new clsControl(ccsLabel, "Company", "Company", ccsText, "", CCGetRequestParam("Company", ccsGet, NULL), $this);
        $this->lblAdministrasi = new clsControl(ccsLabel, "lblAdministrasi", "lblAdministrasi", ccsText, "", CCGetRequestParam("lblAdministrasi", ccsGet, NULL), $this);
        $this->DocNotes = new clsControl(ccsLabel, "DocNotes", "DocNotes", ccsMemo, "", CCGetRequestParam("DocNotes", ccsGet, NULL), $this);
        $this->SubTotal = new clsControl(ccsLabel, "SubTotal", "SubTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("SubTotal", ccsGet, NULL), $this);
        $this->PackCost = new clsControl(ccsLabel, "PackCost", "PackCost", ccsInteger, "", CCGetRequestParam("PackCost", ccsGet, NULL), $this);
        $this->Discount = new clsControl(ccsLabel, "Discount", "Discount", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Discount", ccsGet, NULL), $this);
        $this->Packaging = new clsControl(ccsLabel, "Packaging", "Packaging", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Packaging", ccsGet, NULL), $this);
        $this->Fumigation = new clsControl(ccsLabel, "Fumigation", "Fumigation", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Fumigation", ccsGet, NULL), $this);
        $this->GrandTotal = new clsControl(ccsLabel, "GrandTotal", "GrandTotal", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("GrandTotal", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @45-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @45-CB540FDC
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlInvoice_H_ID"] = CCGetFromGet("Invoice_H_ID", NULL);

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeSelect", $this);


        $this->DataSource->Prepare();
        $this->DataSource->Open();
        $this->HasRecord = $this->DataSource->has_next_record();
        $this->IsEmpty = ! $this->HasRecord;
        $this->Attributes->Show();

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        if(!$this->Visible) return;

        $GridBlock = "Grid " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $GridBlock;


        if (!$this->IsEmpty) {
            $this->ControlsVisible["Invoice_H_ID"] = $this->Invoice_H_ID->Visible;
            $this->ControlsVisible["CollectID"] = $this->CollectID->Visible;
            $this->ControlsVisible["CollectCode"] = $this->CollectCode->Visible;
            $this->ControlsVisible["Qty"] = $this->Qty->Visible;
            $this->ControlsVisible["Unit"] = $this->Unit->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["Total"] = $this->Total->Visible;
            $this->ControlsVisible["CategoryName"] = $this->CategoryName->Visible;
            $this->ControlsVisible["ColorName"] = $this->ColorName->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["Width"] = $this->Width->Visible;
            $this->ControlsVisible["Height"] = $this->Height->Visible;
            $this->ControlsVisible["Length"] = $this->Length->Visible;
            $this->ControlsVisible["Diameter"] = $this->Diameter->Visible;
            $this->ControlsVisible["MaterialName"] = $this->MaterialName->Visible;
            $this->ControlsVisible["NameDesc"] = $this->NameDesc->Visible;
            $this->ControlsVisible["SizeName"] = $this->SizeName->Visible;
            $this->ControlsVisible["TextureName"] = $this->TextureName->Visible;
            $this->ControlsVisible["lblCurrency"] = $this->lblCurrency->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                $this->CollectID->SetValue($this->DataSource->CollectID->GetValue());
                $this->CollectCode->SetValue($this->DataSource->CollectCode->GetValue());
                $this->Qty->SetValue($this->DataSource->Qty->GetValue());
                $this->Unit->SetValue($this->DataSource->Unit->GetValue());
                $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                $this->Total->SetValue($this->DataSource->Total->GetValue());
                $this->CategoryName->SetValue($this->DataSource->CategoryName->GetValue());
                $this->ColorName->SetValue($this->DataSource->ColorName->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->Width->SetValue($this->DataSource->Width->GetValue());
                $this->Height->SetValue($this->DataSource->Height->GetValue());
                $this->Length->SetValue($this->DataSource->Length->GetValue());
                $this->Diameter->SetValue($this->DataSource->Diameter->GetValue());
                $this->MaterialName->SetValue($this->DataSource->MaterialName->GetValue());
                $this->NameDesc->SetValue($this->DataSource->NameDesc->GetValue());
                $this->SizeName->SetValue($this->DataSource->SizeName->GetValue());
                $this->TextureName->SetValue($this->DataSource->TextureName->GetValue());
                $this->Attributes->SetValue("LocalRowNumber", "");
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->Invoice_H_ID->Show();
                $this->CollectID->Show();
                $this->CollectCode->Show();
                $this->Qty->Show();
                $this->Unit->Show();
                $this->UnitPrice->Show();
                $this->Total->Show();
                $this->CategoryName->Show();
                $this->ColorName->Show();
                $this->Photo1->Show();
                $this->Width->Show();
                $this->Height->Show();
                $this->Length->Show();
                $this->Diameter->Show();
                $this->MaterialName->Show();
                $this->NameDesc->Show();
                $this->SizeName->Show();
                $this->TextureName->Show();
                $this->lblCurrency->Show();
                $Tpl->block_path = $ParentPath . "/" . $GridBlock;
                $Tpl->parse("Row", true);
            }
        }
        else { // Show NoRecords block if no records are found
            $this->Attributes->Show();
            $Tpl->parse("NoRecords", false);
        }

        $errors = $this->GetErrors();
        if(strlen($errors))
        {
            $Tpl->replaceblock("", $errors);
            $Tpl->block_path = $ParentPath;
            return;
        }
        $this->Company->Show();
        $this->lblAdministrasi->Show();
        $this->DocNotes->Show();
        $this->SubTotal->Show();
        $this->PackCost->Show();
        $this->Discount->Show();
        $this->Packaging->Show();
        $this->Fumigation->Show();
        $this->GrandTotal->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @45-6AEF9A2B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CollectCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Qty->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Unit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Total->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CategoryName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ColorName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Width->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Height->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Length->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Diameter->Errors->ToString());
        $errors = ComposeStrings($errors, $this->MaterialName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->NameDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SizeName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TextureName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->lblCurrency->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Detil Class @45-FCB6E20C

class clsDetilDataSource extends clsDBGayaFusionAll {  //DetilDataSource Class @45-28B8FEE9

//DataSource Variables @45-9A133323
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $Invoice_H_ID;
    public $CollectID;
    public $CollectCode;
    public $Qty;
    public $Unit;
    public $UnitPrice;
    public $Total;
    public $CategoryName;
    public $ColorName;
    public $Photo1;
    public $Width;
    public $Height;
    public $Length;
    public $Diameter;
    public $MaterialName;
    public $NameDesc;
    public $SizeName;
    public $TextureName;
//End DataSource Variables

//DataSourceClass_Initialize Event @45-2191E803
    function clsDetilDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Detil";
        $this->Initialize();
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsInteger, "");
        
        $this->CollectID = new clsField("CollectID", ccsInteger, "");
        
        $this->CollectCode = new clsField("CollectCode", ccsText, "");
        
        $this->Qty = new clsField("Qty", ccsInteger, "");
        
        $this->Unit = new clsField("Unit", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsFloat, "");
        
        $this->Total = new clsField("Total", ccsFloat, "");
        
        $this->CategoryName = new clsField("CategoryName", ccsText, "");
        
        $this->ColorName = new clsField("ColorName", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->Width = new clsField("Width", ccsFloat, "");
        
        $this->Height = new clsField("Height", ccsFloat, "");
        
        $this->Length = new clsField("Length", ccsFloat, "");
        
        $this->Diameter = new clsField("Diameter", ccsFloat, "");
        
        $this->MaterialName = new clsField("MaterialName", ccsText, "");
        
        $this->NameDesc = new clsField("NameDesc", ccsText, "");
        
        $this->SizeName = new clsField("SizeName", ccsText, "");
        
        $this->TextureName = new clsField("TextureName", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @45-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @45-793D3A3C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_H_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_H_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_invoice_d.Invoice_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @45-E3BBE387
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_invoice_d ON\n\n" .
        "tbladminist_invoice_d.CollectID = tblcollect_master.ID";
        $this->SQL = "SELECT CategoryName, SizeName, TextureName, ColorName, DesignName, MaterialName, NameDesc, ID, Photo1, Width, Height, Length, Diameter,\n\n" .
        "tbladminist_invoice_d.* \n\n" .
        "FROM (((((((tblcollect_master INNER JOIN tblcollect_category ON\n\n" .
        "tblcollect_master.CategoryCode = tblcollect_category.CategoryCode) INNER JOIN tblcollect_color ON\n\n" .
        "tblcollect_master.ColorCode = tblcollect_color.ColorCode) INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_master.DesignCode = tblcollect_design.DesignCode) INNER JOIN tblcollect_name ON\n\n" .
        "tblcollect_master.NameCode = tblcollect_name.NameCode) INNER JOIN tblcollect_size ON\n\n" .
        "tblcollect_master.SizeCode = tblcollect_size.SizeCode) INNER JOIN tblcollect_texture ON\n\n" .
        "tblcollect_master.TextureCode = tblcollect_texture.TextureCode) INNER JOIN tblcollect_material ON\n\n" .
        "tblcollect_master.MaterialCode = tblcollect_material.MaterialCode) INNER JOIN tbladminist_invoice_d ON\n\n" .
        "tbladminist_invoice_d.CollectID = tblcollect_master.ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @45-6401B8AC
    function SetValues()
    {
        $this->Invoice_H_ID->SetDBValue(trim($this->f("Invoice_H_ID")));
        $this->CollectID->SetDBValue(trim($this->f("CollectID")));
        $this->CollectCode->SetDBValue($this->f("CollectCode"));
        $this->Qty->SetDBValue(trim($this->f("Qty")));
        $this->Unit->SetDBValue($this->f("Unit"));
        $this->UnitPrice->SetDBValue(trim($this->f("UnitPrice")));
        $this->Total->SetDBValue(trim($this->f("Total")));
        $this->CategoryName->SetDBValue($this->f("CategoryName"));
        $this->ColorName->SetDBValue($this->f("ColorName"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->Width->SetDBValue(trim($this->f("Width")));
        $this->Height->SetDBValue(trim($this->f("Height")));
        $this->Length->SetDBValue(trim($this->f("Length")));
        $this->Diameter->SetDBValue(trim($this->f("Diameter")));
        $this->MaterialName->SetDBValue($this->f("MaterialName"));
        $this->NameDesc->SetDBValue($this->f("NameDesc"));
        $this->SizeName->SetDBValue($this->f("SizeName"));
        $this->TextureName->SetDBValue($this->f("TextureName"));
    }
//End SetValues Method

} //End DetilDataSource Class @45-FCB6E20C

//Initialize Page @1-E31159AD
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
$TemplateFileName = "ShowInvoice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-53989A2B
include_once("./ShowInvoice_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-856B337D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Header = new clsRecordHeader("", $MainPage);
$Detil = new clsGridDetil("", $MainPage);
$MainPage->Header = & $Header;
$MainPage->Detil = & $Detil;
$Header->Initialize();
$Detil->Initialize();

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

//Execute Components @1-26FC0CAB
$Header->Operation();
//End Execute Components

//Go to destination page @1-4C0FF4C7
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Header);
    unset($Detil);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-BD1B36FC
$Header->Show();
$Detil->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-AE87764E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Header);
unset($Detil);
unset($Tpl);
//End Unload Page


?>
