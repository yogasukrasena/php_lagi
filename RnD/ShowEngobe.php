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
//Include Common Files @1-6346821D
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowEngobe.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblengobe { //tblengobe Class @2-B4C18A99

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

//Class_Initialize Event @2-3E351A39
    function clsRecordtblengobe($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblengobe/Error";
        $this->DataSource = new clstblengobeDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblengobe";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->EngobeCode = new clsControl(ccsLabel, "EngobeCode", "Engobe Code", ccsText, "", CCGetRequestParam("EngobeCode", $Method, NULL), $this);
            $this->EngobeDescription = new clsControl(ccsLabel, "EngobeDescription", "Engobe Description", ccsText, "", CCGetRequestParam("EngobeDescription", $Method, NULL), $this);
            $this->EngobeTechDraw = new clsControl(ccsImage, "EngobeTechDraw", "Engobe Tech Draw", ccsText, "", CCGetRequestParam("EngobeTechDraw", $Method, NULL), $this);
            $this->EngobePhoto1 = new clsControl(ccsImage, "EngobePhoto1", "Engobe Photo1", ccsText, "", CCGetRequestParam("EngobePhoto1", $Method, NULL), $this);
            $this->EngobePhoto2 = new clsControl(ccsImage, "EngobePhoto2", "Engobe Photo2", ccsText, "", CCGetRequestParam("EngobePhoto2", $Method, NULL), $this);
            $this->EngobePhoto3 = new clsControl(ccsImage, "EngobePhoto3", "Engobe Photo3", ccsText, "", CCGetRequestParam("EngobePhoto3", $Method, NULL), $this);
            $this->EngobePhoto4 = new clsControl(ccsImage, "EngobePhoto4", "Engobe Photo4", ccsText, "", CCGetRequestParam("EngobePhoto4", $Method, NULL), $this);
            $this->EngobeNotes = new clsControl(ccsLabel, "EngobeNotes", "Engobe Notes", ccsMemo, "", CCGetRequestParam("EngobeNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-B60FBEED
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->EngobeCode->Errors->Count());
        $errors = ($errors || $this->EngobeDescription->Errors->Count());
        $errors = ($errors || $this->EngobeTechDraw->Errors->Count());
        $errors = ($errors || $this->EngobePhoto1->Errors->Count());
        $errors = ($errors || $this->EngobePhoto2->Errors->Count());
        $errors = ($errors || $this->EngobePhoto3->Errors->Count());
        $errors = ($errors || $this->EngobePhoto4->Errors->Count());
        $errors = ($errors || $this->EngobeNotes->Errors->Count());
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

//Show Method @2-1A6A2424
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
                $this->EngobeCode->SetValue($this->DataSource->EngobeCode->GetValue());
                $this->EngobeDescription->SetValue($this->DataSource->EngobeDescription->GetValue());
                $this->EngobeTechDraw->SetValue($this->DataSource->EngobeTechDraw->GetValue());
                $this->EngobePhoto1->SetValue($this->DataSource->EngobePhoto1->GetValue());
                $this->EngobePhoto2->SetValue($this->DataSource->EngobePhoto2->GetValue());
                $this->EngobePhoto3->SetValue($this->DataSource->EngobePhoto3->GetValue());
                $this->EngobePhoto4->SetValue($this->DataSource->EngobePhoto4->GetValue());
                $this->EngobeNotes->SetValue($this->DataSource->EngobeNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->EngobeCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobeDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobeTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobePhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobePhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobePhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobePhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->EngobeNotes->Errors->ToString());
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

        $this->EngobeCode->Show();
        $this->EngobeDescription->Show();
        $this->EngobeTechDraw->Show();
        $this->EngobePhoto1->Show();
        $this->EngobePhoto2->Show();
        $this->EngobePhoto3->Show();
        $this->EngobePhoto4->Show();
        $this->EngobeNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblengobe Class @2-FCB6E20C

class clstblengobeDataSource extends clsDBGayaFusionAll {  //tblengobeDataSource Class @2-2D7F96DA

//DataSource Variables @2-E0D46991
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $EngobeCode;
    public $EngobeDescription;
    public $EngobeTechDraw;
    public $EngobePhoto1;
    public $EngobePhoto2;
    public $EngobePhoto3;
    public $EngobePhoto4;
    public $EngobeNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-CE16B6A9
    function clstblengobeDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblengobe/Error";
        $this->Initialize();
        $this->EngobeCode = new clsField("EngobeCode", ccsText, "");
        
        $this->EngobeDescription = new clsField("EngobeDescription", ccsText, "");
        
        $this->EngobeTechDraw = new clsField("EngobeTechDraw", ccsText, "");
        
        $this->EngobePhoto1 = new clsField("EngobePhoto1", ccsText, "");
        
        $this->EngobePhoto2 = new clsField("EngobePhoto2", ccsText, "");
        
        $this->EngobePhoto3 = new clsField("EngobePhoto3", ccsText, "");
        
        $this->EngobePhoto4 = new clsField("EngobePhoto4", ccsText, "");
        
        $this->EngobeNotes = new clsField("EngobeNotes", ccsMemo, "");
        

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

//Open Method @2-44C03E9A
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblengobe {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-57432982
    function SetValues()
    {
        $this->EngobeCode->SetDBValue($this->f("EngobeCode"));
        $this->EngobeDescription->SetDBValue($this->f("EngobeDescription"));
        $this->EngobeTechDraw->SetDBValue($this->f("EngobeTechDraw"));
        $this->EngobePhoto1->SetDBValue($this->f("EngobePhoto1"));
        $this->EngobePhoto2->SetDBValue($this->f("EngobePhoto2"));
        $this->EngobePhoto3->SetDBValue($this->f("EngobePhoto3"));
        $this->EngobePhoto4->SetDBValue($this->f("EngobePhoto4"));
        $this->EngobeNotes->SetDBValue($this->f("EngobeNotes"));
    }
//End SetValues Method

} //End tblengobeDataSource Class @2-FCB6E20C

//Initialize Page @1-AFAEAA02
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
$TemplateFileName = "ShowEngobe.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-7AA6301D
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblengobe = new clsRecordtblengobe("", $MainPage);
$MainPage->tblengobe = & $tblengobe;
$tblengobe->Initialize();

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

//Execute Components @1-774C6064
$tblengobe->Operation();
//End Execute Components

//Go to destination page @1-C135C7EC
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblengobe);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-8BBF4CE5
$tblengobe->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C324AFB0
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblengobe);
unset($Tpl);
//End Unload Page


?>
