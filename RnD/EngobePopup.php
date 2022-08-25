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

//Include Common Files @1-5B99623A
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EngobePopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblengobeSearch { //tblengobeSearch Class @2-9D36722E

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

//Class_Initialize Event @2-BC3D15CE
    function clsRecordtblengobeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblengobeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblengobeSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_EngobeCode = new clsControl(ccsTextBox, "s_EngobeCode", "s_EngobeCode", ccsText, "", CCGetRequestParam("s_EngobeCode", $Method, NULL), $this);
            $this->s_EngobeDescription = new clsControl(ccsTextBox, "s_EngobeDescription", "s_EngobeDescription", ccsText, "", CCGetRequestParam("s_EngobeDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-9D238E61
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_EngobeCode->Validate() && $Validation);
        $Validation = ($this->s_EngobeDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_EngobeCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_EngobeDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C2AC4BF4
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_EngobeCode->Errors->Count());
        $errors = ($errors || $this->s_EngobeDescription->Errors->Count());
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

//Operation Method @2-00BBA9BE
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
        $Redirect = "EngobePopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "EngobePopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_EngobeCode", "s_EngobeDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-E033F510
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
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_EngobeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_EngobeDescription->Errors->ToString());
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
        $this->s_EngobeCode->Show();
        $this->s_EngobeDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblengobeSearch Class @2-FCB6E20C

class clsGridtblengobe { //tblengobe class @6-0AFAF82F

//Variables @6-F36E7127

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
    public $Sorter_EngobeCode;
    public $Sorter_EngobeDescription;
    public $Sorter_EngobePhoto1;
//End Variables

//Class_Initialize Event @6-8F306A3D
    function clsGridtblengobe($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblengobe";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblengobe";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblengobeDataSource($this);
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
        $this->SorterName = CCGetParam("tblengobeOrder", "");
        $this->SorterDirection = CCGetParam("tblengobeDir", "");

        $this->EngobeCode = new clsControl(ccsLabel, "EngobeCode", "EngobeCode", ccsText, "", CCGetRequestParam("EngobeCode", ccsGet, NULL), $this);
        $this->EngobeDescription = new clsControl(ccsLink, "EngobeDescription", "EngobeDescription", ccsText, "", CCGetRequestParam("EngobeDescription", ccsGet, NULL), $this);
        $this->EngobeDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->EngobeDescription->Page = "";
        $this->EngobePhoto1 = new clsControl(ccsLabel, "EngobePhoto1", "EngobePhoto1", ccsText, "", CCGetRequestParam("EngobePhoto1", ccsGet, NULL), $this);
        $this->EngobeID = new clsControl(ccsHidden, "EngobeID", "EngobeID", ccsText, "", CCGetRequestParam("EngobeID", ccsGet, NULL), $this);
        $this->tblengobe_TotalRecords = new clsControl(ccsLabel, "tblengobe_TotalRecords", "tblengobe_TotalRecords", ccsText, "", CCGetRequestParam("tblengobe_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_EngobeCode = new clsSorter($this->ComponentName, "Sorter_EngobeCode", $FileName, $this);
        $this->Sorter_EngobeDescription = new clsSorter($this->ComponentName, "Sorter_EngobeDescription", $FileName, $this);
        $this->Sorter_EngobePhoto1 = new clsSorter($this->ComponentName, "Sorter_EngobePhoto1", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @6-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @6-27754A1B
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_EngobeCode"] = CCGetFromGet("s_EngobeCode", NULL);
        $this->DataSource->Parameters["urls_EngobeDescription"] = CCGetFromGet("s_EngobeDescription", NULL);

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
            $this->ControlsVisible["EngobeCode"] = $this->EngobeCode->Visible;
            $this->ControlsVisible["EngobeDescription"] = $this->EngobeDescription->Visible;
            $this->ControlsVisible["EngobePhoto1"] = $this->EngobePhoto1->Visible;
            $this->ControlsVisible["EngobeID"] = $this->EngobeID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->EngobeCode->SetValue($this->DataSource->EngobeCode->GetValue());
                $this->EngobeDescription->SetValue($this->DataSource->EngobeDescription->GetValue());
                $this->EngobePhoto1->SetValue($this->DataSource->EngobePhoto1->GetValue());
                $this->EngobeID->SetValue($this->DataSource->EngobeID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->EngobeCode->Show();
                $this->EngobeDescription->Show();
                $this->EngobePhoto1->Show();
                $this->EngobeID->Show();
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
        $this->tblengobe_TotalRecords->Show();
        $this->Sorter_EngobeCode->Show();
        $this->Sorter_EngobeDescription->Show();
        $this->Sorter_EngobePhoto1->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-FC9073B3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->EngobeCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EngobeDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EngobePhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EngobeID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblengobe Class @6-FCB6E20C

class clstblengobeDataSource extends clsDBGayaFusionAll {  //tblengobeDataSource Class @6-2D7F96DA

//DataSource Variables @6-DDA23694
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $EngobeCode;
    public $EngobeDescription;
    public $EngobePhoto1;
    public $EngobeID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-A3F890A7
    function clstblengobeDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblengobe";
        $this->Initialize();
        $this->EngobeCode = new clsField("EngobeCode", ccsText, "");
        
        $this->EngobeDescription = new clsField("EngobeDescription", ccsText, "");
        
        $this->EngobePhoto1 = new clsField("EngobePhoto1", ccsText, "");
        
        $this->EngobeID = new clsField("EngobeID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-8A2DEE72
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_EngobeCode" => array("EngobeCode", ""), 
            "Sorter_EngobeDescription" => array("EngobeDescription", ""), 
            "Sorter_EngobePhoto1" => array("EngobePhoto1", "")));
    }
//End SetOrder Method

//Prepare Method @6-51165CAB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_EngobeCode", ccsText, "", "", $this->Parameters["urls_EngobeCode"], "", false);
        $this->wp->AddParameter("2", "urls_EngobeDescription", ccsText, "", "", $this->Parameters["urls_EngobeDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "EngobeCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "EngobeDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-97F978B7
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblengobe";
        $this->SQL = "SELECT ID, EngobeCode, EngobeDescription, EngobePhoto1 \n\n" .
        "FROM tblengobe {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-650F09AD
    function SetValues()
    {
        $this->EngobeCode->SetDBValue($this->f("EngobeCode"));
        $this->EngobeDescription->SetDBValue($this->f("EngobeDescription"));
        $this->EngobePhoto1->SetDBValue($this->f("EngobePhoto1"));
        $this->EngobeID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tblengobeDataSource Class @6-FCB6E20C

//Initialize Page @1-8CDDE08D
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
$TemplateFileName = "EngobePopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-34DE8FF8
include_once("./EngobePopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-512334CF
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblengobeSearch = new clsRecordtblengobeSearch("", $MainPage);
$tblengobe = new clsGridtblengobe("", $MainPage);
$MainPage->tblengobeSearch = & $tblengobeSearch;
$MainPage->tblengobe = & $tblengobe;
$tblengobe->Initialize();

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

//Execute Components @1-A48D835A
$tblengobeSearch->Operation();
//End Execute Components

//Go to destination page @1-BAEE2599
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblengobeSearch);
    unset($tblengobe);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9AA6F82A
$tblengobeSearch->Show();
$tblengobe->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-74E948C1
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblengobeSearch);
unset($tblengobe);
unset($Tpl);
//End Unload Page


?>
