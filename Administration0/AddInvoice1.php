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
//Include Common Files @1-CC19BEA0
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "AddInvoice1.php");
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

//Class_Initialize Event @2-CA2A02D4
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
            $this->InvoiceNo->Required = true;
            $this->ClientID = new clsControl(ccsListBox, "ClientID", "ClientID", ccsText, "", CCGetRequestParam("ClientID", $Method, NULL), $this);
            $this->ClientID->DSType = dsTable;
            $this->ClientID->DataSource = new clsDBGayaFusionAll();
            $this->ClientID->ds = & $this->ClientID->DataSource;
            $this->ClientID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->ClientID->BoundColumn, $this->ClientID->TextColumn, $this->ClientID->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->Proforma_H_ID = new clsControl(ccsHidden, "Proforma_H_ID", "Proforma_H_ID", ccsInteger, "", CCGetRequestParam("Proforma_H_ID", $Method, NULL), $this);
            $this->Quotation_H_ID = new clsControl(ccsHidden, "Quotation_H_ID", "Quotation_H_ID", ccsInteger, "", CCGetRequestParam("Quotation_H_ID", $Method, NULL), $this);
            $this->AddressID = new clsControl(ccsListBox, "AddressID", "AddressID", ccsText, "", CCGetRequestParam("AddressID", $Method, NULL), $this);
            $this->AddressID->DSType = dsTable;
            $this->AddressID->DataSource = new clsDBGayaFusionAll();
            $this->AddressID->ds = & $this->AddressID->DataSource;
            $this->AddressID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_addressbook {SQL_Where} {SQL_OrderBy}";
            list($this->AddressID->BoundColumn, $this->AddressID->TextColumn, $this->AddressID->DBFormat) = array("AddressID", "Company", "");
            $this->Currency = new clsControl(ccsListBox, "Currency", "Currency", ccsInteger, "", CCGetRequestParam("Currency", $Method, NULL), $this);
            $this->Currency->DSType = dsTable;
            $this->Currency->DataSource = new clsDBGayaFusionAll();
            $this->Currency->ds = & $this->Currency->DataSource;
            $this->Currency->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_currency {SQL_Where} {SQL_OrderBy}";
            list($this->Currency->BoundColumn, $this->Currency->TextColumn, $this->Currency->DBFormat) = array("CurrencyID", "Currency", "");
            $this->DocMaker = new clsControl(ccsHidden, "DocMaker", "DocMaker", ccsInteger, "", CCGetRequestParam("DocMaker", $Method, NULL), $this);
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

//Validate Method @2-A71513F9
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->InvoiceNo->Validate() && $Validation);
        $Validation = ($this->ClientID->Validate() && $Validation);
        $Validation = ($this->Proforma_H_ID->Validate() && $Validation);
        $Validation = ($this->Quotation_H_ID->Validate() && $Validation);
        $Validation = ($this->AddressID->Validate() && $Validation);
        $Validation = ($this->Currency->Validate() && $Validation);
        $Validation = ($this->DocMaker->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->InvoiceNo->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Proforma_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Quotation_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->AddressID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Currency->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DocMaker->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-17986B02
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->InvoiceNo->Errors->Count());
        $errors = ($errors || $this->ClientID->Errors->Count());
        $errors = ($errors || $this->Proforma_H_ID->Errors->Count());
        $errors = ($errors || $this->Quotation_H_ID->Errors->Count());
        $errors = ($errors || $this->AddressID->Errors->Count());
        $errors = ($errors || $this->Currency->Errors->Count());
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

//Operation Method @2-7815509F
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
            $this->PressedButton = "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                $Redirect = "AddInvoice.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "Invoice.php" . "?" . CCGetQueryString("QueryString", array("ccsForm", "Invoice_SH_ID"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update)) {
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

//InsertRow Method @2-3E0A1F2D
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->InvoiceNo->SetValue($this->InvoiceNo->GetValue(true));
        $this->DataSource->ClientID->SetValue($this->ClientID->GetValue(true));
        $this->DataSource->Proforma_H_ID->SetValue($this->Proforma_H_ID->GetValue(true));
        $this->DataSource->Quotation_H_ID->SetValue($this->Quotation_H_ID->GetValue(true));
        $this->DataSource->AddressID->SetValue($this->AddressID->GetValue(true));
        $this->DataSource->Currency->SetValue($this->Currency->GetValue(true));
        $this->DataSource->DocMaker->SetValue($this->DocMaker->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//Show Method @2-0C2E35BD
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

        $this->ClientID->Prepare();
        $this->AddressID->Prepare();
        $this->Currency->Prepare();

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
                    $this->ClientID->SetValue($this->DataSource->ClientID->GetValue());
                    $this->Proforma_H_ID->SetValue($this->DataSource->Proforma_H_ID->GetValue());
                    $this->Quotation_H_ID->SetValue($this->DataSource->Quotation_H_ID->GetValue());
                    $this->AddressID->SetValue($this->DataSource->AddressID->GetValue());
                    $this->Currency->SetValue($this->DataSource->Currency->GetValue());
                    $this->DocMaker->SetValue($this->DataSource->DocMaker->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->InvoiceNo->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Proforma_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Quotation_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->AddressID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Currency->Errors->ToString());
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
        $this->ClientID->Show();
        $this->Proforma_H_ID->Show();
        $this->Quotation_H_ID->Show();
        $this->AddressID->Show();
        $this->Currency->Show();
        $this->DocMaker->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNewHeader Class @2-FCB6E20C

class clsAddNewHeaderDataSource extends clsDBGayaFusionAll {  //AddNewHeaderDataSource Class @2-B5B08D50

//DataSource Variables @2-E1E6EFD0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();

    // Datasource fields
    public $InvoiceNo;
    public $ClientID;
    public $Proforma_H_ID;
    public $Quotation_H_ID;
    public $AddressID;
    public $Currency;
    public $DocMaker;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-DDB26B65
    function clsAddNewHeaderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNewHeader/Error";
        $this->Initialize();
        $this->InvoiceNo = new clsField("InvoiceNo", ccsText, "");
        
        $this->ClientID = new clsField("ClientID", ccsText, "");
        
        $this->Proforma_H_ID = new clsField("Proforma_H_ID", ccsInteger, "");
        
        $this->Quotation_H_ID = new clsField("Quotation_H_ID", ccsInteger, "");
        
        $this->AddressID = new clsField("AddressID", ccsText, "");
        
        $this->Currency = new clsField("Currency", ccsInteger, "");
        
        $this->DocMaker = new clsField("DocMaker", ccsInteger, "");
        

        $this->InsertFields["InvoiceNo"] = array("Name" => "InvoiceNo", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ClientID"] = array("Name" => "ClientID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Proforma_H_ID"] = array("Name" => "Proforma_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Quotation_H_ID"] = array("Name" => "Quotation_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["AddressID"] = array("Name" => "AddressID", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["CurrencyID"] = array("Name" => "CurrencyID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DocMaker"] = array("Name" => "DocMaker", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
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

//SetValues Method @2-67D7D587
    function SetValues()
    {
        $this->InvoiceNo->SetDBValue($this->f("InvoiceNo"));
        $this->ClientID->SetDBValue($this->f("ClientID"));
        $this->Proforma_H_ID->SetDBValue(trim($this->f("Proforma_H_ID")));
        $this->Quotation_H_ID->SetDBValue(trim($this->f("Quotation_H_ID")));
        $this->AddressID->SetDBValue($this->f("AddressID"));
        $this->Currency->SetDBValue(trim($this->f("CurrencyID")));
        $this->DocMaker->SetDBValue(trim($this->f("DocMaker")));
    }
//End SetValues Method

//Insert Method @2-4E9FE178
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["InvoiceNo"]["Value"] = $this->InvoiceNo->GetDBValue(true);
        $this->InsertFields["ClientID"]["Value"] = $this->ClientID->GetDBValue(true);
        $this->InsertFields["Proforma_H_ID"]["Value"] = $this->Proforma_H_ID->GetDBValue(true);
        $this->InsertFields["Quotation_H_ID"]["Value"] = $this->Quotation_H_ID->GetDBValue(true);
        $this->InsertFields["AddressID"]["Value"] = $this->AddressID->GetDBValue(true);
        $this->InsertFields["CurrencyID"]["Value"] = $this->Currency->GetDBValue(true);
        $this->InsertFields["DocMaker"]["Value"] = $this->DocMaker->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbladminist_invoice_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

} //End AddNewHeaderDataSource Class @2-FCB6E20C



//Initialize Page @1-B5EA47CC
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
$TemplateFileName = "AddInvoice1.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-99731449
include_once("./AddInvoice1_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-87D0230A
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$AddNewHeader = new clsRecordAddNewHeader("", $MainPage);
$MainPage->AddNewHeader = & $AddNewHeader;
$AddNewHeader->Initialize();

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

//Go to destination page @1-5EF3D467
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($AddNewHeader);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3D7DD9B0
$AddNewHeader->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-BF07AC96
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($AddNewHeader);
unset($Tpl);
//End Unload Page


?>
