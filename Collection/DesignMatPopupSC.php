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

//Include Common Files @1-4BFF55ED
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "DesignMatPopupSC.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbldesignmat_tblsupplier { //tbldesignmat_tblsupplier Class @2-5545D347

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

//Class_Initialize Event @2-CECDA0C3
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

//Validate Method @2-DF97773F
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

//CheckErrors Method @2-18C57004
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

//Operation Method @2-9715F9A7
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
        $Redirect = "DesignMatPopupSC.php" . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "DesignMatPopupSC.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")), CCGetQueryString("QueryString", array("s_DesignMatCode", "s_DesignMatDescription", "s_SupCompany", "ccsForm")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @2-551A6E57
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

} //End tbldesignmat_tblsupplier Class @2-FCB6E20C

class clsGridtbldesignmatGrid { //tbldesignmatGrid class @7-647398B7

//Variables @7-9D525C8A

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

//Class_Initialize Event @7-01392A03
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

        $this->DesignMatCode = new clsControl(ccsLabel, "DesignMatCode", "DesignMatCode", ccsText, "", CCGetRequestParam("DesignMatCode", ccsGet, NULL), $this);
        $this->DesignMatPhoto1 = new clsControl(ccsImage, "DesignMatPhoto1", "DesignMatPhoto1", ccsText, "", CCGetRequestParam("DesignMatPhoto1", ccsGet, NULL), $this);
        $this->DesignMatID = new clsControl(ccsHidden, "DesignMatID", "DesignMatID", ccsText, "", CCGetRequestParam("DesignMatID", ccsGet, NULL), $this);
        $this->UnitValue = new clsControl(ccsHidden, "UnitValue", "UnitValue", ccsText, "", CCGetRequestParam("UnitValue", ccsGet, NULL), $this);
        $this->UnitPrice = new clsControl(ccsHidden, "UnitPrice", "UnitPrice", ccsText, "", CCGetRequestParam("UnitPrice", ccsGet, NULL), $this);
        $this->DesignMatDescription = new clsControl(ccsLink, "DesignMatDescription", "DesignMatDescription", ccsText, "", CCGetRequestParam("DesignMatDescription", ccsGet, NULL), $this);
        $this->DesignMatDescription->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->DesignMatDescription->Page = "";
        $this->SupCompany = new clsControl(ccsLabel, "SupCompany", "SupCompany", ccsText, "", CCGetRequestParam("SupCompany", ccsGet, NULL), $this);
        $this->tbldesignmat_tblsupplier1_TotalRecords = new clsControl(ccsLabel, "tbldesignmat_tblsupplier1_TotalRecords", "tbldesignmat_tblsupplier1_TotalRecords", ccsText, "", CCGetRequestParam("tbldesignmat_tblsupplier1_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_DesignMatCode = new clsSorter($this->ComponentName, "Sorter_DesignMatCode", $FileName, $this);
        $this->Sorter_DesignMatDescription = new clsSorter($this->ComponentName, "Sorter_DesignMatDescription", $FileName, $this);
        $this->Sorter_SupCompany = new clsSorter($this->ComponentName, "Sorter_SupCompany", $FileName, $this);
        $this->Navigator = new clsNavigator($this->ComponentName, "Navigator", $FileName, 10, tpCentered, $this);
        $this->Navigator->PageSizes = array("1", "5", "10", "25", "50");
    }
//End Class_Initialize Event

//Initialize Method @7-90E704C5
    function Initialize()
    {
        if(!$this->Visible) return;

        $this->DataSource->PageSize = & $this->PageSize;
        $this->DataSource->AbsolutePage = & $this->PageNumber;
        $this->DataSource->SetOrder($this->SorterName, $this->SorterDirection);
    }
//End Initialize Method

//Show Method @7-49AEB9F3
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_DesignMatCode"] = CCGetFromGet("s_DesignMatCode", NULL);
        $this->DataSource->Parameters["urls_DesignMatDescription"] = CCGetFromGet("s_DesignMatDescription", NULL);
        $this->DataSource->Parameters["urls_SupCompany"] = CCGetFromGet("s_SupCompany", NULL);

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
            $this->ControlsVisible["DesignMatPhoto1"] = $this->DesignMatPhoto1->Visible;
            $this->ControlsVisible["DesignMatID"] = $this->DesignMatID->Visible;
            $this->ControlsVisible["UnitValue"] = $this->UnitValue->Visible;
            $this->ControlsVisible["UnitPrice"] = $this->UnitPrice->Visible;
            $this->ControlsVisible["DesignMatDescription"] = $this->DesignMatDescription->Visible;
            $this->ControlsVisible["SupCompany"] = $this->SupCompany->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->DesignMatCode->SetValue($this->DataSource->DesignMatCode->GetValue());
                $this->DesignMatPhoto1->SetValue($this->DataSource->DesignMatPhoto1->GetValue());
                $this->DesignMatID->SetValue($this->DataSource->DesignMatID->GetValue());
                $this->UnitValue->SetValue($this->DataSource->UnitValue->GetValue());
                $this->UnitPrice->SetValue($this->DataSource->UnitPrice->GetValue());
                $this->DesignMatDescription->SetValue($this->DataSource->DesignMatDescription->GetValue());
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->DesignMatCode->Show();
                $this->DesignMatPhoto1->Show();
                $this->DesignMatID->Show();
                $this->UnitValue->Show();
                $this->UnitPrice->Show();
                $this->DesignMatDescription->Show();
                $this->SupCompany->Show();
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

//GetErrors Method @7-93D05E9F
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->DesignMatCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatPhoto1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatID->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitValue->Errors->ToString());
        $errors = ComposeStrings($errors, $this->UnitPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesignMatDescription->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tbldesignmatGrid Class @7-FCB6E20C

class clstbldesignmatGridDataSource extends clsDBGayaFusionAll {  //tbldesignmatGridDataSource Class @7-08B37D5B

//DataSource Variables @7-3D60CE6D
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $DesignMatCode;
    public $DesignMatPhoto1;
    public $DesignMatID;
    public $UnitValue;
    public $UnitPrice;
    public $DesignMatDescription;
    public $SupCompany;
//End DataSource Variables

//DataSourceClass_Initialize Event @7-E6DBCDDD
    function clstbldesignmatGridDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tbldesignmatGrid";
        $this->Initialize();
        $this->DesignMatCode = new clsField("DesignMatCode", ccsText, "");
        
        $this->DesignMatPhoto1 = new clsField("DesignMatPhoto1", ccsText, "");
        
        $this->DesignMatID = new clsField("DesignMatID", ccsText, "");
        
        $this->UnitValue = new clsField("UnitValue", ccsText, "");
        
        $this->UnitPrice = new clsField("UnitPrice", ccsText, "");
        
        $this->DesignMatDescription = new clsField("DesignMatDescription", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @7-3C1FBBF2
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "tbldesignmat.DesignMatID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_DesignMatCode" => array("DesignMatCode", ""), 
            "Sorter_DesignMatDescription" => array("DesignMatDescription", ""), 
            "Sorter_SupCompany" => array("SupCompany", "")));
    }
//End SetOrder Method

//Prepare Method @7-AC8939CB
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_DesignMatCode", ccsText, "", "", $this->Parameters["urls_DesignMatCode"], "", false);
        $this->wp->AddParameter("2", "urls_DesignMatDescription", ccsText, "", "", $this->Parameters["urls_DesignMatDescription"], "", false);
        $this->wp->AddParameter("3", "urls_SupCompany", ccsText, "", "", $this->Parameters["urls_SupCompany"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "tbldesignmat.DesignMatCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "tbldesignmat.DesignMatDescription", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "tblsupplier.SupCompany", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @7-F8DA3A6D
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM (tbldesignmat LEFT JOIN tblsupplier ON\n\n" .
        "tbldesignmat.DesignMatSupplier = tblsupplier.ID) INNER JOIN tblunit ON\n\n" .
        "tbldesignmat.DesignMatUnit = tblunit.UnitID";
        $this->SQL = "SELECT SupCompany, DesignMatID, DesignMatCode, DesignMatDescription, DesignMatPhoto1, DesignMatUnitPrice, UnitValue \n\n" .
        "FROM (tbldesignmat LEFT JOIN tblsupplier ON\n\n" .
        "tbldesignmat.DesignMatSupplier = tblsupplier.ID) INNER JOIN tblunit ON\n\n" .
        "tbldesignmat.DesignMatUnit = tblunit.UnitID {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @7-5B07B53F
    function SetValues()
    {
        $this->DesignMatCode->SetDBValue($this->f("DesignMatCode"));
        $this->DesignMatPhoto1->SetDBValue($this->f("DesignMatPhoto1"));
        $this->DesignMatID->SetDBValue($this->f("DesignMatID"));
        $this->UnitValue->SetDBValue($this->f("UnitValue"));
        $this->UnitPrice->SetDBValue($this->f("DesignMatUnitPrice"));
        $this->DesignMatDescription->SetDBValue($this->f("DesignMatDescription"));
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
    }
//End SetValues Method

} //End tbldesignmatGridDataSource Class @7-FCB6E20C

//Initialize Page @1-6A0959C6
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
$TemplateFileName = "DesignMatPopupSC.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-2B579902
include_once("./DesignMatPopupSC_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9F995563
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbldesignmat_tblsupplier = new clsRecordtbldesignmat_tblsupplier("", $MainPage);
$tbldesignmatGrid = new clsGridtbldesignmatGrid("", $MainPage);
$MainPage->tbldesignmat_tblsupplier = & $tbldesignmat_tblsupplier;
$MainPage->tbldesignmatGrid = & $tbldesignmatGrid;
$tbldesignmatGrid->Initialize();

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

//Execute Components @1-68B9CFB2
$tbldesignmat_tblsupplier->Operation();
//End Execute Components

//Go to destination page @1-A03E11EA
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbldesignmat_tblsupplier);
    unset($tbldesignmatGrid);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-915C520B
$tbldesignmat_tblsupplier->Show();
$tbldesignmatGrid->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-2C6A205E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbldesignmat_tblsupplier);
unset($tbldesignmatGrid);
unset($Tpl);
//End Unload Page


?>
