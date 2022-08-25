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

//Class_Initialize Event @2-ECFC532E
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
        $this->GroupCode->Page = "CollectionGroup.php";
        $this->DesignName = new clsControl(ccsLabel, "DesignName", "DesignName", ccsText, "", CCGetRequestParam("DesignName", ccsGet, NULL), $this);
        $this->GroupDescription = new clsControl(ccsLabel, "GroupDescription", "GroupDescription", ccsText, "", CCGetRequestParam("GroupDescription", ccsGet, NULL), $this);
        $this->ClientCode = new clsControl(ccsLabel, "ClientCode", "ClientCode", ccsText, "", CCGetRequestParam("ClientCode", ccsGet, NULL), $this);
        $this->ClientDesc = new clsControl(ccsLabel, "ClientDesc", "ClientDesc", ccsText, "", CCGetRequestParam("ClientDesc", ccsGet, NULL), $this);
        $this->GroupPhoto = new clsControl(ccsImage, "GroupPhoto", "GroupPhoto", ccsText, "", CCGetRequestParam("GroupPhoto", ccsGet, NULL), $this);
        $this->tblcollect_design_tblcoll1_Insert = new clsControl(ccsLink, "tblcollect_design_tblcoll1_Insert", "tblcollect_design_tblcoll1_Insert", ccsText, "", CCGetRequestParam("tblcollect_design_tblcoll1_Insert", ccsGet, NULL), $this);
        $this->tblcollect_design_tblcoll1_Insert->Parameters = CCGetQueryString("QueryString", array("Group_H_ID", "IsParamsEncoded", "FormFilter", "ccsForm"));
        $this->tblcollect_design_tblcoll1_Insert->Page = "CollectionGroup.php";
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

//Show Method @2-6B970831
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
        $this->tblcollect_design_tblcoll1_Insert->Show();
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

class clsRecordAddNew { //AddNew Class @31-B93F975A

//Variables @31-9E315808

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

//Class_Initialize Event @31-B7DA5018
    function clsRecordAddNew($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record AddNew/Error";
        $this->DataSource = new clsAddNewDataSource($this);
        $this->ds = & $this->DataSource;
        $this->InsertAllowed = true;
        $this->UpdateAllowed = true;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "AddNew";
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
            $this->GroupCode = new clsControl(ccsTextBox, "GroupCode", "Group Code", ccsText, "", CCGetRequestParam("GroupCode", $Method, NULL), $this);
            $this->GroupCode->Required = true;
            $this->GroupDescription = new clsControl(ccsTextBox, "GroupDescription", "Group Description", ccsText, "", CCGetRequestParam("GroupDescription", $Method, NULL), $this);
            $this->Edit = new clsPanel("Edit", $this);
            $this->LinkEdit = new clsControl(ccsLink, "LinkEdit", "LinkEdit", ccsText, "", CCGetRequestParam("LinkEdit", $Method, NULL), $this);
            $this->LinkEdit->Page = "EditCollectGroup.php";
            $this->Group_H_ID = new clsControl(ccsHidden, "Group_H_ID", "Group_H_ID", ccsInteger, "", CCGetRequestParam("Group_H_ID", $Method, NULL), $this);
            $this->DesignCode = new clsControl(ccsListBox, "DesignCode", "DesignCode", ccsText, "", CCGetRequestParam("DesignCode", $Method, NULL), $this);
            $this->DesignCode->DSType = dsTable;
            $this->DesignCode->DataSource = new clsDBGayaFusionAll();
            $this->DesignCode->ds = & $this->DesignCode->DataSource;
            $this->DesignCode->DataSource->SQL = "SELECT * \n" .
"FROM tblcollect_design {SQL_Where} {SQL_OrderBy}";
            list($this->DesignCode->BoundColumn, $this->DesignCode->TextColumn, $this->DesignCode->DBFormat) = array("DesignCode", "DesignName", "");
            $this->ItemList = new clsPanel("ItemList", $this);
            $this->LinkItem = new clsControl(ccsLink, "LinkItem", "LinkItem", ccsText, "", CCGetRequestParam("LinkItem", $Method, NULL), $this);
            $this->LinkItem->Page = "ItemGroup.php";
            $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", $Method, NULL), $this);
            $this->Link1->Page = "GroupDetil.php";
            $this->Edit->AddComponent("LinkEdit", $this->LinkEdit);
            $this->ItemList->AddComponent("LinkItem", $this->LinkItem);
            $this->ItemList->AddComponent("Link1", $this->Link1);
        }
    }
//End Class_Initialize Event

//Initialize Method @31-6AF05085
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlGroup_H_ID"] = CCGetFromGet("Group_H_ID", NULL);
    }
//End Initialize Method

//Validate Method @31-3B2B5427
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->GroupCode->Validate() && $Validation);
        $Validation = ($this->GroupDescription->Validate() && $Validation);
        $Validation = ($this->Group_H_ID->Validate() && $Validation);
        $Validation = ($this->DesignCode->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->GroupCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->GroupDescription->Errors->Count() == 0);
        $Validation =  $Validation && ($this->Group_H_ID->Errors->Count() == 0);
        $Validation =  $Validation && ($this->DesignCode->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @31-1FE26712
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->GroupCode->Errors->Count());
        $errors = ($errors || $this->GroupDescription->Errors->Count());
        $errors = ($errors || $this->LinkEdit->Errors->Count());
        $errors = ($errors || $this->Group_H_ID->Errors->Count());
        $errors = ($errors || $this->DesignCode->Errors->Count());
        $errors = ($errors || $this->LinkItem->Errors->Count());
        $errors = ($errors || $this->Link1->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
        return $errors;
    }
//End CheckErrors Method

//MasterDetail @31-ED598703
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

//Operation Method @31-E955BD63
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

//InsertRow Method @31-EE9930D8
    function InsertRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeInsert", $this);
        if(!$this->InsertAllowed) return false;
        $this->DataSource->GroupCode->SetValue($this->GroupCode->GetValue(true));
        $this->DataSource->GroupDescription->SetValue($this->GroupDescription->GetValue(true));
        $this->DataSource->LinkEdit->SetValue($this->LinkEdit->GetValue(true));
        $this->DataSource->Group_H_ID->SetValue($this->Group_H_ID->GetValue(true));
        $this->DataSource->DesignCode->SetValue($this->DesignCode->GetValue(true));
        $this->DataSource->LinkItem->SetValue($this->LinkItem->GetValue(true));
        $this->DataSource->Link1->SetValue($this->Link1->GetValue(true));
        $this->DataSource->Insert();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterInsert", $this);
        return (!$this->CheckErrors());
    }
//End InsertRow Method

//UpdateRow Method @31-59159E4A
    function UpdateRow()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeUpdate", $this);
        if(!$this->UpdateAllowed) return false;
        $this->DataSource->GroupCode->SetValue($this->GroupCode->GetValue(true));
        $this->DataSource->GroupDescription->SetValue($this->GroupDescription->GetValue(true));
        $this->DataSource->LinkEdit->SetValue($this->LinkEdit->GetValue(true));
        $this->DataSource->Group_H_ID->SetValue($this->Group_H_ID->GetValue(true));
        $this->DataSource->DesignCode->SetValue($this->DesignCode->GetValue(true));
        $this->DataSource->LinkItem->SetValue($this->LinkItem->GetValue(true));
        $this->DataSource->Link1->SetValue($this->Link1->GetValue(true));
        $this->DataSource->Update();
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterUpdate", $this);
        return (!$this->CheckErrors());
    }
//End UpdateRow Method

//Show Method @31-46D8DDFF
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

        $this->DesignCode->Prepare();

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
                    $this->GroupCode->SetValue($this->DataSource->GroupCode->GetValue());
                    $this->GroupDescription->SetValue($this->DataSource->GroupDescription->GetValue());
                    $this->Group_H_ID->SetValue($this->DataSource->Group_H_ID->GetValue());
                    $this->DesignCode->SetValue($this->DataSource->DesignCode->GetValue());
                }
            } else {
                $this->EditMode = false;
            }
        }
        $this->LinkEdit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "Group_H_ID", $this->DataSource->f("Group_H_ID"));
        $this->LinkItem->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->LinkItem->Parameters = CCAddParam($this->LinkItem->Parameters, "Group_H_ID", $this->DataSource->f("Group_H_ID"));
        $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
        $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "Group_H_ID", $this->DataSource->f("Group_H_ID"));

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->GroupCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GroupDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkEdit->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Group_H_ID->Errors->ToString());
            $Error = ComposeStrings($Error, $this->DesignCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->LinkItem->Errors->ToString());
            $Error = ComposeStrings($Error, $this->Link1->Errors->ToString());
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
        $this->GroupCode->Show();
        $this->GroupDescription->Show();
        $this->Edit->Show();
        $this->Group_H_ID->Show();
        $this->DesignCode->Show();
        $this->ItemList->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End AddNew Class @31-FCB6E20C

class clsAddNewDataSource extends clsDBGayaFusionAll {  //AddNewDataSource Class @31-994CCFD0

//DataSource Variables @31-FAA10537
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
    public $GroupCode;
    public $GroupDescription;
    public $LinkEdit;
    public $Group_H_ID;
    public $DesignCode;
    public $LinkItem;
    public $Link1;
//End DataSource Variables

//DataSourceClass_Initialize Event @31-B81F40CF
    function clsAddNewDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record AddNew/Error";
        $this->Initialize();
        $this->GroupCode = new clsField("GroupCode", ccsText, "");
        
        $this->GroupDescription = new clsField("GroupDescription", ccsText, "");
        
        $this->LinkEdit = new clsField("LinkEdit", ccsText, "");
        
        $this->Group_H_ID = new clsField("Group_H_ID", ccsInteger, "");
        
        $this->DesignCode = new clsField("DesignCode", ccsText, "");
        
        $this->LinkItem = new clsField("LinkItem", ccsText, "");
        
        $this->Link1 = new clsField("Link1", ccsText, "");
        

        $this->InsertFields["GroupCode"] = array("Name" => "GroupCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["GroupDescription"] = array("Name" => "GroupDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->InsertFields["Group_H_ID"] = array("Name" => "Group_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->InsertFields["DesignCode"] = array("Name" => "DesignCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GroupCode"] = array("Name" => "GroupCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["GroupDescription"] = array("Name" => "GroupDescription", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
        $this->UpdateFields["Group_H_ID"] = array("Name" => "Group_H_ID", "Value" => "", "DataType" => ccsInteger, "OmitIfEmpty" => 1);
        $this->UpdateFields["DesignCode"] = array("Name" => "DesignCode", "Value" => "", "DataType" => ccsText, "OmitIfEmpty" => 1);
    }
//End DataSourceClass_Initialize Event

//Prepare Method @31-EB4225C2
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urlGroup_H_ID", ccsInteger, "", "", $this->Parameters["urlGroup_H_ID"], "", false);
        $this->AllParametersSet = $this->wp->AllParamsSet();
        $this->wp->Criterion[1] = $this->wp->Operation(opEqual, "Group_H_ID", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsInteger),false);
        $this->Where = 
             $this->wp->Criterion[1];
    }
//End Prepare Method

//Open Method @31-00083104
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcollect_group_h {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @31-E399847A
    function SetValues()
    {
        $this->GroupCode->SetDBValue($this->f("GroupCode"));
        $this->GroupDescription->SetDBValue($this->f("GroupDescription"));
        $this->Group_H_ID->SetDBValue(trim($this->f("Group_H_ID")));
        $this->DesignCode->SetDBValue($this->f("DesignCode"));
    }
//End SetValues Method

//Insert Method @31-B6C38914
    function Insert()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildInsert", $this->Parent);
        $this->InsertFields["GroupCode"]["Value"] = $this->GroupCode->GetDBValue(true);
        $this->InsertFields["GroupDescription"]["Value"] = $this->GroupDescription->GetDBValue(true);
        $this->InsertFields["Group_H_ID"]["Value"] = $this->Group_H_ID->GetDBValue(true);
        $this->InsertFields["DesignCode"]["Value"] = $this->DesignCode->GetDBValue(true);
        $this->SQL = CCBuildInsert("tblcollect_group_h", $this->InsertFields, $this);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteInsert", $this->Parent);
        if($this->Errors->Count() == 0 && $this->CmdExecution) {
            $this->query($this->SQL);
            $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteInsert", $this->Parent);
        }
    }
//End Insert Method

//Update Method @31-22D932B8
    function Update()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->CmdExecution = true;
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildUpdate", $this->Parent);
        $this->UpdateFields["GroupCode"]["Value"] = $this->GroupCode->GetDBValue(true);
        $this->UpdateFields["GroupDescription"]["Value"] = $this->GroupDescription->GetDBValue(true);
        $this->UpdateFields["Group_H_ID"]["Value"] = $this->Group_H_ID->GetDBValue(true);
        $this->UpdateFields["DesignCode"]["Value"] = $this->DesignCode->GetDBValue(true);
        $this->SQL = CCBuildUpdate("tblcollect_group_h", $this->UpdateFields, $this);
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

} //End AddNewDataSource Class @31-FCB6E20C





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

//Initialize Objects @1-937AA13F
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$Panel1 = new clsPanel("Panel1", $MainPage);
$Search = new clsRecordSearch("", $MainPage);
$Grid = new clsGridGrid("", $MainPage);
$AddNew = new clsRecordAddNew("", $MainPage);
$MainPage->Panel1 = & $Panel1;
$MainPage->Search = & $Search;
$MainPage->Grid = & $Grid;
$MainPage->AddNew = & $AddNew;
$Panel1->AddComponent("Search", $Search);
$Panel1->AddComponent("Grid", $Grid);
$Panel1->AddComponent("AddNew", $AddNew);
$Grid->Initialize();
$AddNew->Initialize();

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

//Execute Components @1-D5CCD2B5
$Search->Operation();
$AddNew->Operation();
//End Execute Components

//Go to destination page @1-0CBBF01C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($Search);
    unset($Grid);
    unset($AddNew);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-4B9F87A2
$Panel1->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-46E23C4E
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($Search);
unset($Grid);
unset($AddNew);
unset($Tpl);
//End Unload Page


?>
