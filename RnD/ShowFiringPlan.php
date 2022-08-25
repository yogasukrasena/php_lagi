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
//Include Common Files @1-4215FC4C
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowFiringPlan.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblfiringplan { //tblfiringplan Class @2-B1B1F060

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

//Class_Initialize Event @2-EF2ED3BE
    function clsRecordtblfiringplan($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblfiringplan/Error";
        $this->DataSource = new clstblfiringplanDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblfiringplan";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->FiringPlanCode = new clsControl(ccsLabel, "FiringPlanCode", "Firing Plan Code", ccsText, "", CCGetRequestParam("FiringPlanCode", $Method, NULL), $this);
            $this->FiringPlanDescription = new clsControl(ccsLabel, "FiringPlanDescription", "Firing Plan Description", ccsText, "", CCGetRequestParam("FiringPlanDescription", $Method, NULL), $this);
            $this->FiringPlanTechDraw = new clsControl(ccsImage, "FiringPlanTechDraw", "Firing Plan Tech Draw", ccsText, "", CCGetRequestParam("FiringPlanTechDraw", $Method, NULL), $this);
            $this->FiringPlanPhoto1 = new clsControl(ccsImage, "FiringPlanPhoto1", "Firing Plan Photo1", ccsText, "", CCGetRequestParam("FiringPlanPhoto1", $Method, NULL), $this);
            $this->FiringPlanPhoto2 = new clsControl(ccsImage, "FiringPlanPhoto2", "Firing Plan Photo2", ccsText, "", CCGetRequestParam("FiringPlanPhoto2", $Method, NULL), $this);
            $this->FiringPlanPhoto3 = new clsControl(ccsImage, "FiringPlanPhoto3", "Firing Plan Photo3", ccsText, "", CCGetRequestParam("FiringPlanPhoto3", $Method, NULL), $this);
            $this->FiringPlanPhoto4 = new clsControl(ccsImage, "FiringPlanPhoto4", "Firing Plan Photo4", ccsText, "", CCGetRequestParam("FiringPlanPhoto4", $Method, NULL), $this);
            $this->FiringPlanNotes = new clsControl(ccsLabel, "FiringPlanNotes", "Firing Plan Notes", ccsMemo, "", CCGetRequestParam("FiringPlanNotes", $Method, NULL), $this);
        }
    }
//End Class_Initialize Event

//Initialize Method @2-D6CB1C94
    function Initialize()
    {

        if(!$this->Visible)
            return;

        $this->DataSource->Parameters["urlID"] = CCGetFromGet("ID", NULL);
    }
//End Initialize Method

//Validate Method @2-367945B8
    function Validate()
    {
        global $CCSLocales;
        $Validation = true;
        $Where = "";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "OnValidate", $this);
        return (($this->Errors->Count() == 0) && $Validation);
    }
//End Validate Method

//CheckErrors Method @2-558D185C
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->FiringPlanCode->Errors->Count());
        $errors = ($errors || $this->FiringPlanDescription->Errors->Count());
        $errors = ($errors || $this->FiringPlanTechDraw->Errors->Count());
        $errors = ($errors || $this->FiringPlanPhoto1->Errors->Count());
        $errors = ($errors || $this->FiringPlanPhoto2->Errors->Count());
        $errors = ($errors || $this->FiringPlanPhoto3->Errors->Count());
        $errors = ($errors || $this->FiringPlanPhoto4->Errors->Count());
        $errors = ($errors || $this->FiringPlanNotes->Errors->Count());
        $errors = ($errors || $this->Errors->Count());
        $errors = ($errors || $this->DataSource->Errors->Count());
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

//Operation Method @2-17DC9883
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

        $Redirect = $FileName . "?" . CCGetQueryString("QueryString", array("ccsForm"));
        if ($Redirect)
            $this->DataSource->close();
    }
//End Operation Method

//Show Method @2-F58FA4D3
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
                $this->FiringPlanCode->SetValue($this->DataSource->FiringPlanCode->GetValue());
                $this->FiringPlanDescription->SetValue($this->DataSource->FiringPlanDescription->GetValue());
                $this->FiringPlanTechDraw->SetValue($this->DataSource->FiringPlanTechDraw->GetValue());
                $this->FiringPlanPhoto1->SetValue($this->DataSource->FiringPlanPhoto1->GetValue());
                $this->FiringPlanPhoto2->SetValue($this->DataSource->FiringPlanPhoto2->GetValue());
                $this->FiringPlanPhoto3->SetValue($this->DataSource->FiringPlanPhoto3->GetValue());
                $this->FiringPlanPhoto4->SetValue($this->DataSource->FiringPlanPhoto4->GetValue());
                $this->FiringPlanNotes->SetValue($this->DataSource->FiringPlanNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->FiringPlanCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->FiringPlanNotes->Errors->ToString());
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

        $this->FiringPlanCode->Show();
        $this->FiringPlanDescription->Show();
        $this->FiringPlanTechDraw->Show();
        $this->FiringPlanPhoto1->Show();
        $this->FiringPlanPhoto2->Show();
        $this->FiringPlanPhoto3->Show();
        $this->FiringPlanPhoto4->Show();
        $this->FiringPlanNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblfiringplan Class @2-FCB6E20C

class clstblfiringplanDataSource extends clsDBGayaFusionAll {  //tblfiringplanDataSource Class @2-50D90770

//DataSource Variables @2-ED2766B0
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $FiringPlanCode;
    public $FiringPlanDescription;
    public $FiringPlanTechDraw;
    public $FiringPlanPhoto1;
    public $FiringPlanPhoto2;
    public $FiringPlanPhoto3;
    public $FiringPlanPhoto4;
    public $FiringPlanNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-F4F78A54
    function clstblfiringplanDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblfiringplan/Error";
        $this->Initialize();
        $this->FiringPlanCode = new clsField("FiringPlanCode", ccsText, "");
        
        $this->FiringPlanDescription = new clsField("FiringPlanDescription", ccsText, "");
        
        $this->FiringPlanTechDraw = new clsField("FiringPlanTechDraw", ccsText, "");
        
        $this->FiringPlanPhoto1 = new clsField("FiringPlanPhoto1", ccsText, "");
        
        $this->FiringPlanPhoto2 = new clsField("FiringPlanPhoto2", ccsText, "");
        
        $this->FiringPlanPhoto3 = new clsField("FiringPlanPhoto3", ccsText, "");
        
        $this->FiringPlanPhoto4 = new clsField("FiringPlanPhoto4", ccsText, "");
        
        $this->FiringPlanNotes = new clsField("FiringPlanNotes", ccsMemo, "");
        

    }
//End DataSourceClass_Initialize Event

//Prepare Method @2-C6736E1B
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

//Open Method @2-BDF5EB4A
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

//SetValues Method @2-5DF839C3
    function SetValues()
    {
        $this->FiringPlanCode->SetDBValue($this->f("FiringPlanCode"));
        $this->FiringPlanDescription->SetDBValue($this->f("FiringPlanDescription"));
        $this->FiringPlanTechDraw->SetDBValue($this->f("FiringPlanTechDraw"));
        $this->FiringPlanPhoto1->SetDBValue($this->f("FiringPlanPhoto1"));
        $this->FiringPlanPhoto2->SetDBValue($this->f("FiringPlanPhoto2"));
        $this->FiringPlanPhoto3->SetDBValue($this->f("FiringPlanPhoto3"));
        $this->FiringPlanPhoto4->SetDBValue($this->f("FiringPlanPhoto4"));
        $this->FiringPlanNotes->SetDBValue($this->f("FiringPlanNotes"));
    }
//End SetValues Method

} //End tblfiringplanDataSource Class @2-FCB6E20C

//Initialize Page @1-8CC39E4C
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
$TemplateFileName = "ShowFiringPlan.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-0839EA48
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblfiringplan = new clsRecordtblfiringplan("", $MainPage);
$MainPage->tblfiringplan = & $tblfiringplan;
$tblfiringplan->Initialize();

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

//Execute Components @1-01D74BE0
$tblfiringplan->Operation();
//End Execute Components

//Go to destination page @1-65F516F2
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblfiringplan);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-82CA275F
$tblfiringplan->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-39883983
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblfiringplan);
unset($Tpl);
//End Unload Page


?>
