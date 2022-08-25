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

//Include Common Files @1-28BABDBD
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Estruder.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblestruderSearch { //tblestruderSearch Class @3-E1301EC8

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

//Class_Initialize Event @3-66B6BD6D
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

//Validate Method @3-FDBF0ABF
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

//CheckErrors Method @3-A1D4AC01
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_EstruderCode->Errors->Count());
        $errors = ($errors || $this->s_EstruderDescription->Errors->Count());
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

//Operation Method @3-3BD35CCF
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
        $Redirect = "Estruder.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Estruder.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-BFF8F8CB
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

} //End tblestruderSearch Class @3-FCB6E20C

class clsGridtblestruder { //tblestruder class @2-4879F8E7

//Variables @2-B5F8F20C

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
//End Variables

//Class_Initialize Event @2-C1B520A7
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

        $this->EstruderCode = new clsControl(ccsLink, "EstruderCode", "EstruderCode", ccsText, "", CCGetRequestParam("EstruderCode", ccsGet, NULL), $this);
        $this->EstruderCode->Page = "Estruder.php";
        $this->EstruderDescription = new clsControl(ccsLabel, "EstruderDescription", "EstruderDescription", ccsText, "", CCGetRequestParam("EstruderDescription", ccsGet, NULL), $this);
        $this->EstruderPhoto1 = new clsControl(ccsImage, "EstruderPhoto1", "EstruderPhoto1", ccsText, "", CCGetRequestParam("EstruderPhoto1", ccsGet, NULL), $this);
        $this->show = new clsControl(ccsLink, "show", "show", ccsText, "", CCGetRequestParam("show", ccsGet, NULL), $this);
        $this->show->Page = "ShowEstruder.php";
        $this->edit = new clsControl(ccsLink, "edit", "edit", ccsText, "", CCGetRequestParam("edit", ccsGet, NULL), $this);
        $this->edit->Page = "EditEstruder.php";
        $this->tblestruder_TotalRecords = new clsControl(ccsLabel, "tblestruder_TotalRecords", "tblestruder_TotalRecords", ccsText, "", CCGetRequestParam("tblestruder_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_EstruderCode = new clsSorter($this->ComponentName, "Sorter_EstruderCode", $FileName, $this);
        $this->Sorter_EstruderDescription = new clsSorter($this->ComponentName, "Sorter_EstruderDescription", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ID", "EstruderCode", "ccsForm"));
        $this->Link1->Page = "Estruder.php";
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

//Show Method @2-2CE1B00D
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
            $this->ControlsVisible["show"] = $this->show->Visible;
            $this->ControlsVisible["edit"] = $this->edit->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->EstruderCode->SetValue($this->DataSource->EstruderCode->GetValue());
                $this->EstruderCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->EstruderCode->Parameters = CCAddParam($this->EstruderCode->Parameters, "ID", $this->DataSource->f("ID"));
                $this->EstruderDescription->SetValue($this->DataSource->EstruderDescription->GetValue());
                $this->EstruderPhoto1->SetValue($this->DataSource->EstruderPhoto1->GetValue());
                $this->show->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->show->Parameters = CCAddParam($this->show->Parameters, "ID", $this->DataSource->f("ID"));
                $this->show->Parameters = CCAddParam($this->show->Parameters, "EstruderCode", $this->DataSource->f("EstruderCode"));
                $this->edit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->edit->Parameters = CCAddParam($this->edit->Parameters, "ID", $this->DataSource->f("ID"));
                $this->edit->Parameters = CCAddParam($this->edit->Parameters, "EstruderCode", $this->DataSource->f("EstruderCode"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->EstruderCode->Show();
                $this->EstruderDescription->Show();
                $this->EstruderPhoto1->Show();
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
        $this->tblestruder_TotalRecords->Show();
        $this->Sorter_EstruderCode->Show();
        $this->Sorter_EstruderDescription->Show();
        $this->Navigator->Show();
        $this->Link1->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-7DF99F5E
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->EstruderCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->EstruderPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->show->Errors->ToString());
        $errors = ComposeStrings($errors, $this->edit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblestruder Class @2-FCB6E20C

class clstblestruderDataSource extends clsDBGayaFusionAll {  //tblestruderDataSource Class @2-A80CA00D

//DataSource Variables @2-A8B503D9
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
//End DataSource Variables

//DataSourceClass_Initialize Event @2-AE614371
    function clstblestruderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblestruder";
        $this->Initialize();
        $this->EstruderCode = new clsField("EstruderCode", ccsText, "");
        
        $this->EstruderDescription = new clsField("EstruderDescription", ccsText, "");
        
        $this->EstruderPhoto1 = new clsField("EstruderPhoto1", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-131E3BA7
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_EstruderCode" => array("EstruderCode", ""), 
            "Sorter_EstruderDescription" => array("EstruderDescription", "")));
    }
//End SetOrder Method

//Prepare Method @2-0E825B4E
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

//Open Method @2-1E16B38D
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

//SetValues Method @2-6859A2F7
    function SetValues()
    {
        $this->EstruderCode->SetDBValue($this->f("EstruderCode"));
        $this->EstruderDescription->SetDBValue($this->f("EstruderDescription"));
        $this->EstruderPhoto1->SetDBValue($this->f("EstruderPhoto1"));
    }
//End SetValues Method

} //End tblestruderDataSource Class @2-FCB6E20C

class clsRecordtblestruder1 { //tblestruder1 Class @24-4CB49ED9

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

//Class_Initialize Event @24-B524644E
    function clsRecordtblestruder1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblestruder1/Error";
        $this->DataSource = new clstblestruder1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblestruder1";
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
            $this->EstruderCode = new clsControl(ccsTextBox, "EstruderCode", "Estruder Code", ccsText, "", CCGetRequestParam("EstruderCode", $Method, NULL), $this);
            $this->EstruderCode->Required = true;
            $this->EstruderDescription = new clsControl(ccsTextBox, "EstruderDescription", "Estruder Description", ccsText, "", CCGetRequestParam("EstruderDescription", $Method, NULL), $this);
            $this->EstruderDescription->Required = true;
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

//Validate Method @24-FF9AD254
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->EstruderCode->Validate() && $Validation);
        $Validation = ($this->EstruderDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->EstruderCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->EstruderDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @24-321DB59D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->EstruderCode->Errors->Count());
        $errors = ($errors || $this->EstruderDescription->Errors->Count());
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

//InsertRow Method @24-8195FEB4
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->EstruderCode->SetValue($this->EstruderCode->GetValue(true));
        $this->DataSource->EstruderDescription->SetValue($this->EstruderDescription->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @24-F15A83E8
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->EstruderCode->SetValue($this->EstruderCode->GetValue(true));
        $this->DataSource->EstruderDescription->SetValue($this->EstruderDescription->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @24-5E62D0D2
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
                    $this->EstruderCode->SetValue($this->DataSource->EstruderCode->GetValue());
                    $this->EstruderDescription->SetValue($this->DataSource->EstruderDescription->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->EstruderCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderDescription->Errors->ToString());
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
        $this->EstruderCode->Show();
        $this->EstruderDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblestruder1 Class @24-FCB6E20C

class clstblestruder1DataSource extends clsDBGayaFusionAll {  //tblestruder1DataSource Class @24-E21F3416

//DataSource Variables @24-E38D81FD
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
    public $EstruderCode;
    public $EstruderDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @24-8135B25F
    function clstblestruder1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblestruder1/Error";
        $this->Initialize();
        $this->EstruderCode = new clsField("EstruderCode", ccsText, "");
        
        $this->EstruderDescription = new clsField("EstruderDescription", ccsText, "");
        

        $this->InsertFields["EstruderCode"] = array("Name" => "EstruderCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["EstruderDescription"] = array("Name" => "EstruderDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderCode"] = array("Name" => "EstruderCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["EstruderDescription"] = array("Name" => "EstruderDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
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

//Open Method @24-FB36456E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblestruder {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @24-1945B804
    function SetValues()
    {
        $this->EstruderCode->SetDBValue($this->f("EstruderCode"));
        $this->EstruderDescription->SetDBValue($this->f("EstruderDescription"));
    }
//End SetValues Method

//Insert Method @24-7DCD8B40
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["EstruderCode"]["Value"] = $this->EstruderCode->GetDBValue(true);
        $this->InsertFields["EstruderDescription"]["Value"] = $this->EstruderDescription->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblestruder", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @24-4FDE4B44
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["EstruderCode"]["Value"] = $this->EstruderCode->GetDBValue(true);
        $this->UpdateFields["EstruderDescription"]["Value"] = $this->EstruderDescription->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblestruder", $this->UpdateFields, $this);
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

} //End tblestruder1DataSource Class @24-FCB6E20C

//Initialize Page @1-E53907E1
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
$TemplateFileName = "Estruder.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-02A7A5DE
include_once("./Estruder_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-8F5F2C87
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$tblestruderSearch = new clsRecordtblestruderSearch("", $MainPage);
$tblestruder = new clsGridtblestruder("", $MainPage);
$tblestruder1 = new clsRecordtblestruder1("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->tblestruderSearch = & $tblestruderSearch;
$MainPage->tblestruder = & $tblestruder;
$MainPage->tblestruder1 = & $tblestruder1;
$Panel1->AddComponent("tblestruderSearch", $tblestruderSearch);
$Panel1->AddComponent("tblestruder", $tblestruder);
$Panel1->AddComponent("tblestruder1", $tblestruder1);
$tblestruder->Initialize();
$tblestruder1->Initialize();

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

//Execute Components @1-CBB8B568
$tblestruderSearch->Operation();
$tblestruder1->Operation();
//End Execute Components

//Go to destination page @1-3E2D8A77
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblestruderSearch);
    unset($tblestruder);
    unset($tblestruder1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-19A44438
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-E7A16A16
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblestruderSearch);
unset($tblestruder);
unset($tblestruder1);
unset($Tpl);
//End Unload Page


?>
