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
//Include Common Files @1-31BCBA90
define("RelativePath", ".");
define("PathToCurrentPage", "/");
define("FileName", "ShowSupplier.php");
include_once(RelativePath . "/Common.php");
include_once(RelativePath . "/Template.php");
include_once(RelativePath . "/Sorter.php");
include_once(RelativePath . "/Navigator.php");
//End Include Common Files

class clsRecordtblsupplier { //tblsupplier Class @2-7B45C5B8

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

//Class_Initialize Event @2-03939708
    function clsRecordtblsupplier($RelativePath, & $Parent)
    {

        global $FileName;
        global $CCSLocales;
        global $DefaultDateFormat;
        $this->Visible = true;
        $this->Parent = & $Parent;
        $this->RelativePath = $RelativePath;
        $this->Errors = new clsErrors();
        $this->ErrorBlock = "Record tblsupplier/Error";
        $this->DataSource = new clstblsupplierDataSource($this);
        $this->ds = & $this->DataSource;
        $this->ReadAllowed = true;
        if($this->Visible)
        {
            $this->ComponentName = "tblsupplier";
            $this->Attributes = new clsAttributes($this->ComponentName . ":");
            $CCSForm = split(":", CCGetFromGet("ccsForm", ""), 2);
            if(sizeof($CCSForm) == 1)
                $CCSForm[1] = "";
            list($FormName, $FormMethod) = $CCSForm;
            $this->EditMode = ($FormMethod == "Edit");
            $this->FormEnctype = "application/x-www-form-urlencoded";
            $this->FormSubmitted = ($FormName == $this->ComponentName);
            $Method = $this->FormSubmitted ? ccsPost : ccsGet;
            $this->SupCompany = new clsControl(ccsLabel, "SupCompany", "Sup Company", ccsText, "", CCGetRequestParam("SupCompany", $Method, NULL), $this);
            $this->SupContact = new clsControl(ccsLabel, "SupContact", "Sup Contact", ccsText, "", CCGetRequestParam("SupContact", $Method, NULL), $this);
            $this->SupAddress = new clsControl(ccsLabel, "SupAddress", "Sup Address", ccsText, "", CCGetRequestParam("SupAddress", $Method, NULL), $this);
            $this->SupHP = new clsControl(ccsLabel, "SupHP", "Sup HP", ccsText, "", CCGetRequestParam("SupHP", $Method, NULL), $this);
            $this->SupOffice = new clsControl(ccsLabel, "SupOffice", "Sup Office", ccsText, "", CCGetRequestParam("SupOffice", $Method, NULL), $this);
            $this->SupFax = new clsControl(ccsLabel, "SupFax", "Sup Fax", ccsText, "", CCGetRequestParam("SupFax", $Method, NULL), $this);
            $this->SupEmail = new clsControl(ccsLabel, "SupEmail", "Sup Email", ccsText, "", CCGetRequestParam("SupEmail", $Method, NULL), $this);
            $this->SupItems = new clsControl(ccsLabel, "SupItems", "Sup Items", ccsText, "", CCGetRequestParam("SupItems", $Method, NULL), $this);
            $this->SupOtherInfo = new clsControl(ccsLabel, "SupOtherInfo", "Sup Other Info", ccsMemo, "", CCGetRequestParam("SupOtherInfo", $Method, NULL), $this);
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

//CheckErrors Method @2-9C46ABE2
    function CheckErrors()
    {
        $errors = false;
        $errors = ($errors || $this->SupCompany->Errors->Count());
        $errors = ($errors || $this->SupContact->Errors->Count());
        $errors = ($errors || $this->SupAddress->Errors->Count());
        $errors = ($errors || $this->SupHP->Errors->Count());
        $errors = ($errors || $this->SupOffice->Errors->Count());
        $errors = ($errors || $this->SupFax->Errors->Count());
        $errors = ($errors || $this->SupEmail->Errors->Count());
        $errors = ($errors || $this->SupItems->Errors->Count());
        $errors = ($errors || $this->SupOtherInfo->Errors->Count());
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

//Show Method @2-5BC317BB
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
                $this->SupCompany->SetValue($this->DataSource->SupCompany->GetValue());
                $this->SupContact->SetValue($this->DataSource->SupContact->GetValue());
                $this->SupAddress->SetValue($this->DataSource->SupAddress->GetValue());
                $this->SupHP->SetValue($this->DataSource->SupHP->GetValue());
                $this->SupOffice->SetValue($this->DataSource->SupOffice->GetValue());
                $this->SupFax->SetValue($this->DataSource->SupFax->GetValue());
                $this->SupEmail->SetValue($this->DataSource->SupEmail->GetValue());
                $this->SupItems->SetValue($this->DataSource->SupItems->GetValue());
                $this->SupOtherInfo->SetValue($this->DataSource->SupOtherInfo->GetValue());
            } else {
                $this->EditMode = false;
            }
        }

        if($this->FormSubmitted || $this->CheckErrors()) {
            $Error = "";
            $Error = ComposeStrings($Error, $this->SupCompany->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupContact->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupAddress->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupHP->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupOffice->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupFax->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupEmail->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupItems->Errors->ToString());
            $Error = ComposeStrings($Error, $this->SupOtherInfo->Errors->ToString());
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

        $this->SupCompany->Show();
        $this->SupContact->Show();
        $this->SupAddress->Show();
        $this->SupHP->Show();
        $this->SupOffice->Show();
        $this->SupFax->Show();
        $this->SupEmail->Show();
        $this->SupItems->Show();
        $this->SupOtherInfo->Show();
        $Tpl->parse();
        $Tpl->block_path = $ParentPath;
        $this->DataSource->close();
    }
//End Show Method

} //End tblsupplier Class @2-FCB6E20C

class clstblsupplierDataSource extends clsDBGayaFusionAll {  //tblsupplierDataSource Class @2-A709D700

//DataSource Variables @2-2443A5AC
    public $Parent = "";
    public $CCSEvents = "";
    public $CCSEventResult;
    public $ErrorBlock;
    public $CmdExecution;

    public $wp;
    public $AllParametersSet;


    // Datasource fields
    public $SupCompany;
    public $SupContact;
    public $SupAddress;
    public $SupHP;
    public $SupOffice;
    public $SupFax;
    public $SupEmail;
    public $SupItems;
    public $SupOtherInfo;
//End DataSource Variables

//DataSourceClass_Initialize Event @2-20B983F4
    function clstblsupplierDataSource(& $Parent)
    {
        $this->Parent = & $Parent;
        $this->ErrorBlock = "Record tblsupplier/Error";
        $this->Initialize();
        $this->SupCompany = new clsField("SupCompany", ccsText, "");
        
        $this->SupContact = new clsField("SupContact", ccsText, "");
        
        $this->SupAddress = new clsField("SupAddress", ccsText, "");
        
        $this->SupHP = new clsField("SupHP", ccsText, "");
        
        $this->SupOffice = new clsField("SupOffice", ccsText, "");
        
        $this->SupFax = new clsField("SupFax", ccsText, "");
        
        $this->SupEmail = new clsField("SupEmail", ccsText, "");
        
        $this->SupItems = new clsField("SupItems", ccsText, "");
        
        $this->SupOtherInfo = new clsField("SupOtherInfo", ccsMemo, "");
        

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

//Open Method @2-799C8DB1
    function Open()
    {
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeBuildSelect", $this->Parent);
        $this->SQL = "SELECT * \n\n" .
        "FROM tblsupplier {SQL_Where} {SQL_OrderBy}";
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "BeforeExecuteSelect", $this->Parent);
        $this->PageSize = 1;
        $this->query($this->OptimizeSQL(CCBuildSQL($this->SQL, $this->Where, $this->Order)));
        $this->CCSEventResult = CCGetEvent($this->CCSEvents, "AfterExecuteSelect", $this->Parent);
    }
//End Open Method

//SetValues Method @2-19737575
    function SetValues()
    {
        $this->SupCompany->SetDBValue($this->f("SupCompany"));
        $this->SupContact->SetDBValue($this->f("SupContact"));
        $this->SupAddress->SetDBValue($this->f("SupAddress"));
        $this->SupHP->SetDBValue($this->f("SupHP"));
        $this->SupOffice->SetDBValue($this->f("SupOffice"));
        $this->SupFax->SetDBValue($this->f("SupFax"));
        $this->SupEmail->SetDBValue($this->f("SupEmail"));
        $this->SupItems->SetDBValue($this->f("SupItems"));
        $this->SupOtherInfo->SetDBValue($this->f("SupOtherInfo"));
    }
//End SetValues Method

} //End tblsupplierDataSource Class @2-FCB6E20C

//Initialize Page @1-311D2DD1
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
$TemplateFileName = "ShowSupplier.html";
$BlockToParse = "main";
$TemplateEncoding = "CP1252";
$ContentType = "text/html";
$PathToRoot = "./";
$Charset = $Charset ? $Charset : "windows-1252";
//End Initialize Page

//Before Initialize @1-E870CEBC
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeInitialize", $MainPage);
//End Before Initialize

//Initialize Objects @1-AA512045
$DBGayaFusionAll = new clsDBGayaFusionAll();
$MainPage->Connections["GayaFusionAll"] = & $DBGayaFusionAll;
$Attributes = new clsAttributes("page:");
$MainPage->Attributes = & $Attributes;

// Controls
$tblsupplier = new clsRecordtblsupplier("", $MainPage);
$MainPage->tblsupplier = & $tblsupplier;
$tblsupplier->Initialize();

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

//Execute Components @1-9ABAAB43
$tblsupplier->Operation();
//End Execute Components

//Go to destination page @1-665FF81C
if($Redirect)
{
    $CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
    $DBGayaFusionAll->close();
    header("Location: " . $Redirect);
    unset($tblsupplier);
    unset($Tpl);
    exit;
}
//End Go to destination page

//Show Page @1-AE43D4FC
$tblsupplier->Show();
$Tpl->block_path = "";
$Tpl->Parse($BlockToParse, false);
if (!isset($main_block)) $main_block = $Tpl->GetVar($BlockToParse);
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeOutput", $MainPage);
if ($CCSEventResult) echo $main_block;
//End Show Page

//Unload Page @1-8F99269A
$CCSEventResult = CCGetEvent($CCSEvents, "BeforeUnload", $MainPage);
$DBGayaFusionAll->close();
unset($tblsupplier);
unset($Tpl);
//End Unload Page


?>
