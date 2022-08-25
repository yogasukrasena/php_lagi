<?php
//Include Common Files @1-B7ADE31C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ProfPayment2.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordPayment { //Payment Class @2-D1BD1EF7

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

//Class_Initialize Event @2-5B74F8EC
    function clsRecordPayment($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record Payment/Error";
        $this->DataSource = new clsPaymentDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "Payment";
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
            $this->paid_date = new clsControl(ccsTextBox, "paid_date", "Paid Date", ccsDate, array("dd", "/", "mm", "/", "yyyy"), CCGetRequestParam("paid_date", $Method, NULL), $this);
            $this->paid_date->Required = true;
            $this->DatePicker_paid_date = new clsDatePicker("DatePicker_paid_date", "Payment", "paid_date", $this);
            $this->amount_paid = new clsControl(ccsTextBox, "amount_paid", "Amount Paid", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("amount_paid", $Method, NULL), $this);
            $this->amount_paid->Required = true;
            $this->currency_id = new clsControl(ccsHidden, "currency_id", "Currency Id", ccsInteger, "", CCGetRequestParam("currency_id", $Method, NULL), $this);
            $this->Rate = new clsControl(ccsTextBox, "Rate", "Rate", ccsFloat, array(False, 2, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("Rate", $Method, NULL), $this);
            $this->ar_proforma_id = new clsControl(ccsHidden, "ar_proforma_id", "Ar Proforma Id", ccsInteger, "", CCGetRequestParam("ar_proforma_id", $Method, NULL), $this);
            $this->ar_proforma_id->Required = true;
            $this->lblCurrency = new clsControl(ccsLabel, "lblCurrency", "lblCurrency", ccsText, "", CCGetRequestParam("lblCurrency", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-3892B82A
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlpay_proforma_id"] = CCGetFromGet("pay_proforma_id", NULL);
    }
//End Initialize Method

//Validate Method @2-62BC428A
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->paid_date->Validate() && $Validation);
        $Validation = ($this->amount_paid->Validate() && $Validation);
        $Validation = ($this->currency_id->Validate() && $Validation);
        $Validation = ($this->Rate->Validate() && $Validation);
        $Validation = ($this->ar_proforma_id->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->paid_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->amount_paid->Errors->Count() == 0);
        $Validation =  $Validation && ($this->currency_id->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Rate->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ar_proforma_id->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-3D9EE69B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->paid_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_paid_date->Errors->Count());
        $errors = ($errors || $this->amount_paid->Errors->Count());
        $errors = ($errors || $this->currency_id->Errors->Count());
        $errors = ($errors || $this->Rate->Errors->Count());
        $errors = ($errors || $this->ar_proforma_id->Errors->Count());
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

//Operation Method @2-F8EE5203
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
                $Redirect = "ProfPayment.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = "ClientReceivedPro.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
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

//InsertRow Method @2-52BA2B8E
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->paid_date->SetValue($this->paid_date->GetValue(true));
        $this->DataSource->amount_paid->SetValue($this->amount_paid->GetValue(true));
        $this->DataSource->currency_id->SetValue($this->currency_id->GetValue(true));
        $this->DataSource->Rate->SetValue($this->Rate->GetValue(true));
        $this->DataSource->ar_proforma_id->SetValue($this->ar_proforma_id->GetValue(true));
        $this->DataSource->lblCurrency->SetValue($this->lblCurrency->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @2-A0688FD1
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->paid_date->SetValue($this->paid_date->GetValue(true));
        $this->DataSource->amount_paid->SetValue($this->amount_paid->GetValue(true));
        $this->DataSource->currency_id->SetValue($this->currency_id->GetValue(true));
        $this->DataSource->Rate->SetValue($this->Rate->GetValue(true));
        $this->DataSource->ar_proforma_id->SetValue($this->ar_proforma_id->GetValue(true));
        $this->DataSource->lblCurrency->SetValue($this->lblCurrency->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @2-FF1E00F1
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
                if(!$this->FormSubmitted){
                    $this->paid_date->SetValue($this->DataSource->paid_date->GetValue());
                    $this->amount_paid->SetValue($this->DataSource->amount_paid->GetValue());
                    $this->currency_id->SetValue($this->DataSource->currency_id->GetValue());
                    $this->Rate->SetValue($this->DataSource->Rate->GetValue());
                    $this->ar_proforma_id->SetValue($this->DataSource->ar_proforma_id->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->paid_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_paid_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->amount_paid->Errors->ToString());
            $Error = ComposeStrings($Error, $this->currency_id->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Rate->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ar_proforma_id->Errors->ToString());
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
        $this->paid_date->Show();
        $this->DatePicker_paid_date->Show();
        $this->amount_paid->Show();
        $this->currency_id->Show();
        $this->Rate->Show();
        $this->ar_proforma_id->Show();
        $this->lblCurrency->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End Payment Class @2-FCB6E20C

class clsPaymentDataSource extends clsDBGayaFusionAll {  //PaymentDataSource Class @2-1C53C1C2

//DataSource Variables @2-A3EF5D03
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $paid_date;
    public $amount_paid;
    public $currency_id;
    public $Rate;
    public $ar_proforma_id;
    public $lblCurrency;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-6C6B3459
    function clsPaymentDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record Payment/Error";
        $this->Initialize();
        $this->paid_date = new clsField("paid_date", ccsDate, $this->DateFormat);
        
        $this->amount_paid = new clsField("amount_paid", ccsFloat, "");
        
        $this->currency_id = new clsField("currency_id", ccsInteger, "");
        
        $this->Rate = new clsField("Rate", ccsFloat, "");
        
        $this->ar_proforma_id = new clsField("ar_proforma_id", ccsInteger, "");
        
        $this->lblCurrency = new clsField("lblCurrency", ccsText, "");
        

        $this->InsertFields["paid_date"] = array("Name" => "paid_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->InsertFields["amount_paid"] = array("Name" => "amount_paid", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["currency_id"] = array("Name" => "currency_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["Rate"] = array("Name" => "Rate", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->InsertFields["ar_proforma_id"] = array("Name" => "ar_proforma_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["paid_date"] = array("Name" => "paid_date", "Value" => "", "DataType" => ccsDate, "OmitIfEmpty" => 1);
        $this->UpdateFields["amount_paid"] = array("Name" => "amount_paid", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["currency_id"] = array("Name" => "currency_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["Rate"] = array("Name" => "Rate", "Value" => "", "DataType" => ccsFloat, "OmitIfEmpty" => 1);
        $this->UpdateFields["ar_proforma_id"] = array("Name" => "ar_proforma_id", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-2FD24942
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlpay_proforma_id", ccsInteger, "", "", $this->Parameters["urlpay_proforma_id"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "pay_proforma_id", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @2-37C63C56
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM pay_proforma {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-10B82DF1
    function SetValues()
    {
        $this->paid_date->SetDBValue(trim($this->f("paid_date")));
        $this->amount_paid->SetDBValue(trim($this->f("amount_paid")));
        $this->currency_id->SetDBValue(trim($this->f("currency_id")));
        $this->Rate->SetDBValue(trim($this->f("Rate")));
        $this->ar_proforma_id->SetDBValue(trim($this->f("ar_proforma_id")));
    }
//End SetValues Method

//Insert Method @2-FD40C38F
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["paid_date"]["Value"] = $this->paid_date->GetDBValue(true);
        $this->InsertFields["amount_paid"]["Value"] = $this->amount_paid->GetDBValue(true);
        $this->InsertFields["currency_id"]["Value"] = $this->currency_id->GetDBValue(true);
        $this->InsertFields["Rate"]["Value"] = $this->Rate->GetDBValue(true);
        $this->InsertFields["ar_proforma_id"]["Value"] = $this->ar_proforma_id->GetDBValue(true);
        $this->SQL = CCBuildInsert("pay_proforma", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @2-A0382312
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["paid_date"]["Value"] = $this->paid_date->GetDBValue(true);
        $this->UpdateFields["amount_paid"]["Value"] = $this->amount_paid->GetDBValue(true);
        $this->UpdateFields["currency_id"]["Value"] = $this->currency_id->GetDBValue(true);
        $this->UpdateFields["Rate"]["Value"] = $this->Rate->GetDBValue(true);
        $this->UpdateFields["ar_proforma_id"]["Value"] = $this->ar_proforma_id->GetDBValue(true);
        $this->SQL = CCBuildUpdate("pay_proforma", $this->UpdateFields, $this);
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

} //End PaymentDataSource Class @2-FCB6E20C

//Initialize Page @1-4FD73A42
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
$TemplateFileName = "ProfPayment2.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-934F27D8
include_once("./ProfPayment2_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E6B1CE80
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Payment = new clsRecordPayment("", $MainPage);
$MainPage->Payment = & $Payment;
$Payment->Initialize();

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

//Execute Components @1-D36EDCE9
$Payment->Operation();
//End Execute Components

//Go to destination page @1-2ADF5BA4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Payment);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7D2676C7
$Payment->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-09C604BC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Payment);
unset($Tpl);
//End Unload Page


?>
