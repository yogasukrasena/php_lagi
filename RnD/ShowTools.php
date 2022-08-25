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
//Include Common Files @1-EB09BFEB
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowTools.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbltools { //tbltools Class @2-5E90AEEA

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

//Class_Initialize Event @2-A5999D0D
    function clsRecordtbltools($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbltools/Error";
        $this->DataSource = new clstbltoolsDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbltools";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->ToolsCode = new clsControl(ccsLabel, "ToolsCode", "Tools Code", ccsText, "", CCGetRequestParam("ToolsCode", $Method, NULL), $this);
            $this->ToolsDescription = new clsControl(ccsLabel, "ToolsDescription", "Tools Description", ccsText, "", CCGetRequestParam("ToolsDescription", $Method, NULL), $this);
            $this->ToolsTechDraw = new clsControl(ccsImage, "ToolsTechDraw", "Tools Tech Draw", ccsText, "", CCGetRequestParam("ToolsTechDraw", $Method, NULL), $this);
            $this->ToolsPhoto1 = new clsControl(ccsImage, "ToolsPhoto1", "Tools Photo1", ccsText, "", CCGetRequestParam("ToolsPhoto1", $Method, NULL), $this);
            $this->ToolsPhoto2 = new clsControl(ccsImage, "ToolsPhoto2", "Tools Photo2", ccsText, "", CCGetRequestParam("ToolsPhoto2", $Method, NULL), $this);
            $this->ToolsPhoto3 = new clsControl(ccsImage, "ToolsPhoto3", "Tools Photo3", ccsText, "", CCGetRequestParam("ToolsPhoto3", $Method, NULL), $this);
            $this->ToolsPhoto4 = new clsControl(ccsImage, "ToolsPhoto4", "Tools Photo4", ccsText, "", CCGetRequestParam("ToolsPhoto4", $Method, NULL), $this);
            $this->ToolsNotes = new clsControl(ccsLabel, "ToolsNotes", "Tools Notes", ccsMemo, "", CCGetRequestParam("ToolsNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-D85E7B9D
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->ToolsCode->Errors->Count());
        $errors = ($errors || $this->ToolsDescription->Errors->Count());
        $errors = ($errors || $this->ToolsTechDraw->Errors->Count());
        $errors = ($errors || $this->ToolsPhoto1->Errors->Count());
        $errors = ($errors || $this->ToolsPhoto2->Errors->Count());
        $errors = ($errors || $this->ToolsPhoto3->Errors->Count());
        $errors = ($errors || $this->ToolsPhoto4->Errors->Count());
        $errors = ($errors || $this->ToolsNotes->Errors->Count());
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

//Show Method @2-5CC6AE3B
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
                $this->ToolsCode->SetValue($this->DataSource->ToolsCode->GetValue());
                $this->ToolsDescription->SetValue($this->DataSource->ToolsDescription->GetValue());
                $this->ToolsTechDraw->SetValue($this->DataSource->ToolsTechDraw->GetValue());
                $this->ToolsPhoto1->SetValue($this->DataSource->ToolsPhoto1->GetValue());
                $this->ToolsPhoto2->SetValue($this->DataSource->ToolsPhoto2->GetValue());
                $this->ToolsPhoto3->SetValue($this->DataSource->ToolsPhoto3->GetValue());
                $this->ToolsPhoto4->SetValue($this->DataSource->ToolsPhoto4->GetValue());
                $this->ToolsNotes->SetValue($this->DataSource->ToolsNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->ToolsCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->ToolsNotes->Errors->ToString());
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

        $this->ToolsCode->Show();
        $this->ToolsDescription->Show();
        $this->ToolsTechDraw->Show();
        $this->ToolsPhoto1->Show();
        $this->ToolsPhoto2->Show();
        $this->ToolsPhoto3->Show();
        $this->ToolsPhoto4->Show();
        $this->ToolsNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbltools Class @2-FCB6E20C

class clstbltoolsDataSource extends clsDBGayaFusionAll {  //tbltoolsDataSource Class @2-33906CB2

//DataSource Variables @2-8BC85546
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $ToolsCode;
    public $ToolsDescription;
    public $ToolsTechDraw;
    public $ToolsPhoto1;
    public $ToolsPhoto2;
    public $ToolsPhoto3;
    public $ToolsPhoto4;
    public $ToolsNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-D8887B6C
    function clstbltoolsDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbltools/Error";
        $this->Initialize();
        $this->ToolsCode = new clsField("ToolsCode", ccsText, "");
        
        $this->ToolsDescription = new clsField("ToolsDescription", ccsText, "");
        
        $this->ToolsTechDraw = new clsField("ToolsTechDraw", ccsText, "");
        
        $this->ToolsPhoto1 = new clsField("ToolsPhoto1", ccsText, "");
        
        $this->ToolsPhoto2 = new clsField("ToolsPhoto2", ccsText, "");
        
        $this->ToolsPhoto3 = new clsField("ToolsPhoto3", ccsText, "");
        
        $this->ToolsPhoto4 = new clsField("ToolsPhoto4", ccsText, "");
        
        $this->ToolsNotes = new clsField("ToolsNotes", ccsMemo, "");
        

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

//Open Method @2-76751B21
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbltools {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-D461C1E8
    function SetValues()
    {
        $this->ToolsCode->SetDBValue($this->f("ToolsCode"));
        $this->ToolsDescription->SetDBValue($this->f("ToolsDescription"));
        $this->ToolsTechDraw->SetDBValue($this->f("ToolsTechDraw"));
        $this->ToolsPhoto1->SetDBValue($this->f("ToolsPhoto1"));
        $this->ToolsPhoto2->SetDBValue($this->f("ToolsPhoto2"));
        $this->ToolsPhoto3->SetDBValue($this->f("ToolsPhoto3"));
        $this->ToolsPhoto4->SetDBValue($this->f("ToolsPhoto4"));
        $this->ToolsNotes->SetDBValue($this->f("ToolsNotes"));
    }
//End SetValues Method

} //End tbltoolsDataSource Class @2-FCB6E20C

//Initialize Page @1-EF7BDC12
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
$TemplateFileName = "ShowTools.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-D865657F
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbltools = new clsRecordtbltools("", $MainPage);
$MainPage->tbltools = & $tbltools;
$tbltools->Initialize();

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

//Execute Components @1-FA2CB3B8
$tbltools->Operation();
//End Execute Components

//Go to destination page @1-776A7085
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbltools);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-F5B92FC8
$tbltools->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-464F8AA0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbltools);
unset($Tpl);
//End Unload Page


?>
