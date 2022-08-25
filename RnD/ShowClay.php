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
//Include Common Files @1-F25CC8F8
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowClay.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblclay { //tblclay Class @2-B2B83375

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

//Class_Initialize Event @2-A4E3FBBF
    function clsRecordtblclay($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblclay/Error";
        $this->DataSource = new clstblclayDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblclay";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ClayCode = new clsControl(ccsLabel, "ClayCode", "Clay Code", ccsText, "", CCGetRequestParam("ClayCode", $Method, NULL), $this);
            $this->ClayDescription = new clsControl(ccsLabel, "ClayDescription", "Clay Description", ccsText, "", CCGetRequestParam("ClayDescription", $Method, NULL), $this);
            $this->ClayTechDraw = new clsControl(ccsImage, "ClayTechDraw", "Clay Tech Draw", ccsText, "", CCGetRequestParam("ClayTechDraw", $Method, NULL), $this);
            $this->ClayPhoto1 = new clsControl(ccsImage, "ClayPhoto1", "Clay Photo1", ccsText, "", CCGetRequestParam("ClayPhoto1", $Method, NULL), $this);
            $this->ClayPhoto2 = new clsControl(ccsImage, "ClayPhoto2", "Clay Photo2", ccsText, "", CCGetRequestParam("ClayPhoto2", $Method, NULL), $this);
            $this->ClayPhoto3 = new clsControl(ccsImage, "ClayPhoto3", "Clay Photo3", ccsText, "", CCGetRequestParam("ClayPhoto3", $Method, NULL), $this);
            $this->ClayPhoto4 = new clsControl(ccsImage, "ClayPhoto4", "Clay Photo4", ccsText, "", CCGetRequestParam("ClayPhoto4", $Method, NULL), $this);
            $this->ClayNotes = new clsControl(ccsLabel, "ClayNotes", "Clay Notes", ccsMemo, "", CCGetRequestParam("ClayNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-3A7ACC80
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ClayCode->Errors->Count());
        $errors = ($errors || $this->ClayDescription->Errors->Count());
        $errors = ($errors || $this->ClayTechDraw->Errors->Count());
        $errors = ($errors || $this->ClayPhoto1->Errors->Count());
        $errors = ($errors || $this->ClayPhoto2->Errors->Count());
        $errors = ($errors || $this->ClayPhoto3->Errors->Count());
        $errors = ($errors || $this->ClayPhoto4->Errors->Count());
        $errors = ($errors || $this->ClayNotes->Errors->Count());
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

//Show Method @2-8725E11B
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
                $this->ClayCode->SetValue($this->DataSource->ClayCode->GetValue());
                $this->ClayDescription->SetValue($this->DataSource->ClayDescription->GetValue());
                $this->ClayTechDraw->SetValue($this->DataSource->ClayTechDraw->GetValue());
                $this->ClayPhoto1->SetValue($this->DataSource->ClayPhoto1->GetValue());
                $this->ClayPhoto2->SetValue($this->DataSource->ClayPhoto2->GetValue());
                $this->ClayPhoto3->SetValue($this->DataSource->ClayPhoto3->GetValue());
                $this->ClayPhoto4->SetValue($this->DataSource->ClayPhoto4->GetValue());
                $this->ClayNotes->SetValue($this->DataSource->ClayNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ClayCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ClayNotes->Errors->ToString());
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

        $this->ClayCode->Show();
        $this->ClayDescription->Show();
        $this->ClayTechDraw->Show();
        $this->ClayPhoto1->Show();
        $this->ClayPhoto2->Show();
        $this->ClayPhoto3->Show();
        $this->ClayPhoto4->Show();
        $this->ClayNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblclay Class @2-FCB6E20C

class clstblclayDataSource extends clsDBGayaFusionAll {  //tblclayDataSource Class @2-232BD427

//DataSource Variables @2-C2B09197
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $ClayCode;
    public $ClayDescription;
    public $ClayTechDraw;
    public $ClayPhoto1;
    public $ClayPhoto2;
    public $ClayPhoto3;
    public $ClayPhoto4;
    public $ClayNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-54EE2E51
    function clstblclayDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblclay/Error";
        $this->Initialize();
        $this->ClayCode = new clsField("ClayCode", ccsText, "");
        
        $this->ClayDescription = new clsField("ClayDescription", ccsText, "");
        
        $this->ClayTechDraw = new clsField("ClayTechDraw", ccsText, "");
        
        $this->ClayPhoto1 = new clsField("ClayPhoto1", ccsText, "");
        
        $this->ClayPhoto2 = new clsField("ClayPhoto2", ccsText, "");
        
        $this->ClayPhoto3 = new clsField("ClayPhoto3", ccsText, "");
        
        $this->ClayPhoto4 = new clsField("ClayPhoto4", ccsText, "");
        
        $this->ClayNotes = new clsField("ClayNotes", ccsMemo, "");
        

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

//Open Method @2-A8669435
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

//SetValues Method @2-5FA208E8
    function SetValues()
    {
        $this->ClayCode->SetDBValue($this->f("ClayCode"));
        $this->ClayDescription->SetDBValue($this->f("ClayDescription"));
        $this->ClayTechDraw->SetDBValue($this->f("ClayTechDraw"));
        $this->ClayPhoto1->SetDBValue($this->f("ClayPhoto1"));
        $this->ClayPhoto2->SetDBValue($this->f("ClayPhoto2"));
        $this->ClayPhoto3->SetDBValue($this->f("ClayPhoto3"));
        $this->ClayPhoto4->SetDBValue($this->f("ClayPhoto4"));
        $this->ClayNotes->SetDBValue($this->f("ClayNotes"));
    }
//End SetValues Method

} //End tblclayDataSource Class @2-FCB6E20C

//Initialize Page @1-0AC8A839
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
$TemplateFileName = "ShowClay.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-42FA4BF1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblclay = new clsRecordtblclay("", $MainPage);
$MainPage->tblclay = & $tblclay;
$tblclay->Initialize();

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

//Execute Components @1-DE418592
$tblclay->Operation();
//End Execute Components

//Go to destination page @1-8EB02727
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblclay);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-0F57D07D
$tblclay->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-04E95DC7
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblclay);
unset($Tpl);
//End Unload Page


?>
