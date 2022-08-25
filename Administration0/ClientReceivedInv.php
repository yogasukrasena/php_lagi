<?php
//Include Common Files @1-682BF7B2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ClientReceivedInv.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridGrid { //Grid class @2-76129994

//Variables @2-857EAAF7

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
    public $Sorter_pay_proforma_id;
    public $Sorter_paid_date;
    public $Sorter_amount_paid;
    public $Sorter_client_id;
//End Variables

//Class_Initialize Event @2-BBEE6D61
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
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->pay_invoice_id = new clsControl(ccsLink, "pay_invoice_id", "pay_invoice_id", ccsInteger, "", CCGetRequestParam("pay_invoice_id", ccsGet, NULL), $this);
        $this->pay_invoice_id->Page = "InvPayment2.php";
        $this->paid_date = new clsControl(ccsLabel, "paid_date", "paid_date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("paid_date", ccsGet, NULL), $this);
        $this->amount_paid = new clsControl(ccsLabel, "amount_paid", "amount_paid", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("amount_paid", ccsGet, NULL), $this);
        $this->currency_id = new clsControl(ccsLabel, "currency_id", "currency_id", ccsText, "", CCGetRequestParam("currency_id", ccsGet, NULL), $this);
        $this->client = new clsControl(ccsLabel, "client", "client", ccsText, "", CCGetRequestParam("client", ccsGet, NULL), $this);
        $this->ar_proforma_pay_proforma1_TotalRecords = new clsControl(ccsLabel, "ar_proforma_pay_proforma1_TotalRecords", "ar_proforma_pay_proforma1_TotalRecords", ccsText, "", CCGetRequestParam("ar_proforma_pay_proforma1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_pay_proforma_id = new clsSorter($this->ComponentName, "Sorter_pay_proforma_id", $FileName, $this);
        $this->Sorter_paid_date = new clsSorter($this->ComponentName, "Sorter_paid_date", $FileName, $this);
        $this->Sorter_amount_paid = new clsSorter($this->ComponentName, "Sorter_amount_paid", $FileName, $this);
        $this->Sorter_client_id = new clsSorter($this->ComponentName, "Sorter_client_id", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-E1564A0E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_client_id"] = CCGetFromGet("s_client_id", NULL);
        $this->DataSource->Parameters["urls_paid_date"] = CCGetFromGet("s_paid_date", NULL);

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
            $this->ControlsVisible["pay_invoice_id"] = $this->pay_invoice_id->Visible;
            $this->ControlsVisible["paid_date"] = $this->paid_date->Visible;
            $this->ControlsVisible["amount_paid"] = $this->amount_paid->Visible;
            $this->ControlsVisible["currency_id"] = $this->currency_id->Visible;
            $this->ControlsVisible["client"] = $this->client->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->pay_invoice_id->SetValue($this->DataSource->pay_invoice_id->GetValue());
                $this->pay_invoice_id->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->pay_invoice_id->Parameters = CCAddParam($this->pay_invoice_id->Parameters, "pay_invoice_id", $this->DataSource->f("pay_invoice_id"));
                $this->paid_date->SetValue($this->DataSource->paid_date->GetValue());
                $this->amount_paid->SetValue($this->DataSource->amount_paid->GetValue());
                $this->currency_id->SetValue($this->DataSource->currency_id->GetValue());
                $this->client->SetValue($this->DataSource->client->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->pay_invoice_id->Show();
                $this->paid_date->Show();
                $this->amount_paid->Show();
                $this->currency_id->Show();
                $this->client->Show();
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
        $this->ar_proforma_pay_proforma1_TotalRecords->Show();
        $this->Sorter_pay_proforma_id->Show();
        $this->Sorter_paid_date->Show();
        $this->Sorter_amount_paid->Show();
        $this->Sorter_client_id->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-4057231F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->pay_invoice_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->paid_date->Errors->ToString());
        $errors = ComposeStrings($errors, $this->amount_paid->Errors->ToString());
        $errors = ComposeStrings($errors, $this->currency_id->Errors->ToString());
        $errors = ComposeStrings($errors, $this->client->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-EA128A31
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $pay_invoice_id;
    public $paid_date;
    public $amount_paid;
    public $currency_id;
    public $client;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-BD7BB3DA
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->pay_invoice_id = new clsField("pay_invoice_id", ccsInteger, "");
        
        $this->paid_date = new clsField("paid_date", ccsDate, $this->DateFormat);
        
        $this->amount_paid = new clsField("amount_paid", ccsFloat, "");
        
        $this->currency_id = new clsField("currency_id", ccsText, "");
        
        $this->client = new clsField("client", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-70F84802
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_pay_proforma_id" => array("pay_proforma_id", ""), 
            "Sorter_paid_date" => array("paid_date", ""), 
            "Sorter_amount_paid" => array("amount_paid", ""), 
            "Sorter_client_id" => array("ClientCompany", "")));
    }
//End SetOrder Method

//Prepare Method @2-8748EDD5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_client_id", ccsInteger, "", "", $this->Parameters["urls_client_id"], "", false);
        $this->wp->AddParameter("2", "urls_paid_date", ccsDate, $DefaultDateFormat, $this->DateFormat, $this->Parameters["urls_paid_date"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ar_invoice.ClientID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opEqual, "pay_invoice.paid_date", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsDate),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-9A5DC2EB
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM ((ar_invoice INNER JOIN pay_invoice ON\n\n" .
        "pay_invoice.ar_invoice_id = ar_invoice.ar_invoice_id) INNER JOIN tbladminist_client ON\n\n" .
        "ar_invoice.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_currency ON\n\n" .
        "pay_invoice.currency_id = tbladminist_currency.CurrencyID";
        $this->SQL = "SELECT ClientCompany, tbladminist_currency.Currency AS tbladminist_currency_Currency, pay_invoice_id, pay_invoice.ar_invoice_id AS ar_invoice_id,\n\n" .
        "pay_invoice.paid_date AS Paid_Date, pay_invoice.amount_paid AS Amount_Paid, pay_invoice.currency_id AS currency_id, pay_invoice.Rate AS Rate,\n\n" .
        "ar_invoice.ClientID AS ClientID \n\n" .
        "FROM ((ar_invoice INNER JOIN pay_invoice ON\n\n" .
        "pay_invoice.ar_invoice_id = ar_invoice.ar_invoice_id) INNER JOIN tbladminist_client ON\n\n" .
        "ar_invoice.ClientID = tbladminist_client.ClientID) INNER JOIN tbladminist_currency ON\n\n" .
        "pay_invoice.currency_id = tbladminist_currency.CurrencyID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-251226EF
    function SetValues()
    {
        $this->pay_invoice_id->SetDBValue(trim($this->f("pay_invoice_id")));
        $this->paid_date->SetDBValue(trim($this->f("Paid_Date")));
        $this->amount_paid->SetDBValue(trim($this->f("Amount_Paid")));
        $this->currency_id->SetDBValue($this->f("tbladminist_currency_Currency"));
        $this->client->SetDBValue($this->f("ClientCompany"));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C

class clsRecordSearch { //Search Class @14-39E8735D

//Variables @14-9E315808

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

//Class_Initialize Event @14-C5615690
    function clsRecordSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Search/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Search";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_client_id = new clsControl(ccsListBox, "s_client_id", "s_client_id", ccsInteger, "", CCGetRequestParam("s_client_id", $Method, NULL), $this);
            $this->s_client_id->DSType = dsTable;
            $this->s_client_id->DataSource = new clsDBGayaFusionAll();
            $this->s_client_id->ds = & $this->s_client_id->DataSource;
            $this->s_client_id->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->s_client_id->BoundColumn, $this->s_client_id->TextColumn, $this->s_client_id->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->s_paid_date = new clsControl(ccsTextBox, "s_paid_date", "s_paid_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_paid_date", $Method, NULL), $this);
            $this->DatePicker_s_paid_date = new clsDatePicker("DatePicker_s_paid_date", "Search", "s_paid_date", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @14-39F2EAE6
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_client_id->Validate() && $Validation);
        $Validation = ($this->s_paid_date->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_client_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_paid_date->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @14-1FD5C7C8
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_client_id->Errors->Count());
        $errors = ($errors || $this->s_paid_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_paid_date->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @14-ED598703
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

//Operation Method @14-B0BE4B9E
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
        $Redirect = "ClientReceivedInv.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ClientReceivedInv.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @14-3C7C5B2D
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

        $this->s_client_id->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_client_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_paid_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_paid_date->Errors->ToString());
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
        $this->s_client_id->Show();
        $this->s_paid_date->Show();
        $this->DatePicker_s_paid_date->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @14-FCB6E20C

//Initialize Page @1-58053B34
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
$TemplateFileName = "ClientReceivedInv.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-26463881
include_once("./ClientReceivedInv_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-554D1A09
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Grid = new clsGridGrid("", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$MainPage->Grid = & $Grid;
$MainPage->Search = & $Search;
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

//Execute Components @1-34D1993E
$Search->Operation();
//End Execute Components

//Go to destination page @1-9D0437D3
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Grid);
    unset($Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4C3280B7
$Grid->Show();
$Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F8DFA0A3
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Grid);
unset($Search);
unset($Tpl);
//End Unload Page


?>
