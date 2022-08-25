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

//Include Common Files @1-0FCACF08
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "EstruderPopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblestruderSearch { //tblestruderSearch Class @2-E1301EC8

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

//Class_Initialize Event @2-66B6BD6D
    function clsRecordtblestruderSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblestruderSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblestruderSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_EstruderCode = new clsControl(ccsTextBox, "s_EstruderCode", "s_EstruderCode", ccsText, "", CCGetRequestParam("s_EstruderCode", $Method, NULL), $this);
            $this->s_EstruderDescription = new clsControl(ccsTextBox, "s_EstruderDescription", "s_EstruderDescription", ccsText, "", CCGetRequestParam("s_EstruderDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-FDBF0ABF
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_EstruderCode->Validate() && $Validation);
        $Validation = ($this->s_EstruderDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_EstruderCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_EstruderDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-A1D4AC01
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_EstruderCode->Errors->Count());
        $errors = ($errors || $this->s_EstruderDescription->Errors->Count());
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

//Operation Method @2-C9D39FAE
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
        $Redirect = "EstruderPopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "EstruderPopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_EstruderCode", "s_EstruderDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-BFF8F8CB
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
            $Error = ComposeStrings($Error, $this->s_EstruderCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_EstruderDescription->Errors->ToString());
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
        $this->s_EstruderCode->Show();
        $this->s_EstruderDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblestruderSearch Class @2-FCB6E20C

class clsGridtblestruder { //tblestruder class @6-4879F8E7

//Variables @6-317C7B22

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
    public $Sorter_EstruderCode;
    public $Sorter_EstruderDescription;
    public $Sorter_EstruderPhoto1;
//End Variables

//Class_Initialize Event @6-410537B3
    function clsGridtblestruder($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblestruder";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblestruder";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblestruderDataSource($this);
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
        $this->SorterName = CCGetParam("tblestruderOrder", "");
        $this->SorterDirection = CCGetParam("tblestruderDir", "");

        $this->EstruderCode = new clsControl(ccsLabel, "EstruderCode", "EstruderCode", ccsText, "", CCGetRequestParam("EstruderCode", ccsGet, NULL), $this);
        $this->EstruderDescription = new clsControl(ccsLink, "EstruderDescription", "EstruderDescription", ccsText, "", CCGetRequestParam("EstruderDescription", ccsGet, NULL), $this);
        $this->EstruderDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->EstruderDescription->Page = "";
        $this->EstruderPhoto1 = new clsControl(ccsImage, "EstruderPhoto1", "EstruderPhoto1", ccsText, "", CCGetRequestParam("EstruderPhoto1", ccsGet, NULL), $this);
        $this->EstruderID = new clsControl(ccsHidden, "EstruderID", "EstruderID", ccsText, "", CCGetRequestParam("EstruderID", ccsGet, NULL), $this);
        $this->tblestruder_TotalRecords = new clsControl(ccsLabel, "tblestruder_TotalRecords", "tblestruder_TotalRecords", ccsText, "", CCGetRequestParam("tblestruder_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_EstruderCode = new clsSorter($this->ComponentName, "Sorter_EstruderCode", $FileName, $this);
        $this->Sorter_EstruderDescription = new clsSorter($this->ComponentName, "Sorter_EstruderDescription", $FileName, $this);
        $this->Sorter_EstruderPhoto1 = new clsSorter($this->ComponentName, "Sorter_EstruderPhoto1", $FileName, $this);
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

//Show Method @6-F7D454FE
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_EstruderCode"] = CCGetFromGet("s_EstruderCode", NULL);
        $this->DataSource->Parameters["urls_EstruderDescription"] = CCGetFromGet("s_EstruderDescription", NULL);

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
            $this->ControlsVisible["EstruderCode"] = $this->EstruderCode->Visible;
            $this->ControlsVisible["EstruderDescription"] = $this->EstruderDescription->Visible;
            $this->ControlsVisible["EstruderPhoto1"] = $this->EstruderPhoto1->Visible;
            $this->ControlsVisible["EstruderID"] = $this->EstruderID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->EstruderCode->SetValue($this->DataSource->EstruderCode->GetValue());
                $this->EstruderDescription->SetValue($this->DataSource->EstruderDescription->GetValue());
                $this->EstruderPhoto1->SetValue($this->DataSource->EstruderPhoto1->GetValue());
                $this->EstruderID->SetValue($this->DataSource->EstruderID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->EstruderCode->Show();
                $this->EstruderDescription->Show();
                $this->EstruderPhoto1->Show();
                $this->EstruderID->Show();
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
        $this->tblestruder_TotalRecords->Show();
        $this->Sorter_EstruderCode->Show();
        $this->Sorter_EstruderDescription->Show();
        $this->Sorter_EstruderPhoto1->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-C28F0BB6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->EstruderCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblestruder Class @6-FCB6E20C

class clstblestruderDataSource extends clsDBGayaFusionAll {  //tblestruderDataSource Class @6-A80CA00D

//DataSource Variables @6-5CB29DD6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $EstruderCode;
    public $EstruderDescription;
    public $EstruderPhoto1;
    public $EstruderID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-8BAB9611
    function clstblestruderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblestruder";
        $this->Initialize();
        $this->EstruderCode = new clsField("EstruderCode", ccsText, "");
        
        $this->EstruderDescription = new clsField("EstruderDescription", ccsText, "");
        
        $this->EstruderPhoto1 = new clsField("EstruderPhoto1", ccsText, "");
        
        $this->EstruderID = new clsField("EstruderID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-04151174
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_EstruderCode" => array("EstruderCode", ""), 
            "Sorter_EstruderDescription" => array("EstruderDescription", ""), 
            "Sorter_EstruderPhoto1" => array("EstruderPhoto1", "")));
    }
//End SetOrder Method

//Prepare Method @6-0E825B4E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_EstruderCode", ccsText, "", "", $this->Parameters["urls_EstruderCode"], "", false);
        $this->wp->AddParameter("2", "urls_EstruderDescription", ccsText, "", "", $this->Parameters["urls_EstruderDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "EstruderCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "EstruderDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-1E16B38D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblestruder";
        $this->SQL = "SELECT ID, EstruderCode, EstruderDescription, EstruderPhoto1 \n\n" .
        "FROM tblestruder {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-8F86B09B
    function SetValues()
    {
        $this->EstruderCode->SetDBValue($this->f("EstruderCode"));
        $this->EstruderDescription->SetDBValue($this->f("EstruderDescription"));
        $this->EstruderPhoto1->SetDBValue($this->f("EstruderPhoto1"));
        $this->EstruderID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tblestruderDataSource Class @6-FCB6E20C

//Initialize Page @1-91911899
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
$TemplateFileName = "EstruderPopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CB9CBBB2
include_once("./EstruderPopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-C28FAE8D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblestruderSearch = new clsRecordtblestruderSearch("", $MainPage);
$tblestruder = new clsGridtblestruder("", $MainPage);
$MainPage->tblestruderSearch = & $tblestruderSearch;
$MainPage->tblestruder = & $tblestruder;
$tblestruder->Initialize();

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

//Execute Components @1-8D4B7989
$tblestruderSearch->Operation();
//End Execute Components

//Go to destination page @1-1F14DA76
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblestruderSearch);
    unset($tblestruder);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-9D4E74A2
$tblestruderSearch->Show();
$tblestruder->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-02AA52A9
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblestruderSearch);
unset($tblestruder);
unset($Tpl);
//End Unload Page


?>
