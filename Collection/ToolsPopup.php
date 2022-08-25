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

//Include Common Files @1-83FE6FDB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ToolsPopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbltoolsSearch { //tbltoolsSearch Class @2-F305B934

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

//Class_Initialize Event @2-4370D018
    function clsRecordtbltoolsSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbltoolsSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbltoolsSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_ToolsCode = new clsControl(ccsTextBox, "s_ToolsCode", "s_ToolsCode", ccsText, "", CCGetRequestParam("s_ToolsCode", $Method, NULL), $this);
            $this->s_ToolsDescription = new clsControl(ccsTextBox, "s_ToolsDescription", "s_ToolsDescription", ccsText, "", CCGetRequestParam("s_ToolsDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-83AC1BE2
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_ToolsCode->Validate() && $Validation);
        $Validation = ($this->s_ToolsDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_ToolsCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ToolsDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-65284093
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ToolsCode->Errors->Count());
        $errors = ($errors || $this->s_ToolsDescription->Errors->Count());
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

//Operation Method @2-0AABF150
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
        $Redirect = "ToolsPopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "ToolsPopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_ToolsCode", "s_ToolsDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-A1BA925A
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
            $Error = ComposeStrings($Error, $this->s_ToolsCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ToolsDescription->Errors->ToString());
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
        $this->s_ToolsCode->Show();
        $this->s_ToolsDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbltoolsSearch Class @2-FCB6E20C

class clsGridtbltools { //tbltools class @6-6EF20898

//Variables @6-9A4DDAC4

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
    public $Sorter_ToolsCode;
    public $Sorter_ToolsDescription;
//End Variables

//Class_Initialize Event @6-8D5E5B85
    function clsGridtbltools($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbltools";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tbltools";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstbltoolsDataSource($this);
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
        $this->SorterName = CCGetParam("tbltoolsOrder", "");
        $this->SorterDirection = CCGetParam("tbltoolsDir", "");

        $this->ToolsCode = new clsControl(ccsLabel, "ToolsCode", "ToolsCode", ccsText, "", CCGetRequestParam("ToolsCode", ccsGet, NULL), $this);
        $this->ToolsDescription = new clsControl(ccsLink, "ToolsDescription", "ToolsDescription", ccsText, "", CCGetRequestParam("ToolsDescription", ccsGet, NULL), $this);
        $this->ToolsDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ToolsDescription->Page = "";
        $this->ToolsPhoto1 = new clsControl(ccsImage, "ToolsPhoto1", "ToolsPhoto1", ccsText, "", CCGetRequestParam("ToolsPhoto1", ccsGet, NULL), $this);
        $this->ToolsID = new clsControl(ccsHidden, "ToolsID", "ToolsID", ccsText, "", CCGetRequestParam("ToolsID", ccsGet, NULL), $this);
        $this->tbltools_TotalRecords = new clsControl(ccsLabel, "tbltools_TotalRecords", "tbltools_TotalRecords", ccsText, "", CCGetRequestParam("tbltools_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_ToolsCode = new clsSorter($this->ComponentName, "Sorter_ToolsCode", $FileName, $this);
        $this->Sorter_ToolsDescription = new clsSorter($this->ComponentName, "Sorter_ToolsDescription", $FileName, $this);
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

//Show Method @6-7F68FF09
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_ToolsCode"] = CCGetFromGet("s_ToolsCode", NULL);
        $this->DataSource->Parameters["urls_ToolsDescription"] = CCGetFromGet("s_ToolsDescription", NULL);

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
            $this->ControlsVisible["ToolsCode"] = $this->ToolsCode->Visible;
            $this->ControlsVisible["ToolsDescription"] = $this->ToolsDescription->Visible;
            $this->ControlsVisible["ToolsPhoto1"] = $this->ToolsPhoto1->Visible;
            $this->ControlsVisible["ToolsID"] = $this->ToolsID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ToolsCode->SetValue($this->DataSource->ToolsCode->GetValue());
                $this->ToolsDescription->SetValue($this->DataSource->ToolsDescription->GetValue());
                $this->ToolsPhoto1->SetValue($this->DataSource->ToolsPhoto1->GetValue());
                $this->ToolsID->SetValue($this->DataSource->ToolsID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ToolsCode->Show();
                $this->ToolsDescription->Show();
                $this->ToolsPhoto1->Show();
                $this->ToolsID->Show();
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
        $this->tbltools_TotalRecords->Show();
        $this->Sorter_ToolsCode->Show();
        $this->Sorter_ToolsDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-E0CAB3D2
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ToolsCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ToolsDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ToolsPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ToolsID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tbltools Class @6-FCB6E20C

class clstbltoolsDataSource extends clsDBGayaFusionAll {  //tbltoolsDataSource Class @6-33906CB2

//DataSource Variables @6-76D8DB62
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $ToolsCode;
    public $ToolsDescription;
    public $ToolsPhoto1;
    public $ToolsID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-E139E1FB
    function clstbltoolsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbltools";
        $this->Initialize();
        $this->ToolsCode = new clsField("ToolsCode", ccsText, "");
        
        $this->ToolsDescription = new clsField("ToolsDescription", ccsText, "");
        
        $this->ToolsPhoto1 = new clsField("ToolsPhoto1", ccsText, "");
        
        $this->ToolsID = new clsField("ToolsID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-AF627287
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ToolsCode" => array("ToolsCode", ""), 
            "Sorter_ToolsDescription" => array("ToolsDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-758BF04C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_ToolsCode", ccsText, "", "", $this->Parameters["urls_ToolsCode"], "", false);
        $this->wp->AddParameter("2", "urls_ToolsDescription", ccsText, "", "", $this->Parameters["urls_ToolsDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "ToolsCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "ToolsDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-E633CCAD
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbltools";
        $this->SQL = "SELECT ID, ToolsCode, ToolsDescription, ToolsPhoto1 \n\n" .
        "FROM tbltools {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-62E1D0F7
    function SetValues()
    {
        $this->ToolsCode->SetDBValue($this->f("ToolsCode"));
        $this->ToolsDescription->SetDBValue($this->f("ToolsDescription"));
        $this->ToolsPhoto1->SetDBValue($this->f("ToolsPhoto1"));
        $this->ToolsID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tbltoolsDataSource Class @6-FCB6E20C

//Initialize Page @1-A02A590E
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
$TemplateFileName = "ToolsPopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-64670995
include_once("./ToolsPopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-E1F75B0E
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbltoolsSearch = new clsRecordtbltoolsSearch("", $MainPage);
$tbltools = new clsGridtbltools("", $MainPage);
$MainPage->tbltoolsSearch = & $tbltoolsSearch;
$MainPage->tbltools = & $tbltools;
$tbltools->Initialize();

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

//Execute Components @1-DDEF2557
$tbltoolsSearch->Operation();
//End Execute Components

//Go to destination page @1-6CE246FC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbltoolsSearch);
    unset($tbltools);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-3B34112C
$tbltoolsSearch->Show();
$tbltools->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-892E501E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbltoolsSearch);
unset($tbltools);
unset($Tpl);
//End Unload Page


?>
