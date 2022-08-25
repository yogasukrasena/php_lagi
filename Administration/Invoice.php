<?php
//Include Common Files @1-E80C2306
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Invoice.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridInvGrid { //InvGrid class @2-6B3C3173

//Variables @2-31D7B0A5

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
    public $Sorter_InvoiceNo;
    public $Sorter_ClientCompany;
    public $Sorter1;
//End Variables

//Class_Initialize Event @2-0762D44E
    function clsGridInvGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "InvGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid InvGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsInvGridDataSource($this);
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
        $this->SorterName = CCGetParam("InvGridOrder", "");
        $this->SorterDirection = CCGetParam("InvGridDir", "");

        $this->InvoiceNo = new clsControl(ccsLink, "InvoiceNo", "InvoiceNo", ccsText, "", CCGetRequestParam("InvoiceNo", ccsGet, NULL), $this);
        $this->InvoiceNo->Page = "ShowInvoice.php";
        $this->ClientCompany = new clsControl(ccsLabel, "ClientCompany", "ClientCompany", ccsText, "", CCGetRequestParam("ClientCompany", ccsGet, NULL), $this);
        $this->Invoice_H_ID = new clsControl(ccsLink, "Invoice_H_ID", "Invoice_H_ID", ccsText, "", CCGetRequestParam("Invoice_H_ID", ccsGet, NULL), $this);
        $this->Invoice_H_ID->Page = "AddInvoice.php";
        $this->InvoiceDate = new clsControl(ccsLabel, "InvoiceDate", "InvoiceDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("InvoiceDate", ccsGet, NULL), $this);
        $this->DueDate = new clsControl(ccsLabel, "DueDate", "DueDate", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("DueDate", ccsGet, NULL), $this);
        $this->QuotationNo = new clsControl(ccsLink, "QuotationNo", "QuotationNo", ccsText, "", CCGetRequestParam("QuotationNo", ccsGet, NULL), $this);
        $this->QuotationNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->QuotationNo->Page = "";
        $this->ProformaNo = new clsControl(ccsLink, "ProformaNo", "ProformaNo", ccsText, "", CCGetRequestParam("ProformaNo", ccsGet, NULL), $this);
        $this->ProformaNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ProformaNo->Page = "";
        $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", ccsGet, NULL), $this);
        $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", ccsGet, NULL), $this);
        $this->tbladminist_client_tbladm1_TotalRecords = new clsControl(ccsLabel, "tbladminist_client_tbladm1_TotalRecords", "tbladminist_client_tbladm1_TotalRecords", ccsText, "", CCGetRequestParam("tbladminist_client_tbladm1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_InvoiceNo = new clsSorter($this->ComponentName, "Sorter_InvoiceNo", $FileName, $this);
        $this->Sorter_ClientCompany = new clsSorter($this->ComponentName, "Sorter_ClientCompany", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link2->Page = "InvChoice.php";
        $this->Sorter1 = new clsSorter($this->ComponentName, "Sorter1", $FileName, $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-D1AEE316
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_ClientCompany"] = CCGetFromGet("s_ClientCompany", NULL);
        $this->DataSource->Parameters["urls_InvoiceNo"] = CCGetFromGet("s_InvoiceNo", NULL);

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
            $this->ControlsVisible["InvoiceNo"] = $this->InvoiceNo->Visible;
            $this->ControlsVisible["ClientCompany"] = $this->ClientCompany->Visible;
            $this->ControlsVisible["Invoice_H_ID"] = $this->Invoice_H_ID->Visible;
            $this->ControlsVisible["InvoiceDate"] = $this->InvoiceDate->Visible;
            $this->ControlsVisible["DueDate"] = $this->DueDate->Visible;
            $this->ControlsVisible["QuotationNo"] = $this->QuotationNo->Visible;
            $this->ControlsVisible["ProformaNo"] = $this->ProformaNo->Visible;
            $this->ControlsVisible["Quotation_H_ID"] = $this->Quotation_H_ID->Visible;
            $this->ControlsVisible["Proforma_H_ID"] = $this->Proforma_H_ID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->InvoiceNo->SetValue($this->DataSource->InvoiceNo->GetValue());
                $this->InvoiceNo->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->InvoiceNo->Parameters = CCAddParam($this->InvoiceNo->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));
                $this->ClientCompany->SetValue($this->DataSource->ClientCompany->GetValue());
                $this->Invoice_H_ID->SetValue($this->DataSource->Invoice_H_ID->GetValue());
                $this->Invoice_H_ID->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Invoice_H_ID->Parameters = CCAddParam($this->Invoice_H_ID->Parameters, "Invoice_H_ID", $this->DataSource->f("Invoice_H_ID"));
                $this->Invoice_H_ID->Parameters = CCAddParam($this->Invoice_H_ID->Parameters, "InvoiceContactID", $this->DataSource->f("InvoiceContactID"));
                $this->Invoice_H_ID->Parameters = CCAddParam($this->Invoice_H_ID->Parameters, "DeliveryAddressID", $this->DataSource->f("DeliveryAddressID"));
                $this->Invoice_H_ID->Parameters = CCAddParam($this->Invoice_H_ID->Parameters, "AddressID", $this->DataSource->f("AddressID"));
                $this->Invoice_H_ID->Parameters = CCAddParam($this->Invoice_H_ID->Parameters, "DeliveryContactID", $this->DataSource->f("DeliveryContactID"));
                $this->InvoiceDate->SetValue($this->DataSource->InvoiceDate->GetValue());
                $this->DueDate->SetValue($this->DataSource->DueDate->GetValue());
                $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->InvoiceNo->Show();
                $this->ClientCompany->Show();
                $this->Invoice_H_ID->Show();
                $this->InvoiceDate->Show();
                $this->DueDate->Show();
                $this->QuotationNo->Show();
                $this->ProformaNo->Show();
                $this->Quotation_H_ID->Show();
                $this->Proforma_H_ID->Show();
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
        $this->tbladminist_client_tbladm1_TotalRecords->Show();
        $this->Sorter_InvoiceNo->Show();
        $this->Sorter_ClientCompany->Show();
        $this->Navigator->Show();
        $this->Link2->Show();
        $this->Sorter1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-156623CA
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->InvoiceNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Invoice_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->InvoiceDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DueDate->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QuotationNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ProformaNo->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Quotation_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Proforma_H_ID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End InvGrid Class @2-FCB6E20C

class clsInvGridDataSource extends clsDBGayaFusionAll {  //InvGridDataSource Class @2-1C25AB17

//DataSource Variables @2-E15F14A6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $InvoiceNo;
    public $ClientCompany;
    public $Invoice_H_ID;
    public $InvoiceDate;
    public $DueDate;
    public $Quotation_H_ID;
    public $Proforma_H_ID;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-48A5BCD4
    function clsInvGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid InvGrid";
        $this->Initialize();
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->ClientCompany = new clsField("ClientCompany", ccsText, "");
        
        $this->Invoice_H_ID = new clsField("Invoice_H_ID", ccsText, "");
        
        $this->InvoiceDate = new clsField("InvoiceDate", ccsDate, $this->DateFormat);
        
        $this->DueDate = new clsField("DueDate", ccsDate, $this->DateFormat);
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4906D1F6
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_InvoiceNo" => array("InvoiceNo", ""), 
            "Sorter_ClientCompany" => array("ClientCompany", ""), 
            "Sorter1" => array("Invoice_H_ID", "")));
    }
//End SetOrder Method

//Prepare Method @2-225D3CF3
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_ClientCompany", ccsInteger, "", "", $this->Parameters["urls_ClientCompany"], "", false);
        $this->wp->AddParameter("2", "urls_InvoiceNo", ccsText, "", "", $this->Parameters["urls_InvoiceNo"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "tbladminist_invoice_h.ClientID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tbladminist_invoice_h.InvoiceNo", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-575EDF01
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbladminist_invoice_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_invoice_h.ClientID = tbladminist_client.ClientID";
        $this->SQL = "SELECT ClientCompany, tbladminist_invoice_h.* \n\n" .
        "FROM tbladminist_invoice_h INNER JOIN tbladminist_client ON\n\n" .
        "tbladminist_invoice_h.ClientID = tbladminist_client.ClientID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E7F8DA87
    function SetValues()
    {
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->ClientCompany->SetDBValue($this->f("ClientCompany"));
        $this->Invoice_H_ID->SetDBValue($this->f("Invoice_H_ID"));
        $this->InvoiceDate->SetDBValue(trim($this->f("InvoiceDate")));
        $this->DueDate->SetDBValue(trim($this->f("DueDate")));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
    }
//End SetValues Method

} //End InvGridDataSource Class @2-FCB6E20C

class clsRecordInvSearch { //InvSearch Class @17-1AA853D5

//Variables @17-9E315808

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

//Class_Initialize Event @17-FA731591
    function clsRecordInvSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record InvSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "InvSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_InvoiceNo = new clsControl(ccsTextBox, "s_InvoiceNo", "s_InvoiceNo", ccsText, "", CCGetRequestParam("s_InvoiceNo", $Method, NULL), $this);
            $this->s_ClientCompany = new clsControl(ccsListBox, "s_ClientCompany", "s_ClientCompany", ccsText, "", CCGetRequestParam("s_ClientCompany", $Method, NULL), $this);
            $this->s_ClientCompany->DSType = dsTable;
            $this->s_ClientCompany->DataSource = new clsDBGayaFusionAll();
            $this->s_ClientCompany->ds = & $this->s_ClientCompany->DataSource;
            $this->s_ClientCompany->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->s_ClientCompany->BoundColumn, $this->s_ClientCompany->TextColumn, $this->s_ClientCompany->DBFormat) = array("ClientID", "ClientCompany", "");
        }
    }
//End Class_Initialize Event

//Validate Method @17-02FC3E09
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_InvoiceNo->Validate() && $Validation);
        $Validation = ($this->s_ClientCompany->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_InvoiceNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ClientCompany->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @17-5178AC86
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_InvoiceNo->Errors->Count());
        $errors = ($errors || $this->s_ClientCompany->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @17-ED598703
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

//Operation Method @17-6D9E5B2A
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        if(!$this->FormSubmitted) {
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "Invoice.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Invoice.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @17-A4FF0021
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

        $this->s_ClientCompany->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_InvoiceNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ClientCompany->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Errors->ToString());
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

        $this->Button_DoSearch->Show();
        $this->s_InvoiceNo->Show();
        $this->s_ClientCompany->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End InvSearch Class @17-FCB6E20C



//Initialize Page @1-FED08464
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
$TemplateFileName = "Invoice.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-7CE3AC13
include_once("./Invoice_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-ED91C89A
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$InvGrid = new clsGridInvGrid("", $MainPage);
$InvSearch = new clsRecordInvSearch("", $MainPage);
$MainPage->InvGrid = & $InvGrid;
$MainPage->InvSearch = & $InvSearch;
$InvGrid->Initialize();

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

//Execute Components @1-0D66D596
$InvSearch->Operation();
//End Execute Components

//Go to destination page @1-DD0F68B1
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($InvGrid);
    unset($InvSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-EC48FCA6
$InvGrid->Show();
$InvSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-34DFC949
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($InvGrid);
unset($InvSearch);
unset($Tpl);
//End Unload Page


?>
