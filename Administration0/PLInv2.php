<?php
//Include Common Files @1-B793FD2A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "PLInv2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
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

//Class_Initialize Event @2-57AE6A5E
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
            $this->InvoiceNo = new clsControl(ccsLabel, "InvoiceNo", "Invoice No", ccsText, "", CCGetRequestParam("InvoiceNo", $Method, NULL), $this);
            $this->ClientID = new clsControl(ccsHidden, "ClientID", "ClientID", ccsText, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsHidden, "AddressID", "AddressID", ccsText, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->CurrencyID = new clsControl(ccsHidden, "CurrencyID", "CurrencyID", ccsInteger, "", CCGetRequestParam("CurrencyID", $Method, NULL), $this);
            $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", $Method, NULL), $this);
            $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", $Method, NULL), $this);
            $this->lblQuotation = new clsControl(ccsLabel, "lblQuotation", "lblQuotation", ccsText, "", CCGetRequestParam("lblQuotation", $Method, NULL), $this);
            $this->lblProforma = new clsControl(ccsLabel, "lblProforma", "lblProforma", ccsText, "", CCGetRequestParam("lblProforma", $Method, NULL), $this);
            $this->lblClient = new clsControl(ccsLabel, "lblClient", "lblClient", ccsText, "", CCGetRequestParam("lblClient", $Method, NULL), $this);
            $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", $Method, NULL), $this);
            $this->lblAddress = new clsControl(ccsLabel, "lblAddress", "lblAddress", ccsText, "", CCGetRequestParam("lblAddress", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-C5715A25
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlInvoice_SH_ID"] = CCGetFromGet("Invoice_SH_ID", NULL);
    }
//End Initialize Method

//Validate Method @2-11FB7D48
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->AddressID->Validate() && $Validation);
        $Validation = ($this->CurrencyID->Validate() && $Validation);
        $Validation = ($this->Quotation_H_ID->Validate() && $Validation);
        $Validation = ($this->Proforma_H_ID->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->CurrencyID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Quotation_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Proforma_H_ID->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-FC1CCAD8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->CurrencyID->Errors->Count());
        $errors = ($errors || $this->Quotation_H_ID->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->lblQuotation->Errors->Count());
        $errors = ($errors || $this->lblProforma->Errors->Count());
        $errors = ($errors || $this->lblClient->Errors->Count());
        $errors = ($errors || $this->lblCurrency->Errors->Count());
        $errors = ($errors || $this->lblAddress->Errors->Count());
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

//Show Method @2-1784120F
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
                if(!$this->FormSubmitted){
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->CurrencyID->SetValue($this->DataSource->CurrencyID->GetValue());
                    $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->InvoiceNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CurrencyID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Quotation_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Proforma_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblQuotation->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblProforma->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblClient->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblCurrency->Errors->ToString());
            $Error = ComposeStrings($Error, $this->lblAddress->Errors->ToString());
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
        $this->ClientID->Show();
        $this->AddressID->Show();
        $this->CurrencyID->Show();
        $this->Quotation_H_ID->Show();
        $this->Proforma_H_ID->Show();
        $this->lblQuotation->Show();
        $this->lblProforma->Show();
        $this->lblClient->Show();
        $this->lblCurrency->Show();
        $this->lblAddress->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-3630980A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $InvoiceNo;
    public $ClientID;
    public $AddressID;
    public $CurrencyID;
    public $Quotation_H_ID;
    public $Proforma_H_ID;
    public $lblQuotation;
    public $lblProforma;
    public $lblClient;
    public $lblCurrency;
    public $lblAddress;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-09265C94
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsText, "");
        
        $this->AddressID = new clsField("AddressID", ccsText, "");
        
        $this->CurrencyID = new clsField("CurrencyID", ccsInteger, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->lblQuotation = new clsField("lblQuotation", ccsText, "");
        
        $this->lblProforma = new clsField("lblProforma", ccsText, "");
        
        $this->lblClient = new clsField("lblClient", ccsText, "");
        
        $this->lblCurrency = new clsField("lblCurrency", ccsText, "");
        
        $this->lblAddress = new clsField("lblAddress", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-8D0C85B3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_SH_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_SH_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Invoice_SH_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-CA6BA0E8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbladminist_invoice_sh {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-8E03CE8E
    function SetValues()
    {
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->ClientID->SetDBValue($this->f("ClientID"));
        $this->AddressID->SetDBValue($this->f("AddressID"));
        $this->CurrencyID->SetDBValue(trim($this->f("Currency")));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
    }
//End SetValues Method

} //End AddNewHeaderDataSource Class @2-FCB6E20C

class clsGridGrid { //Grid class @19-76129994

//Variables @19-6E51DF5A

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

//Class_Initialize Event @19-0B0205CE
    function clsGridGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridDataSource($this);
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

        $this->InvoicePar = new clsControl(ccsLink, "InvoicePar", "InvoicePar", ccsText, "", CCGetRequestParam("InvoicePar", ccsGet, NULL), $this);
        $this->InvoicePar->Page = "PLuseInv.php";
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "PackingList.php";
        $this->Invoice_SH_ID = new clsControl(ccsHidden, "Invoice_SH_ID", "Invoice_SH_ID", ccsText, "", CCGetRequestParam("Invoice_SH_ID", ccsGet, NULL), $this);
        $this->InvoiceDate = new clsControl(ccsLabel, "InvoiceDate", "InvoiceDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("InvoiceDate", ccsGet, NULL), $this);
        $this->DueDate = new clsControl(ccsLabel, "DueDate", "DueDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("DueDate", ccsGet, NULL), $this);
        $this->QuotationNo = new clsControl(ccsLabel, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->ProformaNo = new clsControl(ccsLabel, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->QuotationRev = new clsControl(ccsLabel, "QuotationRev", "QuotationRev", ccsText, "", CCGetRequestParam("QuotationRev", ccsGet, NULL), $this);
        $this->ProformaRev = new clsControl(ccsLabel, "ProformaRev", "ProformaRev", ccsText, "", CCGetRequestParam("ProformaRev", ccsGet, NULL), $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "";
    }
//End Class_Initialize Event

//Initialize Method @19-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @19-B1053209
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urlInvoice_SH_ID"] = CCGetFromGet("Invoice_SH_ID", NULL);

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
            $this->ControlsVisible["InvoicePar"] = $this->InvoicePar->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["Invoice_SH_ID"] = $this->Invoice_SH_ID->Visible;
            $this->ControlsVisible["InvoiceDate"] = $this->InvoiceDate->Visible;
            $this->ControlsVisible["DueDate"] = $this->DueDate->Visible;
            $this->ControlsVisible["QuotationNo"] = $this->QuotationNo->Visible;
            $this->ControlsVisible["ProformaNo"] = $this->ProformaNo->Visible;
            $this->ControlsVisible["QuotationRev"] = $this->QuotationRev->Visible;
            $this->ControlsVisible["ProformaRev"] = $this->ProformaRev->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->InvoicePar->SetValue($this->DataSource->InvoicePar->GetValue());
                $this->InvoicePar->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->InvoicePar->Parameters = CCAddParam($this->InvoicePar->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));
                $this->InvoicePar->Parameters = CCAddParam($this->InvoicePar->Parameters, "Invoice_SH_ID", $this->DataSource->f("Invoice_SH_ID"));
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Invoice_SH_ID->SetValue($this->DataSource->Invoice_SH_ID->GetValue());
                $this->InvoiceDate->SetValue($this->DataSource->InvoiceDate->GetValue());
                $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
                $this->QuotationNo->SetValue($this->DataSource->QuotationNo->GetValue());
                $this->ProformaNo->SetValue($this->DataSource->ProformaNo->GetValue());
                $this->QuotationRev->SetValue($this->DataSource->QuotationRev->GetValue());
                $this->ProformaRev->SetValue($this->DataSource->ProformaRev->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->InvoicePar->Show();
                $this->Link1->Show();
                $this->Invoice_SH_ID->Show();
                $this->InvoiceDate->Show();
                $this->DueDate->Show();
                $this->QuotationNo->Show();
                $this->ProformaNo->Show();
                $this->QuotationRev->Show();
                $this->ProformaRev->Show();
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
        $this->Navigator->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator->TotalPages <= 1) {
            $this->Navigator->Visible = false;
        }
        $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "Invoice_SH_ID", $this->DataSource->f("Invoice_SH_ID"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "Quotation_H_ID", $this->DataSource->f("Quotation_H_ID"));
        $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "Proforma_H_ID", $this->DataSource->f("Proforma_H_ID"));
        $this->Navigator->Show();
        $this->Link2->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @19-9A9004B9
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->InvoicePar->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_SH_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DueDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationRev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaRev->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @19-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @19-7708C172

//DataSource Variables @19-09207EDB
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $InvoicePar;
    public $Invoice_SH_ID;
    public $InvoiceDate;
    public $DueDate;
    public $QuotationNo;
    public $ProformaNo;
    public $QuotationRev;
    public $ProformaRev;
//End DataSource Variables

//DataSourceClass_Initialize Event @19-4CFE1BCD
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->InvoicePar = new clsField("InvoicePar", ccsText, "");
        
        $this->Invoice_SH_ID = new clsField("Invoice_SH_ID", ccsText, "");
        
        $this->InvoiceDate = new clsField("InvoiceDate", ccsDate, $this->DateFormat);
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        
        $this->QuotationNo = new clsField("QuotationNo", ccsText, "");
        
        $this->ProformaNo = new clsField("ProformaNo", ccsText, "");
        
        $this->QuotationRev = new clsField("QuotationRev", ccsText, "");
        
        $this->ProformaRev = new clsField("ProformaRev", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @19-9E1383D1
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            "");
    }
//End SetOrder Method

//Prepare Method @19-7D7ABDA0
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlInvoice_SH_ID", ccsInteger, "", "", $this->Parameters["urlInvoice_SH_ID"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_invoice_h.Invoice_SH_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @19-D653C921
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((tbladminist_invoice_sh INNER JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_invoice_h.Invoice_SH_ID = tbladminist_invoice_sh.Invoice_SH_ID) LEFT JOIN tbladminist_quotation_h ON\n\n" .
        "tbladminist_invoice_sh.Quotation_H_ID = tbladminist_quotation_h.Quotation_H_ID) LEFT JOIN tbladminist_proforma_h ON\n\n" .
        "tbladminist_invoice_sh.Proforma_H_ID = tbladminist_proforma_h.Proforma_H_ID";
        $this->SQL = "SELECT tbladminist_invoice_sh.Quotation_H_ID AS tbladminist_invoice_sh_Quotation_H_ID, tbladminist_invoice_sh.Proforma_H_ID AS tbladminist_invoice_sh_Proforma_H_ID,\n\n" .
        "QuotationNo, ProformaNo, tbladminist_proforma_h.Rev AS ProformaRev, tbladminist_quotation_h.Rev AS QuotationRev, Invoice_H_ID,\n\n" .
        "tbladminist_invoice_h.Invoice_SH_ID AS tbladminist_invoice_h_Invoice_SH_ID, InvoicePar, InvoiceDate, DueDate \n\n" .
        "FROM ((tbladminist_invoice_sh INNER JOIN tbladminist_invoice_h ON\n\n" .
        "tbladminist_invoice_h.Invoice_SH_ID = tbladminist_invoice_sh.Invoice_SH_ID) LEFT JOIN tbladminist_quotation_h ON\n\n" .
        "tbladminist_invoice_sh.Quotation_H_ID = tbladminist_quotation_h.Quotation_H_ID) LEFT JOIN tbladminist_proforma_h ON\n\n" .
        "tbladminist_invoice_sh.Proforma_H_ID = tbladminist_proforma_h.Proforma_H_ID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @19-5E8764D5
    function SetValues()
    {
        $this->InvoicePar->SetDBValue($this->f("InvoicePar"));
        $this->Invoice_SH_ID->SetDBValue($this->f("Invoice_SH_ID"));
        $this->InvoiceDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
        $this->QuotationNo->SetDBValue($this->f("QuotationNo"));
        $this->ProformaNo->SetDBValue($this->f("ProformaNo"));
        $this->QuotationRev->SetDBValue($this->f("QuotationRev"));
        $this->ProformaRev->SetDBValue($this->f("ProformaRev"));
    }
//End SetValues Method

} //End GridDataSource Class @19-FCB6E20C

//Initialize Page @1-01B7C55A
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
$TemplateFileName = "PLInv2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2AA0ADE5
include_once("./PLInv2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3C184BE1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddNewHeader = new clsRecordAddNewHeader("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$MainPage->AddNewHeader = & $AddNewHeader;
$MainPage->Grid = & $Grid;
$AddNewHeader->Initialize();
$Grid->Initialize();

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

//Execute Components @1-E7A5D1D0
$AddNewHeader->Operation();
//End Execute Components

//Go to destination page @1-E68E40CF
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddNewHeader);
    unset($Grid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-2BA606B1
$AddNewHeader->Show();
$Grid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-4487DAAC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddNewHeader);
unset($Grid);
unset($Tpl);
//End Unload Page


?>
