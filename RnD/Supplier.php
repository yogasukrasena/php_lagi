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
//Include Common Files @1-5DDE31EB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "Supplier.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblsupplierSearch { //tblsupplierSearch Class @3-73AD9B34

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

//Class_Initialize Event @3-85FDAD8F
    function clsRecordtblsupplierSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblsupplierSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblsupplierSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_SupCode = new clsControl(ccsTextBox, "s_SupCode", "s_SupCode", ccsText, "", CCGetRequestParam("s_SupCode", $Method, NULL), $this);
            $this->s_SupCompany = new clsControl(ccsTextBox, "s_SupCompany", "s_SupCompany", ccsText, "", CCGetRequestParam("s_SupCompany", $Method, NULL), $this);
            $this->s_SupItems = new clsControl(ccsTextBox, "s_SupItems", "s_SupItems", ccsText, "", CCGetRequestParam("s_SupItems", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-1DB02E7E
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_SupCode->Validate() && $Validation);
        $Validation = ($this->s_SupCompany->Validate() && $Validation);
        $Validation = ($this->s_SupItems->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_SupCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SupCompany->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_SupItems->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-EC725C8B
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_SupCode->Errors->Count());
        $errors = ($errors || $this->s_SupCompany->Errors->Count());
        $errors = ($errors || $this->s_SupItems->Errors->Count());
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

//Operation Method @3-69A1072F
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
        $Redirect = "Supplier.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "Supplier.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-9FAEF72A
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
            $Error = ComposeStrings($Error, $this->s_SupCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SupCompany->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_SupItems->Errors->ToString());
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
        $this->s_SupCode->Show();
        $this->s_SupCompany->Show();
        $this->s_SupItems->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End tblsupplierSearch Class @3-FCB6E20C

class clsGridtblsupplier { //tblsupplier class @2-77D162AD

//Variables @2-6D1FA45A

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
    public $Sorter_SupCode;
    public $Sorter_SupCompany;
    public $Sorter_SupContact;
    public $Sorter_SupItems;
    public $Sorter_SupHP;
    public $Sorter_SupOffice;
//End Variables

//Class_Initialize Event @2-7B824302
    function clsGridtblsupplier($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "tblsupplier";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid tblsupplier";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clstblsupplierDataSource($this);
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
        $this->SorterName = CCGetParam("tblsupplierOrder", "");
        $this->SorterDirection = CCGetParam("tblsupplierDir", "");

        $this->SupCode = new clsControl(ccsLink, "SupCode", "SupCode", ccsText, "", CCGetRequestParam("SupCode", ccsGet, NULL), $this);
        $this->SupCode->Page = "Supplier.php";
        $this->SupCompany = new clsControl(ccsLabel, "SupCompany", "SupCompany", ccsText, "", CCGetRequestParam("SupCompany", ccsGet, NULL), $this);
        $this->SupContact = new clsControl(ccsLabel, "SupContact", "SupContact", ccsText, "", CCGetRequestParam("SupContact", ccsGet, NULL), $this);
        $this->SupItems = new clsControl(ccsLabel, "SupItems", "SupItems", ccsText, "", CCGetRequestParam("SupItems", ccsGet, NULL), $this);
        $this->SupHP = new clsControl(ccsLabel, "SupHP", "SupHP", ccsText, "", CCGetRequestParam("SupHP", ccsGet, NULL), $this);
        $this->SupOffice = new clsControl(ccsLabel, "SupOffice", "SupOffice", ccsText, "", CCGetRequestParam("SupOffice", ccsGet, NULL), $this);
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "ShowSupplier.php";
        $this->Link2 = new clsControl(ccsLink, "Link2", "Link2", ccsText, "", CCGetRequestParam("Link2", ccsGet, NULL), $this);
        $this->Link2->Page = "EditSupplier.php";
        $this->tblsupplier_TotalRecords = new clsControl(ccsLabel, "tblsupplier_TotalRecords", "tblsupplier_TotalRecords", ccsText, "", CCGetRequestParam("tblsupplier_TotalRecords", ccsGet, NULL), $this);
        $this->Sorter_SupCode = new clsSorter($this->ComponentName, "Sorter_SupCode", $FileName, $this);
        $this->Sorter_SupCompany = new clsSorter($this->ComponentName, "Sorter_SupCompany", $FileName, $this);
        $this->Sorter_SupContact = new clsSorter($this->ComponentName, "Sorter_SupContact", $FileName, $this);
        $this->Sorter_SupItems = new clsSorter($this->ComponentName, "Sorter_SupItems", $FileName, $this);
        $this->Sorter_SupHP = new clsSorter($this->ComponentName, "Sorter_SupHP", $FileName, $this);
        $this->Sorter_SupOffice = new clsSorter($this->ComponentName, "Sorter_SupOffice", $FileName, $this);
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

//Show Method @2-81B13BAE
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_SupCode"] = CCGetFromGet("s_SupCode", NULL);
        $this->DataSource->Parameters["urls_SupCompany"] = CCGetFromGet("s_SupCompany", NULL);
        $this->DataSource->Parameters["urls_SupItems"] = CCGetFromGet("s_SupItems", NULL);

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
            $this->ControlsVisible["SupCode"] = $this->SupCode->Visible;
            $this->ControlsVisible["SupCompany"] = $this->SupCompany->Visible;
            $this->ControlsVisible["SupContact"] = $this->SupContact->Visible;
            $this->ControlsVisible["SupItems"] = $this->SupItems->Visible;
            $this->ControlsVisible["SupHP"] = $this->SupHP->Visible;
            $this->ControlsVisible["SupOffice"] = $this->SupOffice->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["Link2"] = $this->Link2->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                $this->SupCode->SetValue($this->DataSource->SupCode->GetValue());
                $this->SupCode->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->SupCode->Parameters = CCAddParam($this->SupCode->Parameters, "ID", $this->DataSource->f("ID"));
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                $this->SupContact->SetValue($this->DataSource->SupContact->GetValue());
                $this->SupItems->SetValue($this->DataSource->SupItems->GetValue());
                $this->SupHP->SetValue($this->DataSource->SupHP->GetValue());
                $this->SupOffice->SetValue($this->DataSource->SupOffice->GetValue());
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "SupCode", $this->DataSource->f("SupCode"));
                $this->Link2->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Link2->Parameters = CCAddParam($this->Link2->Parameters, "SupCode", $this->DataSource->f("SupCode"));
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SupCode->Show();
                $this->SupCompany->Show();
                $this->SupContact->Show();
                $this->SupItems->Show();
                $this->SupHP->Show();
                $this->SupOffice->Show();
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
        $this->tblsupplier_TotalRecords->Show();
        $this->Sorter_SupCode->Show();
        $this->Sorter_SupCompany->Show();
        $this->Sorter_SupContact->Show();
        $this->Sorter_SupItems->Show();
        $this->Sorter_SupHP->Show();
        $this->Sorter_SupOffice->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-9FBF04BB
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SupCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupCompany->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupContact->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupItems->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupHP->Errors->ToString());
        $errors = ComposeStrings($errors, $this->SupOffice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End tblsupplier Class @2-FCB6E20C

class clstblsupplierDataSource extends clsDBGayaFusionAll {  //tblsupplierDataSource Class @2-A709D700

//DataSource Variables @2-A67E0797
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SupCode;
    public $SupCompany;
    public $SupContact;
    public $SupItems;
    public $SupHP;
    public $SupOffice;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-424280F7
    function clstblsupplierDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid tblsupplier";
        $this->Initialize();
        $this->SupCode = new clsField("SupCode", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        
        $this->SupContact = new clsField("SupContact", ccsText, "");
        
        $this->SupItems = new clsField("SupItems", ccsText, "");
        
        $this->SupHP = new clsField("SupHP", ccsText, "");
        
        $this->SupOffice = new clsField("SupOffice", ccsText, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-7FE1E548
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SupCode" => array("SupCode", ""), 
            "Sorter_SupCompany" => array("SupCompany", ""), 
            "Sorter_SupContact" => array("SupContact", ""), 
            "Sorter_SupItems" => array("SupItems", ""), 
            "Sorter_SupHP" => array("SupHP", ""), 
            "Sorter_SupOffice" => array("SupOffice", "")));
    }
//End SetOrder Method

//Prepare Method @2-BB0E625B
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_SupCode", ccsText, "", "", $this->Parameters["urls_SupCode"], "", false);
        $this->wp->AddParameter("2", "urls_SupCompany", ccsText, "", "", $this->Parameters["urls_SupCompany"], "", false);
        $this->wp->AddParameter("3", "urls_SupItems", ccsText, "", "", $this->Parameters["urls_SupItems"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "SupCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "SupCompany", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->wp->Criterion[3] = $this->wp->Operation(opContains, "SupItems", $this->wp->GetDBValue("3"), $this->ToSQL($this->wp->GetDBValue("3"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]), 
             $this->wp->Criterion[3]);
    }
//End Prepare Method

//Open Method @2-C4574ECC
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM tblsupplier";
        $this->SQL = "SELECT ID, SupCode, SupCompany, SupContact, SupItems, SupHP, SupOffice \n\n" .
        "FROM tblsupplier {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D88E6DBB
    function SetValues()
    {
        $this->SupCode->SetDBValue($this->f("SupCode"));
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
        $this->SupContact->SetDBValue($this->f("SupContact"));
        $this->SupItems->SetDBValue($this->f("SupItems"));
        $this->SupHP->SetDBValue($this->f("SupHP"));
        $this->SupOffice->SetDBValue($this->f("SupOffice"));
    }
//End SetValues Method

} //End tblsupplierDataSource Class @2-FCB6E20C



class clsRecordtblsupplier1 { //tblsupplier1 Class @35-DA829ECD

//Variables @35-9E315808

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

//Class_Initialize Event @35-B7BDBD70
    function clsRecordtblsupplier1($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblsupplier1/Error";
        $this->DataSource = new clstblsupplier1DataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblsupplier1";
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
            $this->SupCode = new clsControl(ccsTextBox, "SupCode", "Sup Code", ccsText, "", CCGetRequestParam("SupCode", $Method, NULL), $this);
            $this->SupCode->Required = true;
            $this->SupCompany = new clsControl(ccsTextBox, "SupCompany", "Sup Company", ccsText, "", CCGetRequestParam("SupCompany", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @35-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @35-64A0100F
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->SupCode->Validate() && $Validation);
        $Validation = ($this->SupCompany->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->SupCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->SupCompany->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @35-A6F91077
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SupCode->Errors->Count());
        $errors = ($errors || $this->SupCompany->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @35-ED598703
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

//Operation Method @35-95C2302C
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

//InsertRow Method @35-FD68D7D3
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->SupCode->SetValue($this->SupCode->GetValue(true));
        $this->DataSource->SupCompany->SetValue($this->SupCompany->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @35-F66ED56B
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->SupCode->SetValue($this->SupCode->GetValue(true));
        $this->DataSource->SupCompany->SetValue($this->SupCompany->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @35-DFE42E02
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
                    $this->SupCode->SetValue($this->DataSource->SupCode->GetValue());
                    $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SupCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupCompany->Errors->ToString());
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
        $this->SupCode->Show();
        $this->SupCompany->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblsupplier1 Class @35-FCB6E20C

class clstblsupplier1DataSource extends clsDBGayaFusionAll {  //tblsupplier1DataSource Class @35-9CA14DDC

//DataSource Variables @35-5A596A3C
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
    public $SupCode;
    public $SupCompany;
//End DataSource Variables

//DataSourceClass_Initialize Event @35-114A5D1F
    function clstblsupplier1DataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblsupplier1/Error";
        $this->Initialize();
        $this->SupCode = new clsField("SupCode", ccsText, "");
        
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        

        $this->InsertFields["SupCode"] = array("Name" => "SupCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["SupCompany"] = array("Name" => "SupCompany", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupCode"] = array("Name" => "SupCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["SupCompany"] = array("Name" => "SupCompany", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @35-C6736E1B
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

//Open Method @35-799C8DB1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblsupplier {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @35-63077D45
    function SetValues()
    {
        $this->SupCode->SetDBValue($this->f("SupCode"));
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
    }
//End SetValues Method

//Insert Method @35-E7D05D25
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["SupCode"]["Value"] = $this->SupCode->GetDBValue(true);
        $this->InsertFields["SupCompany"]["Value"] = $this->SupCompany->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblsupplier", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @35-A0A2ABFC
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["SupCode"]["Value"] = $this->SupCode->GetDBValue(true);
        $this->UpdateFields["SupCompany"]["Value"] = $this->SupCompany->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblsupplier", $this->UpdateFields, $this);
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

} //End tblsupplier1DataSource Class @35-FCB6E20C

//Initialize Page @1-D3B89618
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
$TemplateFileName = "Supplier.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-D1DBBA96
include_once("./Supplier_events.php");
//End Include events file

//BeforeInitialize Binding @1-17AC9191
$CCSEvents["BeforeInitialize"] = "Page_BeforeInitialize";
//End BeforeInitialize Binding

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-9ECA468A
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$tblsupplierSearch = new clsRecordtblsupplierSearch("", $MainPage);
$tblsupplier = new clsGridtblsupplier("", $MainPage);
$tblsupplier1 = new clsRecordtblsupplier1("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->tblsupplierSearch = & $tblsupplierSearch;
$MainPage->tblsupplier = & $tblsupplier;
$MainPage->tblsupplier1 = & $tblsupplier1;
$Panel1->AddComponent("tblsupplierSearch", $tblsupplierSearch);
$Panel1->AddComponent("tblsupplier", $tblsupplier);
$Panel1->AddComponent("tblsupplier1", $tblsupplier1);
$tblsupplier->Initialize();
$tblsupplier1->Initialize();

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

//Execute Components @1-FFDA84D0
$tblsupplierSearch->Operation();
$tblsupplier1->Operation();
//End Execute Components

//Go to destination page @1-7FFE2E0A
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblsupplierSearch);
    unset($tblsupplier);
    unset($tblsupplier1);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B088955D
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-390AB022
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblsupplierSearch);
unset($tblsupplier);
unset($tblsupplier1);
unset($Tpl);
//End Unload Page


?>
