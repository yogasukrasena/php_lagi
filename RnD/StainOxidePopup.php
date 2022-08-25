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
//Include Common Files @1-C860E031
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "StainOxidePopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblstainoxideSearch { //tblstainoxideSearch Class @2-65AB5900

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

//Class_Initialize Event @2-A499BD23
    function clsRecordtblstainoxideSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblstainoxideSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblstainoxideSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_StainOxideCode = new clsControl(ccsTextBox, "s_StainOxideCode", "s_StainOxideCode", ccsText, "", CCGetRequestParam("s_StainOxideCode", $Method, NULL), $this);
            $this->s_StainOxideDescription = new clsControl(ccsTextBox, "s_StainOxideDescription", "s_StainOxideDescription", ccsText, "", CCGetRequestParam("s_StainOxideDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-7DAA31B5
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_StainOxideCode->Validate() && $Validation);
        $Validation = ($this->s_StainOxideDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_StainOxideCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_StainOxideDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-A5AB8CFD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_StainOxideCode->Errors->Count());
        $errors = ($errors || $this->s_StainOxideDescription->Errors->Count());
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

//Operation Method @2-9C97916E
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
        $Redirect = "StainOxidePopup.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "StainOxidePopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_StainOxideCode", "s_StainOxideDescription", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-48C63A1D
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
            $Error = ComposeStrings($Error, $this->s_StainOxideCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_StainOxideDescription->Errors->ToString());
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
        $this->s_StainOxideCode->Show();
        $this->s_StainOxideDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblstainoxideSearch Class @2-FCB6E20C

class clsGridtblstainoxide { //tblstainoxide class @6-58C81270

//Variables @6-B50E8C64

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
    public $Sorter_StainOxideCode;
    public $Sorter_StainOxideDescription;
//End Variables

//Class_Initialize Event @6-FFF1C868
    function clsGridtblstainoxide($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblstainoxide";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblstainoxide";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblstainoxideDataSource($this);
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
        $this->SorterName = CCGetParam("tblstainoxideOrder", "");
        $this->SorterDirection = CCGetParam("tblstainoxideDir", "");

        $this->StainOxideCode = new clsControl(ccsLabel, "StainOxideCode", "StainOxideCode", ccsText, "", CCGetRequestParam("StainOxideCode", ccsGet, NULL), $this);
        $this->StainOxideDescription = new clsControl(ccsLink, "StainOxideDescription", "StainOxideDescription", ccsText, "", CCGetRequestParam("StainOxideDescription", ccsGet, NULL), $this);
        $this->StainOxideDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->StainOxideDescription->Page = "";
        $this->StainOxidePhoto1 = new clsControl(ccsImage, "StainOxidePhoto1", "StainOxidePhoto1", ccsText, "", CCGetRequestParam("StainOxidePhoto1", ccsGet, NULL), $this);
        $this->StainOxideID = new clsControl(ccsHidden, "StainOxideID", "StainOxideID", ccsText, "", CCGetRequestParam("StainOxideID", ccsGet, NULL), $this);
        $this->tblstainoxide_TotalRecords = new clsControl(ccsLabel, "tblstainoxide_TotalRecords", "tblstainoxide_TotalRecords", ccsText, "", CCGetRequestParam("tblstainoxide_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_StainOxideCode = new clsSorter($this->ComponentName, "Sorter_StainOxideCode", $FileName, $this);
        $this->Sorter_StainOxideDescription = new clsSorter($this->ComponentName, "Sorter_StainOxideDescription", $FileName, $this);
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

//Show Method @6-4842C871
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_StainOxideCode"] = CCGetFromGet("s_StainOxideCode", NULL);
        $this->DataSource->Parameters["urls_StainOxideDescription"] = CCGetFromGet("s_StainOxideDescription", NULL);

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
            $this->ControlsVisible["StainOxideCode"] = $this->StainOxideCode->Visible;
            $this->ControlsVisible["StainOxideDescription"] = $this->StainOxideDescription->Visible;
            $this->ControlsVisible["StainOxidePhoto1"] = $this->StainOxidePhoto1->Visible;
            $this->ControlsVisible["StainOxideID"] = $this->StainOxideID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->StainOxideCode->SetValue($this->DataSource->StainOxideCode->GetValue());
                $this->StainOxideDescription->SetValue($this->DataSource->StainOxideDescription->GetValue());
                $this->StainOxidePhoto1->SetValue($this->DataSource->StainOxidePhoto1->GetValue());
                $this->StainOxideID->SetValue($this->DataSource->StainOxideID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->StainOxideCode->Show();
                $this->StainOxideDescription->Show();
                $this->StainOxidePhoto1->Show();
                $this->StainOxideID->Show();
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
        $this->tblstainoxide_TotalRecords->Show();
        $this->Sorter_StainOxideCode->Show();
        $this->Sorter_StainOxideDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-F0645BEF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->StainOxideCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxideDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxidePhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->StainOxideID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblstainoxide Class @6-FCB6E20C

class clstblstainoxideDataSource extends clsDBGayaFusionAll {  //tblstainoxideDataSource Class @6-E62D4DC1

//DataSource Variables @6-256E204A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $StainOxideCode;
    public $StainOxideDescription;
    public $StainOxidePhoto1;
    public $StainOxideID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-FB7720D6
    function clstblstainoxideDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblstainoxide";
        $this->Initialize();
        $this->StainOxideCode = new clsField("StainOxideCode", ccsText, "");
        
        $this->StainOxideDescription = new clsField("StainOxideDescription", ccsText, "");
        
        $this->StainOxidePhoto1 = new clsField("StainOxidePhoto1", ccsText, "");
        
        $this->StainOxideID = new clsField("StainOxideID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-5D92FD19
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_StainOxideCode" => array("StainOxideCode", ""), 
            "Sorter_StainOxideDescription" => array("StainOxideDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-B56C1E80
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_StainOxideCode", ccsText, "", "", $this->Parameters["urls_StainOxideCode"], "", false);
        $this->wp->AddParameter("2", "urls_StainOxideDescription", ccsText, "", "", $this->Parameters["urls_StainOxideDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "StainOxideCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "StainOxideDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-E9AB25FA
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblstainoxide";
        $this->SQL = "SELECT ID, StainOxideCode, StainOxideDescription, StainOxidePhoto1 \n\n" .
        "FROM tblstainoxide {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-C7A7D06C
    function SetValues()
    {
        $this->StainOxideCode->SetDBValue($this->f("StainOxideCode"));
        $this->StainOxideDescription->SetDBValue($this->f("StainOxideDescription"));
        $this->StainOxidePhoto1->SetDBValue($this->f("StainOxidePhoto1"));
        $this->StainOxideID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tblstainoxideDataSource Class @6-FCB6E20C

//Initialize Page @1-BF9AD67B
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
$TemplateFileName = "StainOxidePopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-CD614463
include_once("./StainOxidePopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7121E68E
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblstainoxideSearch = new clsRecordtblstainoxideSearch("", $MainPage);
$tblstainoxide = new clsGridtblstainoxide("", $MainPage);
$MainPage->tblstainoxideSearch = & $tblstainoxideSearch;
$MainPage->tblstainoxide = & $tblstainoxide;
$tblstainoxide->Initialize();

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

//Execute Components @1-653F5752
$tblstainoxideSearch->Operation();
//End Execute Components

//Go to destination page @1-68243FDE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblstainoxideSearch);
    unset($tblstainoxide);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-284BD8E1
$tblstainoxideSearch->Show();
$tblstainoxide->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-06FE9BF5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblstainoxideSearch);
unset($tblstainoxide);
unset($Tpl);
//End Unload Page


?>
