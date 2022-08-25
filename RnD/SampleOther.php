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

//Include Common Files @1-98D2DABA
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "SampleOther.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsGridsamplepackaging { //samplepackaging class @2-F8EB3018

//Variables @2-2CD4A168

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
    public $Sorter_Description;
    public $Sorter_CostPrice1;
//End Variables

//Class_Initialize Event @2-16935D1C
    function clsGridsamplepackaging($RelativePath, & $Parent)
    {
        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->ComponentName = "samplepackaging";
        $this->Visible = True;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Grid samplepackaging";
        $this->Attributes = new clsAttributes($this->ComponentName . ":");
        $this->DataSource = new clssamplepackagingDataSource($this);
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
        $this->SorterName = CCGetParam("samplepackagingOrder", "");
        $this->SorterDirection = CCGetParam("samplepackagingDir", "");

        $this->SampleCode = new clsControl(ccsLabel, "SampleCode", "SampleCode", ccsText, "", CCGetRequestParam("SampleCode", ccsGet, NULL), $this);
        $this->Description = new clsControl(ccsLabel, "Description", "Description", ccsText, "", CCGetRequestParam("Description", ccsGet, NULL), $this);
        $this->Photo1 = new clsControl(ccsImage, "Photo1", "Photo1", ccsText, "", CCGetRequestParam("Photo1", ccsGet, NULL), $this);
        $this->TotalCost = new clsControl(ccsLabel, "TotalCost", "TotalCost", ccsFloat, array(False, 0, Null, Null, False, "", "", 1, True, ""), CCGetRequestParam("TotalCost", ccsGet, NULL), $this);
        $this->LinkEdit = new clsControl(ccsLink, "LinkEdit", "LinkEdit", ccsText, "", CCGetRequestParam("LinkEdit", ccsGet, NULL), $this);
        $this->LinkEdit->Page = "EditSampleOther.php";
        $this->Link1 = new clsControl(ccsLink, "Link1", "Link1", ccsText, "", CCGetRequestParam("Link1", ccsGet, NULL), $this);
        $this->Link1->Page = "ShowSampleOther.php";
        $this->DesMat1 = new clsControl(ccsHidden, "DesMat1", "Des Mat1", ccsInteger, "", CCGetRequestParam("DesMat1", ccsGet, NULL), $this);
        $this->DesMat2 = new clsControl(ccsHidden, "DesMat2", "Des Mat2", ccsInteger, "", CCGetRequestParam("DesMat2", ccsGet, NULL), $this);
        $this->DesMat3 = new clsControl(ccsHidden, "DesMat3", "DesMat3", ccsInteger, "", CCGetRequestParam("DesMat3", ccsGet, NULL), $this);
        $this->DesMat4 = new clsControl(ccsHidden, "DesMat4", "DesMat4", ccsInteger, "", CCGetRequestParam("DesMat4", ccsGet, NULL), $this);
        $this->DesMat5 = new clsControl(ccsHidden, "DesMat5", "DesMat5", ccsInteger, "", CCGetRequestParam("DesMat5", ccsGet, NULL), $this);
        $this->QtyDesMat1 = new clsControl(ccsHidden, "QtyDesMat1", "Qty Des Mat1", ccsInteger, "", CCGetRequestParam("QtyDesMat1", ccsGet, NULL), $this);
        $this->QtyDesMat2 = new clsControl(ccsHidden, "QtyDesMat2", "Qty Des Mat2", ccsInteger, "", CCGetRequestParam("QtyDesMat2", ccsGet, NULL), $this);
        $this->QtyDesMat3 = new clsControl(ccsHidden, "QtyDesMat3", "Qty Des Mat3", ccsInteger, "", CCGetRequestParam("QtyDesMat3", ccsGet, NULL), $this);
        $this->QtyDesMat4 = new clsControl(ccsHidden, "QtyDesMat4", "Qty Des Mat4", ccsInteger, "", CCGetRequestParam("QtyDesMat4", ccsGet, NULL), $this);
        $this->QtyDesMat5 = new clsControl(ccsHidden, "QtyDesMat5", "Qty Des Mat5", ccsInteger, "", CCGetRequestParam("QtyDesMat5", ccsGet, NULL), $this);
        $this->TotalCostPrice = new clsControl(ccsHidden, "TotalCostPrice", "Total Cost Price", ccsFloat, "", CCGetRequestParam("TotalCostPrice", ccsGet, NULL), $this);
        $this->samplepackaging_Insert = new clsControl(ccsLink, "samplepackaging_Insert", "samplepackaging_Insert", ccsText, "", CCGetRequestParam("samplepackaging_Insert", ccsGet, NULL), $this);
        $this->samplepackaging_Insert->Parameters = CCGetQueryString("QueryString", array("ID", "ccsForm"));
        $this->samplepackaging_Insert->Page = "EditSampleOther.php";
        $this->Sorter_SampleCode = new clsSorter($this->ComponentName, "Sorter_SampleCode", $FileName, $this);
        $this->Sorter_Description = new clsSorter($this->ComponentName, "Sorter_Description", $FileName, $this);
        $this->Sorter_CostPrice1 = new clsSorter($this->ComponentName, "Sorter_CostPrice1", $FileName, $this);
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

//Show Method @2-C3EE5624
    function Show()
    {
        global $Tpl;
        global $CCSLocales;
        if(!$this->Visible) return;

        $this->RowNumber = 0;

        $this->DataSource->Parameters["urls_SampleCode"] = CCGetFromGet("s_SampleCode", NULL);
        $this->DataSource->Parameters["urls_Description"] = CCGetFromGet("s_Description", NULL);

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
            $this->ControlsVisible["Description"] = $this->Description->Visible;
            $this->ControlsVisible["Photo1"] = $this->Photo1->Visible;
            $this->ControlsVisible["TotalCost"] = $this->TotalCost->Visible;
            $this->ControlsVisible["LinkEdit"] = $this->LinkEdit->Visible;
            $this->ControlsVisible["Link1"] = $this->Link1->Visible;
            $this->ControlsVisible["DesMat1"] = $this->DesMat1->Visible;
            $this->ControlsVisible["DesMat2"] = $this->DesMat2->Visible;
            $this->ControlsVisible["DesMat3"] = $this->DesMat3->Visible;
            $this->ControlsVisible["DesMat4"] = $this->DesMat4->Visible;
            $this->ControlsVisible["DesMat5"] = $this->DesMat5->Visible;
            $this->ControlsVisible["QtyDesMat1"] = $this->QtyDesMat1->Visible;
            $this->ControlsVisible["QtyDesMat2"] = $this->QtyDesMat2->Visible;
            $this->ControlsVisible["QtyDesMat3"] = $this->QtyDesMat3->Visible;
            $this->ControlsVisible["QtyDesMat4"] = $this->QtyDesMat4->Visible;
            $this->ControlsVisible["QtyDesMat5"] = $this->QtyDesMat5->Visible;
            $this->ControlsVisible["TotalCostPrice"] = $this->TotalCostPrice->Visible;
            while ($this->ForceIteration || (($this->RowNumber < $this->PageSize) &&  ($this->HasRecord = $this->DataSource->has_next_record()))) {
                $this->RowNumber++;
                if ($this->HasRecord) {
                    $this->DataSource->next_record();
                    $this->DataSource->SetValues();
                }
                $Tpl->block_path = $ParentPath . "/" . $GridBlock . "/Row";
                if(!is_array($this->TotalCostPrice->Value) && !strlen($this->TotalCostPrice->Value) && $this->TotalCostPrice->Value !== false)
                    $this->TotalCostPrice->SetText(0);
                $this->SampleCode->SetValue($this->DataSource->SampleCode->GetValue());
                $this->Description->SetValue($this->DataSource->Description->GetValue());
                $this->Photo1->SetValue($this->DataSource->Photo1->GetValue());
                $this->LinkEdit->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->LinkEdit->Parameters = CCAddParam($this->LinkEdit->Parameters, "ID", $this->DataSource->f("ID"));
                $this->Link1->Parameters = CCGetQueryString("QueryString", array("ccsForm"));
                $this->Link1->Parameters = CCAddParam($this->Link1->Parameters, "ID", $this->DataSource->f("ID"));
                $this->DesMat1->SetValue($this->DataSource->DesMat1->GetValue());
                $this->DesMat2->SetValue($this->DataSource->DesMat2->GetValue());
                $this->DesMat3->SetValue($this->DataSource->DesMat3->GetValue());
                $this->DesMat4->SetValue($this->DataSource->DesMat4->GetValue());
                $this->DesMat5->SetValue($this->DataSource->DesMat5->GetValue());
                $this->QtyDesMat1->SetValue($this->DataSource->QtyDesMat1->GetValue());
                $this->QtyDesMat2->SetValue($this->DataSource->QtyDesMat2->GetValue());
                $this->QtyDesMat3->SetValue($this->DataSource->QtyDesMat3->GetValue());
                $this->QtyDesMat4->SetValue($this->DataSource->QtyDesMat4->GetValue());
                $this->QtyDesMat5->SetValue($this->DataSource->QtyDesMat5->GetValue());
                $this->TotalCostPrice->SetValue($this->DataSource->TotalCostPrice->GetValue());
                $this->Attributes->SetValue("rowNumber", $this->RowNumber);
                $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeShowRow", $this);
                $this->Attributes->Show();
                $this->SampleCode->Show();
                $this->Description->Show();
                $this->Photo1->Show();
                $this->TotalCost->Show();
                $this->LinkEdit->Show();
                $this->Link1->Show();
                $this->DesMat1->Show();
                $this->DesMat2->Show();
                $this->DesMat3->Show();
                $this->DesMat4->Show();
                $this->DesMat5->Show();
                $this->QtyDesMat1->Show();
                $this->QtyDesMat2->Show();
                $this->QtyDesMat3->Show();
                $this->QtyDesMat4->Show();
                $this->QtyDesMat5->Show();
                $this->TotalCostPrice->Show();
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
        $this->samplepackaging_Insert->Show();
        $this->Sorter_SampleCode->Show();
        $this->Sorter_Description->Show();
        $this->Sorter_CostPrice1->Show();
        $this->Navigator->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

//GetErrors Method @2-44C49B74
    function GetErrors()
    {
        $errors = "";
        $errors = ComposeStrings($errors, $this->SampleCode->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Description->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Photo1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalCost->Errors->ToString());
        $errors = ComposeStrings($errors, $this->LinkEdit->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Link1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesMat1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesMat2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesMat3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesMat4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DesMat5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QtyDesMat1->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QtyDesMat2->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QtyDesMat3->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QtyDesMat4->Errors->ToString());
        $errors = ComposeStrings($errors, $this->QtyDesMat5->Errors->ToString());
        $errors = ComposeStrings($errors, $this->TotalCostPrice->Errors->ToString());
        $errors = ComposeStrings($errors, $this->Errors->ToString());
        $errors = ComposeStrings($errors, $this->DataSource->Errors->ToString());
        return $errors;
    }
//End GetErrors Method

} //End samplepackaging Class @2-FCB6E20C

class clssamplepackagingDataSource extends clsDBGayaFusionAll {  //samplepackagingDataSource Class @2-1A93D496

//DataSource Variables @2-533F8E83
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $CountSQL;
    public $wp;


    // Datasource fields
    public $SampleCode;
    public $Description;
    public $Photo1;
    public $DesMat1;
    public $DesMat2;
    public $DesMat3;
    public $DesMat4;
    public $DesMat5;
    public $QtyDesMat1;
    public $QtyDesMat2;
    public $QtyDesMat3;
    public $QtyDesMat4;
    public $QtyDesMat5;
    public $TotalCostPrice;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-091108E6
    function clssamplepackagingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Grid samplepackaging";
        $this->Initialize();
        $this->SampleCode = new clsField("SampleCode", ccsText, "");
        
        $this->Description = new clsField("Description", ccsText, "");
        
        $this->Photo1 = new clsField("Photo1", ccsText, "");
        
        $this->DesMat1 = new clsField("DesMat1", ccsInteger, "");
        
        $this->DesMat2 = new clsField("DesMat2", ccsInteger, "");
        
        $this->DesMat3 = new clsField("DesMat3", ccsInteger, "");
        
        $this->DesMat4 = new clsField("DesMat4", ccsInteger, "");
        
        $this->DesMat5 = new clsField("DesMat5", ccsInteger, "");
        
        $this->QtyDesMat1 = new clsField("QtyDesMat1", ccsInteger, "");
        
        $this->QtyDesMat2 = new clsField("QtyDesMat2", ccsInteger, "");
        
        $this->QtyDesMat3 = new clsField("QtyDesMat3", ccsInteger, "");
        
        $this->QtyDesMat4 = new clsField("QtyDesMat4", ccsInteger, "");
        
        $this->QtyDesMat5 = new clsField("QtyDesMat5", ccsInteger, "");
        
        $this->TotalCostPrice = new clsField("TotalCostPrice", ccsFloat, "");
        

    }
//End DataSourceClass_Initialize Event

//SetOrder Method @2-AC3DC057
    function SetOrder($SorterName, $SorterDirection)
    {
        $this->Order = "ID";
        $this->Order = CCGetOrder($this->Order, $SorterName, $SorterDirection, 
            array("Sorter_SampleCode" => array("SampleCode", ""), 
            "Sorter_Description" => array("Description", ""), 
            "Sorter_CostPrice1" => array("TotalCost", "")));
    }
//End SetOrder Method

//Prepare Method @2-EB2A3456
    function Prepare()
    {
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->wp = new clsSQLParameters($this->ErrorBlock);
        $this->wp->AddParameter("1", "urls_SampleCode", ccsText, "", "", $this->Parameters["urls_SampleCode"], "", false);
        $this->wp->AddParameter("2", "urls_Description", ccsText, "", "", $this->Parameters["urls_Description"], "", false);
        $this->wp->Criterion[1] = $this->wp->Operation(opContains, "SampleCode", $this->wp->GetDBValue("1"), $this->ToSQL($this->wp->GetDBValue("1"), ccsText),false);
        $this->wp->Criterion[2] = $this->wp->Operation(opContains, "Description", $this->wp->GetDBValue("2"), $this->ToSQL($this->wp->GetDBValue("2"), ccsText),false);
        $this->Where = $this->wp->opAND(
             false, 
             $this->wp->Criterion[1], 
             $this->wp->Criterion[2]);
    }
//End Prepare Method

//Open Method @2-5CE8B715
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->CountSQL = "SELECT COUNT(*)\n\n" .
        "FROM sampleother";
        $this->SQL = "SELECT ID, SampleCode, Description, Photo1, DesMat1, DesMat2, DesMat3, DesMat4, DesMat5, QtyDesMat1, QtyDesMat2, QtyDesMat3, QtyDesMat4,\n\n" .
        "QtyDesMat5, TotalCostPrice \n\n" .
        "FROM sampleother {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        if ($this->CountSQL) 
            $this->RecordsCount = CCGetDBValue(CCBuildSQL($this->CountSQL, $this->Where, ""), $this);
        else
            $this->RecordsCount = "CCS not counted";
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-21131F73
    function SetValues()
    {
        $this->SampleCode->SetDBValue($this->f("SampleCode"));
        $this->Description->SetDBValue($this->f("Description"));
        $this->Photo1->SetDBValue($this->f("Photo1"));
        $this->DesMat1->SetDBValue(trim($this->f("DesMat1")));
        $this->DesMat2->SetDBValue(trim($this->f("DesMat2")));
        $this->DesMat3->SetDBValue(trim($this->f("DesMat3")));
        $this->DesMat4->SetDBValue(trim($this->f("DesMat4")));
        $this->DesMat5->SetDBValue(trim($this->f("DesMat5")));
        $this->QtyDesMat1->SetDBValue(trim($this->f("QtyDesMat1")));
        $this->QtyDesMat2->SetDBValue(trim($this->f("QtyDesMat2")));
        $this->QtyDesMat3->SetDBValue(trim($this->f("QtyDesMat3")));
        $this->QtyDesMat4->SetDBValue(trim($this->f("QtyDesMat4")));
        $this->QtyDesMat5->SetDBValue(trim($this->f("QtyDesMat5")));
        $this->TotalCostPrice->SetDBValue(trim($this->f("TotalCostPrice")));
    }
//End SetValues Method

} //End samplepackagingDataSource Class @2-FCB6E20C

class clsRecordsamplepackagingSearch { //samplepackagingSearch Class @3-898AEBEE

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

//Class_Initialize Event @3-9C85223B
    function clsRecordsamplepackagingSearch($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record samplepackagingSearch/Error";
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "samplepackagingSearch";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->Button_DoSearch = new clsButton("Button_DoSearch", $Method, $this);
            $this->s_SampleCode = new clsControl(ccsTextBox, "s_SampleCode", "s_SampleCode", ccsText, "", CCGetRequestParam("s_SampleCode", $Method, NULL), $this);
            $this->s_Description = new clsControl(ccsTextBox, "s_Description", "s_Description", ccsText, "", CCGetRequestParam("s_Description", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Validate Method @3-0D056474
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $Validation = ($this->s_SampleCode->Validate() && $Validation);
        $Validation = ($this->s_Description->Validate() && $Validation);
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        $Validation =  $Validation && ($this->s_SampleCode->Errors->Count() == 0);
        $Validation =  $Validation && ($this->s_Description->Errors->Count() == 0);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @3-F03CA5ED
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->s_SampleCode->Errors->Count());
        $errors = ($errors || $this->s_Description->Errors->Count());
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

//Operation Method @3-6936FECC
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
        $Redirect = "SampleOther.php";
        if($this->Validate()) {
            if($this->PressedButton == "Button_DoSearch") {
                $Redirect = "SampleOther.php" . "?" . CCMergeQueryStrings(CCGetQueryString("Form", array("Button_DoSearch", "Button_DoSearch_x", "Button_DoSearch_y")));
                if(!CCGetEvent($this->Button_DoSearch->CCSEvents, "OnClick", $this->Button_DoSearch)) {
                    $Redirect = "";
                }
            }
        } else {
            $Redirect = "";
        }
    }
//End Operation Method

//Show Method @3-B41A2F4C
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
            $Error = ComposeStrings($Error, $this->s_SampleCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->s_Description->Errors->ToString());
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
        $this->s_SampleCode->Show();
        $this->s_Description->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
    }
//End Show Method

} //End samplepackagingSearch Class @3-FCB6E20C





//Initialize Page @1-111F13EB
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
$TemplateFileName = "SampleOther.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Include events file @1-93C3DAD9
include_once("./SampleOther_events.php");
//End Include events file

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-85A06E41
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$samplepackaging = new clsGridsamplepackaging("", $MainPage);
$samplepackagingSearch = new clsRecordsamplepackagingSearch("", $MainPage);
$MainPage->samplepackaging = & $samplepackaging;
$MainPage->samplepackagingSearch = & $samplepackagingSearch;
$samplepackaging->Initialize();

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

//Execute Components @1-82A755D6
$samplepackagingSearch->Operation();
//End Execute Components

//Go to destination page @1-77DEF1EC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($samplepackaging);
    unset($samplepackagingSearch);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-46D93F71
$samplepackaging->Show();
$samplepackagingSearch->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-A6D823A4
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($samplepackaging);
unset($samplepackagingSearch);
unset($Tpl);
//End Unload Page


?>
