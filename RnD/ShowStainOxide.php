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
//Include Common Files @1-2A9BE20E
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowStainOxide.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblstainoxide { //tblstainoxide Class @2-27CFCEBB

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

//Class_Initialize Event @2-671A770C
    function clsRecordtblstainoxide($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblstainoxide/Error";
        $this->DataSource = new clstblstainoxideDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblstainoxide";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->StainOxideCode = new clsControl(ccsLabel, "StainOxideCode", "Stain Oxide Code", ccsText, "", CCGetRequestParam("StainOxideCode", $Method, NULL), $this);
            $this->StainOxideDescription = new clsControl(ccsLabel, "StainOxideDescription", "Stain Oxide Description", ccsText, "", CCGetRequestParam("StainOxideDescription", $Method, NULL), $this);
            $this->StainOxideTechDraw = new clsControl(ccsImage, "StainOxideTechDraw", "Stain Oxide Tech Draw", ccsText, "", CCGetRequestParam("StainOxideTechDraw", $Method, NULL), $this);
            $this->StainOxidePhoto1 = new clsControl(ccsImage, "StainOxidePhoto1", "Stain Oxide Photo1", ccsText, "", CCGetRequestParam("StainOxidePhoto1", $Method, NULL), $this);
            $this->StainOxidePhoto2 = new clsControl(ccsImage, "StainOxidePhoto2", "Stain Oxide Photo2", ccsText, "", CCGetRequestParam("StainOxidePhoto2", $Method, NULL), $this);
            $this->StainOxidePhoto3 = new clsControl(ccsImage, "StainOxidePhoto3", "Stain Oxide Photo3", ccsText, "", CCGetRequestParam("StainOxidePhoto3", $Method, NULL), $this);
            $this->StainOxidePhoto4 = new clsControl(ccsImage, "StainOxidePhoto4", "Stain Oxide Photo4", ccsText, "", CCGetRequestParam("StainOxidePhoto4", $Method, NULL), $this);
            $this->StainOxideNotes = new clsControl(ccsLabel, "StainOxideNotes", "Stain Oxide Notes", ccsMemo, "", CCGetRequestParam("StainOxideNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-CEA56C88
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->StainOxideCode->Errors->Count());
        $errors = ($errors || $this->StainOxideDescription->Errors->Count());
        $errors = ($errors || $this->StainOxideTechDraw->Errors->Count());
        $errors = ($errors || $this->StainOxidePhoto1->Errors->Count());
        $errors = ($errors || $this->StainOxidePhoto2->Errors->Count());
        $errors = ($errors || $this->StainOxidePhoto3->Errors->Count());
        $errors = ($errors || $this->StainOxidePhoto4->Errors->Count());
        $errors = ($errors || $this->StainOxideNotes->Errors->Count());
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

//Show Method @2-4D26104C
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
                $this->StainOxideCode->SetValue($this->DataSource->StainOxideCode->GetValue());
                $this->StainOxideDescription->SetValue($this->DataSource->StainOxideDescription->GetValue());
                $this->StainOxideTechDraw->SetValue($this->DataSource->StainOxideTechDraw->GetValue());
                $this->StainOxidePhoto1->SetValue($this->DataSource->StainOxidePhoto1->GetValue());
                $this->StainOxidePhoto2->SetValue($this->DataSource->StainOxidePhoto2->GetValue());
                $this->StainOxidePhoto3->SetValue($this->DataSource->StainOxidePhoto3->GetValue());
                $this->StainOxidePhoto4->SetValue($this->DataSource->StainOxidePhoto4->GetValue());
                $this->StainOxideNotes->SetValue($this->DataSource->StainOxideNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->StainOxideCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxidePhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxidePhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxidePhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxidePhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->StainOxideNotes->Errors->ToString());
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

        $this->StainOxideCode->Show();
        $this->StainOxideDescription->Show();
        $this->StainOxideTechDraw->Show();
        $this->StainOxidePhoto1->Show();
        $this->StainOxidePhoto2->Show();
        $this->StainOxidePhoto3->Show();
        $this->StainOxidePhoto4->Show();
        $this->StainOxideNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblstainoxide Class @2-FCB6E20C

class clstblstainoxideDataSource extends clsDBGayaFusionAll {  //tblstainoxideDataSource Class @2-E62D4DC1

//DataSource Variables @2-215948E9
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $StainOxideCode;
    public $StainOxideDescription;
    public $StainOxideTechDraw;
    public $StainOxidePhoto1;
    public $StainOxidePhoto2;
    public $StainOxidePhoto3;
    public $StainOxidePhoto4;
    public $StainOxideNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-45F12FE3
    function clstblstainoxideDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblstainoxide/Error";
        $this->Initialize();
        $this->StainOxideCode = new clsField("StainOxideCode", ccsText, "");
        
        $this->StainOxideDescription = new clsField("StainOxideDescription", ccsText, "");
        
        $this->StainOxideTechDraw = new clsField("StainOxideTechDraw", ccsText, "");
        
        $this->StainOxidePhoto1 = new clsField("StainOxidePhoto1", ccsText, "");
        
        $this->StainOxidePhoto2 = new clsField("StainOxidePhoto2", ccsText, "");
        
        $this->StainOxidePhoto3 = new clsField("StainOxidePhoto3", ccsText, "");
        
        $this->StainOxidePhoto4 = new clsField("StainOxidePhoto4", ccsText, "");
        
        $this->StainOxideNotes = new clsField("StainOxideNotes", ccsMemo, "");
        

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

//Open Method @2-766ABE51
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblstainoxide {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-5422FE5E
    function SetValues()
    {
        $this->StainOxideCode->SetDBValue($this->f("StainOxideCode"));
        $this->StainOxideDescription->SetDBValue($this->f("StainOxideDescription"));
        $this->StainOxideTechDraw->SetDBValue($this->f("StainOxideTechDraw"));
        $this->StainOxidePhoto1->SetDBValue($this->f("StainOxidePhoto1"));
        $this->StainOxidePhoto2->SetDBValue($this->f("StainOxidePhoto2"));
        $this->StainOxidePhoto3->SetDBValue($this->f("StainOxidePhoto3"));
        $this->StainOxidePhoto4->SetDBValue($this->f("StainOxidePhoto4"));
        $this->StainOxideNotes->SetDBValue($this->f("StainOxideNotes"));
    }
//End SetValues Method

} //End tblstainoxideDataSource Class @2-FCB6E20C

//Initialize Page @1-126DC805
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
$TemplateFileName = "ShowStainOxide.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-1864F441
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblstainoxide = new clsRecordtblstainoxide("", $MainPage);
$MainPage->tblstainoxide = & $tblstainoxide;
$tblstainoxide->Initialize();

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

//Execute Components @1-D2078264
$tblstainoxide->Operation();
//End Execute Components

//Go to destination page @1-AD4AF866
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblstainoxide);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-B1C9317C
$tblstainoxide->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-EA58F007
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblstainoxide);
unset($Tpl);
//End Unload Page


?>
