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
//Include Common Files @1-44D836C6
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowEstruder.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblestruder { //tblestruder Class @2-44ED5FF2

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

//Class_Initialize Event @2-CA731D2E
    function clsRecordtblestruder($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblestruder/Error";
        $this->DataSource = new clstblestruderDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblestruder";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->EstruderCode = new clsControl(ccsLabel, "EstruderCode", "Estruder Code", ccsText, "", CCGetRequestParam("EstruderCode", $Method, NULL), $this);
            $this->EstruderDescription = new clsControl(ccsLabel, "EstruderDescription", "Estruder Description", ccsText, "", CCGetRequestParam("EstruderDescription", $Method, NULL), $this);
            $this->EstruderTechDraw = new clsControl(ccsImage, "EstruderTechDraw", "Estruder Tech Draw", ccsText, "", CCGetRequestParam("EstruderTechDraw", $Method, NULL), $this);
            $this->EstruderPhoto1 = new clsControl(ccsImage, "EstruderPhoto1", "Estruder Photo1", ccsText, "", CCGetRequestParam("EstruderPhoto1", $Method, NULL), $this);
            $this->EstruderPhoto2 = new clsControl(ccsImage, "EstruderPhoto2", "Estruder Photo2", ccsText, "", CCGetRequestParam("EstruderPhoto2", $Method, NULL), $this);
            $this->EstruderPhoto3 = new clsControl(ccsImage, "EstruderPhoto3", "Estruder Photo3", ccsText, "", CCGetRequestParam("EstruderPhoto3", $Method, NULL), $this);
            $this->EstruderPhoto4 = new clsControl(ccsImage, "EstruderPhoto4", "Estruder Photo4", ccsText, "", CCGetRequestParam("EstruderPhoto4", $Method, NULL), $this);
            $this->EstruderNotes = new clsControl(ccsLabel, "EstruderNotes", "Estruder Notes", ccsMemo, "", CCGetRequestParam("EstruderNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-AA9DD0DE
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->EstruderCode->Errors->Count());
        $errors = ($errors || $this->EstruderDescription->Errors->Count());
        $errors = ($errors || $this->EstruderTechDraw->Errors->Count());
        $errors = ($errors || $this->EstruderPhoto1->Errors->Count());
        $errors = ($errors || $this->EstruderPhoto2->Errors->Count());
        $errors = ($errors || $this->EstruderPhoto3->Errors->Count());
        $errors = ($errors || $this->EstruderPhoto4->Errors->Count());
        $errors = ($errors || $this->EstruderNotes->Errors->Count());
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

//Show Method @2-D2793BED
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
                $this->EstruderCode->SetValue($this->DataSource->EstruderCode->GetValue());
                $this->EstruderDescription->SetValue($this->DataSource->EstruderDescription->GetValue());
                $this->EstruderTechDraw->SetValue($this->DataSource->EstruderTechDraw->GetValue());
                $this->EstruderPhoto1->SetValue($this->DataSource->EstruderPhoto1->GetValue());
                $this->EstruderPhoto2->SetValue($this->DataSource->EstruderPhoto2->GetValue());
                $this->EstruderPhoto3->SetValue($this->DataSource->EstruderPhoto3->GetValue());
                $this->EstruderPhoto4->SetValue($this->DataSource->EstruderPhoto4->GetValue());
                $this->EstruderNotes->SetValue($this->DataSource->EstruderNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->EstruderCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderPhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderPhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderPhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderPhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EstruderNotes->Errors->ToString());
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

        $this->EstruderCode->Show();
        $this->EstruderDescription->Show();
        $this->EstruderTechDraw->Show();
        $this->EstruderPhoto1->Show();
        $this->EstruderPhoto2->Show();
        $this->EstruderPhoto3->Show();
        $this->EstruderPhoto4->Show();
        $this->EstruderNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblestruder Class @2-FCB6E20C

class clstblestruderDataSource extends clsDBGayaFusionAll {  //tblestruderDataSource Class @2-A80CA00D

//DataSource Variables @2-6867F623
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $EstruderCode;
    public $EstruderDescription;
    public $EstruderTechDraw;
    public $EstruderPhoto1;
    public $EstruderPhoto2;
    public $EstruderPhoto3;
    public $EstruderPhoto4;
    public $EstruderNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-FE9128B8
    function clstblestruderDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblestruder/Error";
        $this->Initialize();
        $this->EstruderCode = new clsField("EstruderCode", ccsText, "");
        
        $this->EstruderDescription = new clsField("EstruderDescription", ccsText, "");
        
        $this->EstruderTechDraw = new clsField("EstruderTechDraw", ccsText, "");
        
        $this->EstruderPhoto1 = new clsField("EstruderPhoto1", ccsText, "");
        
        $this->EstruderPhoto2 = new clsField("EstruderPhoto2", ccsText, "");
        
        $this->EstruderPhoto3 = new clsField("EstruderPhoto3", ccsText, "");
        
        $this->EstruderPhoto4 = new clsField("EstruderPhoto4", ccsText, "");
        
        $this->EstruderNotes = new clsField("EstruderNotes", ccsMemo, "");
        

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

//Open Method @2-FB36456E
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblestruder {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-89C3F147
    function SetValues()
    {
        $this->EstruderCode->SetDBValue($this->f("EstruderCode"));
        $this->EstruderDescription->SetDBValue($this->f("EstruderDescription"));
        $this->EstruderTechDraw->SetDBValue($this->f("EstruderTechDraw"));
        $this->EstruderPhoto1->SetDBValue($this->f("EstruderPhoto1"));
        $this->EstruderPhoto2->SetDBValue($this->f("EstruderPhoto2"));
        $this->EstruderPhoto3->SetDBValue($this->f("EstruderPhoto3"));
        $this->EstruderPhoto4->SetDBValue($this->f("EstruderPhoto4"));
        $this->EstruderNotes->SetDBValue($this->f("EstruderNotes"));
    }
//End SetValues Method

} //End tblestruderDataSource Class @2-FCB6E20C

//Initialize Page @1-079CBC28
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
$TemplateFileName = "ShowEstruder.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-113774E1
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblestruder = new clsRecordtblestruder("", $MainPage);
$MainPage->tblestruder = & $tblestruder;
$tblestruder->Initialize();

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

//Execute Components @1-49C6B40B
$tblestruder->Operation();
//End Execute Components

//Go to destination page @1-C9C2E403
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblestruder);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-7C326B26
$tblestruder->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-5CE539D2
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblestruder);
unset($Tpl);
//End Unload Page


?>
