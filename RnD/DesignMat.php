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
//Include Common Files @1-CD669A87
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DesignMat.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbldesignmat_tblsupplier { //tbldesignmat_tblsupplier Class @11-5545D347

//Variables @11-9E315808

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

//Class_Initialize Event @11-CECDA0C3
    function clsRecordtbldesignmat_tblsupplier($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbldesignmat_tblsupplier/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbldesignmat_tblsupplier";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_DesignMatCode = new clsControl(ccsTextBox, "s_DesignMatCode", "s_DesignMatCode", ccsText, "", CCGetRequestParam("s_DesignMatCode", $Method, NULL), $this);
            $this->s_DesignMatDescription = new clsControl(ccsTextBox, "s_DesignMatDescription", "s_DesignMatDescription", ccsText, "", CCGetRequestParam("s_DesignMatDescription", $Method, NULL), $this);
            $this->s_SupCompany = new clsControl(ccsTextBox, "s_SupCompany", "s_SupCompany", ccsText, "", CCGetRequestParam("s_SupCompany", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @11-DF97773F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_DesignMatCode->Validate() && $Validation);
        $Validation = ($this->s_DesignMatDescription->Validate() && $Validation);
        $Validation = ($this->s_SupCompany->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_DesignMatCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_DesignMatDescription->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SupCompany->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @11-18C57004
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_DesignMatCode->Errors->Count());
        $errors = ($errors || $this->s_DesignMatDescription->Errors->Count());
        $errors = ($errors || $this->s_SupCompany->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @11-ED598703
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

//Operation Method @11-BAE2F536
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
        $Redirect = "DesignMat.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "DesignMat.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @11-551A6E57
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
            $Error = ComposeStrings($Error, $this->s_DesignMatCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_DesignMatDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SupCompany->Errors->ToString());
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
        $this->s_DesignMatCode->Show();
        $this->s_DesignMatDescription->Show();
        $this->s_SupCompany->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tbldesignmat_tblsupplier Class @11-FCB6E20C

class clsGridtbldesignmatGrid { //tbldesignmatGrid class @2-647398B7

//Variables @2-9D525C8A

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
    public $Sorter_DesignMatCode;
    public $Sorter_DesignMatDescription;
    public $Sorter_SupCompany;
//End Variables

//Class_Initialize Event @2-21846FAB
    function clsGridtbldesignmatGrid($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tbldesignmatGrid";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tbldesignmatGrid";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstbldesignmatGridDataSource($this);
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
        $this->SorterName = CCGetParam("tbldesignmatGridOrder", "");
        $this->SorterDirection = CCGetParam("tbldesignmatGridDir", "");

        $this->DesignMatCode = new clsControl(ccsLink, "DesignMatCode", "DesignMatCode", ccsText, "", CCGetRequestParam("DesignMatCode", ccsGet, NULL), $this);
        $this->DesignMatCode->Page = "DesignMat.php";
        $this->DesignMatDescription = new clsControl(ccsLabel, "DesignMatDescription", "DesignMatDescription", ccsText, "", CCGetRequestParam("DesignMatDescription", ccsGet, NULL), $this);
        $this->DesignMatPhoto1 = new clsControl(ccsImage, "DesignMatPhoto1", "DesignMatPhoto1", ccsText, "", CCGetRequestParam("DesignMatPhoto1", ccsGet, NULL), $this);
        $this->SupCompany = new clsControl(ccsHidden, "SupCompany", "SupCompany", ccsText, "", CCGetRequestParam("SupCompany", ccsGet, NULL), $this);
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "ShowDesignMat.php";
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "EditDesignMat.php";
        $this->SupDesc = new clsControl(ccsLabel, "SupDesc", "SupDesc", ccsText, "", CCGetRequestParam("SupDesc", ccsGet, NULL), $this);
        $this->tbldesignmat_tblsupplier1_TotalRecords = new clsControl(ccsLabel, "tbldesignmat_tblsupplier1_TotalRecords", "tbldesignmat_tblsupplier1_TotalRecords", ccsText, "", CCGetRequestParam("tbldesignmat_tblsupplier1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_DesignMatCode = new clsSorter($this->ComponentName, "Sorter_DesignMatCode", $FileName, $this);
        $this->Sorter_DesignMatDescription = new clsSorter($this->ComponentName, "Sorter_DesignMatDescription", $FileName, $this);
        $this->Sorter_SupCompany = new clsSorter($this->ComponentName, "Sorter_SupCompany", $FileName, $this);
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

//Show Method @2-2E2110C8
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_DesignMatCode"] = CCGetFromGet("s_DesignMatCode", NULL);
        $this->DataSource->Parameters["urls_DesignMatDescription"] = CCGetFromGet("s_DesignMatDescription", NULL);

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
            $this->ControlsVisible["DesignMatCode"] = $this->DesignMatCode->Visible;
            $this->ControlsVisible["DesignMatDescription"] = $this->DesignMatDescription->Visible;
            $this->ControlsVisible["DesignMatPhoto1"] = $this->DesignMatPhoto1->Visible;
            $this->ControlsVisible["SupCompany"] = $this->SupCompany->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["Link2"] = $this->Link2->Visible;
            $this->ControlsVisible["SupDesc"] = $this->SupDesc->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DesignMatCode->SetValue($this->DataSource->DesignMatCode->GetValue());
                $this->DesignMatCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->DesignMatCode->Parameters = CCAddParam($this->DesignMatCode->Parameters, "DesignMatID", $this->DataSource->f("DesignMatID"));
                $this->DesignMatDescription->SetValue($this->DataSource->DesignMatDescription->GetValue());
                $this->DesignMatPhoto1->SetValue($this->DataSource->DesignMatPhoto1->GetValue());
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "DesignMatID", $this->DataSource->f("DesignMatID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "DesignMatCode", $this->DataSource->f("DesignMatCode"));
                $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "DesignMatID", $this->DataSource->f("DesignMatID"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "DesignMatCode", $this->DataSource->f("DesignMatCode"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DesignMatCode->Show();
                $this->DesignMatDescription->Show();
                $this->DesignMatPhoto1->Show();
                $this->SupCompany->Show();
                $this->Link1->Show();
                $this->Link2->Show();
                $this->SupDesc->Show();
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
        $this->tbldesignmat_tblsupplier1_TotalRecords->Show();
        $this->Sorter_DesignMatCode->Show();
        $this->Sorter_DesignMatDescription->Show();
        $this->Sorter_SupCompany->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-FB538B68
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DesignMatCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupDesc->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tbldesignmatGrid Class @2-FCB6E20C

class clstbldesignmatGridDataSource extends clsDBGayaFusionAll {  //tbldesignmatGridDataSource Class @2-08B37D5B

//DataSource Variables @2-D7F15935
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $DesignMatCode;
    public $DesignMatDescription;
    public $DesignMatPhoto1;
    public $SupCompany;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-EA4D9802
    function clstbldesignmatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbldesignmatGrid";
        $this->Initialize();
        $this->DesignMatCode = new clsField("DesignMatCode", ccsText, "");
        
        $this->DesignMatDescription = new clsField("DesignMatDescription", ccsText, "");
        
        $this->DesignMatPhoto1 = new clsField("DesignMatPhoto1", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-851D552C
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "DesignMatID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_DesignMatCode" => array("DesignMatCode", ""), 
            "Sorter_DesignMatDescription" => array("DesignMatDescription", ""), 
            "Sorter_SupCompany" => array("SupCompany", "")));
    }
//End SetOrder Method

//Prepare Method @2-FF4BB75C
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_DesignMatCode", ccsText, "", "", $this->Parameters["urls_DesignMatCode"], "", false);
        $this->wp->AddParameter("2", "urls_DesignMatDescription", ccsText, "", "", $this->Parameters["urls_DesignMatDescription"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "DesignMatCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "DesignMatDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-E2F47A6B
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tbldesignmat";
        $this->SQL = "SELECT DesignMatID, DesignMatCode, DesignMatDescription, DesignMatPhoto1, DesignMatSupplier \n\n" .
        "FROM tbldesignmat {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-DACE8F10
    function SetValues()
    {
        $this->DesignMatCode->SetDBValue($this->f("DesignMatCode"));
        $this->DesignMatDescription->SetDBValue($this->f("DesignMatDescription"));
        $this->DesignMatPhoto1->SetDBValue($this->f("DesignMatPhoto1"));
        $this->SupCompany->SetDBValue($this->f("DesignMatSupplier"));
    }
//End SetValues Method

} //End tbldesignmatGridDataSource Class @2-FCB6E20C



class clsRecordtbldesignmat { //tbldesignmat Class @33-41C43A86

//Variables @33-9E315808

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

//Class_Initialize Event @33-2D76A980
    function clsRecordtbldesignmat($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbldesignmat/Error";
        $this->DataSource = new clstbldesignmatDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->DeleteAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbldesignmat";
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
            $this->Button_Delete = new clsButton("Button_Delete", $Method, $this);
            $this->DesignMatCode = new clsControl(ccsTextBox, "DesignMatCode", "Design Mat Code", ccsText, "", CCGetRequestParam("DesignMatCode", $Method, NULL), $this);
            $this->DesignMatCode->Required = true;
            $this->DesignMatDescription = new clsControl(ccsTextBox, "DesignMatDescription", "Design Mat Description", ccsText, "", CCGetRequestParam("DesignMatDescription", $Method, NULL), $this);
            $this->DesignMatDescription->Required = true;
        }
    }
//End Class_Initialize Event

//Initialize Method @33-721BCFDE
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlDesignMatID"] = CCGetFromGet("DesignMatID", NULL);
    }
//End Initialize Method

//Validate Method @33-C9B92909
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->DesignMatCode->Validate() && $Validation);
        $Validation = ($this->DesignMatDescription->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->DesignMatCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignMatDescription->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @33-EEE137E2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->DesignMatCode->Errors->Count());
        $errors = ($errors || $this->DesignMatDescription->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @33-ED598703
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

//Operation Method @33-B908BA44
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
            } else if($this->Button_Delete->Pressed) {
                $this->PressedButton = "Button_Delete";
            }
        }
        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->PressedButton == "Button_Delete") {
            if(!CCGetEvent($this->Button_Delete->CCSEvents, "OnClick", $this->Button_Delete) || !$this->DeleteRow()) {
                $Redirect = "";
            }
        } else if($this->Validate()) {
            if($this->PressedButton == "Button_Insert") {
                if(!CCGetEvent($this->Button_Insert->CCSEvents, "OnClick", $this->Button_Insert) || !$this->InsertRow()) {
                    $Redirect = "";
                }
            } else if($this->PressedButton == "Button_Update") {
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

//InsertRow Method @33-CEB00486
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->DesignMatCode->SetValue($this->DesignMatCode->GetValue(true));
        $this->DataSource->DesignMatDescription->SetValue($this->DesignMatDescription->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @33-AFD52E37
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->DesignMatCode->SetValue($this->DesignMatCode->GetValue(true));
        $this->DataSource->DesignMatDescription->SetValue($this->DesignMatDescription->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//DeleteRow Method @33-299D98C3
    function DeleteRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeDelete", $this);
        if(!$this->DeleteAllowed) return false;
        $this->DataSource->Delete();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterDelete", $this);
        return (!$this->CheckErrors());
    }
//End DeleteRow Method

//Show Method @33-2552925C
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
                    $this->DesignMatCode->SetValue($this->DataSource->DesignMatCode->GetValue());
                    $this->DesignMatDescription->SetValue($this->DataSource->DesignMatDescription->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->DesignMatCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignMatDescription->Errors->ToString());
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
        $this->Button_Delete->Visible = $this->EditMode && $this->DeleteAllowed;

        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShow", $this);
        $this->Attributes->Show();
        if(!$this->Visible) {
            $Tpl->block_path = $ParentPath;
            return;
        }

        $this->Button_Insert->Show();
        $this->Button_Update->Show();
        $this->Button_Delete->Show();
        $this->DesignMatCode->Show();
        $this->DesignMatDescription->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbldesignmat Class @33-FCB6E20C

class clstbldesignmatDataSource extends clsDBGayaFusionAll {  //tbldesignmatDataSource Class @33-AC733C40

//DataSource Variables @33-ACFF9A0D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $InsertParameters;
    public $UpdateParameters;
    public $DeleteParameters;
    public $wp;
    public $AllParametersSet;

    public $InsertFields = array();
    public $UpdateFields = array();

    // Datasource fields
    public $DesignMatCode;
    public $DesignMatDescription;
//End DataSource Variables

//DataSourceClass_Initialize Event @33-2E8929ED
    function clstbldesignmatDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbldesignmat/Error";
        $this->Initialize();
        $this->DesignMatCode = new clsField("DesignMatCode", ccsText, "");
        
        $this->DesignMatDescription = new clsField("DesignMatDescription", ccsText, "");
        

        $this->InsertFields["DesignMatCode"] = array("Name" => "DesignMatCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignMatDescription"] = array("Name" => "DesignMatDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatCode"] = array("Name" => "DesignMatCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignMatDescription"] = array("Name" => "DesignMatDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @33-4D8F5B6A
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlDesignMatID", ccsText, "", "", $this->Parameters["urlDesignMatID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "DesignMatID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @33-E003B0A3
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbldesignmat {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @33-B0B96EAF
    function SetValues()
    {
        $this->DesignMatCode->SetDBValue($this->f("DesignMatCode"));
        $this->DesignMatDescription->SetDBValue($this->f("DesignMatDescription"));
    }
//End SetValues Method

//Insert Method @33-70CC6058
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["DesignMatCode"]["Value"] = $this->DesignMatCode->GetDBValue(true);
        $this->InsertFields["DesignMatDescription"]["Value"] = $this->DesignMatDescription->GetDBValue(true);
        $this->SQL = CCBuildInsert("tbldesignmat", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @33-1CCAA783
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["DesignMatCode"]["Value"] = $this->DesignMatCode->GetDBValue(true);
        $this->UpdateFields["DesignMatDescription"]["Value"] = $this->DesignMatDescription->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tbldesignmat", $this->UpdateFields, $this);
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

//Delete Method @33-B8430B11
    function Delete()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildDelete", $this->Parent);
        $this->SQL = "DELETE FROM tbldesignmat";
        $this->SQL = CCBuildSQL($this->SQL, $this->Where, "");
        if (!strlen($this->Where) && $this->Errors->Count() == 0) 
            $this->Errors->addError($CCSLocales->GetText("CCS_CustomOperationError_MissingParameters"));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteDelete", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteDelete", $this->Parent);
        }
    }
//End Delete Method

} //End tbldesignmatDataSource Class @33-FCB6E20C

//Initialize Page @1-F249BBDB
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
$TemplateFileName = "DesignMat.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-B647651B
include_once("./DesignMat_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-22D58232
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$tbldesignmat_tblsupplier = new clsRecordtbldesignmat_tblsupplier("", $MainPage);
$tbldesignmatGrid = new clsGridtbldesignmatGrid("", $MainPage);
$tbldesignmat = new clsRecordtbldesignmat("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->tbldesignmat_tblsupplier = & $tbldesignmat_tblsupplier;
$MainPage->tbldesignmatGrid = & $tbldesignmatGrid;
$MainPage->tbldesignmat = & $tbldesignmat;
$Panel1->AddComponent("tbldesignmat_tblsupplier", $tbldesignmat_tblsupplier);
$Panel1->AddComponent("tbldesignmatGrid", $tbldesignmatGrid);
$Panel1->AddComponent("tbldesignmat", $tbldesignmat);
$tbldesignmatGrid->Initialize();
$tbldesignmat->Initialize();

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

//Execute Components @1-5DB116B9
$tbldesignmat_tblsupplier->Operation();
$tbldesignmat->Operation();
//End Execute Components

//Go to destination page @1-E4C4FC67
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbldesignmat_tblsupplier);
    unset($tbldesignmatGrid);
    unset($tbldesignmat);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-451376DE
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5C900C3D
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbldesignmat_tblsupplier);
unset($tbldesignmatGrid);
unset($tbldesignmat);
unset($Tpl);
//End Unload Page


?>
