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
//Include Common Files @1-FED729B2
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "GlazePopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblglazeSearch { //tblglazeSearch Class @2-6AA6D3DD

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

//Class_Initialize Event @2-2175FB40
    function clsRecordtblglazeSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblglazeSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblglazeSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_GlazeCode = new clsControl(ccsTextBox, "s_GlazeCode", "s_GlazeCode", ccsText, "", CCGetRequestParam("s_GlazeCode", $Method, NULL), $this);
            $this->s_GlazeDescription = new clsControl(ccsTextBox, "s_GlazeDescription", "s_GlazeDescription", ccsText, "", CCGetRequestParam("s_GlazeDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-803F9AC0
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_GlazeCode->Validate() && $Validation);
        $Validation = ($this->s_GlazeDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_GlazeCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_GlazeDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-C57CF82D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_GlazeCode->Errors->Count());
        $errors = ($errors || $this->s_GlazeDescription->Errors->Count());
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

//Operation Method @2-7E76B1C1
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
        $Redirect = "GlazePopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "GlazePopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_GlazeCode", "s_GlazeDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-096E6F69
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
            $Error = ComposeStrings($Error, $this->s_GlazeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_GlazeDescription->Errors->ToString());
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
        $this->s_GlazeCode->Show();
        $this->s_GlazeDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblglazeSearch Class @2-FCB6E20C

class clsGridGlazeGrid { //GlazeGrid class @6-57546D55

//Variables @6-9EAB3CB7

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
    public $Sorter_GlazeCode;
    public $Sorter_GlazeDescription;
//End Variables

//Class_Initialize Event @6-2C1475C9
    function clsGridGlazeGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "GlazeGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid GlazeGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGlazeGridDataSource($this);
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
        $this->SorterName = CCGetParam("GlazeGridOrder", "");
        $this->SorterDirection = CCGetParam("GlazeGridDir", "");

        $this->GlazeCode = new clsControl(ccsLabel, "GlazeCode", "GlazeCode", ccsText, "", CCGetRequestParam("GlazeCode", ccsGet, NULL), $this);
        $this->GlazeDescription = new clsControl(ccsLink, "GlazeDescription", "GlazeDescription", ccsText, "", CCGetRequestParam("GlazeDescription", ccsGet, NULL), $this);
        $this->GlazeDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->GlazeDescription->Page = "";
        $this->GlazePhoto1 = new clsControl(ccsImage, "GlazePhoto1", "GlazePhoto1", ccsText, "", CCGetRequestParam("GlazePhoto1", ccsGet, NULL), $this);
        $this->GlazeID = new clsControl(ccsHidden, "GlazeID", "GlazeID", ccsText, "", CCGetRequestParam("GlazeID", ccsGet, NULL), $this);
        $this->tblglaze_TotalRecords = new clsControl(ccsLabel, "tblglaze_TotalRecords", "tblglaze_TotalRecords", ccsText, "", CCGetRequestParam("tblglaze_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_GlazeCode = new clsSorter($this->ComponentName, "Sorter_GlazeCode", $FileName, $this);
        $this->Sorter_GlazeDescription = new clsSorter($this->ComponentName, "Sorter_GlazeDescription", $FileName, $this);
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

//Show Method @6-A83EB83C
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_GlazeCode"] = CCGetFromGet("s_GlazeCode", NULL);
        $this->DataSource->Parameters["urls_GlazeDescription"] = CCGetFromGet("s_GlazeDescription", NULL);

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
            $this->ControlsVisible["GlazeCode"] = $this->GlazeCode->Visible;
            $this->ControlsVisible["GlazeDescription"] = $this->GlazeDescription->Visible;
            $this->ControlsVisible["GlazePhoto1"] = $this->GlazePhoto1->Visible;
            $this->ControlsVisible["GlazeID"] = $this->GlazeID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->GlazeCode->SetValue($this->DataSource->GlazeCode->GetValue());
                $this->GlazeDescription->SetValue($this->DataSource->GlazeDescription->GetValue());
                $this->GlazePhoto1->SetValue($this->DataSource->GlazePhoto1->GetValue());
                $this->GlazeID->SetValue($this->DataSource->GlazeID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->GlazeCode->Show();
                $this->GlazeDescription->Show();
                $this->GlazePhoto1->Show();
                $this->GlazeID->Show();
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
        $this->tblglaze_TotalRecords->Show();
        $this->Sorter_GlazeCode->Show();
        $this->Sorter_GlazeDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-684D75DE
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->GlazeCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazePhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GlazeID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End GlazeGrid Class @6-FCB6E20C

class clsGlazeGridDataSource extends clsDBGayaFusionAll {  //GlazeGridDataSource Class @6-33A51C30

//DataSource Variables @6-660953A1
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $GlazeCode;
    public $GlazeDescription;
    public $GlazePhoto1;
    public $GlazeID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-27C617B0
    function clsGlazeGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid GlazeGrid";
        $this->Initialize();
        $this->GlazeCode = new clsField("GlazeCode", ccsText, "");
        
        $this->GlazeDescription = new clsField("GlazeDescription", ccsText, "");
        
        $this->GlazePhoto1 = new clsField("GlazePhoto1", ccsText, "");
        
        $this->GlazeID = new clsField("GlazeID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-EAC7F289
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_GlazeCode" => array("GlazeCode", ""), 
            "Sorter_GlazeDescription" => array("GlazeDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-409DC83B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_GlazeCode", ccsText, "", "", $this->Parameters["urls_GlazeCode"], "", false);
        $this->wp->AddParameter("2", "urls_GlazeDescription", ccsText, "", "", $this->Parameters["urls_GlazeDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "GlazeCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "GlazeDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-6AB70CB1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblglaze";
        $this->SQL = "SELECT ID, GlazeCode, GlazeDescription, GlazePhoto1 \n\n" .
        "FROM tblglaze {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-9E57B025
    function SetValues()
    {
        $this->GlazeCode->SetDBValue($this->f("GlazeCode"));
        $this->GlazeDescription->SetDBValue($this->f("GlazeDescription"));
        $this->GlazePhoto1->SetDBValue($this->f("GlazePhoto1"));
        $this->GlazeID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End GlazeGridDataSource Class @6-FCB6E20C

//Initialize Page @1-C7E76B91
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
$TemplateFileName = "GlazePopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2779BBE7
include_once("./GlazePopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A4D2D29C
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblglazeSearch = new clsRecordtblglazeSearch("", $MainPage);
$GlazeGrid = new clsGridGlazeGrid("", $MainPage);
$MainPage->tblglazeSearch = & $tblglazeSearch;
$MainPage->GlazeGrid = & $GlazeGrid;
$GlazeGrid->Initialize();

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

//Execute Components @1-63A72BF5
$tblglazeSearch->Operation();
//End Execute Components

//Go to destination page @1-547C3964
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblglazeSearch);
    unset($GlazeGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7040ED9B
$tblglazeSearch->Show();
$GlazeGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);

$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-F1E7CEF7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblglazeSearch);
unset($GlazeGrid);
unset($Tpl);
//End Unload Page


?>
