<?php
//Include Common Files @1-AC7C3012
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "CollectionGroup.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordSearch { //Search Class @8-39E8735D

//Variables @8-9E315808

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

//Class_Initialize Event @8-63C9E9A2
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
            $this->s_DesignName = new clsControl(ccsListBox, "s_DesignName", "s_DesignName", ccsText, "", CCGetRequestParam("s_DesignName", $Method, NULL), $this);
            $this->s_DesignName->DSType = dsTable;
            $this->s_DesignName->DataSource = new clsDBGayaFusionAll();
            $this->s_DesignName->ds = & $this->s_DesignName->DataSource;
            $this->s_DesignName->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_design {SQL_Where} {SQL_OrderBy}";
            list($this->s_DesignName->BoundColumn, $this->s_DesignName->TextColumn, $this->s_DesignName->DBFormat) = array("DesignName", "DesignName", "");
            $this->s_GroupDescription = new clsControl(ccsTextBox, "s_GroupDescription", "s_GroupDescription", ccsText, "", CCGetRequestParam("s_GroupDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @8-13715CD3
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_DesignName->Validate() && $Validation);
        $Validation = ($this->s_GroupDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_DesignName->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_GroupDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @8-4E97E169
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_DesignName->Errors->Count());
        $errors = ($errors || $this->s_GroupDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @8-ED598703
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

//Operation Method @8-5657B726
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
        $Redirect = "CollectionGroup.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "CollectionGroup.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @8-79C36CEA
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

        $this->s_DesignName->Prepare();

        $RecordBlock = "Record " . $this->ComponentName;
        $ParentPath = $Tpl->block_path;
        $Tpl->block_path = $ParentPath . "/" . $RecordBlock;
        $this->EditMode = $this->EditMode && $this->ReadAllowed;
        if (!$this->FormSubmitted) {
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->s_DesignName->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_GroupDescription->Errors->ToString());
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
        $this->s_DesignName->Show();
        $this->s_GroupDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End Search Class @8-FCB6E20C

class clsGridGrid { //Grid class @2-76129994

//Variables @2-BBFD7D96

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
    public $Sorter_GroupCode;
    public $Sorter_DesignName;
    public $Sorter_GroupDescription;
    public $Sorter_ClientCode;
    public $Sorter_ClientDesc;
    public $Sorter_GroupPhoto;
//End Variables

//Class_Initialize Event @2-08718E26
    function clsGridGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "Grid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid Grid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clsGridDataSource($this);
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
        $this->SorterName = CCGetParam("GridOrder", "");
        $this->SorterDirection = CCGetParam("GridDir", "");

        $this->GroupCode = new clsControl(ccsLink, "GroupCode", "GroupCode", ccsText, "", CCGetRequestParam("GroupCode", ccsGet, NULL), $this);
        $this->GroupCode->Page = "GroupDetil.php";
        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->GroupDescription = new clsControl(ccsLabel, "GroupDescription", "GroupDescription", ccsText, "", CCGetRequestParam("GroupDescription", ccsGet, NULL), $this);
        $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "ClientCode", ccsText, "", CCGetRequestParam("ClientCode", ccsGet, NULL), $this);
        $this->ClientDesc = new clsControl(ccsLabel, "ClientDesc", "ClientDesc", ccsText, "", CCGetRequestParam("ClientDesc", ccsGet, NULL), $this);
        $this->GroupPhoto = new clsControl(ccsImage, "GroupPhoto", "GroupPhoto", ccsText, "", CCGetRequestParam("GroupPhoto", ccsGet, NULL), $this);
        $this->tblcollect_design_tblcoll1_TotalRecords = new clsControl(ccsLabel, "tblcollect_design_tblcoll1_TotalRecords", "tblcollect_design_tblcoll1_TotalRecords", ccsText, "", CCGetRequestParam("tblcollect_design_tblcoll1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_GroupCode = new clsSorter($this->ComponentName, "Sorter_GroupCode", $FileName, $this);
        $this->Sorter_DesignName = new clsSorter($this->ComponentName, "Sorter_DesignName", $FileName, $this);
        $this->Sorter_GroupDescription = new clsSorter($this->ComponentName, "Sorter_GroupDescription", $FileName, $this);
        $this->Sorter_ClientCode = new clsSorter($this->ComponentName, "Sorter_ClientCode", $FileName, $this);
        $this->Sorter_ClientDesc = new clsSorter($this->ComponentName, "Sorter_ClientDesc", $FileName, $this);
        $this->Sorter_GroupPhoto = new clsSorter($this->ComponentName, "Sorter_GroupPhoto", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
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

//Show Method @2-AD5EDF71
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_DesignName"] = CCGetFromGet("s_DesignName", NULL);
        $this->DataSource->Parameters["urls_GroupDescription"] = CCGetFromGet("s_GroupDescription", NULL);

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
            $this->ControlsVisible["GroupCode"] = $this->GroupCode->Visible;
            $this->ControlsVisible["DesignName"] = $this->DesignName->Visible;
            $this->ControlsVisible["GroupDescription"] = $this->GroupDescription->Visible;
            $this->ControlsVisible["ClientCode"] = $this->ClientCode->Visible;
            $this->ControlsVisible["ClientDesc"] = $this->ClientDesc->Visible;
            $this->ControlsVisible["GroupPhoto"] = $this->GroupPhoto->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->GroupCode->SetValue($this->DataSource->GroupCode->GetValue());
                $this->GroupCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->GroupCode->Parameters = CCAddParam($this->GroupCode->Parameters, "Group_H_ID", $this->DataSource->f("Group_H_ID"));
                $this->DesignName->SetValue($this->DataSource->DesignName->GetValue());
                $this->GroupDescription->SetValue($this->DataSource->GroupDescription->GetValue());
                $this->ClientCode->SetValue($this->DataSource->ClientCode->GetValue());
                $this->ClientDesc->SetValue($this->DataSource->ClientDesc->GetValue());
                $this->GroupPhoto->SetValue($this->DataSource->GroupPhoto->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->GroupCode->Show();
                $this->DesignName->Show();
                $this->GroupDescription->Show();
                $this->ClientCode->Show();
                $this->ClientDesc->Show();
                $this->GroupPhoto->Show();
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
        $this->tblcollect_design_tblcoll1_TotalRecords->Show();
        $this->Sorter_GroupCode->Show();
        $this->Sorter_DesignName->Show();
        $this->Sorter_GroupDescription->Show();
        $this->Sorter_ClientCode->Show();
        $this->Sorter_ClientDesc->Show();
        $this->Sorter_GroupPhoto->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E997D7D6
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->GroupCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignName->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GroupDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClientDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->GroupPhoto->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End Grid Class @2-FCB6E20C

class clsGridDataSource extends clsDBGayaFusionAll {  //GridDataSource Class @2-7708C172

//DataSource Variables @2-D7DA63AE
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $GroupCode;
    public $DesignName;
    public $GroupDescription;
    public $ClientCode;
    public $ClientDesc;
    public $GroupPhoto;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F1D3AD79
    function clsGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid Grid";
        $this->Initialize();
        $this->GroupCode = new clsField("GroupCode", ccsText, "");
        
        $this->DesignName = new clsField("DesignName", ccsText, "");
        
        $this->GroupDescription = new clsField("GroupDescription", ccsText, "");
        
        $this->ClientCode = new clsField("ClientCode", ccsText, "");
        
        $this->ClientDesc = new clsField("ClientDesc", ccsText, "");
        
        $this->GroupPhoto = new clsField("GroupPhoto", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-4D7B4F1A
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "Group_H_ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_GroupCode" => array("GroupCode", ""), 
            "Sorter_DesignName" => array("DesignName", ""), 
            "Sorter_GroupDescription" => array("GroupDescription", ""), 
            "Sorter_ClientCode" => array("ClientCode", ""), 
            "Sorter_ClientDesc" => array("ClientDesc", ""), 
            "Sorter_GroupPhoto" => array("GroupPhoto", "")));
    }
//End SetOrder Method

//Prepare Method @2-416650CA
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_DesignName", ccsText, "", "", $this->Parameters["urls_DesignName"], "", false);
        $this->wp->AddParameter("2", "urls_GroupDescription", ccsText, "", "", $this->Parameters["urls_GroupDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tblcollect_design.DesignName", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tblcollect_group_h.GroupDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-E2727DC6
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblcollect_group_h INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_group_h.DesignCode = tblcollect_design.DesignCode";
        $this->SQL = "SELECT tblcollect_group_h.*, DesignName \n\n" .
        "FROM tblcollect_group_h INNER JOIN tblcollect_design ON\n\n" .
        "tblcollect_group_h.DesignCode = tblcollect_design.DesignCode {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DC3A248A
    function SetValues()
    {
        $this->GroupCode->SetDBValue($this->f("GroupCode"));
        $this->DesignName->SetDBValue($this->f("DesignName"));
        $this->GroupDescription->SetDBValue($this->f("GroupDescription"));
        $this->ClientCode->SetDBValue($this->f("ClientCode"));
        $this->ClientDesc->SetDBValue($this->f("ClientDesc"));
        $this->GroupPhoto->SetDBValue($this->f("GroupPhoto"));
    }
//End SetValues Method

} //End GridDataSource Class @2-FCB6E20C







//Initialize Page @1-C917AC4C
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
$TemplateFileName = "CollectionGroup.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-3AA66383
include_once("./CollectionGroup_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D2FF37AB
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Search = & $Search;
$MainPage->Grid = & $Grid;
$Panel1->AddComponent("Search", $Search);
$Panel1->AddComponent("Grid", $Grid);
$Grid->Initialize();

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

//Go to destination page @1-7EE673AE
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Grid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-781C4DC6
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-D2DCB2C5
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Grid);
unset($Tpl);
//End Unload Page


?>
