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

//Include Common Files @1-1B8E230E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Clay.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblclaySearch { //tblclaySearch Class @3-F3DD5016

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

//Class_Initialize Event @3-583A7AEE
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

//Validate Method @3-C198B2B1
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

//CheckErrors Method @3-2ED80500
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_ClayCode->Errors->Count());
        $errors = ($errors || $this->s_ClayDescription->Errors->Count());
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

//Operation Method @3-86DDF5BE
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
        $Redirect = "Clay.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Clay.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-C7FC8909
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

} //End tblclaySearch Class @3-FCB6E20C

class clsGridtblclay { //tblclay class @2-65E1A89A

//Variables @2-AAE9295F

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

//Class_Initialize Event @2-1A3D5C71
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

        $this->ClayCode = new clsControl(ccsLink, "ClayCode", "ClayCode", ccsText, "", CCGetRequestParam("ClayCode", ccsGet, NULL), $this);
        $this->ClayCode->Page = "Clay.php";
        $this->ClayDescription = new clsControl(ccsLabel, "ClayDescription", "ClayDescription", ccsText, "", CCGetRequestParam("ClayDescription", ccsGet, NULL), $this);
        $this->ClayPhoto1 = new clsControl(ccsImage, "ClayPhoto1", "ClayPhoto1", ccsText, "", CCGetRequestParam("ClayPhoto1", ccsGet, NULL), $this);
        $this->show = new clsControl(ccsLink, "show", "show", ccsText, "", CCGetRequestParam("show", ccsGet, NULL), $this);
        $this->show->Page = "ShowClay.php";
        $this->edit = new clsControl(ccsLink, "edit", "edit", ccsText, "", CCGetRequestParam("edit", ccsGet, NULL), $this);
        $this->edit->Page = "EditClay.php";
        $this->tblclay_TotalRecords = new clsControl(ccsLabel, "tblclay_TotalRecords", "tblclay_TotalRecords", ccsText, "", CCGetRequestParam("tblclay_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_ClayCode = new clsSorter($this->ComponentName, "Sorter_ClayCode", $FileName, $this);
        $this->Sorter_ClayDescription = new clsSorter($this->ComponentName, "Sorter_ClayDescription", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ID", "ClayCode", "ccsForm"));
        $this->Link1->Page = "Clay.php";
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

//Show Method @2-57EB4625
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
            $this->ControlsVisible["show"] = $this->show->Visible;
            $this->ControlsVisible["edit"] = $this->edit->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->ClayCode->SetValue($this->DataSource->ClayCode->GetValue());
                $this->ClayCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->ClayCode->Parameters = CCAddParam($this->ClayCode->Parameters, "ID", $this->DataSource->f("ID"));
                $this->ClayDescription->SetValue($this->DataSource->ClayDescription->GetValue());
                $this->ClayPhoto1->SetValue($this->DataSource->ClayPhoto1->GetValue());
                $this->show->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->show->Parameters = CCAddParam($this->show->Parameters, "ClayCode", $this->DataSource->f("ClayCode"));
                $this->show->Parameters = CCAddParam($this->show->Parameters, "ID", $this->DataSource->f("ID"));
                $this->edit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->edit->Parameters = CCAddParam($this->edit->Parameters, "ID", $this->DataSource->f("ID"));
                $this->edit->Parameters = CCAddParam($this->edit->Parameters, "ClayCode", $this->DataSource->f("ClayCode"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->ClayCode->Show();
                $this->ClayDescription->Show();
                $this->ClayPhoto1->Show();
                $this->show->Show();
                $this->edit->Show();
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
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-82BB394B
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->ClayCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->ClayPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->show->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblclay Class @2-FCB6E20C

class clstblclayDataSource extends clsDBGayaFusionAll {  //tblclayDataSource Class @2-232BD427

//DataSource Variables @2-40A47A38
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-7BE97EAD
    function clstblclayDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblclay";
        $this->Initialize();
        $this->ClayCode = new clsField("ClayCode", ccsText, "");
        
        $this->ClayDescription = new clsField("ClayDescription", ccsText, "");
        
        $this->ClayPhoto1 = new clsField("ClayPhoto1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-90319816
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_ClayCode" => array("ClayCode", ""), 
            "Sorter_ClayDescription" => array("ClayDescription", "")));
    }
//End SetOrder Method

//Prepare Method @2-7129842E
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

//Open Method @2-DEAA6583
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

//SetValues Method @2-9843516C
    function SetValues()
    {
        $this->ClayCode->SetDBValue($this->f("ClayCode"));
        $this->ClayDescription->SetDBValue($this->f("ClayDescription"));
        $this->ClayPhoto1->SetDBValue($this->f("ClayPhoto1"));
    }
//End SetValues Method

} //End tblclayDataSource Class @2-FCB6E20C



class clsRecordtblclay1 { //tblclay1 Class @24-3F9EDD36

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

//Class_Initialize Event @24-DC3FE8B7
    function clsRecordtblclay1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblclay1/Error";
        $this->DataSource = new clstblclay1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblclay1";
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
            $this->ClayCode = new clsControl(ccsTextBox, "ClayCode", "Clay Code", ccsText, "", CCGetRequestParam("ClayCode", $Method, NULL), $this);
            $this->ClayCode->Required = true;
            $this->ClayDescription = new clsControl(ccsTextBox, "ClayDescription", "Clay Description", ccsText, "", CCGetRequestParam("ClayDescription", $Method, NULL), $this);
            $this->ClayDescription->Required = true;
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

//Validate Method @24-B3736D23
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->ClayCode->Validate() && $Validation);
        $Validation = ($this->ClayDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->ClayCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->ClayDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-09AE31AD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ClayCode->Errors->Count());
        $errors = ($errors || $this->ClayDescription->Errors->Count());
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

//Operation Method @24-DDE43E69
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
                $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm", "ID", "ClayCode"));
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

//InsertRow Method @24-3D00A62A
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->ClayCode->SetValue($this->ClayCode->GetValue(true));
        $this->DataSource->ClayDescription->SetValue($this->ClayDescription->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-E46ED428
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->ClayCode->SetValue($this->ClayCode->GetValue(true));
        $this->DataSource->ClayDescription->SetValue($this->ClayDescription->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @24-2949DA4C
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
                    $this->ClayCode->SetValue($this->DataSource->ClayCode->GetValue());
                    $this->ClayDescription->SetValue($this->DataSource->ClayDescription->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ClayCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDescription->Errors->ToString());
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
        $this->ClayCode->Show();
        $this->ClayDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblclay1 Class @24-FCB6E20C

class clstblclay1DataSource extends clsDBGayaFusionAll {  //tblclay1DataSource Class @24-392FDAB4

//DataSource Variables @24-E438BC1C
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
    public $ClayCode;
    public $ClayDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-DF7919A5
    function clstblclay1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblclay1/Error";
        $this->Initialize();
        $this->ClayCode = new clsField("ClayCode", ccsText, "");
        
        $this->ClayDescription = new clsField("ClayDescription", ccsText, "");
        

        $this->InsertFields["ClayCode"] = array("Name" => "ClayCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["ClayDescription"] = array("Name" => "ClayDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayCode"] = array("Name" => "ClayCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["ClayDescription"] = array("Name" => "ClayDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @24-A8669435
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblclay {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-05BCC0B3
    function SetValues()
    {
        $this->ClayCode->SetDBValue($this->f("ClayCode"));
        $this->ClayDescription->SetDBValue($this->f("ClayDescription"));
    }
//End SetValues Method

//Insert Method @24-F92A0DB0
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["ClayCode"]["Value"] = $this->ClayCode->GetDBValue(true);
        $this->InsertFields["ClayDescription"]["Value"] = $this->ClayDescription->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblclay", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-EE23E8B6
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["ClayCode"]["Value"] = $this->ClayCode->GetDBValue(true);
        $this->UpdateFields["ClayDescription"]["Value"] = $this->ClayDescription->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblclay", $this->UpdateFields, $this);
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

} //End tblclay1DataSource Class @24-FCB6E20C

//Initialize Page @1-E743B4E2
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
$TemplateFileName = "Clay.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-567C37EE
include_once("./Clay_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-4DCDE5F9
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$tblclaySearch = new clsRecordtblclaySearch("", $MainPage);
$tblclay = new clsGridtblclay("", $MainPage);
$tblclay1 = new clsRecordtblclay1("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->tblclaySearch = & $tblclaySearch;
$MainPage->tblclay = & $tblclay;
$MainPage->tblclay1 = & $tblclay1;
$Panel1->AddComponent("tblclaySearch", $tblclaySearch);
$Panel1->AddComponent("tblclay", $tblclay);
$Panel1->AddComponent("tblclay1", $tblclay1);
$tblclay->Initialize();
$tblclay1->Initialize();

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

//Execute Components @1-B2DC306F
$tblclaySearch->Operation();
$tblclay1->Operation();
//End Execute Components

//Go to destination page @1-5C0DFDFC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblclaySearch);
    unset($tblclay);
    unset($tblclay1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F7D86B9D
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-1B8C6206
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblclaySearch);
unset($tblclay);
unset($tblclay1);
unset($Tpl);
//End Unload Page


?>
