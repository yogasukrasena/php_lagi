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
//Include Common Files @1-03BFCC2B
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowTexture.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtbltexture { //tbltexture Class @2-CBF23BCD

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

//Class_Initialize Event @2-A0342A2B
    function clsRecordtbltexture($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tbltexture/Error";
        $this->DataSource = new clstbltextureDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tbltexture";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->TextureCode = new clsControl(ccsLabel, "TextureCode", "Texture Code", ccsText, "", CCGetRequestParam("TextureCode", $Method, NULL), $this);
            $this->TextureDescription = new clsControl(ccsLabel, "TextureDescription", "Texture Description", ccsText, "", CCGetRequestParam("TextureDescription", $Method, NULL), $this);
            $this->TextureTechDraw = new clsControl(ccsImage, "TextureTechDraw", "Texture Tech Draw", ccsText, "", CCGetRequestParam("TextureTechDraw", $Method, NULL), $this);
            $this->TexturePhoto1 = new clsControl(ccsImage, "TexturePhoto1", "Texture Photo1", ccsText, "", CCGetRequestParam("TexturePhoto1", $Method, NULL), $this);
            $this->TexturePhoto2 = new clsControl(ccsImage, "TexturePhoto2", "Texture Photo2", ccsText, "", CCGetRequestParam("TexturePhoto2", $Method, NULL), $this);
            $this->TexturePhoto3 = new clsControl(ccsImage, "TexturePhoto3", "Texture Photo3", ccsText, "", CCGetRequestParam("TexturePhoto3", $Method, NULL), $this);
            $this->TexturePhoto4 = new clsControl(ccsImage, "TexturePhoto4", "Texture Photo4", ccsText, "", CCGetRequestParam("TexturePhoto4", $Method, NULL), $this);
            $this->TextureNotes = new clsControl(ccsLabel, "TextureNotes", "Texture Notes", ccsMemo, "", CCGetRequestParam("TextureNotes", $Method, NULL), $this);
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

//CheckErrors Method @2-2833F3F7
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->TextureCode->Errors->Count());
        $errors = ($errors || $this->TextureDescription->Errors->Count());
        $errors = ($errors || $this->TextureTechDraw->Errors->Count());
        $errors = ($errors || $this->TexturePhoto1->Errors->Count());
        $errors = ($errors || $this->TexturePhoto2->Errors->Count());
        $errors = ($errors || $this->TexturePhoto3->Errors->Count());
        $errors = ($errors || $this->TexturePhoto4->Errors->Count());
        $errors = ($errors || $this->TextureNotes->Errors->Count());
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

//Show Method @2-6E1FCE4C
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
                $this->TextureCode->SetValue($this->DataSource->TextureCode->GetValue());
                $this->TextureDescription->SetValue($this->DataSource->TextureDescription->GetValue());
                $this->TextureTechDraw->SetValue($this->DataSource->TextureTechDraw->GetValue());
                $this->TexturePhoto1->SetValue($this->DataSource->TexturePhoto1->GetValue());
                $this->TexturePhoto2->SetValue($this->DataSource->TexturePhoto2->GetValue());
                $this->TexturePhoto3->SetValue($this->DataSource->TexturePhoto3->GetValue());
                $this->TexturePhoto4->SetValue($this->DataSource->TexturePhoto4->GetValue());
                $this->TextureNotes->SetValue($this->DataSource->TextureNotes->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->TextureCode->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextureDescription->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextureTechDraw->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TexturePhoto1->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TexturePhoto2->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TexturePhoto3->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TexturePhoto4->Errors->ToString());
            $Error = ComposeStrings($Error, $this->TextureNotes->Errors->ToString());
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

        $this->TextureCode->Show();
        $this->TextureDescription->Show();
        $this->TextureTechDraw->Show();
        $this->TexturePhoto1->Show();
        $this->TexturePhoto2->Show();
        $this->TexturePhoto3->Show();
        $this->TexturePhoto4->Show();
        $this->TextureNotes->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tbltexture Class @2-FCB6E20C

class clstbltextureDataSource extends clsDBGayaFusionAll {  //tbltextureDataSource Class @2-FDAEB799

//DataSource Variables @2-8434D9AD
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $TextureCode;
    public $TextureDescription;
    public $TextureTechDraw;
    public $TexturePhoto1;
    public $TexturePhoto2;
    public $TexturePhoto3;
    public $TexturePhoto4;
    public $TextureNotes;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-30CD7DC8
    function clstbltextureDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tbltexture/Error";
        $this->Initialize();
        $this->TextureCode = new clsField("TextureCode", ccsText, "");
        
        $this->TextureDescription = new clsField("TextureDescription", ccsText, "");
        
        $this->TextureTechDraw = new clsField("TextureTechDraw", ccsText, "");
        
        $this->TexturePhoto1 = new clsField("TexturePhoto1", ccsText, "");
        
        $this->TexturePhoto2 = new clsField("TexturePhoto2", ccsText, "");
        
        $this->TexturePhoto3 = new clsField("TexturePhoto3", ccsText, "");
        
        $this->TexturePhoto4 = new clsField("TexturePhoto4", ccsText, "");
        
        $this->TextureNotes = new clsField("TextureNotes", ccsMemo, "");
        

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

//Open Method @2-6C580D03
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tbltexture {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-E6444DE6
    function SetValues()
    {
        $this->TextureCode->SetDBValue($this->f("TextureCode"));
        $this->TextureDescription->SetDBValue($this->f("TextureDescription"));
        $this->TextureTechDraw->SetDBValue($this->f("TextureTechDraw"));
        $this->TexturePhoto1->SetDBValue($this->f("TexturePhoto1"));
        $this->TexturePhoto2->SetDBValue($this->f("TexturePhoto2"));
        $this->TexturePhoto3->SetDBValue($this->f("TexturePhoto3"));
        $this->TexturePhoto4->SetDBValue($this->f("TexturePhoto4"));
        $this->TextureNotes->SetDBValue($this->f("TextureNotes"));
    }
//End SetValues Method

} //End tbltextureDataSource Class @2-FCB6E20C

//Initialize Page @1-83E85A21
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
$TemplateFileName = "ShowTexture.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-23AE6093
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tbltexture = new clsRecordtbltexture("", $MainPage);
$MainPage->tbltexture = & $tbltexture;
$tbltexture->Initialize();

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

//Execute Components @1-EF9B7F91
$tbltexture->Operation();
//End Execute Components

//Go to destination page @1-6449BF2D
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tbltexture);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-C444A02E
$tbltexture->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-C9293528
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tbltexture);
unset($Tpl);
//End Unload Page


?>
