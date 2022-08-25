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
//Include Common Files @1-90A7FA74
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowCasting.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblcasting { //tblcasting Class @2-1EC1079E

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

//Class_Initialize Event @2-3730481E
    function clsRecordtblcasting($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblcasting/Error";
        $this->DataSource = new clstblcastingDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblcasting";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->CastingCode = new clsControl(ccsLabel, "CastingCode", "Casting Code", ccsText, "", CCGetRequestParam("CastingCode", $Method, NULL), $this);
            $this->CastingDescription = new clsControl(ccsLabel, "CastingDescription", "Casting Description", ccsText, "", CCGetRequestParam("CastingDescription", $Method, NULL), $this);
            $this->CastingTechDraw = new clsControl(ccsImage, "CastingTechDraw", "Casting Tech Draw", ccsText, "", CCGetRequestParam("CastingTechDraw", $Method, NULL), $this);
            $this->CastingPhoto1 = new clsControl(ccsImage, "CastingPhoto1", "Casting Photo1", ccsText, "", CCGetRequestParam("CastingPhoto1", $Method, NULL), $this);
            $this->CastingPhoto2 = new clsControl(ccsImage, "CastingPhoto2", "Casting Photo2", ccsText, "", CCGetRequestParam("CastingPhoto2", $Method, NULL), $this);
            $this->CastingPhoto3 = new clsControl(ccsImage, "CastingPhoto3", "Casting Photo3", ccsText, "", CCGetRequestParam("CastingPhoto3", $Method, NULL), $this);
            $this->CastingPhoto4 = new clsControl(ccsImage, "CastingPhoto4", "Casting Photo4", ccsText, "", CCGetRequestParam("CastingPhoto4", $Method, NULL), $this);
            $this->CastingNotes = new clsControl(ccsLabel, "CastingNotes", "Casting Notes", ccsMemo, "", CCGetRequestParam("CastingNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-346FF757
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->CastingCode->Errors->Count());
        $errors = ($errors || $this->CastingDescription->Errors->Count());
        $errors = ($errors || $this->CastingTechDraw->Errors->Count());
        $errors = ($errors || $this->CastingPhoto1->Errors->Count());
        $errors = ($errors || $this->CastingPhoto2->Errors->Count());
        $errors = ($errors || $this->CastingPhoto3->Errors->Count());
        $errors = ($errors || $this->CastingPhoto4->Errors->Count());
        $errors = ($errors || $this->CastingNotes->Errors->Count());
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

//Show Method @2-A9B52FE3
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
                $this->CastingCode->SetValue($this->DataSource->CastingCode->GetValue());
                $this->CastingDescription->SetValue($this->DataSource->CastingDescription->GetValue());
                $this->CastingTechDraw->SetValue($this->DataSource->CastingTechDraw->GetValue());
                $this->CastingPhoto1->SetValue($this->DataSource->CastingPhoto1->GetValue());
                $this->CastingPhoto2->SetValue($this->DataSource->CastingPhoto2->GetValue());
                $this->CastingPhoto3->SetValue($this->DataSource->CastingPhoto3->GetValue());
                $this->CastingPhoto4->SetValue($this->DataSource->CastingPhoto4->GetValue());
                $this->CastingNotes->SetValue($this->DataSource->CastingNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->CastingCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->CastingNotes->Errors->ToString());
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

        $this->CastingCode->Show();
        $this->CastingDescription->Show();
        $this->CastingTechDraw->Show();
        $this->CastingPhoto1->Show();
        $this->CastingPhoto2->Show();
        $this->CastingPhoto3->Show();
        $this->CastingPhoto4->Show();
        $this->CastingNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblcasting Class @2-FCB6E20C

class clstblcastingDataSource extends clsDBGayaFusionAll {  //tblcastingDataSource Class @2-3633356D

//DataSource Variables @2-BDD1CC08
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $CastingCode;
    public $CastingDescription;
    public $CastingTechDraw;
    public $CastingPhoto1;
    public $CastingPhoto2;
    public $CastingPhoto3;
    public $CastingPhoto4;
    public $CastingNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-DB9A7B4F
    function clstblcastingDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblcasting/Error";
        $this->Initialize();
        $this->CastingCode = new clsField("CastingCode", ccsText, "");
        
        $this->CastingDescription = new clsField("CastingDescription", ccsText, "");
        
        $this->CastingTechDraw = new clsField("CastingTechDraw", ccsText, "");
        
        $this->CastingPhoto1 = new clsField("CastingPhoto1", ccsText, "");
        
        $this->CastingPhoto2 = new clsField("CastingPhoto2", ccsText, "");
        
        $this->CastingPhoto3 = new clsField("CastingPhoto3", ccsText, "");
        
        $this->CastingPhoto4 = new clsField("CastingPhoto4", ccsText, "");
        
        $this->CastingNotes = new clsField("CastingNotes", ccsMemo, "");
        

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

//Open Method @2-F2CF98D8
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblcasting {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-9B133A9A
    function SetValues()
    {
        $this->CastingCode->SetDBValue($this->f("CastingCode"));
        $this->CastingDescription->SetDBValue($this->f("CastingDescription"));
        $this->CastingTechDraw->SetDBValue($this->f("CastingTechDraw"));
        $this->CastingPhoto1->SetDBValue($this->f("CastingPhoto1"));
        $this->CastingPhoto2->SetDBValue($this->f("CastingPhoto2"));
        $this->CastingPhoto3->SetDBValue($this->f("CastingPhoto3"));
        $this->CastingPhoto4->SetDBValue($this->f("CastingPhoto4"));
        $this->CastingNotes->SetDBValue($this->f("CastingNotes"));
    }
//End SetValues Method

} //End tblcastingDataSource Class @2-FCB6E20C

//Initialize Page @1-11FCC7AC
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
$TemplateFileName = "ShowCasting.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-F7B4DA1D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblcasting = new clsRecordtblcasting("", $MainPage);
$MainPage->tblcasting = & $tblcasting;
$tblcasting->Initialize();

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

//Execute Components @1-424836BB
$tblcasting->Operation();
//End Execute Components

//Go to destination page @1-72DC7B01
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblcasting);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-A238FEFD
$tblcasting->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-64FA7C02
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblcasting);
unset($Tpl);
//End Unload Page


?>
