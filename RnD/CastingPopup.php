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

//Include Common Files @1-977FC61F
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CastingPopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblcastingSearch { //tblcastingSearch Class @2-1DAAEE03

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

//Class_Initialize Event @2-5F5030C1
    function clsRecordtblcastingSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblcastingSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblcastingSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_CastingCode = new clsControl(ccsTextBox, "s_CastingCode", "s_CastingCode", ccsText, "", CCGetRequestParam("s_CastingCode", $Method, NULL), $this);
            $this->s_CastingDescription = new clsControl(ccsTextBox, "s_CastingDescription", "s_CastingDescription", ccsText, "", CCGetRequestParam("s_CastingDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-4B24747F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_CastingCode->Validate() && $Validation);
        $Validation = ($this->s_CastingDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_CastingCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_CastingDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-B3CFB9F1
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_CastingCode->Errors->Count());
        $errors = ($errors || $this->s_CastingDescription->Errors->Count());
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

//Operation Method @2-AAC346E7
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
        $Redirect = "CastingPopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "CastingPopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_CastingCode", "s_CastingDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-F741DCF7
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
            $Error = ComposeStrings($Error, $this->s_CastingCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_CastingDescription->Errors->ToString());
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
        $this->s_CastingCode->Show();
        $this->s_CastingDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblcastingSearch Class @2-FCB6E20C

class clsGridtblcasting { //tblcasting class @6-3C7D2A55

//Variables @6-412193AC

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
    public $Sorter_CastingCode;
    public $Sorter_CastingDescription;
//End Variables

//Class_Initialize Event @6-12D0F908
    function clsGridtblcasting($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblcasting";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblcasting";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblcastingDataSource($this);
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
        $this->SorterName = CCGetParam("tblcastingOrder", "");
        $this->SorterDirection = CCGetParam("tblcastingDir", "");

        $this->CastingCode = new clsControl(ccsLabel, "CastingCode", "CastingCode", ccsText, "", CCGetRequestParam("CastingCode", ccsGet, NULL), $this);
        $this->CastingDescription = new clsControl(ccsLink, "CastingDescription", "CastingDescription", ccsText, "", CCGetRequestParam("CastingDescription", ccsGet, NULL), $this);
        $this->CastingDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->CastingDescription->Page = "";
        $this->CastingPhoto1 = new clsControl(ccsImage, "CastingPhoto1", "CastingPhoto1", ccsText, "", CCGetRequestParam("CastingPhoto1", ccsGet, NULL), $this);
        $this->CastingID = new clsControl(ccsHidden, "CastingID", "CastingID", ccsText, "", CCGetRequestParam("CastingID", ccsGet, NULL), $this);
        $this->tblcasting_TotalRecords = new clsControl(ccsLabel, "tblcasting_TotalRecords", "tblcasting_TotalRecords", ccsText, "", CCGetRequestParam("tblcasting_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_CastingCode = new clsSorter($this->ComponentName, "Sorter_CastingCode", $FileName, $this);
        $this->Sorter_CastingDescription = new clsSorter($this->ComponentName, "Sorter_CastingDescription", $FileName, $this);
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

//Show Method @6-34CF8002
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_CastingCode"] = CCGetFromGet("s_CastingCode", NULL);
        $this->DataSource->Parameters["urls_CastingDescription"] = CCGetFromGet("s_CastingDescription", NULL);

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
            $this->ControlsVisible["CastingCode"] = $this->CastingCode->Visible;
            $this->ControlsVisible["CastingDescription"] = $this->CastingDescription->Visible;
            $this->ControlsVisible["CastingPhoto1"] = $this->CastingPhoto1->Visible;
            $this->ControlsVisible["CastingID"] = $this->CastingID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->CastingCode->SetValue($this->DataSource->CastingCode->GetValue());
                $this->CastingDescription->SetValue($this->DataSource->CastingDescription->GetValue());
                $this->CastingPhoto1->SetValue($this->DataSource->CastingPhoto1->GetValue());
                $this->CastingID->SetValue($this->DataSource->CastingID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->CastingCode->Show();
                $this->CastingDescription->Show();
                $this->CastingPhoto1->Show();
                $this->CastingID->Show();
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
        $this->tblcasting_TotalRecords->Show();
        $this->Sorter_CastingCode->Show();
        $this->Sorter_CastingDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-BCA85C6C
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->CastingCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->CastingID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblcasting Class @6-FCB6E20C

class clstblcastingDataSource extends clsDBGayaFusionAll {  //tblcastingDataSource Class @6-3633356D

//DataSource Variables @6-702F74D1
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $CastingCode;
    public $CastingDescription;
    public $CastingPhoto1;
    public $CastingID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-8FE0F568
    function clstblcastingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblcasting";
        $this->Initialize();
        $this->CastingCode = new clsField("CastingCode", ccsText, "");
        
        $this->CastingDescription = new clsField("CastingDescription", ccsText, "");
        
        $this->CastingPhoto1 = new clsField("CastingPhoto1", ccsText, "");
        
        $this->CastingID = new clsField("CastingID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-1139F59C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_CastingCode" => array("CastingCode", ""), 
            "Sorter_CastingDescription" => array("CastingDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-E3CB34EE
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_CastingCode", ccsText, "", "", $this->Parameters["urls_CastingCode"], "", false);
        $this->wp->AddParameter("2", "urls_CastingDescription", ccsText, "", "", $this->Parameters["urls_CastingDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "CastingCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "CastingDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-6FD94BA3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcasting";
        $this->SQL = "SELECT ID, CastingCode, CastingDescription, CastingPhoto1 \n\n" .
        "FROM tblcasting {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-E68F2656
    function SetValues()
    {
        $this->CastingCode->SetDBValue($this->f("CastingCode"));
        $this->CastingDescription->SetDBValue($this->f("CastingDescription"));
        $this->CastingPhoto1->SetDBValue($this->f("CastingPhoto1"));
        $this->CastingID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tblcastingDataSource Class @6-FCB6E20C

//Initialize Page @1-FF3161F0
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
$TemplateFileName = "CastingPopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3E145F0A
include_once("./CastingPopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-026B5999
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcastingSearch = new clsRecordtblcastingSearch("", $MainPage);
$tblcasting = new clsGridtblcasting("", $MainPage);
$MainPage->tblcastingSearch = & $tblcastingSearch;
$MainPage->tblcasting = & $tblcasting;
$tblcasting->Initialize();

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

//Execute Components @1-5D74A7E7
$tblcastingSearch->Operation();
//End Execute Components

//Go to destination page @1-315FE47F
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcastingSearch);
    unset($tblcasting);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3D6A68A7
$tblcastingSearch->Show();
$tblcasting->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-9ADE26D5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcastingSearch);
unset($tblcasting);
unset($Tpl);
//End Unload Page


?>
