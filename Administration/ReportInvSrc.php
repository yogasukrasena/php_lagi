<?php
//Include Common Files @1-C8F05D08
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ReportInvSrc.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearch { //Search Class @2-39E8735D

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

//Class_Initialize Event @2-BA8A2923
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
            $this->s_ClientID = new clsControl(ccsListBox, "s_ClientID", "s_ClientID", ccsInteger, "", CCGetRequestParam("s_ClientID", $Method, NULL), $this);
            $this->s_ClientID->DSType = dsTable;
            $this->s_ClientID->DataSource = new clsDBGayaFusionAll();
            $this->s_ClientID->ds = & $this->s_ClientID->DataSource;
            $this->s_ClientID->DataSource->SQL = "SELECT * \n" .
"FROM tbladminist_client {SQL_Where} {SQL_OrderBy}";
            list($this->s_ClientID->BoundColumn, $this->s_ClientID->TextColumn, $this->s_ClientID->DBFormat) = array("ClientID", "ClientCompany", "");
            $this->s_due_date = new clsControl(ccsTextBox, "s_due_date", "s_due_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_due_date", $Method, NULL), $this);
            $this->DatePicker_s_due_date = new clsDatePicker("DatePicker_s_due_date", "Search", "s_due_date", $this);
            $this->s_due_date1 = new clsControl(ccsTextBox, "s_due_date1", "s_due_date1", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_due_date1", $Method, NULL), $this);
            $this->DatePicker_s_due_date1 = new clsDatePicker("DatePicker_s_due_date1", "Search", "s_due_date1", $this);
            $this->s_rec_date = new clsControl(ccsTextBox, "s_rec_date", "s_rec_date", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_rec_date", $Method, NULL), $this);
            $this->DatePicker_s_due_date2 = new clsDatePicker("DatePicker_s_due_date2", "Search", "s_rec_date", $this);
            $this->s_rec_date1 = new clsControl(ccsTextBox, "s_rec_date1", "s_rec_date1", ccsDate, $DefaultDateFormat, CCGetRequestParam("s_rec_date1", $Method, NULL), $this);
            $this->DatePicker_s_due_date3 = new clsDatePicker("DatePicker_s_due_date3", "Search", "s_rec_date1", $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-CD06A9D4
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_ClientID->Validate() && $Validation);
        $Validation = ($this->s_due_date->Validate() && $Validation);
        $Validation = ($this->s_due_date1->Validate() && $Validation);
        $Validation = ($this->s_rec_date->Validate() && $Validation);
        $Validation = ($this->s_rec_date1->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_ClientID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_due_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_due_date1->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_rec_date->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_rec_date1->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-6F7C0B5B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ClientID->Errors->Count());
        $errors = ($errors || $this->s_due_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_due_date->Errors->Count());
        $errors = ($errors || $this->s_due_date1->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_due_date1->Errors->Count());
        $errors = ($errors || $this->s_rec_date->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_due_date2->Errors->Count());
        $errors = ($errors || $this->s_rec_date1->Errors->Count());
        $errors = ($errors || $this->DatePicker_s_due_date3->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @2-1457057F
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
        $Redirect = "ReportInv.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ReportInv.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-E9DD015B
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

        $this->s_ClientID->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_ClientID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_due_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_due_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_due_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_rec_date->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_due_date2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_rec_date1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DatePicker_s_due_date3->Errors->ToString());
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
        $this->s_ClientID->Show();
        $this->s_due_date->Show();
        $this->DatePicker_s_due_date->Show();
        $this->s_due_date1->Show();
        $this->DatePicker_s_due_date1->Show();
        $this->s_rec_date->Show();
        $this->DatePicker_s_due_date2->Show();
        $this->s_rec_date1->Show();
        $this->DatePicker_s_due_date3->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @2-FCB6E20C

//Initialize Page @1-A8509978
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
$TemplateFileName = "ReportInvSrc.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-A50806AB
include_once("./ReportInvSrc_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-692F09C7
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Search = new clsRecordSearch("", $MainPage);
$MainPage->Search = & $Search;

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

//Go to destination page @1-D015DC72
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-E0AD76CE
$Search->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-23A3C6B1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Tpl);
//End Unload Page


?>
