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
//Include Common Files @1-3DC7808B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowGlaze.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblglaze { //tblglaze Class @2-789EB929

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

//Class_Initialize Event @2-850A8DAC
    function clsRecordtblglaze($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblglaze/Error";
        $this->DataSource = new clstblglazeDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblglaze";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->GlazeCode = new clsControl(ccsLabel, "GlazeCode", "Glaze Code", ccsText, "", CCGetRequestParam("GlazeCode", $Method, NULL), $this);
            $this->GlazeDescription = new clsControl(ccsLabel, "GlazeDescription", "Glaze Description", ccsText, "", CCGetRequestParam("GlazeDescription", $Method, NULL), $this);
            $this->GlazeTechDraw = new clsControl(ccsImage, "GlazeTechDraw", "Glaze Tech Draw", ccsText, "", CCGetRequestParam("GlazeTechDraw", $Method, NULL), $this);
            $this->GlazePhoto1 = new clsControl(ccsImage, "GlazePhoto1", "Glaze Photo1", ccsText, "", CCGetRequestParam("GlazePhoto1", $Method, NULL), $this);
            $this->GlazePhoto2 = new clsControl(ccsImage, "GlazePhoto2", "Glaze Photo2", ccsText, "", CCGetRequestParam("GlazePhoto2", $Method, NULL), $this);
            $this->GlazePhoto3 = new clsControl(ccsImage, "GlazePhoto3", "Glaze Photo3", ccsText, "", CCGetRequestParam("GlazePhoto3", $Method, NULL), $this);
            $this->GlazePhoto4 = new clsControl(ccsImage, "GlazePhoto4", "Glaze Photo4", ccsText, "", CCGetRequestParam("GlazePhoto4", $Method, NULL), $this);
            $this->GlazeNotes = new clsControl(ccsLabel, "GlazeNotes", "Glaze Notes", ccsMemo, "", CCGetRequestParam("GlazeNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-AF6F45CD
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->GlazeCode->Errors->Count());
        $errors = ($errors || $this->GlazeDescription->Errors->Count());
        $errors = ($errors || $this->GlazeTechDraw->Errors->Count());
        $errors = ($errors || $this->GlazePhoto1->Errors->Count());
        $errors = ($errors || $this->GlazePhoto2->Errors->Count());
        $errors = ($errors || $this->GlazePhoto3->Errors->Count());
        $errors = ($errors || $this->GlazePhoto4->Errors->Count());
        $errors = ($errors || $this->GlazeNotes->Errors->Count());
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

//Show Method @2-8843E8EA
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
                $this->GlazeCode->SetValue($this->DataSource->GlazeCode->GetValue());
                $this->GlazeDescription->SetValue($this->DataSource->GlazeDescription->GetValue());
                $this->GlazeTechDraw->SetValue($this->DataSource->GlazeTechDraw->GetValue());
                $this->GlazePhoto1->SetValue($this->DataSource->GlazePhoto1->GetValue());
                $this->GlazePhoto2->SetValue($this->DataSource->GlazePhoto2->GetValue());
                $this->GlazePhoto3->SetValue($this->DataSource->GlazePhoto3->GetValue());
                $this->GlazePhoto4->SetValue($this->DataSource->GlazePhoto4->GetValue());
                $this->GlazeNotes->SetValue($this->DataSource->GlazeNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->GlazeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazePhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazePhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazePhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazePhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->GlazeNotes->Errors->ToString());
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

        $this->GlazeCode->Show();
        $this->GlazeDescription->Show();
        $this->GlazeTechDraw->Show();
        $this->GlazePhoto1->Show();
        $this->GlazePhoto2->Show();
        $this->GlazePhoto3->Show();
        $this->GlazePhoto4->Show();
        $this->GlazeNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblglaze Class @2-FCB6E20C

class clstblglazeDataSource extends clsDBGayaFusionAll {  //tblglazeDataSource Class @2-3D94EA62

//DataSource Variables @2-65328E27
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $GlazeCode;
    public $GlazeDescription;
    public $GlazeTechDraw;
    public $GlazePhoto1;
    public $GlazePhoto2;
    public $GlazePhoto3;
    public $GlazePhoto4;
    public $GlazeNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-3423D3FA
    function clstblglazeDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblglaze/Error";
        $this->Initialize();
        $this->GlazeCode = new clsField("GlazeCode", ccsText, "");
        
        $this->GlazeDescription = new clsField("GlazeDescription", ccsText, "");
        
        $this->GlazeTechDraw = new clsField("GlazeTechDraw", ccsText, "");
        
        $this->GlazePhoto1 = new clsField("GlazePhoto1", ccsText, "");
        
        $this->GlazePhoto2 = new clsField("GlazePhoto2", ccsText, "");
        
        $this->GlazePhoto3 = new clsField("GlazePhoto3", ccsText, "");
        
        $this->GlazePhoto4 = new clsField("GlazePhoto4", ccsText, "");
        
        $this->GlazeNotes = new clsField("GlazeNotes", ccsMemo, "");
        

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

//Open Method @2-6ACF70B9
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblglaze {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-B00FFF9C
    function SetValues()
    {
        $this->GlazeCode->SetDBValue($this->f("GlazeCode"));
        $this->GlazeDescription->SetDBValue($this->f("GlazeDescription"));
        $this->GlazeTechDraw->SetDBValue($this->f("GlazeTechDraw"));
        $this->GlazePhoto1->SetDBValue($this->f("GlazePhoto1"));
        $this->GlazePhoto2->SetDBValue($this->f("GlazePhoto2"));
        $this->GlazePhoto3->SetDBValue($this->f("GlazePhoto3"));
        $this->GlazePhoto4->SetDBValue($this->f("GlazePhoto4"));
        $this->GlazeNotes->SetDBValue($this->f("GlazeNotes"));
    }
//End SetValues Method

} //End tblglazeDataSource Class @2-FCB6E20C

//Initialize Page @1-8FB209EE
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
$TemplateFileName = "ShowGlaze.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-3C1E2ED1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblglaze = new clsRecordtblglaze("", $MainPage);
$MainPage->tblglaze = & $tblglaze;
$tblglaze->Initialize();

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

//Execute Components @1-32B43728
$tblglaze->Operation();
//End Execute Components

//Go to destination page @1-C9227E27
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblglaze);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-85F5DBCA
$tblglaze->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8ED70E30
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblglaze);
unset($Tpl);
//End Unload Page


?>
