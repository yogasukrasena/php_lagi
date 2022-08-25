<?php
//Include Common Files @1-8094F3BB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "SampleCeramic.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordsampleceramicSearch { //sampleceramicSearch Class @3-C8006D23

//Variables @3-9E315808

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

//Class_Initialize Event @3-E4B52585
    function clsRecordsampleceramicSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record sampleceramicSearch/Error";
        $this->DataSource = new clssampleceramicSearchDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "sampleceramicSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->s_SampleCode = new clsControl(ccsTextBox, "s_SampleCode", "s_SampleCode", ccsText, "", CCGetRequestParam("s_SampleCode", $Method, NULL), $this);
            $this->s_SampleDescription = new clsControl(ccsTextBox, "s_SampleDescription", "s_SampleDescription", ccsText, "", CCGetRequestParam("s_SampleDescription", $Method, NULL), $this);
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @3-5D060BAC
    function Initialize()
    {

        if(!$this->Visible)
            return;

    }
//End Initialize Method

//Validate Method @3-F61AE455
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_SampleCode->Validate() && $Validation);
        $Validation = ($this->s_SampleDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_SampleCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SampleDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-29BCB6A6
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_SampleCode->Errors->Count());
        $errors = ($errors || $this->s_SampleDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @3-ED598703
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

//Operation Method @3-7AD86B8D
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = true;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = "Button_DoSearch";
            if($this->Button_DoSearch->Pressed) {
                $this->PressedButton = "Button_DoSearch";
            }
        }
        $Redirect = "SampleCeramic.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "SampleCeramic.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
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

//Show Method @3-E4508410
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
            } else {
                $this->EditMode = false;
            }
        }
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SampleDescription->Errors->ToString());
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

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->s_SampleCode->Show();
        $this->s_SampleDescription->Show();
        $this->Button_DoSearch->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End sampleceramicSearch Class @3-FCB6E20C

class clssampleceramicSearchDataSource extends clsDBGayaFusionAll {  //sampleceramicSearchDataSource Class @3-84A6F52E

//DataSource Variables @3-EAC945DD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $s_SampleCode;
    public $s_SampleDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @3-C0CA8DE1
    function clssampleceramicSearchDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record sampleceramicSearch/Error";
        $this->Initialize();
        $this->s_SampleCode = new clsField("s_SampleCode", ccsText, "");
        
        $this->s_SampleDescription = new clsField("s_SampleDescription", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @3-14D6CD9D
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
    }
//End Prepare Method

//Open Method @3-FD4BB828
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM sampleceramic {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @3-BAF0975B
    function SetValues()
    {
    }
//End SetValues Method

} //End sampleceramicSearchDataSource Class @3-FCB6E20C

class clsGridsampleceramicGrid { //sampleceramicGrid class @2-A7FFB882

//Variables @2-9AA8C418

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
    public $Sorter_SampleCode;
    public $Sorter_SampleDescription;
//End Variables

//Class_Initialize Event @2-0931E60D
    function clsGridsampleceramicGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "sampleceramicGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid sampleceramicGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssampleceramicGridDataSource($this);
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
        $this->SorterName = CCGetParam("sampleceramicGridOrder", "");
        $this->SorterDirection = CCGetParam("sampleceramicGridDir", "");

        $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "SampleCode", ccsText, "", CCGetRequestParam("SampleCode", ccsGet, NULL), $this);
        $this->SampleDescription = new clsControl(ccsLabel, "SampleDescription", "SampleDescription", ccsText, "", CCGetRequestParam("SampleDescription", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->copy = new clsControl(ccsLink, "copy", "copy", ccsText, "", CCGetRequestParam("copy", ccsGet, NULL), $this);
        $this->copy->Page = "Copi.php";
        $this->ShowRef = new clsControl(ccsLink, "ShowRef", "ShowRef", ccsText, "", CCGetRequestParam("ShowRef", ccsGet, NULL), $this);
        $this->ShowRef->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->ShowRef->Page = "";
        $this->TotalRecord = new clsControl(ccsLabel, "TotalRecord", "TotalRecord", ccsText, "", CCGetRequestParam("TotalRecord", ccsGet, NULL), $this);
        $this->Sorter_SampleCode = new clsSorter($this->ComponentName, "Sorter_SampleCode", $FileName, $this);
        $this->Sorter_SampleDescription = new clsSorter($this->ComponentName, "Sorter_SampleDescription", $FileName, $this);
        $this->Navigator1 = new clsNavigator($this->ComponentName, "Navigator1", $FileName, 10, tpCentered, $this);
        $this->Navigator1->PageSizes = array("1", "5", "10", "25", "50");
        $this->CollectID = new clsControl(ccsHidden, "CollectID", "CollectID", ccsText, "", CCGetRequestParam("CollectID", ccsGet, NULL), $this);
    }
//End Class_Initialize Event

//Initialize Method @2-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @2-B9FD7E3D
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_SampleCode"] = CCGetFromGet("s_SampleCode", NULL);
        $this->DataSource->Parameters["urls_SampleDescription"] = CCGetFromGet("s_SampleDescription", NULL);

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
            $this->ControlsVisible["SampleCode"] = $this->SampleCode->Visible;
            $this->ControlsVisible["SampleDescription"] = $this->SampleDescription->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["copy"] = $this->copy->Visible;
            $this->ControlsVisible["ShowRef"] = $this->ShowRef->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                $this->SampleDescription->SetValue($this->DataSource->SampleDescription->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->copy->Parameters = CCGetQueryString("All", array("ccsForm"));
                $this->copy->Parameters = CCAddParam($this->copy->Parameters, "sID", $this->DataSource->f("sID"));
                $this->copy->Parameters = CCAddParam($this->copy->Parameters, "ID", CCGetFromGet("ID", NULL));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SampleCode->Show();
                $this->SampleDescription->Show();
                $this->Photo1->Show();
                $this->copy->Show();
                $this->ShowRef->Show();
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
        $this->Navigator1->PageNumber = $this->DataSource->AbsolutePage;
        $this->Navigator1->PageSize = $this->PageSize;
        if ($this->DataSource->RecordsCount == "CCS not counted")
            $this->Navigator1->TotalPages = $this->DataSource->AbsolutePage + ($this->DataSource->next_record() ? 1 : 0);
        else
            $this->Navigator1->TotalPages = $this->DataSource->PageCount();
        if ($this->Navigator1->TotalPages <= 1) {
            $this->Navigator1->Visible = false;
        }
        $this->TotalRecord->Show();
        $this->Sorter_SampleCode->Show();
        $this->Sorter_SampleDescription->Show();
        $this->Navigator1->Show();
        $this->CollectID->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-1B5427EF
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SampleDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->copy->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ShowRef->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End sampleceramicGrid Class @2-FCB6E20C

class clssampleceramicGridDataSource extends clsDBGayaFusionAll {  //sampleceramicGridDataSource Class @2-87A098B6

//DataSource Variables @2-0018DA6C
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SampleCode;
    public $SampleDescription;
    public $Photo1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-C835D7DE
    function clssampleceramicGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid sampleceramicGrid";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->SampleDescription = new clsField("SampleDescription", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-FABEA318
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "sID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SampleCode" => array("SampleCode", ""), 
            "Sorter_SampleDescription" => array("SampleDescription", "")));
    }
//End SetOrder Method

//Prepare Method @2-FC2DC4C9
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_SampleCode", ccsText, "", "", $this->Parameters["urls_SampleCode"], "", false);
        $this->wp->AddParameter("2", "urls_SampleDescription", ccsText, "", "", $this->Parameters["urls_SampleDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "SampleCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "SampleDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-B99DC645
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM sampleceramic";
        $this->SQL = "SELECT *, sID, SampleCode, SampleDescription \n\n" .
        "FROM sampleceramic {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-0EB9FE1A
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->SampleDescription->SetDBValue($this->f("SampleDescription"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
    }
//End SetValues Method

} //End sampleceramicGridDataSource Class @2-FCB6E20C



//Initialize Page @1-256701CA
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
$TemplateFileName = "SampleCeramic.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-290A935A
include_once("./SampleCeramic_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9445A9BF
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$sampleceramicSearch = new clsRecordsampleceramicSearch("", $MainPage);
$sampleceramicGrid = new clsGridsampleceramicGrid("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->sampleceramicSearch = & $sampleceramicSearch;
$MainPage->sampleceramicGrid = & $sampleceramicGrid;
$Panel1->AddComponent("sampleceramicSearch", $sampleceramicSearch);
$Panel1->AddComponent("sampleceramicGrid", $sampleceramicGrid);
$sampleceramicSearch->Initialize();
$sampleceramicGrid->Initialize();

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

//Execute Components @1-F25EC17F
$sampleceramicSearch->Operation();
//End Execute Components

//Go to destination page @1-CF6C24A4
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($sampleceramicSearch);
    unset($sampleceramicGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-392CE6AB
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EE01A7E2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($sampleceramicSearch);
unset($sampleceramicGrid);
unset($Tpl);
//End Unload Page


?>
