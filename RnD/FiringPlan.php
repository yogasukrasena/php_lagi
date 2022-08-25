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

//Include Common Files @1-F4B46ABB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "FiringPlan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblfiringplanSearch { //tblfiringplanSearch Class @3-713DA0E6

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

//Class_Initialize Event @3-91D00C84
    function clsRecordtblfiringplanSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblfiringplanSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblfiringplanSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_FiringPlanCode = new clsControl(ccsTextBox, "s_FiringPlanCode", "s_FiringPlanCode", ccsText, "", CCGetRequestParam("s_FiringPlanCode", $Method, NULL), $this);
            $this->s_FiringPlanDescription = new clsControl(ccsTextBox, "s_FiringPlanDescription", "s_FiringPlanDescription", ccsText, "", CCGetRequestParam("s_FiringPlanDescription", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-6368120F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_FiringPlanCode->Validate() && $Validation);
        $Validation = ($this->s_FiringPlanDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_FiringPlanCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_FiringPlanDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-573FA63E
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_FiringPlanCode->Errors->Count());
        $errors = ($errors || $this->s_FiringPlanDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
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

//Operation Method @3-4B5F30A8
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
        $Redirect = "FiringPlan.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "FiringPlan.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-6ABD798A
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
            $Error = ComposeStrings($Error, $this->s_FiringPlanCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_FiringPlanDescription->Errors->ToString());
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
        $this->s_FiringPlanCode->Show();
        $this->s_FiringPlanDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblfiringplanSearch Class @3-FCB6E20C

class clsGridtblfiringplan { //tblfiringplan class @2-CEB62CAB

//Variables @2-5457F6DC

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
    public $Sorter_FiringPlanCode;
    public $Sorter_FiringPlanDescription;
//End Variables

//Class_Initialize Event @2-9AAB81D5
    function clsGridtblfiringplan($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblfiringplan";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblfiringplan";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblfiringplanDataSource($this);
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
        $this->SorterName = CCGetParam("tblfiringplanOrder", "");
        $this->SorterDirection = CCGetParam("tblfiringplanDir", "");

        $this->FiringPlanCode = new clsControl(ccsLink, "FiringPlanCode", "FiringPlanCode", ccsText, "", CCGetRequestParam("FiringPlanCode", ccsGet, NULL), $this);
        $this->FiringPlanCode->Page = "FiringPlan.php";
        $this->FiringPlanDescription = new clsControl(ccsLabel, "FiringPlanDescription", "FiringPlanDescription", ccsText, "", CCGetRequestParam("FiringPlanDescription", ccsGet, NULL), $this);
        $this->FiringPlanPhoto1 = new clsControl(ccsImage, "FiringPlanPhoto1", "FiringPlanPhoto1", ccsText, "", CCGetRequestParam("FiringPlanPhoto1", ccsGet, NULL), $this);
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "ShowFiringPlan.php";
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "EditFiringPlan.php";
        $this->tblfiringplan_TotalRecords = new clsControl(ccsLabel, "tblfiringplan_TotalRecords", "tblfiringplan_TotalRecords", ccsText, "", CCGetRequestParam("tblfiringplan_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_FiringPlanCode = new clsSorter($this->ComponentName, "Sorter_FiringPlanCode", $FileName, $this);
        $this->Sorter_FiringPlanDescription = new clsSorter($this->ComponentName, "Sorter_FiringPlanDescription", $FileName, $this);
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

//Show Method @2-430D16A1
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_FiringPlanCode"] = CCGetFromGet("s_FiringPlanCode", NULL);
        $this->DataSource->Parameters["urls_FiringPlanDescription"] = CCGetFromGet("s_FiringPlanDescription", NULL);

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
            $this->ControlsVisible["FiringPlanCode"] = $this->FiringPlanCode->Visible;
            $this->ControlsVisible["FiringPlanDescription"] = $this->FiringPlanDescription->Visible;
            $this->ControlsVisible["FiringPlanPhoto1"] = $this->FiringPlanPhoto1->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["Link2"] = $this->Link2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->FiringPlanCode->SetValue($this->DataSource->FiringPlanCode->GetValue());
                $this->FiringPlanCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->FiringPlanCode->Parameters = CCAddParam($this->FiringPlanCode->Parameters, "ID", $this->DataSource->f("ID"));
                $this->FiringPlanDescription->SetValue($this->DataSource->FiringPlanDescription->GetValue());
                $this->FiringPlanPhoto1->SetValue($this->DataSource->FiringPlanPhoto1->GetValue());
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "FiringPlanCode", $this->DataSource->f("FiringPlanCode"));
                $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "FiringPlanCode", $this->DataSource->f("FiringPlanCode"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->FiringPlanCode->Show();
                $this->FiringPlanDescription->Show();
                $this->FiringPlanPhoto1->Show();
                $this->Link1->Show();
                $this->Link2->Show();
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
        $this->tblfiringplan_TotalRecords->Show();
        $this->Sorter_FiringPlanCode->Show();
        $this->Sorter_FiringPlanDescription->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-E5E505F3
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->FiringPlanCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FiringPlanDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->FiringPlanPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblfiringplan Class @2-FCB6E20C

class clstblfiringplanDataSource extends clsDBGayaFusionAll {  //tblfiringplanDataSource Class @2-50D90770

//DataSource Variables @2-9A0F4534
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $FiringPlanCode;
    public $FiringPlanDescription;
    public $FiringPlanPhoto1;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3D0CEB96
    function clstblfiringplanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblfiringplan";
        $this->Initialize();
        $this->FiringPlanCode = new clsField("FiringPlanCode", ccsText, "");
        
        $this->FiringPlanDescription = new clsField("FiringPlanDescription", ccsText, "");
        
        $this->FiringPlanPhoto1 = new clsField("FiringPlanPhoto1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-0C648DBA
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_FiringPlanCode" => array("FiringPlanCode", ""), 
            "Sorter_FiringPlanDescription" => array("FiringPlanDescription", "")));
    }
//End SetOrder Method

//Prepare Method @2-776845F5
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_FiringPlanCode", ccsText, "", "", $this->Parameters["urls_FiringPlanCode"], "", false);
        $this->wp->AddParameter("2", "urls_FiringPlanDescription", ccsText, "", "", $this->Parameters["urls_FiringPlanDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "FiringPlanCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "FiringPlanDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-7DF8A349
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblfiringplan";
        $this->SQL = "SELECT ID, FiringPlanCode, FiringPlanDescription, FiringPlanPhoto1 \n\n" .
        "FROM tblfiringplan {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-85AF7B2F
    function SetValues()
    {
        $this->FiringPlanCode->SetDBValue($this->f("FiringPlanCode"));
        $this->FiringPlanDescription->SetDBValue($this->f("FiringPlanDescription"));
        $this->FiringPlanPhoto1->SetDBValue($this->f("FiringPlanPhoto1"));
    }
//End SetValues Method

} //End tblfiringplanDataSource Class @2-FCB6E20C

class clsRecordtblfiringplan1 { //tblfiringplan1 Class @24-5240301E

//Variables @24-9E315808

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

//Class_Initialize Event @24-8EBB0A33
    function clsRecordtblfiringplan1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblfiringplan1/Error";
        $this->DataSource = new clstblfiringplan1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblfiringplan1";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_Insert = new clsButton("Button_Insert", $Method, $this);
            $this->Button_Update = new clsButton("Button_Update", $Method, $this);
            $this->FiringPlanCode = new clsControl(ccsTextBox, "FiringPlanCode", "Firing Plan Code", ccsText, "", CCGetRequestParam("FiringPlanCode", $Method, NULL), $this);
            $this->FiringPlanCode->Required = true;
            $this->FiringPlanDescription = new clsControl(ccsTextBox, "FiringPlanDescription", "Firing Plan Description", ccsText, "", CCGetRequestParam("FiringPlanDescription", $Method, NULL), $this);
            $this->FiringPlanDescription->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @24-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @24-6A5F4A4C
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->FiringPlanCode->Validate() && $Validation);
        $Validation = ($this->FiringPlanDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->FiringPlanCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->FiringPlanDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-7C8A9502
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->FiringPlanCode->Errors->Count());
        $errors = ($errors || $this->FiringPlanDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @24-ED598703
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

//Operation Method @24-95C2302C
    function Operation()
    {
        if(!$this->Visible)
            return;

        global $Redirect;
        global $FileName;

        $this->DataSource->Prepare();
        if(!$this->FormSubmitted) {
            $this->EditMode = $this->DataSource->AllParametersSet;
            return;
        }

        if($this->FormSubmitted) {
            $this->PressedButton = $this->EditMode ? "Button_Update" : "Button_Insert";
            if($this->Button_Insert->Pressed) {
                $this->PressedButton = "Button_Insert";
            } else if($this->Button_Update->Pressed) {
                $this->PressedButton = "Button_Update";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID"));
                if(!CCGetEvent($this->Button_Update->CCSEvents, "OnClick", $this->Button_Update) || !$this->UpdateRow()) {
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

//InsertRow Method @24-A5647353
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->FiringPlanCode->SetValue($this->FiringPlanCode->GetValue(true));
        $this->DataSource->FiringPlanDescription->SetValue($this->FiringPlanDescription->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-B7BF8CA3
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->FiringPlanCode->SetValue($this->FiringPlanCode->GetValue(true));
        $this->DataSource->FiringPlanDescription->SetValue($this->FiringPlanDescription->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @24-528AAFCE
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
                if(!$this->FormSubmitted){
                    $this->FiringPlanCode->SetValue($this->DataSource->FiringPlanCode->GetValue());
                    $this->FiringPlanDescription->SetValue($this->DataSource->FiringPlanDescription->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->FiringPlanCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanDescription->Errors->ToString());
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
        $this->Button_Insert->Visible = !$this->EditMode && $this->InsertAllowed;
        $this->Button_Update->Visible = $this->EditMode && $this->UpdateAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->FiringPlanCode->Show();
        $this->FiringPlanDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblfiringplan1 Class @24-FCB6E20C

class clstblfiringplan1DataSource extends clsDBGayaFusionAll {  //tblfiringplan1DataSource Class @24-CC53EC30

//DataSource Variables @24-A018F98A
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $FiringPlanCode;
    public $FiringPlanDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-F630A074
    function clstblfiringplan1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblfiringplan1/Error";
        $this->Initialize();
        $this->FiringPlanCode = new clsField("FiringPlanCode", ccsText, "");
        
        $this->FiringPlanDescription = new clsField("FiringPlanDescription", ccsText, "");
        

        $this->InsertFields["FiringPlanCode"] = array("Name" => "FiringPlanCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["FiringPlanDescription"] = array("Name" => "FiringPlanDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanCode"] = array("Name" => "FiringPlanCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["FiringPlanDescription"] = array("Name" => "FiringPlanDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @24-C6736E1B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlID", ccsInteger, "", "", $this->Parameters["urlID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @24-BDF5EB4A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblfiringplan {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-CFBD6C3F
    function SetValues()
    {
        $this->FiringPlanCode->SetDBValue($this->f("FiringPlanCode"));
        $this->FiringPlanDescription->SetDBValue($this->f("FiringPlanDescription"));
    }
//End SetValues Method

//Insert Method @24-9F817F12
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["FiringPlanCode"]["Value"] = $this->FiringPlanCode->GetDBValue(true);
        $this->InsertFields["FiringPlanDescription"]["Value"] = $this->FiringPlanDescription->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblfiringplan", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-53917A54
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["FiringPlanCode"]["Value"] = $this->FiringPlanCode->GetDBValue(true);
        $this->UpdateFields["FiringPlanDescription"]["Value"] = $this->FiringPlanDescription->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblfiringplan", $this->UpdateFields, $this);
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteUpdate", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteUpdate", $this->Parent);
        }
    }
//End Update Method

} //End tblfiringplan1DataSource Class @24-FCB6E20C

//Initialize Page @1-CA487AEA
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
$TemplateFileName = "FiringPlan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-4C58FBEB
include_once("./FiringPlan_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-A4B8AF08
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$tblfiringplanSearch = new clsRecordtblfiringplanSearch("", $MainPage);
$tblfiringplan = new clsGridtblfiringplan("", $MainPage);
$tblfiringplan1 = new clsRecordtblfiringplan1("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->tblfiringplanSearch = & $tblfiringplanSearch;
$MainPage->tblfiringplan = & $tblfiringplan;
$MainPage->tblfiringplan1 = & $tblfiringplan1;
$Panel1->AddComponent("tblfiringplanSearch", $tblfiringplanSearch);
$Panel1->AddComponent("tblfiringplan", $tblfiringplan);
$Panel1->AddComponent("tblfiringplan1", $tblfiringplan1);
$tblfiringplan->Initialize();
$tblfiringplan1->Initialize();

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

//Execute Components @1-6215C67A
$tblfiringplanSearch->Operation();
$tblfiringplan1->Operation();
//End Execute Components

//Go to destination page @1-767EABF2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblfiringplanSearch);
    unset($tblfiringplan);
    unset($tblfiringplan1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0DA191A6
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5BC27518
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblfiringplanSearch);
unset($tblfiringplan);
unset($tblfiringplan1);
unset($Tpl);
//End Unload Page


?>
