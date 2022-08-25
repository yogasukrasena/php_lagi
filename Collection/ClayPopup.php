<?php
//Include Common Files @1-D23B0327
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ClayPopup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblclaySearch { //tblclaySearch Class @2-F3DD5016

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

//Class_Initialize Event @2-583A7AEE
    function clsRecordtblclaySearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblclaySearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblclaySearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_ClayCode = new clsControl(ccsTextBox, "s_ClayCode", "s_ClayCode", ccsText, "", CCGetRequestParam("s_ClayCode", $Method, NULL), $this);
            $this->s_ClayDescription = new clsControl(ccsTextBox, "s_ClayDescription", "s_ClayDescription", ccsText, "", CCGetRequestParam("s_ClayDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @2-C198B2B1
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_ClayCode->Validate() && $Validation);
        $Validation = ($this->s_ClayDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_ClayCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_ClayDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-2ED80500
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ClayCode->Errors->Count());
        $errors = ($errors || $this->s_ClayDescription->Errors->Count());
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

//Operation Method @2-86DDF5BE
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
        //$Redirect = "Clay.php";
		$Redirect = "ClayPopup.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                //$Redirect = "Clay.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
				$Redirect = "ClayPopup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-C7FC8909
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
            $Error = ComposeStrings($Error, $this->s_ClayCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_ClayDescription->Errors->ToString());
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
        $this->s_ClayCode->Show();
        $this->s_ClayDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblclaySearch Class @2-FCB6E20C

class clsGridtblclay { //tblclay class @6-65E1A89A

//Variables @6-AAE9295F

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
    public $Sorter_ClayCode;
    public $Sorter_ClayDescription;
//End Variables

//Class_Initialize Event @6-C567D8C7
    function clsGridtblclay($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblclay";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblclay";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblclayDataSource($this);
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
        $this->SorterName = CCGetParam("tblclayOrder", "");
        $this->SorterDirection = CCGetParam("tblclayDir", "");

        $this->ClayCode = new clsControl(ccsLabel, "ClayCode", "ClayCode", ccsText, "", CCGetRequestParam("ClayCode", ccsGet, NULL), $this);
        $this->ClayDescription = new clsControl(ccsLink, "ClayDescription", "ClayDescription", ccsText, "", CCGetRequestParam("ClayDescription", ccsGet, NULL), $this);
        $this->ClayDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ClayDescription->Page = "";
        $this->ClayPhoto1 = new clsControl(ccsImage, "ClayPhoto1", "ClayPhoto1", ccsText, "", CCGetRequestParam("ClayPhoto1", ccsGet, NULL), $this);
        $this->ClayID = new clsControl(ccsHidden, "ClayID", "ClayID", ccsText, "", CCGetRequestParam("ClayID", ccsGet, NULL), $this);
        $this->tblclay_TotalRecords = new clsControl(ccsLabel, "tblclay_TotalRecords", "tblclay_TotalRecords", ccsText, "", CCGetRequestParam("tblclay_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_ClayCode = new clsSorter($this->ComponentName, "Sorter_ClayCode", $FileName, $this);
        $this->Sorter_ClayDescription = new clsSorter($this->ComponentName, "Sorter_ClayDescription", $FileName, $this);
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

//Show Method @6-37F1A20E
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_ClayCode"] = CCGetFromGet("s_ClayCode", NULL);
        $this->DataSource->Parameters["urls_ClayDescription"] = CCGetFromGet("s_ClayDescription", NULL);

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
            $this->ControlsVisible["ClayCode"] = $this->ClayCode->Visible;
            $this->ControlsVisible["ClayDescription"] = $this->ClayDescription->Visible;
            $this->ControlsVisible["ClayPhoto1"] = $this->ClayPhoto1->Visible;
            $this->ControlsVisible["ClayID"] = $this->ClayID->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ClayCode->SetValue($this->DataSource->ClayCode->GetValue());
                $this->ClayDescription->SetValue($this->DataSource->ClayDescription->GetValue());
                $this->ClayPhoto1->SetValue($this->DataSource->ClayPhoto1->GetValue());
                $this->ClayID->SetValue($this->DataSource->ClayID->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ClayCode->Show();
                $this->ClayDescription->Show();
                $this->ClayPhoto1->Show();
                $this->ClayID->Show();
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
        $this->tblclay_TotalRecords->Show();
        $this->Sorter_ClayCode->Show();
        $this->Sorter_ClayDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @6-BFB8BB26
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ClayCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblclay Class @6-FCB6E20C

class clstblclayDataSource extends clsDBGayaFusionAll {  //tblclayDataSource Class @6-232BD427

//DataSource Variables @6-60F11FE6
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $ClayCode;
    public $ClayDescription;
    public $ClayPhoto1;
    public $ClayID;
//End DataSource Variables

//DataSourceClass_Initialize Event @6-7008D771
    function clstblclayDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblclay";
        $this->Initialize();
        $this->ClayCode = new clsField("ClayCode", ccsText, "");
        
        $this->ClayDescription = new clsField("ClayDescription", ccsText, "");
        
        $this->ClayPhoto1 = new clsField("ClayPhoto1", ccsText, "");
        
        $this->ClayID = new clsField("ClayID", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @6-90319816
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ClayCode" => array("ClayCode", ""), 
            "Sorter_ClayDescription" => array("ClayDescription", "")));
    }
//End SetOrder Method

//Prepare Method @6-7129842E
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_ClayCode", ccsText, "", "", $this->Parameters["urls_ClayCode"], "", false);
        $this->wp->AddParameter("2", "urls_ClayDescription", ccsText, "", "", $this->Parameters["urls_ClayDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "ClayCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "ClayDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @6-DEAA6583
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblclay";
        $this->SQL = "SELECT ID, ClayCode, ClayDescription, ClayPhoto1 \n\n" .
        "FROM tblclay {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @6-839464BA
    function SetValues()
    {
        $this->ClayCode->SetDBValue($this->f("ClayCode"));
        $this->ClayDescription->SetDBValue($this->f("ClayDescription"));
        $this->ClayPhoto1->SetDBValue($this->f("ClayPhoto1"));
        $this->ClayID->SetDBValue($this->f("ID"));
    }
//End SetValues Method

} //End tblclayDataSource Class @6-FCB6E20C

//Initialize Page @1-B2A60C39
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
$TemplateFileName = "ClayPopup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-22FF689A
include_once("./ClayPopup_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-29B2B9D4
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblclaySearch = new clsRecordtblclaySearch("", $MainPage);
$tblclay = new clsGridtblclay("", $MainPage);
$MainPage->tblclaySearch = & $tblclaySearch;
$MainPage->tblclay = & $tblclay;
$tblclay->Initialize();

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

//Execute Components @1-A3B18FC3
$tblclaySearch->Operation();
//End Execute Components

//Go to destination page @1-EDA5E921
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblclaySearch);
    unset($tblclay);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-DBEC8B59
$tblclaySearch->Show();
$tblclay->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D06DD678
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblclaySearch);
unset($tblclay);
unset($Tpl);
//End Unload Page


?>
